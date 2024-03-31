<div class="page-header">
   <div class="row align-items-end">
      <div class="col-lg-8">
         <div class="page-header-title">
            <i class="ik ik-inbox bg-blue"></i>
            <div class="d-inline">
               <h5>Trash Pages List</h5>
            </div>
         </div>
      </div>
      <div class="col-lg-4">
         <nav class="breadcrumb-container" aria-label="breadcrumb">
            <ol class="breadcrumb">
               <li class="breadcrumb-item">
                  <a href="/admin"><i class="ik ik-home"></i></a>
               </li>
               <li class="breadcrumb-item">
                  <a href="#">Page</a>
               </li>
               <li class="breadcrumb-item active" aria-current="page">Trash</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="card">
    <div class="card-header">
        <a href="<?php echo base_url('admin/page/'); ?>" class="btn btn-sm btn-info">Back</a>
    </div>
   <div class="card-body">
      <div class="dt-responsive">
         <table id="alt-pg-dt"
            class="table table-striped table-bordered  " id="data_table">
            <thead>
               <tr>
                   <th>#</th>
                  <th>Page Name</th>
                  <th>URI</th>
                  <th>Actions</th>
               </tr>
            </thead>
            <tbody>
                <?php  
                    $i  = 1;
                    $pages = $this->PageModel->get(['admin_id'=>CLIENT_ID,'trash'=>'1']);
                    foreach($pages->result() as $page){
                        echo  '<tr>
                                <td>'.$i++.'</td>
                                <td>'.$page->page_name.'</td>
                                <td>'.$page->uri.'</td>
                                <td></td>
                                <td>
                                    <a onclick="return confirm('."'Are you sure?'".');" href="'.base_url('admin/page?action=trash&id=').$page->id.'" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                
                                </td>
                                
                            </tr>';
                    }
                ?>
               
       
            </tbody>
         </table>
      </div>
   </div>
</div>