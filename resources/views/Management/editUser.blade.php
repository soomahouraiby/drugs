@extends('layouts\master')
@section('content')

    {{--Title--}}
    <main class="col-md-8 ms-sm-auto col-lg-10 px-md-4 ">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 pr-2  border-bottom main " >
            <h1 class="h2  ml-4">تعديل بيانات</h1>
        </div>


        {{--Content--}}

        {{--//////////////////////////////////////////////////////--}}
        {{--               تعديل بيانات المستخدم                    --}}
        {{--//////////////////////////////////////////////////////--}}

        <div class="card shadow mb-0 pb-0" >
            <div class="card-header " style="background-color: #F9F9F9;">
                <div class="row m-2">
                    <h4>  {{$users -> name}} </h4>
                </div>
            </div>
            <form method="post" action="{{route('users.update',$users -> id)}}">
                @csrf
                <div class="card-body position-relative mb-0 pb-0" style="background-color: #F9F9F9;">
                    <div class="row pb-5 ">
                        <div class="form-group col-lg-12 raw mt-4 " style="display: flex; flex-wrap: wrap; ">
                            <label class="col-form-label   mt-2 mx-4 "> اسم المستخدم : </label>
                            <div class=" mt-2 col-lg-6 ">
                                <input name="user_name" type="text" class="form-control" value="{{$users -> name}}" >
                            </div>
                        </div>
                        <div class="form-group raw mt-4 col-lg-12 " style="display: flex; flex-wrap: wrap; ">
                            <label class="col-form-label   mt-2 mx-4 "> البريد الإلكتروني : </label>
                            <div class=" mt-2 col-lg-4">
                                <input name="email" type="email" class="form-control" value="{{$users -> email}}" >
                            </div>
                            <label class="col-form-label   mt-2 mx-4 "> رقم الهاتف : </label>
                            <div class=" mt-2 col-lg-3">
                                <input name="phone" type="tel" class="form-control" value="{{$users -> phone}}" >
                            </div>
                        </div>
                        <div class="form-group raw mt-4 col-lg-12 " style="display: flex; flex-wrap: wrap; ">
                            <label class="col-form-label   mt-2 mx-4 "> العنوان : </label>
                            <div class=" mt-2 col-lg-8">
                                <input name="address" type="text" class="form-control" value="{{$users -> address}}">
                            </div>
                        </div>
                        <div class="form-group raw mt-4 col-lg-12 " style="display: flex; flex-wrap: wrap; ">
                            <label class="col-form-label   mt-2 mx-4 "> المديرية : </label>
                            <div class=" mt-2 col-lg-4">
                                <input name="district" type="text" class="form-control" value="{{$users -> district}}" >
                            </div>
                            <label class="col-form-label   mt-2 mx-4 "> الصفة : </label>
                            <div class=" mt-2 col-lg-4">
                                    <select  class="form-control" name="roles[]" >
                                        <option value="المدير العام"  {{$users->hasRole('المدير العام') ? 'selected' : ''}}> المدير العام</option>
                                        <option value=" مدير العمليات" {{$users->hasRole(' مدير العمليات') ? 'selected' : ''}}> مدير العمليات</option>
                                        <option value="مدير الصيدلة" {{$users->hasRole('مدير الصيدلة') ? 'selected' : ''}} >مدير الصيدلة</option>
                                        <option value="مدير التيقظ الدوائي" {{$users->hasRole('مدير التيقظ الدوائي') ? 'selected' : ''}}  >مدير التيقظ الدوائي</option>
                                    </select>
                            </div>

                        </div>
                        <div class="form-group raw mt-4 " style="display: flex; flex-wrap: wrap; ">
                            <div class="form-group  mt-4 " style="float: right">
                                <button class="btn " type="submit" style=" float:right;margin-right:90%; background-color: #5468FF; color:#ffffff">تعديل</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

@endsection
