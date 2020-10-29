(function(wpBlocks, wpBlockEditor, wpComponents){
const { registerBlockType } = wpBlocks;
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
    title: 'Image',
    description: 'Image Block',
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
        ImageAlign: {
            type: 'string',
            default: 'none'
        }
    },
    edit: ({attributes, setAttributes}) => {
        const {
            ImageUrl,
            ImageAlt,
            ImageLink,
            ImageLinkTarget,
            ImageAlign
        } = attributes;

        var linkTarget = ImageLinkTarget ? '_blank' : '_self';

        return ([
            <InspectorControls>
                <div className="amp-controle-settings">
                    <PanelBody title={"Image settings"}>
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
                                            ("Select Image")
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
                                {("Remove Image")}
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
                            <AlignmentToolbar
                                value={ImageAlign}
                                onChange={(ImageAlign)=>{
                                    setAttributes({ImageAlign: undefined === ImageAlign ? 'none' : ImageAlign});
                                }}
                            />
                        </div>
                    </PanelBody>
                </div>
            </InspectorControls>,
            <div className="amp-image-block" style={{
                textAlign:ImageAlign
            }}>
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
                                        ("Select Image")
                                    ) : null}
                                </Button>
                            )}
                        />
                    </div>
                ) : (
                    (!ImageLink ? (
                        <img src={ImageUrl} alt={ImageAlt} />
                    ) : (
                        <a href={ImageLink} target={linkTarget}>
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
            ImageAlign
        } = attributes;

        var linkTarget = ImageLinkTarget ? '_blank' : '_self';

        return(
            <div className="amp-image-block" style={{
                textAlign:ImageAlign
            }}>
            {!ImageLink ? (
                <img src={ImageUrl} alt={ImageAlt} />
            ) : (
                <a href={ImageLink} target={linkTarget}>
                    <img src={ImageUrl} alt={ImageAlt} />
                </a>
            )}
            </div>
        )
    }
});

})(wp.blocks, wp.blockEditor, wp.components);