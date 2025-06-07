<div class="col-md-4">
    <div class="card">
        <div class="card-header bg-success text-white">
            Create Website
        </div>
        <div class="card-body">
            <a href="/admin/website/create" class="btn btn-sm btn-info">Create</a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header bg-primary text-white">List Website(s) </div>
    <div class="card-body table-responsive">
        <table  class="table  table-boredred table-striped datatable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Action</th>
                    <th>Domain</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Mobile</th>
                    <th>Address</th>
                    <th>Start Date</th>
                    <th>Expiry Date</th>
                    <th>Plan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php 
$i = 1;
$this->db->order_by('end_time','asc');
$get = $this->website->get(['rid' => RID]);
foreach($get->result() as $w) {
    $token = generateJWT($w->_email, $w->id, 'Abhijeet#12!00');
    $status_icon = $w->status ? 'on' : 'off';
    $status_class = $w->status ? 'success' : 'danger';
    $new_status = $w->status ? 0 : 1;

    // Status labels
    $now = time();
    $end = $w->end_time;
    $daysLeft = floor(($end - $now) / (60 * 60 * 24));
    
    $row_class = '';
    $badge = '';

    if ($end < $now) {
        $row_class = 'table-danger';
        $badge = '<span class="badge bg-danger text-white">Expired</span>';
    } elseif ($daysLeft <= 30) {
        $row_class = 'table-warning';
        $badge = '<span class="badge bg-warning text-dark">Expiring in '.$daysLeft.' day(s)</span>';
    }elseif(empty($w->status)){
        $row_class = 'table-danger';
        $badge = '<span class="badge bg-danger text-white">Inactive</span>';
    } else {
        $row_class = 'table-success';
        $badge = '<span class="badge bg-success text-white">Active</span>';
    }
    $plan = $this->db->get_where('plan',['id'=>$w->planid]);
    $plan_name = '<span class="badge bg-warning text-white">Not Found</span>';
    if($plan->num_rows()){
        $plan = $plan->row();
        $plan_name = '<span class="badge bg-primary text-white">'.ucwords($plan->plan_name).'</span>';
    }

    echo '<tr class="'.$row_class.'">
            <td>'.$i++.'</td>
            <td>
                <a target="_blank" href="https://'.$w->domain.'/web/direct_login?_token='.$token.'" class="btn btn-sm btn-warning" title="Login"><i class="fa fa-sign-in"></i></a>
                <a href="'.base_url('admin/website/edit?id=').$w->id.'" class="btn btn-sm btn-info" title="Edit"><i class="fa fa-edit"></i></a>
                <a onclick="return confirm(\'Are you sure ?\');" href="'.base_url('admin/change_status?id=').$w->id.'&new_status='.$new_status.'" class="btn btn-sm btn-'.$status_class.'" title="Toggle Status">
                    <i class="fas fa-toggle-'.$status_icon.'"></i>
                </a>
            </td>
            <td><a target="_blank" href="https://'.$w->domain.'">'.$w->domain.'</a></td>
            <td>'.$w->name.'</td>
            <td>'.$w->_email.'</td>
            <td>'.$w->_pass.'</td>
            <td>'.$w->mobile.'</td>
            <td>'.$w->address.'</td>
            <td>'.date("d-m-Y", $w->start_time).'</td>
            <td>'.date("d-m-Y", $w->end_time).'</td>
            <td>'.$plan_name.'</td>
            <td>'.$badge.'</td>
        </tr>';
}
?>

            </tbody>
        </table>
    </div>
</div>
