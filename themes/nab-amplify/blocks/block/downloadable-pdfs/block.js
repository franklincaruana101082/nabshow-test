(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    const { __ } = wpI18n;
    const { Component, Fragment } = wpElement;
    const { registerBlockType } = wpBlocks;
    const { InspectorControls } = wpEditor;
    const { PanelBody, SelectControl, ServerSideRender, RangeControl } = wpComponents;   

    class NabDownloadablePDFs extends Component {
        constructor() {
            super(...arguments);
            this.state = {
                termsObj: {},
                filterTermsObj: {},
            };
        }
        render() {
            const { attributes, setAttributes } = this.props;
            const { itemToFetch, displayOrder } = attributes;
            return (
                <Fragment>
                    <InspectorControls>
                        <PanelBody title={__('Data Settings ')} initialOpen={true} className="range-setting">                            
                            <div className="inspector-field inspector-field-Numberofitems ">
                                <label className="inspector-mb-0">Number of items</label>
                                <RangeControl
                                    value={itemToFetch}
                                    min={1}
                                    max={200}
                                    onChange={(item) => setAttributes({ itemToFetch: parseInt(item) }) }
                                />
                            </div>                            
                            <SelectControl
                                label={__('Display Order')}
                                value={displayOrder}
                                options={[
                                    {label: __('Oldest to Newest'), value: 'ASC' },                                    
                                    {label: __('Newest to Oldest'), value: 'DESC'},                                    
                                ]}
                                onChange={(value) => { setAttributes({displayOrder: value}); }}
                            />                            
                        </PanelBody>
                    </InspectorControls>
                    <ServerSideRender
                        block="nab/downloadable-pdfs"
                        attributes={{ itemToFetch: itemToFetch, displayOrder: displayOrder }}
                    />
                </Fragment>
            );
        }
    }
    const blockAttrs = {
        itemToFetch: {
            type: 'number',
            default: 10
        },            
        displayOrder: {
            type: 'string',
            default: 'DESC'
        }
    };
    registerBlockType('nab/downloadable-pdfs', {
        title: __('Downloadable PDFs'),
        icon: 'download',
        category: 'nab_amplify',
        keywords: [__('Downloadable'), __('Download'), __('PDF')],
        attributes: blockAttrs,
        edit: NabDownloadablePDFs,
        save() {
            return null;
        },
    });

})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);