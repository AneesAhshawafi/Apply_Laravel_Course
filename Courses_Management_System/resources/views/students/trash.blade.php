@extends('master')

@section('students List')
    {{ __('students/trash.section_title') }}
@endsection

@section('active-nav')
    <li class="nav-item">
        <a href="{{ route('courses.index') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ __('students/trash.active_nav.courses') }}</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('students.index') }}" class="nav-link active">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ __('students/trash.active_nav.students') }}</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('training_courses.index') }}" class="nav-link ">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ __('students/trash.active_nav.training_courses') }}</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ __('students/trash.active_nav.reservations') }}</p>
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
                <h3 class="card-title" style="float: right;">{{ __('students/trash.page_title') }}</h3>



                <div class="card-tools" style="float: left;">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right"
                            placeholder="{{ __('students/trash.search_placeholder') }}">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 300px;">
                <table id="example2" class="table table-bordered table-hover">
                    @if(isset($students) && $students->isNotEmpty())
                        <thead>
                            <tr>
                                <th>{{ __('students/trash.table.id') }}</th>
                                <th>{{ __('students/trash.table.image') }}</th>
                                <th>{{ __('students/trash.table.student_name') }}</th>
                                <th>{{ __('students/trash.table.status') }}</th>
                                <th>{{ __('students/trash.table.phone') }}</th>
                                <th>{{ __('students/trash.table.address') }}</th>
                                <th>{{ __('students/trash.table.country') }}</th>
                                <th>{{ __('students/trash.table.created_at') }}</th>
                                <th>{{ __('students/trash.table.updated_at') }}</th>
                                <th>{{ __('students/trash.table.note') }}</th>
                                <th>{{ __('students/trash.table.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                                <tr>
                                    <td>{{$student->id}}</td>
                                    <!-- <td>{{$student->image}}</td> -->
                                    <!-- <td>
                                                    <div class="image">
                                                        <img src="{{$student->image}}" class="img-circle elevation-2" alt="User Image">
                                                    </div>
                                                </td> -->
                                    <td>
                                        <div class="image">
                                            <img src="{{asset($student->image)}}" class="img-circle elevation-2" alt="User Image"
                                                style="width: 60px;height:60px;">
                                        </div>
                                    </td>
                                    <td>{{ $student->name }}</td>
                                    <td>
                                        @if($student->active)
                                            <span class="badge badge-active">
                                                <span class=""></span> {{ __('students/trash.status.active') }}
                                            </span>
                                        @else
                                            <span class="badge badge-inactive">
                                                <span class=""></span> {{ __('students/trash.status.inactive') }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>{{ $student->phone }}</td>
                                    <td>{{ $student->address }}</td>
                                    <td>{{ $student->country->name }}</td>
                                    <td>{{ $student->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $student->updated_at->format('Y-m-d') }}</td>
                                    <td>{{ $student->note }}</td>

                                    <td>

                                        <form action="{{ route('students.destroy', $student->id) }}" method="POST"
                                            style="display: inline-block;margin: 5px;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('{{ __('students/trash.confirm_delete') }}')"
                                                title="{{ __('students/trash.actions.delete_permanent') }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                        <a href="{{route('students.restore', $student->id)}}" class="btn btn-sm btn-success"
                                            style="margin: 5px;" title="{{ __('students/trash.actions.restore') }}">
                                            <i class="fas fa-undo"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @else
                        <p style="text-align: center;color:brown;margin: 10px;">{{ __('students/trash.no_data') }}</p>
                    @endif
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection