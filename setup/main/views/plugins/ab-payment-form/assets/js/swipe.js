// swipe.js
$(document).on("modernPaymentInit", function(event, gateway, paymentData) {
    if (gateway !== "swipe") return;

    $.ajax({
        url: payment_base_url + 'setup/main/views/plugins/ab-payment-form/api/api.php?action=create_order',
        method: 'POST',
        data: { 
            gateway: 'swipe',
            form_data: paymentData 
        },
        dataType: 'json',
        success: function (response) {
            if (response.status && response.data && response.data.payment_url) {
                // Redirect user to Swipe's hosted checkout page
                window.location.href = response.data.payment_url;
            } else {
                alert("Swipe Error: " + (response.msg || "Unable to initiate payment"));
            }
        },
        error: function () {
            alert("Server Error while initiating Swipe payment.");
        }
    });
});
