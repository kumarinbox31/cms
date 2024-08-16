$(document).ready(function(){
    $('.ajax-form-submit').submit(function(e){
        e.preventDefault;
        var form = $(this);
        var btn = $(this).find('button');
        msg.text('Form Submitting ! Please wait....');
        var formData = new FormData(this);
        $.ajax({
            url:base_url+'web/ajax',
            type:"POST",
            data: formData,
            dataType: "json",
            processData: false, // Required for FormData
            contentType: false, // Required for FormData
            success:function(res){
               if(res.status){
                   alert(res.msg);
                  btn.text(res.msg);
                  form[0].reset();
               }else{
                   btn.text(res.msg);
               }
            }
        });
    });
});