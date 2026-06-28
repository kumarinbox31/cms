<h1>Payment Gateway
    <a href="<?php echo base_url('/admin/plugin/ab-payment-form?page=items'); ?>" class="btn btn-sm btn-info pull-right">Payment Items</a>
</h1>

<!-- razor pay -->
<div class="row">
    <div class="col-md-6">
        <form class="card" method="POST">
            <input type="hidden" name="action" value="add-update">
            <div class="card card-primary">
                <div class="card-header">
                    <h2>Razorpay</h2>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Key Id</label>
                        <input type="text" name="pg-razorpay-val1" class="form-control" value="<?= getVal('pg-razorpay-val1'); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Key Secret</label>
                        <input type="text" name="pg-razorpay-val2" class="form-control" value="<?= getVal('pg-razorpay-val2'); ?>" required>
                    </div>
                    
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
    <!-- payu money -->
    <div class="col-md-6">
        <form class="card" method="POST">
            <input type="hidden" name="action" value="add-update">
            <div class="card card-primary">
                <div class="card-header">
                    <h2>PayUMoney <span class="badge badge-warning">Legacy</span></h2>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Merchant Key</label>
                        <input type="text" name="pg-payumoney-val1" class="form-control" value="<?= getVal('pg-payumoney-val1'); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Salt</label>
                        <input type="text" name="pg-payumoney-val2" class="form-control" value="<?= getVal('pg-payumoney-val2'); ?>" required>
                    </div>
                    
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
    <!-- Stripe -->
    <div class="col-md-6">
        <form class="card modern-gateway-form" method="POST" id="form-stripe">
            <input type="hidden" name="action" value="add-update">
            <div class="card card-primary">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2>Stripe</h2>
                    <?php $stripeEnabled = getVal('pg-stripe-enabled'); ?>
                    <span class="badge badge-<?php echo $stripeEnabled ? 'success' : 'secondary'; ?>" id="status-stripe">
                        <?php echo $stripeEnabled ? 'Connected' : 'Disabled'; ?>
                    </span>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Enable Stripe</label>
                        <select name="pg-stripe-enabled" class="form-control">
                            <option value="">No</option>
                            <option value="1" <?php echo $stripeEnabled == '1' ? 'selected' : ''; ?>>Yes</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Environment</label>
                        <select name="pg-stripe-environment" class="form-control env-selector">
                            <option value="sandbox" <?php echo getVal('pg-stripe-environment') == 'sandbox' ? 'selected' : ''; ?>>Sandbox</option>
                            <option value="production" <?php echo getVal('pg-stripe-environment') == 'production' ? 'selected' : ''; ?>>Production</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Publishable Key</label>
                        <input type="text" name="pg-stripe-public-key" class="form-control" value="<?= getVal('pg-stripe-public-key'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Secret Key</label>
                        <div class="input-group">
                            <input type="password" name="pg-stripe-secret-key" class="form-control secret-input" value="<?= getVal('pg-stripe-secret-key'); ?>">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary toggle-password" type="button"><i class="fa fa-eye"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Webhook Secret</label>
                        <div class="input-group">
                            <input type="password" name="pg-stripe-webhook" class="form-control secret-input" value="<?= getVal('pg-stripe-webhook'); ?>">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary toggle-password" type="button"><i class="fa fa-eye"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Webhook URL (Configure in Stripe Dashboard)</label>
                        <div class="input-group">
                            <input type="text" class="form-control webhook-url" value="<?= base_url('web/plugin/ab-payment-form/api/webhook.php?gateway=stripe'); ?>" readonly>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary copy-webhook" type="button">Copy</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                    <button type="button" class="btn btn-sm btn-secondary test-config-btn" data-gateway="stripe">Test Configuration</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Swipe -->
    <div class="col-md-6">
        <form class="card modern-gateway-form" method="POST" id="form-swipe">
            <input type="hidden" name="action" value="add-update">
            <div class="card card-primary">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2>Swipe</h2>
                    <?php $swipeEnabled = getVal('pg-swipe-enabled'); ?>
                    <span class="badge badge-<?php echo $swipeEnabled ? 'success' : 'secondary'; ?>" id="status-swipe">
                        <?php echo $swipeEnabled ? 'Connected' : 'Disabled'; ?>
                    </span>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Enable Swipe</label>
                        <select name="pg-swipe-enabled" class="form-control">
                            <option value="">No</option>
                            <option value="1" <?php echo $swipeEnabled == '1' ? 'selected' : ''; ?>>Yes</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Environment</label>
                        <select name="pg-swipe-environment" class="form-control env-selector">
                            <option value="sandbox" <?php echo getVal('pg-swipe-environment') == 'sandbox' ? 'selected' : ''; ?>>Sandbox</option>
                            <option value="production" <?php echo getVal('pg-swipe-environment') == 'production' ? 'selected' : ''; ?>>Production</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Merchant ID</label>
                        <input type="text" name="pg-swipe-api-key" class="form-control" value="<?= getVal('pg-swipe-api-key'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Secret Key</label>
                        <div class="input-group">
                            <input type="password" name="pg-swipe-secret" class="form-control secret-input" value="<?= getVal('pg-swipe-secret'); ?>">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary toggle-password" type="button"><i class="fa fa-eye"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Webhook URL (If Applicable)</label>
                        <div class="input-group">
                            <input type="text" class="form-control webhook-url" value="<?= base_url('web/plugin/ab-payment-form/api/webhook.php?gateway=swipe'); ?>" readonly>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary copy-webhook" type="button">Copy</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                    <button type="button" class="btn btn-sm btn-secondary test-config-btn" data-gateway="swipe">Test Configuration</button>
                </div>
            </div>
        </form>
    </div>

    <!-- PayU (Modern) -->
    <div class="col-md-6">
        <form class="card modern-gateway-form" method="POST" id="form-payu">
            <input type="hidden" name="action" value="add-update">
            <div class="card card-primary">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2>PayU <span class="badge badge-info">Modern</span></h2>
                    <?php $payuEnabled = getVal('pg-payu-enabled'); ?>
                    <span class="badge badge-<?php echo $payuEnabled ? 'success' : 'secondary'; ?>" id="status-payu">
                        <?php echo $payuEnabled ? 'Connected' : 'Disabled'; ?>
                    </span>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Enable PayU Modern</label>
                        <select name="pg-payu-enabled" class="form-control">
                            <option value="">No</option>
                            <option value="1" <?php echo $payuEnabled == '1' ? 'selected' : ''; ?>>Yes</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Environment</label>
                        <select name="pg-payu-environment" class="form-control env-selector">
                            <option value="sandbox" <?php echo getVal('pg-payu-environment') == 'sandbox' ? 'selected' : ''; ?>>Sandbox</option>
                            <option value="production" <?php echo getVal('pg-payu-environment') == 'production' ? 'selected' : ''; ?>>Production</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Merchant Key</label>
                        <input type="text" name="pg-payu-key" class="form-control" value="<?= getVal('pg-payu-key'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Merchant Salt</label>
                        <div class="input-group">
                            <input type="password" name="pg-payu-salt" class="form-control secret-input" value="<?= getVal('pg-payu-salt'); ?>">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary toggle-password" type="button"><i class="fa fa-eye"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Webhook URL (Success/Failure Action)</label>
                        <div class="input-group">
                            <input type="text" class="form-control webhook-url" value="<?= base_url('web/plugin/ab-payment-form/api/webhook.php?gateway=payu'); ?>" readonly>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary copy-webhook" type="button">Copy</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                    <button type="button" class="btn btn-sm btn-secondary test-config-btn" data-gateway="payu">Test Configuration</button>
                </div>
            </div>
        </form>
    </div>

    <!-- General Settings -->
    <div class="col-md-6">
        <form class="card" method="POST">
            <input type="hidden" name="action" value="add-update">
            <div class="card card-dark">
                <div class="card-header">
                    <h2>General Payment Settings</h2>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Default Gateway</label>
                        <select name="payment_default_gateway" class="form-control">
                            <option value="pg-razorpay" <?php echo getVal('payment_default_gateway') == 'pg-razorpay' ? 'selected' : ''; ?>>Razorpay</option>
                            <option value="stripe" <?php echo getVal('payment_default_gateway') == 'stripe' ? 'selected' : ''; ?>>Stripe</option>
                            <option value="swipe" <?php echo getVal('payment_default_gateway') == 'swipe' ? 'selected' : ''; ?>>Swipe</option>
                            <option value="payu" <?php echo getVal('payment_default_gateway') == 'payu' ? 'selected' : ''; ?>>PayU (Modern)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Allow Customer to Choose Gateway?</label>
                        <select name="payment_allow_gateway_selection" class="form-control">
                            <option value="No" <?php echo getVal('payment_allow_gateway_selection') == 'No' ? 'selected' : ''; ?>>No</option>
                            <option value="Yes" <?php echo getVal('payment_allow_gateway_selection') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Enable Payment Logging (PaymentLogger)</label>
                        <select name="payment_logging" class="form-control">
                            <option value="Yes" <?php echo getVal('payment_logging') == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" <?php echo getVal('payment_logging') == 'No' ? 'selected' : ''; ?>>No</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-sm btn-primary">Save Settings</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- JS Validation & UX -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Password Toggle
    document.querySelectorAll('.toggle-password').forEach(btn => {
        btn.addEventListener('click', function() {
            let input = this.closest('.input-group').querySelector('.secret-input');
            let icon = this.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });

    // Copy Webhook
    document.querySelectorAll('.copy-webhook').forEach(btn => {
        btn.addEventListener('click', function() {
            let input = this.closest('.input-group').querySelector('.webhook-url');
            input.select();
            document.execCommand("copy");
            let originalText = this.innerText;
            this.innerText = 'Copied!';
            setTimeout(() => { this.innerText = originalText; }, 2000);
        });
    });

    // Client-side Validation on Submit
    document.querySelectorAll('.modern-gateway-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            let selectEnabled = form.querySelector('select[name$="-enabled"]');
            if (selectEnabled && selectEnabled.value === '1') {
                // Check required fields
                let valid = true;
                form.querySelectorAll('input[type="text"], input[type="password"]').forEach(input => {
                    if (input.name.includes('-webhook') && input.name.includes('swipe')) return; // swipe webhook optional
                    if (input.value.trim() === '' && !input.classList.contains('webhook-url')) {
                        valid = false;
                        input.style.borderColor = 'red';
                    } else {
                        input.style.borderColor = '';
                    }
                });
                
                if (!valid) {
                    e.preventDefault();
                    alert("Please fill out all required fields to enable this gateway.");
                }
            }
        });
    });
    
    // Test Config Button (Mock UI)
    document.querySelectorAll('.test-config-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            alert('Test Configuration: Pinging ' + this.dataset.gateway + ' API... (Simulated OK)');
        });
    });
});
</script>