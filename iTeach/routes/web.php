<?php

use App\Http\Controllers\AssessmentsController;
use App\Http\Controllers\AssignRoleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TeachersController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\ParentsController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\ReflectionsController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\YearGroupController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Models\Student;
use App\Models\Classes;
use Illuminate\Auth\Events\Login;
use App\Models\Teacher;
use App\Models\Assessment;
use App\Models\Reflection;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/', function () {
    return view('welcome');
});
 */

Auth::routes();

Route::get('/parent/dashboard', [HomeController::class, 'parents'])->name('parent.home');
Route::get('/teacher/dashboard', [HomeController::class, 'teacher'])->name('teacher.home');
/* Route::get('/teacher/dashboard/{$id}', [HomeController::class, 'showClasses'])/* ->name('teacher.myclasses')  */

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

/* Route::get('/dashboard/parents', [DashboardController::class, 'parents'])->name('dashboard.parent'); */
Route::get('/dashboard/teacher/view', [DashboardController::class, 'teachers'])->name('dashboard.teacher.view');
Route::get('/dashboard/students/view', [DashboardController::class, 'students'])->name('dashboard.student.view');

// get classes by teacher
Route::get('/class/from/teacher', [TeachersController::class, 'classByTeacher'])->name('class.from.teacher');
Route::get('/parent/child', [ParentsController::class, 'children'])->name('parent.child');

Route::resource('/teachers', TeachersController::class);
Route::resource('/parents', ParentsController::class);
Route::resource('/students', StudentsController::class);
Route::resource('/classes', ClassesController::class);

Route::post('/classes/student',[ClassesController::class, 'addStudent'])->name('classes.student');

Route::resource('/assessments', AssessmentsController::class);
Route::resource('/reflections', ReflectionsController::class);
Route::resource('/assignrole', AssignRoleController::class);

Route::post('/remove/student/{id}/{student}',[ClassesController::class, 'removeStudent'])->name('remove.student');


Route::get('reflections/by/class/{id}', [ReflectionsController::class, 'reflectionView'])->name('reflection.create');

Route::get('/roles-permissions', [PermissionsController::class, 'roles'])->name('roles-permissions');
    Route::get('/role-create', [PermissionsController::class, 'createRole'])->name('role.create');
    Route::post('/role-store', [PermissionsController::class, 'storeRole'])->name('role.store');
    Route::get('/role-edit/{id}', [PermissionsController::class, 'editRole'])->name('role.edit');
    Route::put('/role-update/{id}', [PermissionsController::class, 'updateRole'])->name('role.update');

    /* Route::get('/permission-create', [RolePermissionController::class, 'createPermission'])->name('permission.create');
    Route::post('/permission-store', [RolePermissionController::class, 'storePermission'])->name('permission.store');
    Route::get('/permission-edit/{id}', [RolePermissionController::class, 'editPermission'])->name('permission.edit');
    Route::put('/permission-update/{id}', [RolePermissionController::class, 'updatePermission'])->name('permission.update'); */

    Route::get('/yearGroup', [YearGroupController::class, 'years'])->name('yearGroup.index');

    Route::post('/addYearGroup', [YearGroupController::class, 'addYearGroup']);

/*
route::get('/dates', function(){


    echo Carbon::now()->format('d-m-y');



});
 */

/* Route::get('/date', function () {


    $date = Carbon::format('d-m-y');
    return $date;
}); */



/* Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); */

Route::get('/test/student', [TestController::class, 'index']);

Route::get('/test', [TestController::class, 'addStudent'])->name('students.display');

Route::get('/profile/user',[ProfileController::class, 'userProfile'])->name('user.profile');
Route::post('/profile/update',[ProfileController::class, 'updateProfile'])->name('update.profile');

Route::get('/reflection/view/{id}', [ReflectionsController::class, 'viewReflection'])->name('reflection.view');

Route::get('/reflection/edit/{id}', [ReflectionsController::class, 'editReflection'])->name('reflection.edit');
Route::post('/reflection/delete/{id}', [ReflectionsController::class, 'deleteReflection'])->name('reflection.delete');
 /* Route::get('/classese/{id}', function ($id) {


    $classes = Classes::find($id);


    foreach($classes->student as $student)
    {
        echo $student->dateOfbirth;   // Need to specify columns that you want to use from the table...
                                                                            // in the relationship method thats in the Model class.
    }
});


Route::get('/test/{id}', function($id){
    $teachers = Teacher::with('user')->findOrfail($id);

    $classes = Classes::where('teacher_id', '=', $teachers->id)->get();

    foreach($classes as $class){
        echo $class->title;
        echo $class->description;
    }
});
 */

 route::get('/test', function(){



 });
