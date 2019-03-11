
<html>
  <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Teste</title>
        <style type="text/css">
            body {margin: 0; padding: 0; min-width: 100%!important;}
            table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }
        </style>
    </head>
    <body bgcolor="#FFFFFF">
        <table width="100%" bgcolor="#FFFFFF" border="0" cellpadding="0" cellspacing="0">
            <table width="902" height="200" align="center" bgcolor="#FFFFFF" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <a href='{{$linkGer1}}'>
                            <img style="display:block" src='{{ route("images", ["link" => $nameProp1]) }}' width='900' height='200' />
                        </a>
                    </td>
                </tr>
            </table>
            <table width="902" height="123" align="center" bgcolor="#FFFFFF" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <a href='{{$linkGer2}}'>
                            <img style="display:block" src='{{ route("images", ["link" => $nameProp0]) }}' data-here="1" width='900' height='123' />
                        </a>
                    </td>
                </tr>
            </table>
            {!!$video!!}
            <table width="902" height="1501" align="center" bgcolor="#FFFFFF" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <a href='{{$linkGer3}}'>
                            <img style="display:block" src='{{ route("images", ["link" => $nameProp3]) }}' width='900' height='1501' />
                        </a>
                    </td>
                </tr>
            </table>
        </table>
    </body>
</html>
