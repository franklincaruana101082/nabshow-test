import { btnPrimary, btnDefault, btnAlt, btnLight, arrowBtn, btnWhite } from '../icons';

(function (wpI18n, wpBlocks, wpEditor, wpComponents) {
  const { __ } = wpI18n;
  const { registerBlockType } = wpBlocks;
  const { RichText, InspectorControls } = wpEditor;
  const { TextControl, PanelBody, PanelRow, RangeControl, ToggleControl, SelectControl, ColorPalette } = wpComponents;

  const buttonBlockIcon = (
    <svg x="0px" y="0px" width="32.05px" height="18.128px" viewBox="0 0 32.05 18.128" enableBackground="new 0 0 32.05 18.128">
      <g>
        <path
          fill="#0f6cb6"
          d="M25.308,18.128c-0.148,0-0.288-0.058-0.393-0.162l-2.215-2.214l-1.642,1.698
          c-0.104,0.104-0.244,0.162-0.392,0.162c-0.037,0-0.072-0.004-0.107-0.012c-0.182-0.034-0.333-0.157-0.406-0.327l-1.604-3.811
          L2.618,13.487C1.174,13.487,0,12.313,0,10.869V2.618C0,1.175,1.174,0,2.618,0h26.815c1.443,0,2.617,1.175,2.617,2.618v8.251
          c0,1.443-1.174,2.618-2.617,2.618h-4.428l2.242,2.146c0.105,0.104,0.164,0.244,0.164,0.393s-0.059,0.288-0.164,0.393l-1.547,1.548
          C25.596,18.07,25.457,18.128,25.308,18.128 M22.729,14.438c0.147,0,0.288,0.058,0.394,0.162l2.213,2.215l0.762-0.818l-2.215-2.157
          c-0.104-0.104-0.162-0.244-0.162-0.393s0.058-0.288,0.162-0.393l1.521-1.52l-7.911-3.272l3.39,7.871l1.453-1.533
          C22.441,14.496,22.582,14.438,22.729,14.438 M26.065,12.444l3.368-0.068c0.763,0,1.402-0.576,1.49-1.34
          c-0.385,0.586-1.047,0.904-1.748,0.904h-2.606L26.065,12.444z M1.15,11.173c0.143,0.694,0.751,1.203,1.468,1.203h15.535
          l-0.254-0.46L2.876,11.94C2.222,11.94,1.601,11.662,1.15,11.173 M16.541,6.705c0.075,0,0.147,0.015,0.216,0.043l9.798,4.125
          c0.171,0.072,0.294,0.224,0.329,0.405l0.008,0.106l2.283-0.04c0.973,0,1.765-0.792,1.765-1.765V2.618
          c0-0.831-0.676-1.507-1.507-1.507H2.618c-0.831,0-1.507,0.676-1.507,1.507V9.58c0,0.973,0.792,1.765,1.765,1.765h14.843
          l-1.69-3.869c-0.088-0.209-0.041-0.447,0.119-0.608C16.253,6.763,16.393,6.705,16.541,6.705"
        />
        <path
          fill="#0f6cb6"
          d="M22.73,14.438c0.147,0,0.287,0.058,0.393,0.163l2.213,2.214l0.762-0.818l-2.214-2.157
          c-0.104-0.104-0.163-0.244-0.163-0.393s0.059-0.288,0.163-0.393l1.521-1.52l-7.911-3.272l3.389,7.871l1.455-1.532
          C22.441,14.496,22.582,14.438,22.73,14.438"
        />
      </g>
    </svg>
  );

  registerBlockType('nab/nab-button', {
    title: __('NABShow - Button'),
    icon: { src: buttonBlockIcon },
    description: __(
      'Nab Button is a gutenberg block used to add a clickable button.'
    ),
    category: 'nabshow',
    keywords: [__('Button'), __('gutenberg')],
    attributes: {
      ButtonText: {
        type: 'string',
        source: 'html',
        selector: 'a',
        default: 'READ MORE'
      },
      Link: {
        type: 'string',
        default: '#'
      },
      FontSize: {
        type: 'number',
        default: 14
      },
      paddingTop: {
        type: 'string',
        default: '10'
      },
      paddingRight: {
        type: 'string',
        default: '15'
      },
      paddingBottom: {
        type: 'string',
        default: '10'
      },
      paddingLeft: {
        type: 'string',
        default: '15'
      },
      ButtonAlignment: {
        type: 'string',
        default: 'Left'
      },
      BorderWidth: {
        type: 'number'
      },
      BorderRadius: {
        type: 'number'
      },
      FontFamily: {
        type: 'string',
        default: 'Gotham Bold'
      },
      BorderColor: {
        type: 'string',
        default: '000'
      },
      saveId: {
        type: 'string'
      },
      btnStyle: {
        type: 'string',
        default: 'btn-primary'
      },
      arrow: {
        type: 'boolean',
        default: false,
      },
      newWindow: {
        type: 'boolean',
        default: false,
      },
      arrowBtnColor: {
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
      TextUppercase: {
        type: 'string'
      },
    },
    edit({ attributes, setAttributes, clientId }) {
      const {
        ButtonText,
        paddingTop,
        paddingRight,
        paddingBottom,
        paddingLeft,
        Link,
        BorderWidth,
        BorderRadius,
        BorderColor,
        FontSize,
        ButtonAlignment,
        saveId,
        FontFamily,
        btnStyle,
        arrow,
        arrowBtnColor,
        newWindow,
        marginTop,
        marginRight,
        marginBottom,
        marginLeft,
        TextUppercase
      } = attributes;

      setAttributes({ saveId: clientId });
      const blockID = `block-${saveId}`;

      const ButtonStyle = {};
      FontSize && (ButtonStyle.fontSize = FontSize + 'px');
      paddingTop && (ButtonStyle.paddingTop = paddingTop + 'px');
      paddingBottom && (ButtonStyle.paddingBottom = paddingBottom + 'px');
      paddingLeft && (ButtonStyle.paddingLeft = paddingLeft + 'px');
      paddingRight && (ButtonStyle.paddingRight = paddingRight + 'px');
      marginTop && (ButtonStyle.marginTop = marginTop + 'px');
      marginBottom && (ButtonStyle.marginBottom = marginBottom + 'px');
      marginLeft && (ButtonStyle.marginLeft = marginLeft + 'px');
      marginRight && (ButtonStyle.marginRight = marginRight + 'px');
      TextUppercase && (ButtonStyle.textTransform = TextUppercase);
      BorderWidth && BorderColor &&
        (ButtonStyle.border = `${BorderWidth}px solid #${BorderColor}`);
      BorderRadius && (ButtonStyle.borderRadius = BorderRadius + 'px');
      FontFamily && (ButtonStyle.fontFamily = `${FontFamily}`);
      ButtonStyle.textDecoration = 'none';
      ButtonStyle.textAlign = 'center';
      ButtonStyle.display = 'inline-block';
      ButtonStyle.cursor = 'pointer';

      const arrowStyle = {};
      arrowBtnColor && (arrowStyle.color = arrowBtnColor);
      FontSize && (arrowStyle.fontSize = FontSize + 'px');
      FontFamily && (arrowStyle.fontFamily = `${FontFamily}`);
      arrowStyle.textDecoration = 'none';
      arrowStyle.textAlign = 'center';
      arrowStyle.display = 'inline-block';
      arrowStyle.cursor = 'pointer';

      const ButtonMain = {};
      ButtonAlignment && (ButtonMain.textAlign = ButtonAlignment);

      const finaleStyle = 'with-arrow' === btnStyle ? arrowStyle : ButtonStyle;
      const finaleClass = arrow ? `title ${arrow ? 'with-arrow' : ''}` : `title ${btnStyle} ${arrow ? 'with-arrow' : ''}`;

      return (
        <div className="nab-btn-main" id={blockID} style={ButtonMain}>
          <RichText
            tagName="a"
            style={finaleStyle}
            onChange={ButtonText => setAttributes({ ButtonText: ButtonText })}
            formattingControls={['bold', 'italic']}
            value={ButtonText}
            className={finaleClass}
            rel='noopener noreferrer'
          />
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
            </PanelBody>
            <PanelBody title="Design">
              <PanelRow>
                <div className="inspector-field inspector-buttons">
                  <PanelRow>
                    <div className="inspector-field inspector-btn-styles ">
                      <label className="inspector-mb-0">Button Styles</label>
                      <ul className="button-prev inspector-field">
                        <li className={'btn-primary' === btnStyle ? 'active' : ''} onClick={() => setAttributes({ btnStyle: 'btn-primary' })}>{btnPrimary}</li>
                        <li className={'btn-default' === btnStyle ? 'active' : ''} onClick={() => setAttributes({ btnStyle: 'btn-default' })}>{btnDefault}</li>
                        <li className={'btn-alt' === btnStyle ? 'active' : ''} onClick={() => setAttributes({ btnStyle: 'btn-alt' })}>{btnAlt}</li>
                        <li className={'btn-light' === btnStyle ? 'active' : ''} onClick={() => setAttributes({ btnStyle: 'btn-light' })}>{btnLight}</li>
                        <li className={'btn-white' === btnStyle ? 'active' : ''} onClick={() => setAttributes({ btnStyle: 'btn-white' })}>{btnWhite}</li>
                        <li className={'with-arrow' === btnStyle ? 'active with-arrow' : 'with-arrow'} onClick={() => setAttributes({ btnStyle: 'with-arrow' })}>{arrowBtn}</li>
                      </ul>
                    </div>
                  </PanelRow>
                  {
                    'with-arrow' === btnStyle ? (
                      <div className="inspector-field inspector-field-color ">
                        <label className="inspector-mb-0">Color</label>
                        <div className="inspector-ml-auto">
                          <ColorPalette
                            value={arrowBtnColor}
                            onChange={(arrowBtnColor) =>
                              setAttributes({
                                arrowBtnColor: arrowBtnColor
                              })}
                          />
                        </div>
                      </div>
                    ) : ''
                  }
                  {
                    'with-arrow' !== btnStyle ? (
                      <div>
                        <PanelRow>
                          <div className="inspector-field inspector-border-width" >
                            <label>Border Width</label>
                            <RangeControl
                              value={BorderWidth}
                              min={1}
                              onChange={BorderWidth => setAttributes({ BorderWidth: BorderWidth })}
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
                            <div className="inspector-ml-auto"><ColorPalette
                              value={BorderColor}
                              onChange={(BorderColor) =>
                                setAttributes({
                                  BorderColor: BorderColor
                                })}
                            />
                            </div>
                          </div>
                        </PanelRow>
                      </div>
                    ) : ''
                  }
                </div>
              </PanelRow>
            </PanelBody>
            <PanelBody title="Typography" initialOpen={false}>
              <PanelRow>
                <div className="inspector-field inspector-field-fontsize ">
                  <label className="inspector-mb-0">Font Size</label>
                  <RangeControl
                    value={FontSize}
                    min={8}
                    onChange={(value) => setAttributes({ FontSize: value })}
                  />

                </div>
              </PanelRow>
              <PanelRow>
                <div className="inspector-field inspector-field-fontfamily ">
                  <label className="inspector-mb-0">Font Family</label>
                  <SelectControl
                    value={FontFamily}
                    options={[
                      { label: __('Gotham Book'), value: 'Gotham Book' },
                      { label: __('Gotham Book Italic'), value: 'Gotham Book Italic' },
                      { label: __('Gotham Light'), value: 'Gotham Light' },
                      { label: __('Gotham Light Italic'), value: 'Gotham Light Italic' },
                      { label: __('Gotham Medium'), value: 'Gotham Medium' },
                      { label: __('Gotham Bold'), value: 'Gotham Bold' },
                      { label: __('Gotham Bold Italic'), value: 'Gotham Bold Italic' },
                      { label: __('Gotham Black Regular'), value: 'Gotham Black Regular' },
                      { label: __('Gotham Light Regular'), value: 'Gotham Light Regular' },
                      { label: __('Gotham Thin Regular'), value: 'Gotham Thin Regular' },
                      { label: __('Gotham XLight Regular'), value: 'Gotham XLight Regular' },
                      { label: __('Gotham Book Italic'), value: 'Gotham Book Italic' },
                      { label: __('Gotham Thin Italic'), value: 'Gotham Thin Italic' },
                      { label: __('Gotham Ultra Italic'), value: 'Gotham Ultra Italic' },
                      { label: __('Vollkorn Black'), value: 'Vollkorn Black' },
                      { label: __('Vollkorn BlackItalic'), value: 'Vollkorn BlackItalic' },
                      { label: __('Vollkorn Bold'), value: 'Vollkorn Bold' },
                      { label: __('Vollkorn BoldItalic'), value: 'Vollkorn BoldItalic' },
                      { label: __('Vollkorn Italic'), value: 'Vollkorn Italic' },
                      { label: __('Vollkorn Regular'), value: 'Vollkorn Regular' },
                      { label: __('Vollkorn SemiBold'), value: 'Vollkorn SemiBold' },
                      { label: __('Vollkorn SemiBoldItalic'), value: 'Vollkorn SemiBoldItalic' }

                    ]}
                    onChange={(value) => setAttributes({ FontFamily: value })}
                  />
                </div>
              </PanelRow>
              <PanelRow>
                <div className="inspector-field-alignment inspector-field inspector-responsive">
                  <label>Alignment</label>
                  <div className="inspector-field-button-list inspector-field-button-list-fluid">
                    <button className={'left' === ButtonAlignment ? 'active inspector-button' : 'inspector-button'} onClick={() => setAttributes({ ButtonAlignment: 'left' })} >
                      <svg width="21" height="18" viewBox="0 0 21 18" xmlns="http://www.w3.org/2000/svg">
                        <g transform="translate(-29 -4) translate(29 4)" fill="none">
                          <path d="M1 .708v15.851" className="inspector-svg-stroke" stroke-linecap="square"></path>
                          <rect className="inspector-svg-fill" x="5" y="5" width="16" height="7" rx="1"></rect>
                        </g>
                      </svg>
                    </button>
                    <button className={'center' === ButtonAlignment ? 'active inspector-button' : 'inspector-button'} onClick={() => setAttributes({ ButtonAlignment: 'center' })} >
                      <svg width="16" height="18" viewBox="0 0 16 18" xmlns="http://www.w3.org/2000/svg">
                        <g transform="translate(-115 -4) translate(115 4)" fill="none">
                          <path d="M8 .708v15.851" className="inspector-svg-stroke" stroke-linecap="square"></path>
                          <rect className="inspector-svg-fill" y="5" width="16" height="7" rx="1"></rect>
                        </g>
                      </svg>
                    </button>
                    <button className={'Right' === ButtonAlignment ? 'active inspector-button' : 'inspector-button'} onClick={() => setAttributes({ ButtonAlignment: 'Right' })} >
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
              <PanelRow>
                <div className="inspector-field inspector-field-transform">
                  <label className="mt10">Text Transform</label>
                  <div className="inspector-field-button-list inspector-field-button-list-fluid inspector-ml-auto">
                    <button className={'none' === TextUppercase ? 'active  inspector-button' : 'inspector-button'} onClick={() => setAttributes({ TextUppercase: 'none' })}><i className="fa fa-ban"></i></button>
                    <button className={'lowercase' === TextUppercase ? 'active  inspector-button' : 'inspector-button'} onClick={() => setAttributes({ TextUppercase: 'lowercase' })}><span>aa</span></button>
                    <button className={'capitalize' === TextUppercase ? 'active  inspector-button' : 'inspector-button'} onClick={() => setAttributes({ TextUppercase: 'capitalize' })}><span>Aa</span></button>
                    <button className={'uppercase' === TextUppercase ? 'active  inspector-button' : 'inspector-button'} onClick={() => setAttributes({ TextUppercase: 'uppercase' })}><span>AA</span></button>
                  </div>
                </div>
              </PanelRow>
            </PanelBody>
            {
              false === arrow ? (
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
              ) : ''
            }
          </InspectorControls>
        </div >
      );
    },
    save({ attributes, props }) {
      const {
        ButtonText,
        paddingTop,
        paddingRight,
        paddingBottom,
        paddingLeft,
        Link,
        BorderWidth,
        BorderRadius,
        BorderColor,
        FontSize,
        ButtonAlignment,
        saveId,
        FontFamily,
        btnStyle,
        arrow,
        arrowBtnColor,
        newWindow,
        marginTop,
        marginRight,
        marginBottom,
        marginLeft,
        TextUppercase
      } = attributes;

      const ButtonStyle = {};
      FontSize && (ButtonStyle.fontSize = FontSize + 'px');
      FontFamily && (ButtonStyle.fontFamily = `${FontFamily}`);
      paddingTop && (ButtonStyle.paddingTop = paddingTop + 'px');
      paddingBottom && (ButtonStyle.paddingBottom = paddingBottom + 'px');
      paddingLeft && (ButtonStyle.paddingLeft = paddingLeft + 'px');
      paddingRight && (ButtonStyle.paddingRight = paddingRight + 'px');
      marginTop && (ButtonStyle.marginTop = marginTop + 'px');
      marginBottom && (ButtonStyle.marginBottom = marginBottom + 'px');
      marginLeft && (ButtonStyle.marginLeft = marginLeft + 'px');
      marginRight && (ButtonStyle.marginRight = marginRight + 'px');
      TextUppercase && (ButtonStyle.textTransform = TextUppercase);
      BorderWidth &&
        (ButtonStyle.border = `${BorderWidth}px solid #${BorderColor}`);
      BorderRadius && (ButtonStyle.borderRadius = BorderRadius + 'px');
      ButtonStyle.textDecoration = 'none';
      ButtonStyle.textAlign = 'center';
      ButtonStyle.display = 'inline-block';
      ButtonStyle.cursor = 'pointer';

      const arrowStyle = {};
      arrowBtnColor && (arrowStyle.color = arrowBtnColor);
      FontSize && (arrowStyle.fontSize = FontSize + 'px');
      FontFamily && (arrowStyle.fontFamily = `${FontFamily}`);
      arrowStyle.textDecoration = 'none';
      arrowStyle.textAlign = 'center';
      arrowStyle.display = 'inline-block';
      arrowStyle.cursor = 'pointer';

      const ButtonMain = {};
      ButtonAlignment && (ButtonMain.textAlign = ButtonAlignment);

      const blockID = `block-${saveId}`;

      const finaleStyle = 'with-arrow' === btnStyle ? arrowStyle : ButtonStyle;
      const finaleClass = arrow ? `title ${arrow ? 'with-arrow' : ''}` : `title ${btnStyle} ${arrow ? 'with-arrow' : ''}`;

      return (
        <div className="nab-btn-main" id={blockID} style={ButtonMain}>
          <RichText.Content
            tagName="a"
            className={finaleClass}
            href={Link}
            target={newWindow ? '_blank' : '_self'}
            rel='noopener noreferrer'
            style={finaleStyle}
            value={ButtonText}
          />
        </div>
      );
    },
  });
})(wp.i18n, wp.blocks, wp.editor, wp.components);
