<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Requests\StudentRequest;
use Carbon\Carbon;
use App\Models\Country;
use App\Traits\GeneralTraits;
use App\Models\User;
use App\Notifications\CreateStudent;
use Illuminate\Support\Facades\Notification;

class StudentController extends Controller
{
    use GeneralTraits;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $this->Anees();
        $students = Student::orderBy('created_at', 'desc')->paginate(10);
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

        // //filled and isNotFilled Methods
        // if ($request->filled("name")) {
        //     $name = $request->name;
        // }

        // if ($request->isNotFilled("name")) {
        //     $name = "Samhoon";
        // }

        // if ($request->isNotFilled(["name", "phone"])) {
        //     $name = "Samhoon";
        //     $phone = "776434968";
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
            //accessing file ways
            $image = $request->file('image');
            // $image = $request->image;
            // return response()->json([
            //     "size" => $image->getSize(),
            //     "path" => $image->getRealPath(),
            //     "is valid" => $image->isValid(),

            // ]);


            $extention = strtolower($image->getClientOriginalExtension());
            $imageName = time() . '_' . $image->getClientOriginalName();
            //way 1
            $image->move(public_path('images/students'), $imageName);
            //way 2
            //$path= $image->store("images");//store the file in "root::storage\app\private\images" with automatic generatied file name and return the path in side the privte folder
            // $path = $image->storeAs("images", $imageName); //store the file in "root::storage\app\private\images" with the name I passed $iamgeName and return the path in side the privte folder
            $student->image = 'images/students/' . $imageName;
        } else {
            $student->image = null;
        }
        $student->save();
        //Send Notification to all users that new user has been created
        $users = User::select("id")->get();
        $content = "تم اضافة طالب جديد باسم " . $request->name;
        Notification::send($users, new CreateStudent($request->name, $content));
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
        return redirect()->route('students.index')->with('success', 'تم تعديل بيانات الطالب بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::find($id);
        $student->forceDelete();
        return redirect()->route('students.index')->with('success', 'تم حذف الطالب بنجاح');
    }
    public function delete($id)
    {
        $student = Student::find($id);
        $student->delete();
        return redirect()->route('students.index')->with('success', 'تم النقل الى سلة المهملات بنجاح');
    }
    public function trash()
    {
        $students = Student::onlyTrashed()->get();
        return view('students.trash', compact('students'));
    }
    public function restore($id)
    {
        $student = Student::onlyTrashed()->find($id)->restore();
        return redirect()->back()->with('success', 'تم استعادة البيانات بنجاح');
    }
    public function search(Request $request)
    {
        if ($request->ajax()) {

            $studentName = $request->name;
            $activationStatus = $request->activationStatus;
            if (empty($studentName)) {
                $field1 = 'id';
                $operator1 = '>';
                $value1 = 0;
            } else {
                $field1 = 'name';
                $operator1 = 'LIKE';
                $value1 = "%{$studentName}%";
            }
            if ($activationStatus == 'all') {
                $field2 = 'id';
                $operator2 = '>';
                $value2 = 0;
            } else {
                $field2 = 'active';
                $operator2 = '=';
                $value2 = $activationStatus;
            }
            $students = Student::where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->paginate(10);
            return view('students.search_by_name', compact('students'));
        }
        // $students = Student::where('name', $request->name)->get();
        // return view('')

    }
}
