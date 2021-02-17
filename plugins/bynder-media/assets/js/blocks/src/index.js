(function () {
    const { __ } = wp.i18n;
    const { registerBlockType } = wp.blocks;

    registerBlockType('bm/single-asset', {
        title: __('Bynder Asset'),
        icon: 'format-image',
        category: 'global',
        keywords: [__('bynder'), __('asset')],
        edit() {
            return (
                <div className='bynder-assets-btn-block'>
                    <input type="button" className="bynder-asset-btn bm-select-media bm-btn" id="bm-block-image" value="Select Asset" />
                </div>
            );
        },
        save() {
            return null;
        },
    });

})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);
