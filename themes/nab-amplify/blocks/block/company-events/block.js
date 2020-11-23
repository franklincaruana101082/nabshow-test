(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    const { __ } = wpI18n;
    const { Component, Fragment } = wpElement;
    const { registerBlockType } = wpBlocks;
    const { InspectorControls } = wpEditor;
    const { PanelBody, SelectControl, TextControl, ServerSideRender, CheckboxControl, RangeControl } = wpComponents;    

    class NabCompanyEvents extends Component {
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
                            { 0 < this.state.termsObj.length &&

                                <Fragment>
                                    { 
                                    <div>
                                        <label>{__(`Select Company`)}</label>

                                        {7 < this.state.termsObj.length &&
                                        <TextControl
                                            type="string"
                                            name='term-filter-input'
                                            placeHolder="Search Category"
                                            onChange={ value => this.filterTerms(value)}
                                        />
                                        }

                                        <div className="fix-height-select">

                                            {this.state.filterTermsObj.map((ch, index) => (

                                                <Fragment key={index}>
                                                    <CheckboxControl checked={-1 < companyCategory.indexOf(ch.slug)} label={ch.name} name="terms[]" value={ch.slug} onChange={(isChecked) => {                                                
                                                            let i,
                                                            tempTerms = [...companyCategory];                                                    

                                                            if ( isChecked ) {
                                                                tempTerms.push(ch.slug);
                                                            } else {
                                                                i = tempTerms.indexOf(ch.slug);
                                                                tempTerms.splice(i, 1);                                                    
                                                            }
                                                            this.props.setAttributes({ companyCategory: tempTerms });                                                    
                                                        }
                                                    }
                                                    />
                                                </Fragment>
                                            ))
                                            }
                                        </div>
                                    </div>                                    
                                    }
                                </Fragment>
                            }
                        </PanelBody>
                    </InspectorControls>
                    <ServerSideRender
                        block="nab/company-events"
                        attributes={{ itemToFetch: itemToFetch, companyCategory: companyCategory, displayOrder: displayOrder }}
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
        companyCategory: {
            type: 'array',
            default: []
        },        
        displayOrder: {
            type: 'string',
            default: 'DESC'
        }
    };
    registerBlockType('nab/company-events', {
        title: __('Company Events'),
        icon: 'calendar',
        category: 'nab_amplify',
        keywords: [__('Company'), __('Events')],
        attributes: blockAttrs,
        edit: NabCompanyEvents,
        save() {
            return null;
        },
    });

})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);