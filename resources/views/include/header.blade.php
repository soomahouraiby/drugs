{{--Start Navbar--}}

<nav class="navbar navbar-expand-md sticky-top flex-md-nowrap shadow">
    <div class="container m-0">
        <a class="navbar-brand col-md-3 col-lg-2 m-0 " href="{{ url('/') }}">
            نــظــام إدارة الــبـلاغــات
        </a>
{{--        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">--}}
{{--            <span class="navbar-toggler-icon"></span>--}}
{{--        </button>--}}

        <div class="collapse navbar-collapse" id="navbarSupportedContent" style="margin-right: 68%;">
            <!-- Left Side Of Navbar -->
{{--            <ul class="navbar-nav mr-auto">--}}

{{--            </ul>--}}

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">تسجيل الدخول</a>
                    </li>
                    @if (Route::has('register'))
                        <li >
{{--                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">

                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fas fa-user text-light ml-3"></i>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                               تسجيل الخروج
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
                @auth
                @if(auth()->user()->hasRole('مدير الصيدلة'))
                    <li class="dropdown dropdown-notification nav-item  dropdown-notifications" >
                        <a class="nav-link nav-link-label" href="#" data-toggle="dropdown" >
                            <i class="fa fa-bell" style="color: white"> </i>
                            <span
                                class="badge badge-pill badge-default badge-danger badge-default badge-up badge-glow
                                 notif-count" data-count="0" style="background-color: white ; color: #0F122D">0</span>
                        </a>
                               <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right" style="background-color: white ; color: #0F122D">
                                                    <li class="dropdown-menu-header">
                                                        <h6 class="dropdown-header m-0 text-center" style="background-color: white ; color: #0F122D">
                                                            <span class="grey darken-2 text-center" style="background-color: white ; color: #0F122D"> الرسائل</span>
                                                        </h6>
                                                    </li>
                                                    <li class="scrollable-container ps-container ps-active-y media-list w-100" style="background-color: white ; color: #0F122D">
                                                        <a href="">
                                                            <div class="media" style="background-color: white ; color: #0F122D">
                                                                <div class="media-body" style="background-color: white ; color: #0F122D">
                                                                    <h6 class="media-heading text-right " style="background-color: white ; color: #0F122D">عنوان الاشعار </h6>
                                                                    <p class="notification-text font-small-3 text-muted text-right" style="background-color: white ; color: #0F122D"> نص الاشعار</p>
                                                                    <small style="direction: ltr;background-color: white ; color: #0F122D">
                                                                        <p class=" text-muted text-right"
                                                                           style="direction: ltr; background-color: white ; color: #0F122D"> 20-05-2020 - 06:00 pm
                                                                        </p>
                                                                        <br>

                                                                    </small>
                                                                </div>
                                                            </div>
                                                        </a>

                                                    </li>
                                                    <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center"style="background-color: white ; color: #0F122D"
                                                                                        href=""> جميع الاشعارات </a>
                                                    </li>
                                                </ul>
                    </li>

                    @endif
                    @endauth
            </ul>
        </div>
    </div>
</nav>


{{--End Navbar--}}
