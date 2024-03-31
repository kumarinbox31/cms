<div class="card">
    <div class="card-header bg-info text-white">
        Installed Plugins
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped datatable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $i = 1;
                    $get = $this->PluginModel->getAllInstalledPlugins();
                    foreach($get->result() as $row){
                        $plugin = $this->PluginModel->pluginInfo($row->plugin_id)->row();
                        echo '<tr>
                                <td>'.$i++.'</td>
                                <td>'.$plugin->name.'</td>
                                <td>'.($row->status?'active':'in-active').'</td>
                                <td>';
                                if($row->status){
                                    echo '<a href="'.base_url('admin/uninstall-plugin/').$row->id.'" class="btn btn-sm btn-danger">Disable</a>';
                                }else{
                                    echo '<a href="'.base_url('admin/reinstall-plugin/').$row->id.'" class="btn btn-sm btn-success">Enable</a>';
                                }
                            echo '</td>
                            </tr>';
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>