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
                    <div class="form-group">
                        <label>Plan</label>
                        <select class="form-control select2" name="planid" >
                            <option value="0">--Select Plan--</option>
                            <?php 
                                $plans = $this->PlanModel->getAllActivePlans();
                                foreach($plans->result()  as $p){
                                    $selected = $get->planid ==$p->id ? 'selected' : '';
                                    echo '<option value="'.$p->id.'" '.$selected.'>'.$p->plan_name.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="card-footer" id="defaultFooter">
                    <button type="submit" name="action" value="update-website" class="btn btn-sm btn-primary">Submit</button>
                </div>
                <div class="card-footer" id="warningFooter" style="display:none;">
                    <div class="alert alert-warning">
                        <strong>Warning:</strong> Changing the domain may affect:
                        <ul>
                            <li>Website URL</li>
                            <li>Emails</li>
                            <li>SSL</li>
                            <li>DNS</li>
                            <li>Existing addon domain</li>
                        </ul>
                        <p>Proceed?</p>
                        <button type="submit" name="action" value="update-website-only" class="btn btn-sm btn-warning">Update Only</button>
                        <button type="submit" name="action" value="update-website-addon" class="btn btn-sm btn-danger">Update + Create Addon</button>
                        <button type="button" class="btn btn-sm btn-secondary" onclick="resetDomain()">Cancel</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    var originalDomain = "<?php echo $get->domain; ?>";
    
    $('input[name="domain"]').on('input', function() {
        if ($(this).val().trim() !== originalDomain) {
            $('#defaultFooter').hide();
            $('#warningFooter').show();
        } else {
            $('#defaultFooter').show();
            $('#warningFooter').hide();
        }
    });

    function resetDomain() {
        $('input[name="domain"]').val(originalDomain);
        $('#defaultFooter').show();
        $('#warningFooter').hide();
    }
</script>