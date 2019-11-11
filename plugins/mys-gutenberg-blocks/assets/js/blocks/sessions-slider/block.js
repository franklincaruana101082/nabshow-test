import { sessionSliderOff1, sessionSliderOff2, sessionSliderOff3, sessionSliderOn1, sessionSliderOn2, sliderArrow1, sliderArrow2, sliderArrow3, sliderArrow4, sliderArrow5, sliderArrow6 } from '../icons';

(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    const { __ } = wpI18n;
    const { Component, Fragment } = wpElement;
    const { registerBlockType } = wpBlocks;
    const { InspectorControls } = wpEditor;
    const { PanelBody, Disabled, ToggleControl, SelectControl, TextControl, ServerSideRender, CheckboxControl, PanelRow, RangeControl, DateTimePicker, RadioControl } = wpComponents;

    const sessionSliderBlockIcon = (
        <svg width="150px" height="150px" viewBox="0 0 150 150" enable-background="new 0 0 150 150">
            <rect fill="none" width="150" height="150"/>
            <g>
                <path fill="#92c83e" d="M0,22.5h150v90h-5.625c0-13.425-10.95-24.375-24.375-24.375c-9.825,0-18.15,5.925-22.05,14.325
                    c-1.875-0.75-3.9-1.2-6.075-1.2c-7.35,0-13.5,4.725-15.825,11.25H0V22.5z M62.775,45.825c-0.45,1.125-0.75,2.325-0.825,3.525
                    c-0.075,1.2-0.075,2.475,0.075,3.75l0.15,0.6c0.075,0.45,0.15,1.05,0.375,1.725c0.15,0.75,0.45,1.5,0.75,2.325
                    c0.225,0.825,0.675,1.65,1.125,2.475c0.525,0.9,1.125,1.65,1.725,2.325c0.6,0.675,1.35,1.275,2.325,1.725
                    c0.9,0.45,1.875,0.675,3,0.675c1.05,0,2.025-0.225,2.925-0.675c0.9-0.45,1.65-1.05,2.25-1.65c0.675-0.675,1.199-1.5,1.649-2.4
                    c0.525-0.9,0.9-1.725,1.2-2.475s0.525-1.5,0.675-2.325c0.226-0.825,0.3-1.35,0.375-1.65c0.075-0.3,0.075-0.525,0.075-0.675
                    c0.375-2.175,0.225-4.2-0.3-6.15C79.8,45,78.75,43.35,77.25,42c-1.575-1.35-3.525-2.025-5.925-2.025c-1.425,0-2.7,0.225-3.9,0.75
                    c-1.125,0.525-2.1,1.2-2.85,2.1C63.9,43.65,63.3,44.7,62.775,45.825L62.775,45.825z M96.375,91.125v-8.55
                    c0-2.476-0.75-4.95-2.175-7.35S90.825,70.8,88.425,69.3c-2.399-1.575-4.95-2.325-7.649-2.325l-9.3,6.3l-9.6-6.15
                    c-2.775,0-5.4,0.75-7.8,2.25c-2.325,1.5-4.2,3.45-5.55,5.775c-1.35,2.4-2.025,4.875-2.025,7.425v8.55l1.35,0.375
                    c0.9,0.3,2.175,0.6,3.825,1.05c1.725,0.375,3.525,0.75,5.55,1.125c1.95,0.375,4.275,0.675,6.825,0.976
                    c2.55,0.225,5.025,0.375,7.425,0.375c2.25,0,4.725-0.15,7.35-0.375c2.55-0.301,4.8-0.601,6.675-0.976c1.875-0.3,3.75-0.75,5.7-1.2
                    l3.75-0.899C95.55,91.425,96,91.275,96.375,91.125z M120,91.875c11.4,0,20.625,9.225,20.625,20.625S131.4,133.125,120,133.125
                    c-5.475,0-10.35-2.25-14.025-5.775c1.726-2.625,2.775-5.85,2.775-9.225c0-5.775-2.925-10.95-7.425-13.95
                    C104.55,96.975,111.6,91.875,120,91.875z M78.75,118.125c0-7.2,5.925-13.125,13.125-13.125S105,110.925,105,118.125
                    s-5.925,13.125-13.125,13.125S78.75,125.325,78.75,118.125z"/>
            </g>
        </svg>
    );

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
                    if (0 < $(`#block-${clientId} .nab-dynamic-slider`).length && this.state.bxSliderObj && undefined !== this.state.bxSliderObj.reloadSlider ) {
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
                listingPage,
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
                listingType,
                withContent
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
                    max={100}
                    onChange={(item) => { setAttributes({ itemToFetch: parseInt(item) }); this.setState({ bxinit: true, isDisable: true }); }}
                />

            </div>;

            if (this.state.isDisable && sliderActive && ! isNaN( itemToFetch ) ) {
                input = <Disabled>{input}</Disabled>;
            }

            return (
                <Fragment>
                    <InspectorControls>
                        <PanelBody title={__('Data Settings ')} initialOpen={true} className="range-setting">
                            <ToggleControl
                                label={__('Is Listing Page?')}
                                checked={listingPage}
                                help={__('Note: This option only work in nabashow-lv theme.')}
                                onChange={() => setAttributes({ listingPage: ! listingPage, sliderActive: false, layout: 'with-featured', orderBy: 'date', listingType: listingPage ? listingType : 'none', withContent: false }) }
                            />
                            { listingPage &&
                            <RadioControl
                                label="Listing Types"
                                selected={listingType}
                                options={[
                                    { label: 'None', value: 'none' },
                                    { label: 'Featured Session', value: 'featured' },
                                    { label: 'Opent to All', value: 'open-to-all' }
                                ]}
                                onChange={ ( option ) => setAttributes({ listingType: option })}
                            />
                            }

                            {input}
                            { ! listingPage &&
                            <Fragment>
                                <ToggleControl
                                    label={__('Only show with descriptions')}
                                    checked={withContent}
                                    onChange={() => { setAttributes({ withContent: ! withContent }); this.setState({ bxinit: true }); } }
                                />
                                <SelectControl
                                    label={__('Order by')}
                                    value={orderBy}
                                    options={[
                                        {label: __('Newest to Oldest'), value: 'date'},
                                        {label: __('Menu Order'), value: 'menu_order'},
                                        {label: __('Random'), value: 'rand'},
                                    ]}
                                    onChange={(value) => {
                                        setAttributes({orderBy: value});
                                        this.setState({bxinit: true});
                                    }}
                                />
                                <ToggleControl
                                    label={__('Date Specific Session')}
                                    checked={metaDate}
                                    onChange={() => { setAttributes({metaDate: ! metaDate}); this.setState({bxinit: true}); }}
                                />
                                { metaDate &&
                                <div className="inspector-field inspector-field-datetime components-base-control hide-time">
                                    <label className="inspector-mb-0">Select Session Date</label>
                                    <div className="inspector-ml-auto">
                                        <DateTimePicker
                                            currentDate={sessionDate}
                                            onChange={(date) => { setAttributes({sessionDate: date}); this.setState({bxinit: true});}}
                                        />
                                    </div>
                                </div>
                                }
                                <ToggleControl
                                    label={__('Taxonomy Relation (AND)')}
                                    checked={taxonomyRelation}
                                    onChange={() => { setAttributes({taxonomyRelation: ! taxonomyRelation}); this.setState({bxinit: true}); }}
                                />
                                {0 < this.state.taxonomiesList.length &&

                                <Fragment>

                                    <label>{__('Select Taxonomy')}</label>
                                    <div className="fix-height-select">

                                    {this.state.taxonomiesList.map((taxonomy, index) => (

                                        <Fragment key={index}>

                                            <CheckboxControl checked={-1 < taxonomies.indexOf(taxonomy.value)}
                                                 label={taxonomy.label} name="taxonomy[]" value={taxonomy.value}
                                                 onChange={(isChecked) => {

                                                         let index,
                                                             tempTaxonomies = [...taxonomies],
                                                             tempTerms = terms;

                                                         if (isChecked) {
                                                             tempTaxonomies.push(taxonomy.value);
                                                         } else {
                                                             index = tempTaxonomies.indexOf(taxonomy.value);
                                                             tempTaxonomies.splice(index, 1);
                                                             if ( ! this.isEmpty(tempTerms)) {
                                                                 tempTerms = JSON.parse(tempTerms);
                                                                 delete tempTerms[taxonomy.value];
                                                                 tempTerms = JSON.stringify(tempTerms);
                                                             }
                                                         }
                                                         if (tempTerms.constructor === Object) {
                                                             tempTerms = JSON.stringify(tempTerms);
                                                         }
                                                         this.props.setAttributes({
                                                             terms: tempTerms,
                                                             taxonomies: tempTaxonomies
                                                         });
                                                         this.setState({taxonomies: tempTaxonomies, bxinit: true});
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

                                                            <CheckboxControl
                                                                checked={isCheckedTerms[taxonomy] !== undefined && -1 < isCheckedTerms[taxonomy].indexOf(term.slug)}
                                                                label={term.name} name={`${taxonomy}[]`} value={term.slug}
                                                                onChange={(isChecked) => {

                                                                        let index,
                                                                            tempTerms = terms;
                                                                        if ( ! this.isEmpty(tempTerms)) {
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
                                                                        this.props.setAttributes({terms: tempTerms});
                                                                        this.setState({bxinit: true});
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
                            </Fragment>
                            }
                        </PanelBody>
                        { ! listingPage &&
                        <PanelBody title={__('Slider Settings ')} initialOpen={false} className="range-setting">
                            <ToggleControl
                                label={__('Slider On/Off')}
                                checked={sliderActive}
                                help={__('Note: Change Layout by toggling Slider On/Off.')}
                                onChange={() => { setAttributes({ sliderActive: ! sliderActive, layout: ! sliderActive ? null : 'with-featured', sliderLayout: ! sliderActive ? 'layout-1' : null }); this.setState({bxinit: ! sliderActive}); }}
                            />
                            { ! sliderActive &&
                            <div>
                                <label>Select Listing Layout</label>
                                <PanelRow>
                                    <ul className="ss-off-options">
                                        <li className={'with-featured' === layout ? 'active with-featured' : 'with-featured'} onClick={() => setAttributes({layout: 'with-featured'})}>{sessionSliderOff1}</li>
                                        <li className={'with-masonry' === layout ? 'active with-masonry' : 'with-masonry'} onClick={() => setAttributes({layout: 'with-masonry'})}>{sessionSliderOff2}</li>
                                        <li className={'date-group' === layout ? 'active date-group ss-full-option' : 'date-group ss-full-option'} onClick={() => setAttributes({layout: 'date-group'})}>{sessionSliderOff3}</li>
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
                                            <li className={'layout-1' === sliderLayout ? 'active layout-1' : 'layout-1'} onClick={() => { setAttributes({sliderLayout: 'layout-1'}); this.setState({bxinit: true}); }}>{sessionSliderOn1}</li>
                                            <li className={'layout-2' === sliderLayout ? 'active layout-2' : 'layout-2'} onClick={() => { setAttributes({sliderLayout: 'layout-2'}); this.setState({bxinit: true}); }}>{sessionSliderOn2}</li>
                                        </ul>
                                    </PanelRow>
                                </div>
                                <ToggleControl
                                    label={__('Pager')}
                                    checked={pager}
                                    onChange={() => setAttributes({pager: ! pager})}
                                />
                                <ToggleControl
                                    label={__('Controls')}
                                    checked={controls}
                                    onChange={() => setAttributes({controls: ! controls})}
                                />
                                <ToggleControl
                                    label={__('Autoplay')}
                                    checked={autoplay}
                                    onChange={() => setAttributes({autoplay: ! autoplay})}
                                />
                                <ToggleControl
                                    label={__('Infinite Loop')}
                                    checked={infiniteLoop}
                                    onChange={() => setAttributes({infiniteLoop: ! infiniteLoop})}
                                />
                                <div className="inspector-field inspector-field-fontsize ">
                                    <label className="inspector-mb-0">Slide Speed</label>
                                    <RangeControl
                                        value={sliderSpeed}
                                        min={100}
                                        max={1000}
                                        step={1}
                                        onChange={(speed) => setAttributes({sliderSpeed: parseInt(speed)})}
                                    />
                                </div>
                                <div className="inspector-field inspector-field-fontsize ">
                                    <label className="inspector-mb-0">Items to Display</label>
                                    <RangeControl
                                        value={minSlides}
                                        min={1}
                                        max={10}
                                        step={1}
                                        onChange={(slide) => setAttributes({minSlides: parseInt(slide)})}
                                    />
                                </div>
                                <div className="inspector-field inspector-field-fontsize ">
                                    <label className="inspector-mb-0">Slide Width</label>
                                    <RangeControl
                                        value={slideWidth}
                                        min={50}
                                        max={1000}
                                        step={1}
                                        onChange={(width) => setAttributes({slideWidth: parseInt(width)})}
                                    />
                                </div>
                                <div className="inspector-field inspector-field-fontsize ">
                                    <label className="inspector-mb-0">Slide Margin</label>
                                    <RangeControl
                                        value={slideMargin}
                                        min={0}
                                        max={100}
                                        step={1}
                                        onChange={(width) => setAttributes({slideMargin: parseInt(width)})}
                                    />
                                </div>
                            </Fragment>
                            }
                        </PanelBody>
                        }
                        { ! listingPage && sliderActive && controls &&
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
                    <ServerSideRender
                        block="mys/sessions-slider"
                        attributes={{ itemToFetch: itemToFetch, postType: postType, taxonomies: taxonomies, terms: terms, sliderActive: sliderActive, orderBy: orderBy, layout: layout, sliderLayout: sliderLayout, arrowIcons: arrowIcons, metaDate: metaDate, sessionDate: sessionDate, taxonomyRelation: taxonomyRelation, listingPage: listingPage, listingType: listingType, withContent: withContent }}
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
        listingPage: {
          type: 'boolean',
          default: false
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
        listingType: {
            type: 'string',
            default: 'none',
        },
        withContent: {
            type: 'boolean',
            default: false
        }
    };
    registerBlockType('mys/sessions-slider', {
        title: __('Sessions Slider'),
        icon: { src: sessionSliderBlockIcon },
        category: 'mysgb',
        keywords: [__('sessions'), __('slider')],
        attributes: blockAttrs,
        edit: MYSSessionSlider,
        save() {
            return null;
        },
    });

})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);