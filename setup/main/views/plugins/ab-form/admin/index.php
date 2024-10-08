
<div class="row">
<div class="col-md-4">
<?php 
    $ci = &get_instance();
    $webPlanId = PLANID;
    $per = $ci->PlanModel->getPermissionValue('ab-form');
    $get = $ci->ServiceModel->getServiceByType('ab-form');
    if($per['status']  && $webPlanId && $per['permission_value'] >$get->num_rows()){
?>
    <form class="card" method="POST">
        <input type="hidden" name="action" value="add-service">
        <input type="hidden" name="type" value="ab-form">
        <div class="card-header bg-info text-white">Add New Form</div>
        <div class="card-body">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="title" class="form-control" required>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn  btn-sm btn-danger">Save</button>
        </div>
    </form>
<?php 
    }else{
        echo '<div class="alert alert-danger">Quota Full!</div>';
    }
?>
</div>

<div class="col-md-8">
    <div class="card">
        <div class="card-header bg-primary text-white">All Forms</div>
        <div class="card-body">
            <table class="table table-bordered table-striped datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Short-Code</th>
                        <th>Data</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $i = 1;
                        $ci = &get_instance();
                        foreach($get->result() as $row){
                             echo '<tr>
                                        <td>'.$i++.'</td>
                                        <td>'.$row->title.'</td>
                                        <td>[ab-form id='.$row->id.']</td>
                                        <td>
                                            <a href="'.base_url('admin/plugin/ab-form?page=show-data&id=').$row->id.'" class="btn btn-sm btn-primary"><i class="fa fa-list"></i></a>
                                        </td>
                                        <td>
                                            <a href="'.base_url('admin/plugin/ab-form?page=edit&id=').$row->id.'" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                            <a href="'.base_url('admin/plugin/ab-form?page=editor&id=').$row->id.'" class="btn btn-sm btn-info"><i class="fa fa-cog"></i></a>
                                            <a href="'.base_url('admin/delete-service/').$row->id.'" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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