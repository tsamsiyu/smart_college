$ () ->
  $('#avatar > a > img').on 'click', () ->
    $('#avatar > a > input[type="file"]').trigger 'click'

  $('.uploadable-input').fileupload
    dataType: 'json'
    done: (response, data) ->
      if data.result.isSave and data.result.path
        $('#avatar-preview').attr 'src', data.result.path
        $('#avatar-preview-modal').modal()
        $('#avatar-preview').cropper
          aspectRatio: 16 / 9
          modal: true











#  $('#avatar > a').on 'click', () ->
#    $('#upload-avatar').modal();
#
#  $('#userpic').fileapi
#    url: uploadImgUrl
#    accept: 'image/*'
##    imageSize:
##      minWidth: 200
##      minHeight: 200
#    elements:
#      active:
#        show: '.js-upload'
#        hide: '.js-browse'
#      preview:
#        el: '.js-preview'
#        width: 200
#        height: 200
#      progress: '.js-progress'
#    onSelect: (evt, ui) ->
#      file = ui.files[0]
#      if !FileAPI.support.transform
#        alert 'Your browser does not support Flash :('
#      else if file
#        $('#userpic').fileapi('upload');
#

#        formData = new FormData
#        formData.append 'test', 'testvalue'
#        formData.append 'myfile', file
#        $.ajax
#          'url': uploadImgUrl
#          contentType: false
#          processData: false
#          type: 'POST'
#          enctype: 'multipart/form-data',
#          'data': formData
#      $('#popup').modal()
#        closeOnEsc: true
#        closeOnOverlayClick: false
#        onOpen: (overlay) ->
#          $(overlay).on 'click', '.js-upload', ->
#            $.modal().close()
#            $('#userpic').fileapi 'upload'
#            return
#          $('.js-img', overlay).cropper
#            file: file
#            bgColor: '#fff'
#            maxSize: [
#              $(window).width() - 100
#              $(window).height() - 100
#            ]
#            minSize: [
#              200
#              200
#            ]
#            selection: '90%'
#            onSelect: (coords) ->
#              $('#userpic').fileapi 'crop', file, coords
#              return
#          return