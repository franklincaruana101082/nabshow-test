import { sliderArrow1, sliderArrow2, sliderArrow3, sliderArrow4, sliderArrow5, sliderArrow6 } from '../icons';

(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    const { __ } = wpI18n;
    const { Component, Fragment } = wpElement;
    const { registerBlockType } = wpBlocks;
    const { InspectorControls } = wpEditor;
    const { PanelBody, Disabled, ToggleControl, SelectControl, TextControl, ServerSideRender, CheckboxControl, PanelRow, RangeControl } = wpComponents;

    class NabDynamicSlider extends Component {
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
                    if (0 < $(`#block-${clientId} .nab-not-to-be-missed-slider`).length) {
                        setTimeout(() => {
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
                        }, 1000);
                    }
                }
            }
        }

        initSlider() {
            const { clientId } = this.props;
            if (0 < $(`#block-${clientId} .nab-not-to-be-missed-slider`).length) {
                const { minSlides, autoplay, infiniteLoop, pager, controls, sliderSpeed, sliderMode, slideWidth, slideMargin } = this.props.attributes;
                const sliderObj = $(`#block-${clientId} .nab-not-to-be-missed-slider`).bxSlider({ minSlides: minSlides, maxSlides: minSlides, slideMargin: slideMargin, moveSlides: 1, slideWidth: slideWidth, auto: autoplay, infiniteLoop: infiniteLoop, pager: pager, controls: controls, speed: sliderSpeed, mode: sliderMode });
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
            if (! this.isEmpty(terms)) {
                isCheckedTerms = JSON.parse(terms);
            }

            let input = <div class="inspector-field inspector-field-Numberofitems ">
                <label class="inspector-mb-0">Number of items</label>
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
                                    <div class="inspector-field inspector-field-fontsize ">
                                        <label class="inspector-mb-0">Slide Speed</label>
                                        <RangeControl
                                            value={sliderSpeed}
                                            min={100}
                                            max={1000}
                                            step={1}
                                            onChange={(speed) => setAttributes({ sliderSpeed: parseInt(speed) })}
                                        />
                                    </div>
                                    <div class="inspector-field inspector-field-fontsize ">
                                        <label class="inspector-mb-0">Items to Display</label>
                                        <RangeControl
                                            value={minSlides}
                                            min={1}
                                            max={10}
                                            step={1}
                                            onChange={(slide) => setAttributes({ minSlides: parseInt(slide) })}
                                        />
                                    </div>
                                    <div class="inspector-field inspector-field-fontsize ">
                                        <label class="inspector-mb-0">Slide Width</label>
                                        <RangeControl
                                            value={slideWidth}
                                            min={50}
                                            max={1000}
                                            step={1}
                                            onChange={(width) => setAttributes({ slideWidth: parseInt(width) })}
                                        />
                                    </div>
                                    <div class="inspector-field inspector-field-fontsize ">
                                        <label class="inspector-mb-0">Slide Margin</label>
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
            default: 'ntb-missed'
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
        icon: 'lock',
        category: 'nabshow',
        keywords: [__('Not'), __('missed'), __('slider')],
        attributes: blockAttrs,
        edit: NabDynamicSlider,
        save() {
            return null;
        },
    });

})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);