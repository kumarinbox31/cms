<div class="content-wrapper">
    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0"><i class="fas fa-magic"></i> AI Builder Pro</h3>
                <div>
                    <!-- Link back to normal VvvebJs editor -->
                    <a href="<?= base_url('editor/edit/' . $page_type . '/' . $page_id) ?>" class="btn btn-sm btn-outline-light">Switch to Normal Editor</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Left Sidebar: AI Prompt Area -->
                    <div class="col-md-4 border-end">
                        <form id="aiBuilderForm">
                            <input type="hidden" id="page_id" value="<?= $page_id ?>">
                            <input type="hidden" id="page_type" value="<?= $page_type ?>">
                            
                            <div class="form-group mb-3">
                                <label for="ai_prompt" class="fw-bold">What would you like to build?</label>
                                <textarea id="ai_prompt" class="form-control" rows="5" placeholder="E.g., Create a modern consulting homepage with a hero section, services, and a contact form." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100" id="btnGenerate">
                                <i class="fas fa-magic"></i> Generate with AI
                            </button>
                        </form>

                        <hr>
                        <div class="mt-3">
                            <h6>Actions</h6>
                            <button class="btn btn-success w-100 mb-2" id="btnSaveToPage" disabled>
                                <i class="fas fa-save"></i> Save to Page
                            </button>
                        </div>
                    </div>

                    <!-- Right Area: Preview -->
                    <div class="col-md-8">
                        <h5 class="text-muted">Live Preview</h5>
                        <div id="aiPreviewLoading" class="text-center d-none py-5">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="mt-2 text-muted">AI is crafting your sections...</p>
                        </div>
                        
                        <div id="aiPreviewFrame" class="border rounded shadow-sm p-3" style="min-height: 500px; background: #fff;">
                            <p class="text-muted text-center mt-5">Enter a prompt and click generate to see the preview here.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Hidden inputs to hold the generated code -->
<textarea id="generatedHtml" class="d-none"></textarea>
<textarea id="generatedCss" class="d-none"></textarea>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#aiBuilderForm').on('submit', function(e) {
        e.preventDefault();
        
        let prompt = $('#ai_prompt').val();
        
        $('#btnGenerate').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Generating...');
        $('#aiPreviewFrame').html('').addClass('d-none');
        $('#aiPreviewLoading').removeClass('d-none');
        $('#btnSaveToPage').prop('disabled', true);

        $.ajax({
            url: '<?= base_url('Ai/generate') ?>',
            type: 'POST',
            data: { prompt: prompt },
            dataType: 'json',
            success: function(response) {
                $('#aiPreviewLoading').addClass('d-none');
                $('#aiPreviewFrame').removeClass('d-none');
                $('#btnGenerate').prop('disabled', false).html('<i class="fas fa-magic"></i> Generate with AI');
                
                if (response.status && response.html) {
                    // Show preview
                    let styleTag = '<style>' + response.css + '</style>';
                    $('#aiPreviewFrame').html(styleTag + response.html);
                    
                    // Store for saving
                    $('#generatedHtml').val(response.html);
                    $('#generatedCss').val(response.css);
                    
                    $('#btnSaveToPage').prop('disabled', false);
                } else {
                    $('#aiPreviewFrame').html('<div class="alert alert-danger">Error: ' + (response.error || 'Unknown error occurred.') + '</div>');
                }
            },
            error: function() {
                $('#aiPreviewLoading').addClass('d-none');
                $('#aiPreviewFrame').removeClass('d-none').html('<div class="alert alert-danger">Network error. Please try again.</div>');
                $('#btnGenerate').prop('disabled', false).html('<i class="fas fa-magic"></i> Generate with AI');
            }
        });
    });

    $('#btnSaveToPage').on('click', function() {
        let pageId = $('#page_id').val();
        let pageType = $('#page_type').val();
        let html = $('#generatedHtml').val();
        let css = $('#generatedCss').val();
        
        let btn = $(this);
        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Saving...');

        $.ajax({
            url: '<?= base_url('Admin/save') ?>',
            type: 'POST',
            data: {
                pageId: pageId,
                pageType: pageType,
                htmldata: '<body>' + html + '</body>', // Wrapper required by existing save logic
                cssdata: css
            },
            success: function(response) {
                if(response == 1) {
                    alert('Page saved successfully!');
                    btn.prop('disabled', false).html('<i class="fas fa-save"></i> Save to Page');
                } else {
                    alert('Failed to save.');
                    btn.prop('disabled', false).html('<i class="fas fa-save"></i> Save to Page');
                }
            },
            error: function() {
                alert('Network error while saving.');
                btn.prop('disabled', false).html('<i class="fas fa-save"></i> Save to Page');
            }
        });
    });
});
</script>
