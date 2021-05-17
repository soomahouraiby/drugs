@extends('layouts\master')
@section('content')

    <main class="col-md-8 ms-sm-auto col-lg-10 px-md-4 ">
        {{--Start Content Title--}}
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 pr-2  border-bottom main " >
            <h1 class="h2  ml-4">انهاء بلاغ </h1>
            <div class="btn-toolbar ">
            </div>
        </div>

        {{--End Content Title--}}



        {{--Start Content--}}

        <div class="card-body position-relative mb-0 pb-0" style="background-color: #F9F9F9;">
            <br>
            <br><br><br><br>
            <form method="post" action="{{route('PHC_store',$reports -> id)}}">
                @csrf
                <div class="row pb-5">
                    <div class="col-lg">
                        <label class="col-form-label col-lg-2  mt-2 ml-3 Text" >   ملاحــظــة : </label>
                        <textarea class="form-control col-lg-10 ml-5 mt-3" id="notes" name="notes"
                                  placeholder="ملاحظة " rows="3"></textarea>
                    </div>
                </div>
                <div class="row pb-5">
                    <div class="col-lg">
                        <button class="btn " type="submit" style="margin-right:90%; width: 10%; background-color: #0F122D; color:#ffffff">
                            حفظ</button>
                    </div>
                </div>
            </form>

        </div>
         {{--End Content--}}

    </main>

@endsection
