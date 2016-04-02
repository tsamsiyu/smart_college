((window) ->
  window.Api = {}

  window.Api.serverResponse = {
    status:
      INVALIDATED: 100
      SAVED: 1
      DELETED: 3
      CREATED: 5
      NON_EXIST: 201
      NON_EXECUTION: 202
  }


)(window)