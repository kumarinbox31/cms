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
                            <?php 
                                $installed = $this->db->get_where('ab_plugin_installed', ['plugin_id' => $row->id, 'admin_id' => CLIENT_ID])->row();
                                if ($installed && $installed->status == 1): 
                            ?>
                                <span class="badge badge-success p-2" style="font-size: 14px;">Active</span>
                            <?php else: ?>
                                <a href="<?php echo base_url('admin/install-plugin/'.$row->id); ?>" class="btn btn-sm btn-primary">Install</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php
        }
    ?>
</div>