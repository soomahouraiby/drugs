@extends('layouts\master')
@section('content')

    <main class="col-md-8 ms-sm-auto col-lg-10 px-md-4 ">

        {{--Start Content Title--}}
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 pr-2  border-bottom main " >
            <h1 class="h2  ml-4">متابعة بلاغ وارد</h1>
            <div class="btn-toolbar ">
            </div>
        </div>

        {{--End Content Title--}}



        {{--Start Content--}}

    <!--//////////////////////////////////////////////////////-->
        <!--                      موضوع البلاغ                      -->
        <!--//////////////////////////////////////////////////////-->

        <div class="card shadow mb-0 pb-0" >
            <div class="card-header " style="background-color: #F9F9F9;">
                <div class="row m-2 ">
                    <h4>موضوع البلاغ</h4>
                </div>
            </div>
            <div class="card-body position-relative mb-10 pb-0" style="background-color: #F9F9F9;">
                <form>
                    @if(isset($report))
                        @foreach($report as $reports)
                            @if($reports -> type_report=='اعراض جانبية')
                            <div class="form-group raw mt-2 " style="display: flex; flex-wrap: wrap;  ">
                                <label class="col-form-label Text ml-3 mr-4 ">اسم المبلغ : </label>
                                <label class="col-form-label  ml-2 mr-4  ">{{$reports -> name}}  </label>
                                <label class="col-form-label Text ml-5 mr-4 ">رقم الهاتف : </label>
                                <label class="col-form-label  ml-2 mr-4  ">{{$reports -> phone}}  </label>
                                <label class="col-form-label Text ml-5 mr-4 ">تاريخ البلاغ : </label>
                                <label class="col-form-label  ml-2 mr-4  ">{{$reports -> date_report}}  </label>
                            </div>
                            <div class="form-group raw mt-4  border-bottom " style="display: flex; flex-wrap: wrap; ">
                                <label class="col-form-label  Text ml-3 mr-4 ">نوع البلاغ : </label>
                                <label class="col-form-label  ml-2 mr-4 ">{{$reports -> type_report}}  </label>
                                <label class="col-form-label  Text ml-3 mr-4 ">اسم المنشأه : </label>
                                <label class="col-form-label  ml-2 mr-4 ">{{$reports -> facility_name}}  </label>
                                @if(isset($drug))
                                    @foreach($drug as $drugs)
                                <label class="col-form-label Text  ml-5 mr-4 ">اسم الدواء : </label>
                                <label class="col-form-label ml-2 mr-4 mb-3  ">{{$drugs -> drug_name}}  </label>
                                    @endforeach
                                @endif
                            </div>
                            <div class="form-group raw mt-4  ">
                                <a class="text-center col-form-label mb-3"  href="{{route('PHC_detailsEffectReport',$reports -> report_no)}}" style="margin-right: 45%"> تفاصيل البلاغ</a>
                            </div>
                            @elseif($reports -> type_report=='جودة')
                                <div class="form-group raw mt-2 " style="display: flex; flex-wrap: wrap;  ">
                                    <label class="col-form-label Text ml-3 mr-4 ">اسم المبلغ : </label>
                                    <label class="col-form-label  ml-2 mr-4  ">{{$reports -> name}}  </label>
                                    <label class="col-form-label Text ml-5 mr-4 ">رقم الهاتف : </label>
                                    <label class="col-form-label  ml-2 mr-4  ">{{$reports -> phone}}  </label>
                                    <label class="col-form-label Text ml-5 mr-4 ">تاريخ البلاغ : </label>
                                    <label class="col-form-label  ml-2 mr-4  ">{{$reports -> date_report}}  </label>
                                </div>
                                <div class="form-group raw mt-4  border-bottom " style="display: flex; flex-wrap: wrap; ">
                                    <label class="col-form-label  Text ml-3 mr-4 ">نوع البلاغ : </label>
                                    <label class="col-form-label  ml-2 mr-4 ">{{$reports -> type_report}}  </label>
                                    <label class="col-form-label  Text ml-3 mr-4 ">اسم المنشأه : </label>
                                    <label class="col-form-label  ml-2 mr-4 ">{{$reports -> facility_name}}  </label>
                                    @if(isset($drug))
                                        @foreach($drug as $drugs)
                                            <label class="col-form-label Text  ml-5 mr-4 ">اسم الدواء : </label>
                                            <label class="col-form-label ml-2 mr-4 mb-3  ">{{$drugs -> drug_name}}  </label>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="form-group raw mt-4  ">
                                    <a class="text-center col-form-label mb-3"  href="{{route('PHC_detailsReport',$reports -> report_no)}}" style="margin-right: 45%"> تفاصيل البلاغ</a>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </form>
            </div>
        </div>


        @if(isset($report))
            @foreach($report as $reports)
                @if($reports -> state == 1)
                <div class="row pb-5 ml-20 mt-10 mb-10">
                    <div class="col-lg">
                        <button class="btn " type="submit" style="margin-right:70%; width: 10%; background-color: #0F122D; color:#ffffff">
                            <a  href="{{route('PHC_createProcedure',$reports -> report_no)}}">اضافة اجراء </a></button>

                    </div>
                </div>
                @elseif($reports->state==2)
                    <div class="card shadow mt-5" >
                        <div class="card-header " style="background-color: #F9F9F9;">
                            <div class="row m-2">
                                <h4>الإجراء المتخذ حيال البلاغ</h4>
                            </div>
                        </div>

                        <div class="card-body position-relative mb-0 pb-0" style="background-color: #F9F9F9;">
                                    <div class="row pb-5 border-bottom">
                                        <div class="col-lg">
                                            <p class="col-form-label  mx-5  ">{{$reports -> notes}}</p>
                                        </div>
                                    </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
        {{--End Content--}}

    </main>

@endsection
