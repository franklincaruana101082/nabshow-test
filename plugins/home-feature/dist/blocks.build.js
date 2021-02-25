!function(e){function t(r){if(n[r])return n[r].exports;var l=n[r]={i:r,l:!1,exports:{}};return e[r].call(l.exports,l,l.exports,t),l.l=!0,l.exports}var n={};t.m=e,t.c=n,t.d=function(e,n,r){t.o(e,n)||Object.defineProperty(e,n,{configurable:!1,enumerable:!0,get:r})},t.n=function(e){var n=e&&e.__esModule?function(){return e.default}:function(){return e};return t.d(n,"a",n),n},t.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},t.p="",t(t.s=0)}([function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});n(1)},function(e,t,n){"use strict";function r(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function l(e,t){if(!e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!t||"object"!==typeof t&&"function"!==typeof t?e:t}function a(e,t){if("function"!==typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function, not "+typeof t);e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,enumerable:!1,writable:!0,configurable:!0}}),t&&(Object.setPrototypeOf?Object.setPrototypeOf(e,t):e.__proto__=t)}var o=n(2),i=(n.n(o),n(3)),c=(n.n(i),function(){function e(e,t){for(var n=0;n<t.length;n++){var r=t[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}return function(t,n,r){return n&&e(t.prototype,n),r&&e(t,r),t}}()),__=wp.i18n.__,u=wp.blocks.registerBlockType,s=wp.element.Component,m=wp.blockEditor,p=m.MediaUpload,f=m.PlainText,w=m.RichText,_=m.InspectorControls,d=m.BlockControls,y=m.URLInputButton,g=wp.components,k=g.Button,b=g.PanelBody,h=g.PanelRow,v=g.ToggleControl,E=function(e){function t(){var e,n,a,o;r(this,t);for(var i=arguments.length,c=Array(i),u=0;u<i;u++)c[u]=arguments[u];return n=a=l(this,(e=t.__proto__||Object.getPrototypeOf(t)).call.apply(e,[this].concat(c))),a.getInspectorControls=function(){var e=a.props,t=e.attributes,n=e.setAttributes;return wp.element.createElement(_,null,wp.element.createElement(b,{title:"Feature Options",initialOpen:!0},wp.element.createElement(h,null,wp.element.createElement(v,{label:"Links to video",checked:t.hasVideo,onChange:function(e){return n({hasVideo:e})}}))))},a.getBlockControls=function(){var e=a.props,t=e.attributes,n=e.setAttributes;return wp.element.createElement(d,null,wp.element.createElement(y,{url:t.linkUrl,onChange:function(e,t){return n({linkUrl:e})}}))},o=n,l(a,o)}return a(t,e),c(t,[{key:"render",value:function(){var e=this.props,t=e.attributes,n=e.setAttributes,r=function(e){return t.imageUrl?wp.element.createElement("img",{src:t.imageUrl,onClick:e,className:"image"}):wp.element.createElement("div",{className:"button-container"},wp.element.createElement(k,{onClick:e,className:"button button-large"},"Pick an image (optional)"))};return[this.getInspectorControls(),this.getBlockControls(),wp.element.createElement("div",{className:"weekly__feature"},wp.element.createElement("div",{className:t.hasVideo?"weekly__image _video":"weekly__image"},wp.element.createElement(p,{onSelect:function(e){n({imageAlt:e.alt,imageUrl:e.url})},type:"image",value:t.imageID,render:function(e){var t=e.open;return r(t)},className:"relatedlink__img"})),wp.element.createElement("h2",{className:"weekly__headline"},wp.element.createElement(f,{onChange:function(e){return n({featureTitle:e})},value:t.featureTitle,placeholder:"Enter title"})),wp.element.createElement("div",{className:"weekly__desc introtext"},wp.element.createElement(w,{onChange:function(e){return n({featureBody:e})},value:t.featureBody,multiline:"p",placeholder:"Enter description here"})))]}}]),t}(s);u("cgb/home-feature-block",{title:__("Home Feature Block"),icon:"cover-image",category:"common",keywords:[__("Feature"),__("Link")],attributes:{linkUrl:{attribute:"href",selector:".weekly__link"},hasVideo:{type:"boolean",default:!1},featureBody:{type:"string",source:"html",selector:".weekly__desc"},featureTitle:{source:"text",selector:".weekly__headline"},imageUrl:{attribute:"src",selector:".weekly__img"},imageAlt:{attribute:"alt",selector:".weekly__img"}},edit:E,save:function(e){var t=e.attributes;return wp.element.createElement("div",{className:"weekly__feature"},function(e,n){return e?n?wp.element.createElement("div",{className:t.hasVideo?"weekly__image _video":"weekly__image",style:"background-image: url('"+e+"');"},wp.element.createElement("a",{className:"weekly__link",href:t.linkUrl},wp.element.createElement("img",{className:"relatedlink__img",src:e,alt:n}))):wp.element.createElement("div",{className:t.hasVideo?"weekly__image _video":"weekly__image",style:"background-image: url('"+e+"');"},wp.element.createElement("a",{className:"weekly__link",href:t.linkUrl},wp.element.createElement("img",{className:"relatedlink__img",src:e,"aria-hidden":"true"}))):null}(t.imageUrl,t.imageAlt),wp.element.createElement("a",{className:"weekly__link",href:t.linkUrl},wp.element.createElement("h2",{className:"weekly__headline"},t.featureTitle)),wp.element.createElement("div",{className:"weekly__desc introtext"},wp.element.createElement(w.Content,{value:t.featureBody})))}})},function(e,t){},function(e,t){}]);