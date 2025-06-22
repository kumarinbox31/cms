<?php
$now = time();
$start_date = date("d-m-Y", $web->start_time);
$end_date = date("d-m-Y", $web->end_time);
$daysLeft = floor(($web->end_time - $now) / (60 * 60 * 24));

if ($web->end_time < $now) {
    $status = 'Expired';
    $badge_class = 'danger';
    $status_text = 'Your plan expired on '.$end_date;
} elseif ($daysLeft <= 30) {
    $status = 'Expiring Soon';
    $badge_class = 'warning';
    $status_text = 'Your plan is expiring in '.$daysLeft.' day(s)';
} else {
    $status = 'Active';
    $badge_class = 'success';
    $status_text = 'Your plan is active and ends on '.$end_date;
}
?>
<style>
    .scrollable-features {
    max-height: 300px;   /* Adjust height as needed */
    overflow-y: auto;
}

</style>
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="alert alert-success d-flex align-items-center" role="alert" style="font-size: 1.1rem;">
                <span class="me-2" style="font-size: 1.5rem;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="30" height="30"><g data-name="07-Shake hands"><path style="fill:#795799" d="M17 20 9 33l-8-4V10l16 10z"/><path d="M12.85 36.85 16 33.69a2.33 2.33 0 0 1 3.31 0 2.3 2.3 0 0 1 .69 1.65 2.34 2.34 0 0 1-.69 1.66L16 40.31A2.341 2.341 0 1 1 12.69 37zM33.47 47.82a.435.435 0 0 1-.06.07 1 1 0 0 1-.1.11l-2.88 2.88-.43.43A2.341 2.341 0 1 1 26.69 48L30 44.69a2.33 2.33 0 0 1 3.31 0 2.3 2.3 0 0 1 .69 1.65 2.356 2.356 0 0 1-.53 1.48zM30 42.93a2.882 2.882 0 0 1-.86 2.07l-2.72 2.73L25 49.14A2.927 2.927 0 0 1 20.86 45l3.64-3.64.5-.5a2.915 2.915 0 0 1 4.14 0 2.882 2.882 0 0 1 .86 2.07zM25 38.93a2.882 2.882 0 0 1-.86 2.07L20 45.14A2.927 2.927 0 0 1 15.86 41l3.73-3.72.41-.42a2.915 2.915 0 0 1 4.14 0 2.882 2.882 0 0 1 .86 2.07z" style="fill:#deab99"/><path d="M19.31 35 16 38.31a2.33 2.33 0 0 1-3.31 0 2.3 2.3 0 0 1-.454-.653A2.336 2.336 0 0 0 16 40.31L19.31 37a2.34 2.34 0 0 0 .69-1.66 2.314 2.314 0 0 0-.235-1 2.344 2.344 0 0 1-.455.66zM31 48.31a2.346 2.346 0 0 1-3.832-.788L26.69 48A2.341 2.341 0 1 0 30 51.31l.43-.43L33.31 48a1 1 0 0 0 .1-.11.435.435 0 0 0 .06-.07 2.356 2.356 0 0 0 .53-1.48 2.332 2.332 0 0 0-.167-.863l-2.4 2.4zM26 46.14a2.92 2.92 0 0 1-4.908-1.372L20.86 45A2.927 2.927 0 0 0 25 49.14l1.42-1.41L29.14 45a2.882 2.882 0 0 0 .86-2.07 2.982 2.982 0 0 0-.093-.7l-2.487 2.5zM16.86 42.14a2.874 2.874 0 0 1-.767-1.372L15.86 41A2.927 2.927 0 0 0 20 45.14L24.14 41a2.882 2.882 0 0 0 .86-2.07 3 3 0 0 0-.093-.7L21 42.14a2.915 2.915 0 0 1-4.14 0z" style="fill:#d18e78"/><path d="M40.8 33.99c-8.05-.08-8.11-5.51-8.63-7.74A1.573 1.573 0 0 0 30.63 25h-.06A1.566 1.566 0 0 0 29 26.57V28a3 3 0 0 1-3 3 2.015 2.015 0 0 1-2-2v-5.61a2.014 2.014 0 0 1 1.3-1.88l3.74-1.4 2.28-.86a4.23 4.23 0 0 1 1.41-.25h2.68a4.052 4.052 0 0 1 1.15.17L46 22l17-9v17l-10 5-5 6-.04.01a2.468 2.468 0 0 0-.85-1.53L40.8 34z" style="fill:#deab99"/><path d="M36.29 50.38a2.039 2.039 0 0 1 .09 3.01 2.162 2.162 0 0 1-1.5.61 2.132 2.132 0 0 1-1.39-.51l-3.06-2.61L33.31 48a1 1 0 0 0 .1-.11z" style="fill:#ffb5b5"/><path d="M33.31 44.69a2.33 2.33 0 0 0-3.31 0L26.69 48l-.27-.27L29.14 45a2.921 2.921 0 0 0 0-4.14 2.915 2.915 0 0 0-4.14 0l-.5.5-.36-.36a2.921 2.921 0 0 0 0-4.14 2.915 2.915 0 0 0-4.14 0l-.41.42-.28-.28a2.34 2.34 0 0 0 .69-1.66 2.3 2.3 0 0 0-.69-1.65 2.33 2.33 0 0 0-3.31 0l-3.15 3.16L9 33l8-13h12l.04.11-3.74 1.4a2.014 2.014 0 0 0-1.3 1.88V29a2.015 2.015 0 0 0 2 2 3 3 0 0 0 3-3v-1.43A1.566 1.566 0 0 1 30.57 25h.06a1.573 1.573 0 0 1 1.54 1.25c.52 2.23.58 7.66 8.63 7.74V34l6.31 5.48a2.468 2.468 0 0 1 .85 1.53 2.51 2.51 0 0 1-.74 2.23 1.869 1.869 0 0 1-1.35.6A3.034 3.034 0 0 1 44 43a3.123 3.123 0 0 1 .22 4.24 2.43 2.43 0 0 1-1.74.6A4.027 4.027 0 0 1 40 47c1.14.99 2.3 3.19 1.22 4.24a2.683 2.683 0 0 1-3.61.12l-4.14-3.54a2.356 2.356 0 0 0 .53-1.48 2.3 2.3 0 0 0-.69-1.65z" style="fill:#ffd1d1"/><path d="M36.766 41.371A1.834 1.834 0 0 0 34 42l.73.61L40 47a4.027 4.027 0 0 0 2.48.84 2.43 2.43 0 0 0 1.74-.6 2.113 2.113 0 0 0 .306-.391 2.975 2.975 0 0 1-1.64-.728zM38.888 50.152l-4.953-4.334a2.279 2.279 0 0 1-.465 2l4.14 3.54a2.683 2.683 0 0 0 3.61-.12 1.346 1.346 0 0 0 .286-.416 3 3 0 0 1-2.618-.67zM47.22 43.24a2.5 2.5 0 0 0 .68-1.179 1.986 1.986 0 0 1-1.6-.382l-5.151-4.006a3.086 3.086 0 0 0-4.078.254.088.088 0 0 0 .011.133L44 43a3.034 3.034 0 0 0 1.87.84 1.869 1.869 0 0 0 1.35-.6zM27 33a3 3 0 0 0 3-3v-1s1 7 7 7c1.6 0 3.9-.259 3.984-1.84L40.8 34v-.01c-8.05-.08-8.11-5.51-8.63-7.74A1.573 1.573 0 0 0 30.63 25h-.06A1.566 1.566 0 0 0 29 26.57V28a3 3 0 0 1-3 3 2.015 2.015 0 0 1-2-2v1a3 3 0 0 0 3 3zM14.764 28.724 19.462 20H17L9 33l3.85 3.85 2.519-2.527a4.99 4.99 0 0 1-.605-5.599zM19.31 37l-2.776 2.776.309.244 2.747-2.74.41-.42a2.914 2.914 0 0 1 .627-.467l-.7-.512A2.332 2.332 0 0 1 19.31 37zM24.14 41l-2.662 2.662.4.316L24.5 41.36l.5-.5a2.877 2.877 0 0 1 .891-.606l-.961-.7A2.85 2.85 0 0 1 24.14 41zM29.97 43.245A2.856 2.856 0 0 1 29.14 45l-2.616 2.626-.1.1.27.27.136-.136L30 44.69a2.334 2.334 0 0 1 .849-.539L31 44z" style="fill:#ffb5b5"/><path d="m33.457 28.025-.2-2.173a3.136 3.136 0 0 0-6.257.284V28.5a1.5 1.5 0 0 1-3 0v.5a1.955 1.955 0 0 0 .59 1.41c.78.8 2.217.9 3.4-.42A4.21 4.21 0 0 0 29 27.176v-.606A1.57 1.57 0 0 1 30.57 25h.06a1.573 1.573 0 0 1 1.54 1.25c.453 1.942.562 6.308 5.9 7.457a6.571 6.571 0 0 1-4.613-5.682zM52 32l-1.419 1.419A3.1 3.1 0 0 1 47 34h-6.2l6.31 5.48a2.468 2.468 0 0 1 .85 1.53L48 41l5-6 10-5v-3.5z" style="fill:#d18e78"/><path d="M52.744 23 63 17.533V13l-17 9a5.727 5.727 0 0 0 6.744 1z" style="fill:#ebb5a2"/><path d="m13.033 17.52-4.026 6.325a4 4 0 0 1-5.29 1.364L1 23.727V29l8 4 8-13z" style="fill:#573875"/></g></svg>
                </span>
                <div>
                     Welcome back, <strong><?php echo ucwords(htmlspecialchars($web->name ?? '')); ?></strong>! We're glad to see you.
                </div>
            </div>
        </div>
        <?php
$plan = $this->db->get_where('plan', ['id' => $web->planid])->row();
$permissions = !empty($plan) ? json_decode($plan->permissions, true) : null;
/*
?>

<div class="col-lg-12 col-md-12 col-sm-12">
    <div class="card border-<?= $badge_class ?> mb-4 shadow-sm">
        <div class="card-header bg-<?= $badge_class ?> text-white d-flex justify-content-between align-items-center">
            <strong>Website Plan Status</strong>
            <?php if (!empty($plan)): ?>
                <span class="badge bg-light text-<?= $badge_class ?> fs-6"><?= htmlspecialchars($plan->plan_name ?? 'No Plan Name') ?></span>
            <?php endif; ?>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Left Column: Status Info -->
                <div class="col-md-6 mb-3">
                    <h5 class="card-title mb-3">
                        <?= htmlspecialchars($web->name) ?> 
                        <small class="text-muted">(<?= htmlspecialchars($web->domain) ?>)</small>
                    </h5>
                    <p class="mb-1">Start Date: <strong><?= $start_date ?></strong></p>
                    <p class="mb-1">End Date: <strong><?= $end_date ?></strong></p>
                    <p class="mb-3">Status: 
                        <span class="badge bg-<?= $badge_class ?>"><?= $status ?></span>
                    </p>
                    <p class="mb-0 fw-semibold"><?= $status_text ?></p>
                </div>

                <!-- Right Column: Compact Features -->
                <div class="col-md-6">
                    <h6 class="mb-3">Plan Features</h6>
                    <?php if ($permissions && is_array($permissions)): ?>
                        <div class="overflow-auto" style="max-height: 280px;">
                            <div class="row row-cols-2 g-1">
                                <?php 
                                foreach ($permissions as $key => $val) {
                                    if ($val && !is_int($key)) {
                                        $feature_name = ucwords(str_replace('_', ' ', $key));
                                        $feature_value = is_bool($val) ? 'Yes' : htmlspecialchars($val);
                                ?>
                                <div class="col">
                                    <div class="d-flex justify-content-between align-items-center border rounded px-2 py-1 small">
                                        <span class="text-truncate" title="<?= $feature_name ?>"><?= $feature_name ?></span>
                                        <span class="badge bg-secondary text-white rounded-pill" style="font-size: 0.75rem; padding: 0.25em 0.5em;"><?= ucwords($feature_value) ?></span>
                                    </div>
                                </div>
                                <?php } } ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <p class="text-muted">Plan details not available.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
*/?>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="widget">
                <div class="widget-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="state">
                            <h6>Space Used</h6>
                            <h2><?php echo getTotalSpaceUsed(); ?></h2>
                        </div>
                        <div class="icon">
                            <i class="ik ik-award"></i>
                        </div>
                    </div>
                    <small class="text-small mt-10 d-block">Use smaller images to save storage, boost loading times, and improve user experience.</small>
                </div>
                <div class="progress progress-sm">
                    <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="1000" style="width: 100%;"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="widget">
                <div class="widget-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="state">
                            <h6>Visitors</h6>
                            <h2><?php echo $totalVisitors; ?></h2>
                        </div>
                        <div class="icon">
                            <i class="ik ik-users"></i>
                        </div>
                    </div>
                    <small class="text-small mt-10 d-block">Total Website Visitors</small>
                </div>
                <div class="progress progress-sm">
                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="widget">
                <div class="widget-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="state">
                            <h6>Pages</h6>
                            <h2><?php echo $totalPages; ?></h2>
                        </div>
                        <div class="icon">
                            <i class="ik ik-users"></i>
                        </div>
                    </div>
                    <small class="text-small mt-10 d-block">Total Web Pages</small>
                </div>
                <div class="progress progress-sm">
                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="widget">
                <div class="widget-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="state">
                            <h6>Active Plugins</h6>
                            <h2><?php echo $totalPlugins; ?></h2>
                        </div>
                        <div class="icon">
                            <i class="ik ik-users"></i>
                        </div>
                    </div>
                    <small class="text-small mt-10 d-block">Total Installed Plugins</small>
                </div>
                <div class="progress progress-sm">
                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="widget">
                <div class="widget-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="state">
                            <h6>Total Forms</h6>
                            <h2><?php echo $totalForms; ?></h2>
                        </div>
                        <div class="icon">
                            <i class="ik ik-users"></i>
                        </div>
                    </div>
                    <small class="text-small mt-10 d-block">Total Created Forms</small>
                </div>
                <div class="progress progress-sm">
                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="widget">
                <div class="widget-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="state">
                            <h6> Enquiries Received</h6>
                            <h2><?php echo htmlspecialchars($formDataCounts); ?></h2>
                        </div>
                        <div class="icon" aria-label="Enquiries icon">
                            <i class="ik ik-mail"></i>
                        </div>
                    </div>
                    <small class="text-small mt-10 d-block">Total Enquiries Received via Forms</small>
                </div>
                <div class="progress progress-sm" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" aria-label="Progress bar showing total enquiries received">
                    <div class="progress-bar bg-success" style="width: 100%;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <!-- Left Side: Title and Total -->
                        <div style="flex: 1;">
                            <h4 class="card-title">Page Visitors</h4>
                            <div class="d-flex align-items-center flex-row mt-20">
                                <div class="p-2 f-50 text-info">
                                    <i class="ik ik-users"></i>
                                    <span><?php echo $totalPagesVisitCount; ?></span>
                                </div>
                                <div class="p-2">
                                    <h3 class="mb-0">Total</h3>
                                    <small>Visit Counts</small>
                                </div>
                            </div>
                        </div>
        
                        <!-- Right Side: List with Scroll -->
                        <div style="flex: 1; max-height: 200px; overflow-y: auto; padding-left: 20px;">
                            <ul class="list-unstyled mb-0">
                                <?php foreach($pagesVisitCounts as $page): ?>
                                    <li class="d-flex justify-content-between border-bottom py-1">
                                        <span><?php echo $page->page_name; ?></span>
                                        <span class="font-weight-bold"><?php echo (int)$page->visit_count; ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php if (!empty($pagesVisitCounts)) { ?>
<div class="row clearfix">
    <div class="col-12"> <!-- Add a column wrapper -->
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="card-title mb-0">
                        <svg width="25" height="25" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 500 500" style="enable-background:new 0 0 500 500" xml:space="preserve"><style>.st0{fill:#ecf4f7}.st1{fill:#1c1d21}</style><path class="st0" d="m426.7 113.6 12.4-1.9c6.8-1 12.7-5.3 15.8-11.4l19.2-37.8-17.4-17.4-37.8 19.2c-6.1 3.1-10.4 9-11.4 15.8l-1.9 12.4c-.9 5.8 1.1 11.7 5.2 15.9 4.2 4.1 10.1 6 15.9 5.2z"/><path class="st1" d="M424 118.8c-6.2 0-12.2-2.5-16.7-6.9-5.3-5.3-7.7-12.8-6.6-20.2l1.9-12.4c1.3-8.4 6.5-15.7 14.1-19.5l37.8-19.2c1.9-1 4.3-.6 5.8.9l17.4 17.4c1.5 1.5 1.9 3.9.9 5.8l-19.2 37.8c-3.8 7.6-11.1 12.8-19.5 14.1l-12.4 1.9c-1.2.2-2.4.3-3.5.3zm2.7-5.2zm29-62.4-34.5 17.5c-4.7 2.4-8 6.9-8.7 12.1l-1.9 12.4c-.6 4.2.8 8.6 3.8 11.6s7.4 4.5 11.6 3.8l12.4-1.9c5.2-.8 9.7-4.1 12.1-8.7L468 63.4l-12.3-12.2z"/><path d="m199 379.1-59-59 21.4-21.4c5.4-5.4 14.1-5.4 19.5 0l39.5 39.5c5.4 5.4 5.4 14.1 0 19.5L199 379.1z" style="fill:#fddf7f"/><path class="st1" d="M199 384.1c-1.3 0-2.6-.5-3.5-1.5l-59-59c-.9-.9-1.5-2.2-1.5-3.5 0-1.3.5-2.6 1.5-3.5l21.4-21.4c3.5-3.6 8.3-5.5 13.3-5.5s9.7 2 13.3 5.5l39.5 39.5c7.3 7.3 7.3 19.3 0 26.6l-21.4 21.4c-1 .9-2.2 1.4-3.6 1.4zm-51.9-64L199 372l17.9-17.9c1.7-1.7 2.6-3.9 2.6-6.2s-.9-4.6-2.6-6.2l-39.5-39.5c-1.7-1.7-3.9-2.6-6.2-2.6s-4.6.9-6.2 2.6l-17.9 17.9z"/><path d="M187.5 379c7.2-1 11.6.2 11.6.2l-59-59s1.1 4.4.2 11.6c-2.2 16.2-15.8 28.2-32.1 29.8-6.5.6-12.8 3.5-17.8 8.4l-55.7 55.7c-11.5 11.5-11.5 30 0 41.5l17.5 17.5c11.5 11.5 30 11.5 41.5 0l35.6-35.6c5-5 27.9-31.5 28.6-38 1.4-16.3 13.3-29.9 29.6-32.1z" style="fill:#83e1e5"/><path class="st1" d="M72.8 498.2c-9.2 0-17.8-3.6-24.3-10.1L31 470.6c-13.4-13.4-13.4-35.2 0-48.5l55.7-55.7c5.6-5.6 13-9.1 20.9-9.9 14.4-1.4 25.8-11.9 27.7-25.5.8-6 0-9.6-.1-9.7-.5-2.2.5-4.5 2.4-5.6 2-1.1 4.4-.8 6 .8l59 59c1.6 1.6 1.9 4.1.8 6-1.1 2-3.4 2.9-5.6 2.4 0 0-3.7-.9-9.6 0-13.6 1.8-24 13.2-25.5 27.7-1 9.7-29.7 40.7-30 41l-35.6 35.6c-6.5 6.4-15.1 10-24.3 10zm72.3-165.9c-2.5 18.2-17.5 32.2-36.6 34.1-5.6.6-10.7 3-14.8 7L38 429.1c-9.5 9.5-9.5 24.9 0 34.4L55.5 481c9.5 9.5 24.9 9.5 34.4 0l35.6-35.6c6.6-6.6 26-29.9 27.1-35 1.9-19 15.9-34 34.1-36.5l-41.6-41.6zm7.6 78.3z"/><path class="st1" d="M43.3 480.8c-1.3 0-2.6-.5-3.5-1.5-2-2-2-5.1 0-7.1l26.4-26.4c2-2 5.1-2 7.1 0s2 5.1 0 7.1l-26.4 26.4c-1 1.1-2.3 1.5-3.6 1.5zM87.9 436.3c-1.3 0-2.6-.5-3.5-1.5-2-2-2-5.1 0-7.1l35.9-35.9c2-2 5.1-2 7.1 0s2 5.1 0 7.1l-35.9 35.9c-1.1 1-2.4 1.5-3.6 1.5zM139.1 385c-1.3 0-2.6-.5-3.5-1.5-2-2-2-5.1 0-7.1l4.8-4.8c2-2 5.1-2 7.1 0s2 5.1 0 7.1l-4.8 4.8c-1 1-2.3 1.5-3.6 1.5zM200.7 323.5c-1.3 0-2.6-.5-3.5-1.5-2-2-2-5.1 0-7.1l210.1-210.1c2-2 5.1-2 7.1 0s2 5.1 0 7.1L204.2 322c-1 1-2.2 1.5-3.5 1.5z"/><g><path class="st0" d="M126.6 38.7 98.8 10.9C91 3 78.2 3 70.3 10.9c-7.9 7.9-7.9 20.6 0 28.5l17.2 17.2c4.6 4.6 6.9 10.9 6.3 17.4-.9 10.6-9.3 19-19.9 19.9-6.5.6-12.8-1.8-17.4-6.3L39.4 70.3c-7.9-7.9-20.6-7.9-28.5 0C3 78.2 3 91 10.9 98.8l27.8 27.8c4.1 4.1 9.7 6.4 15.5 6.4H85c5.8 0 11.4 2.3 15.5 6.4l260.1 260.1c4.1 4.1 6.4 9.7 6.4 15.5v30.8c0 5.8 2.3 11.4 6.4 15.5l27.8 27.8c7.9 7.9 20.6 7.9 28.5 0 7.9-7.9 7.9-20.6 0-28.5l-17.2-17.2c-4.6-4.6-6.9-10.9-6.3-17.4.9-10.6 9.3-19 19.9-19.9 6.5-.6 12.8 1.8 17.4 6.3l17.2 17.2c7.9 7.9 20.6 7.9 28.5 0 7.9-7.9 7.9-20.6 0-28.5l-27.8-27.8c-4.1-4.1-9.7-6.4-15.5-6.4H415c-5.8 0-11.4-2.3-15.5-6.4l-260-260c-4.1-4.1-6.4-9.7-6.4-15.5V54.2c-.1-5.8-2.4-11.4-6.5-15.5z"/><path class="st1" d="M415.4 500c-6.7 0-13-2.6-17.8-7.4l-27.8-27.8c-5.1-5.1-7.9-11.8-7.9-19V415c0-4.5-1.8-8.8-5-12L97 143c-3.2-3.2-7.4-5-12-5H54.2c-7.2 0-13.9-2.8-19-7.9L7.4 102.4C2.6 97.6 0 91.3 0 84.6s2.6-13 7.4-17.8c4.7-4.7 11.1-7.4 17.8-7.4 6.7 0 13 2.6 17.8 7.4L60.1 84c3.5 3.5 8.4 5.3 13.4 4.9 8.2-.7 14.6-7.2 15.4-15.4.4-5-1.3-9.9-4.9-13.4L66.8 42.9c-4.7-4.7-7.4-11.1-7.4-17.8 0-6.7 2.6-13 7.4-17.8C71.6 2.6 77.9 0 84.6 0s13 2.6 17.8 7.4l27.8 27.8c5.1 5.1 7.9 11.8 7.9 19V85c0 4.5 1.8 8.8 5 12L403 357c3.2 3.2 7.4 5 12 5h30.8c7.2 0 13.9 2.8 19 7.9l27.8 27.8c4.7 4.7 7.4 11.1 7.4 17.8s-2.6 13-7.4 17.8c-4.7 4.7-11.1 7.4-17.8 7.4-6.7 0-13-2.6-17.8-7.4L439.9 416c-3.5-3.5-8.4-5.3-13.4-4.9-8.2.7-14.6 7.2-15.4 15.4-.4 5 1.3 9.9 4.9 13.4l17.2 17.2c4.7 4.7 7.4 11.1 7.4 17.8 0 6.7-2.6 13-7.4 17.8-4.8 4.7-11.1 7.3-17.8 7.3zM25.1 69.4c-4 0-7.8 1.6-10.7 4.4-2.9 2.9-4.4 6.7-4.4 10.7s1.6 7.8 4.4 10.7L42.2 123c3.2 3.2 7.4 4.9 12 4.9H85c7.2 0 13.9 2.8 19 7.9L364.1 396c5.1 5.1 7.9 11.8 7.9 19v30.8c0 4.5 1.8 8.8 4.9 12l27.8 27.8c2.9 2.9 6.7 4.4 10.7 4.4 4 0 7.8-1.6 10.7-4.4 2.9-2.9 4.4-6.7 4.4-10.7 0-4-1.6-7.8-4.4-10.7L408.9 447c-5.6-5.6-8.5-13.4-7.8-21.4 1.1-13 11.4-23.3 24.4-24.4 7.9-.7 15.7 2.1 21.4 7.8l17.2 17.2c2.9 2.9 6.7 4.4 10.7 4.4 4 0 7.8-1.6 10.7-4.4 2.9-2.9 4.4-6.7 4.4-10.7 0-4-1.6-7.8-4.4-10.7L457.7 377c-3.2-3.2-7.4-4.9-12-4.9H415c-7.2 0-13.9-2.8-19-7.9L135.9 104c-5.1-5.1-7.9-11.8-7.9-19V54.2c0-4.5-1.8-8.8-4.9-12L95.3 14.4c-2.9-2.9-6.7-4.4-10.7-4.4s-7.8 1.6-10.7 4.4c-2.9 2.9-4.4 6.7-4.4 10.7 0 4 1.6 7.8 4.4 10.7L91.1 53c5.6 5.6 8.5 13.4 7.8 21.4-1.1 13-11.4 23.3-24.4 24.4-7.9.7-15.7-2.1-21.4-7.8L35.8 73.9c-2.8-2.9-6.6-4.5-10.7-4.5z"/></g></svg>
                         SEO Report Summary</h3>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" id="pageSelector" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo htmlentities(reset($pagesVisitCounts)->page_name); ?>
                        </button>
                        <div id="seoPageSelect" class="dropdown-menu dropdown-menu-right" aria-labelledby="pageSelector">
                            <?php foreach ($pagesVisitCounts as $page) { ?>
                                <a class="dropdown-item seo-page-option" href="#" data-id="<?php echo (int)$page->id; ?>" data-name="<?php echo htmlentities($page->page_name); ?>">
                                    <?php echo htmlentities($page->page_name); ?>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div id="seo-report-content">
                    <div class="text-muted">Loading SEO data...</div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>

    
    
 
</div>

<?
/*
<div class="container-fluid">
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="widget">
                                    <div class="widget-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="state">
                                                <h6>Bookmarks</h6>
                                                <h2>1,410</h2>
                                            </div>
                                            <div class="icon">
                                                <i class="ik ik-award"></i>
                                            </div>
                                        </div>
                                        <small class="text-small mt-10 d-block">6% higher than last month</small>
                                    </div>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: 62%;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="widget">
                                    <div class="widget-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="state">
                                                <h6>Likes</h6>
                                                <h2>41,410</h2>
                                            </div>
                                            <div class="icon">
                                                <i class="ik ik-thumbs-up"></i>
                                            </div>
                                        </div>
                                        <small class="text-small mt-10 d-block">61% higher than last month</small>
                                    </div>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100" style="width: 78%;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="widget">
                                    <div class="widget-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="state">
                                                <h6>Events</h6>
                                                <h2>410</h2>
                                            </div>
                                            <div class="icon">
                                                <i class="ik ik-calendar"></i>
                                            </div>
                                        </div>
                                        <small class="text-small mt-10 d-block">Total Events</small>
                                    </div>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100" style="width: 31%;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="widget">
                                    <div class="widget-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="state">
                                                <h6>Comments</h6>
                                                <h2>41,410</h2>
                                            </div>
                                            <div class="icon">
                                                <i class="ik ik-message-square"></i>
                                            </div>
                                        </div>
                                        <small class="text-small mt-10 d-block">Total Comments</small>
                                    </div>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-lg-8 col-md-12">
                                                <h3 class="card-title">Visitors By Countries</h3>
                                                <div id="visitfromworld" style="width:100%; height:350px"></div>
                                            </div>
                                            <div class="col-lg-4 col-md-12">
                                                <div class="row mb-15">
                                                    <div class="col-9">India</div>
                                                    <div class="col-3 text-right">28%</div>
                                                    <div class="col-12">
                                                        <div class="progress progress-sm mt-5">
                                                            <div class="progress-bar bg-green" role="progressbar" style="width: 48%" aria-valuenow="48" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-15">
                                                    <div class="col-9"> UK</div>
                                                    <div class="col-3 text-right">21%</div>
                                                    <div class="col-12">
                                                        <div class="progress progress-sm mt-5">
                                                            <div class="progress-bar bg-aqua" role="progressbar" style="width: 33%" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-15">
                                                    <div class="col-9"> USA</div>
                                                    <div class="col-3 text-right">18%</div>
                                                    <div class="col-12">
                                                        <div class="progress progress-sm mt-5">
                                                            <div class="progress-bar bg-purple" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-9">China</div>
                                                    <div class="col-3 text-right">12%</div>
                                                    <div class="col-12">
                                                        <div class="progress progress-sm mt-5">
                                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card" style="min-height: 422px;">
                                    <div class="card-header"><h3>Donut chart</h3></div>
                                    <div class="card-body">
                                        <div id="c3-donut-chart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>Recent Chat</h3>
                                        <div class="card-header-right">
                                            <ul class="list-unstyled card-option">
                                                <li><i class="ik ik-chevron-left action-toggle"></i></li>
                                                <li><i class="ik ik-minus minimize-card"></i></li>
                                                <li><i class="ik ik-x close-card"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-body chat-box scrollable" style="height:300px;">
                                        <ul class="chat-list">
                                            <li class="chat-item">
                                                <div class="chat-img"><img src="<?php echo base_url('public/admin/theme/')?>img/users/1.jpg" alt="user"></div>
                                                <div class="chat-content">
                                                    <h6 class="font-medium">James Anderson</h6>
                                                    <div class="box bg-light-info">Lorem Ipsum is simply dummy text of the printing &amp; type setting industry.</div>
                                                </div>
                                                <div class="chat-time">10:56 am</div>
                                            </li>
                                            <li class="chat-item">
                                                <div class="chat-img"><img src="<?php echo base_url('public/admin/theme/')?>img/users/2.jpg" alt="user"></div>
                                                <div class="chat-content">
                                                    <h6 class="font-medium">Bianca Doe</h6>
                                                    <div class="box bg-light-info">Itâ€™s Great opportunity to work.</div>
                                                </div>
                                                <div class="chat-time">10:57 am</div>
                                            </li>
                                            <li class="odd chat-item">
                                                <div class="chat-content">
                                                    <div class="box bg-light-inverse">I would love to join the team.</div>
                                                    <br>
                                                </div>
                                            </li>
                                            <li class="odd chat-item">
                                                <div class="chat-content">
                                                    <div class="box bg-light-inverse">Whats budget of the new project.</div>
                                                    <br>
                                                </div>
                                                <div class="chat-time">10:59 am</div>
                                            </li>
                                            <li class="chat-item">
                                                <div class="chat-img"><img src="<?php echo base_url('public/admin/theme/')?>img/users/3.jpg" alt="user"></div>
                                                <div class="chat-content">
                                                    <h6 class="font-medium">Angelina Rhodes</h6>
                                                    <div class="box bg-light-info">Well we have good budget for the project</div>
                                                </div>
                                                <div class="chat-time">11:00 am</div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-footer chat-footer">
                                        <div class="input-wrap">
                                            <input type="text" placeholder="Type and enter" class="form-control">
                                        </div>
                                        <button type="button" class="btn btn-icon btn-theme"><i class="fa fa-paper-plane"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <h4 class="card-title">Weather Report</h4>
                                            <select class="form-control w-25 ml-auto">
                                                <option selected="">Today</option>
                                                <option value="1">Weekly</option>
                                            </select>
                                        </div>
                                        <div class="d-flex align-items-center flex-row mt-30">
                                            <div class="p-2 f-50 text-info"><i class="wi wi-day-showers"></i> <span>23<sup>Â°</sup></span></div>
                                            <div class="p-2">
                                            <h3 class="mb-0">Saturday</h3><small>Banglore, India</small></div>
                                        </div>
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td>Wind</td>
                                                    <td class="font-medium">ESE 17 mph</td>
                                                </tr>
                                                <tr>
                                                    <td>Humidity</td>
                                                    <td class="font-medium">83%</td>
                                                </tr>
                                                <tr>
                                                    <td>Pressure</td>
                                                    <td class="font-medium">28.56 in</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <hr>
                                        <ul class="list-unstyled row text-center city-weather-days mb-0 mt-20">
                                            <li class="col"><i class="wi wi-day-sunny mr-5"></i><span>09:30</span><h3>20<sup>Â°</sup></h3></li>
                                            <li class="col"><i class="wi wi-day-cloudy mr-5"></i><span>11:30</span><h3>22<sup>Â°</sup></h3></li>
                                            <li class="col"><i class="wi wi-day-hail mr-5"></i><span>13:30</span><h3>25<sup>Â°</sup></h3></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card" style="min-height: 422px;">
                                    <div class="card-header">
                                        <h3>Timeline</h3>
                                        <div class="card-header-right">
                                            <ul class="list-unstyled card-option">
                                                <li><i class="ik ik-chevron-left action-toggle"></i></li>
                                                <li><i class="ik ik-minus minimize-card"></i></li>
                                                <li><i class="ik ik-x close-card"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-body timeline">
                                        <div class="header bg-theme" style="background-image: url('img/placeholder/placeimg_400_200_nature.jpg')">
                                            <div class="color-overlay d-flex align-items-center">
                                                <div class="day-number">8</div>
                                                <div class="date-right">
                                                    <div class="day-name">Monday</div>
                                                    <div class="month">February 2018</div>
                                                </div>
                                            </div>                                
                                        </div>
                                        <ul>
                                            <li>
                                                <div class="bullet bg-pink"></div>
                                                <div class="time">11am</div>
                                                <div class="desc">
                                                    <h3>Attendance</h3>
                                                    <h4>Computer Class</h4>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="bullet bg-green"></div>
                                                <div class="time">12pm</div>
                                                <div class="desc">
                                                    <h3>Design Team</h3>
                                                    <h4>Hangouts</h4>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="bullet bg-orange"></div>
                                                <div class="time">2pm</div>
                                                <div class="desc">
                                                    <h3>Finish</h3>
                                                    <h4>Go to Home</h4>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-header row">
                                <div class="col col-sm-3">
                                    <div class="dropdown d-inline-block">
                                        <a class="btn-icon checkbox-dropdown dropdown-toggle" href="#" id="moreDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                                        <div class="dropdown-menu" aria-labelledby="moreDropdown">
                                            <a class="dropdown-item" id="checkbox_select_all" href="javascript:void(0);">Select All</a>
                                            <a class="dropdown-item" id="checkbox_deselect_all" href="javascript:void(0);">Deselect All</a>
                                        </div>
                                    </div>
                                    <div class="card-options d-inline-block">
                                        <a href="#"><i class="ik ik-inbox"></i></a>
                                        <a href="#"><i class="ik ik-plus"></i></a>
                                        <a href="#"><i class="ik ik-rotate-cw"></i></a>
                                        <div class="dropdown d-inline-block">
                                            <a class="nav-link dropdown-toggle" href="#" id="moreDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-more-horizontal"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="moreDropdown">
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">More Action</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col col-sm-6">
                                    <div class="card-search with-adv-search dropdown">
                                        <form action="#">
                                            <input type="text" class="form-control" placeholder="Search.." required>
                                            <button type="submit" class="btn btn-icon"><i class="ik ik-search"></i></button>
                                            <button type="button" id="adv_wrap_toggler" class="adv-btn ik ik-chevron-down dropdown-toggle" data-toggle="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                            <div class="adv-search-wrap dropdown-menu dropdown-menu-right" aria-labelledby="adv_wrap_toggler">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Full Name">
                                                </div>
                                                <div class="form-group">
                                                    <input type="email" class="form-control" placeholder="Email">
                                                </div>
                                                <button class="btn btn-theme">Search</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col col-sm-3">
                                    <div class="card-options text-right">
                                        <span class="mr-5">1 - 50 of 2,500</span>
                                        <a href="#"><i class="ik ik-chevron-left"></i></a>
                                        <a href="#"><i class="ik ik-chevron-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="list-item-wrap">
                                    <div class="list-item">
                                        <div class="item-inner">
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="item_checkbox" name="item_checkbox" value="option1">
                                                <span class="custom-control-label">&nbsp;</span>
                                            </label>
                                            <div class="list-title"><a href="javascript:void(0)">Lorem Ipsum is simply dumm dummy text of the printing and typesetting industry.</a></div>
                                            <div class="list-actions">
                                                <a href="#"><i class="ik ik-eye"></i></a>
                                                <a href="#"><i class="ik ik-inbox"></i></a>
                                                <a href="#"><i class="ik ik-edit-2"></i></a>
                                                <a href="#"><i class="ik ik-trash-2"></i></a>
                                            </div>
                                        </div>

                                        <div class="qickview-wrap">
                                            <div class="desc">
                                                <p>Fusce suscipit turpis a dolor posuere ornare at a ante. Quisque nec libero facilisis, egestas tortor eget, mattis dui. Curabitur viverra laoreet ligula at hendrerit. Nullam sollicitudin maximus leo, vel pulvinar orci semper id. Donec vehicula tempus enim a facilisis. Proin dignissim porttitor sem, sed pulvinar tortor gravida vitae.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-item">
                                        <div class="item-inner">
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="item_checkbox" name="item_checkbox" value="option2">
                                                <span class="custom-control-label">&nbsp;</span>
                                            </label>
                                            <div class="list-title"><a href="javascript:void(0)">Aenean eu pharetra arcu, vitae elementum sem. Sed non ligula molestie, finibus lacus at, suscipit mi. Nunc luctus lacus vel felis blandit, eu finibus augue tincidunt.</a></div>
                                            <div class="list-actions">
                                                <a href="#"><i class="ik ik-eye"></i></a>
                                                <a href="#"><i class="ik ik-inbox"></i></a>
                                                <a href="#"><i class="ik ik-edit-2"></i></a>
                                                <a href="#"><i class="ik ik-trash-2"></i></a>
                                            </div>
                                        </div>
                                        <div class="qickview-wrap">
                                            <div class="desc">
                                                <p>Fusce suscipit turpis a dolor posuere ornare at a ante. Quisque nec libero facilisis, egestas tortor eget, mattis dui. Curabitur viverra laoreet ligula at hendrerit. Nullam sollicitudin maximus leo, vel pulvinar orci semper id. Donec vehicula tempus enim a facilisis. Proin dignissim porttitor sem, sed pulvinar tortor gravida vitae.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-item">
                                        <div class="item-inner">
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="item_checkbox" name="item_checkbox" value="option3">
                                                <span class="custom-control-label">&nbsp;</span>
                                            </label>
                                            <div class="list-title"><a href="javascript:void(0)">Donec lectus augue, suscipit in sodales sit amet, semper sit amet enim. Duis pretium, nisi id pretium ornare, tortor nibh sodales tellus.</a></div>
                                            <div class="list-actions">
                                                <a href="#"><i class="ik ik-eye"></i></a>
                                                <a href="#"><i class="ik ik-inbox"></i></a>
                                                <a href="#"><i class="ik ik-edit-2"></i></a>
                                                <a href="#"><i class="ik ik-trash-2"></i></a>
                                            </div>
                                        </div>
                                        <div class="qickview-wrap">
                                            <div class="desc">
                                                <p>Fusce suscipit turpis a dolor posuere ornare at a ante. Quisque nec libero facilisis, egestas tortor eget, mattis dui. Curabitur viverra laoreet ligula at hendrerit. Nullam sollicitudin maximus leo, vel pulvinar orci semper id. Donec vehicula tempus enim a facilisis. Proin dignissim porttitor sem, sed pulvinar tortor gravida vitae.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header row">
                                <div class="col col-sm-3">
                                    <div class="card-options d-inline-block">
                                        <a href="#"><i class="ik ik-inbox"></i></a>
                                        <a href="#"><i class="ik ik-plus"></i></a>
                                        <a href="#"><i class="ik ik-rotate-cw"></i></a>
                                        <div class="dropdown d-inline-block">
                                            <a class="nav-link dropdown-toggle" href="#" id="moreDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-more-horizontal"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="moreDropdown">
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">More Action</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col col-sm-6">
                                    <div class="card-search with-adv-search dropdown">
                                        <form action="#">
                                            <input type="text" class="form-control global_filter" id="global_filter" placeholder="Search.." required>
                                            <button type="submit" class="btn btn-icon"><i class="ik ik-search"></i></button>
                                            <button type="button" id="adv_wrap_toggler" class="adv-btn ik ik-chevron-down dropdown-toggle" data-toggle="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                            <div class="adv-search-wrap dropdown-menu dropdown-menu-right" aria-labelledby="adv_wrap_toggler">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control column_filter" id="col0_filter" placeholder="Name" data-column="0">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control column_filter" id="col1_filter" placeholder="Position" data-column="1">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control column_filter" id="col2_filter" placeholder="Office" data-column="2">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control column_filter" id="col3_filter" placeholder="Age" data-column="3">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control column_filter" id="col4_filter" placeholder="Start date" data-column="4">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control column_filter" id="col5_filter" placeholder="Salary" data-column="5">
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn btn-theme">Search</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col col-sm-3">
                                    <div class="card-options text-right">
                                        <span class="mr-5" id="top">1 - 50 of 2,500</span>
                                        <a href="#"><i class="ik ik-chevron-left"></i></a>
                                        <a href="#"><i class="ik ik-chevron-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="advanced_table" class="table">
                                    <thead>
                                        <tr>
                                            <th class="nosort" width="10">
                                                <label class="custom-control custom-checkbox m-0">
                                                    <input type="checkbox" class="custom-control-input" id="selectall" name="" value="option2">
                                                    <span class="custom-control-label">&nbsp;</span>
                                                </label>
                                            </th>
                                            <th class="nosort">Avatar</th>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Age</th>
                                            <th>Start date</th>
                                            <th>Salary</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input select_all_child" id="" name="" value="option2">
                                                    <span class="custom-control-label">&nbsp;</span>
                                                </label>
                                            </td>
                                            <td><img src="img/users/1.jpg" class="table-user-thumb" alt=""></td>
                                            <td>Tiger Nixon</td>
                                            <td>System Architect</td>
                                            <td>Edinburgh</td>
                                            <td>61</td>
                                            <td>2011/04/25</td>
                                            <td>$320,800</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input select_all_child" id="" name="" value="option2">
                                                    <span class="custom-control-label">&nbsp;</span>
                                                </label>
                                            </td>
                                            <td><img src="img/users/2.jpg" class="table-user-thumb" alt=""></td>
                                            <td>Garrett Winters</td>
                                            <td>Accountant</td>
                                            <td>Tokyo</td>
                                            <td>63</td>
                                            <td>2011/07/25</td>
                                            <td>$170,750</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input select_all_child" id="" name="" value="option2">
                                                    <span class="custom-control-label">&nbsp;</span>
                                                </label>
                                            </td>
                                            <td><img src="img/users/3.jpg" class="table-user-thumb" alt=""></td>
                                            <td>Ashton Cox</td>
                                            <td>Junior Technical Author</td>
                                            <td>San Francisco</td>
                                            <td>66</td>
                                            <td>2009/01/12</td>
                                            <td>$86,000</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input select_all_child" id="" name="" value="option2">
                                                    <span class="custom-control-label">&nbsp;</span>
                                                </label>
                                            </td>
                                            <td><img src="img/users/4.jpg" class="table-user-thumb" alt=""></td>
                                            <td>Cedric Kelly</td>
                                            <td>Senior Javascript Developer</td>
                                            <td>Edinburgh</td>
                                            <td>22</td>
                                            <td>2012/03/29</td>
                                            <td>$433,060</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input select_all_child" id="" name="" value="option2">
                                                    <span class="custom-control-label">&nbsp;</span>
                                                </label>
                                            </td>
                                            <td><img src="img/users/5.jpg" class="table-user-thumb" alt=""></td>
                                            <td>Airi Satou</td>
                                            <td>Accountant</td>
                                            <td>Tokyo</td>
                                            <td>33</td>
                                            <td>2008/11/28</td>
                                            <td>$162,700</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input select_all_child" id="" name="" value="option2">
                                                    <span class="custom-control-label">&nbsp;</span>
                                                </label>
                                            </td>
                                            <td><img src="img/users/1.jpg" class="table-user-thumb" alt=""></td>
                                            <td>Brielle Williamson</td>
                                            <td>Integration Specialist</td>
                                            <td>New York</td>
                                            <td>61</td>
                                            <td>2012/12/02</td>
                                            <td>$372,000</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input select_all_child" id="" name="" value="option2">
                                                    <span class="custom-control-label">&nbsp;</span>
                                                </label>
                                            </td>
                                            <td><img src="img/users/2.jpg" class="table-user-thumb" alt=""></td>
                                            <td>Herrod Chandler</td>
                                            <td>Sales Assistant</td>
                                            <td>San Francisco</td>
                                            <td>59</td>
                                            <td>2012/08/06</td>
                                            <td>$137,500</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input select_all_child" id="" name="" value="option2">
                                                    <span class="custom-control-label">&nbsp;</span>
                                                </label>
                                            </td>
                                            <td><img src="img/users/3.jpg" class="table-user-thumb" alt=""></td>
                                            <td>Rhona Davidson</td>
                                            <td>Integration Specialist</td>
                                            <td>Tokyo</td>
                                            <td>55</td>
                                            <td>2010/10/14</td>
                                            <td>$327,900</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input select_all_child" id="" name="" value="option2">
                                                    <span class="custom-control-label">&nbsp;</span>
                                                </label>
                                            </td>
                                            <td><img src="img/users/4.jpg" class="table-user-thumb" alt=""></td>
                                            <td>Colleen Hurst</td>
                                            <td>Javascript Developer</td>
                                            <td>San Francisco</td>
                                            <td>39</td>
                                            <td>2009/09/15</td>
                                            <td>$205,500</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    */?>
                    
<script>
$(document).ready(function () {
    function loadSeoReport(pageId) {
    $('#seo-report-content').html('<div class="text-muted">Loading SEO data...</div>');

    $.ajax({
        url: '/web/get_seo_report',
        type: 'GET',
        data: { page: pageId },
        dataType: 'json',
        success: function (res) {
            let html = '<div class="row">';

            html += generateSeoItem('Title Tag', res.titlePresent, 'ik-check-circle', 'ik-alert-circle');
            html += generateSeoItem('Meta Description', res.metaDescriptionPresent, 'ik-check-circle', 'ik-alert-circle');
            html += generateSeoItem('Viewport Tag', res.viewportSet, 'ik-check-circle', 'ik-alert-circle');
            html += generateSeoItem('H1 Tag', res.h1Present, 'ik-check-circle', 'ik-alert-circle');
            html += generateSeoItem('Missing ALT Attributes', -res.missingAltAttributes, 'ik-check-circle', 'ik-alert-triangle');
            html += generateSeoItem('Missing Link Text', -res.missingLinkText, 'ik-check-circle', 'ik-alert-triangle');
            html += generateSeoItem('Canonical Tag', res.canonicalTag, 'ik-check-circle', 'ik-alert-circle');
            html += generateSeoItem('robots.txt', res.robotsTxtExists, 'ik-check-circle', 'ik-alert-circle');
            
            // New items
            html += generateSeoItem('Favicon Present', res.faviconPresent, 'ik-check-circle', 'ik-alert-circle');
            html += generateSeoItem('Word Count: ' + res.wordCount, res.wordCount >= 300, 'ik-check-circle', 'ik-alert-triangle');
            html += generateSeoItem('Emphasis Tags (strong/em)', res.hasEmphasisTags, 'ik-check-circle', 'ik-alert-circle');
            html += generateSeoItem('Multiple H1 Tags', !res.multipleH1, 'ik-check-circle', 'ik-alert-triangle');
            html += generateSeoItem('HTML Lang Attribute', res.htmlLangSet, 'ik-check-circle', 'ik-alert-circle');
            html += generateSeoItem('Mobile-Friendly (Viewport)', res.mobileFriendly, 'ik-check-circle', 'ik-alert-circle');

            html += '</div>';
            $('#seo-report-content').html(html);
        },
        error: function () {
            $('#seo-report-content').html('<div class="text-danger">Failed to load report.</div>');
        }
    });
}

    function generateSeoItem(label, status, iconSuccess, iconFail) {
        let isPass = true;
        let message = '';
        let icon = iconSuccess;
        let color = 'text-success';
    
        if (typeof status === 'boolean') {
            isPass = status;
            message = `${label}: ${isPass ? 'Present' : 'Missing'}`;
        } else if (typeof status === 'number') {
            isPass = status <= 0;
            message = isPass ? `${label}: OK` : `${label}: ${-status} issue(s)`;
        }
    
        if (!isPass) {
            icon = iconFail;
            color = 'text-danger';
        }
    
        return `<div class="col-md-6 mb-3">
                    <div class="d-flex align-items-center">
                        <i class="ik ${icon} ${color} mr-2"></i>
                        <span>${message}</span>
                    </div>
                </div>`;
    }

    // Handle dropdown item click
    $(document).on('click', '.seo-page-option', function (e) {
        e.preventDefault();
        var pageId = $(this).data('id');
        var pageName = $(this).data('name');

        $('#pageSelector').text(pageName);
        loadSeoReport(pageId);
    });

    // Initial load using the first item
    const firstPageId = $('.seo-page-option').first().data('id');
    if (firstPageId) {
        loadSeoReport(firstPageId);
    }
});
</script>
