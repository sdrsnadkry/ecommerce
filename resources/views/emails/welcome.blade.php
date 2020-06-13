<!DOCTYPE html>
<html>
<head>
    <title>Welcome Email</title>
</head>
<body>
    <table>
        <tr> <td>Dear {{$name}}!</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td>
                Welcome to E-Shopper.
                Your account has been successgully activated on E-Shopper. <br>
                Your Account Information:
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Email: {{$email}}</td></tr>
        <tr><td>&nbsp;</td></tr>
        
        <tr><td>&nbsp;</td></tr>
        <tr><td>Thanks & Regards:</td></tr>
        <tr><td>E-Shopper</td></tr>
    </table>

</body>
</html>