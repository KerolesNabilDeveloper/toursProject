
<?php $sum=count($all_tours) ?>
<!-- breadcrumb area start -->

<div class="breadcrumb-area jarallax" style="background-image:url({{get_image_from_json_obj($child_cat->cat_img_obj)}});">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-inner">
                    <h1 class="page-title">{{$child_cat->cat_name}}</h1>
                    <ul class="page-list">
                        <li>
                            <a href="{{langUrl('/')}}">
                                {!! showContent("general_keywords.Home") !!}
                            </a>
                        </li>
                        <li>
                            <a href="{{langUrl('/tours')}}/{{$parent_cat->cat_slug}}">
                                {{$parent_cat->cat_name}}
                            </a>
                        </li>

                        <li>{{$child_cat->cat_name}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area End -->


<!-- tour list area End -->
<div class="tour-list-area pd-top-50">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 order-lg-12">
                <div class="tp-tour-list-search-area">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="filter-wrap margin-bottom-30px">
                                <div class="filter-top d-flex align-items-center justify-content-between pb-4">
                                    <div class="tit_page_tours">
                                        <h3 class="title font-size-24">{{$sum}} {{showContent('tours.tours_found')}}</h3>
                                        <p>{!! $child_cat->cat_desc !!}</p>
                                    </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">


                        <?php if($sum==0):  ?>
                                <h1>No Tours</h1>
                        <?php endif;?>
                        <?php if($sum > 0):  ?>
                            @foreach($all_tours as $tour)
                                <div class="{{($sum==1)?"col-xl-12 col-sm-12":"col-xl-3 col-sm-6"}}">
                                    <div class="single-package-card wow  fadeInUp animated" data-wow-duration="0.7s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 0.7s; animation-delay: 0.2s; animation-name: fadeInUp;">
                                        <div class="thumb">
                                            <a href="{{langUrl("/tours")}}/{{$parentCatSlug}}/{{ $childCatSlug }}/{{ $tour->tour_slug }}">
                                                <img  src="{{get_image_from_json_obj($tour->tour_main_img_obj)}}" {{get_image_alt_title($tour->tour_main_img_obj)}} >
                                            </a>
                                        </div>
                                        <div class="details">
                                            <h3>
                                                <a href="{{langUrl("/tours")}}/{{$parentCatSlug}}/{{ $childCatSlug }}/{{ $tour->tour_slug }}">
                                                    {{$tour->tour_title}}
                                                </a>
                                                <span class="location-name">
                                                    <img src="{{url('/public/front/assets/img/icons/1.png')}}" alt="img">
                                                    {{$tour->tour_location}}
                                                </span>
                                            </h3>


                                            <p class="des_tours">
                                                {{$tour->tour_short_desc}}
                                            </p>

                                            <ul class="package-meta">
                                                <li class="tp-price-meta">
                                                    <p><i class="fa fa-clock-o"></i> {{$tour->tour_duration}}</p>
                                                </li>
                                                <li class="tp-price-meta">
                                                    <p><i class="fa fa-users"></i> {{$tour->tour_number_of_people}}</p>
                                                </li>
                                                <li class="tp-price-meta">
                                                    <h2> <i class="fa fa-tag"></i> {{$tour->tour_discount}}<span>$</span></h2>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        <?php endif;?>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
<!-- tour list area End -->
</div>

@include('front.subviews.index.client_area_index')
