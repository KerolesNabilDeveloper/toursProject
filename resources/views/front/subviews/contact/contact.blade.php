
<!-- breadcrumb area start -->
<div class="breadcrumb-area jarallax" style="background-image:url({{showContent('contact_content.img_cover',true,'public/front/assets/img/slider-1.jpg')}});">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-inner">
                    <h1 class="page-title">{{showContent('contact_content.Contact_us')}}</h1>
                    <ul class="page-list">
                        <li><a href="{{langUrl('')}}">{{showContent('general_keywords.home')}}</a></li>
                        <li>{{showContent('contact_content.Contact_us')}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area End -->


<!-- contact area End -->
<div class="contact-area pd-top-108 pb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-title text-lg-center text-left">
                    <h2 class="title">{{showContent('contact_content.get_in_touch!')}}</h2>
                    <p>{{showContent('contact_content.get_in_touch_body')}}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4 col-lg-4">
                <div class="contact-info bg-gray">
                    <h3 class="text-white mb-3">{{showContent('contact_content.main_information')}}  </h3>
                    <p>
                        <i class="fa fa-map-marker"></i>
                        <span>{{showContent('contact_content.location')}}</span>
                    </p>
                    <p>
                        <i class="fa fa-clock-o"></i>
                        <span>{{showContent('contact_content.text_of_time_work')}}</span>
                    </p>
                    <p>
                        <i class="fa fa-envelope"></i>
                        <span>{{showContent('contact_content.email')}}</span>
                    </p>
                    <p>
                        <i class="fa fa-phone"></i>
                        <span>
                            {{showContent('contact_content.sell_phone')}}<strong>{{showContent('contact_content.sell_phone_number')}}</strong>
                            <br>
                            {{showContent('contact_content.telephone')}}<strong>{{showContent('contact_content.telephone_number')}}</strong>
                        </span>
                    </p>
                </div>
            </div>

            <div class="col-xl-8 col-lg-8">
                <form  class="ajax_form" action="{{langUrl('contact/message')}}" method="post" >
                    {{csrf_field()}}
                    <input type="hidden" name="contact_lang_id" value="{{$selected_lang_obj->lang_id}}" >
                    <div class="row">
                        <div class="col-md-6">
                            <label class="single-input-wrap style-two">
                                <span  class="single-input-title">{{showContent('general_keywords.name')}}</span>
                                <input required name="contact_name" type="text">
                            </label>
                        </div>
                        <div class="col-md-6">
                            <label class="single-input-wrap style-two">
                                <span class="single-input-title">{{showContent('general_keywords.number')}}</span>
                                <input required name="contact_number" type="text">
                            </label>
                        </div>
                        <div class="col-lg-12">
                            <label class="single-input-wrap style-two">
                                <span class="single-input-title">{{showContent('general_keywords.email')}}</span>
                                <input required  name="contact_email" type="text">
                            </label>
                        </div>
                        <div class="col-lg-12">
                            <label class="single-input-wrap style-two">
                                <span class="single-input-title">{{showContent('general_keywords.message')}}</span>
                                <textarea name="contact_message" ></textarea>
                            </label>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-yellow">{{showContent('general_keywords.send_message')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- contact area End -->


@include('front.subviews.index.client_area_index')

