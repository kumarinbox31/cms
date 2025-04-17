<?php
$formId = intval(@$_GET['id']);
if (empty($formId) || $formId <= 0) {
    die('Invalid Form ID');
}

$ci = &get_instance();
$get = $ci->ServiceModel->getServiceById($formId);

if ($get === false) {
    error_log('Database query failed in getServiceById');
    die('An error occurred. Please try again later.');
}

if ($get->num_rows() > 0) {
    $data = $get->row();
    if (empty($data)) {
        die('No data found for the given Form ID');
    }
    // Prevent inserting if data is incomplete
    if (!isset($data->title)) {
        die('Invalid data. Required fields are missing.');
    }
    ?>
    <div class="container">
        <form method="get" action="">
            <input type="hidden" name="page" value="copy">
            <input type="hidden" name="id" value="<?=$data->id;?>">
        <div class="card card-primary">
            <div class="card-header">
                Copy Form "<?php echo $data->title; ?>"
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" plaseholder="Enter title" value="<?php echo $data->title; ?>">
                </div>
                <div class="form-group">
                    <label>Website</label>
                    <select class="form-control select2" name="admin_id"> 
                    <?php 
                        $websites = $this->website->get();
                        if($websites->num_rows()){
                            foreach($websites->result() as $web){
                                $selected = $data->admin_id == $web->id ? 'selected' : '';
                                echo '<option value="'.$web->id.'" '.$selected.'>'.$web->domain.'</option>';
                            }
                        }
                    ?>
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
            </div>
        </div>
        </form>
    </div>
    <?php
    
} else {
    die('Form not found or already deleted.');
}
