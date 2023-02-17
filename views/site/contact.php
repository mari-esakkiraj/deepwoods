<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ContactForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\captcha\Captcha;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

        <div class="alert alert-success">
            Thank you for contacting us. We will respond to you as soon as possible.
        </div>

        <p>
            Note that if you turn on the Yii debugger, you should be able
            to view the mail message on the mail panel of the debugger.
            <?php if (Yii::$app->mailer->useFileTransport): ?>
                Because the application is in development mode, the email is not sent but saved as
                a file under <code><?= Yii::getAlias(Yii::$app->mailer->fileTransportPath) ?></code>.
                Please configure the <code>useFileTransport</code> property of the <code>mail</code>
                application component to be false to enable email sending.
            <?php endif; ?>
        </p>

    <?php else: ?>

        <p>
            If you have business inquiries or other questions, please fill out the following form to contact us.
            Thank you.
        </p>

        <div class="row">
        <!DOCTYPE html>
<html>
<head>
	<title>Shopping Cart</title>
	<!-- Include Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<h1 class="text-center my-4">Shopping Cart</h1>
		<table class="table">
			<thead>
				<tr>
					<th>Product Name</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Total</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Product 1</td>
					<td>$10.00</td>
					<td>
						<div class="form-group">
							<input id="product1-quantity" type="number" class="form-control" value="1" min="1" onchange="updateTotal('product1')">
						</div>
					</td>
					<td id="product1-total">$10.00</td>
					<td><button class="btn btn-danger" onclick="removeProduct('product1')">Remove</button></td>
				</tr>
				<tr>
					<td>Product 2</td>
					<td>$15.00</td>
					<td>
						<div class="form-group">
							<input id="product2-quantity" type="number" class="form-control" value="1" min="1" onchange="updateTotal('product2')">
						</div>
					</td>
					<td id="product2-total">$15.00</td>
					<td><button class="btn btn-danger" onclick="removeProduct('product2')">Remove</button></td>
				</tr>
				<tr>
					<td>Product 3</td>
					<td>$20.00</td>
					<td>
						<div class="form-group">
							<input id="product3-quantity" type="number" class="form-control" value="1" min="1" onchange="updateTotal('product3')">
						</div>
					</td>
					<td id="product3-total">$20.00</td>
					<td><button class="btn btn-danger" onclick="removeProduct('product3')">Remove</button></td>
				</tr>
			</tbody>
		</table>
		<div class="text-right my-4">
			<h4>Subtotal: <span id="subtotal">$45.00</span></h4>
			<button class="btn btn-primary btn-lg">Checkout</button>
		</div>
	</div>

	<!-- Include Bootstrap JS -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

	<script>
		// Function to update the total cost of a product based on the quantity
		function updateTotal(product) {
			// Get the quantity input element and the total element for the given product
			var quantityInput = document.getElementById(product + "-quantity");
			var totalElement = document.getElementById(product + "-total");

			// Calculate the total cost for the product based on the price and quantity
			var price = parseFloat(totalElement.innerHTML.slice(1));
			var quantity = parseFloat(quantityInput.value);
			var total = "$" + (price * quantity).toFixed(2);

			// Update

        </div>

    <?php endif; ?>
</div>
