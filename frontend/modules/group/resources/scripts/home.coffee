$ () ->
  $('#feed-headers > div').on 'click', (e) ->
    $self = $(this)
    $('.feed-header').each (k, feedHeader) ->
      $(feedHeader).removeClass 'active-feed-header'
    $('.feed').each (k, feed) ->
      $(feed).removeClass 'active-feed'

    feedSelector = $self.data('feed')
    $(feedSelector).each (k, v) ->
      $(v).addClass 'active-feed'

    $self.addClass 'active-feed-header'

  $('.show-news-form').on 'click', (e) ->
    $self = $(this)
    $self.parent().next().removeClass('hidden')

  $('.close-news-form').on 'click', (e) ->
    $self = $(this)
    $self.parent().parent().addClass 'hidden'

  $('.news-topic-edit').on 'click', (e) ->
    $self = $(this)
    $self.closest('.news-topic').addClass('hidden').next().removeClass('hidden')

  $('.news-topic-delete').on 'click', (e) ->
    unless confirm('Вы уверенны?')
      false

  $('.close-editing-topic').on 'click', (e) ->
    $self = $(this)
    $self.closest('.news-topic-form').addClass('hidden').prev().removeClass('hidden')