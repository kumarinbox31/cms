<?php
$ci = &get_instance();
if($ci->uri->segment(1) != 'admin'){
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
            <label class="required">Amount</label>
            <input type="number" min="100" name="amount" class="form-control" placeholder="Enter amount" value="" required>
        </div>
        <div class="msg"></div>
        <?php
        $ci = &get_instance();
        // Fetch specific form configuration
        $formRow = $ci->db->where('id', $pgformId)->get('ab_others')->row();
        $allowed = [];
        $default_gw = getVal('payment_default_gateway') ?: 'razorpay';

        if ($formRow) {
            $descData = json_decode($formRow->desc ?? '{}', true);
            if (!empty($descData['allowed_gateways']) && is_array($descData['allowed_gateways'])) {
                $allowed = $descData['allowed_gateways'];
            } else {
                $legacyGw = str_replace('pg-', '', $descData['pg'] ?? 'razorpay');
                if ($legacyGw === 'payumoney') $legacyGw = 'payu';
                $allowed = [$legacyGw];
            }
            if (!empty($descData['default_gateway'])) {
                $default_gw = $descData['default_gateway'];
            }
        }
        if (empty($allowed)) $allowed = ['razorpay'];
        
        $hideSelector = (count($allowed) <= 1 || getVal('payment_allow_gateway_selection') === 'No');
        
        $check = function($gw) use ($allowed, $default_gw) {
            if (count($allowed) === 1 && $allowed[0] === $gw) return 'checked';
            return $default_gw === $gw ? 'checked' : '';
        };
        ?>
        <div class="form-group gateway-selector" style="margin-top: 15px; <?php echo $hideSelector ? 'display:none;' : ''; ?>">
            <label class="required">Select Payment Method</label>
            <div>
                <?php if(in_array('razorpay', $allowed) && !empty(getVal('pg-razorpay-val1'))): ?>
                <label style="margin-right:15px;"><input type="radio" name="gateway" value="razorpay" <?php echo $check('razorpay'); ?>> Razorpay</label>
                <?php endif; ?>
                
                <?php if(in_array('stripe', $allowed) && (getVal('pg-stripe-enabled') == '1' || !empty(getVal('pg-stripe-public-key')))): ?>
                <label style="margin-right:15px;"><input type="radio" name="gateway" value="stripe" <?php echo $check('stripe'); ?>> Stripe</label>
                <?php endif; ?>
                
                <?php if(in_array('swipe', $allowed) && (getVal('pg-swipe-enabled') == '1' || !empty(getVal('pg-swipe-val1')))): ?>
                <label style="margin-right:15px;"><input type="radio" name="gateway" value="swipe" <?php echo $check('swipe'); ?>> Swipe</label>
                <?php endif; ?>
                
                <?php if(in_array('payu', $allowed) && (getVal('pg-payu-enabled') == '1' || !empty(getVal('pg-payumoney-val1')))): ?>
                <label style="margin-right:15px;"><input type="radio" name="gateway" value="payu" <?php echo $check('payu'); ?>> PayU</label>
                <?php endif; ?>
            </div>
        </div>
        <div style="display:flex;flex-wrap:wrap" class="row">
            <div class="payment_form_render" data-form-id="<?php echo htmlspecialchars($pgformId); ?>"></div>
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
}
function ab_pg_form_scripts()
{
    ob_start();
    ?>
    <?php
$payuKey = getVal('pg-payumoney-val1');       // PayU Merchant Key
$payuSalt = getVal('pg-payumoney-val2');      // PayU Salt (keep server-side only)
?>

    <script src="https://formbuilder.online/assets/js/form-render.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>var payment_base_url = "<?php echo base_url(); ?>";</script>
    <?php if(getVal('pg-stripe-enabled') == '1' || !empty(getVal('pg-stripe-public-key')) || !empty(getVal('pg-stripe-val1')) || getVal('pg-swipe-enabled') == '1' || !empty(getVal('pg-swipe-val1')) || getVal('pg-payu-enabled') == '1' || !empty(getVal('pg-payumoney-val1'))): ?>
    <script src="<?php echo base_url(); ?>setup/main/views/plugins/ab-payment-form/assets/js/payment-modern.js"></script>
    <?php endif; ?>
    <?php if(getVal('pg-stripe-enabled') == '1' || !empty(getVal('pg-stripe-public-key')) || !empty(getVal('pg-stripe-val1'))): ?>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="<?php echo base_url(); ?>setup/main/views/plugins/ab-payment-form/assets/js/stripe.js"></script>
    <?php endif; ?>
    <?php if(getVal('pg-swipe-enabled') == '1' || !empty(getVal('pg-swipe-val1'))): ?>
    <script src="<?php echo base_url(); ?>setup/main/views/plugins/ab-payment-form/assets/js/swipe.js"></script>
    <?php endif; ?>
    <?php if(getVal('pg-payu-enabled') == '1' || !empty(getVal('pg-payumoney-val1'))): ?>
    <script src="<?php echo base_url(); ?>setup/main/views/plugins/ab-payment-form/assets/js/payu.js"></script>
    <?php endif; ?>

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
            $(".payment_form_render").each(function () {
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
                
                <?php if(!empty(getVal('pg-razorpay-val1'))){ ?>

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
               <?php  }elseif(!empty($payuKey) && !empty($payuSalt)){ ?>
                // PayU Key from DB
                var payuKey = "<?php echo getVal('pg-payumoney-val1'); ?>";
            
                // Step 1: Create hash from server
                $.ajax({
                    url: "<?php echo base_url(); ?>/web/plugin/ab-payment-form/createPayUHash",
                    method: "POST",
                    data: paymentData,
                    dataType: "json",
                    success: function (res) {
            
                        if (!res.status) {
                            alert("Unable to initiate PayU payment");
                            return;
                        }
            
                        // Step 2: Submit PayU Form
                        var payuForm = `
                            <form method="post" action="https://secure.payu.in/_payment" id="payuForm">
                                <input type="hidden" name="key" value="${payuKey}">
                                <input type="hidden" name="txnid" value="${res.data.txnid}">
                                <input type="hidden" name="amount" value="${res.data.amount}">
                                <input type="hidden" name="productinfo" value="${res.data.productinfo}">
                                <input type="hidden" name="firstname" value="${res.data.firstname}">
                                <input type="hidden" name="email" value="${res.data.email}">
                                <input type="hidden" name="phone" value="${res.data.phone}">
                                <input type="hidden" name="surl" value="${res.data.surl}">
                                <input type="hidden" name="furl" value="${res.data.furl}">
                                <input type="hidden" name="hash" value="${res.data.hash}">
                            </form>
                        `;
            
                        $("body").append(payuForm);
                        $("#payuForm").submit();
                    },
                    error: function () {
                        alert("PayU Server Error");
                    }
                });
               <?php } ?>
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