(function (wpI18n, wpBlocks, wpElement, wpComponents) {
    const {__} = wpI18n;
    const { Fragment } = wpElement;
    const { registerBlockType } = wpBlocks;    
    const { ServerSideRender} = wpComponents;
    const allAttr = {};

    registerBlockType('nab/regional-addressess', {
        title: __('Regional Addressess'),
        icon: 'editor-code',
        category: 'nab_amplify',
        keywords: [__('Regional'), __('Company'), __('Address')],
        attributes: allAttr,
        edit() {            
            return (
                <Fragment>                    
                    <ServerSideRender
                        block="nab/regional-addressess"
                    />
                </Fragment>
            );
        },
        save() {
            return null;
        },
    });

})(wp.i18n, wp.blocks, wp.element, wp.components);