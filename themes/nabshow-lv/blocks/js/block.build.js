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
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "p", function() { return quotesSliderBottom; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "q", function() { return quotesSliderSide; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return arrowBtn; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "g", function() { return btnWhite; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "f", function() { return btnPrimary; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "d", function() { return btnDefault; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "c", function() { return btnAlt; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "e", function() { return btnLight; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "l", function() { return latestShowNews1; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "m", function() { return latestShowNews2; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "n", function() { return latestShowNews3; });
/* unused harmony export sessionSliderOff1 */
/* unused harmony export sessionSliderOff2 */
/* unused harmony export sessionSliderOn1 */
/* unused harmony export sessionSliderOn2 */
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "w", function() { return sliderArrow1; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "x", function() { return sliderArrow2; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "y", function() { return sliderArrow3; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "z", function() { return sliderArrow4; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "A", function() { return sliderArrow5; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "B", function() { return sliderArrow6; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "h", function() { return destinations; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "k", function() { return keyContacts; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "j", function() { return featuredHappening; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "o", function() { return productCategories; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "i", function() { return exhibitorResources; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "b", function() { return browseHappening; });
/* unused harmony export exhibitorAccordion */
/* unused harmony export exhibitorImageListing */
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "v", function() { return relatedContentTitleList; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "u", function() { return relatedContSideImgInfo; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "r", function() { return realtedContentCoLocatedEvents; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "s", function() { return realtedContentInfoOnly; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "t", function() { return realtedContentPlanShow; });
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
      wp.element.createElement("path", { fill: "#7B8080", d: "M118.809,260.039c0.406,0.406,1.065,0.406,1.471,0l6.46-6.46c0.203-0.203,0.305-0.471,0.305-0.735 c0-0.266-0.102-0.533-0.305-0.735l-6.46-6.462c-0.405-0.404-1.062-0.405-1.468-0.003c-0.407,0.403-0.411,1.053-0.01,1.46 l4.616,4.687h-21.904c-0.575,0-1.04,0.478-1.04,1.052s0.465,1.052,1.04,1.052h21.983l-4.688,4.682 C118.404,258.982,118.404,259.633,118.809,260.039z" }),
      wp.element.createElement("path", { fill: "#7B8080", d: "M105.888,248.139c-0.176,0.548,0.125,1.133,0.671,1.308c0.547,0.176,1.133-0.126,1.307-0.673 c1.766-5.502,6.837-9.199,12.621-9.199c7.307,0,13.251,5.943,13.251,13.252c0,7.305-5.944,13.248-13.251,13.248 c-5.784,0-10.855-3.695-12.621-9.198c-0.174-0.546-0.76-0.847-1.307-0.673c-0.546,0.176-0.847,0.763-0.671,1.308 c2.042,6.366,7.908,10.644,14.6,10.644c8.454,0,15.33-6.877,15.33-15.328c0-8.455-6.876-15.331-15.33-15.331 C113.796,237.495,107.929,241.772,105.888,248.139z" })
    ),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("path", { fill: "#7B8080", d: "M68.367,245.61c-0.406-0.406-1.065-0.406-1.471,0l-6.46,6.461c-0.203,0.203-0.305,0.47-0.305,0.735 s0.102,0.532,0.305,0.735l6.46,6.46c0.405,0.404,1.062,0.406,1.468,0.004c0.407-0.402,0.411-1.052,0.01-1.459l-4.616-4.687h21.904 c0.575,0,1.04-0.479,1.04-1.053s-0.465-1.052-1.04-1.052H63.679l4.688-4.682C68.772,246.667,68.772,246.016,68.367,245.61z" }),
      wp.element.createElement("path", { fill: "#7B8080", d: "M81.288,257.511c0.176-0.548-0.125-1.133-0.671-1.307c-0.547-0.176-1.133,0.125-1.307,0.672 c-1.766,5.503-6.837,9.198-12.621,9.198c-7.307,0-13.251-5.941-13.251-13.25c0-7.307,5.944-13.25,13.251-13.25 c5.784,0,10.855,3.695,12.621,9.199c0.174,0.546,0.76,0.847,1.307,0.673c0.546-0.176,0.847-0.763,0.671-1.308 c-2.042-6.366-7.908-10.644-14.6-10.644c-8.454,0-15.33,6.876-15.33,15.329s6.876,15.33,15.33,15.33 C73.38,268.154,79.247,263.877,81.288,257.511z" })
    ),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("path", { fill: "#7B8080", d: "M120.334,200.643h12.939l-3.087,3.088c-0.271,0.27-0.271,0.709,0,0.979c0.27,0.271,0.709,0.271,0.979,0 l4.27-4.27c0.271-0.271,0.271-0.709,0-0.979l-4.27-4.271c-0.135-0.136-0.313-0.203-0.489-0.203c-0.178,0-0.354,0.067-0.489,0.203 c-0.271,0.271-0.271,0.709,0,0.979l3.087,3.088h-12.939c-0.382,0-0.692,0.31-0.692,0.691 C119.642,200.332,119.951,200.643,120.334,200.643z" })
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
      wp.element.createElement("path", { fill: "#7B8080", d: "M425.256,135.732c0.48,0.48,1.261,0.48,1.742,0l7.653-7.654c0.24-0.241,0.361-0.556,0.361-0.871 c0-0.314-0.121-0.631-0.361-0.871l-7.653-7.655c-0.48-0.479-1.258-0.48-1.738-0.004c-0.482,0.478-0.487,1.247-0.012,1.73 l5.468,5.552h-25.948c-0.681,0-1.232,0.566-1.232,1.246s0.551,1.247,1.232,1.247h26.041l-5.553,5.544 C424.775,134.479,424.775,135.251,425.256,135.732z" }),
      wp.element.createElement("path", { fill: "#7B8080", d: "M409.948,121.634c-0.208,0.649,0.149,1.341,0.796,1.549c0.648,0.208,1.342-0.148,1.549-0.796 c2.091-6.519,8.099-10.898,14.95-10.898c8.656,0,15.697,7.041,15.697,15.698c0,8.654-7.041,15.695-15.697,15.695 c-6.852,0-12.859-4.378-14.95-10.897c-0.207-0.646-0.9-1.003-1.549-0.797c-0.646,0.208-1.004,0.904-0.796,1.548 c2.419,7.542,9.369,12.609,17.295,12.609c10.014,0,18.16-8.146,18.16-18.159c0-10.015-8.146-18.161-18.16-18.161 C419.317,109.026,412.367,114.093,409.948,121.634z" })
    ),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("path", { fill: "#7B8080", d: "M21.121,118.639c-0.481-0.481-1.261-0.481-1.743,0l-7.653,7.654c-0.241,0.24-0.361,0.556-0.361,0.871 s0.121,0.631,0.361,0.871l7.653,7.655c0.481,0.479,1.258,0.48,1.738,0.003c0.483-0.479,0.487-1.246,0.012-1.729l-5.468-5.551 h25.948c0.681,0,1.232-0.566,1.232-1.248c0-0.679-0.552-1.246-1.232-1.246H15.568l5.553-5.546 C21.601,119.891,21.601,119.119,21.121,118.639z" }),
      wp.element.createElement("path", { fill: "#7B8080", d: "M36.428,132.736c0.208-0.649-0.148-1.341-0.795-1.548c-0.649-0.208-1.341,0.148-1.548,0.796 c-2.092,6.519-8.1,10.897-14.951,10.897c-8.656,0-15.697-7.041-15.697-15.697c0-8.654,7.041-15.696,15.697-15.696 c6.852,0,12.859,4.379,14.951,10.898c0.207,0.646,0.899,1.002,1.548,0.797c0.647-0.208,1.004-0.904,0.795-1.549 c-2.418-7.542-9.368-12.608-17.294-12.608c-10.014,0-18.16,8.146-18.16,18.159c0,10.015,8.146,18.161,18.16,18.161 C27.06,145.345,34.009,140.277,36.428,132.736z" })
    ),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("path", { fill: "#7B8080", d: "M126.898,231.298h11.462l-2.734,3.786c-0.24,0.331-0.24,0.869,0,1.199c0.238,0.334,0.628,0.334,0.867,0 l3.782-5.235c0.239-0.33,0.239-0.869,0-1.199l-3.782-5.235c-0.12-0.168-0.278-0.249-0.434-0.249c-0.158,0-0.314,0.081-0.433,0.249 c-0.24,0.33-0.24,0.869,0,1.2l2.734,3.786h-11.462c-0.338,0-0.613,0.381-0.613,0.848 C126.286,230.917,126.56,231.298,126.898,231.298z" })
    )
  )
);

var arrowBtn = wp.element.createElement(
  "svg",
  { version: "1.1", id: "Layer_1", x: "0px", y: "0px", width: "105px", height: "41.001px", viewBox: "0 0 83.461 13.044", "enable-background": "new 0 0 83.461 13.044" },
  wp.element.createElement(
    "text",
    { transform: "matrix(1 0 0 1 0 10.0439)", "font-family": "'MyriadPro-Regular'", "font-size": "9.8" },
    "READ MORE"
  ),
  wp.element.createElement("path", { fill: "#010101", d: "M74.386,1.857l0.782-0.446c0.332-0.189,0.867-0.189,1.195,0l6.851,3.904c0.331,0.189,0.331,0.494,0,0.681 l-6.851,3.906c-0.332,0.189-0.867,0.189-1.195,0l-0.782-0.446c-0.335-0.191-0.328-0.502,0.014-0.689l4.246-2.307H68.519 c-0.469,0-0.846-0.215-0.846-0.482V5.335c0-0.267,0.377-0.482,0.846-0.482h10.127L74.4,2.546 C74.055,2.359,74.047,2.048,74.386,1.857z" })
);

var btnWhite = wp.element.createElement(
  "svg",
  { version: "1.1", id: "Layer_1", xmlns: "http://www.w3.org/2000/svg", x: "0px", y: "0px",
    width: "105px", height: "41.001px", viewBox: "0 0 106 41", "enable-background": "new 0 0 106 41" },
  wp.element.createElement("rect", { x: "0.5", y: "0.5", fill: "#FFFFFF", stroke: "#d9d9d9", "stroke-miterlimit": "10", width: "105", height: "40" }),
  wp.element.createElement(
    "text",
    { transform: "matrix(1 0 0 1 22.5 24.8335)", "font-family": "'MyriadPro-Regular'", "font-size": "10" },
    "READ MORE"
  )
);

var btnPrimary = wp.element.createElement(
  "svg",
  { version: "1.1", id: "btnPrimary", x: "0px", y: "0px", width: "105px", height: "41.001px", viewBox: "0 0 105 41.001", enableBackground: "0 0 105 41.001" },
  wp.element.createElement("rect", { fill: "#146DB6", width: "105", height: "41.001" }),
  wp.element.createElement(
    "text",
    { transform: "matrix(1 0 0 1 13.7622 25.3164)", fill: "#FFFFFF", "font-family": "'MyanmarText-Bold'", "font-size": "12" },
    "READ MORE"
  )
);

var btnDefault = wp.element.createElement(
  "svg",
  { version: "1.1", id: "btnDefault", x: "0px", y: "0px", width: "105px", height: "41.001px", viewBox: "0 0 105 41.001", enableBackground: "new 0 0 105 41.001" },
  wp.element.createElement("rect", { fill: "#9A9A99", width: "105", height: "41.001" }),
  wp.element.createElement(
    "text",
    { transform: "matrix(1 0 0 1 13.7622 25.3164)", fill: "#FFFFFF", "font-family": "'MyanmarText-Bold'", "font-size": "12" },
    "READ MORE"
  )
);

var btnAlt = wp.element.createElement(
  "svg",
  { version: "1.1", id: "btnAlt", x: "0px", y: "0px", width: "105px", height: "41.001px", viewBox: "0 0 105 41.001", enableBackground: "new 0 0 105 41.001" },
  wp.element.createElement("rect", { fill: "#8AC0E2", width: "105", height: "41.001" }),
  wp.element.createElement(
    "text",
    { transform: "matrix(1 0 0 1 13.7622 25.3164)", fill: "#363636", "font-family": "'MyanmarText-Bold'", "font-size": "12" },
    "READ MORE"
  )
);

var btnLight = wp.element.createElement(
  "svg",
  { version: "1.1", id: "btnLight", x: "0px", y: "0px", width: "105px", height: "41.001px", viewBox: "0 0 105 41.001", enableBackground: "new 0 0 105 41.001" },
  wp.element.createElement("rect", { fill: "#F1F8FD", width: "105", height: "41.001" }),
  wp.element.createElement(
    "text",
    { transform: "matrix(1 0 0 1 13.7622 25.3164)", fill: "#363636", "font-family": "'MyanmarText-Bold'", "font-size": "12" },
    "READ MORE"
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
      wp.element.createElement("path", { fill: "#7B8080", d: "M158.397,161.744h16.783l-4.005,3.035c-0.349,0.267-0.349,0.697,0,0.963c0.351,0.266,0.922,0.266,1.273,0 l5.535-4.198c0.351-0.266,0.351-0.696,0-0.962l-5.535-4.198c-0.176-0.135-0.406-0.198-0.636-0.198 c-0.231,0-0.461,0.063-0.637,0.198c-0.349,0.268-0.349,0.698,0,0.963l4.005,3.035h-16.783c-0.497,0-0.898,0.307-0.898,0.678 C157.499,161.439,157.9,161.744,158.397,161.744z" })
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
      wp.element.createElement("path", { fill: "#7B8080", d: "M189.056,178.894h23.362l-5.576,2.893c-0.485,0.254-0.485,0.664,0,0.917c0.488,0.253,1.284,0.253,1.772,0 l7.705-4c0.488-0.254,0.488-0.664,0-0.917l-7.705-4c-0.244-0.13-0.565-0.19-0.886-0.19c-0.321,0-0.642,0.061-0.886,0.19 c-0.485,0.253-0.485,0.664,0,0.917l5.576,2.893h-23.362c-0.691,0-1.25,0.292-1.25,0.646 C187.806,178.603,188.365,178.894,189.056,178.894z" })
    )
  ),
  wp.element.createElement("rect", { x: "1.078", y: "3.064", fill: "#7B8080", width: "498.656", height: "88.735" }),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("path", { fill: "#FFFFFF", d: "M274.806,32.021h-48.801c-0.481,0-0.871,0.299-0.871,0.67v29.482c0,0.371,0.39,0.67,0.871,0.67h48.801 c0.48,0,0.871-0.299,0.871-0.67V32.69C275.676,32.321,275.287,32.021,274.806,32.021z M273.934,61.503h-47.057V33.361h47.057 V61.503L273.934,61.503z" }),
    wp.element.createElement("path", { fill: "#FFFFFF", d: "M239.078,46.854c2.676,0,4.853-1.674,4.853-3.731c0-2.058-2.177-3.731-4.853-3.731 c-2.677,0-4.854,1.673-4.854,3.731C234.224,45.18,236.401,46.854,239.078,46.854z M239.078,40.73c1.714,0,3.109,1.074,3.109,2.393 c0,1.318-1.395,2.391-3.109,2.391c-1.716,0-3.11-1.073-3.11-2.391C235.967,41.807,237.362,40.73,239.078,40.73z" }),
    wp.element.createElement("path", { fill: "#FFFFFF", d: "M231.234,58.823c0.204,0,0.41-0.055,0.575-0.167l14.215-9.623l8.978,6.902c0.341,0.262,0.892,0.262,1.232,0 c0.34-0.262,0.34-0.685,0-0.947l-4.188-3.222l8-6.737l9.813,6.917c0.356,0.25,0.906,0.23,1.231-0.041 c0.326-0.274,0.301-0.697-0.054-0.947l-10.457-7.371c-0.172-0.12-0.398-0.179-0.629-0.175c-0.23,0.008-0.447,0.086-0.604,0.218 l-8.534,7.188l-4.134-3.178c-0.326-0.25-0.847-0.262-1.191-0.03l-14.83,10.04c-0.362,0.246-0.397,0.668-0.079,0.946 C230.752,58.746,230.993,58.823,231.234,58.823z" })
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
    wp.element.createElement("path", { fill: "#FFFFFF", d: "M143.929,72.79H84.534c-0.586,0-1.061,0.539-1.061,1.206v53.066c0,0.666,0.475,1.206,1.061,1.206h59.395 c0.585,0,1.06-0.539,1.06-1.206V73.995C144.989,73.33,144.514,72.79,143.929,72.79z M142.867,125.856H85.594V75.202h57.273V125.856 L142.867,125.856z" }),
    wp.element.createElement("path", { fill: "#FFFFFF", d: "M100.443,99.488c3.256,0,5.907-3.013,5.907-6.712c0-3.707-2.649-6.717-5.907-6.717 c-3.258,0-5.907,3.012-5.907,6.715C94.537,96.476,97.186,99.488,100.443,99.488z M100.443,88.467c2.088,0,3.786,1.932,3.786,4.307 c0,2.372-1.698,4.304-3.786,4.304c-2.088,0-3.786-1.931-3.786-4.304C96.657,90.402,98.355,88.467,100.443,88.467z" }),
    wp.element.createElement("path", { fill: "#FFFFFF", d: "M90.896,121.031c0.249,0,0.5-0.099,0.701-0.301l17.302-17.32l10.927,12.424 c0.416,0.471,1.086,0.471,1.499,0c0.416-0.472,0.416-1.234,0-1.705l-5.097-5.798l9.737-12.125l11.943,12.449 c0.433,0.451,1.102,0.416,1.499-0.075c0.396-0.491,0.365-1.254-0.066-1.703l-12.729-13.267c-0.208-0.215-0.483-0.321-0.763-0.315 c-0.281,0.014-0.546,0.155-0.737,0.392l-10.387,12.937l-5.032-5.72c-0.395-0.449-1.03-0.473-1.451-0.054l-18.046,18.07 c-0.439,0.44-0.482,1.201-0.095,1.703C90.31,120.894,90.604,121.031,90.896,121.031z" })
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
      wp.element.createElement("path", { fill: "#7B8080", d: "M315.744,156.946h8.747l-2.087,2.812c-0.183,0.248-0.183,0.646,0,0.893c0.184,0.245,0.48,0.245,0.664,0 l2.884-3.89c0.186-0.246,0.186-0.645,0-0.893l-2.884-3.89c-0.093-0.126-0.212-0.186-0.332-0.186s-0.24,0.06-0.332,0.186 c-0.183,0.247-0.183,0.646,0,0.893l2.087,2.812h-8.747c-0.261,0-0.47,0.283-0.47,0.629 C315.275,156.663,315.484,156.946,315.744,156.946z" })
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
      wp.element.createElement("path", { fill: "#7B8080", d: "M232.576,289.549h15.508l-3.701,3.088c-0.322,0.271-0.322,0.709,0,0.979c0.324,0.271,0.852,0.271,1.176,0 l5.115-4.271c0.324-0.27,0.324-0.709,0-0.979l-5.115-4.27c-0.162-0.138-0.375-0.203-0.588-0.203s-0.426,0.065-0.588,0.203 c-0.322,0.27-0.322,0.709,0,0.979l3.701,3.088h-15.508c-0.459,0-0.83,0.311-0.83,0.691 C231.746,289.238,232.117,289.549,232.576,289.549z" })
    )
  ),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("path", { fill: "#FFFFFF", d: "M197.612,19.885H131.93c-0.648,0-1.173,0.524-1.173,1.172v51.607c0,0.649,0.525,1.173,1.173,1.173h65.682 c0.646,0,1.172-0.524,1.172-1.173V21.057C198.783,20.409,198.258,19.885,197.612,19.885z M196.438,71.491h-63.335V22.23h63.335 V71.491z" }),
    wp.element.createElement("path", { fill: "#FFFFFF", d: "M149.523,45.85c3.602,0,6.532-2.93,6.532-6.53c0-3.603-2.93-6.532-6.532-6.532 c-3.602,0-6.532,2.929-6.532,6.531C142.991,42.92,145.921,45.85,149.523,45.85z M149.523,35.132c2.308,0,4.186,1.879,4.186,4.186 c0,2.307-1.878,4.186-4.186,4.186c-2.309,0-4.186-1.878-4.186-4.185C145.337,37.013,147.214,35.132,149.523,35.132z" }),
    wp.element.createElement("path", { fill: "#FFFFFF", d: "M138.967,66.8c0.274,0,0.551-0.096,0.774-0.292l19.133-16.845l12.083,12.082 c0.459,0.458,1.201,0.458,1.658,0c0.459-0.459,0.459-1.2,0-1.658l-5.637-5.639l10.768-11.792l13.207,12.107 c0.479,0.438,1.219,0.405,1.658-0.072c0.438-0.478,0.404-1.22-0.072-1.657l-14.076-12.902c-0.23-0.209-0.535-0.314-0.844-0.307 c-0.311,0.014-0.604,0.151-0.814,0.381l-11.487,12.582l-5.563-5.563c-0.438-0.437-1.14-0.459-1.604-0.052l-19.959,17.573 c-0.486,0.429-0.534,1.169-0.106,1.656C138.318,66.667,138.642,66.8,138.967,66.8z" })
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
          wp.element.createElement("path", { fill: "#7B8080", d: "M205.186,275.101h12.766l-3.046,2.542c-0.267,0.222-0.267,0.583,0,0.805 c0.267,0.225,0.699,0.225,0.966,0l4.212-3.514c0.267-0.223,0.267-0.584,0-0.806l-4.212-3.515 c-0.133-0.112-0.309-0.167-0.482-0.167c-0.176,0-0.35,0.055-0.483,0.167c-0.267,0.222-0.267,0.584,0,0.806l3.046,2.542h-12.766 c-0.377,0-0.683,0.256-0.683,0.568C204.503,274.845,204.809,275.101,205.186,275.101z" })
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
    wp.element.createElement("path", { fill: "#7B8080", d: "M74.916,128.198l-1.591,2.284l-1.123-0.921c-0.119-0.101-0.3-0.082-0.397,0.039 c-0.099,0.12-0.084,0.299,0.037,0.4l1.359,1.116c0.051,0.04,0.114,0.063,0.181,0.063c0.014,0,0.026,0,0.04-0.002 c0.075-0.011,0.148-0.054,0.194-0.117l1.766-2.538c0.088-0.131,0.059-0.308-0.07-0.395 C75.18,128.036,75.006,128.068,74.916,128.198z" }),
    wp.element.createElement("path", { fill: "#7B8080", d: "M75.149,126.507v-5.539v-2.843c0-0.156-0.126-0.282-0.282-0.282h-1.42v-0.854 c0-0.158-0.128-0.284-0.286-0.284h-1.989c-0.158,0-0.284,0.126-0.284,0.284v0.854h-6.252v-0.854c0-0.158-0.13-0.284-0.284-0.284 h-1.995c-0.156,0-0.279,0.126-0.279,0.284v0.854h-1.423c-0.158,0-0.284,0.126-0.284,0.282v2.843v11.654 c0,0.157,0.126,0.284,0.284,0.284h10.831c0.568,0.358,1.239,0.568,1.962,0.568c2.034,0,3.694-1.658,3.694-3.694 C77.138,128.36,76.328,127.121,75.149,126.507z M71.453,117.274h1.423v0.854v0.852h-1.423v-0.852V117.274z M62.645,117.274h1.421 v0.854v0.852h-1.421v-0.852V117.274z M60.936,118.413h1.139v0.853c0,0.157,0.125,0.284,0.281,0.284h1.995 c0.154,0,0.284-0.127,0.284-0.284v-0.853h6.252v0.853c0,0.157,0.126,0.284,0.284,0.284h1.989c0.158,0,0.285-0.127,0.285-0.284 v-0.853h1.137v2.274H60.936V118.413L60.936,118.413z M60.936,132.339v-11.084h13.646v5.013c-0.056-0.019-0.112-0.033-0.171-0.046 c-0.053-0.018-0.107-0.029-0.16-0.041c-0.048-0.013-0.1-0.022-0.146-0.028c-0.07-0.016-0.14-0.025-0.208-0.035 c-0.039-0.005-0.076-0.01-0.119-0.015c-0.107-0.01-0.221-0.017-0.333-0.017c-0.1,0-0.19,0.007-0.285,0.017v-0.301v-0.57v-2.557 h-2.56h-0.568h-1.99h-0.57h-1.989h-0.565h-2.563v2.557v0.57v1.988v0.57v2.559h2.563h0.565h1.989h0.57h1.887 c0.006,0.025,0.016,0.047,0.027,0.075c0.023,0.067,0.049,0.137,0.076,0.204c0.014,0.039,0.035,0.075,0.047,0.111 c0.035,0.07,0.067,0.143,0.108,0.215c0.016,0.03,0.035,0.056,0.05,0.086c0.042,0.076,0.087,0.149,0.13,0.221 c0.02,0.025,0.038,0.048,0.054,0.075c0.05,0.071,0.104,0.14,0.159,0.209c0.021,0.025,0.043,0.048,0.063,0.071 c0.042,0.053,0.087,0.106,0.132,0.152H60.936L60.936,132.339z M71.828,126.465c-0.031,0.016-0.063,0.026-0.094,0.042 c-0.051,0.029-0.104,0.06-0.155,0.089c-0.047,0.028-0.092,0.053-0.137,0.084c-0.041,0.028-0.091,0.055-0.128,0.089 c-0.049,0.036-0.102,0.071-0.146,0.104c-0.034,0.034-0.076,0.06-0.11,0.094c-0.049,0.043-0.102,0.086-0.146,0.132 c-0.033,0.031-0.064,0.061-0.1,0.093c-0.05,0.051-0.099,0.106-0.146,0.162c-0.021,0.026-0.041,0.046-0.063,0.07v-1.622h1.99v0.389 c-0.006,0.002-0.01,0.002-0.014,0.003C72.318,126.257,72.064,126.346,71.828,126.465z M69.911,128.701 c-0.011,0.031-0.017,0.066-0.026,0.101c-0.022,0.081-0.048,0.164-0.061,0.247c-0.019,0.066-0.024,0.133-0.031,0.2 c-0.01,0.053-0.02,0.108-0.027,0.16c-0.012,0.123-0.019,0.247-0.019,0.372c0,0.104,0.007,0.207,0.017,0.312 c0,0.02,0,0.035,0.002,0.057c0.004,0.045,0.014,0.09,0.021,0.138l0,0c0.004,0.021,0.007,0.042,0.007,0.064h-1.751v-1.991h1.991l0,0 c-0.004,0.009-0.004,0.017-0.007,0.022C69.983,128.486,69.942,128.594,69.911,128.701z M62.927,128.36h1.992v1.991h-1.992V128.36z M62.927,125.802h1.992v1.988h-1.992V125.802z M72.591,125.231h-1.99v-1.989h1.99V125.231z M70.033,125.231h-1.99v-1.989h1.99 V125.231z M70.033,127.79h-1.99v-1.988h1.99V127.79z M65.483,125.802h1.989v1.988h-1.989V125.802z M67.472,125.231h-1.989v-1.989 h1.989V125.231z M64.917,125.231h-1.994v-1.989h1.994V125.231z M65.483,128.36h1.989v1.991h-1.989V128.36z M73.447,132.906 c-0.647,0-1.241-0.194-1.737-0.527c-0.097-0.066-0.188-0.136-0.274-0.212c-0.034-0.025-0.063-0.052-0.09-0.08 c-0.061-0.053-0.112-0.104-0.164-0.158c-0.034-0.036-0.064-0.07-0.1-0.106c-0.042-0.053-0.091-0.108-0.132-0.168 c-0.027-0.035-0.057-0.07-0.08-0.106c-0.063-0.09-0.122-0.186-0.177-0.281c-0.011-0.023-0.022-0.047-0.033-0.069 c-0.043-0.083-0.079-0.166-0.115-0.248c-0.013-0.036-0.026-0.075-0.04-0.112c-0.026-0.073-0.048-0.149-0.073-0.226 c-0.006-0.021-0.01-0.036-0.013-0.053c-0.033-0.125-0.057-0.251-0.073-0.374c-0.003-0.01-0.003-0.019-0.006-0.029 c-0.014-0.126-0.023-0.253-0.023-0.379c0-0.107,0.006-0.211,0.016-0.319c0-0.008,0.004-0.017,0.004-0.026 c0.01-0.098,0.026-0.192,0.046-0.289c0-0.01,0.004-0.017,0.007-0.026c0.02-0.097,0.043-0.188,0.073-0.282 c0.003-0.011,0.007-0.021,0.01-0.032c0.033-0.09,0.063-0.176,0.099-0.264c0.038-0.079,0.076-0.159,0.116-0.238l0.03-0.048 c0.011-0.021,0.024-0.039,0.036-0.062c0.05-0.082,0.103-0.163,0.158-0.242c0.014-0.018,0.029-0.037,0.044-0.056 c0.054-0.069,0.105-0.134,0.162-0.196c0.017-0.022,0.04-0.044,0.056-0.063c0.057-0.06,0.116-0.116,0.176-0.171 c0.021-0.021,0.043-0.037,0.066-0.058c0.07-0.06,0.143-0.116,0.219-0.172c0.01-0.01,0.021-0.017,0.035-0.026 c0.375-0.255,0.798-0.432,1.254-0.508l0.007-0.004c0.17-0.028,0.336-0.045,0.517-0.045c0.108,0,0.22,0.007,0.327,0.021 c0.018,0,0.035,0.005,0.049,0.008c0.094,0.011,0.185,0.025,0.277,0.044c0.013,0,0.025,0.008,0.034,0.008 c0.102,0.022,0.196,0.05,0.292,0.082c0.007,0,0.015,0.005,0.021,0.007c0.096,0.033,0.193,0.072,0.292,0.113 c1.079,0.493,1.834,1.583,1.834,2.846C76.569,131.506,75.166,132.906,73.447,132.906z" })
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
        wp.element.createElement("path", { fill: "#7B8080", d: "M148.875,115.62c-4.529,0-8.219,3.688-8.219,8.221c0,4.531,3.689,8.218,8.219,8.218 c4.533,0,8.221-3.687,8.221-8.218C157.096,119.308,153.409,115.62,148.875,115.62z M148.875,130.81 c-3.844,0-6.971-3.124-6.971-6.969c0-3.846,3.129-6.972,6.971-6.972s6.973,3.126,6.973,6.972 C155.848,127.686,152.721,130.81,148.875,130.81z" })
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
            wp.element.createElement("path", { fill: "#7B8080", d: "M103.953,66.806c-5.045,0-9.153,4.108-9.153,9.154c0,5.047,4.108,9.149,9.153,9.149 c5.047,0,9.153-4.104,9.153-9.149S109,66.806,103.953,66.806z M103.953,83.725c-4.28,0-7.762-3.481-7.762-7.764 c0-4.281,3.484-7.762,7.762-7.762c4.278,0,7.763,3.48,7.763,7.762C111.716,80.243,108.231,83.725,103.953,83.725z" })
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
        wp.element.createElement("path", { fill: "#7B8080", d: "M70.895,121.409l-1.711,2.459l-1.207-0.989c-0.132-0.107-0.325-0.09-0.431,0.042 c-0.107,0.129-0.089,0.319,0.042,0.433l1.462,1.199c0.056,0.045,0.124,0.07,0.195,0.07c0.014,0,0.029-0.003,0.042-0.003 c0.082-0.017,0.161-0.062,0.21-0.128l1.899-2.732c0.097-0.14,0.063-0.328-0.074-0.424 C71.182,121.236,70.992,121.271,70.895,121.409z" }),
        wp.element.createElement("path", { fill: "#7B8080", d: "M71.145,119.588v-5.961v-3.057c0-0.172-0.135-0.307-0.303-0.307h-1.529v-0.92 c0-0.169-0.139-0.303-0.306-0.303h-2.142c-0.171,0-0.307,0.134-0.307,0.303v0.92h-6.73v-0.92c0-0.169-0.138-0.303-0.306-0.303 h-2.145c-0.169,0-0.303,0.134-0.303,0.303v0.92h-1.528c-0.172,0-0.307,0.135-0.307,0.307v3.057v12.545 c0,0.169,0.135,0.309,0.307,0.309H67.2c0.613,0.385,1.335,0.607,2.113,0.607c2.191,0,3.977-1.781,3.977-3.977 C73.29,121.583,72.417,120.253,71.145,119.588z M67.167,109.652h1.533v0.918v0.916h-1.533v-0.916V109.652z M57.688,109.652h1.529 v0.918v0.916h-1.529v-0.916V109.652z M55.85,110.877h1.226v0.916c0,0.173,0.134,0.307,0.303,0.307h2.145 c0.168,0,0.306-0.134,0.306-0.307v-0.916h6.73v0.916c0,0.173,0.135,0.307,0.307,0.307h2.142c0.167,0,0.306-0.134,0.306-0.307 v-0.916h1.223v2.449H55.85V110.877z M55.85,125.868v-11.933h14.687v5.397c-0.061-0.022-0.121-0.037-0.183-0.053 c-0.057-0.015-0.115-0.03-0.171-0.041c-0.053-0.011-0.107-0.021-0.157-0.032c-0.074-0.016-0.149-0.025-0.225-0.04 c-0.041-0.003-0.082-0.01-0.128-0.013c-0.116-0.012-0.239-0.02-0.359-0.02c-0.107,0-0.206,0.008-0.306,0.02v-0.325v-0.612v-2.75 h-2.755H65.64h-2.142h-0.612h-2.143h-0.607h-2.758v2.75v0.612v2.144v0.61v2.755h2.758h0.609h2.143H63.5h2.03 c0.007,0.026,0.019,0.051,0.029,0.078c0.026,0.075,0.053,0.15,0.083,0.221c0.015,0.045,0.037,0.082,0.053,0.121 c0.037,0.074,0.07,0.153,0.115,0.232c0.015,0.031,0.037,0.061,0.052,0.093c0.046,0.081,0.093,0.16,0.143,0.233 c0.018,0.031,0.038,0.056,0.056,0.084c0.054,0.074,0.111,0.147,0.172,0.223c0.021,0.031,0.046,0.055,0.068,0.079 c0.044,0.058,0.092,0.112,0.141,0.165L55.85,125.868L55.85,125.868z M67.57,119.542c-0.032,0.021-0.067,0.03-0.1,0.046 c-0.056,0.033-0.111,0.064-0.168,0.098c-0.048,0.029-0.097,0.058-0.146,0.088c-0.046,0.035-0.097,0.063-0.14,0.099 c-0.052,0.038-0.106,0.075-0.156,0.116c-0.038,0.035-0.082,0.063-0.12,0.101c-0.054,0.046-0.109,0.093-0.157,0.142 c-0.038,0.033-0.072,0.064-0.109,0.101c-0.052,0.053-0.104,0.114-0.157,0.175c-0.021,0.025-0.045,0.051-0.067,0.075v-1.745h2.143 v0.416c-0.008,0.005-0.012,0.005-0.016,0.005C68.099,119.318,67.829,119.419,67.57,119.542z M65.508,121.951 c-0.012,0.031-0.019,0.072-0.03,0.107c-0.021,0.09-0.048,0.178-0.064,0.267c-0.017,0.071-0.025,0.143-0.033,0.218 c-0.01,0.059-0.021,0.115-0.029,0.171c-0.015,0.132-0.022,0.265-0.022,0.397c0,0.115,0.007,0.227,0.019,0.338 c0,0.023,0,0.037,0.003,0.06c0.004,0.05,0.015,0.099,0.022,0.15l0,0c0.003,0.021,0.007,0.045,0.007,0.065h-1.884v-2.142h2.142 l0,0c-0.003,0.008-0.003,0.019-0.007,0.024C65.586,121.72,65.544,121.833,65.508,121.951z M57.991,121.583h2.146v2.142h-2.146 V121.583z M57.991,118.83h2.146v2.143h-2.146V118.83z M68.395,118.217h-2.143v-2.143h2.143V118.217z M65.64,118.217h-2.142 v-2.143h2.142V118.217z M65.64,120.973h-2.142v-2.144h2.142V120.973z M60.745,118.83h2.143v2.143h-2.143V118.83z M62.888,118.217 h-2.143v-2.143h2.143V118.217z M60.135,118.217h-2.146v-2.143h2.146V118.217z M60.745,121.583h2.143v2.142h-2.143V121.583z M69.313,126.482c-0.694,0-1.334-0.211-1.87-0.573c-0.104-0.07-0.202-0.142-0.295-0.224c-0.037-0.028-0.067-0.058-0.097-0.084 c-0.063-0.059-0.121-0.115-0.174-0.174c-0.037-0.037-0.071-0.074-0.108-0.113c-0.045-0.058-0.097-0.116-0.142-0.184 c-0.03-0.037-0.06-0.076-0.086-0.115c-0.068-0.099-0.132-0.199-0.189-0.304c-0.011-0.024-0.026-0.049-0.036-0.075 c-0.046-0.089-0.086-0.178-0.125-0.265c-0.016-0.042-0.03-0.083-0.042-0.119c-0.03-0.082-0.054-0.164-0.08-0.247 c-0.007-0.021-0.011-0.037-0.014-0.057c-0.037-0.133-0.06-0.266-0.078-0.401c-0.004-0.009-0.004-0.021-0.007-0.03 c-0.015-0.137-0.025-0.271-0.025-0.408c0-0.116,0.006-0.229,0.018-0.344c0-0.009,0.004-0.021,0.004-0.031 c0.011-0.103,0.029-0.203,0.048-0.311c0-0.011,0.003-0.018,0.007-0.027c0.022-0.104,0.046-0.203,0.079-0.304 c0.004-0.011,0.008-0.021,0.012-0.034c0.037-0.094,0.066-0.191,0.107-0.281c0.039-0.086,0.083-0.172,0.125-0.256l0.033-0.056 c0.01-0.021,0.025-0.043,0.039-0.063c0.052-0.09,0.111-0.178,0.171-0.26c0.015-0.021,0.029-0.043,0.045-0.062 c0.057-0.074,0.115-0.146,0.175-0.213c0.018-0.022,0.042-0.047,0.06-0.068c0.061-0.063,0.125-0.125,0.19-0.182 c0.022-0.021,0.046-0.043,0.072-0.063c0.074-0.064,0.153-0.125,0.236-0.182c0.01-0.012,0.021-0.023,0.035-0.031 c0.403-0.275,0.859-0.466,1.35-0.548l0.007-0.004c0.183-0.03,0.364-0.045,0.557-0.045c0.117,0,0.236,0.005,0.353,0.017 c0.018,0,0.036,0.008,0.052,0.012c0.101,0.012,0.2,0.025,0.299,0.045c0.016,0.006,0.026,0.01,0.037,0.014 c0.109,0.021,0.211,0.051,0.314,0.085c0.007,0.004,0.015,0.008,0.022,0.008c0.104,0.036,0.21,0.077,0.313,0.122 c1.162,0.531,1.974,1.705,1.974,3.063C72.678,124.97,71.167,126.482,69.313,126.482z" })
      ),
      wp.element.createElement("rect", { x: "78.641", y: "115.046", fill: "#7B8080", width: "108.046", height: "5.401" })
    )
  )
);

var sliderArrow1 = wp.element.createElement(
  "svg",
  { version: "1.1", id: "sliderArrow1", x: "0px", y: "0px", width: "315px", height: "118px", viewBox: "0 0 315 118", enableBackground: "new 0 0 315 118" },
  wp.element.createElement("image", { id: "image0", width: "315", height: "118", x: "0", y: "0", href: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAATsAAAB2CAYAAAC3bTTBAAAABGdBTUEAALGPC/xhBQAAACBjSFJN AAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAABmJLR0QA/wD/AP+gvaeTAAAb f0lEQVR42u2de3hU1b33v789kxuCBExaQhtUUIMloDTVtEhEaZhJALkIsdpyaAhGDs1MLoSYCwl7 JpOLihJIQtPHcD0Hn0ehz+FVoZigx9YXeo4ttr498lq8vbUiOUdQSAmQy8z+vX+QhCEQSDKTrL0z 6/M863my9+xZ+a7fWr/f7L3XjWBgUvKfGf2PC+4YEGLYo92lmGn3G5tLjvc3n3k5lRPdHs8D8NCx m4PDPtxbteaiv7Uys2hz9Rki0n1ZbqQx0EnJ2Rj2j/aLd8PEU8wm05EDVYWf9TePpCxXjObmZWRS PgLj+M0jzMf3PlvQLLpsA8UsWoAvNLe0NzAQ331Co/8LoN/BrsPd8RBr2AYAzR0tmsXm2ttYW/K4 6PJJJAPBYnO93NzRksKAAg/QwdpKAP0OdtDo+wwuZo8GAGhuaX8XwA9Fl2+gKKIF+Aa9733kYUQP KBumid1/MhQQN4kumUQyYIibmL1826t994er/elKfzMahg52RD2Nrw0o2DHQozEoR0WXTSIZOFe2 36vbd1+50p+u9jdjYejHWDKZ3iM3H2PCcQJ/pCimNweWEX5HjBEApoAwUVFYBjuJYVEUPqoxNDA+ A3CMCb8bSD4mxfS/NM3TwqC7iBFDJtN7ostmaKz20nuSsirvE62ji5ScjWHMPKC33wuefnZUb58x s2HSjRCtTw8dJEPB9drT9WBmSsnZGCZafxdJWZX3We2l94jWIaxLa66tdKobUJnpUQBHDm0pSRBt DF9gZrLayv4L4E9gMhU3Vq/7oMfnoiX2GdkbKxZLZnksPJ4ygO5oqC2eSkTiDe4DczJc/xvAA0T8 b2bA+Zva9f8lQoeQFpOUVXmfx+1+F7h8B0Um5YHG6uLfi9DjD+ZklC0GtH8DACJoAL08PuK7K3c6 VrQC+ggQfUUGOzGkOnaEnjx9YhvAj1/uYFAePbSleJ9obQPFklk2gz3akctniE1mc/wbmwv/ONRa hHRQdBb0yBUnPdrTIrT4DeKirj+ZoTD4lq5AJ5H0hZ2OFa0MvuWKnlSvdmVIrvbrIyICHSCwN5bM prVeh38kE/1KlBZfWZRdFU7gju6ygTxKEHJF65IYDyUIuQTydB0TuGNRdlW4aF0DpdOvu4NbD78f Wi0iDWHJKHUB9G7jlpL9InX4rzyu+SCUgfH7xi0lv/D+TA+Pfn1FPsaKxZLh+iUIM8AoHla+AY5v 3LK+RLQWiZ/orSdMdO+l7I01Dr6MCJD0jjToEGEkB5V3dpLhiKFnUEgkEklfkcFOIpEEBH4Jdosz Km4Z6GhviUQi6Y0FTz87anFGxS3+yMvnYPdI7vMR5+H599bzba8m26tDRBvHqCRluu6Z9/SGcaJ1 SPzH3LznxulhmpRRSbZXh7Seb3v1PDz//kju8xG+5udTsEu2V0S2tV18m8HTGHjYw80vp+zZYxJt JKORtMY1RdPwpvtC25sL1r7gc6VKxPNI7vMR7gttb2oa3rTmlE4RrcdopOzZY/Jw88sMPMzgaW1t F99OtldE+pKnT8HOrXl2MnNs1zEzL2p+53imaEMZiUeyyu7kdrwJIILBU9paLx6aX/jMGNG6JANn XkHlmLbWi4cYPAVABLfjzfmZrjtF6zISze8cz2TmRV3HzBzr1jw7fcnTp2BnVoJXEeGv3ScIDeMj vlsn2E6Gol1DHgPdj68Mvrf9XIewUeYS32k/17GWwfd2HTMwrl1DnmhdRmJ8xHfrQGjoOibCX81K 8Cpf8vQp2B2syT9hIvODIPozEQ6aKXyhnA/aP0w02t6jUl8MnzV5vWhdkoETPmvyeiK82H2C0GCi 0XbRuozETseKVjOFLyTCQRD92UTmBw/W5J/wJU+/jMxMtlffDKDtYE1mm2gj6ZXrDcR9bE1VWHN7 ywEQvdNQU+wQrVUOKvYPFpvLAeYHRwePnDcYmzgFAp2dniEHazL/IVrLsGYopz+l7NljEj0FS04X 8z+yw04/6P/nUSBGcip/Iu/sJMMROYNCIpEEBDLYSSSSgEAGO4lEEhDIYCeRSAICGewkEklAIIOd RCIJCHoNdlaba4U/VhqQSCSSoeCR3OcjrDbXit4+v+Zgpbm20qkdTP+HiM8BSuX4iO9sCsRpYHoY T9aTuZnPfdejdTg5iGoaq4reH4z/IcfZ9c6c7PJ7qYPtJiVI9XX6ksQ/XNpv98tsQCtkplFBxPdc ayNu87W+7AacABMzbga0yi9Pn/gRgIWiCxXIzC98ZkxHS0cRM2wAQuGmcABLROsKONxaCYMfdWtt P7XYSmuDRgZVHHim8IxoWYHMl6dPvALmBZeOuDN+4dGe1131GJtsL53OjMVXXETKi5AIpaNF+yEz 1gIIBQAwFs+zu6aK1hVIzLWVTsVl3whlxtqOFu2HonUFOj3jEzMWJ9tLp191Xc8T5uARXxBQRqAz AEDAuw016w6ILtBgoKpqsGgNfaWhpuggvDYbBpg8rKwRrUuvDMZ83Ev2vmKLwz821BQdFD1PuK9z ho3U3vtDQ826AwS8CwAEOkNAmTl4xBc9r7sq2L3+wtrTjVvWl4yOHDuBiNaYFHO+6ML4G1VVlfnz 579/+PDh46qqmn3PcWggUGnnn58RUSaHhdhEawokOCzERkSZAD4DrqgP3aOqqvnw4cPH58+f/76q qsNuFIZJMecT0ZrRkWMnNG5ZX/L6C2tPi9YkHFVVzVar9TgABsBJSUkf9nat6F/payWLrTzZ4WBF rnoiTqPDwYrFVp4s2gb9sUtnO2cAbLVaDfUjLxkAqqqGzp49+3N0VjoAjouL+0ZV1fBrXS+64erN YfRkFyNo1ItdVFUNj4uL+8a73c+ePftzVVVDRfukZBBQVfXmhISEJnhV+IwZM77qLdAB0mH0bBcj aNSTXVRVDZ8xY8ZX3u0/ISGhSVXVm0X7psSPqKoaER8ffxpeFT1r1qwTqqqOuN73RDdcvTmMnuxi BI16s4uqqiNmzZp1wtsP4uPjT6uqKicPDAeKioqipk+ffhZeFZyYmPhpX3qmRDdcPTqMXuxiBI16 tIuqqsGJiYmfevvD9OnTzxYVFUWJ9lWJDxQXF98eGxvbAq+KTU5OPtbX3ijRDVevDiNan1E06tEu wKXRCMnJyce8/SI2NraluLj4dmHOKhk4hYWF34uJibkIrwpduHDh0f7kIbrh6tVhROszikY92sWb Tn/o9o+YmJiLhYWF3xsyJ5X4TkFBQdzEiRPb4FWRS5cufae/+YhuuHp1GNH6jKJRj3bpSadfdPvJ xIkT2woKCuIG3UklvpOfn/9gdHR0B7wq8IknnhjQDBDRDVevDiNan1E06tEu16LTP7r9JTo6uiM/ P//BQXNSie/k5eUljRs3zo3OSiMiXr58+SsDzU90w9Wrw4jWZxSNerRLbyxfvvwVIuoOeOPGjXPn 5eUlDYKbSnwlNzd3aUREhAedlaUoCqelpW31JU/RDVevDiNan1E06tEu1yMtLW2roijdAS8iIsKT m5u71I9uKpa5uWW3itbgKzk5OSvCw8M1dFZSUFAQP/XUU1W+5iu64erVYUTrM4pGPdrlRjz11FNV QUFB3QEvPDxcy8nJWeFrvqKZm1t2K83JcGkgbgbofQX8h4ba9Yaa+J+ZmWnfvn375paWFgKAkJAQ pKWlldXV1ZX4mrc/Gs9Q4XRC+cOpyju+FRn19x1qqk8LrQ6HxTt91bjCuTP0q1NNE+6PLPxEVaGJ Lq+/7NIXVq9e7dq+fXtxW1sbAGDkyJGclpaWVV1dXSO6fP3Bait9VgPdD/C9YBqtAExghIP5IQ1Y JFpgf8jIyCjcunVrdVegGzFiBNLT0/P9EeiMgtVe5rDaXUePnC5r6YD7+H+faprue66S/z7VNL0D 7uNHTpe1WO2uo1Z7mUO0pqGirq6uJD09PX/EiEsTjFpaWmjr1q3VGRkZhaK19QcNWATmh8AIB5h6 DK6lv4oW2FdWr15dsXXr1ooLFy4AAEaNGsXp6ekZtbW1z4nWNrRwLDPiwBwGAGzS7hCtaDjQbUfm MGbEARwrWtNQUltb+1x6enrGqFGjGAAuXLiArVu3VqxevbpCtLa+c2U8UwjkufwZPux3fgJIT0+v qa+vL+y6zR4zZgyvXLny55s3b/6laG1DDRN94n2ssQx2/qCnHXvaORDYvHnzL1euXPnzMWPGMAC0 tbWhvr6+MD093RiPs17xjEAeZUbkzNCgUOU2s2J+SDGbfeq9HApWrFixc9u2bTa32w0AiIyM1NLS 0pZu2rTpX/1uKyLdJ0XjKC/BIKb5vuY5HPDZtkzz4WULReMo0XUtou42bdr0r2lpaUsjIyM1AHC7 3di2bZttxYoVO0XX8Y1QzOatZsX8UFCoctuMyJnGWs5q2bJle73HAkVFRbnz8vIsonWJxJqzcZIl s3zRvILKIZvXKLrHcSg7SOYVVN5uySxfZM3ZOGnI/qkOycvLs0RFRV0xhnXZsmV7Resaljz++OMN 8BrlPWHChPb8/PyZonUFIqIDnR56gwOR/Pz8mRMmTGiHlx92+qXEXyxZsuQwvAw8adKk1oKCAtnr KAjRgU4GO3EUFBRMnzRpUiu8/LHTPyW+smDBgj/Dy7CTJ0++UFhYOFm0rkBGdKCTwU4shYWFkydP nnwBXn7Z6aeSgaCqqtl7kxAAPHXq1HPr1q0z/IwPoyM60MlgJ55169bdOnXq1HPw8s+kpKQP9byR jy673lRVDT18+PCHb7311m1d58aPH+/5wQ9+8BdFUTpE6wt09u3bFy9aw+LFi98VrSHQ0TQt6OjR o9NOnjxp6jr34x//+G8zZ8682+l0+jSLJyBQVXVkQkLCl/D6xZBJX0n0XV3nnZ1wO8h07ZSQkPCl qqojB+D+g8qw2yxXIpFIroXunq+dTmeLqqqTgoOD5WOspFcWLVr0B9EaAh35GOsnZAeFfhH9CCs7 KMRjxA4K3bNgwYI/QQ490RWiA50MdmLpZejJn0TrGhYsWbLkCIZoULFoJ5ZJJj3/IPQyqPjIILn+ 4OBwsJLq2KHbybJDNV1MdAOVSSa9BjujTRdLdewIdTi4uxOWLDbXITDfBsIEgDY01pYUixbZG8uW Ldv70ksvLe2qyKioKM+yZcvmbtiwodFf/2OwfhEHi4XZFd8OGRN+fo/6ixbRWoYrjzl/ObLtzNmb Xt1U9D+itfQHf66CkpeXZ9m9e/dvmpqaTF15/+xnP/v17t27U0SXszcsNlcZwHlg/B1Ef1OYOZGB O5gRzMDdogVej927d6ekpqbuUpRLwbqpqcm0c+fOg7m5uY+K1iaKVo+n7uypr89Zba4mq931jsVe +YBoTcMBi73yAavd9Y7V5mo6e+rrc60eT51oTaLIzc19dOfOnQe7Ap2iKEhNTd2l50AHAAzc3RnX 7mDmxCvG2RFY97uB79ixI3XlypW1ZvOlTp9Tp04p27dv/3V2dvY/idYmBpoGAAyMY0YCKW7Z5e8H SHG3MiOBgXGdZ6aJ1iSC7Ozsf9q+ffuvT506pQCA2WzGypUra3fs2JEqWtuN6BnPFK9P3AxqYWZd TiHzpr6+3p6enl4ZEhICADhz5gxt27ZtV1ZW1i9EaxtKrHnP38SMiV3HBPKMHxt9TLSu4cD4sdHH vFfxZsZEa97zN4nWNZRkZWX9Ytu2bbvOnDnTvZlVenp6ZX19vV20thvBzMSgFhDcXecUgpKqKEr8 dyKiRx2qLbmvc3FM3VNXV1f05JNPFnVtCnLu3Dmqr6/fYrPZnhatbcjQ2sYS8WECLm3EQfyxrzuL SS6xQ01tBfHHAEDABSI+DK1trGhdQ4XNZnu6vr5+y7lz57o3s3ryySeL6urqikRr6wtExIdqS+77 TkT0KEVR4glKqmhNPpOZmWkfOXJk956xISEhvHr1atdA8xPdgzaQ5HC8bZ6TXX6v1e5KFK1lOCWr 3ZU4J7v8XofjbbNoLUPZG7t69WpXSEhId4/ryJEjtczMTN3fzQUE/twkW3QDlUkmkcFuuG6SPazI zc1dGhER4UFnJSmKwmlpaf3eQEh0A5VJJlHBLi0tbauiKN2BLiIiwpObm7tUtG9LrkFeXl7SuHHj rtgUZPny5a/0Jw/RDVQmmUQEu+XLl7/ivZnVuHHj3Hl5eUmifVpyHfLz8x+Mjo7ugNco7yeeeOJA X78vuoHKJNNQB7tO/+j2l+jo6I78/PwHRfuypA8UFBTETZw4sQ1eFZiSkvK7vnxXdAOVSaahDHad ftHtJxMnTmwrKCiIE+3Dkn5QWFj4vZiYmIvwqsiFCxcevdH3RDdQmWQaqmDX6Q/d/hETE3OxsLBQ 9xMLJNeguLj49tjY2BZ4VWhycvIxVVV7XaFZdAOVSabBDnaqqirJycnHvP0iNja2pbi4eMg2WpcM AkVFRVHTp08/C6+KTUxM/FRV1eBrXS+6gcok02AGO1VVgxMTEz/19ofp06efLSoqihLtqxI/oKpq RHx8/Gl4VfCsWbNOqKo6oue1ohuoTDINVrBTVXXErFmzTnj7QXx8/GlVVSNE+6jEj6iqenNCQkIT vCp6xowZX6mqGu59negGKpNMgxHsVFUNnzFjxlfe7T8hIaFJVdWbRfumLki2V0QmZbliROvwF6qq hs6ePftzeFV4XFzcN94BT3QDlUkmfwc7VVXD4+LivvFu97Nnz/5cVVXdLtbbX5KyXDHJ9orI611z zRf1ljVl0ZaM0s0ezf03zc27RBfEXzidztaEhIRJVqv1o65zkZGR/+N0Os+K1tYXrJnlxfNslXeJ 1iEB5tkq77Jmlut2oVtvnE7n2cjIyO6FR61W60cJCQmThtMOYJqbd3k0998sGaWbLWvKoq91zVXL OVnWlEWjXfuEGd0v8E1EC9+oLXlNdIH8haqqynvvvfenixcvjp45c+adTqezexmYnrf/eiEps2Ke pnn2E8gDwitBZpTtryr+ULSuQGN+TtndHW4Ug/ETBpsUxTT/jeqiPg9aH0q8VypWVdV8+PDhj8PC wprj4uK+73Q6NdH6/EWSzbXAw/zq5XKjHcHKHY0bi7/wvu6qO7vOC66oPI3hYgOsc9dXnE6ntn// /ntnzpwZ4x3o9IrTCUVjrRIAGGxi5p92dPCzonUFIh0d/Cwz/5TBJgDQWKt0OvW/2bzT6XTPnDkz Zv/+/fcOp0DHzKQxeq5ydKBnoAN6eYylIJQQocsgn0GByyjr3PUHp9PZLlpDX/iPr8tmg3lq1zER NDNhnWhdIiEiIclMWOflGwDz1P/4umy2KD3XSz0xSnvvZztgKHAB+OzSMTQKQsk1r+0tE4utdAug /L/REXdV73U8NuyM1Bv6fYwtS2QNmxg8hYj+paGm+OeiNYnEn5vJ9BeLzbWLmZcT6BgpyG6oKXlT tD0CnRTHnuDm0x9lAtrtjbXrM651zbB5NPUXeg12AOB0/tb8+9OHV5tD6LUDz6/7XLQekYgMdnNz y251t/GCGREz6xyOh3X/GkRyCRnseqDnYCe5jMhgJzEmun+xKpFIJP5ABjuJRBIQyGAnkUgCAhns JBJJQCDf8g4yssNjcJAdFJL+Iu/sJBJJQOCXYGdZu+GmZHt1iOjCSCSS4UWyvTrEsnbDTf7Iy+dg tyi7KhytFw95+Ow+GfD6z2POvcFJma57ROuQDB5We+k9KY49wb7nFFgk26tDPHx2H1ovHlqUXRXu a34+BTvL2g3fuuBu+S0zfsSMZDeffTXVsWPYrJE12Dy2piqs+dTxV5npSFJWxcOi9Uj8jzWz/GFm OtJ86virKTkbw0TrMQqpjh2hbj77KjOSmfGjC+6W31rWbviWL3n6dmfXevFXzHz5roRhPXn6y2zR hjICC/OfG9Xcfv4NBicx802aph1IyixLFK1L4j+sdleipmkHmPkmBic1t59/Y8HTz44SrcsInDz9 ZTYY1q5jZr4HrRd/5UuePgU7E5lXEdEH3ScIDbdNjXxBtKGMQHur+34AD3SfYA7TGM8ZYbkgyY1x OFjRGM+B2ftu7oHOepfcgNumRr4AQkPXMRF9YCLzKl/y9MmxDtYUnQoJCXuYQH8B0X9SaNiSF1et 6hBtKCNwcHPRW1Bg7zom0PtmMllVFcNmrbFAxuEgzUwmK4He7z6pwP5G9bq3RGszAi+uWtVBoWFL QPSfBPpLSEjYwwdrik75kqdfBistzqi45UJwKDdUrflGtJH0xo3G2VntrkoAs0aYR83dV5V9VrRe o2CUcXaLsqvCL7jP/QbA7xpr1xeK1mM0rDkbx45ob6V9W4q+Fq1FcgP6sDEKpeRsDBO9OYvRkpHo rF9jROdhjKyAQcZojmkUjHJnJ9EP8mW4RCIJCGSw8zMOBysWW8Vk0TokxsViq5jscLD0TT8j9FnA ai+7H8RjG6pL3hBtCH9gsZc9AuYKgMdT0Mg7G6rWfCMfYweH4foYa83ZOJY7Wj4G6CSIihpril8X rckv5cp0JYHpm4aa4j+I0iD014OZazQPH7TYXO9a7eXzRGrxFYvN9RJr2mvMHMuMsXCfLxWtSWJA 3OdLmTGWmWNZ016z2FwviZbkC1Z7+TyLzfWu5uGDzFwjUouwYDfHVpbCzPcDADPfr2naPmt2eZRI Y/gCMb/tfcwa/tmaUzpFtC6JcbDmlE5hDf/sfa5nuzIS1uzyKE3T9nn7+RxbWYooPUKC3aX3EVpZ j9MvN2xa1yTKEL5y67Rv7yLQF8ClvStB2K24Q5pF65IYB8Ud0gzC7q59aQn0xa3Tvr1LtK6B0unP L195VisT9T5SULAjDWbTT4iwD7i0+baisKGnmb24alUHiJ4B0WsUhGmNtSWpB2vyT4jWJTEOB2vy TzTWlqRSEKaB6DUQPWP0GUmX/ZqYCPtgNv3E4aDAnCWUlFU+zWJz6WZ3+1THjlB/rk4hevDtcE2S 3knJ2Rimp9WHLDbXuqSs8mmidRi6S4uZyWovOwrmLwD6iBT+oKFm/b/0N5+kzPIfa5pnNZhiAdzB QNahLSVb/KRRtJmGJcO1N9YfzMlwZRCwGcAnIP5AUUx1A5mTa7WXLmeNYgG+C0TRDTXFPyAiwzZo s2gBvpC05plJzPx9AN8HGKzRhwD6HexY0yYwYwlwqR6J6D7RZZNIBgoR7mNmE4AYMGJY0w4MJB9N owKA7wYAMCNpzTOTAHwiunwDxdgDFzs8V6zwS8QDekfGJvr0imOGXIZHYlh6tt+e7buvXOVPPfzN aBg72IGvND4rXwwkl2AFXo2BmMBBchltiRFJcewJJnBQV8cf0LN994Or/IkNHewM/RgbMiJ4g/tC x2sa4U6N+S5m/GUg+by+cd3JJHtZGoiOcUjIscbn886LLptEMhD2Oh5rB3CnZe2Gm6itbQqYp7y+ cd1Jqirud14M7CeivytEHymMj80jgo6LLp8v/H/2JtLuKnKEuwAAACV0RVh0ZGF0ZTpjcmVhdGUA MjAxOS0wOC0wMlQwMDo0NDo0Ni0wNzowME81FnUAAAAldEVYdGRhdGU6bW9kaWZ5ADIwMTktMDgt MDJUMDA6NDQ6NDYtMDc6MDA+aK7JAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccll PAAAAABJRU5ErkJggg==" })
);

var sliderArrow2 = wp.element.createElement(
  "svg",
  { version: "1.1", id: "sliderArrow2", x: "0px", y: "0px", width: "89.035px", height: "34.786px", viewBox: "-9.437 -4.943 89.035 34.786", enableBackground: "new -9.437 -4.943 89.035 34.786" },
  wp.element.createElement("rect", { x: "-9.437", y: "-4.943", fill: "#FFFFFF", width: "89.035", height: "34.786" }),
  wp.element.createElement("path", { fill: "#7B8080", d: "M51.233,19.948c-0.175,0-0.355-0.068-0.491-0.204c-0.271-0.271-0.271-0.714,0-0.983l6.302-6.311L50.742,6.14 c-0.271-0.272-0.271-0.712,0-0.983c0.272-0.272,0.713-0.272,0.985,0l6.792,6.799c0.272,0.273,0.272,0.714,0,0.985l-6.792,6.8 C51.59,19.879,51.414,19.948,51.233,19.948z" }),
  wp.element.createElement("path", { fill: "#7B8080", d: "M18.924,4.954c0.177,0,0.356,0.067,0.492,0.205c0.271,0.27,0.271,0.711,0,0.983l-6.302,6.309l6.302,6.309 c0.271,0.271,0.271,0.712,0,0.981c-0.272,0.272-0.713,0.272-0.985,0l-6.792-6.798c-0.271-0.273-0.271-0.714,0-0.984l6.792-6.798 C18.566,5.021,18.746,4.954,18.924,4.954z" })
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
        wp.element.createElement("path", { fill: "#7B8080", d: "M61.281,30.978c-8.479,0-15.378-6.898-15.378-15.378c0-8.48,6.898-15.379,15.378-15.379 c8.48,0,15.379,6.898,15.379,15.379C76.66,24.08,69.761,30.978,61.281,30.978z M61.281,1.264 c-7.904,0-14.335,6.431-14.335,14.336c0,7.903,6.431,14.335,14.335,14.335c7.906,0,14.336-6.432,14.336-14.335 C75.617,7.695,69.187,1.264,61.281,1.264z" }),
        wp.element.createElement("path", { fill: "#7B8080", d: "M59.35,21c-0.133,0-0.267-0.051-0.368-0.154c-0.203-0.201-0.203-0.533,0-0.736l4.726-4.731l-4.726-4.73 c-0.203-0.204-0.203-0.534,0-0.737c0.204-0.204,0.534-0.204,0.738,0l5.093,5.099c0.204,0.204,0.204,0.534,0,0.738l-5.093,5.099 C59.618,20.949,59.484,21,59.35,21z" })
      )
    ),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement("path", { fill: "#7B8080", d: "M15.378,0c8.48,0,15.379,6.898,15.379,15.378c0,8.481-6.898,15.379-15.379,15.379 C6.898,30.757,0,23.859,0,15.378C0,6.898,6.898,0,15.378,0z M15.378,29.714c7.904,0,14.336-6.432,14.336-14.336 c0-7.903-6.432-14.335-14.336-14.335c-7.905,0-14.335,6.432-14.335,14.335C1.043,23.283,7.473,29.714,15.378,29.714z" }),
        wp.element.createElement("path", { fill: "#7B8080", d: "M17.31,9.979c0.133,0,0.267,0.05,0.368,0.153c0.204,0.203,0.204,0.534,0,0.737L12.953,15.6l4.725,4.729 c0.203,0.204,0.203,0.535,0,0.738c-0.204,0.203-0.534,0.203-0.737,0l-5.093-5.099c-0.204-0.204-0.204-0.534,0-0.738l5.093-5.098 C17.042,10.029,17.176,9.979,17.31,9.979z" })
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
      wp.element.createElement("path", { fill: "#7B8080", d: "M72.626,6.412L65.75,0.144c-0.191-0.155-0.4-0.185-0.627-0.09c-0.227,0.096-0.34,0.269-0.34,0.52v4.011 H42.436c-0.168,0-0.305,0.055-0.412,0.162s-0.161,0.244-0.161,0.411v3.439c0,0.166,0.054,0.305,0.161,0.41 c0.107,0.107,0.244,0.162,0.412,0.162h22.348v4.012c0,0.238,0.113,0.412,0.34,0.518c0.227,0.096,0.436,0.061,0.627-0.105 l6.876-6.34c0.12-0.119,0.179-0.263,0.179-0.43C72.805,6.668,72.745,6.531,72.626,6.412z" })
    ),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("path", { fill: "#7B8080", d: "M0.179,7.339l6.876,6.267c0.191,0.156,0.4,0.186,0.627,0.09s0.34-0.268,0.34-0.52v-4.01h22.348 c0.168,0,0.305-0.055,0.412-0.162s0.161-0.244,0.161-0.412V5.155c0-0.166-0.054-0.305-0.161-0.411 c-0.107-0.107-0.244-0.161-0.412-0.161H8.021V0.571c0-0.238-0.113-0.412-0.34-0.519c-0.227-0.096-0.436-0.06-0.627,0.106 l-6.876,6.34C0.059,6.618,0,6.761,0,6.928C0,7.083,0.06,7.22,0.179,7.339z" })
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
      wp.element.createElement("path", { fill: "#7B8080", d: "M38.448,25.207c0,1.605-1.636,2.908-3.654,2.908H3.654C1.636,28.115,0,26.812,0,25.207V2.907 C0,1.302,1.636,0,3.654,0h31.14c2.019,0,3.654,1.302,3.654,2.907V25.207z" }),
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement("path", { fill: "#FFFFFF", d: "M26.346,13.383H13.731l3.01-3.01c0.264-0.264,0.264-0.691,0-0.955s-0.691-0.264-0.954,0l-4.162,4.162 c-0.264,0.264-0.264,0.691,0,0.955l4.162,4.162c0.132,0.133,0.305,0.199,0.478,0.199c0.172,0,0.345-0.066,0.477-0.199 c0.264-0.264,0.264-0.691,0-0.953l-3.01-3.012h12.614c0.372,0,0.675-0.301,0.675-0.674S26.718,13.383,26.346,13.383z" })
      )
    ),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("path", { fill: "#7B8080", d: "M95.715,25.207c0,1.605-1.636,2.908-3.654,2.908h-31.14c-2.019,0-3.654-1.303-3.654-2.908V2.907 C57.267,1.302,58.902,0,60.921,0h31.14c2.019,0,3.654,1.302,3.654,2.907V25.207z" }),
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement("path", { fill: "#FFFFFF", d: "M69.368,14.734h12.615l-3.01,3.01c-0.264,0.264-0.264,0.691,0,0.955s0.691,0.264,0.953,0l4.162-4.163 c0.264-0.264,0.264-0.691,0-0.955l-4.162-4.162C79.796,9.286,79.622,9.22,79.45,9.22s-0.346,0.066-0.477,0.199 c-0.264,0.264-0.264,0.691,0,0.953l3.01,3.012H69.368c-0.371,0-0.674,0.301-0.674,0.674S68.997,14.734,69.368,14.734z" })
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
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M69.458,23.952c-0.157,0-0.316-0.06-0.437-0.182c-0.241-0.24-0.241-0.635,0-0.875l5.607-5.614 l-5.607-5.613c-0.241-0.242-0.241-0.634,0-0.875c0.242-0.242,0.634-0.242,0.876,0l6.043,6.05c0.242,0.242,0.242,0.634,0,0.876 l-6.043,6.049C69.775,23.892,69.617,23.952,69.458,23.952z" })
    ),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("circle", { fill: "#7B8080", cx: "17.283", cy: "17.503", r: "17.283" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M19.573,10.875c0.158,0,0.317,0.06,0.438,0.182c0.241,0.24,0.241,0.633,0,0.875l-5.607,5.614l5.607,5.612 c0.241,0.242,0.241,0.634,0,0.874c-0.242,0.242-0.634,0.242-0.876,0l-6.043-6.049c-0.242-0.243-0.242-0.634,0-0.875l6.043-6.049 C19.255,10.934,19.415,10.875,19.573,10.875z" })
    )
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
        wp.element.createElement("path", { fill: "#FFFFFF", d: "M185.467,50.069h-35.756c-0.354,0-0.639,0.318-0.639,0.71v31.25c0,0.394,0.285,0.71,0.639,0.71h35.756 c0.354,0,0.641-0.317,0.641-0.71V50.779C186.106,50.387,185.819,50.069,185.467,50.069z M184.828,81.319h-34.48v-29.83h34.48 V81.319L184.828,81.319z" }),
        wp.element.createElement("path", { fill: "#FFFFFF", d: "M159.288,65.792c1.961,0,3.557-1.775,3.557-3.955c0-2.182-1.596-3.956-3.557-3.956 s-3.557,1.774-3.557,3.956C155.731,64.017,157.328,65.792,159.288,65.792z M159.288,59.301c1.256,0,2.278,1.138,2.278,2.535 c0,1.397-1.021,2.536-2.278,2.536s-2.279-1.137-2.279-2.534S158.032,59.301,159.288,59.301z" }),
        wp.element.createElement("path", { fill: "#FFFFFF", d: "M153.542,78.479c0.147,0,0.299-0.059,0.421-0.177l10.417-10.201l6.578,7.316 c0.25,0.277,0.654,0.277,0.9,0c0.252-0.278,0.252-0.727,0-1.004l-3.066-3.415l5.863-7.14l7.189,7.331 c0.258,0.266,0.662,0.246,0.9-0.043c0.238-0.291,0.221-0.739-0.037-1.003l-7.664-7.813c-0.127-0.127-0.293-0.191-0.459-0.186 c-0.17,0.008-0.33,0.091-0.445,0.23l-6.252,7.619l-3.028-3.369c-0.239-0.265-0.621-0.278-0.875-0.033l-10.866,10.641 c-0.265,0.259-0.291,0.708-0.058,1.003C153.187,78.398,153.364,78.479,153.542,78.479z" })
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
    wp.element.createElement("path", { fill: "#FFFFFF", d: "M199.842,19.885H134.16c-0.647,0-1.173,0.524-1.173,1.172v51.607c0,0.649,0.524,1.173,1.173,1.173h65.682 c0.646,0,1.173-0.524,1.173-1.173V21.057C201.014,20.409,200.488,19.885,199.842,19.885z M198.668,71.491h-63.335V22.23h63.335 V71.491L198.668,71.491z" }),
    wp.element.createElement("path", { fill: "#FFFFFF", d: "M151.753,45.85c3.603,0,6.532-2.93,6.532-6.53c0-3.603-2.93-6.532-6.532-6.532 c-3.602,0-6.531,2.929-6.531,6.531C145.222,42.92,148.151,45.85,151.753,45.85z M151.753,35.132c2.309,0,4.187,1.879,4.187,4.186 s-1.878,4.186-4.187,4.186s-4.186-1.878-4.186-4.185C147.567,37.013,149.444,35.132,151.753,35.132z" }),
    wp.element.createElement("path", { fill: "#FFFFFF", d: "M141.197,66.8c0.274,0,0.551-0.096,0.774-0.292l19.133-16.845l12.083,12.082 c0.459,0.458,1.201,0.458,1.658,0c0.459-0.459,0.459-1.2,0-1.658l-5.638-5.639l10.769-11.792l13.207,12.107 c0.479,0.438,1.219,0.405,1.657-0.072c0.438-0.478,0.404-1.22-0.071-1.657l-14.076-12.902c-0.23-0.209-0.535-0.314-0.844-0.307 c-0.312,0.014-0.604,0.151-0.814,0.381l-11.487,12.582l-5.563-5.563c-0.438-0.437-1.14-0.459-1.604-0.052l-19.959,17.573 c-0.485,0.429-0.533,1.169-0.105,1.656C140.548,66.667,140.872,66.8,141.197,66.8z" })
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
        wp.element.createElement("path", { fill: "#7B8080", d: "M123.947,172.862l-1.591,2.284l-1.123-0.922c-0.119-0.101-0.3-0.082-0.397,0.039 c-0.099,0.12-0.084,0.299,0.037,0.4l1.359,1.116c0.051,0.04,0.114,0.063,0.181,0.063c0.014,0,0.026,0,0.04-0.002 c0.075-0.011,0.148-0.054,0.194-0.116l1.766-2.539c0.088-0.131,0.059-0.308-0.07-0.395 C124.211,172.7,124.037,172.732,123.947,172.862z" }),
        wp.element.createElement("path", { fill: "#7B8080", d: "M124.18,171.171v-5.539v-2.843c0-0.156-0.126-0.282-0.282-0.282h-1.42v-0.854 c0-0.158-0.128-0.284-0.286-0.284h-1.989c-0.158,0-0.284,0.126-0.284,0.284v0.854h-6.252v-0.854c0-0.158-0.13-0.284-0.284-0.284 h-1.995c-0.156,0-0.279,0.126-0.279,0.284v0.854h-1.423c-0.158,0-0.284,0.126-0.284,0.282v2.843v11.654 c0,0.157,0.126,0.284,0.284,0.284h10.831c0.568,0.357,1.239,0.568,1.962,0.568c2.034,0,3.694-1.658,3.694-3.694 C126.169,173.023,125.359,171.785,124.18,171.171z M120.484,161.938h1.423v0.854v0.853h-1.423v-0.853V161.938z M111.676,161.938 h1.421v0.854v0.853h-1.421v-0.853V161.938z M109.967,163.077h1.139v0.853c0,0.157,0.125,0.284,0.281,0.284h1.995 c0.154,0,0.284-0.127,0.284-0.284v-0.853h6.252v0.853c0,0.157,0.126,0.284,0.284,0.284h1.989c0.158,0,0.285-0.127,0.285-0.284 v-0.853h1.137v2.274h-13.646V163.077L109.967,163.077z M109.967,177.003v-11.084h13.646v5.013 c-0.056-0.019-0.112-0.033-0.171-0.045c-0.053-0.019-0.107-0.029-0.16-0.041c-0.048-0.014-0.1-0.022-0.146-0.029 c-0.07-0.016-0.14-0.024-0.208-0.034c-0.039-0.005-0.076-0.011-0.119-0.015c-0.107-0.011-0.221-0.018-0.333-0.018 c-0.1,0-0.19,0.007-0.285,0.018v-0.302v-0.569v-2.558h-2.56h-0.568h-1.99h-0.57h-1.989h-0.565h-2.563v2.558v0.569v1.988v0.569 v2.56h2.563h0.565h1.989h0.57h1.887c0.006,0.024,0.016,0.047,0.027,0.075c0.023,0.066,0.049,0.137,0.076,0.204 c0.014,0.038,0.035,0.075,0.047,0.11c0.035,0.07,0.067,0.144,0.108,0.215c0.016,0.03,0.035,0.057,0.05,0.086 c0.042,0.076,0.087,0.149,0.13,0.222c0.02,0.024,0.038,0.048,0.054,0.075c0.05,0.07,0.104,0.14,0.159,0.209 c0.021,0.025,0.043,0.048,0.063,0.07c0.042,0.053,0.087,0.106,0.132,0.152L109.967,177.003L109.967,177.003z M120.859,171.129 c-0.031,0.016-0.063,0.026-0.094,0.042c-0.051,0.029-0.104,0.06-0.155,0.089c-0.047,0.028-0.092,0.053-0.137,0.084 c-0.041,0.028-0.091,0.055-0.128,0.09c-0.049,0.035-0.102,0.07-0.146,0.104c-0.034,0.034-0.076,0.061-0.11,0.094 c-0.049,0.043-0.102,0.086-0.146,0.133c-0.033,0.03-0.064,0.061-0.1,0.092c-0.05,0.052-0.099,0.106-0.146,0.162 c-0.021,0.026-0.041,0.047-0.063,0.07v-1.622h1.99v0.39c-0.006,0.002-0.01,0.002-0.014,0.002 C121.349,170.921,121.095,171.01,120.859,171.129z M118.942,173.365c-0.011,0.031-0.017,0.066-0.026,0.101 c-0.022,0.081-0.048,0.164-0.061,0.247c-0.019,0.066-0.024,0.133-0.031,0.2c-0.01,0.053-0.02,0.108-0.027,0.16 c-0.012,0.123-0.019,0.247-0.019,0.372c0,0.104,0.007,0.207,0.017,0.312c0,0.021,0,0.035,0.002,0.058 c0.004,0.045,0.014,0.09,0.021,0.138l0,0c0.004,0.021,0.007,0.042,0.007,0.063h-1.751v-1.99h1.991l0,0 c-0.004,0.009-0.004,0.017-0.007,0.021C119.014,173.15,118.973,173.258,118.942,173.365z M111.958,173.023h1.992v1.992h-1.992 V173.023z M111.958,170.466h1.992v1.988h-1.992V170.466z M121.622,169.895h-1.99v-1.988h1.99V169.895z M119.064,169.895h-1.99 v-1.988h1.99V169.895z M119.064,172.454h-1.99v-1.988h1.99V172.454z M114.514,170.466h1.989v1.988h-1.989V170.466z M116.503,169.895h-1.989v-1.988h1.989V169.895z M113.948,169.895h-1.994v-1.988h1.994V169.895z M114.514,173.023h1.989v1.992 h-1.989V173.023z M122.478,177.57c-0.647,0-1.241-0.194-1.737-0.527c-0.097-0.066-0.188-0.136-0.274-0.212 c-0.034-0.024-0.063-0.052-0.09-0.08c-0.061-0.053-0.112-0.104-0.164-0.157c-0.034-0.037-0.064-0.07-0.1-0.106 c-0.042-0.054-0.091-0.108-0.132-0.168c-0.027-0.035-0.057-0.07-0.08-0.106c-0.063-0.09-0.122-0.186-0.177-0.281 c-0.011-0.022-0.022-0.047-0.033-0.068c-0.043-0.083-0.079-0.166-0.115-0.248c-0.013-0.036-0.026-0.075-0.04-0.112 c-0.026-0.073-0.048-0.149-0.073-0.226c-0.006-0.021-0.01-0.036-0.013-0.053c-0.033-0.125-0.057-0.252-0.073-0.375 c-0.003-0.01-0.003-0.019-0.006-0.028c-0.014-0.126-0.023-0.253-0.023-0.38c0-0.106,0.006-0.211,0.016-0.318 c0-0.008,0.004-0.018,0.004-0.025c0.01-0.099,0.026-0.192,0.046-0.289c0-0.011,0.004-0.018,0.007-0.026 c0.02-0.097,0.043-0.188,0.073-0.282c0.003-0.011,0.007-0.021,0.01-0.031c0.033-0.091,0.063-0.177,0.099-0.265 c0.038-0.079,0.076-0.159,0.116-0.238l0.03-0.048c0.011-0.021,0.024-0.039,0.036-0.063c0.05-0.082,0.103-0.162,0.158-0.241 c0.014-0.019,0.029-0.037,0.044-0.056c0.054-0.069,0.105-0.135,0.162-0.196c0.017-0.022,0.04-0.044,0.056-0.063 c0.057-0.06,0.116-0.115,0.176-0.171c0.021-0.021,0.043-0.037,0.066-0.058c0.07-0.061,0.143-0.116,0.219-0.172 c0.01-0.01,0.021-0.018,0.035-0.026c0.375-0.255,0.798-0.433,1.254-0.508l0.007-0.005c0.17-0.027,0.336-0.045,0.517-0.045 c0.108,0,0.22,0.008,0.327,0.021c0.018,0,0.035,0.005,0.049,0.008c0.094,0.012,0.185,0.025,0.277,0.045 c0.013,0,0.025,0.008,0.034,0.008c0.102,0.021,0.196,0.05,0.292,0.082c0.007,0,0.015,0.004,0.021,0.006 c0.096,0.033,0.193,0.072,0.292,0.113c1.079,0.493,1.834,1.584,1.834,2.847C125.6,176.17,124.197,177.57,122.478,177.57z" })
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
            wp.element.createElement("path", { fill: "#7B8080", d: "M197.906,160.284c-4.529,0-8.219,3.688-8.219,8.221c0,4.531,3.689,8.218,8.219,8.218 c4.533,0,8.221-3.687,8.221-8.218C206.127,163.973,202.44,160.284,197.906,160.284z M197.906,175.475 c-3.844,0-6.971-3.125-6.971-6.97c0-3.846,3.129-6.972,6.971-6.972s6.973,3.126,6.973,6.972 C204.879,172.35,201.752,175.475,197.906,175.475z" })
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
    wp.element.createElement("path", { fill: "#FFFFFF", d: "M200.207,96.579h-65.682c-0.647,0-1.173,0.524-1.173,1.173v51.606c0,0.649,0.524,1.173,1.173,1.173h65.682 c0.646,0,1.172-0.523,1.172-1.173V97.752C201.379,97.104,200.854,96.579,200.207,96.579z M199.033,148.186h-63.335V98.925h63.335 V148.186L199.033,148.186z" }),
    wp.element.createElement("path", { fill: "#FFFFFF", d: "M152.118,122.545c3.603,0,6.532-2.931,6.532-6.53c0-3.604-2.93-6.532-6.532-6.532 c-3.602,0-6.531,2.929-6.531,6.531C145.586,119.614,148.516,122.545,152.118,122.545z M152.118,111.826 c2.309,0,4.187,1.879,4.187,4.187c0,2.307-1.878,4.186-4.187,4.186s-4.186-1.878-4.186-4.185 C147.932,113.708,149.809,111.826,152.118,111.826z" }),
    wp.element.createElement("path", { fill: "#FFFFFF", d: "M141.562,143.494c0.274,0,0.551-0.096,0.774-0.292l19.133-16.845l12.083,12.082 c0.459,0.458,1.201,0.458,1.658,0c0.459-0.459,0.459-1.2,0-1.658l-5.639-5.639l10.77-11.792l13.207,12.107 c0.479,0.438,1.219,0.404,1.656-0.072c0.439-0.479,0.404-1.22-0.07-1.657l-14.076-12.902c-0.23-0.209-0.535-0.313-0.844-0.307 c-0.313,0.014-0.605,0.151-0.814,0.381l-11.488,12.582l-5.563-5.563c-0.438-0.438-1.14-0.459-1.604-0.053l-19.959,17.573 c-0.485,0.429-0.533,1.169-0.105,1.656C140.913,143.361,141.237,143.494,141.562,143.494z" })
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
    wp.element.createElement("path", { fill: "#FFFFFF", d: "M199.842,21.885H134.16c-0.647,0-1.174,0.524-1.174,1.172v51.607c0,0.649,0.524,1.173,1.174,1.173h65.682 c0.646,0,1.173-0.524,1.173-1.173V23.057C201.014,22.409,200.488,21.885,199.842,21.885z M198.668,73.491h-63.335V24.23h63.335 V73.491L198.668,73.491z" }),
    wp.element.createElement("path", { fill: "#FFFFFF", d: "M151.753,47.85c3.603,0,6.532-2.93,6.532-6.53c0-3.603-2.931-6.532-6.532-6.532 c-3.603,0-6.531,2.929-6.531,6.531C145.222,44.92,148.151,47.85,151.753,47.85z M151.753,37.132c2.309,0,4.187,1.879,4.187,4.186 s-1.878,4.186-4.187,4.186c-2.31,0-4.187-1.878-4.187-4.185C147.567,39.013,149.444,37.132,151.753,37.132z" }),
    wp.element.createElement("path", { fill: "#FFFFFF", d: "M141.197,68.8c0.274,0,0.552-0.096,0.774-0.292l19.133-16.845l12.083,12.082 c0.459,0.458,1.201,0.458,1.658,0c0.459-0.459,0.459-1.2,0-1.658l-5.638-5.639l10.769-11.792l13.207,12.107 c0.479,0.438,1.219,0.405,1.657-0.072c0.438-0.478,0.404-1.22-0.071-1.657l-14.076-12.902c-0.229-0.209-0.534-0.314-0.844-0.307 c-0.312,0.014-0.604,0.151-0.813,0.381l-11.487,12.582l-5.563-5.563c-0.438-0.437-1.14-0.459-1.604-0.052l-19.959,17.573 c-0.485,0.429-0.533,1.169-0.105,1.656C140.548,68.667,140.872,68.8,141.197,68.8z" })
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
        wp.element.createElement("path", { fill: "#FFFFFF", d: "M55.298,96.012H37.134c-0.179,0-0.324,0.144-0.324,0.324v14.271c0,0.18,0.145,0.324,0.324,0.324h18.164 c0.178,0,0.324-0.145,0.324-0.324V96.335C55.622,96.156,55.476,96.012,55.298,96.012z M54.973,110.283H37.458V96.66h17.515 V110.283L54.973,110.283z" }),
        wp.element.createElement("path", { fill: "#FFFFFF", d: "M41.999,103.192c0.996,0,1.807-0.811,1.807-1.806c0-0.997-0.811-1.807-1.807-1.807 s-1.806,0.811-1.806,1.807C40.193,102.381,41.003,103.192,41.999,103.192z M41.999,100.228c0.639,0,1.157,0.52,1.157,1.157 c0,0.638-0.519,1.158-1.157,1.158s-1.157-0.52-1.157-1.158C40.842,100.748,41.36,100.228,41.999,100.228z" }),
        wp.element.createElement("path", { fill: "#FFFFFF", d: "M39.079,108.985c0.077,0,0.153-0.026,0.215-0.08l5.291-4.658l3.342,3.341 c0.126,0.126,0.332,0.126,0.458,0c0.127-0.127,0.127-0.333,0-0.459l-1.56-1.56l2.979-3.261l3.652,3.349 c0.132,0.121,0.337,0.112,0.457-0.021c0.122-0.132,0.112-0.337-0.019-0.458l-3.893-3.569c-0.063-0.057-0.148-0.086-0.233-0.085 c-0.086,0.004-0.168,0.042-0.225,0.106l-3.177,3.479l-1.539-1.539c-0.12-0.121-0.315-0.127-0.443-0.015l-5.52,4.859 c-0.134,0.12-0.147,0.323-0.029,0.458C38.9,108.948,38.99,108.985,39.079,108.985z" })
      )
    ),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("rect", { x: "123.194", y: "69.527", fill: "#7B8080", width: "91.533", height: "67.889" }),
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement("path", { fill: "#FFFFFF", d: "M178.042,96.011h-18.163c-0.179,0-0.324,0.145-0.324,0.325v14.271c0,0.18,0.146,0.325,0.324,0.325h18.163 c0.18,0,0.326-0.145,0.326-0.325V96.336C178.368,96.157,178.222,96.011,178.042,96.011z M177.719,110.283h-17.515V96.66h17.515 V110.283L177.719,110.283z" }),
        wp.element.createElement("path", { fill: "#FFFFFF", d: "M164.744,103.192c0.997,0,1.807-0.811,1.807-1.805c0-0.998-0.81-1.808-1.807-1.808 c-0.996,0-1.807,0.81-1.807,1.807C162.938,102.381,163.748,103.192,164.744,103.192z M164.744,100.229 c0.64,0,1.159,0.519,1.159,1.157c0,0.638-0.52,1.158-1.159,1.158c-0.638,0-1.158-0.52-1.158-1.157 C163.586,100.748,164.106,100.229,164.744,100.229z" }),
        wp.element.createElement("path", { fill: "#FFFFFF", d: "M161.825,108.985c0.076,0,0.151-0.026,0.214-0.081l5.292-4.658l3.341,3.341 c0.128,0.127,0.333,0.127,0.458,0c0.127-0.127,0.127-0.333,0-0.459l-1.559-1.56l2.978-3.26l3.653,3.348 c0.131,0.121,0.337,0.112,0.457-0.021c0.122-0.132,0.112-0.337-0.019-0.458l-3.894-3.568c-0.063-0.058-0.147-0.087-0.232-0.085 c-0.087,0.004-0.168,0.042-0.226,0.105l-3.177,3.48l-1.539-1.539c-0.12-0.122-0.314-0.127-0.443-0.015l-5.519,4.859 c-0.135,0.119-0.148,0.323-0.029,0.458C161.646,108.948,161.735,108.985,161.825,108.985z" })
      )
    ),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("rect", { x: "242.017", y: "69.527", fill: "#7B8080", width: "91.533", height: "67.889" }),
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement("path", { fill: "#FFFFFF", d: "M296.864,96.012h-18.163c-0.18,0-0.325,0.145-0.325,0.324v14.271c0,0.179,0.146,0.324,0.325,0.324h18.163 c0.179,0,0.325-0.145,0.325-0.324V96.336C297.189,96.157,297.043,96.012,296.864,96.012z M296.54,110.283h-17.515V96.661h17.515 V110.283L296.54,110.283z" }),
        wp.element.createElement("path", { fill: "#FFFFFF", d: "M283.566,103.192c0.996,0,1.807-0.811,1.807-1.805c0-0.997-0.811-1.807-1.807-1.807 s-1.806,0.81-1.806,1.806C281.761,102.382,282.57,103.192,283.566,103.192z M283.566,100.229c0.638,0,1.158,0.519,1.158,1.157 c0,0.638-0.521,1.158-1.158,1.158c-0.639,0-1.158-0.519-1.158-1.157C282.408,100.749,282.928,100.229,283.566,100.229z" }),
        wp.element.createElement("path", { fill: "#FFFFFF", d: "M280.646,108.986c0.078,0,0.154-0.026,0.216-0.081l5.291-4.658l3.341,3.342 c0.128,0.125,0.333,0.125,0.459,0c0.126-0.127,0.126-0.333,0-0.46l-1.56-1.559l2.978-3.262l3.652,3.349 c0.132,0.122,0.338,0.111,0.458-0.02c0.122-0.132,0.112-0.337-0.019-0.458l-3.894-3.568c-0.063-0.058-0.147-0.086-0.232-0.085 c-0.087,0.004-0.168,0.042-0.225,0.106l-3.177,3.479l-1.54-1.538c-0.12-0.121-0.314-0.127-0.443-0.015l-5.519,4.859 c-0.135,0.119-0.148,0.323-0.029,0.458C280.468,108.948,280.557,108.986,280.646,108.986z" })
      )
    ),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("rect", { x: "0.611", y: "155.64", fill: "#7B8080", width: "91.533", height: "67.889" }),
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement("path", { fill: "#FFFFFF", d: "M55.46,182.125H37.296c-0.179,0-0.324,0.145-0.324,0.324v14.27c0,0.182,0.146,0.326,0.324,0.326H55.46 c0.179,0,0.324-0.145,0.324-0.326v-14.27C55.784,182.269,55.639,182.125,55.46,182.125z M55.136,196.394H37.621v-13.621h17.515 V196.394L55.136,196.394z" }),
        wp.element.createElement("path", { fill: "#FFFFFF", d: "M42.161,189.304c0.996,0,1.807-0.811,1.807-1.805c0-0.998-0.811-1.809-1.807-1.809 s-1.806,0.811-1.806,1.807S41.165,189.304,42.161,189.304z M42.161,186.341c0.64,0,1.158,0.52,1.158,1.156 c0,0.639-0.519,1.158-1.158,1.158c-0.639,0-1.158-0.52-1.158-1.158C41.003,186.861,41.522,186.341,42.161,186.341z" }),
        wp.element.createElement("path", { fill: "#FFFFFF", d: "M39.241,195.097c0.077,0,0.152-0.025,0.215-0.08l5.291-4.658l3.341,3.342 c0.128,0.127,0.333,0.127,0.459,0c0.127-0.127,0.127-0.334,0-0.459l-1.559-1.561l2.978-3.26l3.653,3.348 c0.131,0.121,0.337,0.111,0.457-0.02c0.122-0.133,0.111-0.336-0.019-0.459l-3.894-3.566c-0.063-0.059-0.147-0.088-0.232-0.086 c-0.087,0.004-0.169,0.041-0.226,0.105l-3.177,3.48l-1.539-1.539c-0.12-0.121-0.314-0.127-0.443-0.016l-5.519,4.859 c-0.135,0.119-0.148,0.322-0.029,0.459C39.063,195.06,39.152,195.097,39.241,195.097z" })
      )
    ),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("rect", { x: "125.343", y: "155.64", fill: "#7B8080", width: "91.534", height: "67.889" }),
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement("path", { fill: "#FFFFFF", d: "M180.191,182.125h-18.164c-0.178,0-0.324,0.145-0.324,0.324v14.27c0,0.182,0.146,0.326,0.324,0.326 h18.164c0.18,0,0.325-0.145,0.325-0.326v-14.27C180.517,182.271,180.371,182.125,180.191,182.125z M179.867,196.396h-17.514 v-13.621h17.514V196.396L179.867,196.396z" }),
        wp.element.createElement("path", { fill: "#FFFFFF", d: "M166.894,189.304c0.996,0,1.806-0.809,1.806-1.805s-0.81-1.807-1.806-1.807s-1.807,0.811-1.807,1.807 S165.897,189.304,166.894,189.304z M166.894,186.341c0.64,0,1.158,0.52,1.158,1.158c0,0.637-0.519,1.158-1.158,1.158 c-0.639,0-1.159-0.521-1.159-1.158C165.734,186.861,166.255,186.341,166.894,186.341z" }),
        wp.element.createElement("path", { fill: "#FFFFFF", d: "M163.974,195.099c0.076,0,0.151-0.027,0.214-0.082l5.292-4.658l3.341,3.342 c0.128,0.127,0.332,0.127,0.46,0c0.126-0.127,0.126-0.332,0-0.459l-1.56-1.559l2.977-3.262l3.653,3.35 c0.132,0.119,0.338,0.111,0.457-0.021c0.122-0.131,0.111-0.336-0.018-0.457l-3.895-3.568c-0.063-0.059-0.147-0.088-0.232-0.086 c-0.087,0.004-0.169,0.041-0.225,0.105l-3.178,3.48l-1.538-1.537c-0.12-0.123-0.314-0.129-0.444-0.018l-5.518,4.861 c-0.136,0.117-0.148,0.322-0.03,0.457C163.795,195.06,163.884,195.099,163.974,195.099z" })
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
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M61.624,26.536H41.216c-0.201,0-0.364,0.142-0.364,0.319v14.029c0,0.177,0.164,0.319,0.364,0.319h20.408 c0.2,0,0.365-0.143,0.365-0.319v-14.03C61.988,26.677,61.823,26.536,61.624,26.536z M61.258,40.565H41.581V27.173h19.678V40.565 L61.258,40.565z" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M46.682,33.594c1.119,0,2.03-0.798,2.03-1.776c0-0.979-0.911-1.775-2.03-1.775s-2.03,0.797-2.03,1.775 C44.652,32.796,45.563,33.594,46.682,33.594z M46.682,30.68c0.718,0,1.299,0.512,1.299,1.138c0,0.627-0.583,1.138-1.299,1.138 c-0.718,0-1.3-0.511-1.3-1.138C45.382,31.191,45.963,30.68,46.682,30.68z" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M43.402,39.288c0.085,0,0.171-0.025,0.241-0.077l5.945-4.58l3.754,3.284c0.142,0.124,0.373,0.124,0.515,0 c0.143-0.125,0.143-0.327,0-0.451l-1.752-1.534l3.347-3.205l4.103,3.292c0.148,0.118,0.378,0.11,0.514-0.021 c0.137-0.13,0.125-0.331-0.022-0.45l-4.374-3.508c-0.071-0.056-0.167-0.084-0.262-0.083c-0.096,0.004-0.188,0.041-0.252,0.104 l-3.569,3.42l-1.729-1.513c-0.135-0.119-0.354-0.125-0.499-0.014l-6.202,4.776c-0.15,0.119-0.165,0.317-0.032,0.451 C43.2,39.252,43.302,39.288,43.402,39.288z" })
    )
  ),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("rect", { x: "114.587", y: "0.5", fill: "#7B8080", width: "102.838", height: "66.739" }),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M176.21,26.536h-20.407c-0.201,0-0.364,0.141-0.364,0.318v14.03c0,0.176,0.163,0.318,0.364,0.318h20.407 c0.2,0,0.364-0.143,0.364-0.318v-14.03C176.574,26.677,176.41,26.536,176.21,26.536z M175.846,40.564h-19.679V27.172h19.679 V40.564L175.846,40.564z" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M161.269,33.593c1.119,0,2.029-0.797,2.029-1.776c0-0.979-0.91-1.775-2.029-1.775s-2.03,0.797-2.03,1.775 S160.15,33.593,161.269,33.593z M161.269,30.68c0.717,0,1.299,0.511,1.299,1.137c0,0.627-0.583,1.138-1.299,1.138 c-0.718,0-1.3-0.511-1.3-1.138C159.969,31.191,160.55,30.68,161.269,30.68z" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M157.988,39.287c0.086,0,0.171-0.024,0.242-0.077l5.945-4.579l3.754,3.284 c0.142,0.124,0.373,0.124,0.515,0c0.143-0.125,0.143-0.327,0-0.452l-1.752-1.534l3.346-3.205l4.104,3.292 c0.148,0.119,0.379,0.11,0.514-0.021c0.137-0.13,0.125-0.331-0.021-0.451l-4.374-3.508c-0.071-0.056-0.166-0.084-0.262-0.083 c-0.097,0.004-0.189,0.041-0.253,0.104l-3.568,3.42l-1.73-1.513c-0.134-0.119-0.354-0.125-0.498-0.015l-6.203,4.776 c-0.15,0.119-0.165,0.317-0.031,0.45C157.786,39.252,157.889,39.287,157.988,39.287z" })
    )
  ),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("rect", { x: "230.848", y: "0.5", fill: "#7B8080", width: "102.839", height: "66.739" }),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M292.472,26.536h-20.407c-0.201,0-0.365,0.141-0.365,0.318v14.03c0,0.176,0.164,0.318,0.365,0.318h20.407 c0.2,0,0.363-0.143,0.363-0.318v-14.03C292.835,26.677,292.672,26.536,292.472,26.536z M292.105,40.564h-19.678V27.172h19.678 V40.564L292.105,40.564z" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M277.53,33.593c1.119,0,2.028-0.797,2.028-1.776c0-0.979-0.909-1.775-2.028-1.775s-2.03,0.797-2.03,1.775 S276.411,33.593,277.53,33.593z M277.53,30.68c0.717,0,1.299,0.511,1.299,1.137c0,0.627-0.583,1.138-1.299,1.138 c-0.718,0-1.301-0.511-1.301-1.138C276.229,31.191,276.811,30.68,277.53,30.68z" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M274.249,39.287c0.086,0,0.171-0.024,0.241-0.077l5.944-4.579l3.755,3.284 c0.142,0.124,0.373,0.124,0.515,0c0.143-0.125,0.143-0.327,0-0.452l-1.753-1.534l3.347-3.205l4.104,3.292 c0.149,0.119,0.38,0.11,0.514-0.021c0.137-0.13,0.125-0.331-0.021-0.451l-4.374-3.508c-0.071-0.056-0.166-0.084-0.262-0.083 c-0.097,0.004-0.188,0.041-0.253,0.104l-3.568,3.42l-1.729-1.513c-0.134-0.119-0.354-0.125-0.497-0.015l-6.203,4.776 c-0.15,0.119-0.165,0.317-0.031,0.45C274.047,39.252,274.149,39.287,274.249,39.287z" })
    )
  ),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("rect", { y: "78.621", fill: "#7B8080", width: "102.838", height: "66.739" }),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M61.624,104.657H41.216c-0.201,0-0.364,0.141-0.364,0.318v14.028c0,0.178,0.164,0.319,0.364,0.319h20.408 c0.2,0,0.365-0.144,0.365-0.319v-14.03C61.988,104.798,61.823,104.657,61.624,104.657z M61.258,118.687H41.581v-13.393h19.678 V118.687L61.258,118.687z" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M46.682,111.716c1.119,0,2.03-0.798,2.03-1.776c0-0.98-0.911-1.776-2.03-1.776s-2.03,0.797-2.03,1.776 C44.652,110.917,45.563,111.716,46.682,111.716z M46.682,108.801c0.718,0,1.299,0.512,1.299,1.137 c0,0.627-0.583,1.138-1.299,1.138c-0.718,0-1.3-0.511-1.3-1.138C45.382,109.313,45.963,108.801,46.682,108.801z" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M43.402,117.409c0.085,0,0.171-0.025,0.241-0.077l5.945-4.579l3.754,3.283 c0.142,0.124,0.373,0.124,0.515,0c0.143-0.124,0.143-0.327,0-0.451l-1.752-1.533l3.347-3.206l4.103,3.293 c0.148,0.118,0.378,0.11,0.514-0.021c0.137-0.129,0.125-0.331-0.022-0.45l-4.374-3.508c-0.071-0.056-0.167-0.083-0.262-0.083 c-0.096,0.004-0.188,0.041-0.252,0.104l-3.569,3.42l-1.729-1.513c-0.135-0.119-0.354-0.125-0.499-0.014l-6.202,4.776 c-0.15,0.118-0.165,0.316-0.032,0.45C43.2,117.374,43.302,117.409,43.402,117.409z" })
    )
  ),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("rect", { x: "115.587", y: "78.621", fill: "#7B8080", width: "102.838", height: "66.74" }),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M177.21,104.656h-20.407c-0.201,0-0.364,0.142-0.364,0.318v14.029c0,0.177,0.163,0.318,0.364,0.318h20.407 c0.2,0,0.364-0.143,0.364-0.318v-14.03C177.574,104.798,177.41,104.656,177.21,104.656z M176.846,118.686h-19.679v-13.392h19.679 V118.686L176.846,118.686z" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M162.269,111.714c1.119,0,2.029-0.796,2.029-1.775c0-0.979-0.91-1.776-2.029-1.776s-2.03,0.797-2.03,1.776 C160.239,110.917,161.15,111.714,162.269,111.714z M162.269,108.8c0.717,0,1.299,0.512,1.299,1.138 c0,0.627-0.583,1.138-1.299,1.138c-0.718,0-1.3-0.511-1.3-1.138C160.969,109.312,161.55,108.8,162.269,108.8z" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M158.988,117.408c0.086,0,0.171-0.024,0.242-0.077l5.945-4.579l3.754,3.284 c0.142,0.123,0.373,0.123,0.515,0c0.143-0.125,0.143-0.327,0-0.451l-1.752-1.534l3.346-3.205l4.104,3.293 c0.148,0.118,0.379,0.109,0.514-0.021c0.137-0.13,0.125-0.331-0.021-0.45l-4.374-3.508c-0.071-0.056-0.166-0.084-0.262-0.083 c-0.097,0.003-0.189,0.041-0.253,0.104l-3.568,3.419l-1.73-1.512c-0.134-0.12-0.354-0.125-0.498-0.015l-6.203,4.776 c-0.15,0.118-0.165,0.317-0.031,0.451C158.786,117.373,158.889,117.408,158.988,117.408z" })
    )
  ),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("rect", { x: "230.848", y: "78.621", fill: "#7B8080", width: "102.839", height: "66.74" }),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M292.472,104.656h-20.407c-0.201,0-0.365,0.142-0.365,0.318v14.029c0,0.177,0.164,0.318,0.365,0.318 h20.407c0.2,0,0.363-0.143,0.363-0.318v-14.03C292.835,104.798,292.672,104.656,292.472,104.656z M292.105,118.686h-19.678 v-13.392h19.678V118.686L292.105,118.686z" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M277.53,111.714c1.119,0,2.028-0.796,2.028-1.775c0-0.979-0.909-1.776-2.028-1.776s-2.03,0.797-2.03,1.776 C275.5,110.917,276.411,111.714,277.53,111.714z M277.53,108.8c0.717,0,1.299,0.512,1.299,1.138c0,0.627-0.583,1.138-1.299,1.138 c-0.718,0-1.301-0.511-1.301-1.138C276.229,109.312,276.811,108.8,277.53,108.8z" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M274.249,117.408c0.086,0,0.171-0.024,0.241-0.077l5.944-4.579l3.755,3.284 c0.142,0.123,0.373,0.123,0.515,0c0.143-0.125,0.143-0.327,0-0.451l-1.753-1.534l3.347-3.205l4.104,3.293 c0.149,0.118,0.38,0.109,0.514-0.021c0.137-0.13,0.125-0.331-0.021-0.45l-4.374-3.508c-0.071-0.056-0.166-0.084-0.262-0.083 c-0.097,0.003-0.188,0.041-0.253,0.104l-3.568,3.419l-1.729-1.512c-0.134-0.12-0.354-0.125-0.497-0.015l-6.203,4.776 c-0.15,0.118-0.165,0.317-0.031,0.451C274.047,117.373,274.149,117.408,274.249,117.408z" })
    )
  ),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("rect", { y: "157.761", fill: "#7B8080", width: "102.838", height: "66.739" }),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M61.624,183.797H41.216c-0.201,0-0.364,0.141-0.364,0.318v14.028c0,0.178,0.164,0.319,0.364,0.319h20.408 c0.2,0,0.365-0.144,0.365-0.319v-14.03C61.988,183.938,61.823,183.797,61.624,183.797z M61.258,197.826H41.581v-13.393h19.678 V197.826L61.258,197.826z" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M46.682,190.855c1.119,0,2.03-0.798,2.03-1.776c0-0.98-0.911-1.775-2.03-1.775s-2.03,0.797-2.03,1.775 S45.563,190.855,46.682,190.855z M46.682,187.94c0.718,0,1.299,0.512,1.299,1.138c0,0.627-0.583,1.138-1.299,1.138 c-0.718,0-1.3-0.511-1.3-1.138C45.382,188.452,45.963,187.94,46.682,187.94z" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M43.402,196.549c0.085,0,0.171-0.025,0.241-0.077l5.945-4.579l3.754,3.283 c0.142,0.124,0.373,0.124,0.515,0c0.143-0.124,0.143-0.327,0-0.451l-1.752-1.533l3.347-3.206l4.103,3.293 c0.148,0.118,0.378,0.11,0.514-0.021c0.137-0.13,0.125-0.33-0.022-0.45l-4.374-3.508c-0.071-0.057-0.167-0.084-0.262-0.084 c-0.096,0.004-0.188,0.041-0.252,0.104l-3.569,3.42l-1.729-1.514c-0.135-0.118-0.354-0.124-0.499-0.014l-6.202,4.776 c-0.15,0.118-0.165,0.316-0.032,0.45C43.2,196.514,43.302,196.549,43.402,196.549z" })
    )
  ),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("rect", { x: "115.773", y: "157.76", fill: "#7B8080", width: "102.838", height: "66.74" }),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M177.396,183.796h-20.407c-0.201,0-0.364,0.142-0.364,0.318v14.029c0,0.177,0.163,0.318,0.364,0.318 h20.407c0.2,0,0.364-0.143,0.364-0.318v-14.03C177.761,183.938,177.597,183.796,177.396,183.796z M177.032,197.825h-19.679 v-13.392h19.679V197.825L177.032,197.825z" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M162.456,190.854c1.119,0,2.029-0.796,2.029-1.775s-0.91-1.775-2.029-1.775s-2.03,0.797-2.03,1.775 C160.426,190.058,161.336,190.854,162.456,190.854z M162.456,187.939c0.717,0,1.299,0.512,1.299,1.139s-0.583,1.138-1.299,1.138 c-0.718,0-1.3-0.511-1.3-1.138S161.737,187.939,162.456,187.939z" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M159.174,196.548c0.086,0,0.171-0.024,0.242-0.077l5.945-4.579l3.754,3.284 c0.142,0.123,0.373,0.123,0.515,0c0.143-0.125,0.143-0.327,0-0.451l-1.752-1.534l3.346-3.205l4.104,3.292 c0.148,0.119,0.379,0.11,0.514-0.021c0.137-0.13,0.125-0.33-0.021-0.449l-4.374-3.508c-0.071-0.057-0.166-0.085-0.262-0.084 c-0.097,0.003-0.189,0.041-0.253,0.104l-3.568,3.419l-1.73-1.513c-0.134-0.119-0.354-0.124-0.498-0.015l-6.203,4.776 c-0.15,0.118-0.165,0.317-0.031,0.451C158.973,196.513,159.075,196.548,159.174,196.548z" })
    )
  ),
  wp.element.createElement(
    "g",
    null,
    wp.element.createElement("rect", { x: "230.848", y: "157.76", fill: "#7B8080", width: "102.839", height: "66.74" }),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M292.472,183.796h-20.407c-0.201,0-0.365,0.142-0.365,0.318v14.029c0,0.177,0.164,0.318,0.365,0.318 h20.407c0.2,0,0.363-0.143,0.363-0.318v-14.03C292.835,183.938,292.672,183.796,292.472,183.796z M292.105,197.825h-19.678 v-13.392h19.678V197.825L292.105,197.825z" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M277.53,190.854c1.119,0,2.028-0.796,2.028-1.775s-0.909-1.775-2.028-1.775s-2.03,0.797-2.03,1.775 C275.5,190.058,276.411,190.854,277.53,190.854z M277.53,187.939c0.717,0,1.299,0.512,1.299,1.139s-0.583,1.138-1.299,1.138 c-0.718,0-1.301-0.511-1.301-1.138S276.811,187.939,277.53,187.939z" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M274.249,196.548c0.086,0,0.171-0.024,0.241-0.077l5.944-4.579l3.755,3.284 c0.142,0.123,0.373,0.123,0.515,0c0.143-0.125,0.143-0.327,0-0.451l-1.753-1.534l3.347-3.205l4.104,3.292 c0.149,0.119,0.38,0.11,0.514-0.021c0.137-0.13,0.125-0.33-0.021-0.449l-4.374-3.508c-0.071-0.057-0.166-0.085-0.262-0.084 c-0.097,0.003-0.188,0.041-0.253,0.104l-3.568,3.419l-1.729-1.513c-0.134-0.119-0.354-0.124-0.497-0.015l-6.203,4.776 c-0.15,0.118-0.165,0.317-0.031,0.451C274.047,196.513,274.149,196.548,274.249,196.548z" })
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
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M78.038,100.729H37.823c-0.397,0-0.72,0.361-0.72,0.804v35.434c0,0.445,0.322,0.807,0.72,0.807h40.215 c0.395,0,0.718-0.361,0.718-0.807v-35.434C78.755,101.09,78.432,100.729,78.038,100.729z M77.318,136.164H38.54v-33.826h38.778 V136.164L77.318,136.164z" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M48.594,118.556c2.206,0,4-2.012,4-4.482c0-2.475-1.795-4.484-4-4.484c-2.207,0-3.999,2.01-3.999,4.482 S46.388,118.556,48.594,118.556z M48.594,111.196c1.413,0,2.563,1.29,2.563,2.875c0,1.583-1.15,2.873-2.563,2.873 c-1.414,0-2.564-1.288-2.564-2.873C46.031,112.488,47.18,111.196,48.594,111.196z" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M42.13,132.941c0.168,0,0.338-0.064,0.474-0.201l11.715-11.564l7.397,8.295 c0.281,0.314,0.735,0.314,1.016,0c0.281-0.314,0.281-0.824,0-1.139l-3.452-3.871l6.593-8.096l8.086,8.313 c0.293,0.301,0.746,0.277,1.015-0.049c0.268-0.328,0.248-0.838-0.044-1.139l-8.619-8.859c-0.14-0.145-0.326-0.217-0.517-0.211 c-0.19,0.009-0.37,0.104-0.498,0.261l-7.033,8.639l-3.406-3.82c-0.268-0.301-0.698-0.314-0.982-0.035l-12.22,12.068 c-0.297,0.293-0.327,0.801-0.064,1.135C41.733,132.851,41.932,132.941,42.13,132.941z" })
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
        wp.element.createElement("path", { fill: "#FFFFFF", d: "M180.226,50.535h-26.45c-0.261,0-0.473,0.211-0.473,0.472v20.782c0,0.261,0.211,0.472,0.473,0.472h26.45 c0.26,0,0.472-0.211,0.472-0.472V51.006C180.697,50.746,180.485,50.535,180.226,50.535z M179.753,71.316h-25.505V51.479h25.505 V71.316L179.753,71.316z" }),
        wp.element.createElement("path", { fill: "#FFFFFF", d: "M160.86,60.991c1.451,0,2.63-1.181,2.63-2.63c0-1.451-1.18-2.63-2.63-2.63c-1.451,0-2.63,1.179-2.63,2.63 C158.23,59.81,159.41,60.991,160.86,60.991z M160.86,56.674c0.93,0,1.686,0.757,1.686,1.686c0,0.93-0.756,1.686-1.686,1.686 c-0.93,0-1.686-0.756-1.686-1.685S159.93,56.674,160.86,56.674z" }),
        wp.element.createElement("path", { fill: "#FFFFFF", d: "M156.609,69.427c0.11,0,0.222-0.039,0.312-0.118l7.705-6.783l4.866,4.865 c0.184,0.185,0.482,0.185,0.667,0s0.185-0.483,0-0.668l-2.27-2.271l4.336-4.748l5.318,4.875c0.192,0.177,0.491,0.163,0.667-0.029 s0.163-0.491-0.028-0.667l-5.669-5.195c-0.092-0.084-0.215-0.127-0.34-0.124c-0.125,0.006-0.242,0.062-0.327,0.153l-4.626,5.067 l-2.24-2.24c-0.176-0.176-0.459-0.186-0.646-0.021l-8.038,7.077c-0.195,0.172-0.215,0.471-0.042,0.666 C156.348,69.374,156.479,69.427,156.609,69.427z" })
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
          wp.element.createElement("path", { fill: "#7B8080", d: "M155.818,140.534l-1.591,2.285l-1.123-0.922c-0.119-0.102-0.3-0.082-0.396,0.039 c-0.1,0.119-0.084,0.299,0.037,0.399l1.358,1.116c0.052,0.039,0.114,0.063,0.182,0.063c0.014,0,0.025,0,0.04-0.002 c0.074-0.011,0.147-0.054,0.193-0.115l1.767-2.539c0.088-0.131,0.059-0.309-0.07-0.396 C156.083,140.373,155.909,140.405,155.818,140.534z" }),
          wp.element.createElement("path", { fill: "#7B8080", d: "M156.052,138.844v-5.539v-2.843c0-0.156-0.126-0.282-0.282-0.282h-1.42v-0.854 c0-0.157-0.128-0.283-0.286-0.283h-1.988c-0.158,0-0.284,0.126-0.284,0.283v0.854h-6.252v-0.854c0-0.157-0.13-0.283-0.284-0.283 h-1.995c-0.156,0-0.279,0.126-0.279,0.283v0.854h-1.423c-0.158,0-0.284,0.126-0.284,0.282v2.843v11.654 c0,0.157,0.126,0.284,0.284,0.284h10.831c0.568,0.356,1.239,0.568,1.962,0.568c2.034,0,3.694-1.658,3.694-3.695 C158.041,140.696,157.23,139.458,156.052,138.844z M152.355,129.61h1.424v0.854v0.853h-1.424v-0.853V129.61z M143.548,129.61 h1.421v0.854v0.853h-1.421v-0.853V129.61z M141.839,130.75h1.139v0.853c0,0.157,0.125,0.284,0.281,0.284h1.995 c0.154,0,0.284-0.127,0.284-0.284v-0.853h6.252v0.853c0,0.157,0.126,0.284,0.284,0.284h1.988c0.158,0,0.285-0.127,0.285-0.284 v-0.853h1.137v2.274h-13.646V130.75L141.839,130.75z M141.839,144.676v-11.084h13.646v5.013 c-0.056-0.019-0.111-0.033-0.171-0.045c-0.053-0.019-0.106-0.029-0.159-0.041c-0.049-0.014-0.101-0.021-0.146-0.029 c-0.07-0.016-0.14-0.023-0.208-0.033c-0.039-0.006-0.076-0.012-0.119-0.016c-0.106-0.011-0.221-0.018-0.333-0.018 c-0.1,0-0.189,0.007-0.285,0.018v-0.302v-0.569v-2.558h-2.56h-0.568h-1.99h-0.569h-1.989h-0.564h-2.563v2.558v0.569v1.988v0.569 v2.56h2.563h0.564h1.989h0.569h1.888c0.006,0.024,0.016,0.047,0.026,0.075c0.023,0.066,0.05,0.137,0.076,0.203 c0.015,0.039,0.035,0.076,0.047,0.111c0.035,0.069,0.067,0.144,0.108,0.215c0.016,0.029,0.035,0.057,0.05,0.086 c0.042,0.076,0.087,0.148,0.13,0.222c0.021,0.024,0.038,0.048,0.055,0.075c0.05,0.07,0.104,0.14,0.158,0.209 c0.021,0.024,0.043,0.048,0.063,0.07c0.042,0.053,0.087,0.105,0.132,0.151L141.839,144.676L141.839,144.676z M152.73,138.802 c-0.03,0.016-0.063,0.026-0.094,0.042c-0.051,0.029-0.104,0.06-0.155,0.089c-0.047,0.028-0.092,0.053-0.137,0.084 c-0.041,0.028-0.091,0.055-0.128,0.09c-0.049,0.035-0.102,0.07-0.146,0.104c-0.034,0.034-0.076,0.062-0.11,0.094 c-0.049,0.043-0.103,0.086-0.146,0.134c-0.032,0.029-0.063,0.061-0.1,0.092c-0.05,0.052-0.099,0.105-0.146,0.162 c-0.021,0.025-0.041,0.047-0.063,0.069v-1.622h1.99v0.391c-0.006,0.002-0.011,0.002-0.015,0.002 C153.221,138.594,152.967,138.683,152.73,138.802z M150.813,141.038c-0.011,0.031-0.017,0.066-0.025,0.101 c-0.022,0.081-0.048,0.164-0.062,0.247c-0.019,0.066-0.023,0.133-0.03,0.2c-0.011,0.053-0.021,0.108-0.027,0.16 c-0.012,0.122-0.02,0.247-0.02,0.372c0,0.104,0.008,0.207,0.018,0.312c0,0.021,0,0.035,0.002,0.058 c0.004,0.045,0.014,0.09,0.021,0.139l0,0c0.004,0.021,0.008,0.042,0.008,0.063h-1.751v-1.99h1.99l0,0 c-0.004,0.01-0.004,0.018-0.007,0.021C150.886,140.823,150.845,140.931,150.813,141.038z M143.83,140.696h1.992v1.992h-1.992 V140.696z M143.83,138.139h1.992v1.988h-1.992V138.139z M153.494,137.567h-1.99v-1.987h1.99V137.567z M150.936,137.567h-1.989 v-1.987h1.989V137.567z M150.936,140.127h-1.989v-1.988h1.989V140.127z M146.386,138.139h1.989v1.988h-1.989V138.139z M148.375,137.567h-1.989v-1.987h1.989V137.567z M145.819,137.567h-1.993v-1.987h1.993V137.567z M146.386,140.696h1.989v1.992 h-1.989V140.696z M154.35,145.243c-0.646,0-1.241-0.194-1.736-0.527c-0.098-0.066-0.188-0.136-0.274-0.212 c-0.034-0.024-0.063-0.052-0.09-0.08c-0.062-0.053-0.112-0.104-0.164-0.157c-0.034-0.037-0.064-0.07-0.101-0.105 c-0.042-0.055-0.091-0.108-0.132-0.168c-0.026-0.035-0.057-0.07-0.08-0.106c-0.063-0.09-0.122-0.187-0.177-0.28 c-0.011-0.022-0.021-0.048-0.033-0.068c-0.043-0.083-0.079-0.166-0.114-0.248c-0.014-0.036-0.026-0.075-0.04-0.112 c-0.026-0.073-0.049-0.149-0.073-0.226c-0.006-0.021-0.01-0.036-0.013-0.053c-0.033-0.125-0.058-0.252-0.073-0.375 c-0.003-0.011-0.003-0.02-0.006-0.028c-0.015-0.126-0.023-0.253-0.023-0.38c0-0.106,0.006-0.211,0.016-0.318 c0-0.008,0.005-0.018,0.005-0.025c0.01-0.099,0.025-0.191,0.046-0.289c0-0.011,0.004-0.018,0.007-0.025 c0.02-0.098,0.043-0.188,0.073-0.282c0.003-0.011,0.007-0.021,0.01-0.03c0.033-0.092,0.063-0.178,0.099-0.266 c0.038-0.079,0.076-0.159,0.116-0.238l0.03-0.048c0.011-0.021,0.023-0.039,0.036-0.063c0.05-0.082,0.103-0.162,0.157-0.24 c0.015-0.02,0.029-0.037,0.044-0.057c0.055-0.068,0.105-0.135,0.162-0.195c0.018-0.022,0.04-0.045,0.057-0.063 c0.057-0.06,0.115-0.114,0.176-0.171c0.021-0.021,0.043-0.037,0.065-0.058c0.07-0.062,0.144-0.116,0.22-0.173 c0.01-0.01,0.021-0.018,0.035-0.025c0.375-0.255,0.798-0.434,1.254-0.508l0.007-0.006c0.17-0.026,0.336-0.045,0.517-0.045 c0.108,0,0.221,0.009,0.327,0.021c0.019,0,0.035,0.005,0.049,0.008c0.095,0.012,0.186,0.025,0.277,0.045 c0.013,0,0.025,0.008,0.034,0.008c0.102,0.021,0.195,0.051,0.292,0.082c0.007,0,0.015,0.004,0.021,0.006 c0.097,0.033,0.193,0.072,0.292,0.113c1.079,0.493,1.834,1.584,1.834,2.848C157.472,143.843,156.068,145.243,154.35,145.243z" })
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
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M197.977,31.523h-65.682c-0.647,0-1.173,0.524-1.173,1.173v51.606c0,0.649,0.524,1.173,1.173,1.173h65.682 c0.646,0,1.172-0.523,1.172-1.173V32.696C199.149,32.048,198.623,31.523,197.977,31.523z M196.803,83.13h-63.335V33.869h63.335 V83.13L196.803,83.13z" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M149.887,57.489c3.603,0,6.532-2.931,6.532-6.53c0-3.604-2.93-6.532-6.532-6.532 c-3.602,0-6.531,2.929-6.531,6.531C143.356,54.559,146.286,57.489,149.887,57.489z M149.887,46.771 c2.309,0,4.187,1.879,4.187,4.187c0,2.307-1.878,4.186-4.187,4.186s-4.186-1.878-4.186-4.185 C145.702,48.652,147.579,46.771,149.887,46.771z" }),
      wp.element.createElement("path", { fill: "#FFFFFF", d: "M139.332,78.438c0.274,0,0.551-0.096,0.774-0.292l19.133-16.845l12.083,12.082 c0.459,0.458,1.201,0.458,1.658,0c0.459-0.459,0.459-1.2,0-1.658l-5.638-5.639l10.769-11.792l13.207,12.107 c0.479,0.438,1.219,0.404,1.656-0.072c0.439-0.479,0.404-1.22-0.07-1.657l-14.076-12.902c-0.23-0.209-0.535-0.313-0.844-0.307 c-0.313,0.014-0.605,0.151-0.814,0.381l-11.488,12.582l-5.563-5.563c-0.438-0.438-1.14-0.459-1.604-0.053l-19.959,17.573 c-0.485,0.429-0.533,1.169-0.105,1.656C138.682,78.306,139.007,78.438,139.332,78.438z" })
    )
  )
);

/***/ }),
/* 1 */
/***/ (function(module, exports, __webpack_require__) {

var root = __webpack_require__(20);

/** Built-in value references. */
var Symbol = root.Symbol;

module.exports = Symbol;


/***/ }),
/* 2 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__block_multipurpose_gutenberg_block_block__ = __webpack_require__(3);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__block_button_block__ = __webpack_require__(5);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__block_Heading_block__ = __webpack_require__(6);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__block_Heading_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_2__block_Heading_block__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__block_image_block__ = __webpack_require__(7);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__block_image_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_3__block_image_block__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__block_image_with_text_block__ = __webpack_require__(8);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__block_image_with_text_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_4__block_image_with_text_block__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__block_quotes_block__ = __webpack_require__(9);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6__block_not_to_be_missed_block__ = __webpack_require__(28);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_7__block_latest_show_news_block__ = __webpack_require__(29);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_8__block_advertisement_block__ = __webpack_require__(30);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_8__block_advertisement_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_8__block_advertisement_block__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_9__block_related_content_block__ = __webpack_require__(31);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_10__block_contributors_block__ = __webpack_require__(32);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_10__block_contributors_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_10__block_contributors_block__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_11__block_new_this_year_block__ = __webpack_require__(33);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_11__block_new_this_year_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_11__block_new_this_year_block__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_12__block_delegation_block__ = __webpack_require__(34);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_12__block_delegation_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_12__block_delegation_block__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_13__block_products_winners_award_block__ = __webpack_require__(35);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_13__block_products_winners_award_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_13__block_products_winners_award_block__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_14__block_photos_block__ = __webpack_require__(36);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_14__block_photos_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_14__block_photos_block__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_15__block_badge_discounts_block__ = __webpack_require__(37);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_15__block_badge_discounts_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_15__block_badge_discounts_block__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_16__block_registration_passes_block__ = __webpack_require__(38);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_16__block_registration_passes_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_16__block_registration_passes_block__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_17__block_official_vendor_block__ = __webpack_require__(39);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_17__block_official_vendor_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_17__block_official_vendor_block__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_18__block_news_conference_schedule_block__ = __webpack_require__(40);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_18__block_news_conference_schedule_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_18__block_news_conference_schedule_block__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_19__block_opportunities_block__ = __webpack_require__(41);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_19__block_opportunities_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_19__block_opportunities_block__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_20__block_exhibitor_advisory_committee_block__ = __webpack_require__(42);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_20__block_exhibitor_advisory_committee_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_20__block_exhibitor_advisory_committee_block__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_21__block_related_content_with_block_block__ = __webpack_require__(43);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_21__block_related_content_with_block_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_21__block_related_content_with_block_block__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_22__block_videos_block__ = __webpack_require__(44);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_22__block_videos_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_22__block_videos_block__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_23__block_featured_image_block__ = __webpack_require__(45);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_23__block_featured_image_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_23__block_featured_image_block__);

//import './block/slider/block';




//import './block/schedule-block/block';



//import './block/accordion/block';
//import './block/meet-the-team/block';
//import './block/awards-block/block';

//import './block/custom-block/block';















//import './block/media-partners/block';

wp.domReady(function () {
    wp.blocks.unregisterBlockType('yoast/how-to-block');
    wp.blocks.unregisterBlockType('yoast/faq-block');
});

(function () {
    var nabShowIcon = wp.element.createElement(
        'svg',
        { version: '1.1', id: 'Layer_1', xmlns: 'http://www.w3.org/2000/svg', xlink: 'http://www.w3.org/1999/xlink', x: '0px', y: '0px', width: '25px', height: '25px', viewBox: '0 0 72 72', 'enable-background': 'new 0 0 72 72' },
        wp.element.createElement('image', { id: 'image0', width: '72', height: '72', x: '0', y: '0', href: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEgAAABICAYAAABV7bNHAAAABGdBTUEAALGPC/xhBQAAACBjSFJN AAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAABmJLR0QA/wD/AP+gvaeTAAAW 80lEQVR42u2caZRc1XXv/+ece2/NVV1zT9WDuqUWGiIkISwGAzYPCB6QwfbzyyOyHUxW4jiJYww2 s7HhGRz8gBiInWVYBhsTh+XEfgbjIdiAGWRkNKEBtXqunqq7q6u6a77DOScfGgxddUtqDURirXe+ dfW959b93X32/p+99y0ipcT/H/WHUv3BK69sP+5Jh4ZGoOs6CCGLPidSoH3dZlBfDFJwAAAlBAXd wq6ROXTyYbhRgQQ9putSSjE3N7duZCT5KqW05t6klGhpaT7D5XLtkEKAEYmyVDHtaEVFC8HBgGsv 6To8oJM1OGGYISG06EPgYMcGiBBMTqauMwxDoXQxZM45gsGGR9sSiR2UAIDEpOnGpBWECQYiOGDz YE4ZQBQCOeqHS2fQrMJRWxGlFIVicX2xWPwoY7WACSHljvaOu90OFXkD6Nf9SHMXKCQoOOo5mlMG EJESpiRQm3uwPmTAFGTp5xIC07Tw7LPP3QDAWf1/y7IQj8f+dXlX+/6RAsO+kgZTUjAijjj3KQMI ABgkZnQNupRwqYBYYvxQVRXJZN/FhULh44pSe0uU0uJpPSvuJg4fpnIaQCtwUwLgrYcgJaCyU3iJ AQAhQNEE+ueBHk8ZpiA4kh0RSlAqlWlv76Ebqv0OAAghEPD77tNc3oNFLYi+6akrRtKldoWRRfiF BNwaLQB46JQFBAAKlRgpKAjzCjQqcSQjUhQFwyMjl+Tz+QvsrIcQOuVxuR4oQ8N41lz+wLNDT1QM zihdjN4wOC5aE/vuKQ+IANChYNx0IUEz4JIBdTARQlDRdTo2Nm5rPZxzhIMN3wk3J1LC34TvPzt8 Q9ngzK0tduJCSPj8juyW9Y231TyAkw3EbjBIpEwPfGIaCnSgzkKjlCKVmvpgqVR6r13kopRONzbG vu2ItmHPRHnN873pK51q7XFlU+CjG5sfXN3km3hXACKQMImGGRlARB+HIPa6SAqpzMzMfMnOeizL Qktz4wP+aOvUsO7Bk7snbjQsoVUD4kIi7tfSn9jU/C2Po/Y6pyQgAGAQyLIg1FIShJcWPPjb/88Y 5ufnP1ipVM6tsR4JMKaklrUlvpOmDdg3WVq/Kzn3MYeN9eiWwMWrY98Me7SZXMV69wACJExocDSv QJe7tEgXMUaRz+W1kWTyy3bWY1oWupe136+Fmmf2jBG81Je+yeJS1ZTFkIUAQh416VLpt/91+xiE BC5cGXm3AAIIBOaIDx6/BkrIH121qqoYSY7+hWEYZ6mquhirlHA4tNTq01Z8J0V9GJ3Lndk7VfiI qtgsQyGwqSN0T8Cl5CqmgI0MOrUBMQJkdIL+jIUmtQQuCSglKFd07+Dg0LV2YZ1zjuam+C2qL5Jp 9IQxOpv6qsUFU+ji5WUJiYhXGzprWfAhlZG6ovSUBgQsxK954UDUyoFLAkVRMDQ49Cld17urAUkp oarqXkbZYzmDYPd07n2vDGX/1C5yWVzg/Ssjd0d9jqJuinqB8t0AaCGilXQLBAK5fN4/mUpdYxfW hRCIRULf9McTlVniJ4++2HubndQ0uUBL0NV34WnRRxRG4HHUv/4pDwiQEFRFkROoZgUjybFPm6a5 rBrQG9bzWryx8QkSbsPLA9lL947nznMqtSBNLnHFhqY7mwKOcsnkh736KQFIYQQOhUKg1tKFlCCU 0QqcIpceachms1+wsx7OOZZ1JL7hCLVU9s8z9uSu5C3EZtkYlsCKuGf/lnWNj6mMwE77nFRACxje GppCsW88t/nRbWPfUBRKSNW+Qje5+pGNidvWu8ivU9nspznnHdWhXUoJp9O5u7Wl9ccj0o8Dk4UP DaVLmzXbyCVx5Xtav9YYcJgF3TriZvi/FxAhIJaB1HwFQgoQAAqjeOjF5Nf3jOXOc1TdkMkl4gHn xJq4uj1U0mOvFUpfqKeaV69cfldRCxmvjlrqC33pm4mN+VhcojXofKWgWz/+wbZR2x3e+rbAyQMk JeCgAqZlomhKuBSKV0fmLt47lnufz1n7VUzO8amzEzefHhZzv9vTdzfnvK06cgkh4PV6d3V1d/2H bGhCZWj6iuRs+QyXZr90zu4O3QFAFI3D+56TAwiAxiTMoo7JnICDEfrk7tQtqOMrVrX4D1y2OvDD wUO7W8cmUn9ZR/eIzo62G52BmJmRmnPbwOxtjBLb+Tqj7hfWtfh/zqWEb4nJuBMOiBACSikopTVV DSEEKAEiLomxAkHvVPEDg+nSuZqNhBUS2NAW+AotpI2BgcFrhBCB6uUlhIDL5fyVbli/nNUpnjw4 vfXgZGGlneMlhODSNbH/E/Kq0rCWXuqqASTEkfO0h4NjWRbN5XJ/ZpqmZ9EGU0pIQBdc/NtcyayM zHL2XG/6ZrucocklmkPuP3T4xE8GD/V2zGayf2FnPRLg8Wj4Lk8sgYEc9f5o++j1do5ZNznWtPh/ u3lZ6FdcCMjD6J4jAspksscERwJQmIKpqamLkqOjj9mVXSKR8GO5YvkHyxqb8fLE7EeGZ8vvcdv4 CiklLlgRvn2NZ45P9E58gQvRYKd73E7nLyOx+O90XzOe65359ES2sqza90gJUErlFRuabnepFDYb 9qMDZFpHOcMbgxACwzDIxOTkDYwx2ESRYmd7222Kp0FwxaU9f3Dmq7a+ggt0xnzbNkbkU/mJgc65 XOHTdVSzWNaRuFP4mnBwVgR+vW/qOrsNacXiOGtZ6JcXrYo+p1tHvzpqAOVzuWMCxJiCXC53aaVS Ob/6ht6wnkeDofCAcIfx5J7Un+2fKKy28xVSApdvaPrq2nBe/uHA7DVSwl/NWggBn8/781hj80t7 Kl78YTh79UzeaHOqtGYuhRLr6ve23R5wKygb4oi654iAIpHoUcOhlKBYLJHBoSHb7B4hJN/Z1nqP qfkxmBXuH20fu8nWV1gCK5v8z/+PLvevRGp4Q6FUvtrWeqTkq1Z03TlmePDqhB7cPpj9gp2jN4VA d9Tz79O5yraf7U5hKW0I6xL+wwPq7Gw/akCqqmLXrt1/ruv6+dX5GcviiEXDPwgEwwMjhhu/7Z/5 1Fi2stxV/bSxkDS86pzEV+KsgGf2H7wZNkVAzjki4dBP2zuXbTP0Boy9Nvo3cyWzxWFjPQ5G9fcu D92ZLpiw+LEFnxpAuq4f1QSEEMzPz7sO9fXdZF+0I8XO9sQ989KN/nnhe+bA9JdUG9+jWwLr24NP n92qPt+7d8d7ZjPZy+zmA0gh6PffWKYuaA5X0+sT+WsUZjMfF9jYFnhiecyz51h8T11A+Xzh6CZQ FBzs7f3zclnvUdXF01mcIxoJP+pvCA3sKDqwc2T+qnTB6HDYLC+VEt4ddd2amUxiJJm8gVJas7ak lPC4nY9CcRwqwI0fbR/7/HTeCFX7MikBt8oqF62K3qUpFJQerec5DCDDMJZ8MiEEhWLBMz4+fq1i k1aghORXLOu4Z6SkYdekGXhlcPaLdk/b4ALdcf9PN0bkjpnR/rPncoUP2fkeALl4NHyfp6kT+2d4 +1N7Jj/r0mphl02O96+M/PD0ROBA2VzalmLJgArF4pJPZoxhZCT5ScMwV1TfkGVZaG5ueiTR0Tlg GX6kXh/762zJTFRn996oiRsXnxb+WocyjoHJqRuIjfVwzhHw+78fiDb1F10x/OLVyWvyFctfrXuE lPA5leJHNzb9o0OhIARHHbkOC6hSrizpREIITMv0zc5mbHfYhNJ8z/Kue4XDDyKdsX3juWsVm0hj WALrO0I/7nEXX5tJ9p9bLFcurTNfrqsjcU/JGcOuiUrXi33pz9QrAn54XeMj7+kMHirqx2c9toBK pdKSTqSUYjaT+STn1vLqG1oo2jU9Eo41DqV0FY//Pvn51LwesfMVDpUaH9vYeEfc6MOBzNz1hBBb 64lFI9/zRpqGdmaceKkvfV3ZFJ5qXyakhFdjmQtXRv5xrmhCP8bIdVhAPT3Lj3gSYwyzs5mGoeHh utZz2orue3LSjQOpcssv9k5/rlrEAUDF5Dh/Zezx89q018f35beUdePSapkAAISQ+VU93fcmDQ8O Tus9+8dzn7TTPRaXWNvm/5e947nkzpG5YwJyyerFOrAGkNfrPewEhCyo5n37Dlxncd6lVoXiN63H H4kP75oDfrF36ou5ihlwqdW+AvA6ldJVZzXfQfOTyqGBoVsZq71ry7LQlmh9KN6SGNGUKKZ3H7qh YnKXXQk54FJnzuxo+JbGKBR65NaZpYwaQMXi4ZcYYwxzc1Mto2Njf6XYbCAppflVK7vvnaioODBV af/9YOYzdmG9bHBcsrHl0TUhPrD75QOfKBRKG6plAgBQSkfi0chdXPOjb7qy/tXh7JWaTcQ0uMQZ HYEHOyOuVMU8/qVVF9CRhKLCGA719X+ecx6uFnKccyRamh9xN8SGnhky8VJ/9tqywf1aja8AvE5l rrNBvWNmbFgZn0xdz5h985Pf67k/p8v0lKHisW0DN1dMoVRHLi4kIl41dXZX8J+FXEjjvmOAypX6 UYwSgtlCMZFOp6+u1+q2qqf73sE8w6F0pWv/eP4qu7Y2kwusbg19d5m7ODHU33tlpVI5ndkUARlj w02N8YedTV14eSi/+aX+2cudNukR3RR4//rIt1Y2+WZKS0ylHjOgyuEAUYqRZPLzUspgdTrDsiw0 NTXe64/Eh5gzipntfTeWDMtdq1MAv0ud/dMe/zdDlUOOwXTmOlqnCBgNB//JEWycm7C8eGr36M1C oiaJYnGJ5qBzbMvpTd9xqQzaCbQeW0A5u3THQtIJumF05HK5q+wil6Ioow5VvTdrMIwUzLXbh7Jb 7dpNDEvg7OXRb7ez7PRMMrnVMK11dmUcVVUH2xIt30trEeydKJy3byz/gXoZgI9ubPq/PXFvtmgc Wy7rqAC5nK6agwhZ+NKTqdTf21mPEAJ+n/dBhy+YybEAHnlx6JaywVU7XxH0aFOf2BC9r7nc796e K1xXr3WurbX5PultnO+f1/By39RNQkqiVMUlS0i0BJ39F6+KPVzQLVjHkS5eMqCVK1fUHqQoSCaT a/L5/Gfq+J6xBr/vIUesA3smSpu2DWSusFO5FUtgy6roA2fE5OzeV8ZvM0xrrWrjexxOx+Dyrs7v ZZwh9A8WLzw0VbjYznqEkDit0XvX73rTeeMEiEIAOH9F+PCADMNc9DchC/6l91DfLYQQf/XxQggE fN4HmDc0mxIB/L+d4zdzIVn1ptQSEs0NzomtmxrvT48fJIYlftPWmthe7VS4ECQSahj2x1sLXk+c Df1mz1ftWlMsIdEYcO5f1ex9vGRwHLkf9thG7Wa1sDjdwRhDKpXaNDububxOo+RoQ8D3UN7ZhH2p 8tn7x3Mf0lS7yoLAxzc239se88+PzDBomvaCqqBmJyksE6rDBemJ4um9Ux/eOTJ3jl0RkAuJc7uD d7WFXOWKefSp1GMG9PbXowgh4JwjOTr6ZUJIzR5ACIEGv/fBihqY7S158Nzr07cKKSmr+rpcSER9 Wl/Yo377twdn4S5TuCBhLnroEhAc1BNEObQC/WldffyVsVvsEvsmF0iEXHv+pMX/hGFJUPJO4bFL mL3NghhjSKfTm+fnc1vqWM9YwOd7SGnsRG4SF4zMFi+xE2lcSKxL+L85MVcpHpouo83JsJoQvNmn QCQHCIOMdoNEOqBoKp4/OP2x3qnCBpdd85OQ+NDa+Nc7om6jbIjjy2ccLaA3lTTBQiIlNTn1JUKI bYHR6/E84AlGZ9uXd5EHd+z/GhdA9f1YQqKpwfn6OV3B7xOy0OqmSQVmnoLABJECFTWAfGAZhDMA mtMhZcXx9N7pG5Q6qdmVjd5XL+gJ/4cEoDhPrO45IqDc/IIOYoyhWCyeXSqXLrMLxYyx0Xgs8t3m zhV4YWDugzuGs++18xWWkNjc2XC3x6FUdFOAEYATBwpKED5rCnOeDuTczZCgIBUdDpVhx8j8/xrN lNc6VLuStMTWzYmvtYddVtHg76Tx2APq6GgHXWjxx85du79ULz8TjYTvDzUlMlNoYI++2HsrreMr OsPuve9bGXlcAvC+WfKlFKbSjh2TAZR1P6heASBBQEAp3C/1Z77MbFKzFUvg9NbAC+f3hH+uWwLs HfQ9dQHF41GoqoYDB16/rFyuXGa3w2ZMGY3HIg8bzih+15+9vDeV32TfKClx6ZrYXTG/Uy+/bY/E KDBluqD6ANdC0RrAQjPVtoHslamcfppdBoARYHnc/ZVnDswIw3pnfM9ZXcHDA8rnC7AsrvQe6ruJ 2YQQzjni0cj9qi+c6S1o6lO7R29m1H4LsKrZt+PyDY1PSAAB11uXIgCaG5zY2P6WrFIowXzZ9D/8 YvLGepGrM+L5VczneHY0W8Y7JHtqRg0gy+IYHBreUigUz6y2njd22KPxWOThKQSxc6z4P8ez5XXV KldiIZ26dXPr10MezXr7DltKibIh8HbtsrD8FPxsz9RfTszpHTWpWQCUEPG+nvAdzQ1OmCdINR8T oLn5eW18fPx6uzKOEALxaPh+QwtkXssozpf6pm+08z0Wl+iMuJ6LeLWf7h6dh3ijO1NKCY0t9A3x t+ktRgiG0qXwv++Y/KJdatawBNa2+J9e2eh90bAEmHJsL/2eEECjo2NbS6XSGYyxRaJRAmCUTkSj 0Yfbupfj2V3F/52ar6yya18hBFjV5Ltz22BGmPytOYSQWNvqR1PAiTcL5RKApjI891r6s9N5val6 voXrErHl9Mbbo34HjOOokp4QQJZlJYLB4L/Z7NiJz+P+WagxkSlrQe+zrw/dqtYp4/Q0en+9oS3w 6+oNJKMEQkqMZ8t//IxSgqJeij9zYObv7RxzxeQ4pzv0k3UJ//aKKWAXDP5bAQUbGm6zO1AKDs3p hiPWgSd2Tlw9MFNs9zqqfRRACZHndAfv9DgYVL6QOJdYEJ4GF6iuVWmM4MX+zN9limbUqbJFHRhi YUlanzorcUej34HjqbGfMEBSSlT/XAURFojmAhpPQ29GNPz4D+PXOuu8e7WhPfD05mWh5wxL/DHQ MEIwVzKxMzm/KCVIAJhCduwYmf+cQ2U16ULTkrh4dfTxtS3+3ZXjLCGfMECLwEgJQKDoisEIdsHN PPjPvZOfnSkYLXbtK4wR8YG1sa+7NYbqUN0SdOIjDY2LojMBICXmr9jQdCEBqSHAhQAlZMDk71Qy 4zgAMcnBFSeyng6UnBFQITGbLkSe7U3/Q/WLacBCGeeCnvBP3r8y8nLFFDXNSowSuO17l7MEsG2M FJAYz1YgTuIPsNQuMSEgBMc0CyPjaAcXDpCiDrdGsX147nPzJStm16zkUinfujlxp9ehQKH2vsIS YkldXn8EJOVJhWMLyOX2YNrZghxCUKWABglGGabzevz3g9m/Veskzs/sbHgs4tV2DKdLtstBSokG twpNoUcF6WSPGkDtG85Dl+YAgQCBBBaKfLj9qUPXzpetiNemAcGp0nJbyPWNJ/ekYNV5dc/kHJs6 g9jUHsSJyh+fFECGpDD0t5qoNEaxezTX/uRrU3/ttlO5XGBTR8MPlsc8rx8uDHMhoJvipC+Z4wY0 k19cenZrDI+/MnZdrmx53TZFQJfKSud2h+72ORncon7ySkpACqBiCqiMnLSodNyACm8TciojGEqX lv/mYPoq2zKOyXHpmtjD69sC/SXzyMkrIRdaczVFwbvlp8FqX0UoLFiQBOBUGJ7aM3V9yRCuat3z Rqtb7qJV0Xsk7H9apgaQkNBNAY92sm/7OAC96UcUStA/U1j76sjcVqdt+4rAljMb/+X0RGC4oFtY SnJPyoXXL99NfqgG0P6JPABAZZTsTM5fZ3ChaIwuUrlvlHHSHz+j+T6nSsGousTLARLyXRXmybvF F5ys8V80XMCqvQZwzwAAACV0RVh0ZGF0ZTpjcmVhdGUAMjAxOS0xMS0wN1QxNjowNTo0MCswMzow MNZSCp8AAAAldEVYdGRhdGU6bW9kaWZ5ADIwMTktMTEtMDdUMTY6MDU6NDArMDM6MDCnD7IjAAAA GXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAABJRU5ErkJggg==' })
    );
    wp.blocks.updateCategory('nabshow', { icon: nabShowIcon });
})();

/***/ }),
/* 3 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_classnames__ = __webpack_require__(4);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_classnames___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_classnames__);

(function (blocks, i18n, element, editor, components) {
	var __ = wp.i18n.__;
	var registerBlockType = wp.blocks.registerBlockType;
	var Fragment = wp.element.Fragment;
	var _wp$editor = wp.editor,
	    MediaUpload = _wp$editor.MediaUpload,
	    AlignmentToolbar = _wp$editor.AlignmentToolbar,
	    InspectorControls = _wp$editor.InspectorControls,
	    InnerBlocks = _wp$editor.InnerBlocks,
	    PanelColorSettings = _wp$editor.PanelColorSettings,
	    BlockAlignmentToolbar = _wp$editor.BlockAlignmentToolbar;
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
/* 4 */
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
/* 5 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__icons__ = __webpack_require__(0);


(function (wpI18n, wpBlocks, wpEditor, wpComponents) {
  var __ = wpI18n.__;
  var registerBlockType = wpBlocks.registerBlockType;
  var RichText = wpEditor.RichText,
      InspectorControls = wpEditor.InspectorControls;
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
        d: "M25.308,18.128c-0.148,0-0.288-0.058-0.393-0.162l-2.215-2.214l-1.642,1.698 c-0.104,0.104-0.244,0.162-0.392,0.162c-0.037,0-0.072-0.004-0.107-0.012c-0.182-0.034-0.333-0.157-0.406-0.327l-1.604-3.811 L2.618,13.487C1.174,13.487,0,12.313,0,10.869V2.618C0,1.175,1.174,0,2.618,0h26.815c1.443,0,2.617,1.175,2.617,2.618v8.251 c0,1.443-1.174,2.618-2.617,2.618h-4.428l2.242,2.146c0.105,0.104,0.164,0.244,0.164,0.393s-0.059,0.288-0.164,0.393l-1.547,1.548 C25.596,18.07,25.457,18.128,25.308,18.128 M22.729,14.438c0.147,0,0.288,0.058,0.394,0.162l2.213,2.215l0.762-0.818l-2.215-2.157 c-0.104-0.104-0.162-0.244-0.162-0.393s0.058-0.288,0.162-0.393l1.521-1.52l-7.911-3.272l3.39,7.871l1.453-1.533 C22.441,14.496,22.582,14.438,22.729,14.438 M26.065,12.444l3.368-0.068c0.763,0,1.402-0.576,1.49-1.34 c-0.385,0.586-1.047,0.904-1.748,0.904h-2.606L26.065,12.444z M1.15,11.173c0.143,0.694,0.751,1.203,1.468,1.203h15.535 l-0.254-0.46L2.876,11.94C2.222,11.94,1.601,11.662,1.15,11.173 M16.541,6.705c0.075,0,0.147,0.015,0.216,0.043l9.798,4.125 c0.171,0.072,0.294,0.224,0.329,0.405l0.008,0.106l2.283-0.04c0.973,0,1.765-0.792,1.765-1.765V2.618 c0-0.831-0.676-1.507-1.507-1.507H2.618c-0.831,0-1.507,0.676-1.507,1.507V9.58c0,0.973,0.792,1.765,1.765,1.765h14.843 l-1.69-3.869c-0.088-0.209-0.041-0.447,0.119-0.608C16.253,6.763,16.393,6.705,16.541,6.705"
      }),
      wp.element.createElement("path", {
        fill: "#0f6cb6",
        d: "M22.73,14.438c0.147,0,0.287,0.058,0.393,0.163l2.213,2.214l0.762-0.818l-2.214-2.157 c-0.104-0.104-0.163-0.244-0.163-0.393s0.059-0.288,0.163-0.393l1.521-1.52l-7.911-3.272l3.389,7.871l1.455-1.532 C22.441,14.496,22.582,14.438,22.73,14.438"
      })
    )
  );

  registerBlockType('nab/nab-button', {
    title: __('NABShow - Button'),
    icon: { src: buttonBlockIcon },
    description: __('Nab Button is a gutenberg block used to add a clickable button.'),
    category: 'nabshow',
    keywords: [__('Button'), __('gutenberg')],
    attributes: {
      ButtonText: {
        type: 'string',
        source: 'html',
        selector: 'a',
        default: 'READ MORE'
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
          TextUppercase = attributes.TextUppercase;


      setAttributes({ saveId: clientId });
      var blockID = "block-" + saveId;

      var ButtonStyle = {};
      FontSize && (ButtonStyle.fontSize = FontSize + 'px');
      paddingTop && (ButtonStyle.paddingTop = paddingTop + 'px');
      paddingBottom && (ButtonStyle.paddingBottom = paddingBottom + 'px');
      paddingLeft && (ButtonStyle.paddingLeft = paddingLeft + 'px');
      paddingRight && (ButtonStyle.paddingRight = paddingRight + 'px');
      marginTop && (ButtonStyle.marginTop = marginTop + 'px');
      marginBottom && (ButtonStyle.marginBottom = marginBottom + 'px');
      marginLeft && (ButtonStyle.marginLeft = marginLeft + 'px');
      marginRight && (ButtonStyle.marginRight = marginRight + 'px');
      TextUppercase && (ButtonStyle.textTransform = TextUppercase);
      BorderWidth && BorderColor && (ButtonStyle.border = BorderWidth + "px solid #" + BorderColor);
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
                        __WEBPACK_IMPORTED_MODULE_0__icons__["f" /* btnPrimary */]
                      ),
                      wp.element.createElement(
                        "li",
                        { className: 'btn-default' === btnStyle ? 'active' : '', onClick: function onClick() {
                            return setAttributes({ btnStyle: 'btn-default' });
                          } },
                        __WEBPACK_IMPORTED_MODULE_0__icons__["d" /* btnDefault */]
                      ),
                      wp.element.createElement(
                        "li",
                        { className: 'btn-alt' === btnStyle ? 'active' : '', onClick: function onClick() {
                            return setAttributes({ btnStyle: 'btn-alt' });
                          } },
                        __WEBPACK_IMPORTED_MODULE_0__icons__["c" /* btnAlt */]
                      ),
                      wp.element.createElement(
                        "li",
                        { className: 'btn-light' === btnStyle ? 'active' : '', onClick: function onClick() {
                            return setAttributes({ btnStyle: 'btn-light' });
                          } },
                        __WEBPACK_IMPORTED_MODULE_0__icons__["e" /* btnLight */]
                      ),
                      wp.element.createElement(
                        "li",
                        { className: 'btn-white' === btnStyle ? 'active' : '', onClick: function onClick() {
                            return setAttributes({ btnStyle: 'btn-white' });
                          } },
                        __WEBPACK_IMPORTED_MODULE_0__icons__["g" /* btnWhite */]
                      ),
                      wp.element.createElement(
                        "li",
                        { className: 'with-arrow' === btnStyle ? 'active with-arrow' : 'with-arrow', onClick: function onClick() {
                            return setAttributes({ btnStyle: 'with-arrow' });
                          } },
                        __WEBPACK_IMPORTED_MODULE_0__icons__["a" /* arrowBtn */]
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
                        min: 1,
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
                            return setAttributes({
                              BorderColor: BorderColor
                            });
                          }
                        })
                      )
                    )
                  )
                ) : ''
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
                  options: [{ label: __('Gotham Book'), value: 'Gotham Book' }, { label: __('Gotham Book Italic'), value: 'Gotham Book Italic' }, { label: __('Gotham Light'), value: 'Gotham Light' }, { label: __('Gotham Light Italic'), value: 'Gotham Light Italic' }, { label: __('Gotham Medium'), value: 'Gotham Medium' }, { label: __('Gotham Bold'), value: 'Gotham Bold' }, { label: __('Gotham Bold Italic'), value: 'Gotham Bold Italic' }, { label: __('Gotham Black Regular'), value: 'Gotham Black Regular' }, { label: __('Gotham Light Regular'), value: 'Gotham Light Regular' }, { label: __('Gotham Thin Regular'), value: 'Gotham Thin Regular' }, { label: __('Gotham XLight Regular'), value: 'Gotham XLight Regular' }, { label: __('Gotham Book Italic'), value: 'Gotham Book Italic' }, { label: __('Gotham Thin Italic'), value: 'Gotham Thin Italic' }, { label: __('Gotham Ultra Italic'), value: 'Gotham Ultra Italic' }, { label: __('Vollkorn Black'), value: 'Vollkorn Black' }, { label: __('Vollkorn BlackItalic'), value: 'Vollkorn BlackItalic' }, { label: __('Vollkorn Bold'), value: 'Vollkorn Bold' }, { label: __('Vollkorn BoldItalic'), value: 'Vollkorn BoldItalic' }, { label: __('Vollkorn Italic'), value: 'Vollkorn Italic' }, { label: __('Vollkorn Regular'), value: 'Vollkorn Regular' }, { label: __('Vollkorn SemiBold'), value: 'Vollkorn SemiBold' }, { label: __('Vollkorn SemiBoldItalic'), value: 'Vollkorn SemiBoldItalic' }],
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
      var attributes = _ref2.attributes,
          props = _ref2.props;
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
          TextUppercase = attributes.TextUppercase;


      var ButtonStyle = {};
      FontSize && (ButtonStyle.fontSize = FontSize + 'px');
      FontFamily && (ButtonStyle.fontFamily = "" + FontFamily);
      paddingTop && (ButtonStyle.paddingTop = paddingTop + 'px');
      paddingBottom && (ButtonStyle.paddingBottom = paddingBottom + 'px');
      paddingLeft && (ButtonStyle.paddingLeft = paddingLeft + 'px');
      paddingRight && (ButtonStyle.paddingRight = paddingRight + 'px');
      marginTop && (ButtonStyle.marginTop = marginTop + 'px');
      marginBottom && (ButtonStyle.marginBottom = marginBottom + 'px');
      marginLeft && (ButtonStyle.marginLeft = marginLeft + 'px');
      marginRight && (ButtonStyle.marginRight = marginRight + 'px');
      TextUppercase && (ButtonStyle.textTransform = TextUppercase);
      BorderWidth && (ButtonStyle.border = BorderWidth + "px solid #" + BorderColor);
      BorderRadius && (ButtonStyle.borderRadius = BorderRadius + 'px');
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
/* 6 */
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
	    RangeControl = wpComponents.RangeControl;


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
				wp.element.createElement("path", { fill: "#0F6CB6", d: "M231.949,320.921l21.925-49.513c1.529-3.414,4.313-5.481,8.088-5.481h0.809 c3.773,0,6.469,2.067,7.997,5.481l21.926,49.513c0.449,0.988,0.72,1.887,0.72,2.785c0,3.685-2.875,6.65-6.56,6.65 c-3.235,0-5.392-1.888-6.649-4.764l-4.223-9.883h-27.677l-4.403,10.333c-1.168,2.695-3.504,4.313-6.38,4.313 c-3.596-0.001-6.38-2.876-6.38-6.471C231.141,322.897,231.5,321.909,231.949,320.921z M270.858,303.488l-8.717-20.758 l-8.716,20.758H270.858z" }),
				wp.element.createElement("path", { fill: "#0F6CB6", d: "M299.969,315.978v-0.18c0-10.513,7.998-15.365,19.41-15.365c4.853,0,8.357,0.809,11.772,1.977v-0.809 c0-5.661-3.505-8.806-10.335-8.806c-3.773,0-6.829,0.539-9.435,1.348c-0.809,0.269-1.348,0.358-1.979,0.358 c-3.144,0-5.66-2.426-5.66-5.571c0-2.426,1.527-4.493,3.684-5.302c4.313-1.618,8.987-2.516,15.366-2.516 c7.458,0,12.851,1.977,16.265,5.391c3.595,3.594,5.212,8.896,5.212,15.366v21.925c0,3.686-2.965,6.561-6.649,6.561 c-3.954,0-6.56-2.786-6.56-5.662v-0.09c-3.325,3.685-7.908,6.11-14.557,6.11C307.427,330.715,299.969,325.504,299.969,315.978z M331.33,312.833v-2.426c-2.337-1.078-5.392-1.798-8.717-1.798c-5.841,0-9.435,2.337-9.435,6.649v0.181 c0,3.684,3.055,5.841,7.458,5.841C327.017,321.28,331.33,317.775,331.33,312.833z" })
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
			HeadingColor: { type: 'string', default: '#000' },
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
			    fontFamily = attributes.fontFamily;


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

			return wp.element.createElement(
				Fragment,
				null,
				wp.element.createElement(RichText, {
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
										value: HeadingColor // Element Tag for Gutenberg standard colour selector
										, onChange: function onChange(HeadingColor) {
											return setAttributes({
												HeadingColor: HeadingColor
											});
										} // onChange event callback
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
									options: [{ label: __('Gotham Book'), value: 'Gotham Book' }, { label: __('Gotham Book Italic'), value: 'Gotham Book Italic' }, { label: __('Gotham Light'), value: 'Gotham Light' }, { label: __('Gotham Light Italic'), value: 'Gotham Light Italic' }, { label: __('Gotham Medium'), value: 'Gotham Medium' }, { label: __('Gotham Bold'), value: 'Gotham Bold' }, { label: __('Gotham Bold Italic'), value: 'Gotham Bold Italic' }, { label: __('Gotham Black Regular'), value: 'Gotham Black Regular' }, { label: __('Gotham Light Regular'), value: 'Gotham Light Regular' }, { label: __('Gotham Thin Regular'), value: 'Gotham Thin Regular' }, { label: __('Gotham XLight Regular'), value: 'Gotham XLight Regular' }, { label: __('Gotham Book Italic'), value: 'Gotham Book Italic' }, { label: __('Gotham Thin Italic'), value: 'Gotham Thin Italic' }, { label: __('Gotham Ultra Italic'), value: 'Gotham Ultra Italic' }, { label: __('Vollkorn Black'), value: 'Vollkorn Black' }, { label: __('Vollkorn BlackItalic'), value: 'Vollkorn BlackItalic' }, { label: __('Vollkorn Bold'), value: 'Vollkorn Bold' }, { label: __('Vollkorn BoldItalic'), value: 'Vollkorn BoldItalic' }, { label: __('Vollkorn Italic'), value: 'Vollkorn Italic' }, { label: __('Vollkorn Regular'), value: 'Vollkorn Regular' }, { label: __('Vollkorn SemiBold'), value: 'Vollkorn SemiBold' }, { label: __('Vollkorn SemiBoldItalic'), value: 'Vollkorn SemiBoldItalic' }],
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
			    fontFamily = attributes.fontFamily;


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

			return wp.element.createElement(
				Fragment,
				null,
				wp.element.createElement(RichText.Content, {
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
/* 7 */
/***/ (function(module, exports) {

(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
  var __ = wpI18n.__;
  var registerBlockType = wpBlocks.registerBlockType;
  var Fragment = wpElement.Fragment;
  var InspectorControls = wpEditor.InspectorControls,
      MediaUpload = wpEditor.MediaUpload,
      BlockControls = wpEditor.BlockControls;
  var TextControl = wpComponents.TextControl,
      PanelBody = wpComponents.PanelBody,
      PanelRow = wpComponents.PanelRow,
      Button = wpComponents.Button,
      RangeControl = wpComponents.RangeControl,
      ColorPalette = wpComponents.ColorPalette;


  var imageBlockIcon = wp.element.createElement(
    "svg",
    { width: "150px", height: "150px", viewBox: "222.64 222.641 150 150", "enable-background": "new 222.64 222.641 150 150" },
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M359.307,241.852H235.973c-3.293,0-5.973,2.679-5.973,5.972v99.631c0,3.294,2.679,5.973,5.972,5.973 h123.334c3.294,0,5.973-2.679,5.973-5.973v-99.631C365.279,244.531,362.601,241.852,359.307,241.852z M359.307,347.455 l-123.334,0.005c0,0,0-0.002,0-0.005v-99.631h123.334V347.455z" })
      )
    ),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M348.099,256.047H247.181c-1.649,0-2.986,1.337-2.986,2.986v66.002c0,1.648,1.337,2.985,2.986,2.985 h100.918c1.648,0,2.986-1.337,2.986-2.986v-66.001C351.085,257.384,349.748,256.047,348.099,256.047z M250.167,262.019h94.946 v50.554l-18.82-18.818c-1.165-1.166-3.056-1.166-4.223,0l-11.473,11.472l-26.305-26.305c-1.166-1.165-3.057-1.166-4.223,0 l-29.901,29.899L250.167,262.019L250.167,262.019z M250.167,322.048v-4.781l32.013-32.01l36.791,36.791H250.167L250.167,322.048z M345.112,322.048h-17.695l0,0l-12.597-12.597l9.361-9.361l20.244,20.242c0.209,0.208,0.44,0.378,0.687,0.512V322.048 L345.112,322.048z" })
      )
    ),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M310.413,267.686c-6.225,0-11.29,5.064-11.29,11.29c0,6.226,5.065,11.29,11.29,11.29 c6.226,0,11.29-5.064,11.29-11.29C321.703,272.75,316.638,267.686,310.413,267.686z M310.413,284.292 c-2.932,0-5.317-2.385-5.317-5.317c0-2.932,2.386-5.317,5.317-5.317s5.317,2.385,5.317,5.317 C315.73,281.907,313.345,284.292,310.413,284.292z" })
      )
    ),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M273.155,334.752h-25.975c-1.649,0-2.986,1.337-2.986,2.985c0,1.649,1.337,2.986,2.986,2.986h25.975 c1.649,0,2.986-1.337,2.986-2.986C276.141,336.089,274.805,334.752,273.155,334.752z" })
      )
    ),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M293.594,334.752h-6.813c-1.649,0-2.987,1.337-2.987,2.985c0,1.649,1.338,2.986,2.987,2.986h6.813 c1.649,0,2.986-1.337,2.986-2.986C296.581,336.089,295.243,334.752,293.594,334.752z" })
      )
    )
  );

  var IMAGE_TEMPLATE = [['core/image', {}]];

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
      }
    },
    edit: function edit(_ref) {
      var attributes = _ref.attributes,
          setAttributes = _ref.setAttributes;
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
          InsertUrl = attributes.InsertUrl,
          ImgAlignment = attributes.ImgAlignment;


      var ImageStyle = {};
      ImageWidth && (ImageStyle.width = ImageWidth + "px");
      ImageHeight && (ImageStyle.height = ImageHeight + "px");
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
            wp.element.createElement("img", { style: ImageStyle, src: attributes.imageUrl, alr: imageAlt, className: "image" })
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
          )
        ),
        wp.element.createElement(MediaUpload, {
          onSelect: function onSelect(media) {
            setAttributes({ imageAlt: media.alt, imageUrl: media.url });
          },
          type: "image",
          value: attributes.imageID,
          render: function render(_ref2) {
            var open = _ref2.open;
            return getImageButton(open);
          }
        }),
        wp.element.createElement(
          InspectorControls,
          null,
          wp.element.createElement(
            PanelBody,
            { title: "Dimensions", initialOpen: true },
            wp.element.createElement(
              PanelRow,
              null,
              wp.element.createElement(
                "div",
                { className: "inspector-field inspector-image-width" },
                wp.element.createElement(
                  "label",
                  null,
                  "Width"
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
                  "Height"
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
          )
        )
      );
    },
    save: function save(_ref3) {
      var attributes = _ref3.attributes;
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
          ImgAlignment = attributes.ImgAlignment;


      var ImageStyle = {};
      ImageWidth && (ImageStyle.width = ImageWidth + "px");
      ImageHeight && (ImageStyle.height = ImageHeight + "px");
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
        wp.element.createElement("img", { style: ImageStyle, src: imageUrl, alt: imageAlt })
      );
    }
  });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);

/***/ }),
/* 8 */
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
			wp.element.createElement("path", { fill: "#0F6CB6", d: "M544.93,449.158h-38.933c-2.975,0-5.383,2.409-5.383,5.383s2.408,5.383,5.383,5.383h38.933 c2.975,0,5.384-2.409,5.384-5.383S547.904,449.158,544.93,449.158z" }),
			wp.element.createElement("path", { fill: "#0F6CB6", d: "M505.997,498.44h26.014c2.975,0,5.383-2.409,5.383-5.383c0-2.975-2.408-5.383-5.383-5.383h-26.014 c-2.975,0-5.383,2.409-5.383,5.383C500.614,496.031,503.022,498.44,505.997,498.44z" }),
			wp.element.createElement("path", { fill: "#0F6CB6", d: "M554.418,468.416h-48.421c-2.975,0-5.383,2.409-5.383,5.383s2.408,5.383,5.383,5.383h48.421 c2.974,0,5.383-2.409,5.383-5.383S557.392,468.416,554.418,468.416z" }),
			wp.element.createElement("path", { fill: "#0F6CB6", d: "M554.418,506.945h-48.421c-2.975,0-5.383,2.409-5.383,5.384c0,2.974,2.408,5.383,5.383,5.383h48.421 c2.974,0,5.383-2.409,5.383-5.383C559.801,509.354,557.392,506.945,554.418,506.945z" }),
			wp.element.createElement("path", { fill: "#0F6CB6", d: "M554.418,526.203h-48.421c-2.975,0-5.383,2.409-5.383,5.384c0,2.974,2.408,5.383,5.383,5.383h48.421 c2.974,0,5.383-2.409,5.383-5.383C559.801,528.612,557.392,526.203,554.418,526.203z" }),
			wp.element.createElement("path", { fill: "#0F6CB6", d: "M482.769,448.566h-47.694c-4.455,0-8.075,3.62-8.075,8.075v73.52c0,4.455,3.62,8.074,8.075,8.074h47.694 c4.455,0,8.075-3.619,8.075-8.074v-73.52C490.843,452.173,487.237,448.566,482.769,448.566z" })
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
				type: 'string'
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
										className: "dashicons dashicons-align-left",
										onClick: function onClick() {
											return setAttributes({ BoxAlign: '1' });
										}
									})
								),
								wp.element.createElement(
									"div",
									{ className: "col-main-inner" },
									wp.element.createElement("span", {
										className: "dashicons dashicons-align-right",
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
/* 9 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_lodash_times__ = __webpack_require__(10);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_lodash_times___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_lodash_times__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_memize__ = __webpack_require__(26);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_memize___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1_memize__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__icons__ = __webpack_require__(0);
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
        'svg',
        { width: '150px', height: '150px', viewBox: '181 181 150 150', 'enable-background': 'new 181 181 150 150' },
        wp.element.createElement('path', { fill: '#0F6CB6', d: 'M321.437,192.815H190.563c-3.732,0-6.769,3.037-6.769,6.769v117.343c0,1.249,1.008,2.257,2.256,2.257h139.9 c1.247,0,2.257-1.008,2.257-2.257V199.584C328.207,195.853,325.169,192.815,321.437,192.815z M188.307,206.354h135.387v108.318 H188.307V206.354z M190.563,197.328h2.302c-1.246,0-2.243,1.009-2.243,2.257c0,1.248,1.02,2.256,2.268,2.256 c1.246,0,2.256-1.008,2.256-2.256c0-1.248-1.011-2.257-2.256-2.257h6.742c-1.246,0-2.243,1.009-2.243,2.257 c0,1.248,1.019,2.256,2.268,2.256c1.245,0,2.256-1.008,2.256-2.256c0-1.248-1.011-2.257-2.256-2.257h6.751 c-1.246,0-2.243,1.009-2.243,2.257c0,1.248,1.02,2.256,2.268,2.256c1.246,0,2.257-1.008,2.257-2.256 c0-1.248-1.011-2.257-2.257-2.257h115.004c1.246,0,2.257,1.011,2.257,2.257v2.256H206.43h-6.776h-6.767h-4.581v-2.256 C188.307,198.339,189.317,197.328,190.563,197.328z' }),
        wp.element.createElement('path', { fill: '#0F6CB6', d: 'M201.846,217.636h-4.513v-1.322l1.598-1.595c0.882-0.88,0.882-2.309,0-3.191 c-0.882-0.882-2.309-0.882-3.191,0l-2.257,2.254c-0.209,0.208-0.375,0.458-0.489,0.733c-0.115,0.275-0.173,0.569-0.173,0.864v4.513 v6.77c0,1.248,1.008,2.256,2.256,2.256h6.77c1.248,0,2.256-1.008,2.256-2.256v-6.77 C204.102,218.645,203.093,217.636,201.846,217.636z M199.589,224.405h-2.256v-2.256h2.256V224.405z' }),
        wp.element.createElement('path', { fill: '#0F6CB6', d: 'M215.384,228.918c1.248,0,2.256-1.008,2.256-2.256v-6.77c0-1.248-1.009-2.256-2.256-2.256h-4.513v-1.322 l1.597-1.595c0.882-0.88,0.882-2.309,0-3.191c-0.882-0.882-2.309-0.882-3.191,0l-2.256,2.254c-0.21,0.208-0.375,0.458-0.489,0.733 c-0.115,0.275-0.174,0.569-0.174,0.864v4.513v6.77c0,1.248,1.009,2.256,2.256,2.256H215.384L215.384,228.918z M213.127,224.405 h-2.256v-2.256h2.256V224.405z' }),
        wp.element.createElement('path', { fill: '#0F6CB6', d: 'M316.926,292.091h-6.769c-1.248,0-2.257,1.01-2.257,2.257v6.77c0,1.248,1.009,2.257,2.257,2.257h4.513v1.322 l-1.598,1.595c-0.882,0.881-0.882,2.309,0,3.191c0.439,0.44,1.018,0.661,1.595,0.661c0.578,0,1.155-0.221,1.596-0.661l2.257-2.254 c0.209-0.208,0.374-0.459,0.489-0.734c0.114-0.274,0.174-0.568,0.174-0.863v-4.514v-6.77 C319.183,293.101,318.174,292.091,316.926,292.091z M312.413,296.604h2.257v2.257h-2.257V296.604z' }),
        wp.element.createElement('path', { fill: '#0F6CB6', d: 'M303.388,292.091h-6.77c-1.248,0-2.256,1.01-2.256,2.257v6.77c0,1.248,1.008,2.257,2.256,2.257h4.513v1.322 l-1.597,1.595c-0.884,0.881-0.884,2.309,0,3.191c0.439,0.44,1.017,0.661,1.595,0.661c0.577,0,1.155-0.221,1.596-0.661l2.255-2.254 c0.211-0.208,0.375-0.459,0.491-0.734c0.114-0.274,0.173-0.568,0.173-0.863v-4.514v-6.77 C305.644,293.101,304.635,292.091,303.388,292.091z M298.874,296.604h2.257v2.257h-2.257V296.604z' }),
        wp.element.createElement('path', { fill: '#0F6CB6', d: 'M208.608,265.044c0,1.247,1.008,2.256,2.256,2.256h90.271c1.247,0,2.257-1.009,2.257-2.256 c0-1.248-1.01-2.257-2.257-2.257h-90.271C209.617,262.787,208.608,263.796,208.608,265.044L208.608,265.044z' }),
        wp.element.createElement('path', { fill: '#0F6CB6', d: 'M301.136,269.557h-90.271c-1.248,0-2.256,1.009-2.256,2.257c0,1.247,1.008,2.257,2.256,2.257h90.271 c1.247,0,2.257-1.01,2.257-2.257C303.393,270.565,302.383,269.557,301.136,269.557z' }),
        wp.element.createElement('path', { fill: '#0F6CB6', d: 'M303.393,278.582c0-1.247-1.01-2.257-2.257-2.257h-90.271c-1.248,0-2.256,1.01-2.256,2.257 c0,1.249,1.008,2.257,2.256,2.257h90.271C302.383,280.839,303.393,279.831,303.393,278.582z' }),
        wp.element.createElement('path', { fill: '#0F6CB6', d: 'M278.564,283.096h-45.129c-1.248,0-2.256,1.009-2.256,2.256c0,1.248,1.008,2.257,2.256,2.257h45.129 c1.248,0,2.256-1.009,2.256-2.257C280.82,284.104,279.813,283.096,278.564,283.096z' }),
        wp.element.createElement('path', { fill: '#0F6CB6', d: 'M245.957,254.637c0.014,0.012,0.031,0.021,0.045,0.034c2.726,2.235,6.208,3.581,10,3.581 c3.802,0,7.293-1.352,10.021-3.599c0.002-0.003,0.006-0.003,0.008-0.005c3.517-2.899,5.764-7.288,5.764-12.193 c0-8.708-7.087-15.795-15.795-15.795c-8.708,0-15.795,7.088-15.795,15.795C240.205,247.354,242.445,251.738,245.957,254.637 L245.957,254.637z M250.413,252.198c1.241-1.821,3.313-2.974,5.585-2.974c2.274,0,4.346,1.155,5.587,2.977 c-1.651,0.952-3.543,1.539-5.584,1.539C253.958,253.739,252.069,253.152,250.413,252.198L250.413,252.198z M256,244.711 c-1.246,0-2.257-1.011-2.257-2.256s1.011-2.257,2.257-2.257c1.245,0,2.257,1.011,2.257,2.257S257.245,244.711,256,244.711z M256,231.172c6.222,0,11.282,5.062,11.282,11.283c0,2.534-0.871,4.851-2.288,6.738c-0.916-1.212-2.082-2.2-3.389-2.952 c0.735-1.081,1.164-2.383,1.164-3.786c0-3.732-3.038-6.77-6.77-6.77c-3.732,0-6.769,3.037-6.769,6.77 c0,1.401,0.429,2.705,1.162,3.788c-1.307,0.752-2.471,1.737-3.39,2.95c-1.415-1.889-2.285-4.204-2.285-6.738 C244.718,236.233,249.779,231.172,256,231.172L256,231.172z' })
    );

    /**
     * Register: a Gutenberg Block.
     *
     * Registers a new block provided a unique name and an object defining its
     * behavior. Once registered, the block is made editor as an option to any
     * editor interface where blocks are implemented.
     *
     * @link https://wordpress.org/gutenberg/handbook/block-api/
     * @param  {string}   name     Block name.
     * @param  {Object}   settings Block settings.
     * @return {?WPBlock}          The block, if it has been successfully
     *                             registered; otherwise `undefined`.
     */

    var NabMediaSlider = function (_Component) {
        _inherits(NabMediaSlider, _Component);

        function NabMediaSlider() {
            _classCallCheck(this, NabMediaSlider);

            var _this = _possibleConstructorReturn(this, (NabMediaSlider.__proto__ || Object.getPrototypeOf(NabMediaSlider)).apply(this, arguments));

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

        _createClass(NabMediaSlider, [{
            key: 'componentDidUpdate',
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
            key: 'componentDidMount',
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
            key: 'initList',
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
            key: 'initSlider',
            value: function initSlider() {
                var _props$attributes3 = this.props.attributes,
                    autoplay = _props$attributes3.autoplay,
                    infiniteLoop = _props$attributes3.infiniteLoop,
                    pager = _props$attributes3.pager,
                    controls = _props$attributes3.controls,
                    adaptiveHeight = _props$attributes3.adaptiveHeight,
                    speed = _props$attributes3.speed,
                    mode = _props$attributes3.mode;
                var clientId = this.props.clientId;

                var sliderObj = $('#block-' + clientId + ' .wp-block-md-quotes-slider-block').bxSlider({
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
            key: 'reloadSlider',
            value: function reloadSlider() {
                var _props$attributes4 = this.props.attributes,
                    autoplay = _props$attributes4.autoplay,
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
            key: 'gotoLastSlider',
            value: function gotoLastSlider() {
                var gotoslide = this.props.attributes.quotes.length - 1;
                this.state.bxSliderObj.goToSlide(gotoslide);
                this.reloadSlider();
            }
        }, {
            key: 'render',
            value: function render() {
                var _this2 = this;

                var _props = this.props,
                    attributes = _props.attributes,
                    setAttributes = _props.setAttributes,
                    isSelected = _props.isSelected,
                    clientId = _props.clientId,
                    className = _props.className;
                var quotes = attributes.quotes,
                    id = attributes.id,
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
                        'div',
                        { className: 'quote-item' },
                        wp.element.createElement(
                            'span',
                            {
                                className: 'remove-quote',
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
                            wp.element.createElement('i', { className: 'fa fa-times' })
                        ),
                        wp.element.createElement(RichText, {
                            tagName: 'h3',
                            placeholder: __('Title'),
                            value: quote.title,
                            className: 'title',
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
                            tagName: 'p',
                            className: 'content',
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
                            tagName: 'p',
                            className: 'author',
                            placeholder: 'Author',
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
                            tagName: 'p',
                            placeholder: 'Link',
                            className: 'learnmore',
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
                    'div',
                    { id: 'block-' + clientId, className: 'quote-slider ' + quotesOptions + ' ' + sliderBgColor },
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
                                    label: __('Active Slider'),
                                    checked: sliderActive,
                                    onChange: function onChange() {
                                        return setAttributes({ sliderActive: !sliderActive });
                                    }
                                })
                            ),
                            wp.element.createElement(
                                'label',
                                null,
                                'Text Color'
                            ),
                            wp.element.createElement(
                                'ul',
                                { className: 'quote-color' },
                                wp.element.createElement('li', { className: 'white-slider ' + ('white-slider' === sliderBgColor ? 'active' : ''),
                                    onClick: function onClick(e) {
                                        setAttributes({ sliderBgColor: 'white-slider' });
                                    }
                                }),
                                wp.element.createElement('li', { className: 'black-slider ' + ('black-slider' === sliderBgColor ? 'active' : ''),
                                    onClick: function onClick(e) {
                                        setAttributes({ sliderBgColor: 'black-slider' });
                                    }
                                })
                            ),
                            wp.element.createElement(
                                'label',
                                null,
                                'Layout Options'
                            ),
                            wp.element.createElement(
                                PanelRow,
                                null,
                                wp.element.createElement(
                                    'ul',
                                    { className: 'quote-options' },
                                    wp.element.createElement(
                                        'li',
                                        { onClick: function onClick() {
                                                setAttributes({ quotesOptions: 'quotes-options-1' });setTimeout(function () {
                                                    return _this2.reloadSlider();
                                                }, 10);
                                            }, className: 'quotes-options-1' === quotesOptions ? 'active' : '' },
                                        __WEBPACK_IMPORTED_MODULE_2__icons__["q" /* quotesSliderSide */]
                                    ),
                                    wp.element.createElement(
                                        'li',
                                        { onClick: function onClick() {
                                                setAttributes({ quotesOptions: 'quotes-options-2' });setTimeout(function () {
                                                    return _this2.reloadSlider();
                                                }, 10);
                                            }, className: 'quotes-options-2' === quotesOptions ? 'active' : '' },
                                        __WEBPACK_IMPORTED_MODULE_2__icons__["p" /* quotesSliderBottom */]
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
                        )
                    ),
                    wp.element.createElement(
                        'div',
                        { className: className + ' quote-inner' },
                        quotesList
                    ),
                    wp.element.createElement(
                        'div',
                        { className: 'add-remove-btn' },
                        1 < quotes.length && false === sliderActive ? wp.element.createElement(
                            'button',
                            {
                                className: 'components-button current',
                                onClick: function onClick() {
                                    setAttributes({ sliderActive: true });
                                }
                            },
                            wp.element.createElement('span', { className: 'dashicons dashicons-yes' })
                        ) : '',
                        wp.element.createElement(
                            'button',
                            {
                                className: 'components-button add',
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
                            wp.element.createElement('span', { className: 'dashicons dashicons-plus' })
                        )
                    )
                );
            }
        }]);

        return NabMediaSlider;
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
        edit: NabMediaSlider,

        save: function save(props) {
            var _props$attributes5 = props.attributes,
                id = _props$attributes5.id,
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
            var clientId = props.clientId;


            var quotesList = quotes.map(function (quote) {
                var quoteClass = 0 == quote.index ? 'quote-item active' : 'quote-item';
                return wp.element.createElement(
                    'div',
                    { className: quoteClass, key: quote.index },
                    wp.element.createElement(
                        'div',
                        { className: 'content-block' },
                        quote.title && wp.element.createElement(RichText.Content, {
                            tagName: 'h3',
                            className: 'title',
                            value: quote.title
                        }),
                        quote.content && wp.element.createElement(RichText.Content, {
                            tagName: 'p',
                            className: 'content',
                            value: quote.content
                        }),
                        quote.author && 'quotes-options-2' === quotesOptions && wp.element.createElement(RichText.Content, {
                            tagName: 'strong',
                            className: 'author',
                            value: quote.author
                        }),
                        'quotes-options-1' === quotesOptions && wp.element.createElement(RichText.Content, {
                            tagName: 'p',
                            className: 'learnmore',
                            value: '' === quote.link ? 'Learn More' : quote.link
                        })
                    )
                );
            });
            if (0 < quotes.length) {
                return wp.element.createElement(
                    'div',
                    { id: 'block-' + clientId, className: 'quote-slider ' + quotesOptions + ' ' + sliderBgColor },
                    wp.element.createElement(
                        'div',
                        { className: 'quote-inner', 'data-mode': mode, 'data-autoplay': '' + autoplay, 'data-speed': '' + speed, 'data-infiniteloop': '' + infiniteLoop, 'data-pager': '' + pager, 'data-controls': '' + controls, 'data-adaptiveheight': '' + adaptiveHeight },
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
/* 10 */
/***/ (function(module, exports, __webpack_require__) {

var baseTimes = __webpack_require__(11),
    castFunction = __webpack_require__(12),
    toInteger = __webpack_require__(14);

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
/* 11 */
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
/* 12 */
/***/ (function(module, exports, __webpack_require__) {

var identity = __webpack_require__(13);

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
/* 13 */
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
/* 14 */
/***/ (function(module, exports, __webpack_require__) {

var toFinite = __webpack_require__(15);

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
/* 15 */
/***/ (function(module, exports, __webpack_require__) {

var toNumber = __webpack_require__(16);

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
/* 16 */
/***/ (function(module, exports, __webpack_require__) {

var isObject = __webpack_require__(17),
    isSymbol = __webpack_require__(18);

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
/* 17 */
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
/* 18 */
/***/ (function(module, exports, __webpack_require__) {

var baseGetTag = __webpack_require__(19),
    isObjectLike = __webpack_require__(25);

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
/* 19 */
/***/ (function(module, exports, __webpack_require__) {

var Symbol = __webpack_require__(1),
    getRawTag = __webpack_require__(23),
    objectToString = __webpack_require__(24);

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
/* 20 */
/***/ (function(module, exports, __webpack_require__) {

var freeGlobal = __webpack_require__(21);

/** Detect free variable `self`. */
var freeSelf = typeof self == 'object' && self && self.Object === Object && self;

/** Used as a reference to the global object. */
var root = freeGlobal || freeSelf || Function('return this')();

module.exports = root;


/***/ }),
/* 21 */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(global) {/** Detect free variable `global` from Node.js. */
var freeGlobal = typeof global == 'object' && global && global.Object === Object && global;

module.exports = freeGlobal;

/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(22)))

/***/ }),
/* 22 */
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
/* 23 */
/***/ (function(module, exports, __webpack_require__) {

var Symbol = __webpack_require__(1);

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
/* 24 */
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
/* 25 */
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
/* 26 */
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

/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(27)))

/***/ }),
/* 27 */
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
/* 28 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__icons__ = __webpack_require__(0);
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
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M403.72,325.373h-4.612c-3.82,0-6.918,3.097-6.918,6.918v55.352c0,1.274-1.033,2.307-2.308,2.307h-96.865 c-1.273,0-2.307-1.032-2.307-2.307v-55.352c0-3.821-3.097-6.918-6.917-6.918h-4.614c-3.82,0-6.919,3.097-6.919,6.918v69.189 c0,3.821,3.098,6.919,6.919,6.919H403.72c3.82,0,6.919-3.098,6.919-6.919v-69.189C410.639,328.47,407.54,325.373,403.72,325.373z M406.026,401.48c0,1.274-1.032,2.306-2.307,2.306H279.179c-1.273,0-2.306-1.031-2.306-2.306v-69.189 c0-1.274,1.033-2.306,2.306-2.306h4.614c1.273,0,2.305,1.032,2.305,2.306v55.352c0,3.821,3.097,6.919,6.919,6.919h96.865 c3.822,0,6.92-3.098,6.92-6.919v-55.352c0-1.274,1.032-2.306,2.306-2.306h4.612c1.274,0,2.307,1.032,2.307,2.306V401.48 L406.026,401.48z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M323,332.291c0-3.821-3.097-6.918-6.92-6.918h-13.837c-3.821,0-6.92,3.097-6.92,6.918v13.838 c0,3.821,3.098,6.919,6.92,6.919h13.837c3.823,0,6.92-3.098,6.92-6.919V332.291z M318.387,346.129c0,1.273-1.033,2.306-2.308,2.306 h-13.837c-1.274,0-2.306-1.032-2.306-2.306v-13.838c0-1.274,1.032-2.306,2.306-2.306h13.837c1.274,0,2.308,1.032,2.308,2.306 V346.129L318.387,346.129z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M316.08,357.659h-13.837c-3.821,0-6.919,3.099-6.919,6.92v13.839c0,3.819,3.098,6.917,6.919,6.917h13.837 c3.823,0,6.92-3.098,6.92-6.917v-13.839C323,360.758,319.902,357.659,316.08,357.659z M318.387,378.418 c0,1.273-1.033,2.305-2.308,2.305h-13.837c-1.274,0-2.306-1.031-2.306-2.305v-13.839c0-1.274,1.032-2.306,2.306-2.306h13.837 c1.274,0,2.308,1.032,2.308,2.306V378.418L318.387,378.418z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M334.531,385.334h13.837c3.821,0,6.92-3.097,6.92-6.916v-13.839c0-3.821-3.099-6.92-6.92-6.92h-13.837 c-3.821,0-6.919,3.099-6.919,6.92v13.839C327.612,382.237,330.71,385.334,334.531,385.334z M332.225,364.579 c0-1.274,1.032-2.306,2.306-2.306h13.837c1.274,0,2.305,1.032,2.305,2.306v13.839c0,1.273-1.03,2.305-2.305,2.305h-13.837 c-1.274,0-2.306-1.031-2.306-2.305V364.579z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M387.576,332.291c0-3.821-3.097-6.918-6.919-6.918h-13.838c-3.823,0-6.92,3.097-6.92,6.918v13.838 c0,3.821,3.097,6.919,6.92,6.919h13.838c3.821,0,6.919-3.098,6.919-6.919V332.291z M382.964,346.129 c0,1.273-1.032,2.306-2.307,2.306h-13.838c-1.273,0-2.308-1.032-2.308-2.306v-13.838c0-1.274,1.034-2.306,2.308-2.306h13.838 c1.274,0,2.307,1.032,2.307,2.306V346.129z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M380.657,357.659h-13.838c-3.822,0-6.92,3.099-6.92,6.92v13.839c0,3.819,3.098,6.917,6.92,6.917h13.838 c3.822,0,6.919-3.098,6.919-6.917v-13.839C387.576,360.758,384.479,357.659,380.657,357.659z M382.964,378.418 c0,1.273-1.032,2.305-2.307,2.305h-13.838c-1.273,0-2.308-1.031-2.308-2.305v-13.839c0-1.274,1.034-2.306,2.308-2.306h13.838 c1.274,0,2.307,1.032,2.307,2.306V378.418z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M343.756,313.84v-30.374c0.004-2.797-1.677-5.323-4.261-6.398c-2.582-1.076-5.558-0.488-7.541,1.485 l-6.228,6.227l-12.629-12.611c-2.703-2.701-7.081-2.701-9.783,0l-8.146,8.148c-2.701,2.701-2.701,7.081,0,9.784l12.622,12.623 l-6.228,6.226c-1.977,1.979-2.567,4.957-1.495,7.541c1.073,2.584,3.595,4.27,6.395,4.268h30.374 C340.657,320.759,343.756,317.661,343.756,313.84z M304.317,314.717c-0.367-0.855-0.169-1.848,0.497-2.498l7.864-7.864 c0.901-0.901,0.901-2.36,0-3.262l-14.25-14.253c-0.9-0.9-0.9-2.36,0-3.26l8.145-8.146c0.902-0.9,2.361-0.9,3.262,0l14.253,14.253 c0.9,0.9,2.36,0.9,3.261,0l7.864-7.865c0.663-0.657,1.655-0.85,2.513-0.49c0.861,0.36,1.419,1.204,1.417,2.135v30.374 c0,1.273-1.033,2.306-2.306,2.306h-30.374C305.521,316.16,304.667,315.592,304.317,314.717z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M332.225,300.002c-1.275,0-2.308,1.033-2.308,2.306v4.613h-4.612c-1.272,0-2.305,1.033-2.305,2.307 c0,1.273,1.033,2.306,2.305,2.306h4.612c2.548,0,4.614-2.065,4.614-4.613v-4.613C334.531,301.035,333.498,300.002,332.225,300.002z"
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
                        if (0 < $("#block-" + clientId + " .nab-not-to-be-missed-slider").length && this.state.bxSliderObj && undefined !== this.state.bxSliderObj.reloadSlider) {

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

                if (0 < $("#block-" + clientId + " .nab-not-to-be-missed-slider").length) {
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

                    var sliderObj = $("#block-" + clientId + " .nab-not-to-be-missed-slider").bxSlider({ minSlides: minSlides, maxSlides: minSlides, slideMargin: slideMargin, moveSlides: 1, slideWidth: slideWidth, auto: autoplay, infiniteLoop: infiniteLoop, pager: pager, controls: controls, speed: sliderSpeed, mode: sliderMode });
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


                var names = [{ name: __WEBPACK_IMPORTED_MODULE_0__icons__["w" /* sliderArrow1 */], classnames: 'slider-arrow-1' }, { name: __WEBPACK_IMPORTED_MODULE_0__icons__["x" /* sliderArrow2 */], classnames: 'slider-arrow-2' }, { name: __WEBPACK_IMPORTED_MODULE_0__icons__["y" /* sliderArrow3 */], classnames: 'slider-arrow-3' }, { name: __WEBPACK_IMPORTED_MODULE_0__icons__["z" /* sliderArrow4 */], classnames: 'slider-arrow-4' }, { name: __WEBPACK_IMPORTED_MODULE_0__icons__["A" /* sliderArrow5 */], classnames: 'slider-arrow-5' }, { name: __WEBPACK_IMPORTED_MODULE_0__icons__["B" /* sliderArrow6 */], classnames: 'slider-arrow-6' }];

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
                        max: 20,
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
/* 29 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__icons__ = __webpack_require__(0);
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
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M361.149,232.16H257.783c-3.932,0-7.13,3.199-7.13,7.131v10.825h-16.521c-3.932,0-7.131,3.199-7.131,7.131 v91.76c0,7.627,6.18,13.837,13.796,13.893h0.028c0.025,0.001,0.047,0.003,0.072,0.003h73.208c1.143,0,2.07-0.926,2.07-2.069 c0-1.143-0.928-2.07-2.07-2.07h-63.323c2.478-2.51,4.011-5.957,4.011-9.756v-48.396c0-1.143-0.927-2.069-2.07-2.069 c-1.144,0-2.069,0.926-2.069,2.069v48.396c0,5.361-4.348,9.726-9.704,9.755c-0.018,0-0.035-0.002-0.053-0.002 c-5.38-0.001-9.757-4.376-9.757-9.753v-91.76c0-1.649,1.342-2.992,2.992-2.992h16.521v38.63c0,1.144,0.926,2.07,2.07,2.07 c1.143,0,2.07-0.926,2.07-2.07v-53.595c0-1.65,1.342-2.992,2.991-2.992h103.365c1.65,0,2.992,1.342,2.992,2.992v109.717 c0,5.38-4.377,9.756-9.757,9.756h-32.553c-1.144,0-2.069,0.927-2.069,2.069c0,1.145,0.926,2.07,2.069,2.07h32.554 c7.662,0,13.896-6.233,13.896-13.896V239.291C368.28,235.359,365.081,232.16,361.149,232.16z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M272.342,314.738h28.383c2.7,0,4.897-2.197,4.897-4.897v-28.384c0-2.7-2.197-4.896-4.897-4.896h-28.383 c-2.7,0-4.897,2.197-4.897,4.896v28.384C267.445,312.541,269.642,314.738,272.342,314.738z M271.584,281.457 c0-0.418,0.34-0.757,0.758-0.757h28.383c0.418,0,0.758,0.339,0.758,0.757v28.384c0,0.417-0.34,0.759-0.758,0.759h-28.383 c-0.418,0-0.758-0.342-0.758-0.759V281.457z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M313.146,280.699h38.41c1.143,0,2.07-0.926,2.07-2.069c0-1.144-0.928-2.07-2.07-2.07h-38.41 c-1.143,0-2.069,0.926-2.069,2.07C311.076,279.773,312.003,280.699,313.146,280.699z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M313.146,297.719h38.41c1.143,0,2.07-0.927,2.07-2.07c0-1.144-0.928-2.069-2.07-2.069h-38.41 c-1.143,0-2.069,0.926-2.069,2.069C311.076,296.792,312.003,297.719,313.146,297.719z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M313.146,314.738h38.41c1.143,0,2.07-0.928,2.07-2.07s-0.928-2.069-2.07-2.069h-38.41 c-1.143,0-2.069,0.926-2.069,2.069C311.076,313.811,312.003,314.738,313.146,314.738z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M269.515,331.757h82.041c1.143,0,2.07-0.926,2.07-2.07c0-1.142-0.928-2.069-2.07-2.069h-82.041 c-1.142,0-2.069,0.927-2.069,2.069C267.445,330.831,268.373,331.757,269.515,331.757z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M269.515,348.776h82.041c1.143,0,2.07-0.926,2.07-2.069s-0.928-2.07-2.07-2.07h-82.041 c-1.142,0-2.069,0.927-2.069,2.07S268.373,348.776,269.515,348.776z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M267.498,265.97v-21.868c0-0.45,0.213-0.792,0.641-1.027c0.427-0.236,0.944-0.354,1.55-0.354 c0.81,0,1.426,0.146,1.854,0.439c0.426,0.292,0.898,0.921,1.416,1.886l6.502,12.569v-13.546c0-0.449,0.213-0.786,0.64-1.011 c0.426-0.225,0.943-0.338,1.55-0.338c0.606,0,1.123,0.113,1.549,0.338c0.427,0.225,0.641,0.562,0.641,1.011v21.901 c0,0.428-0.22,0.765-0.658,1.011c-0.438,0.248-0.949,0.371-1.533,0.371c-1.191,0-2.034-0.46-2.527-1.382l-7.245-13.545v13.545 c0,0.428-0.219,0.764-0.656,1.011c-0.438,0.248-0.95,0.371-1.534,0.371c-0.605,0-1.123-0.123-1.549-0.371 C267.711,266.734,267.498,266.398,267.498,265.97z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M287.884,265.97v-21.868c0-0.427,0.191-0.763,0.573-1.011c0.381-0.247,0.83-0.371,1.348-0.371h11.996 c0.448,0,0.792,0.192,1.027,0.574s0.354,0.82,0.354,1.314c0,0.539-0.124,1-0.371,1.381c-0.248,0.383-0.585,0.573-1.011,0.573h-9.536 v6.739h5.122c0.426,0,0.763,0.174,1.011,0.522c0.247,0.348,0.371,0.758,0.371,1.23c0,0.427-0.118,0.814-0.354,1.163 c-0.236,0.348-0.578,0.521-1.027,0.521h-5.122v6.773h9.536c0.426,0,0.763,0.191,1.011,0.572c0.247,0.383,0.371,0.843,0.371,1.382 c0,0.494-0.118,0.932-0.354,1.314c-0.235,0.382-0.579,0.572-1.027,0.572h-11.996c-0.518,0-0.966-0.123-1.347-0.37 C288.075,266.734,287.884,266.398,287.884,265.97z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M305.373,244.473c0-0.472,0.303-0.882,0.909-1.23s1.235-0.523,1.887-0.523c0.81,0,1.292,0.292,1.448,0.876 l5.325,18.264l2.864-11.726c0.201-0.81,0.92-1.214,2.155-1.214c1.213,0,1.921,0.404,2.123,1.214l2.864,11.726l5.323-18.264 c0.157-0.584,0.641-0.876,1.45-0.876c0.651,0,1.279,0.175,1.886,0.523c0.607,0.348,0.91,0.758,0.91,1.23 c0,0.135-0.022,0.27-0.067,0.404l-6.672,21.194c-0.337,0.99-1.292,1.483-2.863,1.483c-0.674,0-1.281-0.13-1.819-0.388 c-0.539-0.258-0.866-0.623-0.978-1.095l-2.156-9.097l-2.19,9.097c-0.113,0.472-0.438,0.837-0.978,1.095 c-0.539,0.258-1.146,0.388-1.819,0.388c-0.696,0-1.313-0.13-1.853-0.388c-0.54-0.258-0.877-0.623-1.012-1.095l-6.672-21.194 C305.395,244.742,305.373,244.607,305.373,244.473z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M335.631,262.477c0-0.516,0.196-1.039,0.59-1.567c0.393-0.527,0.836-0.791,1.331-0.791 c0.291,0,0.623,0.14,0.994,0.42c0.37,0.279,0.729,0.589,1.078,0.927c0.348,0.338,0.848,0.648,1.5,0.928 c0.65,0.28,1.37,0.419,2.155,0.419c1.079,0,1.977-0.247,2.696-0.742c0.719-0.494,1.078-1.223,1.078-2.189 c0-0.675-0.197-1.275-0.59-1.803c-0.393-0.527-0.91-0.966-1.55-1.314s-1.342-0.686-2.105-1.011 c-0.765-0.325-1.533-0.691-2.309-1.095c-0.775-0.404-1.482-0.859-2.122-1.365c-0.641-0.506-1.158-1.179-1.551-2.022 c-0.393-0.842-0.589-1.803-0.589-2.88c0-1.208,0.241-2.275,0.725-3.198c0.482-0.924,1.128-1.642,1.937-2.155 c0.809-0.513,1.673-0.889,2.595-1.128c0.92-0.239,1.898-0.36,2.932-0.36c0.583,0,1.201,0.041,1.854,0.122 c0.65,0.081,1.342,0.213,2.072,0.398c0.729,0.184,1.324,0.473,1.785,0.864c0.46,0.393,0.691,0.854,0.691,1.385 c0,0.5-0.158,1.018-0.472,1.552c-0.314,0.535-0.741,0.801-1.28,0.801c-0.203,0-0.754-0.213-1.651-0.64 c-0.899-0.427-1.898-0.64-2.999-0.64c-1.214,0-2.151,0.23-2.813,0.691c-0.663,0.461-0.995,1.095-0.995,1.904 c0,0.652,0.27,1.219,0.81,1.702c0.539,0.483,1.208,0.876,2.005,1.179c0.797,0.303,1.662,0.686,2.595,1.146 c0.932,0.46,1.797,0.96,2.595,1.499c0.796,0.539,1.466,1.319,2.005,2.341c0.539,1.023,0.809,2.219,0.809,3.589 c0,2.303-0.736,4.082-2.207,5.333c-1.473,1.251-3.409,1.877-5.813,1.877c-2.135,0-3.965-0.439-5.492-1.315 C336.395,264.466,335.631,263.511,335.631,262.477z" })
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
                                    max: 20,
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
                                            __WEBPACK_IMPORTED_MODULE_0__icons__["l" /* latestShowNews1 */]
                                        ),
                                        wp.element.createElement(
                                            "li",
                                            { className: 'left' === postLayout ? 'active' : '', onClick: function onClick() {
                                                    return setAttributes({ postLayout: 'left' });
                                                } },
                                            __WEBPACK_IMPORTED_MODULE_0__icons__["n" /* latestShowNews3 */]
                                        ),
                                        wp.element.createElement(
                                            "li",
                                            { className: 'top' === postLayout ? 'active full' : 'full', onClick: function onClick() {
                                                    return setAttributes({ postLayout: 'top' });
                                                } },
                                            __WEBPACK_IMPORTED_MODULE_0__icons__["m" /* latestShowNews2 */]
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
/* 30 */
/***/ (function(module, exports) {

(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    var __ = wpI18n.__;
    var Fragment = wpElement.Fragment;
    var registerBlockType = wpBlocks.registerBlockType;
    var InspectorControls = wpEditor.InspectorControls,
        MediaUpload = wpEditor.MediaUpload,
        BlockControls = wpEditor.BlockControls;
    var PanelBody = wpComponents.PanelBody,
        PanelRow = wpComponents.PanelRow,
        DateTimePicker = wpComponents.DateTimePicker,
        Toolbar = wpComponents.Toolbar,
        IconButton = wpComponents.IconButton,
        ToggleControl = wpComponents.ToggleControl,
        TextControl = wpComponents.TextControl,
        ServerSideRender = wpComponents.ServerSideRender,
        Button = wpComponents.Button,
        Placeholder = wpComponents.Placeholder;


    var adUploadIcon = wp.element.createElement(
        "svg",
        { xmlns: "http://www.w3.org/2000/svg", width: "20", height: "20", viewBox: "2 2 22 22", className: "dashicon" },
        wp.element.createElement("path", { fill: "none", d: "M0 0h24v24H0V0z" }),
        wp.element.createElement("path", { d: "M20 4h-3.17L15 2H9L7.17 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zM9.88 4h4.24l1.83 2H20v12H4V6h4.05" }),
        wp.element.createElement("path", { d: "M15 11H9V8.5L5.5 12 9 15.5V13h6v2.5l3.5-3.5L15 8.5z" })
    );

    var adBlockIcon = wp.element.createElement(
        "svg",
        { width: "150px", height: "150px", viewBox: "0 0 150 150", "enable-background": "new 0 0 150 150" },
        wp.element.createElement(
            "g",
            null,
            wp.element.createElement(
                "g",
                null,
                wp.element.createElement(
                    "g",
                    null,
                    wp.element.createElement("path", { fill: "#146DB6", d: "M133.758,4.449H16.676c-7.175,0-13.009,5.834-13.009,13.009v117.083c0,7.175,5.834,13.009,13.009,13.009 h117.082c7.176,0,13.011-5.834,13.011-13.009V17.458C146.768,10.283,140.934,4.449,133.758,4.449z M140.263,134.541 c0,3.585-2.919,6.506-6.505,6.506H16.676c-3.586,0-6.505-2.921-6.505-6.506V36.972h130.092V134.541L140.263,134.541z M140.263,30.467H10.171V17.458c0-3.586,2.918-6.504,6.505-6.504h117.082c3.586,0,6.505,2.918,6.505,6.504V30.467L140.263,30.467 z" }),
                    wp.element.createElement("circle", { fill: "#146DB6", cx: "19.928", cy: "20.71", r: "3.252" }),
                    wp.element.createElement("circle", { fill: "#146DB6", cx: "32.938", cy: "20.71", r: "3.252" }),
                    wp.element.createElement("circle", { fill: "#146DB6", cx: "45.946", cy: "20.71", r: "3.252" }),
                    wp.element.createElement("path", { fill: "#146DB6", d: "M26.433,108.521h65.045c1.798,0,3.252-1.454,3.252-3.252V53.234c0-1.798-1.455-3.253-3.252-3.253H26.433 c-1.798,0-3.253,1.455-3.253,3.253v52.036C23.18,107.067,24.635,108.521,26.433,108.521z M29.685,56.485h58.541v45.533H29.685 V56.485z" }),
                    wp.element.createElement("path", { fill: "#146DB6", d: "M45.946,62.99c-5.379,0-9.756,4.377-9.756,9.756v19.515c0,1.797,1.455,3.252,3.253,3.252 c1.797,0,3.252-1.455,3.252-3.252V89.01h6.504v3.251c0,1.797,1.455,3.252,3.253,3.252c1.797,0,3.251-1.455,3.251-3.252V72.746 C55.704,67.367,51.327,62.99,45.946,62.99z M49.199,82.503h-6.505v-9.757c0-1.794,1.458-3.251,3.252-3.251 c1.795,0,3.253,1.458,3.253,3.251V82.503L49.199,82.503z" }),
                    wp.element.createElement("path", { fill: "#146DB6", d: "M71.964,62.99H65.46c-1.797,0-3.252,1.455-3.252,3.253v26.018c0,1.797,1.455,3.252,3.252,3.252h6.504 c5.381,0,9.757-4.377,9.757-9.755V72.746C81.722,67.367,77.346,62.99,71.964,62.99z M75.217,85.758 c0,1.792-1.458,3.252-3.253,3.252h-3.251V69.495h3.251c1.795,0,3.253,1.458,3.253,3.251V85.758L75.217,85.758z" }),
                    wp.element.createElement("path", { fill: "#146DB6", d: "M26.433,128.037h97.569c1.797,0,3.251-1.454,3.251-3.254c0-1.797-1.454-3.252-3.251-3.252H26.433 c-1.798,0-3.253,1.455-3.253,3.254C23.18,126.583,24.635,128.037,26.433,128.037z" }),
                    wp.element.createElement("path", { fill: "#146DB6", d: "M104.487,69.495h19.515c1.799,0,3.253-1.455,3.253-3.251c0-1.798-1.456-3.253-3.253-3.253h-19.515 c-1.798,0-3.251,1.456-3.251,3.253C101.236,68.04,102.689,69.495,104.487,69.495z" }),
                    wp.element.createElement("path", { fill: "#146DB6", d: "M104.487,89.01h19.515c1.799,0,3.253-1.455,3.253-3.252c0-1.8-1.456-3.255-3.253-3.255h-19.515 c-1.798,0-3.251,1.457-3.251,3.255C101.236,87.555,102.689,89.01,104.487,89.01z" }),
                    wp.element.createElement("path", { fill: "#146DB6", d: "M104.487,108.521h19.515c1.799,0,3.253-1.454,3.253-3.252c0-1.797-1.456-3.251-3.253-3.251h-19.515 c-1.798,0-3.251,1.454-3.251,3.251C101.236,107.067,102.689,108.521,104.487,108.521z" })
                )
            )
        )
    );

    var allAttr = {
        imgSource: {
            type: 'string'
        },
        imgID: {
            type: 'number'
        },
        imgWidth: {
            type: 'number'
        },
        imgHeight: {
            type: 'number'
        },
        linkURL: {
            type: 'string'
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
        eventCategory: {
            type: 'string'
        },
        eventAction: {
            type: 'string'
        },
        eventLabel: {
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
        edit: function edit(props) {
            var _props$attributes = props.attributes,
                imgSource = _props$attributes.imgSource,
                imgID = _props$attributes.imgID,
                imgWidth = _props$attributes.imgWidth,
                imgHeight = _props$attributes.imgHeight,
                linkURL = _props$attributes.linkURL,
                linkTarget = _props$attributes.linkTarget,
                scheduleAd = _props$attributes.scheduleAd,
                startDate = _props$attributes.startDate,
                endDate = _props$attributes.endDate,
                eventCategory = _props$attributes.eventCategory,
                eventAction = _props$attributes.eventAction,
                eventLabel = _props$attributes.eventLabel,
                showCal = _props$attributes.showCal,
                addAlign = _props$attributes.addAlign,
                setAttributes = props.setAttributes;


            var style = {};
            imgWidth && (style.width = imgWidth + 'px');
            imgHeight && (style.height = imgHeight + 'px');

            $(document).on('click', '.inspector-field-toggleCal .components-form-toggle__input', function (e) {
                e.stopImmediatePropagation();
                if (!$('.inspector-field-datetime .components-datetime__date').hasClass('toggled')) {
                    $('.inspector-field-datetime .components-datetime__date').show();
                    $('.components-datetime .components-datetime__date').addClass('toggled');
                    $('.components-datetime .components-datetime__date > div').removeClass('DayPicker__hidden');
                    setAttributes({ showCal: !showCal });
                } else {
                    $('.inspector-field-datetime .components-datetime__date').hide();
                    $('.components-datetime .components-datetime__date').removeClass('toggled');
                    $('.components-datetime .components-datetime__date > div').addClass('DayPicker__hidden');
                    setAttributes({ showCal: showCal });
                }
            });

            if (!imgID) {
                return wp.element.createElement(
                    Placeholder,
                    {
                        icon: adUploadIcon,
                        label: __('Advertisement'),
                        instructions: __('No image selected. Add image to start using this block.')
                    },
                    wp.element.createElement(MediaUpload, {
                        allowedTypes: ['image'],
                        value: null,
                        onSelect: function onSelect(item) {
                            return setAttributes({ imgSource: item.url, imgID: item.id });
                        },
                        render: function render(_ref) {
                            var open = _ref.open;
                            return wp.element.createElement(
                                Button,
                                { className: "button button-large button-primary", onClick: open },
                                __('Add image')
                            );
                        }
                    })
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
                                "div",
                                { className: "inspector-field inspector-field-toggleCal components-base-control" },
                                wp.element.createElement(
                                    "div",
                                    { className: "toggleCalender" },
                                    wp.element.createElement(
                                        "span",
                                        { className: "cal" },
                                        wp.element.createElement(
                                            "svg",
                                            { xmlns: "http://www.w3.org/2000/svg", viewBox: "0 0 448 512" },
                                            wp.element.createElement("path", {
                                                d: "M436 160H12c-6.6 0-12-5.4-12-12v-36c0-26.5 21.5-48 48-48h48V12c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v52h128V12c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v52h48c26.5 0 48 21.5 48 48v36c0 6.6-5.4 12-12 12zM12 192h424c6.6 0 12 5.4 12 12v260c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V204c0-6.6 5.4-12 12-12zm116 204c0-6.6-5.4-12-12-12H76c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12v-40zm0-128c0-6.6-5.4-12-12-12H76c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12v-40zm128 128c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12v-40zm0-128c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12v-40zm128 128c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12v-40zm0-128c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12v-40z" })
                                        )
                                    ),
                                    wp.element.createElement(
                                        "span",
                                        { className: "text" },
                                        "Toggle Calendar"
                                    )
                                ),
                                wp.element.createElement(ToggleControl, {
                                    checked: showCal
                                })
                            ),
                            wp.element.createElement(
                                "div",
                                { className: "inspector-field inspector-field-datetime components-base-control" },
                                wp.element.createElement(
                                    "label",
                                    { className: "inspector-mb-0" },
                                    "Select Date time to start display"
                                ),
                                wp.element.createElement(
                                    "div",
                                    { className: "inspector-ml-auto" },
                                    wp.element.createElement(DateTimePicker, {
                                        currentDate: startDate,
                                        onChange: function onChange(date) {
                                            return setAttributes({ startDate: date });
                                        }
                                    })
                                )
                            ),
                            wp.element.createElement(
                                "div",
                                { className: "inspector-field inspector-field-datetime components-base-control" },
                                wp.element.createElement(
                                    "label",
                                    { className: "inspector-mb-0" },
                                    "Select Date time to remove"
                                ),
                                wp.element.createElement(
                                    "div",
                                    { className: "inspector-ml-auto" },
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
                                "div",
                                { className: "inspector-field alignment-settings" },
                                wp.element.createElement(
                                    "div",
                                    { className: "alignment-wrapper" },
                                    wp.element.createElement(TextControl, {
                                        label: "Width",
                                        type: "number",
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
                                    "div",
                                    { className: "alignment-wrapper" },
                                    wp.element.createElement(TextControl, {
                                        label: "Height",
                                        type: "number",
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
                                        { className: 'left' === addAlign ? 'active  inspector-button' : 'inspector-button', onClick: function onClick() {
                                                return setAttributes({ addAlign: 'left' });
                                            } },
                                        wp.element.createElement("i", { className: "fa fa-align-left" })
                                    ),
                                    wp.element.createElement(
                                        "button",
                                        { className: 'center' === addAlign ? 'active  inspector-button' : 'inspector-button', onClick: function onClick() {
                                                return setAttributes({ addAlign: 'center' });
                                            } },
                                        wp.element.createElement("i", { className: "fa fa-align-center" })
                                    ),
                                    wp.element.createElement(
                                        "button",
                                        { className: 'right' === addAlign ? 'active  inspector-button' : 'inspector-button', onClick: function onClick() {
                                                return setAttributes({ addAlign: 'right' });
                                            } },
                                        wp.element.createElement("i", { className: "fa fa-align-right" })
                                    )
                                )
                            )
                        )
                    ),
                    wp.element.createElement(
                        PanelBody,
                        { title: __('Link Settings'), initialOpen: false },
                        wp.element.createElement(TextControl, {
                            label: "Link URL",
                            type: "string",
                            value: linkURL,
                            placeholder: "`https://`",
                            onChange: function onChange(link) {
                                return setAttributes({ linkURL: link });
                            }
                        }),
                        wp.element.createElement(ToggleControl, {
                            label: __('Open in New Tab'),
                            checked: linkTarget,
                            onChange: function onChange() {
                                return setAttributes({ linkTarget: !linkTarget });
                            }
                        })
                    ),
                    wp.element.createElement(
                        PanelBody,
                        { title: __('Google Event'), initialOpen: false },
                        wp.element.createElement(TextControl, {
                            label: "Event Category",
                            type: "string",
                            value: eventCategory,
                            placeholder: "Enter Category",
                            onChange: function onChange(category) {
                                return setAttributes({ eventCategory: category });
                            }
                        }),
                        wp.element.createElement(TextControl, {
                            label: "Event Action",
                            type: "string",
                            value: eventAction,
                            placeholder: "Enter Action",
                            onChange: function onChange(action) {
                                return setAttributes({ eventAction: action });
                            }
                        }),
                        wp.element.createElement(TextControl, {
                            label: "Event Label",
                            type: "string",
                            value: eventLabel,
                            placeholder: "Enter Label",
                            onChange: function onChange(label) {
                                return setAttributes({ eventLabel: label });
                            }
                        })
                    )
                ),
                wp.element.createElement(
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
                                value: imgID,
                                onSelect: function onSelect(item) {
                                    return setAttributes({ imgSource: item.url });
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
                    )
                ),
                wp.element.createElement(
                    "div",
                    { className: "nab-banner-main", style: { textAlign: addAlign } },
                    wp.element.createElement(
                        "div",
                        { className: "nab-banner-inner" },
                        wp.element.createElement(
                            "p",
                            { className: "banner-text" },
                            "Advertisement"
                        ),
                        wp.element.createElement("img", { src: imgSource,
                            className: "banner-img",
                            alt: __('image'),
                            style: style

                        })
                    )
                ),
                wp.element.createElement(ServerSideRender, {
                    block: "nab/advertisement"
                })
            );
        },
        save: function save() {
            return null;
        }
    });
})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);

/***/ }),
/* 31 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__icons__ = __webpack_require__(0);
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
        RangeControl = wpComponents.RangeControl,
        RadioControl = wpComponents.RadioControl,
        ServerSideRender = wpComponents.ServerSideRender,
        Button = wpComponents.Button,
        Placeholder = wpComponents.Placeholder,
        CheckboxControl = wpComponents.CheckboxControl,
        SelectControl = wpComponents.SelectControl,
        PanelRow = wpComponents.PanelRow;


    var relatedContentBlockIcon = wp.element.createElement(
        "svg",
        { width: "150px", height: "150px", viewBox: "181 181 150 150", "enable-background": "new 181 181 150 150" },
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M251.539,186.845h-58.001c-3.689,0-6.692,3.003-6.692,6.692v49.078c0,3.689,3.003,6.692,6.692,6.692h58.001 c3.689,0,6.692-3.003,6.692-6.692v-49.078C258.23,189.848,255.228,186.845,251.539,186.845z M193.537,191.306h58.001 c1.231,0,2.23,1.002,2.23,2.231v11.154h-62.463v-11.154C191.306,192.308,192.306,191.306,193.537,191.306z M251.539,244.846h-58.001 c-1.231,0-2.231-1.001-2.231-2.23v-33.462h62.463v33.462C253.769,243.844,252.77,244.846,251.539,244.846z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M195.768,195.768h4.461v4.461h-4.461V195.768z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M213.615,195.768h4.461v4.461h-4.461V195.768z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M204.691,195.768h4.461v4.461h-4.461V195.768z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M227,213.615h-31.231v17.846h22.308v8.923h31.231v-17.847H227V213.615z M200.229,227v-8.923h22.308v4.461 h-4.461V227H200.229z M244.846,235.923h-22.308V227h22.308V235.923z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M251.539,262.692h-58.001c-3.689,0-6.692,3.003-6.692,6.692v49.078c0,3.689,3.003,6.692,6.692,6.692h58.001 c3.689,0,6.692-3.003,6.692-6.692v-49.078C258.23,265.695,255.228,262.692,251.539,262.692z M193.537,267.154h58.001 c1.231,0,2.23,1.001,2.23,2.23v11.154h-62.463v-11.154C191.306,268.155,192.306,267.154,193.537,267.154z M251.539,320.693h-58.001 c-1.231,0-2.231-1.001-2.231-2.23v-33.462h62.463v33.462C253.769,319.692,252.77,320.693,251.539,320.693z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M195.768,271.615h4.461v4.462h-4.461V271.615z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M204.691,271.615h4.461v4.462h-4.461V271.615z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M213.615,271.615h4.461v4.462h-4.461V271.615z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M227,289.462h-31.231v17.847h22.308v8.924h31.231v-17.847H227V289.462z M200.229,293.924h22.308v8.923 h-22.308V293.924z M244.846,302.847v8.924h-22.308v-4.462H227v-4.462H244.846z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M314.001,215.845h-29v-11.154l-23.797,17.846l23.797,17.847V229.23h26.77v10.095 c-2.098-0.745-4.344-1.171-6.692-1.171c-11.071,0-20.077,9.008-20.077,20.077v9.24c-1.774,0.964-3.423,2.184-4.891,3.652 l-11.219,11.219c-3.999,3.995-6.199,9.307-6.199,14.962c0,11.667,9.492,21.159,21.159,21.159c5.65,0,10.965-2.202,14.962-6.197 l11.219-11.219c3.418-3.415,5.528-7.877,6.052-12.657c5.457-3.597,9.071-9.767,9.071-16.774v-8.923v-4.462V227 C325.155,220.849,320.151,215.845,314.001,215.845z M306.881,297.891l-11.219,11.218c-3.157,3.155-7.352,4.893-11.811,4.893 c-9.207,0-16.697-7.49-16.697-16.697c0-4.462,1.735-8.653,4.89-11.808l11.219-11.219c3.156-3.154,7.351-4.893,11.81-4.893 c5.702,0,10.9,2.888,13.965,7.599c-1.113,0.82-2.474,1.325-3.959,1.325c-1.615,0-3.173-0.585-4.529-1.759l-3.66-2.703h-1.816 c-3.268,0-6.34,1.271-8.65,3.583l-11.221,11.221c-2.314,2.311-3.586,5.385-3.586,8.653c0,6.748,5.49,12.236,12.236,12.236 c3.269,0,6.34-1.271,8.651-3.583l11.221-11.221c0.899-0.899,1.648-1.95,2.23-3.085c1.776-0.079,3.498-0.364,5.124-0.875 C310.3,293.441,308.877,295.894,306.881,297.891L306.881,297.891z M311.771,271.615c0,0.467-0.05,0.92-0.141,1.359 c-3.288-4.163-7.986-6.944-13.244-7.771v-6.974c0-3.689,3.002-6.692,6.692-6.692c3.689,0,6.692,3.003,6.692,6.692V271.615z M287.996,282.165c2.88,4.672,7.547,7.896,12.881,9.035c-0.109,0.122-0.189,0.266-0.306,0.381l-11.221,11.222 c-1.471,1.468-3.422,2.275-5.499,2.275c-4.288,0-7.774-3.487-7.774-7.774c0-2.046,0.83-4.052,2.277-5.497L287.996,282.165z M320.693,271.615c0,8.611-7.007,15.616-15.615,15.616c-5.711,0-10.862-3.104-13.604-8.004c1.102-0.578,2.317-0.919,3.598-0.919 h0.351l2.333,1.718c2.03,1.769,4.631,2.743,7.322,2.743c6.15,0,11.154-5.003,11.154-11.154V258.23 c0-6.15-5.004-11.154-11.154-11.154s-11.154,5.004-11.154,11.154v6.749c-1.523,0.08-3.017,0.316-4.462,0.714v-7.463 c0-8.61,7.007-15.615,15.616-15.615c8.608,0,15.615,7.005,15.615,15.615v4.462V271.615z M316.232,241.549V229.23 c0-2.46-2.002-4.461-4.462-4.461h-31.231v6.692l-11.897-8.923l11.897-8.923v6.692h33.462c3.689,0,6.692,3.003,6.692,6.692v18.641 C319.42,244.063,317.918,242.68,316.232,241.549z" })
    );

    var NABRelatedContent = function (_Component) {
        _inherits(NABRelatedContent, _Component);

        function NABRelatedContent() {
            _classCallCheck(this, NABRelatedContent);

            var _this = _possibleConstructorReturn(this, (NABRelatedContent.__proto__ || Object.getPrototypeOf(NABRelatedContent)).apply(this, arguments));

            _this.state = {
                pageParentList: [{ label: __('Select Parent Page'), value: '' }],
                bxSliderObj: {},
                bxinit: false,
                isDisable: false,
                displayFieldsList: [{ label: __('Date'), value: 'date_group' }, { label: __('Halls'), value: 'page_hall' }, { label: __('Is Open To'), value: 'is_open_to' }, { label: __('Locations'), value: 'page_location' }, { label: __('Price'), value: 'price' }, { label: __('Registration Access'), value: 'reg_access' }]
            };
            _this.initSlider = _this.initSlider.bind(_this);
            return _this;
        }

        _createClass(NABRelatedContent, [{
            key: "componentDidMount",
            value: function componentDidMount() {
                var _props$attributes = this.props.attributes,
                    selection = _props$attributes.selection,
                    sliderActive = _props$attributes.sliderActive;

                if (sliderActive && selection) {
                    this.setState({ bxinit: true });
                }
            }
        }, {
            key: "componentWillMount",
            value: function componentWillMount() {
                var _this2 = this;

                var pageList = [{ label: __('Select Parent Page'), value: '' }];

                // Fetch all parent pages
                wp.apiFetch({ path: '/nab_api/request/page-parents' }).then(function (parents) {
                    if (0 < parents.length) {
                        parents.map(function (parent) {
                            pageList.push({ label: __(parent.title), value: parent.id });
                        });
                        _this2.setState({ pageParentList: pageList });
                    }
                });
            }
        }, {
            key: "componentDidUpdate",
            value: function componentDidUpdate() {
                var _this3 = this;

                var _props = this.props,
                    clientId = _props.clientId,
                    _props$attributes2 = _props.attributes,
                    selection = _props$attributes2.selection,
                    minSlides = _props$attributes2.minSlides,
                    autoplay = _props$attributes2.autoplay,
                    infiniteLoop = _props$attributes2.infiniteLoop,
                    pager = _props$attributes2.pager,
                    controls = _props$attributes2.controls,
                    sliderSpeed = _props$attributes2.sliderSpeed,
                    slideWidth = _props$attributes2.slideWidth,
                    sliderActive = _props$attributes2.sliderActive,
                    slideMargin = _props$attributes2.slideMargin;

                if (sliderActive && selection) {
                    if (this.state.bxinit) {
                        setTimeout(function () {
                            return _this3.initSlider();
                        }, 500);
                        this.setState({ bxinit: false });
                    } else {
                        if (0 < $("#block-" + clientId + " .nab-dynamic-slider").length && this.state.bxSliderObj && undefined !== this.state.bxSliderObj.reloadSlider) {
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
                                mode: 'horizontal'
                            });
                        }
                    }
                }
            }
        }, {
            key: "initSlider",
            value: function initSlider() {
                var clientId = this.props.clientId;

                if (0 < $("#block-" + clientId + " .nab-dynamic-slider").length) {
                    var _props$attributes3 = this.props.attributes,
                        minSlides = _props$attributes3.minSlides,
                        autoplay = _props$attributes3.autoplay,
                        infiniteLoop = _props$attributes3.infiniteLoop,
                        pager = _props$attributes3.pager,
                        controls = _props$attributes3.controls,
                        sliderSpeed = _props$attributes3.sliderSpeed,
                        slideWidth = _props$attributes3.slideWidth,
                        slideMargin = _props$attributes3.slideMargin;

                    var sliderObj = $("#block-" + clientId + " .nab-dynamic-slider").bxSlider({ minSlides: minSlides, maxSlides: minSlides, slideMargin: slideMargin, moveSlides: 1, slideWidth: slideWidth, auto: autoplay, infiniteLoop: infiniteLoop, pager: pager, controls: controls, speed: sliderSpeed, mode: 'horizontal' });
                    this.setState({ bxSliderObj: sliderObj, bxinit: false, isDisable: false });
                } else {
                    this.setState({ bxinit: true });
                }
            }
        }, {
            key: "render",
            value: function render() {
                var _this4 = this;

                var _props2 = this.props,
                    _props2$attributes = _props2.attributes,
                    parentPageId = _props2$attributes.parentPageId,
                    selection = _props2$attributes.selection,
                    itemToFetch = _props2$attributes.itemToFetch,
                    depthLevel = _props2$attributes.depthLevel,
                    featuredPage = _props2$attributes.featuredPage,
                    minSlides = _props2$attributes.minSlides,
                    autoplay = _props2$attributes.autoplay,
                    infiniteLoop = _props2$attributes.infiniteLoop,
                    pager = _props2$attributes.pager,
                    controls = _props2$attributes.controls,
                    sliderSpeed = _props2$attributes.sliderSpeed,
                    sliderActive = _props2$attributes.sliderActive,
                    slideWidth = _props2$attributes.slideWidth,
                    slideMargin = _props2$attributes.slideMargin,
                    arrowIcons = _props2$attributes.arrowIcons,
                    displayField = _props2$attributes.displayField,
                    listingLayout = _props2$attributes.listingLayout,
                    sliderLayout = _props2$attributes.sliderLayout,
                    setAttributes = _props2.setAttributes;


                var names = [{ name: __WEBPACK_IMPORTED_MODULE_0__icons__["w" /* sliderArrow1 */], classnames: 'slider-arrow-1' }, { name: __WEBPACK_IMPORTED_MODULE_0__icons__["x" /* sliderArrow2 */], classnames: 'slider-arrow-2' }, { name: __WEBPACK_IMPORTED_MODULE_0__icons__["y" /* sliderArrow3 */], classnames: 'slider-arrow-3' }, { name: __WEBPACK_IMPORTED_MODULE_0__icons__["z" /* sliderArrow4 */], classnames: 'slider-arrow-4' }, { name: __WEBPACK_IMPORTED_MODULE_0__icons__["A" /* sliderArrow5 */], classnames: 'slider-arrow-5' }, { name: __WEBPACK_IMPORTED_MODULE_0__icons__["B" /* sliderArrow6 */], classnames: 'slider-arrow-6' }, { name: __WEBPACK_IMPORTED_MODULE_0__icons__["B" /* sliderArrow6 */], classnames: 'slider-arrow-6' }];

                var commonControls = wp.element.createElement(
                    Fragment,
                    null,
                    wp.element.createElement(SelectControl, {
                        label: __('Choose option to get related content'),
                        value: parentPageId,
                        options: this.state.pageParentList,
                        onChange: function onChange(value) {
                            setAttributes({ parentPageId: value });_this4.setState({ bxinit: true });
                        }
                    }),
                    wp.element.createElement(
                        "div",
                        { className: "inspector-field inspector-field-radiocontrol " },
                        wp.element.createElement(RadioControl, {
                            selected: depthLevel,
                            options: [{ label: 'Grand Children', value: 'grandchildren' }, { label: 'Direct Descendants', value: 'descendants' }],
                            onChange: function onChange(option) {
                                setAttributes({ depthLevel: option });_this4.setState({ bxinit: true });
                            }
                        })
                    )
                );

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
                            setAttributes({ itemToFetch: parseInt(item) });_this4.setState({ bxinit: true, isDisable: true });
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

                if (!selection) {
                    return wp.element.createElement(
                        Placeholder,
                        {
                            label: __('Related Content')
                        },
                        commonControls,
                        wp.element.createElement(
                            Button,
                            { className: "button button-large button-primary", onClick: function onClick() {
                                    setAttributes({ selection: true });_this4.setState({ bxinit: true });
                                } },
                            __('Apply')
                        )
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
                            { title: __('Data Settings') },
                            input,
                            commonControls,
                            'side-img-info' !== listingLayout && wp.element.createElement(CheckboxControl, {
                                className: "related-featured",
                                label: "Featured Page",
                                checked: featuredPage,
                                onChange: function onChange() {
                                    setAttributes({ featuredPage: !featuredPage });_this4.setState({ bxinit: true });
                                }
                            })
                        ),
                        wp.element.createElement(
                            PanelBody,
                            { title: __('Slider Settings '), initialOpen: false, className: "range-setting" },
                            sliderActive && wp.element.createElement(
                                "div",
                                null,
                                wp.element.createElement(
                                    "label",
                                    null,
                                    __('Select Slider Layout')
                                ),
                                wp.element.createElement(
                                    PanelRow,
                                    null,
                                    wp.element.createElement(
                                        "ul",
                                        { className: "ss-off-options related-off" },
                                        wp.element.createElement(
                                            "li",
                                            { className: 'img-only' === sliderLayout ? 'active img-only' : 'img-only', onClick: function onClick() {
                                                    setAttributes({ sliderLayout: 'img-only' });_this4.setState({ bxinit: true });
                                                } },
                                            __WEBPACK_IMPORTED_MODULE_0__icons__["o" /* productCategories */]
                                        ),
                                        wp.element.createElement(
                                            "li",
                                            { className: 'related-content-slider-info' === sliderLayout ? 'active related-content-slider-info' : 'related-content-slider-info', onClick: function onClick() {
                                                    setAttributes({ sliderLayout: 'related-content-slider-info' });_this4.setState({ bxinit: true });
                                                } },
                                            __WEBPACK_IMPORTED_MODULE_0__icons__["j" /* featuredHappening */]
                                        ),
                                        wp.element.createElement(
                                            "li",
                                            { className: 'related-content-slider-events' === sliderLayout ? 'active related-content-slider-events' : 'related-content-slider-events', onClick: function onClick() {
                                                    setAttributes({ sliderLayout: 'related-content-slider-events' });_this4.setState({ bxinit: true });
                                                } },
                                            __WEBPACK_IMPORTED_MODULE_0__icons__["r" /* realtedContentCoLocatedEvents */]
                                        )
                                    )
                                )
                            ),
                            wp.element.createElement(ToggleControl, {
                                label: __('Slider On/Off'),
                                checked: sliderActive,
                                onChange: function onChange() {
                                    setAttributes({ sliderActive: !sliderActive });_this4.setState({ bxinit: !sliderActive });
                                }
                            }),
                            !sliderActive && wp.element.createElement(
                                Fragment,
                                null,
                                wp.element.createElement(
                                    "div",
                                    null,
                                    wp.element.createElement(
                                        "label",
                                        null,
                                        __('Select Listing Layout')
                                    ),
                                    wp.element.createElement(
                                        PanelRow,
                                        null,
                                        wp.element.createElement(
                                            "ul",
                                            { className: "ss-off-options related-off" },
                                            wp.element.createElement(
                                                "li",
                                                { className: 'destination' === listingLayout ? 'active destination' : 'destination', onClick: function onClick() {
                                                        return setAttributes({ listingLayout: 'destination' });
                                                    } },
                                                __WEBPACK_IMPORTED_MODULE_0__icons__["h" /* destinations */]
                                            ),
                                            wp.element.createElement(
                                                "li",
                                                { className: 'key-contacts' === listingLayout ? 'active key-contacts' : 'key-contacts', onClick: function onClick() {
                                                        return setAttributes({ listingLayout: 'key-contacts' });
                                                    } },
                                                __WEBPACK_IMPORTED_MODULE_0__icons__["k" /* keyContacts */]
                                            ),
                                            wp.element.createElement(
                                                "li",
                                                { className: 'featured-happenings' === listingLayout ? 'active featured-happenings' : 'featured-happenings', onClick: function onClick() {
                                                        return setAttributes({ listingLayout: 'featured-happenings' });
                                                    } },
                                                __WEBPACK_IMPORTED_MODULE_0__icons__["j" /* featuredHappening */]
                                            ),
                                            wp.element.createElement(
                                                "li",
                                                { className: 'product-categories' === listingLayout ? 'active product-categories' : 'product-categories', onClick: function onClick() {
                                                        return setAttributes({ listingLayout: 'product-categories' });
                                                    } },
                                                __WEBPACK_IMPORTED_MODULE_0__icons__["o" /* productCategories */]
                                            ),
                                            wp.element.createElement(
                                                "li",
                                                { className: 'exhibitor-resources' === listingLayout ? 'active exhibitor-resources' : 'exhibitor-resources', onClick: function onClick() {
                                                        return setAttributes({ listingLayout: 'exhibitor-resources' });
                                                    } },
                                                __WEBPACK_IMPORTED_MODULE_0__icons__["i" /* exhibitorResources */]
                                            ),
                                            wp.element.createElement(
                                                "li",
                                                { className: 'browse-happenings' === listingLayout ? 'active browse-happenings' : 'browse-happenings', onClick: function onClick() {
                                                        return setAttributes({ listingLayout: 'browse-happenings' });
                                                    } },
                                                __WEBPACK_IMPORTED_MODULE_0__icons__["b" /* browseHappening */]
                                            ),
                                            wp.element.createElement(
                                                "li",
                                                { className: 'title-list' === listingLayout ? 'active title-list' : 'title-list', onClick: function onClick() {
                                                        return setAttributes({ listingLayout: 'title-list' });
                                                    } },
                                                __WEBPACK_IMPORTED_MODULE_0__icons__["v" /* relatedContentTitleList */]
                                            ),
                                            wp.element.createElement(
                                                "li",
                                                { className: 'side-img-info' === listingLayout ? 'active side-img-info' : 'side-img-info', onClick: function onClick() {
                                                        return setAttributes({ listingLayout: 'side-img-info' });
                                                    } },
                                                __WEBPACK_IMPORTED_MODULE_0__icons__["u" /* relatedContSideImgInfo */]
                                            ),
                                            wp.element.createElement(
                                                "li",
                                                { className: 'side-info' === listingLayout ? 'active side-info' : 'side-info', onClick: function onClick() {
                                                        return setAttributes({ listingLayout: 'side-info' });
                                                    } },
                                                __WEBPACK_IMPORTED_MODULE_0__icons__["s" /* realtedContentInfoOnly */]
                                            ),
                                            wp.element.createElement(
                                                "li",
                                                { className: 'plan-your-show' === listingLayout ? 'active plan-your-show' : 'plan-your-show', onClick: function onClick() {
                                                        return setAttributes({ listingLayout: 'plan-your-show' });
                                                    } },
                                                __WEBPACK_IMPORTED_MODULE_0__icons__["t" /* realtedContentPlanShow */]
                                            )
                                        )
                                    )
                                ),
                                wp.element.createElement(
                                    "label",
                                    null,
                                    __('Select Fields to Display')
                                ),
                                wp.element.createElement(
                                    "div",
                                    { className: "fix-height-select" },
                                    this.state.displayFieldsList.map(function (field, index) {
                                        return wp.element.createElement(
                                            Fragment,
                                            { key: index },
                                            wp.element.createElement(CheckboxControl, { checked: -1 < displayField.indexOf(field.value), label: field.label, name: "displayfields[]", value: field.value, onChange: function onChange(isChecked) {

                                                    var index = void 0,
                                                        tempDisplayField = [].concat(_toConsumableArray(displayField));

                                                    if (isChecked) {
                                                        tempDisplayField.push(field.value);
                                                    } else {
                                                        index = tempDisplayField.indexOf(field.value);
                                                        tempDisplayField.splice(index, 1);
                                                    }

                                                    _this4.props.setAttributes({ displayField: tempDisplayField });
                                                }
                                            })
                                        );
                                    })
                                )
                            ),
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
                                )
                            )
                        ),
                        sliderActive && controls && wp.element.createElement(
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
                                                    _this4.setState({ bxinit: true });
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
                        block: "nab/related-content",
                        attributes: { parentPageId: parentPageId, itemToFetch: itemToFetch, depthLevel: depthLevel, featuredPage: featuredPage, sliderActive: sliderActive, arrowIcons: arrowIcons, displayField: displayField, listingLayout: listingLayout, sliderLayout: sliderLayout }
                    })
                );
            }
        }]);

        return NABRelatedContent;
    }(Component);

    var allAttr = {
        itemToFetch: {
            type: 'number',
            default: 10
        },
        parentPageId: {
            type: 'string'
        },
        selection: {
            type: 'boolean',
            default: false
        },
        depthLevel: {
            type: 'string',
            default: 'grandchildren'

        },
        featuredPage: {
            type: 'boolean',
            default: false
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
        slideWidth: {
            type: 'number',
            default: 400
        },
        slideMargin: {
            type: 'number',
            default: 30
        },
        arrowIcons: {
            type: 'string',
            default: 'slider-arrow-1'
        },
        displayField: {
            type: 'array',
            default: []
        },
        listingLayout: {
            type: 'string',
            default: 'destination'
        },
        sliderLayout: {
            type: 'string',
            default: 'img-only'
        }
    };

    registerBlockType('nab/related-content', {
        title: __('Related Content'),
        icon: { src: relatedContentBlockIcon },
        keywords: [__('related'), __('content')],
        attributes: allAttr,
        category: 'nabshow',
        edit: NABRelatedContent,
        save: function save() {
            return null;
        }
    });
})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);

/***/ }),
/* 32 */
/***/ (function(module, exports) {

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

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
        RangeControl = wpComponents.RangeControl,
        SelectControl = wpComponents.SelectControl,
        ServerSideRender = wpComponents.ServerSideRender,
        Placeholder = wpComponents.Placeholder;


    var contributorsBlock = wp.element.createElement(
        "svg",
        { width: "150px", height: "150px", viewBox: "0 0 150 150", "enable-background": "new 0 0 150 150" },
        wp.element.createElement("path", { fill: "#146DB6", d: "M41.882,109.118c3.912,0,7.097-3.185,7.097-7.097s-3.185-7.097-7.097-7.097s-7.097,3.185-7.097,7.097 c0,0.575,0.088,1.128,0.217,1.665l-8.042,5.576c-1.684-1.545-3.907-2.51-6.368-2.51c-5.219,0-9.462,4.243-9.462,9.462 s4.244,9.462,9.462,9.462c2.46,0,4.684-0.965,6.368-2.51l8.042,5.576c-0.129,0.536-0.217,1.09-0.217,1.665 c0,3.912,3.185,7.097,7.097,7.097s7.097-3.185,7.097-7.097s-3.185-7.097-7.097-7.097c-1.616,0-3.09,0.563-4.284,1.477l-8.072-5.596 c0.318-0.941,0.528-1.933,0.528-2.978s-0.21-2.036-0.528-2.978l8.072-5.596C38.792,108.556,40.266,109.118,41.882,109.118z M41.882,99.656c1.305,0,2.366,1.063,2.366,2.365s-1.061,2.365-2.366,2.365s-2.366-1.063-2.366-2.365S40.577,99.656,41.882,99.656z M20.592,120.946c-2.609,0-4.731-2.122-4.731-4.731s2.122-4.731,4.731-4.731s4.731,2.122,4.731,4.731S23.201,120.946,20.592,120.946 z M41.882,128.043c1.305,0,2.366,1.063,2.366,2.365s-1.061,2.366-2.366,2.366s-2.366-1.063-2.366-2.366 S40.577,128.043,41.882,128.043z" }),
        wp.element.createElement("path", { fill: "#146DB6", d: "M96.29,76c5.219,0,9.463-4.244,9.463-9.462h-4.731c0,2.609-2.122,4.731-4.731,4.731 s-4.731-2.122-4.731-4.731h-4.73C86.828,71.756,91.071,76,96.29,76z" }),
        wp.element.createElement("path", { fill: "#146DB6", d: "M148.333,112.253c0-7.14-4.551-13.453-11.322-15.71l-24.161-8.056v-6.625 c4.047-3.348,7.045-7.903,8.489-13.101c5.86-0.698,10.435-5.642,10.435-11.686V33.654c0-7.776-5.301-14.568-12.746-16.521 l-0.25-0.376c-5.878-8.822-15.725-14.09-26.329-14.09C75,2.667,60.807,16.86,60.807,34.309v22.766 c0,6.044,4.575,10.988,10.435,11.686c1.445,5.198,4.442,9.753,8.49,13.101v6.625l-19.545,6.516 c-6.079-7.27-15.205-11.906-25.401-11.906c-18.263,0-33.118,14.855-33.118,33.118s14.855,33.118,33.118,33.118 c8.999,0,17.16-3.619,23.132-9.462h90.416V112.253z M121.342,96.306l-9.141,18.281L99.796,102.18l11.191-9.327L121.342,96.306z M98.656,47.613v4.731h-4.731v-4.731H75v-2.485c4.272-0.395,8.322-1.846,11.828-4.245v4.365h2.365 c5.141,0,10.045-1.528,14.193-4.368v4.368h3.3c3.993,0,7.785-1.311,10.894-3.617v5.982H98.656z M75,52.344h14.193v2.366 c0,1.303-1.061,2.365-2.365,2.365h-9.463c-1.305,0-2.365-1.063-2.365-2.365V52.344z M103.387,52.344h14.193v2.366 c0,1.303-1.06,2.365-2.365,2.365h-9.462c-1.306,0-2.366-1.063-2.366-2.365V52.344z M122.212,63.768c0.05-0.65,0.1-1.3,0.1-1.961 V50.414c2.747,0.98,4.731,3.582,4.731,6.661C127.043,60.19,125.011,62.816,122.212,63.768z M92.448,7.398 c9.021,0,17.392,4.48,22.393,11.984l1.318,1.971l0.958,0.191c5.75,1.152,9.926,6.246,9.926,12.11v14.018 c-1.382-1.045-2.974-1.829-4.731-2.186V33.419h-4.731v1.583c-2.269,3.07-5.688,5.041-9.462,5.438V30.086l-4.444,4.433 c-3.303,3.305-7.539,5.342-12.115,5.864V30.086l-4.444,4.433c-3.302,3.305-7.541,5.327-12.114,5.85v-6.95h-4.731v12.067 c-1.758,0.359-3.35,1.14-4.731,2.186V34.309C65.538,19.472,77.611,7.398,92.448,7.398z M65.538,57.075 c0-3.079,1.984-5.682,4.731-6.661v11.393c0,0.662,0.049,1.311,0.099,1.961C67.569,62.816,65.538,60.19,65.538,57.075z M75,61.807 v-0.436c0.743,0.265,1.533,0.436,2.365,0.436h9.463c3.079,0,5.682-1.984,6.661-4.731h5.604c0.979,2.747,3.581,4.731,6.661,4.731 h9.462c0.833,0,1.623-0.17,2.365-0.436v0.436c0,11.737-9.55,21.29-21.29,21.29C84.553,83.097,75,73.544,75,61.807z M96.29,87.828 c4.26,0,8.275-1.05,11.828-2.872v4.131L96.29,98.944l-11.828-9.857v-4.131C88.016,86.778,92.03,87.828,96.29,87.828z M81.596,92.854 l11.191,9.327L80.382,114.59l-9.14-18.281L81.596,92.854z M66.705,97.818l12.376,24.755l14.844-14.841v27.407H61.926 c3.756-5.37,5.978-11.89,5.978-18.925c0-6.295-1.795-12.162-4.857-17.18L66.705,97.818z M34.785,144.602 c-15.654,0-28.387-12.733-28.387-28.387s12.734-28.387,28.387-28.387s28.387,12.733,28.387,28.387S50.439,144.602,34.785,144.602z M143.602,135.14h-14.193v-18.925h-4.731v18.925H98.656v-27.407l14.841,14.841l12.377-24.756l9.638,3.212 c4.84,1.614,8.09,6.123,8.09,11.224V135.14z" })
    );

    var NABContributors = function (_Component) {
        _inherits(NABContributors, _Component);

        function NABContributors() {
            _classCallCheck(this, NABContributors);

            var _this = _possibleConstructorReturn(this, (NABContributors.__proto__ || Object.getPrototypeOf(NABContributors)).apply(this, arguments));

            _this.state = {
                postTypeList: [{ label: 'Select Post Type', value: '' }]
            };
            return _this;
        }

        _createClass(NABContributors, [{
            key: "componentWillMount",
            value: function componentWillMount() {
                var _this2 = this;

                var postTypeKey = void 0,
                    postOptions = [{ label: 'Select Post Type', value: '' }],
                    excludePostTypes = ['attachment', 'wp_block'];

                // Fetch all post types
                wp.apiFetch({ path: '/wp/v2/types' }).then(function (postTypes) {
                    postTypeKey = Object.keys(postTypes).filter(function (postType) {
                        return !excludePostTypes.includes(postType);
                    });
                    postTypeKey.forEach(function (key) {
                        postOptions.push({ label: __(postTypes[key].name), value: __(postTypes[key].slug) });
                    });
                    _this2.setState({ postTypeList: postOptions });
                });
            }
        }, {
            key: "render",
            value: function render() {
                var _props = this.props,
                    _props$attributes = _props.attributes,
                    postType = _props$attributes.postType,
                    itemToFetch = _props$attributes.itemToFetch,
                    setAttributes = _props.setAttributes;

                if (!postType) {
                    return wp.element.createElement(
                        Placeholder,
                        {
                            instructions: __('Choose post type to list Contributors/Authors')
                        },
                        wp.element.createElement(
                            "div",
                            { className: "inspector-field inspector-field-radiocontrol " },
                            wp.element.createElement(SelectControl, {
                                value: postType,
                                options: this.state.postTypeList,
                                onChange: function onChange(value) {
                                    setAttributes({ postType: value });
                                }
                            })
                        )
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
                            { title: __('Data Settings'), className: "range-setting" },
                            wp.element.createElement(
                                "div",
                                { className: "inspector-field inspector-field-Numberofitems" },
                                wp.element.createElement(
                                    "label",
                                    { className: "inspector-mb-0" },
                                    "Number of items"
                                ),
                                wp.element.createElement(RangeControl, {
                                    value: itemToFetch,
                                    min: 1,
                                    max: 20,
                                    onChange: function onChange(item) {
                                        setAttributes({ itemToFetch: parseInt(item) });
                                    }
                                })
                            ),
                            wp.element.createElement(SelectControl, {
                                label: __('Select Post Type'),
                                value: postType,
                                options: this.state.postTypeList,
                                onChange: function onChange(value) {
                                    setAttributes({ postType: value });
                                }
                            })
                        )
                    ),
                    wp.element.createElement(ServerSideRender, {
                        block: "nab/contributors-authors",
                        attributes: { postType: postType, itemToFetch: itemToFetch }
                    })
                );
            }
        }]);

        return NABContributors;
    }(Component);

    var allAttr = {
        postType: {
            type: 'string'
        },
        itemToFetch: {
            type: 'number',
            default: 10
        }
    };

    registerBlockType('nab/contributors-authors', {
        title: __('Contributors / Authors'),
        icon: { src: contributorsBlock },
        category: 'nabshow',
        keywords: [__('contributors'), __('authors')],
        attributes: allAttr,
        edit: NABContributors,
        save: function save() {
            return null;
        }
    });
})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);

/***/ }),
/* 33 */
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
      MediaUpload = wpEditor.MediaUpload;
  var Button = wpComponents.Button;


  var newThisYearBlockIcon = wp.element.createElement(
    "svg",
    { width: "150px", height: "150px", viewBox: "222.64 222.641 150 150", "enable-background": "new 222.64 222.641 150 150" },
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M362.627,291.161l-6.743-6.752l3.168-8.99c1.675-4.73-0.816-9.954-5.563-11.646l-5.337-1.892v-5.649 c0-5.033-4.096-9.121-9.12-9.121h-9.546l-4.122-8.609c-2.092-4.399-7.75-6.422-12.167-4.304l-5.111,2.438l-3.992-3.983 c-3.428-3.445-9.433-3.462-12.895-0.008l-6.751,6.743l-8.982-3.167c-4.617-1.666-10.014,0.928-11.655,5.554l-1.892,5.336h-5.649 c-5.033,0-9.129,4.096-9.129,9.121v9.546l-8.617,4.122c-4.521,2.169-6.448,7.628-4.287,12.167l2.448,5.094l-4.001,4.001 c-1.736,1.727-2.682,4.018-2.682,6.465c0,2.438,0.955,4.721,2.673,6.43l6.751,6.761l-3.185,9.008 c-0.816,2.291-0.677,4.756,0.364,6.96c1.05,2.204,2.898,3.87,5.198,4.669l5.337,1.892v5.649c0,5.024,4.096,9.111,9.129,9.111 h9.546l4.113,8.626c2.1,4.383,7.758,6.396,12.158,4.296l5.103-2.438l4,3.992c1.719,1.727,4.018,2.689,6.457,2.689 s4.738-0.954,6.431-2.681l6.76-6.743l9.008,3.176c4.644,1.641,10.006-0.945,11.638-5.571l1.892-5.346h5.649 c5.024,0,9.12-4.087,9.12-9.112v-9.546l8.617-4.122c4.521-2.16,6.457-7.628,4.287-12.175l-2.43-5.094l4.001-4.01 C366.185,300.516,366.185,294.736,362.627,291.161z M351.97,316.796l-13.581,6.491v15.048h-11.915l-3.975,11.255l-14.197-5.007 l-10.657,10.63l-8.435-8.426l-10.717,5.207l-6.518-13.651h-15.056v-11.906l-11.238-3.966l5.024-14.197l-10.648-10.657l8.435-8.426 l-5.146-10.761l13.582-6.491v-15.056h11.923l3.966-11.229l14.206,5.007l10.622-10.648l8.435,8.427l10.727-5.198l6.517,13.642 h15.057v11.924l11.229,3.966l-4.999,14.198l10.648,10.648l-8.436,8.435L351.97,316.796z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M272.661,291.854c0,4.183,0.122,7.967,0.538,11.654h-0.13c-1.241-3.141-2.898-6.638-4.564-9.58 l-5.806-10.249h-7.385v27.97h5.806v-8.427c0-4.564-0.078-8.504-0.243-12.201l0.122-0.035c1.362,3.28,3.193,6.89,4.86,9.884 l5.971,10.778h6.647V283.68h-5.806L272.661,291.854L272.661,291.854z" }),
        wp.element.createElement("polygon", { fill: "#0F6CB6", points: "290.304,299.821 300.596,299.821 300.596,294.675 290.304,294.675 290.304,288.861 301.221,288.861 301.221,283.68 283.96,283.68 283.96,311.641 301.802,311.641 301.802,306.46 290.304,306.46 \t\t" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M331.272,295.126c-0.581,3.315-1.206,6.595-1.622,9.71h-0.07c-0.425-3.106-0.876-6.092-1.51-9.381 l-2.239-11.785h-6.717l-2.352,11.455c-0.712,3.445-1.371,6.803-1.831,9.833h-0.087c-0.46-2.829-1.041-6.422-1.657-9.746 l-2.118-11.542h-6.76l6.647,27.969h6.925l2.665-12.036c0.659-2.82,1.119-5.468,1.613-8.626h0.096 c0.33,3.194,0.781,5.806,1.319,8.626l2.36,12.036h6.848l7.22-27.969h-6.431L331.272,295.126z" })
      )
    )
  );

  var NabMediaSlider = function (_Component) {
    _inherits(NabMediaSlider, _Component);

    function NabMediaSlider() {
      _classCallCheck(this, NabMediaSlider);

      return _possibleConstructorReturn(this, (NabMediaSlider.__proto__ || Object.getPrototypeOf(NabMediaSlider)).apply(this, arguments));
    }

    _createClass(NabMediaSlider, [{
      key: "componentDidMount",
      value: function componentDidMount() {
        var products = this.props.attributes.products;

        if (0 === products.length) {
          this.initList();
        }
      }
    }, {
      key: "initList",
      value: function initList() {
        var products = this.props.attributes.products;
        var setAttributes = this.props.setAttributes;

        setAttributes({
          products: [].concat(_toConsumableArray(products), [{
            index: products.length,
            media: '',
            mediaAlt: '',
            title: '',
            description: '',
            readMore: 'Read More'
          }])
        });
      }
    }, {
      key: "render",
      value: function render() {
        var _props = this.props,
            attributes = _props.attributes,
            setAttributes = _props.setAttributes,
            clientId = _props.clientId,
            className = _props.className;
        var products = attributes.products;


        var getImageButton = function getImageButton(openEvent, index) {
          if (products[index].media) {
            return wp.element.createElement("img", { src: products[index].media, alt: products[index].alt, className: "img" });
          } else {
            return wp.element.createElement(
              Button,
              { onClick: openEvent, className: "button button-large" },
              wp.element.createElement("span", { className: "dashicons dashicons-upload" }),
              " Upload Logo"
            );
          }
        };

        var productsList = products.sort(function (a, b) {
          return a.index - b.index;
        }).map(function (product, index) {
          return wp.element.createElement(
            "div",
            { className: "box-item" },
            wp.element.createElement(
              "div",
              { className: "box-inner" },
              wp.element.createElement(
                "span",
                {
                  className: "remove",
                  onClick: function onClick() {
                    var qewQusote = products.filter(function (item) {
                      return item.index != product.index;
                    }).map(function (t) {
                      if (t.index > product.index) {
                        t.index -= 1;
                      }

                      return t;
                    });

                    setAttributes({
                      products: qewQusote
                    });
                  }
                },
                wp.element.createElement("span", { className: "dashicons dashicons-no-alt" })
              ),
              wp.element.createElement(
                "div",
                { className: "media-img" },
                wp.element.createElement(MediaUpload, {
                  onSelect: function onSelect(media) {
                    var newObject = Object.assign({}, product, {
                      media: media.url,
                      mediaAlt: media.alt
                    });
                    setAttributes({
                      products: [].concat(_toConsumableArray(products.filter(function (item) {
                        return item.index != product.index;
                      })), [newObject])
                    });
                  },
                  type: "image",
                  value: attributes.imageID,
                  render: function render(_ref) {
                    var open = _ref.open;
                    return wp.element.createElement("span", { onClick: open, className: "dashicons dashicons-edit" });
                  }
                }),
                wp.element.createElement(MediaUpload, {
                  onSelect: function onSelect(media) {
                    var newObject = Object.assign({}, product, {
                      media: media.url,
                      mediaAlt: media.alt
                    });
                    setAttributes({
                      products: [].concat(_toConsumableArray(products.filter(function (item) {
                        return item.index != product.index;
                      })), [newObject])
                    });
                  },
                  type: "image",
                  value: attributes.imageID,
                  render: function render(_ref2) {
                    var open = _ref2.open;
                    return getImageButton(open, index);
                  }
                })
              ),
              wp.element.createElement(RichText, {
                tagName: "h3",
                placeholder: __('Title'),
                value: product.title,
                className: "title",
                onChange: function onChange(title) {
                  var newObject = Object.assign({}, product, {
                    title: title
                  });
                  setAttributes({
                    products: [].concat(_toConsumableArray(products.filter(function (item) {
                      return item.index != product.index;
                    })), [newObject])
                  });
                }
              }),
              wp.element.createElement(RichText, {
                tagName: "p",
                className: "description",
                placeholder: __('Description'),
                value: product.description,
                onChange: function onChange(description) {
                  var newObject = Object.assign({}, product, {
                    description: description
                  });
                  setAttributes({
                    products: [].concat(_toConsumableArray(products.filter(function (item) {
                      return item.index != product.index;
                    })), [newObject])
                  });
                }
              }),
              wp.element.createElement(RichText, {
                tagName: "p",
                className: "readMore",
                placeholder: __('Read More'),
                value: product.readMore,
                onChange: function onChange(readMore) {
                  var newObject = Object.assign({}, product, {
                    readMore: readMore
                  });
                  setAttributes({
                    products: [].concat(_toConsumableArray(products.filter(function (item) {
                      return item.index != product.index;
                    })), [newObject])
                  });
                }
              })
            )
          );
        });

        return wp.element.createElement(
          "div",
          { className: "new-this-year new-this-year-block" },
          wp.element.createElement(
            "div",
            { className: "box-main" },
            productsList,
            wp.element.createElement(
              "div",
              { className: "box-item additem" },
              wp.element.createElement(
                "button",
                {
                  className: "components-button add",
                  onClick: function onClick(content) {
                    setAttributes({
                      products: [].concat(_toConsumableArray(products), [{
                        index: products.length,
                        media: '',
                        mediaAlt: '',
                        title: '',
                        description: '',
                        readMore: 'Read More'
                      }])
                    });
                  }
                },
                wp.element.createElement("span", { className: "dashicons dashicons-plus" }),
                " Add New Item"
              )
            )
          )
        );
      }
    }]);

    return NabMediaSlider;
  }(Component);

  registerBlockType('nab/new-this-year', {
    title: __('New This Year'),
    description: __('New This Year'),
    icon: { src: newThisYearBlockIcon },
    category: 'nabshow',
    keywords: [__('New This Year'), __('gutenberg'), __('nab')],
    attributes: {
      products: {
        type: 'array',
        default: []
      }
    },
    edit: NabMediaSlider,

    save: function save(props) {
      var attributes = props.attributes,
          className = props.className;
      var products = attributes.products;


      return wp.element.createElement(
        "div",
        { className: "new-this-year new-this-year-block" },
        wp.element.createElement(
          "div",
          { className: "box-main" },
          products.map(function (product, index) {
            return wp.element.createElement(
              Fragment,
              null,
              product.title && wp.element.createElement(
                "div",
                { className: "box-item" },
                wp.element.createElement(
                  "div",
                  { className: "box-inner" },
                  wp.element.createElement(
                    "div",
                    { className: "media-img" },
                    product.media ? wp.element.createElement("img", { src: product.media, alt: product.alt, className: "img" }) : wp.element.createElement(
                      "div",
                      { className: "no-image" },
                      "No Logo"
                    )
                  ),
                  product.title && wp.element.createElement(RichText.Content, {
                    tagName: "h3",
                    value: product.title,
                    className: "title"
                  }),
                  product.description && wp.element.createElement(RichText.Content, {
                    tagName: "p",
                    className: "description",
                    value: product.description
                  }),
                  product.readMore && wp.element.createElement(RichText.Content, {
                    tagName: "span",
                    className: "readMore",
                    value: product.readMore
                  })
                )
              )
            );
          })
        )
      );
    }
  });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);

/***/ }),
/* 34 */
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
      MediaUpload = wpEditor.MediaUpload;
  var Button = wpComponents.Button,
      TextControl = wpComponents.TextControl;


  var delegationBlockIcon = wp.element.createElement(
    "svg",
    { width: "150px", height: "150px", viewBox: "0 0 150 150", "enable-background": "new 0 0 150 150" },
    wp.element.createElement(
      "g",
      { id: "XMLID_1423_" },
      wp.element.createElement(
        "g",
        { id: "XMLID_2880_" },
        wp.element.createElement(
          "g",
          { id: "XMLID_924_" },
          wp.element.createElement("path", { id: "XMLID_1259_", fill: "#146DB6", d: "M131.791,118.023c1.472-2.111,2.338-4.676,2.338-7.44v-2.558 c0-7.193-5.852-13.046-13.045-13.046s-13.047,5.853-13.047,13.046v2.558c0,2.765,0.866,5.329,2.339,7.44 c-5.098,0.152-9.587,2.759-12.325,6.678c-2.739-3.919-7.229-6.525-12.326-6.678c1.473-2.111,2.339-4.676,2.339-7.44v-2.558 c0-7.193-5.853-13.046-13.046-13.046s-13.046,5.853-13.046,13.046v2.558c0,2.765,0.867,5.329,2.339,7.44 c-5.108,0.152-9.606,2.769-12.343,6.702c-2.737-3.934-7.235-6.55-12.344-6.702c1.472-2.111,2.338-4.676,2.338-7.44v-2.558 c0-7.193-5.853-13.046-13.046-13.046s-13.045,5.853-13.045,13.046v2.558c0,2.765,0.866,5.329,2.338,7.44 c-8.387,0.251-15.134,7.146-15.134,15.594V144.1c0,1.55,1.257,2.809,2.809,2.809h138.233c1.552,0,2.81-1.259,2.81-2.809v-10.482 C146.926,125.169,140.178,118.274,131.791,118.023z M113.655,108.025c0-4.097,3.333-7.429,7.429-7.429s7.428,3.331,7.428,7.429 v2.558c0,4.097-3.332,7.429-7.428,7.429s-7.429-3.332-7.429-7.429V108.025z M67.59,108.025c0-4.097,3.332-7.429,7.428-7.429 s7.428,3.331,7.428,7.429v2.558c0,4.097-3.332,7.429-7.428,7.429s-7.428-3.332-7.428-7.429V108.025L67.59,108.025z M21.488,108.025c0-4.097,3.332-7.429,7.428-7.429c4.096,0,7.428,3.331,7.428,7.429v2.558c0,4.097-3.332,7.429-7.428,7.429 c-4.095,0-7.428-3.332-7.428-7.429V108.025z M49.14,141.29H8.692v-7.674c0-5.507,4.479-9.987,9.987-9.987h20.474 c5.507,0,9.987,4.48,9.987,9.987L49.14,141.29L49.14,141.29z M54.793,133.617c0-5.507,4.48-9.988,9.987-9.988h20.474 c5.507,0,9.987,4.48,9.987,9.988v7.673H54.794L54.793,133.617L54.793,133.617z M141.308,141.29h-40.448v-7.674 c0-5.507,4.48-9.987,9.987-9.987h20.474c5.507,0,9.987,4.48,9.987,9.987V141.29L141.308,141.29z" }),
          wp.element.createElement("path", { id: "XMLID_1309_", fill: "#146DB6", d: "M55.601,78.59c-0.738,0-1.463,0.301-1.986,0.823c-0.522,0.521-0.823,1.244-0.823,1.985 c0,0.739,0.3,1.463,0.823,1.986c0.523,0.521,1.248,0.822,1.986,0.822c0.739,0,1.464-0.3,1.986-0.822 c0.522-0.526,0.823-1.247,0.823-1.986c0-0.738-0.301-1.464-0.823-1.985C57.064,78.891,56.339,78.59,55.601,78.59z" }),
          wp.element.createElement("path", { id: "XMLID_1315_", fill: "#146DB6", d: "M21.051,84.206h23.314c1.551,0,2.809-1.258,2.809-2.809s-1.258-2.81-2.809-2.81H23.86 V58.699c0-5.222,4.248-9.47,9.469-9.47h4.645v13.132c0,1.126,0.672,2.143,1.708,2.584c1.036,0.441,2.235,0.221,3.047-0.558 l10.063-9.668v8.457c0,1.551,1.258,2.809,2.809,2.809c1.551,0,2.809-1.259,2.809-2.809v-8.457l10.062,9.668 c0.534,0.512,1.235,0.783,1.947,0.783c0.371,0,0.745-0.074,1.101-0.225c1.036-0.441,1.708-1.458,1.708-2.584V49.229h4.645 c5.222,0,9.47,4.248,9.47,9.47v19.889H66.836c-1.551,0-2.809,1.259-2.809,2.81s1.258,2.809,2.809,2.809H90.15 c1.551,0,2.809-1.258,2.809-2.809V58.699c0-8.318-6.769-15.087-15.087-15.087h-9.221c3.07-3.231,4.96-7.594,4.96-12.392v-6.457 v-2.988v-0.672c0-9.931-8.08-18.011-18.011-18.011S37.59,11.172,37.59,21.103v0.672v2.987v6.457c0,4.798,1.89,9.161,4.96,12.392 H33.33c-8.319,0-15.087,6.769-15.087,15.087v22.699C18.243,82.949,19.5,84.206,21.051,84.206z M43.592,49.229h6.803l-6.803,6.538 V49.229L43.592,49.229z M67.609,55.767l-6.804-6.537h6.804V55.767L67.609,55.767z M43.208,21.103 c0-6.833,5.559-12.393,12.393-12.393c6.398,0,11.68,4.875,12.326,11.105l-5.871-3.449c-1.183-0.695-2.695-0.434-3.576,0.617 c-2.647,3.158-6.528,4.97-10.648,4.97h-4.624v-0.179V21.103L43.208,21.103z M43.208,31.219v-3.648h4.624 c4.979,0,9.708-1.882,13.3-5.232l6.863,4.032v4.849c0,6.833-5.56,12.392-12.393,12.392S43.208,38.052,43.208,31.219z" }),
          wp.element.createElement("path", { id: "XMLID_1330_", fill: "#146DB6", d: "M93.751,48.792c0.457,0.29,0.98,0.438,1.506,0.438c0.406,0,0.813-0.087,1.194-0.266 l9.521-4.471h34.891c3.324,0,6.027-2.704,6.027-6.028V9.12c0-3.324-2.703-6.027-6.027-6.027H98.475 c-3.322,0-6.027,2.703-6.027,6.027V46.42C92.447,47.382,92.939,48.276,93.751,48.792z M98.065,9.12 c0-0.226,0.185-0.41,0.409-0.41h42.388c0.227,0,0.409,0.184,0.409,0.41v29.345c0,0.226-0.183,0.41-0.409,0.41h-35.518 c-0.413,0-0.82,0.09-1.194,0.266l-6.085,2.857V9.12z" }),
          wp.element.createElement("path", { id: "XMLID_1331_", fill: "#146DB6", d: "M106.283,20.669h26.771c1.551,0,2.81-1.258,2.81-2.81c0-1.551-1.259-2.809-2.81-2.809 h-26.771c-1.552,0-2.809,1.258-2.809,2.809C103.475,19.411,104.731,20.669,106.283,20.669z" }),
          wp.element.createElement("path", { id: "XMLID_1332_", fill: "#146DB6", d: "M106.283,31.905h18.469c1.551,0,2.809-1.258,2.809-2.809s-1.258-2.809-2.809-2.809 h-18.469c-1.552,0-2.809,1.258-2.809,2.809S104.731,31.905,106.283,31.905z" })
        )
      )
    )
  );

  var ItemComponent = function (_Component) {
    _inherits(ItemComponent, _Component);

    function ItemComponent() {
      _classCallCheck(this, ItemComponent);

      return _possibleConstructorReturn(this, (ItemComponent.__proto__ || Object.getPrototypeOf(ItemComponent)).apply(this, arguments));
    }

    _createClass(ItemComponent, [{
      key: "componentDidMount",
      value: function componentDidMount() {
        var products = this.props.attributes.products;

        if (0 === products.length) {
          this.initList();
        }
      }
    }, {
      key: "initList",
      value: function initList() {
        var products = this.props.attributes.products;
        var setAttributes = this.props.setAttributes;

        setAttributes({
          products: [].concat(_toConsumableArray(products), [{
            index: products.length,
            title: '',
            country: '',
            description: '',
            email: ''
          }])
        });
      }
    }, {
      key: "render",
      value: function render() {
        var _props = this.props,
            attributes = _props.attributes,
            setAttributes = _props.setAttributes,
            clientId = _props.clientId,
            className = _props.className;
        var products = attributes.products;


        var itemList = products.sort(function (a, b) {
          return a.index - b.index;
        }).map(function (product, index) {
          return wp.element.createElement(
            "div",
            { className: "box-item" },
            wp.element.createElement(
              "div",
              { className: "box-inner" },
              wp.element.createElement(
                "span",
                {
                  className: "remove",
                  onClick: function onClick() {
                    var qewQusote = products.filter(function (item) {
                      return item.index != product.index;
                    }).map(function (t) {
                      if (t.index > product.index) {
                        t.index -= 1;
                      }

                      return t;
                    });

                    setAttributes({
                      products: qewQusote
                    });
                  }
                },
                wp.element.createElement("span", { className: "dashicons dashicons-no-alt" })
              ),
              wp.element.createElement(RichText, {
                tagName: "h2",
                placeholder: __('Title'),
                value: product.title,
                className: "title",
                onChange: function onChange(title) {
                  var newObject = Object.assign({}, product, {
                    title: title
                  });
                  setAttributes({
                    products: [].concat(_toConsumableArray(products.filter(function (item) {
                      return item.index != product.index;
                    })), [newObject])
                  });
                }
              }),
              wp.element.createElement(RichText, {
                tagName: "span",
                placeholder: __('Country/Countries'),
                value: product.country,
                className: "country",
                onChange: function onChange(country) {
                  var newObject = Object.assign({}, product, {
                    country: country
                  });
                  setAttributes({
                    products: [].concat(_toConsumableArray(products.filter(function (item) {
                      return item.index != product.index;
                    })), [newObject])
                  });
                }
              }),
              wp.element.createElement(RichText, {
                tagName: "p",
                className: "description",
                placeholder: __('Company Name and other details'),
                value: product.description,
                onChange: function onChange(description) {
                  var newObject = Object.assign({}, product, {
                    description: description
                  });
                  setAttributes({
                    products: [].concat(_toConsumableArray(products.filter(function (item) {
                      return item.index != product.index;
                    })), [newObject])
                  });
                }
              }),
              wp.element.createElement(TextControl, {
                type: "text",
                className: "email",
                value: product.email,
                placeholder: "Email Address",
                onChange: function onChange(email) {
                  var newObject = Object.assign({}, product, {
                    email: email
                  });
                  setAttributes({
                    products: [].concat(_toConsumableArray(products.filter(function (item) {
                      return item.index != product.index;
                    })), [newObject])
                  });
                }
              })
            )
          );
        });

        return wp.element.createElement(
          "div",
          { className: "delegation" },
          wp.element.createElement(
            "div",
            { className: "box-main four-grid" },
            itemList,
            wp.element.createElement(
              "div",
              { className: "box-item additem" },
              wp.element.createElement(
                "button",
                {
                  className: "components-button add",
                  onClick: function onClick(content) {
                    setAttributes({
                      products: [].concat(_toConsumableArray(products), [{
                        index: products.length,
                        title: '',
                        country: '',
                        description: '',
                        email: ''
                      }])
                    });
                  }
                },
                wp.element.createElement("span", { className: "dashicons dashicons-plus" }),
                " Add New Item"
              )
            )
          )
        );
      }
    }]);

    return ItemComponent;
  }(Component);

  registerBlockType('nab/delegation', {
    title: __('Delegation'),
    description: __('Delegation'),
    icon: { src: delegationBlockIcon },
    category: 'nabshow',
    keywords: [__('Delegation'), __('gutenberg'), __('nab')],
    attributes: {
      products: {
        type: 'array',
        default: []
      }
    },
    edit: ItemComponent,

    save: function save(props) {
      var attributes = props.attributes,
          className = props.className;
      var products = attributes.products;


      return wp.element.createElement(
        "div",
        { className: "delegation" },
        wp.element.createElement(
          "div",
          { className: "box-main four-grid" },
          products.map(function (product, index) {
            return wp.element.createElement(
              Fragment,
              null,
              product.title && wp.element.createElement(
                "div",
                { className: "box-item" },
                wp.element.createElement(
                  "div",
                  { className: "box-inner" },
                  product.title && wp.element.createElement(RichText.Content, {
                    tagName: "h2",
                    value: product.title,
                    className: "title"
                  }),
                  product.country && wp.element.createElement(RichText.Content, {
                    tagName: "span",
                    value: product.country,
                    className: "country"
                  }),
                  product.description && wp.element.createElement(RichText.Content, {
                    tagName: "p",
                    className: "description",
                    value: product.description
                  }),
                  product.email && wp.element.createElement(
                    "a",
                    { className: "email", href: "mailto:" + product.email },
                    product.email
                  )
                )
              )
            );
          })
        )
      );
    }
  });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);

/***/ }),
/* 35 */
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
      InspectorControls = wpEditor.InspectorControls,
      MediaUpload = wpEditor.MediaUpload;
  var PanelBody = wpComponents.PanelBody,
      PanelRow = wpComponents.PanelRow,
      ToggleControl = wpComponents.ToggleControl,
      Button = wpComponents.Button;


  var productWinnerAwardBlockIcon = wp.element.createElement(
    "svg",
    { width: "150px", height: "150px", viewBox: "173 173 150 150", "enable-background": "new 173 173 150 150" },
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M296.272,181.181h-9.234v-4.618h-18.472v4.618h-9.234v6.927c0,3.818,3.107,6.926,6.927,6.926h3.592 c1.225,2.099,3.235,3.664,5.644,4.29v3.281l-26.266,8.755c0.551-1.494,0.867-3.098,0.867-4.782v-6.926 c0-7.641-6.213-13.853-13.853-13.853c-7.641,0-13.853,6.212-13.853,13.853v6.926c0,1.684,0.317,3.288,0.868,4.782l-27.23-9.075 c-0.644-0.216-1.312-0.324-1.988-0.324c-3.462,0-6.283,2.819-6.283,6.283v0.733c0,2.167,1.146,4.217,2.99,5.349l27.025,16.631 v74.902h-9.236v13.853h73.883v-23.089h-11.543v-20.177c0-2.381-0.722-4.672-2.088-6.619l-14.075-20.107v-18.762l20.78-12.787v4.569 h-4.617v4.618h13.853v-4.618h-4.618v-7.414l1.627-1.002c1.845-1.134,2.991-3.181,2.991-5.347v-0.733c0-2.884-1.965-5.294-4.618-6.03 v-2.887c2.408-0.626,4.417-2.191,5.644-4.29h3.592c3.817,0,6.926-3.108,6.926-6.927V181.181z M266.259,190.417 c-1.272,0-2.31-1.038-2.31-2.309v-2.309h4.617v4.618H266.259z M227.008,199.652c0-5.093,4.142-9.235,9.235-9.235 c5.094,0,9.235,4.142,9.235,9.235v6.926c0,5.093-4.142,9.236-9.235,9.236c-5.093,0-9.235-4.143-9.235-9.236V199.652z M238.456,240.352l-2.212,2.211l-2.212-2.211l1.994-19.932c0.072,0.002,0.144,0.012,0.218,0.012c0.075,0,0.146-0.009,0.217-0.012 L238.456,240.352z M277.803,315.095h-64.648v-4.619h36.941v-9.234h27.707V315.095z M252.405,296.623h-6.927v9.236h-9.235v-43.077 c0-0.684,1-1.027,1.417-0.487l14.745,18.958V296.623z M280.111,208.977c0,0.575-0.302,1.115-0.791,1.418l-29.225,17.981v22.798 l14.912,21.3c0.816,1.17,1.251,2.543,1.251,3.973v20.177h-9.236v-16.952l-15.716-20.209c-1.032-1.327-2.588-2.088-4.271-2.088 c-2.983,0-5.409,2.426-5.409,5.408v43.077h-9.235v-77.483l-29.224-17.983c-0.489-0.3-0.791-0.842-0.791-1.415v-0.734 c0-1.097,1.152-1.923,2.192-1.58l33.729,11.245c0.974,0.686,2.038,1.239,3.174,1.657l-2.249,22.504l7.021,7.023l7.023-7.024 l-2.25-22.504c1.135-0.418,2.201-0.975,3.175-1.657l33.73-11.245c1.037-0.348,2.189,0.483,2.189,1.58V208.977z M282.42,190.417 c0,2.546-2.07,4.617-4.617,4.617s-4.617-2.071-4.617-4.617v-9.236h9.234V190.417z M291.655,188.108c0,1.271-1.036,2.309-2.309,2.309 h-2.309v-4.618h4.617V188.108z" }),
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M300.891,204.27h4.617v4.618h-4.617V204.27z" }),
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M296.272,208.888h4.618v4.617h-4.618V208.888z" }),
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M300.891,213.505h4.617v4.618h-4.617V213.505z" }),
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M305.508,208.888h4.617v4.617h-4.617V208.888z" }),
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M196.993,234.285h4.617v4.618h-4.617V234.285z" }),
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M192.375,238.902h4.618v4.617h-4.618V238.902z" }),
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M196.993,243.52h4.617v4.618h-4.617V243.52z" }),
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M201.61,238.902h4.618v4.617h-4.618V238.902z" }),
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M206.228,178.873h4.618v4.617h-4.618V178.873z" }),
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M201.61,183.49h4.618v4.618h-4.618V183.49z" }),
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M206.228,188.108h4.618v4.617h-4.618V188.108z" }),
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M210.846,183.49h4.617v4.618h-4.617V183.49z" })
  );

  var NabMediaSlider = function (_Component) {
    _inherits(NabMediaSlider, _Component);

    function NabMediaSlider() {
      _classCallCheck(this, NabMediaSlider);

      var _this = _possibleConstructorReturn(this, (NabMediaSlider.__proto__ || Object.getPrototypeOf(NabMediaSlider)).apply(this, arguments));

      _this.state = {
        bxSliderObj: {}
      };
      return _this;
    }

    _createClass(NabMediaSlider, [{
      key: "componentDidMount",
      value: function componentDidMount() {
        var products = this.props.attributes.products;

        if (0 === products.length) {
          this.initList();
        }
      }
    }, {
      key: "initList",
      value: function initList() {
        var products = this.props.attributes.products;
        var setAttributes = this.props.setAttributes;

        setAttributes({
          sliderActive: false,
          products: [].concat(_toConsumableArray(products), [{
            index: products.length,
            media: '',
            mediaAlt: '',
            title: '',
            subtitle: '',
            content: ''
          }])
        });
      }
    }, {
      key: "render",
      value: function render() {
        var _props = this.props,
            attributes = _props.attributes,
            setAttributes = _props.setAttributes,
            clientId = _props.clientId;
        var products = attributes.products,
            title = attributes.title,
            titleActive = attributes.titleActive;


        var getImageButton = function getImageButton(openEvent, index) {
          if (products[index].media) {
            return wp.element.createElement("img", { src: products[index].media, alt: products[index].alt, className: "img" });
          } else {
            return wp.element.createElement(
              Button,
              { onClick: openEvent, className: "button button-large" },
              wp.element.createElement("span", { className: "dashicons dashicons-upload" }),
              " Upload Product Image"
            );
          }
        };

        var productsList = products.sort(function (a, b) {
          return a.index - b.index;
        }).map(function (product, index) {
          return wp.element.createElement(
            "div",
            { className: "product-item" },
            wp.element.createElement(
              "div",
              { className: "product-inner" },
              wp.element.createElement(
                "span",
                {
                  className: "remove",
                  onClick: function onClick() {
                    var qewQusote = products.filter(function (item) {
                      return item.index != product.index;
                    }).map(function (t) {
                      if (t.index > product.index) {
                        t.index -= 1;
                      }

                      return t;
                    });

                    setAttributes({
                      products: qewQusote
                    });
                  }
                },
                wp.element.createElement("span", { className: "dashicons dashicons-no-alt" })
              ),
              wp.element.createElement(
                "div",
                { className: "media-img" },
                wp.element.createElement(MediaUpload, {
                  onSelect: function onSelect(media) {
                    var newObject = Object.assign({}, product, {
                      media: media.url,
                      mediaAlt: media.alt
                    });
                    setAttributes({
                      products: [].concat(_toConsumableArray(products.filter(function (item) {
                        return item.index != product.index;
                      })), [newObject])
                    });
                  },
                  type: "image",
                  value: attributes.imageID,
                  render: function render(_ref) {
                    var open = _ref.open;
                    return wp.element.createElement("span", { onClick: open, className: "dashicons dashicons-edit" });
                  }
                }),
                wp.element.createElement(MediaUpload, {
                  onSelect: function onSelect(media) {
                    var newObject = Object.assign({}, product, {
                      media: media.url,
                      mediaAlt: media.alt
                    });
                    setAttributes({
                      products: [].concat(_toConsumableArray(products.filter(function (item) {
                        return item.index != product.index;
                      })), [newObject])
                    });
                  },
                  type: "image",
                  value: attributes.imageID,
                  render: function render(_ref2) {
                    var open = _ref2.open;
                    return getImageButton(open, index);
                  }
                })
              ),
              wp.element.createElement(RichText, {
                tagName: "h3",
                placeholder: __('Title'),
                value: product.title,
                className: "title",
                onChange: function onChange(title) {
                  var newObject = Object.assign({}, product, {
                    title: title
                  });
                  setAttributes({
                    products: [].concat(_toConsumableArray(products.filter(function (item) {
                      return item.index != product.index;
                    })), [newObject])
                  });
                }
              }),
              wp.element.createElement(RichText, {
                tagName: "span",
                className: "subtitle",
                placeholder: __('Company Name'),
                value: product.subtitle,
                onChange: function onChange(subtitle) {
                  var newObject = Object.assign({}, product, {
                    subtitle: subtitle
                  });
                  setAttributes({
                    products: [].concat(_toConsumableArray(products.filter(function (item) {
                      return item.index != product.index;
                    })), [newObject])
                  });
                }
              }),
              wp.element.createElement(RichText, {
                tagName: "p",
                className: "content",
                placeholder: __('Description'),
                value: product.content,
                onChange: function onChange(content) {
                  var newObject = Object.assign({}, product, {
                    content: content
                  });
                  setAttributes({
                    products: [].concat(_toConsumableArray(products.filter(function (item) {
                      return item.index != product.index;
                    })), [newObject])
                  });
                }
              })
            )
          );
        });

        return wp.element.createElement(
          "div",
          { className: "products-winners" },
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
                  label: __('Show Title'),
                  checked: titleActive,
                  onChange: function onChange() {
                    return setAttributes({ titleActive: !titleActive });
                  }
                })
              )
            )
          ),
          titleActive && wp.element.createElement(RichText, {
            tagName: "h2",
            className: "product-title",
            placeholder: __('Category'),
            value: title,
            onChange: function onChange(value) {
              return setAttributes({ title: value });
            }
          }),
          wp.element.createElement(
            "div",
            { className: "product-main" },
            productsList,
            wp.element.createElement(
              "div",
              { className: "product-item additem" },
              wp.element.createElement(
                "button",
                {
                  className: "components-button add",
                  onClick: function onClick(content) {
                    setAttributes({
                      sliderActive: false,
                      products: [].concat(_toConsumableArray(products), [{
                        index: products.length,
                        media: '',
                        mediaAlt: '',
                        title: '',
                        subtitle: '',
                        content: ''
                      }])
                    });
                  }
                },
                wp.element.createElement("span", { className: "dashicons dashicons-plus" }),
                " Add New Item"
              )
            )
          )
        );
      }
    }]);

    return NabMediaSlider;
  }(Component);

  /* Parent schedule Block */


  registerBlockType('nab/products-winners-award', {
    title: __('Products Winners Award'),
    description: __('Products Winners'),
    icon: { src: productWinnerAwardBlockIcon },
    category: 'nabshow',
    keywords: [__('Products Winners Award'), __('gutenberg'), __('nab')],
    attributes: {
      products: {
        type: 'array',
        default: []
      },
      title: {
        type: 'string'
      },
      titleActive: {
        type: 'boolean',
        default: true
      }
    },
    edit: NabMediaSlider,

    save: function save(props) {
      var attributes = props.attributes,
          className = props.className;
      var products = attributes.products,
          title = attributes.title,
          titleActive = attributes.titleActive;


      return wp.element.createElement(
        "div",
        { className: "products-winners" },
        titleActive && title && wp.element.createElement(RichText.Content, {
          tagName: "h2",
          className: "product-title",
          value: title
        }),
        wp.element.createElement(
          "div",
          { className: "product-main" },
          products.map(function (product, index) {
            return wp.element.createElement(
              "div",
              { className: "product-item" },
              wp.element.createElement(
                "div",
                { className: "product-inner" },
                wp.element.createElement(
                  "div",
                  { className: "media-img" },
                  product.media ? wp.element.createElement("img", { src: product.media, alt: product.alt, className: "img" }) : wp.element.createElement(
                    "div",
                    { className: "no-image" },
                    "No Media"
                  )
                ),
                product.title && wp.element.createElement(RichText.Content, {
                  tagName: "h3",
                  value: product.title,
                  className: "title"
                }),
                product.subtitle && wp.element.createElement(RichText.Content, {
                  tagName: "span",
                  className: "subtitle",
                  value: product.subtitle
                }),
                product.content && wp.element.createElement(RichText.Content, {
                  tagName: "p",
                  className: "content",
                  value: product.content
                })
              )
            );
          })
        )
      );
    }
  });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);

/***/ }),
/* 36 */
/***/ (function(module, exports) {

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _toConsumableArray(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } else { return Array.from(arr); } }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
  var __ = wpI18n.__;
  var registerBlockType = wpBlocks.registerBlockType;
  var Component = wpElement.Component;
  var MediaUpload = wpEditor.MediaUpload,
      InspectorControls = wpEditor.InspectorControls;
  var Button = wpComponents.Button;


  var photosBlockIcon = wp.element.createElement(
    "svg",
    { width: "150px", height: "150px", viewBox: "222.64 222.641 150 150", "enable-background": "new 222.64 222.641 150 150" },
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement(
          "g",
          null,
          wp.element.createElement("path", { fill: "#0F6CB6", d: "M362.786,238.301H251.138c-2.563,0-4.661,2.072-4.661,4.661v4.661h-4.661 c-2.563,0-4.661,2.071-4.661,4.661v4.661h-4.661c-2.563,0-4.661,2.072-4.661,4.661v90.713c0,2.563,2.071,4.661,4.661,4.661 h111.647c2.562,0,4.66-2.071,4.66-4.661v-4.661h4.662c2.562,0,4.66-2.071,4.66-4.661v-4.661h4.662c2.562,0,4.66-2.071,4.66-4.66 v-90.714C367.446,240.373,365.375,238.301,362.786,238.301z M344.169,313.531l-12.185-13.955c-0.927-1.063-2.563-1.063-3.516,0 l-14.719,16.845l-40.124-35.653c-0.873-0.791-2.208-0.791-3.081,0l-37.997,33.773v-50.645c0-1.282,1.036-2.317,2.317-2.317 h106.986c1.281,0,2.317,1.036,2.317,2.317V313.531L344.169,313.531z M351.174,342.971h-2.317v-81.419 c0-2.562-2.071-4.661-4.66-4.661H241.844v-2.316c0-1.282,1.036-2.317,2.316-2.317h106.986c1.281,0,2.317,1.036,2.317,2.317 l0.027,86.08C353.491,341.935,352.455,342.971,351.174,342.971z M360.469,333.648h-2.317v-81.392c0-2.562-2.071-4.661-4.66-4.661 H251.138v-2.316c0-1.281,1.036-2.317,2.317-2.317h106.986c1.281,0,2.316,1.036,2.316,2.317v86.052h0.028 C362.786,332.612,361.75,333.648,360.469,333.648z" }),
          wp.element.createElement("path", { fill: "#0F6CB6", d: "M311.622,275.507c-5.124,0-9.294,4.17-9.294,9.295s4.17,9.295,9.294,9.295 c5.125,0,9.295-4.171,9.295-9.295S316.747,275.507,311.622,275.507z" })
        )
      )
    )
  );

  var PhotoComponent = function (_Component) {
    _inherits(PhotoComponent, _Component);

    function PhotoComponent() {
      _classCallCheck(this, PhotoComponent);

      return _possibleConstructorReturn(this, (PhotoComponent.__proto__ || Object.getPrototypeOf(PhotoComponent)).apply(this, arguments));
    }

    _createClass(PhotoComponent, [{
      key: "render",
      value: function render() {
        var _props = this.props,
            attributes = _props.attributes,
            setAttributes = _props.setAttributes,
            clientId = _props.clientId,
            className = _props.className;
        var dataArry = attributes.dataArry;


        if (0 === dataArry.length) {
          return wp.element.createElement(
            "div",
            { className: "photos-add first-time" },
            wp.element.createElement(MediaUpload, {
              multiple: true,
              onSelect: function onSelect(item) {
                var photoInsert = item.map(function (item, index) {
                  return {
                    index: index,
                    media: item.url,
                    alt: item.alt,
                    id: item.id,
                    width: item.sizes.full.width
                  };
                });
                setAttributes({
                  dataArry: [].concat(_toConsumableArray(dataArry), _toConsumableArray(photoInsert))
                });
              },
              type: "image",
              render: function render(_ref) {
                var open = _ref.open;
                return wp.element.createElement(
                  Button,
                  { onClick: open, className: "button button-large" },
                  wp.element.createElement("span", { className: "dashicons dashicons-upload" }),
                  " Click Here to Upload"
                );
              }
            })
          );
        }

        return wp.element.createElement(
          "div",
          { className: "nab-photos " + className },
          dataArry.map(function (photo, index) {
            return wp.element.createElement(
              "div",
              { className: "photo-item", key: index },
              wp.element.createElement(
                "div",
                { className: "photo-inner" },
                wp.element.createElement("span", {
                  onClick: function onClick() {
                    var qewQusote = dataArry.filter(function (item) {
                      return item.index != photo.index;
                    }).map(function (t) {
                      if (t.index > photo.index) {
                        t.index -= 1;
                      }

                      return t;
                    });
                    setAttributes({
                      dataArry: qewQusote
                    });
                  },
                  className: "dashicons dashicons-no-alt remove" }),
                wp.element.createElement("img", { src: photo.media, alt: photo.alt, className: "media", width: photo.width })
              )
            );
          }),
          wp.element.createElement(
            InspectorControls,
            null,
            wp.element.createElement(
              "div",
              { className: "photos-add" },
              wp.element.createElement(MediaUpload, {
                multiple: true,
                onSelect: function onSelect(item) {
                  var photoInsert = item.map(function (item, index) {
                    return {
                      index: index,
                      media: item.url,
                      alt: item.alt,
                      id: item.id,
                      width: item.sizes.full.width
                    };
                  });
                  setAttributes({
                    dataArry: [].concat(_toConsumableArray(dataArry), _toConsumableArray(photoInsert))
                  });
                },
                type: "image",
                render: function render(_ref2) {
                  var open = _ref2.open;
                  return wp.element.createElement(
                    Button,
                    { onClick: open, className: "button button-large" },
                    wp.element.createElement("span", { className: "dashicons dashicons-upload" }),
                    " Upload Image"
                  );
                }
              })
            )
          )
        );
      }
    }]);

    return PhotoComponent;
  }(Component);

  registerBlockType('nab/nab-photos', {
    title: __('Photos'),
    description: __('NabShow Photos'),
    icon: { src: photosBlockIcon },
    category: 'nabshow',
    keywords: [__('Photos'), __('gutenberg'), __('nab')],
    attributes: {
      dataArry: {
        type: 'array',
        default: []
      }
    },
    edit: PhotoComponent,

    save: function save(props) {
      var attributes = props.attributes,
          className = props.className;
      var dataArry = attributes.dataArry;


      return wp.element.createElement(
        "div",
        { className: "nab-photos" },
        dataArry.map(function (photo, index) {
          return wp.element.createElement(
            "div",
            { className: "photo-item", key: index },
            wp.element.createElement(
              "div",
              { className: "photo-inner" },
              wp.element.createElement(
                "div",
                { className: "hover-items" },
                wp.element.createElement(
                  "a",
                  { className: "popup-btn" },
                  wp.element.createElement("i", { className: "fa fa-image" })
                ),
                wp.element.createElement(
                  "a",
                  { className: "download", href: photo.media, download: true },
                  wp.element.createElement("i", { className: "fa fa-download" })
                )
              ),
              wp.element.createElement("img", { src: photo.media, alt: photo.alt, className: "media", width: photo.width })
            )
          );
        }),
        wp.element.createElement(
          "div",
          { className: "photos-popup" },
          wp.element.createElement(
            "div",
            { className: "photos-dialog" },
            wp.element.createElement(
              "span",
              { "class": "close" },
              "\xD7"
            ),
            wp.element.createElement(
              "div",
              { className: "photos-content" },
              wp.element.createElement(
                "div",
                { className: "photos-body" },
                wp.element.createElement("img", { className: "photos-popup-img", src: "" })
              )
            )
          ),
          wp.element.createElement("div", { "class": "photos-backdrop" })
        )
      );
    }
  });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);

/***/ }),
/* 37 */
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
      MediaUpload = wpEditor.MediaUpload;
  var Button = wpComponents.Button,
      TextControl = wpComponents.TextControl;


  var badgeDiscountBlockIcon = wp.element.createElement(
    "svg",
    { width: "150px", height: "150px", viewBox: "0 0 150 150", "enable-background": "new 0 0 150 150" },
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("path", { fill: "#146DB6", d: "M123.53,4.704h-97.06c-12.002,0-21.767,9.764-21.767,21.767v114.707c0,2.274,1.844,4.117,4.119,4.117 h132.354c2.274,0,4.119-1.843,4.119-4.117V26.471C145.296,14.468,135.531,4.704,123.53,4.704z M137.059,137.059H83.53v-13.973 c0-1.092-0.434-2.14-1.206-2.912l-9.88-9.879l9.88-9.879c0.772-0.773,1.206-1.821,1.206-2.913V83.531h13.973 c1.092,0,2.14-0.434,2.912-1.207l9.879-9.879l9.88,9.879c0.772,0.772,1.82,1.207,2.912,1.207h13.973V137.059z M137.059,75.292 h-12.266l-11.586-11.584c-0.772-0.773-1.82-1.207-2.912-1.207c-1.093,0-2.14,0.434-2.912,1.207L95.798,75.292H79.412 c-2.274,0-4.118,1.846-4.118,4.119v16.386l-11.586,11.585c-1.608,1.608-1.608,4.216,0,5.825l11.586,11.586v12.266H12.942V48.236 h124.117V75.292z M137.059,39.999H12.942V26.471c0-7.46,6.069-13.529,13.529-13.529h97.06c7.459,0,13.528,6.069,13.528,13.529 V39.999z" }),
      wp.element.createElement("path", { fill: "#146DB6", d: "M94.146,120.618c-1.608,1.608-1.608,4.216,0,5.824s4.216,1.608,5.825,0l26.471-26.471 c1.608-1.608,1.608-4.217,0-5.825s-4.216-1.608-5.825,0L94.146,120.618z" }),
      wp.element.createElement("circle", { fill: "#146DB6", cx: "26.471", cy: "26.47", r: "4.119" }),
      wp.element.createElement("circle", { fill: "#146DB6", cx: "44.118", cy: "26.47", r: "4.119" }),
      wp.element.createElement("circle", { fill: "#146DB6", cx: "61.765", cy: "26.47", r: "4.119" }),
      wp.element.createElement("path", { fill: "#146DB6", d: "M97.059,105.59c2.275,0,4.119-1.844,4.119-4.118v-4.413c0-2.274-1.844-4.119-4.119-4.119 c-2.274,0-4.119,1.845-4.119,4.119v4.413C92.939,103.746,94.784,105.59,97.059,105.59z" }),
      wp.element.createElement("path", { fill: "#146DB6", d: "M123.53,115c-2.274,0-4.119,1.844-4.119,4.119v4.411c0,2.274,1.845,4.119,4.119,4.119 s4.119-1.845,4.119-4.119v-4.411C127.649,116.843,125.805,115,123.53,115z" }),
      wp.element.createElement("path", { fill: "#146DB6", d: "M26.471,65.883h26.471c2.274,0,4.119-1.844,4.119-4.119c0-2.274-1.844-4.119-4.119-4.119H26.471 c-2.275,0-4.119,1.845-4.119,4.119C22.352,64.04,24.195,65.883,26.471,65.883z" }),
      wp.element.createElement("path", { fill: "#146DB6", d: "M26.471,83.53h35.294c2.275,0,4.119-1.843,4.119-4.119c0-2.273-1.844-4.119-4.119-4.119H26.471 c-2.275,0-4.119,1.846-4.119,4.119C22.352,81.688,24.195,83.53,26.471,83.53z" }),
      wp.element.createElement("path", { fill: "#146DB6", d: "M26.471,101.178h17.647c2.274,0,4.119-1.844,4.119-4.119c0-2.274-1.845-4.119-4.119-4.119H26.471 c-2.275,0-4.119,1.845-4.119,4.119C22.352,99.334,24.195,101.178,26.471,101.178z" })
    )
  );

  var ItemComponent = function (_Component) {
    _inherits(ItemComponent, _Component);

    function ItemComponent() {
      _classCallCheck(this, ItemComponent);

      return _possibleConstructorReturn(this, (ItemComponent.__proto__ || Object.getPrototypeOf(ItemComponent)).apply(this, arguments));
    }

    _createClass(ItemComponent, [{
      key: "componentDidMount",
      value: function componentDidMount() {
        var products = this.props.attributes.products;

        if (0 === products.length) {
          this.initList();
        }
      }
    }, {
      key: "initList",
      value: function initList() {
        var products = this.props.attributes.products;
        var setAttributes = this.props.setAttributes;

        setAttributes({
          products: [].concat(_toConsumableArray(products), [{
            index: products.length,
            title: '',
            location: '',
            discount: '',
            dates: '',
            description: ''
          }])
        });
      }
    }, {
      key: "render",
      value: function render() {
        var _props = this.props,
            attributes = _props.attributes,
            setAttributes = _props.setAttributes,
            clientId = _props.clientId,
            className = _props.className;
        var products = attributes.products,
            mainTitle = attributes.mainTitle;


        var itemList = products.sort(function (a, b) {
          return a.index - b.index;
        }).map(function (product, index) {
          return wp.element.createElement(
            "div",
            { key: index, className: "box-item" },
            wp.element.createElement(
              "div",
              { className: "box-inner" },
              wp.element.createElement(
                "span",
                {
                  className: "remove",
                  onClick: function onClick() {
                    var qewQusote = products.filter(function (item) {
                      return item.index != product.index;
                    }).map(function (t) {
                      if (t.index > product.index) {
                        t.index -= 1;
                      }

                      return t;
                    });

                    setAttributes({
                      products: qewQusote
                    });
                  }
                },
                wp.element.createElement("span", { className: "dashicons dashicons-no-alt" })
              ),
              wp.element.createElement(RichText, {
                tagName: "h2",
                placeholder: __('Discount Title'),
                value: product.title,
                className: "title",
                onChange: function onChange(title) {
                  var newObject = Object.assign({}, product, {
                    title: title
                  });
                  setAttributes({
                    products: [].concat(_toConsumableArray(products.filter(function (item) {
                      return item.index != product.index;
                    })), [newObject])
                  });
                }
              }),
              wp.element.createElement(RichText, {
                tagName: "span",
                placeholder: __('Location/Address'),
                value: product.location,
                className: "location",
                onChange: function onChange(location) {

                  var newObject = Object.assign({}, product, {
                    location: location
                  });
                  setAttributes({
                    products: [].concat(_toConsumableArray(products.filter(function (item) {
                      return item.index != product.index;
                    })), [newObject])
                  });
                }
              }),
              wp.element.createElement(RichText, {
                tagName: "span",
                className: "discount",
                placeholder: __('Discount'),
                value: product.discount,
                onChange: function onChange(discount) {

                  var newObject = Object.assign({}, product, {
                    discount: discount
                  });
                  setAttributes({
                    products: [].concat(_toConsumableArray(products.filter(function (item) {
                      return item.index != product.index;
                    })), [newObject])
                  });
                }
              }),
              wp.element.createElement(RichText, {
                tagName: "span",
                className: "dates",
                placeholder: __('Dates(s)'),
                value: product.dates,
                onChange: function onChange(dates) {

                  var newObject = Object.assign({}, product, {
                    dates: dates
                  });
                  setAttributes({
                    products: [].concat(_toConsumableArray(products.filter(function (item) {
                      return item.index != product.index;
                    })), [newObject])
                  });
                }
              }),
              wp.element.createElement(RichText, {
                tagName: "p",
                className: "description",
                placeholder: __('Instructions on How to Redeem'),
                value: product.description,
                onChange: function onChange(description) {

                  var newObject = Object.assign({}, product, {
                    description: description
                  });
                  setAttributes({
                    products: [].concat(_toConsumableArray(products.filter(function (item) {
                      return item.index != product.index;
                    })), [newObject])
                  });
                }
              })
            )
          );
        });

        return wp.element.createElement(
          "div",
          { className: "badge-discounts" },
          wp.element.createElement(RichText, {
            tagName: "h2",
            onChange: function onChange(value) {
              return setAttributes({ mainTitle: value });
            },
            placeholder: __('Title'),
            value: mainTitle,
            className: "badge-title"
          }),
          wp.element.createElement(
            "div",
            { className: "box-main four-grid" },
            itemList,
            wp.element.createElement(
              "div",
              { className: "box-item additem" },
              wp.element.createElement(
                "button",
                {
                  className: "components-button add",
                  onClick: function onClick(content) {
                    setAttributes({
                      products: [].concat(_toConsumableArray(products), [{
                        index: products.length,
                        title: '',
                        location: '',
                        discount: '',
                        dates: '',
                        description: ''
                      }])
                    });
                  }
                },
                wp.element.createElement("span", { className: "dashicons dashicons-plus" }),
                " Add New Item"
              )
            )
          )
        );
      }
    }]);

    return ItemComponent;
  }(Component);

  registerBlockType('nab/nab-badge-discounts', {
    title: __('Badge Discounts'),
    description: __('Badge Discounts'),
    icon: { src: badgeDiscountBlockIcon },
    category: 'nabshow',
    keywords: [__('Badge'), __('Discounts'), __('gutenberg'), __('nab')],
    attributes: {
      products: {
        type: 'array',
        default: []
      },
      mainTitle: {
        type: 'string'
      }
    },
    edit: ItemComponent,

    save: function save(props) {
      var attributes = props.attributes,
          className = props.className;
      var products = attributes.products,
          mainTitle = attributes.mainTitle;


      return wp.element.createElement(
        "div",
        { className: "badge-discounts" },
        wp.element.createElement(RichText.Content, {
          tagName: "h2",
          value: mainTitle,
          className: "badge-title"
        }),
        wp.element.createElement(
          "div",
          { className: "box-main four-grid" },
          products.map(function (product, index) {
            return wp.element.createElement(
              Fragment,
              null,
              product.title && wp.element.createElement(
                "div",
                { className: "box-item" },
                wp.element.createElement(
                  "div",
                  { className: "box-inner" },
                  product.title && wp.element.createElement(RichText.Content, {
                    tagName: "h2",
                    value: product.title,
                    className: "title"
                  }),
                  product.location && wp.element.createElement(RichText.Content, {
                    tagName: "span",
                    value: product.location,
                    className: "location"
                  }),
                  product.discount && wp.element.createElement(RichText.Content, {
                    tagName: "span",
                    className: "discount",
                    value: product.discount
                  }),
                  product.dates && wp.element.createElement(RichText.Content, {
                    tagName: "span",
                    className: "dates",
                    value: product.dates
                  }),
                  product.description && wp.element.createElement(RichText.Content, {
                    tagName: "p",
                    className: "description",
                    value: product.description
                  })
                )
              )
            );
          })
        )
      );
    }
  });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);

/***/ }),
/* 38 */
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
  var RichText = wpEditor.RichText;
  var TextControl = wpComponents.TextControl;


  var registrationPassesAwardBlockIcon = wp.element.createElement(
    "svg",
    { width: "150px", height: "150px", viewBox: "222.64 222.641 150 150", "enable-background": "new 222.64 222.641 150 150" },
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("path", { fill: "#0F6CB6", d: "M350.696,331.655c-0.431,0.45-0.69,1.07-0.69,1.689s0.238,1.238,0.69,1.69c0.45,0.428,1.072,0.69,1.69,0.69 c0.619,0,1.237-0.263,1.689-0.69c0.429-0.452,0.69-1.071,0.69-1.69s-0.262-1.239-0.69-1.689 C353.196,330.798,351.602,330.774,350.696,331.655z" }),
      wp.element.createElement("path", { fill: "#0F6CB6", d: "M282.497,326.83l-8.66-4.423v-0.922c3.875-2.115,6.601-5.603,8.122-10.39 c2.307-1.222,3.78-3.602,3.78-6.271v-2.381c0-2.206-1.026-4.252-2.74-5.594c-1.485-8.998-7.765-13.558-18.683-13.558 c-0.517,0-1.021,0.021-1.514,0.06c-2.059,0.159-5.067-0.007-7.674-1.764c-0.976-0.657-1.711-1.294-2.182-1.895 c-0.8-1.019-2.145-1.374-3.335-0.878c-1.193,0.49-1.895,1.685-1.745,2.97c0.1,0.886,0.25,1.924,0.476,3.059 c0.459,2.321,0.459,2.321-0.186,3.708c-0.243,0.526-0.542,1.167-0.895,2.03c-0.788,1.929-1.347,4.04-1.668,6.299 c-1.69,1.343-2.699,3.378-2.699,5.563v2.38c0,2.67,1.473,5.05,3.78,6.274c1.521,4.789,4.246,8.276,8.122,10.39v0.896l-8.974,4.42 c-3.275,1.788-5.308,5.215-5.308,8.947v3.151c0,1.911,0,6.387,23.803,6.387c23.803,0,23.803-4.476,23.803-6.387v-2.961 C288.119,332.063,285.965,328.569,282.497,326.83z M283.358,338.364c-1.483,0.903-7.524,2.162-19.042,2.162 c-11.519,0-17.56-1.259-19.043-2.162v-2.615c0-1.987,1.086-3.815,2.74-4.721l9.184-4.521c1.433-0.7,2.358-2.183,2.358-3.781v-4.293 l-1.437-0.622c-3.611-1.552-5.958-4.52-7.177-9.077l-0.34-1.268l-1.252-0.39c-0.997-0.31-1.694-1.237-1.694-2.252v-2.38 c0-0.864,0.493-1.664,1.288-2.088l1.116-0.596l0.131-1.256c0.236-2.235,0.733-4.294,1.481-6.118 c0.316-0.774,0.585-1.352,0.804-1.826c0.807-1.735,1.1-2.63,0.897-4.465c2.797,1.6,6.158,2.283,9.812,2.004 c0.369-0.031,0.748-0.048,1.135-0.048c8.913,0,13.264,3.228,14.113,10.471l0.147,1.245l1.109,0.583 c0.795,0.422,1.29,1.221,1.29,2.093v2.381c0,1.015-0.697,1.941-1.694,2.251l-1.252,0.391l-0.34,1.267 c-1.218,4.559-3.565,7.526-7.177,9.078l-1.437,0.621v4.313c0,1.586,0.878,3.023,2.294,3.749l8.969,4.58l0.017,0.009 c1.852,0.926,3.002,2.79,3.002,4.858V338.364L283.358,338.364z" }),
      wp.element.createElement("path", { fill: "#0F6CB6", d: "M300.02,295.303h23.804c1.315,0,2.38-1.064,2.38-2.38c0-1.316-1.064-2.38-2.38-2.38H300.02 c-1.315,0-2.38,1.064-2.38,2.38C297.64,294.239,298.704,295.303,300.02,295.303z" }),
      wp.element.createElement("path", { fill: "#0F6CB6", d: "M302.4,331.008h-2.381c-1.315,0-2.38,1.063-2.38,2.38s1.064,2.381,2.38,2.381h2.381 c1.316,0,2.381-1.064,2.381-2.381S303.717,331.008,302.4,331.008z" }),
      wp.element.createElement("path", { fill: "#0F6CB6", d: "M316.682,331.008h-4.76c-1.316,0-2.381,1.063-2.381,2.38s1.064,2.381,2.381,2.381h4.76 c1.317,0,2.381-1.064,2.381-2.381S317.999,331.008,316.682,331.008z" }),
      wp.element.createElement("path", { fill: "#0F6CB6", d: "M328.584,331.008h-2.381c-1.316,0-2.38,1.063-2.38,2.38s1.063,2.381,2.38,2.381h2.381 c1.315,0,2.38-1.064,2.38-2.381S329.899,331.008,328.584,331.008z" }),
      wp.element.createElement("path", { fill: "#0F6CB6", d: "M342.866,331.008h-4.761c-1.317,0-2.381,1.063-2.381,2.38s1.063,2.381,2.381,2.381h4.761 c1.315,0,2.379-1.064,2.379-2.381S344.182,331.008,342.866,331.008z" }),
      wp.element.createElement("path", { fill: "#0F6CB6", d: "M352.387,304.824H300.02c-1.315,0-2.38,1.063-2.38,2.381c0,1.315,1.064,2.38,2.38,2.38h52.367 c1.316,0,2.38-1.064,2.38-2.38C354.767,305.888,353.704,304.824,352.387,304.824z" }),
      wp.element.createElement("path", { fill: "#0F6CB6", d: "M352.387,319.105H300.02c-1.315,0-2.38,1.064-2.38,2.381s1.064,2.38,2.38,2.38h52.367 c1.316,0,2.38-1.063,2.38-2.38S353.704,319.105,352.387,319.105z" }),
      wp.element.createElement("path", { fill: "#0F6CB6", d: "M357.914,259.555h-43.613v-18.297c0-3.038-2.467-5.505-5.505-5.505h-22.315 c-3.035,0-5.503,2.468-5.503,5.505v18.297h-43.612c-6.139,0-11.135,4.996-11.135,11.135v77.705c0,6.137,4.996,11.133,11.135,11.133 h120.55c6.137,0,11.133-4.996,11.133-11.136V270.69C369.049,264.551,364.053,259.555,357.914,259.555z M285.738,241.258 c0-0.41,0.335-0.745,0.743-0.745h22.315c0.41,0,0.745,0.335,0.745,0.745v18.297v13.539c0,0.407-0.335,0.743-0.745,0.743h-22.315 c-0.407,0-0.743-0.336-0.743-0.743v-13.539V241.258z M364.288,348.393c0,3.516-2.858,6.375-6.374,6.375H237.366 c-3.516,0-6.375-2.859-6.375-6.375V270.69c0-3.516,2.858-6.375,6.375-6.375h43.612v8.779c0,3.035,2.468,5.503,5.503,5.503h22.315 c3.037,0,5.505-2.468,5.505-5.503v-8.779h43.612c3.516,0,6.375,2.859,6.375,6.375V348.393L364.288,348.393z" }),
      wp.element.createElement("path", { fill: "#0F6CB6", d: "M297.64,261.936c5.252,0,9.521-4.27,9.521-9.521s-4.27-9.521-9.521-9.521c-5.251,0-9.521,4.27-9.521,9.521 S292.389,261.936,297.64,261.936z M297.64,247.654c2.626,0,4.761,2.135,4.761,4.761c0,2.626-2.135,4.761-4.761,4.761 s-4.761-2.135-4.761-4.761C292.879,249.789,295.014,247.654,297.64,247.654z" })
    )
  );

  var ItemComponent = function (_Component) {
    _inherits(ItemComponent, _Component);

    function ItemComponent() {
      _classCallCheck(this, ItemComponent);

      return _possibleConstructorReturn(this, (ItemComponent.__proto__ || Object.getPrototypeOf(ItemComponent)).apply(this, arguments));
    }

    _createClass(ItemComponent, [{
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
            index: dataArray.length,
            itemTitle: '',
            itemDetails: '',
            price: '',
            subPrice: '',
            link: '',
            comming: false
          }])
        });
      }
    }, {
      key: "render",
      value: function render() {
        var _props = this.props,
            attributes = _props.attributes,
            setAttributes = _props.setAttributes,
            clientId = _props.clientId,
            className = _props.className;
        var dataArray = attributes.dataArray,
            title = attributes.title,
            details = attributes.details;


        var itemList = dataArray.sort(function (a, b) {
          return a.index - b.index;
        }).map(function (product, index) {
          return wp.element.createElement(
            "div",
            { className: "registration-item " + (product.comming ? 'comming-soon' : '') },
            wp.element.createElement(
              "span",
              {
                className: "remove",
                onClick: function onClick() {
                  var qewQusote = dataArray.filter(function (item) {
                    return item.index != product.index;
                  }).map(function (t) {
                    if (t.index > product.index) {
                      t.index -= 1;
                    }

                    return t;
                  });

                  setAttributes({
                    dataArray: qewQusote
                  });
                }
              },
              wp.element.createElement("span", { className: "dashicons dashicons-no-alt" })
            ),
            wp.element.createElement(
              "div",
              { className: "plus-sec" },
              false === product.comming && wp.element.createElement(
                Fragment,
                null,
                wp.element.createElement(
                  "span",
                  null,
                  "+"
                ),
                wp.element.createElement(
                  "div",
                  { className: "plus-link" },
                  wp.element.createElement(TextControl, {
                    type: "string",
                    value: product.link,
                    placeholder: "#",
                    onChange: function onChange(link) {
                      var newObject = Object.assign({}, product, {
                        link: link
                      });
                      setAttributes({
                        dataArray: [].concat(_toConsumableArray(dataArray.filter(function (item) {
                          return item.index != product.index;
                        })), [newObject])
                      });
                    }
                  })
                )
              )
            ),
            wp.element.createElement(
              "div",
              { className: "middle-sec" },
              wp.element.createElement(RichText, {
                tagName: "h3",
                placeholder: __('Item Title'),
                value: product.itemTitle,
                className: "item-title",
                onChange: function onChange(itemTitle) {
                  var newObject = Object.assign({}, product, {
                    itemTitle: itemTitle
                  });
                  setAttributes({
                    dataArray: [].concat(_toConsumableArray(dataArray.filter(function (item) {
                      return item.index != product.index;
                    })), [newObject])
                  });
                }
              }),
              wp.element.createElement(RichText, {
                tagName: "p",
                placeholder: __('Description'),
                value: product.itemDetails,
                className: "item-description",
                onChange: function onChange(itemDetails) {
                  var newObject = Object.assign({}, product, {
                    itemDetails: itemDetails
                  });
                  setAttributes({
                    dataArray: [].concat(_toConsumableArray(dataArray.filter(function (item) {
                      return item.index != product.index;
                    })), [newObject])
                  });
                }
              })
            ),
            wp.element.createElement(
              "div",
              { className: "last-sec" },
              wp.element.createElement(RichText, {
                tagName: "p",
                placeholder: __('Price'),
                value: product.price,
                className: "price",
                onChange: function onChange(price) {
                  var newObject = Object.assign({}, product, {
                    price: price
                  });
                  setAttributes({
                    dataArray: [].concat(_toConsumableArray(dataArray.filter(function (item) {
                      return item.index != product.index;
                    })), [newObject])
                  });
                }
              }),
              false == product.comming ? wp.element.createElement(RichText, {
                tagName: "span",
                placeholder: __('Sub Price'),
                value: product.subPrice,
                className: "sub-price",
                onChange: function onChange(subPrice) {
                  var newObject = Object.assign({}, product, {
                    subPrice: subPrice
                  });
                  setAttributes({
                    dataArray: [].concat(_toConsumableArray(dataArray.filter(function (item) {
                      return item.index != product.index;
                    })), [newObject])
                  });
                }
              }) : ''
            )
          );
        });

        return wp.element.createElement(
          "div",
          { className: "registration-passes" },
          wp.element.createElement(
            "div",
            { className: "registration-head" },
            wp.element.createElement(RichText, {
              tagName: "h2",
              placeholder: __('Title'),
              value: title,
              className: "title",
              onChange: function onChange(title) {
                setAttributes({ title: title });
              }
            }),
            wp.element.createElement(RichText, {
              tagName: "p",
              placeholder: __('Description'),
              value: details,
              className: "description",
              onChange: function onChange(details) {
                setAttributes({ details: details });
              }
            })
          ),
          itemList,
          wp.element.createElement(
            "div",
            { className: "registration-item additem" },
            wp.element.createElement(
              "button",
              {
                className: "components-button add",
                onClick: function onClick(content) {
                  setAttributes({
                    dataArray: [].concat(_toConsumableArray(dataArray), [{
                      index: dataArray.length,
                      itemTitle: '',
                      itemDetails: '',
                      price: '',
                      subPrice: '',
                      link: '',
                      comming: false
                    }])
                  });
                }
              },
              wp.element.createElement("span", { className: "dashicons dashicons-plus" }),
              " Add New Item"
            ),
            wp.element.createElement(
              "button",
              {
                className: "components-button add coming-btn",
                onClick: function onClick(content) {
                  setAttributes({
                    dataArray: [].concat(_toConsumableArray(dataArray), [{
                      index: dataArray.length,
                      itemTitle: '',
                      itemDetails: '',
                      price: 'Registration Coming Soon!',
                      subPrice: '',
                      link: '',
                      comming: true
                    }])
                  });
                }
              },
              wp.element.createElement("span", { className: "dashicons dashicons-plus" }),
              " Add Comming Soon"
            )
          )
        );
      }
    }]);

    return ItemComponent;
  }(Component);

  registerBlockType('nab/registration-passes', {
    title: __('Registration Passes'),
    description: __('registration-passes'),
    icon: { src: registrationPassesAwardBlockIcon },
    category: 'nabshow',
    keywords: [__('registration-passes'), __('gutenberg'), __('nab')],
    attributes: {
      dataArray: {
        type: 'array',
        default: []
      },
      title: {
        type: 'string'
      },
      details: {
        type: 'string'
      }
    },
    edit: ItemComponent,

    save: function save(props) {
      var attributes = props.attributes,
          className = props.className;
      var dataArray = attributes.dataArray,
          title = attributes.title,
          details = attributes.details;


      return wp.element.createElement(
        "div",
        { className: "registration-passes" },
        wp.element.createElement(
          "div",
          { className: "registration-head" },
          wp.element.createElement(RichText.Content, {
            tagName: "h2",
            value: title,
            className: "title"
          }),
          wp.element.createElement(RichText.Content, {
            tagName: "p",
            value: details,
            className: "description"
          })
        ),
        dataArray.map(function (product, index) {
          return wp.element.createElement(
            Fragment,
            null,
            product.itemTitle && wp.element.createElement(
              "div",
              { className: "registration-item " + (product.comming ? 'comming-soon' : '') },
              wp.element.createElement(
                "div",
                { className: "plus-sec" },
                product.link && wp.element.createElement(
                  "a",
                  { href: product.link, target: "_blank", rel: "noopener noreferrer" },
                  "+"
                )
              ),
              wp.element.createElement(
                "div",
                { className: "middle-sec" },
                wp.element.createElement(RichText.Content, {
                  tagName: "h3",
                  value: product.itemTitle,
                  className: "item-title"
                }),
                wp.element.createElement(RichText.Content, {
                  tagName: "p",
                  value: product.itemDetails,
                  className: "item-description"
                })
              ),
              wp.element.createElement(
                "div",
                { className: "last-sec" },
                product.price && wp.element.createElement(RichText.Content, {
                  tagName: "p",
                  value: product.price,
                  className: "price"
                }),
                product.subPrice && wp.element.createElement(RichText.Content, {
                  tagName: "span",
                  value: product.subPrice,
                  className: "sub-price"
                })
              )
            )
          );
        })
      );
    }
  });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);

/***/ }),
/* 39 */
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
      MediaUpload = wpEditor.MediaUpload;
  var Button = wpComponents.Button,
      TextControl = wpComponents.TextControl;


  var officialVendorBlockIcon = wp.element.createElement(
    "svg",
    { width: "150px", height: "150px", viewBox: "181 181 150 150", "enable-background": "new 181 181 150 150" },
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M249.032,288.517c0-14.086-11.461-25.548-25.548-25.548c-14.087,0-25.548,11.462-25.548,25.548 c0,14.087,11.461,25.548,25.548,25.548C237.57,314.064,249.032,302.603,249.032,288.517z M223.484,309.42 c-11.525,0-20.903-9.376-20.903-20.903s9.378-20.903,20.903-20.903c11.524,0,20.903,9.376,20.903,20.903 S235.008,309.42,223.484,309.42z" }),
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M223.484,281.549c1.28,0,2.322,1.041,2.322,2.322h4.645c0-3.023-1.948-5.578-4.645-6.54v-5.072h-4.645v4.646 h-4.645v6.967c0,3.842,3.126,6.968,6.968,6.968c1.28,0,2.322,1.041,2.322,2.323v2.322h-2.322c-1.28,0-2.323-1.04-2.323-2.322h-4.645 c0,3.023,1.948,5.579,4.645,6.54v5.072h4.645v-4.645h4.645v-6.968c0-3.842-3.126-6.968-6.967-6.968c-1.28,0-2.323-1.041-2.323-2.323 v-2.322H223.484z" }),
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M207.226,286.194h4.645v4.645h-4.645V286.194z" }),
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M235.097,286.194h4.645v4.645h-4.645V286.194z" }),
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M323.354,281.549c0-14.397-9.414-26.621-22.404-30.885c5.089-3.317,8.469-9.051,8.469-15.566 c0-10.245-8.336-18.581-18.581-18.581c-10.244,0-18.58,8.335-18.58,18.581c0,6.513,3.374,12.242,8.459,15.562 c-4.797,1.565-9.2,4.227-12.872,7.898c-5.389,5.389-8.649,12.335-9.369,19.821l-1.879-0.627c-0.567-1.754-1.264-3.442-2.081-5.05 l2.998-5.994L256,265.193v-16.16c0-14.398-9.413-26.621-22.403-30.886c5.089-3.317,8.468-9.051,8.468-15.566 c0-10.245-8.336-18.581-18.581-18.581c-10.245,0-18.581,8.336-18.581,18.581c0,6.515,3.379,12.249,8.468,15.566 c-12.99,4.264-22.403,16.488-22.403,30.886v16.16l-1.514,1.515l2.998,5.994c-0.817,1.605-1.515,3.296-2.081,5.05L184,279.874v17.282 l6.371,2.123c0.566,1.754,1.264,3.442,2.081,5.05l-2.998,5.996l12.221,12.222l5.994-2.996c1.605,0.817,3.296,1.513,5.05,2.081 l2.123,6.369h8.643h8.642h91.228v-32.517c2.563,0,4.646-2.083,4.646-4.646v-4.645C327.999,283.633,325.916,281.549,323.354,281.549 L323.354,281.549z M318.709,281.549h-6.968v-9.29h-4.646v9.29H294.84l12.714-22.25C314.313,264.39,318.709,272.456,318.709,281.549z M290.838,253.678c1.87,0,3.695,0.193,5.463,0.543l-5.463,5.463l-5.472-5.473C287.15,253.859,288.98,253.678,290.838,253.678z M297.485,267.558l-3.535-4.418l7.393-7.393c0.781,0.319,1.54,0.676,2.283,1.063L297.485,267.558z M287.726,263.141l-3.535,4.417 l-6.152-10.767c0.746-0.386,1.503-0.746,2.279-1.062L287.726,263.141z M290.838,266.687l4.167,5.21l-4.167,7.295l-4.167-7.295 L290.838,266.687z M276.902,235.098c0-7.686,6.25-13.936,13.936-13.936s13.936,6.25,13.936,13.936s-6.25,13.936-13.936,13.936 C283.153,249.033,276.902,242.783,276.902,235.098z M271.129,261.842c0.937-0.936,1.946-1.77,2.987-2.555l12.72,22.262H274.58v-9.29 h-4.645v9.29h-6.968C262.968,274.104,265.866,267.104,271.129,261.842z M251.354,249.033v11.515l-6.062-6.064l-0.906,0.456v-15.197 h-4.645v17.52l-0.443,0.223c-1.605-0.817-3.296-1.512-5.049-2.082l-2.123-6.371h-4.64l12.714-22.25 C246.958,231.874,251.354,239.94,251.354,249.033L251.354,249.033z M210.696,224.295c2.222-1.154,4.608-2.032,7.128-2.555 l-2.03,11.478L210.696,224.295z M222.638,221.204c0.283-0.007,0.56-0.042,0.846-0.042c0.285,0,0.562,0.035,0.845,0.042l3.24,18.318 l-4.085,7.153l-4.085-7.151L222.638,221.204z M231.171,233.219l-2.03-11.478c2.52,0.522,4.905,1.4,7.128,2.555L231.171,233.219z M209.548,202.582c0-7.686,6.25-13.936,13.936-13.936c7.685,0,13.935,6.25,13.935,13.936s-6.25,13.936-13.935,13.936 C215.798,216.517,209.548,210.267,209.548,202.582z M195.613,249.033c0-9.093,4.396-17.159,11.155-22.25l12.714,22.25h-4.641 l-2.125,6.371c-1.754,0.567-3.442,1.263-5.05,2.081l-0.441-0.223v-17.519h-4.645v15.197l-0.906-0.453l-6.062,6.062V249.033z M223.484,323.355h-5.293l-1.833-5.493l-1.178-0.339c-2.248-0.642-4.385-1.521-6.35-2.617l-1.07-0.598l-5.17,2.583l-7.486-7.485 l2.583-5.171l-0.597-1.07c-1.094-1.967-1.977-4.104-2.618-6.348l-0.336-1.18l-5.49-1.828v-10.589l5.493-1.83l0.336-1.18 c0.641-2.246,1.524-4.383,2.618-6.348l0.597-1.07l-2.583-5.17l7.486-7.488l5.167,2.585l1.071-0.597 c1.965-1.096,4.102-1.977,6.35-2.618l1.178-0.339l1.832-5.488h10.589l1.833,5.493l1.178,0.339c2.248,0.642,4.385,1.521,6.35,2.618 l1.071,0.597l5.168-2.585l7.485,7.488l-2.583,5.17l0.597,1.071c1.094,1.967,1.977,4.104,2.618,6.348l0.336,1.18l5.49,1.827v0.647 v9.938l-5.493,1.83l-0.337,1.18c-0.641,2.246-1.524,4.383-2.618,6.348l-0.597,1.071l2.583,5.17l-7.485,7.485l-5.17-2.583 l-1.071,0.598c-1.965,1.096-4.102,1.977-6.35,2.617l-1.177,0.34l-1.83,5.49H223.484z M318.709,323.355h-85.034l0.576-1.726 c1.753-0.566,3.444-1.264,5.049-2.081l5.995,2.996l12.222-12.222l-2.999-5.994c0.817-1.604,1.514-3.296,2.081-5.05l6.369-2.12 v-1.675h55.741V323.355z M323.354,290.839h-60.387v-4.645h60.387V290.839z" }),
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M309.419,314.064h4.645v4.646h-4.645V314.064z" }),
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M300.129,314.064h4.645v4.646h-4.645V314.064z" }),
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M290.838,314.064h4.646v4.646h-4.646V314.064z" })
  );

  var EditOfficialVendor = function (_Component) {
    _inherits(EditOfficialVendor, _Component);

    function EditOfficialVendor() {
      _classCallCheck(this, EditOfficialVendor);

      return _possibleConstructorReturn(this, (EditOfficialVendor.__proto__ || Object.getPrototypeOf(EditOfficialVendor)).apply(this, arguments));
    }

    _createClass(EditOfficialVendor, [{
      key: "componentDidMount",
      value: function componentDidMount() {
        var products = this.props.attributes.products;

        if (0 === products.length) {
          this.initList();
        }
      }
    }, {
      key: "initList",
      value: function initList() {
        var products = this.props.attributes.products;
        var setAttributes = this.props.setAttributes;

        setAttributes({
          products: [].concat(_toConsumableArray(products), [{
            index: products.length,
            media: '',
            mediaAlt: '',
            title: '',
            companyName: '',
            type: '',
            description: '',
            email: ''
          }])
        });
      }
    }, {
      key: "render",
      value: function render() {
        var _props = this.props,
            attributes = _props.attributes,
            setAttributes = _props.setAttributes,
            clientId = _props.clientId,
            className = _props.className;
        var products = attributes.products;


        var getImageButton = function getImageButton(openEvent, index) {
          if (products[index].media) {
            return wp.element.createElement("img", { src: products[index].media, alt: products[index].alt, className: "img" });
          } else {
            return wp.element.createElement(
              Button,
              { onClick: openEvent, className: "button button-large" },
              wp.element.createElement("span", { className: "dashicons dashicons-upload" }),
              " Upload Logo"
            );
          }
        };

        var productsList = products.sort(function (a, b) {
          return a.index - b.index;
        }).map(function (product, index) {
          return wp.element.createElement(
            "div",
            { className: "box-item" },
            wp.element.createElement(
              "div",
              { className: "box-inner" },
              wp.element.createElement(
                "span",
                {
                  className: "remove",
                  onClick: function onClick() {
                    var qewQusote = products.filter(function (item) {
                      return item.index != product.index;
                    }).map(function (t) {
                      if (t.index > product.index) {
                        t.index -= 1;
                      }
                      return t;
                    });

                    setAttributes({
                      products: qewQusote
                    });
                  }
                },
                wp.element.createElement("span", { className: "dashicons dashicons-no-alt" })
              ),
              wp.element.createElement(
                "div",
                { className: "media-img" },
                wp.element.createElement(MediaUpload, {
                  onSelect: function onSelect(media) {
                    var newObject = Object.assign({}, product, {
                      media: media.url,
                      mediaAlt: media.alt
                    });
                    setAttributes({
                      products: [].concat(_toConsumableArray(products.filter(function (item) {
                        return item.index != product.index;
                      })), [newObject])
                    });
                  },
                  type: "image",
                  value: attributes.imageID,
                  render: function render(_ref) {
                    var open = _ref.open;
                    return wp.element.createElement("span", { onClick: open, className: "dashicons dashicons-edit" });
                  }
                }),
                wp.element.createElement(MediaUpload, {
                  onSelect: function onSelect(media) {
                    var newObject = Object.assign({}, product, {
                      media: media.url,
                      mediaAlt: media.alt
                    });
                    setAttributes({
                      products: [].concat(_toConsumableArray(products.filter(function (item) {
                        return item.index != product.index;
                      })), [newObject])
                    });
                  },
                  type: "image",
                  value: attributes.imageID,
                  render: function render(_ref2) {
                    var open = _ref2.open;
                    return getImageButton(open, index);
                  }
                })
              ),
              wp.element.createElement(RichText, {
                tagName: "h3",
                placeholder: __('title'),
                value: product.title,
                className: "title",
                onChange: function onChange(title) {
                  var newObject = Object.assign({}, product, {
                    title: title
                  });
                  setAttributes({
                    products: [].concat(_toConsumableArray(products.filter(function (item) {
                      return item.index != product.index;
                    })), [newObject])
                  });
                }
              }),
              wp.element.createElement(RichText, {
                tagName: "p",
                className: "companyName",
                placeholder: __('Company Name'),
                value: product.companyName,
                onChange: function onChange(companyName) {
                  var newObject = Object.assign({}, product, {
                    companyName: companyName
                  });
                  setAttributes({
                    products: [].concat(_toConsumableArray(products.filter(function (item) {
                      return item.index != product.index;
                    })), [newObject])
                  });
                }
              }),
              wp.element.createElement(RichText, {
                tagName: "p",
                className: "type",
                placeholder: __('Type: Exclusive OR Preferred'),
                value: product.type,
                onChange: function onChange(type) {
                  var newObject = Object.assign({}, product, {
                    type: type
                  });
                  setAttributes({
                    products: [].concat(_toConsumableArray(products.filter(function (item) {
                      return item.index != product.index;
                    })), [newObject])
                  });
                }
              }),
              wp.element.createElement(RichText, {
                tagName: "p",
                className: "description",
                placeholder: __('Description'),
                value: product.description,
                onChange: function onChange(description) {
                  var newObject = Object.assign({}, product, {
                    description: description
                  });
                  setAttributes({
                    products: [].concat(_toConsumableArray(products.filter(function (item) {
                      return item.index != product.index;
                    })), [newObject])
                  });
                }
              }),
              wp.element.createElement(TextControl, {
                type: "text",
                className: "email",
                value: product.email,
                placeholder: "Email",
                onChange: function onChange(email) {
                  var newObject = Object.assign({}, product, {
                    email: email
                  });
                  setAttributes({
                    products: [].concat(_toConsumableArray(products.filter(function (item) {
                      return item.index != product.index;
                    })), [newObject])
                  });
                }
              })
            )
          );
        });

        return wp.element.createElement(
          "div",
          { className: "new-this-year official-vendors" },
          wp.element.createElement(
            "div",
            { className: "box-main" },
            productsList,
            wp.element.createElement(
              "div",
              { className: "box-item additem" },
              wp.element.createElement(
                "button",
                {
                  className: "components-button add",
                  onClick: function onClick(content) {
                    setAttributes({
                      products: [].concat(_toConsumableArray(products), [{
                        index: products.length,
                        media: '',
                        mediaAlt: '',
                        title: '',
                        companyName: '',
                        type: '',
                        description: '',
                        email: ''
                      }])
                    });
                  }
                },
                wp.element.createElement("span", { className: "dashicons dashicons-plus" }),
                " Add New Item"
              )
            )
          )
        );
      }
    }]);

    return EditOfficialVendor;
  }(Component);

  registerBlockType('nab/nab-official-vendors', {
    title: __('Official Vendors'),
    description: __('Official Vendors'),
    icon: { src: officialVendorBlockIcon },
    category: 'nabshow',
    keywords: [__('Official Vendors'), __('gutenberg'), __('nab')],
    attributes: {
      products: {
        type: 'array',
        default: []
      }
    },
    edit: EditOfficialVendor,

    save: function save(props) {
      var attributes = props.attributes,
          className = props.className;
      var products = attributes.products;


      return wp.element.createElement(
        "div",
        { className: "new-this-year official-vendors" },
        wp.element.createElement(
          "div",
          { className: "box-main" },
          products.map(function (product, index) {
            return wp.element.createElement(
              Fragment,
              null,
              product.title && wp.element.createElement(
                "div",
                { className: "box-item" },
                wp.element.createElement(
                  "div",
                  { className: "box-inner" },
                  wp.element.createElement(
                    "div",
                    { className: "media-img" },
                    product.media ? wp.element.createElement("img", { src: product.media, alt: product.alt, className: "img" }) : wp.element.createElement(
                      "div",
                      { className: "no-image" },
                      "No Logo"
                    )
                  ),
                  product.title && wp.element.createElement(RichText.Content, {
                    tagName: "h3",
                    value: product.title,
                    className: "title"
                  }),
                  product.companyName && wp.element.createElement(RichText.Content, {
                    tagName: "p",
                    className: "companyName",
                    value: product.companyName
                  }),
                  product.type && wp.element.createElement(RichText.Content, {
                    tagName: "p",
                    className: "type",
                    value: product.type
                  }),
                  product.description && wp.element.createElement(RichText.Content, {
                    tagName: "p",
                    className: "description",
                    value: product.description
                  }),
                  product.email && wp.element.createElement(
                    "a",
                    { className: "email", href: "mailto:" + product.email },
                    "Email us"
                  )

                  // <RichText.Content
                  //   tagName="a"
                  //   className="email"
                  //   value={product.email}
                  // />

                )
              )
            );
          })
        )
      );
    }
  });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);

/***/ }),
/* 40 */
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
  var RichText = wpEditor.RichText;
  var TextControl = wpComponents.TextControl;


  var newsConfBlockIcon = wp.element.createElement(
    "svg",
    { width: "150px", height: "150px", viewBox: "222.64 222.641 150 150", "enable-background": "new 222.64 222.641 150 150" },
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M351.121,345.459l-5.65-2.26v-1.935c2.787-2.071,4.475-5.354,4.475-8.829v-5.69 c0-2.357-0.92-4.572-2.59-6.236c-1.663-1.656-3.867-2.567-6.213-2.567c-0.011,0-0.022,0-0.033,0l-4.474,0.017 c-3.212,0.012-6.024,1.758-7.553,4.346l-3.744-1.497v-1.935c2.786-2.071,4.474-5.353,4.474-8.829v-5.69 c0-2.357-0.919-4.572-2.589-6.236c-1.663-1.656-3.868-2.567-6.214-2.567c-0.011,0-0.021,0-0.032,0l-4.474,0.016 c-4.837,0.018-8.771,3.967-8.771,8.804v5.674c0,3.477,1.687,6.758,4.474,8.829v1.935l-3.729,1.491 c-0.379-0.645-0.842-1.246-1.387-1.788c-1.662-1.656-3.867-2.567-6.212-2.567c-0.011,0-0.022,0-0.033,0l-4.474,0.017 c-3.211,0.012-6.024,1.758-7.552,4.346l-3.744-1.497v-1.935c2.786-2.071,4.474-5.354,4.474-8.829v-5.69 c0-2.357-0.919-4.572-2.589-6.236c-1.663-1.656-3.867-2.567-6.213-2.567c-0.011,0-0.021,0-0.033,0l-4.474,0.016 c-4.836,0.017-8.771,3.967-8.771,8.803v5.675c0,3.477,1.687,6.758,4.473,8.829v1.935l-3.728,1.491 c-0.379-0.646-0.842-1.246-1.386-1.789c-1.662-1.656-3.867-2.567-6.212-2.567c-0.011,0-0.022,0-0.033,0l-4.474,0.017 c-4.837,0.018-8.772,3.967-8.772,8.804v5.674c0,3.477,1.688,6.758,4.474,8.829v1.935l-5.65,2.26 c-3.361,1.345-5.534,4.553-5.534,8.174v13.351c0,1.156,0.937,2.094,2.093,2.094s2.093-0.938,2.093-2.094v-13.352 c0-1.898,1.14-3.582,2.903-4.287l6.592-2.637h8.141l6.592,2.637c1.763,0.705,2.902,2.389,2.902,4.287v13.352 c0,1.156,0.938,2.094,2.093,2.094s2.093-0.938,2.093-2.094v-13.351c0-3.621-2.172-6.83-5.534-8.174l-5.65-2.261v-1.935 c2.786-2.071,4.474-5.353,4.474-8.829v-5.69c0-0.14-0.004-0.278-0.01-0.417l5.031-2.012h8.142l5.032,2.013 c-0.007,0.144-0.011,0.287-0.011,0.433v5.675c0,3.476,1.687,6.757,4.474,8.829v1.934l-5.65,2.261 c-3.361,1.344-5.534,4.553-5.534,8.174v13.351c0,1.156,0.937,2.093,2.093,2.093c1.156,0,2.093-0.937,2.093-2.093v-13.352 c0-1.899,1.139-3.582,2.903-4.287l6.591-2.637h8.142l6.592,2.637c1.764,0.705,2.902,2.388,2.902,4.287v13.352 c0,1.156,0.938,2.093,2.093,2.093c1.156,0,2.093-0.937,2.093-2.093v-13.352c0-3.621-2.172-6.829-5.533-8.174l-5.65-2.26v-1.935 c2.786-2.071,4.474-5.353,4.474-8.829v-5.69c0-0.139-0.004-0.278-0.011-0.417l5.031-2.012h8.142l5.031,2.012 c-0.007,0.144-0.011,0.288-0.011,0.434v5.674c0,3.477,1.688,6.758,4.474,8.829v1.935l-5.65,2.26 c-3.361,1.345-5.533,4.553-5.533,8.174v13.352c0,1.156,0.937,2.094,2.093,2.094c1.155,0,2.093-0.938,2.093-2.094v-13.352 c0-1.899,1.139-3.582,2.902-4.287l6.592-2.637h8.142l6.592,2.637c1.764,0.705,2.902,2.388,2.902,4.287v13.352 c0,1.156,0.938,2.094,2.093,2.094c1.156,0,2.094-0.938,2.094-2.094v-13.351C356.655,350.012,354.483,346.804,351.121,345.459z M265.233,332.436c0,2.441-1.284,4.646-3.434,5.897c-0.644,0.375-1.04,1.063-1.04,1.809v2.381h-4.762v-2.381 c0-0.745-0.396-1.435-1.04-1.809c-2.15-1.251-3.434-3.456-3.434-5.897v-5.675c0-2.537,2.064-4.608,4.601-4.617l4.474-0.017 c1.237,0.006,2.4,0.475,3.276,1.347c0.875,0.873,1.358,2.034,1.358,3.271L265.233,332.436L265.233,332.436z M281.932,315.94 c-0.645,0.375-1.041,1.063-1.041,1.809v2.381h-4.762v-2.381c0-0.745-0.396-1.435-1.04-1.809c-2.15-1.252-3.434-3.456-3.434-5.897 v-5.675c0-2.537,2.064-4.608,4.601-4.617l4.474-0.017c0.006,0,0.011,0,0.017,0c1.23,0,2.387,0.479,3.259,1.347 c0.876,0.873,1.358,2.035,1.358,3.271v5.69C285.365,312.484,284.082,314.689,281.932,315.94z M302.063,338.333 c-0.645,0.375-1.04,1.063-1.04,1.809v2.381h-4.762v-2.381c0-0.745-0.396-1.435-1.04-1.809c-2.15-1.251-3.434-3.456-3.434-5.897 v-5.675c0-2.537,2.064-4.608,4.601-4.617l4.474-0.017c0.006,0,0.012,0,0.018,0c1.229,0,2.387,0.479,3.258,1.347 c0.876,0.873,1.359,2.034,1.359,3.271v5.69l0,0C305.496,334.877,304.213,337.082,302.063,338.333z M322.194,315.94 c-0.645,0.375-1.04,1.063-1.04,1.809v2.381h-4.762v-2.381c0-0.745-0.396-1.435-1.041-1.809c-2.149-1.252-3.433-3.456-3.433-5.897 v-5.675c0-2.537,2.064-4.608,4.601-4.617l4.474-0.017c0.006,0,0.012,0,0.018,0c1.229,0,2.387,0.479,3.259,1.347 c0.876,0.873,1.358,2.035,1.358,3.271v5.69C325.628,312.484,324.345,314.689,322.194,315.94z M342.326,338.333 c-0.645,0.375-1.04,1.063-1.04,1.809v2.381h-4.762v-2.381c0-0.745-0.396-1.435-1.04-1.809c-2.15-1.251-3.435-3.456-3.435-5.897 v-5.675c0-2.537,2.064-4.608,4.602-4.617l4.474-0.017c1.244,0.006,2.4,0.475,3.276,1.347c0.876,0.873,1.358,2.034,1.358,3.271 v5.69C345.76,334.877,344.477,337.082,342.326,338.333z" })
      )
    ),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M322.79,265.226c-0.382-0.617-1.055-0.993-1.78-0.993h-6.854v-4.089c0-2.503-1.391-4.754-3.63-5.874 l-5.238-2.619c-0.049-0.025-0.079-0.074-0.079-0.129v-3.092c0-0.025-0.003-0.05-0.004-0.076c2.714-2.013,4.478-5.24,4.478-8.872 v-4.474c0-4.854-3.949-8.804-8.804-8.804h-4.474c-4.854,0-8.803,3.949-8.803,8.804v4.474c0,3.631,1.763,6.858,4.478,8.872 c-0.001,0.025-0.004,0.05-0.004,0.076v3.091c0,0.055-0.031,0.104-0.08,0.129l-5.238,2.619c-2.239,1.119-3.63,3.37-3.63,5.873v4.09 h-6.854c-0.725,0-1.399,0.375-1.781,0.993c-0.381,0.617-0.416,1.387-0.091,2.036l4.473,8.947c0.355,0.709,1.079,1.157,1.872,1.157 h2.381v13.565c0,1.156,0.937,2.093,2.093,2.093c1.156,0,2.093-0.937,2.093-2.093v-13.565h22.656v13.565 c0,1.156,0.938,2.093,2.094,2.093c1.155,0,2.093-0.937,2.093-2.093v-13.565h2.381c0.792,0,1.518-0.448,1.871-1.157l4.474-8.947 C323.206,266.613,323.172,265.843,322.79,265.226z M291.787,239.483v-4.474c0-2.546,2.071-4.618,4.618-4.618h4.473 c2.547,0,4.618,2.071,4.618,4.618v4.474c0,3.779-3.075,6.854-6.854,6.854C294.862,246.338,291.787,243.263,291.787,239.483z M301.604,253.693l-2.86,2.861c-0.057,0.056-0.147,0.056-0.203,0l-2.861-2.861c0.374-0.646,0.582-1.389,0.582-2.171v-1.26 c0.768,0.17,1.564,0.262,2.381,0.262s1.613-0.092,2.381-0.261v1.26C301.022,252.304,301.23,253.047,301.604,253.693z M287.313,260.143L287.313,260.143c0-0.908,0.504-1.724,1.316-2.129l3.634-1.817l3.317,3.316c0.844,0.844,1.953,1.266,3.062,1.266 c1.108,0,2.217-0.422,3.062-1.266l3.316-3.316l3.634,1.817c0.812,0.406,1.316,1.222,1.316,2.129v4.09h-22.657V260.143 L287.313,260.143z M315.243,273.18H282.04l-2.381-4.761h37.965L315.243,273.18z" })
      )
    ),
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement(
        "g",
        null,
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M303.115,282.127h-8.947c-1.156,0-2.093,0.937-2.093,2.093c0,1.156,0.937,2.093,2.093,2.093h8.947 c1.155,0,2.093-0.937,2.093-2.093C305.208,283.064,304.271,282.127,303.115,282.127z" })
      )
    )
  );

  var BlockComponent = function (_Component) {
    _inherits(BlockComponent, _Component);

    function BlockComponent() {
      _classCallCheck(this, BlockComponent);

      return _possibleConstructorReturn(this, (BlockComponent.__proto__ || Object.getPrototypeOf(BlockComponent)).apply(this, arguments));
    }

    _createClass(BlockComponent, [{
      key: "componentDidMount",
      value: function componentDidMount() {
        var dataArry = this.props.attributes.dataArry;

        if (0 === dataArry.length) {
          this.initList();
        }
      }
    }, {
      key: "initList",
      value: function initList() {
        var dataArry = this.props.attributes.dataArry;
        var setAttributes = this.props.setAttributes;

        setAttributes({
          dataArry: [].concat(_toConsumableArray(dataArry), [{
            index: dataArry.length,
            title: '',
            date: '',
            location: '',
            description: '',
            arrayContact: [{
              contact: '',
              phone: '',
              email: ''
            }]
          }])
        });
      }
    }, {
      key: "render",
      value: function render() {
        var _props = this.props,
            attributes = _props.attributes,
            setAttributes = _props.setAttributes,
            clientId = _props.clientId,
            className = _props.className;
        var dataArry = attributes.dataArry;


        var dataArryList = dataArry.sort(function (a, b) {
          return a.index - b.index;
        }).map(function (product, index) {
          return wp.element.createElement(
            "div",
            { className: "box-item" },
            wp.element.createElement(
              "div",
              { className: "box-inner" },
              wp.element.createElement(
                "span",
                {
                  className: "remove",
                  onClick: function onClick() {
                    var qewQusote = dataArry.filter(function (item) {
                      return item.index != product.index;
                    }).map(function (t) {
                      if (t.index > product.index) {
                        t.index -= 1;
                      }
                      return t;
                    });

                    setAttributes({
                      dataArry: qewQusote
                    });
                  }
                },
                wp.element.createElement("span", { className: "dashicons dashicons-no-alt" })
              ),
              wp.element.createElement(RichText, {
                tagName: "h3",
                placeholder: __('Title'),
                value: product.title,
                className: "title",
                onChange: function onChange(title) {
                  var newObject = Object.assign({}, product, {
                    title: title
                  });
                  setAttributes({
                    dataArry: [].concat(_toConsumableArray(dataArry.filter(function (item) {
                      return item.index != product.index;
                    })), [newObject])
                  });
                }
              }),
              wp.element.createElement(RichText, {
                tagName: "strong",
                placeholder: __('Date | Time'),
                value: product.date,
                className: "date-time",
                onChange: function onChange(date) {
                  var newObject = Object.assign({}, product, {
                    date: date
                  });
                  setAttributes({
                    dataArry: [].concat(_toConsumableArray(dataArry.filter(function (item) {
                      return item.index != product.index;
                    })), [newObject])
                  });
                }
              }),
              wp.element.createElement(RichText, {
                tagName: "strong",
                placeholder: __('Location'),
                value: product.location,
                className: "location",
                onChange: function onChange(location) {
                  var newObject = Object.assign({}, product, {
                    location: location
                  });
                  setAttributes({
                    dataArry: [].concat(_toConsumableArray(dataArry.filter(function (item) {
                      return item.index != product.index;
                    })), [newObject])
                  });
                }
              }),
              wp.element.createElement(RichText, {
                tagName: "p",
                className: "description",
                placeholder: __('Details'),
                value: product.description,
                onChange: function onChange(description) {
                  var newObject = Object.assign({}, product, {
                    description: description
                  });
                  setAttributes({
                    dataArry: [].concat(_toConsumableArray(dataArry.filter(function (item) {
                      return item.index != product.index;
                    })), [newObject])
                  });
                }
              }),
              product.arrayContact.map(function (data, i) {
                return wp.element.createElement(
                  "div",
                  { className: "contact-item" },
                  wp.element.createElement(
                    "span",
                    {
                      onClick: function onClick() {
                        var tempProdcut = [].concat(_toConsumableArray(dataArry));
                        var newObject = tempProdcut[index].arrayContact.splice(i, 1);
                        setAttributes({ dataArry: tempProdcut });
                      }
                    },
                    wp.element.createElement("span", { className: "dashicons dashicons-no-alt" })
                  ),
                  wp.element.createElement(RichText, {
                    tagName: "p",
                    className: "contact-name",
                    placeholder: __('Contact: Name'),
                    value: data.contact,
                    onChange: function onChange(value) {
                      var tempProdcut = [].concat(_toConsumableArray(dataArry));
                      tempProdcut[index].arrayContact[i].contact = value;
                      setAttributes({ dataArry: tempProdcut });
                    }
                  }),
                  wp.element.createElement(RichText, {
                    tagName: "p",
                    className: "phone",
                    placeholder: __('Phone'),
                    value: data.phone,
                    onChange: function onChange(value) {
                      var tempProdcut = [].concat(_toConsumableArray(dataArry));
                      tempProdcut[index].arrayContact[i].phone = value;
                      setAttributes({ dataArry: tempProdcut });
                    }
                  }),
                  wp.element.createElement(TextControl, {
                    type: "text",
                    className: "email",
                    placeholder: __('Email'),
                    value: data.email,
                    onChange: function onChange(value) {
                      var tempProdcut = [].concat(_toConsumableArray(dataArry));
                      tempProdcut[index].arrayContact[i].email = value;
                      setAttributes({ dataArry: tempProdcut });
                    }
                  })
                );
              }),
              wp.element.createElement(
                "div",
                { className: "new-contact" },
                wp.element.createElement(
                  "button",
                  {
                    className: "components-button add",
                    onClick: function onClick() {
                      var tempProdcut = [].concat(_toConsumableArray(dataArry));
                      var newObject = tempProdcut[index].arrayContact.push({
                        contact: '',
                        phone: '',
                        email: ''
                      });
                      setAttributes({ dataArry: tempProdcut });
                    }
                  },
                  wp.element.createElement("span", { className: "dashicons dashicons-plus" }),
                  " Add New Contact"
                )
              )
            )
          );
        });

        return wp.element.createElement(
          "div",
          { className: "news-conference-schedule" },
          wp.element.createElement(
            "div",
            { className: "box-main four-grid" },
            dataArryList,
            wp.element.createElement(
              "div",
              { className: "box-item additem" },
              wp.element.createElement(
                "button",
                {
                  className: "components-button add",
                  onClick: function onClick(content) {
                    setAttributes({
                      dataArry: [].concat(_toConsumableArray(dataArry), [{
                        index: dataArry.length,
                        title: '',
                        date: '',
                        location: '',
                        description: '',
                        arrayContact: [{
                          contact: '',
                          phone: '',
                          email: ''
                        }]
                      }])
                    });
                  }
                },
                wp.element.createElement("span", { className: "dashicons dashicons-plus" }),
                " Add New Item"
              )
            )
          )
        );
      }
    }]);

    return BlockComponent;
  }(Component);

  registerBlockType('nab/news-conference-schedule', {
    title: __('News Conference Schedule'),
    description: __('News Conference Schedule'),
    icon: { src: newsConfBlockIcon },
    category: 'nabshow',
    keywords: [__('News Conference Schedule'), __('gutenberg'), __('nab')],
    attributes: {
      dataArry: {
        type: 'array',
        default: []
      }
    },
    edit: BlockComponent,

    save: function save(props) {
      var attributes = props.attributes,
          className = props.className;
      var dataArry = attributes.dataArry;


      return wp.element.createElement(
        "div",
        { className: "news-conference-schedule" },
        wp.element.createElement(
          "div",
          { className: "box-main four-grid" },
          dataArry.map(function (product, index) {
            return wp.element.createElement(
              Fragment,
              null,
              product.title && wp.element.createElement(
                "div",
                { className: "box-item" },
                wp.element.createElement(
                  "div",
                  { className: "box-inner" },
                  wp.element.createElement(RichText.Content, {
                    tagName: "h3",
                    value: product.title,
                    className: "title"
                  }),
                  product.date && wp.element.createElement(RichText.Content, {
                    tagName: "strong",
                    value: product.date,
                    className: "date-time"
                  }),
                  product.location && wp.element.createElement(RichText.Content, {
                    tagName: "strong",
                    value: product.location,
                    className: "location"
                  }),
                  product.description && wp.element.createElement(RichText.Content, {
                    tagName: "p",
                    className: "description",
                    value: product.description
                  }),
                  product.arrayContact.map(function (data, i) {
                    return wp.element.createElement(
                      "div",
                      { className: "contact-item" },
                      data.contact && wp.element.createElement(RichText.Content, {
                        tagName: "p",
                        className: "contact-name",
                        value: data.contact
                      }),
                      data.phone && wp.element.createElement(RichText.Content, {
                        tagName: "p",
                        className: "phone",
                        value: data.phone
                      }),
                      data.email && wp.element.createElement(
                        "a",
                        { className: "email", href: "mailto:" + data.email },
                        "Email"
                      )
                    );
                  })
                )
              )
            );
          })
        )
      );
    }
  });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);

/***/ }),
/* 41 */
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
      MediaUpload = wpEditor.MediaUpload;
  var Button = wpComponents.Button,
      CheckboxControl = wpComponents.CheckboxControl;


  var opportunityBlockIcon = wp.element.createElement(
    "svg",
    { width: "150px", height: "150px", viewBox: "181 181 150 150", "enable-background": "new 181 181 150 150" },
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M266.264,288.3c5.165-3.367,8.594-9.188,8.594-15.799c0-10.398-8.459-18.858-18.857-18.858 c-10.398,0-18.858,8.459-18.858,18.858c0,6.611,3.43,12.432,8.595,15.799c-13.185,4.327-22.739,16.733-22.739,31.346v9.43h66.003 v-9.43C289.001,305.033,279.447,292.627,266.264,288.3z M269.168,314.932l-9.43,9.43h-0.476l9.831-29.766 c1.688,0.886,3.279,1.928,4.746,3.124l-1.127,6.383l-8.625,5.749L269.168,314.932z M239.29,304.101l-1.127-6.384 c1.466-1.196,3.057-2.237,4.745-3.123l9.833,29.768h-0.476l-9.429-9.43l5.082-5.08L239.29,304.101z M241.856,272.501 c0-7.801,6.343-14.144,14.144-14.144c7.8,0,14.144,6.343,14.144,14.144c0,7.8-6.344,14.144-14.144,14.144 C248.2,286.645,241.856,280.301,241.856,272.501z M264.736,292.755L256,319.2l-8.734-26.445c2.753-0.896,5.686-1.396,8.734-1.396 C259.051,291.358,261.98,291.858,264.736,292.755L264.736,292.755z M227.713,319.646c0-6.77,2.397-12.988,6.378-17.862l0.903,5.122 l5.519,3.68l-4.347,4.347l9.429,9.43h-17.882V319.646z M284.287,324.361h-17.882l9.43-9.43l-4.349-4.35l5.519-3.68l0.903-5.122 c3.982,4.877,6.379,11.096,6.379,17.865V324.361z" }),
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M244.213,248.928h23.573v-28.287h11.478L256,185.747l-23.264,34.895h11.478V248.928z M241.547,215.927 L256,194.247l14.452,21.68h-7.381v28.287h-14.143v-28.287H241.547z" }),
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M186.991,215.278l8.13,40.656l7.989-7.988l20.051,20.849l17.345-17.344l-20.85-20.051l7.988-7.989 L186.991,215.278z M233.776,251.517l-10.546,10.546l-20.051-20.85l-5.16,5.158l-5.016-25.082l25.084,5.016l-5.158,5.16 L233.776,251.517z" }),
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M271.492,251.45l17.345,17.345l20.05-20.85l7.989,7.989l8.131-40.656l-40.656,8.131l7.989,7.988 L271.492,251.45z M318.997,221.289l-5.016,25.084l-5.16-5.158l-20.05,20.851l-10.547-10.546l20.849-20.051l-5.156-5.16 L318.997,221.289z" }),
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M189.997,197.068c3.899,0,7.072-3.173,7.072-7.072s-3.173-7.072-7.072-7.072 c-3.898,0-7.072,3.173-7.072,7.072S186.098,197.068,189.997,197.068z M189.997,187.64c1.299,0,2.357,1.058,2.357,2.357 s-1.058,2.357-2.357,2.357s-2.357-1.058-2.357-2.357S188.697,187.64,189.997,187.64z" }),
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M208.729,212.071l3.333-3.333l3.167,3.166l-3.333,3.333L208.729,212.071z" }),
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M195.398,198.735l3.333-3.333l3.333,3.333l-3.333,3.333L195.398,198.735z" }),
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M202.065,205.404l3.333-3.333l3.333,3.333l-3.333,3.333L202.065,205.404z" }),
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M189.997,314.932c-3.898,0-7.072,3.172-7.072,7.072c0,3.898,3.173,7.071,7.072,7.071 c3.899,0,7.072-3.173,7.072-7.071C197.068,318.104,193.896,314.932,189.997,314.932z M189.997,324.361 c-1.299,0-2.357-1.06-2.357-2.357c0-1.299,1.058-2.358,2.357-2.358s2.357,1.06,2.357,2.358 C192.354,323.302,191.296,324.361,189.997,324.361z" }),
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M208.72,299.921l3.167-3.166l3.333,3.333l-3.167,3.167L208.72,299.921z" }),
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M195.386,313.254l3.333-3.332l3.333,3.332l-3.333,3.333L195.386,313.254z" }),
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M202.054,306.585l3.333-3.333l3.333,3.333l-3.333,3.334L202.054,306.585z" }),
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M322.004,314.932c-3.9,0-7.072,3.172-7.072,7.072c0,3.898,3.172,7.071,7.072,7.071 c3.898,0,7.071-3.173,7.071-7.071C329.075,318.104,325.902,314.932,322.004,314.932z M322.004,324.361 c-1.299,0-2.358-1.06-2.358-2.357c0-1.299,1.06-2.358,2.358-2.358c1.298,0,2.357,1.06,2.357,2.358 C324.361,323.302,323.302,324.361,322.004,324.361z" }),
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M309.903,313.266l3.334-3.335l3.333,3.335l-3.333,3.332L309.903,313.266z" }),
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M296.74,300.099l3.332-3.334l3.167,3.167l-3.334,3.333L296.74,300.099z" }),
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M303.235,306.597l3.333-3.334l3.334,3.334l-3.334,3.333L303.235,306.597z" }),
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M322.004,197.068c3.898,0,7.071-3.173,7.071-7.072s-3.173-7.072-7.071-7.072c-3.9,0-7.072,3.173-7.072,7.072 S318.104,197.068,322.004,197.068z M322.004,187.64c1.298,0,2.357,1.058,2.357,2.357s-1.06,2.357-2.357,2.357 c-1.299,0-2.358-1.058-2.358-2.357S320.705,187.64,322.004,187.64z" }),
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M303.249,205.416l3.333-3.333l3.334,3.333l-3.334,3.333L303.249,205.416z" }),
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M309.915,198.749l3.334-3.333l3.332,3.333l-3.332,3.333L309.915,198.749z" }),
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M296.748,211.911l3.167-3.167l3.333,3.333l-3.166,3.167L296.748,211.911z" }),
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M322.004,270.144c-3.9,0-7.072,3.174-7.072,7.071c0,3.9,3.172,7.072,7.072,7.072 c3.898,0,7.071-3.172,7.071-7.072C329.075,273.316,325.902,270.144,322.004,270.144z M322.004,279.573 c-1.299,0-2.358-1.06-2.358-2.358c0-1.298,1.06-2.357,2.358-2.357c1.298,0,2.357,1.06,2.357,2.357 C324.361,278.514,323.302,279.573,322.004,279.573z" }),
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M305.502,274.857h4.716v4.716h-4.716V274.857z" }),
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M286.645,274.857h4.714v4.716h-4.714V274.857z" }),
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M296.074,274.857h4.714v4.716h-4.714V274.857z" }),
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M189.997,284.287c3.899,0,7.072-3.172,7.072-7.072c0-3.897-3.173-7.071-7.072-7.071 c-3.898,0-7.072,3.174-7.072,7.071C182.925,281.115,186.098,284.287,189.997,284.287z M189.997,274.857 c1.299,0,2.357,1.06,2.357,2.357c0,1.299-1.058,2.358-2.357,2.358s-2.357-1.06-2.357-2.358 C187.64,275.917,188.697,274.857,189.997,274.857z" }),
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M211.212,274.857h4.715v4.716h-4.715V274.857z" }),
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M201.783,274.857h4.714v4.716h-4.714V274.857z" }),
    wp.element.createElement("path", { fill: "#0F6CB6", d: "M220.641,274.857h4.714v4.716h-4.714V274.857z" })
  );

  var BlockComponent = function (_Component) {
    _inherits(BlockComponent, _Component);

    function BlockComponent() {
      _classCallCheck(this, BlockComponent);

      return _possibleConstructorReturn(this, (BlockComponent.__proto__ || Object.getPrototypeOf(BlockComponent)).apply(this, arguments));
    }

    _createClass(BlockComponent, [{
      key: "componentDidMount",
      value: function componentDidMount() {
        var DataArray = this.props.attributes.DataArray;

        if (0 === DataArray.length) {
          this.initList();
        }
      }
    }, {
      key: "initList",
      value: function initList() {
        var DataArray = this.props.attributes.DataArray;
        var setAttributes = this.props.setAttributes;

        setAttributes({
          DataArray: [].concat(_toConsumableArray(DataArray), [{
            index: DataArray.length,
            media: '',
            mediaAlt: '',
            title: '',
            cost: '',
            exclusivity: 'Exclusivity',
            description: '',
            sold: false
          }])
        });
      }
    }, {
      key: "render",
      value: function render() {
        var _props = this.props,
            attributes = _props.attributes,
            setAttributes = _props.setAttributes,
            clientId = _props.clientId,
            className = _props.className;
        var DataArray = attributes.DataArray,
            title = attributes.title;


        var getImageButton = function getImageButton(openEvent, index) {
          if (DataArray[index].media) {
            return wp.element.createElement("img", { src: DataArray[index].media, alt: DataArray[index].alt, className: "img" });
          } else {
            return wp.element.createElement(
              Button,
              { onClick: openEvent, className: "button button-large" },
              wp.element.createElement("span", { className: "dashicons dashicons-upload" }),
              " Upload Image"
            );
          }
        };

        var DataArrayList = DataArray.sort(function (a, b) {
          return a.index - b.index;
        }).map(function (product, index) {
          return wp.element.createElement(
            "div",
            { className: "box-item" },
            wp.element.createElement(
              "span",
              {
                className: "remove",
                onClick: function onClick() {
                  var qewQusote = DataArray.filter(function (item) {
                    return item.index != product.index;
                  }).map(function (t) {
                    if (t.index > product.index) {
                      t.index -= 1;
                    }

                    return t;
                  });

                  setAttributes({
                    DataArray: qewQusote
                  });
                }
              },
              wp.element.createElement("span", { className: "dashicons dashicons-no-alt" })
            ),
            wp.element.createElement(
              "div",
              { className: "box-inner" },
              product.sold && wp.element.createElement(
                "span",
                { className: "sold" },
                "Sold"
              ),
              wp.element.createElement(
                "div",
                { className: "media-img" },
                wp.element.createElement(MediaUpload, {
                  onSelect: function onSelect(media) {
                    var newObject = Object.assign({}, product, {
                      media: media.url,
                      mediaAlt: media.alt
                    });
                    setAttributes({
                      DataArray: [].concat(_toConsumableArray(DataArray.filter(function (item) {
                        return item.index != product.index;
                      })), [newObject])
                    });
                  },
                  type: "image",
                  value: attributes.imageID,
                  render: function render(_ref) {
                    var open = _ref.open;
                    return wp.element.createElement("span", { onClick: open, className: "dashicons dashicons-edit" });
                  }
                }),
                wp.element.createElement(MediaUpload, {
                  onSelect: function onSelect(media) {
                    var newObject = Object.assign({}, product, {
                      media: media.url,
                      mediaAlt: media.alt
                    });
                    setAttributes({
                      DataArray: [].concat(_toConsumableArray(DataArray.filter(function (item) {
                        return item.index != product.index;
                      })), [newObject])
                    });
                  },
                  type: "image",
                  value: attributes.imageID,
                  render: function render(_ref2) {
                    var open = _ref2.open;
                    return getImageButton(open, index);
                  }
                })
              ),
              wp.element.createElement(
                "div",
                { className: "details-sec" },
                wp.element.createElement(RichText, {
                  tagName: "h3",
                  placeholder: __('Title'),
                  value: product.title,
                  className: "title",
                  onChange: function onChange(title) {
                    var newObject = Object.assign({}, product, {
                      title: title
                    });
                    setAttributes({
                      DataArray: [].concat(_toConsumableArray(DataArray.filter(function (item) {
                        return item.index != product.index;
                      })), [newObject])
                    });
                  }
                }),
                wp.element.createElement(RichText, {
                  tagName: "span",
                  className: "cost",
                  placeholder: __('Cost'),
                  value: product.cost,
                  onChange: function onChange(cost) {
                    var newObject = Object.assign({}, product, {
                      cost: cost
                    });
                    setAttributes({
                      DataArray: [].concat(_toConsumableArray(DataArray.filter(function (item) {
                        return item.index != product.index;
                      })), [newObject])
                    });
                  }
                }),
                wp.element.createElement(RichText, {
                  tagName: "span",
                  className: "exclusivity",
                  placeholder: __('Exclusivity'),
                  value: product.exclusivity,
                  onChange: function onChange(exclusivity) {
                    var newObject = Object.assign({}, product, {
                      exclusivity: exclusivity
                    });
                    setAttributes({
                      DataArray: [].concat(_toConsumableArray(DataArray.filter(function (item) {
                        return item.index != product.index;
                      })), [newObject])
                    });
                  }
                }),
                wp.element.createElement(RichText, {
                  tagName: "p",
                  className: "description",
                  placeholder: __('Description'),
                  value: product.description,
                  onChange: function onChange(description) {
                    var newObject = Object.assign({}, product, {
                      description: description
                    });
                    setAttributes({
                      DataArray: [].concat(_toConsumableArray(DataArray.filter(function (item) {
                        return item.index != product.index;
                      })), [newObject])
                    });
                  }
                }),
                wp.element.createElement(CheckboxControl, {
                  className: "sold-checkbox",
                  label: "Sold",
                  checked: product.sold,
                  onChange: function onChange() {
                    var tempProdcut = [].concat(_toConsumableArray(DataArray));
                    tempProdcut[index].sold = product.sold ? false : true;
                    setAttributes({ DataArray: tempProdcut });
                  }
                })
              )
            )
          );
        });

        return wp.element.createElement(
          "div",
          { className: "opportunities" },
          wp.element.createElement(RichText, {
            tagName: "h2",
            placeholder: __('Title'),
            value: title,
            className: "main-title",
            onChange: function onChange(title) {
              setAttributes({
                title: title
              });
            }
          }),
          wp.element.createElement(
            "div",
            { className: "box-main two-item" },
            DataArrayList,
            wp.element.createElement(
              "div",
              { className: "box-item additem" },
              wp.element.createElement(
                "button",
                {
                  className: "components-button add",
                  onClick: function onClick(content) {
                    setAttributes({
                      DataArray: [].concat(_toConsumableArray(DataArray), [{
                        index: DataArray.length,
                        media: '',
                        mediaAlt: '',
                        title: '',
                        cost: '',
                        exclusivity: 'Exclusivity',
                        description: '',
                        sold: false
                      }])
                    });
                  }
                },
                wp.element.createElement("span", { className: "dashicons dashicons-plus" }),
                " Add New Item"
              )
            )
          )
        );
      }
    }]);

    return BlockComponent;
  }(Component);

  registerBlockType('nab/opportunities', {
    title: __('Opportunities'),
    description: __('Opportunities'),
    icon: { src: opportunityBlockIcon },
    category: 'nabshow',
    keywords: [__('Opportunities'), __('gutenberg'), __('nab')],
    attributes: {
      DataArray: {
        type: 'array',
        default: []
      },
      title: {
        type: 'string'
      }
    },
    edit: BlockComponent,

    save: function save(props) {
      var attributes = props.attributes,
          className = props.className;
      var DataArray = attributes.DataArray,
          title = attributes.title;


      return wp.element.createElement(
        "div",
        { className: "opportunities" },
        wp.element.createElement(RichText.Content, {
          tagName: "h2",
          value: title,
          className: "main-title"
        }),
        wp.element.createElement(
          "div",
          { className: "box-main two-item" },
          DataArray.map(function (product, index) {
            return wp.element.createElement(
              Fragment,
              null,
              product.title && wp.element.createElement(
                "div",
                { className: "box-item" },
                wp.element.createElement(
                  "div",
                  { className: "box-inner" },
                  product.sold && wp.element.createElement(
                    "span",
                    { className: "sold" },
                    "Sold"
                  ),
                  wp.element.createElement(
                    "div",
                    { className: "media-img" },
                    product.media ? wp.element.createElement("img", { src: product.media, alt: product.alt, className: "img" }) : wp.element.createElement(
                      "div",
                      { className: "no-image" },
                      "No Featured Image"
                    )
                  ),
                  wp.element.createElement(
                    "div",
                    { className: "details-sec" },
                    product.title && wp.element.createElement(RichText.Content, {
                      tagName: "h3",
                      value: product.title,
                      className: "title"
                    }),
                    product.cost && wp.element.createElement(RichText.Content, {
                      tagName: "span",
                      className: "cost",
                      value: product.cost
                    }),
                    product.exclusivity && wp.element.createElement(RichText.Content, {
                      tagName: "span",
                      className: "exclusivity",
                      value: product.exclusivity
                    }),
                    product.description && wp.element.createElement(RichText.Content, {
                      tagName: "p",
                      className: "description",
                      value: product.description
                    })
                  )
                )
              )
            );
          })
        )
      );
    }
  });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);

/***/ }),
/* 42 */
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
      MediaUpload = wpEditor.MediaUpload;
  var Button = wpComponents.Button,
      TextControl = wpComponents.TextControl,
      CheckboxControl = wpComponents.CheckboxControl;


  var exhibitorCommitteeBlockIcon = wp.element.createElement(
    "svg",
    { width: "150px", height: "150px", viewBox: "0 0 150 150", "enable-background": "new 0 0 150 150" },
    wp.element.createElement(
      "g",
      { id: "XMLID_1423_" },
      wp.element.createElement(
        "g",
        { id: "XMLID_2880_" },
        wp.element.createElement(
          "g",
          { id: "XMLID_924_" },
          wp.element.createElement("path", { id: "XMLID_1259_", fill: "#146DB6", d: "M131.791,118.023c1.472-2.111,2.338-4.676,2.338-7.44v-2.558 c0-7.193-5.852-13.046-13.045-13.046s-13.047,5.853-13.047,13.046v2.558c0,2.765,0.866,5.329,2.339,7.44 c-5.098,0.152-9.587,2.759-12.325,6.678c-2.739-3.919-7.229-6.525-12.326-6.678c1.473-2.111,2.339-4.676,2.339-7.44v-2.558 c0-7.193-5.853-13.046-13.046-13.046s-13.046,5.853-13.046,13.046v2.558c0,2.765,0.867,5.329,2.339,7.44 c-5.108,0.152-9.606,2.769-12.343,6.702c-2.737-3.934-7.235-6.55-12.344-6.702c1.472-2.111,2.338-4.676,2.338-7.44v-2.558 c0-7.193-5.853-13.046-13.046-13.046s-13.045,5.853-13.045,13.046v2.558c0,2.765,0.866,5.329,2.338,7.44 c-8.387,0.251-15.134,7.146-15.134,15.594V144.1c0,1.55,1.257,2.809,2.809,2.809h138.233c1.552,0,2.81-1.259,2.81-2.809v-10.482 C146.926,125.169,140.178,118.274,131.791,118.023z M113.655,108.025c0-4.097,3.333-7.429,7.429-7.429s7.428,3.331,7.428,7.429 v2.558c0,4.097-3.332,7.429-7.428,7.429s-7.429-3.332-7.429-7.429V108.025z M67.59,108.025c0-4.097,3.332-7.429,7.428-7.429 s7.428,3.331,7.428,7.429v2.558c0,4.097-3.332,7.429-7.428,7.429s-7.428-3.332-7.428-7.429V108.025L67.59,108.025z M21.488,108.025c0-4.097,3.332-7.429,7.428-7.429c4.096,0,7.428,3.331,7.428,7.429v2.558c0,4.097-3.332,7.429-7.428,7.429 c-4.095,0-7.428-3.332-7.428-7.429V108.025z M49.14,141.29H8.692v-7.674c0-5.507,4.479-9.987,9.987-9.987h20.474 c5.507,0,9.987,4.48,9.987,9.987L49.14,141.29L49.14,141.29z M54.793,133.617c0-5.507,4.48-9.988,9.987-9.988h20.474 c5.507,0,9.987,4.48,9.987,9.988v7.673H54.794L54.793,133.617L54.793,133.617z M141.308,141.29h-40.448v-7.674 c0-5.507,4.48-9.987,9.987-9.987h20.474c5.507,0,9.987,4.48,9.987,9.987V141.29L141.308,141.29z" }),
          wp.element.createElement("path", { id: "XMLID_1309_", fill: "#146DB6", d: "M55.601,78.59c-0.738,0-1.463,0.301-1.986,0.823c-0.522,0.521-0.823,1.244-0.823,1.985 c0,0.739,0.3,1.463,0.823,1.986c0.523,0.521,1.248,0.822,1.986,0.822c0.739,0,1.464-0.3,1.986-0.822 c0.522-0.526,0.823-1.247,0.823-1.986c0-0.738-0.301-1.464-0.823-1.985C57.064,78.891,56.339,78.59,55.601,78.59z" }),
          wp.element.createElement("path", { id: "XMLID_1315_", fill: "#146DB6", d: "M21.051,84.206h23.314c1.551,0,2.809-1.258,2.809-2.809s-1.258-2.81-2.809-2.81H23.86 V58.699c0-5.222,4.248-9.47,9.469-9.47h4.645v13.132c0,1.126,0.672,2.143,1.708,2.584c1.036,0.441,2.235,0.221,3.047-0.558 l10.063-9.668v8.457c0,1.551,1.258,2.809,2.809,2.809c1.551,0,2.809-1.259,2.809-2.809v-8.457l10.062,9.668 c0.534,0.512,1.235,0.783,1.947,0.783c0.371,0,0.745-0.074,1.101-0.225c1.036-0.441,1.708-1.458,1.708-2.584V49.229h4.645 c5.222,0,9.47,4.248,9.47,9.47v19.889H66.836c-1.551,0-2.809,1.259-2.809,2.81s1.258,2.809,2.809,2.809H90.15 c1.551,0,2.809-1.258,2.809-2.809V58.699c0-8.318-6.769-15.087-15.087-15.087h-9.221c3.07-3.231,4.96-7.594,4.96-12.392v-6.457 v-2.988v-0.672c0-9.931-8.08-18.011-18.011-18.011S37.59,11.172,37.59,21.103v0.672v2.987v6.457c0,4.798,1.89,9.161,4.96,12.392 H33.33c-8.319,0-15.087,6.769-15.087,15.087v22.699C18.243,82.949,19.5,84.206,21.051,84.206z M43.592,49.229h6.803l-6.803,6.538 V49.229L43.592,49.229z M67.609,55.767l-6.804-6.537h6.804V55.767L67.609,55.767z M43.208,21.103 c0-6.833,5.559-12.393,12.393-12.393c6.398,0,11.68,4.875,12.326,11.105l-5.871-3.449c-1.183-0.695-2.695-0.434-3.576,0.617 c-2.647,3.158-6.528,4.97-10.648,4.97h-4.624v-0.179V21.103L43.208,21.103z M43.208,31.219v-3.648h4.624 c4.979,0,9.708-1.882,13.3-5.232l6.863,4.032v4.849c0,6.833-5.56,12.392-12.393,12.392S43.208,38.052,43.208,31.219z" }),
          wp.element.createElement("path", { id: "XMLID_1330_", fill: "#146DB6", d: "M93.751,48.792c0.457,0.29,0.98,0.438,1.506,0.438c0.406,0,0.813-0.087,1.194-0.266 l9.521-4.471h34.891c3.324,0,6.027-2.704,6.027-6.028V9.12c0-3.324-2.703-6.027-6.027-6.027H98.475 c-3.322,0-6.027,2.703-6.027,6.027V46.42C92.447,47.382,92.939,48.276,93.751,48.792z M98.065,9.12 c0-0.226,0.185-0.41,0.409-0.41h42.388c0.227,0,0.409,0.184,0.409,0.41v29.345c0,0.226-0.183,0.41-0.409,0.41h-35.518 c-0.413,0-0.82,0.09-1.194,0.266l-6.085,2.857V9.12z" }),
          wp.element.createElement("path", { id: "XMLID_1331_", fill: "#146DB6", d: "M106.283,20.669h26.771c1.551,0,2.81-1.258,2.81-2.81c0-1.551-1.259-2.809-2.81-2.809 h-26.771c-1.552,0-2.809,1.258-2.809,2.809C103.475,19.411,104.731,20.669,106.283,20.669z" }),
          wp.element.createElement("path", { id: "XMLID_1332_", fill: "#146DB6", d: "M106.283,31.905h18.469c1.551,0,2.809-1.258,2.809-2.809s-1.258-2.809-2.809-2.809 h-18.469c-1.552,0-2.809,1.258-2.809,2.809S104.731,31.905,106.283,31.905z" })
        )
      )
    )
  );

  var ItemComponent = function (_Component) {
    _inherits(ItemComponent, _Component);

    function ItemComponent() {
      _classCallCheck(this, ItemComponent);

      return _possibleConstructorReturn(this, (ItemComponent.__proto__ || Object.getPrototypeOf(ItemComponent)).apply(this, arguments));
    }

    _createClass(ItemComponent, [{
      key: "componentDiDMount",
      value: function componentDiDMount() {
        var committee = this.props.attributes.committee;

        if (0 === committee.length) {
          this.initList();
        }
      }
    }, {
      key: "initList",
      value: function initList() {
        var committee = this.props.attributes.committee;
        var setAttributes = this.props.setAttributes;


        setAttributes({
          committee: [].concat(_toConsumableArray(committee), [{
            index: committee.length,
            name: '',
            company: '',
            areas: '',
            boothSize: '',
            address: '',
            phone: '',
            emailAdd: '',
            media: '',
            mediaAlt: '',
            international: false
          }])
        });
      }
    }, {
      key: "render",
      value: function render() {
        var _props = this.props,
            attributes = _props.attributes,
            setAttributes = _props.setAttributes,
            clientId = _props.clientId,
            className = _props.className;
        var committee = attributes.committee;


        var getImageButton = function getImageButton(openEvent, index) {
          if (committee[index].media) {
            return wp.element.createElement("img", { src: committee[index].media, alt: committee[index].alt, className: "img" });
          } else {
            return wp.element.createElement(
              Button,
              { onClick: openEvent, className: "button button-large" },
              wp.element.createElement("span", { className: "dashicons dashicons-upload" }),
              " Upload Logo"
            );
          }
        };

        var committeeMembers = committee.sort(function (a, b) {
          return a.index - b.index;
        }).map(function (member, index) {
          return wp.element.createElement(
            "div",
            { className: "box-item " + (member.international ? 'International' : '') + " " },
            wp.element.createElement(
              "div",
              { className: "box-inner" },
              wp.element.createElement(
                "div",
                { className: "info-box" },
                wp.element.createElement(
                  "span",
                  {
                    className: "remove",
                    onClick: function onClick() {
                      var removeMember = committee.filter(function (item) {
                        return item.index !== member.index;
                      }).map(function (item) {
                        if (item.index > member.index) {
                          item.index -= 1;
                        }
                        return item;
                      });
                      setAttributes({
                        committee: removeMember
                      });
                    }
                  },
                  wp.element.createElement("span", { className: "dashicons dashicons-no-alt" })
                ),
                wp.element.createElement(RichText, {
                  tagName: "h2",
                  placeholder: __('Member Name'),
                  value: member.name,
                  onChange: function onChange(name) {
                    var newObject = Object.assign({}, member, {
                      name: name
                    });
                    setAttributes({
                      committee: [].concat(_toConsumableArray(committee.filter(function (item) {
                        return item.index != member.index;
                      })), [newObject])
                    });
                  }
                }),
                wp.element.createElement(RichText, {
                  tagName: "h4",
                  placeholder: __('Company'),
                  value: member.company,
                  onChange: function onChange(company) {
                    var newObject = Object.assign({}, member, {
                      company: company
                    });
                    setAttributes({
                      committee: [].concat(_toConsumableArray(committee.filter(function (item) {
                        return item.index != member.index;
                      })), [newObject])
                    });
                  }
                }),
                wp.element.createElement(RichText, {
                  tagName: "p",
                  placeholder: __('Areas'),
                  value: member.areas,
                  onChange: function onChange(areas) {
                    var newObject = Object.assign({}, member, {
                      areas: areas
                    });
                    setAttributes({
                      committee: [].concat(_toConsumableArray(committee.filter(function (item) {
                        return item.index != member.index;
                      })), [newObject])
                    });
                  }
                }),
                wp.element.createElement(RichText, {
                  tagName: "p",
                  placeholder: __('Booth Size'),
                  value: member.boothSize,
                  onChange: function onChange(boothSize) {
                    var newObject = Object.assign({}, member, {
                      boothSize: boothSize
                    });
                    setAttributes({
                      committee: [].concat(_toConsumableArray(committee.filter(function (item) {
                        return item.index != member.index;
                      })), [newObject])
                    });
                  }
                }),
                wp.element.createElement(RichText, {
                  tagName: "p",
                  placeholder: __('Address'),
                  value: member.address,
                  onChange: function onChange(address) {
                    var newObject = Object.assign({}, member, {
                      address: address
                    });
                    setAttributes({
                      committee: [].concat(_toConsumableArray(committee.filter(function (item) {
                        return item.index != member.index;
                      })), [newObject])
                    });
                  }
                }),
                wp.element.createElement(RichText, {
                  tagName: "p",
                  placeholder: __('Phone'),
                  value: member.phone,
                  onChange: function onChange(phone) {
                    var newObject = Object.assign({}, member, {
                      phone: phone
                    });
                    setAttributes({
                      committee: [].concat(_toConsumableArray(committee.filter(function (item) {
                        return item.index != member.index;
                      })), [newObject])
                    });
                  }
                }),
                wp.element.createElement(TextControl, {
                  type: "text",
                  className: "email",
                  value: member.email,
                  placeholder: "Email Address",
                  onChange: function onChange(email) {
                    var newObject = Object.assign({}, member, {
                      email: email
                    });
                    setAttributes({
                      committee: [].concat(_toConsumableArray(committee.filter(function (item) {
                        return item.index != member.index;
                      })), [newObject])
                    });
                  }
                }),
                wp.element.createElement(CheckboxControl, {
                  className: "in-checkbox",
                  label: "International",
                  checked: member.international,
                  onChange: function onChange(isChecked) {
                    var newObject = void 0;
                    if (isChecked) {
                      newObject = Object.assign({}, member, {
                        international: true
                      });
                    } else {
                      newObject = Object.assign({}, member, {
                        international: false
                      });
                    }
                    setAttributes({
                      committee: [].concat(_toConsumableArray(committee.filter(function (item) {
                        return item.index != member.index;
                      })), [newObject])
                    });
                  }
                })
              ),
              wp.element.createElement(
                "div",
                { className: "media-box" },
                wp.element.createElement(
                  "div",
                  { className: "media-img" },
                  wp.element.createElement(MediaUpload, {
                    onSelect: function onSelect(media) {
                      var newObject = Object.assign({}, member, {
                        media: media.url,
                        mediaAlt: media.alt
                      });
                      setAttributes({
                        committee: [].concat(_toConsumableArray(committee.filter(function (item) {
                          return item.index != member.index;
                        })), [newObject])
                      });
                    },
                    type: "image",
                    value: attributes.imageID,
                    render: function render(_ref) {
                      var open = _ref.open;
                      return wp.element.createElement("span", { onClick: open, className: "dashicons dashicons-edit" });
                    }
                  }),
                  wp.element.createElement(MediaUpload, {
                    onSelect: function onSelect(media) {
                      var newObject = Object.assign({}, member, {
                        media: media.url,
                        mediaAlt: media.alt
                      });
                      setAttributes({
                        committee: [].concat(_toConsumableArray(committee.filter(function (item) {
                          return item.index != member.index;
                        })), [newObject])
                      });
                    },
                    type: "image",
                    value: attributes.imageID,
                    render: function render(_ref2) {
                      var open = _ref2.open;
                      return getImageButton(open, index);
                    }
                  })
                )
              )
            )
          );
        });

        return wp.element.createElement(
          "div",
          { className: "exhibitor-committee" },
          wp.element.createElement(
            "div",
            { className: "box-main two-grid" },
            committeeMembers,
            wp.element.createElement(
              "div",
              { className: "box-item additem" },
              wp.element.createElement(
                "button",
                {
                  className: "components-button add",
                  onClick: function onClick(content) {
                    setAttributes({
                      committee: [].concat(_toConsumableArray(committee), [{
                        index: committee.length,
                        name: '',
                        company: '',
                        areas: '',
                        boothSize: '',
                        address: '',
                        phone: '',
                        emailAdd: '',
                        media: '',
                        mediaAlt: '',
                        international: false
                      }])
                    });
                  }
                },
                wp.element.createElement("span", { className: "dashicons dashicons-plus" }),
                " Add New Item"
              )
            )
          )
        );
      }
    }]);

    return ItemComponent;
  }(Component);

  registerBlockType('nab/exhibitor-advisory-committee', {
    title: __('Exhibitor Advisory Committee'),
    description: __('Exhibitor Advisory Committee'),
    icon: { src: exhibitorCommitteeBlockIcon },
    category: 'nabshow',
    keywords: [__('Exhibitor Advisory Committee'), __('gutenberg'), __('nab')],
    attributes: {
      committee: {
        type: 'array',
        default: []
      }
    },
    edit: ItemComponent,

    save: function save(props) {
      var attributes = props.attributes,
          className = props.className;
      var committee = attributes.committee;


      return wp.element.createElement(
        "div",
        { className: "exhibitor-committee" },
        wp.element.createElement(
          "div",
          { className: "box-main two-grid" },
          committee.map(function (member, index) {
            return wp.element.createElement(
              Fragment,
              null,
              member.name && wp.element.createElement(
                "div",
                { className: "box-item " + (member.international ? 'International' : '') + " " },
                wp.element.createElement(
                  "div",
                  { className: "box-inner" },
                  wp.element.createElement(
                    "div",
                    { className: "info-box" },
                    member.name && wp.element.createElement(RichText.Content, {
                      tagName: "h2",
                      value: member.name,
                      className: "title"
                    }),
                    member.company && wp.element.createElement(RichText.Content, {
                      tagName: "h4",
                      value: member.company,
                      className: "company"
                    }),
                    member.areas && wp.element.createElement(RichText.Content, {
                      tagName: "p",
                      value: member.areas,
                      className: "areas"
                    }),
                    member.boothSize && wp.element.createElement(RichText.Content, {
                      tagName: "p",
                      value: member.boothSize,
                      className: "boothSize"
                    }),
                    member.address && wp.element.createElement(RichText.Content, {
                      tagName: "p",
                      value: member.address,
                      className: "address"
                    }),
                    member.phone && wp.element.createElement(RichText.Content, {
                      tagName: "p",
                      value: member.phone,
                      className: "phone"
                    }),
                    member.email && wp.element.createElement(
                      "a",
                      { className: "email", href: "mailto:" + member.email },
                      member.email
                    )
                  ),
                  wp.element.createElement(
                    "div",
                    { className: "media-box" },
                    wp.element.createElement(
                      "div",
                      { className: "media-img" },
                      member.media ? wp.element.createElement("img", { src: member.media, alt: member.alt, className: "img" }) : wp.element.createElement(
                        "div",
                        { className: "no-image" },
                        "No Logo"
                      )
                    )
                  )
                )
              )
            );
          })
        )
      );
    }
  });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);

/***/ }),
/* 43 */
/***/ (function(module, exports) {

(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    var __ = wpI18n.__;
    var Fragment = wpElement.Fragment;
    var registerBlockType = wpBlocks.registerBlockType;
    var ServerSideRender = wpComponents.ServerSideRender;


    var relatedContentWithBlockIcon = wp.element.createElement(
        "svg",
        { width: "150px", height: "150px", viewBox: "181 181 150 150", "enable-background": "new 181 181 150 150" },
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M188.344,242.002c0,1.285,1.045,2.333,2.333,2.333h60.657c1.288,0,2.333-1.048,2.333-2.333v-34.995h-65.323 V242.002z M193.01,211.674h32.661v9.332h23.33v18.664H216.34v-9.332h-23.33V211.674z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M251.334,188.344h-60.657c-1.288,0-2.333,1.047-2.333,2.333v11.665h65.323v-11.665 C253.667,189.392,252.622,188.344,251.334,188.344z M197.676,197.676h-4.666v-4.666h4.666V197.676z M207.008,197.676h-4.666v-4.666 h4.666V197.676z M216.34,197.676h-4.666v-4.666h4.666V197.676z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M216.34,221.006h4.666v-4.666h-23.33v9.332h18.664V221.006z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M221.006,225.671h23.33v9.332h-23.33V225.671z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M197.676,295.66h23.33v9.332h-23.33V295.66z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M221.006,314.324h23.33v-9.332h-18.664v4.666h-4.666V314.324z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M251.334,267.665h-60.657c-1.288,0-2.333,1.047-2.333,2.333v11.664h65.323v-11.664 C253.667,268.712,252.622,267.665,251.334,267.665z M197.676,276.997h-4.666v-4.666h4.666V276.997z M207.008,276.997h-4.666v-4.666 h4.666V276.997z M216.34,276.997h-4.666v-4.666h4.666V276.997z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M188.344,321.323c0,1.285,1.045,2.333,2.333,2.333h60.657c1.288,0,2.333-1.048,2.333-2.333v-34.995h-65.323 V321.323z M193.01,290.994h32.661v9.332h23.33v18.664H216.34v-9.332h-23.33V290.994z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M305.911,296.507l-11.734,11.735c-2.42,2.419-5.632,3.749-9.05,3.749c-7.055,0-12.796-5.739-12.796-12.797 c0-3.417,1.329-6.632,3.746-9.046l11.735-11.735c2.419-2.42,5.632-3.749,9.049-3.749h1.899l3.828,2.827 c1.418,1.228,3.047,1.838,4.736,1.838c1.554,0,2.977-0.527,4.141-1.386c-3.208-4.927-8.642-7.945-14.604-7.945 c-4.663,0-9.049,1.817-12.348,5.113l-11.732,11.732c-3.301,3.299-5.116,7.686-5.116,12.351c0,9.629,7.834,17.463,17.462,17.463 c4.663,0,9.049-1.817,12.349-5.114l11.731-11.732c2.089-2.088,3.577-4.651,4.394-7.442c-1.703,0.534-3.502,0.833-5.359,0.915 C307.636,294.468,306.849,295.569,305.911,296.507L305.911,296.507z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M307.325,242.002c-9.003,0-16.331,7.325-16.331,16.331v7.804c1.512-0.412,3.072-0.66,4.666-0.746v-7.058 c0-6.432,5.232-11.665,11.665-11.665c6.432,0,11.665,5.233,11.665,11.665v13.998c0,6.432-5.233,11.664-11.665,11.664 c-2.813,0-5.534-1.02-7.657-2.869l-2.44-1.797h-0.366c-1.339,0-2.61,0.357-3.761,0.962c2.865,5.125,8.252,8.37,14.225,8.37 c9.003,0,16.33-7.325,16.33-16.33v-9.332v-4.666C323.655,249.328,316.328,242.002,307.325,242.002L307.325,242.002z" }),
        wp.element.createElement("path", { fill: "#0F6CB6", d: "M316.657,218.673h-34.995v-6.999l-12.441,9.332l12.441,9.332v-6.999h32.662c2.572,0,4.666,2.093,4.666,4.666 v12.883c1.764,1.183,3.333,2.629,4.666,4.279v-19.495C323.656,221.813,320.516,218.673,316.657,218.673z" })
    );

    var allAttr = {
        pageId: {
            type: 'number'
        }
    };

    registerBlockType('nab/related-content-with-block', {
        title: __('Related Content with Block'),
        icon: { src: relatedContentWithBlockIcon },
        category: 'nabshow',
        keywords: [__('related'), __('content'), __('block')],
        attributes: allAttr,
        edit: function edit(_ref) {
            var attributes = _ref.attributes,
                setAttributes = _ref.setAttributes;
            var pageId = attributes.pageId;

            if (!pageId) {
                setAttributes({ pageId: wp.data.select('core/editor').getCurrentPostId() });
            }
            return wp.element.createElement(
                Fragment,
                null,
                wp.element.createElement(ServerSideRender, {
                    block: "nab/related-content-with-block",
                    attributes: { pageId: pageId }
                })
            );
        },
        save: function save() {
            return null;
        }
    });
})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);

/***/ }),
/* 44 */
/***/ (function(module, exports) {

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _toConsumableArray(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } else { return Array.from(arr); } }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
  var __ = wpI18n.__;
  var registerBlockType = wpBlocks.registerBlockType;
  var Component = wpElement.Component;
  var MediaUpload = wpEditor.MediaUpload,
      InspectorControls = wpEditor.InspectorControls;
  var Button = wpComponents.Button,
      TextControl = wpComponents.TextControl;


  var videoBlockIcon = wp.element.createElement(
    "svg",
    { width: "150px", height: "150px", viewBox: "222.64 222.641 150 150", "enable-background": "new 222.64 222.641 150 150" },
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("path", { fill: "#0F6CB6", d: "M283.734,293.523c0.38,0.208,0.802,0.312,1.22,0.312c0.475,0,0.946-0.134,1.363-0.396l27.907-17.759 c0.73-0.467,1.175-1.274,1.175-2.142c0-0.867-0.444-1.674-1.175-2.141l-27.907-17.759c-0.787-0.495-1.769-0.528-2.585-0.084 c-0.809,0.446-1.314,1.299-1.314,2.225v35.519C282.417,292.224,282.922,293.076,283.734,293.523z M287.492,260.399l20.646,13.139 l-20.646,13.14V260.399z" }),
      wp.element.createElement("path", { fill: "#0F6CB6", d: "M229.14,227.872v139.537h137V227.872H229.14z M361.065,232.946v83.722H234.214v-83.722H361.065z M234.214,362.335v-40.593h126.852v40.593H234.214L234.214,362.335z" }),
      wp.element.createElement("path", { fill: "#0F6CB6", d: "M348.381,339.502h-60.889v-5.074c0-1.403-1.134-2.537-2.537-2.537s-2.537,1.134-2.537,2.537v5.074H272.27 c-1.403,0-2.537,1.134-2.537,2.536c0,1.403,1.134,2.537,2.537,2.537h10.148v5.074c0,1.403,1.134,2.537,2.537,2.537 c1.403,0,2.537-1.134,2.537-2.537v-5.074h60.89c1.402,0,2.536-1.134,2.536-2.537C350.917,340.636,349.783,339.502,348.381,339.502z " }),
      wp.element.createElement("path", { fill: "#0F6CB6", d: "M246.899,331.891c-1.403,0-2.537,1.134-2.537,2.537v15.222c0,1.403,1.134,2.537,2.537,2.537 s2.537-1.134,2.537-2.537v-15.222C249.436,333.024,248.302,331.891,246.899,331.891z" }),
      wp.element.createElement("path", { fill: "#0F6CB6", d: "M257.047,331.891c-1.403,0-2.537,1.134-2.537,2.537v15.222c0,1.403,1.134,2.537,2.537,2.537 s2.537-1.134,2.537-2.537v-15.222C259.584,333.024,258.45,331.891,257.047,331.891z" })
    )
  );

  var VideoComponent = function (_Component) {
    _inherits(VideoComponent, _Component);

    function VideoComponent() {
      _classCallCheck(this, VideoComponent);

      return _possibleConstructorReturn(this, (VideoComponent.__proto__ || Object.getPrototypeOf(VideoComponent)).apply(this, arguments));
    }

    _createClass(VideoComponent, [{
      key: "render",
      value: function render() {
        var _props = this.props,
            attributes = _props.attributes,
            setAttributes = _props.setAttributes,
            clientId = _props.clientId,
            className = _props.className;
        var dataArry = attributes.dataArry,
            videoID = attributes.videoID;


        if (0 === dataArry.length) {
          return wp.element.createElement(
            "div",
            { className: "videos-add first-time" },
            wp.element.createElement(MediaUpload, {
              multiple: true,
              onSelect: function onSelect(item) {
                var photoInsert = item.map(function (item, index) {
                  return {
                    index: index,
                    media: item.url,
                    alt: item.alt,
                    id: item.id,
                    width: item.sizes.full.width,
                    vidURL: ''
                  };
                });
                setAttributes({
                  dataArry: [].concat(_toConsumableArray(dataArry), _toConsumableArray(photoInsert))
                });
              },
              type: "image",
              render: function render(_ref) {
                var open = _ref.open;
                return wp.element.createElement(
                  Button,
                  { onClick: open, className: "button button-large" },
                  wp.element.createElement("span", { className: "dashicons dashicons-upload" }),
                  " Click Here to Upload First"
                );
              }
            })
          );
        }

        return wp.element.createElement(
          "div",
          { className: "nab-videos " + className },
          dataArry.map(function (photo, index) {
            return wp.element.createElement(
              "div",
              { className: "photo-item", key: index },
              wp.element.createElement(
                "div",
                { className: "photo-inner" },
                wp.element.createElement("span", {
                  onClick: function onClick() {
                    var qewQusote = dataArry.filter(function (item) {
                      return item.index != photo.index;
                    }).map(function (t) {
                      if (t.index > photo.index) {
                        t.index -= 1;
                      }
                      return t;
                    });
                    setAttributes({
                      dataArry: qewQusote
                    });
                  },
                  className: "dashicons dashicons-no-alt remove" }),
                wp.element.createElement("img", { src: photo.media, alt: photo.alt, className: "media", width: photo.width, "data-video-src": photo.vidURL }),
                wp.element.createElement(
                  "div",
                  { className: "video-box" },
                  wp.element.createElement(TextControl, {
                    placeholder: __('Video URL'),
                    value: videoID,
                    onChange: function onChange(value) {
                      var tempProdcut = [].concat(_toConsumableArray(dataArry));
                      tempProdcut[index].vidURL = value;
                      setAttributes({ dataArry: tempProdcut });
                    }
                  })
                )
              )
            );
          }),
          wp.element.createElement(
            InspectorControls,
            null,
            wp.element.createElement(
              "div",
              { className: "videos-add" },
              wp.element.createElement(MediaUpload, {
                multiple: true,
                onSelect: function onSelect(item) {
                  var photoInsert = item.map(function (item, index) {
                    return {
                      index: index,
                      media: item.url,
                      alt: item.alt,
                      id: item.id,
                      width: item.sizes.full.width,
                      vidURL: ''
                    };
                  });
                  setAttributes({
                    dataArry: [].concat(_toConsumableArray(dataArry), _toConsumableArray(photoInsert))
                  });
                },

                type: "image",
                render: function render(_ref2) {
                  var open = _ref2.open;
                  return wp.element.createElement(
                    Button,
                    { onClick: open, className: "button button-large" },
                    wp.element.createElement("span", { className: "dashicons dashicons-upload" }),
                    " Upload Image"
                  );
                }
              })
            )
          )
        );
      }
    }]);

    return VideoComponent;
  }(Component);

  registerBlockType('nab/nab-videos', {
    title: __('Videos'),
    description: __('Nabshow videos'),
    icon: { src: videoBlockIcon },
    category: 'nabshow',
    keywords: [__('videos'), __('gutenberg'), __('nab')],
    attributes: {
      dataArry: {
        type: 'array',
        default: []
      },
      videoURL: {
        type: 'string'
      },
      videoID: {
        type: 'string'
      }
    },
    edit: VideoComponent,

    save: function save(props) {
      var attributes = props.attributes;
      var dataArry = attributes.dataArry;


      return wp.element.createElement(
        "div",
        { className: "nab-videos" },
        dataArry.map(function (photo, index) {
          return wp.element.createElement(
            "div",
            { className: "photo-item", key: index },
            wp.element.createElement(
              "div",
              { className: "photo-inner" },
              wp.element.createElement(
                "div",
                { className: "hover-items" },
                wp.element.createElement(
                  "a",
                  { className: "video-popup-btn" },
                  wp.element.createElement("i", { className: "fa fa-image" })
                )
              ),
              wp.element.createElement("img", { src: photo.media, alt: photo.alt, className: "media", width: photo.width, "data-video-src": photo.vidURL })
            )
          );
        }),
        wp.element.createElement(
          "div",
          { className: "videos-popup" },
          wp.element.createElement(
            "div",
            { className: "videos-dialog" },
            wp.element.createElement(
              "span",
              { "class": "close" },
              "\xD7"
            ),
            wp.element.createElement(
              "div",
              { className: "videos-content" },
              wp.element.createElement(
                "div",
                { className: "videos-body" },
                wp.element.createElement("iframe", { src: "", "class": "videos-popup-iframe", frameBorder: "0", allowFullScreen: true })
              )
            )
          ),
          wp.element.createElement("div", { "class": "videos-backdrop" })
        )
      );
    }
  });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);

/***/ }),
/* 45 */
/***/ (function(module, exports) {

(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    var __ = wpI18n.__;
    var Fragment = wpElement.Fragment;
    var registerBlockType = wpBlocks.registerBlockType;
    var InspectorControls = wpEditor.InspectorControls;
    var PanelBody = wpComponents.PanelBody,
        TextControl = wpComponents.TextControl,
        ServerSideRender = wpComponents.ServerSideRender,
        Button = wpComponents.Button,
        Placeholder = wpComponents.Placeholder;


    var allAttr = {
        pageSlug: {
            type: 'string'
        },
        selection: {
            type: 'boolean',
            default: false
        }
    };

    var featurdImgBlockIcon = wp.element.createElement(
        'svg',
        { width: '150px', height: '150px', viewBox: '181 181 150 150', 'enable-background': 'new 181 181 150 150' },
        wp.element.createElement(
            'g',
            { id: 'Page-1' },
            wp.element.createElement(
                'g',
                { id: '_x30_23---Image-Rating', transform: 'translate(-1)' },
                wp.element.createElement('path', { id: 'Shape', fill: '#0F6CB6', d: 'M204.863,203.87v49.871c0.01,8.76,7.108,15.858,15.868,15.868h72.539 c8.76-0.01,15.858-7.108,15.868-15.868V203.87c-0.01-8.759-7.108-15.857-15.868-15.868h-72.539 C211.971,188.012,204.873,195.11,204.863,203.87z M220.731,192.536h72.539c6.257,0.007,11.327,5.078,11.335,11.334v49.871 c-0.008,6.257-5.078,11.327-11.335,11.334h-72.539c-6.257-0.007-11.327-5.077-11.334-11.334V203.87 C209.404,197.613,214.474,192.543,220.731,192.536z' }),
                wp.element.createElement('path', { id: 'Shape_1_', fill: '#0F6CB6', d: 'M220.731,260.541h72.539c3.756,0,6.801-3.045,6.801-6.801V203.87 c0-3.756-3.045-6.8-6.801-6.8h-72.539c-3.756,0-6.801,3.044-6.801,6.8v49.871C213.93,257.496,216.975,260.541,220.731,260.541z M293.27,256.007h-72.539c-1.252,0-2.267-1.015-2.267-2.267v-2.172l20.449-20.449l8.082,8.082c1.77,1.77,4.64,1.77,6.411,0 l23.997-23.997l18.135,18.135v20.402C295.537,254.993,294.521,256.007,293.27,256.007z M220.731,201.603h72.539 c1.252,0,2.268,1.015,2.268,2.267v23.059l-14.93-14.93c-1.771-1.77-4.641-1.77-6.411,0L250.2,235.996l-8.081-8.081 c-1.794-1.712-4.617-1.712-6.411,0l-17.244,17.242V203.87C218.464,202.618,219.479,201.603,220.731,201.603L220.731,201.603z' }),
                wp.element.createElement('path', { id: 'Shape_2_', fill: '#0F6CB6', d: 'M232.065,224.271c5.008,0,9.068-4.06,9.068-9.067s-4.06-9.067-9.068-9.067 s-9.067,4.06-9.067,9.067S227.057,224.271,232.065,224.271z M232.065,210.67c2.504,0,4.534,2.03,4.534,4.534 c0,2.504-2.03,4.534-4.534,4.534c-2.503,0-4.534-2.03-4.534-4.534C227.531,212.701,229.561,210.67,232.065,210.67z' }),
                wp.element.createElement('path', { id: 'Shape_3_', fill: '#0F6CB6', d: 'M192.203,294.501c-1.403,0.214-2.565,1.199-3.006,2.548 c-0.464,1.367-0.12,2.881,0.891,3.912l7.544,7.708l-1.782,10.901c-0.248,1.449,0.361,2.911,1.564,3.756 c1.162,0.833,2.7,0.921,3.949,0.227l9.167-5.065l9.167,5.057c1.25,0.693,2.787,0.605,3.949-0.227 c1.203-0.845,1.812-2.307,1.564-3.756l-1.782-10.895l7.544-7.708c1.011-1.031,1.355-2.545,0.891-3.912 c-0.44-1.348-1.602-2.333-3.003-2.548l-10.317-1.574l-4.613-9.811c-0.612-1.326-1.939-2.176-3.4-2.176s-2.788,0.85-3.4,2.176 l-4.613,9.813L192.203,294.501z M206.45,295.224l4.08-8.673l4.081,8.673c0.528,1.143,1.594,1.944,2.838,2.136l9.331,1.421 l-6.842,6.982c-0.848,0.877-1.233,2.103-1.038,3.308l1.587,9.747l-8.161-4.504c-1.118-0.621-2.477-0.621-3.595,0l-8.163,4.486 l1.587-9.748c0.194-1.205-0.191-2.432-1.041-3.31l-6.83-6.973l9.328-1.422C204.853,297.158,205.917,296.361,206.45,295.224z' }),
                wp.element.createElement('path', { id: 'Shape_4_', fill: '#0F6CB6', d: 'M321.801,294.501l-10.316-1.573l-4.613-9.813c-0.612-1.326-1.939-2.176-3.4-2.176 s-2.788,0.85-3.4,2.176l-4.615,9.813l-10.314,1.573c-1.402,0.214-2.564,1.199-3.005,2.548c-0.465,1.367-0.12,2.881,0.891,3.912 l7.544,7.708l-1.782,10.895c-0.247,1.449,0.361,2.911,1.564,3.756c1.162,0.833,2.699,0.921,3.949,0.228l9.169-5.06l9.168,5.057 c1.249,0.693,2.786,0.605,3.948-0.227c1.203-0.845,1.813-2.307,1.564-3.756l-1.782-10.895l7.544-7.708 c1.012-1.031,1.355-2.545,0.892-3.912C324.363,295.699,323.201,294.715,321.801,294.501z M312.878,305.763 c-0.848,0.877-1.232,2.103-1.038,3.308l1.587,9.747l-8.16-4.504c-1.118-0.621-2.478-0.621-3.596,0l-8.16,4.504l1.587-9.747 c0.194-1.206-0.191-2.433-1.041-3.31l-6.837-6.991l9.328-1.422c1.243-0.188,2.31-0.985,2.843-2.124l4.08-8.673l4.08,8.673 c0.528,1.143,1.595,1.944,2.838,2.136l9.331,1.421L312.878,305.763z' }),
                wp.element.createElement('path', { id: 'Shape_5_', fill: '#0F6CB6', d: 'M278.334,297.049c-0.44-1.348-1.602-2.333-3.004-2.548l-10.316-1.573l-4.613-9.813 c-0.611-1.326-1.939-2.176-3.4-2.176c-1.461,0-2.788,0.85-3.4,2.176l-4.615,9.813l-10.314,1.573 c-1.402,0.214-2.565,1.199-3.005,2.548c-0.465,1.367-0.12,2.881,0.891,3.912l7.544,7.708l-1.782,10.895 c-0.248,1.449,0.361,2.911,1.564,3.756c1.162,0.833,2.7,0.921,3.949,0.228l9.169-5.061l9.167,5.058 c1.249,0.693,2.786,0.604,3.948-0.228c1.203-0.845,1.813-2.307,1.564-3.756l-1.782-10.895l7.544-7.707 C278.453,299.928,278.797,298.416,278.334,297.049L278.334,297.049z M266.408,305.763c-0.849,0.877-1.233,2.103-1.039,3.308 l1.587,9.747l-8.16-4.504c-1.118-0.621-2.478-0.621-3.595,0l-8.161,4.504l1.587-9.747c0.194-1.206-0.191-2.433-1.041-3.31 l-6.837-6.991l9.328-1.422c1.243-0.188,2.31-0.985,2.842-2.124l4.081-8.68l4.081,8.68c0.528,1.143,1.594,1.944,2.838,2.136 l9.33,1.421L266.408,305.763z' })
            )
        )
    );

    registerBlockType('nab/page-featured-image', {
        title: __('Featured Image'),
        icon: { src: featurdImgBlockIcon },
        category: 'nabshow',
        keywords: [__('page'), __('featured'), __('image')],
        attributes: allAttr,
        edit: function edit(props) {
            var _props$attributes = props.attributes,
                pageSlug = _props$attributes.pageSlug,
                selection = _props$attributes.selection,
                setAttributes = props.setAttributes;


            var commonControl = wp.element.createElement(TextControl, {
                label: 'Page Slug',
                type: 'string',
                value: pageSlug,
                onChange: function onChange(slug) {
                    return setAttributes({ pageSlug: slug });
                }
            });

            if (!selection) {
                return wp.element.createElement(
                    Placeholder,
                    {
                        label: __('Featured Image'),
                        instructions: __('Enter page slug to get featured image')
                    },
                    commonControl,
                    wp.element.createElement(
                        Button,
                        { className: 'button button-large button-primary', onClick: function onClick() {
                                return setAttributes({ selection: true });
                            } },
                        __('Apply')
                    )
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
                        { title: __('Settings') },
                        commonControl
                    )
                ),
                wp.element.createElement(ServerSideRender, {
                    block: 'nab/page-featured-image',
                    attributes: { pageSlug: pageSlug }
                })
            );
        },
        save: function save() {
            return null;
        }
    });
})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);

/***/ })
/******/ ]);