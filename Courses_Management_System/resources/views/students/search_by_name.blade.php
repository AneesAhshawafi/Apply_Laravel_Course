<table id="example2" class="table table-bordered table-hover">
                    @if(isset($students) && $students->isNotEmpty())
                        <thead style="background-color:beige;">
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
                                            <img src="{{asset($student->image)}}" class="img-circle elevation-2" alt="User Image"
                                                style="width: 60px;height:60px;">
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