(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    const { __ } = wpI18n;
    const { Component, Fragment } = wpElement;
    const { registerBlockType } = wpBlocks;
    const { InspectorControls } = wpEditor;
    const { PanelBody, SelectControl } = wpComponents;

    const sessionFilterBlockIcon = (
        <svg width="150px" height="150px" viewBox="181 181 150 150" enable-background="new 181 181 150 150">
            <g id="Page-1">
                <g id="_x30_30---Image-Filters">
                    <path id="Shape" fill="#92c83e" d="M313.443,208.694c-0.012-11.192-9.081-20.261-20.273-20.274h-81.096
                        c-11.192,0.013-20.261,9.082-20.274,20.274v94.612c0.013,11.192,9.082,20.262,20.274,20.274h65.328
                        c15.634,0.026,30.035-8.487,37.547-22.199c7.511-13.711,6.935-30.431-1.505-43.592V208.694z M212.074,319.075
                        c-8.705-0.011-15.759-7.064-15.769-15.77v-94.612c0.01-8.705,7.064-15.758,15.769-15.769h81.096
                        c8.705,0.01,15.759,7.064,15.769,15.769v43.251c-1.396-1.545-2.901-2.986-4.505-4.314v-38.938
                        c-0.008-6.217-5.046-11.256-11.264-11.263h-81.096c-6.217,0.007-11.256,5.046-11.263,11.263v63.075
                        c0.007,6.218,5.046,11.256,11.263,11.264h22.642c0.457,9.065,3.798,17.747,9.538,24.779h-9.653c-1.244,0-2.253,1.009-2.253,2.253
                        s1.009,2.252,2.253,2.252h13.966c2.948,2.7,6.258,4.975,9.835,6.759H212.074z M234.715,278.527h-22.642
                        c-3.732,0-6.758-3.026-6.758-6.759v-3.572l23.653-23.653l4.699,4.699c1.759,1.759,4.611,1.759,6.371,0l33.984-33.984
                        l25.905,25.906v3.291c-12.832-8.014-28.948-8.632-42.356-1.626C244.162,249.834,235.466,263.417,234.715,278.527z
                        M299.928,234.793l-22.72-22.72c-1.76-1.759-4.611-1.759-6.371,0l-33.984,33.983l-4.699-4.699c-1.782-1.703-4.588-1.703-6.371,0
                        l-20.468,20.467v-53.131c0-3.732,3.025-6.758,6.758-6.758h81.096c3.732,0,6.758,3.026,6.758,6.758V234.793z M277.401,319.075
                        c-21.15,0-38.295-17.146-38.295-38.296s17.146-38.295,38.295-38.295c21.149,0,38.295,17.145,38.295,38.295
                        C315.673,301.92,298.541,319.051,277.401,319.075z"/>
                    <path id="Shape_1_" fill="#92c83e" d="M221.084,307.812h-6.758c-1.244,0-2.253,1.009-2.253,2.253s1.009,2.252,2.253,2.252h6.758
                        c1.244,0,2.253-1.008,2.253-2.252S222.329,307.812,221.084,307.812z"/>
                    <path id="Shape_2_" fill="#92c83e" d="M223.337,208.694c-6.221,0-11.264,5.043-11.264,11.264c0,6.22,5.043,11.263,11.264,11.263
                        c6.22,0,11.263-5.043,11.263-11.263C234.593,213.74,229.555,208.702,223.337,208.694z M223.337,226.715
                        c-3.732,0-6.758-3.026-6.758-6.758c0-3.732,3.026-6.758,6.758-6.758c3.732,0,6.758,3.026,6.758,6.758
                        C230.095,223.689,227.069,226.715,223.337,226.715z"/>
                    <path id="Shape_3_" fill="#92c83e" d="M277.401,253.748c-13.433,0-27.032,3.868-27.032,11.263
                        c0.044,1.726,0.774,3.362,2.027,4.548l14.915,17.544c0.694,0.812,1.077,1.845,1.079,2.913v11.659
                        c-0.003,1.941,1.238,3.666,3.079,4.28l9.011,3.001c0.459,0.151,0.938,0.228,1.422,0.225c2.488,0,4.505-2.017,4.505-4.505v-14.66
                        c-0.003-1.073,0.378-2.112,1.074-2.929l14.925-17.525c1.254-1.188,1.983-2.824,2.027-4.551
                        C304.434,257.615,290.834,253.748,277.401,253.748L277.401,253.748z M254.875,265.011c0-2.689,8.984-6.758,22.527-6.758
                        s22.526,4.068,22.526,6.758c-0.078,0.653-0.419,1.246-0.943,1.642l-0.017-0.011l-0.071,0.083
                        c-2.708,2.424-10.628,5.044-21.495,5.044s-18.787-2.62-21.495-5.044l-0.072-0.083l-0.016,0.011
                        C255.294,266.257,254.953,265.664,254.875,265.011z M284.054,284.184c-1.384,1.628-2.145,3.694-2.147,5.832v14.662l-9.011-3.003
                        v-11.659c0-2.139-0.761-4.208-2.146-5.837l-8.187-9.63c9.76,2.292,19.918,2.292,29.677,0L284.054,284.184z"/>
                </g>
            </g>
        </svg>
    );

    class MYSSessionsFilter extends Component {
        constructor() {
            super(...arguments);
            this.state = {
                taxonomiesObj: {},
                taxonomiesList: [],
                termsObj: {},
            };
        }

        componentWillMount() {

            // Fetch all taxonomies
            wp.apiFetch({ path: '/wp/v2/taxonomies' }).then((taxonomies) => {
                this.setState({ taxonomiesObj: taxonomies });
                this.filterTaxonomy();
            });

            // Fetch all terms
            wp.apiFetch({ path: '/nab_api/request/all_terms' }).then((terms) => {
                this.setState({ termsObj: terms });
                this.filterTerms();
            });

        }

        filterTaxonomy() {
            let postTaxonomiesOptions = [],
                taxonomies = this.state.taxonomiesObj,
                taxonomyKey = Object.keys(taxonomies);
            taxonomyKey.forEach(function (key) {
                if ('sessions' === taxonomies[key].types[0]) {
                    postTaxonomiesOptions.push({ label: __(taxonomies[key].name), value: __(taxonomies[key].slug) });
                }
            });
            this.setState({ taxonomiesList: postTaxonomiesOptions });
        }

        filterTerms(data) {
            const { attributes: { taxonomy }, setAttributes } = this.props;

            data = data ? data : taxonomy;

            let tempTermOptions = [],
                termLabel = this.state.taxonomiesObj[data].name ? this.state.taxonomiesObj[data].name : data;


            tempTermOptions.push({ label: 'Select ' + termLabel, value: '' });

            if (this.state.termsObj[data] !== undefined) {
                this.state.termsObj[data].map((term) => {
                    tempTermOptions.push({ label: term.name, value: term.slug });
                });
            }
            setAttributes({ termOptions: tempTermOptions, taxonomy: data });
        }

        render() {
            const { taxonomy, termOptions } = this.props.attributes;
            return (
                <Fragment>
                    <InspectorControls>
                        <PanelBody title={__('Data Settings')} className="range-setting">
                            <SelectControl
                                label={'Select Taxonomy for filter category'}
                                value={taxonomy}
                                options={this.state.taxonomiesList}
                                onChange={(value) => { this.filterTerms(value); }}
                            />
                        </PanelBody>
                    </InspectorControls>
                    <div className="filter-block main-filter">
                        <div className="feature-btn">
                            <input type="button" className="featured-btn" value="Featured" />
                        </div>
                        <div className="search-box">
                            <label>Keyword</label>
                            <div className="search-item">
                                <input className="search" type="text" placeholder="Filter by keyword..." />
                            </div>
                        </div>
                        <div className="keyword">
                            <label>Category</label>
                            <div>
                                <select id="session-category-drp" className="session-category-drp">
                                    {termOptions.map((term) => (
                                        <option value={term.value}>{term.label}</option>
                                    )
                                    )
                                    }
                                </select>
                            </div>
                        </div>
                    </div>
                </Fragment>
            );
        }
    }

    const allAttr = {
        taxonomy: {
            type: 'string',
            default: 'tracks'
        },
        termOptions: {
            type: 'array',
            default: []
        }
    };


    registerBlockType('mys/sessions-filters', {
        title: __('Session Filters'),
        icon: { src: sessionFilterBlockIcon },
        category: 'mysgb',
        keywords: [__('session'), __('filter')],
        attributes: allAttr,
        edit: MYSSessionsFilter,
        save: function ({ attributes }) {
            const { termOptions } = attributes;
            return (
                <div className="filter-block main-filter">
                    <div className="feature-btn">
                        <input type="button" className="featured-btn" value="Featured" />
                    </div>
                    <div className="search-box">
                        <label>Keyword</label>
                        <div className="search-item">
                            <input className="search" type="text" placeholder="Filter by keyword..." />
                        </div>
                    </div>
                    <div className="keyword">
                        <label>Category</label>
                        <div>
                            <select id="session-category-drp" className="session-category-drp">
                                {termOptions.map((term) => (
                                    <option value={term.value}>{term.label}</option>
                                )
                                )
                                }
                            </select>
                        </div>
                    </div>
                </div>
            );
        },
    });

})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);