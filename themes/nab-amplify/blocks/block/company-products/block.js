(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    const { __ } = wpI18n;
    const { Component, Fragment } = wpElement;
    const { registerBlockType } = wpBlocks;
    const { InspectorControls } = wpEditor;
    const { PanelBody, SelectControl, TextControl, ServerSideRender, CheckboxControl, RangeControl } = wpComponents;

    const sessionSliderBlockIcon = (
        <svg width="150px" height="150px" viewBox="0 0 150 150" enable-background="new 0 0 150 150">
            <rect fill="none" width="150" height="150"/>
            <g>
                <path fill="#92c83e" d="M0,22.5h150v90h-5.625c0-13.425-10.95-24.375-24.375-24.375c-9.825,0-18.15,5.925-22.05,14.325
                    c-1.875-0.75-3.9-1.2-6.075-1.2c-7.35,0-13.5,4.725-15.825,11.25H0V22.5z M62.775,45.825c-0.45,1.125-0.75,2.325-0.825,3.525
                    c-0.075,1.2-0.075,2.475,0.075,3.75l0.15,0.6c0.075,0.45,0.15,1.05,0.375,1.725c0.15,0.75,0.45,1.5,0.75,2.325
                    c0.225,0.825,0.675,1.65,1.125,2.475c0.525,0.9,1.125,1.65,1.725,2.325c0.6,0.675,1.35,1.275,2.325,1.725
                    c0.9,0.45,1.875,0.675,3,0.675c1.05,0,2.025-0.225,2.925-0.675c0.9-0.45,1.65-1.05,2.25-1.65c0.675-0.675,1.199-1.5,1.649-2.4
                    c0.525-0.9,0.9-1.725,1.2-2.475s0.525-1.5,0.675-2.325c0.226-0.825,0.3-1.35,0.375-1.65c0.075-0.3,0.075-0.525,0.075-0.675
                    c0.375-2.175,0.225-4.2-0.3-6.15C79.8,45,78.75,43.35,77.25,42c-1.575-1.35-3.525-2.025-5.925-2.025c-1.425,0-2.7,0.225-3.9,0.75
                    c-1.125,0.525-2.1,1.2-2.85,2.1C63.9,43.65,63.3,44.7,62.775,45.825L62.775,45.825z M96.375,91.125v-8.55
                    c0-2.476-0.75-4.95-2.175-7.35S90.825,70.8,88.425,69.3c-2.399-1.575-4.95-2.325-7.649-2.325l-9.3,6.3l-9.6-6.15
                    c-2.775,0-5.4,0.75-7.8,2.25c-2.325,1.5-4.2,3.45-5.55,5.775c-1.35,2.4-2.025,4.875-2.025,7.425v8.55l1.35,0.375
                    c0.9,0.3,2.175,0.6,3.825,1.05c1.725,0.375,3.525,0.75,5.55,1.125c1.95,0.375,4.275,0.675,6.825,0.976
                    c2.55,0.225,5.025,0.375,7.425,0.375c2.25,0,4.725-0.15,7.35-0.375c2.55-0.301,4.8-0.601,6.675-0.976c1.875-0.3,3.75-0.75,5.7-1.2
                    l3.75-0.899C95.55,91.425,96,91.275,96.375,91.125z M120,91.875c11.4,0,20.625,9.225,20.625,20.625S131.4,133.125,120,133.125
                    c-5.475,0-10.35-2.25-14.025-5.775c1.726-2.625,2.775-5.85,2.775-9.225c0-5.775-2.925-10.95-7.425-13.95
                    C104.55,96.975,111.6,91.875,120,91.875z M78.75,118.125c0-7.2,5.925-13.125,13.125-13.125S105,110.925,105,118.125
                    s-5.925,13.125-13.125,13.125S78.75,125.325,78.75,118.125z"/>
            </g>
        </svg>
    );

    class NabCompanyProducts extends Component {
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
                        block="nab/company-products"
                        attributes={{ itemToFetch: itemToFetch, displayOrder: displayOrder }}
                    />
                </Fragment>
            );
        }
    }
    const blockAttrs = {
        itemToFetch: {
            type: 'number',
            default: 100
        },            
        displayOrder: {
            type: 'string',
            default: 'DESC'
        }
    };
    registerBlockType('nab/company-products', {
        title: __('Company Products'),
        icon: { src: sessionSliderBlockIcon },
        category: 'nab_amplify',
        keywords: [__('Company'), __('Products')],
        attributes: blockAttrs,
        edit: NabCompanyProducts,
        save() {
            return null;
        },
    });

})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);