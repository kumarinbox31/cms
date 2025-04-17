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
        <table  class="table  table-boredred table-striped " id="data_table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Login</th>
                    <th>Edit</th>
                    <th>Domain</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Mobile</th>
                    <th>Address</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php 
                error_reporting(E_ALL);ini_set('display_errors',1);
                    $i=1;
                    $this->db->order_by('id','desc');
                    $get = $this->website->get(['rid'=>RID]);
                    foreach($get->result() as $w){
                        $bg = $w->status?'' : 'bg-danger text-white';
                        // $token = base64_encode(json_encode(['email' => $w->_email, 'website_id' => $w->id, 'exp' => time() + 3600]));
                        $token = generateJWT($w->_email,$w->id,'Abhijeet#12!00');

                        echo '<tr class="'.$bg.'">
                                <td>'.$i++.'</td>
                                <td><a target="_blank" href="https://'.$w->domain.'/web/direct_login?_token='.$token.'" class="btn btn-sm btn-warning"><i class="fa fa-sign-in"></i></a></td>
                                <td><a href="'.base_url('admin/website/edit?id=').$w->id.'" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a></td>
                                <td><a target="_blank" href="https://'.$w->domain.'">'.$w->domain.'</a></td>
                                <td>'.$w->name.'</td>
                                <td>'.$w->_email.'</td>
                                <td>'.$w->_pass.'</td>
                                <td>'.$w->mobile.'</td>
                                <td>'.$w->address.'</td>
                                
                            </tr>';
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>