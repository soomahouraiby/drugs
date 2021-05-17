@extends('layouts\master')
@section('content')

    <main class="col-md-8 ms-sm-auto col-lg-10 px-md-4 ">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 pr-2  border-bottom main " >
            <h1 class="h2   ml-2 mt-2 mb-2">تفاصيل بلاغ وارد</h1>
            @if(isset($reports))
                @foreach($reports as $report)
                    @if($report->state==0)
                         <div class="dropdown">
                            <button type="button" class="btn btn-sm  dropdown-toggle mr-4 ml-4 button" data-toggle="dropdown" id="btn">
                                الجهه المُحال إليها
                            </button>
                            <div class="dropdown-menu dropdown-menu-right bg-light">
                                <a class="dropdown-item " href="{{route('OP_transferReports',$report -> id)}}" >إدارة الصيدلة</a>
                            </div>
                         </div>
                    @else
                        <div >
                            <h6 class="mr-4 " style="font-size: 17px">
                                <i class="fas fa-angle-double-right ml-2"></i>
                                {{$report->report_statuses}}
                                <i class="fas fa-angle-double-left mr-2"></i>
                            </h6>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>

        {{--Title--}}


        {{--Start Content--}}
         <div class="row col-lg-12" style="width: 100%" >

                {{--//////////////////////////////////////////////////////--}}
                {{--                    بيانات المبلغ                      --}}
                {{--//////////////////////////////////////////////////////--}}

                <div class="card shadow col-lg-5" style="width: 50% ;background-color: #F9F9F9;"  >
                    <div class="card-header "style="background-color: #F9F9F9;">
                        <h5 class="card-title" style="color:#5468FF">بيانات المبلغ</h5>
                    </div>
                    <div class="card-body">
                        <div class="row" >
                            @if(isset($reports))
                                @foreach($reports as $report)
                                    <ul class="list-group list-group-flush" >
                                        <li class="list-group-item" style="background-color: #F9F9F9;">
                                            <label class="Text">الاسم : </label>
                                            <label  class="ml-3">{{$report -> name_user}}</label>
                                        </li>
                                        <li class="list-group-item" style="background-color: #F9F9F9;">
                                            <label class="Text">رقم الهاتف : </label>
                                            <label  class="ml-3">{{$report -> phone_user}}</label>
                                        </li>
                                        <li class="list-group-item"style="background-color: #F9F9F9;">
                                            <label class="Text">العمر : </label>
                                            <label  class="ml-3 mr-4">{{$report -> age}}</label>
                                        </li>
                                        <li class="list-group-item"style="background-color: #F9F9F9;">
                                            <label class="Text"> الصفه : </label>
                                            <label  class="ml-3">{{$report -> adjective}}</label>
                                        </li>
                                    </ul>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                {{--//////////////////////////////////////////////////////--}}
                {{--                   تفاصيل الموقع                       --}}
                {{--//////////////////////////////////////////////////////--}}

                <div class="card shadow col-lg-5 col-md-4 " style="width: 50%;background-color: #F9F9F9;"  >
                    <div class="card-header " style="background-color: #F9F9F9;">
                        <h5 class="card-title" style="color:#5468FF"> موقع البلاغ</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if(isset($reports))
                                @foreach($reports as $report)
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item" style="background-color: #F9F9F9;">
                                            <label class="Text"> اسم الصيدلية : </label>
                                            <label  class="ml-3">{{$report -> pharmacy_title}}</label>
                                        </li>
                                        <li class="list-group-item"style="background-color: #F9F9F9;">
                                            <label class="Text">  الشارع : </label>
                                            <label  class="ml-3">{{$report -> street_name}}</label>
                                        </li>
                                        <li class="list-group-item"style="background-color: #F9F9F9;">
                                            <label class="Text">  الحي : </label>
                                            <label  class="ml-3">{{$report -> neig_name}}</label>
                                        </li>
                                        <li class="list-group-item"style="background-color: #F9F9F9;">
                                            <label class="Text"> وصف الموقع :</label>
                                            <label  class="ml-3">{{$report -> site_dec}}</label>
                                        </li>
                                    </ul>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>

         <div class="row col-lg-12" style="" >

                {{--//////////////////////////////////////////////////////--}}
                {{--                    تفاصيل الدواء                      --}}
                {{--//////////////////////////////////////////////////////--}}

                <div class="card shadow col-lg-5 col-md-4" style=" background-color: #F9F9F9;"  >
                    <div class="card-header "style="background-color: #F9F9F9;">
                        <h5 class="card-title nav-link" style="color:#5468FF">تفاصيل الدواء</h5>
                    </div>
                    <div class="card-body">
                        <div class="row" >
                            @if($report -> type_report == 'مسحوب')
                                @foreach($drugs as $drug)
                                    <ul class="list-group list-group-flush" >
                                        <li class="list-group-item" style="background-color: #F9F9F9;">
                                            <label class="Text">الاسم التجاري: </label>
                                            <label  class="ml-3">{{$drug -> drug_name}}</label>
                                        </li>
                                        <li class="list-group-item" style="background-color: #F9F9F9;">
                                            <label class="Text"> الوكيل:</label>
                                            <label  class="ml-3">{{$drug -> how_use}}</label>
                                        </li>
                                        <li class="list-group-item"style="background-color: #F9F9F9;">
                                            <label class="Text">نوع الشحنة :</label>
                                            <label  class="ml-3">
                                                @if($drug -> exception == 0)
                                                    تجارية
                                                @else
                                                    تابعة لمنظمة(مجانية)
                                                @endif
                                                >>
                                                @if($drug -> type == 0)
                                                    غير مُستثنى
                                                @else
                                                    مُستثنى
                                                @endif
                                            </label>
                                        </li>
                                        <li class="list-group-item"style="background-color: #F9F9F9;">
                                            <label class="Text">السحب : </label>
                                            <label  class="ml-3 mr-4">
                                                @if($drug -> drug_drawn == 0)
                                                    غير مسحوب
                                                @else
                                                    مسحوب
                                                @endif</label>
                                            <a class="btn float-right" href="{{route('OP_detailsDrug',$report -> id)}}">المزيد</a>
                                        </li>
                                    </ul>
                                @endforeach
                            @elseif($report -> type_report == 'مهرب')
                                @foreach($reports as $report)
                                    <ul class="list-group list-group-flush" >
                                        <li class="list-group-item" style="background-color: #F9F9F9;">
                                            <label class="Text">الاسم التجاري: </label>
                                            <label  class="ml-3">{{$report -> commercial_name}}</label>
                                        </li>
                                        <li class="list-group-item"style="background-color: #F9F9F9;">
                                            <label class="Text">الوكيل :</label>
                                            <label  class="ml-3">{{$report -> agent_name}}</label>
                                        </li>
                                        <li class="list-group-item"style="background-color: #F9F9F9;">
                                            <label class="Text">الشركة المصنعة :</label>
                                            <label  class="ml-3">{{$report -> company_name}}</label></li>

                                        <li class="list-group-item"style="background-color: #F9F9F9;">
                                            <label class="Text">سعر الدواء في السوق :</label>
                                            <label  class="ml-3">{{$report -> drug_price}}</label>
                                        </li>
                                    </ul>
                                @endforeach
                            @elseif($report -> type_report == 'غير مطابق')
                                @foreach($reports as $report)
                                    <ul class="list-group list-group-flush" >
                                        <li class="list-group-item" style="background-color: #F9F9F9;">
                                            <label class="Text">الاسم التجاري: </label>
                                            <label  class="ml-3">{{$report -> commercial_name}}</label>
                                        </li>
                                        <li class="list-group-item"style="background-color: #F9F9F9;">
                                            <label class="Text">الوكيل :</label>
                                            <label  class="ml-3">{{$report -> agent_name}}</label>
                                        </li>
                                        <li class="list-group-item"style="background-color: #F9F9F9;">
                                            <label class="Text">الشركة المصنعة :</label>
                                            <label  class="ml-3">{{$report -> company_name}}</label>
                                        </li>
                                        <li class="list-group-item"style="background-color: #F9F9F9;">
                                            <label class="Text">سعر الدواء في السوق :</label>
                                            <label  class="ml-3">{{$report -> drug_price}}</label>
                                        </li>
                                        @foreach($drugs as $drug)
                                            <li class="list-group-item"style="background-color: #F9F9F9;">
                                                <label class="Text">نوع الشحنة :</label>
                                                <label  class="ml-3">
                                                    @if($drug -> exception == 0)
                                                        تجارية
                                                    @else
                                                        تابعة لمنظمة(مجانية)
                                                    @endif
                                                    >>
                                                    @if($drug -> type == 0)
                                                        غير مُستثنى
                                                    @else
                                                        مُستثنى
                                                    @endif
                                                </label>
                                            </li>
                                            <li class="list-group-item"style="background-color: #F9F9F9;">
                                                <label class="Text">السحب : </label>
                                                <label  class="ml-3 mr-4">
                                                    @if($drug -> drug_drawn == 0)
                                                        غير مسحوب
                                                    @else
                                                        مسحوب
                                                    @endif
                                                </label>
                                            </li>
                                            <li class="list-group-item"style="background-color: #F9F9F9;">
                                                {{--                                        <div class="card-img-top" >--}}
                                                {{--                                            <img class="card-img-top img-fluid"--}}
                                                {{--                                                 src="{{ asset('images/' . $reports -> drug_photo) }}">--}}
                                                {{--                                        </div>--}}
                                                <a class="btn" type="button" href="{{route('OP_detailsDrug',$report -> id)}}" style="margin-right: 100%">المزيد</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                {{--//////////////////////////////////////////////////////--}}
                {{--                    موضوع البلاغ                        --}}
                {{--//////////////////////////////////////////////////////--}}

                <div class="card shadow col-lg-5 col-md-4" style="background-color: #F9F9F9;"  >
                    <div class="card-header " style="background-color: #F9F9F9;">
                        <h5 class="card-title" style="color:#5468FF"> موضوع البلاغ</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if(isset($reports))
                                @foreach($reports as $report)
                                    <ul class="list-group list-group-flush ">
                                        <li class="list-group-item" style="background-color: #F9F9F9;">
                                            <label class="Text"> نوع البلاغ :</label>
                                            <label  class="ml-3">{{$report -> type_report}}</label>
                                        </li>
                                        <li class="list-group-item"style="background-color: #F9F9F9;">
                                            <label class="Text">تاريخ البلاغ :</label>
                                            <label  class="ml-3">{{$report -> date}}</label>
                                        </li>
                                        <li class="list-group-item"style="background-color: #F9F9F9;">
                                            <label class="Text"> ملاحظة المبلغ :</label>
                                            <label  class="ml-3">{{$report -> notes_user}}</label>
                                        </li>
                                        <li class="list-group-item"style="background-color: #F9F9F9;">
                                            <label>مرفق</label>
                                            <div class="card-img-top" >
                                                <img class="card-img-top img-fluid"
                                                     src="{{  $report -> drug_picture}}">
                                            </div>
                                        </li>
                                    </ul>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        {{--End Content--}}

    </main>

@endsection

