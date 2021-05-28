@extends('layouts.master')
@section('content')
    <main class="col-md-8 ms-sm-auto col-lg-10 px-md-4 ">
        {{--Start Content Title--}}

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 pr-2  border-bottom main " >
            <h1 class="h2   ml-2 mt-2 mb-2">تقارير</h1>
            <div class="btn-toolbar ">
{{--                <button class="btn btn-sm bg-light"  style="background-color: #e7e9ec ; color: #0F122D; " >--}}
{{--                    <a href="{{route('PHC_pdf')}}">تصدير pdf</a>--}}
{{--                </button>--}}
                <div class="dropdown">
                    <button type="button" class="btn btn-sm  dropdown-toggle mr-4 ml-4 button" data-toggle="dropdown" id="btn">
                        <a href="{{route('PHC_doneReports')}}">نوع البلاغ</a>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right bg-light">
                        <a class="dropdown-item " href="{{route('PHC_Reports')}}">جميع البلاغات</a>
                        <a class="dropdown-item " href="{{route('PHC_EffectReports')}}">اعراض جانبية</a>
                        <a class="dropdown-item " href="{{route('PHC_QualityReports')}}">جودة</a>
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
                            <tr class="reportRow">
                                <td><a class="nav-link "   href="{{route('PHC_detailsReport',$report -> report_no)}}">{{$report -> name}}</a></td>
                                <td><a class="nav-link  "  href="{{route('PHC_detailsReport',$report -> report_no)}}">{{$report -> date_report}} </a></td>
                                <td ><a class="nav-link  " href="{{route('PHC_detailsReport',$report -> report_no)}}">{{$report -> type_report}}</a></td>
                                <td ><a class="nav-link  " href="{{route('PHC_detailsReport',$report -> report_no)}}">{{$report -> user_name}}</a></td>

                            </tr>
                    @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>

        {{--End Content--}}

    </main>

@endsection



