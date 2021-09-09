<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reflection;
use App\Models\Student;
use App\Models\Assessment;
use App\Models\Classes;
use App\Models\ReflectionDetail;


class ReflectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get the users id
        $id = Auth::user()->id;

        $reflections = Reflection::where('users_id', $id)->get();

        return view('Reflections.index', compact('reflections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:25|unique:reflections,title'
        ]);

        $filename = "";

        $reflection = Reflection::create([
            'title' => $request->title,
            'description' => $request->description,
            'users_id'  => Auth::user()->id,
            'class_id'  => $request->class_id,
            'year_id'   => $request->year_id,
            'resources' => null
        ]);

        $reflection->students()->attach($request->studentName);


        foreach($request->assigment as $assignment){
            if($assignment['name'] != ""){

                $assessment = Assessment::create([
                    'name'    => $assignment['name'],
                    'user_id' =>Auth::user()->id,
                ]);

                ReflectionDetail::create([
                    'assessment_id' => $assessment->id,
                    'reflection_id' => $reflection->id
                ]);
            }
        };

        $filename = "";

        // check form has a file
        if($request->hasFile('resources'))
        {
            $file =  $request->file('resources');
            $filename = md5(time()).'.'.$file->getClientOriginalExtension();
            $filePath = public_path('/reflection-documents');
            $file->move($filePath,$filename);
        }

        //update the file path
        $reflection->update([
            'resources' => $filename
        ]);

        session()->flash('success','Reflection Created');
        return redirect()->back();

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
        $request->validate([
            'title' => 'required|string|max:25|unique:reflections,title'
        ]);

        $filename = "";

        $reflection = Reflection::findOrFail($id);

        $reflection->update([
            'title' => $request->title,
            'description' => $request->description,
            'users_id'  => Auth::user()->id,
            'class_id'  => $request->class_id,
            'year_id'   => $request->year_id,
            'resources' => null
        ]);

        if($request->studentName){
            $reflection->students()->detach();

            $reflection->students()->attach($request->studentName);
        }

        foreach($request->assigment as $assignment){
            if($assignment['name'] != ""){

                $assessment = Assessment::create([
                    'name'    => $assignment['name'],
                    'user_id' =>Auth::user()->id,
                ]);

                $reflection->reflectionDetails()->update([
                    'assessment_id' => $assessment->id,
                    'reflection_id' => $id
                ]);
            }
        };

        $filename = "";

        // check form has a file
        if($request->hasFile('resources'))
        {
            $file =  $request->file('resources');
            $filename = md5(time()).'.'.$file->getClientOriginalExtension();
            $filePath = public_path('/reflection-documents');
            $file->move($filePath,$filename);
        }

        //update the file path
        $reflection->update([
            'resources' => $filename
        ]);

        session()->flash('success','Reflection Updated');
        return redirect()->back();
    }

    public function reflectionView($id){

        $classes = Classes::all();
        $students = [];
        $year = "";
        $assessments = Assessment::all();
        $class_id = $id;

        if($id != 0){
            $class =  Classes::findOrFail($id);

            $students = $class->student;
            $year = $class->years->first();
        }

        return view('Reflections.create', compact('students', 'assessments', 'classes','class_id','year'));
    }

    public function viewReflection($id){

        $reflection = Reflection::findOrFail($id);

        return view('Reflections.show', \compact('reflection'));
    }

    public function editReflection($id){

        $reflection = Reflection::findOrFail($id);

        $classes = Classes::all();
        $students = [];
        $year = "";
        $assessments = Assessment::all();
        $class_id = $reflection->class_id;

        if($class_id != 0){
            $class =  Classes::findOrFail($class_id);

            $students = $class->student;
            $year = $class->years->first();
        }

        return view('Reflections.edit', compact('students', 'assessments', 'classes','class_id','year','reflection'));
    }

    public function deleteReflection($id){
        $reflection = Reflection::findOrFail($id);

        // delete reflection details
        //$reflection->reflectionDetails->delete();

        $reflection->students()->detach();

        $reflection->delete();

        return redirect(url('/reflections'));
    }
}
