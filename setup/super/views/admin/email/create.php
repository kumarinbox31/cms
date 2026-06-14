<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0 text-white">Create Email Account</h4>
            </div>
            <div class="card-body">
                <?php if ($this->session->flashdata('success_msg')): ?>
                    <div class="alert alert-success"><?= $this->session->flashdata('success_msg') ?></div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('error_msg')): ?>
                    <div class="alert alert-danger"><?= $this->session->flashdata('error_msg') ?></div>
                <?php endif; ?>

                <form method="POST" action="<?= base_url('admin/email/create') ?>">
                    <div class="form-group">
                        <label>Select Website</label>
                        <select class="form-control select2" name="website_id" id="websiteSelect" required>
                            <option value="">--Select Website--</option>
                            <?php foreach($websites as $w): ?>
                                <option value="<?= $w->id ?>" data-domain="<?= $w->domain ?>"><?= $w->domain ?> (<?= $w->name ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Email Address</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="email_prefix" placeholder="info" required>
                            <div class="input-group-append">
                                <span class="input-group-text" id="domainSuffix">@domain.com</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="password" id="emailPass" required>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-primary" onclick="generateEmailPass()"><i class="fa fa-refresh"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Storage Quota (MB)</label>
                        <input type="number" class="form-control" name="quota" value="1024" min="0" required>
                        <small class="text-muted">Enter 0 for Unlimited storage.</small>
                    </div>

                    <div class="text-right">
                        <a href="<?= base_url('admin/email') ?>" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-success">Create Email</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('#websiteSelect').change(function() {
        let domain = $(this).find(':selected').data('domain');
        if(domain) {
            $('#domainSuffix').text('@' + domain);
        } else {
            $('#domainSuffix').text('@domain.com');
        }
    });

    function generateEmailPass() {
        const chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*";
        let pass = "";
        for (let i = 0; i < 14; i++) {
            pass += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        $('#emailPass').val(pass);
    }
    generateEmailPass();
</script>
