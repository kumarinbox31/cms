 <button id="save-button" class="btn btn-sm btn-primary">Save Form</button>
 <div id="msg"></div>
  <div id="fb-editor"></div>
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
                var formBuilder = $(document.getElementById('fb-editor')).formBuilder({
                    formData: existingData,
                });
                // Example: Get form data on save
                $('#save-button').on('click', function() {
                    // Get form data
                    var formData = formBuilder.actions.getData();
                    $.ajax({
                        url: "<?php echo current_url(); ?>",
                        type: "POST",
                        dataType: "JSON",
                        data: {
                            action: "update-service",
                            content: formData,
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
                    console.log(formData);
                });
            });

            </script>

    <?
    });
?>