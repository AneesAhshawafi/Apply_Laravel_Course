@extends('master')

@section('traincourses List')
    {{ __('training_courses/show.students') }}
@endsection
@section('active-nav')
    <li class="nav-item">
        <a href="{{ route('courses.index') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ __('training_courses/show.courses_management') }}</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('students.index') }}" class="nav-link ">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ __('training_courses/show.students_management') }}</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('training_courses.index') }}" class="nav-link active">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ __('training_courses/show.training_courses_management') }}</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ __('training_courses/show.reservations_management') }}</p>
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
                    <a href="{{ route('training_courses.index') }}" class="btn btn-sm btn-secondary"
                        title="{{ __('training_courses/show.back') }}">
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <h3 class="card-title" style="float: right;">{{ __('training_courses/show.training_course_details') }}</h3>
                <a href="{{ route('training_courses.add_student', $trainCourse->id) }}" class="btn btn-sm btn-success"
                    style="float: left; margin-right: 10px;">
                    {{ __('training_courses/show.add_student_to_course') }} </a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>{{ __('training_courses/show.id') }}:</strong> {{ $trainCourse->id }}</p>
                        <p><strong>{{ __('training_courses/show.course_name') }}:</strong> {{ $trainCourse->name }}</p>
                        <p><strong>{{ __('training_courses/show.description') }}:</strong> {{ $trainCourse->description }}
                        </p>
                        <p><strong>{{ __('training_courses/show.price') }}:</strong> {{ $trainCourse->price }}</p>
                        <p><strong>{{ __('training_courses/show.students_count') }}:</strong>
                            {{ $trainCourse->students->count() }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>{{ __('training_courses/show.start_date') }}:</strong> {{ $trainCourse->start_date }}</p>
                        <p><strong>{{ __('training_courses/show.end_date') }}:</strong> {{ $trainCourse->end_date }}</p>
                        <p><strong>{{ __('training_courses/show.created_at') }}:</strong>
                            {{ $trainCourse->created_at->format('Y-m-d') }}</p>
                        <p><strong>{{ __('training_courses/show.updated_at') }}:</strong>
                            {{ $trainCourse->updated_at->format('Y-m-d') }}</p>
                        <p><strong>{{ __('training_courses/show.note') }}:</strong> {{ $trainCourse->note }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="float: right;">{{ __('training_courses/show.registered_students_list') }}</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>{{ __('training_courses/show.id') }}</th>
                            <th>{{ __('training_courses/show.student_name') }}</th>
                            <th>{{ __('training_courses/show.enrolment_date') }}</th>
                            <th>{{ __('training_courses/show.actions') }}</th>
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
                                        class="btn btn-sm btn-info" title="{{ __('training_courses/show.show') }}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('training_courses.edit_enrolment', ['studentId' => $student->id, 'trainCourseId' => $trainCourse->id]) }}"
                                        class="btn btn-sm btn-warning" title="{{ __('training_courses/show.edit') }}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form
                                        action="{{ route('training_courses.delete_student', ['studentId' => $student->id, 'trainCourseId' => $trainCourse->id]) }}"
                                        method="GET" style="display: inline-block;margin: 5px;">
                                        @csrf

                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('{{ __('training_courses/show.confirm_delete_student') }}')"
                                            title="{{ __('training_courses/show.delete_permanently') }}">
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