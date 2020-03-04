import pick from 'lodash/pick';
(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
  const { __ } = wpI18n;
  const { Component, Fragment } = wpElement;
  const { registerBlockType } = wpBlocks;

  // const { InspectorControls, MediaUpload} = wpEditor;
  // const { PanelBody, PanelRow, BlockControls, SelectControl, IconButton, ToggleControl, TextControl, Button, Toolbar, Placeholder } = wpComponents;
  const { InspectorControls, PanelColorSettings, MediaUpload, RichText, BlockControls } = wpEditor;
  const { TextControl, Panel, PanelBody, PanelRow, Button, ToggleControl } = wpComponents;

  const adUploadIcon = (
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="2 2 22 22" className="dashicon">
      <path fill="none" d="M0 0h24v24H0V0z" />
      <path d="M20 4h-3.17L15 2H9L7.17 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zM9.88 4h4.24l1.83 2H20v12H4V6h4.05" />
      <path d="M15 11H9V8.5L5.5 12 9 15.5V13h6v2.5l3.5-3.5L15 8.5z" />
    </svg>
  );

  const adBlockIcon = (
    <svg width="150px" height="150px" viewBox="0 0 150 150" enable-background="new 0 0 150 150">
      <g>
        <g>
          <g>
            <path fill="#146DB6" d="M133.758,4.449H16.676c-7.175,0-13.009,5.834-13.009,13.009v117.083c0,7.175,5.834,13.009,13.009,13.009
                            h117.082c7.176,0,13.011-5.834,13.011-13.009V17.458C146.768,10.283,140.934,4.449,133.758,4.449z M140.263,134.541
                            c0,3.585-2.919,6.506-6.505,6.506H16.676c-3.586,0-6.505-2.921-6.505-6.506V36.972h130.092V134.541L140.263,134.541z
                            M140.263,30.467H10.171V17.458c0-3.586,2.918-6.504,6.505-6.504h117.082c3.586,0,6.505,2.918,6.505,6.504V30.467L140.263,30.467
                            z"/>
            <circle fill="#146DB6" cx="19.928" cy="20.71" r="3.252"/>
            <circle fill="#146DB6" cx="32.938" cy="20.71" r="3.252"/>
            <circle fill="#146DB6" cx="45.946" cy="20.71" r="3.252"/>
            <path fill="#146DB6" d="M26.433,108.521h65.045c1.798,0,3.252-1.454,3.252-3.252V53.234c0-1.798-1.455-3.253-3.252-3.253H26.433
                            c-1.798,0-3.253,1.455-3.253,3.253v52.036C23.18,107.067,24.635,108.521,26.433,108.521z M29.685,56.485h58.541v45.533H29.685
                            V56.485z"/>
            <path fill="#146DB6" d="M45.946,62.99c-5.379,0-9.756,4.377-9.756,9.756v19.515c0,1.797,1.455,3.252,3.253,3.252
                            c1.797,0,3.252-1.455,3.252-3.252V89.01h6.504v3.251c0,1.797,1.455,3.252,3.253,3.252c1.797,0,3.251-1.455,3.251-3.252V72.746
                            C55.704,67.367,51.327,62.99,45.946,62.99z M49.199,82.503h-6.505v-9.757c0-1.794,1.458-3.251,3.252-3.251
                            c1.795,0,3.253,1.458,3.253,3.251V82.503L49.199,82.503z"/>
            <path fill="#146DB6" d="M71.964,62.99H65.46c-1.797,0-3.252,1.455-3.252,3.253v26.018c0,1.797,1.455,3.252,3.252,3.252h6.504
                            c5.381,0,9.757-4.377,9.757-9.755V72.746C81.722,67.367,77.346,62.99,71.964,62.99z M75.217,85.758
                            c0,1.792-1.458,3.252-3.253,3.252h-3.251V69.495h3.251c1.795,0,3.253,1.458,3.253,3.251V85.758L75.217,85.758z"/>
            <path fill="#146DB6" d="M26.433,128.037h97.569c1.797,0,3.251-1.454,3.251-3.254c0-1.797-1.454-3.252-3.251-3.252H26.433
                            c-1.798,0-3.253,1.455-3.253,3.254C23.18,126.583,24.635,128.037,26.433,128.037z"/>
            <path fill="#146DB6" d="M104.487,69.495h19.515c1.799,0,3.253-1.455,3.253-3.251c0-1.798-1.456-3.253-3.253-3.253h-19.515
                            c-1.798,0-3.251,1.456-3.251,3.253C101.236,68.04,102.689,69.495,104.487,69.495z"/>
            <path fill="#146DB6" d="M104.487,89.01h19.515c1.799,0,3.253-1.455,3.253-3.252c0-1.8-1.456-3.255-3.253-3.255h-19.515
                            c-1.798,0-3.251,1.457-3.251,3.255C101.236,87.555,102.689,89.01,104.487,89.01z"/>
            <path fill="#146DB6" d="M104.487,108.521h19.515c1.799,0,3.253-1.454,3.253-3.252c0-1.797-1.456-3.251-3.253-3.251h-19.515
                            c-1.798,0-3.251,1.454-3.251,3.251C101.236,107.067,102.689,108.521,104.487,108.521z"/>
          </g>
        </g>
      </g>
    </svg>
  );

  const nabIsImage = (sourceURL) => {
    const imageExtension = ['jpg', 'jpeg', 'png', 'gif', 'PNG', 'JPG', 'JPEG', 'GIF'];
    const fileExtension = sourceURL.split('.').pop();
    if (-1 < imageExtension.indexOf(fileExtension)) {
      return true;
    } else {
      return false;
    }
  };


  class NabAdvertisement extends Component {
    constructor() {
      super(...arguments);
    }

    render() {
      const { attributes, setAttributes, className } = this.props;
      const { imageAlt, imageUrl, imgLink, imgTarget, activeBlock, eventCategory, eventAction, eventLabel, displayOnMobile } = attributes;

      const getImageButton = (openEvent) => {
        if (imageUrl) {
          return (
            <div className={`nab-interadv-block img-link ${true=== displayOnMobile ? ' showonMobile' : ''}`}>
              <img src={imageUrl} alr={imageAlt} className="image" />
              {imgLink && (
                <a className="nab-media-slider-link"
                  target="_blank"
                  rel="noopener noreferrer"
                  href={imgLink}
                />
              )}
              <div className="nab-media-slider-controls featured-boxes-details">
                <div className="advertisement-btn">
                  <div className="right">
                    <ToggleControl
                      label={__('Open in New Tab')}
                      checked={imgTarget ? imgTarget || '' : ''}
                      onChange={() => {
                        let check = imgTarget === undefined ? false : ! imgTarget;
                        setAttributes({ imgTarget: check });
                      }}
                    />
                  </div>
                </div>
                <div className="featured-boxes-link">
                  <TextControl
                    label={__('Link URL')}
                    placeholder="https://"
                    value={imgLink ? imgLink || '' : ''}
                    onChange={(value) => setAttributes({ imgLink: value })}
                  />
                </div>
                  <Fragment>
                    {nabIsImage(imageUrl) && (
                      <Fragment>
                        <div className="nab-controls-wrapper">
                          <strong>Google Event</strong>
                          <div className="nab-media-slider-control">
                            <TextControl
                              label={__('Event Category')}
                              placeholder="Enter Category"
                              value={eventCategory ? eventCategory || '' : ''}
                              onChange={(value) => setAttributes({ eventCategory: value })}
                            />
                          </div>
                          <div className="nab-media-slider-control">
                            <TextControl
                              label={__('Event Action')}
                              placeholder="Enter Action"
                              value={eventAction ? eventAction || '' : ''}
                              onChange={(value) => setAttributes({ eventAction: value })}
                            />
                          </div>
                          <div className="nab-media-slider-control">
                            <TextControl
                              label={__('Event Label')}
                              placeholder="Enter Label"
                              value={eventLabel ? eventLabel || '' : ''}
                              onChange={(value) => setAttributes({ eventLabel: value })}
                            />
                          </div>
                        </div>
                      </Fragment>
                    )}
                  </Fragment>
              </div>

            </div>
          );
        } else {
          return (
            <div className="button-container">
              <div className="interad-pick-image">
                <strong>Advertisement</strong>
                <p className="caption">No image selected. Add image to start using this block.</p>
                <Button onClick={openEvent} className="button button-large">Choose image</Button>
              </div>
            </div>
          );
        }
      };

      return (
        <div className="interad-block">
          <BlockControls>
            <div className="interad-img del-img">
              <span
                onClick={(value) => setAttributes({ imageUrl: '', imageAlt: '', InsertUrl: '' })}
                className="dashicons dashicons-trash"
              />
            </div>
            <div className="interad-img edit-img">
              <MediaUpload
                onSelect={(media) => {
                  setAttributes({ imageAlt: media.alt, imageUrl: media.url });
                }}
                type="image"
                value={attributes.imageID}
                render={({ open }) => (
                  <span class="dashicons dashicons-edit edit-item" onClick={open} />
                )}
              />
            </div>
          </BlockControls>
          <MediaUpload
            onSelect={(media) => {
              setAttributes({ imageAlt: media.alt, imageUrl: media.url });
            }}
            type="image"
            value={attributes.imageID}
            render={({ open }) => getImageButton(open)}
          />
          <InspectorControls>
            <div className="interad-clear-none">
              <PanelBody title="Block Setting" initialOpen={true}>
                <PanelRow>
                  <ToggleControl
                    label={__('Activate Block')}
                    checked={activeBlock ? activeBlock || '' : ''}
                    onChange={() => {
                      let check = activeBlock === undefined ? false : ! activeBlock;
                      setAttributes({ activeBlock: check });
                    }}
                  />
                </PanelRow>
                <PanelRow>
                  <ToggleControl
                    label={__('Display On Mobile')}
                    checked={displayOnMobile ? displayOnMobile || '' : ''}
                    onChange={() => {
                      let check = displayOnMobile === undefined ? false : ! displayOnMobile;
                      setAttributes({ displayOnMobile: check });
                    }}
                  />
                </PanelRow>
              </PanelBody>
            </div>
          </InspectorControls>
        </div>
      );

    }
  }

  const allAttr = {
    imageAlt: {
      attribute: 'alt'
    },
    imageUrl: {
      attribute: 'src'
    },
    imgLink: {
      type: 'string',
      default: ''
    },
    imgTarget: {
      type: 'boolean',
      default: false
    },
    activeBlock: {
      type: 'boolean',
      default: true
    },
    eventCategory: {
      type: 'string',
      default: ''
    },
    eventAction: {
      type: 'string',
      default: ''
    },
    eventLabel: {
      type: 'string',
      default: ''
    },
    displayOnMobile: {
      type: 'boolean',
      default: false
    },
  };


  registerBlockType('nab/interstitial-ad', {
    title: __('Interstitial Ad'),
    icon: { src: adBlockIcon},
    category: 'nabshow',
    keywords: [__('ad'), __('advertisement')],
    attributes: allAttr,
    edit: NabAdvertisement,
    save(props) {
      const { attributes: { imageAlt, imageUrl, imgLink, imgTarget, activeBlock, eventCategory, eventAction, eventLabel, displayOnMobile }, className } = props;
      return (
        <Fragment>
          {activeBlock &&
            <div className={`nab_model_main nab-interadv-block img-link ${true=== displayOnMobile ? 'showonMobile' : ''}`} style={{display: 'none'}}>
              <div className="nab_model_inner">
                <div className="nab_close_btn">
                  <svg width="30" height="30" viewBox="0 0 30 30" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" className="feather feather-x"><line x1="20" y1="10" x2="10" y2="20"></line><line x1="10" y1="10" x2="20" y2="20"></line></svg>
                </div>
                <div className="nab_model_wrap">
                  <div className="nab_pop_up_content_wrap">
                    {imgLink ?
                      <a
                        className="nab-interad-link"
                        rel="noopener noreferrer"
                        href={imgLink}
                        target={imgTarget ? '_blank' : '_self'}
                        data-category={eventCategory && (eventCategory)}
                        data-action={eventAction && (eventAction)}
                        data-label={eventLabel && (eventLabel)}
                        >
                        <img src={imageUrl} alr={imageAlt} className="image" />
                      </a> :
                      <img src={imageUrl} alr={imageAlt} className="image" />
                    }
                  </div>
                </div>
              </div>
            <div className="nab_bg_overlay" />
          </div>
        }
        </Fragment>
      );
    },
  });

})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);
