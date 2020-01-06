import { sliderArrow1, sliderArrow2, sliderArrow3, sliderArrow4, sliderArrow5, sliderArrow6 } from '../icons';

(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    const { __ } = wpI18n;
    const { Component, Fragment } = wpElement;
    const { registerBlockType } = wpBlocks;
    const { InspectorControls } = wpEditor;
    const { PanelBody, Disabled, ToggleControl, SelectControl, TextControl, ServerSideRender, CheckboxControl, RangeControl } = wpComponents;

    const notToBeMissedBlockIcon = (
        <svg width="150px" height="150px" viewBox="266 266 150 150" enable-background="new 266 266 150 150">
            <path fill="#0F6CB6" d="M403.72,325.373h-4.612c-3.82,0-6.918,3.097-6.918,6.918v55.352c0,1.274-1.033,2.307-2.308,2.307h-96.865
                c-1.273,0-2.307-1.032-2.307-2.307v-55.352c0-3.821-3.097-6.918-6.917-6.918h-4.614c-3.82,0-6.919,3.097-6.919,6.918v69.189
                c0,3.821,3.098,6.919,6.919,6.919H403.72c3.82,0,6.919-3.098,6.919-6.919v-69.189C410.639,328.47,407.54,325.373,403.72,325.373z
                M406.026,401.48c0,1.274-1.032,2.306-2.307,2.306H279.179c-1.273,0-2.306-1.031-2.306-2.306v-69.189
                c0-1.274,1.033-2.306,2.306-2.306h4.614c1.273,0,2.305,1.032,2.305,2.306v55.352c0,3.821,3.097,6.919,6.919,6.919h96.865
                c3.822,0,6.92-3.098,6.92-6.919v-55.352c0-1.274,1.032-2.306,2.306-2.306h4.612c1.274,0,2.307,1.032,2.307,2.306V401.48
                L406.026,401.48z"/>
            <path fill="#0F6CB6" d="M323,332.291c0-3.821-3.097-6.918-6.92-6.918h-13.837c-3.821,0-6.92,3.097-6.92,6.918v13.838
                c0,3.821,3.098,6.919,6.92,6.919h13.837c3.823,0,6.92-3.098,6.92-6.919V332.291z M318.387,346.129c0,1.273-1.033,2.306-2.308,2.306
                h-13.837c-1.274,0-2.306-1.032-2.306-2.306v-13.838c0-1.274,1.032-2.306,2.306-2.306h13.837c1.274,0,2.308,1.032,2.308,2.306
                V346.129L318.387,346.129z"/>
            <path fill="#0F6CB6" d="M316.08,357.659h-13.837c-3.821,0-6.919,3.099-6.919,6.92v13.839c0,3.819,3.098,6.917,6.919,6.917h13.837
                c3.823,0,6.92-3.098,6.92-6.917v-13.839C323,360.758,319.902,357.659,316.08,357.659z M318.387,378.418
                c0,1.273-1.033,2.305-2.308,2.305h-13.837c-1.274,0-2.306-1.031-2.306-2.305v-13.839c0-1.274,1.032-2.306,2.306-2.306h13.837
                c1.274,0,2.308,1.032,2.308,2.306V378.418L318.387,378.418z"/>
            <path fill="#0F6CB6" d="M334.531,385.334h13.837c3.821,0,6.92-3.097,6.92-6.916v-13.839c0-3.821-3.099-6.92-6.92-6.92h-13.837
                c-3.821,0-6.919,3.099-6.919,6.92v13.839C327.612,382.237,330.71,385.334,334.531,385.334z M332.225,364.579
                c0-1.274,1.032-2.306,2.306-2.306h13.837c1.274,0,2.305,1.032,2.305,2.306v13.839c0,1.273-1.03,2.305-2.305,2.305h-13.837
                c-1.274,0-2.306-1.031-2.306-2.305V364.579z"/>
            <path fill="#0F6CB6" d="M387.576,332.291c0-3.821-3.097-6.918-6.919-6.918h-13.838c-3.823,0-6.92,3.097-6.92,6.918v13.838
                c0,3.821,3.097,6.919,6.92,6.919h13.838c3.821,0,6.919-3.098,6.919-6.919V332.291z M382.964,346.129
                c0,1.273-1.032,2.306-2.307,2.306h-13.838c-1.273,0-2.308-1.032-2.308-2.306v-13.838c0-1.274,1.034-2.306,2.308-2.306h13.838
                c1.274,0,2.307,1.032,2.307,2.306V346.129z"/>
            <path fill="#0F6CB6" d="M380.657,357.659h-13.838c-3.822,0-6.92,3.099-6.92,6.92v13.839c0,3.819,3.098,6.917,6.92,6.917h13.838
                c3.822,0,6.919-3.098,6.919-6.917v-13.839C387.576,360.758,384.479,357.659,380.657,357.659z M382.964,378.418
                c0,1.273-1.032,2.305-2.307,2.305h-13.838c-1.273,0-2.308-1.031-2.308-2.305v-13.839c0-1.274,1.034-2.306,2.308-2.306h13.838
                c1.274,0,2.307,1.032,2.307,2.306V378.418z"/>
            <path fill="#0F6CB6" d="M343.756,313.84v-30.374c0.004-2.797-1.677-5.323-4.261-6.398c-2.582-1.076-5.558-0.488-7.541,1.485
                l-6.228,6.227l-12.629-12.611c-2.703-2.701-7.081-2.701-9.783,0l-8.146,8.148c-2.701,2.701-2.701,7.081,0,9.784l12.622,12.623
                l-6.228,6.226c-1.977,1.979-2.567,4.957-1.495,7.541c1.073,2.584,3.595,4.27,6.395,4.268h30.374
                C340.657,320.759,343.756,317.661,343.756,313.84z M304.317,314.717c-0.367-0.855-0.169-1.848,0.497-2.498l7.864-7.864
                c0.901-0.901,0.901-2.36,0-3.262l-14.25-14.253c-0.9-0.9-0.9-2.36,0-3.26l8.145-8.146c0.902-0.9,2.361-0.9,3.262,0l14.253,14.253
                c0.9,0.9,2.36,0.9,3.261,0l7.864-7.865c0.663-0.657,1.655-0.85,2.513-0.49c0.861,0.36,1.419,1.204,1.417,2.135v30.374
                c0,1.273-1.033,2.306-2.306,2.306h-30.374C305.521,316.16,304.667,315.592,304.317,314.717z"/>
            <path fill="#0F6CB6" d="M332.225,300.002c-1.275,0-2.308,1.033-2.308,2.306v4.613h-4.612c-1.272,0-2.305,1.033-2.305,2.307
                c0,1.273,1.033,2.306,2.305,2.306h4.612c2.548,0,4.614-2.065,4.614-4.613v-4.613C334.531,301.035,333.498,300.002,332.225,300.002z"
                />
        </svg>
    );

    class NabNTBMSlider extends Component {
        constructor() {
            super(...arguments);
            this.state = {
                bxSliderObj: {},
                bxinit: false,
                taxonomiesList: [],
                taxonomies: [],
                taxonomiesObj: {},
                termsObj: {},
                filterTermsObj: {},
                isDisable: false,
                title: null,
            };

            this.initSlider = this.initSlider.bind(this);
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

        componentDidMount() {
            const { clientId, attributes: { blockTitle }, setAttributes } = this.props;
            this.setState({ bxinit: true, title: blockTitle });
            setAttributes({ clientId: clientId });
        }

        componentDidUpdate() {
            const { clientId, attributes: { minSlides, autoplay, infiniteLoop, pager, controls, sliderSpeed, sliderMode, slideWidth, sliderActive, slideMargin } } = this.props;
            if (sliderActive) {
                if (this.state.bxinit) {
                    setTimeout(() => this.initSlider(), 500);
                    this.setState({ bxinit: false });
                } else {
                    if (0 < jQuery(`#block-${clientId} .nab-not-to-be-missed-slider`).length && this.state.bxSliderObj && undefined !== this.state.bxSliderObj.reloadSlider ) {

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
                                mode: sliderMode
                            }
                        );
                    }
                }
            }
        }

        initSlider() {
            const { clientId } = this.props;
            if (0 < jQuery(`#block-${clientId} .nab-not-to-be-missed-slider`).length) {
                const { minSlides, autoplay, infiniteLoop, pager, controls, sliderSpeed, sliderMode, slideWidth, slideMargin } = this.props.attributes;
                const sliderObj = jQuery(`#block-${clientId} .nab-not-to-be-missed-slider`).bxSlider({ minSlides: minSlides, maxSlides: minSlides, slideMargin: slideMargin, moveSlides: 1, slideWidth: slideWidth, auto: autoplay, infiniteLoop: infiniteLoop, pager: pager, controls: controls, speed: sliderSpeed, mode: sliderMode });
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
                sliderMode,
                postType,
                taxonomies,
                terms,
                slideWidth,
                orderBy,
                slideMargin,
                arrowIcons,
                blockTitle
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
                            <TextControl
                                label="Section Title"
                                type="string"
                                value={this.state.title}
                                onChange={(title) => this.setState({ title: title })}
                                onBlur={() => { setAttributes({ blockTitle: this.state.title }); this.setState({ bxinit: true }); }}
                            />
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
                                                                    this.setState({ bxinit: true });
                                                                }
                                                            }
                                                            if (tempTerms.constructor === Object) {
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
                                                <label>{__(`Select Filter Item from ${taxonomy}`)}</label>

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
                                    <SelectControl
                                        label={__('Slider Mode/Effect')}
                                        value={sliderMode}
                                        options={[
                                            { label: __('Horizontal'), value: 'horizontal' },
                                            { label: __('Vertical'), value: 'vertical' },
                                            { label: __('Fade'), value: 'fade' },
                                        ]}
                                        onChange={(value) => setAttributes({ sliderMode: value })}
                                    />
                                </Fragment>
                            }
                        </PanelBody>
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
                    </InspectorControls>
                    <ServerSideRender
                        block="nab/not-to-be-missed-slider"
                        attributes={{ itemToFetch: itemToFetch, postType: postType, terms: terms, sliderActive: sliderActive, orderBy: orderBy, arrowIcons: arrowIcons, blockTitle: blockTitle }}
                    />
                </Fragment >
            );
        }
    }
    const blockAttrs = {
        blockTitle: {
            type: 'string',
            default: 'Not-To-Be-Missed'
        },
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
        sliderMode: {
            type: 'string',
            default: 'horizontal'
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
        arrowIcons: {
            type: 'string',
            default: 'slider-arrow-1'
        },
        clientId: {
            type: 'string',
            default: null
        }
    };
    registerBlockType('nab/not-to-be-missed-slider', {
        title: __('Not to be Missed Slider'),
        icon: { src: notToBeMissedBlockIcon },
        category: 'nabshow',
        keywords: [__('Not'), __('missed'), __('slider')],
        attributes: blockAttrs,
        edit: NabNTBMSlider,
        save() {
            return null;
        },
    });

})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);
