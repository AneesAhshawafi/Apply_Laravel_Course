<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Requests\StudentRequest;
use Carbon\Carbon;
use App\Models\Country;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::orderBy('created_at', 'desc')->get();
        return view('students.index', ['students' => $students]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::select('id', 'name')->get();
        return view('students.create', ['countries' => $countries]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        //name	phone	active	image	address	notes	deleted_at	created_at	updated_at	
        // if (Student::where('name', $request->name)->exists()) {
        //     return redirect()->back()->withErrors(['name' => 'اسم الطالب موجود بالفعل'])->withInput();
        // }
        $student = new Student();
        $student->name = $request->name;
        $student->phone = $request->phone;
        $student->active = $request->active;
        $student->address = $request->address;
        $student->notes = $request->notes;
        $student->country_id = $request->country_id;
        $student->created_at = Carbon::now();
        $student->updated_at = Carbon::now();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extention = strtolower($image->getClientOriginalExtension());
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/students'), $imageName);
            $student->image = 'images/students/' . $imageName;
        } else {
            $student->image = null;
        }
        $student->save();
        return redirect()->route('students.index')->with('success', 'تم إضافة الطالب بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::find($id);
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = Student::find($id);
        $countries = Country::all();
        return view('students.edit', compact('student', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentRequest $request, string $id)
    {
        $student = Student::find($id);
        $student->name = $request->name;
        $student->phone = $request->phone;
        $student->active = $request->active;
        $student->address = $request->address;
        $student->notes = $request->notes;
        $student->country_id = $request->country_id;
        $student->updated_at = Carbon::now();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extention = strtolower($image->getClientOriginalExtension());
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/students'), $imageName);
            $student->image = 'images/students/' . $imageName;
        }
        $student->save();
        return redirect()->route('students.index')->with('success','تم تعديل بيانات الطالب بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::find($id);
        $student->forceDelete();
        return redirect()->route('students.index')->with('success','تم حذف الطالب بنجاح');
    }
    public function delete($id)
    {
        $student = Student::find($id);
        $student->delete();
        return redirect()->route('students.index')->with('success','تم النقل الى سلة المهملات بنجاح');
    }
    public function trash()
    {
        $students=Student::onlyTrashed()->get();
        return view('students.trash', compact('students'));
    }
    public function restore($id)
    {
        $student = Student::onlyTrashed()->find($id)->restore();
        return redirect()->back()->with('success','تم استعادة البيانات بنجاح');

    }
}
