@extends('layouts\master')
@section('content')
    <main class="col-md-8 ms-sm-auto col-lg-10 px-md-4 ">
        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        {{--Start Content Title--}}

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 pr-2  border-bottom main " >
            <h1 class="h2   ml-2 mt-2 mb-2">بلاغات واردة</h1>
            <div class="btn-toolbar ">
                <input class="form-control form-control-dark w-50 mr-5" type="text" placeholder="بحث" aria-label="بحث" size="30" style="border: 2px solid #ECECEC;
                    border-radius: 20px;">
                <div class="dropdown">
                    <button type="button" class="btn btn-sm  dropdown-toggle mr-4 ml-4 button" data-toggle="dropdown" id="btn">
                        نوع البلاغ
                    </button>
                    <div class="dropdown-menu dropdown-menu-right bg-light">
                        <a class="dropdown-item " href="{{route('PHC_newReports')}}">جميع البلاغات</a>
                        <a class="dropdown-item " href="{{route('PHC_newEffectReports')}}">اعراض جانبية</a>
                        <a class="dropdown-item " href="{{route('PHC_newQualityReports')}}">جودة</a>
                    </div>
                </div>
            </div>
        </div>

        {{--End Content Title--}}



        {{--Start Content--}}

        <div class="card shadow align-center" style="width: 75%; ">
            <div class="card-header ">
                <table class="table table-striped ">
                    <thead >
                    <tr>
                        <th>اسم المبلغ</th>
                        <th>التاريخ</th>
                        <th>نوع البلاغ</th>
                        <th>مستخدم الدواء</th>
                        <th class="no-sort pr-1 align-middle data-table-row-action"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($reports))
                    @foreach($reports as $report)
                        @if($report -> type_report=='اعراض جانبية')
                            <tr class="reportRow">
                                <td><a class="nav-link "   href="{{route('PHC_detailsEffectReport',$report -> report_no)}}">{{$report -> name}}</a></td>
                                <td><a class="nav-link  "  href="{{route('PHC_detailsEffectReport',$report -> report_no)}}">{{$report -> date_report}} </a></td>
                                <td ><a class="nav-link  " href="{{route('PHC_detailsEffectReport',$report -> report_no)}}">{{$report -> type_report}}</a></td>
                                <td ><a class="nav-link  " href="{{route('PHC_detailsEffectReport',$report -> report_no)}}">{{$report -> user_name}}</a></td>
                                <td class="align-middle white-space-nowrap">
                                    <div class="dropdown font-sans-serif">
                                        <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal float-right" type="button" id="dropdown0" data-toggle="dropdown">
                                            <span class="fas fa-ellipsis-h fs--1"></span>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right border py-2" aria-labelledby="dropdown0">
                                            <a class="dropdown-item" href="{{route('PHC_detailsEffectReport',$report -> report_no)}}">عرض</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item  " href="{{route('PHC_transferReports',$report -> report_no)}}">  تحويل للمتابعة</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @else
                            <tr class="reportRow">
                                <td><a class="nav-link "   href="{{route('PHC_detailsReport',$report -> report_no)}}">{{$report -> name}}</a></td>
                                <td><a class="nav-link  "  href="{{route('PHC_detailsReport',$report -> report_no)}}">{{$report -> date_report}} </a></td>
                                <td ><a class="nav-link  " href="{{route('PHC_detailsReport',$report -> report_no)}}">{{$report -> type_report}}</a></td>
                                <td ><a class="nav-link  " href="{{route('PHC_detailsReport',$report -> report_no)}}">{{$report -> user_name}}</a></td>
                                <td class="align-middle white-space-nowrap">
                                    <div class="dropdown font-sans-serif">
                                        <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal float-right" type="button" id="dropdown0" data-toggle="dropdown">
                                            <span class="fas fa-ellipsis-h fs--1"></span>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right border py-2" aria-labelledby="dropdown0">
                                            <a class="dropdown-item" href="{{route('PHC_detailsReport',$report -> report_no)}}">عرض</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item  " href="{{route('PHC_transferReports',$report -> report_no)}}">تحويل للمتابعة</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>

        {{--End Content--}}

    </main>

@endsection



