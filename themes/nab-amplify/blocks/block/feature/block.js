;(function(wpI18n, wpBlocks, wpBlockEditor, wpComponents, wpElement){
    const { __ } = wpI18n
    const { registerBlockType } = wpBlocks
    const { Fragment } = wpElement
    const { 
        RichText,
        InspectorControls,
        ColorPalette,
        MediaUpload,
        AlignmentToolbar
    } = wpBlockEditor
    const {
        PanelBody,
        Button,
        ToggleControl,
        SelectControl
    } = wpComponents

    registerBlockType('rg/feature', {
        // built in attributes
        title: __('Feature'),
        description: __('Feature Block'),
        icon: 'editor-code',
        category: 'nab_amplify',
        keywords: [__('Feature'), __('Gutenberg')],
        attributes: {
            backgroundColor: {
                type: 'string',
                default: '#303030'
            },
            backgroundImage: {
                type: 'string',
                default: ''
            },
            backgroundSize: {
                type: "string",
                default: "cover",
            },
            backgroundRepeat: {
                type: "boolean",
                default: false,
            },
            backgroundPosition: {
                type: "string",
                default: "",
            },
            featureIcon: {
                type: "string",
                default: "",
            },
            featureStatusTitle: {
                type: 'string',
                default: ''
            },
            featureStatusColor:{
                type: 'string',
                default: '#e5018b'
            },
            featureTitle: {
                type: 'string',
                default: ''
            },
            featureTitleColor:{
                type: 'string',
                default: '#fff'
            },
            featureAuthor: {
                type: 'string',
                default: ''
            },
            featureAuthorColor:{
                type: 'string',
                default: '#fdd80f'
            },
            featureDisc: {
                type: 'string',
                default: ''
            },
            featureDiscColor:{
                type: 'string',
                default: '#fff'
            },
            featureLike: {
                type: 'string',
                default: '<a href="#" class="btn">Like</a>'
            },
            featureLikeToggle: {
                type: 'Boolean',
                default: false
            },
            featureJoinBtn: {
                type: 'string',
                default: '<a href="#" class="btn">Join Discussion</a>'
            },
            featureJoinToggle: {
                type: 'Boolean',
                default: false
            }
        },
        edit: ({attributes, setAttributes}) => {
            const {
                backgroundColor,
                backgroundImage,
                backgroundSize,
                backgroundRepeat,
                backgroundPosition,
                featureIcon,
                featureStatusTitle,
                featureStatusColor,
                featureTitle,
                featureTitleColor,
                featureAuthor,
                featureAuthorColor,
                featureDisc,
                featureDiscColor,
                featureLike,
                featureLikeToggle,
                featureJoinBtn,
                featureJoinToggle
            } = attributes;

            const backroundStyle = {};
            backgroundColor && (backroundStyle.backgroundColor = backgroundColor);
            backgroundImage && (backroundStyle.backgroundImage = `url(${backgroundImage})`);
            backgroundPosition && (backroundStyle.backgroundPosition = backgroundPosition);
            backgroundRepeat && (backroundStyle.backgroundRepeat = "no-repeat");
            backgroundSize && (backroundStyle.backgroundSize = backgroundSize);

            return ([
                <InspectorControls>
                    <div className="amp-controle-settings">
                        <PanelBody title="Feature Block Image">
                            <div className="inspector-field">
                                <MediaUpload
                                    onSelect={backgroundImage => setAttributes({
                                        backgroundImage: backgroundImage.sizes.full.url
                                    })}
                                    type="image"
                                    value={backgroundImage}
                                    render={({ open })=>(
                                        <Button
                                            onClick={ open }
                                            className={backgroundImage ? "amp-image-button" : "button button-large"}
                                            >
                                            {!backgroundImage ? (
                                                __("Select Image")
                                            ) : (
                                                <div
                                                style={{
                                                    backgroundImage: `url(${backgroundImage})`,
                                                    backgroundSize: "cover",
                                                    backgroundPosition: "center",
                                                    height: "150px",
                                                    width: "225px",
                                                }}
                                                ></div>
                                            )}
                                        </Button>
                                    )}
                                />
                                {backgroundImage ? (
                                <Fragment>
                                    <Button
                                        className="button"
                                        onClick={() => {
                                            setAttributes({ backgroundImage: "" })
                                        }}
                                    >
                                        {__("Remove Image")}
                                    </Button>
                                    <div className="inspector-field-inner">
                                        <ToggleControl
                                            label={__("Background Repeat ")}
                                            checked={backgroundRepeat}
                                            onChange={(backgroundRepeat)=>{
                                                setAttributes({backgroundRepeat})
                                            }}
                                        />
                                        <SelectControl
                                            label={__("background size")}
                                            value={backgroundSize}
                                            options={[
                                                { label: __("auto"), value: "auto" },
                                                { label: __("cover"), value: "cover" },
                                                { label: __("contain"), value: "contain" },
                                                { label: __("initial"), value: "initial" },
                                                { label: __("inherit"), value: "inherit" },
                                            ]}
                                            onChange={(value) => {
                                                setAttributes({
                                                backgroundSize: value,
                                                });
                                            }}
                                        />
                                        <SelectControl
                                            label={__("Select Position")}
                                            value={backgroundPosition}
                                            options={[
                                                { label: __("inherit"), value: "inherit" },
                                                { label: __("initial"), value: "initial" },
                                                { label: __("bottom"), value: "bottom" },
                                                { label: __("center"), value: "center" },
                                                { label: __("left"), value: "left" },
                                                { label: __("right"), value: "right" },
                                                { label: __("top"), value: "top" },
                                                { label: __("unset"), value: "unset" },
                                                { label: __("center center"), value: "center center" },
                                                { label: __("left top"), value: "left top" },
                                                { label: __("left center"), value: "left center" },
                                                { label: __("left bottom"), value: "left bottom" },
                                                { label: __("right top"), value: "right top" },
                                                { label: __("right center"), value: "right center" },
                                                { label: __("right bottom"), value: "right bottom" },
                                                { label: __("center top"), value: "center top" },
                                                { label: __("center bottom"), value: "center bottom" },
                                            ]}
                                            onChange={(value) =>
                                                setAttributes({ backgroundPosition: value })
                                            }
                                        />
                                    </div>
                                </Fragment>
                                ) : (
                                    <div className="inspector-field-inner">
                                        <label>Background Color</label>
                                        <ColorPalette
                                            value={backgroundColor}
                                            onChange={(backgroundColor) =>
                                                setAttributes({backgroundColor})
                                            }
                                        />
                                    </div>
                                )}
                            </div>
                        </PanelBody>
                        <PanelBody title="Typography" initialOpen={false}>
                            <div className="inspector-field">
                                <label>Status Color:</label>
                                <ColorPalette
                                    value={featureStatusColor}
                                    onChange={(featureStatusColor) =>
                                        setAttributes({featureStatusColor})
                                    }
                                />
                            </div>
                            <div className="inspector-field">
                                <label>Title Color:</label>
                                <ColorPalette
                                    value={featureTitleColor}
                                    onChange={(featureTitleColor) =>
                                        setAttributes({featureTitleColor})
                                    }
                                />
                            </div>
                            <div className="inspector-field">
                                <label>Author Color:</label>
                                <ColorPalette
                                    value={featureAuthorColor}
                                    onChange={(featureAuthorColor) =>
                                        setAttributes({featureAuthorColor})
                                    }
                                />
                            </div>
                            <div className="inspector-field">
                                <label>Discription Color:</label>
                                <ColorPalette
                                    value={featureDiscColor}
                                    onChange={(featureDiscColor) =>
                                        setAttributes({featureDiscColor})
                                    }
                                />
                            </div>
                        </PanelBody>
                        <PanelBody title="Button Settings" initialOpen={false}>
                            <ToggleControl
                                label="Hide Like Button"
                                checked={featureLikeToggle}
                                onChange={(featureLikeToggle)=>{
                                    setAttributes({featureLikeToggle});
                                }}
                            />
                            <ToggleControl
                                label="Hide Join Discussion Button"
                                checked={featureJoinToggle}
                                onChange={(featureJoinToggle)=>{
                                    setAttributes({featureJoinToggle});
                                }}
                            />
                        </PanelBody>
                    </div>
                </InspectorControls>,
                <div className="amp-feature-block" style={backroundStyle}>
                    <div className="amp-feature-block-inner">
                        <div className="feature-icon">
                            <MediaUpload
                                onSelect={featureIcon => {
                                    setAttributes({ featureIcon : featureIcon ? featureIcon.sizes.full.url : '' })
                                }}
                                type='image'
                                render={({ open }) => {
                                    if (featureIcon) {
                                        return (
                                            <Fragment>
                                            <span
                                                onClick={open}
                                                className='dashicons dashicons-edit edit-image'
                                            ></span>
                                            <img src={featureIcon} alt="icon" />
                                            </Fragment>
                                        )
                                    } else {
                                        return (
                                            <Button onClick={open} className='button button-large'>
                                            <span className='dashicons dashicons-upload'></span>{' '}
                                            Upload Icon
                                            </Button>
                                        )
                                    }
                                }}
                            />
                        </div>
                        <div className="amp-feature-content">
                            <RichText
                                tagName="h3"
                                placeholder="Live"
                                className="feature-status"
                                value={featureStatusTitle}
                                style={{
                                    color:featureStatusColor
                                }}
                                onChange={(featureStatusTitle)=>{
                                    setAttributes({featureStatusTitle});
                                }}
                            />
                            <RichText
                                tagName="h2"
                                placeholder="Creating the World"
                                className="feature-title"
                                value={featureTitle}
                                style={{
                                    color:featureTitleColor
                                }}
                                onChange={(featureTitle)=>{
                                    setAttributes({featureTitle});
                                }}
                            />
                            <RichText
                                tagName="h4"
                                placeholder="Author"
                                className="feature-author"
                                value={featureAuthor}
                                style={{
                                    color:featureAuthorColor
                                }}
                                onChange={(featureAuthor)=>{
                                    setAttributes({featureAuthor});
                                }}
                            />
                            <RichText
                                tagName="p"
                                placeholder="Discription"
                                className="feature-disc"
                                value={featureDisc}
                                style={{
                                    color:featureDiscColor
                                }}
                                onChange={(featureDisc)=>{
                                    setAttributes({featureDisc});
                                }}
                            />
                            {!featureLikeToggle && (
                                <RichText
                                    tagName="div"
                                    className="button-wrap btn-react"
                                    value={featureLike}
                                    onChange={(featureLike)=>{
                                        setAttributes({featureLike});
                                    }}
                                />
                            )}
                            {!featureJoinToggle && (
                                <RichText
                                    tagName="div"
                                    className="button-wrap btn-link"
                                    value={featureJoinBtn}
                                    onChange={(featureJoinBtn)=>{
                                        setAttributes({featureJoinBtn});
                                    }}
                                />
                            )}
                        </div>
                    </div>
                </div>
            ]);
        },
        save: ({attributes}) => {
            const {
                backgroundColor,
                backgroundImage,
                backgroundSize,
                backgroundRepeat,
                backgroundPosition,
                featureIcon,
                featureStatusTitle,
                featureStatusColor,
                featureTitle,
                featureTitleColor,
                featureAuthor,
                featureAuthorColor,
                featureDisc,
                featureDiscColor,
                featureLike,
                featureLikeToggle,
                featureJoinBtn,
                featureJoinToggle
            } = attributes;

            const backroundStyle = {};
            backgroundColor && (backroundStyle.backgroundColor = backgroundColor);
            backgroundImage && (backroundStyle.backgroundImage = `url(${backgroundImage})`);
            backgroundPosition && (backroundStyle.backgroundPosition = backgroundPosition);
            backgroundRepeat && (backroundStyle.backgroundRepeat = "no-repeat");
            backgroundSize && (backroundStyle.backgroundSize = backgroundSize);

            return(
                <div className="amp-feature-block" style={backroundStyle}>
                    <div className="amp-feature-block-inner">
                        {featureIcon && (
                            <div className="feature-icon">
                                <img src={featureIcon} alt="icon" />
                            </div>
                        )}
                        <div className="amp-feature-content">
                            {featureStatusTitle && (
                                <RichText.Content
                                    tagName="h3"
                                    value={featureStatusTitle}
                                    style={{
                                        color:featureStatusColor
                                    }}
                                    className="feature-status"
                                />
                            )}
                            {featureTitle && (
                                <RichText.Content
                                    tagName="h2"
                                    value={featureTitle}
                                    style={{
                                        color:featureTitleColor
                                    }}
                                    className="feature-title"
                                />
                            )}
                            {featureAuthor && (
                                <RichText.Content
                                    tagName="h4"
                                    value={featureAuthor}
                                    style={{
                                        color:featureAuthorColor
                                    }}
                                    className="feature-author"
                                />
                            )}
                            {featureDisc && (
                                <RichText.Content
                                    tagName="p"
                                    value={featureDisc}
                                    style={{
                                        color:featureDiscColor
                                    }}
                                    className="feature-disc"
                                />
                            )}
                            {!featureLikeToggle && (
                                <RichText.Content
                                    tagName="div"
                                    className="button-wrap btn-react"
                                    value={featureLike}
                                    onChange={(featureLike)=>{
                                        setAttributes({featureLike});
                                    }}
                                />
                            )}
                            {!featureJoinToggle && (
                                <RichText.Content
                                    tagName="div"
                                    className="button-wrap btn-link"
                                    value={featureJoinBtn}
                                />
                            )}
                        </div>
                    </div>
                </div>
            )
        }
    });

})(wp.i18n, wp.blocks, wp.blockEditor, wp.components, wp.element)