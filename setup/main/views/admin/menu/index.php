<div class="row">
    <div class="col-md-4">
        <form method="POST" action="">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Add Menu
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Menu Name</label>
                        <input type="text" name="label" class="form-control" required placeholder="Enter menu name">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" name="action" value="add-menu" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Submit</button>
                </div>
            </div>
        </form>
    </div>
    
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-warning text-white">
                All Menu
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>ShortCode</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $i = 1;
                            $get = $this->MenuModel->get(['admin_id'=>CLIENT_ID]);
                            if($get->num_rows()){
                                foreach($get->result() as $row){
                                    echo '<tr>
                                            <td>'.$i++.'</td>
                                            <td>'.$row->label.'</td>
                                            <td>'.$row->status.'</td>
                                            <td>[navbar id='.($row->id).' type=verticle]</td>
                                            <td>
                                                <a href="'.base_url('admin/menu/item/').($row->id).'" class="btn btn-sm btn-primary"><i class="fa fa-cog"></i></a>
                                            </td>
                                        </tr>';
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>