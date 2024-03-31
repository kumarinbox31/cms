
<div class="row">
<div class="col-md-4">
    <form class="card" method="POST">
        <input type="hidden" name="action" value="add-service">
        <input type="hidden" name="type" value="ab-slider">
        <div class="card-header bg-primary text-white">Add New Slider</div>
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
</div>

<div class="col-md-8">
    <div class="card">
        <div class="card-header bg-primary text-white">All Sliders</div>
        <div class="card-body">
            <table class="table table-bordered table-striped datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Short-Code</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $i = 1;
                        $ci = &get_instance();
                        $get = $ci->ServiceModel->getServiceByType('ab-slider');
                        foreach($get->result() as $row){
                             echo '<tr>
                                        <td>'.$i++.'</td>
                                        <td>'.$row->title.'</td>
                                        <td><code>[AB-Slider id='.$row->id.']</code></td>
                                        <td>
                                            <a href="'.base_url('admin/plugin/ab-slider?page=builder&id=').$row->id.'" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
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