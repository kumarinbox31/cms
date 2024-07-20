<?php 
$ci = &get_instance();
$get = $ci->db->get_where('ab_service',['type'=>'ab-form','id'=>@$_GET['form'],'admin_id'=>CLIENT_ID]);
?>
<style>
    .formbuilder-button{
        display:none;
    }
</style>
<form method="POST" action="" class="ajax">
<div class="card">
    <div class="card-header bg-primary text-white">Add Item</div>
    <div class="card-body">
        <div id="msg"></div>
        <div class="row">
            <div class="col-md-12" id="form_data"><div class="form_render"></div></div>
            <div class="col-md-12 mt-2">
                <input type="hidden" id="file" class="form-control" required>
                <div class="slide-item media-manager" style="padding-top:2rem;font-size:2rem;"
                    data-value="#file" data-preview="#preview" data-accept=".jpg,.png,.pdf" data-multiple="false">
                        <i class="fa fa-upload"></i>
                </div>
                <div id="preview"></div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-sm btn-primary" >Save</button>
    </div>
</div>
</form>
<div class="card">
    <div class="card-header bg-primary  text-white">All List</div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Data</th>
                    <th>File</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="table_data">
                
            </tbody>
        </table>
    </div>
</div>


<?php 
    add_action('ab-admin-footer',function(){
        $formId = intval(@$_GET['form']);
        $ci = &get_instance();
        $get = $this->ServiceModel->getServiceById($formId)->row();
        $content = @$get->content;
        echo '
    <!-- Ab Form Installed Successfully. -->
    <link rel="stylesheet" href="'.base_url('public/plugins/ab-form/style.css').'">';
        echo '<script src="'.base_url('public/plugins/ab-form/script.js').'"></script>
    <script src="https://formbuilder.online/assets/js/form-render.min.js"></script>
          ';
        //  print_r($content);
        ?>
          <<script>
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
                $(".form_render").each(function(index, element){
                    var content = `<?php echo $content; ?>`;
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


    <?
    });
    
    
?>
<script>
function getFormData() {
    var formItems = $('.rendered-form > div');
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
    var file_download_id = <?php echo @$_GET['id']; ?>;
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
                $('.ajax')[0].reset();
                loadData();
            }else{
                $('#msg').html("<div class='alert alert-danger'>"+res.msg+"</div>");
            }
        }
    });
}
$('.ajax').submit(function(e){
    e.preventDefault();
    saveFileServiceItem();
});

</script>



<script>
    loadData();
    function deleteItem(id){
        var c = confirm('Are you sure?');
        if(c){
            $.ajax({
                url:"<?php echo base_url('api/FileService/deleteServiceItem'); ?>",
                type:"post",
                data:{id:id},
                dataType:"json",
                success:function(res){
                    if(res.status){
                        loadData();
                    }else{
                        alert(res.msg);
                    }
                }
            });
        }
    };
    function loadData(){
        $.ajax({
            url:"<?php echo base_url('api/FileService/getAllServiceItem/').@$_GET['id']; ?>",
            type:"GET",
            dataType:"JSON",
            success:function(res){
                if(res.status){
                    var data = res.data;
                        // Initialize an empty string to store HTML for table rows
                        var html = '';
                        // Loop through the data array
                        data.forEach(function(item,$index) {
                            // Construct HTML for each table row using data from the array
                            html += `<tr>
                                        <td>${item.id}</td>
                                        <td>${item.form_data}</td>
                                        <td><a href="${item.file}" target="_blank" class="btn btn-sm btn-info">View File</a></td>
                                        <td>
                                            <a class="btn btn-sm btn-danger " onclick="deleteItem(${item.id})" ><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>`;
                        });
                        $('#table_data').html(html);

                }else{
                    alert(res.msg);
                }
            }
        });
    }
</script>