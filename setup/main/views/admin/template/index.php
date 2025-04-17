<style>
    svg{
        max-height:4rem;
        max-width:4rem;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <form method="GET">
            <div class="card">
                <div class="card-header bg-primary text-white">Panel</div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Theme</label>
                        <select class="form-control" name="theme_id" required>
                            <option value="0">All</option>
                            <?php 
                                $get = $this->db->get_where('ab_themes',['status'=>1]);
                                foreach($get->result() as $row){
                                    $selected = $theme_id == $row->id ? 'selected' : '';
                                    echo '<option value="'.$row->id.'" '.$selected.'>'.$row->title.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                </div>
            </div>
        </form>
    </div>
    <?php if(isset($theme_id)){ ?>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-info text-white">Add Template</div>
            <div class="card-body">
                <?php if($this->session->flashdata('success')): ?>
    <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
<?php endif; ?>
<?php if($this->session->flashdata('error')): ?>
    <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
<?php endif; ?>

<form method="POST" action="<?php echo base_url('admin/template_save'); ?>" id="themeForm" novalidate>
    <input type="hidden" name="theme_id" value="<?php echo htmlspecialchars($theme_id); ?>">
    
    <div class="form-group">
        <label for="category">Category</label>
        <select class="form-control" name="category" id="category" required>
            <option value="">Select Category</option>
            <?php 
                $get = $this->BlockCategory->getActiveBlockCategories();
                foreach($get->result() as $row){
                    $selected = (set_value('category') == $row->id) ? 'selected' : '';
                    echo '<option value="'.htmlspecialchars($row->id).'" '.$selected.'>'.htmlspecialchars($row->name).'</option>';
                }
            ?>
        </select>
        <?php echo form_error('category', '<div class="invalid-feedback">', '</div>'); ?>
    </div>

    <div class="form-group">
        <label for="label">Label</label>
        <input type="text" name="label" id="label" class="form-control" value="<?php echo set_value('label'); ?>" required maxlength="100">
        <?php echo form_error('label', '<div class="invalid-feedback">', '</div>'); ?>
    </div>

    <!--<div class="form-group">-->
    <!--    <label for="media">Media</label>-->
    <!--    <input type="text" name="media" id="media" class="form-control" value="<?php echo set_value('media'); ?>" required>-->
    <!--    <?php echo form_error('media', '<div class="invalid-feedback">', '</div>'); ?>-->
    <!--</div>-->

    <div class="form-group">
        <label for="content">Content</label>
        <textarea name="content" id="content" class="form-control" required rows="4"><?php echo set_value('content'); ?></textarea>
        <?php echo form_error('content', '<div class="invalid-feedback">', '</div>'); ?>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-sm btn-success">Submit</button>
    </div>
</form>

<!-- Client-side validation with JavaScript for Bootstrap 4.6 -->
<script>
// (function() {
//     'use strict';
//     window.addEventListener('load', function() {
//         var form = document.getElementById('themeForm');
//         form.addEventListener('submit', function(event) {
//             let isValid = true;
            
//             form.querySelectorAll('[required]').forEach(function(element) {
//                 if (!element.value.trim()) {
//                     isValid = false;
//                     element.classList.add('is-invalid');
//                 } else {
//                     element.classList.remove('is-invalid');
//                 }
//             });

//             const mediaInput = document.getElementById('media');
//             const urlPattern = /^(https?:\/\/)?([\w\d-]+\.)+[\w\d]{2,}(\/.*)?$/i;
//             if (mediaInput.value && !urlPattern.test(mediaInput.value)) {
//                 isValid = false;
//                 mediaInput.classList.add('is-invalid');
//             }

//             if (!isValid) {
//                 event.preventDefault();
//                 event.stopPropagation();
//             }
            
//             form.classList.add('was-validated');
//         }, false);
//     }, false);
// })();
</script>

<style>
.invalid-feedback {
    display: none;
}
.was-validated .form-control:invalid,
.form-control.is-invalid {
    border-color: #dc3545;
}
.was-validated .form-control:invalid ~ .invalid-feedback,
.form-control.is-invalid ~ .invalid-feedback {
    display: block;
}
</style>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card-header bg-success">
            <div class="card-title text-white">Templates</div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Category</th>
                        <th>label</th>
                        <th>Media</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $i = 1;
                        $get = $this->block->getActiveBlocks($theme_id);
                        foreach($get->result() as $row){
                            echo '<tr>
                                    <td>'.$i++.'</td>
                                    <td>'.$row->category.'</td>
                                    <td>'.$row->label.'</td>
                                    <td><svg xmlns="http://www.w3.org/2000/svg" width="300" height="300" viewBox="0 0 300 300">
  <rect width="100%" height="100%" fill="#f0f0f0" />
  <text x="50%" y="50%" font-family="Arial" font-size="40" fill="#333" text-anchor="middle" alignment-baseline="middle">
    '.$row->label.'
</text>
</svg></td>
                                    <td>
                                        <button onclick="setIframe('.$row->blockid.')" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                          View Block
                                        </button>
                                    </td>
                                    
                                </tr>';
                        }
                    ?>
                    
                </tbody>
            </table>
        </div>
    </div>
    <?php } ?>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg m-0" role="document">
    <div class="modal-content" style="width:99vw;height:98vh">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Template Preview</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div style="text-align:right"><a target="_blank" href="#" id="browserUrl" class="btn btn-sm btn-info">View in Browser</a></div>
        <iframe src="#" width="100%" height="100%"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
    function setIframe(id){
        var url = "<?php echo base_url('admin/viewBlock/'); ?>"+id;
        $('iframe').attr('src',url);
        $('#browserUrl').attr('href',url);
    }
</script>


