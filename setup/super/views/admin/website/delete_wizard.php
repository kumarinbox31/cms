<?php 
$w = $this->website->get(['id'=>@$_GET['id'],'rid'=>RID])->row();
if (!$w) {
    redirect('admin/website');
}

// Calculate stats for summary
$emailsCount = $this->db->where('website_id', $w->id)->count_all_results('ab_email_accounts');
$addonsCount = ($w->addon_status === 'Added') ? 1 : 0;
// Note: accurate subdomains/disk usage would require a real cPanel API call, simulating for now.
$subdomainsCount = 0; 
$diskUsage = "Calculating..."; 
?>
<div class="row">
    <div class="col-md-8 offset-md-2">
        <form method="POST" action="<?= base_url('admin/execute_delete_website') ?>" id="deleteForm">
            <input type="hidden" name="wid" value="<?= $w->id ?>">
            <div class="card border-danger">
                <div class="card-header bg-danger text-white">
                    <h4 class="mb-0">Website Delete Protection</h4>
                </div>
                <div class="card-body">
                    
                    <div class="alert alert-warning">
                        <strong>Warning:</strong> You are about to delete the website <strong><?= $w->name ?></strong>. This action is irreversible.
                    </div>

                    <h5>Step 1: Resource Summary</h5>
                    <table class="table table-bordered table-sm">
                        <tr><th>Domain</th><td><?= $w->domain ?></td></tr>
                        <tr><th>Emails</th><td><?= $emailsCount ?></td></tr>
                        <tr><th>Addon Domains</th><td><?= $addonsCount ?></td></tr>
                        <tr><th>Subdomains</th><td><?= $subdomainsCount ?></td></tr>
                    </table>

                    <hr>

                    <h5>Step 2: Select What to Remove</h5>
                    <div class="form-check">
                        <input class="form-check-input cleanup-option" type="checkbox" name="remove_record" value="1" id="optRecord" checked readonly>
                        <label class="form-check-label" for="optRecord">Remove Website Record Only (Always required)</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input cleanup-option" type="checkbox" name="remove_addon" value="1" id="optAddon">
                        <label class="form-check-label" for="optAddon">Remove Addon Domain from cPanel</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input cleanup-option" type="checkbox" name="remove_emails" value="1" id="optEmails">
                        <label class="form-check-label" for="optEmails">Remove Emails</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input cleanup-option" type="checkbox" name="remove_subdomains" value="1" id="optSubdomains">
                        <label class="form-check-label" for="optSubdomains">Remove Subdomains</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input cleanup-option" type="checkbox" name="remove_dir" value="1" id="optDir">
                        <label class="form-check-label" for="optDir">Remove Uploads Directory (<code>/public/temp/<?= $w->id ?></code>)</label>
                    </div>
                    
                    <div class="mt-2">
                        <button type="button" class="btn btn-sm btn-outline-danger" id="btnFullCleanup">Select Full Cleanup</button>
                    </div>

                    <hr>

                    <h5>Step 3: Confirmation</h5>
                    <div class="form-group">
                        <label>Type <strong>DELETE</strong> to confirm execution</label>
                        <input type="text" class="form-control" id="confirmText" autocomplete="off">
                    </div>

                </div>
                <div class="card-footer text-right">
                    <a href="<?= base_url('admin/website') ?>" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-danger" id="btnExecuteDelete" disabled>Execute Deletion</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $('#btnFullCleanup').click(function() {
        $('.cleanup-option').prop('checked', true);
    });

    $('#confirmText').on('input', function() {
        if ($(this).val() === 'DELETE') {
            $('#btnExecuteDelete').prop('disabled', false);
        } else {
            $('#btnExecuteDelete').prop('disabled', true);
        }
    });

    $('#deleteForm').submit(function(e) {
        if ($('#confirmText').val() !== 'DELETE') {
            e.preventDefault();
            alert('Please type DELETE to confirm.');
        }
    });
</script>
