<?php 
$page = $this->PageModel->get(['id'=>$this->uri->segment('4')]);
if($page->num_rows()){
    $page = $page->row();
    // print_r($page);exit;
}else{
    die('something went wrong');
}
?>
<style>
    .pull-right{
        float:right;
    }
</style>
<div class="card">
    <div class="card-header bg-info text-white d-block">Update Page Details
    <a href="<?php echo base_url('admin/page'); ?>" class="btn btn-primary btn-sm pull-right">Back</a>
    </div>
    <div class="card-body">
        <?php 
            if($msg = $this->session->flashdata('success_msg')){
                echo '<div class="alert alert-success">'.$msg.'</div>';
            }
            if($msg = $this->session->flashdata('error_msg')){
                echo '<div class="alert alert-danger">'.$msg.'</div>';
            }
        ?>
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?php echo $page->id; ?>">
    <div class="form-group">
        <label>Page Name</label>
        <input type="text" name="page_name" class="form-control" value="<?php echo $page->page_name; ?>" required>
    </div>
    <div class="form-group">
        <label>URI</label>
        <input type="text" name="uri" class="form-control" value="<?php echo $page->uri; ?>" required>
    </div>
    <div class="form-group">
        <label>URL</label>
        <input type="text" name="url" class="form-control" value="<?php echo $page->url; ?>" >
    </div>
    <div class="form-group">
        <button type="submit" name="action" value="update-page-details" class="btn btn-sm btn-primary">Submit</button>
    </div>
</form>
    </div>
</div>
