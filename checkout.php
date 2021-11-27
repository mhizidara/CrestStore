<?php
session_start();
if (isset($_POST["checkout-btn"])) {
    $order_number = rand(100, 999);
}
?>
<HTML>
<HEAD>
<TITLE>Creststore Checkout Script </TITLE>
<link href="./assets/css/creststore-style.css" type="text/css"
    rel="stylesheet" />
<link href="./assets/css/checkout-page.css" type="text/css"
    rel="stylesheet" />
<script src="./vendor/jquery/jquery.min.js" type="text/javascript"></script>
<script src="./vendor/jquery/jquery-ui.js"></script>
</HEAD>
<BODY>
    <div class="creststore-container">
        <div class="page-heading">Creststore Checkout Script</div>

        <form name="checkout-form" id="checkout-form"
            action="" method="post" onsubmit="return checkout()">
			
<?php if(!empty($order_number)){?>

			<div class="order-message order-success">
			You order number is <?php echo $order_number;?>.
		<span class="btn-message-close"
                    onclick="this.parentElement.style.display='none';"
                    title="Close">×</span>

            </div>
<?php }?>


			<div class="section product-gallery">
        			<?php require_once './view/product-gallery.php'; ?>
      		 </div>
            <div class="billing-details">
		            <?php require_once './view/billing-details.php'; ?>
			</div>

            <div class="cart-error-message" id="cart-error-message">Cart
                must not be empty to checkout</div>
            <div id="shopping-cart" tabindex="1">
                <div id="tbl-cart">
                    <div id="txt-heading">
                        <div id="cart-heading">Your Shopping Cart</div>
                        <div id="close"></div>
                    </div>
                    <div id="cart-item">
        				<?php require_once './view/shopping-cart.php'; ?>
           			 </div>
                </div>
            </div>

            <div class="payment-details">
                <div class="payment-details-heading">Payment details</div>
                <div class="row">
                    <div class="inline-block">
                        <div>
                            <input class="bank-transfer" type="radio"
                                checked="checked"
                                value="Direct bank transfer"
                                name="direct-bank-transfer">Direct bank
                            transfer
                        </div>

                        <div class="info-label">Specify your order
                            number when you make the bank transfer. Your
                            order will be shippied after the amount is
                            credited to us.</div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div id="inline-block">
                    <input type="submit" class="checkout"
                        name="checkout-btn" id="checkout-btn"
                        value="Checkout">
                </div>
            </div>
        </form>
    </div>	
    <script src="./assets/js/cart.js"></script>
    <script>




</script>
</BODY>
</HTML>