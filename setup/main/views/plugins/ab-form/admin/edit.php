<div class="container my-3">
  <div id="data_msg"></div>
  <div class="card">
    <div class="card-header d-block">
      
      <div class="d-flex">
        <div class="title">
          <h2>Form Setting</h2>
        </div>
      </div>
      
      <!-- START TABS DIV -->
      <div class="tabbable-responsive">
        <div class="tabbable">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">Label</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="second-tab" data-toggle="tab" href="#second" role="tab" aria-controls="second" aria-selected="false">Size</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="third-tab" data-toggle="tab" href="#third" role="tab" aria-controls="third" aria-selected="false">Controls</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="fourth-tab" data-toggle="tab" href="#fourth" role="tab" aria-controls="fourth" aria-selected="false">Animations</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="fifth-tab" data-toggle="tab" href="#fifth" role="tab" aria-controls="fifth" aria-selected="false">Autoplay</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="sixth-tab" data-toggle="tab" href="#sixth" role="tab" aria-controls="sixth" aria-selected="false">Custom Css</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="card-body" style="background:#eff4f7">
      <div class="tab-content">
        <div class="tab-pane fade active show" id="general" role="tabpanel" aria-labelledby="general-tab">
            <div class="card">
                <div class="card-header">General Setting</div>
                <div class="card-body row">
                    <div class="form-group col-md-3">
                        <label>Color</label>
                        <input type="color" onchange="makeCss('titleColor',this.value)" class="w-100" required="" value="">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Font Style</label>
                        <select class="form-control styled-select" onchange="makeCss('titleStyle',this.value)">
                            <option value="Arial">Arial</option>
                            <option value="Courier New">Courier New</option>
                            <option value="Georgia">Georgia</option>
                            <option value="Times New Roman">Times New Roman</option>
                            <option value="Verdana">Verdana</option>
                            <option value="Trebuchet MS">Trebuchet MS</option>
                            <option value="Comic Sans MS">Comic Sans MS</option>
                            <option value="Impact">Impact</option>
                            <option value="Tahoma">Tahoma</option>
                            <option value="Lucida Console">Lucida Console</option>
                            <option value="Arial Black">Arial Black</option>
                            <option value="Garamond">Garamond</option>
                            <option value="Courier">Courier</option>
                            <option value="Helvetica">Helvetica</option>
                            <option value="Tahoma">Tahoma</option>
                            <option value="Palatino Linotype">Palatino Linotype</option>
                            <option value="Segoe UI">Segoe UI</option>
                            <option value="Futura">Futura</option>
                            <option value="Lucida Sans">Lucida Sans</option>
                            <option value="Century Gothic">Century Gothic</option>
                            <option value="Georgia">Georgia</option>
                            <option value="Verdana">Verdana</option>
                            <option value="Frank Ruhl">Frank Ruhl</option>
                            <option value="Roboto">Roboto</option>
                            <option value="Open Sans">Open Sans</option>
                            <option value="Montserrat">Montserrat</option>
                            <option value="Lora">Lora</option>
                            <option value="Raleway">Raleway</option>
                        </select>

                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="second" role="tabpanel" aria-labelledby="second-tab">
            <div class="card">
                <div class="card-header">Sizes</div>
                <div class="card-body row">
                    <div class="form-group col-md-3">
                        <label>Width</label>
                        <input type="text" name="content[size][width]" value="1920px" class="form-control" required="">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Height</label>
                        <input type="text" name="content[size][height]" value="800px" class="form-control" required="">
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
          <p class="card-text">Vestibulum neque nunc, ullamcorper et laoreet in, dictum vitae nisi. Morbi scelerisque cursus lobortis. Fusce a leo elit. In hac habitasse platea dictumst. Curabitur aliquet nunc sed tellus rutrum ornare. Mauris euismod cursus ligula, nec mollis lorem sodales vel. Proin mollis posuere nisl a pretium. Aenean sit amet nibh quis nisl pharetra malesuada convallis id leo.</p>
        </div>
        <div class="tab-pane fade" id="fourth" role="tabpanel" aria-labelledby="fourth-tab">
          <h5 class="card-title">Fourth Tab header</h5>
          <p class="card-text">Nulla dignissim justo sed nulla dignissim pellentesque. Maecenas rhoncus faucibus finibus. Mauris eget tincidunt metus. Morbi bibendum nunc sed nisl aliquam, sit amet lacinia lectus pharetra. Cras accumsan convallis risus. Morbi nisi libero, consequat eget leo vel, finibus rhoncus nulla. Mauris tempus risus quis efficitur sollicitudin. Suspendisse potenti. Quisque ut leo interdum ipsum tristique ultrices.</p>
        </div>
        <div class="tab-pane fade" id="fifth" role="tabpanel" aria-labelledby="fifth-tab">
          <h5 class="card-title">Fifth Tab header</h5>
          <p class="card-text">Nunc lacinia sodales ex, in mattis nulla eleifend in. Quisque molestie, dolor non egestas ornare, diam sapien accumsan erat, non malesuada nulla est ac purus. Donec pharetra molestie leo sit amet posuere. Etiam feugiat mi nisi, id semper neque dignissim ut. Praesent vitae accumsan eros. Curabitur a nisi non arcu suscipit rutrum at ut orci. Praesent nec eros eros. Quisque tempus neque ut nibh viverra, ut commodo dolor dapibus.</p>
        </div>
        <div class="tab-pane fade" id="sixth" role="tabpanel" aria-labelledby="sixth-tab">
            <textarea name="content[css]" class="form-control" rows="10" placeholder="Enter css code"></textarea>
        </div>
      </div>
      <!-- END TABS DIV -->
    </div>
  </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const selectElement = document.getElementsByClassName('styled-select')[0]; // Access the first element with class 'form-control'
        const options = selectElement.options;

        for (let i = 0; i < options.length; i++) {
            options[i].style.fontFamily = options[i].text; // Use .text to get the option's text
        }

        selectElement.addEventListener('change', (event) => {
            selectElement.style.fontFamily = event.target.value; // Apply the font to the select element itself
        });
    });
    function makeCss(key,value){
        
    }
</script>