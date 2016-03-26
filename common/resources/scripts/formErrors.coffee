(() ->
  $.fn.formErrors = (errors, callback, formName) ->
    $self = $(this)
    name = formName || ($self.attr 'name')
    unless name
      throw Error 'Form must be contain `name` attribute'
    for key, val of errors
      el = $self.find("[name='#{name}[#{key}]']")
      if callback instanceof Function
        callback(el)
      else
        el.addClass 'invalid-value'
)()