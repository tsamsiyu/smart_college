$materialsStorage = $('#materials-storage')
$materialsStorageWidget = $materialsStorage.storageWidget()


$('#add-folder').on 'click', () ->
  $materialsStorageWidget.addFolder()










#$body.on 'click', '.folder-cancel', () ->
#  $(this).closest('.folder-wrapper').remove()
#
#$body.on 'submit', '.folder-form', (e) ->
#  $self = $(this)
#  folder = $self.data('current-folder') + $self.find('input').val()
#  $.ajax
#    url: $self.attr 'action'
#    method: 'POST'
#    data:
#      'folder': folder
#  e.preventDefault()

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