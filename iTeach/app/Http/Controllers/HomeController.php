<?php

namespace App\Http\Controllers;
use App\Models\Parents;
use App\Models\Classes;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     public function home(){
        $parents = Parents::all();
        $teachers = Teacher::all();
        $students = Student::all();
        $classes = Classes::all();
        return view('/home', compact('parents', 'teachers', 'students', 'classes'));
     }

     public function teacher(){
        $teachers = Teacher::with('user')->latest()->get();
        return view('dashboard_panel.teacher')->with('teachers', $teachers);
    }

    /* public function showTeacherClasses(){
        $classes = Classes::findOrFail($id);
        $teachers = Teacher::where('id', '=' , $classes->teacher_id)->latest()->get();
        return view('dashboard_panel.teacher', compact('teacher', 'classes'));

    } */

    /* public function showClasses($id){

        $teachers = Teacher::with('user')->findOrfail($id);
        $classes = Classes::where('teacher_id', '=', $teachers->id);

        foreach($classes as $class){
            echo $class->title;
        }

        return view('dashboard_panel.teacher', compact('classes'));
    } */

    public function parents(){
        $parents = Parents::with('user')->latest()->get();
        return view('dashboard_panel.parents')->with('parents', $parents);
    }
}
