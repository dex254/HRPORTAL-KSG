<?php

use App\Models\Weekly;
use App\Models\Assesment;
use App\Models\Experience;
use App\Models\Coremandate;
use App\Models\Examination;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HRController;
use App\Http\Controllers\EXTController;
use App\Http\Controllers\JobController;
//use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\NewController;
use App\Http\Controllers\RefController;
use App\Http\Controllers\BodyController;
use App\Http\Controllers\HRPUController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DeletController;
use App\Http\Controllers\DiaryController;
use App\Http\Controllers\OtherController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\WeeklyController;
use App\Http\Controllers\EXTjobsController;
use App\Http\Controllers\JobsextController;
use App\Http\Controllers\LicenceController;
use App\Http\Controllers\MedicalController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SpecialAssignment;
use App\Http\Controllers\SpecialController;
use App\Http\Controllers\AcademicController;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\ExternalController;
use App\Http\Controllers\passwordController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\ResearchController;
use App\Http\Controllers\TeachingController;
use App\Http\Middleware\DatatableMiddleware;
use App\Http\Controllers\AssesmentController;
use App\Http\Controllers\DatatableController;
use App\Http\Controllers\ExperinceController;

use App\Http\Controllers\MyprofileController;
use App\Http\Controllers\CarriculumController;
use App\Http\Controllers\ComingsoonController;
use App\Http\Controllers\PracticingController;
use App\Http\Controllers\AssociationController;
use App\Http\Controllers\ConsultancyController;
use App\Http\Controllers\CoremandateController;
use App\Http\Controllers\ExaminationController;
use App\Http\Controllers\FacilitatorController;
use App\Http\Controllers\TimetablingController;
use App\Http\Controllers\ParticipantsController;
use App\Http\Controllers\NewcurriculumController;
use App\Http\Controllers\EventevaluationController;
use App\Http\Controllers\ProfecionalbodyController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;




Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
                Route::get('HR/Login', [HRController::class, 'HRlogin'])->name('HR');
                Route::post('HR/Login', [HRController::class, 'login']);
                Route::get('HRPU/Login', [HRPUController::class, 'HRPUlogin'])->name('HRPU');
                Route::post('HRPU/Login', [HRPUController::class, 'Login']);
                Route::get('/otp', [HRController::class, 'showOTPForm'])->name('HR.OTP');
Route::post('/otp', [HRController::class, 'verifyOTP'])->name('OTP');
                Route::get('admin/Login', [AdminController::class, 'adminlogin'])->name('admin');
                Route::post('admin/Login', [AdminController::class, 'login']);
     Route::get('EXT/Login', [EXTController::class, 'EXTlogin'])->name('EXT');
    Route::post('EXT/Login', [EXTController::class, 'Loginext']);
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
Route::middleware('HR.auth')->group(function () {
    Route::get('The_application_dashboard', [HRController::class, 'HRDashboard'])->name('HR.Dashboard');
    Route::post('logout', [HRController::class, 'destroy'])->name('HR.logout');
    Route::get('Update_Profile', [MyprofileController::class, 'profileupdate'])->name('Myprofile.update');
    Route::put('Update_Profile', [HRController::class, 'updatemy'])->name('Myprofile.updatemy');
    Route::get('staff/edit/{uuid}', [StaffController::class, 'edit'])->name('staff.edit');
    Route::post('staff/edit/update/{uuid}',[StaffController::class, 'update'])->name('staff.edit.post');
    Route::get('My_profile',[MyprofileController::class, 'profile'])->name('Myprofile.home');
    Route::get('/Jobs_to_apply', [JobController::class, 'applicationts'])->name('JOB.applicants');
    Route::get('/Apply_for_the_job/{s_no}', [JobController::class, 'showApplyPage'])->name('JOB.Apply');
  Route::post('/Jobs_to_appl/{s_no}', [JobController::class, 'jobApply'])->name('JOB.apply');
  Route::get('/My_applications', [JobController::class, 'myApplications'])->name('JOB.Myapplicants');
  Route::get('/user-apply/pdf', [JobController::class, 'generateBioReport'])->name('user.apply');
  Route::get('/My_applications/{id}', [JobController::class, 'Applicationdetails'])->name('JOB.Applicationdetails');
  Route::delete('/job/application/delete/{id}', [JobController::class, 'abortApplication'])->name('JOB.abort');
  Route::get('/Academic_Qualifications', [AcademicController::class, 'Academic'])->name('Academic.data');
  Route::post('/Academic_Qualifications', [AcademicController::class, 'Academicpost'])->name('Academic.data');
  Route::post('/Academic_Qualifications', [AcademicController::class, 'Training'])->name('Academic.Training');
  Route::delete('/academic/{id}', [AcademicController::class, 'destroy'])->name('academic.destroy');
  Route::get('/Experince', [ExperinceController::class, 'Experince'])->name('Experience.data');
  Route::post('/Experince', [ExperinceController::class, 'Experincepost'])->name('Experince.data');
  //teaching
   
  
  Route::delete('/Experince/{id}', [ExperinceController::class, 'epdestroy'])->name('Experince.destroy');// Save profile data
  Route::get('/Complete_update', [ReportController::class, 'reportscomplete'])->name('Report.Complete');
  Route::get('/user-report/pdf', [ReportController::class, 'generateUserReport'])->name('user.report');
  Route::get('/Complete_final_report', [ReportController::class, 'finalcomplete'])->name('Final.Report');
  Route::get('/user-final/pdf', [ReportController::class, 'generateFinalReport'])->name('user.final');//delet account
  Route::get('/Special_experinc', [SpecialController::class, 'special'])->name('Special.Home');
  
  Route::post('/Special_experinc', [CoremandateController::class, 'specialpost'])->name('Special.Homepost');


   Route::delete('/coremandate/{id}', [CoremandateController::class, 'coredestroy'])->name('coremandate.destroy');
  Route::post('/Licence', [LicenceController::class, 'licencepost'])->name('Licence.licencepost');
  Route::delete('/licence/{id}', [LicenceController::class, 'destroy'])->name('licence.destroy');
  Route::get('/Delivery_of_core_mandate', [SpecialController::class, 'coremandate'])->name('Special.Coremandate');
  Route::get('/Member_of_a_Professional_Body', [SpecialController::class, 'professionalbody'])->name('Special.ProfessionalBody');
  Route::get('/Member_of_an_association', [SpecialController::class, 'association'])->name('Special.Association'); 
  Route::get('/Have_a_professional_licence', [SpecialController::class, 'licence'])->name('Special.Licence');
  Route::get('/Medical_examination', [SpecialController::class, 'medical'])->name('Special.Medical');//programs
    
Route::get('/Comingsoon/admin', [ ComingsoonController::class, 'admin'])->name('Comingsoon.admin');
Route::post('/Add_a_proffecional_info', [ProfecionalbodyController::class, 'proffecionalbody'])->name('Profecionalbody.save');
Route::delete('/Profecionalbody/{id}', [ProfecionalbodyController::class, 'destroybody'])->name('Profecionalbody.destroy');
Route::post('/Add_a_Medical_info', [MedicalController::class, 'create'])->name('Medical.Create');
Route::delete('/Medical/{id}', [MedicalController::class, 'destroymedical'])->name('Medical.destroy');
Route::post('/Add_an_association_info', [AssociationController::class, 'make'])->name('Association.Create');
Route::delete('/Association/{id}', [AssociationController::class, 'destroyassociation'])->name('Association.destroy');
//reserch  
Route::get('/Experince_Consultancy_&_Research_hr_staff', [ResearchController::class, 'ResearchHome'])->name('Research.Home');
Route::post('/Research/save', [ResearchController::class, 'Researchotherpost'])->name('Other.post.Researchsave');
  Route::post('/Experince_Research_staff', [ResearchController::class, 'Researchotherspost'])->name('Other.Research');
  Route::delete('/Experince_Research_KSG/{id}', [ResearchController::class, 'Researchdestroyother'])->name('Experience.Researchdestroyother');


});
Route::middleware('admin.auth')->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::post('admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');

    Route::post('admin/register/store', [AdminController::class, 'store'])->name('admin.register.store');
    Route::get('admin/register',[AdminController::class, 'index'])->name('admin.register');
    Route::post('admin/add_admin/store',[AdminController::class, 'store'])->name('admin.add.store');
    Route::get('/admin/add_admin',[AdminController::class, 'index2'])->name('admin.add');

    Route::get('admin/profile',[AdminController::class, 'profile'])->name('admin.profile');
    Route::delete('admin/admin/delete{id}', [AdminController::class, 'delete'])->name('admin.delete');
    Route::get('admin/profile/edit', [AdminController::class, 'selfedit'])->name('admin.profile.edit');
    Route::post('admin/profile/update',[AdminController::class, 'selfupdate'])->name('admin.profile.update.post');
    Route::post('admin/uadminupdate', [AdminController::class, 'uadminupdate'])->name('admin.uadminupdate');
    Route::get('Admin_accounts_update/{id}', [AccountsController::class, 'adminuser'])->name('Admin.accounts');
    Route::post('Admin_accounts_update/{id}', [AccountsController::class, 'updateadmin'])->name('Admin.accounts');
    //staff able  raute
    Route::get('Datatable/staff', [DatatableController::class, 'staffall'])->middleware(DatatableMiddleware::class);

    //admin records
    Route::get('Datatable/admin', [DatatableController::class, 'adminall'])->middleware(DatatableMiddleware::class);
    Route::get('/password/admin', [passwordController::class, 'passwordadmin'])->middleware(DatatableMiddleware::class);
    Route::get('password/staffedit/{email}', [passwordController::class, 'staffedit'])->name('password.staffedit');

    Route::post('password/staff/update/{email}', [passwordController::class, 'update'])->name('password.staff.update');
    //delet  admin user
    Route::delete('Datatable/admin/delete{id}', [AdminController::class, 'delete'])->name('admin.delete');


//cordination
//updates  on  the  data  manager  of  staff
Route::post('/hr/store', [HRController::class, 'hrnowstore'])->name('hr.store');
Route::put('hr/{id}/update', [HRController::class, 'hrnowupdate'])->name('hr.update');
Route::delete('/job/{s_no}/delete', [JobController::class, 'destroy'])->name('JOB.delete');



 
  //timetable

  Route::get('/Uplosd_the_staff_for_application', [HRController::class, 'exellupload'])->name('HR.exellupload');
  Route::post('/Uplosd_the_staff_for_application', [HRController::class, 'uploadExcel'])->name('HR.uploadExcel');
  Route::get('/All_the_staff_to_apply', [HRController::class, 'staffall'])->name('HR.staffdata');
  Route::get('/Create_a_new_jod_advart', [JobController::class, 'createjob'])->name('JOB.create');
  Route::post('/Create_a_new_jod_advart', [JobController::class, 'createjobdata'])->name('JOB.createdata');
  Route::get('/List_of_jobs_advatised', [JobController::class, 'listedjob'])->name('JOB.listed');
  
  Route::get('/Job_details{s_no}', [JobController::class, 'detailsjob'])->name('JOB.details');
  Route::get('/Update_job_listed{s_no}', [JobController::class, 'updatejob'])->name('JOB.update');
  Route::put('/Update_job_listed{s_no}', [JobController::class, 'updatejobdata'])->name('JOB.update');
  Route::get('/Jobs_applied_to', [JobController::class, 'adminApplications'])->name('JOB.adminapplicatins');
  Route::get('/Jobs_applied_to/{upn_no}', [JobController::class, 'Veiwapplicatnts'])->name('JOB.Veiwapplicatnts');
  Route::get('/Appicat_details/{ref_no}', [JobController::class, 'ApplicantsDetail'])->name('JOB.Applicantsdetails');
  Route::get('/Upload_profesionalbodies', [ProfecionalbodyController::class, 'exellbody'])->name('Profecionalbody.Upload');
  Route::post('/Upload_profesionalbodies', [ProfecionalbodyController::class, 'body'])->name('Profecionalbody.Upload');
  

Route::post('/schedule-interview/{id}', [JobController::class, 'scheduleInterview'])->name('schedule.interview');
Route::post('/reject-application/{id}', [JobController::class, 'rejectApplication'])->name('reject.application');
Route::get('/Qualified_Canidates', [ReportController::class, 'qualifiedApplicants'])->name('Applications.Qualified ');
Route::get('/NotQualified_Canidates', [ReportController::class, 'NotqualifiedApplicants'])->name('Applications.NotQualified ');
Route::post('/Provide_proffecional_info', [ReportController::class, 'addJob'])->name('Report.addjob');
Route::get('/Provide_proffecional_info', [ReportController::class, 'addJobget'])->name('Report.addjob');
//
Route::get('/Create_a_new_jod_advart_ext', [JobsextController::class, 'createjobext'])->name('JOB.createext');
  Route::post('/Create_a_new_jod_advart_ext', [JobsextController::class, 'createjobdataext'])->name('JOB.createdataext');
  Route::get('/List_of_jobs_advatised_ext', [JobsextController::class, 'listedjobext'])->name('JOB.Extlisted');
  
  Route::get('/Job_details_EXT/{id}', [JobsextController::class, 'detailsjobext'])->name('JOB.Ext.Detail');
  Route::get('/Update_job_listed{id}', [JobController::class, 'updatejobext'])->name('JOB.updateext');
 Route::put('/Update_job_listed/{id}', [JobsextController::class, 'updatejobdataext'])->name('JOB.updateext');

 Route::get('/Adjunct_Faculty_applications', [OtherController::class, 'applicatinsadj'])->name('HRPU.Applications');
 Route::get('/Adjunct_Faculty', [OtherController::class, 'mailupdate'])->name('HRPU.Admin');
 Route::put('/hrpu/update-email/{id}', [OtherController::class, 'updateEmail'])->name('hrpu.updateEmail');
 //external
 Route::get('/Create_a_new_jod_ext_advart', [EXTjobsController::class, 'extcreatejobext'])->name('EXT.Application.create');
  Route::post('/Create_a_new_jod_ext_advart', [EXTjobsController::class, 'extcreatejobdataext'])->name('EXT.JOB.create');
  Route::get('/List_of_jobs_External', [EXTjobsController::class, 'extlistedjob'])->name('EXT.Application.listed');
    Route::get('/Job_external_detailse{id}', [EXTjobsController::class, 'extdetailsjobext'])->name('EXT.Application.detail');
  Route::get('/Update_job_external_listed{id}', [EXTjobsController::class, 'extupdatejobext'])->name('EXT.Application.Update');
 Route::put('/Update_job_external_listed/{id}', [EXTjobsController::class, 'extupdatejobdataext'])->name('EXT.Update.ext');

 //ext
 Route::get('/External_applications', [EXTjobsController::class, 'extapplicatinsadj'])->name('EXT.Admin.Ext');
 Route::get('/External_Users', [EXTjobsController::class, 'extmailupdate'])->name('EXT.Admin.Users');
 Route::put('/External/update-email/{id}', [EXTjobsController::class, 'extupdateEmail'])->name('ext.updateEmail');
 


});

Route::middleware(['hrpu.auth'])->group(function () {
    Route::get('/Dashboard', [HRPUController::class, 'hrpudashboard'])->name('HRPU.Dashboard');
    Route::post('/Logout', [HRPUController::class, 'hrpudestroy'])->name('HRPU.logout');
     Route::put('Update_Profile_KSG', [HRPUController::class, 'extupdatemy'])->name('Myprofile.extupdatemy');
     //Education
     Route::get('/Academic_Qualifications_KSG', [AcademicController::class, 'Academicext'])->name('Academic.Ext');
  Route::post('/Academic_Qualifications_KSG', [AcademicController::class, 'Academicpostext'])->name('Academic.Ext');
  Route::post('/Academic_Qualifications_KSG', [AcademicController::class, 'Trainingext'])->name('Academic.Trainingext');
  Route::delete('/academic_KSG/{id}', [AcademicController::class, 'destroyext'])->name('academic.destroyext');
  //
  Route::get('/Member_of_a_Professional_Body_KSG', [SpecialController::class, 'professionalbodyext'])->name('Special.ProfessionalBodyext');
  Route::post('/Add_a_proffecional_info_KSG', [ProfecionalbodyController::class, 'proffecionalbodyext'])->name('Profecionalbody.saveext');
Route::delete('/Profecionalbody_KSG/{id}', [ProfecionalbodyController::class, 'destroybodyext'])->name('Profecionalbody.destroyext');
//
 Route::get('/Experince_KSG', [ExperinceController::class, 'Experinceext'])->name('Experience.Ext');
  Route::post('/Experince_KSG', [ExperinceController::class, 'Experincepostext'])->name('Experince.Ext');
  Route::delete('/experience/{id}/delete-ext', [ExperinceController::class, 'epdestroyext'])
    ->name('Experience.destroyext');
    //teaching
    Route::get('/Teaching_Experince', [TeachingController::class, 'teachingExperince'])->name('Experience.Teaching');
  Route::post('/Teaching_Experince', [TeachingController::class, 'teachingExperincepost'])->name('Experince.Teaching');
  Route::delete('/teaching_experience/{id}/delete-ext', [TeachingController::class, 'teachingepdestroyext'])
    ->name('Experience.Teachingdestroyext');
 
  Route::get('/Experince_Consultancy_&_Research', [OtherController::class, 'other'])->name('Experience.Other');
Route::post('/other/save', [OtherController::class, 'otherpost'])->name('Other.post.save');
  Route::post('/Experince_Other', [OtherController::class, 'otherspost'])->name('Other.others');
  Route::delete('/Experince_KSG/{id}', [OtherController::class, 'destroyother'])->name('Experience.destroyother');
  //
   Route::get('/Complete_update_KSG', [ReportController::class, 'reportscompleteext'])->name('Report.Ext');
  Route::get('/user-report_KSG/pdf', [ReportController::class, 'generateUserReportext'])->name('user.reportother');
   Route::get('/Jobs_to_apply_KSG', [JobsextController::class, 'applicationtsext'])->name('JOB.applicantsext');
   
  
  //
   Route::post('/Jobs_to_apply_KSG/{id}', [JobsextController::class, 'jobApplyext'])->name('JOB.applyext');
   Route::get('/Apply_fot_the_ksg_job/{id}', [JobsextController::class, 'externalapply'])->name('JOB.Applyext');
  
   Route::get('/My_applications_KSG', [JobsextController::class, 'EXTMY'])->name('HRPU.Myapplicants');
    Route::get('/My_applications_KSG/{id}', [JobsextController::class, 'Applicationdetailsext'])->name('HRPU.Applicationdetails');
  Route::delete('/job/application_ksg/delete/{id}', [JobsextController::class, 'abortApplicationext'])->name('JOB.abortext');
  
});

Route::middleware('EXT.auth')->group(function () {
   Route::get('/Home', [EXTController::class, 'EXTdashboard'])->name('EXT.Dashboard');
    Route::post('/Sign_out', [EXTController::class, 'EXTdestroy'])->name('EXT.logout');
     Route::put('Update_Profile_application', [EXTController::class, 'extupdatemyEXT'])->name('Myprofile.EXT');
     //
      Route::get('/Academic_Qualifications_registration', [ExternalController::class, 'extAcademicext'])->name('EXT.Academic.Home');
  Route::post('/Academic_Qualifications_registration_', [ExternalController::class, 'extAcademicpostext'])->name('EXT.Academic.Ext');
  Route::post('/Academic_Qualifications_short', [ExternalController::class, 'extTrainingext'])->name('EXT.Academic.Trainingext');
  Route::delete('/academic_registration/{id}', [ExternalController::class, 'extdestroyext'])->name('EXT.academic.destroyext');
  //profecionall
  Route::get('/Member_of_a_Professional_Body_online', [BodyController::class, 'extprofessionalbodyext'])->name('EXT.Proffecional.Body');
  Route::post('/Add_a_proffecional_info_online', [BodyController::class, 'extproffecionalbodyext'])->name('EXT.Profecionalbody.saveext');
Route::delete('/Profecionalbody_online/{id}', [BodyController::class, 'extdestroybodyext'])->name('EXT.Profecionalbody.destroyext');
//experince  
Route::get('/Experince_online', [NewController::class, 'extExperinceext'])->name('EXT.Experince.New');
  Route::post('/Experince_online', [NewController::class, 'extExperincepostext'])->name('EXT.Experince.Ext');
  Route::delete('/experience_ONLINE/{id}/delete-ext', [NewController::class, 'extepdestroyext'])
    ->name('EXT.Experience.destroyext');

    //licence
    Route::get('/Have_a_professional_experince', [PracticingController::class, 'extlicence'])->name('EXT.Special.Licence');
    Route::post('/Licence_online', [PracticingController::class, 'extlicencepost'])->name('EXT.Licence.licencepost');
  Route::delete('/licence_online/{id}', [PracticingController::class, 'extdestroy'])->name('EXT.licence.destroy');
  //refreees
   Route::get('/Referees', [RefController::class, 'referees'])->name('EXT.Ref.User');
    Route::post('/Save_referees', [RefController::class, 'saveref'])->name('EXT.ref');
  Route::delete('/ref/{id}', [RefController::class, 'refdestroy'])->name('EXT.delete');
  //
   Route::get('/Complete_update_online', [NewController::class, 'extreportscompleteext'])->name('EXT.Report.User');
  Route::get('/user-report_online/pdf', [NewController::class, 'extgenerateUserReportext'])->name('user.EXTreport');
   Route::get('/Jobs_to_apply_online', [EXTjobsController::class, 'extapplicationtsext'])->name('EXT.Application.Jobs');
   
  
  //
   Route::post('/Jobs_to_apply_online/{id}', [EXTjobsController::class, 'extjobApplyext'])->name('EXT.Apply.Job');
   Route::get('/Apply_fot_the_job_online/{id}', [EXTjobsController::class, 'EXTAP'])->name('EXT.Application.Apply');
   Route::get('/My_applications_online', [EXTjobsController::class, 'EXTEXTMY'])->name('EXT.Application.MY');
    Route::get('/My_applications_details_online/{id}', [EXTjobsController::class, 'EXTApplicationdetailsext'])->name('EXT.Application.Details');
  Route::delete('/job/application_online/delete/{id}', [EXTjobsController::class, 'extabortApplicationext'])->name('MY.Delete');
  
  
  });
