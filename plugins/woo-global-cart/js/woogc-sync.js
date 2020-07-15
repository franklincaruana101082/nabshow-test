    
        
    var WooGC_Sync  = {
        
        foundLoggedIn   :   false,
        foundLoggedOut  :   false,
        wc_cookie       :   '',
        
        queryArgs       :   '',

        init    :   function() {
            
            this.reset();
            
            this.login_logout_check();
            this.wc_cookie_seek();
            this.prepare_query_args();
            this.outputImgTags();
            
        },
        
        reset  : function () {
            
            this.foundLoggedIn  =   false;
            this.foundLoggedOut =   false;    
            this.wc_cookie      =   '';
            
            this.queryArgs      =   '';
            
        },
        
        login_logout_check  :   function() {
            
            if (typeof WooGC_Action !== 'undefined') 
                {
                    if(WooGC_Action ==  'login')
                        this.foundLoggedIn  =   true;
                    if(WooGC_Action ==  'logout')
                        this.foundLoggedOut  =   true;
                }  
            
        },
        
        wc_cookie_seek :   function( ) {
            
            //search for cookie
            var CookiesPairs = document.cookie.split(';');
            for(var i = 0; i < CookiesPairs.length; i++) 
                {
                    var name    = CookiesPairs[i].substring(0, CookiesPairs[i].indexOf('='));
                    var value   = CookiesPairs[i].substring(CookiesPairs[i].indexOf('=')+1);
                    
                    name        =   name.trim();
                    value       =   value.trim();
                        
                    if(name.indexOf("wp_woocommerce_session_") > -1)
                        {
                            this.wc_cookie      =   value;
                        }
                }
        
        },
        
        
        prepare_query_args  :   function() {
            
            if(this.wc_cookie  ==  '')
                return;
                 
            if(this.wc_cookie   !=  '')
                {
                    if(this.queryArgs   !=  ''  &&  this.queryArgs.slice(-1) !=  '?')
                        this.queryArgs  +=  '&';
                    
                    this.queryArgs  +=  'wc=' + this.wc_cookie;
                    
                }
            
        },
        
        outputImgTags   :   function() {
        
            var woogc_sync_wrapper  =   document.getElementById('woogc_sync_wrapper');
            
            //clear the existing
            woogc_sync_wrapper.innerHTML    =   '';
               
            for (var key in WooGC_Sites) 
                {
                    var   site_url    =   WooGC_Sites[key] + WooGC_Sync_Url + '/woogc-sync.php';
                    
                    var url_query   =   this.queryArgs;
                    if(this.foundLoggedIn   === true    ||  this.foundLoggedOut === true)
                        {
                                
                            if(this.foundLoggedIn   === true)
                                {
                                    if(url_query.slice(-1) !=  '?')
                                        url_query  +=  '&';
                                        
                                    url_query   +=  'wp=' + WooGC_SSO[key];
                                    
                                }
                            if(this.foundLoggedOut === true)
                                {
                                    
                                    if(url_query.slice(-1) !=  '?')
                                        url_query  +=  '&';
                                        
                                    url_query   +=  'wp=';
                                    
                                }
                        }
                    
                    url_query = url_query.replace(/^&/, '');
                    
                    if (url_query   ==  '')
                        continue;
                        
                    if( this.device_require_bounce()    &&  !   this.bounced() )
                        {
                            this.start_bounce();   
                            return;   
                        }
                    
                    woogc_sync_wrapper.innerHTML = woogc_sync_wrapper.innerHTML + '<img src="' +  site_url + '?' + url_query +'" alt="sync" />';
                }
          
        
        },
        
        
        device_require_bounce : function() {
            
            var     require_bounce = /iPhone|iPod|Safari/.test(navigator.userAgent) && ! /Chrome/.test(navigator.userAgent) && !window.MSStream;
            return  require_bounce;   
            
        },
        
        bounced :   function() {
            
            var required_cookie_val =   this.read_cookie('_woogc_bounced');
            if (required_cookie_val !==  false)
                return true;
                
            return false;
              
        },
        
        start_bounce    :   function () {
            
            var All_Sites   =   '';    
            for (var key in WooGC_Sites) 
                {
                    
                    if( All_Sites != '' )
                        All_Sites   += '&';
                        
                    var   site_url    =   WooGC_Sites[key];
                    All_Sites   += site_url;
                }
            
            //set the cookie with the sites
            document.cookie = "wooGC_sites="+ All_Sites + ";path=/";
            
            //set the return url
            var Return_Url = window.location.href;
            document.cookie = "wooGC_bounced_return="+ Return_Url + "#bounce-completed;path=/";
            
            document.cookie = "wooGC_bouncer_path="+ WooGC_Sync_Url + ";path=/";
            
            
            var parser = document.createElement('a');
            parser.href = Return_Url; 
            
            //call the bouncer
            window.open( '//' + parser.host + WooGC_Sync_Url + '/woogc-ping.php' ,"_self");
                
                
        },
        
        bounce_completed_check    :   function() {
            
            //check if bounce completed
            if(window.location.hash !== ''  &&  window.location.hash.indexOf('bounce-completed') >=  0)
                {
                   this.removeHash ();
                   
                   //clear cookies
                   document.cookie = 'wooGC_sites=;path=/; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
                   document.cookie = 'wooGC_bounced_return=;path=/; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
                   document.cookie = 'wooGC_bouncer_path=;path=/; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
                   
                   document.cookie = "_woogc_bounced=" + this.getRandomInt(1,9999) + ";path=/";

                }    
            
        },
        
        removeHash :    function (){ 
            
            var scrollV, scrollH, loc = window.location;
            if ("pushState" in history)
                history.pushState("", document.title, loc.pathname + loc.search);
            else {
                // Prevent scrolling by storing the page's current scroll offset
                scrollV = document.body.scrollTop;
                scrollH = document.body.scrollLeft;

                loc.hash = "";

                // Restore the scroll offset, should be flicker free
                document.body.scrollTop = scrollV;
                document.body.scrollLeft = scrollH;
            }
        },
        
        getRandomInt    :   function (min, max) {
            
            return Math.floor(Math.random() * (max - min + 1)) + min;
        
        },
        
        read_cookie :   function( cookie_name ) {
            var CookiesPairs = document.cookie.split(';');
            for(var i = 0; i < CookiesPairs.length; i++) 
                {
                    var name    = CookiesPairs[i].substring(0, CookiesPairs[i].indexOf('='));
                    var value   = CookiesPairs[i].substring(CookiesPairs[i].indexOf('=')+1);
                    
                    name        =   name.trim();
                    value       =   value.trim();
                        
                    if(name == cookie_name)
                        {
                            return value;
                        }
                }
                
            return false;   
            
        },
  
    }
    
    
    WooGC_Sync.bounce_completed_check();
    WooGC_Sync.init();

    
    (function() {
        var origOpen = XMLHttpRequest.prototype.send;
        
        XMLHttpRequest.prototype.realSend = XMLHttpRequest.prototype.send; 
        var newSend = function(vData) { 
            
            //console.log("data: " + vData); 
            
            var XMLHttpRequestPostVars =   ( 0 in arguments ) ? arguments[0] : "";
            
            this.addEventListener('load', function( args ) {
                
                var found = false;
                
                if( typeof (this.responseURL) !== "undefined"   &&  this.responseURL.indexOf("?wc-ajax=") !== -1 )
                    found = true;
                    
                if ( found === false && WooGC_on_PostVars.length    >   0 ) 
                    {
                        for (var i = 0; i < WooGC_on_PostVars.length; i++) 
                            {
                                if( XMLHttpRequestPostVars.indexOf( WooGC_on_PostVars[i] ) !== -1 )
                                    {
                                        found = true;
                                        break;
                                    }
                            }   
                    }
                
                if ( found   === true )
                    WooGC_Sync.init();    
                
            });
            
            
            this.realSend(vData); 
        };
        XMLHttpRequest.prototype.send = newSend;
        
        
    })();

    
    
    
    
    