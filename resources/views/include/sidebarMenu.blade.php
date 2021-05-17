{{--sidebarMenu--}}
<nav id="sidebarMenu" class="col-md-4 col-lg-2 d-md-block">
    <div class="position-fixed pt-4  border-bottom">
        @if(auth()->user()->hasRole('مدير العمليات'))
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('home')}}">
                        <i class="fas fa-home"></i>
                        <span data-feather="file" class="ml-2"> الرئيسية </span>
                    </a>
                </li>
                <li class="nav-item " >
                    <a class="nav-link active " aria-current="page" href="{{route('OP_newReports')}}">
                        <i class="fas fa-inbox "></i>
                        <span data-feather="file" class="ml-2">بلاغات وارده</span>
                        <i class="fas fa-caret-down ml-3 dropdown "></i>
                    </a>
                    <ul class="UL">
                        <li class="nav-item " >
                            <a class="nav-link active " aria-current="page" href="{{route('OP_newSmuggledReports')}}">
                                <i class="far fa-newspaper"></i>
                                <span data-feather="file" class="ml-2">مهرب</span>
                            </a>
                        </li>
                        <li class="nav-item " >
                            <a class="nav-link active " aria-current="page" href="{{route('OP_newDrownReports')}}">
                                <i class="far fa-newspaper"></i>
                                <span data-feather="file" class="ml-2">مسحوب</span>
                            </a>
                        </li>
                        <li class="nav-item " >
                            <a class="nav-link active " aria-current="page" href="{{route('OP_newDiffrentReports')}}">
                                <i class="far fa-newspaper"></i>
                                <span data-feather="file" class="ml-2">غير مطابق</span>
                            </a>
                        </li>
                        <li class="nav-item " >
                            <a class="nav-link active " aria-current="page" href="{{route('OP_newExceptionReports')}}">
                                <i class="far fa-newspaper"></i>
                                <span data-feather="file" class="ml-2">مستثناء</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('OP_addReport')}}">
                        <i class="fas fa-plus "></i>
                        <span data-feather="file" class="ml-2"> إضافة بلاغ جديد</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active " aria-current="page" href="{{route('OP_followReports')}}">
                        <i class="fas fa-chalkboard-teacher "></i>
                        <span data-feather="file" class="ml-2">إدارة ومتابعه</span>
                        <i class="fas fa-caret-down ml-1 dropdown "></i>
                    </a>
                    <ul class="UL">
                        <li class="nav-item " >
                            <a class="nav-link active " aria-current="page" href="{{route('OP_transferFollowingReports')}}">
                                <i class="fas fa-angle-left"></i>
                                <span data-feather="file" class="ml-2">محول للمتابعة</span>
                            </a>
                        </li>
                        <li class="nav-item " >
                            <a class="nav-link active " aria-current="page" href="{{route('OP_followingReports')}}">
                                <i class="fas fa-angle-left"></i>
                                <span data-feather="file" class="ml-2">قيد المتابعة</span>
                            </a>
                        </li>
                        <li class="nav-item " >
                            <a class="nav-link active " aria-current="page" href="{{route('OP_followDoneReports')}}">
                                <i class="fas fa-angle-left"></i>
                                <span data-feather="file" class="ml-2">تم متابعتها</span>
                            </a>
                        </li>
                        <li class="nav-item " >
                            <a class="nav-link active " aria-current="page" href="{{route('OP_doneReports')}}">
                                <i class="fas fa-angle-left"></i>
                                <span data-feather="file" class="ml-2">تم انهائها</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">
                        <i class="fas fa-file-contract "></i>
                        <span data-feather="file" class="ml-2">التقارير</span>
                    </a>
                </li>
            </ul>
        @elseif(auth()->user()->hasRole('مدير الصيدلة'))
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('home')}}">
                        <i class="fas fa-home"></i>
                        <span data-feather="file" class="ml-2"> الرئيسية </span>
                    </a>
                </li>
                <li class="nav-item " >
                    <a class="nav-link active " aria-current="page" href="{{route('PM_newReports')}}">
                        <i class="fas fa-inbox"></i>
                        <span data-feather="file" class="ml-2">بلاغات وارده</span>
                        <i class="fas fa-caret-down ml-3 dropdown "></i>
                    </a>
                    <ul class="UL">
                        <li class="nav-item " >
                            <a class="nav-link active " aria-current="page" href="{{route('PM_newSmuggledReports')}}">
                                <i class="far fa-newspaper"></i>
                                <span data-feather="file" class="ml-2">مهرب</span>
                            </a>
                        </li>
                        <li class="nav-item " >
                            <a class="nav-link active " aria-current="page" href="{{route('PM_newDrownReports')}}">
                                <i class="far fa-newspaper"></i>
                                <span data-feather="file" class="ml-2">مسحوب</span>
                            </a>
                        </li>
                        <li class="nav-item " >
                            <a class="nav-link active " aria-current="page" href="{{route('PM_newDifferentReports')}}">
                                <i class="far fa-newspaper"></i>
                                <span data-feather="file" class="ml-2">غير مطابق</span>
                            </a>
                        </li>
                        <li class="nav-item " >
                            <a class="nav-link active " aria-current="page" href="{{route('PM_newExceptionReports')}}">
                                <i class="far fa-newspaper"></i>
                                <span data-feather="file" class="ml-2">مستثناء</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('PM_drug')}}">
                        <i class="fas fa-plus"></i>
                        <span data-feather="file" class="ml-2">إضافة دواء جديد</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active " aria-current="page" href="{{route('PM_followReports')}}">
                        <i class="fas fa-chalkboard-teacher "></i>
                        <span data-feather="file" class="ml-2">متابعةالبلاغات</span>
                        <i class="fas fa-caret-down ml-2 dropdown "></i>
                    </a>
                    <ul class="UL">
                        <li class="nav-item " >
                            <a class="nav-link active " aria-current="page" href="{{route('PM_followingReports')}}">
                                <i class="fas fa-angle-left"></i>
                                <span data-feather="file" class="ml-2">قيد المتابعة</span>
                            </a>
                        </li>
                        <li class="nav-item " >
                            <a class="nav-link active " aria-current="page" href="{{route('PM_followDoneReports')}}">
                                <i class="fas fa-angle-left"></i>
                                <span data-feather="file" class="ml-2">تم متابعتها</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">
                        <i class="fas fa-file-contract"></i>
                        <span data-feather="file" class="ml-2">التقارير</span>
                    </a>
                </li>
            </ul>
        @elseif(auth()->user()->hasRole('مدير التيقظ الدوائي'))
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('home')}}">
                        <i class="fas fa-home"></i>
                        <span data-feather="file" class="ml-2"> الرئيسية </span>
                    </a>
                </li>
                <li class="nav-item " >
                    <a class="nav-link active " aria-current="page" href="{{route('PHC_newReports')}}">
                        <i class="fas fa-inbox "></i>
                        <span data-feather="file" class="ml-2">بلاغات وارده</span>
                        <i class="fas fa-caret-down ml-3 dropdown "></i>
                    </a>
                    <ul class="UL">
                        <li class="nav-item " >
                            <a class="nav-link active " aria-current="page" href="{{route('PHC_newEffectReports')}}">
                                <i class="far fa-newspaper"></i>
                                <span data-feather="file" class="ml-2">اعراض جانبية</span>
                            </a>
                        </li>
                        <li class="nav-item " >
                            <a class="nav-link active " aria-current="page" href="{{route('PHC_newQualityReports')}}">
                                <i class="far fa-newspaper"></i>
                                <span data-feather="file" class="ml-2">جودة</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link active " aria-current="page" href="{{route('PHC_followReports')}}">
                        <i class="fas fa-chalkboard-teacher "></i>
                        <span data-feather="file" class="ml-2">إدارة ومتابعه</span>
                        <i class="fas fa-caret-down ml-1 dropdown "></i>
                    </a>
                    <ul class="UL">
                        <li class="nav-item " >
                            <a class="nav-link active " aria-current="page" href="{{route('PHC_followingReports')}}">
                                <i class="far fa-newspaper"></i>
                                <span data-feather="file" class="ml-2">قيد المتابعة</span>
                            </a>
                        </li>
                        <li class="nav-item " >
                            <a class="nav-link active " aria-current="page" href="{{route('PHC_doneReports')}}">
                                <i class="far fa-newspaper"></i>
                                <span data-feather="file" class="ml-2">تم انهائها</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">
                        <i class="fas fa-file-contract "></i>
                        <span data-feather="file" class="ml-2">التقارير</span>
                    </a>
                </li>
            </ul>
        @elseif(auth()->user()->hasRole('المدير العام'))
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('home')}}">
                        <i class="fas fa-home"></i>
                        <span data-feather="file" class="ml-2"> الرئيسية </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active " aria-current="page" href="{{route('showReports')}}">
                        <i class="fas fa-chalkboard-teacher "></i>
                        <span data-feather="file" class="ml-2">إدارة ومتابعه</span>
                        <i class="fas fa-caret-down ml-1 dropdown "></i>
                    </a>
                    <ul class="UL">
                        <li class="nav-item " >
                            <a class="nav-link active " aria-current="page" href="{{route('showNewReports')}}">
                                <i class="far fa-newspaper"></i>
                                <span data-feather="file" class="ml-2">وارده</span>
                            </a>
                        </li>
                        <li class="nav-item " >
                            <a class="nav-link active " aria-current="page" href="{{route('showTransferReports')}}">
                                <i class="far fa-newspaper"></i>
                                <span data-feather="file" class="ml-2">محول للمتابعة</span>
                            </a>
                        </li>
                        <li class="nav-item " >
                            <a class="nav-link active " aria-current="page" href="{{route('showFollowingReports')}}">
                                <i class="far fa-newspaper"></i>
                                <span data-feather="file" class="ml-2">قيد المتابعة</span>
                            </a>
                        </li>
                        <li class="nav-item " >
                            <a class="nav-link active " aria-current="page" href="{{route('showFollowDoneReports')}}">
                                <i class="far fa-newspaper"></i>
                                <span data-feather="file" class="ml-2">تم متابعتها</span>
                            </a>
                        </li>
                        <li class="nav-item " >
                            <a class="nav-link active " aria-current="page" href="{{route('showDoneReports')}}">
                                <i class="far fa-newspaper"></i>
                                <span data-feather="file" class="ml-2">تم انهائها</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('users.index')}}">
                        <i class="fas fa-users"></i>
                        <span data-feather="file" class="ml-2">إدارة المستخدمين</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('add')}}">
                        <i class="fas fa-user-plus"></i>
                        <span data-feather="file" class="ml-2">إضافة مستخدم</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">
                        <i class="fas fa-file-contract "></i>
                        <span data-feather="file" class="ml-2">التقارير</span>
                    </a>
                </li>
            </ul>
        @else
            <ul class="nav flex-column">

            </ul>
        @endif
    </div>
</nav>

{{--sidebarMenu--}}
