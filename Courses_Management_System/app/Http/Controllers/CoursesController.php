<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Http\Requests\CoursesRequest;
use Illuminate\Support\Carbon;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        return view('courses.index', [
            'courses' => Course::orderBy('id', 'desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CoursesRequest $request)
    {
        if( Course::where('name', $request->name)->exists() ) {
            return redirect()->back()->withErrors(['name' => 'اسم الكورس موجود بالفعل'])->withInput();
        }
        Course::create([
            'name' => $request->name,
            'active' => $request->active
        ]);
        return redirect()->route('courses.index')->with('success', 'تم إضافة الكورس بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $course = Course::findOrFail($id);
        return view('courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CoursesRequest $request, string $id)
    {
        $course = Course::findOrFail($id);
        $course->update([
            'name' => $request->name,
            'active' => $request->active,
            'updated_at' => \Carbon\Carbon::now()
        ]);
        return redirect()->route('courses.index')->with('success', 'تم تحديث الكورس بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course=Course::withTrashed()->find($id);
        $course->forceDelete();
        return redirect()->back()->with('success', 'تم الحذف النهائي للكورس بنجاح');
    }
    public function delete($id)
    {
        $course=Course::find($id);
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'تم نقل الكورس الى سلة المهملات بنجاح');
    }
    public function trash()
    {
        $courses = Course::onlyTrashed()->get();
        return view('courses.trash',[
            'courses' => $courses
        ]);
    }
    public function restore($id)
    {
        Course::onlyTrashed()->where('id', $id)->restore();
        return redirect()->back()->with('success', 'تم استعادة الكورس بنجاح');
    }
}
