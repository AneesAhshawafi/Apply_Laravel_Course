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
            <div class="card-header">
                <div class="card-tools" style="float: right;margin-left: 30px;">
                    <a href="{{ route('training_courses.show', $id) }}" class="btn btn-sm btn-secondary" title="العودة">
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
                <h3 class="card-title" style="float: right;">إضافة طالب للدورة التدريبية</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('training_courses.add_student_store', $id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="student_id">اسم الطالب</label>
                        <select name="student_id" id="student_id" class="form-control">
                            <option value="">اختر الطالب</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
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
                            value="{{ old('enrolment_date') }}">
                        @error('enrolment_date')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">إضافة</button>
                </form>
            </div>
        </div>
    </div>
@endsection