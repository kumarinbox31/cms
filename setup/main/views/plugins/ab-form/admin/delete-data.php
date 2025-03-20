<?php
$ci = &get_instance(); // Get CodeIgniter instance

// Retrieve and validate the `ab_form_data` ID
$id = $this->input->get('id', true);
$form_id = $this->input->get('form_id', true);

if (empty($id) || empty($form_id)) {
    // Set error message and redirect
    $ci->session->set_flashdata('error', 'Invalid request. Please try again.');
    redirect(base_url('admin/plugin/ab-form?page=show-data&id=' . $form_id));
    exit;
}

// Delete the record
$ins = $this->db->where('id', $id)->delete('ab_form_data');
if(!$ins){
    print_r($this->db->error());exit;
}
if ($this->db->affected_rows() > 0) {
    // Set success message and redirect
    $ci->session->set_flashdata('success', 'Record deleted successfully.');
} else {
    // Set error message if no rows were affected
    $ci->session->set_flashdata('error', 'Failed to delete the record. It may not exist.');
}

redirect(base_url('admin/plugin/ab-form?page=show-data&id=' . $form_id));
