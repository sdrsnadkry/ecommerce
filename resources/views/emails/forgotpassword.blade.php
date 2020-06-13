<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
</head>
<body>
    <table>
        <tr> <td>Dear {{$name}}!</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td>
                Your new password has been successgully generated on E-Shopper. Please change your password after you login for your own security <br>
                <tr><td>&nbsp;</td></tr>
                <tr><td>Email: {{$email}} </td></tr>
                <tr><td>&nbsp;</td></tr>
                <tr><td>
                    Your New Password:
                    {{$password}}           
                </td></tr>
                <tr><td><span style="color: red">PLEASE CHANGE AS SOON AS POSSIBLE!!!</span></td></tr>

                <tr><td>&nbsp;</td></tr>
                <tr><td>&nbsp;</td></tr>
            </td>
        </tr>       
        <tr><td>Thanks & Regards:</td></tr>
        <tr><td>E-Shopper</td></tr>
    </table>

</body>
</html>