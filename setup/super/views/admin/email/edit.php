<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h4 class="mb-0 text-white">Manage Email: <?= $email->email_address ?></h4>
            </div>
            <div class="card-body">
                <?php if ($this->session->flashdata('success_msg')): ?>
                    <div class="alert alert-success"><?= $this->session->flashdata('success_msg') ?></div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('error_msg')): ?>
                    <div class="alert alert-danger"><?= $this->session->flashdata('error_msg') ?></div>
                <?php endif; ?>

                <!-- Change Password Form -->
                <form method="POST" action="<?= base_url('admin/email/edit?id='.$email->id) ?>" class="mb-4">
                    <input type="hidden" name="action" value="change_password">
                    <h5>Change Password</h5>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" name="password" id="emailPass" placeholder="New Password" required>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-primary" onclick="generateEmailPass()"><i class="fa fa-refresh"></i></button>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm btn-info">Update Password</button>
                </form>

                <hr>

                <!-- Change Quota Form -->
                <form method="POST" action="<?= base_url('admin/email/edit?id='.$email->id) ?>">
                    <input type="hidden" name="action" value="change_quota">
                    <h5>Change Quota</h5>
                    <div class="form-group">
                        <label>Storage Quota (MB)</label>
                        <input type="number" class="form-control" name="quota" value="<?= $email->quota == 'unlimited' ? 0 : $email->quota ?>" min="0" required>
                        <small class="text-muted">Enter 0 for Unlimited storage.</small>
                    </div>
                    <button type="submit" class="btn btn-sm btn-info">Update Quota</button>
                </form>

                <hr>
                <div class="text-right">
                    <a href="<?= base_url('admin/email') ?>" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function generateEmailPass() {
        const chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*";
        let pass = "";
        for (let i = 0; i < 14; i++) {
            pass += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        $('#emailPass').val(pass);
    }
</script>
