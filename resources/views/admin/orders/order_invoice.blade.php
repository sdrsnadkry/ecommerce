<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<style>
    .invoice-title h2, .invoice-title h3 {
    display: inline-block;
}

.table > tbody > tr > .no-line {
    border-top: none;
}

.table > thead > tr > .no-line {
    border-bottom: none;
}

.table > tbody > tr > .thick-line {
    border-top: 2px solid;
}
</style>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">
        <div class="col-xs-12">
    		<div class="invoice-title">
                <div class="text-center">
                    <div>

                        <img src="{{asset('/images/frontend_images/home/logo.png')}}" alt="">
                    </div>

                   
                    <p><strong>Koteshwor,Kathmandu,Nepal</strong> </p>
                </div>
                <h2 >Invoice</h2>
                <h3 class="pull-right">Order # {{$orderDetails->id}}</h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>Billed To:</strong><br>
                    {{$userDetails->name}}<br>
                    {{$userDetails->email}}<br>
                    {{$userDetails->mobile}}<br>
                    {{$userDetails->city}}<br>
                    {{$userDetails->state}}<br>
                    {{$userDetails->pincode}}<br>
                    {{$userDetails->address}}<br>
    					
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
        			<strong>Shipped To:</strong><br>
    					{{$orderDetails->name}}<br>
    					{{$orderDetails->mobile}}<br>
    					{{$orderDetails->city}}<br>
    					{{$orderDetails->state}}<br>
    					{{$orderDetails->pincode}}<br>
    					{{$orderDetails->address}}<br>
    				</address>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    					<strong>Payment Method:</strong><br>
    					{{$orderDetails->payment_method}}<br>
    					{{$userDetails->email}}
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
    					<strong>Order Date:</strong><br>
    					{{$orderDetails->created_at}}<br><br><br>
    				</address>
    			</div>
    		</div>
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Order summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<td><strong>Product</strong></td>	
        							<td class="text-center"><strong>Size</strong></td>
        							<td class="text-center"><strong>Color</strong></td>
        							<td class="text-center"><strong>Price</strong></td>
        							<td class="text-center"><strong>Quantity</strong></td>
        							<td class="text-right"><strong>Totals</strong></td>
                                </tr>
    						</thead>
    						<tbody>
								<!-- foreach ($order->lineItems as $line) or some such thing here -->
								@php
									$total_amount = 0;
								@endphp
                                @foreach ($orderDetails->orders as $order)
									<tr>
										<td>{{$order->product_name}}</td>
										<td class="text-center">{{$order->product_size}}</td>
										<td class="text-center">{{$order->product_color}}</td>
										<td class="text-center">${{$order->product_price}}</td>
										<td class="text-center">{{$order->product_qty}} PCS</td>
										
										
										<td class="text-right">${{$order->product_qty*$order->product_price}}</td>
									</tr>
								@php
								$total_amount = $total_amount + $order->product_qty*$order->product_price ;
								@endphp
                                @endforeach
    							
                                <tr>
        						
    							<tr>
    								
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line text-center"><strong>Subtotal</strong></td>
    								<td class="thick-line text-right">${{$total_amount}}</td>
    							</tr>
    							<tr>
    							
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Shipping</strong></td>
    								<td class="no-line text-right">$ 0</td>
    							</tr>
    							<tr>
    						
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Total</strong></td>
    								<td class="no-line text-right"><strong>${{$orderDetails->grand_total}}</strong> </td>
    							</tr>
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>