
<html>
  <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Modelo 1</title>
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
            <table width="902" height="454" align="center" bgcolor="#FFFFFF" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <a href='{{$linkGer3}}'>
                            <img style="display:block" src='{{ route("images", ["link" => $nameProp0]) }}' width='900' height='454' />
                        </a>
                    </td>
                </tr>
            </table>
            <table width="902" height="123" align="center" bgcolor="#FFFFFF" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <a href='{{$linkGer3}}'>
                            <img style="display:block" src='{{ route("images", ["link" => $nameProp2]) }}' width='900' height='123' />
                        </a>
                    </td>
                </tr>
            </table>
            {!!$video!!}
            <table width="902" height="1230" align="center" bgcolor="#FFFFFF" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <a href='{{$linkGer4}}'>
                            <img style="display:block" src='{{ route("images", ["link" => $nameProp4]) }}' width='900' height='1230' />
                        </a>
                    </td>
                </tr>
            </table>
        </table>
    </body>
</html>
