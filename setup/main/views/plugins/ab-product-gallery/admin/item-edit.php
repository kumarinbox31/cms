<?php
$ci = &get_instance();

// Load the GalleryModel
$ci->load->model('GalleryModel');

// Sanitize and retrieve 'id' from query parameters
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;  // Casting to integer to prevent SQL injection

// Fetch the gallery item from the database
$get = $ci->GalleryModel->getGalleyItems([
    'id' => $id,
    'admin_id'  =>  CLIENT_ID,
])->row();

if(!$get){
    echo 'Not Found.';exit;
}

?>
<div class="row">
    <div class="col-md-12">
        <form class="card update-product" method="POST">
            <div id="msg"></div>
            <input type="hidden" name="id" value="<?php echo $get->id; ?>">
            <input type="hidden" name="gallery_id" value="<?php echo $get->gallery_id; ?>">
            <div class="card-header bg-primary text-white">Update Product Gallery Item</div>
            <div class="card-body row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Enter title" value="<?php echo $get->title; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Link</label>
                        <input type="text" name="link" class="form-control" placeholder="Enter link" value="<?php echo $get->link; ?>">
                    </div>
                    <div class="form-group">
                        <label>Button Text</label>
                        <input type="text" name="btn" class="form-control" placeholder="Enter button text"
                            value="<?php echo $get->btn; ?>">
                    </div>
                    <div class="form-group">
                        <label>Short Desc</label>
                        <textarea name="short_desc" class="form-control" placeholder="Enter short desc"><?php echo $get->short_desc; ?></textarea>
                    </div>
                    <input type="hidden" name="file" id="file" value="<?php echo $get->file; ?>">
                    <style>
                        .preview-logo>* {
                            width: 200px;
                            height: 100px;
                        }
                    </style>
                    <div class="form-group preview-logo media-manager" data-value="#file" data-preview=".preview-logo"
                        data-accept=".jpg,.png,.jpeg,.webp" data-multiple="false">
                        <img src="<?php echo @$get->file ?>">
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Desc</label>
                        <textarea name="desc" class="form-control "><?php echo $get->desc; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn  btn-sm btn-danger">Save</button>
            </div>
        </form>
    </div>

</div>

<script>
    $(document).ready(function () {
        $('.update-product').submit(function (e) {
            e.preventDefault();

            var formdata = new FormData(this);
            var btn = $(this).find('button');
            var msgContainer = $('#msg'); // Target the message container

            $.ajax({
                url: "<?php echo base_url('api/gallery/updateItem'); ?>",
                type: "POST",
                dataType: "json",
                data: formdata,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    btn.prop('disabled', true);
                    msgContainer.html('<div class="alert alert-info">Processing....</div>');
                },
                success: function (res) {
                    // Clear the message container first
                    msgContainer.empty();
                    if (res.status) {
                        msgContainer.html('<div class="alert alert-success">' + res.msg + '</div>');
                    } else {
                        msgContainer.html('<div class="alert alert-danger">' + res.msg + '</div>');
                    }
                },
                error: function (xhr, status, error) {
                    // Handle any errors that occur during the AJAX request
                    msgContainer.html('<div class="alert alert-danger">An error occurred: ' + error + '</div>');
                },
                complete: function () {
                    btn.prop('disabled', false);
                }
            });
        });
    });
</script>
