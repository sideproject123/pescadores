'use strict';
require('./bootstrap');
const { datatables } = require('./global');

var doms = {
  Cruise: require('./control_panel/Cruise')
};

$(function () {

  $.extend(true, $.fn.DataTable.defaults, datatables.defaults);

  const executeFnIfExist = function (arg = {}) {
    for (var key in arg) {
      var o = $('#' + key);
      var fn = arg[key];

      if (o.length === 0) {
        console.error('DOM: ' + key + ' does not exist');
        return;
      }

      if (typeof fn !== 'function') {
        console.error(key + ' function does not exist');
        return;
      }

      if (o.length > 1) {
        console.warn('DOM: ' + key + ' more than one');
      }

      var obj = new fn;
      obj.o = o;
      obj.el = o[0];
      obj.sections = o.find('[section]');
      obj.sections.each(function (i, sec) {
        var m = obj[$(sec).attr('section')];

        if (typeof m === 'function') {
          m($(sec));
        }
      });

      if (typeof obj.run === 'function') {
        obj.run();
      }
    }
  };

  executeFnIfExist(doms);
});
