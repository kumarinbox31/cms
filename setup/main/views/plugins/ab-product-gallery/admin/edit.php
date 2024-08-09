<?php
// Get the CodeIgniter instance
$ci = &get_instance();

// Load the GalleryModel
$ci->load->model('GalleryModel');

// Sanitize and retrieve 'id' from query parameters
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;  // Casting to integer to prevent SQL injection

// Fetch the gallery item from the database
$get = $ci->GalleryModel->getGallery([
    'admin_id' => CLIENT_ID,
    'id' => $id
])->row();

// Check if $get is not null and 'extra' field exists
if ($get && isset($get->extra)) {
    $extra = json_decode($get->extra);
    // if (json_last_error() !== JSON_ERROR_NONE) {
    //     echo "JSON Error: " . json_last_error_msg();
    // } else {
    //     // Output decoded extra field
    //     var_dump($extra);
    // }
} else {
    $extra = null; // Handle cases where the gallery item is not found or 'extra' field is missing
}
// var_dump($get->extra);exit;
?>


<form method="post" class="update-gallery">
    <input type="hidden" name="id" value="<?php echo $get->id; ?>">
<div class="card">
    <div id="msg"></div>
    <div class="card-header bg-info text-white">Update Info</div>
    <div class="card-body row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" required value="<?php echo $get->title; ?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Button Title</label>
                <input type="text" name="extra[button_title]" class="form-control" required value="<?php echo @$extra->button_title ? @$extra->button_title :'Get Quote'; ?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Button Text Color</label>
                <input type="color" name="extra[button_color]" class="w-100" value="<?php echo isset($extra->button_color) ? $extra->button_color : '#ffffff'?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Button Bg Color</label>
                <input type="color" name="extra[button_bg]" class="w-100" value="<?php echo isset($extra->button_bg) ? $extra->button_bg : '#086AD8'?>">
            </div>
        </div>
        <!--<div class="col-md-6">-->
        <!--    <div class="form-group">-->
        <!--        <label>Button Style</label>-->
        <!--        <select class="form-control" name="extra[button_style]">-->
        <!--            <option value="primary" <?php echo @$extra->button_style == 'primary' ? 'selected' : ''; ?> >Primary</option>-->
        <!--            <option value="success" <?php echo @$extra->button_style == 'success' ? 'selected' : ''; ?>>Success</option>-->
        <!--            <option value="danger" <?php echo @$extra->button_style == 'danger' ? 'selected' : ''; ?>>Danger</option>-->
        <!--            <option value="warning" <?php echo @$extra->button_style == 'warning' ? 'selected' : ''; ?>>Warning</option>-->
        <!--        </select>-->
                
        <!--    </div>-->
        <!--</div>-->
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
    </div>
</div>
</form>

<script>
    $('.update-gallery').submit(function(e) {
    e.preventDefault();

    // Create a FormData object from the form
    var formdata = new FormData(this);

    // Send AJAX request
    $.ajax({
        url: "<?php echo base_url('api/gallery/update'); ?>",
        type: "POST",
        data: formdata,
        dataType: "json",
        contentType: false,   // Tell jQuery not to set any content type header
        processData: false,   // Tell jQuery not to process the data (i.e., not to convert it to a query string)
        beforeSend: function() {
            $('#msg').html("<div class='alert alert-info'><i class='fa fa-spinner fa-spin'></i> Processing...</div>");
        },
        success: function(res) {
            if (res.status) {
                $('#msg').html("<div class='alert alert-success'>Updated successfully.</div>");
            } else {
                // Handle error messages returned by the server
                $('#msg').html("<div class='alert alert-danger'>Error: " + res.message + "</div>");
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            // Handle AJAX request errors
            $('#msg').html("<div class='alert alert-danger'>An error occurred: " + textStatus + "</div>");
        }
    });
});

</script>