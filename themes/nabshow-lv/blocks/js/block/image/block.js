(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
  const { __ } = wpI18n;
  const { registerBlockType } = wpBlocks;
  const { Fragment } = wpElement;
  const { InspectorControls, PanelColorSettings, MediaUpload, RichText, BlockControls } = wpEditor;
  const { TextControl, Panel, PanelBody, PanelRow, Button, SelectControl, RangeControl, ColorPalette } = wpComponents;

  const IMAGE_TEMPLATE = [['core/image', {}]];
  registerBlockType('nab/custom-image', {
    title: __('Nab - Image'),
    icon: 'format-image',
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
      }
    },
    edit({ attributes, setAttributes }) {
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
        InsertUrl,
        ImgAlignment
      } = attributes;

      const ImageStyle = {};
      ImageWidth && (ImageStyle.width = `${ImageWidth}px`);
      ImageHeight && (ImageStyle.height = `${ImageHeight}px`);
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
                  <label>Width</label>
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
                  <label>Height</label>
                  <RangeControl
                    value={ImageHeight}
                    min={1}
                    max={1920}
                    onChange={ImageHeight => setAttributes({ ImageHeight: ImageHeight })}
                  />
                </div>
              </PanelRow>
              <PanelRow>
                <div class="inspector-field-alignment inspector-field inspector-responsive">
                  <label>Image Alignment</label>
                  <div class="inspector-field-button-list inspector-field-button-list-fluid">
                    <button class=" inspector-button" onClick={() => setAttributes({ ImgAlignment: 'left' })} >
                      <svg width="21" height="18" viewBox="0 0 21 18" xmlns="http://www.w3.org/2000/svg">
                        <g transform="translate(-29 -4) translate(29 4)" fill="none">
                          <path d="M1 .708v15.851" class="inspector-svg-stroke" stroke-linecap="square"></path>
                          <rect class="inspector-svg-fill" x="5" y="5" width="16" height="7" rx="1"></rect>
                        </g>
                      </svg>
                    </button>
                    <button class=" inspector-button" onClick={() => setAttributes({ ImgAlignment: 'center' })} >
                      <svg width="16" height="18" viewBox="0 0 16 18" xmlns="http://www.w3.org/2000/svg">
                        <g transform="translate(-115 -4) translate(115 4)" fill="none">
                          <path d="M8 .708v15.851" class="inspector-svg-stroke" stroke-linecap="square"></path>
                          <rect class="inspector-svg-fill" y="5" width="16" height="7" rx="1"></rect>
                        </g>
                      </svg>
                    </button>
                    <button class=" inspector-button" onClick={() => setAttributes({ ImgAlignment: 'Right' })} >
                      <svg width="21" height="18" viewBox="0 0 21 18" xmlns="http://www.w3.org/2000/svg">
                        <g transform="translate(0 1) rotate(-180 10.5 8.5)" fill="none">
                          <path d="M1 .708v15.851" class="inspector-svg-stroke" stroke-linecap="square"></path>
                          <rect class="inspector-svg-fill" fill-rule="nonzero" x="5" y="5" width="16" height="7" rx="1"></rect>
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
                  <div class="inspector-field-button-list inspector-field-button-list-fluid">
                    <button class=" inspector-button" onClick={() => setAttributes({ BorderType: 'solid' })}><span class="inspector-field-border-type inspector-field-border-type-solid"></span></button>
                    <button class=" inspector-button" onClick={() => setAttributes({ BorderType: 'dotted' })}><span class="inspector-field-border-type inspector-field-border-type-dotted"></span></button>
                    <button class=" inspector-button" onClick={() => setAttributes({ BorderType: 'dashed' })}><span class="inspector-field-border-type inspector-field-border-type-dashed"></span></button>
                    <button class=" inspector-button" onClick={() => setAttributes({ BorderType: 'double' })}><span class="inspector-field-border-type inspector-field-border-type-double"></span></button>
                    <button class=" inspector-button" onClick={() => setAttributes({ BorderType: 'none' })}><i class="fa fa-ban"></i></button>
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
                <div class="inspector-field inspector-field-color ">
                  <label class="inspector-mb-0">Color</label>
                  <div class="inspector-ml-auto">
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
                <div class="inspector-field inspector-field-padding">
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
                <div class="inspector-field inspector-field-margin">
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
        ImgAlignment
      } = attributes;

      const ImageStyle = {};
      ImageWidth && (ImageStyle.width = `${ImageWidth}px`);
      ImageHeight && (ImageStyle.height = `${ImageHeight}px`);
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
          <img style={ImageStyle} src={imageUrl} alt={imageAlt} />
        </div>
      );
    }
  });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);
