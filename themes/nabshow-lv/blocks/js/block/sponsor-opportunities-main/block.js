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

    registerBlockType('nab/sponsor-opportunities-main', {
        title: __('Sponsor Opportunities Main'),
        icon: 'lock',
        category: 'nabshow',
        keywords: [__('Sponsor'), __('Opportunities')],
        attributes: allAttr,
        edit({ attributes, setAttributes }) {
            const { pageId } = attributes;
            if ( ! pageId ) {
                setAttributes( { pageId: wp.data.select('core/editor').getCurrentPostId() });
            }
            return (
                <Fragment>
                    <ServerSideRender
                        block="nab/sponsor-opportunities-main"
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