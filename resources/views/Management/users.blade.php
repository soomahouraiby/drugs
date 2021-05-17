@extends('layouts\master')
@section('content')

    <div id="New">
        <a class="nav-link active " href="{{route('add')}}">
            <i class="fas fa-user-plus"></i>
        </a>
    </div>

    <main class="col-md-8 ms-sm-auto col-lg-10 px-md-4 ">

        {{--Title--}}
        <div class=" col-lg-12 d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 pr-2  border-bottom main " >
            <h1 class="col-lg-4  h2  ml-4">إدارة المستخدمين</h1>
            <div class="btn-toolbar ">
                <input class=" form-control form-control-dark w-50 mr-5" type="text" placeholder="بحث" aria-label="بحث" size="30" style="border: 2px solid #ECECEC;
                    border-radius: 20px;">
            </div>
        </div>


        {{--Content--}}
        <div class="card shadow mb-3 w-9" style=" width:85%;background-color: #F9F9F9;">
            <div class="card-body px-0 py-0" style="background-color: #F9F9F9;">
                <div class="table-responsive scrollbar">
                    <table class="table table-bordered table-hover fs--1 mb-0 " style="background-color: #F9F9F9;">
                        <thead class="bg-200 text-900">
                        <tr>
                            <th>
                                <div class="form-check mb-2 mt-2 d-flex align-items-center mb-3 mt-3"></div>
                            </th>
                            <th class="sort pr-1 align-middle white-space-nowrap text-left" data-sort="name">اسم المتخدم</th>
                            <th class="sort pr-1 align-middle white-space-nowrap text-left" data-sort="payment">المديرية</th>
                            <th class="sort pr-1 align-middle white-space-nowrap text-left" data-sort="payment">الصفة</th>
                            <th class="sort pr-1 align-middle white-space-nowrap text-left" data-sort="email">البريد الإلكتروني</th>
                            <th class="sort pr-1 align-middle white-space-nowrap text-left" data-sort="product">رقم الهاتف</th>
                            <th class="sort pr-1 align-middle white-space-nowrap text-left" data-sort="amount"></th>
                            <th class="sort pr-1 align-middle white-space-nowrap text-left" data-sort="amount"></th>

                        </tr>
                        </thead>
                        <tbody class="list" id="table-purchase-body">
                            @foreach($users as $index=>$user)
                            <tr class="btn-reveal-trigger">
                                <td class="align-middle" style="width: 28px;">
                                    <div class="form-check mb-2 mt-2 d-flex align-items-center">{{$index + 1}}</div>
                                </td>
                                <td class="align-middle white-space-nowrap text-left name "><a href="">{{$user -> user_name}}</a></td>
                                <td class="align-middle white-space-nowrap text-left name "><a href="">{{$user -> district}}</a></td>
                                <td class="align-middle white-space-nowrap text-left name "><a href="">{{$user->role_name}}</a></td>
                                <td class="align-middle white-space-nowrap text-left name "><a href="">{{$user -> email}}</a></td>
                                <td class="align-middle white-space-nowrap text-left name "><a href="">{{$user -> phone}}</a></td>
                                <td class="align-middle white-space-nowrap text-left name "><a class=" btn-primary btn-sm" href="{{route('users.edit',$user->id)}}"><i class="fas fa-user-edit"></i></a></td>
                                <td class="align-middle white-space-nowrap text-left name "><a class=" btn-danger btn-sm" href=""><i class="fas fa-user-minus"></i></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer"></div>
        </div>
    </main>

@endsection
