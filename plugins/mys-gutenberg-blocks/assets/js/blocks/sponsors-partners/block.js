import { partnerSponser1, partnerSponser2 } from '../icons';

(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    const { __ } = wpI18n;
    const { Component, Fragment } = wpElement;
    const { registerBlockType } = wpBlocks;
    const { InspectorControls } = wpEditor;
    const { PanelBody, SelectControl, ServerSideRender, CheckboxControl, RangeControl, ToggleControl } = wpComponents;

    class MYSSponsorsPartners extends Component {
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

            //Fetch all taxonomies
            wp.apiFetch({ path: '/wp/v2/taxonomies' }).then(taxonomies => {
                this.setState({ taxonomiesObj: taxonomies });
                this.filterTaxonomy();
            });

            // Fetch all terms
            wp.apiFetch({ path: '/nab_api/request/all_terms' }).then(terms => {
                this.setState({
                    termsObj: terms,
                    filterTermsObj: terms,
                    taxonomies: taxonomies
                });
            });
        }

        filterTaxonomy() {
            const { postType } = this.props.attributes;
            let postTaxonomiesOptions = [],
                taxonomies = this.state.taxonomiesObj,
                taxonomyKey = Object.keys(taxonomies);
            taxonomyKey.forEach(function (key) {
                if (postType === taxonomies[key].types[0]) {
                    postTaxonomiesOptions.push({
                        label: __(taxonomies[key].name),
                        value: __(taxonomies[key].slug)
                    });
                }
            });
            this.setState({ taxonomiesList: postTaxonomiesOptions });
        }

        filterTerms(value, taxonomy) {
            let filterTerms = {};
            this.state.taxonomies.map(tax => {
                if (taxonomy === tax) {
                    filterTerms[tax] = this.state.termsObj[tax].filter(
                        term => -1 < term.name.toLowerCase().indexOf(value.toLowerCase())
                    );
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
            const {
                layout,
                itemToFetch,
                listingPage,
                postType,
                taxonomies,
                terms,
                orderBy,
            } = attributes;

            let isCheckedTerms = {};
            if (! this.isEmpty(terms) && terms.constructor !== Object) {
                isCheckedTerms = JSON.parse(terms);
            }

            return (
                <Fragment>
                    <InspectorControls>
                        <PanelBody title={__('Data Settings ')} initialOpen={true} className="range-setting">
                            <ToggleControl
                                label={__('Is Listing Page?')}
                                checked={listingPage}
                                help={__('Note: This option only work in nabashow-lv theme.')}
                                onChange={() => setAttributes({ listingPage: ! listingPage, layout: 'without-title' }) }
                            />

                            { ! listingPage &&
                            <div>
                                <label>Layout</label>
                                <ul className="ss-off-options">
                                    <li className={'without-title' === layout ? 'active ' : ''} onClick={() => setAttributes({ layout: 'without-title' }) }>{partnerSponser1}</li>
                                    <li className={'with-title' === layout ? 'active ' : ''} onClick={() => setAttributes({ layout: 'with-title' }) }>{partnerSponser2}</li>
                                </ul>
                            </div>
                            }

                            <div className="inspector-field inspector-field-Numberofitems ">
                                <label className="inspector-mb-0">Number of items</label>
                                <RangeControl
                                    value={itemToFetch}
                                    min={1}
                                    max={100}
                                    onChange={(item) => { setAttributes({ itemToFetch: parseInt(item) }); }}
                                />
                            </div>
                            <SelectControl
                                label={__('Order by')}
                                value={orderBy}
                                options={[
                                        { label: __('Newest to Oldest'), value: 'date' },
                                        { label: __('Menu Order'), value: 'menu_order' },
                                        { label: __('Random'), value: 'rand' },
                                    ]}
                                onChange={ (value) => { setAttributes({ orderBy: value }); }}
                            />
                            {0 < this.state.taxonomiesList.length && (
                                <Fragment>
                                    <label> {__('Select Taxonomy')}</label>
                                    <div className="fix-height-select">
                                        {this.state.taxonomiesList.map((taxonomy, index) => (
                                            <Fragment key={index}>
                                                <CheckboxControl
                                                    checked={-1 < taxonomies.indexOf(taxonomy.value)}
                                                    label={taxonomy.label}
                                                    name="taxonomy[]"
                                                    value={taxonomy.value}
                                                    onChange={isChecked => {
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
                                                            }
                                                        }
                                                        if ( tempTerms.constructor === Object ) {
                                                            tempTerms = JSON.stringify(tempTerms);
                                                        }
                                                        this.props.setAttributes({ terms: tempTerms, taxonomies: tempTaxonomies });
                                                        this.setState({ taxonomies: tempTaxonomies });
                                                    }}
                                                />
                                            </Fragment>
                                        ))}
                                    </div>
                                </Fragment>
                            )}

                            {0 < this.state.taxonomies.length && (
                                <Fragment>
                                    {this.state.taxonomies.map(
                                        (taxonomy, index) =>
                                            undefined !== this.state.filterTermsObj[taxonomy] && (
                                                <div key={index}>
                                                    <label> {__(taxonomy)} </label>
                                                    <div className="search-cat-side">
                                                        {7 < this.state.termsObj[taxonomy].length && (
                                                            <TextControl
                                                                type="string"
                                                                name={taxonomy}
                                                                placeHolder={`Search ${taxonomy}`}
                                                                onChange={value =>
                                                                    this.filterTerms(value, taxonomy)
                                                                }
                                                            />
                                                        )}
                                                    </div>
                                                    <div className="fix-height-select">
                                                        {this.state.filterTermsObj[taxonomy].map(
                                                            (term, index) => (
                                                                <Fragment key={index}>
                                                                    <CheckboxControl
                                                                        checked={
                                                                            isCheckedTerms[taxonomy] !== undefined &&
                                                                            -1 <
                                                                            isCheckedTerms[taxonomy].indexOf(
                                                                                term.slug
                                                                            )
                                                                        }
                                                                        label={term.name}
                                                                        name={`${taxonomy}[]`}
                                                                        value={term.slug}
                                                                        onChange={isChecked => {
                                                                            let index,
                                                                                tempTerms = terms;
                                                                            if (! this.isEmpty(tempTerms)) {
                                                                                tempTerms = JSON.parse(tempTerms);
                                                                            }
                                                                            if (isChecked) {
                                                                                if (tempTerms[taxonomy] === undefined) {
                                                                                    tempTerms[taxonomy] = [term.slug];
                                                                                } else {
                                                                                    tempTerms[taxonomy].push(term.slug);
                                                                                }
                                                                            } else {
                                                                                index = tempTerms[taxonomy].indexOf(
                                                                                    term.slug
                                                                                );
                                                                                tempTerms[taxonomy].splice(index, 1);
                                                                            }

                                                                            tempTerms = JSON.stringify(tempTerms);
                                                                            this.props.setAttributes({
                                                                                terms: tempTerms
                                                                            });
                                                                        }}
                                                                    />
                                                                </Fragment>
                                                            )
                                                        )}
                                                    </div>
                                                </div>
                                            )
                                    )}
                                </Fragment>
                            )}
                        </PanelBody>
                    </InspectorControls>
                    <div>
                        <ServerSideRender
                            block="mys/sponsors-partners"
                            attributes={{
                                layout: layout,
                                itemToFetch: itemToFetch,
                                postType: postType,
                                orderBy: orderBy,
                                taxonomies: taxonomies,
                                terms: terms,
                                listingPage: listingPage
                            }}
                        />
                    </div>
                </Fragment>
            );
        }
    }

    const blockAttrs = {
        layout: {
            type: 'string',
            default: 'without-title'
        },
        itemToFetch: {
            type: 'number',
            default: 10
        },
        listingPage: {
            type: 'boolean',
            default: false
        },
        postType: {
            type: 'string',
            default: 'sponsors'
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
    };
    registerBlockType('mys/sponsors-partners', {
        title: __('Sponsors and Partners'),
        icon: 'lock',
        category: 'mysgb',
        keywords: [__('sponsors'), __('partners')],
        attributes: blockAttrs,
        edit: MYSSponsorsPartners,
        save() {
            return null;
        },
    });
})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);
