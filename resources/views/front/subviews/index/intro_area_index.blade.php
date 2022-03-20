<!-- intro area start -->
<div class="intro-area pd-top-75">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6">
                <div class="section-title text-left">
                    <h2 class="title">
                        {!! showContent("index_content.Book_and_Travel_with_Confidence_title") !!}
                    </h2>
                    <p>
                        {!! showContent("index_content.Book_and_Travel_with_Confidence_body") !!}
                    </p>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 text-center">
                <div class="video-popup-wrap style-two mb-5" style="margin-top: -50px">
                    <div class="thumb">

                        <img  src="{!! showContent('index_content.video_popup_img_2',true,'public/front/assets/img/video2.jpg') !!}"  {{get_image_alt_title(showContent('index_content.video_popup_img',true))}}  >

                    </div>
                    <div class="video-popup-btn">
                        <a href="{{showContent('index_content.video_popup_link')}}" class="video-play-btn mfp-iframe">
                            <i class="fa fa-play"></i>
                        </a>
                    </div>
                </div>
            </div>



            <?php
            $slider2 = getContentForSlider("gallery_homepage_slider2.slider1");
            ?>
            <?php foreach($slider2->imgs as $key=>$img): ?>
                <div class="col-lg-3 col-sm-6 single-intro-two bl-0">
                    <div class="single-intro style-two">
                        <div class="thumb">
                            <img src="{{get_image_from_json_obj($img)}}" {{get_image_alt_title($img)}}>
                        </div>
                        <h4 class="intro-title">{!! show_content_for_other_fields($slider2->other_fields,"title",$key) !!}</h4>
                        <p>{!! show_content_for_other_fields($slider2->other_fields,"p",$key) !!}</p>
                    </div>
                </div>
            <?php endforeach; ?>


        </div>
        <?php if(checkAdminCanSeeSiteContentLinks()): ?>
        <a class="btn btn-info" target="_blank" href="{{getAdminEditContentLink("gallery_homepage_slider2")}}">
            Edit Content
        </a>
        <?php endif; ?>
    </div>
</div>
<!-- intro area End -->
