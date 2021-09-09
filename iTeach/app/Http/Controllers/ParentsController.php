<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parents;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class ParentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parents = Parents::with(['user', 'children'])->latest()->paginate(8);
        return view('Parents.backend.index')->with('parents', $parents);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Parents.backend.create');
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
            'current_address'   => 'required|string|max:20',
            'permanent_address' => 'required|string|max:20',

        ]);

        $data = ['name' => $request->name, 'email' => $request->email, 'password' => Hash::make($request->password)];

        $user = User::create($data);

        $user->parent()->create([
            'gender'            => $request->gender,
            'phone'             => $request->phone,
            'dateOfbirth'       => $request->dateOfbirth,
            'current_address'   => $request->current_address,
            'permanent_address' => $request->permanent_address,

        ]);

        $user->assignRole('Parent');

        return redirect()->route('parents.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $parents = Parents::with('user')->findOrFail($id);
        return view('Parents.backend.show', compact('parents'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $parents = Parents::with('user')->findOrFail($id);
        return view('Parents.backend.edit', compact('parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param App\Models\Parents $parent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parents $parent)
    {
        $this->validate($request, [
            'name'              => 'required|string|max:10',
            'email'             => 'required|string|email|max:25|unique:users,email,' .$parent->user_id,
            'gender'            => 'required|string',
            'phone'             => 'required|digits:11',
            'dateOfbirth'       => 'required|date',
            'current_address'   => 'required|string|max:20',
            'permanent_address' => 'required|string|max:20',

        ]);

        $user = User::findOrFail($parent->user_id);

        /* $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]); */

        $user->update($request->all());


        $user->parent()->update([
            'gender'            => $request->gender,
            'phone'             => $request->phone,
            'dateOfbirth'       => $request->dateOfbirth,
            'current_address'   => $request->current_address,
            'permanent_address' => $request->permanent_address,

        ]);

        //$user->parent()->update($request->all());

        return redirect()->route('parents.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Parents::findOrFail($id)->delete();
        return redirect(route('parents.index'));
    }


     // get children
     public function children(){

        //check auth user is a teacher
        $parent =  Parents::where('user_id', Auth::user()->id)->first();
        //$classes;
        // if user is a parent then get children
        if($parent){
            $students = Student::where('parent_id', $parent->id)->get();
        }

        return view('Parents.children', compact(['students']));
    }
}
