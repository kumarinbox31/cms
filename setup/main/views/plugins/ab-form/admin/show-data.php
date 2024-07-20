<?php
$id = intval(@$_GET['id']);
$get = $this->db->order_by('id','desc')->get_where('form_data',['form_id'=>$id]);
?>
<a download href="<?php echo base_url('admin/downloadFormData/').$id; ?>" class="btn btn-sm btn-primary"><i class="fa fa-download"></i></a>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Timestamp</th>
            <th>Show</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $i = 1;
            foreach($get->result() as $row){
                echo '<tr>
                        <td>'.$i++.'</td>
                        <td>'.$row->created_at.'</td>
                        <td><a href="'.base_url('admin/plugin/ab-form?page=view-signle&id=').$row->id.'" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a></td>
                        <td>
                            
                        </td>
                    </tr>';
            }
        ?>
    </tbody>
</table>