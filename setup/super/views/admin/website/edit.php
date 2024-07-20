<?php 
$get = $this->website->get(['id'=>@$_GET['id'],'rid'=>RID])->row();
?>
<div class="row">
    <div class="col-md-12">
        <?php 
            if($msg = $this->session->flashdata('success_msg')){
                echo '<div class="alert alert-success">'.$msg.'</div>';
            }
            if($msg = $this->session->flashdata('error_msg')){
                echo '<div class="alert alert-danger">'.$msg.'</div>';
            }
        ?>
        <form method="POST" action="">
            <div class="card">
                <div class="card-header bg-warning text-white">Edit Website</div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" required value="<?php echo $get->name; ?>">
                    </div>
                    <div class="form-group">
                        <label>Domain</label>
                        <input type="text" name="domain" class="form-control" required value="<?php echo $get->domain; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="_email" class="form-control" required value="<?php echo $get->_email; ?>">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="text" name="_pass" class="form-control" required value="<?php echo $get->_pass; ?>">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" name="action" value="update-website" class="btn btn-sm btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>