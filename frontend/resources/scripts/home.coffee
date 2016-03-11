$ () ->
  $avatarImg = $('#avatar-column > img')
  $avatarUploadLink = $('#avatar-column > a')
  $fileInput = $('#avatar-column > input[type="file"]')

  $avatarImg.on 'mouseover', () ->
    $avatarUploadLink.removeClass('i-hide')

  $avatarImg.on 'mouseout', () ->
    $avatarUploadLink.addClass('i-hide')

  $avatarUploadLink.on 'mouseover', () ->
    $avatarUploadLink.removeClass('i-hide')

  $avatarUploadLink.on 'mouseout', () ->
    $avatarUploadLink.addClass('i-hide')

  $avatarUploadLink.on 'click', () ->
    $fileInput.trigger 'click'

  $fileInput.fileupload
    dataType: 'json'
    done: (response, data) ->
      $avatarImg.attr 'src', data.result.url