<div class="slim-mainpanel">
    <div class="container">
        <div class="slim-pageheader">
            <ol class="breadcrumb slim-breadcrumb">
                <li class="breadcrumb-item"><a href="{{url("admin/dashboard")}}">dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
            </ol>
            <h6 class="slim-pagetitle">Contact Us</h6>
        </div><!-- slim-pageheader -->

        <div class="section-wrapper">

            <p class="mg-b-20 mg-sm-b-40"></p>

            <div class="table-wrapper">

                <?php if(is_array($results->all()) && count($results->all())): ?>

                <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                    <tr>
                        <th class="wd-5p"><span>#</span></th>
                        <th class="wd-10p"><span>name</span></th>
                        <th class="wd-10p"><span>email</span></th>
                        <th class="wd-15p"><span>number</span></th>
                        <th class="wd-20p"><span>tour title</span></th>
                        <th class="wd-20p"><span>show data</span></th>
                    </tr>
                    </thead>
                    <tbody id="sortable">
                    <?php foreach ($results as $key => $item): ?>
                    <tr id=" row{{$item->booking_id}} ">
                        <td>
                            {{$key+1}}
                        </td>
                        <td>
                            {{$item->booking_name}}
                        </td>
                        <td>
                            {{$item->booking_email}}
                        </td>
                        <td>
                            {{$item->booking_phone}}
                        </td>
                        <td>
                            {{$item->tour_title}}

                        </td>
                             <td>
                           <a class="btn btn-primary" href="{{url('admin/booking/show_data?booking_id='.$item->booking_id)}}" >
                               show data
                           </a>

                        </td>

                    </tr>
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
