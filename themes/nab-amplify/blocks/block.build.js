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
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__block_multipurpose_gutenberg_block_block__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__block_feature_block__ = __webpack_require__(3);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__block_feature_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1__block_feature_block__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__block_image_block__ = __webpack_require__(4);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__block_image_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_2__block_image_block__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__block_upcoming_events_calendar_block__ = __webpack_require__(6);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__block_upcoming_events_calendar_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_3__block_upcoming_events_calendar_block__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__block_related_content_block__ = __webpack_require__(7);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__block_related_content_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_4__block_related_content_block__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__block_related_content_2_block__ = __webpack_require__(8);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__block_related_content_2_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_5__block_related_content_2_block__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6__block_community_curator_block__ = __webpack_require__(5);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6__block_community_curator_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_6__block_community_curator_block__);
// import all blocks here








/***/ }),
/* 1 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_classnames__ = __webpack_require__(2);
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
/* 2 */
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
/* 3 */
/***/ (function(module, exports) {

(function (i18n, wpBlocks, wpBlockEditor, wpComponents) {
    var registerBlockType = wpBlocks.registerBlockType;
    var __ = wp.i18n.__;
    var RichText = wpBlockEditor.RichText,
        InspectorControls = wpBlockEditor.InspectorControls,
        ColorPalette = wpBlockEditor.ColorPalette,
        MediaUpload = wpBlockEditor.MediaUpload,
        AlignmentToolbar = wpBlockEditor.AlignmentToolbar;
    var Fragment = wp.element.Fragment;
    var PanelBody = wpComponents.PanelBody,
        PanelRow = wpComponents.PanelRow,
        Button = wpComponents.Button,
        RangeControl = wpComponents.RangeControl,
        ToggleControl = wpComponents.ToggleControl,
        SelectControl = wpComponents.SelectControl;


    registerBlockType('amplify/feature', {
        // built in attributes
        title: __('Feature'),
        description: __('Feature Block'),
        icon: 'editor-code',
        category: 'nab_amplify',
        attributes: {
            backgroundColor: {
                type: 'string',
                default: ''
            },
            backgroundOverlay: {
                type: 'string',
                default: ''
            },
            backgroundImage: {
                type: 'string',
                default: ''
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
            featureStatusToggle: {
                type: 'Boolean',
                default: true
            },
            featureTitleToggle: {
                type: 'Boolean',
                default: true
            },
            featureAuthorToggle: {
                type: 'Boolean',
                default: true
            },
            featureDiscToggle: {
                type: 'Boolean',
                default: true
            },
            featureStatusTitle: {
                type: 'string',
                default: ''
            },
            featureTitle: {
                type: 'string',
                default: ''
            },
            featureAuthor: {
                type: 'string',
                default: ''
            },
            featureDisc: {
                type: 'string',
                default: ''
            }
        },
        edit: function edit(_ref) {
            var attributes = _ref.attributes,
                setAttributes = _ref.setAttributes;
            var backgroundColor = attributes.backgroundColor,
                backgroundOverlay = attributes.backgroundOverlay,
                backgroundImage = attributes.backgroundImage,
                backgroundSize = attributes.backgroundSize,
                backgroundRepeat = attributes.backgroundRepeat,
                backgroundPosition = attributes.backgroundPosition,
                featureStatusToggle = attributes.featureStatusToggle,
                featureTitleToggle = attributes.featureTitleToggle,
                featureAuthorToggle = attributes.featureAuthorToggle,
                featureDiscToggle = attributes.featureDiscToggle,
                featureStatusTitle = attributes.featureStatusTitle,
                featureTitle = attributes.featureTitle,
                featureAuthor = attributes.featureAuthor,
                featureDisc = attributes.featureDisc;


            var backroundStyle = {};
            backgroundColor && (backroundStyle.backgroundColor = backgroundColor);
            backgroundImage && (backroundStyle.backgroundImage = 'url(' + backgroundImage + ')');
            backgroundPosition && (backroundStyle.backgroundPosition = backgroundPosition);
            backgroundRepeat && (backroundStyle.backgroundRepeat = "no-repeat");
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
                                            className: backgroundImage ? "amp-image-button" : "button button-large"
                                        },
                                        !backgroundImage ? __("Select Image") : wp.element.createElement('div', {
                                            style: {
                                                backgroundImage: 'url(' + backgroundImage + ')',
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
                                Fragment,
                                null,
                                wp.element.createElement(
                                    Button,
                                    {
                                        className: 'button',
                                        onClick: function onClick() {
                                            setAttributes({ backgroundImage: "" });
                                        }
                                    },
                                    __("Remove Image")
                                ),
                                wp.element.createElement(
                                    'div',
                                    { className: 'inspector-field-inner' },
                                    wp.element.createElement(ToggleControl, {
                                        label: __("Background Repeat "),
                                        checked: backgroundRepeat,
                                        onChange: function onChange(backgroundRepeat) {
                                            setAttributes({ backgroundRepeat: backgroundRepeat });
                                        }
                                    }),
                                    wp.element.createElement(SelectControl, {
                                        label: __("background size"),
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
                        { title: 'Feature Content Settings' },
                        wp.element.createElement(
                            'div',
                            { className: 'inspector-field' },
                            wp.element.createElement(ToggleControl, {
                                label: __("Feature Status Title"),
                                checked: featureStatusToggle,
                                onChange: function onChange(featureStatusToggle) {
                                    setAttributes({ featureStatusToggle: featureStatusToggle });
                                }
                            }),
                            wp.element.createElement(ToggleControl, {
                                label: __("Feature Title"),
                                checked: featureTitleToggle,
                                onChange: function onChange(featureTitleToggle) {
                                    setAttributes({ featureTitleToggle: featureTitleToggle });
                                }
                            }),
                            wp.element.createElement(ToggleControl, {
                                label: __("Feature Author"),
                                checked: featureAuthorToggle,
                                onChange: function onChange(featureAuthorToggle) {
                                    setAttributes({ featureAuthorToggle: featureAuthorToggle });
                                }
                            }),
                            wp.element.createElement(ToggleControl, {
                                label: __("Feature Discription"),
                                checked: featureDiscToggle,
                                onChange: function onChange(featureDiscToggle) {
                                    setAttributes({ featureDiscToggle: featureDiscToggle });
                                }
                            })
                        )
                    )
                )
            ), wp.element.createElement(
                'div',
                { className: 'amp-feature-block', style: backroundStyle },
                wp.element.createElement(
                    'div',
                    { className: 'amp-feature-block-inner' },
                    wp.element.createElement(
                        'div',
                        { className: 'amp-feature-content' },
                        featureStatusToggle ? wp.element.createElement(RichText, {
                            tagName: 'h3',
                            placeholder: 'Live',
                            className: 'feature-status',
                            value: featureStatusTitle,
                            onChange: function onChange(featureStatusTitle) {
                                setAttributes({ featureStatusTitle: featureStatusTitle });
                            }
                        }) : null,
                        featureTitleToggle ? wp.element.createElement(RichText, {
                            tagName: 'h2',
                            placeholder: 'Creating the World',
                            className: 'feature-title',
                            value: featureTitle,
                            onChange: function onChange(featureTitle) {
                                setAttributes({ featureTitle: featureTitle });
                            }
                        }) : null,
                        featureAuthorToggle ? wp.element.createElement(RichText, {
                            tagName: 'h4',
                            placeholder: 'Author',
                            className: 'feature-author',
                            value: featureAuthor,
                            onChange: function onChange(featureAuthor) {
                                setAttributes({ featureAuthor: featureAuthor });
                            }
                        }) : null,
                        featureDiscToggle ? wp.element.createElement(RichText, {
                            tagName: 'p',
                            placeholder: 'Discription',
                            className: 'feature-disc',
                            value: featureDisc,
                            onChange: function onChange(featureDisc) {
                                setAttributes({ featureDisc: featureDisc });
                            }
                        }) : null
                    )
                )
            )];
        },
        save: function save(_ref3) {
            var attributes = _ref3.attributes;
            var backgroundColor = attributes.backgroundColor,
                backgroundImage = attributes.backgroundImage,
                backgroundSize = attributes.backgroundSize,
                backgroundRepeat = attributes.backgroundRepeat,
                backgroundPosition = attributes.backgroundPosition,
                featureStatusToggle = attributes.featureStatusToggle,
                featureTitleToggle = attributes.featureTitleToggle,
                featureAuthorToggle = attributes.featureAuthorToggle,
                featureDiscToggle = attributes.featureDiscToggle,
                featureStatusTitle = attributes.featureStatusTitle,
                featureTitle = attributes.featureTitle,
                featureAuthor = attributes.featureAuthor,
                featureDisc = attributes.featureDisc;


            var backroundStyle = {};
            backgroundColor && (backroundStyle.backgroundColor = backgroundColor);
            backgroundImage && (backroundStyle.backgroundImage = 'url(' + backgroundImage + ')');
            backgroundPosition && (backroundStyle.backgroundPosition = backgroundPosition);
            backgroundRepeat && (backroundStyle.backgroundRepeat = "no-repeat");
            backgroundSize && (backroundStyle.backgroundSize = backgroundSize);

            return wp.element.createElement(
                'div',
                { className: 'amp-feature-block', style: backroundStyle },
                wp.element.createElement(
                    'div',
                    { className: 'amp-feature-block-inner' },
                    wp.element.createElement(
                        'div',
                        { className: 'amp-feature-content' },
                        featureStatusToggle ? wp.element.createElement(RichText.Content, {
                            tagName: 'h3',
                            value: featureStatusTitle,
                            className: 'feature-status'
                        }) : null,
                        featureTitleToggle ? wp.element.createElement(RichText.Content, {
                            tagName: 'h2',
                            value: featureTitle,
                            className: 'feature-title'
                        }) : null,
                        featureAuthorToggle ? wp.element.createElement(RichText.Content, {
                            tagName: 'h4',
                            value: featureAuthor,
                            className: 'feature-author'
                        }) : null,
                        featureDiscToggle ? wp.element.createElement(RichText.Content, {
                            tagName: 'p',
                            value: featureDisc,
                            className: 'feature-disc'
                        }) : null
                    )
                )
            );
        }
    });
})(wp.i18n, wp.blocks, wp.blockEditor, wp.components);

/***/ }),
/* 4 */
/***/ (function(module, exports) {

(function (i18n, wpBlocks, wpBlockEditor, wpComponents) {
    var registerBlockType = wpBlocks.registerBlockType;
    var __ = wp.i18n.__;
    var RichText = wpBlockEditor.RichText,
        InspectorControls = wpBlockEditor.InspectorControls,
        MediaUpload = wpBlockEditor.MediaUpload,
        AlignmentToolbar = wpBlockEditor.AlignmentToolbar;
    var PanelBody = wpComponents.PanelBody,
        Button = wpComponents.Button,
        ToggleControl = wpComponents.ToggleControl,
        TextControl = wpComponents.TextControl;


    registerBlockType('amplify/image', {
        // built in attributes
        title: __('Image'),
        description: __('Image Block'),
        icon: 'editor-code',
        category: 'nab_amplify',
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
/* 5 */
/***/ (function(module, exports) {

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _toConsumableArray(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } else { return Array.from(arr); } }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

;(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
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
            bgMedia: ''
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
        var dataArray = attributes.dataArray;


        var getImageButton = function getImageButton(openEvent, index) {
          if (dataArray[index].media) {
            return wp.element.createElement(
              Fragment,
              null,
              wp.element.createElement('span', {
                onClick: openEvent,
                className: 'dashicons dashicons-edit'
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
              0 < index && wp.element.createElement(
                Tooltip,
                { text: 'Move Left' },
                wp.element.createElement('span', {
                  className: 'dashicons dashicons-arrow-left-alt2',
                  onClick: function onClick() {
                    return _this2.moveItem(index, index - 1);
                  }
                })
              ),
              index + 1 < dataArray.length && wp.element.createElement(
                Tooltip,
                { text: 'Move Right' },
                wp.element.createElement('span', {
                  className: 'dashicons dashicons-arrow-right-alt2',
                  onClick: function onClick() {
                    return _this2.moveItem(index, index + 1);
                  }
                })
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
                          className: 'dashicons dashicons-edit'
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
              { title: 'General Settings' },
              wp.element.createElement(
                PanelRow,
                null,
                'Test'
              )
            )
          ),
          wp.element.createElement(
            'div',
            { className: 'community-curator' },
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
        );
      }
    }]);

    return ItemComponent;
  }(Component);

  registerBlockType('rg/community-curator', {
    title: __('Community Curator'),
    description: __('community-curator'),
    icon: 'heart',
    category: 'common',
    keywords: [__('Community Curator'), __('Gutenberg')],
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
        'div',
        { className: 'community-curator' },
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
              className: 'title'
            }),
            dataArray[0].subTitle && wp.element.createElement(RichText.Content, {
              tagName: 'strong',
              value: dataArray[0].subTitle,
              className: 'sub-title'
            }),
            dataArray[0].description && wp.element.createElement(RichText.Content, {
              tagName: 'p',
              value: dataArray[0].description,
              className: 'description'
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
                  data.bgMedia ? wp.element.createElement('img', { className: 'main-image', src: data.bgMedia, alt: data.title, style: {
                      display: 'none'
                    } }) : null,
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
      );
    }
  });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);

/***/ }),
/* 6 */
/***/ (function(module, exports) {

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _toConsumableArray(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } else { return Array.from(arr); } }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

;(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
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
        var dataArray = attributes.dataArray;


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
              { className: 'inner' },
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
              { title: 'General Settings' },
              wp.element.createElement(
                PanelRow,
                null,
                'Test'
              )
            )
          ),
          wp.element.createElement(
            'div',
            { className: 'upcoming-events-calendar' },
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
        );
      }
    }]);

    return ItemComponent;
  }(Component);

  registerBlockType('rg/upcoming-events-calendar', {
    title: __('Upcoming Events Calendar'),
    description: __('upcoming-events-calendar'),
    icon: 'heart',
    category: 'common',
    keywords: [__('Upcoming Events Calendar'), __('Gutenberg')],
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
          { className: 'upcoming-events-calendar' },
          dataArray.map(function (data, index) {
            return wp.element.createElement(
              Fragment,
              null,
              data.title && wp.element.createElement(
                'div',
                { className: 'item' },
                wp.element.createElement(
                  'div',
                  { className: 'inner' },
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
      );
    }
  });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);

/***/ }),
/* 7 */
/***/ (function(module, exports) {

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _toConsumableArray(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } else { return Array.from(arr); } }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

;(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
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
            advertising: 'Advertising',
            media: '',
            mediaAlt: '',
            title: '',
            subTitle: '',
            buttonText: '<a href="#">Learn More</a>'
          };
        }
        if (name == 'option-2') {
          attr = {
            index: dataArray.length,
            option: name,
            bgMedia: '',
            media: '',
            mediaAlt: '',
            title: '',
            subTitle: '',
            date: '',
            buttonText: '<a href="#">Watch</a>'
          };
        }

        if (name == 'option-3') {
          attr = {
            index: dataArray.length,
            option: name,
            advertising: 'Advertising',
            media: '',
            mediaAlt: '',
            buttonText: '<a href="#">Learn More</a>'
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
            buttonText: '<a href="#">Message</a>'
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
                        'Upload BG Image'
                      );
                    }
                  }
                })
              ) : null,
              data.option == 'option-1' || data.option == 'option-3' ? wp.element.createElement(
                'div',
                { className: 'advertising' },
                wp.element.createElement(RichText, {
                  tagName: 'span',
                  placeholder: __('Advertising'),
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
              wp.element.createElement(
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
                          className: 'dashicons dashicons-edit'
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
              ),
              data.option !== 'option-3' && wp.element.createElement(
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
              wp.element.createElement(RichText, {
                tagName: 'div',
                placeholder: __('Learn More'),
                value: data.buttonText,
                keepPlaceholderOnFocus: 'true',
                className: 'btn',
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
              { title: 'General Settings' },
              wp.element.createElement(
                PanelRow,
                null,
                'Test'
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
                )
              )
            )
          ),
          wp.element.createElement(
            'div',
            { className: 'related-content' },
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
        );
      }
    }]);

    return ItemComponent;
  }(Component);

  registerBlockType('rg/related-content', {
    title: __('Related Content'),
    description: __('Related Content'),
    icon: 'heart',
    category: 'common',
    keywords: [__('Related Content'), __('gutenberg')],
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
          { className: 'related-content' },
          dataArray.map(function (data, index) {
            return wp.element.createElement(
              'div',
              { className: 'item ' + data.option },
              data.option == 'option-1' || data.option == 'option-4' ? wp.element.createElement(
                'div',
                { className: 'background-image' },
                wp.element.createElement('img', { src: data.bgMedia })
              ) : null,
              data.option == 'option-1' || data.option == 'option-3' ? wp.element.createElement(
                'div',
                { className: 'advertising' },
                wp.element.createElement(RichText.Content, { tagName: 'span', value: data.advertising })
              ) : null,
              data.media && wp.element.createElement(
                'div',
                { className: 'image' },
                wp.element.createElement('img', { src: data.media, alt: data.mediaAlt })
              ),
              data.option !== 'option-3' && wp.element.createElement(
                Fragment,
                null,
                wp.element.createElement(RichText.Content, {
                  tagName: 'h2',
                  value: data.title,
                  className: 'title'
                }),
                wp.element.createElement(RichText.Content, {
                  tagName: 'strong',
                  value: data.subTitle,
                  className: 'sub-title'
                })
              ),
              data.option == 'option-2' && wp.element.createElement(
                Fragment,
                null,
                wp.element.createElement(RichText.Content, {
                  tagName: 'span',
                  value: data.date,
                  className: 'date'
                })
              ),
              wp.element.createElement(RichText.Content, {
                tagName: 'div',
                value: data.buttonText,
                className: 'btn'
              })
            );
          })
        )
      );
    }
  });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);

/***/ }),
/* 8 */
/***/ (function(module, exports) {

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _toConsumableArray(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } else { return Array.from(arr); } }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

;(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
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
            select: false,
            buttonText: '<a href="#">Read More</a>'
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
        var dataArray = attributes.dataArray;


        var itemList = dataArray.map(function (data, index) {
          return wp.element.createElement(
            'div',
            { className: 'item ' + (data.select ? 'select' : '') },
            wp.element.createElement(
              'div',
              { className: 'inner' },
              wp.element.createElement(
                'div',
                { className: 'settings' },
                0 < index && wp.element.createElement(
                  Tooltip,
                  { text: 'Move Left' },
                  wp.element.createElement('span', {
                    className: 'dashicons dashicons-arrow-left-alt2',
                    onClick: function onClick() {
                      return _this2.moveItem(index, index - 1);
                    }
                  })
                ),
                index + 1 < dataArray.length && wp.element.createElement(
                  Tooltip,
                  { text: 'Move Right' },
                  wp.element.createElement('span', {
                    className: 'dashicons dashicons-arrow-right-alt2',
                    onClick: function onClick() {
                      return _this2.moveItem(index, index + 1);
                    }
                  })
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
              wp.element.createElement('span', {
                className: 'dashicons dashicons-tag',
                onClick: function onClick() {
                  var arrayCopy = [].concat(_toConsumableArray(dataArray));
                  arrayCopy[index].select = data.select ? false : true;
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
              wp.element.createElement(RichText, {
                tagName: 'div',
                placeholder: __('Learn More'),
                value: data.buttonText,
                keepPlaceholderOnFocus: 'true',
                className: 'btn',
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
              { title: 'General Settings' },
              wp.element.createElement(
                PanelRow,
                null,
                'Test'
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
                    _this2.initList();
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
    title: __('Related Content 2'),
    description: __('Related Content 2'),
    icon: 'heart',
    category: 'common',
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
              { className: 'item ' + (data.select ? 'select' : '') },
              wp.element.createElement(
                'div',
                { className: 'inner' },
                wp.element.createElement('span', { className: 'dashicons dashicons-tag' }),
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
                wp.element.createElement(RichText.Content, {
                  tagName: 'div',
                  value: data.buttonText,
                  className: 'btn'
                })
              )
            );
          })
        )
      );
    }
  });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);

/***/ })
/******/ ]);