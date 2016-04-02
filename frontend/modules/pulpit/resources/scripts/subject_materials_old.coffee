$materialsStorage = $('#materials-storage')

$materialsStorageWidget = $materialsStorage.storageWidget({
  onFolderCreate: (base, e, $form, folder) ->
    folder = folder + '/' + $form.find('input').val()
    if folder != '/'
      $.ajax
        url: window.addFolderUrl
        method: 'POST'
        dataType: 'json'
        data:
          'folder': folder
      .done (response) ->
        if response.status == Api.serverResponse.status.CREATED
          $materialsStorageWidget.applyFolder($form)
    e.preventDefault()

  onFolderRemove: (base, e, $folderWrapper, folder) ->
    if folder
      $.ajax
        url: window.removeFolderUrl
        method: 'POST'
        dataType: 'json'
        data:
          'folder' : folder
      .done (response) ->
        if response.status == Api.serverResponse.status.DELETED
          base(e, $folderWrapper, folder)
})


$('#add-folder').on 'click', () ->
  $materialsStorageWidget.addFolder()








#$body.on 'click', '.folder-cancel', () ->
#  $(this).closest('.folder-wrapper').remove()
#
#$body.on 'submit', '.folder-form', (e) ->
#  $self = $(this)


#$fileInput = $('#add-file-input')
#$body = $('body')
#$storageList = $('#storage-list')
#folderPatternHtml = $('#folder-pattern').html()
#
#$('#add-file-input').fileupload
#  dataType: 'json'
#  url: $fileInput.closest('form').attr('action')
#
#  ### EVENTS ###
#$('#add-file').on 'click', () ->
#  $fileInput.trigger 'click'
#