<?
add_shortcode('File-Service', function ($atts, $content) {
    //  [File-Service id=1 ]
    $id = intval(@$atts['id']);
    $ci = &get_instance();
    $get = $this->FileServiceModel->getServiceById($id);
    if(!$get->num_rows()){
        return false;
    }
    $get = $get->row();
    $formid = isset($get->form_id) ? $get->form_id : 0;
    $form = $ci->db->get_where('ab_service',['type'=>'ab-form','id'=>$formid,'admin_id'=>CLIENT_ID])->row();
    $form_data = $form->content;
    $service_title = $get->title;
    ob_start();
    ?>
    <style>
        /*.ab-file-service .formbuilder-button {*/
        /*    display: none;*/
        /*}*/
    </style>
    <div class="ab-file-service ab-file-service-<?php echo $id; ?>">
        <h1 class="text-danger"><?php echo $service_title; ?></h1>
        <form method="POST" action="" class="ab-file-service-submit">
        <div class="col-md-12" id="form_data"><div class="service-form-render" data-form='<?php echo $form_data; ?>'></div></div>
        </form>
    </div>
    <div class="modal modal-xl" tabindex="-1" id="file-service-model">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="file-service-image"></div>
                    <?php if($get->is_download){ ?>
                    <a download href="" class="btn btn-sm btn-primary " id="file-service-file"><i class="fa fa-download"></i></a>
                    <?php } ?>
                </div>
                
            </div>
        </div>
    </div>
    
    <?php
    $html = ob_get_contents();
    ob_end_clean();
    return $html;
});

add_action('ab_head', function () {
    
});
add_action('ab_footer', function () {
    ob_start();
    ?>
    <?php echo '<!-- Ab Form Installed Successfully. -->
    <link rel="stylesheet" href="'.base_url('public/plugins/ab-form/style.css').'">';
        echo '<script src="'.base_url('public/plugins/ab-form/script.js').'"></script>
    <script src="https://formbuilder.online/assets/js/form-render.min.js"></script>';?>
    <script>
            $(document).ready(function(){
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
                $(".service-form-render").each(function(index, element){
                    var content = $('.service-form-render').data('form');
                    convertStringToBoolean(content);
                    console.log(content);
                    try {
                        var formRenderOpts = {
                            formData: content,
                            dataType: "json",
                            layoutTemplates: {
                              default: function(field, label, help, data) {
                                help = $("<div/>")
                                  .addClass("helpme")
                                  .attr("id", "row-" + data.id)
                                  .append(help);
                                return $("<div/>").append(label, field, help);
                              }
                            }

                        };
                        $(element).formRender(formRenderOpts);
                    } catch (error) {
                        console.error("Error parsing JSON:", error);
                    }
                });
            });
        </script>
        <script>
        function getFileType(file) {
        var extension = file.split('.').pop().toLowerCase();
        if (['jpg', 'jpeg', 'png', 'gif', 'bmp'].indexOf(extension) !== -1) {
            return 'image';
        } else if (extension === 'pdf') {
            return 'pdf';
        } else if (['mp4', 'avi', 'mov', 'wmv'].indexOf(extension) !== -1) {
            return 'video';
        } else {
            return 'unknown';
        }
    }
    
            $('.ab-file-service-submit').submit(function(e){
                e.preventDefault();
                var formItems = $(this).find('.rendered-form > div');
                var form = $(this);
                var formData = {};
            
                if (formItems.length === 0) {
                    console.error('No form items found.');
                    return formData; // Return empty object
                }
            
                formItems.each(function(index) {
                    var labelElement = $(this).find('label');
                    var inputElement = $(this).find('input, textarea');
            
                    // Check if label and input are found
                    if (labelElement.length === 0 || inputElement.length === 0) {
                        console.warn('Label or input element not found for item ' + (index + 1));
                        return; // Skip this item
                    }
            
                    var label = labelElement.text().trim();
                    var input = inputElement.val().trim();
            
                    formData[label] = input;
                });
                $.ajax({
                    url:"<?php echo base_url('api/FileService/getServiceItemByFormData'); ?>",
                    type:"POST",
                    dataType:"json",
                    data:{form_data:JSON.stringify(formData)},
                    beforeSend:function(){
                        
                    },
                    success:function(res){
                        if(res.status){
                            var data = res.data;
                            var file = data.file;
                            // var file = data.file;
                            var fileType = getFileType(file); // Assuming getFileType is a function that returns the file type
                            $('#file-service-file').attr('href',file);
                            if (fileType === 'image') {
                                // If file is an image, display it as an image
                                $('#file-service-image').html('<img src="'+file+'" style="width:100%;" />');
                            } else if (fileType === 'pdf') {
                                // If file is a PDF, display it as a link to the PDF file
                                $('#file-service-image').html('<iframe src="'+file+'" target="_blank">View PDF</iframe>');
                            } else if (fileType === 'video') {
                                // If file is a video, display it using a video player
                                // Example assumes you have a video element with id 'video-player'
                                $('#file-service-image').html('<video controls style="width:100%;"><source src="'+file+'" type="video/mp4"></video>');
                            } else {
                                // If file type is unknown or unsupported, display a message
                                $('#file-service-image').html('Unsupported file type');
                            }
                            $('#file-service-model').modal('show');
                        }
                    }
                });
            });
        
        </script>
    <script>
        function getFormData() {
            var formItems = ('.rendered-form > div');
            var formData = {};
        
            if (formItems.length === 0) {
                console.error('No form items found.');
                return formData; // Return empty object
            }
        
            formItems.each(function(index) {
                var labelElement = $(this).find('label');
                var inputElement = $(this).find('input, textarea');
        
                // Check if label and input are found
                if (labelElement.length === 0 || inputElement.length === 0) {
                    console.warn('Label or input element not found for item ' + (index + 1));
                    return; // Skip this item
                }
        
                var label = labelElement.text().trim();
                var input = inputElement.val().trim();
        
                formData[label] = input;
            });
        
            return formData;
        }
        function saveFileServiceItem(){
            var form_data = JSON.stringify(getFormData());
            var file = $('#file').val();
            var file_download_id = <?php echo @$_GET['id'] ?? 0; ?>;
            $.ajax({
                url:"<?php echo base_url('api/FileService/addServiceItem'); ?>",
                type:"POST",
                dataType:"JSON",
                data:{form_data:form_data,file:file,file_download_id:file_download_id},
                beforeSend:function(){
                    $('#msg').html("<div class='alert alert-info'><i class='fa fa-spinner fa-spin'></i> Processing...</div>");
                },
                success:function(res){
                    if(res.status){
                        $('#msg').html("<div class='alert alert-success'>"+res.msg+"</div>");
                    }else{
                        $('#msg').html("<div class='alert alert-danger'>"+res.msg+"</div>");
                    }
                }
            });
        }

    </script>
    <?php
    $html = ob_get_contents();
    ob_end_clean();
    echo $html;
});

