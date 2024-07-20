<style>
    .media-item{
        border:1px solid black;
        padding:1rem;
    }
    .media-item.active{
        background:green;
        p{
            color:white;
        }
    }
</style>
<div class="card">
    <div class="card-header bg-primary">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Manager</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Upload</button>
            </li>
        </ul>
        
        <div id="mediaDeleteBtn" class="pull-right"></div>
    </div>
    <div class="card-body">
        <div class="tab-content mt-2" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <?php foreach ($result as $row): ?>
                                <div class="col-md-3 text-center media-item" data-media-id="<?php echo $row->id; ?>" >
                                   <div class="file"> <img src="<?php echo $row->path; ?>" style="height:100px;max-width:100%;"></div>
                                    <p><?php echo $row->filename; ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>


            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div id="msg"></div>
                <!-- File Upload Form -->
                <form id="uploadForm" enctype="multipart/form-data">
                    <input type="file" name="files[]" id="fileInput" class="form-control mb-2">
                    <button type="submit" class="btn btn-primary" >Upload</button>
                </form>
        
                <!-- Display Uploaded Files (if needed) -->
                <div id="uploadedFiles"></div>
        
                <script>
            $('#uploadForm').submit(function(e){
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: '<?php echo base_url(); ?>admin/upload',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend:function(){
                        $('#msg').html("<div class='alert alert-info'>Uploading... Please wait.</div>");
                        $('#uploadForm :input').prop('disabled', false);
                    },
                    success: function (response) {
                        // Handle success, update UI, etc.
                        console.log('File uploaded successfully:', response);
                        $('#msg').html("<div class='alert alert-success'>Uploaded successfully.</div>");
                        $('#uploadForm :input').prop('disabled', false);
                    },
                    error: function (error) {
                        // Handle error, display message, etc.
                        console.error('Error uploading file:', error);
                    }
                });
                
            });
        </script>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Preview</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body row">
        <div class="col-md-4">
            <div id="preview"></div>
        </div>
        <div class="col-md-8">
            <div id="fileName"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" id="delete-single-media" >Delete</button>
      </div>
    </div>
  </div>
</div>

<script>
    var mediaDeleteBtn = '<a onclick="deleteMedia()" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</a>';
    $('.media-item').click(function(event){
        if (event.ctrlKey) {
            $(this).addClass('active');
            enableDeleteBtn();
        }else{
            var media_id = $(this).data('media-id');
            var html = $(this).find('.file').html();
            $('#delete-single-media').data('id',media_id);
            $('.media-item').removeClass('active');
            $(this).addClass('active');
            $('#exampleModal').modal('show');
            disableDeleteBtn();
            $('#preview').html(html);
            $('#fileName').html('<b>File Name : </b>'+$(this).find('p').text());
        }
    });
    function enableDeleteBtn(){
        $('#mediaDeleteBtn').html(mediaDeleteBtn);
    }
    function disableDeleteBtn(){
        $('#mediaDeleteBtn').html('');
    }
    $('#delete-single-media').click(function(){
        var c = confirm('Are you sure?');
        if(c){
            var id = $(this).data('id');
            $.ajax({
                url:"<?php echo base_url('admin/ajax'); ?>",
                type:"POST",
                data:{id:id,action:"delete-signle-media"},
                dataType:"json",
                success:function(res){
                    if(res.status){
                        $('#exampleModal').modal('hide');
                        alert(res.msg);
                        $('.media-item.active').remove();
                    }else{
                        alert(res.msg);
                    }
                }
            });
        }
    });
    function deleteMedia(){
        var c = confirm('Are you sure?');
        if(c){
            var obj = {};

            $('.media-item.active').each(function(index, element) {
                var id = $(element).data('media-id');
                obj[index] = id;
            });
            
            $.ajax({
                url: "<?php echo base_url('admin/ajax'); ?>",
                type: "POST",
                dataType: "json", // Updated to lowercase "json"
                data: {
                    'action': 'delete-media',
                    'obj': JSON.stringify(obj) // Stringify the object before sending
                },
                success: function(res) {
                    if(res.status){
                        alert(res.msg);
                        $('.media-item.active').remove();
                    }
                },
                error: function(err) {
                    // Handle error response
                }
            });

        }
    }
</script>