@extends('layouts\master')
@section('content')

    <main class="col-md-8 ms-sm-auto col-lg-10 px-md-4 ">

        {{--Title--}}
        <div class=" col-lg-12 d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 pr-2  border-bottom main " >
            <h1 class="col-lg-4  h2  ml-4">متابعة وإدارة البلاغات</h1>
            <div class="btn-toolbar col-lg-8 ">
                <input class="col-lg-4 form-control form-control-dark w-50 mr-5" type="text" placeholder="بحث" aria-label="بحث" size="30" style="border: 2px solid #ECECEC;
                    border-radius: 20px;">
                <div class="dropdown ">
                    <button type="button " class="btn btn-sm dropdown-toggle mr-4 ml-4 button" data-toggle="dropdown" id="btn">
                           حالة البـلاغ
                    </button>
                    <div class="dropdown-menu dropdown-menu-right bg-light">
                        <a class="dropdown-item border-bottom" href="{{route('showReports')}}">جميع البلاغات</a>
                        <a class="dropdown-item border-bottom" href="{{route('showNewReports')}}"><i class="far fa-circle ml-2" style="font-size: 10px; color: #7D899B "></i>بلاغات وارده</a>
                        <a class="dropdown-item border-bottom" href="{{route('showTransferReports')}}"><i class="fas fa-circle ml-2" style="font-size: 10px; color: #7D899B "></i>محول للمتابعة</a>
                        <a class="dropdown-item border-bottom" href="{{route('showFollowingReports')}}"> <i class="fas fa-circle ml-2" style="font-size: 10px; color: #A7613A "></i>قيد المتابعة</a>
                        <a class="dropdown-item border-bottom" href="{{route('showFollowDoneReports')}}"><i class="fas fa-circle ml-2" style="font-size: 10px; color: #5468FF "></i>تم متابعتها</a>
                        <a class="dropdown-item " href="{{route('showDoneReports')}}"><i class="fas fa-check-circle ml-2" style="font-size: 10px; color: #00864E "></i>تم انهائها</a>
                    </div>
                </div>
{{--                <div class="dropdown ">--}}
{{--                    <button type="button " class="btn btn-sm dropdown-toggle mr-4 ml-4 button" data-toggle="dropdown" id="btn">--}}
{{--                       نوع البلاغ--}}
{{--                    </button>--}}
{{--                    <div class="dropdown-menu dropdown-menu-right bg-light">--}}
{{--                        <a class="dropdown-item border-bottom" href="{{route('OP_newReports')}}"> جميع البلاغات</a>--}}
{{--                        <a class="dropdown-item border-bottom" href="{{route('OP_newSmuggledReports')}}"><i class="fas fa-angle-left ml-2"></i>مهرب</a>--}}
{{--                        <a class="dropdown-item border-bottom" href="{{route('OP_newDrownReports')}}"><i class="fas fa-angle-left ml-2"></i>مسحوب</a>--}}
{{--                        <a class="dropdown-item border-bottom" href="{{route('OP_newDiffrentReports')}}"><i class="fas fa-angle-left ml-2"></i>غير مطابق</a>--}}
{{--                        <a class="dropdown-item " href="{{route('OP_newExceptionReports')}}"><i class="fas fa-angle-left ml-2"></i>مستثناه</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>


        {{--Content--}}
        <div class="card shadow mb-3 w-9" style=" width:85%;background-color: #F9F9F9;">
            <div class="card-body px-0 py-0" style="background-color: #F9F9F9;">
                <div class="table-responsive scrollbar">
                    <table class="table table-hover fs--1 mb-0 " style="background-color: #F9F9F9;">
                        <thead class="bg-200 text-900">
                        <tr>
                            <th>
                                <div class="form-check mb-2 mt-2 d-flex align-items-center mb-3 mt-3"><input class="form-check-input" id="checkbox-bulk-purchases-select" type="checkbox" data-bulk-select='{"body":"table-purchase-body","actions":"table-purchases-actions","replacedElement":"table-purchases-replace-element"}' /></div>
                            </th>
                            <th class="sort pr-1 align-middle white-space-nowrap text-left" data-sort="name">اسم المبلغ</th>
                            <th class="sort pr-1 align-middle white-space-nowrap text-left" data-sort="email">تاريخ البلاغ</th>
                            <th class="sort pr-1 align-middle white-space-nowrap text-left" data-sort="product">تاريخ التحويل</th>
                            <th class="sort pr-1 align-middle white-space-nowrap text-left" data-sort="payment">الجهه المُحال إليها</th>
                            <th class="sort pr-1 align-middle white-space-nowrap text-left" data-sort="product">نوع البلاغ</th>
                            <th class="sort pr-1 align-middle white-space-nowrap text-left" data-sort="amount">حالة البلاغ</th>
                            <th class="sort pr-1 align-middle white-space-nowrap text-left" data-sort="amount"></th>
                        </tr>
                        </thead>
                        <tbody class="list" id="table-purchase-body">
                        @if(isset($reports))
                            @foreach($reports as $report)
                                <tr class="btn-reveal-trigger">
                                    <td class="align-middle" style="width: 28px;">
                                        <div class="form-check mb-2 mt-2 d-flex align-items-center"><input class="form-check-input" type="checkbox" id="recent-purchase-0" data-bulk-select-row="data-bulk-select-row" /></div>
                                    </td>
                                    <td class="align-middle white-space-nowrap text-left name "><a href="">{{$report -> name_user}}</a></td>
                                    <td class="align-middle white-space-nowrap text-left email"><a href="">{{$report -> date}}</a></td>
                                    <td class="align-middle white-space-nowrap text-left email"><a href="">{{$report -> transfer_date}}</a></td>
                                    <td class="align-middle white-space-nowrap text-left email"><a href="">{{$report -> transfer_party}}</a></td>
                                    <td class="align-middle white-space-nowrap text-left product"><a href="">{{$report-> type_report}}</a></td>
                                    @if($report->report_statuses=='قيد المتابعة')
                                        <td class="align-middle text-left  white-space-nowrap payment">
                                            <a class="badge badge rounded-pill badge-soft-success  align-items-center text-left nav-link active" href="{{route('report',$report->id)}}" style="background-color:#FDE6D8; color:#A7613A;  height:25px;"  >
                                                <span data-feather="file  text-center">{{$report -> report_statuses}}</span>
                                                <i class="fas fa-file-contract ml-3"></i>
                                            </a>
                                        </td>
                                    @elseif($report->report_statuses=='تمت المتابعة')
                                            <td class="align-middle text-left  white-space-nowrap payment">
                                                <a class="badge badge rounded-pill badge-soft-success  align-items-center text-left nav-link active" href="{{route('report',$report->id)}}" style="background-color:#D9DEFF; color:#5468FF;  height:25px;"  >
                                                    <span data-feather="file  text-center">{{$report -> report_statuses}}</span>
                                                    <i class="fas fa-file-contract ml-3"></i>
                                                </a>
                                            </td>
                                    @elseif($report -> report_statuses=='تم الانهاء')
                                        <td class="align-middle text-left  white-space-nowrap payment">
                                            <a class="badge badge rounded-pill badge-soft-success  align-items-center text-left nav-link active" href="{{route('report',$report->id)}}" style="background-color:#CCF6E4; color:#00864E; height:25px;"  >
                                                <span data-feather="file  text-center">{{$report -> report_statuses}}</span>
                                                <i class="fas fa-file-contract ml-3"></i>
                                            </a>
                                        </td>
                                    @elseif($report -> report_statuses=='محول للمتابعة')
                                        <td class="align-middle text-left  white-space-nowrap payment">
                                            <a class="badge badge rounded-pill badge-soft-success  align-items-center text-left nav-link active" href="{{route('report',$report->id)}}" style="background-color:#E3E6EA; color:#7D899B; height:25px;"  >
                                                <span data-feather="file  text-center">{{$report -> report_statuses}}</span>
                                                <i class="fas fa-file-contract ml-3"></i>
                                            </a>
                                        </td>
                                    @else
                                        <td class="align-middle text-left  white-space-nowrap payment">
                                            <a class="badge badge rounded-pill badge-soft-success  align-items-center text-left nav-link active" href="{{route('report',$report->id)}}" style="background-color:#ffffff; color:#3a416f; height:25px;"  >
                                                <span data-feather="file  text-center">بــــــــــلاغ وارد</span>
                                                <i class="fas fa-file-contract ml-3"></i>
                                            </a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer"></div>
        </div>
    </main>

@endsection
