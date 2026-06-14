<div class="row">
    <div class="col-md-12">
        <?php if ($this->session->flashdata('success_msg')): ?>
            <div class="alert alert-success"><?= $this->session->flashdata('success_msg') ?></div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error_msg')): ?>
            <div class="alert alert-danger"><?= $this->session->flashdata('error_msg') ?></div>
        <?php endif; ?>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0 text-white"><i class="fa fa-refresh"></i> Sync Center</h4>
            </div>
            <div class="card-body">
                <p>Manually trigger synchronization across all websites to update statuses and fetch latest email quotas.</p>
                <a href="<?= base_url('admin/cleanup/sync_all_domains') ?>" class="btn btn-block btn-outline-success">Sync All Domains (DNS & Addon Status)</a>
                <a href="<?= base_url('admin/cleanup/sync_all_emails') ?>" class="btn btn-block btn-outline-info mt-2">Sync All Email Accounts</a>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card border-warning">
            <div class="card-header bg-warning text-white">
                <h4 class="mb-0 text-white"><i class="fa fa-trash"></i> Cleanup Center</h4>
            </div>
            <div class="card-body">
                <p>Find orphan records in cPanel that are not linked to any website in the panel.</p>
                <a href="<?= base_url('admin/cleanup/find_orphan_domains') ?>" class="btn btn-block btn-outline-warning">Find Orphan Addon Domains</a>
            </div>
        </div>
    </div>
</div>
