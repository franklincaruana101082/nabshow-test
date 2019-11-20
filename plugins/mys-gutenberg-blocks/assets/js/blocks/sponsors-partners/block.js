import { sliderArrow1, sliderArrow2, sliderArrow3, sliderArrow4, sliderArrow5, sliderArrow6, partnerSponser1, partnerSponser2, sessionSliderOff1 } from '../icons';

(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    const { __ } = wpI18n;
    const { Component, Fragment } = wpElement;
    const { registerBlockType } = wpBlocks;
    const { InspectorControls } = wpEditor;
    const { PanelBody, Disabled, ToggleControl, SelectControl, TextControl, ServerSideRender, CheckboxControl, RangeControl } = wpComponents;

    const sponsorPartnerBlockIcon = (
        <svg width="150px" height="150px" viewBox="0 0 150 150" enable-background="new 0 0 150 150">
            <rect fill="none" width="150" height="150"/>
            <g>
                <path fill="#92c83e" d="M56.206,20.281c-2.768,12.215,5.249,33.02,18.8,33.02c13.457,0,21.473-20.805,18.706-33.02
                    c-2.1-9.353-10.308-15.556-18.706-15.556C66.513,4.725,58.401,10.928,56.206,20.281z M16.791,28.87
                    c-2.386,10.307,4.485,27.962,15.938,27.962S51.052,39.177,48.666,28.87c-1.813-7.921-8.78-13.266-15.938-13.266
                    S18.604,20.949,16.791,28.87z M101.347,28.87c-2.386,10.307,4.485,27.962,15.843,27.962c11.452,0,18.322-17.656,15.937-27.962
                    c-1.813-7.921-8.779-13.266-15.937-13.266C110.126,15.604,103.16,20.949,101.347,28.87L101.347,28.87z M95.717,137.952
                    l11.929-41.037c7.443-23.763-6.775-38.365-32.639-38.365c-25.958,0-40.178,14.602-32.829,38.365l12.024,41.037
                    c2.195,6.872,11.261,11.548,20.805,11.548C84.358,149.5,93.521,144.824,95.717,137.952z M37.5,65.136
                    c-4.676,6.394-9.162,17.464-4.008,34.261l10.688,36.17c-3.244,1.908-7.348,2.959-11.452,2.959c-8.112,0-15.747-3.913-17.655-9.83
                    L4.862,93.862c-6.203-20.138,5.822-32.449,27.867-32.449c2.577,0,5.154,0.191,7.54,0.573C39.314,62.94,38.36,64.085,37.5,65.136z
                    M117.189,61.413c22.044,0,34.165,12.312,27.866,32.449l-10.211,34.833c-1.908,5.917-9.543,9.83-17.655,9.83
                    c-4.104,0-8.208-1.051-11.452-2.959l10.592-35.979c5.249-16.988,0.765-28.058-4.007-34.452c-0.765-1.05-1.719-2.195-2.673-3.149
                    C112.035,61.604,114.517,61.413,117.189,61.413z"/>
            </g>
        </svg>
    );

    class MYSSponsorsPartners extends Component {
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
                layout,
                itemToFetch,
                listingPage,
                postType,
                taxonomies,
                terms,
                orderBy,
                minSlides,
                autoplay,
                infiniteLoop,
                pager,
                controls,
                sliderSpeed,
                sliderActive,
                slideWidth,
                slideMargin,
                arrowIcons
            } = attributes;

            let names = [
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
                    max={100}
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
                            <ToggleControl
                                label={__('Is Listing Page?')}
                                checked={listingPage}
                                help={__('Note: This option only work in nabashow-lv theme.')}
                                onChange={() => setAttributes({ listingPage: ! listingPage, sliderActive: false, layout: 'without-title' }) }
                            />
                            {input}
                            <SelectControl
                                label={__('Order by')}
                                value={orderBy}
                                options={[
                                        { label: __('Newest to Oldest'), value: 'date' },
                                        { label: __('Menu Order'), value: 'menu_order' },
                                        { label: __('Random'), value: 'rand' },
                                    ]}
                                onChange={ (value) => { setAttributes({ orderBy: value }); this.setState({ bxinit: true }); }}
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
                                                        if ( tempTerms.constructor === Object ) {
                                                            tempTerms = JSON.stringify(tempTerms);
                                                        }
                                                        this.props.setAttributes({ terms: tempTerms, taxonomies: tempTaxonomies });
                                                        this.setState({ taxonomies: tempTaxonomies, bxinit: true });
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
                                                                            this.props.setAttributes({ terms: tempTerms });
                                                                            this.setState({ bxinit: true });
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

                        { ! listingPage &&

                        <PanelBody title={__('Slider Settings ')} initialOpen={false} className="range-setting">
                            <ToggleControl
                                label={__('Slider On/Off')}
                                checked={sliderActive}
                                onChange={() => { setAttributes({ sliderActive: ! sliderActive }); this.setState({ bxinit: ! sliderActive }); }}
                            />

                            { ! sliderActive &&
                            <div>
                                <label>Layout</label>
                                <ul className="ss-off-options">
                                    <li className={'without-title' === layout ? 'active ' : ''} onClick={() => setAttributes({ layout: 'without-title' }) }>{partnerSponser1}</li>
                                    <li className={'with-title' === layout ? 'active ' : ''} onClick={() => setAttributes({ layout: 'with-title' }) }>{partnerSponser2}</li>
                                    <li className={'with-info' === layout ? 'active ' : ''} onClick={() => setAttributes({ layout: 'with-info' }) }>{sessionSliderOff1}</li>
                                </ul>
                            </div>
                            }

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
                                <div className="inspector-field inspector-field-fontsize">
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
                            <a href="https://nabshow-com.go-vip.net/2020/wp-content/uploads/sites/3/2019/11/sponsors-partners-slider.mp4" target="_blank">How to use block?</a>
                        </PanelBody>
                    </InspectorControls>
                    <div>
                        <ServerSideRender
                            block="mys/sponsors-partners"
                            attributes={{
                                layout: layout,
                                itemToFetch: itemToFetch,
                                postType: postType,
                                orderBy: orderBy,
                                taxonomies: taxonomies,
                                terms: terms,
                                listingPage: listingPage,
                                sliderActive: sliderActive,
                                arrowIcons: arrowIcons
                            }}
                        />
                    </div>
                </Fragment>
            );
        }
    }

    const blockAttrs = {
        layout: {
            type: 'string',
            default: 'without-title'
        },
        itemToFetch: {
            type: 'number',
            default: 10
        },
        listingPage: {
            type: 'boolean',
            default: false
        },
        postType: {
            type: 'string',
            default: 'sponsors'
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
        },
        minSlides: {
            type: 'number',
            default: 6
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
        slideWidth: {
            type: 'number',
            default: 400
        },
        slideMargin: {
            type: 'number',
            default: 30
        },
        arrowIcons: {
            type: 'string',
            default: 'slider-arrow-1'
        },
    };
    registerBlockType('mys/sponsors-partners', {
        title: __('Sponsors and Partners'),
        icon: { src: sponsorPartnerBlockIcon },
        category: 'mysgb',
        keywords: [__('sponsors'), __('partners'), __('slider')],
        attributes: blockAttrs,
        edit: MYSSponsorsPartners,
        save() {
            return null;
        },
    });
})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);
