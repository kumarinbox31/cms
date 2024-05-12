<style>
    frame {
      border: none;
    }
</style>
<div class="row">
    <?php 
        $get = $this->db->get_where('themes',['status'=>1]);
        foreach($get->result() as $row){
            $preview = base_url("public/theme/$row->path/$row->preview");
            if($row->preview == ''){
                $preview = base_url('public/admin/gear-new.gif');
            }
    ?>
    <div class="col-md-3">
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="text-white"><?php echo $row->title; ?></h5>
            </div>
            <div class="card-body">
                <img src="<?php echo $preview; ?>" style="width:100%;height:150px;">
            </div>
            <div class="card-footer">
                <?php 
                if(THEMEPATH == $row->path){
                    echo '<span class="btn btn-sm btn-success" >Active</span>';
                }else{
                ?>
                <a href="javascript:;" class="btn btn-sm btn-primary setTheme" data-theme-id="<?php echo $row->id; ?>">Set Theme</a>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php 
        }
    ?>
</div>

<script>
    $('.setTheme').click(function(){
        var theme_id = $(this).data('theme-id');
        $.ajax({
            url:"<?php echo base_url('admin/ajax'); ?>",
            type:"POST",
            dataType:"JSON",
            data:{action:"setTheme",themeid:theme_id},
            success:function(res){
                if(res.status){
                    alert(res.msg);
                    setTimeout(function(){
                        window.location.reload();
                    },2000);
                }
            }
        });
    });
</script>
