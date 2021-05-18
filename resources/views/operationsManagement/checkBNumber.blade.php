@extends('layouts.master')
@section('content')

    <main class="col-md-8 ms-sm-auto col-lg-10 px-md-4 ">

        {{--Start Content Title--}}

        <div class="border-bottom d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 pr-2 main " >
            <h1 class="h2 mt-2 mb-2 ml-2">إضافة بلاغ وارد</h1>
        </div>

        {{--End Content Title--}}



        {{--Start Content--}}

        <div class="card shadow " >
            <div class="card-header " style="background-color: #F9F9F9;">
                <div class="col-md-12 ">
                    <div class="card-body position-relative">
                        {{-- @if(Session::has('success'))
                             <div class="alert alert-success" role="alert">
                                 {{ Session::get('success') }}
                             </div>
                         @endif--}}

                        <br>
                        {{--//////////////////////////////////////////////////////--}}
                        {{--                    التحقق من الرقم                   --}}
                        {{--//////////////////////////////////////////////////////--}}

                        <form action="{{route('OP_selectBNumber')}}" method="GET">
                            <div class="row ">
                                <div class="form-group raw mt-4 mr-3" style="display: flex; flex-wrap: wrap; margin-left: -12px; margin-right: -12px;">
                                    <label class="col-form-label  text-sm-right mt-2">  رقم التشغيلة : </label>
                                    <div class="mt-2  ml-4">
                                        <input type="text" class="form-control" placeholder="رقم التشغيلة  " name="batch_num" id="batch_num">
                                    </div>
                                </div>
                                <div class="form-group raw mt-4 " style="display: flex; flex-wrap: wrap; margin-left: -12px; margin-right: -12px;">
                                    <button id="query" class="btn btn-primary " type="submit" style="color: white;background-color: #0F122D;">
                                            تحقق
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        {{--End Content--}}

    </main>

@endsection
