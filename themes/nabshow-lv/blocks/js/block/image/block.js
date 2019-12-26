(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
  const { __ } = wpI18n;
  const { registerBlockType } = wpBlocks;
  const { InspectorControls, MediaUpload, BlockControls } = wpEditor;
  const { TextControl, PanelBody, PanelRow, Button, RangeControl, ColorPalette, ToggleControl } = wpComponents;

  const imageBlockIcon = (
    <svg width="150px" height="150px" viewBox="222.64 222.641 150 150" enable-background="new 222.64 222.641 150 150">
      <g>
        <g>
          <path fill="#0F6CB6" d="M359.307,241.852H235.973c-3.293,0-5.973,2.679-5.973,5.972v99.631c0,3.294,2.679,5.973,5.972,5.973
            h123.334c3.294,0,5.973-2.679,5.973-5.973v-99.631C365.279,244.531,362.601,241.852,359.307,241.852z M359.307,347.455
            l-123.334,0.005c0,0,0-0.002,0-0.005v-99.631h123.334V347.455z"/>
        </g>
      </g>
      <g>
        <g>
          <path fill="#0F6CB6" d="M348.099,256.047H247.181c-1.649,0-2.986,1.337-2.986,2.986v66.002c0,1.648,1.337,2.985,2.986,2.985
            h100.918c1.648,0,2.986-1.337,2.986-2.986v-66.001C351.085,257.384,349.748,256.047,348.099,256.047z M250.167,262.019h94.946
            v50.554l-18.82-18.818c-1.165-1.166-3.056-1.166-4.223,0l-11.473,11.472l-26.305-26.305c-1.166-1.165-3.057-1.166-4.223,0
            l-29.901,29.899L250.167,262.019L250.167,262.019z M250.167,322.048v-4.781l32.013-32.01l36.791,36.791H250.167L250.167,322.048z
            M345.112,322.048h-17.695l0,0l-12.597-12.597l9.361-9.361l20.244,20.242c0.209,0.208,0.44,0.378,0.687,0.512V322.048
            L345.112,322.048z"/>
        </g>
      </g>
      <g>
        <g>
          <path fill="#0F6CB6" d="M310.413,267.686c-6.225,0-11.29,5.064-11.29,11.29c0,6.226,5.065,11.29,11.29,11.29
            c6.226,0,11.29-5.064,11.29-11.29C321.703,272.75,316.638,267.686,310.413,267.686z M310.413,284.292
            c-2.932,0-5.317-2.385-5.317-5.317c0-2.932,2.386-5.317,5.317-5.317s5.317,2.385,5.317,5.317
            C315.73,281.907,313.345,284.292,310.413,284.292z"/>
        </g>
      </g>
      <g>
        <g>
          <path fill="#0F6CB6" d="M273.155,334.752h-25.975c-1.649,0-2.986,1.337-2.986,2.985c0,1.649,1.337,2.986,2.986,2.986h25.975
            c1.649,0,2.986-1.337,2.986-2.986C276.141,336.089,274.805,334.752,273.155,334.752z"/>
        </g>
      </g>
      <g>
        <g>
          <path fill="#0F6CB6" d="M293.594,334.752h-6.813c-1.649,0-2.987,1.337-2.987,2.985c0,1.649,1.338,2.986,2.987,2.986h6.813
            c1.649,0,2.986-1.337,2.986-2.986C296.581,336.089,295.243,334.752,293.594,334.752z"/>
        </g>
      </g>
    </svg>
  );

  registerBlockType('nab/custom-image', {
    title: __('NABShow - Image'),
    icon: { src: imageBlockIcon },
    description: __('Nab Image is a gutenberg block which used to insert image.'),
    category: 'nabshow',
    keywords: [__('Image'), __('gutenberg')],
    attributes: {
      imageAlt: {
        attribute: 'alt'
      },
      imageUrl: {
        attribute: 'src'
      },
      ImageWidth: {
        type: 'string',
        default: ''
      },
      ImageHeight: {
        type: 'string',
        default: ''
      },
      ImageMaxWidth: {
        type: 'number',
        default: 100
      },
      BorderSize: {
        type: 'number',
        default: 0
      },
      BorderType: {
        type: 'string',
        default: 'solid'
      },
      BorderRadius: {
        type: 'number',
        default: 0
      },
      BorderColor: {
        type: 'string',
        default: '#000'
      },
      marginTop: {
        type: 'string',
        default: '0'
      },
      marginRight: {
        type: 'string',
        default: '0'
      },
      marginBottom: {
        type: 'string',
        default: '0'
      },
      marginLeft: {
        type: 'string',
        default: '0'
      },
      paddingTop: {
        type: 'string',
        default: '0'
      },
      paddingRight: {
        type: 'string',
        default: '0'
      },
      paddingBottom: {
        type: 'string',
        default: '0'
      },
      paddingLeft: {
        type: 'string',
        default: '0'
      },
      InsertUrl: {
        type: 'string',
        default: ''
      },
      ImgAlignment: {
        type: 'string',
        default: 'Left'
      },
      imgLink: {
        type: 'string'
      },
      newWindow: {
        type: 'boolean',
        default: false,
      }
    },
    edit({ attributes, setAttributes }) {
      const {
        imageAlt,
        ImageWidth,
        ImageHeight,
        BorderSize,
        BorderType,
        BorderRadius,
        BorderColor,
        marginTop,
        marginRight,
        marginBottom,
        marginLeft,
        paddingTop,
        paddingRight,
        paddingBottom,
        paddingLeft,
        InsertUrl,
        ImgAlignment,
        imgLink,
        newWindow,
        ImageMaxWidth
      } = attributes;

      const ImageStyle = {};
      ImageWidth && (ImageStyle.width = `${ImageWidth}px`);
      ImageHeight && (ImageStyle.height = `${ImageHeight}px`);
      ImageMaxWidth && (ImageStyle.maxWidth = `${ImageMaxWidth}%`);
      marginTop && (ImageStyle.marginTop = `${marginTop}px`);
      marginBottom && (ImageStyle.marginBottom = `${marginBottom}px`);
      marginLeft && (ImageStyle.marginLeft = `${marginLeft}px`);
      marginRight && (ImageStyle.marginRight = `${marginRight}px`);
      paddingTop && (ImageStyle.paddingTop = `${paddingTop}px`);
      paddingBottom && (ImageStyle.paddingBottom = `${paddingBottom}px`);
      paddingLeft && (ImageStyle.paddingLeft = `${paddingLeft}px`);
      paddingRight && (ImageStyle.paddingRight = `${paddingRight}px`);
      BorderSize && (ImageStyle.border = `${BorderSize}px ${BorderType} ${BorderColor}`);
      BorderRadius && (ImageStyle.borderRadius = `${BorderRadius}%`);

      const mainStyle = {};
      ImgAlignment && (mainStyle.textAlign = ImgAlignment);

      const getImageButton = (openEvent) => {
        if (attributes.imageUrl) {
          return (
            <div className="nab-image" style={mainStyle}>
              <img style={ImageStyle} src={attributes.imageUrl} alr={imageAlt} className="image" />
            </div>
          );
        } else {
          return (
            <div className="button-container">
              <label>Image</label>
              <Button onClick={openEvent} className="button button-large">
                Pick an image
							</Button>
              <div className="nab-insert-url">
                <form>
                  <TextControl
                    type="text"
                    value={InsertUrl}
                    placeholder="https://"
                    onChange={(value) => setAttributes({ InsertUrl: value })}
                  />
                  <Button onClick={InsertUrlFunc} className="button button-large">
                    Insert URL
									</Button>
                </form>
              </div>
            </div>
          );
        }
      };

      const InsertUrlFunc = () => {
        return setAttributes({ imageUrl: InsertUrl });
      };

      return (
        <div>
          <BlockControls>
            <div className="delete-brick-img">
              <span
                onClick={(value) => setAttributes({ imageUrl: '', imageAlt: '', InsertUrl: '' })}
                className="dashicons dashicons-trash"
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
            <PanelBody title="Dimensions" initialOpen={true}>
              <PanelRow>
                <div className="inspector-field inspector-image-width" >
                  <label>Width (in px)</label>
                  <RangeControl
                    value={ImageWidth}
                    min={1}
                    max={1920}
                    onChange={ImageWidth => setAttributes({ ImageWidth: ImageWidth })}
                  />
                </div>
              </PanelRow>
              <PanelRow>
                <div className="inspector-field inspector-image-height" >
                  <label>Height (in px)</label>
                  <RangeControl
                    value={ImageHeight}
                    min={1}
                    max={1920}
                    onChange={ImageHeight => setAttributes({ ImageHeight: ImageHeight })}
                  />
                </div>
              </PanelRow>
              <PanelRow>
                <div className="inspector-field inspector-image-width" >
                  <label>Max Width (in %)</label>
                  <RangeControl
                    value={ImageMaxWidth}
                    min={1}
                    max={100}
                    onChange={ImageMaxWidth => setAttributes({ ImageMaxWidth: ImageMaxWidth })}
                  />
                </div>
              </PanelRow>
              <PanelRow>
                <div className="inspector-field-alignment inspector-field inspector-responsive">
                  <label>Image Alignment</label>
                  <div className="inspector-field-button-list inspector-field-button-list-fluid">
                    <button className={'left' === ImgAlignment ? 'active inspector-button' : ' inspector-button'} onClick={() => setAttributes({ ImgAlignment: 'left' })} >
                      <svg width="21" height="18" viewBox="0 0 21 18" xmlns="http://www.w3.org/2000/svg">
                        <g transform="translate(-29 -4) translate(29 4)" fill="none">
                          <path d="M1 .708v15.851" className="inspector-svg-stroke" stroke-linecap="square"></path>
                          <rect className="inspector-svg-fill" x="5" y="5" width="16" height="7" rx="1"></rect>
                        </g>
                      </svg>
                    </button>
                    <button className={'center' === ImgAlignment ? 'active inspector-button' : ' inspector-button'} onClick={() => setAttributes({ ImgAlignment: 'center' })} >
                      <svg width="16" height="18" viewBox="0 0 16 18" xmlns="http://www.w3.org/2000/svg">
                        <g transform="translate(-115 -4) translate(115 4)" fill="none">
                          <path d="M8 .708v15.851" className="inspector-svg-stroke" stroke-linecap="square"></path>
                          <rect className="inspector-svg-fill" y="5" width="16" height="7" rx="1"></rect>
                        </g>
                      </svg>
                    </button>
                    <button className={'Right' === ImgAlignment ? 'active inspector-button' : ' inspector-button'} onClick={() => setAttributes({ ImgAlignment: 'Right' })} >
                      <svg width="21" height="18" viewBox="0 0 21 18" xmlns="http://www.w3.org/2000/svg">
                        <g transform="translate(0 1) rotate(-180 10.5 8.5)" fill="none">
                          <path d="M1 .708v15.851" className="inspector-svg-stroke" stroke-linecap="square"></path>
                          <rect className="inspector-svg-fill" fill-rule="nonzero" x="5" y="5" width="16" height="7" rx="1"></rect>
                        </g>
                      </svg>
                    </button>
                  </div>
                </div>
              </PanelRow>
            </PanelBody>
            <PanelBody title="Design" initialOpen={false}>
              <PanelRow>
                <div className="inspector-field inspector-border-style" >
                  <label>Border Style</label>
                  <div className="inspector-field-button-list inspector-field-button-list-fluid">
                    <button className={'solid' === BorderType ? 'active inspector-button' : ' inspector-button'} onClick={() => setAttributes({ BorderType: 'solid' })}><span className="inspector-field-border-type inspector-field-border-type-solid"></span></button>
                    <button className={'dotted' === BorderType ? 'active inspector-button' : ' inspector-button'} onClick={() => setAttributes({ BorderType: 'dotted' })}><span className="inspector-field-border-type inspector-field-border-type-dotted"></span></button>
                    <button className={'dashed' === BorderType ? 'active inspector-button' : ' inspector-button'} onClick={() => setAttributes({ BorderType: 'dashed' })}><span className="inspector-field-border-type inspector-field-border-type-dashed"></span></button>
                    <button className={'double' === BorderType ? 'active inspector-button' : ' inspector-button'} onClick={() => setAttributes({ BorderType: 'double' })}><span className="inspector-field-border-type inspector-field-border-type-double"></span></button>
                    <button className={'none' === BorderType ? 'active inspector-button' : ' inspector-button'} onClick={() => setAttributes({ BorderType: 'none' })}><i className="fa fa-ban"></i></button>
                  </div>
                </div>
              </PanelRow>
              <PanelRow>
                <div className="inspector-field inspector-border-width" >
                  <label>Border Width</label>
                  <RangeControl
                    value={BorderSize}
                    min={1}
                    onChange={BorderSize => setAttributes({ BorderSize: BorderSize })}
                  />
                </div>
              </PanelRow>
              <PanelRow>
                <div className="inspector-field inspector-border-radius" >
                  <label>Border radius</label>
                  <RangeControl
                    value={BorderRadius}
                    min={1}
                    onChange={BorderRadius => setAttributes({ BorderRadius: BorderRadius })}
                  />
                </div>
              </PanelRow>
              <PanelRow>
                <div className="inspector-field inspector-field-color ">
                  <label className="inspector-mb-0">Color</label>
                  <div className="inspector-ml-auto">
                    <ColorPalette
                      value={BorderColor}
                      onChange={BorderColor => setAttributes({ BorderColor: BorderColor })}
                    />
                  </div>
                </div>
              </PanelRow>
            </PanelBody>
            <PanelBody title="Spacing" initialOpen={false}>
              <PanelRow>
                <div className="inspector-field inspector-field-padding">
                  <label className="mt10">Padding</label>
                  <div className="padding-setting">
                    <div className="col-main-4">
                      <div className="padd-top col-main-inner" data-tooltip="padding Top">
                        <TextControl
                          type="number"
                          min="1"
                          value={paddingTop}
                          onChange={(value) => setAttributes({ paddingTop: value })}
                        />
                        <label>Top</label>
                      </div>
                      <div className="padd-buttom col-main-inner" data-tooltip="padding Bottom">
                        <TextControl
                          type="number"
                          min="1"
                          value={paddingBottom}
                          onChange={(value) => setAttributes({ paddingBottom: value })}
                        />
                        <label>Bottom</label>
                      </div>
                      <div className="padd-left col-main-inner" data-tooltip="padding Left">
                        <TextControl
                          type="number"
                          min="1"
                          value={paddingLeft}
                          onChange={(value) => setAttributes({ paddingLeft: value })}
                        />
                        <label>Left</label>
                      </div>
                      <div className="padd-right col-main-inner" data-tooltip="padding Right">
                        <TextControl
                          type="number"
                          min="1"
                          value={paddingRight}
                          onChange={(value) => setAttributes({ paddingRight: value })}
                        />
                        <label>Right</label>
                      </div>
                    </div>
                  </div>
                </div>
              </PanelRow>
              <PanelRow>
                <div className="inspector-field inspector-field-margin">
                  <label className="mt10">Margin</label>
                  <div className="margin-setting">
                    <div className="col-main-4">
                      <div className="padd-top col-main-inner" data-tooltip="margin Top">
                        <TextControl
                          type="number"
                          min="1"
                          value={marginTop}
                          onChange={(value) => setAttributes({ marginTop: value })}
                        />
                        <label>Top</label>
                      </div>
                      <div className="padd-buttom col-main-inner" data-tooltip="margin Bottom">
                        <TextControl
                          type="number"
                          min="1"
                          value={marginBottom}
                          onChange={(value) => setAttributes({ marginBottom: value })}
                        />
                        <label>Bottom</label>
                      </div>
                      <div className="padd-left col-main-inner" data-tooltip="margin Left">
                        <TextControl
                          type="number"
                          min="1"
                          value={marginLeft}
                          onChange={(value) => setAttributes({ marginLeft: value })}
                        />
                        <label>Left</label>
                      </div>
                      <div className="padd-right col-main-inner" data-tooltip="margin Right">
                        <TextControl
                          type="number"
                          min="1"
                          value={marginRight}
                          onChange={(value) => setAttributes({ marginRight: value })}
                        />
                        <label>Right</label>
                      </div>
                    </div>
                  </div>
                </div>
              </PanelRow>
            </PanelBody>
            <PanelBody title={__('Link')} initialOpen={false}>
              <PanelRow>
                <TextControl
                  type="text"
                  placeholder="https:"
                  value={imgLink}
                  onChange={(value) => setAttributes({ imgLink: value })}
                />
              </PanelRow>
              {imgLink && (
                <PanelRow>
                <ToggleControl
                  label={__('Open New Tab')}
                  checked={newWindow}
                  onChange={() => setAttributes({ newWindow: ! newWindow })}
                />
              </PanelRow>
              )}
            </PanelBody>
            <PanelBody title={__('Help')} initialOpen={false}>
              <a href="https://nabshow-com.go-vip.net/2020/wp-content/uploads/sites/3/2019/11/miscellaneous-blocks.mp4" target="_blank">How to use block?</a>
            </PanelBody>
          </InspectorControls>
        </div>
      );
    },
    save({ attributes }) {
      const {
        imageAlt,
        imageUrl,
        ImageWidth,
        ImageHeight,
        BorderSize,
        BorderType,
        BorderRadius,
        BorderColor,
        marginTop,
        marginRight,
        marginBottom,
        marginLeft,
        paddingTop,
        paddingRight,
        paddingBottom,
        paddingLeft,
        ImgAlignment,
        imgLink,
        newWindow,
        ImageMaxWidth
      } = attributes;

      const ImageStyle = {};
      ImageWidth && (ImageStyle.width = `${ImageWidth}px`);
      ImageHeight && (ImageStyle.height = `${ImageHeight}px`);
      ImageMaxWidth && (ImageStyle.maxWidth = `${ImageMaxWidth}%`);
      marginTop && (ImageStyle.marginTop = `${marginTop}px`);
      marginBottom && (ImageStyle.marginBottom = `${marginBottom}px`);
      marginLeft && (ImageStyle.marginLeft = `${marginLeft}px`);
      marginRight && (ImageStyle.marginRight = `${marginRight}px`);
      paddingTop && (ImageStyle.paddingTop = `${paddingTop}px`);
      paddingBottom && (ImageStyle.paddingBottom = `${paddingBottom}px`);
      paddingLeft && (ImageStyle.paddingLeft = `${paddingLeft}px`);
      paddingRight && (ImageStyle.paddingRight = `${paddingRight}px`);
      BorderSize && (ImageStyle.border = `${BorderSize}px ${BorderType} ${BorderColor}`);
      BorderRadius && (ImageStyle.borderRadius = `${BorderRadius}%`);

      const mainStyle = {};
      ImgAlignment && (mainStyle.textAlign = ImgAlignment);

      return (
        <div className="nab-image" style={mainStyle}>
          {imgLink ? (<a href={imgLink} target={newWindow ? '_blank' : '_self'} rel="noopener noreferrer"><img style={ImageStyle} src={imageUrl} alt={imageAlt} /></a>) : (<img style={ImageStyle} src={imageUrl} alt={imageAlt} />)}
        </div>
      );
    }
  });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);
