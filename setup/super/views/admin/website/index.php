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
                    <th>Expired</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $i=1;
                    $this->db->order_by('id','desc');
                    $get = $this->website->get(['rid'=>RID]);
                    foreach($get->result() as $w){
                        $bg = $w->status?'' : 'bg-danger text-white';
                        // $token = base64_encode(json_encode(['email' => $w->_email, 'website_id' => $w->id, 'exp' => time() + 3600]));
                        $token = generateJWT($w->_email,$w->id,'Abhijeet#12!00');
                        $status_icon = $w->status ? 'on' : 'off';
                        $status_class = $w->status ? 'success' : 'danger';
                        $new_status = $w->status ? 0 : 1;
                        $expired = $w->end_date < time() ? 'Yes' : 'No';
                        echo '<tr class="'.$bg.'">
                                <td>'.$i++.'</td>
                                <td><a target="_blank" href="https://'.$w->domain.'/web/direct_login?_token='.$token.'" class="btn btn-sm btn-warning"><i class="fa fa-sign-in"></i></a>
                                <a href="'.base_url('admin/website/edit?id=').$w->id.'" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                <a  onclick="return confirm('."'Are you sure ?'".');" href="'.base_url('admin/change_status?id=').$w->id.'&new_status='.$new_status.'" class="btn btn-sm btn-'.$status_class.'"><i class="fas fa-toggle-'.$status_icon.'"></i></a>
                                </td>
                                <td><a target="_blank" href="https://'.$w->domain.'">'.$w->domain.'</a></td>
                                <td>'.$w->name.'</td>
                                <td>'.$w->_email.'</td>
                                <td>'.$w->_pass.'</td>
                                <td>'.$w->mobile.'</td>
                                <td>'.$w->address.'</td>
                                <td>'.date("d-m-Y",$w->start_date).'</td>
                                <td>'.date("d-m-Y",$w->end_date).'</td>
                                <td>'.$expired.'</td>
                            </tr>';
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
