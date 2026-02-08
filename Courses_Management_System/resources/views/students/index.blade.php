@extends('master')

@section('students List')
    الطلاب
@endsection
@section('active-nav')
<li class="nav-item">
                <a href="{{ route('courses.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>إدارة الكورسات</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('students.index') }}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>إدارة الطلاب</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('training_courses.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>إدارة الدورات التدريبية</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>إدارة الحجوزات</p>
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
                <h3 class="card-title" style="float: right;">الطلاب</h3>
                <a href="{{ route('students.create') }}" class="btn btn-sm btn-success"
                    style="float: left; margin-right: 10px;">
                    إضافة طالب جديد</a>
                <a href="{{ route('students.trash') }}" class="btn btn-sm btn-success"
                    style="float: left; margin-right: 10px;" title="سلة المهملات">
                    <i class="fas fa-trash"></i>
                </a>


                <div class="card-tools" style="float: left;">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="بحث">

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
                        <thead  style="background-color:beige;">
                            <tr>
                                <th>الرقم</th>
                                <th>الصورة</th>
                                <th>اسم الطالب</th>
                                <th>الحالة</th>
                                <th>رقم الهاتف</th>
                                <th>العنوان</th>
                                <th>الدولة</th>
                                <th>تاريخ الاضافة</th>
                                <th>تاريخ آخر تحديث</th>
                                <th>ملاحظة</th>
                                <th>العمليات</th>
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
                                            <img src="{{asset($student->image)}}" class="img-circle elevation-2"
                                                alt="User Image" style="width: 60px;height:60px;">
                                        </div>
                                    </td>
                                    <td>{{ $student->name }}</td>
                                    <td>
                                        @if($student->active)
                                            <span class="badge badge-active">
                                                <span class=""></span> فعال
                                            </span>
                                        @else
                                            <span class="badge badge-inactive">
                                                <span class=""></span> معطل
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
                                            style="margin: 5px;" title="تعديل">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('students.destroy', $student->id) }}" method="POST"
                                            style="display: inline-block;margin: 5px;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('هل أنت متأكد من حذف هذا الطالب')" title="حذف نهائياً">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                        <a href="{{route('students.delete', $student->id)}}" class="btn btn-sm btn-warning"
                                            style="margin: 5px;" title="نقل إلى سلة المهملات">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                         <a href="{{route('students.show', $student->id)}}" class="btn btn-sm btn-warning"
                                            style="margin: 5px;" title="عرض التفاصيل">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @else
                        <p style="text-align: center;color:brown;margin: 10px;">لا يوجد بيانات طلاب حالياً</p>
                    @endif
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection