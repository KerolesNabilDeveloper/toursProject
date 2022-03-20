<!DOCTYPE html>
<html dir="{{(config('locale') == "en")?"ltr":"rtl"}}" data-dark_mode="{{config('dark_mode')}}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{$meta_title}}</title>

    <link rel="shortcut icon" href="{{showContent("logo_and_icon.icon",true)}}" type="image/x-icon">

    @include('global_components.header_components')

</head>
<body>


    @include("general_form_blocks.main_btm_select_2")

    @include("admin.components.navigation_header")

    <?php if(config('menu_display') == "navbar"): ?>
        @include("admin.components.navigation_menu")
    <?php endif; ?>

    @include('global_components.hidden_inputs')
    @include('global_components.toastr_msg')
    @include('global_components.modals.server_msg_modal')
    @include('global_components.modals.confirm_modal')
    @include('global_components.modals.thanks_modal')
    @include('global_components.modals.errors_modal')

    <input type="hidden" class="socket_link" value="{{env("SOCKET_LINK")}}">
    <input type="hidden" class="btm_select2_socket_link" value="{{env("btm_select2_socket_link")}}">

    <?php if(false): ?>
        <script src="{{env('SOCKET_LINK')}}/socket.io/socket.io.js"></script>

        <?php if(!empty(env('btm_select2_socket_link'))): ?>
        <script src="{{env('btm_select2_socket_link')}}/socket.io/socket.io.js"></script>
        <?php endif; ?>

    <?php endif; ?>

