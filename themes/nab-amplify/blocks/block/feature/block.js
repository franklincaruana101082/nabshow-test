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

    },
    edit: ({attributes, setAttributes}) => {
        return ([
            <h1>static</h1>
        ]);
    },
    save: ({attributes}) => {
        return(
            <h1>static</h1>
        )
    }
});

})(wp.blocks, wp.blockEditor, wp.components);