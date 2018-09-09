/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 5);
/******/ })
/************************************************************************/
/******/ ({

/***/ 5:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(6);


/***/ }),

/***/ 6:
/***/ (function(module, __webpack_exports__) {

"use strict";
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
      name: name
    };

    $.post('/api/ferry', data).done(function (res) {
      console.log('res ===============>', res);
    });
  });
};

Ferry.prototype.run = function () {
  console.log('sections ==========>', this.sections);
};

$(function () {
  'use strict';

  var executeFnIfExist = function executeFnIfExist() {
    var arg = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

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

      var obj = new fn();
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
    Ferry: Ferry
  };

  executeFnIfExist(doms);
});

/***/ })

/******/ });