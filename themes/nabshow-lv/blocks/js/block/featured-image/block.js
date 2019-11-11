(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    const { __ } = wpI18n;
    const { Fragment } = wpElement;
    const { registerBlockType } = wpBlocks;
    const { InspectorControls } = wpEditor;
    const { PanelBody, TextControl, ServerSideRender, Button, Placeholder } = wpComponents;

    const allAttr = {
        pageSlug: {
            type: 'string',
        },
        selection: {
            type: 'boolean',
            default: false
        }
    };

    const featurdImgBlockIcon = (
        <svg width="150px" height="150px" viewBox="181 181 150 150" enable-background="new 181 181 150 150">
            <g id="Page-1">
                <g id="_x30_23---Image-Rating" transform="translate(-1)">
                    <path id="Shape" fill="#0F6CB6" d="M204.863,203.87v49.871c0.01,8.76,7.108,15.858,15.868,15.868h72.539
                        c8.76-0.01,15.858-7.108,15.868-15.868V203.87c-0.01-8.759-7.108-15.857-15.868-15.868h-72.539
                        C211.971,188.012,204.873,195.11,204.863,203.87z M220.731,192.536h72.539c6.257,0.007,11.327,5.078,11.335,11.334v49.871
                        c-0.008,6.257-5.078,11.327-11.335,11.334h-72.539c-6.257-0.007-11.327-5.077-11.334-11.334V203.87
                        C209.404,197.613,214.474,192.543,220.731,192.536z"/>
                    <path id="Shape_1_" fill="#0F6CB6" d="M220.731,260.541h72.539c3.756,0,6.801-3.045,6.801-6.801V203.87
                        c0-3.756-3.045-6.8-6.801-6.8h-72.539c-3.756,0-6.801,3.044-6.801,6.8v49.871C213.93,257.496,216.975,260.541,220.731,260.541z
                        M293.27,256.007h-72.539c-1.252,0-2.267-1.015-2.267-2.267v-2.172l20.449-20.449l8.082,8.082c1.77,1.77,4.64,1.77,6.411,0
                        l23.997-23.997l18.135,18.135v20.402C295.537,254.993,294.521,256.007,293.27,256.007z M220.731,201.603h72.539
                        c1.252,0,2.268,1.015,2.268,2.267v23.059l-14.93-14.93c-1.771-1.77-4.641-1.77-6.411,0L250.2,235.996l-8.081-8.081
                        c-1.794-1.712-4.617-1.712-6.411,0l-17.244,17.242V203.87C218.464,202.618,219.479,201.603,220.731,201.603L220.731,201.603z"/>
                    <path id="Shape_2_" fill="#0F6CB6" d="M232.065,224.271c5.008,0,9.068-4.06,9.068-9.067s-4.06-9.067-9.068-9.067
                        s-9.067,4.06-9.067,9.067S227.057,224.271,232.065,224.271z M232.065,210.67c2.504,0,4.534,2.03,4.534,4.534
                        c0,2.504-2.03,4.534-4.534,4.534c-2.503,0-4.534-2.03-4.534-4.534C227.531,212.701,229.561,210.67,232.065,210.67z"/>
                    <path id="Shape_3_" fill="#0F6CB6" d="M192.203,294.501c-1.403,0.214-2.565,1.199-3.006,2.548
                        c-0.464,1.367-0.12,2.881,0.891,3.912l7.544,7.708l-1.782,10.901c-0.248,1.449,0.361,2.911,1.564,3.756
                        c1.162,0.833,2.7,0.921,3.949,0.227l9.167-5.065l9.167,5.057c1.25,0.693,2.787,0.605,3.949-0.227
                        c1.203-0.845,1.812-2.307,1.564-3.756l-1.782-10.895l7.544-7.708c1.011-1.031,1.355-2.545,0.891-3.912
                        c-0.44-1.348-1.602-2.333-3.003-2.548l-10.317-1.574l-4.613-9.811c-0.612-1.326-1.939-2.176-3.4-2.176s-2.788,0.85-3.4,2.176
                        l-4.613,9.813L192.203,294.501z M206.45,295.224l4.08-8.673l4.081,8.673c0.528,1.143,1.594,1.944,2.838,2.136l9.331,1.421
                        l-6.842,6.982c-0.848,0.877-1.233,2.103-1.038,3.308l1.587,9.747l-8.161-4.504c-1.118-0.621-2.477-0.621-3.595,0l-8.163,4.486
                        l1.587-9.748c0.194-1.205-0.191-2.432-1.041-3.31l-6.83-6.973l9.328-1.422C204.853,297.158,205.917,296.361,206.45,295.224z"/>
                    <path id="Shape_4_" fill="#0F6CB6" d="M321.801,294.501l-10.316-1.573l-4.613-9.813c-0.612-1.326-1.939-2.176-3.4-2.176
                        s-2.788,0.85-3.4,2.176l-4.615,9.813l-10.314,1.573c-1.402,0.214-2.564,1.199-3.005,2.548c-0.465,1.367-0.12,2.881,0.891,3.912
                        l7.544,7.708l-1.782,10.895c-0.247,1.449,0.361,2.911,1.564,3.756c1.162,0.833,2.699,0.921,3.949,0.228l9.169-5.06l9.168,5.057
                        c1.249,0.693,2.786,0.605,3.948-0.227c1.203-0.845,1.813-2.307,1.564-3.756l-1.782-10.895l7.544-7.708
                        c1.012-1.031,1.355-2.545,0.892-3.912C324.363,295.699,323.201,294.715,321.801,294.501z M312.878,305.763
                        c-0.848,0.877-1.232,2.103-1.038,3.308l1.587,9.747l-8.16-4.504c-1.118-0.621-2.478-0.621-3.596,0l-8.16,4.504l1.587-9.747
                        c0.194-1.206-0.191-2.433-1.041-3.31l-6.837-6.991l9.328-1.422c1.243-0.188,2.31-0.985,2.843-2.124l4.08-8.673l4.08,8.673
                        c0.528,1.143,1.595,1.944,2.838,2.136l9.331,1.421L312.878,305.763z"/>
                    <path id="Shape_5_" fill="#0F6CB6" d="M278.334,297.049c-0.44-1.348-1.602-2.333-3.004-2.548l-10.316-1.573l-4.613-9.813
                        c-0.611-1.326-1.939-2.176-3.4-2.176c-1.461,0-2.788,0.85-3.4,2.176l-4.615,9.813l-10.314,1.573
                        c-1.402,0.214-2.565,1.199-3.005,2.548c-0.465,1.367-0.12,2.881,0.891,3.912l7.544,7.708l-1.782,10.895
                        c-0.248,1.449,0.361,2.911,1.564,3.756c1.162,0.833,2.7,0.921,3.949,0.228l9.169-5.061l9.167,5.058
                        c1.249,0.693,2.786,0.604,3.948-0.228c1.203-0.845,1.813-2.307,1.564-3.756l-1.782-10.895l7.544-7.707
                        C278.453,299.928,278.797,298.416,278.334,297.049L278.334,297.049z M266.408,305.763c-0.849,0.877-1.233,2.103-1.039,3.308
                        l1.587,9.747l-8.16-4.504c-1.118-0.621-2.478-0.621-3.595,0l-8.161,4.504l1.587-9.747c0.194-1.206-0.191-2.433-1.041-3.31
                        l-6.837-6.991l9.328-1.422c1.243-0.188,2.31-0.985,2.842-2.124l4.081-8.68l4.081,8.68c0.528,1.143,1.594,1.944,2.838,2.136
                        l9.33,1.421L266.408,305.763z"/>
                </g>
            </g>
        </svg>
    );


    registerBlockType('nab/page-featured-image', {
        title: __('Featured Image'),
        icon: { src: featurdImgBlockIcon},
        category: 'nabshow',
        keywords: [__('page'), __('featured'), __('image')],
        attributes: allAttr,
        edit(props) {

            const { attributes: { pageSlug, selection }, setAttributes } = props;

            let commonControl = <TextControl
                label="Page Slug"
                type="string"
                value={pageSlug}
                onChange={(slug) => setAttributes({ pageSlug: slug })}
            />;

            if (! selection ) {
                return (
                    <Placeholder
                        label={__('Featured Image')}
                        instructions={__('Enter page slug to get featured image')}
                    >
                        { commonControl }
                        <Button className="button button-large button-primary" onClick={() => setAttributes({ selection: true }) } >
                            {__('Apply')}
                        </Button>
                    </Placeholder>
                );
            }
            return (
                <Fragment>
                    <InspectorControls>
                        <PanelBody title={__('Settings')}>
                            { commonControl }
                        </PanelBody>
                    </InspectorControls>
                    <ServerSideRender
                        block="nab/page-featured-image"
                        attributes={{ pageSlug: pageSlug }}
                    />
                </Fragment>
            );
        },
        save() {
            return null;
        },
    });

})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);