import { latestShowNews1, latestShowNews2, latestShowNews3 } from '../icons';

(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    const { __ } = wpI18n;
    const { Component, Fragment } = wpElement;
    const { registerBlockType } = wpBlocks;
    const { InspectorControls } = wpEditor;
    const {
        PanelBody,
        Disabled,
        SelectControl,
        TextControl,
        ServerSideRender,
        CheckboxControl,
        RangeControl,
        PanelRow
    } = wpComponents;

    class NabLatestShow extends Component {
        constructor() {
            super(...arguments);
            this.state = {
                postTypeList: [],
                taxonomiesList: [],
                taxonomies: [],
                taxonomiesObj: {},
                termsObj: {},
                filterTermsObj: {},
                isDisable: false
            };
        }

        componentWillMount() {
            const { taxonomies } = this.props.attributes;
            let postTypeKey,
                postOptions = [],
                excludePostTypes = ['attachment', 'page', 'wp_block'];

            // Fetch all post types
            wp.apiFetch({ path: '/wp/v2/types' }).then(postTypes => {
                postTypeKey = Object.keys(postTypes).filter(
                    postType => ! excludePostTypes.includes(postType)
                );
                postTypeKey.forEach(function (key) {
                    postOptions.push({
                        label: __(postTypes[key].name),
                        value: __(postTypes[key].slug)
                    });
                });
                this.setState({ postTypeList: postOptions });
            });

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

        componentDidUpdate(prevProps) {
            const {
                attributes: { postType }
            } = this.props;
            if (postType !== prevProps.attributes.postType) {
                this.filterTaxonomy();
            }
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
                itemToFetch,
                postType,
                postLayout,
                taxonomies,
                terms,
                orderBy
            } = attributes;

            let isCheckedTerms = {};
            if (! this.isEmpty(terms)) {
                isCheckedTerms = JSON.parse(terms);
            }

            let input = <div className="inspector-field inspector-field-Numberofitems ">
                <label className="inspector-mb-0">Number of items</label>
                <RangeControl
                    value={itemToFetch}
                    min={1}
                    max={20}
                    onChange={(item) => { setAttributes({ itemToFetch: parseInt(item) }); this.setState({ bxinit: true, isDisable: true }); }}
                />
            </div>;

            return (
                <Fragment>
                    <InspectorControls>
                        <PanelBody
                            title={__('Data Settings ')}
                            initialOpen={true}
                            className="range-setting"
                        >
                            {input}
                            <div>
                                <label>Select Layout</label>
                                <PanelRow>
                                    <ul className="layout-options">
                                        <li className={'default' === postLayout ? 'active' : ''} onClick={() => setAttributes({ postLayout: 'default' })}>{latestShowNews1}</li>
                                        <li className={'left' === postLayout ? 'active' : ''} onClick={() => setAttributes({ postLayout: 'left' })}>{latestShowNews3}</li>
                                        <li className={'top' === postLayout ? 'active full' : 'full'} onClick={() => setAttributes({ postLayout: 'top' })}>{latestShowNews2}</li>
                                    </ul>
                                </PanelRow>
                            </div>
                            <SelectControl
                                label={__('Order by')}
                                value={orderBy}
                                options={[{ label: __('Newest to Oldest'), value: 'date' },
                                { label: __('Menu Order'), value: 'menu_order' },
                                ]}
                                onChange={value => {
                                    setAttributes({ orderBy: value });
                                }}
                            />
                            <SelectControl
                                label={__('Select Post Type')}
                                value={postType}
                                options={this.state.postTypeList}
                                onChange={(value) => { setAttributes({ postType: value, taxonomies: [], terms: {} }); this.setState({ taxonomies: [] }); }}
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
                                                        this.props.setAttributes({
                                                            terms: tempTerms,
                                                            taxonomies: tempTaxonomies
                                                        });
                                                        this.setState({
                                                            taxonomies: tempTaxonomies
                                                        });
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
                    <div className>
                        <ServerSideRender
                            block="nab/latest-show"
                            attributes={{
                                itemToFetch: itemToFetch,
                                postType: postType,
                                orderBy: orderBy,
                                taxonomies: taxonomies,
                                terms: terms,
                                postLayout: postLayout
                            }}
                        />
                    </div>
                </Fragment>
            );
        }
    }

    const blockAttrs = {
        itemToFetch: {
            type: 'number',
            default: 1
        },
        postType: {
            type: 'string',
            default: 'post'
        },
        postLayout: {
            type: 'string',
            default: 'default'
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
    registerBlockType('nab/latest-show', {
        title: __('Latest show news'),
        icon: 'lock',
        category: 'nabshow',
        keywords: [__('latest show'), __('news'), __('show')],
        attributes: blockAttrs,
        edit: NabLatestShow,
        save() {
            return null;
        },
    });
})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);
