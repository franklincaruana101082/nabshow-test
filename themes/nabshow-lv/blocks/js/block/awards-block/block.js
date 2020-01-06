import times from 'lodash/times';
import memoize from 'memize';

(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
    const { __ } = wpI18n;
    const { registerBlockType } = wpBlocks;
    const { Fragment } = wpElement;
    const { RichText, MediaUpload, BlockControls, InspectorControls, InnerBlocks } = wpEditor;
    const { PanelBody, PanelRow, ToggleControl, Button, Toolbar, IconButton } = wpComponents;

    const awardBlockIcons = (
        <svg width="150px" height="150px" viewBox="0 0 150 150" enable-background="new 0 0 150 150">
            <g>
                <g>
                    <path fill="#146DB6" d="M114.949,43.59H36.331c-1.118,0-2.024,0.906-2.024,2.024s0.906,2.024,2.024,2.024h78.618
                        c1.118,0,2.024-0.906,2.024-2.024S116.066,43.59,114.949,43.59z"/>
                </g>
            </g>
            <g>
                <g>
                    <path fill="#146DB6" d="M114.949,65.628H36.331c-1.118,0-2.024,0.906-2.024,2.024c0,1.118,0.906,2.024,2.024,2.024h78.618
                        c1.118,0,2.024-0.906,2.024-2.024S116.066,65.628,114.949,65.628z"/>
                </g>
            </g>
            <g>
                <g>
                    <path fill="#146DB6" d="M89.175,79.93H62.105c-1.118,0-2.024,0.906-2.024,2.024s0.906,2.024,2.024,2.024h27.069
                        c1.118,0,2.023-0.906,2.023-2.024S90.293,79.93,89.175,79.93z"/>
                </g>
            </g>
            <g>
                <g>
                    <path fill="#146DB6" d="M114.949,54.564H56.307c-1.118,0-2.024,0.906-2.024,2.024c0,1.117,0.906,2.024,2.024,2.024h58.642
                        c1.117,0,2.024-0.906,2.024-2.024C116.974,55.47,116.066,54.564,114.949,54.564z"/>
                </g>
            </g>
            <g>
                <g>
                    <path fill="#146DB6" d="M46.89,54.563H36.331c-1.118,0-2.024,0.906-2.024,2.024s0.906,2.024,2.024,2.024H46.89
                        c1.118,0,2.024-0.906,2.024-2.024C48.914,55.47,48.008,54.563,46.89,54.563z"/>
                </g>
            </g>
            <g>
                <g>
                    <path fill="#146DB6" d="M134.223,40.169c-0.471-0.462-1.095-0.717-1.759-0.717c-0.001,0-0.001,0-0.002,0
                        c-4.102,0-7.46-3.207-7.645-7.301c-0.061-1.332-1.154-2.375-2.49-2.375H28.472c-1.337,0-2.431,1.043-2.492,2.375
                        c-0.176,3.913-3.379,7.117-7.292,7.292c-1.333,0.06-2.375,1.154-2.375,2.491v52.318c0,1.337,1.043,2.431,2.375,2.49
                        c3.913,0.177,7.116,3.38,7.292,7.294c0.061,1.332,1.155,2.375,2.492,2.375h59.749c1.117,0,2.023-0.906,2.023-2.024
                        s-0.905-2.024-2.023-2.024H29.864c-0.836-4.875-4.628-8.666-9.503-9.504V43.327c4.875-0.836,8.667-4.629,9.503-9.503h91.072
                        c0.871,5.029,4.92,8.911,9.984,9.575v34.373c0,1.117,0.906,2.023,2.024,2.023s2.023-0.905,2.023-2.023V41.947
                        C134.968,41.273,134.703,40.642,134.223,40.169z"/>
                </g>
            </g>
            <g>
                <g>
                    <path fill="#146DB6" d="M139.053,19.673H12.228c-3.098,0-5.618,2.521-5.618,5.618v85.606c0,3.098,2.521,5.618,5.618,5.618h84.953
                        l-3.008,6.303c-0.387,0.81-0.292,1.758,0.245,2.477c0.537,0.718,1.422,1.074,2.306,0.933l5.601-0.9l3.123,5.127
                        c0.438,0.72,1.216,1.154,2.053,1.154c0.04,0,0.081-0.002,0.122-0.004c0.883-0.045,1.667-0.567,2.048-1.365l5.427-11.372
                        l5.427,11.371c0.38,0.797,1.164,1.321,2.047,1.366c0.041,0.003,0.083,0.004,0.124,0.004c0.836,0,1.614-0.435,2.052-1.153
                        l3.124-5.127l5.6,0.9c0.888,0.142,1.77-0.216,2.307-0.935s0.631-1.667,0.244-2.475l-3.008-6.303h6.04
                        c3.098,0,5.618-2.521,5.618-5.618V25.291C144.671,22.193,142.15,19.673,139.053,19.673z M107.324,125.755l-2.118-3.477
                        c-0.511-0.838-1.466-1.278-2.435-1.123l-3.596,0.578l3.787-7.937c1.493,1.523,3.62,2.347,5.827,2.139
                        c0.755-0.072,1.512,0.131,2.13,0.57c0.204,0.146,0.416,0.273,0.63,0.395L107.324,125.755z M115.579,113.754
                        c-0.006,0-0.012,0.001-0.019,0.002c-0.307,0.045-0.619,0.045-0.926,0.001c-0.008-0.002-0.016-0.003-0.023-0.004
                        c-0.475-0.073-0.938-0.256-1.347-0.546c-1.224-0.87-2.686-1.333-4.177-1.333c-0.227,0-0.453,0.011-0.68,0.031
                        c-1.34,0.127-2.612-0.608-3.172-1.831c-0.248-0.542-0.565-1.044-0.934-1.504c-0.016-0.022-0.033-0.044-0.051-0.066
                        c-0.021-0.024-0.039-0.05-0.06-0.075c-0.024-0.026-0.048-0.053-0.073-0.079c-0.669-0.771-1.496-1.399-2.438-1.83
                        c-1.223-0.56-1.958-1.834-1.831-3.173c0.163-1.722-0.299-3.446-1.301-4.855c-0.779-1.096-0.779-2.568-0.001-3.664
                        c1.003-1.409,1.465-3.134,1.302-4.855c-0.127-1.339,0.609-2.613,1.831-3.173c1.573-0.72,2.836-1.982,3.556-3.555
                        c0.56-1.223,1.837-1.958,3.172-1.832c1.725,0.163,3.447-0.299,4.856-1.301c1.096-0.778,2.567-0.778,3.663,0
                        c1.41,1.002,3.134,1.463,4.856,1.301c1.34-0.127,2.613,0.61,3.173,1.832c0.72,1.572,1.982,2.836,3.555,3.555
                        c1.223,0.56,1.958,1.834,1.832,3.172c-0.163,1.723,0.299,3.447,1.301,4.856c0.779,1.096,0.779,2.567,0,3.663
                        c-1.002,1.41-1.464,3.135-1.301,4.856c0.126,1.338-0.609,2.613-1.832,3.173c-0.94,0.43-1.765,1.058-2.434,1.825
                        c-0.027,0.028-0.055,0.058-0.08,0.087c-0.017,0.021-0.033,0.043-0.051,0.064c-0.021,0.025-0.041,0.051-0.06,0.078
                        c-0.367,0.458-0.684,0.959-0.931,1.5c-0.56,1.223-1.835,1.959-3.173,1.831c-1.721-0.161-3.446,0.3-4.856,1.302
                        C116.519,113.498,116.056,113.681,115.579,113.754z M127.422,121.155c-0.97-0.155-1.924,0.285-2.435,1.123l-2.118,3.478
                        l-4.226-8.855c0.215-0.121,0.426-0.249,0.63-0.395c0.619-0.439,1.376-0.644,2.13-0.57c2.208,0.208,4.335-0.615,5.827-2.139
                        l3.787,7.937L127.422,121.155z M140.623,110.897c0,0.866-0.704,1.57-1.57,1.57h-7.972l-1.044-2.187
                        c0.053-0.027,0.105-0.057,0.16-0.082c2.787-1.275,4.466-4.183,4.177-7.234c-0.071-0.755,0.131-1.512,0.57-2.13
                        c1.776-2.498,1.776-5.855,0-8.354c-0.439-0.618-0.642-1.374-0.57-2.13c0.289-3.051-1.39-5.959-4.178-7.234
                        c-0.689-0.315-1.243-0.869-1.559-1.559c-1.275-2.788-4.184-4.466-7.234-4.177c-0.756,0.071-1.512-0.131-2.13-0.571
                        c-2.498-1.776-5.855-1.776-8.354,0c-0.618,0.44-1.377,0.643-2.13,0.57c-3.055-0.287-5.959,1.39-7.234,4.178
                        c-0.315,0.689-0.869,1.242-1.559,1.559c-2.788,1.275-4.466,4.183-4.178,7.234c0.071,0.755-0.131,1.512-0.57,2.13
                        c-1.775,2.498-1.775,5.855,0,8.354c0.439,0.618,0.642,1.374,0.57,2.13c-0.288,3.052,1.39,5.959,4.178,7.234
                        c0.054,0.024,0.106,0.054,0.158,0.082l-1.043,2.187H12.228c-0.866,0-1.57-0.704-1.57-1.57V25.291c0-0.866,0.705-1.57,1.57-1.57
                        h126.825c0.865,0,1.57,0.705,1.57,1.57V110.897L140.623,110.897z"/>
                </g>
            </g>
            <g>
                <g>
                    <path fill="#146DB6" d="M114.949,84.084c-6.934,0-12.575,5.641-12.575,12.574c0,6.935,5.641,12.575,12.575,12.575
                        c6.934,0,12.574-5.641,12.574-12.575C127.523,89.725,121.883,84.084,114.949,84.084z M114.949,105.186
                        c-4.702,0-8.527-3.825-8.527-8.527c0-4.701,3.825-8.527,8.527-8.527c4.701,0,8.526,3.825,8.526,8.527
                        S119.65,105.186,114.949,105.186z"/>
                </g>
            </g>
        </svg>
    );

    const allAttributes = {
        blockId: {
            type: 'string'
        },
        noOfAwards: {
            type: 'number',
            default: 1
        },
        noOfAwardsInner: {
            type: 'number',
            default: 1
        },
        title: {
            type: 'string',
            default: 'Award Name'
        },
        captionText: {
            type: 'string',
            default: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.'
        },
        showTitle: {
            type: 'boolean',
            default: false
        },
        imageAlt: {
            attribute: 'alt'
        },
        imageUrl: {
            attribute: 'src'
        },
        imageID: {
            type: 'number',
        },
        winnerName: {
            type: 'string'
        },
        jobLocation: {
            type: 'string'
        },
        details: {
            type: 'string'
        },
        showPopup: {
            type: 'boolean',
            default: false,
        },
        modelClass: {
            type: 'string'
        },
        showFilter: {
            type: 'boolean',
            default: false,
        },
    };

    const ALLOWBLOCKS = ['nab/awards-item'];


    const getChildawardsBlock = memoize((awards) => {
        return (
            times(
                awards,
                (n) => ['nab/awards-item', { id: n + 1 }]
            )
        );
    });

    const removehildawardsBlock = memoize((awards) => {
        return (
            times(
                awards,
                (n) => ['nab/awards-item', { id: n - 1 }]
            )
        );
    });

    /* Parent awards Block */
    registerBlockType('nab/awards', {
        title: __('awards'),
        description: __('awards'),
        icon: { src: awardBlockIcons},
        category: 'nabshow',
        keywords: [__('awards'), __('gutenberg'), __('nab')],
        attributes: allAttributes,
        edit: (props, attributes) => {
            const { attributes: { title, captionText, showTitle, noOfAwards, showFilter }, className, setAttributes, clientId } = props;

          jQuery(document).on('click', `#block-${clientId} .col-lg-6 .remove-item`, function (e) {
                if ('' !== jQuery(this).parents(`#block-${clientId}`)) {
                    setAttributes({ noOfAwards: noOfAwards - 1 });
                    removehildawardsBlock(noOfAwards);
                }
            });

            return (
                <Fragment>
                    <InspectorControls>
                        <PanelBody title="General Settings">
                            <PanelRow>
                                <ToggleControl
                                    label={__('Show Title of Award')}
                                    checked={showTitle}
                                    onChange={() => setAttributes({ showTitle: ! showTitle })}
                                />
                            </PanelRow>
                            <PanelRow>
                                <ToggleControl
                                    label={__('Show Filter')}
                                    checked={showFilter}
                                    onChange={() => setAttributes({ showFilter: ! showFilter })}
                                />
                            </PanelRow>
                        </PanelBody>
                    </InspectorControls>
                    {showFilter &&
                        <div className="wp-block-nab-multipurpose-gutenberg-block">
                            <div className="schedule-glance-filter awards-filtering">
                                <div className="awards-name"><label>Award Name</label>
                                    <div className="schedule-select"><select id="award-name">
                                        <option>Select an Award</option>
                                    </select></div>
                                </div>
                                <div className="search-box"><label>Winner Name</label>
                                    <div className="schedule-select"><input id="box-main-search" className="schedule-search awards-search" name="schedule-search" type="text" placeholder="Filter by name..." /></div>
                                </div>
                            </div>
                        </div>
                    }
                    <div className={`awards-main ${className}`}>
                        <Fragment>
                            <div className="awards-header">
                                {! showTitle ? (
                                    <RichText
                                        tagName="h2"
                                        onChange={(value) => setAttributes({ title: value })}
                                        placeholder={__('Title')}
                                        value={title}
                                        className="awards-winner-title"
                                    />) : ''
                                }
                                <RichText
                                    tagName="p"
                                    onChange={(value) => setAttributes({ captionText: value })}
                                    placeholder={__('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.')}
                                    value={captionText}
                                />
                            </div>
                            <div className="awards-data row">
                                <InnerBlocks
                                    template={getChildawardsBlock(noOfAwards)}
                                    templateLock="all"
                                    allowedBlocks={ALLOWBLOCKS}
                                />
                                <div className="add-remove-btn">
                                    <Button className="add" onClick={() => {
                                        setAttributes({ noOfAwards: noOfAwards + 1 });
                                    }}>
                                        <span className="dashicons dashicons-plus" />
                                    </Button>
                                </div>
                            </div>
                        </Fragment>
                    </div>
                </Fragment>
            );
        },
        save: (props) => {
            const { attributes: { title, captionText, showTitle, showFilter }, className } = props;
            return (
                <Fragment>
                    {showFilter &&
                        <div className="wp-block-nab-multipurpose-gutenberg-block">
                            <div className="schedule-glance-filter awards-filtering">
                                <div className="awards-name"><label>Award Name</label>
                                    <div className="schedule-select"><select id="award-name">
                                        <option>Select an Award</option>
                                    </select></div>
                                </div>
                                <div className="search-box"><label>Winner Name</label>
                                    <div className="schedule-select"><input id="box-main-search" className="schedule-search awards-search" name="schedule-search" type="text" placeholder="Filter by name..." /></div>
                                </div>
                            </div>
                        </div>
                    }
                    <div className={`awards-main ${className}`}>
                        <div className="awards-header">
                            {! showTitle ? (
                                <RichText.Content
                                    tagName="h2"
                                    value={title}
                                    className="awards-winner-title"
                                />) : ''
                            }
                            <RichText.Content
                                tagName="p"
                                value={captionText}
                            />
                        </div>
                        <div className="awards-data row">
                            <InnerBlocks.Content />
                        </div>
                    </div>
                </Fragment>
            );
        }
    });

    /* awards Block */
    registerBlockType('nab/awards-item', {
        title: __('awards Items'),
        description: __('awards Items'),
        icon: { src: awardBlockIcons},
        category: 'nabshow',
        parent: ['nab/awards'],
        attributes: allAttributes,
        edit: (props) => {
            const { attributes, setAttributes, clientId } = props;
            const { imageAlt, imageUrl, winnerName, jobLocation, details, imageID, modelClass, showPopup } = attributes;


            if (document.getElementById('wpwrap').classList.contains('nab_body_model_open')) {
                setAttributes({ modelClass: 'nab_model_open' });
            } else {
                setAttributes({ modelClass: '' });
            }

            function modelopen() {
                var ele = document.getElementById('wpwrap');
                ele.classList.add('nab_body_model_open');
                setAttributes({ modelClass: 'nab_model_open' });
            }
            function modelclose() {
                var ele = document.getElementById('wpwrap');
                ele.classList.remove('nab_body_model_open');
                setAttributes({ modelClass: '' });
            }
            return (
                <Fragment>
                    <InspectorControls>
                        <PanelBody title="Popup Settings" initialOpen={true}>
                            <PanelRow>
                                <ToggleControl
                                    label={__('Show Popup')}
                                    checked={showPopup}
                                    onChange={() => setAttributes({ showPopup: ! showPopup })}
                                />
                            </PanelRow>
                        </PanelBody>
                    </InspectorControls>
                    <div className='col-lg-6 col-md-6 col-sm-12'>
                        <span className="remove-item">
                            <IconButton
                                className="components-toolbar__control"
                                label={__('Remove image')}
                                icon="no"
                                onClick={() => {
                                    wp.data.dispatch('core/editor').removeBlocks(clientId);
                                }}
                            />
                        </span>
                        <div className='awards-row'>
                            <div className="winnerSide">
                                <div className="winnerImage">
                                    {! imageID &&
                                        <MediaUpload
                                            allowedTypes={['image']}
                                            value={imageID}
                                            onSelect={(image) => setAttributes({ imageAlt: image.alt, imageUrl: image.url, imageID: image.id })}
                                            render={({ open }) => (
                                                <Button
                                                    className="button button-large"
                                                    onClick={open}
                                                >
                                                    {__('Choose image')}
                                                </Button>
                                            )}
                                        />
                                    }
                                    {imageID && (
                                        <Fragment>
                                            <BlockControls>
                                                <Toolbar>
                                                    <MediaUpload
                                                        allowedTypes={['image']}
                                                        value={imageID}
                                                        onSelect={(image) => setAttributes({ imageAlt: image.alt, imageUrl: image.url, imageID: image.id })}
                                                        render={({ open }) => (
                                                            <IconButton
                                                                className="components-toolbar__control"
                                                                label={__('Change image')}
                                                                icon="edit"
                                                                onClick={open}
                                                            />
                                                        )}
                                                    />
                                                    <IconButton
                                                        className="components-toolbar__control"
                                                        label={__('Remove image')}
                                                        icon="no"
                                                        onClick={() => setAttributes({ imageUrl: undefined, imageID: undefined })}
                                                    />
                                                </Toolbar>
                                            </BlockControls>

                                            <img src={imageUrl} alt={imageAlt} />
                                        </Fragment>
                                    )}
                                </div>
                                <div className="winnerName">
                                    <RichText
                                        tagName="h3"
                                        onChange={(value) => setAttributes({ winnerName: value })}
                                        value={winnerName}
                                        placeholder="Winner Name"
                                    />
                                </div>
                                <div className="jobLocation">
                                    <RichText
                                        tagName="p"
                                        onChange={(value) => setAttributes({ jobLocation: value })}
                                        value={jobLocation}
                                        placeholder={__('Job Title/Company/Location')}
                                    />
                                </div>
                            </div>
                            <div className="details">
                                <RichText
                                    tagName="p"
                                    onChange={(value) => setAttributes({ details: value })}
                                    value={details}
                                    placeholder={__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. In viverra et eros nec ultricies. Etiam tincidunt diam orci, sit amet lacinia tellus rhoncus sed.')}
                                />
                                {showPopup ?
                                    <div className="nab_model_head">
                                        <input type="button" onClick={modelopen} className={'nab_popup_btn btn-primary'} value='Learn More' />
                                        <div className={`nab_model_main ${modelClass}`}>
                                            <div className="nab_model_inner">
                                                <div className="nab_close_btn" onClick={modelclose}><svg width="30" height="30" viewBox="0 0 30 30" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" className="feather feather-x"><line x1="20" y1="10" x2="10" y2="20"></line><line x1="10" y1="10" x2="20" y2="20"></line></svg></div>
                                                <div className="nab_model_wrap">
                                                    <div className="nab_pop_up_content_wrap">
                                                        <InnerBlocks templateLock={false} />
                                                    </div>
                                                </div>
                                            </div>
                                            <div className="nab_bg_overlay" onClick={modelclose} />
                                        </div>
                                    </div> : ''
                                }
                            </div>
                        </div>
                    </div>
                </Fragment>
            );
        },
        save: (props) => {
            const { attributes } = props;
            const { imageAlt, imageUrl, winnerName, jobLocation, details, showPopup } = attributes;
            return (
                <div className='col-lg-6 col-md-6 col-sm-12'>
                    <div className='awards-row'>
                        <div className="winnerSide">
                            <div className="winnerImage">
                                <img src={imageUrl} alt={imageAlt} />
                            </div>
                            <div className="winnerName">
                                <RichText.Content
                                    tagName="h3"
                                    value={winnerName === undefined ? '-' : winnerName}
                                />
                            </div>
                            <div className="jobLocation">
                                <RichText.Content
                                    tagName="p"
                                    value={jobLocation === undefined ? '-' : jobLocation}
                                />
                            </div>
                        </div>
                        <div className="details">
                            <RichText.Content
                                tagName="p"
                                value={details === undefined ? '-' : details}
                            />
                            {showPopup ?
                                <div className="nab_model_head">
                                    <input type="button" className={'nab_popup_btn btn-primary'} value='Learn More' />
                                    <div className="nab_model_main">
                                        <div className="nab_model_inner">
                                            <div className="nab_close_btn"><svg width="30" height="30" viewBox="0 0 30 30" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" className="feather feather-x"><line x1="20" y1="10" x2="10" y2="20"></line><line x1="10" y1="10" x2="20" y2="20"></line></svg></div>
                                            <div className="nab_model_wrap">
                                                <div className="nab_pop_up_content_wrap">
                                                    <InnerBlocks.Content />
                                                </div>
                                            </div>
                                        </div>
                                        <div className="nab_bg_overlay" />
                                    </div>
                                </div> : ''
                            }
                        </div>
                    </div>
                </div>
            );
        }
    });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);

