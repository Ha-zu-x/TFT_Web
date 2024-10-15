
<!-- <div style=" position: fixed; top: 30px; right:80px; z-index: 999;" class="visible-xs">
	<a href="#" data-toggle="modal" data-target="#cart" class="icon-cart">
	<img src="/images/cart-icon.png" alt="cart" /><span class="badge total-count" style=""></span>
	</a>
</div> -->

<div class="sidebar" id="mySidebar">
	<a class="closebtn" href="javascript:void(0)" onclick="closeNav()">×</a>	
	<div class="show-cart"></div>
	<div><b >Tổng cộng: </b><span class="total-cart"></span></div>
	<button style="margin-top: 16px" type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#cart" >Đặt Ngay</button>
</div>

<div class="modal fade" id="cart" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="text-align: initial;">
		<form id="form-cart-submit">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<p class="modal-title"><b><?php echo 'Giỏ hàng'; ?></b></p>
			</div>
			<div class="modal-body">
				<div class="show-cart"></div>
				<div id="info">
					<p><b style="margin-right: 5px;">Tổng cộng:</b><span class="total-cart" style= "color: red;"></span></p>			
					<hr>
					<p>Tỉ giá chuyển đổi USD: <span class="crc-rate" style= "color: red;"></span></p>
					<p>Tổng tiền sau chuyển đổi: <span class="crc-converted" style= "color: red;"></span></p>
				</div>
			</div>
			<!-- Insert paypal button -->
			<div id="paypal-button-container"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
			</div>
		</form>	  
    </div>
  </div>
</div>

<!-- Paypal script -->
<script>

	paypal.Buttons({
    style: {
    shape: 'rect',
    color: 'blue',
    layout: 'vertical',
    label: 'paypal',
    
  },
  // Set up the transaction
  createOrder: function(data, actions) {
	  console.log(shoppingCart.totalCart());
      return actions.order.create({
              "purchase_units": [{
              "amount": {
                "value": `${(shoppingCart.totalCart()*crcRate).toFixed(2)}`,
              },
          }]
      });
  },

  // Finalize the transaction
  onApprove: function(data, actions) {
      return actions.order.capture().then(function(orderData) {
          // Successful capture! For demo purposes:
          var transaction = orderData.purchase_units[0].payments.captures[0];
          alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details' + '\n\nThank you for your purchase');

          // Replace the above to show a success message within this page, e.g.
          // const element = document.getElementById('paypal-button-container');
          // element.innerHTML = '';
          // element.innerHTML = '<h3>Thank you for your payment!</h3>';
          // Or go to another URL:  actions.redirect('thank_you.html');
      });
  }


}).render('#paypal-button-container');
</script>
<style>
		#paypal-button-container{
			max-width: 100%;
			text-align: center;
		
		}
		.paypal-buttons{
			max-width: 80% !important;
		}
	
</style>