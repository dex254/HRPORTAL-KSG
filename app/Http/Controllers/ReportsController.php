<?php

namespace App\Http\Controllers;
use in;

use App\Models\Staff;
use App\Models\Assesment;
use App\Models\Timetable;
use App\Models\Curriculum;
use App\Models\Coordinator;
use App\Models\Facilitator;
use App\Models\Participants;
use Illuminate\Http\Request;
use App\Models\Newcurriculum;
use Illuminate\Support\Carbon;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller
{
    //
    public function reportall()
    {
        $user = Auth::guard('admin')->user();

        // Define the allowed roles
        $allowedRoles = ['Admin', 'dex', 'DAA', 'DAAassistant'];
    
        // Check if the user is authenticated and has one of the allowed roles
        if (!$user || !in_array($user->role, $allowedRoles)) {
            // Redirect or show an error message if the user is not authorized
            return redirect()->route('DAA.Dashboard')->with('error', 'You are not authorized to access this page.');
        }
        $lecturerTopics = DB::table('timetables')
        ->select('LecturerName', DB::raw('COUNT(*) as topics_facilitated')) // Count all rows for each LecturerName
        ->groupBy('LecturerName')
        ->get();
        $lecturerCoordinators = DB::table('coordinator')
        ->select('name', DB::raw('COUNT(DISTINCT code) as programs_coordinated'))
        ->groupBy('name')
        ->get();
        $lecturerCurriculumsReviewed = DB::table('curriculum')
        ->select('LecturerName', DB::raw('COUNT(*) as curriculums_reviewed')) // Count rows where status is 'reviewed'
        ->where('status', 'Complete')  // Update this based on the 'reviewed' status
        ->groupBy('LecturerName')
        ->get();

    // Get the count of all rows (distinct code) for each LecturerName in the coordinator table
    $lecturerNewCurriculums = DB::table('newcurriculum')
    ->select('LecturerName', DB::raw('COUNT(*) as newcurriculums_complete')) // Counting rows where status is 'Complete'
    ->where('status', 'Complete')
    ->groupBy('LecturerName')
    ->get();
    $lecturerEvaluations = DB::table('coordinatorevals')
    ->join('staff', 'coordinatorevals.codeuuid', '=', 'staff.idnumber')
    ->select('staff.name as LecturerName', DB::raw('COUNT(*) as evaluations_count'))
    ->groupBy('staff.name')
    ->get();

    $lecturerDetails = $lecturerTopics->map(function ($lecturer) use (
        $lecturerCoordinators, 
        $lecturerCurriculumsReviewed, 
        $lecturerNewCurriculums, 
        $lecturerEvaluations
    ) {
        $coordinator = $lecturerCoordinators->firstWhere('name', $lecturer->LecturerName);
        $curriculumReviewed = $lecturerCurriculumsReviewed->firstWhere('LecturerName', $lecturer->LecturerName);
        $newCurriculum = $lecturerNewCurriculums->firstWhere('LecturerName', $lecturer->LecturerName);
        $evaluations = $lecturerEvaluations->firstWhere('LecturerName', $lecturer->LecturerName);

        $lecturer->programs_coordinated = $coordinator ? $coordinator->programs_coordinated : 0;
        $lecturer->curriculums_reviewed = $curriculumReviewed ? $curriculumReviewed->curriculums_reviewed : 0;
        $lecturer->newcurriculums_complete = $newCurriculum ? $newCurriculum->newcurriculums_complete : 0;
        $lecturer->evaluations_count = $evaluations ? $evaluations->evaluations_count : 0;

        return $lecturer;
    });

    // Pass the merged data to the view
    return view('Report.staff', compact('lecturerDetails'));
}
public function lecturerdetails($LecturerName)
{
    // Get the authenticated user (admin, dex, DAA, or DAAassistant)
    $user = Auth::guard('admin')->user();

    // Define the allowed roles
    $allowedRoles = ['Admin', 'dex', 'DAA', 'DAAassistant'];

    // Check if the user is authenticated and has one of the allowed roles
    if (!$user || !in_array($user->role, $allowedRoles)) {
        // Redirect or show an error message if the user is not authorized
        return redirect()->route('DAA.Dashboard')->with('error', 'You are not authorized to access this page.');
    }

    // Fetch the lecturer's details based on the lecturer's name
    $lecturer = DB::table('timetables')
        ->where('LecturerName', $LecturerName)
        ->first();

    if (!$lecturer) {
        return redirect()->route('DAA.Dashboard')->with('error', 'Lecturer not found.');
    }

    // Fetch the lecturer's topic facilitation details
    $facilitators = Facilitator::where('Staff_No', $lecturer->Staff_No)
        ->select('Topic_description', 'Topic_code', 'procode', 'Staff_No')
        ->distinct()
        ->get()
        ->groupBy('Topic_description');

    $totalAverageDuration = 0;
    $totalSumOfEvaluations = 0; // Initialize the total sum of evaluations

    foreach ($facilitators as $Topic_description => $group) {
        foreach ($group as $facilitator) {
            // Calculate the average duration for the same 'Topic_code' for each facilitator group
            $averageDuration = Facilitator::where('Topic_code', $facilitator->Topic_code)
                ->where('Staff_No', $facilitator->Staff_No)
                ->avg('No_of_hours');

            $participantCount = Participants::where('code', $facilitator->procode)
                ->count();

            // Get the topic count from the topics table, matching 'Unit' in facilitator with 'code' in topics
            $topicCount = Facilitator::where('Staff_No', $facilitator->Staff_No)
                ->where('Topic_code', $facilitator->Topic_code)
                ->distinct('Topic_code')
                ->count();

            // Calculate the sum of evaluation fields for the facilitator
            $sumofevaluation = 
                Facilitator::where('Topic_code', $facilitator->Topic_code)
                ->distinct('Topic_code')
                    ->where('Staff_No', $facilitator->Staff_No)
                    ->sum('punctuality') / max(1, $participantCount) +
                Facilitator::where('Topic_code', $facilitator->Topic_code)
                    ->where('Staff_No', $facilitator->Staff_No)
                    ->sum('presentation_flow') / max(1, $participantCount) +
                Facilitator::where('Topic_code', $facilitator->Topic_code)
                    ->where('Staff_No', $facilitator->Staff_No)
                    ->sum('handling_questions') / max(1, $participantCount) +
                Facilitator::where('Topic_code', $facilitator->Topic_code)
                    ->where('Staff_No', $facilitator->Staff_No)
                    ->sum('active_participation_of_learners') / max(1, $participantCount) +
                Facilitator::where('Topic_code', $facilitator->Topic_code)
                    ->where('Staff_No', $facilitator->Staff_No)
                    ->sum('use_of_visual_aids') / max(1, $participantCount) +
                Facilitator::where('Topic_code', $facilitator->Topic_code)
                    ->where('Staff_No', $facilitator->Staff_No)
                    ->sum('relevance_of_subject_to_workplace') / max(1, $participantCount) +
                Facilitator::where('Topic_code', $facilitator->Topic_code)
                    ->where('Staff_No', $facilitator->Staff_No)
                    ->sum('use_of_relevant_examples') / max(1, $participantCount) +
                Facilitator::where('Topic_code', $facilitator->Topic_code)
                    ->where('Staff_No', $facilitator->Staff_No)
                    ->sum('knowledge_of_subject') / max(1, $participantCount) +
                Facilitator::where('Topic_code', $facilitator->Topic_code)
                    ->where('Staff_No', $facilitator->Staff_No)
                    ->sum('treats_participants_with_dignity_and_respect') / max(1, $participantCount) +
                Facilitator::where('Topic_code', $facilitator->Topic_code)
                    ->where('Staff_No', $facilitator->Staff_No)
                    ->sum('variety_and_appropriateness_of_training_methods') / max(1, $participantCount);

            // Add the average duration, participant count, topic count, and sum of evaluations to the facilitator object
            $facilitator->average_duration = $averageDuration;
            $facilitator->participant_count = $participantCount;
            $facilitator->topic_count = $topicCount;
            $facilitator->sumofevaluation = $sumofevaluation;

            // Accumulate the average duration to the total
            $totalAverageDuration += $averageDuration;

            // Accumulate the sum of evaluations to the total
            $totalSumOfEvaluations += $sumofevaluation;
        }
    }

    $facilitatorCount = $facilitators->count();

    // Pass the lecturer details, facilitators, topic count, total average duration, and total sum of evaluations to the view
    return view('Report.staffdetails', compact('lecturer', 'facilitators', 'facilitatorCount', 'totalAverageDuration', 'totalSumOfEvaluations'));
}
public function Monthlyload()
{
    $user = Auth::guard('admin')->user();

    // Define the allowed roles
    $allowedRoles = ['Admin', 'dex', 'DAA', 'DAAassistant'];

    // Check if the user is authenticated and has one of the allowed roles
    if (!$user || !in_array($user->role, $allowedRoles)) {
        // Redirect or show an error message if the user is not authorized
        return redirect()->route('DAA.Dashboard')->with('error', 'You are not authorized to access this page.');
    }

    $currentDate = Carbon::now(); 
    $currentMonth = $currentDate->month;
    $currentYear = $currentDate->year;

    // Query the Timetable for the current month and year, grouped by LecturerName and Staff_No
    $lecturerReport = Timetable::whereYear('Time_table_date', $currentYear)
                               ->whereMonth('Time_table_date', $currentMonth)
                               ->select('LecturerName', 'Staff_No', DB::raw('SUM(No_of_hours) as total_hours'))
                               ->groupBy('LecturerName', 'Staff_No')
                               ->get();

    // Query the Facilitator table for evaluated records in the current month and year
    $evaluationReport = Facilitator::where('status', 'Evaluated')
                                   ->whereYear('date', $currentYear)
                                   ->whereMonth('date', $currentMonth)
                                   ->select(
                                       'LecturerName',
                                       'Staff_No',
                                       DB::raw('SUM(punctuality + presentation_flow + handling_questions + active_participation_of_learners + use_of_visual_aids + relevance_of_subject_to_workplace + use_of_relevant_examples + knowledge_of_subject + treats_participants_with_dignity_and_respect + variety_and_appropriateness_of_training_methods) as total_evaluation_sum')
                                   )
                                   ->groupBy('LecturerName', 'Staff_No')
                                   ->get();

    // Query the Facilitator table to get the participant count per lecturer
    $participantCountReport = Facilitator::whereYear('date', $currentYear)
                                         ->whereMonth('date', $currentMonth)
                                         ->select('LecturerName', 'Staff_No', DB::raw('COUNT(*) as participant_count'))
                                         ->groupBy('LecturerName', 'Staff_No')
                                         ->get();

    // Query the Coordinator table to count the number of programs coordinated per lecturer in the current month
    $coordinatorCountReport = Coordinator::whereYear('date', $currentYear)
                                         ->whereMonth('date', $currentMonth)
                                         ->select('name as LecturerName', DB::raw('COUNT(*) as coordinator_count'))
                                         ->groupBy('LecturerName')
                                         ->get();

    // Query the Curriculum table to get the count of curriculum entries for each lecturer for the current year
    $curriculumCountReport = Curriculum::whereYear('date', $currentYear)
                                        ->where('status', 'Complete')
                                       ->select('LecturerName', 'Staff_No', DB::raw('COUNT(*) as curriculum_count'))
                                       ->groupBy('LecturerName', 'Staff_No')
                                       ->get();
    $newCurriculumCountReport = Newcurriculum::whereYear('date', $currentYear)
                                       ->where('status', 'Complete')        
                                       ->select('LecturerName', 'Staff_No', DB::raw('COUNT(*) as new_curriculum_count'))
                                       ->groupBy('LecturerName', 'Staff_No')
                                       ->get();
                               
                                   // Query the Assessment table to get the count of assessments for each lecturer for the current year
    $assessmentCountReport = Assesment::whereYear('date', $currentYear)
                                        ->where('status', 'Complete')
                                       ->select('LecturerName', 'Staff_No', DB::raw('COUNT(*) as assessment_count'))
                                       ->groupBy('LecturerName', 'Staff_No')
                                       ->get();
                               
                                   // Merge the evaluation, participant count, coordinator count, curriculum count, new curriculum count, and assessment count data into the lecturer report
                                   $lecturerReport = $lecturerReport->map(function ($lecturer) use (
                                       $evaluationReport,
                                       $participantCountReport,
                                       $coordinatorCountReport,
                                       $curriculumCountReport,
                                       $newCurriculumCountReport,
                                       $assessmentCountReport
                                   ) {
                                       // Find the corresponding evaluation for the lecturer based on both LecturerName and Staff_No
                                       $evaluation = $evaluationReport->firstWhere(function ($evaluation) use ($lecturer) {
                                           return $evaluation->LecturerName === $lecturer->LecturerName && $evaluation->Staff_No === $lecturer->Staff_No;
                                       });
                               
                                       // Find the corresponding participant count for the lecturer based on both LecturerName and Staff_No
                                       $participantCount = $participantCountReport->firstWhere(function ($participant) use ($lecturer) {
                                           return $participant->LecturerName === $lecturer->LecturerName && $participant->Staff_No === $lecturer->Staff_No;
                                       });
                               
                                       // Find the corresponding coordinator count for the lecturer
                                       $coordinatorCount = $coordinatorCountReport->firstWhere(function ($coordinator) use ($lecturer) {
                                           return $coordinator->LecturerName === $lecturer->LecturerName;
                                       });
                               
                                       // Find the corresponding curriculum count for the lecturer
                                       $curriculumCount = $curriculumCountReport->firstWhere(function ($curriculum) use ($lecturer) {
                                           return $curriculum->LecturerName === $lecturer->LecturerName && $curriculum->Staff_No === $lecturer->Staff_No;
                                       });
                               
                                       // Find the corresponding new curriculum count for the lecturer
                                       $newCurriculumCount = $newCurriculumCountReport->firstWhere(function ($newCurriculum) use ($lecturer) {
                                           return $newCurriculum->LecturerName === $lecturer->LecturerName && $newCurriculum->Staff_No === $lecturer->Staff_No;
                                       });
                               
                                       // Find the corresponding assessment count for the lecturer
                                       $assessmentCount = $assessmentCountReport->firstWhere(function ($assessment) use ($lecturer) {
                                           return $assessment->LecturerName === $lecturer->LecturerName && $assessment->Staff_No === $lecturer->Staff_No;
                                       });
                               
                                       // Add the relevant counts to the lecturer data
                                       $lecturer->total_evaluation_sum = $evaluation ? $evaluation->total_evaluation_sum : 0;
                                       $lecturer->participant_count = $participantCount ? $participantCount->participant_count : 0;
                                       $lecturer->coordinator_count = $coordinatorCount ? $coordinatorCount->coordinator_count : 0;
                                       $lecturer->curriculum_count = $curriculumCount ? $curriculumCount->curriculum_count : 0;
                                       $lecturer->new_curriculum_count = $newCurriculumCount ? $newCurriculumCount->new_curriculum_count : 0;
                                       $lecturer->assessment_count = $assessmentCount ? $assessmentCount->assessment_count : 0;
                               
                                       // Calculate the evaluation percentage: (total_evaluation_sum / (50 * participant_count)) * 100
                                       $lecturer->evaluation_percentage = ($lecturer->participant_count > 0) 
                                           ? ($lecturer->total_evaluation_sum / (50 * $lecturer->participant_count)) * 100 
                                           : 0;
                               
                                       return $lecturer;
                                   });
                               
                                   // Return the view with the updated lecturerReport
                                   return view('Report.monthly', compact('lecturerReport'));
                               }
public function sixMonthlyload()
{
  $user = Auth::guard('admin')->user();
                               
                                   // Define the allowed roles
  $allowedRoles = ['Admin', 'dex', 'DAA', 'DAAassistant'];
                               
                                   // Check if the user is authenticated and has one of the allowed roles
 if (!$user || !in_array($user->role, $allowedRoles)) {
                                       // Redirect or show an error message if the user is not authorized
                                       return redirect()->route('DAA.Dashboard')->with('error', 'You are not authorized to access this page.');
                                   }
                               
 $currentDate = Carbon::now();
                                   $currentMonth = $currentDate->month;
                                   $currentYear = $currentDate->year;
                               
                                   // Get the last six months (including the current month)
                                   $lastSixMonths = [];
                                   for ($i = 0; $i < 6; $i++) {
                                       $lastSixMonths[] = $currentDate->copy()->subMonths($i)->format('Y-m');
                                   }
                               
                                   // Query the Timetable for the last six months, grouped by LecturerName and Staff_No
                                   $lecturerReport = Timetable::whereIn(DB::raw('DATE_FORMAT(Time_table_date, "%Y-%m")'), $lastSixMonths)
                                       ->select('LecturerName', 'Staff_No', DB::raw('SUM(No_of_hours) as total_hours'), DB::raw('DATE_FORMAT(Time_table_date, "%Y-%m") as month'))
                                       ->groupBy('LecturerName', 'Staff_No', DB::raw('DATE_FORMAT(Time_table_date, "%Y-%m")'))
                                       ->get();
                               
                                   // Query the Facilitator table for evaluated records in the last six months
                                   $evaluationReport = Facilitator::where('status', 'Evaluated')
                                       ->whereIn(DB::raw('DATE_FORMAT(date, "%Y-%m")'), $lastSixMonths)
                                       ->select('LecturerName', 'Staff_No', DB::raw('SUM(punctuality + presentation_flow + handling_questions + active_participation_of_learners + use_of_visual_aids + relevance_of_subject_to_workplace + use_of_relevant_examples + knowledge_of_subject + treats_participants_with_dignity_and_respect + variety_and_appropriateness_of_training_methods) as total_evaluation_sum'), DB::raw('DATE_FORMAT(date, "%Y-%m") as month'))
                                       ->groupBy('LecturerName', 'Staff_No', DB::raw('DATE_FORMAT(date, "%Y-%m")'))
                                       ->get();
                               
                                   // Query the Facilitator table to get the participant count per lecturer for the last six months
                                   $participantCountReport = Facilitator::whereIn(DB::raw('DATE_FORMAT(date, "%Y-%m")'), $lastSixMonths)
                                       ->select('LecturerName', 'Staff_No', DB::raw('COUNT(*) as participant_count'), DB::raw('DATE_FORMAT(date, "%Y-%m") as month'))
                                       ->groupBy('LecturerName', 'Staff_No', DB::raw('DATE_FORMAT(date, "%Y-%m")'))
                                       ->get();
                               
                                   // Query the Coordinator table to count the number of programs coordinated per lecturer in the last six months
                                   $coordinatorCountReport = Coordinator::whereIn(DB::raw('DATE_FORMAT(date, "%Y-%m")'), $lastSixMonths)
                                       ->select('name as LecturerName', DB::raw('COUNT(*) as coordinator_count'), DB::raw('DATE_FORMAT(date, "%Y-%m") as month'))
                                       ->groupBy('LecturerName', DB::raw('DATE_FORMAT(date, "%Y-%m")'))
                                       ->get();
                               
                                   // Query the Curriculum table to get the count of curriculum entries for each lecturer for the last six months
                                   $curriculumCountReport = Curriculum::whereIn(DB::raw('DATE_FORMAT(date, "%Y-%m")'), $lastSixMonths)
                                       ->where('status', 'Complete')
                                       ->select('LecturerName', 'Staff_No', DB::raw('COUNT(*) as curriculum_count'), DB::raw('DATE_FORMAT(date, "%Y-%m") as month'))
                                       ->groupBy('LecturerName', 'Staff_No', DB::raw('DATE_FORMAT(date, "%Y-%m")'))
                                       ->get();
                               
                                   $newCurriculumCountReport = Newcurriculum::whereIn(DB::raw('DATE_FORMAT(date, "%Y-%m")'), $lastSixMonths)
                                       ->where('status', 'Complete')
                                       ->select('LecturerName', 'Staff_No', DB::raw('COUNT(*) as new_curriculum_count'), DB::raw('DATE_FORMAT(date, "%Y-%m") as month'))
                                       ->groupBy('LecturerName', 'Staff_No', DB::raw('DATE_FORMAT(date, "%Y-%m")'))
                                       ->get();
                               
                                   // Query the Assessment table to get the count of assessments for each lecturer for the last six months
                                   $assessmentCountReport = Assesment::whereIn(DB::raw('DATE_FORMAT(date, "%Y-%m")'), $lastSixMonths)
                                       ->where('status', 'Complete')
                                       ->select('LecturerName', 'Staff_No', DB::raw('COUNT(*) as assessment_count'), DB::raw('DATE_FORMAT(date, "%Y-%m") as month'))
                                       ->groupBy('LecturerName', 'Staff_No', DB::raw('DATE_FORMAT(date, "%Y-%m")'))
                                       ->get();
                               
                                   // Merge the evaluation, participant count, coordinator count, curriculum count, new curriculum count, and assessment count data into the lecturer report
                                   $lecturerReport = $lecturerReport->map(function ($lecturer) use (
                                       $evaluationReport,
                                       $participantCountReport,
                                       $coordinatorCountReport,
                                       $curriculumCountReport,
                                       $newCurriculumCountReport,
                                       $assessmentCountReport
                                   ) {
                                       $evaluationData = $evaluationReport->where('LecturerName', $lecturer->LecturerName)->where('Staff_No', $lecturer->Staff_No);
                                       $participantCountData = $participantCountReport->where('LecturerName', $lecturer->LecturerName)->where('Staff_No', $lecturer->Staff_No);
                                       $coordinatorCountData = $coordinatorCountReport->where('LecturerName', $lecturer->LecturerName);
                                       $curriculumCountData = $curriculumCountReport->where('LecturerName', $lecturer->LecturerName)->where('Staff_No', $lecturer->Staff_No);
                                       $newCurriculumCountData = $newCurriculumCountReport->where('LecturerName', $lecturer->LecturerName)->where('Staff_No', $lecturer->Staff_No);
                                       $assessmentCountData = $assessmentCountReport->where('LecturerName', $lecturer->LecturerName)->where('Staff_No', $lecturer->Staff_No);
                               
                                       // Add the relevant counts to the lecturer data
                                       $lecturer->total_evaluation_sum = $evaluationData->sum('total_evaluation_sum');
                                       $lecturer->participant_count = $participantCountData->sum('participant_count');
                                       $lecturer->coordinator_count = $coordinatorCountData->sum('coordinator_count');
                                       $lecturer->curriculum_count = $curriculumCountData->sum('curriculum_count');
                                       $lecturer->new_curriculum_count = $newCurriculumCountData->sum('new_curriculum_count');
                                       $lecturer->assessment_count = $assessmentCountData->sum('assessment_count');
                               
                                       // Calculate the evaluation percentage: (total_evaluation_sum / (50 * participant_count)) * 100
                                       $lecturer->evaluation_percentage = ($lecturer->participant_count > 0)
                                           ? ($lecturer->total_evaluation_sum / (50 * $lecturer->participant_count)) * 100
                                           : 0;
                               
                                       return $lecturer;
                                   });
                               
                                   // Return the view with the updated lecturerReport
                                   return view('Report.6monthly', compact('lecturerReport', 'lastSixMonths'));
}
public function yearlyload()
{
    $user = Auth::guard('admin')->user();

    // Define the allowed roles
    $allowedRoles = ['Admin', 'dex', 'DAA', 'DAAassistant'];

    // Check if the user is authenticated and has one of the allowed roles
    if (!$user || !in_array($user->role, $allowedRoles)) {
        // Redirect or show an error message if the user is not authorized
        return redirect()->route('DAA.Dashboard')->with('error', 'You are not authorized to access this page.');
    }

    $currentDate = Carbon::now();
    $currentYear = $currentDate->year;

    // Query the Timetable for the current year, grouped by LecturerName and Staff_No
    $lecturerReport = Timetable::whereYear('Time_table_date', $currentYear)
                               ->select('LecturerName', 'Staff_No', DB::raw('SUM(No_of_hours) as total_hours'))
                               ->groupBy('LecturerName', 'Staff_No')
                               ->get();

    // Query the Facilitator table for evaluated records in the current year
    $evaluationReport = Facilitator::where('status', 'Evaluated')
                                   ->whereYear('date', $currentYear)
                                   ->select(
                                       'LecturerName',
                                       'Staff_No',
                                       DB::raw('SUM(punctuality + presentation_flow + handling_questions + active_participation_of_learners + use_of_visual_aids + relevance_of_subject_to_workplace + use_of_relevant_examples + knowledge_of_subject + treats_participants_with_dignity_and_respect + variety_and_appropriateness_of_training_methods) as total_evaluation_sum')
                                   )
                                   ->groupBy('LecturerName', 'Staff_No')
                                   ->get();

    // Query the Facilitator table to get the participant count per lecturer
    $participantCountReport = Facilitator::whereYear('date', $currentYear)
                                         ->select('LecturerName', 'Staff_No', DB::raw('COUNT(*) as participant_count'))
                                         ->groupBy('LecturerName', 'Staff_No')
                                         ->get();

    // Query the Coordinator table to count the number of programs coordinated per lecturer in the current year
    $coordinatorCountReport = Coordinator::whereYear('date', $currentYear)
                                         ->select('name as LecturerName', DB::raw('COUNT(*) as coordinator_count'))
                                         ->groupBy('LecturerName')
                                         ->get();

    // Query the Curriculum table to get the count of curriculum entries for each lecturer for the current year
    $curriculumCountReport = Curriculum::whereYear('date', $currentYear)
                                       ->where('status', 'Complete')
                                       ->select('LecturerName', 'Staff_No', DB::raw('COUNT(*) as curriculum_count'))
                                       ->groupBy('LecturerName', 'Staff_No')
                                       ->get();

    // Query the NewCurriculum table for new curriculum count per lecturer for the current year
    $newCurriculumCountReport = Newcurriculum::whereYear('date', $currentYear)
                                             ->where('status', 'Complete')        
                                             ->select('LecturerName', 'Staff_No', DB::raw('COUNT(*) as new_curriculum_count'))
                                             ->groupBy('LecturerName', 'Staff_No')
                                             ->get();

    // Query the Assessment table to get the count of assessments for each lecturer for the current year
    $assessmentCountReport = Assesment::whereYear('date', $currentYear)
                                      ->where('status', 'Complete')
                                      ->select('LecturerName', 'Staff_No', DB::raw('COUNT(*) as assessment_count'))
                                      ->groupBy('LecturerName', 'Staff_No')
                                      ->get();

    // Merge the evaluation, participant count, coordinator count, curriculum count, new curriculum count, and assessment count data into the lecturer report
    $lecturerReport = $lecturerReport->map(function ($lecturer) use (
        $evaluationReport,
        $participantCountReport,
        $coordinatorCountReport,
        $curriculumCountReport,
        $newCurriculumCountReport,
        $assessmentCountReport
    ) {
        // Find the corresponding evaluation for the lecturer based on both LecturerName and Staff_No
        $evaluation = $evaluationReport->firstWhere(function ($evaluation) use ($lecturer) {
            return $evaluation->LecturerName === $lecturer->LecturerName && $evaluation->Staff_No === $lecturer->Staff_No;
        });

        // Find the corresponding participant count for the lecturer based on both LecturerName and Staff_No
        $participantCount = $participantCountReport->firstWhere(function ($participant) use ($lecturer) {
            return $participant->LecturerName === $lecturer->LecturerName && $participant->Staff_No === $lecturer->Staff_No;
        });

        // Find the corresponding coordinator count for the lecturer
        $coordinatorCount = $coordinatorCountReport->firstWhere(function ($coordinator) use ($lecturer) {
            return $coordinator->LecturerName === $lecturer->LecturerName;
        });

        // Find the corresponding curriculum count for the lecturer
        $curriculumCount = $curriculumCountReport->firstWhere(function ($curriculum) use ($lecturer) {
            return $curriculum->LecturerName === $lecturer->LecturerName && $curriculum->Staff_No === $lecturer->Staff_No;
        });

        // Find the corresponding new curriculum count for the lecturer
        $newCurriculumCount = $newCurriculumCountReport->firstWhere(function ($newCurriculum) use ($lecturer) {
            return $newCurriculum->LecturerName === $lecturer->LecturerName && $newCurriculum->Staff_No === $lecturer->Staff_No;
        });

        // Find the corresponding assessment count for the lecturer
        $assessmentCount = $assessmentCountReport->firstWhere(function ($assessment) use ($lecturer) {
            return $assessment->LecturerName === $lecturer->LecturerName && $assessment->Staff_No === $lecturer->Staff_No;
        });

        // Add the relevant counts to the lecturer data
        $lecturer->total_evaluation_sum = $evaluation ? $evaluation->total_evaluation_sum : 0;
        $lecturer->participant_count = $participantCount ? $participantCount->participant_count : 0;
        $lecturer->coordinator_count = $coordinatorCount ? $coordinatorCount->coordinator_count : 0;
        $lecturer->curriculum_count = $curriculumCount ? $curriculumCount->curriculum_count : 0;
        $lecturer->new_curriculum_count = $newCurriculumCount ? $newCurriculumCount->new_curriculum_count : 0;
        $lecturer->assessment_count = $assessmentCount ? $assessmentCount->assessment_count : 0;

        // Calculate the evaluation percentage: (total_evaluation_sum / (50 * participant_count)) * 100
        $lecturer->evaluation_percentage = ($lecturer->participant_count > 0) 
            ? ($lecturer->total_evaluation_sum / (50 * $lecturer->participant_count)) * 100 
            : 0;

        return $lecturer;
    });

    // Return the view with the updated lecturerReport
    return view('Report.Thisyear', compact('lecturerReport'));
}
public function showMonthlyWorkload(Request $request)
    {
        // Get the currently authenticated user
        $user = Auth::guard('admin')->user();

        // Define the allowed roles
        $allowedRoles = ['Admin', 'dex', 'DAA', 'DAAassistant'];

        // Check if the user is authenticated and has one of the allowed roles
        if (!$user || !in_array($user->role, $allowedRoles)) {
            // Redirect or show an error message if the user is not authorized
            return redirect()->route('DAA.Dashboard')->with('error', 'You are not authorized to access this page.');
        }

        // Get the selected month from the request (defaults to the current month if not selected)
        $month = $request->input('month', Carbon::now()->month);
        $year = Carbon::now()->year;

        // Query the Timetable for the selected month and year, grouped by LecturerName and Staff_No
        $lecturerReport = Timetable::whereYear('Time_table_date', $year)
                                   ->whereMonth('Time_table_date', $month)
                                   ->select('LecturerName', 'Staff_No', DB::raw('SUM(No_of_hours) as total_hours'))
                                   ->groupBy('LecturerName', 'Staff_No')
                                   ->get();

        // Query the Facilitator table for evaluated records in the selected month and year
        $evaluationReport = Facilitator::where('status', 'Evaluated')
                                       ->whereYear('date', $year)
                                       ->whereMonth('date', $month)
                                       ->select(
                                           'LecturerName',
                                           'Staff_No',
                                           DB::raw('SUM(punctuality + presentation_flow + handling_questions + active_participation_of_learners + use_of_visual_aids + relevance_of_subject_to_workplace + use_of_relevant_examples + knowledge_of_subject + treats_participants_with_dignity_and_respect + variety_and_appropriateness_of_training_methods) as total_evaluation_sum')
                                       )
                                       ->groupBy('LecturerName', 'Staff_No')
                                       ->get();

        // Query the Facilitator table to get the participant count per lecturer
        $participantCountReport = Facilitator::whereYear('date', $year)
                                             ->whereMonth('date', $month)
                                             ->select('LecturerName', 'Staff_No', DB::raw('COUNT(*) as participant_count'))
                                             ->groupBy('LecturerName', 'Staff_No')
                                             ->get();

        // Query the Coordinator table to count the number of programs coordinated per lecturer in the selected month
        $coordinatorCountReport = Coordinator::whereYear('date', $year)
                                             ->whereMonth('date', $month)
                                             ->select('name as LecturerName', DB::raw('COUNT(*) as coordinator_count'))
                                             ->groupBy('LecturerName')
                                             ->get();

        // Query the Curriculum table to get the count of curriculum entries for each lecturer for the selected month
        $curriculumCountReport = Curriculum::whereYear('date', $year)
                                           ->where('status', 'Complete')
                                           ->select('LecturerName', 'Staff_No', DB::raw('COUNT(*) as curriculum_count'))
                                           ->groupBy('LecturerName', 'Staff_No')
                                           ->get();

        // Query the Newcurriculum table for new curriculum entries
        $newCurriculumCountReport = Newcurriculum::whereYear('date', $year)
                                                 ->where('status', 'Complete')        
                                                 ->select('LecturerName', 'Staff_No', DB::raw('COUNT(*) as new_curriculum_count'))
                                                 ->groupBy('LecturerName', 'Staff_No')
                                                 ->get();

        // Query the Assesment table to get the count of assessments for each lecturer for the selected month
        $assessmentCountReport = Assesment::whereYear('date', $year)
                                          ->where('status', 'Complete')
                                          ->select('LecturerName', 'Staff_No', DB::raw('COUNT(*) as assessment_count'))
                                          ->groupBy('LecturerName', 'Staff_No')
                                          ->get();

        // Merge the evaluation, participant count, coordinator count, curriculum count, new curriculum count, and assessment count data into the lecturer report
        $lecturerReport = $lecturerReport->map(function ($lecturer) use (
            $evaluationReport,
            $participantCountReport,
            $coordinatorCountReport,
            $curriculumCountReport,
            $newCurriculumCountReport,
            $assessmentCountReport
        ) {
            // Find corresponding records for each lecturer
            $evaluation = $evaluationReport->firstWhere(function ($evaluation) use ($lecturer) {
                return $evaluation->LecturerName === $lecturer->LecturerName && $evaluation->Staff_No === $lecturer->Staff_No;
            });

            $participantCount = $participantCountReport->firstWhere(function ($participant) use ($lecturer) {
                return $participant->LecturerName === $lecturer->LecturerName && $participant->Staff_No === $lecturer->Staff_No;
            });

            $coordinatorCount = $coordinatorCountReport->firstWhere(function ($coordinator) use ($lecturer) {
                return $coordinator->LecturerName === $lecturer->LecturerName;
            });

            $curriculumCount = $curriculumCountReport->firstWhere(function ($curriculum) use ($lecturer) {
                return $curriculum->LecturerName === $lecturer->LecturerName && $curriculum->Staff_No === $lecturer->Staff_No;
            });

            $newCurriculumCount = $newCurriculumCountReport->firstWhere(function ($newCurriculum) use ($lecturer) {
                return $newCurriculum->LecturerName === $lecturer->LecturerName && $newCurriculum->Staff_No === $lecturer->Staff_No;
            });

            $assessmentCount = $assessmentCountReport->firstWhere(function ($assessment) use ($lecturer) {
                return $assessment->LecturerName === $lecturer->LecturerName && $assessment->Staff_No === $lecturer->Staff_No;
            });

            // Add the relevant counts to the lecturer data and calculate evaluation percentage
            $lecturer->total_evaluation_sum = $evaluation ? $evaluation->total_evaluation_sum : 0;
            $lecturer->participant_count = $participantCount ? $participantCount->participant_count : 0;
            $lecturer->coordinator_count = $coordinatorCount ? $coordinatorCount->coordinator_count : 0;
            $lecturer->curriculum_count = $curriculumCount ? $curriculumCount->curriculum_count : 0;
            $lecturer->new_curriculum_count = $newCurriculumCount ? $newCurriculumCount->new_curriculum_count : 0;
            $lecturer->assessment_count = $assessmentCount ? $assessmentCount->assessment_count : 0;

            // Calculate the evaluation percentage
            $lecturer->evaluation_percentage = ($lecturer->participant_count > 0)
                ? ($lecturer->total_evaluation_sum / (50 * $lecturer->participant_count)) * 100
                : 0;

            return $lecturer;
        });

        // Return the view with the updated lecturerReport
        return view('Reports.custom', compact('lecturerReport', 'month'));
    }


}
