$ () ->
  $avatarImg = $('#avatar > img')
  $avatarUpload = $('#avatar > a > i')
  $blackfoneFrontOfUpload = $('#blackfone')

  avatarUploadingShow = () ->
    $avatarUpload.show()
    $blackfoneFrontOfUpload.show()

  avatarUploadingHide = () ->
    $avatarUpload.hide()
    $blackfoneFrontOfUpload.hide()

  $avatarImg.on 'mouseover', () ->
    avatarUploadingShow()

  $avatarImg.on 'mouseout', () ->
    avatarUploadingHide()

  $avatarUpload.on 'mouseover', () ->
    avatarUploadingShow()
    $avatarImg.addClass 'translucent'

  $avatarUpload.on 'mouseout', () ->
    avatarUploadingHide()
    $avatarImg.removeClass 'translucent'

  $blackfoneFrontOfUpload.on 'mouseover', () ->
    avatarUploadingShow()
    $avatarImg.addClass 'translucent'

  $blackfoneFrontOfUpload.on 'mouseout', () ->
    avatarUploadingHide()
    $avatarImg.removeClass 'translucent'


  $avatarUpload.on 'click', () ->
    $('#avatar > a > input[type="file"]').trigger 'click'

  $('.uploadable-input').fileupload
    dataType: 'json'
    done: (response, data) ->
      $avatarImg.attr 'src', data.result.url
