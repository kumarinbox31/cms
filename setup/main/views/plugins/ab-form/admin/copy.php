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
    if (!isset($data->title) || !isset($data->content)) {
        die('Invalid data. Required fields are missing.');
    }

    $data->id = null; // Reset ID for new insertion
    if(isset($_GET['admin_id'])){
        $data->admin_id = $this->input->get('admin_id',true);
    }
    if(isset($_GET['title'])){
        $data->title = $this->input->get('title',true);
    }
    if (!$ci->db->insert('ab_service', $data)) {
        error_log('Failed to insert data into ab_service: ' . $ci->db->error());
        die('Failed to save the form. Please contact support.');
    }

    $new_id = $ci->db->insert_id();
    if (empty($new_id)) {
        die('Form creation failed.');
    }

    // Log success
    error_log("Form duplicated successfully. New ID: $new_id");

    $desc = $data->desc;
    if ($desc === 'formio') {
        redirect("/admin/plugin/ab-form?page=formio-editor&id=" . $new_id);
    } else {
        redirect("/admin/plugin/ab-form?page=editor&id=" . $new_id);
    }
} else {
    die('Form not found or already deleted.');
}
