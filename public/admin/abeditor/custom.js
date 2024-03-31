var editor = grapesjs.init({
          canvas: {
              autoscrollLimit: 100, // Set the autoscrollLimit here
              scripts: [],
              styles: [],
              frameContent: '<!DOCTYPE html>',
         },
          storageManager: { autoload: false },
          height: '100%',
          container: '#gjs',
          fromElement: true,
          showOffsets: true,
          assetManager: {
              embedAsBase64: false,
              assets: images,
              upload: imageUploadPath,
              uploadName: "files",
            },
          selectorManager: { componentFirst: true },
          styleManager: {
            sectors: [{
              name: 'General',
              properties: [
                {
                  extend: 'float',
                  type: 'radio',
                  default: 'none',
                  options: [
                    { value: 'none', className: 'fa fa-times' },
                    { value: 'left', className: 'fa fa-align-left' },
                    { value: 'right', className: 'fa fa-align-right' }
                  ],
                },
                'display',
                { extend: 'position', type: 'select' },
                'top',
                'right',
                'left',
                'bottom',
              ],
            }, {
              name: 'Dimension',
              open: false,
              properties: [
                'width',
                {
                  id: 'flex-width',
                  type: 'integer',
                  name: 'Width',
                  units: ['px', '%'],
                  property: 'flex-basis',
                  toRequire: 1,
                },
                'height',
                'max-width',
                'min-height',
                'margin',
                'padding'
              ],
            }, {
              name: 'Typography',
              open: false,
              properties: [
                'font-family',
                'font-size',
                'font-weight',
                'letter-spacing',
                'color',
                'line-height',
                {
                  extend: 'text-align',
                  options: [
                    { id: 'left', label: 'Left', className: 'fa fa-align-left' },
                    { id: 'center', label: 'Center', className: 'fa fa-align-center' },
                    { id: 'right', label: 'Right', className: 'fa fa-align-right' },
                    { id: 'justify', label: 'Justify', className: 'fa fa-align-justify' }
                  ],
                },
                {
                  property: 'text-decoration',
                  type: 'radio',
                  default: 'none',
                  options: [
                    { id: 'none', label: 'None', className: 'fa fa-times' },
                    { id: 'underline', label: 'underline', className: 'fa fa-underline' },
                    { id: 'line-through', label: 'Line-through', className: 'fa fa-strikethrough' }
                  ],
                },
                'text-shadow'
              ],
            }, {
              name: 'Decorations',
              open: false,
              properties: [
                'opacity',
                'border-radius',
                'border',
                'box-shadow',
                'background', // { id: 'background-bg', property: 'background', type: 'bg' }
              ],
            }, {
              name: 'Extra',
              open: false,
              buildProps: [
                'transition',
                'perspective',
                'transform'
              ],
            }, {
              name: 'Flex',
              open: false,
              properties: [{
                name: 'Flex Container',
                property: 'display',
                type: 'select',
                defaults: 'block',
                list: [
                  { value: 'block', name: 'Disable' },
                  { value: 'flex', name: 'Enable' }
                ],
              }, {
                name: 'Flex Parent',
                property: 'label-parent-flex',
                type: 'integer',
              }, {
                name: 'Direction',
                property: 'flex-direction',
                type: 'radio',
                defaults: 'row',
                list: [{
                  value: 'row',
                  name: 'Row',
                  className: 'icons-flex icon-dir-row',
                  title: 'Row',
                }, {
                  value: 'row-reverse',
                  name: 'Row reverse',
                  className: 'icons-flex icon-dir-row-rev',
                  title: 'Row reverse',
                }, {
                  value: 'column',
                  name: 'Column',
                  title: 'Column',
                  className: 'icons-flex icon-dir-col',
                }, {
                  value: 'column-reverse',
                  name: 'Column reverse',
                  title: 'Column reverse',
                  className: 'icons-flex icon-dir-col-rev',
                }],
              }, {
                name: 'Justify',
                property: 'justify-content',
                type: 'radio',
                defaults: 'flex-start',
                list: [{
                  value: 'flex-start',
                  className: 'icons-flex icon-just-start',
                  title: 'Start',
                }, {
                  value: 'flex-end',
                  title: 'End',
                  className: 'icons-flex icon-just-end',
                }, {
                  value: 'space-between',
                  title: 'Space between',
                  className: 'icons-flex icon-just-sp-bet',
                }, {
                  value: 'space-around',
                  title: 'Space around',
                  className: 'icons-flex icon-just-sp-ar',
                }, {
                  value: 'center',
                  title: 'Center',
                  className: 'icons-flex icon-just-sp-cent',
                }],
              }, {
                name: 'Align',
                property: 'align-items',
                type: 'radio',
                defaults: 'center',
                list: [{
                  value: 'flex-start',
                  title: 'Start',
                  className: 'icons-flex icon-al-start',
                }, {
                  value: 'flex-end',
                  title: 'End',
                  className: 'icons-flex icon-al-end',
                }, {
                  value: 'stretch',
                  title: 'Stretch',
                  className: 'icons-flex icon-al-str',
                }, {
                  value: 'center',
                  title: 'Center',
                  className: 'icons-flex icon-al-center',
                }],
              }, {
                name: 'Flex Children',
                property: 'label-parent-flex',
                type: 'integer',
              }, {
                name: 'Order',
                property: 'order',
                type: 'integer',
                defaults: 0,
                min: 0
              }, {
                name: 'Flex',
                property: 'flex',
                type: 'composite',
                properties: [{
                  name: 'Grow',
                  property: 'flex-grow',
                  type: 'integer',
                  defaults: 0,
                  min: 0
                }, {
                  name: 'Shrink',
                  property: 'flex-shrink',
                  type: 'integer',
                  defaults: 0,
                  min: 0
                }, {
                  name: 'Basis',
                  property: 'flex-basis',
                  type: 'integer',
                  units: ['px', '%', ''],
                  unit: '',
                  defaults: 'auto',
                }],
              }, {
                name: 'Align',
                property: 'align-self',
                type: 'radio',
                defaults: 'auto',
                list: [{
                  value: 'auto',
                  name: 'Auto',
                }, {
                  value: 'flex-start',
                  title: 'Start',
                  className: 'icons-flex icon-al-start',
                }, {
                  value: 'flex-end',
                  title: 'End',
                  className: 'icons-flex icon-al-end',
                }, {
                  value: 'stretch',
                  title: 'Stretch',
                  className: 'icons-flex icon-al-str',
                }, {
                  value: 'center',
                  title: 'Center',
                  className: 'icons-flex icon-al-center',
                }],
              }]
            }
            ],
          },
          plugins: [
            'gjs-blocks-basic',
            'grapesjs-plugin-forms', // forms section in stylemanager
            'grapesjs-component-countdown',
            // 'grapesjs-plugin-export',
            'grapesjs-tabs',
            'grapesjs-custom-code',
            'grapesjs-touch',
            'grapesjs-parser-postcss',
            'grapesjs-tooltip',
            'grapesjs-tui-image-editor',
            'grapesjs-typed',
            'grapesjs-style-bg',
            'grapesjs-preset-webpage',
            // 'grapesjs-swiper-slider',
            'grapesjs-plugin-toolbox',
            // 'grapesjs-lory-slider',
            // 'gjs-social',
            // 'grapesjs-plugin-ckeditor',
            'grapesjs-rulers',
            "grapesjs-component-code-editor",
            "grapesjs-parser-postcss",
          ],
          pluginsOpts: {
              "grapesjs-component-code-editor": {
                  /* Test here your options  */
                },
            'grapesjs-rulers': { /* options */ },
            'gjs-blocks-basic': { 
                flexGrid: true ,
                blocks: ['column1', 'column2', 'column3','column4','column3-7', 'text', 'link', 'image', 'video', 'map'],
                category: 'Basic',
                stylePrefix: '', // no gjs- prefix
                flexGrid: 1 // use flexbox instead of tables
            },
            'grapesjs-tui-image-editor': {
                config: {
                  includeUI: {
                    initMenu: 'filter',
                  },
                },
                labelImageEditor: "AB Image Editor",
              },
            'grapesjs-tabs': {
              tabsBlock: { category: 'Extra' }
            },
            'grapesjs-typed': {
              script: 'https://cdn.jsdelivr.net/npm/typed.js@2.0.11',
              block: {
                category: 'Extra',
                content: {
                  label: 'Typed',
                  type: 'typed',
                  'type-speed': 40,
                  strings: [
                    'Welcome to AB Editor',
                    'Please enjoy',
                    'AB Editor features',
                  ],
                }
              }
            },
            'grapesjs-preset-webpage': {
              blocks: ['link-block', 'quote', 'text-basic'],
              modalImportTitle: 'Import Template',
              modalImportLabel: '<div style="margin-bottom: 10px; font-size: 13px;">Paste here your HTML/CSS and click Import</div>',
              modalImportContent: function (editor) {
                return editor.getHtml() + '<style>' + editor.getCss() + '</style>'
              },
              useCustomTheme:true,
            },
            'grapesjs-swiper-slider': {
              // options
            },
            'grapesjs-plugin-toolbox': {
              panels: false,
            },
            'grapesjs-lory-slider': {
                sliderOptions: {
                    infinite: true,
                    rewind: true,
                    slidesToScroll: 1,
                    enableMouseEvents: true,
                    enableTouchEvents: true,
                    rewindOnResize: true,
                },
                sliderId: 'my-lory-slider',
                gallery: false,
                prevButton: true,
                nextButton: true,
                scrollbar: false,
                options: [
                    {
                        slideId: 'slide1',
                        // Custom slide options here
                    },
                    {
                        slideId: 'slide2',
                        // Custom slide options here
                    }
                ]
            },
            'gjs-social': {
                
            },
            // 'grapesjs-plugin-ckeditor': { 
            //     options: {
            //         language: 'en',
            //         toolbar: [
            //             { name: 'document', items: ['Source'] },
            //             { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'] },
            //             { name: 'editing', items: ['Find', 'Replace', '-', 'SelectAll'] },
            //             '/',
            //             { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'] },
            //             { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language'] },
            //             { name: 'links', items: ['Link', 'Unlink', 'Anchor'] },
            //             { name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe'] },
            //             '/',
            //             { name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize'] },
            //             { name: 'colors', items: ['TextColor', 'BGColor'] },
            //         ],
            //     },
            // },
          },
          blockManager: {
            //   appendTo : '#blocks',
              blocks : blocks
            },
        });

        
        function addHeadContent(headContent) {
          // Get the GrapeJS iframe's head component
          var frameHead = editor.Canvas.getFrameEl().contentDocument.head;
          // Set the innerHTML of the head element
          frameHead.innerHTML = headContent;
          console.log('Head content loaded.');
        }
        function addContentBeforeBodyClosingTag(bodyContent) {
          // Get the GrapeJS iframe's document
          var frameDocument = editor.Canvas.getFrameEl().contentDocument;
          // Insert your content immediately before the </body> tag
          frameDocument.body.insertAdjacentHTML('beforeend', bodyContent);
        }
        
        editor.on('load', function () {
          // Call the function to add the custom head content
          addHeadContent(headContent);
          // Call the function to add the custom content before the </body> tag
          addContentBeforeBodyClosingTag(beforeBodyContent);
        
        });
        
        
        editor.I18n.addMessages({
          en: {
            styleManager: {
              properties: {
                'background-repeat': 'Repeat',
                'background-position': 'Position',
                'background-attachment': 'Attachment',
                'background-size': 'Size',
              }
            },
          }
        });
        
        var pn = editor.Panels;
        var modal = editor.Modal;
        var cmdm = editor.Commands;
        
        // Update canvas-clear command
        
        cmdm.add('canvas-clear', function () {
          if (confirm('Are you sure to clean the canvas?')) {
            editor.runCommand('core:canvas-clear')
            setTimeout(function () { localStorage.clear() }, 0)
          }
        });
        
        var mdlClass = 'gjs-mdl-dialog-sm';
        
        cmdm.add('save-db', {
          run: function (editor, sender) {
            sender && sender.set('active', 0); // turn off the button
            editor.store();
            //storing values to variables
            var htmldata = editor.getHtml();
            var cssdata = editor.getCss();
        
            $.ajax({
              url: saveUrlPath,
              dataType: 'json',
              type: "post",
              data: { action: "savePageContent", htmldata: htmldata, cssdata: cssdata ,pageId:pageId,pageType:pageType},
              beforeSend: function () {
        
              },
              success: function (res) {
                alert('saved');
              }
            });
        
          }
        });
        
        cmdm.add('closeEditor',{
            run: function (editor, sender) {
                window.history.back();
            }
        });
        
        pn.addButton('options', [{
          id: 'save-db',
          className: 'fa fa-save',
          command: 'save-db',
          attributes: {
            title: 'Save Changes'
          }
        }]);
        pn.addButton('options', [{
          id: 'close',
          className: 'fa fa-sign-out',
          command: 'closeEditor',
          attributes: {
            title: 'Close'
          }
        }]);
        
        
        // Simple warn notifier
        var origWarn = console.warn;
        toastr.options = {
          closeButton: true,
          preventDuplicates: true,
          showDuration: 250,
          hideDuration: 150
        };
        console.warn = function (msg) {
          if (msg.indexOf('[undefined]') == -1) {
            toastr.warning(msg);
          }
          origWarn(msg);
        };
        
        
        // Add and beautify tooltips
        [['close', 'Close'],['sw-visibility', 'Show Borders'], ['preview', 'Preview'], ['fullscreen', 'Fullscreen'],
        ['undo', 'Undo'], ['redo', 'Redo'],
        ['gjs-open-import-webpage', 'Import'], ['canvas-clear', 'Clear canvas']]
          .forEach(function (item) {
            pn.getButton('options', item[0]).set('attributes', { title: item[1], 'data-tooltip-pos': 'bottom' });
          });
        [['open-sm', 'Style Manager'], ['open-layers', 'Layers'], ['open-blocks', 'Blocks']]
          .forEach(function (item) {
            pn.getButton('views', item[0]).set('attributes', { title: item[1], 'data-tooltip-pos': 'bottom' });
          });
        var titles = document.querySelectorAll('*[title]');
        
        for (var i = 0; i < titles.length; i++) {
          var el = titles[i];
          var title = el.getAttribute('title');
          title = title ? title.trim() : '';
          if (!title)
            break;
          el.setAttribute('data-tooltip', title);
          el.setAttribute('title', '');
        }
        
        
        // Do stuff on load
        editor.on('load', function () {
          var $ = grapesjs.$;
        
          // Show borders by default
          pn.getButton('options', 'sw-visibility').set('active', 1);
        
          // Show logo with the version
          var logoCont = document.querySelector('.gjs-logo-cont');
          document.querySelector('.gjs-logo-version').innerHTML = 'v' + grapesjs.version;
          var logoPanel = document.querySelector('.gjs-pn-commands');
          logoPanel.appendChild(logoCont);
        
        
          // Load and show settings and style manager
          var openTmBtn = pn.getButton('views', 'open-tm');
          openTmBtn && openTmBtn.set('active', 1);
          var openSm = pn.getButton('views', 'open-sm');
          openSm && openSm.set('active', 1);
        
          // Remove trait view
          pn.removeButton('views', 'open-tm');
        
          // Add Settings Sector
          var traitsSector = $('<div class="gjs-sm-sector no-select">' +
            '<div class="gjs-sm-sector-title"><span class="icon-settings fa fa-cog"></span> <span class="gjs-sm-sector-label">Settings</span></div>' +
            '<div class="gjs-sm-properties" style="display: none;"></div></div>');
          var traitsProps = traitsSector.find('.gjs-sm-properties');
          traitsProps.append($('.gjs-trt-traits'));
          $('.gjs-sm-sectors').before(traitsSector);
          traitsSector.find('.gjs-sm-sector-title').on('click', function () {
            var traitStyle = traitsProps.get(0).style;
            var hidden = traitStyle.display == 'none';
            if (hidden) {
              traitStyle.display = 'block';
            } else {
              traitStyle.display = 'none';
            }
          });
        
          // Open block manager
          var openBlocksBtn = editor.Panels.getButton('views', 'open-blocks');
          openBlocksBtn && openBlocksBtn.set('active', 1);
        
        });
        
        // testing
        
        
        
        // The upload is started
        editor.on('asset:upload:start', () => {
          console.log('uploading files...');
        });
        
        // The upload is ended (completed or not)
        editor.on('asset:upload:end', () => {
          console.log('uploaded files...');
        });
        
        // Error handling
        editor.on('asset:upload:error', (err) => {
          console.log('Error '+ err);
        });
        
        // Do something on response
        editor.on('asset:upload:response', (response) => {
            if(response == 1){
                alert('uploaded successfully.');
            }else{
                alert(response);
            }
        });
        
        
        // ruller plugin
        const panelViews = pn.addPanel({
          id: 'options'
        });
        panelViews.get('buttons').add([{
          attributes: {
            title: 'Toggle Rulers'
          },
          context: 'toggle-rulers', //prevents rulers from being toggled when another views-panel button is clicked 
          label: `<svg width="18" viewBox="0 0 16 16"><path d="M0 8a.5.5 0 0 1 .5-.5h15a.5.5 0 0 1 0 1H.5A.5.5 0 0 1 0 8z"/><path d="M4 3h8a1 1 0 0 1 1 1v2.5h1V4a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v2.5h1V4a1 1 0 0 1 1-1zM3 9.5H2V12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V9.5h-1V12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.5z"/></svg>`,
          command: 'ruler-visibility',
          id: 'ruler-visibility'
        }]);
        editor.on('run:preview', () => editor.stopCommand('ruler-visibility'));
        // ruller plugin ends
        
        // code editor 
        const panelViews1 = pn.addPanel({
          id: "views"
        });
        panelViews1.get("buttons").add([
          {
            attributes: {
              title: "Open Code"
            },
            className: "fa fa-file-code-o",
            command: "open-code",
            togglable: false, //do not close when button is clicked again
            id: "open-code"
          }
        ]);
        // code editor
