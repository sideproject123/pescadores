function Ferry() {};

Ferry.prototype.destination = function (o) {
  var destEl = o.find('[name="name"]')[0];
  o.find('[data-fn="submit"]').click(function (e) {
    var name = $(destEl).val();
    name = $.trim(name);
    
    if (name.length === 0) {
      alert('empty string');
      return;
    }

    var data = {
      name,
    };

    $.post('/api/ferry', data)
      .done(function (res) {
        console.log('res ===============>', res);
      });
  });
};

Ferry.prototype.run = function () {
  console.log('sections ==========>', this.sections);
};

$(function () {
  'use strict';
  var executeFnIfExist = function (arg = {}) {
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
      obj.run();
    }
  };

  var doms = {
    Ferry,
  };

  executeFnIfExist(doms);
});

