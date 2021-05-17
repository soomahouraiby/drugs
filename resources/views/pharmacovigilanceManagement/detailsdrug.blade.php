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

        <div class="card shadow mb-0 pb-0" >
            <div class="card-header "style="background-color: #F9F9F9;">
                <h5 class="card-title" style="color:#5468FF">تفاصيل الدواء</h5>
            </div>
            <div class="card-body position-relative mb-0 pb-0" style="background-color: #F9F9F9;">
                <form>
                    @if(isset($r))
                        @foreach($r as $rr)
                            <div class="form-group raw mt-4 " style="display: flex; flex-wrap: wrap;  ">
                                <label>الاسم التجاري : </label>
                                <label  class="ml-3">{{$rr->drug_name}}</label>
                                <label class="ml-3">الاسم العلمي : </label>
                                <label class="ml-3" >{{$rr->material_name}}</label>
                                <label class="ml-3">شكل الدواء : </label>
                                <label class="ml-3" >{{$rr->drug_form}}</label>
                            </div>
                            <div>
                                <label > اسم الوكيل : </label>
                                <label  class="ml-3">{{$rr->agent_name}}</label>
                                <label class="ml-3"> الشركة المصنعة  : </label>
                                <label  class="ml-3">{{$rr->company_name}}</label>
                                <label class="ml-3" > بلد الصنع : </label>
                                <label  class="ml-3">{{$rr->country}}</label>
                            </div>
                            <div >
                                <label>الاستخدامات : </label>
                                <label  class="ml-3 mr-4">{{$rr->how_use}}</label>
                                <label class="ml-3"> الاعراض : </label>
                                <label  class="ml-3">{{$rr->side_effects}}</label>
                            </div >
                            <div class="form-group raw   border-bottom " style="display: flex; flex-wrap: wrap; ">
                                <label > رقم الشحنة : </label>
                                <label  class="ml-3">{{$rr->batch_num}}</label>
                                <label class="ml-3">  تاريخ الانتاج : </label>
                                <label  class="ml-3">{{$rr->production_date}}</label>
                                <label class="ml-3"> تاريخ الانتهاء :</label>
                                <label  class="ml-3">{{$rr->expiry_date}}</label>
                            </div>
                        @endforeach
                    @endif
                </form>
            </div>
        </div>


        {{--End Content--}}

    </main>

@endsection
