!function(e){function t(t){for(var n,a,u=t[0],c=t[1],_=t[2],s=0,p=[];s<u.length;s++)a=u[s],Object.prototype.hasOwnProperty.call(o,a)&&o[a]&&p.push(o[a][0]),o[a]=0;for(n in c)Object.prototype.hasOwnProperty.call(c,n)&&(e[n]=c[n]);for(l&&l(t);p.length;)p.shift()();return i.push.apply(i,_||[]),r()}function r(){for(var e,t=0;t<i.length;t++){for(var r=i[t],n=!0,a=1;a<r.length;a++){var u=r[a];0!==o[u]&&(n=!1)}n&&(i.splice(t--,1),e=__webpack_require__(__webpack_require__.s=r[0]))}return e}var n={},o={6:0},i=[];function __webpack_require__(t){if(n[t])return n[t].exports;var r=n[t]={i:t,l:!1,exports:{}};return e[t].call(r.exports,r,r.exports,__webpack_require__),r.l=!0,r.exports}__webpack_require__.m=e,__webpack_require__.c=n,__webpack_require__.d=function(e,t,r){__webpack_require__.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:r})},__webpack_require__.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},__webpack_require__.t=function(e,t){if(1&t&&(e=__webpack_require__(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(__webpack_require__.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var n in e)__webpack_require__.d(r,n,function(t){return e[t]}.bind(null,n));return r},__webpack_require__.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return __webpack_require__.d(t,"a",t),t},__webpack_require__.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},__webpack_require__.p="";var a=window.__googlesitekit_webpackJsonp=window.__googlesitekit_webpackJsonp||[],u=a.push.bind(a);a.push=t,a=a.slice();for(var c=0;c<a.length;c++)t(a[c]);var l=u;i.push([625,0]),r()}({54:function(e,t,r){"use strict";(function(e){r.d(t,"a",(function(){return a})),r.d(t,"b",(function(){return u})),r.d(t,"c",(function(){return l}));var n=r(39),o=r.n(n),i=r(0),a=function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:0,t=null,r=null,n=document.querySelector("#toplevel_page_googlesitekit-dashboard .googlesitekit-notifications-counter"),o=document.querySelector("#wp-admin-bar-google-site-kit .googlesitekit-notifications-counter");if(n&&o)return!1;if(t=document.querySelector("#toplevel_page_googlesitekit-dashboard .wp-menu-name"),r=document.querySelector("#wp-admin-bar-google-site-kit .ab-item"),null===t&&null===r)return!1;var a=document.createElement("span");a.setAttribute("class","googlesitekit-notifications-counter update-plugins count-".concat(e));var u=document.createElement("span");u.setAttribute("class","plugin-count"),u.setAttribute("aria-hidden","true"),u.textContent=e;var c=document.createElement("span");return c.setAttribute("class","screen-reader-text"),c.textContent=Object(i.sprintf)(
/* translators: %d is the number of notifications */
Object(i._n)("%d notification","%d notifications",e,"google-site-kit"),e),a.appendChild(u),a.appendChild(c),t&&null===n&&t.appendChild(a),r&&null===o&&r.appendChild(a),a},u=function(){e.localStorage&&e.localStorage.clear(),e.sessionStorage&&e.sessionStorage.clear()},c=function(e){for(var t=location.search.substr(1).split("&"),r={},n=0;n<t.length;n++)r[t[n].split("=")[0]]=decodeURIComponent(t[n].split("=")[1]);return e?r.hasOwnProperty(e)?decodeURIComponent(r[e].replace(/\+/g," ")):"":r},l=function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:location,r=new URL(t.href);if(e)return r.searchParams&&r.searchParams.get?r.searchParams.get(e):c(e);var n={},i=!0,a=!1,u=void 0;try{for(var l,_=r.searchParams.entries()[Symbol.iterator]();!(i=(l=_.next()).done);i=!0){var s=o()(l.value,2),p=s[0],d=s[1];n[p]=d}}catch(e){a=!0,u=e}finally{try{i||null==_.return||_.return()}finally{if(a)throw u}}return n}}).call(this,r(16))},625:function(e,t,r){"use strict";r.r(t),function(e){var t=r(54);if("toplevel_page_googlesitekit-dashboard"!==e.pagenow&&"site-kit_page_googlesitekit-splash"!==e.pagenow&&"admin_page_googlesitekit-splash"!==e.pagenow&&e.localStorage){var n=e.localStorage.getItem("googlesitekit::total-notifications")||0;Object(t.a)(n)}var o=document.querySelector("#wp-admin-bar-logout a");o||(o=document.querySelector(".sidebar__me-signout button")),o&&o.addEventListener("click",(function(){Object(t.b)()}))}.call(this,r(16))}});