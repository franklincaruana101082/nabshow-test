(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    const {__} = wpI18n;
    const { Fragment } = wpElement;
    const { registerBlockType } = wpBlocks;
    const { InspectorControls } = wpEditor;
    const { ServerSideRender, ToggleControl, PanelBody, PanelRow } = wpComponents;

    const filterIcon1 = (
        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="377.426px" height="90.333px" viewBox="0 0 377.426 90.333" enable-background="new 0 0 377.426 90.333" space="preserve">
            <rect x="0.832" y="8.833" fill="#FFFFFF" stroke="#000000" stroke-miterlimit="10" width="118.093" height="21"/>
            <rect x="0.5" y="68.833" fill="#FFFFFF" stroke="#000000" stroke-miterlimit="10" width="199.332" height="21"/>
            <g id="layer1" transform="translate(0,-552.36216)" label="Layer 1" groupmode="layer">
                <g id="g1400" transform="translate(-4.3609793,-7.6704785)">
                    <path id="path4714" connector-curvature="0" fill="#2B1010" d="M187.443,633.866c-2.295,0-4.156,1.861-4.156,4.158
                        s1.861,4.158,4.156,4.158c2.297,0,4.158-1.861,4.158-4.158S189.74,633.866,187.443,633.866z M187.443,634.589
                        c1.938,0,3.51,1.538,3.51,3.436l0,0c0,1.896-1.572,3.436-3.51,3.436l0,0c-1.936,0-3.508-1.539-3.508-3.436
                        C183.935,636.127,185.507,634.589,187.443,634.589z"/>
                    <path id="rect4721" fill="#2B1010" d="M190.525,641.048l1.877,2.178c0.324,0.375,0.455,0.854,0.291,1.067l0,0
                        c-0.164,0.214-0.559,0.084-0.883-0.292l-1.879-2.178c-0.322-0.375-0.453-0.853-0.289-1.066l0,0
                        C189.806,640.542,190.201,640.673,190.525,641.048z"/>
                </g>
            </g>
            <line fill="none" stroke="#000000" stroke-width="2" stroke-miterlimit="10" x1="0.5" y1="62.667" x2="39.5" y2="62.667"/>
            <line fill="none" stroke="#000000" stroke-width="2" stroke-miterlimit="10" x1="1.5" y1="1" x2="40.5" y2="1"/>
            <g>
                <g id="expand-more">
                    <polygon fill="#010101" points="112.104,16.989 108.521,20.572 104.937,16.989 103.846,18.08 108.521,22.754 113.195,18.08 		"/>
                </g>
            </g>
            <rect x="258.832" y="8.833" fill="#FFFFFF" stroke="#000000" stroke-miterlimit="10" width="118.094" height="21"/>
            <line fill="none" stroke="#000000" stroke-width="2" stroke-miterlimit="10" x1="259.5" y1="2" x2="298.5" y2="2"/>
            <g>
                <g id="expand-more_1_">
                    <polygon fill="#010101" points="370.104,16.989 366.521,20.572 362.938,16.989 361.846,18.08 366.521,22.754 371.195,18.08 		"/>
                </g>
            </g>
            <rect x="130.166" y="8.906" fill="#FFFFFF" stroke="#000000" stroke-miterlimit="10" width="118.094" height="21"/>
            <line fill="none" stroke="#000000" stroke-width="2" stroke-miterlimit="10" x1="130.834" y1="2.072" x2="169.834" y2="2.072"/>
            <g>
                <g id="expand-more_2_">
                    <polygon fill="#010101" points="241.438,17.061 237.854,20.645 234.271,17.061 233.18,18.152 237.854,22.826 242.529,18.152 		"/>
                </g>
            </g>
            <line fill="none" stroke="#000000" stroke-miterlimit="10" x1="135.166" y1="19.333" x2="197.166" y2="19.333"/>
            <line fill="none" stroke="#000000" stroke-miterlimit="10" x1="263.833" y1="18.872" x2="326.498" y2="18.872"/>
            <line fill="none" stroke="#000000" stroke-miterlimit="10" x1="6.499" y1="19.061" x2="67.832" y2="19.061"/>
            <line fill="none" stroke="#000000" stroke-miterlimit="10" x1="6.499" y1="79.333" x2="118.925" y2="79.333"/>
       </svg>
    );

    const filterIcon2 = (
        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="345px" height="29.667px" viewBox="0 0 345 29.667" enable-background="new 0 0 345 29.667" space="preserve">
        <rect x="0.5" y="8.167" fill="#FFFFFF" stroke="#000000" stroke-miterlimit="10" width="66" height="21"/>
        <line fill="none" stroke="#000000" stroke-miterlimit="10" x1="14.167" y1="18.667" x2="53.167" y2="18.667"/>
        <rect x="165.167" y="8.167" fill="#FFFFFF" stroke="#000000" stroke-miterlimit="10" width="179.333" height="21"/>
        <rect x="77.5" y="8.167" fill="#FFFFFF" stroke="#000000" stroke-miterlimit="10" width="66" height="21"/>
        <line fill="none" stroke="#000000" stroke-miterlimit="10" x1="91.167" y1="18.667" x2="130.167" y2="18.667"/>
        <g id="layer1" transform="translate(0,-552.36216)" label="Layer 1" groupmode="layer">
            <g id="g1400" transform="translate(-4.3609793,-7.6704785)">
                <path id="path4714" connector-curvature="0" fill="#2B1010" d="M334.111,573.199c-2.295,0-4.156,1.861-4.156,4.158
                    s1.861,4.158,4.156,4.158c2.297,0,4.158-1.861,4.158-4.158S336.408,573.199,334.111,573.199z M334.111,573.922
                    c1.938,0,3.51,1.538,3.51,3.436l0,0c0,1.896-1.572,3.436-3.51,3.436l0,0c-1.936,0-3.508-1.539-3.508-3.436
                    C330.603,575.46,332.175,573.922,334.111,573.922z"/>
                <path id="rect4721" fill="#2B1010" d="M337.193,580.381l1.877,2.178c0.324,0.375,0.455,0.854,0.291,1.067l0,0
                    c-0.164,0.214-0.559,0.084-0.883-0.292l-1.879-2.178c-0.322-0.375-0.453-0.853-0.289-1.066l0,0
                    C336.474,579.875,336.869,580.006,337.193,580.381z"/>
            </g>
        </g>
        <line fill="none" stroke="#000000" stroke-width="2" stroke-miterlimit="10" x1="165.167" y1="1" x2="204.168" y2="1"/>
        <line fill="none" stroke="#000000" stroke-miterlimit="10" x1="172.167" y1="19.325" x2="275.168" y2="19.325"/>
       </svg>
    );


    const relatedContentWithBlockIcon = (
        <svg width="150px" height="150px" viewBox="181 181 150 150" enable-background="new 181 181 150 150">
            <path fill="#0F6CB6" d="M188.344,242.002c0,1.285,1.045,2.333,2.333,2.333h60.657c1.288,0,2.333-1.048,2.333-2.333v-34.995h-65.323
                V242.002z M193.01,211.674h32.661v9.332h23.33v18.664H216.34v-9.332h-23.33V211.674z"/>
            <path fill="#0F6CB6" d="M251.334,188.344h-60.657c-1.288,0-2.333,1.047-2.333,2.333v11.665h65.323v-11.665
                C253.667,189.392,252.622,188.344,251.334,188.344z M197.676,197.676h-4.666v-4.666h4.666V197.676z M207.008,197.676h-4.666v-4.666
                h4.666V197.676z M216.34,197.676h-4.666v-4.666h4.666V197.676z"/>
            <path fill="#0F6CB6" d="M216.34,221.006h4.666v-4.666h-23.33v9.332h18.664V221.006z"/>
            <path fill="#0F6CB6" d="M221.006,225.671h23.33v9.332h-23.33V225.671z"/>
            <path fill="#0F6CB6" d="M197.676,295.66h23.33v9.332h-23.33V295.66z"/>
            <path fill="#0F6CB6" d="M221.006,314.324h23.33v-9.332h-18.664v4.666h-4.666V314.324z"/>
            <path fill="#0F6CB6" d="M251.334,267.665h-60.657c-1.288,0-2.333,1.047-2.333,2.333v11.664h65.323v-11.664
                C253.667,268.712,252.622,267.665,251.334,267.665z M197.676,276.997h-4.666v-4.666h4.666V276.997z M207.008,276.997h-4.666v-4.666
                h4.666V276.997z M216.34,276.997h-4.666v-4.666h4.666V276.997z"/>
            <path fill="#0F6CB6" d="M188.344,321.323c0,1.285,1.045,2.333,2.333,2.333h60.657c1.288,0,2.333-1.048,2.333-2.333v-34.995h-65.323
                V321.323z M193.01,290.994h32.661v9.332h23.33v18.664H216.34v-9.332h-23.33V290.994z"/>
            <path fill="#0F6CB6" d="M305.911,296.507l-11.734,11.735c-2.42,2.419-5.632,3.749-9.05,3.749c-7.055,0-12.796-5.739-12.796-12.797
                c0-3.417,1.329-6.632,3.746-9.046l11.735-11.735c2.419-2.42,5.632-3.749,9.049-3.749h1.899l3.828,2.827
                c1.418,1.228,3.047,1.838,4.736,1.838c1.554,0,2.977-0.527,4.141-1.386c-3.208-4.927-8.642-7.945-14.604-7.945
                c-4.663,0-9.049,1.817-12.348,5.113l-11.732,11.732c-3.301,3.299-5.116,7.686-5.116,12.351c0,9.629,7.834,17.463,17.462,17.463
                c4.663,0,9.049-1.817,12.349-5.114l11.731-11.732c2.089-2.088,3.577-4.651,4.394-7.442c-1.703,0.534-3.502,0.833-5.359,0.915
                C307.636,294.468,306.849,295.569,305.911,296.507L305.911,296.507z"/>
            <path fill="#0F6CB6" d="M307.325,242.002c-9.003,0-16.331,7.325-16.331,16.331v7.804c1.512-0.412,3.072-0.66,4.666-0.746v-7.058
                c0-6.432,5.232-11.665,11.665-11.665c6.432,0,11.665,5.233,11.665,11.665v13.998c0,6.432-5.233,11.664-11.665,11.664
                c-2.813,0-5.534-1.02-7.657-2.869l-2.44-1.797h-0.366c-1.339,0-2.61,0.357-3.761,0.962c2.865,5.125,8.252,8.37,14.225,8.37
                c9.003,0,16.33-7.325,16.33-16.33v-9.332v-4.666C323.655,249.328,316.328,242.002,307.325,242.002L307.325,242.002z"/>
            <path fill="#0F6CB6" d="M316.657,218.673h-34.995v-6.999l-12.441,9.332l12.441,9.332v-6.999h32.662c2.572,0,4.666,2.093,4.666,4.666
                v12.883c1.764,1.183,3.333,2.629,4.666,4.279v-19.495C323.656,221.813,320.516,218.673,316.657,218.673z"/>
        </svg>
    );

    const allAttr = {
        pageId: {
            type: 'number'
        },
        showFilter: {
            type: 'boolean',
            default: false
        },
        filterType: {
            type: 'string',
            default: 'opportunities'
        }
    };

    registerBlockType('nab/related-content-with-block', {
        title: __('Related Content with Block'),
        icon: { src: relatedContentWithBlockIcon },
        category: 'nabshow',
        keywords: [__('related'), __('content'), __('block')],
        attributes: allAttr,
        edit({ attributes, setAttributes }) {
            const { pageId, showFilter, filterType } = attributes;
            if ( ! pageId ) {
                setAttributes( { pageId: wp.data.select('core/editor').getCurrentPostId() });
            }
            return (
                <Fragment>
                    <InspectorControls>
                        <PanelBody title={__('Filter Settings')}>
                            <ToggleControl
                                label={__('Show Filter')}
                                checked={showFilter}
                                onChange={() => setAttributes({ showFilter: ! showFilter }) }
                            />
                            { showFilter &&
                            <div>
                                <label>{__('Select Listing Layout')}</label>
                                <PanelRow>
                                    <ul className="ss-off-options related-off grid-full">
                                        <li className={'opportunities' === filterType ? 'active opportunities' : 'opportunities'} onClick={() => setAttributes({ filterType: 'opportunities' })}>{filterIcon1}</li>
                            <li className={'resources' === filterType ? 'active resources' : 'resources'} onClick={() => setAttributes({ filterType: 'resources' })}>{filterIcon2}</li>
                                    </ul>
                                </PanelRow>
                            </div>
                            }
                        </PanelBody>
                    </InspectorControls>
                    <ServerSideRender
                        block="nab/related-content-with-block"
                        attributes={ { pageId: pageId,  showFilter: showFilter, filterType: filterType } }
                    />
                </Fragment>
            );
        },
        save() {
            return null;
        },
    });

})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);