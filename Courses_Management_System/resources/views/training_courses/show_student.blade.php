@extends('students.show')
@section('back')
    <a href="{{ route('training_courses.show', $trainCourseId) }}" class="btn btn-sm btn-secondary"
        title="{{ __('training_courses/show_student.back') }}">
        <i class="fas fa-arrow-right"></i>
    </a>
@endsection