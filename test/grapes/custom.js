var lp = 'http://builder.webfire.in/template/index.html';
var plp = 'https://via.placeholder.com/350x250/';
var images = [
  lp + 'team1.jpg',
  lp + 'team2.jpg',
  lp + 'team3.jpg',
  plp + '78c5d6/fff',
  plp + '459ba8/fff',
  plp + '79c267/fff',
  plp + 'c5d647/fff',
  plp + 'f28c33/fff',
  plp + 'e868a2/fff',
  plp + 'cc4360/fff',
  lp + 'work-desk.jpg',
  lp + 'phone-app.png',
  lp + 'bg-gr-v.png'
];

var editor = grapesjs.init({
  storageManager: false,
  height: '100%',
  container: '#gjs',
  fromElement: true,
  showOffsets: true,
  assetManager: {
    embedAsBase64: true,
    assets: images
  },
  selectorManager: { componentFirst: true },
  styleManager: {
    // ... Your style manager configurations ...
  },
  plugins: [
    'gjs-blocks-basic',
    'grapesjs-plugin-forms',
    'grapesjs-plugin-export',
    'grapesjs-tabs',
    'grapesjs-custom-code',
    'grapesjs-tooltip',
    'grapesjs-tui-image-editor',
    'grapesjs-typed',
    'grapesjs-preset-webpage',
    'grapesjs-swiper-slider',
    'grapesjs-plugin-toolbox',
    'grapesjs-tui-image-editor' // Include any additional plugins you need
  ],
  pluginsOpts: {
    'gjs-blocks-basic': { flexGrid: true },
    'grapesjs-tui-image-editor': {
      // ... Configuration for the TUI image editor plugin ...
    },
    'grapesjs-tabs': {
      tabsBlock: { category: 'Extra' }
    },
    'grapesjs-typed': {
      // ... Configuration for the typed plugin ...
    },
    'grapesjs-preset-webpage': {
      // ... Configuration for the webpage preset ...
    },
    'grapesjs-swiper-slider': {
      // ... Configuration for the swiper slider plugin ...
    },
    'grapesjs-plugin-toolbox': {
      // ... Configuration for the toolbox plugin ...
    },
    'grapesjs-tui-image-editor': {
      // ... Configuration for the TUI image editor plugin ...
    }
  },
});

// Add your custom CSS links
function addCssLink(url) {
  var link = document.createElement('link');
  link.rel = 'stylesheet';
  link.type = 'text/css';
  link.href = url;
  var frameHead = editor.Canvas.getFrameEl().contentDocument.head;
  frameHead.appendChild(link);
}

// Add custom CSS links
addCssLink('https://wtntechnologies.co.in/public/theme/default/assets/css/main.css');
addCssLink('https://wtntechnologies.co.in/public/theme/default/assets/css/custom.css');

// ... Rest of your code ...



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

// Add info command
var mdlClass = 'gjs-mdl-dialog-sm';
var infoContainer = document.getElementById('info-panel');
cmdm.add('save-db', {
  run: function (editor, sender) {
    sender && sender.set('active', 0); // turn off the button
    editor.store();
    //storing values to variables
    var htmldata = editor.getHtml();
    var cssdata = editor.getCss();

    $.ajax({
      url: savepathurl,
      dataType: 'json',
      type: "post",
      data: { action: "savePageContent", htmldata: htmldata, cssdata: cssdata },
      beforeSend: function () {

      },
      success: function (res) {
        alert('saved');
      }
    });

    //   $.post("<?php echo (''); ?>", {
    //      //you can get value in post by calling this name
    //      "htmldata": htmldata,
    //      "cssdata": cssdata,
    //      "action":  'savePageContent',
    //      success: function(data) {
    //       alert('Saved Successfully.');
    //       console.log("Success");
    //      },
    //   });


  }
});
cmdm.add('open-info', function () {
  var mdlDialog = document.querySelector('.gjs-mdl-dialog');
  mdlDialog.className += ' ' + mdlClass;
  infoContainer.style.display = 'block';
  modal.setTitle('About this demo');
  modal.setContent(infoContainer);
  modal.open();
  modal.getModel().once('change:open', function () {
    mdlDialog.className = mdlDialog.className.replace(mdlClass, '');
  })
});

pn.addButton('options', [{
  id: 'open-info',
  className: 'fa fa-question-circle',
  command: function () { editor.runCommand('open-info') },
  attributes: {
    'title': 'About',
    'data-tooltip-pos': 'bottom',
  },
}, {
  id: 'save-db',
  className: 'fa fa-save',
  command: 'save-db',
  attributes: {
    title: 'Save Changes'
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
[['sw-visibility', 'Show Borders'], ['preview', 'Preview'], ['fullscreen', 'Fullscreen'],
['export-template', 'Export'], ['undo', 'Undo'], ['redo', 'Redo'],
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


// Store and load events
//   editor.on('storage:load', function(e) { console.log('Loaded ', e) });
//   editor.on('storage:store', function(e) { console.log('Stored ', e) });


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