<html>
<body onload="document.frm1.submit()" style="display: none;">
   <form action="/payments/checkout" name="frm1" method="post">
        <?php $paymentData =  Session::get('payData');?>
        @foreach($paymentData as $key=>$value)
            <input type="hidden" name="{{$key}}" value="{{$value}}" />
        @endforeach
   </form>
</body>
</html>