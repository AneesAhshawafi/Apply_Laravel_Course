@extends('master')
@section('title')
    {{ __('training_courses/create.title') }}
@endsection
@section('active-nav')
    <li class="nav-item">
        <a href="{{ route('courses.index') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ __('training_courses/create.active_nav.courses') }}</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('students.index') }}" class="nav-link ">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ __('training_courses/create.active_nav.students') }}</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('training_courses.index') }}" class="nav-link active">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ __('training_courses/create.active_nav.training_courses') }}</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ __('training_courses/create.active_nav.reservations') }}</p>
        </a>
    </li>
@endsection
@section('content')
    <!-- general form elements -->
    <div class="card card-primary" style="width: 80%;">
        <div class="card-header">
            <div class="card-tools" style="float: right;margin-left:30px">
                <a href="{{ route('training_courses.index') }}" class="btn btn-sm btn-secondary"
                    title="{{ __('training_courses/create.back_button') }}">
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            <h3 class="card-title" style="float: right;">{{ __('training_courses/create.card_title') }}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('training_courses.store')}}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="card-body">

                <div class="form-group">
                    <label for="name">{{ __('training_courses/create.form.name_label') }}</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{old('name')}}"
                        placeholder="{{ __('training_courses/create.form.name_placeholder') }}">
                    @error('name')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">{{ __('training_courses/create.form.description_label') }}</label>
                    <textarea id="description" name="description" class="form-control"
                        placeholder="{{ __('training_courses/create.form.description_placeholder') }}">{{old('description')}}</textarea>
                    @error('description')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="course_id">{{ __('training_courses/create.form.course_label') }}</label>
                    <select name="course_id" id="course_id" class="form-control">
                        <option value="">{{ __('training_courses/create.form.course_placeholder') }}</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                {{ $course->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('course_id')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="price">{{ __('training_courses/create.form.price_label') }}</label>
                    <input type="number" id="price" name="price" class="form-control" value="{{old('price')}}"
                        placeholder="{{ __('training_courses/create.form.price_placeholder') }}">
                    @error('price')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="start-date">{{ __('training_courses/create.form.start_date_label') }}</label>
                    <input type="date" id="start-date" name="start_date" class="form-control" value="{{old('start_date')}}">
                    @error('start_date')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="end-date">{{ __('training_courses/create.form.end_date_label') }}</label>
                    <input type="date" id="end-date" name="end_date" class="form-control" value="{{old('end_date')}}">
                    @error('end_date')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="notes">{{ __('training_courses/create.form.notes_label') }}</label>
                    <input type="text" name="notes" id="notes" class="form-control" value="{{old('notes')}}"
                        placeholder="{{ __('training_courses/create.form.notes_placeholder') }}">
                    @error('notes')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('training_courses/create.form.submit') }}</button>
            </div>
        </form>
    </div>
    <!-- /.card -->
@endsection