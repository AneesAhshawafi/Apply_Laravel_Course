@extends('master')

@section('traincourses List')
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
        <a href="{{ route('students.index') }}" class="nav-link ">
            <i class="far fa-circle nav-icon"></i>
            <p>إدارة الطلاب</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('training_courses.index') }}" class="nav-link active">
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
                <h3 class="card-title" style="float: right;">الدورات التدريبية</h3>
                <a href="{{ route('training_courses.create') }}" class="btn btn-sm btn-success"
                    style="float: left; margin-right: 10px;">
                    إضافة دورة تدريبية </a>
                <a href="{{ route('training_courses.trash') }}" class="btn btn-sm btn-success"
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
                    @if(isset($traincourses) && $traincourses->isNotEmpty())
                        <thead style="background-color:beige;">
                            <tr>
                                <th>الرقم</th>
                                <th>الاسم</th>
                                <th>الوصف</th>
                                <th>السعر</th>
                                <th>تاريخ البداية</th>
                                <th>تاريخ النهاية</th>
                                <th>تاريخ الاضافة</th>
                                <th>تاريخ آخر تحديث</th>
                                <th>ملاحظة</th>
                                <th>العمليات</th>
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
                                        <a href="{{ route('training_courses.edit', $traincourse->id) }}" class="btn btn-sm btn-primary"
                                            style="margin: 5px;" title="تعديل">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('training_courses.destroy', $traincourse->id) }}" method="POST"
                                            style="display: inline-block;margin: 5px;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('هل أنت متأكد من حذف هذه الدورة التدريبية')"
                                                title="حذف نهائياً">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                        <a href="{{route('training_courses.delete', $traincourse->id)}}" class="btn btn-sm btn-warning"
                                            style="margin: 5px;" title="نقل إلى سلة المهملات">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        <a href="{{route('training_courses.show', $traincourse->id)}}" class="btn btn-sm btn-warning"
                                            style="margin: 5px;" title="عرض التفاصيل">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @else
                        <p style="text-align: center;color:brown;margin: 10px;">لا يوجد دورات تدريبية حالياً</p>
                    @endif
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection