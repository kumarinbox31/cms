<?
add_shortcode('Product-Gallery', function ($atts, $content) {
    //  [AB-Product-Gallery id=1 ]
    $id = intval(@$atts['id']);
    $ci = &get_instance();
    $get = $this->GalleryModel->getGallery(['id' => $id])->row();
    $extra = @$get->extra;
    if(isset($get->extra)){
        $extra = json_decode($extra);
    }
    $button_title = isset($extra->button_title) ? $extra->button_title : 'Get Quote';
    $button_style = isset($extra->button_style) ? $extra->button_style : 'primary';
    $button_color = isset($extra->button_color) ? $extra->button_color : '#ffffff';
    $button_bg  = isset($extra->button_bg) ? $extra->button_bg : '#086AD8';
    $this->load->helper('text');
    

    ob_start();
    ?>
    <main class="product-gallery-main container py-2 w-100">
        <div class="product-gallery-container gallery-item-<?php echo $id; ?>">
            <h1 class="text-center"><?php echo $get->title; ?></h1>
            <div class="product-list  row " style="flex-wrap:wrap;margin-left:3px;">
                <?php
                $get = $this->GalleryModel->getGalleyItems(['gallery_id' => $get->id]);
                foreach ($get->result() as $row) {
                    $image = $row->file == '' ? '' : $row->file;
                    $content = $row->title;
                    $btn = $row->btn == null ? 'Get Quote' : $row->btn;
                    $short_desc = empty($row->short_desc) ? word_limiter($row->desc, 20) : $row->short_desc;
                    $onclick = $row->link == '' ? 'onclick="productQueryForm(' . $row->id . ');"' : 'href="' . $row->link . '"';
                    echo '
                <div class="product-item col-md-4 mt-2" style="min-height:300px;" id="product-item-' . $row->id . '">
                    <div class="card border rounded-lg overflow-hidden shadow-lg">
                        <div class="card-header">
                            <img class="ab-product-image w-full" src="' . $image . '" alt="' . $row->title . '">
                            <div class="ab-product-desc " data-desc="'.$row->desc.'">' . $short_desc. '</div>
                        </div>
                        <div class="card-body py-2">
                            <h4 class="text-center ab-product-title">' . $row->title . '</h4>
                            <div class="text-center">
                                <a ' . $onclick . ' class="btn btn-sm btn-primary" 
                                style="background:'.$button_bg.' !important;
                                color:'.$button_color.' !important;"
                                >'.$button_title.'</a>
                               <!-- <a ' . $onclick . ' href="' . $row->link . '" class="btn btn-sm btn-primary inline-block bg-blue-500 hover:bg-blue-700 
                                text-white font-bold py-2 px-4 rounded">'.$btn.'</a> -->

                            </div>
                        </div>
                    </div>
                </div>';
                }
                ?>
            </div>
        </div>
    </main>

<!--    <div class="modal modal-xl" tabindex="-1" id="product-query-form">-->
<!--        <div class="modal-dialog" style="max-width:100% !important;">-->
<!--            <div class="modal-content" style="width:100% !important;">-->
<!--                <div class="modal-header">-->
<!--                    <h5 class="modal-title">Modal title</h5>-->
<!--                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
<!--                </div>-->
<!--                <div class="modal-body">-->
<!--                    <div class="row">-->
<!--                        <div class="col-md-6">-->
<!--                            <img class="w-100 image" src="" style="max-height:auto;">-->
<!--                        </div>-->
<!--                        <div class="col-md-6">-->
<!--                            <div class="query-msg"></div>-->

<!--                            <form class="product-query-submit" action="<?php echo base_url('api/gallery/sendQuery'); ?>"-->
<!--                                method="POST">-->
<!--                                <input type="hidden" name="productid" value="" required>-->
<!--                                <input type="hidden" name="galleryid" value="<?php echo $id; ?>" required>-->
<!--                                <div class="form-group">-->
<!--                                    <label>Name</label>-->
<!--                                    <input type="text" name="name" class="form-control" required>-->
<!--                                </div>-->
<!--                                <div class="form-group">-->
<!--                                    <label>Email</label>-->
<!--                                    <input type="email" name="email" class="form-control" required>-->
<!--                                </div>-->
<!--                                <div class="form-group">-->
<!--                                    <label>Phone</label>-->
<!--                                <input type="number" name="phone" class="form-control" maxlength="10" required oninput="-->
<!--    var phoneNumber = this.value.replace(/\D/g, ''); // Remove non-digit characters-->
<!--    if (phoneNumber.length > 10) {-->
<!--        this.value = phoneNumber.slice(0, 10); // Truncate to 10 digits-->
<!--    }-->
<!--" title="Please enter a valid 10-digit phone number">-->
<!--</div>-->
<!--                                <div class="form-group">-->
<!--                                    <label>City</label>-->
<!--                                    <input type="text" name="city" class="form-control" required>-->
<!--                                </div>-->
<!--                                <div class="form-group">-->
<!--                                    <button type="submit" class="btn btn-sm btn-primary mt-2">Submit</button>-->
<!--                                </div>-->
<!--                            </form>-->
<!--                            <div class="desc"></div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
                <!--<div class="modal-footer">-->
                <!--  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>-->
                <!--  <button type="button" class="btn btn-primary">Save changes</button>-->
                <!--</div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->


<style>
/* ================================
   PRODUCT QUERY POPUP – SCOPED CSS
   Only affects #product-query-form
================================ */

#product-query-form .modal-content {
    background: #f8f9fa;
    border: 0;
    border-radius: 18px;
}

#product-query-form .modal-header {
    background: #ffffff;
    border-bottom: 1px solid #e9ecef;
    padding: 18px 24px;
}

#product-query-form .modal-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #212529;
}

#product-query-form .modal-body {
    padding: 24px;
}

/* Image Section */
#product-query-form .image {
    width: 100%;
    max-height: 420px;
    object-fit: contain;
    border-radius: 14px;
    box-shadow: 0 10px 30px rgba(0,0,0,.08);
}

/* Form Card */
#product-query-form .form-wrapper {
    background: #ffffff;
    border-radius: 14px;
    padding: 24px;
    box-shadow: 0 10px 30px rgba(0,0,0,.06);
}

/* Labels */
#product-query-form label {
    font-size: .9rem;
    font-weight: 500;
    margin-bottom: 6px;
    color: #495057;
}

/* Inputs */
#product-query-form .form-control {
    border-radius: 10px;
    height: 48px;
}

#product-query-form .form-control:focus {
    border-color: #0d6efd;
    box-shadow: none;
}

/* Submit Button */
#product-query-form .btn-submit {
    border-radius: 12px;
    padding: 12px;
    font-size: 1rem;
}

/* Message */
#product-query-form .query-msg {
    font-size: .9rem;
}

/* Mobile Fix */
@media (max-width: 767px) {
    #product-query-form .modal-body {
        padding: 16px;
    }
}
</style>
<div class="modal fade" id="product-query-form" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Product Enquiry</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="row g-4">

                    <div class="col-md-6">
                        <img class="image" src="" alt="Product Image">
                    </div>

                    <div class="col-md-6">
                        <div class="form-wrapper">

                            <div class="query-msg mb-3"></div>

                            <form class="product-query-submit"
                                  action="<?php echo base_url('api/gallery/sendQuery'); ?>"
                                  method="POST">

                                <input type="hidden" name="productid">
                                <input type="hidden" name="galleryid" value="<?php echo $id; ?>">

                                <div class="mb-3">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label>Phone</label>
                                    <input type="tel" name="phone"
                                           class="form-control"
                                           maxlength="10"
                                           required
                                           oninput="this.value=this.value.replace(/\D/g,'').slice(0,10);">
                                </div>

                                <div class="mb-4">
                                    <label>City</label>
                                    <input type="text" name="city" class="form-control" required>
                                </div>

                                <button type="submit"
                                        class="btn btn-primary w-100 btn-submit">
                                    Submit Enquiry
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="desc mt-3 text-muted small"></div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

    <?php
    $html = ob_get_contents();
    ob_end_clean();
    return $html;
});

add_action('ab_head', function () {
    echo ' 
    <link rel="stylesheet" href="' . base_url('public/plugins/ab-product-gallery/style.css') . '">
    <style>
        .ab-product-title{
            font-size: 1rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }
        .ab-product-image{
            height: 200px;
    width: 100%;
    object-fit: cover;
    object-position: center;
        }
        .form-hidden{
            display:none;
        }
        @media (min-width: 1200px) {
    .modal-xl {
        --bs-modal-width: 1140px;
        margin-left:5rem;
    }
}
    </style>
    ';
});
add_action('ab_footer', function () {
    ob_start();
    ?>
    <script>
        function productQueryForm(id) {
            var itemEl = $('#product-item-' + id);
            var image = itemEl.find('.ab-product-image').attr('src');
            var title = itemEl.find('.ab-product-title').text();
            var desc = itemEl.find('.ab-product-desc').data('desc');
            console.log(desc);
            var form = $('#product-query-form');
            form.find('.modal-title').html(title);
            form.find('.image').attr('src', image);
            form.find('.desc').html(desc);
            form.find('input[name="productid"]').val(id);
            form.modal('show');
            form.css('display','block');
        }
        $('.product-query-submit').submit(function (e) {
            e.preventDefault();
            var form = $(this); // Reference to the form itself
            form.find('input, button').prop('disabled', true); // Disable form elements before AJAX request
            var name = $(this).find('input[name="name"').val();
            var email = $(this).find('input[name="email"]').val();
            var phone = $(this).find('input[name="phone"]').val();
            var city = $(this).find('input[name="city"]').val();
            var productid = $(this).find('input[name="productid"]').val();
            var galleryid = $(this).find('input[name="galleryid"]').val();
            var formData = { name: name, email: email, phone: phone, city: city, productid: productid, galleryid: galleryid };

            // Log FormData object to console for debugging
            console.log("FormData:", formData);

            $.ajax({
                url: form.attr('action'),
                type: "POST",
                dataType: 'JSON',
                data: formData,
                beforeSend: function () {
                    $('.query-msg').html('<div class="alert alert-info">Processing...</div>');
                },
                success: function (res) {
                    if (res.status == 1) {
                        form[0].reset();
                        $('.query-msg').html('<div class="alert alert-success">Query Sent Successfully!</div>');
                        setTimeout(function(){
                            $('.query-msg').html("");
                            // $('#product-query-form').css('display','none');
                        },2000);
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                    } else {
                        $('.query-msg').html('<div class="alert alert-danger">Something went wrong.</div>');
                    }
                },
                error: function (xhr, status, error) {
                    // Handle error
                    $('.query-msg').html('<div class="alert alert-danger">Error: ' + error + '</div>');
                },
                complete: function () { // Re-enable form elements after AJAX request completes (success or error)
                    form.find('input, button').prop('disabled', false);
                }
            });
        });

    </script>
    <?php
    $html = ob_get_contents();
    ob_end_clean();
    echo $html;
});

