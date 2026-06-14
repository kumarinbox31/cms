<style>
    .label-required:after{
        content:' *';
        color:red;
    }
</style>
<?php error_reporting(E_ALL);ini_set('display_errors',1);if ($this->session->flashdata('success_msg')): ?>
    <div class="alert alert-success"><?= $this->session->flashdata('success_msg'); ?></div>
<?php endif; ?>

<?php if ($this->session->flashdata('error_msg')): ?>
    <div class="alert alert-danger"><?= $this->session->flashdata('error_msg'); ?></div>
<?php endif; ?>

<?= validation_errors('<div class="alert alert-danger">', '</div>'); ?>

<form method="POST" action="<?php echo base_url('admin/create-website');?>" class="validate" novalidate>
    <div class="card">
        <div class="card-header bg-warning text-white" style="display:block;">
            Create Website
            <button type="submit" class="btn btn-sm btn-success pull-right" style="float:right;">Submit</button>
        </div>
        <div class="card-body row">
            
            <div class="col-sm-12">
                <div class="input-group input-group-primary">
                    <span class="input-group-prepend"><label class="input-group-text"><i class="fa fa-user"></i></label></span>
                    <input type="text" class="form-control" name="name" placeholder="Enter name" required value="<?= set_value('name') ?>">
                    <!--<div class="invalid-feedback">Please enter a valid email address.</div>-->
                </div>
            </div>
            
            <div class="col-sm-6">
                <div class="input-group input-group-info">
                    <span class="input-group-prepend"><label class="input-group-text"><i class="fa fa-envelope"></i></label></span>
                    <input type="text" class="form-control" name="email" placeholder="Enter email"  required value="<?= set_value('email') ?>">
                </div>
            </div>
            
            <div class="col-sm-6">
                <div class="input-group input-group-warning">
                    <span class="input-group-prepend"><label class="input-group-text"><i class="fa fa-phone"></i></label></span>
                    <input type="text" class="form-control" name="mobile" placeholder="Enter mobile"  required value="<?= set_value('mobile') ?>">
                </div>
            </div>
            
            <div class="col-sm-12">
                <div class="input-group input-group-success">
                    <span class="input-group-prepend"><label class="input-group-text"><i class="fa fa-location"></i></label></span>
                    <input type="text" class="form-control" name="address" placeholder="Enter address"  value="<?= set_value('address') ?>">
                </div>
            </div>
            
            <div class="col-sm-6">
                <div class="input-group input-group-danger">
                    <span class="input-group-prepend"><label class="input-group-text"><i class="fa fa-key"></i></label></span>
                    <input type="text" class="form-control" name="password" placeholder="Enter password"  required value="<?= set_value('password') ?>">
                    <a onclick="generatePass()" class="btn btn-sm btn-primary"><i class="fa fa-refresh"></i></a>
                </div>
            </div>
            
            <div class="col-sm-6">
                <div class="input-group input-group-primary">
                    <span class="input-group-prepend"><label class="input-group-text"><i class="fa fa-globe"></i></label></span>
                    <input type="text" class="form-control" name="domain" id="domain" placeholder="Enter domain" required value="<?= set_value('domain') ?>">
                    <button type="button" class="btn btn-info" id="checkDomainBtn">Check</button>
                </div>
            </div>
            
            <div class="col-sm-12" id="preflightResults" style="display:none; margin-top:10px;">
                <div class="alert alert-secondary">
                    <h5>Domain Pre-Check Results</h5>
                    <ul class="list-unstyled mb-0">
                        <li id="resPanel"><i class="fa fa-spinner fa-spin"></i> Checking Panel Database...</li>
                        <li id="resCpanel"><i class="fa fa-spinner fa-spin"></i> Checking cPanel...</li>
                        <li id="resDns"><i class="fa fa-spinner fa-spin"></i> Checking DNS...</li>
                    </ul>
                    <button type="submit" class="btn btn-success mt-2" id="continueBtn" style="display:none;">Confirm & Continue Creation</button>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label class="label-required">Plan</label>
                    <select class="form-control select2" name="planid" required>
                        <option value="">--Select Plan--</option>
                        <?php 
                            $get = $this->PlanModel->getAllActivePlans();
                            foreach($get->result()  as $row){
                                $selected = set_select('planid', $row->id);
                                echo '<option value="'.$row->id.'" '.$selected.'>'.$row->plan_name.'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="label-required">Plan Duration (Years)</label>
                    <select class="form-control select2" name="plan_years" required>
                        <option value="">--Select Duration--</option>
                        <?php 
                            for($i = 1; $i <= 10; $i++) {
                                $selected = set_select('plan_years', $i);
                                echo '<option value="'.$i.'" '.$selected.'>'.$i.' Year'.($i > 1 ? 's' : '').'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>

            
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Copy Website</label>
                    <select class="form-control select2" name="wid" id="loadIFrame">
                        <option value="0">--Select--</option>
                        <?php 
                            $get = $this->website->get(['status'=>1]);
                            foreach($get->result()  as $row){
                                $selected = set_select('wid', $row->id);
                                echo '<option value="'.$row->id.'" '.$selected.'>'.$row->domain.'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
            <hr>
            <div class="col-md-12">
                <h4>Payment Details</h4>
            </div>
            <div class="col-sm-12" id="showIframe">
                
            </div>
            
        </div>
    </div>
</form>
<script>
  $(document).ready(function() {
    $('#loadIFrame').change(function(){
      var domain = $(this).find('option:selected').text();
      var iframe = "<iframe src='https://"+domain+"/' style='width:100%;height:300px;'></iframe>";
      $('#showIframe').html(iframe);
    });
  });
  
  
  
  function generatePassword(length, options) {
    const uppercase = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    const lowercase = "abcdefghijklmnopqrstuvwxyz";
    const numbers = "0123456789";
    const specialChars = "!@#$%^&*()_+[]{}|;:,.<>?";

    let allChars = "";
    if (options.includeUppercase) allChars += uppercase;
    if (options.includeLowercase) allChars += lowercase;
    if (options.includeNumbers) allChars += numbers;
    if (options.includeSpecialChars) allChars += specialChars;

    if (allChars === "") {
        throw new Error("At least one character type should be included.");
    }

    let password = "";
    for (let i = 0; i < length; i++) {
        const randomIndex = Math.floor(Math.random() * allChars.length);
        password += allChars[randomIndex];
    }

    return password;
}

function generatePass(){
    const options = {
        includeUppercase: true,
        includeLowercase: true,
        includeNumbers: true,
        includeSpecialChars: true
    };
    const passwordLength = 12;
    const newPassword = generatePassword(passwordLength, options);
    $('input[name="password"]').val(newPassword);
}
generatePass();

$('#checkDomainBtn').click(function() {
    let domain = $('#domain').val();
    if(!domain) { alert('Please enter domain first'); return; }
    
    $('#preflightResults').show();
    $('#resPanel, #resCpanel, #resDns').html('<i class="fa fa-spinner fa-spin"></i> Checking...');
    $('#continueBtn').hide();
    $('.card-header button[type="submit"]').hide(); // hide the top submit button

    $.post('<?= base_url("admin/check_domain_preflight") ?>', {domain: domain}, function(res) {
        let result = JSON.parse(res);
        if(!result.status) {
            alert(result.message);
            return;
        }
        
        let data = result.data;
        let panelHtml = data.inPanel ? '<span class="text-danger"><i class="fa fa-times"></i> Domain exists in Panel</span>' : '<span class="text-success"><i class="fa fa-check"></i> Domain Available in Panel</span>';
        $('#resPanel').html(panelHtml);
        
        let cpanelHtml = data.inCpanel ? '<span class="text-danger"><i class="fa fa-times"></i> Domain/Addon already exists in cPanel</span>' : '<span class="text-success"><i class="fa fa-check"></i> Not in cPanel (Available)</span>';
        $('#resCpanel').html(cpanelHtml);
        
        let dnsHtml = data.dnsConnected ? '<span class="text-success"><i class="fa fa-check"></i> DNS Connected</span>' : '<span class="text-warning"><i class="fa fa-exclamation-triangle"></i> DNS Not Connected/Propagated</span>';
        $('#resDns').html(dnsHtml);
        
        $('#continueBtn').show();
    });
});

$('#continueBtn').click(function(e) {
    e.preventDefault();
    $(this).closest('form').submit();
});
</script>