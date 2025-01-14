    
@extends('backend.layout.app')

@section('content')

<!-- main page content body part -->
<div id="main-content">
    <div class="container-fluid">
        @include('includes.alert-message')
        <div class="block-header">
            <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>    رصيد الزبائن </h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>                            
                        <li class="breadcrumb-item">لوحة التحكم</li>
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
                            <h2>   شحن الارصدة </h2>
                        </div>
                        <div class="body project_report">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom mb-0">
                                    <thead>
                                        <tr>                                                                
                                            <th>اسم الزبون</th>
                                            <th>القيمة</th>
                                            <th>تاريخ الاجراء</th>
                                            <th>الحالة</th>
                                            <th>العمليات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transactions as $transaction)
                                        <tr>
                                           <td class="project-title">
                                             <h6> {{ $transaction->receiver ? $transaction->receiver->name : 'غير معروف' }} </h6>
                                            </td>
                                            <td>{{ $transaction->amount }}TL</td>
                                            <td>{{ $transaction->created_at->format('Y-m-d H:i:s') }}</td>
                                            <td>@if($transaction->payment_done)
                                               <h6 style="color:green">   تم الدفع  </h6>
                                                @else
                                                <h6 style="color:red">        دين</h6>
                                                @endif

                                            </td>

                                            <td class="project-actions">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-outline-primary"   data-toggle="modal" data-target="#balanceModal{{ $transaction->receiver->id}}"><i class="icon-plus"></i></a>

                                            @if(!$transaction->payment_done)
                                            <a href="/users/transactions/done/{{$transaction->id}}" title="تم تسديد الدين "  class="btn btn-sm btn-success"><i class="icon-check" style="font-size:19px"></i></a>
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




@foreach ($transactions as  $user)
<div class="modal fade" id="balanceModal{{$user->receiver->id}}" tabindex="-1" role="dialog">
 <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel"> اضافة رصيد الى  {{$user->receiver->name}}</h4>
            </div>
            <div class="modal-body"> 
            <form method="POST" action="{{ route('users.balance') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                        </div>
                        <input type="text" class="form-control" required placeholder=" القيمة بدون كتابة TL"  aria-label=" "  name ="value" aria-describedby="basic-addon1">
                    </div>
                        <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                        </div>

                        <select class="custom-select" required name="payment_done" id="role">
                                  <option selected value="1">  مدفوع </option>
                                   <option value="0">دين</option>
                               
                                </select>  


                    </div>
                    <input class="form-control" require aria-label=" "  type="hidden"  name ="agent_id" value="{{$user->receiver->id}}" aria-describedby="basic-addon1">
                 
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="modal-footer"> 
                        <button type="submit" class="btn btn-primary">حفظ</button>
                        <a href="#"  data-dismiss="modal" class="btn btn-secondary">الغاء الأمر</a>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endforeach

@endsection