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
    
      <div id="builder"></div>
      <button id="save-button" class="btn btn-primary mt-4">Save Form</button>
    
    <script src="https://cdn.form.io/formiojs/formio.full.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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

          // Send form schema via AJAX to the server
          $.ajax({
            url: "<?php echo current_url(); ?>",
            type: "POST",
            dataType: "JSON",
            data: {
              action: "update-service",
              content: JSON.stringify(formSchema), // Serialize the schema as JSON
              desc: 'formio',
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
