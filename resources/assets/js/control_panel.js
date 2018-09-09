function Ferry() {};
/*
Ferry.prototype.run = function() {
  console.log('sections ==========>', this.sections);
};
*/

$(function () {
  'use strict';
  var executeFnIfExist = function(arg = {}) {
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

      var obj = this;
      
      console.log('obj =================>', obj);
      // fn(o);
    }
  };

  var doms = {
    Ferry,
  };

  executeFnIfExist(doms);
});

