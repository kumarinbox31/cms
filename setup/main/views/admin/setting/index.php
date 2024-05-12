<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="ik ik-edit bg-blue"></i>
                <div class="d-inline">
                    <h5>Website Setting</h5>
                    <!--<span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span>-->
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <nav class="breadcrumb-container" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="../"><i class="ik ik-home"></i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="#">Setting</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Website Setting</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<style>
    .bootstrap-tagsinput{
        width:100%;
    }
</style>
<div class="row">
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-info"><h3 class="text-white">Website Info</h3></div>
            <div class="card-body">
                <form class="forms-sample" method="post" action="">
                    <div class="form-group">
                        <label for="websitetitle">Title</label>
                        <input type="text" class="form-control" id="websitetitle" name="title" placeholder="Website Title" value="<?php echo @$get->title?>">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="desc" placeholder="Description"><?php echo @$get->desc?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="input">Keywords</label>
                        <input type="text" id="tags" name="keywords" class="form-control inputTags" placeholder="Enter Keywords" value="<?php echo @$get->keywords?>">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-danger">Cancel</button>
                  </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white"><h3 class="text-white">Logo</h3></div>
            <div class="card-body">
                <form class="forms-sample" method="post" action="" enctype="multipart/form-data">
                    <input type="hidden" name="logo" value="<?php echo @$get->logo ?>" id="logo">
                    <style>
                        .preview-logo > *{
                            width:200px;
                            height:100px;
                        }
                    </style>
                    <div class="form-group preview-logo media-manager" data-value="#logo" data-preview=".preview-logo" data-accept=".jpg,.png" data-multiple="false">
                        <img src="<?php echo @$get->logo ?>">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-danger">Cancel</button>
                  </form>
            </div>
        </div>
    </div>
    
</div>