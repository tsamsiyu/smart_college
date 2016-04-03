$formAddFolder = $('#form-add-folder')
$materialsStorage = $('#materials-storage')
$addingFileForm = $('#adding-file-form')

folderRowPattern = $('#folder-row-pattern').html()
fileRowPattern = $('#file-row-pattern').html()


$materialsStorage.on 'click', '.material-wrapper .material-remove', (e) ->
  e.preventDefault()
  removeByLinkOptions($(this))

$materialsStorage.on 'click', '.material-wrapper .material-remove-folder', (e) ->
  e.preventDefault()
  removeByLinkOptions($(this))

$formAddFolder.on 'submit', (e) ->
  e.preventDefault()
  $self = $(this)
  $self.ajaxForm().done (response) ->
    if response.status == Api.serverResponse.status.CREATED
      $self.addClass 'hidden'
      $self.find('input[type="text"]').val('')
      $materialsStorage.prepend(folderRowPattern
        .replace(/\{path\}/gi, response.data.path + '/' + response.data.folder)
        .replace(/\{name\}/gi, response.data.folder))

$('#add-folder').on 'click', () ->
  $self = $(this)
  $formAddFolder.removeClass 'hidden'

$('#close-folder-adding').on 'click', () ->
  $formAddFolder.addClass('hidden').find('input[type="text"]').val('')

$('#add-file').on 'click', () ->
  $addingFileForm.find('input[type="file"]').trigger 'click'

$addingFileForm.find('input[type="file"]').fileupload
  dataType: 'json'
  done: (response, data) ->
    if data.result.status == Api.serverResponse.status.STORED
      placeholders = data.result.data
      console.log placeholders
      $materialsStorage.append(fileRowPattern
      .replace(/\{name\}/gi, placeholders.name)
      .replace(/\{downloadUrl\}/gi, placeholders.downloadUrl)
      .replace(/\{path\}/gi, placeholders.path))


removeByLinkOptions = ($link) ->
  if confirm $link.data('confirm-msg')
    path = $link.data('path')
    if path
      $.ajax
        method: 'DELETE'
        url: $link.attr 'href'
        data:
          path: path
        dataType: 'json'
      .done (response) ->
        if response.status == Api.serverResponse.status.DELETED
          $link.closest('.material-wrapper').remove()