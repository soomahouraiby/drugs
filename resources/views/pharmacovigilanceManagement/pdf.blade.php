<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>تقرير عن بلاغات التيقظ الدوائي </title>

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

    @page {
        header: page-header;
        footer: page-footer;
    }
</style>
<body>
{{--<div class="report-box">--}}
{{--    <h3> بلاغات التيقظ الدوائي</h3>--}}
{{--    <br><br>--}}
{{--    <table cellpadding="0" cellspacing="0" border="1">--}}
{{--                    <thead >--}}
{{--                    <tr>--}}
{{--                        <th>مستخدم الدواء</th>--}}
{{--                        <th>نوع البلاغ</th>--}}
{{--                        <th>التاريخ</th>--}}
{{--                        <th>اسم المبلغ</th>--}}

{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    <tr class="reportRow">--}}
{{--                        @if(isset($data))--}}
{{--                        @for($i=0;$i<count($data);$i++)--}}
{{--                        <td >{{$user_name}}</td>--}}
{{--                        <td >{{$type_report}}</td>--}}
{{--                        <td>{{$date_report}} </td>--}}
{{--                        <td>{{$name}}</td>--}}
{{--                        @endfor--}}
{{--                            @endif--}}
{{--                    </tr>--}}
{{--                    </tbody>--}}
{{--    </table>--}}
{{--</div>--}}
<div class="sss">

{{--//////////////////////////////////////////////////////--}}
{{--                       بيانات المبلغ                   --}}
{{--//////////////////////////////////////////////////////--}}
<div class="card shadow mb-0 pb-0" >
    <div class="card-header " style="background-color: #F9F9F9;">
        <div class="row m-2 ">
            <h4>بيانات المبلغ</h4>
        </div>
    </div>
    <div class="card-body position-relative mb-0 pb-0" style="background-color: #F9F9F9;">
        <form>
                    <div class="form-group raw mt-2 " style="display: flex; flex-wrap: wrap;  ">
                        <label class="col-form-label Text ml-3 mr-4 ">اسم المبلغ : </label>
                        <label class="col-form-label  ml-2 mr-4  ">{{$name}}  </label>
                        <label class="col-form-label Text ml-5 mr-4 ">رقم الهاتف : </label>
                        <label class="col-form-label  ml-2 mr-4  ">{{$phone}}  </label>
                        <label class="col-form-label Text ml-5 mr-4 ">البريد الالكتروني : </label>
                        <label class="col-form-label  ml-2 mr-4  ">{{$email}}  </label>
                    </div>
                    <div class="form-group raw mt-4  border-bottom " style="display: flex; flex-wrap: wrap; ">
                        <label class="col-form-label Text  ml-3 mr-4 ">تاريخ البلاغ : </label>
                        <label class="col-form-label ml-2 mr-4  ">{{$date_report}}  </label>

                        <label class="col-form-label Text ml-3 mr-4 ">صلة القرابة بالمريض : </label>
                        <label class="col-form-label  ml-2 mr-4  ">{{$relative_relation}}  </label>

                    </div>

        </form>
    </div>
</div>

{{--//////////////////////////////////////////////////////--}}
{{--               بيانات مستخدم الدواء                   --}}
{{--//////////////////////////////////////////////////////--}}
<div class="card shadow mb-0 pb-0" >
    <div class="card-header " style="background-color: #F9F9F9;">
        <div class="row m-2 ">
            <h4>بيانات مستخدم الدواء</h4>
        </div>
    </div>
    <div class="card-body position-relative mb-0 pb-0" style="background-color: #F9F9F9;">
        <form>
                    <div class="form-group raw mt-2 " style="display: flex; flex-wrap: wrap;  ">
                        <label class="col-form-label Text ml-3 mr-4 ">الاسم : </label>
                        <label class="col-form-label  ml-2 mr-4  ">{{$user_name}}  </label>
                        <label class="col-form-label Text ml-5 mr-4 ">العمر : </label>
                        <label class="col-form-label  ml-2 mr-4  ">{{$age}}  </label>
                        <label class="col-form-label Text ml-5 mr-4 ">الجنس : </label>
                        <label class="col-form-label  ml-2 mr-4  ">{{$sex}}  </label>
                    </div>
                    <div class="form-group raw mt-4  border-bottom " style="display: flex; flex-wrap: wrap; ">
                        <label class="col-form-label Text  ml-3 mr-4 ">الوزن : </label>
                        <label class="col-form-label ml-2 mr-4  ">{{$weight}}  </label>
                        <label class="col-form-label Text ml-3 mr-4 ">الطول : </label>
                        <label class="col-form-label  ml-2 mr-4  ">{{$length}}  </label>
                    </div>
        </form>
    </div>
</div>

{{--//////////////////////////////////////////////////////--}}
{{--                      تفاصيل الدواء                   --}}
{{--//////////////////////////////////////////////////////--}}
<div class="card shadow mb-0 pb-0" >
    <div class="card-header " style="background-color: #F9F9F9;">
        <div class="row m-2 ">
            <h4>بيانات الدواء</h4>
        </div>
    </div>
    <div class="card-body position-relative mb-0 pb-0" style="background-color: #F9F9F9;">
        <form>
                    <div class="form-group raw mt-2 " style="display: flex; flex-wrap: wrap;  ">
                        <label class="col-form-label Text ml-3 mr-4 ">اسم الدواء التجاري : </label>
                        <label class="col-form-label  ml-2 mr-4  ">{{$drug_name}}  </label>
                        <label class="col-form-label Text ml-5 mr-4 ">اسم الدواء العلمي : </label>
                        <label class="col-form-label  ml-2 mr-4  ">{{$material_name}}  </label>
                    </div>
                    <div class="form-group raw mt-4  border-bottom " style="display: flex; flex-wrap: wrap; ">
                        <label class="col-form-label Text ml-5 mr-4 ">اسم المصنع : </label>
                        <label class="col-form-label  ml-2 mr-4  ">{{$company_name}}  </label>
                        <label class="col-form-label Text  ml-3 mr-4 ">رقم التشغيلة : </label>
                        <label class="col-form-label ml-2 mr-4  ">{{$batch_num}}  </label>
                        <label class="col-form-label Text ml-3 mr-4 ">شكل الدواء : </label>
                        <label class="col-form-label  ml-2 mr-4  ">{{$drug_form}}  </label>
                    </div>
                    <div class="form-group raw mt-4  border-bottom " style="display: flex; flex-wrap: wrap; ">
                        <label class="col-form-label Text  ml-3 mr-4 ">كيفية الحصول على الدواء : </label>
                        <label class="col-form-label ml-2 mr-4  ">{{$method_obtaining}}  </label>
                    </div>
                    <div class="form-group raw mt-4  border-bottom " style="display: flex; flex-wrap: wrap; ">
                        <label class="col-form-label Text  ml-3 mr-4 ">اسم المنشأه التي تم صرف الدواء منها : </label>
                        <label class="col-form-label ml-2 mr-4  ">{{$facility_name}}  </label>
                        <label class="col-form-label Text ml-3 mr-4 ">العنوان : </label>
                        <label class="col-form-label  ml-2 mr-4  ">{{$facility_address}}  </label>
                    </div>
                    <div class="form-group raw mt-4  border-bottom " style="display: flex; flex-wrap: wrap; ">
                        <label class="col-form-label Text  ml-3 mr-4 ">تاريخ بدء استخدام الدواء : </label>
                        <label class="col-form-label ml-2 mr-4  ">{{$start_using_date}}  </label>
                        <label class="col-form-label Text ml-3 mr-4 ">طريقة استخدامه : </label>
                        <label class="col-form-label  ml-2 mr-4  ">{{$take_drug}}  </label>
                        <label class="col-form-label Text ml-3 mr-4 ">الغرض من استخدامه : </label>
                        <label class="col-form-label  ml-2 mr-4  ">{{$purpose_use}}  </label>
                    </div>
                    <div class="form-group raw mt-4  border-bottom " style="display: flex; flex-wrap: wrap; ">
                        <label class="col-form-label Text  ml-3 mr-4 ">الجرعة : </label>
                        <label class="col-form-label ml-2 mr-4  ">{{$dosage}}  </label>
                    </div>
                    <div class="form-group raw mt-4  border-bottom " style="display: flex; flex-wrap: wrap; ">
                        <label class="col-form-label Text  ml-3 mr-4 ">هل تم ايقاف الاستخدام : </label>
                        <label class="col-form-label ml-2 mr-4  ">{{$stopped_using}}  </label>
                        <label class="col-form-label Text ml-3 mr-4 ">التاريخ : </label>
                        <label class="col-form-label  ml-2 mr-4  ">{{$stopped_using_date}}  </label>
                    </div>

        </form>
    </div>
</div>

{{--//////////////////////////////////////////////////////--}}
{{--                      وصف المشكلة                     --}}
{{--//////////////////////////////////////////////////////--}}
<div class="card shadow mb-0 pb-0" >
    <div class="card-header " style="background-color: #F9F9F9;">
        <div class="row m-2 ">
            <h4> وصف المشكلة المتعلقة بجودة الدواء وكيف تم علاجه واية معلومات اخرى ضرورية تشمل الحالة الصحية</h4>
        </div>
    </div>
    <div class="card-body position-relative mb-0 pb-0" style="background-color: #F9F9F9;">
        <form>
                    <div class="form-group raw mt-2 " style="display: flex; flex-wrap: wrap;  ">
                        <label class="col-form-label  ml-2 mr-4  ">{{$describe_problem}}  </label>
                    </div>

        </form>
    </div>
</div>

            {{--//////////////////////////////////////////////////////--}}
            {{--              بيانات الادوية الاخرى                     --}}
            {{--//////////////////////////////////////////////////////--}}
            <div class="card shadow mb-0 pb-0" >
                <div class="card-header " style="background-color: #F9F9F9;">
                    <div class="row m-2 ">
                        <h4>بيانات الادوية الاخرى المستخدمة حاليا وكذلك المستخدمة قبل شهر من ظهور العرض</h4>
                    </div>
                </div>
                <div class="card-body position-relative mb-0 pb-0" style="background-color: #F9F9F9;">
                    <table class="table table-striped " cellpadding="0" cellspacing="0" border="1">
                        <thead >
                        <tr>
                            <th>اسم الدواء</th>
                            <th>الجرعة</th>
                            <th>تاريخ بدء الاستخدام</th>
                            <th>تاريخ انهاء الاستخدام</th>
                            <th>الغرض من الاستخدام</th>
                        </tr>
                        </thead>
                        <tbody>
                                <tr class="reportRow">
                                    <td>{{$name}}</td>
                                    <td>{{$dosage}}</td>
                                    <td>{{$start_use_date}}</td>
                                    <td>{{$end_use_date}}</td>
                                    <td>{{$purpose_use}}</td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{--//////////////////////////////////////////////////////--}}
            {{--              بيانات العرض الجانبي                     --}}
            {{--//////////////////////////////////////////////////////--}}
            <div class="card shadow mb-0 pb-0" >
                <div class="card-header " style="background-color: #F9F9F9;">
                    <div class="row m-2 ">
                        <h4>بيانات العرض الجانبي</h4>
                    </div>
                </div>
                <div class="card-body position-relative mb-0 pb-0" style="background-color: #F9F9F9;">
                    <form>
                                <div class="form-group raw mt-4  border-bottom " style="display: flex; flex-wrap: wrap; ">
                                    <label class="col-form-label Text  ml-3 mr-4 ">تاريخ بدء ظهور العرض : </label>
                                    <label class="col-form-label ml-2 mr-4  ">{{$start_side_effect}}  </label>
                                </div>
                                <div class="form-group raw mt-4  border-bottom " style="display: flex; flex-wrap: wrap; ">
                                    <label class="col-form-label Text  ml-3 mr-4 ">مدى خطورته : </label>
                                    <label class="col-form-label ml-2 mr-4  ">{{$severity}}  </label>
                                </div>
                                <div class="form-group raw mt-4  border-bottom " style="display: flex; flex-wrap: wrap; ">
                                    <label class="col-form-label Text  ml-3 mr-4 ">هل زال العرض : </label>
                                    <label class="col-form-label ml-2 mr-4  ">{{$sideshow_still}}  </label>
                                    <label class="col-form-label Text ml-3 mr-4 ">التاريخ : </label>
                                    <label class="col-form-label  ml-2 mr-4  ">{{$date_end_side}}  </label>
                                </div>
                                <div class="form-group raw mt-4  border-bottom " style="display: flex; flex-wrap: wrap; ">
                                    <label class="col-form-label Text  ml-3 mr-4 ">حالة المريض حاليا : </label>
                                    <label class="col-form-label ml-2 mr-4  ">{{$patient_condition}}  </label>
                                </div>
                    </form>
                </div>
            </div>

            {{--//////////////////////////////////////////////////////--}}
            {{--                       معلومات اخرى                   --}}
            {{--//////////////////////////////////////////////////////--}}
            <div class="card shadow mb-0 pb-0" >
                <div class="card-header " style="background-color: #F9F9F9;">
                    <div class="row m-2 ">
                        <h4>معلومات اخرى</h4>
                    </div>
                </div>
                <div class="card-body position-relative mb-0 pb-0" style="background-color: #F9F9F9;">
                    <form>
                                <div class="form-group raw mt-2 " style="display: flex; flex-wrap: wrap;  ">
                                    <label class="col-form-label Text ml-3 mr-4 ">هل تم ابلاغ الطبيب بهذه الاعراض : </label>
                                    <label class="col-form-label  ml-2 mr-4  ">{{$inform_doctor}}  </label>
                                </div>
                                <div class="form-group raw mt-4  border-bottom " style="display: flex; flex-wrap: wrap; ">
                                    <label class="col-form-label Text ml-5 mr-4 ">اسم الطبيب : </label>
                                    <label class="col-form-label  ml-2 mr-4  ">{{$doctor_name}}  </label>
                                    <label class="col-form-label Text  ml-3 mr-4 ">الهاتف : </label>
                                    <label class="col-form-label ml-2 mr-4  ">{{$doctor_phone}}  </label>
                                    <label class="col-form-label Text ml-5 mr-4 ">المستشفى : </label>
                                    <label class="col-form-label  ml-2 mr-4  ">{{$doctor_hospital}}  </label>
                                </div>
                    </form>
                </div>
            </div>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</div>
</body>

</html>
