



    <!-- breadcrumb area start -->
<?php $sum= count($getCats) ?>


    <div class="breadcrumb-area jarallax" style="background-image:url({{get_image_from_json_obj($parent_cats->cat_img_obj)}});">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner">
                        <h1 class="page-title">{{$parent_cats->cat_name}}</h1>
                        <ul class="page-list">
                            <li>
                                <a href="{{langUrl('/')}}">
                                    {!! showContent("general_keywords.Home") !!}
                                </a>
                            </li>
                            <li>{{$parent_cats->cat_name}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area End -->

    <div class="tour-list-area pd-top-50">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 order-lg-12">
                    <div class="tp-tour-list-search-area">
                        <div class="col-lg-12">
                            <div class="filter-wrap margin-bottom-30px">
                                <div class="filter-top d-flex align-items-center justify-content-between pb-4">
                                    <div class="tit_page_tours">
                                        <h3 class="title font-size-24">{{$sum}} {{showContent('cats.cats_found')}}</h3>
                                        <p>{!! $parent_cats->cat_desc !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($getCats as $cat)
                                <div class="col-xl-3 col-sm-6">

                                    <div class="single-package-card wow  fadeInUp animated" data-wow-duration="0.7s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 0.7s; animation-delay: 0.2s; animation-name: fadeInUp;">
                                        <div class="thumb">
                                            <a href="{{langUrl("/tours")}}/{{$parent_cats->cat_slug}}/{{ $cat->cat_slug }}">
                                                <img  src="{{get_image_from_json_obj($cat->cat_img_obj)}}" {{get_image_alt_title($cat->cat_img_obj)}} >
                                            </a>
                                        </div>
                                        <div class="details">
                                            <h3>
                                                <a href="{{langUrl("/tours")}}/{{$parent_cats->cat_slug}}/{{ $cat->cat_slug }}">
                                                    {{$cat->cat_name}}
                                                </a>
                                                <span class="icon-description">
                                                     {{$cat->cat_desc}}
                                                </span>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@include('front.subviews.index.client_area_index')
