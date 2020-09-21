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
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports) {

(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
  var __ = wpI18n.__;
  var Fragment = wpElement.Fragment;
  var registerBlockType = wpBlocks.registerBlockType;
  var InspectorControls = wpEditor.InspectorControls;
  var ServerSideRender = wpComponents.ServerSideRender,
      PanelBody = wpComponents.PanelBody,
      TextControl = wpComponents.TextControl;


  var formBlockIcon = wp.element.createElement(
    "svg",
    { id: "formBlockIcon", width: "150px", height: "150px", viewBox: "181 181 150 150", "enable-background": "new 181 181 150 150" },
    wp.element.createElement("path", { fill: "#D7E9FF", d: "M327.913,202.645H184.087v-4.64c0-2.575,2.064-4.64,4.64-4.64h134.547c2.575,0,4.64,2.065,4.64,4.64V202.645 z" }),
    wp.element.createElement("path", { fill: "#D7E9FF", d: "M200.325,257.919c3.851,0,6.959,3.131,6.959,6.959c0,3.851-3.108,6.959-6.959,6.959 c-3.851,0-6.959-3.108-6.959-6.959C193.366,261.05,196.475,257.919,200.325,257.919z" }),
    wp.element.createElement("path", { fill: "#D7E9FF", d: "M193.366,213.924h125.268v14.747H193.366V213.924z" }),
    wp.element.createElement("path", { fill: "#146DB6", d: "M184.087,200.32c-1.283,0-2.32-1.037-2.32-2.319c0-3.837,3.123-6.959,6.959-6.959 c1.283,0,2.32,1.037,2.32,2.32c0,1.283-1.037,2.32-2.32,2.32c-1.281,0-2.32,1.039-2.32,2.32 C186.407,199.284,185.37,200.32,184.087,200.32z" }),
    wp.element.createElement("path", { fill: "#146DB6", d: "M327.913,200.32c-1.283,0-2.319-1.037-2.319-2.319c0-1.281-1.04-2.32-2.32-2.32 c-1.282,0-2.319-1.037-2.319-2.32c0-1.283,1.037-2.32,2.319-2.32c3.837,0,6.959,3.123,6.959,6.959 C330.232,199.284,329.196,200.32,327.913,200.32z" }),
    wp.element.createElement("path", { fill: "#146DB6", d: "M323.273,195.681H188.727c-1.283,0-2.32-1.037-2.32-2.32c0-1.283,1.037-2.32,2.32-2.32h134.547 c1.283,0,2.32,1.037,2.32,2.32C325.594,194.644,324.557,195.681,323.273,195.681z" }),
    wp.element.createElement("path", { fill: "#146DB6", d: "M191.116,200.32c-1.283,0-2.331-1.037-2.331-2.319c0-1.283,1.025-2.32,2.306-2.32h0.025 c1.281,0,2.32,1.037,2.32,2.32C193.436,199.284,192.396,200.32,191.116,200.32z" }),
    wp.element.createElement("path", { fill: "#146DB6", d: "M198.073,200.32c-1.283,0-2.332-1.037-2.332-2.319c0-1.283,1.025-2.32,2.306-2.32h0.025 c1.281,0,2.32,1.037,2.32,2.32C200.393,199.284,199.354,200.32,198.073,200.32z" }),
    wp.element.createElement("path", { fill: "#146DB6", d: "M205.039,200.32c-1.283,0-2.332-1.037-2.332-2.319c0-1.283,1.025-2.32,2.306-2.32h0.025 c1.281,0,2.32,1.037,2.32,2.32C207.359,199.284,206.32,200.32,205.039,200.32z" }),
    wp.element.createElement("path", { fill: "#146DB6", d: "M184.087,320.958c-1.283,0-2.32-1.036-2.32-2.319V198.001c0-1.283,1.037-2.32,2.32-2.32 s2.32,1.037,2.32,2.32v120.638C186.407,319.922,185.37,320.958,184.087,320.958z" }),
    wp.element.createElement("path", { fill: "#146DB6", d: "M327.913,320.958c-1.283,0-2.319-1.036-2.319-2.319V198.001c0-1.283,1.036-2.32,2.319-2.32 s2.319,1.037,2.319,2.32v120.638C330.232,319.922,329.196,320.958,327.913,320.958z" }),
    wp.element.createElement("path", { fill: "#146DB6", d: "M327.913,204.96H184.087c-1.283,0-2.32-1.037-2.32-2.32c0-1.283,1.037-2.32,2.32-2.32h143.826 c1.283,0,2.319,1.037,2.319,2.32C330.232,203.923,329.196,204.96,327.913,204.96z" }),
    wp.element.createElement("path", { fill: "#146DB6", d: "M327.913,320.958H184.087c-1.283,0-2.32-1.036-2.32-2.319s1.037-2.32,2.32-2.32h143.826 c1.283,0,2.319,1.037,2.319,2.32S329.196,320.958,327.913,320.958z" }),
    wp.element.createElement("path", { fill: "#146DB6", d: "M200.325,274.176c-5.117,0-9.279-4.162-9.279-9.279s4.162-9.279,9.279-9.279 c5.118,0,9.279,4.162,9.279,9.279S205.443,274.176,200.325,274.176z M200.325,260.257c-2.559,0-4.64,2.081-4.64,4.64 s2.081,4.64,4.64,4.64c2.559,0,4.64-2.081,4.64-4.64S202.884,260.257,200.325,260.257z" }),
    wp.element.createElement("path", { fill: "#146DB6", d: "M200.395,267.214c-1.283,0-2.332-1.037-2.332-2.319c0-1.283,1.025-2.32,2.306-2.32h0.026 c1.28,0,2.32,1.037,2.32,2.32C202.715,266.177,201.675,267.214,200.395,267.214z" }),
    wp.element.createElement("path", { fill: "#146DB6", d: "M318.634,235.5H193.366c-1.283,0-2.32-1.526-2.32-3.415v-17.069c0-1.889,1.037-3.415,2.32-3.415h125.268 c1.283,0,2.32,1.526,2.32,3.415v17.069C320.954,233.974,319.917,235.5,318.634,235.5z M195.686,228.671h120.629v-10.24H195.686 V228.671z" }),
    wp.element.createElement("path", { fill: "#146DB6", d: "M249.022,262.574h-32.458c-1.283,0-2.32-1.037-2.32-2.319c0-1.283,1.037-2.32,2.32-2.32h32.458 c1.283,0,2.32,1.037,2.32,2.32C251.342,261.537,250.305,262.574,249.022,262.574z" }),
    wp.element.createElement("path", { fill: "#146DB6", d: "M232.768,269.534h-16.204c-1.283,0-2.32-1.037-2.32-2.32s1.037-2.319,2.32-2.319h16.204 c1.283,0,2.32,1.036,2.32,2.319S234.05,269.534,232.768,269.534z" }),
    wp.element.createElement("path", { fill: "#146DB6", d: "M269.928,274.176c-5.117,0-9.279-4.162-9.279-9.279s4.162-9.279,9.279-9.279s9.279,4.162,9.279,9.279 S275.045,274.176,269.928,274.176z M269.928,260.257c-2.559,0-4.64,2.081-4.64,4.64s2.081,4.64,4.64,4.64s4.64-2.081,4.64-4.64 S272.484,260.257,269.928,260.257z" }),
    wp.element.createElement("path", { fill: "#146DB6", d: "M318.625,262.574h-32.459c-1.282,0-2.319-1.037-2.319-2.319c0-1.283,1.037-2.32,2.319-2.32h32.459 c1.282,0,2.319,1.037,2.319,2.32C320.944,261.537,319.907,262.574,318.625,262.574z" }),
    wp.element.createElement("path", { fill: "#146DB6", d: "M302.37,269.534h-16.204c-1.282,0-2.319-1.037-2.319-2.32s1.037-2.319,2.319-2.319h16.204 c1.282,0,2.319,1.036,2.319,2.319S303.652,269.534,302.37,269.534z" }),
    wp.element.createElement("path", { fill: "#146DB6", d: "M281.518,306.675h-51.035c-1.283,0-2.32-1.037-2.32-2.32c0-1.282,1.037-2.319,2.32-2.319h51.035 c1.283,0,2.319,1.037,2.319,2.319C283.837,305.638,282.801,306.675,281.518,306.675z" }),
    wp.element.createElement("path", { fill: "#146DB6", d: "M281.518,292.758h-51.035c-1.283,0-2.32-1.037-2.32-2.319c0-1.283,1.037-2.32,2.32-2.32h51.035 c1.283,0,2.319,1.037,2.319,2.32C283.837,291.721,282.801,292.758,281.518,292.758z" }),
    wp.element.createElement("path", { fill: "#146DB6", d: "M230.489,306.675c-5.115,0-9.276-4.162-9.276-9.279c0-5.115,4.161-9.277,9.276-9.277 c1.283,0,2.32,1.037,2.32,2.32c0,1.282-1.037,2.319-2.32,2.319c-2.559,0-4.637,2.079-4.637,4.638s2.079,4.64,4.637,4.64 c1.283,0,2.32,1.037,2.32,2.319C232.809,305.638,231.772,306.675,230.489,306.675z" }),
    wp.element.createElement("path", { fill: "#146DB6", d: "M281.513,306.675c-1.283,0-2.319-1.037-2.319-2.32c0-1.282,1.036-2.319,2.319-2.319 c2.559,0,4.638-2.079,4.638-4.638s-2.079-4.64-4.638-4.64c-1.283,0-2.319-1.037-2.319-2.319c0-1.283,1.036-2.32,2.319-2.32 c5.115,0,9.277,4.162,9.277,9.279C290.79,302.513,286.628,306.675,281.513,306.675z" })
  );

  var allAttr = {
    formEmail: {
      type: 'string',
      default: ''
    }
  };

  registerBlockType('nab/lead-gen-form', {
    title: __('Lead Gen Form'),
    icon: { src: formBlockIcon },
    category: 'nabshow',
    keywords: [__('lead'), __('gen'), __('form')],
    attributes: allAttr,
    edit: function edit(_ref) {
      var attributes = _ref.attributes,
          setAttributes = _ref.setAttributes;
      var formEmail = attributes.formEmail;

      return wp.element.createElement(
        Fragment,
        null,
        wp.element.createElement(
          InspectorControls,
          null,
          wp.element.createElement(
            PanelBody,
            { title: __('Form Settings') },
            wp.element.createElement(TextControl, {
              type: "string",
              label: __('Send Copy To:'),
              value: formEmail,
              onChange: function onChange(email) {
                return setAttributes({ formEmail: email });
              }
            })
          )
        ),
        wp.element.createElement(ServerSideRender, {
          block: "nab/lead-gen-form"
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