/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

$(function () {

  $('textarea#editor1').ckeditor ({
    filebrowserUploadUrl: $('#xxx').val (),
  });

  CKEDITOR.on ('dialogDefinition', function (ev) {
    var dialogName = ev.data.name;
    var dialogDefinition = ev.data.definition;

    if (dialogName == 'link') {
      var infoTab = dialogDefinition.getContents ('info');
      infoTab.remove ('linkType');
      dialogDefinition.getContents ('target').get ('linkTargetType')['default'] = '_blank';
    }
  });

});