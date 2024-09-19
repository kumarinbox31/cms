
<div class="row">
<div class="col-md-12">
    <form class="card add-product" method="POST">
        <div id="msg"></div>
        <input type="hidden" name="gallery_id" value="<?php echo @$_GET['id'];?>">
        <div class="card-header bg-primary text-white">Add Product Gallery Item</div>
        <div class="card-body row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Enter title" required>
                </div>
                <div class="form-group">
                    <label>Link</label>
                    <input type="text" name="link" class="form-control" placeholder="Enter link" >
                </div>
                <div class="form-group">
                    <label>Button Text</label>
                    <input type="text" name="btn" class="form-control" placeholder="Enter button text" value="Get Quote" >
                </div>
                <input type="hidden" name="file" id="file">
                    <style>
                        .preview-logo > *{
                            width: 200px;
                            height:100px;
                        }
                    </style>
                    <div class="form-group preview-logo media-manager" data-value="#file" data-preview=".preview-logo" data-accept=".jpg,.png,.jpeg,.webp" data-multiple="false">
                        <img src="<?php echo @$get->logo ?>">
                    </div>
                    
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Desc</label>
                    <textarea name="desc" class="form-control " ></textarea>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn  btn-sm btn-danger">Save</button>
        </div>
    </form>
</div>

<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-primary text-white">All Product Gallery Items</div>
        <div class="card-body">
            <table class="table table-bordered table-striped datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Link</th>
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
        url: "<?php echo base_url('api/gallery/addItem'); ?>",
        type: "POST",
        dataType: "json",
        data: formdata,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
            btn.prop('disabled', true);
            $('#msg').html('<div class="alert alert-info">Processing....</div>');
        },
        success: function(res){
            console.log(res);
            if(res.status){
                alert(res.msg);
                loadData();
                $('.add-product')[0].reset();
            }else{
                alert(res.msg);
            }
        },
        complete: function(){
            btn.prop('disabled', false);
            $('#msg').html("<div class='alert alert-success'>Saved</div>");
        }
    });
});

function deleteItem(id){
        var c = confirm('Are you sure?');
        if(c){
            $.ajax({
                url:"<?php echo base_url('api/gallery/deleteItem/'); ?>"+id,
                type:"GET",
                dataType:"json",
                function(res){
                    if(res.status){
                        loadData();
                        $('#msg').html("<div class='alert alert-success'>Deleted Item successfully.</div>");
                    }else{
                        alert(res.msg);
                    }
                }
            });
        }
    };
    function loadData(){
        $.ajax({
            url:"<?php echo base_url('api/gallery/getAllItems?galleryid=').@$_GET['id']; ?>",
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
                            btn = item.btn == null ? 'Get Quote' : item.btn;
                            html += `<tr>
                                        <td>${item.id}</td>
                                        <td>${item.title}</td>
                                        <td><img src="${item.file}" width="50" height="50"></td>
                                        <td><a class="btn btn-sm btn-primary" href="${item.link}">${btn}</a></td>
                                        <td>
                                            <a class="btn btn-sm btn-info " href="<?php echo base_url('admin/plugin/ab-product-gallery?page=item-edit&id=')?>${item.id}" ><i class="fa fa-edit"></i></a>
                                          <a class="btn btn-sm btn-danger " onclick="deleteItem(${item.id})" ><i class="fa fa-trash"></i></a>
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
</script>