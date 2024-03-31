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
</script>