@extends('layouts\master')
@section('content')

    <main class="col-md-8 ms-sm-auto col-lg-10 px-md-4 ">

        {{--Start Content Title--}}
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 pr-2  border-bottom main " >
            <h1 class="h2  ml-4">متابعة بلاغ وارد</h1>

        </div>

        {{--End Content Title--}}


        {{--Content--}}
        {{--//////////////////////////////////////////////////////--}}
        {{--                    موضوع البلاغ                        --}}
        {{--//////////////////////////////////////////////////////--}}

        <div class="card shadow mb-0 pb-0" >
            <div class="card-header " style="background-color: #F9F9F9;">
                <div class="row m-2 ">
                    <h4>موضوع البلاغ</h4>
                </div>
            </div>
            <div class="card-body position-relative mb-0 pb-0" style="background-color: #F9F9F9;">
                <form>
                    @if(isset($reports))
                        @foreach($reports as $report)
                            <div class="form-group raw mt-2 " style="display: flex; flex-wrap: wrap;  ">
                                <label class="col-form-label Text ml-3 mr-4 ">اسم المبلغ : </label>
                                <label class="col-form-label  ml-2 mr-4  ">{{$report -> name_user}}  </label>
                                <label class="col-form-label Text ml-5 mr-4 ">رقم الهاتف : </label>
                                <label class="col-form-label  ml-2 mr-4  ">{{$report -> phone_user}}  </label>
                            </div>
                            <div class="form-group raw mt-4  border-bottom " style="display: flex; flex-wrap: wrap; ">
                                <label class="col-form-label  Text ml-3 mr-4 ">نوع البلاغ : </label>
                                <label class="col-form-label  ml-2 mr-4 ">{{$report -> type_report}}  </label>
                                <label class="col-form-label Text  ml-5 mr-4 ">اسم الصيدلية : </label>
                                <label class="col-form-label ml-2 mr-4  ">{{$report -> pharmacy_title}}  </label>
                                <label class="col-form-label Text  ml-5 mr-4 ">تاريخ البلاغ : </label>
                                <label class="col-form-label ml-2 mr-4 mb-3  ">{{$report -> date}}  </label>
                            </div>
                            <div class="form-group raw mt-4  ">
                                <a class="text-center col-form-label mb-3"  href="{{route('OP_detailsReport',$report->report_no)}}" style="margin-right: 20%"> تفاصيل البلاغ</a>
                            </div>
                        @endforeach
                    @endif
                </form>
            </div>
        </div>


        {{--//////////////////////////////////////////////////////--}}
        {{--                    متابعة البلاغ                        --}}
        {{--//////////////////////////////////////////////////////--}}

        <div class="card shadow mt-5" >
            <div class="card-header " style="background-color: #F9F9F9;">
                <div class="row m-2">
                    <h4>الإجراءات المتخذه حيال البلاغ</h4>
                </div>
            </div>
            <div class="card-body position-relative mb-0 pb-0" style="background-color: #F9F9F9;">
                <div class="row pb-5">
                    @foreach($procedures as $procedure)
                        @if($procedure->report_id == $report->report_no)
                            <div class="form-group raw mt-4 col-lg-12 " style="display: flex; flex-wrap: wrap; ">
                                <label class="col-form-label col-lg-2  Text ml-3 ">  التاريخ : </label>
                                <label class="  col-lg-8 mt-2">{{$procedure -> date}}</label>
                            </div>
                            <div class="form-group raw mt-4 col-lg-12 " style="display: flex; flex-wrap: wrap; ">
                                <label class="col-form-label col-lg-2  Text ml-3 ">  الإجراء المتخذ : </label>
                                <label class="  col-lg-8 mt-2">{{$procedure -> procedure}}</label>
                            </div>
                            <div class="form-group raw mt-4 col-lg-12 border-bottom" style="display: flex; flex-wrap: wrap; ">
                                <label class="col-form-label col-lg-2 Text  ml-3 ">  الــنــتــائــج : </label>
                                <label class="  col-lg-8 mt-2">{{$procedure -> result}}</label>
                            </div>
                        @endif
                    @endforeach
                </div>
                @if($report->report_statuses == 'تم الانهاء')
                    @foreach($reports as $report)
                        <div class="form-group raw col-lg-12 " style="display: flex; flex-wrap: wrap; ">
                            <label class="col-form-label col-lg-3  Text ml-3 ">  ملاحظة مدير العمليات : </label>
                            <label class="  col-lg-8 mt-2">{{$report -> opmanage_notes}}</label>
                        </div>
                        <button class="btn float-right mb-5 button" data-toggle="modal" data-target="#myModal" style="background-color: #0C63E4 ; color: #ffffff " >تعديل الملاحظة </button>
                        <div class="modal fade " id="myModal">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4>تعديل</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{route('OP_saveOPMNotes',$report -> report_no)}}">
                                            @csrf
                                            <div class=" mt-2 col-lg-12 ">
                                                <textarea class="form-control" name="opmanage_notes"  rows="3" >{{$report -> opmanage_notes}}</textarea>
                                            </div>
                                            <button class="btn mt-3 float-right "  type="submit"  style="background-color: #0C63E4 ; color: #ffffff ">حفظ</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                @elseif($report->report_statuses == 'تمت المتابعة')
                        <button class="btn float-right mb-5 button" data-toggle="modal" data-target="#myModal" style="background-color: #0C63E4 ; color: #ffffff " >إنهاء البلاغ </button>
                        <div class="modal fade " id="myModal">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4>إضافة ملاحظة</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{route('OP_saveOPMNotes',$report -> report_no)}}">
                                            @csrf
                                            <div class=" mt-2 col-lg-12 ">
                                                <textarea class="form-control" name="opmanage_notes"  rows="3" ></textarea>
                                            </div>
                                            <button class="btn mt-3 float-right "  type="submit"  style="background-color: #0C63E4 ; color: #ffffff ">حفظ</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                @endif
            </div>
        </div>



{{--        --}}{{--Start Content--}}

{{--    <!--//////////////////////////////////////////////////////-->--}}
{{--        <!--                      موضوع البلاغ                      -->--}}
{{--        <!--//////////////////////////////////////////////////////-->--}}

{{--        <div class="card shadow mb-0 pb-0" >--}}
{{--            <div class="card-header " style="background-color: #F9F9F9;">--}}
{{--                <div class="row m-2 ">--}}
{{--                    <h4>موضوع البلاغ</h4>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="card-body position-relative mb-0 pb-0" style="background-color: #F9F9F9;">--}}
{{--                <form>--}}
{{--                    @if(isset($report))--}}
{{--                        @foreach($report as $reports)--}}
{{--                            @if($reports -> type_report=='مهرب')--}}
{{--                            <div class="form-group raw mt-2 " style="display: flex; flex-wrap: wrap;  ">--}}
{{--                                <label class="col-form-label Text ml-3 mr-4 ">اسم المبلغ : </label>--}}
{{--                                <label class="col-form-label  ml-2 mr-4  ">{{$reports -> app_user_name}}  </label>--}}
{{--                                <label class="col-form-label Text ml-5 mr-4 ">رقم الهاتف : </label>--}}
{{--                                <label class="col-form-label  ml-2 mr-4  ">{{$reports -> app_user_phone}}  </label>--}}
{{--                            </div>--}}
{{--                            <div class="form-group raw mt-4  border-bottom " style="display: flex; flex-wrap: wrap; ">--}}
{{--                                <label class="col-form-label  Text ml-3 mr-4 ">نوع البلاغ : </label>--}}
{{--                                <label class="col-form-label  ml-2 mr-4 ">{{$reports -> type_report}}  </label>--}}
{{--                                <label class="col-form-label Text  ml-5 mr-4 ">اسم الصيدلية : </label>--}}
{{--                                <label class="col-form-label ml-2 mr-4  ">{{$reports -> pharmacy_name}}  </label>--}}
{{--                                <label class="col-form-label Text  ml-5 mr-4 ">تاريخ البلاغ : </label>--}}
{{--                                <label class="col-form-label ml-2 mr-4 mb-3  ">{{$reports -> report_date}}  </label>--}}
{{--                            </div>--}}
{{--                            <div class="form-group raw mt-4  ">--}}
{{--                                <a class="text-center col-form-label mb-3"  href="{{route('OP_detailsSmuggledReport2',$reports -> report_no)}}" style="margin-right: 45%"> تفاصيل البلاغ</a>--}}
{{--                            </div>--}}
{{--                            @else--}}
{{--                                <div class="form-group raw mt-2 " style="display: flex; flex-wrap: wrap;  ">--}}
{{--                                    <label class="col-form-label Text ml-3 mr-4 ">اسم المبلغ : </label>--}}
{{--                                    <label class="col-form-label  ml-2 mr-4  ">{{$reports -> app_user_name}}  </label>--}}
{{--                                    <label class="col-form-label Text ml-5 mr-4 ">رقم الهاتف : </label>--}}
{{--                                    <label class="col-form-label  ml-2 mr-4  ">{{$reports -> app_user_phone}}  </label>--}}
{{--                                </div>--}}
{{--                                <div class="form-group raw mt-4  border-bottom " style="display: flex; flex-wrap: wrap; ">--}}
{{--                                    <label class="col-form-label  Text ml-3 mr-4 ">نوع البلاغ : </label>--}}
{{--                                    <label class="col-form-label  ml-2 mr-4 ">{{$reports -> type_report}}  </label>--}}
{{--                                    <label class="col-form-label Text  ml-5 mr-4 ">اسم الصيدلية : </label>--}}
{{--                                    <label class="col-form-label ml-2 mr-4  ">{{$reports -> pharmacy_name}}  </label>--}}
{{--                                    <label class="col-form-label Text  ml-5 mr-4 ">تاريخ البلاغ : </label>--}}
{{--                                    <label class="col-form-label ml-2 mr-4 mb-3  ">{{$reports -> report_date}}  </label>--}}
{{--                                </div>--}}
{{--                                <div class="form-group raw mt-4  ">--}}
{{--                                    <a class="text-center col-form-label mb-3"  href="{{route('OP_detailsReport2',$reports -> report_no)}}" style="margin-right: 45%"> تفاصيل البلاغ</a>--}}
{{--                                </div>--}}
{{--                            @endif--}}
{{--                        @endforeach--}}
{{--                    @endif--}}
{{--                    @if(isset($report2))--}}
{{--                            @foreach($report2 as $reports2)--}}
{{--                                @if($reports2 -> type_report=='مهرب')--}}
{{--                                    <div class="form-group raw mt-2 " style="display: flex; flex-wrap: wrap;  ">--}}
{{--                                        <label class="col-form-label Text ml-3 mr-4 ">اسم المبلغ : </label>--}}
{{--                                        <label class="col-form-label  ml-2 mr-4  ">{{$reports2 -> authors_name}}  </label>--}}
{{--                                        <label class="col-form-label Text ml-5 mr-4 ">رقم الهاتف : </label>--}}
{{--                                        <label class="col-form-label  ml-2 mr-4  ">{{$reports2 -> authors_phone}}  </label>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group raw mt-4  border-bottom " style="display: flex; flex-wrap: wrap; ">--}}
{{--                                        <label class="col-form-label  Text ml-3 mr-4 ">نوع البلاغ : </label>--}}
{{--                                        <label class="col-form-label  ml-2 mr-4 ">{{$reports2 -> type_report}}  </label>--}}
{{--                                        <label class="col-form-label Text  ml-5 mr-4 ">اسم الصيدلية : </label>--}}
{{--                                        <label class="col-form-label ml-2 mr-4  ">{{$reports2 -> pharmacy_name}}  </label>--}}
{{--                                        <label class="col-form-label Text  ml-5 mr-4 ">تاريخ البلاغ : </label>--}}
{{--                                        <label class="col-form-label ml-2 mr-4 mb-3  ">{{$reports2 -> report_date}}  </label>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group raw mt-4  ">--}}
{{--                                        <a class="text-center col-form-label mb-3"  href="{{route('OP_detailsSmuggledReport2',$reports2 -> report_no)}}" style="margin-right: 45%"> تفاصيل البلاغ</a>--}}
{{--                                    </div>--}}

{{--                                @else--}}
{{--                                    <div class="form-group raw mt-2 " style="display: flex; flex-wrap: wrap;  ">--}}
{{--                                        <label class="col-form-label Text ml-3 mr-4 ">اسم المبلغ : </label>--}}
{{--                                        <label class="col-form-label  ml-2 mr-4  ">{{$reports2 -> authors_name}}  </label>--}}
{{--                                        <label class="col-form-label Text ml-5 mr-4 ">رقم الهاتف : </label>--}}
{{--                                        <label class="col-form-label  ml-2 mr-4  ">{{$reports2 -> authors_phone}}  </label>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group raw mt-4  border-bottom " style="display: flex; flex-wrap: wrap; ">--}}
{{--                                        <label class="col-form-label  Text ml-3 mr-4 ">نوع البلاغ : </label>--}}
{{--                                        <label class="col-form-label  ml-2 mr-4 ">{{$reports2 -> type_report}}  </label>--}}
{{--                                        <label class="col-form-label Text  ml-5 mr-4 ">اسم الصيدلية : </label>--}}
{{--                                        <label class="col-form-label ml-2 mr-4  ">{{$reports2 -> pharmacy_name}}  </label>--}}
{{--                                        <label class="col-form-label Text  ml-5 mr-4 ">تاريخ البلاغ : </label>--}}
{{--                                        <label class="col-form-label ml-2 mr-4 mb-3  ">{{$reports2 -> report_date}}  </label>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group raw mt-4  ">--}}
{{--                                        <a class="text-center col-form-label mb-3"  href="{{route('OP_detailsReport2',$reports2 -> report_no)}}" style="margin-right: 45%"> تفاصيل البلاغ</a>--}}
{{--                                    </div>--}}
{{--                                @endif--}}
{{--                            @endforeach--}}
{{--                        @endif--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <!--//////////////////////////////////////////////////////-->--}}
{{--        <!--                    متابعة البلاغ                        -->--}}
{{--        <!--//////////////////////////////////////////////////////-->--}}

{{--        <div class="card shadow mt-5" >--}}
{{--            <div class="card-header " style="background-color: #F9F9F9;">--}}
{{--                <div class="row m-2">--}}
{{--                    <h4>الإجراءات المتخذه حيال البلاغ</h4>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="card-body position-relative mb-0 pb-0" style="background-color: #F9F9F9;">--}}
{{--                <table class="table table-striped ">--}}
{{--                    <thead >--}}
{{--                    <tr>--}}
{{--                        <th>تــاريــخ الإجراء</th>--}}
{{--                        <th> الإجراء المتخذ</th>--}}
{{--                        <th>الــنــتــائــج</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    @if(isset($procedures))--}}
{{--                        @foreach($procedures as $procedure)--}}
{{--                            <tr class="reportRow">--}}
{{--                                <td>{{$procedure -> procedure_date}}</td>--}}
{{--                                <td>{{$procedure -> procedure}}</td>--}}
{{--                                <td>{{$procedure -> procedure_result}}</td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                    @endif--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </div>--}}
{{--            @if(isset($report))--}}
{{--                @foreach($report as $reports)--}}
{{--                    <div class="row pb-5">--}}
{{--                        <div class="col-lg">--}}
{{--                            <button class="btn " type="submit" style="margin-right:90%; width: 10%; background-color: #0F122D; color:#ffffff">--}}
{{--                                <a  href="{{route('OP_editReport',$reports -> report_no)}}">انهاء</a></button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            @endif--}}
{{--            @if(isset($report2))--}}
{{--                @foreach($report2 as $reports2)--}}
{{--                    <div class="row pb-5">--}}
{{--                        <div class="col-lg">--}}
{{--                            <button class="btn " type="submit" style="margin-right:90%; width: 10%; background-color: #0F122D; color:#ffffff">--}}
{{--                                <a  href="{{route('OP_editReport',$reports2 -> report_no)}}">انهاء</a></button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            @endif--}}
{{--        </div>--}}
{{--        --}}{{--End Content--}}

    </main>

@endsection
