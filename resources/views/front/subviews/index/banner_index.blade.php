<!-- banner area start -->


<div class="main-banner-area jarallax">
    <div class="banner-slider banner-slider-3">
        <?php
        $sliderData = getContentForSlider("gallery_homepage.slider1");
        ?>
        <?php foreach($sliderData->imgs as $key=>$img): ?>
        <div class="banner-slider-item banner-bg-1" style="background-image: url({{get_image_from_json_obj($img)}});">
            <div class="content">
                <div class="container">
                    <h1>{!! show_content_for_other_fields($sliderData->other_fields,"img_title",$key) !!}</h1>
                    <h1 class="shadow">{!! show_content_for_other_fields($sliderData->other_fields,"slider_alt",$key) !!}</h1>
                    <p class="banner-cat s-animate-1">{!! show_content_for_other_fields($sliderData->other_fields,"slider_title",$key) !!}</p>
                </div>
            </div>
        </div>
        <?php endforeach; ?>

    </div>
</div>

<?php if(checkAdminCanSeeSiteContentLinks()): ?>
<a class="btn btn-info" target="_blank" href="{{getAdminEditContentLink("gallery_homepage")}}">
    Edit Content
</a>
<?php endif; ?>
<!-- banner area end -->

