<style>
    .pull-right {
        float: right;
    }
</style>
<form method="POST" action="">
<div class="card">
    <div class="card-header d-block">

        <div class="title">
            <h2>Social Icons
                <button type="submit" class="btn btn-sm btn-primary pull-right">Save</button>
            </h2>
        </div>

        <!-- START TABS DIV -->
        <div class="tabbable-responsive">
            <div class="tabbable">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab"
                            aria-controls="general" aria-selected="true">General</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="second-tab" data-toggle="tab" href="#second" role="tab"
                            aria-controls="second" aria-selected="false">Size</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="third-tab" data-toggle="tab" href="#third" role="tab"
                            aria-controls="third" aria-selected="false">Controls</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="fourth-tab" data-toggle="tab" href="#fourth" role="tab"
                            aria-controls="fourth" aria-selected="false">Animations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="fifth-tab" data-toggle="tab" href="#fifth" role="tab"
                            aria-controls="fifth" aria-selected="false">Autoplay</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="sixth-tab" data-toggle="tab" href="#sixth" role="tab"
                            aria-controls="sixth" aria-selected="false">Custom Css</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="card-body" style="background:#eff4f7">
        <div class="tab-content">
            <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                <div class="card">
                    <div class="card-header">Icons</div>
                    <div class="card-body">
                        <div class="icon-list">
                            <div class="row icon-item" data-id="1">
                                <div class="col-md-4 form-group">
                                    <select class="form-control" name="icon[1][title]">
                                        <option value="facebook">Facebook</option>
                                        <option value="twitter">Twitter</option>
                                        <option value="linkedin">Linkedin</option>
                                        <option value="youtube">Youtube</option>
                                        <option value="github">Github</option>
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <input type="text" name="icon[1][link]" class="form-control" placeholder="Enter link"
                                        required>
                                </div>
                                <div class="col-md-4 form-group text-center">
                                    <!-- <a class="btn btn-sm btn-danger">X</a> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 text-center"><a onclick="addNew();" class="btn btn-sm btn-primary">Add
                                New</a></div>

                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="second" role="tabpanel" aria-labelledby="second-tab">
                <div class="card">
                    <div class="card-header">Sizes</div>
                    <div class="card-body row">
                        <div class="form-group col-md-3">
                            <label>Width</label>
                            <input type="text" name="content[size][width]" value="1920px" class="form-control"
                                required="">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Height</label>
                            <input type="text" name="content[size][height]" value="800px" class="form-control"
                                required="">
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">Layout</div>
                    <div class="card-body ">
                        <div class="form-group col-md-4">
                            <select class="form-control select2" name="content[layout]">
                                <option>Boxed</option>
                                <option selected="">Full Width</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="third" role="tabpanel" aria-labelledby="third-tab">
                <h5 class="card-title">Third Tab header</h5>
                <p class="card-text">Vestibulum neque nunc, ullamcorper et laoreet in, dictum vitae nisi. Morbi
                    scelerisque cursus lobortis. Fusce a leo elit. In hac habitasse platea dictumst. Curabitur aliquet
                    nunc sed tellus rutrum ornare. Mauris euismod cursus ligula, nec mollis lorem sodales vel. Proin
                    mollis posuere nisl a pretium. Aenean sit amet nibh quis nisl pharetra malesuada convallis id leo.
                </p>
            </div>
            <div class="tab-pane fade" id="fourth" role="tabpanel" aria-labelledby="fourth-tab">
                <h5 class="card-title">Fourth Tab header</h5>
                <p class="card-text">Nulla dignissim justo sed nulla dignissim pellentesque. Maecenas rhoncus faucibus
                    finibus. Mauris eget tincidunt metus. Morbi bibendum nunc sed nisl aliquam, sit amet lacinia lectus
                    pharetra. Cras accumsan convallis risus. Morbi nisi libero, consequat eget leo vel, finibus rhoncus
                    nulla. Mauris tempus risus quis efficitur sollicitudin. Suspendisse potenti. Quisque ut leo interdum
                    ipsum tristique ultrices.</p>
            </div>
            <div class="tab-pane fade" id="fifth" role="tabpanel" aria-labelledby="fifth-tab">
                <h5 class="card-title">Fifth Tab header</h5>
                <p class="card-text">Nunc lacinia sodales ex, in mattis nulla eleifend in. Quisque molestie, dolor non
                    egestas ornare, diam sapien accumsan erat, non malesuada nulla est ac purus. Donec pharetra molestie
                    leo sit amet posuere. Etiam feugiat mi nisi, id semper neque dignissim ut. Praesent vitae accumsan
                    eros. Curabitur a nisi non arcu suscipit rutrum at ut orci. Praesent nec eros eros. Quisque tempus
                    neque ut nibh viverra, ut commodo dolor dapibus.</p>
            </div>
            <div class="tab-pane fade" id="sixth" role="tabpanel" aria-labelledby="sixth-tab">
                <textarea name="content[css]" class="form-control" rows="10" placeholder="Enter css code"></textarea>
            </div>
        </div>
        <!-- END TABS DIV -->
    </div>
</div>
</form>
<script>
    function addNew() {
        let lastItemId = $('.icon-list .icon-item').last().data('id');
        let itemId = lastItemId + 1;
        let item = `<div class="row icon-item" data-id="${itemId}">
                <div class="col-md-4 form-group">
                    <select class="form-control" name="icon[${itemId}][title]">
                        <option value="facebook">Facebook</option>
                        <option value="twitter">Twitter</option>
                        <option value="linkedin">Linkedin</option>
                        <option value="youtube">Youtube</option>
                        <option value="github">Github</option>
                    </select>
                </div>
                <div class="col-md-4 form-group">
                    <input type="text" name="icon[${itemId}][link]" class="form-control" placeholder="Enter link" required>
                </div>
                <div class="col-md-4 form-group text-center">
                    <a class="btn btn-sm btn-danger" onclick="remoteItem(this)">X</a>
                </div>
            </div>`;

        $('.icon-list').append(item);
    }
    function remoteItem(e) {
        var item = e.closest('.icon-item');
        item.remove();
    }
    $('.saveIcon').click(function (e) {
        let icons = $('.icon-list .icon-item');
        return false;
        $.ajax({
            url: "<?php echo current_url(); ?>",
            type: "POST",
            dataType: "JSON",
            data: {
                action: "add-update",
                
            },
            beforeSend: function () {
                // You can add loading indicators or other tasks here
                
            },
            success: function (res) {
                if (res.status) {
                    $('#msg').html('<div class="alert alert-success">New slide added successfully!</div>');
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                } else {
                    $('#msg').html('<div class="alert alert-danger">Something went wrong.</div>');
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                $('#msg').html('Error: ' + error);
            }
        });
    })
</script>