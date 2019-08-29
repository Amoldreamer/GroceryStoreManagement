var stripe = Stripe('pk_test_MqBTz1Hva2ntWkKloPpJpEJt00pzrQXPW0');

var $form = $('#checkout-form');

$form.submit(function(event){
    $('#charge-error').addClass('hidden');
    $form.find('button').prop('disabled',true);
Stripe.card.createToken({
    number:$('#cc-number').val(),
    cvc: $('#cc-cvc').val(),
    exp_month:$('#cc-expiration_year').val(),
    exp_year:$('#cc-expiration_year').val(),
    name:$('#cc-name').val()
},stripeResponseHandler);
return false;
});

function stripeResponseHandler(status,response){
    if(response.error){
        $('#charge-error').removeClass('hidden');
        $('#charge-error').text(response.error.message);
        $form.find('button').prop('disabled',false);
    }else{
        var token = response.id;
        $form.append($('<input type="hidden" name="stripeToken" />').val(token));
        
        //Submit the form:
        $form.get(0).submit();
    }
}

