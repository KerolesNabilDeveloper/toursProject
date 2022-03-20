<div class="slim-mainpanel">
    <div class="container">
        <div class="slim-pageheader">
            <ol class="breadcrumb slim-breadcrumb">
                <li class="breadcrumb-item"><a href="{{url("admin/dashboard")}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Users</li>
            </ol>
            <h6 class="slim-pagetitle">Users</h6>
        </div><!-- slim-pageheader -->

        <div class="section-wrapper">
            <p class="mg-b-20 mg-sm-b-40"></p>

            <div class="table-wrapper">

                <?php if(is_array($results->all()) && count($results->all())): ?>

                    <table id="datatable2" class="table display responsive nowrap">
                        <thead>
                        <tr>
                            <th class="wd-15p"><span>#</span></th>
                            <th class="wd-15p"><span>Email</span></th>
                            <th class="wd-15p"><span>Full Name</span></th>
                            <th class="wd-15p"><span>Active ?</span></th>
                            <th class="wd-15p"><span>Blocked ?</span></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($results as $key => $item): ?>
                            <tr>
                                <td>
                                    {{$key+1}}
                                </td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->full_name}}</td>

                                <td>
                                    <?php
                                        echo generate_multi_accepters(
                                            $accepturl              = "",
                                            $item_obj               = $item,
                                            $item_primary_col       = "user_id",
                                            $accept_or_refuse_col   = "is_active",
                                            $model                  = \App\User::class,
                                            $accepters_data         =
                                            [
                                                "0"     => "<i class='fa fa-times'></i>",
                                                "1"     => "<i class='fa fa-check'></i>",
                                            ]
                                        );
                                    ?>
                                </td>

                                <td>
                                    <?php
                                        echo generate_multi_accepters(
                                            $accepturl              = "",
                                            $item_obj               = $item,
                                            $item_primary_col       = "user_id",
                                            $accept_or_refuse_col   = "user_is_blocked",
                                            $model                  = \App\User::class,
                                            $accepters_data         =
                                            [
                                                "0"     => "<i class='fa fa-times'></i>",
                                                "1"     => "<i class='fa fa-check'></i>",
                                            ]
                                        );
                                    ?>
                                </td>

                            </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>

                    @include('global_components.pagination')

                <?php else : ?>

                    @include('global_components.no_results_found')

                <?php endif; ?>


            </div><!-- table-wrapper -->
        </div><!-- section-wrapper -->

    </div><!-- container -->
</div><!-- slim-mainpanel -->
