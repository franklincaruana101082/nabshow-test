(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    const {__} = wpI18n;
    const { Fragment } = wpElement;
    const { registerBlockType } = wpBlocks;    
    const { ServerSideRender} = wpComponents;

    const allAttr = {
        pageId: {
            type: 'number'
        }        
    };

    registerBlockType('mys/add-to-calendar', {
        title: __('Add to Calendar'),
        icon: 'calendar-alt',
        category: 'mysgb',
        keywords: [__('add'), __('to'), __('calendar')],
        attributes: allAttr,
        edit({ attributes, setAttributes }) {
            const { pageId } = attributes;
            if ( ! pageId ) {
                setAttributes( { pageId: wp.data.select('core/editor').getCurrentPostId() });
            }
            return (
                <Fragment>                    
                    <ServerSideRender
                        block="mys/add-to-calendar"
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