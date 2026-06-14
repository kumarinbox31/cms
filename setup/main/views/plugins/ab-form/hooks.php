<?php
add_shortcode('ab-form', function($atts, $content){
    //  [ab-form id=1 ]
    $formId = @$atts['id'];
    $ci = &get_instance();
    $get = $ci->ServiceModel->getServiceById($formId)->row();;
    $content = @$get->content;
    $desc = @$get->desc;
    if($desc == 'formio'){
        add_action('ab_footer', 'ab_formio_scripts');
    }else{
        add_action('ab_footer', 'ab_form_scripts');
        add_action('ab_head', 'ab_form_styles');
    }
    
     ob_start();
        echo '<form data-desc="'.$desc.'" method="POST" action="/web/ajax" class="ajax-form-submit" onsubmit="javascript:;" novalidate enctype="multipart/form-data">
                <input type="hidden" name="form_id" value="'.$formId.'">
                <input type="hidden" name="action" value="form-submit">
                <div class="msg"></div>   
                <div style="display:flex;flex-wrap:wrap" class="row">
                <style>
                    .rendered-form > div{
                        text-align:left;
                    }
                    .form_render > .alert.alert-danger {
    display: none;
}

                </style>
                <div class="form_render" style="margin-left:10px;" data-content='."'".($content)."'".'></div>
                </div>
                </form>';
     $html = ob_get_contents();
	 ob_end_clean();
	 return $html;
});
if(in_array(CLIENT_ID, [231,569,585])){
    add_action('ab_footer', 'ab_formio_scripts');
}
if (!has_action('ab_footer', 'ab_formio_scripts')) {
        add_action('ab_footer', 'ab_formio_scripts');
    }

add_action('ab_footer', 'ab_form_scripts',10);
add_action('ab_head', 'ab_form_styles',10);
    
function ab_formio_scripts(){
    /*
    ?>
    <script src="https://cdn.form.io/js/formio.embed.js"></script>
   <script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function () {
    var el = document.querySelector('.form_render');
    var content = el.getAttribute('data-content');
    console.log("form Content: ", content);
    // Get form_id from the nearest input or container
    var form_id = el.closest('form').querySelector('[name="form_id"]').value;
    
    try {
      var formContent = JSON.parse(content);
      Formio.createForm(el, formContent).then(function (form) {
        console.log('-- formio init--');

        // Override the submit handler
        form.on("submit", (submission) => {
          console.log('--submitting--', submission);
          
          // Call the API with form data
          fetch('/web/form_submit/' + form_id, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify(submission.data)  // Send only form data
          })
          .then(response => {
            if (!response.ok) {
              throw new Error('Network response was not ok');
            }
            return response.json();
          })
          .then(data => {
            console.log('--API Response--', data);

            // Reset the form on success
            form.submission = {};
            form.resetValue();
            form.refresh();
            form.setPristine(true); // Clear validation messages

            alert('Form submitted successfully!');
          })
          .catch(error => {
            console.error('Error submitting form:', error);
            alert('There was an error submitting the form.');
          });
        });
      });
    } catch (error) {
      console.error('Invalid form content:', error);
    }
  });
</script>

<?php
*/
?>
<script src="https://cdn.form.io/js/formio.embed.js"></script>
<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.form_render').forEach(function (el) {
      var content = el.getAttribute('data-content');
      console.log("form Content: ", content);

      // Get form_id from the nearest input or container
      var form_id_input = el.closest('form')?.querySelector('[name="form_id"]');
      var form_id = form_id_input ? form_id_input.value : null;

      if (!form_id) {
        console.warn('form_id not found for form element:', el);
        return;
      }

      try {
        var formContent = JSON.parse(content);
        Formio.createForm(el, formContent).then(function (form) {
          console.log('-- formio init--');

          // Handle form submission
          form.on("submit", (submission) => {
            // Use a relative path to avoid CORS/SSL issues with hardcoded protocols
            // This works regardless of being on http:// or https://
            var action_url = '/web/form_submit/' + form_id;
            
            fetch(action_url, {
              method: 'POST',
              headers: { 'Content-Type': 'application/json' },
              body: JSON.stringify(submission.data)
            })
            .then(response => {
                if (!response.ok) throw new Error('Server error: ' + response.status);
                return response.text().then(text => {
                    try { return JSON.parse(text); } catch (e) { return { status: true }; }
                });
            })
            .then(data => {
              if (data.status || data.success) {
                  // 1. Signal completion to FormIO
                  form.emit('submitDone', submission);
                  
                  // 2. Clear values without triggering validation redraws
                  form.submission = {data: {}};
                  
                  // 3. Reset the "touched" state and clear all error alerts
                  form.setPristine(true);
                  if (typeof form.setAlert === 'function') form.setAlert(false);

                  // 4. Manually scrub any leftover red UI markers from the DOM
                  setTimeout(function() {
                      el.querySelectorAll('.has-error, .is-invalid, .formio-error-wrapper').forEach(err => {
                          err.classList.remove('has-error', 'is-invalid', 'formio-error-wrapper');
                      });
                      el.querySelectorAll('.formio-errors, .alert-danger, .help-block, .error').forEach(err => {
                          err.style.display = 'none';
                      });
                  }, 50);

                  alert('Form submitted successfully!');
                  window.location.reload();
              } else {
                  form.emit('submitError', data.msg);
                  alert(data.msg || 'Form validation failed.');
              }
            })
            .catch(error => {
              form.emit('submitError', error.message);
              alert('Submission Error: ' + error.message);
            });
          });
        });
      } catch (error) {
        console.error('Invalid form content:', error);
      }
    });
  });
</script>
<?php
}
function ab_form_scripts(){
    echo '<script src="'.base_url('public/plugins/ab-form/script.js').'"></script>
    <script src="https://formbuilder.online/assets/js/form-render.min.js"></script>
          
        <script>
            $(document).ready(function(){
            function convertStringToBoolean(obj) {
                for (const key in obj) {
                    if (typeof obj[key] === "string") {
                        if (obj[key] === "true" || obj[key] === "false") {
                            obj[key] = obj[key] === "true";
                        }
                    } else if (typeof obj[key] === "object") {
                        convertStringToBoolean(obj[key]);
                    }
                }
            }
                $(".form_render").each(function(index, element){

                    var formType = $(element).closest("form").data("desc");
                
                    // Skip FormIO forms
                    if(formType == "formio"){
                        return;
                    }
                    var content = $(element).data("content");
                    convertStringToBoolean(content);
                    console.log(content);
                    try {
                        var formRenderOpts = {
                            formData: content,
                            dataType: "json",
                            layoutTemplates: {
                              default: function(field, label, help, data) {
                                help = $("<div/>")
                                  .addClass("helpme")
                                  .attr("id", "row-" + data.id)
                                  .append(help);
                                return $("<div/>").append(label, field, help);
                              }
                            }

                        };
                        $(element).formRender(formRenderOpts);
                    } catch (error) {
                        console.error("Error parsing JSON:", error);
                    }
                });
            });
        </script>

    ';
}

function ab_form_styles(){
    // echo '
    // <!-- Ab Form Installed Successfully. -->
    // <link rel="stylesheet" href="'.base_url('public/plugins/ab-form/style.css').'">';
}

function ExtractdesignForm($content) {
    $html = '';

    $content = json_decode($content, true);

    foreach ($content as $ct) {
        extract($ct);

        $labelClass = isset($required) && $required ? 'required' : '';
        $class = "col-md-6 ab-form-group-" . rand();

        switch ($type) {
            case 'autocomplete':
                $html .= "<div class='form-group '>
                            <label class='$labelClass'>$label</label>
                            <input type='text' name='$name' class='$className' placeholder='" . ($placeholder ?? '') . "' " . ($required === "true" ? 'required' : '') . ">
                        </div>";
            break;
            case 'radio-group':
                $html .= "<div class='form-group $class'>
                            <label class='$labelClass'>$label</label>";
                foreach ($values as $vl) {
                    $chkd = $vl['selected'] === "true" ? 'checked' : '';
                    $html .= "<div class='form-check'>
                                  <input class='form-check-input' type='radio' id='radio-" . uniqid() . "' name='$name' value='" . $vl['value'] . "' $chkd>
                                  <label class='form-check-label'>" . $vl['label'] . "</label>
                              </div>";
                }
                $html .= "</div>";
            break;
            case 'select':
                $html .= "<div class='form-group $class'>
                            <label class='$labelClass'>$label</label>
                            <select name='$name' class='$className' " . ($multiple === "true" ? 'multiple' : '') . " " . ($required === "true" ? 'required' : '') . ">";
                foreach ($values as $vl) {
                    $sel = $vl['selected'] === "true" ? 'selected' : '';
                    $html .= "<option value='" . $vl['value'] . "' $sel>" . $vl['label'] . "</option>";
                }
                $html .= "</select>
                        </div>";
            break;
            case 'header':
                $html .= "<$subtype class='$className'>$label</$subtype>";
            break;
            case 'textarea':
                $html .= "<div class='form-group $class'>
                            <label class='$labelClass'>$label</label>
                            <$subtype class='$className' name='$name' placeholder='" . ($placeholder ?? '') . "'></$subtype>
                        </div>";
                break;
            case 'button':
                $html .= "<div class='form-group col-md-12 mt-2 $class'>
                            <button type='$subtype' name='$name' class='$className'>$label</button>
                        </div>";
                break;
            case 'file':
            case 'date':
            case 'text':
            case 'number':
                $html .= "<div class='form-group $class'>
                            <label class='$labelClass'>$label</label>
                            <input type='$type' name='$name' class='$className' placeholder='" . ($placeholder ?? '') . "' " . (isset($required) && $required ? 'required' : '') . " " . (isset($multiple) && $multiple ? 'multiple' : '') . ">
                        </div>";
                break;
            case 'checkbox-group':
                $html .= "<div class='form-group $class'>
                            <label class='$labelClass'>$label</label>";
                foreach ($values as $vl) {
                    $chkd = isset($vl['selected']) && $vl['selected'] ? 'checked' : '';
                    $html .= "<div class='form-check'>
                                  <input class='form-check-input' type='checkbox' id='check1' name='$name' value='" . $vl['value'] . "' $chkd>
                                  <label class='form-check-label'>" . $vl['label'] . "</label>
                              </div>";
                }
                $html .= "</div>";
                break;
            case 'paragraph':
                $html .= "<$subtype>$label</$subtype>";
                break;
            default:
                $html .= json_encode($ct) . '<br>';
                break;
        }
    }
    return $html;
}

