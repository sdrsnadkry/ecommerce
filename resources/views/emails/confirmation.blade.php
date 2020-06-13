<!DOCTYPE html>
<html>
<head>
    <title>Register Email</title>
</head>
<body>
    <table>
        <tr> <td>Dear {{$name}}!</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td>
               You need to Activate your account to use E-shopper. Please click a link below to activate your account <br>
                Your Account Information:
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Email: {{$email}}</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Activation link:</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td><a href="{{url('/confirm/'.$code)}}">Click Here</a></td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Thanks & Regards:</td></tr>
        <tr><td>E-Shopper</td></tr>
    </table>

</body>
</html>