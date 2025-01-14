
@extends('backend.layout.app')

@section('content')

<!-- main page content body part -->
<div id="main-content">
    <div class="container-fluid">
        @include('includes.alert-message')
        <div class="block-header">
            <div class="row">
               <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2> خدمة السرفر </h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>                            
                        <li class="breadcrumb-item">لوحة التحكم</li>
                        <li class="breadcrumb-item active">السرفر</li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="d-flex flex-row-reverse">
                   
                        <div class="p-2 d-flex">
                        </div>
                    </div>
                </div>
            </div>    
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>التطبيقات</h2>
                        </div>
               <div class="body project_report">
    <div class="table-responsive">
        <table class="table table-hover js-basic-example dataTable table-custom mb-0">
            <thead>
                <tr>
                    @if($serviceOrders->firstWhere('service_name', '!=', ''))
                        <th>الخدمة المطلوبة </th>
                    @endif
                    @if($serviceOrders->firstWhere('ime', '!=', ''))
                        <th>IME/SN/Mobile</th>
                    @endif
                    @if($serviceOrders->firstWhere('email', '!=', ''))
                        <th>الايميل</th>
                    @endif
                    @if($serviceOrders->firstWhere('username', '!=', ''))
                        <th>اسم المستخدم</th>
                    @endif
                    @if($serviceOrders->firstWhere('password', '!=', ''))
                        <th>كلمة السر</th>
                    @endif
                    @if($serviceOrders->firstWhere('count', '!=', ''))
                        <th>العدد</th>
                    @endif
                    @if($serviceOrders->firstWhere('note', '!=', ''))
                        <th>ملاحظة</th>
                    @endif
                    @if($serviceOrders->firstWhere('status', '!=', ''))
                        <th>الحالة</th>
                    @endif
                    <th>العمليات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($serviceOrders as $key => $serviceOrder)
                <tr>
    <td class="project-title">
        <h6>{{auth()->user()->name}}</h6>
    </td>
    @if($serviceOrder->service_name)
        <td>{{$serviceOrder->service_name}}</td>
    @else
        <td>****</td>
    @endif
    @if($serviceOrder->ime)
        <td>{{ $serviceOrder->ime ?: '****' }}</td>
    @else
        <td>****</td>
    @endif
    @if($serviceOrder->email)
        <td>{{ $serviceOrder->email ?: '****' }}</td>
    @else
        <td>****</td>
    @endif
    @if($serviceOrder->username)
        <td>{{ $serviceOrder->username ?: '****' }}</td>
    @else
        <td>****</td>
    @endif
    @if($serviceOrder->password)
        <td>{{ $serviceOrder->password ?: '****' }}</td>
    @else
        <td>****</td>
    @endif
    @if($serviceOrder->count)
        <td>{{$serviceOrder->count}}</td>
    @else
        <td>****</td>
    @endif
    @if($serviceOrder->note)
        <td>{{$serviceOrder->note}}</td>
    @else
        <td>****</td>
    @endif
    @if($serviceOrder->status)
        <td>{{$serviceOrder->status}}</td>
    @else
        <td>****</td>
    @endif
    <td class="project-actions">
        <a href="#defaultModal" data-toggle="modal" data-target="#defaultModal"></a>
        <a href="javascript:void(0);" data-toggle="modal" data-target="#editModal{{$serviceOrder->id}}" class="btn btn-sm btn-outline-success"><i class="icon-pencil"></i></a>
        <a href="javascript:void(0);" data-toggle="modal" data-target="#deleteModal{{$serviceOrder->id}}" class="btn btn-sm btn-outline-danger"><i class="icon-trash"></i></a>
        @if($serviceOrder->status == 'قيد المراجعة')
            <a href="/service-order/reject/{{$serviceOrder->id}}" title="رفض الطلب" class="btn btn-sm btn-danger"><i class="icon-close" style="font-size:19px"></i></a>
            <a href="/service-order/accept/{{$serviceOrder->id}}" title="قبول الطلب" class="btn btn-sm btn-success"><i class="icon-check" style="font-size:19px"></i></a>
        @elseif($serviceOrder->status == 'مرفوض')
            <a href="/service-order/accept/{{$serviceOrder->id}}" title="قبول الطلب" class="btn btn-sm btn-success"><i class="icon-check" style="font-size:19px"></i></a>
        @else
            <a href="/service-order/reject/{{$serviceOrder->id}}" title="رفض الطلب" class="btn btn-sm btn-danger"><i class="icon-close" style="font-size:19px"></i></a>
        @endif
    </td>
</tr>

                @endforeach
            </tbody>
        </table>
    </div>
</div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-------------create--------->
<div class="modal fade" id="createmodal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabelcreate">إضافة طلب جديد</h4>
            </div>
            <div class="modal-body"> 
                <form method="Post" action="{{ route('turkification-order.store') }}" enctype="multipart/form-data">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-edit"> </i></span>
                        </div>
                        <input type="text" class="form-control" required placeholder="IME"  name="ime" aria-label="ime" aria-describedby="basic-addon2">
                    </div>

                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <input type="hidden" name="user_id" value="1" />
                    <div class="modal-footer">   
                        <button type="submit" class="btn btn-primary">حفظ</button>
                        <a href="#" class="btn btn-secondary" data-dismiss="modal">الغاء الأمر</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--------------delete -------------->
@foreach ($serviceOrders as $key => $serviceOrder)
<div class="modal fade" id="deleteModal{{$serviceOrder->id}}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabeldelete">هل أنت بالتاكيد تريد الحذف </h4>
            </div>
            <div class="modal-body"> 
              <form action="{{ route('service-order.destroy', $serviceOrder->id) }}" method="POST">
               @csrf
               @method('DELETE')
               <input type="hidden" name="_token" value="{{ csrf_token() }}" />
               <div class="modal-footer">
                   <button type="submit" class="btn btn-primary">نعم</button>
                   <a href="#" class="btn btn-secondary" data-dismiss="modal">الغاء الأمر</a>
               </div>
              </form>
           </div>
        </div>
    </div>
</div>
@endforeach

<!--------------edit -------------->
@foreach ($serviceOrders as $key => $serviceOrder)
<div class="modal fade" id="editModal{{$serviceOrder->id}}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabeledit">تعديل معلومات تطبيق </h4>
            </div>
            <div class="modal-body"> 
                <form method="POST" action="{{ route('turkification-order.update',  $serviceOrder->id) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-edit"> </i></span>
                        </div>
                        <input type="text" class="form-control" value="{{auth()->user()->name}}" required placeholder="اسم المستخدم" name="user_id" aria-label="user_id" aria-describedby="basic-addon2" readonly>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-edit"> </i></span>
                        </div>
                        <input type="text" class="form-control" value="{{$serviceOrder->ime}}" required placeholder="ime" name="ime" aria-label="ime" aria-describedby="basic-addon2">
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                               
                    <div class="modal-footer"> 
                        <button type="submit" class="btn btn-primary">حفظ</button>
                        <a href="#" class="btn btn-secondary" data-dismiss="modal">الغاء الأمر</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach


@endsection