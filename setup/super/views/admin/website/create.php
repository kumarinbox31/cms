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
                    <input type="text" class="form-control" name="name" placeholder="Enter name" required>
                    <!--<div class="invalid-feedback">Please enter a valid email address.</div>-->
                </div>
            </div>
            
            <div class="col-sm-6">
                <div class="input-group input-group-info">
                    <span class="input-group-prepend"><label class="input-group-text"><i class="fa fa-envelope"></i></label></span>
                    <input type="text" class="form-control" name="email" placeholder="Enter email"  required>
                </div>
            </div>
            
            <div class="col-sm-6">
                <div class="input-group input-group-warning">
                    <span class="input-group-prepend"><label class="input-group-text"><i class="fa fa-phone"></i></label></span>
                    <input type="text" class="form-control" name="mobile" placeholder="Enter mobile"  required>
                </div>
            </div>
            
            <div class="col-sm-12">
                <div class="input-group input-group-success">
                    <span class="input-group-prepend"><label class="input-group-text"><i class="fa fa-location"></i></label></span>
                    <input type="text" class="form-control" name="address" placeholder="Enter address"  >
                </div>
            </div>
            
            <div class="col-sm-6">
                <div class="input-group input-group-danger">
                    <span class="input-group-prepend"><label class="input-group-text"><i class="fa fa-key"></i></label></span>
                    <input type="text" class="form-control" name="password" placeholder="Enter password"  required>
                    <a onclick="generatePass()" class="btn btn-sm btn-primary"><i class="fa fa-refresh"></i></a>
                </div>
            </div>
            
            <div class="col-sm-6">
                <div class="input-group input-group-primary">
                    <span class="input-group-prepend"><label class="input-group-text"><i class="fa fa-globe"></i></label></span>
                    <input type="text" class="form-control" name="domain" placeholder="Enter domain"  required>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Plan</label>
                    <select class="form-control select2" name="planid" >
                        <option value="0">--Select Plan--</option>
                        <?php 
                            $get = $this->PlanModel->getAllActivePlans();
                            foreach($get->result()  as $row){
                                echo '<option value="'.$row->id.'">'.$row->plan_name.'</option>';
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
                                echo '<option value="'.$row->id.'">'.$row->domain.'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-6" id="showIframe">
                
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
</script>