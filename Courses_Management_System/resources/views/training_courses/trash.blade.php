@extends('master')

@section('traincourses List')
    {{ __('training_courses/trash.section_title') }}
@endsection
@section('active-nav')
    <li class="nav-item">
        <a href="{{ route('courses.index') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ __('training_courses/trash.active_nav.courses') }}</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('students.index') }}" class="nav-link ">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ __('training_courses/trash.active_nav.students') }}</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('training_courses.index') }}" class="nav-link active">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ __('training_courses/trash.active_nav.training_courses') }}</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ __('training_courses/trash.active_nav.reservations') }}</p>
        </a>
    </li>
@endsection
@section('content')

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-tools" style="float: right;margin-left:30px">
                    <a href="{{ route('training_courses.index') }}" class="btn btn-sm btn-secondary"
                        title="{{ __('training_courses/trash.back_button') }}">
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
                @if(Session::has('success'))
                    <div class="alert alert-success" role="alert" style="margin: 5px;">
                        {{ Session::get('success') }}
                    </div>
                @endif
                <h3 class="card-title" style="float: right;">{{ __('training_courses/trash.page_title') }}</h3>



                <div class="card-tools" style="float: left;">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right"
                            placeholder="{{ __('training_courses/trash.search_placeholder') }}">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 300px;">
                <table id="example2" class="table table-bordered table-hover">
                    @if(isset($traincourses) && $traincourses->isNotEmpty())
                        <thead style="background-color:beige;">
                            <tr>
                                <th>{{ __('training_courses/trash.table.id') }}</th>
                                <th>{{ __('training_courses/trash.table.name') }}</th>
                                <th>{{ __('training_courses/trash.table.description') }}</th>
                                <th>{{ __('training_courses/trash.table.price') }}</th>
                                <th>{{ __('training_courses/trash.table.start_date') }}</th>
                                <th>{{ __('training_courses/trash.table.end_date') }}</th>
                                <th>{{ __('training_courses/trash.table.created_at') }}</th>
                                <th>{{ __('training_courses/trash.table.updated_at') }}</th>
                                <th>{{ __('training_courses/trash.table.note') }}</th>
                                <th>{{ __('training_courses/trash.table.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($traincourses as $traincourse)
                                <tr>
                                    <td>{{$traincourse->id}}</td>
                                    <td>{{ $traincourse->name }}</td>
                                    <td>{{ $traincourse->description }}</td>
                                    <td>{{ $traincourse->price }}</td>
                                    <td>{{ $traincourse->start_date }}</td>
                                    <td>{{ $traincourse->end_date }}</td>
                                    <td>{{ $traincourse->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $traincourse->updated_at->format('Y-m-d') }}</td>
                                    <td>{{ $traincourse->note }}</td>
                                    <td>
                                        <form action="{{ route('training_courses.destroy', $traincourse->id) }}" method="POST"
                                            style="display: inline-block;margin: 5px;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('{{ __('training_courses/trash.confirm_delete') }}')"
                                                title="{{ __('training_courses/trash.actions.delete_permanent') }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                        <a href="{{route('training_courses.restore', $traincourse->id)}}"
                                            class="btn btn-sm btn-success" style="margin: 5px;"
                                            title="{{ __('training_courses/trash.actions.restore') }}">
                                            <i class="fas fa-undo"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @else
                        <p style="text-align: center;color:brown;margin: 10px;">{{ __('training_courses/trash.no_data') }}</p>
                    @endif
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection