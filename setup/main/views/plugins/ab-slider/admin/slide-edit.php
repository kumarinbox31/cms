<?php 
 $id = intval(@$_GET['id']);
 $slide_id = intval(@$_GET['slide-id']);
 $get = $this->ServiceModel->getServiceById($id);
 if($get->num_rows()){
     $row = $get->row();
     $name = htmlspecialchars($row->title);
     
     $slide = $this->ServiceModel->getServiceById($slide_id)->row();
?>
<style>
    .ck-content > *{
        color:black;
    }
</style>
<div id="msg"></div>
<form method="POST" action="" id="save-main-slider-data">
    <input type="hidden" name="action" value="update-service">
    <input type="hidden" name="id" value="<?php echo $slide_id; ?>">
<div class="card">
    <div class="card-header bg-primary text-white d-block">
        <div class="row">
            <div class="col-md-4 d-flex">
                <a href="<?php echo base_url('admin/plugin/ab-slider?page=dashboard'); ?>" class="h6 text-white" style="margin-right:0.5rem;"><i class="fa fa-home"></i> Dashboard</a>
                >
                <a href="<?php echo base_url('admin/plugin/ab-slider?page=builder&id=').$id; ?>" class="h6 text-white" style="margin-left:0.5rem;">
                    <i class="fa fa-image"></i> <?php echo $name; ?></a>
            </div>
            <div class="col-md-4 text-center">
                <a href="<?php echo base_url('admin/plugin/ab-slider'); ?>"><img src="https://mynew.webfire.in/wp-content/uploads/2024/01/png-logo.png" width="150"></a>
            </div>
            <div class="col-md-4 text-end" style="text-align:right;">
                <a href="www.webfire.in" class="btn btn-sm text-white ">Help</a>
            </div>
        </div>
    </div>
    <div class="card-body text-white">
        <textarea name="content" class="form-control ckeditor"  placeholder="Enter content"><?php echo @$slide->content; ?></textarea>
    </div>
    <div class="card-footer bg-dark mt-3" style="text-align:right;">
        <a href="<?php echo base_url('admin/plugin/ab-slider?page=preview&id=').$id; ?>" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Preview</a>
        <button type="submit" class="btn btn-sm btn-success"><i calss="fa fa-save"></i> Save</button>
    </div>
</div>

</form>
<?php 
}
?>
   