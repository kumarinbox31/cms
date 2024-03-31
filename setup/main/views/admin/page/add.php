<style>
    .card-header > h3{
        width:100%;
    }
    .pull-right{
        float:right;
    }
</style>
<div class="page-header">
   <div class="row align-items-end">
      <div class="col-lg-8">
         <div class="page-header-title">
            <i class="ik ik-inbox bg-blue"></i>
            <div class="d-inline">
               <h5>Add New Page</h5>
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
               <li class="breadcrumb-item active" aria-current="page">Add</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<style>
    #url{
        display:none;
    }
</style>
<form method="POST" id="add_page">
<div class="card">
    <div class="card-header">
        <h3>
            Add New Page 
            <button type="submit" class="btn btn-sm btn-success pull-right"><i class="fa fa-paper-plane"></i> Publish</button></h3>
    </div>
   <div class="card-body">
       <div class="row">
           <div class="col-md-8">
               <div class="form-group">
                  <label>Page Name</label>
                  <input type="text" class="form-control" id="page_name" name="page_name" placeholder="Enter page name">
              </div>
              <div class="form-group" id="uri">
                  <label>URI</label>
                  <input type="text" class="form-control" id="uri_str" name="uri" placeholder="Enter uri">
              </div>
              <div class="form-group" id="url">
                  <label>URL</label>
                  <input type="text" class="form-control" name="url" placeholder="Enter url"><br>
                  <input type="checkbox" id="same_domain" name="same_domain" value="1"> <label for="same_domain">Same Domain</label>
              </div>
           </div>
           <div class="col-md-4">
               <h4>Page Type</h4>
               <div class="form-group">
                  <input type="radio" id="content"  name="page_type" value="content" checked> <label for="content">Content</label><br>
                  <input type="radio" id="custom"  name="page_type" value="custom"> <label for="custom">Custom</label>
              </div>
              <div class="form-group">
                  <input type="checkbox" id="redirect" name="redirect" value="1"> <label for="redirect">Redirect</label>
              </div>
           </div>
       </div>
          
   </div>
</div>
</form>
<script>

    $('#page_name').on('keyup', function () {
        const name = $(this).val();
        
        // Replace special characters and spaces with hyphens
        const replacedString = name.replace(/[^\w]/gi, '-');
    
        $('#uri_str').val(replacedString);
    });

    $('#content').click(function(){
        $('#uri').css('display','block');
        $('#url').css('display','none');
    });
    $('#custom').click(function(){
        $('#uri').css('display','none');
        $('#url').css('display','block');
    });
    $('#add_page').submit(function(e){
        e.preventDefault();
        $.ajax({
            url:"<?php echo current_url(); ?>",
            type:'post',
            data:$(this).serialize(),
            dataType:'json',
            beforeSend:function(){
                notify('info','Processing....');
            },
            success:function(res){
                notify('success','Process Complete');
                // setTimeout(function(){
                //     window.location.reload();
                // },2000);
            }
        });
    });
        
</script>