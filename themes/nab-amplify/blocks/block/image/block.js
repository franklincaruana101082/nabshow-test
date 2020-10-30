(function(i18n, wpBlocks, wpBlockEditor, wpComponents){
const { registerBlockType } = wpBlocks;
const { __ } = wp.i18n;
const { 
    RichText,
    InspectorControls,
    MediaUpload,
    AlignmentToolbar
} = wpBlockEditor;
const {
    PanelBody,
    Button,
    ToggleControl,
    TextControl
} = wpComponents;

registerBlockType('amplify/image',{
    // built in attributes
    title: __('Image'),
    description: __('Image Block'),
    icon: 'editor-code',
    category: 'nab_amplify',
    attributes: {
        ImageUrl: {
            type: 'string',
            default: ''
        },
        ImageAlt:  {
            type: 'string',
            default: ''
        },
        ImageLink:  {
            type: 'url',
            default: ''
        },
        ImageLinkTarget: {
            type: 'Boolean',
            default: false
        },
        textAlign: {
            type: 'string',
            default: ''
        }
    },
    edit: ({attributes, setAttributes}) => {
        const {
            ImageUrl,
            ImageAlt,
            ImageLink,
            ImageLinkTarget,
            textAlign
        } = attributes;

        const linkTarget = ImageLinkTarget ? '_blank' : '_self';

        const divStyle = {};
        divStyle && (divStyle.textAlign = textAlign);

        return ([
            <InspectorControls>
                <div className="amp-controle-settings">
                    <PanelBody title={__("Image settings")}>
                        <div className="inspector-field">
                            <MediaUpload
                                onSelect={ImageUrl => setAttributes({ImageUrl: ImageUrl ? ImageUrl.sizes.full.url : ''})}
                                type="image"
                                value={ImageUrl}
                                render={({ open })=>(
                                    <Button
                                        onClick={ open }
                                        className={ImageUrl ? "amp-image-button" : "button button-large"}>
                                        {!ImageUrl ? (
                                            __("Select Image")
                                        ) : (
                                            <div
                                            style={{
                                                backgroundImage: `url(${ImageUrl})`,
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
                            {ImageUrl ? (
                            <Button
                                className="button"
                                onClick={() => {
                                    setAttributes({ ImageUrl: "" })
                                }}
                            >
                                {__("Remove Image")}
                            </Button>
                            ) : null}
                        </div>
                        <div className="inspector-field">
                            <TextControl
                                value={ImageAlt}
                                type="string"
                                label="Alt Text"
                                onChange={(ImageAlt)=>{
                                    setAttributes({ImageAlt:ImageAlt ? ImageAlt : ''});
                                }}
                            />
                        </div>
                        <div className="inspector-field">
                            <TextControl
                                value={ImageLink}
                                type="url"
                                label="Image Link"
                                placeholder="https://google.com/"
                                onChange={(ImageLink)=>{
                                    setAttributes({ImageLink});
                                }}
                            />
                        </div>
                        <div className="inspector-field">
                            <ToggleControl
                                label="Open in new Tab"
                                checked={ImageLinkTarget}
                                onChange={(ImageLinkTarget)=>{
                                    setAttributes({ImageLinkTarget});
                                }}
                            />
                        </div>
                        <div className="inspector-field">
                            <label>Image Alignment</label>
                            <AlignmentToolbar
                                value={textAlign}
                                onChange={(textAlign)=>{
                                    setAttributes({textAlign});
                                }}
                            />
                        </div>
                    </PanelBody>
                </div>
            </InspectorControls>,
            <div className="amp-image-block" style={divStyle}>
                {!ImageUrl ? (
                    <div className="amp-button-wrap">
                        <MediaUpload
                            onSelect={ImageUrl => setAttributes({
                                ImageUrl: ImageUrl.sizes.full.url
                            })}
                            type="image"
                            value={ImageUrl}
                            render={({ open })=>(
                                <Button
                                    onClick={ open }
                                    className={ImageUrl ? "amp-image-button" : "button button-large"}>
                                    {!ImageUrl ? (
                                        __("Select Image")
                                    ) : null}
                                </Button>
                            )}
                        />
                    </div>
                ) : (
                    (!ImageLink ? (
                        <img src={ImageUrl} alt={ImageAlt} />
                    ) : (
                        <a href={ImageLink} target={linkTarget} rel="noopener noreferrer">
                            <img src={ImageUrl} alt={ImageAlt} />
                        </a>
                    ))
                )}
            </div>
        ]);
    },
    save: ({attributes}) => {
        const {
            ImageUrl,
            ImageAlt,
            ImageLink,
            ImageLinkTarget,
            textAlign
        } = attributes;

        const linkTarget = ImageLinkTarget ? '_blank' : '_self';

        const divStyle = {};
        textAlign && (divStyle.textAlign = textAlign);

        return(
            <div className="amp-image-block" style={divStyle}>
            {!ImageLink ? (
                <img src={ImageUrl} alt={ImageAlt} />
            ) : (
                <a href={ImageLink} target={linkTarget} rel="noopener noreferrer">
                    <img src={ImageUrl} alt={ImageAlt} />
                </a>
            )}
            </div>
        )
    }
});

})(wp.i18n, wp.blocks, wp.blockEditor, wp.components);