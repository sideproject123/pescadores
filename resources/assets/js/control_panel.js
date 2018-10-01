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

  $.each(doms, (key, fn) => {
    const o = $('#' + key);

    if (o.length === 0) {
      console.error('DOM: ' + key + ' does not exist');
      return;
    }

    if (o.length > 1) {
      console.warn('DOM: ' + key + ' more than one');
    }

    if (typeof fn !== 'function') {
      console.error(key + ' function does not exist');
      return;
    }

    const obj = new fn();

    Object.getOwnPropertyNames(Object.getPrototypeOf(obj)).forEach(function (key) {
      if (key === 'constructor') {
        return;
      }
      
      const m = obj[key];

      if (typeof m === 'function') {
        obj[key] = m.bind(obj);
      }
    });

    obj.o = o;
    obj.el = o[0];
    obj.sections = [];

    o.find('[section]').each(function (i, s) {
      const sec = $(s);
      const m = obj[sec.attr('section')];

      obj.sections.push(sec);

      if (typeof m === 'function') {
        m(sec);
      }
    });

    if (typeof obj.run === 'function') {
      obj.run();
    }
  });
});
