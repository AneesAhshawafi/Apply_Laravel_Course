@extends('master')
@section('title')
إضافة كورس
@endsection

@section('active-nav')
    <li class="nav-item">
        <a href="{{ route('courses.index') }}" class="nav-link active">
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
        <a href="{{ route('training_courses.index') }}" class="nav-link ">
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
                <h3 class="card-title" style="float: right;"  >إضافة كورس</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('courses.store')}}" method="POST">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">اسم الكورس</label>
                    <input type="text" class="form-control" name="name" value="{{old('name')}}" id="exampleInputEmail1" placeholder="ادخل اسم الكورس">
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">الحالة</label>
                    <select class="form-control" name="active" id="exampleInputPassword1">
                        <option value="">اختر الحالة</option>
                        <option value="1" {{ old('active') == '1' ? 'selected' : '' }}>فعال</option>
                        <option value="0" {{ old('active') == '0' and old('active') != '' ? 'selected' : '' }}>معطل</option>
                    </select>
                    @error('active')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                  </div>
                 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
@endsection