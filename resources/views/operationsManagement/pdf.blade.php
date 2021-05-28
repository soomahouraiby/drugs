<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>تقرير عن بلاغات العمليات </title>

    <style>
        body{
            font-family: "XBRiyaz", sans-serif;
        }
        .sss{
            max-width: 800px;
            margin: auto;
            padding: 30px;
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
            text-align: right;
        }
        .sss card shadow mb-0 pb-0 card-body position-relative mb-0 pb-0 table table-striped{
            width: 100%;
            line-height: inherit;
            text-align: center;
        }
        .report-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }
        .report-box h3{
            text-align: center;
            color: #0F122D;
        }
        .report-box table {
            width: 100%;
            line-height: inherit;
            text-align: center;
        }

        .report-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .card shadow mb-0 pb-0{
            max-width: 800px;
            margin: auto;
            padding: 30px;
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }
        .sss row col-lg-12 card shadow col-lg-5 card-body row list-group list-group-flush{
            text-align: right;
        }

    @page {
        header: page-header;
        footer: page-footer;
    }
</style>
<body>
<div class="sss">
<h3>تقرير عن بلاغات العمليات</h3>
    <div class="row col-lg-12"  >

        {{--//////////////////////////////////////////////////////--}}
        {{--                    بيانات المبلغ                      --}}
        {{--//////////////////////////////////////////////////////--}}

        <div class="card shadow col-lg-5" style="background-color: #F9F9F9;"  >
            <div class="card-header "style="background-color: #F9F9F9;">
                <h5 class="card-title" style="color:#5468FF">بيانات المبلغ</h5>
            </div>
            <div class="card-body">
                <div class="row" >
                            <ul class="list-group list-group-flush" >
                                <li class="list-group-item" style="background-color: #F9F9F9;">
                                    <label class="Text">الاسم : </label>
                                    <label  class="ml-3">{{$name_user}}</label>
                                </li>
                                <li class="list-group-item" style="background-color: #F9F9F9;">
                                    <label class="Text">رقم الهاتف : </label>
                                    <label  class="ml-3">{{$phone_user}}</label>
                                </li>
                                <li class="list-group-item"style="background-color: #F9F9F9;">
                                    <label class="Text">العمر : </label>
                                    <label  class="ml-3 mr-4">{{$age}}</label>
                                </li>
                                <li class="list-group-item"style="background-color: #F9F9F9;">
                                    <label class="Text"> الصفه : </label>
                                    <label  class="ml-3">{{$adjective}}</label>
                                </li>
                            </ul>

                </div>
            </div>
        </div>

        {{--//////////////////////////////////////////////////////--}}
        {{--                   تفاصيل الموقع                       --}}
        {{--//////////////////////////////////////////////////////--}}

        <div class="card shadow col-lg-5 col-md-4 " style="background-color: #F9F9F9;"  >
            <div class="card-header " style="background-color: #F9F9F9;">
                <h5 class="card-title" style="color:#5468FF"> موقع البلاغ</h5>
            </div>
            <div class="card-body">
                <div class="row">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item" style="background-color: #F9F9F9;">
                                    <label class="Text"> اسم الصيدلية : </label>
                                    <label  class="ml-3">{{$pharmacy_title}}</label>
                                </li>
                                <li class="list-group-item"style="background-color: #F9F9F9;">
                                    <label class="Text">  الشارع : </label>
                                    <label  class="ml-3">{{$street_name}}</label>
                                </li>
                                <li class="list-group-item"style="background-color: #F9F9F9;">
                                    <label class="Text">  الحي : </label>
                                    <label  class="ml-3">{{$neig_name}}</label>
                                </li>
                                <li class="list-group-item"style="background-color: #F9F9F9;">
                                    <label class="Text"> وصف الموقع :</label>
                                    <label  class="ml-3">{{$site_dec}}</label>
                                </li>
                            </ul>

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
                            <ul class="list-group list-group-flush" >
                                <li class="list-group-item" style="background-color: #F9F9F9;">
                                    <label class="Text">الاسم التجاري: </label>
{{--                                    <label  class="ml-3">{{$drug_name}}</label>--}}
                                </li>
                                <li class="list-group-item" style="background-color: #F9F9F9;">
                                    <label class="Text"> الوكيل:</label>
{{--                                    <label  class="ml-3">{{$how_use}}</label>--}}
                                </li>
                                <li class="list-group-item"style="background-color: #F9F9F9;">
                                    <label class="Text">نوع الشحنة :</label>
                                    <label  class="ml-3">
{{--                                        @if($exception == 0)--}}
                                            تجارية
{{--                                        @else--}}
                                            تابعة لمنظمة(مجانية)
{{--                                        @endif--}}
                                        >>
{{--                                        @if($type == 0)--}}
                                            غير مُستثنى
{{--                                        @else--}}
                                            مُستثنى
{{--                                        @endif--}}
                                    </label>
                                </li>
                                <li class="list-group-item"style="background-color: #F9F9F9;">
                                    <label class="Text">السحب : </label>
                                    <label  class="ml-3 mr-4">
{{--                                        @if($drug_drawn == 0)--}}
                                            غير مسحوب
{{--                                        @else--}}
                                            مسحوب
{{--                                        @endif</label>--}}
                                </li>
                            </ul>
{{--                            <ul class="list-group list-group-flush" >--}}
{{--                                <li class="list-group-item" style="background-color: #F9F9F9;">--}}
{{--                                    <label class="Text">الاسم التجاري: </label>--}}
{{--                                    <label  class="ml-3">{{$commercial_name}}</label>--}}
{{--                                </li>--}}
{{--                                <li class="list-group-item"style="background-color: #F9F9F9;">--}}
{{--                                    <label class="Text">الوكيل :</label>--}}
{{--                                    <label  class="ml-3">{{$agent_name}}</label>--}}
{{--                                </li>--}}
{{--                                <li class="list-group-item"style="background-color: #F9F9F9;">--}}
{{--                                    <label class="Text">الشركة المصنعة :</label>--}}
{{--                                    <label  class="ml-3">{{$company_name}}</label></li>--}}

{{--                                <li class="list-group-item"style="background-color: #F9F9F9;">--}}
{{--                                    <label class="Text">سعر الدواء في السوق :</label>--}}
{{--                                    <label  class="ml-3">{{$drug_price}}</label>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                            <ul class="list-group list-group-flush" >--}}
{{--                                <li class="list-group-item" style="background-color: #F9F9F9;">--}}
{{--                                    <label class="Text">الاسم التجاري: </label>--}}
{{--                                    <label  class="ml-3">{{$commercial_name}}</label>--}}
{{--                                </li>--}}
{{--                                <li class="list-group-item"style="background-color: #F9F9F9;">--}}
{{--                                    <label class="Text">الوكيل :</label>--}}
{{--                                    <label  class="ml-3">{{$ragent_name}}</label>--}}
{{--                                </li>--}}
{{--                                <li class="list-group-item"style="background-color: #F9F9F9;">--}}
{{--                                    <label class="Text">الشركة المصنعة :</label>--}}
{{--                                    <label  class="ml-3">{{$company_name}}</label>--}}
{{--                                </li>--}}
{{--                                <li class="list-group-item"style="background-color: #F9F9F9;">--}}
{{--                                    <label class="Text">سعر الدواء في السوق :</label>--}}
{{--                                    <label  class="ml-3">{{$drug_price}}</label>--}}
{{--                                </li>--}}
{{--                                    <li class="list-group-item"style="background-color: #F9F9F9;">--}}
{{--                                        <label class="Text">نوع الشحنة :</label>--}}
{{--                                        <label  class="ml-3">--}}
{{--                                            @if($exception == 0)--}}
{{--                                                تجارية--}}
{{--                                            @else--}}
{{--                                                تابعة لمنظمة(مجانية)--}}
{{--                                            @endif--}}
{{--                                            >>--}}
{{--                                            @if($type == 0)--}}
{{--                                                غير مُستثنى--}}
{{--                                            @else--}}
{{--                                                مُستثنى--}}
{{--                                            @endif--}}
{{--                                        </label>--}}
{{--                                    </li>--}}
{{--                                    <li class="list-group-item"style="background-color: #F9F9F9;">--}}
{{--                                        <label class="Text">السحب : </label>--}}
{{--                                        <label  class="ml-3 mr-4">--}}
{{--                                            @if($drug_drawn == 0)--}}
{{--                                                غير مسحوب--}}
{{--                                            @else--}}
{{--                                                مسحوب--}}
{{--                                            @endif--}}
{{--                                        </label>--}}
{{--                                    </li>--}}
{{--                                    <li class="list-group-item"style="background-color: #F9F9F9;">--}}
{{--                                        --}}{{--                                        <div class="card-img-top" >--}}
{{--                                        --}}{{--                                            <img class="card-img-top img-fluid"--}}
{{--                                        --}}{{--                                                 src="{{ asset('images/' . $reports -> drug_photo) }}">--}}
{{--                                        --}}{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                            </ul>--}}
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
                            <ul class="list-group list-group-flush ">
                                <li class="list-group-item" style="background-color: #F9F9F9;">
                                    <label class="Text"> نوع البلاغ :</label>
                                    <label  class="ml-3">{{$type_report}}</label>
                                </li>
                                <li class="list-group-item"style="background-color: #F9F9F9;">
                                    <label class="Text">تاريخ البلاغ :</label>
                                    <label  class="ml-3">{{$date}}</label>
                                </li>
                                <li class="list-group-item"style="background-color: #F9F9F9;">
                                    <label class="Text"> ملاحظة المبلغ :</label>
                                    <label  class="ml-3">{{$notes_user}}</label>
                                </li>
                                <li class="list-group-item"style="background-color: #F9F9F9;">
                                    <label>مرفق</label>
                                    <div class="card-img-top" >
                                        <img class="card-img-top img-fluid"
                                             src="{{  $drug_photo}}">
                                    </div>
                                </li>
                            </ul>

                </div>
            </div>
        </div>
    </div>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</div>
</body>

</html>
