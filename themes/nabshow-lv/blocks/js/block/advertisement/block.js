(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    const { __ } = wpI18n;
    const { Fragment } = wpElement;
    const { registerBlockType } = wpBlocks;
    const { InspectorControls, MediaUpload, BlockControls } = wpEditor;
    const { PanelBody, DateTimePicker, Toolbar, IconButton, ToggleControl, TextControl, ServerSideRender, Button, Placeholder } = wpComponents;

    const adUploadIcon = (
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="2 2 22 22" className="dashicon">
            <path fill="none" d="M0 0h24v24H0V0z" />
            <path d="M20 4h-3.17L15 2H9L7.17 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zM9.88 4h4.24l1.83 2H20v12H4V6h4.05" />
            <path d="M15 11H9V8.5L5.5 12 9 15.5V13h6v2.5l3.5-3.5L15 8.5z" />
        </svg>
    );

    registerBlockType('nab/advertisement', {
        title: __('Advertisement'),
        icon: 'lock',
        category: 'nabshow',
        keywords: [__('ad'), __('advertisement')],
        attributes: {
            imgSource: {
                type: 'string'
            },
            imgID: {
                type: 'number',
            },
            imgWidth: {
                type: 'number',
            },
            imgHeight: {
                type: 'number',
            },
            linkURL: {
                type: 'string'
            },
            linkTarget: {
                type: 'boolean',
                default: true
            },
            startDate: {
                type: 'string'
            },
            endDate: {
                type: 'string'
            },
            eventCategory: {
                type: 'string'
            },
            eventAction: {
                type: 'string'
            },
            eventLabel: {
                type: 'string'
            }
        },
        edit(props){
            const { attributes: { imgSource, imgID, imgWidth, imgHeight, linkURL, linkTarget, startDate, endDate, eventCategory, eventAction, eventLabel }, setAttributes } = props;

            if ( ! imgID ) {
                return (
                    <Placeholder
                        icon={adUploadIcon}
                        label={__('Advertisement')}
                        instructions={__('No image selected. Add image to start using this block.')}
                    >
                        <MediaUpload
                            allowedTypes={['image']}
                            value={null}
                            onSelect={(item) => setAttributes({ imgSource: item.url, imgID: item.id }) }
                            render={({ open }) => (
                                <Button className="button button-large button-primary" onClick={open}>
                                    {__('Add image')}
                                </Button>
                            )}
                        />
                    </Placeholder>
                );
            }
            return (
                <Fragment>
                    <InspectorControls>
                        <PanelBody title={__('Schedule Display Settings')}>
                            <label>Select Date time to start display</label>
                            <DateTimePicker
                                currentDate={startDate}
                                onChange ={(date) => setAttributes({ startDate: date})}
                            />
                            <label>Select Date time to remove</label>
                            <DateTimePicker
                                currentDate={endDate}
                                onChange ={(date) => setAttributes({ endDate: date})}
                            />
                        </PanelBody>
                        <PanelBody title={__('Image Settings')}>
                            <TextControl
                                label="Width"
                                type="number"
                                value={imgWidth}
                                min={1}
                                max={1500}
                                step={1}
                                onChange={(width) => setAttributes({ imgWidth: parseInt(width) }) }
                            />
                            <TextControl
                                label="Height"
                                type="number"
                                value={imgHeight}
                                min={1}
                                max={1500}
                                step={1}
                                onChange={(height) => setAttributes({ imgHeight: parseInt(height) }) }
                            />
                        </PanelBody>
                        <PanelBody title={__('Link Settings')}>
                            <TextControl
                                label="Link URL"
                                type="string"
                                value={linkURL}
                                placeholder="`https://`"
                                onChange={(link) => setAttributes({ linkURL: link }) }
                            />
                            <ToggleControl
                                label={__('Open in New Tab')}
                                checked={linkTarget}
                                onChange={() => setAttributes({ linkTarget: ! linkTarget })}
                            />
                            <label>Google Event</label>
                            <TextControl
                                label="Event Category"
                                type="string"
                                value={eventCategory}
                                placeholder="Enter Category"
                                onChange={(category) => setAttributes({ eventCategory: category }) }
                            />
                            <TextControl
                                label="Event Action"
                                type="string"
                                value={eventAction}
                                placeholder="Enter Action"
                                onChange={(action) => setAttributes({ eventAction: action }) }
                            />
                            <TextControl
                                label="Event Label"
                                type="string"
                                value={eventLabel}
                                placeholder="Enter Label"
                                onChange={(label) => setAttributes({ eventLabel: label }) }
                            />
                        </PanelBody>
                    </InspectorControls>
                    <Fragment>
                        <BlockControls>
                            <Toolbar>
                                <MediaUpload
                                    allowedTypes={['image']}
                                    value={imgID}
                                    onSelect={(item) => setAttributes({ imgSource: item.url })}
                                    render={({ open }) => (
                                        <IconButton
                                            className="components-toolbar__control"
                                            label={__('Change image')}
                                            icon="edit"
                                            onClick={open}
                                        />
                                    )}
                                />
                            </Toolbar>
                        </BlockControls>
                    </Fragment>
                    <div className="nab-banner-main">
                        <img src={imgSource}
                             className="banner-img"
                             alt={__('image')}
                             width={imgWidth}
                             height={imgHeight}
                        />
                    </div>
                    <ServerSideRender
                        block="nab/advertisement"
                    />
                </Fragment>
            );
        },
        save() {
            return null;
        },
    });

})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);