// stripe.js
$(document).on("modernPaymentInit", function(event, gateway, paymentData) {
    if (gateway !== "stripe") return;

    // Call our unified API to create a Stripe Order (Checkout Session)
    $.ajax({
        url: payment_base_url + 'setup/main/views/plugins/ab-payment-form/api/api.php?action=create_order',
        method: 'POST',
        data: { 
            gateway: 'stripe',
            form_data: paymentData 
        },
        dataType: 'json',
        success: function (response) {
            if (response.status && response.data && response.data.session_id) {
                var stripe = Stripe(response.data.publishable_key);
                stripe.redirectToCheckout({
                    sessionId: response.data.session_id
                }).then(function (result) {
                    if (result.error) {
                        alert(result.error.message);
                    }
                });
            } else {
                alert("Stripe Error: " + (response.msg || "Unable to initiate payment"));
            }
        },
        error: function () {
            alert("Server Error while initiating Stripe payment.");
        }
    });
});
