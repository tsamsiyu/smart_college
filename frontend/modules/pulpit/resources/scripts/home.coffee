$ () ->
  $body = $('body')
  $feedLabel = $('a.feed-label')
  $feedColumn = $('.feed-column')
  topicTemplate = $('.topic-template').html()

  toggleFeedColumn = ($activeColumn) ->
    $feedColumn.removeClass 'active-feed-column'
    $activeColumn.addClass 'active-feed-column'

  toggleFeedLabel = ($activeLabel) ->
    $feedLabel.removeClass 'active-feed-label'
    $activeLabel.addClass 'active-feed-label'

  toggleTopicMode = ($topicWrapper) ->
    if $topicWrapper.data('mode') == 'show'
      $topicWrapper.find('.topic-edit_form').removeClass 'hidden'
      $topicWrapper.find('.topic-block').addClass 'hidden'
      $topicWrapper.data('mode', 'edit')
    else
      $topicWrapper.find('.topic-edit_form').addClass 'hidden'
      $topicWrapper.find('.topic-block').removeClass 'hidden'
      $topicWrapper.data('mode', 'show')

  topicFill = (placeholders, editUrlTemplate, rmUrlTemplate) ->
    editUrlTemplate = editUrlTemplate.replace '{topic-id}', placeholders.id
    rmUrlTemplate = rmUrlTemplate.replace '{topic-id}', placeholders.id
    topicTemplate
    .replace(/\{edit-url\}/g, editUrlTemplate)
    .replace(/\{remove-url\}/g, rmUrlTemplate)
    .replace(/\{topic-body\}/g, placeholders.body)
    .replace(/\{topic-updated\}/g, placeholders.updated)

  topicRemove = ($link) ->
    $.ajax({
      url: $link.attr 'href'
      method: 'DELETE'
      dataType: 'json'
    }).done (response) ->
      if response.status == Api.serverResponse.status.DELETED
        $link.closest('.topic-wrapper').remove()

  topicSend = ($form, callback) ->
    $body = $form.find('textarea')
    unless $body.val()
      $body.addClass 'invalid-value'
    else
      $form.ajaxForm()
      .done (response) ->
        if response.status == Api.serverResponse.status.SAVED
          $body.removeClass 'invalid-value'
          callback(response.data)
      .fail () ->
        alert('Произошла серверная ошибка, пожалуйста обратитесь к администратору, чтобы мы исправили ее')

  # # # ~ LISTENERS ~ # # #

  $feedLabel.on 'click', () ->
    $self = $(this)
    feedSelectorToShow = $self.data 'feed'
    toggleFeedColumn($(feedSelectorToShow))
    toggleFeedLabel($self)

  $('.topic_form-toggle').on 'click', (e) ->
    e.preventDefault()
    $self = $(this)
    topicFormSelector = $self.data 'topic-form'
    $topicForm = $(topicFormSelector)
    if $topicForm.hasClass 'hidden'
      $(topicFormSelector).removeClass 'hidden'
    else
      $(topicFormSelector).addClass 'hidden'

  $('.topic-form-wrapper form').on 'submit', (e) ->
    $self = $(this)
    $btn = $self.find '[type="submit"]'
    topicSend $self, (data) ->
      $self.trigger 'reset'
      editUrlTemplate = $btn.data('edit-url-template')
      rmUrlTemplate = $btn.data('remove-url-template')
      newsList = $btn.data('news-list')
      createdTopicBlock = topicFill(data, editUrlTemplate, rmUrlTemplate)
      $(newsList).prepend createdTopicBlock
    e.preventDefault()

  $body.on 'click', '.topic-edit', (e) ->
    $self = $(this)
    $topicWrapper = $self.closest('.topic-wrapper');
    toggleTopicMode($topicWrapper)
    e.preventDefault()

  $body.on 'click', '.topic-edit_form-close', (e) ->
    $self = $(this)
    $topicWrapper = $self.closest('.topic-wrapper')
    toggleTopicMode($topicWrapper)
    e.preventDefault()

  $body.on 'submit', '.topic-edit_form form', (e) ->
    $self = $(this)
    topicSend $self, (data) ->
      $topicWrapper = $self.closest '.topic-wrapper'
      $topicWrapper.find('.topic-content').text(data.body)
      $topicWrapper.find('.topic-updated-time').text(data.updated)
      toggleTopicMode $topicWrapper
    e.preventDefault()

  $body.on 'click', '.topic-remove', (e) ->
    $self = $(this)
    if confirm $self.data 'confirm-message'
      topicRemove($self)
    e.preventDefault()

  # # # ~ RUN APP ~ # # #

  if location.hash == '#private'
    $('#private-label').trigger 'click'
  else
    $('#public-label').trigger 'click'