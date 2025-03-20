
<div class="row">
<div class="col-md-4">
<?php 
    $ci = &get_instance();
    $webPlanId = PLANID;
    $per = $ci->PlanModel->getPermissionValue('ab-payment-form');
    $get = $ci->ServiceModel->getServiceByType('ab-payment-form');
    
    // Check if the webPlanId is 0 or if the permission is valid and within the limit
    if (true || $webPlanId == 0 || (!empty($per['status']) && $per['permission_value'] > $get->num_rows())) {
?>
        <form class="card" method="POST">
            <input type="hidden" name="action" value="add-service">
            <input type="hidden" name="type" value="ab-payment-form">
            <div class="card-header bg-info text-white">Add New Payment Form</div>
            <div class="card-body">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Payment Gateway</label>
                    <select class="form-control" name="desc[pg]" required>
                        <option value="">Select Payment Gateway</option>
                        <option value="pg-razorpay">Razorpay</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Form</label>
                    <select class="form-control" name="desc[form]" required>
                        <option value="">Select Form</option>
                        <?php 
                            $forms = $ci->ServiceModel->getServiceByType('ab-form');
                            foreach($forms->result() as $form){
                                echo '<option value="'.$form->id.'">'.$form->title.'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-sm btn-danger">Save</button>
            </div>
        </form>
<?php 
    } else {
        echo '<div class="alert alert-danger">Quota Full!</div>';
    }
?>
</div>

<div class="col-md-8">
    <div class="card">
        <div class="card-header bg-primary text-white">All Payment Forms</div>
        <div class="card-body">
            <table class="table table-bordered table-striped datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Short-Code</th>
                        <th>Data</th>
                        <th>Statics</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $i = 1;
                        $ci = &get_instance();
                        foreach($get->result() as $row){
                            $p = $this->db->select('SUM(amount) as ttl, COUNT(amount) AS cn')
                                ->where('pg_form_id', $row->id)
                                ->where('status', 'pending')
                                ->get('ab_payment_data')
                                ->row();
                            $p_ttl = $p->ttl ?? 0;
                            $p_cnt = $p->cn ?? 0;
                            
                            $s = $this->db->select('SUM(amount) as ttl, COUNT(amount) AS cn')
                                ->where('pg_form_id', $row->id)
                                ->where('status', 'success')
                                ->get('ab_payment_data')
                                ->row();
                            $s_ttl = $s->ttl ?? 0;
                            $s_cnt = $s->cn ?? 0;
                            
                            $f = $this->db->select('SUM(amount) as ttl, COUNT(amount) AS cn')
                                ->where('pg_form_id', $row->id)
                                ->where('status', 'failed')
                                ->get('ab_payment_data')
                                ->row();
                            $f_ttl = $f->ttl ?? 0;
                            $f_cnt = $f->cn ?? 0;

                             echo '<tr>
                                        <td>'.$i++.'</td>
                                        <td>'.$row->title.'</td>
                                        <td>[ab-payment-form id='.$row->id.']</td>
                                        <td>
                                            <a href="'.base_url('admin/plugin/ab-payment-form?page=show-data&id=').$row->id.'" class="btn btn-sm btn-primary"><i class="fa fa-list"></i></a>
                                        </td>
                                        <td>
                                            <b>Pending :</b> ₹ '.intval($p_ttl).' ['.intval($p_cnt).']<br>
                                            <b>Success :</b> ₹ '.intval($s_ttl).' ['.intval($s_cnt).']<br>
                                            <b>Failed :</b> ₹ '.intval($f_ttl).' ['.intval($f_cnt).']<br>
                                        </td>
                                        
                                        <td>
                                            <a onclick="return confirm('."'Are you sure ?'".');" href="'.base_url('admin/delete-service/').$row->id.'" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                </tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>