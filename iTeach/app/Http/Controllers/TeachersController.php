<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Classes;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $teachers = Teacher::latest()->paginate(8);
        return view('Teachers.backend.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Teachers.backend.create');
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
            'gender'            => 'required|string',
            'phone'             => 'required|digits:11',
            'dateOfbirth'       => 'required|date',
            'current_address'   => 'required|string|max:30',
            'permanent_address' => 'required|string|max:30'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $user->teacher()->create([
            'gender'            => $request->gender,
            'phone'             => $request->phone,
            'dateOfbirth'       => $request->dateOfbirth,
            'current_address'   => $request->current_address,
            'permanent_address' => $request->permanent_address
        ]);

        $user->assignRole('Teacher');

        return redirect()->route('teachers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     *
     */
    public function show($id)
    {
        $teachers = Teacher::with('user')->findOrFail($id);
        //$test = 'Read';
        return view('Teachers.backend.show', compact('teachers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teachers = Teacher::with('user')->findOrFail($id);
        return view('Teachers.backend.edit')->with('teachers', $teachers);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name'              => 'required|string|max:10',
            'email'             => 'required|string|email|max:25|unique:users,email,' .$teacher->user_id,
            'gender'            => 'required|string',
            'phone'             => 'required|digits:11',
            'dateOfbirth'       => 'required|date',
            'current_address'   => 'required|string|max:255',
            'permanent_address' => 'required|string|max:255'
        ]);

        $user = User::findOrFail($teacher->user_id);

        $user->update([
            'name'              => $request->name,
            'email'             => $request->email,
            /* 'profile_picture'   => $profile */
        ]);

        $user->teacher()->update([
            'gender'            => $request->gender,
            'phone'             => $request->phone,
            'dateOfbirth'       => $request->dateOfbirth,
            'current_address'   => $request->current_address,
            'permanent_address' => $request->permanent_address
        ]);

        return redirect()->route('teachers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Teacher::findOrFail($id)->delete();
        return redirect(route('teachers.index'));

    }

    // get class by teachers
    public function classByTeacher(){

        //check auth user is a teacher
        $teacher =  Teacher::where('user_id', Auth::user()->id)->first();

        // if user is a teacher then get classess
        if($teacher){
            $classes = Classes::where('teacher_id', $teacher->id)->get();
        }

        return view('Teachers.teacherClasses', compact(['classes']));
    }
}
