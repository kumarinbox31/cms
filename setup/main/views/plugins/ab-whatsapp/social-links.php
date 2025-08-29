<?php
function sidebar_social_links(){
$position = getVal('social_links'); // left, right, disable
if ($position != 'disable'):

// Collect style pieces
$styleParts = [];
$styleMap = [
    'padding' => getVal('social_icon_padding','5px'),
    'background' => getVal('social_icon_background','#ffffff'),
    'width' => getVal('social_icon_width','35px'),
    'height' => getVal('social_icon_height','35px'),
    'border-radius' => getVal('social_icon_border_radius','50%'),
    'filter' => getVal('social_icon_filter'),
];

foreach ($styleMap as $cssProp => $value) {
    if (!empty($value)) {
        $styleParts[] = "$cssProp: $value";
    }
}

$finalStyle = implode(';', $styleParts) . ';';

$socials = [
    'facebook' => 'Facebook',
    'twitter' => 'Twitter',
    'instagram' => 'Instagram',
    'linkedin' => 'LinkedIn',
    'youtube' => 'YouTube',
    'whatsapp' => 'WhatsApp',
    'telegram' => 'Telegram',
    'pinterest' => 'Pinterest',
    'snapchat' => 'Snapchat',
    'threads' => 'Threads',
];
$style_type = getVal('social_icon_style','style1');
?>
<style>
    .ab-social-widget {
        position: fixed;
        top: 40%;
        z-index: 9999;
        transform: translateY(-50%);
    }
    .social-left {
        left: 0;
    }
    .social-right {
        right: 0;
    }
    .ab-social-widget ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }
    .ab-social-widget li {
        margin: 5px 0;
    }
    .ab-social-widget a img {
        transition: transform 0.3s ease;
    }
    .ab-social-widget a:hover img {
        transform: scale(1.2);
    }
</style>

<div class="ab-social-widget social-<?= $position; ?>">
    <ul>
        <?php foreach ($socials as $key => $name): 
            $url = getVal("social_{$key}");
            if (!empty($url)):
        ?>
            <li>
                <a href="<?= htmlspecialchars($url); ?>" target="_blank" title="<?= $name ?>">
                    <img src="/public/social-icons/<?php echo $style_type; ?>/<?= $key; ?>.svg" alt="<?= $name ?>" style="<?= htmlspecialchars($finalStyle); ?>">
                </a>
            </li>
        <?php endif; endforeach; ?>
    </ul>
</div>
<?php endif;

}
?>
