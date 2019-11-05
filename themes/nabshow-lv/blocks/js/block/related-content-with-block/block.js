(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    const {__} = wpI18n;
    const {Fragment} = wpElement;
    const {registerBlockType} = wpBlocks;
    const {ServerSideRender} = wpComponents;

    const allAttr = {
        pageId: {
            type: 'number'
        },
    };

    registerBlockType('nab/related-content-with-block', {
        title: __('Related Content with Block'),
        icon: 'editor-table',
        category: 'nabshow',
        keywords: [__('related'), __('content'), __('block')],
        attributes: allAttr,
        edit({ attributes, setAttributes }) {
            const { pageId } = attributes;
            if ( ! pageId ) {
                setAttributes( { pageId: wp.data.select('core/editor').getCurrentPostId() });
            }
            return (
                <Fragment>
                    <ServerSideRender
                        block="nab/related-content-with-block"
                        attributes={ { pageId: pageId } }
                    />
                </Fragment>
            );
        },
        save() {
            return null;
        },
    });

})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);