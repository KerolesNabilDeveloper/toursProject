
<!-- Popular Tours start -->
<div class="offer-area pd-top-70">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8">
                <div class="section-title text-center">
                    <h2 class="title">{!! showContent('index_content.Popular_Tours_Now_title')!!}</h2>
                    <p>{!! showContent('index_content.Popular_Tours_Now_body')!!}
                </div>
            </div>
        </div>
    </div>
    <div class="destinations-list-slider-bg">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 col-lg-10 offset-xl-1 order-lg-12">
                    <div class="destinations-list-slider">
                        @foreach($tours_in_index as $tour )
                            <div class="d-list-slider-item">
                                <div class="single-destinations-list text-center">
                                    <div class="thumb">
                                        <span class="d-list-tag">
                                            {!! showContent("general_keywords.special_offer") !!}
                                        </span>
                                        <img src="{{get_image_from_json_obj($tour->tour_main_img_obj)}}"
                                                {{get_image_alt_title($tour->tour_main_img_obj)}}>
                                        <div class="d-list-btn-wrap">
                                            <div class="d-list-btn">
                                                <a class="btn btn-yellow" href="{{langUrl('tours')}}/{{$tour->parent_cat_slug}}/{{$tour->child_cat_slug}}/{{$tour->tour_slug}}">
                                                    {!! showContent("general_keywords.book_now") !!}
                                                    <i class="fa fa-paper-plane"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="details">
                                        <h4 class="title"> <a href="{{$tour->tour_slug}}"> {{$tour->tour_title}} </a> </h4>
                                        <p class="content">{{$tour->tour_duration}}</p>
                                        <ul class="tp-list-meta border-bt-dot">
                                            <li><i class="fa fa-users"></i>{{$tour->tour_number_of_people}}</li>
                                            <li><i class="fa fa-clock-o"></i> {{$tour->tour_duration}}</li>
                                        </ul>
                                        <div class="tp-price-meta tp-price-meta-cl">
                                            <p>{!! showContent("general_keywords.starting_from") !!}</p>
                                            <h2>{{$tour->tour_discount}}<small>$</small></h2>
                                            <del>{{$tour->tour_price}}<span>$</span></del>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach

                    </div>
                </div>
                <div class="col-lg-2 align-self-center order-lg-11">
                    <div class="container">
                        <div class="destinations-slider-controls">
                            <div class="slider-nav tp-control-nav"></div>
                            <!--slider-nav-->
                            <div class="tp-slider-extra slider-extra">
                                <div class="text">
                                    <span class="first">01 </span>
                                    <span class="last"></span>
                                </div>
                                <!--text-->
                                <div class="d-list-progress" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                    <span class="slider__label sr-only"></span>
                                </div>
                            </div>
                            <!--slider-extra-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Popular Toursend -->