<?php
$id = intval(@$_GET['id']);
$get = $this->db->order_by('id','desc')->get_where('ab_payment_data',['pg_form_id'=>$id]);
?>
<?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger">
        <?= htmlspecialchars($this->session->flashdata('error'), ENT_QUOTES, 'UTF-8'); ?>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success">
        <?= htmlspecialchars($this->session->flashdata('success'), ENT_QUOTES, 'UTF-8'); ?>
    </div>
<?php endif; ?>

<a download href="<?php echo base_url('admin/downloadFormData/').$id.'/payment'; ?>" class="btn btn-sm btn-primary"><i class="fa fa-download"></i></a>
<table class="table table-bordered table-striped datatable">
    <thead>
        <tr>
            <th>#</th>
            <th>Txn ID</th>
            <th>Amount</th>
            <th>Status</th>
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
                        <td>'.$row->txn_id.'</td>
                        <td>'.$row->amount.'</td>
                        <td>'.ucwords($row->status).'</td>
                        <td>'.$row->created_at.'</td>
                        <td><a href="'.base_url('admin/plugin/ab-payment-form?page=view-signle&id=').$row->id.'" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a></td>
                        <td>
                            <a onclick="return confirm('."'Are you sure ?'".');" href="'.base_url('admin/plugin/ab-payment-form?page=delete-data&pg_form_id='.$id.'&id=').$row->id.'" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>';
            }
        ?>
    </tbody>
</table>