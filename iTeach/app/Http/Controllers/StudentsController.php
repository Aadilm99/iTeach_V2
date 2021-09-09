<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Classes;
use App\Models\Parents;
use App\Models\User;

use Illuminate\Support\Facades\Hash;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::latest()->paginate(8);
        return view('Students.backend.index')->with('students', $students);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $classes = Classes::all();
        $parents = Parents::all();

        return view('Students.backend.create', compact('classes', 'parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'              => 'required|string|max:10',
            'email'             => 'required|string|email|max:25|unique:users',
            'password'          => 'required|string|min:8',
            'class_id'        => 'required',
            'roll_number'       => 'required|numeric',
            'gender'            => 'required|string',
            'phone'             => 'required|digits:11',
            'dateOfbirth'       => 'required|date',
            'current_address'   => 'required|string|max:20',
            'permanent_address' => 'required|string|max:20'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $student = $user->student()->create([
            'parent_id'         => $request->parent_id,
            'class_id'          => $request->class_id,
            'roll_number'       => $request->roll_number,
            'gender'            => $request->gender,
            'phone'             => $request->phone,
            'dateOfbirth'       => $request->dateOfbirth,
            'current_address'   => $request->current_address,
            'permanent_address' => $request->permanent_address
        ]);

        if($request->hasFile('profile_picture'))
        {
            $file =  $request->file('profile_picture');
            $filename = md5(time()).'.'.$file->getClientOriginalExtension();
            $filePath = public_path('/profile-pic');
            $file->move($filePath,$filename);

            $user->update([
                'profile_pic' => $filename
            ]);
        }

        $student->classes()->attach($request->class_id);
        // $user->student()->sync(request('student_id')); */

        $user->assignRole('Student');

        return redirect('/students')->with('success', 'Student created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $students = Student::with('user')->findOrFail($id);

        $classes = Classes::where('id', $students->class_id)->get();
        $parents = Parents::with('user')->where('id', $students->parent_id)->get();

        return view('Students.backend.show', compact('parents', 'classes'))->with('students', $students);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $students = Student::with('user')->findOrFail($id);

        $classes = Classes::latest()->get();
        $parents = Parents::latest()->get();

        return view('Students.backend.edit', compact('students', 'classes', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $this->validate($request, [
            'name'              => 'required|string|max:10',
            'email'             => 'required|string|email|max:25|unique:users,email,' .$student->user_id,
            'class_id'          => 'required',
            'roll_number'       => 'required|numeric',
            'gender'            => 'required|string',
            'phone'             => 'required|digits:11',
            'dateOfbirth'       => 'required|date',
            'current_address'   => 'required|string|max:20',
            'permanent_address' => 'required|string|max:20'
        ]);

        $user = User::findOrFail($student->user_id);

        $user->update([
            'name'  =>  $request->name,
            'email' =>  $request->email
        ]);

        $user->student()->update([
            'parent_id'         => $request->parent_id,
            'class_id'          => $request->class_id,
            'roll_number'       => $request->roll_number,
            'gender'            => $request->gender,
            'phone'             => $request->phone,
            'dateOfbirth'       => $request->dateOfbirth,
            'current_address'   => $request->current_address,
            'permanent_address' => $request->permanent_address
        ]);


        if($request->hasFile('profile_picture'))
        {
            $file =  $request->file('profile_picture');
            $filename = md5(time()).'.'.$file->getClientOriginalExtension();
            $filePath = public_path('/profile-pic');
            $file->move($filePath,$filename);

            $user->update([
                'profile_pic' => $filename
            ]);
        }

        return redirect('/students')->with('Student successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Student::findOrFail($id)->delete();
        return redirect(route('students.index'));

    }
}
