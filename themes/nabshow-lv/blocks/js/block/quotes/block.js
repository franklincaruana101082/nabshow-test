import { quotesSliderBottom, quotesSliderSide } from '../icons';

(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {

    const { __ } = wpI18n;
    const { registerBlockType } = wpBlocks;
    const { RichText, InspectorControls } = wpEditor;
    const { Component } = wpElement;
    const { PanelBody, RangeControl, ToggleControl, SelectControl, PanelRow } = wpComponents;

    const quoteBlockIcon = (
        <svg width="150px" height="150px" viewBox="181 181 150 150" enable-background="new 181 181 150 150">
            <path fill="#0F6CB6" d="M321.437,192.815H190.563c-3.732,0-6.769,3.037-6.769,6.769v117.343c0,1.249,1.008,2.257,2.256,2.257h139.9
                c1.247,0,2.257-1.008,2.257-2.257V199.584C328.207,195.853,325.169,192.815,321.437,192.815z M188.307,206.354h135.387v108.318
                H188.307V206.354z M190.563,197.328h2.302c-1.246,0-2.243,1.009-2.243,2.257c0,1.248,1.02,2.256,2.268,2.256
                c1.246,0,2.256-1.008,2.256-2.256c0-1.248-1.011-2.257-2.256-2.257h6.742c-1.246,0-2.243,1.009-2.243,2.257
                c0,1.248,1.019,2.256,2.268,2.256c1.245,0,2.256-1.008,2.256-2.256c0-1.248-1.011-2.257-2.256-2.257h6.751
                c-1.246,0-2.243,1.009-2.243,2.257c0,1.248,1.02,2.256,2.268,2.256c1.246,0,2.257-1.008,2.257-2.256
                c0-1.248-1.011-2.257-2.257-2.257h115.004c1.246,0,2.257,1.011,2.257,2.257v2.256H206.43h-6.776h-6.767h-4.581v-2.256
                C188.307,198.339,189.317,197.328,190.563,197.328z"/>
            <path fill="#0F6CB6" d="M201.846,217.636h-4.513v-1.322l1.598-1.595c0.882-0.88,0.882-2.309,0-3.191
                c-0.882-0.882-2.309-0.882-3.191,0l-2.257,2.254c-0.209,0.208-0.375,0.458-0.489,0.733c-0.115,0.275-0.173,0.569-0.173,0.864v4.513
                v6.77c0,1.248,1.008,2.256,2.256,2.256h6.77c1.248,0,2.256-1.008,2.256-2.256v-6.77
                C204.102,218.645,203.093,217.636,201.846,217.636z M199.589,224.405h-2.256v-2.256h2.256V224.405z"/>
            <path fill="#0F6CB6" d="M215.384,228.918c1.248,0,2.256-1.008,2.256-2.256v-6.77c0-1.248-1.009-2.256-2.256-2.256h-4.513v-1.322
                l1.597-1.595c0.882-0.88,0.882-2.309,0-3.191c-0.882-0.882-2.309-0.882-3.191,0l-2.256,2.254c-0.21,0.208-0.375,0.458-0.489,0.733
                c-0.115,0.275-0.174,0.569-0.174,0.864v4.513v6.77c0,1.248,1.009,2.256,2.256,2.256H215.384L215.384,228.918z M213.127,224.405
                h-2.256v-2.256h2.256V224.405z"/>
            <path fill="#0F6CB6" d="M316.926,292.091h-6.769c-1.248,0-2.257,1.01-2.257,2.257v6.77c0,1.248,1.009,2.257,2.257,2.257h4.513v1.322
                l-1.598,1.595c-0.882,0.881-0.882,2.309,0,3.191c0.439,0.44,1.018,0.661,1.595,0.661c0.578,0,1.155-0.221,1.596-0.661l2.257-2.254
                c0.209-0.208,0.374-0.459,0.489-0.734c0.114-0.274,0.174-0.568,0.174-0.863v-4.514v-6.77
                C319.183,293.101,318.174,292.091,316.926,292.091z M312.413,296.604h2.257v2.257h-2.257V296.604z"/>
            <path fill="#0F6CB6" d="M303.388,292.091h-6.77c-1.248,0-2.256,1.01-2.256,2.257v6.77c0,1.248,1.008,2.257,2.256,2.257h4.513v1.322
                l-1.597,1.595c-0.884,0.881-0.884,2.309,0,3.191c0.439,0.44,1.017,0.661,1.595,0.661c0.577,0,1.155-0.221,1.596-0.661l2.255-2.254
                c0.211-0.208,0.375-0.459,0.491-0.734c0.114-0.274,0.173-0.568,0.173-0.863v-4.514v-6.77
                C305.644,293.101,304.635,292.091,303.388,292.091z M298.874,296.604h2.257v2.257h-2.257V296.604z"/>
            <path fill="#0F6CB6" d="M208.608,265.044c0,1.247,1.008,2.256,2.256,2.256h90.271c1.247,0,2.257-1.009,2.257-2.256
                c0-1.248-1.01-2.257-2.257-2.257h-90.271C209.617,262.787,208.608,263.796,208.608,265.044L208.608,265.044z"/>
            <path fill="#0F6CB6" d="M301.136,269.557h-90.271c-1.248,0-2.256,1.009-2.256,2.257c0,1.247,1.008,2.257,2.256,2.257h90.271
                c1.247,0,2.257-1.01,2.257-2.257C303.393,270.565,302.383,269.557,301.136,269.557z"/>
            <path fill="#0F6CB6" d="M303.393,278.582c0-1.247-1.01-2.257-2.257-2.257h-90.271c-1.248,0-2.256,1.01-2.256,2.257
                c0,1.249,1.008,2.257,2.256,2.257h90.271C302.383,280.839,303.393,279.831,303.393,278.582z"/>
            <path fill="#0F6CB6" d="M278.564,283.096h-45.129c-1.248,0-2.256,1.009-2.256,2.256c0,1.248,1.008,2.257,2.256,2.257h45.129
                c1.248,0,2.256-1.009,2.256-2.257C280.82,284.104,279.813,283.096,278.564,283.096z"/>
            <path fill="#0F6CB6" d="M245.957,254.637c0.014,0.012,0.031,0.021,0.045,0.034c2.726,2.235,6.208,3.581,10,3.581
                c3.802,0,7.293-1.352,10.021-3.599c0.002-0.003,0.006-0.003,0.008-0.005c3.517-2.899,5.764-7.288,5.764-12.193
                c0-8.708-7.087-15.795-15.795-15.795c-8.708,0-15.795,7.088-15.795,15.795C240.205,247.354,242.445,251.738,245.957,254.637
                L245.957,254.637z M250.413,252.198c1.241-1.821,3.313-2.974,5.585-2.974c2.274,0,4.346,1.155,5.587,2.977
                c-1.651,0.952-3.543,1.539-5.584,1.539C253.958,253.739,252.069,253.152,250.413,252.198L250.413,252.198z M256,244.711
                c-1.246,0-2.257-1.011-2.257-2.256s1.011-2.257,2.257-2.257c1.245,0,2.257,1.011,2.257,2.257S257.245,244.711,256,244.711z
                M256,231.172c6.222,0,11.282,5.062,11.282,11.283c0,2.534-0.871,4.851-2.288,6.738c-0.916-1.212-2.082-2.2-3.389-2.952
                c0.735-1.081,1.164-2.383,1.164-3.786c0-3.732-3.038-6.77-6.77-6.77c-3.732,0-6.769,3.037-6.769,6.77
                c0,1.401,0.429,2.705,1.162,3.788c-1.307,0.752-2.471,1.737-3.39,2.95c-1.415-1.889-2.285-4.204-2.285-6.738
                C244.718,236.233,249.779,231.172,256,231.172L256,231.172z"/>
        </svg>
    );

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
                                <li className={`white-slider ${'white-slider' === sliderBgColor ? 'active' : ''}`}
                                    onClick={e => {
                                        setAttributes({ sliderBgColor: 'white-slider' });
                                    }}
                                ></li>
                                <li className={`black-slider ${'black-slider' === sliderBgColor ? 'active' : ''}`}
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
                                            { label: __('Fade'), value: 'fade' }
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

                    <div className="add-remove-btn">
                        {
                            1 < quotes.length && false === sliderActive ? (
                                <button
                                    className="components-button current"
                                    onClick={() => {
                                        setAttributes({ sliderActive: true });
                                    }}
                                >
                                    <span className="dashicons dashicons-yes"></span>
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
                            <span className="dashicons dashicons-plus"></span>
                        </button>

                    </div>
                </div >
            );
        }
    }

    registerBlockType('md/quotes-slider-block', {

        title: __('Quotes Slider'),
        icon: { src: quoteBlockIcon },
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
                    <div className={`quote-slider ${quotesOptions} ${sliderBgColor}`}>
                        <div className="quote-inner" data-mode={mode} data-autoplay={`${autoplay}`} data-speed={`${speed}`} data-infiniteloop={`${infiniteLoop}`} data-pager={`${pager}`} data-controls={`${controls}`} data-adaptiveheight={`${adaptiveHeight}`}>
                            {quotesList}
                        </div>
                    </div>
                );
            } else { return null; }
        }
    });

})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);