$ () ->
  $avatarImg = $('#avatar-column > img')
  $avatarUpload = $('#avatar-column > a > i')
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

  $avatarUpload.on 'mouseout', () ->
    avatarUploadingHide()

  $blackfoneFrontOfUpload.on 'mouseover', () ->
    avatarUploadingShow()

  $blackfoneFrontOfUpload.on 'mouseout', () ->
    avatarUploadingHide()


  $avatarUpload.on 'click', () ->
    $('#avatar-column > a > input[type="file"]').trigger 'click'

  $('.uploadable-input').fileupload
    dataType: 'json'
    done: (response, data) ->
      $avatarImg.attr 'src', data.result.url
