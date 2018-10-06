'use strict';
require('./bootstrap');
require('datatables.net');
require('jquery-ui/ui/widgets/datepicker');
require('jquery-timepicker/jquery.timepicker');

const doms = ['cruise', 'order'];

$(function () {
  require('jquery-ui/ui/i18n/datepicker-zh-TW');

  const {
    datatables,
  } = require('./global');

  $.extend(true, $.fn.DataTable.defaults, datatables.defaults);

  $.datepicker.setDefaults({
    minDate: new Date(),
  });

  $.each(doms, (i, key) => {
    const o = $('#' + key);

    if (o.length === 0) {
      return;
    }

    if (o.length > 1) {
      console.warn('DOM: ' + key + ' more than one');
    }

    const k = key.substr(0, 1).toUpperCase() + key.substr(1);
    let fn;

    try {
      fn = require(`./control_panel/${k}`);
    } catch (err) {
      console.error(`Class "${k}" does not exist`);
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
