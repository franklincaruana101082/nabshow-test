(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    const { __ } = wpI18n;
    const { Component, Fragment } = wpElement;
    const { registerBlockType } = wpBlocks;
    const { InspectorControls } = wpEditor;
    const { PanelBody, SelectControl, TextControl, ServerSideRender, CheckboxControl, RangeControl } = wpComponents;

    class NabProductWinner extends Component {
        constructor() {
            super(...arguments);
            this.state = {
                taxonomiesList: [],
                taxonomies: [],
                taxonomiesObj: {},
                termsObj: {},
                filterTermsObj: {},
            };
        }

        componentWillMount() {
            const { taxonomies } = this.props.attributes;

            // Fetch all taxonomies
            wp.apiFetch({ path: '/wp/v2/taxonomies' }).then((taxonomies) => {
                this.setState({ taxonomiesObj: taxonomies });
                this.filterTaxonomy();
            });

            // Fetch all terms
            wp.apiFetch({ path: '/nab_api/request/all_terms' }).then((terms) => {
                this.setState({ termsObj: terms, filterTermsObj: terms, taxonomies: taxonomies });
            });

        }

        filterTaxonomy() {
            const { postType } = this.props.attributes;
            let postTaxonomiesOptions = [],
                taxonomies = this.state.taxonomiesObj,
                taxonomyKey = Object.keys(taxonomies);
            taxonomyKey.forEach(function (key) {
                if (postType === taxonomies[key].types[0]) {
                    postTaxonomiesOptions.push({ label: __(taxonomies[key].name), value: __(taxonomies[key].slug) });
                }
            });
            this.setState({ taxonomiesList: postTaxonomiesOptions });
        }

        filterTerms(value, taxonomy) {
            let filterTerms = {};
            this.state.taxonomies.map((tax) => {
                if (taxonomy === tax) {
                    filterTerms[tax] = this.state.termsObj[tax].filter(term => -1 < term.name.toLowerCase().indexOf(value.toLowerCase()));
                } else {
                    filterTerms[tax] = this.state.termsObj[tax];
                }

            });
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
            const { itemToFetch, postType, taxonomies, terms, orderBy } = attributes;

            let isCheckedTerms = {};
            if (! this.isEmpty(terms) && terms.constructor !== Object ) {
                isCheckedTerms = JSON.parse(terms);
            }

            return (
                <Fragment>
                    <InspectorControls>
                        <PanelBody title={__('Data Settings ')} initialOpen={true} className="range-setting">
                            <div className="inspector-field inspector-field-Numberofitems ">
                                <label className="inspector-mb-0">Number of items</label>
                                <RangeControl
                                    value={itemToFetch}
                                    min={1}
                                    max={20}
                                    onChange={(item) => setAttributes({ itemToFetch: parseInt(item) }) }
                                />

                            </div>
                            <SelectControl
                                label={__('Order by')}
                                value={orderBy}
                                options={[
                                    { label: __('Newest to Oldest'), value: 'date' },
                                    { label: __('Menu Order'), value: 'menu_order' },
                                ]}
                                onChange={(value) => setAttributes({ orderBy: value }) }
                            />

                            {0 < this.state.taxonomiesList.length &&

                            <Fragment>

                                <label>{__('Select Taxonomy')}</label>
                                <div className="fix-height-select">

                                    {this.state.taxonomiesList.map((taxonomy, index) => (

                                        <Fragment key={index}>

                                            <CheckboxControl checked={-1 < taxonomies.indexOf(taxonomy.value)} label={taxonomy.label} name="taxonomy[]" value={taxonomy.value} onChange={(isChecked) => {

                                                let index,
                                                    tempTaxonomies = [...taxonomies],
                                                    tempTerms = terms;

                                                if (isChecked) {
                                                    tempTaxonomies.push(taxonomy.value);
                                                } else {
                                                    index = tempTaxonomies.indexOf(taxonomy.value);
                                                    tempTaxonomies.splice(index, 1);
                                                    if (! this.isEmpty(tempTerms)) {
                                                        tempTerms = JSON.parse(tempTerms);
                                                        delete tempTerms[taxonomy.value];
                                                        tempTerms = JSON.stringify(tempTerms);
                                                        this.props.setAttributes({ terms: tempTerms });
                                                    }
                                                }
                                                if ( tempTerms.constructor === Object ) {
                                                    tempTerms = JSON.stringify(tempTerms);
                                                }
                                                this.props.setAttributes({ terms: tempTerms, taxonomies: tempTaxonomies });
                                                this.setState({ taxonomies: tempTaxonomies });
                                            }
                                            }
                                            />

                                        </Fragment>

                                    ))
                                    }
                                </div>

                            </Fragment>
                            }

                            {0 < this.state.taxonomies.length &&

                            <Fragment>
                                {
                                    this.state.taxonomies.map((taxonomy, index) => (

                                        undefined !== this.state.filterTermsObj[taxonomy] &&

                                        <div key={index}>
                                            <label>{__(`Select Category from ${taxonomy}`)}</label>

                                            {7 < this.state.termsObj[taxonomy].length &&
                                            <TextControl
                                                type="string"
                                                name={taxonomy}
                                                onChange={value => this.filterTerms(value, taxonomy)}
                                            />
                                            }

                                            <div className="fix-height-select">

                                                {this.state.filterTermsObj[taxonomy].map((term, index) => (

                                                    <Fragment key={index}>

                                                        <CheckboxControl checked={isCheckedTerms[taxonomy] !== undefined && isCheckedTerms[taxonomy][term.slug]} label={term.name} name={`${taxonomy}[]`} value={term.slug} onChange={(isChecked) => {

                                                            let tempTerms = terms;
                                                            if (! this.isEmpty(tempTerms)) {
                                                                tempTerms = JSON.parse(tempTerms);
                                                            }
                                                            if (isChecked) {
                                                                if (tempTerms[taxonomy] === undefined) {
                                                                    tempTerms[taxonomy] = {};
                                                                    tempTerms[taxonomy][term.slug] = { label: term.name, value: term.slug };
                                                                } else {
                                                                    tempTerms[taxonomy][term.slug] = { label: term.name, value: term.slug };
                                                                }
                                                            } else {
                                                                delete tempTerms[taxonomy][term.slug];
                                                            }
                                                            tempTerms = JSON.stringify(tempTerms);
                                                            this.props.setAttributes({ terms: tempTerms });
                                                        }
                                                        }
                                                        />
                                                    </Fragment>
                                                ))
                                                }
                                            </div>
                                        </div>
                                    ))
                                }
                            </Fragment>
                            }
                        </PanelBody>
                    </InspectorControls>
                    <ServerSideRender
                        block="mys/product-winner"
                        attributes={{ itemToFetch: itemToFetch, postType: postType, taxonomies: taxonomies, terms: terms, orderBy: orderBy }}
                    />
                </Fragment >
            );
        }
    }
    const blockAttrs = {
        itemToFetch: {
            type: 'number',
            default: 10
        },
        postType: {
            type: 'string',
            default: 'not-to-be-missed'
        },
        taxonomies: {
            type: 'array',
            default: []
        },
        terms: {
            type: 'string',
            default: {}
        },
        orderBy: {
            type: 'string',
            default: 'date'
        }
    };
    registerBlockType('mys/product-winner', {
        title: __('Product Winner'),
        icon: 'shield',
        category: 'mysgb',
        keywords: [__('product'), __('winner'), __('showcase')],
        attributes: blockAttrs,
        edit: NabProductWinner,
        save() {
            return null;
        },
    });

})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);