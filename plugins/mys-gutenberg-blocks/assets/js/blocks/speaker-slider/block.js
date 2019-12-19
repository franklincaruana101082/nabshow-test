import { sliderArrow1, sliderArrow2, sliderArrow3, sliderArrow4, sliderArrow5, sliderArrow6, sqrImgOption, circleImgOption } from '../icons';

(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    const { __ } = wpI18n;
    const { Component, Fragment } = wpElement;
    const { registerBlockType } = wpBlocks;
    const { InspectorControls } = wpEditor;
    const { PanelBody, PanelRow, Disabled, ToggleControl, SelectControl, TextControl, ServerSideRender, CheckboxControl, RangeControl } = wpComponents;

    const speakerSliderBlockIcon = (
        <svg width="150px" height="150px" viewBox="0 0 150 150" enable-background="new 0 0 150 150">
            <rect fill="none" width="150" height="150"/>
            <g>
                <path fill="#92c83e" d="M136.125,44.55c3.45,12.15,2.85,24.15-0.15,33.601c-3.149,9.6-9.449,16.35-17.25,18.6
                    c-1.199,0.45-1.949,0.45-3,0.45c-0.449,0.149-0.899,0.149-1.35,0.149c-0.45,0.15-1.05,0.15-1.65,0.15h-51l16.65,41.25
                    c0.15,1.05-0.45,1.95-1.05,2.55c-0.601,0.75-1.8,1.2-2.55,1.2h-22.65c-0.75,0-1.95-0.45-2.55-1.2c-0.6-0.6-1.2-1.5-1.05-2.55
                    l-7.5-41.25h-9.15l-0.15-0.15c-3.75,0.45-8.1-1.35-11.55-4.649c-3.45-3.3-6.6-8.101-7.95-14.101c-1.8-6-1.5-11.7-0.15-16.5
                    c1.35-4.65,4.35-8.1,7.95-9.75l0.15-0.15l67.5-40.5c0.75-0.45,1.351-0.75,1.8-1.2c0.45-0.3,1.051-0.6,1.801-0.9
                    c1.199-0.6,2.1-0.9,3.75-1.35c7.8-2.25,16.8,0.75,24.149,7.35C126.525,22.2,132.975,32.4,136.125,44.55z M116.775,89.4h-0.15
                    c3-0.75,5.55-2.551,7.8-5.25c4.351-5.25,6.45-13.2,6.45-22.8c0-4.8-0.75-9.75-2.1-14.85c-2.551-10.2-7.65-18.75-13.351-24.3
                    c-5.7-5.55-12.6-8.25-18.45-6.6c-6.149,1.65-10.5,7.2-12.75,15c-2.399,7.8-2.1,17.7,0.45,27.9c2.851,10.2,7.5,18.75,13.5,24.3
                    C104.025,88.35,110.325,91.05,116.775,89.4L116.775,89.4z M97.725,36.3c1.65-0.3,3.15-0.15,4.65,0.3c2.85,1.2,5.7,3.6,7.65,7.5
                    c1.949,3.9,3.149,9,3.149,13.35c0,2.25-0.3,4.2-0.899,6c-1.351,3.6-3.301,6.3-6.45,7.05c-2.55,0.75-6-0.45-8.55-3
                    c-2.551-2.55-4.801-6.45-5.851-11.25c-1.35-4.65-0.899-9.3,0.15-12.9S95.175,37.05,97.725,36.3z"/>
            </g>
        </svg>
    );

    class MYSSpeakerSlider extends Component {
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

        componentDidUpdate(prevProps) {
            const { clientId, attributes: { minSlides, autoplay, infiniteLoop, pager, controls, sliderSpeed, slideWidth, sliderActive, slideMargin } } = this.props;
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
                listingPage,
                minSlides,
                autoplay,
                infiniteLoop,
                pager,
                controls,
                sliderSpeed,
                slideShape,
                sliderActive,
                postType,
                taxonomies,
                terms,
                slideWidth,
                orderBy,
                slideMargin,
                arrowIcons,
                withThumbnail,
                displayName,
                displayTitle,
                displayCompany
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
                        <PanelBody title={__('Data Settings')} initialOpen={true} className="range-setting">
                            <ToggleControl
                                label={__('Browse Page Format')}
                                checked={listingPage}
                                onChange={() => setAttributes({ listingPage: ! listingPage, sliderActive: false, orderBy: 'date', slideShape: 'circle', withThumbnail: false }) }
                            />

                            {input}

                            { ! listingPage &&
                            <Fragment>
                                <ToggleControl
                                    label={__('Only show with headshots')}
                                    checked={withThumbnail}
                                    onChange={() => { setAttributes({ withThumbnail: ! withThumbnail }); this.setState({ bxinit: true }); } }
                                />
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

                                { 0 < this.state.taxonomiesList.length &&

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

                                { 0 < this.state.taxonomies.length &&

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
                            </Fragment>
                            }
                        </PanelBody>
                        <PanelBody title={__('Display Settings')} initialOpen={false} className="range-setting">

                          <ToggleControl
                            label={__('Display Name')}
                            checked={displayName}
                            onChange={() => { setAttributes({ displayName: ! displayName }); this.setState({ bxinit: true }); } }
                          />
                          <ToggleControl
                            label={__('Display Title')}
                            checked={displayTitle}
                            onChange={() => { setAttributes({ displayTitle: ! displayTitle }); this.setState({ bxinit: true }); } }
                          />
                          <ToggleControl
                            label={__('Display Company')}
                            checked={displayCompany}
                            onChange={() => { setAttributes({ displayCompany: ! displayCompany }); this.setState({ bxinit: true }); } }
                          />
                        </PanelBody>
                        { ! listingPage &&
                          <Fragment>
                            <PanelBody title={__('Slider Settings')} initialOpen={false} className="range-setting">
                              <div>
                                <label>Shape</label>
                                <PanelRow>
                                  <ul className="ss-off-options">
                                    <li className={'rectangle' === slideShape ? 'active ' : ''} onClick={() => { setAttributes({ slideShape: 'rectangle' }); this.setState({ bxinit: true }); }}>{sqrImgOption}</li>
                                    <li className={'circle' === slideShape ? 'active ' : ''} onClick={() => { setAttributes({ slideShape: 'circle' }); this.setState({ bxinit: true }); }}>{circleImgOption}</li>
                                  </ul>
                                </PanelRow>
                              </div>
                              <ToggleControl
                                label={__('Slider On/Off')}
                                checked={sliderActive}
                                onChange={() => { setAttributes({ sliderActive: ! sliderActive }); this.setState({ bxinit: ! sliderActive }); }}
                              />
                              { sliderActive &&
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
                          </Fragment>
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
                        <PanelBody title={__('Help')} initialOpen={false} className="range-setting">
                            <a href="https://nabshow-com.go-vip.net/2020/wp-content/uploads/sites/3/2019/11/speaker-slider.mp4" target="_blank">How to use block?</a>
                        </PanelBody>
                    </InspectorControls>
                    <ServerSideRender
                        block="mys/speaker-slider"
                        attributes={{ itemToFetch: itemToFetch, postType: postType, taxonomies: taxonomies, terms: terms, sliderActive: sliderActive, slideShape: slideShape, orderBy: orderBy, arrowIcons: arrowIcons, listingPage: listingPage, withThumbnail: withThumbnail, displayName: displayName, displayTitle: displayTitle, displayCompany: displayCompany }}
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
        slideShape: {
            type: 'string',
            default: 'circle'
        },
        sliderActive: {
            type: 'boolean',
            default: true
        },
        postType: {
            type: 'string',
            default: 'speakers'
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
        withThumbnail: {
            type: 'boolean',
            default: false
        },
        displayName: {
            type: 'boolean',
            default: true
        },
        displayTitle: {
            type: 'boolean',
            default: true
        },
        displayCompany: {
            type: 'boolean',
            default: true
        }
    };
    registerBlockType('mys/speaker-slider', {
        title: __('Speaker Slider'),
        icon: { src: speakerSliderBlockIcon },
        category: 'mysgb',
        keywords: [__('speaker'), __('slider')],
        attributes: blockAttrs,
        edit: MYSSpeakerSlider,
        save() {
            return null;
        },
    });

})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);
