<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CoursesRequest;
use Illuminate\Http\Request;

use App\Models\Course;

use Carbon\Carbon;

use Illuminate\Support\Facades\Route;

class CourseController extends Controller
{
    /**
     * Return a listing of the resource.
     */
    public function index()
    {
        $courses = Course::orderBy('id', 'desc')->paginate(8);
        // samhoon();
        return response()->json(
            [
                "status" => true,
                "data" => $courses
            ],
            200
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CoursesRequest $request)
    {

        $name = $request->name;
        $active = $request->active;
        if (Course::where("name", $name)->exists()) {
            return response()->json([
                "status" => false,
                "message" => "The course name is already exists"
            ], 422);
        }
        $course = new Course();
        $course->name = $name;
        $course->active = $active;
        $course->save();
        return response()->json(["status" => true, "message" => "The course added successfuly", "data" => $course], 201);
    }
    /**
     * Return the specified resource.
     */
    public function show(string $id)
    {
        $course = Course::find($id);
        if (!$course) {
            return response()->json([
                "status" => false,
                "message" => "The specific course does not exist"
            ], 404);
        }
        return response()->json([
            "status" => true,
            "data" => $course
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CoursesRequest $request, string $id)
    {

        $course = Course::find($id);
        if (!$course) {
            return response()->json([
                "status" => false,
                "message" => "The specific course does not exist"
            ], 404);
        }
        $course->update([
            'name' => $request->name,
            'active' => $request->active,
            'updated_at' => \Carbon\Carbon::now()
        ]);
        return response()->json([
            "status" => true,
            "message" => "The specific course was updated successfully",
            "data" => $course
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::withTrashed()->find($id);
        if (!$course) {
            return response()->json([
                "status" => false,
                "message" => "The specific course does not exist"
            ], 404);
        }
        $course->forceDelete();
        return response()->json([
            "status" => true,
            "message" => "The specific course was permenantly deleted"
        ], 200);
    }


    public function delete($id)
    {
        $course = Course::find($id);
        if (!$course) {
            return response()->json([
                "status" => false,
                "message" => "The specific course does not exist"
            ], 404);
        }
        $course->delete();
        return response()->json([
            "status" => true,
            "message" => "The specific course was moved to trash successfully"
        ], 200);
    }
    public function trash()
    {
        $courses = Course::onlyTrashed()->get();
        if (!$courses) {
            return response()->json([
                "status" => false,
                "message" => "There is no any trashed course"
            ], 200);
        }

        return response()->json([
            "status" => true,
            "data" => $courses
        ], 200);
    }
    public function restore($id)
    {
        $course = Course::onlyTrashed()->find($id);
        if (!$course) {
            return response()->json([
                "status" => false,
                "message" => "There is no any trashed course with this id {$id}"
            ], 404);
        }

        Course::onlyTrashed()->where('id', $id)->restore();
        return response()->json([
            'status' => true,
            "message" => "The course was restored successfully",
            'data' => $course
        ]);
    }
}
