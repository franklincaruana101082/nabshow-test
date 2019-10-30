(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    const { __ } = wpI18n;
    const { Component, Fragment } = wpElement;
    const { registerBlockType } = wpBlocks;
    const { InspectorControls } = wpEditor;
    const { PanelBody, SelectControl } = wpComponents;

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
        icon: 'lock',
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