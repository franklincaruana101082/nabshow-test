import times from 'lodash/times';
import memoize from 'memize';

var allowedBlocks = [
    'nab/nab-heading',
];

(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
    const { __ } = wp.i18n;
    const { registerBlockType } = wp.blocks;
    const { Fragment, Component } = wp.element;
    const { RichText, MediaUpload, AlignmentToolbar, BlockControls, InspectorControls, PanelColorSettings, InnerBlocks } = wp.editor;
    const { TextControl, PanelBody, PanelRow, RangeControl, SelectControl, ToggleControl, Button, Toolbar, IconButton } = wp.components;

    /* Parent awards Block */
    registerBlockType('nab/awards', {
        title: __('awards'),
        description: __('awards'),
        icon: 'welcome-learn-more',
        category: 'nabshow',
        keywords: [__('awards'), __('gutenberg'), __('nab')],
        attributes: {
            blockId: {
                type: 'string'
            },
            noOfAwards: {
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
            }
        },
        edit: (props, attributes) => {
            const { attributes: { title, captionText, noOfAwards }, className, setAttributes, clientId } = props;

            const ALLOWBLOCKS = ['nab/awards-item'];

            const getChildawardsBlock = memoize((awards) => {
                return (
                    times(awards, (n) => ['nab/awards-item', { id: n + 1 }])
                );
            });

            return (
                <div className={`awards-main ${className}`}>
                    <InspectorControls>
                        <PanelBody title="General Settings">
                            <PanelRow>

                            </PanelRow>
                        </PanelBody>
                    </InspectorControls>
                    <Fragment>
                        <div className="awards-header">
                            <RichText
                                tagName="h2"
                                onChange={(value) => setAttributes({ title: value })}
                                placeholder={__('Title')}
                                value={title}
                            />
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
                                <Button className="add" onClick={() => setAttributes({ noOfAwards: noOfAwards + 1 })}>
                                    <span className="dashicons dashicons-plus" />
                                </Button>
                                <Button
                                    className="remove"
                                    onClick={() =>
                                        setAttributes({
                                            noOfAwards: 1 === noOfAwards ? 1 : noOfAwards - 1
                                        })}
                                >
                                    <span className="dashicons dashicons-minus" />
                                </Button>
                            </div>
                        </div>
                    </Fragment>
                </div>
            );
        },
        save: (props) => {
            const { attributes: { title, captionText }, className } = props;
            return (
                <div className={`awards-main ${className}`}>
                    <div className="awards-header">
                        <RichText.Content
                            tagName="h2"
                            value={title}
                        />
                        <RichText.Content
                            tagName="p"
                            value={captionText}
                        />
                    </div>
                    <div className="awards-data row">
                        <InnerBlocks.Content />
                    </div>
                </div>
            );
        }
    });

    /* awards Block */
    registerBlockType('nab/awards-item', {
        title: __('awards Items'),
        description: __('awards Items'),
        icon: 'welcome-learn-more',
        category: 'nabshow',
        parent: ['nab/awards'],
        attributes: {
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
                type: 'string',
                source: 'html',
                selector: 'a',
                default: 'Winner Name'
            },
            Link: {
                type: 'string',
                default: '#'
            },
            newWindow: {
                type: 'boolean',
                default: false,
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
            }
        },
        edit: (props) => {
            const { attributes, setAttributes, className } = props;
            const { imageAlt, imageUrl, winnerName, Link, newWindow, jobLocation, details, imageID, modelClass, showPopup } = attributes;


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
                        <PanelBody title="Link" initialOpen={true}>
                            <PanelRow>
                                <TextControl
                                    type="text"
                                    min="1"
                                    placeholder="https:"
                                    value={Link}
                                    onChange={Link => setAttributes({ Link: Link })}
                                />
                            </PanelRow>
                            <PanelRow>
                                <ToggleControl
                                    label={__('Open in New Window')}
                                    checked={newWindow}
                                    onChange={() => setAttributes({ newWindow: ! newWindow })}
                                />
                            </PanelRow>
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

                                    {/* {imageUrl && <img src={imageUrl} alt={imageAlt} />} */}

                                </div>
                                <div className="winnerName">
                                    <RichText
                                        tagName="a"
                                        onChange={(value) => setAttributes({ winnerName: value })}
                                        formattingControls={['bold', 'italic']}
                                        value={winnerName}
                                        rel='noopener noreferrer'
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
                                        <input type="button" onClick={modelopen} className={'nab_popup_btn btn-primary'} value='Click Here' />
                                        <div className={`nab_model_main ${modelClass}`}>
                                            <div className="nab_model_inner">
                                                <div className="nab_close_btn" onClick={modelclose}>×</div>
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
            const { attributes, className } = props;
            const { imageAlt, imageUrl, winnerName, Link, newWindow, jobLocation, details, showPopup } = attributes;
            return (
                <div className='col-lg-6 col-md-6 col-sm-12'>
                    <div className='awards-row'>
                        <div className="winnerSide">
                            <div className="winnerImage">
                                <img src={imageUrl} alt={imageAlt} />
                            </div>
                            <div className="winnerName">
                                <RichText.Content
                                    tagName="a"
                                    href={Link}
                                    target={newWindow ? '_blank' : '_self'}
                                    rel='noopener noreferrer'
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
                                    <input type="button" className={'nab_popup_btn btn-primary'} value='Click Here' />
                                    <div className="nab_model_main">
                                        <div className="nab_model_inner">
                                            <div className="nab_close_btn">×</div>
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

