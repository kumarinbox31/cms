<div class="row">
    <div class="col-md-12">
        <div class="card border-warning">
            <div class="card-header bg-warning text-white d-flex justify-content-between">
                <h4 class="mb-0 text-white"><i class="fa fa-exclamation-triangle"></i> Orphan Addon Domains</h4>
                <a href="<?= base_url('admin/cleanup') ?>" class="btn btn-sm btn-light text-warning">Back</a>
            </div>
            <div class="card-body">
                <?php if ($this->session->flashdata('success_msg')): ?>
                    <div class="alert alert-success"><?= $this->session->flashdata('success_msg') ?></div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('error_msg')): ?>
                    <div class="alert alert-danger"><?= $this->session->flashdata('error_msg') ?></div>
                <?php endif; ?>

                <p>The following addon domains exist in cPanel but do NOT exist in your panel database. They are consuming server resources safely and can be deleted.</p>

                <?php if(empty($orphans)): ?>
                    <div class="alert alert-success">No orphan domains found. cPanel is perfectly synced!</div>
                <?php else: ?>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Orphan Domain</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($orphans as $domain): ?>
                            <tr>
                                <td><strong><?= $domain ?></strong></td>
                                <td>
                                    <a onclick="return confirm('Delete this orphan domain from cPanel?');" href="<?= base_url('admin/cleanup/delete_orphan_domain?domain='.urlencode($domain)) ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete from cPanel</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
