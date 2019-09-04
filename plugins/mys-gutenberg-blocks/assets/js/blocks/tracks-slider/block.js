import { sliderArrow1, sliderArrow2, sliderArrow3, sliderArrow4, sliderArrow5, sliderArrow6 } from '../icons';

(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    const { __ } = wpI18n;
    const { Component, Fragment } = wpElement;
    const { registerBlockType } = wpBlocks;
    const { InspectorControls } = wpEditor;
    const { PanelBody, Disabled, ToggleControl, SelectControl, TextControl, ServerSideRender, CheckboxControl, RangeControl } = wpComponents;

    class MYSTracksSlider extends Component {
        constructor() {
            super(...arguments);
            this.state = {
                bxSliderObj: {},
                bxinit: false,
                isDisable: false,
            };

            this.initSlider = this.initSlider.bind(this);
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
                    if (0 < $(`#block-${clientId} .nab-dynamic-slider`).length) {
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
                                    mode: 'horizontal'
                                }
                            );
                        }, 1000);
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
                featuredTrack
            } = attributes;

            var names = [
                { name: sliderArrow1, classnames: 'slider-arrow-1' },
                { name: sliderArrow2, classnames: 'slider-arrow-2' },
                { name: sliderArrow3, classnames: 'slider-arrow-3' },
                { name: sliderArrow4, classnames: 'slider-arrow-4' },
                { name: sliderArrow5, classnames: 'slider-arrow-5' },
                { name: sliderArrow6, classnames: 'slider-arrow-6' }
            ];

            let input = <div className="inspector-field inspector-field-Numberofitems ">
                <label className="inspector-mb-0">Number of items</label>
                <RangeControl
                    value={itemToFetch}
                    min={1}
                    max={20}
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
                                label={__('Tracks Order')}
                                value={order}
                                options={[
                                    { label: __('A → Z'), value: 'ASC' },
                                    { label: __('Z → A'), value: 'DESC' },
                                ]}
                                onChange={(value) => { setAttributes({ order: value }); this.setState({ bxinit: true }); }}
                            />
                            <CheckboxControl
                                label="Featured Tracks"
                                checked={ featuredTrack }
                                onChange={ () => {  setAttributes({ featuredTrack: ! featuredTrack }); this.setState({ bxinit: true }); } }
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
                        attributes={{ itemToFetch: itemToFetch, sliderActive: sliderActive, order: order, arrowIcons: arrowIcons, featuredTrack: featuredTrack }}
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
        featuredTrack: {
            type: 'boolean',
            default: false
        }
    };
    registerBlockType('mys/tracks-slider', {
        title: __('Tracks Slider'),
        icon: 'lock',
        category: 'mysgb',
        keywords: [__('tracks'), __('slider')],
        attributes: blockAttrs,
        edit: MYSTracksSlider,
        save() {
            return null;
        },
    });

})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);