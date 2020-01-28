import pick from 'lodash/pick';
import { sliderArrow1, sliderArrow2, sliderArrow3, sliderArrow4, sliderArrow5, sliderArrow6, sliderArrow7, sliderArrow8 } from '../icons';

(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    const { __ } = wpI18n;
    const { Component, Fragment } = wpElement;
    const { registerBlockType } = wpBlocks;
    const { InspectorControls, MediaUpload } = wpEditor;
    const { PanelBody, RangeControl, ToggleControl, SelectControl, TextControl, TextareaControl, IconButton, Button, Placeholder, Tooltip, PanelRow, ColorPalette } = wpComponents;

    const mediaSliderBlockIcon = (
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="2 2 22 22" className="dashicon">
            <path fill="none" d="M0 0h24v24H0V0z" />
            <path d="M20 4h-3.17L15 2H9L7.17 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zM9.88 4h4.24l1.83 2H20v12H4V6h4.05" />
            <path d="M15 11H9V8.5L5.5 12 9 15.5V13h6v2.5l3.5-3.5L15 8.5z" />
        </svg>
    );

    const sliderBlockIcon = (
        <svg width="150px" height="150px" viewBox="222.64 222.641 150 150" enable-background="new 222.64 222.641 150 150">
            <g>
                <g>
                    <g>
                        <path fill="#0F6CB6" d="M366.284,244.251H228.996c-1.405,0-2.542,1.137-2.542,2.542v17.797v50.848v33.051
                            c0,1.405,1.137,2.542,2.542,2.542h137.288c1.405,0,2.543-1.137,2.543-2.542v-33.051v-50.848v-17.797
                            C368.827,245.388,367.689,244.251,366.284,244.251z M231.538,267.132h22.882v45.763h-22.882V267.132z M363.743,312.896h-7.629
                            v-45.763h7.629V312.896z M363.743,262.047h-10.171c-1.405,0-2.542,1.137-2.542,2.543v50.847c0,1.406,1.137,2.543,2.542,2.543
                            h10.171v27.967H231.538v-0.001v-27.967h25.424c1.405,0,2.542-1.137,2.542-2.542v-50.848c0-1.405-1.137-2.543-2.542-2.543h-25.424
                            v-12.711h132.205V262.047z"/>
                        <circle fill="#0F6CB6" cx="300.183" cy="333.234" r="5.085"/>
                        <path fill="#0F6CB6" d="M269.674,317.98h71.187c1.405,0,2.543-1.138,2.543-2.543v-50.848c0-1.405-1.138-2.542-2.542-2.542
                            h-71.188c-1.406,0-2.543,1.137-2.543,2.543v50.847C267.131,316.843,268.268,317.98,269.674,317.98z M272.216,267.132h66.102
                            v45.763h-66.102V267.132z"/>
                        <rect x="269.674" y="330.691" fill="#0F6CB6" width="7.627" height="5.085"/>
                        <rect x="282.386" y="330.691" fill="#0F6CB6" width="7.627" height="5.085"/>
                        <rect x="310.352" y="330.691" fill="#0F6CB6" width="7.628" height="5.085"/>
                        <rect x="323.064" y="330.691" fill="#0F6CB6" width="7.627" height="5.085"/>
                    </g>
                </g>
            </g>
        </svg>
    );

    const nabInsertMedaitoSlide = (sourceURL, attributes) => {
        const {fixedWidth, fixedHeight} = attributes;
        if (nabIsImage(sourceURL)) {
            return (
                <img src={`${sourceURL}${fixedHeight ? `?h=${fixedHeight ? fixedHeight : ''}&w=${fixedWidth ? fixedWidth : ''}` : ''}`}
                    className="media-slider-img"
                    alt={__('Slider image')}
                />
            );
        } else {
            return (
                <video src={sourceURL}
                    className="media-slider-vid"
                    controls
                >
                </video>
            );
        }
    };

    const nabIsImage = (sourceURL) => {
        const imageExtension = ['jpg', 'jpeg', 'png', 'gif', 'PNG', 'JPG', 'JPEG', 'GIF'];
        const fileExtension = sourceURL.split('.').pop();
        if (-1 < imageExtension.indexOf(fileExtension)) {
            return true;
        } else {
            return false;
        }
    };

    class featuredBoxesComp extends Component {
        constructor() {
            super(...arguments);
            this.state = {
                currentSelected: 0,
                inited: false,
                bxSliderObj: {},
            };

            this.initSlider = this.initSlider.bind(this);
            this.reloadSlider = this.reloadSlider.bind(this);
        }

        componentDidMount() {
            const { attributes } = this.props;
            if (attributes.media.length && attributes.sliderActive) {
                this.initSlider();
            }
        }

        componentDidUpdate(prevProps) {
            const { attributes } = this.props;
            const { media, autoplay, speed, infiniteLoop, pager, controls, minSlides, slideWidth, slideMargin, sliderActive } = attributes;
            const { media: prevMedia } = prevProps.attributes;
            if (media.length !== prevMedia.length  && sliderActive) {
                if (0 === prevMedia.length) {
                    setTimeout(() => this.initSlider(), 10);
                } else {
                    this.state.bxSliderObj.reloadSlider();
                }
            }
            if (sliderActive !== prevProps.attributes.sliderActive) {
                if (0 < this.state.bxSliderObj.length && ! sliderActive) {
                    this.state.bxSliderObj.destroySlider();
                    this.setState({ bxSliderObj: {} });
                } else {
                    this.initSlider();
                }
            }
            if (minSlides !== prevProps.attributes.minSlides && sliderActive) {
                this.reloadSlider();
            }
            if (slideWidth !== prevProps.attributes.slideWidth && sliderActive) {
                this.reloadSlider();
            }
            if (slideMargin !== prevProps.attributes.slideMargin && sliderActive) {
                this.reloadSlider();
            }
            if (autoplay !== prevProps.attributes.autoplay && sliderActive) {
                this.reloadSlider();
            }
            if (speed !== prevProps.attributes.speed && sliderActive) {
                this.reloadSlider();
            }
            if (infiniteLoop !== prevProps.attributes.infiniteLoop && sliderActive) {
                this.reloadSlider();
            }
            if (pager !== prevProps.attributes.pager && sliderActive) {
                this.reloadSlider();
            }
            if (controls !== prevProps.attributes.controls && sliderActive) {
                this.reloadSlider();
            }
        }

        initSlider() {
            if (this.props.attributes.sliderActive){
                const { clientId } = this.props;
                const { autoplay, speed, infiniteLoop, pager, controls, minSlides, slideWidth, slideMargin } = this.props.attributes;
                const sliderObj = jQuery(`#block-${clientId} .nab-media-slider`).bxSlider({
                    minSlides: minSlides, maxSlides: minSlides, slideMargin: slideMargin, slideWidth: slideWidth,  auto: autoplay, speed: speed, controls: controls, infiniteLoop: infiniteLoop, pager: pager, stopAutoOnClick: true, autoHover: true,
                    onSlideAfter: function ($slideElement, oldIndex, newIndex) {
                        this.setState({ currentSelected: newIndex });
                    }.bind(this)
                });
                this.setState({ bxSliderObj: sliderObj });
            }
        }

        reloadSlider(e) {
            if (this.props.attributes.sliderActive){
                const { autoplay, speed, infiniteLoop, pager, controls, minSlides, slideWidth, slideMargin } = this.props.attributes;
                this.state.bxSliderObj.reloadSlider(
                    { minSlides: minSlides, maxSlides: minSlides, slideMargin: slideMargin, slideWidth: slideWidth, auto: autoplay, speed: speed, infiniteLoop: infiniteLoop, pager: pager, controls: controls, stopAutoOnClick: true, autoHover: true, }
                );
            }
        }

        moveMedia(currentIndex, newIndex) {
            const { setAttributes, attributes } = this.props;
            const { media } = attributes;

            const currentMedia = media[currentIndex];
            setAttributes({
                media: [
                    ...media.filter((img, idx) => idx !== currentIndex).slice(0, newIndex),
                    currentMedia,
                    ...media.filter((img, idx) => idx !== currentIndex).slice(newIndex),
                ]
            });
        }

        updateMediaData(data) {
            const { currentSelected } = this.state;
            if ('number' !== typeof currentSelected) {
                return null;
            }

            const { attributes, setAttributes } = this.props;
            const { media } = attributes;

            const newMedia = media.map((media, index) => {
                if (index === currentSelected) {
                    media = Object.assign({}, media, data);
                }

                return media;
            });

            setAttributes({ media: newMedia });
        }


        render() {
            const { attributes, setAttributes, isSelected } = this.props;
            const { currentSelected } = this.state;
            const {
                media,
                autoplay,
                speed,
                infiniteLoop,
                pager,
                controls,
                detailAnimation,
                arrowIcons,
                minSlides,
                slideWidth,
                slideMargin,
                sliderActive,
                fixedWidth,
                fixedHeight
            } = attributes;

            let arrowNames = [
                { name: sliderArrow1, classnames: 'slider-arrow-1' },
                { name: sliderArrow2, classnames: 'slider-arrow-2' },
                { name: sliderArrow3, classnames: 'slider-arrow-3' },
                { name: sliderArrow4, classnames: 'slider-arrow-4' },
                { name: sliderArrow5, classnames: 'slider-arrow-5' },
                { name: sliderArrow6, classnames: 'slider-arrow-6' },
                { name: sliderArrow7, classnames: 'slider-arrow-7' },
                { name: sliderArrow8, classnames: 'slider-arrow-8' }
            ];


            if (0 === media.length) {
                return (
                    <Placeholder
                        icon={mediaSliderBlockIcon}
                        label={__('featured-boxes Block')}
                        instructions={__('No media selected. Adding media to start using this block.')}
                    >
                        <MediaUpload
                            value={null}
                            multiple
                            onSelect={(item) => {
                                const mediaInsert = item.map((source) => ({
                                    url: source.url,
                                    id: source.id,
                                }));

                                setAttributes({
                                    media: [
                                        ...media,
                                        ...mediaInsert,
                                    ]
                                });
                            }}
                            render={({ open }) => (
                                <Button className="button button-large button-primary" onClick={open}>
                                    {__('Add media')}
                                </Button>
                            )}
                        />
                    </Placeholder>
                );
            }
            return (
                <Fragment>
                    <InspectorControls>
                        <PanelBody title={__('Slider Settings')} initialOpen={false}>
                            <ToggleControl
                                label={__('Slider Active')}
                                checked={sliderActive}
                                onChange={() => {
                                    setAttributes({ sliderActive: ! sliderActive });
                                }}
                            />
                            <ToggleControl
                                label={__('Pager')}
                                checked={pager}
                                onChange={() => {
                                    setAttributes({ pager: ! pager });
                                }}
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
                            <div className="inspector-field inspector-slider-speed" >
                                <label>Speed</label>
                                <RangeControl
                                    value={speed}
                                    min={100}
                                    max={2000}
                                    onChange={speed => setAttributes({ speed: speed })}
                                />
                            </div>
                            <div className="inspector-field inspector-slider-speed" >
                                <label className="inspector-mb-0">Items to Display</label>
                                <RangeControl
                                    value={minSlides}
                                    min={4}
                                    max={10}
                                    step={1}
                                    onChange={value => setAttributes({minSlides: value})}
                                />
                            </div>
                            <div className="inspector-field inspector-field-fontsize ">
                                <label className="inspector-mb-0">Slide Width</label>
                                <RangeControl
                                    value={slideWidth}
                                    min={50}
                                    max={1000}
                                    step={1}
                                    onChange={value => setAttributes({slideWidth: value})}
                                />
                            </div>
                            <div className="inspector-field inspector-field-fontsize ">
                                <label className="inspector-mb-0">Slide Margin</label>
                                <RangeControl
                                    value={slideMargin}
                                    min={0}
                                    max={100}
                                    step={1}
                                    onChange={value => setAttributes({slideMargin: value})}
                                />
                            </div>
                        </PanelBody>
                        {
                            controls ? (
                                <PanelBody title={__('Slider Arrow')} initialOpen={false}>
                                    <ul className="slider-arrow-main">
                                        {arrowNames.map((item, index) => (
                                            < Fragment key={index} >
                                                <li
                                                    className={`${item.classnames} ${arrowIcons === item.classnames ? 'active' : ''}`}
                                                    key={index}
                                                    onClick={e => {
                                                        setAttributes({ arrowIcons: item.classnames });
                                                    }}
                                                >{item.name}</li>
                                            </Fragment>
                                        ))
                                        }
                                    </ul>
                                </PanelBody>
                            ) : ''
                        }
                        <PanelBody title={__('Image Dimension')} initialOpen={false}>
                            <PanelRow>
                                <TextControl
                                    type="number"
                                    label="Fixed Width"
                                    min="1"
                                    value={fixedWidth}
                                    placeholder="Fixed Width"
                                    onChange={(value) => setAttributes({ fixedWidth: value })}
                                />
                            </PanelRow>
                            <PanelRow>
                                <TextControl
                                    type="number"
                                    label="Fixed Height"
                                    min="1"
                                    value={fixedHeight}
                                    placeholder="Fixed Height"
                                    onChange={(value) => setAttributes({ fixedHeight: value })}
                                />
                            </PanelRow>
                        </PanelBody>
                    </InspectorControls>
                    <div className={`nab-media-slider-block slider-arrow-main ${arrowIcons}`}>
                        <div className={sliderActive ? 'nab-media-slider' : 'feature-box-list'} data-animation={detailAnimation} data-autoplay={`${autoplay}`} data-speed={`${speed}`} data-infiniteloop={`${infiniteLoop}`} data-pager={`${pager}`} data-controls={`${controls}`}>
                            {media.map((source, index) => (
                                <div className={'nab-media-slider-item'} key={index}

                                >
                                    {nabInsertMedaitoSlide(source.url, attributes)}
                                   {source.link && (
                                        <a className="nab-media-slider-link"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            href={source.link}
                                        />
                                    )}
                                </div>
                            ))}
                        </div>
                        {isSelected && (
                            <div className="nab-media-slider-slide-list">
                            {media.map((source, index) => (
                                <div className={`nab-media-slider-slide-list-item ${currentSelected == index ? 'active' : ''}`} key={index}>
                                    {0 < index && (
                                        <Tooltip text={__('Move Left')}>
                                            <span className="nab-move-arrow nab-move-left"
                                                onClick={() => this.moveMedia(index, index - 1)}
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                    <path fill="none" d="M0 0h24v24H0V0z" />
                                                    <path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6 1.41-1.41z" />
                                                </svg>
                                            </span>
                                        </Tooltip>
                                    )}
                                    {nabIsImage(source.url) && (
                                        <img src={source.url}
                                            className="nab-media-slider-img"
                                            alt={__('Remove')}
                                            height="100px"
                                            width="100px"
                                            onClick={() => {
                                                if (sliderActive){
                                                    this.state.bxSliderObj.goToSlide(index);
                                                }
                                                this.setState({ currentSelected: index });
                                            }}
                                        />
                                    )}
                                    {! nabIsImage(source.url) && (
                                        <video src={source.url}
                                            className="nab-media-slider-vid"
                                            height="100px"
                                            width="100px"
                                            onClick={() => {
                                                if (sliderActive){
                                                    this.state.bxSliderObj.goToSlide(index);
                                                }
                                                this.setState({ currentSelected: index });
                                            }}
                                        >
                                        </video>
                                    )}
                                    {index + 1 < media.length && (
                                        <Tooltip text={__('Move Right')}>
                                            <span className="nab-move-arrow nab-move-right"
                                                onClick={() => this.moveMedia(index, index + 1)}
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                    <path fill="none" d="M0 0h24v24H0V0z" />
                                                    <path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z" />
                                                </svg>
                                            </span>
                                        </Tooltip>
                                    )}
                                    <Tooltip text={__('Remove media')}>
                                        <IconButton
                                            className="nab-media-slider-item-remove"
                                            icon="no"
                                            onClick={() => {
                                                if (index === currentSelected) { this.setState({ currentSelected: 0 }); }
                                                setAttributes({ media: media.filter((img, idx) => idx !== index) });
                                            }}
                                        />
                                    </Tooltip>
                                </div>
                            ))}
                            <div className="nab-media-slider-add-item">
                                <MediaUpload
                                    value={currentSelected}
                                    multiple
                                    onSelect={(items) => setAttributes({
                                        media: [...media, ...items.map((item) => pick(item, 'id', 'url', 'alt'))],
                                    })}
                                    render={({ open }) => (
                                        <IconButton
                                            label={__('Add media')}
                                            icon="plus"
                                            onClick={open}
                                        />
                                    )}
                                />
                            </div>
                        </div>
                        )}
                        {isSelected && (
                            <div className="nab-media-slider-controls featured-boxes-details">
                                <div className="advertisement-btn">
                                    <div className="left">
                                        <ToggleControl
                                            label={__('Advertisement')}
                                            checked={media[currentSelected] ? media[currentSelected].advertisement || '' : ''}
                                            onChange={() => {
                                                let check = media[currentSelected].advertisement === undefined ? false : ! media[currentSelected].advertisement;
                                                this.updateMediaData({ advertisement: check});}
                                            }
                                        />
                                    </div>
                                    <div className="right">
                                        <ToggleControl
                                            label={__('Open in New Tab')}
                                            checked={media[currentSelected] ? media[currentSelected].target || '' : ''}
                                            onChange={() => {
                                                let check = media[currentSelected].target === undefined ? false : ! media[currentSelected].target;
                                                this.updateMediaData({ target: check});}
                                            }
                                        />
                                    </div>
                                </div>
                                <div className="featured-boxes-link">
                                    <TextControl
                                        label={__('Link')}
                                        value={media[currentSelected] ? media[currentSelected].link || '' : ''}
                                        onChange={(value) => this.updateMediaData({ link: value || '' })}
                                    />
                                </div>
                                {media[currentSelected].advertisement && (
                                    <Fragment>
                                        {nabIsImage(media[currentSelected].url) && (
                                            <Fragment>
                                                <div className="nab-controls-wrapper">
                                                    <strong>Google Event</strong>
                                                    <div className="nab-media-slider-control">
                                                        <TextControl
                                                            label={__('Event Category')}
                                                            placeholder="Enter Category"
                                                            value={media[currentSelected] ? media[currentSelected].eventCategory || '' : ''}
                                                            onChange={(value) => this.updateMediaData({ eventCategory: value || '' })}
                                                        />
                                                    </div>
                                                    <div className="nab-media-slider-control">
                                                        <TextControl
                                                            label={__('Event Action')}
                                                            placeholder="Enter Action"
                                                            value={media[currentSelected] ? media[currentSelected].eventAction || '' : ''}
                                                            onChange={(value) => this.updateMediaData({ eventAction: value || '' })}
                                                        />
                                                    </div>
                                                    <div className="nab-media-slider-control">
                                                        <TextControl
                                                            label={__('Event Label')}
                                                            placeholder="Enter Label"
                                                            value={media[currentSelected] ? media[currentSelected].eventLabel || '' : ''}
                                                            onChange={(value) => this.updateMediaData({ eventLabel: value || '' })}
                                                        />
                                                    </div>
                                                </div>
                                            </Fragment>
                                        )}
                                    </Fragment>
                                )}
                                 </div>
                        )}
                    </div>
                </Fragment>
            );
        }
    }

    const blockAttrs = {
        media: {
            type: 'array',
            default: [],
        },
        sliderActive: {
            type: 'boolean',
            default: true,
        },
        autoplay: {
            type: 'boolean',
            default: false,
        },
        advertisementDetails: {
            type: 'boolean',
            default: false,
        },

        infiniteLoop: {
            type: 'boolean',
            default: true,
        },
        pager: {
            type: 'boolean',
            default: false
        },
        controls: {
            type: 'boolean',
            default: true,
        },
        hoverColor: {
            type: 'string',
        },
        titleColor: {
            type: 'string',
        },
        textColor: {
            type: 'string',
        },
        vAlign: {
            type: 'string',
            default: 'center',
        },
        hAlign: {
            type: 'string',
            default: 'center',
        },
        changed: {
            type: 'boolean',
            default: false,
        },
        speed: {
            type: 'number',
            default: 500
        },
        titleFont: {
            type: 'number',
            default: 25,
        },
        textFont: {
            type: 'number',
            default: 18,
        },
        overlayOpacity: {
            type: 'number',
            default: 20,
        },
        detailWidth: {
            type: 'number',
            default: 50,
        },
        controlIcon: {
            type: 'string',
            default: 'control-7'
        },
        detailAnimation: {
            type: 'string',
            default: 'none'
        },
        arrowIcons: {
            type: 'string',
            default: 'slider-arrow-1'
        },
        minSlides: {
            type: 'number',
            default: 4
        },
        slideWidth: {
            type: 'number',
            default: 400
        },
        slideMargin: {
            type: 'number',
            default: 30
        },
        fixedWidth: {
            type: 'number'
        },
        fixedHeight: {
            type: 'number'
        },
    };

    registerBlockType('md/featured-boxes', {
        title: __('Featured Boxes'),
        description: __('Featured Boxes'),
        icon: { src: sliderBlockIcon },
        category: 'nabshow',
        keywords: [__('Featured'), __('Boxes'), __('Featured Boxes'), __('nab')],
        attributes: blockAttrs,
        edit: featuredBoxesComp,
        save: function ({ attributes }) {
            const {
                media,
                minSlides,
                slideWidth,
                slideMargin,
                autoplay,
                hoverColor,
                titleColor,
                textColor,
                hAlign,
                vAlign,
                speed,
                infiniteLoop,
                pager,
                controls,
                titleFont,
                textFont,
                controlIcon,
                detailAnimation,
                detailWidth,
                arrowIcons,
                sliderActive,
                fixedWidth,
                fixedHeight
            } = attributes;
            return (
                <div className={`slider-arrow-main ${arrowIcons}`}>
                    <div className={sliderActive ? 'nab-dynamic-slider' : 'feature-box-list'} data-minslides={minSlides} data-slidewidth={slideWidth} data-slidemargin={slideMargin} data-animation={detailAnimation} data-auto={autoplay? autoplay: Boolean.valueOf(autoplay)} data-speed={`${speed}`} data-infinite={infiniteLoop ? infiniteLoop : Boolean.valueOf(infiniteLoop)} data-pager={pager ?  pager : Boolean.valueOf(pager)} data-controls={controls ? controls: Boolean.valueOf(controls)}>
                        {media.map((source, index) => (
                            <div className={'item'} key={index}>

                                {
                                    source.link ? (
                                        <a className="nab-media-slider-link"
                                            target={source.target ? '_blank' : '_self'}
                                            rel="noopener noreferrer"
                                            href={source.link}
                                            data-category={source.advertisement && source.eventCategory && ( source.eventCategory )}
                                            data-action={source.advertisement && source.eventAction  && ( source.eventAction )}
                                            data-label={source.advertisement && source.eventLabel && ( source.eventLabel )}
                                        >
                                            {nabInsertMedaitoSlide(source.url, attributes)}
                                        </a>
                                    ) : (
                                        <Fragment>{nabInsertMedaitoSlide(source.url, attributes)}</Fragment>
                                    )
                                }
                            </div>
                        ))}
                    </div>
                </div >
            );
        }

    });
})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);
