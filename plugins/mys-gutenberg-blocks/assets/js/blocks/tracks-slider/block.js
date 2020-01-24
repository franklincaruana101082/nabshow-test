import { sliderArrow1, sliderArrow2, sliderArrow3, sliderArrow4, sliderArrow5, sliderArrow6, sliderArrow7, sliderArrow8 } from '../icons';

(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    const { __ } = wpI18n;
    const { Component, Fragment } = wpElement;
    const { registerBlockType } = wpBlocks;
    const { InspectorControls } = wpEditor;
    const { PanelBody, Disabled, ToggleControl, SelectControl, ServerSideRender, CheckboxControl, RangeControl, TextareaControl, TextControl } = wpComponents;

    const trackSliderBlockIcon = (
        <svg width="150px" height="150px" viewBox="0 0 150 150" enable-background="new 0 0 150 150">
            <rect fill="none" width="150" height="150"/>
            <g>
                <path fill="#92c83e" d="M31.25,110V40h87.5v70H31.25z M5,101.25v-52.5h17.5v52.5H5z M40,48.75v52.5h70v-52.5H40z M127.5,48.75H145
                    v52.5h-17.5V48.75z M101.25,66.25V57.5h-52.5v8.75H101.25z M101.25,92.5V75h-52.5v17.5H101.25z"/>
            </g>
        </svg>
    );

    class MYSCategorySlider extends Component {
        constructor() {
            super(...arguments);
            this.state = {
                bxSliderObj: {},
                bxinit: false,
                hallOptions: [],
                termsObj: {},
                filterTermsObj: {},
                isDisable: false,
            };

            this.initSlider = this.initSlider.bind(this);
        }

      componentWillMount() {
        let hallList = [];

        // Fetch block categories terms
        wp.apiFetch({ path: '/nab_api/request/category-block-terms' }).then((terms) => {
          this.setState({ termsObj: terms, filterTermsObj: terms });
        });

        // Fetch all Halls
        wp.apiFetch({ path: '/wp/v2/halls' }).then((halls) => {
          if ( 0 < halls.length ) {
            halls.forEach(function (hall) {
              hallList.push({ label: __(hall.name), value: hall.id });
            });
            this.setState({ hallOptions: hallList });
          }
        });

      }

        componentDidMount() {
            this.setState({ bxinit: true });
        }

        componentDidUpdate() {
            const { clientId, attributes: { minSlides, autoplay, infiniteLoop, pager, controls, sliderSpeed, slideWidth, sliderActive, slideMargin } } = this.props;
            if (sliderActive) {
                if (this.state.bxinit) {
                    setTimeout(() => this.initSlider(), 700);
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

        filterTerms(value, taxonomy) {
          let filterTerms = {};
          let blockCategories = ['tracks', 'exhibitor-categories', 'session-categories'];
          blockCategories.map((tax) => {
            if (taxonomy === tax) {
              filterTerms[tax] = this.state.termsObj[tax].filter(term => -1 < term.name.toLowerCase().indexOf(value.toLowerCase()));
            } else {
              filterTerms[tax] = this.state.termsObj[tax];
            }

          });
          this.setState({ filterTermsObj: filterTerms });
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
                slideWidth,
                order,
                slideMargin,
                arrowIcons,
                featuredTag,
                categoryType,
                categoryHalls,
                includeTerms
            } = attributes;

            var names = [
                { name: sliderArrow1, classnames: 'slider-arrow-1' },
                { name: sliderArrow2, classnames: 'slider-arrow-2' },
                { name: sliderArrow3, classnames: 'slider-arrow-3' },
                { name: sliderArrow4, classnames: 'slider-arrow-4' },
                { name: sliderArrow5, classnames: 'slider-arrow-5' },
                { name: sliderArrow6, classnames: 'slider-arrow-6' },
                { name: sliderArrow7, classnames: 'slider-arrow-7' },
                { name: sliderArrow8, classnames: 'slider-arrow-8' }
            ];

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
                            {input}
                            <SelectControl
                                label={__('Category Type')}
                                value={categoryType}
                                options={[
                                    { label: __('Tracks'), value: 'tracks' },
                                    { label: __('Exhibitors Categories'), value: 'exhibitor-categories' },
                                    { label: __('Session Categories'), value: 'session-categories' },
                                ]}
                                onChange={(value) => { setAttributes({ categoryType: value, includeTerms: [] }); this.setState({ bxinit: true }); }}
                            />

                            { this.state.termsObj &&
                              <Fragment>

                                { undefined !== this.state.filterTermsObj[categoryType] &&

                                    <div>
                                      <label>{__('Choose include items')}</label>

                                      { 7 < this.state.termsObj[categoryType].length &&
                                      <TextControl
                                        type="string"
                                        name={categoryType}
                                        onChange={value => this.filterTerms(value, categoryType)}
                                      />
                                      }

                                      <div className="fix-height-select">

                                        {this.state.filterTermsObj[categoryType].map((term, index) => (

                                          <Fragment key={index}>

                                            <CheckboxControl
                                              checked={ -1 < includeTerms.indexOf(term.term_id)}
                                              label={term.name}
                                              name={`${categoryType}[]`}
                                              value={term.term_id}
                                              onChange={(isChecked) => {

                                                let index,
                                                  tempIncludeTerms = [...includeTerms];

                                                if (isChecked) {
                                                  tempIncludeTerms.push(term.term_id);
                                                } else {
                                                  index = tempIncludeTerms.indexOf(term.term_id);
                                                  tempIncludeTerms.splice(index, 1);
                                                }

                                                this.props.setAttributes({ includeTerms: tempIncludeTerms});
                                                this.setState({ bxinit: true });
                                              }
                                              }
                                            />
                                          </Fragment>
                                        ))
                                        }
                                      </div>
                                    </div>
                                }
                              </Fragment>
                            }

                            { 'exhibitor-categories' === categoryType &&
                              <Fragment>
                                <label>{__('Filter by Halls')}</label>

                                <div className="fix-height-select mb20">

                                  {this.state.hallOptions.map((field, index) => (

                                    <Fragment key={index}>

                                      <CheckboxControl checked={-1 < categoryHalls.indexOf(field.value)} label={field.label} name="hallList[]" value={field.value} onChange={(isChecked) => {

                                        let index,
                                          tempCategoryHalls = [...categoryHalls];

                                        if (isChecked) {
                                          tempCategoryHalls.push(field.value);
                                        } else {
                                          index = tempCategoryHalls.indexOf(field.value);
                                          tempCategoryHalls.splice(index, 1);
                                        }

                                        this.props.setAttributes({ categoryHalls: tempCategoryHalls });
                                        if ( sliderActive ) {
                                          this.setState({ bxinit: true });
                                        }
                                      }
                                      }
                                      />

                                    </Fragment>

                                  ))
                                  }
                                </div>
                              </Fragment>
                            }

                            <SelectControl
                                label={__('Display Order')}
                                value={order}
                                options={[
                                    { label: __('Alphabetically'), value: 'ASC' },
                                    { label: __('Random'), value: 'rand' },
                                ]}
                                onChange={(value) => { setAttributes({ order: value }); this.setState({ bxinit: true }); }}
                            />
                            <CheckboxControl
                                label="Featured"
                                checked={ featuredTag }
                                onChange={ () => {  setAttributes({ featuredTag: ! featuredTag }); this.setState({ bxinit: true }); } }
                            />
                        </PanelBody>
                        <PanelBody title={__('Slider Settings ')} initialOpen={false} className="range-setting">
                            <ToggleControl
                                label={__('Slider On/Off')}
                                checked={sliderActive}
                                onChange={() => { setAttributes({ sliderActive: ! sliderActive}); this.setState({ bxinit: ! sliderActive }); } }
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
                        <Fragment>
                            {controls &&
                            <PanelBody title={__('Slider Arrow')} initialOpen={false} className="range-setting">
                                <ul className="slider-arrow-main">
                                    {names.map((item, index) => (
                                        < Fragment key={index}>
                                            <li
                                                className={`${item.classnames} ${arrowIcons === item.classnames ? 'active' : ''}`}
                                                key={index}
                                                onClick={e => {
                                                    setAttributes({arrowIcons: item.classnames});
                                                    this.setState({bxinit: true});
                                                }}
                                            >{item.name}</li>
                                        </Fragment>
                                    ))
                                    }
                                </ul>
                            </PanelBody>
                            }
                        </Fragment>
                        }
                    </InspectorControls>
                    <ServerSideRender
                        block="mys/tracks-slider"
                        attributes={{ itemToFetch: itemToFetch, sliderActive: sliderActive, order: order, arrowIcons: arrowIcons, featuredTag: featuredTag, categoryType: categoryType, categoryHalls: categoryHalls, includeTerms: includeTerms }}
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
        slideWidth: {
            type: 'number',
            default: 400
        },
        order: {
            type: 'string',
            default: 'ASC'
        },
        slideMargin: {
            type: 'number',
            default: 30
        },
        arrowIcons: {
            type: 'string',
            default: 'slider-arrow-1'
        },
        featuredTag: {
            type: 'boolean',
            default: false
        },
        categoryType: {
            type: 'string',
            default: 'tracks'
        },
        categoryHalls: {
            type: 'array',
            default: []
        },
        includeTerms: {
          type: 'array',
          default: []
        },
    };
    registerBlockType('mys/tracks-slider', {
        title: __('Category Slider'),
        icon: { src: trackSliderBlockIcon },
        category: 'mysgb',
        keywords: [__('tracks'), __('exhibitors'), __('category')],
        attributes: blockAttrs,
        edit: MYSCategorySlider,
        save() {
            return null;
        },
    });

})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);
