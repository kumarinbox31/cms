<?php
add_shortcode('ab-payment-form', function ($atts) {
    // Shortcode usage example: [ab-payment-form id=1]
    $pgformId = isset($atts['id']) ? intval($atts['id']) : null;

    if (!$pgformId) {
        return 'Payment: Invalid form ID.';
    }

    // Define the form container
    ob_start();
    ?>
    <form id="payment-form" method="POST" class="ajax-pg-form-submit" enctype="multipart/form-data">
        <input type="hidden" name="form_id" value="<?php echo htmlspecialchars($pgformId); ?>">
        <input type="hidden" name="currency" value="INR">
        <div class="form-group">
            <label>Amount</label>
            <input type="number" min="100" class="form-control" placeholder="Enter amount" value="100" required>
        </div>
        <div class="msg"></div>
        <div style="display:flex;flex-wrap:wrap" class="row">
            <div class="form_render" data-form-id="<?php echo htmlspecialchars($pgformId); ?>"></div>
        </div>
        <!-- <button id="razorpay-button" type="button">Pay with Razorpay</button> -->
    </form>

    <?php
    $html = ob_get_contents();
    ob_end_clean();
    return $html;
});


add_action('ab_footer', 'ab_pg_form_scripts');
add_action('ab_head', 'ab_pg_form_styles');
function ab_pg_form_scripts()
{
    ob_start();
    ?>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <script>
        $(document).ready(function () {
            // Function to convert string representations of booleans to actual booleans
            function convertStringToBoolean(obj) {
                for (const key in obj) {
                    if (typeof obj[key] === "string") {
                        if (obj[key] === "true" || obj[key] === "false") {
                            obj[key] = obj[key] === "true";
                        }
                    } else if (typeof obj[key] === "object") {
                        convertStringToBoolean(obj[key]);
                    }
                }
            }

            // Fetch the form content via AJAX
            $(".form_render").each(function () {
                var formId = $(this).data("form-id");

                $.ajax({
                    url: "<?php echo base_url(); ?>/web/plugin/ab-payment-form/getDetailsApi",
                    type: "GET",
                    data: { id: formId },
                    dataType: "json",
                    success: function (data) {
                        if (data.status) {
                            // Process the fetched content
                            var formContent = data.data.form_content;

                            // Convert and store the content
                            convertStringToBoolean(formContent);
                            $(this).data("content", formContent); // Store content for future use

                            var formRenderOpts = {
                                formData: formContent,
                                dataType: "json",
                                layoutTemplates: {
                                    default: function (field, label, help, data) {
                                        help = $("<div/>")
                                            .addClass("helpme")
                                            .attr("id", "row-" + data.id)
                                            .append(help);
                                        return $("<div/>").append(label, field, help);
                                    }
                                }
                            };
                            $(this).formRender(formRenderOpts);
                        } else {
                            console.error('Error fetching form content:', data.msg);
                        }
                    }.bind(this), // Use .bind(this) to maintain context
                    error: function (xhr, status, error) {
                        console.error("AJAX Error:", status, error);
                    }
                });
            });

            // Razorpay payment button click event
            $("#payment-form").submit(function (event) {
                event.preventDefault(); // Prevent default form submission

                var formData = $("#payment-form").serializeArray();
                var paymentData = {};

                // Convert form data to an object
                formData.forEach(function (item) {
                    paymentData[item.name] = item.value;
                });

                // Get Razorpay credentials
                var razorpayKey = "<?php echo getVal('pg-razorpay-val1'); ?>"; // Replace with your Razorpay key
                var razorpayOrderId = ""; // To be generated from your server

                // Create Razorpay order
                $.ajax({
                    url: '<?php echo base_url(); ?>/web/plugin/ab-payment-form/createOrderApi', // Your endpoint to create an order
                    method: 'POST',
                    data: { form_data: paymentData },
                    dataType: 'json',
                    success: function (response) {
                        if (response.status) {
                            razorpayOrderId = response.data.id; // Assuming your API returns the order ID
                            // Open Razorpay checkout
                            var options = {
                                key: razorpayKey,
                                amount: response.data.amount, // Amount is in currency subunits
                                currency: response.data.currency, // Currency is INR or your currency code
                                name: "Your Company Name", // Replace with your company name
                                description: "Payment for order " + razorpayOrderId,
                                order_id: razorpayOrderId, // The order ID created on Razorpay
                                handler: function (response) {
                                    // Handle successful payment here
                                    $.ajax({
                                        url: '<?php echo base_url(); ?>/web/plugin/ab-payment-form/verifyPaymentApi', // Your endpoint to verify the payment
                                        method: 'POST',
                                        data: {
                                            razorpay_payment_id: response.razorpay_payment_id,
                                            razorpay_order_id: razorpayOrderId,
                                            razorpay_signature: response.razorpay_signature
                                        },
                                        dataType: 'json',
                                        success: function (verificationResponse) {
                                            if (verificationResponse.status) {
                                                var successMessage = `
                                                        <div class="payment-message">
                                                            <h2>Payment Successful!</h2>
                                                            <p>Thank you for your payment. Your transaction has been completed successfully.</p>
                                                            <p>Your order ID: ${razorpayOrderId}</p>
                                                        </div>
                                                    `;
                                                $("#payment-form").replaceWith(successMessage);
                                            } else {
                                                // Handle verification failure
                                                alert("Payment verification failed: " + verificationResponse.msg);
                                            }
                                        },
                                        error: function (xhr, status, error) {
                                            console.error("Error verifying payment:", status, error);
                                        }
                                    });
                                },
                                prefill: {
                                    name: "", // Customer name
                                    email: "", // Customer email
                                    contact: "" // Customer phone number
                                },
                                theme: {
                                    color: "#F37254"
                                }
                            };
                            var razorpayInstance = new Razorpay(options);
                            razorpayInstance.open();
                        } else {
                            alert("Failed to create order. Please try again.");
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("Error creating order:", status, error);
                    }
                });
            });
        });
    </script>

    <?php
    $html = ob_get_contents();
    ob_end_clean();
    echo $html;
}

function ab_pg_form_styles()
{
    echo '
    <style>
    .payment-message {
    padding: 20px;
    margin: 20px 0;
    border: 2px solid #4CAF50; /* Green border */
    background-color: #f9f9f9; /* Light background */
    color: #4CAF50; /* Green text */
    font-size: 20px;
    text-align: center;
    border-radius: 5px;
}

    </style>
    ';
}

?>