<?php
$id = intval(@$_GET['id']);
$get = $this->db->order_by('id','desc')->get_where('form_data',['id'=>$id]);
$row  = $get->row();
$data = json_decode($row->data);
?>

<table class="table table-bordered">
    <?php 
        foreach($data as $key => $val){
            if(is_image_format($val)){
                $val = "<a href='".base_url('public/temp/').CLIENT_ID.'/'.$val."'>$val</a>";
            }
            echo '<tr>
                    <th>'.$key.'</th>
                    <td>'.$val.'</td>
                </tr>';
        }
        function is_image_format($filename) {
            // List of allowed image file extensions
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];
        
            // Extract the file extension
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
        
            // Check if the extension is in the list of allowed extensions
            return in_array(strtolower($extension), $allowed_extensions);
        }
    ?>
</table>