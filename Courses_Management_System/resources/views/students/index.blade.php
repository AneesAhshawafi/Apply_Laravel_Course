@extends('master')

@section('students List')
    {{ __('students/index.page_title') }}
@endsection
@section('active-nav')
    <li class="nav-item">
        <a href="{{ route('courses.index') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ __('students/index.active_nav.courses') }}</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('students.index') }}" class="nav-link active">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ __('students/index.active_nav.students') }}</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('training_courses.index') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ __('students/index.active_nav.training_courses') }}</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ __('students/index.active_nav.reservations') }}</p>
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
                <h3 class="card-title" style="float: right;">{{ __('students/index.page_title') }}</h3>
                <a href="{{ route('students.create') }}" class="btn btn-sm btn-success"
                    style="float: left; margin-right: 10px;">
                    {{ __('students/index.add_new') }}</a>
                <a href="{{ route('students.trash') }}" class="btn btn-sm btn-success"
                    style="float: left; margin-right: 10px;" title="{{ __('students/index.trash') }}">
                    <i class="fas fa-trash"></i>
                </a>


                <div class="card-tools" style="float: left;">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="searchByName" id="searchByName" class="form-control float-right"
                            placeholder="{{ __('students/index.search_placeholder') }}">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 300px;" id="searchResult">
                <table id="example2" class="table table-bordered table-hover">
                    @if(isset($students) && $students->isNotEmpty())
                        <thead style="background-color:beige;">
                            <tr>
                                <th>{{ __('students/index.table.id') }}</th>
                                <th>{{ __('students/index.table.image') }}</th>
                                <th>{{ __('students/index.table.student_name') }}</th>
                                <th>{{ __('students/index.table.status') }}</th>
                                <th>{{ __('students/index.table.phone') }}</th>
                                <th>{{ __('students/index.table.address') }}</th>
                                <th>{{ __('students/index.table.country') }}</th>
                                <th>{{ __('students/index.table.created_at') }}</th>
                                <th>{{ __('students/index.table.updated_at') }}</th>
                                <th>{{ __('students/index.table.note') }}</th>
                                <th>{{ __('students/index.table.actions') }}</th>
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
                                                <span class=""></span> {{ __('students/index.status.active') }}
                                            </span>
                                        @else
                                            <span class="badge badge-inactive">
                                                <span class=""></span> {{ __('students/index.status.inactive') }}
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
                                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-primary"
                                            style="margin: 5px;" title="{{ __('students/index.actions.edit') }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('students.destroy', $student->id) }}" method="POST"
                                            style="display: inline-block;margin: 5px;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('{{ __('students/index.confirm_delete') }}')"
                                                title="{{ __('students/index.actions.delete_permanent') }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                        <a href="{{route('students.delete', $student->id)}}" class="btn btn-sm btn-warning"
                                            style="margin: 5px;" title="{{ __('students/index.actions.move_to_trash') }}">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        <a href="{{route('students.show', $student->id)}}" class="btn btn-sm btn-warning"
                                            style="margin: 5px;" title="{{ __('students/index.actions.view_details') }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @else
                        <p style="text-align: center;color:brown;margin: 10px;">{{ __('students/index.no_data') }}</p>
                    @endif
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    {{ $students->links() }}
@endsection
@section('script')
    <script>
        $(document).ready(function () {

            $(document).on('input', "#searchByName", function (e) {

                var name = $(this).val();
                // alert(name);
                jQuery.ajax({
                    url: '{{ route('students.search') }}',
                    type: 'post',
                    'dataType': 'html',
                    cache: false,
                    data: {
                        "_token": '{{ csrf_token() }}',
                        name: name
                    },
                    success: function (data) {
                        $('#searchResult').html(data);

                    },
                    error: function () {

                    }


                });

            });

        });
    </script>
@endsection