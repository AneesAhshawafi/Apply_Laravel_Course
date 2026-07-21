<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Http\Requests\CoursesRequest;
use Illuminate\Support\Carbon;
use Nyholm\Psr7\Response;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // samhoon();
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

        // //start lesson 96
        // // // The anyFilled method returns true if any of the specified values is not an empty string:

        // // if ($request->anyFilled(['name', 'email'])) {
        // //     // TODO:
        // // }

        // // // The whenFilled method will execute the given closure if a value is present on the request and is not an empty string:

        // // $request->whenFilled('name', function (string $input) {
        // //     // ...
        // // });

        // // // A second closure may be passed to the whenFilled method that will be executed if the specified value is not "filled":

        // // $request->whenFilled('name', function (string $input) {
        // //     // The "name" value is filled...
        // // }, function () {
        // //     // The "name" value is not filled...
        // // });

        // // // To determine if a given key is absent from the request, you may use the missing and whenMissing methods:

        // // if ($request->missing('name')) {
        // //     // ...
        // // }

        // // $request->whenMissing('name', function () {
        // //     // The "name" value is missing...
        // // }, function () {
        // //     // The "name" value is present...
        // // });

        // $allData = $request->all();
        // //if the parameter "votes" exists on the request data: Merge the input (0) with the old data that came from the client, if not : add the parameter "votes" into the request
        // $request->merge(["votes" => 0]);
        // // if the parameter "votes" dose not exists on the request data  : add the parameter "votes" into the request, if it exists, leave everything as it is.
        // $request->mergeIfMissing(['votes' => 1]);
        // $request->mergeIfMissing(['user-id' => 0]);

        // return response()->json([
        //     "original request data" => $allData,
        //     "after merging " => $request->all()
        // ]);
        // //end lesson 96
        //start lesson 101
        // Sometimes you may wish to redirect the user to their previous location, such as
        // when a submitted form is invalid. You may do so by using the global back helper
        // function. Since this feature utilizes the session, make sure the route calling the back
        // function is using the web middleware group:
        // return back()->withInput();
        // return redirect()->route('courses.create');
        // return redirect()->route('courses.create')->withInput();
        //         If your route has parameters, you may pass them as the second argument to the route method:

        // For a route with the following URI: /profile/{id}

        // return redirect()->route('profile', ['id' => 1]);

        //         Redirecting to Controller Actions
        // You may also generate redirects to controller actions. 
        // To do so, pass the controller and action name to the action method:

        // use App\Http\Controllers\UserController;

        // return redirect()->action([UserController::class, 'index']);

        // If your controller route requires parameters, 
        // you may pass them as the second argument to the action method:

        // return redirect()->action(
        //     [UserController::class, 'profile'], ['id' => 1]
        // );

        //         Redirecting to External Domains
        // Sometimes you may need to redirect to a domain outside of your application. You may do so by calling the away method, which creates a RedirectResponse without any additional URL encoding, validation, or verification:

        // return redirect()->away('https://www.google.com');
        // end lesson 101

        if (Course::where('name', $request->name)->exists()) {
            return redirect()->back()->withErrors(['name' => 'اسم الكورس موجود بالفعل'])->withInput();
        }
        Course::create([
            'name' => $request->name,
            'active' => $request->active
        ]);
        // the following tow lines are instead of the third line 
        // $request->session()->flash('success', 'تم إضافة الكورس بنجاح');
        // return redirect()->route('courses.index');
        return redirect()->route('courses.index')->with('success', 'تم إضافة الكورس بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

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
        $course = Course::withTrashed()->find($id);
        $course->forceDelete();
        return redirect()->back()->with('success', 'تم الحذف النهائي للكورس بنجاح');
    }
    public function delete($id)
    {
        $course = Course::find($id);
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'تم نقل الكورس الى سلة المهملات بنجاح');
    }
    public function trash()
    {
        $courses = Course::onlyTrashed()->get();
        return view('courses.trash', [
            'courses' => $courses
        ]);
    }
    public function restore($id)
    {
        Course::onlyTrashed()->where('id', $id)->restore();
        return redirect()->back()->with('success', 'تم استعادة الكورس بنجاح');
    }
}
