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


    registerBlockType('nab/page-featured-image', {
        title: __('Featured Image'),
        icon: 'lock',
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