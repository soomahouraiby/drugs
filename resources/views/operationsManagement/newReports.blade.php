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
                        <a class="dropdown-item border-bottom" href="{{route('OP_newReports')}}"> جميع البلاغات</a>
                        <a class="dropdown-item border-bottom" href="{{route('OP_newSmuggledReports')}}"><i class="fas fa-angle-left ml-2"></i>مهرب</a>
                        <a class="dropdown-item border-bottom" href="{{route('OP_newDrownReports')}}"><i class="fas fa-angle-left ml-2"></i>مسحوب</a>
                        <a class="dropdown-item border-bottom" href="{{route('OP_newDiffrentReports')}}"><i class="fas fa-angle-left ml-2"></i>غير مطابق</a>
                        <a class="dropdown-item " href="{{route('OP_newExceptionReports')}}"><i class="fas fa-angle-left ml-2"></i>مستثناه</a>
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
                        <th class="no-sort pr-1 align-middle data-table-row-action"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($reports as $report)
{{--                        @if($report -> type_report=='مهرب')--}}
                                <tr class="reportRow">
                                    <td><a class="nav-link">{{$report -> name_user}}</a></td>
                                    <td><a class="nav-link">{{$report -> date}} </a></td>
                                    <td ><a class="nav-link">{{$report -> type_report}}</a></td>
                                    <td class="align-middle white-space-nowrap">
                                        <div class="dropdown font-sans-serif">
                                            <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal float-right" type="button" id="dropdown0" data-toggle="dropdown">
                                                <span class="fas fa-ellipsis-h fs--1"></span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right border py-2" aria-labelledby="dropdown0">
                                                <a class="dropdown-item" href="{{route('OP_detailsReport',$report -> id)}}">عرض</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" data-toggle="modal" data-target="#myModal" href="" >تحويل</a>
                                            </div>
                                            <div class="modal fade " id="myModal">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4>تحويل البلاغ</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            هل تريد تحويل البلاغ إلى إدارة الصيدلة ؟!
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a class="btn float-right" href="{{route('OP_transferReports',$report -> id)}}" style="color: #ffffff;background-color: #0C63E4" >نعم</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </td>
                                </tr>
{{--                        @else--}}
{{--                            <tr class="reportRow">--}}
{{--                                    <td><a class="nav-link "   href="{{route('OP_detailsReport',$report -> id)}}">{{$report -> name}}</a></td>--}}
{{--                                    <td><a class="nav-link  "  href="{{route('OP_detailsReport',$report -> id)}}">{{$report -> date}} </a></td>--}}
{{--                                    <td ><a class="nav-link  " href="{{route('OP_detailsReport',$report -> id)}}">{{$report -> type_report}}</a></td>--}}
{{--                                    <td class="align-middle white-space-nowrap">--}}
{{--                                        <div class="dropdown font-sans-serif">--}}
{{--                                            <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal float-right" type="button" id="dropdown0" data-toggle="dropdown">--}}
{{--                                                <span class="fas fa-ellipsis-h fs--1"></span>--}}
{{--                                            </button>--}}
{{--                                            <div class="dropdown-menu dropdown-menu-right border py-2" aria-labelledby="dropdown0">--}}
{{--                                                <a class="dropdown-item" href="{{route('OP_detailsReport',$report -> id)}}">عرض</a>--}}
{{--                                                <div class="dropdown-divider"></div>--}}
{{--                                                <a class="dropdown-item  " href="{{route('OP_transferReports',$report -> id)}}">تحويل</a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                        @endif--}}
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{--End Content--}}

    </main>

@endsection



