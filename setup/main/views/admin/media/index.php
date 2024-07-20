<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Manager</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Upload</button>
    </li>
</ul>

<div class="tab-content mt-2" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <?php foreach ($result as $row): ?>
                        <div class="col-md-3 text-center media-item" data-media-id="<?php echo $row->path; ?>">
                            <img src="<?php echo $row->path; ?>" style="height:100px;">
                            <p><?php echo $row->filename; ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-md-4">
                <input type="text" id="search" class="form-control" placeholder="search">
                
            </div>
        </div>
    </div>


    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div id="upload-msg"></div>
        <!-- File Upload Form -->
        <form id="uploadForm" enctype="multipart/form-data">
    <input type="file" name="files[]" id="fileInput" class="form-control mb-2" multiple>
    <button type="submit" class="btn btn-primary">Upload</button>
</form>

<script>
    $(document).ready(function(){
        $('#uploadForm').submit(function(e){
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: '<?php echo base_url('admin/upload'); ?>',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function(){
                    $('#upload-msg').html("<div class='alert alert-info'>Uploading... Please wait.</div>");
                    $('#uploadForm :input').prop('disabled', true);
                },
                success: function (response) {
                    console.log('File uploaded successfully:', response);
                    alert('uploaded');
                    $('#upload-msg').html("<div class='alert alert-success'>Uploaded successfully.</div>");
                    $('#uploadForm :input').prop('disabled', false);
                    $('#uploadForm')[0].reset();
                },
                error: function (error) {
                    console.error('Error uploading file:', error);
                    $('#upload-msg').html("<div class='alert alert-danger'>Error uploading file. Please try again.</div>");
                    $('#uploadForm :input').prop('disabled', false);
                }
            });
        });
    });
</script>

    </div>
</div>

<script>
    $(document).ready(function () {
        // var selectedMedia = [];
        var allowMultiple = <?php echo $multiple; ?>; // Set to true to allow multiple selections, false otherwise

        // Toggle selection on click and show blue border
        $('.media-item').on('click', function () {
            var mediaId = $(this).data('media-id');

            if (!allowMultiple) {
                // Clear previous selections if not allowed to select multiple
                selectedMedia = [];
                $('.media-item').removeClass('selected border-blue');
            }

            if (selectedMedia.includes(mediaId)) {
                selectedMedia = selectedMedia.filter(id => id !== mediaId);
                $(this).removeClass('selected border-blue');
            } else {
                selectedMedia.push(mediaId);
                $(this).addClass('selected border-blue');
            }

            updateBorder();
        });

        // Function to update the blue border
        function updateBorder() {
            $('.media-item').removeClass('border-blue');

            selectedMedia.forEach(function (mediaId) {
                $('.media-item[data-media-id="' + mediaId + '"]').addClass('border-blue');
            });
        }
    });
</script>


<style>
    .media-item.selected {
        border: 2px solid blue;
    }

    .media-item.border-blue {
        background:blue;
    }
</style>