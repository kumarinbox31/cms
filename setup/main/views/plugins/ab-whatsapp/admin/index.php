<style>
    .pull-right {
        float: right;
    }
</style>
<div class="alert alert-danger">
    <h1 class="text-center"><img src="https://icons8.com/preloaders/preloaders/788/WhatsApp%20logo%20animated.gif">
        Welcome to AB WHATSAPP ICONS</h1>
</div>
<?php
$enable = getVal('ab-whatsapp-plugin');
$btn_color = $enable == 'enable' ? 'success' : 'danger';
$btn_icon = $enable == 'enable' ? 'on' : 'off';
?>
<div class="card">
    <form method="POST" action="">
        <input type="hidden" name="action" value="add-update">
        <input type="hidden" name="ab-whatsapp-plugin" value="<?= $enable == 'enable' ? 'disable' : 'enable'; ?>">
        <div class="card-header bg-primary text-white d-block">
            Config Setting
            <button type="submit" class="btn btn-sm btn-<?= $btn_color ?> pull-right"><i
                    class="fa fa-toggle-<?= $btn_icon ?>"></i></<button>
        </div>
    </form>
    <div class="card-body">
        <form method="POST" action="" class="row">
            <input type="hidden" name="action" value="add-update">
            <div class="form-group col-md-6">
                <label>Whatsapp No</label>
                <input type="number" min="0" class="form-control" name="ab-whatsapp-number"
                    value="<?= getVal('ab-whatsapp-number'); ?>" placeholder="Enter whatsapp number">
            </div>
            <div class="form-group col-md-6">
                <label>Calling No</label>
                <input type="number" min="0" class="form-control" name="ab-calling-number"
                    value="<?= getVal('ab-calling-number'); ?>" placeholder="Enter calling number">
            </div>
            <div class="form-group col-md-6">
                <label>Tawk.to Widget Script</label>
                <textarea name="ab-tawk-to-script" placeholder="Enter script" rows="10"
                    class="form-control"><?php echo getVal('ab-tawk-to-script'); ?></textarea>
            </div>
            <div class="form-group col-md-6">
                <label for="ab-popup-type">Popup Type</label>
                <?php $popup_type = getVal('ab-popup-type'); ?>
                <select name="ab-popup-type" id="ab-popup-type" class="form-control">
                    <option value="" <?php echo $popup_type == '' ? 'selected' : ''; ?>>Disable</option>
                    <option value="default_page" <?php echo $popup_type == 'default_page' ? 'selected' : ''; ?>>Default
                        Page</option>
                    <option value="all_pages" <?php echo $popup_type == 'all_pages' ? 'selected' : ''; ?>>All Pages
                    </option>
                </select>
            </div>

            <div class="form-group col-md-6">
                <label>Popup Content</label>
                <textarea name="ab-popup-content" placeholder="Enter Content" rows="10"
                    class="form-control ckeditor"><?php echo getVal('ab-popup-content'); ?></textarea>
            </div>
            <div class="form-group col-md-6">
                <label>Google Translate</label>
                <code>[GOOGLE-TRANSLATE]</code>
            </div>
            <div class="form-group col-md-12">
                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>