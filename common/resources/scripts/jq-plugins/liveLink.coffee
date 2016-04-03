jQuery.fn.liveLink = (options) ->
  options = $.extend({
    onResponse: (promise) ->

  }, options)

  $self = $(this)
