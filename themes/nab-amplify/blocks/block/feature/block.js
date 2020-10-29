(function(wpBlocks, wpBlockEditor, wpComponents){ 
const { registerBlockType } = wpBlocks;
const { 
    RichText,
    InspectorControls,
    ColorPalette,
    MediaUpload,
    AlignmentToolbar
} = wpBlockEditor;
const {
    PanelBody,
    PanelRow,
    Button,
    RangeControl,
    ToggleControl
} = wpComponents;

registerBlockType('amplify/feature', {
    // built in attributes
    title: 'Feature',
    description: 'Feature Block',
    icon: 'editor-code',
    category: 'nab_amplify',
    attributes: {
        featureStatusToggle: {
            type: 'Boolean',
            default: false
        },
        featureTitleToggle: {
            type: 'Boolean',
            default: false
        },
        featureAuthorToggle: {
            type: 'Boolean',
            default: false
        },
        featureDiscToggle: {
            type: 'Boolean',
            default: false
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
            featureStatusToggle,
            featureTitleToggle,
            featureAuthorToggle,
            featureDiscToggle,
            featureStatusTitle,
            featureTitle,
            featureAuthor,
            featureDisc
        } = attributes;
        return ([
            <InspectorControls>
                <PanelBody title="Feature Content Settings">
                    <div className="inspector-field">
                        <ToggleControl
                            label="Feature Status Title"
                            checked={featureStatusToggle}
                            onChange={(featureStatusToggle)=>{
                                setAttributes({featureStatusToggle})
                            }}
                        />
                    </div>
                </PanelBody>
            </InspectorControls>,
            <div className="amp-feature-block">
                <div className="amp-feature-block-inner">
                    <div className="amp-feature-content">
                        <RichText
                            tagName="h4"
                            placeholder="Live"
                            value={featureStatusTitle}
                            onChange={(featureStatusTitle)=>{
                                setAttributes({featureStatusTitle});
                            }}
                        />
                        <RichText
                            tagName="h2"
                            placeholder="Live"
                            value={featureTitle}
                            onChange={(featureTitle)=>{
                                setAttributes({featureTitle});
                            }}
                        />
                    </div>
                </div>
            </div>
        ]);
    },
    save: ({attributes}) => {
        const {
            featureStatusToggle,
            featureTitleToggle,
            featureAuthorToggle,
            featureDiscToggle
        } = attributes;
        return(
            <RichText.Content
                tagName="h2"
                value={featureTitle}
            />
        )
    }
});

})(wp.blocks, wp.blockEditor, wp.components);