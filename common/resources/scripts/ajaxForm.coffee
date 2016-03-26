(() ->
  $.fn.ajaxForm = (options) ->
    $self = $(this)
    $.ajax
      url: $self.attr 'action'
      data: $self.serialize()
      method: ($self.attr 'method') || 'GET'
      dataType: ($self.attr 'dataType') || 'json'
)()