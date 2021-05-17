@extends('layouts\master')
@section('content')

    <main class="col-md-8 ms-sm-auto col-lg-10 px-md-4 ">

        {{--Start Content Title--}}

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 pr-2  border-bottom main " >
            <h1 class="h2  ml-4 mt-4">تفاصيل الدواء</h1>
        </div>

        {{--End Content Title--}}



        {{--Start Content--}}

        {{--//////////////////////////////////////////////////////--}}
        {{--                       بيانات الدواء                   --}}
        {{--//////////////////////////////////////////////////////--}}

        <div class="row col-lg-12" style="width: 100%" >

            {{--//////////////////////////////////////////////////////--}}
            {{--                    بيانات الدواء                      --}}
            {{--//////////////////////////////////////////////////////--}}

            <div class="card shadow col-lg-5" style="width: 50% ;background-color: #F9F9F9;"  >
                <div class="card-header "style="background-color: #F9F9F9;">
                    <h5 class="card-title" style="color:#5468FF">تفاصيل الدواء</h5>
                </div>
                <div class="card-body">
                    <div class="row" >
                        @if(isset($drugs))
                            @foreach($drugs as $drug)
                                <ul class="list-group list-group-flush" >
                                    <li class="list-group-item" style="background-color: #F9F9F9;">
                                        <label class="Text">الاسم التجاري : </label>
                                        <label  class="ml-3">{{$drug -> drug_name}}</label>
                                    </li>
                                    <li class="list-group-item" style="background-color: #F9F9F9;">
                                        <label class="Text">الاسم العلمي : </label>
                                        <label  class="ml-3">{{$drug -> material_name}}</label>
                                    </li>
                                    <li class="list-group-item"style="background-color: #F9F9F9;">
                                        <label class="Text">قوة التركيز : </label>
                                        <label  class="ml-3 mr-4">{{$drug -> size}}{{$drug -> name}}</label>
                                    </li>
                                    <li class="list-group-item"style="background-color: #F9F9F9;">
                                        <label class="Text">دواعي الأستخدام: </label>
                                        <label  class="ml-3 mr-4">{{$drug -> indications_use}}</label>
                                    </li>
                                    <li class="list-group-item"style="background-color: #F9F9F9;">
                                        <label class="Text">طريقة الإستعمال: </label>
                                        <label  class="ml-3 mr-4">{{$drug -> how_use}}</label>
                                    </li>
                                    <li class="list-group-item"style="background-color: #F9F9F9;">
                                        <label class="Text">الشكل الصيدلاني : </label>
                                        <label  class="ml-3 mr-4">{{$drug -> drug_form}}</label>
                                    </li>
                                    <li class="list-group-item"style="background-color: #F9F9F9;">
                                        <label class="Text">رقم التسجيل  : </label>
                                        <label  class="ml-3 mr-4">{{$drug -> register_no}}</label>
                                    </li>
                                    <li class="list-group-item"style="background-color: #F9F9F9;">
                                        <label class="Text">الأثار الجانبية : </label>
                                        <label  class="ml-3 mr-4">{{$drug -> side_effects}}</label>
                                    </li>
                                    <li class="list-group-item"style="background-color: #F9F9F9;">
                                        <label class="Text">الشركة المصنعة  : </label>
                                        <label  class="ml-3 mr-4">{{$drug -> company_name}}</label>
                                    </li>
                                    <li class="list-group-item"style="background-color: #F9F9F9;">
                                        <label class="Text">بلد الشركة المصنعة  : </label>
                                        <label  class="ml-3 mr-4">{{$drug -> country}}</label>
                                    </li>
                                </ul>
                                @break($drug)
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            {{--//////////////////////////////////////////////////////--}}
            {{--                   تفاصيل الموقع                       --}}
            {{--//////////////////////////////////////////////////////--}}

            <div class="container col-lg-6 " style="margin-top:6%" >
                <div class="card shadow col-lg-10" style="background-color: #F9F9F9; "  >
                    <div class="card-header "style="background-color: #F9F9F9;">
                        <h5 class="card-title" style="color:#5468FF">بيانات الوكيل</h5>
                    </div>
                    <div class="card-body">
                        <div class="row" >
                            @if(isset($drugs))
                                @foreach($drugs as $drug)
                                    <ul class="list-group list-group-flush" >
                                        <li class="list-group-item" style="background-color: #F9F9F9;">
                                            <label class="Text">اسم الوكيل : </label>
                                            <label  class="ml-3">{{$drug -> agent_name}}</label>
                                        </li>
                                        <li class="list-group-item" style="background-color: #F9F9F9;">
                                            <label class="Text">رقم الهاتف : </label>
                                            <label  class="ml-3">{{$drug -> phone}}</label>
                                        </li>
                                        <li class="list-group-item"style="background-color: #F9F9F9;">
                                            <label class="Text">البريد الإلكتروني : </label>
                                            <label  class="ml-3 mr-4">{{$drug -> email}}</label>
                                        </li>
                                        <li class="list-group-item"style="background-color: #F9F9F9;">
                                            <label class="Text">عنوان الوكيل : </label>
                                            <label  class="ml-3 mr-4">{{$drug -> address}}</label>
                                        </li>
                                    </ul>
                                    @break($drug)
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card shadow col-lg-12" style="background-color: #F9F9F9;"  >
                    <div class="card-header "style="background-color: #F9F9F9;">
                        <h5 class="card-title" style="color:#5468FF">بيانات الشحنة</h5>
                    </div>
                    <div class="card-body">
                        <div class="row" >
                            @if(isset($drugs))
                                @foreach($drugs as $drug)
                                    <ul class="list-group list-group-flush" >
                                        <li class="list-group-item" style="background-color: #F9F9F9;">
                                            <label class="Text">رقم التشغيلة  : </label>
                                            <label  class="ml-3">{{$drug -> batch_num}}</label>
                                        </li>
                                        <li class="list-group-item" style="background-color: #F9F9F9;">
                                            <label class="Text">تاريخ الإنتاج : </label>
                                            <label  class="ml-3">{{$drug -> production_date}}</label>
                                        </li>
                                        <li class="list-group-item"style="background-color: #F9F9F9;">
                                            <label class="Text">تاريخ الإنتهاء  : </label>
                                            <label  class="ml-3 mr-4">{{$drug -> expiry_date}}</label>
                                        </li>
                                        <li class="list-group-item"style="background-color: #F9F9F9;">
                                            <label class="Text">سعر الصنف : </label>
                                            <label  class="ml-3 mr-4">{{$drug -> price}}</label>
                                        </li>
                                        <li class="list-group-item"style="background-color: #F9F9F9;">
                                            <label class="Text">الكمية : </label>
                                            <label  class="ml-3 mr-4">{{$drug -> quantity}}</label>
                                        </li>
                                        <li class="list-group-item"style="background-color: #F9F9F9;">
                                            <label class="Text">نوع الشحنة : </label>
                                            <label  class="ml-3 mr-4">
                                                @if($drug -> exception == 0)
                                                    تجارية
                                                @else
                                                    تابعة لمنظمة(مجانية)
                                                @endif

                                            </label>
                                        </li>
                                        <li class="list-group-item"style="background-color: #F9F9F9;">
                                            <label class="Text">الاستثناء : </label>
                                            <label  class="ml-3 mr-4">
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

                                    </ul>
                                    @break($drug)
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>



        {{--End Content--}}

    </main>

@endsection
