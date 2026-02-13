<?php

use App\Http\Controllers\CoursesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Models\Course;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TrainCourseController;


// route::get('hi', function () {

// })->middleware('PoliceMan');

Route::get('/', function () {
    return view('home');
});

// // Language Switcher Route
// Route::get('change-language/{lang}', function ($lang) {
//     if (in_array($lang, ['ar', 'en'])) {
//         session(['locale' => $lang]);
//     }
//     return redirect()->back();
// })->name('change.language');

route::get('ar', function () {
    session()->put('locale', 'ar');
    return redirect()->back();
})->name('ar');

route::get('en', function () {
    session()->put('locale', 'en');
    return redirect()->back();
})->name('en');


Route::get('home', [HomeController::class, 'index'])->name('home');
Route::get('courses/trash', [CoursesController::class, 'trash'])->name('courses.trash');
Route::get('courses/delete/{id}', [CoursesController::class, 'delete'])->name('courses.delete');
Route::get('courses/restore/{id}', [CoursesController::class, 'restore'])->name('courses.restore');
Route::resource('courses', CoursesController::class);

route::get('students/trash', [StudentController::class, 'trash'])->name('students.trash');
route::get('students/delete/{id}', [StudentController::class, 'delete'])->name('students.delete');
route::get('students/restore/{id}', [StudentController::class, 'restore'])->name('students.restore');
route::post('students/search', [StudentController::class, 'search'])->name('students.search');
Route::resource('students', StudentController::class);

route::get('training_courses/trash', [TrainCourseController::class, 'trash'])->name('training_courses.trash');
route::get('training_courses/delete/{id}', [TrainCourseController::class, 'delete'])->name('training_courses.delete');
route::get('training_courses/restore/{id}', [TrainCourseController::class, 'restore'])->name('training_courses.restore');
route::get('training_courses/show/{id}', [TrainCourseController::class, 'show'])->name('training_courses.show');
route::get('training_courses/add_student/{id}', [TrainCourseController::class, 'addStudent'])->name('training_courses.add_student');
route::post('training_courses/add_student_store/{id}', [TrainCourseController::class, 'addStudentStore'])->name('training_courses.add_student_store');
route::get('training_courses/edit_enrolment/{studentId}/{trainCourseId}', [TrainCourseController::class, 'editEnrolment'])->name('training_courses.edit_enrolment');
route::post('training_courses/edit_enrolment_update/{id}', [TrainCourseController::class, 'editEnrolmentUpdate'])->name('training_courses.edit_enrolment_update');
route::get('training_courses/delete_student/{studentId}/{trainCourseId}', [TrainCourseController::class, 'deleteStudent'])->name('training_courses.delete_student');
route::get('training_courses/show_student/{studentId}/{trainCourseId}', [TrainCourseController::class, 'showStudent'])->name('training_courses.show_student');
Route::resource('training_courses', TrainCourseController::class);