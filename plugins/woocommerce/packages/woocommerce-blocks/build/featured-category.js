this.wc=this.wc||{},this.wc.blocks=this.wc.blocks||{},this.wc.blocks["featured-category"]=function(e){function t(t){for(var r,i,a=t[0],u=t[1],s=t[2],d=0,g=[];d<a.length;d++)i=a[d],Object.prototype.hasOwnProperty.call(o,i)&&o[i]&&g.push(o[i][0]),o[i]=0;for(r in u)Object.prototype.hasOwnProperty.call(u,r)&&(e[r]=u[r]);for(l&&l(t);g.length;)g.shift()();return c.push.apply(c,s||[]),n()}function n(){for(var e,t=0;t<c.length;t++){for(var n=c[t],r=!0,a=1;a<n.length;a++){var u=n[a];0!==o[u]&&(r=!1)}r&&(c.splice(t--,1),e=i(i.s=n[0]))}return e}var r={},o={22:0},c=[];function i(t){if(r[t])return r[t].exports;var n=r[t]={i:t,l:!1,exports:{}};return e[t].call(n.exports,n,n.exports,i),n.l=!0,n.exports}i.m=e,i.c=r,i.d=function(e,t,n){i.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:n})},i.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},i.t=function(e,t){if(1&t&&(e=i(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(i.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)i.d(n,r,function(t){return e[t]}.bind(null,r));return n},i.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return i.d(t,"a",t),t},i.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},i.p="";var a=window.webpackWcBlocksJsonp=window.webpackWcBlocksJsonp||[],u=a.push.bind(a);a.push=t,a=a.slice();for(var s=0;s<a.length;s++)t(a[s]);var l=u;return c.push([856,0]),n()}({0:function(e,t){!function(){e.exports=this.wp.element}()},1:function(e,t){!function(){e.exports=this.wp.i18n}()},110:function(e,t){},111:function(e,t){},112:function(e,t){},113:function(e,t){},114:function(e,t){},115:function(e,t){},116:function(e,t){},117:function(e,t){},118:function(e,t){},119:function(e,t){},120:function(e,t){},121:function(e,t){},122:function(e,t){},13:function(e,t){!function(){e.exports=this.wp.apiFetch}()},131:function(e,t){},143:function(e,t,n){"use strict";var r=n(0),o=n(56),c=Object(r.createElement)(o.b,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},Object(r.createElement)("path",{d:"M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"}));t.a=c},144:function(e,t){},15:function(e,t){!function(){e.exports=this.wp.blockEditor}()},16:function(e,t){!function(){e.exports=this.regeneratorRuntime}()},19:function(e,t){!function(){e.exports=this.wp.blocks}()},20:function(e,t){!function(){e.exports=this.wp.url}()},3:function(e,t){!function(){e.exports=this.wc.wcSettings}()},32:function(e,t){!function(){e.exports=this.wp.htmlEntities}()},34:function(e,t){!function(){e.exports=this.moment}()},37:function(e,t){!function(){e.exports=this.wp.isShallowEqual}()},4:function(e,t){!function(){e.exports=this.wp.components}()},43:function(e,t,n){"use strict";n.d(t,"h",(function(){return g})),n.d(t,"e",(function(){return b})),n.d(t,"b",(function(){return p})),n.d(t,"i",(function(){return f})),n.d(t,"f",(function(){return m})),n.d(t,"c",(function(){return h})),n.d(t,"d",(function(){return O})),n.d(t,"g",(function(){return j})),n.d(t,"a",(function(){return y}));var r=n(9),o=n.n(r),c=n(20),i=n(13),a=n.n(i),u=n(7),s=n(5);function l(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,r)}return n}function d(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?l(Object(n),!0).forEach((function(t){o()(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):l(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}var g=function(e){var t=e.selected,n=void 0===t?[]:t,r=e.search,o=void 0===r?"":r,i=e.queryArgs,l=function(e){var t=e.selected,n=void 0===t?[]:t,r=e.search,o=void 0===r?"":r,i=e.queryArgs,a=void 0===i?[]:i,u={per_page:s.v?100:0,catalog_visibility:"any",search:o,orderby:"title",order:"asc"},l=[Object(c.addQueryArgs)("/wc/store/products",d(d({},u),a))];return s.v&&n.length&&l.push(Object(c.addQueryArgs)("/wc/store/products",{catalog_visibility:"any",include:n})),l}({selected:n,search:o,queryArgs:void 0===i?[]:i});return Promise.all(l.map((function(e){return a()({path:e})}))).then((function(e){return Object(u.uniqBy)(Object(u.flatten)(e),"id").map((function(e){return d(d({},e),{},{parent:0})}))})).catch((function(e){throw e}))},b=function(e){return a()({path:"/wc/store/products/".concat(e)})},p=function(){return a()({path:"wc/store/products/attributes"})},f=function(e){return a()({path:"wc/store/products/attributes/".concat(e,"/terms")})},m=function(e){var t=e.selected,n=function(e){var t=e.selected,n=void 0===t?[]:t,r=e.search,o=[Object(c.addQueryArgs)("wc/store/products/tags",{per_page:s.x?100:0,orderby:s.x?"count":"name",order:s.x?"desc":"asc",search:r})];return s.x&&n.length&&o.push(Object(c.addQueryArgs)("wc/store/products/tags",{include:n})),o}({selected:void 0===t?[]:t,search:e.search});return Promise.all(n.map((function(e){return a()({path:e})}))).then((function(e){return Object(u.uniqBy)(Object(u.flatten)(e),"id")}))},h=function(e){return a()({path:Object(c.addQueryArgs)("wc/store/products/categories",d({per_page:0},e))})},O=function(e){return a()({path:"wc/store/products/categories/".concat(e)})},j=function(e){return a()({path:Object(c.addQueryArgs)("wc/store/products",{per_page:0,type:"variation",parent:e})})},y=function(e,t){if(!e.title.raw)return e.slug;var n=1===t.filter((function(t){return t.title.raw===e.title.raw})).length;return e.title.raw+(n?"":" - ".concat(e.slug))}},45:function(e,t,n){"use strict";n.d(t,"a",(function(){return a}));var r=n(16),o=n.n(r),c=n(38),i=n.n(c),a=function(){var e=i()(o.a.mark((function e(t){var n;return o.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:if("function"!=typeof t.json){e.next=11;break}return e.prev=1,e.next=4,t.json();case 4:return n=e.sent,e.abrupt("return",{message:n.message,type:n.type||"api"});case 8:return e.prev=8,e.t0=e.catch(1),e.abrupt("return",{message:e.t0.message,type:"general"});case 11:return e.abrupt("return",{message:t.message,type:t.type||"general"});case 12:case"end":return e.stop()}}),e,null,[[1,8]])})));return function(t){return e.apply(this,arguments)}}()},47:function(e,t){!function(){e.exports=this.wp.escapeHtml}()},49:function(e,t,n){"use strict";var r=n(0),o=n(1),c=(n(2),n(47));t.a=function(e){var t,n,i,a=e.error;return Object(r.createElement)("div",{className:"wc-block-error-message"},(n=(t=a).message,i=t.type,n?"general"===i?Object(r.createElement)("span",null,Object(o.__)("The following error was returned",'woocommerce'),Object(r.createElement)("br",null),Object(r.createElement)("code",null,Object(c.escapeHTML)(n))):"api"===i?Object(r.createElement)("span",null,Object(o.__)("The following error was returned from the API",'woocommerce'),Object(r.createElement)("br",null),Object(r.createElement)("code",null,Object(c.escapeHTML)(n))):n:Object(o.__)("An unknown error occurred which prevented the block from being updated.",'woocommerce')))}},5:function(e,t,n){"use strict";n.d(t,"l",(function(){return o})),n.d(t,"J",(function(){return c})),n.d(t,"P",(function(){return i})),n.d(t,"z",(function(){return a})),n.d(t,"B",(function(){return u})),n.d(t,"m",(function(){return s})),n.d(t,"A",(function(){return l})),n.d(t,"D",(function(){return d})),n.d(t,"o",(function(){return g})),n.d(t,"C",(function(){return b})),n.d(t,"n",(function(){return p})),n.d(t,"F",(function(){return f})),n.d(t,"v",(function(){return m})),n.d(t,"x",(function(){return h})),n.d(t,"s",(function(){return O})),n.d(t,"t",(function(){return j})),n.d(t,"u",(function(){return y})),n.d(t,"k",(function(){return w})),n.d(t,"L",(function(){return v})),n.d(t,"Q",(function(){return k})),n.d(t,"q",(function(){return _})),n.d(t,"r",(function(){return S})),n.d(t,"p",(function(){return E})),n.d(t,"I",(function(){return C})),n.d(t,"c",(function(){return x})),n.d(t,"w",(function(){return P})),n.d(t,"T",(function(){return I})),n.d(t,"U",(function(){return T})),n.d(t,"K",(function(){return D})),n.d(t,"a",(function(){return A})),n.d(t,"N",(function(){return B})),n.d(t,"b",(function(){return M})),n.d(t,"M",(function(){return N})),n.d(t,"E",(function(){return L})),n.d(t,"i",(function(){return z})),n.d(t,"O",(function(){return U})),n.d(t,"h",(function(){return V})),n.d(t,"j",(function(){return $})),n.d(t,"H",(function(){return q})),n.d(t,"G",(function(){return Q})),n.d(t,"S",(function(){return G})),n.d(t,"R",(function(){return W})),n.d(t,"d",(function(){return J})),n.d(t,"e",(function(){return Y})),n.d(t,"f",(function(){return K})),n.d(t,"g",(function(){return X})),n.d(t,"y",(function(){return Z})),n.d(t,"X",(function(){return te})),n.d(t,"Y",(function(){return ne})),n.d(t,"V",(function(){return re})),n.d(t,"W",(function(){return oe}));var r=n(3),o=Object(r.getSetting)("currentUserIsAdmin",!1),c=Object(r.getSetting)("reviewRatingsEnabled",!0),i=Object(r.getSetting)("showAvatars",!0),a=Object(r.getSetting)("max_columns",6),u=Object(r.getSetting)("min_columns",1),s=Object(r.getSetting)("default_columns",3),l=Object(r.getSetting)("max_rows",6),d=Object(r.getSetting)("min_rows",1),g=Object(r.getSetting)("default_rows",3),b=Object(r.getSetting)("min_height",500),p=Object(r.getSetting)("default_height",500),f=Object(r.getSetting)("placeholderImgSrc",""),m=(Object(r.getSetting)("thumbnail_size",300),Object(r.getSetting)("isLargeCatalog")),h=Object(r.getSetting)("limitTags"),O=Object(r.getSetting)("hasProducts",!0),j=Object(r.getSetting)("hasTags",!0),y=Object(r.getSetting)("homeUrl",""),w=Object(r.getSetting)("couponsEnabled",!0),v=Object(r.getSetting)("shippingEnabled",!0),k=Object(r.getSetting)("taxesEnabled",!0),_=Object(r.getSetting)("displayItemizedTaxes",!1),S=Object(r.getSetting)("hasDarkEditorStyleSupport",!1),E=(Object(r.getSetting)("displayShopPricesIncludingTax",!1),Object(r.getSetting)("displayCartPricesIncludingTax",!1)),C=Object(r.getSetting)("productCount",0),x=Object(r.getSetting)("attributes",[]),P=Object(r.getSetting)("isShippingCalculatorEnabled",!0),R=(Object(r.getSetting)("isShippingCostHidden",!1),Object(r.getSetting)("woocommerceBlocksPhase",1)),I=Object(r.getSetting)("wcBlocksAssetUrl",""),T=Object(r.getSetting)("wcBlocksBuildUrl",""),D=Object(r.getSetting)("shippingCountries",{}),A=Object(r.getSetting)("allowedCountries",{}),B=Object(r.getSetting)("shippingStates",{}),M=Object(r.getSetting)("allowedStates",{}),N=Object(r.getSetting)("shippingMethodsExist",!1),L=Object(r.getSetting)("paymentGatewaySortOrder",[]),z=Object(r.getSetting)("checkoutShowLoginReminder",!0),F={id:0,title:"",permalink:""},H=Object(r.getSetting)("storePages",{shop:F,cart:F,checkout:F,privacy:F,terms:F}),U=H.shop.permalink,V=H.checkout.id,$=H.checkout.permalink,q=H.privacy.permalink,Q=H.privacy.title,G=H.terms.permalink,W=H.terms.title,J=H.cart.id,Y=H.cart.permalink,K=Object(r.getSetting)("checkoutAllowsGuest",!1),X=Object(r.getSetting)("checkoutAllowsSignup",!1),Z=Object(r.getSetting)("loginUrl","/wp-login.php"),ee=n(19),te=function(e,t){if(R>2)return Object(ee.registerBlockType)(e,t)},ne=function(e,t){if(R>1)return Object(ee.registerBlockType)(e,t)},re=function(){return R>2},oe=function(){return R>1}},55:function(e,t){!function(){e.exports=this.wp.keycodes}()},6:function(e,t){!function(){e.exports=this.React}()},64:function(e,t,n){"use strict";var r=n(9),o=n.n(r),c=n(31),i=n.n(c),a=n(6);n(2);function u(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,r)}return n}t.a=function(e){var t=e.srcElement,n=e.size,r=void 0===n?24:n,c=i()(e,["srcElement","size"]);return Object(a.isValidElement)(t)&&Object(a.cloneElement)(t,function(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?u(Object(n),!0).forEach((function(t){o()(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):u(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}({width:r,height:r},c))}},7:function(e,t){!function(){e.exports=this.lodash}()},75:function(e,t){!function(){e.exports=this.wp.dom}()},77:function(e,t){!function(){e.exports=this.wp.hooks}()},80:function(e,t){!function(){e.exports=this.ReactDOM}()},84:function(e,t){!function(){e.exports=this.wp.viewport}()},85:function(e,t,n){"use strict";var r=n(10),o=n.n(r),c=n(0),i=n(1),a=n(7),u=(n(2),n(50)),s=n(4),l=n(16),d=n.n(l),g=n(38),b=n.n(g),p=n(22),f=n.n(p),m=n(26),h=n.n(m),O=n(21),j=n.n(O),y=n(23),w=n.n(y),v=n(24),k=n.n(v),_=n(12),S=n.n(_),E=n(36),C=n(43),x=n(45);function P(e){var t=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Date.prototype.toString.call(Reflect.construct(Date,[],(function(){}))),!0}catch(e){return!1}}();return function(){var n,r=S()(e);if(t){var o=S()(this).constructor;n=Reflect.construct(r,arguments,o)}else n=r.apply(this,arguments);return k()(this,n)}}var R=Object(E.b)((function(e){return function(t){w()(r,t);var n=P(r);function r(){var e;return f()(this,r),(e=n.apply(this,arguments)).state={error:null,loading:!1,categories:null},e.loadCategories=e.loadCategories.bind(j()(e)),e}return h()(r,[{key:"componentDidMount",value:function(){this.loadCategories()}},{key:"loadCategories",value:function(){var e=this;this.setState({loading:!0}),Object(C.c)().then((function(t){e.setState({categories:t,loading:!1,error:null})})).catch(function(){var t=b()(d.a.mark((function t(n){var r;return d.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,Object(x.a)(n);case 2:r=t.sent,e.setState({categories:null,loading:!1,error:r});case 4:case"end":return t.stop()}}),t)})));return function(e){return t.apply(this,arguments)}}())}},{key:"render",value:function(){var t=this.state,n=t.error,r=t.loading,i=t.categories;return Object(c.createElement)(e,o()({},this.props,{error:n,isLoading:r,categories:i}))}}]),r}(c.Component)}),"withCategories"),I=n(49),T=(n(131),function(e){var t=e.categories,n=e.error,r=e.isLoading,l=e.onChange,d=e.onOperatorChange,g=e.operator,b=e.selected,p=e.isSingle,f=e.showReviewCount,m={clear:Object(i.__)("Clear all product categories",'woocommerce'),list:Object(i.__)("Product Categories",'woocommerce'),noItems:Object(i.__)("Your store doesn't have any product categories.",'woocommerce'),search:Object(i.__)("Search for product categories",'woocommerce'),selected:function(e){return Object(i.sprintf)(Object(i._n)("%d category selected","%d categories selected",e,'woocommerce'),e)},updated:Object(i.__)("Category search results updated.",'woocommerce')};return n?Object(c.createElement)(I.a,{error:n}):Object(c.createElement)(c.Fragment,null,Object(c.createElement)(u.a,{className:"woocommerce-product-categories",list:t,isLoading:r,selected:b.map((function(e){return Object(a.find)(t,{id:e})})).filter(Boolean),onChange:l,renderItem:function(e){var t=e.item,n=e.search,r=e.depth,a=void 0===r?0:r,s=["woocommerce-product-categories__item"];n.length&&s.push("is-searching"),0===a&&0!==t.parent&&s.push("is-skip-level");var l=t.breadcrumbs.length?"".concat(t.breadcrumbs.join(", "),", ").concat(t.name):t.name,d=f?Object(i.sprintf)(Object(i._n)("%1$s, has %2$d review","%1$s, has %2$d reviews",t.review_count,'woocommerce'),l,t.review_count):Object(i.sprintf)(Object(i._n)("%1$s, has %2$d product","%1$s, has %2$d products",t.count,'woocommerce'),l,t.count),g=f?Object(i.sprintf)(Object(i._n)("%d Review","%d Reviews",t.review_count,'woocommerce'),t.review_count):Object(i.sprintf)(Object(i._n)("%d Product","%d Products",t.count,'woocommerce'),t.count);return Object(c.createElement)(u.b,o()({className:s.join(" ")},e,{showCount:!0,countLabel:g,"aria-label":d}))},messages:m,isHierarchical:!0,isSingle:p}),!!d&&Object(c.createElement)("div",{className:b.length<2?"screen-reader-text":""},Object(c.createElement)(s.SelectControl,{className:"woocommerce-product-categories__operator",label:Object(i.__)("Display products matching",'woocommerce'),help:Object(i.__)("Pick at least two categories to use this setting.",'woocommerce'),value:g,onChange:d,options:[{label:Object(i.__)("Any selected categories",'woocommerce'),value:"any"},{label:Object(i.__)("All selected categories",'woocommerce'),value:"all"}]})))});T.defaultProps={operator:"any",isSingle:!1};t.a=R(T)},856:function(e,t,n){e.exports=n(925)},857:function(e,t){},858:function(e,t){},925:function(e,t,n){"use strict";n.r(t);var r=n(0),o=n(1),c=n(15),i=n(19),a=n(5),u=n(64),s=n(56),l=Object(r.createElement)(s.b,{xmlns:"http://www.w3.org/2000/SVG",viewBox:"0 0 24 24"},Object(r.createElement)("path",{fill:"none",d:"M0 0h24v24H0V0z"}),Object(r.createElement)("path",{d:"M20 6h-8l-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm0 12H4V6h5.17l2 2H20v10zm-6.92-3.96L12.39 17 15 15.47 17.61 17l-.69-2.96 2.3-1.99-3.03-.26L15 9l-1.19 2.79-3.03.26z"})),d=(n(857),n(858),n(4)),g=n(8),b=n.n(g),p=n(36),f=(n(2),n(85)),m=n(94),h=n(7);function O(e){return e&&Object(h.isObject)(e.image)?e.image.src:""}var j=n(10),y=n.n(j),w=n(16),v=n.n(w),k=n(38),_=n.n(k),S=n(22),E=n.n(S),C=n(26),x=n.n(C),P=n(21),R=n.n(P),I=n(23),T=n.n(I),D=n(24),A=n.n(D),B=n(12),M=n.n(B),N=n(43),L=n(45);function z(e){var t=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Date.prototype.toString.call(Reflect.construct(Date,[],(function(){}))),!0}catch(e){return!1}}();return function(){var n,r=M()(e);if(t){var o=M()(this).constructor;n=Reflect.construct(r,arguments,o)}else n=r.apply(this,arguments);return A()(this,n)}}var F=Object(p.b)((function(e){return function(t){T()(o,t);var n=z(o);function o(){var e;return E()(this,o),(e=n.apply(this,arguments)).state={error:null,loading:!1,category:"preview"===e.props.attributes.categoryId?e.props.attributes.previewCategory:null},e.loadCategory=e.loadCategory.bind(R()(e)),e}return x()(o,[{key:"componentDidMount",value:function(){this.loadCategory()}},{key:"componentDidUpdate",value:function(e){e.attributes.categoryId!==this.props.attributes.categoryId&&this.loadCategory()}},{key:"loadCategory",value:function(){var e=this,t=this.props.attributes.categoryId;"preview"!==t&&(t?(this.setState({loading:!0}),Object(N.d)(t).then((function(t){e.setState({category:t,loading:!1,error:null})})).catch(function(){var t=_()(v.a.mark((function t(n){var r;return v.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,Object(L.a)(n);case 2:r=t.sent,e.setState({category:null,loading:!1,error:r});case 4:case"end":return t.stop()}}),t)})));return function(e){return t.apply(this,arguments)}}())):this.setState({category:null,loading:!1,error:null}))}},{key:"render",value:function(){var t=this.state,n=t.error,o=t.loading,c=t.category;return Object(r.createElement)(e,y()({},this.props,{error:n,getCategory:this.loadCategory,isLoading:o,category:c}))}}]),o}(r.Component)}),"withCategory"),H=Object(p.a)([F,Object(c.withColors)({overlayColor:"background-color"}),d.withSpokenMessages])((function(e){var t,n,i,s,g,p,j=e.attributes,y=e.isSelected,w=e.setAttributes,v=e.error,k=e.getCategory,_=e.isLoading,S=e.category,E=e.overlayColor,C=e.setOverlayColor,x=e.debouncedSpeak,P=j.editMode;return v?Object(r.createElement)(m.a,{className:"wc-block-featured-category-error",error:v,isLoading:_,onRetry:k}):P?Object(r.createElement)(d.Placeholder,{icon:Object(r.createElement)(u.a,{srcElement:l}),label:Object(o.__)("Featured Category",'woocommerce'),className:"wc-block-featured-category"},Object(o.__)("Visually highlight a product category and encourage prompt action.",'woocommerce'),Object(r.createElement)("div",{className:"wc-block-featured-category__selection"},Object(r.createElement)(f.a,{selected:[j.categoryId],onChange:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:[],t=e[0]?e[0].id:0;w({categoryId:t,mediaId:0,mediaSrc:""})},isSingle:!0}),Object(r.createElement)(d.Button,{isPrimary:!0,onClick:function(){w({editMode:!1}),x(Object(o.__)("Showing Featured Product block preview.",'woocommerce'))}},Object(o.__)("Done",'woocommerce')))):Object(r.createElement)(r.Fragment,null,(g=j.contentAlign,p=j.mediaId||function(e){return e&&Object(h.isObject)(e.image)?e.image.id:0}(S),Object(r.createElement)(c.BlockControls,null,Object(r.createElement)(c.AlignmentToolbar,{value:g,onChange:function(e){w({contentAlign:e})}}),Object(r.createElement)(c.MediaUploadCheck,null,Object(r.createElement)(d.Toolbar,null,Object(r.createElement)(c.MediaUpload,{onSelect:function(e){w({mediaId:e.id,mediaSrc:e.url})},allowedTypes:["image"],value:p,render:function(e){var t=e.open;return Object(r.createElement)(d.IconButton,{className:"components-toolbar__control",label:Object(o.__)("Edit media"),icon:"format-image",onClick:t,disabled:!S})}}))))),(t=j.mediaSrc||O(S),n=j.focalPoint,i=void 0===n?{x:.5,y:.5}:n,s="function"==typeof d.FocalPointPicker,Object(r.createElement)(c.InspectorControls,{key:"inspector"},Object(r.createElement)(d.PanelBody,{title:Object(o.__)("Content",'woocommerce')},Object(r.createElement)(d.ToggleControl,{label:Object(o.__)("Show description",'woocommerce'),checked:j.showDesc,onChange:function(){return w({showDesc:!j.showDesc})}})),Object(r.createElement)(c.PanelColorSettings,{title:Object(o.__)("Overlay",'woocommerce'),colorSettings:[{value:E.color,onChange:C,label:Object(o.__)("Overlay Color",'woocommerce')}]},!!t&&Object(r.createElement)(r.Fragment,null,Object(r.createElement)(d.RangeControl,{label:Object(o.__)("Background Opacity",'woocommerce'),value:j.dimRatio,onChange:function(e){return w({dimRatio:e})},min:0,max:100,step:10}),s&&Object(r.createElement)(d.FocalPointPicker,{label:Object(o.__)("Focal Point Picker"),url:t,value:i,onChange:function(e){return w({focalPoint:e})}}))))),S?function(){var e,t,n=j.className,i=j.contentAlign,u=j.dimRatio,s=j.focalPoint,l=j.height,g=j.showDesc,p=b()("wc-block-featured-category",{"is-selected":y&&"preview"!==j.productId,"is-loading":!S&&_,"is-not-found":!S&&!_,"has-background-dim":0!==u},0===(e=u)||50===e?null:"has-background-dim-".concat(10*Math.round(e/10)),"center"!==i&&"has-".concat(i,"-content"),n),f=j.mediaSrc||O(S),m=S?(t=f)?{backgroundImage:"url(".concat(t,")")}:{}:{};if(E.color&&(m.backgroundColor=E.color),s){var h=100*s.x,v=100*s.y;m.backgroundPosition="".concat(h,"% ").concat(v,"%")}var k;return Object(r.createElement)(d.ResizableBox,{className:p,size:{height:l},minHeight:a.C,enable:{bottom:!0},onResizeStop:function(e,t,n){w({height:parseInt(n.style.height,10)})},style:m},Object(r.createElement)("div",{className:"wc-block-featured-category__wrapper"},Object(r.createElement)("h2",{className:"wc-block-featured-category__title",dangerouslySetInnerHTML:{__html:S.name}}),g&&Object(r.createElement)("div",{className:"wc-block-featured-category__description",dangerouslySetInnerHTML:{__html:S.description}}),Object(r.createElement)("div",{className:"wc-block-featured-category__link"},(k=b()("wp-block-button__link","is-style-fill"),"preview"===j.categoryId?Object(r.createElement)("div",{className:"wp-block-button aligncenter",style:{width:"100%"}},Object(r.createElement)(c.RichText.Content,{tagName:"a",className:k,href:S.permalink,title:j.linkText,style:{backgroundColor:"vivid-green-cyan",borderRadius:"5px"},value:j.linkText,target:S.permalink})):Object(r.createElement)(c.InnerBlocks,{template:[["core/button",{text:Object(o.__)("Shop now",'woocommerce'),url:S.permalink,align:"center"}]],templateLock:"all"})))))}():Object(r.createElement)(d.Placeholder,{className:"wc-block-featured-category",icon:Object(r.createElement)(u.a,{srcElement:l}),label:Object(o.__)("Featured Category",'woocommerce')},_?Object(r.createElement)(d.Spinner,null):Object(o.__)("No product category is selected.",'woocommerce')))})),U=[{id:1,name:Object(o.__)("Clothing",'woocommerce'),slug:"clothing",parent:0,count:10,description:"<p>".concat(Object(o.__)("Branded t-shirts, jumpers, pants and more!",'woocommerce'),"</p>\n"),image:{id:1,date_created:"2019-07-15T17:05:04",date_created_gmt:"2019-07-15T17:05:04",date_modified:"2019-07-15T17:05:04",date_modified_gmt:"2019-07-15T17:05:04",src:a.T+"img/collection.jpg",name:"",alt:""},permalink:"#"}],V={attributes:{contentAlign:"center",dimRatio:50,editMode:!1,height:a.n,mediaSrc:"",showDesc:!0,categoryId:"preview",previewCategory:U[0]}};Object(i.registerBlockType)("woocommerce/featured-category",{title:Object(o.__)("Featured Category",'woocommerce'),icon:{src:Object(r.createElement)(u.a,{srcElement:l}),foreground:"#96588a"},category:"woocommerce",keywords:[Object(o.__)("WooCommerce",'woocommerce')],description:Object(o.__)("Visually highlight a product category and encourage prompt action.",'woocommerce'),supports:{align:["wide","full"],html:!1},example:V,attributes:{contentAlign:{type:"string",default:"center"},dimRatio:{type:"number",default:50},editMode:{type:"boolean",default:!0},focalPoint:{type:"object"},height:{type:"number",default:a.n},mediaId:{type:"number",default:0},mediaSrc:{type:"string",default:""},overlayColor:{type:"string"},customOverlayColor:{type:"string"},linkText:{type:"string",default:Object(o.__)("Shop now",'woocommerce')},categoryId:{type:"number"},showDesc:{type:"boolean",default:!0},previewCategory:{type:"object",default:null}},edit:function(e){return Object(r.createElement)(H,e)},save:function(){return Object(r.createElement)(c.InnerBlocks.Content,null)}})},94:function(e,t,n){"use strict";var r=n(0),o=n(1),c=(n(2),n(64)),i=n(143),a=n(8),u=n.n(a),s=n(4),l=n(49);n(144);t.a=function(e){var t=e.className,n=e.error,a=e.isLoading,d=e.onRetry;return Object(r.createElement)(s.Placeholder,{icon:Object(r.createElement)(c.a,{srcElement:i.a}),label:Object(o.__)("Sorry, an error occurred",'woocommerce'),className:u()("wc-block-api-error",t)},Object(r.createElement)(l.a,{error:n}),d&&Object(r.createElement)(r.Fragment,null,a?Object(r.createElement)(s.Spinner,null):Object(r.createElement)(s.Button,{isDefault:!0,onClick:d},Object(o.__)("Retry",'woocommerce'))))}},95:function(e,t){!function(){e.exports=this.wp.date}()}});
