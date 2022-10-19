<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\UserRole;
use App\Models\UserGuarantor;
use App\Models\Email;
use App\Models\ApplicationAttribute;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserRole as UserRoleResource;
use Symfony\Component\Console\Output\ConsoleOutput;
use Illuminate\Support\Facades\Storage;
use Validator;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $users = User::getAllEmployeesExceptSuperUser($request->query('role'));
      $roles = UserRole::getAllRolesExceptSuperUser();

      return response()->json([
          'users' => UserResource::collection($users),
          'roles' => UserRoleResource::collection($roles)
      ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $password = Str::random(10);

      $validator = $this->validate($request, [
        'lastname' => 'required|string|between:2,30',
        'othernames' => 'required|string|between:2,60',
        'email' => 'required|string|email|max:100|unique:users',
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

      $new_user = new User();

      $new_user->lastname = htmlspecialchars($request->lastname);
      $new_user->othernames = htmlspecialchars($request->othernames);
      $new_user->email = htmlspecialchars($request->email);
      $new_user->phone = htmlspecialchars($request->phone);
      $new_user->dob = htmlspecialchars($request->dob);
      $new_user->hire_date = htmlspecialchars($request->hire_date);
      $new_user->address = htmlspecialchars($request->address);
      $new_user->employee_id = htmlspecialchars($request->employee_id);
      $new_user->country_id = htmlspecialchars($request->country_id);
      $new_user->state_id = htmlspecialchars($request->state_id);
      $new_user->city_id = htmlspecialchars($request->city_id);
      $new_user->reports_to = htmlspecialchars($request->reports_to);
      $new_user->role_id = htmlspecialchars($request->role_id);
      $new_user->gender_id = htmlspecialchars($request->gender_id);
      $new_user->password = Hash::make($password);

      $upload = "";

      if ($request->is_file_set == "true") {
        $image = $request->file('file');
        $upload = $new_user->employee_id . Str::lower($new_user->lastname) . "." . $image->getClientOriginalExtension();
        $destination = '/storage/images/uploads/profile/' . $upload;
        $new_user->photo = $destination;
      } else {
        $new_user->photo = '/storage/images/uploads/profile/default_profile_image.png';
      }
      
      if($new_user->save()) {
        if ($request->is_file_set == "true") {
          $image->move(public_path('/storage/images/uploads/profile/'), $upload);
        }

        $guarantors = json_decode($request->guarantors);

        if (is_iterable($guarantors)) {
          foreach($guarantors as $guarantor) {
            if ($guarantor->fullname != null && $guarantor->email != null && $guarantor->phone != null) {
              $new_guarantor = new UserGuarantor();
              $new_guarantor->fullname = htmlspecialchars($guarantor->fullname );
              $new_guarantor->email = htmlspecialchars($guarantor->email);
              $new_guarantor->phone = htmlspecialchars($guarantor->phone);
              $new_guarantor->address = htmlspecialchars($guarantor->address);
              $new_guarantor->user_id = $new_user->id;
              $new_guarantor->save();
            }
          }
        }

        $fullname = $new_user->othernames . " " . $new_user->lastname;

        Email::initializeEmail([
          'from' => ((object)[ 'email' => ApplicationAttribute::getNoReplyFromEmail(), 'name' => ApplicationAttribute::getClientName() ]), 
          'to' => ((object)['email' => 'akugbeode@yahoo.com', 'name' => $fullname]),
          'name' => $fullname, 'employee_id' => $new_user->employee_id, 'password' => $password, 'email' => $new_user->email,
          'call_to_action' => ['cta_link' => $this->getEmployeeLoginURL(), 'cta_text' => "Click Here to Login" ]
        ])->employeeRegistrationDetails();


        $data = [
          'message' => 'Employee account record was created successfully.',
          'status' => 200
        ];
        return response()->json($data, 200);
      } else {
        $data = [
          'message' => 'Employee account record was NOT created!',
          'status' => 400
        ];
        return response()->json($data, 400);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      return response()->json(
        User::findOrFail($id)->load('role')->load('country')->load('state')->load('city')->load('gender')->load('guarantors'), 
        200
      );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $targetEmployee = User::findOrFail($id);
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

      $targetEmployee->lastname = htmlspecialchars($request->lastname);
      $targetEmployee->othernames = htmlspecialchars($request->othernames);
      $targetEmployee->email = htmlspecialchars($request->email);
      $targetEmployee->phone = htmlspecialchars($request->phone);
      $targetEmployee->dob = htmlspecialchars($request->dob);
      $targetEmployee->hire_date = htmlspecialchars($request->hire_date);
      $targetEmployee->address = htmlspecialchars($request->address);
      $targetEmployee->employee_id = htmlspecialchars($request->employee_id);
      $targetEmployee->country_id = htmlspecialchars($request->country_id);
      $targetEmployee->state_id = htmlspecialchars($request->state_id);
      $targetEmployee->city_id = htmlspecialchars($request->city_id);
      $targetEmployee->reports_to = htmlspecialchars($request->reports_to);
      $targetEmployee->role_id = htmlspecialchars($request->role_id);
      $targetEmployee->gender_id = htmlspecialchars($request->gender_id);

      if($targetEmployee->save()) {
        $data = [
          'message' => 'Employee record was updated successfully.',
          'status' => 200
        ];
        return response()->json($data, 200);
      } else {
        $data = [
          'message' => 'Employee record update attempt failed!',
          'status' => 400
        ];
        return response()->json($data, 400);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $targetEmployee = User::findOrFail($id);
      $imageName = $targetEmployee->photo;

      if ($targetEmployee->delete()) {
        if ($imageName != "/storage/images/uploads/profile/default_profile_image.png") {
          Storage::disk('public')->delete($imageName);
        }
        return response()->json(['message' => 'Employeee record was deleted successfully.'], 
          200
        );
      } else {
        return response()->json(['message' => 'Employeee record delete attempt failed.'], 
          400
        );
      }
    }

    public function getEmployeeLoginURL() {
      return asset("/");
    }
}
