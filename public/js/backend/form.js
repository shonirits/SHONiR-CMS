p(document).ready(function() {

  const maxLoadWait = 3000;
  const isReady = setInterval(() => {
  const isPluginsReady = are_core_plugins_ready_fnc();
  const isTimeout = Date.now() - start_timer > maxLoadWait;

if (isPluginsReady || isTimeout) {
      clearInterval(isReady);
 
  const ajax_selectors = [
  '#items',
  '#categories',
  '#sections',
  '#awards',
  '#natives',
  '#brands',
  '#industries',
  '#places',
  '#regions',
  '#voices',
  '#actors',
  '#actresses',
  '#directors',
  '#producers',
  '#writers',
  '#singers',
  '#designers',
  '#editors',
  '#cinematographers'
];

ajax_selectors.forEach(selector => {
  const $el = p(selector);
  if ($el.length) {
    const type = selector.slice(1);
    ajax_select_fnc(selector, type);
  }
});

var parent_type = document.getElementById('parent_type');
    if (parent_type) {
        parent_type.addEventListener('change', parent_type_fnc, false);
    }

  function parent_type_fnc(selected = false) {
  const selectedType = parent_type.value;
  const container = document.getElementById('parent_id_content');

  if (selectedType !== "") {
    const parent_options = build_options_fnc(parent_list, selected);

    container.innerHTML = `
      <div class="row p-3">
        <label for="${selectedType}" class="form-label">Parent</label>
        <select class="form-control" id="${selectedType}" name="${selectedType}" required>
          <option value="">— Select a parent —</option>
          ${parent_options}
        </select>
        <div class="invalid-feedback">  
          Required valid information.
        </div>
        <div id="${selectedType}helpblock" class="form-text">
          You can select only one parent for this record.
        </div>
      </div>
    `;
    ajax_select_fnc(`#${selectedType}`, selectedType);
  } else {
    container.innerHTML = '';
  }
}

function build_options_fnc(list, selected = false) {
  let options = '';
  for (const [id, name] of Object.entries(list)) {
    options += `<option value="${id}" ${selected ? 'selected="selected" selected' : ''}>${name}</option>`;
  }
  return options;
}


  

  p('#parents').select2({
    placeholder: 'Select Parents',
    theme: 'classic'
  });

  var galleryPick = document.getElementById('gallery-pick');
    if (galleryPick) {
        galleryPick.addEventListener('change', read_gallery_fnc, false);
    }

  
  p( ".preview-gallery-zone" ).sortable({
  stop: function(event, ui) {
      var data = "";
  
      p(".preview-gallery").each(function(i, el){
          var ord = p(el).attr('id');
          data += ord+"="+p(el).index()+",";
      });
     p('#gallery_sort_order').val(data);
  }
  }).disableSelection();
  
  p(document).on('click', '.gallery-cancel', function() {
      let no = p(this).data('no');
      p(".preview-gallery.preview-show-"+no).remove();
      p("#gallery-file-"+no).remove();
      setTimeout(function() {
        gallery_sort_order_fnc();
    }, 300);
  });
  

  var imagesPick = document.getElementById('images-pick');
    if (imagesPick) {
        imagesPick.addEventListener('change', read_images_fnc, false);
    }
  
  p( ".preview-images-zone" ).sortable({
  stop: function(event, ui) {
      var data = "";
  
      p(".preview-image").each(function(i, el){
          var ord = p(el).attr('id');
          data += ord+"="+p(el).index()+",";
      });
     p('#images_sort_order').val(data);
  }
  }).disableSelection();
  
  p(document).on('click', '.image-cancel', function() {
      let no = p(this).data('no');
      p(".preview-image.preview-show-"+no).remove();
      p("#image-file-"+no).remove();
      setTimeout(function() {
      images_sort_order_fnc();
    }, 300);
  });

  window.isFormLoaded = true;
  
}
  }, 10);
  });


gal_id = 0;

function gallery_sort_order_fnc(){
var data = "";
    p(".preview-gallery").each(function(i, el){
        var ord = p(el).attr('id');
        data += ord+"="+p(el).index()+",";
    });
    p('#gallery_sort_order').val(data);
}


function read_gallery_fnc() {  
if (window.File && window.FileList && window.FileReader) {
    var num = 0;
  var names = [];
    var files = event.target.files; 
    var output = p(".preview-gallery-zone");
    var e = p(this);
    var clone = e.clone(true).prop('id', 'gallery-file-'+num ).addClass('appended_gallery_files');
      for (let i = 0; i < files.length; i++) {
      var file = files[i];
      names[i] = files[i].name;
        if (file.type.match('image')){
      var picReader = new FileReader();       
        picReader.addEventListener('load', function (event) {
            var picFile = event.target;
            var html =  '<div class="preview-gallery preview-show-' + gal_id + '" id="' +  names[num] + '">' +
                        '<div class="btn btn-danger gallery-cancel" data-no="' + gal_id + '"><i class="fas fa-trash fa-sm text-white-50"></i></div>' +
                        '<div class="gallery-zone"><img id="pro-img-' + gal_id + '" src="' + picFile.result + '"></div>' +
                        '<div class="tools-edit-gallery"><a data-fancybox="grp-gallery" href="' + picFile.result + '" data-no="' + gal_id + '" class="btn btn-info btn-edit-image"><i class="fas fa-search-plus fa-lg text-white-50"></i></a></div>' +
                        '</div>';
            output.append(html);
            clone.appendTo('#appended_gallery_files');
            num = num + 1;
            gal_id++;
      });
    picReader.readAsDataURL(file);
    }else{      
      alert('File not support');
    }          
    }
    e.val('');
    setTimeout(function() {
      gallery_sort_order_fnc();
  }, 300);
} else {
    alert('Browser not support');
}
}

img_id = 0;

function images_sort_order_fnc(){
var data = "";
    p(".preview-image").each(function(i, el){
        var ord = p(el).attr('id');
        data += ord+"="+p(el).index()+",";
    });
    p('#images_sort_order').val(data);
}



function read_images_fnc() { 
if (window.File && window.FileList && window.FileReader) {  
  var num = 0;
  var names = [];
    var files = event.target.files; 
    var output = p(".preview-images-zone");
    var e = p(this);
    var clone = e.clone(true).prop('id', 'image-file-'+num ).addClass('appended_images_files');          
    for (let i = 0; i < files.length; i++) {
      var file = files[i];
      names[i] = files[i].name;
        if (file.type.match('image')){
      var picReader = new FileReader();   
        picReader.addEventListener('load', function (event) {
            var picFile = event.target;
            var html =  '<div class="preview-image preview-show-' + img_id + '" id="' +  names[num] + '">' +
                        '<div class="btn btn-danger image-cancel" data-no="' + img_id + '"><i class="fas fa-trash fa-sm text-white-50"></i></div>' +
                        '<div class="image-zone"><img id="pro-img-' + img_id + '" src="' + picFile.result + '"></div>' +
                        '<div class="tools-edit-image"><a data-fancybox="grp-images" href="' + picFile.result + '" data-no="' + img_id + '" class="btn btn-info btn-edit-image"><i class="fas fa-search-plus fa-lg text-white-50"></i></a></div>' +
                        '</div>';
            output.append(html);
            clone.appendTo('#appended_images_files');
            num = num + 1;
            img_id++;
      });        
     picReader.readAsDataURL(file);
    }else{      
      alert('File not support');
    }          
    }
    e.val('');
    setTimeout(function() {
    images_sort_order_fnc();
  }, 300);
} else {
    alert('Browser not support');
}
}

function ajax_select_fnc(selector, type) {
  p(selector).select2({
    placeholder: `Select ${type.charAt(0).toUpperCase() + type.slice(1)}`,
    theme: 'classic',
    allowClear: true,
    minimumInputLength: 2,
    ajax: {
      url: base_url + 'Ajax/select_search',
      dataType: 'json',
      delay: 250,
      data: function (params) {
        return {
          q: params.term,
          t: type
        };
      },
      processResults: function (data) {
        return {
          results: data.map(function (item) {
            return {
              id: item.id,
              text: item.name
            };
          })
        };
      },
      cache: true
    }
  });
}