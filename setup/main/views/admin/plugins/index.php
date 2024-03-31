<div class="row">
    <?php 
        $get = $this->db->get_where('plugins',['status'=>1]);
        foreach($get->result() as $row){
            ?>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                           <h4><?=$row->name;?></h4>
                        </div>
                        <div class="card-body text-center">
                            <img src="<?=base_url('public/admin/Gear.gif');?>">
                        </div>
                        <div class="card-footer text-center">
                            <a href="<?php echo base_url('admin/install-plugin/'.$row->id); ?>" class="btn btn-sm btn-primary">Install</a>
                        </div>
                    </div>
                </div>
            <?php
        }
    ?>
</div>