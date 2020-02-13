@extends('layouts.client.master')

@section('content')
<head>
	<title>Checkout</title>
</head>
<form id="payment-form" action="{{ route('payments.store') }}" method="post">
	<div id="card-element">

	</div>

	<div id="card-errors" role="alert"></div>

	<button id="submitbtn">Pay</button>
</form>

@endsection

@section('scripts')
<script>
	var stripe = Stripe('{{ env("STRIPE_KEY") }}');
	var elements = stripe.elements();

	var style = {
		base: {
			color: "#32325d",
		}
	};

	var card = elements.create("card", { style: style });
	card.mount("#card-element");
	card.addEventListener('change', function(event) {
	  var displayError = document.getElementById('card-errors');
	  if (event.error) {
	    displayError.textContent = event.error.message;
	  } else {
	    displayError.textContent = '';
	  }
	});

	var form = document.getElementById('payment-form');
	form.addEventListener('submit', function(event) {
	  event.preventDefault();

	  stripe.createToken(card).then(function(result) {
	    if (result.error) {
	      // Inform the user if there was an error.
	      var errorElement = document.getElementById('card-errors');
	      errorElement.textContent = result.error.message;
	    } else {
	      // Send the token to your server.
	      stripeTokenHandler(result.token);

	      // form.submit();
	    }
	  });
	});

	function stripeTokenHandler(token) {
	  // Insert the token ID into the form so it gets submitted to the server
	  var form = document.getElementById('payment-form');
	  var hiddenInput = document.createElement('input');
	  hiddenInput.setAttribute('type', 'hidden');
	  hiddenInput.setAttribute('name', 'stripeToken');
	  hiddenInput.setAttribute('value', token.id);
	  form.appendChild(hiddenInput);
		console.log(form)
	  // Submit the form
	  form.submit();
	}

</script>

@endsection
