<div class="card">
    <div class="card-header bg-primary text-white">Add Template</div>
    <div class="card-body row">
        <div class="col-md-4">
            
        </div>
        <div class="col-md-8">
            <div class="form-group">
                <label>Select Theme <div id="load"></div></label>
                <select class="form-control showTemplate">
                    <option value="0" data-path="">All</option>
                    <?php 
                        $get = $this->db->get_where('themes');
                        foreach($get->result() as $row){
                            echo '<option value="'.$row->id.'" data-path="'.$row->path.'">'.$row->title.'</option>';
                        }
                    ?>
                </select>
            </div>
            <div id="templates"></div>
        </div>
    </div>
</div>
<div class="modal fade cookie-box" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Please Wait</h5>
        <button type="button" id="close-button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="model-content">
       Processing....
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>




<script>
    $('.showTemplate').change(function(){
        var id = $(this).val();
        var path = $(this).find('option:selected').data('path');
        $.ajax({
            url:"<?php echo base_url('admin/load-templates'); ?>",
            type:"POST",
            dataType:"html",
            data:{id:id,path:path},
            beforeSend:function(){
                $('#load').html('<span class="text-info"><i class="fa fa-spinner fa-spin"></i> Please wait...</span>');
            },
            success:function(res){
                $('#templates').html(res);
                $('#load').html('<span class="text-success"><i class="fa fa-check"></i> Complete</span>');
            }
        });
    });
</script>