(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    const { __ } = wpI18n;
    const { Fragment } = wpElement;
    const { registerBlockType } = wpBlocks;
    const { InspectorControls } = wpEditor;
    const { PanelBody, RangeControl, RadioControl, TextControl, ServerSideRender, Button, Placeholder } = wpComponents;

    const allAttr = {
        postId: {
            type: 'number',
        },
        itemToFetch: {
            type: 'number',
            default: 10
        },
        selectionType: {
            type: 'string',
            default: 'current'
        },
        selection: {
            type: 'boolean',
            default: false
        }
    };


    registerBlockType('nab/related-content', {
        title: __('Related Content'),
        icon: 'lock',
        category: 'nabshow',
        keywords: [__('related'), __('content')],
        attributes: allAttr,
        edit(props) {
            const { attributes: { selection, postId, selectionType, itemToFetch }, setAttributes } = props;
            let currentPostId = wp.data.select('core/editor').getCurrentPostId();
            if (! selection) {
                if ('current' === selectionType) {
                    setAttributes({ postId: currentPostId });
                }
                return (
                    <Placeholder
                        label={__('Related Content')}
                        instructions={__('Choose option to get related content')}
                    >
                        <div className="inspector-field inspector-field-radiocontrol ">
                            <RadioControl
                                selected={selectionType}
                                options={[
                                    { label: 'Current Page ID', value: 'current' },
                                    { label: 'Other Page ID', value: 'custom' },
                                ]}
                                onChange={(option) => { setAttributes({ selectionType: option }); }}
                            />
                            {'custom' === selectionType &&
                                <TextControl
                                    type="number"
                                    value={postId}
                                    onChange={(customId) => { setAttributes({ postId: parseInt(customId) }); }}
                                />
                            }
                        </div>
                        <Button className="button button-large button-primary" onClick={() => setAttributes({ selection: true })}>
                            {__('Apply')}
                        </Button>
                    </Placeholder>
                );
            }
            return (
                <Fragment>
                    <InspectorControls>
                        <PanelBody title={__('Content Settings')}>
                            <div className="inspector-field inspector-field-Numberofitems ">
                                <label className="inspector-mb-0">Number of items</label>
                                <RangeControl
                                    value={itemToFetch}
                                    min={1}
                                    max={20}
                                    onChange={(item) => setAttributes({ itemToFetch: parseInt(item) })}
                                />
                            </div>
                            <div className="inspector-field inspector-field-radiocontrol ">
                                <RadioControl
                                    label={__('Choose option to get related content')}
                                    selected={selectionType}
                                    options={[
                                        { label: 'Current Page ID', value: 'current' },
                                        { label: 'Other Page ID', value: 'custom' },
                                    ]}
                                    onChange={(option) => { setAttributes({ selectionType: option, postId: 'current' === option ? currentPostId : postId }); }}
                                />
                                {'custom' === selectionType &&
                                    <TextControl
                                        type="number"
                                        value={postId}
                                        onChange={(customId) => { setAttributes({ postId: parseInt(customId) }); }}
                                    />
                                }
                            </div>
                        </PanelBody>
                    </InspectorControls>
                    <ServerSideRender
                        block="nab/related-content"
                        attributes={{ postId: postId, itemToFetch: itemToFetch }}
                    />
                </Fragment>

            );
        },
        save() {
            return null;
        },
    });

})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);