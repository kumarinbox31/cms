<div class="row">
<div class="col-md-4">
    <form class="card add-product" method="POST">
        <div id="msg"></div>
        <input type="hidden" name="type" value="Product Gallery">
        <div class="card-header bg-primary text-white">Add New Product Gallery</div>
        <div class="card-body">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="title" class="form-control" required>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn  btn-sm btn-danger">Save</button>
        </div>
    </form>
</div>

<div class="col-md-8">
    <div class="card">
        <div class="card-header bg-primary text-white">All Product Gallery</div>
        <div class="card-body">
            <table class="table table-bordered table-striped datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Short-Code</th>
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
    $('.add-product').submit(function(e){
        e.preventDefault();
        var formdata = new FormData(this);
        var btn = $(this).find('button');
        $.ajax({
            url:"<?php echo base_url('api/gallery/add'); ?>",
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
            url:"<?php echo base_url('api/gallery/getAll?type=Product Gallery'); ?>",
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
                                        <td>[Product-Gallery id=${item.id}]</td>
                                        <td>
                                            <a href="<?php echo base_url('admin/plugin/ab-product-gallery?page=edit&id=')?>${item.id}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                            <a href="<?php echo base_url('admin/plugin/ab-product-gallery?page=item&id=')?>${item.id}" class="btn btn-sm btn-info"><i class="fa fa-cog"></i></a>
                                            <a href="<?php echo base_url('admin/plugin/ab-product-gallery?page=query&id=')?>${item.id}" class="btn btn-sm btn-warning"><i class="fa fa-list"></i></a>
                                            <a onclick="removeProductGallery(${item.id});" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                            
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
    function removeProductGallery(id){
        var c = confirm('Gallery will be deleted.\nAll Gallery item will be deleted.');
        if(c){
            $.ajax({
            url:"<?php echo base_url('api/gallery/deleteGallery/'); ?>"+id,
            type:"POST",
            dataType:"json",
            cache:false,
            contentType: false,
            processData: false,
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