jQuery.fn.storageWidget = () ->
  $self = $(this)
  folderWrapperHtml = $self.find('.folder-pattern').html()

  publicApi =
    addFolder: () ->
      $folderLevel = $self.find('.current-folder-level')
      $folderLevel.last('.storage-level-item').append(folderWrapperHtml)
    onFolderApply: (e, $form) ->
      console.log $form
    onFolderCancel: (e, $folderWrapper) ->
      console.log $folderWrapper
    onFolderRemove: (e, $folderWrapper, folder) ->
      console.log folder
      console.log $folderWrapper


  ### EVENTS ###
  $self.on 'submit', '.folder-form', (e) ->
    publicApi.onFolderApply e, $(this)
    e.preventDefault()

  $self.on 'click', '.editing-folder .folder-cancel', (e) ->
    publicApi.onFolderCancel(e, $(this).closest('.folder-wrapper'))

  $self.on 'click', '.created-folder .folder-remove', (e) ->
    $self = $(this)
    $folderWrapper = $self.closest('.folder-wrapper')
    $storageList = $self.closest('.storage-list')
    folder = $storageList.data('folder-level') + '/' + $folderWrapper.data('folder-name')
    publicApi.onFolderRemove(e, $folderWrapper, folder)


  return publicApi