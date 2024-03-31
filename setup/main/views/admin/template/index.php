<style>
    svg{
        max-height:4rem;
        max-width:4rem;
    }
</style>
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-info text-white">Add Template</div>
            <div class="card-body">
                <form method="POST" action="">
                    <div class="form-group">
                        <label>Theme</label>
                        <select class="form-control" name="theme_id" required>
                            <option value="0">All</option>
                            <?php 
                                $get = $this->db->get_where('ab_themes',['status'=>1]);
                                foreach($get->result() as $row){
                                    echo '<option value="'.$row->id.'">'.$row->title.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" required>
                            <?php 
                                $get = $this->BlockCategory->getActiveBlockCategories();
                                foreach($get->result() as $row){
                                    echo '<option value="'.$row->id.'">'.$row->name.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Label</label>
                        <input type="text" name="label" class="form-control" requried>
                    </div>
                    <div class="form-group">
                        <label>Media</label>
                        <input type="text" name="media" class="form-control" requried>
                    </div>
                    <div class="form-group">
                        <label>Content</label>
                        <textarea name="content" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-sm btn-success">Submit</button>
                    </div>
                </form>
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
                        $get = $this->block->getActiveBlocks();
                        foreach($get->result() as $row){
                            echo '<tr>
                                    <td>'.$i++.'</td>
                                    <td>'.$row->category.'</td>
                                    <td>'.$row->label.'</td>
                                    <td>'.$row->media.'</td>
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


