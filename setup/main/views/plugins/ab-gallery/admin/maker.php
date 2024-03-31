<?php 
 $id = intval(@$_GET['id']);
 $get = $this->ServiceModel->getServiceById($id);
 if($get->num_rows()){
     $row = $get->row();
     $name = htmlspecialchars($row->title);
     $content = $row->content != '' ? json_decode($row->content) : '' ;
?>
<style>
    .add-slide{
        background: green;
        color: white;
        padding: 2.5rem;
        display:inline-block;
        cursor:pointer;
        text-decoration:none;
    }
    .add-slide:hover{
        color:white;
    }
    .add-slide > i{
        font-size: 2rem;
    }
    .slide-item{
        display: inline-block;
        width: 14rem;
        height: 8rem;
        /*border: 2px solid black;*/
        background: green;
        cursor:pointer;
        margin-bottom:3rem;
    }
    .controls{
        position:relative;
        margin-top:-9rem;
    }
    .controls > .dropdown{
        position: absolute;
        top: 0;
        right: 0;
        background: none!important;
        color: black;
        border: none!important;
        font-size: 1.5rem;
        font-weight: bold;
    }
    .controls > .dropdown:hover{
        background:none;
        border:none;
    }
</style>
<div id="msg"></div>
<form method="POST" action="" id="save-main-slider-data">
    <input type="hidden" name="action" value="update-service">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
<div class="card">
    <div class="card-header bg-primary text-white d-block">
        <div class="row">
            <div class="col-md-4 d-flex">
                <a href="<?php echo base_url('admin/plugin/ab-gallery'); ?>" class="h6 text-white" style="margin-right:0.5rem;"><i class="fa fa-home"></i> Dashboard</a>
                >
                <a href="<?php echo base_url('admin/plugin/ab-gallery?page=maker&id=').$id; ?>" class="h6 text-white" style="margin-left:0.5rem;">
                    <i class="fa fa-image"></i> <?php echo $name; ?></a>
            </div>
            <div class="col-md-4 text-center">
                <a href="<?php echo base_url('admin/plugin/ab-galler'); ?>"><img src="https://mynew.webfire.in/wp-content/uploads/2024/01/png-logo.png" width="150"></a>
            </div>
            <div class="col-md-4 text-end" style="text-align:right;">
                <a href="www.webfire.in" class="btn btn-sm text-white ">Help</a>
            </div>
        </div>
    </div>
    <div class="card-body text-white">
        <div id="options" style="margin-bottom:3rem;display:none;">
            <div class="row">
                
                <div class="col-md-3 text-center">
                    <div class="slide-item" id="create-blank-slide">
                        <img src="https://via.placeholder.com/150x150" style="width:100%;height:9rem;">
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <input type="hidden" id="selected-image" >
                    <div class="slide-item media-manager" style="padding-top:2rem;font-size:2rem;"
                    data-value="#selected-image" data-preview="#preview" data-accept=".jpg,.png" data-multiple="false">
                        <i class="fa fa-upload"></i>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            
            <div class="col-md-3 text-center">
                <a class="add-slide" id="add-slide">
                    <i class="fa fa-plus"></i>
                    <center>Add Item</center>
                </a>
            </div>
            <?php 
               $get = $this->ServiceModel->getService(['type'=>'ab-gallery-item','parent'=>intval(@$_GET['id']),'admin_id'=>CLIENT_ID]);
                foreach($get->result() as $row){
                    $image = $row->image == '' ? 'https://via.placeholder.com/150x150' : $row->image;
            ?>
            <div class="col-md-3 text-center">
                <div class="slide-item">
                    <img src="<?php echo $image; ?>" style="width:100%;height:9rem;">
                    <div class="controls">
                        <div class="dropdown">
                          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span>&#8286;</span>
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="<?php echo base_url('admin/plugin/ab-gallery?page=slide-edit&id='.$id.'&slide-id=').$row->id; ?>">Edit</a>
                            <a class="dropdown-item" onclick="return confirm('are you sure?');" href="<?php echo base_url('admin/delete-service/').$row->id?>">Delete</a>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                }
            ?>
        </div>
    </div>
    <div class="card-footer bg-dark mt-3" style="text-align:right;">
        <a href="<?php echo base_url('admin/plugin/ab-slider?page=preview&id=').$id; ?>" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Preview</a>
        <button type="submit" class="btn btn-sm btn-success"><i calss="fa fa-save"></i> Save</button>
    </div>
</div>
<style>
.tabbable-responsive {
  display: block;
  min-width: 100%;
  overflow-x: auto;
  margin: 0px -21px -13px -21px;
}

.tabbable {
    min-width: 100%;
    
    .nav-tabs {
      white-space: nowrap;
      display: inline-block;
      min-width: 100%;
      
      // Some tweaks for card-header
      padding: 0px 21px;
      
      .nav-item {
        display: inline-block;
        
        .nav-link {
          display: inline-block;
        }
      }
    }
}
small {
  font-size: 15px;
}
.card {
  box-shadow: 0 5px 15px -5px rgba(0, 0, 0, 0.15);
}
a {
  color: #0da58e;
  
  &:hover {
    color: #075e51;
  }
}
.text-dark {
  text-decoration: none !important;
}
.elmahio-ad {
  background: #fff;
  border: 1px solid #ddd;
  border-radius: 4px;
  overflow: hidden;
  
  .logo {
    background: #0da58e;
    width: 60px;
    height: 60px;
    text-align: center;
    line-height: 52px;
    img {
      width: 50px;
    }
  }
  .motto {
    width: 180px;
    font-size: 15px;
    font-weight: bolder;
    padding: 15px;
  }
}
body{
    font-size:1rem;
}
</style>
<div class="container my-3">
  <div id="data_msg"></div>
  <div class="card">
    <div class="card-header d-block">
      
      <div class="d-flex">
        <div class="title">
          <h2><?php echo $name; ?> <small>Id : <?php echo $id; ?></small></h2>
        </div>
      </div>
      
      <!-- START TABS DIV -->
      <div class="tabbable-responsive">
        <div class="tabbable">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">General</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="second-tab" data-toggle="tab" href="#second" role="tab" aria-controls="second" aria-selected="false">Size</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="third-tab" data-toggle="tab" href="#third" role="tab" aria-controls="third" aria-selected="false">Controls</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="fourth-tab" data-toggle="tab" href="#fourth" role="tab" aria-controls="fourth" aria-selected="false">Animations</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="fifth-tab" data-toggle="tab" href="#fifth" role="tab" aria-controls="fifth" aria-selected="false">Autoplay</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="sixth-tab" data-toggle="tab" href="#sixth" role="tab" aria-controls="sixth" aria-selected="false">Custom Css</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="card-body" style="background:#eff4f7">
      <div class="tab-content" >
        <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
            <div class="card">
                <div class="card-header">General Setting</div>
                <div class="card-body">
                    <div class="form-group col-md-4">
                        <label>Name</label>
                        <input type="text" name="title" class="form-control" required placeholder="Enter title" value="<?php echo $name; ?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="second" role="tabpanel" aria-labelledby="second-tab">
            <div class="card">
                <div class="card-header">Sizes</div>
                <div class="card-body row">
                    <div class="form-group col-md-3">
                        <label>Width</label>
                        <input type="text" name="content[size][width]" value="<?php echo @$content->size->width ?? '1920px'; ?>" class="form-control" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Height</label>
                        <input type="text" name="content[size][height]" value="<?php echo @$content->size->height ?? '800px' ?>" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Layout</div>
                <div class="card-body ">
                    <div class="form-group col-md-4">
                        <select class="form-control select2" name="content[layout]">
                            <option <?php echo @$content->layout == 'Boxed' ? 'selected' : ''; ?>>Boxed</option>
                            <option <?php echo @$content->layout == 'Full Width' ? 'selected' : ''; ?>>Full Width</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="tab-pane fade" id="third" role="tabpanel" aria-labelledby="third-tab">
          <h5 class="card-title">Third Tab header</h5>
          <p class="card-text">Vestibulum neque nunc, ullamcorper et laoreet in, dictum vitae nisi. Morbi scelerisque cursus lobortis. Fusce a leo elit. In hac habitasse platea dictumst. Curabitur aliquet nunc sed tellus rutrum ornare. Mauris euismod cursus ligula, nec mollis lorem sodales vel. Proin mollis posuere nisl a pretium. Aenean sit amet nibh quis nisl pharetra malesuada convallis id leo.</p>
        </div>
        <div class="tab-pane fade" id="fourth" role="tabpanel" aria-labelledby="fourth-tab">
          <h5 class="card-title">Fourth Tab header</h5>
          <p class="card-text">Nulla dignissim justo sed nulla dignissim pellentesque. Maecenas rhoncus faucibus finibus. Mauris eget tincidunt metus. Morbi bibendum nunc sed nisl aliquam, sit amet lacinia lectus pharetra. Cras accumsan convallis risus. Morbi nisi libero, consequat eget leo vel, finibus rhoncus nulla. Mauris tempus risus quis efficitur sollicitudin. Suspendisse potenti. Quisque ut leo interdum ipsum tristique ultrices.</p>
        </div>
        <div class="tab-pane fade" id="fifth" role="tabpanel" aria-labelledby="fifth-tab">
          <h5 class="card-title">Fifth Tab header</h5>
          <p class="card-text">Nunc lacinia sodales ex, in mattis nulla eleifend in. Quisque molestie, dolor non egestas ornare, diam sapien accumsan erat, non malesuada nulla est ac purus. Donec pharetra molestie leo sit amet posuere. Etiam feugiat mi nisi, id semper neque dignissim ut. Praesent vitae accumsan eros. Curabitur a nisi non arcu suscipit rutrum at ut orci. Praesent nec eros eros. Quisque tempus neque ut nibh viverra, ut commodo dolor dapibus.</p>
        </div>
        <div class="tab-pane fade" id="sixth" role="tabpanel" aria-labelledby="sixth-tab">
            <textarea name="content[css]" class="form-control" rows="10" placeholder="Enter css code"><?php echo @$content->css; ?></textarea>
        </div>
      </div>
      <!-- END TABS DIV -->
    </div>
  </div>
</div>
</form>
<?php 
add_action('ab-admin-footer',function(){
    ?>
    <script>
    $(document).ready(function() {
        $('#save-main-slider-data').submit(function(e){
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "<?php echo current_url(); ?>",
                type: "POST",
                dataType: "JSON",
                data: formData,
                processData: false,  // Prevent jQuery from automatically processing data
                contentType: false,  // Prevent jQuery from setting contentType
                beforeSend: function(){
                    // You can add loading indicators or other tasks here
                },
                success: function(res){
                    if(res.status){
                        $('#data_msg').html('<div class="alert alert-success">Slider data saved successfully!</div>');
                    } else {
                        $('#data_msg').html('<div class="alert alert-danger">Failed to save form data or no changes.</div>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    $('#data_msg').html('Error: ' + error);
                }
            });
        });
    });
    $('#add-slide').click(function(){
        $('#options').toggle(); // Toggle the visibility of the content
        $(this).find('.fa').toggleClass('fa-plus fa-times');
        var centerElement = $(this).find('center');
        if (centerElement.text() === 'Add Slide') {
            centerElement.text('Close');
        } else {
            centerElement.text('Add Slide');
        }
    });
    $('#create-blank-slide').on('click', function() {
        var c = confirm('Are you sure?');
        if(!c){
            return false;
        }
        createNewSlide();
    });
</script>
<script>
    var target = document.getElementById('selected-image');
    // Create an observer instance
    var observer = new MutationObserver(function(mutations) {
      mutations.forEach(function(mutation) {
        if (mutation.type === 'attributes' && mutation.attributeName === 'value') {
          // Call your function when the value of #selected-image changes
          createNewSlide();
        }
      });
    });
    // Configuration of the observer
    var config = { attributes: true };
    
    // Start observing the target node for configured mutations
    observer.observe(target, config);

    function createNewSlide(){
        $.ajax({
            url: "<?php echo current_url(); ?>",
            type: "POST",
            dataType: "JSON",
            data: {
                action: "add-service",
                type: "ab-gallery-item",
                parent: "<?php echo intval(@$_GET['id']); ?>",
                image: $('#selected-image').val(),
            },
            beforeSend: function(){
                // You can add loading indicators or other tasks here
            },
            success: function(res){
                if(res.status){
                    $('#msg').html('<div class="alert alert-success">New Item added successfully!</div>');
                    setTimeout(function(){
                        window.location.reload();
                    },2000);
                } else {
                    $('#msg').html('<div class="alert alert-danger">Something went wrong.</div>');
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                $('#msg').html('Error: ' + error);
            }
        });
    }
</script>
    <?
});
?>

<?php 
}
?>