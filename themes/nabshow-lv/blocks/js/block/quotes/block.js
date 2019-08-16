import times from 'lodash/times';
import memoize from 'memize';
import { quotesSliderBottom, quotesSliderSide } from '../icons';

(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {

    const __ = wp.i18n.__;
    const registerBlockType = wp.blocks.registerBlockType;
    const { MediaUpload, PlainText, RichText, InspectorControls } = wp.editor;
    const { Fragment, Component } = wp.element;
    const { PanelBody, RangeControl, ToggleControl, SelectControl, TextControl, TextareaControl, IconButton, Button, Placeholder, Tooltip, PanelRow } = wp.components;

    /**
     * Register: a Gutenberg Block.
     *
     * Registers a new block provided a unique name and an object defining its
     * behavior. Once registered, the block is made editor as an option to any
     * editor interface where blocks are implemented.
     *
     * @link https://wordpress.org/gutenberg/handbook/block-api/
     * @param  {string}   name     Block name.
     * @param  {Object}   settings Block settings.
     * @return {?WPBlock}          The block, if it has been successfully
     *                             registered; otherwise `undefined`.
     */

    class NabMediaSlider extends Component {
        constructor() {
            super(...arguments);
            this.state = {
                currentSelected: 0,
                lastSliderIndex: 0,
                inited: false,
                bxSliderObj: {},
                sliderActive: false,
                activeClass: false
            };

            this.initSlider = this.initSlider.bind(this);
            this.reloadSlider = this.reloadSlider.bind(this);
        }

        componentDidUpdate(prevProps) {
            const { sliderActive, media, adaptiveHeight, autoplay, speed, infiniteLoop, pager, controls, mode } = this.props.attributes;
            if (this.state.bxSliderObj.length === undefined && sliderActive) {
                this.initSlider();
            } else if (0 < this.state.bxSliderObj.length && ! sliderActive) {
                this.state.bxSliderObj.destroySlider();
                this.setState({ bxSliderObj: {} });
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

        componentDidMount() {
            const { sliderActive, quotes } = this.props.attributes;
            if (this.state.bxSliderObj.length === undefined && sliderActive) {
                this.initSlider();
            } else if (0 < this.state.bxSliderObj.length && ! sliderActive) {
                this.state.bxSliderObj.destroySlider();
                this.setState({ bxSliderObj: {} });
            }
            if (0 === quotes.length) {
                this.initList();
            }
        }

        initList() {
            const { quotes } = this.props.attributes;
            const { setAttributes } = this.props;
            setAttributes({
                sliderActive: false,
                quotes: [
                    ...quotes,
                    {
                        index: quotes.length,
                        title: '',
                        content: '',
                        author: '',
                        link: '',
                        area: ''
                    }
                ]
            });

        }

        initSlider() {
            const { autoplay, infiniteLoop, pager, controls, adaptiveHeight, speed, mode } = this.props.attributes;
            const { clientId } = this.props;
            let sliderObj = $(`#block-${clientId} .wp-block-md-quotes-slider-block`).bxSlider({
                mode: mode,
                speed: speed,
                controls: controls,
                infiniteLoop: infiniteLoop,
                pager: pager,
                adaptiveHeight: adaptiveHeight,
                stopAutoOnClick: true,
                autoHover: true,
                touchEnabled: false
            });

            this.setState({ bxSliderObj: sliderObj });
        }

        reloadSlider() {
            const { autoplay, infiniteLoop, pager, controls, adaptiveHeight, speed, mode } = this.props.attributes;
            this.state.bxSliderObj.reloadSlider({
                mode: mode,
                speed: speed,
                controls: controls,
                infiniteLoop: infiniteLoop,
                pager: pager,
                adaptiveHeight: adaptiveHeight,
                stopAutoOnClick: true,
                autoHover: true,
                touchEnabled: false
            });
        }

        gotoLastSlider() {
            const gotoslide = this.props.attributes.quotes.length - 1;
            this.state.bxSliderObj.goToSlide(gotoslide);
            this.reloadSlider();
        }

        render() {

            const { attributes, setAttributes, isSelected, clientId, className } = this.props;
            const { quotes, id, sliderActive, quotesOptions, autoplay, infiniteLoop, pager, controls, adaptiveHeight, speed, mode, sliderBgColor } = attributes;

            const quotesList = quotes
                .sort((a, b) => a.index - b.index)
                .map((quote, index) => {
                    return (
                        <div className="quote-item">
                            <span
                                className="remove-quote"
                                onClick={() => {
                                    const qewQusote = quotes
                                        .filter(item => item.index != quote.index)
                                        .map(t => {
                                            if (t.index > quote.index) {
                                                t.index -= 1;
                                            }

                                            return t;
                                        });

                                    setAttributes({
                                        quotes: qewQusote
                                    });
                                    this.reloadSlider();
                                }}
                            >
                                <i className="fa fa-times" />
                            </span>

                            <RichText
                                tagName="h3"
                                placeholder={__('Title')}
                                value={quote.title}
                                className="title"
                                onChange={title => {
                                    const newObject = Object.assign({}, quote, {
                                        title: title
                                    });
                                    setAttributes({
                                        quotes: [
                                            ...quotes.filter(
                                                item => item.index != quote.index
                                            ),
                                            newObject
                                        ]
                                    });
                                }}
                            />
                            <RichText
                                tagName="p"
                                className="content"
                                placeholder={__('Content')}
                                value={quote.content}
                                onChange={content => {
                                    const newObject = Object.assign({}, quote, {
                                        content: content
                                    });
                                    setAttributes({
                                        quotes: [
                                            ...quotes.filter(
                                                item => item.index != quote.index
                                            ),
                                            newObject
                                        ]
                                    });
                                }}
                            />
                            {
                                'quotes-options-2' === quotesOptions && (
                                    <RichText
                                        tagName="p"
                                        className="author"
                                        placeholder="Author"
                                        value={quote.author}
                                        onChange={author => {
                                            const newObject = Object.assign({}, quote, {
                                                author: author
                                            });
                                            setAttributes({
                                                quotes: [
                                                    ...quotes.filter(
                                                        item => item.index != quote.index
                                                    ),
                                                    newObject
                                                ]
                                            });
                                        }}
                                    />
                                )
                            }

                            {
                                'quotes-options-1' === quotesOptions && (
                                    <RichText
                                        tagName="p"
                                        placeholder="Link"
                                        className="learnmore"
                                        value={'' === quote.link ? 'Learn More' : quote.link}
                                        onChange={link => {
                                            const newObject = Object.assign({}, quote, {
                                                link: link
                                            });
                                            setAttributes({
                                                quotes: [
                                                    ...quotes.filter(
                                                        item => item.index != quote.index
                                                    ),
                                                    newObject
                                                ]
                                            });
                                        }}
                                    />
                                )
                            }
                        </div>
                    );
                });
            return (
                <div id={`block-${clientId}`} className={`quote-slider ${quotesOptions} ${sliderBgColor}`}>
                    <InspectorControls>
                        <PanelBody title="General Settings">
                            <PanelRow>
                                <ToggleControl
                                    label={__('Active Slider')}
                                    checked={sliderActive}
                                    onChange={() => setAttributes({ sliderActive: ! sliderActive })}
                                />
                            </PanelRow>
                            <label>Text Color</label>
                            <ul className="quote-color">
                                <li class={`white-slider ${'white-slider' === sliderBgColor ? 'active' : ''}`}
                                    onClick={e => {
                                        setAttributes({ sliderBgColor: 'white-slider' });
                                    }}
                                ></li>
                                <li class={`black-slider ${'black-slider' === sliderBgColor ? 'active' : ''}`}
                                    onClick={e => {
                                        setAttributes({ sliderBgColor: 'black-slider' });
                                    }}
                                ></li>
                            </ul>
                            <label>Layout Options</label>
                            <PanelRow>
                                <ul className="quote-options">
                                    <li onClick={() => { setAttributes({ quotesOptions: 'quotes-options-1' }); setTimeout(() => this.reloadSlider(), 10); }} className={'quotes-options-1' === quotesOptions ? 'active' : ''}  >{quotesSliderSide}</li>
                                    <li onClick={() => { setAttributes({ quotesOptions: 'quotes-options-2' }); setTimeout(() => this.reloadSlider(), 10); }} className={'quotes-options-2' === quotesOptions ? 'active' : ''}  >{quotesSliderBottom}</li>
                                </ul>
                            </PanelRow>
                        </PanelBody>
                        {
                            sliderActive && (
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
                                            { label: __('Vertical'), value: 'vertical' },
                                            { label: __('Fade'), value: 'fade' },
                                        ]}
                                        onChange={(value) => setAttributes({ mode: value })}
                                    />
                                </PanelBody>

                            )
                        }
                    </InspectorControls >
                    <div className={`${className} quote-inner`}>
                        {quotesList}
                    </div>

                    <div class="add-remove-btn">
                        {
                            1 < quotes.length && false === sliderActive ? (
                                <button
                                    className="components-button current"
                                    onClick={() => {
                                        setAttributes({ sliderActive: true });
                                    }}
                                >
                                    <span class="dashicons dashicons-yes"></span>
                                </button>
                            ) : ''
                        }

                        <button
                            className="components-button add"
                            onClick={content => {
                                setAttributes({
                                    sliderActive: false,
                                    quotes: [
                                        ...quotes,
                                        {
                                            index: quotes.length,
                                            title: '',
                                            content: '',
                                            author: '',
                                            link: '',
                                            area: ''
                                        }
                                    ]
                                });
                            }
                            }
                        >
                            <span class="dashicons dashicons-plus"></span>
                        </button>

                    </div>
                </div >
            );
        }
    }

    registerBlockType('md/quotes-slider-block', {

        title: __('Quotes Slider'),
        icon: 'groups',
        category: 'nabshow',
        keywords: [__('quotes Slider'), __('gts')],

        attributes: {
            id: {
                type: 'string',
                default: ''
            },
            quotes: {
                type: 'array',
                default: [],
            },
            sliderActive: {
                type: 'boolean',
                default: false
            },
            quotesOptions: {
                type: 'string',
                default: 'quotes-options-1'
            },
            autoplay: {
                type: 'boolean',
                default: false,
            },
            infiniteLoop: {
                type: 'boolean',
                default: true,
            },
            pager: {
                type: 'boolean',
                default: false,
            },
            controls: {
                type: 'boolean',
                default: true,
            },
            adaptiveHeight: {
                type: 'boolean',
                default: true,
            },
            speed: {
                type: 'number',
                default: 500
            },
            mode: {
                type: 'string',
                default: 'horizontal'
            },
            sliderBgColor: {
                type: 'string',
                default: 'white-slider'
            }
        },

        // edit Component
        edit: NabMediaSlider,

        save: props => {
            const { id, quotes, quotesOptions, autoplay, infiniteLoop, pager, controls, adaptiveHeight, speed, mode, sliderBgColor } = props.attributes;
            const { clientId } = props;

            const quotesList = quotes.map(function (quote) {
                const quoteClass =
                    0 == quote.index ? 'quote-item active' : 'quote-item';
                return (
                    <div className={quoteClass} key={quote.index}>
                        <div className="content-block">
                            {quote.title && (
                                <RichText.Content
                                    tagName="h3"
                                    className="title"
                                    value={quote.title}
                                />
                            )}
                            {quote.content && (
                                <RichText.Content
                                    tagName="p"
                                    className="content"
                                    value={quote.content}
                                />
                            )}
                            {quote.author && 'quotes-options-2' === quotesOptions && (
                                <RichText.Content
                                    tagName="strong"
                                    className="author"
                                    value={quote.author}
                                />
                            )}
                            {'quotes-options-1' === quotesOptions && (
                                <RichText.Content
                                    tagName="p"
                                    className="learnmore"
                                    value={'' === quote.link ? 'Learn More' : quote.link}
                                />
                            )}
                        </div>
                    </div>

                );
            });
            if (0 < quotes.length) {
                return (
                    <div id={`block-${clientId}`} className={`quote-slider ${quotesOptions} ${sliderBgColor}`}>
                        <div className="quote-inner" data-mode={mode} data-autoplay={`${autoplay}`} data-speed={`${speed}`} data-infiniteloop={`${infiniteLoop}`} data-pager={`${pager}`} data-controls={`${controls}`} data-adaptiveheight={`${adaptiveHeight}`}>
                            {quotesList}
                        </div>
                    </div>
                );
            } else { return null; }
        }
    });

})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);