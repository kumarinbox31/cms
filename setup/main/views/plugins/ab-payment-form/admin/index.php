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
                    <h2>PayUMoney</h2>
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
    <!-- CC-Avenue  -->
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h2> CC-Avenue </h2>
            </div>
            <div class="card-body">

                CC-Avenue Comming soon...
            </div>
        </div>
    </div>
</div>