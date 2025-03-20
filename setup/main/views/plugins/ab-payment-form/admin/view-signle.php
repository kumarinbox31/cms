<?php
$id = intval(@$_GET['id']);
$get = $this->db->order_by('id','desc')->get_where('ab_payment_data',['id'=>$id]);
$row  = $get->row();
$data = json_decode($row->data);
?>

<table class="table table-bordered">
    <?php 
        foreach ($data as $key => $val) {
    if (is_string($val) && is_image_format($val)) { // Check if $val is a string
        $val = "<a href='" . base_url('public/temp/') . CLIENT_ID . '/' . $val . "'>$val</a>";
    } elseif (is_array($val)) {
        // Handle array values if needed
        $val = json_encode($val); // Convert array to JSON string for display
    }

    echo '<tr>
            <th>' . ucwords(htmlspecialchars($key)) . '</th>
            <td>' . $val . '</td>
        </tr>';
}

function is_image_format($filename) {
    return is_string($filename) && preg_match('/\.(jpg|jpeg|png|gif|pdf)$/i', $filename) ? true : false;
    // List of allowed image file extensions
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];

    // Ensure $filename is a string before extracting the extension
    if (!is_string($filename)) {
        return false;
    }

    // Extract the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // Check if the extension is in the list of allowed extensions
    return in_array(strtolower($extension), $allowed_extensions);
}

    ?>
</table>