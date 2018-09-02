function Header(o) {
  console.log('o ==================>', o);
};

$(function () {
  'use strict';
  var executeFnIfExist = function(arg = {}) {
    for (var key in arg) {
      var o = $('#' + key);
      var fn = arg[key];

      if (o.length === 0) {
        console.error('DOM: ' + key + ' does not exist');
      }

      if (o.length > 1) {
        console.warn('DOM: ' + key + ' more than one');
      }

      if (typeof fn !== 'function') {
        console.error(key + ' function does not exist');
      }

      fn(o);
    }
  };

  var doms = {
    header: Header
  };

  executeFnIfExist(doms);
});
