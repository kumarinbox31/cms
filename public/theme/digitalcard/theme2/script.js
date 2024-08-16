$(document).ready(function(){

    // Load more data
    $('.load-more').click(function(){
        var row = Number($('#row').val());
        var revuserid = $('#revuserid').val();
        var allcount = Number($('#all').val());
        row = row + 5;

        if(row <= allcount){
            $("#row").val(row);

            $.ajax({
                url: 'get_more_review.php',
                type: 'post',
                data: {row:row,revuserid:revuserid},
                beforeSend:function(){
                    $(".load-more").text("Loading...");
                },
                success: function(response){

                    // Setting little delay while displaying new content
                    setTimeout(function() {
                        // appending posts after last post with class="post"
                        $(".post:last").after(response).show().fadeIn("slow");

                        var rowno = row + 3;

                        // checking row value is greater than allcount or not
                        if(rowno > allcount){

                            // Change the text and background
                            $('.load-more').text("Hide");
                            $('.load-more').css("background","darkorchid");
                        }else{
                            $(".load-more").text("Load");
                        }
                    }, 2000);


                }
            });
        }else{
            $('.load-more').text("Loading...");

            // Setting little delay while removing contents
            setTimeout(function() {

                // When row is greater than allcount then remove all class='post' element after 3 element
                $('.post:nth-child(3)').nextAll('.post').remove().fadeIn("slow");

                // Reset the value of row
                $("#row").val(0);

                // Change the text and background
                $('.load-more').text("Load");
                $('.load-more').css("background","#15a9ce");

            }, 2000);


        }

    });

});