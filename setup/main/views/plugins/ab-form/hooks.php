<?
add_shortcode('ab-form', function($atts, $content){
    //  [ab-form id=1 ]
    $formId = @$atts['id'];
    $ci = &get_instance();
    $get = $this->ServiceModel->getServiceById($formId)->row();;
    $content = @$get->content;
     ob_start();
        echo '<form method="POST" action="/web/ajax" class="ajax-form-submit" onsubmit="javascript:;" enctype="multipart/form-data">
                <input type="hidden" name="form_id" value="'.$formId.'">
                <input type="hidden" name="action" value="form-submit">
                <div class="msg"></div>   
                <div style="display:flex;flex-wrap:wrap" class="row">
                <style>
                    .rendered-form > div{
                        text-align:left;
                    }
                </style>
                <div class="form_render" data-content='."'".($content)."'".'></div>
                </div>
                </form>';
     $html = ob_get_contents();
	 ob_end_clean();
	 return $html;
});
add_action('ab_footer', 'ab_form_scripts');
add_action('ab_head', 'ab_form_styles');
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
    echo '
    <!-- Ab Form Installed Successfully. -->
    <link rel="stylesheet" href="'.base_url('public/plugins/ab-form/style.css').'">';
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

