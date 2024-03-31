$('form').submit(function(e){
    e.preventDefault();
    var formData = new FormData(this);
    var form = $(this); // Reference to the form itself

    var btn = form.find('input[type="submit"]'); // Find the button within the form
    
    // Disable form elements
    form.find('input, button').prop('disabled', true);
    
    $.ajax({
        url: form.attr('action'),
        type: 'post',
        data: formData,
        dataType: "json",
        processData: false, // Required for FormData
        contentType: false, // Required for FormData
        success: function(res){
            // Handle the success response
            if (res.success) {
                // Update button text and color
                btn.css('background', 'green').value('Sent');
                // You can do more here if needed
            } else {
                // Handle the response if it's not successful
                btn.css('background', 'red').value('Error');
            }
        },
        error: function(xhr, status, error) {
            // Handle AJAX errors
            btn.css('background', 'red').text('Error');
            console.error(error);
        }
    });
});
