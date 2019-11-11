import { latestShowNews1, latestShowNews2, latestShowNews3 } from '../icons';

(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    const { __ } = wpI18n;
    const { Component, Fragment } = wpElement;
    const { registerBlockType } = wpBlocks;
    const { InspectorControls } = wpEditor;
    const { PanelBody, SelectControl, TextControl, ServerSideRender, CheckboxControl, RangeControl, PanelRow } = wpComponents;

    const latestNewsBlockIcon = (
        <svg width="150px" height="150px" viewBox="222.64 222.641 150 150" enable-background="new 222.64 222.641 150 150">
            <path fill="#0F6CB6" d="M361.149,232.16H257.783c-3.932,0-7.13,3.199-7.13,7.131v10.825h-16.521c-3.932,0-7.131,3.199-7.131,7.131
                v91.76c0,7.627,6.18,13.837,13.796,13.893h0.028c0.025,0.001,0.047,0.003,0.072,0.003h73.208c1.143,0,2.07-0.926,2.07-2.069
                c0-1.143-0.928-2.07-2.07-2.07h-63.323c2.478-2.51,4.011-5.957,4.011-9.756v-48.396c0-1.143-0.927-2.069-2.07-2.069
                c-1.144,0-2.069,0.926-2.069,2.069v48.396c0,5.361-4.348,9.726-9.704,9.755c-0.018,0-0.035-0.002-0.053-0.002
                c-5.38-0.001-9.757-4.376-9.757-9.753v-91.76c0-1.649,1.342-2.992,2.992-2.992h16.521v38.63c0,1.144,0.926,2.07,2.07,2.07
                c1.143,0,2.07-0.926,2.07-2.07v-53.595c0-1.65,1.342-2.992,2.991-2.992h103.365c1.65,0,2.992,1.342,2.992,2.992v109.717
                c0,5.38-4.377,9.756-9.757,9.756h-32.553c-1.144,0-2.069,0.927-2.069,2.069c0,1.145,0.926,2.07,2.069,2.07h32.554
                c7.662,0,13.896-6.233,13.896-13.896V239.291C368.28,235.359,365.081,232.16,361.149,232.16z"/>
            <path fill="#0F6CB6" d="M272.342,314.738h28.383c2.7,0,4.897-2.197,4.897-4.897v-28.384c0-2.7-2.197-4.896-4.897-4.896h-28.383
                c-2.7,0-4.897,2.197-4.897,4.896v28.384C267.445,312.541,269.642,314.738,272.342,314.738z M271.584,281.457
                c0-0.418,0.34-0.757,0.758-0.757h28.383c0.418,0,0.758,0.339,0.758,0.757v28.384c0,0.417-0.34,0.759-0.758,0.759h-28.383
                c-0.418,0-0.758-0.342-0.758-0.759V281.457z"/>
            <path fill="#0F6CB6" d="M313.146,280.699h38.41c1.143,0,2.07-0.926,2.07-2.069c0-1.144-0.928-2.07-2.07-2.07h-38.41
                c-1.143,0-2.069,0.926-2.069,2.07C311.076,279.773,312.003,280.699,313.146,280.699z"/>
            <path fill="#0F6CB6" d="M313.146,297.719h38.41c1.143,0,2.07-0.927,2.07-2.07c0-1.144-0.928-2.069-2.07-2.069h-38.41
                c-1.143,0-2.069,0.926-2.069,2.069C311.076,296.792,312.003,297.719,313.146,297.719z"/>
            <path fill="#0F6CB6" d="M313.146,314.738h38.41c1.143,0,2.07-0.928,2.07-2.07s-0.928-2.069-2.07-2.069h-38.41
                c-1.143,0-2.069,0.926-2.069,2.069C311.076,313.811,312.003,314.738,313.146,314.738z"/>
            <path fill="#0F6CB6" d="M269.515,331.757h82.041c1.143,0,2.07-0.926,2.07-2.07c0-1.142-0.928-2.069-2.07-2.069h-82.041
                c-1.142,0-2.069,0.927-2.069,2.069C267.445,330.831,268.373,331.757,269.515,331.757z"/>
            <path fill="#0F6CB6" d="M269.515,348.776h82.041c1.143,0,2.07-0.926,2.07-2.069s-0.928-2.07-2.07-2.07h-82.041
                c-1.142,0-2.069,0.927-2.069,2.07S268.373,348.776,269.515,348.776z"/>
            <path fill="#0F6CB6" d="M267.498,265.97v-21.868c0-0.45,0.213-0.792,0.641-1.027c0.427-0.236,0.944-0.354,1.55-0.354
                c0.81,0,1.426,0.146,1.854,0.439c0.426,0.292,0.898,0.921,1.416,1.886l6.502,12.569v-13.546c0-0.449,0.213-0.786,0.64-1.011
                c0.426-0.225,0.943-0.338,1.55-0.338c0.606,0,1.123,0.113,1.549,0.338c0.427,0.225,0.641,0.562,0.641,1.011v21.901
                c0,0.428-0.22,0.765-0.658,1.011c-0.438,0.248-0.949,0.371-1.533,0.371c-1.191,0-2.034-0.46-2.527-1.382l-7.245-13.545v13.545
                c0,0.428-0.219,0.764-0.656,1.011c-0.438,0.248-0.95,0.371-1.534,0.371c-0.605,0-1.123-0.123-1.549-0.371
                C267.711,266.734,267.498,266.398,267.498,265.97z"/>
            <path fill="#0F6CB6" d="M287.884,265.97v-21.868c0-0.427,0.191-0.763,0.573-1.011c0.381-0.247,0.83-0.371,1.348-0.371h11.996
                c0.448,0,0.792,0.192,1.027,0.574s0.354,0.82,0.354,1.314c0,0.539-0.124,1-0.371,1.381c-0.248,0.383-0.585,0.573-1.011,0.573h-9.536
                v6.739h5.122c0.426,0,0.763,0.174,1.011,0.522c0.247,0.348,0.371,0.758,0.371,1.23c0,0.427-0.118,0.814-0.354,1.163
                c-0.236,0.348-0.578,0.521-1.027,0.521h-5.122v6.773h9.536c0.426,0,0.763,0.191,1.011,0.572c0.247,0.383,0.371,0.843,0.371,1.382
                c0,0.494-0.118,0.932-0.354,1.314c-0.235,0.382-0.579,0.572-1.027,0.572h-11.996c-0.518,0-0.966-0.123-1.347-0.37
                C288.075,266.734,287.884,266.398,287.884,265.97z"/>
            <path fill="#0F6CB6" d="M305.373,244.473c0-0.472,0.303-0.882,0.909-1.23s1.235-0.523,1.887-0.523c0.81,0,1.292,0.292,1.448,0.876
                l5.325,18.264l2.864-11.726c0.201-0.81,0.92-1.214,2.155-1.214c1.213,0,1.921,0.404,2.123,1.214l2.864,11.726l5.323-18.264
                c0.157-0.584,0.641-0.876,1.45-0.876c0.651,0,1.279,0.175,1.886,0.523c0.607,0.348,0.91,0.758,0.91,1.23
                c0,0.135-0.022,0.27-0.067,0.404l-6.672,21.194c-0.337,0.99-1.292,1.483-2.863,1.483c-0.674,0-1.281-0.13-1.819-0.388
                c-0.539-0.258-0.866-0.623-0.978-1.095l-2.156-9.097l-2.19,9.097c-0.113,0.472-0.438,0.837-0.978,1.095
                c-0.539,0.258-1.146,0.388-1.819,0.388c-0.696,0-1.313-0.13-1.853-0.388c-0.54-0.258-0.877-0.623-1.012-1.095l-6.672-21.194
                C305.395,244.742,305.373,244.607,305.373,244.473z"/>
            <path fill="#0F6CB6" d="M335.631,262.477c0-0.516,0.196-1.039,0.59-1.567c0.393-0.527,0.836-0.791,1.331-0.791
                c0.291,0,0.623,0.14,0.994,0.42c0.37,0.279,0.729,0.589,1.078,0.927c0.348,0.338,0.848,0.648,1.5,0.928
                c0.65,0.28,1.37,0.419,2.155,0.419c1.079,0,1.977-0.247,2.696-0.742c0.719-0.494,1.078-1.223,1.078-2.189
                c0-0.675-0.197-1.275-0.59-1.803c-0.393-0.527-0.91-0.966-1.55-1.314s-1.342-0.686-2.105-1.011
                c-0.765-0.325-1.533-0.691-2.309-1.095c-0.775-0.404-1.482-0.859-2.122-1.365c-0.641-0.506-1.158-1.179-1.551-2.022
                c-0.393-0.842-0.589-1.803-0.589-2.88c0-1.208,0.241-2.275,0.725-3.198c0.482-0.924,1.128-1.642,1.937-2.155
                c0.809-0.513,1.673-0.889,2.595-1.128c0.92-0.239,1.898-0.36,2.932-0.36c0.583,0,1.201,0.041,1.854,0.122
                c0.65,0.081,1.342,0.213,2.072,0.398c0.729,0.184,1.324,0.473,1.785,0.864c0.46,0.393,0.691,0.854,0.691,1.385
                c0,0.5-0.158,1.018-0.472,1.552c-0.314,0.535-0.741,0.801-1.28,0.801c-0.203,0-0.754-0.213-1.651-0.64
                c-0.899-0.427-1.898-0.64-2.999-0.64c-1.214,0-2.151,0.23-2.813,0.691c-0.663,0.461-0.995,1.095-0.995,1.904
                c0,0.652,0.27,1.219,0.81,1.702c0.539,0.483,1.208,0.876,2.005,1.179c0.797,0.303,1.662,0.686,2.595,1.146
                c0.932,0.46,1.797,0.96,2.595,1.499c0.796,0.539,1.466,1.319,2.005,2.341c0.539,1.023,0.809,2.219,0.809,3.589
                c0,2.303-0.736,4.082-2.207,5.333c-1.473,1.251-3.409,1.877-5.813,1.877c-2.135,0-3.965-0.439-5.492-1.315
                C336.395,264.466,335.631,263.511,335.631,262.477z"/>
        </svg>
    );

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
            if (! this.isEmpty(terms) && terms.constructor !== Object) {
                isCheckedTerms = JSON.parse(terms);
            }

            return (
                <Fragment>
                    <InspectorControls>
                        <PanelBody
                            title={__('Data Settings ')}
                            initialOpen={true}
                            className="range-setting"
                        >
                            <div className="inspector-field inspector-field-Numberofitems ">
                                <label className="inspector-mb-0">Number of items</label>
                                <RangeControl
                                    value={itemToFetch}
                                    min={1}
                                    max={20}
                                    onChange={(item) => { setAttributes({ itemToFetch: parseInt(item) }); }}
                                />
                            </div>
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
                                                        if (tempTerms.constructor === Object) {
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
        icon: { src: latestNewsBlockIcon },
        category: 'nabshow',
        keywords: [__('latest show'), __('news'), __('show')],
        attributes: blockAttrs,
        edit: NabLatestShow,
        save() {
            return null;
        },
    });
})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);
