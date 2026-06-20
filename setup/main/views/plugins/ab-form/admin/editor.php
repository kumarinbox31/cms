 <div id="msg"></div>
<center>
    <a href="<?php echo base_url('admin/plugin/ab-form?page=formio-editor&id='.@$_GET['id']).'&flag=0'; ?>" class="btn btn-sm btn-info text-white">Edit with New Editor</a>
</center><br>
<?php 
    $formId = intval(@$_GET['id']);
    $ci = &get_instance();
    $get = $ci->ServiceModel->getServiceById($formId)->row();
    $desc = @$get->desc;
    $desc_data = json_decode($desc, true) ?: [];
    $redirect_url = isset($desc_data['redirect_url']) ? $desc_data['redirect_url'] : '';
    $email_to = isset($desc_data['email_to']) ? $desc_data['email_to'] : '';
    $whatsapp_num = isset($desc_data['whatsapp_num']) ? $desc_data['whatsapp_num'] : '';
    $enable_recaptcha = isset($desc_data['enable_recaptcha']) ? $desc_data['enable_recaptcha'] : 0;
?>
<div class="tabbable-responsive">
    <div class="tabbable">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="builder-tab" data-toggle="tab" href="#builder-pane" role="tab">Form Builder</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings-pane" role="tab">Integrations & Settings</a>
        </li>
      </ul>
    </div>
</div>

<div class="tab-content bg-white border border-top-0 p-3 mb-4">
    <div class="tab-pane fade active show" id="builder-pane" role="tabpanel">
        <div id="fb-editor"></div>
    </div>
    <div class="tab-pane fade" id="settings-pane" role="tabpanel">
        <div class="form-group">
          <label class="font-weight-bold">Redirect URL after submission (Optional)</label>
          <input type="text" id="setting_redirect_url" class="form-control" placeholder="https://..." value="<?php echo htmlspecialchars($redirect_url); ?>">
          <small class="text-muted">Users will be redirected to this URL upon successful form submission.</small>
        </div>
        <div class="form-group">
          <label class="font-weight-bold">Email Notification (Admin)</label>
          <input type="email" id="setting_email_to" class="form-control" placeholder="admin@example.com" value="<?php echo htmlspecialchars($email_to); ?>">
          <small class="text-muted">Receive an email when this form is submitted.</small>
        </div>
        <div class="form-group">
          <label class="font-weight-bold">WhatsApp Notification (Number)</label>
          <input type="text" id="setting_whatsapp_num" class="form-control" placeholder="+1234567890" value="<?php echo htmlspecialchars($whatsapp_num); ?>">
          <small class="text-muted">Enter the WhatsApp number with country code (e.g. 919876543210).</small>
        </div>
        <div class="form-group">
          <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="setting_enable_recaptcha" <?php echo $enable_recaptcha ? 'checked' : ''; ?> onchange="document.getElementById('recaptcha_keys_wrapper').style.display = this.checked ? 'block' : 'none';">
            <label class="custom-control-label font-weight-bold" for="setting_enable_recaptcha">Enable Google reCAPTCHA v3</label>
          </div>
          <small class="text-muted">Protect this form against spam bots invisibly.</small>
          <div id="recaptcha_keys_wrapper" style="display: <?php echo $enable_recaptcha ? 'block' : 'none'; ?>; margin-top: 10px; padding: 10px; background: #f8f9fa; border-radius: 5px;">
              <label>reCAPTCHA Site Key</label>
              <input type="text" id="setting_recaptcha_site_key" class="form-control mb-2" value="<?php echo htmlspecialchars(isset($desc_data['recaptcha_site_key']) ? $desc_data['recaptcha_site_key'] : ''); ?>">
              <label>reCAPTCHA Secret Key</label>
              <input type="text" id="setting_recaptcha_secret_key" class="form-control" value="<?php echo htmlspecialchars(isset($desc_data['recaptcha_secret_key']) ? $desc_data['recaptcha_secret_key'] : ''); ?>">
          </div>
        </div>
    </div>
</div>

<button id="save-button" class="btn btn-sm btn-primary mb-4">Save Form & Settings</button>
<?php 
    add_action('ab-admin-footer',function(){
        $formId = intval(@$_GET['id']);
        $ci = &get_instance();
        $get = $this->ServiceModel->getServiceById($formId)->row();
        $content = @$get->content;
        ?>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
          <script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
          <script>
            jQuery(function($) {
                // Initialize the form builder
                var existingData = <?php echo $content == ''?'{}':$content; ?>;
                convertStringToBoolean(existingData);
                    
                var formBuilder = $(document.getElementById('fb-editor')).formBuilder({
                    formData: existingData,
                });
                // Example: Get form data on save
                $('#save-button').on('click', function() {
                    // Get form data
                    var formData = formBuilder.actions.getData();
                    
                    var settingsObj = {
                        type: '',
                        redirect_url: $('#setting_redirect_url').val(),
                        email_to: $('#setting_email_to').val(),
                        whatsapp_num: $('#setting_whatsapp_num').val(),
                        enable_recaptcha: $('#setting_enable_recaptcha').is(':checked') ? 1 : 0,
                        recaptcha_site_key: $('#setting_recaptcha_site_key').val(),
                        recaptcha_secret_key: $('#setting_recaptcha_secret_key').val()
                    };
                    
                    $.ajax({
                        url: "<?php echo current_url(); ?>",
                        type: "POST",
                        dataType: "JSON",
                        data: {
                            action: "update-service",
                            content: formData,
                            desc: JSON.stringify(settingsObj),
                            id: "<?php echo $formId; ?>"
                        },
                        beforeSend: function(){
                            // You can add loading indicators or other tasks here
                        },
                        success: function(res){
                            if(res.status){
                                $('#msg').html('<div class="alert alert-success">Form data saved successfully!</div>');
                            } else {
                                $('#msg').html('<div class="alert alert-danger">Failed to save form data or no changes.</div>');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            $('#msg').html('Error: ' + error);
                        }
                    });
                    // Do something with the form data
                    // console.log(formData);
                });
            });
            function convertStringToBoolean(obj) {
                for (const key in obj) {
                    if (typeof obj[key] === "string") {
                        if (obj[key] === "true" || obj[key] === "false") {
                            obj[key] = obj[key] === "true";
                        }
                    } else if (typeof obj[key] === "object") {
                        convertStringToBoolean(obj[key]);
                    }
                }
            }

            </script>

    <?
    });
    
    
?>