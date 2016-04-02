$formAddFolder = $('#form-add-folder')
folderRowPattern = $('#folder-row-pattern').html()
$materialsStorage = $('#materials-storage')

$materialsStorage.on 'click', '.material-wrapper .material-remove', (e) ->
  e.preventDefault()
  removeByLinkOptions($(this))

$materialsStorage.on 'click', '.material-wrapper .material-remove-folder', (e) ->
  e.preventDefault()
  removeByLinkOptions($(this))

$('#input-add-file').on 'click', () ->
  console.log 'add file'

$formAddFolder.on 'submit', (e) ->
  e.preventDefault()
  $self = $(this)
  $self.ajaxForm().done (response) ->
    if response.status == Api.serverResponse.status.CREATED
      $self.addClass 'hidden'
      $self.trigger 'reset'
      $materialsStorage.append(folderRowPattern
      .replace(/\{path\}/gi, response.data.path + '/' + response.data.folder)
      .replace(/\{name\}/gi, response.data.folder)
      )

$('#add-folder').on 'click', () ->
  $self = $(this)
  $formAddFolder.removeClass 'hidden'

$('#close-folder-adding').on 'click', () ->
  $formAddFolder.addClass('hidden').trigger('reset')


removeByLinkOptions = ($link) ->
  if confirm $link.data('confirm-msg')
    path = $link.data('path')
    if path
      $.ajax
        method: 'POST'
        url: $link.attr 'href'
        data:
          path: path
        dataType: 'json'
      .done (response) ->
        if response.status == Api.serverResponse.status.DELETED
          $link.closest('.material-wrapper').remove()