@extends('master')
@section('title')
    إضافة طالب
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
            <div class="card-tools" style="float: right;margin-left:30px">
                <a href="{{ route('training_courses.index') }}" class="btn btn-sm btn-secondary" title="العودة">
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            <h3 class="card-title" style="float: right;">إضافة دورة تدريبية</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('training_courses.store')}}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="card-body">

                <div class="form-group">
                    <label for="name">اسم الدورة التدريبية</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{old('name')}}"
                        placeholder="ادخل اسم الدورة التدريبية هنا">
                    @error('name')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">وصف الدورة التدريبية</label>
                    <textarea id="description" name="description" class="form-control"
                        placeholder="ادخل وصف الدورة التدريبية هنا">{{old('description')}}</textarea>
                    @error('description')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="course_id">الكورس</label>
                    <select name="course_id" id="course_id" class="form-control">
                        <option value="">اختر الكورس</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                {{ $course->name }}</option>
                        @endforeach
                    </select>
                    @error('course_id')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="price">سعر الدورة التدريبية</label>
                    <input type="number" id="price" name="price" class="form-control" value="{{old('price')}}"
                        placeholder="ادخل سعر الدورة التدريبية هنا">
                    @error('price')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="start-date">تاريخ البداية</label>
                    <input type="date" id="start-date" name="start_date" class="form-control" value="{{old('start_date')}}">
                    @error('start_date')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="end-date">تاريخ النهاية</label>
                    <input type="date" id="end-date" name="end_date" class="form-control" value="{{old('end_date')}}">
                    @error('end_date')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="notes">ملاحظات</label>
                    <input type="text" name="notes" id="notes" class="form-control" value="{{old('notes')}}"
                        placeholder="ادخل ملاحظات">
                    @error('notes')
                        <div class="alert alert-danger">{{$message}}</div>
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