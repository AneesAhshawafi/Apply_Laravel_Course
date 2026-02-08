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
        <a href="{{ route('students.index') }}" class="nav-link active">
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
            <h3 class="card-title" style="float: right;">إضافة طالب</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('students.store')}}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="photo">اختر صورة شخصية</label>
                    <input type="file" name="image" id="photo" accept="image/*" class="form-control-file"
                        onchange="previewPhoto(event)">
                    <small class="form-text text-muted">مسموح بصيغ: jpg, png, jpeg. أقصى حجم 2MB.</small>
                    @error('image')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">ادخل اسمك</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{old('name')}}"
                        placeholder="ادخل الاسم">
                    @error('name')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="country_id">البلد</label>
                    <select class="form-control" name="country_id" id="country_id">
                        <option value="">اختر البلد</option>
                        @if(isset($countries) && $countries->isNotEmpty())
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>
                                    {{$country->name}}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('country_id')
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
                <div class="form-group">
                    <label for="phone">رقم الهاتف</label>
                    <input type="text" class="form-control" name="phone" value="{{old('phone')}}" id="phone"
                        placeholder="ادخل رقم الهاتف">
                    @error('phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="from-group">
                    <label for="address">ادخل العنوان</label>
                    <input type="text" class="form-control" name="address" value="{{old('address')}}" id="address"
                        placeholder="ادخل العنوان">
                    @error('address')
                        <div class="alert alert-danger">{{ $message }}</div>
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