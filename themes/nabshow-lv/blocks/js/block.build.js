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
/******/ 	return __webpack_require__(__webpack_require__.s = 46);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports) {

/**
 * Checks if `value` is classified as an `Array` object.
 *
 * @static
 * @memberOf _
 * @since 0.1.0
 * @category Lang
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is an array, else `false`.
 * @example
 *
 * _.isArray([1, 2, 3]);
 * // => true
 *
 * _.isArray(document.body.children);
 * // => false
 *
 * _.isArray('abc');
 * // => false
 *
 * _.isArray(_.noop);
 * // => false
 */
var isArray = Array.isArray;

module.exports = isArray;


/***/ }),
/* 1 */
/***/ (function(module, exports, __webpack_require__) {

var freeGlobal = __webpack_require__(30);

/** Detect free variable `self`. */
var freeSelf = typeof self == 'object' && self && self.Object === Object && self;

/** Used as a reference to the global object. */
var root = freeGlobal || freeSelf || Function('return this')();

module.exports = root;


/***/ }),
/* 2 */
/***/ (function(module, exports, __webpack_require__) {

var baseIsNative = __webpack_require__(60),
    getValue = __webpack_require__(63);

/**
 * Gets the native function at `key` of `object`.
 *
 * @private
 * @param {Object} object The object to query.
 * @param {string} key The key of the method to get.
 * @returns {*} Returns the function if it's native, else `undefined`.
 */
function getNative(object, key) {
  var value = getValue(object, key);
  return baseIsNative(value) ? value : undefined;
}

module.exports = getNative;


/***/ }),
/* 3 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "j", function() { return quotesSliderBottom; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "k", function() { return quotesSliderSide; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return arrowBtn; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "f", function() { return btnWhite; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "e", function() { return btnPrimary; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "c", function() { return btnDefault; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "b", function() { return btnAlt; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "d", function() { return btnLight; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "g", function() { return latestShowNews1; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "h", function() { return latestShowNews2; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "i", function() { return latestShowNews3; });
/* unused harmony export sessionSliderOff1 */
/* unused harmony export sessionSliderOff2 */
/* unused harmony export sessionSliderOn1 */
/* unused harmony export sessionSliderOn2 */
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "l", function() { return sliderArrow1; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "m", function() { return sliderArrow2; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "n", function() { return sliderArrow3; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "o", function() { return sliderArrow4; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "p", function() { return sliderArrow5; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "q", function() { return sliderArrow6; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "r", function() { return sliderArrow7; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "s", function() { return sliderArrow8; });
/* unused harmony export destinations */
/* unused harmony export keyContacts */
/* unused harmony export featuredHappening */
/* unused harmony export productCategories */
/* unused harmony export exhibitorResources */
/* unused harmony export browseHappening */
/* unused harmony export exhibitorAccordion */
/* unused harmony export exhibitorImageListing */
/* unused harmony export relatedContentTitleList */
/* unused harmony export relatedContSideImgInfo */
/* unused harmony export realtedContentCoLocatedEvents */
/* unused harmony export realtedContentInfoOnly */
/* unused harmony export realtedContentPlanShow */
/* unused harmony export relatedContentDropdown */
var quotesSliderBottom = wp.element.createElement(
  "svg",
  { version: "1.1", id: "quotesSliderBottom", x: "0px", y: "0px", width: "446px", height: "303.999px", viewBox: "0 0 446 303.999", enableBackground: "new 0 0 446 303.999" },
  wp.element.createElement("rect", { fill: "#FFFFFF", width: "446", height: "303.999" }),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("rect", { x: "52.642", y: "35.845", fill: "#7B8080", width: "115", height: "24" }),
    wp.element.createElement("rect", { x: "52.642", y: "86.519", fill: "#7B8080", width: "302", height: "11.331" }),
    wp.element.createElement("rect", { x: "52.642", y: "115.184", fill: "#7B8080", width: "342", height: "12" }),
    wp.element.createElement("rect", { x: "52.642", y: "144.184", fill: "#7B8080", width: "189", height: "12.666" }),
    wp.element.createElement("rect", { x: "52.475", y: "195.117", fill: "#7B8080", width: "60", height: "9.666" }),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("path", { fill: "#7B8080", d: "M118.809,260.039c0.406,0.406,1.065,0.406,1.471,0l6.46-6.46c0.203-0.203,0.305-0.471,0.305-0.735\r c0-0.266-0.102-0.533-0.305-0.735l-6.46-6.462c-0.405-0.404-1.062-0.405-1.468-0.003c-0.407,0.403-0.411,1.053-0.01,1.46\r l4.616,4.687h-21.904c-0.575,0-1.04,0.478-1.04,1.052s0.465,1.052,1.04,1.052h21.983l-4.688,4.682\r C118.404,258.982,118.404,259.633,118.809,260.039z" }),
      wp.element.createElement("path", { fill: "#7B8080", d: "M105.888,248.139c-0.176,0.548,0.125,1.133,0.671,1.308c0.547,0.176,1.133-0.126,1.307-0.673\r c1.766-5.502,6.837-9.199,12.621-9.199c7.307,0,13.251,5.943,13.251,13.252c0,7.305-5.944,13.248-13.251,13.248\r c-5.784,0-10.855-3.695-12.621-9.198c-0.174-0.546-0.76-0.847-1.307-0.673c-0.546,0.176-0.847,0.763-0.671,1.308\r c2.042,6.366,7.908,10.644,14.6,10.644c8.454,0,15.33-6.877,15.33-15.328c0-8.455-6.876-15.331-15.33-15.331\r C113.796,237.495,107.929,241.772,105.888,248.139z" })
    ),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("path", { fill: "#7B8080", d: "M68.367,245.61c-0.406-0.406-1.065-0.406-1.471,0l-6.46,6.461c-0.203,0.203-0.305,0.47-0.305,0.735\r s0.102,0.532,0.305,0.735l6.46,6.46c0.405,0.404,1.062,0.406,1.468,0.004c0.407-0.402,0.411-1.052,0.01-1.459l-4.616-4.687h21.904\r c0.575,0,1.04-0.479,1.04-1.053s-0.465-1.052-1.04-1.052H63.679l4.688-4.682C68.772,246.667,68.772,246.016,68.367,245.61z" }),
      wp.element.createElement("path", { fill: "#7B8080", d: "M81.288,257.511c0.176-0.548-0.125-1.133-0.671-1.307c-0.547-0.176-1.133,0.125-1.307,0.672\r c-1.766,5.503-6.837,9.198-12.621,9.198c-7.307,0-13.251-5.941-13.251-13.25c0-7.307,5.944-13.25,13.251-13.25\r c5.784,0,10.855,3.695,12.621,9.199c0.174,0.546,0.76,0.847,1.307,0.673c0.546-0.176,0.847-0.763,0.671-1.308\r c-2.042-6.366-7.908-10.644-14.6-10.644c-8.454,0-15.33,6.876-15.33,15.329s6.876,15.33,15.33,15.33\r C73.38,268.154,79.247,263.877,81.288,257.511z" })
    ),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("path", { fill: "#7B8080", d: "M120.334,200.643h12.939l-3.087,3.088c-0.271,0.27-0.271,0.709,0,0.979c0.27,0.271,0.709,0.271,0.979,0\r l4.27-4.27c0.271-0.271,0.271-0.709,0-0.979l-4.27-4.271c-0.135-0.136-0.313-0.203-0.489-0.203c-0.178,0-0.354,0.067-0.489,0.203\r c-0.271,0.271-0.271,0.709,0,0.979l3.087,3.088h-12.939c-0.382,0-0.692,0.31-0.692,0.691\r C119.642,200.332,119.951,200.643,120.334,200.643z" })
    )
  )
);

var quotesSliderSide = wp.element.createElement(
  "svg",
  { version: "1.1", id: "quotesSliderSide", x: "0px", y: "0px", width: "446px", height: "303.998px", viewBox: "0 0 446 303.998", enableBackground: "new 0 0 446 303.998" },
  wp.element.createElement("rect", { fill: "#FFFFFF", width: "446", height: "303.998" }),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("rect", { x: "66.935", y: "29.213", fill: "#7B8080", width: "101.867", height: "29.43" }),
    wp.element.createElement("rect", { x: "66.935", y: "91.352", fill: "#7B8080", width: "267.509", height: "13.897" }),
    wp.element.createElement("rect", { x: "66.935", y: "126.504", fill: "#7B8080", width: "302.941", height: "14.714" }),
    wp.element.createElement("rect", { x: "66.935", y: "162.064", fill: "#7B8080", width: "167.416", height: "15.532" }),
    wp.element.createElement("rect", { x: "66.788", y: "224.521", fill: "#7B8080", width: "53.148", height: "11.854" }),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("path", { fill: "#7B8080", d: "M425.256,135.732c0.48,0.48,1.261,0.48,1.742,0l7.653-7.654c0.24-0.241,0.361-0.556,0.361-0.871\r c0-0.314-0.121-0.631-0.361-0.871l-7.653-7.655c-0.48-0.479-1.258-0.48-1.738-0.004c-0.482,0.478-0.487,1.247-0.012,1.73\r l5.468,5.552h-25.948c-0.681,0-1.232,0.566-1.232,1.246s0.551,1.247,1.232,1.247h26.041l-5.553,5.544\r C424.775,134.479,424.775,135.251,425.256,135.732z" }),
      wp.element.createElement("path", { fill: "#7B8080", d: "M409.948,121.634c-0.208,0.649,0.149,1.341,0.796,1.549c0.648,0.208,1.342-0.148,1.549-0.796\r c2.091-6.519,8.099-10.898,14.95-10.898c8.656,0,15.697,7.041,15.697,15.698c0,8.654-7.041,15.695-15.697,15.695\r c-6.852,0-12.859-4.378-14.95-10.897c-0.207-0.646-0.9-1.003-1.549-0.797c-0.646,0.208-1.004,0.904-0.796,1.548\r c2.419,7.542,9.369,12.609,17.295,12.609c10.014,0,18.16-8.146,18.16-18.159c0-10.015-8.146-18.161-18.16-18.161\r C419.317,109.026,412.367,114.093,409.948,121.634z" })
    ),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("path", { fill: "#7B8080", d: "M21.121,118.639c-0.481-0.481-1.261-0.481-1.743,0l-7.653,7.654c-0.241,0.24-0.361,0.556-0.361,0.871\r s0.121,0.631,0.361,0.871l7.653,7.655c0.481,0.479,1.258,0.48,1.738,0.003c0.483-0.479,0.487-1.246,0.012-1.729l-5.468-5.551\r h25.948c0.681,0,1.232-0.566,1.232-1.248c0-0.679-0.552-1.246-1.232-1.246H15.568l5.553-5.546\r C21.601,119.891,21.601,119.119,21.121,118.639z" }),
      wp.element.createElement("path", { fill: "#7B8080", d: "M36.428,132.736c0.208-0.649-0.148-1.341-0.795-1.548c-0.649-0.208-1.341,0.148-1.548,0.796\r c-2.092,6.519-8.1,10.897-14.951,10.897c-8.656,0-15.697-7.041-15.697-15.697c0-8.654,7.041-15.696,15.697-15.696\r c6.852,0,12.859,4.379,14.951,10.898c0.207,0.646,0.899,1.002,1.548,0.797c0.647-0.208,1.004-0.904,0.795-1.549\r c-2.418-7.542-9.368-12.608-17.294-12.608c-10.014,0-18.16,8.146-18.16,18.159c0,10.015,8.146,18.161,18.16,18.161\r C27.06,145.345,34.009,140.277,36.428,132.736z" })
    ),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("path", { fill: "#7B8080", d: "M126.898,231.298h11.462l-2.734,3.786c-0.24,0.331-0.24,0.869,0,1.199c0.238,0.334,0.628,0.334,0.867,0\r l3.782-5.235c0.239-0.33,0.239-0.869,0-1.199l-3.782-5.235c-0.12-0.168-0.278-0.249-0.434-0.249c-0.158,0-0.314,0.081-0.433,0.249\r c-0.24,0.33-0.24,0.869,0,1.2l2.734,3.786h-11.462c-0.338,0-0.613,0.381-0.613,0.848\r C126.286,230.917,126.56,231.298,126.898,231.298z" })
    )
  )
);

var arrowBtn = wp.element.createElement(
  "svg",
  { version: "1.1", id: "Layer_1", x: "0px", y: "0px", width: "105px", height: "41.001px", viewBox: "0 0 83.461 13.044", "enable-background": "new 0 0 83.461 13.044" },
  wp.element.createElement(
    "text",
    { transform: "matrix(1 0 0 1 0 10.0439)", "font-family": "'MyriadPro-Regular'", "font-size": "9.8" },
    "Learn More"
  ),
  wp.element.createElement("path", { fill: "#010101", d: "M74.386,1.857l0.782-0.446c0.332-0.189,0.867-0.189,1.195,0l6.851,3.904c0.331,0.189,0.331,0.494,0,0.681\r l-6.851,3.906c-0.332,0.189-0.867,0.189-1.195,0l-0.782-0.446c-0.335-0.191-0.328-0.502,0.014-0.689l4.246-2.307H68.519\r c-0.469,0-0.846-0.215-0.846-0.482V5.335c0-0.267,0.377-0.482,0.846-0.482h10.127L74.4,2.546\r C74.055,2.359,74.047,2.048,74.386,1.857z" })
);

var btnWhite = wp.element.createElement(
  "svg",
  { version: "1.1", id: "Layer_1", xmlns: "http://www.w3.org/2000/svg", x: "0px", y: "0px",
    width: "105px", height: "41.001px", viewBox: "0 0 106 41", "enable-background": "new 0 0 106 41" },
  wp.element.createElement("rect", { x: "0.5", y: "0.5", fill: "#FFFFFF", stroke: "#d9d9d9", "stroke-miterlimit": "10", width: "105", height: "40" }),
  wp.element.createElement(
    "text",
    { transform: "matrix(1 0 0 1 22.5 24.8335)", "font-family": "'MyriadPro-Regular'", "font-size": "10" },
    "Learn More"
  )
);

var btnPrimary = wp.element.createElement(
  "svg",
  { version: "1.1", id: "btnPrimary", x: "0px", y: "0px", width: "103px", height: "41.001px", viewBox: "0 0 100 41.001", enableBackground: "0 0 100 41.001" },
  wp.element.createElement("rect", { fill: "#00B5E0", width: "100", height: "41.001" }),
  wp.element.createElement(
    "text",
    { transform: "matrix(1 0 0 1 13.7622 25.3164)", fill: "#FFFFFF", "font-family": "'MyanmarText-Bold'", "font-size": "12" },
    "Learn More"
  )
);

var btnDefault = wp.element.createElement(
  "svg",
  { version: "1.1", id: "btnDefault", x: "0px", y: "0px", width: "103px", height: "41.001px", viewBox: "0 0 100 41.001", enableBackground: "new 0 0 100 41.001" },
  wp.element.createElement("rect", { fill: "#9A9A99", width: "100", height: "41.001" }),
  wp.element.createElement(
    "text",
    { transform: "matrix(1 0 0 1 13.7622 25.3164)", fill: "#FFFFFF", "font-family": "'MyanmarText-Bold'", "font-size": "12" },
    "Learn More"
  )
);

var btnAlt = wp.element.createElement(
  "svg",
  { version: "1.1", id: "btnAlt", x: "0px", y: "0px", width: "103px", height: "41.001px", viewBox: "0 0 100 41.001", enableBackground: "new 0 0 100 41.001" },
  wp.element.createElement("rect", { fill: "#8AC0E2", width: "103", height: "41.001" }),
  wp.element.createElement(
    "text",
    { transform: "matrix(1 0 0 1 13.7622 25.3164)", fill: "#363636", "font-family": "'MyanmarText-Bold'", "font-size": "12" },
    "Learn More"
  )
);

var btnLight = wp.element.createElement(
  "svg",
  { version: "1.1", id: "btnLight", x: "0px", y: "0px", width: "103px", height: "41.001px", viewBox: "0 0 100 41.001", enableBackground: "new 0 0 100 41.001" },
  wp.element.createElement("rect", { fill: "#F1F8FD", width: "100", height: "41.001" }),
  wp.element.createElement(
    "text",
    { transform: "matrix(1 0 0 1 13.7622 25.3164)", fill: "#363636", "font-family": "'MyanmarText-Bold'", "font-size": "12" },
    "Learn More"
  )
);

var latestShowNews1 = wp.element.createElement(
  "svg",
  { version: "1.1", id: "Layer_1", x: "0px", y: "0px", width: "503px", height: "203px", viewBox: "0 0 503 203", "enable-background": "new 0 0 503 203" },
  wp.element.createElement("rect", { x: "1.5", y: "1.5", fill: "#FFFFFF", stroke: "#7B8080", "stroke-width": "3", "stroke-miterlimit": "10", width: "500", height: "200" }),
  wp.element.createElement("rect", { x: "34.509", y: "62.925", fill: "#7B8080", width: "54.924", height: "9.828" }),
  wp.element.createElement("rect", { x: "34.509", y: "36.144", fill: "#7B8080", width: "370.13", height: "13.022" }),
  wp.element.createElement("rect", { x: "34.509", y: "89.707", fill: "#7B8080", width: "398.269", height: "7.617" }),
  wp.element.createElement("rect", { x: "34.509", y: "109.362", fill: "#7B8080", width: "398.269", height: "7.617" }),
  wp.element.createElement("rect", { x: "34.509", y: "129.51", fill: "#7B8080", width: "398.269", height: "7.617" }),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("rect", { x: "34.509", y: "156.779", fill: "#7B8080", width: "105.7", height: "9.173" }),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("path", { fill: "#7B8080", d: "M158.397,161.744h16.783l-4.005,3.035c-0.349,0.267-0.349,0.697,0,0.963c0.351,0.266,0.922,0.266,1.273,0\r l5.535-4.198c0.351-0.266,0.351-0.696,0-0.962l-5.535-4.198c-0.176-0.135-0.406-0.198-0.636-0.198\r c-0.231,0-0.461,0.063-0.637,0.198c-0.349,0.268-0.349,0.698,0,0.963l4.005,3.035h-16.783c-0.497,0-0.898,0.307-0.898,0.678\r C157.499,161.439,157.9,161.744,158.397,161.744z" })
    )
  )
);

var latestShowNews2 = wp.element.createElement(
  "svg",
  { version: "1.1", id: "Layer_1", x: "0px", y: "0px", width: "501.655px", height: "203px", viewBox: "0 0 501.655 203", "enable-background": "new 0 0 501.655 203" },
  wp.element.createElement("rect", { x: "1.5", y: "1.5", fill: "#FFFFFF", stroke: "#7B8080", "stroke-width": "3", "stroke-miterlimit": "10", width: "498.655", height: "200" }),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("rect", { x: "16.601", y: "174.162", fill: "#7B8080", width: "147.136", height: "8.743" }),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("path", { fill: "#7B8080", d: "M189.056,178.894h23.362l-5.576,2.893c-0.485,0.254-0.485,0.664,0,0.917c0.488,0.253,1.284,0.253,1.772,0\r l7.705-4c0.488-0.254,0.488-0.664,0-0.917l-7.705-4c-0.244-0.13-0.565-0.19-0.886-0.19c-0.321,0-0.642,0.061-0.886,0.19\r c-0.485,0.253-0.485,0.664,0,0.917l5.576,2.893h-23.362c-0.691,0-1.25,0.292-1.25,0.646\r C187.806,178.603,188.365,178.894,189.056,178.894z" })
    )
  ),
  wp.element.createElement("rect", { x: "1.078", y: "3.064", fill: "#7B8080", width: "498.656", height: "88.735" }),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("path", { fill: "#FFFFFF", d: "M274.806,32.021h-48.801c-0.481,0-0.871,0.299-0.871,0.67v29.482c0,0.371,0.39,0.67,0.871,0.67h48.801\r c0.48,0,0.871-0.299,0.871-0.67V32.69C275.676,32.321,275.287,32.021,274.806,32.021z M273.934,61.503h-47.057V33.361h47.057\r V61.503L273.934,61.503z" }),
    wp.element.createElement("path", { fill: "#FFFFFF", d: "M239.078,46.854c2.676,0,4.853-1.674,4.853-3.731c0-2.058-2.177-3.731-4.853-3.731\r c-2.677,0-4.854,1.673-4.854,3.731C234.224,45.18,236.401,46.854,239.078,46.854z M239.078,40.73c1.714,0,3.109,1.074,3.109,2.393\r c0,1.318-1.395,2.391-3.109,2.391c-1.716,0-3.11-1.073-3.11-2.391C235.967,41.807,237.362,40.73,239.078,40.73z" }),
    wp.element.createElement("path", { fill: "#FFFFFF", d: "M231.234,58.823c0.204,0,0.41-0.055,0.575-0.167l14.215-9.623l8.978,6.902c0.341,0.262,0.892,0.262,1.232,0\r c0.34-0.262,0.34-0.685,0-0.947l-4.188-3.222l8-6.737l9.813,6.917c0.356,0.25,0.906,0.23,1.231-0.041\r c0.326-0.274,0.301-0.697-0.054-0.947l-10.457-7.371c-0.172-0.12-0.398-0.179-0.629-0.175c-0.23,0.008-0.447,0.086-0.604,0.218\r l-8.534,7.188l-4.134-3.178c-0.326-0.25-0.847-0.262-1.191-0.03l-14.83,10.04c-0.362,0.246-0.397,0.668-0.079,0.946\r C230.752,58.746,230.993,58.823,231.234,58.823z" })
  ),
  wp.element.createElement("rect", { x: "16.601", y: "102.762", fill: "#7B8080", width: "469", height: "8.249" }),
  wp.element.createElement("rect", { x: "15.601", y: "130.762", fill: "#7B8080", width: "469", height: "8.249" }),
  wp.element.createElement("rect", { x: "16.601", y: "144.762", fill: "#7B8080", width: "373", height: "8.249" })
);

var latestShowNews3 = wp.element.createElement(
  "svg",
  { version: "1.1", id: "Layer_1", x: "0px", y: "0px", width: "502px", height: "201.03px", viewBox: "0 0 502 201.03", "enable-background": "new 0 0 502 201.03" },
  wp.element.createElement("rect", { x: "0.5", y: "0.53", fill: "#7B8080", stroke: "#7B8080", "stroke-miterlimit": "10", width: "238.245", height: "200" }),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("path", { fill: "#FFFFFF", d: "M143.929,72.79H84.534c-0.586,0-1.061,0.539-1.061,1.206v53.066c0,0.666,0.475,1.206,1.061,1.206h59.395\r c0.585,0,1.06-0.539,1.06-1.206V73.995C144.989,73.33,144.514,72.79,143.929,72.79z M142.867,125.856H85.594V75.202h57.273V125.856\r L142.867,125.856z" }),
    wp.element.createElement("path", { fill: "#FFFFFF", d: "M100.443,99.488c3.256,0,5.907-3.013,5.907-6.712c0-3.707-2.649-6.717-5.907-6.717\r c-3.258,0-5.907,3.012-5.907,6.715C94.537,96.476,97.186,99.488,100.443,99.488z M100.443,88.467c2.088,0,3.786,1.932,3.786,4.307\r c0,2.372-1.698,4.304-3.786,4.304c-2.088,0-3.786-1.931-3.786-4.304C96.657,90.402,98.355,88.467,100.443,88.467z" }),
    wp.element.createElement("path", { fill: "#FFFFFF", d: "M90.896,121.031c0.249,0,0.5-0.099,0.701-0.301l17.302-17.32l10.927,12.424\r c0.416,0.471,1.086,0.471,1.499,0c0.416-0.472,0.416-1.234,0-1.705l-5.097-5.798l9.737-12.125l11.943,12.449\r c0.433,0.451,1.102,0.416,1.499-0.075c0.396-0.491,0.365-1.254-0.066-1.703l-12.729-13.267c-0.208-0.215-0.483-0.321-0.763-0.315\r c-0.281,0.014-0.546,0.155-0.737,0.392l-10.387,12.937l-5.032-5.72c-0.395-0.449-1.03-0.473-1.451-0.054l-18.046,18.07\r c-0.439,0.44-0.482,1.201-0.095,1.703C90.31,120.894,90.604,121.031,90.896,121.031z" })
  ),
  wp.element.createElement("rect", { x: "239.869", y: "1.5", fill: "#FFFFFF", stroke: "#7B8080", "stroke-width": "3", "stroke-miterlimit": "10", width: "260.632", height: "198.001" }),
  wp.element.createElement("rect", { x: "251.164", y: "65.366", fill: "#7B8080", width: "28.631", height: "9.106" }),
  wp.element.createElement("rect", { x: "251.164", y: "40.547", fill: "#7B8080", width: "236.006", height: "12.067" }),
  wp.element.createElement("rect", { x: "251.164", y: "90.185", fill: "#7B8080", width: "236.006", height: "7.06" }),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("rect", { x: "251.164", y: "152.344", fill: "#7B8080", width: "55.098", height: "8.501" }),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("path", { fill: "#7B8080", d: "M315.744,156.946h8.747l-2.087,2.812c-0.183,0.248-0.183,0.646,0,0.893c0.184,0.245,0.48,0.245,0.664,0\r l2.884-3.89c0.186-0.246,0.186-0.645,0-0.893l-2.884-3.89c-0.093-0.126-0.212-0.186-0.332-0.186s-0.24,0.06-0.332,0.186\r c-0.183,0.247-0.183,0.646,0,0.893l2.087,2.812h-8.747c-0.261,0-0.47,0.283-0.47,0.629\r C315.275,156.663,315.484,156.946,315.744,156.946z" })
    )
  ),
  wp.element.createElement("rect", { x: "251.165", y: "105.184", fill: "#7B8080", width: "236.006", height: "7.061" }),
  wp.element.createElement("rect", { x: "252.165", y: "120.184", fill: "#7B8080", width: "172.006", height: "7.061" })
);

var sessionSliderOff1 = wp.element.createElement(
  "svg",
  { version: "1.1", id: "sessionSliderOff1", x: "0px", y: "0px", width: "334px", height: "318px", viewBox: "-2.23 0 334 318", enableBackground: "new -2.23 0 334 318" },
  wp.element.createElement("rect", { x: "-0.73", y: "1.5", fill: "#FFFFFF", stroke: "#7B8080", "stroke-width": "3", "stroke-miterlimit": "10", width: "331", height: "315" }),
  wp.element.createElement("rect", { x: "0", y: "1.5", fill: "#7B8080", width: "331", height: "91" }),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("rect", { x: "107.77", y: "120.167", fill: "#7B8080", width: "136.666", height: "11" }),
    wp.element.createElement("rect", { x: "79.103", y: "144.167", fill: "#7B8080", width: "187.333", height: "9.667" })
  ),
  wp.element.createElement("rect", { x: "36.437", y: "187.5", fill: "#7B8080", width: "253", height: "8" }),
  wp.element.createElement("rect", { x: "34.77", y: "207.5", fill: "#7B8080", width: "260", height: "6.667" }),
  wp.element.createElement("rect", { x: "34.77", y: "227.834", fill: "#7B8080", width: "248.73", height: "7.666" }),
  wp.element.createElement("rect", { x: "34.77", y: "247.167", fill: "#7B8080", width: "231.666", height: "7.333" }),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("rect", { x: "118.103", y: "284.497", fill: "#7B8080", width: "97.667", height: "9.333" }),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("path", { fill: "#7B8080", d: "M232.576,289.549h15.508l-3.701,3.088c-0.322,0.271-0.322,0.709,0,0.979c0.324,0.271,0.852,0.271,1.176,0\r l5.115-4.271c0.324-0.27,0.324-0.709,0-0.979l-5.115-4.27c-0.162-0.138-0.375-0.203-0.588-0.203s-0.426,0.065-0.588,0.203\r c-0.322,0.27-0.322,0.709,0,0.979l3.701,3.088h-15.508c-0.459,0-0.83,0.311-0.83,0.691\r C231.746,289.238,232.117,289.549,232.576,289.549z" })
    )
  ),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("path", { fill: "#FFFFFF", d: "M197.612,19.885H131.93c-0.648,0-1.173,0.524-1.173,1.172v51.607c0,0.649,0.525,1.173,1.173,1.173h65.682\r c0.646,0,1.172-0.524,1.172-1.173V21.057C198.783,20.409,198.258,19.885,197.612,19.885z M196.438,71.491h-63.335V22.23h63.335\r V71.491z" }),
    wp.element.createElement("path", { fill: "#FFFFFF", d: "M149.523,45.85c3.602,0,6.532-2.93,6.532-6.53c0-3.603-2.93-6.532-6.532-6.532\r c-3.602,0-6.532,2.929-6.532,6.531C142.991,42.92,145.921,45.85,149.523,45.85z M149.523,35.132c2.308,0,4.186,1.879,4.186,4.186\r c0,2.307-1.878,4.186-4.186,4.186c-2.309,0-4.186-1.878-4.186-4.185C145.337,37.013,147.214,35.132,149.523,35.132z" }),
    wp.element.createElement("path", { fill: "#FFFFFF", d: "M138.967,66.8c0.274,0,0.551-0.096,0.774-0.292l19.133-16.845l12.083,12.082\r c0.459,0.458,1.201,0.458,1.658,0c0.459-0.459,0.459-1.2,0-1.658l-5.637-5.639l10.768-11.792l13.207,12.107\r c0.479,0.438,1.219,0.405,1.658-0.072c0.438-0.478,0.404-1.22-0.072-1.657l-14.076-12.902c-0.23-0.209-0.535-0.314-0.844-0.307\r c-0.311,0.014-0.604,0.151-0.814,0.381l-11.487,12.582l-5.563-5.563c-0.438-0.437-1.14-0.459-1.604-0.052l-19.959,17.573\r c-0.486,0.429-0.534,1.169-0.106,1.656C138.318,66.667,138.642,66.8,138.967,66.8z" })
  )
);

var sessionSliderOff2 = wp.element.createElement(
  "svg",
  { version: "1.1", id: "sessionSliderOff2", x: "0px", y: "0px", width: "334px", height: "318px", viewBox: "0 0 334 318", enableBackground: "new 0 0 334 318" },
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("rect", { x: "1.5", y: "1.5", fill: "#FFFFFF", stroke: "#7B8080", "stroke-width": "3", "stroke-miterlimit": "10", width: "331", height: "315" }),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement("rect", { x: "106.906", y: "39.384", fill: "#7B8080", width: "120.187", height: "9.055" }),
        wp.element.createElement("rect", { x: "84.628", y: "61.061", fill: "#7B8080", width: "164.744", height: "7.957" })
      ),
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement("rect", { x: "31.241", y: "91.243", fill: "#7B8080", width: "249.108", height: "6.585" }),
        wp.element.createElement("rect", { x: "30.25", y: "111.272", fill: "#7B8080", width: "273.5", height: "5.488" }),
        wp.element.createElement("rect", { x: "31.241", y: "128.559", fill: "#7B8080", width: "218.131", height: "6.311" })
      ),
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement("rect", { x: "113.716", y: "270.69", fill: "#7B8080", width: "80.395", height: "7.683" }),
        wp.element.createElement(
          "g",
          null,
          wp.element.createElement("path", { fill: "#7B8080", d: "M205.186,275.101h12.766l-3.046,2.542c-0.267,0.222-0.267,0.583,0,0.805\r c0.267,0.225,0.699,0.225,0.966,0l4.212-3.514c0.267-0.223,0.267-0.584,0-0.806l-4.212-3.515\r c-0.133-0.112-0.309-0.167-0.482-0.167c-0.176,0-0.35,0.055-0.483,0.167c-0.267,0.222-0.267,0.584,0,0.806l3.046,2.542h-12.766\r c-0.377,0-0.683,0.256-0.683,0.568C204.503,274.845,204.809,275.101,205.186,275.101z" })
        )
      ),
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement("rect", { x: "114.212", y: "188.924", fill: "#7B8080", width: "100.424", height: "6.035" }),
        wp.element.createElement("rect", { x: "114.212", y: "210.326", fill: "#7B8080", width: "62.833", height: "6.036" }),
        wp.element.createElement("rect", { x: "114.212", y: "227.063", fill: "#7B8080", width: "44.038", height: "6.036" }),
        wp.element.createElement("circle", { fill: "#7B8080", cx: "65.234", cy: "208.542", r: "34.984" })
      )
    )
  )
);

var sessionSliderOn1 = wp.element.createElement(
  "svg",
  { version: "1.1", id: "sessionSliderOn1", x: "0px", y: "0px", width: "237px", height: "154px", viewBox: "7.634 2.084 237 154", enableBackground: "new 7.634 2.084 237 154" },
  wp.element.createElement("rect", { x: "9.134", y: "3.584", fill: "none", stroke: "#7B8080", "stroke-width": "3", "stroke-miterlimit": "10", width: "234", height: "151" }),
  wp.element.createElement("rect", { x: "37.967", y: "23.86", fill: "#7B8080", width: "176.334", height: "8" }),
  wp.element.createElement("rect", { x: "47.967", y: "38.194", fill: "#7B8080", width: "156.334", height: "7" }),
  wp.element.createElement("rect", { x: "98.633", y: "51.86", fill: "#7B8080", width: "55.002", height: "7.333" }),
  wp.element.createElement("rect", { x: "75.633", y: "81.192", fill: "#7B8080", width: "101.002", height: "5.334" }),
  wp.element.createElement("rect", { x: "124.612", y: "113.97", fill: "#7B8080", width: "1.271", height: "20.339" }),
  wp.element.createElement("rect", { x: "162.184", y: "121.336", fill: "#7B8080", width: "29.715", height: "5.018" }),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("path", { fill: "#7B8080", d: "M74.916,128.198l-1.591,2.284l-1.123-0.921c-0.119-0.101-0.3-0.082-0.397,0.039\r c-0.099,0.12-0.084,0.299,0.037,0.4l1.359,1.116c0.051,0.04,0.114,0.063,0.181,0.063c0.014,0,0.026,0,0.04-0.002\r c0.075-0.011,0.148-0.054,0.194-0.117l1.766-2.538c0.088-0.131,0.059-0.308-0.07-0.395\r C75.18,128.036,75.006,128.068,74.916,128.198z" }),
    wp.element.createElement("path", { fill: "#7B8080", d: "M75.149,126.507v-5.539v-2.843c0-0.156-0.126-0.282-0.282-0.282h-1.42v-0.854\r c0-0.158-0.128-0.284-0.286-0.284h-1.989c-0.158,0-0.284,0.126-0.284,0.284v0.854h-6.252v-0.854c0-0.158-0.13-0.284-0.284-0.284\r h-1.995c-0.156,0-0.279,0.126-0.279,0.284v0.854h-1.423c-0.158,0-0.284,0.126-0.284,0.282v2.843v11.654\r c0,0.157,0.126,0.284,0.284,0.284h10.831c0.568,0.358,1.239,0.568,1.962,0.568c2.034,0,3.694-1.658,3.694-3.694\r C77.138,128.36,76.328,127.121,75.149,126.507z M71.453,117.274h1.423v0.854v0.852h-1.423v-0.852V117.274z M62.645,117.274h1.421\r v0.854v0.852h-1.421v-0.852V117.274z M60.936,118.413h1.139v0.853c0,0.157,0.125,0.284,0.281,0.284h1.995\r c0.154,0,0.284-0.127,0.284-0.284v-0.853h6.252v0.853c0,0.157,0.126,0.284,0.284,0.284h1.989c0.158,0,0.285-0.127,0.285-0.284\r v-0.853h1.137v2.274H60.936V118.413L60.936,118.413z M60.936,132.339v-11.084h13.646v5.013c-0.056-0.019-0.112-0.033-0.171-0.046\r c-0.053-0.018-0.107-0.029-0.16-0.041c-0.048-0.013-0.1-0.022-0.146-0.028c-0.07-0.016-0.14-0.025-0.208-0.035\r c-0.039-0.005-0.076-0.01-0.119-0.015c-0.107-0.01-0.221-0.017-0.333-0.017c-0.1,0-0.19,0.007-0.285,0.017v-0.301v-0.57v-2.557\r h-2.56h-0.568h-1.99h-0.57h-1.989h-0.565h-2.563v2.557v0.57v1.988v0.57v2.559h2.563h0.565h1.989h0.57h1.887\r c0.006,0.025,0.016,0.047,0.027,0.075c0.023,0.067,0.049,0.137,0.076,0.204c0.014,0.039,0.035,0.075,0.047,0.111\r c0.035,0.07,0.067,0.143,0.108,0.215c0.016,0.03,0.035,0.056,0.05,0.086c0.042,0.076,0.087,0.149,0.13,0.221\r c0.02,0.025,0.038,0.048,0.054,0.075c0.05,0.071,0.104,0.14,0.159,0.209c0.021,0.025,0.043,0.048,0.063,0.071\r c0.042,0.053,0.087,0.106,0.132,0.152H60.936L60.936,132.339z M71.828,126.465c-0.031,0.016-0.063,0.026-0.094,0.042\r c-0.051,0.029-0.104,0.06-0.155,0.089c-0.047,0.028-0.092,0.053-0.137,0.084c-0.041,0.028-0.091,0.055-0.128,0.089\r c-0.049,0.036-0.102,0.071-0.146,0.104c-0.034,0.034-0.076,0.06-0.11,0.094c-0.049,0.043-0.102,0.086-0.146,0.132\r c-0.033,0.031-0.064,0.061-0.1,0.093c-0.05,0.051-0.099,0.106-0.146,0.162c-0.021,0.026-0.041,0.046-0.063,0.07v-1.622h1.99v0.389\r c-0.006,0.002-0.01,0.002-0.014,0.003C72.318,126.257,72.064,126.346,71.828,126.465z M69.911,128.701\r c-0.011,0.031-0.017,0.066-0.026,0.101c-0.022,0.081-0.048,0.164-0.061,0.247c-0.019,0.066-0.024,0.133-0.031,0.2\r c-0.01,0.053-0.02,0.108-0.027,0.16c-0.012,0.123-0.019,0.247-0.019,0.372c0,0.104,0.007,0.207,0.017,0.312\r c0,0.02,0,0.035,0.002,0.057c0.004,0.045,0.014,0.09,0.021,0.138l0,0c0.004,0.021,0.007,0.042,0.007,0.064h-1.751v-1.991h1.991l0,0\r c-0.004,0.009-0.004,0.017-0.007,0.022C69.983,128.486,69.942,128.594,69.911,128.701z M62.927,128.36h1.992v1.991h-1.992V128.36z\r M62.927,125.802h1.992v1.988h-1.992V125.802z M72.591,125.231h-1.99v-1.989h1.99V125.231z M70.033,125.231h-1.99v-1.989h1.99\r V125.231z M70.033,127.79h-1.99v-1.988h1.99V127.79z M65.483,125.802h1.989v1.988h-1.989V125.802z M67.472,125.231h-1.989v-1.989\r h1.989V125.231z M64.917,125.231h-1.994v-1.989h1.994V125.231z M65.483,128.36h1.989v1.991h-1.989V128.36z M73.447,132.906\r c-0.647,0-1.241-0.194-1.737-0.527c-0.097-0.066-0.188-0.136-0.274-0.212c-0.034-0.025-0.063-0.052-0.09-0.08\r c-0.061-0.053-0.112-0.104-0.164-0.158c-0.034-0.036-0.064-0.07-0.1-0.106c-0.042-0.053-0.091-0.108-0.132-0.168\r c-0.027-0.035-0.057-0.07-0.08-0.106c-0.063-0.09-0.122-0.186-0.177-0.281c-0.011-0.023-0.022-0.047-0.033-0.069\r c-0.043-0.083-0.079-0.166-0.115-0.248c-0.013-0.036-0.026-0.075-0.04-0.112c-0.026-0.073-0.048-0.149-0.073-0.226\r c-0.006-0.021-0.01-0.036-0.013-0.053c-0.033-0.125-0.057-0.251-0.073-0.374c-0.003-0.01-0.003-0.019-0.006-0.029\r c-0.014-0.126-0.023-0.253-0.023-0.379c0-0.107,0.006-0.211,0.016-0.319c0-0.008,0.004-0.017,0.004-0.026\r c0.01-0.098,0.026-0.192,0.046-0.289c0-0.01,0.004-0.017,0.007-0.026c0.02-0.097,0.043-0.188,0.073-0.282\r c0.003-0.011,0.007-0.021,0.01-0.032c0.033-0.09,0.063-0.176,0.099-0.264c0.038-0.079,0.076-0.159,0.116-0.238l0.03-0.048\r c0.011-0.021,0.024-0.039,0.036-0.062c0.05-0.082,0.103-0.163,0.158-0.242c0.014-0.018,0.029-0.037,0.044-0.056\r c0.054-0.069,0.105-0.134,0.162-0.196c0.017-0.022,0.04-0.044,0.056-0.063c0.057-0.06,0.116-0.116,0.176-0.171\r c0.021-0.021,0.043-0.037,0.066-0.058c0.07-0.06,0.143-0.116,0.219-0.172c0.01-0.01,0.021-0.017,0.035-0.026\r c0.375-0.255,0.798-0.432,1.254-0.508l0.007-0.004c0.17-0.028,0.336-0.045,0.517-0.045c0.108,0,0.22,0.007,0.327,0.021\r c0.018,0,0.035,0.005,0.049,0.008c0.094,0.011,0.185,0.025,0.277,0.044c0.013,0,0.025,0.008,0.034,0.008\r c0.102,0.022,0.196,0.05,0.292,0.082c0.007,0,0.015,0.005,0.021,0.007c0.096,0.033,0.193,0.072,0.292,0.113\r c1.079,0.493,1.834,1.583,1.834,2.846C76.569,131.506,75.166,132.906,73.447,132.906z" })
  ),
  wp.element.createElement("rect", { x: "82.108", y: "122.286", fill: "#7B8080", width: "29.715", height: "5.018" }),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement("rect", { x: "136.967", y: "120.724", fill: "#7B8080", width: "2.443", height: "1.244" })
      )
    ),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement("rect", { x: "136.967", y: "125.709", fill: "#7B8080", width: "2.443", height: "1.244" })
      )
    ),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement("rect", { x: "135.819", y: "123.214", fill: "#7B8080", width: "3.592", height: "1.249" })
      )
    ),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement("path", { fill: "#7B8080", d: "M148.875,115.62c-4.529,0-8.219,3.688-8.219,8.221c0,4.531,3.689,8.218,8.219,8.218\r c4.533,0,8.221-3.687,8.221-8.218C157.096,119.308,153.409,115.62,148.875,115.62z M148.875,130.81\r c-3.844,0-6.971-3.124-6.971-6.969c0-3.846,3.129-6.972,6.971-6.972s6.973,3.126,6.973,6.972\r C155.848,127.686,152.721,130.81,148.875,130.81z" })
      )
    ),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement("polygon", { fill: "#7B8080", points: "149.28,124.149 149.28,120.121 148.032,120.121 148.032,124.809 151.247,126.997 151.948,125.965" })
      )
    )
  )
);

var sessionSliderOn2 = wp.element.createElement(
  "svg",
  { version: "1.1", id: "sessionSliderOn2", x: "0px", y: "0px", width: "237px", height: "154px", viewBox: "2.462 2.038 237 154", enableBackground: "new 2.462 2.038 237 154" },
  wp.element.createElement("rect", { x: "3.962", y: "3.538", fill: "none", stroke: "#7B8080", "stroke-width": "3", "stroke-miterlimit": "10", width: "234", height: "151" }),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("rect", { x: "32.797", y: "30.988", fill: "#7B8080", width: "176.332", height: "10.413" }),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement(
          "g",
          null,
          wp.element.createElement(
            "g",
            null,
            wp.element.createElement("rect", { x: "90.69", y: "72.486", fill: "#7B8080", width: "2.721", height: "1.391" })
          )
        ),
        wp.element.createElement(
          "g",
          null,
          wp.element.createElement(
            "g",
            null,
            wp.element.createElement("rect", { x: "90.69", y: "78.042", fill: "#7B8080", width: "2.721", height: "1.386" })
          )
        ),
        wp.element.createElement(
          "g",
          null,
          wp.element.createElement(
            "g",
            null,
            wp.element.createElement("rect", { x: "89.413", y: "75.264", fill: "#7B8080", width: "4", height: "1.389" })
          )
        ),
        wp.element.createElement(
          "g",
          null,
          wp.element.createElement(
            "g",
            null,
            wp.element.createElement("path", { fill: "#7B8080", d: "M103.953,66.806c-5.045,0-9.153,4.108-9.153,9.154c0,5.047,4.108,9.149,9.153,9.149\r c5.047,0,9.153-4.104,9.153-9.149S109,66.806,103.953,66.806z M103.953,83.725c-4.28,0-7.762-3.481-7.762-7.764\r c0-4.281,3.484-7.762,7.762-7.762c4.278,0,7.763,3.48,7.763,7.762C111.716,80.243,108.231,83.725,103.953,83.725z" })
          )
        ),
        wp.element.createElement(
          "g",
          null,
          wp.element.createElement(
            "g",
            null,
            wp.element.createElement("polygon", { fill: "#7B8080", points: "104.4,76.302 104.4,71.82 103.013,71.82 103.013,77.038 106.589,79.479 107.371,78.33" })
          )
        )
      ),
      wp.element.createElement("rect", { x: "119.419", y: "73.162", fill: "#7B8080", width: "33.093", height: "5.588" })
    ),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement("path", { fill: "#7B8080", d: "M70.895,121.409l-1.711,2.459l-1.207-0.989c-0.132-0.107-0.325-0.09-0.431,0.042\r c-0.107,0.129-0.089,0.319,0.042,0.433l1.462,1.199c0.056,0.045,0.124,0.07,0.195,0.07c0.014,0,0.029-0.003,0.042-0.003\r c0.082-0.017,0.161-0.062,0.21-0.128l1.899-2.732c0.097-0.14,0.063-0.328-0.074-0.424\r C71.182,121.236,70.992,121.271,70.895,121.409z" }),
        wp.element.createElement("path", { fill: "#7B8080", d: "M71.145,119.588v-5.961v-3.057c0-0.172-0.135-0.307-0.303-0.307h-1.529v-0.92\r c0-0.169-0.139-0.303-0.306-0.303h-2.142c-0.171,0-0.307,0.134-0.307,0.303v0.92h-6.73v-0.92c0-0.169-0.138-0.303-0.306-0.303\r h-2.145c-0.169,0-0.303,0.134-0.303,0.303v0.92h-1.528c-0.172,0-0.307,0.135-0.307,0.307v3.057v12.545\r c0,0.169,0.135,0.309,0.307,0.309H67.2c0.613,0.385,1.335,0.607,2.113,0.607c2.191,0,3.977-1.781,3.977-3.977\r C73.29,121.583,72.417,120.253,71.145,119.588z M67.167,109.652h1.533v0.918v0.916h-1.533v-0.916V109.652z M57.688,109.652h1.529\r v0.918v0.916h-1.529v-0.916V109.652z M55.85,110.877h1.226v0.916c0,0.173,0.134,0.307,0.303,0.307h2.145\r c0.168,0,0.306-0.134,0.306-0.307v-0.916h6.73v0.916c0,0.173,0.135,0.307,0.307,0.307h2.142c0.167,0,0.306-0.134,0.306-0.307\r v-0.916h1.223v2.449H55.85V110.877z M55.85,125.868v-11.933h14.687v5.397c-0.061-0.022-0.121-0.037-0.183-0.053\r c-0.057-0.015-0.115-0.03-0.171-0.041c-0.053-0.011-0.107-0.021-0.157-0.032c-0.074-0.016-0.149-0.025-0.225-0.04\r c-0.041-0.003-0.082-0.01-0.128-0.013c-0.116-0.012-0.239-0.02-0.359-0.02c-0.107,0-0.206,0.008-0.306,0.02v-0.325v-0.612v-2.75\r h-2.755H65.64h-2.142h-0.612h-2.143h-0.607h-2.758v2.75v0.612v2.144v0.61v2.755h2.758h0.609h2.143H63.5h2.03\r c0.007,0.026,0.019,0.051,0.029,0.078c0.026,0.075,0.053,0.15,0.083,0.221c0.015,0.045,0.037,0.082,0.053,0.121\r c0.037,0.074,0.07,0.153,0.115,0.232c0.015,0.031,0.037,0.061,0.052,0.093c0.046,0.081,0.093,0.16,0.143,0.233\r c0.018,0.031,0.038,0.056,0.056,0.084c0.054,0.074,0.111,0.147,0.172,0.223c0.021,0.031,0.046,0.055,0.068,0.079\r c0.044,0.058,0.092,0.112,0.141,0.165L55.85,125.868L55.85,125.868z M67.57,119.542c-0.032,0.021-0.067,0.03-0.1,0.046\r c-0.056,0.033-0.111,0.064-0.168,0.098c-0.048,0.029-0.097,0.058-0.146,0.088c-0.046,0.035-0.097,0.063-0.14,0.099\r c-0.052,0.038-0.106,0.075-0.156,0.116c-0.038,0.035-0.082,0.063-0.12,0.101c-0.054,0.046-0.109,0.093-0.157,0.142\r c-0.038,0.033-0.072,0.064-0.109,0.101c-0.052,0.053-0.104,0.114-0.157,0.175c-0.021,0.025-0.045,0.051-0.067,0.075v-1.745h2.143\r v0.416c-0.008,0.005-0.012,0.005-0.016,0.005C68.099,119.318,67.829,119.419,67.57,119.542z M65.508,121.951\r c-0.012,0.031-0.019,0.072-0.03,0.107c-0.021,0.09-0.048,0.178-0.064,0.267c-0.017,0.071-0.025,0.143-0.033,0.218\r c-0.01,0.059-0.021,0.115-0.029,0.171c-0.015,0.132-0.022,0.265-0.022,0.397c0,0.115,0.007,0.227,0.019,0.338\r c0,0.023,0,0.037,0.003,0.06c0.004,0.05,0.015,0.099,0.022,0.15l0,0c0.003,0.021,0.007,0.045,0.007,0.065h-1.884v-2.142h2.142\r l0,0c-0.003,0.008-0.003,0.019-0.007,0.024C65.586,121.72,65.544,121.833,65.508,121.951z M57.991,121.583h2.146v2.142h-2.146\r V121.583z M57.991,118.83h2.146v2.143h-2.146V118.83z M68.395,118.217h-2.143v-2.143h2.143V118.217z M65.64,118.217h-2.142\r v-2.143h2.142V118.217z M65.64,120.973h-2.142v-2.144h2.142V120.973z M60.745,118.83h2.143v2.143h-2.143V118.83z M62.888,118.217\r h-2.143v-2.143h2.143V118.217z M60.135,118.217h-2.146v-2.143h2.146V118.217z M60.745,121.583h2.143v2.142h-2.143V121.583z\r M69.313,126.482c-0.694,0-1.334-0.211-1.87-0.573c-0.104-0.07-0.202-0.142-0.295-0.224c-0.037-0.028-0.067-0.058-0.097-0.084\r c-0.063-0.059-0.121-0.115-0.174-0.174c-0.037-0.037-0.071-0.074-0.108-0.113c-0.045-0.058-0.097-0.116-0.142-0.184\r c-0.03-0.037-0.06-0.076-0.086-0.115c-0.068-0.099-0.132-0.199-0.189-0.304c-0.011-0.024-0.026-0.049-0.036-0.075\r c-0.046-0.089-0.086-0.178-0.125-0.265c-0.016-0.042-0.03-0.083-0.042-0.119c-0.03-0.082-0.054-0.164-0.08-0.247\r c-0.007-0.021-0.011-0.037-0.014-0.057c-0.037-0.133-0.06-0.266-0.078-0.401c-0.004-0.009-0.004-0.021-0.007-0.03\r c-0.015-0.137-0.025-0.271-0.025-0.408c0-0.116,0.006-0.229,0.018-0.344c0-0.009,0.004-0.021,0.004-0.031\r c0.011-0.103,0.029-0.203,0.048-0.311c0-0.011,0.003-0.018,0.007-0.027c0.022-0.104,0.046-0.203,0.079-0.304\r c0.004-0.011,0.008-0.021,0.012-0.034c0.037-0.094,0.066-0.191,0.107-0.281c0.039-0.086,0.083-0.172,0.125-0.256l0.033-0.056\r c0.01-0.021,0.025-0.043,0.039-0.063c0.052-0.09,0.111-0.178,0.171-0.26c0.015-0.021,0.029-0.043,0.045-0.062\r c0.057-0.074,0.115-0.146,0.175-0.213c0.018-0.022,0.042-0.047,0.06-0.068c0.061-0.063,0.125-0.125,0.19-0.182\r c0.022-0.021,0.046-0.043,0.072-0.063c0.074-0.064,0.153-0.125,0.236-0.182c0.01-0.012,0.021-0.023,0.035-0.031\r c0.403-0.275,0.859-0.466,1.35-0.548l0.007-0.004c0.183-0.03,0.364-0.045,0.557-0.045c0.117,0,0.236,0.005,0.353,0.017\r c0.018,0,0.036,0.008,0.052,0.012c0.101,0.012,0.2,0.025,0.299,0.045c0.016,0.006,0.026,0.01,0.037,0.014\r c0.109,0.021,0.211,0.051,0.314,0.085c0.007,0.004,0.015,0.008,0.022,0.008c0.104,0.036,0.21,0.077,0.313,0.122\r c1.162,0.531,1.974,1.705,1.974,3.063C72.678,124.97,71.167,126.482,69.313,126.482z" })
      ),
      wp.element.createElement("rect", { x: "78.641", y: "115.046", fill: "#7B8080", width: "108.046", height: "5.401" })
    )
  )
);

var sliderArrow1 = wp.element.createElement(
  "svg",
  { version: "1.1", id: "sliderArrow1", x: "0px", y: "0px", width: "315px", height: "118px", viewBox: "0 0 315 118", enableBackground: "new 0 0 315 118" },
  wp.element.createElement("image", { id: "image0", width: "315", height: "118", x: "0", y: "0", href: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAATsAAAB2CAYAAAC3bTTBAAAABGdBTUEAALGPC/xhBQAAACBjSFJN\r AAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAABmJLR0QA/wD/AP+gvaeTAAAb\r f0lEQVR42u2de3hU1b33v789kxuCBExaQhtUUIMloDTVtEhEaZhJALkIsdpyaAhGDs1MLoSYCwl7\r JpOLihJIQtPHcD0Hn0ehz+FVoZigx9YXeo4ttr498lq8vbUiOUdQSAmQy8z+vX+QhCEQSDKTrL0z\r 6/M863my9+xZ+a7fWr/f7L3XjWBgUvKfGf2PC+4YEGLYo92lmGn3G5tLjvc3n3k5lRPdHs8D8NCx\r m4PDPtxbteaiv7Uys2hz9Rki0n1ZbqQx0EnJ2Rj2j/aLd8PEU8wm05EDVYWf9TePpCxXjObmZWRS\r PgLj+M0jzMf3PlvQLLpsA8UsWoAvNLe0NzAQ331Co/8LoN/BrsPd8RBr2AYAzR0tmsXm2ttYW/K4\r 6PJJJAPBYnO93NzRksKAAg/QwdpKAP0OdtDo+wwuZo8GAGhuaX8XwA9Fl2+gKKIF+Aa9733kYUQP\r KBumid1/MhQQN4kumUQyYIibmL1826t994er/elKfzMahg52RD2Nrw0o2DHQozEoR0WXTSIZOFe2\r 36vbd1+50p+u9jdjYejHWDKZ3iM3H2PCcQJ/pCimNweWEX5HjBEApoAwUVFYBjuJYVEUPqoxNDA+\r A3CMCb8bSD4mxfS/NM3TwqC7iBFDJtN7ostmaKz20nuSsirvE62ji5ScjWHMPKC33wuefnZUb58x\r s2HSjRCtTw8dJEPB9drT9WBmSsnZGCZafxdJWZX3We2l94jWIaxLa66tdKobUJnpUQBHDm0pSRBt\r DF9gZrLayv4L4E9gMhU3Vq/7oMfnoiX2GdkbKxZLZnksPJ4ygO5oqC2eSkTiDe4DczJc/xvAA0T8\r b2bA+Zva9f8lQoeQFpOUVXmfx+1+F7h8B0Um5YHG6uLfi9DjD+ZklC0GtH8DACJoAL08PuK7K3c6\r VrQC+ggQfUUGOzGkOnaEnjx9YhvAj1/uYFAePbSleJ9obQPFklk2gz3akctniE1mc/wbmwv/ONRa\r hHRQdBb0yBUnPdrTIrT4DeKirj+ZoTD4lq5AJ5H0hZ2OFa0MvuWKnlSvdmVIrvbrIyICHSCwN5bM\r prVeh38kE/1KlBZfWZRdFU7gju6ygTxKEHJF65IYDyUIuQTydB0TuGNRdlW4aF0DpdOvu4NbD78f\r Wi0iDWHJKHUB9G7jlpL9InX4rzyu+SCUgfH7xi0lv/D+TA+Pfn1FPsaKxZLh+iUIM8AoHla+AY5v\r 3LK+RLQWiZ/orSdMdO+l7I01Dr6MCJD0jjToEGEkB5V3dpLhiKFnUEgkEklfkcFOIpEEBH4Jdosz\r Km4Z6GhviUQi6Y0FTz87anFGxS3+yMvnYPdI7vMR5+H599bzba8m26tDRBvHqCRluu6Z9/SGcaJ1\r SPzH3LznxulhmpRRSbZXh7Seb3v1PDz//kju8xG+5udTsEu2V0S2tV18m8HTGHjYw80vp+zZYxJt\r JKORtMY1RdPwpvtC25sL1r7gc6VKxPNI7vMR7gttb2oa3rTmlE4RrcdopOzZY/Jw88sMPMzgaW1t\r F99OtldE+pKnT8HOrXl2MnNs1zEzL2p+53imaEMZiUeyyu7kdrwJIILBU9paLx6aX/jMGNG6JANn\r XkHlmLbWi4cYPAVABLfjzfmZrjtF6zISze8cz2TmRV3HzBzr1jw7fcnTp2BnVoJXEeGv3ScIDeMj\r vlsn2E6Gol1DHgPdj68Mvrf9XIewUeYS32k/17GWwfd2HTMwrl1DnmhdRmJ8xHfrQGjoOibCX81K\r 8Cpf8vQp2B2syT9hIvODIPozEQ6aKXyhnA/aP0w02t6jUl8MnzV5vWhdkoETPmvyeiK82H2C0GCi\r 0XbRuozETseKVjOFLyTCQRD92UTmBw/W5J/wJU+/jMxMtlffDKDtYE1mm2gj6ZXrDcR9bE1VWHN7\r ywEQvdNQU+wQrVUOKvYPFpvLAeYHRwePnDcYmzgFAp2dniEHazL/IVrLsGYopz+l7NljEj0FS04X\r 8z+yw04/6P/nUSBGcip/Iu/sJMMROYNCIpEEBDLYSSSSgEAGO4lEEhDIYCeRSAICGewkEklAIIOd\r RCIJCHoNdlaba4U/VhqQSCSSoeCR3OcjrDbXit4+v+Zgpbm20qkdTP+HiM8BSuX4iO9sCsRpYHoY\r T9aTuZnPfdejdTg5iGoaq4reH4z/IcfZ9c6c7PJ7qYPtJiVI9XX6ksQ/XNpv98tsQCtkplFBxPdc\r ayNu87W+7AacABMzbga0yi9Pn/gRgIWiCxXIzC98ZkxHS0cRM2wAQuGmcABLROsKONxaCYMfdWtt\r P7XYSmuDRgZVHHim8IxoWYHMl6dPvALmBZeOuDN+4dGe1131GJtsL53OjMVXXETKi5AIpaNF+yEz\r 1gIIBQAwFs+zu6aK1hVIzLWVTsVl3whlxtqOFu2HonUFOj3jEzMWJ9tLp191Xc8T5uARXxBQRqAz\r AEDAuw016w6ILtBgoKpqsGgNfaWhpuggvDYbBpg8rKwRrUuvDMZ83Ev2vmKLwz821BQdFD1PuK9z\r ho3U3vtDQ826AwS8CwAEOkNAmTl4xBc9r7sq2L3+wtrTjVvWl4yOHDuBiNaYFHO+6ML4G1VVlfnz\r 579/+PDh46qqmn3PcWggUGnnn58RUSaHhdhEawokOCzERkSZAD4DrqgP3aOqqvnw4cPH58+f/76q\r qsNuFIZJMecT0ZrRkWMnNG5ZX/L6C2tPi9YkHFVVzVar9TgABsBJSUkf9nat6F/payWLrTzZ4WBF\r rnoiTqPDwYrFVp4s2gb9sUtnO2cAbLVaDfUjLxkAqqqGzp49+3N0VjoAjouL+0ZV1fBrXS+64erN\r YfRkFyNo1ItdVFUNj4uL+8a73c+ePftzVVVDRfukZBBQVfXmhISEJnhV+IwZM77qLdAB0mH0bBcj\r aNSTXVRVDZ8xY8ZX3u0/ISGhSVXVm0X7psSPqKoaER8ffxpeFT1r1qwTqqqOuN73RDdcvTmMnuxi\r BI16s4uqqiNmzZp1wtsP4uPjT6uqKicPDAeKioqipk+ffhZeFZyYmPhpX3qmRDdcPTqMXuxiBI16\r tIuqqsGJiYmfevvD9OnTzxYVFUWJ9lWJDxQXF98eGxvbAq+KTU5OPtbX3ijRDVevDiNan1E06tEu\r wKXRCMnJyce8/SI2NraluLj4dmHOKhk4hYWF34uJibkIrwpduHDh0f7kIbrh6tVhROszikY92sWb\r Tn/o9o+YmJiLhYWF3xsyJ5X4TkFBQdzEiRPb4FWRS5cufae/+YhuuHp1GNH6jKJRj3bpSadfdPvJ\r xIkT2woKCuIG3UklvpOfn/9gdHR0B7wq8IknnhjQDBDRDVevDiNan1E06tEu16LTP7r9JTo6uiM/\r P//BQXNSie/k5eUljRs3zo3OSiMiXr58+SsDzU90w9Wrw4jWZxSNerRLbyxfvvwVIuoOeOPGjXPn\r 5eUlDYKbSnwlNzd3aUREhAedlaUoCqelpW31JU/RDVevDiNan1E06tEu1yMtLW2roijdAS8iIsKT\r m5u71I9uKpa5uWW3itbgKzk5OSvCw8M1dFZSUFAQP/XUU1W+5iu64erVYUTrM4pGPdrlRjz11FNV\r QUFB3QEvPDxcy8nJWeFrvqKZm1t2K83JcGkgbgbofQX8h4ba9Yaa+J+ZmWnfvn375paWFgKAkJAQ\r pKWlldXV1ZX4mrc/Gs9Q4XRC+cOpyju+FRn19x1qqk8LrQ6HxTt91bjCuTP0q1NNE+6PLPxEVaGJ\r Lq+/7NIXVq9e7dq+fXtxW1sbAGDkyJGclpaWVV1dXSO6fP3Bait9VgPdD/C9YBqtAExghIP5IQ1Y\r JFpgf8jIyCjcunVrdVegGzFiBNLT0/P9EeiMgtVe5rDaXUePnC5r6YD7+H+faprue66S/z7VNL0D\r 7uNHTpe1WO2uo1Z7mUO0pqGirq6uJD09PX/EiEsTjFpaWmjr1q3VGRkZhaK19QcNWATmh8AIB5h6\r DK6lv4oW2FdWr15dsXXr1ooLFy4AAEaNGsXp6ekZtbW1z4nWNrRwLDPiwBwGAGzS7hCtaDjQbUfm\r MGbEARwrWtNQUltb+1x6enrGqFGjGAAuXLiArVu3VqxevbpCtLa+c2U8UwjkufwZPux3fgJIT0+v\r qa+vL+y6zR4zZgyvXLny55s3b/6laG1DDRN94n2ssQx2/qCnHXvaORDYvHnzL1euXPnzMWPGMAC0\r tbWhvr6+MD093RiPs17xjEAeZUbkzNCgUOU2s2J+SDGbfeq9HApWrFixc9u2bTa32w0AiIyM1NLS\r 0pZu2rTpX/1uKyLdJ0XjKC/BIKb5vuY5HPDZtkzz4WULReMo0XUtou42bdr0r2lpaUsjIyM1AHC7\r 3di2bZttxYoVO0XX8Y1QzOatZsX8UFCoctuMyJnGWs5q2bJle73HAkVFRbnz8vIsonWJxJqzcZIl\r s3zRvILKIZvXKLrHcSg7SOYVVN5uySxfZM3ZOGnI/qkOycvLs0RFRV0xhnXZsmV7Resaljz++OMN\r 8BrlPWHChPb8/PyZonUFIqIDnR56gwOR/Pz8mRMmTGiHlx92+qXEXyxZsuQwvAw8adKk1oKCAtnr\r KAjRgU4GO3EUFBRMnzRpUiu8/LHTPyW+smDBgj/Dy7CTJ0++UFhYOFm0rkBGdKCTwU4shYWFkydP\r nnwBXn7Z6aeSgaCqqtl7kxAAPHXq1HPr1q0z/IwPoyM60MlgJ55169bdOnXq1HPw8s+kpKQP9byR\r jy673lRVDT18+PCHb7311m1d58aPH+/5wQ9+8BdFUTpE6wt09u3bFy9aw+LFi98VrSHQ0TQt6OjR\r o9NOnjxp6jr34x//+G8zZ8682+l0+jSLJyBQVXVkQkLCl/D6xZBJX0n0XV3nnZ1wO8h07ZSQkPCl\r qqojB+D+g8qw2yxXIpFIroXunq+dTmeLqqqTgoOD5WOspFcWLVr0B9EaAh35GOsnZAeFfhH9CCs7\r KMRjxA4K3bNgwYI/QQ490RWiA50MdmLpZejJn0TrGhYsWbLkCIZoULFoJ5ZJJj3/IPQyqPjIILn+\r 4OBwsJLq2KHbybJDNV1MdAOVSSa9BjujTRdLdewIdTi4uxOWLDbXITDfBsIEgDY01pYUixbZG8uW\r Ldv70ksvLe2qyKioKM+yZcvmbtiwodFf/2OwfhEHi4XZFd8OGRN+fo/6ixbRWoYrjzl/ObLtzNmb\r Xt1U9D+itfQHf66CkpeXZ9m9e/dvmpqaTF15/+xnP/v17t27U0SXszcsNlcZwHlg/B1Ef1OYOZGB\r O5gRzMDdogVej927d6ekpqbuUpRLwbqpqcm0c+fOg7m5uY+K1iaKVo+n7uypr89Zba4mq931jsVe\r +YBoTcMBi73yAavd9Y7V5mo6e+rrc60eT51oTaLIzc19dOfOnQe7Ap2iKEhNTd2l50AHAAzc3RnX\r 7mDmxCvG2RFY97uB79ixI3XlypW1ZvOlTp9Tp04p27dv/3V2dvY/idYmBpoGAAyMY0YCKW7Z5e8H\r SHG3MiOBgXGdZ6aJ1iSC7Ozsf9q+ffuvT506pQCA2WzGypUra3fs2JEqWtuN6BnPFK9P3AxqYWZd\r TiHzpr6+3p6enl4ZEhICADhz5gxt27ZtV1ZW1i9EaxtKrHnP38SMiV3HBPKMHxt9TLSu4cD4sdHH\r vFfxZsZEa97zN4nWNZRkZWX9Ytu2bbvOnDnTvZlVenp6ZX19vV20thvBzMSgFhDcXecUgpKqKEr8\r dyKiRx2qLbmvc3FM3VNXV1f05JNPFnVtCnLu3Dmqr6/fYrPZnhatbcjQ2sYS8WECLm3EQfyxrzuL\r SS6xQ01tBfHHAEDABSI+DK1trGhdQ4XNZnu6vr5+y7lz57o3s3ryySeL6urqikRr6wtExIdqS+77\r TkT0KEVR4glKqmhNPpOZmWkfOXJk956xISEhvHr1atdA8xPdgzaQ5HC8bZ6TXX6v1e5KFK1lOCWr\r 3ZU4J7v8XofjbbNoLUPZG7t69WpXSEhId4/ryJEjtczMTN3fzQUE/twkW3QDlUkmkcFuuG6SPazI\r zc1dGhER4UFnJSmKwmlpaf3eQEh0A5VJJlHBLi0tbauiKN2BLiIiwpObm7tUtG9LrkFeXl7SuHHj\r rtgUZPny5a/0Jw/RDVQmmUQEu+XLl7/ivZnVuHHj3Hl5eUmifVpyHfLz8x+Mjo7ugNco7yeeeOJA\r X78vuoHKJNNQB7tO/+j2l+jo6I78/PwHRfuypA8UFBTETZw4sQ1eFZiSkvK7vnxXdAOVSaahDHad\r ftHtJxMnTmwrKCiIE+3Dkn5QWFj4vZiYmIvwqsiFCxcevdH3RDdQmWQaqmDX6Q/d/hETE3OxsLBQ\r 9xMLJNeguLj49tjY2BZ4VWhycvIxVVV7XaFZdAOVSabBDnaqqirJycnHvP0iNja2pbi4eMg2WpcM\r AkVFRVHTp08/C6+KTUxM/FRV1eBrXS+6gcok02AGO1VVgxMTEz/19ofp06efLSoqihLtqxI/oKpq\r RHx8/Gl4VfCsWbNOqKo6oue1ohuoTDINVrBTVXXErFmzTnj7QXx8/GlVVSNE+6jEj6iqenNCQkIT\r vCp6xowZX6mqGu59negGKpNMgxHsVFUNnzFjxlfe7T8hIaFJVdWbRfumLki2V0QmZbliROvwF6qq\r hs6ePftzeFV4XFzcN94BT3QDlUkmfwc7VVXD4+LivvFu97Nnz/5cVVXdLtbbX5KyXDHJ9orI611z\r zRf1ljVl0ZaM0s0ezf03zc27RBfEXzidztaEhIRJVqv1o65zkZGR/+N0Os+K1tYXrJnlxfNslXeJ\r 1iEB5tkq77Jmlut2oVtvnE7n2cjIyO6FR61W60cJCQmThtMOYJqbd3k0998sGaWbLWvKoq91zVXL\r OVnWlEWjXfuEGd0v8E1EC9+oLXlNdIH8haqqynvvvfenixcvjp45c+adTqezexmYnrf/eiEps2Ke\r pnn2E8gDwitBZpTtryr+ULSuQGN+TtndHW4Ug/ETBpsUxTT/jeqiPg9aH0q8VypWVdV8+PDhj8PC\r wprj4uK+73Q6NdH6/EWSzbXAw/zq5XKjHcHKHY0bi7/wvu6qO7vOC66oPI3hYgOsc9dXnE6ntn//\r /ntnzpwZ4x3o9IrTCUVjrRIAGGxi5p92dPCzonUFIh0d/Cwz/5TBJgDQWKt0OvW/2bzT6XTPnDkz\r Zv/+/fcOp0DHzKQxeq5ydKBnoAN6eYylIJQQocsgn0GByyjr3PUHp9PZLlpDX/iPr8tmg3lq1zER\r NDNhnWhdIiEiIclMWOflGwDz1P/4umy2KD3XSz0xSnvvZztgKHAB+OzSMTQKQsk1r+0tE4utdAug\r /L/REXdV73U8NuyM1Bv6fYwtS2QNmxg8hYj+paGm+OeiNYnEn5vJ9BeLzbWLmZcT6BgpyG6oKXlT\r tD0CnRTHnuDm0x9lAtrtjbXrM651zbB5NPUXeg12AOB0/tb8+9OHV5tD6LUDz6/7XLQekYgMdnNz\r y251t/GCGREz6xyOh3X/GkRyCRnseqDnYCe5jMhgJzEmun+xKpFIJP5ABjuJRBIQyGAnkUgCAhns\r JBJJQCDf8g4yssNjcJAdFJL+Iu/sJBJJQOCXYGdZu+GmZHt1iOjCSCSS4UWyvTrEsnbDTf7Iy+dg\r tyi7KhytFw95+Ow+GfD6z2POvcFJma57ROuQDB5We+k9KY49wb7nFFgk26tDPHx2H1ovHlqUXRXu\r a34+BTvL2g3fuuBu+S0zfsSMZDeffTXVsWPYrJE12Dy2piqs+dTxV5npSFJWxcOi9Uj8jzWz/GFm\r OtJ86virKTkbw0TrMQqpjh2hbj77KjOSmfGjC+6W31rWbviWL3n6dmfXevFXzHz5roRhPXn6y2zR\r hjICC/OfG9Xcfv4NBicx802aph1IyixLFK1L4j+sdleipmkHmPkmBic1t59/Y8HTz44SrcsInDz9\r ZTYY1q5jZr4HrRd/5UuePgU7E5lXEdEH3ScIDbdNjXxBtKGMQHur+34AD3SfYA7TGM8ZYbkgyY1x\r OFjRGM+B2ftu7oHOepfcgNumRr4AQkPXMRF9YCLzKl/y9MmxDtYUnQoJCXuYQH8B0X9SaNiSF1et\r 6hBtKCNwcHPRW1Bg7zom0PtmMllVFcNmrbFAxuEgzUwmK4He7z6pwP5G9bq3RGszAi+uWtVBoWFL\r QPSfBPpLSEjYwwdrik75kqdfBistzqi45UJwKDdUrflGtJH0xo3G2VntrkoAs0aYR83dV5V9VrRe\r o2CUcXaLsqvCL7jP/QbA7xpr1xeK1mM0rDkbx45ob6V9W4q+Fq1FcgP6sDEKpeRsDBO9OYvRkpHo\r rF9jROdhjKyAQcZojmkUjHJnJ9EP8mW4RCIJCGSw8zMOBysWW8Vk0TokxsViq5jscLD0TT8j9FnA\r ai+7H8RjG6pL3hBtCH9gsZc9AuYKgMdT0Mg7G6rWfCMfYweH4foYa83ZOJY7Wj4G6CSIihpril8X\r rckv5cp0JYHpm4aa4j+I0iD014OZazQPH7TYXO9a7eXzRGrxFYvN9RJr2mvMHMuMsXCfLxWtSWJA\r 3OdLmTGWmWNZ016z2FwviZbkC1Z7+TyLzfWu5uGDzFwjUouwYDfHVpbCzPcDADPfr2naPmt2eZRI\r Y/gCMb/tfcwa/tmaUzpFtC6JcbDmlE5hDf/sfa5nuzIS1uzyKE3T9nn7+RxbWYooPUKC3aX3EVpZ\r j9MvN2xa1yTKEL5y67Rv7yLQF8ClvStB2K24Q5pF65IYB8Ud0gzC7q59aQn0xa3Tvr1LtK6B0unP\r L195VisT9T5SULAjDWbTT4iwD7i0+baisKGnmb24alUHiJ4B0WsUhGmNtSWpB2vyT4jWJTEOB2vy\r TzTWlqRSEKaB6DUQPWP0GUmX/ZqYCPtgNv3E4aDAnCWUlFU+zWJz6WZ3+1THjlB/rk4hevDtcE2S\r 3knJ2Rimp9WHLDbXuqSs8mmidRi6S4uZyWovOwrmLwD6iBT+oKFm/b/0N5+kzPIfa5pnNZhiAdzB\r QNahLSVb/KRRtJmGJcO1N9YfzMlwZRCwGcAnIP5AUUx1A5mTa7WXLmeNYgG+C0TRDTXFPyAiwzZo\r s2gBvpC05plJzPx9AN8HGKzRhwD6HexY0yYwYwlwqR6J6D7RZZNIBgoR7mNmE4AYMGJY0w4MJB9N\r owKA7wYAMCNpzTOTAHwiunwDxdgDFzs8V6zwS8QDekfGJvr0imOGXIZHYlh6tt+e7buvXOVPPfzN\r aBg72IGvND4rXwwkl2AFXo2BmMBBchltiRFJcewJJnBQV8cf0LN994Or/IkNHewM/RgbMiJ4g/tC\r x2sa4U6N+S5m/GUg+by+cd3JJHtZGoiOcUjIscbn886LLptEMhD2Oh5rB3CnZe2Gm6itbQqYp7y+\r cd1Jqirud14M7CeivytEHymMj80jgo6LLp8v/H/2JtLuKnKEuwAAACV0RVh0ZGF0ZTpjcmVhdGUA\r MjAxOS0wOC0wMlQwMDo0NDo0Ni0wNzowME81FnUAAAAldEVYdGRhdGU6bW9kaWZ5ADIwMTktMDgt\r MDJUMDA6NDQ6NDYtMDc6MDA+aK7JAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccll\r PAAAAABJRU5ErkJggg==" })
);

var sliderArrow2 = wp.element.createElement(
  "svg",
  { version: "1.1", id: "sliderArrow2", x: "0px", y: "0px", width: "89.035px", height: "34.786px", viewBox: "-9.437 -4.943 89.035 34.786", enableBackground: "new -9.437 -4.943 89.035 34.786" },
  wp.element.createElement("rect", { x: "-9.437", y: "-4.943", fill: "#FFFFFF", width: "89.035", height: "34.786" }),
  wp.element.createElement("path", { fill: "#7B8080", d: "M51.233,19.948c-0.175,0-0.355-0.068-0.491-0.204c-0.271-0.271-0.271-0.714,0-0.983l6.302-6.311L50.742,6.14\r c-0.271-0.272-0.271-0.712,0-0.983c0.272-0.272,0.713-0.272,0.985,0l6.792,6.799c0.272,0.273,0.272,0.714,0,0.985l-6.792,6.8\r C51.59,19.879,51.414,19.948,51.233,19.948z" }),
  wp.element.createElement("path", { fill: "#7B8080", d: "M18.924,4.954c0.177,0,0.356,0.067,0.492,0.205c0.271,0.27,0.271,0.711,0,0.983l-6.302,6.309l6.302,6.309\r c0.271,0.271,0.271,0.712,0,0.981c-0.272,0.272-0.713,0.272-0.985,0l-6.792-6.798c-0.271-0.273-0.271-0.714,0-0.984l6.792-6.798\r C18.566,5.021,18.746,4.954,18.924,4.954z" })
);

var sliderArrow3 = wp.element.createElement(
  "svg",
  { version: "1.1", id: "sliderArrow3", x: "0px", y: "0px", width: "76.66px", height: "30.978px", viewBox: "0 0 76.66 30.978", enableBackground: "new 0 0 76.66 30.978" },
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement("path", { fill: "#7B8080", d: "M61.281,30.978c-8.479,0-15.378-6.898-15.378-15.378c0-8.48,6.898-15.379,15.378-15.379\r c8.48,0,15.379,6.898,15.379,15.379C76.66,24.08,69.761,30.978,61.281,30.978z M61.281,1.264\r c-7.904,0-14.335,6.431-14.335,14.336c0,7.903,6.431,14.335,14.335,14.335c7.906,0,14.336-6.432,14.336-14.335\r C75.617,7.695,69.187,1.264,61.281,1.264z" }),
        wp.element.createElement("path", { fill: "#7B8080", d: "M59.35,21c-0.133,0-0.267-0.051-0.368-0.154c-0.203-0.201-0.203-0.533,0-0.736l4.726-4.731l-4.726-4.73\r c-0.203-0.204-0.203-0.534,0-0.737c0.204-0.204,0.534-0.204,0.738,0l5.093,5.099c0.204,0.204,0.204,0.534,0,0.738l-5.093,5.099\r C59.618,20.949,59.484,21,59.35,21z" })
      )
    ),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement("path", { fill: "#7B8080", d: "M15.378,0c8.48,0,15.379,6.898,15.379,15.378c0,8.481-6.898,15.379-15.379,15.379\r C6.898,30.757,0,23.859,0,15.378C0,6.898,6.898,0,15.378,0z M15.378,29.714c7.904,0,14.336-6.432,14.336-14.336\r c0-7.903-6.432-14.335-14.336-14.335c-7.905,0-14.335,6.432-14.335,14.335C1.043,23.283,7.473,29.714,15.378,29.714z" }),
        wp.element.createElement("path", { fill: "#7B8080", d: "M17.31,9.979c0.133,0,0.267,0.05,0.368,0.153c0.204,0.203,0.204,0.534,0,0.737L12.953,15.6l4.725,4.729\r c0.203,0.204,0.203,0.535,0,0.738c-0.204,0.203-0.534,0.203-0.737,0l-5.093-5.099c-0.204-0.204-0.204-0.534,0-0.738l5.093-5.098\r C17.042,10.029,17.176,9.979,17.31,9.979z" })
      )
    )
  )
);

var sliderArrow4 = wp.element.createElement(
  "svg",
  { version: "1.1", id: "sliderArrow4", x: "0px", y: "0px", width: "72.805px", height: "13.751px", viewBox: "0 0 72.805 13.751", enableBackground: "new 0 0 72.805 13.751" },
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("path", { fill: "#7B8080", d: "M72.626,6.412L65.75,0.144c-0.191-0.155-0.4-0.185-0.627-0.09c-0.227,0.096-0.34,0.269-0.34,0.52v4.011\r H42.436c-0.168,0-0.305,0.055-0.412,0.162s-0.161,0.244-0.161,0.411v3.439c0,0.166,0.054,0.305,0.161,0.41\r c0.107,0.107,0.244,0.162,0.412,0.162h22.348v4.012c0,0.238,0.113,0.412,0.34,0.518c0.227,0.096,0.436,0.061,0.627-0.105\r l6.876-6.34c0.12-0.119,0.179-0.263,0.179-0.43C72.805,6.668,72.745,6.531,72.626,6.412z" })
    ),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("path", { fill: "#7B8080", d: "M0.179,7.339l6.876,6.267c0.191,0.156,0.4,0.186,0.627,0.09s0.34-0.268,0.34-0.52v-4.01h22.348\r c0.168,0,0.305-0.055,0.412-0.162s0.161-0.244,0.161-0.412V5.155c0-0.166-0.054-0.305-0.161-0.411\r c-0.107-0.107-0.244-0.161-0.412-0.161H8.021V0.571c0-0.238-0.113-0.412-0.34-0.519c-0.227-0.096-0.436-0.06-0.627,0.106\r l-6.876,6.34C0.059,6.618,0,6.761,0,6.928C0,7.083,0.06,7.22,0.179,7.339z" })
    )
  )
);

var sliderArrow5 = wp.element.createElement(
  "svg",
  { version: "1.1", id: "sliderArrow5", x: "0px", y: "0px", width: "95.715px", height: "28.115px", viewBox: "0 0 95.715 28.115", enableBackground: "new 0 0 95.715 28.115" },
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("path", { fill: "#7B8080", d: "M38.448,25.207c0,1.605-1.636,2.908-3.654,2.908H3.654C1.636,28.115,0,26.812,0,25.207V2.907\r C0,1.302,1.636,0,3.654,0h31.14c2.019,0,3.654,1.302,3.654,2.907V25.207z" }),
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement("path", { fill: "#FFFFFF", d: "M26.346,13.383H13.731l3.01-3.01c0.264-0.264,0.264-0.691,0-0.955s-0.691-0.264-0.954,0l-4.162,4.162\r c-0.264,0.264-0.264,0.691,0,0.955l4.162,4.162c0.132,0.133,0.305,0.199,0.478,0.199c0.172,0,0.345-0.066,0.477-0.199\r c0.264-0.264,0.264-0.691,0-0.953l-3.01-3.012h12.614c0.372,0,0.675-0.301,0.675-0.674S26.718,13.383,26.346,13.383z" })
      )
    ),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("path", { fill: "#7B8080", d: "M95.715,25.207c0,1.605-1.636,2.908-3.654,2.908h-31.14c-2.019,0-3.654-1.303-3.654-2.908V2.907\r C57.267,1.302,58.902,0,60.921,0h31.14c2.019,0,3.654,1.302,3.654,2.907V25.207z" }),
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement("path", { fill: "#FFFFFF", d: "M69.368,14.734h12.615l-3.01,3.01c-0.264,0.264-0.264,0.691,0,0.955s0.691,0.264,0.953,0l4.162-4.163\r c0.264-0.264,0.264-0.691,0-0.955l-4.162-4.162C79.796,9.286,79.622,9.22,79.45,9.22s-0.346,0.066-0.477,0.199\r c-0.264,0.264-0.264,0.691,0,0.953l3.01,3.012H69.368c-0.371,0-0.674,0.301-0.674,0.674S68.997,14.734,69.368,14.734z" })
      )
    )
  )
);

var sliderArrow6 = wp.element.createElement(
  "svg",
  { version: "1.1", id: "sliderArrow6", x: "0px", y: "0px", width: "89.032px", height: "34.786px", viewBox: "0 0 89.032 34.786", enableBackground: "new 0 0 89.032 34.786" },
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("circle", { fill: "#7B8080", cx: "71.75", cy: "17.283", r: "17.283" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M69.458,23.952c-0.157,0-0.316-0.06-0.437-0.182c-0.241-0.24-0.241-0.635,0-0.875l5.607-5.614\r l-5.607-5.613c-0.241-0.242-0.241-0.634,0-0.875c0.242-0.242,0.634-0.242,0.876,0l6.043,6.05c0.242,0.242,0.242,0.634,0,0.876\r l-6.043,6.049C69.775,23.892,69.617,23.952,69.458,23.952z" })
    ),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("circle", { fill: "#7B8080", cx: "17.283", cy: "17.503", r: "17.283" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M19.573,10.875c0.158,0,0.317,0.06,0.438,0.182c0.241,0.24,0.241,0.633,0,0.875l-5.607,5.614l5.607,5.612\r c0.241,0.242,0.241,0.634,0,0.874c-0.242,0.242-0.634,0.242-0.876,0l-6.043-6.049c-0.242-0.243-0.242-0.634,0-0.875l6.043-6.049\r C19.255,10.934,19.415,10.875,19.573,10.875z" })
    )
  )
);

var sliderArrow7 = wp.element.createElement(
  "svg",
  { version: "1.0", xmlns: "http://www.w3.org/2000/svg",
    width: "126.000000pt", height: "59.000000pt", viewBox: "0 0 126.000000 59.000000",
    preserveAspectRatio: "xMidYMid meet" },
  wp.element.createElement(
    "g",
    { transform: "translate(0.000000,59.000000) scale(0.100000,-0.100000)",
      fill: "#ab3192", stroke: "none" },
    wp.element.createElement("path", { d: "M174 571 c-60 -27 -119 -84 -148 -144 -33 -66 -36 -188 -7 -253 27\r -60 84 -119 144 -148 73 -37 191 -37 264 0 60 29 117 88 144 148 29 65 26 187\r -7 253 -29 60 -88 117 -148 144 -57 26 -185 26 -242 0z m246 -38 c103 -53 164\r -175 142 -282 -23 -111 -93 -186 -201 -218 -180 -52 -371 123 -333 306 22 106\r 84 177 185 213 67 24 134 17 207 -19z" }),
    wp.element.createElement("path", { d: "M192 357 l-62 -63 63 -62 c34 -34 66 -62 70 -62 18 0 3 28 -35 67\r l-42 43 132 0 c111 0 132 2 132 15 0 13 -21 15 -132 15 l-132 0 42 43 c39 40\r 53 67 34 67 -4 0 -36 -28 -70 -63z" }),
    wp.element.createElement("path", { d: "M844 571 c-60 -27 -119 -84 -148 -144 -33 -66 -36 -188 -7 -253 27\r -60 84 -119 144 -148 73 -37 191 -37 264 0 60 29 117 88 144 148 29 65 26 187\r -7 253 -29 60 -88 117 -148 144 -57 26 -185 26 -242 0z m246 -38 c103 -53 164\r -175 142 -282 -23 -111 -93 -186 -201 -218 -180 -52 -371 123 -333 306 22 106\r 84 177 185 213 67 24 134 17 207 -19z" }),
    wp.element.createElement("path", { d: "M990 408 c0 -7 19 -32 42 -55 l42 -43 -132 0 c-111 0 -132 -2 -132\r -15 0 -13 21 -15 132 -15 l132 0 -42 -43 c-39 -40 -53 -67 -34 -67 4 0 36 28\r 70 63 l62 63 -63 62 c-63 63 -77 72 -77 50z" })
  )
);

var sliderArrow8 = wp.element.createElement(
  "svg",
  { version: "1.0", xmlns: "http://www.w3.org/2000/svg",
    width: "126.000000pt", height: "59.000000pt", viewBox: "0 0 126.000000 59.000000",
    preserveAspectRatio: "xMidYMid meet" },
  wp.element.createElement(
    "g",
    { transform: "translate(0.000000,59.000000) scale(0.100000,-0.100000)",
      fill: "#ffffff", stroke: "none" },
    wp.element.createElement("path", { d: "M174 571 c-60 -27 -119 -84 -148 -144 -33 -66 -36 -188 -7 -253 27\r -60 84 -119 144 -148 73 -37 191 -37 264 0 60 29 117 88 144 148 29 65 26 187\r -7 253 -29 60 -88 117 -148 144 -57 26 -185 26 -242 0z m246 -38 c103 -53 164\r -175 142 -282 -23 -111 -93 -186 -201 -218 -180 -52 -371 123 -333 306 22 106\r 84 177 185 213 67 24 134 17 207 -19z" }),
    wp.element.createElement("path", { d: "M192 357 l-62 -63 63 -62 c34 -34 66 -62 70 -62 18 0 3 28 -35 67\r l-42 43 132 0 c111 0 132 2 132 15 0 13 -21 15 -132 15 l-132 0 42 43 c39 40\r 53 67 34 67 -4 0 -36 -28 -70 -63z" }),
    wp.element.createElement("path", { d: "M844 571 c-60 -27 -119 -84 -148 -144 -33 -66 -36 -188 -7 -253 27\r -60 84 -119 144 -148 73 -37 191 -37 264 0 60 29 117 88 144 148 29 65 26 187\r -7 253 -29 60 -88 117 -148 144 -57 26 -185 26 -242 0z m246 -38 c103 -53 164\r -175 142 -282 -23 -111 -93 -186 -201 -218 -180 -52 -371 123 -333 306 22 106\r 84 177 185 213 67 24 134 17 207 -19z" }),
    wp.element.createElement("path", { d: "M990 408 c0 -7 19 -32 42 -55 l42 -43 -132 0 c-111 0 -132 -2 -132\r -15 0 -13 21 -15 132 -15 l132 0 -42 -43 c-39 -40 -53 -67 -34 -67 4 0 36 28\r 70 63 l62 63 -63 62 c-63 63 -77 72 -77 50z" })
  )
);

var destinations = wp.element.createElement(
  "svg",
  { version: "1.1", id: "destinations", x: "0px", y: "0px", width: "334px", height: "252.418px", viewBox: "0.59 -19.752 334 252.418", "enable-background": "new 0.59 -19.752 334 252.418" },
  wp.element.createElement("rect", { x: "1.5", y: "1.5", display: "none", fill: "#FFFFFF", stroke: "#7B8080", "stroke-width": "3", "stroke-miterlimit": "10", width: "331", height: "225.5" }),
  wp.element.createElement("rect", { x: "2.09", y: "-18.252", fill: "#FFFFFF", stroke: "#7B8080", "stroke-width": "3", "stroke-miterlimit": "10", width: "331", height: "249.418" }),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("rect", { x: "27.09", y: "14.829", fill: "#7B8080", width: "281", height: "103.152" }),
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement("path", { fill: "#FFFFFF", d: "M185.467,50.069h-35.756c-0.354,0-0.639,0.318-0.639,0.71v31.25c0,0.394,0.285,0.71,0.639,0.71h35.756\r c0.354,0,0.641-0.317,0.641-0.71V50.779C186.106,50.387,185.819,50.069,185.467,50.069z M184.828,81.319h-34.48v-29.83h34.48\r V81.319L184.828,81.319z" }),
        wp.element.createElement("path", { fill: "#FFFFFF", d: "M159.288,65.792c1.961,0,3.557-1.775,3.557-3.955c0-2.182-1.596-3.956-3.557-3.956\r s-3.557,1.774-3.557,3.956C155.731,64.017,157.328,65.792,159.288,65.792z M159.288,59.301c1.256,0,2.278,1.138,2.278,2.535\r c0,1.397-1.021,2.536-2.278,2.536s-2.279-1.137-2.279-2.534S158.032,59.301,159.288,59.301z" }),
        wp.element.createElement("path", { fill: "#FFFFFF", d: "M153.542,78.479c0.147,0,0.299-0.059,0.421-0.177l10.417-10.201l6.578,7.316\r c0.25,0.277,0.654,0.277,0.9,0c0.252-0.278,0.252-0.727,0-1.004l-3.066-3.415l5.863-7.14l7.189,7.331\r c0.258,0.266,0.662,0.246,0.9-0.043c0.238-0.291,0.221-0.739-0.037-1.003l-7.664-7.813c-0.127-0.127-0.293-0.191-0.459-0.186\r c-0.17,0.008-0.33,0.091-0.445,0.23l-6.252,7.619l-3.028-3.369c-0.239-0.265-0.621-0.278-0.875-0.033l-10.866,10.641\r c-0.265,0.259-0.291,0.708-0.058,1.003C153.187,78.398,153.364,78.479,153.542,78.479z" })
      )
    ),
    wp.element.createElement("rect", { x: "91.089", y: "146.253", fill: "#7B8080", width: "153.001", height: "11" }),
    wp.element.createElement("rect", { x: "115.436", y: "188.753", fill: "#7B8080", width: "104.306", height: "9.333" })
  )
);

var keyContacts = wp.element.createElement(
  "svg",
  { version: "1.1", id: "keyContacts", x: "0px", y: "0px", width: "334px", height: "252.417px", viewBox: "-0.75 3.387 334 252.417", enableBackground: "new -0.75 3.387 334 252.417" },
  wp.element.createElement("rect", { x: "0.75", y: "4.887", fill: "#FFFFFF", stroke: "#7B8080", "stroke-width": "3", "stroke-miterlimit": "10", width: "331", height: "249.417" }),
  wp.element.createElement("rect", { x: "22.75", y: "46.78", fill: "#7B8080", width: "150.857", height: "10.956" }),
  wp.element.createElement("rect", { x: "22.75", y: "83.964", fill: "#7B8080", width: "279.272", height: "7.968" }),
  wp.element.createElement("rect", { x: "22.75", y: "103.884", fill: "#7B8080", width: "287", height: "6.641" }),
  wp.element.createElement("rect", { x: "22.75", y: "124.137", fill: "#7B8080", width: "274.558", height: "7.636" }),
  wp.element.createElement("rect", { x: "22.75", y: "143.393", fill: "#7B8080", width: "255.724", height: "7.305" }),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("rect", { x: "22.75", y: "181.999", fill: "#7B8080", width: "97.667", height: "30.412" }),
    wp.element.createElement(
      "text",
      { transform: "matrix(1 0 0 1 36.4192 200.7275)", fill: "#FFFFFF", "font-family": "'TimesNewRomanPSMT'", "font-size": "12" },
      "CLICK HERE"
    )
  )
);

var featuredHappening = wp.element.createElement(
  "svg",
  { version: "1.1", id: "featuredHappening", x: "0px", y: "0px", width: "334px", height: "248.5px", viewBox: "0 0 334 248.5", enableBackground: "new 0 0 334 248.5" },
  wp.element.createElement("rect", { x: "1.5", y: "1.5", fill: "#FFFFFF", stroke: "#7B8080", "stroke-width": "3", "stroke-miterlimit": "10", width: "331", height: "245.5" }),
  wp.element.createElement("rect", { x: "2.23", y: "1.5", fill: "#7B8080", width: "331", height: "91" }),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("path", { fill: "#FFFFFF", d: "M199.842,19.885H134.16c-0.647,0-1.173,0.524-1.173,1.172v51.607c0,0.649,0.524,1.173,1.173,1.173h65.682\r c0.646,0,1.173-0.524,1.173-1.173V21.057C201.014,20.409,200.488,19.885,199.842,19.885z M198.668,71.491h-63.335V22.23h63.335\r V71.491L198.668,71.491z" }),
    wp.element.createElement("path", { fill: "#FFFFFF", d: "M151.753,45.85c3.603,0,6.532-2.93,6.532-6.53c0-3.603-2.93-6.532-6.532-6.532\r c-3.602,0-6.531,2.929-6.531,6.531C145.222,42.92,148.151,45.85,151.753,45.85z M151.753,35.132c2.309,0,4.187,1.879,4.187,4.186\r s-1.878,4.186-4.187,4.186s-4.186-1.878-4.186-4.185C147.567,37.013,149.444,35.132,151.753,35.132z" }),
    wp.element.createElement("path", { fill: "#FFFFFF", d: "M141.197,66.8c0.274,0,0.551-0.096,0.774-0.292l19.133-16.845l12.083,12.082\r c0.459,0.458,1.201,0.458,1.658,0c0.459-0.459,0.459-1.2,0-1.658l-5.638-5.639l10.769-11.792l13.207,12.107\r c0.479,0.438,1.219,0.405,1.657-0.072c0.438-0.478,0.404-1.22-0.071-1.657l-14.076-12.902c-0.23-0.209-0.535-0.314-0.844-0.307\r c-0.312,0.014-0.604,0.151-0.814,0.381l-11.487,12.582l-5.563-5.563c-0.438-0.437-1.14-0.459-1.604-0.052l-19.959,17.573\r c-0.485,0.429-0.533,1.169-0.105,1.656C140.548,66.667,140.872,66.8,141.197,66.8z" })
  ),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("rect", { x: "103.402", y: "123.167", fill: "#7B8080", width: "143.264", height: "11" }),
    wp.element.createElement("rect", { x: "126.2", y: "205.667", fill: "#7B8080", width: "97.667", height: "9.333" }),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("rect", { x: "173.643", y: "158.634", fill: "#7B8080", width: "1.271", height: "20.339" }),
      wp.element.createElement("rect", { x: "211.215", y: "166", fill: "#7B8080", width: "29.715", height: "5.018" }),
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement("path", { fill: "#7B8080", d: "M123.947,172.862l-1.591,2.284l-1.123-0.922c-0.119-0.101-0.3-0.082-0.397,0.039\r c-0.099,0.12-0.084,0.299,0.037,0.4l1.359,1.116c0.051,0.04,0.114,0.063,0.181,0.063c0.014,0,0.026,0,0.04-0.002\r c0.075-0.011,0.148-0.054,0.194-0.116l1.766-2.539c0.088-0.131,0.059-0.308-0.07-0.395\r C124.211,172.7,124.037,172.732,123.947,172.862z" }),
        wp.element.createElement("path", { fill: "#7B8080", d: "M124.18,171.171v-5.539v-2.843c0-0.156-0.126-0.282-0.282-0.282h-1.42v-0.854\r c0-0.158-0.128-0.284-0.286-0.284h-1.989c-0.158,0-0.284,0.126-0.284,0.284v0.854h-6.252v-0.854c0-0.158-0.13-0.284-0.284-0.284\r h-1.995c-0.156,0-0.279,0.126-0.279,0.284v0.854h-1.423c-0.158,0-0.284,0.126-0.284,0.282v2.843v11.654\r c0,0.157,0.126,0.284,0.284,0.284h10.831c0.568,0.357,1.239,0.568,1.962,0.568c2.034,0,3.694-1.658,3.694-3.694\r C126.169,173.023,125.359,171.785,124.18,171.171z M120.484,161.938h1.423v0.854v0.853h-1.423v-0.853V161.938z M111.676,161.938\r h1.421v0.854v0.853h-1.421v-0.853V161.938z M109.967,163.077h1.139v0.853c0,0.157,0.125,0.284,0.281,0.284h1.995\r c0.154,0,0.284-0.127,0.284-0.284v-0.853h6.252v0.853c0,0.157,0.126,0.284,0.284,0.284h1.989c0.158,0,0.285-0.127,0.285-0.284\r v-0.853h1.137v2.274h-13.646V163.077L109.967,163.077z M109.967,177.003v-11.084h13.646v5.013\r c-0.056-0.019-0.112-0.033-0.171-0.045c-0.053-0.019-0.107-0.029-0.16-0.041c-0.048-0.014-0.1-0.022-0.146-0.029\r c-0.07-0.016-0.14-0.024-0.208-0.034c-0.039-0.005-0.076-0.011-0.119-0.015c-0.107-0.011-0.221-0.018-0.333-0.018\r c-0.1,0-0.19,0.007-0.285,0.018v-0.302v-0.569v-2.558h-2.56h-0.568h-1.99h-0.57h-1.989h-0.565h-2.563v2.558v0.569v1.988v0.569\r v2.56h2.563h0.565h1.989h0.57h1.887c0.006,0.024,0.016,0.047,0.027,0.075c0.023,0.066,0.049,0.137,0.076,0.204\r c0.014,0.038,0.035,0.075,0.047,0.11c0.035,0.07,0.067,0.144,0.108,0.215c0.016,0.03,0.035,0.057,0.05,0.086\r c0.042,0.076,0.087,0.149,0.13,0.222c0.02,0.024,0.038,0.048,0.054,0.075c0.05,0.07,0.104,0.14,0.159,0.209\r c0.021,0.025,0.043,0.048,0.063,0.07c0.042,0.053,0.087,0.106,0.132,0.152L109.967,177.003L109.967,177.003z M120.859,171.129\r c-0.031,0.016-0.063,0.026-0.094,0.042c-0.051,0.029-0.104,0.06-0.155,0.089c-0.047,0.028-0.092,0.053-0.137,0.084\r c-0.041,0.028-0.091,0.055-0.128,0.09c-0.049,0.035-0.102,0.07-0.146,0.104c-0.034,0.034-0.076,0.061-0.11,0.094\r c-0.049,0.043-0.102,0.086-0.146,0.133c-0.033,0.03-0.064,0.061-0.1,0.092c-0.05,0.052-0.099,0.106-0.146,0.162\r c-0.021,0.026-0.041,0.047-0.063,0.07v-1.622h1.99v0.39c-0.006,0.002-0.01,0.002-0.014,0.002\r C121.349,170.921,121.095,171.01,120.859,171.129z M118.942,173.365c-0.011,0.031-0.017,0.066-0.026,0.101\r c-0.022,0.081-0.048,0.164-0.061,0.247c-0.019,0.066-0.024,0.133-0.031,0.2c-0.01,0.053-0.02,0.108-0.027,0.16\r c-0.012,0.123-0.019,0.247-0.019,0.372c0,0.104,0.007,0.207,0.017,0.312c0,0.021,0,0.035,0.002,0.058\r c0.004,0.045,0.014,0.09,0.021,0.138l0,0c0.004,0.021,0.007,0.042,0.007,0.063h-1.751v-1.99h1.991l0,0\r c-0.004,0.009-0.004,0.017-0.007,0.021C119.014,173.15,118.973,173.258,118.942,173.365z M111.958,173.023h1.992v1.992h-1.992\r V173.023z M111.958,170.466h1.992v1.988h-1.992V170.466z M121.622,169.895h-1.99v-1.988h1.99V169.895z M119.064,169.895h-1.99\r v-1.988h1.99V169.895z M119.064,172.454h-1.99v-1.988h1.99V172.454z M114.514,170.466h1.989v1.988h-1.989V170.466z\r M116.503,169.895h-1.989v-1.988h1.989V169.895z M113.948,169.895h-1.994v-1.988h1.994V169.895z M114.514,173.023h1.989v1.992\r h-1.989V173.023z M122.478,177.57c-0.647,0-1.241-0.194-1.737-0.527c-0.097-0.066-0.188-0.136-0.274-0.212\r c-0.034-0.024-0.063-0.052-0.09-0.08c-0.061-0.053-0.112-0.104-0.164-0.157c-0.034-0.037-0.064-0.07-0.1-0.106\r c-0.042-0.054-0.091-0.108-0.132-0.168c-0.027-0.035-0.057-0.07-0.08-0.106c-0.063-0.09-0.122-0.186-0.177-0.281\r c-0.011-0.022-0.022-0.047-0.033-0.068c-0.043-0.083-0.079-0.166-0.115-0.248c-0.013-0.036-0.026-0.075-0.04-0.112\r c-0.026-0.073-0.048-0.149-0.073-0.226c-0.006-0.021-0.01-0.036-0.013-0.053c-0.033-0.125-0.057-0.252-0.073-0.375\r c-0.003-0.01-0.003-0.019-0.006-0.028c-0.014-0.126-0.023-0.253-0.023-0.38c0-0.106,0.006-0.211,0.016-0.318\r c0-0.008,0.004-0.018,0.004-0.025c0.01-0.099,0.026-0.192,0.046-0.289c0-0.011,0.004-0.018,0.007-0.026\r c0.02-0.097,0.043-0.188,0.073-0.282c0.003-0.011,0.007-0.021,0.01-0.031c0.033-0.091,0.063-0.177,0.099-0.265\r c0.038-0.079,0.076-0.159,0.116-0.238l0.03-0.048c0.011-0.021,0.024-0.039,0.036-0.063c0.05-0.082,0.103-0.162,0.158-0.241\r c0.014-0.019,0.029-0.037,0.044-0.056c0.054-0.069,0.105-0.135,0.162-0.196c0.017-0.022,0.04-0.044,0.056-0.063\r c0.057-0.06,0.116-0.115,0.176-0.171c0.021-0.021,0.043-0.037,0.066-0.058c0.07-0.061,0.143-0.116,0.219-0.172\r c0.01-0.01,0.021-0.018,0.035-0.026c0.375-0.255,0.798-0.433,1.254-0.508l0.007-0.005c0.17-0.027,0.336-0.045,0.517-0.045\r c0.108,0,0.22,0.008,0.327,0.021c0.018,0,0.035,0.005,0.049,0.008c0.094,0.012,0.185,0.025,0.277,0.045\r c0.013,0,0.025,0.008,0.034,0.008c0.102,0.021,0.196,0.05,0.292,0.082c0.007,0,0.015,0.004,0.021,0.006\r c0.096,0.033,0.193,0.072,0.292,0.113c1.079,0.493,1.834,1.584,1.834,2.847C125.6,176.17,124.197,177.57,122.478,177.57z" })
      ),
      wp.element.createElement("rect", { x: "131.139", y: "166.95", fill: "#7B8080", width: "29.715", height: "5.019" }),
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement(
          "g",
          null,
          wp.element.createElement(
            "g",
            null,
            wp.element.createElement("rect", { x: "185.998", y: "165.389", fill: "#7B8080", width: "2.443", height: "1.243" })
          )
        ),
        wp.element.createElement(
          "g",
          null,
          wp.element.createElement(
            "g",
            null,
            wp.element.createElement("rect", { x: "185.998", y: "170.373", fill: "#7B8080", width: "2.443", height: "1.244" })
          )
        ),
        wp.element.createElement(
          "g",
          null,
          wp.element.createElement(
            "g",
            null,
            wp.element.createElement("rect", { x: "184.85", y: "167.878", fill: "#7B8080", width: "3.593", height: "1.249" })
          )
        ),
        wp.element.createElement(
          "g",
          null,
          wp.element.createElement(
            "g",
            null,
            wp.element.createElement("path", { fill: "#7B8080", d: "M197.906,160.284c-4.529,0-8.219,3.688-8.219,8.221c0,4.531,3.689,8.218,8.219,8.218\r c4.533,0,8.221-3.687,8.221-8.218C206.127,163.973,202.44,160.284,197.906,160.284z M197.906,175.475\r c-3.844,0-6.971-3.125-6.971-6.97c0-3.846,3.129-6.972,6.971-6.972s6.973,3.126,6.973,6.972\r C204.879,172.35,201.752,175.475,197.906,175.475z" })
          )
        ),
        wp.element.createElement(
          "g",
          null,
          wp.element.createElement(
            "g",
            null,
            wp.element.createElement("polygon", { fill: "#7B8080", points: "198.311,168.813 198.311,164.785 197.063,164.785 197.063,169.473 200.278,171.661 200.979,170.629" })
          )
        )
      )
    )
  )
);

var productCategories = wp.element.createElement(
  "svg",
  { version: "1.1", id: "productCategories", x: "0px", y: "0px", width: "334px", height: "248.5px", viewBox: "0 0 334 248.5", "enable-background": "new 0 0 334 248.5" },
  wp.element.createElement("rect", { x: "1.5", y: "1.5", fill: "#FFFFFF", stroke: "#7B8080", "stroke-width": "3", "stroke-miterlimit": "10", width: "331", height: "245.5" }),
  wp.element.createElement("rect", { x: "1.866", y: "0.806", fill: "#7B8080", width: "331", height: "245.5" }),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("path", { fill: "#FFFFFF", d: "M200.207,96.579h-65.682c-0.647,0-1.173,0.524-1.173,1.173v51.606c0,0.649,0.524,1.173,1.173,1.173h65.682\r c0.646,0,1.172-0.523,1.172-1.173V97.752C201.379,97.104,200.854,96.579,200.207,96.579z M199.033,148.186h-63.335V98.925h63.335\r V148.186L199.033,148.186z" }),
    wp.element.createElement("path", { fill: "#FFFFFF", d: "M152.118,122.545c3.603,0,6.532-2.931,6.532-6.53c0-3.604-2.93-6.532-6.532-6.532\r c-3.602,0-6.531,2.929-6.531,6.531C145.586,119.614,148.516,122.545,152.118,122.545z M152.118,111.826\r c2.309,0,4.187,1.879,4.187,4.187c0,2.307-1.878,4.186-4.187,4.186s-4.186-1.878-4.186-4.185\r C147.932,113.708,149.809,111.826,152.118,111.826z" }),
    wp.element.createElement("path", { fill: "#FFFFFF", d: "M141.562,143.494c0.274,0,0.551-0.096,0.774-0.292l19.133-16.845l12.083,12.082\r c0.459,0.458,1.201,0.458,1.658,0c0.459-0.459,0.459-1.2,0-1.658l-5.639-5.639l10.77-11.792l13.207,12.107\r c0.479,0.438,1.219,0.404,1.656-0.072c0.439-0.479,0.404-1.22-0.07-1.657l-14.076-12.902c-0.23-0.209-0.535-0.313-0.844-0.307\r c-0.313,0.014-0.605,0.151-0.814,0.381l-11.488,12.582l-5.563-5.563c-0.438-0.438-1.14-0.459-1.604-0.053l-19.959,17.573\r c-0.485,0.429-0.533,1.169-0.105,1.656C140.913,143.361,141.237,143.494,141.562,143.494z" })
  )
);

var exhibitorResources = wp.element.createElement(
  "svg",
  { version: "1.1", id: "exhibitorResources", width: "334px", height: "248.5px", viewBox: "0 2 334 248.5", "enable-background": "new 0 2 334 248.5" },
  wp.element.createElement("rect", { x: "1.5", y: "3.5", fill: "#FFFFFF", stroke: "#7B8080", "stroke-width": "3", "stroke-miterlimit": "10", width: "331", height: "245.5" }),
  wp.element.createElement("rect", { x: "2.23", y: "3.5", fill: "#7B8080", width: "331", height: "91" }),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("path", { fill: "#FFFFFF", d: "M199.842,21.885H134.16c-0.647,0-1.174,0.524-1.174,1.172v51.607c0,0.649,0.524,1.173,1.174,1.173h65.682\r c0.646,0,1.173-0.524,1.173-1.173V23.057C201.014,22.409,200.488,21.885,199.842,21.885z M198.668,73.491h-63.335V24.23h63.335\r V73.491L198.668,73.491z" }),
    wp.element.createElement("path", { fill: "#FFFFFF", d: "M151.753,47.85c3.603,0,6.532-2.93,6.532-6.53c0-3.603-2.931-6.532-6.532-6.532\r c-3.603,0-6.531,2.929-6.531,6.531C145.222,44.92,148.151,47.85,151.753,47.85z M151.753,37.132c2.309,0,4.187,1.879,4.187,4.186\r s-1.878,4.186-4.187,4.186c-2.31,0-4.187-1.878-4.187-4.185C147.567,39.013,149.444,37.132,151.753,37.132z" }),
    wp.element.createElement("path", { fill: "#FFFFFF", d: "M141.197,68.8c0.274,0,0.552-0.096,0.774-0.292l19.133-16.845l12.083,12.082\r c0.459,0.458,1.201,0.458,1.658,0c0.459-0.459,0.459-1.2,0-1.658l-5.638-5.639l10.769-11.792l13.207,12.107\r c0.479,0.438,1.219,0.405,1.657-0.072c0.438-0.478,0.404-1.22-0.071-1.657l-14.076-12.902c-0.229-0.209-0.534-0.314-0.844-0.307\r c-0.312,0.014-0.604,0.151-0.813,0.381l-11.487,12.582l-5.563-5.563c-0.438-0.437-1.14-0.459-1.604-0.052l-19.959,17.573\r c-0.485,0.429-0.533,1.169-0.105,1.656C140.548,68.667,140.872,68.8,141.197,68.8z" })
  ),
  wp.element.createElement("rect", { x: "23.862", y: "121.257", fill: "#7B8080", width: "101.739", height: "7.389" }),
  wp.element.createElement("rect", { x: "23.862", y: "146.333", fill: "#7B8080", width: "188.343", height: "5.375" }),
  wp.element.createElement("rect", { x: "23.862", y: "159.768", fill: "#7B8080", width: "193.554", height: "4.479" }),
  wp.element.createElement("rect", { x: "23.862", y: "173.427", fill: "#7B8080", width: "185.164", height: "5.149" }),
  wp.element.createElement("rect", { x: "23.862", y: "186.413", fill: "#7B8080", width: "172.462", height: "4.927" }),
  wp.element.createElement("rect", { x: "23.862", y: "212.45", fill: "#7B8080", width: "65.867", height: "7.926" })
);

var browseHappening = wp.element.createElement(
  "svg",
  { version: "1.1", id: "browseHappening", x: "0px", y: "0px", width: "334px", height: "252.417px", viewBox: "0 0 334 252.417", "enable-background": "new 0 0 334 252.417" },
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("rect", { x: "0.449", y: "28.889", fill: "#7B8080", width: "156.403", height: "11.358" }),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("rect", { x: "0.449", y: "69.527", fill: "#7B8080", width: "91.533", height: "67.891" }),
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement("path", { fill: "#FFFFFF", d: "M55.298,96.012H37.134c-0.179,0-0.324,0.144-0.324,0.324v14.271c0,0.18,0.145,0.324,0.324,0.324h18.164\r c0.178,0,0.324-0.145,0.324-0.324V96.335C55.622,96.156,55.476,96.012,55.298,96.012z M54.973,110.283H37.458V96.66h17.515\r V110.283L54.973,110.283z" }),
        wp.element.createElement("path", { fill: "#FFFFFF", d: "M41.999,103.192c0.996,0,1.807-0.811,1.807-1.806c0-0.997-0.811-1.807-1.807-1.807\r s-1.806,0.811-1.806,1.807C40.193,102.381,41.003,103.192,41.999,103.192z M41.999,100.228c0.639,0,1.157,0.52,1.157,1.157\r c0,0.638-0.519,1.158-1.157,1.158s-1.157-0.52-1.157-1.158C40.842,100.748,41.36,100.228,41.999,100.228z" }),
        wp.element.createElement("path", { fill: "#FFFFFF", d: "M39.079,108.985c0.077,0,0.153-0.026,0.215-0.08l5.291-4.658l3.342,3.341\r c0.126,0.126,0.332,0.126,0.458,0c0.127-0.127,0.127-0.333,0-0.459l-1.56-1.56l2.979-3.261l3.652,3.349\r c0.132,0.121,0.337,0.112,0.457-0.021c0.122-0.132,0.112-0.337-0.019-0.458l-3.893-3.569c-0.063-0.057-0.148-0.086-0.233-0.085\r c-0.086,0.004-0.168,0.042-0.225,0.106l-3.177,3.479l-1.539-1.539c-0.12-0.121-0.315-0.127-0.443-0.015l-5.52,4.859\r c-0.134,0.12-0.147,0.323-0.029,0.458C38.9,108.948,38.99,108.985,39.079,108.985z" })
      )
    ),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("rect", { x: "123.194", y: "69.527", fill: "#7B8080", width: "91.533", height: "67.889" }),
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement("path", { fill: "#FFFFFF", d: "M178.042,96.011h-18.163c-0.179,0-0.324,0.145-0.324,0.325v14.271c0,0.18,0.146,0.325,0.324,0.325h18.163\r c0.18,0,0.326-0.145,0.326-0.325V96.336C178.368,96.157,178.222,96.011,178.042,96.011z M177.719,110.283h-17.515V96.66h17.515\r V110.283L177.719,110.283z" }),
        wp.element.createElement("path", { fill: "#FFFFFF", d: "M164.744,103.192c0.997,0,1.807-0.811,1.807-1.805c0-0.998-0.81-1.808-1.807-1.808\r c-0.996,0-1.807,0.81-1.807,1.807C162.938,102.381,163.748,103.192,164.744,103.192z M164.744,100.229\r c0.64,0,1.159,0.519,1.159,1.157c0,0.638-0.52,1.158-1.159,1.158c-0.638,0-1.158-0.52-1.158-1.157\r C163.586,100.748,164.106,100.229,164.744,100.229z" }),
        wp.element.createElement("path", { fill: "#FFFFFF", d: "M161.825,108.985c0.076,0,0.151-0.026,0.214-0.081l5.292-4.658l3.341,3.341\r c0.128,0.127,0.333,0.127,0.458,0c0.127-0.127,0.127-0.333,0-0.459l-1.559-1.56l2.978-3.26l3.653,3.348\r c0.131,0.121,0.337,0.112,0.457-0.021c0.122-0.132,0.112-0.337-0.019-0.458l-3.894-3.568c-0.063-0.058-0.147-0.087-0.232-0.085\r c-0.087,0.004-0.168,0.042-0.226,0.105l-3.177,3.48l-1.539-1.539c-0.12-0.122-0.314-0.127-0.443-0.015l-5.519,4.859\r c-0.135,0.119-0.148,0.323-0.029,0.458C161.646,108.948,161.735,108.985,161.825,108.985z" })
      )
    ),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("rect", { x: "242.017", y: "69.527", fill: "#7B8080", width: "91.533", height: "67.889" }),
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement("path", { fill: "#FFFFFF", d: "M296.864,96.012h-18.163c-0.18,0-0.325,0.145-0.325,0.324v14.271c0,0.179,0.146,0.324,0.325,0.324h18.163\r c0.179,0,0.325-0.145,0.325-0.324V96.336C297.189,96.157,297.043,96.012,296.864,96.012z M296.54,110.283h-17.515V96.661h17.515\r V110.283L296.54,110.283z" }),
        wp.element.createElement("path", { fill: "#FFFFFF", d: "M283.566,103.192c0.996,0,1.807-0.811,1.807-1.805c0-0.997-0.811-1.807-1.807-1.807\r s-1.806,0.81-1.806,1.806C281.761,102.382,282.57,103.192,283.566,103.192z M283.566,100.229c0.638,0,1.158,0.519,1.158,1.157\r c0,0.638-0.521,1.158-1.158,1.158c-0.639,0-1.158-0.519-1.158-1.157C282.408,100.749,282.928,100.229,283.566,100.229z" }),
        wp.element.createElement("path", { fill: "#FFFFFF", d: "M280.646,108.986c0.078,0,0.154-0.026,0.216-0.081l5.291-4.658l3.341,3.342\r c0.128,0.125,0.333,0.125,0.459,0c0.126-0.127,0.126-0.333,0-0.46l-1.56-1.559l2.978-3.262l3.652,3.349\r c0.132,0.122,0.338,0.111,0.458-0.02c0.122-0.132,0.112-0.337-0.019-0.458l-3.894-3.568c-0.063-0.058-0.147-0.086-0.232-0.085\r c-0.087,0.004-0.168,0.042-0.225,0.106l-3.177,3.479l-1.54-1.538c-0.12-0.121-0.314-0.127-0.443-0.015l-5.519,4.859\r c-0.135,0.119-0.148,0.323-0.029,0.458C280.468,108.948,280.557,108.986,280.646,108.986z" })
      )
    ),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("rect", { x: "0.611", y: "155.64", fill: "#7B8080", width: "91.533", height: "67.889" }),
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement("path", { fill: "#FFFFFF", d: "M55.46,182.125H37.296c-0.179,0-0.324,0.145-0.324,0.324v14.27c0,0.182,0.146,0.326,0.324,0.326H55.46\r c0.179,0,0.324-0.145,0.324-0.326v-14.27C55.784,182.269,55.639,182.125,55.46,182.125z M55.136,196.394H37.621v-13.621h17.515\r V196.394L55.136,196.394z" }),
        wp.element.createElement("path", { fill: "#FFFFFF", d: "M42.161,189.304c0.996,0,1.807-0.811,1.807-1.805c0-0.998-0.811-1.809-1.807-1.809\r s-1.806,0.811-1.806,1.807S41.165,189.304,42.161,189.304z M42.161,186.341c0.64,0,1.158,0.52,1.158,1.156\r c0,0.639-0.519,1.158-1.158,1.158c-0.639,0-1.158-0.52-1.158-1.158C41.003,186.861,41.522,186.341,42.161,186.341z" }),
        wp.element.createElement("path", { fill: "#FFFFFF", d: "M39.241,195.097c0.077,0,0.152-0.025,0.215-0.08l5.291-4.658l3.341,3.342\r c0.128,0.127,0.333,0.127,0.459,0c0.127-0.127,0.127-0.334,0-0.459l-1.559-1.561l2.978-3.26l3.653,3.348\r c0.131,0.121,0.337,0.111,0.457-0.02c0.122-0.133,0.111-0.336-0.019-0.459l-3.894-3.566c-0.063-0.059-0.147-0.088-0.232-0.086\r c-0.087,0.004-0.169,0.041-0.226,0.105l-3.177,3.48l-1.539-1.539c-0.12-0.121-0.314-0.127-0.443-0.016l-5.519,4.859\r c-0.135,0.119-0.148,0.322-0.029,0.459C39.063,195.06,39.152,195.097,39.241,195.097z" })
      )
    ),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("rect", { x: "125.343", y: "155.64", fill: "#7B8080", width: "91.534", height: "67.889" }),
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement("path", { fill: "#FFFFFF", d: "M180.191,182.125h-18.164c-0.178,0-0.324,0.145-0.324,0.324v14.27c0,0.182,0.146,0.326,0.324,0.326\r h18.164c0.18,0,0.325-0.145,0.325-0.326v-14.27C180.517,182.271,180.371,182.125,180.191,182.125z M179.867,196.396h-17.514\r v-13.621h17.514V196.396L179.867,196.396z" }),
        wp.element.createElement("path", { fill: "#FFFFFF", d: "M166.894,189.304c0.996,0,1.806-0.809,1.806-1.805s-0.81-1.807-1.806-1.807s-1.807,0.811-1.807,1.807\r S165.897,189.304,166.894,189.304z M166.894,186.341c0.64,0,1.158,0.52,1.158,1.158c0,0.637-0.519,1.158-1.158,1.158\r c-0.639,0-1.159-0.521-1.159-1.158C165.734,186.861,166.255,186.341,166.894,186.341z" }),
        wp.element.createElement("path", { fill: "#FFFFFF", d: "M163.974,195.099c0.076,0,0.151-0.027,0.214-0.082l5.292-4.658l3.341,3.342\r c0.128,0.127,0.332,0.127,0.46,0c0.126-0.127,0.126-0.332,0-0.459l-1.56-1.559l2.977-3.262l3.653,3.35\r c0.132,0.119,0.338,0.111,0.457-0.021c0.122-0.131,0.111-0.336-0.018-0.457l-3.895-3.568c-0.063-0.059-0.147-0.088-0.232-0.086\r c-0.087,0.004-0.169,0.041-0.225,0.105l-3.178,3.48l-1.538-1.537c-0.12-0.123-0.314-0.129-0.444-0.018l-5.518,4.861\r c-0.136,0.117-0.148,0.322-0.03,0.457C163.795,195.06,163.884,195.099,163.974,195.099z" })
      )
    )
  )
);

var exhibitorAccordion = wp.element.createElement(
  "svg",
  { version: "1.1", id: "exhibitorAccordion", x: "0px", y: "0px", width: "334px", height: "224.726px", viewBox: "0 0 334 224.726", enableBackground: "new 0 0 334 224.726" },
  wp.element.createElement("rect", { x: "1.5", y: "1.5", fill: "#FFFFFF", stroke: "#7B8080", "stroke-width": "3", "stroke-miterlimit": "10", width: "331", height: "221.726" }),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("rect", { x: "2.229", y: "2.226", fill: "#7B8080", width: "331", height: "38" }),
    wp.element.createElement("rect", { x: "23.861", y: "17.531", fill: "#FFFFFF", width: "101.739", height: "7.39" })
  ),
  wp.element.createElement("rect", { x: "23.861", y: "57.333", fill: "#7B8080", width: "264.142", height: "5.375" }),
  wp.element.createElement("rect", { x: "23.861", y: "70.768", fill: "#7B8080", width: "280.139", height: "4.479" }),
  wp.element.createElement("rect", { x: "23.861", y: "84.427", fill: "#7B8080", width: "246.845", height: "5.149" }),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("rect", { x: "1.229", y: "107.226", fill: "#7B8080", width: "331", height: "38" }),
    wp.element.createElement("rect", { x: "22.861", y: "122.531", fill: "#FFFFFF", width: "101.739", height: "7.39" })
  ),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("rect", { x: "1.229", y: "146.226", fill: "#7B8080", width: "331", height: "38" }),
    wp.element.createElement("rect", { x: "22.861", y: "161.531", fill: "#FFFFFF", width: "101.739", height: "7.39" })
  ),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("rect", { x: "1.229", y: "185.226", fill: "#7B8080", width: "331", height: "38" }),
    wp.element.createElement("rect", { x: "22.861", y: "200.531", fill: "#FFFFFF", width: "101.739", height: "7.39" })
  )
);

var exhibitorImageListing = wp.element.createElement(
  "svg",
  { version: "1.1", id: "exhibitorImageListing", x: "0px", y: "0px", width: "334px", height: "224.726px", viewBox: "0 0 334 224.726", enableBackground: "new 0 0 334 224.726" },
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("rect", { y: "0.5", fill: "#7B8080", width: "102.838", height: "66.739" }),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M61.624,26.536H41.216c-0.201,0-0.364,0.142-0.364,0.319v14.029c0,0.177,0.164,0.319,0.364,0.319h20.408\r c0.2,0,0.365-0.143,0.365-0.319v-14.03C61.988,26.677,61.823,26.536,61.624,26.536z M61.258,40.565H41.581V27.173h19.678V40.565\r L61.258,40.565z" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M46.682,33.594c1.119,0,2.03-0.798,2.03-1.776c0-0.979-0.911-1.775-2.03-1.775s-2.03,0.797-2.03,1.775\r C44.652,32.796,45.563,33.594,46.682,33.594z M46.682,30.68c0.718,0,1.299,0.512,1.299,1.138c0,0.627-0.583,1.138-1.299,1.138\r c-0.718,0-1.3-0.511-1.3-1.138C45.382,31.191,45.963,30.68,46.682,30.68z" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M43.402,39.288c0.085,0,0.171-0.025,0.241-0.077l5.945-4.58l3.754,3.284c0.142,0.124,0.373,0.124,0.515,0\r c0.143-0.125,0.143-0.327,0-0.451l-1.752-1.534l3.347-3.205l4.103,3.292c0.148,0.118,0.378,0.11,0.514-0.021\r c0.137-0.13,0.125-0.331-0.022-0.45l-4.374-3.508c-0.071-0.056-0.167-0.084-0.262-0.083c-0.096,0.004-0.188,0.041-0.252,0.104\r l-3.569,3.42l-1.729-1.513c-0.135-0.119-0.354-0.125-0.499-0.014l-6.202,4.776c-0.15,0.119-0.165,0.317-0.032,0.451\r C43.2,39.252,43.302,39.288,43.402,39.288z" })
    )
  ),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("rect", { x: "114.587", y: "0.5", fill: "#7B8080", width: "102.838", height: "66.739" }),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M176.21,26.536h-20.407c-0.201,0-0.364,0.141-0.364,0.318v14.03c0,0.176,0.163,0.318,0.364,0.318h20.407\r c0.2,0,0.364-0.143,0.364-0.318v-14.03C176.574,26.677,176.41,26.536,176.21,26.536z M175.846,40.564h-19.679V27.172h19.679\r V40.564L175.846,40.564z" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M161.269,33.593c1.119,0,2.029-0.797,2.029-1.776c0-0.979-0.91-1.775-2.029-1.775s-2.03,0.797-2.03,1.775\r S160.15,33.593,161.269,33.593z M161.269,30.68c0.717,0,1.299,0.511,1.299,1.137c0,0.627-0.583,1.138-1.299,1.138\r c-0.718,0-1.3-0.511-1.3-1.138C159.969,31.191,160.55,30.68,161.269,30.68z" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M157.988,39.287c0.086,0,0.171-0.024,0.242-0.077l5.945-4.579l3.754,3.284\r c0.142,0.124,0.373,0.124,0.515,0c0.143-0.125,0.143-0.327,0-0.452l-1.752-1.534l3.346-3.205l4.104,3.292\r c0.148,0.119,0.379,0.11,0.514-0.021c0.137-0.13,0.125-0.331-0.021-0.451l-4.374-3.508c-0.071-0.056-0.166-0.084-0.262-0.083\r c-0.097,0.004-0.189,0.041-0.253,0.104l-3.568,3.42l-1.73-1.513c-0.134-0.119-0.354-0.125-0.498-0.015l-6.203,4.776\r c-0.15,0.119-0.165,0.317-0.031,0.45C157.786,39.252,157.889,39.287,157.988,39.287z" })
    )
  ),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("rect", { x: "230.848", y: "0.5", fill: "#7B8080", width: "102.839", height: "66.739" }),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M292.472,26.536h-20.407c-0.201,0-0.365,0.141-0.365,0.318v14.03c0,0.176,0.164,0.318,0.365,0.318h20.407\r c0.2,0,0.363-0.143,0.363-0.318v-14.03C292.835,26.677,292.672,26.536,292.472,26.536z M292.105,40.564h-19.678V27.172h19.678\r V40.564L292.105,40.564z" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M277.53,33.593c1.119,0,2.028-0.797,2.028-1.776c0-0.979-0.909-1.775-2.028-1.775s-2.03,0.797-2.03,1.775\r S276.411,33.593,277.53,33.593z M277.53,30.68c0.717,0,1.299,0.511,1.299,1.137c0,0.627-0.583,1.138-1.299,1.138\r c-0.718,0-1.301-0.511-1.301-1.138C276.229,31.191,276.811,30.68,277.53,30.68z" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M274.249,39.287c0.086,0,0.171-0.024,0.241-0.077l5.944-4.579l3.755,3.284\r c0.142,0.124,0.373,0.124,0.515,0c0.143-0.125,0.143-0.327,0-0.452l-1.753-1.534l3.347-3.205l4.104,3.292\r c0.149,0.119,0.38,0.11,0.514-0.021c0.137-0.13,0.125-0.331-0.021-0.451l-4.374-3.508c-0.071-0.056-0.166-0.084-0.262-0.083\r c-0.097,0.004-0.188,0.041-0.253,0.104l-3.568,3.42l-1.729-1.513c-0.134-0.119-0.354-0.125-0.497-0.015l-6.203,4.776\r c-0.15,0.119-0.165,0.317-0.031,0.45C274.047,39.252,274.149,39.287,274.249,39.287z" })
    )
  ),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("rect", { y: "78.621", fill: "#7B8080", width: "102.838", height: "66.739" }),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M61.624,104.657H41.216c-0.201,0-0.364,0.141-0.364,0.318v14.028c0,0.178,0.164,0.319,0.364,0.319h20.408\r c0.2,0,0.365-0.144,0.365-0.319v-14.03C61.988,104.798,61.823,104.657,61.624,104.657z M61.258,118.687H41.581v-13.393h19.678\r V118.687L61.258,118.687z" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M46.682,111.716c1.119,0,2.03-0.798,2.03-1.776c0-0.98-0.911-1.776-2.03-1.776s-2.03,0.797-2.03,1.776\r C44.652,110.917,45.563,111.716,46.682,111.716z M46.682,108.801c0.718,0,1.299,0.512,1.299,1.137\r c0,0.627-0.583,1.138-1.299,1.138c-0.718,0-1.3-0.511-1.3-1.138C45.382,109.313,45.963,108.801,46.682,108.801z" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M43.402,117.409c0.085,0,0.171-0.025,0.241-0.077l5.945-4.579l3.754,3.283\r c0.142,0.124,0.373,0.124,0.515,0c0.143-0.124,0.143-0.327,0-0.451l-1.752-1.533l3.347-3.206l4.103,3.293\r c0.148,0.118,0.378,0.11,0.514-0.021c0.137-0.129,0.125-0.331-0.022-0.45l-4.374-3.508c-0.071-0.056-0.167-0.083-0.262-0.083\r c-0.096,0.004-0.188,0.041-0.252,0.104l-3.569,3.42l-1.729-1.513c-0.135-0.119-0.354-0.125-0.499-0.014l-6.202,4.776\r c-0.15,0.118-0.165,0.316-0.032,0.45C43.2,117.374,43.302,117.409,43.402,117.409z" })
    )
  ),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("rect", { x: "115.587", y: "78.621", fill: "#7B8080", width: "102.838", height: "66.74" }),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M177.21,104.656h-20.407c-0.201,0-0.364,0.142-0.364,0.318v14.029c0,0.177,0.163,0.318,0.364,0.318h20.407\r c0.2,0,0.364-0.143,0.364-0.318v-14.03C177.574,104.798,177.41,104.656,177.21,104.656z M176.846,118.686h-19.679v-13.392h19.679\r V118.686L176.846,118.686z" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M162.269,111.714c1.119,0,2.029-0.796,2.029-1.775c0-0.979-0.91-1.776-2.029-1.776s-2.03,0.797-2.03,1.776\r C160.239,110.917,161.15,111.714,162.269,111.714z M162.269,108.8c0.717,0,1.299,0.512,1.299,1.138\r c0,0.627-0.583,1.138-1.299,1.138c-0.718,0-1.3-0.511-1.3-1.138C160.969,109.312,161.55,108.8,162.269,108.8z" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M158.988,117.408c0.086,0,0.171-0.024,0.242-0.077l5.945-4.579l3.754,3.284\r c0.142,0.123,0.373,0.123,0.515,0c0.143-0.125,0.143-0.327,0-0.451l-1.752-1.534l3.346-3.205l4.104,3.293\r c0.148,0.118,0.379,0.109,0.514-0.021c0.137-0.13,0.125-0.331-0.021-0.45l-4.374-3.508c-0.071-0.056-0.166-0.084-0.262-0.083\r c-0.097,0.003-0.189,0.041-0.253,0.104l-3.568,3.419l-1.73-1.512c-0.134-0.12-0.354-0.125-0.498-0.015l-6.203,4.776\r c-0.15,0.118-0.165,0.317-0.031,0.451C158.786,117.373,158.889,117.408,158.988,117.408z" })
    )
  ),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("rect", { x: "230.848", y: "78.621", fill: "#7B8080", width: "102.839", height: "66.74" }),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M292.472,104.656h-20.407c-0.201,0-0.365,0.142-0.365,0.318v14.029c0,0.177,0.164,0.318,0.365,0.318\r h20.407c0.2,0,0.363-0.143,0.363-0.318v-14.03C292.835,104.798,292.672,104.656,292.472,104.656z M292.105,118.686h-19.678\r v-13.392h19.678V118.686L292.105,118.686z" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M277.53,111.714c1.119,0,2.028-0.796,2.028-1.775c0-0.979-0.909-1.776-2.028-1.776s-2.03,0.797-2.03,1.776\r C275.5,110.917,276.411,111.714,277.53,111.714z M277.53,108.8c0.717,0,1.299,0.512,1.299,1.138c0,0.627-0.583,1.138-1.299,1.138\r c-0.718,0-1.301-0.511-1.301-1.138C276.229,109.312,276.811,108.8,277.53,108.8z" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M274.249,117.408c0.086,0,0.171-0.024,0.241-0.077l5.944-4.579l3.755,3.284\r c0.142,0.123,0.373,0.123,0.515,0c0.143-0.125,0.143-0.327,0-0.451l-1.753-1.534l3.347-3.205l4.104,3.293\r c0.149,0.118,0.38,0.109,0.514-0.021c0.137-0.13,0.125-0.331-0.021-0.45l-4.374-3.508c-0.071-0.056-0.166-0.084-0.262-0.083\r c-0.097,0.003-0.188,0.041-0.253,0.104l-3.568,3.419l-1.729-1.512c-0.134-0.12-0.354-0.125-0.497-0.015l-6.203,4.776\r c-0.15,0.118-0.165,0.317-0.031,0.451C274.047,117.373,274.149,117.408,274.249,117.408z" })
    )
  ),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("rect", { y: "157.761", fill: "#7B8080", width: "102.838", height: "66.739" }),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M61.624,183.797H41.216c-0.201,0-0.364,0.141-0.364,0.318v14.028c0,0.178,0.164,0.319,0.364,0.319h20.408\r c0.2,0,0.365-0.144,0.365-0.319v-14.03C61.988,183.938,61.823,183.797,61.624,183.797z M61.258,197.826H41.581v-13.393h19.678\r V197.826L61.258,197.826z" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M46.682,190.855c1.119,0,2.03-0.798,2.03-1.776c0-0.98-0.911-1.775-2.03-1.775s-2.03,0.797-2.03,1.775\r S45.563,190.855,46.682,190.855z M46.682,187.94c0.718,0,1.299,0.512,1.299,1.138c0,0.627-0.583,1.138-1.299,1.138\r c-0.718,0-1.3-0.511-1.3-1.138C45.382,188.452,45.963,187.94,46.682,187.94z" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M43.402,196.549c0.085,0,0.171-0.025,0.241-0.077l5.945-4.579l3.754,3.283\r c0.142,0.124,0.373,0.124,0.515,0c0.143-0.124,0.143-0.327,0-0.451l-1.752-1.533l3.347-3.206l4.103,3.293\r c0.148,0.118,0.378,0.11,0.514-0.021c0.137-0.13,0.125-0.33-0.022-0.45l-4.374-3.508c-0.071-0.057-0.167-0.084-0.262-0.084\r c-0.096,0.004-0.188,0.041-0.252,0.104l-3.569,3.42l-1.729-1.514c-0.135-0.118-0.354-0.124-0.499-0.014l-6.202,4.776\r c-0.15,0.118-0.165,0.316-0.032,0.45C43.2,196.514,43.302,196.549,43.402,196.549z" })
    )
  ),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("rect", { x: "115.773", y: "157.76", fill: "#7B8080", width: "102.838", height: "66.74" }),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M177.396,183.796h-20.407c-0.201,0-0.364,0.142-0.364,0.318v14.029c0,0.177,0.163,0.318,0.364,0.318\r h20.407c0.2,0,0.364-0.143,0.364-0.318v-14.03C177.761,183.938,177.597,183.796,177.396,183.796z M177.032,197.825h-19.679\r v-13.392h19.679V197.825L177.032,197.825z" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M162.456,190.854c1.119,0,2.029-0.796,2.029-1.775s-0.91-1.775-2.029-1.775s-2.03,0.797-2.03,1.775\r C160.426,190.058,161.336,190.854,162.456,190.854z M162.456,187.939c0.717,0,1.299,0.512,1.299,1.139s-0.583,1.138-1.299,1.138\r c-0.718,0-1.3-0.511-1.3-1.138S161.737,187.939,162.456,187.939z" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M159.174,196.548c0.086,0,0.171-0.024,0.242-0.077l5.945-4.579l3.754,3.284\r c0.142,0.123,0.373,0.123,0.515,0c0.143-0.125,0.143-0.327,0-0.451l-1.752-1.534l3.346-3.205l4.104,3.292\r c0.148,0.119,0.379,0.11,0.514-0.021c0.137-0.13,0.125-0.33-0.021-0.449l-4.374-3.508c-0.071-0.057-0.166-0.085-0.262-0.084\r c-0.097,0.003-0.189,0.041-0.253,0.104l-3.568,3.419l-1.73-1.513c-0.134-0.119-0.354-0.124-0.498-0.015l-6.203,4.776\r c-0.15,0.118-0.165,0.317-0.031,0.451C158.973,196.513,159.075,196.548,159.174,196.548z" })
    )
  ),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("rect", { x: "230.848", y: "157.76", fill: "#7B8080", width: "102.839", height: "66.74" }),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M292.472,183.796h-20.407c-0.201,0-0.365,0.142-0.365,0.318v14.029c0,0.177,0.164,0.318,0.365,0.318\r h20.407c0.2,0,0.363-0.143,0.363-0.318v-14.03C292.835,183.938,292.672,183.796,292.472,183.796z M292.105,197.825h-19.678\r v-13.392h19.678V197.825L292.105,197.825z" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M277.53,190.854c1.119,0,2.028-0.796,2.028-1.775s-0.909-1.775-2.028-1.775s-2.03,0.797-2.03,1.775\r C275.5,190.058,276.411,190.854,277.53,190.854z M277.53,187.939c0.717,0,1.299,0.512,1.299,1.139s-0.583,1.138-1.299,1.138\r c-0.718,0-1.301-0.511-1.301-1.138S276.811,187.939,277.53,187.939z" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M274.249,196.548c0.086,0,0.171-0.024,0.241-0.077l5.944-4.579l3.755,3.284\r c0.142,0.123,0.373,0.123,0.515,0c0.143-0.125,0.143-0.327,0-0.451l-1.753-1.534l3.347-3.205l4.104,3.292\r c0.149,0.119,0.38,0.11,0.514-0.021c0.137-0.13,0.125-0.33-0.021-0.449l-4.374-3.508c-0.071-0.057-0.166-0.085-0.262-0.084\r c-0.097,0.003-0.188,0.041-0.253,0.104l-3.568,3.419l-1.729-1.513c-0.134-0.119-0.354-0.124-0.497-0.015l-6.203,4.776\r c-0.15,0.118-0.165,0.317-0.031,0.451C274.047,196.513,274.149,196.548,274.249,196.548z" })
    )
  )
);

var relatedContentTitleList = wp.element.createElement(
  "svg",
  { version: "1.1", id: "relatedContentTitleList", x: "0px", y: "0px", width: "334px", height: "224.726px", viewBox: "29.167 -5.468 334 224.726", enableBackground: "new 29.167 -5.468 334 224.726" },
  wp.element.createElement("rect", { x: "30.667", y: "-3.968", fill: "#FFFFFF", stroke: "#7B8080", "stroke-width": "3", "stroke-miterlimit": "10", width: "331", height: "221.726" }),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("rect", { x: "100.86", y: "129.895", fill: "#7B8080", width: "202.474", height: "5.15" }),
      wp.element.createElement("circle", { fill: "#7B8080", cx: "91.75", cy: "132.645", r: "2.75" })
    ),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("rect", { x: "100.86", y: "156.819", fill: "#7B8080", width: "202.474", height: "5.15" }),
      wp.element.createElement("circle", { fill: "#7B8080", cx: "91.75", cy: "159.569", r: "2.75" })
    ),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("rect", { x: "100.86", y: "183.319", fill: "#7B8080", width: "202.474", height: "5.15" }),
      wp.element.createElement("circle", { fill: "#7B8080", cx: "91.75", cy: "186.069", r: "2.75" })
    ),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("rect", { x: "100.86", y: "24.971", fill: "#7B8080", width: "202.474", height: "5.148" }),
      wp.element.createElement("circle", { fill: "#7B8080", cx: "91.75", cy: "27.721", r: "2.75" })
    ),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("rect", { x: "100.86", y: "51.895", fill: "#7B8080", width: "202.474", height: "5.149" }),
      wp.element.createElement("circle", { fill: "#7B8080", cx: "91.75", cy: "54.645", r: "2.75" })
    ),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("rect", { x: "100.86", y: "78.395", fill: "#7B8080", width: "202.474", height: "5.149" }),
      wp.element.createElement("circle", { fill: "#7B8080", cx: "91.75", cy: "81.145", r: "2.75" })
    ),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("rect", { x: "100.86", y: "104.395", fill: "#7B8080", width: "202.474", height: "5.149" }),
      wp.element.createElement("circle", { fill: "#7B8080", cx: "91.75", cy: "107.145", r: "2.75" })
    )
  )
);

var relatedContSideImgInfo = wp.element.createElement(
  "svg",
  { version: "1.1", id: "relatedContSideImgInfo", x: "0px", y: "0px", width: "334px", height: "248.5px", viewBox: "0 0 334 248.5", enableBackground: "new 0 0 334 248.5" },
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("rect", { x: "2.544", y: "73.75", fill: "#7B8080", width: "110.771", height: "91.001" }),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M78.038,100.729H37.823c-0.397,0-0.72,0.361-0.72,0.804v35.434c0,0.445,0.322,0.807,0.72,0.807h40.215\r c0.395,0,0.718-0.361,0.718-0.807v-35.434C78.755,101.09,78.432,100.729,78.038,100.729z M77.318,136.164H38.54v-33.826h38.778\r V136.164L77.318,136.164z" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M48.594,118.556c2.206,0,4-2.012,4-4.482c0-2.475-1.795-4.484-4-4.484c-2.207,0-3.999,2.01-3.999,4.482\r S46.388,118.556,48.594,118.556z M48.594,111.196c1.413,0,2.563,1.29,2.563,2.875c0,1.583-1.15,2.873-2.563,2.873\r c-1.414,0-2.564-1.288-2.564-2.873C46.031,112.488,47.18,111.196,48.594,111.196z" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M42.13,132.941c0.168,0,0.338-0.064,0.474-0.201l11.715-11.564l7.397,8.295\r c0.281,0.314,0.735,0.314,1.016,0c0.281-0.314,0.281-0.824,0-1.139l-3.452-3.871l6.593-8.096l8.086,8.313\r c0.293,0.301,0.746,0.277,1.015-0.049c0.268-0.328,0.248-0.838-0.044-1.139l-8.619-8.859c-0.14-0.145-0.326-0.217-0.517-0.211\r c-0.19,0.009-0.37,0.104-0.498,0.261l-7.033,8.639l-3.406-3.82c-0.268-0.301-0.698-0.314-0.982-0.035l-12.22,12.068\r c-0.297,0.293-0.327,0.801-0.064,1.135C41.733,132.851,41.932,132.941,42.13,132.941z" })
    )
  ),
  wp.element.createElement("rect", { x: "138.945", y: "74.69", fill: "#7B8080", width: "101.739", height: "7.39" }),
  wp.element.createElement("rect", { x: "138.945", y: "96.767", fill: "#7B8080", width: "188.344", height: "5.375" }),
  wp.element.createElement("rect", { x: "138.945", y: "110.201", fill: "#7B8080", width: "137.555", height: "4.479" }),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("rect", { x: "150.859", y: "129.181", fill: "#7B8080", width: "96.641", height: "5.149" }),
    wp.element.createElement("circle", { fill: "#7B8080", cx: "141.75", cy: "131.932", r: "2.75" }),
    wp.element.createElement("rect", { x: "150.859", y: "154.531", fill: "#7B8080", width: "96.641", height: "5.149" }),
    wp.element.createElement("circle", { fill: "#7B8080", cx: "141.75", cy: "157.281", r: "2.75" }),
    wp.element.createElement("rect", { x: "150.859", y: "141.773", fill: "#7B8080", width: "96.641", height: "5.149" }),
    wp.element.createElement("circle", { fill: "#7B8080", cx: "141.75", cy: "144.523", r: "2.75" })
  )
);

var realtedContentCoLocatedEvents = wp.element.createElement(
  "svg",
  { version: "1.1", id: "realtedContentCoLocatedEvents", x: "0px", y: "0px", width: "334px", height: "248.5px", viewBox: "0 0 334 248.5", enableBackground: "new 0 0 334 248.5" },
  wp.element.createElement("rect", { x: "1.5", y: "1.5", fill: "#FFFFFF", stroke: "#7B8080", "stroke-width": "3", "stroke-miterlimit": "10", width: "331", height: "245.5" }),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("rect", { x: "40.756", y: "18.869", fill: "#7B8080", width: "252.489", height: "85.058" }),
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement("path", { fill: "#FFFFFF", d: "M180.226,50.535h-26.45c-0.261,0-0.473,0.211-0.473,0.472v20.782c0,0.261,0.211,0.472,0.473,0.472h26.45\r c0.26,0,0.472-0.211,0.472-0.472V51.006C180.697,50.746,180.485,50.535,180.226,50.535z M179.753,71.316h-25.505V51.479h25.505\r V71.316L179.753,71.316z" }),
        wp.element.createElement("path", { fill: "#FFFFFF", d: "M160.86,60.991c1.451,0,2.63-1.181,2.63-2.63c0-1.451-1.18-2.63-2.63-2.63c-1.451,0-2.63,1.179-2.63,2.63\r C158.23,59.81,159.41,60.991,160.86,60.991z M160.86,56.674c0.93,0,1.686,0.757,1.686,1.686c0,0.93-0.756,1.686-1.686,1.686\r c-0.93,0-1.686-0.756-1.686-1.685S159.93,56.674,160.86,56.674z" }),
        wp.element.createElement("path", { fill: "#FFFFFF", d: "M156.609,69.427c0.11,0,0.222-0.039,0.312-0.118l7.705-6.783l4.866,4.865\r c0.184,0.185,0.482,0.185,0.667,0s0.185-0.483,0-0.668l-2.27-2.271l4.336-4.748l5.318,4.875c0.192,0.177,0.491,0.163,0.667-0.029\r s0.163-0.491-0.028-0.667l-5.669-5.195c-0.092-0.084-0.215-0.127-0.34-0.124c-0.125,0.006-0.242,0.062-0.327,0.153l-4.626,5.067\r l-2.24-2.24c-0.176-0.176-0.459-0.186-0.646-0.021l-8.038,7.077c-0.195,0.172-0.215,0.471-0.042,0.666\r C156.348,69.374,156.479,69.427,156.609,69.427z" })
      )
    ),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement("rect", { x: "77.645", y: "208.94", fill: "#7B8080", width: "178.711", height: "5.912" }),
        wp.element.createElement("rect", { x: "95.814", y: "224.794", fill: "#7B8080", width: "142.372", height: "4.837" }),
        wp.element.createElement("rect", { x: "65.234", y: "192.447", fill: "#7B8080", width: "203.532", height: "5.603" })
      ),
      wp.element.createElement("rect", { x: "118.167", y: "162.173", fill: "#7B8080", width: "97.666", height: "9.333" }),
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement(
          "g",
          null,
          wp.element.createElement("path", { fill: "#7B8080", d: "M155.818,140.534l-1.591,2.285l-1.123-0.922c-0.119-0.102-0.3-0.082-0.396,0.039\r c-0.1,0.119-0.084,0.299,0.037,0.399l1.358,1.116c0.052,0.039,0.114,0.063,0.182,0.063c0.014,0,0.025,0,0.04-0.002\r c0.074-0.011,0.147-0.054,0.193-0.115l1.767-2.539c0.088-0.131,0.059-0.309-0.07-0.396\r C156.083,140.373,155.909,140.405,155.818,140.534z" }),
          wp.element.createElement("path", { fill: "#7B8080", d: "M156.052,138.844v-5.539v-2.843c0-0.156-0.126-0.282-0.282-0.282h-1.42v-0.854\r c0-0.157-0.128-0.283-0.286-0.283h-1.988c-0.158,0-0.284,0.126-0.284,0.283v0.854h-6.252v-0.854c0-0.157-0.13-0.283-0.284-0.283\r h-1.995c-0.156,0-0.279,0.126-0.279,0.283v0.854h-1.423c-0.158,0-0.284,0.126-0.284,0.282v2.843v11.654\r c0,0.157,0.126,0.284,0.284,0.284h10.831c0.568,0.356,1.239,0.568,1.962,0.568c2.034,0,3.694-1.658,3.694-3.695\r C158.041,140.696,157.23,139.458,156.052,138.844z M152.355,129.61h1.424v0.854v0.853h-1.424v-0.853V129.61z M143.548,129.61\r h1.421v0.854v0.853h-1.421v-0.853V129.61z M141.839,130.75h1.139v0.853c0,0.157,0.125,0.284,0.281,0.284h1.995\r c0.154,0,0.284-0.127,0.284-0.284v-0.853h6.252v0.853c0,0.157,0.126,0.284,0.284,0.284h1.988c0.158,0,0.285-0.127,0.285-0.284\r v-0.853h1.137v2.274h-13.646V130.75L141.839,130.75z M141.839,144.676v-11.084h13.646v5.013\r c-0.056-0.019-0.111-0.033-0.171-0.045c-0.053-0.019-0.106-0.029-0.159-0.041c-0.049-0.014-0.101-0.021-0.146-0.029\r c-0.07-0.016-0.14-0.023-0.208-0.033c-0.039-0.006-0.076-0.012-0.119-0.016c-0.106-0.011-0.221-0.018-0.333-0.018\r c-0.1,0-0.189,0.007-0.285,0.018v-0.302v-0.569v-2.558h-2.56h-0.568h-1.99h-0.569h-1.989h-0.564h-2.563v2.558v0.569v1.988v0.569\r v2.56h2.563h0.564h1.989h0.569h1.888c0.006,0.024,0.016,0.047,0.026,0.075c0.023,0.066,0.05,0.137,0.076,0.203\r c0.015,0.039,0.035,0.076,0.047,0.111c0.035,0.069,0.067,0.144,0.108,0.215c0.016,0.029,0.035,0.057,0.05,0.086\r c0.042,0.076,0.087,0.148,0.13,0.222c0.021,0.024,0.038,0.048,0.055,0.075c0.05,0.07,0.104,0.14,0.158,0.209\r c0.021,0.024,0.043,0.048,0.063,0.07c0.042,0.053,0.087,0.105,0.132,0.151L141.839,144.676L141.839,144.676z M152.73,138.802\r c-0.03,0.016-0.063,0.026-0.094,0.042c-0.051,0.029-0.104,0.06-0.155,0.089c-0.047,0.028-0.092,0.053-0.137,0.084\r c-0.041,0.028-0.091,0.055-0.128,0.09c-0.049,0.035-0.102,0.07-0.146,0.104c-0.034,0.034-0.076,0.062-0.11,0.094\r c-0.049,0.043-0.103,0.086-0.146,0.134c-0.032,0.029-0.063,0.061-0.1,0.092c-0.05,0.052-0.099,0.105-0.146,0.162\r c-0.021,0.025-0.041,0.047-0.063,0.069v-1.622h1.99v0.391c-0.006,0.002-0.011,0.002-0.015,0.002\r C153.221,138.594,152.967,138.683,152.73,138.802z M150.813,141.038c-0.011,0.031-0.017,0.066-0.025,0.101\r c-0.022,0.081-0.048,0.164-0.062,0.247c-0.019,0.066-0.023,0.133-0.03,0.2c-0.011,0.053-0.021,0.108-0.027,0.16\r c-0.012,0.122-0.02,0.247-0.02,0.372c0,0.104,0.008,0.207,0.018,0.312c0,0.021,0,0.035,0.002,0.058\r c0.004,0.045,0.014,0.09,0.021,0.139l0,0c0.004,0.021,0.008,0.042,0.008,0.063h-1.751v-1.99h1.99l0,0\r c-0.004,0.01-0.004,0.018-0.007,0.021C150.886,140.823,150.845,140.931,150.813,141.038z M143.83,140.696h1.992v1.992h-1.992\r V140.696z M143.83,138.139h1.992v1.988h-1.992V138.139z M153.494,137.567h-1.99v-1.987h1.99V137.567z M150.936,137.567h-1.989\r v-1.987h1.989V137.567z M150.936,140.127h-1.989v-1.988h1.989V140.127z M146.386,138.139h1.989v1.988h-1.989V138.139z\r M148.375,137.567h-1.989v-1.987h1.989V137.567z M145.819,137.567h-1.993v-1.987h1.993V137.567z M146.386,140.696h1.989v1.992\r h-1.989V140.696z M154.35,145.243c-0.646,0-1.241-0.194-1.736-0.527c-0.098-0.066-0.188-0.136-0.274-0.212\r c-0.034-0.024-0.063-0.052-0.09-0.08c-0.062-0.053-0.112-0.104-0.164-0.157c-0.034-0.037-0.064-0.07-0.101-0.105\r c-0.042-0.055-0.091-0.108-0.132-0.168c-0.026-0.035-0.057-0.07-0.08-0.106c-0.063-0.09-0.122-0.187-0.177-0.28\r c-0.011-0.022-0.021-0.048-0.033-0.068c-0.043-0.083-0.079-0.166-0.114-0.248c-0.014-0.036-0.026-0.075-0.04-0.112\r c-0.026-0.073-0.049-0.149-0.073-0.226c-0.006-0.021-0.01-0.036-0.013-0.053c-0.033-0.125-0.058-0.252-0.073-0.375\r c-0.003-0.011-0.003-0.02-0.006-0.028c-0.015-0.126-0.023-0.253-0.023-0.38c0-0.106,0.006-0.211,0.016-0.318\r c0-0.008,0.005-0.018,0.005-0.025c0.01-0.099,0.025-0.191,0.046-0.289c0-0.011,0.004-0.018,0.007-0.025\r c0.02-0.098,0.043-0.188,0.073-0.282c0.003-0.011,0.007-0.021,0.01-0.03c0.033-0.092,0.063-0.178,0.099-0.266\r c0.038-0.079,0.076-0.159,0.116-0.238l0.03-0.048c0.011-0.021,0.023-0.039,0.036-0.063c0.05-0.082,0.103-0.162,0.157-0.24\r c0.015-0.02,0.029-0.037,0.044-0.057c0.055-0.068,0.105-0.135,0.162-0.195c0.018-0.022,0.04-0.045,0.057-0.063\r c0.057-0.06,0.115-0.114,0.176-0.171c0.021-0.021,0.043-0.037,0.065-0.058c0.07-0.062,0.144-0.116,0.22-0.173\r c0.01-0.01,0.021-0.018,0.035-0.025c0.375-0.255,0.798-0.434,1.254-0.508l0.007-0.006c0.17-0.026,0.336-0.045,0.517-0.045\r c0.108,0,0.221,0.009,0.327,0.021c0.019,0,0.035,0.005,0.049,0.008c0.095,0.012,0.186,0.025,0.277,0.045\r c0.013,0,0.025,0.008,0.034,0.008c0.102,0.021,0.195,0.051,0.292,0.082c0.007,0,0.015,0.004,0.021,0.006\r c0.097,0.033,0.193,0.072,0.292,0.113c1.079,0.493,1.834,1.584,1.834,2.848C157.472,143.843,156.068,145.243,154.35,145.243z" })
        ),
        wp.element.createElement("rect", { x: "163.011", y: "134.623", fill: "#7B8080", width: "29.716", height: "5.019" })
      )
    )
  )
);

var realtedContentInfoOnly = wp.element.createElement(
  "svg",
  { version: "1.1", id: "realtedContentInfoOnly", x: "0px", y: "0px", width: "334px", height: "248.5px", viewBox: "0.496 11.31 334 248.5", enablebackground: "new 0.496 11.31 334 248.5" },
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("rect", { x: "8.199", y: "63.38", fill: "#7B8080", width: "172.098", height: "12.501" }),
    wp.element.createElement("rect", { x: "8.199", y: "100.725", fill: "#7B8080", width: "318.594", height: "9.092" }),
    wp.element.createElement("rect", { x: "8.199", y: "123.449", fill: "#7B8080", width: "232.682", height: "7.578" }),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("rect", { x: "28.352", y: "155.556", fill: "#7B8080", width: "163.474", height: "8.709" }),
      wp.element.createElement("circle", { fill: "#7B8080", cx: "12.945", cy: "160.208", r: "4.652" }),
      wp.element.createElement("rect", { x: "28.352", y: "198.437", fill: "#7B8080", width: "163.474", height: "8.709" }),
      wp.element.createElement("circle", { fill: "#7B8080", cx: "12.945", cy: "203.088", r: "4.652" }),
      wp.element.createElement("rect", { x: "28.352", y: "176.855", fill: "#7B8080", width: "163.474", height: "8.709" }),
      wp.element.createElement("circle", { fill: "#7B8080", cx: "12.945", cy: "181.507", r: "4.652" })
    )
  )
);

var realtedContentPlanShow = wp.element.createElement(
  "svg",
  { version: "1.1", id: "realtedContentPlanShow", x: "0px", y: "0px", width: "334px", height: "318px", viewBox: "-2.23 0 334 318", enablebackground: "new -2.23 0 334 318" },
  wp.element.createElement("rect", { x: "-0.73", y: "1.5", fill: "#FFFFFF", stroke: "#7B8080", "stroke-width": "3", "stroke-miterlimit": "10", width: "331", height: "315" }),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("rect", { x: "107.77", y: "150.167", fill: "#7B8080", width: "136.666", height: "11" }),
    wp.element.createElement("rect", { x: "79.103", y: "174.167", fill: "#7B8080", width: "187.333", height: "9.667" })
  ),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("rect", { x: "36.437", y: "217.5", fill: "#7B8080", width: "253", height: "8" }),
    wp.element.createElement("rect", { x: "34.77", y: "237.5", fill: "#7B8080", width: "260", height: "6.667" }),
    wp.element.createElement("rect", { x: "34.77", y: "257.834", fill: "#7B8080", width: "248.73", height: "7.666" }),
    wp.element.createElement("rect", { x: "34.77", y: "277.167", fill: "#7B8080", width: "231.666", height: "7.333" })
  ),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("rect", { x: "-0.365", y: "1", fill: "#7B8080", width: "331", height: "115" }),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M197.977,31.523h-65.682c-0.647,0-1.173,0.524-1.173,1.173v51.606c0,0.649,0.524,1.173,1.173,1.173h65.682\r c0.646,0,1.172-0.523,1.172-1.173V32.696C199.149,32.048,198.623,31.523,197.977,31.523z M196.803,83.13h-63.335V33.869h63.335\r V83.13L196.803,83.13z" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M149.887,57.489c3.603,0,6.532-2.931,6.532-6.53c0-3.604-2.93-6.532-6.532-6.532\r c-3.602,0-6.531,2.929-6.531,6.531C143.356,54.559,146.286,57.489,149.887,57.489z M149.887,46.771\r c2.309,0,4.187,1.879,4.187,4.187c0,2.307-1.878,4.186-4.187,4.186s-4.186-1.878-4.186-4.185\r C145.702,48.652,147.579,46.771,149.887,46.771z" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M139.332,78.438c0.274,0,0.551-0.096,0.774-0.292l19.133-16.845l12.083,12.082\r c0.459,0.458,1.201,0.458,1.658,0c0.459-0.459,0.459-1.2,0-1.658l-5.638-5.639l10.769-11.792l13.207,12.107\r c0.479,0.438,1.219,0.404,1.656-0.072c0.439-0.479,0.404-1.22-0.07-1.657l-14.076-12.902c-0.23-0.209-0.535-0.313-0.844-0.307\r c-0.313,0.014-0.605,0.151-0.814,0.381l-11.488,12.582l-5.563-5.563c-0.438-0.438-1.14-0.459-1.604-0.053l-19.959,17.573\r c-0.485,0.429-0.533,1.169-0.105,1.656C138.682,78.306,139.007,78.438,139.332,78.438z" })
    )
  )
);

var relatedContentDropdown = wp.element.createElement(
  "svg",
  { version: "1.1", id: "relatedContentDropdown", width: "334px", height: "248.5px", viewBox: "0 0 334 248.5", enableBackground: "new 0 0 334 248.5" },
  wp.element.createElement("rect", { x: "1.5", y: "1.5", display: "none", fill: "#FFFFFF", stroke: "#7B8080", "stroke-width": "3", "stroke-miterlimit": "10", width: "331", height: "245.5" }),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("rect", { x: "1.5", y: "98.953", fill: "#7B8080", width: "331", height: "50.594" }),
    wp.element.createElement("rect", { x: "7.895", y: "113.263", fill: "#F2F2F2", width: "270.562", height: "21.975" }),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("path", { fill: "#EFEFEF", d: "M309.475,129.031c-0.3,0-0.601-0.115-0.83-0.344l-7.212-7.212c-0.459-0.458-0.459-1.203,0-1.662\r c0.459-0.458,1.203-0.458,1.661,0l6.381,6.382l6.382-6.382c0.459-0.458,1.203-0.458,1.661,0c0.459,0.458,0.459,1.203,0,1.661\r l-7.212,7.212C310.077,128.916,309.776,129.031,309.475,129.031z" })
    )
  )
);

/***/ }),
/* 4 */
/***/ (function(module, exports, __webpack_require__) {

var Symbol = __webpack_require__(5),
    getRawTag = __webpack_require__(52),
    objectToString = __webpack_require__(53);

/** `Object#toString` result references. */
var nullTag = '[object Null]',
    undefinedTag = '[object Undefined]';

/** Built-in value references. */
var symToStringTag = Symbol ? Symbol.toStringTag : undefined;

/**
 * The base implementation of `getTag` without fallbacks for buggy environments.
 *
 * @private
 * @param {*} value The value to query.
 * @returns {string} Returns the `toStringTag`.
 */
function baseGetTag(value) {
  if (value == null) {
    return value === undefined ? undefinedTag : nullTag;
  }
  return (symToStringTag && symToStringTag in Object(value))
    ? getRawTag(value)
    : objectToString(value);
}

module.exports = baseGetTag;


/***/ }),
/* 5 */
/***/ (function(module, exports, __webpack_require__) {

var root = __webpack_require__(1);

/** Built-in value references. */
var Symbol = root.Symbol;

module.exports = Symbol;


/***/ }),
/* 6 */
/***/ (function(module, exports) {

/**
 * Checks if `value` is object-like. A value is object-like if it's not `null`
 * and has a `typeof` result of "object".
 *
 * @static
 * @memberOf _
 * @since 4.0.0
 * @category Lang
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is object-like, else `false`.
 * @example
 *
 * _.isObjectLike({});
 * // => true
 *
 * _.isObjectLike([1, 2, 3]);
 * // => true
 *
 * _.isObjectLike(_.noop);
 * // => false
 *
 * _.isObjectLike(null);
 * // => false
 */
function isObjectLike(value) {
  return value != null && typeof value == 'object';
}

module.exports = isObjectLike;


/***/ }),
/* 7 */
/***/ (function(module, exports) {

/**
 * Checks if `value` is the
 * [language type](http://www.ecma-international.org/ecma-262/7.0/#sec-ecmascript-language-types)
 * of `Object`. (e.g. arrays, functions, objects, regexes, `new Number(0)`, and `new String('')`)
 *
 * @static
 * @memberOf _
 * @since 0.1.0
 * @category Lang
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is an object, else `false`.
 * @example
 *
 * _.isObject({});
 * // => true
 *
 * _.isObject([1, 2, 3]);
 * // => true
 *
 * _.isObject(_.noop);
 * // => true
 *
 * _.isObject(null);
 * // => false
 */
function isObject(value) {
  var type = typeof value;
  return value != null && (type == 'object' || type == 'function');
}

module.exports = isObject;


/***/ }),
/* 8 */
/***/ (function(module, exports, __webpack_require__) {

var isSymbol = __webpack_require__(10);

/** Used as references for various `Number` constants. */
var INFINITY = 1 / 0;

/**
 * Converts `value` to a string key if it's not a string or symbol.
 *
 * @private
 * @param {*} value The value to inspect.
 * @returns {string|symbol} Returns the key.
 */
function toKey(value) {
  if (typeof value == 'string' || isSymbol(value)) {
    return value;
  }
  var result = (value + '');
  return (result == '0' && (1 / value) == -INFINITY) ? '-0' : result;
}

module.exports = toKey;


/***/ }),
/* 9 */
/***/ (function(module, exports, __webpack_require__) {

var isArray = __webpack_require__(0),
    isKey = __webpack_require__(19),
    stringToPath = __webpack_require__(54),
    toString = __webpack_require__(78);

/**
 * Casts `value` to a path array if it's not one.
 *
 * @private
 * @param {*} value The value to inspect.
 * @param {Object} [object] The object to query keys on.
 * @returns {Array} Returns the cast property path array.
 */
function castPath(value, object) {
  if (isArray(value)) {
    return value;
  }
  return isKey(value, object) ? [value] : stringToPath(toString(value));
}

module.exports = castPath;


/***/ }),
/* 10 */
/***/ (function(module, exports, __webpack_require__) {

var baseGetTag = __webpack_require__(4),
    isObjectLike = __webpack_require__(6);

/** `Object#toString` result references. */
var symbolTag = '[object Symbol]';

/**
 * Checks if `value` is classified as a `Symbol` primitive or object.
 *
 * @static
 * @memberOf _
 * @since 4.0.0
 * @category Lang
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is a symbol, else `false`.
 * @example
 *
 * _.isSymbol(Symbol.iterator);
 * // => true
 *
 * _.isSymbol('abc');
 * // => false
 */
function isSymbol(value) {
  return typeof value == 'symbol' ||
    (isObjectLike(value) && baseGetTag(value) == symbolTag);
}

module.exports = isSymbol;


/***/ }),
/* 11 */
/***/ (function(module, exports, __webpack_require__) {

var getNative = __webpack_require__(2);

/* Built-in method references that are verified to be native. */
var nativeCreate = getNative(Object, 'create');

module.exports = nativeCreate;


/***/ }),
/* 12 */
/***/ (function(module, exports, __webpack_require__) {

var listCacheClear = __webpack_require__(68),
    listCacheDelete = __webpack_require__(69),
    listCacheGet = __webpack_require__(70),
    listCacheHas = __webpack_require__(71),
    listCacheSet = __webpack_require__(72);

/**
 * Creates an list cache object.
 *
 * @private
 * @constructor
 * @param {Array} [entries] The key-value pairs to cache.
 */
function ListCache(entries) {
  var index = -1,
      length = entries == null ? 0 : entries.length;

  this.clear();
  while (++index < length) {
    var entry = entries[index];
    this.set(entry[0], entry[1]);
  }
}

// Add methods to `ListCache`.
ListCache.prototype.clear = listCacheClear;
ListCache.prototype['delete'] = listCacheDelete;
ListCache.prototype.get = listCacheGet;
ListCache.prototype.has = listCacheHas;
ListCache.prototype.set = listCacheSet;

module.exports = ListCache;


/***/ }),
/* 13 */
/***/ (function(module, exports, __webpack_require__) {

var eq = __webpack_require__(21);

/**
 * Gets the index at which the `key` is found in `array` of key-value pairs.
 *
 * @private
 * @param {Array} array The array to inspect.
 * @param {*} key The key to search for.
 * @returns {number} Returns the index of the matched value, else `-1`.
 */
function assocIndexOf(array, key) {
  var length = array.length;
  while (length--) {
    if (eq(array[length][0], key)) {
      return length;
    }
  }
  return -1;
}

module.exports = assocIndexOf;


/***/ }),
/* 14 */
/***/ (function(module, exports, __webpack_require__) {

var isKeyable = __webpack_require__(74);

/**
 * Gets the data for `map`.
 *
 * @private
 * @param {Object} map The map to query.
 * @param {string} key The reference key.
 * @returns {*} Returns the map data.
 */
function getMapData(map, key) {
  var data = map.__data__;
  return isKeyable(key)
    ? data[typeof key == 'string' ? 'string' : 'hash']
    : data.map;
}

module.exports = getMapData;


/***/ }),
/* 15 */
/***/ (function(module, exports, __webpack_require__) {

var baseTimes = __webpack_require__(37),
    castFunction = __webpack_require__(105),
    toInteger = __webpack_require__(106);

/** Used as references for various `Number` constants. */
var MAX_SAFE_INTEGER = 9007199254740991;

/** Used as references for the maximum length and index of an array. */
var MAX_ARRAY_LENGTH = 4294967295;

/* Built-in method references for those with the same name as other `lodash` methods. */
var nativeMin = Math.min;

/**
 * Invokes the iteratee `n` times, returning an array of the results of
 * each invocation. The iteratee is invoked with one argument; (index).
 *
 * @static
 * @since 0.1.0
 * @memberOf _
 * @category Util
 * @param {number} n The number of times to invoke `iteratee`.
 * @param {Function} [iteratee=_.identity] The function invoked per iteration.
 * @returns {Array} Returns the array of results.
 * @example
 *
 * _.times(3, String);
 * // => ['0', '1', '2']
 *
 *  _.times(4, _.constant(0));
 * // => [0, 0, 0, 0]
 */
function times(n, iteratee) {
  n = toInteger(n);
  if (n < 1 || n > MAX_SAFE_INTEGER) {
    return [];
  }
  var index = MAX_ARRAY_LENGTH,
      length = nativeMin(n, MAX_ARRAY_LENGTH);

  iteratee = castFunction(iteratee);
  n -= MAX_ARRAY_LENGTH;

  var result = baseTimes(length, iteratee);
  while (++index < n) {
    iteratee(index);
  }
  return result;
}

module.exports = times;


/***/ }),
/* 16 */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(process) {module.exports = function memize( fn, options ) {
	var size = 0,
		maxSize, head, tail;

	if ( options && options.maxSize ) {
		maxSize = options.maxSize;
	}

	function memoized( /* ...args */ ) {
		var node = head,
			len = arguments.length,
			args, i;

		searchCache: while ( node ) {
			// Perform a shallow equality test to confirm that whether the node
			// under test is a candidate for the arguments passed. Two arrays
			// are shallowly equal if their length matches and each entry is
			// strictly equal between the two sets. Avoid abstracting to a
			// function which could incur an arguments leaking deoptimization.

			// Check whether node arguments match arguments length
			if ( node.args.length !== arguments.length ) {
				node = node.next;
				continue;
			}

			// Check whether node arguments match arguments values
			for ( i = 0; i < len; i++ ) {
				if ( node.args[ i ] !== arguments[ i ] ) {
					node = node.next;
					continue searchCache;
				}
			}

			// At this point we can assume we've found a match

			// Surface matched node to head if not already
			if ( node !== head ) {
				// As tail, shift to previous. Must only shift if not also
				// head, since if both head and tail, there is no previous.
				if ( node === tail ) {
					tail = node.prev;
				}

				// Adjust siblings to point to each other. If node was tail,
				// this also handles new tail's empty `next` assignment.
				node.prev.next = node.next;
				if ( node.next ) {
					node.next.prev = node.prev;
				}

				node.next = head;
				node.prev = null;
				head.prev = node;
				head = node;
			}

			// Return immediately
			return node.val;
		}

		// No cached value found. Continue to insertion phase:

		// Create a copy of arguments (avoid leaking deoptimization)
		args = new Array( len );
		for ( i = 0; i < len; i++ ) {
			args[ i ] = arguments[ i ];
		}

		node = {
			args: args,

			// Generate the result from original function
			val: fn.apply( null, args )
		};

		// Don't need to check whether node is already head, since it would
		// have been returned above already if it was

		// Shift existing head down list
		if ( head ) {
			head.prev = node;
			node.next = head;
		} else {
			// If no head, follows that there's no tail (at initial or reset)
			tail = node;
		}

		// Trim tail if we're reached max size and are pending cache insertion
		if ( size === maxSize ) {
			tail = tail.prev;
			tail.next = null;
		} else {
			size++;
		}

		head = node;

		return node.val;
	}

	memoized.clear = function() {
		head = null;
		tail = null;
		size = 0;
	};

	if ( process.env.NODE_ENV === 'test' ) {
		// Cache is not exposed in the public API, but used in tests to ensure
		// expected list progression
		memoized.getCache = function() {
			return [ head, tail, size ];
		};
	}

	return memoized;
};

/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(109)))

/***/ }),
/* 17 */
/***/ (function(module, exports, __webpack_require__) {

var basePick = __webpack_require__(49),
    flatRest = __webpack_require__(86);

/**
 * Creates an object composed of the picked `object` properties.
 *
 * @static
 * @since 0.1.0
 * @memberOf _
 * @category Object
 * @param {Object} object The source object.
 * @param {...(string|string[])} [paths] The property paths to pick.
 * @returns {Object} Returns the new object.
 * @example
 *
 * var object = { 'a': 1, 'b': '2', 'c': 3 };
 *
 * _.pick(object, ['a', 'c']);
 * // => { 'a': 1, 'c': 3 }
 */
var pick = flatRest(function(object, paths) {
  return object == null ? {} : basePick(object, paths);
});

module.exports = pick;


/***/ }),
/* 18 */
/***/ (function(module, exports, __webpack_require__) {

var castPath = __webpack_require__(9),
    toKey = __webpack_require__(8);

/**
 * The base implementation of `_.get` without support for default values.
 *
 * @private
 * @param {Object} object The object to query.
 * @param {Array|string} path The path of the property to get.
 * @returns {*} Returns the resolved value.
 */
function baseGet(object, path) {
  path = castPath(path, object);

  var index = 0,
      length = path.length;

  while (object != null && index < length) {
    object = object[toKey(path[index++])];
  }
  return (index && index == length) ? object : undefined;
}

module.exports = baseGet;


/***/ }),
/* 19 */
/***/ (function(module, exports, __webpack_require__) {

var isArray = __webpack_require__(0),
    isSymbol = __webpack_require__(10);

/** Used to match property names within property paths. */
var reIsDeepProp = /\.|\[(?:[^[\]]*|(["'])(?:(?!\1)[^\\]|\\.)*?\1)\]/,
    reIsPlainProp = /^\w*$/;

/**
 * Checks if `value` is a property name and not a property path.
 *
 * @private
 * @param {*} value The value to check.
 * @param {Object} [object] The object to query keys on.
 * @returns {boolean} Returns `true` if `value` is a property name, else `false`.
 */
function isKey(value, object) {
  if (isArray(value)) {
    return false;
  }
  var type = typeof value;
  if (type == 'number' || type == 'symbol' || type == 'boolean' ||
      value == null || isSymbol(value)) {
    return true;
  }
  return reIsPlainProp.test(value) || !reIsDeepProp.test(value) ||
    (object != null && value in Object(object));
}

module.exports = isKey;


/***/ }),
/* 20 */
/***/ (function(module, exports, __webpack_require__) {

var mapCacheClear = __webpack_require__(57),
    mapCacheDelete = __webpack_require__(73),
    mapCacheGet = __webpack_require__(75),
    mapCacheHas = __webpack_require__(76),
    mapCacheSet = __webpack_require__(77);

/**
 * Creates a map cache object to store key-value pairs.
 *
 * @private
 * @constructor
 * @param {Array} [entries] The key-value pairs to cache.
 */
function MapCache(entries) {
  var index = -1,
      length = entries == null ? 0 : entries.length;

  this.clear();
  while (++index < length) {
    var entry = entries[index];
    this.set(entry[0], entry[1]);
  }
}

// Add methods to `MapCache`.
MapCache.prototype.clear = mapCacheClear;
MapCache.prototype['delete'] = mapCacheDelete;
MapCache.prototype.get = mapCacheGet;
MapCache.prototype.has = mapCacheHas;
MapCache.prototype.set = mapCacheSet;

module.exports = MapCache;


/***/ }),
/* 21 */
/***/ (function(module, exports) {

/**
 * Performs a
 * [`SameValueZero`](http://ecma-international.org/ecma-262/7.0/#sec-samevaluezero)
 * comparison between two values to determine if they are equivalent.
 *
 * @static
 * @memberOf _
 * @since 4.0.0
 * @category Lang
 * @param {*} value The value to compare.
 * @param {*} other The other value to compare.
 * @returns {boolean} Returns `true` if the values are equivalent, else `false`.
 * @example
 *
 * var object = { 'a': 1 };
 * var other = { 'a': 1 };
 *
 * _.eq(object, object);
 * // => true
 *
 * _.eq(object, other);
 * // => false
 *
 * _.eq('a', 'a');
 * // => true
 *
 * _.eq('a', Object('a'));
 * // => false
 *
 * _.eq(NaN, NaN);
 * // => true
 */
function eq(value, other) {
  return value === other || (value !== value && other !== other);
}

module.exports = eq;


/***/ }),
/* 22 */
/***/ (function(module, exports, __webpack_require__) {

var getNative = __webpack_require__(2),
    root = __webpack_require__(1);

/* Built-in method references that are verified to be native. */
var Map = getNative(root, 'Map');

module.exports = Map;


/***/ }),
/* 23 */
/***/ (function(module, exports) {

/** Used as references for various `Number` constants. */
var MAX_SAFE_INTEGER = 9007199254740991;

/** Used to detect unsigned integer values. */
var reIsUint = /^(?:0|[1-9]\d*)$/;

/**
 * Checks if `value` is a valid array-like index.
 *
 * @private
 * @param {*} value The value to check.
 * @param {number} [length=MAX_SAFE_INTEGER] The upper bounds of a valid index.
 * @returns {boolean} Returns `true` if `value` is a valid index, else `false`.
 */
function isIndex(value, length) {
  var type = typeof value;
  length = length == null ? MAX_SAFE_INTEGER : length;

  return !!length &&
    (type == 'number' ||
      (type != 'symbol' && reIsUint.test(value))) &&
        (value > -1 && value % 1 == 0 && value < length);
}

module.exports = isIndex;


/***/ }),
/* 24 */
/***/ (function(module, exports, __webpack_require__) {

var baseIsArguments = __webpack_require__(85),
    isObjectLike = __webpack_require__(6);

/** Used for built-in method references. */
var objectProto = Object.prototype;

/** Used to check objects for own properties. */
var hasOwnProperty = objectProto.hasOwnProperty;

/** Built-in value references. */
var propertyIsEnumerable = objectProto.propertyIsEnumerable;

/**
 * Checks if `value` is likely an `arguments` object.
 *
 * @static
 * @memberOf _
 * @since 0.1.0
 * @category Lang
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is an `arguments` object,
 *  else `false`.
 * @example
 *
 * _.isArguments(function() { return arguments; }());
 * // => true
 *
 * _.isArguments([1, 2, 3]);
 * // => false
 */
var isArguments = baseIsArguments(function() { return arguments; }()) ? baseIsArguments : function(value) {
  return isObjectLike(value) && hasOwnProperty.call(value, 'callee') &&
    !propertyIsEnumerable.call(value, 'callee');
};

module.exports = isArguments;


/***/ }),
/* 25 */
/***/ (function(module, exports) {

/** Used as references for various `Number` constants. */
var MAX_SAFE_INTEGER = 9007199254740991;

/**
 * Checks if `value` is a valid array-like length.
 *
 * **Note:** This method is loosely based on
 * [`ToLength`](http://ecma-international.org/ecma-262/7.0/#sec-tolength).
 *
 * @static
 * @memberOf _
 * @since 4.0.0
 * @category Lang
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is a valid length, else `false`.
 * @example
 *
 * _.isLength(3);
 * // => true
 *
 * _.isLength(Number.MIN_VALUE);
 * // => false
 *
 * _.isLength(Infinity);
 * // => false
 *
 * _.isLength('3');
 * // => false
 */
function isLength(value) {
  return typeof value == 'number' &&
    value > -1 && value % 1 == 0 && value <= MAX_SAFE_INTEGER;
}

module.exports = isLength;


/***/ }),
/* 26 */
/***/ (function(module, exports) {

/**
 * This method returns the first argument it receives.
 *
 * @static
 * @since 0.1.0
 * @memberOf _
 * @category Util
 * @param {*} value Any value.
 * @returns {*} Returns `value`.
 * @example
 *
 * var object = { 'a': 1 };
 *
 * console.log(_.identity(object) === object);
 * // => true
 */
function identity(value) {
  return value;
}

module.exports = identity;


/***/ }),
/* 27 */
/***/ (function(module, exports, __webpack_require__) {

var arrayLikeKeys = __webpack_require__(139),
    baseKeys = __webpack_require__(144),
    isArrayLike = __webpack_require__(28);

/**
 * Creates an array of the own enumerable property names of `object`.
 *
 * **Note:** Non-object values are coerced to objects. See the
 * [ES spec](http://ecma-international.org/ecma-262/7.0/#sec-object.keys)
 * for more details.
 *
 * @static
 * @since 0.1.0
 * @memberOf _
 * @category Object
 * @param {Object} object The object to query.
 * @returns {Array} Returns the array of property names.
 * @example
 *
 * function Foo() {
 *   this.a = 1;
 *   this.b = 2;
 * }
 *
 * Foo.prototype.c = 3;
 *
 * _.keys(new Foo);
 * // => ['a', 'b'] (iteration order is not guaranteed)
 *
 * _.keys('hi');
 * // => ['0', '1']
 */
function keys(object) {
  return isArrayLike(object) ? arrayLikeKeys(object) : baseKeys(object);
}

module.exports = keys;


/***/ }),
/* 28 */
/***/ (function(module, exports, __webpack_require__) {

var isFunction = __webpack_require__(31),
    isLength = __webpack_require__(25);

/**
 * Checks if `value` is array-like. A value is considered array-like if it's
 * not a function and has a `value.length` that's an integer greater than or
 * equal to `0` and less than or equal to `Number.MAX_SAFE_INTEGER`.
 *
 * @static
 * @memberOf _
 * @since 4.0.0
 * @category Lang
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is array-like, else `false`.
 * @example
 *
 * _.isArrayLike([1, 2, 3]);
 * // => true
 *
 * _.isArrayLike(document.body.children);
 * // => true
 *
 * _.isArrayLike('abc');
 * // => true
 *
 * _.isArrayLike(_.noop);
 * // => false
 */
function isArrayLike(value) {
  return value != null && isLength(value.length) && !isFunction(value);
}

module.exports = isArrayLike;


/***/ }),
/* 29 */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;/*!
  Copyright (c) 2017 Jed Watson.
  Licensed under the MIT License (MIT), see
  http://jedwatson.github.io/classnames
*/
/* global define */

(function () {
	'use strict';

	var hasOwn = {}.hasOwnProperty;

	function classNames () {
		var classes = [];

		for (var i = 0; i < arguments.length; i++) {
			var arg = arguments[i];
			if (!arg) continue;

			var argType = typeof arg;

			if (argType === 'string' || argType === 'number') {
				classes.push(arg);
			} else if (Array.isArray(arg) && arg.length) {
				var inner = classNames.apply(null, arg);
				if (inner) {
					classes.push(inner);
				}
			} else if (argType === 'object') {
				for (var key in arg) {
					if (hasOwn.call(arg, key) && arg[key]) {
						classes.push(key);
					}
				}
			}
		}

		return classes.join(' ');
	}

	if (typeof module !== 'undefined' && module.exports) {
		classNames.default = classNames;
		module.exports = classNames;
	} else if (true) {
		// register as 'classnames', consistent with npm package name
		!(__WEBPACK_AMD_DEFINE_ARRAY__ = [], __WEBPACK_AMD_DEFINE_RESULT__ = (function () {
			return classNames;
		}).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
	} else {
		window.classNames = classNames;
	}
}());


/***/ }),
/* 30 */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(global) {/** Detect free variable `global` from Node.js. */
var freeGlobal = typeof global == 'object' && global && global.Object === Object && global;

module.exports = freeGlobal;

/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(51)))

/***/ }),
/* 31 */
/***/ (function(module, exports, __webpack_require__) {

var baseGetTag = __webpack_require__(4),
    isObject = __webpack_require__(7);

/** `Object#toString` result references. */
var asyncTag = '[object AsyncFunction]',
    funcTag = '[object Function]',
    genTag = '[object GeneratorFunction]',
    proxyTag = '[object Proxy]';

/**
 * Checks if `value` is classified as a `Function` object.
 *
 * @static
 * @memberOf _
 * @since 0.1.0
 * @category Lang
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is a function, else `false`.
 * @example
 *
 * _.isFunction(_);
 * // => true
 *
 * _.isFunction(/abc/);
 * // => false
 */
function isFunction(value) {
  if (!isObject(value)) {
    return false;
  }
  // The use of `Object#toString` avoids issues with the `typeof` operator
  // in Safari 9 which returns 'object' for typed arrays and other constructors.
  var tag = baseGetTag(value);
  return tag == funcTag || tag == genTag || tag == asyncTag || tag == proxyTag;
}

module.exports = isFunction;


/***/ }),
/* 32 */
/***/ (function(module, exports) {

/** Used for built-in method references. */
var funcProto = Function.prototype;

/** Used to resolve the decompiled source of functions. */
var funcToString = funcProto.toString;

/**
 * Converts `func` to its source code.
 *
 * @private
 * @param {Function} func The function to convert.
 * @returns {string} Returns the source code.
 */
function toSource(func) {
  if (func != null) {
    try {
      return funcToString.call(func);
    } catch (e) {}
    try {
      return (func + '');
    } catch (e) {}
  }
  return '';
}

module.exports = toSource;


/***/ }),
/* 33 */
/***/ (function(module, exports) {

/**
 * A specialized version of `_.map` for arrays without support for iteratee
 * shorthands.
 *
 * @private
 * @param {Array} [array] The array to iterate over.
 * @param {Function} iteratee The function invoked per iteration.
 * @returns {Array} Returns the new mapped array.
 */
function arrayMap(array, iteratee) {
  var index = -1,
      length = array == null ? 0 : array.length,
      result = Array(length);

  while (++index < length) {
    result[index] = iteratee(array[index], index, array);
  }
  return result;
}

module.exports = arrayMap;


/***/ }),
/* 34 */
/***/ (function(module, exports, __webpack_require__) {

var getNative = __webpack_require__(2);

var defineProperty = (function() {
  try {
    var func = getNative(Object, 'defineProperty');
    func({}, '', {});
    return func;
  } catch (e) {}
}());

module.exports = defineProperty;


/***/ }),
/* 35 */
/***/ (function(module, exports, __webpack_require__) {

var baseHasIn = __webpack_require__(83),
    hasPath = __webpack_require__(84);

/**
 * Checks if `path` is a direct or inherited property of `object`.
 *
 * @static
 * @memberOf _
 * @since 4.0.0
 * @category Object
 * @param {Object} object The object to query.
 * @param {Array|string} path The path to check.
 * @returns {boolean} Returns `true` if `path` exists, else `false`.
 * @example
 *
 * var object = _.create({ 'a': _.create({ 'b': 2 }) });
 *
 * _.hasIn(object, 'a');
 * // => true
 *
 * _.hasIn(object, 'a.b');
 * // => true
 *
 * _.hasIn(object, ['a', 'b']);
 * // => true
 *
 * _.hasIn(object, 'b');
 * // => false
 */
function hasIn(object, path) {
  return object != null && hasPath(object, path, baseHasIn);
}

module.exports = hasIn;


/***/ }),
/* 36 */
/***/ (function(module, exports) {

/**
 * Appends the elements of `values` to `array`.
 *
 * @private
 * @param {Array} array The array to modify.
 * @param {Array} values The values to append.
 * @returns {Array} Returns `array`.
 */
function arrayPush(array, values) {
  var index = -1,
      length = values.length,
      offset = array.length;

  while (++index < length) {
    array[offset + index] = values[index];
  }
  return array;
}

module.exports = arrayPush;


/***/ }),
/* 37 */
/***/ (function(module, exports) {

/**
 * The base implementation of `_.times` without support for iteratee shorthands
 * or max array length checks.
 *
 * @private
 * @param {number} n The number of times to invoke `iteratee`.
 * @param {Function} iteratee The function invoked per iteration.
 * @returns {Array} Returns the array of results.
 */
function baseTimes(n, iteratee) {
  var index = -1,
      result = Array(n);

  while (++index < n) {
    result[index] = iteratee(index);
  }
  return result;
}

module.exports = baseTimes;


/***/ }),
/* 38 */
/***/ (function(module, exports, __webpack_require__) {

var ListCache = __webpack_require__(12),
    stackClear = __webpack_require__(118),
    stackDelete = __webpack_require__(119),
    stackGet = __webpack_require__(120),
    stackHas = __webpack_require__(121),
    stackSet = __webpack_require__(122);

/**
 * Creates a stack cache object to store key-value pairs.
 *
 * @private
 * @constructor
 * @param {Array} [entries] The key-value pairs to cache.
 */
function Stack(entries) {
  var data = this.__data__ = new ListCache(entries);
  this.size = data.size;
}

// Add methods to `Stack`.
Stack.prototype.clear = stackClear;
Stack.prototype['delete'] = stackDelete;
Stack.prototype.get = stackGet;
Stack.prototype.has = stackHas;
Stack.prototype.set = stackSet;

module.exports = Stack;


/***/ }),
/* 39 */
/***/ (function(module, exports, __webpack_require__) {

var baseIsEqualDeep = __webpack_require__(123),
    isObjectLike = __webpack_require__(6);

/**
 * The base implementation of `_.isEqual` which supports partial comparisons
 * and tracks traversed objects.
 *
 * @private
 * @param {*} value The value to compare.
 * @param {*} other The other value to compare.
 * @param {boolean} bitmask The bitmask flags.
 *  1 - Unordered comparison
 *  2 - Partial comparison
 * @param {Function} [customizer] The function to customize comparisons.
 * @param {Object} [stack] Tracks traversed `value` and `other` objects.
 * @returns {boolean} Returns `true` if the values are equivalent, else `false`.
 */
function baseIsEqual(value, other, bitmask, customizer, stack) {
  if (value === other) {
    return true;
  }
  if (value == null || other == null || (!isObjectLike(value) && !isObjectLike(other))) {
    return value !== value && other !== other;
  }
  return baseIsEqualDeep(value, other, bitmask, customizer, baseIsEqual, stack);
}

module.exports = baseIsEqual;


/***/ }),
/* 40 */
/***/ (function(module, exports, __webpack_require__) {

var SetCache = __webpack_require__(124),
    arraySome = __webpack_require__(127),
    cacheHas = __webpack_require__(128);

/** Used to compose bitmasks for value comparisons. */
var COMPARE_PARTIAL_FLAG = 1,
    COMPARE_UNORDERED_FLAG = 2;

/**
 * A specialized version of `baseIsEqualDeep` for arrays with support for
 * partial deep comparisons.
 *
 * @private
 * @param {Array} array The array to compare.
 * @param {Array} other The other array to compare.
 * @param {number} bitmask The bitmask flags. See `baseIsEqual` for more details.
 * @param {Function} customizer The function to customize comparisons.
 * @param {Function} equalFunc The function to determine equivalents of values.
 * @param {Object} stack Tracks traversed `array` and `other` objects.
 * @returns {boolean} Returns `true` if the arrays are equivalent, else `false`.
 */
function equalArrays(array, other, bitmask, customizer, equalFunc, stack) {
  var isPartial = bitmask & COMPARE_PARTIAL_FLAG,
      arrLength = array.length,
      othLength = other.length;

  if (arrLength != othLength && !(isPartial && othLength > arrLength)) {
    return false;
  }
  // Assume cyclic values are equal.
  var stacked = stack.get(array);
  if (stacked && stack.get(other)) {
    return stacked == other;
  }
  var index = -1,
      result = true,
      seen = (bitmask & COMPARE_UNORDERED_FLAG) ? new SetCache : undefined;

  stack.set(array, other);
  stack.set(other, array);

  // Ignore non-index properties.
  while (++index < arrLength) {
    var arrValue = array[index],
        othValue = other[index];

    if (customizer) {
      var compared = isPartial
        ? customizer(othValue, arrValue, index, other, array, stack)
        : customizer(arrValue, othValue, index, array, other, stack);
    }
    if (compared !== undefined) {
      if (compared) {
        continue;
      }
      result = false;
      break;
    }
    // Recursively compare arrays (susceptible to call stack limits).
    if (seen) {
      if (!arraySome(other, function(othValue, othIndex) {
            if (!cacheHas(seen, othIndex) &&
                (arrValue === othValue || equalFunc(arrValue, othValue, bitmask, customizer, stack))) {
              return seen.push(othIndex);
            }
          })) {
        result = false;
        break;
      }
    } else if (!(
          arrValue === othValue ||
            equalFunc(arrValue, othValue, bitmask, customizer, stack)
        )) {
      result = false;
      break;
    }
  }
  stack['delete'](array);
  stack['delete'](other);
  return result;
}

module.exports = equalArrays;


/***/ }),
/* 41 */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(module) {var root = __webpack_require__(1),
    stubFalse = __webpack_require__(140);

/** Detect free variable `exports`. */
var freeExports = typeof exports == 'object' && exports && !exports.nodeType && exports;

/** Detect free variable `module`. */
var freeModule = freeExports && typeof module == 'object' && module && !module.nodeType && module;

/** Detect the popular CommonJS extension `module.exports`. */
var moduleExports = freeModule && freeModule.exports === freeExports;

/** Built-in value references. */
var Buffer = moduleExports ? root.Buffer : undefined;

/* Built-in method references for those with the same name as other `lodash` methods. */
var nativeIsBuffer = Buffer ? Buffer.isBuffer : undefined;

/**
 * Checks if `value` is a buffer.
 *
 * @static
 * @memberOf _
 * @since 4.3.0
 * @category Lang
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is a buffer, else `false`.
 * @example
 *
 * _.isBuffer(new Buffer(2));
 * // => true
 *
 * _.isBuffer(new Uint8Array(2));
 * // => false
 */
var isBuffer = nativeIsBuffer || stubFalse;

module.exports = isBuffer;

/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(42)(module)))

/***/ }),
/* 42 */
/***/ (function(module, exports) {

module.exports = function(module) {
	if(!module.webpackPolyfill) {
		module.deprecate = function() {};
		module.paths = [];
		// module.parent = undefined by default
		if(!module.children) module.children = [];
		Object.defineProperty(module, "loaded", {
			enumerable: true,
			get: function() {
				return module.l;
			}
		});
		Object.defineProperty(module, "id", {
			enumerable: true,
			get: function() {
				return module.i;
			}
		});
		module.webpackPolyfill = 1;
	}
	return module;
};


/***/ }),
/* 43 */
/***/ (function(module, exports, __webpack_require__) {

var baseIsTypedArray = __webpack_require__(141),
    baseUnary = __webpack_require__(142),
    nodeUtil = __webpack_require__(143);

/* Node.js helper references. */
var nodeIsTypedArray = nodeUtil && nodeUtil.isTypedArray;

/**
 * Checks if `value` is classified as a typed array.
 *
 * @static
 * @memberOf _
 * @since 3.0.0
 * @category Lang
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is a typed array, else `false`.
 * @example
 *
 * _.isTypedArray(new Uint8Array);
 * // => true
 *
 * _.isTypedArray([]);
 * // => false
 */
var isTypedArray = nodeIsTypedArray ? baseUnary(nodeIsTypedArray) : baseIsTypedArray;

module.exports = isTypedArray;


/***/ }),
/* 44 */
/***/ (function(module, exports, __webpack_require__) {

var isObject = __webpack_require__(7);

/**
 * Checks if `value` is suitable for strict equality comparisons, i.e. `===`.
 *
 * @private
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` if suitable for strict
 *  equality comparisons, else `false`.
 */
function isStrictComparable(value) {
  return value === value && !isObject(value);
}

module.exports = isStrictComparable;


/***/ }),
/* 45 */
/***/ (function(module, exports) {

/**
 * A specialized version of `matchesProperty` for source values suitable
 * for strict equality comparisons, i.e. `===`.
 *
 * @private
 * @param {string} key The key of the property to get.
 * @param {*} srcValue The value to match.
 * @returns {Function} Returns the new spec function.
 */
function matchesStrictComparable(key, srcValue) {
  return function(object) {
    if (object == null) {
      return false;
    }
    return object[key] === srcValue &&
      (srcValue !== undefined || (key in Object(object)));
  };
}

module.exports = matchesStrictComparable;


/***/ }),
/* 46 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__block_multipurpose_gutenberg_block_block__ = __webpack_require__(47);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__block_slider_block__ = __webpack_require__(48);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__block_button_block__ = __webpack_require__(96);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__block_Heading_block__ = __webpack_require__(97);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__block_Heading_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_3__block_Heading_block__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__block_image_block__ = __webpack_require__(98);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__block_image_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_4__block_image_block__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__block_image_with_text_block__ = __webpack_require__(99);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__block_image_with_text_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_5__block_image_with_text_block__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6__block_schedule_block_block__ = __webpack_require__(100);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6__block_schedule_block_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_6__block_schedule_block_block__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_7__block_quotes_block__ = __webpack_require__(101);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_8__block_not_to_be_missed_block__ = __webpack_require__(102);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_9__block_latest_show_news_block__ = __webpack_require__(103);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_10__block_accordion_block__ = __webpack_require__(104);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_11__block_meet_the_team_block__ = __webpack_require__(110);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_12__block_awards_block_block__ = __webpack_require__(111);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_13__block_advertisement_block__ = __webpack_require__(112);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_14__block_custom_block_block__ = __webpack_require__(113);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_15__block_featured_boxes_block__ = __webpack_require__(167);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_16__block_cross_promo_block__ = __webpack_require__(168);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_16__block_cross_promo_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_16__block_cross_promo_block__);


















wp.domReady(function () {
    wp.blocks.unregisterBlockType('yoast/how-to-block');
    wp.blocks.unregisterBlockType('yoast/faq-block');
});

(function () {
    var nabShowIcon = wp.element.createElement(
        'svg',
        { version: '1.1', id: 'Layer_1', xmlns: 'http://www.w3.org/2000/svg', xlink: 'http://www.w3.org/1999/xlink', x: '0px', y: '0px', width: '25px', height: '25px', viewBox: '0 0 72 72', 'enable-background': 'new 0 0 72 72' },
        wp.element.createElement('image', { id: 'image0', width: '72', height: '72', x: '0', y: '0', href: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEgAAABICAYAAABV7bNHAAAABGdBTUEAALGPC/xhBQAAACBjSFJN\r AAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAABmJLR0QA/wD/AP+gvaeTAAAW\r 80lEQVR42u2caZRc1XXv/+ece2/NVV1zT9WDuqUWGiIkISwGAzYPCB6QwfbzyyOyHUxW4jiJYww2\r s7HhGRz8gBiInWVYBhsTh+XEfgbjIdiAGWRkNKEBtXqunqq7q6u6a77DOScfGgxddUtqDURirXe+\r dfW959b93X32/p+99y0ipcT/H/WHUv3BK69sP+5Jh4ZGoOs6CCGLPidSoH3dZlBfDFJwAAAlBAXd\r wq6ROXTyYbhRgQQ9putSSjE3N7duZCT5KqW05t6klGhpaT7D5XLtkEKAEYmyVDHtaEVFC8HBgGsv\r 6To8oJM1OGGYISG06EPgYMcGiBBMTqauMwxDoXQxZM45gsGGR9sSiR2UAIDEpOnGpBWECQYiOGDz\r YE4ZQBQCOeqHS2fQrMJRWxGlFIVicX2xWPwoY7WACSHljvaOu90OFXkD6Nf9SHMXKCQoOOo5mlMG\r EJESpiRQm3uwPmTAFGTp5xIC07Tw7LPP3QDAWf1/y7IQj8f+dXlX+/6RAsO+kgZTUjAijjj3KQMI\r ABgkZnQNupRwqYBYYvxQVRXJZN/FhULh44pSe0uU0uJpPSvuJg4fpnIaQCtwUwLgrYcgJaCyU3iJ\r AQAhQNEE+ueBHk8ZpiA4kh0RSlAqlWlv76Ebqv0OAAghEPD77tNc3oNFLYi+6akrRtKldoWRRfiF\r BNwaLQB46JQFBAAKlRgpKAjzCjQqcSQjUhQFwyMjl+Tz+QvsrIcQOuVxuR4oQ8N41lz+wLNDT1QM\r zihdjN4wOC5aE/vuKQ+IANChYNx0IUEz4JIBdTARQlDRdTo2Nm5rPZxzhIMN3wk3J1LC34TvPzt8\r Q9ngzK0tduJCSPj8juyW9Y231TyAkw3EbjBIpEwPfGIaCnSgzkKjlCKVmvpgqVR6r13kopRONzbG\r vu2ItmHPRHnN873pK51q7XFlU+CjG5sfXN3km3hXACKQMImGGRlARB+HIPa6SAqpzMzMfMnOeizL\r Qktz4wP+aOvUsO7Bk7snbjQsoVUD4kIi7tfSn9jU/C2Po/Y6pyQgAGAQyLIg1FIShJcWPPjb/88Y\r 5ufnP1ipVM6tsR4JMKaklrUlvpOmDdg3WVq/Kzn3MYeN9eiWwMWrY98Me7SZXMV69wACJExocDSv\r QJe7tEgXMUaRz+W1kWTyy3bWY1oWupe136+Fmmf2jBG81Je+yeJS1ZTFkIUAQh416VLpt/91+xiE\r BC5cGXm3AAIIBOaIDx6/BkrIH121qqoYSY7+hWEYZ6mquhirlHA4tNTq01Z8J0V9GJ3Lndk7VfiI\r qtgsQyGwqSN0T8Cl5CqmgI0MOrUBMQJkdIL+jIUmtQQuCSglKFd07+Dg0LV2YZ1zjuam+C2qL5Jp\r 9IQxOpv6qsUFU+ji5WUJiYhXGzprWfAhlZG6ovSUBgQsxK954UDUyoFLAkVRMDQ49Cld17urAUkp\r oarqXkbZYzmDYPd07n2vDGX/1C5yWVzg/Ssjd0d9jqJuinqB8t0AaCGilXQLBAK5fN4/mUpdYxfW\r hRCIRULf9McTlVniJ4++2HubndQ0uUBL0NV34WnRRxRG4HHUv/4pDwiQEFRFkROoZgUjybFPm6a5\r rBrQG9bzWryx8QkSbsPLA9lL947nznMqtSBNLnHFhqY7mwKOcsnkh736KQFIYQQOhUKg1tKFlCCU\r 0QqcIpceachms1+wsx7OOZZ1JL7hCLVU9s8z9uSu5C3EZtkYlsCKuGf/lnWNj6mMwE77nFRACxje\r GppCsW88t/nRbWPfUBRKSNW+Qje5+pGNidvWu8ivU9nspznnHdWhXUoJp9O5u7Wl9ccj0o8Dk4UP\r DaVLmzXbyCVx5Xtav9YYcJgF3TriZvi/FxAhIJaB1HwFQgoQAAqjeOjF5Nf3jOXOc1TdkMkl4gHn\r xJq4uj1U0mOvFUpfqKeaV69cfldRCxmvjlrqC33pm4mN+VhcojXofKWgWz/+wbZR2x3e+rbAyQMk\r JeCgAqZlomhKuBSKV0fmLt47lnufz1n7VUzO8amzEzefHhZzv9vTdzfnvK06cgkh4PV6d3V1d/2H\r bGhCZWj6iuRs+QyXZr90zu4O3QFAFI3D+56TAwiAxiTMoo7JnICDEfrk7tQtqOMrVrX4D1y2OvDD\r wUO7W8cmUn9ZR/eIzo62G52BmJmRmnPbwOxtjBLb+Tqj7hfWtfh/zqWEb4nJuBMOiBACSikopTVV\r DSEEKAEiLomxAkHvVPEDg+nSuZqNhBUS2NAW+AotpI2BgcFrhBCB6uUlhIDL5fyVbli/nNUpnjw4\r vfXgZGGlneMlhODSNbH/E/Kq0rCWXuqqASTEkfO0h4NjWRbN5XJ/ZpqmZ9EGU0pIQBdc/NtcyayM\r zHL2XG/6ZrucocklmkPuP3T4xE8GD/V2zGayf2FnPRLg8Wj4Lk8sgYEc9f5o++j1do5ZNznWtPh/\r u3lZ6FdcCMjD6J4jAspksscERwJQmIKpqamLkqOjj9mVXSKR8GO5YvkHyxqb8fLE7EeGZ8vvcdv4\r CiklLlgRvn2NZ45P9E58gQvRYKd73E7nLyOx+O90XzOe65359ES2sqza90gJUErlFRuabnepFDYb\r 9qMDZFpHOcMbgxACwzDIxOTkDYwx2ESRYmd7222Kp0FwxaU9f3Dmq7a+ggt0xnzbNkbkU/mJgc65\r XOHTdVSzWNaRuFP4mnBwVgR+vW/qOrsNacXiOGtZ6JcXrYo+p1tHvzpqAOVzuWMCxJiCXC53aaVS\r Ob/6ht6wnkeDofCAcIfx5J7Un+2fKKy28xVSApdvaPrq2nBe/uHA7DVSwl/NWggBn8/781hj80t7\r Kl78YTh79UzeaHOqtGYuhRLr6ve23R5wKygb4oi654iAIpHoUcOhlKBYLJHBoSHb7B4hJN/Z1nqP\r qfkxmBXuH20fu8nWV1gCK5v8z/+PLvevRGp4Q6FUvtrWeqTkq1Z03TlmePDqhB7cPpj9gp2jN4VA\r d9Tz79O5yraf7U5hKW0I6xL+wwPq7Gw/akCqqmLXrt1/ruv6+dX5GcviiEXDPwgEwwMjhhu/7Z/5\r 1Fi2stxV/bSxkDS86pzEV+KsgGf2H7wZNkVAzjki4dBP2zuXbTP0Boy9Nvo3cyWzxWFjPQ5G9fcu\r D92ZLpiw+LEFnxpAuq4f1QSEEMzPz7sO9fXdZF+0I8XO9sQ989KN/nnhe+bA9JdUG9+jWwLr24NP\r n92qPt+7d8d7ZjPZy+zmA0gh6PffWKYuaA5X0+sT+WsUZjMfF9jYFnhiecyz51h8T11A+Xzh6CZQ\r FBzs7f3zclnvUdXF01mcIxoJP+pvCA3sKDqwc2T+qnTB6HDYLC+VEt4ddd2amUxiJJm8gVJas7ak\r lPC4nY9CcRwqwI0fbR/7/HTeCFX7MikBt8oqF62K3qUpFJQerec5DCDDMJZ8MiEEhWLBMz4+fq1i\r k1aghORXLOu4Z6SkYdekGXhlcPaLdk/b4ALdcf9PN0bkjpnR/rPncoUP2fkeALl4NHyfp6kT+2d4\r +1N7Jj/r0mphl02O96+M/PD0ROBA2VzalmLJgArF4pJPZoxhZCT5ScMwV1TfkGVZaG5ueiTR0Tlg\r GX6kXh/762zJTFRn996oiRsXnxb+WocyjoHJqRuIjfVwzhHw+78fiDb1F10x/OLVyWvyFctfrXuE\r lPA5leJHNzb9o0OhIARHHbkOC6hSrizpREIITMv0zc5mbHfYhNJ8z/Kue4XDDyKdsX3juWsVm0hj\r WALrO0I/7nEXX5tJ9p9bLFcurTNfrqsjcU/JGcOuiUrXi33pz9QrAn54XeMj7+kMHirqx2c9toBK\r pdKSTqSUYjaT+STn1vLqG1oo2jU9Eo41DqV0FY//Pvn51LwesfMVDpUaH9vYeEfc6MOBzNz1hBBb\r 64lFI9/zRpqGdmaceKkvfV3ZFJ5qXyakhFdjmQtXRv5xrmhCP8bIdVhAPT3Lj3gSYwyzs5mGoeHh\r utZz2orue3LSjQOpcssv9k5/rlrEAUDF5Dh/Zezx89q018f35beUdePSapkAAISQ+VU93fcmDQ8O\r Tus9+8dzn7TTPRaXWNvm/5e947nkzpG5YwJyyerFOrAGkNfrPewEhCyo5n37Dlxncd6lVoXiN63H\r H4kP75oDfrF36ou5ihlwqdW+AvA6ldJVZzXfQfOTyqGBoVsZq71ry7LQlmh9KN6SGNGUKKZ3H7qh\r YnKXXQk54FJnzuxo+JbGKBR65NaZpYwaQMXi4ZcYYwxzc1Mto2Njf6XYbCAppflVK7vvnaioODBV\r af/9YOYzdmG9bHBcsrHl0TUhPrD75QOfKBRKG6plAgBQSkfi0chdXPOjb7qy/tXh7JWaTcQ0uMQZ\r HYEHOyOuVMU8/qVVF9CRhKLCGA719X+ecx6uFnKccyRamh9xN8SGnhky8VJ/9tqywf1aja8AvE5l\r rrNBvWNmbFgZn0xdz5h985Pf67k/p8v0lKHisW0DN1dMoVRHLi4kIl41dXZX8J+FXEjjvmOAypX6\r UYwSgtlCMZFOp6+u1+q2qqf73sE8w6F0pWv/eP4qu7Y2kwusbg19d5m7ODHU33tlpVI5ndkUARlj\r w02N8YedTV14eSi/+aX+2cudNukR3RR4//rIt1Y2+WZKS0ylHjOgyuEAUYqRZPLzUspgdTrDsiw0\r NTXe64/Eh5gzipntfTeWDMtdq1MAv0ud/dMe/zdDlUOOwXTmOlqnCBgNB//JEWycm7C8eGr36M1C\r oiaJYnGJ5qBzbMvpTd9xqQzaCbQeW0A5u3THQtIJumF05HK5q+wil6Ioow5VvTdrMIwUzLXbh7Jb\r 7dpNDEvg7OXRb7ez7PRMMrnVMK11dmUcVVUH2xIt30trEeydKJy3byz/gXoZgI9ubPq/PXFvtmgc\r Wy7rqAC5nK6agwhZ+NKTqdTf21mPEAJ+n/dBhy+YybEAHnlx6JaywVU7XxH0aFOf2BC9r7nc796e\r K1xXr3WurbX5PultnO+f1/By39RNQkqiVMUlS0i0BJ39F6+KPVzQLVjHkS5eMqCVK1fUHqQoSCaT\r a/L5/Gfq+J6xBr/vIUesA3smSpu2DWSusFO5FUtgy6roA2fE5OzeV8ZvM0xrrWrjexxOx+Dyrs7v\r ZZwh9A8WLzw0VbjYznqEkDit0XvX73rTeeMEiEIAOH9F+PCADMNc9DchC/6l91DfLYQQf/XxQggE\r fN4HmDc0mxIB/L+d4zdzIVn1ptQSEs0NzomtmxrvT48fJIYlftPWmthe7VS4ECQSahj2x1sLXk+c\r Df1mz1ftWlMsIdEYcO5f1ex9vGRwHLkf9thG7Wa1sDjdwRhDKpXaNDububxOo+RoQ8D3UN7ZhH2p\r 8tn7x3Mf0lS7yoLAxzc239se88+PzDBomvaCqqBmJyksE6rDBemJ4um9Ux/eOTJ3jl0RkAuJc7uD\r d7WFXOWKefSp1GMG9PbXowgh4JwjOTr6ZUJIzR5ACIEGv/fBihqY7S158Nzr07cKKSmr+rpcSER9\r Wl/Yo377twdn4S5TuCBhLnroEhAc1BNEObQC/WldffyVsVvsEvsmF0iEXHv+pMX/hGFJUPJO4bFL\r mL3NghhjSKfTm+fnc1vqWM9YwOd7SGnsRG4SF4zMFi+xE2lcSKxL+L85MVcpHpouo83JsJoQvNmn\r QCQHCIOMdoNEOqBoKp4/OP2x3qnCBpdd85OQ+NDa+Nc7om6jbIjjy2ccLaA3lTTBQiIlNTn1JUKI\r bYHR6/E84AlGZ9uXd5EHd+z/GhdA9f1YQqKpwfn6OV3B7xOy0OqmSQVmnoLABJECFTWAfGAZhDMA\r mtMhZcXx9N7pG5Q6qdmVjd5XL+gJ/4cEoDhPrO45IqDc/IIOYoyhWCyeXSqXLrMLxYyx0Xgs8t3m\r zhV4YWDugzuGs++18xWWkNjc2XC3x6FUdFOAEYATBwpKED5rCnOeDuTczZCgIBUdDpVhx8j8/xrN\r lNc6VLuStMTWzYmvtYddVtHg76Tx2APq6GgHXWjxx85du79ULz8TjYTvDzUlMlNoYI++2HsrreMr\r OsPuve9bGXlcAvC+WfKlFKbSjh2TAZR1P6heASBBQEAp3C/1Z77MbFKzFUvg9NbAC+f3hH+uWwLs\r HfQ9dQHF41GoqoYDB16/rFyuXGa3w2ZMGY3HIg8bzih+15+9vDeV32TfKClx6ZrYXTG/Uy+/bY/E\r KDBluqD6ANdC0RrAQjPVtoHslamcfppdBoARYHnc/ZVnDswIw3pnfM9ZXcHDA8rnC7AsrvQe6ruJ\r 2YQQzjni0cj9qi+c6S1o6lO7R29m1H4LsKrZt+PyDY1PSAAB11uXIgCaG5zY2P6WrFIowXzZ9D/8\r YvLGepGrM+L5VczneHY0W8Y7JHtqRg0gy+IYHBreUigUz6y2njd22KPxWOThKQSxc6z4P8ez5XXV\r KldiIZ26dXPr10MezXr7DltKibIh8HbtsrD8FPxsz9RfTszpHTWpWQCUEPG+nvAdzQ1OmCdINR8T\r oLn5eW18fPx6uzKOEALxaPh+QwtkXssozpf6pm+08z0Wl+iMuJ6LeLWf7h6dh3ijO1NKCY0t9A3x\r t+ktRgiG0qXwv++Y/KJdatawBNa2+J9e2eh90bAEmHJsL/2eEECjo2NbS6XSGYyxRaJRAmCUTkSj\r 0Yfbupfj2V3F/52ar6yya18hBFjV5Ltz22BGmPytOYSQWNvqR1PAiTcL5RKApjI891r6s9N5val6\r voXrErHl9Mbbo34HjOOokp4QQJZlJYLB4L/Z7NiJz+P+WagxkSlrQe+zrw/dqtYp4/Q0en+9oS3w\r 6+oNJKMEQkqMZ8t//IxSgqJeij9zYObv7RxzxeQ4pzv0k3UJ//aKKWAXDP5bAQUbGm6zO1AKDs3p\r hiPWgSd2Tlw9MFNs9zqqfRRACZHndAfv9DgYVL6QOJdYEJ4GF6iuVWmM4MX+zN9limbUqbJFHRhi\r YUlanzorcUej34HjqbGfMEBSSlT/XAURFojmAhpPQ29GNPz4D+PXOuu8e7WhPfD05mWh5wxL/DHQ\r MEIwVzKxMzm/KCVIAJhCduwYmf+cQ2U16ULTkrh4dfTxtS3+3ZXjLCGfMECLwEgJQKDoisEIdsHN\r PPjPvZOfnSkYLXbtK4wR8YG1sa+7NYbqUN0SdOIjDY2LojMBICXmr9jQdCEBqSHAhQAlZMDk71Qy\r 4zgAMcnBFSeyng6UnBFQITGbLkSe7U3/Q/WLacBCGeeCnvBP3r8y8nLFFDXNSowSuO17l7MEsG2M\r FJAYz1YgTuIPsNQuMSEgBMc0CyPjaAcXDpCiDrdGsX147nPzJStm16zkUinfujlxp9ehQKH2vsIS\r YkldXn8EJOVJhWMLyOX2YNrZghxCUKWABglGGabzevz3g9m/Veskzs/sbHgs4tV2DKdLtstBSokG\r twpNoUcF6WSPGkDtG85Dl+YAgQCBBBaKfLj9qUPXzpetiNemAcGp0nJbyPWNJ/ekYNV5dc/kHJs6\r g9jUHsSJyh+fFECGpDD0t5qoNEaxezTX/uRrU3/ttlO5XGBTR8MPlsc8rx8uDHMhoJvipC+Z4wY0\r k19cenZrDI+/MnZdrmx53TZFQJfKSud2h+72ORncon7ySkpACqBiCqiMnLSodNyACm8TciojGEqX\r lv/mYPoq2zKOyXHpmtjD69sC/SXzyMkrIRdaczVFwbvlp8FqX0UoLFiQBOBUGJ7aM3V9yRCuat3z\r Rqtb7qJV0Xsk7H9apgaQkNBNAY92sm/7OAC96UcUStA/U1j76sjcVqdt+4rAljMb/+X0RGC4oFtY\r SnJPyoXXL99NfqgG0P6JPABAZZTsTM5fZ3ChaIwuUrlvlHHSHz+j+T6nSsGousTLARLyXRXmybvF\r F5ys8V80XMCqvQZwzwAAACV0RVh0ZGF0ZTpjcmVhdGUAMjAxOS0xMS0wN1QxNjowNTo0MCswMzow\r MNZSCp8AAAAldEVYdGRhdGU6bW9kaWZ5ADIwMTktMTEtMDdUMTY6MDU6NDArMDM6MDCnD7IjAAAA\r GXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAABJRU5ErkJggg==' })
    );
    wp.blocks.updateCategory('nabshow', { icon: nabShowIcon });
})();

// Remove  'Remove from Reusable Blocks' button  from Reusable Blocks
setInterval(function () {
    jQuery('.components-button.block-editor-block-settings-menu__control').each(function () {
        if ('Remove from Reusable Blocks' === jQuery(this).text()) {
            jQuery(this).addClass('hideBtn');
        }
    });
}, 0.5);

/***/ }),
/* 47 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_classnames__ = __webpack_require__(29);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_classnames___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_classnames__);

(function (blocks, i18n, element, editor, components) {
	var __ = wp.i18n.__;
	var registerBlockType = wp.blocks.registerBlockType;
	var Fragment = wp.element.Fragment;
	var _wp$editor = wp.editor,
	    MediaUpload = _wp$editor.MediaUpload,
	    InspectorControls = _wp$editor.InspectorControls,
	    InnerBlocks = _wp$editor.InnerBlocks;
	var _wp$components = wp.components,
	    PanelBody = _wp$components.PanelBody,
	    PanelRow = _wp$components.PanelRow,
	    TextControl = _wp$components.TextControl,
	    Button = _wp$components.Button,
	    SelectControl = _wp$components.SelectControl,
	    RangeControl = _wp$components.RangeControl,
	    ToggleControl = _wp$components.ToggleControl,
	    ColorPalette = _wp$components.ColorPalette;

	var multipleBlockIcon = wp.element.createElement(
		"svg",
		{ xmlns: "http://www.w3.org/2000/svg", width: "20px", height: "20px", viewBox: "0 0 612 612" },
		wp.element.createElement(
			"g",
			null,
			wp.element.createElement("path", {
				fill: "#0f6cb6",
				d: "M1.659,484.737L1.001,206.595c-0.032-13.686,13.95-22.938,26.534-17.559l253.206,108.241c6.997,2.991,11.542,9.859,11.56,17.468l0.658,278.142c0.032,13.687-13.95,22.939-26.534,17.56L13.219,502.206C6.222,499.215,1.676,492.347,1.659,484.737z M581.805,219.687L348.142,320.883l0.608,257.406l233.664-101.196L581.805,219.687 M591.26,186.131c10.043-0.025,19.056,8.054,19.081,19.022l0.658,278.142c0.018,7.609-4.495,14.5-11.478,17.523l-252.69,109.438c-2.493,1.079-5.047,1.583-7.534,1.59c-10.044,0.023-19.058-8.055-19.083-19.022l-0.658-278.143c-0.019-7.609,4.495-14.5,11.479-17.523l252.69-109.437C586.218,186.64,588.771,186.137,591.26,186.131L591.26,186.131z M304.152,29.466L61.767,137.691l242.894,107.075l242.386-108.224L304.152,29.466 M304.083,0c2.632-0.006,5.266,0.533,7.728,1.618l266.403,117.439c15.112,6.663,15.163,28.088,0.082,34.821L312.451,272.577c-2.456,1.097-5.088,1.648-7.721,1.655c-2.632,0.006-5.266-0.533-7.728-1.618L30.6,155.175c-15.113-6.662-15.163-28.088-0.083-34.821L296.361,1.655C298.818,0.558,301.449,0.006,304.083,0L304.083,0z" })
		)
	);

	/*
  **   Block: MultiPurpose Gutenberg Block
  */
	registerBlockType('nab/multipurpose-gutenberg-block', {
		title: __('Multi Purpose Block'),
		description: __('Use one block containing multiple elements.'),
		icon: multipleBlockIcon,
		category: 'nabshow',
		attributes: {
			ElementTag: {
				type: 'string',
				default: 'div'
			},
			elementID: {
				type: 'string'
			},
			backgroundImage: {
				type: 'string',
				default: ''
			},
			backgroundColor: {
				type: 'string',
				default: ''
			},
			backgroundSize: {
				type: 'boolean',
				default: false
			},
			backgroundPosition: {
				type: 'string',
				default: ''
			},
			backgroundAttachment: {
				type: 'boolean',
				default: false
			},
			layout: {
				type: 'string',
				default: ''
			},
			borderStyle: {
				type: 'string',
				default: ''
			},
			borderWidth: {
				type: 'number'
			},
			borderColor: {
				type: 'string'
			},
			borderRadius: {
				type: 'number'
			},
			topBorderStyle: {
				type: 'string',
				default: ''
			},
			topBorderWidth: {
				type: 'number'
			},
			topBorderColor: {
				type: 'string'
			},
			topBorderRadius: {
				type: 'number'
			},
			bottomBorderStyle: {
				type: 'string',
				default: ''
			},
			bottomBorderWidth: {
				type: 'number'
			},
			bottomBorderColor: {
				type: 'string'
			},
			bottomBorderRadius: {
				type: 'number'
			},
			rightBorderStyle: {
				type: 'string',
				default: ''
			},
			rightBorderWidth: {
				type: 'number'
			},
			rightBorderColor: {
				type: 'string'
			},
			rightBorderRadius: {
				type: 'number'
			},
			leftBorderStyle: {
				type: 'string',
				default: ''
			},
			leftBorderWidth: {
				type: 'number'
			},
			leftBorderColor: {
				type: 'string'
			},
			leftBorderRadius: {
				type: 'number'
			},
			blockAlign: {
				type: 'string',
				default: 'center'
			},
			textAlign: {
				type: 'string',
				default: ''
			},
			width: {
				type: 'string',
				default: ''
			},
			height: {
				type: 'string',
				default: ''
			},
			opacity: {
				type: 'number',
				default: 0
			},
			overlayColor: {
				type: 'string'
			},
			paddingTop: {
				type: 'string',
				default: ''
			},
			paddingRight: {
				type: 'string',
				default: ''
			},
			paddingBottom: {
				type: 'string',
				default: ''

			},
			paddingLeft: {
				type: 'string',
				default: ''
			},
			marginTop: {
				type: 'string',
				default: ''
			},
			marginRight: {
				type: 'string',
				default: ''
			},
			marginBottom: {
				type: 'string',
				default: ''

			},
			marginLeft: {
				type: 'string',
				default: ''
			},
			gradientRange1: {
				type: 'number',
				default: 0
			},
			gradientRange2: {
				type: 'number',
				default: 0
			},
			gradientRange3: {
				type: 'number',
				default: 0
			},
			color1: {
				type: 'string',
				default: '#fff'
			},
			color2: {
				type: 'string',
				default: '#fff'
			},
			color3: {
				type: 'string',
				default: '#fff'
			},
			gradientType: {
				type: 'string',
				default: ''
			},
			ToggleInserter: {
				type: 'boolean',
				default: false
			}
		},
		edit: function edit(props) {
			var attributes = props.attributes,
			    setAttributes = props.setAttributes,
			    className = props.className;
			var backgroundImage = attributes.backgroundImage,
			    backgroundColor = attributes.backgroundColor,
			    backgroundSize = attributes.backgroundSize,
			    backgroundPosition = attributes.backgroundPosition,
			    backgroundAttachment = attributes.backgroundAttachment,
			    layout = attributes.layout,
			    borderStyle = attributes.borderStyle,
			    borderWidth = attributes.borderWidth,
			    borderColor = attributes.borderColor,
			    borderRadius = attributes.borderRadius,
			    blockAlign = attributes.blockAlign,
			    textAlign = attributes.textAlign,
			    width = attributes.width,
			    height = attributes.height,
			    opacity = attributes.opacity,
			    overlayColor = attributes.overlayColor,
			    paddingTop = attributes.paddingTop,
			    paddingRight = attributes.paddingRight,
			    paddingBottom = attributes.paddingBottom,
			    paddingLeft = attributes.paddingLeft,
			    marginTop = attributes.marginTop,
			    marginRight = attributes.marginRight,
			    marginBottom = attributes.marginBottom,
			    marginLeft = attributes.marginLeft,
			    gradientRange1 = attributes.gradientRange1,
			    gradientRange2 = attributes.gradientRange2,
			    gradientRange3 = attributes.gradientRange3,
			    color1 = attributes.color1,
			    color2 = attributes.color2,
			    color3 = attributes.color3,
			    gradientType = attributes.gradientType,
			    topBorderStyle = attributes.topBorderStyle,
			    topBorderWidth = attributes.topBorderWidth,
			    topBorderColor = attributes.topBorderColor,
			    topBorderRadius = attributes.topBorderRadius,
			    bottomBorderStyle = attributes.bottomBorderStyle,
			    bottomBorderWidth = attributes.bottomBorderWidth,
			    bottomBorderColor = attributes.bottomBorderColor,
			    bottomBorderRadius = attributes.bottomBorderRadius,
			    rightBorderStyle = attributes.rightBorderStyle,
			    rightBorderWidth = attributes.rightBorderWidth,
			    rightBorderColor = attributes.rightBorderColor,
			    rightBorderRadius = attributes.rightBorderRadius,
			    leftBorderStyle = attributes.leftBorderStyle,
			    leftBorderWidth = attributes.leftBorderWidth,
			    leftBorderColor = attributes.leftBorderColor,
			    leftBorderRadius = attributes.leftBorderRadius,
			    ElementTag = attributes.ElementTag,
			    elementID = attributes.elementID,
			    ToggleInserter = attributes.ToggleInserter;

			var onSelectLayout = function onSelectLayout(event) {
				var selectedLayout = event.target.value;
				var selectedClass = event.target.className;
				'components-button button has-tooltip active' === selectedClass && setAttributes({ layout: '' });
				'components-button button has-tooltip active' !== selectedClass && setAttributes({ layout: selectedLayout ? selectedLayout : '' });
			};

			var onSelectTagType = function onSelectTagType(event) {
				setAttributes({ ElementTag: event.target.value ? event.target.value : 'div' });
			};

			var classes = __WEBPACK_IMPORTED_MODULE_0_classnames___default()(className, layout && "has-" + layout, blockAlign && "is-block-" + blockAlign, width && 'has-custom-width', {
				'has-background-size': backgroundSize,
				'has-background-attachment': backgroundAttachment,
				'has-background-opacity': 0 !== opacity

			}, opacityRatioToClass(opacity));
			var style = {};
			backgroundImage && (style.backgroundImage = "url(" + backgroundImage + ")");
			backgroundColor && (style.backgroundColor = backgroundColor);
			backgroundPosition && (style.backgroundPosition = backgroundPosition);
			textAlign && (style.textAlign = textAlign);
			width && (style.width = width + '%');
			height && (style.height = height + 'px');
			overlayColor && (style.backgroundColor = overlayColor);
			paddingTop && (style.paddingTop = paddingTop + 'px');
			paddingRight && (style.paddingRight = paddingRight + 'px');
			paddingBottom && (style.paddingBottom = paddingBottom + 'px');
			paddingLeft && (style.paddingLeft = paddingLeft + 'px');
			marginTop && (style.marginTop = marginTop + 'px');
			marginRight && (style.marginRight = marginRight + 'px');
			marginBottom && (style.marginBottom = marginBottom + 'px');
			marginLeft && (style.marginLeft = marginLeft + 'px');
			gradientType && ('#fff' !== color1 || '#fff' !== color2 || '#fff' !== color3) && (style.background = 'linear-gradient(' + gradientType + ', ' + color1 + ' ' + gradientRange1 + '%, ' + color2 + ' ' + gradientRange2 + '%, ' + color3 + ' ' + gradientRange3 + '%)');

			marginTop && (style.marginTop = marginTop + 'px');
			if (borderStyle) {
				style.borderStyle = borderStyle;
				if (borderWidth) {
					style.borderWidth = borderWidth + 'px';
				}
				if (borderColor) {
					style.borderColor = borderColor;
				}
				if (borderRadius) {
					style.borderRadius = borderRadius;
				}
			} else {
				if (topBorderStyle) {
					style.borderTopStyle = topBorderStyle;
					if (topBorderWidth) {
						style.borderTopWidth = topBorderWidth + 'px';
					}
					if (topBorderColor) {
						style.borderTopColor = topBorderColor;
					}
					if (topBorderRadius) {
						style.borderTopLeftRadius = topBorderRadius;
					}
				}
				if (bottomBorderStyle) {
					style.borderBottomStyle = bottomBorderStyle;
					if (bottomBorderWidth) {
						style.borderBottomWidth = bottomBorderWidth + 'px';
					}
					if (bottomBorderColor) {
						style.borderBottomColor = bottomBorderColor;
					}
					if (bottomBorderRadius) {
						style.borderBottomRightRadius = bottomBorderRadius;
					}
				}
				if (rightBorderStyle) {
					style.borderRightStyle = rightBorderStyle;
					if (rightBorderWidth) {
						style.borderRightWidth = rightBorderWidth + 'px';
					}
					if (rightBorderColor) {
						style.borderRightColor = rightBorderColor;
					}
					if (rightBorderRadius) {
						style.borderTopRightRadius = rightBorderRadius;
					}
				}
				if (leftBorderStyle) {
					style.borderLeftStyle = leftBorderStyle;
					if (leftBorderWidth) {
						style.borderLeftWidth = leftBorderWidth + 'px';
					}
					if (leftBorderColor) {
						style.borderLeftColor = leftBorderColor;
					}
					if (leftBorderRadius) {
						style.borderBottomLeftRadius = leftBorderRadius;
					}
				}
			}

			return [wp.element.createElement(
				InspectorControls,
				null,
				wp.element.createElement(
					"div",
					{ className: "custom-inspactor-setting" },
					wp.element.createElement(
						"div",
						{ className: "full-width mt30" },
						wp.element.createElement(ToggleControl, {
							label: __('Toggle Inserter'),
							checked: !!ToggleInserter,
							onChange: function onChange() {
								return setAttributes({ ToggleInserter: !ToggleInserter });
							}
						})
					),
					wp.element.createElement(
						PanelBody,
						{ title: __('Wrapper'), initialOpen: false },
						wp.element.createElement(
							Button,
							{
								className: 'header' === ElementTag ? 'button active' : 'button',
								onClick: onSelectTagType,
								value: "header" },
							__('Header')
						),
						wp.element.createElement(
							Button,
							{
								className: 'section' === ElementTag ? 'button active' : 'button',
								onClick: onSelectTagType,
								value: "section" },
							__('Section')
						),
						wp.element.createElement(TextControl, {
							label: "Wrapper Tag ID Attribute",
							type: "string",
							placeHolder: "id",
							value: elementID,
							onChange: function onChange(value) {
								return setAttributes({ elementID: value });
							}
						})
					),
					wp.element.createElement(
						PanelBody,
						{ title: __('Page Layout'), initialOpen: false },
						wp.element.createElement(
							Button,
							{
								className: 'full' === layout ? 'button has-tooltip active' : 'button has-tooltip',
								onClick: onSelectLayout,
								"data-tooltip": "This layout is for full width (width:100%).",
								value: "full"
							},
							__('Full Width')
						),
						wp.element.createElement(
							Button,
							{
								className: 'fixed' === layout ? 'button has-tooltip active' : 'button has-tooltip',
								onClick: onSelectLayout,
								"data-tooltip": "This layout is for fixed width (width:1200px).",
								value: "fixed" },
							__('Fixed')
						),
						wp.element.createElement(
							Button,
							{
								className: 'semi' === layout ? 'button has-tooltip active' : 'button has-tooltip',
								onClick: onSelectLayout,
								"data-tooltip": "This layout is for Semi width (width:85%).",
								value: "semi" },
							__('Semi')
						)
					),
					wp.element.createElement(
						PanelBody,
						{ title: __('Background'), initialOpen: false, className: "bg-setting" },
						wp.element.createElement(
							PanelBody,
							{ title: __('Background Image'), initialOpen: false, className: "bg-setting bg-img-setting" },
							wp.element.createElement(MediaUpload, {
								onSelect: function onSelect(backgroundImage) {
									return setAttributes({
										backgroundImage: backgroundImage.sizes.full.url ? backgroundImage.sizes.full.url : '',
										backgroundColor: ''
									});
								},
								type: "image",
								value: backgroundImage,
								render: function render(_ref) {
									var open = _ref.open;
									return wp.element.createElement(
										Button,
										{
											className: backgroundImage ? 'image-button' : 'button button-large',
											onClick: open },
										!backgroundImage ? __('Upload Image') : wp.element.createElement("div", { style: {
												backgroundImage: "url(" + backgroundImage + ")",
												backgroundSize: 'cover',
												backgroundPosition: 'center',
												height: '150px',
												width: '225px'
											} })
									);
								}
							}),
							backgroundImage ? wp.element.createElement(
								Button,
								{
									className: "button",
									onClick: function onClick() {
										return setAttributes({ backgroundImage: '', overlayColor: '' });
									} },
								__('Remove Background Image')
							) : null,
							backgroundImage && wp.element.createElement(
								Fragment,
								null,
								wp.element.createElement(ToggleControl, {
									label: __('Background Size ON - Set background size "Cover"'),
									checked: backgroundSize,
									onChange: function onChange() {
										return setAttributes({ backgroundSize: !backgroundSize });
									}
								}),
								wp.element.createElement(ToggleControl, {
									label: __('Background Attachment ON - Set background attachment "Fixed" '),
									checked: backgroundAttachment,
									onChange: function onChange() {
										return setAttributes({ backgroundAttachment: !backgroundAttachment });
									}
								}),
								wp.element.createElement(SelectControl, {
									label: __('Select Position'),
									value: backgroundPosition,
									options: [{ label: __('Bottom'), value: 'bottom' }, { label: __('Center'), value: 'center' }, { label: __('Inherit'), value: 'inherit' }, { label: __('Initial'), value: 'initial' }, { label: __('Left'), value: 'left' }, { label: __('Right'), value: 'right' }, { label: __('Top'), value: 'top' }, { label: __('Unset'), value: 'unset' }],
									onChange: function onChange(value) {
										return setAttributes({ backgroundPosition: value });
									}
								}),
								wp.element.createElement(
									"div",
									{ className: "inspector-field inspector-field-color components-base-control" },
									wp.element.createElement(
										"label",
										{ className: "inspector-mb-0" },
										"Overlay"
									),
									wp.element.createElement(
										"div",
										{ className: "inspector-ml-auto" },
										wp.element.createElement(ColorPalette, {
											value: overlayColor,
											onChange: function onChange(value) {
												return setAttributes({ overlayColor: value });
											}
										})
									)
								),
								wp.element.createElement(
									"div",
									{ className: "inspector-field inspector-border-radius components-base-control" },
									wp.element.createElement(
										"label",
										null,
										"Background Opacity"
									),
									wp.element.createElement(RangeControl, {
										value: opacity,
										min: 0,
										max: 100,
										step: 10,
										onChange: function onChange(ratio) {
											return setAttributes({ opacity: ratio });
										}
									})
								)
							)
						),
						wp.element.createElement(
							PanelBody,
							{ title: __('Background Color'), initialOpen: false, className: "bg-setting" },
							wp.element.createElement(
								PanelRow,
								null,
								wp.element.createElement(
									"div",
									{ className: "inspector-field inspector-field-color " },
									wp.element.createElement(
										"label",
										{ className: "inspector-mb-0" },
										"Background Color"
									),
									wp.element.createElement(
										"div",
										{ className: "inspector-ml-auto" },
										wp.element.createElement(ColorPalette, {
											value: backgroundColor,
											onChange: function onChange(value) {
												return setAttributes({ backgroundColor: value ? value : '', opacity: 0 });
											}
										})
									)
								)
							)
						),
						wp.element.createElement(
							PanelBody,
							{ title: __('Gradient Background'), initialOpen: false, className: "bg-setting gredient-setting" },
							wp.element.createElement(SelectControl, {
								label: __('Select Gradient Type'),
								value: gradientType,
								options: [{ label: __('Select Type'), value: '' }, { label: __('bottom'), value: 'to bottom' }, { label: __('Top'), value: 'to top' }, { label: __('Right'), value: 'to right' }, { label: __('Left'), value: 'to left' }, { label: __('Top Left'), value: 'to top left' }, { label: __('Bottom Left'), value: 'to bottom left' }, { label: __('Top Right'), value: 'to top right' }, { label: __('Bottom Right'), value: 'to bottom right' }],
								onChange: function onChange(value) {
									return setAttributes({ gradientType: value });
								}
							}),
							gradientType && wp.element.createElement(
								Fragment,
								null,
								wp.element.createElement(
									"h3",
									null,
									__('Gradient Fill 1')
								),
								wp.element.createElement(
									"div",
									{ className: "inspector-field inspector-field-color components-base-control gradientcolor" },
									wp.element.createElement(
										"label",
										{ className: "inspector-mb-0" },
										"Color"
									),
									wp.element.createElement(
										"div",
										{ className: "inspector-ml-auto" },
										wp.element.createElement(ColorPalette, {
											value: color1,
											onChange: function onChange(value) {
												return setAttributes({ color1: value ? value : '#fff' });
											}
										})
									)
								),
								wp.element.createElement(
									"div",
									{ className: "inspector-field inspector-border-radius components-base-control" },
									wp.element.createElement(
										"label",
										null,
										"Range"
									),
									wp.element.createElement(RangeControl, {
										value: gradientRange1,
										min: 0,
										max: 100,
										step: 10,
										onChange: function onChange(value) {
											return setAttributes({ gradientRange1: value });
										}
									})
								),
								wp.element.createElement(
									"h3",
									null,
									__('Gradient Fill 2')
								),
								wp.element.createElement(
									"div",
									{ className: "inspector-field inspector-field-color components-base-control gradientcolor" },
									wp.element.createElement(
										"label",
										{ className: "inspector-mb-0" },
										"Color"
									),
									wp.element.createElement(
										"div",
										{ className: "inspector-ml-auto" },
										wp.element.createElement(ColorPalette, {
											value: color2,
											onChange: function onChange(value) {
												return setAttributes({ color2: value ? value : '#fff' });
											}
										})
									)
								),
								wp.element.createElement(
									"div",
									{ className: "inspector-field inspector-border-radius components-base-control" },
									wp.element.createElement(
										"label",
										null,
										"Range"
									),
									wp.element.createElement(RangeControl, {
										value: gradientRange2,
										min: 0,
										max: 100,
										step: 10,
										onChange: function onChange(value) {
											return setAttributes({ gradientRange2: value });
										}
									})
								),
								wp.element.createElement(
									"h3",
									null,
									__('Gradient Fill 3')
								),
								wp.element.createElement(
									"div",
									{ className: "inspector-field inspector-field-color components-base-control gradientcolor" },
									wp.element.createElement(
										"label",
										{ className: "inspector-mb-0" },
										"Color"
									),
									wp.element.createElement(
										"div",
										{ className: "inspector-ml-auto" },
										wp.element.createElement(ColorPalette, {
											value: color3,
											onChange: function onChange(value) {
												return setAttributes({ color3: value ? value : '#fff' });
											}
										})
									)
								),
								wp.element.createElement(
									"div",
									{ className: "inspector-field inspector-border-radius components-base-control" },
									wp.element.createElement(
										"label",
										null,
										"Range"
									),
									wp.element.createElement(RangeControl, {
										value: gradientRange3,
										min: 0,
										max: 100,
										step: 10,
										onChange: function onChange(value) {
											return setAttributes({ gradientRange3: value });
										}
									})
								)
							)
						)
					),
					wp.element.createElement(
						PanelBody,
						{ title: __('Border'), initialOpen: false, className: "border-setting" },
						wp.element.createElement(
							PanelBody,
							{ title: __('All Border'), initialOpen: false, className: "border-setting" },
							wp.element.createElement(
								PanelRow,
								null,
								wp.element.createElement(
									"div",
									{ className: "inspector-field inspector-border-style" },
									wp.element.createElement(
										"label",
										null,
										"Border Style"
									),
									wp.element.createElement(
										"div",
										{ className: "inspector-field-button-list inspector-field-button-list-fluid" },
										wp.element.createElement(
											"button",
											{ className: 'solid' === borderStyle ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
													return setAttributes({ borderStyle: 'solid' });
												} },
											wp.element.createElement("span", { className: "inspector-field-border-type inspector-field-border-type-solid" })
										),
										wp.element.createElement(
											"button",
											{ className: 'dotted' === borderStyle ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
													return setAttributes({ borderStyle: 'dotted' });
												} },
											wp.element.createElement("span", { className: "inspector-field-border-type inspector-field-border-type-dotted" })
										),
										wp.element.createElement(
											"button",
											{ className: 'dashed' === borderStyle ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
													return setAttributes({ borderStyle: 'dashed' });
												} },
											wp.element.createElement("span", { className: "inspector-field-border-type inspector-field-border-type-dashed" })
										),
										wp.element.createElement(
											"button",
											{ className: 'none' === borderStyle ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
													return setAttributes({ borderStyle: 'none' });
												} },
											wp.element.createElement(
												"span",
												{ className: "inspector-field-border-type inspector-field-border-type-none" },
												wp.element.createElement("i", { className: "fa fa-ban" })
											)
										)
									)
								)
							),
							borderStyle && wp.element.createElement(
								Fragment,
								null,
								wp.element.createElement(
									PanelRow,
									null,
									wp.element.createElement(
										"div",
										{ className: "inspector-field inspector-field-color " },
										wp.element.createElement(
											"label",
											{ className: "inspector-mb-0" },
											"Color"
										),
										wp.element.createElement(
											"div",
											{ className: "inspector-ml-auto" },
											wp.element.createElement(ColorPalette, {
												value: borderColor,
												onChange: function onChange(borderColor) {
													return setAttributes({ borderColor: borderColor });
												}
											})
										)
									)
								),
								wp.element.createElement(
									PanelRow,
									null,
									wp.element.createElement(
										"div",
										{ className: "inspector-field inspector-border-width" },
										wp.element.createElement(
											"label",
											null,
											"Border Width"
										),
										wp.element.createElement(RangeControl, {
											value: borderWidth ? borderWidth : 0,
											min: 0,
											max: 10,
											onChange: function onChange(value) {
												return setAttributes({ borderWidth: value });
											}
										})
									)
								),
								wp.element.createElement(
									PanelRow,
									null,
									wp.element.createElement(
										"div",
										{ className: "inspector-field inspector-border-width" },
										wp.element.createElement(
											"label",
											null,
											"Border Radius"
										),
										wp.element.createElement(RangeControl, {
											value: borderRadius ? borderRadius : 0,
											min: 0,
											max: 100,
											onChange: function onChange(value) {
												return setAttributes({ borderRadius: value });
											}
										})
									)
								)
							)
						),
						!borderStyle && wp.element.createElement(
							PanelBody,
							{ title: __('Top Border'), initialOpen: false, className: "border-setting" },
							wp.element.createElement(
								PanelRow,
								null,
								wp.element.createElement(
									"div",
									{ className: "inspector-field inspector-border-style" },
									wp.element.createElement(
										"label",
										null,
										"Border Style"
									),
									wp.element.createElement(
										"div",
										{ className: "inspector-field-button-list inspector-field-button-list-fluid" },
										wp.element.createElement(
											"button",
											{ className: 'solid' === topBorderStyle ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
													return setAttributes({ topBorderStyle: 'solid' });
												} },
											wp.element.createElement("span", { className: "inspector-field-border-type inspector-field-border-type-solid" })
										),
										wp.element.createElement(
											"button",
											{ className: 'dotted' === topBorderStyle ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
													return setAttributes({ topBorderStyle: 'dotted' });
												} },
											wp.element.createElement("span", { className: "inspector-field-border-type inspector-field-border-type-dotted" })
										),
										wp.element.createElement(
											"button",
											{ className: 'dashed' === topBorderStyle ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
													return setAttributes({ topBorderStyle: 'dashed' });
												} },
											wp.element.createElement("span", { className: "inspector-field-border-type inspector-field-border-type-dashed" })
										),
										wp.element.createElement(
											"button",
											{ className: 'none' === topBorderStyle ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
													return setAttributes({ borderStyle: 'none' });
												} },
											wp.element.createElement(
												"span",
												{ className: "inspector-field-border-type inspector-field-border-type-none" },
												wp.element.createElement("i", { className: "fa fa-ban" })
											)
										)
									)
								)
							),
							topBorderStyle && wp.element.createElement(
								Fragment,
								null,
								wp.element.createElement(
									PanelRow,
									null,
									wp.element.createElement(
										"div",
										{ className: "inspector-field inspector-field-color " },
										wp.element.createElement(
											"label",
											{ className: "inspector-mb-0" },
											"Color"
										),
										wp.element.createElement(
											"div",
											{ className: "inspector-ml-auto" },
											wp.element.createElement(ColorPalette, {
												value: topBorderColor,
												onChange: function onChange(topBorderColor) {
													return setAttributes({ topBorderColor: topBorderColor });
												}
											})
										)
									)
								),
								wp.element.createElement(
									PanelRow,
									null,
									wp.element.createElement(
										"div",
										{ className: "inspector-field inspector-border-width" },
										wp.element.createElement(
											"label",
											null,
											"Border Width"
										),
										wp.element.createElement(RangeControl, {
											value: topBorderWidth ? topBorderWidth : 0,
											min: 0,
											max: 10,
											onChange: function onChange(value) {
												return setAttributes({ topBorderWidth: value });
											}
										})
									)
								),
								wp.element.createElement(
									PanelRow,
									null,
									wp.element.createElement(
										"div",
										{ className: "inspector-field inspector-border-width" },
										wp.element.createElement(
											"label",
											null,
											"Border Radius"
										),
										wp.element.createElement(RangeControl, {
											value: topBorderRadius ? topBorderRadius : 0,
											min: 0,
											max: 100,
											onChange: function onChange(value) {
												return setAttributes({ topBorderRadius: value });
											}
										})
									)
								)
							)
						),
						!borderStyle && wp.element.createElement(
							PanelBody,
							{ title: __('Right Border'), initialOpen: false, className: "border-setting" },
							wp.element.createElement(
								PanelRow,
								null,
								wp.element.createElement(
									"div",
									{ className: "inspector-field inspector-border-style" },
									wp.element.createElement(
										"label",
										null,
										"Border Style"
									),
									wp.element.createElement(
										"div",
										{ className: "inspector-field-button-list inspector-field-button-list-fluid" },
										wp.element.createElement(
											"button",
											{ className: 'solid' === rightBorderStyle ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
													return setAttributes({ rightBorderStyle: 'solid' });
												} },
											wp.element.createElement("span", { className: "inspector-field-border-type inspector-field-border-type-solid" })
										),
										wp.element.createElement(
											"button",
											{ className: 'dotted' === rightBorderStyle ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
													return setAttributes({ rightBorderStyle: 'dotted' });
												} },
											wp.element.createElement("span", { className: "inspector-field-border-type inspector-field-border-type-dotted" })
										),
										wp.element.createElement(
											"button",
											{ className: 'dashed' === rightBorderStyle ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
													return setAttributes({ rightBorderStyle: 'dashed' });
												} },
											wp.element.createElement("span", { className: "inspector-field-border-type inspector-field-border-type-dashed" })
										),
										wp.element.createElement(
											"button",
											{ className: 'none' === rightBorderStyle ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
													return setAttributes({ borderStyle: 'none' });
												} },
											wp.element.createElement(
												"span",
												{ className: "inspector-field-border-type inspector-field-border-type-none" },
												wp.element.createElement("i", { className: "fa fa-ban" })
											)
										)
									)
								)
							),
							rightBorderStyle && wp.element.createElement(
								Fragment,
								null,
								wp.element.createElement(
									PanelRow,
									null,
									wp.element.createElement(
										"div",
										{ className: "inspector-field inspector-field-color " },
										wp.element.createElement(
											"label",
											{ className: "inspector-mb-0" },
											"Color"
										),
										wp.element.createElement(
											"div",
											{ className: "inspector-ml-auto" },
											wp.element.createElement(ColorPalette, {
												value: rightBorderColor,
												onChange: function onChange(rightBorderColor) {
													return setAttributes({ rightBorderColor: rightBorderColor });
												}
											})
										)
									)
								),
								wp.element.createElement(
									PanelRow,
									null,
									wp.element.createElement(
										"div",
										{ className: "inspector-field inspector-border-width" },
										wp.element.createElement(
											"label",
											null,
											"Border Width"
										),
										wp.element.createElement(RangeControl, {
											value: rightBorderWidth ? rightBorderWidth : 0,
											min: 0,
											max: 10,
											onChange: function onChange(value) {
												return setAttributes({ rightBorderWidth: value });
											}
										})
									)
								),
								wp.element.createElement(
									PanelRow,
									null,
									wp.element.createElement(
										"div",
										{ className: "inspector-field inspector-border-width" },
										wp.element.createElement(
											"label",
											null,
											"Border Radius"
										),
										wp.element.createElement(RangeControl, {
											value: rightBorderRadius ? rightBorderRadius : 0,
											min: 0,
											max: 100,
											onChange: function onChange(value) {
												return setAttributes({ rightBorderRadius: value });
											}
										})
									)
								)
							)
						),
						!borderStyle && wp.element.createElement(
							PanelBody,
							{ title: __('Bottom Border'), initialOpen: false, className: "border-setting" },
							wp.element.createElement(
								PanelRow,
								null,
								wp.element.createElement(
									"div",
									{ className: "inspector-field inspector-border-style" },
									wp.element.createElement(
										"label",
										null,
										"Border Style"
									),
									wp.element.createElement(
										"div",
										{ className: "inspector-field-button-list inspector-field-button-list-fluid" },
										wp.element.createElement(
											"button",
											{ className: 'solid' === bottomBorderStyle ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
													return setAttributes({ bottomBorderStyle: 'solid' });
												} },
											wp.element.createElement("span", { className: "inspector-field-border-type inspector-field-border-type-solid" })
										),
										wp.element.createElement(
											"button",
											{ className: 'dotted' === bottomBorderStyle ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
													return setAttributes({ bottomBorderStyle: 'dotted' });
												} },
											wp.element.createElement("span", { className: "inspector-field-border-type inspector-field-border-type-dotted" })
										),
										wp.element.createElement(
											"button",
											{ className: 'dashed' === bottomBorderStyle ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
													return setAttributes({ bottomBorderStyle: 'dashed' });
												} },
											wp.element.createElement("span", { className: "inspector-field-border-type inspector-field-border-type-dashed" })
										),
										wp.element.createElement(
											"button",
											{ className: 'none' === bottomBorderStyle ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
													return setAttributes({ borderStyle: 'none' });
												} },
											wp.element.createElement(
												"span",
												{ className: "inspector-field-border-type inspector-field-border-type-none" },
												wp.element.createElement("i", { className: "fa fa-ban" })
											)
										)
									)
								)
							),
							bottomBorderStyle && wp.element.createElement(
								Fragment,
								null,
								wp.element.createElement(
									PanelRow,
									null,
									wp.element.createElement(
										"div",
										{ className: "inspector-field inspector-field-color " },
										wp.element.createElement(
											"label",
											{ className: "inspector-mb-0" },
											"Color"
										),
										wp.element.createElement(
											"div",
											{ className: "inspector-ml-auto" },
											wp.element.createElement(ColorPalette, {
												value: bottomBorderColor,
												onChange: function onChange(bottomBorderColor) {
													return setAttributes({ bottomBorderColor: bottomBorderColor });
												}
											})
										)
									)
								),
								wp.element.createElement(
									PanelRow,
									null,
									wp.element.createElement(
										"div",
										{ className: "inspector-field inspector-border-width" },
										wp.element.createElement(
											"label",
											null,
											"Border Width"
										),
										wp.element.createElement(RangeControl, {
											value: bottomBorderWidth ? bottomBorderWidth : 0,
											min: 0,
											max: 10,
											onChange: function onChange(value) {
												return setAttributes({ bottomBorderWidth: value });
											}
										})
									)
								),
								wp.element.createElement(
									PanelRow,
									null,
									wp.element.createElement(
										"div",
										{ className: "inspector-field inspector-border-width" },
										wp.element.createElement(
											"label",
											null,
											"Border Radius"
										),
										wp.element.createElement(RangeControl, {
											value: bottomBorderRadius ? bottomBorderRadius : 0,
											min: 0,
											max: 100,
											onChange: function onChange(value) {
												return setAttributes({ bottomBorderRadius: value });
											}
										})
									)
								)
							)
						),
						!borderStyle && wp.element.createElement(
							PanelBody,
							{ title: __('Left Border'), initialOpen: false, className: "border-setting" },
							wp.element.createElement(
								PanelRow,
								null,
								wp.element.createElement(
									"div",
									{ className: "inspector-field inspector-border-style" },
									wp.element.createElement(
										"label",
										null,
										"Border Style"
									),
									wp.element.createElement(
										"div",
										{ className: "inspector-field-button-list inspector-field-button-list-fluid" },
										wp.element.createElement(
											"button",
											{ className: 'solid' === leftBorderStyle ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
													return setAttributes({ leftBorderStyle: 'solid' });
												} },
											wp.element.createElement("span", { className: "inspector-field-border-type inspector-field-border-type-solid" })
										),
										wp.element.createElement(
											"button",
											{ className: 'dotted' === leftBorderStyle ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
													return setAttributes({ leftBorderStyle: 'dotted' });
												} },
											wp.element.createElement("span", { className: "inspector-field-border-type inspector-field-border-type-dotted" })
										),
										wp.element.createElement(
											"button",
											{ className: 'dashed' === leftBorderStyle ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
													return setAttributes({ leftBorderStyle: 'dashed' });
												} },
											wp.element.createElement("span", { className: "inspector-field-border-type inspector-field-border-type-dashed" })
										),
										wp.element.createElement(
											"button",
											{ className: 'none' === leftBorderStyle ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
													return setAttributes({ borderStyle: 'none' });
												} },
											wp.element.createElement(
												"span",
												{ className: "inspector-field-border-type inspector-field-border-type-none" },
												wp.element.createElement("i", { className: "fa fa-ban" })
											)
										)
									)
								)
							),
							leftBorderStyle && wp.element.createElement(
								Fragment,
								null,
								wp.element.createElement(
									PanelRow,
									null,
									wp.element.createElement(
										"div",
										{ className: "inspector-field inspector-field-color " },
										wp.element.createElement(
											"label",
											{ className: "inspector-mb-0" },
											"Color"
										),
										wp.element.createElement(
											"div",
											{ className: "inspector-ml-auto" },
											wp.element.createElement(ColorPalette, {
												value: leftBorderColor,
												onChange: function onChange(leftBorderColor) {
													return setAttributes({ leftBorderColor: leftBorderColor });
												}
											})
										)
									)
								),
								wp.element.createElement(
									PanelRow,
									null,
									wp.element.createElement(
										"div",
										{ className: "inspector-field inspector-border-width" },
										wp.element.createElement(
											"label",
											null,
											"Border Width"
										),
										wp.element.createElement(RangeControl, {
											value: leftBorderWidth ? leftBorderWidth : 0,
											min: 1,
											max: 10,
											onChange: function onChange(value) {
												return setAttributes({ leftBorderWidth: value });
											}
										})
									)
								),
								wp.element.createElement(
									PanelRow,
									null,
									wp.element.createElement(
										"div",
										{ className: "inspector-field inspector-border-width" },
										wp.element.createElement(
											"label",
											null,
											"Border Radius"
										),
										wp.element.createElement(RangeControl, {
											value: leftBorderRadius ? leftBorderRadius : 0,
											min: 0,
											max: 100,
											onChange: function onChange(value) {
												return setAttributes({ leftBorderRadius: value });
											}
										})
									)
								)
							)
						)
					),
					wp.element.createElement(
						PanelBody,
						{ title: __('Dimensions'), initialOpen: false },
						wp.element.createElement(
							PanelRow,
							null,
							wp.element.createElement(
								"div",
								{ className: "inspector-field alignment-settings" },
								wp.element.createElement(
									"div",
									{ className: "alignment-wrapper" },
									wp.element.createElement(TextControl, {
										label: "Width",
										type: "number",
										placeHolder: "Width (%)",
										value: width,
										min: "1",
										max: "100",
										step: "1",
										onChange: function onChange(value) {
											return setAttributes({ width: value });
										}
									})
								),
								wp.element.createElement(
									"div",
									{ className: "alignment-wrapper" },
									wp.element.createElement(TextControl, {
										label: "Height",
										type: "number",
										min: "1",
										placeHolder: "Height (px)",
										value: height,
										onChange: function onChange(value) {
											return setAttributes({ height: value });
										}
									})
								)
							)
						),
						wp.element.createElement(
							PanelRow,
							null,
							wp.element.createElement(
								"div",
								{ className: "inspector-field inspector-field-transform" },
								wp.element.createElement(
									"label",
									{ className: "mt10" },
									"Text Transform"
								),
								wp.element.createElement(
									"div",
									{ className: "inspector-field-button-list inspector-field-button-list-fluid inspector-ml-auto" },
									wp.element.createElement(
										"button",
										{ className: 'none' === blockAlign ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
												return setAttributes({ blockAlign: 'none' });
											} },
										wp.element.createElement("i", { className: "fa fa-ban" })
									),
									wp.element.createElement(
										"button",
										{ className: 'lowercase' === blockAlign ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
												return setAttributes({ blockAlign: 'lowercase' });
											} },
										wp.element.createElement(
											"span",
											null,
											"aa"
										)
									),
									wp.element.createElement(
										"button",
										{ className: 'capitalize' === blockAlign ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
												return setAttributes({ blockAlign: 'capitalize' });
											} },
										wp.element.createElement(
											"span",
											null,
											"Aa"
										)
									),
									wp.element.createElement(
										"button",
										{ className: 'uppercase' === blockAlign ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
												return setAttributes({ blockAlign: 'uppercase' });
											} },
										wp.element.createElement(
											"span",
											null,
											"AA"
										)
									)
								)
							)
						),
						wp.element.createElement(
							PanelRow,
							null,
							wp.element.createElement(
								"div",
								{ className: "inspector-field inspector-field-alignment" },
								wp.element.createElement(
									"label",
									{ className: "inspector-mb-0" },
									"Alignment"
								),
								wp.element.createElement(
									"div",
									{ className: "inspector-field-button-list inspector-field-button-list-fluid" },
									wp.element.createElement(
										"button",
										{ className: 'left' === textAlign ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
												return setAttributes({ textAlign: 'left' });
											} },
										wp.element.createElement("i", { className: "fa fa-align-left" })
									),
									wp.element.createElement(
										"button",
										{ className: 'center' === textAlign ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
												return setAttributes({ textAlign: 'center' });
											} },
										wp.element.createElement("i", { className: "fa fa-align-center" })
									),
									wp.element.createElement(
										"button",
										{ className: 'right' === textAlign ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
												return setAttributes({ textAlign: 'right' });
											} },
										wp.element.createElement("i", { className: "fa fa-align-right" })
									)
								)
							)
						)
					),
					wp.element.createElement(
						PanelBody,
						{ title: "Spacing", initialOpen: false },
						wp.element.createElement(
							PanelRow,
							null,
							wp.element.createElement(
								"div",
								{ className: "inspector-field inspector-field-padding" },
								wp.element.createElement(
									"label",
									{ className: "mt10" },
									"Padding"
								),
								wp.element.createElement(
									"div",
									{ className: "padding-setting" },
									wp.element.createElement(
										"div",
										{ className: "col-main-4" },
										wp.element.createElement(
											"div",
											{ className: "padd-top col-main-inner", "data-tooltip": "padding Top" },
											wp.element.createElement(TextControl, {
												type: "number",
												min: "1",
												value: paddingTop,
												onChange: function onChange(value) {
													return setAttributes({ paddingTop: value });
												}
											}),
											wp.element.createElement(
												"label",
												null,
												"Top"
											)
										),
										wp.element.createElement(
											"div",
											{ className: "padd-buttom col-main-inner", "data-tooltip": "padding Bottom" },
											wp.element.createElement(TextControl, {
												type: "number",
												min: "1",
												value: paddingBottom,
												onChange: function onChange(value) {
													return setAttributes({ paddingBottom: value });
												}
											}),
											wp.element.createElement(
												"label",
												null,
												"Bottom"
											)
										),
										wp.element.createElement(
											"div",
											{ className: "padd-left col-main-inner", "data-tooltip": "padding Left" },
											wp.element.createElement(TextControl, {
												type: "number",
												min: "1",
												value: paddingLeft,
												onChange: function onChange(value) {
													return setAttributes({ paddingLeft: value });
												}
											}),
											wp.element.createElement(
												"label",
												null,
												"Left"
											)
										),
										wp.element.createElement(
											"div",
											{ className: "padd-right col-main-inner", "data-tooltip": "padding Right" },
											wp.element.createElement(TextControl, {
												type: "number",
												min: "1",
												value: paddingRight,
												onChange: function onChange(value) {
													return setAttributes({ paddingRight: value });
												}
											}),
											wp.element.createElement(
												"label",
												null,
												"Right"
											)
										)
									)
								)
							)
						),
						wp.element.createElement(
							PanelRow,
							null,
							wp.element.createElement(
								"div",
								{ className: "inspector-field inspector-field-margin" },
								wp.element.createElement(
									"label",
									{ className: "mt10" },
									"Margin"
								),
								wp.element.createElement(
									"div",
									{ className: "margin-setting" },
									wp.element.createElement(
										"div",
										{ className: "col-main-4" },
										wp.element.createElement(
											"div",
											{ className: "padd-top col-main-inner", "data-tooltip": "margin Top" },
											wp.element.createElement(TextControl, {
												type: "number",
												min: "1",
												value: marginTop,
												onChange: function onChange(value) {
													return setAttributes({ marginTop: value });
												}
											}),
											wp.element.createElement(
												"label",
												null,
												"Top"
											)
										),
										wp.element.createElement(
											"div",
											{ className: "padd-buttom col-main-inner", "data-tooltip": "margin Bottom" },
											wp.element.createElement(TextControl, {
												type: "number",
												min: "1",
												value: marginBottom,
												onChange: function onChange(value) {
													return setAttributes({ marginBottom: value });
												}
											}),
											wp.element.createElement(
												"label",
												null,
												"Bottom"
											)
										),
										wp.element.createElement(
											"div",
											{ className: "padd-left col-main-inner", "data-tooltip": "margin Left" },
											wp.element.createElement(TextControl, {
												type: "number",
												min: "1",
												value: marginLeft,
												onChange: function onChange(value) {
													return setAttributes({ marginLeft: value });
												}
											}),
											wp.element.createElement(
												"label",
												null,
												"Left"
											)
										),
										wp.element.createElement(
											"div",
											{ className: "padd-right col-main-inner", "data-tooltip": "margin Right" },
											wp.element.createElement(TextControl, {
												type: "number",
												min: "1",
												value: marginRight,
												onChange: function onChange(value) {
													return setAttributes({ marginRight: value });
												}
											}),
											wp.element.createElement(
												"label",
												null,
												"Right"
											)
										)
									)
								)
							)
						)
					)
				)
			), wp.element.createElement(
				ElementTag,
				{ id: elementID, className: classes + " " + (ToggleInserter ? 'nab-inserter-on' : 'nab-inserter-off'), style: style },
				wp.element.createElement(InnerBlocks, null)
			)];
		},
		save: function save(props) {
			var attributes = props.attributes,
			    className = props.className;
			var backgroundImage = attributes.backgroundImage,
			    backgroundColor = attributes.backgroundColor,
			    backgroundSize = attributes.backgroundSize,
			    backgroundPosition = attributes.backgroundPosition,
			    backgroundAttachment = attributes.backgroundAttachment,
			    layout = attributes.layout,
			    borderStyle = attributes.borderStyle,
			    borderWidth = attributes.borderWidth,
			    borderColor = attributes.borderColor,
			    borderRadius = attributes.borderRadius,
			    blockAlign = attributes.blockAlign,
			    textAlign = attributes.textAlign,
			    width = attributes.width,
			    height = attributes.height,
			    opacity = attributes.opacity,
			    overlayColor = attributes.overlayColor,
			    paddingTop = attributes.paddingTop,
			    paddingRight = attributes.paddingRight,
			    paddingBottom = attributes.paddingBottom,
			    paddingLeft = attributes.paddingLeft,
			    marginTop = attributes.marginTop,
			    marginRight = attributes.marginRight,
			    marginBottom = attributes.marginBottom,
			    marginLeft = attributes.marginLeft,
			    gradientRange1 = attributes.gradientRange1,
			    gradientRange2 = attributes.gradientRange2,
			    gradientRange3 = attributes.gradientRange3,
			    color1 = attributes.color1,
			    color2 = attributes.color2,
			    color3 = attributes.color3,
			    gradientType = attributes.gradientType,
			    topBorderStyle = attributes.topBorderStyle,
			    topBorderWidth = attributes.topBorderWidth,
			    topBorderColor = attributes.topBorderColor,
			    topBorderRadius = attributes.topBorderRadius,
			    bottomBorderStyle = attributes.bottomBorderStyle,
			    bottomBorderWidth = attributes.bottomBorderWidth,
			    bottomBorderColor = attributes.bottomBorderColor,
			    bottomBorderRadius = attributes.bottomBorderRadius,
			    rightBorderStyle = attributes.rightBorderStyle,
			    rightBorderWidth = attributes.rightBorderWidth,
			    rightBorderColor = attributes.rightBorderColor,
			    rightBorderRadius = attributes.rightBorderRadius,
			    leftBorderStyle = attributes.leftBorderStyle,
			    leftBorderWidth = attributes.leftBorderWidth,
			    leftBorderColor = attributes.leftBorderColor,
			    leftBorderRadius = attributes.leftBorderRadius,
			    ElementTag = attributes.ElementTag,
			    elementID = attributes.elementID;

			var classes = __WEBPACK_IMPORTED_MODULE_0_classnames___default()(className, layout && "has-" + layout, blockAlign && "is-block-" + blockAlign, width && 'has-custom-width', {
				'has-background-size': backgroundSize,
				'has-background-attachment': backgroundAttachment,
				'has-background-opacity': 0 !== opacity

			}, opacityRatioToClass(opacity));
			var style = {};
			backgroundImage && (style.backgroundImage = "url(" + backgroundImage + ")");
			backgroundColor && (style.backgroundColor = backgroundColor);
			backgroundPosition && (style.backgroundPosition = backgroundPosition);
			textAlign && (style.textAlign = textAlign);
			width && (style.width = width + '%');
			height && (style.height = height + 'px');
			overlayColor && (style.backgroundColor = overlayColor);
			paddingTop && (style.paddingTop = paddingTop + 'px');
			paddingRight && (style.paddingRight = paddingRight + 'px');
			paddingBottom && (style.paddingBottom = paddingBottom + 'px');
			paddingLeft && (style.paddingLeft = paddingLeft + 'px');
			marginTop && (style.marginTop = marginTop + 'px');
			marginRight && (style.marginRight = marginRight + 'px');
			marginBottom && (style.marginBottom = marginBottom + 'px');
			marginLeft && (style.marginLeft = marginLeft + 'px');
			gradientType && ('#fff' !== color1 || '#fff' !== color2 || '#fff' !== color3) && (style.background = 'linear-gradient(' + gradientType + ', ' + color1 + ' ' + gradientRange1 + '%, ' + color2 + ' ' + gradientRange2 + '%, ' + color3 + ' ' + gradientRange3 + '%)');
			marginTop && (style.marginTop = marginTop + 'px');
			if (borderStyle) {
				style.borderStyle = borderStyle;
				if (borderWidth) {
					style.borderWidth = borderWidth + 'px';
				}
				if (borderColor) {
					style.borderColor = borderColor;
				}
				if (borderRadius) {
					style.borderRadius = borderRadius;
				}
			} else {
				if (topBorderStyle) {
					style.borderTopStyle = topBorderStyle;
					if (topBorderWidth) {
						style.borderTopWidth = topBorderWidth + 'px';
					}
					if (topBorderColor) {
						style.borderTopColor = topBorderColor;
					}
					if (topBorderRadius) {
						style.borderTopLeftRadius = topBorderRadius;
					}
				}
				if (bottomBorderStyle) {
					style.borderBottomStyle = bottomBorderStyle;
					if (bottomBorderWidth) {
						style.borderBottomWidth = bottomBorderWidth + 'px';
					}
					if (bottomBorderColor) {
						style.borderBottomColor = bottomBorderColor;
					}
					if (bottomBorderRadius) {
						style.borderBottomRightRadius = bottomBorderRadius;
					}
				}
				if (rightBorderStyle) {
					style.borderRightStyle = rightBorderStyle;
					if (rightBorderWidth) {
						style.borderRightWidth = rightBorderWidth + 'px';
					}
					if (rightBorderColor) {
						style.borderRightColor = rightBorderColor;
					}
					if (rightBorderRadius) {
						style.borderTopRightRadius = rightBorderRadius;
					}
				}
				if (leftBorderStyle) {
					style.borderLeftStyle = leftBorderStyle;
					if (leftBorderWidth) {
						style.borderLeftWidth = leftBorderWidth + 'px';
					}
					if (leftBorderColor) {
						style.borderLeftColor = leftBorderColor;
					}
					if (leftBorderRadius) {
						style.borderBottomLeftRadius = leftBorderRadius;
					}
				}
			}
			return wp.element.createElement(
				ElementTag,
				{ id: elementID, className: classes, style: style },
				wp.element.createElement(InnerBlocks.Content, null)
			);
		}
	});
})(window.wp.blocks, window.wp.i18n, window.wp.element, window.wp.editor, window.wp.components);
function opacityRatioToClass(ratio) {
	return 0 === ratio ? null : 'has-background-opacity-' + 10 * Math.round(ratio / 10);
}

/***/ }),
/* 48 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_lodash_pick__ = __webpack_require__(17);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_lodash_pick___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_lodash_pick__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__icons__ = __webpack_require__(3);
var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _toConsumableArray(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } else { return Array.from(arr); } }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }




(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    var __ = wpI18n.__;
    var Component = wpElement.Component,
        Fragment = wpElement.Fragment;
    var registerBlockType = wpBlocks.registerBlockType;
    var InspectorControls = wpEditor.InspectorControls,
        MediaUpload = wpEditor.MediaUpload;
    var PanelBody = wpComponents.PanelBody,
        RangeControl = wpComponents.RangeControl,
        ToggleControl = wpComponents.ToggleControl,
        SelectControl = wpComponents.SelectControl,
        TextControl = wpComponents.TextControl,
        TextareaControl = wpComponents.TextareaControl,
        IconButton = wpComponents.IconButton,
        Button = wpComponents.Button,
        Placeholder = wpComponents.Placeholder,
        Tooltip = wpComponents.Tooltip,
        PanelRow = wpComponents.PanelRow,
        ColorPalette = wpComponents.ColorPalette;


    var mediaSliderBlockIcon = wp.element.createElement(
        'svg',
        { xmlns: 'http://www.w3.org/2000/svg', width: '20', height: '20', viewBox: '2 2 22 22', className: 'dashicon' },
        wp.element.createElement('path', { fill: 'none', d: 'M0 0h24v24H0V0z' }),
        wp.element.createElement('path', { d: 'M20 4h-3.17L15 2H9L7.17 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zM9.88 4h4.24l1.83 2H20v12H4V6h4.05' }),
        wp.element.createElement('path', { d: 'M15 11H9V8.5L5.5 12 9 15.5V13h6v2.5l3.5-3.5L15 8.5z' })
    );

    var sliderBlockIcon = wp.element.createElement(
        'svg',
        { width: '150px', height: '150px', viewBox: '222.64 222.641 150 150', 'enable-background': 'new 222.64 222.641 150 150' },
        wp.element.createElement(
            'g',
            null,
            wp.element.createElement(
                'g',
                null,
                wp.element.createElement(
                    'g',
                    null,
                    wp.element.createElement('path', { fill: '#0F6CB6', d: 'M366.284,244.251H228.996c-1.405,0-2.542,1.137-2.542,2.542v17.797v50.848v33.051\r c0,1.405,1.137,2.542,2.542,2.542h137.288c1.405,0,2.543-1.137,2.543-2.542v-33.051v-50.848v-17.797\r C368.827,245.388,367.689,244.251,366.284,244.251z M231.538,267.132h22.882v45.763h-22.882V267.132z M363.743,312.896h-7.629\r v-45.763h7.629V312.896z M363.743,262.047h-10.171c-1.405,0-2.542,1.137-2.542,2.543v50.847c0,1.406,1.137,2.543,2.542,2.543\r h10.171v27.967H231.538v-0.001v-27.967h25.424c1.405,0,2.542-1.137,2.542-2.542v-50.848c0-1.405-1.137-2.543-2.542-2.543h-25.424\r v-12.711h132.205V262.047z' }),
                    wp.element.createElement('circle', { fill: '#0F6CB6', cx: '300.183', cy: '333.234', r: '5.085' }),
                    wp.element.createElement('path', { fill: '#0F6CB6', d: 'M269.674,317.98h71.187c1.405,0,2.543-1.138,2.543-2.543v-50.848c0-1.405-1.138-2.542-2.542-2.542\r h-71.188c-1.406,0-2.543,1.137-2.543,2.543v50.847C267.131,316.843,268.268,317.98,269.674,317.98z M272.216,267.132h66.102\r v45.763h-66.102V267.132z' }),
                    wp.element.createElement('rect', { x: '269.674', y: '330.691', fill: '#0F6CB6', width: '7.627', height: '5.085' }),
                    wp.element.createElement('rect', { x: '282.386', y: '330.691', fill: '#0F6CB6', width: '7.627', height: '5.085' }),
                    wp.element.createElement('rect', { x: '310.352', y: '330.691', fill: '#0F6CB6', width: '7.628', height: '5.085' }),
                    wp.element.createElement('rect', { x: '323.064', y: '330.691', fill: '#0F6CB6', width: '7.627', height: '5.085' })
                )
            )
        )
    );

    var nabInsertMedaitoSlide = function nabInsertMedaitoSlide(sourceURL, attributes) {
        var fullWidth = attributes.fullWidth,
            autoHeight = attributes.autoHeight,
            width = attributes.width,
            height = attributes.height;

        if (nabIsImage(sourceURL)) {
            return wp.element.createElement('img', { src: sourceURL,
                className: 'media-slider-img',
                alt: __('Slider image'),
                style: {
                    width: fullWidth ? '100%' : width,
                    height: autoHeight ? 'auto' : height
                }
            });
        } else {
            return wp.element.createElement('video', { src: sourceURL,
                className: 'media-slider-vid',
                controls: true,
                style: {
                    width: fullWidth ? '100%' : width,
                    height: autoHeight ? 'auto' : height
                }
            });
        }
    };

    var nabIsImage = function nabIsImage(sourceURL) {
        var imageExtension = ['jpg', 'jpeg', 'png', 'gif'];
        var fileExtension = sourceURL.split('.').pop();
        if (-1 < imageExtension.indexOf(fileExtension)) {
            return true;
        } else {
            return false;
        }
    };

    var NabMediaSlider = function (_Component) {
        _inherits(NabMediaSlider, _Component);

        function NabMediaSlider() {
            _classCallCheck(this, NabMediaSlider);

            var _this = _possibleConstructorReturn(this, (NabMediaSlider.__proto__ || Object.getPrototypeOf(NabMediaSlider)).apply(this, arguments));

            _this.state = {
                currentSelected: 0,
                inited: false,
                bxSliderObj: {}
            };

            _this.initSlider = _this.initSlider.bind(_this);
            _this.reloadSlider = _this.reloadSlider.bind(_this);
            return _this;
        }

        _createClass(NabMediaSlider, [{
            key: 'componentDidMount',
            value: function componentDidMount() {
                var attributes = this.props.attributes;

                if (attributes.media.length) {
                    this.initSlider();
                }
            }
        }, {
            key: 'componentDidUpdate',
            value: function componentDidUpdate(prevProps) {
                var _this2 = this;

                var attributes = this.props.attributes;
                var media = attributes.media,
                    adaptiveHeight = attributes.adaptiveHeight,
                    autoplay = attributes.autoplay,
                    speed = attributes.speed,
                    infiniteLoop = attributes.infiniteLoop,
                    pager = attributes.pager,
                    controls = attributes.controls,
                    mode = attributes.mode;
                var prevMedia = prevProps.attributes.media;

                if (media.length !== prevMedia.length) {
                    if (0 === prevMedia.length) {
                        setTimeout(function () {
                            return _this2.initSlider();
                        }, 10);
                    } else {
                        this.state.bxSliderObj.reloadSlider();
                    }
                }
                if (adaptiveHeight !== prevProps.attributes.adaptiveHeight) {
                    this.reloadSlider();
                }
                if (autoplay !== prevProps.attributes.autoplay) {
                    this.reloadSlider();
                }
                if (speed !== prevProps.attributes.speed) {
                    this.reloadSlider();
                }
                if (infiniteLoop !== prevProps.attributes.infiniteLoop) {
                    this.reloadSlider();
                }
                if (pager !== prevProps.attributes.pager) {
                    this.reloadSlider();
                }
                if (controls !== prevProps.attributes.controls) {
                    this.reloadSlider();
                }
                if (mode !== prevProps.attributes.mode) {
                    this.reloadSlider();
                }
            }
        }, {
            key: 'initSlider',
            value: function initSlider() {
                var clientId = this.props.clientId;
                var _props$attributes = this.props.attributes,
                    adaptiveHeight = _props$attributes.adaptiveHeight,
                    autoplay = _props$attributes.autoplay,
                    speed = _props$attributes.speed,
                    infiniteLoop = _props$attributes.infiniteLoop,
                    pager = _props$attributes.pager,
                    controls = _props$attributes.controls,
                    mode = _props$attributes.mode;

                var sliderObj = jQuery('#block-' + clientId + ' .nab-media-slider').bxSlider({
                    mode: mode, auto: autoplay, speed: speed, controls: controls, infiniteLoop: infiniteLoop, pager: pager, adaptiveHeight: adaptiveHeight, stopAutoOnClick: true, autoHover: true,
                    onSlideAfter: function ($slideElement, oldIndex, newIndex) {
                        this.setState({ currentSelected: newIndex });
                    }.bind(this)
                });
                this.setState({ bxSliderObj: sliderObj });
            }
        }, {
            key: 'reloadSlider',
            value: function reloadSlider(e) {
                var _props$attributes2 = this.props.attributes,
                    adaptiveHeight = _props$attributes2.adaptiveHeight,
                    autoplay = _props$attributes2.autoplay,
                    speed = _props$attributes2.speed,
                    infiniteLoop = _props$attributes2.infiniteLoop,
                    pager = _props$attributes2.pager,
                    controls = _props$attributes2.controls,
                    mode = _props$attributes2.mode;

                this.state.bxSliderObj.reloadSlider({ mode: mode, adaptiveHeight: adaptiveHeight, auto: autoplay, speed: speed, infiniteLoop: infiniteLoop, pager: pager, controls: controls, stopAutoOnClick: true, autoHover: true });
            }
        }, {
            key: 'moveMedia',
            value: function moveMedia(currentIndex, newIndex) {
                var _props = this.props,
                    setAttributes = _props.setAttributes,
                    attributes = _props.attributes;
                var media = attributes.media;


                var currentMedia = media[currentIndex];
                setAttributes({
                    media: [].concat(_toConsumableArray(media.filter(function (img, idx) {
                        return idx !== currentIndex;
                    }).slice(0, newIndex)), [currentMedia], _toConsumableArray(media.filter(function (img, idx) {
                        return idx !== currentIndex;
                    }).slice(newIndex)))
                });
            }
        }, {
            key: 'updateMediaData',
            value: function updateMediaData(data) {
                var currentSelected = this.state.currentSelected;

                if ('number' !== typeof currentSelected) {
                    return null;
                }

                var _props2 = this.props,
                    attributes = _props2.attributes,
                    setAttributes = _props2.setAttributes;
                var media = attributes.media;


                var newMedia = media.map(function (media, index) {
                    if (index === currentSelected) {
                        media = Object.assign({}, media, data);
                    }

                    return media;
                });

                setAttributes({ media: newMedia });
            }
        }, {
            key: 'render',
            value: function render() {
                var _this3 = this;

                var _props3 = this.props,
                    attributes = _props3.attributes,
                    setAttributes = _props3.setAttributes,
                    isSelected = _props3.isSelected;
                var currentSelected = this.state.currentSelected;
                var media = attributes.media,
                    autoplay = attributes.autoplay,
                    fullWidth = attributes.fullWidth,
                    autoHeight = attributes.autoHeight,
                    width = attributes.width,
                    height = attributes.height,
                    alwaysShowOverlay = attributes.alwaysShowOverlay,
                    hoverColor = attributes.hoverColor,
                    titleColor = attributes.titleColor,
                    textColor = attributes.textColor,
                    hAlign = attributes.hAlign,
                    vAlign = attributes.vAlign,
                    mediaDetails = attributes.mediaDetails,
                    speed = attributes.speed,
                    infiniteLoop = attributes.infiniteLoop,
                    pager = attributes.pager,
                    controls = attributes.controls,
                    titleFont = attributes.titleFont,
                    textFont = attributes.textFont,
                    overlayOpacity = attributes.overlayOpacity,
                    adaptiveHeight = attributes.adaptiveHeight,
                    mode = attributes.mode,
                    detailAnimation = attributes.detailAnimation,
                    detailWidth = attributes.detailWidth,
                    arrowIcons = attributes.arrowIcons;


                var arrowNames = [{ name: __WEBPACK_IMPORTED_MODULE_1__icons__["l" /* sliderArrow1 */], classnames: 'slider-arrow-1' }, { name: __WEBPACK_IMPORTED_MODULE_1__icons__["m" /* sliderArrow2 */], classnames: 'slider-arrow-2' }, { name: __WEBPACK_IMPORTED_MODULE_1__icons__["n" /* sliderArrow3 */], classnames: 'slider-arrow-3' }, { name: __WEBPACK_IMPORTED_MODULE_1__icons__["o" /* sliderArrow4 */], classnames: 'slider-arrow-4' }, { name: __WEBPACK_IMPORTED_MODULE_1__icons__["p" /* sliderArrow5 */], classnames: 'slider-arrow-5' }, { name: __WEBPACK_IMPORTED_MODULE_1__icons__["q" /* sliderArrow6 */], classnames: 'slider-arrow-6' }, { name: __WEBPACK_IMPORTED_MODULE_1__icons__["r" /* sliderArrow7 */], classnames: 'slider-arrow-7' }, { name: __WEBPACK_IMPORTED_MODULE_1__icons__["s" /* sliderArrow8 */], classnames: 'slider-arrow-8' }];

                if (0 === media.length) {
                    return wp.element.createElement(
                        Placeholder,
                        {
                            icon: mediaSliderBlockIcon,
                            label: __('Media Slider Block'),
                            instructions: __('No media selected. Adding media to start using this block.')
                        },
                        wp.element.createElement(MediaUpload, {
                            value: null,
                            multiple: true,
                            onSelect: function onSelect(item) {
                                var mediaInsert = item.map(function (source) {
                                    return {
                                        url: source.url,
                                        id: source.id
                                    };
                                });

                                setAttributes({
                                    media: [].concat(_toConsumableArray(media), _toConsumableArray(mediaInsert))
                                });
                            },
                            render: function render(_ref) {
                                var open = _ref.open;
                                return wp.element.createElement(
                                    Button,
                                    { className: 'button button-large button-primary', onClick: open },
                                    __('Add media')
                                );
                            }
                        })
                    );
                }
                return wp.element.createElement(
                    Fragment,
                    null,
                    wp.element.createElement(
                        InspectorControls,
                        null,
                        wp.element.createElement(
                            PanelBody,
                            { title: __('Slider Settings'), initialOpen: false },
                            wp.element.createElement(ToggleControl, {
                                label: __('Pager'),
                                checked: pager,
                                onChange: function onChange() {
                                    setAttributes({ pager: !pager });
                                }
                            }),
                            wp.element.createElement(ToggleControl, {
                                label: __('Controls'),
                                checked: controls,
                                onChange: function onChange() {
                                    return setAttributes({ controls: !controls });
                                }
                            }),
                            wp.element.createElement(ToggleControl, {
                                label: __('Autoplay'),
                                checked: autoplay,
                                onChange: function onChange() {
                                    return setAttributes({ autoplay: !autoplay });
                                }
                            }),
                            wp.element.createElement(ToggleControl, {
                                label: __('Infinite Loop'),
                                checked: infiniteLoop,
                                onChange: function onChange() {
                                    return setAttributes({ infiniteLoop: !infiniteLoop });
                                }
                            }),
                            wp.element.createElement(ToggleControl, {
                                label: __('Adaptive Height'),
                                checked: adaptiveHeight,
                                onChange: function onChange() {
                                    return setAttributes({ adaptiveHeight: !adaptiveHeight });
                                }
                            }),
                            wp.element.createElement(
                                'div',
                                { className: 'inspector-field inspector-slider-speed' },
                                wp.element.createElement(
                                    'label',
                                    null,
                                    'Speed'
                                ),
                                wp.element.createElement(RangeControl, {
                                    value: speed,
                                    min: 100,
                                    max: 2000,
                                    onChange: function onChange(speed) {
                                        return setAttributes({ speed: speed });
                                    }
                                })
                            ),
                            wp.element.createElement(SelectControl, {
                                label: __('Slider Mode'),
                                value: mode,
                                options: [{ label: __('Horizontal'), value: 'horizontal' }, { label: __('Fade'), value: 'fade' }],
                                onChange: function onChange(value) {
                                    return setAttributes({ mode: value });
                                }
                            })
                        ),
                        controls ? wp.element.createElement(
                            PanelBody,
                            { title: __('Slider Arrow'), initialOpen: false },
                            wp.element.createElement(
                                'ul',
                                { className: 'slider-arrow-main' },
                                arrowNames.map(function (item, index) {
                                    return wp.element.createElement(
                                        Fragment,
                                        { key: index },
                                        wp.element.createElement(
                                            'li',
                                            {
                                                className: item.classnames + ' ' + (arrowIcons === item.classnames ? 'active' : ''),
                                                key: index,
                                                onClick: function onClick(e) {
                                                    setAttributes({ arrowIcons: item.classnames });
                                                }
                                            },
                                            item.name
                                        )
                                    );
                                })
                            )
                        ) : '',
                        wp.element.createElement(
                            PanelBody,
                            { title: __('Image Settings'), initialOpen: false },
                            wp.element.createElement(ToggleControl, {
                                label: __('Full width'),
                                checked: fullWidth,
                                onChange: function onChange() {
                                    return setAttributes({ fullWidth: !fullWidth });
                                }
                            }),
                            !fullWidth && wp.element.createElement(
                                'div',
                                { className: 'inspector-field inspector-slider-speed' },
                                wp.element.createElement(
                                    'label',
                                    null,
                                    'Width'
                                ),
                                wp.element.createElement(RangeControl, {
                                    value: width,
                                    min: 200,
                                    max: 1300,
                                    onChange: function onChange(width) {
                                        return setAttributes({ width: width });
                                    }
                                })
                            ),
                            wp.element.createElement(ToggleControl, {
                                label: __('Auto height'),
                                checked: autoHeight,
                                onChange: function onChange() {
                                    return setAttributes({ autoHeight: !autoHeight });
                                }
                            }),
                            !autoHeight && wp.element.createElement(
                                'div',
                                { className: 'inspector-field inspector-slider-speed' },
                                wp.element.createElement(
                                    'label',
                                    null,
                                    'Height'
                                ),
                                wp.element.createElement(RangeControl, {
                                    value: height,
                                    min: 100,
                                    max: 1000,
                                    onChange: function onChange(height) {
                                        return setAttributes({ height: height });
                                    }
                                })
                            ),
                            wp.element.createElement(ToggleControl, {
                                label: __('Always show overlay'),
                                checked: alwaysShowOverlay,
                                onChange: function onChange() {
                                    return setAttributes({ alwaysShowOverlay: !alwaysShowOverlay });
                                }
                            }),
                            alwaysShowOverlay ? wp.element.createElement(
                                Fragment,
                                null,
                                wp.element.createElement(
                                    'div',
                                    { className: 'inspector-field inspector-field-color ' },
                                    wp.element.createElement(
                                        'label',
                                        { className: 'inspector-mb-0' },
                                        'Color'
                                    ),
                                    wp.element.createElement(
                                        'div',
                                        { className: 'inspector-ml-auto' },
                                        wp.element.createElement(ColorPalette, {
                                            value: hoverColor,
                                            onChange: function onChange(hoverColor) {
                                                return setAttributes({ hoverColor: hoverColor });
                                            }
                                        })
                                    )
                                ),
                                wp.element.createElement(
                                    PanelRow,
                                    null,
                                    wp.element.createElement(
                                        'div',
                                        { className: 'inspector-field inspector-slider-speed' },
                                        wp.element.createElement(
                                            'label',
                                            null,
                                            'Overlay Opacity'
                                        ),
                                        wp.element.createElement(RangeControl, {
                                            value: overlayOpacity,
                                            min: 0,
                                            max: 100,
                                            onChange: function onChange(overlayOpacity) {
                                                return setAttributes({ overlayOpacity: overlayOpacity });
                                            }
                                        })
                                    )
                                )
                            ) : ''
                        ),
                        wp.element.createElement(
                            PanelBody,
                            { title: __('Media Settings'), initialOpen: false },
                            wp.element.createElement(ToggleControl, {
                                label: __('Media Details'),
                                checked: mediaDetails,
                                onChange: function onChange() {
                                    return setAttributes({ mediaDetails: !mediaDetails });
                                }
                            }),
                            mediaDetails ? wp.element.createElement(
                                Fragment,
                                null,
                                wp.element.createElement(
                                    PanelRow,
                                    null,
                                    wp.element.createElement(
                                        'div',
                                        { className: 'inspector-field' },
                                        wp.element.createElement(RangeControl, {
                                            label: __('Box Width'),
                                            min: 30,
                                            max: 100,
                                            value: detailWidth,
                                            onChange: function onChange(value) {
                                                return setAttributes({ detailWidth: value });
                                            }
                                        })
                                    )
                                ),
                                wp.element.createElement(
                                    PanelRow,
                                    null,
                                    wp.element.createElement(
                                        'div',
                                        { className: 'inspector-field' },
                                        wp.element.createElement(RangeControl, {
                                            label: __('Title Font Size'),
                                            min: 10,
                                            max: 200,
                                            value: titleFont,
                                            onChange: function onChange(value) {
                                                return setAttributes({ titleFont: value });
                                            }
                                        })
                                    )
                                ),
                                wp.element.createElement(
                                    PanelRow,
                                    null,
                                    wp.element.createElement(
                                        'div',
                                        { className: 'inspector-field' },
                                        wp.element.createElement(RangeControl, {
                                            label: __('Caption Font Size'),
                                            min: 10,
                                            max: 200,
                                            value: textFont,
                                            onChange: function onChange(value) {
                                                return setAttributes({ textFont: value });
                                            }
                                        })
                                    )
                                ),
                                wp.element.createElement(
                                    PanelRow,
                                    null,
                                    wp.element.createElement(
                                        'div',
                                        { className: 'inspector-field inspector-field-color ' },
                                        wp.element.createElement(
                                            'label',
                                            { className: 'inspector-mb-0' },
                                            'Title Text Color'
                                        ),
                                        wp.element.createElement(
                                            'div',
                                            { className: 'inspector-ml-auto' },
                                            wp.element.createElement(ColorPalette, {
                                                value: titleColor,
                                                onChange: function onChange(titleColor) {
                                                    return setAttributes({ titleColor: titleColor });
                                                }
                                            })
                                        )
                                    )
                                ),
                                wp.element.createElement(
                                    PanelRow,
                                    null,
                                    wp.element.createElement(
                                        'div',
                                        { className: 'inspector-field inspector-field-color ' },
                                        wp.element.createElement(
                                            'label',
                                            { className: 'inspector-mb-0' },
                                            'Caption Text Color'
                                        ),
                                        wp.element.createElement(
                                            'div',
                                            { className: 'inspector-ml-auto' },
                                            wp.element.createElement(ColorPalette, {
                                                value: textColor,
                                                onChange: function onChange(textColor) {
                                                    return setAttributes({ textColor: textColor });
                                                }
                                            })
                                        )
                                    )
                                ),
                                wp.element.createElement(
                                    PanelRow,
                                    null,
                                    wp.element.createElement(
                                        'div',
                                        { className: 'inspector-field' },
                                        wp.element.createElement(SelectControl, {
                                            label: __('Detail Animation'),
                                            value: detailAnimation,
                                            options: [{ label: __('None'), value: 'none' }, { label: __('Fade In'), value: 'fadeIn' }, { label: __('Fade Out'), value: 'fadeOut' }, { label: __('zoom In'), value: 'zoomIn' }],
                                            onChange: function onChange(value) {
                                                return setAttributes({ detailAnimation: value });
                                            }
                                        })
                                    )
                                ),
                                wp.element.createElement(
                                    PanelRow,
                                    null,
                                    wp.element.createElement(
                                        'div',
                                        { className: 'inspector-field-alignment inspector-field inspector-responsive inspector-bottom-20' },
                                        wp.element.createElement(
                                            'label',
                                            null,
                                            'Vertical  Alignment'
                                        ),
                                        wp.element.createElement(
                                            'div',
                                            { className: 'inspector-field-button-list inspector-field-button-list-fluid' },
                                            wp.element.createElement(
                                                'button',
                                                { className: 'flex-start' === vAlign ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
                                                        return setAttributes({ vAlign: 'flex-start' });
                                                    } },
                                                wp.element.createElement(
                                                    'svg',
                                                    { width: '16', height: '16', viewBox: '0 0 16 16', xmlns: 'http://www.w3.org/2000/svg' },
                                                    wp.element.createElement(
                                                        'g',
                                                        { transform: 'translate(1)', fill: 'none' },
                                                        wp.element.createElement('rect', { className: 'inspector-svg-fill', x: '4', y: '4', width: '6', height: '12', rx: '1' }),
                                                        wp.element.createElement('path', { className: 'inspector-svg-stroke', d: 'M0 1h14', 'stroke-width': '2', 'stroke-linecap': 'square' })
                                                    )
                                                )
                                            ),
                                            wp.element.createElement(
                                                'button',
                                                { className: 'center' === vAlign ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
                                                        return setAttributes({ vAlign: 'center' });
                                                    } },
                                                wp.element.createElement(
                                                    'svg',
                                                    { width: '16', height: '18', viewBox: '0 0 16 18', xmlns: 'http://www.w3.org/2000/svg' },
                                                    wp.element.createElement(
                                                        'g',
                                                        { transform: 'translate(-115 -4) translate(115 4)', fill: 'none' },
                                                        wp.element.createElement('path', { d: 'M8 .708v15.851', className: 'inspector-svg-stroke', 'stroke-linecap': 'square' }),
                                                        wp.element.createElement('rect', { className: 'inspector-svg-fill', y: '5', width: '16', height: '7', rx: '1' })
                                                    )
                                                )
                                            ),
                                            wp.element.createElement(
                                                'button',
                                                { className: 'flex-end' === vAlign ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
                                                        return setAttributes({ vAlign: 'flex-end' });
                                                    } },
                                                wp.element.createElement(
                                                    'svg',
                                                    { width: '16', height: '16', viewBox: '0 0 16 16', xmlns: 'http://www.w3.org/2000/svg' },
                                                    wp.element.createElement(
                                                        'g',
                                                        { transform: 'translate(1)', fill: 'none' },
                                                        wp.element.createElement('rect', { className: 'inspector-svg-fill', x: '4', width: '6', height: '12', rx: '1' }),
                                                        wp.element.createElement('path', { d: 'M0 15h14', className: 'inspector-svg-stroke', 'stroke-width': '2', 'stroke-linecap': 'square' })
                                                    )
                                                )
                                            )
                                        )
                                    )
                                ),
                                wp.element.createElement(
                                    PanelRow,
                                    null,
                                    wp.element.createElement(
                                        'div',
                                        { className: 'inspector-field-alignment inspector-field inspector-responsive' },
                                        wp.element.createElement(
                                            'label',
                                            null,
                                            'Horizontal Alignment'
                                        ),
                                        wp.element.createElement(
                                            'div',
                                            { className: 'inspector-field-button-list inspector-field-button-list-fluid' },
                                            wp.element.createElement(
                                                'button',
                                                { className: 'flex-start' === hAlign ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
                                                        return setAttributes({ hAlign: 'flex-start' });
                                                    } },
                                                wp.element.createElement(
                                                    'svg',
                                                    { width: '21', height: '18', viewBox: '0 0 21 18', xmlns: 'http://www.w3.org/2000/svg' },
                                                    wp.element.createElement(
                                                        'g',
                                                        { transform: 'translate(-29 -4) translate(29 4)', fill: 'none' },
                                                        wp.element.createElement('path', { d: 'M1 .708v15.851', className: 'inspector-svg-stroke', 'stroke-linecap': 'square' }),
                                                        wp.element.createElement('rect', { className: 'inspector-svg-fill', x: '5', y: '5', width: '16', height: '7', rx: '1' })
                                                    )
                                                )
                                            ),
                                            wp.element.createElement(
                                                'button',
                                                { className: 'center' === hAlign ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
                                                        return setAttributes({ hAlign: 'center' });
                                                    } },
                                                wp.element.createElement(
                                                    'svg',
                                                    { width: '16', height: '18', viewBox: '0 0 16 18', xmlns: 'http://www.w3.org/2000/svg' },
                                                    wp.element.createElement(
                                                        'g',
                                                        { transform: 'translate(-115 -4) translate(115 4)', fill: 'none' },
                                                        wp.element.createElement('path', { d: 'M8 .708v15.851', className: 'inspector-svg-stroke', 'stroke-linecap': 'square' }),
                                                        wp.element.createElement('rect', { className: 'inspector-svg-fill', y: '5', width: '16', height: '7', rx: '1' })
                                                    )
                                                )
                                            ),
                                            wp.element.createElement(
                                                'button',
                                                { className: 'flex-end' === hAlign ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
                                                        return setAttributes({ hAlign: 'flex-end' });
                                                    } },
                                                wp.element.createElement(
                                                    'svg',
                                                    { width: '21', height: '18', viewBox: '0 0 21 18', xmlns: 'http://www.w3.org/2000/svg' },
                                                    wp.element.createElement(
                                                        'g',
                                                        { transform: 'translate(0 1) rotate(-180 10.5 8.5)', fill: 'none' },
                                                        wp.element.createElement('path', { d: 'M1 .708v15.851', className: 'inspector-svg-stroke', 'stroke-linecap': 'square' }),
                                                        wp.element.createElement('rect', { className: 'inspector-svg-fill', 'fill-rule': 'nonzero', x: '5', y: '5', width: '16', height: '7', rx: '1' })
                                                    )
                                                )
                                            )
                                        )
                                    )
                                )
                            ) : ''
                        )
                    ),
                    wp.element.createElement(
                        'div',
                        { className: 'nab-media-slider-block slider-arrow-main ' + arrowIcons },
                        wp.element.createElement(
                            'div',
                            { className: 'nab-media-slider', 'data-animation': detailAnimation, 'data-autoplay': '' + autoplay, 'data-speed': '' + speed, 'data-infiniteloop': '' + infiniteLoop, 'data-pager': '' + pager, 'data-controls': '' + controls, 'data-adaptiveheight': '' + adaptiveHeight },
                            media.map(function (source, index) {
                                return wp.element.createElement(
                                    'div',
                                    { className: 'nab-media-slider-item', key: index

                                    },
                                    nabInsertMedaitoSlide(source.url, attributes),
                                    wp.element.createElement('span', { className: 'nab-media-slider-overlay',
                                        style: {
                                            backgroundColor: hoverColor,
                                            opacity: alwaysShowOverlay ? '0.' + overlayOpacity : 0
                                        }
                                    }),
                                    source.link && wp.element.createElement('a', { className: 'nab-media-slider-link',
                                        target: '_blank',
                                        rel: 'noopener noreferrer',
                                        href: source.link
                                    }),
                                    wp.element.createElement(
                                        'div',
                                        { className: 'nab-media-slider-item-info',
                                            style: {
                                                justifyContent: vAlign,
                                                alignItems: hAlign,
                                                width: detailWidth + '%'
                                            }
                                        },
                                        wp.element.createElement(
                                            'h4',
                                            { className: 'nab-media-slider-title',
                                                style: {
                                                    color: titleColor,
                                                    fontSize: titleFont + 'px'
                                                }
                                            },
                                            source.title
                                        ),
                                        wp.element.createElement(
                                            'p',
                                            { className: 'nab-media-slider-text',
                                                style: {
                                                    color: textColor,
                                                    fontSize: textFont + 'px'
                                                }
                                            },
                                            source.text
                                        )
                                    )
                                );
                            })
                        ),
                        isSelected && wp.element.createElement(
                            'div',
                            { className: 'nab-media-slider-controls' },
                            mediaDetails && wp.element.createElement(
                                Fragment,
                                null,
                                nabIsImage(media[currentSelected].url) && wp.element.createElement(
                                    'div',
                                    { className: 'nab-controls-wrapper' },
                                    wp.element.createElement(
                                        'div',
                                        { className: 'nab-media-slider-control' },
                                        wp.element.createElement(TextControl, {
                                            label: __('Title'),
                                            value: media[currentSelected] ? media[currentSelected].title || '' : '',
                                            onChange: function onChange(value) {
                                                return _this3.updateMediaData({ title: value || '' });
                                            }
                                        })
                                    ),
                                    wp.element.createElement(
                                        'div',
                                        { className: 'nab-media-slider-control' },
                                        wp.element.createElement(TextareaControl, {
                                            label: __('Text'),
                                            value: media[currentSelected] ? media[currentSelected].text || '' : '',
                                            onChange: function onChange(value) {
                                                return _this3.updateMediaData({ text: value || '' });
                                            }
                                        })
                                    ),
                                    wp.element.createElement(
                                        'div',
                                        { className: 'nab-media-slider-control' },
                                        wp.element.createElement(TextControl, {
                                            label: __('Link'),
                                            value: media[currentSelected] ? media[currentSelected].link || '' : '',
                                            onChange: function onChange(value) {
                                                return _this3.updateMediaData({ link: value || '' });
                                            }
                                        })
                                    )
                                )
                            ),
                            wp.element.createElement(
                                'div',
                                { className: 'nab-media-slider-slide-list' },
                                media.map(function (source, index) {
                                    return wp.element.createElement(
                                        'div',
                                        { className: 'nab-media-slider-slide-list-item', key: index },
                                        0 < index && wp.element.createElement(
                                            Tooltip,
                                            { text: __('Move Left') },
                                            wp.element.createElement(
                                                'span',
                                                { className: 'nab-move-arrow nab-move-left',
                                                    onClick: function onClick() {
                                                        return _this3.moveMedia(index, index - 1);
                                                    }
                                                },
                                                wp.element.createElement(
                                                    'svg',
                                                    { xmlns: 'http://www.w3.org/2000/svg', width: '24', height: '24', viewBox: '0 0 24 24' },
                                                    wp.element.createElement('path', { fill: 'none', d: 'M0 0h24v24H0V0z' }),
                                                    wp.element.createElement('path', { d: 'M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6 1.41-1.41z' })
                                                )
                                            )
                                        ),
                                        nabIsImage(source.url) && wp.element.createElement('img', { src: source.url,
                                            className: 'nab-media-slider-img',
                                            alt: __('Remove'),
                                            height: '100px',
                                            width: '100px',
                                            onClick: function onClick() {
                                                _this3.state.bxSliderObj.goToSlide(index);
                                                _this3.setState({ currentSelected: index });
                                            }
                                        }),
                                        !nabIsImage(source.url) && wp.element.createElement('video', { src: source.url,
                                            className: 'nab-media-slider-vid',
                                            height: '100px',
                                            width: '100px',
                                            onClick: function onClick() {
                                                _this3.state.bxSliderObj.goToSlide(index);
                                                _this3.setState({ currentSelected: index });
                                            }
                                        }),
                                        index + 1 < media.length && wp.element.createElement(
                                            Tooltip,
                                            { text: __('Move Right') },
                                            wp.element.createElement(
                                                'span',
                                                { className: 'nab-move-arrow nab-move-right',
                                                    onClick: function onClick() {
                                                        return _this3.moveMedia(index, index + 1);
                                                    }
                                                },
                                                wp.element.createElement(
                                                    'svg',
                                                    { xmlns: 'http://www.w3.org/2000/svg', width: '24', height: '24', viewBox: '0 0 24 24' },
                                                    wp.element.createElement('path', { fill: 'none', d: 'M0 0h24v24H0V0z' }),
                                                    wp.element.createElement('path', { d: 'M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z' })
                                                )
                                            )
                                        ),
                                        wp.element.createElement(
                                            Tooltip,
                                            { text: __('Remove media') },
                                            wp.element.createElement(IconButton, {
                                                className: 'nab-media-slider-item-remove',
                                                icon: 'no',
                                                onClick: function onClick() {
                                                    if (index === currentSelected) {
                                                        _this3.setState({ currentSelected: null });
                                                    }
                                                    setAttributes({ media: media.filter(function (img, idx) {
                                                            return idx !== index;
                                                        }) });
                                                }
                                            })
                                        )
                                    );
                                }),
                                wp.element.createElement(
                                    'div',
                                    { className: 'nab-media-slider-add-item' },
                                    wp.element.createElement(MediaUpload, {
                                        value: currentSelected,
                                        multiple: true,
                                        onSelect: function onSelect(items) {
                                            return setAttributes({
                                                media: [].concat(_toConsumableArray(media), _toConsumableArray(items.map(function (item) {
                                                    return __WEBPACK_IMPORTED_MODULE_0_lodash_pick___default()(item, 'id', 'url', 'alt');
                                                })))
                                            });
                                        },
                                        render: function render(_ref2) {
                                            var open = _ref2.open;
                                            return wp.element.createElement(IconButton, {
                                                label: __('Add media'),
                                                icon: 'plus',
                                                onClick: open
                                            });
                                        }
                                    })
                                )
                            )
                        )
                    )
                );
            }
        }]);

        return NabMediaSlider;
    }(Component);

    var blockAttrs = {
        media: {
            type: 'array',
            default: []
        },
        autoplay: {
            type: 'boolean',
            default: false
        },
        mediaDetails: {
            type: 'boolean',
            default: false
        },

        infiniteLoop: {
            type: 'boolean',
            default: true
        },
        pager: {
            type: 'boolean',
            default: true
        },
        controls: {
            type: 'boolean',
            default: true
        },
        adaptiveHeight: {
            type: 'boolean',
            default: true
        },
        fullWidth: {
            type: 'boolean',
            default: true
        },
        autoHeight: {
            type: 'boolean',
            default: true
        },
        width: {
            type: 'number',
            default: 700
        },
        height: {
            type: 'number',
            default: 500
        },
        alwaysShowOverlay: {
            type: 'boolean',
            default: true
        },
        hoverColor: {
            type: 'string'
        },
        titleColor: {
            type: 'string'
        },
        textColor: {
            type: 'string'
        },
        vAlign: {
            type: 'string',
            default: 'center'
        },
        hAlign: {
            type: 'string',
            default: 'center'
        },
        changed: {
            type: 'boolean',
            default: false
        },
        speed: {
            type: 'number',
            default: 500
        },
        titleFont: {
            type: 'number',
            default: 25
        },
        textFont: {
            type: 'number',
            default: 18
        },
        overlayOpacity: {
            type: 'number',
            default: 20
        },
        detailWidth: {
            type: 'number',
            default: 50
        },
        mode: {
            type: 'string',
            default: 'horizontal'
        },
        controlIcon: {
            type: 'string',
            default: 'control-7'
        },
        detailAnimation: {
            type: 'string',
            default: 'none'
        },
        arrowIcons: {
            type: 'string',
            default: 'slider-arrow-1'
        }
    };

    registerBlockType('md/media-slider', {
        title: __('Media Slider'),
        description: __('Display your media in a slider.'),
        icon: { src: sliderBlockIcon },
        category: 'nabshow',
        keywords: [__('slide'), __('gallery'), __('photos')],
        attributes: blockAttrs,
        edit: NabMediaSlider,
        save: function save(_ref3) {
            var attributes = _ref3.attributes;
            var media = attributes.media,
                autoplay = attributes.autoplay,
                alwaysShowOverlay = attributes.alwaysShowOverlay,
                hoverColor = attributes.hoverColor,
                titleColor = attributes.titleColor,
                textColor = attributes.textColor,
                hAlign = attributes.hAlign,
                vAlign = attributes.vAlign,
                speed = attributes.speed,
                infiniteLoop = attributes.infiniteLoop,
                pager = attributes.pager,
                controls = attributes.controls,
                titleFont = attributes.titleFont,
                textFont = attributes.textFont,
                overlayOpacity = attributes.overlayOpacity,
                adaptiveHeight = attributes.adaptiveHeight,
                mode = attributes.mode,
                controlIcon = attributes.controlIcon,
                detailAnimation = attributes.detailAnimation,
                detailWidth = attributes.detailWidth,
                arrowIcons = attributes.arrowIcons;

            return wp.element.createElement(
                'div',
                { className: 'nab-media-slider-block slider-arrow-main ' + arrowIcons },
                wp.element.createElement(
                    'div',
                    { className: 'nab-media-slider', 'data-animation': detailAnimation, nabmode: mode, 'data-autoplay': '' + autoplay, 'data-speed': '' + speed, 'data-infiniteloop': '' + infiniteLoop, 'data-pager': '' + pager, 'data-controls': '' + controls, 'data-adaptiveheight': '' + adaptiveHeight },
                    media.map(function (source, index) {
                        return wp.element.createElement(
                            'div',
                            { className: 'nab-media-slider-item', key: index },
                            nabInsertMedaitoSlide(source.url, attributes),
                            wp.element.createElement('span', { className: 'nab-media-slider-overlay',
                                style: {
                                    backgroundColor: hoverColor,
                                    opacity: alwaysShowOverlay ? '0.' + overlayOpacity : 0
                                }
                            }),
                            source.link && wp.element.createElement('a', { className: 'nab-media-slider-link',
                                target: '_blank',
                                rel: 'noopener noreferrer',
                                href: source.link
                            }),
                            nabIsImage(source.url) && wp.element.createElement(
                                'div',
                                { className: 'nab-media-slider-item-info',
                                    style: {
                                        justifyContent: vAlign,
                                        alignItems: hAlign,
                                        width: detailWidth + '%'
                                    }
                                },
                                source.title && wp.element.createElement(
                                    'h4',
                                    { className: 'nab-media-slider-title',
                                        style: {
                                            color: titleColor,
                                            fontSize: titleFont + 'px'
                                        }
                                    },
                                    source.title
                                ),
                                source.text && wp.element.createElement(
                                    'p',
                                    { className: 'nab-media-slider-text',
                                        style: {
                                            color: textColor,
                                            fontSize: textFont + 'px'
                                        }
                                    },
                                    source.text
                                )
                            )
                        );
                    })
                )
            );
        }
    });
})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);

/***/ }),
/* 49 */
/***/ (function(module, exports, __webpack_require__) {

var basePickBy = __webpack_require__(50),
    hasIn = __webpack_require__(35);

/**
 * The base implementation of `_.pick` without support for individual
 * property identifiers.
 *
 * @private
 * @param {Object} object The source object.
 * @param {string[]} paths The property paths to pick.
 * @returns {Object} Returns the new object.
 */
function basePick(object, paths) {
  return basePickBy(object, paths, function(value, path) {
    return hasIn(object, path);
  });
}

module.exports = basePick;


/***/ }),
/* 50 */
/***/ (function(module, exports, __webpack_require__) {

var baseGet = __webpack_require__(18),
    baseSet = __webpack_require__(80),
    castPath = __webpack_require__(9);

/**
 * The base implementation of  `_.pickBy` without support for iteratee shorthands.
 *
 * @private
 * @param {Object} object The source object.
 * @param {string[]} paths The property paths to pick.
 * @param {Function} predicate The function invoked per property.
 * @returns {Object} Returns the new object.
 */
function basePickBy(object, paths, predicate) {
  var index = -1,
      length = paths.length,
      result = {};

  while (++index < length) {
    var path = paths[index],
        value = baseGet(object, path);

    if (predicate(value, path)) {
      baseSet(result, castPath(path, object), value);
    }
  }
  return result;
}

module.exports = basePickBy;


/***/ }),
/* 51 */
/***/ (function(module, exports) {

var g;

// This works in non-strict mode
g = (function() {
	return this;
})();

try {
	// This works if eval is allowed (see CSP)
	g = g || Function("return this")() || (1,eval)("this");
} catch(e) {
	// This works if the window reference is available
	if(typeof window === "object")
		g = window;
}

// g can still be undefined, but nothing to do about it...
// We return undefined, instead of nothing here, so it's
// easier to handle this case. if(!global) { ...}

module.exports = g;


/***/ }),
/* 52 */
/***/ (function(module, exports, __webpack_require__) {

var Symbol = __webpack_require__(5);

/** Used for built-in method references. */
var objectProto = Object.prototype;

/** Used to check objects for own properties. */
var hasOwnProperty = objectProto.hasOwnProperty;

/**
 * Used to resolve the
 * [`toStringTag`](http://ecma-international.org/ecma-262/7.0/#sec-object.prototype.tostring)
 * of values.
 */
var nativeObjectToString = objectProto.toString;

/** Built-in value references. */
var symToStringTag = Symbol ? Symbol.toStringTag : undefined;

/**
 * A specialized version of `baseGetTag` which ignores `Symbol.toStringTag` values.
 *
 * @private
 * @param {*} value The value to query.
 * @returns {string} Returns the raw `toStringTag`.
 */
function getRawTag(value) {
  var isOwn = hasOwnProperty.call(value, symToStringTag),
      tag = value[symToStringTag];

  try {
    value[symToStringTag] = undefined;
    var unmasked = true;
  } catch (e) {}

  var result = nativeObjectToString.call(value);
  if (unmasked) {
    if (isOwn) {
      value[symToStringTag] = tag;
    } else {
      delete value[symToStringTag];
    }
  }
  return result;
}

module.exports = getRawTag;


/***/ }),
/* 53 */
/***/ (function(module, exports) {

/** Used for built-in method references. */
var objectProto = Object.prototype;

/**
 * Used to resolve the
 * [`toStringTag`](http://ecma-international.org/ecma-262/7.0/#sec-object.prototype.tostring)
 * of values.
 */
var nativeObjectToString = objectProto.toString;

/**
 * Converts `value` to a string using `Object.prototype.toString`.
 *
 * @private
 * @param {*} value The value to convert.
 * @returns {string} Returns the converted string.
 */
function objectToString(value) {
  return nativeObjectToString.call(value);
}

module.exports = objectToString;


/***/ }),
/* 54 */
/***/ (function(module, exports, __webpack_require__) {

var memoizeCapped = __webpack_require__(55);

/** Used to match property names within property paths. */
var rePropName = /[^.[\]]+|\[(?:(-?\d+(?:\.\d+)?)|(["'])((?:(?!\2)[^\\]|\\.)*?)\2)\]|(?=(?:\.|\[\])(?:\.|\[\]|$))/g;

/** Used to match backslashes in property paths. */
var reEscapeChar = /\\(\\)?/g;

/**
 * Converts `string` to a property path array.
 *
 * @private
 * @param {string} string The string to convert.
 * @returns {Array} Returns the property path array.
 */
var stringToPath = memoizeCapped(function(string) {
  var result = [];
  if (string.charCodeAt(0) === 46 /* . */) {
    result.push('');
  }
  string.replace(rePropName, function(match, number, quote, subString) {
    result.push(quote ? subString.replace(reEscapeChar, '$1') : (number || match));
  });
  return result;
});

module.exports = stringToPath;


/***/ }),
/* 55 */
/***/ (function(module, exports, __webpack_require__) {

var memoize = __webpack_require__(56);

/** Used as the maximum memoize cache size. */
var MAX_MEMOIZE_SIZE = 500;

/**
 * A specialized version of `_.memoize` which clears the memoized function's
 * cache when it exceeds `MAX_MEMOIZE_SIZE`.
 *
 * @private
 * @param {Function} func The function to have its output memoized.
 * @returns {Function} Returns the new memoized function.
 */
function memoizeCapped(func) {
  var result = memoize(func, function(key) {
    if (cache.size === MAX_MEMOIZE_SIZE) {
      cache.clear();
    }
    return key;
  });

  var cache = result.cache;
  return result;
}

module.exports = memoizeCapped;


/***/ }),
/* 56 */
/***/ (function(module, exports, __webpack_require__) {

var MapCache = __webpack_require__(20);

/** Error message constants. */
var FUNC_ERROR_TEXT = 'Expected a function';

/**
 * Creates a function that memoizes the result of `func`. If `resolver` is
 * provided, it determines the cache key for storing the result based on the
 * arguments provided to the memoized function. By default, the first argument
 * provided to the memoized function is used as the map cache key. The `func`
 * is invoked with the `this` binding of the memoized function.
 *
 * **Note:** The cache is exposed as the `cache` property on the memoized
 * function. Its creation may be customized by replacing the `_.memoize.Cache`
 * constructor with one whose instances implement the
 * [`Map`](http://ecma-international.org/ecma-262/7.0/#sec-properties-of-the-map-prototype-object)
 * method interface of `clear`, `delete`, `get`, `has`, and `set`.
 *
 * @static
 * @memberOf _
 * @since 0.1.0
 * @category Function
 * @param {Function} func The function to have its output memoized.
 * @param {Function} [resolver] The function to resolve the cache key.
 * @returns {Function} Returns the new memoized function.
 * @example
 *
 * var object = { 'a': 1, 'b': 2 };
 * var other = { 'c': 3, 'd': 4 };
 *
 * var values = _.memoize(_.values);
 * values(object);
 * // => [1, 2]
 *
 * values(other);
 * // => [3, 4]
 *
 * object.a = 2;
 * values(object);
 * // => [1, 2]
 *
 * // Modify the result cache.
 * values.cache.set(object, ['a', 'b']);
 * values(object);
 * // => ['a', 'b']
 *
 * // Replace `_.memoize.Cache`.
 * _.memoize.Cache = WeakMap;
 */
function memoize(func, resolver) {
  if (typeof func != 'function' || (resolver != null && typeof resolver != 'function')) {
    throw new TypeError(FUNC_ERROR_TEXT);
  }
  var memoized = function() {
    var args = arguments,
        key = resolver ? resolver.apply(this, args) : args[0],
        cache = memoized.cache;

    if (cache.has(key)) {
      return cache.get(key);
    }
    var result = func.apply(this, args);
    memoized.cache = cache.set(key, result) || cache;
    return result;
  };
  memoized.cache = new (memoize.Cache || MapCache);
  return memoized;
}

// Expose `MapCache`.
memoize.Cache = MapCache;

module.exports = memoize;


/***/ }),
/* 57 */
/***/ (function(module, exports, __webpack_require__) {

var Hash = __webpack_require__(58),
    ListCache = __webpack_require__(12),
    Map = __webpack_require__(22);

/**
 * Removes all key-value entries from the map.
 *
 * @private
 * @name clear
 * @memberOf MapCache
 */
function mapCacheClear() {
  this.size = 0;
  this.__data__ = {
    'hash': new Hash,
    'map': new (Map || ListCache),
    'string': new Hash
  };
}

module.exports = mapCacheClear;


/***/ }),
/* 58 */
/***/ (function(module, exports, __webpack_require__) {

var hashClear = __webpack_require__(59),
    hashDelete = __webpack_require__(64),
    hashGet = __webpack_require__(65),
    hashHas = __webpack_require__(66),
    hashSet = __webpack_require__(67);

/**
 * Creates a hash object.
 *
 * @private
 * @constructor
 * @param {Array} [entries] The key-value pairs to cache.
 */
function Hash(entries) {
  var index = -1,
      length = entries == null ? 0 : entries.length;

  this.clear();
  while (++index < length) {
    var entry = entries[index];
    this.set(entry[0], entry[1]);
  }
}

// Add methods to `Hash`.
Hash.prototype.clear = hashClear;
Hash.prototype['delete'] = hashDelete;
Hash.prototype.get = hashGet;
Hash.prototype.has = hashHas;
Hash.prototype.set = hashSet;

module.exports = Hash;


/***/ }),
/* 59 */
/***/ (function(module, exports, __webpack_require__) {

var nativeCreate = __webpack_require__(11);

/**
 * Removes all key-value entries from the hash.
 *
 * @private
 * @name clear
 * @memberOf Hash
 */
function hashClear() {
  this.__data__ = nativeCreate ? nativeCreate(null) : {};
  this.size = 0;
}

module.exports = hashClear;


/***/ }),
/* 60 */
/***/ (function(module, exports, __webpack_require__) {

var isFunction = __webpack_require__(31),
    isMasked = __webpack_require__(61),
    isObject = __webpack_require__(7),
    toSource = __webpack_require__(32);

/**
 * Used to match `RegExp`
 * [syntax characters](http://ecma-international.org/ecma-262/7.0/#sec-patterns).
 */
var reRegExpChar = /[\\^$.*+?()[\]{}|]/g;

/** Used to detect host constructors (Safari). */
var reIsHostCtor = /^\[object .+?Constructor\]$/;

/** Used for built-in method references. */
var funcProto = Function.prototype,
    objectProto = Object.prototype;

/** Used to resolve the decompiled source of functions. */
var funcToString = funcProto.toString;

/** Used to check objects for own properties. */
var hasOwnProperty = objectProto.hasOwnProperty;

/** Used to detect if a method is native. */
var reIsNative = RegExp('^' +
  funcToString.call(hasOwnProperty).replace(reRegExpChar, '\\$&')
  .replace(/hasOwnProperty|(function).*?(?=\\\()| for .+?(?=\\\])/g, '$1.*?') + '$'
);

/**
 * The base implementation of `_.isNative` without bad shim checks.
 *
 * @private
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is a native function,
 *  else `false`.
 */
function baseIsNative(value) {
  if (!isObject(value) || isMasked(value)) {
    return false;
  }
  var pattern = isFunction(value) ? reIsNative : reIsHostCtor;
  return pattern.test(toSource(value));
}

module.exports = baseIsNative;


/***/ }),
/* 61 */
/***/ (function(module, exports, __webpack_require__) {

var coreJsData = __webpack_require__(62);

/** Used to detect methods masquerading as native. */
var maskSrcKey = (function() {
  var uid = /[^.]+$/.exec(coreJsData && coreJsData.keys && coreJsData.keys.IE_PROTO || '');
  return uid ? ('Symbol(src)_1.' + uid) : '';
}());

/**
 * Checks if `func` has its source masked.
 *
 * @private
 * @param {Function} func The function to check.
 * @returns {boolean} Returns `true` if `func` is masked, else `false`.
 */
function isMasked(func) {
  return !!maskSrcKey && (maskSrcKey in func);
}

module.exports = isMasked;


/***/ }),
/* 62 */
/***/ (function(module, exports, __webpack_require__) {

var root = __webpack_require__(1);

/** Used to detect overreaching core-js shims. */
var coreJsData = root['__core-js_shared__'];

module.exports = coreJsData;


/***/ }),
/* 63 */
/***/ (function(module, exports) {

/**
 * Gets the value at `key` of `object`.
 *
 * @private
 * @param {Object} [object] The object to query.
 * @param {string} key The key of the property to get.
 * @returns {*} Returns the property value.
 */
function getValue(object, key) {
  return object == null ? undefined : object[key];
}

module.exports = getValue;


/***/ }),
/* 64 */
/***/ (function(module, exports) {

/**
 * Removes `key` and its value from the hash.
 *
 * @private
 * @name delete
 * @memberOf Hash
 * @param {Object} hash The hash to modify.
 * @param {string} key The key of the value to remove.
 * @returns {boolean} Returns `true` if the entry was removed, else `false`.
 */
function hashDelete(key) {
  var result = this.has(key) && delete this.__data__[key];
  this.size -= result ? 1 : 0;
  return result;
}

module.exports = hashDelete;


/***/ }),
/* 65 */
/***/ (function(module, exports, __webpack_require__) {

var nativeCreate = __webpack_require__(11);

/** Used to stand-in for `undefined` hash values. */
var HASH_UNDEFINED = '__lodash_hash_undefined__';

/** Used for built-in method references. */
var objectProto = Object.prototype;

/** Used to check objects for own properties. */
var hasOwnProperty = objectProto.hasOwnProperty;

/**
 * Gets the hash value for `key`.
 *
 * @private
 * @name get
 * @memberOf Hash
 * @param {string} key The key of the value to get.
 * @returns {*} Returns the entry value.
 */
function hashGet(key) {
  var data = this.__data__;
  if (nativeCreate) {
    var result = data[key];
    return result === HASH_UNDEFINED ? undefined : result;
  }
  return hasOwnProperty.call(data, key) ? data[key] : undefined;
}

module.exports = hashGet;


/***/ }),
/* 66 */
/***/ (function(module, exports, __webpack_require__) {

var nativeCreate = __webpack_require__(11);

/** Used for built-in method references. */
var objectProto = Object.prototype;

/** Used to check objects for own properties. */
var hasOwnProperty = objectProto.hasOwnProperty;

/**
 * Checks if a hash value for `key` exists.
 *
 * @private
 * @name has
 * @memberOf Hash
 * @param {string} key The key of the entry to check.
 * @returns {boolean} Returns `true` if an entry for `key` exists, else `false`.
 */
function hashHas(key) {
  var data = this.__data__;
  return nativeCreate ? (data[key] !== undefined) : hasOwnProperty.call(data, key);
}

module.exports = hashHas;


/***/ }),
/* 67 */
/***/ (function(module, exports, __webpack_require__) {

var nativeCreate = __webpack_require__(11);

/** Used to stand-in for `undefined` hash values. */
var HASH_UNDEFINED = '__lodash_hash_undefined__';

/**
 * Sets the hash `key` to `value`.
 *
 * @private
 * @name set
 * @memberOf Hash
 * @param {string} key The key of the value to set.
 * @param {*} value The value to set.
 * @returns {Object} Returns the hash instance.
 */
function hashSet(key, value) {
  var data = this.__data__;
  this.size += this.has(key) ? 0 : 1;
  data[key] = (nativeCreate && value === undefined) ? HASH_UNDEFINED : value;
  return this;
}

module.exports = hashSet;


/***/ }),
/* 68 */
/***/ (function(module, exports) {

/**
 * Removes all key-value entries from the list cache.
 *
 * @private
 * @name clear
 * @memberOf ListCache
 */
function listCacheClear() {
  this.__data__ = [];
  this.size = 0;
}

module.exports = listCacheClear;


/***/ }),
/* 69 */
/***/ (function(module, exports, __webpack_require__) {

var assocIndexOf = __webpack_require__(13);

/** Used for built-in method references. */
var arrayProto = Array.prototype;

/** Built-in value references. */
var splice = arrayProto.splice;

/**
 * Removes `key` and its value from the list cache.
 *
 * @private
 * @name delete
 * @memberOf ListCache
 * @param {string} key The key of the value to remove.
 * @returns {boolean} Returns `true` if the entry was removed, else `false`.
 */
function listCacheDelete(key) {
  var data = this.__data__,
      index = assocIndexOf(data, key);

  if (index < 0) {
    return false;
  }
  var lastIndex = data.length - 1;
  if (index == lastIndex) {
    data.pop();
  } else {
    splice.call(data, index, 1);
  }
  --this.size;
  return true;
}

module.exports = listCacheDelete;


/***/ }),
/* 70 */
/***/ (function(module, exports, __webpack_require__) {

var assocIndexOf = __webpack_require__(13);

/**
 * Gets the list cache value for `key`.
 *
 * @private
 * @name get
 * @memberOf ListCache
 * @param {string} key The key of the value to get.
 * @returns {*} Returns the entry value.
 */
function listCacheGet(key) {
  var data = this.__data__,
      index = assocIndexOf(data, key);

  return index < 0 ? undefined : data[index][1];
}

module.exports = listCacheGet;


/***/ }),
/* 71 */
/***/ (function(module, exports, __webpack_require__) {

var assocIndexOf = __webpack_require__(13);

/**
 * Checks if a list cache value for `key` exists.
 *
 * @private
 * @name has
 * @memberOf ListCache
 * @param {string} key The key of the entry to check.
 * @returns {boolean} Returns `true` if an entry for `key` exists, else `false`.
 */
function listCacheHas(key) {
  return assocIndexOf(this.__data__, key) > -1;
}

module.exports = listCacheHas;


/***/ }),
/* 72 */
/***/ (function(module, exports, __webpack_require__) {

var assocIndexOf = __webpack_require__(13);

/**
 * Sets the list cache `key` to `value`.
 *
 * @private
 * @name set
 * @memberOf ListCache
 * @param {string} key The key of the value to set.
 * @param {*} value The value to set.
 * @returns {Object} Returns the list cache instance.
 */
function listCacheSet(key, value) {
  var data = this.__data__,
      index = assocIndexOf(data, key);

  if (index < 0) {
    ++this.size;
    data.push([key, value]);
  } else {
    data[index][1] = value;
  }
  return this;
}

module.exports = listCacheSet;


/***/ }),
/* 73 */
/***/ (function(module, exports, __webpack_require__) {

var getMapData = __webpack_require__(14);

/**
 * Removes `key` and its value from the map.
 *
 * @private
 * @name delete
 * @memberOf MapCache
 * @param {string} key The key of the value to remove.
 * @returns {boolean} Returns `true` if the entry was removed, else `false`.
 */
function mapCacheDelete(key) {
  var result = getMapData(this, key)['delete'](key);
  this.size -= result ? 1 : 0;
  return result;
}

module.exports = mapCacheDelete;


/***/ }),
/* 74 */
/***/ (function(module, exports) {

/**
 * Checks if `value` is suitable for use as unique object key.
 *
 * @private
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is suitable, else `false`.
 */
function isKeyable(value) {
  var type = typeof value;
  return (type == 'string' || type == 'number' || type == 'symbol' || type == 'boolean')
    ? (value !== '__proto__')
    : (value === null);
}

module.exports = isKeyable;


/***/ }),
/* 75 */
/***/ (function(module, exports, __webpack_require__) {

var getMapData = __webpack_require__(14);

/**
 * Gets the map value for `key`.
 *
 * @private
 * @name get
 * @memberOf MapCache
 * @param {string} key The key of the value to get.
 * @returns {*} Returns the entry value.
 */
function mapCacheGet(key) {
  return getMapData(this, key).get(key);
}

module.exports = mapCacheGet;


/***/ }),
/* 76 */
/***/ (function(module, exports, __webpack_require__) {

var getMapData = __webpack_require__(14);

/**
 * Checks if a map value for `key` exists.
 *
 * @private
 * @name has
 * @memberOf MapCache
 * @param {string} key The key of the entry to check.
 * @returns {boolean} Returns `true` if an entry for `key` exists, else `false`.
 */
function mapCacheHas(key) {
  return getMapData(this, key).has(key);
}

module.exports = mapCacheHas;


/***/ }),
/* 77 */
/***/ (function(module, exports, __webpack_require__) {

var getMapData = __webpack_require__(14);

/**
 * Sets the map `key` to `value`.
 *
 * @private
 * @name set
 * @memberOf MapCache
 * @param {string} key The key of the value to set.
 * @param {*} value The value to set.
 * @returns {Object} Returns the map cache instance.
 */
function mapCacheSet(key, value) {
  var data = getMapData(this, key),
      size = data.size;

  data.set(key, value);
  this.size += data.size == size ? 0 : 1;
  return this;
}

module.exports = mapCacheSet;


/***/ }),
/* 78 */
/***/ (function(module, exports, __webpack_require__) {

var baseToString = __webpack_require__(79);

/**
 * Converts `value` to a string. An empty string is returned for `null`
 * and `undefined` values. The sign of `-0` is preserved.
 *
 * @static
 * @memberOf _
 * @since 4.0.0
 * @category Lang
 * @param {*} value The value to convert.
 * @returns {string} Returns the converted string.
 * @example
 *
 * _.toString(null);
 * // => ''
 *
 * _.toString(-0);
 * // => '-0'
 *
 * _.toString([1, 2, 3]);
 * // => '1,2,3'
 */
function toString(value) {
  return value == null ? '' : baseToString(value);
}

module.exports = toString;


/***/ }),
/* 79 */
/***/ (function(module, exports, __webpack_require__) {

var Symbol = __webpack_require__(5),
    arrayMap = __webpack_require__(33),
    isArray = __webpack_require__(0),
    isSymbol = __webpack_require__(10);

/** Used as references for various `Number` constants. */
var INFINITY = 1 / 0;

/** Used to convert symbols to primitives and strings. */
var symbolProto = Symbol ? Symbol.prototype : undefined,
    symbolToString = symbolProto ? symbolProto.toString : undefined;

/**
 * The base implementation of `_.toString` which doesn't convert nullish
 * values to empty strings.
 *
 * @private
 * @param {*} value The value to process.
 * @returns {string} Returns the string.
 */
function baseToString(value) {
  // Exit early for strings to avoid a performance hit in some environments.
  if (typeof value == 'string') {
    return value;
  }
  if (isArray(value)) {
    // Recursively convert values (susceptible to call stack limits).
    return arrayMap(value, baseToString) + '';
  }
  if (isSymbol(value)) {
    return symbolToString ? symbolToString.call(value) : '';
  }
  var result = (value + '');
  return (result == '0' && (1 / value) == -INFINITY) ? '-0' : result;
}

module.exports = baseToString;


/***/ }),
/* 80 */
/***/ (function(module, exports, __webpack_require__) {

var assignValue = __webpack_require__(81),
    castPath = __webpack_require__(9),
    isIndex = __webpack_require__(23),
    isObject = __webpack_require__(7),
    toKey = __webpack_require__(8);

/**
 * The base implementation of `_.set`.
 *
 * @private
 * @param {Object} object The object to modify.
 * @param {Array|string} path The path of the property to set.
 * @param {*} value The value to set.
 * @param {Function} [customizer] The function to customize path creation.
 * @returns {Object} Returns `object`.
 */
function baseSet(object, path, value, customizer) {
  if (!isObject(object)) {
    return object;
  }
  path = castPath(path, object);

  var index = -1,
      length = path.length,
      lastIndex = length - 1,
      nested = object;

  while (nested != null && ++index < length) {
    var key = toKey(path[index]),
        newValue = value;

    if (index != lastIndex) {
      var objValue = nested[key];
      newValue = customizer ? customizer(objValue, key, nested) : undefined;
      if (newValue === undefined) {
        newValue = isObject(objValue)
          ? objValue
          : (isIndex(path[index + 1]) ? [] : {});
      }
    }
    assignValue(nested, key, newValue);
    nested = nested[key];
  }
  return object;
}

module.exports = baseSet;


/***/ }),
/* 81 */
/***/ (function(module, exports, __webpack_require__) {

var baseAssignValue = __webpack_require__(82),
    eq = __webpack_require__(21);

/** Used for built-in method references. */
var objectProto = Object.prototype;

/** Used to check objects for own properties. */
var hasOwnProperty = objectProto.hasOwnProperty;

/**
 * Assigns `value` to `key` of `object` if the existing value is not equivalent
 * using [`SameValueZero`](http://ecma-international.org/ecma-262/7.0/#sec-samevaluezero)
 * for equality comparisons.
 *
 * @private
 * @param {Object} object The object to modify.
 * @param {string} key The key of the property to assign.
 * @param {*} value The value to assign.
 */
function assignValue(object, key, value) {
  var objValue = object[key];
  if (!(hasOwnProperty.call(object, key) && eq(objValue, value)) ||
      (value === undefined && !(key in object))) {
    baseAssignValue(object, key, value);
  }
}

module.exports = assignValue;


/***/ }),
/* 82 */
/***/ (function(module, exports, __webpack_require__) {

var defineProperty = __webpack_require__(34);

/**
 * The base implementation of `assignValue` and `assignMergeValue` without
 * value checks.
 *
 * @private
 * @param {Object} object The object to modify.
 * @param {string} key The key of the property to assign.
 * @param {*} value The value to assign.
 */
function baseAssignValue(object, key, value) {
  if (key == '__proto__' && defineProperty) {
    defineProperty(object, key, {
      'configurable': true,
      'enumerable': true,
      'value': value,
      'writable': true
    });
  } else {
    object[key] = value;
  }
}

module.exports = baseAssignValue;


/***/ }),
/* 83 */
/***/ (function(module, exports) {

/**
 * The base implementation of `_.hasIn` without support for deep paths.
 *
 * @private
 * @param {Object} [object] The object to query.
 * @param {Array|string} key The key to check.
 * @returns {boolean} Returns `true` if `key` exists, else `false`.
 */
function baseHasIn(object, key) {
  return object != null && key in Object(object);
}

module.exports = baseHasIn;


/***/ }),
/* 84 */
/***/ (function(module, exports, __webpack_require__) {

var castPath = __webpack_require__(9),
    isArguments = __webpack_require__(24),
    isArray = __webpack_require__(0),
    isIndex = __webpack_require__(23),
    isLength = __webpack_require__(25),
    toKey = __webpack_require__(8);

/**
 * Checks if `path` exists on `object`.
 *
 * @private
 * @param {Object} object The object to query.
 * @param {Array|string} path The path to check.
 * @param {Function} hasFunc The function to check properties.
 * @returns {boolean} Returns `true` if `path` exists, else `false`.
 */
function hasPath(object, path, hasFunc) {
  path = castPath(path, object);

  var index = -1,
      length = path.length,
      result = false;

  while (++index < length) {
    var key = toKey(path[index]);
    if (!(result = object != null && hasFunc(object, key))) {
      break;
    }
    object = object[key];
  }
  if (result || ++index != length) {
    return result;
  }
  length = object == null ? 0 : object.length;
  return !!length && isLength(length) && isIndex(key, length) &&
    (isArray(object) || isArguments(object));
}

module.exports = hasPath;


/***/ }),
/* 85 */
/***/ (function(module, exports, __webpack_require__) {

var baseGetTag = __webpack_require__(4),
    isObjectLike = __webpack_require__(6);

/** `Object#toString` result references. */
var argsTag = '[object Arguments]';

/**
 * The base implementation of `_.isArguments`.
 *
 * @private
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is an `arguments` object,
 */
function baseIsArguments(value) {
  return isObjectLike(value) && baseGetTag(value) == argsTag;
}

module.exports = baseIsArguments;


/***/ }),
/* 86 */
/***/ (function(module, exports, __webpack_require__) {

var flatten = __webpack_require__(87),
    overRest = __webpack_require__(90),
    setToString = __webpack_require__(92);

/**
 * A specialized version of `baseRest` which flattens the rest array.
 *
 * @private
 * @param {Function} func The function to apply a rest parameter to.
 * @returns {Function} Returns the new function.
 */
function flatRest(func) {
  return setToString(overRest(func, undefined, flatten), func + '');
}

module.exports = flatRest;


/***/ }),
/* 87 */
/***/ (function(module, exports, __webpack_require__) {

var baseFlatten = __webpack_require__(88);

/**
 * Flattens `array` a single level deep.
 *
 * @static
 * @memberOf _
 * @since 0.1.0
 * @category Array
 * @param {Array} array The array to flatten.
 * @returns {Array} Returns the new flattened array.
 * @example
 *
 * _.flatten([1, [2, [3, [4]], 5]]);
 * // => [1, 2, [3, [4]], 5]
 */
function flatten(array) {
  var length = array == null ? 0 : array.length;
  return length ? baseFlatten(array, 1) : [];
}

module.exports = flatten;


/***/ }),
/* 88 */
/***/ (function(module, exports, __webpack_require__) {

var arrayPush = __webpack_require__(36),
    isFlattenable = __webpack_require__(89);

/**
 * The base implementation of `_.flatten` with support for restricting flattening.
 *
 * @private
 * @param {Array} array The array to flatten.
 * @param {number} depth The maximum recursion depth.
 * @param {boolean} [predicate=isFlattenable] The function invoked per iteration.
 * @param {boolean} [isStrict] Restrict to values that pass `predicate` checks.
 * @param {Array} [result=[]] The initial result value.
 * @returns {Array} Returns the new flattened array.
 */
function baseFlatten(array, depth, predicate, isStrict, result) {
  var index = -1,
      length = array.length;

  predicate || (predicate = isFlattenable);
  result || (result = []);

  while (++index < length) {
    var value = array[index];
    if (depth > 0 && predicate(value)) {
      if (depth > 1) {
        // Recursively flatten arrays (susceptible to call stack limits).
        baseFlatten(value, depth - 1, predicate, isStrict, result);
      } else {
        arrayPush(result, value);
      }
    } else if (!isStrict) {
      result[result.length] = value;
    }
  }
  return result;
}

module.exports = baseFlatten;


/***/ }),
/* 89 */
/***/ (function(module, exports, __webpack_require__) {

var Symbol = __webpack_require__(5),
    isArguments = __webpack_require__(24),
    isArray = __webpack_require__(0);

/** Built-in value references. */
var spreadableSymbol = Symbol ? Symbol.isConcatSpreadable : undefined;

/**
 * Checks if `value` is a flattenable `arguments` object or array.
 *
 * @private
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is flattenable, else `false`.
 */
function isFlattenable(value) {
  return isArray(value) || isArguments(value) ||
    !!(spreadableSymbol && value && value[spreadableSymbol]);
}

module.exports = isFlattenable;


/***/ }),
/* 90 */
/***/ (function(module, exports, __webpack_require__) {

var apply = __webpack_require__(91);

/* Built-in method references for those with the same name as other `lodash` methods. */
var nativeMax = Math.max;

/**
 * A specialized version of `baseRest` which transforms the rest array.
 *
 * @private
 * @param {Function} func The function to apply a rest parameter to.
 * @param {number} [start=func.length-1] The start position of the rest parameter.
 * @param {Function} transform The rest array transform.
 * @returns {Function} Returns the new function.
 */
function overRest(func, start, transform) {
  start = nativeMax(start === undefined ? (func.length - 1) : start, 0);
  return function() {
    var args = arguments,
        index = -1,
        length = nativeMax(args.length - start, 0),
        array = Array(length);

    while (++index < length) {
      array[index] = args[start + index];
    }
    index = -1;
    var otherArgs = Array(start + 1);
    while (++index < start) {
      otherArgs[index] = args[index];
    }
    otherArgs[start] = transform(array);
    return apply(func, this, otherArgs);
  };
}

module.exports = overRest;


/***/ }),
/* 91 */
/***/ (function(module, exports) {

/**
 * A faster alternative to `Function#apply`, this function invokes `func`
 * with the `this` binding of `thisArg` and the arguments of `args`.
 *
 * @private
 * @param {Function} func The function to invoke.
 * @param {*} thisArg The `this` binding of `func`.
 * @param {Array} args The arguments to invoke `func` with.
 * @returns {*} Returns the result of `func`.
 */
function apply(func, thisArg, args) {
  switch (args.length) {
    case 0: return func.call(thisArg);
    case 1: return func.call(thisArg, args[0]);
    case 2: return func.call(thisArg, args[0], args[1]);
    case 3: return func.call(thisArg, args[0], args[1], args[2]);
  }
  return func.apply(thisArg, args);
}

module.exports = apply;


/***/ }),
/* 92 */
/***/ (function(module, exports, __webpack_require__) {

var baseSetToString = __webpack_require__(93),
    shortOut = __webpack_require__(95);

/**
 * Sets the `toString` method of `func` to return `string`.
 *
 * @private
 * @param {Function} func The function to modify.
 * @param {Function} string The `toString` result.
 * @returns {Function} Returns `func`.
 */
var setToString = shortOut(baseSetToString);

module.exports = setToString;


/***/ }),
/* 93 */
/***/ (function(module, exports, __webpack_require__) {

var constant = __webpack_require__(94),
    defineProperty = __webpack_require__(34),
    identity = __webpack_require__(26);

/**
 * The base implementation of `setToString` without support for hot loop shorting.
 *
 * @private
 * @param {Function} func The function to modify.
 * @param {Function} string The `toString` result.
 * @returns {Function} Returns `func`.
 */
var baseSetToString = !defineProperty ? identity : function(func, string) {
  return defineProperty(func, 'toString', {
    'configurable': true,
    'enumerable': false,
    'value': constant(string),
    'writable': true
  });
};

module.exports = baseSetToString;


/***/ }),
/* 94 */
/***/ (function(module, exports) {

/**
 * Creates a function that returns `value`.
 *
 * @static
 * @memberOf _
 * @since 2.4.0
 * @category Util
 * @param {*} value The value to return from the new function.
 * @returns {Function} Returns the new constant function.
 * @example
 *
 * var objects = _.times(2, _.constant({ 'a': 1 }));
 *
 * console.log(objects);
 * // => [{ 'a': 1 }, { 'a': 1 }]
 *
 * console.log(objects[0] === objects[1]);
 * // => true
 */
function constant(value) {
  return function() {
    return value;
  };
}

module.exports = constant;


/***/ }),
/* 95 */
/***/ (function(module, exports) {

/** Used to detect hot functions by number of calls within a span of milliseconds. */
var HOT_COUNT = 800,
    HOT_SPAN = 16;

/* Built-in method references for those with the same name as other `lodash` methods. */
var nativeNow = Date.now;

/**
 * Creates a function that'll short out and invoke `identity` instead
 * of `func` when it's called `HOT_COUNT` or more times in `HOT_SPAN`
 * milliseconds.
 *
 * @private
 * @param {Function} func The function to restrict.
 * @returns {Function} Returns the new shortable function.
 */
function shortOut(func) {
  var count = 0,
      lastCalled = 0;

  return function() {
    var stamp = nativeNow(),
        remaining = HOT_SPAN - (stamp - lastCalled);

    lastCalled = stamp;
    if (remaining > 0) {
      if (++count >= HOT_COUNT) {
        return arguments[0];
      }
    } else {
      count = 0;
    }
    return func.apply(undefined, arguments);
  };
}

module.exports = shortOut;


/***/ }),
/* 96 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__icons__ = __webpack_require__(3);


(function (wpI18n, wpBlocks, wpEditor, wpComponents) {
  var __ = wpI18n.__;
  var registerBlockType = wpBlocks.registerBlockType;
  var RichText = wpEditor.RichText,
      InspectorControls = wpEditor.InspectorControls,
      BlockControls = wpEditor.BlockControls,
      URLInputButton = wpEditor.URLInputButton;
  var TextControl = wpComponents.TextControl,
      PanelBody = wpComponents.PanelBody,
      PanelRow = wpComponents.PanelRow,
      RangeControl = wpComponents.RangeControl,
      ToggleControl = wpComponents.ToggleControl,
      SelectControl = wpComponents.SelectControl,
      ColorPalette = wpComponents.ColorPalette;


  var buttonBlockIcon = wp.element.createElement(
    "svg",
    { x: "0px", y: "0px", width: "32.05px", height: "18.128px", viewBox: "0 0 32.05 18.128", enableBackground: "new 0 0 32.05 18.128" },
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("path", {
        fill: "#0f6cb6",
        d: "M25.308,18.128c-0.148,0-0.288-0.058-0.393-0.162l-2.215-2.214l-1.642,1.698\r c-0.104,0.104-0.244,0.162-0.392,0.162c-0.037,0-0.072-0.004-0.107-0.012c-0.182-0.034-0.333-0.157-0.406-0.327l-1.604-3.811\r L2.618,13.487C1.174,13.487,0,12.313,0,10.869V2.618C0,1.175,1.174,0,2.618,0h26.815c1.443,0,2.617,1.175,2.617,2.618v8.251\r c0,1.443-1.174,2.618-2.617,2.618h-4.428l2.242,2.146c0.105,0.104,0.164,0.244,0.164,0.393s-0.059,0.288-0.164,0.393l-1.547,1.548\r C25.596,18.07,25.457,18.128,25.308,18.128 M22.729,14.438c0.147,0,0.288,0.058,0.394,0.162l2.213,2.215l0.762-0.818l-2.215-2.157\r c-0.104-0.104-0.162-0.244-0.162-0.393s0.058-0.288,0.162-0.393l1.521-1.52l-7.911-3.272l3.39,7.871l1.453-1.533\r C22.441,14.496,22.582,14.438,22.729,14.438 M26.065,12.444l3.368-0.068c0.763,0,1.402-0.576,1.49-1.34\r c-0.385,0.586-1.047,0.904-1.748,0.904h-2.606L26.065,12.444z M1.15,11.173c0.143,0.694,0.751,1.203,1.468,1.203h15.535\r l-0.254-0.46L2.876,11.94C2.222,11.94,1.601,11.662,1.15,11.173 M16.541,6.705c0.075,0,0.147,0.015,0.216,0.043l9.798,4.125\r c0.171,0.072,0.294,0.224,0.329,0.405l0.008,0.106l2.283-0.04c0.973,0,1.765-0.792,1.765-1.765V2.618\r c0-0.831-0.676-1.507-1.507-1.507H2.618c-0.831,0-1.507,0.676-1.507,1.507V9.58c0,0.973,0.792,1.765,1.765,1.765h14.843\r l-1.69-3.869c-0.088-0.209-0.041-0.447,0.119-0.608C16.253,6.763,16.393,6.705,16.541,6.705"
      }),
      wp.element.createElement("path", {
        fill: "#0f6cb6",
        d: "M22.73,14.438c0.147,0,0.287,0.058,0.393,0.163l2.213,2.214l0.762-0.818l-2.214-2.157\r c-0.104-0.104-0.163-0.244-0.163-0.393s0.059-0.288,0.163-0.393l1.521-1.52l-7.911-3.272l3.389,7.871l1.455-1.532\r C22.441,14.496,22.582,14.438,22.73,14.438"
      })
    )
  );

  registerBlockType('nab/nab-button', {
    title: __('NABShow - Button'),
    icon: { src: buttonBlockIcon },
    description: __('Nab Button is a gutenberg block used to add a clickable button.'),
    category: 'nabshow',
    keywords: [__('Button'), __('gutenberg'), __('btn')],
    attributes: {
      ButtonText: {
        type: 'string',
        source: 'html',
        selector: 'a',
        default: 'Learn More'
      },
      Link: {
        type: 'string',
        default: '#'
      },
      FontSize: {
        type: 'number',
        default: 14
      },
      paddingTop: {
        type: 'string',
        default: '10'
      },
      paddingRight: {
        type: 'string',
        default: '15'
      },
      paddingBottom: {
        type: 'string',
        default: '10'
      },
      paddingLeft: {
        type: 'string',
        default: '15'
      },
      ButtonAlignment: {
        type: 'string',
        default: 'Left'
      },
      BorderWidth: {
        type: 'number'
      },
      BorderRadius: {
        type: 'number'
      },
      FontFamily: {
        type: 'string',
        default: 'Gotham Bold'
      },
      BorderColor: {
        type: 'string',
        default: '000'
      },
      saveId: {
        type: 'string'
      },
      btnStyle: {
        type: 'string',
        default: 'btn-primary'
      },
      arrow: {
        type: 'boolean',
        default: false
      },
      newWindow: {
        type: 'boolean',
        default: false
      },
      arrowBtnColor: {
        type: 'string',
        default: '#000'
      },
      marginTop: {
        type: 'string',
        default: '0'
      },
      marginRight: {
        type: 'string',
        default: '0'
      },
      marginBottom: {
        type: 'string',
        default: '0'
      },
      marginLeft: {
        type: 'string',
        default: '0'
      },
      TextUppercase: {
        type: 'string'
      },
      customDesign: {
        type: 'boolean',
        default: false
      },
      backgroundColorNone: {
        type: 'boolean',
        default: true
      },
      backgroundColor: {
        type: 'string',
        default: '#00b5e0'
      },
      buttonColor: {
        type: 'string',
        default: '#000'
      }
    },
    edit: function edit(_ref) {
      var attributes = _ref.attributes,
          setAttributes = _ref.setAttributes,
          clientId = _ref.clientId;
      var ButtonText = attributes.ButtonText,
          paddingTop = attributes.paddingTop,
          paddingRight = attributes.paddingRight,
          paddingBottom = attributes.paddingBottom,
          paddingLeft = attributes.paddingLeft,
          Link = attributes.Link,
          BorderWidth = attributes.BorderWidth,
          BorderRadius = attributes.BorderRadius,
          BorderColor = attributes.BorderColor,
          FontSize = attributes.FontSize,
          ButtonAlignment = attributes.ButtonAlignment,
          saveId = attributes.saveId,
          FontFamily = attributes.FontFamily,
          btnStyle = attributes.btnStyle,
          arrow = attributes.arrow,
          arrowBtnColor = attributes.arrowBtnColor,
          newWindow = attributes.newWindow,
          marginTop = attributes.marginTop,
          marginRight = attributes.marginRight,
          marginBottom = attributes.marginBottom,
          marginLeft = attributes.marginLeft,
          TextUppercase = attributes.TextUppercase,
          customDesign = attributes.customDesign,
          backgroundColor = attributes.backgroundColor,
          backgroundColorNone = attributes.backgroundColorNone,
          buttonColor = attributes.buttonColor;


      setAttributes({ saveId: clientId });
      var blockID = "block-" + saveId;

      var ButtonStyle = {};
      FontSize && (ButtonStyle.fontSize = FontSize + 'px');
      customDesign && backgroundColor && (ButtonStyle.background = backgroundColorNone ? 'none' : backgroundColor);
      customDesign && buttonColor && (ButtonStyle.color = buttonColor);
      paddingTop && (ButtonStyle.paddingTop = paddingTop + 'px');
      paddingBottom && (ButtonStyle.paddingBottom = paddingBottom + 'px');
      paddingLeft && (ButtonStyle.paddingLeft = paddingLeft + 'px');
      paddingRight && (ButtonStyle.paddingRight = paddingRight + 'px');
      marginTop && (ButtonStyle.marginTop = marginTop + 'px');
      marginBottom && (ButtonStyle.marginBottom = marginBottom + 'px');
      marginLeft && (ButtonStyle.marginLeft = marginLeft + 'px');
      marginRight && (ButtonStyle.marginRight = marginRight + 'px');
      TextUppercase && (ButtonStyle.textTransform = TextUppercase);
      BorderWidth && BorderColor && (ButtonStyle.border = BorderWidth + "px solid " + BorderColor);
      BorderRadius && (ButtonStyle.borderRadius = BorderRadius + 'px');
      FontFamily && (ButtonStyle.fontFamily = "" + FontFamily);
      ButtonStyle.textDecoration = 'none';
      ButtonStyle.textAlign = 'center';
      ButtonStyle.display = 'inline-block';
      ButtonStyle.cursor = 'pointer';

      var arrowStyle = {};
      arrowBtnColor && (arrowStyle.color = arrowBtnColor);
      FontSize && (arrowStyle.fontSize = FontSize + 'px');
      FontFamily && (arrowStyle.fontFamily = "" + FontFamily);
      arrowStyle.textDecoration = 'none';
      arrowStyle.textAlign = 'center';
      arrowStyle.display = 'inline-block';
      arrowStyle.cursor = 'pointer';

      var ButtonMain = {};
      ButtonAlignment && (ButtonMain.textAlign = ButtonAlignment);

      var finaleStyle = 'with-arrow' === btnStyle ? arrowStyle : ButtonStyle;
      var finaleClass = arrow ? "title " + (arrow ? 'with-arrow' : '') : "title " + btnStyle + " " + (arrow ? 'with-arrow' : '');

      return wp.element.createElement(
        "div",
        { className: "nab-btn-main", id: blockID, style: ButtonMain },
        wp.element.createElement(
          BlockControls,
          null,
          wp.element.createElement(
            "div",
            { className: "linkBtnBar" },
            wp.element.createElement(URLInputButton, {
              url: Link,
              onChange: function onChange(url, post) {
                return setAttributes({ Link: url, text: post && post.title || 'Click here' });
              }
            })
          )
        ),
        wp.element.createElement(RichText, {
          tagName: "a",
          style: finaleStyle,
          onChange: function onChange(ButtonText) {
            return setAttributes({ ButtonText: ButtonText });
          },
          formattingControls: ['bold', 'italic'],
          value: ButtonText,
          className: finaleClass,
          rel: "noopener noreferrer"
        }),
        wp.element.createElement(
          InspectorControls,
          null,
          wp.element.createElement(
            PanelBody,
            { title: "Link", initialOpen: true },
            wp.element.createElement(
              PanelRow,
              null,
              wp.element.createElement(TextControl, {
                type: "text",
                min: "1",
                placeholder: "https:",
                value: Link,
                onChange: function onChange(Link) {
                  return setAttributes({ Link: Link });
                }
              })
            ),
            wp.element.createElement(
              PanelRow,
              null,
              wp.element.createElement(ToggleControl, {
                label: __('Open in New Window'),
                checked: newWindow,
                onChange: function onChange() {
                  return setAttributes({ newWindow: !newWindow });
                }
              })
            )
          ),
          wp.element.createElement(
            PanelBody,
            { title: "Design" },
            wp.element.createElement(
              PanelRow,
              null,
              wp.element.createElement(ToggleControl, {
                label: __('Custom Design'),
                checked: customDesign,
                onChange: function onChange() {
                  if (customDesign) {
                    setAttributes({ btnStyle: 'btn-primary' });
                  } else {
                    setAttributes({ btnStyle: 'custom-design' });
                  }
                  setAttributes({ customDesign: !customDesign });
                }
              })
            ),
            customDesign ? wp.element.createElement(
              "div",
              null,
              wp.element.createElement(
                PanelRow,
                null,
                wp.element.createElement(
                  "div",
                  { className: "inspector-field inspector-field-color " },
                  wp.element.createElement(
                    "label",
                    { className: "inspector-mb-0" },
                    "Button Color"
                  ),
                  wp.element.createElement(
                    "div",
                    { className: "inspector-ml-auto" },
                    wp.element.createElement(ColorPalette, {
                      value: buttonColor,
                      onChange: function onChange(buttonColor) {
                        return setAttributes({
                          buttonColor: buttonColor
                        });
                      }
                    })
                  )
                )
              ),
              wp.element.createElement(
                PanelRow,
                null,
                wp.element.createElement(ToggleControl, {
                  label: __('Background Transparent'),
                  checked: backgroundColorNone,
                  onChange: function onChange() {
                    return setAttributes({ backgroundColorNone: !backgroundColorNone });
                  }
                })
              ),
              backgroundColorNone ? '' : wp.element.createElement(
                "div",
                { className: "inspector-field inspector-field-color " },
                wp.element.createElement(
                  "label",
                  { className: "inspector-mb-0" },
                  "Background Color"
                ),
                wp.element.createElement(
                  "div",
                  { className: "inspector-ml-auto" },
                  wp.element.createElement(ColorPalette, {
                    value: backgroundColor,
                    onChange: function onChange(backgroundColor) {
                      return setAttributes({
                        backgroundColor: backgroundColor
                      });
                    }
                  })
                )
              )
            ) : wp.element.createElement(
              PanelRow,
              null,
              wp.element.createElement(
                "div",
                { className: "inspector-field inspector-buttons" },
                wp.element.createElement(
                  PanelRow,
                  null,
                  wp.element.createElement(
                    "div",
                    { className: "inspector-field inspector-btn-styles " },
                    wp.element.createElement(
                      "label",
                      { className: "inspector-mb-0" },
                      "Button Styles"
                    ),
                    wp.element.createElement(
                      "ul",
                      { className: "button-prev inspector-field" },
                      wp.element.createElement(
                        "li",
                        { className: 'btn-primary' === btnStyle ? 'active' : '', onClick: function onClick() {
                            return setAttributes({ btnStyle: 'btn-primary' });
                          } },
                        __WEBPACK_IMPORTED_MODULE_0__icons__["e" /* btnPrimary */]
                      ),
                      wp.element.createElement(
                        "li",
                        { className: 'btn-default' === btnStyle ? 'active' : '', onClick: function onClick() {
                            return setAttributes({ btnStyle: 'btn-default' });
                          } },
                        __WEBPACK_IMPORTED_MODULE_0__icons__["c" /* btnDefault */]
                      ),
                      wp.element.createElement(
                        "li",
                        { className: 'btn-alt' === btnStyle ? 'active' : '', onClick: function onClick() {
                            return setAttributes({ btnStyle: 'btn-alt' });
                          } },
                        __WEBPACK_IMPORTED_MODULE_0__icons__["b" /* btnAlt */]
                      ),
                      wp.element.createElement(
                        "li",
                        { className: 'btn-light' === btnStyle ? 'active' : '', onClick: function onClick() {
                            return setAttributes({ btnStyle: 'btn-light' });
                          } },
                        __WEBPACK_IMPORTED_MODULE_0__icons__["d" /* btnLight */]
                      ),
                      wp.element.createElement(
                        "li",
                        { className: 'btn-white' === btnStyle ? 'active' : '', onClick: function onClick() {
                            return setAttributes({ btnStyle: 'btn-white' });
                          } },
                        __WEBPACK_IMPORTED_MODULE_0__icons__["f" /* btnWhite */]
                      ),
                      wp.element.createElement(
                        "li",
                        { className: 'with-arrow' === btnStyle ? 'active with-arrow' : 'with-arrow', onClick: function onClick() {
                            return setAttributes({ btnStyle: 'with-arrow' });
                          } },
                        __WEBPACK_IMPORTED_MODULE_0__icons__["a" /* arrowBtn */]
                      ),
                      wp.element.createElement(
                        "li",
                        { className: 'btn-white-outline' === btnStyle ? 'active btn-white-outline-prev' : 'btn-white-outline-prev', onClick: function onClick() {
                            return setAttributes({ btnStyle: 'btn-white-outline' });
                          } },
                        wp.element.createElement(
                          "span",
                          null,
                          "Learn More"
                        )
                      ),
                      wp.element.createElement(
                        "li",
                        { className: 'btn-black-outline' === btnStyle ? 'active btn-black-outline-prev' : 'btn-black-outline-prev', onClick: function onClick() {
                            return setAttributes({ btnStyle: 'btn-black-outline' });
                          } },
                        wp.element.createElement(
                          "span",
                          null,
                          "Learn More"
                        )
                      ),
                      wp.element.createElement(
                        "li",
                        { className: 'btn-blue-outline' === btnStyle ? 'active btn-blue-outline-prev' : 'btn-blue-outline-prev', onClick: function onClick() {
                            return setAttributes({ btnStyle: 'btn-blue-outline' });
                          } },
                        wp.element.createElement(
                          "span",
                          null,
                          "Learn More"
                        )
                      ),
                      wp.element.createElement(
                        "li",
                        { className: 'btn-pink' === btnStyle ? 'active btn-pink-prev' : 'btn-pink-prev', onClick: function onClick() {
                            return setAttributes({ btnStyle: 'btn-pink' });
                          } },
                        wp.element.createElement(
                          "span",
                          null,
                          "Learn More"
                        )
                      )
                    )
                  )
                )
              )
            ),
            'with-arrow' === btnStyle ? wp.element.createElement(
              "div",
              { className: "inspector-field inspector-field-color " },
              wp.element.createElement(
                "label",
                { className: "inspector-mb-0" },
                "Color"
              ),
              wp.element.createElement(
                "div",
                { className: "inspector-ml-auto" },
                wp.element.createElement(ColorPalette, {
                  value: arrowBtnColor,
                  onChange: function onChange(arrowBtnColor) {
                    return setAttributes({
                      arrowBtnColor: arrowBtnColor
                    });
                  }
                })
              )
            ) : '',
            'with-arrow' !== btnStyle ? wp.element.createElement(
              "div",
              null,
              wp.element.createElement(
                PanelRow,
                null,
                wp.element.createElement(
                  "div",
                  { className: "inspector-field inspector-border-width" },
                  wp.element.createElement(
                    "label",
                    null,
                    "Border Width"
                  ),
                  wp.element.createElement(RangeControl, {
                    value: BorderWidth,
                    min: 0,
                    onChange: function onChange(BorderWidth) {
                      return setAttributes({ BorderWidth: BorderWidth });
                    }
                  })
                )
              ),
              wp.element.createElement(
                PanelRow,
                null,
                wp.element.createElement(
                  "div",
                  { className: "inspector-field inspector-border-radius" },
                  wp.element.createElement(
                    "label",
                    null,
                    "Border radius"
                  ),
                  wp.element.createElement(RangeControl, {
                    value: BorderRadius,
                    min: 0,
                    onChange: function onChange(BorderRadius) {
                      return setAttributes({ BorderRadius: BorderRadius });
                    }
                  })
                )
              ),
              wp.element.createElement(
                PanelRow,
                null,
                wp.element.createElement(
                  "div",
                  { className: "inspector-field inspector-field-color " },
                  wp.element.createElement(
                    "label",
                    { className: "inspector-mb-0" },
                    "Border Color"
                  ),
                  wp.element.createElement(
                    "div",
                    { className: "inspector-ml-auto" },
                    wp.element.createElement(ColorPalette, {
                      value: BorderColor,
                      onChange: function onChange(BorderColor) {
                        return setAttributes({
                          BorderColor: BorderColor
                        });
                      }
                    })
                  )
                )
              )
            ) : ''
          ),
          wp.element.createElement(
            PanelBody,
            { title: "Typography", initialOpen: false },
            wp.element.createElement(
              PanelRow,
              null,
              wp.element.createElement(
                "div",
                { className: "inspector-field inspector-field-fontsize " },
                wp.element.createElement(
                  "label",
                  { className: "inspector-mb-0" },
                  "Font Size"
                ),
                wp.element.createElement(RangeControl, {
                  value: FontSize,
                  min: 8,
                  onChange: function onChange(value) {
                    return setAttributes({ FontSize: value });
                  }
                })
              )
            ),
            wp.element.createElement(
              PanelRow,
              null,
              wp.element.createElement(
                "div",
                { className: "inspector-field inspector-field-fontfamily " },
                wp.element.createElement(
                  "label",
                  { className: "inspector-mb-0" },
                  "Font Family"
                ),
                wp.element.createElement(SelectControl, {
                  value: FontFamily,
                  options: [{ label: __('Molot'), value: 'Molot' }, { label: __('Roboto Regular'), value: 'Roboto Regular' }, { label: __('Roboto Black'), value: 'Roboto Black' }, { label: __('Roboto Bold'), value: 'Roboto Bold' }, { label: __('Roboto BoldItalic'), value: 'Roboto BoldItalic' }, { label: __('Roboto Italic'), value: 'Roboto Italic' }, { label: __('Roboto Light'), value: 'Roboto Light' }, { label: __('Roboto Medium'), value: 'Roboto Medium' }, { label: __('Roboto Thin'), value: 'Roboto Thin' }, { label: __('Gotham Book'), value: 'Gotham Book' }, { label: __('Gotham Book Italic'), value: 'Gotham Book Italic' }, { label: __('Gotham Light'), value: 'Gotham Light' }, { label: __('Gotham Light Italic'), value: 'Gotham Light Italic' }, { label: __('Gotham Medium'), value: 'Gotham Medium' }, { label: __('Gotham Bold'), value: 'Gotham Bold' }, { label: __('Gotham Bold Italic'), value: 'Gotham Bold Italic' }, { label: __('Gotham Black Regular'), value: 'Gotham Black Regular' }, { label: __('Gotham Light Regular'), value: 'Gotham Light Regular' }, { label: __('Gotham Thin Regular'), value: 'Gotham Thin Regular' }, { label: __('Gotham XLight Regular'), value: 'Gotham XLight Regular' }, { label: __('Gotham Book Italic'), value: 'Gotham Book Italic' }, { label: __('Gotham Thin Italic'), value: 'Gotham Thin Italic' }, { label: __('Gotham Ultra Italic'), value: 'Gotham Ultra Italic' }, { label: __('Vollkorn Black'), value: 'Vollkorn Black' }, { label: __('Vollkorn BlackItalic'), value: 'Vollkorn BlackItalic' }, { label: __('Vollkorn Bold'), value: 'Vollkorn Bold' }, { label: __('Vollkorn BoldItalic'), value: 'Vollkorn BoldItalic' }, { label: __('Vollkorn Italic'), value: 'Vollkorn Italic' }, { label: __('Vollkorn Regular'), value: 'Vollkorn Regular' }, { label: __('Vollkorn SemiBold'), value: 'Vollkorn SemiBold' }, { label: __('Vollkorn SemiBoldItalic'), value: 'Vollkorn SemiBoldItalic' }],
                  onChange: function onChange(value) {
                    return setAttributes({ FontFamily: value });
                  }
                })
              )
            ),
            wp.element.createElement(
              PanelRow,
              null,
              wp.element.createElement(
                "div",
                { className: "inspector-field-alignment inspector-field inspector-responsive" },
                wp.element.createElement(
                  "label",
                  null,
                  "Alignment"
                ),
                wp.element.createElement(
                  "div",
                  { className: "inspector-field-button-list inspector-field-button-list-fluid" },
                  wp.element.createElement(
                    "button",
                    { className: 'left' === ButtonAlignment ? 'active inspector-button' : 'inspector-button', onClick: function onClick() {
                        return setAttributes({ ButtonAlignment: 'left' });
                      } },
                    wp.element.createElement(
                      "svg",
                      { width: "21", height: "18", viewBox: "0 0 21 18", xmlns: "http://www.w3.org/2000/svg" },
                      wp.element.createElement(
                        "g",
                        { transform: "translate(-29 -4) translate(29 4)", fill: "none" },
                        wp.element.createElement("path", { d: "M1 .708v15.851", className: "inspector-svg-stroke", "stroke-linecap": "square" }),
                        wp.element.createElement("rect", { className: "inspector-svg-fill", x: "5", y: "5", width: "16", height: "7", rx: "1" })
                      )
                    )
                  ),
                  wp.element.createElement(
                    "button",
                    { className: 'center' === ButtonAlignment ? 'active inspector-button' : 'inspector-button', onClick: function onClick() {
                        return setAttributes({ ButtonAlignment: 'center' });
                      } },
                    wp.element.createElement(
                      "svg",
                      { width: "16", height: "18", viewBox: "0 0 16 18", xmlns: "http://www.w3.org/2000/svg" },
                      wp.element.createElement(
                        "g",
                        { transform: "translate(-115 -4) translate(115 4)", fill: "none" },
                        wp.element.createElement("path", { d: "M8 .708v15.851", className: "inspector-svg-stroke", "stroke-linecap": "square" }),
                        wp.element.createElement("rect", { className: "inspector-svg-fill", y: "5", width: "16", height: "7", rx: "1" })
                      )
                    )
                  ),
                  wp.element.createElement(
                    "button",
                    { className: 'Right' === ButtonAlignment ? 'active inspector-button' : 'inspector-button', onClick: function onClick() {
                        return setAttributes({ ButtonAlignment: 'Right' });
                      } },
                    wp.element.createElement(
                      "svg",
                      { width: "21", height: "18", viewBox: "0 0 21 18", xmlns: "http://www.w3.org/2000/svg" },
                      wp.element.createElement(
                        "g",
                        { transform: "translate(0 1) rotate(-180 10.5 8.5)", fill: "none" },
                        wp.element.createElement("path", { d: "M1 .708v15.851", className: "inspector-svg-stroke", "stroke-linecap": "square" }),
                        wp.element.createElement("rect", { className: "inspector-svg-fill", "fill-rule": "nonzero", x: "5", y: "5", width: "16", height: "7", rx: "1" })
                      )
                    )
                  )
                )
              )
            ),
            wp.element.createElement(
              PanelRow,
              null,
              wp.element.createElement(
                "div",
                { className: "inspector-field inspector-field-transform" },
                wp.element.createElement(
                  "label",
                  { className: "mt10" },
                  "Text Transform"
                ),
                wp.element.createElement(
                  "div",
                  { className: "inspector-field-button-list inspector-field-button-list-fluid inspector-ml-auto" },
                  wp.element.createElement(
                    "button",
                    { className: 'none' === TextUppercase ? 'active  inspector-button' : 'inspector-button', onClick: function onClick() {
                        return setAttributes({ TextUppercase: 'none' });
                      } },
                    wp.element.createElement("i", { className: "fa fa-ban" })
                  ),
                  wp.element.createElement(
                    "button",
                    { className: 'lowercase' === TextUppercase ? 'active  inspector-button' : 'inspector-button', onClick: function onClick() {
                        return setAttributes({ TextUppercase: 'lowercase' });
                      } },
                    wp.element.createElement(
                      "span",
                      null,
                      "aa"
                    )
                  ),
                  wp.element.createElement(
                    "button",
                    { className: 'capitalize' === TextUppercase ? 'active  inspector-button' : 'inspector-button', onClick: function onClick() {
                        return setAttributes({ TextUppercase: 'capitalize' });
                      } },
                    wp.element.createElement(
                      "span",
                      null,
                      "Aa"
                    )
                  ),
                  wp.element.createElement(
                    "button",
                    { className: 'uppercase' === TextUppercase ? 'active  inspector-button' : 'inspector-button', onClick: function onClick() {
                        return setAttributes({ TextUppercase: 'uppercase' });
                      } },
                    wp.element.createElement(
                      "span",
                      null,
                      "AA"
                    )
                  )
                )
              )
            )
          ),
          false === arrow ? wp.element.createElement(
            PanelBody,
            { title: "Spacing", initialOpen: false },
            wp.element.createElement(
              PanelRow,
              null,
              wp.element.createElement(
                "div",
                { className: "inspector-field inspector-field-padding" },
                wp.element.createElement(
                  "label",
                  { className: "mt10" },
                  "Padding"
                ),
                wp.element.createElement(
                  "div",
                  { className: "padding-setting" },
                  wp.element.createElement(
                    "div",
                    { className: "col-main-4" },
                    wp.element.createElement(
                      "div",
                      { className: "padd-top col-main-inner", "data-tooltip": "padding Top" },
                      wp.element.createElement(TextControl, {
                        type: "number",
                        min: "1",
                        value: paddingTop,
                        onChange: function onChange(value) {
                          return setAttributes({ paddingTop: value });
                        }
                      }),
                      wp.element.createElement(
                        "label",
                        null,
                        "Top"
                      )
                    ),
                    wp.element.createElement(
                      "div",
                      { className: "padd-buttom col-main-inner", "data-tooltip": "padding Bottom" },
                      wp.element.createElement(TextControl, {
                        type: "number",
                        min: "1",
                        value: paddingBottom,
                        onChange: function onChange(value) {
                          return setAttributes({ paddingBottom: value });
                        }
                      }),
                      wp.element.createElement(
                        "label",
                        null,
                        "Bottom"
                      )
                    ),
                    wp.element.createElement(
                      "div",
                      { className: "padd-left col-main-inner", "data-tooltip": "padding Left" },
                      wp.element.createElement(TextControl, {
                        type: "number",
                        min: "1",
                        value: paddingLeft,
                        onChange: function onChange(value) {
                          return setAttributes({ paddingLeft: value });
                        }
                      }),
                      wp.element.createElement(
                        "label",
                        null,
                        "Left"
                      )
                    ),
                    wp.element.createElement(
                      "div",
                      { className: "padd-right col-main-inner", "data-tooltip": "padding Right" },
                      wp.element.createElement(TextControl, {
                        type: "number",
                        min: "1",
                        value: paddingRight,
                        onChange: function onChange(value) {
                          return setAttributes({ paddingRight: value });
                        }
                      }),
                      wp.element.createElement(
                        "label",
                        null,
                        "Right"
                      )
                    )
                  )
                )
              )
            ),
            wp.element.createElement(
              PanelRow,
              null,
              wp.element.createElement(
                "div",
                { className: "inspector-field inspector-field-margin" },
                wp.element.createElement(
                  "label",
                  { className: "mt10" },
                  "Margin"
                ),
                wp.element.createElement(
                  "div",
                  { className: "margin-setting" },
                  wp.element.createElement(
                    "div",
                    { className: "col-main-4" },
                    wp.element.createElement(
                      "div",
                      { className: "padd-top col-main-inner", "data-tooltip": "margin Top" },
                      wp.element.createElement(TextControl, {
                        type: "number",
                        min: "1",
                        value: marginTop,
                        onChange: function onChange(value) {
                          return setAttributes({ marginTop: value });
                        }
                      }),
                      wp.element.createElement(
                        "label",
                        null,
                        "Top"
                      )
                    ),
                    wp.element.createElement(
                      "div",
                      { className: "padd-buttom col-main-inner", "data-tooltip": "margin Bottom" },
                      wp.element.createElement(TextControl, {
                        type: "number",
                        min: "1",
                        value: marginBottom,
                        onChange: function onChange(value) {
                          return setAttributes({ marginBottom: value });
                        }
                      }),
                      wp.element.createElement(
                        "label",
                        null,
                        "Bottom"
                      )
                    ),
                    wp.element.createElement(
                      "div",
                      { className: "padd-left col-main-inner", "data-tooltip": "margin Left" },
                      wp.element.createElement(TextControl, {
                        type: "number",
                        min: "1",
                        value: marginLeft,
                        onChange: function onChange(value) {
                          return setAttributes({ marginLeft: value });
                        }
                      }),
                      wp.element.createElement(
                        "label",
                        null,
                        "Left"
                      )
                    ),
                    wp.element.createElement(
                      "div",
                      { className: "padd-right col-main-inner", "data-tooltip": "margin Right" },
                      wp.element.createElement(TextControl, {
                        type: "number",
                        min: "1",
                        value: marginRight,
                        onChange: function onChange(value) {
                          return setAttributes({ marginRight: value });
                        }
                      }),
                      wp.element.createElement(
                        "label",
                        null,
                        "Right"
                      )
                    )
                  )
                )
              )
            )
          ) : ''
        )
      );
    },
    save: function save(_ref2) {
      var attributes = _ref2.attributes;
      var ButtonText = attributes.ButtonText,
          paddingTop = attributes.paddingTop,
          paddingRight = attributes.paddingRight,
          paddingBottom = attributes.paddingBottom,
          paddingLeft = attributes.paddingLeft,
          Link = attributes.Link,
          BorderWidth = attributes.BorderWidth,
          BorderRadius = attributes.BorderRadius,
          BorderColor = attributes.BorderColor,
          FontSize = attributes.FontSize,
          ButtonAlignment = attributes.ButtonAlignment,
          saveId = attributes.saveId,
          FontFamily = attributes.FontFamily,
          btnStyle = attributes.btnStyle,
          arrow = attributes.arrow,
          arrowBtnColor = attributes.arrowBtnColor,
          newWindow = attributes.newWindow,
          marginTop = attributes.marginTop,
          marginRight = attributes.marginRight,
          marginBottom = attributes.marginBottom,
          marginLeft = attributes.marginLeft,
          TextUppercase = attributes.TextUppercase,
          backgroundColor = attributes.backgroundColor,
          customDesign = attributes.customDesign,
          backgroundColorNone = attributes.backgroundColorNone,
          buttonColor = attributes.buttonColor;


      var ButtonStyle = {};
      FontSize && (ButtonStyle.fontSize = FontSize + 'px');
      customDesign && backgroundColor && (ButtonStyle.background = backgroundColorNone ? 'none' : backgroundColor);
      customDesign && buttonColor && (ButtonStyle.color = buttonColor);
      paddingTop && (ButtonStyle.paddingTop = paddingTop + 'px');
      paddingBottom && (ButtonStyle.paddingBottom = paddingBottom + 'px');
      paddingLeft && (ButtonStyle.paddingLeft = paddingLeft + 'px');
      paddingRight && (ButtonStyle.paddingRight = paddingRight + 'px');
      marginTop && (ButtonStyle.marginTop = marginTop + 'px');
      marginBottom && (ButtonStyle.marginBottom = marginBottom + 'px');
      marginLeft && (ButtonStyle.marginLeft = marginLeft + 'px');
      marginRight && (ButtonStyle.marginRight = marginRight + 'px');
      TextUppercase && (ButtonStyle.textTransform = TextUppercase);
      BorderWidth && BorderColor && (ButtonStyle.border = BorderWidth + "px solid " + BorderColor);
      BorderRadius && (ButtonStyle.borderRadius = BorderRadius + 'px');
      FontFamily && (ButtonStyle.fontFamily = "" + FontFamily);
      ButtonStyle.textDecoration = 'none';
      ButtonStyle.textAlign = 'center';
      ButtonStyle.display = 'inline-block';
      ButtonStyle.cursor = 'pointer';

      var arrowStyle = {};
      arrowBtnColor && (arrowStyle.color = arrowBtnColor);
      FontSize && (arrowStyle.fontSize = FontSize + 'px');
      FontFamily && (arrowStyle.fontFamily = "" + FontFamily);
      arrowStyle.textDecoration = 'none';
      arrowStyle.textAlign = 'center';
      arrowStyle.display = 'inline-block';
      arrowStyle.cursor = 'pointer';

      var ButtonMain = {};
      ButtonAlignment && (ButtonMain.textAlign = ButtonAlignment);

      var blockID = "block-" + saveId;

      var finaleStyle = 'with-arrow' === btnStyle ? arrowStyle : ButtonStyle;
      var finaleClass = arrow ? "title " + (arrow ? 'with-arrow' : '') : "title " + btnStyle + " " + (arrow ? 'with-arrow' : '');

      return wp.element.createElement(
        "div",
        { className: "nab-btn-main", id: blockID, style: ButtonMain },
        wp.element.createElement(RichText.Content, {
          tagName: "a",
          className: finaleClass,
          href: Link,
          target: newWindow ? '_blank' : '_self',
          rel: "noopener noreferrer",
          style: finaleStyle,
          value: ButtonText
        })
      );
    }
  });
})(wp.i18n, wp.blocks, wp.editor, wp.components);

/***/ }),
/* 97 */
/***/ (function(module, exports) {

(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
	var __ = wpI18n.__;
	var registerBlockType = wpBlocks.registerBlockType;
	var Fragment = wpElement.Fragment;
	var RichText = wpEditor.RichText,
	    InspectorControls = wpEditor.InspectorControls;
	var TextControl = wpComponents.TextControl,
	    PanelBody = wpComponents.PanelBody,
	    PanelRow = wpComponents.PanelRow,
	    SelectControl = wpComponents.SelectControl,
	    ColorPalette = wpComponents.ColorPalette,
	    RangeControl = wpComponents.RangeControl,
	    CheckboxControl = wpComponents.CheckboxControl;


	var headingBlockIcon = wp.element.createElement(
		"svg",
		{ width: "150px", height: "150px", viewBox: "222.64 222.641 150 150", "enable-background": "new 222.64 222.641 150 150" },
		wp.element.createElement(
			"g",
			null,
			wp.element.createElement("polygon", { fill: "#0F6CB6", points: "364.14,260.983 364.14,256.627 345.406,256.627 345.406,260.983 352.595,260.983 352.595,334.296 345.406,334.296 345.406,338.652 364.14,338.652 364.14,334.296 356.951,334.296 356.951,260.983 \t" }),
			wp.element.createElement(
				"g",
				null,
				wp.element.createElement("path", { fill: "#0F6CB6", d: "M231.949,320.921l21.925-49.513c1.529-3.414,4.313-5.481,8.088-5.481h0.809\r c3.773,0,6.469,2.067,7.997,5.481l21.926,49.513c0.449,0.988,0.72,1.887,0.72,2.785c0,3.685-2.875,6.65-6.56,6.65\r c-3.235,0-5.392-1.888-6.649-4.764l-4.223-9.883h-27.677l-4.403,10.333c-1.168,2.695-3.504,4.313-6.38,4.313\r c-3.596-0.001-6.38-2.876-6.38-6.471C231.141,322.897,231.5,321.909,231.949,320.921z M270.858,303.488l-8.717-20.758\r l-8.716,20.758H270.858z" }),
				wp.element.createElement("path", { fill: "#0F6CB6", d: "M299.969,315.978v-0.18c0-10.513,7.998-15.365,19.41-15.365c4.853,0,8.357,0.809,11.772,1.977v-0.809\r c0-5.661-3.505-8.806-10.335-8.806c-3.773,0-6.829,0.539-9.435,1.348c-0.809,0.269-1.348,0.358-1.979,0.358\r c-3.144,0-5.66-2.426-5.66-5.571c0-2.426,1.527-4.493,3.684-5.302c4.313-1.618,8.987-2.516,15.366-2.516\r c7.458,0,12.851,1.977,16.265,5.391c3.595,3.594,5.212,8.896,5.212,15.366v21.925c0,3.686-2.965,6.561-6.649,6.561\r c-3.954,0-6.56-2.786-6.56-5.662v-0.09c-3.325,3.685-7.908,6.11-14.557,6.11C307.427,330.715,299.969,325.504,299.969,315.978z\r M331.33,312.833v-2.426c-2.337-1.078-5.392-1.798-8.717-1.798c-5.841,0-9.435,2.337-9.435,6.649v0.181\r c0,3.684,3.055,5.841,7.458,5.841C327.017,321.28,331.33,317.775,331.33,312.833z" })
			)
		)
	);

	registerBlockType('nab/nab-heading', {
		title: __('Nab - Heading'),
		icon: { src: headingBlockIcon },
		description: __('Nab Heading is a gutenberg block which defines six levels of headings.'),
		category: 'nabshow',
		keywords: [__('Heading'), __('gutenberg')],
		attributes: {
			HeadingText: {
				type: 'string',
				default: 'Heading'
			},
			HeadingLevel: {
				type: 'string',
				default: 'h2'
			},
			FontSize: {
				type: 'number'
			},
			LineHeight: {
				type: 'string'
			},
			LetterSpacing: {
				type: 'string'
			},
			marginTop: {
				type: 'string',
				default: '0'
			},
			marginRight: {
				type: 'string',
				default: '0'
			},
			marginBottom: {
				type: 'string',
				default: '10'
			},
			marginLeft: {
				type: 'string',
				default: '0'
			},
			paddingTop: {
				type: 'string',
				default: '0'
			},
			paddingRight: {
				type: 'string',
				default: '0'
			},
			paddingBottom: {
				type: 'string',
				default: '0'
			},
			paddingLeft: {
				type: 'string',
				default: '0'
			},
			HeadingColor: {
				type: 'string',
				default: '#000'
			},
			TextUppercase: {
				type: 'string'
			},
			TextAlign: {
				type: 'string',
				default: 'left'
			},
			fontFamily: {
				type: 'string',
				default: 'Gotham Bold'
			},
			designOpt: {
				type: 'boolean'
			},
			backgroundColor: {
				type: 'string',
				default: ''
			}
		},
		edit: function edit(_ref) {
			var attributes = _ref.attributes,
			    setAttributes = _ref.setAttributes;
			var HeadingText = attributes.HeadingText,
			    HeadingLevel = attributes.HeadingLevel,
			    FontSize = attributes.FontSize,
			    marginTop = attributes.marginTop,
			    marginRight = attributes.marginRight,
			    marginBottom = attributes.marginBottom,
			    marginLeft = attributes.marginLeft,
			    paddingTop = attributes.paddingTop,
			    paddingRight = attributes.paddingRight,
			    paddingBottom = attributes.paddingBottom,
			    paddingLeft = attributes.paddingLeft,
			    LineHeight = attributes.LineHeight,
			    LetterSpacing = attributes.LetterSpacing,
			    HeadingColor = attributes.HeadingColor,
			    TextUppercase = attributes.TextUppercase,
			    TextAlign = attributes.TextAlign,
			    fontFamily = attributes.fontFamily,
			    designOpt = attributes.designOpt,
			    backgroundColor = attributes.backgroundColor;


			var HeadingStyle = {};
			FontSize && (HeadingStyle.fontSize = FontSize + 'px');
			HeadingColor && (HeadingStyle.color = HeadingColor);
			LineHeight && (HeadingStyle.lineHeight = LineHeight + "px");
			LetterSpacing && (HeadingStyle.letterSpacing = LetterSpacing + "px");
			TextUppercase && (HeadingStyle.textTransform = TextUppercase);
			marginTop && (HeadingStyle.marginTop = marginTop + 'px');
			marginBottom && (HeadingStyle.marginBottom = marginBottom + 'px');
			marginLeft && (HeadingStyle.marginLeft = marginLeft + 'px');
			marginRight && (HeadingStyle.marginRight = marginRight + 'px');
			paddingTop && (HeadingStyle.paddingTop = paddingTop + 'px');
			paddingBottom && (HeadingStyle.paddingBottom = paddingBottom + 'px');
			paddingLeft && (HeadingStyle.paddingLeft = paddingLeft + 'px');
			paddingRight && (HeadingStyle.paddingRight = paddingRight + 'px');
			TextAlign && (HeadingStyle.textAlign = TextAlign);
			fontFamily && (HeadingStyle.fontFamily = fontFamily);

			var tiltedStyle = {};
			backgroundColor && (tiltedStyle.backgroundColor = backgroundColor);

			return wp.element.createElement(
				Fragment,
				null,
				true === designOpt ? wp.element.createElement(
					"div",
					{ className: "nab-heading", style: tiltedStyle },
					wp.element.createElement(RichText, {
						tagName: HeadingLevel,
						onChange: function onChange(HeadingText) {
							return setAttributes({ HeadingText: HeadingText });
						},
						value: HeadingText,
						style: HeadingStyle,
						className: "title nab-title"
					}),
					wp.element.createElement("span", { className: "tilted-design", style: tiltedStyle })
				) : wp.element.createElement(RichText, {
					tagName: HeadingLevel,
					onChange: function onChange(HeadingText) {
						return setAttributes({ HeadingText: HeadingText });
					},
					value: HeadingText,
					style: HeadingStyle,
					className: "title nab-title"
				}),
				wp.element.createElement(
					InspectorControls,
					null,
					wp.element.createElement(
						PanelBody,
						{ title: "Heading", initialOpen: true },
						wp.element.createElement(
							PanelRow,
							null,
							wp.element.createElement(
								"div",
								{ className: "inspector-field inspector-field-headings" },
								wp.element.createElement(
									"div",
									{ className: "inspector-field-button-list inspector-field-button-list-fluid" },
									wp.element.createElement(
										"button",
										{ className: 'h1' === HeadingLevel ? 'active  inspector-button' : 'inspector-button', onClick: function onClick() {
												return setAttributes({ HeadingLevel: 'h1' });
											} },
										wp.element.createElement(
											"svg",
											{ width: "17", height: "13", viewBox: "0 0 17 13", xmlns: "http://www.w3.org/2000/svg" },
											wp.element.createElement(
												"g",
												{ className: "inspector-svg-fill", "fill-rule": "nonzero" },
												wp.element.createElement("path", { d: "M10.83 13h-2.109v-5.792h-5.924v5.792h-2.101v-12.85h2.101v5.256h5.924v-5.256h2.109z" }),
												wp.element.createElement("path", { d: "M16.809 13h-1.147v-4.609c0-.55.013-.986.039-1.309l-.276.259c-.109.094-.474.394-1.096.898l-.576-.728 2.1-1.65h.957v7.139z" })
											)
										)
									),
									wp.element.createElement(
										"button",
										{ className: 'h2' === HeadingLevel ? 'active  inspector-button' : 'inspector-button', onClick: function onClick() {
												return setAttributes({ HeadingLevel: 'h2' });
											} },
										wp.element.createElement(
											"svg",
											{ width: "19", height: "13", viewBox: "0 0 19 13", xmlns: "http://www.w3.org/2000/svg" },
											wp.element.createElement(
												"g",
												{ className: "inspector-svg-fill", "fill-rule": "nonzero" },
												wp.element.createElement("path", { d: "M10.83 13h-2.109v-5.792h-5.924v5.792h-2.101v-12.85h2.101v5.256h5.924v-5.256h2.109z" }),
												wp.element.createElement("path", { d: "M18.278 13h-4.839v-.869l1.841-1.851c.544-.557.904-.951 1.082-1.184.177-.233.307-.452.388-.657.081-.205.122-.425.122-.659 0-.322-.097-.576-.291-.762-.194-.186-.461-.278-.803-.278-.273 0-.538.05-.793.151-.256.101-.551.283-.886.547l-.62-.757c.397-.335.783-.573 1.157-.713s.773-.21 1.196-.21c.664 0 1.196.173 1.597.52.4.347.601.813.601 1.399 0 .322-.058.628-.173.918-.116.29-.293.588-.532.896-.239.308-.637.723-1.194 1.248l-1.24 1.201v.049h3.389v1.011z" })
											)
										)
									),
									wp.element.createElement(
										"button",
										{ className: 'h3' === HeadingLevel ? 'active  inspector-button' : 'inspector-button', onClick: function onClick() {
												return setAttributes({ HeadingLevel: 'h3' });
											} },
										wp.element.createElement(
											"svg",
											{ width: "19", height: "14", viewBox: "0 0 19 14", xmlns: "http://www.w3.org/2000/svg" },
											wp.element.createElement(
												"g",
												{ className: "inspector-svg-fill", "fill-rule": "nonzero" },
												wp.element.createElement("path", { d: "M10.83 13h-2.109v-5.792h-5.924v5.792h-2.101v-12.85h2.101v5.256h5.924v-5.256h2.109z" }),
												wp.element.createElement("path", { d: "M18.01 7.502c0 .452-.132.829-.396 1.13-.264.301-.635.504-1.113.608v.039c.573.072 1.003.25 1.289.535.286.285.43.663.43 1.135 0 .687-.243 1.217-.728 1.589-.485.373-1.175.559-2.07.559-.791 0-1.458-.129-2.002-.386v-1.021c.303.15.623.265.962.347.339.081.664.122.977.122.553 0 .967-.103 1.24-.308.273-.205.41-.522.41-.952 0-.381-.151-.661-.454-.84-.303-.179-.778-.269-1.426-.269h-.62v-.933h.63c1.139 0 1.709-.394 1.709-1.182 0-.306-.099-.542-.298-.708-.199-.166-.492-.249-.879-.249-.27 0-.531.038-.781.115-.251.076-.547.225-.889.447l-.562-.801c.654-.482 1.414-.723 2.28-.723.719 0 1.281.155 1.685.464.404.309.605.736.605 1.279z" })
											)
										)
									),
									wp.element.createElement(
										"button",
										{ className: 'h4' === HeadingLevel ? 'active  inspector-button' : 'inspector-button', onClick: function onClick() {
												return setAttributes({ HeadingLevel: 'h4' });
											} },
										wp.element.createElement(
											"svg",
											{ width: "19", height: "13", viewBox: "0 0 19 13", xmlns: "http://www.w3.org/2000/svg" },
											wp.element.createElement(
												"g",
												{ className: "inspector-svg-fill", "fill-rule": "nonzero" },
												wp.element.createElement("path", { d: "M10.83 13h-2.109v-5.792h-5.924v5.792h-2.101v-12.85h2.101v5.256h5.924v-5.256h2.109z" }),
												wp.element.createElement("path", { d: "M18.532 11.442h-.962v1.558h-1.118v-1.558h-3.262v-.884l3.262-4.717h1.118v4.648h.962v.952zm-2.08-.952v-1.792c0-.638.016-1.16.049-1.567h-.039c-.091.215-.234.475-.43.781l-1.772 2.578h2.192z" })
											)
										)
									),
									wp.element.createElement(
										"button",
										{ className: 'h5' === HeadingLevel ? 'active  inspector-button' : 'inspector-button', onClick: function onClick() {
												return setAttributes({ HeadingLevel: 'h5' });
											} },
										wp.element.createElement(
											"svg",
											{ width: "19", height: "14", viewBox: "0 0 19 14", xmlns: "http://www.w3.org/2000/svg" },
											wp.element.createElement(
												"g",
												{ className: "inspector-svg-fill", "fill-rule": "nonzero" },
												wp.element.createElement("path", { d: "M10.83 13h-2.109v-5.792h-5.924v5.792h-2.101v-12.85h2.101v5.256h5.924v-5.256h2.109z" }),
												wp.element.createElement("path", { d: "M15.861 8.542c.719 0 1.289.19 1.709.571.42.381.63.9.63 1.558 0 .762-.238 1.357-.715 1.785-.477.428-1.155.642-2.034.642-.798 0-1.424-.129-1.88-.386v-1.04c.264.15.566.265.908.347.342.081.659.122.952.122.518 0 .911-.116 1.182-.347.27-.231.405-.57.405-1.016 0-.853-.544-1.279-1.631-1.279-.153 0-.342.015-.566.046-.225.031-.422.066-.591.105l-.513-.303.273-3.486h3.711v1.021h-2.7l-.161 1.768.417-.068c.164-.026.365-.039.603-.039z" })
											)
										)
									),
									wp.element.createElement(
										"button",
										{ className: 'h6' === HeadingLevel ? 'active  inspector-button' : 'inspector-button', onClick: function onClick() {
												return setAttributes({ HeadingLevel: 'h6' });
											} },
										wp.element.createElement(
											"svg",
											{ width: "19", height: "14", viewBox: "0 0 19 14", xmlns: "http://www.w3.org/2000/svg" },
											wp.element.createElement(
												"g",
												{ className: "inspector-svg-fill", "fill-rule": "nonzero" },
												wp.element.createElement("path", { d: "M10.83 13h-2.109v-5.792h-5.924v5.792h-2.101v-12.85h2.101v5.256h5.924v-5.256h2.109z" }),
												wp.element.createElement("path", { d: "M13.459 9.958c0-2.793 1.138-4.189 3.413-4.189.358 0 .661.028.908.083v.957c-.247-.072-.534-.107-.859-.107-.765 0-1.34.205-1.724.615-.384.41-.592 1.068-.625 1.973h.059c.153-.264.368-.468.645-.613.277-.145.602-.217.977-.217.648 0 1.152.199 1.514.596.361.397.542.936.542 1.616 0 .749-.209 1.34-.627 1.775-.418.435-.989.652-1.711.652-.511 0-.955-.123-1.333-.369s-.668-.604-.872-1.074c-.203-.47-.305-1.036-.305-1.697zm2.49 2.192c.394 0 .697-.127.911-.381.213-.254.32-.617.32-1.089 0-.41-.1-.732-.3-.967-.2-.234-.5-.352-.901-.352-.247 0-.475.053-.684.159-.208.106-.373.251-.493.435s-.181.372-.181.564c0 .459.125.846.374 1.16.249.314.567.471.955.471z" })
											)
										)
									)
								)
							)
						)
					),
					wp.element.createElement(
						PanelBody,
						{ title: "Heading Design", initialOpen: false },
						wp.element.createElement(
							PanelRow,
							null,
							wp.element.createElement(
								"div",
								{ className: "inspector-field inspector-field-headings-design" },
								wp.element.createElement(CheckboxControl, {
									className: "in-checkbox",
									label: "Tilted Design",
									checked: designOpt,
									onChange: function onChange(isChecked) {
										if (isChecked) {
											setAttributes({ designOpt: true });
										} else {
											setAttributes({ designOpt: false });
										}
									}
								})
							)
						)
					),
					designOpt && wp.element.createElement(
						PanelBody,
						{ title: __('Background Color'), initialOpen: true, className: "bg-setting" },
						wp.element.createElement(
							PanelRow,
							null,
							wp.element.createElement(
								"div",
								{ className: "inspector-field inspector-field-color " },
								wp.element.createElement(
									"label",
									{ className: "inspector-mb-0" },
									"Background Color"
								),
								wp.element.createElement(
									"div",
									{ className: "inspector-ml-auto" },
									wp.element.createElement(ColorPalette, {
										value: backgroundColor,
										onChange: function onChange(value) {
											return setAttributes({ backgroundColor: value ? value : '', opacity: 0 });
										}
									})
								)
							)
						)
					),
					wp.element.createElement(
						PanelBody,
						{ title: "Typography", initialOpen: false },
						wp.element.createElement(
							PanelRow,
							null,
							wp.element.createElement(
								"div",
								{ className: "inspector-field inspector-field-color " },
								wp.element.createElement(
									"label",
									{ className: "inspector-mb-0" },
									"Color"
								),
								wp.element.createElement(
									"div",
									{ className: "inspector-ml-auto" },
									wp.element.createElement(ColorPalette, {
										value: HeadingColor,
										onChange: function onChange(HeadingColor) {
											return setAttributes({
												HeadingColor: HeadingColor
											});
										}
									})
								)
							)
						),
						wp.element.createElement(
							PanelRow,
							null,
							wp.element.createElement(
								"div",
								{ className: "inspector-field inspector-field-fontsize " },
								wp.element.createElement(
									"label",
									{ className: "inspector-mb-0" },
									"Font Size"
								),
								wp.element.createElement(RangeControl, {
									value: FontSize,
									min: 8,
									onChange: function onChange(value) {
										return setAttributes({ FontSize: value });
									}
								})
							)
						),
						wp.element.createElement(
							PanelRow,
							null,
							wp.element.createElement(
								"div",
								{ className: "inspector-field inspector-field-fontfamily " },
								wp.element.createElement(
									"label",
									{ className: "inspector-mb-0" },
									"Font Family"
								),
								wp.element.createElement(SelectControl, {
									value: fontFamily,
									options: [{ label: __('Molot'), value: 'Molot' }, { label: __('Roboto Regular'), value: 'Roboto Regular' }, { label: __('Roboto Black'), value: 'Roboto Black' }, { label: __('Roboto Bold'), value: 'Roboto Bold' }, { label: __('Roboto BoldItalic'), value: 'Roboto BoldItalic' }, { label: __('Roboto Italic'), value: 'Roboto Italic' }, { label: __('Roboto Light'), value: 'Roboto Light' }, { label: __('Roboto Medium'), value: 'Roboto Medium' }, { label: __('Roboto Thin'), value: 'Roboto Thin' }, { label: __('Gotham Book'), value: 'Gotham Book' }, { label: __('Gotham Book Italic'), value: 'Gotham Book Italic' }, { label: __('Gotham Light'), value: 'Gotham Light' }, { label: __('Gotham Light Italic'), value: 'Gotham Light Italic' }, { label: __('Gotham Medium'), value: 'Gotham Medium' }, { label: __('Gotham Bold'), value: 'Gotham Bold' }, { label: __('Gotham Bold Italic'), value: 'Gotham Bold Italic' }, { label: __('Gotham Black Regular'), value: 'Gotham Black Regular' }, { label: __('Gotham Light Regular'), value: 'Gotham Light Regular' }, { label: __('Gotham Thin Regular'), value: 'Gotham Thin Regular' }, { label: __('Gotham XLight Regular'), value: 'Gotham XLight Regular' }, { label: __('Gotham Book Italic'), value: 'Gotham Book Italic' }, { label: __('Gotham Thin Italic'), value: 'Gotham Thin Italic' }, { label: __('Gotham Ultra Italic'), value: 'Gotham Ultra Italic' }, { label: __('Vollkorn Black'), value: 'Vollkorn Black' }, { label: __('Vollkorn BlackItalic'), value: 'Vollkorn BlackItalic' }, { label: __('Vollkorn Bold'), value: 'Vollkorn Bold' }, { label: __('Vollkorn BoldItalic'), value: 'Vollkorn BoldItalic' }, { label: __('Vollkorn Italic'), value: 'Vollkorn Italic' }, { label: __('Vollkorn Regular'), value: 'Vollkorn Regular' }, { label: __('Vollkorn SemiBold'), value: 'Vollkorn SemiBold' }, { label: __('Vollkorn SemiBoldItalic'), value: 'Vollkorn SemiBoldItalic' }],
									onChange: function onChange(value) {
										return setAttributes({ fontFamily: value });
									}
								})
							)
						),
						wp.element.createElement(
							PanelRow,
							null,
							wp.element.createElement(
								"div",
								{ className: "inspector-field inspector-field-fontfamily side-2-col" },
								wp.element.createElement(
									"div",
									{ className: "inspector-letter-spacing" },
									wp.element.createElement(
										"label",
										{ className: "mt10" },
										"Spacing "
									),
									wp.element.createElement(TextControl, {
										type: "number",
										min: "1",
										value: LetterSpacing,
										placeholder: "px",
										onChange: function onChange(value) {
											return setAttributes({ LetterSpacing: value });
										}
									})
								),
								wp.element.createElement(
									"div",
									{ className: "inspector-line-height" },
									wp.element.createElement(
										"label",
										{ className: "mt10" },
										"Line Height"
									),
									wp.element.createElement(TextControl, {
										type: "number",
										min: "1",
										value: LineHeight,
										placeholder: "px",
										onChange: function onChange(value) {
											return setAttributes({ LineHeight: value });
										}
									})
								)
							)
						),
						wp.element.createElement(
							PanelRow,
							null,
							wp.element.createElement(
								"div",
								{ className: "inspector-field inspector-field-alignment" },
								wp.element.createElement(
									"label",
									{ className: "inspector-mb-0" },
									"Alignment"
								),
								wp.element.createElement(
									"div",
									{ className: "inspector-field-button-list inspector-field-button-list-fluid" },
									wp.element.createElement(
										"button",
										{ className: 'left' === TextAlign ? 'active  inspector-button' : 'inspector-button', onClick: function onClick() {
												return setAttributes({ TextAlign: 'left' });
											} },
										wp.element.createElement("i", { className: "fa fa-align-left" })
									),
									wp.element.createElement(
										"button",
										{ className: 'center' === TextAlign ? 'active  inspector-button' : 'inspector-button', onClick: function onClick() {
												return setAttributes({ TextAlign: 'center' });
											} },
										wp.element.createElement("i", { className: "fa fa-align-center" })
									),
									wp.element.createElement(
										"button",
										{ className: 'right' === TextAlign ? 'active  inspector-button' : 'inspector-button', onClick: function onClick() {
												return setAttributes({ TextAlign: 'right' });
											} },
										wp.element.createElement("i", { className: "fa fa-align-right" })
									)
								)
							)
						),
						wp.element.createElement(
							PanelRow,
							null,
							wp.element.createElement(
								"div",
								{ className: "inspector-field inspector-field-transform" },
								wp.element.createElement(
									"label",
									{ className: "mt10" },
									"Text Transform"
								),
								wp.element.createElement(
									"div",
									{ className: "inspector-field-button-list inspector-field-button-list-fluid inspector-ml-auto" },
									wp.element.createElement(
										"button",
										{ className: 'none' === TextUppercase ? 'active  inspector-button' : 'inspector-button', onClick: function onClick() {
												return setAttributes({ TextUppercase: 'none' });
											} },
										wp.element.createElement("i", { className: "fa fa-ban" })
									),
									wp.element.createElement(
										"button",
										{ className: 'lowercase' === TextUppercase ? 'active  inspector-button' : 'inspector-button', onClick: function onClick() {
												return setAttributes({ TextUppercase: 'lowercase' });
											} },
										wp.element.createElement(
											"span",
											null,
											"aa"
										)
									),
									wp.element.createElement(
										"button",
										{ className: 'capitalize' === TextUppercase ? 'active  inspector-button' : 'inspector-button', onClick: function onClick() {
												return setAttributes({ TextUppercase: 'capitalize' });
											} },
										wp.element.createElement(
											"span",
											null,
											"Aa"
										)
									),
									wp.element.createElement(
										"button",
										{ className: 'uppercase' === TextUppercase ? 'active  inspector-button' : 'inspector-button', onClick: function onClick() {
												return setAttributes({ TextUppercase: 'uppercase' });
											} },
										wp.element.createElement(
											"span",
											null,
											"AA"
										)
									)
								)
							)
						)
					),
					wp.element.createElement(
						PanelBody,
						{ title: "Spacing", initialOpen: false },
						wp.element.createElement(
							PanelRow,
							null,
							wp.element.createElement(
								"div",
								{ className: "inspector-field inspector-field-padding" },
								wp.element.createElement(
									"label",
									{ className: "mt10" },
									"Padding"
								),
								wp.element.createElement(
									"div",
									{ className: "padding-setting" },
									wp.element.createElement(
										"div",
										{ className: "col-main-4" },
										wp.element.createElement(
											"div",
											{ className: "padd-top col-main-inner", "data-tooltip": "padding Top" },
											wp.element.createElement(TextControl, {
												type: "number",
												min: "1",
												value: paddingTop,
												onChange: function onChange(value) {
													return setAttributes({ paddingTop: value });
												}
											}),
											wp.element.createElement(
												"label",
												null,
												"Top"
											)
										),
										wp.element.createElement(
											"div",
											{ className: "padd-buttom col-main-inner", "data-tooltip": "padding Bottom" },
											wp.element.createElement(TextControl, {
												type: "number",
												min: "1",
												value: paddingBottom,
												onChange: function onChange(value) {
													return setAttributes({ paddingBottom: value });
												}
											}),
											wp.element.createElement(
												"label",
												null,
												"Bottom"
											)
										),
										wp.element.createElement(
											"div",
											{ className: "padd-left col-main-inner", "data-tooltip": "padding Left" },
											wp.element.createElement(TextControl, {
												type: "number",
												min: "1",
												value: paddingLeft,
												onChange: function onChange(value) {
													return setAttributes({ paddingLeft: value });
												}
											}),
											wp.element.createElement(
												"label",
												null,
												"Left"
											)
										),
										wp.element.createElement(
											"div",
											{ className: "padd-right col-main-inner", "data-tooltip": "padding Right" },
											wp.element.createElement(TextControl, {
												type: "number",
												min: "1",
												value: paddingRight,
												onChange: function onChange(value) {
													return setAttributes({ paddingRight: value });
												}
											}),
											wp.element.createElement(
												"label",
												null,
												"Right"
											)
										)
									)
								)
							)
						),
						wp.element.createElement(
							PanelRow,
							null,
							wp.element.createElement(
								"div",
								{ className: "inspector-field inspector-field-margin" },
								wp.element.createElement(
									"label",
									{ className: "mt10" },
									"Margin"
								),
								wp.element.createElement(
									"div",
									{ className: "margin-setting" },
									wp.element.createElement(
										"div",
										{ className: "col-main-4" },
										wp.element.createElement(
											"div",
											{ className: "padd-top col-main-inner", "data-tooltip": "margin Top" },
											wp.element.createElement(TextControl, {
												type: "number",
												min: "1",
												value: marginTop,
												onChange: function onChange(value) {
													return setAttributes({ marginTop: value });
												}
											}),
											wp.element.createElement(
												"label",
												null,
												"Top"
											)
										),
										wp.element.createElement(
											"div",
											{ className: "padd-buttom col-main-inner", "data-tooltip": "margin Bottom" },
											wp.element.createElement(TextControl, {
												type: "number",
												min: "1",
												value: marginBottom,
												onChange: function onChange(value) {
													return setAttributes({ marginBottom: value });
												}
											}),
											wp.element.createElement(
												"label",
												null,
												"Bottom"
											)
										),
										wp.element.createElement(
											"div",
											{ className: "padd-left col-main-inner", "data-tooltip": "margin Left" },
											wp.element.createElement(TextControl, {
												type: "number",
												min: "1",
												value: marginLeft,
												onChange: function onChange(value) {
													return setAttributes({ marginLeft: value });
												}
											}),
											wp.element.createElement(
												"label",
												null,
												"Left"
											)
										),
										wp.element.createElement(
											"div",
											{ className: "padd-right col-main-inner", "data-tooltip": "margin Right" },
											wp.element.createElement(TextControl, {
												type: "number",
												min: "1",
												value: marginRight,
												onChange: function onChange(value) {
													return setAttributes({ marginRight: value });
												}
											}),
											wp.element.createElement(
												"label",
												null,
												"Right"
											)
										)
									)
								)
							)
						)
					)
				)
			);
		},
		save: function save(_ref2) {
			var attributes = _ref2.attributes,
			    props = _ref2.props;
			var HeadingText = attributes.HeadingText,
			    HeadingLevel = attributes.HeadingLevel,
			    FontSize = attributes.FontSize,
			    marginTop = attributes.marginTop,
			    marginRight = attributes.marginRight,
			    marginBottom = attributes.marginBottom,
			    marginLeft = attributes.marginLeft,
			    paddingTop = attributes.paddingTop,
			    paddingRight = attributes.paddingRight,
			    paddingBottom = attributes.paddingBottom,
			    paddingLeft = attributes.paddingLeft,
			    LineHeight = attributes.LineHeight,
			    LetterSpacing = attributes.LetterSpacing,
			    HeadingColor = attributes.HeadingColor,
			    TextUppercase = attributes.TextUppercase,
			    TextAlign = attributes.TextAlign,
			    fontFamily = attributes.fontFamily,
			    designOpt = attributes.designOpt,
			    backgroundColor = attributes.backgroundColor;


			var HeadingStyle = {};
			FontSize && (HeadingStyle.fontSize = FontSize + 'px');
			HeadingColor && (HeadingStyle.color = HeadingColor);
			LineHeight && (HeadingStyle.lineHeight = LineHeight + "px");
			LetterSpacing && (HeadingStyle.letterSpacing = LetterSpacing + "px");
			TextUppercase && (HeadingStyle.textTransform = TextUppercase);
			marginTop && (HeadingStyle.marginTop = marginTop + 'px');
			marginBottom && (HeadingStyle.marginBottom = marginBottom + 'px');
			marginLeft && (HeadingStyle.marginLeft = marginLeft + 'px');
			marginRight && (HeadingStyle.marginRight = marginRight + 'px');
			paddingTop && (HeadingStyle.paddingTop = paddingTop + 'px');
			paddingBottom && (HeadingStyle.paddingBottom = paddingBottom + 'px');
			paddingLeft && (HeadingStyle.paddingLeft = paddingLeft + 'px');
			paddingRight && (HeadingStyle.paddingRight = paddingRight + 'px');
			TextAlign && (HeadingStyle.textAlign = TextAlign);
			fontFamily && (HeadingStyle.fontFamily = fontFamily);

			var tiltedStyle = {};
			backgroundColor && (tiltedStyle.backgroundColor = backgroundColor);

			return wp.element.createElement(
				Fragment,
				null,
				true === designOpt ? wp.element.createElement(
					"div",
					{ className: "nab-heading", style: tiltedStyle },
					wp.element.createElement(RichText.Content, {
						tagName: HeadingLevel,
						value: HeadingText,
						style: HeadingStyle,
						className: "title nab-title"
					}),
					wp.element.createElement("span", { className: "tilted-design", style: tiltedStyle })
				) : wp.element.createElement(RichText.Content, {
					tagName: HeadingLevel,
					value: HeadingText,
					style: HeadingStyle,
					className: "title nab-title"
				})
			);
		}
	});
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);

/***/ }),
/* 98 */
/***/ (function(module, exports) {

(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
  var __ = wpI18n.__;
  var registerBlockType = wpBlocks.registerBlockType;
  var Fragment = wpElement.Fragment;
  var InspectorControls = wpEditor.InspectorControls,
      MediaUpload = wpEditor.MediaUpload,
      BlockControls = wpEditor.BlockControls,
      URLInputButton = wpEditor.URLInputButton,
      NavigableToolbar = wpEditor.NavigableToolbar;
  var TextControl = wpComponents.TextControl,
      PanelBody = wpComponents.PanelBody,
      PanelRow = wpComponents.PanelRow,
      Button = wpComponents.Button,
      RangeControl = wpComponents.RangeControl,
      ColorPalette = wpComponents.ColorPalette,
      ToggleControl = wpComponents.ToggleControl;


  var imageBlockIcon = wp.element.createElement(
    "svg",
    { width: "150px", height: "150px", viewBox: "222.64 222.641 150 150", "enable-background": "new 222.64 222.641 150 150" },
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M359.307,241.852H235.973c-3.293,0-5.973,2.679-5.973,5.972v99.631c0,3.294,2.679,5.973,5.972,5.973\r h123.334c3.294,0,5.973-2.679,5.973-5.973v-99.631C365.279,244.531,362.601,241.852,359.307,241.852z M359.307,347.455\r l-123.334,0.005c0,0,0-0.002,0-0.005v-99.631h123.334V347.455z" })
      )
    ),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M348.099,256.047H247.181c-1.649,0-2.986,1.337-2.986,2.986v66.002c0,1.648,1.337,2.985,2.986,2.985\r h100.918c1.648,0,2.986-1.337,2.986-2.986v-66.001C351.085,257.384,349.748,256.047,348.099,256.047z M250.167,262.019h94.946\r v50.554l-18.82-18.818c-1.165-1.166-3.056-1.166-4.223,0l-11.473,11.472l-26.305-26.305c-1.166-1.165-3.057-1.166-4.223,0\r l-29.901,29.899L250.167,262.019L250.167,262.019z M250.167,322.048v-4.781l32.013-32.01l36.791,36.791H250.167L250.167,322.048z\r M345.112,322.048h-17.695l0,0l-12.597-12.597l9.361-9.361l20.244,20.242c0.209,0.208,0.44,0.378,0.687,0.512V322.048\r L345.112,322.048z" })
      )
    ),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M310.413,267.686c-6.225,0-11.29,5.064-11.29,11.29c0,6.226,5.065,11.29,11.29,11.29\r c6.226,0,11.29-5.064,11.29-11.29C321.703,272.75,316.638,267.686,310.413,267.686z M310.413,284.292\r c-2.932,0-5.317-2.385-5.317-5.317c0-2.932,2.386-5.317,5.317-5.317s5.317,2.385,5.317,5.317\r C315.73,281.907,313.345,284.292,310.413,284.292z" })
      )
    ),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M273.155,334.752h-25.975c-1.649,0-2.986,1.337-2.986,2.985c0,1.649,1.337,2.986,2.986,2.986h25.975\r c1.649,0,2.986-1.337,2.986-2.986C276.141,336.089,274.805,334.752,273.155,334.752z" })
      )
    ),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M293.594,334.752h-6.813c-1.649,0-2.987,1.337-2.987,2.985c0,1.649,1.338,2.986,2.987,2.986h6.813\r c1.649,0,2.986-1.337,2.986-2.986C296.581,336.089,295.243,334.752,293.594,334.752z" })
      )
    )
  );

  registerBlockType('nab/custom-image', {
    title: __('NABShow - Image'),
    icon: { src: imageBlockIcon },
    description: __('Nab Image is a gutenberg block which used to insert image.'),
    category: 'nabshow',
    keywords: [__('Image'), __('gutenberg')],
    attributes: {
      imageAlt: {
        attribute: 'alt'
      },
      imageUrl: {
        attribute: 'src'
      },
      ImageWidth: {
        type: 'string',
        default: ''
      },
      ImageHeight: {
        type: 'string',
        default: ''
      },
      ImageMaxWidth: {
        type: 'number',
        default: 100
      },
      BorderSize: {
        type: 'number',
        default: 0
      },
      BorderType: {
        type: 'string',
        default: 'solid'
      },
      BorderRadius: {
        type: 'number',
        default: 0
      },
      BorderColor: {
        type: 'string',
        default: '#000'
      },
      marginTop: {
        type: 'string',
        default: '0'
      },
      marginRight: {
        type: 'string',
        default: '0'
      },
      marginBottom: {
        type: 'string',
        default: '0'
      },
      marginLeft: {
        type: 'string',
        default: '0'
      },
      paddingTop: {
        type: 'string',
        default: '0'
      },
      paddingRight: {
        type: 'string',
        default: '0'
      },
      paddingBottom: {
        type: 'string',
        default: '0'
      },
      paddingLeft: {
        type: 'string',
        default: '0'
      },
      InsertUrl: {
        type: 'string',
        default: ''
      },
      ImgAlignment: {
        type: 'string',
        default: 'Left'
      },
      imgLink: {
        type: 'string'
      },
      newWindow: {
        type: 'boolean',
        default: false
      },
      headTag: {
        type: 'boolean',
        default: false
      }
    },
    edit: function edit(_ref) {
      var attributes = _ref.attributes,
          setAttributes = _ref.setAttributes;
      var imageAlt = attributes.imageAlt,
          ImageWidth = attributes.ImageWidth,
          ImageHeight = attributes.ImageHeight,
          BorderSize = attributes.BorderSize,
          BorderType = attributes.BorderType,
          BorderRadius = attributes.BorderRadius,
          BorderColor = attributes.BorderColor,
          marginTop = attributes.marginTop,
          marginRight = attributes.marginRight,
          marginBottom = attributes.marginBottom,
          marginLeft = attributes.marginLeft,
          paddingTop = attributes.paddingTop,
          paddingRight = attributes.paddingRight,
          paddingBottom = attributes.paddingBottom,
          paddingLeft = attributes.paddingLeft,
          InsertUrl = attributes.InsertUrl,
          ImgAlignment = attributes.ImgAlignment,
          imgLink = attributes.imgLink,
          newWindow = attributes.newWindow,
          ImageMaxWidth = attributes.ImageMaxWidth,
          headTag = attributes.headTag;


      var ImageStyle = {};
      ImageWidth && (ImageStyle.width = ImageWidth + "px");
      ImageHeight && (ImageStyle.height = ImageHeight + "px");
      ImageMaxWidth && (ImageStyle.maxWidth = ImageMaxWidth + "%");
      marginTop && (ImageStyle.marginTop = marginTop + "px");
      marginBottom && (ImageStyle.marginBottom = marginBottom + "px");
      marginLeft && (ImageStyle.marginLeft = marginLeft + "px");
      marginRight && (ImageStyle.marginRight = marginRight + "px");
      paddingTop && (ImageStyle.paddingTop = paddingTop + "px");
      paddingBottom && (ImageStyle.paddingBottom = paddingBottom + "px");
      paddingLeft && (ImageStyle.paddingLeft = paddingLeft + "px");
      paddingRight && (ImageStyle.paddingRight = paddingRight + "px");
      BorderSize && (ImageStyle.border = BorderSize + "px " + BorderType + " " + BorderColor);
      BorderRadius && (ImageStyle.borderRadius = BorderRadius + "%");

      var mainStyle = {};
      ImgAlignment && (mainStyle.textAlign = ImgAlignment);

      var getImageButton = function getImageButton(openEvent) {
        if (attributes.imageUrl) {
          return wp.element.createElement(
            "div",
            { className: "nab-image", style: mainStyle },
            headTag ? wp.element.createElement(
              "h1",
              { className: "nab-imageHeading" },
              wp.element.createElement("img", { style: ImageStyle, src: attributes.imageUrl, alt: imageAlt, className: "image" })
            ) : wp.element.createElement("img", { style: ImageStyle, src: attributes.imageUrl, alt: imageAlt, className: "image" })
          );
        } else {
          return wp.element.createElement(
            "div",
            { className: "button-container" },
            wp.element.createElement(
              "label",
              null,
              "Image"
            ),
            wp.element.createElement(
              Button,
              { onClick: openEvent, className: "button button-large" },
              "Pick an image"
            ),
            wp.element.createElement(
              "div",
              { className: "nab-insert-url" },
              wp.element.createElement(
                "form",
                null,
                wp.element.createElement(TextControl, {
                  type: "text",
                  value: InsertUrl,
                  placeholder: "https://",
                  onChange: function onChange(value) {
                    return setAttributes({ InsertUrl: value });
                  }
                }),
                wp.element.createElement(
                  Button,
                  { onClick: InsertUrlFunc, className: "button button-large" },
                  "Insert URL"
                )
              )
            )
          );
        }
      };

      var InsertUrlFunc = function InsertUrlFunc() {
        return setAttributes({ imageUrl: InsertUrl });
      };

      return wp.element.createElement(
        "div",
        null,
        wp.element.createElement(
          BlockControls,
          null,
          wp.element.createElement(
            "div",
            { className: "delete-brick-img" },
            wp.element.createElement("span", {
              onClick: function onClick(value) {
                return setAttributes({ imageUrl: '', imageAlt: '', InsertUrl: '' });
              },
              className: "dashicons dashicons-trash"
            })
          ),
          wp.element.createElement(
            "div",
            { className: "linkBtnBar" },
            wp.element.createElement(URLInputButton, {
              url: imgLink,
              onChange: function onChange(url, post) {
                return setAttributes({ imgLink: url, text: post && post.title || 'Click here' });
              }
            })
          ),
          wp.element.createElement(
            "div",
            { className: "imgblock-edit-img" },
            wp.element.createElement(MediaUpload, {
              onSelect: function onSelect(media) {
                setAttributes({ imageAlt: media.alt, imageUrl: media.url });
              },
              type: "image",
              value: attributes.imageID,
              render: function render(_ref2) {
                var open = _ref2.open;
                return wp.element.createElement("span", { "class": "dashicons dashicons-edit edit-item", onClick: open });
              }
            })
          )
        ),
        wp.element.createElement(MediaUpload, {
          onSelect: function onSelect(media) {
            setAttributes({ imageAlt: media.alt, imageUrl: media.url });
          },
          type: "image",
          value: attributes.imageID,
          render: function render(_ref3) {
            var open = _ref3.open;
            return getImageButton(open);
          }
        }),
        wp.element.createElement(
          InspectorControls,
          null,
          wp.element.createElement(
            PanelBody,
            { title: "General Settings", initialOpen: true },
            wp.element.createElement(
              PanelRow,
              null,
              wp.element.createElement(
                "div",
                { className: "inspector-field-alignment inspector-field altText" },
                wp.element.createElement(
                  "label",
                  null,
                  "Alt Text:"
                ),
                wp.element.createElement(TextControl, {
                  type: "string",
                  value: imageAlt,
                  onChange: function onChange(value) {
                    return setAttributes({ imageAlt: value });
                  }
                })
              )
            ),
            wp.element.createElement(
              PanelRow,
              null,
              wp.element.createElement(ToggleControl, {
                label: __('Add H1 Tag: '),
                checked: headTag,
                onChange: function onChange() {
                  return setAttributes({ headTag: !headTag });
                }
              })
            )
          ),
          wp.element.createElement(
            PanelBody,
            { title: "Dimensions", initialOpen: false },
            wp.element.createElement(
              PanelRow,
              null,
              wp.element.createElement(
                "div",
                { className: "inspector-field inspector-image-width" },
                wp.element.createElement(
                  "label",
                  null,
                  "Width (in px)"
                ),
                wp.element.createElement(RangeControl, {
                  value: ImageWidth,
                  min: 1,
                  max: 1920,
                  onChange: function onChange(ImageWidth) {
                    return setAttributes({ ImageWidth: ImageWidth });
                  }
                })
              )
            ),
            wp.element.createElement(
              PanelRow,
              null,
              wp.element.createElement(
                "div",
                { className: "inspector-field inspector-image-height" },
                wp.element.createElement(
                  "label",
                  null,
                  "Height (in px)"
                ),
                wp.element.createElement(RangeControl, {
                  value: ImageHeight,
                  min: 1,
                  max: 1920,
                  onChange: function onChange(ImageHeight) {
                    return setAttributes({ ImageHeight: ImageHeight });
                  }
                })
              )
            ),
            wp.element.createElement(
              PanelRow,
              null,
              wp.element.createElement(
                "div",
                { className: "inspector-field inspector-image-width" },
                wp.element.createElement(
                  "label",
                  null,
                  "Max Width (in %)"
                ),
                wp.element.createElement(RangeControl, {
                  value: ImageMaxWidth,
                  min: 1,
                  max: 100,
                  onChange: function onChange(ImageMaxWidth) {
                    return setAttributes({ ImageMaxWidth: ImageMaxWidth });
                  }
                })
              )
            ),
            wp.element.createElement(
              PanelRow,
              null,
              wp.element.createElement(
                "div",
                { className: "inspector-field-alignment inspector-field inspector-responsive" },
                wp.element.createElement(
                  "label",
                  null,
                  "Image Alignment"
                ),
                wp.element.createElement(
                  "div",
                  { className: "inspector-field-button-list inspector-field-button-list-fluid" },
                  wp.element.createElement(
                    "button",
                    { className: 'left' === ImgAlignment ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
                        return setAttributes({ ImgAlignment: 'left' });
                      } },
                    wp.element.createElement(
                      "svg",
                      { width: "21", height: "18", viewBox: "0 0 21 18", xmlns: "http://www.w3.org/2000/svg" },
                      wp.element.createElement(
                        "g",
                        { transform: "translate(-29 -4) translate(29 4)", fill: "none" },
                        wp.element.createElement("path", { d: "M1 .708v15.851", className: "inspector-svg-stroke", "stroke-linecap": "square" }),
                        wp.element.createElement("rect", { className: "inspector-svg-fill", x: "5", y: "5", width: "16", height: "7", rx: "1" })
                      )
                    )
                  ),
                  wp.element.createElement(
                    "button",
                    { className: 'center' === ImgAlignment ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
                        return setAttributes({ ImgAlignment: 'center' });
                      } },
                    wp.element.createElement(
                      "svg",
                      { width: "16", height: "18", viewBox: "0 0 16 18", xmlns: "http://www.w3.org/2000/svg" },
                      wp.element.createElement(
                        "g",
                        { transform: "translate(-115 -4) translate(115 4)", fill: "none" },
                        wp.element.createElement("path", { d: "M8 .708v15.851", className: "inspector-svg-stroke", "stroke-linecap": "square" }),
                        wp.element.createElement("rect", { className: "inspector-svg-fill", y: "5", width: "16", height: "7", rx: "1" })
                      )
                    )
                  ),
                  wp.element.createElement(
                    "button",
                    { className: 'Right' === ImgAlignment ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
                        return setAttributes({ ImgAlignment: 'Right' });
                      } },
                    wp.element.createElement(
                      "svg",
                      { width: "21", height: "18", viewBox: "0 0 21 18", xmlns: "http://www.w3.org/2000/svg" },
                      wp.element.createElement(
                        "g",
                        { transform: "translate(0 1) rotate(-180 10.5 8.5)", fill: "none" },
                        wp.element.createElement("path", { d: "M1 .708v15.851", className: "inspector-svg-stroke", "stroke-linecap": "square" }),
                        wp.element.createElement("rect", { className: "inspector-svg-fill", "fill-rule": "nonzero", x: "5", y: "5", width: "16", height: "7", rx: "1" })
                      )
                    )
                  )
                )
              )
            )
          ),
          wp.element.createElement(
            PanelBody,
            { title: "Design", initialOpen: false },
            wp.element.createElement(
              PanelRow,
              null,
              wp.element.createElement(
                "div",
                { className: "inspector-field inspector-border-style" },
                wp.element.createElement(
                  "label",
                  null,
                  "Border Style"
                ),
                wp.element.createElement(
                  "div",
                  { className: "inspector-field-button-list inspector-field-button-list-fluid" },
                  wp.element.createElement(
                    "button",
                    { className: 'solid' === BorderType ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
                        return setAttributes({ BorderType: 'solid' });
                      } },
                    wp.element.createElement("span", { className: "inspector-field-border-type inspector-field-border-type-solid" })
                  ),
                  wp.element.createElement(
                    "button",
                    { className: 'dotted' === BorderType ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
                        return setAttributes({ BorderType: 'dotted' });
                      } },
                    wp.element.createElement("span", { className: "inspector-field-border-type inspector-field-border-type-dotted" })
                  ),
                  wp.element.createElement(
                    "button",
                    { className: 'dashed' === BorderType ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
                        return setAttributes({ BorderType: 'dashed' });
                      } },
                    wp.element.createElement("span", { className: "inspector-field-border-type inspector-field-border-type-dashed" })
                  ),
                  wp.element.createElement(
                    "button",
                    { className: 'double' === BorderType ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
                        return setAttributes({ BorderType: 'double' });
                      } },
                    wp.element.createElement("span", { className: "inspector-field-border-type inspector-field-border-type-double" })
                  ),
                  wp.element.createElement(
                    "button",
                    { className: 'none' === BorderType ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
                        return setAttributes({ BorderType: 'none' });
                      } },
                    wp.element.createElement("i", { className: "fa fa-ban" })
                  )
                )
              )
            ),
            wp.element.createElement(
              PanelRow,
              null,
              wp.element.createElement(
                "div",
                { className: "inspector-field inspector-border-width" },
                wp.element.createElement(
                  "label",
                  null,
                  "Border Width"
                ),
                wp.element.createElement(RangeControl, {
                  value: BorderSize,
                  min: 1,
                  onChange: function onChange(BorderSize) {
                    return setAttributes({ BorderSize: BorderSize });
                  }
                })
              )
            ),
            wp.element.createElement(
              PanelRow,
              null,
              wp.element.createElement(
                "div",
                { className: "inspector-field inspector-border-radius" },
                wp.element.createElement(
                  "label",
                  null,
                  "Border radius"
                ),
                wp.element.createElement(RangeControl, {
                  value: BorderRadius,
                  min: 1,
                  onChange: function onChange(BorderRadius) {
                    return setAttributes({ BorderRadius: BorderRadius });
                  }
                })
              )
            ),
            wp.element.createElement(
              PanelRow,
              null,
              wp.element.createElement(
                "div",
                { className: "inspector-field inspector-field-color " },
                wp.element.createElement(
                  "label",
                  { className: "inspector-mb-0" },
                  "Color"
                ),
                wp.element.createElement(
                  "div",
                  { className: "inspector-ml-auto" },
                  wp.element.createElement(ColorPalette, {
                    value: BorderColor,
                    onChange: function onChange(BorderColor) {
                      return setAttributes({ BorderColor: BorderColor });
                    }
                  })
                )
              )
            )
          ),
          wp.element.createElement(
            PanelBody,
            { title: "Spacing", initialOpen: false },
            wp.element.createElement(
              PanelRow,
              null,
              wp.element.createElement(
                "div",
                { className: "inspector-field inspector-field-padding" },
                wp.element.createElement(
                  "label",
                  { className: "mt10" },
                  "Padding"
                ),
                wp.element.createElement(
                  "div",
                  { className: "padding-setting" },
                  wp.element.createElement(
                    "div",
                    { className: "col-main-4" },
                    wp.element.createElement(
                      "div",
                      { className: "padd-top col-main-inner", "data-tooltip": "padding Top" },
                      wp.element.createElement(TextControl, {
                        type: "number",
                        min: "1",
                        value: paddingTop,
                        onChange: function onChange(value) {
                          return setAttributes({ paddingTop: value });
                        }
                      }),
                      wp.element.createElement(
                        "label",
                        null,
                        "Top"
                      )
                    ),
                    wp.element.createElement(
                      "div",
                      { className: "padd-buttom col-main-inner", "data-tooltip": "padding Bottom" },
                      wp.element.createElement(TextControl, {
                        type: "number",
                        min: "1",
                        value: paddingBottom,
                        onChange: function onChange(value) {
                          return setAttributes({ paddingBottom: value });
                        }
                      }),
                      wp.element.createElement(
                        "label",
                        null,
                        "Bottom"
                      )
                    ),
                    wp.element.createElement(
                      "div",
                      { className: "padd-left col-main-inner", "data-tooltip": "padding Left" },
                      wp.element.createElement(TextControl, {
                        type: "number",
                        min: "1",
                        value: paddingLeft,
                        onChange: function onChange(value) {
                          return setAttributes({ paddingLeft: value });
                        }
                      }),
                      wp.element.createElement(
                        "label",
                        null,
                        "Left"
                      )
                    ),
                    wp.element.createElement(
                      "div",
                      { className: "padd-right col-main-inner", "data-tooltip": "padding Right" },
                      wp.element.createElement(TextControl, {
                        type: "number",
                        min: "1",
                        value: paddingRight,
                        onChange: function onChange(value) {
                          return setAttributes({ paddingRight: value });
                        }
                      }),
                      wp.element.createElement(
                        "label",
                        null,
                        "Right"
                      )
                    )
                  )
                )
              )
            ),
            wp.element.createElement(
              PanelRow,
              null,
              wp.element.createElement(
                "div",
                { className: "inspector-field inspector-field-margin" },
                wp.element.createElement(
                  "label",
                  { className: "mt10" },
                  "Margin"
                ),
                wp.element.createElement(
                  "div",
                  { className: "margin-setting" },
                  wp.element.createElement(
                    "div",
                    { className: "col-main-4" },
                    wp.element.createElement(
                      "div",
                      { className: "padd-top col-main-inner", "data-tooltip": "margin Top" },
                      wp.element.createElement(TextControl, {
                        type: "number",
                        min: "1",
                        value: marginTop,
                        onChange: function onChange(value) {
                          return setAttributes({ marginTop: value });
                        }
                      }),
                      wp.element.createElement(
                        "label",
                        null,
                        "Top"
                      )
                    ),
                    wp.element.createElement(
                      "div",
                      { className: "padd-buttom col-main-inner", "data-tooltip": "margin Bottom" },
                      wp.element.createElement(TextControl, {
                        type: "number",
                        min: "1",
                        value: marginBottom,
                        onChange: function onChange(value) {
                          return setAttributes({ marginBottom: value });
                        }
                      }),
                      wp.element.createElement(
                        "label",
                        null,
                        "Bottom"
                      )
                    ),
                    wp.element.createElement(
                      "div",
                      { className: "padd-left col-main-inner", "data-tooltip": "margin Left" },
                      wp.element.createElement(TextControl, {
                        type: "number",
                        min: "1",
                        value: marginLeft,
                        onChange: function onChange(value) {
                          return setAttributes({ marginLeft: value });
                        }
                      }),
                      wp.element.createElement(
                        "label",
                        null,
                        "Left"
                      )
                    ),
                    wp.element.createElement(
                      "div",
                      { className: "padd-right col-main-inner", "data-tooltip": "margin Right" },
                      wp.element.createElement(TextControl, {
                        type: "number",
                        min: "1",
                        value: marginRight,
                        onChange: function onChange(value) {
                          return setAttributes({ marginRight: value });
                        }
                      }),
                      wp.element.createElement(
                        "label",
                        null,
                        "Right"
                      )
                    )
                  )
                )
              )
            )
          ),
          wp.element.createElement(
            PanelBody,
            { title: __('Link'), initialOpen: false },
            wp.element.createElement(
              PanelRow,
              null,
              wp.element.createElement(TextControl, {
                type: "text",
                placeholder: "https:",
                value: imgLink,
                onChange: function onChange(value) {
                  return setAttributes({ imgLink: value });
                }
              })
            ),
            imgLink && wp.element.createElement(
              PanelRow,
              null,
              wp.element.createElement(ToggleControl, {
                label: __('Open New Tab'),
                checked: newWindow,
                onChange: function onChange() {
                  return setAttributes({ newWindow: !newWindow });
                }
              })
            )
          )
        )
      );
    },
    save: function save(_ref4) {
      var attributes = _ref4.attributes;
      var imageAlt = attributes.imageAlt,
          imageUrl = attributes.imageUrl,
          ImageWidth = attributes.ImageWidth,
          ImageHeight = attributes.ImageHeight,
          BorderSize = attributes.BorderSize,
          BorderType = attributes.BorderType,
          BorderRadius = attributes.BorderRadius,
          BorderColor = attributes.BorderColor,
          marginTop = attributes.marginTop,
          marginRight = attributes.marginRight,
          marginBottom = attributes.marginBottom,
          marginLeft = attributes.marginLeft,
          paddingTop = attributes.paddingTop,
          paddingRight = attributes.paddingRight,
          paddingBottom = attributes.paddingBottom,
          paddingLeft = attributes.paddingLeft,
          ImgAlignment = attributes.ImgAlignment,
          imgLink = attributes.imgLink,
          newWindow = attributes.newWindow,
          ImageMaxWidth = attributes.ImageMaxWidth,
          headTag = attributes.headTag;


      var ImageStyle = {};
      ImageWidth && (ImageStyle.width = ImageWidth + "px");
      ImageHeight && (ImageStyle.height = ImageHeight + "px");
      ImageMaxWidth && (ImageStyle.maxWidth = ImageMaxWidth + "%");
      marginTop && (ImageStyle.marginTop = marginTop + "px");
      marginBottom && (ImageStyle.marginBottom = marginBottom + "px");
      marginLeft && (ImageStyle.marginLeft = marginLeft + "px");
      marginRight && (ImageStyle.marginRight = marginRight + "px");
      paddingTop && (ImageStyle.paddingTop = paddingTop + "px");
      paddingBottom && (ImageStyle.paddingBottom = paddingBottom + "px");
      paddingLeft && (ImageStyle.paddingLeft = paddingLeft + "px");
      paddingRight && (ImageStyle.paddingRight = paddingRight + "px");
      BorderSize && (ImageStyle.border = BorderSize + "px " + BorderType + " " + BorderColor);
      BorderRadius && (ImageStyle.borderRadius = BorderRadius + "%");

      var mainStyle = {};
      ImgAlignment && (mainStyle.textAlign = ImgAlignment);

      return wp.element.createElement(
        "div",
        { className: "nab-image", style: mainStyle },
        headTag ? wp.element.createElement(
          Fragment,
          null,
          wp.element.createElement(
            "h1",
            { className: "nab-imageHeading" },
            imgLink ? wp.element.createElement(
              "a",
              { href: imgLink, target: newWindow ? '_blank' : '_self', rel: "noopener noreferrer" },
              wp.element.createElement("img", { style: ImageStyle, src: imageUrl, alt: imageAlt })
            ) : wp.element.createElement("img", { style: ImageStyle, src: imageUrl, alt: imageAlt })
          )
        ) : wp.element.createElement(
          Fragment,
          null,
          imgLink ? wp.element.createElement(
            "a",
            { href: imgLink, target: newWindow ? '_blank' : '_self', rel: "noopener noreferrer" },
            wp.element.createElement("img", { style: ImageStyle, src: imageUrl, alt: imageAlt })
          ) : wp.element.createElement("img", { style: ImageStyle, src: imageUrl, alt: imageAlt })
        )
      );
    }
  });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);

/***/ }),
/* 99 */
/***/ (function(module, exports) {

(function (wpI18n, wpBlocks, wpEditor, wpComponents) {
	var __ = wpI18n.__;
	var registerBlockType = wpBlocks.registerBlockType;
	var InspectorControls = wpEditor.InspectorControls,
	    InnerBlocks = wpEditor.InnerBlocks,
	    MediaUpload = wpEditor.MediaUpload,
	    BlockControls = wpEditor.BlockControls;
	var TextControl = wpComponents.TextControl,
	    PanelBody = wpComponents.PanelBody,
	    PanelRow = wpComponents.PanelRow,
	    Toolbar = wpComponents.Toolbar,
	    IconButton = wpComponents.IconButton,
	    Button = wpComponents.Button,
	    ToggleControl = wpComponents.ToggleControl,
	    RangeControl = wpComponents.RangeControl,
	    ColorPalette = wpComponents.ColorPalette;


	var imageWithTextBlockIcon = wp.element.createElement(
		"svg",
		{ width: "150px", height: "150px", viewBox: "418.4 418.4 150 150", "enable-background": "new 418.4 418.4 150 150" },
		wp.element.createElement(
			"g",
			null,
			wp.element.createElement("path", { fill: "#0F6CB6", d: "M544.93,449.158h-38.933c-2.975,0-5.383,2.409-5.383,5.383s2.408,5.383,5.383,5.383h38.933\r c2.975,0,5.384-2.409,5.384-5.383S547.904,449.158,544.93,449.158z" }),
			wp.element.createElement("path", { fill: "#0F6CB6", d: "M505.997,498.44h26.014c2.975,0,5.383-2.409,5.383-5.383c0-2.975-2.408-5.383-5.383-5.383h-26.014\r c-2.975,0-5.383,2.409-5.383,5.383C500.614,496.031,503.022,498.44,505.997,498.44z" }),
			wp.element.createElement("path", { fill: "#0F6CB6", d: "M554.418,468.416h-48.421c-2.975,0-5.383,2.409-5.383,5.383s2.408,5.383,5.383,5.383h48.421\r c2.974,0,5.383-2.409,5.383-5.383S557.392,468.416,554.418,468.416z" }),
			wp.element.createElement("path", { fill: "#0F6CB6", d: "M554.418,506.945h-48.421c-2.975,0-5.383,2.409-5.383,5.384c0,2.974,2.408,5.383,5.383,5.383h48.421\r c2.974,0,5.383-2.409,5.383-5.383C559.801,509.354,557.392,506.945,554.418,506.945z" }),
			wp.element.createElement("path", { fill: "#0F6CB6", d: "M554.418,526.203h-48.421c-2.975,0-5.383,2.409-5.383,5.384c0,2.974,2.408,5.383,5.383,5.383h48.421\r c2.974,0,5.383-2.409,5.383-5.383C559.801,528.612,557.392,526.203,554.418,526.203z" }),
			wp.element.createElement("path", { fill: "#0F6CB6", d: "M482.769,448.566h-47.694c-4.455,0-8.075,3.62-8.075,8.075v73.52c0,4.455,3.62,8.074,8.075,8.074h47.694\r c4.455,0,8.075-3.619,8.075-8.074v-73.52C490.843,452.173,487.237,448.566,482.769,448.566z" })
		)
	);

	registerBlockType('nab/image-with-text', {
		title: __('Image & Text'),
		icon: { src: imageWithTextBlockIcon },
		description: __('Nab Image & Text is a gutenberg block where you can add media along with text.'),
		category: 'nabshow',
		keywords: [__('Media'), __('Text')],
		attributes: {
			LeftWidth: {
				type: 'number',
				default: 50
			},
			imageAlt: {
				attribute: 'alt'
			},
			imageUrl: {
				attribute: 'src'
			},
			ColumnAlignment: {
				type: 'string',
				default: 'center'
			},
			Imagelignment: {
				type: 'string',
				default: 'center'
			},
			paddingTop: {
				type: 'string',
				default: '20'
			},
			paddingRight: {
				type: 'string',
				default: '20'
			},
			paddingBottom: {
				type: 'string',
				default: '20'
			},
			paddingLeft: {
				type: 'string',
				default: '20'
			},
			FullImage: {
				type: 'boolean',
				default: true
			},
			postImage: {
				type: 'boolean',
				default: false
			},
			imgID: {
				type: 'number'
			},
			BoxAlign: {
				type: 'string',
				default: '1'
			},
			BackgroundColor: { type: 'string' },
			InsertUrl: {
				type: 'string',
				default: ''
			}
		},

		edit: function edit(_ref) {
			var attributes = _ref.attributes,
			    setAttributes = _ref.setAttributes;
			var LeftWidth = attributes.LeftWidth,
			    imageAlt = attributes.imageAlt,
			    imageUrl = attributes.imageUrl,
			    ColumnAlignment = attributes.ColumnAlignment,
			    paddingTop = attributes.paddingTop,
			    paddingRight = attributes.paddingRight,
			    paddingBottom = attributes.paddingBottom,
			    paddingLeft = attributes.paddingLeft,
			    Imagelignment = attributes.Imagelignment,
			    FullImage = attributes.FullImage,
			    postImage = attributes.postImage,
			    BoxAlign = attributes.BoxAlign,
			    BackgroundColor = attributes.BackgroundColor,
			    InsertUrl = attributes.InsertUrl,
			    imgID = attributes.imgID;


			var getImageButton = function getImageButton(openEvent) {
				if (imageUrl) {
					return wp.element.createElement("img", { src: imageUrl, alr: imageAlt, style: ImageStyle, className: "image" });
				} else {
					return wp.element.createElement(
						"div",
						{ className: "button-container" },
						wp.element.createElement(
							Button,
							{ onClick: openEvent, className: "button button-large" },
							"Pick an image"
						),
						wp.element.createElement(
							"div",
							{ className: "nab-insert-url" },
							wp.element.createElement(
								"form",
								null,
								wp.element.createElement(TextControl, {
									type: "text",
									value: InsertUrl,
									placeholder: "https://",
									onChange: function onChange(value) {
										return setAttributes({ InsertUrl: value });
									}
								}),
								wp.element.createElement(
									Button,
									{ onClick: InsertUrlFunc, className: "button button-large" },
									"Insert URL"
								)
							)
						)
					);
				}
			};

			var InsertUrlFunc = function InsertUrlFunc() {
				return setAttributes({ imageUrl: InsertUrl });
			};

			var MainStyle = {};
			ColumnAlignment && (MainStyle.alignItems = "" + ColumnAlignment);
			BackgroundColor && (MainStyle.background = BackgroundColor);

			var LeftColumnStyle = {};
			LeftWidth && (LeftColumnStyle.width = LeftWidth + "%");
			Imagelignment && (LeftColumnStyle.textAlign = "" + Imagelignment);
			BoxAlign && (LeftColumnStyle.order = "" + BoxAlign);

			var RightWidth = [100 - LeftWidth];

			var RightColumnStyle = {};
			LeftWidth && (RightColumnStyle.width = RightWidth + "%");
			paddingTop && (RightColumnStyle.paddingTop = paddingTop + "px");
			paddingBottom && (RightColumnStyle.paddingBottom = paddingBottom + "px");
			paddingLeft && (RightColumnStyle.paddingLeft = paddingLeft + "px");
			paddingRight && (RightColumnStyle.paddingRight = paddingRight + "px");

			var ImageStyle = {};
			FullImage && (ImageStyle.width = '100%');
			FullImage && (ImageStyle.height = '100%');

			return wp.element.createElement(
				"div",
				{ className: "media-with-text-main", style: MainStyle },
				wp.element.createElement(
					"div",
					{ className: "media-with-text-main-column left-side", style: LeftColumnStyle },
					wp.element.createElement(
						BlockControls,
						null,
						wp.element.createElement(
							Toolbar,
							null,
							wp.element.createElement(MediaUpload, {
								value: imgID,
								onSelect: function onSelect(media) {
									return setAttributes({ imageAlt: media.alt, imageUrl: media.url, imgID: media.id });
								},
								render: function render(_ref2) {
									var open = _ref2.open;
									return wp.element.createElement(IconButton, {
										className: "components-toolbar__control",
										label: __('Change image'),
										icon: "edit",
										onClick: open
									});
								}
							})
						)
					),
					wp.element.createElement(MediaUpload, {
						onSelect: function onSelect(media) {
							setAttributes({ imageAlt: media.alt, imageUrl: media.url, imgID: media.id });
						},
						type: "image",
						value: imgID,
						render: function render(_ref3) {
							var open = _ref3.open;
							return getImageButton(open);
						}
					})
				),
				wp.element.createElement(
					"div",
					{ className: "media-with-text-main-column right-side", style: RightColumnStyle },
					wp.element.createElement(InnerBlocks, null)
				),
				wp.element.createElement(
					InspectorControls,
					null,
					wp.element.createElement(
						PanelBody,
						{ title: "General Setting", initialOpen: false },
						wp.element.createElement(
							PanelRow,
							null,
							wp.element.createElement(
								"div",
								{ className: "col-main-2 media-with-text-align" },
								wp.element.createElement(
									"div",
									{ className: "col-main-inner" },
									wp.element.createElement("span", {
										className: '1' === BoxAlign ? 'dashicons dashicons-align-left active' : 'dashicons dashicons-align-left',
										onClick: function onClick() {
											return setAttributes({ BoxAlign: '1' });
										}
									})
								),
								wp.element.createElement(
									"div",
									{ className: "col-main-inner" },
									wp.element.createElement("span", {
										className: '2' === BoxAlign ? 'dashicons dashicons-align-right active' : 'dashicons dashicons-align-right',
										onClick: function onClick() {
											return setAttributes({ BoxAlign: '2' });
										}
									})
								)
							)
						),
						wp.element.createElement(
							PanelRow,
							null,
							wp.element.createElement(
								"div",
								{ className: "inspector-field-alignment inspector-field inspector-responsive inspector-bottom-20" },
								wp.element.createElement(
									"label",
									null,
									"Column  Alignment"
								),
								wp.element.createElement(
									"div",
									{ className: "inspector-field-button-list inspector-field-button-list-fluid" },
									wp.element.createElement(
										"button",
										{ className: 'flex-start' === ColumnAlignment ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
												return setAttributes({ ColumnAlignment: 'flex-start' });
											} },
										wp.element.createElement(
											"svg",
											{ width: "16", height: "16", viewBox: "0 0 16 16", xmlns: "http://www.w3.org/2000/svg" },
											wp.element.createElement(
												"g",
												{ transform: "translate(1)", fill: "none" },
												wp.element.createElement("rect", { className: "inspector-svg-fill", x: "4", y: "4", width: "6", height: "12", rx: "1" }),
												wp.element.createElement("path", { className: "inspector-svg-stroke", d: "M0 1h14", "stroke-width": "2", "stroke-linecap": "square" })
											)
										)
									),
									wp.element.createElement(
										"button",
										{ className: 'center' === ColumnAlignment ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
												return setAttributes({ ColumnAlignment: 'center' });
											} },
										wp.element.createElement(
											"svg",
											{ width: "16", height: "18", viewBox: "0 0 16 18", xmlns: "http://www.w3.org/2000/svg" },
											wp.element.createElement(
												"g",
												{ transform: "translate(-115 -4) translate(115 4)", fill: "none" },
												wp.element.createElement("path", { d: "M8 .708v15.851", className: "inspector-svg-stroke", "stroke-linecap": "square" }),
												wp.element.createElement("rect", { className: "inspector-svg-fill", y: "5", width: "16", height: "7", rx: "1" })
											)
										)
									),
									wp.element.createElement(
										"button",
										{ className: 'flex-end' === ColumnAlignment ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
												return setAttributes({ ColumnAlignment: 'flex-end' });
											} },
										wp.element.createElement(
											"svg",
											{ width: "16", height: "16", viewBox: "0 0 16 16", xmlns: "http://www.w3.org/2000/svg" },
											wp.element.createElement(
												"g",
												{ transform: "translate(1)", fill: "none" },
												wp.element.createElement("rect", { className: "inspector-svg-fill", x: "4", width: "6", height: "12", rx: "1" }),
												wp.element.createElement("path", { d: "M0 15h14", className: "inspector-svg-stroke", "stroke-width": "2", "stroke-linecap": "square" })
											)
										)
									)
								)
							)
						),
						wp.element.createElement(
							PanelRow,
							null,
							wp.element.createElement(
								"div",
								{ className: "inspector-field inspector-field-color " },
								wp.element.createElement(
									"label",
									{ className: "inspector-mb-0" },
									"Background Color"
								),
								wp.element.createElement(
									"div",
									{ className: "inspector-ml-auto" },
									wp.element.createElement(ColorPalette, {
										value: BackgroundColor,
										onChange: function onChange(BackgroundColor) {
											return setAttributes({ BackgroundColor: BackgroundColor });
										}
									})
								)
							)
						)
					),
					wp.element.createElement(
						PanelBody,
						{ title: "Image Setting", initialOpen: false },
						wp.element.createElement(
							"label",
							null,
							"Media Box Width"
						),
						wp.element.createElement(
							PanelRow,
							null,
							wp.element.createElement(RangeControl, {
								value: LeftWidth,
								min: "1",
								max: "100",
								step: "1",
								onChange: function onChange(value) {
									return setAttributes({ LeftWidth: value });
								}
							})
						),
						wp.element.createElement(
							PanelRow,
							null,
							wp.element.createElement(ToggleControl, {
								label: __('Change Image Size'),
								checked: FullImage,
								onChange: function onChange() {
									return setAttributes({ FullImage: !FullImage });
								}
							})
						),
						0 !== wp.data.select('core/editor').getEditedPostAttribute('featured_media') && wp.element.createElement(
							PanelRow,
							null,
							wp.element.createElement(ToggleControl, {
								label: __('Post Featured Image'),
								checked: postImage,
								onChange: function onChange(postImg) {
									setAttributes({ postImage: postImg });
									if (postImg) {
										var postImgURL = void 0,
										    postImgAlt = wp.data.select('core').getMedia(wp.data.select('core/editor').getEditedPostAttribute('featured_media')).alt_text,
										    postImgId = wp.data.select('core').getMedia(wp.data.select('core/editor').getEditedPostAttribute('featured_media')).id;

										if (wp.data.select('core').getMedia(wp.data.select('core/editor').getEditedPostAttribute('featured_media')).media_details.sizes.medium) {
											postImgURL = wp.data.select('core').getMedia(wp.data.select('core/editor').getEditedPostAttribute('featured_media')).media_details.sizes.medium.source_url;
										} else if (wp.data.select('core').getMedia(wp.data.select('core/editor').getEditedPostAttribute('featured_media')).source_url) {
											postImgURL = wp.data.select('core').getMedia(wp.data.select('core/editor').getEditedPostAttribute('featured_media')).source_url;
										}
										setAttributes({ imageAlt: postImgAlt, imageUrl: postImgURL, imgID: postImgId });
									}
								}
							})
						)
					),
					wp.element.createElement(
						PanelBody,
						{ title: "Content Box Spacing", initialOpen: false },
						wp.element.createElement(
							PanelRow,
							null,
							wp.element.createElement(
								"div",
								{ className: "inspector-field inspector-field-padding" },
								wp.element.createElement(
									"label",
									{ className: "mt10" },
									"Padding"
								),
								wp.element.createElement(
									"div",
									{ className: "padding-setting" },
									wp.element.createElement(
										"div",
										{ className: "col-main-4" },
										wp.element.createElement(
											"div",
											{ className: "padd-top col-main-inner", "data-tooltip": "padding Top" },
											wp.element.createElement(TextControl, {
												type: "number",
												min: "1",
												value: paddingTop,
												onChange: function onChange(value) {
													return setAttributes({ paddingTop: value });
												}
											}),
											wp.element.createElement(
												"label",
												null,
												"Top"
											)
										),
										wp.element.createElement(
											"div",
											{ className: "padd-buttom col-main-inner", "data-tooltip": "padding Bottom" },
											wp.element.createElement(TextControl, {
												type: "number",
												min: "1",
												value: paddingBottom,
												onChange: function onChange(value) {
													return setAttributes({ paddingBottom: value });
												}
											}),
											wp.element.createElement(
												"label",
												null,
												"Bottom"
											)
										),
										wp.element.createElement(
											"div",
											{ className: "padd-left col-main-inner", "data-tooltip": "padding Left" },
											wp.element.createElement(TextControl, {
												type: "number",
												min: "1",
												value: paddingLeft,
												onChange: function onChange(value) {
													return setAttributes({ paddingLeft: value });
												}
											}),
											wp.element.createElement(
												"label",
												null,
												"Left"
											)
										),
										wp.element.createElement(
											"div",
											{ className: "padd-right col-main-inner", "data-tooltip": "padding Right" },
											wp.element.createElement(TextControl, {
												type: "number",
												min: "1",
												value: paddingRight,
												onChange: function onChange(value) {
													return setAttributes({ paddingRight: value });
												}
											}),
											wp.element.createElement(
												"label",
												null,
												"Right"
											)
										)
									)
								)
							)
						)
					)
				)
			);
		},
		save: function save(_ref4) {
			var attributes = _ref4.attributes;
			var LeftWidth = attributes.LeftWidth,
			    imageAlt = attributes.imageAlt,
			    imageUrl = attributes.imageUrl,
			    ColumnAlignment = attributes.ColumnAlignment,
			    paddingTop = attributes.paddingTop,
			    paddingRight = attributes.paddingRight,
			    paddingBottom = attributes.paddingBottom,
			    paddingLeft = attributes.paddingLeft,
			    Imagelignment = attributes.Imagelignment,
			    FullImage = attributes.FullImage,
			    BoxAlign = attributes.BoxAlign,
			    BackgroundColor = attributes.BackgroundColor;


			var MainStyle = {};
			ColumnAlignment && (MainStyle.alignItems = "" + ColumnAlignment);
			BackgroundColor && (MainStyle.background = BackgroundColor);

			var LeftColumnStyle = {};
			LeftWidth && (LeftColumnStyle.width = LeftWidth + "%");
			Imagelignment && (LeftColumnStyle.textAlign = "" + Imagelignment);
			BoxAlign && (LeftColumnStyle.order = "" + BoxAlign);

			var RightWidth = [100 - LeftWidth];

			var RightColumnStyle = {};
			LeftWidth && (RightColumnStyle.width = RightWidth + "%");
			paddingTop && (RightColumnStyle.paddingTop = paddingTop + "px");
			paddingBottom && (RightColumnStyle.paddingBottom = paddingBottom + "px");
			paddingLeft && (RightColumnStyle.paddingLeft = paddingLeft + "px");
			paddingRight && (RightColumnStyle.paddingRight = paddingRight + "px");

			var ImageStyle = {};
			FullImage && (ImageStyle.width = '100%');
			FullImage && (ImageStyle.height = '100%');

			return wp.element.createElement(
				"div",
				{ className: "media-with-text-main", style: MainStyle },
				wp.element.createElement(
					"div",
					{ className: "media-with-text-main-column left-side", style: LeftColumnStyle },
					wp.element.createElement("img", { src: imageUrl, alt: imageAlt, style: ImageStyle })
				),
				wp.element.createElement(
					"div",
					{ className: "media-with-text-main-column right-side", style: RightColumnStyle },
					wp.element.createElement(InnerBlocks.Content, null)
				)
			);
		}
	});
})(wp.i18n, wp.blocks, wp.editor, wp.components);

/***/ }),
/* 100 */
/***/ (function(module, exports) {

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _toConsumableArray(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } else { return Array.from(arr); } }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
  var __ = wpI18n.__;
  var registerBlockType = wpBlocks.registerBlockType;
  var Fragment = wpElement.Fragment,
      Component = wpElement.Component;
  var RichText = wpEditor.RichText,
      InspectorControls = wpEditor.InspectorControls;
  var PanelBody = wpComponents.PanelBody,
      PanelRow = wpComponents.PanelRow,
      ToggleControl = wpComponents.ToggleControl,
      Tooltip = wpComponents.Tooltip,
      DropdownMenu = wpComponents.DropdownMenu,
      MenuGroup = wpComponents.MenuGroup,
      MenuItem = wpComponents.MenuItem,
      CheckboxControl = wpComponents.CheckboxControl;


  var scheduleBlockIcon = wp.element.createElement(
    "svg",
    {
      width: "150px",
      height: "150px",
      viewBox: "181 181 150 150",
      "enable-background": "new 181 181 150 150"
    },
    wp.element.createElement("path", {
      fill: "#0F6CB6",
      d: "M186.837,288.539c1.152,0,2.087-0.932,2.087-2.086v-60.797h123.331v22.945c0,1.153,0.936,2.087,2.088,2.087\r c1.154,0,2.087-0.934,2.087-2.087v-41.253c0-6.998-5.693-12.692-12.689-12.692h-5.474v-2.585c0-2.796-2.275-5.07-5.072-5.07h-3.878\r c-2.795,0-5.069,2.274-5.069,5.07v2.586h-13.844v-2.586c0-2.796-2.274-5.07-5.07-5.07h-3.878c-2.796,0-5.07,2.274-5.07,5.07v2.586\r h-13.846v-2.586c0-2.796-2.274-5.07-5.07-5.07h-3.877c-2.796,0-5.07,2.274-5.07,5.07v2.586h-13.844v-2.586\r c0-2.796-2.274-5.07-5.07-5.07h-3.877c-2.796,0-5.07,2.274-5.07,5.07v2.586h-3.218c-6.999,0-12.692,5.693-12.692,12.691v79.105\r C184.75,287.607,185.685,288.539,186.837,288.539z M288.423,192.07c0-0.493,0.402-0.896,0.896-0.896h3.878\r c0.493,0,0.896,0.402,0.896,0.896v10.142c0,0.494-0.401,0.896-0.896,0.896h-3.878c-0.494,0-0.896-0.401-0.896-0.896V192.07z\r M260.561,192.07c0-0.493,0.401-0.896,0.896-0.896h3.878c0.493,0,0.896,0.402,0.896,0.896v10.142c0,0.494-0.402,0.896-0.896,0.896\r h-3.878c-0.494,0-0.896-0.401-0.896-0.896V192.07z M232.697,192.07c0-0.493,0.402-0.896,0.896-0.896h3.877\r c0.494,0,0.896,0.402,0.896,0.896v10.142c0,0.494-0.403,0.896-0.896,0.896h-3.877c-0.494,0-0.896-0.401-0.896-0.896V192.07z\r M204.835,192.07c0-0.493,0.402-0.896,0.896-0.896h3.878c0.493,0,0.895,0.402,0.895,0.896v10.142c0,0.494-0.401,0.896-0.895,0.896\r h-3.878c-0.494,0-0.896-0.401-0.896-0.896V192.07z M197.442,198.831h3.218v3.381c0,2.796,2.274,5.071,5.07,5.071h3.878\r c2.795,0,5.07-2.275,5.07-5.071v-3.381h13.845v3.381c0,2.796,2.274,5.071,5.07,5.071h3.878c2.796,0,5.071-2.275,5.071-5.071v-3.381\r h13.844v3.381c0,2.796,2.273,5.071,5.07,5.071h3.879c2.794,0,5.069-2.275,5.069-5.071v-3.381h13.845v3.381\r c0,2.796,2.273,5.071,5.07,5.071h3.877c2.796,0,5.071-2.275,5.071-5.071v-3.381h5.474c4.695,0,8.516,3.82,8.516,8.517v14.134\r H188.925v-14.134C188.925,202.651,192.745,198.831,197.442,198.831z"
    }),
    wp.element.createElement("path", {
      fill: "#0F6CB6",
      d: "M208.382,307.953h-18.202c-0.692,0-1.256-0.564-1.256-1.256v-10.732c0-1.152-0.935-2.088-2.087-2.088\r s-2.087,0.936-2.087,2.088v10.732c0,2.994,2.437,5.43,5.431,5.43h18.202c1.152,0,2.087-0.934,2.087-2.086\r C210.47,308.887,209.535,307.953,208.382,307.953z"
    }),
    wp.element.createElement("path", {
      fill: "#0F6CB6",
      d: "M208.313,231.743h-7.256c-1.152,0-2.087,0.936-2.087,2.087c0,1.154,0.935,2.087,2.087,2.087h7.256\r c1.152,0,2.087-0.933,2.087-2.087C210.4,232.678,209.465,231.743,208.313,231.743z"
    }),
    wp.element.createElement("path", {
      fill: "#0F6CB6",
      d: "M223.355,235.917h7.256c1.153,0,2.087-0.933,2.087-2.087c0-1.152-0.935-2.087-2.087-2.087h-7.256\r c-1.153,0-2.087,0.936-2.087,2.087C221.268,234.984,222.203,235.917,223.355,235.917z"
    }),
    wp.element.createElement("path", {
      fill: "#0F6CB6",
      d: "M245.653,235.917h7.255c1.152,0,2.087-0.933,2.087-2.087c0-1.152-0.935-2.087-2.087-2.087h-7.255\r c-1.153,0-2.087,0.936-2.087,2.087C243.565,234.984,244.5,235.917,245.653,235.917z"
    }),
    wp.element.createElement("path", {
      fill: "#0F6CB6",
      d: "M267.95,235.917h7.256c1.153,0,2.088-0.933,2.088-2.087c0-1.152-0.935-2.087-2.088-2.087h-7.256\r c-1.152,0-2.088,0.936-2.088,2.087C265.862,234.984,266.798,235.917,267.95,235.917z"
    }),
    wp.element.createElement("path", {
      fill: "#0F6CB6",
      d: "M297.504,231.743h-7.255c-1.154,0-2.088,0.936-2.088,2.087c0,1.154,0.934,2.087,2.088,2.087h7.255\r c1.152,0,2.088-0.933,2.088-2.087C299.592,232.678,298.656,231.743,297.504,231.743z"
    }),
    wp.element.createElement("path", {
      fill: "#0F6CB6",
      d: "M208.313,242.24h-7.256c-1.152,0-2.087,0.934-2.087,2.087c0,1.154,0.935,2.087,2.087,2.087h7.256\r c1.152,0,2.087-0.934,2.087-2.087C210.4,243.174,209.465,242.24,208.313,242.24z"
    }),
    wp.element.createElement("path", {
      fill: "#0F6CB6",
      d: "M223.355,246.415h7.256c1.153,0,2.087-0.934,2.087-2.087c0-1.153-0.935-2.087-2.087-2.087h-7.256\r c-1.153,0-2.087,0.934-2.087,2.087C221.268,245.481,222.203,246.415,223.355,246.415z"
    }),
    wp.element.createElement("path", {
      fill: "#0F6CB6",
      d: "M245.653,246.415h7.255c1.152,0,2.087-0.934,2.087-2.087c0-1.153-0.935-2.087-2.087-2.087h-7.255\r c-1.153,0-2.087,0.934-2.087,2.087C243.565,245.481,244.5,246.415,245.653,246.415z"
    }),
    wp.element.createElement("path", {
      fill: "#0F6CB6",
      d: "M267.95,246.415h7.256c1.153,0,2.088-0.934,2.088-2.087c0-1.153-0.935-2.087-2.088-2.087h-7.256\r c-1.152,0-2.088,0.934-2.088,2.087C265.862,245.481,266.798,246.415,267.95,246.415z"
    }),
    wp.element.createElement("path", {
      fill: "#0F6CB6",
      d: "M297.504,242.24h-7.255c-1.154,0-2.088,0.934-2.088,2.087c0,1.154,0.934,2.087,2.088,2.087h7.255\r c1.152,0,2.088-0.934,2.088-2.087C299.592,243.174,298.656,242.24,297.504,242.24z"
    }),
    wp.element.createElement("path", {
      fill: "#0F6CB6",
      d: "M223.406,287.395l10.733,10.732c1.552,1.553,3.616,2.408,5.812,2.408s4.261-0.855,5.813-2.408l29.392-29.393\r c3.205-3.205,3.205-8.42,0-11.625c-3.205-3.205-8.42-3.205-11.625,0l-23.58,23.58l-4.92-4.92c-3.204-3.205-8.419-3.205-11.625,0\r C220.201,278.975,220.201,284.189,223.406,287.395z M226.358,278.721c0.788-0.787,1.824-1.184,2.86-1.184s2.072,0.396,2.86,1.184\r l6.396,6.395c0.815,0.816,2.137,0.816,2.952,0l25.056-25.053c1.578-1.578,4.144-1.578,5.721-0.002c1.577,1.578,1.577,4.145,0,5.723\r l-29.391,29.391c-0.764,0.766-1.78,1.186-2.86,1.186c-1.081,0-2.096-0.42-2.86-1.186l-10.732-10.732\r C224.78,282.863,224.78,280.299,226.358,278.721z"
    }),
    wp.element.createElement("path", {
      fill: "#0F6CB6",
      d: "M316.431,274.771v-16.657c0-1.153-0.933-2.087-2.087-2.087c-1.152,0-2.088,0.934-2.088,2.087v13.993\r c-3.806-1.973-8.125-3.09-12.7-3.09c-15.271,0-27.693,12.424-27.693,27.693c0,4.002,0.854,7.805,2.386,11.242h-56.354\r c-1.153,0-2.087,0.934-2.087,2.088c0,1.15,0.935,2.086,2.087,2.086h58.667c4.976,7.402,13.427,12.279,22.995,12.279\r c15.271,0,27.694-12.424,27.694-27.695C327.25,287.789,323.006,279.838,316.431,274.771z M299.556,320.232\r c-12.969,0-23.519-10.551-23.519-23.52s10.551-23.52,23.519-23.52c12.969,0,23.52,10.551,23.52,23.52\r S312.524,320.232,299.556,320.232z"
    }),
    wp.element.createElement("path", {
      fill: "#0F6CB6",
      d: "M299.556,276.209c-11.306,0-20.503,9.199-20.503,20.504s9.197,20.502,20.503,20.502\r c11.307,0,20.502-9.197,20.502-20.502S310.861,276.209,299.556,276.209z M301.425,312.93c0.138-0.279,0.219-0.592,0.219-0.924\r v-2.543c0-1.154-0.936-2.088-2.088-2.088c-1.151,0-2.087,0.934-2.087,2.088v2.543c0,0.332,0.079,0.645,0.219,0.924\r c-7.513-0.859-13.489-6.836-14.35-14.348c0.278,0.139,0.594,0.219,0.926,0.219h2.542c1.153,0,2.087-0.936,2.087-2.088\r c0-1.154-0.934-2.088-2.087-2.088h-2.542c-0.332,0-0.647,0.082-0.926,0.219c0.86-7.512,6.837-13.49,14.35-14.348\r c-0.14,0.279-0.219,0.592-0.219,0.924v2.543c0,1.152,0.936,2.088,2.087,2.088c1.152,0,2.088-0.936,2.088-2.088v-2.543\r c0-0.332-0.081-0.645-0.219-0.924c7.513,0.857,13.488,6.836,14.349,14.348c-0.279-0.137-0.593-0.219-0.925-0.219h-2.543\r c-1.153,0-2.087,0.934-2.087,2.088c0,1.152,0.934,2.088,2.087,2.088h2.543c0.332,0,0.646-0.08,0.925-0.219\r C314.912,306.094,308.938,312.07,301.425,312.93z"
    }),
    wp.element.createElement("path", {
      fill: "#0F6CB6",
      d: "M304.157,294.625h-2.514v-2.141c0-1.152-0.935-2.086-2.088-2.086c-1.152,0-2.087,0.934-2.087,2.086v4.229\r c0,1.152,0.935,2.088,2.087,2.088h4.602c1.153,0,2.087-0.936,2.087-2.088C306.244,295.559,305.309,294.625,304.157,294.625z"
    })
  );

  // On Click Schedule at a glance
  jQuery(document).on('click', '.move-item .components-dropdown-menu', function (e) {
    if (jQuery(this).parents('.schedule-row').hasClass('isToggleActive')) {
      jQuery(this).parents('.schedule-row').removeClass('isToggleActive');
      jQuery('.schedule-row').removeClass('isToggleActive');
    } else {
      jQuery(this).parents('.schedule-row').removeClass('isToggleActive');
      jQuery('.schedule-row').removeClass('isToggleActive');
      jQuery(this).parents('.schedule-row').addClass('isToggleActive');
    }
  });
  jQuery(document).on('click', '.move-item > i.fa', function (e) {
    jQuery('.schedule-row').removeClass('isToggleActive');
    jQuery(this).parents('.schedule-row').removeClass('isToggleActive');
  });

  var BlockComponent = function (_Component) {
    _inherits(BlockComponent, _Component);

    function BlockComponent() {
      _classCallCheck(this, BlockComponent);

      return _possibleConstructorReturn(this, (BlockComponent.__proto__ || Object.getPrototypeOf(BlockComponent)).apply(this, arguments));
    }

    _createClass(BlockComponent, [{
      key: "componentDidMount",
      value: function componentDidMount() {
        var dataArray = this.props.attributes.dataArray;

        if (0 === dataArray.length) {
          this.initList();
        }
      }
    }, {
      key: "initList",
      value: function initList() {
        var dataArray = this.props.attributes.dataArray;
        var setAttributes = this.props.setAttributes;

        setAttributes({
          dataArray: [].concat(_toConsumableArray(dataArray), [{
            titleIndex: dataArray.length,
            title: '',
            detailList: [{
              index: dataArray.length,
              date: '',
              name: '',
              time: '',
              location: '',
              details: 'All Registered Attendees',
              type: ''
            }]
          }])
        });
      }
    }, {
      key: "moveMedia",
      value: function moveMedia(parentIndex, currentIndex, newIndex) {
        var _props = this.props,
            setAttributes = _props.setAttributes,
            attributes = _props.attributes;
        var dataArray = attributes.dataArray;

        var allData = [].concat(_toConsumableArray(dataArray));

        if (-1 === newIndex && 0 < parentIndex) {
          var prevBlockIndex = parentIndex - 1;
          var prevDetailListIndex = allData[prevBlockIndex].detailList.length - 1;
          allData[parentIndex].detailList[currentIndex].index = allData[prevBlockIndex].detailList[prevDetailListIndex] + 1;
          allData[prevBlockIndex].detailList.push(allData[parentIndex].detailList[currentIndex]);
          allData[parentIndex].detailList.splice(currentIndex, 1);
        } else if (undefined === allData[parentIndex].detailList[newIndex]) {
          var nextBlockIndex = parentIndex + 1;
          allData[nextBlockIndex].detailList.unshift(allData[parentIndex].detailList[currentIndex]);
          allData[parentIndex].detailList.splice(currentIndex, 1);
          allData[nextBlockIndex].detailList.map(function (data, index) {
            return allData[nextBlockIndex].detailList[index].index = index;
          });
        } else {
          allData[parentIndex].detailList[currentIndex].index = newIndex;
          allData[parentIndex].detailList[newIndex].index = currentIndex;
        }

        setAttributes({ dataArry: allData });
      }
    }, {
      key: "moveParentItem",
      value: function moveParentItem(currentIndex, newIndex) {
        var _props2 = this.props,
            setAttributes = _props2.setAttributes,
            attributes = _props2.attributes;
        var dataArray = attributes.dataArray;

        var allData = [].concat(_toConsumableArray(dataArray));

        allData[currentIndex].titleIndex = newIndex;
        allData[newIndex].titleIndex = currentIndex;

        setAttributes({ dataArry: allData });
      }
    }, {
      key: "MoveItemToParent",
      value: function MoveItemToParent(currentParentIndex, parentIndex, index) {
        var _props3 = this.props,
            setAttributes = _props3.setAttributes,
            attributes = _props3.attributes;
        var dataArray = attributes.dataArray;

        var allData = [].concat(_toConsumableArray(dataArray));
        allData[currentParentIndex].detailList[index].index = allData[parentIndex].detailList.length;
        allData[parentIndex].detailList.push(allData[currentParentIndex].detailList[index]);
        allData[currentParentIndex].detailList.splice(index, 1);

        setAttributes({ dataArry: allData });
      }
    }, {
      key: "duplicate",
      value: function duplicate(parentIndex, currentIndex) {
        var _props4 = this.props,
            setAttributes = _props4.setAttributes,
            attributes = _props4.attributes;
        var dataArray = attributes.dataArray;

        var allData = [].concat(_toConsumableArray(dataArray));

        allData[parentIndex].detailList.splice(currentIndex + 1, 0, {
          index: parseInt(allData[parentIndex].detailList[currentIndex].index) + 1,
          name: allData[parentIndex].detailList[currentIndex].name,
          time: allData[parentIndex].detailList[currentIndex].time,
          location: allData[parentIndex].detailList[currentIndex].location,
          details: allData[parentIndex].detailList[currentIndex].details,
          type: allData[parentIndex].detailList[currentIndex].type
        });

        setAttributes({ dataArray: allData });
      }
    }, {
      key: "render",
      value: function render() {
        var _this2 = this;

        var _props5 = this.props,
            attributes = _props5.attributes,
            setAttributes = _props5.setAttributes;
        var dataArray = attributes.dataArray,
            showFilter = attributes.showFilter,
            showTitle = attributes.showTitle,
            showDateFilter = attributes.showDateFilter,
            showOpenToFilter = attributes.showOpenToFilter,
            showLocationFilter = attributes.showLocationFilter,
            showTypeFilter = attributes.showTypeFilter,
            showNameFilter = attributes.showNameFilter,
            showTimeFilter = attributes.showTimeFilter,
            timeFilter = attributes.timeFilter;


        return wp.element.createElement(
          Fragment,
          null,
          wp.element.createElement(
            InspectorControls,
            null,
            wp.element.createElement(
              PanelBody,
              { title: "General Settings" },
              wp.element.createElement(
                PanelRow,
                null,
                wp.element.createElement(ToggleControl, {
                  label: __('Include Times'),
                  checked: timeFilter,
                  onChange: function onChange() {
                    return setAttributes({ timeFilter: !timeFilter });
                  }
                })
              ),
              wp.element.createElement(
                PanelRow,
                null,
                wp.element.createElement(ToggleControl, {
                  label: __('Show Filter'),
                  checked: showFilter,
                  onChange: function onChange() {
                    return setAttributes({ showFilter: !showFilter });
                  }
                })
              ),
              true === showFilter && wp.element.createElement(
                "div",
                { className: "inspector-field inspector-field-headings-design inspector-display-filter" },
                wp.element.createElement(
                  PanelRow,
                  null,
                  wp.element.createElement(CheckboxControl, {
                    className: "in-checkbox",
                    label: "Date Filter",
                    checked: showDateFilter,
                    onChange: function onChange(isChecked) {
                      if (isChecked) {
                        setAttributes({ showDateFilter: true });
                      } else {
                        setAttributes({ showDateFilter: false });
                      }
                    }
                  })
                ),
                wp.element.createElement(
                  PanelRow,
                  null,
                  wp.element.createElement(CheckboxControl, {
                    className: "in-checkbox",
                    label: "Is Open To Filter",
                    checked: showOpenToFilter,
                    onChange: function onChange(isChecked) {
                      if (isChecked) {
                        setAttributes({ showOpenToFilter: true });
                      } else {
                        setAttributes({ showOpenToFilter: false });
                      }
                    }
                  })
                ),
                wp.element.createElement(
                  PanelRow,
                  null,
                  wp.element.createElement(CheckboxControl, {
                    className: "in-checkbox",
                    label: "Location Filter",
                    checked: showLocationFilter,
                    onChange: function onChange(isChecked) {
                      if (isChecked) {
                        setAttributes({ showLocationFilter: true });
                      } else {
                        setAttributes({ showLocationFilter: false });
                      }
                    }
                  })
                ),
                timeFilter && wp.element.createElement(
                  PanelRow,
                  null,
                  wp.element.createElement(CheckboxControl, {
                    className: "in-checkbox",
                    label: "Time Filter",
                    checked: showTimeFilter,
                    onChange: function onChange(isChecked) {
                      if (isChecked) {
                        setAttributes({ showTimeFilter: true });
                      } else {
                        setAttributes({ showTimeFilter: false });
                      }
                    }
                  })
                ),
                wp.element.createElement(
                  PanelRow,
                  null,
                  wp.element.createElement(CheckboxControl, {
                    className: "in-checkbox",
                    label: "Type Filter",
                    checked: showTypeFilter,
                    onChange: function onChange(isChecked) {
                      if (isChecked) {
                        setAttributes({ showTypeFilter: true });
                      } else {
                        setAttributes({ showTypeFilter: false });
                      }
                    }
                  })
                ),
                wp.element.createElement(
                  PanelRow,
                  null,
                  wp.element.createElement(CheckboxControl, {
                    className: "in-checkbox",
                    label: "Name Filter",
                    checked: showNameFilter,
                    onChange: function onChange(isChecked) {
                      if (isChecked) {
                        setAttributes({ showNameFilter: true });
                      } else {
                        setAttributes({ showNameFilter: false });
                      }
                    }
                  })
                )
              ),
              wp.element.createElement(
                PanelRow,
                null,
                wp.element.createElement(ToggleControl, {
                  label: __('Show Title'),
                  checked: showTitle,
                  onChange: function onChange() {
                    return setAttributes({ showTitle: !showTitle });
                  }
                })
              )
            )
          ),
          showFilter && wp.element.createElement(
            "div",
            { className: "schedule-glance-filter" },
            showDateFilter && wp.element.createElement(
              "div",
              { className: "date" },
              wp.element.createElement(
                "label",
                null,
                "Date"
              ),
              wp.element.createElement(
                "div",
                { className: "schedule-select" },
                wp.element.createElement(
                  "select",
                  { id: "date" },
                  wp.element.createElement(
                    "option",
                    null,
                    "Select a Date"
                  )
                )
              )
            ),
            showOpenToFilter && wp.element.createElement(
              "div",
              { className: "pass-type" },
              wp.element.createElement(
                "label",
                null,
                "Is Open To"
              ),
              wp.element.createElement(
                "div",
                { className: "schedule-select" },
                wp.element.createElement(
                  "select",
                  { id: "pass-type" },
                  wp.element.createElement(
                    "option",
                    null,
                    "Select an Open To"
                  )
                )
              )
            ),
            showLocationFilter && wp.element.createElement(
              "div",
              { className: "location" },
              wp.element.createElement(
                "label",
                null,
                "Location"
              ),
              wp.element.createElement(
                "div",
                { className: "schedule-select" },
                wp.element.createElement(
                  "select",
                  { id: "location" },
                  wp.element.createElement(
                    "option",
                    null,
                    "Select a Location"
                  )
                )
              )
            ),
            showTimeFilter && timeFilter && wp.element.createElement(
              "div",
              { className: "time" },
              wp.element.createElement(
                "label",
                null,
                "Time"
              ),
              wp.element.createElement(
                "div",
                { className: "schedule-select" },
                wp.element.createElement(
                  "select",
                  { id: "time" },
                  wp.element.createElement(
                    "option",
                    null,
                    "Select Time"
                  )
                )
              )
            ),
            showTypeFilter && wp.element.createElement(
              "div",
              { className: "type" },
              wp.element.createElement(
                "label",
                null,
                "Type"
              ),
              wp.element.createElement(
                "div",
                { className: "schedule-select" },
                wp.element.createElement(
                  "select",
                  { id: "type" },
                  wp.element.createElement(
                    "option",
                    null,
                    "Select a Type"
                  )
                )
              )
            ),
            showNameFilter && wp.element.createElement(
              "div",
              { className: "search-box" },
              wp.element.createElement(
                "label",
                null,
                "Name"
              ),
              wp.element.createElement(
                "div",
                { className: "schedule-select" },
                wp.element.createElement("input", {
                  id: "box-main-search",
                  className: "schedule-search",
                  name: "schedule-search",
                  type: "text",
                  placeholder: "Filter by name..."
                })
              )
            )
          ),
          wp.element.createElement(
            "div",
            { className: "schedule-main" },
            0 < dataArray.length && dataArray.sort(function (a, b) {
              return a.titleIndex - b.titleIndex;
            }).map(function (parentData, parentIndex) {
              return wp.element.createElement(
                Fragment,
                null,
                wp.element.createElement(
                  "div",
                  { className: "shedule-details-parent" },
                  wp.element.createElement(
                    "div",
                    { className: "move-item" },
                    0 < parentIndex && wp.element.createElement(
                      Tooltip,
                      { text: "Move UP" },
                      wp.element.createElement("i", {
                        onClick: function onClick() {
                          return _this2.moveParentItem(parentIndex, parentIndex - 1);
                        },
                        className: "fa fa-chevron-up"
                      })
                    ),
                    parentIndex + 1 < dataArray.length && wp.element.createElement(
                      Tooltip,
                      { text: "Move Down" },
                      wp.element.createElement("i", {
                        onClick: function onClick() {
                          return _this2.moveParentItem(parentIndex, parentIndex + 1);
                        },
                        className: "fa fa-chevron-down"
                      })
                    )
                  ),
                  wp.element.createElement(
                    Tooltip,
                    { text: "Remove" },
                    wp.element.createElement("i", {
                      onClick: function onClick() {
                        var toDel = confirm('Are you sure you want to delete?');
                        if (true === toDel) {
                          var tempDataArray = [].concat(_toConsumableArray(dataArray));
                          tempDataArray.splice(parentIndex, 1);
                          setAttributes({ dataArray: tempDataArray });
                        }
                      },
                      className: "fa fa-times details-parent"
                    })
                  ),
                  showTitle && wp.element.createElement(RichText, {
                    tagName: "h2",
                    value: parentData.title,
                    keepPlaceholderOnFocus: "true",
                    placeholder: __('Date'),
                    onChange: function onChange(value) {
                      var tempDataArray = [].concat(_toConsumableArray(dataArray));
                      tempDataArray[parentIndex].title = value;
                      setAttributes({ dataArray: tempDataArray });
                    }
                  }),
                  wp.element.createElement(
                    "div",
                    { className: "schedule-data" },
                    parentData.detailList.sort(function (a, b) {
                      return a.index - b.index;
                    }).map(function (data, index) {
                      return wp.element.createElement(
                        "div",
                        { className: "schedule-row" },
                        wp.element.createElement(
                          "div",
                          { className: "move-item" },
                          (0 !== parentIndex || 0 !== index) && wp.element.createElement(
                            Tooltip,
                            { text: "Move UP" },
                            wp.element.createElement("i", {
                              onClick: function onClick() {
                                return _this2.moveMedia(parentIndex, index, index - 1);
                              },
                              className: "fa fa-chevron-up"
                            })
                          ),
                          (parentIndex + 1 !== dataArray.length || index + 1 < parentData.detailList.length) && wp.element.createElement(
                            Tooltip,
                            { text: "Move Down" },
                            wp.element.createElement("i", {
                              onClick: function onClick() {
                                return _this2.moveMedia(parentIndex, index, index + 1);
                              },
                              className: "fa fa-chevron-down"
                            })
                          ),
                          wp.element.createElement(
                            Tooltip,
                            { text: "Duplicate" },
                            wp.element.createElement("i", {
                              onClick: function onClick() {
                                return _this2.duplicate(parentIndex, index);
                              },
                              className: "fa fa-clone"
                            })
                          ),
                          1 < dataArray.length && wp.element.createElement(
                            DropdownMenu,
                            {
                              icon: "arrow-right-alt",
                              label: "Move To"
                            },
                            function (_ref) {
                              var onClose = _ref.onClose;
                              return wp.element.createElement(
                                Fragment,
                                null,
                                wp.element.createElement(
                                  MenuGroup,
                                  null,
                                  dataArray.map(function (parentTitle, titleIndex) {
                                    return '' !== parentTitle.title && parentIndex !== titleIndex && wp.element.createElement(
                                      MenuItem,
                                      {
                                        className: "schedule-move-to-list",
                                        onClick: function onClick() {
                                          _this2.MoveItemToParent(parentIndex, titleIndex, index);onClose();
                                        }
                                      },
                                      parentTitle.title
                                    );
                                  })
                                )
                              );
                            }
                          ),
                          wp.element.createElement(
                            Tooltip,
                            { text: "Remove" },
                            wp.element.createElement("i", {
                              onClick: function onClick() {
                                var toDelete = confirm('Are you sure you want to delete?');
                                if (true === toDelete) {
                                  var tempDataArray = [].concat(_toConsumableArray(dataArray));
                                  tempDataArray[parentIndex].detailList.splice(index, 1);
                                  setAttributes({ dataArray: tempDataArray });
                                }
                              },
                              className: "fa fa-times"
                            })
                          )
                        ),
                        wp.element.createElement(
                          "div",
                          { className: "name" },
                          wp.element.createElement(RichText, {
                            tagName: "strong",
                            keepPlaceholderOnFocus: "true",
                            placeholder: __('Registration Open'),
                            value: data.name,
                            onChange: function onChange(name) {
                              var tempDataArray = [].concat(_toConsumableArray(dataArray));
                              tempDataArray[parentIndex].detailList[index].name = name;
                              setAttributes({ dataArray: tempDataArray });
                            }
                          })
                        ),
                        timeFilter && wp.element.createElement(
                          "div",
                          { className: "time" },
                          wp.element.createElement(RichText, {
                            tagName: "p",
                            placeholder: __('Time'),
                            value: data.time,
                            keepPlaceholderOnFocus: "true",
                            onChange: function onChange(time) {
                              var tempDataArray = [].concat(_toConsumableArray(dataArray));
                              tempDataArray[parentIndex].detailList[index].time = time;
                              setAttributes({ dataArray: tempDataArray });
                            }
                          })
                        ),
                        wp.element.createElement(
                          "div",
                          { className: "location" },
                          wp.element.createElement(RichText, {
                            tagName: "p",
                            placeholder: __('Location'),
                            value: data.location,
                            keepPlaceholderOnFocus: "true",
                            onChange: function onChange(location) {
                              var tempDataArray = [].concat(_toConsumableArray(dataArray));
                              tempDataArray[parentIndex].detailList[index].location = location;
                              setAttributes({ dataArray: tempDataArray });
                            }
                          })
                        ),
                        wp.element.createElement(
                          "div",
                          { className: "details" },
                          wp.element.createElement(RichText, {
                            tagName: "p",
                            placeholder: __('All Registered Attendees'),
                            value: data.details,
                            keepPlaceholderOnFocus: "true",
                            onChange: function onChange(details) {
                              var tempDataArray = [].concat(_toConsumableArray(dataArray));
                              tempDataArray[parentIndex].detailList[index].details = details;
                              setAttributes({ dataArray: tempDataArray });
                            }
                          })
                        ),
                        wp.element.createElement(
                          "div",
                          { className: "type" },
                          wp.element.createElement(RichText, {
                            tagName: "p",
                            placeholder: __('Type'),
                            value: data.type,
                            keepPlaceholderOnFocus: "true",
                            onChange: function onChange(type) {
                              var tempDataArray = [].concat(_toConsumableArray(dataArray));
                              tempDataArray[parentIndex].detailList[index].type = type;
                              setAttributes({ dataArray: tempDataArray });
                            }
                          })
                        )
                      );
                    }),
                    wp.element.createElement(
                      "div",
                      { className: "add-remove-btn" },
                      wp.element.createElement(
                        "button",
                        {
                          className: "add",
                          onClick: function onClick(content) {
                            var tempDataArray = [].concat(_toConsumableArray(dataArray));
                            tempDataArray[parentIndex].detailList.push({
                              index: dataArray[parentIndex].detailList.length,
                              name: '',
                              time: '',
                              location: '',
                              details: 'All Registered Attendees',
                              type: ''
                            });
                            setAttributes({ dataArray: tempDataArray });
                          }
                        },
                        wp.element.createElement("span", { className: "dashicons dashicons-plus" })
                      )
                    )
                  )
                )
              );
            }),
            wp.element.createElement(
              "div",
              { className: "add-remove-btn" },
              wp.element.createElement(
                "button",
                {
                  className: "add",
                  onClick: function onClick(content) {
                    setAttributes({
                      dataArray: [].concat(_toConsumableArray(dataArray), [{
                        titleIndex: dataArray.length,
                        title: '',
                        detailList: [{
                          index: 0,
                          name: '',
                          time: '',
                          location: '',
                          details: 'All Registered Attendees',
                          type: ''
                        }]
                      }])
                    });
                  }
                },
                wp.element.createElement("span", { className: "dashicons dashicons-plus" })
              )
            )
          )
        );
      }
    }]);

    return BlockComponent;
  }(Component);

  registerBlockType('nab/schedule', {
    title: __('Schedule'),
    description: __('Schedule'),
    icon: { src: scheduleBlockIcon },
    category: 'nabshow',
    keywords: [__('Schedule'), __('gutenberg'), __('nab')],
    attributes: {
      dataArray: {
        type: 'array',
        default: []
      },
      showFilter: {
        type: 'boolean',
        default: false
      },
      timeFilter: {
        type: 'boolean',
        default: false
      },
      showTitle: {
        type: 'boolean',
        default: true
      },
      showDateFilter: {
        type: 'boolean',
        default: true
      },
      showOpenToFilter: {
        type: 'boolean',
        default: true
      },
      showLocationFilter: {
        type: 'boolean',
        default: true
      },
      showTypeFilter: {
        type: 'boolean',
        default: true
      },
      showNameFilter: {
        type: 'boolean',
        default: true
      },
      showTimeFilter: {
        type: 'boolean',
        default: true
      }
    },
    edit: BlockComponent,

    save: function save(props) {
      var attributes = props.attributes;
      var dataArray = attributes.dataArray,
          showFilter = attributes.showFilter,
          showTitle = attributes.showTitle,
          showDateFilter = attributes.showDateFilter,
          showOpenToFilter = attributes.showOpenToFilter,
          showLocationFilter = attributes.showLocationFilter,
          showTypeFilter = attributes.showTypeFilter,
          showNameFilter = attributes.showNameFilter,
          showTimeFilter = attributes.showTimeFilter,
          timeFilter = attributes.timeFilter;


      return wp.element.createElement(
        Fragment,
        null,
        showFilter && wp.element.createElement(
          "div",
          { className: "schedule-glance-filter" },
          showDateFilter && wp.element.createElement(
            "div",
            { className: "date" },
            wp.element.createElement(
              "label",
              null,
              "Date"
            ),
            wp.element.createElement(
              "div",
              { className: "schedule-select" },
              wp.element.createElement(
                "select",
                { id: "date" },
                wp.element.createElement(
                  "option",
                  null,
                  "Select a Date"
                )
              )
            )
          ),
          showOpenToFilter && wp.element.createElement(
            "div",
            { className: "pass-type" },
            wp.element.createElement(
              "label",
              null,
              "Is Open To"
            ),
            wp.element.createElement(
              "div",
              { className: "schedule-select" },
              wp.element.createElement(
                "select",
                { id: "pass-type" },
                wp.element.createElement(
                  "option",
                  null,
                  "Select an Open To"
                )
              )
            )
          ),
          showLocationFilter && wp.element.createElement(
            "div",
            { className: "location" },
            wp.element.createElement(
              "label",
              null,
              "Location"
            ),
            wp.element.createElement(
              "div",
              { className: "schedule-select" },
              wp.element.createElement(
                "select",
                { id: "location" },
                wp.element.createElement(
                  "option",
                  null,
                  "Select a Location"
                )
              )
            )
          ),
          showTimeFilter && timeFilter && wp.element.createElement(
            "div",
            { className: "time" },
            wp.element.createElement(
              "label",
              null,
              "Time"
            ),
            wp.element.createElement(
              "div",
              { className: "schedule-select" },
              wp.element.createElement(
                "select",
                { id: "time" },
                wp.element.createElement(
                  "option",
                  null,
                  "Select Time"
                )
              )
            )
          ),
          showTypeFilter && wp.element.createElement(
            "div",
            { className: "type" },
            wp.element.createElement(
              "label",
              null,
              "Type"
            ),
            wp.element.createElement(
              "div",
              { className: "schedule-select" },
              wp.element.createElement(
                "select",
                { id: "type" },
                wp.element.createElement(
                  "option",
                  null,
                  "Select a Type"
                )
              )
            )
          ),
          showNameFilter && wp.element.createElement(
            "div",
            { className: "search-box" },
            wp.element.createElement(
              "label",
              null,
              "Name"
            ),
            wp.element.createElement(
              "div",
              { className: "schedule-select" },
              wp.element.createElement("input", {
                id: "box-main-search",
                className: "schedule-search",
                name: "schedule-search",
                type: "text",
                placeholder: "Filter by name..."
              })
            )
          )
        ),
        0 < dataArray.length && dataArray.map(function (parentData) {
          return wp.element.createElement(
            "div",
            { className: "schedule-main" },
            showTitle && wp.element.createElement(RichText.Content, { tagName: "h2", value: parentData.title }),
            wp.element.createElement(
              "div",
              { className: "schedule-data" },
              parentData.detailList.sort(function (a, b) {
                return a.index - b.index;
              }).map(function (data) {
                return wp.element.createElement(
                  "div",
                  { className: "schedule-row", "data-type": data.type },
                  wp.element.createElement(
                    "div",
                    { className: "name" },
                    wp.element.createElement(RichText.Content, {
                      tagName: "strong",
                      value: data.name === undefined ? '-' : data.name
                    })
                  ),
                  timeFilter && wp.element.createElement(
                    "div",
                    { className: "time" },
                    wp.element.createElement(RichText.Content, {
                      tagName: "p",
                      value: data.time === undefined || '' === data.time ? '' : data.time
                    })
                  ),
                  wp.element.createElement(
                    "div",
                    { className: "location" },
                    wp.element.createElement(RichText.Content, {
                      tagName: "p",
                      value: data.location === undefined ? '-' : data.location
                    })
                  ),
                  wp.element.createElement(
                    "div",
                    { className: "details" },
                    wp.element.createElement(RichText.Content, {
                      tagName: "p",
                      value: data.details === undefined ? '-' : data.details
                    })
                  )
                );
              })
            )
          );
        })
      );
    }
  });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);

/***/ }),
/* 101 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__icons__ = __webpack_require__(3);
var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _toConsumableArray(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } else { return Array.from(arr); } }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }



(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
    var __ = wpI18n.__;
    var registerBlockType = wpBlocks.registerBlockType;
    var RichText = wpEditor.RichText,
        InspectorControls = wpEditor.InspectorControls;
    var Component = wpElement.Component;
    var PanelBody = wpComponents.PanelBody,
        RangeControl = wpComponents.RangeControl,
        ToggleControl = wpComponents.ToggleControl,
        SelectControl = wpComponents.SelectControl,
        PanelRow = wpComponents.PanelRow;


    var quoteBlockIcon = wp.element.createElement(
        "svg",
        { width: "150px", height: "150px", viewBox: "181 181 150 150", "enable-background": "new 181 181 150 150" },
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M321.437,192.815H190.563c-3.732,0-6.769,3.037-6.769,6.769v117.343c0,1.249,1.008,2.257,2.256,2.257h139.9\r c1.247,0,2.257-1.008,2.257-2.257V199.584C328.207,195.853,325.169,192.815,321.437,192.815z M188.307,206.354h135.387v108.318\r H188.307V206.354z M190.563,197.328h2.302c-1.246,0-2.243,1.009-2.243,2.257c0,1.248,1.02,2.256,2.268,2.256\r c1.246,0,2.256-1.008,2.256-2.256c0-1.248-1.011-2.257-2.256-2.257h6.742c-1.246,0-2.243,1.009-2.243,2.257\r c0,1.248,1.019,2.256,2.268,2.256c1.245,0,2.256-1.008,2.256-2.256c0-1.248-1.011-2.257-2.256-2.257h6.751\r c-1.246,0-2.243,1.009-2.243,2.257c0,1.248,1.02,2.256,2.268,2.256c1.246,0,2.257-1.008,2.257-2.256\r c0-1.248-1.011-2.257-2.257-2.257h115.004c1.246,0,2.257,1.011,2.257,2.257v2.256H206.43h-6.776h-6.767h-4.581v-2.256\r C188.307,198.339,189.317,197.328,190.563,197.328z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M201.846,217.636h-4.513v-1.322l1.598-1.595c0.882-0.88,0.882-2.309,0-3.191\r c-0.882-0.882-2.309-0.882-3.191,0l-2.257,2.254c-0.209,0.208-0.375,0.458-0.489,0.733c-0.115,0.275-0.173,0.569-0.173,0.864v4.513\r v6.77c0,1.248,1.008,2.256,2.256,2.256h6.77c1.248,0,2.256-1.008,2.256-2.256v-6.77\r C204.102,218.645,203.093,217.636,201.846,217.636z M199.589,224.405h-2.256v-2.256h2.256V224.405z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M215.384,228.918c1.248,0,2.256-1.008,2.256-2.256v-6.77c0-1.248-1.009-2.256-2.256-2.256h-4.513v-1.322\r l1.597-1.595c0.882-0.88,0.882-2.309,0-3.191c-0.882-0.882-2.309-0.882-3.191,0l-2.256,2.254c-0.21,0.208-0.375,0.458-0.489,0.733\r c-0.115,0.275-0.174,0.569-0.174,0.864v4.513v6.77c0,1.248,1.009,2.256,2.256,2.256H215.384L215.384,228.918z M213.127,224.405\r h-2.256v-2.256h2.256V224.405z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M316.926,292.091h-6.769c-1.248,0-2.257,1.01-2.257,2.257v6.77c0,1.248,1.009,2.257,2.257,2.257h4.513v1.322\r l-1.598,1.595c-0.882,0.881-0.882,2.309,0,3.191c0.439,0.44,1.018,0.661,1.595,0.661c0.578,0,1.155-0.221,1.596-0.661l2.257-2.254\r c0.209-0.208,0.374-0.459,0.489-0.734c0.114-0.274,0.174-0.568,0.174-0.863v-4.514v-6.77\r C319.183,293.101,318.174,292.091,316.926,292.091z M312.413,296.604h2.257v2.257h-2.257V296.604z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M303.388,292.091h-6.77c-1.248,0-2.256,1.01-2.256,2.257v6.77c0,1.248,1.008,2.257,2.256,2.257h4.513v1.322\r l-1.597,1.595c-0.884,0.881-0.884,2.309,0,3.191c0.439,0.44,1.017,0.661,1.595,0.661c0.577,0,1.155-0.221,1.596-0.661l2.255-2.254\r c0.211-0.208,0.375-0.459,0.491-0.734c0.114-0.274,0.173-0.568,0.173-0.863v-4.514v-6.77\r C305.644,293.101,304.635,292.091,303.388,292.091z M298.874,296.604h2.257v2.257h-2.257V296.604z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M208.608,265.044c0,1.247,1.008,2.256,2.256,2.256h90.271c1.247,0,2.257-1.009,2.257-2.256\r c0-1.248-1.01-2.257-2.257-2.257h-90.271C209.617,262.787,208.608,263.796,208.608,265.044L208.608,265.044z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M301.136,269.557h-90.271c-1.248,0-2.256,1.009-2.256,2.257c0,1.247,1.008,2.257,2.256,2.257h90.271\r c1.247,0,2.257-1.01,2.257-2.257C303.393,270.565,302.383,269.557,301.136,269.557z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M303.393,278.582c0-1.247-1.01-2.257-2.257-2.257h-90.271c-1.248,0-2.256,1.01-2.256,2.257\r c0,1.249,1.008,2.257,2.256,2.257h90.271C302.383,280.839,303.393,279.831,303.393,278.582z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M278.564,283.096h-45.129c-1.248,0-2.256,1.009-2.256,2.256c0,1.248,1.008,2.257,2.256,2.257h45.129\r c1.248,0,2.256-1.009,2.256-2.257C280.82,284.104,279.813,283.096,278.564,283.096z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M245.957,254.637c0.014,0.012,0.031,0.021,0.045,0.034c2.726,2.235,6.208,3.581,10,3.581\r c3.802,0,7.293-1.352,10.021-3.599c0.002-0.003,0.006-0.003,0.008-0.005c3.517-2.899,5.764-7.288,5.764-12.193\r c0-8.708-7.087-15.795-15.795-15.795c-8.708,0-15.795,7.088-15.795,15.795C240.205,247.354,242.445,251.738,245.957,254.637\r L245.957,254.637z M250.413,252.198c1.241-1.821,3.313-2.974,5.585-2.974c2.274,0,4.346,1.155,5.587,2.977\r c-1.651,0.952-3.543,1.539-5.584,1.539C253.958,253.739,252.069,253.152,250.413,252.198L250.413,252.198z M256,244.711\r c-1.246,0-2.257-1.011-2.257-2.256s1.011-2.257,2.257-2.257c1.245,0,2.257,1.011,2.257,2.257S257.245,244.711,256,244.711z\r M256,231.172c6.222,0,11.282,5.062,11.282,11.283c0,2.534-0.871,4.851-2.288,6.738c-0.916-1.212-2.082-2.2-3.389-2.952\r c0.735-1.081,1.164-2.383,1.164-3.786c0-3.732-3.038-6.77-6.77-6.77c-3.732,0-6.769,3.037-6.769,6.77\r c0,1.401,0.429,2.705,1.162,3.788c-1.307,0.752-2.471,1.737-3.39,2.95c-1.415-1.889-2.285-4.204-2.285-6.738\r C244.718,236.233,249.779,231.172,256,231.172L256,231.172z" })
    );

    var QuotesSlider = function (_Component) {
        _inherits(QuotesSlider, _Component);

        function QuotesSlider() {
            _classCallCheck(this, QuotesSlider);

            var _this = _possibleConstructorReturn(this, (QuotesSlider.__proto__ || Object.getPrototypeOf(QuotesSlider)).apply(this, arguments));

            _this.state = {
                currentSelected: 0,
                lastSliderIndex: 0,
                inited: false,
                bxSliderObj: {},
                sliderActive: false,
                activeClass: false
            };

            _this.initSlider = _this.initSlider.bind(_this);
            _this.reloadSlider = _this.reloadSlider.bind(_this);
            return _this;
        }

        _createClass(QuotesSlider, [{
            key: "componentDidUpdate",
            value: function componentDidUpdate(prevProps) {
                var _props$attributes = this.props.attributes,
                    sliderActive = _props$attributes.sliderActive,
                    media = _props$attributes.media,
                    adaptiveHeight = _props$attributes.adaptiveHeight,
                    autoplay = _props$attributes.autoplay,
                    speed = _props$attributes.speed,
                    infiniteLoop = _props$attributes.infiniteLoop,
                    pager = _props$attributes.pager,
                    controls = _props$attributes.controls,
                    mode = _props$attributes.mode;

                if (this.state.bxSliderObj.length === undefined && sliderActive) {
                    this.initSlider();
                } else if (0 < this.state.bxSliderObj.length && !sliderActive) {
                    this.state.bxSliderObj.destroySlider();
                    this.setState({ bxSliderObj: {} });
                }

                if (adaptiveHeight !== prevProps.attributes.adaptiveHeight) {
                    this.reloadSlider();
                }
                if (autoplay !== prevProps.attributes.autoplay) {
                    this.reloadSlider();
                }
                if (speed !== prevProps.attributes.speed) {
                    this.reloadSlider();
                }
                if (infiniteLoop !== prevProps.attributes.infiniteLoop) {
                    this.reloadSlider();
                }
                if (pager !== prevProps.attributes.pager) {
                    this.reloadSlider();
                }
                if (controls !== prevProps.attributes.controls) {
                    this.reloadSlider();
                }
                if (mode !== prevProps.attributes.mode) {
                    this.reloadSlider();
                }
            }
        }, {
            key: "componentDidMount",
            value: function componentDidMount() {
                var _props$attributes2 = this.props.attributes,
                    sliderActive = _props$attributes2.sliderActive,
                    quotes = _props$attributes2.quotes;

                if (this.state.bxSliderObj.length === undefined && sliderActive) {
                    this.initSlider();
                } else if (0 < this.state.bxSliderObj.length && !sliderActive) {
                    this.state.bxSliderObj.destroySlider();
                    this.setState({ bxSliderObj: {} });
                }
                if (0 === quotes.length) {
                    this.initList();
                }
            }
        }, {
            key: "initList",
            value: function initList() {
                var quotes = this.props.attributes.quotes;
                var setAttributes = this.props.setAttributes;

                setAttributes({
                    sliderActive: false,
                    quotes: [].concat(_toConsumableArray(quotes), [{
                        index: quotes.length,
                        title: '',
                        content: '',
                        author: '',
                        link: '',
                        area: ''
                    }])
                });
            }
        }, {
            key: "initSlider",
            value: function initSlider() {
                var _props$attributes3 = this.props.attributes,
                    infiniteLoop = _props$attributes3.infiniteLoop,
                    pager = _props$attributes3.pager,
                    controls = _props$attributes3.controls,
                    adaptiveHeight = _props$attributes3.adaptiveHeight,
                    speed = _props$attributes3.speed,
                    mode = _props$attributes3.mode;
                var clientId = this.props.clientId;

                var sliderObj = jQuery("#block-" + clientId + " .wp-block-md-quotes-slider-block").bxSlider({
                    mode: mode,
                    speed: speed,
                    controls: controls,
                    infiniteLoop: infiniteLoop,
                    pager: pager,
                    adaptiveHeight: adaptiveHeight,
                    stopAutoOnClick: true,
                    autoHover: true,
                    touchEnabled: false
                });

                this.setState({ bxSliderObj: sliderObj });
            }
        }, {
            key: "reloadSlider",
            value: function reloadSlider() {
                var _props$attributes4 = this.props.attributes,
                    infiniteLoop = _props$attributes4.infiniteLoop,
                    pager = _props$attributes4.pager,
                    controls = _props$attributes4.controls,
                    adaptiveHeight = _props$attributes4.adaptiveHeight,
                    speed = _props$attributes4.speed,
                    mode = _props$attributes4.mode;

                this.state.bxSliderObj.reloadSlider({
                    mode: mode,
                    speed: speed,
                    controls: controls,
                    infiniteLoop: infiniteLoop,
                    pager: pager,
                    adaptiveHeight: adaptiveHeight,
                    stopAutoOnClick: true,
                    autoHover: true,
                    touchEnabled: false
                });
            }
        }, {
            key: "gotoLastSlider",
            value: function gotoLastSlider() {
                var gotoslide = this.props.attributes.quotes.length - 1;
                this.state.bxSliderObj.goToSlide(gotoslide);
                this.reloadSlider();
            }
        }, {
            key: "render",
            value: function render() {
                var _this2 = this;

                var _props = this.props,
                    attributes = _props.attributes,
                    setAttributes = _props.setAttributes,
                    clientId = _props.clientId,
                    className = _props.className;
                var quotes = attributes.quotes,
                    sliderActive = attributes.sliderActive,
                    quotesOptions = attributes.quotesOptions,
                    autoplay = attributes.autoplay,
                    infiniteLoop = attributes.infiniteLoop,
                    pager = attributes.pager,
                    controls = attributes.controls,
                    adaptiveHeight = attributes.adaptiveHeight,
                    speed = attributes.speed,
                    mode = attributes.mode,
                    sliderBgColor = attributes.sliderBgColor;

                var quotesList = quotes.sort(function (a, b) {
                    return a.index - b.index;
                }).map(function (quote, index) {
                    return wp.element.createElement(
                        "div",
                        { className: "quote-item" },
                        wp.element.createElement(
                            "span",
                            {
                                className: "remove-quote",
                                onClick: function onClick() {
                                    var qewQusote = quotes.filter(function (item) {
                                        return item.index != quote.index;
                                    }).map(function (t) {
                                        if (t.index > quote.index) {
                                            t.index -= 1;
                                        }

                                        return t;
                                    });

                                    setAttributes({
                                        quotes: qewQusote
                                    });
                                    _this2.reloadSlider();
                                }
                            },
                            wp.element.createElement("i", { className: "fa fa-times" })
                        ),
                        wp.element.createElement(RichText, {
                            tagName: "h3",
                            placeholder: __('Title'),
                            value: quote.title,
                            className: "title",
                            onChange: function onChange(title) {
                                var newObject = Object.assign({}, quote, {
                                    title: title
                                });
                                setAttributes({
                                    quotes: [].concat(_toConsumableArray(quotes.filter(function (item) {
                                        return item.index != quote.index;
                                    })), [newObject])
                                });
                            }
                        }),
                        wp.element.createElement(RichText, {
                            tagName: "p",
                            className: "content",
                            placeholder: __('Content'),
                            value: quote.content,
                            onChange: function onChange(content) {
                                var newObject = Object.assign({}, quote, {
                                    content: content
                                });
                                setAttributes({
                                    quotes: [].concat(_toConsumableArray(quotes.filter(function (item) {
                                        return item.index != quote.index;
                                    })), [newObject])
                                });
                            }
                        }),
                        'quotes-options-2' === quotesOptions && wp.element.createElement(RichText, {
                            tagName: "p",
                            className: "author",
                            placeholder: "Author",
                            value: quote.author,
                            onChange: function onChange(author) {
                                var newObject = Object.assign({}, quote, {
                                    author: author
                                });
                                setAttributes({
                                    quotes: [].concat(_toConsumableArray(quotes.filter(function (item) {
                                        return item.index != quote.index;
                                    })), [newObject])
                                });
                            }
                        }),
                        'quotes-options-1' === quotesOptions && wp.element.createElement(RichText, {
                            tagName: "p",
                            placeholder: "Link",
                            className: "learnmore",
                            value: '' === quote.link ? 'Learn More' : quote.link,
                            onChange: function onChange(link) {
                                var newObject = Object.assign({}, quote, {
                                    link: link
                                });
                                setAttributes({
                                    quotes: [].concat(_toConsumableArray(quotes.filter(function (item) {
                                        return item.index != quote.index;
                                    })), [newObject])
                                });
                            }
                        })
                    );
                });
                return wp.element.createElement(
                    "div",
                    { id: "block-" + clientId, className: "quote-slider " + quotesOptions + " " + sliderBgColor },
                    wp.element.createElement(
                        InspectorControls,
                        null,
                        wp.element.createElement(
                            PanelBody,
                            { title: "General Settings" },
                            wp.element.createElement(
                                PanelRow,
                                null,
                                wp.element.createElement(ToggleControl, {
                                    label: __('Edit Slider'),
                                    checked: sliderActive,
                                    onChange: function onChange() {
                                        return setAttributes({ sliderActive: !sliderActive });
                                    }
                                })
                            ),
                            wp.element.createElement(
                                "label",
                                null,
                                "Text Color"
                            ),
                            wp.element.createElement(
                                "ul",
                                { className: "quote-color" },
                                wp.element.createElement("li", { className: "white-slider " + ('white-slider' === sliderBgColor ? 'active' : ''),
                                    onClick: function onClick(e) {
                                        setAttributes({ sliderBgColor: 'white-slider' });
                                    }
                                }),
                                wp.element.createElement("li", { className: "black-slider " + ('black-slider' === sliderBgColor ? 'active' : ''),
                                    onClick: function onClick(e) {
                                        setAttributes({ sliderBgColor: 'black-slider' });
                                    }
                                })
                            ),
                            wp.element.createElement(
                                "label",
                                null,
                                "Layout Options"
                            ),
                            wp.element.createElement(
                                PanelRow,
                                null,
                                wp.element.createElement(
                                    "ul",
                                    { className: "quote-options" },
                                    wp.element.createElement(
                                        "li",
                                        { onClick: function onClick() {
                                                setAttributes({ quotesOptions: 'quotes-options-1' });setTimeout(function () {
                                                    return _this2.reloadSlider();
                                                }, 10);
                                            }, className: 'quotes-options-1' === quotesOptions ? 'active' : '' },
                                        __WEBPACK_IMPORTED_MODULE_0__icons__["k" /* quotesSliderSide */]
                                    ),
                                    wp.element.createElement(
                                        "li",
                                        { onClick: function onClick() {
                                                setAttributes({ quotesOptions: 'quotes-options-2' });setTimeout(function () {
                                                    return _this2.reloadSlider();
                                                }, 10);
                                            }, className: 'quotes-options-2' === quotesOptions ? 'active' : '' },
                                        __WEBPACK_IMPORTED_MODULE_0__icons__["j" /* quotesSliderBottom */]
                                    )
                                )
                            )
                        ),
                        sliderActive && wp.element.createElement(
                            PanelBody,
                            { title: __('Slider Settings'), initialOpen: false },
                            wp.element.createElement(ToggleControl, {
                                label: __('Pager'),
                                checked: pager,
                                onChange: function onChange() {
                                    setAttributes({ pager: !pager });
                                }
                            }),
                            wp.element.createElement(ToggleControl, {
                                label: __('Controls'),
                                checked: controls,
                                onChange: function onChange() {
                                    return setAttributes({ controls: !controls });
                                }
                            }),
                            wp.element.createElement(ToggleControl, {
                                label: __('Autoplay'),
                                checked: autoplay,
                                onChange: function onChange() {
                                    return setAttributes({ autoplay: !autoplay });
                                }
                            }),
                            wp.element.createElement(ToggleControl, {
                                label: __('Infinite Loop'),
                                checked: infiniteLoop,
                                onChange: function onChange() {
                                    return setAttributes({ infiniteLoop: !infiniteLoop });
                                }
                            }),
                            wp.element.createElement(ToggleControl, {
                                label: __('Adaptive Height'),
                                checked: adaptiveHeight,
                                onChange: function onChange() {
                                    return setAttributes({ adaptiveHeight: !adaptiveHeight });
                                }
                            }),
                            wp.element.createElement(
                                "div",
                                { className: "inspector-field inspector-slider-speed" },
                                wp.element.createElement(
                                    "label",
                                    null,
                                    "Speed"
                                ),
                                wp.element.createElement(RangeControl, {
                                    value: speed,
                                    min: 100,
                                    max: 2000,
                                    onChange: function onChange(speed) {
                                        return setAttributes({ speed: speed });
                                    }
                                })
                            ),
                            wp.element.createElement(SelectControl, {
                                label: __('Slider Mode'),
                                value: mode,
                                options: [{ label: __('Horizontal'), value: 'horizontal' }, { label: __('Fade'), value: 'fade' }],
                                onChange: function onChange(value) {
                                    return setAttributes({ mode: value });
                                }
                            })
                        )
                    ),
                    wp.element.createElement(
                        "div",
                        { className: className + " quote-inner" },
                        quotesList
                    ),
                    wp.element.createElement(
                        "div",
                        { className: "add-remove-btn" },
                        1 < quotes.length && false === sliderActive ? wp.element.createElement(
                            "button",
                            {
                                className: "components-button current",
                                onClick: function onClick() {
                                    setAttributes({ sliderActive: true });
                                }
                            },
                            wp.element.createElement("span", { className: "dashicons dashicons-yes" })
                        ) : '',
                        wp.element.createElement(
                            "button",
                            {
                                className: "components-button add",
                                onClick: function onClick(content) {
                                    setAttributes({
                                        sliderActive: false,
                                        quotes: [].concat(_toConsumableArray(quotes), [{
                                            index: quotes.length,
                                            title: '',
                                            content: '',
                                            author: '',
                                            link: '',
                                            area: ''
                                        }])
                                    });
                                }
                            },
                            wp.element.createElement("span", { className: "dashicons dashicons-plus" })
                        )
                    )
                );
            }
        }]);

        return QuotesSlider;
    }(Component);

    registerBlockType('md/quotes-slider-block', {

        title: __('Quotes Slider'),
        icon: { src: quoteBlockIcon },
        category: 'nabshow',
        keywords: [__('quotes Slider'), __('gts')],

        attributes: {
            id: {
                type: 'string',
                default: ''
            },
            quotes: {
                type: 'array',
                default: []
            },
            sliderActive: {
                type: 'boolean',
                default: false
            },
            quotesOptions: {
                type: 'string',
                default: 'quotes-options-1'
            },
            autoplay: {
                type: 'boolean',
                default: false
            },
            infiniteLoop: {
                type: 'boolean',
                default: true
            },
            pager: {
                type: 'boolean',
                default: false
            },
            controls: {
                type: 'boolean',
                default: true
            },
            adaptiveHeight: {
                type: 'boolean',
                default: true
            },
            speed: {
                type: 'number',
                default: 500
            },
            mode: {
                type: 'string',
                default: 'horizontal'
            },
            sliderBgColor: {
                type: 'string',
                default: 'white-slider'
            }
        },

        // edit Component
        edit: QuotesSlider,

        save: function save(props) {
            var _props$attributes5 = props.attributes,
                quotes = _props$attributes5.quotes,
                quotesOptions = _props$attributes5.quotesOptions,
                autoplay = _props$attributes5.autoplay,
                infiniteLoop = _props$attributes5.infiniteLoop,
                pager = _props$attributes5.pager,
                controls = _props$attributes5.controls,
                adaptiveHeight = _props$attributes5.adaptiveHeight,
                speed = _props$attributes5.speed,
                mode = _props$attributes5.mode,
                sliderBgColor = _props$attributes5.sliderBgColor;


            var quotesList = quotes.map(function (quote) {
                var quoteClass = 0 == quote.index ? 'quote-item active' : 'quote-item';
                return wp.element.createElement(
                    "div",
                    { className: quoteClass, key: quote.index },
                    wp.element.createElement(
                        "div",
                        { className: "content-block" },
                        quote.title && wp.element.createElement(RichText.Content, {
                            tagName: "h3",
                            className: "title",
                            value: quote.title
                        }),
                        quote.content && wp.element.createElement(RichText.Content, {
                            tagName: "p",
                            className: "content",
                            value: quote.content
                        }),
                        quote.author && 'quotes-options-2' === quotesOptions && wp.element.createElement(RichText.Content, {
                            tagName: "strong",
                            className: "author",
                            value: quote.author
                        }),
                        'quotes-options-1' === quotesOptions && wp.element.createElement(RichText.Content, {
                            tagName: "p",
                            className: "learnmore",
                            value: '' === quote.link ? 'Learn More' : quote.link
                        })
                    )
                );
            });
            if (0 < quotes.length) {
                return wp.element.createElement(
                    "div",
                    { className: "quote-slider " + quotesOptions + " " + sliderBgColor },
                    wp.element.createElement(
                        "div",
                        { className: "quote-inner", "data-mode": mode, "data-autoplay": "" + autoplay, "data-speed": "" + speed, "data-infiniteloop": "" + infiniteLoop, "data-pager": "" + pager, "data-controls": "" + controls, "data-adaptiveheight": "" + adaptiveHeight },
                        quotesList
                    )
                );
            } else {
                return null;
            }
        }
    });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);

/***/ }),
/* 102 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__icons__ = __webpack_require__(3);
var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _toConsumableArray(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } else { return Array.from(arr); } }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }



(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    var __ = wpI18n.__;
    var Component = wpElement.Component,
        Fragment = wpElement.Fragment;
    var registerBlockType = wpBlocks.registerBlockType;
    var InspectorControls = wpEditor.InspectorControls;
    var PanelBody = wpComponents.PanelBody,
        Disabled = wpComponents.Disabled,
        ToggleControl = wpComponents.ToggleControl,
        SelectControl = wpComponents.SelectControl,
        TextControl = wpComponents.TextControl,
        ServerSideRender = wpComponents.ServerSideRender,
        CheckboxControl = wpComponents.CheckboxControl,
        RangeControl = wpComponents.RangeControl;


    var notToBeMissedBlockIcon = wp.element.createElement(
        "svg",
        { width: "150px", height: "150px", viewBox: "266 266 150 150", "enable-background": "new 266 266 150 150" },
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M403.72,325.373h-4.612c-3.82,0-6.918,3.097-6.918,6.918v55.352c0,1.274-1.033,2.307-2.308,2.307h-96.865\r c-1.273,0-2.307-1.032-2.307-2.307v-55.352c0-3.821-3.097-6.918-6.917-6.918h-4.614c-3.82,0-6.919,3.097-6.919,6.918v69.189\r c0,3.821,3.098,6.919,6.919,6.919H403.72c3.82,0,6.919-3.098,6.919-6.919v-69.189C410.639,328.47,407.54,325.373,403.72,325.373z\r M406.026,401.48c0,1.274-1.032,2.306-2.307,2.306H279.179c-1.273,0-2.306-1.031-2.306-2.306v-69.189\r c0-1.274,1.033-2.306,2.306-2.306h4.614c1.273,0,2.305,1.032,2.305,2.306v55.352c0,3.821,3.097,6.919,6.919,6.919h96.865\r c3.822,0,6.92-3.098,6.92-6.919v-55.352c0-1.274,1.032-2.306,2.306-2.306h4.612c1.274,0,2.307,1.032,2.307,2.306V401.48\r L406.026,401.48z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M323,332.291c0-3.821-3.097-6.918-6.92-6.918h-13.837c-3.821,0-6.92,3.097-6.92,6.918v13.838\r c0,3.821,3.098,6.919,6.92,6.919h13.837c3.823,0,6.92-3.098,6.92-6.919V332.291z M318.387,346.129c0,1.273-1.033,2.306-2.308,2.306\r h-13.837c-1.274,0-2.306-1.032-2.306-2.306v-13.838c0-1.274,1.032-2.306,2.306-2.306h13.837c1.274,0,2.308,1.032,2.308,2.306\r V346.129L318.387,346.129z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M316.08,357.659h-13.837c-3.821,0-6.919,3.099-6.919,6.92v13.839c0,3.819,3.098,6.917,6.919,6.917h13.837\r c3.823,0,6.92-3.098,6.92-6.917v-13.839C323,360.758,319.902,357.659,316.08,357.659z M318.387,378.418\r c0,1.273-1.033,2.305-2.308,2.305h-13.837c-1.274,0-2.306-1.031-2.306-2.305v-13.839c0-1.274,1.032-2.306,2.306-2.306h13.837\r c1.274,0,2.308,1.032,2.308,2.306V378.418L318.387,378.418z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M334.531,385.334h13.837c3.821,0,6.92-3.097,6.92-6.916v-13.839c0-3.821-3.099-6.92-6.92-6.92h-13.837\r c-3.821,0-6.919,3.099-6.919,6.92v13.839C327.612,382.237,330.71,385.334,334.531,385.334z M332.225,364.579\r c0-1.274,1.032-2.306,2.306-2.306h13.837c1.274,0,2.305,1.032,2.305,2.306v13.839c0,1.273-1.03,2.305-2.305,2.305h-13.837\r c-1.274,0-2.306-1.031-2.306-2.305V364.579z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M387.576,332.291c0-3.821-3.097-6.918-6.919-6.918h-13.838c-3.823,0-6.92,3.097-6.92,6.918v13.838\r c0,3.821,3.097,6.919,6.92,6.919h13.838c3.821,0,6.919-3.098,6.919-6.919V332.291z M382.964,346.129\r c0,1.273-1.032,2.306-2.307,2.306h-13.838c-1.273,0-2.308-1.032-2.308-2.306v-13.838c0-1.274,1.034-2.306,2.308-2.306h13.838\r c1.274,0,2.307,1.032,2.307,2.306V346.129z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M380.657,357.659h-13.838c-3.822,0-6.92,3.099-6.92,6.92v13.839c0,3.819,3.098,6.917,6.92,6.917h13.838\r c3.822,0,6.919-3.098,6.919-6.917v-13.839C387.576,360.758,384.479,357.659,380.657,357.659z M382.964,378.418\r c0,1.273-1.032,2.305-2.307,2.305h-13.838c-1.273,0-2.308-1.031-2.308-2.305v-13.839c0-1.274,1.034-2.306,2.308-2.306h13.838\r c1.274,0,2.307,1.032,2.307,2.306V378.418z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M343.756,313.84v-30.374c0.004-2.797-1.677-5.323-4.261-6.398c-2.582-1.076-5.558-0.488-7.541,1.485\r l-6.228,6.227l-12.629-12.611c-2.703-2.701-7.081-2.701-9.783,0l-8.146,8.148c-2.701,2.701-2.701,7.081,0,9.784l12.622,12.623\r l-6.228,6.226c-1.977,1.979-2.567,4.957-1.495,7.541c1.073,2.584,3.595,4.27,6.395,4.268h30.374\r C340.657,320.759,343.756,317.661,343.756,313.84z M304.317,314.717c-0.367-0.855-0.169-1.848,0.497-2.498l7.864-7.864\r c0.901-0.901,0.901-2.36,0-3.262l-14.25-14.253c-0.9-0.9-0.9-2.36,0-3.26l8.145-8.146c0.902-0.9,2.361-0.9,3.262,0l14.253,14.253\r c0.9,0.9,2.36,0.9,3.261,0l7.864-7.865c0.663-0.657,1.655-0.85,2.513-0.49c0.861,0.36,1.419,1.204,1.417,2.135v30.374\r c0,1.273-1.033,2.306-2.306,2.306h-30.374C305.521,316.16,304.667,315.592,304.317,314.717z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M332.225,300.002c-1.275,0-2.308,1.033-2.308,2.306v4.613h-4.612c-1.272,0-2.305,1.033-2.305,2.307\r c0,1.273,1.033,2.306,2.305,2.306h4.612c2.548,0,4.614-2.065,4.614-4.613v-4.613C334.531,301.035,333.498,300.002,332.225,300.002z"
        })
    );

    var NabNTBMSlider = function (_Component) {
        _inherits(NabNTBMSlider, _Component);

        function NabNTBMSlider() {
            _classCallCheck(this, NabNTBMSlider);

            var _this = _possibleConstructorReturn(this, (NabNTBMSlider.__proto__ || Object.getPrototypeOf(NabNTBMSlider)).apply(this, arguments));

            _this.state = {
                bxSliderObj: {},
                bxinit: false,
                taxonomiesList: [],
                taxonomies: [],
                taxonomiesObj: {},
                termsObj: {},
                filterTermsObj: {},
                isDisable: false,
                title: null
            };

            _this.initSlider = _this.initSlider.bind(_this);
            return _this;
        }

        _createClass(NabNTBMSlider, [{
            key: "componentWillMount",
            value: function componentWillMount() {
                var _this2 = this;

                var taxonomies = this.props.attributes.taxonomies;

                // Fetch all taxonomies

                wp.apiFetch({ path: '/wp/v2/taxonomies' }).then(function (taxonomies) {
                    _this2.setState({ taxonomiesObj: taxonomies });
                    _this2.filterTaxonomy();
                });

                // Fetch all terms
                wp.apiFetch({ path: '/nab_api/request/all_terms' }).then(function (terms) {
                    _this2.setState({ termsObj: terms, filterTermsObj: terms, taxonomies: taxonomies });
                });
            }
        }, {
            key: "filterTaxonomy",
            value: function filterTaxonomy() {
                var postType = this.props.attributes.postType;

                var postTaxonomiesOptions = [],
                    taxonomies = this.state.taxonomiesObj,
                    taxonomyKey = Object.keys(taxonomies);
                taxonomyKey.forEach(function (key) {
                    if (postType === taxonomies[key].types[0]) {
                        postTaxonomiesOptions.push({ label: __(taxonomies[key].name), value: __(taxonomies[key].slug) });
                    }
                });
                this.setState({ taxonomiesList: postTaxonomiesOptions });
            }
        }, {
            key: "filterTerms",
            value: function filterTerms(value, taxonomy) {
                var _this3 = this;

                var filterTerms = {};
                this.state.taxonomies.map(function (tax) {
                    if (taxonomy === tax) {
                        filterTerms[tax] = _this3.state.termsObj[tax].filter(function (term) {
                            return -1 < term.name.toLowerCase().indexOf(value.toLowerCase());
                        });
                    } else {
                        filterTerms[tax] = _this3.state.termsObj[tax];
                    }
                });
                this.setState({ filterTermsObj: filterTerms });
            }
        }, {
            key: "componentDidMount",
            value: function componentDidMount() {
                var _props = this.props,
                    clientId = _props.clientId,
                    blockTitle = _props.attributes.blockTitle,
                    setAttributes = _props.setAttributes;

                this.setState({ bxinit: true, title: blockTitle });
                setAttributes({ clientId: clientId });
            }
        }, {
            key: "componentDidUpdate",
            value: function componentDidUpdate() {
                var _this4 = this;

                var _props2 = this.props,
                    clientId = _props2.clientId,
                    _props2$attributes = _props2.attributes,
                    minSlides = _props2$attributes.minSlides,
                    autoplay = _props2$attributes.autoplay,
                    infiniteLoop = _props2$attributes.infiniteLoop,
                    pager = _props2$attributes.pager,
                    controls = _props2$attributes.controls,
                    sliderSpeed = _props2$attributes.sliderSpeed,
                    sliderMode = _props2$attributes.sliderMode,
                    slideWidth = _props2$attributes.slideWidth,
                    sliderActive = _props2$attributes.sliderActive,
                    slideMargin = _props2$attributes.slideMargin;

                if (sliderActive) {
                    if (this.state.bxinit) {
                        setTimeout(function () {
                            return _this4.initSlider();
                        }, 500);
                        this.setState({ bxinit: false });
                    } else {
                        if (0 < jQuery("#block-" + clientId + " .nab-not-to-be-missed-slider").length && this.state.bxSliderObj && undefined !== this.state.bxSliderObj.reloadSlider) {

                            this.state.bxSliderObj.reloadSlider({
                                minSlides: minSlides,
                                maxSlides: minSlides,
                                moveSlides: 1,
                                slideMargin: slideMargin,
                                slideWidth: slideWidth,
                                auto: autoplay,
                                infiniteLoop: infiniteLoop,
                                pager: pager,
                                controls: controls,
                                speed: sliderSpeed,
                                mode: sliderMode
                            });
                        }
                    }
                }
            }
        }, {
            key: "initSlider",
            value: function initSlider() {
                var clientId = this.props.clientId;

                if (0 < jQuery("#block-" + clientId + " .nab-not-to-be-missed-slider").length) {
                    var _props$attributes = this.props.attributes,
                        minSlides = _props$attributes.minSlides,
                        autoplay = _props$attributes.autoplay,
                        infiniteLoop = _props$attributes.infiniteLoop,
                        pager = _props$attributes.pager,
                        controls = _props$attributes.controls,
                        sliderSpeed = _props$attributes.sliderSpeed,
                        sliderMode = _props$attributes.sliderMode,
                        slideWidth = _props$attributes.slideWidth,
                        slideMargin = _props$attributes.slideMargin;

                    var sliderObj = jQuery("#block-" + clientId + " .nab-not-to-be-missed-slider").bxSlider({ minSlides: minSlides, maxSlides: minSlides, slideMargin: slideMargin, moveSlides: 1, slideWidth: slideWidth, auto: autoplay, infiniteLoop: infiniteLoop, pager: pager, controls: controls, speed: sliderSpeed, mode: sliderMode });
                    this.setState({ bxSliderObj: sliderObj, bxinit: false, isDisable: false });
                } else {
                    this.setState({ bxinit: true });
                }
            }
        }, {
            key: "isEmpty",
            value: function isEmpty(obj) {
                var key = void 0;
                for (key in obj) {
                    if (obj.hasOwnProperty(key)) {
                        return false;
                    }
                }
                return true;
            }
        }, {
            key: "render",
            value: function render() {
                var _this5 = this;

                var _props3 = this.props,
                    attributes = _props3.attributes,
                    setAttributes = _props3.setAttributes;
                var itemToFetch = attributes.itemToFetch,
                    minSlides = attributes.minSlides,
                    autoplay = attributes.autoplay,
                    infiniteLoop = attributes.infiniteLoop,
                    pager = attributes.pager,
                    controls = attributes.controls,
                    sliderSpeed = attributes.sliderSpeed,
                    sliderActive = attributes.sliderActive,
                    sliderMode = attributes.sliderMode,
                    postType = attributes.postType,
                    taxonomies = attributes.taxonomies,
                    terms = attributes.terms,
                    slideWidth = attributes.slideWidth,
                    orderBy = attributes.orderBy,
                    slideMargin = attributes.slideMargin,
                    arrowIcons = attributes.arrowIcons,
                    blockTitle = attributes.blockTitle;


                var names = [{ name: __WEBPACK_IMPORTED_MODULE_0__icons__["l" /* sliderArrow1 */], classnames: 'slider-arrow-1' }, { name: __WEBPACK_IMPORTED_MODULE_0__icons__["m" /* sliderArrow2 */], classnames: 'slider-arrow-2' }, { name: __WEBPACK_IMPORTED_MODULE_0__icons__["n" /* sliderArrow3 */], classnames: 'slider-arrow-3' }, { name: __WEBPACK_IMPORTED_MODULE_0__icons__["o" /* sliderArrow4 */], classnames: 'slider-arrow-4' }, { name: __WEBPACK_IMPORTED_MODULE_0__icons__["p" /* sliderArrow5 */], classnames: 'slider-arrow-5' }, { name: __WEBPACK_IMPORTED_MODULE_0__icons__["q" /* sliderArrow6 */], classnames: 'slider-arrow-6' }, { name: __WEBPACK_IMPORTED_MODULE_0__icons__["r" /* sliderArrow7 */], classnames: 'slider-arrow-7' }, { name: __WEBPACK_IMPORTED_MODULE_0__icons__["s" /* sliderArrow8 */], classnames: 'slider-arrow-8' }];

                var isCheckedTerms = {};
                if (!this.isEmpty(terms) && terms.constructor !== Object) {
                    isCheckedTerms = JSON.parse(terms);
                }

                var input = wp.element.createElement(
                    "div",
                    { className: "inspector-field inspector-field-Numberofitems " },
                    wp.element.createElement(
                        "label",
                        { className: "inspector-mb-0" },
                        "Number of items"
                    ),
                    wp.element.createElement(RangeControl, {
                        value: itemToFetch,
                        min: 1,
                        max: 100,
                        onChange: function onChange(item) {
                            setAttributes({ itemToFetch: parseInt(item) });_this5.setState({ bxinit: true, isDisable: true });
                        }
                    })
                );

                if (this.state.isDisable && sliderActive && !isNaN(itemToFetch)) {
                    input = wp.element.createElement(
                        Disabled,
                        null,
                        input
                    );
                }

                return wp.element.createElement(
                    Fragment,
                    null,
                    wp.element.createElement(
                        InspectorControls,
                        null,
                        wp.element.createElement(
                            PanelBody,
                            { title: __('Data Settings '), initialOpen: true, className: "range-setting" },
                            wp.element.createElement(TextControl, {
                                label: "Section Title",
                                type: "string",
                                value: this.state.title,
                                onChange: function onChange(title) {
                                    return _this5.setState({ title: title });
                                },
                                onBlur: function onBlur() {
                                    setAttributes({ blockTitle: _this5.state.title });_this5.setState({ bxinit: true });
                                }
                            }),
                            input,
                            wp.element.createElement(SelectControl, {
                                label: __('Order by'),
                                value: orderBy,
                                options: [{ label: __('Newest to Oldest'), value: 'date' }, { label: __('Menu Order'), value: 'menu_order' }],
                                onChange: function onChange(value) {
                                    setAttributes({ orderBy: value });_this5.setState({ bxinit: true });
                                }
                            }),
                            0 < this.state.taxonomiesList.length && wp.element.createElement(
                                Fragment,
                                null,
                                wp.element.createElement(
                                    "label",
                                    null,
                                    __('Select Taxonomy')
                                ),
                                wp.element.createElement(
                                    "div",
                                    { className: "fix-height-select" },
                                    this.state.taxonomiesList.map(function (taxonomy, index) {
                                        return wp.element.createElement(
                                            Fragment,
                                            { key: index },
                                            wp.element.createElement(CheckboxControl, { checked: -1 < taxonomies.indexOf(taxonomy.value), label: taxonomy.label, name: "taxonomy[]", value: taxonomy.value, onChange: function onChange(isChecked) {

                                                    var index = void 0,
                                                        tempTaxonomies = [].concat(_toConsumableArray(taxonomies)),
                                                        tempTerms = terms;

                                                    if (isChecked) {
                                                        tempTaxonomies.push(taxonomy.value);
                                                    } else {
                                                        index = tempTaxonomies.indexOf(taxonomy.value);
                                                        tempTaxonomies.splice(index, 1);
                                                        if (!_this5.isEmpty(tempTerms)) {
                                                            tempTerms = JSON.parse(tempTerms);
                                                            delete tempTerms[taxonomy.value];
                                                            tempTerms = JSON.stringify(tempTerms);
                                                            _this5.props.setAttributes({ terms: tempTerms });
                                                            _this5.setState({ bxinit: true });
                                                        }
                                                    }
                                                    if (tempTerms.constructor === Object) {
                                                        tempTerms = JSON.stringify(tempTerms);
                                                    }
                                                    _this5.props.setAttributes({ terms: tempTerms, taxonomies: tempTaxonomies });
                                                    _this5.setState({ taxonomies: tempTaxonomies });
                                                }
                                            })
                                        );
                                    })
                                )
                            ),
                            0 < this.state.taxonomies.length && wp.element.createElement(
                                Fragment,
                                null,
                                this.state.taxonomies.map(function (taxonomy, index) {
                                    return undefined !== _this5.state.filterTermsObj[taxonomy] && wp.element.createElement(
                                        "div",
                                        { key: index },
                                        wp.element.createElement(
                                            "label",
                                            null,
                                            __("Select Filter Item from " + taxonomy)
                                        ),
                                        7 < _this5.state.termsObj[taxonomy].length && wp.element.createElement(TextControl, {
                                            type: "string",
                                            name: taxonomy,
                                            onChange: function onChange(value) {
                                                return _this5.filterTerms(value, taxonomy);
                                            }
                                        }),
                                        wp.element.createElement(
                                            "div",
                                            { className: "fix-height-select" },
                                            _this5.state.filterTermsObj[taxonomy].map(function (term, index) {
                                                return wp.element.createElement(
                                                    Fragment,
                                                    { key: index },
                                                    wp.element.createElement(CheckboxControl, { checked: isCheckedTerms[taxonomy] !== undefined && isCheckedTerms[taxonomy][term.slug], label: term.name, name: taxonomy + "[]", value: term.slug, onChange: function onChange(isChecked) {

                                                            var tempTerms = terms;
                                                            if (!_this5.isEmpty(tempTerms)) {
                                                                tempTerms = JSON.parse(tempTerms);
                                                            }
                                                            if (isChecked) {
                                                                if (tempTerms[taxonomy] === undefined) {
                                                                    tempTerms[taxonomy] = {};
                                                                    tempTerms[taxonomy][term.slug] = { label: term.name, value: term.slug };
                                                                } else {
                                                                    tempTerms[taxonomy][term.slug] = { label: term.name, value: term.slug };
                                                                }
                                                            } else {
                                                                delete tempTerms[taxonomy][term.slug];
                                                            }
                                                            tempTerms = JSON.stringify(tempTerms);
                                                            _this5.props.setAttributes({ terms: tempTerms });
                                                            _this5.setState({ bxinit: true });
                                                        }
                                                    })
                                                );
                                            })
                                        )
                                    );
                                })
                            )
                        ),
                        wp.element.createElement(
                            PanelBody,
                            { title: __('Slider Settings '), initialOpen: false, className: "range-setting" },
                            wp.element.createElement(ToggleControl, {
                                label: __('Slider On/Off'),
                                checked: sliderActive,
                                onChange: function onChange() {
                                    setAttributes({ sliderActive: !sliderActive });_this5.setState({ bxinit: !sliderActive });
                                }
                            }),
                            sliderActive && wp.element.createElement(
                                Fragment,
                                null,
                                wp.element.createElement(ToggleControl, {
                                    label: __('Pager'),
                                    checked: pager,
                                    onChange: function onChange() {
                                        return setAttributes({ pager: !pager });
                                    }
                                }),
                                wp.element.createElement(ToggleControl, {
                                    label: __('Controls'),
                                    checked: controls,
                                    onChange: function onChange() {
                                        return setAttributes({ controls: !controls });
                                    }
                                }),
                                wp.element.createElement(ToggleControl, {
                                    label: __('Autoplay'),
                                    checked: autoplay,
                                    onChange: function onChange() {
                                        return setAttributes({ autoplay: !autoplay });
                                    }
                                }),
                                wp.element.createElement(ToggleControl, {
                                    label: __('Infinite Loop'),
                                    checked: infiniteLoop,
                                    onChange: function onChange() {
                                        return setAttributes({ infiniteLoop: !infiniteLoop });
                                    }
                                }),
                                wp.element.createElement(
                                    "div",
                                    { className: "inspector-field inspector-field-fontsize " },
                                    wp.element.createElement(
                                        "label",
                                        { className: "inspector-mb-0" },
                                        "Slide Speed"
                                    ),
                                    wp.element.createElement(RangeControl, {
                                        value: sliderSpeed,
                                        min: 100,
                                        max: 1000,
                                        step: 1,
                                        onChange: function onChange(speed) {
                                            return setAttributes({ sliderSpeed: parseInt(speed) });
                                        }
                                    })
                                ),
                                wp.element.createElement(
                                    "div",
                                    { className: "inspector-field inspector-field-fontsize " },
                                    wp.element.createElement(
                                        "label",
                                        { className: "inspector-mb-0" },
                                        "Items to Display"
                                    ),
                                    wp.element.createElement(RangeControl, {
                                        value: minSlides,
                                        min: 1,
                                        max: 10,
                                        step: 1,
                                        onChange: function onChange(slide) {
                                            return setAttributes({ minSlides: parseInt(slide) });
                                        }
                                    })
                                ),
                                wp.element.createElement(
                                    "div",
                                    { className: "inspector-field inspector-field-fontsize " },
                                    wp.element.createElement(
                                        "label",
                                        { className: "inspector-mb-0" },
                                        "Slide Width"
                                    ),
                                    wp.element.createElement(RangeControl, {
                                        value: slideWidth,
                                        min: 50,
                                        max: 1000,
                                        step: 1,
                                        onChange: function onChange(width) {
                                            return setAttributes({ slideWidth: parseInt(width) });
                                        }
                                    })
                                ),
                                wp.element.createElement(
                                    "div",
                                    { className: "inspector-field inspector-field-fontsize " },
                                    wp.element.createElement(
                                        "label",
                                        { className: "inspector-mb-0" },
                                        "Slide Margin"
                                    ),
                                    wp.element.createElement(RangeControl, {
                                        value: slideMargin,
                                        min: 0,
                                        max: 100,
                                        step: 1,
                                        onChange: function onChange(width) {
                                            return setAttributes({ slideMargin: parseInt(width) });
                                        }
                                    })
                                ),
                                wp.element.createElement(SelectControl, {
                                    label: __('Slider Mode/Effect'),
                                    value: sliderMode,
                                    options: [{ label: __('Horizontal'), value: 'horizontal' }, { label: __('Vertical'), value: 'vertical' }, { label: __('Fade'), value: 'fade' }],
                                    onChange: function onChange(value) {
                                        return setAttributes({ sliderMode: value });
                                    }
                                })
                            )
                        ),
                        wp.element.createElement(
                            PanelBody,
                            { title: __('Slider Arrow'), initialOpen: false, className: "range-setting" },
                            wp.element.createElement(
                                "ul",
                                { className: "slider-arrow-main" },
                                names.map(function (item, index) {
                                    return wp.element.createElement(
                                        Fragment,
                                        { key: index },
                                        wp.element.createElement(
                                            "li",
                                            {
                                                className: item.classnames + " " + (arrowIcons === item.classnames ? 'active' : ''),
                                                key: index,
                                                onClick: function onClick(e) {
                                                    setAttributes({ arrowIcons: item.classnames });
                                                    _this5.setState({ bxinit: true });
                                                }
                                            },
                                            item.name
                                        )
                                    );
                                })
                            )
                        )
                    ),
                    wp.element.createElement(ServerSideRender, {
                        block: "nab/not-to-be-missed-slider",
                        attributes: { itemToFetch: itemToFetch, postType: postType, terms: terms, sliderActive: sliderActive, orderBy: orderBy, arrowIcons: arrowIcons, blockTitle: blockTitle }
                    })
                );
            }
        }]);

        return NabNTBMSlider;
    }(Component);

    var blockAttrs = {
        blockTitle: {
            type: 'string',
            default: 'Not-To-Be-Missed'
        },
        itemToFetch: {
            type: 'number',
            default: 10
        },
        minSlides: {
            type: 'number',
            default: 4
        },
        autoplay: {
            type: 'boolean',
            default: false
        },
        infiniteLoop: {
            type: 'boolean',
            default: true
        },
        pager: {
            type: 'boolean',
            default: false
        },
        controls: {
            type: 'boolean',
            default: true
        },
        sliderSpeed: {
            type: 'number',
            default: 500
        },
        sliderActive: {
            type: 'boolean',
            default: true
        },
        sliderMode: {
            type: 'string',
            default: 'horizontal'
        },
        postType: {
            type: 'string',
            default: 'not-to-be-missed'
        },
        taxonomies: {
            type: 'array',
            default: []
        },
        terms: {
            type: 'string',
            default: {}
        },
        slideWidth: {
            type: 'number',
            default: 400
        },
        orderBy: {
            type: 'string',
            default: 'date'
        },
        slideMargin: {
            type: 'number',
            default: 30
        },
        arrowIcons: {
            type: 'string',
            default: 'slider-arrow-1'
        },
        clientId: {
            type: 'string',
            default: null
        }
    };
    registerBlockType('nab/not-to-be-missed-slider', {
        title: __('Not to be Missed Slider'),
        icon: { src: notToBeMissedBlockIcon },
        category: 'nabshow',
        keywords: [__('Not'), __('missed'), __('slider')],
        attributes: blockAttrs,
        edit: NabNTBMSlider,
        save: function save() {
            return null;
        }
    });
})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);

/***/ }),
/* 103 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__icons__ = __webpack_require__(3);
var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _toConsumableArray(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } else { return Array.from(arr); } }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }



(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    var __ = wpI18n.__;
    var Component = wpElement.Component,
        Fragment = wpElement.Fragment;
    var registerBlockType = wpBlocks.registerBlockType;
    var InspectorControls = wpEditor.InspectorControls;
    var PanelBody = wpComponents.PanelBody,
        SelectControl = wpComponents.SelectControl,
        TextControl = wpComponents.TextControl,
        ServerSideRender = wpComponents.ServerSideRender,
        CheckboxControl = wpComponents.CheckboxControl,
        RangeControl = wpComponents.RangeControl,
        PanelRow = wpComponents.PanelRow;


    var latestNewsBlockIcon = wp.element.createElement(
        "svg",
        { width: "150px", height: "150px", viewBox: "222.64 222.641 150 150", "enable-background": "new 222.64 222.641 150 150" },
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M361.149,232.16H257.783c-3.932,0-7.13,3.199-7.13,7.131v10.825h-16.521c-3.932,0-7.131,3.199-7.131,7.131\r v91.76c0,7.627,6.18,13.837,13.796,13.893h0.028c0.025,0.001,0.047,0.003,0.072,0.003h73.208c1.143,0,2.07-0.926,2.07-2.069\r c0-1.143-0.928-2.07-2.07-2.07h-63.323c2.478-2.51,4.011-5.957,4.011-9.756v-48.396c0-1.143-0.927-2.069-2.07-2.069\r c-1.144,0-2.069,0.926-2.069,2.069v48.396c0,5.361-4.348,9.726-9.704,9.755c-0.018,0-0.035-0.002-0.053-0.002\r c-5.38-0.001-9.757-4.376-9.757-9.753v-91.76c0-1.649,1.342-2.992,2.992-2.992h16.521v38.63c0,1.144,0.926,2.07,2.07,2.07\r c1.143,0,2.07-0.926,2.07-2.07v-53.595c0-1.65,1.342-2.992,2.991-2.992h103.365c1.65,0,2.992,1.342,2.992,2.992v109.717\r c0,5.38-4.377,9.756-9.757,9.756h-32.553c-1.144,0-2.069,0.927-2.069,2.069c0,1.145,0.926,2.07,2.069,2.07h32.554\r c7.662,0,13.896-6.233,13.896-13.896V239.291C368.28,235.359,365.081,232.16,361.149,232.16z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M272.342,314.738h28.383c2.7,0,4.897-2.197,4.897-4.897v-28.384c0-2.7-2.197-4.896-4.897-4.896h-28.383\r c-2.7,0-4.897,2.197-4.897,4.896v28.384C267.445,312.541,269.642,314.738,272.342,314.738z M271.584,281.457\r c0-0.418,0.34-0.757,0.758-0.757h28.383c0.418,0,0.758,0.339,0.758,0.757v28.384c0,0.417-0.34,0.759-0.758,0.759h-28.383\r c-0.418,0-0.758-0.342-0.758-0.759V281.457z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M313.146,280.699h38.41c1.143,0,2.07-0.926,2.07-2.069c0-1.144-0.928-2.07-2.07-2.07h-38.41\r c-1.143,0-2.069,0.926-2.069,2.07C311.076,279.773,312.003,280.699,313.146,280.699z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M313.146,297.719h38.41c1.143,0,2.07-0.927,2.07-2.07c0-1.144-0.928-2.069-2.07-2.069h-38.41\r c-1.143,0-2.069,0.926-2.069,2.069C311.076,296.792,312.003,297.719,313.146,297.719z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M313.146,314.738h38.41c1.143,0,2.07-0.928,2.07-2.07s-0.928-2.069-2.07-2.069h-38.41\r c-1.143,0-2.069,0.926-2.069,2.069C311.076,313.811,312.003,314.738,313.146,314.738z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M269.515,331.757h82.041c1.143,0,2.07-0.926,2.07-2.07c0-1.142-0.928-2.069-2.07-2.069h-82.041\r c-1.142,0-2.069,0.927-2.069,2.069C267.445,330.831,268.373,331.757,269.515,331.757z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M269.515,348.776h82.041c1.143,0,2.07-0.926,2.07-2.069s-0.928-2.07-2.07-2.07h-82.041\r c-1.142,0-2.069,0.927-2.069,2.07S268.373,348.776,269.515,348.776z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M267.498,265.97v-21.868c0-0.45,0.213-0.792,0.641-1.027c0.427-0.236,0.944-0.354,1.55-0.354\r c0.81,0,1.426,0.146,1.854,0.439c0.426,0.292,0.898,0.921,1.416,1.886l6.502,12.569v-13.546c0-0.449,0.213-0.786,0.64-1.011\r c0.426-0.225,0.943-0.338,1.55-0.338c0.606,0,1.123,0.113,1.549,0.338c0.427,0.225,0.641,0.562,0.641,1.011v21.901\r c0,0.428-0.22,0.765-0.658,1.011c-0.438,0.248-0.949,0.371-1.533,0.371c-1.191,0-2.034-0.46-2.527-1.382l-7.245-13.545v13.545\r c0,0.428-0.219,0.764-0.656,1.011c-0.438,0.248-0.95,0.371-1.534,0.371c-0.605,0-1.123-0.123-1.549-0.371\r C267.711,266.734,267.498,266.398,267.498,265.97z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M287.884,265.97v-21.868c0-0.427,0.191-0.763,0.573-1.011c0.381-0.247,0.83-0.371,1.348-0.371h11.996\r c0.448,0,0.792,0.192,1.027,0.574s0.354,0.82,0.354,1.314c0,0.539-0.124,1-0.371,1.381c-0.248,0.383-0.585,0.573-1.011,0.573h-9.536\r v6.739h5.122c0.426,0,0.763,0.174,1.011,0.522c0.247,0.348,0.371,0.758,0.371,1.23c0,0.427-0.118,0.814-0.354,1.163\r c-0.236,0.348-0.578,0.521-1.027,0.521h-5.122v6.773h9.536c0.426,0,0.763,0.191,1.011,0.572c0.247,0.383,0.371,0.843,0.371,1.382\r c0,0.494-0.118,0.932-0.354,1.314c-0.235,0.382-0.579,0.572-1.027,0.572h-11.996c-0.518,0-0.966-0.123-1.347-0.37\r C288.075,266.734,287.884,266.398,287.884,265.97z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M305.373,244.473c0-0.472,0.303-0.882,0.909-1.23s1.235-0.523,1.887-0.523c0.81,0,1.292,0.292,1.448,0.876\r l5.325,18.264l2.864-11.726c0.201-0.81,0.92-1.214,2.155-1.214c1.213,0,1.921,0.404,2.123,1.214l2.864,11.726l5.323-18.264\r c0.157-0.584,0.641-0.876,1.45-0.876c0.651,0,1.279,0.175,1.886,0.523c0.607,0.348,0.91,0.758,0.91,1.23\r c0,0.135-0.022,0.27-0.067,0.404l-6.672,21.194c-0.337,0.99-1.292,1.483-2.863,1.483c-0.674,0-1.281-0.13-1.819-0.388\r c-0.539-0.258-0.866-0.623-0.978-1.095l-2.156-9.097l-2.19,9.097c-0.113,0.472-0.438,0.837-0.978,1.095\r c-0.539,0.258-1.146,0.388-1.819,0.388c-0.696,0-1.313-0.13-1.853-0.388c-0.54-0.258-0.877-0.623-1.012-1.095l-6.672-21.194\r C305.395,244.742,305.373,244.607,305.373,244.473z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M335.631,262.477c0-0.516,0.196-1.039,0.59-1.567c0.393-0.527,0.836-0.791,1.331-0.791\r c0.291,0,0.623,0.14,0.994,0.42c0.37,0.279,0.729,0.589,1.078,0.927c0.348,0.338,0.848,0.648,1.5,0.928\r c0.65,0.28,1.37,0.419,2.155,0.419c1.079,0,1.977-0.247,2.696-0.742c0.719-0.494,1.078-1.223,1.078-2.189\r c0-0.675-0.197-1.275-0.59-1.803c-0.393-0.527-0.91-0.966-1.55-1.314s-1.342-0.686-2.105-1.011\r c-0.765-0.325-1.533-0.691-2.309-1.095c-0.775-0.404-1.482-0.859-2.122-1.365c-0.641-0.506-1.158-1.179-1.551-2.022\r c-0.393-0.842-0.589-1.803-0.589-2.88c0-1.208,0.241-2.275,0.725-3.198c0.482-0.924,1.128-1.642,1.937-2.155\r c0.809-0.513,1.673-0.889,2.595-1.128c0.92-0.239,1.898-0.36,2.932-0.36c0.583,0,1.201,0.041,1.854,0.122\r c0.65,0.081,1.342,0.213,2.072,0.398c0.729,0.184,1.324,0.473,1.785,0.864c0.46,0.393,0.691,0.854,0.691,1.385\r c0,0.5-0.158,1.018-0.472,1.552c-0.314,0.535-0.741,0.801-1.28,0.801c-0.203,0-0.754-0.213-1.651-0.64\r c-0.899-0.427-1.898-0.64-2.999-0.64c-1.214,0-2.151,0.23-2.813,0.691c-0.663,0.461-0.995,1.095-0.995,1.904\r c0,0.652,0.27,1.219,0.81,1.702c0.539,0.483,1.208,0.876,2.005,1.179c0.797,0.303,1.662,0.686,2.595,1.146\r c0.932,0.46,1.797,0.96,2.595,1.499c0.796,0.539,1.466,1.319,2.005,2.341c0.539,1.023,0.809,2.219,0.809,3.589\r c0,2.303-0.736,4.082-2.207,5.333c-1.473,1.251-3.409,1.877-5.813,1.877c-2.135,0-3.965-0.439-5.492-1.315\r C336.395,264.466,335.631,263.511,335.631,262.477z" })
    );

    var NabLatestShow = function (_Component) {
        _inherits(NabLatestShow, _Component);

        function NabLatestShow() {
            _classCallCheck(this, NabLatestShow);

            var _this = _possibleConstructorReturn(this, (NabLatestShow.__proto__ || Object.getPrototypeOf(NabLatestShow)).apply(this, arguments));

            _this.state = {
                postTypeList: [],
                taxonomiesList: [],
                taxonomies: [],
                taxonomiesObj: {},
                termsObj: {},
                filterTermsObj: {}
            };
            return _this;
        }

        _createClass(NabLatestShow, [{
            key: "componentWillMount",
            value: function componentWillMount() {
                var _this2 = this;

                var taxonomies = this.props.attributes.taxonomies;

                var postTypeKey = void 0,
                    postOptions = [],
                    excludePostTypes = ['attachment', 'page', 'wp_block'];

                // Fetch all post types
                wp.apiFetch({ path: '/wp/v2/types' }).then(function (postTypes) {
                    postTypeKey = Object.keys(postTypes).filter(function (postType) {
                        return !excludePostTypes.includes(postType);
                    });
                    postTypeKey.forEach(function (key) {
                        postOptions.push({
                            label: __(postTypes[key].name),
                            value: __(postTypes[key].slug)
                        });
                    });
                    _this2.setState({ postTypeList: postOptions });
                });

                //Fetch all taxonomies
                wp.apiFetch({ path: '/wp/v2/taxonomies' }).then(function (taxonomies) {
                    _this2.setState({ taxonomiesObj: taxonomies });
                    _this2.filterTaxonomy();
                });

                // Fetch all terms
                wp.apiFetch({ path: '/nab_api/request/all_terms' }).then(function (terms) {
                    _this2.setState({
                        termsObj: terms,
                        filterTermsObj: terms,
                        taxonomies: taxonomies
                    });
                });
            }
        }, {
            key: "filterTaxonomy",
            value: function filterTaxonomy() {
                var postType = this.props.attributes.postType;

                var postTaxonomiesOptions = [],
                    taxonomies = this.state.taxonomiesObj,
                    taxonomyKey = Object.keys(taxonomies);
                taxonomyKey.forEach(function (key) {
                    if (postType === taxonomies[key].types[0]) {
                        postTaxonomiesOptions.push({
                            label: __(taxonomies[key].name),
                            value: __(taxonomies[key].slug)
                        });
                    }
                });
                this.setState({ taxonomiesList: postTaxonomiesOptions });
            }
        }, {
            key: "filterTerms",
            value: function filterTerms(value, taxonomy) {
                var _this3 = this;

                var filterTerms = {};
                this.state.taxonomies.map(function (tax) {
                    if (taxonomy === tax) {
                        filterTerms[tax] = _this3.state.termsObj[tax].filter(function (term) {
                            return -1 < term.name.toLowerCase().indexOf(value.toLowerCase());
                        });
                    } else {
                        filterTerms[tax] = _this3.state.termsObj[tax];
                    }
                });
                this.setState({ filterTermsObj: filterTerms });
            }
        }, {
            key: "componentDidUpdate",
            value: function componentDidUpdate(prevProps) {
                var postType = this.props.attributes.postType;

                if (postType !== prevProps.attributes.postType) {
                    this.filterTaxonomy();
                }
            }
        }, {
            key: "isEmpty",
            value: function isEmpty(obj) {
                var key = void 0;
                for (key in obj) {
                    if (obj.hasOwnProperty(key)) {
                        return false;
                    }
                }
                return true;
            }
        }, {
            key: "render",
            value: function render() {
                var _this4 = this;

                var _props = this.props,
                    attributes = _props.attributes,
                    setAttributes = _props.setAttributes;
                var itemToFetch = attributes.itemToFetch,
                    postType = attributes.postType,
                    postLayout = attributes.postLayout,
                    taxonomies = attributes.taxonomies,
                    terms = attributes.terms,
                    orderBy = attributes.orderBy;


                var isCheckedTerms = {};
                if (!this.isEmpty(terms) && terms.constructor !== Object) {
                    isCheckedTerms = JSON.parse(terms);
                }

                return wp.element.createElement(
                    Fragment,
                    null,
                    wp.element.createElement(
                        InspectorControls,
                        null,
                        wp.element.createElement(
                            PanelBody,
                            {
                                title: __('Data Settings '),
                                initialOpen: true,
                                className: "range-setting"
                            },
                            wp.element.createElement(
                                "div",
                                { className: "inspector-field inspector-field-Numberofitems " },
                                wp.element.createElement(
                                    "label",
                                    { className: "inspector-mb-0" },
                                    "Number of items"
                                ),
                                wp.element.createElement(RangeControl, {
                                    value: itemToFetch,
                                    min: 1,
                                    max: 100,
                                    onChange: function onChange(item) {
                                        setAttributes({ itemToFetch: parseInt(item) });
                                    }
                                })
                            ),
                            wp.element.createElement(
                                "div",
                                null,
                                wp.element.createElement(
                                    "label",
                                    null,
                                    "Select Layout"
                                ),
                                wp.element.createElement(
                                    PanelRow,
                                    null,
                                    wp.element.createElement(
                                        "ul",
                                        { className: "layout-options" },
                                        wp.element.createElement(
                                            "li",
                                            { className: 'default' === postLayout ? 'active' : '', onClick: function onClick() {
                                                    return setAttributes({ postLayout: 'default' });
                                                } },
                                            __WEBPACK_IMPORTED_MODULE_0__icons__["g" /* latestShowNews1 */]
                                        ),
                                        wp.element.createElement(
                                            "li",
                                            { className: 'left' === postLayout ? 'active' : '', onClick: function onClick() {
                                                    return setAttributes({ postLayout: 'left' });
                                                } },
                                            __WEBPACK_IMPORTED_MODULE_0__icons__["i" /* latestShowNews3 */]
                                        ),
                                        wp.element.createElement(
                                            "li",
                                            { className: 'top' === postLayout ? 'active full' : 'full', onClick: function onClick() {
                                                    return setAttributes({ postLayout: 'top' });
                                                } },
                                            __WEBPACK_IMPORTED_MODULE_0__icons__["h" /* latestShowNews2 */]
                                        )
                                    )
                                )
                            ),
                            wp.element.createElement(SelectControl, {
                                label: __('Order by'),
                                value: orderBy,
                                options: [{ label: __('Newest to Oldest'), value: 'date' }, { label: __('Menu Order'), value: 'menu_order' }],
                                onChange: function onChange(value) {
                                    setAttributes({ orderBy: value });
                                }
                            }),
                            wp.element.createElement(SelectControl, {
                                label: __('Select Post Type'),
                                value: postType,
                                options: this.state.postTypeList,
                                onChange: function onChange(value) {
                                    setAttributes({ postType: value, taxonomies: [], terms: {} });_this4.setState({ taxonomies: [] });
                                }
                            }),
                            0 < this.state.taxonomiesList.length && wp.element.createElement(
                                Fragment,
                                null,
                                wp.element.createElement(
                                    "label",
                                    null,
                                    " ",
                                    __('Select Taxonomy')
                                ),
                                wp.element.createElement(
                                    "div",
                                    { className: "fix-height-select" },
                                    this.state.taxonomiesList.map(function (taxonomy, index) {
                                        return wp.element.createElement(
                                            Fragment,
                                            { key: index },
                                            wp.element.createElement(CheckboxControl, {
                                                checked: -1 < taxonomies.indexOf(taxonomy.value),
                                                label: taxonomy.label,
                                                name: "taxonomy[]",
                                                value: taxonomy.value,
                                                onChange: function onChange(isChecked) {
                                                    var index = void 0,
                                                        tempTaxonomies = [].concat(_toConsumableArray(taxonomies)),
                                                        tempTerms = terms;

                                                    if (isChecked) {
                                                        tempTaxonomies.push(taxonomy.value);
                                                    } else {
                                                        index = tempTaxonomies.indexOf(taxonomy.value);
                                                        tempTaxonomies.splice(index, 1);
                                                        if (!_this4.isEmpty(tempTerms)) {
                                                            tempTerms = JSON.parse(tempTerms);
                                                            delete tempTerms[taxonomy.value];
                                                            tempTerms = JSON.stringify(tempTerms);
                                                        }
                                                    }
                                                    if (tempTerms.constructor === Object) {
                                                        tempTerms = JSON.stringify(tempTerms);
                                                    }
                                                    _this4.props.setAttributes({ terms: tempTerms, taxonomies: tempTaxonomies });
                                                    _this4.setState({ taxonomies: tempTaxonomies });
                                                }
                                            })
                                        );
                                    })
                                )
                            ),
                            0 < this.state.taxonomies.length && wp.element.createElement(
                                Fragment,
                                null,
                                this.state.taxonomies.map(function (taxonomy, index) {
                                    return undefined !== _this4.state.filterTermsObj[taxonomy] && wp.element.createElement(
                                        "div",
                                        { key: index },
                                        wp.element.createElement(
                                            "label",
                                            null,
                                            " ",
                                            __(taxonomy),
                                            " "
                                        ),
                                        wp.element.createElement(
                                            "div",
                                            { className: "search-cat-side" },
                                            7 < _this4.state.termsObj[taxonomy].length && wp.element.createElement(TextControl, {
                                                type: "string",
                                                name: taxonomy,
                                                placeHolder: "Search " + taxonomy,
                                                onChange: function onChange(value) {
                                                    return _this4.filterTerms(value, taxonomy);
                                                }
                                            })
                                        ),
                                        wp.element.createElement(
                                            "div",
                                            { className: "fix-height-select" },
                                            _this4.state.filterTermsObj[taxonomy].map(function (term, index) {
                                                return wp.element.createElement(
                                                    Fragment,
                                                    { key: index },
                                                    wp.element.createElement(CheckboxControl, {
                                                        checked: isCheckedTerms[taxonomy] !== undefined && -1 < isCheckedTerms[taxonomy].indexOf(term.slug),
                                                        label: term.name,
                                                        name: taxonomy + "[]",
                                                        value: term.slug,
                                                        onChange: function onChange(isChecked) {
                                                            var index = void 0,
                                                                tempTerms = terms;
                                                            if (!_this4.isEmpty(tempTerms)) {
                                                                tempTerms = JSON.parse(tempTerms);
                                                            }
                                                            if (isChecked) {
                                                                if (tempTerms[taxonomy] === undefined) {
                                                                    tempTerms[taxonomy] = [term.slug];
                                                                } else {
                                                                    tempTerms[taxonomy].push(term.slug);
                                                                }
                                                            } else {
                                                                index = tempTerms[taxonomy].indexOf(term.slug);
                                                                tempTerms[taxonomy].splice(index, 1);
                                                            }

                                                            tempTerms = JSON.stringify(tempTerms);
                                                            _this4.props.setAttributes({
                                                                terms: tempTerms
                                                            });
                                                        }
                                                    })
                                                );
                                            })
                                        )
                                    );
                                })
                            )
                        )
                    ),
                    wp.element.createElement(
                        "div",
                        { className: true },
                        wp.element.createElement(ServerSideRender, {
                            block: "nab/latest-show",
                            attributes: {
                                itemToFetch: itemToFetch,
                                postType: postType,
                                orderBy: orderBy,
                                taxonomies: taxonomies,
                                terms: terms,
                                postLayout: postLayout
                            }
                        })
                    )
                );
            }
        }]);

        return NabLatestShow;
    }(Component);

    var blockAttrs = {
        itemToFetch: {
            type: 'number',
            default: 1
        },
        postType: {
            type: 'string',
            default: 'post'
        },
        postLayout: {
            type: 'string',
            default: 'default'
        },
        taxonomies: {
            type: 'array',
            default: []
        },
        terms: {
            type: 'string',
            default: {}
        },
        orderBy: {
            type: 'string',
            default: 'date'
        }
    };
    registerBlockType('nab/latest-show', {
        title: __('Latest show news'),
        icon: { src: latestNewsBlockIcon },
        category: 'nabshow',
        keywords: [__('latest show'), __('news'), __('show')],
        attributes: blockAttrs,
        edit: NabLatestShow,
        save: function save() {
            return null;
        }
    });
})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);

/***/ }),
/* 104 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_lodash_times__ = __webpack_require__(15);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_lodash_times___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_lodash_times__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_memize__ = __webpack_require__(16);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_memize___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1_memize__);



(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
	var __ = wpI18n.__;
	var Fragment = wpElement.Fragment;
	var registerBlockType = wpBlocks.registerBlockType;
	var RichText = wpEditor.RichText,
	    InspectorControls = wpEditor.InspectorControls,
	    InnerBlocks = wpEditor.InnerBlocks;
	var TextControl = wpComponents.TextControl,
	    PanelBody = wpComponents.PanelBody,
	    PanelRow = wpComponents.PanelRow,
	    RangeControl = wpComponents.RangeControl,
	    SelectControl = wpComponents.SelectControl,
	    ToggleControl = wpComponents.ToggleControl,
	    ColorPalette = wpComponents.ColorPalette,
	    IconButton = wpComponents.IconButton;


	jQuery(document).on('click', '.accordionParentWrapper .accordionWrapper .accordionHeader .dashicons', function (e) {
		e.stopImmediatePropagation();
		jQuery(this).parent().parent().siblings().find('.accordionBody').slideUp();
		jQuery(this).parent().next().slideToggle();
		if (jQuery(this).parent().parent('.accordionWrapper').hasClass('tabClose')) {
			jQuery(this).parent().parent('.accordionWrapper').removeClass('tabClose').addClass('tabOpen');
			jQuery(this).parent().parent('.accordionWrapper').siblings().removeClass('tabOpen').addClass('tabClose');
		} else {
			jQuery(this).parent().parent('.accordionWrapper').removeClass('tabOpen').addClass('tabClose');
		}
	});

	var ALLOWBLOCKS = ['nab/accordion-item'];

	var removehildawardsBlock = __WEBPACK_IMPORTED_MODULE_1_memize___default()(function (accordion) {
		return __WEBPACK_IMPORTED_MODULE_0_lodash_times___default()(accordion, function (n) {
			return ['nab/accordion-item', { id: n - 1 }];
		});
	});

	var accordionBlockIcon = wp.element.createElement(
		'svg',
		{ width: '150px', height: '150px', viewBox: '0 0 150 150', 'enable-background': 'new 0 0 150 150' },
		wp.element.createElement('path', { fill: '#146DB6', d: 'M1,38.563v73.625h147.25V38.563H1z M139.047,102.984H10.203V66.172h128.844V102.984z' }),
		wp.element.createElement('path', { fill: '#146DB6', d: 'M1,1.75h147.25v27.609H1V1.75z' }),
		wp.element.createElement('path', { fill: '#146DB6', d: 'M1,121.391h147.25V149H1V121.391z' })
	);

	/* Parent Accordion Block */
	registerBlockType('nab/accordion', {
		title: __('Accordion'),
		description: __('Accordion is a gutenberg block used to show & hide content.'),
		icon: { src: accordionBlockIcon },
		category: 'nabshow',
		keywords: [__('accordion'), __('gutenberg'), __('nabshow')],
		attributes: {
			blockId: {
				type: 'string'
			},
			noOfAccordion: {
				type: 'number',
				default: 1
			},
			title: {
				type: 'string'
			},
			showTitle: {
				type: 'boolean',
				default: true
			},
			showFilter: {
				type: 'boolean',
				default: false
			}
		},
		edit: function edit(props) {
			var _props$attributes = props.attributes,
			    noOfAccordion = _props$attributes.noOfAccordion,
			    showTitle = _props$attributes.showTitle,
			    title = _props$attributes.title,
			    showFilter = _props$attributes.showFilter,
			    className = props.className,
			    setAttributes = props.setAttributes,
			    clientId = props.clientId;


			setAttributes({ blockId: clientId });

			jQuery(document).on('click', '#block-' + clientId + ' .remove-button', function (e) {
				if ('' !== jQuery(this).parents('#block-' + clientId)) {
					setAttributes({ noOfAccordion: noOfAccordion - 1 });
					removehildawardsBlock(noOfAccordion);
				}
			});

			return wp.element.createElement(
				Fragment,
				null,
				wp.element.createElement(
					InspectorControls,
					null,
					wp.element.createElement(
						PanelBody,
						{ title: 'General Settings' },
						wp.element.createElement(
							PanelRow,
							null,
							wp.element.createElement(ToggleControl, {
								label: __('Show Title'),
								checked: showTitle,
								onChange: function onChange() {
									return setAttributes({ showTitle: !showTitle });
								}
							})
						),
						wp.element.createElement(
							PanelRow,
							null,
							wp.element.createElement(ToggleControl, {
								label: __('Show Filter'),
								checked: showFilter,
								onChange: function onChange() {
									return setAttributes({ showFilter: !showFilter });
								}
							})
						)
					)
				),
				showFilter && wp.element.createElement(
					'div',
					{ className: 'fab-filter main-filter' },
					wp.element.createElement(
						'div',
						{ className: 'search-box' },
						wp.element.createElement(
							'label',
							null,
							'Keyword'
						),
						wp.element.createElement(
							'div',
							{ className: 'search-item' },
							wp.element.createElement('input', { id: 'box-main-search', className: 'search', name: 'faq-search', type: 'text', placeholder: 'Filter by keyword...' })
						)
					),
					wp.element.createElement(
						'div',
						{ className: 'keyword' },
						wp.element.createElement(
							'label',
							null,
							'Category'
						),
						wp.element.createElement(
							'div',
							null,
							wp.element.createElement(
								'select',
								{ id: 'faq-category-drp', className: 'faq-category-drp' },
								wp.element.createElement(
									'option',
									{ value: '' },
									'Select One'
								)
							)
						)
					)
				),
				wp.element.createElement(
					'div',
					{ id: clientId, className: 'accordionParentWrapper' + ' ' + className, 'data-category': title },
					showTitle ? wp.element.createElement(RichText, {
						tagName: 'h2',
						onChange: function onChange(value) {
							return setAttributes({ title: value });
						},
						placeholder: __('Category'),
						value: title,
						className: 'title'
					}) : '',
					wp.element.createElement(InnerBlocks, {
						allowedBlocks: ALLOWBLOCKS
					})
				)
			);
		},
		save: function save(props) {
			var _props$attributes2 = props.attributes,
			    title = _props$attributes2.title,
			    showTitle = _props$attributes2.showTitle,
			    showFilter = _props$attributes2.showFilter,
			    clientId = props.clientId;

			return wp.element.createElement(
				Fragment,
				null,
				showFilter && wp.element.createElement(
					'div',
					{ className: 'fab-filter main-filter' },
					wp.element.createElement(
						'div',
						{ className: 'search-box' },
						wp.element.createElement(
							'label',
							null,
							'Keyword'
						),
						wp.element.createElement(
							'div',
							{ className: 'search-item' },
							wp.element.createElement('input', { id: 'box-main-search', className: 'search', name: 'faq-search', type: 'text', placeholder: 'Filter by keyword...' })
						)
					),
					wp.element.createElement(
						'div',
						{ className: 'keyword' },
						wp.element.createElement(
							'label',
							null,
							'Category'
						),
						wp.element.createElement(
							'div',
							null,
							wp.element.createElement(
								'select',
								{ id: 'faq-category-drp', className: 'faq-category-drp' },
								wp.element.createElement(
									'option',
									{ value: '' },
									'Select One'
								)
							)
						)
					)
				),
				wp.element.createElement(
					'div',
					{ id: clientId, className: 'accordionParentWrapper', 'data-category': title },
					showTitle && title ? wp.element.createElement(RichText.Content, {
						tagName: 'h2',
						value: title,
						className: 'title'
					}) : '',
					wp.element.createElement(InnerBlocks.Content, null)
				)
			);
		}
	});

	/* Accordion Block */
	registerBlockType('nab/accordion-item', {
		title: __('Accordion Items'),
		description: __('This is nab accordion block with multiple setting.'),
		icon: { src: accordionBlockIcon },
		category: 'nabshow',
		parent: ['nab/accordion'],
		attributes: {
			title: {
				type: 'string',
				selector: 'h4'
			},
			open: {
				type: 'boolean',
				default: false
			},
			alignment: {
				type: 'string',
				default: 'unset'
			},
			headerTextFontSize: {
				type: 'number',
				default: 16
			},
			headerTextColor: {
				type: 'string',
				default: '#fff'
			},
			titleBackgroundColor: {
				type: 'string',
				default: '#f2f7fd'
			},
			PaddingTop: {
				type: 'string',
				default: '10'
			},
			PaddingRight: {
				type: 'string',
				default: '35'
			},
			PaddingBottom: {
				type: 'string',
				default: '10'
			},
			PaddingLeft: {
				type: 'string',
				default: '25'
			},
			BodyPaddingTop: {
				type: 'string',
				default: '20'
			},
			BodyPaddingRight: {
				type: 'string',
				default: '25'
			},
			BodyPaddingBottom: {
				type: 'string',
				default: '20'
			},
			BodyPaddingLeft: {
				type: 'string',
				default: '25'
			},
			bodyBgColor: {
				type: 'string',
				default: '#fff'
			},
			borderWidth: {
				type: 'number',
				default: 1
			},
			borderType: {
				type: 'string',
				default: 'solid'
			},
			borderColor: {
				type: 'string',
				default: '#fff'
			},
			borderRadius: {
				type: 'number',
				default: 0
			},
			fontFamily: {
				type: 'string',
				default: 'Gotham Bold'
			}
		},
		edit: function edit(props) {
			var attributes = props.attributes,
			    setAttributes = props.setAttributes,
			    className = props.className,
			    clientId = props.clientId;
			var title = attributes.title,
			    open = attributes.open,
			    alignment = attributes.alignment,
			    headerTextFontSize = attributes.headerTextFontSize,
			    headerTextColor = attributes.headerTextColor,
			    titleBackgroundColor = attributes.titleBackgroundColor,
			    PaddingTop = attributes.PaddingTop,
			    PaddingRight = attributes.PaddingRight,
			    PaddingBottom = attributes.PaddingBottom,
			    PaddingLeft = attributes.PaddingLeft,
			    BodyPaddingTop = attributes.BodyPaddingTop,
			    BodyPaddingRight = attributes.BodyPaddingRight,
			    BodyPaddingBottom = attributes.BodyPaddingBottom,
			    BodyPaddingLeft = attributes.BodyPaddingLeft,
			    bodyBgColor = attributes.bodyBgColor,
			    borderWidth = attributes.borderWidth,
			    borderType = attributes.borderType,
			    borderColor = attributes.borderColor,
			    borderRadius = attributes.borderRadius,
			    fontFamily = attributes.fontFamily;


			return wp.element.createElement(
				'div',
				{ className: className },
				wp.element.createElement(
					'div',
					{
						className: 'accordionWrapper ' + (open ? 'tabOpen' : 'tabClose'),
						style: {
							border: borderWidth + 'px ' + borderType + ' ' + borderColor,
							borderRadius: borderRadius + 'px'
						}
					},
					wp.element.createElement(
						'span',
						{ className: 'remove-button' },
						wp.element.createElement(IconButton, {
							className: 'components-toolbar__control',
							label: __('Remove image'),
							icon: 'no',
							onClick: function onClick() {
								wp.data.dispatch('core/editor').removeBlocks(clientId);
							}
						})
					),
					wp.element.createElement(
						'div',
						{
							className: 'accordionHeader',
							style: {
								backgroundColor: titleBackgroundColor,
								paddingTop: PaddingTop + 'px',
								paddingRight: PaddingRight + 'px',
								paddingBottom: PaddingBottom + 'px',
								paddingLeft: PaddingLeft + 'px',
								margin: 0,
								position: 'relative',
								color: headerTextColor
							}
						},
						wp.element.createElement(RichText, {
							tagName: 'h3',
							value: title,
							formattingControls: ['bold', 'italic'],
							style: {
								fontSize: headerTextFontSize + 'px',
								textAlign: alignment,
								color: headerTextColor,
								margin: 0,
								fontFamily: fontFamily
							},
							onChange: function onChange(value) {
								return setAttributes({ title: value });
							},
							placeholder: __('Question')
						}),
						wp.element.createElement('span', { className: 'dashicons fa fa-caret-down' })
					),
					wp.element.createElement(
						'div',
						{
							className: 'accordionBody',
							style: {
								backgroundColor: bodyBgColor,
								paddingTop: BodyPaddingTop + 'px',
								paddingRight: BodyPaddingRight + 'px',
								paddingBottom: BodyPaddingBottom + 'px',
								paddingLeft: BodyPaddingLeft + 'px',
								borderTop: borderWidth + 'px ' + borderType + ' ' + borderColor,
								display: open ? 'block' : 'none'
							}
						},
						wp.element.createElement(InnerBlocks, { templateLock: false })
					)
				),
				wp.element.createElement(
					InspectorControls,
					null,
					wp.element.createElement(
						PanelBody,
						{ title: 'General Setting' },
						wp.element.createElement(
							PanelRow,
							null,
							wp.element.createElement(ToggleControl, {
								label: __('This Accordion Open'),
								checked: !!open,
								onChange: function onChange() {
									return setAttributes({ open: !open });
								}
							})
						)
					),
					wp.element.createElement(
						PanelBody,
						{ title: 'Typography' },
						wp.element.createElement(
							PanelRow,
							null,
							wp.element.createElement(
								'div',
								{ className: 'inspector-field inspector-border-width' },
								wp.element.createElement(RangeControl, {
									label: __('Heading Font Size'),
									value: headerTextFontSize,
									min: '0',
									max: '100',
									step: '1',
									onChange: function onChange(value) {
										return setAttributes({ headerTextFontSize: value });
									}
								})
							)
						),
						wp.element.createElement(
							PanelRow,
							null,
							wp.element.createElement(
								'div',
								{ className: 'inspector-field inspector-field-fontfamily ' },
								wp.element.createElement(
									'label',
									{ className: 'inspector-mb-0' },
									'Font Family'
								),
								wp.element.createElement(SelectControl, {
									value: fontFamily,
									options: [{ label: __('Molot'), value: 'Molot' }, { label: __('Roboto Regular'), value: 'Roboto Regular' }, { label: __('Roboto Black'), value: 'Roboto Black' }, { label: __('Roboto Bold'), value: 'Roboto Bold' }, { label: __('Roboto BoldItalic'), value: 'Roboto BoldItalic' }, { label: __('Roboto Italic'), value: 'Roboto Italic' }, { label: __('Roboto Light'), value: 'Roboto Light' }, { label: __('Roboto Medium'), value: 'Roboto Medium' }, { label: __('Roboto Thin'), value: 'Roboto Thin' }, { label: __('Gotham Book'), value: 'Gotham Book' }, { label: __('Gotham Book Italic'), value: 'Gotham Book Italic' }, { label: __('Gotham Light'), value: 'Gotham Light' }, { label: __('Gotham Light Italic'), value: 'Gotham Light Italic' }, { label: __('Gotham Medium'), value: 'Gotham Medium' }, { label: __('Gotham Bold'), value: 'Gotham Bold' }, { label: __('Gotham Bold Italic'), value: 'Gotham Bold Italic' }, { label: __('Gotham Black Regular'), value: 'Gotham Black Regular' }, { label: __('Gotham Light Regular'), value: 'Gotham Light Regular' }, { label: __('Gotham Thin Regular'), value: 'Gotham Thin Regular' }, { label: __('Gotham XLight Regular'), value: 'Gotham XLight Regular' }, { label: __('Gotham Book Italic'), value: 'Gotham Book Italic' }, { label: __('Gotham Thin Italic'), value: 'Gotham Thin Italic' }, { label: __('Gotham Ultra Italic'), value: 'Gotham Ultra Italic' }, { label: __('Vollkorn Black'), value: 'Vollkorn Black' }, { label: __('Vollkorn BlackItalic'), value: 'Vollkorn BlackItalic' }, { label: __('Vollkorn Bold'), value: 'Vollkorn Bold' }, { label: __('Vollkorn BoldItalic'), value: 'Vollkorn BoldItalic' }, { label: __('Vollkorn Italic'), value: 'Vollkorn Italic' }, { label: __('Vollkorn Regular'), value: 'Vollkorn Regular' }, { label: __('Vollkorn SemiBold'), value: 'Vollkorn SemiBold' }, { label: __('Vollkorn SemiBoldItalic'), value: 'Vollkorn SemiBoldItalic' }],
									onChange: function onChange(value) {
										return setAttributes({ fontFamily: value });
									}
								})
							)
						),
						wp.element.createElement(
							PanelRow,
							null,
							wp.element.createElement(
								'div',
								{ className: 'inspector-field-alignment inspector-field inspector-responsive' },
								wp.element.createElement(
									'label',
									null,
									'Alignment'
								),
								wp.element.createElement(
									'div',
									{ className: 'inspector-field-button-list inspector-field-button-list-fluid' },
									wp.element.createElement(
										'button',
										{ className: 'left' === alignment ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
												return setAttributes({ alignment: 'left' });
											} },
										wp.element.createElement(
											'svg',
											{ width: '21', height: '18', viewBox: '0 0 21 18', xmlns: 'http://www.w3.org/2000/svg' },
											wp.element.createElement(
												'g',
												{ transform: 'translate(-29 -4) translate(29 4)', fill: 'none' },
												wp.element.createElement('path', { d: 'M1 .708v15.851', className: 'inspector-svg-stroke', 'stroke-linecap': 'square' }),
												wp.element.createElement('rect', { className: 'inspector-svg-fill', x: '5', y: '5', width: '16', height: '7', rx: '1' })
											)
										)
									),
									wp.element.createElement(
										'button',
										{ className: 'center' === alignment ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
												return setAttributes({ alignment: 'center' });
											} },
										wp.element.createElement(
											'svg',
											{ width: '16', height: '18', viewBox: '0 0 16 18', xmlns: 'http://www.w3.org/2000/svg' },
											wp.element.createElement(
												'g',
												{ transform: 'translate(-115 -4) translate(115 4)', fill: 'none' },
												wp.element.createElement('path', { d: 'M8 .708v15.851', className: 'inspector-svg-stroke', 'stroke-linecap': 'square' }),
												wp.element.createElement('rect', { className: 'inspector-svg-fill', y: '5', width: '16', height: '7', rx: '1' })
											)
										)
									),
									wp.element.createElement(
										'button',
										{ className: 'Right' === alignment ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
												return setAttributes({ alignment: 'Right' });
											} },
										wp.element.createElement(
											'svg',
											{ width: '21', height: '18', viewBox: '0 0 21 18', xmlns: 'http://www.w3.org/2000/svg' },
											wp.element.createElement(
												'g',
												{ transform: 'translate(0 1) rotate(-180 10.5 8.5)', fill: 'none' },
												wp.element.createElement('path', { d: 'M1 .708v15.851', className: 'inspector-svg-stroke', 'stroke-linecap': 'square' }),
												wp.element.createElement('rect', { className: 'inspector-svg-fill', 'fill-rule': 'nonzero', x: '5', y: '5', width: '16', height: '7', rx: '1' })
											)
										)
									)
								)
							)
						),
						wp.element.createElement(
							PanelRow,
							null,
							wp.element.createElement(
								'div',
								{ className: 'inspector-field inspector-field-color ' },
								wp.element.createElement(
									'label',
									{ className: 'inspector-mb-0' },
									'Text Color'
								),
								wp.element.createElement(
									'div',
									{ className: 'inspector-ml-auto' },
									wp.element.createElement(ColorPalette, {
										value: headerTextColor,
										onChange: function onChange(value) {
											return setAttributes({
												headerTextColor: value ? value : '#000'
											});
										}
									})
								)
							)
						),
						wp.element.createElement(
							PanelRow,
							null,
							wp.element.createElement(
								'div',
								{ className: 'inspector-field inspector-field-color ' },
								wp.element.createElement(
									'label',
									{ className: 'inspector-mb-0' },
									'Background Color'
								),
								wp.element.createElement(
									'div',
									{ className: 'inspector-ml-auto' },
									wp.element.createElement(ColorPalette, {
										value: titleBackgroundColor,
										onChange: function onChange(value) {
											return setAttributes({
												titleBackgroundColor: value ? value : '#f2f7fd'
											});
										}
									})
								)
							)
						),
						wp.element.createElement(
							PanelRow,
							null,
							wp.element.createElement(
								'div',
								{ className: 'inspector-field inspector-field-color ' },
								wp.element.createElement(
									'label',
									{ className: 'inspector-mb-0' },
									'Body Background'
								),
								wp.element.createElement(
									'div',
									{ className: 'inspector-ml-auto' },
									wp.element.createElement(ColorPalette, {
										value: bodyBgColor,
										onChange: function onChange(value) {
											return setAttributes({
												bodyBgColor: value ? value : '#fff'
											});
										}
									})
								)
							)
						)
					),
					wp.element.createElement(
						PanelBody,
						{ title: 'Design', initialOpen: false },
						wp.element.createElement(
							PanelRow,
							null,
							wp.element.createElement(
								'div',
								{ className: 'inspector-field inspector-border-width' },
								wp.element.createElement(RangeControl, {
									label: __('Border Width'),
									value: borderWidth,
									min: '0',
									max: '100',
									step: '1',
									onChange: function onChange(value) {
										return setAttributes({ borderWidth: value });
									}
								})
							)
						),
						wp.element.createElement(
							PanelRow,
							null,
							wp.element.createElement(
								'div',
								{ className: 'inspector-field inspector-border-style' },
								wp.element.createElement(
									'label',
									null,
									'Border Style'
								),
								wp.element.createElement(
									'div',
									{ className: 'inspector-field-button-list inspector-field-button-list-fluid' },
									wp.element.createElement(
										'button',
										{ className: 'solid' === borderType ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
												return setAttributes({ borderType: 'solid' });
											} },
										wp.element.createElement('span', { className: 'inspector-field-border-type inspector-field-border-type-solid' })
									),
									wp.element.createElement(
										'button',
										{ className: 'dotted' === borderType ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
												return setAttributes({ borderType: 'dotted' });
											} },
										wp.element.createElement('span', { className: 'inspector-field-border-type inspector-field-border-type-dotted' })
									),
									wp.element.createElement(
										'button',
										{ className: 'dashed' === borderType ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
												return setAttributes({ borderType: 'dashed' });
											} },
										wp.element.createElement('span', { className: 'inspector-field-border-type inspector-field-border-type-dashed' })
									),
									wp.element.createElement(
										'button',
										{ className: 'double' === borderType ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
												return setAttributes({ borderType: 'double' });
											} },
										wp.element.createElement('span', { className: 'inspector-field-border-type inspector-field-border-type-double' })
									),
									wp.element.createElement(
										'button',
										{ className: 'none' === borderType ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
												return setAttributes({ borderType: 'none' });
											} },
										wp.element.createElement('i', { className: 'fa fa-ban' })
									)
								)
							)
						),
						wp.element.createElement(
							PanelRow,
							null,
							wp.element.createElement(
								'div',
								{ className: 'inspector-field inspector-border-width' },
								wp.element.createElement(RangeControl, {
									label: __('Border Radius'),
									value: borderRadius,
									min: '0',
									max: '100',
									step: '1',
									onChange: function onChange(value) {
										return setAttributes({ borderRadius: value });
									}
								})
							)
						),
						wp.element.createElement(
							PanelRow,
							null,
							wp.element.createElement(
								'div',
								{ className: 'inspector-field inspector-field-color ' },
								wp.element.createElement(
									'label',
									{ className: 'inspector-mb-0' },
									'Border Color'
								),
								wp.element.createElement(
									'div',
									{ className: 'inspector-ml-auto' },
									wp.element.createElement(ColorPalette, {
										value: borderColor,
										onChange: function onChange(value) {
											return setAttributes({
												borderColor: value ? value : '#000'
											});
										}
									})
								)
							)
						)
					),
					wp.element.createElement(
						PanelBody,
						{ title: 'Spacing', initialOpen: false },
						wp.element.createElement(
							PanelRow,
							null,
							wp.element.createElement(
								'div',
								{ className: 'inspector-field inspector-field-padding' },
								wp.element.createElement(
									'label',
									{ className: 'mt10' },
									'Heading Padding'
								),
								wp.element.createElement(
									'div',
									{ className: 'padding-setting' },
									wp.element.createElement(
										'div',
										{ className: 'col-main-4' },
										wp.element.createElement(
											'div',
											{ className: 'padd-top col-main-inner', 'data-tooltip': 'padding Top' },
											wp.element.createElement(TextControl, {
												type: 'number',
												min: '1',
												value: PaddingTop,
												onChange: function onChange(value) {
													return setAttributes({ PaddingTop: value });
												}
											}),
											wp.element.createElement(
												'label',
												null,
												'Top'
											)
										),
										wp.element.createElement(
											'div',
											{ className: 'padd-buttom col-main-inner', 'data-tooltip': 'padding Bottom' },
											wp.element.createElement(TextControl, {
												type: 'number',
												min: '1',
												value: PaddingBottom,
												onChange: function onChange(value) {
													return setAttributes({ PaddingBottom: value });
												}
											}),
											wp.element.createElement(
												'label',
												null,
												'Bottom'
											)
										),
										wp.element.createElement(
											'div',
											{ className: 'padd-left col-main-inner', 'data-tooltip': 'padding Left' },
											wp.element.createElement(TextControl, {
												type: 'number',
												min: '1',
												value: PaddingLeft,
												onChange: function onChange(value) {
													return setAttributes({ PaddingLeft: value });
												}
											}),
											wp.element.createElement(
												'label',
												null,
												'Left'
											)
										),
										wp.element.createElement(
											'div',
											{ className: 'padd-right col-main-inner', 'data-tooltip': 'padding Right' },
											wp.element.createElement(TextControl, {
												type: 'number',
												min: '1',
												value: PaddingRight,
												onChange: function onChange(value) {
													return setAttributes({ PaddingRight: value });
												}
											}),
											wp.element.createElement(
												'label',
												null,
												'Right'
											)
										)
									)
								)
							)
						),
						wp.element.createElement(
							PanelRow,
							null,
							wp.element.createElement(
								'div',
								{ className: 'inspector-field inspector-field-padding' },
								wp.element.createElement(
									'label',
									{ className: 'mt10' },
									'Body Padding'
								),
								wp.element.createElement(
									'div',
									{ className: 'padding-setting' },
									wp.element.createElement(
										'div',
										{ className: 'col-main-4' },
										wp.element.createElement(
											'div',
											{ className: 'padd-top col-main-inner', 'data-tooltip': 'padding Top' },
											wp.element.createElement(TextControl, {
												type: 'number',
												min: '1',
												value: BodyPaddingTop,
												onChange: function onChange(value) {
													return setAttributes({ BodyPaddingTop: value });
												}
											}),
											wp.element.createElement(
												'label',
												null,
												'Top'
											)
										),
										wp.element.createElement(
											'div',
											{ className: 'padd-buttom col-main-inner', 'data-tooltip': 'padding Bottom' },
											wp.element.createElement(TextControl, {
												type: 'number',
												min: '1',
												value: BodyPaddingBottom,
												onChange: function onChange(value) {
													return setAttributes({ BodyPaddingBottom: value });
												}
											}),
											wp.element.createElement(
												'label',
												null,
												'Bottom'
											)
										),
										wp.element.createElement(
											'div',
											{ className: 'padd-left col-main-inner', 'data-tooltip': 'padding Left' },
											wp.element.createElement(TextControl, {
												type: 'number',
												min: '1',
												value: BodyPaddingLeft,
												onChange: function onChange(value) {
													return setAttributes({ BodyPaddingLeft: value });
												}
											}),
											wp.element.createElement(
												'label',
												null,
												'Left'
											)
										),
										wp.element.createElement(
											'div',
											{ className: 'padd-right col-main-inner', 'data-tooltip': 'padding Right' },
											wp.element.createElement(TextControl, {
												type: 'number',
												min: '1',
												value: BodyPaddingRight,
												onChange: function onChange(value) {
													return setAttributes({ BodyPaddingRight: value });
												}
											}),
											wp.element.createElement(
												'label',
												null,
												'Right'
											)
										)
									)
								)
							)
						)
					)
				)
			);
		},
		save: function save(props) {
			var attributes = props.attributes;
			var title = attributes.title,
			    open = attributes.open,
			    alignment = attributes.alignment,
			    headerTextFontSize = attributes.headerTextFontSize,
			    headerTextColor = attributes.headerTextColor,
			    titleBackgroundColor = attributes.titleBackgroundColor,
			    PaddingTop = attributes.PaddingTop,
			    PaddingRight = attributes.PaddingRight,
			    PaddingBottom = attributes.PaddingBottom,
			    PaddingLeft = attributes.PaddingLeft,
			    BodyPaddingTop = attributes.BodyPaddingTop,
			    BodyPaddingRight = attributes.BodyPaddingRight,
			    BodyPaddingBottom = attributes.BodyPaddingBottom,
			    BodyPaddingLeft = attributes.BodyPaddingLeft,
			    bodyBgColor = attributes.bodyBgColor,
			    borderWidth = attributes.borderWidth,
			    borderType = attributes.borderType,
			    borderColor = attributes.borderColor,
			    borderRadius = attributes.borderRadius,
			    fontFamily = attributes.fontFamily;

			var bodyDisplay = open ? 'block' : 'none';
			return wp.element.createElement(
				Fragment,
				null,
				title && wp.element.createElement(
					'div',
					{
						className: 'accordionWrapper ' + (open ? 'tabOpen' : 'tabClose'),
						style: {
							border: borderWidth + 'px ' + borderType + ' ' + borderColor,
							borderRadius: borderRadius + 'px'
						}
					},
					wp.element.createElement(
						'div',
						{
							className: 'accordionHeader',
							style: {
								backgroundColor: titleBackgroundColor,
								paddingTop: PaddingTop + 'px',
								paddingRight: PaddingRight + 'px',
								paddingBottom: PaddingBottom + 'px',
								paddingLeft: PaddingLeft + 'px',
								color: headerTextColor,
								margin: 0,
								position: 'relative'
							}
						},
						wp.element.createElement(RichText.Content, {
							tagName: 'h3',
							value: title,
							style: {
								fontSize: headerTextFontSize + 'px',
								textAlign: alignment,
								color: headerTextColor,
								margin: 0,
								fontFamily: fontFamily
							}
						}),
						wp.element.createElement('span', { className: 'dashicons fa fa-caret-down' })
					),
					wp.element.createElement(
						'div',
						{
							className: 'accordionBody',
							style: {
								backgroundColor: bodyBgColor,
								display: bodyDisplay,
								paddingTop: BodyPaddingTop + 'px',
								paddingRight: BodyPaddingRight + 'px',
								paddingBottom: BodyPaddingBottom + 'px',
								paddingLeft: BodyPaddingLeft + 'px',
								borderTop: borderWidth + 'px ' + borderType + ' ' + borderColor
							}
						},
						wp.element.createElement(InnerBlocks.Content, null)
					)
				)
			);
		}
	});
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);

/***/ }),
/* 105 */
/***/ (function(module, exports, __webpack_require__) {

var identity = __webpack_require__(26);

/**
 * Casts `value` to `identity` if it's not a function.
 *
 * @private
 * @param {*} value The value to inspect.
 * @returns {Function} Returns cast function.
 */
function castFunction(value) {
  return typeof value == 'function' ? value : identity;
}

module.exports = castFunction;


/***/ }),
/* 106 */
/***/ (function(module, exports, __webpack_require__) {

var toFinite = __webpack_require__(107);

/**
 * Converts `value` to an integer.
 *
 * **Note:** This method is loosely based on
 * [`ToInteger`](http://www.ecma-international.org/ecma-262/7.0/#sec-tointeger).
 *
 * @static
 * @memberOf _
 * @since 4.0.0
 * @category Lang
 * @param {*} value The value to convert.
 * @returns {number} Returns the converted integer.
 * @example
 *
 * _.toInteger(3.2);
 * // => 3
 *
 * _.toInteger(Number.MIN_VALUE);
 * // => 0
 *
 * _.toInteger(Infinity);
 * // => 1.7976931348623157e+308
 *
 * _.toInteger('3.2');
 * // => 3
 */
function toInteger(value) {
  var result = toFinite(value),
      remainder = result % 1;

  return result === result ? (remainder ? result - remainder : result) : 0;
}

module.exports = toInteger;


/***/ }),
/* 107 */
/***/ (function(module, exports, __webpack_require__) {

var toNumber = __webpack_require__(108);

/** Used as references for various `Number` constants. */
var INFINITY = 1 / 0,
    MAX_INTEGER = 1.7976931348623157e+308;

/**
 * Converts `value` to a finite number.
 *
 * @static
 * @memberOf _
 * @since 4.12.0
 * @category Lang
 * @param {*} value The value to convert.
 * @returns {number} Returns the converted number.
 * @example
 *
 * _.toFinite(3.2);
 * // => 3.2
 *
 * _.toFinite(Number.MIN_VALUE);
 * // => 5e-324
 *
 * _.toFinite(Infinity);
 * // => 1.7976931348623157e+308
 *
 * _.toFinite('3.2');
 * // => 3.2
 */
function toFinite(value) {
  if (!value) {
    return value === 0 ? value : 0;
  }
  value = toNumber(value);
  if (value === INFINITY || value === -INFINITY) {
    var sign = (value < 0 ? -1 : 1);
    return sign * MAX_INTEGER;
  }
  return value === value ? value : 0;
}

module.exports = toFinite;


/***/ }),
/* 108 */
/***/ (function(module, exports, __webpack_require__) {

var isObject = __webpack_require__(7),
    isSymbol = __webpack_require__(10);

/** Used as references for various `Number` constants. */
var NAN = 0 / 0;

/** Used to match leading and trailing whitespace. */
var reTrim = /^\s+|\s+$/g;

/** Used to detect bad signed hexadecimal string values. */
var reIsBadHex = /^[-+]0x[0-9a-f]+$/i;

/** Used to detect binary string values. */
var reIsBinary = /^0b[01]+$/i;

/** Used to detect octal string values. */
var reIsOctal = /^0o[0-7]+$/i;

/** Built-in method references without a dependency on `root`. */
var freeParseInt = parseInt;

/**
 * Converts `value` to a number.
 *
 * @static
 * @memberOf _
 * @since 4.0.0
 * @category Lang
 * @param {*} value The value to process.
 * @returns {number} Returns the number.
 * @example
 *
 * _.toNumber(3.2);
 * // => 3.2
 *
 * _.toNumber(Number.MIN_VALUE);
 * // => 5e-324
 *
 * _.toNumber(Infinity);
 * // => Infinity
 *
 * _.toNumber('3.2');
 * // => 3.2
 */
function toNumber(value) {
  if (typeof value == 'number') {
    return value;
  }
  if (isSymbol(value)) {
    return NAN;
  }
  if (isObject(value)) {
    var other = typeof value.valueOf == 'function' ? value.valueOf() : value;
    value = isObject(other) ? (other + '') : other;
  }
  if (typeof value != 'string') {
    return value === 0 ? value : +value;
  }
  value = value.replace(reTrim, '');
  var isBinary = reIsBinary.test(value);
  return (isBinary || reIsOctal.test(value))
    ? freeParseInt(value.slice(2), isBinary ? 2 : 8)
    : (reIsBadHex.test(value) ? NAN : +value);
}

module.exports = toNumber;


/***/ }),
/* 109 */
/***/ (function(module, exports) {

// shim for using process in browser
var process = module.exports = {};

// cached from whatever global is present so that test runners that stub it
// don't break things.  But we need to wrap it in a try catch in case it is
// wrapped in strict mode code which doesn't define any globals.  It's inside a
// function because try/catches deoptimize in certain engines.

var cachedSetTimeout;
var cachedClearTimeout;

function defaultSetTimout() {
    throw new Error('setTimeout has not been defined');
}
function defaultClearTimeout () {
    throw new Error('clearTimeout has not been defined');
}
(function () {
    try {
        if (typeof setTimeout === 'function') {
            cachedSetTimeout = setTimeout;
        } else {
            cachedSetTimeout = defaultSetTimout;
        }
    } catch (e) {
        cachedSetTimeout = defaultSetTimout;
    }
    try {
        if (typeof clearTimeout === 'function') {
            cachedClearTimeout = clearTimeout;
        } else {
            cachedClearTimeout = defaultClearTimeout;
        }
    } catch (e) {
        cachedClearTimeout = defaultClearTimeout;
    }
} ())
function runTimeout(fun) {
    if (cachedSetTimeout === setTimeout) {
        //normal enviroments in sane situations
        return setTimeout(fun, 0);
    }
    // if setTimeout wasn't available but was latter defined
    if ((cachedSetTimeout === defaultSetTimout || !cachedSetTimeout) && setTimeout) {
        cachedSetTimeout = setTimeout;
        return setTimeout(fun, 0);
    }
    try {
        // when when somebody has screwed with setTimeout but no I.E. maddness
        return cachedSetTimeout(fun, 0);
    } catch(e){
        try {
            // When we are in I.E. but the script has been evaled so I.E. doesn't trust the global object when called normally
            return cachedSetTimeout.call(null, fun, 0);
        } catch(e){
            // same as above but when it's a version of I.E. that must have the global object for 'this', hopfully our context correct otherwise it will throw a global error
            return cachedSetTimeout.call(this, fun, 0);
        }
    }


}
function runClearTimeout(marker) {
    if (cachedClearTimeout === clearTimeout) {
        //normal enviroments in sane situations
        return clearTimeout(marker);
    }
    // if clearTimeout wasn't available but was latter defined
    if ((cachedClearTimeout === defaultClearTimeout || !cachedClearTimeout) && clearTimeout) {
        cachedClearTimeout = clearTimeout;
        return clearTimeout(marker);
    }
    try {
        // when when somebody has screwed with setTimeout but no I.E. maddness
        return cachedClearTimeout(marker);
    } catch (e){
        try {
            // When we are in I.E. but the script has been evaled so I.E. doesn't  trust the global object when called normally
            return cachedClearTimeout.call(null, marker);
        } catch (e){
            // same as above but when it's a version of I.E. that must have the global object for 'this', hopfully our context correct otherwise it will throw a global error.
            // Some versions of I.E. have different rules for clearTimeout vs setTimeout
            return cachedClearTimeout.call(this, marker);
        }
    }



}
var queue = [];
var draining = false;
var currentQueue;
var queueIndex = -1;

function cleanUpNextTick() {
    if (!draining || !currentQueue) {
        return;
    }
    draining = false;
    if (currentQueue.length) {
        queue = currentQueue.concat(queue);
    } else {
        queueIndex = -1;
    }
    if (queue.length) {
        drainQueue();
    }
}

function drainQueue() {
    if (draining) {
        return;
    }
    var timeout = runTimeout(cleanUpNextTick);
    draining = true;

    var len = queue.length;
    while(len) {
        currentQueue = queue;
        queue = [];
        while (++queueIndex < len) {
            if (currentQueue) {
                currentQueue[queueIndex].run();
            }
        }
        queueIndex = -1;
        len = queue.length;
    }
    currentQueue = null;
    draining = false;
    runClearTimeout(timeout);
}

process.nextTick = function (fun) {
    var args = new Array(arguments.length - 1);
    if (arguments.length > 1) {
        for (var i = 1; i < arguments.length; i++) {
            args[i - 1] = arguments[i];
        }
    }
    queue.push(new Item(fun, args));
    if (queue.length === 1 && !draining) {
        runTimeout(drainQueue);
    }
};

// v8 likes predictible objects
function Item(fun, array) {
    this.fun = fun;
    this.array = array;
}
Item.prototype.run = function () {
    this.fun.apply(null, this.array);
};
process.title = 'browser';
process.browser = true;
process.env = {};
process.argv = [];
process.version = ''; // empty string to avoid regexp issues
process.versions = {};

function noop() {}

process.on = noop;
process.addListener = noop;
process.once = noop;
process.off = noop;
process.removeListener = noop;
process.removeAllListeners = noop;
process.emit = noop;
process.prependListener = noop;
process.prependOnceListener = noop;

process.listeners = function (name) { return [] }

process.binding = function (name) {
    throw new Error('process.binding is not supported');
};

process.cwd = function () { return '/' };
process.chdir = function (dir) {
    throw new Error('process.chdir is not supported');
};
process.umask = function() { return 0; };


/***/ }),
/* 110 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_lodash_times__ = __webpack_require__(15);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_lodash_times___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_lodash_times__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_memize__ = __webpack_require__(16);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_memize___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1_memize__);
function _toConsumableArray(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } else { return Array.from(arr); } }




(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
  var __ = wpI18n.__;
  var registerBlockType = wpBlocks.registerBlockType;
  var Fragment = wpElement.Fragment;
  var RichText = wpEditor.RichText,
      InspectorControls = wpEditor.InspectorControls,
      InnerBlocks = wpEditor.InnerBlocks,
      MediaUpload = wpEditor.MediaUpload;
  var TextControl = wpComponents.TextControl,
      PanelBody = wpComponents.PanelBody,
      PanelRow = wpComponents.PanelRow,
      Button = wpComponents.Button,
      CheckboxControl = wpComponents.CheckboxControl,
      IconButton = wpComponents.IconButton,
      ToggleControl = wpComponents.ToggleControl;


  var ALLOWBLOCKS = ['nab/meet-the-team-item'];

  var removehildawardsBlock = __WEBPACK_IMPORTED_MODULE_1_memize___default()(function (schedule) {
    return __WEBPACK_IMPORTED_MODULE_0_lodash_times___default()(schedule, function (n) {
      return ['nab/meet-the-team-item', { id: n - 1 }];
    });
  });

  var meetTeamBlockIcon = wp.element.createElement(
    'svg',
    { width: '150px', height: '150px', viewBox: '0 0 150 150', 'enable-background': 'new 0 0 150 150' },
    wp.element.createElement(
      'g',
      null,
      wp.element.createElement(
        'g',
        null,
        wp.element.createElement('path', { fill: '#0F6CB6', d: 'M132.34,69.51c-5.104-2.552-14.674-2.582-15.078-2.582c-1.215,0-2.197,0.984-2.197,2.197\r c0,1.214,0.982,2.197,2.197,2.197c2.469,0,9.639,0.381,13.113,2.118c0.314,0.158,0.65,0.232,0.98,0.232\r c0.807,0,1.582-0.445,1.967-1.215C133.865,71.373,133.426,70.053,132.34,69.51z' })
      )
    ),
    wp.element.createElement(
      'g',
      null,
      wp.element.createElement(
        'g',
        null,
        wp.element.createElement('path', { fill: '#0F6CB6', d: 'M143.295,100.793l-9.075-2.592c-0.392-0.113-0.665-0.475-0.665-0.883v-3.029\r c0.738-0.512,1.442-1.084,2.101-1.723c3.19-3.096,4.947-7.249,4.947-11.693v-4.18l0.878-1.755\r c0.963-1.926,1.472-4.083,1.472-6.236V57.379c0-1.213-0.983-2.197-2.197-2.197H119.61c-7.688,0-13.944,6.255-13.944,13.944v0.131\r c0,1.791,0.424,3.583,1.225,5.185l1.125,2.25v3.589c0,5.688,2.803,10.791,7.049,13.861v3.176c0,0.488,0,0.691-1.814,1.211\r l-4.428,1.264l-12.809-4.656c0.045-0.605-0.158-1.22-0.6-1.684l-4.093-4.299v-7.219c0.433-0.357,0.859-0.724,1.272-1.111\r c5.164-4.84,8.125-11.672,8.125-18.747v-5.765c1.559-3.393,2.35-6.983,2.35-10.681V22.139c0-1.214-0.984-2.197-2.197-2.197H67.979\r c-11.575,0-20.992,9.417-20.992,20.992v4.699c0,3.697,0.791,7.288,2.35,10.681v4.96c0,8.213,3.652,15.613,9.397,20.492v7.389\r l-4.093,4.3c-0.441,0.464-0.645,1.077-0.599,1.683l-13.519,4.916c-0.979,0.355-1.89,0.838-2.716,1.422l-2.123-1.061\r c6.319-2.751,8.321-6.619,8.417-6.812c0.309-0.618,0.309-1.347,0-1.966c-1.584-3.168-1.776-8.975-1.93-13.641\r c-0.051-1.553-0.1-3.021-0.193-4.327c-0.749-10.54-8.761-18.487-18.637-18.487S5.453,63.129,4.704,73.669\r c-0.093,1.307-0.142,2.774-0.193,4.327c-0.154,4.666-0.346,10.473-1.93,13.641c-0.31,0.619-0.31,1.347,0,1.965\r c0.096,0.193,2.094,4.053,8.426,6.807l-5.897,2.949c-3.152,1.577-5.11,4.746-5.11,8.27v16.232c0,1.215,0.984,2.197,2.197,2.197\r s2.197-0.982,2.197-2.197v-16.232c0-1.85,1.027-3.512,2.681-4.339l7.343-3.671l2.554,2.427c1.786,1.697,4.077,2.546,6.369,2.546\r c2.292,0,4.583-0.85,6.369-2.546l2.554-2.427l2.394,1.197c-1.127,1.804-1.767,3.919-1.767,6.135v16.912\r c0,1.213,0.984,2.197,2.197,2.197s2.197-0.984,2.197-2.197v-16.912c0-3.017,1.904-5.736,4.74-6.768L56.279,99l5.934,8.9\r c0.758,1.138,1.974,1.867,3.334,2.002c0.152,0.016,0.303,0.022,0.454,0.022c1.2,0,2.35-0.473,3.21-1.332l3.62-3.62v22.889\r c0,1.213,0.984,2.197,2.197,2.197c1.214,0,2.197-0.984,2.197-2.197v-22.889l3.62,3.62c0.859,0.86,2.009,1.333,3.21,1.333\r c0.15,0,0.302-0.008,0.453-0.023c1.361-0.135,2.576-0.864,3.335-2.002l5.935-8.9l14.252,5.184c2.836,1.03,4.74,3.75,4.74,6.766\r v16.912c0,1.213,0.984,2.197,2.197,2.197s2.197-0.984,2.197-2.197v-16.912c0-3.055-1.214-5.92-3.25-8.039l0.543-0.154\r c0.547-0.157,1.295-0.371,2.045-0.738l5.609,5.609v20.234c0,1.213,0.984,2.197,2.197,2.197c1.214,0,2.197-0.984,2.197-2.197\r v-20.234l5.571-5.57c0.296,0.15,0.607,0.277,0.935,0.371l9.076,2.592c2.07,0.592,3.518,2.51,3.518,4.664v18.178\r c0,1.213,0.984,2.197,2.197,2.197s2.197-0.984,2.197-2.197v-18.178C150,105.578,147.242,101.922,143.295,100.793z M14.096,96.912\r c-4.11-1.479-6.172-3.45-7.052-4.527c0.6-1.568,0.989-3.365,1.252-5.262c1.212,2.906,3.241,5.387,5.799,7.156V96.912z\r M26.684,102.859c-1.874,1.78-4.81,1.779-6.684,0l-2.043-1.942c0.345-0.646,0.535-1.378,0.535-2.146V96.43\r c1.533,0.479,3.162,0.736,4.851,0.736c1.687,0,3.315-0.259,4.851-0.735l0,2.341c0,0.768,0.189,1.5,0.534,2.146L26.684,102.859z\r M23.343,92.771c-6.562,0-11.899-5.338-11.899-11.898c0-1.213-0.984-2.197-2.197-2.197c-0.123,0-0.243,0.013-0.361,0.032\r c0.006-0.188,0.013-0.378,0.019-0.565c0.049-1.511,0.096-2.938,0.183-4.162c0.281-3.948,1.858-7.586,4.442-10.245\r c2.607-2.683,6.092-4.16,9.812-4.16c3.72,0,7.205,1.477,9.812,4.16c2.584,2.658,4.162,6.296,4.442,10.245\r c0.086,1.224,0.134,2.65,0.184,4.161c0.004,0.13,0.009,0.262,0.013,0.392c-2.391-3.683-6.083-6.397-10.853-7.93\r c-4.407-1.416-8.198-1.329-8.358-1.324c-0.575,0.016-1.121,0.257-1.521,0.671l-3.964,4.112c-0.842,0.874-0.817,2.264,0.056,3.107\r c0.874,0.843,2.265,0.817,3.107-0.057l3.299-3.421c2.841,0.139,11.981,1.202,15.536,9.029\r C34.201,88.488,29.243,92.771,23.343,92.771z M32.586,96.92l0-2.621c2.556-1.76,4.588-4.235,5.801-7.162\r c0.263,1.892,0.652,3.684,1.251,5.249C38.764,93.452,36.692,95.441,32.586,96.92z M53.731,61.273v-5.452\r c0-0.331-0.075-0.657-0.219-0.955c-1.414-2.928-2.131-6.035-2.131-9.234v-4.699c0-9.152,7.446-16.598,16.598-16.598h30.694v21.296\r c0,3.199-0.717,6.306-2.131,9.234c-0.145,0.298-0.219,0.625-0.219,0.956v6.256c0,5.95-2.393,11.47-6.735,15.541\r c-0.542,0.508-1.105,0.984-1.687,1.428c-0.014,0.01-0.025,0.02-0.039,0.027c-4.068,3.09-9.053,4.592-14.257,4.254\r C62.461,82.607,53.731,72.919,53.731,61.273z M66.103,105.485c-0.015,0.015-0.051,0.052-0.123,0.044\r c-0.071-0.008-0.1-0.049-0.111-0.067l-6.833-10.251l2.199-2.311l10.367,7.086L66.103,105.485z M75.028,97.006l-11.899-8.133\r v-4.102c3.079,1.664,6.526,2.705,10.193,2.941c0.579,0.038,1.155,0.057,1.729,0.057c4.202,0,8.245-1.004,11.876-2.91v4.014\r L75.028,97.006z M84.187,105.463c-0.012,0.018-0.04,0.06-0.111,0.066c-0.071,0.01-0.106-0.029-0.122-0.043l-5.498-5.498\r l10.366-7.087l2.199,2.311L84.187,105.463z M124.309,103.608l-4.986-4.985c0.088-0.396,0.137-0.828,0.137-1.306v-0.927\r c1.383,0.453,2.842,0.723,4.351,0.768c0.169,0.006,0.337,0.008,0.506,0.008c1.667,0,3.296-0.252,4.845-0.732v0.885\r c0,0.438,0.055,0.867,0.158,1.281L124.309,103.608z M132.596,89.413c-2.33,2.26-5.406,3.453-8.654,3.353\r c-6.358-0.189-11.531-5.791-11.531-12.484v-4.107c0-0.341-0.08-0.677-0.232-0.982l-1.357-2.714c-0.496-0.995-0.76-2.108-0.76-3.22\r v-0.131c0-5.266,4.284-9.55,9.55-9.55h18.947v9.126c0,1.475-0.349,2.952-1.009,4.271l-1.108,2.218\r c-0.153,0.306-0.232,0.642-0.232,0.982v4.699C136.208,84.119,134.925,87.152,132.596,89.413z' })
      )
    ),
    wp.element.createElement(
      'g',
      null,
      wp.element.createElement(
        'g',
        null,
        wp.element.createElement('path', { fill: '#0F6CB6', d: 'M138.405,111.566c-1.214,0-2.197,0.984-2.197,2.197v14.096c0,1.215,0.983,2.197,2.197,2.197\r s2.197-0.982,2.197-2.197v-14.096C140.603,112.551,139.619,111.566,138.405,111.566z' })
      )
    ),
    wp.element.createElement(
      'g',
      null,
      wp.element.createElement(
        'g',
        null,
        wp.element.createElement('path', { fill: '#0F6CB6', d: 'M11.595,114.471c-1.213,0-2.197,0.984-2.197,2.197v11.191c0,1.215,0.984,2.197,2.197,2.197\r s2.197-0.982,2.197-2.197v-11.191C13.792,115.455,12.808,114.471,11.595,114.471z' })
      )
    ),
    wp.element.createElement(
      'g',
      null,
      wp.element.createElement(
        'g',
        null,
        wp.element.createElement('path', { fill: '#0F6CB6', d: 'M93.027,46.428c-8.311-8.311-25.698-6.722-32.789-5.653c-2.233,0.336-3.854,2.227-3.854,4.494v5.062\r c0,1.213,0.984,2.197,2.197,2.197s2.197-0.984,2.197-2.197v-5.062c0-0.075,0.049-0.139,0.115-0.148\r c2.832-0.427,8.452-1.085,14.275-0.697c6.853,0.456,11.815,2.176,14.751,5.112c0.857,0.858,2.249,0.858,3.107,0\r C93.885,48.677,93.885,47.286,93.027,46.428z' })
      )
    ),
    wp.element.createElement(
      'g',
      null,
      wp.element.createElement(
        'g',
        null,
        wp.element.createElement('path', { fill: '#0F6CB6', d: 'M49.185,116.266c-1.213,0-2.197,0.984-2.197,2.197v9.397c0,1.214,0.984,2.197,2.197,2.197\r c1.214,0,2.197-0.983,2.197-2.197v-9.397C51.382,117.25,50.398,116.266,49.185,116.266z' })
      )
    ),
    wp.element.createElement(
      'g',
      null,
      wp.element.createElement(
        'g',
        null,
        wp.element.createElement('path', { fill: '#0F6CB6', d: 'M100.871,116.266c-1.214,0-2.197,0.984-2.197,2.197v9.397c0,1.214,0.983,2.197,2.197,2.197\r c1.213,0,2.197-0.983,2.197-2.197v-9.397C103.068,117.25,102.084,116.266,100.871,116.266z' })
      )
    )
  );

  /* Parent schedule Block */
  registerBlockType('nab/meet-the-team', {
    title: __('Meet The Team'),
    description: __('Meet The Team'),
    icon: { src: meetTeamBlockIcon },
    category: 'nabshow',
    keywords: [__('schedule'), __('gutenberg'), __('nab')],
    attributes: {
      blockId: {
        type: 'string'
      },
      noOfschedule: {
        type: 'number',
        default: 1
      },
      showFilter: {
        type: 'boolean',
        default: false
      }
    },
    edit: function edit(props) {
      var _props$attributes = props.attributes,
          noOfschedule = _props$attributes.noOfschedule,
          showFilter = _props$attributes.showFilter,
          className = props.className,
          setAttributes = props.setAttributes,
          clientId = props.clientId;


      jQuery(document).on('click', '#block-' + clientId + ' .team-box-inner .remove-button', function (e) {
        if ('' !== jQuery(this).parents('#block-' + clientId)) {
          setAttributes({ noOfschedule: noOfschedule - 1 });
          removehildawardsBlock(noOfschedule);
        }
      });

      return wp.element.createElement(
        Fragment,
        null,
        wp.element.createElement(
          InspectorControls,
          null,
          wp.element.createElement(
            PanelBody,
            { title: 'General Settings' },
            wp.element.createElement(
              PanelRow,
              null,
              wp.element.createElement(ToggleControl, {
                label: __('Show Filter'),
                checked: showFilter,
                onChange: function onChange() {
                  return setAttributes({ showFilter: !showFilter });
                }
              })
            )
          )
        ),
        showFilter && wp.element.createElement(
          'div',
          { className: 'meet-team-select main-filter' },
          wp.element.createElement(
            'div',
            { className: 'left-select' },
            wp.element.createElement(
              'h4',
              null,
              'Department'
            ),
            wp.element.createElement(
              'select',
              { id: 'team-department' },
              wp.element.createElement(
                'option',
                { value: 'all' },
                'Select Department'
              )
            )
          ),
          wp.element.createElement('div', { id: 'team-checkbox' })
        ),
        wp.element.createElement(
          'div',
          { className: 'team-main meet-team-main ' + (className ? className : '') },
          wp.element.createElement(InnerBlocks, {
            allowedBlocks: ALLOWBLOCKS
          })
        )
      );
    },
    save: function save(props) {
      var className = props.className,
          showFilter = props.attributes.showFilter;

      return wp.element.createElement(
        Fragment,
        null,
        showFilter && wp.element.createElement(
          'div',
          { className: 'meet-team-select main-filter' },
          wp.element.createElement(
            'div',
            { className: 'left-select' },
            wp.element.createElement(
              'h4',
              null,
              'Department'
            ),
            wp.element.createElement(
              'select',
              { id: 'team-department' },
              wp.element.createElement(
                'option',
                { value: 'all' },
                'Select Department'
              )
            )
          ),
          wp.element.createElement('div', { id: 'team-checkbox' })
        ),
        wp.element.createElement(
          'div',
          { className: 'team-main meet-team-main ' + (className ? className : '') },
          wp.element.createElement(InnerBlocks.Content, null)
        )
      );
    }
  });

  /* schedule Block */
  registerBlockType('nab/meet-the-team-item', {
    title: __('Meet The Team Items'),
    description: __('Meet The Team Items'),
    icon: { src: meetTeamBlockIcon },
    category: 'nabshow',
    parent: ['nab/meet-the-team'],
    attributes: {
      name: {
        type: 'string'
      },
      title: {
        type: 'string'
      },
      email: {
        type: 'string'
      },
      phone: {
        type: 'string'
      },
      imageAlt: {
        attribute: 'alt'
      },
      imageUrl: {
        attribute: 'src'
      },
      swapImage: {
        attribute: 'src'
      },
      swapAlt: {
        attribute: 'alt'
      },
      InsertUrl: {
        type: 'string',
        default: ''
      },
      department: {
        type: 'string'
      },
      category: {
        type: 'string'
      },
      autoplay: {
        type: 'boolean',
        default: false
      },
      categoryList: {
        type: 'array',
        default: ['Avid Readers', 'Animal Lovers', 'Coffee Addicts', 'Podcast Streamers', 'Film Geeks', 'Sports Junkles', 'Foodies', 'World Travelers', 'Gamers']
      },
      taxonomies: {
        type: 'array',
        default: []
      },
      showPopup: {
        type: 'boolean',
        default: true
      },
      modelClass: {
        type: 'string'
      }
    },
    edit: function edit(props) {
      var attributes = props.attributes,
          setAttributes = props.setAttributes,
          clientId = props.clientId;
      var name = attributes.name,
          title = attributes.title,
          email = attributes.email,
          phone = attributes.phone,
          imageAlt = attributes.imageAlt,
          department = attributes.department,
          category = attributes.category,
          categoryList = attributes.categoryList,
          taxonomies = attributes.taxonomies,
          swapImage = attributes.swapImage,
          swapAlt = attributes.swapAlt,
          showPopup = attributes.showPopup,
          modelClass = attributes.modelClass;


      var getImageButton = function getImageButton(openEvent) {
        if (attributes.imageUrl) {
          return wp.element.createElement('img', { src: attributes.imageUrl, alt: imageAlt, className: 'main-img' });
        } else {
          return wp.element.createElement(
            'div',
            { className: 'button-container' },
            wp.element.createElement(
              Button,
              { onClick: openEvent, className: 'button button-large' },
              wp.element.createElement('span', { className: 'dashicons dashicons-upload' }),
              ' Upload Headshot'
            )
          );
        }
      };

      var getHoverImage = function getHoverImage(openEvent) {
        if (swapImage) {
          return wp.element.createElement(
            'div',
            null,
            wp.element.createElement(
              'div',
              { className: 'remove-img' },
              wp.element.createElement('span', {
                onClick: function onClick(value) {
                  return setAttributes({ swapImage: '', swapAlt: '' });
                },
                className: 'dashicons dashicons-trash'
              })
            ),
            wp.element.createElement('img', { src: swapImage, alt: swapAlt, className: 'hover-img' })
          );
        } else {
          return wp.element.createElement(
            'div',
            { className: 'button-container' },
            wp.element.createElement(
              Button,
              { onClick: openEvent, className: 'button button-large' },
              wp.element.createElement('span', { className: 'dashicons dashicons-upload' }),
              ' Upload Hover Image'
            )
          );
        }
      };

      function modelopen() {
        var ele = document.getElementById('wpwrap');
        ele.classList.add('nab_body_model_open');
        setAttributes({ modelClass: 'nab_model_open' });
      }
      function modelclose() {
        var ele = document.getElementById('wpwrap');
        ele.classList.remove('nab_body_model_open');
        setAttributes({ modelClass: '' });
      }

      return wp.element.createElement(
        'div',
        {
          className: 'team-box',
          'data-department': department ? department : '',
          'data-category': taxonomies ? taxonomies : ''
        },
        wp.element.createElement(
          InspectorControls,
          null,
          wp.element.createElement(
            PanelBody,
            {
              title: __('General Setting'),
              initialOpen: true,
              className: 'range-setting'
            },
            wp.element.createElement(
              PanelRow,
              null,
              wp.element.createElement(ToggleControl, {
                label: __('Show Popup'),
                checked: showPopup,
                onChange: function onChange() {
                  return setAttributes({ showPopup: !showPopup });
                }
              })
            ),
            wp.element.createElement(
              PanelRow,
              null,
              wp.element.createElement(TextControl, {
                type: 'string',
                label: 'Department',
                name: department,
                value: department,
                placeHolder: 'Department',
                onChange: function onChange(value) {
                  return setAttributes({ department: value });
                }
              })
            ),
            wp.element.createElement(
              PanelRow,
              null,
              wp.element.createElement(
                'div',
                { className: 'meet-new-item' },
                wp.element.createElement(TextControl, {
                  type: 'string',
                  label: 'Add New Category',
                  name: category,
                  placeHolder: 'Add New',
                  onChange: function onChange(value) {
                    return setAttributes({ category: value });
                  }
                }),
                wp.element.createElement(
                  Button,
                  {
                    onClick: function onClick(value) {
                      if (undefined !== category && '' !== category) {
                        var newCat = [].concat(_toConsumableArray(categoryList));
                        newCat.push(category);
                        setAttributes({ categoryList: newCat });
                      }
                    }
                  },
                  wp.element.createElement('span', { className: 'dashicons dashicons-plus' })
                )
              )
            ),
            wp.element.createElement(
              'label',
              null,
              'Select Category'
            ),
            wp.element.createElement(
              PanelRow,
              null,
              wp.element.createElement(
                'div',
                { className: 'category-list' },
                categoryList.map(function (item, index) {
                  return wp.element.createElement(
                    Fragment,
                    { key: index },
                    wp.element.createElement(CheckboxControl, {
                      checked: -1 < taxonomies.indexOf(item),
                      label: item,
                      name: 'item[]',
                      value: item,
                      onChange: function onChange(isChecked) {
                        var index = void 0,
                            tempTaxonomies = [].concat(_toConsumableArray(taxonomies));

                        if (isChecked) {
                          tempTaxonomies.push(item);
                        } else {
                          index = tempTaxonomies.indexOf(item);
                          tempTaxonomies.splice(index, 1);
                        }
                        setAttributes({ taxonomies: tempTaxonomies });
                      }
                    })
                  );
                })
              )
            ),
            wp.element.createElement(
              PanelRow,
              null,
              wp.element.createElement(
                'div',
                { className: 'hover-upload' },
                wp.element.createElement(
                  'label',
                  { className: 'mt20' },
                  'Hover Image'
                ),
                wp.element.createElement(MediaUpload, {
                  onSelect: function onSelect(media) {
                    setAttributes({ swapAlt: media.alt, swapImage: media.url });
                  },
                  type: 'image',
                  value: attributes.imageID,
                  render: function render(_ref) {
                    var open = _ref.open;
                    return getHoverImage(open);
                  }
                })
              )
            )
          )
        ),
        wp.element.createElement(
          'div',
          { className: 'team-box-inner' },
          wp.element.createElement(
            'span',
            { className: 'remove-button' },
            wp.element.createElement(IconButton, {
              className: 'components-toolbar__control',
              label: __('Remove image'),
              icon: 'no',
              onClick: function onClick() {
                wp.data.dispatch('core/editor').removeBlocks(clientId);
              }
            })
          ),
          wp.element.createElement(
            'div',
            { className: 'feature-img' },
            wp.element.createElement(
              'div',
              { className: 'remove-img' },
              wp.element.createElement('span', {
                onClick: function onClick(value) {
                  return setAttributes({ imageUrl: '', imageAlt: '' });
                },
                className: 'dashicons dashicons-trash'
              })
            ),
            wp.element.createElement(MediaUpload, {
              onSelect: function onSelect(media) {
                setAttributes({ imageAlt: media.alt, imageUrl: media.url });
              },
              type: 'image',
              value: attributes.imageID,
              render: function render(_ref2) {
                var open = _ref2.open;
                return getImageButton(open);
              }
            })
          ),
          wp.element.createElement(
            'div',
            { className: 'team-details' },
            wp.element.createElement(RichText, {
              tagName: 'h3',
              onChange: function onChange(value) {
                return setAttributes({ name: value });
              },
              value: name,
              className: 'name',
              placeholder: __('Name')
            }),
            wp.element.createElement(RichText, {
              tagName: 'strong',
              onChange: function onChange(value) {
                return setAttributes({ title: value });
              },
              value: title,
              className: 'title',
              placeholder: __('Title')
            }),
            wp.element.createElement(TextControl, {
              type: 'text',
              className: 'email',
              value: email,
              placeholder: 'Email',
              onChange: function onChange(value) {
                return setAttributes({ email: value });
              }
            }),
            wp.element.createElement(RichText, {
              tagName: 'p',
              onChange: function onChange(value) {
                return setAttributes({ phone: value });
              },
              value: phone,
              className: 'phone',
              placeholder: __('Phone')
            }),
            showPopup ? wp.element.createElement(
              'div',
              { className: 'nab_model_head' },
              wp.element.createElement('input', { type: 'button', onClick: modelopen, className: 'nab_popup_btn btn-primary bio-btn', value: 'Bio' }),
              wp.element.createElement(
                'div',
                { className: 'nab_model_main ' + modelClass },
                wp.element.createElement(
                  'div',
                  { className: 'nab_model_inner' },
                  wp.element.createElement(
                    'div',
                    { className: 'nab_close_btn', onClick: modelclose },
                    wp.element.createElement(
                      'svg',
                      { width: '30', height: '30', viewBox: '0 0 30 30', fill: 'none', stroke: 'currentColor', 'stroke-width': '2', 'stroke-linecap': 'round', 'stroke-linejoin': 'round', className: 'feather feather-x' },
                      wp.element.createElement('line', { x1: '20', y1: '10', x2: '10', y2: '20' }),
                      wp.element.createElement('line', { x1: '10', y1: '10', x2: '20', y2: '20' })
                    )
                  ),
                  wp.element.createElement(
                    'div',
                    { className: 'nab_model_wrap' },
                    wp.element.createElement(
                      'div',
                      { className: 'nab_pop_up_content_wrap' },
                      wp.element.createElement(InnerBlocks, { templateLock: false })
                    )
                  )
                ),
                wp.element.createElement('div', { className: 'nab_bg_overlay', onClick: modelclose })
              )
            ) : ''
          )
        )
      );
    },
    save: function save(props) {
      var _props$attributes2 = props.attributes,
          name = _props$attributes2.name,
          title = _props$attributes2.title,
          email = _props$attributes2.email,
          phone = _props$attributes2.phone,
          imageAlt = _props$attributes2.imageAlt,
          imageUrl = _props$attributes2.imageUrl,
          department = _props$attributes2.department,
          taxonomies = _props$attributes2.taxonomies,
          swapImage = _props$attributes2.swapImage,
          swapAlt = _props$attributes2.swapAlt,
          showPopup = _props$attributes2.showPopup;

      var catData = taxonomies.toString();

      if (undefined !== name || undefined !== title || undefined !== email || undefined !== phone) {
        return wp.element.createElement(
          'div',
          {
            className: 'team-box',
            'data-department': department ? department : '',
            'data-category': catData ? catData : ''
          },
          wp.element.createElement(
            'div',
            { className: 'team-box-inner' },
            wp.element.createElement(
              'div',
              { className: 'feature-img ' + (swapImage ? 'with-hover-img' : '') },
              imageUrl ? wp.element.createElement(
                Fragment,
                null,
                wp.element.createElement('img', { src: imageUrl, alt: imageAlt, className: 'main-img' }),
                swapImage ? wp.element.createElement('img', { src: swapImage, alt: swapAlt, className: 'hover-img' }) : ''
              ) : wp.element.createElement(
                'div',
                { className: 'no-image' },
                'No Headshot'
              )
            ),
            wp.element.createElement(
              'div',
              { className: 'team-details' },
              name ? wp.element.createElement(RichText.Content, { tagName: 'h3', value: name, className: 'name' }) : '',
              title ? wp.element.createElement(RichText.Content, {
                tagName: 'strong',
                value: title,
                className: 'title'
              }) : '',
              email ? wp.element.createElement(
                'a',
                { className: 'email', href: 'mailto:' + email },
                'Email'
              ) : '',
              phone ? wp.element.createElement(RichText.Content, { tagName: 'p', value: phone, className: 'phone' }) : '',
              showPopup ? wp.element.createElement(
                'div',
                { className: 'nab_model_head' },
                wp.element.createElement('input', { type: 'button', className: 'nab_popup_btn btn-primary bio-btn', value: 'Bio' }),
                wp.element.createElement(
                  'div',
                  { className: 'nab_model_main' },
                  wp.element.createElement(
                    'div',
                    { className: 'nab_model_inner' },
                    wp.element.createElement(
                      'div',
                      { className: 'nab_close_btn' },
                      wp.element.createElement(
                        'svg',
                        { width: '30', height: '30', viewBox: '0 0 30 30', fill: 'none', stroke: 'currentColor', 'stroke-width': '2', 'stroke-linecap': 'round', 'stroke-linejoin': 'round', className: 'feather feather-x' },
                        wp.element.createElement('line', { x1: '20', y1: '10', x2: '10', y2: '20' }),
                        wp.element.createElement('line', { x1: '10', y1: '10', x2: '20', y2: '20' })
                      )
                    ),
                    wp.element.createElement(
                      'div',
                      { className: 'nab_model_wrap' },
                      wp.element.createElement(
                        'div',
                        { className: 'nab_pop_up_content_wrap' },
                        wp.element.createElement(InnerBlocks.Content, null)
                      )
                    )
                  ),
                  wp.element.createElement('div', { className: 'nab_bg_overlay' })
                )
              ) : ''
            )
          )
        );
      }
    }
  });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);

/***/ }),
/* 111 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_lodash_times__ = __webpack_require__(15);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_lodash_times___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_lodash_times__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_memize__ = __webpack_require__(16);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_memize___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1_memize__);



(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
    var __ = wpI18n.__;
    var registerBlockType = wpBlocks.registerBlockType;
    var Fragment = wpElement.Fragment;
    var RichText = wpEditor.RichText,
        MediaUpload = wpEditor.MediaUpload,
        BlockControls = wpEditor.BlockControls,
        InspectorControls = wpEditor.InspectorControls,
        InnerBlocks = wpEditor.InnerBlocks;
    var PanelBody = wpComponents.PanelBody,
        PanelRow = wpComponents.PanelRow,
        ToggleControl = wpComponents.ToggleControl,
        Button = wpComponents.Button,
        Toolbar = wpComponents.Toolbar,
        IconButton = wpComponents.IconButton;


    var awardBlockIcons = wp.element.createElement(
        'svg',
        { width: '150px', height: '150px', viewBox: '0 0 150 150', 'enable-background': 'new 0 0 150 150' },
        wp.element.createElement(
            'g',
            null,
            wp.element.createElement(
                'g',
                null,
                wp.element.createElement('path', { fill: '#146DB6', d: 'M114.949,43.59H36.331c-1.118,0-2.024,0.906-2.024,2.024s0.906,2.024,2.024,2.024h78.618\r c1.118,0,2.024-0.906,2.024-2.024S116.066,43.59,114.949,43.59z' })
            )
        ),
        wp.element.createElement(
            'g',
            null,
            wp.element.createElement(
                'g',
                null,
                wp.element.createElement('path', { fill: '#146DB6', d: 'M114.949,65.628H36.331c-1.118,0-2.024,0.906-2.024,2.024c0,1.118,0.906,2.024,2.024,2.024h78.618\r c1.118,0,2.024-0.906,2.024-2.024S116.066,65.628,114.949,65.628z' })
            )
        ),
        wp.element.createElement(
            'g',
            null,
            wp.element.createElement(
                'g',
                null,
                wp.element.createElement('path', { fill: '#146DB6', d: 'M89.175,79.93H62.105c-1.118,0-2.024,0.906-2.024,2.024s0.906,2.024,2.024,2.024h27.069\r c1.118,0,2.023-0.906,2.023-2.024S90.293,79.93,89.175,79.93z' })
            )
        ),
        wp.element.createElement(
            'g',
            null,
            wp.element.createElement(
                'g',
                null,
                wp.element.createElement('path', { fill: '#146DB6', d: 'M114.949,54.564H56.307c-1.118,0-2.024,0.906-2.024,2.024c0,1.117,0.906,2.024,2.024,2.024h58.642\r c1.117,0,2.024-0.906,2.024-2.024C116.974,55.47,116.066,54.564,114.949,54.564z' })
            )
        ),
        wp.element.createElement(
            'g',
            null,
            wp.element.createElement(
                'g',
                null,
                wp.element.createElement('path', { fill: '#146DB6', d: 'M46.89,54.563H36.331c-1.118,0-2.024,0.906-2.024,2.024s0.906,2.024,2.024,2.024H46.89\r c1.118,0,2.024-0.906,2.024-2.024C48.914,55.47,48.008,54.563,46.89,54.563z' })
            )
        ),
        wp.element.createElement(
            'g',
            null,
            wp.element.createElement(
                'g',
                null,
                wp.element.createElement('path', { fill: '#146DB6', d: 'M134.223,40.169c-0.471-0.462-1.095-0.717-1.759-0.717c-0.001,0-0.001,0-0.002,0\r c-4.102,0-7.46-3.207-7.645-7.301c-0.061-1.332-1.154-2.375-2.49-2.375H28.472c-1.337,0-2.431,1.043-2.492,2.375\r c-0.176,3.913-3.379,7.117-7.292,7.292c-1.333,0.06-2.375,1.154-2.375,2.491v52.318c0,1.337,1.043,2.431,2.375,2.49\r c3.913,0.177,7.116,3.38,7.292,7.294c0.061,1.332,1.155,2.375,2.492,2.375h59.749c1.117,0,2.023-0.906,2.023-2.024\r s-0.905-2.024-2.023-2.024H29.864c-0.836-4.875-4.628-8.666-9.503-9.504V43.327c4.875-0.836,8.667-4.629,9.503-9.503h91.072\r c0.871,5.029,4.92,8.911,9.984,9.575v34.373c0,1.117,0.906,2.023,2.024,2.023s2.023-0.905,2.023-2.023V41.947\r C134.968,41.273,134.703,40.642,134.223,40.169z' })
            )
        ),
        wp.element.createElement(
            'g',
            null,
            wp.element.createElement(
                'g',
                null,
                wp.element.createElement('path', { fill: '#146DB6', d: 'M139.053,19.673H12.228c-3.098,0-5.618,2.521-5.618,5.618v85.606c0,3.098,2.521,5.618,5.618,5.618h84.953\r l-3.008,6.303c-0.387,0.81-0.292,1.758,0.245,2.477c0.537,0.718,1.422,1.074,2.306,0.933l5.601-0.9l3.123,5.127\r c0.438,0.72,1.216,1.154,2.053,1.154c0.04,0,0.081-0.002,0.122-0.004c0.883-0.045,1.667-0.567,2.048-1.365l5.427-11.372\r l5.427,11.371c0.38,0.797,1.164,1.321,2.047,1.366c0.041,0.003,0.083,0.004,0.124,0.004c0.836,0,1.614-0.435,2.052-1.153\r l3.124-5.127l5.6,0.9c0.888,0.142,1.77-0.216,2.307-0.935s0.631-1.667,0.244-2.475l-3.008-6.303h6.04\r c3.098,0,5.618-2.521,5.618-5.618V25.291C144.671,22.193,142.15,19.673,139.053,19.673z M107.324,125.755l-2.118-3.477\r c-0.511-0.838-1.466-1.278-2.435-1.123l-3.596,0.578l3.787-7.937c1.493,1.523,3.62,2.347,5.827,2.139\r c0.755-0.072,1.512,0.131,2.13,0.57c0.204,0.146,0.416,0.273,0.63,0.395L107.324,125.755z M115.579,113.754\r c-0.006,0-0.012,0.001-0.019,0.002c-0.307,0.045-0.619,0.045-0.926,0.001c-0.008-0.002-0.016-0.003-0.023-0.004\r c-0.475-0.073-0.938-0.256-1.347-0.546c-1.224-0.87-2.686-1.333-4.177-1.333c-0.227,0-0.453,0.011-0.68,0.031\r c-1.34,0.127-2.612-0.608-3.172-1.831c-0.248-0.542-0.565-1.044-0.934-1.504c-0.016-0.022-0.033-0.044-0.051-0.066\r c-0.021-0.024-0.039-0.05-0.06-0.075c-0.024-0.026-0.048-0.053-0.073-0.079c-0.669-0.771-1.496-1.399-2.438-1.83\r c-1.223-0.56-1.958-1.834-1.831-3.173c0.163-1.722-0.299-3.446-1.301-4.855c-0.779-1.096-0.779-2.568-0.001-3.664\r c1.003-1.409,1.465-3.134,1.302-4.855c-0.127-1.339,0.609-2.613,1.831-3.173c1.573-0.72,2.836-1.982,3.556-3.555\r c0.56-1.223,1.837-1.958,3.172-1.832c1.725,0.163,3.447-0.299,4.856-1.301c1.096-0.778,2.567-0.778,3.663,0\r c1.41,1.002,3.134,1.463,4.856,1.301c1.34-0.127,2.613,0.61,3.173,1.832c0.72,1.572,1.982,2.836,3.555,3.555\r c1.223,0.56,1.958,1.834,1.832,3.172c-0.163,1.723,0.299,3.447,1.301,4.856c0.779,1.096,0.779,2.567,0,3.663\r c-1.002,1.41-1.464,3.135-1.301,4.856c0.126,1.338-0.609,2.613-1.832,3.173c-0.94,0.43-1.765,1.058-2.434,1.825\r c-0.027,0.028-0.055,0.058-0.08,0.087c-0.017,0.021-0.033,0.043-0.051,0.064c-0.021,0.025-0.041,0.051-0.06,0.078\r c-0.367,0.458-0.684,0.959-0.931,1.5c-0.56,1.223-1.835,1.959-3.173,1.831c-1.721-0.161-3.446,0.3-4.856,1.302\r C116.519,113.498,116.056,113.681,115.579,113.754z M127.422,121.155c-0.97-0.155-1.924,0.285-2.435,1.123l-2.118,3.478\r l-4.226-8.855c0.215-0.121,0.426-0.249,0.63-0.395c0.619-0.439,1.376-0.644,2.13-0.57c2.208,0.208,4.335-0.615,5.827-2.139\r l3.787,7.937L127.422,121.155z M140.623,110.897c0,0.866-0.704,1.57-1.57,1.57h-7.972l-1.044-2.187\r c0.053-0.027,0.105-0.057,0.16-0.082c2.787-1.275,4.466-4.183,4.177-7.234c-0.071-0.755,0.131-1.512,0.57-2.13\r c1.776-2.498,1.776-5.855,0-8.354c-0.439-0.618-0.642-1.374-0.57-2.13c0.289-3.051-1.39-5.959-4.178-7.234\r c-0.689-0.315-1.243-0.869-1.559-1.559c-1.275-2.788-4.184-4.466-7.234-4.177c-0.756,0.071-1.512-0.131-2.13-0.571\r c-2.498-1.776-5.855-1.776-8.354,0c-0.618,0.44-1.377,0.643-2.13,0.57c-3.055-0.287-5.959,1.39-7.234,4.178\r c-0.315,0.689-0.869,1.242-1.559,1.559c-2.788,1.275-4.466,4.183-4.178,7.234c0.071,0.755-0.131,1.512-0.57,2.13\r c-1.775,2.498-1.775,5.855,0,8.354c0.439,0.618,0.642,1.374,0.57,2.13c-0.288,3.052,1.39,5.959,4.178,7.234\r c0.054,0.024,0.106,0.054,0.158,0.082l-1.043,2.187H12.228c-0.866,0-1.57-0.704-1.57-1.57V25.291c0-0.866,0.705-1.57,1.57-1.57\r h126.825c0.865,0,1.57,0.705,1.57,1.57V110.897L140.623,110.897z' })
            )
        ),
        wp.element.createElement(
            'g',
            null,
            wp.element.createElement(
                'g',
                null,
                wp.element.createElement('path', { fill: '#146DB6', d: 'M114.949,84.084c-6.934,0-12.575,5.641-12.575,12.574c0,6.935,5.641,12.575,12.575,12.575\r c6.934,0,12.574-5.641,12.574-12.575C127.523,89.725,121.883,84.084,114.949,84.084z M114.949,105.186\r c-4.702,0-8.527-3.825-8.527-8.527c0-4.701,3.825-8.527,8.527-8.527c4.701,0,8.526,3.825,8.526,8.527\r S119.65,105.186,114.949,105.186z' })
            )
        )
    );

    var allAttributes = {
        blockId: {
            type: 'string'
        },
        noOfAwards: {
            type: 'number',
            default: 1
        },
        noOfAwardsInner: {
            type: 'number',
            default: 1
        },
        title: {
            type: 'string',
            default: 'Award Name'
        },
        captionText: {
            type: 'string',
            default: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.'
        },
        showTitle: {
            type: 'boolean',
            default: false
        },
        imageAlt: {
            attribute: 'alt'
        },
        imageUrl: {
            attribute: 'src'
        },
        imageID: {
            type: 'number'
        },
        winnerName: {
            type: 'string'
        },
        jobLocation: {
            type: 'string'
        },
        details: {
            type: 'string'
        },
        showPopup: {
            type: 'boolean',
            default: false
        },
        modelClass: {
            type: 'string'
        },
        showFilter: {
            type: 'boolean',
            default: false
        }
    };

    var ALLOWBLOCKS = ['nab/awards-item'];

    var removehildawardsBlock = __WEBPACK_IMPORTED_MODULE_1_memize___default()(function (awards) {
        return __WEBPACK_IMPORTED_MODULE_0_lodash_times___default()(awards, function (n) {
            return ['nab/awards-item', { id: n - 1 }];
        });
    });

    /* Parent awards Block */
    registerBlockType('nab/awards', {
        title: __('awards'),
        description: __('awards'),
        icon: { src: awardBlockIcons },
        category: 'nabshow',
        keywords: [__('awards'), __('gutenberg'), __('nab')],
        attributes: allAttributes,
        edit: function edit(props, attributes) {
            var _props$attributes = props.attributes,
                title = _props$attributes.title,
                captionText = _props$attributes.captionText,
                showTitle = _props$attributes.showTitle,
                noOfAwards = _props$attributes.noOfAwards,
                showFilter = _props$attributes.showFilter,
                className = props.className,
                setAttributes = props.setAttributes,
                clientId = props.clientId;


            jQuery(document).on('click', '#block-' + clientId + ' .col-lg-6 .remove-item', function (e) {
                if ('' !== jQuery(this).parents('#block-' + clientId)) {
                    setAttributes({ noOfAwards: noOfAwards - 1 });
                    removehildawardsBlock(noOfAwards);
                }
            });

            return wp.element.createElement(
                Fragment,
                null,
                wp.element.createElement(
                    InspectorControls,
                    null,
                    wp.element.createElement(
                        PanelBody,
                        { title: 'General Settings' },
                        wp.element.createElement(
                            PanelRow,
                            null,
                            wp.element.createElement(ToggleControl, {
                                label: __('Show Title of Award'),
                                checked: showTitle,
                                onChange: function onChange() {
                                    return setAttributes({ showTitle: !showTitle });
                                }
                            })
                        ),
                        wp.element.createElement(
                            PanelRow,
                            null,
                            wp.element.createElement(ToggleControl, {
                                label: __('Show Filter'),
                                checked: showFilter,
                                onChange: function onChange() {
                                    return setAttributes({ showFilter: !showFilter });
                                }
                            })
                        )
                    )
                ),
                showFilter && wp.element.createElement(
                    'div',
                    { className: 'wp-block-nab-multipurpose-gutenberg-block' },
                    wp.element.createElement(
                        'div',
                        { className: 'schedule-glance-filter awards-filtering' },
                        wp.element.createElement(
                            'div',
                            { className: 'awards-name' },
                            wp.element.createElement(
                                'label',
                                null,
                                'Award Name'
                            ),
                            wp.element.createElement(
                                'div',
                                { className: 'schedule-select' },
                                wp.element.createElement(
                                    'select',
                                    { id: 'award-name' },
                                    wp.element.createElement(
                                        'option',
                                        null,
                                        'Select an Award'
                                    )
                                )
                            )
                        ),
                        wp.element.createElement(
                            'div',
                            { className: 'search-box' },
                            wp.element.createElement(
                                'label',
                                null,
                                'Winner Name'
                            ),
                            wp.element.createElement(
                                'div',
                                { className: 'schedule-select' },
                                wp.element.createElement('input', { id: 'box-main-search', className: 'schedule-search awards-search', name: 'schedule-search', type: 'text', placeholder: 'Filter by name...' })
                            )
                        )
                    )
                ),
                wp.element.createElement(
                    'div',
                    { className: 'awards-main ' + className },
                    wp.element.createElement(
                        Fragment,
                        null,
                        wp.element.createElement(
                            'div',
                            { className: 'awards-header' },
                            !showTitle ? wp.element.createElement(RichText, {
                                tagName: 'h2',
                                onChange: function onChange(value) {
                                    return setAttributes({ title: value });
                                },
                                placeholder: __('Title'),
                                value: title,
                                className: 'awards-winner-title'
                            }) : '',
                            wp.element.createElement(RichText, {
                                tagName: 'p',
                                onChange: function onChange(value) {
                                    return setAttributes({ captionText: value });
                                },
                                placeholder: __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.'),
                                value: captionText
                            })
                        ),
                        wp.element.createElement(
                            'div',
                            { className: 'awards-data row' },
                            wp.element.createElement(InnerBlocks, {
                                allowedBlocks: ALLOWBLOCKS
                            })
                        )
                    )
                )
            );
        },
        save: function save(props) {
            var _props$attributes2 = props.attributes,
                title = _props$attributes2.title,
                captionText = _props$attributes2.captionText,
                showTitle = _props$attributes2.showTitle,
                showFilter = _props$attributes2.showFilter,
                className = props.className;

            return wp.element.createElement(
                Fragment,
                null,
                showFilter && wp.element.createElement(
                    'div',
                    { className: 'wp-block-nab-multipurpose-gutenberg-block' },
                    wp.element.createElement(
                        'div',
                        { className: 'schedule-glance-filter awards-filtering' },
                        wp.element.createElement(
                            'div',
                            { className: 'awards-name' },
                            wp.element.createElement(
                                'label',
                                null,
                                'Award Name'
                            ),
                            wp.element.createElement(
                                'div',
                                { className: 'schedule-select' },
                                wp.element.createElement(
                                    'select',
                                    { id: 'award-name' },
                                    wp.element.createElement(
                                        'option',
                                        null,
                                        'Select an Award'
                                    )
                                )
                            )
                        ),
                        wp.element.createElement(
                            'div',
                            { className: 'search-box' },
                            wp.element.createElement(
                                'label',
                                null,
                                'Winner Name'
                            ),
                            wp.element.createElement(
                                'div',
                                { className: 'schedule-select' },
                                wp.element.createElement('input', { id: 'box-main-search', className: 'schedule-search awards-search', name: 'schedule-search', type: 'text', placeholder: 'Filter by name...' })
                            )
                        )
                    )
                ),
                wp.element.createElement(
                    'div',
                    { className: 'awards-main ' + className },
                    wp.element.createElement(
                        'div',
                        { className: 'awards-header' },
                        !showTitle ? wp.element.createElement(RichText.Content, {
                            tagName: 'h2',
                            value: title,
                            className: 'awards-winner-title'
                        }) : '',
                        wp.element.createElement(RichText.Content, {
                            tagName: 'p',
                            value: captionText
                        })
                    ),
                    wp.element.createElement(
                        'div',
                        { className: 'awards-data row' },
                        wp.element.createElement(InnerBlocks.Content, null)
                    )
                )
            );
        }
    });

    /* awards Block */
    registerBlockType('nab/awards-item', {
        title: __('awards Items'),
        description: __('awards Items'),
        icon: { src: awardBlockIcons },
        category: 'nabshow',
        parent: ['nab/awards'],
        attributes: allAttributes,
        edit: function edit(props) {
            var attributes = props.attributes,
                setAttributes = props.setAttributes,
                clientId = props.clientId;
            var imageAlt = attributes.imageAlt,
                imageUrl = attributes.imageUrl,
                winnerName = attributes.winnerName,
                jobLocation = attributes.jobLocation,
                details = attributes.details,
                imageID = attributes.imageID,
                modelClass = attributes.modelClass,
                showPopup = attributes.showPopup;


            if (document.getElementById('wpwrap').classList.contains('nab_body_model_open')) {
                setAttributes({ modelClass: 'nab_model_open' });
            } else {
                setAttributes({ modelClass: '' });
            }

            function modelopen() {
                var ele = document.getElementById('wpwrap');
                ele.classList.add('nab_body_model_open');
                setAttributes({ modelClass: 'nab_model_open' });
            }
            function modelclose() {
                var ele = document.getElementById('wpwrap');
                ele.classList.remove('nab_body_model_open');
                setAttributes({ modelClass: '' });
            }
            return wp.element.createElement(
                Fragment,
                null,
                wp.element.createElement(
                    InspectorControls,
                    null,
                    wp.element.createElement(
                        PanelBody,
                        { title: 'Popup Settings', initialOpen: true },
                        wp.element.createElement(
                            PanelRow,
                            null,
                            wp.element.createElement(ToggleControl, {
                                label: __('Show Popup'),
                                checked: showPopup,
                                onChange: function onChange() {
                                    return setAttributes({ showPopup: !showPopup });
                                }
                            })
                        )
                    )
                ),
                wp.element.createElement(
                    'div',
                    { className: 'col-lg-6 col-md-6 col-sm-12' },
                    wp.element.createElement(
                        'span',
                        { className: 'remove-item' },
                        wp.element.createElement(IconButton, {
                            className: 'components-toolbar__control',
                            label: __('Remove image'),
                            icon: 'no',
                            onClick: function onClick() {
                                wp.data.dispatch('core/editor').removeBlocks(clientId);
                            }
                        })
                    ),
                    wp.element.createElement(
                        'div',
                        { className: 'awards-row' },
                        wp.element.createElement(
                            'div',
                            { className: 'winnerSide' },
                            wp.element.createElement(
                                'div',
                                { className: 'winnerImage' },
                                !imageID && wp.element.createElement(MediaUpload, {
                                    allowedTypes: ['image'],
                                    value: imageID,
                                    onSelect: function onSelect(image) {
                                        return setAttributes({ imageAlt: image.alt, imageUrl: image.url, imageID: image.id });
                                    },
                                    render: function render(_ref) {
                                        var open = _ref.open;
                                        return wp.element.createElement(
                                            Button,
                                            {
                                                className: 'button button-large',
                                                onClick: open
                                            },
                                            __('Choose image')
                                        );
                                    }
                                }),
                                imageID && wp.element.createElement(
                                    Fragment,
                                    null,
                                    wp.element.createElement(
                                        BlockControls,
                                        null,
                                        wp.element.createElement(
                                            Toolbar,
                                            null,
                                            wp.element.createElement(MediaUpload, {
                                                allowedTypes: ['image'],
                                                value: imageID,
                                                onSelect: function onSelect(image) {
                                                    return setAttributes({ imageAlt: image.alt, imageUrl: image.url, imageID: image.id });
                                                },
                                                render: function render(_ref2) {
                                                    var open = _ref2.open;
                                                    return wp.element.createElement(IconButton, {
                                                        className: 'components-toolbar__control',
                                                        label: __('Change image'),
                                                        icon: 'edit',
                                                        onClick: open
                                                    });
                                                }
                                            }),
                                            wp.element.createElement(IconButton, {
                                                className: 'components-toolbar__control',
                                                label: __('Remove image'),
                                                icon: 'no',
                                                onClick: function onClick() {
                                                    return setAttributes({ imageUrl: undefined, imageID: undefined });
                                                }
                                            })
                                        )
                                    ),
                                    wp.element.createElement('img', { src: imageUrl, alt: imageAlt })
                                )
                            ),
                            wp.element.createElement(
                                'div',
                                { className: 'winnerName' },
                                wp.element.createElement(RichText, {
                                    tagName: 'h3',
                                    onChange: function onChange(value) {
                                        return setAttributes({ winnerName: value });
                                    },
                                    value: winnerName,
                                    placeholder: 'Winner Name'
                                })
                            ),
                            wp.element.createElement(
                                'div',
                                { className: 'jobLocation' },
                                wp.element.createElement(RichText, {
                                    tagName: 'p',
                                    onChange: function onChange(value) {
                                        return setAttributes({ jobLocation: value });
                                    },
                                    value: jobLocation,
                                    placeholder: __('Job Title/Company/Location')
                                })
                            )
                        ),
                        wp.element.createElement(
                            'div',
                            { className: 'details' },
                            wp.element.createElement(RichText, {
                                tagName: 'p',
                                onChange: function onChange(value) {
                                    return setAttributes({ details: value });
                                },
                                value: details,
                                placeholder: __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. In viverra et eros nec ultricies. Etiam tincidunt diam orci, sit amet lacinia tellus rhoncus sed.')
                            }),
                            showPopup ? wp.element.createElement(
                                'div',
                                { className: 'nab_model_head' },
                                wp.element.createElement('input', { type: 'button', onClick: modelopen, className: 'nab_popup_btn btn-primary', value: 'Read More' }),
                                wp.element.createElement(
                                    'div',
                                    { className: 'nab_model_main ' + modelClass },
                                    wp.element.createElement(
                                        'div',
                                        { className: 'nab_model_inner' },
                                        wp.element.createElement(
                                            'div',
                                            { className: 'nab_close_btn', onClick: modelclose },
                                            wp.element.createElement(
                                                'svg',
                                                { width: '30', height: '30', viewBox: '0 0 30 30', fill: 'none', stroke: 'currentColor', 'stroke-width': '2', 'stroke-linecap': 'round', 'stroke-linejoin': 'round', className: 'feather feather-x' },
                                                wp.element.createElement('line', { x1: '20', y1: '10', x2: '10', y2: '20' }),
                                                wp.element.createElement('line', { x1: '10', y1: '10', x2: '20', y2: '20' })
                                            )
                                        ),
                                        wp.element.createElement(
                                            'div',
                                            { className: 'nab_model_wrap' },
                                            wp.element.createElement(
                                                'div',
                                                { className: 'nab_pop_up_content_wrap' },
                                                wp.element.createElement(InnerBlocks, { templateLock: false })
                                            )
                                        )
                                    ),
                                    wp.element.createElement('div', { className: 'nab_bg_overlay', onClick: modelclose })
                                )
                            ) : ''
                        )
                    )
                )
            );
        },
        save: function save(props) {
            var attributes = props.attributes;
            var imageAlt = attributes.imageAlt,
                imageUrl = attributes.imageUrl,
                winnerName = attributes.winnerName,
                jobLocation = attributes.jobLocation,
                details = attributes.details,
                showPopup = attributes.showPopup;

            return wp.element.createElement(
                'div',
                { className: 'col-lg-6 col-md-6 col-sm-12' },
                wp.element.createElement(
                    'div',
                    { className: 'awards-row' },
                    wp.element.createElement(
                        'div',
                        { className: 'winnerSide' },
                        wp.element.createElement(
                            'div',
                            { className: 'winnerImage' },
                            wp.element.createElement('img', { src: imageUrl, alt: imageAlt })
                        ),
                        wp.element.createElement(
                            'div',
                            { className: 'winnerName' },
                            wp.element.createElement(RichText.Content, {
                                tagName: 'h3',
                                value: winnerName === undefined ? '-' : winnerName
                            })
                        ),
                        wp.element.createElement(
                            'div',
                            { className: 'jobLocation' },
                            wp.element.createElement(RichText.Content, {
                                tagName: 'p',
                                value: jobLocation === undefined ? '-' : jobLocation
                            })
                        )
                    ),
                    wp.element.createElement(
                        'div',
                        { className: 'details' },
                        wp.element.createElement(RichText.Content, {
                            tagName: 'p',
                            value: details === undefined ? '-' : details
                        }),
                        showPopup ? wp.element.createElement(
                            'div',
                            { className: 'nab_model_head' },
                            wp.element.createElement('input', { type: 'button', className: 'nab_popup_btn btn-primary', value: 'Read More' }),
                            wp.element.createElement(
                                'div',
                                { className: 'nab_model_main' },
                                wp.element.createElement(
                                    'div',
                                    { className: 'nab_model_inner' },
                                    wp.element.createElement(
                                        'div',
                                        { className: 'nab_close_btn' },
                                        wp.element.createElement(
                                            'svg',
                                            { width: '30', height: '30', viewBox: '0 0 30 30', fill: 'none', stroke: 'currentColor', 'stroke-width': '2', 'stroke-linecap': 'round', 'stroke-linejoin': 'round', className: 'feather feather-x' },
                                            wp.element.createElement('line', { x1: '20', y1: '10', x2: '10', y2: '20' }),
                                            wp.element.createElement('line', { x1: '10', y1: '10', x2: '20', y2: '20' })
                                        )
                                    ),
                                    wp.element.createElement(
                                        'div',
                                        { className: 'nab_model_wrap' },
                                        wp.element.createElement(
                                            'div',
                                            { className: 'nab_pop_up_content_wrap' },
                                            wp.element.createElement(InnerBlocks.Content, null)
                                        )
                                    )
                                ),
                                wp.element.createElement('div', { className: 'nab_bg_overlay' })
                            )
                        ) : ''
                    )
                )
            );
        }
    });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);

/***/ }),
/* 112 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_lodash_pick__ = __webpack_require__(17);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_lodash_pick___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_lodash_pick__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__icons__ = __webpack_require__(3);
var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _toConsumableArray(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } else { return Array.from(arr); } }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }



(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
  var __ = wpI18n.__;
  var Component = wpElement.Component,
      Fragment = wpElement.Fragment;
  var registerBlockType = wpBlocks.registerBlockType;
  var InspectorControls = wpEditor.InspectorControls,
      MediaUpload = wpEditor.MediaUpload;
  var PanelBody = wpComponents.PanelBody,
      PanelRow = wpComponents.PanelRow,
      DateTimePicker = wpComponents.DateTimePicker,
      Tooltip = wpComponents.Tooltip,
      IconButton = wpComponents.IconButton,
      ToggleControl = wpComponents.ToggleControl,
      TextControl = wpComponents.TextControl,
      Button = wpComponents.Button,
      Placeholder = wpComponents.Placeholder;


  var adUploadIcon = wp.element.createElement(
    'svg',
    { xmlns: 'http://www.w3.org/2000/svg', width: '20', height: '20', viewBox: '2 2 22 22', className: 'dashicon' },
    wp.element.createElement('path', { fill: 'none', d: 'M0 0h24v24H0V0z' }),
    wp.element.createElement('path', { d: 'M20 4h-3.17L15 2H9L7.17 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zM9.88 4h4.24l1.83 2H20v12H4V6h4.05' }),
    wp.element.createElement('path', { d: 'M15 11H9V8.5L5.5 12 9 15.5V13h6v2.5l3.5-3.5L15 8.5z' })
  );

  var adBlockIcon = wp.element.createElement(
    'svg',
    { width: '150px', height: '150px', viewBox: '0 0 150 150', 'enable-background': 'new 0 0 150 150' },
    wp.element.createElement(
      'g',
      null,
      wp.element.createElement(
        'g',
        null,
        wp.element.createElement(
          'g',
          null,
          wp.element.createElement('path', { fill: '#146DB6', d: 'M133.758,4.449H16.676c-7.175,0-13.009,5.834-13.009,13.009v117.083c0,7.175,5.834,13.009,13.009,13.009\r h117.082c7.176,0,13.011-5.834,13.011-13.009V17.458C146.768,10.283,140.934,4.449,133.758,4.449z M140.263,134.541\r c0,3.585-2.919,6.506-6.505,6.506H16.676c-3.586,0-6.505-2.921-6.505-6.506V36.972h130.092V134.541L140.263,134.541z\r M140.263,30.467H10.171V17.458c0-3.586,2.918-6.504,6.505-6.504h117.082c3.586,0,6.505,2.918,6.505,6.504V30.467L140.263,30.467\r z' }),
          wp.element.createElement('circle', { fill: '#146DB6', cx: '19.928', cy: '20.71', r: '3.252' }),
          wp.element.createElement('circle', { fill: '#146DB6', cx: '32.938', cy: '20.71', r: '3.252' }),
          wp.element.createElement('circle', { fill: '#146DB6', cx: '45.946', cy: '20.71', r: '3.252' }),
          wp.element.createElement('path', { fill: '#146DB6', d: 'M26.433,108.521h65.045c1.798,0,3.252-1.454,3.252-3.252V53.234c0-1.798-1.455-3.253-3.252-3.253H26.433\r c-1.798,0-3.253,1.455-3.253,3.253v52.036C23.18,107.067,24.635,108.521,26.433,108.521z M29.685,56.485h58.541v45.533H29.685\r V56.485z' }),
          wp.element.createElement('path', { fill: '#146DB6', d: 'M45.946,62.99c-5.379,0-9.756,4.377-9.756,9.756v19.515c0,1.797,1.455,3.252,3.253,3.252\r c1.797,0,3.252-1.455,3.252-3.252V89.01h6.504v3.251c0,1.797,1.455,3.252,3.253,3.252c1.797,0,3.251-1.455,3.251-3.252V72.746\r C55.704,67.367,51.327,62.99,45.946,62.99z M49.199,82.503h-6.505v-9.757c0-1.794,1.458-3.251,3.252-3.251\r c1.795,0,3.253,1.458,3.253,3.251V82.503L49.199,82.503z' }),
          wp.element.createElement('path', { fill: '#146DB6', d: 'M71.964,62.99H65.46c-1.797,0-3.252,1.455-3.252,3.253v26.018c0,1.797,1.455,3.252,3.252,3.252h6.504\r c5.381,0,9.757-4.377,9.757-9.755V72.746C81.722,67.367,77.346,62.99,71.964,62.99z M75.217,85.758\r c0,1.792-1.458,3.252-3.253,3.252h-3.251V69.495h3.251c1.795,0,3.253,1.458,3.253,3.251V85.758L75.217,85.758z' }),
          wp.element.createElement('path', { fill: '#146DB6', d: 'M26.433,128.037h97.569c1.797,0,3.251-1.454,3.251-3.254c0-1.797-1.454-3.252-3.251-3.252H26.433\r c-1.798,0-3.253,1.455-3.253,3.254C23.18,126.583,24.635,128.037,26.433,128.037z' }),
          wp.element.createElement('path', { fill: '#146DB6', d: 'M104.487,69.495h19.515c1.799,0,3.253-1.455,3.253-3.251c0-1.798-1.456-3.253-3.253-3.253h-19.515\r c-1.798,0-3.251,1.456-3.251,3.253C101.236,68.04,102.689,69.495,104.487,69.495z' }),
          wp.element.createElement('path', { fill: '#146DB6', d: 'M104.487,89.01h19.515c1.799,0,3.253-1.455,3.253-3.252c0-1.8-1.456-3.255-3.253-3.255h-19.515\r c-1.798,0-3.251,1.457-3.251,3.255C101.236,87.555,102.689,89.01,104.487,89.01z' }),
          wp.element.createElement('path', { fill: '#146DB6', d: 'M104.487,108.521h19.515c1.799,0,3.253-1.454,3.253-3.252c0-1.797-1.456-3.251-3.253-3.251h-19.515\r c-1.798,0-3.251,1.454-3.251,3.251C101.236,107.067,102.689,108.521,104.487,108.521z' })
        )
      )
    )
  );

  var NabAdvertisement = function (_Component) {
    _inherits(NabAdvertisement, _Component);

    function NabAdvertisement() {
      _classCallCheck(this, NabAdvertisement);

      var _this = _possibleConstructorReturn(this, (NabAdvertisement.__proto__ || Object.getPrototypeOf(NabAdvertisement)).apply(this, arguments));

      _this.state = {
        currentSelected: 0
      };
      return _this;
    }

    _createClass(NabAdvertisement, [{
      key: 'updateMediaData',
      value: function updateMediaData(data) {
        var currentSelected = this.state.currentSelected;


        if ('number' !== typeof currentSelected) {
          return null;
        }

        var _props = this.props,
            attributes = _props.attributes,
            setAttributes = _props.setAttributes;
        var imgSources = attributes.imgSources;


        var newSources = imgSources.map(function (imgSources, index) {
          if (index === currentSelected) {
            imgSources = Object.assign({}, imgSources, data);
          }
          return imgSources;
        });

        setAttributes({ imgSources: newSources });
      }
    }, {
      key: 'render',
      value: function render() {
        var _this2 = this;

        var _props2 = this.props,
            _props2$attributes = _props2.attributes,
            imgSources = _props2$attributes.imgSources,
            imgWidth = _props2$attributes.imgWidth,
            imgHeight = _props2$attributes.imgHeight,
            linkTarget = _props2$attributes.linkTarget,
            scheduleAd = _props2$attributes.scheduleAd,
            startDate = _props2$attributes.startDate,
            endDate = _props2$attributes.endDate,
            showCal = _props2$attributes.showCal,
            addAlign = _props2$attributes.addAlign,
            setAttributes = _props2.setAttributes,
            isSelected = _props2.isSelected;
        var currentSelected = this.state.currentSelected;


        var style = {};

        imgWidth && (style.width = imgWidth + 'px');
        imgHeight && (style.height = imgHeight + 'px');

        jQuery(document).on('click', '.inspector-field-toggleCal .components-form-toggle__input', function (e) {
          e.stopImmediatePropagation();
          if (!jQuery('.inspector-field-datetime .components-datetime__date').hasClass('toggled')) {
            jQuery('.inspector-field-datetime .components-datetime__date').show();
            jQuery('.components-datetime .components-datetime__date').addClass('toggled');
            jQuery('.components-datetime .components-datetime__date > div').removeClass('DayPicker__hidden');
            setAttributes({ showCal: !showCal });
          } else {
            jQuery('.inspector-field-datetime .components-datetime__date').hide();
            jQuery('.components-datetime .components-datetime__date').removeClass('toggled');
            jQuery('.components-datetime .components-datetime__date > div').addClass('DayPicker__hidden');
            setAttributes({ showCal: showCal });
          }
        });

        if (0 === imgSources.length) {
          return wp.element.createElement(
            'div',
            { className: 'admedia-placeholder' },
            wp.element.createElement(
              Placeholder,
              {
                icon: adUploadIcon,
                label: __('Advertisement'),
                instructions: __('No image selected. Add image to start using this block.')
              },
              wp.element.createElement(MediaUpload, {
                allowedTypes: ['image'],
                value: null,
                multiple: true,
                onSelect: function onSelect(item) {
                  var mediaInsert = item.map(function (source) {
                    return {
                      url: source.url,
                      id: source.id
                    };
                  });

                  setAttributes({
                    imgSources: [].concat(_toConsumableArray(imgSources), _toConsumableArray(mediaInsert))
                  });
                },
                render: function render(_ref) {
                  var open = _ref.open;
                  return wp.element.createElement(
                    Button,
                    { className: 'button button-large button-primary', onClick: open },
                    __('Add image')
                  );
                }
              })
            )
          );
        }

        if (!startDate) {
          setAttributes({ startDate: moment().format('YYYY-MM-DDTHH:mm:ss') });
        }
        return wp.element.createElement(
          Fragment,
          null,
          wp.element.createElement(
            InspectorControls,
            null,
            wp.element.createElement(
              PanelBody,
              { title: __('Schedule Display Settings') },
              wp.element.createElement(ToggleControl, {
                label: __('Display According to Date time'),
                checked: scheduleAd,
                onChange: function onChange() {
                  return setAttributes({ scheduleAd: !scheduleAd });
                }
              }),
              scheduleAd && wp.element.createElement(
                Fragment,
                null,
                wp.element.createElement(
                  'div',
                  { className: 'inspector-field inspector-field-toggleCal components-base-control' },
                  wp.element.createElement(
                    'div',
                    { className: 'toggleCalender' },
                    wp.element.createElement(
                      'span',
                      { className: 'cal' },
                      wp.element.createElement(
                        'svg',
                        { xmlns: 'http://www.w3.org/2000/svg', viewBox: '0 0 448 512' },
                        wp.element.createElement('path', { d: 'M436 160H12c-6.6 0-12-5.4-12-12v-36c0-26.5 21.5-48 48-48h48V12c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v52h128V12c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v52h48c26.5 0 48 21.5 48 48v36c0 6.6-5.4 12-12 12zM12 192h424c6.6 0 12 5.4 12 12v260c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V204c0-6.6 5.4-12 12-12zm116 204c0-6.6-5.4-12-12-12H76c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12v-40zm0-128c0-6.6-5.4-12-12-12H76c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12v-40zm128 128c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12v-40zm0-128c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12v-40zm128 128c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12v-40zm0-128c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12v-40z' })
                      )
                    ),
                    wp.element.createElement(
                      'span',
                      { className: 'text' },
                      'Toggle Calendar'
                    )
                  ),
                  wp.element.createElement(ToggleControl, {
                    checked: showCal
                  })
                ),
                wp.element.createElement(
                  'div',
                  { className: 'inspector-field inspector-field-datetime components-base-control' },
                  wp.element.createElement(
                    'label',
                    { className: 'inspector-mb-0' },
                    'Select Date time to start display'
                  ),
                  wp.element.createElement(
                    'div',
                    { className: 'inspector-ml-auto' },
                    wp.element.createElement(DateTimePicker, {
                      currentDate: startDate,
                      onChange: function onChange(date) {
                        return setAttributes({ startDate: date });
                      }
                    })
                  )
                ),
                wp.element.createElement(
                  'div',
                  { className: 'inspector-field inspector-field-datetime components-base-control' },
                  wp.element.createElement(
                    'label',
                    { className: 'inspector-mb-0' },
                    'Select Date time to remove'
                  ),
                  wp.element.createElement(
                    'div',
                    { className: 'inspector-ml-auto' },
                    wp.element.createElement(DateTimePicker, {
                      currentDate: endDate,
                      onChange: function onChange(date) {
                        return setAttributes({ endDate: date });
                      }
                    })
                  )
                )
              )
            ),
            wp.element.createElement(
              PanelBody,
              { title: __('Image Settings'), initialOpen: false },
              wp.element.createElement(
                PanelRow,
                null,
                wp.element.createElement(
                  'div',
                  { className: 'inspector-field alignment-settings' },
                  wp.element.createElement(
                    'div',
                    { className: 'alignment-wrapper' },
                    wp.element.createElement(TextControl, {
                      label: 'Width',
                      type: 'number',
                      value: imgWidth,
                      min: 1,
                      max: 1500,
                      step: 1,
                      onChange: function onChange(width) {
                        return setAttributes({ imgWidth: parseInt(width) });
                      }
                    })
                  ),
                  wp.element.createElement(
                    'div',
                    { className: 'alignment-wrapper' },
                    wp.element.createElement(TextControl, {
                      label: 'Height',
                      type: 'number',
                      value: imgHeight,
                      min: 1,
                      max: 1500,
                      step: 1,
                      onChange: function onChange(height) {
                        return setAttributes({ imgHeight: parseInt(height) });
                      }
                    })
                  )
                )
              ),
              wp.element.createElement(
                PanelRow,
                null,
                wp.element.createElement(
                  'div',
                  { className: 'inspector-field inspector-field-alignment' },
                  wp.element.createElement(
                    'label',
                    { className: 'inspector-mb-0' },
                    'Alignment'
                  ),
                  wp.element.createElement(
                    'div',
                    { className: 'inspector-field-button-list inspector-field-button-list-fluid' },
                    wp.element.createElement(
                      'button',
                      { className: 'left' === addAlign ? 'active  inspector-button' : 'inspector-button', onClick: function onClick() {
                          return setAttributes({ addAlign: 'left' });
                        } },
                      wp.element.createElement('i', { className: 'fa fa-align-left' })
                    ),
                    wp.element.createElement(
                      'button',
                      { className: 'center' === addAlign ? 'active  inspector-button' : 'inspector-button', onClick: function onClick() {
                          return setAttributes({ addAlign: 'center' });
                        } },
                      wp.element.createElement('i', { className: 'fa fa-align-center' })
                    ),
                    wp.element.createElement(
                      'button',
                      { className: 'right' === addAlign ? 'active  inspector-button' : 'inspector-button', onClick: function onClick() {
                          return setAttributes({ addAlign: 'right' });
                        } },
                      wp.element.createElement('i', { className: 'fa fa-align-right' })
                    )
                  )
                )
              )
            ),
            wp.element.createElement(
              PanelBody,
              { title: __('Link Settings'), initialOpen: false },
              wp.element.createElement(ToggleControl, {
                label: __('Open in New Tab'),
                checked: linkTarget,
                onChange: function onChange() {
                  return setAttributes({ linkTarget: !linkTarget });
                }
              })
            )
          ),
          wp.element.createElement(
            'div',
            { className: 'nab-banner-main', style: { textAlign: addAlign } },
            wp.element.createElement(
              'div',
              { className: 'nab-banner-inner' },
              wp.element.createElement(
                'p',
                { className: 'banner-text' },
                'Advertisement'
              ),
              wp.element.createElement('img', { src: imgSources[currentSelected].url,
                className: 'banner-img',
                alt: __('image'),
                style: style
              }),
              isSelected && wp.element.createElement(
                'div',
                { className: 'nab-ad-controls' },
                wp.element.createElement(
                  'div',
                  { className: 'nab-controls-wrapper' },
                  wp.element.createElement(
                    'div',
                    { className: 'nab-ad-field img-link' },
                    wp.element.createElement(TextControl, {
                      label: __('Link URL'),
                      placeholder: 'https://',
                      value: imgSources[currentSelected] ? imgSources[currentSelected].bannerLink || '' : '',
                      onChange: function onChange(value) {
                        return _this2.updateMediaData({ bannerLink: value || '' });
                      }
                    })
                  ),
                  wp.element.createElement(
                    'strong',
                    null,
                    'Google Event'
                  ),
                  wp.element.createElement(
                    'div',
                    { className: 'nab-ad-field google-event' },
                    wp.element.createElement(TextControl, {
                      label: __('Event Category'),
                      placeholder: 'Enter Category',
                      value: imgSources[currentSelected] ? imgSources[currentSelected].eventCategory || '' : '',
                      onChange: function onChange(value) {
                        return _this2.updateMediaData({ eventCategory: value || '' });
                      }
                    })
                  ),
                  wp.element.createElement(
                    'div',
                    { className: 'nab-ad-field google-event' },
                    wp.element.createElement(TextControl, {
                      label: __('Event Action'),
                      placeholder: 'Enter Action',
                      value: imgSources[currentSelected] ? imgSources[currentSelected].eventAction || '' : '',
                      onChange: function onChange(value) {
                        return _this2.updateMediaData({ eventAction: value || '' });
                      }
                    })
                  ),
                  wp.element.createElement(
                    'div',
                    { className: 'nab-ad-field google-event' },
                    wp.element.createElement(TextControl, {
                      label: __('Event Label'),
                      placeholder: 'Enter Label',
                      value: imgSources[currentSelected] ? imgSources[currentSelected].eventLabel || '' : '',
                      onChange: function onChange(value) {
                        return _this2.updateMediaData({ eventLabel: value || '' });
                      }
                    })
                  )
                ),
                wp.element.createElement(
                  'div',
                  { className: 'nab-ad-list' },
                  imgSources.map(function (source, index) {
                    return wp.element.createElement(
                      'div',
                      { className: 'nab-ad-img-list-item', key: index },
                      wp.element.createElement(MediaUpload, {
                        value: source.id,
                        onSelect: function onSelect(item) {
                          var editItem = [].concat(_toConsumableArray(imgSources));
                          editItem[index].url = item.url;
                          editItem[index].id = item.id;

                          setAttributes({
                            imgSources: editItem
                          });
                        },
                        render: function render(_ref2) {
                          var open = _ref2.open;
                          return wp.element.createElement('span', { 'class': 'dashicons dashicons-edit edit-item', onClick: open });
                        }
                      }),
                      wp.element.createElement('img', { src: source.url,
                        className: 'nab-ad-img',
                        alt: __('Ad-Image'),
                        height: '100px',
                        width: '100px',
                        onClick: function onClick() {
                          _this2.setState({ currentSelected: index });
                        }
                      }),
                      wp.element.createElement(
                        Tooltip,
                        { text: __('Remove Image') },
                        wp.element.createElement(IconButton, {
                          className: 'nab-ad-item-remove',
                          icon: 'no',
                          onClick: function onClick() {
                            _this2.setState({ currentSelected: 0 });
                            var removed = [].concat(_toConsumableArray(imgSources));
                            removed.splice(index, 1);

                            setAttributes({
                              imgSources: removed
                            });
                          }
                        })
                      )
                    );
                  }),
                  wp.element.createElement(
                    'div',
                    { className: 'nab-advertisement-add-item' },
                    wp.element.createElement(MediaUpload, {
                      allowedTypes: ['image'],
                      value: null,
                      multiple: true,
                      onSelect: function onSelect(items) {
                        return setAttributes({
                          imgSources: [].concat(_toConsumableArray(imgSources), _toConsumableArray(items.map(function (item) {
                            return __WEBPACK_IMPORTED_MODULE_0_lodash_pick___default()(item, 'url', 'id');
                          })))
                        });
                      },
                      render: function render(_ref3) {
                        var open = _ref3.open;
                        return wp.element.createElement(IconButton, {
                          label: __('Add media'),
                          icon: 'plus',
                          onClick: open
                        });
                      }
                    })
                  )
                )
              )
            )
          )
        );
      }
    }]);

    return NabAdvertisement;
  }(Component);

  var allAttr = {
    imgSources: {
      type: 'array',
      default: []
    },
    imgWidth: {
      type: 'number'
    },
    imgHeight: {
      type: 'number'
    },
    linkTarget: {
      type: 'boolean',
      default: true
    },
    scheduleAd: {
      type: 'boolean',
      default: false
    },
    startDate: {
      type: 'string'
    },
    endDate: {
      type: 'string'
    },
    showCal: {
      type: 'boolean',
      default: false
    },
    addAlign: {
      type: 'string',
      default: 'center'
    }
  };

  registerBlockType('nab/advertisement', {
    title: __('Advertisement'),
    icon: { src: adBlockIcon },
    category: 'nabshow',
    keywords: [__('ad'), __('advertisement')],
    attributes: allAttr,
    edit: NabAdvertisement,
    save: function save() {
      return null;
    }
  });
})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);

/***/ }),
/* 113 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_lodash_times__ = __webpack_require__(15);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_lodash_times___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_lodash_times__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_lodash_map__ = __webpack_require__(114);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_lodash_map___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1_lodash_map__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_memize__ = __webpack_require__(16);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_memize___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_2_memize__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3_classnames__ = __webpack_require__(29);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3_classnames___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_3_classnames__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__icons__ = __webpack_require__(165);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__inspector__ = __webpack_require__(166);







(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
    var __ = wpI18n.__;
    var registerBlockType = wpBlocks.registerBlockType;
    var Fragment = wpElement.Fragment;
    var InnerBlocks = wpEditor.InnerBlocks;
    var Placeholder = wpComponents.Placeholder,
        ButtonGroup = wpComponents.ButtonGroup,
        Tooltip = wpComponents.Tooltip,
        Button = wpComponents.Button;


    var customBlockIcon = wp.element.createElement(
        'svg',
        { width: '150px', height: '150px', viewBox: '0 0 150 150', 'enable-background': 'new 0 0 150 150' },
        wp.element.createElement(
            'g',
            null,
            wp.element.createElement(
                'g',
                null,
                wp.element.createElement('path', { fill: '#146DB6', d: 'M144.596,3H5.169C3.842,3,2.766,4.077,2.766,5.404V144.83c0,1.329,1.076,2.405,2.404,2.405h139.426\r c1.328,0,2.404-1.076,2.404-2.404V5.404C147,4.077,145.924,3,144.596,3z M142.192,142.427H7.573V7.808h134.619V142.427\r L142.192,142.427z' })
            )
        ),
        wp.element.createElement(
            'g',
            null,
            wp.element.createElement(
                'g',
                null,
                wp.element.createElement('path', { fill: '#146DB6', d: 'M132.577,15.02H17.189c-1.328,0-2.404,1.077-2.404,2.404v43.27c0,1.328,1.077,2.404,2.404,2.404h115.388\r c1.327,0,2.403-1.076,2.403-2.404v-43.27C134.98,16.096,133.904,15.02,132.577,15.02z M130.173,58.29H19.593V19.828h110.58V58.29\r L130.173,58.29z' })
            )
        ),
        wp.element.createElement(
            'g',
            null,
            wp.element.createElement(
                'g',
                null,
                wp.element.createElement('path', { fill: '#146DB6', d: 'M60.459,82.329h-43.27c-1.328,0-2.404,1.076-2.404,2.404v45.674c0,1.327,1.077,2.404,2.404,2.404h43.27\r c1.328,0,2.404-1.077,2.404-2.404V84.733C62.863,83.405,61.788,82.329,60.459,82.329z M58.056,128.004H19.593V87.138h38.462\r L58.056,128.004L58.056,128.004z' })
            )
        ),
        wp.element.createElement(
            'g',
            null,
            wp.element.createElement(
                'g',
                null,
                wp.element.createElement('rect', { x: '82.094', y: '89.541', fill: '#146DB6', width: '52.887', height: '4.808' })
            )
        ),
        wp.element.createElement(
            'g',
            null,
            wp.element.createElement(
                'g',
                null,
                wp.element.createElement('rect', { x: '82.094', y: '118.388', fill: '#146DB6', width: '52.887', height: '4.808' })
            )
        )
    );

    var allAttributes = {
        columns: {
            type: 'number'
        },
        colLayout: {
            type: 'string'
        },
        someValue: {
            type: 'string'
        },
        backgroundImage: {
            type: 'string',
            default: ''
        },
        backgroundColor: {
            type: 'string',
            default: ''
        },
        backgroundSize: {
            type: 'boolean',
            default: false
        },
        backgroundPosition: {
            type: 'string',
            default: ''
        },
        backgroundAttachment: {
            type: 'boolean',
            default: false
        },
        borderStyle: {
            type: 'string',
            default: ''
        },
        borderWidth: {
            type: 'number'
        },
        borderColor: {
            type: 'string'
        },
        borderRadius: {
            type: 'number'
        },
        topBorderStyle: {
            type: 'string',
            default: ''
        },
        topBorderWidth: {
            type: 'number'
        },
        topBorderColor: {
            type: 'string'
        },
        topBorderRadius: {
            type: 'number'
        },
        bottomBorderStyle: {
            type: 'string',
            default: ''
        },
        bottomBorderWidth: {
            type: 'number'
        },
        bottomBorderColor: {
            type: 'string'
        },
        bottomBorderRadius: {
            type: 'number'
        },
        rightBorderStyle: {
            type: 'string',
            default: ''
        },
        rightBorderWidth: {
            type: 'number'
        },
        rightBorderColor: {
            type: 'string'
        },
        rightBorderRadius: {
            type: 'number'
        },
        leftBorderStyle: {
            type: 'string',
            default: ''
        },
        leftBorderWidth: {
            type: 'number'
        },
        leftBorderColor: {
            type: 'string'
        },
        leftBorderRadius: {
            type: 'number'
        },
        textAlign: {
            type: 'string',
            default: ''
        },
        width: {
            type: 'string',
            default: ''
        },
        height: {
            type: 'string',
            default: ''
        },
        opacity: {
            type: 'number',
            default: 0
        },
        overlayColor: {
            type: 'string'
        },
        paddingTop: {
            type: 'string',
            default: ''
        },
        paddingRight: {
            type: 'string',
            default: ''
        },
        paddingBottom: {
            type: 'string',
            default: ''
        },
        paddingLeft: {
            type: 'string',
            default: ''
        },
        marginTop: {
            type: 'string',
            default: ''
        },
        marginRight: {
            type: 'string',
            default: ''
        },
        marginBottom: {
            type: 'string',
            default: ''
        },
        marginLeft: {
            type: 'string',
            default: ''
        },
        gradientRange1: {
            type: 'number',
            default: 0
        },
        gradientRange2: {
            type: 'number',
            default: 0
        },
        gradientRange3: {
            type: 'number',
            default: 0
        },
        color1: {
            type: 'string',
            default: '#fff'
        },
        color2: {
            type: 'string',
            default: '#fff'
        },
        color3: {
            type: 'string',
            default: '#fff'
        },
        gradientType: {
            type: 'string',
            default: ''
        },
        ToggleInserter: {
            type: 'boolean',
            default: false
        },
        vAlign: {
            type: 'string',
            default: 'center'
        },
        hAlign: {
            type: 'string',
            default: 'center'
        },
        layout: {
            type: 'string',
            default: ''
        },
        showTitle: {
            type: 'boolean',
            default: true
        },
        clientID: {
            type: 'string'
        }
    };

    /* Set allowed blocks and media. */
    var ALLOWED_BLOCKS = ['nab/nab-column'];

    /* Get the column template. */
    var getLayoutTemplate = __WEBPACK_IMPORTED_MODULE_2_memize___default()(function (columns) {
        var colCounts = __WEBPACK_IMPORTED_MODULE_0_lodash_times___default()(columns, function () {
            return ['nab/nab-column'];
        });
        var headBlock = [['nab/nab-heading']];
        var combine = headBlock.concat(colCounts);
        return combine;
    });

    /**
     * Register advanced columns block InnerBlocks.
     */
    registerBlockType('nab/nab-custom', {
        title: __('NABShow - Custom Block'),
        description: __('Add a pre-defined custom layout.'),
        icon: { src: customBlockIcon },
        category: 'nabshow',
        keywords: [__('custom'), __('gutenberg'), __('nab')],
        attributes: allAttributes,
        edit: function edit(props) {
            var attributes = props.attributes,
                setAttributes = props.setAttributes,
                className = props.className,
                clientId = props.clientId;
            var columns = attributes.columns,
                colLayout = attributes.colLayout,
                backgroundImage = attributes.backgroundImage,
                backgroundColor = attributes.backgroundColor,
                backgroundSize = attributes.backgroundSize,
                backgroundPosition = attributes.backgroundPosition,
                backgroundAttachment = attributes.backgroundAttachment,
                borderStyle = attributes.borderStyle,
                borderWidth = attributes.borderWidth,
                borderColor = attributes.borderColor,
                borderRadius = attributes.borderRadius,
                textAlign = attributes.textAlign,
                width = attributes.width,
                height = attributes.height,
                opacity = attributes.opacity,
                overlayColor = attributes.overlayColor,
                paddingTop = attributes.paddingTop,
                paddingRight = attributes.paddingRight,
                paddingBottom = attributes.paddingBottom,
                paddingLeft = attributes.paddingLeft,
                marginTop = attributes.marginTop,
                marginRight = attributes.marginRight,
                marginBottom = attributes.marginBottom,
                marginLeft = attributes.marginLeft,
                gradientRange1 = attributes.gradientRange1,
                gradientRange2 = attributes.gradientRange2,
                gradientRange3 = attributes.gradientRange3,
                color1 = attributes.color1,
                color2 = attributes.color2,
                color3 = attributes.color3,
                gradientType = attributes.gradientType,
                topBorderStyle = attributes.topBorderStyle,
                topBorderWidth = attributes.topBorderWidth,
                topBorderColor = attributes.topBorderColor,
                topBorderRadius = attributes.topBorderRadius,
                bottomBorderStyle = attributes.bottomBorderStyle,
                bottomBorderWidth = attributes.bottomBorderWidth,
                bottomBorderColor = attributes.bottomBorderColor,
                bottomBorderRadius = attributes.bottomBorderRadius,
                rightBorderStyle = attributes.rightBorderStyle,
                rightBorderWidth = attributes.rightBorderWidth,
                rightBorderColor = attributes.rightBorderColor,
                rightBorderRadius = attributes.rightBorderRadius,
                leftBorderStyle = attributes.leftBorderStyle,
                leftBorderWidth = attributes.leftBorderWidth,
                leftBorderColor = attributes.leftBorderColor,
                leftBorderRadius = attributes.leftBorderRadius,
                elementID = attributes.elementID,
                hAlign = attributes.hAlign,
                vAlign = attributes.vAlign,
                layout = attributes.layout,
                ToggleInserter = attributes.ToggleInserter,
                showTitle = attributes.showTitle;

            var columnOptions = [{
                name: __('1 Column'),
                key: 'one-column',
                columns: 1,
                icon: __WEBPACK_IMPORTED_MODULE_4__icons__["a" /* default */].oneEqual
            }, {
                name: __('2 Columns'),
                key: 'two-column',
                columns: 2,
                icon: __WEBPACK_IMPORTED_MODULE_4__icons__["a" /* default */].twoEqual
            }, {
                name: __('2 Columns - 75/25'),
                key: 'nab-2-col-wideleft',
                columns: 2,
                icon: __WEBPACK_IMPORTED_MODULE_4__icons__["a" /* default */].twoLeftWide
            }, {
                name: __('2 Columns - 25/75'),
                key: 'nab-2-col-wideright',
                columns: 2,
                icon: __WEBPACK_IMPORTED_MODULE_4__icons__["a" /* default */].twoRightWide
            }, {
                name: __('3 Columns'),
                key: 'three-column',
                columns: 3,
                icon: __WEBPACK_IMPORTED_MODULE_4__icons__["a" /* default */].threeEqual
            }];

            setAttributes({ clientID: clientId });

            var classes = __WEBPACK_IMPORTED_MODULE_3_classnames___default()(className, layout && 'has-' + layout, colLayout && 'block-' + colLayout, vAlign && 'vblock-' + vAlign, hAlign && 'hblock-' + hAlign, showTitle && 'has-block-title', width && 'has-custom-width', {
                'has-background-size': backgroundSize,
                'has-background-attachment': backgroundAttachment,
                'has-background-opacity': 0 !== opacity

            }, opacityRatioToClass(opacity));
            var style = {};
            backgroundImage && (style.backgroundImage = 'url(' + backgroundImage + ')');
            backgroundColor && (style.backgroundColor = backgroundColor);
            backgroundPosition && (style.backgroundPosition = backgroundPosition);
            textAlign && (style.textAlign = textAlign);
            width && (style.width = width + '%');
            height && (style.height = height + 'px');
            overlayColor && (style.backgroundColor = overlayColor);
            paddingTop && (style.paddingTop = paddingTop + 'px');
            paddingRight && (style.paddingRight = paddingRight + 'px');
            paddingBottom && (style.paddingBottom = paddingBottom + 'px');
            paddingLeft && (style.paddingLeft = paddingLeft + 'px');
            marginTop && (style.marginTop = marginTop + 'px');
            marginRight && (style.marginRight = marginRight + 'px');
            marginBottom && (style.marginBottom = marginBottom + 'px');
            marginLeft && (style.marginLeft = marginLeft + 'px');
            gradientType && ('#fff' !== color1 || '#fff' !== color2 || '#fff' !== color3) && (style.background = 'linear-gradient(' + gradientType + ', ' + color1 + ' ' + gradientRange1 + '%, ' + color2 + ' ' + gradientRange2 + '%, ' + color3 + ' ' + gradientRange3 + '%)');
            marginTop && (style.marginTop = marginTop + 'px');

            if (borderStyle) {
                style.borderStyle = borderStyle;
                if (borderWidth) {
                    style.borderWidth = borderWidth + 'px';
                }
                if (borderColor) {
                    style.borderColor = borderColor;
                }
                if (borderRadius) {
                    style.borderRadius = borderRadius;
                }
            } else {
                if (topBorderStyle) {
                    style.borderTopStyle = topBorderStyle;
                    if (topBorderWidth) {
                        style.borderTopWidth = topBorderWidth + 'px';
                    }
                    if (topBorderColor) {
                        style.borderTopColor = topBorderColor;
                    }
                    if (topBorderRadius) {
                        style.borderTopLeftRadius = topBorderRadius;
                    }
                }
                if (bottomBorderStyle) {
                    style.borderBottomStyle = bottomBorderStyle;
                    if (bottomBorderWidth) {
                        style.borderBottomWidth = bottomBorderWidth + 'px';
                    }
                    if (bottomBorderColor) {
                        style.borderBottomColor = bottomBorderColor;
                    }
                    if (bottomBorderRadius) {
                        style.borderBottomRightRadius = bottomBorderRadius;
                    }
                }
                if (rightBorderStyle) {
                    style.borderRightStyle = rightBorderStyle;
                    if (rightBorderWidth) {
                        style.borderRightWidth = rightBorderWidth + 'px';
                    }
                    if (rightBorderColor) {
                        style.borderRightColor = rightBorderColor;
                    }
                    if (rightBorderRadius) {
                        style.borderTopRightRadius = rightBorderRadius;
                    }
                }
                if (leftBorderStyle) {
                    style.borderLeftStyle = leftBorderStyle;
                    if (leftBorderWidth) {
                        style.borderLeftWidth = leftBorderWidth + 'px';
                    }
                    if (leftBorderColor) {
                        style.borderLeftColor = leftBorderColor;
                    }
                    if (leftBorderRadius) {
                        style.borderBottomLeftRadius = leftBorderRadius;
                    }
                }
            }

            /* Show the layout placeholder. */
            if (!colLayout) {
                return [wp.element.createElement(
                    Placeholder,
                    {
                        key: 'placeholder',
                        icon: 'editor-table',
                        label: columns ? __('Column Layout', 'atomic-blocks') : __('Column Number', 'atomic-blocks'),
                        instructions: columns ? __('Select a layout for this column.', 'atomic-blocks') : __('Select the number of columns for this layout.', 'atomic-blocks'),
                        className: 'nab-column-selector-placeholder'
                    },
                    !columns && wp.element.createElement(
                        ButtonGroup,
                        {
                            'aria-label': __('Select Row Columns', 'atomic-blocks'),
                            className: 'nab-column-selector-group'
                        },
                        __WEBPACK_IMPORTED_MODULE_1_lodash_map___default()(columnOptions, function (_ref) {
                            var name = _ref.name,
                                key = _ref.key,
                                icon = _ref.icon,
                                columns = _ref.columns;
                            return wp.element.createElement(
                                Tooltip,
                                { text: name, key: key },
                                wp.element.createElement(
                                    'div',
                                    { className: 'nab-column-selector' },
                                    wp.element.createElement(
                                        Button,
                                        {
                                            className: 'nab-column-selector-button',
                                            isSmall: true,
                                            onClick: function onClick() {
                                                setAttributes({ columns: columns, colLayout: key });
                                            }
                                        },
                                        icon
                                    )
                                )
                            );
                        })
                    )
                )];
            }

            return [wp.element.createElement(
                Fragment,
                null,
                wp.element.createElement(__WEBPACK_IMPORTED_MODULE_5__inspector__["a" /* default */], { attributes: attributes, setAttributes: setAttributes, getLayoutTemplate: getLayoutTemplate }),
                wp.element.createElement(
                    'div',
                    { id: elementID, className: 'custom-box ' + classes + ' ' + (ToggleInserter ? 'nab-inserter-on' : 'nab-inserter-off'), style: style },
                    wp.element.createElement(
                        'div',
                        { className: 'custom-box-container' },
                        wp.element.createElement(
                            'div',
                            { className: 'row custom-box-row' },
                            wp.element.createElement(InnerBlocks, {
                                template: getLayoutTemplate(columns),
                                templateLock: 'all',
                                allowedBlocks: ALLOWED_BLOCKS
                            })
                        )
                    )
                )
            )];
        },
        save: function save(props) {
            var attributes = props.attributes,
                className = props.className;
            var colLayout = attributes.colLayout,
                backgroundImage = attributes.backgroundImage,
                backgroundColor = attributes.backgroundColor,
                backgroundSize = attributes.backgroundSize,
                backgroundPosition = attributes.backgroundPosition,
                backgroundAttachment = attributes.backgroundAttachment,
                borderStyle = attributes.borderStyle,
                borderWidth = attributes.borderWidth,
                borderColor = attributes.borderColor,
                borderRadius = attributes.borderRadius,
                textAlign = attributes.textAlign,
                width = attributes.width,
                height = attributes.height,
                opacity = attributes.opacity,
                overlayColor = attributes.overlayColor,
                paddingTop = attributes.paddingTop,
                paddingRight = attributes.paddingRight,
                paddingBottom = attributes.paddingBottom,
                paddingLeft = attributes.paddingLeft,
                marginTop = attributes.marginTop,
                marginRight = attributes.marginRight,
                marginBottom = attributes.marginBottom,
                marginLeft = attributes.marginLeft,
                gradientRange1 = attributes.gradientRange1,
                gradientRange2 = attributes.gradientRange2,
                gradientRange3 = attributes.gradientRange3,
                color1 = attributes.color1,
                color2 = attributes.color2,
                color3 = attributes.color3,
                gradientType = attributes.gradientType,
                topBorderStyle = attributes.topBorderStyle,
                topBorderWidth = attributes.topBorderWidth,
                topBorderColor = attributes.topBorderColor,
                topBorderRadius = attributes.topBorderRadius,
                bottomBorderStyle = attributes.bottomBorderStyle,
                bottomBorderWidth = attributes.bottomBorderWidth,
                bottomBorderColor = attributes.bottomBorderColor,
                bottomBorderRadius = attributes.bottomBorderRadius,
                rightBorderStyle = attributes.rightBorderStyle,
                rightBorderWidth = attributes.rightBorderWidth,
                rightBorderColor = attributes.rightBorderColor,
                rightBorderRadius = attributes.rightBorderRadius,
                leftBorderStyle = attributes.leftBorderStyle,
                leftBorderWidth = attributes.leftBorderWidth,
                leftBorderColor = attributes.leftBorderColor,
                leftBorderRadius = attributes.leftBorderRadius,
                elementID = attributes.elementID,
                hAlign = attributes.hAlign,
                vAlign = attributes.vAlign,
                layout = attributes.layout,
                showTitle = attributes.showTitle;

            var classes = __WEBPACK_IMPORTED_MODULE_3_classnames___default()(className, layout && 'has-' + layout, colLayout && 'block-' + colLayout, vAlign && 'vblock-' + vAlign, hAlign && 'hblock-' + hAlign, showTitle && 'has-block-title', width && 'has-custom-width', {
                'has-background-size': backgroundSize,
                'has-background-attachment': backgroundAttachment,
                'has-background-opacity': 0 !== opacity

            }, opacityRatioToClass(opacity));

            var style = {};
            backgroundImage && (style.backgroundImage = 'url(' + backgroundImage + ')');
            backgroundColor && (style.backgroundColor = backgroundColor);
            backgroundPosition && (style.backgroundPosition = backgroundPosition);
            textAlign && (style.textAlign = textAlign);
            width && (style.width = width + '%');
            height && (style.height = height + 'px');
            overlayColor && (style.backgroundColor = overlayColor);
            paddingTop && (style.paddingTop = paddingTop + 'px');
            paddingRight && (style.paddingRight = paddingRight + 'px');
            paddingBottom && (style.paddingBottom = paddingBottom + 'px');
            paddingLeft && (style.paddingLeft = paddingLeft + 'px');
            marginTop && (style.marginTop = marginTop + 'px');
            marginRight && (style.marginRight = marginRight + 'px');
            marginBottom && (style.marginBottom = marginBottom + 'px');
            marginLeft && (style.marginLeft = marginLeft + 'px');
            gradientType && ('#fff' !== color1 || '#fff' !== color2 || '#fff' !== color3) && (style.background = 'linear-gradient(' + gradientType + ', ' + color1 + ' ' + gradientRange1 + '%, ' + color2 + ' ' + gradientRange2 + '%, ' + color3 + ' ' + gradientRange3 + '%)');
            marginTop && (style.marginTop = marginTop + 'px');

            if (borderStyle) {
                style.borderStyle = borderStyle;
                if (borderWidth) {
                    style.borderWidth = borderWidth + 'px';
                }
                if (borderColor) {
                    style.borderColor = borderColor;
                }
                if (borderRadius) {
                    style.borderRadius = borderRadius;
                }
            } else {
                if (topBorderStyle) {
                    style.borderTopStyle = topBorderStyle;
                    if (topBorderWidth) {
                        style.borderTopWidth = topBorderWidth + 'px';
                    }
                    if (topBorderColor) {
                        style.borderTopColor = topBorderColor;
                    }
                    if (topBorderRadius) {
                        style.borderTopLeftRadius = topBorderRadius;
                    }
                }
                if (bottomBorderStyle) {
                    style.borderBottomStyle = bottomBorderStyle;
                    if (bottomBorderWidth) {
                        style.borderBottomWidth = bottomBorderWidth + 'px';
                    }
                    if (bottomBorderColor) {
                        style.borderBottomColor = bottomBorderColor;
                    }
                    if (bottomBorderRadius) {
                        style.borderBottomRightRadius = bottomBorderRadius;
                    }
                }
                if (rightBorderStyle) {
                    style.borderRightStyle = rightBorderStyle;
                    if (rightBorderWidth) {
                        style.borderRightWidth = rightBorderWidth + 'px';
                    }
                    if (rightBorderColor) {
                        style.borderRightColor = rightBorderColor;
                    }
                    if (rightBorderRadius) {
                        style.borderTopRightRadius = rightBorderRadius;
                    }
                }
                if (leftBorderStyle) {
                    style.borderLeftStyle = leftBorderStyle;
                    if (leftBorderWidth) {
                        style.borderLeftWidth = leftBorderWidth + 'px';
                    }
                    if (leftBorderColor) {
                        style.borderLeftColor = leftBorderColor;
                    }
                    if (leftBorderRadius) {
                        style.borderBottomLeftRadius = leftBorderRadius;
                    }
                }
            }

            return wp.element.createElement(
                'div',
                { id: elementID, className: 'custom-box ' + classes, style: style },
                wp.element.createElement(
                    'div',
                    { className: 'custom-box-container' },
                    wp.element.createElement(
                        'div',
                        { className: 'row custom-box-row' },
                        wp.element.createElement(InnerBlocks.Content, null)
                    )
                )
            );
        }
    });

    registerBlockType('nab/nab-column', {
        title: __('Nab Column'),
        description: __('Nab Column creates column wise layout'),
        icon: { src: customBlockIcon },
        category: 'nabshow',
        parent: ['nab/custom'],
        attributes: allAttributes,
        edit: function edit(props) {
            return wp.element.createElement(
                Fragment,
                null,
                wp.element.createElement(
                    'div',
                    { className: 'custom-content-box ' },
                    wp.element.createElement(
                        'div',
                        { className: 'content-inner' },
                        wp.element.createElement(InnerBlocks, {
                            templateLock: false
                        })
                    )
                )
            );
        },
        save: function save(props) {
            return wp.element.createElement(
                Fragment,
                null,
                wp.element.createElement(
                    'div',
                    { className: 'custom-content-box ' },
                    wp.element.createElement(
                        'div',
                        { className: 'content-inner' },
                        wp.element.createElement(InnerBlocks.Content, null)
                    )
                )
            );
        }
    });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);

function opacityRatioToClass(ratio) {
    return 0 === ratio ? null : 'has-background-opacity-' + 10 * Math.round(ratio / 10);
}

/***/ }),
/* 114 */
/***/ (function(module, exports, __webpack_require__) {

var arrayMap = __webpack_require__(33),
    baseIteratee = __webpack_require__(115),
    baseMap = __webpack_require__(159),
    isArray = __webpack_require__(0);

/**
 * Creates an array of values by running each element in `collection` thru
 * `iteratee`. The iteratee is invoked with three arguments:
 * (value, index|key, collection).
 *
 * Many lodash methods are guarded to work as iteratees for methods like
 * `_.every`, `_.filter`, `_.map`, `_.mapValues`, `_.reject`, and `_.some`.
 *
 * The guarded methods are:
 * `ary`, `chunk`, `curry`, `curryRight`, `drop`, `dropRight`, `every`,
 * `fill`, `invert`, `parseInt`, `random`, `range`, `rangeRight`, `repeat`,
 * `sampleSize`, `slice`, `some`, `sortBy`, `split`, `take`, `takeRight`,
 * `template`, `trim`, `trimEnd`, `trimStart`, and `words`
 *
 * @static
 * @memberOf _
 * @since 0.1.0
 * @category Collection
 * @param {Array|Object} collection The collection to iterate over.
 * @param {Function} [iteratee=_.identity] The function invoked per iteration.
 * @returns {Array} Returns the new mapped array.
 * @example
 *
 * function square(n) {
 *   return n * n;
 * }
 *
 * _.map([4, 8], square);
 * // => [16, 64]
 *
 * _.map({ 'a': 4, 'b': 8 }, square);
 * // => [16, 64] (iteration order is not guaranteed)
 *
 * var users = [
 *   { 'user': 'barney' },
 *   { 'user': 'fred' }
 * ];
 *
 * // The `_.property` iteratee shorthand.
 * _.map(users, 'user');
 * // => ['barney', 'fred']
 */
function map(collection, iteratee) {
  var func = isArray(collection) ? arrayMap : baseMap;
  return func(collection, baseIteratee(iteratee, 3));
}

module.exports = map;


/***/ }),
/* 115 */
/***/ (function(module, exports, __webpack_require__) {

var baseMatches = __webpack_require__(116),
    baseMatchesProperty = __webpack_require__(154),
    identity = __webpack_require__(26),
    isArray = __webpack_require__(0),
    property = __webpack_require__(156);

/**
 * The base implementation of `_.iteratee`.
 *
 * @private
 * @param {*} [value=_.identity] The value to convert to an iteratee.
 * @returns {Function} Returns the iteratee.
 */
function baseIteratee(value) {
  // Don't store the `typeof` result in a variable to avoid a JIT bug in Safari 9.
  // See https://bugs.webkit.org/show_bug.cgi?id=156034 for more details.
  if (typeof value == 'function') {
    return value;
  }
  if (value == null) {
    return identity;
  }
  if (typeof value == 'object') {
    return isArray(value)
      ? baseMatchesProperty(value[0], value[1])
      : baseMatches(value);
  }
  return property(value);
}

module.exports = baseIteratee;


/***/ }),
/* 116 */
/***/ (function(module, exports, __webpack_require__) {

var baseIsMatch = __webpack_require__(117),
    getMatchData = __webpack_require__(153),
    matchesStrictComparable = __webpack_require__(45);

/**
 * The base implementation of `_.matches` which doesn't clone `source`.
 *
 * @private
 * @param {Object} source The object of property values to match.
 * @returns {Function} Returns the new spec function.
 */
function baseMatches(source) {
  var matchData = getMatchData(source);
  if (matchData.length == 1 && matchData[0][2]) {
    return matchesStrictComparable(matchData[0][0], matchData[0][1]);
  }
  return function(object) {
    return object === source || baseIsMatch(object, source, matchData);
  };
}

module.exports = baseMatches;


/***/ }),
/* 117 */
/***/ (function(module, exports, __webpack_require__) {

var Stack = __webpack_require__(38),
    baseIsEqual = __webpack_require__(39);

/** Used to compose bitmasks for value comparisons. */
var COMPARE_PARTIAL_FLAG = 1,
    COMPARE_UNORDERED_FLAG = 2;

/**
 * The base implementation of `_.isMatch` without support for iteratee shorthands.
 *
 * @private
 * @param {Object} object The object to inspect.
 * @param {Object} source The object of property values to match.
 * @param {Array} matchData The property names, values, and compare flags to match.
 * @param {Function} [customizer] The function to customize comparisons.
 * @returns {boolean} Returns `true` if `object` is a match, else `false`.
 */
function baseIsMatch(object, source, matchData, customizer) {
  var index = matchData.length,
      length = index,
      noCustomizer = !customizer;

  if (object == null) {
    return !length;
  }
  object = Object(object);
  while (index--) {
    var data = matchData[index];
    if ((noCustomizer && data[2])
          ? data[1] !== object[data[0]]
          : !(data[0] in object)
        ) {
      return false;
    }
  }
  while (++index < length) {
    data = matchData[index];
    var key = data[0],
        objValue = object[key],
        srcValue = data[1];

    if (noCustomizer && data[2]) {
      if (objValue === undefined && !(key in object)) {
        return false;
      }
    } else {
      var stack = new Stack;
      if (customizer) {
        var result = customizer(objValue, srcValue, key, object, source, stack);
      }
      if (!(result === undefined
            ? baseIsEqual(srcValue, objValue, COMPARE_PARTIAL_FLAG | COMPARE_UNORDERED_FLAG, customizer, stack)
            : result
          )) {
        return false;
      }
    }
  }
  return true;
}

module.exports = baseIsMatch;


/***/ }),
/* 118 */
/***/ (function(module, exports, __webpack_require__) {

var ListCache = __webpack_require__(12);

/**
 * Removes all key-value entries from the stack.
 *
 * @private
 * @name clear
 * @memberOf Stack
 */
function stackClear() {
  this.__data__ = new ListCache;
  this.size = 0;
}

module.exports = stackClear;


/***/ }),
/* 119 */
/***/ (function(module, exports) {

/**
 * Removes `key` and its value from the stack.
 *
 * @private
 * @name delete
 * @memberOf Stack
 * @param {string} key The key of the value to remove.
 * @returns {boolean} Returns `true` if the entry was removed, else `false`.
 */
function stackDelete(key) {
  var data = this.__data__,
      result = data['delete'](key);

  this.size = data.size;
  return result;
}

module.exports = stackDelete;


/***/ }),
/* 120 */
/***/ (function(module, exports) {

/**
 * Gets the stack value for `key`.
 *
 * @private
 * @name get
 * @memberOf Stack
 * @param {string} key The key of the value to get.
 * @returns {*} Returns the entry value.
 */
function stackGet(key) {
  return this.__data__.get(key);
}

module.exports = stackGet;


/***/ }),
/* 121 */
/***/ (function(module, exports) {

/**
 * Checks if a stack value for `key` exists.
 *
 * @private
 * @name has
 * @memberOf Stack
 * @param {string} key The key of the entry to check.
 * @returns {boolean} Returns `true` if an entry for `key` exists, else `false`.
 */
function stackHas(key) {
  return this.__data__.has(key);
}

module.exports = stackHas;


/***/ }),
/* 122 */
/***/ (function(module, exports, __webpack_require__) {

var ListCache = __webpack_require__(12),
    Map = __webpack_require__(22),
    MapCache = __webpack_require__(20);

/** Used as the size to enable large array optimizations. */
var LARGE_ARRAY_SIZE = 200;

/**
 * Sets the stack `key` to `value`.
 *
 * @private
 * @name set
 * @memberOf Stack
 * @param {string} key The key of the value to set.
 * @param {*} value The value to set.
 * @returns {Object} Returns the stack cache instance.
 */
function stackSet(key, value) {
  var data = this.__data__;
  if (data instanceof ListCache) {
    var pairs = data.__data__;
    if (!Map || (pairs.length < LARGE_ARRAY_SIZE - 1)) {
      pairs.push([key, value]);
      this.size = ++data.size;
      return this;
    }
    data = this.__data__ = new MapCache(pairs);
  }
  data.set(key, value);
  this.size = data.size;
  return this;
}

module.exports = stackSet;


/***/ }),
/* 123 */
/***/ (function(module, exports, __webpack_require__) {

var Stack = __webpack_require__(38),
    equalArrays = __webpack_require__(40),
    equalByTag = __webpack_require__(129),
    equalObjects = __webpack_require__(133),
    getTag = __webpack_require__(148),
    isArray = __webpack_require__(0),
    isBuffer = __webpack_require__(41),
    isTypedArray = __webpack_require__(43);

/** Used to compose bitmasks for value comparisons. */
var COMPARE_PARTIAL_FLAG = 1;

/** `Object#toString` result references. */
var argsTag = '[object Arguments]',
    arrayTag = '[object Array]',
    objectTag = '[object Object]';

/** Used for built-in method references. */
var objectProto = Object.prototype;

/** Used to check objects for own properties. */
var hasOwnProperty = objectProto.hasOwnProperty;

/**
 * A specialized version of `baseIsEqual` for arrays and objects which performs
 * deep comparisons and tracks traversed objects enabling objects with circular
 * references to be compared.
 *
 * @private
 * @param {Object} object The object to compare.
 * @param {Object} other The other object to compare.
 * @param {number} bitmask The bitmask flags. See `baseIsEqual` for more details.
 * @param {Function} customizer The function to customize comparisons.
 * @param {Function} equalFunc The function to determine equivalents of values.
 * @param {Object} [stack] Tracks traversed `object` and `other` objects.
 * @returns {boolean} Returns `true` if the objects are equivalent, else `false`.
 */
function baseIsEqualDeep(object, other, bitmask, customizer, equalFunc, stack) {
  var objIsArr = isArray(object),
      othIsArr = isArray(other),
      objTag = objIsArr ? arrayTag : getTag(object),
      othTag = othIsArr ? arrayTag : getTag(other);

  objTag = objTag == argsTag ? objectTag : objTag;
  othTag = othTag == argsTag ? objectTag : othTag;

  var objIsObj = objTag == objectTag,
      othIsObj = othTag == objectTag,
      isSameTag = objTag == othTag;

  if (isSameTag && isBuffer(object)) {
    if (!isBuffer(other)) {
      return false;
    }
    objIsArr = true;
    objIsObj = false;
  }
  if (isSameTag && !objIsObj) {
    stack || (stack = new Stack);
    return (objIsArr || isTypedArray(object))
      ? equalArrays(object, other, bitmask, customizer, equalFunc, stack)
      : equalByTag(object, other, objTag, bitmask, customizer, equalFunc, stack);
  }
  if (!(bitmask & COMPARE_PARTIAL_FLAG)) {
    var objIsWrapped = objIsObj && hasOwnProperty.call(object, '__wrapped__'),
        othIsWrapped = othIsObj && hasOwnProperty.call(other, '__wrapped__');

    if (objIsWrapped || othIsWrapped) {
      var objUnwrapped = objIsWrapped ? object.value() : object,
          othUnwrapped = othIsWrapped ? other.value() : other;

      stack || (stack = new Stack);
      return equalFunc(objUnwrapped, othUnwrapped, bitmask, customizer, stack);
    }
  }
  if (!isSameTag) {
    return false;
  }
  stack || (stack = new Stack);
  return equalObjects(object, other, bitmask, customizer, equalFunc, stack);
}

module.exports = baseIsEqualDeep;


/***/ }),
/* 124 */
/***/ (function(module, exports, __webpack_require__) {

var MapCache = __webpack_require__(20),
    setCacheAdd = __webpack_require__(125),
    setCacheHas = __webpack_require__(126);

/**
 *
 * Creates an array cache object to store unique values.
 *
 * @private
 * @constructor
 * @param {Array} [values] The values to cache.
 */
function SetCache(values) {
  var index = -1,
      length = values == null ? 0 : values.length;

  this.__data__ = new MapCache;
  while (++index < length) {
    this.add(values[index]);
  }
}

// Add methods to `SetCache`.
SetCache.prototype.add = SetCache.prototype.push = setCacheAdd;
SetCache.prototype.has = setCacheHas;

module.exports = SetCache;


/***/ }),
/* 125 */
/***/ (function(module, exports) {

/** Used to stand-in for `undefined` hash values. */
var HASH_UNDEFINED = '__lodash_hash_undefined__';

/**
 * Adds `value` to the array cache.
 *
 * @private
 * @name add
 * @memberOf SetCache
 * @alias push
 * @param {*} value The value to cache.
 * @returns {Object} Returns the cache instance.
 */
function setCacheAdd(value) {
  this.__data__.set(value, HASH_UNDEFINED);
  return this;
}

module.exports = setCacheAdd;


/***/ }),
/* 126 */
/***/ (function(module, exports) {

/**
 * Checks if `value` is in the array cache.
 *
 * @private
 * @name has
 * @memberOf SetCache
 * @param {*} value The value to search for.
 * @returns {number} Returns `true` if `value` is found, else `false`.
 */
function setCacheHas(value) {
  return this.__data__.has(value);
}

module.exports = setCacheHas;


/***/ }),
/* 127 */
/***/ (function(module, exports) {

/**
 * A specialized version of `_.some` for arrays without support for iteratee
 * shorthands.
 *
 * @private
 * @param {Array} [array] The array to iterate over.
 * @param {Function} predicate The function invoked per iteration.
 * @returns {boolean} Returns `true` if any element passes the predicate check,
 *  else `false`.
 */
function arraySome(array, predicate) {
  var index = -1,
      length = array == null ? 0 : array.length;

  while (++index < length) {
    if (predicate(array[index], index, array)) {
      return true;
    }
  }
  return false;
}

module.exports = arraySome;


/***/ }),
/* 128 */
/***/ (function(module, exports) {

/**
 * Checks if a `cache` value for `key` exists.
 *
 * @private
 * @param {Object} cache The cache to query.
 * @param {string} key The key of the entry to check.
 * @returns {boolean} Returns `true` if an entry for `key` exists, else `false`.
 */
function cacheHas(cache, key) {
  return cache.has(key);
}

module.exports = cacheHas;


/***/ }),
/* 129 */
/***/ (function(module, exports, __webpack_require__) {

var Symbol = __webpack_require__(5),
    Uint8Array = __webpack_require__(130),
    eq = __webpack_require__(21),
    equalArrays = __webpack_require__(40),
    mapToArray = __webpack_require__(131),
    setToArray = __webpack_require__(132);

/** Used to compose bitmasks for value comparisons. */
var COMPARE_PARTIAL_FLAG = 1,
    COMPARE_UNORDERED_FLAG = 2;

/** `Object#toString` result references. */
var boolTag = '[object Boolean]',
    dateTag = '[object Date]',
    errorTag = '[object Error]',
    mapTag = '[object Map]',
    numberTag = '[object Number]',
    regexpTag = '[object RegExp]',
    setTag = '[object Set]',
    stringTag = '[object String]',
    symbolTag = '[object Symbol]';

var arrayBufferTag = '[object ArrayBuffer]',
    dataViewTag = '[object DataView]';

/** Used to convert symbols to primitives and strings. */
var symbolProto = Symbol ? Symbol.prototype : undefined,
    symbolValueOf = symbolProto ? symbolProto.valueOf : undefined;

/**
 * A specialized version of `baseIsEqualDeep` for comparing objects of
 * the same `toStringTag`.
 *
 * **Note:** This function only supports comparing values with tags of
 * `Boolean`, `Date`, `Error`, `Number`, `RegExp`, or `String`.
 *
 * @private
 * @param {Object} object The object to compare.
 * @param {Object} other The other object to compare.
 * @param {string} tag The `toStringTag` of the objects to compare.
 * @param {number} bitmask The bitmask flags. See `baseIsEqual` for more details.
 * @param {Function} customizer The function to customize comparisons.
 * @param {Function} equalFunc The function to determine equivalents of values.
 * @param {Object} stack Tracks traversed `object` and `other` objects.
 * @returns {boolean} Returns `true` if the objects are equivalent, else `false`.
 */
function equalByTag(object, other, tag, bitmask, customizer, equalFunc, stack) {
  switch (tag) {
    case dataViewTag:
      if ((object.byteLength != other.byteLength) ||
          (object.byteOffset != other.byteOffset)) {
        return false;
      }
      object = object.buffer;
      other = other.buffer;

    case arrayBufferTag:
      if ((object.byteLength != other.byteLength) ||
          !equalFunc(new Uint8Array(object), new Uint8Array(other))) {
        return false;
      }
      return true;

    case boolTag:
    case dateTag:
    case numberTag:
      // Coerce booleans to `1` or `0` and dates to milliseconds.
      // Invalid dates are coerced to `NaN`.
      return eq(+object, +other);

    case errorTag:
      return object.name == other.name && object.message == other.message;

    case regexpTag:
    case stringTag:
      // Coerce regexes to strings and treat strings, primitives and objects,
      // as equal. See http://www.ecma-international.org/ecma-262/7.0/#sec-regexp.prototype.tostring
      // for more details.
      return object == (other + '');

    case mapTag:
      var convert = mapToArray;

    case setTag:
      var isPartial = bitmask & COMPARE_PARTIAL_FLAG;
      convert || (convert = setToArray);

      if (object.size != other.size && !isPartial) {
        return false;
      }
      // Assume cyclic values are equal.
      var stacked = stack.get(object);
      if (stacked) {
        return stacked == other;
      }
      bitmask |= COMPARE_UNORDERED_FLAG;

      // Recursively compare objects (susceptible to call stack limits).
      stack.set(object, other);
      var result = equalArrays(convert(object), convert(other), bitmask, customizer, equalFunc, stack);
      stack['delete'](object);
      return result;

    case symbolTag:
      if (symbolValueOf) {
        return symbolValueOf.call(object) == symbolValueOf.call(other);
      }
  }
  return false;
}

module.exports = equalByTag;


/***/ }),
/* 130 */
/***/ (function(module, exports, __webpack_require__) {

var root = __webpack_require__(1);

/** Built-in value references. */
var Uint8Array = root.Uint8Array;

module.exports = Uint8Array;


/***/ }),
/* 131 */
/***/ (function(module, exports) {

/**
 * Converts `map` to its key-value pairs.
 *
 * @private
 * @param {Object} map The map to convert.
 * @returns {Array} Returns the key-value pairs.
 */
function mapToArray(map) {
  var index = -1,
      result = Array(map.size);

  map.forEach(function(value, key) {
    result[++index] = [key, value];
  });
  return result;
}

module.exports = mapToArray;


/***/ }),
/* 132 */
/***/ (function(module, exports) {

/**
 * Converts `set` to an array of its values.
 *
 * @private
 * @param {Object} set The set to convert.
 * @returns {Array} Returns the values.
 */
function setToArray(set) {
  var index = -1,
      result = Array(set.size);

  set.forEach(function(value) {
    result[++index] = value;
  });
  return result;
}

module.exports = setToArray;


/***/ }),
/* 133 */
/***/ (function(module, exports, __webpack_require__) {

var getAllKeys = __webpack_require__(134);

/** Used to compose bitmasks for value comparisons. */
var COMPARE_PARTIAL_FLAG = 1;

/** Used for built-in method references. */
var objectProto = Object.prototype;

/** Used to check objects for own properties. */
var hasOwnProperty = objectProto.hasOwnProperty;

/**
 * A specialized version of `baseIsEqualDeep` for objects with support for
 * partial deep comparisons.
 *
 * @private
 * @param {Object} object The object to compare.
 * @param {Object} other The other object to compare.
 * @param {number} bitmask The bitmask flags. See `baseIsEqual` for more details.
 * @param {Function} customizer The function to customize comparisons.
 * @param {Function} equalFunc The function to determine equivalents of values.
 * @param {Object} stack Tracks traversed `object` and `other` objects.
 * @returns {boolean} Returns `true` if the objects are equivalent, else `false`.
 */
function equalObjects(object, other, bitmask, customizer, equalFunc, stack) {
  var isPartial = bitmask & COMPARE_PARTIAL_FLAG,
      objProps = getAllKeys(object),
      objLength = objProps.length,
      othProps = getAllKeys(other),
      othLength = othProps.length;

  if (objLength != othLength && !isPartial) {
    return false;
  }
  var index = objLength;
  while (index--) {
    var key = objProps[index];
    if (!(isPartial ? key in other : hasOwnProperty.call(other, key))) {
      return false;
    }
  }
  // Assume cyclic values are equal.
  var stacked = stack.get(object);
  if (stacked && stack.get(other)) {
    return stacked == other;
  }
  var result = true;
  stack.set(object, other);
  stack.set(other, object);

  var skipCtor = isPartial;
  while (++index < objLength) {
    key = objProps[index];
    var objValue = object[key],
        othValue = other[key];

    if (customizer) {
      var compared = isPartial
        ? customizer(othValue, objValue, key, other, object, stack)
        : customizer(objValue, othValue, key, object, other, stack);
    }
    // Recursively compare objects (susceptible to call stack limits).
    if (!(compared === undefined
          ? (objValue === othValue || equalFunc(objValue, othValue, bitmask, customizer, stack))
          : compared
        )) {
      result = false;
      break;
    }
    skipCtor || (skipCtor = key == 'constructor');
  }
  if (result && !skipCtor) {
    var objCtor = object.constructor,
        othCtor = other.constructor;

    // Non `Object` object instances with different constructors are not equal.
    if (objCtor != othCtor &&
        ('constructor' in object && 'constructor' in other) &&
        !(typeof objCtor == 'function' && objCtor instanceof objCtor &&
          typeof othCtor == 'function' && othCtor instanceof othCtor)) {
      result = false;
    }
  }
  stack['delete'](object);
  stack['delete'](other);
  return result;
}

module.exports = equalObjects;


/***/ }),
/* 134 */
/***/ (function(module, exports, __webpack_require__) {

var baseGetAllKeys = __webpack_require__(135),
    getSymbols = __webpack_require__(136),
    keys = __webpack_require__(27);

/**
 * Creates an array of own enumerable property names and symbols of `object`.
 *
 * @private
 * @param {Object} object The object to query.
 * @returns {Array} Returns the array of property names and symbols.
 */
function getAllKeys(object) {
  return baseGetAllKeys(object, keys, getSymbols);
}

module.exports = getAllKeys;


/***/ }),
/* 135 */
/***/ (function(module, exports, __webpack_require__) {

var arrayPush = __webpack_require__(36),
    isArray = __webpack_require__(0);

/**
 * The base implementation of `getAllKeys` and `getAllKeysIn` which uses
 * `keysFunc` and `symbolsFunc` to get the enumerable property names and
 * symbols of `object`.
 *
 * @private
 * @param {Object} object The object to query.
 * @param {Function} keysFunc The function to get the keys of `object`.
 * @param {Function} symbolsFunc The function to get the symbols of `object`.
 * @returns {Array} Returns the array of property names and symbols.
 */
function baseGetAllKeys(object, keysFunc, symbolsFunc) {
  var result = keysFunc(object);
  return isArray(object) ? result : arrayPush(result, symbolsFunc(object));
}

module.exports = baseGetAllKeys;


/***/ }),
/* 136 */
/***/ (function(module, exports, __webpack_require__) {

var arrayFilter = __webpack_require__(137),
    stubArray = __webpack_require__(138);

/** Used for built-in method references. */
var objectProto = Object.prototype;

/** Built-in value references. */
var propertyIsEnumerable = objectProto.propertyIsEnumerable;

/* Built-in method references for those with the same name as other `lodash` methods. */
var nativeGetSymbols = Object.getOwnPropertySymbols;

/**
 * Creates an array of the own enumerable symbols of `object`.
 *
 * @private
 * @param {Object} object The object to query.
 * @returns {Array} Returns the array of symbols.
 */
var getSymbols = !nativeGetSymbols ? stubArray : function(object) {
  if (object == null) {
    return [];
  }
  object = Object(object);
  return arrayFilter(nativeGetSymbols(object), function(symbol) {
    return propertyIsEnumerable.call(object, symbol);
  });
};

module.exports = getSymbols;


/***/ }),
/* 137 */
/***/ (function(module, exports) {

/**
 * A specialized version of `_.filter` for arrays without support for
 * iteratee shorthands.
 *
 * @private
 * @param {Array} [array] The array to iterate over.
 * @param {Function} predicate The function invoked per iteration.
 * @returns {Array} Returns the new filtered array.
 */
function arrayFilter(array, predicate) {
  var index = -1,
      length = array == null ? 0 : array.length,
      resIndex = 0,
      result = [];

  while (++index < length) {
    var value = array[index];
    if (predicate(value, index, array)) {
      result[resIndex++] = value;
    }
  }
  return result;
}

module.exports = arrayFilter;


/***/ }),
/* 138 */
/***/ (function(module, exports) {

/**
 * This method returns a new empty array.
 *
 * @static
 * @memberOf _
 * @since 4.13.0
 * @category Util
 * @returns {Array} Returns the new empty array.
 * @example
 *
 * var arrays = _.times(2, _.stubArray);
 *
 * console.log(arrays);
 * // => [[], []]
 *
 * console.log(arrays[0] === arrays[1]);
 * // => false
 */
function stubArray() {
  return [];
}

module.exports = stubArray;


/***/ }),
/* 139 */
/***/ (function(module, exports, __webpack_require__) {

var baseTimes = __webpack_require__(37),
    isArguments = __webpack_require__(24),
    isArray = __webpack_require__(0),
    isBuffer = __webpack_require__(41),
    isIndex = __webpack_require__(23),
    isTypedArray = __webpack_require__(43);

/** Used for built-in method references. */
var objectProto = Object.prototype;

/** Used to check objects for own properties. */
var hasOwnProperty = objectProto.hasOwnProperty;

/**
 * Creates an array of the enumerable property names of the array-like `value`.
 *
 * @private
 * @param {*} value The value to query.
 * @param {boolean} inherited Specify returning inherited property names.
 * @returns {Array} Returns the array of property names.
 */
function arrayLikeKeys(value, inherited) {
  var isArr = isArray(value),
      isArg = !isArr && isArguments(value),
      isBuff = !isArr && !isArg && isBuffer(value),
      isType = !isArr && !isArg && !isBuff && isTypedArray(value),
      skipIndexes = isArr || isArg || isBuff || isType,
      result = skipIndexes ? baseTimes(value.length, String) : [],
      length = result.length;

  for (var key in value) {
    if ((inherited || hasOwnProperty.call(value, key)) &&
        !(skipIndexes && (
           // Safari 9 has enumerable `arguments.length` in strict mode.
           key == 'length' ||
           // Node.js 0.10 has enumerable non-index properties on buffers.
           (isBuff && (key == 'offset' || key == 'parent')) ||
           // PhantomJS 2 has enumerable non-index properties on typed arrays.
           (isType && (key == 'buffer' || key == 'byteLength' || key == 'byteOffset')) ||
           // Skip index properties.
           isIndex(key, length)
        ))) {
      result.push(key);
    }
  }
  return result;
}

module.exports = arrayLikeKeys;


/***/ }),
/* 140 */
/***/ (function(module, exports) {

/**
 * This method returns `false`.
 *
 * @static
 * @memberOf _
 * @since 4.13.0
 * @category Util
 * @returns {boolean} Returns `false`.
 * @example
 *
 * _.times(2, _.stubFalse);
 * // => [false, false]
 */
function stubFalse() {
  return false;
}

module.exports = stubFalse;


/***/ }),
/* 141 */
/***/ (function(module, exports, __webpack_require__) {

var baseGetTag = __webpack_require__(4),
    isLength = __webpack_require__(25),
    isObjectLike = __webpack_require__(6);

/** `Object#toString` result references. */
var argsTag = '[object Arguments]',
    arrayTag = '[object Array]',
    boolTag = '[object Boolean]',
    dateTag = '[object Date]',
    errorTag = '[object Error]',
    funcTag = '[object Function]',
    mapTag = '[object Map]',
    numberTag = '[object Number]',
    objectTag = '[object Object]',
    regexpTag = '[object RegExp]',
    setTag = '[object Set]',
    stringTag = '[object String]',
    weakMapTag = '[object WeakMap]';

var arrayBufferTag = '[object ArrayBuffer]',
    dataViewTag = '[object DataView]',
    float32Tag = '[object Float32Array]',
    float64Tag = '[object Float64Array]',
    int8Tag = '[object Int8Array]',
    int16Tag = '[object Int16Array]',
    int32Tag = '[object Int32Array]',
    uint8Tag = '[object Uint8Array]',
    uint8ClampedTag = '[object Uint8ClampedArray]',
    uint16Tag = '[object Uint16Array]',
    uint32Tag = '[object Uint32Array]';

/** Used to identify `toStringTag` values of typed arrays. */
var typedArrayTags = {};
typedArrayTags[float32Tag] = typedArrayTags[float64Tag] =
typedArrayTags[int8Tag] = typedArrayTags[int16Tag] =
typedArrayTags[int32Tag] = typedArrayTags[uint8Tag] =
typedArrayTags[uint8ClampedTag] = typedArrayTags[uint16Tag] =
typedArrayTags[uint32Tag] = true;
typedArrayTags[argsTag] = typedArrayTags[arrayTag] =
typedArrayTags[arrayBufferTag] = typedArrayTags[boolTag] =
typedArrayTags[dataViewTag] = typedArrayTags[dateTag] =
typedArrayTags[errorTag] = typedArrayTags[funcTag] =
typedArrayTags[mapTag] = typedArrayTags[numberTag] =
typedArrayTags[objectTag] = typedArrayTags[regexpTag] =
typedArrayTags[setTag] = typedArrayTags[stringTag] =
typedArrayTags[weakMapTag] = false;

/**
 * The base implementation of `_.isTypedArray` without Node.js optimizations.
 *
 * @private
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is a typed array, else `false`.
 */
function baseIsTypedArray(value) {
  return isObjectLike(value) &&
    isLength(value.length) && !!typedArrayTags[baseGetTag(value)];
}

module.exports = baseIsTypedArray;


/***/ }),
/* 142 */
/***/ (function(module, exports) {

/**
 * The base implementation of `_.unary` without support for storing metadata.
 *
 * @private
 * @param {Function} func The function to cap arguments for.
 * @returns {Function} Returns the new capped function.
 */
function baseUnary(func) {
  return function(value) {
    return func(value);
  };
}

module.exports = baseUnary;


/***/ }),
/* 143 */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(module) {var freeGlobal = __webpack_require__(30);

/** Detect free variable `exports`. */
var freeExports = typeof exports == 'object' && exports && !exports.nodeType && exports;

/** Detect free variable `module`. */
var freeModule = freeExports && typeof module == 'object' && module && !module.nodeType && module;

/** Detect the popular CommonJS extension `module.exports`. */
var moduleExports = freeModule && freeModule.exports === freeExports;

/** Detect free variable `process` from Node.js. */
var freeProcess = moduleExports && freeGlobal.process;

/** Used to access faster Node.js helpers. */
var nodeUtil = (function() {
  try {
    // Use `util.types` for Node.js 10+.
    var types = freeModule && freeModule.require && freeModule.require('util').types;

    if (types) {
      return types;
    }

    // Legacy `process.binding('util')` for Node.js < 10.
    return freeProcess && freeProcess.binding && freeProcess.binding('util');
  } catch (e) {}
}());

module.exports = nodeUtil;

/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(42)(module)))

/***/ }),
/* 144 */
/***/ (function(module, exports, __webpack_require__) {

var isPrototype = __webpack_require__(145),
    nativeKeys = __webpack_require__(146);

/** Used for built-in method references. */
var objectProto = Object.prototype;

/** Used to check objects for own properties. */
var hasOwnProperty = objectProto.hasOwnProperty;

/**
 * The base implementation of `_.keys` which doesn't treat sparse arrays as dense.
 *
 * @private
 * @param {Object} object The object to query.
 * @returns {Array} Returns the array of property names.
 */
function baseKeys(object) {
  if (!isPrototype(object)) {
    return nativeKeys(object);
  }
  var result = [];
  for (var key in Object(object)) {
    if (hasOwnProperty.call(object, key) && key != 'constructor') {
      result.push(key);
    }
  }
  return result;
}

module.exports = baseKeys;


/***/ }),
/* 145 */
/***/ (function(module, exports) {

/** Used for built-in method references. */
var objectProto = Object.prototype;

/**
 * Checks if `value` is likely a prototype object.
 *
 * @private
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is a prototype, else `false`.
 */
function isPrototype(value) {
  var Ctor = value && value.constructor,
      proto = (typeof Ctor == 'function' && Ctor.prototype) || objectProto;

  return value === proto;
}

module.exports = isPrototype;


/***/ }),
/* 146 */
/***/ (function(module, exports, __webpack_require__) {

var overArg = __webpack_require__(147);

/* Built-in method references for those with the same name as other `lodash` methods. */
var nativeKeys = overArg(Object.keys, Object);

module.exports = nativeKeys;


/***/ }),
/* 147 */
/***/ (function(module, exports) {

/**
 * Creates a unary function that invokes `func` with its argument transformed.
 *
 * @private
 * @param {Function} func The function to wrap.
 * @param {Function} transform The argument transform.
 * @returns {Function} Returns the new function.
 */
function overArg(func, transform) {
  return function(arg) {
    return func(transform(arg));
  };
}

module.exports = overArg;


/***/ }),
/* 148 */
/***/ (function(module, exports, __webpack_require__) {

var DataView = __webpack_require__(149),
    Map = __webpack_require__(22),
    Promise = __webpack_require__(150),
    Set = __webpack_require__(151),
    WeakMap = __webpack_require__(152),
    baseGetTag = __webpack_require__(4),
    toSource = __webpack_require__(32);

/** `Object#toString` result references. */
var mapTag = '[object Map]',
    objectTag = '[object Object]',
    promiseTag = '[object Promise]',
    setTag = '[object Set]',
    weakMapTag = '[object WeakMap]';

var dataViewTag = '[object DataView]';

/** Used to detect maps, sets, and weakmaps. */
var dataViewCtorString = toSource(DataView),
    mapCtorString = toSource(Map),
    promiseCtorString = toSource(Promise),
    setCtorString = toSource(Set),
    weakMapCtorString = toSource(WeakMap);

/**
 * Gets the `toStringTag` of `value`.
 *
 * @private
 * @param {*} value The value to query.
 * @returns {string} Returns the `toStringTag`.
 */
var getTag = baseGetTag;

// Fallback for data views, maps, sets, and weak maps in IE 11 and promises in Node.js < 6.
if ((DataView && getTag(new DataView(new ArrayBuffer(1))) != dataViewTag) ||
    (Map && getTag(new Map) != mapTag) ||
    (Promise && getTag(Promise.resolve()) != promiseTag) ||
    (Set && getTag(new Set) != setTag) ||
    (WeakMap && getTag(new WeakMap) != weakMapTag)) {
  getTag = function(value) {
    var result = baseGetTag(value),
        Ctor = result == objectTag ? value.constructor : undefined,
        ctorString = Ctor ? toSource(Ctor) : '';

    if (ctorString) {
      switch (ctorString) {
        case dataViewCtorString: return dataViewTag;
        case mapCtorString: return mapTag;
        case promiseCtorString: return promiseTag;
        case setCtorString: return setTag;
        case weakMapCtorString: return weakMapTag;
      }
    }
    return result;
  };
}

module.exports = getTag;


/***/ }),
/* 149 */
/***/ (function(module, exports, __webpack_require__) {

var getNative = __webpack_require__(2),
    root = __webpack_require__(1);

/* Built-in method references that are verified to be native. */
var DataView = getNative(root, 'DataView');

module.exports = DataView;


/***/ }),
/* 150 */
/***/ (function(module, exports, __webpack_require__) {

var getNative = __webpack_require__(2),
    root = __webpack_require__(1);

/* Built-in method references that are verified to be native. */
var Promise = getNative(root, 'Promise');

module.exports = Promise;


/***/ }),
/* 151 */
/***/ (function(module, exports, __webpack_require__) {

var getNative = __webpack_require__(2),
    root = __webpack_require__(1);

/* Built-in method references that are verified to be native. */
var Set = getNative(root, 'Set');

module.exports = Set;


/***/ }),
/* 152 */
/***/ (function(module, exports, __webpack_require__) {

var getNative = __webpack_require__(2),
    root = __webpack_require__(1);

/* Built-in method references that are verified to be native. */
var WeakMap = getNative(root, 'WeakMap');

module.exports = WeakMap;


/***/ }),
/* 153 */
/***/ (function(module, exports, __webpack_require__) {

var isStrictComparable = __webpack_require__(44),
    keys = __webpack_require__(27);

/**
 * Gets the property names, values, and compare flags of `object`.
 *
 * @private
 * @param {Object} object The object to query.
 * @returns {Array} Returns the match data of `object`.
 */
function getMatchData(object) {
  var result = keys(object),
      length = result.length;

  while (length--) {
    var key = result[length],
        value = object[key];

    result[length] = [key, value, isStrictComparable(value)];
  }
  return result;
}

module.exports = getMatchData;


/***/ }),
/* 154 */
/***/ (function(module, exports, __webpack_require__) {

var baseIsEqual = __webpack_require__(39),
    get = __webpack_require__(155),
    hasIn = __webpack_require__(35),
    isKey = __webpack_require__(19),
    isStrictComparable = __webpack_require__(44),
    matchesStrictComparable = __webpack_require__(45),
    toKey = __webpack_require__(8);

/** Used to compose bitmasks for value comparisons. */
var COMPARE_PARTIAL_FLAG = 1,
    COMPARE_UNORDERED_FLAG = 2;

/**
 * The base implementation of `_.matchesProperty` which doesn't clone `srcValue`.
 *
 * @private
 * @param {string} path The path of the property to get.
 * @param {*} srcValue The value to match.
 * @returns {Function} Returns the new spec function.
 */
function baseMatchesProperty(path, srcValue) {
  if (isKey(path) && isStrictComparable(srcValue)) {
    return matchesStrictComparable(toKey(path), srcValue);
  }
  return function(object) {
    var objValue = get(object, path);
    return (objValue === undefined && objValue === srcValue)
      ? hasIn(object, path)
      : baseIsEqual(srcValue, objValue, COMPARE_PARTIAL_FLAG | COMPARE_UNORDERED_FLAG);
  };
}

module.exports = baseMatchesProperty;


/***/ }),
/* 155 */
/***/ (function(module, exports, __webpack_require__) {

var baseGet = __webpack_require__(18);

/**
 * Gets the value at `path` of `object`. If the resolved value is
 * `undefined`, the `defaultValue` is returned in its place.
 *
 * @static
 * @memberOf _
 * @since 3.7.0
 * @category Object
 * @param {Object} object The object to query.
 * @param {Array|string} path The path of the property to get.
 * @param {*} [defaultValue] The value returned for `undefined` resolved values.
 * @returns {*} Returns the resolved value.
 * @example
 *
 * var object = { 'a': [{ 'b': { 'c': 3 } }] };
 *
 * _.get(object, 'a[0].b.c');
 * // => 3
 *
 * _.get(object, ['a', '0', 'b', 'c']);
 * // => 3
 *
 * _.get(object, 'a.b.c', 'default');
 * // => 'default'
 */
function get(object, path, defaultValue) {
  var result = object == null ? undefined : baseGet(object, path);
  return result === undefined ? defaultValue : result;
}

module.exports = get;


/***/ }),
/* 156 */
/***/ (function(module, exports, __webpack_require__) {

var baseProperty = __webpack_require__(157),
    basePropertyDeep = __webpack_require__(158),
    isKey = __webpack_require__(19),
    toKey = __webpack_require__(8);

/**
 * Creates a function that returns the value at `path` of a given object.
 *
 * @static
 * @memberOf _
 * @since 2.4.0
 * @category Util
 * @param {Array|string} path The path of the property to get.
 * @returns {Function} Returns the new accessor function.
 * @example
 *
 * var objects = [
 *   { 'a': { 'b': 2 } },
 *   { 'a': { 'b': 1 } }
 * ];
 *
 * _.map(objects, _.property('a.b'));
 * // => [2, 1]
 *
 * _.map(_.sortBy(objects, _.property(['a', 'b'])), 'a.b');
 * // => [1, 2]
 */
function property(path) {
  return isKey(path) ? baseProperty(toKey(path)) : basePropertyDeep(path);
}

module.exports = property;


/***/ }),
/* 157 */
/***/ (function(module, exports) {

/**
 * The base implementation of `_.property` without support for deep paths.
 *
 * @private
 * @param {string} key The key of the property to get.
 * @returns {Function} Returns the new accessor function.
 */
function baseProperty(key) {
  return function(object) {
    return object == null ? undefined : object[key];
  };
}

module.exports = baseProperty;


/***/ }),
/* 158 */
/***/ (function(module, exports, __webpack_require__) {

var baseGet = __webpack_require__(18);

/**
 * A specialized version of `baseProperty` which supports deep paths.
 *
 * @private
 * @param {Array|string} path The path of the property to get.
 * @returns {Function} Returns the new accessor function.
 */
function basePropertyDeep(path) {
  return function(object) {
    return baseGet(object, path);
  };
}

module.exports = basePropertyDeep;


/***/ }),
/* 159 */
/***/ (function(module, exports, __webpack_require__) {

var baseEach = __webpack_require__(160),
    isArrayLike = __webpack_require__(28);

/**
 * The base implementation of `_.map` without support for iteratee shorthands.
 *
 * @private
 * @param {Array|Object} collection The collection to iterate over.
 * @param {Function} iteratee The function invoked per iteration.
 * @returns {Array} Returns the new mapped array.
 */
function baseMap(collection, iteratee) {
  var index = -1,
      result = isArrayLike(collection) ? Array(collection.length) : [];

  baseEach(collection, function(value, key, collection) {
    result[++index] = iteratee(value, key, collection);
  });
  return result;
}

module.exports = baseMap;


/***/ }),
/* 160 */
/***/ (function(module, exports, __webpack_require__) {

var baseForOwn = __webpack_require__(161),
    createBaseEach = __webpack_require__(164);

/**
 * The base implementation of `_.forEach` without support for iteratee shorthands.
 *
 * @private
 * @param {Array|Object} collection The collection to iterate over.
 * @param {Function} iteratee The function invoked per iteration.
 * @returns {Array|Object} Returns `collection`.
 */
var baseEach = createBaseEach(baseForOwn);

module.exports = baseEach;


/***/ }),
/* 161 */
/***/ (function(module, exports, __webpack_require__) {

var baseFor = __webpack_require__(162),
    keys = __webpack_require__(27);

/**
 * The base implementation of `_.forOwn` without support for iteratee shorthands.
 *
 * @private
 * @param {Object} object The object to iterate over.
 * @param {Function} iteratee The function invoked per iteration.
 * @returns {Object} Returns `object`.
 */
function baseForOwn(object, iteratee) {
  return object && baseFor(object, iteratee, keys);
}

module.exports = baseForOwn;


/***/ }),
/* 162 */
/***/ (function(module, exports, __webpack_require__) {

var createBaseFor = __webpack_require__(163);

/**
 * The base implementation of `baseForOwn` which iterates over `object`
 * properties returned by `keysFunc` and invokes `iteratee` for each property.
 * Iteratee functions may exit iteration early by explicitly returning `false`.
 *
 * @private
 * @param {Object} object The object to iterate over.
 * @param {Function} iteratee The function invoked per iteration.
 * @param {Function} keysFunc The function to get the keys of `object`.
 * @returns {Object} Returns `object`.
 */
var baseFor = createBaseFor();

module.exports = baseFor;


/***/ }),
/* 163 */
/***/ (function(module, exports) {

/**
 * Creates a base function for methods like `_.forIn` and `_.forOwn`.
 *
 * @private
 * @param {boolean} [fromRight] Specify iterating from right to left.
 * @returns {Function} Returns the new base function.
 */
function createBaseFor(fromRight) {
  return function(object, iteratee, keysFunc) {
    var index = -1,
        iterable = Object(object),
        props = keysFunc(object),
        length = props.length;

    while (length--) {
      var key = props[fromRight ? length : ++index];
      if (iteratee(iterable[key], key, iterable) === false) {
        break;
      }
    }
    return object;
  };
}

module.exports = createBaseFor;


/***/ }),
/* 164 */
/***/ (function(module, exports, __webpack_require__) {

var isArrayLike = __webpack_require__(28);

/**
 * Creates a `baseEach` or `baseEachRight` function.
 *
 * @private
 * @param {Function} eachFunc The function to iterate over a collection.
 * @param {boolean} [fromRight] Specify iterating from right to left.
 * @returns {Function} Returns the new base function.
 */
function createBaseEach(eachFunc, fromRight) {
  return function(collection, iteratee) {
    if (collection == null) {
      return collection;
    }
    if (!isArrayLike(collection)) {
      return eachFunc(collection, iteratee);
    }
    var length = collection.length,
        index = fromRight ? length : -1,
        iterable = Object(collection);

    while ((fromRight ? index-- : ++index < length)) {
      if (iteratee(iterable[index], index, iterable) === false) {
        break;
      }
    }
    return collection;
  };
}

module.exports = createBaseEach;


/***/ }),
/* 165 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/**
 * Column layout icons.
 */

var icons = {};

/* One column - 100. */
icons.oneEqual = wp.element.createElement(
	"svg",
	{ className: "dashicon", height: "26", viewBox: "0 0 60 30", xmlns: "http://www.w3.org/2000/svg", fillRule: "evenodd",
		clipRule: "evenodd", strokeLinejoin: "round", strokeMiterlimit: "1.414" },
	wp.element.createElement("rect", { x: "0", y: "0", width: "60", height: "30", fill: "#6d6a6f"
	})
);

/* Two columns - 50/50. */
icons.twoEqual = wp.element.createElement(
	"svg",
	{ viewBox: "0 0 60 30", height: "26", xmlns: "http://www.w3.org/2000/svg", fillRule: "evenodd",
		clipRule: "evenodd", strokeLinejoin: "round", strokeMiterlimit: "1.414" },
	wp.element.createElement("rect", { x: "33", y: "0", width: "29", height: "30", fill: "#6d6a6f"
	}),
	wp.element.createElement("rect", { x: "0", y: "0", width: "29", height: "30", fill: "#6d6a6f"
	})
);

/* Two columns - 75/25. */
icons.twoLeftWide = wp.element.createElement(
	"svg",
	{ viewBox: "0 0 60 30", height: "26", xmlns: "http://www.w3.org/2000/svg", fillRule: "evenodd",
		clipRule: "evenodd", strokeLinejoin: "round", strokeMiterlimit: "1.414" },
	wp.element.createElement("rect", { x: "43", y: "0", width: "16", height: "30", fill: "#6d6a6f"
	}),
	wp.element.createElement("rect", { x: "0", y: "0", width: "39", height: "30", fill: "#6d6a6f"
	})
);

/* Two columns - 25/75. */
icons.twoRightWide = wp.element.createElement(
	"svg",
	{ viewBox: "0 0 60 30", height: "26", xmlns: "http://www.w3.org/2000/svg", fillRule: "evenodd",
		clipRule: "evenodd", strokeLinejoin: "round", strokeMiterlimit: "1.414" },
	wp.element.createElement("rect", { x: "20", y: "0", width: "39", height: "30", fill: "#6d6a6f"
	}),
	wp.element.createElement("rect", { x: "0", y: "0", width: "16", height: "30", fill: "#6d6a6f"
	})
);

/* Three columns - 33/33/33. */
icons.threeEqual = wp.element.createElement(
	"svg",
	{ viewBox: "0 0 60 30", height: "26", xmlns: "http://www.w3.org/2000/svg", fillRule: "evenodd",
		clipRule: "evenodd", strokeLinejoin: "round", strokeMiterlimit: "1.414" },
	wp.element.createElement("rect", { x: "0", y: "0", width: "17.500", height: "30", fill: "#6d6a6f"
	}),
	wp.element.createElement("rect", { x: "21.500", y: "0", width: "17.500", height: "30", fill: "#6d6a6f"
	}),
	wp.element.createElement("rect", { x: "43", y: "0", width: "17.500", height: "30", fill: "#6d6a6f"
	})
);

/* Three column - 25/50/25. */
icons.threeWideCenter = wp.element.createElement(
	"svg",
	{ viewBox: "0 0 60 30", height: "26", xmlns: "http://www.w3.org/2000/svg", fillRule: "evenodd", clipRule: "evenodd", strokeLinejoin: "round", strokeMiterlimit: "1.414" },
	wp.element.createElement("rect", { x: "0", y: "0", width: "11", height: "30", fill: "#6d6a6f" }),
	wp.element.createElement("rect", { x: "15", y: "0", width: "31", height: "30", fill: "#6d6a6f" }),
	wp.element.createElement("rect", { x: "50", y: "0", width: "11", height: "30", fill: "#6d6a6f" })
);

/* Three column - 50/25/25. */
icons.threeWideLeft = wp.element.createElement(
	"svg",
	{ viewBox: "0 0 60 30", height: "26", xmlns: "http://www.w3.org/2000/svg", fillRule: "evenodd",
		clipRule: "evenodd", strokeLinejoin: "round", strokeMiterlimit: "1.414" },
	wp.element.createElement("rect", { x: "0", y: "0", width: "30", height: "30", fill: "#6d6a6f"
	}),
	wp.element.createElement("rect", { x: "34", y: "0", width: "11", height: "30", fill: "#6d6a6f"
	}),
	wp.element.createElement("rect", { x: "49", y: "0", width: "11", height: "30", fill: "#6d6a6f"
	})
);

/* Three column - 25/25/50. */
icons.threeWideRight = wp.element.createElement(
	"svg",
	{ viewBox: "0 0 60 30", height: "26", xmlns: "http://www.w3.org/2000/svg", fillRule: "evenodd",
		clipRule: "evenodd", strokeLinejoin: "round", strokeMiterlimit: "1.414" },
	wp.element.createElement("rect", { x: "0", y: "0", width: "11", height: "30", fill: "#6d6a6f"
	}),
	wp.element.createElement("rect", { x: "15", y: "0", width: "11", height: "30", fill: "#6d6a6f"
	}),
	wp.element.createElement("rect", { x: "30", y: "0", width: "30", height: "30", fill: "#6d6a6f"
	})
);

/* Four column - 25/25/25/25. */
icons.fourEqual = wp.element.createElement(
	"svg",
	{ viewBox: "0 0 60 30", height: "26", xmlns: "http://www.w3.org/2000/svg", fillRule: "evenodd", clipRule: "evenodd", strokeLinejoin: "round", strokeMiterlimit: "1.414" },
	wp.element.createElement("rect", { x: "0", y: "0", width: "12", height: "30", fill: "#6d6a6f" }),
	wp.element.createElement("rect", { x: "16", y: "0", width: "12", height: "30", fill: "#6d6a6f" }),
	wp.element.createElement("rect", { x: "32", y: "0", width: "12", height: "30", fill: "#6d6a6f" }),
	wp.element.createElement("rect", { x: "48", y: "0", width: "12", height: "30", fill: "#6d6a6f" })
);

/* Four column - 40/20/20/20. */
icons.fourLeft = wp.element.createElement(
	"svg",
	{ viewBox: "0 0 60 30", height: "26", xmlns: "http://www.w3.org/2000/svg", fillRule: "evenodd", clipRule: "evenodd", strokeLinejoin: "round", strokeMiterlimit: "1.414" },
	wp.element.createElement("rect", { x: "0", y: "0", width: "21", height: "30", fill: "#6d6a6f" }),
	wp.element.createElement("rect", { x: "25", y: "0", width: "9", height: "30", fill: "#6d6a6f" }),
	wp.element.createElement("rect", { x: "38", y: "0", width: "9", height: "30", fill: "#6d6a6f" }),
	wp.element.createElement("rect", { x: "51", y: "0", width: "9", height: "30", fill: "#6d6a6f" })
);

/* Four column - 20/20/20/40. */
icons.fourRight = wp.element.createElement(
	"svg",
	{ viewBox: "0 0 60 30", height: "26", xmlns: "http://www.w3.org/2000/svg", fillRule: "evenodd", clipRule: "evenodd", strokeLinejoin: "round", strokeMiterlimit: "1.414" },
	wp.element.createElement("rect", { x: "0", y: "0", width: "9", height: "30", fill: "#6d6a6f" }),
	wp.element.createElement("rect", { x: "12.800", y: "0", width: "9", height: "30", fill: "#6d6a6f" }),
	wp.element.createElement("rect", { x: "25.600", y: "0", width: "9", height: "30", fill: "#6d6a6f" }),
	wp.element.createElement("rect", { x: "38.400", y: "0", width: "21", height: "30", fill: "#6d6a6f" })
);

/* Five columns - 20/20/20/20/20. */
icons.fiveEqual = wp.element.createElement(
	"svg",
	{ viewBox: "0 0 60 30", height: "26", xmlns: "http://www.w3.org/2000/svg", fillRule: "evenodd", clipRule: "evenodd", strokeLinejoin: "round", strokeMiterlimit: "1.414" },
	wp.element.createElement("rect", { x: "0", y: "0", width: "9", height: "30", fill: "#6d6a6f" }),
	wp.element.createElement("rect", { x: "12.400", y: "0", width: "9", height: "30", fill: "#6d6a6f" }),
	wp.element.createElement("rect", { x: "24.800", y: "0", width: "9", height: "30", fill: "#6d6a6f" }),
	wp.element.createElement("rect", { x: "37.200", y: "0", width: "9", height: "30", fill: "#6d6a6f" }),
	wp.element.createElement("rect", { x: "49.600", y: "0", width: "9", height: "30", fill: "#6d6a6f" })
);

/* Five columns - 16/16/16/16/16. */
icons.sixEqual = wp.element.createElement(
	"svg",
	{ viewBox: "0 0 60 30", height: "26", xmlns: "http://www.w3.org/2000/svg", fillRule: "evenodd", clipRule: "evenodd", strokeLinejoin: "round", strokeMiterlimit: "1.414" },
	wp.element.createElement("rect", { x: "0", y: "0", width: "7", height: "30", fill: "#6d6a6f" }),
	wp.element.createElement("rect", { x: "10.330", y: "0", width: "7", height: "30", fill: "#6d6a6f" }),
	wp.element.createElement("rect", { x: "20.660", y: "0", width: "7", height: "30", fill: "#6d6a6f" }),
	wp.element.createElement("rect", { x: "30.990", y: "0", width: "7", height: "30", fill: "#6d6a6f" }),
	wp.element.createElement("rect", { x: "41.320", y: "0", width: "7", height: "30", fill: "#6d6a6f" }),
	wp.element.createElement("rect", { x: "51.650", y: "0", width: "7", height: "30", fill: "#6d6a6f" })
);

/* Block icon. */
icons.blockIcon = wp.element.createElement(
	"svg",
	{ viewBox: "0 0 60 34", height: "34", xmlns: "http://www.w3.org/2000/svg", fillRule: "evenodd",
		clipRule: "evenodd", strokeLinejoin: "round", strokeMiterlimit: "1.414" },
	wp.element.createElement("rect", { x: "38", y: "0", width: "12", height: "34", fill: "#6d6a6f" }),
	wp.element.createElement("rect", { x: "22", y: "0", width: "12", height: "34", fill: "#6d6a6f" }),
	wp.element.createElement("rect", { x: "6", y: "0", width: "12", height: "34", fill: "#6d6a6f" })
);

/* harmony default export */ __webpack_exports__["a"] = (icons);

/***/ }),
/* 166 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var __ = wp.i18n.__;
var _wp$element = wp.element,
    Fragment = _wp$element.Fragment,
    Component = _wp$element.Component;
var _wp$editor = wp.editor,
    MediaUpload = _wp$editor.MediaUpload,
    InspectorControls = _wp$editor.InspectorControls;
var _wp$components = wp.components,
    TextControl = _wp$components.TextControl,
    PanelBody = _wp$components.PanelBody,
    PanelRow = _wp$components.PanelRow,
    RangeControl = _wp$components.RangeControl,
    SelectControl = _wp$components.SelectControl,
    ToggleControl = _wp$components.ToggleControl,
    Button = _wp$components.Button,
    ColorPalette = _wp$components.ColorPalette;

/**
 * Create an Inspector Controls wrapper Component
 */

var Inspector = function (_Component) {
	_inherits(Inspector, _Component);

	function Inspector() {
		_classCallCheck(this, Inspector);

		return _possibleConstructorReturn(this, (Inspector.__proto__ || Object.getPrototypeOf(Inspector)).apply(this, arguments));
	}

	_createClass(Inspector, [{
		key: 'render',
		value: function render() {
			var _this2 = this;

			var onSelectLayout = function onSelectLayout(event) {
				var selectedLayout = event.target.value;
				var selectedClass = event.target.className;
				'components-button button has-tooltip active' === selectedClass && _this2.props.setAttributes({ layout: '' });
				'components-button button has-tooltip active' !== selectedClass && _this2.props.setAttributes({ layout: selectedLayout ? selectedLayout : '' });
			};

			return wp.element.createElement(
				InspectorControls,
				null,
				wp.element.createElement(
					'div',
					{ className: 'custom-inspactor-setting' },
					wp.element.createElement(
						'div',
						{ className: 'full-width mt30' },
						wp.element.createElement(ToggleControl, {
							label: __('Toggle Inserter'),
							checked: !!this.props.attributes.ToggleInserter,
							onChange: function onChange() {
								return _this2.props.setAttributes({ ToggleInserter: !_this2.props.attributes.ToggleInserter });
							}
						})
					),
					wp.element.createElement(
						PanelBody,
						{ title: __('Wrapper'), initialOpen: false },
						wp.element.createElement(TextControl, {
							label: 'Wrapper Tag ID Attribute',
							type: 'string',
							placeHolder: 'id',
							value: this.props.attributes.elementID,
							onChange: function onChange(value) {
								return _this2.props.setAttributes({ elementID: value });
							}
						}),
						wp.element.createElement(ToggleControl, {
							label: __('Show Block Title'),
							checked: !!this.props.attributes.showTitle,
							onChange: function onChange() {
								_this2.props.setAttributes({ showTitle: !_this2.props.attributes.showTitle });
							}
						})
					),
					wp.element.createElement(
						PanelBody,
						{ title: __('Page layout'), initialOpen: false },
						wp.element.createElement(
							Button,
							{
								className: 'full' === this.props.attributes.layout ? 'button has-tooltip active' : 'button has-tooltip',
								onClick: onSelectLayout,
								'data-tooltip': 'This layout is for full width (width:100%).',
								value: 'full'
							},
							__('Full Width')
						),
						wp.element.createElement(
							Button,
							{
								className: 'fixed' === this.props.attributes.layout ? 'button has-tooltip active' : 'button has-tooltip',
								onClick: onSelectLayout,
								'data-tooltip': 'This layout is for fixed width (width:1200px).',
								value: 'fixed'
							},
							__('Fixed')
						)
					),
					wp.element.createElement(
						PanelBody,
						{ title: __('Background'), initialOpen: false, className: 'bg-setting' },
						wp.element.createElement(
							PanelBody,
							{ title: __('Background Image'), initialOpen: false, className: 'bg-setting bg-img-setting' },
							wp.element.createElement(MediaUpload, {
								onSelect: function onSelect(backgroundImage) {
									return _this2.props.setAttributes({
										backgroundImage: backgroundImage.sizes.full.url ? backgroundImage.sizes.full.url : '',
										backgroundColor: ''
									});
								},
								type: 'image',
								value: this.props.attributes.backgroundImage,
								render: function render(_ref) {
									var open = _ref.open;
									return wp.element.createElement(
										Button,
										{
											className: _this2.props.attributes.backgroundImage ? 'image-button' : 'button button-large',
											onClick: open },
										!_this2.props.attributes.backgroundImage ? __('Upload Image') : wp.element.createElement('div', { style: {
												backgroundImage: 'url(' + _this2.props.attributes.backgroundImage + ')',
												backgroundSize: 'cover',
												backgroundPosition: 'center',
												height: '150px',
												width: '225px'
											} })
									);
								}
							}),
							this.props.attributes.backgroundImage ? wp.element.createElement(
								Button,
								{
									className: 'button',
									onClick: function onClick() {
										return _this2.props.setAttributes({ backgroundImage: '', overlayColor: '' });
									} },
								__('Remove Background Image')
							) : null,
							this.props.attributes.backgroundImage && wp.element.createElement(
								Fragment,
								null,
								wp.element.createElement(ToggleControl, {
									label: __('Background Size ON - Set background size "Cover"'),
									checked: this.props.attributes.backgroundSize,
									onChange: function onChange() {
										return _this2.props.setAttributes({ backgroundSize: !_this2.props.attributes.backgroundSize });
									}
								}),
								wp.element.createElement(ToggleControl, {
									label: __('Background Attachment ON - Set background attachment "Fixed" '),
									checked: this.props.attributes.backgroundAttachment,
									onChange: function onChange() {
										return _this2.props.setAttributes({ backgroundAttachment: !_this2.props.attributes.backgroundAttachment });
									}
								}),
								wp.element.createElement(SelectControl, {
									label: __('Select Position'),
									value: this.props.attributes.backgroundPosition,
									options: [{ label: __('Bottom'), value: 'bottom' }, { label: __('Center'), value: 'center' }, { label: __('Inherit'), value: 'inherit' }, { label: __('Initial'), value: 'initial' }, { label: __('Left'), value: 'left' }, { label: __('Right'), value: 'right' }, { label: __('Top'), value: 'top' }, { label: __('Unset'), value: 'unset' }],
									onChange: function onChange(value) {
										return _this2.props.setAttributes({ backgroundPosition: value });
									}
								}),
								wp.element.createElement(
									'div',
									{ className: 'inspector-field inspector-field-color components-base-control' },
									wp.element.createElement(
										'label',
										{ className: 'inspector-mb-0' },
										'Overlay'
									),
									wp.element.createElement(
										'div',
										{ className: 'inspector-ml-auto' },
										wp.element.createElement(ColorPalette, {
											value: this.props.attributes.overlayColor,
											onChange: function onChange(value) {
												return _this2.props.setAttributes({ overlayColor: value });
											}
										})
									)
								),
								wp.element.createElement(
									'div',
									{ className: 'inspector-field inspector-border-radius components-base-control' },
									wp.element.createElement(
										'label',
										null,
										'Background Opacity'
									),
									wp.element.createElement(RangeControl, {
										value: this.props.attributes.opacity,
										min: 0,
										max: 100,
										step: 10,
										onChange: function onChange(ratio) {
											return _this2.props.setAttributes({ opacity: ratio });
										}
									})
								)
							)
						),
						wp.element.createElement(
							PanelBody,
							{ title: __('Background Color'), initialOpen: false, className: 'bg-setting' },
							wp.element.createElement(
								PanelRow,
								null,
								wp.element.createElement(
									'div',
									{ className: 'inspector-field inspector-field-color ' },
									wp.element.createElement(
										'label',
										{ className: 'inspector-mb-0' },
										'Background Color'
									),
									wp.element.createElement(
										'div',
										{ className: 'inspector-ml-auto' },
										wp.element.createElement(ColorPalette, {
											value: this.props.attributes.backgroundColor,
											onChange: function onChange(value) {
												return _this2.props.setAttributes({ backgroundColor: value ? value : '', opacity: 0 });
											}
										})
									)
								)
							)
						),
						wp.element.createElement(
							PanelBody,
							{ title: __('Gradient Background'), initialOpen: false, className: 'bg-setting gredient-setting' },
							wp.element.createElement(SelectControl, {
								label: __('Select Gradient Type'),
								value: this.props.attributes.gradientType,
								options: [{ label: __('Select Type'), value: '' }, { label: __('bottom'), value: 'to bottom' }, { label: __('Top'), value: 'to top' }, { label: __('Right'), value: 'to right' }, { label: __('Left'), value: 'to left' }, { label: __('Top Left'), value: 'to top left' }, { label: __('Bottom Left'), value: 'to bottom left' }, { label: __('Top Right'), value: 'to top right' }, { label: __('Bottom Right'), value: 'to bottom right' }],
								onChange: function onChange(value) {
									return _this2.props.setAttributes({ gradientType: value });
								}
							}),
							this.props.attributes.gradientType && wp.element.createElement(
								Fragment,
								null,
								wp.element.createElement(
									'h3',
									null,
									__('Gradient Fill 1')
								),
								wp.element.createElement(
									'div',
									{ className: 'inspector-field inspector-field-color components-base-control gradientcolor' },
									wp.element.createElement(
										'label',
										{ className: 'inspector-mb-0' },
										'Color'
									),
									wp.element.createElement(
										'div',
										{ className: 'inspector-ml-auto' },
										wp.element.createElement(ColorPalette, {
											value: this.props.attributes.color1,
											onChange: function onChange(value) {
												return _this2.props.setAttributes({ color1: value ? value : '#fff' });
											}
										})
									)
								),
								wp.element.createElement(
									'div',
									{ className: 'inspector-field inspector-border-radius components-base-control' },
									wp.element.createElement(
										'label',
										null,
										'Range'
									),
									wp.element.createElement(RangeControl, {
										value: this.props.attributes.gradientRange1,
										min: 0,
										max: 100,
										step: 10,
										onChange: function onChange(value) {
											return _this2.props.setAttributes({ gradientRange1: value });
										}
									})
								),
								wp.element.createElement(
									'h3',
									null,
									__('Gradient Fill 2')
								),
								wp.element.createElement(
									'div',
									{ className: 'inspector-field inspector-field-color components-base-control gradientcolor' },
									wp.element.createElement(
										'label',
										{ className: 'inspector-mb-0' },
										'Color'
									),
									wp.element.createElement(
										'div',
										{ className: 'inspector-ml-auto' },
										wp.element.createElement(ColorPalette, {
											value: this.props.attributes.color2,
											onChange: function onChange(value) {
												return _this2.props.setAttributes({ color2: value ? value : '#fff' });
											}
										})
									)
								),
								wp.element.createElement(
									'div',
									{ className: 'inspector-field inspector-border-radius components-base-control' },
									wp.element.createElement(
										'label',
										null,
										'Range'
									),
									wp.element.createElement(RangeControl, {
										value: this.props.attributes.gradientRange2,
										min: 0,
										max: 100,
										step: 10,
										onChange: function onChange(value) {
											return _this2.props.setAttributes({ gradientRange2: value });
										}
									})
								),
								wp.element.createElement(
									'h3',
									null,
									__('Gradient Fill 3')
								),
								wp.element.createElement(
									'div',
									{ className: 'inspector-field inspector-field-color components-base-control gradientcolor' },
									wp.element.createElement(
										'label',
										{ className: 'inspector-mb-0' },
										'Color'
									),
									wp.element.createElement(
										'div',
										{ className: 'inspector-ml-auto' },
										wp.element.createElement(ColorPalette, {
											value: this.props.attributes.color3,
											onChange: function onChange(value) {
												return _this2.props.setAttributes({ color3: value ? value : '#fff' });
											}
										})
									)
								),
								wp.element.createElement(
									'div',
									{ className: 'inspector-field inspector-border-radius components-base-control' },
									wp.element.createElement(
										'label',
										null,
										'Range'
									),
									wp.element.createElement(RangeControl, {
										value: this.props.attributes.gradientRange3,
										min: 0,
										max: 100,
										step: 10,
										onChange: function onChange(value) {
											return _this2.props.setAttributes({ gradientRange3: value });
										}
									})
								)
							)
						)
					),
					wp.element.createElement(
						PanelBody,
						{ title: __('Border'), initialOpen: false, className: 'border-setting' },
						wp.element.createElement(
							PanelBody,
							{ title: __('All Border'), initialOpen: false, className: 'border-setting' },
							wp.element.createElement(
								PanelRow,
								null,
								wp.element.createElement(
									'div',
									{ className: 'inspector-field inspector-border-style' },
									wp.element.createElement(
										'label',
										null,
										'Border Style'
									),
									wp.element.createElement(
										'div',
										{ className: 'inspector-field-button-list inspector-field-button-list-fluid' },
										wp.element.createElement(
											'button',
											{ className: 'solid' === this.props.attributes.borderStyle ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
													return _this2.props.setAttributes({ borderStyle: 'solid' });
												} },
											wp.element.createElement('span', { className: 'inspector-field-border-type inspector-field-border-type-solid' })
										),
										wp.element.createElement(
											'button',
											{ className: 'dotted' === this.props.attributes.borderStyle ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
													return _this2.props.setAttributes({ borderStyle: 'dotted' });
												} },
											wp.element.createElement('span', { className: 'inspector-field-border-type inspector-field-border-type-dotted' })
										),
										wp.element.createElement(
											'button',
											{ className: 'dashed' === this.props.attributes.borderStyle ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
													return _this2.props.setAttributes({ borderStyle: 'dashed' });
												} },
											wp.element.createElement('span', { className: 'inspector-field-border-type inspector-field-border-type-dashed' })
										),
										wp.element.createElement(
											'button',
											{ className: 'none' === this.props.attributes.borderStyle ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
													return _this2.props.setAttributes({ borderStyle: 'none' });
												} },
											wp.element.createElement(
												'span',
												{ className: 'inspector-field-border-type inspector-field-border-type-none' },
												wp.element.createElement('i', { className: 'fa fa-ban' })
											)
										)
									)
								)
							),
							this.props.attributes.borderStyle && wp.element.createElement(
								Fragment,
								null,
								wp.element.createElement(
									PanelRow,
									null,
									wp.element.createElement(
										'div',
										{ className: 'inspector-field inspector-field-color ' },
										wp.element.createElement(
											'label',
											{ className: 'inspector-mb-0' },
											'Color'
										),
										wp.element.createElement(
											'div',
											{ className: 'inspector-ml-auto' },
											wp.element.createElement(ColorPalette, {
												value: this.props.attributes.borderColor,
												onChange: function onChange(borderColor) {
													return _this2.props.setAttributes({ borderColor: borderColor });
												}
											})
										)
									)
								),
								wp.element.createElement(
									PanelRow,
									null,
									wp.element.createElement(
										'div',
										{ className: 'inspector-field inspector-border-width' },
										wp.element.createElement(
											'label',
											null,
											'Border Width'
										),
										wp.element.createElement(RangeControl, {
											value: this.props.attributes.borderWidth ? this.props.attributes.borderWidth : 0,
											min: 0,
											max: 10,
											onChange: function onChange(value) {
												return _this2.props.setAttributes({ borderWidth: value });
											}
										})
									)
								),
								wp.element.createElement(
									PanelRow,
									null,
									wp.element.createElement(
										'div',
										{ className: 'inspector-field inspector-border-width' },
										wp.element.createElement(
											'label',
											null,
											'Border Radius'
										),
										wp.element.createElement(RangeControl, {
											value: this.props.attributes.borderRadius ? this.props.attributes.borderRadius : 0,
											min: 0,
											max: 100,
											onChange: function onChange(value) {
												return _this2.props.setAttributes({ borderRadius: value });
											}
										})
									)
								)
							)
						),
						!this.props.attributes.borderStyle && wp.element.createElement(
							PanelBody,
							{ title: __('Top Border'), initialOpen: false, className: 'border-setting' },
							wp.element.createElement(
								PanelRow,
								null,
								wp.element.createElement(
									'div',
									{ className: 'inspector-field inspector-border-style' },
									wp.element.createElement(
										'label',
										null,
										'Border Style'
									),
									wp.element.createElement(
										'div',
										{ className: 'inspector-field-button-list inspector-field-button-list-fluid' },
										wp.element.createElement(
											'button',
											{ className: 'solid' === this.props.attributes.topBorderStyle ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
													return _this2.props.setAttributes({ topBorderStyle: 'solid' });
												} },
											wp.element.createElement('span', { className: 'inspector-field-border-type inspector-field-border-type-solid' })
										),
										wp.element.createElement(
											'button',
											{ className: 'dotted' === this.props.attributes.topBorderStyle ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
													return _this2.props.setAttributes({ topBorderStyle: 'dotted' });
												} },
											wp.element.createElement('span', { className: 'inspector-field-border-type inspector-field-border-type-dotted' })
										),
										wp.element.createElement(
											'button',
											{ className: 'dashed' === this.props.attributes.topBorderStyle ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
													return _this2.props.setAttributes({ topBorderStyle: 'dashed' });
												} },
											wp.element.createElement('span', { className: 'inspector-field-border-type inspector-field-border-type-dashed' })
										),
										wp.element.createElement(
											'button',
											{ className: 'none' === this.props.attributes.topBorderStyle ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
													return _this2.props.setAttributes({ borderStyle: 'none' });
												} },
											wp.element.createElement(
												'span',
												{ className: 'inspector-field-border-type inspector-field-border-type-none' },
												wp.element.createElement('i', { className: 'fa fa-ban' })
											)
										)
									)
								)
							),
							this.props.attributes.topBorderStyle && wp.element.createElement(
								Fragment,
								null,
								wp.element.createElement(
									PanelRow,
									null,
									wp.element.createElement(
										'div',
										{ className: 'inspector-field inspector-field-color ' },
										wp.element.createElement(
											'label',
											{ className: 'inspector-mb-0' },
											'Color'
										),
										wp.element.createElement(
											'div',
											{ className: 'inspector-ml-auto' },
											wp.element.createElement(ColorPalette, {
												value: this.props.attributes.topBorderColor,
												onChange: function onChange(topBorderColor) {
													return _this2.props.setAttributes({ topBorderColor: topBorderColor });
												}
											})
										)
									)
								),
								wp.element.createElement(
									PanelRow,
									null,
									wp.element.createElement(
										'div',
										{ className: 'inspector-field inspector-border-width' },
										wp.element.createElement(
											'label',
											null,
											'Border Width'
										),
										wp.element.createElement(RangeControl, {
											value: this.props.attributes.topBorderWidth ? this.props.attributes.topBorderWidth : 0,
											min: 0,
											max: 10,
											onChange: function onChange(value) {
												return _this2.props.setAttributes({ topBorderWidth: value });
											}
										})
									)
								),
								wp.element.createElement(
									PanelRow,
									null,
									wp.element.createElement(
										'div',
										{ className: 'inspector-field inspector-border-width' },
										wp.element.createElement(
											'label',
											null,
											'Border Radius'
										),
										wp.element.createElement(RangeControl, {
											value: this.props.attributes.topBorderRadius ? this.props.attributes.topBorderRadius : 0,
											min: 0,
											max: 100,
											onChange: function onChange(value) {
												return _this2.props.setAttributes({ topBorderRadius: value });
											}
										})
									)
								)
							)
						),
						!this.props.attributes.borderStyle && wp.element.createElement(
							PanelBody,
							{ title: __('Right Border'), initialOpen: false, className: 'border-setting' },
							wp.element.createElement(
								PanelRow,
								null,
								wp.element.createElement(
									'div',
									{ className: 'inspector-field inspector-border-style' },
									wp.element.createElement(
										'label',
										null,
										'Border Style'
									),
									wp.element.createElement(
										'div',
										{ className: 'inspector-field-button-list inspector-field-button-list-fluid' },
										wp.element.createElement(
											'button',
											{ className: 'solid' === this.props.attributes.rightBorderStyle ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
													return _this2.props.setAttributes({ rightBorderStyle: 'solid' });
												} },
											wp.element.createElement('span', { className: 'inspector-field-border-type inspector-field-border-type-solid' })
										),
										wp.element.createElement(
											'button',
											{ className: 'dotted' === this.props.attributes.rightBorderStyle ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
													return _this2.props.setAttributes({ rightBorderStyle: 'dotted' });
												} },
											wp.element.createElement('span', { className: 'inspector-field-border-type inspector-field-border-type-dotted' })
										),
										wp.element.createElement(
											'button',
											{ className: 'dashed' === this.props.attributes.rightBorderStyle ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
													return _this2.props.setAttributes({ rightBorderStyle: 'dashed' });
												} },
											wp.element.createElement('span', { className: 'inspector-field-border-type inspector-field-border-type-dashed' })
										),
										wp.element.createElement(
											'button',
											{ className: 'none' === this.props.attributes.rightBorderStyle ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
													return _this2.props.setAttributes({ borderStyle: 'none' });
												} },
											wp.element.createElement(
												'span',
												{ className: 'inspector-field-border-type inspector-field-border-type-none' },
												wp.element.createElement('i', { className: 'fa fa-ban' })
											)
										)
									)
								)
							),
							this.props.attributes.rightBorderStyle && wp.element.createElement(
								Fragment,
								null,
								wp.element.createElement(
									PanelRow,
									null,
									wp.element.createElement(
										'div',
										{ className: 'inspector-field inspector-field-color ' },
										wp.element.createElement(
											'label',
											{ className: 'inspector-mb-0' },
											'Color'
										),
										wp.element.createElement(
											'div',
											{ className: 'inspector-ml-auto' },
											wp.element.createElement(ColorPalette, {
												value: this.props.attributes.rightBorderColor,
												onChange: function onChange(rightBorderColor) {
													return _this2.props.setAttributes({ rightBorderColor: rightBorderColor });
												}
											})
										)
									)
								),
								wp.element.createElement(
									PanelRow,
									null,
									wp.element.createElement(
										'div',
										{ className: 'inspector-field inspector-border-width' },
										wp.element.createElement(
											'label',
											null,
											'Border Width'
										),
										wp.element.createElement(RangeControl, {
											value: this.props.attributes.rightBorderWidth ? this.props.attributes.rightBorderWidth : 0,
											min: 0,
											max: 10,
											onChange: function onChange(value) {
												return _this2.props.setAttributes({ rightBorderWidth: value });
											}
										})
									)
								),
								wp.element.createElement(
									PanelRow,
									null,
									wp.element.createElement(
										'div',
										{ className: 'inspector-field inspector-border-width' },
										wp.element.createElement(
											'label',
											null,
											'Border Radius'
										),
										wp.element.createElement(RangeControl, {
											value: this.props.attributes.rightBorderRadius ? this.props.attributes.rightBorderRadius : 0,
											min: 0,
											max: 100,
											onChange: function onChange(value) {
												return _this2.props.setAttributes({ rightBorderRadius: value });
											}
										})
									)
								)
							)
						),
						!this.props.attributes.borderStyle && wp.element.createElement(
							PanelBody,
							{ title: __('Bottom Border'), initialOpen: false, className: 'border-setting' },
							wp.element.createElement(
								PanelRow,
								null,
								wp.element.createElement(
									'div',
									{ className: 'inspector-field inspector-border-style' },
									wp.element.createElement(
										'label',
										null,
										'Border Style'
									),
									wp.element.createElement(
										'div',
										{ className: 'inspector-field-button-list inspector-field-button-list-fluid' },
										wp.element.createElement(
											'button',
											{ className: 'solid' === this.props.attributes.bottomBorderStyle ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
													return _this2.props.setAttributes({ bottomBorderStyle: 'solid' });
												} },
											wp.element.createElement('span', { className: 'inspector-field-border-type inspector-field-border-type-solid' })
										),
										wp.element.createElement(
											'button',
											{ className: 'dotted' === this.props.attributes.bottomBorderStyle ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
													return _this2.props.setAttributes({ bottomBorderStyle: 'dotted' });
												} },
											wp.element.createElement('span', { className: 'inspector-field-border-type inspector-field-border-type-dotted' })
										),
										wp.element.createElement(
											'button',
											{ className: 'dashed' === this.props.attributes.bottomBorderStyle ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
													return _this2.props.setAttributes({ bottomBorderStyle: 'dashed' });
												} },
											wp.element.createElement('span', { className: 'inspector-field-border-type inspector-field-border-type-dashed' })
										),
										wp.element.createElement(
											'button',
											{ className: 'none' === this.props.attributes.bottomBorderStyle ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
													return _this2.props.setAttributes({ borderStyle: 'none' });
												} },
											wp.element.createElement(
												'span',
												{ className: 'inspector-field-border-type inspector-field-border-type-none' },
												wp.element.createElement('i', { className: 'fa fa-ban' })
											)
										)
									)
								)
							),
							this.props.attributes.bottomBorderStyle && wp.element.createElement(
								Fragment,
								null,
								wp.element.createElement(
									PanelRow,
									null,
									wp.element.createElement(
										'div',
										{ className: 'inspector-field inspector-field-color ' },
										wp.element.createElement(
											'label',
											{ className: 'inspector-mb-0' },
											'Color'
										),
										wp.element.createElement(
											'div',
											{ className: 'inspector-ml-auto' },
											wp.element.createElement(ColorPalette, {
												value: this.props.attributes.bottomBorderColor,
												onChange: function onChange(bottomBorderColor) {
													return _this2.props.setAttributes({ bottomBorderColor: bottomBorderColor });
												}
											})
										)
									)
								),
								wp.element.createElement(
									PanelRow,
									null,
									wp.element.createElement(
										'div',
										{ className: 'inspector-field inspector-border-width' },
										wp.element.createElement(
											'label',
											null,
											'Border Width'
										),
										wp.element.createElement(RangeControl, {
											value: this.props.attributes.bottomBorderWidth ? this.props.attributes.bottomBorderWidth : 0,
											min: 0,
											max: 10,
											onChange: function onChange(value) {
												return _this2.props.setAttributes({ bottomBorderWidth: value });
											}
										})
									)
								),
								wp.element.createElement(
									PanelRow,
									null,
									wp.element.createElement(
										'div',
										{ className: 'inspector-field inspector-border-width' },
										wp.element.createElement(
											'label',
											null,
											'Border Radius'
										),
										wp.element.createElement(RangeControl, {
											value: this.props.attributes.bottomBorderRadius ? this.props.attributes.bottomBorderRadius : 0,
											min: 0,
											max: 100,
											onChange: function onChange(value) {
												return _this2.props.setAttributes({ bottomBorderRadius: value });
											}
										})
									)
								)
							)
						),
						!this.props.attributes.borderStyle && wp.element.createElement(
							PanelBody,
							{ title: __('Left Border'), initialOpen: false, className: 'border-setting' },
							wp.element.createElement(
								PanelRow,
								null,
								wp.element.createElement(
									'div',
									{ className: 'inspector-field inspector-border-style' },
									wp.element.createElement(
										'label',
										null,
										'Border Style'
									),
									wp.element.createElement(
										'div',
										{ className: 'inspector-field-button-list inspector-field-button-list-fluid' },
										wp.element.createElement(
											'button',
											{ className: 'solid' === this.props.attributes.leftBorderStyle ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
													return _this2.props.setAttributes({ leftBorderStyle: 'solid' });
												} },
											wp.element.createElement('span', { className: 'inspector-field-border-type inspector-field-border-type-solid' })
										),
										wp.element.createElement(
											'button',
											{ className: 'dotted' === this.props.attributes.leftBorderStyle ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
													return _this2.props.setAttributes({ leftBorderStyle: 'dotted' });
												} },
											wp.element.createElement('span', { className: 'inspector-field-border-type inspector-field-border-type-dotted' })
										),
										wp.element.createElement(
											'button',
											{ className: 'dashed' === this.props.attributes.leftBorderStyle ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
													return _this2.props.setAttributes({ leftBorderStyle: 'dashed' });
												} },
											wp.element.createElement('span', { className: 'inspector-field-border-type inspector-field-border-type-dashed' })
										),
										wp.element.createElement(
											'button',
											{ className: 'none' === this.props.attributes.leftBorderStyle ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
													return _this2.props.setAttributes({ borderStyle: 'none' });
												} },
											wp.element.createElement(
												'span',
												{ className: 'inspector-field-border-type inspector-field-border-type-none' },
												wp.element.createElement('i', { className: 'fa fa-ban' })
											)
										)
									)
								)
							),
							this.props.attributes.leftBorderStyle && wp.element.createElement(
								Fragment,
								null,
								wp.element.createElement(
									PanelRow,
									null,
									wp.element.createElement(
										'div',
										{ className: 'inspector-field inspector-field-color ' },
										wp.element.createElement(
											'label',
											{ className: 'inspector-mb-0' },
											'Color'
										),
										wp.element.createElement(
											'div',
											{ className: 'inspector-ml-auto' },
											wp.element.createElement(ColorPalette, {
												value: this.props.attributes.leftBorderColor,
												onChange: function onChange(leftBorderColor) {
													return _this2.props.setAttributes({ leftBorderColor: leftBorderColor });
												}
											})
										)
									)
								),
								wp.element.createElement(
									PanelRow,
									null,
									wp.element.createElement(
										'div',
										{ className: 'inspector-field inspector-border-width' },
										wp.element.createElement(
											'label',
											null,
											'Border Width'
										),
										wp.element.createElement(RangeControl, {
											value: this.props.attributes.leftBorderWidth ? this.props.attributes.leftBorderWidth : 0,
											min: 1,
											max: 10,
											onChange: function onChange(value) {
												return _this2.props.setAttributes({ leftBorderWidth: value });
											}
										})
									)
								),
								wp.element.createElement(
									PanelRow,
									null,
									wp.element.createElement(
										'div',
										{ className: 'inspector-field inspector-border-width' },
										wp.element.createElement(
											'label',
											null,
											'Border Radius'
										),
										wp.element.createElement(RangeControl, {
											value: this.props.attributes.leftBorderRadius ? this.props.attributes.leftBorderRadius : 0,
											min: 0,
											max: 100,
											onChange: function onChange(value) {
												return _this2.props.setAttributes({ leftBorderRadius: value });
											}
										})
									)
								)
							)
						)
					),
					wp.element.createElement(
						PanelBody,
						{ title: __('Dimensions'), initialOpen: false },
						wp.element.createElement(
							PanelRow,
							null,
							wp.element.createElement(
								'div',
								{ className: 'inspector-field alignment-settings' },
								wp.element.createElement(
									'div',
									{ className: 'alignment-wrapper' },
									wp.element.createElement(TextControl, {
										label: 'Width',
										type: 'number',
										placeHolder: 'Width (%)',
										value: this.props.attributes.width,
										min: '1',
										max: '100',
										step: '1',
										onChange: function onChange(value) {
											return _this2.props.setAttributes({ width: value });
										}
									})
								),
								wp.element.createElement(
									'div',
									{ className: 'alignment-wrapper' },
									wp.element.createElement(TextControl, {
										label: 'Height',
										type: 'number',
										min: '1',
										placeHolder: 'Height (px)',
										value: this.props.attributes.height,
										onChange: function onChange(value) {
											return _this2.props.setAttributes({ height: value });
										}
									})
								)
							)
						),
						wp.element.createElement(
							PanelRow,
							null,
							wp.element.createElement(
								'div',
								{ className: 'inspector-field inspector-field-alignment' },
								wp.element.createElement(
									'label',
									{ className: 'inspector-mb-0' },
									'Alignment'
								),
								wp.element.createElement(
									'div',
									{ className: 'inspector-field-button-list inspector-field-button-list-fluid' },
									wp.element.createElement(
										'button',
										{ className: 'left' === this.props.attributes.textAlign ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
												return _this2.props.setAttributes({ textAlign: 'left' });
											} },
										wp.element.createElement('i', { className: 'fa fa-align-left' })
									),
									wp.element.createElement(
										'button',
										{ className: 'center' === this.props.attributes.textAlign ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
												return _this2.props.setAttributes({ textAlign: 'center' });
											} },
										wp.element.createElement('i', { className: 'fa fa-align-center' })
									),
									wp.element.createElement(
										'button',
										{ className: 'right' === this.props.attributes.textAlign ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
												return _this2.props.setAttributes({ textAlign: 'right' });
											} },
										wp.element.createElement('i', { className: 'fa fa-align-right' })
									)
								)
							)
						),
						wp.element.createElement(
							PanelRow,
							null,
							wp.element.createElement(
								'div',
								{ className: 'inspector-field-alignment inspector-field inspector-responsive inspector-bottom-20' },
								wp.element.createElement(
									'label',
									null,
									'Vertical  Alignment'
								),
								wp.element.createElement(
									'div',
									{ className: 'inspector-field-button-list inspector-field-button-list-fluid' },
									wp.element.createElement(
										'button',
										{ className: 'flex-start' === this.props.attributes.vAlign ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
												return _this2.props.setAttributes({ vAlign: 'flex-start' });
											} },
										wp.element.createElement(
											'svg',
											{ width: '16', height: '16', viewBox: '0 0 16 16' },
											wp.element.createElement(
												'g',
												{ transform: 'translate(1)', fill: 'none' },
												wp.element.createElement('rect', { className: 'inspector-svg-fill', x: '4', y: '4', width: '6', height: '12', rx: '1' }),
												wp.element.createElement('path', { className: 'inspector-svg-stroke', d: 'M0 1h14', 'stroke-width': '2', 'stroke-linecap': 'square' })
											)
										)
									),
									wp.element.createElement(
										'button',
										{ className: 'center' === this.props.attributes.vAlign ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
												return _this2.props.setAttributes({ vAlign: 'center' });
											} },
										wp.element.createElement(
											'svg',
											{ width: '16', height: '18', viewBox: '0 0 16 18' },
											wp.element.createElement(
												'g',
												{ transform: 'translate(-115 -4) translate(115 4)', fill: 'none' },
												wp.element.createElement('path', { d: 'M8 .708v15.851', className: 'inspector-svg-stroke', 'stroke-linecap': 'square' }),
												wp.element.createElement('rect', { className: 'inspector-svg-fill', y: '5', width: '16', height: '7', rx: '1' })
											)
										)
									),
									wp.element.createElement(
										'button',
										{ className: 'flex-end' === this.props.attributes.vAlign ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
												return _this2.props.setAttributes({ vAlign: 'flex-end' });
											} },
										wp.element.createElement(
											'svg',
											{ width: '16', height: '16', viewBox: '0 0 16 16' },
											wp.element.createElement(
												'g',
												{ transform: 'translate(1)', fill: 'none' },
												wp.element.createElement('rect', { className: 'inspector-svg-fill', x: '4', width: '6', height: '12', rx: '1' }),
												wp.element.createElement('path', { d: 'M0 15h14', className: 'inspector-svg-stroke', 'stroke-width': '2', 'stroke-linecap': 'square' })
											)
										)
									)
								)
							)
						),
						wp.element.createElement(
							PanelRow,
							null,
							wp.element.createElement(
								'div',
								{ className: 'inspector-field-alignment inspector-field inspector-responsive' },
								wp.element.createElement(
									'label',
									null,
									'Horizontal Alignment'
								),
								wp.element.createElement(
									'div',
									{ className: 'inspector-field-button-list inspector-field-button-list-fluid' },
									wp.element.createElement(
										'button',
										{ className: 'flex-start' === this.props.attributes.hAlign ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
												return _this2.props.setAttributes({ hAlign: 'flex-start' });
											} },
										wp.element.createElement(
											'svg',
											{ width: '21', height: '18', viewBox: '0 0 21 18' },
											wp.element.createElement(
												'g',
												{ transform: 'translate(-29 -4) translate(29 4)', fill: 'none' },
												wp.element.createElement('path', { d: 'M1 .708v15.851', className: 'inspector-svg-stroke', 'stroke-linecap': 'square' }),
												wp.element.createElement('rect', { className: 'inspector-svg-fill', x: '5', y: '5', width: '16', height: '7', rx: '1' })
											)
										)
									),
									wp.element.createElement(
										'button',
										{ className: 'center' === this.props.attributes.hAlign ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
												return _this2.props.setAttributes({ hAlign: 'center' });
											} },
										wp.element.createElement(
											'svg',
											{ width: '16', height: '18', viewBox: '0 0 16 18' },
											wp.element.createElement(
												'g',
												{ transform: 'translate(-115 -4) translate(115 4)', fill: 'none' },
												wp.element.createElement('path', { d: 'M8 .708v15.851', className: 'inspector-svg-stroke', 'stroke-linecap': 'square' }),
												wp.element.createElement('rect', { className: 'inspector-svg-fill', y: '5', width: '16', height: '7', rx: '1' })
											)
										)
									),
									wp.element.createElement(
										'button',
										{ className: 'flex-end' === this.props.attributes.hAlign ? 'active inspector-button' : ' inspector-button', onClick: function onClick() {
												return _this2.props.setAttributes({ hAlign: 'flex-end' });
											} },
										wp.element.createElement(
											'svg',
											{ width: '21', height: '18', viewBox: '0 0 21 18' },
											wp.element.createElement(
												'g',
												{ transform: 'translate(0 1) rotate(-180 10.5 8.5)', fill: 'none' },
												wp.element.createElement('path', { d: 'M1 .708v15.851', className: 'inspector-svg-stroke', 'stroke-linecap': 'square' }),
												wp.element.createElement('rect', { className: 'inspector-svg-fill', 'fill-rule': 'nonzero', x: '5', y: '5', width: '16', height: '7', rx: '1' })
											)
										)
									)
								)
							)
						)
					),
					wp.element.createElement(
						PanelBody,
						{ title: 'Spacing', initialOpen: false },
						wp.element.createElement(
							PanelRow,
							null,
							wp.element.createElement(
								'div',
								{ className: 'inspector-field inspector-field-padding' },
								wp.element.createElement(
									'label',
									{ className: 'mt10' },
									'Padding'
								),
								wp.element.createElement(
									'div',
									{ className: 'padding-setting' },
									wp.element.createElement(
										'div',
										{ className: 'col-main-4' },
										wp.element.createElement(
											'div',
											{ className: 'padd-top col-main-inner', 'data-tooltip': 'padding Top' },
											wp.element.createElement(TextControl, {
												type: 'number',
												min: '1',
												value: this.props.attributes.paddingTop,
												onChange: function onChange(value) {
													return _this2.props.setAttributes({ paddingTop: value });
												}
											}),
											wp.element.createElement(
												'label',
												null,
												'Top'
											)
										),
										wp.element.createElement(
											'div',
											{ className: 'padd-buttom col-main-inner', 'data-tooltip': 'padding Bottom' },
											wp.element.createElement(TextControl, {
												type: 'number',
												min: '1',
												value: this.props.attributes.paddingBottom,
												onChange: function onChange(value) {
													return _this2.props.setAttributes({ paddingBottom: value });
												}
											}),
											wp.element.createElement(
												'label',
												null,
												'Bottom'
											)
										),
										wp.element.createElement(
											'div',
											{ className: 'padd-left col-main-inner', 'data-tooltip': 'padding Left' },
											wp.element.createElement(TextControl, {
												type: 'number',
												min: '1',
												value: this.props.attributes.paddingLeft,
												onChange: function onChange(value) {
													return _this2.props.setAttributes({ paddingLeft: value });
												}
											}),
											wp.element.createElement(
												'label',
												null,
												'Left'
											)
										),
										wp.element.createElement(
											'div',
											{ className: 'padd-right col-main-inner', 'data-tooltip': 'padding Right' },
											wp.element.createElement(TextControl, {
												type: 'number',
												min: '1',
												value: this.props.attributes.paddingRight,
												onChange: function onChange(value) {
													return _this2.props.setAttributes({ paddingRight: value });
												}
											}),
											wp.element.createElement(
												'label',
												null,
												'Right'
											)
										)
									)
								)
							)
						),
						wp.element.createElement(
							PanelRow,
							null,
							wp.element.createElement(
								'div',
								{ className: 'inspector-field inspector-field-margin' },
								wp.element.createElement(
									'label',
									{ className: 'mt10' },
									'Margin'
								),
								wp.element.createElement(
									'div',
									{ className: 'margin-setting' },
									wp.element.createElement(
										'div',
										{ className: 'col-main-4' },
										wp.element.createElement(
											'div',
											{ className: 'padd-top col-main-inner', 'data-tooltip': 'margin Top' },
											wp.element.createElement(TextControl, {
												type: 'number',
												min: '1',
												value: this.props.attributes.marginTop,
												onChange: function onChange(value) {
													return _this2.props.setAttributes({ marginTop: value });
												}
											}),
											wp.element.createElement(
												'label',
												null,
												'Top'
											)
										),
										wp.element.createElement(
											'div',
											{ className: 'padd-buttom col-main-inner', 'data-tooltip': 'margin Bottom' },
											wp.element.createElement(TextControl, {
												type: 'number',
												min: '1',
												value: this.props.attributes.marginBottom,
												onChange: function onChange(value) {
													return _this2.props.setAttributes({ marginBottom: value });
												}
											}),
											wp.element.createElement(
												'label',
												null,
												'Bottom'
											)
										),
										wp.element.createElement(
											'div',
											{ className: 'padd-left col-main-inner', 'data-tooltip': 'margin Left' },
											wp.element.createElement(TextControl, {
												type: 'number',
												min: '1',
												value: this.props.attributes.marginLeft,
												onChange: function onChange(value) {
													return _this2.props.setAttributes({ marginLeft: value });
												}
											}),
											wp.element.createElement(
												'label',
												null,
												'Left'
											)
										),
										wp.element.createElement(
											'div',
											{ className: 'padd-right col-main-inner', 'data-tooltip': 'margin Right' },
											wp.element.createElement(TextControl, {
												type: 'number',
												min: '1',
												value: this.props.attributes.marginRight,
												onChange: function onChange(value) {
													return _this2.props.setAttributes({ marginRight: value });
												}
											}),
											wp.element.createElement(
												'label',
												null,
												'Right'
											)
										)
									)
								)
							)
						)
					)
				)
			);
		}
	}]);

	return Inspector;
}(Component);

/* harmony default export */ __webpack_exports__["a"] = (Inspector);

/***/ }),
/* 167 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_lodash_pick__ = __webpack_require__(17);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_lodash_pick___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_lodash_pick__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__icons__ = __webpack_require__(3);
var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _toConsumableArray(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } else { return Array.from(arr); } }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }




(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    var __ = wpI18n.__;
    var Component = wpElement.Component,
        Fragment = wpElement.Fragment;
    var registerBlockType = wpBlocks.registerBlockType;
    var InspectorControls = wpEditor.InspectorControls,
        MediaUpload = wpEditor.MediaUpload;
    var PanelBody = wpComponents.PanelBody,
        RangeControl = wpComponents.RangeControl,
        ToggleControl = wpComponents.ToggleControl,
        SelectControl = wpComponents.SelectControl,
        TextControl = wpComponents.TextControl,
        TextareaControl = wpComponents.TextareaControl,
        IconButton = wpComponents.IconButton,
        Button = wpComponents.Button,
        Placeholder = wpComponents.Placeholder,
        Tooltip = wpComponents.Tooltip,
        PanelRow = wpComponents.PanelRow,
        ColorPalette = wpComponents.ColorPalette;


    var mediaSliderBlockIcon = wp.element.createElement(
        'svg',
        { xmlns: 'http://www.w3.org/2000/svg', width: '20', height: '20', viewBox: '2 2 22 22', className: 'dashicon' },
        wp.element.createElement('path', { fill: 'none', d: 'M0 0h24v24H0V0z' }),
        wp.element.createElement('path', { d: 'M20 4h-3.17L15 2H9L7.17 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zM9.88 4h4.24l1.83 2H20v12H4V6h4.05' }),
        wp.element.createElement('path', { d: 'M15 11H9V8.5L5.5 12 9 15.5V13h6v2.5l3.5-3.5L15 8.5z' })
    );

    var sliderBlockIcon = wp.element.createElement(
        'svg',
        { width: '150px', height: '150px', viewBox: '222.64 222.641 150 150', 'enable-background': 'new 222.64 222.641 150 150' },
        wp.element.createElement(
            'g',
            null,
            wp.element.createElement(
                'g',
                null,
                wp.element.createElement(
                    'g',
                    null,
                    wp.element.createElement('path', { fill: '#0F6CB6', d: 'M366.284,244.251H228.996c-1.405,0-2.542,1.137-2.542,2.542v17.797v50.848v33.051\r c0,1.405,1.137,2.542,2.542,2.542h137.288c1.405,0,2.543-1.137,2.543-2.542v-33.051v-50.848v-17.797\r C368.827,245.388,367.689,244.251,366.284,244.251z M231.538,267.132h22.882v45.763h-22.882V267.132z M363.743,312.896h-7.629\r v-45.763h7.629V312.896z M363.743,262.047h-10.171c-1.405,0-2.542,1.137-2.542,2.543v50.847c0,1.406,1.137,2.543,2.542,2.543\r h10.171v27.967H231.538v-0.001v-27.967h25.424c1.405,0,2.542-1.137,2.542-2.542v-50.848c0-1.405-1.137-2.543-2.542-2.543h-25.424\r v-12.711h132.205V262.047z' }),
                    wp.element.createElement('circle', { fill: '#0F6CB6', cx: '300.183', cy: '333.234', r: '5.085' }),
                    wp.element.createElement('path', { fill: '#0F6CB6', d: 'M269.674,317.98h71.187c1.405,0,2.543-1.138,2.543-2.543v-50.848c0-1.405-1.138-2.542-2.542-2.542\r h-71.188c-1.406,0-2.543,1.137-2.543,2.543v50.847C267.131,316.843,268.268,317.98,269.674,317.98z M272.216,267.132h66.102\r v45.763h-66.102V267.132z' }),
                    wp.element.createElement('rect', { x: '269.674', y: '330.691', fill: '#0F6CB6', width: '7.627', height: '5.085' }),
                    wp.element.createElement('rect', { x: '282.386', y: '330.691', fill: '#0F6CB6', width: '7.627', height: '5.085' }),
                    wp.element.createElement('rect', { x: '310.352', y: '330.691', fill: '#0F6CB6', width: '7.628', height: '5.085' }),
                    wp.element.createElement('rect', { x: '323.064', y: '330.691', fill: '#0F6CB6', width: '7.627', height: '5.085' })
                )
            )
        )
    );

    var nabInsertMedaitoSlide = function nabInsertMedaitoSlide(sourceURL, attributes) {
        var fixedWidth = attributes.fixedWidth,
            fixedHeight = attributes.fixedHeight;

        if (nabIsImage(sourceURL)) {
            return wp.element.createElement('img', {
                src: '' + sourceURL + (fixedHeight || fixedWidth ? '?' : '') + (fixedHeight ? 'h=' + fixedHeight + '&' : '') + (fixedWidth ? 'w=' + fixedWidth : ''),
                className: 'media-slider-img',
                alt: __('Slider image')
            });
        } else {
            return wp.element.createElement('video', { src: sourceURL,
                className: 'media-slider-vid',
                controls: true
            });
        }
    };

    var nabIsImage = function nabIsImage(sourceURL) {
        var imageExtension = ['jpg', 'jpeg', 'png', 'gif', 'PNG', 'JPG', 'JPEG', 'GIF'];
        var fileExtension = sourceURL.split('.').pop();
        if (-1 < imageExtension.indexOf(fileExtension)) {
            return true;
        } else {
            return false;
        }
    };

    var featuredBoxesComp = function (_Component) {
        _inherits(featuredBoxesComp, _Component);

        function featuredBoxesComp() {
            _classCallCheck(this, featuredBoxesComp);

            var _this = _possibleConstructorReturn(this, (featuredBoxesComp.__proto__ || Object.getPrototypeOf(featuredBoxesComp)).apply(this, arguments));

            _this.state = {
                currentSelected: 0,
                inited: false,
                bxSliderObj: {}
            };

            _this.initSlider = _this.initSlider.bind(_this);
            _this.reloadSlider = _this.reloadSlider.bind(_this);
            return _this;
        }

        _createClass(featuredBoxesComp, [{
            key: 'componentDidMount',
            value: function componentDidMount() {
                var attributes = this.props.attributes;

                if (attributes.media.length && attributes.sliderActive) {
                    this.initSlider();
                }
            }
        }, {
            key: 'componentDidUpdate',
            value: function componentDidUpdate(prevProps) {
                var _this2 = this;

                var attributes = this.props.attributes;
                var media = attributes.media,
                    autoplay = attributes.autoplay,
                    speed = attributes.speed,
                    infiniteLoop = attributes.infiniteLoop,
                    pager = attributes.pager,
                    controls = attributes.controls,
                    minSlides = attributes.minSlides,
                    slideWidth = attributes.slideWidth,
                    slideMargin = attributes.slideMargin,
                    sliderActive = attributes.sliderActive;
                var prevMedia = prevProps.attributes.media;

                if (media.length !== prevMedia.length && sliderActive) {
                    if (0 === prevMedia.length) {
                        setTimeout(function () {
                            return _this2.initSlider();
                        }, 10);
                    } else {
                        this.state.bxSliderObj.reloadSlider();
                    }
                }
                if (sliderActive !== prevProps.attributes.sliderActive) {
                    if (0 < this.state.bxSliderObj.length && !sliderActive) {
                        this.state.bxSliderObj.destroySlider();
                        this.setState({ bxSliderObj: {} });
                    } else {
                        this.initSlider();
                    }
                }
                if (minSlides !== prevProps.attributes.minSlides && sliderActive) {
                    this.reloadSlider();
                }
                if (slideWidth !== prevProps.attributes.slideWidth && sliderActive) {
                    this.reloadSlider();
                }
                if (slideMargin !== prevProps.attributes.slideMargin && sliderActive) {
                    this.reloadSlider();
                }
                if (autoplay !== prevProps.attributes.autoplay && sliderActive) {
                    this.reloadSlider();
                }
                if (speed !== prevProps.attributes.speed && sliderActive) {
                    this.reloadSlider();
                }
                if (infiniteLoop !== prevProps.attributes.infiniteLoop && sliderActive) {
                    this.reloadSlider();
                }
                if (pager !== prevProps.attributes.pager && sliderActive) {
                    this.reloadSlider();
                }
                if (controls !== prevProps.attributes.controls && sliderActive) {
                    this.reloadSlider();
                }
            }
        }, {
            key: 'initSlider',
            value: function initSlider() {
                if (this.props.attributes.sliderActive) {
                    var clientId = this.props.clientId;
                    var _props$attributes = this.props.attributes,
                        autoplay = _props$attributes.autoplay,
                        speed = _props$attributes.speed,
                        infiniteLoop = _props$attributes.infiniteLoop,
                        pager = _props$attributes.pager,
                        controls = _props$attributes.controls,
                        minSlides = _props$attributes.minSlides,
                        slideWidth = _props$attributes.slideWidth,
                        slideMargin = _props$attributes.slideMargin;

                    var sliderObj = jQuery('#block-' + clientId + ' .nab-media-slider').bxSlider({
                        minSlides: minSlides, maxSlides: minSlides, slideMargin: slideMargin, slideWidth: slideWidth, auto: autoplay, speed: speed, controls: controls, infiniteLoop: infiniteLoop, pager: pager, stopAutoOnClick: true, autoHover: true, touchEnabled: false,
                        onSlideAfter: function ($slideElement, oldIndex, newIndex) {
                            this.setState({ currentSelected: newIndex });
                        }.bind(this)
                    });
                    this.setState({ bxSliderObj: sliderObj });
                }
            }
        }, {
            key: 'reloadSlider',
            value: function reloadSlider(e) {
                if (this.props.attributes.sliderActive) {
                    var _props$attributes2 = this.props.attributes,
                        autoplay = _props$attributes2.autoplay,
                        speed = _props$attributes2.speed,
                        infiniteLoop = _props$attributes2.infiniteLoop,
                        pager = _props$attributes2.pager,
                        controls = _props$attributes2.controls,
                        minSlides = _props$attributes2.minSlides,
                        slideWidth = _props$attributes2.slideWidth,
                        slideMargin = _props$attributes2.slideMargin;

                    this.state.bxSliderObj.reloadSlider({ minSlides: minSlides, maxSlides: minSlides, slideMargin: slideMargin, slideWidth: slideWidth, auto: autoplay, speed: speed, infiniteLoop: infiniteLoop, pager: pager, controls: controls, stopAutoOnClick: true, autoHover: true, touchEnabled: false });
                }
            }
        }, {
            key: 'moveMedia',
            value: function moveMedia(currentIndex, newIndex) {
                var _props = this.props,
                    setAttributes = _props.setAttributes,
                    attributes = _props.attributes;
                var media = attributes.media;


                var currentMedia = media[currentIndex];
                setAttributes({
                    media: [].concat(_toConsumableArray(media.filter(function (img, idx) {
                        return idx !== currentIndex;
                    }).slice(0, newIndex)), [currentMedia], _toConsumableArray(media.filter(function (img, idx) {
                        return idx !== currentIndex;
                    }).slice(newIndex)))
                });
            }
        }, {
            key: 'updateMediaData',
            value: function updateMediaData(data) {
                var currentSelected = this.state.currentSelected;

                if ('number' !== typeof currentSelected) {
                    return null;
                }

                var _props2 = this.props,
                    attributes = _props2.attributes,
                    setAttributes = _props2.setAttributes;
                var media = attributes.media;


                var newMedia = media.map(function (media, index) {
                    if (index === currentSelected) {
                        media = Object.assign({}, media, data);
                    }

                    return media;
                });

                setAttributes({ media: newMedia });
            }
        }, {
            key: 'render',
            value: function render() {
                var _this3 = this;

                var _props3 = this.props,
                    attributes = _props3.attributes,
                    setAttributes = _props3.setAttributes,
                    isSelected = _props3.isSelected;
                var currentSelected = this.state.currentSelected;
                var media = attributes.media,
                    autoplay = attributes.autoplay,
                    speed = attributes.speed,
                    infiniteLoop = attributes.infiniteLoop,
                    pager = attributes.pager,
                    controls = attributes.controls,
                    detailAnimation = attributes.detailAnimation,
                    arrowIcons = attributes.arrowIcons,
                    minSlides = attributes.minSlides,
                    slideWidth = attributes.slideWidth,
                    slideMargin = attributes.slideMargin,
                    sliderActive = attributes.sliderActive,
                    fixedWidth = attributes.fixedWidth,
                    fixedHeight = attributes.fixedHeight;


                var arrowNames = [{ name: __WEBPACK_IMPORTED_MODULE_1__icons__["l" /* sliderArrow1 */], classnames: 'slider-arrow-1' }, { name: __WEBPACK_IMPORTED_MODULE_1__icons__["m" /* sliderArrow2 */], classnames: 'slider-arrow-2' }, { name: __WEBPACK_IMPORTED_MODULE_1__icons__["n" /* sliderArrow3 */], classnames: 'slider-arrow-3' }, { name: __WEBPACK_IMPORTED_MODULE_1__icons__["o" /* sliderArrow4 */], classnames: 'slider-arrow-4' }, { name: __WEBPACK_IMPORTED_MODULE_1__icons__["p" /* sliderArrow5 */], classnames: 'slider-arrow-5' }, { name: __WEBPACK_IMPORTED_MODULE_1__icons__["q" /* sliderArrow6 */], classnames: 'slider-arrow-6' }, { name: __WEBPACK_IMPORTED_MODULE_1__icons__["r" /* sliderArrow7 */], classnames: 'slider-arrow-7' }, { name: __WEBPACK_IMPORTED_MODULE_1__icons__["s" /* sliderArrow8 */], classnames: 'slider-arrow-8' }];

                if (0 === media.length) {
                    return wp.element.createElement(
                        Placeholder,
                        {
                            icon: mediaSliderBlockIcon,
                            label: __('featured-boxes Block'),
                            instructions: __('No media selected. Adding media to start using this block.')
                        },
                        wp.element.createElement(MediaUpload, {
                            value: null,
                            multiple: true,
                            onSelect: function onSelect(item) {
                                var mediaInsert = item.map(function (source) {
                                    return {
                                        url: source.url,
                                        id: source.id,
                                        advertisement: false,
                                        eventCategory: '',
                                        eventAction: '',
                                        eventLabel: '',
                                        target: false
                                    };
                                });

                                setAttributes({
                                    media: [].concat(_toConsumableArray(media), _toConsumableArray(mediaInsert))
                                });
                            },
                            render: function render(_ref) {
                                var open = _ref.open;
                                return wp.element.createElement(
                                    Button,
                                    { className: 'button button-large button-primary', onClick: open },
                                    __('Add media')
                                );
                            }
                        })
                    );
                }
                return wp.element.createElement(
                    Fragment,
                    null,
                    wp.element.createElement(
                        InspectorControls,
                        null,
                        wp.element.createElement(
                            PanelBody,
                            { title: __('Slider Settings'), initialOpen: false },
                            wp.element.createElement(ToggleControl, {
                                label: __('Slider Active'),
                                checked: sliderActive,
                                onChange: function onChange() {
                                    setAttributes({ sliderActive: !sliderActive });
                                }
                            }),
                            wp.element.createElement(ToggleControl, {
                                label: __('Pager'),
                                checked: pager,
                                onChange: function onChange() {
                                    setAttributes({ pager: !pager });
                                }
                            }),
                            wp.element.createElement(ToggleControl, {
                                label: __('Controls'),
                                checked: controls,
                                onChange: function onChange() {
                                    return setAttributes({ controls: !controls });
                                }
                            }),
                            wp.element.createElement(ToggleControl, {
                                label: __('Autoplay'),
                                checked: autoplay,
                                onChange: function onChange() {
                                    return setAttributes({ autoplay: !autoplay });
                                }
                            }),
                            wp.element.createElement(ToggleControl, {
                                label: __('Infinite Loop'),
                                checked: infiniteLoop,
                                onChange: function onChange() {
                                    return setAttributes({ infiniteLoop: !infiniteLoop });
                                }
                            }),
                            wp.element.createElement(
                                'div',
                                { className: 'inspector-field inspector-slider-speed' },
                                wp.element.createElement(
                                    'label',
                                    null,
                                    'Speed'
                                ),
                                wp.element.createElement(RangeControl, {
                                    value: speed,
                                    min: 100,
                                    max: 2000,
                                    onChange: function onChange(speed) {
                                        return setAttributes({ speed: speed });
                                    }
                                })
                            ),
                            wp.element.createElement(
                                'div',
                                { className: 'inspector-field inspector-slider-speed' },
                                wp.element.createElement(
                                    'label',
                                    { className: 'inspector-mb-0' },
                                    'Items to Display'
                                ),
                                wp.element.createElement(RangeControl, {
                                    value: minSlides,
                                    min: 4,
                                    max: 10,
                                    step: 1,
                                    onChange: function onChange(value) {
                                        return setAttributes({ minSlides: value });
                                    }
                                })
                            ),
                            wp.element.createElement(
                                'div',
                                { className: 'inspector-field inspector-field-fontsize ' },
                                wp.element.createElement(
                                    'label',
                                    { className: 'inspector-mb-0' },
                                    'Slide Width'
                                ),
                                wp.element.createElement(RangeControl, {
                                    value: slideWidth,
                                    min: 50,
                                    max: 1000,
                                    step: 1,
                                    onChange: function onChange(value) {
                                        return setAttributes({ slideWidth: value });
                                    }
                                })
                            ),
                            wp.element.createElement(
                                'div',
                                { className: 'inspector-field inspector-field-fontsize ' },
                                wp.element.createElement(
                                    'label',
                                    { className: 'inspector-mb-0' },
                                    'Slide Margin'
                                ),
                                wp.element.createElement(RangeControl, {
                                    value: slideMargin,
                                    min: 0,
                                    max: 100,
                                    step: 1,
                                    onChange: function onChange(value) {
                                        return setAttributes({ slideMargin: value });
                                    }
                                })
                            )
                        ),
                        controls ? wp.element.createElement(
                            PanelBody,
                            { title: __('Slider Arrow'), initialOpen: false },
                            wp.element.createElement(
                                'ul',
                                { className: 'slider-arrow-main' },
                                arrowNames.map(function (item, index) {
                                    return wp.element.createElement(
                                        Fragment,
                                        { key: index },
                                        wp.element.createElement(
                                            'li',
                                            {
                                                className: item.classnames + ' ' + (arrowIcons === item.classnames ? 'active' : ''),
                                                key: index,
                                                onClick: function onClick(e) {
                                                    setAttributes({ arrowIcons: item.classnames });
                                                }
                                            },
                                            item.name
                                        )
                                    );
                                })
                            )
                        ) : '',
                        wp.element.createElement(
                            PanelBody,
                            { title: __('Image Dimension'), initialOpen: false },
                            wp.element.createElement(
                                PanelRow,
                                null,
                                wp.element.createElement(TextControl, {
                                    type: 'number',
                                    label: 'Fixed Width',
                                    min: '1',
                                    value: fixedWidth,
                                    placeholder: 'Fixed Width',
                                    onChange: function onChange(value) {
                                        return setAttributes({ fixedWidth: value });
                                    }
                                })
                            ),
                            wp.element.createElement(
                                PanelRow,
                                null,
                                wp.element.createElement(TextControl, {
                                    type: 'number',
                                    label: 'Fixed Height',
                                    min: '1',
                                    value: fixedHeight,
                                    placeholder: 'Fixed Height',
                                    onChange: function onChange(value) {
                                        return setAttributes({ fixedHeight: value });
                                    }
                                })
                            )
                        )
                    ),
                    wp.element.createElement(
                        'div',
                        { className: 'nab-media-slider-block slider-arrow-main ' + arrowIcons },
                        wp.element.createElement(
                            'div',
                            { className: sliderActive ? 'nab-media-slider' : 'feature-box-list', 'data-animation': detailAnimation, 'data-autoplay': '' + autoplay, 'data-speed': '' + speed, 'data-infiniteloop': '' + infiniteLoop, 'data-pager': '' + pager, 'data-controls': '' + controls },
                            media.map(function (source, index) {
                                return wp.element.createElement(
                                    'div',
                                    { className: 'nab-media-slider-item', key: index },
                                    wp.element.createElement(MediaUpload, {
                                        value: source.id,
                                        onSelect: function onSelect(item) {
                                            var editItem = [].concat(_toConsumableArray(media));
                                            editItem[index].url = item.url;
                                            editItem[index].id = item.id;

                                            setAttributes({
                                                media: editItem
                                            });
                                        },
                                        render: function render(_ref2) {
                                            var open = _ref2.open;
                                            return wp.element.createElement('span', { 'class': 'dashicons dashicons-edit edit-item', onClick: open });
                                        }
                                    }),
                                    nabInsertMedaitoSlide(source.url, attributes),
                                    source.link && wp.element.createElement('a', { className: 'nab-media-slider-link',
                                        target: '_blank',
                                        rel: 'noopener noreferrer',
                                        href: source.link
                                    })
                                );
                            })
                        ),
                        isSelected && wp.element.createElement(
                            'div',
                            { className: 'nab-media-slider-slide-list' },
                            media.map(function (source, index) {
                                return wp.element.createElement(
                                    'div',
                                    { className: 'nab-media-slider-slide-list-item ' + (currentSelected == index ? 'active' : ''), key: index },
                                    0 < index && wp.element.createElement(
                                        Tooltip,
                                        { text: __('Move Left') },
                                        wp.element.createElement(
                                            'span',
                                            { className: 'nab-move-arrow nab-move-left',
                                                onClick: function onClick() {
                                                    return _this3.moveMedia(index, index - 1);
                                                }
                                            },
                                            wp.element.createElement(
                                                'svg',
                                                { xmlns: 'http://www.w3.org/2000/svg', width: '24', height: '24', viewBox: '0 0 24 24' },
                                                wp.element.createElement('path', { fill: 'none', d: 'M0 0h24v24H0V0z' }),
                                                wp.element.createElement('path', { d: 'M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6 1.41-1.41z' })
                                            )
                                        )
                                    ),
                                    nabIsImage(source.url) && wp.element.createElement('img', { src: source.url,
                                        className: 'nab-media-slider-img',
                                        alt: __('Remove'),
                                        height: '100px',
                                        width: '100px',
                                        onClick: function onClick() {
                                            if (sliderActive) {
                                                _this3.state.bxSliderObj.goToSlide(index);
                                            }
                                            _this3.setState({ currentSelected: index });
                                        }
                                    }),
                                    !nabIsImage(source.url) && wp.element.createElement('video', { src: source.url,
                                        className: 'nab-media-slider-vid',
                                        height: '100px',
                                        width: '100px',
                                        onClick: function onClick() {
                                            if (sliderActive) {
                                                _this3.state.bxSliderObj.goToSlide(index);
                                            }
                                            _this3.setState({ currentSelected: index });
                                        }
                                    }),
                                    index + 1 < media.length && wp.element.createElement(
                                        Tooltip,
                                        { text: __('Move Right') },
                                        wp.element.createElement(
                                            'span',
                                            { className: 'nab-move-arrow nab-move-right',
                                                onClick: function onClick() {
                                                    return _this3.moveMedia(index, index + 1);
                                                }
                                            },
                                            wp.element.createElement(
                                                'svg',
                                                { xmlns: 'http://www.w3.org/2000/svg', width: '24', height: '24', viewBox: '0 0 24 24' },
                                                wp.element.createElement('path', { fill: 'none', d: 'M0 0h24v24H0V0z' }),
                                                wp.element.createElement('path', { d: 'M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z' })
                                            )
                                        )
                                    ),
                                    wp.element.createElement(
                                        Tooltip,
                                        { text: __('Remove media') },
                                        wp.element.createElement(IconButton, {
                                            className: 'nab-media-slider-item-remove',
                                            icon: 'no',
                                            onClick: function onClick() {
                                                _this3.setState({ currentSelected: 0 });
                                                var removed = [].concat(_toConsumableArray(media));
                                                removed.splice(index, 1);

                                                setAttributes({
                                                    media: removed
                                                });
                                            }
                                        })
                                    )
                                );
                            }),
                            wp.element.createElement(
                                'div',
                                { className: 'nab-media-slider-add-item' },
                                wp.element.createElement(MediaUpload, {
                                    value: currentSelected,
                                    multiple: true,
                                    onSelect: function onSelect(items) {
                                        var newItemInsert = items.map(function (item, index) {
                                            return {
                                                url: item.url,
                                                id: item.id,
                                                advertisement: false,
                                                eventCategory: '',
                                                eventAction: '',
                                                eventLabel: '',
                                                target: false
                                            };
                                        });
                                        setAttributes({
                                            media: [].concat(_toConsumableArray(media), _toConsumableArray(newItemInsert))
                                        });
                                    },
                                    render: function render(_ref3) {
                                        var open = _ref3.open;
                                        return wp.element.createElement(IconButton, {
                                            label: __('Add media'),
                                            icon: 'plus',
                                            onClick: open
                                        });
                                    }
                                })
                            )
                        ),
                        isSelected && wp.element.createElement(
                            'div',
                            { className: 'nab-media-slider-controls featured-boxes-details' },
                            wp.element.createElement(
                                'div',
                                { className: 'advertisement-btn' },
                                wp.element.createElement(
                                    'div',
                                    { className: 'left' },
                                    wp.element.createElement(ToggleControl, {
                                        label: __('Advertisement'),
                                        checked: media[currentSelected] ? media[currentSelected].advertisement || '' : '',
                                        onChange: function onChange() {
                                            var check = media[currentSelected].advertisement === undefined ? false : !media[currentSelected].advertisement;
                                            _this3.updateMediaData({ advertisement: check });
                                        }
                                    })
                                ),
                                wp.element.createElement(
                                    'div',
                                    { className: 'right' },
                                    wp.element.createElement(ToggleControl, {
                                        label: __('Open in New Tab'),
                                        checked: media[currentSelected] ? media[currentSelected].target || '' : '',
                                        onChange: function onChange() {
                                            var check = media[currentSelected].target === undefined ? false : !media[currentSelected].target;
                                            _this3.updateMediaData({ target: check });
                                        }
                                    })
                                )
                            ),
                            wp.element.createElement(
                                'div',
                                { className: 'featured-boxes-link' },
                                wp.element.createElement(TextControl, {
                                    label: __('Link'),
                                    value: media[currentSelected] ? media[currentSelected].link || '' : '',
                                    onChange: function onChange(value) {
                                        return _this3.updateMediaData({ link: value || '' });
                                    }
                                })
                            ),
                            media[currentSelected].advertisement && wp.element.createElement(
                                Fragment,
                                null,
                                nabIsImage(media[currentSelected].url) && wp.element.createElement(
                                    Fragment,
                                    null,
                                    wp.element.createElement(
                                        'div',
                                        { className: 'nab-controls-wrapper' },
                                        wp.element.createElement(
                                            'strong',
                                            null,
                                            'Google Event'
                                        ),
                                        wp.element.createElement(
                                            'div',
                                            { className: 'nab-media-slider-control' },
                                            wp.element.createElement(TextControl, {
                                                label: __('Event Category'),
                                                placeholder: 'Enter Category',
                                                value: media[currentSelected] ? media[currentSelected].eventCategory || '' : '',
                                                onChange: function onChange(value) {
                                                    return _this3.updateMediaData({ eventCategory: value || '' });
                                                }
                                            })
                                        ),
                                        wp.element.createElement(
                                            'div',
                                            { className: 'nab-media-slider-control' },
                                            wp.element.createElement(TextControl, {
                                                label: __('Event Action'),
                                                placeholder: 'Enter Action',
                                                value: media[currentSelected] ? media[currentSelected].eventAction || '' : '',
                                                onChange: function onChange(value) {
                                                    return _this3.updateMediaData({ eventAction: value || '' });
                                                }
                                            })
                                        ),
                                        wp.element.createElement(
                                            'div',
                                            { className: 'nab-media-slider-control' },
                                            wp.element.createElement(TextControl, {
                                                label: __('Event Label'),
                                                placeholder: 'Enter Label',
                                                value: media[currentSelected] ? media[currentSelected].eventLabel || '' : '',
                                                onChange: function onChange(value) {
                                                    return _this3.updateMediaData({ eventLabel: value || '' });
                                                }
                                            })
                                        )
                                    )
                                )
                            )
                        )
                    )
                );
            }
        }]);

        return featuredBoxesComp;
    }(Component);

    var blockAttrs = {
        media: {
            type: 'array',
            default: []
        },
        sliderActive: {
            type: 'boolean',
            default: true
        },
        autoplay: {
            type: 'boolean',
            default: false
        },
        advertisementDetails: {
            type: 'boolean',
            default: false
        },

        infiniteLoop: {
            type: 'boolean',
            default: true
        },
        pager: {
            type: 'boolean',
            default: false
        },
        controls: {
            type: 'boolean',
            default: true
        },
        hoverColor: {
            type: 'string'
        },
        titleColor: {
            type: 'string'
        },
        textColor: {
            type: 'string'
        },
        vAlign: {
            type: 'string',
            default: 'center'
        },
        hAlign: {
            type: 'string',
            default: 'center'
        },
        changed: {
            type: 'boolean',
            default: false
        },
        speed: {
            type: 'number',
            default: 500
        },
        titleFont: {
            type: 'number',
            default: 25
        },
        textFont: {
            type: 'number',
            default: 18
        },
        overlayOpacity: {
            type: 'number',
            default: 20
        },
        detailWidth: {
            type: 'number',
            default: 50
        },
        controlIcon: {
            type: 'string',
            default: 'control-7'
        },
        detailAnimation: {
            type: 'string',
            default: 'none'
        },
        arrowIcons: {
            type: 'string',
            default: 'slider-arrow-1'
        },
        minSlides: {
            type: 'number',
            default: 4
        },
        slideWidth: {
            type: 'number',
            default: 400
        },
        slideMargin: {
            type: 'number',
            default: 30
        },
        fixedWidth: {
            type: 'number'
        },
        fixedHeight: {
            type: 'number'
        }
    };

    registerBlockType('md/featured-boxes', {
        title: __('Featured Boxes'),
        description: __('Featured Boxes'),
        icon: { src: sliderBlockIcon },
        category: 'nabshow',
        keywords: [__('Featured'), __('Boxes'), __('Featured Boxes'), __('nab')],
        attributes: blockAttrs,
        edit: featuredBoxesComp,
        save: function save(_ref4) {
            var attributes = _ref4.attributes;
            var media = attributes.media,
                minSlides = attributes.minSlides,
                slideWidth = attributes.slideWidth,
                slideMargin = attributes.slideMargin,
                autoplay = attributes.autoplay,
                hoverColor = attributes.hoverColor,
                titleColor = attributes.titleColor,
                textColor = attributes.textColor,
                hAlign = attributes.hAlign,
                vAlign = attributes.vAlign,
                speed = attributes.speed,
                infiniteLoop = attributes.infiniteLoop,
                pager = attributes.pager,
                controls = attributes.controls,
                titleFont = attributes.titleFont,
                textFont = attributes.textFont,
                controlIcon = attributes.controlIcon,
                detailAnimation = attributes.detailAnimation,
                detailWidth = attributes.detailWidth,
                arrowIcons = attributes.arrowIcons,
                sliderActive = attributes.sliderActive,
                fixedWidth = attributes.fixedWidth,
                fixedHeight = attributes.fixedHeight;

            return wp.element.createElement(
                'div',
                { className: 'slider-arrow-main ' + arrowIcons },
                wp.element.createElement(
                    'div',
                    { className: sliderActive ? 'nab-dynamic-slider' : 'feature-box-list', 'data-minslides': minSlides, 'data-slidewidth': slideWidth, 'data-slidemargin': slideMargin, 'data-animation': detailAnimation, 'data-auto': autoplay ? autoplay : Boolean.valueOf(autoplay), 'data-speed': '' + speed, 'data-infinite': infiniteLoop ? infiniteLoop : Boolean.valueOf(infiniteLoop), 'data-pager': pager ? pager : Boolean.valueOf(pager), 'data-controls': controls ? controls : Boolean.valueOf(controls) },
                    media.map(function (source, index) {
                        return wp.element.createElement(
                            'div',
                            { className: 'item', key: index },
                            source.link ? wp.element.createElement(
                                'a',
                                { className: 'nab-media-slider-link',
                                    target: source.target ? '_blank' : '_self',
                                    rel: 'noopener noreferrer',
                                    href: source.link,
                                    'data-category': source.advertisement && source.eventCategory && source.eventCategory,
                                    'data-action': source.advertisement && source.eventAction && source.eventAction,
                                    'data-label': source.advertisement && source.eventLabel && source.eventLabel
                                },
                                nabInsertMedaitoSlide(source.url, attributes)
                            ) : wp.element.createElement(
                                Fragment,
                                null,
                                nabInsertMedaitoSlide(source.url, attributes)
                            )
                        );
                    })
                )
            );
        }

    });
})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);

/***/ }),
/* 168 */
/***/ (function(module, exports) {

(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
  var __ = wpI18n.__;
  var registerBlockType = wpBlocks.registerBlockType;
  var Fragment = wpElement.Fragment;
  var RichText = wpEditor.RichText,
      InspectorControls = wpEditor.InspectorControls;
  var Button = wpComponents.Button,
      PanelBody = wpComponents.PanelBody,
      TextControl = wpComponents.TextControl;


  var crossPromoBlockIcon = wp.element.createElement(
    "svg",
    { version: "1.1", id: "crossPromoBlockIcon", width: "150px", height: "150px", viewBox: "200 200 150 150", "enable-background": "new 200 200 150 150" },
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement("path", { fill: "#146DB6", d: "M332.136,233.885V223.15c0-7.089-5.767-12.856-12.855-12.856h-88.56c-7.088,0-12.855,5.767-12.855,12.856\r v10.735c-4.987,1.769-8.57,6.532-8.57,12.119v91.417c0,2.366,1.918,4.284,4.285,4.284h122.842c2.366,0,4.284-1.918,4.284-4.284\r v-91.417C340.706,240.417,337.123,235.654,332.136,233.885z M266.43,241.719h17.14v8.57c0,4.726-3.844,8.57-8.57,8.57\r c-4.726,0-8.57-3.844-8.57-8.57L266.43,241.719L266.43,241.719z M232.149,333.136h-14.284v-66.682\r c1.81,0.638,3.737,0.976,5.714,0.976c3.121,0,6.047-0.842,8.57-2.306L232.149,333.136L232.149,333.136z M232.149,250.289\r c0,4.726-3.845,8.57-8.57,8.57c-2.133,0-4.152-0.783-5.713-2.183v-10.672c0-2.363,1.922-4.285,4.285-4.285h9.999V250.289\r L232.149,250.289z M240.719,250.289v-8.57h17.141v8.57c0,4.726-3.845,8.57-8.57,8.57S240.719,255.015,240.719,250.289z\r M259.217,275.898c4.726,0,8.57,3.845,8.57,8.57s-3.845,8.57-8.57,8.57c-4.726,0-8.57-3.845-8.57-8.57\r S254.491,275.898,259.217,275.898z M290.642,324.464c-4.727,0-8.57-3.845-8.57-8.57c0-4.727,3.844-8.57,8.57-8.57\r c4.726,0,8.569,3.844,8.569,8.57C299.211,320.619,295.367,324.464,290.642,324.464z M298.027,281.887l-39.995,39.995\r c-0.836,0.836-1.933,1.254-3.03,1.254s-2.193-0.417-3.03-1.254c-1.673-1.674-1.673-4.388,0-6.061l39.996-39.995\r c1.673-1.673,4.386-1.673,6.059,0C299.701,277.5,299.701,280.214,298.027,281.887z M309.282,250.289\r c0,4.726-3.846,8.57-8.571,8.57s-8.57-3.844-8.57-8.57v-8.57h17.142V250.289L309.282,250.289z M332.136,333.136h-14.283v-68.012\r c2.522,1.463,5.449,2.306,8.569,2.306c1.978,0,3.904-0.338,5.714-0.976V333.136L332.136,333.136z M332.136,256.676\r c-1.562,1.4-3.58,2.183-5.714,2.183c-4.726,0-8.569-3.844-8.569-8.57v-8.571h9.998c2.362,0,4.285,1.923,4.285,4.286V256.676z" })
      )
    )
  );

  registerBlockType('nab/cross-promo', {
    title: __('Cross Promo'),
    icon: { src: crossPromoBlockIcon },
    category: 'nabshow',
    keywords: [__('cross'), __('promo'), __('nab')],
    attributes: {
      title: {
        type: 'string'
      },
      description: {
        type: 'string',
        default: ''
      },
      ButtonText: {
        type: 'string',
        default: 'Learn More'
      },
      postID: {
        type: 'number'
      }
    },
    edit: function edit(props) {
      var attributes = props.attributes,
          setAttributes = props.setAttributes;
      var title = attributes.title,
          description = attributes.description,
          ButtonText = attributes.ButtonText,
          postID = attributes.postID;


      var getExcerpt = function getExcerpt() {

        if (postID) {
          wp.apiFetch({ path: '/nab_api/request/post-excerpt/?id=' + postID }).then(function (excerpt) {

            if ('' !== excerpt) {
              setAttributes({ description: excerpt });
            } else if ('' === description) {
              setAttributes({ description: 'Post excerpt not found for given id. Either change the id or enter manually.' });
            }
          });
        }
      };

      return wp.element.createElement(
        Fragment,
        null,
        wp.element.createElement(
          InspectorControls,
          null,
          wp.element.createElement(
            PanelBody,
            { title: "Settings" },
            wp.element.createElement(TextControl, {
              type: "number",
              label: "Enter post ID to fetch excerpt",
              value: postID,
              onChange: function onChange(value) {
                return setAttributes({ postID: parseInt(value) });
              }
            }),
            wp.element.createElement(
              Button,
              { className: "button button-large button-primary", onClick: getExcerpt },
              __('Fetch')
            )
          )
        ),
        wp.element.createElement(
          "div",
          { className: "cross-promo-outner" },
          wp.element.createElement(
            "div",
            { className: "cross-promo-inner" },
            wp.element.createElement(RichText, {
              tagName: "h3",
              onChange: function onChange(value) {
                return setAttributes({ title: value });
              },
              value: title,
              className: "title",
              placeholder: __('Title')
            }),
            wp.element.createElement(RichText, {
              tagName: "p",
              onChange: function onChange(value) {
                return setAttributes({ description: value });
              },
              value: description,
              className: "description",
              placeholder: __('Description')
            }),
            wp.element.createElement(RichText, {
              tagName: "a",
              className: "promo-link",
              onChange: function onChange(ButtonText) {
                return setAttributes({ ButtonText: ButtonText });
              },
              value: ButtonText,
              rel: "noopener noreferrer"
            })
          )
        )
      );
    },
    save: function save(props) {
      var _props$attributes = props.attributes,
          title = _props$attributes.title,
          description = _props$attributes.description,
          ButtonText = _props$attributes.ButtonText;


      return wp.element.createElement(
        "div",
        { className: "cross-promo-outner" },
        wp.element.createElement(
          "div",
          { className: "cross-promo-inner" },
          title && wp.element.createElement(RichText.Content, { tagName: "h3", value: title, className: "title" }),
          description && wp.element.createElement(RichText.Content, { tagName: "p", value: description, className: "description" }),
          ButtonText && wp.element.createElement(RichText.Content, { tagName: "a", value: ButtonText, className: "promo-link" })
        )
      );
    }
  });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);

/***/ })
/******/ ]);