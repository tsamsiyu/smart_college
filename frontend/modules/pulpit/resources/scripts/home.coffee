$ () ->
  $('.select-feed-label > a').on 'click', () ->
    $self = $(this)
    feedToShow = $self.data 'feed'

    $('.feed-column').removeClass 'active-feed-column'
    $(feedToShow).addClass 'active-feed-column'

    $('.select-feed-label > a').removeClass 'active-feed-label'
    $self.addClass 'active-feed-label'

  $('.show-news-form').on 'click', () ->
    $self = $(this)
    newsFormSelector = $self.data 'news-form'
    $(newsFormSelector).removeClass 'hidden'

  $('.close-news-form').on 'click', () ->
    $(this).closest('.news-form').addClass 'hidden'

  $('.news-form form').on 'submit', (e) ->
    $self = $(this)
    $self.ajaxForm()
    .done (response) ->
      if response.status == 1
        $self.trigger 'reset'
        $self.find('.invalid-value').removeClass 'invalid-value'
        $('#modalAddTopic').modal()
      else if response.status == 100
        $self.formErrors response.data.errors
    e.preventDefault()