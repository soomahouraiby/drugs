@extends('layouts.master')
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
        <div class="row col-lg-12" style="" >
        <div class="card shadow col-lg-5 col-md-4" style="background-color: #F9F9F9;"  >
            <div class="card-header "style="background-color: #F9F9F9;">
                <h5 class="card-title" style="color:#5468FF">تفاصيل الدواء</h5>
            </div>
            <div class="card-body">
                <div class="row" >
                    @if(isset($r))
                        @foreach($r as $rr)
                            <ul class="list-group list-group-flush" >
                                <li class="list-group-item" style="background-color: #F9F9F9;">
                                <label class="Text">الاسم التجاري : </label>
                                <label  class="ml-3">{{$rr->drug_name}}</label>
                                </li>
                                <li class="list-group-item" style="background-color: #F9F9F9;">
                                <label class="Text">الاسم العلمي : </label>
                                <label class="ml-3" >{{$rr->material_name}}</label>
                                </li>
                                <li class="list-group-item" style="background-color: #F9F9F9;">
                                <label class="Text">شكل الدواء : </label>
                                <label class="ml-3" >{{$rr->drug_form}}</label>
                                </li>
                                <li class="list-group-item" style="background-color: #F9F9F9;">
                                <label class="Text"> اسم الوكيل : </label>
                                <label  class="ml-3">{{$rr->agent_name}}</label>
                                </li>
                                <li class="list-group-item" style="background-color: #F9F9F9;">
                                <label class="Text"> الشركة المصنعة  : </label>
                                <label  class="ml-3">{{$rr->company_name}}</label>
                                </li>
                                <li class="list-group-item" style="background-color: #F9F9F9;">
                                <label class="Text" > بلد الصنع : </label>
                                <label  class="ml-3">{{$rr->country}}</label>
                                </li>
                            @break($rr)
                        @endforeach
                    @endif
                            </ul>
                </div>
        </div>
        </div>
        <div class="card shadow col-lg-5 col-md-4" style="background-color: #F9F9F9;"  >
            <div class="card-header "style="background-color: #F9F9F9;">
                <h5 class="card-title" style="color:#5468FF">تفاصيل الدواء</h5>
            </div>
            <div class="card-body">
                <div class="row" >
                    @if(isset($r))
                        @foreach($r as $rr)
                            <ul class="list-group list-group-flush" >
                                <li class="list-group-item" style="background-color: #F9F9F9;">
                                    <label class="Text">الاستخدامات : </label>
                                    <label  class="ml-3 mr-4">{{$rr->how_use}}</label>
                                </li>
                                <li class="list-group-item" style="background-color: #F9F9F9;">
                                    <label class="Text"> الاعراض : </label>
                                    <label  class="ml-3">{{$rr->side_effects}}</label>
                                </li>
                                <li class="list-group-item" style="background-color: #F9F9F9;">
                                    <label class="Text"> رقم الشحنة : </label>
                                    <label  class="ml-3">{{$rr->batch_num}}</label>
                                </li>
                                <li class="list-group-item" style="background-color: #F9F9F9;">
                                    <label class="Text">  تاريخ الانتاج : </label>
                                    <label  class="ml-3">{{$rr->production_date}}</label>
                                </li>
                                <li class="list-group-item" style="background-color: #F9F9F9;">
                                    <label class="Text"> تاريخ الانتهاء :</label>
                                    <label  class="ml-3">{{$rr->expiry_date}}</label>
                                </li>
                                @break($rr)
                                @endforeach
                                @endif
                            </ul>
                </div>
            </div>
        </div>
        </div>

        {{--End Content--}}

    </main>

@endsection
