<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>AB Editor</title>


    <!--<link rel="stylesheet" href="<?php echo base_url('public/admin/'); ?>abeditor/stylesheets/toastr.min.css">-->
    <!--<link rel="stylesheet" href="<?php echo base_url('public/admin/'); ?>abeditor/stylesheets/grapes.min44a5.css?v0.20.4">-->
    <link href="https://unpkg.com/grapesjs/dist/css/grapes.min.css" rel="stylesheet"/>
    <!--<script src="https://unpkg.com/grapesjs"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/grapesjs/0.21.8/grapes.min.js"></script>
    

    
    <link rel="stylesheet" href="<?php echo base_url('public/admin/'); ?>abeditor/stylesheets/grapesjs-preset-webpage.min.css">
    <link rel="stylesheet" href="<?php echo base_url('public/admin/'); ?>abeditor/stylesheets/tooltip.css">
    <link rel="stylesheet" href="<?php echo base_url('public/admin/'); ?>abeditor/stylesheets/demos43a0.css?v3">
    <link href="https://unpkg.com/grapick%400.1.13/dist/grapick.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="<?php echo base_url('public/admin/'); ?>abeditor/js/toastr.min.js"></script>
    <!--<script src="<?php echo base_url('public/admin/'); ?>abeditor/js/grapes.min44a5.js?v0.20.4"></script>-->
    <script src="https://unpkg.com/grapesjs-preset-webpage@1.0.2"></script>
    <!--<script src="https://unpkg.com/grapesjs-blocks-basic@1.0.1"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/grapesjs-blocks-basic@1.0.1"></script>
    <!--<script src="https://unpkg.com/grapesjs-plugin-forms@2.0.5"></script>-->
    <script src="https://unpkg.com/grapesjs-component-countdown@1.0.1"></script>
    <script src="https://unpkg.com/grapesjs-plugin-export@1.0.11"></script>
    <script src="https://unpkg.com/grapesjs-tabs@1.0.6"></script>
    <script src="https://unpkg.com/grapesjs-custom-code@1.0.1"></script>
    <script src="https://unpkg.com/grapesjs-touch@0.1.1"></script>
    <script src="https://unpkg.com/grapesjs-parser-postcss@1.0.1"></script>
    <script src="https://unpkg.com/grapesjs-tooltip@0.1.7"></script>
    <script src="https://unpkg.com/grapesjs-tui-image-editor"></script>
    <script src="https://unpkg.com/grapesjs-typed@1.0.5"></script>
    <script src="https://unpkg.com/grapesjs-style-bg@2.0.1"></script>
    <!--<script src="https://unpkg.com/grapesjs-plugin-ckeditor"></script>-->
    
    <!--changes script-->
    <script src="https://cdn.jsdelivr.net/npm/grapesjs-plugin-forms@2.0.5"></script>
<script src="https://cdn.jsdelivr.net/npm/grapesjs-component-code-editor"></script>
<script src="https://cdn.jsdelivr.net/npm/grapesjs-parser-postcss"></script>
<!--<script src="/path-to-files/grapesjs-plugin-forms.min.js"></script>-->
<!--<script src="/path-to-files/grapesjs-component-code-editor.min.js"></script>-->
<!--<script src="/path-to-files/grapesjs-parser-postcss.min.js"></script>-->
<link rel="stylesheet" href="https://unpkg.com/grapesjs@0.22.6/dist/css/grapes.min.css">
<script src="https://unpkg.com/grapesjs-typed@1.0.5/dist/grapesjs-typed.min.js"></script>
<script src="https://unpkg.com/grapesjs-style-bg@2.0.1/dist/index.js"></script>
<!--changed scripts-->
    
    <!--plugins-->
    <!--<script src="<?php echo base_url('public/admin/'); ?>abeditor/js/grapesjs-swiper-slider.min.js"></script>-->
    <!--<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-element-bundle.min.js"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/grapesjs-plugin-slider@1.0.0/dist/grapesjs-plugin-slider.min.js"></script>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/grapesjs-plugin-toolbox@1.0.15/dist/grapesjs-plugin-toolbox.min.css">
    <script src="https://cdn.jsdelivr.net/npm/grapesjs-plugin-toolbox@1.0.15/dist/grapesjs-plugin-toolbox.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tui-image-editor/3.15.3/tui-image-editor.min.js" ></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tui-image-editor/3.15.3/tui-image-editor.css"  />
    <!--<script src="<?php echo base_url('public/admin/abeditor/plugins/grapesjs-lory-slider.min.js'); ?>"></script>-->
    <!--<script src="https://cdn.jsdelivr.net/npm/rn-grapesjs-lory-slider@0.1.16/dist/grapesjs-lory-slider.min.js"></script>-->
    <script src="<?php echo base_url('public/admin/abeditor/plugins/grapesjs-plugin-social.min.js');?>"></script>
    
    <!--ruller plugin-->
    <link href="https://unpkg.com/grapesjs-rulers/dist/grapesjs-rulers.min.css" rel="stylesheet">
    <script src="https://unpkg.com/grapesjs-rulers"></script>
    <!--ruller plugin-->
    
    <!--code editor-->
    <link rel="stylesheet" href="https://unpkg.com/grapesjs-component-code-editor/dist/grapesjs-component-code-editor.min.css">
    <script src="https://unpkg.com/grapesjs-component-code-editor"></script>
    <script src="https://unpkg.com/grapesjs-parser-postcss"></script>
    <!--end code editor-->
    <script src="https://cdn.jsdelivr.net/npm/grapesjs-blocks-bootstrap4@0.1.0"></script>

    
   <link href="<?php echo base_url('public/admin/abeditor/custom.css'); ?>" rel='stylesheet'>
   <style>
       .gjs-blocks-c > .gjs-block {
           background:#141470 !important;
       }
       input{
          background: white;
          color: black;
       }
       .fa-save{
           background-color: #28a745;
          color: white;
          padding: 6px 12px;
          border-radius: 5px;
          font-weight: bold;
          border: none;
          cursor: pointer;
          transition: background-color 0.3s ease;
       }
       .fa-save:hover {
          background-color: #218838;
        }
   </style>
   
   <!--custom plugins-->
    <script src="<?php echo base_url('public/admin/abeditor/nextlink.js'); ?>"></script>
  </head>
  <body>
    <div style="display: none">
      <div class="gjs-logo-cont">
        <h1 style="text-align:center;margin:5px;">AB Editor</h1>
        <div class="gjs-logo-version"></div>
      </div>
    </div>

    <div id="gjs" style="height:0px; overflow:hidden">
        <?=$content?>
        <style>
            <?=$contentcss?>
        </style>
  </div>
    <script>
    try{
        var blocks = <?php echo $this->block->getEditorBlocks(); ?>;
        var imageUploadPath = '<?php echo base_url("admin/upload"); ?>';
        var images = [<?php echo assets(); ?>];
        var headContent = `<?php echo json_encode($headContent) ?>`;
        var beforeBodyContent = `<?php echo json_encode($beforeend); ?>`;
        var saveUrlPath = "<?php echo base_url('admin/save'); ?>";
        var pageId = <?php echo $_GET['pageid'] ?? 0; ?>;
        var pageType = '<?php echo $_GET['type'] ?? ''; ?>';
    } catch (error) {
        console.error("An error occurred:", error);
    }
    </script>

    <script type="text/javascript">
        // var lp = 'template/index.html';
        // var plp = 'https://via.placeholder.com/350x250/';
        // var images = [
        //   lp + 'team1.jpg',
        //   lp + 'team2.jpg',
        //   lp + 'team3.jpg',
        //   plp + '78c5d6/fff',
        //   plp + '459ba8/fff',
        //   plp + '79c267/fff',
        //   plp + 'c5d647/fff',
        //   plp + 'f28c33/fff',
        //   plp + 'e868a2/fff',
        //   plp + 'cc4360/fff',
        //   lp + 'work-desk.jpg',
        //   lp + 'phone-app.png',
        //   lp + 'bg-gr-v.png'
        // ];
        
        
        
        

    </script>
    <script src="<?php echo base_url('public/admin/abeditor/custom.js'); ?>"></script>

    <!-- AI Generator Modal -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <div class="modal fade" id="aiGeneratorModal" tabindex="-1" aria-labelledby="aiGeneratorModalLabel" aria-hidden="true" style="z-index: 10000;">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-dark" id="aiGeneratorModalLabel"><i class="fa fa-magic text-success"></i> AI Content Generator</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-dark">
            <div class="form-group">
                <label for="aiPrompt">What would you like to build?</label>
                <textarea class="form-control mt-2" id="aiPrompt" rows="4" placeholder="e.g. Build a modern pricing section with 3 cards, blue buttons, and an FAQ section below it."></textarea>
            </div>
            <div id="aiLoadingIndicator" class="mt-3 text-center" style="display: none;">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2 text-muted">The AI is writing your code... This may take 10-20 seconds.</p>
            </div>
            <div id="aiErrorMessage" class="alert alert-danger mt-3" style="display: none;"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" id="btnGenerateAiContent">Generate & Insert</button>
          </div>
        </div>
      </div>
    </div>

    <script>
    $(document).ready(function() {
        // Wait briefly for GrapesJS to fully initialize
        setTimeout(function() {
            if (typeof editor !== 'undefined') {
                // Add AI Button to GrapesJS toolbar
                editor.Panels.addButton('options', {
                    id: 'ai-generate',
                    className: 'fa fa-magic',
                    command: 'open-ai-modal',
                    attributes: { title: 'Generate with AI', style: 'color: #28a745; font-size: 16px;' }
                });

                // Define the command to open our modal
                editor.Commands.add('open-ai-modal', {
                    run: function(editor, sender) {
                        sender.set('active', 0); // Deactivate the button so it doesn't stay highlighted
                        var aiModal = new bootstrap.Modal(document.getElementById('aiGeneratorModal'));
                        aiModal.show();
                    }
                });
            }
        }, 1000);

        $('#btnGenerateAiContent').click(function() {
            var prompt = $('#aiPrompt').val().trim();
            if(!prompt) {
                alert('Please enter a prompt.');
                return;
            }

            $('#btnGenerateAiContent').prop('disabled', true);
            $('#aiLoadingIndicator').show();
            $('#aiErrorMessage').hide();

            $.ajax({
                url: '<?php echo base_url("Ai/generate_html"); ?>',
                type: 'POST',
                dataType: 'json',
                data: { prompt: prompt },
                success: function(response) {
                    $('#btnGenerateAiContent').prop('disabled', false);
                    $('#aiLoadingIndicator').hide();
                    
                    if(response.status && response.html) {
                        // Inject directly into GrapesJS canvas
                        if (typeof editor !== 'undefined') {
                            editor.addComponents(response.html);
                        }
                        
                        // Close the modal and reset
                        $('#aiGeneratorModal').modal('hide');
                        $('#aiPrompt').val('');
                    } else {
                        $('#aiErrorMessage').text(response.error || 'Failed to generate content.').show();
                    }
                },
                error: function(xhr, status, error) {
                    $('#btnGenerateAiContent').prop('disabled', false);
                    $('#aiLoadingIndicator').hide();
                    $('#aiErrorMessage').text('Server error: ' + error).show();
                }
            });
        });
    });
    </script>
    
  </body>
</html>
