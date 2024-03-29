(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    const { __ } = wpI18n;
    const { Component, Fragment } = wpElement;
    const { registerBlockType } = wpBlocks;
    const { InspectorControls } = wpEditor;
    const { PanelBody, SelectControl, ToggleControl, TextControl, ServerSideRender, CheckboxControl, RangeControl } = wpComponents;

    const productWinnerBlockIcon = (
        <svg width="150px" height="150px" viewBox="181 181 150 150" enable-background="new 181 181 150 150">
            <path fill="#92c83e" d="M233.811,222.615c-13.595,0-24.655,11.061-24.655,24.655c0,13.594,11.06,24.655,24.655,24.655
                c13.595,0,24.655-11.061,24.655-24.655C258.466,233.675,247.405,222.615,233.811,222.615z M214.086,247.27
                c0-10.875,8.849-19.724,19.724-19.724v4.931c-8.159,0-14.793,6.635-14.793,14.793H214.086z M228.879,265.55l-9.14-9.14l3.486-3.486
                l5.654,5.653l20.446-20.446l3.486,3.486L228.879,265.55z"/>
            <path fill="#92c83e" d="M233.811,286.718c-21.751,0-39.448-17.697-39.448-39.448c0-21.751,17.697-39.448,39.448-39.448
                c8.997,0,17.697,3.156,24.655,8.725v-11.98l-0.108-0.062c-3.59-2.076-8.122-1.6-11.275,1.171l-2.783,2.453l-1.184-3.516
                c-1.341-3.981-5.03-6.654-9.182-6.654c-4.398,0-8.087,2.673-9.426,6.652l-1.183,3.516l-2.784-2.453
                c-3.148-2.776-7.678-3.247-11.275-1.171l-0.217,0.126c-3.595,2.073-5.454,6.232-4.623,10.35l0.732,3.637l-3.637-0.732
                c-4.105-0.833-8.274,1.028-10.35,4.623l-0.126,0.217c-2.076,3.595-1.603,8.126,1.171,11.275l2.453,2.784l-3.516,1.183
                c-3.982,1.341-6.654,5.03-6.654,9.179v0.249c0,4.154,2.672,7.843,6.652,9.182l3.516,1.183l-2.453,2.784
                c-2.776,3.148-3.245,7.68-1.171,11.274l0.126,0.217c2.076,3.595,6.228,5.457,10.35,4.623l3.637-0.732l-0.732,3.637
                c-0.829,4.115,1.028,8.274,4.623,10.351l0.217,0.126c3.597,2.08,8.129,1.604,11.275-1.172l2.784-2.453l1.183,3.517
                c1.341,3.979,5.03,6.651,9.182,6.651c4.398,0,8.087-2.673,9.426-6.651l1.184-3.517l2.783,2.453
                c3.146,2.774,7.683,3.242,11.275,1.172l0.217-0.126c3.595-2.076,5.451-6.235,4.623-10.351l-0.732-3.637l3.637,0.732
                c4.132,0.836,8.274-1.03,10.351-4.623l0.125-0.217c2.076-3.595,1.605-8.126-1.171-11.274l-2.453-2.784l3.517-1.183
                c3.207-1.081,5.537-3.694,6.331-6.837h-9.667C271.851,270.337,254.73,286.718,233.811,286.718L233.811,286.718z"/>
            <path fill="#92c83e" d="M221.18,294.413c-4.433,2.453-9.889,2.485-14.381-0.106l-0.217-0.125c-1.442-0.834-2.675-1.906-3.723-3.122
                l-13.107,21.389l16.265-4.065l4.081,16.326l15.404-25.776C223.766,297.757,222.277,296.235,221.18,294.413L221.18,294.413z"/>
            <path fill="#92c83e" d="M261.039,294.182l-0.217,0.125c-4.494,2.592-9.946,2.56-14.378,0.106c-1.102,1.832-2.591,3.357-4.317,4.536
                l15.395,25.76l4.08-16.326l16.266,4.065L264.76,291.06C263.715,292.275,262.481,293.348,261.039,294.182L261.039,294.182z"/>
            <path fill="#92c83e" d="M288.052,195.494h4.931v4.931h4.932v-4.931h4.931v4.931h4.931v-9.862h-24.654v9.862h4.931V195.494z"/>
            <path fill="#92c83e" d="M325.034,190.563h-12.327v14.793h-34.518v-14.793h-12.327c-1.361,0-2.466,1.104-2.466,2.465v49.311
                c0,1.361,1.104,2.465,2.466,2.465h59.172c1.361,0,2.466-1.104,2.466-2.465v-49.311C327.5,191.667,326.396,190.563,325.034,190.563z
                M302.845,239.874h-4.931v-4.931h4.931V239.874z M312.707,239.874h-4.932v-4.931h4.932V239.874z M322.569,239.874h-4.932v-4.931
                h4.932V239.874z M322.569,230.011h-24.655v-4.931h24.655V230.011z"/>
            <path fill="#92c83e" d="M258.466,223.165c-6.47-6.61-15.39-10.412-24.655-10.412c-19.034,0-34.518,15.484-34.518,34.518
                s15.484,34.517,34.518,34.517c18.2,0,33.119-14.17,34.392-32.052h-2.34c-0.905,0-1.764-0.188-2.566-0.486
                c-1.026,15.392-13.839,27.607-29.485,27.607c-16.314,0-29.586-13.272-29.586-29.586c0-16.314,13.272-29.586,29.586-29.586
                c10.286,0,19.352,5.281,24.655,13.267V223.165z"/>
        </svg>
    );

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
            const { itemToFetch, postType, taxonomies, terms, orderBy, showFilter } = attributes;

            let isCheckedTerms = {};
            if (! this.isEmpty(terms) && terms.constructor !== Object ) {
                isCheckedTerms = JSON.parse(terms);
            }

            return (
                <Fragment>
                    <InspectorControls>
                        <PanelBody title={__('Data Settings ')} initialOpen={true} className="range-setting">
                            <ToggleControl
                                label={__('Show Filter?')}
                                checked={showFilter}
                                onChange={() => setAttributes({ showFilter: ! showFilter }) }
                            />
                            <div className="inspector-field inspector-field-Numberofitems ">
                                <label className="inspector-mb-0">Number of items</label>
                                <RangeControl
                                    value={itemToFetch}
                                    min={1}
                                    max={100}
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
                        attributes={{ itemToFetch: itemToFetch, postType: postType, taxonomies: taxonomies, terms: terms, orderBy: orderBy, showFilter: showFilter}}
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
        },
        showFilter: {
            type: 'boolean',
            default: false
        }
    };
    registerBlockType('mys/product-winner', {
        title: __('Product Winner'),
        icon: { src: productWinnerBlockIcon },
        category: 'mysgb',
        keywords: [__('product'), __('winner'), __('showcase')],
        attributes: blockAttrs,
        edit: NabProductWinner,
        save() {
            return null;
        },
    });

})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);
