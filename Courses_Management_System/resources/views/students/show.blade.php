@extends('master')

@section('students List')
    {{ __('students/show.students') }}
@endsection
@section('active-nav')
    <li class="nav-item">
        <a href="{{ route('courses.index') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ __('students/show.courses_management') }}</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('students.index') }}" class="nav-link active">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ __('students/show.students_management') }}</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('training_courses.index') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ __('students/show.training_courses_management') }}</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ __('students/show.reservations_management') }}</p>
        </a>
    </li>
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        @section('back')

                    <a href="{{ route('students.index') }}" class="btn btn-sm btn-secondary" title="{{ __('students/show.back') }}">
                        <i class="fas fa-arrow-right"></i>
                    </a>
                    @show
                    <h3 class="card-title">{{ __('students/show.show_student_details') }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group" style="margin-right: 20px;">
                                <div class="image">
                                    <img src="{{asset($student->image)}}" class="img-circle elevation-2" alt="User Image"
                                        style="width: 60px;height:60px;">
                                </div>
                                <label for="image">{{ __('students/show.personal_image') }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">{{ __('students/show.student_name') }}</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $student->name }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">{{ __('students/show.phone_number') }}</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ $student->phone }}"
                                    readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">{{ __('students/show.address') }}</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{ $student->address }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="notes">{{ __('students/show.notes') }}</label>
                                <input type="text" class="form-control" id="notes" name="notes" value="{{ $student->notes }}"
                                    readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="country_id">{{ __('students/show.country') }}</label>
                                <input type="text" class="form-control" id="country_id" name="country_id"
                                    value="{{ $student->country->name }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="active">{{ __('students/show.status') }}</label>
                                <select class="form-control" name="active" id="exampleInputPassword1">
                                    @if($student->active)
                                        <option value="1" {{ old('active', $student->active) == '1' ? 'selected' : '' }}>
                                            {{ __('students/show.active') }}</option>
                                    @else
                                        <option value="0" {{ old('active', $student->active) == '0' and old('active') != '' ? 'selected' : '' }}>{{ __('students/show.inactive') }}</option>

                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="created_at">{{ __('students/show.created_at') }}</label>
                                <input type="text" class="form-control" id="created_at" name="created_at"
                                    value="{{ $student->created_at }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="updated_at">{{ __('students/show.updated_at') }}</label>
                                <input type="text" class="form-control" id="updated_at" name="updated_at"
                                    value="{{ $student->updated_at }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection