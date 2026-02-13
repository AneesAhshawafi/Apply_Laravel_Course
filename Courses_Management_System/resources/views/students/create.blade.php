@extends('master')
@section('title')
    {{ __('students/create.title') }}
@endsection

@section('active-nav')
    <li class="nav-item">
        <a href="{{ route('courses.index') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ __('students/create.active_nav.courses') }}</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('students.index') }}" class="nav-link active">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ __('students/create.active_nav.students') }}</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('training_courses.index') }}" class="nav-link ">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ __('students/create.active_nav.training_courses') }}</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ __('students/create.active_nav.reservations') }}</p>
        </a>
    </li>
@endsection
@section('content')
    <!-- general form elements -->
    <div class="card card-primary" style="width: 80%;">
        <div class="card-header">
            <h3 class="card-title" style="float: right;">{{ __('students/create.card_title') }}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('students.store')}}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="photo">{{ __('students/create.form.image_label') }}</label>
                    <input type="file" name="image" id="photo" accept="image/*" class="form-control-file"
                        onchange="previewPhoto(event)">
                    <small class="form-text text-muted">{{ __('students/create.form.image_help') }}</small>
                    @error('image')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">{{ __('students/create.form.name_label') }}</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{old('name')}}"
                        placeholder="{{ __('students/create.form.name_placeholder') }}">
                    @error('name')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="country_id">{{ __('students/create.form.country_label') }}</label>
                    <select class="form-control" name="country_id" id="country_id">
                        <option value="">{{ __('students/create.form.country_placeholder') }}</option>
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
                    <label for="exampleInputPassword1">{{ __('students/create.form.status_label') }}</label>
                    <select class="form-control" name="active" id="exampleInputPassword1">
                        <option value="">{{ __('students/create.form.status_placeholder') }}</option>
                        <option value="1" {{ old('active') == '1' ? 'selected' : '' }}>{{ __('students/create.form.active') }}</option>
                        <option value="0" {{ old('active') == '0' and old('active') != '' ? 'selected' : '' }}>{{ __('students/create.form.inactive') }}</option>
                    </select>
                    @error('active')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone">{{ __('students/create.form.phone_label') }}</label>
                    <input type="text" class="form-control" name="phone" value="{{old('phone')}}" id="phone"
                        placeholder="{{ __('students/create.form.phone_placeholder') }}">
                    @error('phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="from-group">
                    <label for="address">{{ __('students/create.form.address_label') }}</label>
                    <input type="text" class="form-control" name="address" value="{{old('address')}}" id="address"
                        placeholder="{{ __('students/create.form.address_placeholder') }}">
                    @error('address')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="notes">{{ __('students/create.form.notes_label') }}</label>
                    <input type="text" name="notes" id="notes" class="form-control" value="{{old('notes')}}"
                        placeholder="{{ __('students/create.form.notes_placeholder') }}">
                    @error('notes')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('students/create.form.submit') }}</button>
            </div>
        </form>
    </div>
    <!-- /.card -->
@endsection