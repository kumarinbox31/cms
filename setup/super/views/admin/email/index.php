<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between">
                <h4 class="mb-0 text-white">Email Accounts</h4>
                <a href="<?= base_url('admin/email/create') ?>" class="btn btn-sm btn-light text-primary"><i class="fa fa-plus"></i> Add Email</a>
            </div>
            <div class="card-body">
                <?php if ($this->session->flashdata('success_msg')): ?>
                    <div class="alert alert-success"><?= $this->session->flashdata('success_msg') ?></div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('error_msg')): ?>
                    <div class="alert alert-danger"><?= $this->session->flashdata('error_msg') ?></div>
                <?php endif; ?>

                <div class="table-responsive" style="padding: 0 15px;">
                    <table class="table table-bordered table-striped datatable nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Email Address</th>
                                <th>Domain</th>
                                <th>Quota</th>
                                <th>Used Space</th>
                                <th>Status</th>
                                <th>Last Sync</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($emails as $e): ?>
                            <tr>
                                <td><?= $e->email_address ?></td>
                                <td><?= $e->domain ?></td>
                                <td><?= $e->quota == '0' || $e->quota == 'unlimited' ? 'Unlimited' : $e->quota.' MB' ?></td>
                                <td><?= $e->used_space ?></td>
                                <td>
                                    <?php if($e->status == 'Active'): ?>
                                        <span class="badge bg-success">Active</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Suspended</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= date('d-m-Y H:i', strtotime($e->last_sync)) ?></td>
                                <td style="white-space: nowrap;">
                                    <a href="<?= base_url('admin/email/edit?id='.$e->id) ?>" class="btn btn-sm btn-info" title="Edit Password/Quota"><i class="fa fa-edit"></i></a>
                                    <a href="<?= base_url('admin/email/toggle_status?id='.$e->id) ?>" class="btn btn-sm <?= $e->status == 'Active' ? 'btn-warning' : 'btn-success' ?>" title="<?= $e->status == 'Active' ? 'Suspend' : 'Unsuspend' ?>"><i class="fa <?= $e->status == 'Active' ? 'fa-pause' : 'fa-play' ?>"></i></a>
                                    <a onclick="return confirm('Are you sure you want to delete this email? This cannot be undone.');" href="<?= base_url('admin/email/delete?id='.$e->id) ?>" class="btn btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
