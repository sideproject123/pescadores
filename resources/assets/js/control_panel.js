'use strict';
require('./bootstrap');
const Cruise = require('./control_panel/Cruise');

const doms = {
  Cruise,
};


$(function () {
  require('jquery-ui/ui/i18n/datepicker-zh-TW');

  const {
    datatables,
  } = require('./global');

  $.extend(true, $.fn.DataTable.defaults, datatables.defaults);
  $.datepicker.setDefaults({
    minDate: new Date(),
  });

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

      const obj = new fn;

      Object.getOwnPropertyNames(Object.getPrototypeOf(obj)).forEach(function (key) {
        if (key === 'constructor') {
          return;
        }
        
        obj[key] = obj[key].bind(obj);
      });

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
