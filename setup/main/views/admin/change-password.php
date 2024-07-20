<form method="POST" action="">
    <div class="card">
        <div class="card-header bg-info text-white">Change Password</div>
        <div class="card-body">
            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger">
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success">
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
            <?php endif; ?>

            <div class="form-group">
                <label>Old Password</label>
                <input type="password" class="form-control" name="old_pass" required>
                <?php echo form_error('old_pass', '<div class="text-danger">', '</div>'); ?>
            </div>
            <div class="form-group">
                <label>New Password</label>
                <input type="password" class="form-control" name="new_pass" required>
                <?php echo form_error('new_pass', '<div class="text-danger">', '</div>'); ?>
            </div>
            <div class="form-group">
                <label>Confirm New Password</label>
                <input type="password" class="form-control" name="new_confirm_pass" required>
                <?php echo form_error('new_confirm_pass', '<div class="text-danger">', '</div>'); ?>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
        </div>
    </div>
</form>
