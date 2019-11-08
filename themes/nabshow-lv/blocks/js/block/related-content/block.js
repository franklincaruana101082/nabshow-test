import { sliderArrow1, sliderArrow2, sliderArrow3, sliderArrow4, sliderArrow5, sliderArrow6, destinations, keyContacts, featuredHappening, productCategories, exhibitorResources, browseHappening, relatedContentTitleList, relatedContSideImgInfo, realtedContentCoLocatedEvents, realtedContentInfoOnly, realtedContentPlanShow } from '../icons';
(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    const { __ } = wpI18n;
    const { Component, Fragment } = wpElement;
    const { registerBlockType } = wpBlocks;
    const { InspectorControls } = wpEditor;
    const { PanelBody, Disabled, ToggleControl, RangeControl, RadioControl, ServerSideRender, Button, Placeholder, CheckboxControl, SelectControl, PanelRow } = wpComponents;

    const relatedContentBlockIcon = (
        <svg width="150px" height="150px" viewBox="181 181 150 150" enable-background="new 181 181 150 150">
            <path fill="#0F6CB6" d="M251.539,186.845h-58.001c-3.689,0-6.692,3.003-6.692,6.692v49.078c0,3.689,3.003,6.692,6.692,6.692h58.001
                c3.689,0,6.692-3.003,6.692-6.692v-49.078C258.23,189.848,255.228,186.845,251.539,186.845z M193.537,191.306h58.001
                c1.231,0,2.23,1.002,2.23,2.231v11.154h-62.463v-11.154C191.306,192.308,192.306,191.306,193.537,191.306z M251.539,244.846h-58.001
                c-1.231,0-2.231-1.001-2.231-2.23v-33.462h62.463v33.462C253.769,243.844,252.77,244.846,251.539,244.846z"/>
            <path fill="#0F6CB6" d="M195.768,195.768h4.461v4.461h-4.461V195.768z"/>
            <path fill="#0F6CB6" d="M213.615,195.768h4.461v4.461h-4.461V195.768z"/>
            <path fill="#0F6CB6" d="M204.691,195.768h4.461v4.461h-4.461V195.768z"/>
            <path fill="#0F6CB6" d="M227,213.615h-31.231v17.846h22.308v8.923h31.231v-17.847H227V213.615z M200.229,227v-8.923h22.308v4.461
                h-4.461V227H200.229z M244.846,235.923h-22.308V227h22.308V235.923z"/>
            <path fill="#0F6CB6" d="M251.539,262.692h-58.001c-3.689,0-6.692,3.003-6.692,6.692v49.078c0,3.689,3.003,6.692,6.692,6.692h58.001
                c3.689,0,6.692-3.003,6.692-6.692v-49.078C258.23,265.695,255.228,262.692,251.539,262.692z M193.537,267.154h58.001
                c1.231,0,2.23,1.001,2.23,2.23v11.154h-62.463v-11.154C191.306,268.155,192.306,267.154,193.537,267.154z M251.539,320.693h-58.001
                c-1.231,0-2.231-1.001-2.231-2.23v-33.462h62.463v33.462C253.769,319.692,252.77,320.693,251.539,320.693z"/>
            <path fill="#0F6CB6" d="M195.768,271.615h4.461v4.462h-4.461V271.615z"/>
            <path fill="#0F6CB6" d="M204.691,271.615h4.461v4.462h-4.461V271.615z"/>
            <path fill="#0F6CB6" d="M213.615,271.615h4.461v4.462h-4.461V271.615z"/>
            <path fill="#0F6CB6" d="M227,289.462h-31.231v17.847h22.308v8.924h31.231v-17.847H227V289.462z M200.229,293.924h22.308v8.923
                h-22.308V293.924z M244.846,302.847v8.924h-22.308v-4.462H227v-4.462H244.846z"/>
            <path fill="#0F6CB6" d="M314.001,215.845h-29v-11.154l-23.797,17.846l23.797,17.847V229.23h26.77v10.095
                c-2.098-0.745-4.344-1.171-6.692-1.171c-11.071,0-20.077,9.008-20.077,20.077v9.24c-1.774,0.964-3.423,2.184-4.891,3.652
                l-11.219,11.219c-3.999,3.995-6.199,9.307-6.199,14.962c0,11.667,9.492,21.159,21.159,21.159c5.65,0,10.965-2.202,14.962-6.197
                l11.219-11.219c3.418-3.415,5.528-7.877,6.052-12.657c5.457-3.597,9.071-9.767,9.071-16.774v-8.923v-4.462V227
                C325.155,220.849,320.151,215.845,314.001,215.845z M306.881,297.891l-11.219,11.218c-3.157,3.155-7.352,4.893-11.811,4.893
                c-9.207,0-16.697-7.49-16.697-16.697c0-4.462,1.735-8.653,4.89-11.808l11.219-11.219c3.156-3.154,7.351-4.893,11.81-4.893
                c5.702,0,10.9,2.888,13.965,7.599c-1.113,0.82-2.474,1.325-3.959,1.325c-1.615,0-3.173-0.585-4.529-1.759l-3.66-2.703h-1.816
                c-3.268,0-6.34,1.271-8.65,3.583l-11.221,11.221c-2.314,2.311-3.586,5.385-3.586,8.653c0,6.748,5.49,12.236,12.236,12.236
                c3.269,0,6.34-1.271,8.651-3.583l11.221-11.221c0.899-0.899,1.648-1.95,2.23-3.085c1.776-0.079,3.498-0.364,5.124-0.875
                C310.3,293.441,308.877,295.894,306.881,297.891L306.881,297.891z M311.771,271.615c0,0.467-0.05,0.92-0.141,1.359
                c-3.288-4.163-7.986-6.944-13.244-7.771v-6.974c0-3.689,3.002-6.692,6.692-6.692c3.689,0,6.692,3.003,6.692,6.692V271.615z
                M287.996,282.165c2.88,4.672,7.547,7.896,12.881,9.035c-0.109,0.122-0.189,0.266-0.306,0.381l-11.221,11.222
                c-1.471,1.468-3.422,2.275-5.499,2.275c-4.288,0-7.774-3.487-7.774-7.774c0-2.046,0.83-4.052,2.277-5.497L287.996,282.165z
                M320.693,271.615c0,8.611-7.007,15.616-15.615,15.616c-5.711,0-10.862-3.104-13.604-8.004c1.102-0.578,2.317-0.919,3.598-0.919
                h0.351l2.333,1.718c2.03,1.769,4.631,2.743,7.322,2.743c6.15,0,11.154-5.003,11.154-11.154V258.23
                c0-6.15-5.004-11.154-11.154-11.154s-11.154,5.004-11.154,11.154v6.749c-1.523,0.08-3.017,0.316-4.462,0.714v-7.463
                c0-8.61,7.007-15.615,15.616-15.615c8.608,0,15.615,7.005,15.615,15.615v4.462V271.615z M316.232,241.549V229.23
                c0-2.46-2.002-4.461-4.462-4.461h-31.231v6.692l-11.897-8.923l11.897-8.923v6.692h33.462c3.689,0,6.692,3.003,6.692,6.692v18.641
                C319.42,244.063,317.918,242.68,316.232,241.549z"/>
        </svg>
    );

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

            if (this.state.isDisable && sliderActive && ! isNaN( itemToFetch )) {
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
        icon: { src: relatedContentBlockIcon },
        keywords: [__('related'), __('content')],
        attributes: allAttr,
        edit: NABRelatedContent,
        save() {
            return null;
        },
    });

})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);