<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrainCourseRequest;
use Illuminate\Http\Request;
use App\Models\TrainCourse;
use App\Models\Course;
use App\Models\Student;
use App\Models\TrnCrsEnrolment;
use App\Http\Requests\TrnCrsRequest;
class TrainCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $traincourses = TrainCourse::orderBy('created_at', 'desc')->get();
        // $traincourses = TrainCourse::all();
        return view('training_courses.index', compact('traincourses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::select('id', 'name')->get();
        return view('training_courses.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TrainCourseRequest $request)
    {

        $trainCourse = TrainCourse::create($request->all());
        return redirect()->route('training_courses.index')->with('success', 'تم إضافة الدورة التدريبية بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $trainCourse = TrainCourse::find($id);
        return view('training_courses.show', compact('trainCourse'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $courses = Course::select('id', 'name')->get();
        $trainCourse = TrainCourse::find($id);
        return view('training_courses.edit', compact('trainCourse', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TrainCourseRequest $request, string $id)
    {
        $trainCourse = TrainCourse::find($id);
        $trainCourse->update($request->all());
        return redirect()->route('training_courses.index')->with('success', 'تم تحديث الدورة التدريبية بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $trainCourse = TrainCourse::withTrashed()->find($id);
        $trainCourse->forceDelete();
        return redirect()->route('training_courses.index')->with('success', 'تم حذف الدورة التدريبية بنجاح');
    }

    public function delete($id)
    {
        $trainCourse = TrainCourse::find($id);
        $trainCourse->delete();
        return redirect()->route('training_courses.index')->with('success', 'تم حذف الدورة التدريبية بنجاح');
    }
    public function trash()
    {
        $traincourses = TrainCourse::onlyTrashed()->get();
        return view('training_courses.trash', compact('traincourses'));
    }
    public function restore($id)
    {
        $trainCourse = TrainCourse::onlyTrashed()->find($id)->restore();
        return redirect()->back()->with('success', 'تم استعادة الدورة التدريبية بنجاح');
    }
    public function addStudent($id)
    {
        $students = Student::all();
        return view('training_courses.add_student', compact('students', 'id'));
    }
    public function addStudentStore(TrnCrsRequest $request, $id)
    {
        if (TrnCrsEnrolment::where('student_id', $request->student_id)->where('train_course_id', $id)->exists()) {
            return redirect()->back()->withErrors(['student_id' => 'الطالب مسجل بالفعل في هذه الدورة'])->withInput();
        }
        TrnCrsEnrolment::create([
            'train_course_id' => $id,
            'student_id' => $request->student_id,
            'enrolment_date' => $request->enrolment_date,
        ]);
        return redirect()->route('training_courses.show', $id)->with('success', 'تم إضافة الطالب للدورة التدريبية بنجاح');
    }
    public function editEnrolment($studentId, $trainCourseId)
    {
        $enrolment = TrnCrsEnrolment::where('student_id', $studentId)->where('train_course_id', $trainCourseId)->first();
        $students = Student::all();
        return view('training_courses.edit_enrolment', ['enrolment' => $enrolment, 'students' => $students]);
    }
    public function editEnrolmentUpdate(TrnCrsRequest $request, $id)
    {
        $enrolment = TrnCrsEnrolment::find($id);
        $enrolment->update([
            'train_course_id' => $request->train_course_id,
            'student_id' => $request->student_id,
            'enrolment_date' => $request->enrolment_date,
        ]);
        return redirect()->route('training_courses.show', $request->train_course_id)->with('success', 'تم تحديث تسجيل الطالب للدورة التدريبية بنجاح');
    }
    public function deleteStudent($studentId, $trainCourseId)
    {
        $student = TrnCrsEnrolment::where('student_id', $studentId)->where('train_course_id', $trainCourseId)->first();
        $student->delete();
        return redirect()->route('training_courses.show', $trainCourseId)->with('success', 'تم حذف الطالب من الدورة التدريبية بنجاح');
    }
    public function showStudent($studentId, $trainCourseId){
        $student = Student::find($studentId);
        return view('training_courses.show_student', compact('student','trainCourseId'));
    }
}
