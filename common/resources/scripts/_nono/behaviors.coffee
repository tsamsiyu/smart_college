behaviorsPlugins = {
  list: []
  create: (name) ->
    behaviorsPlugins.list[name] = []
    jQuery.fn[name] = (options) ->
      behaviorsPlugins.list[name].push
        $el: $(this)
        opt: options
  trigger: (pluginName, $el, eventName, args) ->
    for k,data of behaviorsPlugins.list[pluginName]
      console.log data
      if $el[0] == data.$el[0] and data.opt and eventName in data.opt
        if data.opt[eventName] instanceof Function
          data.opt[eventName].apply($el, args)
}


window.behaviors = {
  liveLink: (selector = '.live-link', parent = 'body', abbr = 'll') ->
    behaviorsPlugins.create 'liveLink'
    $(parent).on 'click', selector, (e) ->
      e.preventDefault()
      $self = $(this)
      confirmMsg = $self.data abbr + '-confirm'
      if not confirmMsg or confirm(confirmMsg)
        requestData = {}
        for index,item of this.attributes
          if typeof item.name == 'string'
            matches = item.name.match (new RegExp('^data\-' + abbr + '\-param\-(.+)$'))
            if matches
              requestData[matches[1]] = item.value
        encodedJsonParams = $self.data(abbr + '-json-params')
        try
          decodedJsonParams = JSON.parse(encodedJsonParams)
        catch
          decodedJsonParams = {}
        requestData = $.extend(requestData, decodedJsonParams)
        promise = $.ajax
          url: $self.attr 'href'
          method: $self.data "#{abbr}-method" || 'GET'
          data: requestData
        behaviorsPlugins.trigger('liveLink', $self, 'response',  [promise])
}