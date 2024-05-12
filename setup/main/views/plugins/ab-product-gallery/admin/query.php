<div class="card">
    <div class="card-header">
        All Query
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped datatable" id="datatable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>City</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $i = 1;
                    $ci = &get_instance();
                    $get = $this->db->select('ab_product_query.*, ab_gallery_item.title as product_name')
                  ->from('ab_product_query')
                  ->order_by('ab_product_query.id', 'desc')
                  ->join('ab_gallery_item', 'ab_gallery_item.id = ab_product_query.productid')
                  ->where(['ab_product_query.admin_id' => CLIENT_ID, 'ab_product_query.galleryid' => @$_GET['id']])
                  ->get();
                    if($get->num_rows()){
                        foreach($get->result() as $row){
                            echo '<tr>
                                <td>'.$i++.'</td>
                                <td>'.$row->product_name.'</td>
                                <td>'.$row->name.'</td>
                                <td>'.$row->email.'</td>
                                <td>'.$row->phone.'</td>
                                <td>'.$row->city.'</td>
                            
                            </tr>';
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>