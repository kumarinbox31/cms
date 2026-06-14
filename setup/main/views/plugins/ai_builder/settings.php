<div class="content-wrapper">
    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title mb-0">AI Builder Pro Settings</h3>
            </div>
            <div class="card-body">
                <?php if ($this->session->flashdata('success_msg')): ?>
                    <div class="alert alert-success"><?= $this->session->flashdata('success_msg') ?></div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('error_msg')): ?>
                    <div class="alert alert-danger"><?= $this->session->flashdata('error_msg') ?></div>
                <?php endif; ?>

                <form method="post" action="<?= base_url('Ai/settings') ?>">
                    <div class="form-group">
                        <label for="ai_provider">AI Provider</label>
                        <select class="form-control" name="ai_provider" id="ai_provider">
                            <option value="openrouter" <?= ($settings['ai_provider'] == 'openrouter') ? 'selected' : '' ?>>OpenRouter</option>
                        </select>
                        <small class="form-text text-muted">Currently, only OpenRouter is supported.</small>
                    </div>
                    
                    <div class="form-group mt-3">
                        <label for="ai_model">AI Model</label>
                        <input type="text" class="form-control" name="ai_model" id="ai_model" value="<?= htmlspecialchars($settings['ai_model']) ?>" placeholder="e.g. qwen/qwen-2.5-coder-32b-instruct">
                        <small class="form-text text-muted">Enter the model ID from OpenRouter (e.g., meta-llama/llama-3-8b-instruct, deepseek/deepseek-coder).</small>
                    </div>

                    <div class="form-group mt-3">
                        <label for="ai_api_key">API Key</label>
                        <input type="password" class="form-control" name="ai_api_key" id="ai_api_key" value="<?= htmlspecialchars($settings['ai_api_key']) ?>">
                        <small class="form-text text-muted">Your OpenRouter API Key. It is stored securely in the database.</small>
                    </div>

                    <div class="form-group mt-3">
                        <label for="image_api_key">Image Search API Key (Pexels)</label>
                        <input type="password" class="form-control" name="image_api_key" id="image_api_key" value="<?= isset($settings['image_api_key']) ? htmlspecialchars($settings['image_api_key']) : '' ?>">
                        <small class="form-text text-muted">Optional. Enter a Pexels API Key to auto-fetch free stock images.</small>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save"></i> Save Settings</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
