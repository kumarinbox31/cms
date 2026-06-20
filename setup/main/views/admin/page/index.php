<div class="page-header">
   <div class="row align-items-end">
      <div class="col-lg-8">
         <div class="page-header-title">
            <i class="ik ik-inbox bg-blue"></i>
            <div class="d-inline">
               <h5>Pages List</h5>
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
               <li class="breadcrumb-item active" aria-current="page">List</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="card">
    <div class="card-header">
        <a href="<?php echo base_url('admin/page/trash'); ?>" class="btn btn-sm btn-warning">Trash</a>
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
                  <th>Copy Url</th>
                  <th>Default Page</th>
                  <th>Actions</th>
               </tr>
            </thead>
            <tbody>
                <?php  
                    $i  = 1;
                    $pages = $this->PageModel->get(['admin_id'=>CLIENT_ID,'trash'=>'0']);
                    foreach($pages->result() as $page){
                        $chkd = $page->id == DEFAULTPAGE ? 'checked' : '';
                        $url = base_url('page/').$page->uri;
                        echo  '<tr>
                                <td>'.$i++.'</td>
                                <td>'.$page->page_name.'</td>
                                <td>'.$page->uri.'</td>
                                <td>
                                    <a onclick="copyUrl('."'".$url."'".');" class="btn btn-sm btn-info"><i class="fa fa-copy"></i></a>
                                </td>
                                <td>
                                    <input type="radio" name="default_page" value="'.$page->id.'" '.$chkd.' onclick="setDefault('.$page->id.');" >
                                </td>
                                <td>
                                    <a href="'.base_url('admin/page/setting/'.$page->id).'" class="btn btn-sm btn-primary" title="Settings"><i class="fa fa-cog"></i></a>
                                    <a href="'.base_url('admin/editor?type=page&pageid=').$page->id.'" class="btn btn-info btn-sm" title="Normal Editor"><i class="fa fa-edit"></i></a>
                                    <!-- <a href="'.base_url('Ai/editor/page/').$page->id.'" class="btn btn-success btn-sm" title="AI Builder Pro"><i class="fa fa-magic"></i> AI</a> -->
                                    <a onclick="return confirm('."'Are you sure?'".');" href="'.base_url('admin/page?action=trash&id=').$page->id.'" class="btn btn-sm btn-danger" title="Trash"><i class="fa fa-trash"></i></a>
                                
                                </td>
                                
                            </tr>';
                    }
                ?>
               
       
            </tbody>
         </table>
      </div>
   </div>
</div>
<script>
    function setDefault(id){
        $.ajax({
            url:"<?php echo base_url('admin/ajax'); ?>",
            type:'post',
            data:{id:id,action:'setDefault'},
            dataType:'json',
            beforeSend:function(){
                notify('info','Processing....');
            },
            success:function(res){
                notify('success','Process Complete');
                setTimeout(function(){
                    window.location.reload();
                },2000);
            }
        });
    }
    function copyUrl(url) {
      // Create a temporary input element
      var tempInput = document.createElement("input");
      
      // Set the input value to the URL you want to copy
      tempInput.value = url;
      
      // Append the input element to the DOM
      document.body.appendChild(tempInput);
      
      // Select the input content
      tempInput.select();
      tempInput.setSelectionRange(0, 99999); // For mobile devices
      
      // Copy the selected content to the clipboard
      document.execCommand("copy");
      
      // Remove the temporary input element
      document.body.removeChild(tempInput);
      
      // You can also provide user feedback, e.g., alert or console.log
      console.log("URL copied to clipboard: " + url);
    }
    

</script>