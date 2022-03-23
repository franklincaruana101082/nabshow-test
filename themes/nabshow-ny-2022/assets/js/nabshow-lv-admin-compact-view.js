jQuery(document).ready(function($) {

    var sep = " | ";
    var nabTaxonomy = nabshowCompactView.nabTaxonomy;

    var expandAllLink   = document.createElement('a');
    expandAllLink.setAttribute('class', 'nab-expand-all');
    expandAllLink.setAttribute('href', 'javascript:void(0);');
    expandAllLink.innerText = nabshowCompactView.expandText;

    var collapseAllLink   = document.createElement('a');
    collapseAllLink.setAttribute('class', 'nab-collapse-all');
    collapseAllLink.setAttribute('href', 'javascript:void(0);');
    collapseAllLink.innerText = nabshowCompactView.collapseText;

    /*
     * Add Expand/Collapse ALL Links to DOM (has to be first for listeners)
     */
    if ( 0 < jQuery('.nab-expand-collapse .subsubsub').length ) {

        var listExpandLink = document.createElement('li');
        listExpandLink.innerText = sep;
        listExpandLink.setAttribute('class', 'expand_all_link');
        listExpandLink.appendChild(expandAllLink);

        var listCollapseLink = document.createElement('li');
        listCollapseLink.innerText = sep;
        listCollapseLink.setAttribute('class', 'collapse_all_link');
        listCollapseLink.appendChild(collapseAllLink);

        document.getElementsByClassName('subsubsub')[0].appendChild(listExpandLink);
        document.getElementsByClassName('subsubsub')[0].appendChild(listCollapseLink);
    }

    if ( '' !== nabTaxonomy && 0 < jQuery('.nab-expand-collapse.taxonomy-' + nabTaxonomy +' .actions').length ) {

        var linkSep = document.createElement('span');
        linkSep.innerText = sep;

        document.getElementsByClassName('actions')[0].appendChild(expandAllLink);
        document.getElementsByClassName('actions')[0].appendChild(linkSep);
        document.getElementsByClassName('actions')[0].appendChild(collapseAllLink);
    }

    /*
     * Initial loading
     */
    var nabStorage;
    nab_get_local_storage();
    initial_collapse_work();
    reset_listeners();

    function nab_get_local_storage() {
        nabStorage = JSON.parse(localStorage.getItem('nabstorage'));
        if(nabStorage) {
            nabStorage = JSON.parse(localStorage.getItem('nabstorage'));
            nabStorage.pid = nabStorage.pid || [];
            nabStorage.cid = nabStorage.cid || [];
        } else {
            nabStorage = {};
            nabStorage.pid = [];
            nabStorage.cid = [];
        }
    }
    /*
     * Does all initial stuff (adding plus/minus buttons, adding top links, perform initial collapse)
     */
    function initial_collapse_work() {

        /*
         * Loop through to add parent and post-id data
         */

        jQuery('.pages #the-list tr').each(function() {

            var parent = jQuery(this).find('.post_parent').html();
            var id = jQuery(this).find('[name="post[]"]').attr('value');

            jQuery(this).attr('data-parent', parent);
            jQuery(this).attr('data-nab-id', id);
            jQuery(this).attr('data-collapsed', 0);

        });

        jQuery('.nab-expand-collapse .tags #the-list tr').each(function() {

            var parent = jQuery(this).find('.parent').html();
            var id = jQuery(this).find('.check-column input').attr('value');

            jQuery(this).attr('data-parent', parent);
            jQuery(this).attr('data-nab-id', id);
            jQuery(this).attr('data-collapsed', 0);

        });

        /*
         * Loop through again to add +/- as needed
         */
        jQuery('.pages #the-list tr').each(function() {

            var id = jQuery(this).find('[name="post[]"]').attr('value');

            if (jQuery('#the-list').find('[data-parent="' + id + '"]').length > 0)
                jQuery(this).find('.page-title strong').append('<span class="expand_link"><a href="javascript:void(0);" class="minus"></a></span>');
        });

        jQuery('.nab-expand-collapse .tags #the-list tr').each(function() {

            var id = jQuery(this).find('.check-column input').attr('value');
            if (jQuery('#the-list').find('[data-parent="' + id + '"]').length > 0) {
                jQuery(this).find('.name strong').append('<span class="expand_link"><a href="javascript:void(0);" class="minus"></a></span>');
            }

        });

        /*
         * Collapse from cookie to start with
         */
        collapse_from_cookie(jQuery('.nab-expand-collapse .tags').length);


    }

    function reset_listeners() {

        /*
         * Called on click, expands and contracts pages by calling functions below
         */
        jQuery('.expand_link').click(function() {
            nab_get_local_storage();
            var row = jQuery(this).closest('tr');
            var nab_id = row.attr('data-nab-id');
            jQuery(this).children('a').toggleClass('minus');

            if (row.attr('data-collapsed') == 0) {
                if(jQuery('.nab-expand-collapse .tags').length) {
                    if(nabStorage.cid) {
                        nabStorage.cid.push(nab_id);
                    }
                } else{
                    if(nabStorage.pid) {
                        nabStorage.pid.push(nab_id);
                    }
                }
                localStorage.setItem("nabstorage",JSON.stringify(nabStorage));
                collapse_subpages(nab_id);
                row.attr('data-collapsed', 1);
            } else {
                if(jQuery('.nab-expand-collapse .tags').length) {
                    nabStorage.cid = nabStorage.cid.filter(function(e,i){
                        return e != nab_id;
                    });
                } else {
                    nabStorage.pid = nabStorage.pid.filter(function(e,i){
                        return e != nab_id;
                    });
                }
                localStorage.setItem("nabstorage",JSON.stringify(nabStorage));
                expand_subpages(nab_id);
                row.attr('data-collapsed', 0);
            }
        });

        /*
         * Called on click when "Quick Update" is used
         */
        jQuery('.inline-edit-save .save').click(function() {

            /*
             * delay before reset, allows WordPress to finish reseting rows
             * (not ideal, but the "Quick Edit" is a little wonky to begin with)
             */
            setTimeout(function() {

                jQuery('#the-list tr').show();
                jQuery('.expand_link').remove();

                //redo collapses
                initial_collapse_work();
                reset_listeners();

            }, 1000);

        });

        /*
         * Expand and collapse all links
         */
        jQuery('.expand_all_link a').click(function() {
            expand_all();
        });
        jQuery('.nab-expand-all').click(function() {
            expand_all();
        });
        jQuery('.collapse_all_link a').click(function() {
            collapse_all();
        });
        jQuery('.nab-collapse-all').click(function() {
            collapse_all();
        });
    }

    function collapse_all() {
        var ids = [];
        nab_get_local_storage();
        jQuery('.pages #the-list tr').each(function() {
            var nab_id = jQuery(this).attr('data-nab-id');
            if (jQuery(this).attr('data-collapsed') == 0) {
                ids.push(nab_id);
                nabStorage.pid.push(nab_id);
                collapse_subpages(nab_id);
                jQuery(this).attr('data-collapsed', 1).find('.expand_link a').toggleClass('minus');
            }
        });
        jQuery('.nab-expand-collapse .tags #the-list tr').each(function() {
            var nab_id = jQuery(this).attr('data-nab-id');
            if (jQuery(this).attr('data-collapsed') == 0) {
                ids.push(nab_id);
                nabStorage.cid.push(nab_id);
                collapse_subpages(nab_id);
                jQuery(this).attr('data-collapsed', 1).find('.expand_link a').toggleClass('minus');
            }
        });

        localStorage.setItem('nabstorage',JSON.stringify(nabStorage));
    }

    function expand_all() {
        var ids = [];
        nab_get_local_storage();
        jQuery('.pages #the-list tr').each(function() {
            var nab_id = jQuery(this).attr('data-nab-id');
            if (jQuery(this).attr('data-collapsed') == 1) {
                ids.push(nab_id);
                expand_subpages(nab_id);
                jQuery(this).attr('data-collapsed', 0).find('.expand_link a').toggleClass('minus');
            }
        });

        jQuery('.nab-expand-collapse .tags #the-list tr').each(function() {
            var nab_id = jQuery(this).attr('data-nab-id');
            if (jQuery(this).attr('data-collapsed') == 1) {
                ids.push(nab_id);
                expand_subpages(nab_id);
                jQuery(this).attr('data-collapsed', 0).find('.expand_link a').toggleClass('minus');
            }
        });
        ids.forEach(function(val){
            nabStorage.cid = nabStorage.cid.filter(function(e,i){
                return e != val;
            })
        });
        ids.forEach(function(val){
            nabStorage.pid = nabStorage.pid.filter(function(e,i){
                return e != val;
            })
        });
        localStorage.setItem('nabstorage',JSON.stringify(nabStorage));
    }

    /*
     * Two recursive functions that show/hide the table rows
     */
    function collapse_subpages(parent_id) {
        jQuery('#the-list').find('[data-parent="' + parent_id + '"]').each(function() {

            jQuery(this).hide();

            collapse_subpages(jQuery(this).attr('data-nab-id'));
        });
    }

    function expand_subpages(parent_id) {
        jQuery('#the-list').find('[data-parent="' + parent_id + '"]').each(function() {

            jQuery(this).show();

            //does not unhide rows if group was previously hidden
            if (jQuery(this).attr('data-collapsed') == 0)
                expand_subpages(jQuery(this).attr('data-nab-id'));
        });
    }

    /*
     * Read localStorage and expand pages as needed
     */
    function collapse_from_cookie(cat) {
        var nabLocal = JSON.parse(localStorage.getItem("nabstorage"));
        if(nabLocal) {
            var ids;
            if(cat){
                ids = nabLocal.cid;
            } else {
                ids = nabLocal.pid;
            }
            jQuery.each(ids, function(i,v){
                jQuery('#the-list').find('[data-nab-id="' + v + '"]').attr('data-collapsed', 1).find('.expand_link a').toggleClass('minus');
            });
            jQuery.each(ids, function(index, value) {
                collapse_subpages(value);
            });
        }
    }

});
