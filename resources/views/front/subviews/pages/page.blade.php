
<!-- breadcrumb area start -->
<div class="breadcrumb-area jarallax" style="background-image:url({{get_image_from_json_obj($item->page_img_obj)}});">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-inner">
                    <h1 class="page-title">{{$item->page_title}}</h1>
                    <ul class="page-list">
                        <li><a href="{{langUrl('/')}}">{{showContent('index_content.home')}}</a></li>
                        <li>{{$item->page_title}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area End -->


<div class="container pt-5 pb-5">
    <div class="row">
        <div class="col-lg-5 align-self-center">
            <div class="section-title mb-lg-0">
                <h2 class="title">{{$item->page_body}}</h2>
                <p>{{$item->page_body_paragraph_one}}</p>
            </div>
        </div>
        <div class="col-lg-5 offset-lg-2">
            <div class="thumb about-section-right-thumb text-right">
                <img src="{{get_image_from_json_obj($item->page_body_img_one_obj)}}" alt="img">
                <img class="about-absolute-thumb" src="{{get_image_from_json_obj($item->page_body_img_two_obj)}}" alt="img">
            </div>
        </div>
        <div class="col-md-12"></div>
        <div class="col-lg-6">
            <div class="section-title mb-lg-0 mt-5">
                <p>{{$item->page_body_paragraph_two}}</p>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="section-title mb-lg-0 mt-5">
                <p>{{$item->page_body_paragraph_three}}</p>
            </div>
        </div>
    </div>
</div>


@include('front.subviews.index.client_area_index')



