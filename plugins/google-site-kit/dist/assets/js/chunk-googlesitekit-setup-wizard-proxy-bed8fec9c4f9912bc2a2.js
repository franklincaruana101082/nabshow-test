(window.__googlesitekit_webpackJsonp=window.__googlesitekit_webpackJsonp||[]).push([[3],{116:function(e,t,n){"use strict";(function(e){n.d(t,"a",(function(){return h}));var a=n(3),i=n.n(a),r=n(10),o=n.n(r),s=n(59),c=n(37),l=n(117),u=n(118),d=n(119),g=n(46);function p(e,t){var n=Object.keys(e);return Object.getOwnPropertySymbols&&n.push.apply(n,Object.getOwnPropertySymbols(e)),t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n}function m(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?p(n,!0).forEach((function(t){o()(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):p(n).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}var h=function(t){var n,a,r,o,l;return i.a.async((function(u){for(;;)switch(u.prev=u.next){case 0:return n=e._googlesitekitLegacyData.admin,a=n.homeURL,r=n.ampMode,o={tagverify:1,timestamp:Date.now()},u.next=4,i.a.awrap(f(Object(c.a)(a,o),t));case 4:if((l=u.sent)||"secondary"!==r){u.next=9;break}return u.next=8,i.a.awrap(Object(s.default)({path:"/wp/v2/posts?per_page=1"}).then((function(e){return e.slice(0,1).map((function(e){return i.a.async((function(n){for(;;)switch(n.prev=n.next){case 0:return n.next=2,i.a.awrap(f(Object(c.a)(e.link,m({},o,{amp:1})),t));case 2:return n.abrupt("return",n.sent);case 3:case"end":return n.stop()}}))})).pop()})));case 8:l=u.sent;case 9:return u.abrupt("return",Promise.resolve(l||null));case 10:case"end":return u.stop()}}))},f=function(e,t){var n;return i.a.async((function(a){for(;;)switch(a.prev=a.next){case 0:return a.prev=0,a.next=3,i.a.awrap(fetch(e,{credentials:"omit"}).then((function(e){return e.text()})));case 3:return n=a.sent,a.abrupt("return",y(n,t)||null);case 7:return a.prev=7,a.t0=a.catch(0),a.abrupt("return",null);case 10:case"end":return a.stop()}}),null,null,[[0,7]])},y=function(e,t){var n=({adsense:u.a,analytics:d.a,tagmanager:g.d,setup:l.a}[t]||[]).find((function(t){return t.test(e)}));return!!n&&n.exec(e)[1]}}).call(this,n(16))},117:function(e,t,n){"use strict";t.a=[/<meta name="googlesitekit-setup" content="([a-z0-9-]+)"/]},118:function(e,t,n){"use strict";t.a=[/google_ad_client: ?["|'](.*?)["|']/,/<(?:script|amp-auto-ads) [^>]*data-ad-client="([^"]+)"/]},119:function(e,t,n){"use strict";t.a=[/<script [^>]*src=['|"]https:\/\/www.googletagmanager.com\/gtag\/js\?id=(UA-.*?)['|"][^>]*><\/script>/,/<script[^>]*>[^<]+google-analytics\.com\/analytics\.js[^<]+(UA-\d+-\d+)/,/__gaTracker\( ?['|"]create['|"], ?['|"](UA-.*?)['|"], ?['|"]auto['|"] ?\)/,/ga\( ?['|"]create['|"], ?['|"](UA-.*?)['|"], ?['|"]auto['|"] ?\)/,/_gaq.push\( ?\[ ?['|"]_setAccount['|"], ?['|"](UA-.*?)['|"] ?] ?\)/,/<amp-analytics [^>]*type="gtag"[^>]*>[^<]*<script type="application\/json">[^<]*"gtag_id":\s*"(UA-[^"]+)"/,/<amp-analytics [^>]*type="googleanalytics"[^>]*>[^<]*<script type="application\/json">[^<]*"account":\s*"(UA-[^"]+)"/]},149:function(e,t,n){"use strict";(function(e){var a=n(5),i=n.n(a),r=n(6),o=n.n(r),s=n(7),c=n.n(s),l=n(8),u=n.n(l),d=n(9),g=n.n(d),p=n(1),m=n(2),h=n.n(m),f=n(17),y=n.n(f),v=n(27),k=function(t){function LayoutHeader(){return i()(this,LayoutHeader),c()(this,u()(LayoutHeader).apply(this,arguments))}return g()(LayoutHeader,t),o()(LayoutHeader,[{key:"render",value:function(){var t=this.props,n=t.title,a=t.ctaLabel,i=t.ctaLink;return e.createElement("header",{className:"googlesitekit-layout__header"},e.createElement("div",{className:"mdc-layout-grid"},e.createElement("div",{className:"mdc-layout-grid__inner"},n&&e.createElement("div",{className:y()("mdc-layout-grid__cell","mdc-layout-grid__cell--align-middle","mdc-layout-grid__cell--span-4-phone",{"mdc-layout-grid__cell--span-6-desktop":i,"mdc-layout-grid__cell--span-12-desktop":!i,"mdc-layout-grid__cell--span-8-tablet":!i})},e.createElement("h3",{className:"googlesitekit-subheading-1 googlesitekit-layout__header-title"},n)),i&&e.createElement("div",{className:" mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop mdc-layout-grid__cell--span-4-phone mdc-layout-grid__cell--align-middle mdc-layout-grid__cell--align-right-tablet "},e.createElement(v.a,{href:i,external:!0,inherit:!0},a)))))}}]),LayoutHeader}(p.a);k.propTypes={title:h.a.string,ctaLabel:h.a.string,ctaLink:h.a.string},k.defaultProps={title:"",ctaLabel:"",ctaLink:""},t.a=k}).call(this,n(11))},150:function(e,t,n){"use strict";(function(e){var a=n(5),i=n.n(a),r=n(6),o=n.n(r),s=n(7),c=n.n(s),l=n(8),u=n.n(l),d=n(9),g=n.n(d),p=n(1),m=n(2),h=n.n(m),f=n(79),y=function(t){function LayoutFooter(){return i()(this,LayoutFooter),c()(this,u()(LayoutFooter).apply(this,arguments))}return g()(LayoutFooter,t),o()(LayoutFooter,[{key:"render",value:function(){var t=this.props,n=t.ctaLabel,a=t.ctaLink,i=t.footerContent;return e.createElement("footer",{className:"googlesitekit-layout__footer"},e.createElement("div",{className:"mdc-layout-grid"},e.createElement("div",{className:"mdc-layout-grid__inner"},e.createElement("div",{className:"mdc-layout-grid__cell mdc-layout-grid__cell--span-12"},a&&n&&e.createElement(f.a,{className:"googlesitekit-data-block__source",name:n,href:a,external:!0}),i))))}}]),LayoutFooter}(p.a);y.propTypes={ctaLabel:h.a.string,ctaLink:h.a.string},t.a=y}).call(this,n(11))},161:function(e,t,n){"use strict";(function(e,a){var i=n(3),r=n.n(i),o=n(5),s=n.n(o),c=n(6),l=n.n(c),u=n(7),d=n.n(u),g=n(8),p=n.n(g),m=n(18),h=n.n(m),f=n(9),y=n.n(f),v=n(1),k=n(0),_=n(4),b=n(102),E=n(43),w=n(162),O=n(108),C=function(t){function UserMenu(e){var t;return s()(this,UserMenu),(t=d()(this,p()(UserMenu).call(this,e))).state={dialogActive:!1,menuOpen:!1},t.handleMenu=t.handleMenu.bind(h()(t)),t.handleMenuClose=t.handleMenuClose.bind(h()(t)),t.handleMenuItemSelect=t.handleMenuItemSelect.bind(h()(t)),t.handleDialog=t.handleDialog.bind(h()(t)),t.handleDialogClose=t.handleDialogClose.bind(h()(t)),t.handleUnlinkConfirm=t.handleUnlinkConfirm.bind(h()(t)),t.menuButtonRef=Object(v.h)(),t.menuRef=Object(v.h)(),t}return y()(UserMenu,t),l()(UserMenu,[{key:"componentDidMount",value:function(){e.addEventListener("mouseup",this.handleMenuClose),e.addEventListener("keyup",this.handleMenuClose),e.addEventListener("keyup",this.handleDialogClose)}},{key:"componentWillUnmount",value:function(){e.removeEventListener("mouseup",this.handleMenuClose),e.removeEventListener("keyup",this.handleMenuClose),e.removeEventListener("keyup",this.handleDialogClose)}},{key:"handleMenu",value:function(){var e=this.state.menuOpen;this.setState({menuOpen:!e})}},{key:"handleMenuClose",value:function(e){("keyup"!==e.type||27!==e.keyCode)&&"mouseup"!==e.type||this.menuButtonRef.current.buttonRef.current.contains(e.target)||this.menuRef.current.menuRef.current.contains(e.target)||this.setState({menuOpen:!1})}},{key:"handleMenuItemSelect",value:function(t,n){var a=e._googlesitekitLegacyData.admin.proxyPermissionsURL;if("keydown"===n.type&&(13===n.keyCode||32===n.keyCode)||"click"===n.type)switch(t){case 0:this.handleDialog();break;case 1:e.location.assign(a);break;default:this.handleMenu()}}},{key:"handleDialog",value:function(){this.setState((function(e){return{dialogActive:!e.dialogActive,menuOpen:!1}}))}},{key:"handleDialogClose",value:function(e){27===e.keyCode&&this.setState({dialogActive:!1,menuOpen:!1})}},{key:"handleUnlinkConfirm",value:function(){return r.a.async((function(e){for(;;)switch(e.prev=e.next){case 0:this.setState({dialogActive:!1}),Object(_.d)(),document.location=Object(_.n)("googlesitekit-splash",{googlesitekit_context:"revoked"});case 3:case"end":return e.stop()}}),null,this)}},{key:"render",value:function(){var t=e._googlesitekitLegacyData.admin,n=t.userData,i=n.email,r=void 0===i?"":i,o=n.picture,s=void 0===o?"":o,c=t.proxyPermissionsURL,l=this.state,u=l.dialogActive,d=l.menuOpen;return a.createElement(v.b,null,a.createElement("div",{className:"googlesitekit-dropdown-menu mdc-menu-surface--anchor"},a.createElement(E.a,{ref:this.menuButtonRef,className:"googlesitekit-header__dropdown mdc-button--dropdown",text:!0,onClick:this.handleMenu,icon:s?a.createElement("i",{className:"mdc-button__icon","aria-hidden":"true"},a.createElement("img",{className:"mdc-button__icon--image",src:s,alt:Object(k.__)("User Avatar","google-site-kit")})):void 0,ariaHaspopup:"menu",ariaExpanded:d,ariaControls:"user-menu"},r),a.createElement(w.a,{ref:this.menuRef,menuOpen:d,menuItems:[Object(k.__)("Disconnect","google-site-kit")].concat(c?[Object(k.__)("Manage sites…","google-site-kit")]:[]),onSelected:this.handleMenuItemSelect,id:"user-menu"})),a.createElement(O.a,null,a.createElement(b.a,{dialogActive:u,handleConfirm:this.handleUnlinkConfirm,handleDialog:this.handleDialog,title:Object(k.__)("Disconnect","google-site-kit"),subtitle:Object(k.__)("Disconnecting Site Kit by Google will remove your access to all services. After disconnecting, you will need to re-authorize to restore service.","google-site-kit"),confirmButton:Object(k.__)("Disconnect","google-site-kit"),provides:[],danger:!0})))}}]),UserMenu}(v.a);t.a=C}).call(this,n(16),n(11))},162:function(e,t,n){"use strict";(function(e){var a=n(5),i=n.n(a),r=n(6),o=n.n(r),s=n(7),c=n.n(s),l=n(8),u=n.n(l),d=n(9),g=n.n(d),p=n(1),m=n(2),h=n.n(m),f=n(34),y=function(t){function Menu(e){var t;return i()(this,Menu),(t=c()(this,u()(Menu).call(this,e))).menuRef=Object(p.h)(),t}return g()(Menu,t),o()(Menu,[{key:"componentDidMount",value:function(){var e=this.props.menuOpen;this.menu=new f.f(this.menuRef.current),this.menu.open=e,this.menu.setDefaultFocusState(1)}},{key:"componentDidUpdate",value:function(e){var t=this.props.menuOpen;t!==e.menuOpen&&(this.menu.open=t)}},{key:"render",value:function(){var t=this.props,n=t.menuOpen,a=t.menuItems,i=t.onSelected,r=t.id;return e.createElement("div",{className:"mdc-menu mdc-menu-surface",ref:this.menuRef},e.createElement("ul",{id:r,className:"mdc-list",role:"menu","aria-hidden":!n,"aria-orientation":"vertical",tabIndex:"-1"},a.map((function(t,n){return e.createElement("li",{key:n,className:"mdc-list-item",role:"menuitem",onClick:i.bind(null,n),onKeyDown:i.bind(null,n)},e.createElement("span",{className:"mdc-list-item__text"},t))}))))}}]),Menu}(p.a);y.propTypes={menuOpen:h.a.bool.isRequired,menuItems:h.a.array.isRequired,id:h.a.string.isRequired},t.a=y}).call(this,n(11))},163:function(e,t,n){"use strict";var a=n(5),i=n.n(a),r=n(6),o=n.n(r),s=n(7),c=n.n(s),l=n(8),u=n.n(l),d=n(9),g=n.n(d),p=n(77),m=function(e){function ErrorNotification(){return i()(this,ErrorNotification),c()(this,u()(ErrorNotification).apply(this,arguments))}return g()(ErrorNotification,e),o()(ErrorNotification,[{key:"render",value:function(){return null}}]),ErrorNotification}(n(1).a);t.a=Object(p.a)("googlesitekit.ErrorNotification")(m)},25:function(e,t,n){"use strict";(function(e){var a=n(5),i=n.n(a),r=n(6),o=n.n(r),s=n(7),c=n.n(s),l=n(8),u=n.n(l),d=n(9),g=n.n(d),p=n(1),m=n(2),h=n.n(m),f=n(17),y=n.n(f),v=n(149),k=n(150),_=function(t){function Layout(){return i()(this,Layout),c()(this,u()(Layout).apply(this,arguments))}return g()(Layout,t),o()(Layout,[{key:"render",value:function(){var t=this.props,n=t.header,a=t.footer,i=t.children,r=t.title,o=t.headerCtaLabel,s=t.headerCtaLink,c=t.footerCtaLabel,l=t.footerCtaLink,u=t.footerContent,d=t.className,g=t.fill,p=t.relative;return e.createElement("div",{className:y()("googlesitekit-layout",d,{"googlesitekit-layout--fill":g,"googlesitekit-layout--relative":p})},n&&e.createElement(v.a,{title:r,ctaLabel:o,ctaLink:s}),i,a&&e.createElement(k.a,{ctaLabel:c,ctaLink:l,footerContent:u}))}}]),Layout}(p.a);_.propTypes={header:h.a.bool,footer:h.a.bool,children:h.a.node.isRequired,title:h.a.string,headerCtaLabel:h.a.string,headerCtaLink:h.a.string,footerCtaLabel:h.a.string,footerCtaLink:h.a.string,footerContent:h.a.node,className:h.a.string,fill:h.a.bool,relative:h.a.bool},_.defaultProps={header:!1,footer:!1,title:"",headerCtaLabel:"",headerCtaLink:"",footerCtaLabel:"",footerCtaLink:"",footerContent:null,className:"",fill:!1,relative:!1},t.a=_}).call(this,n(11))},257:function(e,t,n){"use strict";(function(e){var a=n(3),i=n.n(a),r=n(10),o=n.n(r),s=n(5),c=n.n(s),l=n(6),u=n.n(l),d=n(7),g=n.n(d),p=n(8),m=n.n(p),h=n(18),f=n.n(h),y=n(9),v=n.n(y),k=n(1),_=n(2),b=n.n(_),E=n(17),w=n.n(E),O=n(59),C=n(0),x=n(4),L=n(258),j=n(50),S=function(t){function OptIn(e){var t;return c()(this,OptIn),(t=g()(this,m()(OptIn).call(this,e))).state={optIn:Object(j.a)(),error:!1},t.handleOptIn=t.handleOptIn.bind(f()(t)),t}return v()(OptIn,t),u()(OptIn,[{key:"handleOptIn",value:function(e){var t,n;return i.a.async((function(a){for(;;)switch(a.prev=a.next){case 0:if(t=!!e.target.checked,n=Object(x.j)("googlesitekit_tracking_optin"),Object(j.b)(t),!t){a.next=6;break}return a.next=6,i.a.awrap(Object(j.c)("tracking_plugin",this.props.optinAction));case 6:return a.prev=6,a.next=9,i.a.awrap(Object(O.default)({path:"/wp/v2/users/me",method:"POST",data:{meta:o()({},n,t)}}));case 9:this.setState({optIn:t,error:!1}),a.next=15;break;case 12:a.prev=12,a.t0=a.catch(6),this.setState({optIn:!t,error:{errorCode:a.t0.code,errorMsg:a.t0.message}});case 15:case"end":return a.stop()}}),null,this,[[6,12]])}},{key:"render",value:function(){var t=this.state,n=t.optIn,a=t.error,i=this.props,r=i.id,o=i.name,s=i.className,c=Object(C.sprintf)(
/* translators: %s: privacy policy URL */
Object(C.__)('Help us improve the Site Kit plugin by allowing tracking of anonymous usage stats. All data are treated in accordance with <a href="%s" target="_blank" rel="noopener noreferrer">Google Privacy Policy</a>',"google-site-kit"),"https://policies.google.com/privacy");return e.createElement("div",{className:w()("googlesitekit-opt-in",s)},e.createElement(L.a,{id:r,name:o,value:"1",checked:n,onChange:this.handleOptIn},e.createElement("span",{dangerouslySetInnerHTML:Object(x.u)(c,{ALLOWED_TAGS:["a"],ALLOWED_ATTR:["href","target","rel"]})})),a&&e.createElement("div",{className:"googlesitekit-error-text"},a.errorMsg))}}]),OptIn}(k.a);S.propTypes={id:b.a.string,name:b.a.string,className:b.a.string,optinAction:b.a.string},S.defaultProps={id:"googlesitekit-opt-in",name:"optIn"},t.a=S}).call(this,n(11))},258:function(e,t,n){"use strict";(function(e){var a=n(5),i=n.n(a),r=n(6),o=n.n(r),s=n(7),c=n.n(s),l=n(8),u=n.n(l),d=n(9),g=n.n(d),p=n(1),m=n(2),h=n.n(m),f=n(17),y=n.n(f),v=n(34),k=function(t){function Checkbox(e){var t;return i()(this,Checkbox),(t=c()(this,u()(Checkbox).call(this,e))).formFieldRef=Object(p.h)(),t.checkboxRef=Object(p.h)(),t}return g()(Checkbox,t),o()(Checkbox,[{key:"componentDidMount",value:function(){new v.e(this.formFieldRef.current).input=new v.c(this.checkboxRef.current)}},{key:"render",value:function(){var t=this.props,n=t.onChange,a=t.id,i=t.name,r=t.value,o=t.checked,s=t.disabled,c=t.children;return e.createElement("div",{className:"mdc-form-field",ref:this.formFieldRef},e.createElement("div",{className:y()("mdc-checkbox",{"mdc-checkbox--disabled":s}),ref:this.checkboxRef},e.createElement("input",{className:"mdc-checkbox__native-control",type:"checkbox",id:a,name:i,value:r,checked:o,disabled:s,onChange:n}),e.createElement("div",{className:"mdc-checkbox__background"},e.createElement("svg",{className:"mdc-checkbox__checkmark",viewBox:"0 0 24 24"},e.createElement("path",{className:"mdc-checkbox__checkmark-path",fill:"none",d:"M1.73,12.91 8.1,19.28 22.79,4.59"})),e.createElement("div",{className:"mdc-checkbox__mixedmark"}))),e.createElement("label",{htmlFor:a},c))}}]),Checkbox}(p.a);k.propTypes={onChange:h.a.func.isRequired,id:h.a.string.isRequired,name:h.a.string.isRequired,value:h.a.string.isRequired,checked:h.a.bool,disabled:h.a.bool,children:h.a.node.isRequired},k.defaultProps={checked:!1,disabled:!1},t.a=k}).call(this,n(11))},339:function(e,t,n){"use strict";(function(e,a){n.d(t,"a",(function(){return j}));var i=n(47),r=n.n(i),o=n(5),s=n.n(o),c=n(6),l=n.n(c),u=n(7),d=n.n(u),g=n(8),p=n.n(g),m=n(9),h=n.n(m),f=n(3),y=n.n(f),v=n(1),k=n(0),_=n(2),b=n.n(_),E=n(120),w=n(44),O=n(116),C=n(15),x=n(27),L=[function(){var t;return y.a.async((function(n){for(;;)switch(n.prev=n.next){case 0:if(t=e.location.hostname,!["localhost","127.0.0.1"].includes(t)&&!t.match(/\.(example|invalid|localhost|test)$/)){n.next=3;break}throw"invalid_hostname";case 3:case"end":return n.stop()}}))},function(){var e,t,n;return y.a.async((function(a){for(;;)switch(a.prev=a.next){case 0:return a.next=2,y.a.awrap(C.c.set(C.a,"site","setup-tag"));case 2:return e=a.sent,t=e.token,a.next=6,y.a.awrap(Object(O.a)("setup").catch((function(){throw"tag_fetch_failed"})));case 6:if(n=a.sent,t===n){a.next=9;break}throw"setup_token_mismatch";case 9:case"end":return a.stop()}}))}],j=function(t){function CompatibilityChecks(t){var n;s()(this,CompatibilityChecks);var a=e._googlesitekitLegacyData.setup.isSiteKitConnected;return(n=d()(this,p()(CompatibilityChecks).call(this,t))).state={complete:a,error:null,developerPlugin:{}},n}return h()(CompatibilityChecks,t),l()(CompatibilityChecks,[{key:"componentDidMount",value:function(){var e,t,n,a;return y.a.async((function(i){for(;;)switch(i.prev=i.next){case 0:if(!this.state.complete){i.next=2;break}return i.abrupt("return");case 2:i.prev=2,e=0,t=L;case 4:if(!(e<t.length)){i.next=11;break}return n=t[e],i.next=8,y.a.awrap(n());case 8:e++,i.next=4;break;case 11:i.next=19;break;case 13:return i.prev=13,i.t0=i.catch(2),i.next=17,y.a.awrap(C.c.get(C.a,"site","developer-plugin"));case 17:a=i.sent,this.setState({error:i.t0,developerPlugin:a});case 19:this.setState({complete:!0});case 20:case"end":return i.stop()}}),null,this,[[2,13]])}},{key:"helperCTA",value:function(){var e=this.state.developerPlugin,t=e.installed,n=e.active,a=e.installURL,i=e.activateURL,r=e.configureURL;return!t&&a?{labelHTML:Object(k.__)('Install<span class="screen-reader-text"> the helper plugin</span>',"google-site-kit"),href:a,external:!1}:t&&!n&&i?{labelHTML:Object(k.__)('Activate<span class="screen-reader-text"> the helper plugin</span>',"google-site-kit"),href:i,external:!1}:t&&n&&r?{labelHTML:Object(k.__)('Configure<span class="screen-reader-text"> the helper plugin</span>',"google-site-kit"),href:r,external:!1}:{labelHTML:Object(k.__)('Learn how<span class="screen-reader-text"> to install and use the helper plugin</span>',"google-site-kit"),href:"https://sitekit.withgoogle.com/documentation/using-site-kit-on-a-staging-environment/",external:!0}}},{key:"renderError",value:function(e){var t=this.state.developerPlugin.installed,n=this.helperCTA(),i=n.labelHTML,r=n.href,o=n.external;switch(e){case"invalid_hostname":case"tag_fetch_failed":return a.createElement(v.b,null,!t&&Object(k.__)("Looks like this may be a staging environment. If so, you’ll need to install a helper plugin and verify your production site in Search Console.","google-site-kit"),t&&Object(k.__)("Looks like this may be a staging environment and you already have the helper plugin. Before you can use Site Kit, please make sure you’ve provided the necessary credentials in the Authentication section and verified your production site in Search Console.","google-site-kit")," ",a.createElement(x.a,{href:r,dangerouslySetInnerHTML:{__html:i},external:o,inherit:!0}));case"setup_token_mismatch":return Object(k.__)("Looks like you may be using a caching plugin which could interfere with setup. Please deactivate any caching plugins before setting up Site Kit. You may reactivate them once setup has been completed.","google-site-kit")}}},{key:"render",value:function(){var e,t,n=this.state,i=n.complete,o=n.error,s=this.props,c=s.children,l=r()(s,["children"]);return o&&(e=a.createElement(v.b,null,a.createElement("div",{className:"googlesitekit-setup-compat mdc-layout-grid mdc-layout-grid--align-left"},a.createElement("div",{className:"mdc-layout-grid__inner"},a.createElement(E.a,null),a.createElement("div",{className:"googlesitekit-heading-4 mdc-layout-grid__cell--span-11"},Object(k.__)("Your site may not be ready for Site Kit","google-site-kit"))),a.createElement("p",null,this.renderError(o))))),i||(t=a.createElement("div",{style:{alignSelf:"center",marginLeft:"1rem"}},a.createElement("small",null,Object(k.__)("Checking Compatibility…","google-site-kit")),a.createElement(w.a,{small:!0,compress:!0}))),c({restProps:l,complete:i,error:o,inProgressFeedback:t,CTAFeedback:e})}}]),CompatibilityChecks}(v.a);j.propTypes={children:b.a.func.isRequired}}).call(this,n(16),n(11))},340:function(e,t,n){"use strict";(function(e,a){n.d(t,"a",(function(){return x}));var i=n(3),r=n.n(i),o=n(5),s=n.n(o),c=n(6),l=n.n(c),u=n(7),d=n.n(u),g=n(8),p=n.n(g),m=n(18),h=n.n(m),f=n(9),y=n.n(f),v=n(1),k=n(0),_=n(37),b=n(4),E=n(15),w=n(102),O=n(27),C=n(108),x=function(t){function ResetButton(t){var n;s()(this,ResetButton),n=d()(this,p()(ResetButton).call(this,t));var a=e._googlesitekitBaseData.splashURL;return n.state={dialogActive:!1,postResetURL:Object(_.a)(a,{notification:"reset_success"})},n.handleDialog=n.handleDialog.bind(h()(n)),n.handleUnlinkConfirm=n.handleUnlinkConfirm.bind(h()(n)),n.handleCloseModal=n.handleCloseModal.bind(h()(n)),n}return y()(ResetButton,t),l()(ResetButton,[{key:"componentDidMount",value:function(){e.addEventListener("keyup",this.handleCloseModal,!1)}},{key:"componentWillUnmount",value:function(){e.removeEventListener("keyup",this.handleCloseModal)}},{key:"handleUnlinkConfirm",value:function(){return r.a.async((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,r.a.awrap(E.c.set(E.a,"site","reset"));case 2:Object(b.d)(),this.handleDialog(),document.location=this.state.postResetURL;case 5:case"end":return e.stop()}}),null,this)}},{key:"handleCloseModal",value:function(e){27===e.keyCode&&this.setState({dialogActive:!1})}},{key:"handleDialog",value:function(){this.setState((function(e){return{dialogActive:!e.dialogActive}}))}},{key:"render",value:function(){var e=this,t=this.props.children,n=this.state.dialogActive;return a.createElement(v.b,null,a.createElement(O.a,{className:"googlesitekit-reset-button",onClick:function(){return e.setState({dialogActive:!0})},inherit:!0},t||Object(k.__)("Reset Site Kit","google-site-kit")),a.createElement(C.a,null,a.createElement(w.a,{dialogActive:n,handleConfirm:this.handleUnlinkConfirm,handleDialog:this.handleDialog,title:Object(k.__)("Reset Site Kit","google-site-kit"),subtitle:Object(k.__)("Resetting this site will remove access to all services. After disconnecting, you will need to re-authorize your access to restore service.","google-site-kit"),confirmButton:Object(k.__)("Reset","google-site-kit"),provides:[],danger:!0})))}}]),ResetButton}(v.a)}).call(this,n(16),n(11))},443:function(e,t,n){(function(e,n){!function(a){var i=t&&!t.nodeType&&t,r=e&&!e.nodeType&&e,o="object"==typeof n&&n;o.global!==o&&o.window!==o&&o.self!==o||(a=o);var s,c,l=2147483647,u=36,d=1,g=26,p=38,m=700,h=72,f=128,y="-",v=/^xn--/,k=/[^\x20-\x7E]/,_=/[\x2E\u3002\uFF0E\uFF61]/g,b={overflow:"Overflow: input needs wider integers to process","not-basic":"Illegal input >= 0x80 (not a basic code point)","invalid-input":"Invalid input"},E=u-d,w=Math.floor,O=String.fromCharCode;function C(e){throw new RangeError(b[e])}function x(e,t){for(var n=e.length,a=[];n--;)a[n]=t(e[n]);return a}function L(e,t){var n=e.split("@"),a="";return n.length>1&&(a=n[0]+"@",e=n[1]),a+x((e=e.replace(_,".")).split("."),t).join(".")}function j(e){for(var t,n,a=[],i=0,r=e.length;i<r;)(t=e.charCodeAt(i++))>=55296&&t<=56319&&i<r?56320==(64512&(n=e.charCodeAt(i++)))?a.push(((1023&t)<<10)+(1023&n)+65536):(a.push(t),i--):a.push(t);return a}function S(e){return x(e,(function(e){var t="";return e>65535&&(t+=O((e-=65536)>>>10&1023|55296),e=56320|1023&e),t+=O(e)})).join("")}function N(e,t){return e+22+75*(e<26)-((0!=t)<<5)}function M(e,t,n){var a=0;for(e=n?w(e/m):e>>1,e+=w(e/t);e>E*g>>1;a+=u)e=w(e/E);return w(a+(E+1)*e/(e+p))}function R(e){var t,n,a,i,r,o,s,c,p,m,v,k=[],_=e.length,b=0,E=f,O=h;for((n=e.lastIndexOf(y))<0&&(n=0),a=0;a<n;++a)e.charCodeAt(a)>=128&&C("not-basic"),k.push(e.charCodeAt(a));for(i=n>0?n+1:0;i<_;){for(r=b,o=1,s=u;i>=_&&C("invalid-input"),((c=(v=e.charCodeAt(i++))-48<10?v-22:v-65<26?v-65:v-97<26?v-97:u)>=u||c>w((l-b)/o))&&C("overflow"),b+=c*o,!(c<(p=s<=O?d:s>=O+g?g:s-O));s+=u)o>w(l/(m=u-p))&&C("overflow"),o*=m;O=M(b-r,t=k.length+1,0==r),w(b/t)>l-E&&C("overflow"),E+=w(b/t),b%=t,k.splice(b++,0,E)}return S(k)}function A(e){var t,n,a,i,r,o,s,c,p,m,v,k,_,b,E,x=[];for(k=(e=j(e)).length,t=f,n=0,r=h,o=0;o<k;++o)(v=e[o])<128&&x.push(O(v));for(a=i=x.length,i&&x.push(y);a<k;){for(s=l,o=0;o<k;++o)(v=e[o])>=t&&v<s&&(s=v);for(s-t>w((l-n)/(_=a+1))&&C("overflow"),n+=(s-t)*_,t=s,o=0;o<k;++o)if((v=e[o])<t&&++n>l&&C("overflow"),v==t){for(c=n,p=u;!(c<(m=p<=r?d:p>=r+g?g:p-r));p+=u)E=c-m,b=u-m,x.push(O(N(m+E%b,0))),c=w(E/b);x.push(O(N(c,0))),r=M(n,_,a==i),n=0,++a}++n,++t}return x.join("")}if(s={version:"1.4.1",ucs2:{decode:j,encode:S},decode:R,encode:A,toASCII:function(e){return L(e,(function(e){return k.test(e)?"xn--"+A(e):e}))},toUnicode:function(e){return L(e,(function(e){return v.test(e)?R(e.slice(4).toLowerCase()):e}))}},"function"==typeof define&&"object"==typeof define.amd&&define.amd)define("punycode",(function(){return s}));else if(i&&r)if(e.exports==i)r.exports=s;else for(c in s)s.hasOwnProperty(c)&&(i[c]=s[c]);else a.punycode=s}(this)}).call(this,n(245)(e),n(16))},46:function(e,t,n){"use strict";function a(e){return{byContext:function(t){return e.filter((function(e){return e.usageContext.includes(t)}))}}}function i(e){return(parseInt(e)||0)>0}function r(e){return!!e&&e.toString().match(/^GTM-[A-Z0-9]+$/)}n.d(t,"a",(function(){return a})),n.d(t,"b",(function(){return i})),n.d(t,"c",(function(){return r})),n.d(t,"d",(function(){return o}));var o=[/<script[^>]*>[^>]+?www.googletagmanager.com\/gtm[^>]+?['|"](GTM-[0-9A-Z]+)['|"]/,/<script[^>]*src=['|"]https:\/\/www.googletagmanager.com\/gtm\.js\?id=(GTM-[0-9A-Z]+)['|"]/,/<script[^>]*src=['|"]https:\/\/www.googletagmanager.com\/ns.html\?id=(GTM-[0-9A-Z]+)['|"]/,/<amp-analytics [^>]*config=['|"]https:\/\/www.googletagmanager.com\/amp.json\?id=(GTM-[0-9A-Z]+)['|"]/]},634:function(e,t,n){"use strict";n.r(t),function(e,a){var i=n(3),r=n.n(i),o=n(5),s=n.n(o),c=n(6),l=n.n(c),u=n(7),d=n.n(u),g=n(8),p=n.n(g),m=n(9),h=n.n(m),f=n(1),y=n(443),v=n.n(y),k=n(12),_=n(0),b=n(271),E=n(4),w=n(85),O=n(43),C=n(340),x=n(25),L=n(35),j=n(257),S=n(339),N=function(t){function SetupUsingProxy(t){var n;s()(this,SetupUsingProxy),n=d()(this,p()(SetupUsingProxy).call(this,t));var a=e._googlesitekitLegacyData.admin,i=a.proxySetupURL,r=a.siteURL,o=e._googlesitekitLegacyData.setup,c=o.isSiteKitConnected,l=o.isResettable,u=o.errorMessage,g=e._googlesitekitLegacyData.permissions.canSetup;return n.state={canSetup:g,errorMessage:u,isSiteKitConnected:c,isResettable:l,completeSetup:!1,proxySetupURL:i,resetSuccess:"reset_success"===Object(b.a)(location.href,"notification"),context:Object(b.a)(location.href,"googlesitekit_context"),siteHostname:v.a.toUnicode(new URL(r).hostname)},n}return h()(SetupUsingProxy,t),l()(SetupUsingProxy,[{key:"isSetupFinished",value:function(){var e=this.state,t=e.isSiteKitConnected,n=e.completeSetup;return t&&n}},{key:"render",value:function(){if(this.isSetupFinished()){var t=Object(E.n)("googlesitekit-dashboard",{notification:"authentication_success"});Object(k.delay)((function(){e.location.replace(t)}),500,"later")}var n,i,o,s=this.state,c=s.context,l=s.errorMessage,u=s.isResettable,d=s.proxySetupURL,g=s.resetSuccess,p=s.siteHostname,m=u;"revoked"===c?(n=Object(_.sprintf)(
/* translators: %s is the site's hostname. (e.g. example.com) */
Object(_.__)("You revoked access to Site Kit for %s","google-site-kit"),p),i=Object(_.__)('Site Kit will no longer have access to your account. If you’d like to reconnect Site Kit, click "Start Setup" below to generate new credentials.',"google-site-kit"),o=Object(_.__)("Sign in with Google","google-site-kit")):m?(n=Object(_.__)("Sign in with Google to configure Site Kit","google-site-kit"),i=Object(_.__)("To use Site Kit, sign in with your Google account. The Site Kit service will guide you through 3 simple steps to complete the connection and configure the plugin.","google-site-kit"),o=Object(_.__)("Sign in with Google","google-site-kit")):(n=Object(_.__)("Sign in with Google to set up Site Kit","google-site-kit"),i=Object(_.__)("The Site Kit service will guide you through 3 simple setup steps.","google-site-kit"),o=Object(_.__)("Start setup","google-site-kit"));var h=function(t){return r.a.async((function(n){for(;;)switch(n.prev=n.next){case 0:return t.preventDefault(),n.next=3,r.a.awrap(Object(E.y)("plugin_setup","proxy_start_setup_landing_page"));case 3:e.location.assign(d);case 4:case"end":return n.stop()}}))};return a.createElement(f.b,null,a.createElement(w.a,null),l&&a.createElement(L.a,{id:"setup_error",type:"win-error",title:Object(_.__)("Oops! There was a problem during set up. Please try again.","google-site-kit"),description:l,isDismissable:!1}),g&&a.createElement(L.a,{id:"reset_success",title:Object(_.__)("Site Kit by Google was successfully reset.","google-site-kit"),isDismissable:!1}),a.createElement("div",{className:"googlesitekit-wizard"},a.createElement("div",{className:"mdc-layout-grid"},a.createElement("div",{className:"mdc-layout-grid__inner"},a.createElement("div",{className:" mdc-layout-grid__cell mdc-layout-grid__cell--span-12 "},a.createElement(x.a,null,a.createElement("section",{className:"googlesitekit-wizard-progress"},a.createElement("div",{className:"googlesitekit-setup__footer"},a.createElement("div",{className:"mdc-layout-grid"},a.createElement("div",{className:"mdc-layout-grid__inner"},a.createElement("div",{className:" mdc-layout-grid__cell mdc-layout-grid__cell--span-12 "},a.createElement("h1",{className:"googlesitekit-setup__title"},n),a.createElement("p",{className:"googlesitekit-setup__description"},i),a.createElement(S.a,null,(function(e){var t=e.complete,n=e.inProgressFeedback,i=e.CTAFeedback;return a.createElement(f.b,null,i,a.createElement(j.a,{optinAction:"analytics_optin_setup_fallback"}),a.createElement("div",{className:"googlesitekit-start-setup-wrap"},a.createElement(O.a,{className:"googlesitekit-start-setup",href:d,onClick:h,disabled:!t},o),n,u&&a.createElement(C.a,null)))})))))))))))))}}]),SetupUsingProxy}(f.a);t.default=N}.call(this,n(16),n(11))},85:function(e,t,n){"use strict";(function(e,a){var i=n(5),r=n.n(i),o=n(6),s=n.n(o),c=n(7),l=n.n(c),u=n(8),d=n.n(u),g=n(9),p=n.n(g),m=n(1),h=n(135),f=n(161),y=n(163),v=function(t){function Header(){return r()(this,Header),l()(this,d()(Header).apply(this,arguments))}return p()(Header,t),s()(Header,[{key:"render",value:function(){var t=e._googlesitekitLegacyData.setup.isAuthenticated;return a.createElement(m.b,null,a.createElement("header",{className:"googlesitekit-header"},a.createElement("section",{className:"mdc-layout-grid"},a.createElement("div",{className:"mdc-layout-grid__inner"},a.createElement("div",{className:" mdc-layout-grid__cell mdc-layout-grid__cell--align-middle mdc-layout-grid__cell--span-3-phone mdc-layout-grid__cell--span-4-tablet mdc-layout-grid__cell--span-6-desktop "},a.createElement(h.a,null)),a.createElement("div",{className:" mdc-layout-grid__cell mdc-layout-grid__cell--align-middle mdc-layout-grid__cell--align-right-phone mdc-layout-grid__cell--span-1-phone mdc-layout-grid__cell--span-4-tablet mdc-layout-grid__cell--span-6-desktop "},t&&a.createElement(f.a,null))))),a.createElement(y.a,null))}}]),Header}(m.a);t.a=v}).call(this,n(16),n(11))}}]);