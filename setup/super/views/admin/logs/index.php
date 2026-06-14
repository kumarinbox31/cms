<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0 text-white"><i class="fa fa-list"></i> System Logs & Reports</h4>
                
                <form action="" method="GET" class="form-inline">
                    <select name="type" class="form-control mr-2" onchange="this.form.submit()">
                        <option value="domain" <?= $view_type == 'domain' ? 'selected' : '' ?>>Domain Logs</option>
                        <option value="audit" <?= $view_type == 'audit' ? 'selected' : '' ?>>Health Audits</option>
                        <option value="sync" <?= $view_type == 'sync' ? 'selected' : '' ?>>Cron Sync History</option>
                        <option value="cleanup" <?= $view_type == 'cleanup' ? 'selected' : '' ?>>Cleanup Center Logs</option>
                    </select>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped datatable nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <?php if($view_type == 'audit'): ?>
                                    <th>Date</th>
                                    <th>Domain</th>
                                    <th>Health Score</th>
                                    <th>Details</th>
                                <?php elseif($view_type == 'sync'): ?>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Items Synced</th>
                                <?php elseif($view_type == 'cleanup'): ?>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Entity</th>
                                    <th>Action Taken</th>
                                    <th>Details</th>
                                <?php else: ?>
                                    <th>Date</th>
                                    <th>Action</th>
                                    <th>Response</th>
                                    <th>IP Address</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($logs as $log): ?>
                            <tr>
                                <?php if($view_type == 'audit'): ?>
                                    <td><?= date('d-m-Y H:i', strtotime($log->created_at)) ?></td>
                                    <td><?= $log->domain ?></td>
                                    <td><?= $log->health_score ?>%</td>
                                    <td><?= $log->details ?></td>
                                <?php elseif($view_type == 'sync'): ?>
                                    <td><?= date('d-m-Y H:i', strtotime($log->start_time)) ?></td>
                                    <td><?= $log->end_time ? date('d-m-Y H:i', strtotime($log->end_time)) : '-' ?></td>
                                    <td><?= ucfirst($log->type) ?></td>
                                    <td>
                                        <?php if($log->status == 'Completed'): ?>
                                            <span class="badge bg-success">Completed</span>
                                        <?php else: ?>
                                            <span class="badge bg-warning"><?= $log->status ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $log->items_synced ?></td>
                                <?php elseif($view_type == 'cleanup'): ?>
                                    <td><?= date('d-m-Y H:i', strtotime($log->created_at)) ?></td>
                                    <td><?= str_replace('_', ' ', ucfirst($log->type)) ?></td>
                                    <td><?= $log->entity ?></td>
                                    <td><span class="badge bg-info"><?= $log->action_taken ?></span></td>
                                    <td><?= $log->details ?></td>
                                <?php else: ?>
                                    <td><?= date('d-m-Y H:i', strtotime($log->created_at)) ?></td>
                                    <td><?= $log->action ?></td>
                                    <td><?= $log->response ?></td>
                                    <td><?= $log->ip_address ?></td>
                                <?php endif; ?>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
