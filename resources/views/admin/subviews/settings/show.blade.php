<div class="slim-mainpanel settings_page">
    <div class="container">

        <div class="slim-pageheader">
            <ol class="breadcrumb slim-breadcrumb">
                <li class="breadcrumb-item"><a href="{{url("admin/dashboard")}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Settings</li>
            </ol>
            <h6 class="slim-pagetitle">Settings</h6>
        </div><!-- slim-pageheader -->

        <div class="section-wrapper">

            <p class="mg-b-20 mg-sm-b-40"></p>

            <div class="table-wrapper">

                <form id="save_form" class="ajax_form" action="{{url("admin/settings")}}" method="POST" enctype="multipart/form-data">

                    <div class="section-wrapper mg-b-20">
                        <label class="section-title">Settings</label>
                        <p class="mg-b-20 mg-sm-b-40"></p>

                            <div id="wizard3">

                                <h3> <i class="fa fa-user"></i> Margin </h3>
                                <section>
                                    @include("admin.subviews.settings.components.margin_settings")
                                </section>

                                <h3> <i class="fa fa-user"></i> Registration </h3>
                                <section>
                                    @include("admin.subviews.settings.components.register_settings")
                                </section>

                                <?php if(false): ?>
                                    <h3> <i class="fa fa-envelope"></i> Email Settings  </h3>
                                    <section>
                                        @include("admin.subviews.settings.components.emails_settings")
                                    </section>
                                <?php endif; ?>

                            </div>
                    </div><!-- section-wrapper -->


                    {{csrf_field()}}

                    <div class="form-layout-footer">
                        <input id="submit" type="submit" name="_submit" value="Save" class="btn btn-primary bd-0">
                    </div>

                </form>

            </div><!-- table-wrapper -->
        </div><!-- section-wrapper -->

    </div><!-- container -->
</div><!-- slim-mainpanel -->

