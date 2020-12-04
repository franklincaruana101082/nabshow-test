(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    const { __ } = wpI18n;
    const { Component, Fragment } = wpElement;
    const { registerBlockType } = wpBlocks;
    const { InspectorControls } = wpEditor;
    const { PanelBody, ServerSideRender, RangeControl } = wpComponents;    

    class NabCompanyEmployees extends Component {
        constructor() {
            super(...arguments);            
        }        
        render() {
            const { attributes, setAttributes } = this.props;
            const { itemToFetch } = attributes;
            return (
                <Fragment>
                    <InspectorControls>
                        <PanelBody title={__('Data Settings')} initialOpen={true} className="range-setting">                            
                            <div className="inspector-field inspector-field-Numberofitems ">
                                <label className="inspector-mb-0">Number of items</label>
                                <RangeControl
                                    value={itemToFetch}
                                    min={1}
                                    max={200}
                                    onChange={(item) => setAttributes({ itemToFetch: parseInt(item) }) }
                                />
                            </div>
                        </PanelBody>
                    </InspectorControls>
                    <ServerSideRender
                        block="nab/company-employees"
                        attributes={{ itemToFetch: itemToFetch }}
                    />
                </Fragment>
            );
        }
    }
    const blockAttrs = {
        itemToFetch: {
            type: 'number',
            default: 4
        },
    };
    registerBlockType('nab/company-employees', {
        title: __('Company Employees'),
        icon: 'admin-users',
        category: 'nab_amplify',
        keywords: [__('Company'), __('Employees')],
        attributes: blockAttrs,
        edit: NabCompanyEmployees,
        save() {
            return null;
        },
    });

})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);