<?php
$id = intval(@$_GET['id']);
$get = $this->db->order_by('id','desc')->get_where('form_data',['id'=>$id]);
$row  = $get->row();
$data = json_decode($row->data);
?>

<table class="table table-bordered">
    <?php 
        foreach($data as $key => $val){
            echo '<tr>
                    <th>'.$key.'</th>
                    <td>'.$val.'</td>
                </tr>';
        }
    ?>
</table>