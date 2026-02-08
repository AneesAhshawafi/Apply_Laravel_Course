@extends('master')

@section('traincourses List')
    الطلاب
@endsection
@section('active-nav')
    <li class="nav-item">
        <a href="{{ route('courses.index') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>إدارة الكورسات</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('students.index') }}" class="nav-link ">
            <i class="far fa-circle nav-icon"></i>
            <p>إدارة الطلاب</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('training_courses.index') }}" class="nav-link active">
            <i class="far fa-circle nav-icon"></i>
            <p>إدارة الدورات التدريبية</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>إدارة الحجوزات</p>
        </a>
    </li>
@endsection
@section('content')
    <div class="col-12">
        <div class="card">
            @if(Session::has('success'))
                <div class="alert alert-success" role="alert" style="margin: 5px;">
                    {{ Session::get('success') }}
                </div>
            @endif
            <div class="card-header">
                <div class="card-tools" style="float: right;margin-left:30px">
                    <a href="{{ route('training_courses.index') }}" class="btn btn-sm btn-secondary" title="العودة">
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <h3 class="card-title" style="float: right;">تفاصيل الدورة التدريبية</h3>
                <a href="{{ route('training_courses.add_student', $trainCourse->id) }}" class="btn btn-sm btn-success"
                    style="float: left; margin-right: 10px;">
                    إضافة طالب للدورة التدريبية </a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>الرقم:</strong> {{ $trainCourse->id }}</p>
                        <p><strong>اسم الدورة:</strong> {{ $trainCourse->name }}</p>
                        <p><strong>الوصف:</strong> {{ $trainCourse->description }}</p>
                        <p><strong>السعر:</strong> {{ $trainCourse->price }}</p>
                        <p><strong>عدد الطلاب:</strong> {{ $trainCourse->students->count() }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>تاريخ البداية:</strong> {{ $trainCourse->start_date }}</p>
                        <p><strong>تاريخ النهاية:</strong> {{ $trainCourse->end_date }}</p>
                        <p><strong>تاريخ الإضافة:</strong> {{ $trainCourse->created_at->format('Y-m-d') }}</p>
                        <p><strong>تاريخ آخر تحديث:</strong> {{ $trainCourse->updated_at->format('Y-m-d') }}</p>
                        <p><strong>ملاحظة:</strong> {{ $trainCourse->note }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="float: right;">قائمة الطلاب المسجلين في الدورة</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>الرقم</th>
                            <th>اسم الطالب</th>
                            <th>تاريخ التسجيل</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trainCourse->students->sortByDesc('id') as $student)
                            <tr>
                                <td>{{ $student->id }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->pivot->enrolment_date }}</td>
                                <td>
                                    <a href="{{ route('training_courses.show_student', ['studentId' => $student->id, 'trainCourseId' => $trainCourse->id]) }}"
                                        class="btn btn-sm btn-info" title="عرض">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('training_courses.edit_enrolment', ['studentId' => $student->id, 'trainCourseId' => $trainCourse->id]) }}"
                                        class="btn btn-sm btn-warning" title="تعديل">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form
                                        action="{{ route('training_courses.delete_student', ['studentId' => $student->id, 'trainCourseId' => $trainCourse->id]) }}"
                                        method="GET" style="display: inline-block;margin: 5px;">
                                        @csrf

                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('هل أنت متأكد من حذف هذا الطالب من الدورة التدريبية')"
                                            title="حذف نهائياً">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection