<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Years;

class YearGroupController extends Controller
{

    public function years(){

        return view('Years.index');
    }


    public function addYearGroup(Request $request){

        $this->validate($request, [
            'years' => 'in:KS1,KS2',
        ]);


        $years = new Years;
        $years->years = $request->input('years');

        if(Years::where("years" , "=" ,$years->years)->first() == null){

            $years->save();

             session()->flash('success','Year Group is Created');
             return redirect()->back();


        }
        else{

            session()->flash('error','Year Group already exists');

            return redirect()->back();
        }

    }
}
