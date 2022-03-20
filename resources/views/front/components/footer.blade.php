<!-- back to top area start -->
<div class="back-to-top">
    <span class="back-top"><i class="fa fa-angle-up"></i></span>
</div>
<!-- back to top area end -->
<div class="block_partiners">
    <div class="container">
        <div class="owl-carousel owl-theme">

            <?php
            $partiners_gallery = getContentForSlider("partiners_gallery.slider1");
            ?>
            <?php foreach($partiners_gallery->imgs as $key=>$img): ?>
            <figure class="item_block_pert">
                <a href="{!! show_content_for_other_fields($partiners_gallery->other_fields,"link",$key) !!}">
                    <img src="{{get_image_from_json_obj($img)}}" {{get_image_alt_title($img)}} >
                </a>
            </figure>
            <?php endforeach; ?>

        </div>
    </div>
</div>

<!-- newslatter area Start -->
<div class="newslatter-area">
    <div class="container">
        <div class="newslatter-area-wrap">
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-md-5 offset-xl-2">
                    <div class="section-title mb-md-0">
                        <h2 class="title">{!! showContent('general_keywords.news_letter') !!}</h2>
                        <p{!! showContent('general_keywords.news_letter_title') !!}> </p>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-7 align-self-center offset-xl-1">
                    <form class="ajax_form"  action="{{url('subscribers')}}" method="post">
                        <div class="input-group newslatter-wrap">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                            </div>
                            {!! csrf_field() !!}
                            <input type="email" class="form-control" name="email" placeholder="Email">
                            <div class="input-group-append">
                                <button  class="btn btn-yellow"  type="submit">{!! showContent('general_keywords.Subscribe') !!}</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- newslatter area End -->




<!-- footer area start -->
<footer class="footer-area style-three" style="background-image: url({{showContent('footer_content.footer_area_img',true,"public/front/assets/img/2.png")}});">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="about_us_widget text-center">
                    <a href="{{langUrl('/')}}" class="footer-logo">
                        <img src="{{showContent('footer_content.img_logo',true,'public/front/assets/img/sticky-logo.png')}}"{{get_image_alt_title(showContent('footer_content.img_logo',true))}} >

                    </a>
                </div>
                <div class="footer-widget widget text-center">
                    <ul class="widget_nav_menu text-center">
                        <li>
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
                            <li>
                                <a href="{{langUrl('/')}}/tours/{{$cat->cat_slug}}">{{$cat->cat_name}}</a>
                            </li>
                        @endforeach
                        <li>
                            <a href="{{langUrl('/contact')}}">
                                {{showContent('contact_content.contact_us')}}
                            </a>
                        </li>
                    </ul>
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
            </div>
        </div>
    </div>
    <div class="copyright-inner border-tp-solid">
        <div class="container">
            <div class="copyright-text text-center">
                All rights reserved. Powered with by    &copy; <a href="#" target="_blank"><span>SeoEra</span></a>
            </div>
        </div>
    </div>
</footer>
<!-- footer area end -->


<!-- Additional plugin js -->

<script src="{{asset('public/front/assets/js/jquery-2.2.4.min.js')}}"></script>
<script src="{{asset('public/front/assets/js/popper.min.js')}}"></script>
<script src="{{asset('public/front/assets/js//bootstrap.min.js')}}"></script>
<script src="{{asset('public/front/assets/js//jquery.magnific-popup.js')}}"></script>
<script src="{{asset('public/front/assets/js//owl.carousel.min.js')}}"></script>
<script src="{{asset('public/front/assets/js//wow.min.js')}}"></script>
<script src="{{asset('public/front/assets/js//slick.js')}}"></script>
<script src="{{asset('public/front/assets/js//waypoints.min.js')}}"></script>
<script src="{{asset('public/front/assets/js//jquery.counterup.min.js')}}"></script>
<script src="{{asset('public/front/assets/js//imagesloaded.pkgd.min.js')}}"></script>
<script src="{{asset('public/front/assets/js//isotope.pkgd.min.js')}}"></script>
<script src="{{asset('public/front/assets/js//swiper.min.js')}}"></script>
<script src="{{asset('public/front/assets/js//jquery.nice-select.min.js')}}"></script>
<script src="{{asset('public/front/assets/js//jquery-ui.min.js')}}"></script>

<!-- main js -->
<script src="{{url("/")}}/public/sweet_alert/sweetalert2.min.js"></script>
<script src="{{url("")}}/public/jscode/call_at_load.js"></script>
<script src="{{url("")}}/public/jscode/config.js"></script>
<script src="{{url("")}}/public/front/assets/js/main.js"></script>
<script src="{{url("")}}/public/jscode/routes.js"></script>
<script src="{{url("")}}/public/jscode/site_content.js"></script>

</body>
</html>