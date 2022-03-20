{{--
<div class="slim-mainpanel">
    <div class="container">
        <div class="slim-pageheader">
            <ol class="breadcrumb slim-breadcrumb">
                <li class="breadcrumb-item"><a href="{{url("admin/dashboard")}}">dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">tours</li>
            </ol>
            <h6 class="slim-pagetitle">tours</h6>
        </div><!-- slim-pageheader -->

        <div class="section-wrapper">

            <p class="mg-b-20 mg-sm-b-40"></p>

            <div class="table-wrapper">

                <?php if(false): ?>

                    <?php for($i=0;$i<$tours_pages;$i++): ?>
                        <a href="{{url("/admin/getTours")}}?page_num={{$i}}&tours_pages={{$tours_pages}}">{{$i+1}}</a>
                    <?php endfor; ?>

                    @dump($tours->pluck("id")->all())
                <?php endif; ?>

                {!! $tours->links() !!}

                @dump($tours->pluck("id")->all())



            </div><!-- table-wrapper -->
        </div><!-- section-wrapper -->

    </div><!-- container -->
</div><!-- slim-mainpanel -->
--}}
