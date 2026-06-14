<div class="content-wrapper">
    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">Design Tokens Management</h3>
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addTokenModal">
                    <i class="fas fa-plus"></i> Add Token
                </button>
            </div>
            <div class="card-body">
                <?php if ($this->session->flashdata('success_msg')): ?>
                    <div class="alert alert-success"><?= $this->session->flashdata('success_msg') ?></div>
                <?php endif; ?>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Token Key</th>
                            <th>Token Value</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($tokens)): ?>
                            <?php foreach ($tokens as $token): ?>
                                <tr>
                                    <td><?= htmlspecialchars($token->token_key) ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <?php if (strpos($token->token_key, 'color') !== false): ?>
                                                <div style="width: 20px; height: 20px; background-color: <?= htmlspecialchars($token->token_value) ?>; border-radius: 50%; margin-right: 10px; border: 1px solid #ccc;"></div>
                                            <?php endif; ?>
                                            <?= htmlspecialchars($token->token_value) ?>
                                        </div>
                                    </td>
                                    <td>
                                        <form method="post" action="<?= base_url('Ai/delete_token') ?>" style="display:inline;">
                                            <input type="hidden" name="id" value="<?= $token->id ?>">
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this token?');"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="text-center">No design tokens found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Token Modal -->
<div class="modal fade" id="addTokenModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="post" action="<?= base_url('Ai/save_token') ?>" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Design Token</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-3">
                    <label for="token_key">Token Key (e.g., --ai-primary-color)</label>
                    <input type="text" name="token_key" class="form-control" required placeholder="--ai-bg-color">
                </div>
                <div class="form-group">
                    <label for="token_value">Token Value</label>
                    <input type="text" name="token_value" class="form-control" required placeholder="#007bff or 16px">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Token</button>
            </div>
        </form>
    </div>
</div>
