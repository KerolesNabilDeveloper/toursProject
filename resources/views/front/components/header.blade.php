<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$meta_title}}</title>
    <meta name="description" content="{{$meta_desc}}">
    <meta name="keywords" content="{{$meta_keywords}}">

    <!-- favicon -->
    <link rel=icon href="{{showContent('logo_imgs.main_icon',true,"public/front/assets/img/favicon.png")}}" sizes="20x20" type="image/png">

    <!-- Additional plugin css -->
    <link rel="stylesheet" href="{{url('public/front/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('public/front/assets/css/animate.css')}}">
    <link rel="stylesheet" href="{{url('public/front/assets/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{url('public/front/assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{url('public/front/assets/css/slick.css')}}">
    <link rel="stylesheet" href="{{url('public/front/assets/css/swiper.min.css')}}">
    <link rel="stylesheet" href="{{url('public/front/assets/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{url('public/front/assets/css/jquery-ui.min.css')}}">
    <!-- icons -->
    <link rel="stylesheet" href="{{url('public/front/assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{url('public/front/assets/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{url('public/front/assets/css/line-awesome.min.css')}}">
    <!-- main css -->
    <link rel="stylesheet" href="{{url('public/front/assets/css/style.css')}}">
    <!-- responsive css -->
    <link rel="stylesheet" href="{{url('/public/site_content/design.css')}}" >
    <link rel="stylesheet" href="{{url("/")}}/public/sweet_alert/sweetalert2.min.css">


</head>
<body>

<input type="hidden" class="csrf_input_class" value="{{csrf_token()}}">
<input type="hidden" class="url_class" value="{{url("/")}}">
<input type="hidden" class="lang_url_class" value="{{$lang_url_segment ?? "/" }}">
<input type="hidden" class="sweet_alert_confirmation_msg" value="{{showContent("general_keywords.are_your_sure")}}">
<input type="hidden" class="sweet_alert_confirmation_yes" value="{{showContent("general_keywords.yes")}}">
<input type="hidden" class="sweet_alert_confirmation_no" value="{{showContent("general_keywords.no")}}">
<input type="hidden" class="show_admin_content" value="{{session("show_admin_content","no")}}">

<!-- search popup start -->
<div class="body-overlay" id="body-overlay"></div>
<div class="search-popup" id="search-popup">
    <form action="#" class="search-form">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search.....">
        </div>
        <button type="submit" class="submit-btn"><i class="fa fa-search"></i></button>
    </form>
</div>
<!-- search popup End -->
<!-- navbar area start -->
<div class="top-navbar">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 topbar-contact-wrap">
                <div class="topbar-contact">
                    <i class="fa fa-phone"></i>
                    <span class="title">
                        {!! showContent("general_keywords.support") !!}
                        :
                    </span>
                    <span class="number">{!! showContent("general_keywords.phone") !!}</span>
                </div>
                <ul class="social-icon">
                    @foreach($socialLinksTitles as $key => $title)
                        <li>
                            <a class="{{$title}}" href="{{$socialLinksKLinks[$key] ?? ""}}" target="_blank">
                                <i class="{{$socialLinksIcons[$key] ?? ""}}  "></i>
                            </a>
                        </li>
                    @endforeach
                    <?php if(checkAdminCanSeeSiteContentLinks()): ?>
                        <li>
                            <a class="btn btn-info" target="_blank" href="{{getAdminEditContentLink("social_links")}}">
                                Edit
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="col-lg-6">
                <div class="nav-right-content float-right">
                    <ul class="pl-0">
                        <li class="tp-lang">
                            <div class="tp-lang-wrap">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                        {{$selected_lang_title}}
                                    </button>
                                    <div class="dropdown-menu">
                                        @foreach($all_langs as $key=>$lang)
                                            <a class="dropdown-item do_not_ajax accumulate_to_current_link " href=""
                                               data-href="change_lang={{$lang->lang_title}}">
                                                {{$lang->lang_title}}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        </li>
                        <li class="search">
                            <i class="ti-search"></i>
                        </li>
                        <li class="notification">
                            <a class="signUp-btn" href="{{langUrl('/contact')}}">
                                <a class="btn btn-yellow btn-pa" href="{{langUrl('/contact')}}">
                                    {{showContent('contact_content.contact_us')}}
                                    <i class="fa fa-paper-plane"></i>
                                </a>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<nav class="navbar navbar-area navbar-expand-lg nav-style-03">
    <div class="container nav-container">
        <div class="responsive-mobile-menu">
            <div class="mobile-logo">
                <a href="{{langUrl('/')}}">
                    <img src="{{showContent("logo_imgs.third_logo",true)}}" alt="logo">
                </a>
            </div>
            <button class="navbar-toggler float-right" type="button" data-toggle="collapse" data-target="#tp_main_menu"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggle-icon">
                        <span class="line"></span>
                        <span class="line"></span>
                        <span class="line"></span>
                    </span>
            </button>
            <div class="nav-right-content">
                <ul class="pl-0">
                    <li class="top-bar-btn-booking">
                        <a class="btn btn-yellow" href="#">  Contact Us  <i class="fa fa-paper-plane"></i></a>
                    </li>
                    <li class="tp-lang">
                        <div class="tp-lang-wrap">
                                @foreach($all_langs as $key=>$lang)
                                    <a class="dropdown-item do_not_ajax accumulate_to_current_link " href=""
                                       data-href="change_lang={{$lang->lang_title}}">
                                        {{$lang->lang_title}}
                                    </a>
                                @endforeach
                        </div>
                    </li>
                    <li class="search">
                        <i class="ti-search"></i>
                    </li>
                </ul>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="tp_main_menu">
            <div class="logo-wrapper desktop-logo">
                <a href="{{langUrl('/')}}" class="main-logo">
                    <img src="{{showContent('logo_imgs.main_logo',true,"public/front/assets/img/logo.png")}}"   >
                </a>

                <a href="{{langUrl('/')}}" class="sticky-logo">
                    <img src="{{showContent('logo_imgs.secondary_logo',true,"public/front/assets/img/logo.png")}}"  >
                </a>
            </div>
            <ul class="navbar-nav">


                <li class="menu-item-has-children">
                    <a href="{{langUrl('/')}}">{!! showContent("general_keywords.home") !!}</a>
                </li>
                @foreach($menu_pages as $page)
                <li>
                    <a href="{{langUrl('pages/')."/".$page->page_slug}}">
                         {{$page->page_title}}
                    </a>
                </li>
                @endforeach


                @foreach($cats[0] as $key =>$cat)
                    <li class="menu-item-has-children">
                        <a href="{{langUrl('/')}}/tours/{{$cat->cat_slug}}">{{$cat->cat_name}}</a>
                        <ul class="sub-menu">
                            @foreach($cats[$cat->cat_id] ??[] as $item)
                                <li>
                                    <a href="{{langUrl('/')}}/tours/{{$cat->cat_slug}}/{{$item->cat_slug}}">
                                        {{$item->cat_name}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach

            </ul>
        </div>

    </div>
</nav>
<!-- navbar area end -->
