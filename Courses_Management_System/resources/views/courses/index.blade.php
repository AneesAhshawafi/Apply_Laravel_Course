@extends('master')

@section('Courses List')
    {{ __('courses/index.page_title') }}
@endsection
@section('active-nav')
    <li class="nav-item">
        <a href="{{ route('courses.index') }}" class="nav-link active">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ __('courses/index.active_nav.courses') }}</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('students.index') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ __('courses/index.active_nav.students') }}</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('training_courses.index') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ __('courses/index.active_nav.training_courses') }}</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ __('courses/index.active_nav.reservations') }}</p>
        </a>
    </li>
@endsection
@section('content')

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                @if(Session::has('success'))
                    <div class="alert alert-success" role="alert" style="margin: 5px;">
                        {{ Session::get('success') }}
                    </div>
                @endif
                <h3 class="card-title" style="float: right;">{{ __('courses/index.page_title') }}</h3>
                <a href="{{ route('courses.create') }}" class="btn btn-sm btn-success"
                    style="float: left; margin-right: 10px;">
                    {{ __('courses/index.add_new') }}</a>
                <a href="{{ route('courses.trash') }}" class="btn btn-sm btn-success"
                    style="float: left; margin-right: 10px;" title="{{ __('courses/index.trash') }}">
                    <i class="fas fa-trash"></i>
                </a>


                <div class="card-tools" style="float: left;">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right"
                            placeholder="{{ __('courses/index.search_placeholder') }}">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 300px;">
                <table id="example2" class="table table-bordered table-hover">
                    @if(isset($courses) && $courses->isNotEmpty())
                        <thead>
                            <tr>

                                <th>{{ __('courses/index.table.course_name') }}</th>
                                <th>{{ __('courses/index.table.status') }}</th>
                                <th>{{ __('courses/index.table.created_at') }}</th>
                                <th>{{ __('courses/index.table.updated_at') }}</th>
                                <th>{{ __('courses/index.table.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($courses as $course)
                                <tr>
                                    <td>{{ $course->name }}</td>
                                    <td>
                                        @if($course->active)
                                            <span class="badge badge-active">
                                                <span class=""></span> {{ __('courses/index.status.active') }}
                                            </span>
                                        @else
                                            <span class="badge badge-inactive">
                                                <span class=""></span> {{ __('courses/index.status.inactive') }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>{{ $course->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $course->updated_at->format('Y-m-d') }}</td>
                                    <td>
                                        <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-sm btn-primary"
                                            style="margin: 5px;" title="{{ __('courses/index.actions.edit') }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('courses.destroy', $course->id) }}" method="POST"
                                            style="display: inline-block;margin: 5px;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('{{ __('courses/index.confirm_delete') }}')"
                                                title="{{ __('courses/index.actions.delete_permanent') }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                        <a href="{{route('courses.delete', $course->id)}}" class="btn btn-sm btn-warning"
                                            style="margin: 5px;" title="{{ __('courses/index.actions.move_to_trash') }}">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @else
                        <p style="text-align: center;color:brown;margin: 10px;">{{ __('courses/index.no_data') }}</p>
                    @endif
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection