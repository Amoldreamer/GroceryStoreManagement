@extends('layouts.customApp')

@section('checkout')
    
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Checkout</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/checkout/">

    <!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="form-validation.css" rel="stylesheet">
  </head>

  <body class="bg-light">

    <div class="container">
      <div class="py-5 text-center">
        <h2>Checkout form</h2>
      </div>

      <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Your cart</span>
            <span class="badge badge-secondary badge-pill" id="no_of_items"></span>
          </h4>
          <ul class="list-group mb-3" id="products">
           
          </ul>
        </div>
        <div class="col-md-8 order-md-1">
          <div id="charge-error" class="alert alert-danger {{!Session::has('error')?
          'hidden':''}}">
          {{Session::get('error')}}
        </div>
          <h4 class="mb-3">Billing address</h4>
          <form class="needs-validation" action="paymentGateway" method="POST" id="checkout-form" >
              @csrf
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName">First name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="" value="" required>
                <div class="invalid-feedback">
                  Valid first name is required.
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastName">Last name</label>
                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="" value="" required>
                <div class="invalid-feedback">
                  Valid last name is required.
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="email">Email </label>
              <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required>
              <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
              </div>
            </div>

            <div class="mb-3">
              <label for="address">Address</label>
              <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" required>
              <div class="invalid-feedback">
                Please enter your shipping address.
              </div>
            </div>

            <div class="mb-3">
              <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
              <input type="text" class="form-control" id="address2" name="address2" placeholder="Apartment or suite">
            </div>

            <div class="row">
              <div class="col-md-5 mb-3">
                <label for="country">Country</label>
                <select class="custom-select d-block w-100" id="country" name="country" required>
                  <option value="">Choose...</option>
                  <option>United States</option>
                </select>
                <div class="invalid-feedback">
                  Please select a valid country.
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="state">State</label>
                <select class="custom-select d-block w-100" id="state" name="state" required>
                  <option value="">Choose...</option>
                  <option>California</option>
                </select>
                <div class="invalid-feedback">
                  Please provide a valid state.
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="zip">Zip</label>
                <input type="text" class="form-control" id="zip" placeholder="" name="zip" required>
                <div class="invalid-feedback">
                  Zip code required.
                </div>
              </div>
            </div>
            
            <hr class="mb-4">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="same-address" name="clicked" onclick="toggle()">
              <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
            </div>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="save-info">
              <label class="custom-control-label" for="save-info">Save this information for next time</label>
            </div>
            
            
            
          
        </div>
      </div>
      <hr class="mb-4">
        <div class="col-md-8 order-md-1" id="shipping-address">
            <h4 class="mb-3">Shipping address</h4>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="firstName">First name</label>
                  <input type="text" class="form-control remove-attr" id="firstName" name="shippingFirstName" placeholder="" value="" required>
                  <div class="invalid-feedback">
                    Valid first name is required.
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="lastName">Last name</label>
                  <input type="text" class="form-control remove-attr" id="lastName" placeholder="" value="" name="shippingLastName" required>
                  <div class="invalid-feedback">
                    Valid last name is required.
                  </div>
                </div>
              </div>
  
              <div class="mb-3">
                <label for="email">Email </label>
                <input type="email" class="form-control remove-attr" id="email" name="shippingEmail" placeholder="you@example.com" required>
                <div class="invalid-feedback">
                  Please enter a valid email address for shipping updates.
                </div>
              </div>
  
              <div class="mb-3">
                <label for="address">Address</label>
                <input type="text" class="form-control remove-attr" id="address" name="shippinAddress" placeholder="1234 Main St" required>
                <div class="invalid-feedback">
                  Please enter your shipping address.
                </div>
              </div>
  
              <div class="mb-3">
                <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                <input type="text" class="form-control" id="address2"  name="shippingAddress2" placeholder="Apartment or suite">
              </div>
  
              <div class="row">
                <div class="col-md-5 mb-3">
                  <label for="country">Country</label>
                  <select class="custom-select d-block w-100 remove-attr" id="country" name="shippingCountry" required>
                    <option value="">Choose...</option>
                    <option>United States</option>
                  </select>
                  <div class="invalid-feedback">
                    Please select a valid country.
                  </div>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="state">State</label>
                  <select class="custom-select d-block w-100 remove-attr" id="state"  name="shippingState" required>
                    <option value="">Choose...</option>
                    <option>California</option>
                  </select>
                  <div class="invalid-feedback">
                    Please provide a valid state.
                  </div>
                </div>
                <div class="col-md-3 mb-3">
                  <label for="zip">Zip</label>
                  <input type="text" class="form-control remove-attr" id="zip" placeholder="" name="shippinZip" required>
                  <div class="invalid-feedback">
                    Zip code required.
                  </div>
                </div>
              </div>
            </div>
              <hr class="mb-4">
              <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="cc-name">Name on card</label>
                    <input type="text" class="form-control" id="cc-name" placeholder="" required>
                    <small class="text-muted">Full name as displayed on card</small>
                    <div class="invalid-feedback">
                      Name on card is required
                    </div>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="cc-number">Credit card number</label>
                    <input type="text" class="form-control" id="cc-number" placeholder="" required>
                    <div class="invalid-feedback">
                      Credit card number is required
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3 mb-3">
                    <label for="cc-expiration">Expiration Month</label>
                    <input type="text" class="form-control" id="cc-expiration_month" placeholder="" required>
                    <div class="invalid-feedback">
                      Expiration date required
                    </div>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="cc-expiration">Expiration Year</label>
                    <input type="text" class="form-control" id="cc-expiration_year" placeholder="" required>
                    <div class="invalid-feedback">
                      Expiration date required
                    </div>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="cc-expiration">CVV</label>
                    <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                    <div class="invalid-feedback">
                      Security code required
                    </div>
                  </div>
                </div>
                <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
        </form>
        
      <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2017-2018 Company Name</p>
        <ul class="list-inline">
          <li class="list-inline-item"><a href="#">Privacy</a></li>
          <li class="list-inline-item"><a href="#">Terms</a></li>
          <li class="list-inline-item"><a href="#">Support</a></li>
        </ul>
      </footer>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="../../assets/js/vendor/holder.min.js"></script> --}}
    <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
    //   (function() {
    //     'use strict';

    //     window.addEventListener('load', function() {
    //       // Fetch all the forms we want to apply custom Bootstrap validation styles to
    //       var forms = document.getElementsByClassName('needs-validation');

    //       // Loop over them and prevent submission
    //       var validation = Array.prototype.filter.call(forms, function(form) {
    //         form.addEventListener('submit', function(event) {
    //           if (form.checkValidity() === false) {
    //             event.preventDefault();
    //             event.stopPropagation();
    //           }
    //           form.classList.add('was-validated');
    //         }, false);
    //       });
    //     }, false);
    //   })();

    window.onload=function Read(){
      
      var items =JSON.parse(localStorage.getItem('names'));
      
      document.getElementById('no_of_items').innerHTML=items.length/5;

      // document.getElementById('product_name').innerHTML=items[1];

      // document.getElementById('brief_description').innerHTML=items[3]+'*'+items[2];

      // document.getElementById('total_cost').innerHTML=items[3]*items[4];

      var products = document.getElementById('products');
      
      
      // if(items != Null){
        for(var i=1;i<=items.length;i=i+4){
          
          
          products.innerHTML+= `
          <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0" id="product_name">${items[i]}</h6>
                <small class="text-muted" id="brief_description">${items[++i]+'*'+items[++i]}</small>
              </div>
              <span class="text-muted" id="total_cost">${items[i]*items[--i]}</span>
            </li>
            
          `
        }
      // }
      var sum=0;
      for(var i=4;i<=items.length;i=i+5){
        sum+=items[i];
      }
        products.innerHTML+=`
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <h6 class="my-0" >Total Cost</h6>
          <span class="text-muted" id="total_cost">${sum}</span>
        </li>
        `
    }
    
    $(function(){
        $('#same-address').on('change',function(){
            $('#shipping-address').slideToggle(!this.checked)
        })
                  
            $("input").removeAttr("required");
            $("select").removeAttr("required");
    })
    </script>
  </body>
</html>

@endsection

@section('script')
<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript" src="{{URL::to('public/js/checkout.js')}}"></script>
@endsection