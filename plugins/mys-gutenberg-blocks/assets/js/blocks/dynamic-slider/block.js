import { sliderArrow1, sliderArrow2, sliderArrow3, sliderArrow4, sliderArrow5, sliderArrow6 } from '../icons';

(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    const { __ } = wpI18n;
    const { Component, Fragment } = wpElement;
    const { registerBlockType } = wpBlocks;
    const { InspectorControls } = wpEditor;
    const { PanelBody, Disabled, ToggleControl, SelectControl, TextControl, ServerSideRender, CheckboxControl, RangeControl } = wpComponents;

    const dynamicSliderBlockIcon = (
        <svg width="150px" height="150px" viewBox="181 181 150 150" enable-background="new 181 181 150 150">
            <path fill="#92c83e" d="M321.244,193H190.755c-3.721,0-6.75,3.028-6.75,6.75v116.999c0,1.244,1.006,2.25,2.25,2.25h139.488
                c1.244,0,2.25-1.006,2.25-2.25V199.75C327.994,196.029,324.966,193,321.244,193z M188.506,206.5h134.988v108H188.506V206.5z
                M190.755,197.5h2.295c-1.242,0-2.236,1.006-2.236,2.25s1.017,2.25,2.261,2.25c1.242,0,2.25-1.006,2.25-2.25s-1.008-2.25-2.25-2.25
                h6.722c-1.242,0-2.236,1.006-2.236,2.25s1.017,2.25,2.261,2.25c1.242,0,2.25-1.006,2.25-2.25s-1.008-2.25-2.25-2.25h6.731
                c-1.242,0-2.236,1.006-2.236,2.25s1.017,2.25,2.261,2.25c1.242,0,2.25-1.006,2.25-2.25s-1.008-2.25-2.25-2.25h114.666
                c1.242,0,2.25,1.008,2.25,2.25V202H206.576h-6.756h-6.747h-4.567v-2.25C188.506,198.508,189.514,197.5,190.755,197.5L190.755,197.5z
                "/>
            <path fill="#92c83e" d="M316.745,210.999H195.257c-1.244,0-2.25,1.006-2.25,2.25v76.498c0,1.244,1.006,2.25,2.25,2.25h121.488
                c1.244,0,2.25-1.006,2.25-2.25v-76.498C318.995,212.005,317.989,210.999,316.745,210.999z M208.756,282.993
                c0-2.466,1.998-4.469,4.455-4.493c0.016,0,0.029,0.009,0.045,0.009h3.582l1.577,1.575c0.022,0.022,0.049,0.029,0.072,0.048
                c0.173,0.157,0.364,0.285,0.576,0.382c0.063,0.029,0.126,0.059,0.191,0.081c0.238,0.086,0.488,0.144,0.747,0.146h0.004h0.002
                c0.005,0,0.007-0.003,0.011-0.003c0.315-0.002,0.621-0.083,0.914-0.218c0.027-0.011,0.054-0.005,0.079-0.018l3.494-1.744
                l3.494,1.744c0.024,0.013,0.052,0.007,0.079,0.018c0.292,0.135,0.601,0.216,0.914,0.218c0.004,0,0.006,0.003,0.011,0.003h0.002
                h0.004c0.259-0.003,0.509-0.061,0.747-0.146c0.065-0.022,0.128-0.052,0.191-0.081c0.211-0.097,0.403-0.225,0.576-0.382
                c0.022-0.021,0.05-0.027,0.072-0.048l1.577-1.575h3.582c0.016,0,0.029-0.009,0.045-0.009c2.459,0.024,4.455,2.027,4.455,4.493v4.504
                h-31.497V282.993z M222.255,233.508h9v4.5c0,1.245,1.005,2.25,2.25,2.25c2.484,0,4.504,2.018,4.504,4.502v1.305l-0.704-0.668
                c-0.009-0.009-0.022-0.011-0.032-0.02c-0.704-0.662-1.762-0.844-2.641-0.34c-0.039,0.022-3.876,2.175-9.251,2.175
                c-5.573,0-11.217-2.266-11.276-2.288c-0.909-0.378-1.899-0.09-2.513,0.605l-0.585,0.551v-1.323
                C211.006,238.555,216.052,233.508,222.255,233.508L222.255,233.508z M211.006,252.272l2.819-2.664
                c2.241,0.768,6.828,2.104,11.555,2.104c4.459,0,7.992-1.192,9.913-2.016l2.713,2.576l-0.002,3.737
                c0,7.444-6.054,13.499-13.499,13.499s-13.499-6.055-13.499-13.499V252.272z M224.505,274.005c1.555,0,3.058-0.221,4.5-0.594v1.903
                l-0.443,0.441l-3.049-1.523c-0.047-0.024-0.104-0.021-0.15-0.043c-0.144-0.059-0.291-0.09-0.443-0.119
                c-0.14-0.027-0.272-0.054-0.412-0.052c-0.14-0.002-0.272,0.027-0.412,0.052c-0.153,0.029-0.301,0.059-0.443,0.119
                c-0.05,0.022-0.104,0.019-0.151,0.043l-3.048,1.523l-0.443-0.441v-1.903C221.447,273.784,222.95,274.005,224.505,274.005
                L224.505,274.005z M314.495,287.497h-69.742v-4.504c0-4.961-4.036-8.997-8.999-8.997c-0.025,0-0.043,0.014-0.065,0.014h-2.185
                v-2.438c5.371-3.121,9-8.921,9-15.565l0.004-11.247c0-4.182-2.88-7.676-6.754-8.682v-4.819c0-1.244-1.005-2.25-2.25-2.25h-11.249
                c-8.682,0-15.749,7.067-15.749,15.749v11.249c0,6.644,3.629,12.444,8.999,15.565v2.438h-2.184c-0.025,0-0.043-0.014-0.065-0.014
                c-4.963,0-9,4.036-9,8.997v4.504h-6.75v-71.999h116.988V287.497z"/>
            <path fill="#92c83e" d="M258.221,249.239h45.027c1.244,0,2.25-1.006,2.25-2.25s-1.006-2.25-2.25-2.25h-45.027
                c-1.244,0-2.25,1.006-2.25,2.25S256.979,249.239,258.221,249.239z"/>
            <path fill="#92c83e" d="M258.221,255.986h45.027c1.244,0,2.25-1.006,2.25-2.25s-1.006-2.25-2.25-2.25h-45.027
                c-1.244,0-2.25,1.005-2.25,2.25S256.979,255.986,258.221,255.986z"/>
            <path fill="#92c83e" d="M258.221,262.738h24.759c1.244,0,2.25-1.006,2.25-2.25s-1.006-2.25-2.25-2.25h-24.759
                c-1.244,0-2.25,1.006-2.25,2.25S256.979,262.738,258.221,262.738z"/>
            <path fill="#92c83e" d="M262.749,237.999c3.722,0,6.75-3.028,6.75-6.75s-3.028-6.749-6.75-6.749c-3.721,0-6.749,3.028-6.749,6.749
                S259.028,237.999,262.749,237.999z M262.749,229c1.242,0,2.25,1.008,2.25,2.25c0,1.242-1.008,2.25-2.25,2.25
                c-1.241,0-2.249-1.008-2.249-2.25C260.5,230.008,261.508,229,262.749,229z"/>
            <path fill="#92c83e" d="M282.993,269.503H258.25c-1.244,0-2.25,1.006-2.25,2.25v6.759c0,1.244,1.006,2.249,2.25,2.249h24.743
                c1.244,0,2.25-1.005,2.25-2.249v-6.759C285.243,270.509,284.237,269.503,282.993,269.503z M280.743,276.262H260.5v-2.259h20.243
                V276.262z"/>
            <path fill="#92c83e" d="M250.846,297.174c-0.88-0.88-2.302-0.88-3.181,0l-4.5,4.499c-0.879,0.88-0.879,2.302,0,3.182l4.5,4.5
                c0.438,0.438,1.015,0.659,1.59,0.659c0.576,0,1.152-0.221,1.591-0.659c0.879-0.88,0.879-2.302,0-3.182l-2.909-2.909l2.909-2.909
                C251.725,299.476,251.725,298.051,250.846,297.174L250.846,297.174z"/>
            <path fill="#92c83e" d="M264.336,297.174c-0.88-0.88-2.302-0.88-3.182,0s-0.88,2.302,0,3.181l2.909,2.909l-2.909,2.909
                c-0.88,0.88-0.88,2.302,0,3.182c0.438,0.438,1.015,0.659,1.591,0.659s1.151-0.221,1.591-0.659l4.499-4.5
                c0.88-0.88,0.88-2.302,0-3.182L264.336,297.174z"/>
        </svg>
    );

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
                    if (0 < jQuery(`#block-${clientId} .nab-dynamic-slider`).length && this.state.bxSliderObj && undefined !== this.state.bxSliderObj.reloadSlider ) {
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
            if (0 < jQuery(`#block-${clientId} .nab-dynamic-slider`).length) {
                const { minSlides, autoplay, infiniteLoop, pager, controls, sliderSpeed, slideWidth, slideMargin } = this.props.attributes;
                const sliderObj = jQuery(`#block-${clientId} .nab-dynamic-slider`).bxSlider({ minSlides: minSlides, maxSlides: minSlides, slideMargin: slideMargin, moveSlides: 1, slideWidth: slideWidth, auto: autoplay, infiniteLoop: infiniteLoop, pager: pager, controls: controls, speed: sliderSpeed, mode: 'horizontal' });
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

            if (this.state.isDisable && sliderActive && ! isNaN( itemToFetch )) {
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
                                                    if ( tempTerms.constructor === Object ) {
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
                                label={__('Display Title')}
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
        icon: { src: dynamicSliderBlockIcon },
        category: 'mysgb',
        keywords: [__('dynamic'), __('slider')],
        attributes: blockAttrs,
        edit: MYSDynamicSlider,
        save() {
            return null;
        },
    });

})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);
