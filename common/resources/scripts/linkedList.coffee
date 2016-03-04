$(() ->
  # data attributes
  LINK_ATTRIBUTE = 'linked-list'
  URI_ATTRIBUTE = 'items-url'
  REQUEST_KEY_ATTRIBUTE = 'passed-key'
  RESPONSE_KEY_ATTRIBUTE = 'produced-key'
  REQUEST_DATA_ATTRIBUTE = 'request-data'
  PROMPT_ATTRIBUTE = 'prompt';

  # default values
  listeningSelectIds = [];
  requestKey = 'id'
  responseKey = null
  prompt = true


  getDataToRequest = (data, $select) ->
    res = $select.data(REQUEST_DATA_ATTRIBUTE);
    unless res instanceof Object
      res = {}
    selectRequestKey = $select.data(REQUEST_KEY_ATTRIBUTE)
    key = selectRequestKey || requestKey
    res[key] = data
    res

  getDataFromResponse = (data, $select) ->
    if data instanceof String
      try
        data = JSON.parse data
      catch e
        console.error 'Invalid response'
        return
    selectResponseKey = $select.data(RESPONSE_KEY_ATTRIBUTE)
    key = selectResponseKey || responseKey
    if key is not null
      data = data[key]
    data

  fillOptions = ($select, items) ->
    $select.html ''

    if typeof items is "string"
      try
        items = JSON.parse items
      catch e
        items = []

    if $select.data(PROMPT_ATTRIBUTE) != null
      isPrompt = $select.data(PROMPT_ATTRIBUTE)
    else
      isPrompt = prompt

    empty = true
    for i, v of items
      empty = false
      $select.append "<option value='#{i}'>#{v}</option>"

    unless empty
      if isPrompt
        $select.prepend "<option></option>"
      $select.attr 'disabled', null
    else
      $select.attr 'disabled', 'disabled'

    $select.trigger 'change'


  $("select[data-#{LINK_ATTRIBUTE}]").each (k, v) ->
    $v = $(v);
    id = $v.data LINK_ATTRIBUTE
    unless id of listeningSelectIds
      listeningSelectIds[id] = []
    listeningSelectIds[id].push $v

  for id of listeningSelectIds
    console.log(id);
    $('#' + id).on 'change', (e) ->
      $changeable = $(this)
      console.log('was changed: ' + $changeable.attr('id'));
      for k, $select of listeningSelectIds[$changeable.attr 'id']
        url = $select.data(URI_ATTRIBUTE)
        $.ajax
          'url': url
          'method': 'GET'
          'data': getDataToRequest($changeable.val(), $select)
        .then (response) ->
          items = getDataFromResponse(response, $select)
          fillOptions $select, items
        .fail (response) ->
          console.error(response);

#  for id of listeningSelectIds
#    $('#' + id).trigger 'change'

);