<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Symfony\Component\Console\Output\ConsoleOutput;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Validator;

class LoggedUserProfileController extends Controller
{
     /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['loggeduser.change_password']]);
    }

    public function updateLoggedUserRecord(Request $request, $id) {
        $user = User::findOrFail($id);
        $output = new ConsoleOutput();

        $validator = $this->validate($request, [
            'lastname' => 'required|string|between:2,30',
            'othernames' => 'required|string|between:2,60',
            'email' => 'required|string|email|max:100',
            'phone' => 'required|string|numeric|min:11|unique:users',
            'dob' => 'required',
            'hire_date' => 'required',
            'address' => 'required|string|max:100',
            'employee_id' => 'required|string',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            "role_id" => 'required',
            "gender_id" => 'required',
        ]);

        $user->lastname = htmlspecialchars($request->lastname);
        $user->othernames = htmlspecialchars($request->othernames);
        $user->email = htmlspecialchars($request->email);
        $user->phone = htmlspecialchars($request->phone);
        $user->dob = htmlspecialchars($request->dob);
        $user->hire_date = htmlspecialchars($request->hire_date);
        $user->address = htmlspecialchars($request->address);
        $user->employee_id = htmlspecialchars($request->employee_id);
        $user->country_id = htmlspecialchars($request->country_id);
        $user->state_id = htmlspecialchars($request->state_id);
        $user->city_id = htmlspecialchars($request->city_id);
        $user->reports_to = htmlspecialchars($request->reports_to);
        $user->role_id = htmlspecialchars($request->role_id);
        $user->gender_id = htmlspecialchars($request->gender_id);

        if($user->save()) {
            $data = [
            'user' => User::find($id)->load('role')->load('country')->load('state')->load('city')->load('gender')->load('guarantors'),
            'message' => 'Account record was updated successfully.',
            'status' => 200
            ];
            return response()->json($data, 200);
        } else {
            $data = [
            'message' => 'Account record update attempt failed!',
            'status' => 400
            ];
            return response()->json($data, 400);
        }
    }

    public function changeLoggedUserPassword(Request $request, $id) {
        $user = User::findOrFail($id);

        $validator = $this->validate($request, [
            'old_password' => 'required',
            'confirm_password' => 'required|same:new_password',
            'new_password' => [
                'required',
                'string',
                'min:8',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
        ]);

        if ($user) {
            if (Auth::attempt(['email' => $user->email, 'password' => $request->old_password])) {
                $user->password = Hash::make($request->new_password);

                if ($user->save()) {
                    $data = [ 'message' => 'Password change was successfully.', 'status' => 200 ];
                    return response()->json($data, 200);
                } else {
                    $data = [ 'message' => 'Password change attempt failed!', 'status' => 400 ];
                    return response()->json($data, 400);
                }
            } else {
                $data = [ 'message' => 'Invalid Password! Password change  attempt failed.', 'status' => 400 ];
                return response()->json($data, 400);
            }
        } else {
            $data = [ 'message' => 'User record NOT found! Password change  attempt failed.', 'status' => 400 ];
            return response()->json($data, 400);
        }
        
    }

    public function changeLoggedUserProfilePhoto(Request $request, $id) {
        $user = User::findOrFail($id);
        $output = new ConsoleOutput();
        $currentImage = $user->photo;
        $image_name = '';
        $destination = $user->photo;

        $validator = $this->validate($request, [
            'file_upload' => 'image|mimes:jpg,jpeg,png,gif',
        ]);

        $image = $request->file('file_upload');

        if ($image) {
            $ext = $image->getClientOriginalExtension();
            $image_name = date("Ymdhis") . rand();
            $image_name = $image_name . "." . $image->getClientOriginalExtension();
            $destination = '/storage/images/uploads/profile/' . $image_name;
        }

        $user->photo = $destination;

        if ($request->content_type == 'application/json' ) {
            $user->photo = '/storage/images/uploads/profile/default_profile_image.png';
        }

        if ($user->save()) {
            if ($image) {
                if ( $currentImage != '/storage/images/uploads/profile/default_profile_image.png' ) {
                    Storage::disk('public')->delete($currentImage);
                }
                $image->move(public_path('/storage/images/uploads/profile/'), $image_name);
            }

            if ($request->content_type == 'application/json' ) {
                if ( $currentImage != '/storage/images/uploads/profile/default_profile_image.png' ) {
                    Storage::disk('public')->delete($currentImage);
                }
            }

            $data = [
                'user' => User::find($id)->load('role')->load('country')->load('state')->load('city')->load('gender')->load('guarantors'),
                'message' => 'Profile image was updated successfully.',
                'status' => 200
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Attempt to update profile image record failed!',
                'status' => 400
            ];
            return response()->json($data, 400);
        }
    }

    public function resetEmployeePassword(Request $request, $id) {

    }

}
