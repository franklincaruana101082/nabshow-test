import { sliderArrow1, sliderArrow2, sliderArrow3, sliderArrow4, sliderArrow5, sliderArrow6 } from '../icons';

(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    const { __ } = wpI18n;
    const { Component, Fragment } = wpElement;
    const { registerBlockType } = wpBlocks;
    const { InspectorControls } = wpEditor;
    const { PanelBody, Disabled, ToggleControl, SelectControl, TextControl, ServerSideRender, CheckboxControl, RangeControl } = wpComponents;

    class MYSDynamicSlider extends Component {
        constructor() {
            super(...arguments);
            this.state = {
                bxSliderObj: {},
                bxinit: false,
                postTypeList: [],
                taxonomiesList: [],
                taxonomies: [],
                taxonomiesObj: {},
                termsObj: {},
                filterTermsObj: {},
                isDisable: false,
            };

            this.initSlider = this.initSlider.bind(this);
        }

        componentWillMount() {
            const { taxonomies } = this.props.attributes;
            let postTypeKey,
                postOptions = [],
                excludePostTypes = ['attachment', 'wp_block'];

            // Fetch all post types
            wp.apiFetch({ path: '/wp/v2/types' }).then((postTypes) => {
                postTypeKey = Object.keys(postTypes).filter(postType => ! excludePostTypes.includes(postType));
                postTypeKey.forEach(function (key) {
                    postOptions.push({ label: __(postTypes[key].name), value: __(postTypes[key].slug) });
                });
                this.setState({ postTypeList: postOptions });
            });

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

        componentDidMount() {
            this.setState({ bxinit: true });
        }

        componentDidUpdate(prevProps) {
            const { clientId, attributes: { minSlides, autoplay, infiniteLoop, pager, controls, sliderSpeed, postType, slideWidth, sliderActive, slideMargin } } = this.props;
            if (sliderActive) {
                if (this.state.bxinit) {
                    setTimeout(() => this.initSlider(), 500);
                    this.setState({ bxinit: false });
                } else {
                    if (0 < $(`#block-${clientId} .nab-dynamic-slider`).length && this.state.bxSliderObj) {
                        //setTimeout(() => {
                            this.state.bxSliderObj.reloadSlider(
                                {
                                    minSlides: minSlides,
                                    maxSlides: minSlides,
                                    moveSlides: 1,
                                    slideMargin: slideMargin,
                                    slideWidth: slideWidth,
                                    auto: autoplay,
                                    infiniteLoop: infiniteLoop,
                                    pager: pager,
                                    controls: controls,
                                    speed: sliderSpeed,
                                    mode: 'horizontal'
                                }
                            );
                       // }, 1000);
                    }
                    if (postType !== prevProps.attributes.postType) {
                        this.filterTaxonomy();
                        this.setState({ bxinit: true });
                    }
                }
            }
        }


        initSlider() {
            const { clientId } = this.props;
            if (0 < $(`#block-${clientId} .nab-dynamic-slider`).length) {
                const { minSlides, autoplay, infiniteLoop, pager, controls, sliderSpeed, slideWidth, slideMargin } = this.props.attributes;
                const sliderObj = $(`#block-${clientId} .nab-dynamic-slider`).bxSlider({ minSlides: minSlides, maxSlides: minSlides, slideMargin: slideMargin, moveSlides: 1, slideWidth: slideWidth, auto: autoplay, infiniteLoop: infiniteLoop, pager: pager, controls: controls, speed: sliderSpeed, mode: 'horizontal' });
                this.setState({ bxSliderObj: sliderObj, bxinit: false, isDisable: false });
            } else {
                this.setState({ bxinit: true });
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
                minSlides,
                autoplay,
                infiniteLoop,
                pager,
                controls,
                sliderSpeed,
                sliderActive,
                postType,
                taxonomies,
                terms,
                slideWidth,
                orderBy,
                slideMargin,
                displayTitle,
                arrowIcons
            } = attributes;

            var names = [
                { name: sliderArrow1, classnames: 'slider-arrow-1' },
                { name: sliderArrow2, classnames: 'slider-arrow-2' },
                { name: sliderArrow3, classnames: 'slider-arrow-3' },
                { name: sliderArrow4, classnames: 'slider-arrow-4' },
                { name: sliderArrow5, classnames: 'slider-arrow-5' },
                { name: sliderArrow6, classnames: 'slider-arrow-6' }
            ];

            let isCheckedTerms = {};
            if (! this.isEmpty(terms) && terms.constructor !== Object) {
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

            if (this.state.isDisable) {
                input = <Disabled>{input}</Disabled>;
            }

            return (
                <Fragment>
                    <InspectorControls>
                        <PanelBody title={__('Data Settings ')} initialOpen={true} className="range-setting">
                            {input}
                            <SelectControl
                                label={__('Order by')}
                                value={orderBy}
                                options={[
                                    { label: __('Newest to Oldest'), value: 'date' },
                                    { label: __('Menu Order'), value: 'menu_order' },
                                ]}
                                onChange={(value) => { setAttributes({ orderBy: value }); this.setState({ bxinit: true }); }}
                            />
                            <SelectControl
                                label={__('Select Post Type')}
                                value={postType}
                                options={this.state.postTypeList}
                                onChange={(value) => { setAttributes({ postType: value, taxonomies: [], terms: {} }); this.setState({ taxonomies: [] }); }}
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
                                                        }
                                                    }
                                                    if( tempTerms.constructor === Object ) {
                                                      tempTerms = JSON.stringify(tempTerms);
                                                    }
                                                    this.props.setAttributes({ terms: tempTerms, taxonomies: tempTaxonomies });
                                                    this.setState({ taxonomies: tempTaxonomies, bxinit: true });
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
                                                <label>{__(taxonomy)}</label>
                                                <div className="search-cat-side">
                                                    {7 < this.state.termsObj[taxonomy].length &&
                                                        <TextControl
                                                            type="string"
                                                            name={taxonomy}
                                                            placeHolder={`Search ${taxonomy}`}
                                                            onChange={value => this.filterTerms(value, taxonomy)}
                                                        />
                                                    }
                                                </div>
                                                <div className="fix-height-select">

                                                    {this.state.filterTermsObj[taxonomy].map((term, index) => (

                                                        <Fragment key={index}>

                                                            <CheckboxControl checked={isCheckedTerms[taxonomy] !== undefined && -1 < isCheckedTerms[taxonomy].indexOf(term.slug)} label={term.name} name={`${taxonomy}[]`} value={term.slug} onChange={(isChecked) => {

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
                                                                    index = tempTerms[taxonomy].indexOf(term.slug);
                                                                    tempTerms[taxonomy].splice(index, 1);
                                                                }

                                                                tempTerms = JSON.stringify(tempTerms);
                                                                this.props.setAttributes({ terms: tempTerms });
                                                                this.setState({ bxinit: true });
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
                        <PanelBody title={__('Slider Settings ')} initialOpen={false} className="range-setting">
                            <ToggleControl
                                label={__('Slider On/Off')}
                                checked={sliderActive}
                                onChange={() => { setAttributes({ sliderActive: ! sliderActive }); this.setState({ bxinit: ! sliderActive }); }}
                            />
                            <ToggleControl
                                label={__('Display Details')}
                                checked={displayTitle}
                                onChange={() => { setAttributes({ displayTitle: ! displayTitle }); this.setState({ bxinit: true }); }}
                            />
                            {sliderActive &&
                                <Fragment>
                                    <ToggleControl
                                        label={__('Pager')}
                                        checked={pager}
                                        onChange={() => setAttributes({ pager: ! pager })}
                                    />
                                    <ToggleControl
                                        label={__('Controls')}
                                        checked={controls}
                                        onChange={() => setAttributes({ controls: ! controls })}
                                    />
                                    <ToggleControl
                                        label={__('Autoplay')}
                                        checked={autoplay}
                                        onChange={() => setAttributes({ autoplay: ! autoplay })}
                                    />
                                    <ToggleControl
                                        label={__('Infinite Loop')}
                                        checked={infiniteLoop}
                                        onChange={() => setAttributes({ infiniteLoop: ! infiniteLoop })}
                                    />
                                    <div className="inspector-field inspector-field-fontsize ">
                                        <label className="inspector-mb-0">Slide Speed</label>
                                        <RangeControl
                                            value={sliderSpeed}
                                            min={100}
                                            max={1000}
                                            step={1}
                                            onChange={(speed) => setAttributes({ sliderSpeed: parseInt(speed) })}
                                        />
                                    </div>
                                    <div className="inspector-field inspector-field-fontsize ">
                                        <label className="inspector-mb-0">Items to Display</label>
                                        <RangeControl
                                            value={minSlides}
                                            min={1}
                                            max={10}
                                            step={1}
                                            onChange={(slide) => setAttributes({ minSlides: parseInt(slide) })}
                                        />
                                    </div>
                                    <div className="inspector-field inspector-field-fontsize ">
                                        <label className="inspector-mb-0">Slide Width</label>
                                        <RangeControl
                                            value={slideWidth}
                                            min={50}
                                            max={1000}
                                            step={1}
                                            onChange={(width) => setAttributes({ slideWidth: parseInt(width) })}
                                        />
                                    </div>
                                    <div className="inspector-field inspector-field-fontsize ">
                                        <label className="inspector-mb-0">Slide Margin</label>
                                        <RangeControl
                                            value={slideMargin}
                                            min={0}
                                            max={100}
                                            step={1}
                                            onChange={(width) => setAttributes({ slideMargin: parseInt(width) })}
                                        />
                                    </div>
                                </Fragment>
                            }
                        </PanelBody>
                        { sliderActive && controls &&
                            <PanelBody title={__('Slider Arrow')} initialOpen={false} className="range-setting">
                                <ul className="slider-arrow-main">
                                    {names.map((item, index) => (
                                        < Fragment key={index} >
                                            <li
                                                className={`${item.classnames} ${arrowIcons === item.classnames ? 'active' : ''}`}
                                                key={index}
                                                onClick={e => {
                                                    setAttributes({ arrowIcons: item.classnames });
                                                    this.setState({ bxinit: true });
                                                }}
                                            >{item.name}</li>
                                        </Fragment>
                                    ))
                                    }
                                </ul>
                            </PanelBody>
                        }

                    </InspectorControls>
                    <div className={arrowIcons}>
                        <ServerSideRender
                            block="mys/dynamic-slider"
                            attributes={{ itemToFetch: itemToFetch, postType: postType, taxonomies: taxonomies, terms: terms, sliderActive: sliderActive, orderBy: orderBy, displayTitle: displayTitle, arrowIcons: arrowIcons }}
                        />
                    </div>
                </Fragment >
            );
        }
    }
    const blockAttrs = {
        itemToFetch: {
            type: 'number',
            default: 10
        },
        minSlides: {
            type: 'number',
            default: 4
        },
        autoplay: {
            type: 'boolean',
            default: false
        },
        infiniteLoop: {
            type: 'boolean',
            default: true
        },
        pager: {
            type: 'boolean',
            default: false
        },
        controls: {
            type: 'boolean',
            default: true
        },
        sliderSpeed: {
            type: 'number',
            default: 500
        },
        sliderActive: {
            type: 'boolean',
            default: true
        },
        postType: {
            type: 'string',
            default: 'post'
        },
        taxonomies: {
            type: 'array',
            default: []
        },
        terms: {
            type: 'string',
            default: {}
        },
        slideWidth: {
            type: 'number',
            default: 400
        },
        orderBy: {
            type: 'string',
            default: 'date'
        },
        slideMargin: {
            type: 'number',
            default: 30
        },
        displayTitle: {
            type: 'boolean',
            default: false
        },
        arrowIcons: {
            type: 'string',
            default: 'slider-arrow-1'
        }
    };
    registerBlockType('mys/dynamic-slider', {
        title: __('Dynamic Slider'),
        icon: 'slides',
        category: 'mysgb',
        keywords: [__('dynamic'), __('slider')],
        attributes: blockAttrs,
        edit: MYSDynamicSlider,
        save() {
            return null;
        },
    });

})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);
