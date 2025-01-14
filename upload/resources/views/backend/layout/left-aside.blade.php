    <!-- main left menu -->
    <div id="left-sidebar" class="sidebar">
        <button type="button" class="btn-toggle-offcanvas"><i class="fa fa-arrow-left"></i></button>
        <div class="sidebar-scroll">
            <div class="user-account">
                <img src="{{URL::asset('/assets/images/user.png')}}" class="rounded-circle user-photo" alt="User Profile Picture">
                @auth
                <div class="dropdown">
                    <span>مرحبا,</span>
                    <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong>{{ Auth::user()->first_name }}{{ Auth::user()->last_name }}({{ Auth::user()->name }})</strong></a>
                    <ul class="dropdown-menu dropdown-menu-right account">
                        <li><a href="/profile"><i class="icon-user"></i>الملف الشخصي</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"><i class="icon-power"></i>تسجيل الخروج
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
                @endauth
                <hr>

            </div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#menu">القائمة </a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#setting"><i class="icon-settings"></i></a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content padding-0">
                <div class="tab-pane active" id="menu">
                    <nav id="left-sidebar-nav" class="sidebar-nav">
                        <ul id="main-menu" class="metismenu li_animation_delay">
                            <li class="active">
                                <a href="#App" class="has-arrow"><i class="fa fa-th-large"></i><span>الخدمات</span></a>
                                    <ul>

                                    <li><a href="#">قسم  التطبيقات</a>
                                    <ul>
                                      <li><a href="/app-section">الأقسام</a></li>
                                      <li><a href="/myapp">التطبيقات</a></li>
                                      <li><a href="/app-order">طلبات التطبيقات</a></li>

                                     </ul>
                                    </li>
                                    <li><a href="#">قسم الألعاب</a>
                                     <ul>
                                      <li><a href="/game-section">الأقسام</a></li>
                                      <li><a href="/game">الألعاب</a></li>
                                      <li><a href="/game-order">طلبات الألعاب</a></li>

                                     </ul>
                                    </li>
                                 
                                    <li><a href="#"> قسم البيانات والاتصالات</a>
                                       <ul>
                                        <li><a href="/data-communication-section"> الاقسام</a> </li>
                                        <li><a href="/data-communication">الشركات</a></li>
                                        <li><a href="/data-communication-order">الطلبات </a></li>
                                      </ul>
                                    </li>
                                    <li><a href="/ebank-section">قسم البنوك الرقمية</a>
                                        <ul>
                                             <li><a href="/ebank-section">الأقسام</a></li>
                                             <li><a href="/ebank">البنوك</a></li>
                                             <li><a href="/ebank-order">طلبات البنوك</a></li>

                                       </ul>
                                    </li>
                                  
                                

                                    <li><a href="/card"> بطاقاتنا</a>
                                      <ul>
                                        <li><a href="/card">البطاقات</a></li>
                                        <li><a href="/card-order">طلبات البطاقات</a></li>

                                      </ul>
                                    </li>
                                    <li><a href="/ecard">  قسم البطاقات الرقمية</a>
                                       <ul>

                                        <li><a href="/ecard-section"> الاقسام</a></li>
                                        <li><a href="/ecard">البطاقات</a></li>
                                        <li><a href="/ecard-order">طلبات البطاقات</a></li>

                                      </ul>
                                    </li>
                                    <li><a href="/turkification-order">طلبات التتريك </a></li>
                                    
                                    <li><a href="/transfer-order">خدمة نقل الرصيد الى master kontor
                                    </a></li>
                                  </ul>
                            </li>
                          
                       
                       
                             <li >
                                <a href="#Dashboard" class="has-arrow"><i class="fa icon-users"></i><span>العملاء</span></a>
                                <ul>
                                    <li><a href="/users/agents"> العملاء</a></li>
                                  
                                    @if(auth()->user()->role==1)
                                    <li><a href="/vip/">عمولات العملاء</a></li>
                                    @endif
                                </ul>
                            </li>
                            <li >
                                <a href="#Dashboard" class="has-arrow"><i class="fa fa-money"></i><span> عمليات تعبئة الرصيد</span></a>
                                <ul>
                                        <li><a href="/transfer-money-firm">شركات شحن الرصيد</a></li>
                                        <li><a href="/transfer-money-firm-order">طلبات شحن الرصيد </a></li>
                                        <li><a href="/users/transactions/all/done/{{auth()->user()->id}}">   عمليات تعبئة الرصيد المكتملة</a></li>
                                    <li><a href="/users/transactions/all/debts/{{auth()->user()->id}}">   عمليات  تعبئة الرصيد (الديون المستحقة لي )</a></li>
                                    <li><a href="/users/transactions/all/mydebts/{{auth()->user()->id}}">   عمليات  تعبئة الرصيد ( الديون المستحقة علي)</a></li>
                                </ul>
                            </li>
                            @if(auth()->user()->role==1)
 
  <li>
                                <a href="/program" class=""><i class="fa fa-user"></i><span>الوكلاء</span></a>
                            </li>
                            <li>
                                <a href="/users/1/category" class=""><i class="fa fa-user"></i><span>المستخدمين</span></a>
                            </li>
                      
                            <li>
                                <a href="/setting" class=""><i class="fa fa-dashboard"></i><span>الاعدادات</span></a>
                            </li>
                            <li>
                                <a href="/slider" class=""><i class="fa fa-dashboard"></i><span>إعداد الشرائح في الصفحة الرئيسية</span></a>
                            </li>
                            @endif

                            
                        </ul>
                    </nav>
                </div>

                <div class="tab-pane" id="setting">
                 

                    <ul class="list-unstyled font_setting mt-3">
                        <li>
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" name="font" value="font-nunito" checked="">
                                <span class="custom-control-label">Nunito Google Font</span>
                            </label>
                        </li>
                        <li>
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" name="font" value="font-ubuntu">
                                <span class="custom-control-label">Ubuntu Font</span>
                            </label>
                        </li>
                        <li>
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" name="font" value="font-raleway">
                                <span class="custom-control-label">Raleway Google Font</span>
                            </label>
                        </li>
                        <li>
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" name="font" value="font-IBMplex">
                                <span class="custom-control-label">IBM Plex Google Font</span>
                            </label>
                        </li>
                    </ul>

                    <ul class="list-unstyled mt-3">
                        <li class="d-flex align-items-center mb-2">
                            <label class="toggle-switch theme-switch">
                                <input type="checkbox">
                                <span class="toggle-switch-slider"></span>
                            </label>
                            <span class="ml-3">Enable Dark Mode!</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <label class="toggle-switch theme-rtl">
                                <input type="checkbox" checked>
                                <span class="toggle-switch-slider"></span>
                            </label>
                            <span class="ml-3">Enable RTL Mode!</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <label class="toggle-switch theme-high-contrast">
                                <input type="checkbox">
                                <span class="toggle-switch-slider"></span>
                            </label>
                            <span class="ml-3">Enable High Contrast Mode!</span>
                        </li>
                    </ul>

                

            
                </div>


            </div>
        </div>
    </div>
