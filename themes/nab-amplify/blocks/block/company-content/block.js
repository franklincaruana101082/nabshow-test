(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    const { __ } = wpI18n;
    const { Component, Fragment } = wpElement;
    const { registerBlockType } = wpBlocks;
    const { InspectorControls } = wpEditor;
    const { PanelBody, SelectControl, TextControl, ServerSideRender, CheckboxControl, RangeControl } = wpComponents;    

    class NabCompanyContent extends Component {
        constructor() {
            super(...arguments);
            this.state = {
                termsObj: {},
                filterTermsObj: {},
            };
        }

        componentWillMount() {            
            // Fetch all channels
            wp.apiFetch({ path: '/nab/request/get-company-category' }).then((terms) => {
                this.setState({ termsObj: terms, filterTermsObj: terms });
            });
        }

        filterTerms(value) {
            let filterTerms = this.state.termsObj.filter(term => -1 < term.title.toLowerCase().indexOf(value.toLowerCase()));
            this.setState({ filterTermsObj: filterTerms });
        }

        isEmpty(obj) {
            let key;
            for (key in obj) {
                if (obj.hasOwnProperty(key)) {
                    return false;
                }
            }
            return true;
        }
        render() {
            const { attributes, setAttributes } = this.props;
            const { itemToFetch, companyCategory, displayOrder } = attributes;
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
                        block="nab/company-content"
                        attributes={{ itemToFetch: itemToFetch, displayOrder: displayOrder }}
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
        displayOrder: {
            type: 'string',
            default: 'DESC'
        }
    };
    registerBlockType('nab/company-content', {
        title: __('Company Content'),
        icon: 'admin-page',
        category: 'nab_amplify',
        keywords: [__('Company'), __('Content')],
        attributes: blockAttrs,
        edit: NabCompanyContent,
        save() {
            return null;
        },
    });

})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);