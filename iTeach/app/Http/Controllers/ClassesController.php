<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\Teacher;
use App\Models\Years;
use App\Models\Student;
use Illuminate\Support\Facades\DB;



class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Classes::latest()->paginate(8);
        return view('Classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $years = Years::all();
        $teachers = Teacher::with('user')->latest()->get();

        return view('Classes.create', compact('years', 'teachers'));
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
            'title' => 'required|string|unique:classes,title|max:20',
            'description' => 'required|max:150',
            'teacher_id' => 'required'
        ]);

        $classes = Classes::create($request->all());


        if($request->hasFile('profile_picture'))
        {
            $file =  $request->file('profile_picture');
            $filename = md5(time()).'.'.$file->getClientOriginalExtension();
            $filePath = public_path('/profile-pic');
            $file->move($filePath,$filename);

            $classes->update([
                'profile_image' => $filename
            ]);
        }

        $classes->years()->sync(request('classes_id'));
        $classes->years()->sync(request('years_id'));

        return redirect('/classes')->with('success', 'Class Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        $class = Classes::findOrFail($id);
        $teacherId = $class->teacher_id;

        $teachers = Teacher::findOrFail($teacherId);

        $students = Student::where('class_id', $class->id)->get();

        $allStudents =  Student::all();

        return view('Classes.show', compact('teachers', 'class', 'students', 'allStudents'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $classes = Classes::findOrfail($id);
        $years = Years::latest()->get();
        $teachers = Teacher::latest()->get();


        return view('Classes.edit', compact('classes', 'years', 'teachers'));
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
        $this->validate($request, [
            'title' => 'required|string|max:20',
            'description' => 'required|max:150',
            'teacher_id' => 'required'
        ]);

        $classes = Classes::findOrFail($id);

        $classes->update($request->all());

        if($request->hasFile('profile_picture'))
        {
            $file =  $request->file('profile_picture');
            $filename = md5(time()).'.'.$file->getClientOriginalExtension();
            $filePath = public_path('/profile-pic');
            $file->move($filePath,$filename);

            $classes->update([
                'profile_image' => $filename
            ]);
        }

        $classes->years()->sync(request('classes_id'));
        $classes->years()->sync(request('years_id'));

        return redirect('/classes')->with('success', 'Class has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Classes::findOrFail($id)->delete();
        return redirect(route('classes.index'));
    }


    public function addStudent(Request $request){

        $class   = Classes::findOrFail($request->class_id);
        $student = Student::findOrFail($request->studentName);

        if(!$class->student->contains($request->studentName)){
            $class->student()->attach($request->studentName);

            session()->flash('success', 'Student'.' '.$student->user->name.' '.'Assigned!');

        }else{
            session()->flash('error', 'Student'.' '.$student->user->name.' '.'Already in this class!');
        }

        return redirect()->back();
    }

    public function removeStudent($id, $student){
        $removeStudent = DB::table('classes_student')->where('student_id', '=', $student)
                                                 ->where('classes_id', '=' , $id);

        $removeStudent->delete();
        // $class   = Classes::findOrFail($id);

        // $class->student()->detach();

        session()->flash('success', 'Students Removed !');
        return redirect()->back();
    }
}
