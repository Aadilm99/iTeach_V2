<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Parents;

class AssignRoleController extends Controller
{

    public function index()
    {
        $users = User::with('roles')->latest()->paginate(5);
        // dd($users);
        return view('Roles.AssignRoles.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::latest()->get();

        return view('Roles.AssignRoles.create', compact('roles'));
    }

    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'password'  => 'required|string|min:8',
        ]);

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password)
        ]);

        // create teacher if role is teacher
        if($request->role == "Teacher"){
            Teacher::create([
                'user_id' => $user->id
            ]);
        }

        // create student if role is student
        if($request->role == "Student"){
            Student::create([
                'user_id' => $user->id
            ]);
        }

        // create student if role is parent
        if($request->role == "Parent"){
            Parents::create([
                'user_id' => $user->id
            ]);
        }

        $user->assignRole($request->role);

        return redirect('/assignrole');
    }

    public function edit($id)
    {
        $user = User::with('roles')->findOrFail($id);
        $roles = Role::latest()->get();

        return view('Roles.AssignRoles.edit', compact('user','roles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email
        ]);

        $teacher = Teacher::where('user_id', $user->id)->first();
        $student = Student::where('user_id', $user->id)->first();
        $parents = Parents::where('user_id', $user->id)->first();

        if($request->selectedrole == "Teacher"){
            //dd($teacher);
            if($teacher){
                $teacher->update([
                    'user_id' => $user->id
                ]);
            }else if($student){

                // remove student from student table and insert teachers table
                $newteacher = Teacher::create([
                    'user_id' => $user->id,
                    'gender'  => $student->gender,
                    'phone'   => $student->phone,
                    'dateOfbirth' => $student->dateOfbirth,
                    'current_address' => $student->current_address,
                    'permanent_address' => $student->permanent_address
                ]);

                $student->forceDelete();

            }else if($parents){

                // delete parents data & assign to new teacher
                $newteacher = Teacher::create([
                    'user_id' => $user->id,
                    'gender'  => $parents->gender,
                    'phone'   => $parents->phone,
                    'dateOfbirth' => $parents->dateOfbirth,
                    'current_address' => $parents->current_address,
                    'permanent_address' => $parents->permanent_address,
                    'is_parent'  => 1
                ]);

                $parents->forceDelete();
            }
        }

        // create student if role is student
        if($request->selectedrole == "Student"){
            if($teacher){

                // create new student
                $newStudent = Student::create([
                    'user_id' => $user->id,
                    'gender'  => $teacher->gender,
                    'phone'   => $teacher->phone,
                    'dateOfbirth' => $teacher->dateOfbirth,
                    'current_address' => $teacher->current_address,
                    'permanent_address' => $teacher->permanent_address
                ]);

                $teacher->forceDelete();

            }else if($student){
                $student->update([
                    'user_id' => $user->id
                ]);
            }else if($parents){

                $newStudent = Student::create([
                    'user_id' => $user->id,
                    'gender'  => $parents->gender,
                    'phone'   => $parents->phone,
                    'dateOfbirth' => $parents->dateOfbirth,
                    'current_address' => $parents->current_address,
                    'permanent_address' => $parents->permanent_address
                ]);

                $parents->forceDelete();
            }
        }

        // create student if role is parent
        if($request->selectedrole == "Parent"){
            if($teacher){

                $newParent = Parents::create([
                    'user_id' => $user->id,
                    'gender'  => $teacher->gender,
                    'phone'   => $teacher->phone,
                    'dateOfbirth' => $teacher->dateOfbirth,
                    'current_address' => $teacher->current_address,
                    'permanent_address' => $teacher->permanent_address
                ]);

                $teacher->forceDelete();

            }else if($student){

                $newParent = Parents::create([
                    'user_id' => $user->id,
                    'gender'  => $student->gender,
                    'phone'   => $student->phone,
                    'dateOfbirth' => $student->dateOfbirth,
                    'current_address' => $student->current_address,
                    'permanent_address' => $student->permanent_address
                ]);

                $student->forceDelete();

            }else if($parents){

                $parents->update([
                    'user_id' => $user->id
                ]);
            }
        }

        $user->syncRoles($request->selectedrole);

        return redirect()->route('assignrole.index');
    }


}
