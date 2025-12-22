<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Diary;
use App\Models\Staff;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class StaffController extends Controller
{
    //
    public function stafflogin()
    {
        return view('staff.login'); // Assuming 'Staff.login' is the name of your login page view
    }
    public function index()
    {
        return view('staff.register');
    }
    //registration log
    public function store(Request $request)
    {
        // Validate form inputs
        $validatedData = $request->validate([
            'name' => 'required|string',
            'idnumber' => 'required|string|unique:staff',
            'phone' => 'required|string|unique:staff',
            'email' => 'required|string|unique:staff',
            'department' => 'required|string',
            'campus' => 'required|string',
            'usertype' => 'required|string',
            'password' => 'required|string',
            'image' => 'nullable',


                ]);
                $existingstaff = Staff::where('name', $validatedData['name'])
                ->orWhere('email', $validatedData['email'])
                ->orWhere('phone', $validatedData['phone'])
                ->orWhere('idnumber', $validatedData['idnumber'])
                ->first();
        
            if ($existingstaff) {
                return redirect()->back()->withErrors([
                    'name' => 'This name is already taken.',
                    'email' => 'This email is already registered.',
                    'phone' => 'This phone number is already registered.',
                    'idnumber' => 'This ID number is already in use.',
                ])->withInput(); // Keep the input values for the user
            }
        
            $imageName = null; // Default value for image

    if ($request->hasFile('image')) {
        $imageFile = $request->file('image');
        $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
        $destinationPath = public_path('profile');

        // Process the image using Intervention Image
        $image = Image::make($imageFile->getRealPath());

        // Resize to HD (1920x1080) while maintaining aspect ratio and preventing upscaling
        $image->resize(1920, 1080, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        // Save the processed image with 100% quality
        $image->save($destinationPath . '/' . $imageName, 100);
    }

        $staff = new Staff();
        $staff->name = $validatedData['name'];
        $staff->idnumber = $validatedData['idnumber'];
        $staff->phone = $validatedData['phone'];
        $staff->email = $validatedData['email'];
        $staff->department = $validatedData['department'];
        $staff->usertype = $validatedData['usertype'];
        $staff->campus = $validatedData['campus'];
        $staff->image = $imageName;
        $staff->Status = 'registered';

        $staff->password =  Hash::make($validatedData['password']);

        $staff->save();

        // Redirect back with a success message
        if ($staff->save()) {
            // Redirect back with a success message
            return redirect()->route('staff')->with('success', 'You have regisatred to the KSG MER  system. Welcome!');
        } else {
            // Redirect back with an error message in case of failure
            return redirect()->back()->withErrors([
                'general' => 'An error occurred while storing data. Please try again later.',
            ]);
        }
    }
 // StaffController.php

 public function checkName(Request $request)
{
    $name = $request->input('name');
    $exists = Staff::whereRaw('LOWER(name) = ?', [strtolower($name)])->exists();
    return response()->json(['exists' => $exists]);
}

public function checkEmail(Request $request)
{
    $email = $request->input('email');
    $exists = Staff::whereRaw('LOWER(email) = ?', [strtolower($email)])->exists();
    return response()->json(['exists' => $exists]);
}

public function checkPhone(Request $request)
{
    $phone = $request->input('phone');
    $exists = Staff::where('phone', $phone)->exists();

    return response()->json(['exists' => $exists]);
}

public function checkIdNumber(Request $request)
{
    $idnumber = $request->input('idnumber');
    $exists = Staff::where('idnumber', $idnumber)->exists();

    return response()->json(['exists' => $exists]);
}


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Find Staff by email
        $staff = Staff::where('email', $credentials['email'])->first();

        // Check if Staff exists and password matches
        if  ($staff && Hash::check($credentials['password'], $staff->password)) {
            Auth::guard('staff')->login($staff);
        
            // Set status to online
            $staff->is_online = true;
            $staff->login_time =Carbon::now('Africa/Nairobi'); 
            $staff->save();
            return redirect()->route('staff.Dashboard');
        } else {
            return redirect()->route('staff')->withErrors([
                'email' => 'The provided credentials are incorrect.',
            ]);
        }
    }

    public function staffDashboard(Request $request)
    {
        // Get the currently authenticated staff member
        $staff = Auth::guard('staff')->user();
        $Email = Auth::guard('staff')->user()->email;
         $diary = Diary::where('email', $Email)->get();

         // Count the diary entries for the authenticated user
         $diaryCount = $diary->count();
    
        // Pass the staff data (including image) to the view
        return view('staff.dashboard', compact('staff','diary', 'diaryCount'));// Example: Load Staff dashboard view
    }

    public function logout(Request $request)
    {

        $staff = Auth::guard('staff')->user();
        $staff = new Staff();
        if ($staff) {
        // Set status to offline
        $staff->is_online = false;
        $staff->logout_time = Carbon::now('Africa/Nairobi'); 
        $staff->save();
    }
        Auth::guard('staff')->logout();
        // Logout the Staff user
        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate the CSRF token

        return redirect()->route('/staff/Login'); // Redirect to Staff login page
    }
    public function destroy(Request $request)
    {
        $staff = Auth::guard('staff')->user();
        
        if ($staff) {
        // Set status to offline
        
        $staff->is_online = false;
        $staff->logout_time =Carbon::now('Africa/Nairobi'); 
        $staff->save();
    }
        Auth::guard('staff')->logout(); // Logout the Staff user
        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate the CSRF token

        return redirect()->route('staff'); // Redirect to Staff login page
    }
    public function profile(Request $request)

    {
    $staff = $request->staff;
    $staff = Auth::guard('staff')->user();


    // Return a response or pass the data to the view
    return view('staff.profile', compact('staff'));

    }
    public function passedit()
    {

        $staff = Auth::guard('staff')->user();

        return view('staff.passedit', compact('staff'));

    }

    public function passupdate(Request $request)
    {
        // Validate the input
        $request->validate([
            'cpassword' => 'required',
            'npassword' => 'required|string|min:8|confirmed',
        ]);

        $staff = Auth::guard('staff')->user();

        // Check if the current password is correct
        if (!Hash::check($request->cpassword, $staff->password)) {
            return back()->withErrors(['cpassword' => 'The current password is incorrect.']);
        }

        // Update the password
        $staff->password = Hash::make($request->npassword);
        
        $staff->save();

        return back()->with('success', 'Password updated successfully.');
    }
    public function userupdate(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);
    
        
        $staff = Auth::guard('staff')->user();
    
        // Check if the provided current password matches the authenticated participant's password
        if (!Hash::check($request->current_password, $staff->password)) {
            return redirect()->back()->withErrors(['current_password' => 'The provided current password is incorrect.']);
        }
    
        // Update the participant's password
        $staff->password = Hash::make($request->password);
      
        $staff->save();
    
        return redirect()->route('staff')->with('success', 'Password updated successfully.');
    
    }
    public function selfedit()
    {
        $staff = Auth::guard('staff')->user();

        return view('staff.edit', compact('staff'));
    }
    public function selfupdate(Request $request)
    {
        // Handle GET request to fetch the check-in record
        $staff = Auth::guard('staff')->user();

        // Handle PUT request to update the check-in record
        $validatedData = $request->validate([

            'name' => 'nullable|string',
            
            'idnumber' => 'nullable|string|unique:staff,idnumber,'. $staff->id,
            'phone' => 'nullable|string|unique:staff,phone,'. $staff->id,
            'email' => 'nullable|string|unique:staff,email,'. $staff->id,
            'department' => 'nullable|string',
            'usertype' => 'nullable|string',
          'campus' => 'nullable|string',
          'image' => 'nullable|image',

            // Add other validation rules as needed
        ]);
        if ($request->hasFile('image')) {
            // Get the image file from the request
            $imageFile = $request->file('image');
            
            // Generate a unique name for the image
            $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
            
            // Define the destination path to store the image
            $destinationPath = public_path('profile');
    
            // Open and process the image using Intervention Image
            $image = Image::make($imageFile->getRealPath());
    
            // Resize to HD (1920x1080) while maintaining aspect ratio and preventing upscaling
            $image->resize(1920, 1080, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();  // Prevent upscaling for smaller images
            });
    
            // Save the processed image with 100% quality (for high-definition)
            $image->save($destinationPath . '/' . $imageName, 100);  // You can use 'webp' or 'png' as needed
        }

        $staff->update([
            'name' => $validatedData['name'] ?? $staff->name,
            'idnumber' => $validatedData['idnumber'] ?? $staff->idnumber,
            'phone' => $validatedData['phone'] ?? $staff->phone,
            'email' => $validatedData['email'] ?? $staff->email,
            'department' => $validatedData['department'] ?? $staff->department,
            'designation' => $validatedData['designation'] ?? $staff->designation,
            'campus' => $validatedData['campus'] ?? $staff->campus,
            'image' =>isset($imageName) ? $imageName : $staff->image,
            'Status' => 'updated', // Update the image if a new one was uploaded
        ]);
    
        return redirect()->route('staff')->with('success', 'You have successfully updated your profile details.');
    }
    public function deleteAccount(Request $request)
{
    $request->validate([
        'password' => 'required|string',
        'confirm_deletion' => 'accepted', // Ensure the checkbox is checked
    ]);

    // Get the currently authenticated user
    $staff = Auth::guard('staff')->user();

    // Check if the password entered matches the user's current password
    if (!Hash::check($request->password, $staff->password)) {
        // If password does not match, return an error
        return back()->withErrors(['password' => 'The password you entered is incorrect.']);
    }

    // Delete the staff account from the database
    $staff->delete();

    // Log the user out
    Auth::logout();
    // Redirect to the home page or a confirmation page with a success message
    return redirect()->route('staff')->with('success', 'Your account has been successfully deleted.');
}

}
