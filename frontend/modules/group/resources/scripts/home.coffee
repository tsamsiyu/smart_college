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

