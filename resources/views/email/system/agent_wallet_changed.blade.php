@extends("email.main_layout")
@section("subview")

    <table align="center" cellpadding="0" cellspacing="0" style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; box-sizing: border-box; width: 90%; margin: 0 auto; padding: 0;" bgcolor="#FFFFFF" width="570px">
        <!-- Body content -->
        <tr>
            <td style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; box-sizing: border-box; word-break: break-word; padding: 35px;">
                <h1 style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; box-sizing: border-box; margin-top: 0; color: #2F3133; font-size: 19px; font-weight: bold;" align="left">
                    User '
                    <span style="color: blue;">
                        {{$userData->full_name}} - {{$userData->email}}
                    </span>' change agent
                    <span style="color: blue;"> '{{$agentName}}'</span>
                    wallet, please review below data before and after changes.
                </h1>

                <br><br>

                <h1 style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; box-sizing: border-box; margin-top: 0; color: #2F3133; font-size: 19px; font-weight: bold;" align="left">
                    Old Details</h1>
                <table style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; box-sizing: border-box;">

                    <tr>
                        <th style="width: 40%; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; box-sizing: border-box;">
                            wallet
                        </th>
                        <td style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; box-sizing: border-box; word-break: break-word; padding: 5px;" bgcolor="#eee">

                            <b>{{$oldWallet}}</b>

                        </td>
                    </tr>

                </table>

                <br><br>

                <h1 style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; box-sizing: border-box; margin-top: 0; color: #2F3133; font-size: 19px; font-weight: bold;" align="left">
                    New Details</h1>
                <table style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; box-sizing: border-box;">

                    <tr>
                        <th style="width: 40%; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; box-sizing: border-box;">
                            wallet
                        </th>
                        <td style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; box-sizing: border-box; word-break: break-word; padding: 5px;" bgcolor="#eee">

                            <b>{{$newWallet}}</b>

                        </td>
                    </tr>

                </table>

                <br><br>

                <h1 style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; box-sizing: border-box; margin-top: 0; color: #2F3133; font-size: 19px; font-weight: bold;" align="left">
                    Notes
                </h1>
                {{$notes}}

                <br><br>

                <p style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; box-sizing: border-box; line-height: 1.5em; margin-top: 0; color: #74787E; font-size: 16px;" align="left">
                    Cheers,<br>
                    {{capitalize_string(env('APP_NAME'))}}
                    Team
                </p>
            </td>
        </tr>
    </table>

@endsection
