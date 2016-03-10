$ () ->
  $newsForm = $('#news-form')

  $('#add-news').on 'click', (e) ->
    $newsForm.removeClass 'hide'

  $('#hide-news-form > a').on 'click', (e) ->
    $newsForm.addClass 'hide'
