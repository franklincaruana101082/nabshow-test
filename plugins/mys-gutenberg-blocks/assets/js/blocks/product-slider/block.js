import { sliderArrow1, sliderArrow2, sliderArrow3, sliderArrow4, sliderArrow5, sliderArrow6, sqrImgOption, circleImgOption } from '../icons';

(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    const { __ } = wpI18n;
    const { Component, Fragment } = wpElement;
    const { registerBlockType } = wpBlocks;
    const { InspectorControls } = wpEditor;
    const { PanelBody, Disabled, ToggleControl, SelectControl, TextControl, ServerSideRender, CheckboxControl, RangeControl } = wpComponents;

    const prodSlidertBlockIcon = (
        <svg width="150px" height="150px" viewBox="0 0 150 150" enable-background="new 0 0 150 150">
            <g>
                <g>
                    <path fill="#92c83e" d="M144.713,39.149h-36.159v-9.862c0-1.817-1.472-3.287-3.287-3.287H46.098c-1.815,0-3.288,1.47-3.288,3.287
                        v9.862H6.651c-1.814,0-3.287,1.469-3.287,3.287v75.605c0,1.818,1.473,3.287,3.287,3.287h59.17c1.814,0,3.287-1.469,3.287-3.287
                        v-9.862h13.149v9.862c0,1.818,1.472,3.287,3.287,3.287h59.169c1.815,0,3.287-1.469,3.287-3.287V42.437
                        C148,40.619,146.528,39.149,144.713,39.149z M62.534,114.755H9.938V45.723H42.81v8.403c-1.942-1.131-4.168-1.828-6.574-1.828
                        c-7.252,0-13.149,5.897-13.149,13.148c0,7.253,5.897,13.149,13.149,13.149c2.406,0,4.632-0.697,6.574-1.828v8.402H19.8v6.574
                        h23.01v6.574H19.8v6.574h23.01c0,1.818,1.473,3.287,3.288,3.287h16.436V114.755z M42.81,65.446c0,3.626-2.949,6.575-6.574,6.575
                        c-3.626,0-6.574-2.949-6.574-6.575c0-3.625,2.948-6.574,6.574-6.574C39.861,58.873,42.81,61.821,42.81,65.446z M65.821,101.606
                        H49.385v-59.17v-9.862h52.595v9.862v59.17H85.544H65.821z M141.426,114.755H88.831v-6.575h16.436c1.815,0,3.287-1.469,3.287-3.287
                        h23.012v-6.574h-23.012v-6.574h23.012V85.17h-23.012v-8.402c1.943,1.131,4.168,1.828,6.575,1.828
                        c7.251,0,13.149-5.896,13.149-13.149c0-7.251-5.898-13.148-13.149-13.148c-2.407,0-4.632,0.697-6.575,1.828v-8.403h32.872V114.755
                        z M108.554,65.446c0-3.625,2.949-6.574,6.575-6.574s6.574,2.948,6.574,6.574c0,3.626-2.948,6.575-6.574,6.575
                        S108.554,69.072,108.554,65.446z"/>
                </g>
            </g>
            <g>
                <g>
                    <path fill="#92c83e" d="M75.682,39.149c-7.251,0-13.148,5.897-13.148,13.148s5.897,13.148,13.148,13.148
                        c7.252,0,13.149-5.897,13.149-13.148S82.934,39.149,75.682,39.149z M75.682,58.873c-3.625,0-6.574-2.949-6.574-6.575
                        s2.949-6.575,6.574-6.575c3.627,0,6.575,2.949,6.575,6.575S79.309,58.873,75.682,58.873z"/>
                </g>
            </g>
            <g>
                <g>
                    <rect x="59.246" y="72.021" fill="#92c83e" width="32.873" height="6.574"/>
                </g>
            </g>
            <g>
                <g>
                    <rect x="59.246" y="85.17" fill="#92c83e" width="32.873" height="6.574"/>
                </g>
            </g>
        </svg>
    );

    class MYSProductSlider extends Component {
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
                arrowIcons,
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
                            <Fragment>
                                <SelectControl
                                    label={__('Order by')}
                                    value={orderBy}
                                    options={[
                                        { label: __('Newest to Oldest'), value: 'date' },
                                        { label: __('Menu Order'), value: 'menu_order' },
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
                        </PanelBody>

                        <PanelBody title={__('Slider Settings ')} initialOpen={false} className="range-setting">
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
                        <PanelBody title={__('Help')} initialOpen={false} className="range-setting">
                            <a href="https://nabshow-com.go-vip.net/2020/wp-content/uploads/sites/3/2019/11/product-slider.mp4" target="_blank">How to use block?</a>
                        </PanelBody>
                    </InspectorControls>
                    <ServerSideRender
                        block="mys/product-slider"
                        attributes={{ itemToFetch: itemToFetch, postType: postType, taxonomies: taxonomies, terms: terms, sliderActive: sliderActive, orderBy: orderBy, arrowIcons: arrowIcons }}
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
        }
    };
    registerBlockType('mys/product-slider', {
        title: __('Product Slider'),
        icon: { src: prodSlidertBlockIcon },
        category: 'mysgb',
        keywords: [__('product'), __('slider')],
        attributes: blockAttrs,
        edit: MYSProductSlider,
        save() {
            return null;
        },
    });

})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);