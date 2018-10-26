<!-- Top Menu Items -->
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="nav-wrap">
    <div class="mobile-only-brand pull-left">
        <div class="nav-header pull-right">
            <div class="logo-wrap">
                <a href="/panel/index">
                    <img class="brand-img" src="{{ asset('images/logo.png') }}" alt="brand"/>
                    <span class="brand-text"><img  src="{{ asset('images/brand.png') }}" alt="brand"/></span>
                </a>
            </div>
        </div>	
        <a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"><i class="zmdi zmdi-menu"></i></a>
        <a id="toggle_mobile_search" data-toggle="collapse" data-target="#search_form" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-search"></i></a>
        <a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-more"></i></a>
        <form id="search_form" role="search" class="top-nav-search collapse pull-right">
            <div class="input-group">
                <input type="text" name="example-input1-group2" class="form-control" placeholder="جستجو ...">
                <span class="input-group-btn">
                <button type="button" class="btn  btn-default"  data-target="#search_form" data-toggle="collapse" aria-label="Close" aria-expanded="true"><i class="zmdi zmdi-search"></i></button>
                </span>
            </div>
        </form>
    </div>
    <div id="mobile_only_nav" class="mobile-only-nav pull-right">
        <ul class="nav navbar-right top-nav pull-right">
            
            
            <li class="dropdown alert-drp">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="zmdi zmdi-notifications top-nav-icon"></i><span class="top-nav-icon-badge"></span></a>
                <ul  class="dropdown-menu alert-dropdown" data-dropdown-in="bounceIn" data-dropdown-out="bounceOut">
                    <li>
                        <div class="notification-box-head-wrap">
                            <span class="notification-box-head pull-left inline-block">اعلانات</span>
                            <a class="txt-danger pull-right clear-notifications inline-block" href="javascript:void(0)"> پاک کردن همه </a>
                            <div class="clearfix"></div>
                            <hr class="light-grey-hr ma-0"/>
                        </div>
                    </li>
                    <li>
                        <div class="streamline message-nicescroll-bar">
                            <div class="sl-item">
                                <a href="javascript:void(0)">
                                    <div class="icon bg-green">
                                        <i class="ti-briefcase "></i>
                                    </div>
                                    <div class="sl-content">
                                        <span class="inline-block font-11  pull-right notifications-time">2:00</span>
                                        <span class="inline-block capitalize-font  pull-left truncate head-notifications">
                                        اشتراک جدید ساخته شد</span>
                                        <div class="clearfix"></div>
                                        <p class="truncate">لورم ایپسوم متن ساختگی با . </p>
                                    </div>
                                </a>	
                            </div>
                            <hr class="light-grey-hr ma-0"/>
                            <div class="sl-item">
                                <a href="javascript:void(0)">
                                    <div class="icon bg-yellow">
                                        <i class="zmdi zmdi-trending-down"></i>
                                    </div>
                                    <div class="sl-content">
                                        <span class="inline-block capitalize-font  pull-left truncate head-notifications txt-warning">سرور #2 پاسخگو نیست</span>
                                        <span class="inline-block font-11 pull-right notifications-time">13:00</span>
                                        <div class="clearfix"></div>
                                        <p class="truncate">برخی راه حل های فنی برای حل مشکل لازم است .</p>
                                    </div>
                                </a>	
                            </div>
                            <hr class="light-grey-hr ma-0"/>
                            <div class="sl-item">
                                <a href="javascript:void(0)">
                                    <div class="icon bg-blue">
                                        <i class="zmdi zmdi-email"></i>
                                    </div>
                                    <div class="sl-content">
                                        <span class="inline-block capitalize-font  pull-left truncate head-notifications">2 پیام جدید</span>
                                        <span class="inline-block font-11  pull-right notifications-time">16:00</span>
                                        <div class="clearfix"></div>
                                        <p class="truncate"> لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. </p>
                                    </div>
                                </a>	
                            </div>
                            <hr class="light-grey-hr ma-0"/>
                            <div class="sl-item">
                                <a href="javascript:void(0)">
                                    <div class="sl-avatar">
                                        <img class="img-responsive" src="{{ asset('images/avatar.jpg') }}" alt="avatar"/>
                                    </div>
                                    <div class="sl-content">
                                        <span class="inline-block capitalize-font  pull-left truncate head-notifications">امیر خدنگی</span>
                                        <span class="inline-block font-11  pull-right notifications-time">11:00</span>
                                        <div class="clearfix"></div>
                                        <p class="truncate">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. </p>
                                    </div>
                                </a>	
                            </div>
                            <hr class="light-grey-hr ma-0"/>
                            <div class="sl-item">
                                <a href="javascript:void(0)">
                                    <div class="icon bg-red">
                                        <i class="zmdi zmdi-storage"></i>
                                    </div>
                                    <div class="sl-content">
                                        <span class="inline-block capitalize-font  pull-left truncate head-notifications txt-danger">99% فضای سرور پر شده است</span>
                                        <span class="inline-block font-11  pull-right notifications-time">20:25</span>
                                        <div class="clearfix"></div>
                                        <p class="truncate">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. </p>
                                    </div>
                                </a>	
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="notification-box-bottom-wrap">
                            <hr class="light-grey-hr ma-0"/>
                            <a class="block text-center read-all" href="javascript:void(0)"> خواندن همه </a>
                            <div class="clearfix"></div>
                        </div>
                    </li>
                </ul>
            </li>
            <li>
                <a id="open_right_sidebar" href="#"><i class="zmdi zmdi-settings  top-nav-icon"></i></a>
            </li>
            <li class="dropdown auth-drp">
                <a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown"><img src="{{ asset('images/profile_avatar.jpg') }}" alt="user_auth" class="user-auth-img img-circle"/><span class="user-online-status"></span><span class="user-auth-name inline-block">رضا غلامی<span class="ti-angle-down"></span></span></a>
                <ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                    <li>
                        <a href="/panel/profile"><i class="zmdi zmdi-account"></i><span>مشخصات</span></a>
                    </li>
                    <li>
                        <a href="#"><i class="zmdi zmdi-card"></i><span>تراز من</span></a>
                    </li>
                    <li>
                        <a href="/panel/inbox"><i class="zmdi zmdi-email"></i><span>صندوق دریافتی</span></a>
                    </li>
                    <li>
                        <a href="#"><i class="zmdi zmdi-settings"></i><span>تنظیمات</span></a>
                    </li>
                    <li class="divider"></li>
                    <li class="sub-menu show-on-hover">
                        <a href="#" class="dropdown-toggle pr-0 level-2-drp"><i class="zmdi zmdi-check text-success"></i> قابل دسترس</a>
                        <ul class="dropdown-menu open-left-side">
                            <li>
                                <a href="#"><i class="zmdi zmdi-check text-success"></i><span>قابل دسترس</span></a>
                            </li>
                            <li>
                                <a href="#"><i class="zmdi zmdi-circle-o text-warning"></i><span>مشغول</span></a>
                            </li>
                            <li>
                                <a href="#"><i class="zmdi zmdi-minus-circle-outline text-danger"></i><span>آفلاین</span></a>
                            </li>
                        </ul>	
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#"><i class="zmdi zmdi-power"></i><span>خروج</span></a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>	
    </div>
</nav>
<!-- /Top Menu Items -->

<!-- Left Sidebar Menu -->
<div class="fixed-sidebar-left">
    <ul class="nav navbar-nav side-nav nicescroll-bar">
        <li>
            <a href="/panel/index"><div class="pull-left"><i class="ti-book mr-20"></i><span class="right-nav-text">داشبورد</span></div><div class="clearfix"></div></a>
        </li>
        <li class="navigation-header">
            <span>اصلی</span> 
            <hr/>
        </li>
        <li>
            <a class="active" href="javascript:void(0);" data-toggle="collapse" data-target="#ecom_dr"><div class="pull-left"><i class="ti-shopping-cart  mr-20"></i><span class="right-nav-text">فروشگاه</span></div><div class="pull-right"><i class="ti-angle-down"></i></div><div class="clearfix"></div></a>
            <ul id="ecom_dr" class="collapse collapse-level-1">
                <li>
                    <a href="/panel/groups">گروه بندی محصولات</a>
                </li>
                <li>
                    <a href="/panel/features ">مدیریت ویژگی ها</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#gp_dr"><div class="pull-left"><i class="ti-shopping-cart  mr-20"></i><span class="right-nav-text">محصولات</span></div><div class="pull-right"><i class="ti-angle-down"></i></div><div class="clearfix"></div></a>
            <ul id="gp_dr" class="collapse collapse-level-1">
                <li>
                    <a href="/panel/products/add">افزودن محصول</a>
                </li>
                <li>
                    <a href="/panel/products">لیست محصولات</a>
                </li>
            </ul>
        </li>
        <li class="navigation-header mt-20">
            <span>اجزاء</span> 
            <hr/>
        </li>
        <li>
            <a href="/panel/invoice-archive"><div class="pull-left"><i class="ti-book mr-20"></i><span class="right-nav-text">سفارشات</span></div><div class="clearfix"></div></a>
        </li>
        <li class="navigation-header mt-20">
            <span>featured</span> 
            <hr/>
        </li>
    </ul>
</div>
<!-- /Left Sidebar Menu -->

<!-- Right Sidebar Menu -->
<div class="fixed-sidebar-right">
    <ul class="right-sidebar">
        <li>
            <div  class="tab-struct custom-tab-1">
                <ul role="tablist" class="nav nav-tabs" id="right_sidebar_tab">
                    <li class="active" role="presentation"><a aria-expanded="true"  data-toggle="tab" role="tab" id="chat_tab_btn" href="#chat_tab">گتفگو</a></li>
                    <li role="presentation" class=""><a  data-toggle="tab" id="messages_tab_btn" role="tab" href="#messages_tab" aria-expanded="false">پیام ها</a></li>
                    <li role="presentation" class=""><a  data-toggle="tab" id="todo_tab_btn" role="tab" href="#todo_tab" aria-expanded="false">وظایف</a></li>
                </ul>
                <div class="tab-content" id="right_sidebar_content">
                    <div  id="chat_tab" class="tab-pane fade active in" role="tabpanel">
                        <div class="chat-cmplt-wrap">
                            <div class="chat-box-wrap">
                                <div class="add-friend">
                                    <a href="javascript:void(0)" class="inline-block txt-grey">
                                        <i class="zmdi zmdi-more"></i>
                                    </a>	
                                    <span class="inline-block txt-dark">کاربران</span>
                                    <a href="javascript:void(0)" class="inline-block text-right txt-grey"><i class="zmdi zmdi-plus"></i></a>
                                    <div class="clearfix"></div>
                                </div>
                                <form role="search" class="chat-search pl-15 pr-15 pb-15">
                                    <div class="input-group">
                                        <input type="text" id="example-input1-group2" name="example-input1-group2" class="form-control" placeholder="جستجو ...">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn  btn-default"><i class="zmdi zmdi-search"></i></button>
                                        </span>
                                    </div>
                                </form>
                                <div id="chat_list_scroll">
                                    <div class="nicescroll-bar">
                                        <ul class="chat-list-wrap">
                                            <li class="chat-list">
                                                <div class="chat-body">
                                                    <a href="javascript:void(0)">
                                                        <div class="chat-data">
                                                            <img class="user-img img-circle"  src="{{ asset('images/user.png') }}" alt="user"/>
                                                            <div class="user-data">
                                                                <span class="name block capitalize-font">جعفر رضایی</span>
                                                                <span class="time block truncate txt-grey">لورم ایپسوم متن</span>
                                                            </div>
                                                            <div class="status away"></div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </a>
                                                    <a href="javascript:void(0)">
                                                        <div class="chat-data">
                                                            <img class="user-img img-circle"  src="{{ asset('images/user1.png') }}" alt="user"/>
                                                            <div class="user-data">
                                                                <span class="name block capitalize-font">رضا حسینی</span>
                                                                <span class="time block truncate txt-grey">کتابهای زیادی در</span>
                                                            </div>
                                                            <div class="status offline"></div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </a>
                                                    <a href="javascript:void(0)">
                                                        <div class="chat-data">
                                                            <img class="user-img img-circle"  src="{{ asset('images/user2.png') }}" alt="user"/>
                                                            <div class="user-data">
                                                                <span class="name block capitalize-font">احمد ایرانی</span>
                                                                <span class="time block truncate txt-grey">د تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی </span>
                                                            </div>
                                                            <div class="status online"></div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </a>
                                                    <a href="javascript:void(0)">
                                                        <div class="chat-data">
                                                            <img class="user-img img-circle"  src="{{ asset('images/user3.png') }}" alt="user"/>
                                                            <div class="user-data">
                                                                <span class="name block capitalize-font">فاطمه اکبری</span>
                                                                <span class="time block truncate txt-grey">خیلی ممنون</span>
                                                            </div>
                                                            <div class="status online"></div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </a>
                                                    <a href="javascript:void(0)">
                                                        <div class="chat-data">
                                                            <img class="user-img img-circle"  src="{{ asset('images/user.png') }}" alt="user"/>
                                                            <div class="user-data">
                                                                <span class="name block capitalize-font">زهرا حسینی</span>
                                                                <span class="time block truncate txt-grey">تکنولوژی مورد نیاز </span>
                                                            </div>
                                                            <div class="status offline"></div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </a>
                                                    <a href="javascript:void(0)">
                                                        <div class="chat-data">
                                                            <img class="user-img img-circle"  src="{{ asset('images/user1.png') }}" alt="user"/>
                                                            <div class="user-data">
                                                                <span class="name block capitalize-font">حسن روحانی</span>
                                                                <span class="time block truncate txt-grey">متخصصان را می طلبد تا </span>
                                                            </div>
                                                            <div class="status online"></div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </a>
                                                    <a href="javascript:void(0)">
                                                        <div class="chat-data">
                                                            <img class="user-img img-circle"  src="{{ asset('images/user2.png') }}" alt="user"/>
                                                            <div class="user-data">
                                                                <span class="name block capitalize-font">امیر امیری</span>
                                                                <span class="time block truncate txt-grey">استفاده از طراحان گرافیک است</span>
                                                            </div>
                                                            <div class="status away"></div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </a>
                                                    <a href="javascript:void(0)">
                                                        <div class="chat-data">
                                                            <img class="user-img img-circle"  src="{{ asset('images/user3.png') }}" alt="user"/>
                                                            <div class="user-data">
                                                                <span class="name block capitalize-font">ریحانه موسوی</span>
                                                                <span class="time block truncate txt-grey">طلبد تا با نرم افزارها شناخت </span>
                                                            </div>
                                                            <div class="status online"></div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </a>
                                                    <a href="javascript:void(0)">
                                                        <div class="chat-data">
                                                            <img class="user-img img-circle"  src="{{ asset('images/user4.png') }}" alt="user"/>
                                                            <div class="user-data">
                                                                <span class="name block capitalize-font">محسن بازرگان</span>
                                                                <span class="time block truncate txt-grey">سطرآنچنان که لازم است و برای </span>
                                                            </div>
                                                            <div class="status away"></div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="recent-chat-box-wrap">
                                <div class="recent-chat-wrap">
                                    <div class="panel-heading ma-0">
                                        <div class="goto-back">
                                            <a  id="goto_back" href="javascript:void(0)" class="inline-block txt-grey">
                                                <i class="zmdi zmdi-chevron-left"></i>
                                            </a>	
                                            <span class="inline-block txt-dark">ryan</span>
                                            <a href="javascript:void(0)" class="inline-block text-right txt-grey"><i class="zmdi zmdi-more"></i></a>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div class="panel-wrapper collapse in">
                                        <div class="panel-body pa-0">
                                            <div class="chat-content">
                                                <ul class="nicescroll-bar pt-20">
                                                    <li class="friend">
                                                        <div class="friend-msg-wrap">
                                                            <img class="user-img img-circle block pull-left"  src="{{ asset('images/user.png') }}" alt="user"/>
                                                            <div class="msg pull-left">
                                                                <p>Hello Jason, how are you, it's been a long time since we last met?</p>
                                                                <div class="msg-per-detail text-right">
                                                                    <span class="msg-time txt-light">2:30 PM</span>
                                                                </div>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>	
                                                    </li>
                                                    <li class="self mb-10">
                                                        <div class="self-msg-wrap">
                                                            <div class="msg block pull-right"> Oh, hi Sarah I'm have got a new job now and is going great.
                                                                <div class="msg-per-detail text-right">
                                                                    <span class="msg-time txt-light">2:31 pm</span>
                                                                </div>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>	
                                                    </li>
                                                    <li class="self">
                                                        <div class="self-msg-wrap">
                                                            <div class="msg block pull-right">  How about you?
                                                                <div class="msg-per-detail text-right">
                                                                    <span class="msg-time txt-light">2:31 pm</span>
                                                                </div>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>	
                                                    </li>
                                                    <li class="friend">
                                                        <div class="friend-msg-wrap">
                                                            <img class="user-img img-circle block pull-left"  src="{{ asset('images/user.png') }}" alt="user"/>
                                                            <div class="msg pull-left"> 
                                                                <p>Not too bad.</p>
                                                                <div class="msg-per-detail  text-right">
                                                                    <span class="msg-time txt-light">2:35 pm</span>
                                                                </div>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>	
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="input-group">
                                                <input type="text" id="input_msg_send" name="send-msg" class="input-msg-send form-control" placeholder="Type something">
                                                <div class="input-group-btn emojis">
                                                    <div class="dropup">
                                                        <button type="button" class="btn  btn-default  dropdown-toggle" data-toggle="dropdown" ><i class="zmdi zmdi-mood"></i></button>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li><a href="javascript:void(0)">Action</a></li>
                                                            <li><a href="javascript:void(0)">Another action</a></li>
                                                            <li class="divider"></li>
                                                            <li><a href="javascript:void(0)">Separated link</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="input-group-btn attachment">
                                                    <div class="fileupload btn  btn-default"><i class="zmdi zmdi-attachment-alt"></i>
                                                        <input type="file" class="upload">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                    <div id="messages_tab" class="tab-pane fade" role="tabpanel">
                        <div class="message-box-wrap">
                            <div class="msg-search">
                                <a href="javascript:void(0)" class="inline-block txt-grey">
                                    <i class="zmdi zmdi-more"></i>
                                </a>	
                                <span class="inline-block txt-dark">پیام ها</span>
                                <a href="javascript:void(0)" class="inline-block text-right txt-grey"><i class="zmdi zmdi-search"></i></a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="set-height-wrap">
                                <div class="streamline message-box nicescroll-bar">
                                    <a href="javascript:void(0)">
                                        <div class="sl-item unread-message">
                                            <div class="sl-avatar avatar avatar-sm avatar-circle">
                                                <img class="img-responsive img-circle" src="{{ asset('images/user.png') }}" alt="avatar"/>
                                            </div>
                                            <div class="sl-content">
                                                <span class="inline-block capitalize-font   pull-left message-per">Clay Masse</span>
                                                <span class="inline-block font-11  pull-right message-time">12:28 AM</span>
                                                <div class="clearfix"></div>
                                                <span class=" truncate message-subject">Themeforest message sent via your envato market profile</span>
                                                <p class="txt-grey truncate">Neque porro quisquam est qui dolorem ipsu messm quia dolor sit amet, consectetur, adipisci velit</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0)">
                                        <div class="sl-item">
                                            <div class="sl-avatar avatar avatar-sm avatar-circle">
                                                <img class="img-responsive img-circle" src="{{ asset('images/user1.png') }}" alt="avatar"/>
                                            </div>
                                            <div class="sl-content">
                                                <span class="inline-block capitalize-font   pull-left message-per">Evie Ono</span>
                                                <span class="inline-block font-11  pull-right message-time">1 Feb</span>
                                                <div class="clearfix"></div>
                                                <span class=" truncate message-subject">Pogody theme support</span>
                                                <p class="txt-grey truncate">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0)">
                                        <div class="sl-item">
                                            <div class="sl-avatar avatar avatar-sm avatar-circle">
                                                <img class="img-responsive img-circle" src="{{ asset('images/user2.png') }}" alt="avatar"/>
                                            </div>
                                            <div class="sl-content">
                                                <span class="inline-block capitalize-font   pull-left message-per">Madalyn Rascon</span>
                                                <span class="inline-block font-11  pull-right message-time">31 Jan</span>
                                                <div class="clearfix"></div>
                                                <span class=" truncate message-subject">Congratulations from design nominees</span>
                                                <p class="txt-grey truncate">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0)">
                                        <div class="sl-item unread-message">
                                            <div class="sl-avatar avatar avatar-sm avatar-circle">
                                                <img class="img-responsive img-circle" src="{{ asset('images/user3.png') }}" alt="avatar"/>
                                            </div>
                                            <div class="sl-content">
                                                <span class="inline-block capitalize-font   pull-left message-per">Ezequiel Merideth</span>
                                                <span class="inline-block font-11  pull-right message-time">29 Jan</span>
                                                <div class="clearfix"></div>
                                                <span class=" truncate message-subject">Themeforest item support message</span>
                                                <p class="txt-grey truncate">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0)">
                                        <div class="sl-item unread-message">
                                            <div class="sl-avatar avatar avatar-sm avatar-circle">
                                                <img class="img-responsive img-circle" src="{{ asset('images/user4.png') }}" alt="avatar"/>
                                            </div>
                                            <div class="sl-content">
                                                <span class="inline-block capitalize-font   pull-left message-per">Jonnie Metoyer</span>
                                                <span class="inline-block font-11  pull-right message-time">27 Jan</span>
                                                <div class="clearfix"></div>
                                                <span class=" truncate message-subject">Help with beavis contact form</span>
                                                <p class="txt-grey truncate">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0)">
                                        <div class="sl-item">
                                            <div class="sl-avatar avatar avatar-sm avatar-circle">
                                                <img class="img-responsive img-circle" src="{{ asset('images/user.png') }}" alt="avatar"/>
                                            </div>
                                            <div class="sl-content">
                                                <span class="inline-block capitalize-font   pull-left message-per">Priscila Shy</span>
                                                <span class="inline-block font-11  pull-right message-time">19 Jan</span>
                                                <div class="clearfix"></div>
                                                <span class=" truncate message-subject">Your uploaded theme is been selected</span>
                                                <p class="txt-grey truncate">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0)">
                                        <div class="sl-item">
                                            <div class="sl-avatar avatar avatar-sm avatar-circle">
                                                <img class="img-responsive img-circle" src="{{ asset('images/user1.png') }}" alt="avatar"/>
                                            </div>
                                            <div class="sl-content">
                                                <span class="inline-block capitalize-font   pull-left message-per">Linda Stack</span>
                                                <span class="inline-block font-11  pull-right message-time">13 Jan</span>
                                                <div class="clearfix"></div>
                                                <span class=" truncate message-subject"> A new rating has been received</span>
                                                <p class="txt-grey truncate">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div  id="todo_tab" class="tab-pane fade" role="tabpanel">
                        <div class="todo-box-wrap">
                            <div class="add-todo">
                                <a href="javascript:void(0)" class="inline-block txt-grey">
                                    <i class="zmdi zmdi-more"></i>
                                </a>	
                                <span class="inline-block txt-dark">لیست وظایف</span>
                                <a href="javascript:void(0)" class="inline-block text-right txt-grey"><i class="zmdi zmdi-plus"></i></a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="set-height-wrap">
                                <!-- Todo-List -->
                                <ul class="todo-list nicescroll-bar">
                                    <li class="todo-item">
                                        <div class="checkbox checkbox-default">
                                            <label for="checkbox01">ضبط کردن اولین اپیزود</label>
                                            <input type="checkbox" id="checkbox01"/>
                                        </div>
                                    </li>
                                    <li>
                                        <hr class="light-grey-hr"/>
                                    </li>
                                    <li class="todo-item">
                                        <div class="checkbox checkbox-pink">
                                            <input type="checkbox" id="checkbox02"/>
                                            <label for="checkbox02">Prepare The Conference Schedule</label>
                                        </div>
                                    </li>
                                    <li>
                                        <hr class="light-grey-hr"/>
                                    </li>
                                    <li class="todo-item">
                                        <div class="checkbox checkbox-warning">
                                            <input type="checkbox" id="checkbox03" checked/>
                                            <label for="checkbox03">Decide The Live Discussion Time</label>
                                        </div>
                                    </li>
                                    <li>
                                        <hr class="light-grey-hr"/>
                                    </li>
                                    <li class="todo-item">
                                        <div class="checkbox checkbox-success">
                                            <input type="checkbox" id="checkbox04" checked/>
                                            <label for="checkbox04">Prepare For The Next Project</label>
                                        </div>
                                    </li>
                                    <li>
                                        <hr class="light-grey-hr"/>
                                    </li>
                                    <li class="todo-item">
                                        <div class="checkbox checkbox-danger">
                                            <input type="checkbox" id="checkbox05" checked/>
                                            <label for="checkbox05">Finish Up AngularJs Tutorial</label>
                                        </div>
                                    </li>
                                    <li>
                                        <hr class="light-grey-hr"/>
                                    </li>
                                    <li class="todo-item">
                                        <div class="checkbox checkbox-purple">
                                            <input type="checkbox" id="checkbox06" checked/>
                                            <label for="checkbox06">Finish Infinity Project</label>
                                        </div>
                                    </li>
                                    <li>
                                        <hr class="light-grey-hr"/>
                                    </li>
                                </ul>
                                <!-- /Todo-List -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</div>
<!-- /Right Sidebar Menu -->