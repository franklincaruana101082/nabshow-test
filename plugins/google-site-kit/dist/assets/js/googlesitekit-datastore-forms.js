!function(e){function r(r){for(var n,c,u=r[0],s=r[1],p=r[2],f=0,l=[];f<u.length;f++)c=u[f],Object.prototype.hasOwnProperty.call(a,c)&&a[c]&&l.push(a[c][0]),a[c]=0;for(n in s)Object.prototype.hasOwnProperty.call(s,n)&&(e[n]=s[n]);for(i&&i(r);l.length;)l.shift()();return o.push.apply(o,p||[]),t()}function t(){for(var e,r=0;r<o.length;r++){for(var t=o[r],n=!0,c=1;c<t.length;c++){var u=t[c];0!==a[u]&&(n=!1)}n&&(o.splice(r--,1),e=__webpack_require__(__webpack_require__.s=t[0]))}return e}var n={},a={13:0},o=[];function __webpack_require__(r){if(n[r])return n[r].exports;var t=n[r]={i:r,l:!1,exports:{}};return e[r].call(t.exports,t,t.exports,__webpack_require__),t.l=!0,t.exports}__webpack_require__.m=e,__webpack_require__.c=n,__webpack_require__.d=function(e,r,t){__webpack_require__.o(e,r)||Object.defineProperty(e,r,{enumerable:!0,get:t})},__webpack_require__.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},__webpack_require__.t=function(e,r){if(1&r&&(e=__webpack_require__(e)),8&r)return e;if(4&r&&"object"==typeof e&&e&&e.__esModule)return e;var t=Object.create(null);if(__webpack_require__.r(t),Object.defineProperty(t,"default",{enumerable:!0,value:e}),2&r&&"string"!=typeof e)for(var n in e)__webpack_require__.d(t,n,function(r){return e[r]}.bind(null,n));return t},__webpack_require__.n=function(e){var r=e&&e.__esModule?function(){return e.default}:function(){return e};return __webpack_require__.d(r,"a",r),r},__webpack_require__.o=function(e,r){return Object.prototype.hasOwnProperty.call(e,r)},__webpack_require__.p="";var c=window.__googlesitekit_webpackJsonp=window.__googlesitekit_webpackJsonp||[],u=c.push.bind(c);c.push=r,c=c.slice();for(var s=0;s<c.length;s++)r(c[s]);var i=u;o.push([568,0]),t()}({14:function(e,r){e.exports=googlesitekit.data},239:function(e,r,t){"use strict";t.d(r,"a",(function(){return _.a}));var n=t(14),a=t.n(n),o=t(86),c=t(10),u=t.n(c),s=t(20),i=t.n(s);function p(e,r){var t=Object.keys(e);return Object.getOwnPropertySymbols&&t.push.apply(t,Object.getOwnPropertySymbols(e)),r&&(t=t.filter((function(r){return Object.getOwnPropertyDescriptor(e,r).enumerable}))),t}function f(e){for(var r=1;r<arguments.length;r++){var t=null!=arguments[r]?arguments[r]:{};r%2?p(t,!0).forEach((function(r){u()(e,r,t[r])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(t)):p(t).forEach((function(r){Object.defineProperty(e,r,Object.getOwnPropertyDescriptor(t,r))}))}return e}var l={INITIAL_STATE:{},actions:{setValues:function(e,r){return i()(e,"formName is required for setting values."),i()(r instanceof Object&&r.constructor===Object,"formData must be an object."),{payload:{formName:e,formData:r},type:"SET_FORM_VALUES"}}},controls:{},reducer:function(e,r){var t=r.type,n=r.payload;switch(t){case"SET_FORM_VALUES":var a=n.formName,o=n.formData;return f({},e,u()({},a,f({},e[a]||{},{},o)));default:return f({},e)}},resolvers:{},selectors:{getValue:function(e,r,t){return(e[r]||{})[t]},hasForm:function(e,r){return!!e[r]}}},_=t(90),b=a.a.combineStores(a.a.commonStore,l,Object(o.a)(_.a));b.INITIAL_STATE,b.actions,b.controls,b.reducer,b.resolvers,b.selectors;a.a.registerStore(_.a,b)},568:function(e,r,t){"use strict";t.r(r);t(239)},73:function(e,r,t){"use strict";(function(e){t.d(r,"b",(function(){return p})),t.d(r,"d",(function(){return f})),t.d(r,"a",(function(){return l})),t.d(r,"c",(function(){return _}));var n,a=t(3),o=t.n(a),c=(t(80),["localStorage","sessionStorage"]),u=[].concat(c),s=function(r){var t,n;return o.a.async((function(a){for(;;)switch(a.prev=a.next){case 0:if(t=e[r]){a.next=3;break}return a.abrupt("return",!1);case 3:return a.prev=3,n="__storage_test__",t.setItem(n,n),t.removeItem(n),a.abrupt("return",!0);case 10:return a.prev=10,a.t0=a.catch(3),a.abrupt("return",a.t0 instanceof DOMException&&(22===a.t0.code||1014===a.t0.code||"QuotaExceededError"===a.t0.name||"NS_ERROR_DOM_QUOTA_REACHED"===a.t0.name)&&0!==t.length);case 13:case"end":return a.stop()}}),null,null,[[3,10]])},i=function(){var r,t,a,c,i,p;return o.a.async((function(f){for(;;)switch(f.prev=f.next){case 0:if(!(e._googlesitekitLegacyData&&e._googlesitekitLegacyData.admin&&e._googlesitekitLegacyData.admin.nojscache)){f.next=2;break}return f.abrupt("return",null);case 2:if(void 0!==n){f.next=34;break}r=!0,t=!1,a=void 0,f.prev=6,c=u[Symbol.iterator]();case 8:if(r=(i=c.next()).done){f.next=19;break}if(p=i.value,!n){f.next=12;break}return f.abrupt("continue",16);case 12:return f.next=14,o.a.awrap(s(p));case 14:if(!f.sent){f.next=16;break}n=e[p];case 16:r=!0,f.next=8;break;case 19:f.next=25;break;case 21:f.prev=21,f.t0=f.catch(6),t=!0,a=f.t0;case 25:f.prev=25,f.prev=26,r||null==c.return||c.return();case 28:if(f.prev=28,!t){f.next=31;break}throw a;case 31:return f.finish(28);case 32:return f.finish(25);case 33:void 0===n&&(n=null);case 34:return f.abrupt("return",n);case 35:case"end":return f.stop()}}),null,null,[[6,21,25,33],[26,,28,32]])},p=function(e){var r,t,n,a,c=arguments;return o.a.async((function(u){for(;;)switch(u.prev=u.next){case 0:return r=c.length>1&&void 0!==c[1]?c[1]:null,u.next=3,o.a.awrap(i());case 3:if(!(t=u.sent)){u.next=10;break}if(!(n=t.getItem("".concat("googlesitekit_").concat(e)))){u.next=10;break}if(!(a=JSON.parse(n)).timestamp||!(null===r||Math.round(Date.now()/1e3)-a.timestamp<r)){u.next=10;break}return u.abrupt("return",{cacheHit:!0,value:a.value});case 10:return u.abrupt("return",{cacheHit:!1,value:void 0});case 11:case"end":return u.stop()}}))},f=function(r,t){var n,a,c=arguments;return o.a.async((function(u){for(;;)switch(u.prev=u.next){case 0:return n=c.length>2&&void 0!==c[2]?c[2]:void 0,u.next=3,o.a.awrap(i());case 3:if(!(a=u.sent)){u.next=14;break}return u.prev=5,a.setItem("".concat("googlesitekit_").concat(r),JSON.stringify({timestamp:n||Math.round(Date.now()/1e3),value:t})),u.abrupt("return",!0);case 10:return u.prev=10,u.t0=u.catch(5),e.console.warn("Encountered an unexpected storage error:",u.t0),u.abrupt("return",!1);case 14:return u.abrupt("return",!1);case 15:case"end":return u.stop()}}),null,null,[[5,10]])},l=function(r){var t;return o.a.async((function(n){for(;;)switch(n.prev=n.next){case 0:return n.next=2,o.a.awrap(i());case 2:if(!(t=n.sent)){n.next=13;break}return n.prev=4,t.removeItem("".concat("googlesitekit_").concat(r)),n.abrupt("return",!0);case 9:return n.prev=9,n.t0=n.catch(4),e.console.warn("Encountered an unexpected storage error:",n.t0),n.abrupt("return",!1);case 13:return n.abrupt("return",!1);case 14:case"end":return n.stop()}}),null,null,[[4,9]])},_=function(){var r,t,n,a;return o.a.async((function(c){for(;;)switch(c.prev=c.next){case 0:return c.next=2,o.a.awrap(i());case 2:if(!(r=c.sent)){c.next=14;break}for(c.prev=4,t=[],n=0;n<r.length;n++)0===(a=r.key(n)).indexOf("googlesitekit_")&&t.push(a.substring("googlesitekit_".length));return c.abrupt("return",t);case 10:return c.prev=10,c.t0=c.catch(4),e.console.warn("Encountered an unexpected storage error:",c.t0),c.abrupt("return",[]);case 14:return c.abrupt("return",[]);case 15:case"end":return c.stop()}}),null,null,[[4,10]])}}).call(this,t(16))},86:function(e,r,t){"use strict";t.d(r,"a",(function(){return g})),t.d(r,"c",(function(){return O})),t.d(r,"b",(function(){return y}));var n=t(47),a=t.n(n),o=t(10),c=t.n(o),u=t(3),s=t.n(u),i=t(20),p=t.n(i),f=t(14),l=t.n(f),_=t(73);function b(e,r){var t=Object.keys(e);return Object.getOwnPropertySymbols&&t.push.apply(t,Object.getOwnPropertySymbols(e)),r&&(t=t.filter((function(r){return Object.getOwnPropertyDescriptor(e,r).enumerable}))),t}function d(e){for(var r=1;r<arguments.length;r++){var t=null!=arguments[r]?arguments[r]:{};r%2?b(t,!0).forEach((function(r){c()(e,r,t[r])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(t)):b(t).forEach((function(r){Object.defineProperty(e,r,Object.getOwnPropertyDescriptor(t,r))}))}return e}var v=l.a.createRegistryControl,g=function(e){var r;p()(e,"storeName is required to create a snapshot store.");var t={},n={deleteSnapshot:s.a.mark((function e(){var r;return s.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,{payload:{},type:"DELETE_SNAPSHOT"};case 2:return r=e.sent,e.abrupt("return",r);case 4:case"end":return e.stop()}}),e)})),restoreSnapshot:s.a.mark((function e(){var r,t,n,a,o,c,u=arguments;return s.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return r=u.length>0&&void 0!==u[0]?u[0]:{},t=r.clearAfterRestore,n=void 0===t||t,e.next=3,{payload:{},type:"RESTORE_SNAPSHOT"};case 3:if(a=e.sent,o=a.cacheHit,c=a.value,!o){e.next=12;break}return e.next=9,{payload:{snapshot:c},type:"SET_STATE_FROM_SNAPSHOT"};case 9:if(!n){e.next=12;break}return e.next=12,{payload:{},type:"DELETE_SNAPSHOT"};case 12:return e.abrupt("return",o);case 13:case"end":return e.stop()}}),e)})),createSnapshot:s.a.mark((function e(){var r;return s.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,{payload:{},type:"CREATE_SNAPSHOT"};case 2:return r=e.sent,e.abrupt("return",r);case 4:case"end":return e.stop()}}),e)}))},o=(r={},c()(r,"DELETE_SNAPSHOT",(function(){return Object(_.a)("datastore::cache::".concat(e))})),c()(r,"CREATE_SNAPSHOT",v((function(r){return function(){return Object(_.d)("datastore::cache::".concat(e),r.stores[e].store.getState())}}))),c()(r,"RESTORE_SNAPSHOT",(function(){return Object(_.b)("datastore::cache::".concat(e),3600)})),r);return{INITIAL_STATE:t,actions:n,controls:o,reducer:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:t,r=arguments.length>1?arguments[1]:void 0,n=r.type,o=r.payload;switch(n){case"SET_STATE_FROM_SNAPSHOT":var c=o.snapshot,u=(c.error,a()(c,["error"]));return d({},u);default:return d({},e)}}}},h=function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:l.a;return Object.values(e.stores).filter((function(e){return Object.keys(e.getActions()).includes("restoreSnapshot")}))},O=function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:l.a;return Promise.all(h(e).map((function(e){return e.getActions().createSnapshot()})))},y=function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:l.a;return Promise.all(h(e).map((function(e){return e.getActions().restoreSnapshot()})))}},90:function(e,r,t){"use strict";t.d(r,"a",(function(){return n}));var n="core/forms"}});