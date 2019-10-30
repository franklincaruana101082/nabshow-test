import { exhibitorAccordion, exhibitorImageListing, exhibitorParentImageListing } from '../icons';
(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    const { __ } = wpI18n;
    const { Fragment } = wpElement;
    const { registerBlockType } = wpBlocks;
    const { InspectorControls } = wpEditor;
    const { PanelBody, RangeControl, ServerSideRender } = wpComponents;

    const allAttr = {
        itemToFetch: {
            type: 'number',
            default: 10
        },
        layoutType: {
            type: 'string',
            default: 'listing'
        },
    };

    registerBlockType('mys/product-categories', {
        title: __('Product Categories'),
        icon: 'lock',
        category: 'mysgb',
        keywords: [__('product'), __('categories')],
        attributes: allAttr,
        edit(props) {
            const { attributes: { itemToFetch, layoutType }, setAttributes } = props;
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
                        </PanelBody>
                        <label>Layout Types</label>
                        <ul className="quote-options">
                            <li onClick={() => { setAttributes({ layoutType: 'listing' }); }} className={'listing' === layoutType ? 'active' : ''}  >{exhibitorImageListing}</li>
                            <li onClick={() => { setAttributes({ layoutType: 'accordion-list' }); }} className={'accordion-list' === layoutType ? 'active' : ''}  >{exhibitorAccordion}</li>
                            <li onClick={() => { setAttributes({ layoutType: 'parent-img-list' }); }} className={'parent-img-list' === layoutType ? 'active' : ''}  >{exhibitorParentImageListing}</li>
                        </ul>
                    </InspectorControls>
                    <ServerSideRender
                        block="mys/product-categories"
                        attributes={{
                            itemToFetch: itemToFetch,
                            layoutType: layoutType
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