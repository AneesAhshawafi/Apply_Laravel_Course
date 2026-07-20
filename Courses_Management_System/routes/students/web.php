<?php

use App\Http\Controllers\CoursesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Models\Course;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TrainCourseController;
use App\Http\Controllers\WelcomeController;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;

use Illuminate\Http\Request;
use Psr\Http\Message\ServerRequestInterface; //for PSR-7 
Route::middleware('cache.headers:public;max_age=30;s_maxage=300;stale_while_revalidate=600;etag')->group(function () {

    Route::get('welcome', [WelcomeController::class, 'index'])->middleware(['throttle:limit3']);
    // Route::get('welcomeFacde', [WelcomeController::class, 'myCustomFacade']);

    route::get('hi', function () {})->middleware('PoliceMan');
    Route::redirect('welcome', "hi", 302);
    Route::permanentRedirect('welcome', "hi");
    // Accessing the current route
    Route::get('getmyrouteinfo/{username}', [WelcomeController::class, "getMyRouteInfo"])->name("get_myroute_info");

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
    route::get('training_courses/add_student/{id}', [TrainCourseController::class, 'addStudent'])->name('training_courses.add_student');
    route::post('training_courses/add_student_store/{id}', [TrainCourseController::class, 'addStudentStore'])->name('training_courses.add_student_store');
    route::get('training_courses/edit_enrolment/{studentId}/{trainCourseId}', [TrainCourseController::class, 'editEnrolment'])->name('training_courses.edit_enrolment');
    route::post('training_courses/edit_enrolment_update/{id}', [TrainCourseController::class, 'editEnrolmentUpdate'])->name('training_courses.edit_enrolment_update');
    route::get('training_courses/delete_student/{studentId}/{trainCourseId}', [TrainCourseController::class, 'deleteStudent'])->name('training_courses.delete_student');
    route::get('training_courses/show_student/{studentId}/{trainCourseId}', [TrainCourseController::class, 'showStudent'])->name('training_courses.show_student');
    Route::resource('training_courses', TrainCourseController::class);


    Route::get("/tryCache", function () {
        return "Cache";
    });

    //Interacting with the request
    Route::get("/testrequest", function (Request $request) {
        // Type of headers:
        //1- Authorization
        // 2-User-Agent
        // 3-Accept
        // 4-Content-Type
        // 5-Set-Cookie
        // 6-Cache-Control
        // 7-Content-Length
        // 8-Content-Encoding
        // 9- X-CSRF-TOKEN
        // 10- X-App-Version
        $value1 = null;
        $value2 = null;
        // if ($request->hasHeader('Authorization')) {
        //     $value2 = $request->header('Authorization', 'default');
        //     $value1 = $request->header('Authorization');
        // }
        // if ($request->hasHeader('User-Agent')) {
        //     $value2 = $request->header('User-Agent', 'default');
        //     $value1 = $request->header('User-Agent');
        // }
        // if ($request->hasHeader('Accept')) {
        //     $value2 = $request->header('Accept', 'default');
        //     $value1 = $request->header('Accept');
        // }
        // if ($request->hasHeader('Content-Type')) {
        //     $value2 = $request->header('Content-Type', 'default');
        //     $value1 = $request->header('Content-Type');
        // }
        // if ($request->hasHeader('Set-Cookie')) {
        //     $value2 = $request->header('Set-Cookie', 'default');
        //     $value1 = $request->header('Set-Cookie');
        // }
        // if ($request->hasHeader('Cache-Control')) {
        //     $value2 = $request->header('Cache-Control', 'default');
        //     $value1 = $request->header('Cache-Control');
        // }
        // if ($request->hasHeader('Content-Length')) {
        //     $value2 = $request->header('Content-Length', 'default');
        //     $value1 = $request->header('Content-Length');
        // }
        // if ($request->hasHeader('Content-Encoding')) {
        //     $value2 = $request->header('Content-Encoding', 'default');
        //     $value1 = $request->header('Content-Encoding');
        // }
        // if ($request->hasHeader('X-CSRF-TOKEN')) {
        //     $value2 = $request->header('X-CSRF-TOKEN', 'default');
        //     $value1 = $request->header('X-CSRF-TOKEN');
        // }
        // if ($request->hasHeader('X-App-Version')) {
        //     $value2 = $request->header('X-App-Version', 'default');
        //     $value1 = $request->header('X-App-Version');
        // }


        if ($request->header("AppKey") == "Anees") {
            return response()->json(["data" => "Accepted Authorization"]);
        } else {
            return response()->json(["data" => "Unauthorizde"]);
        }
        return [
            "header1" => $value1,
            "header2" => $value2,
            "ip" => $request->ip(),
            "ips" => $request->ips(),
            "all" => $request->all(),
            "url" => $request->url(),
            "fullurl" => $request->fullUrl(),
            "uri" => $request->uri(),
            "path" => $request->path(),
            "method" => $request->method(),
            "host" => $request->host(),
            "server" => $request->server()

        ];
    });

    Route::get("/sendheader", function (Request $request) {
        return response("Hello Anees")->header("AppName", "Exchnage")->header("version", 3);
    });

    Route::get("/sendheadertome", function (Request $request) {
        $request->headers->set('XAppName', 'Anees Soft');
        $headerValue = $request->header("XAppName");

        // return response("Hello Anees")->header("AppName", "Exchnage")->header("version", 3);
    });

    Route::get("/content-negotiation", function (Request $request) {
        $accepetedContentTypes = $request->getAcceptableContentTypes();
        $preferred = $request->prefers(['text/html', 'application/json']);
        return response()->json(["preferred" => $preferred, "accepetedContentTypes" => $accepetedContentTypes]);
        if ($request->expectsJson()) {
            return response()->json(["preferred" => $preferred, "accepetedContentTypes" => $accepetedContentTypes]);
        }
        if ($request->accepts(["text/html", "application/xml"]))
            return [
                "accepted types" => $accepetedContentTypes
            ];
    });

    Route::get("PSR-7", function (ServerRequestInterface $request) {
        $method = $request->getMethod();
        $url = $request->getUri();
        $header = $request->getHeaders();

        return response()->json([
            "method" => $method,
            "url" => $url,
            "headers" => $header
        ]);
    });

    Route::get('/test-response-object', function () {
        return response('Hello World', 200)
            ->header('Content-Type', 'text/plain');
    });
    Route::get('/test-response-json', function () {
        return response()->json([
            "name" => "name",
            "ip" => "ip"
        ]);
    });

    // Attaching Headers to Responses
    // way 1
    // Route::get('/test-response-attaching-headers', function () {
    //     return response([
    //         "name" => "name",
    //         "ip" => "ip"
    //     ])
    //         ->header('Content-Type', "text/html")
    //         ->header('accept', 'application/json')
    //         ->header('X-Header-Two', 'Header Value');
    // });
    // way 2

    Route::get('/test-response-attaching-headers', function () {
        return response([
            "name" => "name",
            "ip" => "ip"
        ])->withHeaders([
            'Content-Type' => "text/html",
            'accept' => 'application/json',
            'X-Header-Two' => 'Header Value'
        ]);

        // // Removing headers

        // return response($content)->withoutHeader('X-Debug');

        // return response($content)->withoutHeader(['X-Debug', 'X-Powered-By']);
    });



    Route::get('/user/{user}', function (User $user) {
        return $user;
    });

    Route::get("/cookies", function () {

        // return response('Hello World')->cookie(
        //     'nameStu',
        //     'anees',
        //     1
        // );
        $cookie = Cookie(
            'name',
            'value',
            1, //minutes
            "path", //path
            null, //domain
            true, //secure
            true,
        ); //you can reuse it whenever you want inside this Route only 
        return response('Hello World')->cookie(
            $cookie
        );
        return response('Hello World')->cookie(
            'name',
            'value',
            1, //minutes
            "path", //path
            null, //domain
            true, //secure
            true, //httpOnly
        );
        // // Removing cookie
        // return response('Hello World')->withoutCookie('name');
    });
    Cookie::queue('name', 'value', 2); //It is activated with the first request the app recieve

    // If you do not yet have an instance of the outgoing response, you may use the Cookie facade's expire method to expire a cookie:

    // Cookie::expire('name');
    Route::fallback(function () {
        return "Not Found!";
    });
});
