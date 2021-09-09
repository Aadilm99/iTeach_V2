<?php

namespace App\Http\Controllers;

use App\Models\Parents;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Classes;


class DashboardController extends Controller
{
    public function index()
    {
        $parents = Parents::all();
        $teachers = Teacher::all();
        $students = Student::all();
        $classes = Classes::all();
        return view('dashboard_panel.admin', compact('parents', 'teachers', 'students', 'classes'));
    }



    /* public function teachers(){
        $teachers = Teacher::all();
        return view('Teachers.view')->with('teachers', $teachers);
    } */

    /* public function students(){
        $students = Student::all();
        return view('Students.view')->with('students', $students);
    } */

}
