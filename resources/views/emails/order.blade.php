<!DOCTYPE html>
<html>

<head>
    <title>Ordered Confirmed</title>
</head>

<body>
    <table>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td><img src="{{asset('images/frontend_images/home/logo.png')}}"></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Dear {{$name}}!</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>
                Thankyou for shopping with E-Shopper
                Your order has been successgully placed on E-Shopper. <br>
                Your Order Information:
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Order Number: {{$order_id}}</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>
                <table style="background:#f7f4f4" width="95%" cellpadding="5" colspacing="5">
                    <tr bgcolor="#ccc">
                        <td>Product Name</td>
                        <td>Product Code</td>
                        <td>Size</td>
                        <td>color</td>
                        <td>Quantity</td>
                        <td>Unit Price</td>
                    </tr>
                    @foreach ($productDetails['orders'] as $product)
                    <tr>
                        <td>{{$product['product_name']}}</td>
                        <td>{{$product['product_code']}}</td>
                        <td>{{$product['product_size']}}</td>
                        <td>{{$product['product_color']}}</td>
                        <td>{{$product['product_qty']}}</td>
                        <td>${{$product['product_price']}}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="5" aligh="right"> Shipping Charges: ${{$productDetails['shipping_charge']}}</td>
                    </tr>
                    <tr>
                        <td colspan="5" aligh="right"> Payment Method: {{$productDetails['payment_method']}}</td>
                    </tr>
                    <tr>
                        <td colspan="5" aligh="right"> Grand Total: ${{$productDetails['grand_total']}}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%">
                    <tr>
                        <td width="50%">
                            <table>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><strong>Billing Address:</strong></td>
                                </tr>
                                <tr>
                                    <td>{{$userDetails['name']}}</td>
                                </tr>
                                <tr>
                                    <td>{{$userDetails['address']}}</td>
                                </tr>
                                <tr>
                                    <td>{{$userDetails['city']}}</td>
                                </tr>
                                <tr>
                                    <td>{{$userDetails['state']}}</td>
                                </tr>
                                <tr>
                                    <td>{{$userDetails['pincode']}}</td>
                                </tr>
                                <tr>
                                    <td>{{$userDetails['mobile']}}</td>
                                </tr>
                            </table>
                        </td>
                        <td width="50%">
                            <table>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><strong>Shipping Address:</strong></td>
                                </tr>
                                <tr>
                                    <td> {{$productDetails['name']}}</td>
                                </tr>
                                <tr>
                                    <td>{{$productDetails['address']}}</td>
                                </tr>
                                <tr>
                                    <td>{{$productDetails['city']}}</td>
                                </tr>
                                <tr>
                                    <td>{{$productDetails['state']}}</td>
                                </tr>
                                <tr>
                                    <td>{{$productDetails['pincode']}}</td>
                                </tr>
                                <tr>
                                    <td>{{$productDetails['mobile']}}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>Thankyou for shopping with us. <a href="http://adhikarisudarshan.com.np"></a></td>
        </tr>
        <tr>
            <td>Thanks & Regards:</td>
        </tr>
        <tr>
            <td>E-Shopper</td>
        </tr>
    </table>
</body>

</html>