jQuery.fn.storageWidget = (options) ->
  $widget = $(this)
  folderWrapperHtml = $widget.find('.folder-pattern').html()
  storageLevelHtml = $('.storage-pattern').html()

  baseEventsBehavior =
    onFolderCreate: (e, $form, folder) ->
      console.log 'apply folder'
      console.log $form
    onFolderCancel: (e, $folderWrapper) ->
      $folderWrapper.remove()
    onFolderRemove: (e, $folderWrapper, folder) ->
      $folderWrapper.remove()

  options = $.extend({
    onFolderCreate: (base, e, $form) ->
      base(e, $form)
    onFolderCancel: (base, e, $folderWrapper) ->
      base(e, $folderWrapper)
    onFolderRemove: (base, e, $folderWrapper, folder) ->
      base(e, $folderWrapper, folder)
  }, options)

  publicApi =
    applyFolder: ($form) ->
      $wrapper = $form.closest('.folder-wrapper')
      $createdBlock = $wrapper.find('.created-folder')
      $editingBlock = $wrapper.find('.editing-folder')
      $editingBlock.addClass('hidden')
      $createdBlock.removeClass('hidden')
      $createdBlock.find('.folder-link').text($editingBlock.find('input').val())
    prevFolder: () ->
      $folderLevel = $widget.find('.current-folder-level')
    addFolder: () ->
      $folderLevel = $widget.find('.current-folder-level')
      $folderLevel.append(folderWrapperHtml)
    getLastStorageLevel: () ->
      levels = []
      $('[data-storage-level]').each (k, v) ->
        levels.push $(v).data('storage-level')
      Math.max.apply(null, levels)
    createStorageLevel: (level, folder) ->
      $block = $(storageLevelHtml)
      $block.data('folder-level', folder)
      $block.data('storage-level', level)
      $widget.last('.storage-list').append($block)
      $block

  events =
    onFolderCreate: (base, e, $form, folder) ->
      options.onFolderCreate(base, e, $form, folder)
    onFolderCancel: (base, e, $folderWrapper) ->
      options.onFolderCancel(e, $folderWrapper)
    onFolderRemove: (base, e, $folderWrapper, folder) ->
      options.onFolderRemove(base, e, $folderWrapper, folder)


  ### EVENTS ###
  $widget.on 'submit', '.folder-form', (e) ->
    $self = $(this)
    folder = $self.closest('.storage-list').data('folder-level')
    events.onFolderCreate(baseEventsBehavior.onFolderCreate, e, $self, folder)

  $widget.on 'click', '.editing-folder .folder-cancel', (e) ->
    events.onFolderCancel(baseEventsBehavior.onFolderCancel, e, $(this).closest('.folder-wrapper'))

  $widget.on 'click', '.created-folder .folder-remove', (e) ->
    $self = $(this)
    $folderWrapper = $self.closest('.folder-wrapper')
    $storageList = $self.closest('.storage-list')
    folder = $storageList.data('folder-level') + '/' + $folderWrapper.data('folder-name')
    events.onFolderRemove(baseEventsBehavior.onFolderRemove, e, $folderWrapper, folder)

  $widget.on 'click', '.folder-link', () ->
    $self = $(this)
    $currentStorageLevelWrapper = $self.closest('.storage-list')
    lastStorageLevel = publicApi.getLastStorageLevel()
    folderStorageLevel = $currentStorageLevelWrapper.data('storage-level')
    folderStorageName = $currentStorageLevelWrapper.data('folder-level')
    if lastStorageLevel == folderStorageLevel
      $storageLevel = publicApi.createStorageLevel(lastStorageLevel + 1, folderStorageName + '/' + $self.text())
    else
      $storageLevel = $widget.find(".storage-level[data-storage-level='#{folderStorageLevel + 1}']")

    console.log $storageLevel

    $widget.find('.current-folder-level').addClass('hidden').removeClass('current-folder-level')
    $storageLevel.removeClass('hidden').addClass('current-folder-level')

  return publicApi