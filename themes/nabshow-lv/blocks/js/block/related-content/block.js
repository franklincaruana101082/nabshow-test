import { sliderArrow1, sliderArrow2, sliderArrow3, sliderArrow4, sliderArrow5, sliderArrow6, destinations, keyContacts, featuredHappening, productCategories, exhibitorResources, browseHappening, relatedContentTitleList, relatedContSideImgInfo, realtedContentCoLocatedEvents, realtedContentInfoOnly, realtedContentPlanShow } from '../icons';
(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    const { __ } = wpI18n;
    const { Component, Fragment } = wpElement;
    const { registerBlockType } = wpBlocks;
    const { InspectorControls } = wpEditor;
    const { PanelBody, Disabled, ToggleControl, RangeControl, RadioControl, ServerSideRender, Button, Placeholder, CheckboxControl, SelectControl, PanelRow } = wpComponents;

    class NABRelatedContent extends Component {
        constructor() {
            super(...arguments);
            this.state = {
                pageParentList: [{ label: __('Select Parent Page'), value: '' }],
                bxSliderObj: {},
                bxinit: false,
                isDisable: false,
                displayFieldsList: [{ label: __('Date'), value: 'date_group' },
                { label: __('Halls'), value: 'page_hall' },
                { label: __('Is Open To'), value: 'is_open_to' },
                { label: __('Locations'), value: 'page_location' },
                { label: __('Price'), value: 'price' },
                { label: __('Registration Access'), value: 'reg_access' }],
            };
            this.initSlider = this.initSlider.bind(this);
        }

        componentDidMount() {
            const { selection, sliderActive } = this.props.attributes;
            if (sliderActive && selection) {
                this.setState({ bxinit: true });
            }
        }

        componentWillMount() {
            let pageList = [{ label: __('Select Parent Page'), value: '' }];

            // Fetch all parent pages
            wp.apiFetch({ path: '/nab_api/request/page-parents' }).then((parents) => {
                if (0 < parents.length) {
                    parents.map((parent) => {
                        pageList.push({ label: __(parent.title), value: parent.id });
                    });
                    this.setState({ pageParentList: pageList });
                }
            });

        }

        componentDidUpdate() {
            const { clientId, attributes: { selection, minSlides, autoplay, infiniteLoop, pager, controls, sliderSpeed, slideWidth, sliderActive, slideMargin } } = this.props;
            if (sliderActive && selection) {
                if (this.state.bxinit) {
                    setTimeout(() => this.initSlider(), 500);
                    this.setState({ bxinit: false });
                } else {
                    if (0 < $(`#block-${clientId} .nab-dynamic-slider`).length && this.state.bxSliderObj && undefined !== this.state.bxSliderObj.reloadSlider) {
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

        render() {
            const { attributes: { parentPageId, selection, itemToFetch, depthLevel, featuredPage, minSlides, autoplay, infiniteLoop, pager, controls, sliderSpeed, sliderActive, slideWidth, slideMargin, arrowIcons, displayField, listingLayout, sliderLayout }, setAttributes } = this.props;

            let names = [
                { name: sliderArrow1, classnames: 'slider-arrow-1' },
                { name: sliderArrow2, classnames: 'slider-arrow-2' },
                { name: sliderArrow3, classnames: 'slider-arrow-3' },
                { name: sliderArrow4, classnames: 'slider-arrow-4' },
                { name: sliderArrow5, classnames: 'slider-arrow-5' },
                { name: sliderArrow6, classnames: 'slider-arrow-6' },
                { name: sliderArrow6, classnames: 'slider-arrow-6' }
            ];

            let commonControls = <Fragment>
                <SelectControl
                    label={__('Choose option to get related content')}
                    value={parentPageId}
                    options={this.state.pageParentList}
                    onChange={(value) => { setAttributes({ parentPageId: value }); this.setState({ bxinit: true }); }}
                />
                <div className="inspector-field inspector-field-radiocontrol ">
                    <RadioControl
                        selected={depthLevel}
                        options={[
                            { label: 'Grand Children', value: 'grandchildren' },
                            { label: 'Direct Descendants', value: 'descendants' },
                        ]}
                        onChange={(option) => { setAttributes({ depthLevel: option }); this.setState({ bxinit: true }); }}
                    />
                </div>
            </Fragment>;

            let input = <div className="inspector-field inspector-field-Numberofitems ">
                <label className="inspector-mb-0">Number of items</label>
                <RangeControl
                    value={itemToFetch}
                    min={1}
                    max={100}
                    onChange={(item) => { setAttributes({ itemToFetch: parseInt(item) }); this.setState({ bxinit: true, isDisable: true }); }}
                />
            </div>;

            if (this.state.isDisable && sliderActive) {
                input = <Disabled>{input}</Disabled>;
            }

            if (! selection) {
                return (
                    <Placeholder
                        label={__('Related Content')}
                    >
                        {commonControls}
                        <Button className="button button-large button-primary" onClick={() => { setAttributes({ selection: true }); this.setState({ bxinit: true }); }} >
                            {__('Apply')}
                        </Button>
                    </Placeholder>
                );
            }
            return (
                <Fragment>
                    <InspectorControls>
                        <PanelBody title={__('Data Settings')}>
                            {input}
                            {commonControls}
                            {'side-img-info' !== listingLayout &&
                                <CheckboxControl
                                    className="related-featured"
                                    label="Featured Page"
                                    checked={featuredPage}
                                    onChange={() => { setAttributes({ featuredPage: ! featuredPage }); this.setState({ bxinit: true }); }}
                                />
                            }
                        </PanelBody>
                        <PanelBody title={__('Slider Settings ')} initialOpen={false} className="range-setting">
                            {sliderActive &&
                                <div>
                                    <label>{__('Select Slider Layout')}</label>
                                    <PanelRow>
                                        <ul className="ss-off-options related-off">
                                            <li className={'img-only' === sliderLayout ? 'active img-only' : 'img-only'} onClick={() => { setAttributes({ sliderLayout: 'img-only' }); this.setState({ bxinit: true }); }}>{productCategories}</li>
                                            <li className={'related-content-slider-info' === sliderLayout ? 'active related-content-slider-info' : 'related-content-slider-info'} onClick={() => { setAttributes({ sliderLayout: 'related-content-slider-info' }); this.setState({ bxinit: true }); }}>{featuredHappening}</li>
                                            <li className={'related-content-slider-events' === sliderLayout ? 'active related-content-slider-events' : 'related-content-slider-events'} onClick={() => { setAttributes({ sliderLayout: 'related-content-slider-events' }); this.setState({ bxinit: true }); }}>{realtedContentCoLocatedEvents}</li>
                                        </ul>
                                    </PanelRow>
                                </div>
                            }
                            <ToggleControl
                                label={__('Slider On/Off')}
                                checked={sliderActive}
                                onChange={() => { setAttributes({ sliderActive: ! sliderActive }); this.setState({ bxinit: ! sliderActive }); }}
                            />
                            {! sliderActive &&
                                <Fragment>
                                    <div>
                                        <label>{__('Select Listing Layout')}</label>
                                        <PanelRow>
                                            <ul className="ss-off-options related-off">
                                                <li className={'destination' === listingLayout ? 'active destination' : 'destination'} onClick={() => setAttributes({ listingLayout: 'destination' })}>{destinations}</li>
                                                <li className={'key-contacts' === listingLayout ? 'active key-contacts' : 'key-contacts'} onClick={() => setAttributes({ listingLayout: 'key-contacts' })}>{keyContacts}</li>
                                                <li className={'featured-happenings' === listingLayout ? 'active featured-happenings' : 'featured-happenings'} onClick={() => setAttributes({ listingLayout: 'featured-happenings' })}>{featuredHappening}</li>
                                                <li className={'product-categories' === listingLayout ? 'active product-categories' : 'product-categories'} onClick={() => setAttributes({ listingLayout: 'product-categories' })}>{productCategories}</li>
                                                <li className={'exhibitor-resources' === listingLayout ? 'active exhibitor-resources' : 'exhibitor-resources'} onClick={() => setAttributes({ listingLayout: 'exhibitor-resources' })}>{exhibitorResources}</li>
                                                <li className={'browse-happenings' === listingLayout ? 'active browse-happenings' : 'browse-happenings'} onClick={() => setAttributes({ listingLayout: 'browse-happenings' })}>{browseHappening}</li>
                                                <li className={'title-list' === listingLayout ? 'active title-list' : 'title-list'} onClick={() => setAttributes({ listingLayout: 'title-list' })}>{relatedContentTitleList}</li>
                                                <li className={'side-img-info' === listingLayout ? 'active side-img-info' : 'side-img-info'} onClick={() => setAttributes({ listingLayout: 'side-img-info' })}>{relatedContSideImgInfo}</li>
                                                <li className={'side-info' === listingLayout ? 'active side-info' : 'side-info'} onClick={() => setAttributes({ listingLayout: 'side-info' })}>{realtedContentInfoOnly}</li>
                                                <li className={'plan-your-show' === listingLayout ? 'active plan-your-show' : 'plan-your-show'} onClick={() => setAttributes({ listingLayout: 'plan-your-show' })}>{realtedContentPlanShow}</li>
                                            </ul>
                                        </PanelRow>
                                    </div>
                                    <label>{__('Select Fields to Display')}</label>
                                    <div className="fix-height-select">

                                        {this.state.displayFieldsList.map((field, index) => (

                                            <Fragment key={index}>

                                                <CheckboxControl checked={-1 < displayField.indexOf(field.value)} label={field.label} name="displayfields[]" value={field.value} onChange={(isChecked) => {

                                                    let index,
                                                        tempDisplayField = [...displayField];

                                                    if (isChecked) {
                                                        tempDisplayField.push(field.value);
                                                    } else {
                                                        index = tempDisplayField.indexOf(field.value);
                                                        tempDisplayField.splice(index, 1);
                                                    }

                                                    this.props.setAttributes({ displayField: tempDisplayField });
                                                }
                                                }
                                                />

                                            </Fragment>

                                        ))
                                        }
                                    </div>

                                </Fragment>
                            }
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
                        {sliderActive && controls &&
                            <PanelBody title={__('Slider Arrow')} initialOpen={false} className="range-setting">
                                <ul className="slider-arrow-main">
                                    {names.map((item, index) => (
                                        < Fragment key={index}>
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
                        block="nab/related-content"
                        attributes={{ parentPageId: parentPageId, itemToFetch: itemToFetch, depthLevel: depthLevel, featuredPage: featuredPage, sliderActive: sliderActive, arrowIcons: arrowIcons, displayField: displayField, listingLayout: listingLayout, sliderLayout: sliderLayout }}
                    />
                </Fragment>

            );
        }
    }

    const allAttr = {
        itemToFetch: {
            type: 'number',
            default: 10
        },
        parentPageId: {
            type: 'string',
        },
        selection: {
            type: 'boolean',
            default: false
        },
        depthLevel: {
            type: 'string',
            default: 'grandchildren'

        },
        featuredPage: {
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
        displayField: {
            type: 'array',
            default: []
        },
        listingLayout: {
            type: 'string',
            default: 'destination'
        },
        sliderLayout: {
            type: 'string',
            default: 'img-only'
        }
    };

    registerBlockType('nab/related-content', {
        title: __('Related Content'),
        icon: 'excerpt-view',
        category: 'nabshow',
        keywords: [__('related'), __('content')],
        attributes: allAttr,
        edit: NABRelatedContent,
        save() {
            return null;
        },
    });

})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);