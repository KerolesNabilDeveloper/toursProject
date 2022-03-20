



<!-- breadcrumb area start -->
<div class="breadcrumb-area jarallax" style="background-image:url({{get_image_from_json_obj($tour_obj->tour_cover_img_obj)}});">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-inner">
                    <h1 class="page-title">{{$tour_obj->tour_name}}</h1>
                    <ul class="page-list">
                        <li>
                            <a href="{{langUrl('')}}">
                                {!! showcontent('general_keywords.home')!!}
                            </a>
                        </li>
                        <li>
                            <a href="{{langUrl('/')}}/tours/{{$parentCatSlug}}">
                                {{$tour_obj->name_parent}}
                            </a>
                        </li>
                        <li>
                            <a href="{{langUrl('/')}}/tours/{{$parentCatSlug}}/{{$childCatSlug}}">
                                {{$tour_obj->name_child}}
                            </a>
                        </li>
                        <li>
                            {{$tour_obj->tour_name}}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area End -->

<!-- tour details area End -->
<div class="tour-details-area">
    <div class="tour-details-gallery">
        <div class="container-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row justify-content-center">
                            <div class="col-xl-12">
                                <div class="destinations-details-main-slider-wrap">
                                    <div class="destinations-details-main-slider">
                                        @foreach(json_decode($tour_obj->tour_slider_obj) as $img )
                                            <div class="d-details-main-slider-item">
                                                <img src="{{get_image_from_obj($img)}}" {{get_image_alt_title($img)}}>
                                            </div>
                                        @endforeach
                                    </div>
                                    <?php
                                    if (count(json_decode($tour_obj->tour_slider_obj)) >1):?>
                                    <div class="destinations-details-main-slider-controls">
                                        <div class="slider-nav tp-control-nav"></div>
                                        <!--slider-nav-->
                                        <div class="slider-extra tp-slider-extra">
                                            <div class="text">
                                                <span class="first">01 </span>
                                                <span class="last">07</span>
                                            </div>
                                            <!--text-->
                                            <div class="d-list-progress" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                                <span class="slider__label sr-only"></span>
                                            </div>
                                        </div>
                                        <!--slider-extra-->
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="details hed_info_tours">
                                    <div class="main_info_tours float-left w-100">
                                        <h4 class="title">{{$tour_obj->tour_title}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="tour-details-wrap mt-4">
                                    <h4 class="single-page-small-title mb-3">
                                        {!! showcontent('general_keywords.description')!!}
                                    </h4>
                                    <p>{{$tour_obj->tour_description}}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div id="utf_listing_amenities" class="utf_listing_section">
                                    <h3 class="utf_listing_headline_part margin-top-50 margin-bottom-40">
                                        {!! showcontent('general_keywords.included')!!}
                                    </h3>
                                    <ul class="utf_listing_features checkboxes margin-top-0">
                                        {!! $tour_obj->tour_inclusions !!}
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div id="utf_listing_amenities" class="utf_listing_section">
                                    <h3 class="utf_listing_headline_part margin-top-50 margin-bottom-40">
                                        {!! showcontent('general_keywords.excluded')!!}
                                    </h3>
                                    <ul class="utf_listing_features utf_listing_features_Excluded checkboxes checkboxes_Excluded margin-top-0">
                                        {!! $tour_obj->tour_exclusions !!}
                                    </ul>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-12">

                                <div id="itinerary" class="page-scroll">
                                    <div class="single-content-item padding-top-40px padding-bottom-40px">
                                        <h3 class="utf_listing_headline_part margin-top-50 margin-bottom-40">
                                            <i class="fa fa-bed" aria-hidden="true"></i>
                                            {!! showcontent('general_keywords.itinerary')!!}
                                        </h3>
                                        <div class="accordion accordion-item padding-top-30px" id="accordionExample">

                                            @foreach(json_decode($tour_obj->tour_itinerary) as $itinerary )
                                                <div class="card">
                                                    <div class="card-header" id="faqHeadingOne">
                                                        <h2 class="mb-0">
                                                            <button class="btn btn-link d-flex align-items-center justify-content-between font-size-16" type="button" data-toggle="collapse" data-target="#faqCollapseOne" aria-expanded="true" aria-controls="faqCollapseOne">
                                                                <span>{{$itinerary->tour_itinerary_title}}</span>
                                                            </button>
                                                        </h2>
                                                    </div>
                                                    <div id="faqCollapseOne" class="collapse show" aria-labelledby="faqHeadingOne" data-parent="#accordionExample">
                                                        <div class="card-body align-items-center row">
                                                            <p class="col-md-12">{!! $itinerary->tour_itinerary_body !!}</p>
                                                        </div>
                                                    </div>
                                                </div><!-- end card -->
                                            @endforeach
                                        </div>
                                    </div><!-- end single-content-item -->
                                    <div class="section-block"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="sidebar-area">
                            <div class="utf_box_widget opening-hours margin-top-5">
                                <h3>{!! showContent('general_keywords.tour_details') !!}</h3>
                                <ul>
                                    <li class="row justify-content-between">
                                        <b>
                                            <i class="fa fa-tag"></i>
                                            {!! showContent('general_keywords.starts_from') !!}
                                        </b>
                                        <span>
                                            <b>
                                                {{$tour_obj->tour_discount}} USD /
                                                {{$tour_obj->tour_number_of_people}}
                                            </b>
                                        </span>
                                    </li>
                                    <li class="row justify-content-between">
                                        <b>
                                            <i class="fa fa-clock-o"></i>
                                            {!! showContent('general_keywords.tour_duration') !!}
                                        </b>
                                        <span>
                                            {{$tour_obj->tour_duration}}
                                            {!! showContent('general_keywords.Day') !!}
                                        </span>
                                    </li>
                                    <li class="row justify-content-between">
                                        <b>
                                            <i class="fa fa-map-marker"></i>
                                            {!! showContent('general_keywords.location') !!}
                                        </b>
                                        <span>
                                            {{$tour_obj->tour_location}}
                                        </span>
                                    </li>
                                </ul>
                            </div>
                            <div class="widget tour-list-widget">
                                <div class="widget-tour-list-meta border-0">
                                    <h3 class="tit_booking_trip">
                                        {!! showContent('general_keywords.booking_trip') !!}
                                   </h3>
                                    <form id="booking_form"  class="ajax_form" action="{{url('booking/tour')}}" method="post" >

                                        {!! csrf_field() !!}

                                        <input type="hidden" name="booking_tour_id" value="{{$tour_obj->id}}">
                                        <input type="hidden" name="tour_link" value="{{langUrl('/')}}/tours/{{$parentCatSlug}}/{{$childCatSlug}}/{{$tour_obj->tour_slug}}">
                                        <input type="hidden" name="tour_name" value="{{$tour_obj->tour_name}}">

                                        <div class="single-widget-search-input">
                                            <input type="text" required name="booking_name" placeholder="{{showContent('general_keywords.name_placeholder')}}">
                                        </div>
                                        <div class="single-widget-search-input">
                                            <input type="email" required name="booking_email" placeholder="{{showContent('general_keywords.email_placeholder')}}">
                                        </div>
                                        <div class="single-widget-search-input">
                                            <input type="text" required name="booking_phone" placeholder="{{showContent('general_keywords.phone_placeholder')}}">
                                        </div>
                                        <div class="single-widget-search-input">
                                            <input type="text" required name="booking_departing" class="departing-date custom-select" placeholder="{{showContent('general_keywords.departing_placeholder')}}">
                                        </div>
                                        <div class="single-widget-search-input">
                                            <input type="text" required name="booking_returning" class="returning-date custom-select" placeholder="{{showContent('general_keywords.returning_placeholder')}}">
                                        </div>
                                        <div class="single-widget-search-input">
                                            <textarea name="booking_type" placeholder="{{showContent('general_keywords.type_placeholder')}}"></textarea>
                                        </div>
                                        <div class="text-lg-center text-left">
                                            <button type="submit" class="btn btn-yellow w-100" id="booking">
                                                {!! showContent('general_keywords.book_now') !!}
                                                <i class="fa fa-paper-plane"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="widget tour-list-widget">
                                <h3 class="tit_booking_trip">
                                    {!! showContent('general_keywords.related_tours') !!}
                                </h3>
                                <ul class="related_tours_view">

                                    @foreach($someTour as $tour)
                                        <li>
                                            <a href="{{langUrl('tours')}}/{{$parentCatSlug}}/{{$childCatSlug}}/{{$tour->tour_slug}}">
                                                <img src="" >
                                            </a>
                                            <div>
                                                <h3>
                                                    <a href="{{langUrl('tours')}}/{{$parentCatSlug}}/{{$childCatSlug}}/{{$tour->tour_slug}}">
                                                        {{$tour->tour_title}}
                                                    </a>
                                                </h3>
                                                <span>
                                                    <i class="fa fa-tag"></i>
                                                    {{$tour->tour_discount}}
                                                    USD /
                                                    {{$tour->tour_number_of_people}}
                                                </span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- tour details area End -->


@include('front.subviews.index.client_area_index')