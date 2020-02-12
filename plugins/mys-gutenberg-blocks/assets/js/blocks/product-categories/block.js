import { exhibitorAccordion, exhibitorImageListing, exhibitorParentImageListing } from '../icons';
(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    const { __ } = wpI18n;
    const { Fragment } = wpElement;
    const { registerBlockType } = wpBlocks;
    const { InspectorControls } = wpEditor;
    const { PanelBody, RangeControl, ToggleControl, ServerSideRender } = wpComponents;

    const allAttr = {
        itemToFetch: {
            type: 'number',
            default: 10
        },
        layoutType: {
            type: 'string',
            default: 'listing'
        },
        showFilter: {
            type: 'boolean',
            default: false
        }
    };

    const prodCatBlockIcon = (
        <svg width="150px" height="150px" viewBox="0 0 150 150" enable-background="new 0 0 150 150">
            <g>
                <g>
                    <path fill="#92c83e" d="M146.221,54.552l-7.549-6.523c-0.936-0.81-2.352-0.706-3.161,0.231c-0.81,0.937-0.706,2.352,0.23,3.162
                        l7.548,6.523c2.69,2.326,2.988,6.406,0.662,9.097l-49.027,56.729c-0.809,0.937-0.706,2.353,0.23,3.162
                        c0.424,0.366,0.945,0.546,1.465,0.546c0.629,0,1.254-0.264,1.697-0.775l49.027-56.73
                        C151.285,65.412,150.781,58.494,146.221,54.552z"/>
                </g>
            </g>
            <g>
                <g>
                    <path fill="#92c83e" d="M132.932,43.067L98.015,12.891c-2.21-1.91-5.03-2.843-7.942-2.632c-2.913,0.212-5.568,1.546-7.479,3.755
                        l-3.326,3.85c-0.811,0.937-0.707,2.353,0.23,3.162c0.937,0.81,2.352,0.707,3.161-0.23l3.327-3.85
                        c1.127-1.303,2.693-2.09,4.411-2.215c1.718-0.126,3.382,0.426,4.686,1.553L130,46.459c0.424,0.366,0.945,0.545,1.465,0.545
                        c0.629,0,1.254-0.263,1.697-0.775C133.971,45.292,133.869,43.877,132.932,43.067z"/>
                </g>
            </g>
            <g>
                <g>
                    <path fill="#92c83e" d="M111.65,35.142L51.244,14.881c-5.716-1.917-11.925,1.173-13.842,6.889l-0.797,2.376
                        c-0.394,1.173,0.239,2.444,1.413,2.838c1.174,0.394,2.444-0.238,2.838-1.413l0.797-2.375c1.131-3.372,4.793-5.195,8.166-4.064
                        l60.407,20.261c3.372,1.131,5.195,4.794,4.064,8.166l-28.105,83.795c-0.395,1.174,0.238,2.444,1.412,2.839
                        c0.236,0.078,0.477,0.116,0.713,0.116c0.938,0,1.811-0.592,2.125-1.529l28.105-83.794
                        C120.456,43.269,117.365,37.059,111.65,35.142z"/>
                </g>
            </g>
            <g>
                <g>
                    <path fill="#92c83e" d="M74.647,29.522H10.933C4.905,29.522,0,34.426,0,40.455v88.383c0,6.027,4.905,10.933,10.933,10.933h63.714
                        c6.028,0,10.933-4.905,10.933-10.933V40.455C85.58,34.426,80.676,29.522,74.647,29.522z M81.096,128.838
                        c0,3.556-2.893,6.449-6.449,6.449H10.933c-3.557,0-6.45-2.894-6.45-6.449V40.455c0-3.557,2.894-6.45,6.45-6.45h63.714
                        c3.556,0,6.449,2.894,6.449,6.45L81.096,128.838L81.096,128.838z"/>
                </g>
            </g>
            <g>
                <g>
                    <path fill="#92c83e" d="M75.814,91.395H9.767c-1.238,0-2.242,1.004-2.242,2.242s1.004,2.241,2.242,2.241h66.048
                        c1.238,0,2.242-1.003,2.242-2.241C78.056,92.398,77.052,91.395,75.814,91.395z"/>
                </g>
            </g>
            <g>
                <g>
                    <path fill="#92c83e" d="M65.363,104.215h-27.76c-1.238,0-2.242,1.003-2.242,2.241s1.004,2.241,2.242,2.241h27.76
                        c1.238,0,2.242-1.003,2.242-2.241S66.601,104.215,65.363,104.215z"/>
                </g>
            </g>
            <g>
                <g>
                    <path fill="#92c83e" d="M30.13,104.215h-9.914c-1.238,0-2.242,1.003-2.242,2.241s1.004,2.241,2.242,2.241h9.914
                        c1.238,0,2.242-1.003,2.242-2.241S31.369,104.215,30.13,104.215z"/>
                </g>
            </g>
            <g>
                <g>
                    <path fill="#92c83e" d="M65.363,112.783H20.217c-1.238,0-2.242,1.004-2.242,2.242s1.004,2.242,2.242,2.242h45.146
                        c1.238,0,2.242-1.004,2.242-2.242S66.601,112.783,65.363,112.783z"/>
                </g>
            </g>
            <g>
                <g>
                    <path fill="#92c83e" d="M65.363,121.354H20.217c-1.238,0-2.242,1.004-2.242,2.242c0,1.237,1.004,2.241,2.242,2.241h45.146
                        c1.238,0,2.242-1.004,2.242-2.241C67.605,122.357,66.601,121.354,65.363,121.354z"/>
                </g>
            </g>
            <g>
                <g>
                    <path fill="#92c83e" d="M67.429,55.533c-0.264-0.812-0.965-1.403-1.81-1.525l-14.386-2.09L44.8,38.881
                        c-0.378-0.765-1.157-1.25-2.01-1.25c-0.854,0-1.633,0.485-2.011,1.25l-6.434,13.036l-14.385,2.09
                        c-0.845,0.123-1.546,0.714-1.81,1.525c-0.264,0.812-0.043,1.702,0.567,2.298l10.41,10.146L26.67,82.305
                        c-0.144,0.842,0.202,1.691,0.892,2.193c0.391,0.283,0.854,0.428,1.318,0.428c0.356,0,0.715-0.086,1.043-0.258l12.867-6.765
                        l12.867,6.765c0.755,0.397,1.67,0.331,2.361-0.17c0.69-0.502,1.036-1.352,0.892-2.193l-2.458-14.328l10.41-10.146
                        C67.472,57.235,67.692,56.344,67.429,55.533z M52.479,65.589c-0.528,0.515-0.77,1.257-0.645,1.984l1.889,11.012l-9.89-5.199
                        c-0.653-0.343-1.434-0.343-2.086,0l-9.89,5.199l1.889-11.012c0.125-0.727-0.116-1.469-0.645-1.984l-8-7.799l11.057-1.607
                        c0.73-0.106,1.361-0.564,1.688-1.226l4.945-10.02l4.945,10.02c0.326,0.662,0.958,1.12,1.688,1.226l11.058,1.607L52.479,65.589z"/>
                </g>
            </g>
        </svg>
    );

    registerBlockType('mys/product-categories', {
        title: __('Product Categories'),
        icon: { src: prodCatBlockIcon},
        category: 'mysgb',
        keywords: [__('product'), __('categories')],
        attributes: allAttr,
        edit(props) {
            const { attributes: { itemToFetch, layoutType, showFilter }, setAttributes } = props;
            return (
                <Fragment>
                    <InspectorControls>
                        <PanelBody title={__('Data Settings')}>
                            <div className="inspector-field inspector-field-Numberofitems ">
                                <label className="inspector-mb-0">Number of items</label>
                                <RangeControl
                                    value={itemToFetch}
                                    min={1}
                                    max={100}
                                    onChange={(item) => setAttributes({ itemToFetch: parseInt(item) })}
                                />
                            </div>
                            <label>Layout Types</label>
                            <ul className="quote-options">
                                <li onClick={() => { setAttributes({ layoutType: 'listing' }); }} className={'listing' === layoutType ? 'active' : ''}  >{exhibitorImageListing}</li>
                                <li onClick={() => { setAttributes({ layoutType: 'accordion-list', showFilter: false }); }} className={'accordion-list' === layoutType ? 'active' : ''}  >{exhibitorAccordion}</li>
                                <li onClick={() => { setAttributes({ layoutType: 'parent-img-list', showFilter: false }); }} className={'parent-img-list' === layoutType ? 'active' : ''}  >{exhibitorParentImageListing}</li>
                            </ul>

                            { 'listing' === layoutType &&
                            <ToggleControl
                                label={__('Show Filter')}
                                checked={showFilter}
                                onChange={() => setAttributes({ showFilter: ! showFilter }) }
                            />
                            }
                        </PanelBody>
                    </InspectorControls>
                    <ServerSideRender
                        block="mys/product-categories"
                        attributes={{
                            itemToFetch: itemToFetch,
                            layoutType: layoutType,
                            showFilter: showFilter
                        }}
                    />
                </Fragment>
            );
        },
        save() {
            return null;
        },
    });

})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);
