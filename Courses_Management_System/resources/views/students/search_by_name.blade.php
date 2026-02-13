<table id="example2" class="table table-bordered table-hover">
                    @if(isset($students) && $students->isNotEmpty())
                        <thead style="background-color:beige;">
                            <tr>
                                <th>{{ __('students/search_by_name.number') }}</th>
                                <th>{{ __('students/search_by_name.image') }}</th>
                                <th>{{ __('students/search_by_name.student_name') }}</th>
                                <th>{{ __('students/search_by_name.status') }}</th>
                                <th>{{ __('students/search_by_name.phone') }}</th>
                                <th>{{ __('students/search_by_name.address') }}</th>
                                <th>{{ __('students/search_by_name.country') }}</th>
                                <th>{{ __('students/search_by_name.created_at') }}</th>
                                <th>{{ __('students/search_by_name.updated_at') }}</th>
                                <th>{{ __('students/search_by_name.note') }}</th>
                                <th>{{ __('students/search_by_name.actions') }}</th>
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
                                                <span class=""></span> {{ __('students/search_by_name.active') }}
                                            </span>
                                        @else
                                            <span class="badge badge-inactive">
                                                <span class=""></span> {{ __('students/search_by_name.inactive') }}
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
                                            style="margin: 5px;" title="{{ __('students/search_by_name.edit') }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('students.destroy', $student->id) }}" method="POST"
                                            style="display: inline-block;margin: 5px;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('{{ __('students/search_by_name.confirm_delete') }}')" title="{{ __('students/search_by_name.delete_permanent') }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                        <a href="{{route('students.delete', $student->id)}}" class="btn btn-sm btn-warning"
                                            style="margin: 5px;" title="{{ __('students/search_by_name.delete_trash') }}">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        <a href="{{route('students.show', $student->id)}}" class="btn btn-sm btn-warning"
                                            style="margin: 5px;" title="{{ __('students/search_by_name.show_details') }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @else
                        <p style="text-align: center;color:brown;margin: 10px;">{{ __('students/search_by_name.no_students') }}</p>
                    @endif
                </table>