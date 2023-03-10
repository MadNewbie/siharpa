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
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
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
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 21);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/backyard/sigarang/price/report.js":
/*!********************************************************!*\
  !*** ./resources/js/backyard/sigarang/price/report.js ***!
  \********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

document.addEventListener('DOMContentLoaded', function (event) {
  methods.initDatePicker();
  methods.initOnClickBtnPdf();
  methods.initBtnPilihSemuaListener();
  methods.initBtnHapusPilihanListener();
});
var methods = {
  initDatePicker: function initDatePicker() {
    $('.datepicker').datepicker({
      autoSize: true,
      changeMonth: true,
      changeYear: true,
      dateFormat: "dd-mm-yy"
    });
  },
  initOnClickBtnPdf: function initOnClickBtnPdf() {
    var btnPdf = document.getElementById("btnPdf");
    btnPdf.addEventListener('click', function (e) {
      methods.downloadPdf(e);
    });
  },
  initBtnPilihSemuaListener: function initBtnPilihSemuaListener() {
    var btnPilihSemua = document.getElementById("btn-pilih-semua");
    var stocks = document.getElementsByName("goods[]");
    btnPilihSemua.addEventListener('click', function (e) {
      e.preventDefault();
      stocks.forEach(function (stock) {
        stock.checked = true;
      });
    });
  },
  initBtnHapusPilihanListener: function initBtnHapusPilihanListener() {
    var btnHapusSemua = document.getElementById("btn-hapus-semua");
    var stocks = document.getElementsByName("goods[]");
    btnHapusSemua.addEventListener('click', function (e) {
      e.preventDefault();
      stocks.forEach(function (stock) {
        stock.checked = false;
      });
    });
  },
  downloadPdf: function downloadPdf() {
    var link = window['_reportFormData'].pdfLink;
    var forms = document.forms;
    var startDate, endDate, marketId, goodIds, _token;
    _token = forms[0].elements["_token"].value;
    startDate = forms[0].elements["start_date"].value;
    endDate = forms[0].elements["end_date"].value;
    marketId = forms[0].elements["market_id"].value;
    goodIds = [];
    goods = forms[0].elements["goods[]"];
    for (key = 0; key < goods.length; key++) {
      if (goods[key].checked) {
        goodIds.push(goods[key].value);
      }
    }
    fetch(link, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": _token
      },
      body: JSON.stringify({
        'start_date': startDate,
        'end_date': endDate,
        'market_id': marketId,
        'goods': goodIds
      })
    }).then(function (response) {
      return response.blob();
    }).then(function (data) {
      return window.open(URL.createObjectURL(data));
    });
  }
};

/***/ }),

/***/ 21:
/*!**************************************************************!*\
  !*** multi ./resources/js/backyard/sigarang/price/report.js ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /var/www/html/sigarang/resources/js/backyard/sigarang/price/report.js */"./resources/js/backyard/sigarang/price/report.js");


/***/ })

/******/ });