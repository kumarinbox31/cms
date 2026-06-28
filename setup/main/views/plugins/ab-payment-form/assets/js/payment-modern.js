// payment-modern.js
$(document).ready(function() {
    // We bind a handler on document capture phase or standard delegation
    // Using simple event handling. Since Razorpay binds in $(document).ready,
    // and this file is loaded before the Razorpay script block, our ready block
    // executes before the Razorpay ready block. 
    // Thus, our submit handler runs first!
    
    $("#payment-form").on("submit", function(event) {
        var selectedGateway = $("input[name='gateway']:checked").val() || "razorpay";
        
        if (selectedGateway === "razorpay") {
            // Let the original legacy script handle it
            return;
        }

        // It's a modern gateway, prevent the legacy handler from running
        event.preventDefault();
        event.stopImmediatePropagation();

        var formDataArray = $(this).serializeArray();
        var paymentData = {};
        formDataArray.forEach(function (item) {
            paymentData[item.name] = item.value;
        });

        // Fire a custom event that specific gateway scripts (like stripe.js) can listen to
        $(document).trigger("modernPaymentInit", [selectedGateway, paymentData]);
    });
});
