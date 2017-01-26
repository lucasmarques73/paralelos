var UOLRM = function() {
  var _private = {
    trim: function(str) {
        return str.replace(/^\s+|\s+$/g, '');
    },
    extractDomain: function(url) {
        if (url.match(/(?:https?):\/\/([^\/:\?]+).*/)) {
          return RegExp.$1;
        }
    },
    grayList: new Array (
      'cadastro.uol.com.br',
      'acesso.uol.com.br',
      'cadastro.acesso.uol.com.br',
      'pagseguro.uol.com.br',
      'todaoferta.uol.com.br',
      'todocarro.uol.com.br',
      'todoimovel.uol.com.br',
      'todoemprego.uol.com.br',
      'hospedagem.uol.com.br',
      'metadeideal.uol.com.br',
      'namoro.uol.com.br',
      'entretenimento.uol.com.br',
      'assinebandalarga.uol.com.br',
      'tim-web.assinebandalarga.uol.com.br',
      'oi-velox.assinebandalarga.uol.com.br',
      'claro-3g.assinebandalarga.uol.com.br',
      'turbonet.assinebandalarga.uol.com.br',
      'virtua.assinebandalarga.uol.com.br',
      'netsuper.assinebandalarga.uol.com.br',
      'speedy.assinebandalarga.uol.com.br'
    ),
    isGrayListed: function(url) {
        var domain = _private.extractDomain(url);
        for (var i = 0; i < _private.grayList.length; i++) {
            if (_private.grayList[i] == domain) {
                return true;
            }
        }
        return false;
    },
    referrer: document.referrer,
    lista: new Array (
      '((?:(?:www\\.)|(?:images.))google(?:.co)?m?(?:\\.[a-z][a-z])?)/.*',
      '((?:(?:www\\.))bing(?:.co)?m?(?:\\.[a-z][a-z])?)/.*q=([^&]*).*',
      '((?:mundo\\.)busca\\.uol\\.com\\.br)/.*q=([^&]*).*',
      '((?:[a-z][a-z]\\.)?(?:cade\\.)?search\\.yahoo\\.com)/.*p=([^&]*).*',
      '((?:(?:ie\\.)|(?:auto\\.))?search\\.msn\\.com(?:\\.br)?)/.*q=([^&]*).*',
      '((?:beta\\.)?search\\.live\\.com)/.*q=([^&]*).*',
      '(buscador\\.terra\\.com\\.br)/.*[Qq]uery=([^&]*).*',
      '(farejador(?:-1)?\\.ig\\.com\\.br)/.*q=([^&]*).*',
      '(busca\\.aonde\\.com)/.*keys=([^&]*).*',
      '((?:(?:www\\.)|(?:br\\.))?altavista\\.com)/.*q=([^&]*).*',
      '((?:(?:www\\.)|(?:shop\\.))?look\\.com)/.*kw=([^&]*).*',
      '(zoom\\.globo\\.com)/.*q=([^&]*).*',
      '(search\\.mywebsearch\\.com)/.*searchfor=([^&]*).*',
      '(www\\.mysearch\\.com)/.*searchfor=([^&]*).*',
      '(www\\.xbusca\\.net)/.*query=([^&]*).*',
      '(www\\.ask\\.com)/.*q=([^&]*).*',
      '((?:www\\.)?alltheweb\\.com)/.*q=([^&]*).*',
      '(busca\\.igbusca\\.com\\.br)/.*q=([^&]*).*'
    ),
    regexReferer: function() {
        var index;
        for (i = 0; i < _private.lista.length; i++) { 
            index = _private.referrer.search(_private.lista[i]);
            if (index >= 0) {
                return index;
            }
        }
    },
    doCrossDomain: function() {
        var crossdomain_url = 'https://clicklogger.rm.uol.com.br/qkw_crossdomain.html?appender=' + _public.appender + '&prd=' + _public.prd + '&grouping=' + _public.grouping + '&referrer=' + escape(this.referrer);
        document.write('<if' + 'rame src="' + crossdomain_url + '" width="10" height="10" style="display:none"></if' + 'rame>');        
    },
    doRequest: function(measure, oper) {
        var iRM = document.createElement('img');
        var src = 'https://clicklogger.rm.uol.com.br/' + _public.appender + '?prd='+ _public.prd +'&msr=' + measure + ':1&oper=' + oper;
        if (_public.grouping) {
            src+= '&grp=' + _public.grouping;
        }
        iRM.src = src;
    }, 
    doMeasure: function() {
        if (! document.domain.match(/uol\.com\.br/)) {
            _private.doCrossDomain();
        } else {
            if (document.cookie.toString().indexOf("UOL_FS") < 0) {

                try {
                    var a =  window.top.location.href;      
                } catch (err) {
                    _private.doCrossDomain();
                    return;
                }

                document.cookie = 'UOL_FS=' + escape(this.referrer) + '; path=/; domain=.uol.com.br';         
                _private.doRequest('Cliques%20de%20Origem', 7);                 

            } else {
                document.cookie = 'UOL_FS=;path=/;domain=.uol.com.br;expires=Thu, 01-Jan-1970 00:00:01 GMT';
                if(_public.grouping) {
                    _private.doRequest('Cliques%20Internos', 8);
                }             
            }
        }
        if (! document.location.hash) {
            document.location = (document.location.toString() + '#rmcl');
        }
    }
  };
  var _public = {
    appender: '',
    grouping: '',
    prd: '',
    check: function(prd) {
        this.prd = prd;

        if (document.location.hash && document.location.hash == "#rmcl") {
            return;
        }

        if(document.referrer != ""){
            if (!_private.isGrayListed(document.referrer)) {
                if(document.referrer.indexOf(document.domain) < 0) {
                    _private.doMeasure();
                    return;
                }
            }
        }

        if (_private.regexReferer()) {
            _private.doMeasure();
            return;
        }
    },
    addGrouping: function(name, value) {
        if(name == "" || value == "") return;

        name = _private.trim(name);
        value = _private.trim(value);
        
        if(name == "" || value == "") return;

        if(_public.grouping) {
            _public.grouping += ";" + escape(name) + ":" + escape(value);   
        } else {
            _public.grouping = "" + escape(name) + ":" + escape(value);
        }       
    }
  };
  return _public;
}();
