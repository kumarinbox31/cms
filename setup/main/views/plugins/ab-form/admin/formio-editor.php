<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
    <!-- Correct Form.io CSS -->
    <link rel="stylesheet" href="https://cdn.form.io/formiojs/formio.full.min.css">
    <title>Form.io Builder</title>
  </head>
  <body>
      <div class="container">
          <h1 class="mt-4">Form.io Builder</h1>
      <div id="msg"></div>
      <center>
          <a href="<?php echo base_url('admin/plugin/ab-form'); ?>" class="btn btn-sm btn-info text-white">Go to Dashboard</a>
          <a href="<?php echo base_url('admin/plugin/ab-form?page=editor&id='.@$_GET['id']); ?>" class="btn btn-sm btn-info text-white">Back to Old Editor</a>
      </center>
      <br>
    
    <?php 
      $formId = intval(@$_GET['id']);
      $ci = &get_instance();
      $get = $ci->ServiceModel->getServiceById($formId)->row();
      $desc = @$get->desc;
      $content = @$get->content;
        if($desc == 'formio' || $content == ''){
    ?>
    
      <ul class="nav nav-tabs mt-3" id="formioTabs" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="builder-tab" data-bs-toggle="tab" data-bs-target="#builder-pane" type="button" role="tab" aria-selected="true">Form Builder</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings-pane" type="button" role="tab" aria-selected="false">Integrations & Settings</button>
        </li>
      </ul>
      <div class="tab-content border border-top-0 p-3 mb-4" id="formioTabsContent">
        <div class="tab-pane fade show active" id="builder-pane" role="tabpanel">
          <div id="builder"></div>
        </div>
        <div class="tab-pane fade" id="settings-pane" role="tabpanel">
            <?php
              $desc_data = json_decode($desc, true) ?: [];
              $redirect_url = isset($desc_data['redirect_url']) ? $desc_data['redirect_url'] : '';
              $email_to = isset($desc_data['email_to']) ? $desc_data['email_to'] : '';
              $whatsapp_num = isset($desc_data['whatsapp_num']) ? $desc_data['whatsapp_num'] : '';
              $enable_recaptcha = isset($desc_data['enable_recaptcha']) ? $desc_data['enable_recaptcha'] : 0;
            ?>
            <div class="mb-3">
              <label class="form-label fw-bold">Redirect URL after submission (Optional)</label>
              <input type="text" id="setting_redirect_url" class="form-control" placeholder="https://..." value="<?php echo htmlspecialchars($redirect_url); ?>">
              <small class="text-muted">Users will be redirected to this URL upon successful form submission.</small>
            </div>
            <div class="mb-3">
              <label class="form-label fw-bold">Email Notification (Admin)</label>
              <input type="email" id="setting_email_to" class="form-control" placeholder="admin@example.com" value="<?php echo htmlspecialchars($email_to); ?>">
              <small class="text-muted">Receive an email when this form is submitted.</small>
            </div>
            <div class="mb-3">
              <label class="form-label fw-bold">WhatsApp Notification (Number)</label>
              <input type="text" id="setting_whatsapp_num" class="form-control" placeholder="+1234567890" value="<?php echo htmlspecialchars($whatsapp_num); ?>">
              <small class="text-muted">Enter the WhatsApp number with country code (e.g. 919876543210). Check our guide for Webhook configuration.</small>
            </div>
            <div class="mb-3">
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="setting_enable_recaptcha" <?php echo $enable_recaptcha ? 'checked' : ''; ?> onchange="document.getElementById('recaptcha_keys_wrapper').style.display = this.checked ? 'block' : 'none';">
                <label class="form-check-label fw-bold" for="setting_enable_recaptcha">Enable Google reCAPTCHA v3</label>
              </div>
              <small class="text-muted">Protect this form against spam bots invisibly.</small>
              <div id="recaptcha_keys_wrapper" style="display: <?php echo $enable_recaptcha ? 'block' : 'none'; ?>; margin-top: 10px; padding: 10px; background: #f8f9fa; border-radius: 5px;">
                  <label class="form-label">reCAPTCHA Site Key</label>
                  <input type="text" id="setting_recaptcha_site_key" class="form-control mb-2" value="<?php echo htmlspecialchars(isset($desc_data['recaptcha_site_key']) ? $desc_data['recaptcha_site_key'] : ''); ?>">
                  <label class="form-label">reCAPTCHA Secret Key</label>
                  <input type="text" id="setting_recaptcha_secret_key" class="form-control" value="<?php echo htmlspecialchars(isset($desc_data['recaptcha_secret_key']) ? $desc_data['recaptcha_secret_key'] : ''); ?>">
              </div>
            </div>
        </div>
      </div>
      
      <button id="save-button" class="btn btn-primary mt-2">Save Form & Settings</button>
    
    <script src="https://cdn.form.io/formiojs/formio.full.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      let builder;

      document.addEventListener('DOMContentLoaded', function () {
        // Initialize the Form.io builder with existing content
        builder = Formio.builder(document.getElementById('builder'), <?php echo $content ?: '{}'; ?>, {})
          .then((instance) => {
            builder = instance; // Assign the builder instance for later use
          });
      });

      // Handle Save Button Click
      jQuery(function ($) {
        $('#save-button').on('click', function () {
          // Get the form schema
          const formSchema = builder.schema;
          
          const settingsObj = {
              type: 'formio',
              redirect_url: $('#setting_redirect_url').val(),
              email_to: $('#setting_email_to').val(),
              whatsapp_num: $('#setting_whatsapp_num').val(),
              enable_recaptcha: $('#setting_enable_recaptcha').is(':checked') ? 1 : 0,
              recaptcha_site_key: $('#setting_recaptcha_site_key').val(),
              recaptcha_secret_key: $('#setting_recaptcha_secret_key').val()
          };

          // Send form schema via AJAX to the server
          $.ajax({
            url: "<?php echo current_url(); ?>",
            type: "POST",
            dataType: "JSON",
            data: {
              action: "update-service",
              content: JSON.stringify(formSchema), // Serialize the schema as JSON
              desc: JSON.stringify(settingsObj), // Serialize the settings as JSON string in desc field
              id: "<?php echo $formId; ?>"
            },
            beforeSend: function () {
              $('#msg').html('<div class="alert alert-info">Saving form data...</div>');
            },
            success: function (res) {
              if (res.status) {
                $('#msg').html('<div class="alert alert-success">Form data saved successfully!</div>');
              } else {
                $('#msg').html('<div class="alert alert-danger">Failed to save form data or no changes detected.</div>');
              }
            },
            error: function (xhr, status, error) {
              console.error(xhr.responseText);
              $('#msg').html('<div class="alert alert-danger">Error: ' + error + '</div>');
            }
          });
        });
      });
    </script>
    <?php } else{ 
        echo '<div class="alert alert-danger">Something went wrong</div>';
    
    } ?>
    
    </div>
  </body>
</html>
