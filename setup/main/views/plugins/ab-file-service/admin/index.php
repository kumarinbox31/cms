
<div class="row">
    <div class="col-md-12"><div id="msg"></div>
        </div>
<div class="col-md-4">
    <form class="card add-file-service" method="POST">
        <div class="card-header bg-primary text-white">Add File Service</div>
        <div class="card-body">
            <div class="form-group">
                <label>Form</label>
                <select class="form-control" name="form_id" required>
                    <?php 
                        $ci = &get_instance();
                        $get = $ci->db->select('title,id')->get_where('ab_service',['type'=>'ab-form','admin_id'=>CLIENT_ID])->result();
                        foreach($get as $row){
                            echo '<option value="'.$row->id.'">'.$row->title.'</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Download</label>
                <select class="form-control" name="is_download" required>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn  btn-sm btn-danger">Save</button>
        </div>
    </form>
</div>

<div class="col-md-8">
    <div class="card">
        <div class="card-header bg-primary text-white">All File Service</div>
        <div class="card-body">
            <table class="table table-bordered table-striped datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Download</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="table_data">
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>

<script>
    loadData();
    $('.add-file-service').submit(function(e){
        e.preventDefault();
        var formdata = new FormData(this);
        var btn = $(this).find('button');
        $.ajax({
            url:"<?php echo base_url('api/FileService/addService'); ?>",
            type:"POST",
            dataType:"json",
            data:formdata,
            cache:false,
            contentType: false,
            processData: false,
            beforeSend:function(){
                btn.css('disabled',true);
                $('#msg').html('<div class="alert alert-info">Processing....</div>');
            },
            success:function(res){
                console.log(res);
                if(res.status){
                    alert(res.msg);
                }else{
                    alert(res.msg);
                }
                loadData();
            },
            complete:function(){
                btn.css('disabled',false);
                $('#msg').html("<div class='alert alert-success'>Saved</div>");
            }
        });
    });
    function loadData(){
        $.ajax({
            url:"<?php echo base_url('api/FileService/getAllService'); ?>",
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
                            html += `<tr id="row_${item.id}">
                                        <td>${item.id}</td>
                                        <td>${item.title}</td>
                                        <td>[File-Service id=${item.id}]</td>
                                        <td>
                                            <a href="<?php echo base_url('admin/plugin/ab-file-service?page=edit&id=')?>${item.id}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                            <a href="<?php echo base_url('admin/plugin/ab-file-service?page=item&id=')?>${item.id}&form=${item.form_id}" class="btn btn-sm btn-info"><i class="fa fa-cog"></i></a>
                                            <a onclick="removeFileService(${item.id});" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                            
                                        </td>
                                    </tr>`;
                        });
                        // <a href="<?php echo base_url('admin/delete-service/')?>${item.id}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                        // Set the generated HTML inside the table element with id 'table_data'
                        $('#table_data').html(html);

                }else{
                    alert(res.msg);
                }
            }
        });
    }
    function removeFileService(id){
        var c = confirm('File Service will be deleted.\nAll File Service item will be deleted.');
        if(c){
            $.ajax({
            url:"<?php echo base_url('api/FileService/deleteService'); ?>",
            type:"POST",
            data:{id:id},
            dataType:"json",
            beforeSend:function(){
                $('#msg').html('<div class="alert alert-info">Processing....</div>');
            },
            success:function(res){
                console.log(res);
                if(res.status){
                    alert(res.msg);
                }else{
                    alert(res.msg);
                }
                loadData();
            },
            complete:function(){
                // $('#msg').html("<div class='alert alert-success'>Saved</div>");
            }
        });
        }
    }
</script>