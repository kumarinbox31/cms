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
                <label>Head Script</label>
                <textarea name="ab-head-script" placeholder="Enter head script" rows="10"
                    class="form-control"><?php echo getVal('ab-head-script'); ?></textarea>
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
            <div class="form-group col-md-6">
                <label>Social Links</label>
                <select class="form-control" name="social_links">
                    <option value="disable" <?= getVal('social_links') == 'disable' ? 'selected' : ''; ?>>Disable</option>
                    <option value="left" <?= getVal('social_links') == 'left' ? 'selected' : ''; ?>>Left</option>
                    <option value="right" <?= getVal('social_links') == 'right' ? 'selected' : ''; ?>>Right</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label>Social Links</label>
                <select class="form-control" name="social_icon_style">
                    <option value="style1" <?= getVal('social_icon_style','style1') == 'style1' ? 'selected' : ''; ?>>Style 1</option>
                </select>
            </div>
            <?php 
            $socials = [
                'social_facebook' => 'Facebook',
                'social_twitter' => 'Twitter',
                'social_instagram' => 'Instagram',
                'social_linkedin' => 'LinkedIn',
                'social_youtube' => 'YouTube',
                'social_whatsapp' => 'WhatsApp',
                'social_telegram' => 'Telegram',
                'social_pinterest' => 'Pinterest',
                'social_snapchat' => 'Snapchat',
                'social_threads' => 'Threads',
            ];
            
            foreach($socials as $key => $val){
            ?>
                <div class="form-group col-md-6">
                    <label><?= $val; ?></label>
                    <input type="text" class="form-control" name="<?= $key; ?>"
                           value="<?= getVal($key); ?>" placeholder="Enter <?= $val; ?> URL">
                </div>
            <?php } ?>
<div class="form-group col-md-6">
    <label>Icon Padding</label>
    <input type="text" class="form-control" name="social_icon_padding"
           value="<?= getVal('social_icon_padding', '5px'); ?>" placeholder="e.g., 10px">
</div>

<div class="form-group col-md-4">
    <label>Background Color</label><br>
    <input type="color" class="w-100" name="social_icon_background"
           value="<?= getVal('social_icon_background', '#ffffff'); ?>">
</div>

<div class="form-group col-md-4">
    <label>Icon Width</label>
    <input type="text" class="form-control" name="social_icon_width"
           value="<?= getVal('social_icon_width', '35px'); ?>" placeholder="e.g., 35px">
</div>

<div class="form-group col-md-4">
    <label>Icon Height</label>
    <input type="text" class="form-control" name="social_icon_height"
           value="<?= getVal('social_icon_height', '35px'); ?>" placeholder="e.g., 35px">
</div>

<div class="form-group col-md-4">
    <label>Border Radius</label>
    <input type="text" class="form-control" name="social_icon_border_radius"
           value="<?= getVal('social_icon_border_radius', '50%'); ?>" placeholder="e.g., 50%">
</div>

<div class="form-group col-md-4">
    <label>Custom Filter (Optional)</label>
    <input type="text" class="form-control" name="social_icon_filter"
           value="<?= getVal('social_icon_filter'); ?>" placeholder="e.g., grayscale(100%)">
</div>


            <div class="form-group col-md-12">
                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>