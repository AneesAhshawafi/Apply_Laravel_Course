@extends('master')

@section('traincourses List')
    {{ __('training_courses/index.section_title') }}
@endsection
@section('active-nav')
    <li class="nav-item">
        <a href="{{ route('courses.index') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ __('training_courses/index.active_nav.courses') }}</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('students.index') }}" class="nav-link ">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ __('training_courses/index.active_nav.students') }}</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('training_courses.index') }}" class="nav-link active">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ __('training_courses/index.active_nav.training_courses') }}</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ __('training_courses/index.active_nav.reservations') }}</p>
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
                <h3 class="card-title" style="float: right;">{{ __('training_courses/index.page_title') }}</h3>
                <a href="{{ route('training_courses.create') }}" class="btn btn-sm btn-success"
                    style="float: left; margin-right: 10px;">
                    {{ __('training_courses/index.add_new') }}</a>
                <a href="{{ route('training_courses.trash') }}" class="btn btn-sm btn-success"
                    style="float: left; margin-right: 10px;" title="{{ __('training_courses/index.trash') }}">
                    <i class="fas fa-trash"></i>
                </a>


                <div class="card-tools" style="float: left;">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right"
                            placeholder="{{ __('training_courses/index.search_placeholder') }}">

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
                                <th>{{ __('training_courses/index.table.id') }}</th>
                                <th>{{ __('training_courses/index.table.name') }}</th>
                                <th>{{ __('training_courses/index.table.description') }}</th>
                                <th>{{ __('training_courses/index.table.price') }}</th>
                                <th>{{ __('training_courses/index.table.start_date') }}</th>
                                <th>{{ __('training_courses/index.table.end_date') }}</th>
                                <th>{{ __('training_courses/index.table.created_at') }}</th>
                                <th>{{ __('training_courses/index.table.updated_at') }}</th>
                                <th>{{ __('training_courses/index.table.note') }}</th>
                                <th>{{ __('training_courses/index.table.actions') }}</th>
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
                                        <a href="{{ route('training_courses.edit', $traincourse->id) }}"
                                            class="btn btn-sm btn-primary" style="margin: 5px;"
                                            title="{{ __('training_courses/index.actions.edit') }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('training_courses.destroy', $traincourse->id) }}" method="POST"
                                            style="display: inline-block;margin: 5px;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('{{ __('training_courses/index.confirm_delete') }}')"
                                                title="{{ __('training_courses/index.actions.delete_permanent') }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                        <a href="{{route('training_courses.delete', $traincourse->id)}}"
                                            class="btn btn-sm btn-warning" style="margin: 5px;"
                                            title="{{ __('training_courses/index.actions.move_to_trash') }}">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        <a href="{{route('training_courses.show', $traincourse->id)}}"
                                            class="btn btn-sm btn-warning" style="margin: 5px;"
                                            title="{{ __('training_courses/index.actions.view_details') }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @else
                        <p style="text-align: center;color:brown;margin: 10px;">{{ __('training_courses/index.no_data') }}</p>
                    @endif
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection