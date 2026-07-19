@extends('layout')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card mt-5">
                    <h3 class="card-header p-3">Laravel 12 Stripe Payment Gateway Integration Example - ItSolutionStuff.com
                    </h3>
                    <div class="card-body">

                        @session('success')
                            <div class="alert alert-success" role="alert">
                                {{ $value }}
                            </div>
                        @endsession

                        <form id='checkout-form' method='post' action="{{ route('stripe.post') }}">
                            @csrf

                            <strong>Name:</strong>
                            <input type="input" class="form-control" name="name" placeholder="Enter Name">

                            <input type='hidden' name='stripeToken' id='stripe-token-id'>
                            <br>
                            <div id="card-element" class="form-control"></div>
                            <button id='pay-btn' class="btn btn-success mt-3" type="button"
                                style="margin-top: 20px; width: 100%;padding: 7px;"
                                onclick="createToken()">@php
                                    $total = 0;
                                @endphp

                                @if (session('cart'))
                                    @foreach (session('cart') as $item)
                                        @php

                                            $total += $item['price'];
                                        @endphp
                                    @endforeach
                                @endif

                                <h5>Total Price: ${{ $total }}</h5>

                            </button>
                            <form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    
<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript">
  
    var stripe = Stripe('{{ env('STRIPE_KEY') }}')
    var elements = stripe.elements();
    var cardElement = elements.create('card');
    cardElement.mount('#card-element');
  
    /*------------------------------------------
    --------------------------------------------
    Create Token Code
    --------------------------------------------
    --------------------------------------------*/
    function createToken() {
        document.getElementById("pay-btn").disabled = true;
        stripe.createToken(cardElement).then(function(result) {
   
            if(typeof result.error != 'undefined') {
                document.getElementById("pay-btn").disabled = false;
                alert(result.error.message);
            }
  
            /* creating token success */
            if(typeof result.token != 'undefined') {
                document.getElementById("stripe-token-id").value = result.token.id;
                document.getElementById('checkout-form').submit();
            }
        });
    }
</script>
@endsection
