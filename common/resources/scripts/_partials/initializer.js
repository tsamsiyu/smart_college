(function () {
    window.initializer = {
        csrf: function () {
            var value = '{{app.request.csrfToken}}';

            return {
                ajaxSetup: function () {
                    var completeCallables = [];

                    $.ajaxSetup({
                        addCallableComplete: function (f) {
                            if (f instanceof Function) {
                                completeCallables.push(f);
                            }
                        },
                        addHeader: function (key, value) {
                            $.ajax.headers[key] = value;
                        },
                        //cache: false,
                        complete: function (jqXHR, textStatus) {
                            var responseCsrf = jqXHR.getResponseHeader(this.getHeaderName());

                            if (responseCsrf) {
                                value = responseCsrf;
                                $.ajax.addHeader(this.getHeaderName(), this.getValue());
                            }

                            for (var i = 0; i < completeCallables.length; i++) {
                                completeCallables[i].call(null, jqXHR, textStatus);
                            }
                        }
                    });
                },
                getParamName: function () {
                    return '{{app.request.csrfParam}}';
                },
                getHeaderName: function () {
                    return '{{app.request.csrfHeader}}';
                },
                getValue: function () {
                    return value;
                },
                addHeader: function (headers) {
                    headers = headers || [];
                    headers[this.getHeaderName()] = this.getValue();
                    return headers;
                },
                addParam: function (params) {
                    params = params || [];
                    params[this.getParamName()] = this.getValue();
                    return params;
                }
            }
        }
    }
})();