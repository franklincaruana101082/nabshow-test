(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    const { __ } = wpI18n;
    const { Fragment } = wpElement;
    const { registerBlockType } = wpBlocks;
    const { InspectorControls, MediaUpload, BlockControls } = wpEditor;
    const { PanelBody, PanelRow, DateTimePicker, Toolbar, IconButton, ToggleControl, TextControl, ServerSideRender, Button, Placeholder } = wpComponents;

    const adUploadIcon = (
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="2 2 22 22" className="dashicon">
            <path fill="none" d="M0 0h24v24H0V0z" />
            <path d="M20 4h-3.17L15 2H9L7.17 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zM9.88 4h4.24l1.83 2H20v12H4V6h4.05" />
            <path d="M15 11H9V8.5L5.5 12 9 15.5V13h6v2.5l3.5-3.5L15 8.5z" />
        </svg>
    );

    const allAttr = {
        imgSource: {
            type: 'string',
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
            type: 'string',
        },
        linkTarget: {
            type: 'boolean',
            default: true,
        },
        scheduleAd: {
            type: 'boolean',
            default: false,
        },
        startDate: {
            type: 'string',
        },
        endDate: {
            type: 'string',
        },
        eventCategory: {
            type: 'string',
        },
        eventAction: {
            type: 'string',
        },
        eventLabel: {
            type: 'string',
        },
        showCal: {
            type: 'boolean',
            default: false,
        },
        addAlign: {
            type: 'string',
            default: 'center'
        }
    };


    registerBlockType('nab/advertisement', {
        title: __('Advertisement'),
        icon: 'lock',
        category: 'nabshow',
        keywords: [__('ad'), __('advertisement')],
        attributes: allAttr,
        edit(props) {
            const { attributes: { imgSource, imgID, imgWidth, imgHeight, linkURL, linkTarget, scheduleAd, startDate, endDate, eventCategory, eventAction, eventLabel, showCal, addAlign }, setAttributes } = props;

            const style = {};
            imgWidth && (style.width = imgWidth + 'px');
            imgHeight && (style.height = imgHeight + 'px');

            $(document).on('click', '.inspector-field-toggleCal .components-form-toggle__input', function (e) {
                e.stopImmediatePropagation();
                if (! $('.inspector-field-datetime .components-datetime__date').hasClass('toggled')) {
                    $('.inspector-field-datetime .components-datetime__date').show();
                    $('.components-datetime .components-datetime__date').addClass('toggled');
                    $('.components-datetime .components-datetime__date > div').removeClass('DayPicker__hidden');
                    setAttributes({ showCal: ! showCal });
                } else {
                    $('.inspector-field-datetime .components-datetime__date').hide();
                    $('.components-datetime .components-datetime__date').removeClass('toggled');
                    $('.components-datetime .components-datetime__date > div').addClass('DayPicker__hidden');
                    setAttributes({ showCal: showCal });
                }
            });


            if (! imgID) {
                return (
                    <Placeholder
                        icon={adUploadIcon}
                        label={__('Advertisement')}
                        instructions={__('No image selected. Add image to start using this block.')}
                    >
                        <MediaUpload
                            allowedTypes={['image']}
                            value={null}
                            onSelect={(item) => setAttributes({ imgSource: item.url, imgID: item.id })}
                            render={({ open }) => (
                                <Button className="button button-large button-primary" onClick={open}>
                                    {__('Add image')}
                                </Button>
                            )}
                        />
                    </Placeholder>
                );
            }

            if ( ! startDate ) {
                setAttributes({startDate: moment().format('YYYY-MM-DDTHH:mm:ss')});
            }
            return (
                <Fragment>
                    <InspectorControls>
                        <PanelBody title={__('Schedule Display Settings')}>
                            <ToggleControl
                                label={__('Display According to Date time')}
                                checked={scheduleAd}
                                onChange={() => setAttributes({ scheduleAd: ! scheduleAd })}
                            />
                            { scheduleAd &&
                                <Fragment>
                                    <div className="inspector-field inspector-field-toggleCal components-base-control">
                                        <div className="toggleCalender">
                                            <span className="cal"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path
                                                d="M436 160H12c-6.6 0-12-5.4-12-12v-36c0-26.5 21.5-48 48-48h48V12c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v52h128V12c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v52h48c26.5 0 48 21.5 48 48v36c0 6.6-5.4 12-12 12zM12 192h424c6.6 0 12 5.4 12 12v260c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V204c0-6.6 5.4-12 12-12zm116 204c0-6.6-5.4-12-12-12H76c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12v-40zm0-128c0-6.6-5.4-12-12-12H76c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12v-40zm128 128c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12v-40zm0-128c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12v-40zm128 128c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12v-40zm0-128c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12v-40z"></path></svg></span>
                                            <span className="text">Toggle Calendar</span>
                                        </div>
                                        <ToggleControl
                                            checked={showCal}
                                        />
                                    </div>
                                    <div className="inspector-field inspector-field-datetime components-base-control">
                                        <label className="inspector-mb-0">Select Date time to start display</label>
                                        <div className="inspector-ml-auto">
                                            <DateTimePicker
                                                currentDate={startDate}
                                                onChange={(date) => setAttributes({startDate: date})}
                                            />
                                        </div>
                                    </div>
                                    <div className="inspector-field inspector-field-datetime components-base-control">
                                        <label className="inspector-mb-0">Select Date time to remove</label>
                                        <div className="inspector-ml-auto">
                                            <DateTimePicker
                                                currentDate={endDate}
                                                onChange={(date) => setAttributes({endDate: date})}
                                            />
                                        </div>
                                    </div>
                                </Fragment>
                            }
                        </PanelBody>
                        <PanelBody title={__('Image Settings')} initialOpen={false}>
                            <PanelRow>
                                <div className="inspector-field alignment-settings">
                                    <div className="alignment-wrapper">
                                        <TextControl
                                            label="Width"
                                            type="number"
                                            value={imgWidth}
                                            min={1}
                                            max={1500}
                                            step={1}
                                            onChange={(width) => setAttributes({ imgWidth: parseInt(width) })}
                                        />
                                    </div>
                                    <div className="alignment-wrapper">
                                        <TextControl
                                            label="Height"
                                            type="number"
                                            value={imgHeight}
                                            min={1}
                                            max={1500}
                                            step={1}
                                            onChange={(height) => setAttributes({ imgHeight: parseInt(height) })}
                                        />
                                    </div>
                                </div>
                            </PanelRow>
                            <PanelRow>
                                <div className="inspector-field inspector-field-alignment">
                                    <label className="inspector-mb-0">Alignment</label>
                                    <div className="inspector-field-button-list inspector-field-button-list-fluid">
                                        <button className={'left' === addAlign ? 'active  inspector-button' : 'inspector-button'} onClick={() => setAttributes({ addAlign: 'left' })}><i className="fa fa-align-left"></i></button>
                                        <button className={'center' === addAlign ? 'active  inspector-button' : 'inspector-button'} onClick={() => setAttributes({ addAlign: 'center' })}><i className="fa fa-align-center"></i></button>
                                        <button className={'right' === addAlign ? 'active  inspector-button' : 'inspector-button'} onClick={() => setAttributes({ addAlign: 'right' })}><i className="fa fa-align-right"></i></button>
                                    </div>
                                </div>
                            </PanelRow>
                        </PanelBody>
                        <PanelBody title={__('Link Settings')} initialOpen={false}>
                            <TextControl
                                label="Link URL"
                                type="string"
                                value={linkURL}
                                placeholder="`https://`"
                                onChange={(link) => setAttributes({ linkURL: link })}
                            />
                            <ToggleControl
                                label={__('Open in New Tab')}
                                checked={linkTarget}
                                onChange={() => setAttributes({ linkTarget: ! linkTarget })}
                            />
                        </PanelBody>
                        <PanelBody title={__('Google Event')} initialOpen={false}>
                            <TextControl
                                label="Event Category"
                                type="string"
                                value={eventCategory}
                                placeholder="Enter Category"
                                onChange={(category) => setAttributes({ eventCategory: category })}
                            />
                            <TextControl
                                label="Event Action"
                                type="string"
                                value={eventAction}
                                placeholder="Enter Action"
                                onChange={(action) => setAttributes({ eventAction: action })}
                            />
                            <TextControl
                                label="Event Label"
                                type="string"
                                value={eventLabel}
                                placeholder="Enter Label"
                                onChange={(label) => setAttributes({ eventLabel: label })}
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
                    <div className="nab-banner-main" style={{textAlign: addAlign}}>
                        <div className="nab-banner-inner">
                            <p className="banner-text">Advertisement</p>
                            <img src={imgSource}
                                className="banner-img"
                                alt={__('image')}
                                style={style}

                            />
                        </div>
                    </div>
                    <ServerSideRender
                        block="nab/advertisement"
                    />
                </Fragment >
            );
        },
        save() {
            return null;
        },
    });

})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);