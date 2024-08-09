<?php 
    $id = intval(@$_GET['blockid']);
    $path = htmlspecialchars(@$_GET['path']);
    $get = $this->BlockModel->get(['id'=>$id]);
    if($get->num_rows()){
        $row = $get->row();
?>

<form method="POST" action="<?php echo base_url('admin/update-template'); ?>">
    <input type="hidden" name="id" value="<?php $id ?>">
<div class="card">
    <div class="card-header bg-primary text-white">
        Edit Theme Template
    </div>
    <div class="card-body">
        <div class="form-group col-md-12">
            <label>Content</label>
            <textarea name="content" class="form-control ckeditor" rows="10" required><?php echo $row->content; ?></textarea>
        </div>
    </div>
    <div class="card-footer">
       <button type="submit" class="btn btn-sm btn-primary">Submit</button> 
    </div>
</div>
</form>
<?php 
}
?>
<!--<script src="https://cdn.ckeditor.com/4.4.5/full-all/ckeditor.js"></script>-->
