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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

var root = __webpack_require__(21);

/** Built-in value references. */
var Symbol = root.Symbol;

module.exports = Symbol;


/***/ }),
/* 1 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__block_multipurpose_gutenberg_block_block__ = __webpack_require__(2);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__block_feature_block__ = __webpack_require__(4);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__block_feature_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1__block_feature_block__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__block_image_block__ = __webpack_require__(5);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__block_image_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_2__block_image_block__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__block_upcoming_events_calendar_block__ = __webpack_require__(6);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__block_upcoming_events_calendar_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_3__block_upcoming_events_calendar_block__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__block_related_content_block__ = __webpack_require__(7);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__block_related_content_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_4__block_related_content_block__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__block_related_content_2_block__ = __webpack_require__(8);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__block_related_content_2_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_5__block_related_content_2_block__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6__block_community_curator_block__ = __webpack_require__(9);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6__block_community_curator_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_6__block_community_curator_block__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_7__block_tabs_block__ = __webpack_require__(10);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_8__block_trending_activity_block__ = __webpack_require__(29);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_8__block_trending_activity_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_8__block_trending_activity_block__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_9__block_company_details_block__ = __webpack_require__(30);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_9__block_company_details_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_9__block_company_details_block__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_10__block_company_products_block__ = __webpack_require__(31);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_10__block_company_products_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_10__block_company_products_block__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_11__block_company_events_block__ = __webpack_require__(32);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_11__block_company_events_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_11__block_company_events_block__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_12__block_company_content_block__ = __webpack_require__(33);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_12__block_company_content_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_12__block_company_content_block__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_13__block_company_employees_block__ = __webpack_require__(34);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_13__block_company_employees_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_13__block_company_employees_block__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_14__block_company_feature_block__ = __webpack_require__(35);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_14__block_company_feature_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_14__block_company_feature_block__);
// import all blocks here
















/***/ }),
/* 2 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_classnames__ = __webpack_require__(3);
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
    {
      xmlns: "http://www.w3.org/2000/svg",
      width: "20px",
      height: "20px",
      viewBox: "0 0 612 612"
    },
    wp.element.createElement(
      "g",
      null,
      wp.element.createElement("path", {
        fill: "#00527d",
        d: "M1.659,484.737L1.001,206.595c-0.032-13.686,13.95-22.938,26.534-17.559l253.206,108.241c6.997,2.991,11.542,9.859,11.56,17.468l0.658,278.142c0.032,13.687-13.95,22.939-26.534,17.56L13.219,502.206C6.222,499.215,1.676,492.347,1.659,484.737z M581.805,219.687L348.142,320.883l0.608,257.406l233.664-101.196L581.805,219.687 M591.26,186.131c10.043-0.025,19.056,8.054,19.081,19.022l0.658,278.142c0.018,7.609-4.495,14.5-11.478,17.523l-252.69,109.438c-2.493,1.079-5.047,1.583-7.534,1.59c-10.044,0.023-19.058-8.055-19.083-19.022l-0.658-278.143c-0.019-7.609,4.495-14.5,11.479-17.523l252.69-109.437C586.218,186.64,588.771,186.137,591.26,186.131L591.26,186.131z M304.152,29.466L61.767,137.691l242.894,107.075l242.386-108.224L304.152,29.466 M304.083,0c2.632-0.006,5.266,0.533,7.728,1.618l266.403,117.439c15.112,6.663,15.163,28.088,0.082,34.821L312.451,272.577c-2.456,1.097-5.088,1.648-7.721,1.655c-2.632,0.006-5.266-0.533-7.728-1.618L30.6,155.175c-15.113-6.662-15.163-28.088-0.083-34.821L296.361,1.655C298.818,0.558,301.449,0.006,304.083,0L304.083,0z"
      })
    )
  );

  /*
   **   Block: MultiPurpose Gutenberg Block
   */
  registerBlockType("md/multipurpose-gutenberg-block", {
    title: __("Multi Purpose Block"),
    description: __("Use one block containing multiple elements."),
    icon: multipleBlockIcon,
    category: "nab_amplify",
    attributes: {
      ElementTag: {
        type: "string",
        default: "div"
      },
      elementID: {
        type: "string"
      },
      backgroundImage: {
        type: "string",
        default: ""
      },
      backgroundColor: {
        type: "string",
        default: ""
      },
      backgroundSize: {
        type: "string",
        default: "cover"
      },
      backgroundRepeat: {
        type: "boolean",
        default: false
      },
      backgroundPosition: {
        type: "string",
        default: ""
      },
      backgroundAttachment: {
        type: "boolean",
        default: false
      },
      layout: {
        type: "string",
        default: ""
      },
      borderStyle: {
        type: "string",
        default: ""
      },
      borderWidth: {
        type: "number"
      },
      borderColor: {
        type: "string"
      },
      borderRadius: {
        type: "number"
      },
      topBorderStyle: {
        type: "string",
        default: ""
      },
      topBorderWidth: {
        type: "number"
      },
      topBorderColor: {
        type: "string"
      },
      topBorderRadius: {
        type: "number"
      },
      bottomBorderStyle: {
        type: "string",
        default: ""
      },
      bottomBorderWidth: {
        type: "number"
      },
      bottomBorderColor: {
        type: "string"
      },
      bottomBorderRadius: {
        type: "number"
      },
      rightBorderStyle: {
        type: "string",
        default: ""
      },
      rightBorderWidth: {
        type: "number"
      },
      rightBorderColor: {
        type: "string"
      },
      rightBorderRadius: {
        type: "number"
      },
      leftBorderStyle: {
        type: "string",
        default: ""
      },
      leftBorderWidth: {
        type: "number"
      },
      leftBorderColor: {
        type: "string"
      },
      leftBorderRadius: {
        type: "number"
      },
      blockAlign: {
        type: "string",
        default: "center"
      },
      textAlign: {
        type: "string",
        default: ""
      },
      width: {
        type: "string",
        default: ""
      },
      height: {
        type: "string",
        default: ""
      },
      opacity: {
        type: "number",
        default: 0
      },
      overlayColor: {
        type: "string"
      },
      paddingTop: {
        type: "string",
        default: ""
      },
      paddingRight: {
        type: "string",
        default: ""
      },
      paddingBottom: {
        type: "string",
        default: ""
      },
      paddingLeft: {
        type: "string",
        default: ""
      },
      marginTop: {
        type: "string",
        default: ""
      },
      marginRight: {
        type: "string",
        default: ""
      },
      marginBottom: {
        type: "string",
        default: ""
      },
      marginLeft: {
        type: "string",
        default: ""
      },
      gradientRange1: {
        type: "number",
        default: 0
      },
      gradientRange2: {
        type: "number",
        default: 0
      },
      gradientRange3: {
        type: "number",
        default: 0
      },
      color1: {
        type: "string",
        default: "#fff"
      },
      color2: {
        type: "string",
        default: "#fff"
      },
      color3: {
        type: "string",
        default: "#fff"
      },
      gradientType: {
        type: "string",
        default: ""
      },
      ToggleInserter: {
        type: "boolean",
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
          backgroundRepeat = attributes.backgroundRepeat,
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
        "components-button button has-tooltip active" === selectedClass && setAttributes({ layout: "" });
        "components-button button has-tooltip active" !== selectedClass && setAttributes({ layout: selectedLayout ? selectedLayout : "" });
      };

      var onSelectTagType = function onSelectTagType(event) {
        setAttributes({
          ElementTag: event.target.value ? event.target.value : "div"
        });
      };

      var classes = __WEBPACK_IMPORTED_MODULE_0_classnames___default()(className, layout && "has-" + layout, blockAlign && "is-block-" + blockAlign, width && "has-custom-width", {
        "has-background-attachment": backgroundAttachment,
        "has-background-opacity": 0 !== opacity
      }, opacityRatioToClass(opacity));
      var style = {};
      backgroundImage && (style.backgroundImage = "url(" + backgroundImage + ")");
      backgroundColor && (style.backgroundColor = backgroundColor);
      backgroundPosition && (style.backgroundPosition = backgroundPosition);
      backgroundRepeat && (style.backgroundRepeat = "no-repeat");
      backgroundSize && (style.backgroundSize = backgroundSize);
      textAlign && (style.textAlign = textAlign);
      width && (style.width = width + "%");
      height && (style.height = height + "px");
      overlayColor && (style.backgroundColor = overlayColor);
      paddingTop && (style.paddingTop = paddingTop + "px");
      paddingRight && (style.paddingRight = paddingRight + "px");
      paddingBottom && (style.paddingBottom = paddingBottom + "px");
      paddingLeft && (style.paddingLeft = paddingLeft + "px");
      marginTop && (style.marginTop = marginTop + "px");
      marginRight && (style.marginRight = marginRight + "px");
      marginBottom && (style.marginBottom = marginBottom + "px");
      marginLeft && (style.marginLeft = marginLeft + "px");
      gradientType && ("#fff" !== color1 || "#fff" !== color2 || "#fff" !== color3) && (style.background = "linear-gradient(" + gradientType + ", " + color1 + " " + gradientRange1 + "%, " + color2 + " " + gradientRange2 + "%, " + color3 + " " + gradientRange3 + "%)");

      marginTop && (style.marginTop = marginTop + "px");
      if (borderStyle) {
        style.borderStyle = borderStyle;
        if (borderWidth) {
          style.borderWidth = borderWidth + "px";
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
            style.borderTopWidth = topBorderWidth + "px";
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
            style.borderBottomWidth = bottomBorderWidth + "px";
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
            style.borderRightWidth = rightBorderWidth + "px";
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
            style.borderLeftWidth = leftBorderWidth + "px";
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
            PanelBody,
            { title: __("Wrapper"), initialOpen: false },
            wp.element.createElement(
              Button,
              {
                className: "header" === ElementTag ? "button active" : "button",
                onClick: onSelectTagType,
                value: "header"
              },
              __("Header")
            ),
            wp.element.createElement(
              Button,
              {
                className: "section" === ElementTag ? "button active" : "button",
                onClick: onSelectTagType,
                value: "section"
              },
              __("Section")
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
            { title: __("Page Layout"), initialOpen: false },
            wp.element.createElement(
              Button,
              {
                className: "full" === layout ? "button has-tooltip active" : "button has-tooltip",
                onClick: onSelectLayout,
                "data-tooltip": "This layout is for full width (width:100%).",
                value: "full"
              },
              __("Full Width")
            ),
            wp.element.createElement(
              Button,
              {
                className: "fixed" === layout ? "button has-tooltip active" : "button has-tooltip",
                onClick: onSelectLayout,
                "data-tooltip": "This layout is for fixed width (width:1200px).",
                value: "fixed"
              },
              __("Fixed")
            ),
            wp.element.createElement(
              Button,
              {
                className: "semi" === layout ? "button has-tooltip active" : "button has-tooltip",
                onClick: onSelectLayout,
                "data-tooltip": "This layout is for Semi width (max-width:700px).",
                value: "semi"
              },
              __("Semi")
            )
          ),
          wp.element.createElement(
            PanelBody,
            {
              title: __("Background"),
              initialOpen: false,
              className: "bg-setting"
            },
            wp.element.createElement(
              PanelBody,
              {
                title: __("Background Image"),
                initialOpen: false,
                className: "bg-setting bg-img-setting"
              },
              wp.element.createElement(MediaUpload, {
                onSelect: function onSelect(backgroundImage) {
                  return setAttributes({
                    backgroundImage: backgroundImage.sizes.full.url ? backgroundImage.sizes.full.url : "",
                    backgroundColor: ""
                  });
                },
                type: "image",
                value: backgroundImage,
                render: function render(_ref) {
                  var open = _ref.open;
                  return wp.element.createElement(
                    Button,
                    {
                      className: backgroundImage ? "image-button" : "button button-large",
                      onClick: open
                    },
                    !backgroundImage ? __("Upload Image") : wp.element.createElement("div", {
                      style: {
                        backgroundImage: "url(" + backgroundImage + ")",
                        backgroundSize: "cover",
                        backgroundPosition: "center",
                        height: "150px",
                        width: "225px"
                      }
                    })
                  );
                }
              }),
              backgroundImage ? wp.element.createElement(
                Button,
                {
                  className: "button",
                  onClick: function onClick() {
                    return setAttributes({ backgroundImage: "", overlayColor: "" });
                  }
                },
                __("Remove Background Image")
              ) : null,
              backgroundImage && wp.element.createElement(
                Fragment,
                null,
                wp.element.createElement(ToggleControl, {
                  label: __('Background Attachment ON - Set background attachment "Fixed" '),
                  checked: backgroundAttachment,
                  onChange: function onChange() {
                    return setAttributes({
                      backgroundAttachment: !backgroundAttachment
                    });
                  }
                }),
                wp.element.createElement(ToggleControl, {
                  label: __("Background Repeat "),
                  checked: backgroundRepeat,
                  onChange: function onChange() {
                    return setAttributes({
                      backgroundRepeat: !backgroundRepeat
                    });
                  }
                }),
                wp.element.createElement(SelectControl, {
                  label: "background size",
                  value: backgroundSize,
                  options: [{ label: __("auto"), value: "auto" }, { label: __("cover"), value: "cover" }, { label: __("contain"), value: "contain" }, { label: __("initial"), value: "initial" }, { label: __("inherit"), value: "inherit" }],
                  onChange: function onChange(value) {
                    setAttributes({
                      backgroundSize: value
                    });
                  }
                }),
                wp.element.createElement(SelectControl, {
                  label: __("Select Position"),
                  value: backgroundPosition,
                  options: [{ label: __("inherit"), value: "inherit" }, { label: __("initial"), value: "initial" }, { label: __("bottom"), value: "bottom" }, { label: __("center"), value: "center" }, { label: __("left"), value: "left" }, { label: __("right"), value: "right" }, { label: __("top"), value: "top" }, { label: __("unset"), value: "unset" }, { label: __("center center"), value: "center center" }, { label: __("left top"), value: "left top" }, { label: __("left center"), value: "left center" }, { label: __("left bottom"), value: "left bottom" }, { label: __("right top"), value: "right top" }, { label: __("right center"), value: "right center" }, { label: __("right bottom"), value: "right bottom" }, { label: __("center top"), value: "center top" }, { label: __("center bottom"), value: "center bottom" }],
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
              {
                title: __("Background Color"),
                initialOpen: false,
                className: "bg-setting"
              },
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
                        return setAttributes({
                          backgroundColor: value ? value : "",
                          opacity: 0
                        });
                      }
                    })
                  )
                )
              )
            ),
            wp.element.createElement(
              PanelBody,
              {
                title: __("Gradient Background"),
                initialOpen: false,
                className: "bg-setting gredient-setting"
              },
              wp.element.createElement(SelectControl, {
                label: __("Select Gradient Type"),
                value: gradientType,
                options: [{ label: __("Select Type"), value: "" }, { label: __("bottom"), value: "to bottom" }, { label: __("Top"), value: "to top" }, { label: __("Right"), value: "to right" }, { label: __("Left"), value: "to left" }, { label: __("Top Left"), value: "to top left" }, { label: __("Bottom Left"), value: "to bottom left" }, { label: __("Top Right"), value: "to top right" }, { label: __("Bottom Right"), value: "to bottom right" }],
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
                  __("Gradient Fill 1")
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
                        return setAttributes({ color1: value ? value : "#fff" });
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
                  __("Gradient Fill 2")
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
                        return setAttributes({ color2: value ? value : "#fff" });
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
                  __("Gradient Fill 3")
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
                        return setAttributes({ color3: value ? value : "#fff" });
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
            {
              title: __("Border"),
              initialOpen: false,
              className: "border-setting"
            },
            wp.element.createElement(
              PanelBody,
              {
                title: __("All Border"),
                initialOpen: false,
                className: "border-setting"
              },
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
                      {
                        className: "solid" === borderStyle ? "active inspector-button" : " inspector-button",
                        onClick: function onClick() {
                          return setAttributes({ borderStyle: "solid" });
                        }
                      },
                      wp.element.createElement("span", { className: "inspector-field-border-type inspector-field-border-type-solid" })
                    ),
                    wp.element.createElement(
                      "button",
                      {
                        className: "dotted" === borderStyle ? "active inspector-button" : " inspector-button",
                        onClick: function onClick() {
                          return setAttributes({ borderStyle: "dotted" });
                        }
                      },
                      wp.element.createElement("span", { className: "inspector-field-border-type inspector-field-border-type-dotted" })
                    ),
                    wp.element.createElement(
                      "button",
                      {
                        className: "dashed" === borderStyle ? "active inspector-button" : " inspector-button",
                        onClick: function onClick() {
                          return setAttributes({ borderStyle: "dashed" });
                        }
                      },
                      wp.element.createElement("span", { className: "inspector-field-border-type inspector-field-border-type-dashed" })
                    ),
                    wp.element.createElement(
                      "button",
                      {
                        className: "none" === borderStyle ? "active inspector-button" : " inspector-button",
                        onClick: function onClick() {
                          return setAttributes({ borderStyle: "none" });
                        }
                      },
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
              {
                title: __("Top Border"),
                initialOpen: false,
                className: "border-setting"
              },
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
                      {
                        className: "solid" === topBorderStyle ? "active inspector-button" : " inspector-button",
                        onClick: function onClick() {
                          return setAttributes({ topBorderStyle: "solid" });
                        }
                      },
                      wp.element.createElement("span", { className: "inspector-field-border-type inspector-field-border-type-solid" })
                    ),
                    wp.element.createElement(
                      "button",
                      {
                        className: "dotted" === topBorderStyle ? "active inspector-button" : " inspector-button",
                        onClick: function onClick() {
                          return setAttributes({ topBorderStyle: "dotted" });
                        }
                      },
                      wp.element.createElement("span", { className: "inspector-field-border-type inspector-field-border-type-dotted" })
                    ),
                    wp.element.createElement(
                      "button",
                      {
                        className: "dashed" === topBorderStyle ? "active inspector-button" : " inspector-button",
                        onClick: function onClick() {
                          return setAttributes({ topBorderStyle: "dashed" });
                        }
                      },
                      wp.element.createElement("span", { className: "inspector-field-border-type inspector-field-border-type-dashed" })
                    ),
                    wp.element.createElement(
                      "button",
                      {
                        className: "none" === topBorderStyle ? "active inspector-button" : " inspector-button",
                        onClick: function onClick() {
                          return setAttributes({ borderStyle: "none" });
                        }
                      },
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
                          return setAttributes({
                            topBorderColor: topBorderColor
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
              {
                title: __("Right Border"),
                initialOpen: false,
                className: "border-setting"
              },
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
                      {
                        className: "solid" === rightBorderStyle ? "active inspector-button" : " inspector-button",
                        onClick: function onClick() {
                          return setAttributes({ rightBorderStyle: "solid" });
                        }
                      },
                      wp.element.createElement("span", { className: "inspector-field-border-type inspector-field-border-type-solid" })
                    ),
                    wp.element.createElement(
                      "button",
                      {
                        className: "dotted" === rightBorderStyle ? "active inspector-button" : " inspector-button",
                        onClick: function onClick() {
                          return setAttributes({ rightBorderStyle: "dotted" });
                        }
                      },
                      wp.element.createElement("span", { className: "inspector-field-border-type inspector-field-border-type-dotted" })
                    ),
                    wp.element.createElement(
                      "button",
                      {
                        className: "dashed" === rightBorderStyle ? "active inspector-button" : " inspector-button",
                        onClick: function onClick() {
                          return setAttributes({ rightBorderStyle: "dashed" });
                        }
                      },
                      wp.element.createElement("span", { className: "inspector-field-border-type inspector-field-border-type-dashed" })
                    ),
                    wp.element.createElement(
                      "button",
                      {
                        className: "none" === rightBorderStyle ? "active inspector-button" : " inspector-button",
                        onClick: function onClick() {
                          return setAttributes({ borderStyle: "none" });
                        }
                      },
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
                          return setAttributes({
                            rightBorderColor: rightBorderColor
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
              {
                title: __("Bottom Border"),
                initialOpen: false,
                className: "border-setting"
              },
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
                      {
                        className: "solid" === bottomBorderStyle ? "active inspector-button" : " inspector-button",
                        onClick: function onClick() {
                          return setAttributes({ bottomBorderStyle: "solid" });
                        }
                      },
                      wp.element.createElement("span", { className: "inspector-field-border-type inspector-field-border-type-solid" })
                    ),
                    wp.element.createElement(
                      "button",
                      {
                        className: "dotted" === bottomBorderStyle ? "active inspector-button" : " inspector-button",
                        onClick: function onClick() {
                          return setAttributes({ bottomBorderStyle: "dotted" });
                        }
                      },
                      wp.element.createElement("span", { className: "inspector-field-border-type inspector-field-border-type-dotted" })
                    ),
                    wp.element.createElement(
                      "button",
                      {
                        className: "dashed" === bottomBorderStyle ? "active inspector-button" : " inspector-button",
                        onClick: function onClick() {
                          return setAttributes({ bottomBorderStyle: "dashed" });
                        }
                      },
                      wp.element.createElement("span", { className: "inspector-field-border-type inspector-field-border-type-dashed" })
                    ),
                    wp.element.createElement(
                      "button",
                      {
                        className: "none" === bottomBorderStyle ? "active inspector-button" : " inspector-button",
                        onClick: function onClick() {
                          return setAttributes({ borderStyle: "none" });
                        }
                      },
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
                          return setAttributes({
                            bottomBorderColor: bottomBorderColor
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
              {
                title: __("Left Border"),
                initialOpen: false,
                className: "border-setting"
              },
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
                      {
                        className: "solid" === leftBorderStyle ? "active inspector-button" : " inspector-button",
                        onClick: function onClick() {
                          return setAttributes({ leftBorderStyle: "solid" });
                        }
                      },
                      wp.element.createElement("span", { className: "inspector-field-border-type inspector-field-border-type-solid" })
                    ),
                    wp.element.createElement(
                      "button",
                      {
                        className: "dotted" === leftBorderStyle ? "active inspector-button" : " inspector-button",
                        onClick: function onClick() {
                          return setAttributes({ leftBorderStyle: "dotted" });
                        }
                      },
                      wp.element.createElement("span", { className: "inspector-field-border-type inspector-field-border-type-dotted" })
                    ),
                    wp.element.createElement(
                      "button",
                      {
                        className: "dashed" === leftBorderStyle ? "active inspector-button" : " inspector-button",
                        onClick: function onClick() {
                          return setAttributes({ leftBorderStyle: "dashed" });
                        }
                      },
                      wp.element.createElement("span", { className: "inspector-field-border-type inspector-field-border-type-dashed" })
                    ),
                    wp.element.createElement(
                      "button",
                      {
                        className: "none" === leftBorderStyle ? "active inspector-button" : " inspector-button",
                        onClick: function onClick() {
                          return setAttributes({ borderStyle: "none" });
                        }
                      },
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
                          return setAttributes({
                            leftBorderColor: leftBorderColor
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
            { title: __("Dimensions"), initialOpen: false },
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
                    {
                      className: "none" === blockAlign ? "active inspector-button" : " inspector-button",
                      onClick: function onClick() {
                        return setAttributes({ blockAlign: "none" });
                      }
                    },
                    wp.element.createElement("i", { className: "fa fa-ban" })
                  ),
                  wp.element.createElement(
                    "button",
                    {
                      className: "lowercase" === blockAlign ? "active inspector-button" : " inspector-button",
                      onClick: function onClick() {
                        return setAttributes({ blockAlign: "lowercase" });
                      }
                    },
                    wp.element.createElement(
                      "span",
                      null,
                      "aa"
                    )
                  ),
                  wp.element.createElement(
                    "button",
                    {
                      className: "capitalize" === blockAlign ? "active inspector-button" : " inspector-button",
                      onClick: function onClick() {
                        return setAttributes({ blockAlign: "capitalize" });
                      }
                    },
                    wp.element.createElement(
                      "span",
                      null,
                      "Aa"
                    )
                  ),
                  wp.element.createElement(
                    "button",
                    {
                      className: "uppercase" === blockAlign ? "active inspector-button" : " inspector-button",
                      onClick: function onClick() {
                        return setAttributes({ blockAlign: "uppercase" });
                      }
                    },
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
                    {
                      className: "left" === textAlign ? "active inspector-button" : " inspector-button",
                      onClick: function onClick() {
                        return setAttributes({ textAlign: "left" });
                      }
                    },
                    wp.element.createElement("i", { className: "fa fa-align-left" })
                  ),
                  wp.element.createElement(
                    "button",
                    {
                      className: "center" === textAlign ? "active inspector-button" : " inspector-button",
                      onClick: function onClick() {
                        return setAttributes({ textAlign: "center" });
                      }
                    },
                    wp.element.createElement("i", { className: "fa fa-align-center" })
                  ),
                  wp.element.createElement(
                    "button",
                    {
                      className: "right" === textAlign ? "active inspector-button" : " inspector-button",
                      onClick: function onClick() {
                        return setAttributes({ textAlign: "right" });
                      }
                    },
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
                      {
                        className: "padd-top col-main-inner",
                        "data-tooltip": "padding Top"
                      },
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
                      {
                        className: "padd-buttom col-main-inner",
                        "data-tooltip": "padding Bottom"
                      },
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
                      {
                        className: "padd-left col-main-inner",
                        "data-tooltip": "padding Left"
                      },
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
                      {
                        className: "padd-right col-main-inner",
                        "data-tooltip": "padding Right"
                      },
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
                      {
                        className: "padd-top col-main-inner",
                        "data-tooltip": "margin Top"
                      },
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
                      {
                        className: "padd-buttom col-main-inner",
                        "data-tooltip": "margin Bottom"
                      },
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
                      {
                        className: "padd-left col-main-inner",
                        "data-tooltip": "margin Left"
                      },
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
                      {
                        className: "padd-right col-main-inner",
                        "data-tooltip": "margin Right"
                      },
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
        {
          id: elementID,
          className: classes + " " + (ToggleInserter ? "md-inserter-on" : "md-inserter-off"),
          style: style
        },
        wp.element.createElement(InnerBlocks, null)
      )];
    },
    save: function save(props) {
      var attributes = props.attributes,
          className = props.className;
      var backgroundImage = attributes.backgroundImage,
          backgroundColor = attributes.backgroundColor,
          backgroundSize = attributes.backgroundSize,
          backgroundRepeat = attributes.backgroundRepeat,
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

      var classes = __WEBPACK_IMPORTED_MODULE_0_classnames___default()(className, layout && "has-" + layout, blockAlign && "is-block-" + blockAlign, width && "has-custom-width", {
        "has-background-attachment": backgroundAttachment,
        "has-background-opacity": 0 !== opacity
      }, opacityRatioToClass(opacity));
      var style = {};
      backgroundImage && (style.backgroundImage = "url(" + backgroundImage + ")");
      backgroundColor && (style.backgroundColor = backgroundColor);
      backgroundPosition && (style.backgroundPosition = backgroundPosition);
      backgroundRepeat && (style.backgroundRepeat = "no-repeat");
      backgroundSize && (style.backgroundSize = backgroundSize);
      textAlign && (style.textAlign = textAlign);
      width && (style.width = width + "%");
      height && (style.height = height + "px");
      overlayColor && (style.backgroundColor = overlayColor);
      paddingTop && (style.paddingTop = paddingTop + "px");
      paddingRight && (style.paddingRight = paddingRight + "px");
      paddingBottom && (style.paddingBottom = paddingBottom + "px");
      paddingLeft && (style.paddingLeft = paddingLeft + "px");
      marginTop && (style.marginTop = marginTop + "px");
      marginRight && (style.marginRight = marginRight + "px");
      marginBottom && (style.marginBottom = marginBottom + "px");
      marginLeft && (style.marginLeft = marginLeft + "px");
      gradientType && ("#fff" !== color1 || "#fff" !== color2 || "#fff" !== color3) && (style.background = "linear-gradient(" + gradientType + ", " + color1 + " " + gradientRange1 + "%, " + color2 + " " + gradientRange2 + "%, " + color3 + " " + gradientRange3 + "%)");
      marginTop && (style.marginTop = marginTop + "px");
      if (borderStyle) {
        style.borderStyle = borderStyle;
        if (borderWidth) {
          style.borderWidth = borderWidth + "px";
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
            style.borderTopWidth = topBorderWidth + "px";
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
            style.borderBottomWidth = bottomBorderWidth + "px";
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
            style.borderRightWidth = rightBorderWidth + "px";
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
            style.borderLeftWidth = leftBorderWidth + "px";
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
  return 0 === ratio ? null : "has-background-opacity-" + 10 * Math.round(ratio / 10);
}

/***/ }),
/* 3 */
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
/* 4 */
/***/ (function(module, exports) {

;(function (wpI18n, wpBlocks, wpBlockEditor, wpComponents, wpElement) {
  var __ = wpI18n.__;
  var registerBlockType = wpBlocks.registerBlockType;
  var Fragment = wpElement.Fragment;
  var RichText = wpBlockEditor.RichText,
      InspectorControls = wpBlockEditor.InspectorControls,
      ColorPalette = wpBlockEditor.ColorPalette,
      MediaUpload = wpBlockEditor.MediaUpload,
      AlignmentToolbar = wpBlockEditor.AlignmentToolbar;
  var PanelBody = wpComponents.PanelBody,
      Button = wpComponents.Button,
      ToggleControl = wpComponents.ToggleControl,
      SelectControl = wpComponents.SelectControl,
      TextControl = wpComponents.TextControl;


  registerBlockType('rg/feature', {
    // built in attributes
    title: __('Feature'),
    description: __('Feature Block'),
    icon: 'editor-code',
    category: 'nab_amplify',
    keywords: [__('Feature'), __('Gutenberg')],
    attributes: {
      backgroundColor: {
        type: 'string',
        default: '#303030'
      },
      backgroundImage: {
        type: 'string',
        default: ''
      },
      backgroundSize: {
        type: 'string',
        default: 'cover'
      },
      backgroundRepeat: {
        type: 'boolean',
        default: false
      },
      backgroundPosition: {
        type: 'string',
        default: ''
      },
      featureIcon: {
        type: 'string',
        default: ''
      },
      featureIconLink: {
        type: 'url',
        default: ''
      },
      featureIconLinkTarget: {
        type: 'Boolean',
        default: false
      },
      featureStatusTitle: {
        type: 'string',
        default: ''
      },
      featureStatusColor: {
        type: 'string',
        default: '#e5018b'
      },
      featureTitle: {
        type: 'string',
        default: ''
      },
      featureTitleColor: {
        type: 'string',
        default: '#fff'
      },
      featureAuthor: {
        type: 'string',
        default: ''
      },
      featureAuthorColor: {
        type: 'string',
        default: '#fdd80f'
      },
      featureDisc: {
        type: 'string',
        default: ''
      },
      featureDiscColor: {
        type: 'string',
        default: '#fff'
      },
      shortcode: {
        type: 'string',
        default: ''
      },
      featureLikeToggle: {
        type: 'Boolean',
        default: false
      },
      featureJoinBtn: {
        type: 'string',
        default: 'Button'
      },
      featureJoinToggle: {
        type: 'Boolean',
        default: false
      },
      featureJoinBtnLink: {
        type: 'string',
        default: '#'
      },
      featureJoinBtnTarget: {
        type: 'Boolean',
        default: false
      }
    },
    edit: function edit(_ref) {
      var attributes = _ref.attributes,
          setAttributes = _ref.setAttributes;
      var backgroundColor = attributes.backgroundColor,
          backgroundImage = attributes.backgroundImage,
          backgroundSize = attributes.backgroundSize,
          backgroundRepeat = attributes.backgroundRepeat,
          backgroundPosition = attributes.backgroundPosition,
          featureIcon = attributes.featureIcon,
          featureIconLink = attributes.featureIconLink,
          featureIconLinkTarget = attributes.featureIconLinkTarget,
          featureStatusTitle = attributes.featureStatusTitle,
          featureStatusColor = attributes.featureStatusColor,
          featureTitle = attributes.featureTitle,
          featureTitleColor = attributes.featureTitleColor,
          featureAuthor = attributes.featureAuthor,
          featureAuthorColor = attributes.featureAuthorColor,
          featureDisc = attributes.featureDisc,
          featureDiscColor = attributes.featureDiscColor,
          shortcode = attributes.shortcode,
          featureLikeToggle = attributes.featureLikeToggle,
          featureJoinBtn = attributes.featureJoinBtn,
          featureJoinToggle = attributes.featureJoinToggle,
          featureJoinBtnLink = attributes.featureJoinBtnLink,
          featureJoinBtnTarget = attributes.featureJoinBtnTarget;


      var backroundStyle = {};
      var linkTarget = featureIconLinkTarget ? '_blank' : '_self';
      backgroundColor && (backroundStyle.backgroundColor = backgroundColor);
      backgroundImage && (backroundStyle.backgroundImage = 'url(' + backgroundImage + ')');
      backgroundPosition && (backroundStyle.backgroundPosition = backgroundPosition);
      backgroundRepeat && (backroundStyle.backgroundRepeat = 'no-repeat');
      backgroundSize && (backroundStyle.backgroundSize = backgroundSize);

      return [wp.element.createElement(
        InspectorControls,
        null,
        wp.element.createElement(
          'div',
          { className: 'amp-controle-settings' },
          wp.element.createElement(
            PanelBody,
            { title: 'Feature Block Image' },
            wp.element.createElement(
              'div',
              { className: 'inspector-field' },
              wp.element.createElement(MediaUpload, {
                onSelect: function onSelect(backgroundImage) {
                  return setAttributes({
                    backgroundImage: backgroundImage.sizes.full.url
                  });
                },
                type: 'image',
                value: backgroundImage,
                render: function render(_ref2) {
                  var open = _ref2.open;
                  return wp.element.createElement(
                    Button,
                    {
                      onClick: open,
                      className: backgroundImage ? 'amp-image-button' : 'button button-large'
                    },
                    !backgroundImage ? __('Select Image') : wp.element.createElement('div', {
                      style: {
                        backgroundImage: 'url(' + backgroundImage + ')',
                        backgroundSize: 'cover',
                        backgroundPosition: 'center',
                        height: '150px',
                        width: '225px'
                      }
                    })
                  );
                }
              }),
              backgroundImage ? wp.element.createElement(
                Fragment,
                null,
                wp.element.createElement(
                  Button,
                  {
                    className: 'button',
                    onClick: function onClick() {
                      setAttributes({ backgroundImage: '' });
                    }
                  },
                  __('Remove Image')
                ),
                wp.element.createElement(
                  'div',
                  { className: 'inspector-field-inner' },
                  wp.element.createElement(ToggleControl, {
                    label: __('Background Repeat '),
                    checked: backgroundRepeat,
                    onChange: function onChange(backgroundRepeat) {
                      setAttributes({ backgroundRepeat: backgroundRepeat });
                    }
                  }),
                  wp.element.createElement(SelectControl, {
                    label: __('background size'),
                    value: backgroundSize,
                    options: [{ label: __('auto'), value: 'auto' }, { label: __('cover'), value: 'cover' }, { label: __('contain'), value: 'contain' }, { label: __('initial'), value: 'initial' }, { label: __('inherit'), value: 'inherit' }],
                    onChange: function onChange(value) {
                      setAttributes({
                        backgroundSize: value
                      });
                    }
                  }),
                  wp.element.createElement(SelectControl, {
                    label: __('Select Position'),
                    value: backgroundPosition,
                    options: [{ label: __('inherit'), value: 'inherit' }, { label: __('initial'), value: 'initial' }, { label: __('bottom'), value: 'bottom' }, { label: __('center'), value: 'center' }, { label: __('left'), value: 'left' }, { label: __('right'), value: 'right' }, { label: __('top'), value: 'top' }, { label: __('unset'), value: 'unset' }, {
                      label: __('center center'),
                      value: 'center center'
                    }, { label: __('left top'), value: 'left top' }, { label: __('left center'), value: 'left center' }, { label: __('left bottom'), value: 'left bottom' }, { label: __('right top'), value: 'right top' }, { label: __('right center'), value: 'right center' }, { label: __('right bottom'), value: 'right bottom' }, { label: __('center top'), value: 'center top' }, { label: __('center bottom'), value: 'center bottom' }],
                    onChange: function onChange(value) {
                      return setAttributes({ backgroundPosition: value });
                    }
                  })
                )
              ) : wp.element.createElement(
                'div',
                { className: 'inspector-field-inner' },
                wp.element.createElement(
                  'label',
                  null,
                  'Background Color'
                ),
                wp.element.createElement(ColorPalette, {
                  value: backgroundColor,
                  onChange: function onChange(backgroundColor) {
                    return setAttributes({ backgroundColor: backgroundColor });
                  }
                })
              )
            )
          ),
          wp.element.createElement(
            PanelBody,
            { title: 'Typography', initialOpen: false },
            wp.element.createElement(
              'div',
              { className: 'inspector-field' },
              wp.element.createElement(
                'label',
                null,
                'Status Color:'
              ),
              wp.element.createElement(ColorPalette, {
                value: featureStatusColor,
                onChange: function onChange(featureStatusColor) {
                  return setAttributes({ featureStatusColor: featureStatusColor });
                }
              })
            ),
            wp.element.createElement(
              'div',
              { className: 'inspector-field' },
              wp.element.createElement(
                'label',
                null,
                'Title Color:'
              ),
              wp.element.createElement(ColorPalette, {
                value: featureTitleColor,
                onChange: function onChange(featureTitleColor) {
                  return setAttributes({ featureTitleColor: featureTitleColor });
                }
              })
            ),
            wp.element.createElement(
              'div',
              { className: 'inspector-field' },
              wp.element.createElement(
                'label',
                null,
                'Author Color:'
              ),
              wp.element.createElement(ColorPalette, {
                value: featureAuthorColor,
                onChange: function onChange(featureAuthorColor) {
                  return setAttributes({ featureAuthorColor: featureAuthorColor });
                }
              })
            ),
            wp.element.createElement(
              'div',
              { className: 'inspector-field' },
              wp.element.createElement(
                'label',
                null,
                'Discription Color:'
              ),
              wp.element.createElement(ColorPalette, {
                value: featureDiscColor,
                onChange: function onChange(featureDiscColor) {
                  return setAttributes({ featureDiscColor: featureDiscColor });
                }
              })
            )
          ),
          wp.element.createElement(
            PanelBody,
            { title: 'Button Settings', initialOpen: false },
            wp.element.createElement(ToggleControl, {
              label: 'Hide Reaction',
              checked: featureLikeToggle,
              onChange: function onChange(featureLikeToggle) {
                setAttributes({ featureLikeToggle: featureLikeToggle });
              }
            }),
            wp.element.createElement(ToggleControl, {
              label: 'Hide Button',
              checked: featureJoinToggle,
              onChange: function onChange(featureJoinToggle) {
                setAttributes({ featureJoinToggle: featureJoinToggle });
              }
            }),
            wp.element.createElement(TextControl, {
              value: featureJoinBtn,
              type: 'text',
              label: 'Button Label',
              placeholder: '',
              onChange: function onChange(featureJoinBtn) {
                setAttributes({ featureJoinBtn: featureJoinBtn });
              }
            }),
            wp.element.createElement(TextControl, {
              value: featureJoinBtnLink,
              type: 'url',
              label: 'Button Link',
              placeholder: 'https://google.com/',
              onChange: function onChange(featureJoinBtnLink) {
                setAttributes({ featureJoinBtnLink: featureJoinBtnLink });
              }
            }),
            wp.element.createElement(ToggleControl, {
              label: 'Open in new Tab',
              checked: featureJoinBtnTarget,
              onChange: function onChange(featureJoinBtnTarget) {
                setAttributes({ featureJoinBtnTarget: featureJoinBtnTarget });
              }
            }),
            wp.element.createElement(TextControl, {
              value: featureIconLink,
              type: 'url',
              label: 'Play Button Link',
              placeholder: 'https://google.com/',
              onChange: function onChange(featureIconLink) {
                setAttributes({ featureIconLink: featureIconLink });
              }
            }),
            wp.element.createElement(ToggleControl, {
              label: 'Open in new Tab',
              checked: featureIconLinkTarget,
              onChange: function onChange(featureIconLinkTarget) {
                setAttributes({ featureIconLinkTarget: featureIconLinkTarget });
              }
            })
          )
        )
      ), wp.element.createElement(
        'div',
        { className: 'amp-feature-block', style: backroundStyle },
        wp.element.createElement(
          'div',
          { className: 'amp-feature-block-inner' },
          wp.element.createElement(
            'span',
            { className: 'edit-feature-block edit-block-icon' },
            wp.element.createElement('i', { className: 'fa fa-pencil' })
          ),
          wp.element.createElement(
            'div',
            { className: 'feature-icon' },
            wp.element.createElement(MediaUpload, {
              onSelect: function onSelect(featureIcon) {
                setAttributes({
                  featureIcon: featureIcon ? featureIcon.sizes.full.url : ''
                });
              },
              type: 'image',
              render: function render(_ref3) {
                var open = _ref3.open;

                if (featureIcon) {
                  return wp.element.createElement(
                    Fragment,
                    null,
                    wp.element.createElement('span', {
                      onClick: open,
                      className: 'dashicons dashicons-edit edit-image'
                    }),
                    featureIconLink ? wp.element.createElement(
                      'a',
                      {
                        href: featureIconLink,
                        target: linkTarget,
                        rel: 'noopener noreferrer'
                      },
                      wp.element.createElement('img', { src: featureIcon, alt: 'icon' })
                    ) : wp.element.createElement('img', { src: featureIcon, alt: 'icon' })
                  );
                } else {
                  return wp.element.createElement(
                    Button,
                    { onClick: open, className: 'button button-large' },
                    wp.element.createElement('span', { className: 'dashicons dashicons-upload' }),
                    ' ',
                    'Upload Icon'
                  );
                }
              }
            })
          ),
          wp.element.createElement(
            'div',
            { className: 'amp-feature-content' },
            wp.element.createElement(RichText, {
              tagName: 'h3',
              placeholder: 'Live',
              className: 'feature-status',
              value: featureStatusTitle,
              style: {
                color: featureStatusColor
              },
              onChange: function onChange(featureStatusTitle) {
                setAttributes({ featureStatusTitle: featureStatusTitle });
              }
            }),
            wp.element.createElement(RichText, {
              tagName: 'h2',
              placeholder: 'Creating the World',
              className: 'feature-title',
              value: featureTitle,
              style: {
                color: featureTitleColor
              },
              onChange: function onChange(featureTitle) {
                setAttributes({ featureTitle: featureTitle });
              }
            }),
            wp.element.createElement(RichText, {
              tagName: 'h4',
              placeholder: 'Author',
              className: 'feature-author',
              value: featureAuthor,
              style: {
                color: featureAuthorColor
              },
              onChange: function onChange(featureAuthor) {
                setAttributes({ featureAuthor: featureAuthor });
              }
            }),
            wp.element.createElement(RichText, {
              tagName: 'p',
              placeholder: 'Discription',
              className: 'feature-disc',
              value: featureDisc,
              style: {
                color: featureDiscColor
              },
              onChange: function onChange(featureDisc) {
                setAttributes({ featureDisc: featureDisc });
              }
            }),
            !featureLikeToggle && wp.element.createElement(RichText, {
              tagName: 'div',
              placeholder: __('Add Reactions'),
              className: 'shortcode-wrap',
              value: shortcode,
              onChange: function onChange(value) {
                value = value.replace(/&lt;!--td.*}--><br>/, '');
                value = value.replace(/<br>.*}<br>/, '');
                value = value.replace(/<br><br><br>&lt.*--><br>/, '');
                setAttributes({ shortcode: value });
              }
            }),
            !featureJoinToggle && wp.element.createElement(
              'div',
              { className: 'button-wrap btn-link' },
              wp.element.createElement(
                'a',
                { href: featureJoinBtnLink, target: featureJoinBtnTarget ? '_blank' : '_self', rel: 'noopener noreferrer' },
                featureJoinBtn
              )
            )
          )
        )
      )];
    },
    save: function save(_ref4) {
      var attributes = _ref4.attributes;
      var backgroundColor = attributes.backgroundColor,
          backgroundImage = attributes.backgroundImage,
          backgroundSize = attributes.backgroundSize,
          backgroundRepeat = attributes.backgroundRepeat,
          backgroundPosition = attributes.backgroundPosition,
          featureIcon = attributes.featureIcon,
          featureIconLink = attributes.featureIconLink,
          featureIconLinkTarget = attributes.featureIconLinkTarget,
          featureStatusTitle = attributes.featureStatusTitle,
          featureStatusColor = attributes.featureStatusColor,
          featureTitle = attributes.featureTitle,
          featureTitleColor = attributes.featureTitleColor,
          featureAuthor = attributes.featureAuthor,
          featureAuthorColor = attributes.featureAuthorColor,
          featureDisc = attributes.featureDisc,
          featureDiscColor = attributes.featureDiscColor,
          shortcode = attributes.shortcode,
          featureLikeToggle = attributes.featureLikeToggle,
          featureJoinBtn = attributes.featureJoinBtn,
          featureJoinToggle = attributes.featureJoinToggle,
          featureJoinBtnLink = attributes.featureJoinBtnLink,
          featureJoinBtnTarget = attributes.featureJoinBtnTarget;


      var backroundStyle = {};
      var linkTarget = featureIconLinkTarget ? '_blank' : '_self';
      backgroundColor && (backroundStyle.backgroundColor = backgroundColor);
      backgroundImage && (backroundStyle.backgroundImage = 'url(' + backgroundImage + ')');
      backgroundPosition && (backroundStyle.backgroundPosition = backgroundPosition);
      backgroundRepeat && (backroundStyle.backgroundRepeat = 'no-repeat');
      backgroundSize && (backroundStyle.backgroundSize = backgroundSize);

      return wp.element.createElement(
        'div',
        { className: 'amp-feature-block', style: backroundStyle },
        wp.element.createElement(
          'div',
          { className: 'amp-feature-block-inner' },
          wp.element.createElement(
            'span',
            { className: 'edit-feature-block edit-block-icon' },
            wp.element.createElement('i', { className: 'fa fa-pencil' })
          ),
          featureIcon && wp.element.createElement(
            'div',
            { className: 'feature-icon' },
            featureIconLink ? wp.element.createElement(
              'a',
              {
                href: featureIconLink,
                target: linkTarget,
                rel: 'noopener noreferrer'
              },
              wp.element.createElement('img', { src: featureIcon, alt: 'icon' })
            ) : wp.element.createElement('img', { src: featureIcon, alt: 'icon' })
          ),
          wp.element.createElement(
            'div',
            { className: 'amp-feature-content' },
            featureStatusTitle && wp.element.createElement(RichText.Content, {
              tagName: 'h3',
              value: featureStatusTitle,
              style: {
                color: featureStatusColor
              },
              className: 'feature-status'
            }),
            featureTitle && wp.element.createElement(RichText.Content, {
              tagName: 'h2',
              value: featureTitle,
              style: {
                color: featureTitleColor
              },
              className: 'feature-title'
            }),
            featureAuthor && wp.element.createElement(RichText.Content, {
              tagName: 'h4',
              value: featureAuthor,
              style: {
                color: featureAuthorColor
              },
              className: 'feature-author'
            }),
            featureDisc && wp.element.createElement(RichText.Content, {
              tagName: 'p',
              value: featureDisc,
              style: {
                color: featureDiscColor
              },
              className: 'feature-disc'
            }),
            !featureLikeToggle && shortcode && wp.element.createElement(RichText.Content, {
              tagName: 'div',
              className: 'shortcode-wrap',
              value: shortcode
            }),
            !featureJoinToggle && wp.element.createElement(
              'div',
              { className: 'button-wrap btn-link' },
              wp.element.createElement(
                'a',
                { href: featureJoinBtnLink, target: featureJoinBtnTarget ? '_blank' : '_self', rel: 'noopener noreferrer' },
                featureJoinBtn
              )
            )
          )
        )
      );
    }
  });
})(wp.i18n, wp.blocks, wp.blockEditor, wp.components, wp.element);

/***/ }),
/* 5 */
/***/ (function(module, exports) {

;(function (wpi18n, wpBlocks, wpBlockEditor, wpComponents) {
    var registerBlockType = wpBlocks.registerBlockType;
    var __ = wpi18n.__;
    var RichText = wpBlockEditor.RichText,
        InspectorControls = wpBlockEditor.InspectorControls,
        MediaUpload = wpBlockEditor.MediaUpload,
        AlignmentToolbar = wpBlockEditor.AlignmentToolbar;
    var PanelBody = wpComponents.PanelBody,
        Button = wpComponents.Button,
        ToggleControl = wpComponents.ToggleControl,
        TextControl = wpComponents.TextControl;


    registerBlockType('rg/image', {
        // built in attributes
        title: __('Image'),
        description: __('Image Block'),
        icon: 'editor-code',
        category: 'nab_amplify',
        keywords: [__('Image'), __('gutenberg')],
        attributes: {
            ImageUrl: {
                type: 'string',
                default: ''
            },
            ImageAlt: {
                type: 'string',
                default: ''
            },
            ImageLink: {
                type: 'url',
                default: ''
            },
            ImageLinkTarget: {
                type: 'Boolean',
                default: false
            },
            textAlign: {
                type: 'string',
                default: ''
            }
        },
        edit: function edit(_ref) {
            var attributes = _ref.attributes,
                setAttributes = _ref.setAttributes;
            var ImageUrl = attributes.ImageUrl,
                ImageAlt = attributes.ImageAlt,
                ImageLink = attributes.ImageLink,
                ImageLinkTarget = attributes.ImageLinkTarget,
                textAlign = attributes.textAlign;


            var linkTarget = ImageLinkTarget ? '_blank' : '_self';

            var divStyle = {};
            divStyle && (divStyle.textAlign = textAlign);

            return [wp.element.createElement(
                InspectorControls,
                null,
                wp.element.createElement(
                    'div',
                    { className: 'amp-controle-settings' },
                    wp.element.createElement(
                        PanelBody,
                        { title: __("Image settings") },
                        wp.element.createElement(
                            'div',
                            { className: 'inspector-field' },
                            wp.element.createElement(MediaUpload, {
                                onSelect: function onSelect(ImageUrl) {
                                    return setAttributes({ ImageUrl: ImageUrl ? ImageUrl.sizes.full.url : '' });
                                },
                                type: 'image',
                                value: ImageUrl,
                                render: function render(_ref2) {
                                    var open = _ref2.open;
                                    return wp.element.createElement(
                                        Button,
                                        {
                                            onClick: open,
                                            className: ImageUrl ? "amp-image-button" : "button button-large" },
                                        !ImageUrl ? __("Select Image") : wp.element.createElement('div', {
                                            style: {
                                                backgroundImage: 'url(' + ImageUrl + ')',
                                                backgroundSize: "cover",
                                                backgroundPosition: "center",
                                                height: "150px",
                                                width: "225px"
                                            }
                                        })
                                    );
                                }
                            }),
                            ImageUrl ? wp.element.createElement(
                                Button,
                                {
                                    className: 'button',
                                    onClick: function onClick() {
                                        setAttributes({ ImageUrl: "" });
                                    }
                                },
                                __("Remove Image")
                            ) : null
                        ),
                        wp.element.createElement(
                            'div',
                            { className: 'inspector-field' },
                            wp.element.createElement(TextControl, {
                                value: ImageAlt,
                                type: 'string',
                                label: 'Alt Text',
                                onChange: function onChange(ImageAlt) {
                                    setAttributes({ ImageAlt: ImageAlt ? ImageAlt : '' });
                                }
                            })
                        ),
                        wp.element.createElement(
                            'div',
                            { className: 'inspector-field' },
                            wp.element.createElement(TextControl, {
                                value: ImageLink,
                                type: 'url',
                                label: 'Image Link',
                                placeholder: 'https://google.com/',
                                onChange: function onChange(ImageLink) {
                                    setAttributes({ ImageLink: ImageLink });
                                }
                            })
                        ),
                        wp.element.createElement(
                            'div',
                            { className: 'inspector-field' },
                            wp.element.createElement(ToggleControl, {
                                label: 'Open in new Tab',
                                checked: ImageLinkTarget,
                                onChange: function onChange(ImageLinkTarget) {
                                    setAttributes({ ImageLinkTarget: ImageLinkTarget });
                                }
                            })
                        ),
                        wp.element.createElement(
                            'div',
                            { className: 'inspector-field' },
                            wp.element.createElement(
                                'label',
                                null,
                                'Image Alignment'
                            ),
                            wp.element.createElement(AlignmentToolbar, {
                                value: textAlign,
                                onChange: function onChange(textAlign) {
                                    setAttributes({ textAlign: textAlign });
                                }
                            })
                        )
                    )
                )
            ), wp.element.createElement(
                'div',
                { className: 'amp-image-block', style: divStyle },
                !ImageUrl ? wp.element.createElement(
                    'div',
                    { className: 'amp-button-wrap' },
                    wp.element.createElement(MediaUpload, {
                        onSelect: function onSelect(ImageUrl) {
                            return setAttributes({
                                ImageUrl: ImageUrl.sizes.full.url
                            });
                        },
                        type: 'image',
                        value: ImageUrl,
                        render: function render(_ref3) {
                            var open = _ref3.open;
                            return wp.element.createElement(
                                Button,
                                {
                                    onClick: open,
                                    className: ImageUrl ? "amp-image-button" : "button button-large" },
                                wp.element.createElement('span', { 'class': 'dashicons dashicons-upload' }),
                                !ImageUrl ? __("Select Image") : null
                            );
                        }
                    })
                ) : !ImageLink ? wp.element.createElement('img', { src: ImageUrl, alt: ImageAlt }) : wp.element.createElement(
                    'a',
                    { href: ImageLink, target: linkTarget, rel: 'noopener noreferrer' },
                    wp.element.createElement('img', { src: ImageUrl, alt: ImageAlt })
                )
            )];
        },
        save: function save(_ref4) {
            var attributes = _ref4.attributes;
            var ImageUrl = attributes.ImageUrl,
                ImageAlt = attributes.ImageAlt,
                ImageLink = attributes.ImageLink,
                ImageLinkTarget = attributes.ImageLinkTarget,
                textAlign = attributes.textAlign;


            var linkTarget = ImageLinkTarget ? '_blank' : '_self';

            var divStyle = {};
            textAlign && (divStyle.textAlign = textAlign);

            return wp.element.createElement(
                'div',
                { className: 'amp-image-block', style: divStyle },
                !ImageLink ? wp.element.createElement('img', { src: ImageUrl, alt: ImageAlt }) : wp.element.createElement(
                    'a',
                    { href: ImageLink, target: linkTarget, rel: 'noopener noreferrer' },
                    wp.element.createElement('img', { src: ImageUrl, alt: ImageAlt })
                )
            );
        }
    });
})(wp.i18n, wp.blocks, wp.blockEditor, wp.components);

/***/ }),
/* 6 */
/***/ (function(module, exports) {

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _toConsumableArray(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } else { return Array.from(arr); } }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

;(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement, wpBlockEditor) {
  var __ = wpI18n.__;
  var registerBlockType = wpBlocks.registerBlockType;
  var Fragment = wpElement.Fragment,
      Component = wpElement.Component;
  var InspectorControls = wpEditor.InspectorControls,
      RichText = wpEditor.RichText,
      MediaUpload = wpEditor.MediaUpload;
  var PanelBody = wpComponents.PanelBody,
      PanelRow = wpComponents.PanelRow,
      ToggleControl = wpComponents.ToggleControl,
      TextControl = wpComponents.TextControl,
      Tooltip = wpComponents.Tooltip,
      Button = wpComponents.Button;
  var ColorPalette = wpBlockEditor.ColorPalette;

  var ItemComponent = function (_Component) {
    _inherits(ItemComponent, _Component);

    function ItemComponent() {
      _classCallCheck(this, ItemComponent);

      return _possibleConstructorReturn(this, (ItemComponent.__proto__ || Object.getPrototypeOf(ItemComponent)).apply(this, arguments));
    }

    _createClass(ItemComponent, [{
      key: 'componentDidMount',
      value: function componentDidMount() {
        var dataArray = this.props.attributes.dataArray;

        if (0 === dataArray.length) {
          this.initList();
        }
      }
    }, {
      key: 'initList',
      value: function initList() {
        var dataArray = this.props.attributes.dataArray;
        var setAttributes = this.props.setAttributes;

        setAttributes({
          dataArray: [].concat(_toConsumableArray(dataArray), [{
            index: dataArray.length,
            title: '',
            subTitle: '',
            description: '',
            media: '',
            mediaAlt: ''
          }])
        });
      }
    }, {
      key: 'moveItem',
      value: function moveItem(oldIndex, newIndex) {
        var _props = this.props,
            attributes = _props.attributes,
            setAttributes = _props.setAttributes;
        var dataArray = attributes.dataArray;


        var copyData = [].concat(_toConsumableArray(dataArray));

        copyData[oldIndex] = dataArray[newIndex];
        copyData[newIndex] = dataArray[oldIndex];

        setAttributes({
          dataArray: copyData
        });

        this.forceUpdate();
      }
    }, {
      key: 'render',
      value: function render() {
        var _this2 = this;

        var _props2 = this.props,
            attributes = _props2.attributes,
            setAttributes = _props2.setAttributes;
        var dataArray = attributes.dataArray,
            headerTitle = attributes.headerTitle,
            headerTitleColor = attributes.headerTitleColor,
            headerLink = attributes.headerLink,
            headerLinkColor = attributes.headerLinkColor,
            backgroundColor = attributes.backgroundColor;


        var getImageButton = function getImageButton(openEvent, index) {
          if (dataArray[index].media) {
            return wp.element.createElement(
              Fragment,
              null,
              wp.element.createElement('span', {
                onClick: openEvent,
                className: 'dashicons dashicons-edit edit-image'
              }),
              wp.element.createElement('img', {
                src: dataArray[index].media,
                alt: dataArray[index].mediaAlt,
                className: 'img'
              })
            );
          } else {
            return wp.element.createElement(
              Button,
              { onClick: openEvent, className: 'button button-large' },
              wp.element.createElement('span', { className: 'dashicons dashicons-upload' }),
              ' Upload Image'
            );
          }
        };

        var itemList = dataArray.map(function (data, index) {
          return wp.element.createElement(
            'div',
            { className: 'item' },
            wp.element.createElement(
              'div',
              { className: 'settings' },
              wp.element.createElement(
                'div',
                { className: 'move-item-controls' },
                0 < index && wp.element.createElement(
                  Tooltip,
                  { text: 'Move Left' },
                  wp.element.createElement('span', {
                    className: 'dashicons dashicons-arrow-left-alt2 item-move-left',
                    onClick: function onClick() {
                      return _this2.moveItem(index, index - 1);
                    }
                  })
                ),
                index + 1 < dataArray.length && wp.element.createElement(
                  Tooltip,
                  { text: 'Move Right' },
                  wp.element.createElement('span', {
                    className: 'dashicons dashicons-arrow-right-alt2 item-move-right',
                    onClick: function onClick() {
                      return _this2.moveItem(index, index + 1);
                    }
                  })
                )
              ),
              wp.element.createElement('span', {
                className: 'dashicons dashicons-no-alt remove',
                onClick: function onClick() {
                  var qewQusote = dataArray.filter(function (item) {
                    return item.index != data.index;
                  }).map(function (t) {
                    if (t.index > data.index) {
                      t.index -= 1;
                    }

                    return t;
                  });

                  setAttributes({
                    dataArray: qewQusote
                  });
                }
              })
            ),
            wp.element.createElement(
              'div',
              { className: 'inner', style: { backgroundColor: backgroundColor } },
              wp.element.createElement(
                'div',
                { className: 'left' },
                wp.element.createElement(MediaUpload, {
                  onSelect: function onSelect(media) {
                    var arrayCopy = [].concat(_toConsumableArray(dataArray));
                    arrayCopy[index].media = media.url;
                    arrayCopy[index].mediaAlt = media.alt;
                    setAttributes({ dataArray: arrayCopy });
                  },
                  type: 'image',
                  value: attributes.imageID,
                  render: function render(_ref) {
                    var open = _ref.open;
                    return getImageButton(open, index);
                  }
                })
              ),
              wp.element.createElement(
                'div',
                { className: 'right' },
                wp.element.createElement(RichText, {
                  tagName: 'h3',
                  placeholder: __('Title'),
                  keepPlaceholderOnFocus: 'true',
                  value: data.title,
                  className: 'title',
                  onChange: function onChange(value) {
                    value = value.replace(/&lt;!--td.*}--><br>/, '');
                    value = value.replace(/<br>.*}<br>/, '');
                    value = value.replace(/<br><br><br>&lt.*--><br>/, '');
                    var arrayCopy = [].concat(_toConsumableArray(dataArray));
                    arrayCopy[index].title = value;
                    setAttributes({ dataArray: arrayCopy });
                  }
                }),
                wp.element.createElement(RichText, {
                  tagName: 'strong',
                  placeholder: __('Sub Title'),
                  keepPlaceholderOnFocus: 'true',
                  value: data.subTitle,
                  className: 'sub-title',
                  onChange: function onChange(value) {
                    value = value.replace(/&lt;!--td.*}--><br>/, '');
                    value = value.replace(/<br>.*}<br>/, '');
                    value = value.replace(/<br><br><br>&lt.*--><br>/, '');
                    var arrayCopy = [].concat(_toConsumableArray(dataArray));
                    arrayCopy[index].subTitle = value;
                    setAttributes({ dataArray: arrayCopy });
                  }
                }),
                wp.element.createElement(RichText, {
                  tagName: 'p',
                  placeholder: __('Description'),
                  value: data.description,
                  keepPlaceholderOnFocus: 'true',
                  className: 'description',
                  onChange: function onChange(value) {
                    value = value.replace(/&lt;!--td.*}--><br>/, '');
                    value = value.replace(/<br>.*}<br>/, '');
                    value = value.replace(/<br><br><br>&lt.*--><br>/, '');
                    var arrayCopy = [].concat(_toConsumableArray(dataArray));
                    arrayCopy[index].description = value;
                    setAttributes({ dataArray: arrayCopy });
                  }
                })
              )
            )
          );
        });

        return wp.element.createElement(
          Fragment,
          null,
          wp.element.createElement(
            InspectorControls,
            null,
            wp.element.createElement(
              PanelBody,
              { title: 'Color Settings' },
              wp.element.createElement(
                'div',
                { className: 'inspector-field' },
                wp.element.createElement(
                  'label',
                  null,
                  'Title Color'
                ),
                wp.element.createElement(ColorPalette, {
                  value: headerTitleColor,
                  onChange: function onChange(headerTitleColor) {
                    return setAttributes({ headerTitleColor: headerTitleColor });
                  }
                })
              ),
              wp.element.createElement(
                'div',
                { className: 'inspector-field' },
                wp.element.createElement(
                  'label',
                  null,
                  'Link Color'
                ),
                wp.element.createElement(ColorPalette, {
                  value: headerLinkColor,
                  onChange: function onChange(headerLinkColor) {
                    return setAttributes({ headerLinkColor: headerLinkColor });
                  }
                })
              ),
              wp.element.createElement(
                'div',
                { className: 'inspector-field' },
                wp.element.createElement(
                  'label',
                  null,
                  'Background Color'
                ),
                wp.element.createElement(ColorPalette, {
                  value: backgroundColor,
                  onChange: function onChange(backgroundColor) {
                    return setAttributes({ backgroundColor: backgroundColor });
                  }
                })
              )
            )
          ),
          wp.element.createElement(
            'div',
            { className: 'upcoming-events-calendar' },
            wp.element.createElement(
              'div',
              { className: 'upcoming-events-header' },
              wp.element.createElement(RichText, {
                tagName: 'h2',
                placeholder: __('Title'),
                value: headerTitle,
                keepPlaceholderOnFocus: 'true',
                className: 'header-title',
                style: { color: headerTitleColor },
                onChange: function onChange(value) {
                  value = value.replace(/&lt;!--td.*}--><br>/, '');
                  value = value.replace(/<br>.*}<br>/, '');
                  value = value.replace(/<br><br><br>&lt.*--><br>/, '');
                  setAttributes({ headerTitle: value });
                }
              }),
              wp.element.createElement(RichText, {
                tagName: 'span',
                placeholder: __('View All'),
                value: headerLink,
                keepPlaceholderOnFocus: 'true',
                className: 'header-link',
                style: { color: headerLinkColor },
                onChange: function onChange(value) {
                  value = value.replace(/&lt;!--td.*}--><br>/, '');
                  value = value.replace(/<br>.*}<br>/, '');
                  value = value.replace(/<br><br><br>&lt.*--><br>/, '');
                  setAttributes({ headerLink: value });
                }
              })
            ),
            wp.element.createElement(
              'div',
              { className: 'upcoming-events-body' },
              itemList,
              wp.element.createElement(
                'div',
                { className: 'item additem' },
                wp.element.createElement(
                  'button',
                  {
                    className: 'components-button add',
                    onClick: function onClick(content) {
                      setAttributes({
                        dataArray: [].concat(_toConsumableArray(dataArray), [{
                          index: dataArray.length,
                          title: '',
                          subTitle: '',
                          description: '',
                          media: ''
                        }])
                      });
                    }
                  },
                  wp.element.createElement('span', { className: 'dashicons dashicons-plus' }),
                  ' Add New Item'
                )
              )
            )
          )
        );
      }
    }]);

    return ItemComponent;
  }(Component);

  registerBlockType('rg/upcoming-events-calendar', {
    title: __('Upcoming Events Calendar'),
    description: __('upcoming-events-calendar'),
    icon: 'editor-code',
    category: 'nab_amplify',
    keywords: [__('Upcoming Events Calendar'), __('Gutenberg')],
    attributes: {
      dataArray: {
        type: 'array',
        default: []
      },
      headerTitle: {
        type: 'string',
        default: ''
      },
      headerTitleColor: {
        type: 'string',
        default: '#fdd80f'
      },
      headerLink: {
        type: 'string',
        default: '<a href="#" class="view-all">View All</a>'
      },
      headerLinkColor: {
        type: 'string',
        default: '#999'
      },
      backgroundColor: {
        type: 'string',
        default: '#333'
      }
    },
    edit: ItemComponent,

    save: function save(props) {
      var attributes = props.attributes;
      var dataArray = attributes.dataArray,
          headerTitle = attributes.headerTitle,
          headerTitleColor = attributes.headerTitleColor,
          headerLink = attributes.headerLink,
          headerLinkColor = attributes.headerLinkColor,
          backgroundColor = attributes.backgroundColor;


      return wp.element.createElement(
        Fragment,
        null,
        wp.element.createElement(
          'div',
          { className: 'upcoming-events-calendar' },
          wp.element.createElement(
            'div',
            { className: 'upcoming-events-header' },
            headerTitle && wp.element.createElement(RichText.Content, {
              tagName: 'h2',
              value: headerTitle,
              className: 'header-title',
              style: { color: headerTitleColor }
            }),
            headerLink && wp.element.createElement(RichText.Content, {
              tagName: 'span',
              value: headerLink,
              className: 'header-link',
              style: { color: headerLinkColor }
            })
          ),
          wp.element.createElement(
            'div',
            { className: 'upcoming-events-body' },
            dataArray.map(function (data, index) {
              return wp.element.createElement(
                Fragment,
                null,
                data.title && wp.element.createElement(
                  'div',
                  { className: 'item' },
                  wp.element.createElement(
                    'div',
                    { className: 'inner', style: { backgroundColor: backgroundColor } },
                    wp.element.createElement(
                      'div',
                      { className: 'left' },
                      data.media ? wp.element.createElement('img', { src: data.media, alt: data.mediaAlt }) : wp.element.createElement(
                        'div',
                        { className: 'no-image' },
                        'No Image'
                      )
                    ),
                    wp.element.createElement(
                      'div',
                      { className: 'right' },
                      data.title && wp.element.createElement(RichText.Content, {
                        tagName: 'h3',
                        value: data.title,
                        className: 'title'
                      }),
                      data.subTitle && wp.element.createElement(RichText.Content, {
                        tagName: 'strong',
                        value: data.subTitle,
                        className: 'sub-title'
                      }),
                      data.description && wp.element.createElement(RichText.Content, {
                        tagName: 'p',
                        value: data.description,
                        className: 'description'
                      })
                    )
                  )
                )
              );
            })
          )
        )
      );
    }
  });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element, wp.blockEditor);

/***/ }),
/* 7 */
/***/ (function(module, exports) {

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _toConsumableArray(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } else { return Array.from(arr); } }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

;(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement, wpBlockEditor) {
  var __ = wpI18n.__;
  var registerBlockType = wpBlocks.registerBlockType;
  var Fragment = wpElement.Fragment,
      Component = wpElement.Component;
  var InspectorControls = wpEditor.InspectorControls,
      RichText = wpEditor.RichText,
      MediaUpload = wpEditor.MediaUpload;
  var PanelBody = wpComponents.PanelBody,
      PanelRow = wpComponents.PanelRow,
      ToggleControl = wpComponents.ToggleControl,
      TextControl = wpComponents.TextControl,
      Tooltip = wpComponents.Tooltip,
      Button = wpComponents.Button;
  var ColorPalette = wpBlockEditor.ColorPalette;


  jQuery(document).on('click', '.video-icon img', function () {
    jQuery(this).parents('.video-icon').toggleClass('showVideoLinkPopup');
  });

  jQuery(document).on('click', '.video-icon .play_link_popup .remove', function () {
    jQuery(this).parents('.video-icon').removeClass('showVideoLinkPopup');
  });

  var ItemComponent = function (_Component) {
    _inherits(ItemComponent, _Component);

    function ItemComponent(props) {
      _classCallCheck(this, ItemComponent);

      var _this = _possibleConstructorReturn(this, (ItemComponent.__proto__ || Object.getPrototypeOf(ItemComponent)).call(this, props));

      _this.state = { popup: false };
      _this.addNewItem = _this.addNewItem.bind(_this);
      return _this;
    }

    _createClass(ItemComponent, [{
      key: 'addNewItem',
      value: function addNewItem(name) {
        var dataArray = this.props.attributes.dataArray;
        var setAttributes = this.props.setAttributes;

        var attr = void 0;
        if (name == 'option-1') {
          attr = {
            index: dataArray.length,
            option: name,
            advertising: 'Sponsored',
            media: '',
            mediaAlt: '',
            title: '',
            subTitle: '',
            buttonText: '<a href="#" class="btn">Learn More</a>'
          };
        }
        if (name == 'option-2') {
          attr = {
            index: dataArray.length,
            option: name,
            bgMedia: '',
            media: '',
            mediaAlt: '',
            videoIcon: '',
            videoIconLink: '',
            videoIconLinkTarget: '',
            videoLinkPopup: false,
            title: '',
            subTitle: '',
            date: '',
            shortcode: '',
            buttonText: '<a href="#" class="btn">Watch</a>'
          };
        }

        if (name == 'option-3') {
          attr = {
            index: dataArray.length,
            option: name,
            advertising: 'Sponsored',
            media: '',
            mediaAlt: '',
            buttonText: '<a href="#" class="btn">Learn More</a>'
          };
        }

        if (name == 'option-4') {
          attr = {
            index: dataArray.length,
            option: name,
            bgMedia: '',
            media: '',
            mediaAlt: '',
            title: '',
            subTitle: '',
            buttonText: '<a href="#" class="btn">Message</a>'
          };
        }

        if (name == 'option-5') {
          attr = {
            index: dataArray.length,
            option: name,
            bgMedia: '',
            title: '',
            subTitle: '',
            buttonText: '<a href="#" class="btn">View Product</a>',
            bookmark: ''
          };
        }

        if (name == 'option-6') {
          attr = {
            index: dataArray.length,
            option: name,
            advertising: 'Sponsored',
            media: '',
            mediaAlt: '',
            shortcode: '',
            bookmark: ''
          };
        }

        setAttributes({
          dataArray: [].concat(_toConsumableArray(dataArray), [attr])
        });
        this.setState({
          popup: false
        });
      }
    }, {
      key: 'moveItem',
      value: function moveItem(oldIndex, newIndex) {
        var _props = this.props,
            attributes = _props.attributes,
            setAttributes = _props.setAttributes;
        var dataArray = attributes.dataArray;


        var copyData = [].concat(_toConsumableArray(dataArray));

        copyData[oldIndex] = dataArray[newIndex];
        copyData[newIndex] = dataArray[oldIndex];

        setAttributes({
          dataArray: copyData
        });

        this.forceUpdate();
      }
    }, {
      key: 'render',
      value: function render() {
        var _this2 = this;

        var _props2 = this.props,
            attributes = _props2.attributes,
            setAttributes = _props2.setAttributes;
        var popup = this.state.popup;
        var dataArray = attributes.dataArray,
            headerTitle = attributes.headerTitle,
            headerTitleColor = attributes.headerTitleColor,
            backgroundColor = attributes.backgroundColor;


        var itemList = dataArray.map(function (data, index) {
          return wp.element.createElement(
            'div',
            { className: 'item ' + data.option },
            wp.element.createElement(
              'div',
              { className: 'settings' },
              wp.element.createElement(
                'div',
                { className: 'move-item-controls' },
                0 < index && wp.element.createElement(
                  Tooltip,
                  { text: 'Move Left' },
                  wp.element.createElement('span', {
                    className: 'dashicons dashicons-arrow-left-alt2 move-left',
                    onClick: function onClick() {
                      return _this2.moveItem(index, index - 1);
                    }
                  })
                ),
                index + 1 < dataArray.length && wp.element.createElement(
                  Tooltip,
                  { text: 'Move Right' },
                  wp.element.createElement('span', {
                    className: 'dashicons dashicons-arrow-right-alt2 move-right',
                    onClick: function onClick() {
                      return _this2.moveItem(index, index + 1);
                    }
                  })
                )
              ),
              wp.element.createElement('span', {
                className: 'dashicons dashicons-no-alt remove',
                onClick: function onClick() {
                  var qewQusote = dataArray.filter(function (item) {
                    return item.index != data.index;
                  }).map(function (t) {
                    if (t.index > data.index) {
                      t.index -= 1;
                    }

                    return t;
                  });

                  setAttributes({
                    dataArray: qewQusote
                  });
                }
              })
            ),
            wp.element.createElement(
              'div',
              { className: 'inner', style: { backgroundColor: backgroundColor } },
              data.option == 'option-1' || data.option == 'option-4' ? wp.element.createElement(
                'div',
                { className: 'background-image' },
                wp.element.createElement(MediaUpload, {
                  onSelect: function onSelect(media) {
                    var arrayCopy = [].concat(_toConsumableArray(dataArray));
                    arrayCopy[index].bgMedia = media.url;
                    setAttributes({ dataArray: arrayCopy });
                  },
                  type: 'image',
                  render: function render(_ref) {
                    var open = _ref.open;

                    if (data.bgMedia) {
                      return wp.element.createElement(
                        Fragment,
                        null,
                        wp.element.createElement('span', {
                          onClick: open,
                          className: 'dashicons dashicons-edit edit-image'
                        }),
                        wp.element.createElement('img', { src: data.bgMedia })
                      );
                    } else {
                      return wp.element.createElement(
                        Button,
                        {
                          onClick: open,
                          className: 'button button-large'
                        },
                        wp.element.createElement('span', { className: 'dashicons dashicons-upload' }),
                        'Upload Cover Image'
                      );
                    }
                  }
                })
              ) : null,
              data.option == 'option-1' || data.option == 'option-3' || data.option == 'option-6' ? wp.element.createElement(
                'div',
                { className: 'advertising' },
                wp.element.createElement(RichText, {
                  tagName: 'span',
                  placeholder: __('Sponsored'),
                  keepPlaceholderOnFocus: 'true',
                  value: data.advertising,
                  onChange: function onChange(value) {
                    value = value.replace(/&lt;!--td.*}--><br>/, '');
                    value = value.replace(/<br>.*}<br>/, '');
                    value = value.replace(/<br><br><br>&lt.*--><br>/, '');
                    var arrayCopy = [].concat(_toConsumableArray(dataArray));
                    arrayCopy[index].advertising = value;
                    setAttributes({ dataArray: arrayCopy });
                  }
                })
              ) : null,
              ('option-2' === data.option || 'option-5' === data.option) && wp.element.createElement(RichText, {
                tagName: 'div',
                placeholder: __('Bookmark'),
                value: data.bookmark,
                keepPlaceholderOnFocus: 'true',
                className: 'bookmark-wrap',
                onChange: function onChange(value) {
                  value = value.replace(/&lt;!--td.*}--><br>/, '');
                  value = value.replace(/<br>.*}<br>/, '');
                  value = value.replace(/<br><br><br>&lt.*--><br>/, '');
                  var arrayCopy = [].concat(_toConsumableArray(dataArray));
                  arrayCopy[index].bookmark = value;
                  setAttributes({ dataArray: arrayCopy });
                }
              }),
              data.option !== 'option-6' ? wp.element.createElement(
                'div',
                { className: 'image' },
                wp.element.createElement(MediaUpload, {
                  onSelect: function onSelect(media) {
                    var arrayCopy = [].concat(_toConsumableArray(dataArray));
                    arrayCopy[index].media = media.url;
                    arrayCopy[index].mediaAlt = media.alt;
                    setAttributes({ dataArray: arrayCopy });
                  },
                  type: 'image',
                  render: function render(_ref2) {
                    var open = _ref2.open;

                    if (data.media) {
                      return wp.element.createElement(
                        Fragment,
                        null,
                        wp.element.createElement('span', {
                          onClick: open,
                          className: 'dashicons dashicons-edit edit-image'
                        }),
                        'option-2' === data.option && wp.element.createElement('span', {
                          className: 'dashicons dashicons-no-alt remove',
                          onClick: function onClick() {
                            var arrayCopy = [].concat(_toConsumableArray(dataArray));
                            arrayCopy[index].media = '';
                            arrayCopy[index].mediaAlt = '';
                            setAttributes({ dataArray: arrayCopy });
                          }
                        }),
                        wp.element.createElement('img', { src: data.media, alt: data.alt })
                      );
                    } else {
                      return wp.element.createElement(
                        Button,
                        { onClick: open, className: 'button button-large' },
                        wp.element.createElement('span', { className: 'dashicons dashicons-upload' }),
                        ' ',
                        'Upload Image'
                      );
                    }
                  }
                })
              ) : null,
              data.option == 'option-2' ? wp.element.createElement(
                'div',
                { className: 'video-icon' },
                wp.element.createElement(MediaUpload, {
                  onSelect: function onSelect(media) {
                    var arrayCopy = [].concat(_toConsumableArray(dataArray));
                    arrayCopy[index].videoIcon = media.url;
                    setAttributes({ dataArray: arrayCopy });
                  },
                  type: 'image',
                  render: function render(_ref3) {
                    var open = _ref3.open;

                    if (data.videoIcon) {
                      return wp.element.createElement(
                        Fragment,
                        null,
                        wp.element.createElement('span', {
                          onClick: open,
                          className: 'dashicons dashicons-edit edit-image'
                        }),
                        wp.element.createElement('span', {
                          className: 'dashicons dashicons-no-alt remove',
                          onClick: function onClick() {
                            var arrayCopy = [].concat(_toConsumableArray(dataArray));
                            arrayCopy[index].videoIcon = '';
                            setAttributes({ dataArray: arrayCopy });
                          }
                        }),
                        wp.element.createElement(
                          'div',
                          { className: 'play_link_popup' },
                          wp.element.createElement('span', { className: 'dashicons dashicons-no-alt remove' }),
                          wp.element.createElement(TextControl, {
                            value: data.videoIconLink,
                            type: 'url',
                            placeholder: 'https://google.com/',
                            onChange: function onChange(value) {
                              var arrayCopy = [].concat(_toConsumableArray(dataArray));
                              arrayCopy[index].videoIconLink = value;
                              setAttributes({ dataArray: arrayCopy });
                            }
                          }),
                          wp.element.createElement(ToggleControl, {
                            label: 'Open in new Tab',
                            checked: data.videoIconLinkTarget,
                            onChange: function onChange(value) {
                              var arrayCopy = [].concat(_toConsumableArray(dataArray));
                              arrayCopy[index].videoIconLinkTarget = value;
                              setAttributes({ dataArray: arrayCopy });
                            }
                          })
                        ),
                        wp.element.createElement('img', { src: data.videoIcon, alt: 'Play Icon' })
                      );
                    } else {
                      return wp.element.createElement(
                        Button,
                        {
                          onClick: open,
                          className: 'button button-large'
                        },
                        wp.element.createElement('span', { className: 'dashicons dashicons-upload' }),
                        'Upload Icon'
                      );
                    }
                  }
                })
              ) : null,
              wp.element.createElement(
                'div',
                { className: 'related-content-wrap' },
                data.option !== 'option-3' && data.option !== 'option-6' && wp.element.createElement(
                  Fragment,
                  null,
                  wp.element.createElement(RichText, {
                    tagName: 'h2',
                    placeholder: __('Title'),
                    value: data.title,
                    keepPlaceholderOnFocus: 'true',
                    className: 'title',
                    onChange: function onChange(value) {
                      value = value.replace(/&lt;!--td.*}--><br>/, '');
                      value = value.replace(/<br>.*}<br>/, '');
                      value = value.replace(/<br><br><br>&lt.*--><br>/, '');
                      var arrayCopy = [].concat(_toConsumableArray(dataArray));
                      arrayCopy[index].title = value;
                      setAttributes({ dataArray: arrayCopy });
                    }
                  }),
                  wp.element.createElement(RichText, {
                    tagName: 'strong',
                    placeholder: __('Sub Title'),
                    value: data.subTitle,
                    keepPlaceholderOnFocus: 'true',
                    className: 'sub-title',
                    onChange: function onChange(value) {
                      value = value.replace(/&lt;!--td.*}--><br>/, '');
                      value = value.replace(/<br>.*}<br>/, '');
                      value = value.replace(/<br><br><br>&lt.*--><br>/, '');
                      var arrayCopy = [].concat(_toConsumableArray(dataArray));
                      arrayCopy[index].subTitle = value;
                      setAttributes({ dataArray: arrayCopy });
                    }
                  })
                ),
                data.option == 'option-2' && wp.element.createElement(
                  Fragment,
                  null,
                  wp.element.createElement(RichText, {
                    tagName: 'span',
                    placeholder: __('date'),
                    value: data.date,
                    keepPlaceholderOnFocus: 'true',
                    className: 'date',
                    onChange: function onChange(value) {
                      value = value.replace(/&lt;!--td.*}--><br>/, '');
                      value = value.replace(/<br>.*}<br>/, '');
                      value = value.replace(/<br><br><br>&lt.*--><br>/, '');
                      var arrayCopy = [].concat(_toConsumableArray(dataArray));
                      arrayCopy[index].date = value;
                      setAttributes({ dataArray: arrayCopy });
                    }
                  })
                ),
                data.option == 'option-2' && wp.element.createElement(
                  'div',
                  { className: 'bottom-container' },
                  wp.element.createElement(RichText, {
                    tagName: 'div',
                    placeholder: __('Add Reactions'),
                    value: data.shortcode,
                    keepPlaceholderOnFocus: 'true',
                    className: 'shortcode-wrap',
                    onChange: function onChange(value) {
                      value = value.replace(/&lt;!--td.*}--><br>/, '');
                      value = value.replace(/<br>.*}<br>/, '');
                      value = value.replace(/<br><br><br>&lt.*--><br>/, '');
                      var arrayCopy = [].concat(_toConsumableArray(dataArray));
                      arrayCopy[index].shortcode = value;
                      setAttributes({ dataArray: arrayCopy });
                    }
                  }),
                  wp.element.createElement(RichText, {
                    tagName: 'div',
                    placeholder: __('Learn More'),
                    value: data.buttonText,
                    keepPlaceholderOnFocus: 'true',
                    className: 'button-wrap',
                    onChange: function onChange(value) {
                      value = value.replace(/&lt;!--td.*}--><br>/, '');
                      value = value.replace(/<br>.*}<br>/, '');
                      value = value.replace(/<br><br><br>&lt.*--><br>/, '');
                      var arrayCopy = [].concat(_toConsumableArray(dataArray));
                      arrayCopy[index].buttonText = value;
                      setAttributes({ dataArray: arrayCopy });
                    }
                  })
                ),
                data.option !== 'option-6' && 'option-2' !== data.option && wp.element.createElement(RichText, {
                  tagName: 'div',
                  placeholder: __('Learn More'),
                  value: data.buttonText,
                  keepPlaceholderOnFocus: 'true',
                  className: 'button-wrap',
                  onChange: function onChange(value) {
                    value = value.replace(/&lt;!--td.*}--><br>/, '');
                    value = value.replace(/<br>.*}<br>/, '');
                    value = value.replace(/<br><br><br>&lt.*--><br>/, '');
                    var arrayCopy = [].concat(_toConsumableArray(dataArray));
                    arrayCopy[index].buttonText = value;
                    setAttributes({ dataArray: arrayCopy });
                  }
                }),
                data.option == 'option-6' && (wp.element.createElement(
                  'label',
                  null,
                  'Shortcode'
                ), wp.element.createElement(RichText, {
                  tagName: 'div',
                  placeholder: __('Add Shortcode'),
                  value: data.shortcode,
                  keepPlaceholderOnFocus: 'true',
                  className: 'shortcode-wrap',
                  onChange: function onChange(value) {
                    value = value.replace(/&lt;!--td.*}--><br>/, '');
                    value = value.replace(/<br>.*}<br>/, '');
                    value = value.replace(/<br><br><br>&lt.*--><br>/, '');
                    var arrayCopy = [].concat(_toConsumableArray(dataArray));
                    arrayCopy[index].shortcode = value;
                    setAttributes({ dataArray: arrayCopy });
                  }
                }))
              )
            )
          );
        });

        return wp.element.createElement(
          Fragment,
          null,
          wp.element.createElement(
            InspectorControls,
            null,
            wp.element.createElement(
              PanelBody,
              { title: 'Color Settings' },
              wp.element.createElement(
                'div',
                { className: 'inspector-field' },
                wp.element.createElement(
                  'label',
                  null,
                  'Header Title Color'
                ),
                wp.element.createElement(ColorPalette, {
                  value: headerTitleColor,
                  onChange: function onChange(headerTitleColor) {
                    return setAttributes({ headerTitleColor: headerTitleColor });
                  }
                })
              ),
              wp.element.createElement(
                'div',
                { className: 'inspector-field' },
                wp.element.createElement(
                  'label',
                  null,
                  'Background Color'
                ),
                wp.element.createElement(ColorPalette, {
                  value: backgroundColor,
                  onChange: function onChange(backgroundColor) {
                    return setAttributes({ backgroundColor: backgroundColor });
                  }
                })
              )
            )
          ),
          popup && wp.element.createElement(
            'div',
            { className: 'internal-popup' },
            wp.element.createElement(
              'div',
              { className: 'popup-inner' },
              wp.element.createElement('span', {
                onClick: function onClick() {
                  _this2.setState({
                    popup: false
                  });
                },
                className: 'dashicons dashicons-no-alt remove'
              }),
              wp.element.createElement(
                'h3',
                null,
                'Select Item Layout:'
              ),
              wp.element.createElement(
                'ul',
                null,
                wp.element.createElement(
                  'li',
                  {
                    className: 'option-1',
                    onClick: function onClick() {
                      return _this2.addNewItem('option-1');
                    }
                  },
                  'Option 1'
                ),
                wp.element.createElement(
                  'li',
                  {
                    className: 'option-2',
                    onClick: function onClick() {
                      return _this2.addNewItem('option-2');
                    }
                  },
                  'Option 2'
                ),
                wp.element.createElement(
                  'li',
                  {
                    className: 'option-3',
                    onClick: function onClick() {
                      return _this2.addNewItem('option-3');
                    }
                  },
                  'Option 3'
                ),
                wp.element.createElement(
                  'li',
                  {
                    className: 'option-4',
                    onClick: function onClick() {
                      return _this2.addNewItem('option-4');
                    }
                  },
                  'Option 4'
                ),
                wp.element.createElement(
                  'li',
                  {
                    className: 'option-5',
                    onClick: function onClick() {
                      return _this2.addNewItem('option-5');
                    }
                  },
                  'Option 5'
                ),
                wp.element.createElement(
                  'li',
                  {
                    className: 'option-6',
                    onClick: function onClick() {
                      return _this2.addNewItem('option-6');
                    }
                  },
                  'Option 6'
                )
              )
            )
          ),
          wp.element.createElement(
            'div',
            { className: 'related-content' },
            wp.element.createElement(
              'div',
              { className: 'related-content-header' },
              wp.element.createElement(RichText, {
                tagName: 'h2',
                placeholder: __('Title'),
                value: headerTitle,
                keepPlaceholderOnFocus: 'true',
                className: 'header-title',
                style: { color: headerTitleColor },
                onChange: function onChange(value) {
                  value = value.replace(/&lt;!--td.*}--><br>/, '');
                  value = value.replace(/<br>.*}<br>/, '');
                  value = value.replace(/<br><br><br>&lt.*--><br>/, '');
                  setAttributes({ headerTitle: value });
                }
              })
            ),
            wp.element.createElement(
              'div',
              { className: 'related-content-body' },
              itemList,
              wp.element.createElement(
                'div',
                { className: 'item addNewitem' },
                wp.element.createElement(
                  'button',
                  {
                    className: 'components-button add',
                    onClick: function onClick() {
                      _this2.setState({
                        popup: true
                      });
                    }
                  },
                  wp.element.createElement('span', { className: 'dashicons dashicons-plus' }),
                  ' Add New Item'
                )
              )
            )
          )
        );
      }
    }]);

    return ItemComponent;
  }(Component);

  registerBlockType('rg/related-content', {
    title: __('Related Content multi layout'),
    description: __('Related Content multi layout'),
    icon: 'editor-code',
    category: 'nab_amplify',
    keywords: [__('Related Content'), __('gutenberg')],
    attributes: {
      dataArray: {
        type: 'array',
        default: []
      },
      headerTitle: {
        type: 'string',
        default: ''
      },
      headerTitleColor: {
        type: 'string',
        default: '#fdd80f'
      },
      backgroundColor: {
        type: 'string',
        default: '#303030'
      }
    },
    edit: ItemComponent,

    save: function save(props) {
      var attributes = props.attributes;
      var dataArray = attributes.dataArray,
          headerTitle = attributes.headerTitle,
          headerTitleColor = attributes.headerTitleColor,
          backgroundColor = attributes.backgroundColor;


      return wp.element.createElement(
        Fragment,
        null,
        wp.element.createElement(
          'div',
          { className: 'related-content' },
          wp.element.createElement(
            'div',
            { className: 'related-content-header' },
            headerTitle && wp.element.createElement(RichText.Content, {
              tagName: 'h2',
              value: headerTitle,
              className: 'header-title',
              style: { color: headerTitleColor }
            })
          ),
          wp.element.createElement(
            'div',
            { className: 'related-content-body' },
            dataArray.map(function (data, index) {
              return wp.element.createElement(
                'div',
                { className: 'item ' + data.option },
                wp.element.createElement(
                  'div',
                  { className: 'inner', style: { backgroundColor: backgroundColor } },
                  data.bgMedia && data.option == 'option-1' || data.option == 'option-4' ? wp.element.createElement(
                    'div',
                    { className: 'background-image' },
                    wp.element.createElement('img', { src: data.bgMedia })
                  ) : null,
                  data.option == 'option-1' || data.option == 'option-3' || data.option == 'option-6' ? wp.element.createElement(
                    'div',
                    { className: 'advertising' },
                    wp.element.createElement(RichText.Content, { tagName: 'span', value: data.advertising })
                  ) : null,
                  data.media && wp.element.createElement(
                    'div',
                    { className: 'image' },
                    wp.element.createElement('img', { src: data.media, alt: data.mediaAlt })
                  ),
                  'option-2' === data.option && data.bookmark && wp.element.createElement(RichText.Content, {
                    tagName: 'div',
                    value: data.bookmark,
                    className: 'bookmark-wrap'
                  }),
                  'option-5' === data.option && data.bookmark && wp.element.createElement(RichText.Content, {
                    tagName: 'div',
                    value: data.bookmark,
                    className: 'bookmark-wrap'
                  }),
                  data.videoIcon && wp.element.createElement(
                    'div',
                    { className: 'video-icon' },
                    data.videoIconLink ? wp.element.createElement(
                      'a',
                      { href: data.videoIconLink, target: data.videoIconLinkTarget ? '_blank' : '_self', rel: 'noopener noreferrer' },
                      wp.element.createElement('img', { src: data.videoIcon })
                    ) : wp.element.createElement('img', { src: data.videoIcon, alt: 'Play Icon' })
                  ),
                  wp.element.createElement(
                    'div',
                    { className: 'related-content-wrap' },
                    data.option !== 'option-3' && data.option !== 'option-6' && wp.element.createElement(
                      Fragment,
                      null,
                      data.title && wp.element.createElement(RichText.Content, {
                        tagName: 'h2',
                        value: data.title,
                        className: 'title'
                      }),
                      data.subTitle && wp.element.createElement(RichText.Content, {
                        tagName: 'strong',
                        value: data.subTitle,
                        className: 'sub-title'
                      })
                    ),
                    data.date && data.option == 'option-2' && wp.element.createElement(
                      Fragment,
                      null,
                      wp.element.createElement(RichText.Content, {
                        tagName: 'span',
                        value: data.date,
                        className: 'date'
                      })
                    ),
                    data.option == 'option-2' && wp.element.createElement(
                      'div',
                      { className: 'bottom-container' },
                      data.shortcode && wp.element.createElement(RichText.Content, {
                        tagName: 'div',
                        value: data.shortcode,
                        className: 'shortcode-wrap'
                      }),
                      wp.element.createElement(RichText.Content, {
                        tagName: 'div',
                        value: data.buttonText,
                        className: 'button-wrap'
                      })
                    ),
                    data.option !== 'option-6' && data.option !== 'option-2' && wp.element.createElement(RichText.Content, {
                      tagName: 'div',
                      value: data.buttonText,
                      className: 'button-wrap'
                    }),
                    data.option == 'option-6' && wp.element.createElement(RichText.Content, {
                      tagName: 'div',
                      value: data.shortcode,
                      className: 'shortcode-wrap'
                    })
                  )
                )
              );
            })
          )
        )
      );
    }
  });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element, wp.blockEditor);

/***/ }),
/* 8 */
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
  var InspectorControls = wpEditor.InspectorControls,
      RichText = wpEditor.RichText,
      MediaUpload = wpEditor.MediaUpload;
  var PanelBody = wpComponents.PanelBody,
      PanelRow = wpComponents.PanelRow,
      ToggleControl = wpComponents.ToggleControl,
      TextControl = wpComponents.TextControl,
      Tooltip = wpComponents.Tooltip,
      Button = wpComponents.Button;

  var ItemComponent = function (_Component) {
    _inherits(ItemComponent, _Component);

    function ItemComponent(props) {
      _classCallCheck(this, ItemComponent);

      var _this = _possibleConstructorReturn(this, (ItemComponent.__proto__ || Object.getPrototypeOf(ItemComponent)).call(this, props));

      _this.state = { popup: false };
      _this.addNewItem = _this.addNewItem.bind(_this);
      return _this;
    }

    _createClass(ItemComponent, [{
      key: 'addNewItem',
      value: function addNewItem(name) {
        var dataArray = this.props.attributes.dataArray;
        var setAttributes = this.props.setAttributes;

        var attr = void 0;
        if (name == 'option-1') {
          attr = {
            index: dataArray.length,
            option: name,
            title: '',
            subTitle: '',
            description: '',
            buttonText: '<a href="#">Read More</a>',
            shortcode: '',
            bookmark: ''
          };
        }
        if (name == 'option-2') {
          attr = {
            index: dataArray.length,
            option: name,
            advertising: 'Sponsored',
            shortcode: ''
          };
        }

        setAttributes({
          dataArray: [].concat(_toConsumableArray(dataArray), [attr])
        });
        this.setState({
          popup: false
        });
      }
    }, {
      key: 'componentDidMount',
      value: function componentDidMount() {
        //const { dataArray } = this.props.attributes
        //if (0 === dataArray.length) {
        //this.initList()
        //}
      }
    }, {
      key: 'initList',
      value: function initList() {
        // const { dataArray } = this.props.attributes
        // const { setAttributes } = this.props
        // setAttributes({
        //   dataArray: [
        //     ...dataArray,
        //     {
        //       index: dataArray.length,
        //       title: '',
        //       subTitle: '',
        //       description: '',            
        //       buttonText: '<a href="#">Read More</a>',
        //       shortcode: '',
        //       bookmark: ''
        //     }
        //   ]
        // })
      }
    }, {
      key: 'moveItem',
      value: function moveItem(oldIndex, newIndex) {
        var _props = this.props,
            attributes = _props.attributes,
            setAttributes = _props.setAttributes;
        var dataArray = attributes.dataArray;


        var copyData = [].concat(_toConsumableArray(dataArray));

        copyData[oldIndex] = dataArray[newIndex];
        copyData[newIndex] = dataArray[oldIndex];

        setAttributes({
          dataArray: copyData
        });

        this.forceUpdate();
      }
    }, {
      key: 'render',
      value: function render() {
        var _this2 = this;

        var _props2 = this.props,
            attributes = _props2.attributes,
            setAttributes = _props2.setAttributes;
        var popup = this.state.popup;
        var dataArray = attributes.dataArray;


        var itemList = dataArray.map(function (data, index) {
          return wp.element.createElement(
            'div',
            { className: 'item ' + data.option },
            wp.element.createElement(
              'div',
              { className: 'settings' },
              wp.element.createElement(
                'div',
                { className: 'move-item-controls' },
                0 < index && wp.element.createElement(
                  Tooltip,
                  { text: 'Move Left' },
                  wp.element.createElement('span', {
                    className: 'dashicons dashicons-arrow-left-alt2 move-left',
                    onClick: function onClick() {
                      return _this2.moveItem(index, index - 1);
                    }
                  })
                ),
                index + 1 < dataArray.length && wp.element.createElement(
                  Tooltip,
                  { text: 'Move Right' },
                  wp.element.createElement('span', {
                    className: 'dashicons dashicons-arrow-right-alt2 move-right',
                    onClick: function onClick() {
                      return _this2.moveItem(index, index + 1);
                    }
                  })
                )
              ),
              wp.element.createElement('span', {
                className: 'dashicons dashicons-no-alt remove',
                onClick: function onClick() {
                  var qewQusote = dataArray.filter(function (item) {
                    return item.index != data.index;
                  }).map(function (t) {
                    if (t.index > data.index) {
                      t.index -= 1;
                    }

                    return t;
                  });

                  setAttributes({
                    dataArray: qewQusote
                  });
                }
              })
            ),
            wp.element.createElement(
              'div',
              { className: 'inner' },
              'option-2' === data.option ? wp.element.createElement(
                Fragment,
                null,
                wp.element.createElement(
                  'div',
                  { className: 'advertising' },
                  wp.element.createElement(RichText, {
                    tagName: 'span',
                    placeholder: __('Sponsored'),
                    keepPlaceholderOnFocus: 'true',
                    value: data.advertising,
                    onChange: function onChange(value) {
                      value = value.replace(/&lt;!--td.*}--><br>/, '');
                      value = value.replace(/<br>.*}<br>/, '');
                      value = value.replace(/<br><br><br>&lt.*--><br>/, '');
                      var arrayCopy = [].concat(_toConsumableArray(dataArray));
                      arrayCopy[index].advertising = value;
                      setAttributes({ dataArray: arrayCopy });
                    }
                  })
                ),
                wp.element.createElement(RichText, {
                  tagName: 'div',
                  placeholder: __('Add Shortcode'),
                  value: data.shortcode,
                  keepPlaceholderOnFocus: 'true',
                  className: 'shortcode-wrap',
                  onChange: function onChange(value) {
                    value = value.replace(/&lt;!--td.*}--><br>/, '');
                    value = value.replace(/<br>.*}<br>/, '');
                    value = value.replace(/<br><br><br>&lt.*--><br>/, '');
                    var arrayCopy = [].concat(_toConsumableArray(dataArray));
                    arrayCopy[index].shortcode = value;
                    setAttributes({ dataArray: arrayCopy });
                  }
                })
              ) : wp.element.createElement(
                Fragment,
                null,
                wp.element.createElement(RichText, {
                  tagName: 'div',
                  placeholder: __('Bookmark'),
                  value: data.bookmark,
                  keepPlaceholderOnFocus: 'true',
                  className: 'bookmark-wrap',
                  onChange: function onChange(value) {
                    value = value.replace(/&lt;!--td.*}--><br>/, '');
                    value = value.replace(/<br>.*}<br>/, '');
                    value = value.replace(/<br><br><br>&lt.*--><br>/, '');
                    var arrayCopy = [].concat(_toConsumableArray(dataArray));
                    arrayCopy[index].bookmark = value;
                    setAttributes({ dataArray: arrayCopy });
                  }
                }),
                wp.element.createElement(RichText, {
                  tagName: 'h3',
                  placeholder: __('Title'),
                  keepPlaceholderOnFocus: 'true',
                  value: data.title,
                  className: 'title',
                  onChange: function onChange(value) {
                    value = value.replace(/&lt;!--td.*}--><br>/, '');
                    value = value.replace(/<br>.*}<br>/, '');
                    value = value.replace(/<br><br><br>&lt.*--><br>/, '');
                    var arrayCopy = [].concat(_toConsumableArray(dataArray));
                    arrayCopy[index].title = value;
                    setAttributes({ dataArray: arrayCopy });
                  }
                }),
                wp.element.createElement(RichText, {
                  tagName: 'strong',
                  placeholder: __('Sub Title'),
                  keepPlaceholderOnFocus: 'true',
                  value: data.subTitle,
                  className: 'sub-title',
                  onChange: function onChange(value) {
                    value = value.replace(/&lt;!--td.*}--><br>/, '');
                    value = value.replace(/<br>.*}<br>/, '');
                    value = value.replace(/<br><br><br>&lt.*--><br>/, '');
                    var arrayCopy = [].concat(_toConsumableArray(dataArray));
                    arrayCopy[index].subTitle = value;
                    setAttributes({ dataArray: arrayCopy });
                  }
                }),
                wp.element.createElement(
                  'div',
                  { className: 'bottom-container' },
                  wp.element.createElement(RichText, {
                    tagName: 'div',
                    placeholder: __('Add Reactions'),
                    value: data.shortcode,
                    keepPlaceholderOnFocus: 'true',
                    className: 'shortcode-wrap',
                    onChange: function onChange(value) {
                      value = value.replace(/&lt;!--td.*}--><br>/, '');
                      value = value.replace(/<br>.*}<br>/, '');
                      value = value.replace(/<br><br><br>&lt.*--><br>/, '');
                      var arrayCopy = [].concat(_toConsumableArray(dataArray));
                      arrayCopy[index].shortcode = value;
                      setAttributes({ dataArray: arrayCopy });
                    }
                  }),
                  wp.element.createElement(RichText, {
                    tagName: 'div',
                    placeholder: __('Read More'),
                    value: data.buttonText,
                    keepPlaceholderOnFocus: 'true',
                    className: 'button-wrap',
                    onChange: function onChange(value) {
                      value = value.replace(/&lt;!--td.*}--><br>/, '');
                      value = value.replace(/<br>.*}<br>/, '');
                      value = value.replace(/<br><br><br>&lt.*--><br>/, '');
                      var arrayCopy = [].concat(_toConsumableArray(dataArray));
                      arrayCopy[index].buttonText = value;
                      setAttributes({ dataArray: arrayCopy });
                    }
                  })
                )
              )
            )
          );
        });

        return wp.element.createElement(
          Fragment,
          null,
          popup && wp.element.createElement(
            'div',
            { className: 'internal-popup' },
            wp.element.createElement(
              'div',
              { className: 'popup-inner related-content-popup' },
              wp.element.createElement('span', {
                onClick: function onClick() {
                  _this2.setState({
                    popup: false
                  });
                },
                className: 'dashicons dashicons-no-alt remove'
              }),
              wp.element.createElement(
                'h3',
                null,
                'Select Item Layout:'
              ),
              wp.element.createElement(
                'ul',
                null,
                wp.element.createElement(
                  'li',
                  {
                    className: 'option-1',
                    onClick: function onClick() {
                      return _this2.addNewItem('option-1');
                    }
                  },
                  'Option 1'
                ),
                wp.element.createElement(
                  'li',
                  {
                    className: 'option-2',
                    onClick: function onClick() {
                      return _this2.addNewItem('option-2');
                    }
                  },
                  'Option 2'
                )
              )
            )
          ),
          wp.element.createElement(
            'div',
            { className: 'related-content-2' },
            itemList,
            wp.element.createElement(
              'div',
              { className: 'item additem' },
              wp.element.createElement(
                'button',
                {
                  className: 'components-button add',
                  onClick: function onClick() {
                    _this2.setState({
                      popup: true
                    });
                  }
                },
                wp.element.createElement('span', { className: 'dashicons dashicons-plus' }),
                ' Add New Item'
              )
            )
          )
        );
      }
    }]);

    return ItemComponent;
  }(Component);

  registerBlockType('rg/related-content-2', {
    title: __('Related Content'),
    description: __('Related Content'),
    icon: 'editor-code',
    category: 'nab_amplify',
    keywords: [__('Related Content 2'), __('Gutenberg')],
    attributes: {
      dataArray: {
        type: 'array',
        default: []
      }
    },
    edit: ItemComponent,

    save: function save(props) {
      var attributes = props.attributes;
      var dataArray = attributes.dataArray;


      return wp.element.createElement(
        Fragment,
        null,
        wp.element.createElement(
          'div',
          { className: 'related-content-2' },
          dataArray.map(function (data, index) {
            return wp.element.createElement(
              'div',
              { className: 'item ' + data.option },
              wp.element.createElement(
                'div',
                { className: 'inner' },
                'option-2' === data.option ? wp.element.createElement(
                  Fragment,
                  null,
                  wp.element.createElement(
                    'div',
                    { className: 'advertising' },
                    wp.element.createElement(RichText.Content, { tagName: 'span', value: data.advertising })
                  ),
                  data.shortcode && wp.element.createElement(RichText.Content, {
                    tagName: 'div',
                    value: data.shortcode,
                    className: 'shortcode-wrap'
                  })
                ) : wp.element.createElement(
                  Fragment,
                  null,
                  data.bookmark && wp.element.createElement(RichText.Content, {
                    tagName: 'div',
                    value: data.bookmark,
                    className: 'bookmark-wrap'
                  }),
                  data.title && wp.element.createElement(RichText.Content, {
                    tagName: 'h3',
                    value: data.title,
                    className: 'title'
                  }),
                  data.subTitle && wp.element.createElement(RichText.Content, {
                    tagName: 'strong',
                    value: data.subTitle,
                    className: 'sub-title'
                  }),
                  wp.element.createElement(
                    'div',
                    { className: 'bottom-container' },
                    data.shortcode && wp.element.createElement(RichText.Content, {
                      tagName: 'div',
                      value: data.shortcode,
                      className: 'shortcode-wrap'
                    }),
                    wp.element.createElement(RichText.Content, {
                      tagName: 'div',
                      value: data.buttonText,
                      className: 'button-wrap'
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
/* 9 */
/***/ (function(module, exports) {

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _toConsumableArray(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } else { return Array.from(arr); } }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

;(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement, wpBlockEditor) {
  var __ = wpI18n.__;
  var registerBlockType = wpBlocks.registerBlockType;
  var Fragment = wpElement.Fragment,
      Component = wpElement.Component;
  var InspectorControls = wpEditor.InspectorControls,
      RichText = wpEditor.RichText,
      MediaUpload = wpEditor.MediaUpload;
  var PanelBody = wpComponents.PanelBody,
      PanelRow = wpComponents.PanelRow,
      ToggleControl = wpComponents.ToggleControl,
      TextControl = wpComponents.TextControl,
      Tooltip = wpComponents.Tooltip,
      Button = wpComponents.Button;
  var ColorPalette = wpBlockEditor.ColorPalette;

  var ItemComponent = function (_Component) {
    _inherits(ItemComponent, _Component);

    function ItemComponent() {
      _classCallCheck(this, ItemComponent);

      return _possibleConstructorReturn(this, (ItemComponent.__proto__ || Object.getPrototypeOf(ItemComponent)).apply(this, arguments));
    }

    _createClass(ItemComponent, [{
      key: 'componentDidMount',
      value: function componentDidMount() {
        var dataArray = this.props.attributes.dataArray;

        if (0 === dataArray.length) {
          this.initList();
        }
      }
    }, {
      key: 'initList',
      value: function initList() {
        var dataArray = this.props.attributes.dataArray;
        var setAttributes = this.props.setAttributes;

        setAttributes({
          dataArray: [].concat(_toConsumableArray(dataArray), [{
            index: dataArray.length,
            title: '',
            subTitle: '',
            description: '',
            media: '',
            bgMedia: '',
            shortcode: '',
            buttonText: '<a href="#" class="btn">Read More</a>'
          }])
        });
      }
    }, {
      key: 'moveItem',
      value: function moveItem(oldIndex, newIndex) {
        var _props = this.props,
            attributes = _props.attributes,
            setAttributes = _props.setAttributes;
        var dataArray = attributes.dataArray;


        var copyData = [].concat(_toConsumableArray(dataArray));

        copyData[oldIndex] = dataArray[newIndex];
        copyData[newIndex] = dataArray[oldIndex];

        setAttributes({
          dataArray: copyData
        });

        this.forceUpdate();
      }
    }, {
      key: 'render',
      value: function render() {
        var _this2 = this;

        var _props2 = this.props,
            attributes = _props2.attributes,
            setAttributes = _props2.setAttributes,
            clientId = _props2.clientId;
        var dataArray = attributes.dataArray;

        setAttributes({ blockClientId: clientId });

        var getImageButton = function getImageButton(openEvent, index) {
          if (dataArray[index].media) {
            return wp.element.createElement(
              Fragment,
              null,
              wp.element.createElement('span', {
                onClick: openEvent,
                className: 'dashicons dashicons-edit edit-image'
              }),
              wp.element.createElement('img', {
                src: dataArray[index].media,
                alt: dataArray[index].title,
                className: 'img'
              })
            );
          } else {
            return wp.element.createElement(
              Button,
              { onClick: openEvent, className: 'button button-large' },
              wp.element.createElement('span', { className: 'dashicons dashicons-upload' }),
              ' Upload Image'
            );
          }
        };

        var itemList = dataArray.map(function (data, index) {
          return wp.element.createElement(
            'div',
            { className: 'item' },
            wp.element.createElement(
              'div',
              { className: 'settings' },
              wp.element.createElement(
                'div',
                { className: 'move-item-controls' },
                0 < index && wp.element.createElement(
                  Tooltip,
                  { text: 'Move Left' },
                  wp.element.createElement('span', {
                    className: 'dashicons dashicons-arrow-up-alt2',
                    onClick: function onClick() {
                      return _this2.moveItem(index, index - 1);
                    }
                  })
                ),
                index + 1 < dataArray.length && wp.element.createElement(
                  Tooltip,
                  { text: 'Move Right' },
                  wp.element.createElement('span', {
                    className: 'dashicons dashicons-arrow-down-alt2',
                    onClick: function onClick() {
                      return _this2.moveItem(index, index + 1);
                    }
                  })
                )
              ),
              wp.element.createElement('span', {
                className: 'dashicons dashicons-no-alt remove',
                onClick: function onClick() {
                  var qewQusote = dataArray.filter(function (item) {
                    return item.index != data.index;
                  }).map(function (t) {
                    if (t.index > data.index) {
                      t.index -= 1;
                    }

                    return t;
                  });

                  setAttributes({
                    dataArray: qewQusote
                  });
                }
              })
            ),
            wp.element.createElement(
              'div',
              { className: 'inner' },
              wp.element.createElement(
                'div',
                { className: 'main-image' },
                wp.element.createElement(
                  'div',
                  { className: 'main-image-wrap' },
                  wp.element.createElement(MediaUpload, {
                    onSelect: function onSelect(media) {
                      var arrayCopy = [].concat(_toConsumableArray(dataArray));
                      arrayCopy[index].bgMedia = media.url;
                      setAttributes({ dataArray: arrayCopy });
                    },
                    type: 'image',
                    value: attributes.imageID,
                    render: function render(_ref) {
                      var open = _ref.open;

                      if (dataArray[index].bgMedia) {
                        return wp.element.createElement(
                          Fragment,
                          null,
                          wp.element.createElement('span', {
                            onClick: open,
                            className: 'dashicons dashicons-edit edit-image'
                          }),
                          wp.element.createElement('img', { src: dataArray[index].bgMedia, className: 'img' })
                        );
                      } else {
                        return wp.element.createElement(
                          Button,
                          { onClick: open, className: 'button button-large' },
                          wp.element.createElement('span', { className: 'dashicons dashicons-upload' }),
                          ' ',
                          'Upload Main Image'
                        );
                      }
                    }
                  })
                )
              ),
              wp.element.createElement(
                'div',
                { className: 'item-list-right' },
                wp.element.createElement(
                  'div',
                  { className: 'item-list-main' },
                  wp.element.createElement(
                    'div',
                    { className: 'item-list-wrap' },
                    wp.element.createElement(
                      'style',
                      null,
                      '#block-' + clientId + ' .grid-list .item.active .left{background:' + attributes.ThumbBgColor + '}'
                    ),
                    wp.element.createElement(
                      'div',
                      { className: 'left' },
                      wp.element.createElement(MediaUpload, {
                        onSelect: function onSelect(media) {
                          var arrayCopy = [].concat(_toConsumableArray(dataArray));
                          arrayCopy[index].media = media.url;
                          setAttributes({ dataArray: arrayCopy });
                        },
                        type: 'image',
                        value: attributes.imageID,
                        render: function render(_ref2) {
                          var open = _ref2.open;
                          return getImageButton(open, index);
                        }
                      })
                    ),
                    wp.element.createElement(
                      'div',
                      { className: 'right' },
                      wp.element.createElement(RichText, {
                        tagName: 'h3',
                        placeholder: __('Title'),
                        keepPlaceholderOnFocus: 'true',
                        value: data.title,
                        className: 'title',
                        onChange: function onChange(value) {
                          value = value.replace(/&lt;!--td.*}--><br>/, '');
                          value = value.replace(/<br>.*}<br>/, '');
                          value = value.replace(/<br><br><br>&lt.*--><br>/, '');
                          var arrayCopy = [].concat(_toConsumableArray(dataArray));
                          arrayCopy[index].title = value;
                          setAttributes({ dataArray: arrayCopy });
                        },
                        style: {
                          color: attributes.TitleColor
                        }
                      }),
                      wp.element.createElement(RichText, {
                        tagName: 'strong',
                        placeholder: __('Sub Title'),
                        keepPlaceholderOnFocus: 'true',
                        value: data.subTitle,
                        className: 'sub-title',
                        onChange: function onChange(value) {
                          value = value.replace(/&lt;!--td.*}--><br>/, '');
                          value = value.replace(/<br>.*}<br>/, '');
                          value = value.replace(/<br><br><br>&lt.*--><br>/, '');
                          var arrayCopy = [].concat(_toConsumableArray(dataArray));
                          arrayCopy[index].subTitle = value;
                          setAttributes({ dataArray: arrayCopy });
                        },
                        style: {
                          color: attributes.SubTitleColor
                        }
                      }),
                      wp.element.createElement(RichText, {
                        tagName: 'p',
                        placeholder: __('Description'),
                        value: data.description,
                        keepPlaceholderOnFocus: 'true',
                        className: 'description',
                        onChange: function onChange(value) {
                          value = value.replace(/&lt;!--td.*}--><br>/, '');
                          value = value.replace(/<br>.*}<br>/, '');
                          value = value.replace(/<br><br><br>&lt.*--><br>/, '');
                          var arrayCopy = [].concat(_toConsumableArray(dataArray));
                          arrayCopy[index].description = value;
                          setAttributes({ dataArray: arrayCopy });
                        },
                        style: {
                          color: attributes.DescriptionColor
                        }
                      }),
                      wp.element.createElement(RichText, {
                        tagName: 'div',
                        placeholder: __('Add Reactions'),
                        value: data.shortcode,
                        keepPlaceholderOnFocus: 'true',
                        className: 'shortcode-wrap',
                        onChange: function onChange(value) {
                          value = value.replace(/&lt;!--td.*}--><br>/, '');
                          value = value.replace(/<br>.*}<br>/, '');
                          value = value.replace(/<br><br><br>&lt.*--><br>/, '');
                          var arrayCopy = [].concat(_toConsumableArray(dataArray));
                          arrayCopy[index].shortcode = value;
                          setAttributes({ dataArray: arrayCopy });
                        }
                      }),
                      wp.element.createElement(RichText, {
                        tagName: 'div',
                        placeholder: __('Read More'),
                        value: data.buttonText,
                        keepPlaceholderOnFocus: 'true',
                        className: 'button-wrap',
                        onChange: function onChange(value) {
                          value = value.replace(/&lt;!--td.*}--><br>/, '');
                          value = value.replace(/<br>.*}<br>/, '');
                          value = value.replace(/<br><br><br>&lt.*--><br>/, '');
                          var arrayCopy = [].concat(_toConsumableArray(dataArray));
                          arrayCopy[index].buttonText = value;
                          setAttributes({ dataArray: arrayCopy });
                        }
                      })
                    )
                  )
                )
              )
            )
          );
        });

        return wp.element.createElement(
          Fragment,
          null,
          wp.element.createElement(
            InspectorControls,
            null,
            wp.element.createElement(
              PanelBody,
              { title: 'Color Settings', initialOpen: false },
              wp.element.createElement(
                'div',
                { className: 'inspector-field' },
                wp.element.createElement(
                  'label',
                  null,
                  'Header Title Color:'
                ),
                wp.element.createElement(ColorPalette, {
                  value: attributes.HeaderTitleColor,
                  onChange: function onChange(HeaderTitleColor) {
                    return setAttributes({ HeaderTitleColor: HeaderTitleColor });
                  }
                })
              ),
              wp.element.createElement(
                'div',
                { className: 'inspector-field' },
                wp.element.createElement(
                  'label',
                  null,
                  'Title Color:'
                ),
                wp.element.createElement(ColorPalette, {
                  value: attributes.TitleColor,
                  onChange: function onChange(TitleColor) {
                    return setAttributes({ TitleColor: TitleColor });
                  }
                })
              ),
              wp.element.createElement(
                'div',
                { className: 'inspector-field' },
                wp.element.createElement(
                  'label',
                  null,
                  'Sub-Title Color:'
                ),
                wp.element.createElement(ColorPalette, {
                  value: attributes.SubTitleColor,
                  onChange: function onChange(SubTitleColor) {
                    return setAttributes({ SubTitleColor: SubTitleColor });
                  }
                })
              ),
              wp.element.createElement(
                'div',
                { className: 'inspector-field' },
                wp.element.createElement(
                  'label',
                  null,
                  'Description text Color:'
                ),
                wp.element.createElement(ColorPalette, {
                  value: attributes.DescriptionColor,
                  onChange: function onChange(DescriptionColor) {
                    return setAttributes({ DescriptionColor: DescriptionColor });
                  }
                })
              ),
              wp.element.createElement(
                'div',
                { className: 'inspector-field' },
                wp.element.createElement(
                  'label',
                  null,
                  'Active Thumbnail Background:'
                ),
                wp.element.createElement(ColorPalette, {
                  value: attributes.ThumbBgColor,
                  onChange: function onChange(ThumbBgColor) {
                    return setAttributes({ ThumbBgColor: ThumbBgColor });
                  }
                })
              )
            )
          ),
          wp.element.createElement(
            'div',
            { className: 'community-curator' },
            wp.element.createElement(
              'div',
              { className: 'community-curator-header' },
              wp.element.createElement(RichText, {
                tagName: 'h2',
                placeholder: __('Title'),
                keepPlaceholderOnFocus: 'true',
                value: attributes.HeaderTitle,
                className: 'title',
                onChange: function onChange(value) {
                  setAttributes({ HeaderTitle: value });
                },
                style: {
                  color: attributes.HeaderTitleColor
                }
              })
            ),
            wp.element.createElement(
              'div',
              { className: 'community-curator-body' },
              itemList,
              wp.element.createElement(
                'div',
                { className: 'item additem' },
                wp.element.createElement(
                  'button',
                  {
                    className: 'components-button add',
                    onClick: function onClick() {
                      _this2.initList();
                    }
                  },
                  wp.element.createElement('span', { className: 'dashicons dashicons-plus' }),
                  ' Add New Item'
                )
              )
            )
          )
        );
      }
    }]);

    return ItemComponent;
  }(Component);

  registerBlockType('rg/community-curator', {
    title: __('Community Curator'),
    description: __('community-curator'),
    icon: 'editor-code',
    category: 'nab_amplify',
    keywords: [__('Community Curator'), __('Gutenberg')],
    attributes: {
      dataArray: {
        type: 'array',
        default: []
      },
      TitleColor: {
        type: 'string',
        default: '#fff'
      },
      SubTitleColor: {
        type: 'string',
        default: '#0ca5ea'
      },
      DescriptionColor: {
        type: 'string',
        default: '#fff'
      },
      ThumbBgColor: {
        type: 'string',
        default: '#0ca5ea'
      },
      HeaderTitle: {
        type: 'string',
        default: ''
      },
      HeaderTitleColor: {
        type: 'string',
        default: '#fdd80f'
      },
      blockClientId: {
        type: 'string',
        default: ''
      }
    },
    edit: ItemComponent,

    save: function save(props) {
      var attributes = props.attributes;
      var dataArray = attributes.dataArray;


      return wp.element.createElement(
        'div',
        { className: 'community-curator', id: 'block-' + attributes.blockClientId },
        wp.element.createElement(
          'div',
          { className: 'community-curator-header' },
          wp.element.createElement(RichText.Content, {
            tagName: 'h2',
            value: attributes.HeaderTitle,
            style: { color: attributes.HeaderTitleColor }
          })
        ),
        wp.element.createElement(
          'div',
          { className: 'community-curator-body' },
          wp.element.createElement(
            'div',
            {
              className: 'big-section',
              style: {
                backgroundImage: 'url(' + dataArray[0].bgMedia + ')'
              }
            },
            wp.element.createElement(
              'div',
              { className: 'contents' },
              dataArray[0].title && wp.element.createElement(RichText.Content, {
                tagName: 'h3',
                value: dataArray[0].title,
                className: 'title',
                style: {
                  color: attributes.TitleColor
                }
              }),
              dataArray[0].subTitle && wp.element.createElement(RichText.Content, {
                tagName: 'strong',
                value: dataArray[0].subTitle,
                className: 'sub-title',
                style: {
                  color: attributes.SubTitleColor
                }
              }),
              dataArray[0].description && wp.element.createElement(RichText.Content, {
                tagName: 'p',
                value: dataArray[0].description,
                className: 'description',
                style: {
                  color: attributes.DescriptionColor
                }
              }),
              dataArray[0].shortcode && wp.element.createElement(RichText.Content, {
                tagName: 'div',
                value: dataArray[0].shortcode,
                className: 'shortcode-wrap'
              }),
              dataArray[0].buttonText && wp.element.createElement(RichText.Content, {
                tagName: 'div',
                value: dataArray[0].buttonText,
                className: 'button-wrap'
              })
            )
          ),
          wp.element.createElement(
            'div',
            { className: 'grid-list' },
            dataArray.map(function (data, index) {
              return wp.element.createElement(
                Fragment,
                null,
                data.title && wp.element.createElement(
                  'div',
                  { className: 'item ' + (index == 0 ? 'active' : '') },
                  wp.element.createElement(
                    'div',
                    { className: 'inner' },
                    data.bgMedia ? wp.element.createElement(
                      'div',
                      { className: 'main-image-wrap' },
                      wp.element.createElement('img', { className: 'main-image', src: data.bgMedia, alt: data.title, style: {
                          display: 'none'
                        } })
                    ) : null,
                    wp.element.createElement(
                      'div',
                      { className: 'item-list-right' },
                      wp.element.createElement(
                        'div',
                        { className: 'item-list-main' },
                        wp.element.createElement(
                          'div',
                          { className: 'item-list-wrap' },
                          wp.element.createElement(
                            'style',
                            null,
                            '#block-' + attributes.blockClientId + ' .grid-list .item.active .left{background:' + attributes.ThumbBgColor + '}'
                          ),
                          wp.element.createElement(
                            'div',
                            { className: 'left' },
                            data.media ? wp.element.createElement('img', { src: data.media, alt: data.title }) : wp.element.createElement(
                              'div',
                              { className: 'no-image' },
                              'No Image'
                            )
                          ),
                          wp.element.createElement(
                            'div',
                            { className: 'right' },
                            data.title && wp.element.createElement(RichText.Content, {
                              tagName: 'h3',
                              value: data.title,
                              className: 'title',
                              style: {
                                color: attributes.TitleColor
                              }
                            }),
                            data.subTitle && wp.element.createElement(RichText.Content, {
                              tagName: 'strong',
                              value: data.subTitle,
                              className: 'sub-title',
                              style: {
                                color: attributes.SubTitleColor
                              }
                            }),
                            data.description && wp.element.createElement(RichText.Content, {
                              tagName: 'p',
                              value: data.description,
                              className: 'description',
                              style: {
                                color: attributes.DescriptionColor
                              }
                            }),
                            data.shortcode && wp.element.createElement(RichText.Content, {
                              tagName: 'div',
                              value: data.shortcode,
                              className: 'shortcode-wrap'
                            }),
                            data.buttonText && wp.element.createElement(RichText.Content, {
                              tagName: 'div',
                              value: data.buttonText,
                              className: 'button-wrap'
                            })
                          )
                        )
                      )
                    )
                  )
                )
              );
            })
          )
        )
      );
    }
  });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element, wp.blockEditor);

/***/ }),
/* 10 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_lodash_times__ = __webpack_require__(11);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_lodash_times___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_lodash_times__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_memize__ = __webpack_require__(27);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_memize___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1_memize__);
var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _toConsumableArray(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } else { return Array.from(arr); } }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }


(function (wpBlocks, wpBlockEditor, wpComponents, wpElement, wpI18n) {
  var registerBlockType = wpBlocks.registerBlockType;
  var Component = wpElement.Component,
      Fragment = wpElement.Fragment,
      useState = wpElement.useState;
  var __ = wpI18n.__;
  var RichText = wpBlockEditor.RichText,
      InspectorControls = wpBlockEditor.InspectorControls,
      MediaUpload = wpBlockEditor.MediaUpload,
      AlignmentToolbar = wpBlockEditor.AlignmentToolbar,
      InnerBlocks = wpBlockEditor.InnerBlocks;
  var createBlock = wp.blocks.createBlock;

  var _wp$data$select = wp.data.select('core/block-editor'),
      getBlock = _wp$data$select.getBlock;

  var _wp$data$dispatch = wp.data.dispatch('core/block-editor'),
      insertBlock = _wp$data$dispatch.insertBlock;

  var PanelBody = wpComponents.PanelBody,
      PanelRow = wpComponents.PanelRow,
      Button = wpComponents.Button,
      RangeControl = wpComponents.RangeControl,
      ToggleControl = wpComponents.ToggleControl,
      ServerSideRender = wpComponents.ServerSideRender,
      ColorPicker = wpComponents.ColorPicker,
      BaseControl = wpComponents.BaseControl,
      FontSizePicker = wpComponents.FontSizePicker,
      ColorPalette = wpComponents.ColorPalette,
      BoxControl = wpComponents.BoxControl;

  var amplifyTabs = function (_Component) {
    _inherits(amplifyTabs, _Component);

    function amplifyTabs() {
      _classCallCheck(this, amplifyTabs);

      var _this = _possibleConstructorReturn(this, (amplifyTabs.__proto__ || Object.getPrototypeOf(amplifyTabs)).apply(this, arguments));

      _this.state = {
        tabs: []
      };
      return _this;
    }

    _createClass(amplifyTabs, [{
      key: 'reInitTabs',
      value: function reInitTabs() {
        setTimeout(function () {
          jQuery('#tabs').tabs('refresh');
        }, 500);
      }
    }, {
      key: 'InitTabs',
      value: function InitTabs() {
        setTimeout(function () {
          jQuery('#tabs').tabs();
        }, 500);
      }
    }, {
      key: 'componentWillMount',
      value: function componentWillMount() {
        this.InitTabs();
      }
    }, {
      key: 'componentDidUpdate',
      value: function componentDidUpdate(previousProps, previousState) {
        var tabs = this.props.attributes.tabs;
        var clientId = this.props.clientId;

        this.props.setAttributes({ tabsCount: tabs.length });
        this.props.setAttributes({ amplifyTabBlockid: clientId });
      }
    }, {
      key: 'makeid',
      value: function makeid(length) {
        var result = '';
        var characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = 20;
        for (var i = 0; i < length; i++) {
          result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
      }
    }, {
      key: 'removeTab',
      value: function removeTab(e, index) {
        if (confirm('Are you sure want to delete?')) {
          e.preventDefault();
          var tabs = this.props.attributes.tabs;

          var tempTabs = [].concat(_toConsumableArray(tabs));
          tempTabs.splice(index, 1);
          this.props.setAttributes({ tabs: tempTabs });
          this.reInitTabs();
        }
      }
    }, {
      key: 'insertTab',
      value: function insertTab(newBlock) {
        var clientId = this.props.clientId;

        var block = getBlock(clientId);
        insertBlock(newBlock, parseInt(block.innerBlocks.length), clientId);
      }
    }, {
      key: 'addSelectedTab',
      value: function addSelectedTab(index) {
        console.log(index);
        this.props.setAttributes({ selectedTab: index });
        console.log(this.props.attributes.selectedTab);
      }
    }, {
      key: 'render',
      value: function render() {
        var _this2 = this;

        var _props = this.props,
            attributes = _props.attributes,
            setAttributes = _props.setAttributes,
            clientId = _props.clientId;

        var fontSizes = [{
          name: __('Small'),
          slug: 'small',
          size: 12
        }, {
          name: __('Big'),
          slug: 'big',
          size: 26
        }];
        var fallbackFontSize = 16;
        var colors = [{ name: 'blue', color: '#0ca5ea' }, { name: 'yellow', color: '#fdd80f' }, { name: 'white', color: '#fff' }, { name: 'light black', color: '#383838' }, { name: 'pink', color: '#e5018b' }];

        var updateTab = function updateTab(contentSrc, data, index) {
          var tabs = _this2.props.attributes.tabs;

          var tempTabs = [].concat(_toConsumableArray(tabs));
          if (contentSrc === 'tabTitle') {
            tempTabs[index].tabTitle = data;
          }
          if (contentSrc === 'tabContent') {
            tempTabs[index].tabContent = data;
          }
          _this2.props.setAttributes({ tabs: tempTabs });
          _this2.reInitTabs();
        };

        var UpdateSelectedTabColor = function UpdateSelectedTabColor(colorVal, tabIndex) {
          var tabs = _this2.props.attributes.tabs;

          var tempTabs = [].concat(_toConsumableArray(tabs));

          tempTabs[tabIndex].bgcolor = colorVal;
          _this2.props.setAttributes({ tabs: tempTabs });
          _this2.reInitTabs();
        };

        var SelectedTabColor = function SelectedTabColor(tabIndex) {
          var tabs = _this2.props.attributes.tabs;

          var tempTabs = [].concat(_toConsumableArray(tabs));

          return tempTabs[tabIndex].bgcolor;
        };

        var addTab = function addTab() {
          var _props$attributes = _this2.props.attributes,
              tabs = _props$attributes.tabs,
              tabsCount = _props$attributes.tabsCount;

          var tempTabs = [].concat(_toConsumableArray(tabs));
          var newtabId = _this2.makeid(10);
          tempTabs.push({ tabId: newtabId, tabTitle: 'new tab', tabContent: '' });
          _this2.props.setAttributes({ tabs: tempTabs });
          _this2.setState({ tabs: tempTabs });
          var newBlock = createBlock('amplify/amplifyinnerblock', {
            id: tabsCount + 1,
            tabattr: true
          });
          _this2.props.setAttributes({ tabsCount: tabsCount + 1 });
          _this2.insertTab(newBlock);
          _this2.reInitTabs();
        };

        var tabLiStyle = {
          background: attributes.tabActiveColor
        };

        var annchorStyle = {
          color: attributes.tabanchorColor
        };

        var ALLOWED_BLOCKS = ['amplify/amplifyinnerblock'];

        var getPanesTemplate = __WEBPACK_IMPORTED_MODULE_1_memize___default()(function (columns) {
          return __WEBPACK_IMPORTED_MODULE_0_lodash_times___default()(columns, function (n) {
            return ['amplify/amplifyinnerblock', { id: n + 1 }];
          });
        });

        var renderCSS = wp.element.createElement(
          'style',
          null,
          '.ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active, a.ui-button:active, .ui-button:active, .ui-button.ui-state-active:hover {\n    border: 1px solid #003eff;\n    background:' + attributes.tabActiveBg + ';\n    font-weight: normal;\n    color: ' + attributes.tabActiveTitleColor + ' !important;\n}\n.ui-state-active a, .ui-state-active a:link, .ui-state-active a:visited {\n  color: ' + attributes.tabActiveTitleColor + ' !important;\n}\n.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default, .ui-button, html .ui-button.ui-state-disabled:hover, html .ui-button.ui-state-disabled:active {\n  border: 1px solid #c5c5c5;\n  background:' + attributes.tabInActiveBg + ';\n}\n.ui-state-default a, .ui-state-default a:link, .ui-state-default a:visited, a.ui-button, a:link.ui-button, a:visited.ui-button, .ui-button {\n  color: ' + attributes.tabInActiveTitleColor + '\n}\n.ui-tabs-nav{\n  background: none;\n    border: none;\n    border-bottom: 1px solid ' + attributes.tabs[attributes.selectedTab].bgcolor + ' !important;\n    padding: 0 !important;\n}\n.ui-corner-all, .ui-corner-bottom, .ui-corner-left, .ui-corner-bl {\n  border-bottom-left-radius: 0px !important;\n}\n.amplify-tabs{\n  border:' + (attributes.panelBorderSize ? attributes.panelBorderSize : '4') + 'px solid ' + attributes.tabs[attributes.selectedTab].bgcolor + '\n}\n.ui-tabs .ui-tabs-nav .ui-tabs-anchor {\n  font-size: ' + (attributes.tabFontSize ? attributes.tabFontSize : '14') + 'px;\n}\n.ui-tabs-active{\n  background:' + attributes.tabs[attributes.selectedTab].bgcolor + ' !important\n}\n'
        );

        return wp.element.createElement(
          'div',
          null,
          renderCSS,
          wp.element.createElement(
            Fragment,
            null,
            wp.element.createElement(
              InspectorControls,
              null,
              wp.element.createElement(
                PanelBody,
                {
                  title: __('Tabs Color '),
                  initialOpen: true,
                  className: 'range-setting'
                },
                wp.element.createElement(
                  PanelRow,
                  null,
                  attributes.tabs.map(function (tab, index) {
                    return attributes.selectedTab === index && wp.element.createElement(
                      BaseControl,
                      {
                        id: 'active-tab-background',
                        label: 'Selected Tab Background',
                        help: 'Set Selected tab background color'
                      },
                      wp.element.createElement(ColorPalette, {
                        colors: colors,
                        value: SelectedTabColor(index),
                        onChange: function onChange(newval) {
                          return UpdateSelectedTabColor(newval, index);
                        }
                      })
                    );
                  })
                ),
                wp.element.createElement(
                  PanelRow,
                  null,
                  wp.element.createElement(
                    BaseControl,
                    {
                      id: 'active-tab-title-color',
                      label: 'Active Tab Title Color',
                      help: 'Set Active tab Title color'
                    },
                    wp.element.createElement(ColorPalette, {
                      colors: colors,
                      value: attributes.tabActiveTitleColor,
                      onChange: function onChange(newval) {
                        return setAttributes({ tabActiveTitleColor: newval });
                      }
                    })
                  )
                ),
                wp.element.createElement(
                  PanelRow,
                  null,
                  wp.element.createElement(
                    BaseControl,
                    {
                      id: 'inactive-tab-background',
                      label: 'InActive Tab Background',
                      help: 'Set InActive tab background color'
                    },
                    wp.element.createElement(ColorPalette, {
                      colors: colors,
                      value: attributes.tabInActiveBg,
                      onChange: function onChange(newval) {
                        return setAttributes({ tabInActiveBg: newval });
                      }
                    })
                  )
                ),
                wp.element.createElement(
                  PanelRow,
                  null,
                  wp.element.createElement(
                    BaseControl,
                    {
                      id: 'inactive-title-color',
                      label: 'InActive Tab Title Color',
                      help: 'Set InActive tab Title color'
                    },
                    wp.element.createElement(ColorPalette, {
                      colors: colors,
                      value: attributes.tabInActiveTitleColor,
                      onChange: function onChange(newval) {
                        return setAttributes({ tabInActiveTitleColor: newval });
                      }
                    })
                  )
                ),
                wp.element.createElement(
                  PanelRow,
                  null,
                  wp.element.createElement(
                    BaseControl,
                    {
                      id: 'panel-border-color',
                      label: 'Panel border Color',
                      help: 'Set Border color'
                    },
                    wp.element.createElement(ColorPalette, {
                      colors: colors,
                      value: attributes.panelBorderColor,
                      onChange: function onChange(newval) {
                        return setAttributes({ panelBorderColor: newval });
                      }
                    })
                  )
                )
              ),
              wp.element.createElement(
                PanelBody,
                {
                  title: __('Tabs Typography '),
                  initialOpen: true,
                  className: 'range-setting'
                },
                wp.element.createElement(
                  PanelRow,
                  null,
                  wp.element.createElement(
                    BaseControl,
                    {
                      id: 'panel-border-size',
                      label: 'Panel border Size',
                      help: 'Set Panel Border Size'
                    },
                    wp.element.createElement(FontSizePicker, {
                      fontSizes: fontSizes,
                      value: attributes.panelBorderSize,
                      fallbackFontSize: fallbackFontSize,
                      onChange: function onChange(newBorderSize) {
                        setAttributes({
                          panelBorderSize: parseInt(newBorderSize)
                        });
                      }
                    })
                  )
                ),
                wp.element.createElement(
                  PanelRow,
                  null,
                  wp.element.createElement(
                    BaseControl,
                    {
                      id: 'panel-font-size',
                      label: 'Tab Font Size',
                      help: 'Set Tab Font Size'
                    },
                    wp.element.createElement(FontSizePicker, {
                      fontSizes: fontSizes,
                      value: attributes.tabFontSize,
                      fallbackFontSize: fallbackFontSize,
                      onChange: function onChange(newFontSize) {
                        setAttributes({
                          tabFontSize: parseInt(newFontSize)
                        });
                      }
                    })
                  )
                )
              )
            )
          ),
          wp.element.createElement(
            'div',
            { id: 'tabs', className: 'backend_tab' },
            wp.element.createElement(
              'ul',
              null,
              attributes.tabs.map(function (tab, index) {
                return wp.element.createElement(
                  'li',
                  { onClick: function onClick(e) {
                      return _this2.addSelectedTab(index);
                    } },
                  wp.element.createElement('span', {
                    onClick: function onClick(e) {
                      return _this2.removeTab(e, index);
                    },
                    className: 'dashicons dashicons-no-alt remove'
                  }),
                  wp.element.createElement(
                    'a',
                    { href: '#tab_' + ('' + (index + 1)) },
                    wp.element.createElement(RichText, {
                      tagName: 'h4' // The tag here is the element output and editable in the admin
                      , value: tab.tabTitle // Any existing content, either from the database or an attribute default
                      , onChange: function onChange(tabTitle) {
                        return updateTab('tabTitle', tabTitle, index);
                      } // Store updated content as a block attribute
                      , placeholder: 'tab title' // Display this text before any content has been added by the user
                    })
                  )
                );
              }),
              wp.element.createElement(
                'li',
                { className: 'additem' },
                wp.element.createElement(
                  'button',
                  { className: 'add', onClick: addTab },
                  wp.element.createElement('span', { 'class': 'dashicons dashicons-plus-alt2' })
                )
              )
            ),
            wp.element.createElement(
              'div',
              { id: attributes.amplifyTabBlockid + '-amplify-tabs', 'class': 'amplify-tabs' },
              wp.element.createElement(InnerBlocks, {
                template: getPanesTemplate(attributes.tabsCount),
                templateLock: false,
                allowedBlocks: ALLOWED_BLOCKS
              })
            )
          )
        );
      }
    }]);

    return amplifyTabs;
  }(Component);

  registerBlockType('amplify/tabs', {
    // built in attributes
    title: 'Tabs',
    description: 'Tab Block',
    icon: 'editor-code',
    category: 'nab_amplify',
    attributes: {
      content: {
        type: 'string',
        default: ''
      },
      tabs: {
        type: 'array',
        default: [{ tabId: 'sdsd65asda', tabTitle: 'Tab 1', tabContent: '', bgcolor: '#0ca5ea' }]
      },
      tabTitle: {
        type: 'string',
        default: ''
      },
      tabContent: {
        type: 'string',
        default: ''
      },
      tabActiveBg: {
        type: 'string',
        default: '#0ca5ea'
      },
      tabActiveTitleColor: {
        type: 'string',
        default: '#ada9a9'
      },
      tabsCount: {
        type: 'number',
        default: 1
      },
      tabInActiveBg: {
        type: 'string',
        default: '#383838'
      },
      tabInActiveTitleColor: {
        type: 'string',
        default: '#ffffff'
      },
      panelBorderColor: {
        type: 'string',
        default: '#0ca5ea'
      },
      panelBorderSize: {
        type: 'string',
        default: 4
      },
      tabFontSize: {
        type: 'number',
        default: 20
      },
      amplifyTabBlockid: {
        type: 'string',
        default: ''
      },
      selectedTab: {
        type: 'number',
        default: 0
      }
    },
    edit: amplifyTabs,
    save: function save(props) {
      var _this3 = this;

      var attributes = props.attributes,
          setAttributes = props.setAttributes,
          clientId = props.clientId;

      var addSelectedTab = function addSelectedTab(index) {

        _this3.props.setAttributes({ selectedTab: index });
      };
      var renderCSS = wp.element.createElement(
        'style',
        null,
        '.ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active, a.ui-button:active, .ui-button:active, .ui-button.ui-state-active:hover {\n    border: 1px solid #003eff;\n    background:' + attributes.tabActiveBg + ';\n    font-weight: normal;\n    color: ' + attributes.tabActiveTitleColor + ' !important;\n}\n.ui-state-active a, .ui-state-active a:link, .ui-state-active a:visited {\n  color: ' + attributes.tabActiveTitleColor + ' !important;\n}\n.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default, .ui-button, html .ui-button.ui-state-disabled:hover, html .ui-button.ui-state-disabled:active {\n  border: 1px solid #c5c5c5;\n  background:' + attributes.tabInActiveBg + ';\n}\n.ui-state-default a, .ui-state-default a:link, .ui-state-default a:visited, a.ui-button, a:link.ui-button, a:visited.ui-button, .ui-button {\n  color: ' + attributes.tabInActiveTitleColor + '\n}\n.ui-tabs-nav{\n  background: none;\n    border: none;\n    border-bottom: 1px solid ' + attributes.tabs[attributes.selectedTab].bgcolor + ' !important;\n    padding: 0 !important;\n}\n.ui-widget.ui-widget-content {\n  border: none;\n}\n\n.ui-corner-all, .ui-corner-bottom, .ui-corner-left, .ui-corner-bl {\n  border-bottom-left-radius: 0px !important;\n}\n.amplify-tabs{\n  border:' + (attributes.panelBorderSize ? attributes.panelBorderSize : '4') + 'px solid ' + attributes.tabs[attributes.selectedTab].bgcolor + '\n}\n.ui-tabs .ui-tabs-nav .ui-tabs-anchor {\n  font-size: ' + (attributes.tabFontSize ? attributes.tabFontSize : '14') + 'px;\n}\n.ui-tabs-active{\n  background:' + attributes.tabs[attributes.selectedTab].bgcolor + ' !important\n}\n'
      );

      return wp.element.createElement(
        'div',
        { id: clientId },
        renderCSS,
        wp.element.createElement(
          'div',
          { id: 'tabs', className: 'backend_tab' },
          wp.element.createElement(
            'ul',
            null,
            attributes.tabs.map(function (tab, index) {
              return wp.element.createElement(
                'li',
                { 'data-color': tab.bgcolor, 'data-border': attributes.panelBorderSize },
                wp.element.createElement(
                  'a',
                  { href: '#tab_' + ('' + (index + 1)) },
                  tab.tabTitle
                )
              );
            })
          ),
          wp.element.createElement(
            'div',
            { id: attributes.amplifyTabBlockid + '-amplify-tabs', 'class': 'amplify-tabs' },
            wp.element.createElement(InnerBlocks.Content, null)
          )
        )
      );
    }
  });
  registerBlockType('amplify/amplifyinnerblock', {
    // ...
    parent: ['amplify/tabs'],
    title: 'Amplify Inner block',
    description: 'Amplify Inner block',
    icon: 'editor-code',
    category: 'nab_amplify',
    attributes: {
      id: {
        type: 'number',
        default: 1
      },
      text: {
        type: 'number',
        default: 0
      },
      tabattr: {
        type: 'boolean',
        default: false
      }
    },

    edit: function edit(props) {
      var attributes = props.attributes;

      return wp.element.createElement(
        'div',
        { className: props.className, id: 'tab_' + attributes.id },
        wp.element.createElement(InnerBlocks, { templateLock: false })
      );
    },
    save: function save(props) {
      var attributes = props.attributes;

      return wp.element.createElement(
        'div',
        { className: props.className, id: 'tab_' + attributes.id },
        wp.element.createElement(InnerBlocks.Content, null)
      );
    }
  });
})(wp.blocks, wp.blockEditor, wp.components, wp.element, wp.i18n);

/***/ }),
/* 11 */
/***/ (function(module, exports, __webpack_require__) {

var baseTimes = __webpack_require__(12),
    castFunction = __webpack_require__(13),
    toInteger = __webpack_require__(15);

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
/* 12 */
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
/* 13 */
/***/ (function(module, exports, __webpack_require__) {

var identity = __webpack_require__(14);

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
/* 14 */
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
/* 15 */
/***/ (function(module, exports, __webpack_require__) {

var toFinite = __webpack_require__(16);

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
/* 16 */
/***/ (function(module, exports, __webpack_require__) {

var toNumber = __webpack_require__(17);

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
/* 17 */
/***/ (function(module, exports, __webpack_require__) {

var isObject = __webpack_require__(18),
    isSymbol = __webpack_require__(19);

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
/* 18 */
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
/* 19 */
/***/ (function(module, exports, __webpack_require__) {

var baseGetTag = __webpack_require__(20),
    isObjectLike = __webpack_require__(26);

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
/* 20 */
/***/ (function(module, exports, __webpack_require__) {

var Symbol = __webpack_require__(0),
    getRawTag = __webpack_require__(24),
    objectToString = __webpack_require__(25);

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
/* 21 */
/***/ (function(module, exports, __webpack_require__) {

var freeGlobal = __webpack_require__(22);

/** Detect free variable `self`. */
var freeSelf = typeof self == 'object' && self && self.Object === Object && self;

/** Used as a reference to the global object. */
var root = freeGlobal || freeSelf || Function('return this')();

module.exports = root;


/***/ }),
/* 22 */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(global) {/** Detect free variable `global` from Node.js. */
var freeGlobal = typeof global == 'object' && global && global.Object === Object && global;

module.exports = freeGlobal;

/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(23)))

/***/ }),
/* 23 */
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
/* 24 */
/***/ (function(module, exports, __webpack_require__) {

var Symbol = __webpack_require__(0);

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
/* 25 */
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
/* 26 */
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
/* 27 */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(process) {/**
 * Memize options object.
 *
 * @typedef MemizeOptions
 *
 * @property {number} [maxSize] Maximum size of the cache.
 */

/**
 * Internal cache entry.
 *
 * @typedef MemizeCacheNode
 *
 * @property {?MemizeCacheNode|undefined} [prev] Previous node.
 * @property {?MemizeCacheNode|undefined} [next] Next node.
 * @property {Array<*>}                   args   Function arguments for cache
 *                                               entry.
 * @property {*}                          val    Function result.
 */

/**
 * Properties of the enhanced function for controlling cache.
 *
 * @typedef MemizeMemoizedFunction
 *
 * @property {()=>void} clear Clear the cache.
 */

/**
 * Accepts a function to be memoized, and returns a new memoized function, with
 * optional options.
 *
 * @template {Function} F
 *
 * @param {F}             fn        Function to memoize.
 * @param {MemizeOptions} [options] Options object.
 *
 * @return {F & MemizeMemoizedFunction} Memoized function.
 */
function memize( fn, options ) {
	var size = 0;

	/** @type {?MemizeCacheNode|undefined} */
	var head;

	/** @type {?MemizeCacheNode|undefined} */
	var tail;

	options = options || {};

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
				/** @type {MemizeCacheNode} */ ( node.prev ).next = node.next;
				if ( node.next ) {
					node.next.prev = node.prev;
				}

				node.next = head;
				node.prev = null;
				/** @type {MemizeCacheNode} */ ( head ).prev = node;
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
			val: fn.apply( null, args ),
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
		if ( size === /** @type {MemizeOptions} */ ( options ).maxSize ) {
			tail = /** @type {MemizeCacheNode} */ ( tail ).prev;
			/** @type {MemizeCacheNode} */ ( tail ).next = null;
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

	// Ignore reason: There's not a clear solution to create an intersection of
	// the function with additional properties, where the goal is to retain the
	// function signature of the incoming argument and add control properties
	// on the return value.

	// @ts-ignore
	return memoized;
}

module.exports = memize;

/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(28)))

/***/ }),
/* 28 */
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
/* 29 */
/***/ (function(module, exports) {

var _slicedToArray = function () { function sliceIterator(arr, i) { var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"]) _i["return"](); } finally { if (_d) throw _e; } } return _arr; } return function (arr, i) { if (Array.isArray(arr)) { return arr; } else if (Symbol.iterator in Object(arr)) { return sliceIterator(arr, i); } else { throw new TypeError("Invalid attempt to destructure non-iterable instance"); } }; }();

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _toConsumableArray(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } else { return Array.from(arr); } }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

;(function (wpBlocks, wpBlockEditor, wpComponents, wpElement, wpI18n) {
  var registerBlockType = wpBlocks.registerBlockType;
  var Component = wpElement.Component,
      Fragment = wpElement.Fragment,
      useState = wpElement.useState;
  var __ = wpI18n.__;
  var RichText = wpBlockEditor.RichText,
      InspectorControls = wpBlockEditor.InspectorControls,
      MediaUpload = wpBlockEditor.MediaUpload,
      AlignmentToolbar = wpBlockEditor.AlignmentToolbar,
      InnerBlocks = wpBlockEditor.InnerBlocks;
  var PanelBody = wpComponents.PanelBody,
      PanelRow = wpComponents.PanelRow,
      ServerSideRender = wpComponents.ServerSideRender,
      CheckboxControl = wpComponents.CheckboxControl;

  var trendingActivity = function (_Component) {
    _inherits(trendingActivity, _Component);

    function trendingActivity() {
      _classCallCheck(this, trendingActivity);

      var _this = _possibleConstructorReturn(this, (trendingActivity.__proto__ || Object.getPrototypeOf(trendingActivity)).apply(this, arguments));

      _this.state = {
        postTypeList: [],
        checkedItems: []
      };
      return _this;
    }

    _createClass(trendingActivity, [{
      key: 'componentWillMount',
      value: function componentWillMount() {
        var _this2 = this;

        var postTypeKey = void 0,
            postOptions = [],
            excludePostTypes = ['attachment', 'wp_block', 'page', 'template', 'post'];

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
      }
    }, {
      key: 'componentDidUpdate',
      value: function componentDidUpdate(previousProps, previousState) {}
    }, {
      key: 'render',
      value: function render() {
        var _this3 = this;

        var _props = this.props,
            attributes = _props.attributes,
            setAttributes = _props.setAttributes,
            clientId = _props.clientId;
        var checkedItems = this.props.attributes.checkedItems;
        // multiple checkbox control for taxonomies

        var MyCheckboxControl = function MyCheckboxControl(props) {
          var _useState = useState(false),
              _useState2 = _slicedToArray(_useState, 2),
              isChecked = _useState2[0],
              setChecked = _useState2[1];

          return wp.element.createElement(CheckboxControl, {
            name: 'nab_trending_post_types[]',
            label: props.label,
            checked: attributes.checkedItems.indexOf(props.value) > -1,
            onChange: function onChange(isChecked) {
              var index = void 0,
                  temppostType = [].concat(_toConsumableArray(checkedItems));

              if (isChecked) {
                temppostType.push(props.value);

                setAttributes({ checkedItems: temppostType });
                _this3.setState({ checkedItems: temppostType });
              } else {
                index = temppostType.indexOf(props.value);
                temppostType.splice(index, 1);
                setAttributes({ checkedItems: temppostType });
                _this3.setState({ checkedItems: temppostType });
              }
            },
            value: props.value
          });
        };
        return wp.element.createElement(
          'div',
          null,
          wp.element.createElement(
            Fragment,
            null,
            wp.element.createElement(
              InspectorControls,
              null,
              wp.element.createElement(
                PanelBody,
                {
                  title: __('Settings'),
                  initialOpen: true,
                  className: 'range-setting'
                },
                wp.element.createElement(
                  PanelRow,
                  null,
                  0 < this.state.postTypeList.length && wp.element.createElement(
                    'div',
                    null,
                    wp.element.createElement(
                      'label',
                      {
                        className: 'components-base-control__label',
                        'for': 'inspector-select-control-2'
                      },
                      'Select Content Type'
                    ),
                    wp.element.createElement(
                      'div',
                      { className: 'editor-post-taxonomies__hierarchical-terms-choice' },
                      wp.element.createElement(
                        'ul',
                        null,
                        Object.keys(this.state.postTypeList).map(function (key) {
                          return wp.element.createElement(
                            'li',
                            null,
                            wp.element.createElement(MyCheckboxControl, {
                              label: _this3.state.postTypeList[key].label,
                              value: _this3.state.postTypeList[key].value
                            })
                          );
                        })
                      )
                    )
                  )
                )
              )
            )
          ),
          wp.element.createElement(
            'div',
            { id: 'trending_activity', className: 'nab-trending-activity' },
            wp.element.createElement(ServerSideRender, { block: 'amplify/trendingactivity', attributes: {
                checkedItems: attributes.checkedItems } })
          )
        );
      }
    }]);

    return trendingActivity;
  }(Component);

  registerBlockType('amplify/trendingactivity', {
    // built in attributes
    title: 'Trending Activity',
    description: 'Shows Latest trennding post based on most reactions achieved.',
    icon: 'editor-code',
    category: 'nab_amplify',
    attributes: {
      postTypeList: {
        type: 'array',
        default: []
      },
      checkedItems: {
        type: 'array',
        default: []
      }
    },
    edit: trendingActivity,
    save: function save() {
      return null;
    }
  });
})(wp.blocks, wp.blockEditor, wp.components, wp.element, wp.i18n);

/***/ }),
/* 30 */
/***/ (function(module, exports) {

(function (wpI18n, wpBlocks, wpElement, wpComponents) {
    var __ = wpI18n.__;
    var Fragment = wpElement.Fragment;
    var registerBlockType = wpBlocks.registerBlockType;
    var ServerSideRender = wpComponents.ServerSideRender;


    var CompanyDetailsIcon = wp.element.createElement(
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

    var allAttr = {};

    registerBlockType('nab/company-details', {
        title: __('Company Details'),
        icon: { src: CompanyDetailsIcon },
        category: 'nab_amplify',
        keywords: [__('company'), __('details'), __('about')],
        attributes: allAttr,
        edit: function edit() {
            return wp.element.createElement(
                Fragment,
                null,
                wp.element.createElement(ServerSideRender, {
                    block: "nab/company-details"
                })
            );
        },
        save: function save() {
            return null;
        }
    });
})(wp.i18n, wp.blocks, wp.element, wp.components);

/***/ }),
/* 31 */
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
        SelectControl = wpComponents.SelectControl,
        TextControl = wpComponents.TextControl,
        ServerSideRender = wpComponents.ServerSideRender,
        CheckboxControl = wpComponents.CheckboxControl,
        RangeControl = wpComponents.RangeControl;


    var sessionSliderBlockIcon = wp.element.createElement(
        "svg",
        { width: "150px", height: "150px", viewBox: "0 0 150 150", "enable-background": "new 0 0 150 150" },
        wp.element.createElement("rect", { fill: "none", width: "150", height: "150" }),
        wp.element.createElement(
            "g",
            null,
            wp.element.createElement("path", { fill: "#92c83e", d: "M0,22.5h150v90h-5.625c0-13.425-10.95-24.375-24.375-24.375c-9.825,0-18.15,5.925-22.05,14.325 c-1.875-0.75-3.9-1.2-6.075-1.2c-7.35,0-13.5,4.725-15.825,11.25H0V22.5z M62.775,45.825c-0.45,1.125-0.75,2.325-0.825,3.525 c-0.075,1.2-0.075,2.475,0.075,3.75l0.15,0.6c0.075,0.45,0.15,1.05,0.375,1.725c0.15,0.75,0.45,1.5,0.75,2.325 c0.225,0.825,0.675,1.65,1.125,2.475c0.525,0.9,1.125,1.65,1.725,2.325c0.6,0.675,1.35,1.275,2.325,1.725 c0.9,0.45,1.875,0.675,3,0.675c1.05,0,2.025-0.225,2.925-0.675c0.9-0.45,1.65-1.05,2.25-1.65c0.675-0.675,1.199-1.5,1.649-2.4 c0.525-0.9,0.9-1.725,1.2-2.475s0.525-1.5,0.675-2.325c0.226-0.825,0.3-1.35,0.375-1.65c0.075-0.3,0.075-0.525,0.075-0.675 c0.375-2.175,0.225-4.2-0.3-6.15C79.8,45,78.75,43.35,77.25,42c-1.575-1.35-3.525-2.025-5.925-2.025c-1.425,0-2.7,0.225-3.9,0.75 c-1.125,0.525-2.1,1.2-2.85,2.1C63.9,43.65,63.3,44.7,62.775,45.825L62.775,45.825z M96.375,91.125v-8.55 c0-2.476-0.75-4.95-2.175-7.35S90.825,70.8,88.425,69.3c-2.399-1.575-4.95-2.325-7.649-2.325l-9.3,6.3l-9.6-6.15 c-2.775,0-5.4,0.75-7.8,2.25c-2.325,1.5-4.2,3.45-5.55,5.775c-1.35,2.4-2.025,4.875-2.025,7.425v8.55l1.35,0.375 c0.9,0.3,2.175,0.6,3.825,1.05c1.725,0.375,3.525,0.75,5.55,1.125c1.95,0.375,4.275,0.675,6.825,0.976 c2.55,0.225,5.025,0.375,7.425,0.375c2.25,0,4.725-0.15,7.35-0.375c2.55-0.301,4.8-0.601,6.675-0.976c1.875-0.3,3.75-0.75,5.7-1.2 l3.75-0.899C95.55,91.425,96,91.275,96.375,91.125z M120,91.875c11.4,0,20.625,9.225,20.625,20.625S131.4,133.125,120,133.125 c-5.475,0-10.35-2.25-14.025-5.775c1.726-2.625,2.775-5.85,2.775-9.225c0-5.775-2.925-10.95-7.425-13.95 C104.55,96.975,111.6,91.875,120,91.875z M78.75,118.125c0-7.2,5.925-13.125,13.125-13.125S105,110.925,105,118.125 s-5.925,13.125-13.125,13.125S78.75,125.325,78.75,118.125z" })
        )
    );

    var NabCompanyProducts = function (_Component) {
        _inherits(NabCompanyProducts, _Component);

        function NabCompanyProducts() {
            _classCallCheck(this, NabCompanyProducts);

            var _this = _possibleConstructorReturn(this, (NabCompanyProducts.__proto__ || Object.getPrototypeOf(NabCompanyProducts)).apply(this, arguments));

            _this.state = {
                termsObj: {},
                filterTermsObj: {}
            };
            return _this;
        }

        _createClass(NabCompanyProducts, [{
            key: "componentWillMount",
            value: function componentWillMount() {
                var _this2 = this;

                // Fetch all channels
                wp.apiFetch({ path: '/nab/request/get-company-category' }).then(function (terms) {
                    _this2.setState({ termsObj: terms, filterTermsObj: terms });
                });
            }
        }, {
            key: "filterTerms",
            value: function filterTerms(value) {
                var filterTerms = this.state.termsObj.filter(function (term) {
                    return -1 < term.title.toLowerCase().indexOf(value.toLowerCase());
                });
                this.setState({ filterTermsObj: filterTerms });
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
                var _props = this.props,
                    attributes = _props.attributes,
                    setAttributes = _props.setAttributes;
                var itemToFetch = attributes.itemToFetch,
                    companyCategory = attributes.companyCategory,
                    displayOrder = attributes.displayOrder;

                return wp.element.createElement(
                    Fragment,
                    null,
                    wp.element.createElement(
                        InspectorControls,
                        null,
                        wp.element.createElement(
                            PanelBody,
                            { title: __('Data Settings '), initialOpen: true, className: "range-setting" },
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
                                    max: 200,
                                    onChange: function onChange(item) {
                                        return setAttributes({ itemToFetch: parseInt(item) });
                                    }
                                })
                            ),
                            wp.element.createElement(SelectControl, {
                                label: __('Display Order'),
                                value: displayOrder,
                                options: [{ label: __('Oldest to Newest'), value: 'ASC' }, { label: __('Newest to Oldest'), value: 'DESC' }],
                                onChange: function onChange(value) {
                                    setAttributes({ displayOrder: value });
                                }
                            })
                        )
                    ),
                    wp.element.createElement(ServerSideRender, {
                        block: "nab/company-products",
                        attributes: { itemToFetch: itemToFetch, displayOrder: displayOrder }
                    })
                );
            }
        }]);

        return NabCompanyProducts;
    }(Component);

    var blockAttrs = {
        itemToFetch: {
            type: 'number',
            default: 100
        },
        displayOrder: {
            type: 'string',
            default: 'DESC'
        }
    };
    registerBlockType('nab/company-products', {
        title: __('Company Products'),
        icon: { src: sessionSliderBlockIcon },
        category: 'nab_amplify',
        keywords: [__('Company'), __('Products')],
        attributes: blockAttrs,
        edit: NabCompanyProducts,
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
        SelectControl = wpComponents.SelectControl,
        TextControl = wpComponents.TextControl,
        ServerSideRender = wpComponents.ServerSideRender,
        CheckboxControl = wpComponents.CheckboxControl,
        RangeControl = wpComponents.RangeControl;

    var NabCompanyEvents = function (_Component) {
        _inherits(NabCompanyEvents, _Component);

        function NabCompanyEvents() {
            _classCallCheck(this, NabCompanyEvents);

            var _this = _possibleConstructorReturn(this, (NabCompanyEvents.__proto__ || Object.getPrototypeOf(NabCompanyEvents)).apply(this, arguments));

            _this.state = {
                termsObj: {},
                filterTermsObj: {}
            };
            return _this;
        }

        _createClass(NabCompanyEvents, [{
            key: 'componentWillMount',
            value: function componentWillMount() {
                var _this2 = this;

                // Fetch all channels
                wp.apiFetch({ path: '/nab/request/get-company-category' }).then(function (terms) {
                    _this2.setState({ termsObj: terms, filterTermsObj: terms });
                });
            }
        }, {
            key: 'filterTerms',
            value: function filterTerms(value) {
                var filterTerms = this.state.termsObj.filter(function (term) {
                    return -1 < term.title.toLowerCase().indexOf(value.toLowerCase());
                });
                this.setState({ filterTermsObj: filterTerms });
            }
        }, {
            key: 'isEmpty',
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
            key: 'render',
            value: function render() {
                var _props = this.props,
                    attributes = _props.attributes,
                    setAttributes = _props.setAttributes;
                var itemToFetch = attributes.itemToFetch,
                    companyCategory = attributes.companyCategory,
                    displayOrder = attributes.displayOrder;

                return wp.element.createElement(
                    Fragment,
                    null,
                    wp.element.createElement(
                        InspectorControls,
                        null,
                        wp.element.createElement(
                            PanelBody,
                            { title: __('Data Settings '), initialOpen: true, className: 'range-setting' },
                            wp.element.createElement(
                                'div',
                                { className: 'inspector-field inspector-field-Numberofitems ' },
                                wp.element.createElement(
                                    'label',
                                    { className: 'inspector-mb-0' },
                                    'Number of items'
                                ),
                                wp.element.createElement(RangeControl, {
                                    value: itemToFetch,
                                    min: 1,
                                    max: 200,
                                    onChange: function onChange(item) {
                                        return setAttributes({ itemToFetch: parseInt(item) });
                                    }
                                })
                            ),
                            wp.element.createElement(SelectControl, {
                                label: __('Display Order'),
                                value: displayOrder,
                                options: [{ label: __('Oldest to Newest'), value: 'ASC' }, { label: __('Newest to Oldest'), value: 'DESC' }],
                                onChange: function onChange(value) {
                                    setAttributes({ displayOrder: value });
                                }
                            })
                        )
                    ),
                    wp.element.createElement(ServerSideRender, {
                        block: 'nab/company-events',
                        attributes: { itemToFetch: itemToFetch, displayOrder: displayOrder }
                    })
                );
            }
        }]);

        return NabCompanyEvents;
    }(Component);

    var blockAttrs = {
        itemToFetch: {
            type: 'number',
            default: 4
        },
        displayOrder: {
            type: 'string',
            default: 'DESC'
        }
    };
    registerBlockType('nab/company-events', {
        title: __('Company Events'),
        icon: 'calendar',
        category: 'nab_amplify',
        keywords: [__('Company'), __('Events')],
        attributes: blockAttrs,
        edit: NabCompanyEvents,
        save: function save() {
            return null;
        }
    });
})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);

/***/ }),
/* 33 */
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
        SelectControl = wpComponents.SelectControl,
        TextControl = wpComponents.TextControl,
        ServerSideRender = wpComponents.ServerSideRender,
        CheckboxControl = wpComponents.CheckboxControl,
        RangeControl = wpComponents.RangeControl;

    var NabCompanyContent = function (_Component) {
        _inherits(NabCompanyContent, _Component);

        function NabCompanyContent() {
            _classCallCheck(this, NabCompanyContent);

            var _this = _possibleConstructorReturn(this, (NabCompanyContent.__proto__ || Object.getPrototypeOf(NabCompanyContent)).apply(this, arguments));

            _this.state = {
                termsObj: {},
                filterTermsObj: {}
            };
            return _this;
        }

        _createClass(NabCompanyContent, [{
            key: 'componentWillMount',
            value: function componentWillMount() {
                var _this2 = this;

                // Fetch all channels
                wp.apiFetch({ path: '/nab/request/get-company-category' }).then(function (terms) {
                    _this2.setState({ termsObj: terms, filterTermsObj: terms });
                });
            }
        }, {
            key: 'filterTerms',
            value: function filterTerms(value) {
                var filterTerms = this.state.termsObj.filter(function (term) {
                    return -1 < term.title.toLowerCase().indexOf(value.toLowerCase());
                });
                this.setState({ filterTermsObj: filterTerms });
            }
        }, {
            key: 'isEmpty',
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
            key: 'render',
            value: function render() {
                var _props = this.props,
                    attributes = _props.attributes,
                    setAttributes = _props.setAttributes;
                var itemToFetch = attributes.itemToFetch,
                    companyCategory = attributes.companyCategory,
                    displayOrder = attributes.displayOrder;

                return wp.element.createElement(
                    Fragment,
                    null,
                    wp.element.createElement(
                        InspectorControls,
                        null,
                        wp.element.createElement(
                            PanelBody,
                            { title: __('Data Settings'), initialOpen: true, className: 'range-setting' },
                            wp.element.createElement(
                                'div',
                                { className: 'inspector-field inspector-field-Numberofitems ' },
                                wp.element.createElement(
                                    'label',
                                    { className: 'inspector-mb-0' },
                                    'Number of items'
                                ),
                                wp.element.createElement(RangeControl, {
                                    value: itemToFetch,
                                    min: 1,
                                    max: 200,
                                    onChange: function onChange(item) {
                                        return setAttributes({ itemToFetch: parseInt(item) });
                                    }
                                })
                            ),
                            wp.element.createElement(SelectControl, {
                                label: __('Display Order'),
                                value: displayOrder,
                                options: [{ label: __('Oldest to Newest'), value: 'ASC' }, { label: __('Newest to Oldest'), value: 'DESC' }],
                                onChange: function onChange(value) {
                                    setAttributes({ displayOrder: value });
                                }
                            })
                        )
                    ),
                    wp.element.createElement(ServerSideRender, {
                        block: 'nab/company-content',
                        attributes: { itemToFetch: itemToFetch, displayOrder: displayOrder }
                    })
                );
            }
        }]);

        return NabCompanyContent;
    }(Component);

    var blockAttrs = {
        itemToFetch: {
            type: 'number',
            default: 4
        },
        displayOrder: {
            type: 'string',
            default: 'DESC'
        }
    };
    registerBlockType('nab/company-content', {
        title: __('Company Content'),
        icon: 'admin-page',
        category: 'nab_amplify',
        keywords: [__('Company'), __('Content')],
        attributes: blockAttrs,
        edit: NabCompanyContent,
        save: function save() {
            return null;
        }
    });
})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);

/***/ }),
/* 34 */
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
        ServerSideRender = wpComponents.ServerSideRender,
        RangeControl = wpComponents.RangeControl;

    var NabCompanyEmployees = function (_Component) {
        _inherits(NabCompanyEmployees, _Component);

        function NabCompanyEmployees() {
            _classCallCheck(this, NabCompanyEmployees);

            return _possibleConstructorReturn(this, (NabCompanyEmployees.__proto__ || Object.getPrototypeOf(NabCompanyEmployees)).apply(this, arguments));
        }

        _createClass(NabCompanyEmployees, [{
            key: "render",
            value: function render() {
                var _props = this.props,
                    attributes = _props.attributes,
                    setAttributes = _props.setAttributes;
                var itemToFetch = attributes.itemToFetch;

                return wp.element.createElement(
                    Fragment,
                    null,
                    wp.element.createElement(
                        InspectorControls,
                        null,
                        wp.element.createElement(
                            PanelBody,
                            { title: __('Data Settings'), initialOpen: true, className: "range-setting" },
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
                                    max: 200,
                                    onChange: function onChange(item) {
                                        return setAttributes({ itemToFetch: parseInt(item) });
                                    }
                                })
                            )
                        )
                    ),
                    wp.element.createElement(ServerSideRender, {
                        block: "nab/company-employees",
                        attributes: { itemToFetch: itemToFetch }
                    })
                );
            }
        }]);

        return NabCompanyEmployees;
    }(Component);

    var blockAttrs = {
        itemToFetch: {
            type: 'number',
            default: 4
        }
    };
    registerBlockType('nab/company-employees', {
        title: __('Company Employees'),
        icon: 'admin-users',
        category: 'nab_amplify',
        keywords: [__('Company'), __('Employees')],
        attributes: blockAttrs,
        edit: NabCompanyEmployees,
        save: function save() {
            return null;
        }
    });
})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);

/***/ }),
/* 35 */
/***/ (function(module, exports) {

(function (wpI18n, wpBlocks, wpBlockEditor, wpComponents, wpElement) {
  var __ = wpI18n.__;
  var registerBlockType = wpBlocks.registerBlockType;
  var Fragment = wpElement.Fragment;
  var ServerSideRender = wpComponents.ServerSideRender;


  registerBlockType("nab/company-feature", {
    // built in attributes
    title: __("Company Feature"),
    description: __("Company Feature Block"),
    icon: "editor-code",
    category: "nab_amplify",
    keywords: [__("Feature"), __("Gutenberg")],
    edit: function edit() {
      return wp.element.createElement(
        Fragment,
        null,
        wp.element.createElement(ServerSideRender, { block: "nab/company-feature" })
      );
    },
    save: function save() {
      return null;
    }
  });
})(wp.i18n, wp.blocks, wp.blockEditor, wp.components, wp.element);

/***/ })
/******/ ]);