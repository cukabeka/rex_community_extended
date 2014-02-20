/*
* DevPanel Addon
*
* @author http://rexdev.de
* @link   http://www.redaxo.org/de/download/addons/?addon_id=919
*
* @version 0.1
* $Id$:
*/

jQuery.noConflict();

(function($){

// PHP INFO
$('#php-info h2').addClass('toggler');
$('#php-info h2').next('table').addClass('toggle-block');
$('#php-info h2').next('table').css('display','none');

$('#php-info .toggler').click(function () {
  $(this).next('.toggle-block').toggle(0, function(){
    var json = {};
    json[$(this).attr('id')] = $(this).css('display');
    backend_callback(json,'elem-state-save');
  });
});

// TOGGLE DEV TEMPLATE
$('#dev-block-toggler').click(function () {
  $('#dev-block').toggle(0, function(){
    var json = {};
    json[$(this).attr('id')] = $(this).css('display');
    backend_callback(json,'elem-state-save');
    if($('#dev-block').css('display')=='block'){
      $('#dev-block-toggler').addClass('opened');
    }else{
      $('#dev-block-toggler').removeClass('opened');
    }
  });
});

// EDIT VAR
$('span.edit-var').click(function () {
  $(this).css('display','none');
  $(this).next('.save-var').css('display','inline-block');
  var i = $(this).nextAll('input.toggler');
  i.addClass('edit-mode');
  i.attr('readonly',false);
  i.select();
});

// SAVE TRIGGERS
$('span.save-var').click(function () {
  $(this).css('display','none');
  $(this).prev('.edit-var').css('display','inline-block');
  var i = $(this).nextAll('input.toggler');
  i.removeClass('edit-mode');
  i.attr('readonly',true);
  var json = {};
  json['new_var'] = i.val();
  json['id'] = i.attr('id');
  backend_callback(json,'new-var-save');
  location.reload();
})
$('input.toggler').bind('keydown', function(e){
  var code = (e.keyCode ? e.keyCode : e.which);
  if(code == 13){
    $(this).prevAll('span.save-var').css('display','none');
    $(this).prevAll('span.edit-var').css('display','inline-block');
    $(this).removeClass('edit-mode');
    $(this).attr('readonly',true);
    var json = {};
    json['new_var'] = $(this).val();
    json['id'] = $(this).attr('id');
    backend_callback(json,'new-var-save');
    location.reload();
  }
});

// SAVE VAR FUNCTION
function save_var(){
  $('span.save-var').css('display','none');
  $('span.save-var').prev('.edit-var').css('display','inline-block');
  var i = $('span.save-var').nextAll('input.toggler');
  i.removeClass('edit-mode');
  i.attr('readonly',true);
  var json = {};
  json['new_var'] = i.val();
  json['id'] = i.attr('id');
  backend_callback(json,'new-var-save');
  //location.reload();
};


// TOGGLE ELEMENTS
$('.toggler').click(function () {
  $(this).parent().next('.toggle-block').toggle(0, function(){
    var json = {};
    json[$(this).attr('id')] = $(this).css('display');
    backend_callback(json,'elem-state-save');
  });
});


// COLLAPSE ALL PANEL-ITEMS
$('#panel-items-closer').click(function () {
  $('.toggle-block').each(function(){
    if($(this).css('display')=='block'){
      $(this).toggle(0);
    }
  });
  backend_callback('','collapse-all-panels');
});


// TOGGLE FULLSCREEN
$('#dev-block-maximizer').click(function (){
  t = $('#dev-block');
  if(t.hasClass('maximized')){
    $('#dev-block').removeClass('maximized');
    $(this).removeClass('maximized');
  }else{
    $('#dev-block').addClass('maximized');
    $(this).addClass('maximized');
  }
});

function backend_callback(json,func){
  var data = {};
  data['page'] = 'dev_panel';
  data['subpage'] = 'connector';
  data['faceless'] = '1';
  data['func'] = func;
  data['json'] = JSON.stringify(json);
  $.ajax({
  type: 'POST',
  url: ajax_url,
  data: data,
  async: false
  });
}

})(jQuery);