<div class="slim-mainpanel">
    <div class="container">
        <div class="slim-pageheader">
            <ol class="breadcrumb slim-breadcrumb">
                <li class="breadcrumb-item"><a href="{{url("admin/dashboard")}}">dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">categories</li>
            </ol>
            <h6 class="slim-pagetitle">categories</h6>
        </div><!-- slim-pageheader -->

        <div class="section-wrapper">

            <?php if(havePermission("admin/categories","add_action")): ?>
                <label class="section-title">
                    <a class="btn btn-primary mg-b-6" href="{{url("admin/categories/save")}}">Add new<i class="fa fa-plus"></i></a>
                </label>
            <?php endif; ?>

            <p class="mg-b-20 mg-sm-b-40"></p>

            <div class="table-wrapper">

                <?php if(is_array($results->all()) && count($results->all())): ?>

                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                        <tr>
                            <th class="wd-15p"><span>#</span></th>
                            <th class="wd-15p"><span>Image</span></th>
                            <th class="wd-15p"><span>Name</span></th>
                            <th class="wd-15p"><span>Child</span></th>
                            <th class="wd-15p"><span>Show in menu?</span></th>
                            <th class="wd-15p"><span>Option</span></th>
                        </tr>
                        </thead>
                        <tbody id="sortable">
                        <?php foreach ($results[0] as $key => $item): ?>
                            @include("admin.subviews.categories.cat_tr")
                        <?php endforeach ?>
                        </tbody>
                    </table>

                <?php else : ?>

                    @include('global_components.no_results_found')

                <?php endif; ?>

            </div><!-- table-wrapper -->
        </div><!-- section-wrapper -->

    </div><!-- container -->
</div><!-- slim-mainpanel -->
