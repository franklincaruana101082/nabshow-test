import pick from 'lodash/pick';
import { sliderArrow1, sliderArrow2, sliderArrow3, sliderArrow4, sliderArrow5, sliderArrow6 } from '../icons';

(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    const { __ } = wpI18n;
    const { Component, Fragment } = wpElement;
    const { registerBlockType } = wpBlocks;
    const { InspectorControls, MediaUpload } = wpEditor;
    const { PanelBody, RangeControl, ToggleControl, SelectControl, TextControl, TextareaControl, IconButton, Button, Placeholder, Tooltip, PanelRow, ColorPalette } = wpComponents;
    const $ = jQuery;

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
        const { fullWidth, autoHeight, width, height } = attributes;
        if (nabIsImage(sourceURL)) {
            return (
                <img src={sourceURL}
                    className="media-slider-img"
                    alt={__('Slider image')}
                    style={{
                        width: fullWidth ? '100%' : width,
                        height: autoHeight ? 'auto' : height,
                    }}
                />
            );
        } else {
            return (
                <video src={sourceURL}
                    className="media-slider-vid"
                    controls
                    style={{
                        width: fullWidth ? '100%' : width,
                        height: autoHeight ? 'auto' : height,
                    }}
                >
                </video>
            );
        }
    };

    const nabIsImage = (sourceURL) => {
        const imageExtension = ['jpg', 'jpeg', 'png', 'gif'];
        const fileExtension = sourceURL.split('.').pop();
        if (-1 < imageExtension.indexOf(fileExtension)) {
            return true;
        } else {
            return false;
        }
    };

    class NabMediaSlider extends Component {
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
            if (attributes.media.length) {
                this.initSlider();
            }
        }

        componentDidUpdate(prevProps) {
            const { attributes } = this.props;
            const { media, adaptiveHeight, autoplay, speed, infiniteLoop, pager, controls, mode } = attributes;
            const { media: prevMedia } = prevProps.attributes;
            if (media.length !== prevMedia.length) {
                if (0 === prevMedia.length) {
                    setTimeout(() => this.initSlider(), 10);
                } else {
                    this.state.bxSliderObj.reloadSlider();
                }
            }
            if (adaptiveHeight !== prevProps.attributes.adaptiveHeight) {
                this.reloadSlider();
            }
            if (autoplay !== prevProps.attributes.autoplay) {
                this.reloadSlider();
            }
            if (speed !== prevProps.attributes.speed) {
                this.reloadSlider();
            }
            if (infiniteLoop !== prevProps.attributes.infiniteLoop) {
                this.reloadSlider();
            }
            if (pager !== prevProps.attributes.pager) {
                this.reloadSlider();
            }
            if (controls !== prevProps.attributes.controls) {
                this.reloadSlider();
            }
            if (mode !== prevProps.attributes.mode) {
                this.reloadSlider();
            }
        }

        initSlider() {
            const { clientId } = this.props;
            const { adaptiveHeight, autoplay, speed, infiniteLoop, pager, controls, mode } = this.props.attributes;
            const sliderObj = $(`#block-${clientId} .nab-media-slider`).bxSlider({
                mode: mode, auto: autoplay, speed: speed, controls: controls, infiniteLoop: infiniteLoop, pager: pager, adaptiveHeight: adaptiveHeight, stopAutoOnClick: true, autoHover: true,
                onSlideAfter: function ($slideElement, oldIndex, newIndex) {
                    this.setState({ currentSelected: newIndex });
                }.bind(this)
            });
            this.setState({ bxSliderObj: sliderObj });
        }

        reloadSlider(e) {
            const { adaptiveHeight, autoplay, speed, infiniteLoop, pager, controls, mode } = this.props.attributes;
            this.state.bxSliderObj.reloadSlider(
                { mode: mode, adaptiveHeight: adaptiveHeight, auto: autoplay, speed: speed, infiniteLoop: infiniteLoop, pager: pager, controls: controls, stopAutoOnClick: true, autoHover: true, }
            );
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
            const { attributes, setAttributes, isSelected, clientId } = this.props;
            const { currentSelected } = this.state;
            const {
                media,
                autoplay,
                fullWidth,
                autoHeight,
                width,
                height,
                alwaysShowOverlay,
                hoverColor,
                titleColor,
                textColor,
                hAlign,
                vAlign,
                mediaDetails,
                speed,
                infiniteLoop,
                pager,
                controls,
                titleFont,
                textFont,
                overlayOpacity,
                adaptiveHeight,
                mode,
                controlIcon,
                detailAnimation,
                detailWidth,
                arrowIcons
            } = attributes;

            var arrowNames = [
                { name: sliderArrow1, classnames: 'slider-arrow-1' },
                { name: sliderArrow2, classnames: 'slider-arrow-2' },
                { name: sliderArrow3, classnames: 'slider-arrow-3' },
                { name: sliderArrow4, classnames: 'slider-arrow-4' },
                { name: sliderArrow5, classnames: 'slider-arrow-5' },
                { name: sliderArrow6, classnames: 'slider-arrow-6' }
            ];


            if (0 === media.length) {
                return (
                    <Placeholder
                        icon={mediaSliderBlockIcon}
                        label={__('Media Slider Block')}
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
                            <ToggleControl
                                label={__('Adaptive Height')}
                                checked={adaptiveHeight}
                                onChange={() => setAttributes({ adaptiveHeight: ! adaptiveHeight })}
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
                            <SelectControl
                                label={__('Slider Mode')}
                                value={mode}
                                options={[
                                    { label: __('Horizontal'), value: 'horizontal' },
                                    { label: __('Fade'), value: 'fade' }
                                ]}
                                onChange={(value) => setAttributes({ mode: value })}
                            />
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
                        <PanelBody title={__('Image Settings')} initialOpen={false}>
                            <ToggleControl
                                label={__('Full width')}
                                checked={fullWidth}
                                onChange={() => setAttributes({ fullWidth: ! fullWidth })}
                            />
                            {! fullWidth && (
                                <div className="inspector-field inspector-slider-speed" >
                                    <label>Width</label>
                                    <RangeControl
                                        value={width}
                                        min={200}
                                        max={1300}
                                        onChange={width => setAttributes({ width: width })}
                                    />
                                </div>
                            )}
                            <ToggleControl
                                label={__('Auto height')}
                                checked={autoHeight}
                                onChange={() => setAttributes({ autoHeight: ! autoHeight })}
                            />
                            {! autoHeight && (
                                <div className="inspector-field inspector-slider-speed" >
                                    <label>Height</label>
                                    <RangeControl
                                        value={height}
                                        min={100}
                                        max={1000}
                                        onChange={height => setAttributes({ height: height })}
                                    />
                                </div>
                            )}
                            <ToggleControl
                                label={__('Always show overlay')}
                                checked={alwaysShowOverlay}
                                onChange={() => setAttributes({ alwaysShowOverlay: ! alwaysShowOverlay })}
                            />
                            {
                                alwaysShowOverlay ? (
                                    <Fragment>
                                        <div className="inspector-field inspector-field-color ">
                                            <label className="inspector-mb-0">Color</label>
                                            <div className="inspector-ml-auto">
                                                <ColorPalette
                                                    value={hoverColor}
                                                    onChange={(hoverColor) => setAttributes({ hoverColor })}
                                                />
                                            </div>
                                        </div>
                                        <PanelRow>
                                            <div className="inspector-field inspector-slider-speed" >
                                                <label>Overlay Opacity</label>
                                                <RangeControl
                                                    value={overlayOpacity}
                                                    min={0}
                                                    max={100}
                                                    onChange={overlayOpacity => setAttributes({ overlayOpacity: overlayOpacity })}
                                                />
                                            </div>
                                        </PanelRow>
                                    </Fragment>
                                ) : ''
                            }
                        </PanelBody>
                        <PanelBody title={__('Media Settings')} initialOpen={false}>
                            <ToggleControl
                                label={__('Media Details')}
                                checked={mediaDetails}
                                onChange={() => setAttributes({ mediaDetails: ! mediaDetails })}
                            />

                            {
                                mediaDetails ? (
                                    <Fragment>
                                        <PanelRow>
                                            <div className="inspector-field">
                                                <RangeControl
                                                    label={__('Box Width')}
                                                    min={30}
                                                    max={100}
                                                    value={detailWidth}
                                                    onChange={value => setAttributes({ detailWidth: value })}
                                                />
                                            </div>
                                        </PanelRow>
                                        <PanelRow>
                                            <div className="inspector-field">
                                                <RangeControl
                                                    label={__('Title Font Size')}
                                                    min={10}
                                                    max={200}
                                                    value={titleFont}
                                                    onChange={value => setAttributes({ titleFont: value })}
                                                />
                                            </div>
                                        </PanelRow>
                                        <PanelRow>
                                            <div className="inspector-field">
                                                <RangeControl
                                                    label={__('Caption Font Size')}
                                                    min={10}
                                                    max={200}
                                                    value={textFont}
                                                    onChange={value => setAttributes({ textFont: value })}
                                                />
                                            </div>
                                        </PanelRow>
                                        <PanelRow>
                                            <div className="inspector-field inspector-field-color ">
                                                <label className="inspector-mb-0">Title Text Color</label>
                                                <div className="inspector-ml-auto">
                                                    <ColorPalette
                                                        value={titleColor}
                                                        onChange={(titleColor) => setAttributes({ titleColor: titleColor })}
                                                    />
                                                </div>
                                            </div>
                                        </PanelRow>
                                        <PanelRow>
                                            <div className="inspector-field inspector-field-color ">
                                                <label className="inspector-mb-0">Caption Text Color</label>
                                                <div className="inspector-ml-auto">
                                                    <ColorPalette
                                                        value={textColor}
                                                        onChange={(textColor) => setAttributes({ textColor: textColor })}
                                                    />
                                                </div>
                                            </div>
                                        </PanelRow>
                                        <PanelRow>
                                            <div className="inspector-field">
                                                <SelectControl
                                                    label={__('Detail Animation')}
                                                    value={detailAnimation}
                                                    options={[
                                                        { label: __('None'), value: 'none' },
                                                        { label: __('Fade In'), value: 'fadeIn' },
                                                        { label: __('Fade Out'), value: 'fadeOut' },
                                                        { label: __('zoom In'), value: 'zoomIn' }
                                                    ]}
                                                    onChange={(value) => setAttributes({ detailAnimation: value })}
                                                />
                                            </div>
                                        </PanelRow>
                                        <PanelRow>
                                            <div className="inspector-field-alignment inspector-field inspector-responsive inspector-bottom-20">
                                                <label>Vertical  Alignment</label>
                                                <div className="inspector-field-button-list inspector-field-button-list-fluid">
                                                    <button className={'flex-start' === vAlign ? 'active inspector-button' : ' inspector-button'} onClick={() => setAttributes({ vAlign: 'flex-start' })} >
                                                        <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                                            <g transform="translate(1)" fill="none">
                                                                <rect className="inspector-svg-fill" x="4" y="4" width="6" height="12" rx="1"></rect>
                                                                <path className="inspector-svg-stroke" d="M0 1h14" stroke-width="2" stroke-linecap="square"></path>
                                                            </g>
                                                        </svg>
                                                    </button>
                                                    <button className={'center' === vAlign ? 'active inspector-button' : ' inspector-button'} onClick={() => setAttributes({ vAlign: 'center' })} >
                                                        <svg width="16" height="18" viewBox="0 0 16 18" xmlns="http://www.w3.org/2000/svg">
                                                            <g transform="translate(-115 -4) translate(115 4)" fill="none">
                                                                <path d="M8 .708v15.851" className="inspector-svg-stroke" stroke-linecap="square"></path>
                                                                <rect className="inspector-svg-fill" y="5" width="16" height="7" rx="1"></rect>
                                                            </g>
                                                        </svg>
                                                    </button>
                                                    <button className={'flex-end' === vAlign ? 'active inspector-button' : ' inspector-button'} onClick={() => setAttributes({ vAlign: 'flex-end' })} >
                                                        <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                                            <g transform="translate(1)" fill="none">
                                                                <rect className="inspector-svg-fill" x="4" width="6" height="12" rx="1"></rect>
                                                                <path d="M0 15h14" className="inspector-svg-stroke" stroke-width="2" stroke-linecap="square"></path>
                                                            </g>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </PanelRow>
                                        <PanelRow>
                                            <div className="inspector-field-alignment inspector-field inspector-responsive">
                                                <label>Horizontal Alignment</label>
                                                <div className="inspector-field-button-list inspector-field-button-list-fluid">
                                                    <button className={'flex-start' === hAlign ? 'active inspector-button' : ' inspector-button'} onClick={() => setAttributes({ hAlign: 'flex-start' })} >
                                                        <svg width="21" height="18" viewBox="0 0 21 18" xmlns="http://www.w3.org/2000/svg">
                                                            <g transform="translate(-29 -4) translate(29 4)" fill="none">
                                                                <path d="M1 .708v15.851" className="inspector-svg-stroke" stroke-linecap="square"></path>
                                                                <rect className="inspector-svg-fill" x="5" y="5" width="16" height="7" rx="1"></rect>
                                                            </g>
                                                        </svg>
                                                    </button>
                                                    <button className={'center' === hAlign ? 'active inspector-button' : ' inspector-button'} onClick={() => setAttributes({ hAlign: 'center' })} >
                                                        <svg width="16" height="18" viewBox="0 0 16 18" xmlns="http://www.w3.org/2000/svg">
                                                            <g transform="translate(-115 -4) translate(115 4)" fill="none">
                                                                <path d="M8 .708v15.851" className="inspector-svg-stroke" stroke-linecap="square"></path>
                                                                <rect className="inspector-svg-fill" y="5" width="16" height="7" rx="1"></rect>
                                                            </g>
                                                        </svg>
                                                    </button>
                                                    <button className={'flex-end' === hAlign ? 'active inspector-button' : ' inspector-button'} onClick={() => setAttributes({ hAlign: 'flex-end' })} >
                                                        <svg width="21" height="18" viewBox="0 0 21 18" xmlns="http://www.w3.org/2000/svg">
                                                            <g transform="translate(0 1) rotate(-180 10.5 8.5)" fill="none">
                                                                <path d="M1 .708v15.851" className="inspector-svg-stroke" stroke-linecap="square"></path>
                                                                <rect className="inspector-svg-fill" fill-rule="nonzero" x="5" y="5" width="16" height="7" rx="1"></rect>
                                                            </g>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </PanelRow>
                                    </Fragment>
                                ) : ''
                            }
                        </PanelBody>
                        <PanelBody title={__('Help')} initialOpen={false}>
                            <a href="https://nabshow-com.go-vip.net/2020/wp-content/uploads/sites/3/2019/11/media-slider.mp4" target="_blank">How to use block?</a>
                        </PanelBody>
                    </InspectorControls>
                    <div className={`nab-media-slider-block slider-arrow-main ${arrowIcons}`}>
                        <div className={'nab-media-slider'} data-animation={detailAnimation} data-autoplay={`${autoplay}`} data-speed={`${speed}`} data-infiniteloop={`${infiniteLoop}`} data-pager={`${pager}`} data-controls={`${controls}`} data-adaptiveheight={`${adaptiveHeight}`}>
                            {media.map((source, index) => (
                                <div className={'nab-media-slider-item'} key={index}

                                >
                                    {nabInsertMedaitoSlide(source.url, attributes)}
                                    <span className="nab-media-slider-overlay"
                                        style={{
                                            backgroundColor: hoverColor,
                                            opacity: alwaysShowOverlay ? `0.${overlayOpacity}` : 0,
                                        }}
                                    />
                                    {source.link && (
                                        <a className="nab-media-slider-link"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            href={source.link}
                                        />
                                    )}
                                    <div className="nab-media-slider-item-info"
                                        style={{
                                            justifyContent: vAlign,
                                            alignItems: hAlign,
                                            width: `${detailWidth}%`
                                        }}
                                    >
                                        <h4 className="nab-media-slider-title"
                                            style={{
                                                color: titleColor,
                                                fontSize: `${titleFont}px`
                                            }}
                                        >
                                            {source.title}
                                        </h4>
                                        <p className="nab-media-slider-text"
                                            style={{
                                                color: textColor,
                                                fontSize: `${textFont}px`
                                            }}
                                        >
                                            {source.text}
                                        </p>
                                    </div>
                                </div>
                            ))}
                        </div>
                        {isSelected && (
                            <div className="nab-media-slider-controls">
                                {mediaDetails && (
                                    <Fragment>
                                        {nabIsImage(media[currentSelected].url) && (
                                            <div className="nab-controls-wrapper">
                                                <div className="nab-media-slider-control">
                                                    <TextControl
                                                        label={__('Title')}
                                                        value={media[currentSelected] ? media[currentSelected].title || '' : ''}
                                                        onChange={(value) => this.updateMediaData({ title: value || '' })}
                                                    />
                                                </div>
                                                <div className="nab-media-slider-control">
                                                    <TextareaControl
                                                        label={__('Text')}
                                                        value={media[currentSelected] ? media[currentSelected].text || '' : ''}
                                                        onChange={(value) => this.updateMediaData({ text: value || '' })}
                                                    />
                                                </div>
                                                <div className="nab-media-slider-control">
                                                    <TextControl
                                                        label={__('Link')}
                                                        value={media[currentSelected] ? media[currentSelected].link || '' : ''}
                                                        onChange={(value) => this.updateMediaData({ link: value || '' })}
                                                    />
                                                </div>
                                            </div>
                                        )}
                                    </Fragment>
                                )}
                                <div className="nab-media-slider-slide-list">
                                    {media.map((source, index) => (
                                        <div className="nab-media-slider-slide-list-item" key={index}>
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
                                                        this.state.bxSliderObj.goToSlide(index);
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
                                                        this.state.bxSliderObj.goToSlide(index);
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
                                                        if (index === currentSelected) { this.setState({ currentSelected: null }); }
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
            default: [], // [ {id: int, url, title, text, link: string } ]
        },
        autoplay: {
            type: 'boolean',
            default: false,
        },
        mediaDetails: {
            type: 'boolean',
            default: false,
        },

        infiniteLoop: {
            type: 'boolean',
            default: true,
        },
        pager: {
            type: 'boolean',
            default: true,
        },
        controls: {
            type: 'boolean',
            default: true,
        },
        adaptiveHeight: {
            type: 'boolean',
            default: true,
        },
        fullWidth: {
            type: 'boolean',
            default: true,
        },
        autoHeight: {
            type: 'boolean',
            default: true,
        },
        width: {
            type: 'number',
            default: 700,
        },
        height: {
            type: 'number',
            default: 500,
        },
        alwaysShowOverlay: {
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
        mode: {
            type: 'string',
            default: 'horizontal'
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
        }
    };

    registerBlockType('md/media-slider', {
        title: __('Media Slider'),
        description: __('Display your media in a slider.'),
        icon: { src: sliderBlockIcon },
        category: 'nabshow',
        keywords: [__('slide'), __('gallery'), __('photos')],
        attributes: blockAttrs,
        edit: NabMediaSlider,
        save: function ({ attributes }) {
            const {
                media,
                autoplay,
                alwaysShowOverlay,
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
                overlayOpacity,
                adaptiveHeight,
                mode,
                controlIcon,
                detailAnimation,
                detailWidth,
                arrowIcons
            } = attributes;
            return (
                <div className={`nab-media-slider-block slider-arrow-main ${arrowIcons}`}>
                    <div className={'nab-media-slider'} data-animation={detailAnimation} nabmode={mode} data-autoplay={`${autoplay}`} data-speed={`${speed}`} data-infiniteloop={`${infiniteLoop}`} data-pager={`${pager}`} data-controls={`${controls}`} data-adaptiveheight={`${adaptiveHeight}`}>
                        {media.map((source, index) => (
                            <div className={'nab-media-slider-item'} key={index}>
                                {nabInsertMedaitoSlide(source.url, attributes)}
                                <span className="nab-media-slider-overlay"
                                    style={{
                                        backgroundColor: hoverColor,
                                        opacity: alwaysShowOverlay ? `0.${overlayOpacity}` : 0,
                                    }}
                                />
                                {source.link && (
                                    <a className="nab-media-slider-link"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        href={source.link}
                                    />
                                )}
                                {nabIsImage(source.url) && (
                                    <div className="nab-media-slider-item-info"
                                        style={{
                                            justifyContent: vAlign,
                                            alignItems: hAlign,
                                            width: `${detailWidth}%`
                                        }}
                                    >
                                        {source.title && (
                                            <h4 className="nab-media-slider-title"
                                                style={{
                                                    color: titleColor,
                                                    fontSize: `${titleFont}px`
                                                }}
                                            >
                                                {source.title}
                                            </h4>
                                        )}
                                        {source.text && (
                                            <p className="nab-media-slider-text"
                                                style={{
                                                    color: textColor,
                                                    fontSize: `${textFont}px`
                                                }}
                                            >
                                                {source.text}
                                            </p>
                                        )}
                                    </div>
                                )}
                            </div>
                        ))}
                    </div>
                </div >
            );
        }
    });
})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);