<div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="">
                    <h4 class="page-title">data of booking</h4>
                    <h5 class="page-title">{{$results->booking_name}}</h5>
                    <ul class="page-list">
                        <li>
                            {{$results->booking_email}}
                        </li>
                        <li>
                            {{$results->booking_phone}}
                        </li>
                        <li>
                            {{$results->booking_departing}}
                        </li>
                        <li>
                            {{$results->booking_returning}}
                        </li>
                        <li>
                            {{$results->booking_type}}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcrumb-inner">
                <h4 class="page-title">data of tour</h4>
                <h5 class="page-title">{{$results->tour_name}}</h5>
                <ul class="page-list">
                    <li>
                        {{$results->tour_location}}
                    </li>
                    <li>
                        {{$results->tour_number_of_people}}
                    </li>
                    <li>
                        {{$results->tour_type}}
                    </li>
                    <li>
                        {{$results->tour_title}}
                    </li>
                    <li>
                        {{$results->tour_duration}}
                    </li>
                    <li>
                        {{$results->tour_description}}
                    </li>
                    <li>
                        {!! $results->tour_inclusions !!}
                    </li>
                    <li>
                        {!! $results->tour_exclusions !!}
                    </li>
                    <li>
                       <img width="100px" height="100px" src="{{get_image_from_json_obj( $results->tour_main_img_obj)}}" >
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>


