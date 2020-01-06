(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
	const { __ } = wpI18n;
	const { registerBlockType } = wpBlocks;
	const { Fragment } = wpElement;
	const { RichText, InspectorControls } = wpEditor;
	const { TextControl, PanelBody, PanelRow, SelectControl, ColorPalette, RangeControl } = wpComponents;

	const headingBlockIcon = (
		<svg width="150px" height="150px" viewBox="222.64 222.641 150 150" enable-background="new 222.64 222.641 150 150">
			<g>
				<polygon fill="#0F6CB6" points="364.14,260.983 364.14,256.627 345.406,256.627 345.406,260.983 352.595,260.983 352.595,334.296 345.406,334.296 345.406,338.652 364.14,338.652 364.14,334.296 356.951,334.296 356.951,260.983 	"/>
				<g>
					<path fill="#0F6CB6" d="M231.949,320.921l21.925-49.513c1.529-3.414,4.313-5.481,8.088-5.481h0.809
						c3.773,0,6.469,2.067,7.997,5.481l21.926,49.513c0.449,0.988,0.72,1.887,0.72,2.785c0,3.685-2.875,6.65-6.56,6.65
						c-3.235,0-5.392-1.888-6.649-4.764l-4.223-9.883h-27.677l-4.403,10.333c-1.168,2.695-3.504,4.313-6.38,4.313
						c-3.596-0.001-6.38-2.876-6.38-6.471C231.141,322.897,231.5,321.909,231.949,320.921z M270.858,303.488l-8.717-20.758
						l-8.716,20.758H270.858z"/>
					<path fill="#0F6CB6" d="M299.969,315.978v-0.18c0-10.513,7.998-15.365,19.41-15.365c4.853,0,8.357,0.809,11.772,1.977v-0.809
						c0-5.661-3.505-8.806-10.335-8.806c-3.773,0-6.829,0.539-9.435,1.348c-0.809,0.269-1.348,0.358-1.979,0.358
						c-3.144,0-5.66-2.426-5.66-5.571c0-2.426,1.527-4.493,3.684-5.302c4.313-1.618,8.987-2.516,15.366-2.516
						c7.458,0,12.851,1.977,16.265,5.391c3.595,3.594,5.212,8.896,5.212,15.366v21.925c0,3.686-2.965,6.561-6.649,6.561
						c-3.954,0-6.56-2.786-6.56-5.662v-0.09c-3.325,3.685-7.908,6.11-14.557,6.11C307.427,330.715,299.969,325.504,299.969,315.978z
						M331.33,312.833v-2.426c-2.337-1.078-5.392-1.798-8.717-1.798c-5.841,0-9.435,2.337-9.435,6.649v0.181
						c0,3.684,3.055,5.841,7.458,5.841C327.017,321.28,331.33,317.775,331.33,312.833z"/>
				</g>
			</g>
		</svg>
	);

	registerBlockType('nab/nab-heading', {
		title: __('Nab - Heading'),
		icon: { src: headingBlockIcon },
		description: __('Nab Heading is a gutenberg block which defines six levels of headings.'),
		category: 'nabshow',
		keywords: [__('Heading'), __('gutenberg')],
		attributes: {
			HeadingText: {
				type: 'string',
				default: 'Heading'
			},
			HeadingLevel: {
				type: 'string',
				default: 'h2'
			},
			FontSize: {
				type: 'number'
			},
			LineHeight: {
				type: 'string'
			},
			LetterSpacing: {
				type: 'string'
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
				default: '10'
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
			HeadingColor: {
				type: 'string',
				default: '#000'
			},
			TextUppercase: {
				type: 'string'
			},
			TextAlign: {
				type: 'string',
				default: 'left'
			},
			fontFamily: {
				type: 'string',
				default: 'Gotham Bold'
			}
		},
		edit({ attributes, setAttributes }) {
			const {
				HeadingText,
				HeadingLevel,
				FontSize,
				marginTop,
				marginRight,
				marginBottom,
				marginLeft,
				paddingTop,
				paddingRight,
				paddingBottom,
				paddingLeft,
				LineHeight,
				LetterSpacing,
				HeadingColor,
				TextUppercase,
				TextAlign,
				fontFamily
			} = attributes;

			const HeadingStyle = {};
			FontSize && (HeadingStyle.fontSize = FontSize + 'px');
			HeadingColor && (HeadingStyle.color = HeadingColor);
			LineHeight && (HeadingStyle.lineHeight = `${LineHeight}px`);
			LetterSpacing && (HeadingStyle.letterSpacing = `${LetterSpacing}px`);
			TextUppercase && (HeadingStyle.textTransform = TextUppercase);
			marginTop && (HeadingStyle.marginTop = marginTop + 'px');
			marginBottom && (HeadingStyle.marginBottom = marginBottom + 'px');
			marginLeft && (HeadingStyle.marginLeft = marginLeft + 'px');
			marginRight && (HeadingStyle.marginRight = marginRight + 'px');
			paddingTop && (HeadingStyle.paddingTop = paddingTop + 'px');
			paddingBottom && (HeadingStyle.paddingBottom = paddingBottom + 'px');
			paddingLeft && (HeadingStyle.paddingLeft = paddingLeft + 'px');
			paddingRight && (HeadingStyle.paddingRight = paddingRight + 'px');
			TextAlign && (HeadingStyle.textAlign = TextAlign);
			fontFamily && (HeadingStyle.fontFamily = fontFamily);

			return (
				<Fragment>
					<RichText
						tagName={HeadingLevel}
						onChange={(HeadingText) => setAttributes({ HeadingText: HeadingText })}
						value={HeadingText}
						style={HeadingStyle}
						className="title nab-title"
					/>
					<InspectorControls>
						<PanelBody title="Heading" initialOpen={true}>
							<PanelRow>
								<div className="inspector-field inspector-field-headings">
									<div className="inspector-field-button-list inspector-field-button-list-fluid">
										<button className={'h1' === HeadingLevel ? 'active  inspector-button' : 'inspector-button'} onClick={() => setAttributes({ HeadingLevel: 'h1' })}>
											<svg width="17" height="13" viewBox="0 0 17 13" xmlns="http://www.w3.org/2000/svg">
												<g className="inspector-svg-fill" fill-rule="nonzero">
													<path d="M10.83 13h-2.109v-5.792h-5.924v5.792h-2.101v-12.85h2.101v5.256h5.924v-5.256h2.109z"></path>
													<path d="M16.809 13h-1.147v-4.609c0-.55.013-.986.039-1.309l-.276.259c-.109.094-.474.394-1.096.898l-.576-.728 2.1-1.65h.957v7.139z"></path>
												</g>
											</svg>
										</button>
										<button className={'h2' === HeadingLevel ? 'active  inspector-button' : 'inspector-button'} onClick={() => setAttributes({ HeadingLevel: 'h2' })}>
											<svg width="19" height="13" viewBox="0 0 19 13" xmlns="http://www.w3.org/2000/svg">
												<g className="inspector-svg-fill" fill-rule="nonzero">
													<path d="M10.83 13h-2.109v-5.792h-5.924v5.792h-2.101v-12.85h2.101v5.256h5.924v-5.256h2.109z"></path>
													<path d="M18.278 13h-4.839v-.869l1.841-1.851c.544-.557.904-.951 1.082-1.184.177-.233.307-.452.388-.657.081-.205.122-.425.122-.659 0-.322-.097-.576-.291-.762-.194-.186-.461-.278-.803-.278-.273 0-.538.05-.793.151-.256.101-.551.283-.886.547l-.62-.757c.397-.335.783-.573 1.157-.713s.773-.21 1.196-.21c.664 0 1.196.173 1.597.52.4.347.601.813.601 1.399 0 .322-.058.628-.173.918-.116.29-.293.588-.532.896-.239.308-.637.723-1.194 1.248l-1.24 1.201v.049h3.389v1.011z"></path>
												</g>
											</svg>
										</button>
										<button className={'h3' === HeadingLevel ? 'active  inspector-button' : 'inspector-button'} onClick={() => setAttributes({ HeadingLevel: 'h3' })}>
											<svg width="19" height="14" viewBox="0 0 19 14" xmlns="http://www.w3.org/2000/svg">
												<g className="inspector-svg-fill" fill-rule="nonzero">
													<path d="M10.83 13h-2.109v-5.792h-5.924v5.792h-2.101v-12.85h2.101v5.256h5.924v-5.256h2.109z"></path>
													<path d="M18.01 7.502c0 .452-.132.829-.396 1.13-.264.301-.635.504-1.113.608v.039c.573.072 1.003.25 1.289.535.286.285.43.663.43 1.135 0 .687-.243 1.217-.728 1.589-.485.373-1.175.559-2.07.559-.791 0-1.458-.129-2.002-.386v-1.021c.303.15.623.265.962.347.339.081.664.122.977.122.553 0 .967-.103 1.24-.308.273-.205.41-.522.41-.952 0-.381-.151-.661-.454-.84-.303-.179-.778-.269-1.426-.269h-.62v-.933h.63c1.139 0 1.709-.394 1.709-1.182 0-.306-.099-.542-.298-.708-.199-.166-.492-.249-.879-.249-.27 0-.531.038-.781.115-.251.076-.547.225-.889.447l-.562-.801c.654-.482 1.414-.723 2.28-.723.719 0 1.281.155 1.685.464.404.309.605.736.605 1.279z"></path>
												</g>
											</svg>
										</button>
										<button className={'h4' === HeadingLevel ? 'active  inspector-button' : 'inspector-button'} onClick={() => setAttributes({ HeadingLevel: 'h4' })}>
											<svg width="19" height="13" viewBox="0 0 19 13" xmlns="http://www.w3.org/2000/svg">
												<g className="inspector-svg-fill" fill-rule="nonzero">
													<path d="M10.83 13h-2.109v-5.792h-5.924v5.792h-2.101v-12.85h2.101v5.256h5.924v-5.256h2.109z"></path>
													<path d="M18.532 11.442h-.962v1.558h-1.118v-1.558h-3.262v-.884l3.262-4.717h1.118v4.648h.962v.952zm-2.08-.952v-1.792c0-.638.016-1.16.049-1.567h-.039c-.091.215-.234.475-.43.781l-1.772 2.578h2.192z"></path>
												</g>
											</svg>
										</button>
										<button className={'h5' === HeadingLevel ? 'active  inspector-button' : 'inspector-button'} onClick={() => setAttributes({ HeadingLevel: 'h5' })}>
											<svg width="19" height="14" viewBox="0 0 19 14" xmlns="http://www.w3.org/2000/svg">
												<g className="inspector-svg-fill" fill-rule="nonzero">
													<path d="M10.83 13h-2.109v-5.792h-5.924v5.792h-2.101v-12.85h2.101v5.256h5.924v-5.256h2.109z"></path>
													<path d="M15.861 8.542c.719 0 1.289.19 1.709.571.42.381.63.9.63 1.558 0 .762-.238 1.357-.715 1.785-.477.428-1.155.642-2.034.642-.798 0-1.424-.129-1.88-.386v-1.04c.264.15.566.265.908.347.342.081.659.122.952.122.518 0 .911-.116 1.182-.347.27-.231.405-.57.405-1.016 0-.853-.544-1.279-1.631-1.279-.153 0-.342.015-.566.046-.225.031-.422.066-.591.105l-.513-.303.273-3.486h3.711v1.021h-2.7l-.161 1.768.417-.068c.164-.026.365-.039.603-.039z"></path>
												</g>
											</svg>
										</button>
										<button className={'h6' === HeadingLevel ? 'active  inspector-button' : 'inspector-button'} onClick={() => setAttributes({ HeadingLevel: 'h6' })}>
											<svg width="19" height="14" viewBox="0 0 19 14" xmlns="http://www.w3.org/2000/svg">
												<g className="inspector-svg-fill" fill-rule="nonzero">
													<path d="M10.83 13h-2.109v-5.792h-5.924v5.792h-2.101v-12.85h2.101v5.256h5.924v-5.256h2.109z"></path>
													<path d="M13.459 9.958c0-2.793 1.138-4.189 3.413-4.189.358 0 .661.028.908.083v.957c-.247-.072-.534-.107-.859-.107-.765 0-1.34.205-1.724.615-.384.41-.592 1.068-.625 1.973h.059c.153-.264.368-.468.645-.613.277-.145.602-.217.977-.217.648 0 1.152.199 1.514.596.361.397.542.936.542 1.616 0 .749-.209 1.34-.627 1.775-.418.435-.989.652-1.711.652-.511 0-.955-.123-1.333-.369s-.668-.604-.872-1.074c-.203-.47-.305-1.036-.305-1.697zm2.49 2.192c.394 0 .697-.127.911-.381.213-.254.32-.617.32-1.089 0-.41-.1-.732-.3-.967-.2-.234-.5-.352-.901-.352-.247 0-.475.053-.684.159-.208.106-.373.251-.493.435s-.181.372-.181.564c0 .459.125.846.374 1.16.249.314.567.471.955.471z"></path>
												</g>
											</svg>
										</button>
									</div>
								</div>
							</PanelRow>
						</PanelBody>
						<PanelBody title="Typography" initialOpen={false}>
							<PanelRow>
								<div className="inspector-field inspector-field-color ">
									<label className="inspector-mb-0">Color</label>
									<div className="inspector-ml-auto"><ColorPalette
										value={HeadingColor}
										onChange={(HeadingColor) =>
											setAttributes({
												HeadingColor: HeadingColor
											})}
									/>
									</div>
								</div>
							</PanelRow>
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
										value={fontFamily}
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
											{ label: __('Vollkorn SemiBoldItalic'), value: 'Vollkorn SemiBoldItalic' },
											{ label: __('Molot'), value: 'Molot' }

										]}
										onChange={(value) => setAttributes({ fontFamily: value })}
									/>
								</div>
							</PanelRow>
							<PanelRow>
								<div className="inspector-field inspector-field-fontfamily side-2-col">
									<div className="inspector-letter-spacing">
										<label className="mt10">Spacing </label>
										<TextControl
											type="number"
											min="1"
											value={LetterSpacing}
											placeholder="px"
											onChange={(value) => setAttributes({ LetterSpacing: value })}
										/>
									</div>
									<div className="inspector-line-height">
										<label className="mt10">Line Height</label>
										<TextControl
											type="number"
											min="1"
											value={LineHeight}
											placeholder="px"
											onChange={(value) => setAttributes({ LineHeight: value })}
										/>
									</div>
								</div>
							</PanelRow>
							<PanelRow>
								<div className="inspector-field inspector-field-alignment">
									<label className="inspector-mb-0">Alignment</label>
									<div className="inspector-field-button-list inspector-field-button-list-fluid">
										<button className={'left' === TextAlign ? 'active  inspector-button' : 'inspector-button'} onClick={() => setAttributes({ TextAlign: 'left' })}><i className="fa fa-align-left"></i></button>
										<button className={'center' === TextAlign ? 'active  inspector-button' : 'inspector-button'} onClick={() => setAttributes({ TextAlign: 'center' })}><i className="fa fa-align-center"></i></button>
										<button className={'right' === TextAlign ? 'active  inspector-button' : 'inspector-button'} onClick={() => setAttributes({ TextAlign: 'right' })}><i className="fa fa-align-right"></i></button>
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
					</InspectorControls >
				</Fragment >
			);
		},
		save({ attributes, props }) {
			const {
				HeadingText,
				HeadingLevel,
				FontSize,
				marginTop,
				marginRight,
				marginBottom,
				marginLeft,
				paddingTop,
				paddingRight,
				paddingBottom,
				paddingLeft,
				LineHeight,
				LetterSpacing,
				HeadingColor,
				TextUppercase,
				TextAlign,
				fontFamily
			} = attributes;

			const HeadingStyle = {};
			FontSize && (HeadingStyle.fontSize = FontSize + 'px');
			HeadingColor && (HeadingStyle.color = HeadingColor);
			LineHeight && (HeadingStyle.lineHeight = `${LineHeight}px`);
			LetterSpacing && (HeadingStyle.letterSpacing = `${LetterSpacing}px`);
			TextUppercase && (HeadingStyle.textTransform = TextUppercase);
			marginTop && (HeadingStyle.marginTop = marginTop + 'px');
			marginBottom && (HeadingStyle.marginBottom = marginBottom + 'px');
			marginLeft && (HeadingStyle.marginLeft = marginLeft + 'px');
			marginRight && (HeadingStyle.marginRight = marginRight + 'px');
			paddingTop && (HeadingStyle.paddingTop = paddingTop + 'px');
			paddingBottom && (HeadingStyle.paddingBottom = paddingBottom + 'px');
			paddingLeft && (HeadingStyle.paddingLeft = paddingLeft + 'px');
			paddingRight && (HeadingStyle.paddingRight = paddingRight + 'px');
			TextAlign && (HeadingStyle.textAlign = TextAlign);
			fontFamily && (HeadingStyle.fontFamily = fontFamily);

			return (
				<Fragment>
					<RichText.Content
						tagName={HeadingLevel}
						value={HeadingText}
						style={HeadingStyle}
						className="title nab-title"
					/>
				</Fragment>
			);
		}
	});
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);
