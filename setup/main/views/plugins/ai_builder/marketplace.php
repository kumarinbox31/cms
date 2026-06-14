<div class="content-wrapper">
    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0"><i class="fas fa-store"></i> Section Marketplace</h3>
                
                <form method="get" action="<?= base_url('AiMarketplace') ?>" class="d-flex">
                    <select name="category" class="form-control form-control-sm me-2" onchange="this.form.submit()">
                        <option value="">All Categories</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= htmlspecialchars($cat->category) ?>" <?= (isset($_GET['category']) && $_GET['category'] == $cat->category) ? 'selected' : '' ?>>
                                <?= ucfirst(htmlspecialchars($cat->category)) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </form>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php if (!empty($components)): ?>
                        <?php foreach ($components as $component): ?>
                            <div class="col-md-4 mb-4">
                                <div class="card h-100 shadow-sm border-0">
                                    <?php if (!empty($component->thumbnail)): ?>
                                        <img src="<?= htmlspecialchars($component->thumbnail) ?>" class="card-img-top" alt="Thumbnail">
                                    <?php else: ?>
                                        <div class="bg-light text-center py-5">
                                            <i class="fas fa-layer-group fa-3x text-muted mb-2"></i>
                                            <p class="text-muted mb-0">No Preview</p>
                                        </div>
                                    <?php endif; ?>
                                    <div class="card-body">
                                        <h5 class="card-title"><?= htmlspecialchars($component->name) ?></h5>
                                        <span class="badge bg-secondary mb-2"><?= ucfirst(htmlspecialchars($component->category)) ?></span>
                                        <p class="card-text text-muted small">Tags: <?= htmlspecialchars($component->tags) ?></p>
                                    </div>
                                    <div class="card-footer bg-white border-0">
                                        <button class="btn btn-sm btn-outline-primary w-100 btn-view-source" data-id="<?= $component->id ?>">
                                            <i class="fas fa-code"></i> View Source
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12 text-center py-5">
                            <h4 class="text-muted">No components found.</h4>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- View Source Modal -->
<div class="modal fade" id="sourceModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Component Source</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6>HTML</h6>
                <textarea id="sourceHtml" class="form-control mb-3" rows="8" readonly></textarea>
                <h6>CSS</h6>
                <textarea id="sourceCss" class="form-control" rows="5" readonly></textarea>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.btn-view-source').on('click', function() {
        let id = $(this).data('id');
        let btn = $(this);
        
        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');

        $.ajax({
            url: '<?= base_url('AiMarketplace/view_source/') ?>' + id,
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                btn.prop('disabled', false).html('<i class="fas fa-code"></i> View Source');
                if (res.status) {
                    $('#sourceHtml').val(res.html);
                    $('#sourceCss').val(res.css);
                    $('#sourceModal').modal('show');
                } else {
                    alert(res.error);
                }
            },
            error: function() {
                btn.prop('disabled', false).html('<i class="fas fa-code"></i> View Source');
                alert('Network error.');
            }
        });
    });
});
</script>
