// payu.js
$(document).on("modernPaymentInit", function(event, gateway, paymentData) {
    if (gateway !== "payu") return;

    $.ajax({
        url: payment_base_url + 'setup/main/views/plugins/ab-payment-form/api/api.php?action=create_order',
        method: 'POST',
        data: { 
            gateway: 'payu',
            form_data: paymentData 
        },
        dataType: 'json',
        success: function (response) {
            if (response.status && response.data && response.data.hash) {
                // Build a hidden form and submit it to PayU
                var payuForm = `
                    <form method="post" action="${response.data.action_url}" id="modernPayuForm" style="display:none;">
                        <input type="hidden" name="key" value="${response.data.key}">
                        <input type="hidden" name="txnid" value="${response.data.txnid}">
                        <input type="hidden" name="amount" value="${response.data.amount}">
                        <input type="hidden" name="productinfo" value="${response.data.productinfo}">
                        <input type="hidden" name="firstname" value="${response.data.firstname}">
                        <input type="hidden" name="email" value="${response.data.email}">
                        <input type="hidden" name="phone" value="${response.data.phone}">
                        <input type="hidden" name="surl" value="${response.data.surl}">
                        <input type="hidden" name="furl" value="${response.data.furl}">
                        <input type="hidden" name="hash" value="${response.data.hash}">
                        <input type="hidden" name="service_provider" value="payu_paisa">
                    </form>
                `;
                $("body").append(payuForm);
                $("#modernPayuForm").submit();
            } else {
                alert("PayU Error: " + (response.msg || "Unable to initiate payment"));
            }
        },
        error: function () {
            alert("Server Error while initiating PayU payment.");
        }
    });
});
