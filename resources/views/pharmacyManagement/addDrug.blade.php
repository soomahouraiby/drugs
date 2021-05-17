@extends('layouts\master')
@section('content')

    {{--Title--}}
    <main class="col-md-8 ms-sm-auto col-lg-10 px-md-4 ">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 pr-2  border-bottom main " >
            <h1 class="h2  ml-4">إضافة دواء </h1>
        </div>


        {{--Content--}}

        {{--//////////////////////////////////////////////////////--}}
        {{--                    إضافة دواء جديد                    --}}
        {{--//////////////////////////////////////////////////////--}}

        <div class="card shadow mb-0 pb-0" >
            <div class="card-header " style="background-color: #F9F9F9;">
                <div class="row m-2">
                    <h4>بيانات  الدواء</h4>
                </div>
            </div>
            <form method="POST" action="{{route('PM_addDrug')}}">
                @csrf

                <input name="drug_no" type="hidden" value="{{$drug->drug_no + 1}}">
                <input name="shipment_no" type="hidden" value="{{$shipment->shipment_no + 1}}">

                 <div class="card-body position-relative mb-0 pb-0" style="background-color: #F9F9F9;">
                <div class="row pb-5">
                    <div class="form-group raw mt-4 " style="display: flex; flex-wrap: wrap; ">
                        <label class="col-form-label   mt-2 mx-4 "> تاريخ الإنتاج : </label>
                        <div class=" mt-2 ">
                            <input name="production_date" type="text" class="form-control" placeholder="تاريخ الإنتاج  ">
                        </div>
                        <label class="col-form-label   mt-2 mx-4  ">  تاريخ الإنتهاء : </label>
                        <div class=" mt-2  ">
                            <input name="expiry_date" type="text" class="form-control" placeholder="تاريخ الإنتهاء  ">
                        </div>
                    </div>
                    <div class="form-group raw mt-4 pb-4 border-bottom" style="display: flex; flex-wrap: wrap; ">
                        <label class="col-form-label   mt-2 mx-4 "> الكمية : </label>
                        <div class=" mt-2 ">
                            <input name="quantity" type="text" class="form-control" placeholder="الكمية">
                        </div>
                        <label class="col-form-label   mt-2 mx-4  ">  السعر : </label>
                        <div class=" mt-2  ">
                            <input name="price" type="text" class="form-control" placeholder="السعر ">
                        </div>
                    </div>
                    <div class="form-group raw mt-4 pb-4 border-bottom" style="display: flex; flex-wrap: wrap; ">
                        <label class="col-form-label   mt-2 mx-4 "> رقم التشغيلة : </label>
                        <div class=" mt-2">
                            <input name="batch_num" type="text" class="form-control" placeholder="رقم التشغيلة">
                        </div>
                        <label class="col-form-label   mt-2 mx-4  ">  الباركود : </label>
                        <div class=" mt-2  ">
                            <input name="barcode" type="text" class="form-control" placeholder="الباركود ">
                        </div>
                    </div>
                    <div class="form-group raw mt-4 pb-4 border-bottom " style="display: flex; flex-wrap: wrap; ">
                        <label class="col-form-label  mt-2 mx-4 ">   الوكيل : </label>
                        <div class=" mt-2  ">
                            <select  class="form-control" name="agent_no" >
                                @if(isset($agents))
                                    @foreach($agents as $agent)
                                        <option value="{{$agent->agent_no}}">{{$agent->agent_name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <label class="col-form-label   mt-2 mx-4 ">  الشركة : </label>
                        <div class=" mt-2  ">
                            <select class="form-control" name="company_no">
                                @if(isset($companies))
                                    @foreach($companies as $company)
                                        <option value="{{$company->company_no}}">{{$company->company_name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group raw mt-4 pb-4 border-bottom " style="display: flex; flex-wrap: wrap; ">
                        <label class="col-form-label  mt-2 mx-4 ">   الماده الفعاله : </label>
                        <div class=" mt-2  ">
                            <select class="form-control" name="material_no">
                                @if(isset($materials))
                                    @foreach($materials as $material)
                                        <option value="{{$material->material_no}}">{{$material->material_name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <label class="col-form-label   mt-2 mx-4 ">  قوة التركيز : </label>
                        <div class=" mt-2  ">
                            <input name="con" type="text" class="form-control" placeholder="قوة التركيز ">
                        </div>
                    </div>
                    <div class="form-group raw mt-4 col-lg-12 " style="display: flex; flex-wrap: wrap; ">
                        <label class="col-form-label  mt-2 mx-4 ">   اسم الدواء  : </label>
                        <div class=" mt-2 col-lg-4 ">
                            <input name="drug_name" type="text" class="form-control" placeholder="الاسم التجاري ">
                        </div>
                        <label class="col-form-label  mt-2 mx-4 ">   رقم التسجيل  : </label>
                        <div class=" mt-2  ">
                            <input name="register_no" type="text" class="form-control" placeholder="رقم التسجيل ">
                        </div>
                    </div>
                    <div class="form-group raw mt-4 " style="display: flex; flex-wrap: wrap; ">
                        <label class="col-form-label  mt-2 mx-4 ">   شكل الدواء  : </label>
                        <div class=" mt-2  ">
                            <input name="drug_form" type="text" class="form-control" placeholder="شكل الدواء ">
                        </div>
                        <label class="col-form-label   mt-2 mx-4 ">  صورة الدواء : </label>
                        <div class=" mt-2  ">
                            <input type="file" name="drug_photo" >
                        </div>
                    </div>
                    <div class="form-group raw mt-4 col-lg-12" style="display: flex; flex-wrap: wrap; ">
                        <label class="col-form-label  mt-2 mx-4 ">   طريقة الإستخدام  : </label>
                        <div class=" mt-2 col-lg-8 ">
                            <textarea name="how_to_use" type="text" class="form-control " placeholder="طريقة الإستخدام " rows="4"></textarea>
                        </div>
                    </div>
                    <div class="form-group raw mt-4 col-lg-12" style="display: flex; flex-wrap: wrap; ">
                        <label class="col-form-label  mt-2 mx-4 ">   الأثار الجانبية  : </label>
                        <div class=" mt-2 col-lg-8 ">
                            <textarea name="side_effects" type="text" class="form-control " placeholder="الأثار الجانبية " rows="4"></textarea>
                        </div>
                    </div>
                    <div class="form-group raw mt-4 " style="display: flex; flex-wrap: wrap; ">
                        <div class="form-group  mt-4 " style="float: right">
                            <button class="btn " type="submit" style=" float:right;margin-right:90%; background-color: #5468FF; color:#ffffff">حفظ</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </main>

@endsection
