(function(i18n, wpBlocks, wpBlockEditor, wpComponents){ 
const { registerBlockType } = wpBlocks;
const { __ } = wp.i18n;
const { 
    RichText,
    InspectorControls,
    ColorPalette,
    MediaUpload,
    AlignmentToolbar
} = wpBlockEditor;
const { Fragment } = wp.element;
const {
    PanelBody,
    PanelRow,
    Button,
    RangeControl,
    ToggleControl,
    SelectControl
} = wpComponents;

registerBlockType('amplify/feature', {
    // built in attributes
    title: __('Feature'),
    description: __('Feature Block'),
    icon: 'editor-code',
    category: 'nab_amplify',
    attributes: {
        backgroundColor: {
            type: 'string',
            default: ''
        },
        backgroundOverlay: {
            type: 'string',
            default: ''
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
        featureStatusToggle: {
            type: 'Boolean',
            default: true
        },
        featureTitleToggle: {
            type: 'Boolean',
            default: true
        },
        featureAuthorToggle: {
            type: 'Boolean',
            default: true
        },
        featureDiscToggle: {
            type: 'Boolean',
            default: true
        },
        featureStatusTitle: {
            type: 'string',
            default: ''
        },
        featureTitle: {
            type: 'string',
            default: ''
        },
        featureAuthor: {
            type: 'string',
            default: ''
        },
        featureDisc: {
            type: 'string',
            default: ''
        }
    },
    edit: ({attributes, setAttributes}) => {
        const {
            backgroundColor,
            backgroundOverlay,
            backgroundImage,
            backgroundSize,
            backgroundRepeat,
            backgroundPosition,
            featureStatusToggle,
            featureTitleToggle,
            featureAuthorToggle,
            featureDiscToggle,
            featureStatusTitle,
            featureTitle,
            featureAuthor,
            featureDisc
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
                    <PanelBody title="Feature Content Settings">
                        <div className="inspector-field">
                            <ToggleControl
                                label={__("Feature Status Title")}
                                checked={featureStatusToggle}
                                onChange={(featureStatusToggle)=>{
                                    setAttributes({featureStatusToggle})
                                }}
                            />
                            <ToggleControl
                                label={__("Feature Title")}
                                checked={featureTitleToggle}
                                onChange={(featureTitleToggle)=>{
                                    setAttributes({featureTitleToggle})
                                }}
                            />
                            <ToggleControl
                                label={__("Feature Author")}
                                checked={featureAuthorToggle}
                                onChange={(featureAuthorToggle)=>{
                                    setAttributes({featureAuthorToggle})
                                }}
                            />
                            <ToggleControl
                                label={__("Feature Discription")}
                                checked={featureDiscToggle}
                                onChange={(featureDiscToggle)=>{
                                    setAttributes({featureDiscToggle})
                                }}
                            />
                        </div>
                    </PanelBody>
                </div>
            </InspectorControls>,
            <div className="amp-feature-block" style={backroundStyle}>
                <div className="amp-feature-block-inner">
                    <div className="amp-feature-content">
                        {featureStatusToggle ?
                            <RichText
                                tagName="h3"
                                placeholder="Live"
                                className="feature-status"
                                value={featureStatusTitle}
                                onChange={(featureStatusTitle)=>{
                                    setAttributes({featureStatusTitle});
                                }}
                            /> : null
                        }
                        {featureTitleToggle ?
                            <RichText
                                tagName="h2"
                                placeholder="Creating the World"
                                className="feature-title"
                                value={featureTitle}
                                onChange={(featureTitle)=>{
                                    setAttributes({featureTitle});
                                }}
                        /> : null
                        }
                        {featureAuthorToggle ?
                            <RichText
                                tagName="h4"
                                placeholder="Author"
                                className="feature-author"
                                value={featureAuthor}
                                onChange={(featureAuthor)=>{
                                    setAttributes({featureAuthor});
                                }}
                            /> : null
                        }
                        {featureDiscToggle ?
                            <RichText
                                tagName="p"
                                placeholder="Discription"
                                className="feature-disc"
                                value={featureDisc}
                                onChange={(featureDisc)=>{
                                    setAttributes({featureDisc});
                                }}
                            /> : null
                        }
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
            featureStatusToggle,
            featureTitleToggle,
            featureAuthorToggle,
            featureDiscToggle,
            featureStatusTitle,
            featureTitle,
            featureAuthor,
            featureDisc
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
                    <div className="amp-feature-content">
                        {featureStatusToggle ?
                            <RichText.Content
                                tagName="h3"
                                value={featureStatusTitle}
                                className="feature-status"
                            /> : null
                        }
                        {featureTitleToggle ?
                            <RichText.Content
                                tagName="h2"
                                value={featureTitle}
                                className="feature-title"
                            /> : null
                        }
                        {featureAuthorToggle ?
                            <RichText.Content
                                tagName="h4"
                                value={featureAuthor}
                                className="feature-author"
                            /> : null
                        }
                        {featureDiscToggle ?
                            <RichText.Content
                                tagName="p"
                                value={featureDisc}
                                className="feature-disc"
                            /> : null
                        }
                    </div>
                </div>
            </div>
        )
    }
});

})(wp.i18n, wp.blocks, wp.blockEditor, wp.components);