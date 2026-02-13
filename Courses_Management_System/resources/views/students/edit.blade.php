@extends('master')
@section('title')
    {{ __('students/edit.title') }}
@endsection
@section('active-nav')
    <li class="nav-item">
        <a href="{{ route('courses.index') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ __('students/edit.active_nav.courses') }}</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('students.index') }}" class="nav-link active">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ __('students/edit.active_nav.students') }}</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('training_courses.index') }}" class="nav-link ">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ __('students/edit.active_nav.training_courses') }}</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ __('students/edit.active_nav.reservations') }}</p>
        </a>
    </li>
@endsection
@section('content')
    <!-- general form elements -->
    <div class="card card-primary" style="width: 80%;">
        <div class="card-header">
            <h3 class="card-title" style="float: right;">{{ __('students/edit.card_title') }}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('students.update', $student->id)}}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="photo">{{ __('students/edit.form.image_label') }}</label>
                    @if($student->image)
                        <div class="mb-3">
                            <img src="{{asset($student->image)}}" alt="Current Image" class="img-thumbnail"
                                style="width: 150px; height: 150px; object-fit: cover;">
                        </div>
                    @endif
                    <input type="file" name="image" id="photo" accept="image/*" class="form-control-file"
                        onchange="previewPhoto(event)">
                    <small class="form-text text-muted">{{ __('students/edit.form.image_help') }}</small>
                    @error('image')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">{{ __('students/edit.form.name_label') }}</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{old('name', $student->name)}}"
                        placeholder="{{ __('students/edit.form.name_placeholder') }}">
                    @error('name')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="country_id">{{ __('students/edit.form.country_label') }}</label>
                    <select class="form-control" name="country_id" id="country_id">
                        <option value="">{{ __('students/edit.form.country_placeholder') }}</option>
                        @if(isset($countries) && $countries->isNotEmpty())
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}" {{ old('country_id', $student->country_id) == $country->id ? 'selected' : '' }}>
                                    {{$country->name}}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    @error('country_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">{{ __('students/edit.form.status_label') }}</label>
                    <select class="form-control" name="active" id="exampleInputPassword1">
                        <option value="">{{ __('students/edit.form.status_placeholder') }}</option>
                        <option value="1" {{ old('active', $student->active) == '1' ? 'selected' : '' }}>
                            {{ __('students/edit.form.active') }}</option>
                        <option value="0" {{ old('active', $student->active) == '0' and old('active') != '' ? 'selected' : '' }}>{{ __('students/edit.form.inactive') }}</option>
                    </select>
                    @error('active')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone">{{ __('students/edit.form.phone_label') }}</label>
                    <input type="text" class="form-control" name="phone" value="{{old('phone', $student->phone)}}"
                        id="phone" placeholder="{{ __('students/edit.form.phone_placeholder') }}">
                    @error('phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="from-group">
                    <label for="address">{{ __('students/edit.form.address_label') }}</label>
                    <input type="text" class="form-control" name="address" value="{{old('address', $student->address)}}"
                        id="address" placeholder="{{ __('students/edit.form.address_placeholder') }}">
                    @error('address')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="notes">{{ __('students/edit.form.notes_label') }}</label>
                    <input type="text" name="notes" id="notes" class="form-control" value="{{old('notes', $student->note)}}"
                        placeholder="{{ __('students/edit.form.notes_placeholder') }}">
                    @error('notes')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('students/edit.form.submit') }}</button>
                <a href="{{ route('students.index') }}" class="btn btn-secondary"
                    style="margin-right: 10px;">{{ __('students/edit.form.cancel') }}</a>
            </div>
        </form>
    </div>
    <!-- /.card -->
@endsection

@section('scripts')
    <script>
        function previewPhoto(event) {
            var reader = new FileReader();
            reader.onload = function () {
                var output = document.getElementById('photo');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection