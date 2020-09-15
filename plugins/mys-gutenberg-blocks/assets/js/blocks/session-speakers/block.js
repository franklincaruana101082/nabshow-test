(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    const {__} = wpI18n;
    const { Fragment } = wpElement;
    const { registerBlockType } = wpBlocks;
    const { InspectorControls } = wpEditor;
    const { PanelBody, ServerSideRender, RangeControl, TextControl } = wpComponents;

    const sessionSpeakerList = (
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
        itemToFetch: {
            type: 'number',
            default: 10
        },
        pageId: {
            type: 'number'
        },
        blockTitle: {
            type: 'string',
            default: 'Featured Speakers'
        }
    };

    registerBlockType('mys/session-speaker-info', {
        title: __('Session Speakers'),
        icon: { src: sessionSpeakerList },
        category: 'mysgb',
        keywords: [__('session'), __('speakers'), __('info')],
        attributes: allAttr,
        edit({ attributes, setAttributes }) {
            const { pageId, itemToFetch, blockTitle } = attributes;
            if ( ! pageId ) {
                setAttributes( { pageId: wp.data.select('core/editor').getCurrentPostId() });
            }
            return (
                <Fragment>
                    <InspectorControls>
                        <PanelBody title={__('Data Settings ')} initialOpen={true} className="range-setting">
                            <div className="inspector-field inspector-field-Numberofitems ">
                                <label className="inspector-mb-0">Number of items</label>
                                <RangeControl
                                    value={itemToFetch}
                                    min={1}
                                    max={100}
                                    onChange={(item) => setAttributes({ itemToFetch: parseInt(item) }) }
                                />
                            </div>
                            <label>Block Title</label>
                            <TextControl
                                type="string"
                                value={blockTitle}                                
                                onChange={ value => setAttributes({ blockTitle: value })}
                            />
                        </PanelBody>
                    </InspectorControls>
                    <ServerSideRender
                        block="mys/session-speaker-info"
                        attributes={ { pageId: pageId, itemToFetch: itemToFetch, blockTitle: blockTitle } }
                    />
                </Fragment>
            );
        },
        save() {
            return null;
        },
    });

})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);