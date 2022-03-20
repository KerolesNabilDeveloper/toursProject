<!-- client area start -->
<div class="client-area mt-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-10">
                <div class="section-title text-center">
                    <h2 class="title">{!! showcontent('index_content.what_our_clients_say_title') !!}</h2>
                    <p>{!! showContent('index_content.what_our_clients_say_body') !!}</p>
                </div>
            </div>
        </div>

        <?php if(checkAdminCanSeeSiteContentLinks()): ?>
            <a class="btn btn-info" target="_blank" href="{{getAdminEditContentLink("testimonial_gallery")}}">
                Edit Content
            </a>
        <?php endif; ?>

        <div class="client-slider tp-common-slider-style">

            <?php
                $testimonial_gallery = getContentForSlider("testimonial_gallery.slider1");
            ?>

            <?php foreach($testimonial_gallery->imgs as $key=>$img): ?>
                <div class="single-client-card">
                    <div class="quote"><i class="ti-quote-left"></i></div>
                    <p class="content-text">{!! show_content_for_other_fields($testimonial_gallery->other_fields,"text_content",$key) !!}</p>
                    <div class="media">
                        <div class="media-left">
                            <img src="{{get_image_from_json_obj($img)}}" {{get_image_alt_title($img)}} >
                        </div>
                        <div class="media-body">
                            <h4>{!! show_content_for_other_fields($testimonial_gallery->other_fields,"name",$key) !!}</h4>
                            <span>{!! show_content_for_other_fields($testimonial_gallery->other_fields,"title",$key) !!}</span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
</div>
<!-- client area end -->

