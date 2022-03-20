<!-- breadcrumb area start -->
<div class="breadcrumb-area jarallax" style="background-image:url(assets/img/slider-5.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-inner">
                    <h1 class="page-title">login</h1>
                    <ul class="page-list">
                        <li><a href="index.html">Home</a></li>
                        <li>login admin</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area End -->


<div class="container pt-5 pb-5">
    <div class="row ml-6">


        <form action="{{langUrl("/login")}}" method="post" class="ajax_form">
            <div class="form-group">
                <label class="label-text">{!! showContent("general_keywords.email") !!}</label>
                <input class="form-control" type="email" required name="field" placeholder="{!! showContent("authentication.enter_email_address") !!}">
            </div>

            <div class="form-group">
                <label class="label-text">{!! showContent("general_keywords.password") !!}</label>
                <input class="form-control" type="password" required name="password" placeholder="{!! showContent("authentication.enter_email_password") !!}">
            </div>

            <button type="submit" class="btn btn-info">login</button>

        </form>

    </div>
</div>

