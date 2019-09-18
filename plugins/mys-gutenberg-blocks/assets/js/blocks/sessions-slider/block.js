import { sessionSliderOff1, sessionSliderOff2, sessionSliderOff3, sessionSliderOn1, sessionSliderOn2, sliderArrow1, sliderArrow2, sliderArrow3, sliderArrow4, sliderArrow5, sliderArrow6 } from '../icons';

(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    const { __ } = wpI18n;
    const { Component, Fragment } = wpElement;
    const { registerBlockType } = wpBlocks;
    const { InspectorControls } = wpEditor;
    const { PanelBody, Disabled, ToggleControl, SelectControl, TextControl, ServerSideRender, CheckboxControl, PanelRow, RangeControl, DateTimePicker } = wpComponents;

    class MYSSessionSlider extends Component {
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
            this.setState({ bxinit: true });
        }

        componentDidUpdate() {
            const { clientId, attributes: { minSlides, autoplay, infiniteLoop, pager, controls, sliderSpeed, slideWidth, sliderActive, slideMargin } } = this.props;
            if (sliderActive) {
                if (this.state.bxinit) {
                    setTimeout(() => this.initSlider(), 500);
                    this.setState({ bxinit: false });
                } else {
                    if (0 < $(`#block-${clientId} .nab-dynamic-slider`).length && this.state.bxSliderObj ) {
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
                layout,
                sliderLayout,
                arrowIcons,
                sessionDate,
                metaDate,
                taxonomyRelation,
                detailPopup
            } = attributes;

            var names = [
                { name: sliderArrow1, classnames: 'slider-arrow-1' },
                { name: sliderArrow2, classnames: 'slider-arrow-2' },
                { name: sliderArrow3, classnames: 'slider-arrow-3' },
                { name: sliderArrow4, classnames: 'slider-arrow-4' },
                { name: sliderArrow5, classnames: 'slider-arrow-5' },
                { name: sliderArrow6, classnames: 'slider-arrow-6' }
            ];

            if ( ! sessionDate ) {
                setAttributes({sessionDate: moment().format('YYYY-MM-DDTHH:mm:ss')});
            }

            let isCheckedTerms = {};
            if (! this.isEmpty(terms) && terms.constructor !== Object) {
                isCheckedTerms = JSON.parse(terms);
            }

            let input = <div className="inspector-field inspector-field-Numberofitems ">
                <label className="inspector-mb-0">Number of items</label>
                <RangeControl
                    value={itemToFetch}
                    min={1}
                    max={500}
                    onChange={(item) => { setAttributes({ itemToFetch: parseInt(item) }); this.setState({ bxinit: true, isDisable: true }); }}
                />

            </div>;

            if (this.state.isDisable && sliderActive) {
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
                                    { label: __('Random'), value: 'rand' },
                                ]}
                                onChange={(value) => { setAttributes({ orderBy: value }); this.setState({ bxinit: true }); }}
                            />
                            <ToggleControl
                                label={__('Display details in popup')}
                                checked={detailPopup}
                                onChange={() => { setAttributes({ detailPopup: ! detailPopup }); this.setState({ bxinit: true }); }}
                            />
                            <ToggleControl
                                label={__('Date Specific Session')}
                                checked={metaDate}
                                onChange={() => { setAttributes({ metaDate: ! metaDate }); this.setState({ bxinit: true }); }}
                            />
                            { metaDate &&
                                <div className="inspector-field inspector-field-datetime components-base-control hide-time">
                                    <label className="inspector-mb-0">Select Session Date</label>
                                    <div className="inspector-ml-auto">
                                        <DateTimePicker
                                            currentDate={sessionDate}
                                            onChange={(date) => { setAttributes({sessionDate: date}); this.setState({ bxinit: true }); }}
                                        />
                                    </div>
                                </div>
                            }
                            <ToggleControl
                                label={__('Taxonomy Relation (AND)')}
                                checked={taxonomyRelation}
                                onChange={() => { setAttributes({ taxonomyRelation: ! taxonomyRelation }); this.setState({ bxinit: true }); }}
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
                                help={__('Note: Change Layout by toggling Slider On/Off.')}
                                onChange={() => {
                                    setAttributes({ sliderActive: ! sliderActive, layout: ! sliderActive ? null : 'with-featured', sliderLayout: ! sliderActive ? 'layout-1' : null }); this.setState({ bxinit: ! sliderActive });
                                }
                                }
                            />
                            {! sliderActive &&
                                <div>
                                    <label>Select Listing Layout</label>
                                    <PanelRow>
                                        <ul className="ss-off-options">
                                            <li className={'with-featured' === layout ? 'active with-featured' : 'with-featured'} onClick={() => setAttributes({ layout: 'with-featured' })}>{sessionSliderOff1}</li>
                                            <li className={'with-masonry' === layout ? 'active with-masonry' : 'with-masonry'} onClick={() => setAttributes({ layout: 'with-masonry' })}>{sessionSliderOff2}</li>
                                            <li className={'date-group' === layout ? 'active date-group ss-full-option' : 'date-group ss-full-option'} onClick={() => setAttributes({ layout: 'date-group' })}>{sessionSliderOff3}</li>
                                        </ul>
                                    </PanelRow>
                                </div>
                            }

                            {sliderActive &&
                                <Fragment>
                                    <div>
                                        <label>Select Slider Layout</label>
                                        <PanelRow>
                                            <ul className="ss-on-options">
                                                <li className={'layout-1' === sliderLayout ? 'active layout-1' : 'layout-1'} onClick={() => { setAttributes({ sliderLayout: 'layout-1' }); this.setState({ bxinit: true }); }}>{sessionSliderOn1}</li>
                                                <li className={'layout-2' === sliderLayout ? 'active layout-2' : 'layout-2'} onClick={() => { setAttributes({ sliderLayout: 'layout-2' }); this.setState({ bxinit: true }); }}>{sessionSliderOn2}</li>
                                            </ul>
                                        </PanelRow>
                                    </div>
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
                        {
                            controls ? (
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
                            ) : ''
                        }
                    </InspectorControls>
                    <ServerSideRender
                        block="mys/sessions-slider"
                        attributes={{ itemToFetch: itemToFetch, postType: postType, taxonomies: taxonomies, terms: terms, sliderActive: sliderActive, orderBy: orderBy, layout: layout, sliderLayout: sliderLayout, arrowIcons: arrowIcons, metaDate: metaDate, sessionDate: sessionDate, taxonomyRelation: taxonomyRelation, detailPopup: detailPopup }}
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
            default: 'sessions'
        },
        taxonomies: {
            type: 'array',
            default: []
        },
        terms: {
            type: 'string',
            default: {}
        },
        detailPopup: {
            type: 'boolean',
            default: false,
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
        layout: {
            type: 'string',
            default: 'with-featured'
        },
        sliderLayout: {
            type: 'string',
            default: 'layout-1'
        },
        arrowIcons: {
            type: 'string',
            default: 'slider-arrow-1'
        },
        metaDate: {
            type: 'boolean',
            default: false,
        },
        sessionDate: {
            type: 'string',
        },
        taxonomyRelation: {
            type: 'boolean',
            default: false,
        },
    };
    registerBlockType('mys/sessions-slider', {
        title: __('Sessions Slider'),
        icon: 'lock',
        category: 'mysgb',
        keywords: [__('sessions'), __('slider')],
        attributes: blockAttrs,
        edit: MYSSessionSlider,
        save() {
            return null;
        },
    });

})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);