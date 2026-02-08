@extends('master')
@section('title')
    تعديل تسجيل طالب
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
    <!-- general form elements -->
    <div class="card card-primary" style="width: 80%;">
        <div class="card-header">
            <h3 class="card-title" style="float: right;">تعديل تسجيل طالب</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <form action="{{route('training_courses.edit_enrolment_update', $enrolment->id)}}" method="POST">
            @csrf
            <div class="card-body">
                <input type="text" value="{{ $enrolment->train_course_id }}" name="train_course_id" hidden>
                <div class="form-group">
                    <label for="student_id">اسم الطالب</label>
                    <select name="student_id" id="student_id" class="form-control">
                        <option value="">اختر الطالب</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}" {{ old('student_id', $enrolment->student_id) == $student->id ? 'selected' : '' }}>
                                {{ $student->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('student_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="enrolment-date">تاريخ التسجيل</label>
                    <input type="date" class="form-control" id="enrolment-date" name="enrolment_date"
                        value="{{ old('enrolment_date', $enrolment->enrolment_date) }}">
                    @error('enrolment_date')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">حفظ</button>
            </div>
        </form>
    </div>
    <!-- /.card -->
@endsection