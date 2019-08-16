import times from 'lodash/times';
import memoize from 'memize';


(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
	const { __ } = wp.i18n;
	const { Fragment } = wpElement;
	const { registerBlockType } = wp.blocks;
	const { RichText, AlignmentToolbar, BlockControls, InspectorControls, PanelColorSettings, InnerBlocks } = wp.editor;
	const { TextControl, PanelBody, PanelRow, RangeControl, SelectControl, ToggleControl, Button, ColorPalette } = wp.components;

	$(document).on('click', '.accordionParentWrapper .accordionWrapper .accordionHeader .dashicons', function (e) {
		e.stopImmediatePropagation();
		$(this).parent().parent().siblings().find('.accordionBody').slideUp();
		$(this).parent().next().slideToggle();
		if ($(this).parent().parent('.accordionWrapper').hasClass('tabClose')) {
			$(this).parent().parent('.accordionWrapper').removeClass('tabClose').addClass('tabOpen');
			$(this).parent().parent('.accordionWrapper').siblings().removeClass('tabOpen').addClass('tabClose');
		} else {
			$(this).parent().parent('.accordionWrapper').removeClass('tabOpen').addClass('tabClose');
		}
	});


	/* Parent Accordion Block */
	registerBlockType('nab/accordion', {
		title: __('Accordion'),
		description: __('Accordion is a gutenberg block used to show & hide content.'),
		icon: 'lock',
		category: 'nabshow',
		keywords: [__('accordion'), __('gutenberg'), __('nabshow')],
		attributes: {
			blockId: {
				type: 'string'
			},
			noOfAccordion: {
				type: 'number',
				default: 1
			},
			title: {
				type: 'string'
			},
			showTitle: {
				type: 'boolean',
				default: true
			}
		},
		edit: (props, attributes) => {
			const { attributes: { noOfAccordion, showTitle, title }, className, setAttributes, clientId } = props;

			setAttributes({ blockId: clientId });

			const ALLOWBLOCKS = ['nab/accordion-item'];

			const getChildAccordionBlock = memoize((accordion) => {
				return times(accordion, (n) => ['nab/accordion-item', { id: n + 1 }]);
			});
			const removeButton = 1 === noOfAccordion ? 'hideButton' : '';

			return (
				<div id={clientId} className={'accordionParentWrapper' + ' ' + className} data-category={title} >
					<InspectorControls>
						<PanelBody title="General Settings">
							<PanelRow>
								<ToggleControl
									label={__('Show Title')}
									checked={showTitle}
									onChange={() => setAttributes({ showTitle: ! showTitle })}
								/>
							</PanelRow>
						</PanelBody>
					</InspectorControls>
					{
						showTitle ? (
							<RichText
								tagName="h2"
								onChange={(value) => setAttributes({ title: value })}
								placeholder={__('Category')}
								value={title}
								class="title"
							/>) : ''
					}
					<InnerBlocks
						template={getChildAccordionBlock(noOfAccordion)}
						templateLock="all"
						allowedBlocks={ALLOWBLOCKS}
					/>
					<div class="add-remove-btn">
						<button type="button" class="components-button add" onClick={() => setAttributes({ noOfAccordion: noOfAccordion + 1 })}><span class="dashicons fa fa-plus"></span></button>
						<button type="button" class="components-button remove" onClick={() => setAttributes({ noOfAccordion: 1 === noOfAccordion ? 1 : noOfAccordion - 1 })}><span class="dashicons fa fa-minus"></span></button>
					</div>
				</div>
			);
		},
		save: (props) => {
			const { attributes: { title, showTitle }, className, clientId } = props;
			return (
				<div id={clientId} className={'accordionParentWrapper'} data-category={title}>
					{
						showTitle && title ? (
							<RichText.Content
								tagName="h2"
								value={title}
								class="title"
							/>) : ''
					}
					<InnerBlocks.Content />
				</div >
			);
		}
	});

	/* Accordion Block */
	registerBlockType('nab/accordion-item', {
		title: __('Accordion Items'),
		description: __('This is nab accordion block with multiple setting.'),
		icon: 'lock',
		category: 'nabshow',
		parent: ['nab/accordion'],
		attributes: {
			title: {
				type: 'string',
				selector: 'h4'
			},
			open: {
				type: 'boolean',
				default: false
			},
			alignment: {
				type: 'string',
				default: 'unset'
			},
			headerTextFontSize: {
				type: 'number',
				default: 20
			},
			headerTextColor: {
				type: 'string',
				default: '#000'
			},
			titleBackgroundColor: {
				type: 'string',
				default: '#f2f7fd'
			},
			PaddingTop: {
				type: 'string',
				default: '10'
			},
			PaddingRight: {
				type: 'string',
				default: '35'
			},
			PaddingBottom: {
				type: 'string',
				default: '10'
			},
			PaddingLeft: {
				type: 'string',
				default: '25'
			},
			BodyPaddingTop: {
				type: 'string',
				default: '20'
			},
			BodyPaddingRight: {
				type: 'string',
				default: '25'
			},
			BodyPaddingBottom: {
				type: 'string',
				default: '20'
			},
			BodyPaddingLeft: {
				type: 'string',
				default: '25'
			},
			bodyBgColor: {
				type: 'string',
				default: '#fff'
			},
			borderWidth: {
				type: 'number',
				default: 1
			},
			borderType: {
				type: 'string',
				default: 'solid'
			},
			borderColor: {
				type: 'string',
				default: '#000'
			},
			borderRadius: {
				type: 'number',
				default: 0
			},
			fontFamily: {
				type: 'string',
				default: 'Gotham Bold'
			}
		},
		edit: (props) => {
			const { attributes, setAttributes, className } = props;
			const {
				title,
				open,
				alignment,
				headerTextFontSize,
				headerTextColor,
				titleBackgroundColor,
				PaddingTop,
				PaddingRight,
				PaddingBottom,
				PaddingLeft,
				BodyPaddingTop,
				BodyPaddingRight,
				BodyPaddingBottom,
				BodyPaddingLeft,
				bodyBgColor,
				borderWidth,
				borderType,
				borderColor,
				borderRadius,
				fontFamily
			} = attributes;

			return (
				<div className={className}>
					<div
						className={`accordionWrapper ${open ? 'tabOpen' : 'tabClose'}`}
						style={{
							border: `${borderWidth}px ${borderType} ${borderColor}`,
							borderRadius: borderRadius + 'px'
						}}
					>
						<div
							className="accordionHeader"
							style={{
								backgroundColor: titleBackgroundColor,
								paddingTop: `${PaddingTop}px`,
								paddingRight: `${PaddingRight}px`,
								paddingBottom: `${PaddingBottom}px`,
								paddingLeft: `${PaddingLeft}px`,
								margin: 0,
								position: 'relative',
								color: headerTextColor
							}}
						>
							<RichText
								tagName="h3"
								value={title}
								formattingControls={['bold', 'italic']}
								style={{
									fontSize: `${headerTextFontSize}px`,
									textAlign: alignment,
									color: headerTextColor,
									margin: 0,
									fontFamily: fontFamily
								}}
								onChange={(value) => setAttributes({ title: value })}
								placeholder={__('Question')}
							/>
							<span className="dashicons fa fa-caret-down" />
						</div>
						<div
							className="accordionBody"
							style={{
								backgroundColor: bodyBgColor,
								paddingTop: `${BodyPaddingTop}px`,
								paddingRight: `${BodyPaddingRight}px`,
								paddingBottom: `${BodyPaddingBottom}px`,
								paddingLeft: `${BodyPaddingLeft}px`,
								borderTop: `${borderWidth}px ${borderType} ${borderColor}`,
								display: open ? 'block' : 'none',
							}}
						>
							<InnerBlocks templateLock={false} />
						</div>
					</div>
					<InspectorControls>
						<PanelBody title="General Setting">
							<PanelRow>
								<ToggleControl
									label={__('This Accordion Open')}
									checked={!! open}
									onChange={() => setAttributes({ open: ! open })}
								/>
							</PanelRow>
						</PanelBody>
						<PanelBody title="Typography" initialOpen={false}>
							<PanelRow>
								<div className="inspector-field inspector-border-width">
									<RangeControl
										label={__('Heading Font Size')}
										value={headerTextFontSize}
										min="0"
										max="100"
										step="1"
										onChange={(value) => setAttributes({ headerTextFontSize: value })}
									/>
								</div>
							</PanelRow>
							<PanelRow>
								<div class="inspector-field inspector-field-fontfamily ">
									<label class="inspector-mb-0">Font Family</label>
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
											{ label: __('Vollkorn SemiBoldItalic'), value: 'Vollkorn SemiBoldItalic' }

										]}
										onChange={(value) => setAttributes({ fontFamily: value })}
									/>
								</div>
							</PanelRow>
							<PanelRow>
								<div class="inspector-field-alignment inspector-field inspector-responsive">
									<label>Alignment</label>
									<div class="inspector-field-button-list inspector-field-button-list-fluid">
										<button class=" inspector-button" onClick={() => setAttributes({ alignment: 'left' })} >
											<svg width="21" height="18" viewBox="0 0 21 18" xmlns="http://www.w3.org/2000/svg">
												<g transform="translate(-29 -4) translate(29 4)" fill="none">
													<path d="M1 .708v15.851" class="inspector-svg-stroke" stroke-linecap="square"></path>
													<rect class="inspector-svg-fill" x="5" y="5" width="16" height="7" rx="1"></rect>
												</g>
											</svg>
										</button>
										<button class=" inspector-button" onClick={() => setAttributes({ alignment: 'center' })} >
											<svg width="16" height="18" viewBox="0 0 16 18" xmlns="http://www.w3.org/2000/svg">
												<g transform="translate(-115 -4) translate(115 4)" fill="none">
													<path d="M8 .708v15.851" class="inspector-svg-stroke" stroke-linecap="square"></path>
													<rect class="inspector-svg-fill" y="5" width="16" height="7" rx="1"></rect>
												</g>
											</svg>
										</button>
										<button class=" inspector-button" onClick={() => setAttributes({ alignment: 'Right' })} >
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
							<PanelRow>
								<div class="inspector-field inspector-field-color ">
									<label class="inspector-mb-0">Text Color</label>
									<div class="inspector-ml-auto">
										<ColorPalette
											value={headerTextColor}
											onChange={(value) =>
												setAttributes({
													headerTextColor: value ? value : '#000'
												})}
										/>
									</div>
								</div>
							</PanelRow>
							<PanelRow>
								<div class="inspector-field inspector-field-color ">
									<label class="inspector-mb-0">Background Color</label>
									<div class="inspector-ml-auto">
										<ColorPalette
											value={titleBackgroundColor}
											onChange={(value) =>
												setAttributes({
													titleBackgroundColor: value ? value : '#f2f7fd'
												})}
										/>
									</div>
								</div>
							</PanelRow>
							<PanelRow>
								<div class="inspector-field inspector-field-color ">
									<label class="inspector-mb-0">Body Background</label>
									<div class="inspector-ml-auto">
										<ColorPalette
											value={bodyBgColor}
											onChange={(value) =>
												setAttributes({
													bodyBgColor: value ? value : '#fff'
												})}
										/>
									</div>
								</div>
							</PanelRow>
						</PanelBody>
						<PanelBody title="Design" initialOpen={false}>
							<PanelRow>
								<div className="inspector-field inspector-border-width">
									<RangeControl
										label={__('Border Width')}
										value={borderWidth}
										min="0"
										max="100"
										step="1"
										onChange={(value) => setAttributes({ borderWidth: value })}
									/>
								</div>
							</PanelRow>
							<PanelRow>
								<div className="inspector-field inspector-border-style" >
									<label>Border Style</label>
									<div class="inspector-field-button-list inspector-field-button-list-fluid">
										<button class=" inspector-button" onClick={() => setAttributes({ borderType: 'solid' })}><span class="inspector-field-border-type inspector-field-border-type-solid"></span></button>
										<button class=" inspector-button" onClick={() => setAttributes({ borderType: 'dotted' })}><span class="inspector-field-border-type inspector-field-border-type-dotted"></span></button>
										<button class=" inspector-button" onClick={() => setAttributes({ borderType: 'dashed' })}><span class="inspector-field-border-type inspector-field-border-type-dashed"></span></button>
										<button class=" inspector-button" onClick={() => setAttributes({ borderType: 'double' })}><span class="inspector-field-border-type inspector-field-border-type-double"></span></button>
										<button class=" inspector-button" onClick={() => setAttributes({ borderType: 'none' })}><i class="fa fa-ban"></i></button>
									</div>
								</div>
							</PanelRow>
							<PanelRow>
								<div className="inspector-field inspector-border-width">
									<RangeControl
										label={__('Border Radius')}
										value={borderRadius}
										min="0"
										max="100"
										step="1"
										onChange={(value) => setAttributes({ borderRadius: value })}
									/>
								</div>
							</PanelRow>
							<PanelRow>
								<div class="inspector-field inspector-field-color ">
									<label class="inspector-mb-0">Border Color</label>
									<div class="inspector-ml-auto"><ColorPalette
										value={borderColor}
										onChange={(value) =>
											setAttributes({
												borderColor: value ? value : '#000'
											})}
									/>
									</div>
								</div>
							</PanelRow>
						</PanelBody>

						<PanelBody title="Spacing" initialOpen={false}>
							<PanelRow>
								<div class="inspector-field inspector-field-padding">
									<label className="mt10">Heading Padding</label>
									<div className="padding-setting">
										<div className="col-main-4">
											<div className="padd-top col-main-inner" data-tooltip="padding Top">
												<TextControl
													type="number"
													min="1"
													value={PaddingTop}
													onChange={(value) => setAttributes({ PaddingTop: value })}
												/>
												<label>Top</label>
											</div>
											<div className="padd-buttom col-main-inner" data-tooltip="padding Bottom">
												<TextControl
													type="number"
													min="1"
													value={PaddingBottom}
													onChange={(value) => setAttributes({ PaddingBottom: value })}
												/>
												<label>Bottom</label>
											</div>
											<div className="padd-left col-main-inner" data-tooltip="padding Left">
												<TextControl
													type="number"
													min="1"
													value={PaddingLeft}
													onChange={(value) => setAttributes({ PaddingLeft: value })}
												/>
												<label>Left</label>
											</div>
											<div className="padd-right col-main-inner" data-tooltip="padding Right">
												<TextControl
													type="number"
													min="1"
													value={PaddingRight}
													onChange={(value) => setAttributes({ PaddingRight: value })}
												/>
												<label>Right</label>
											</div>
										</div>
									</div>
								</div>
							</PanelRow>
							<PanelRow>
								<div class="inspector-field inspector-field-padding">
									<label className="mt10">Body Padding</label>
									<div className="padding-setting">
										<div className="col-main-4">
											<div className="padd-top col-main-inner" data-tooltip="padding Top">
												<TextControl
													type="number"
													min="1"
													value={BodyPaddingTop}
													onChange={(value) => setAttributes({ BodyPaddingTop: value })}
												/>
												<label>Top</label>
											</div>
											<div className="padd-buttom col-main-inner" data-tooltip="padding Bottom">
												<TextControl
													type="number"
													min="1"
													value={BodyPaddingBottom}
													onChange={(value) => setAttributes({ BodyPaddingBottom: value })}
												/>
												<label>Bottom</label>
											</div>
											<div className="padd-left col-main-inner" data-tooltip="padding Left">
												<TextControl
													type="number"
													min="1"
													value={BodyPaddingLeft}
													onChange={(value) => setAttributes({ BodyPaddingLeft: value })}
												/>
												<label>Left</label>
											</div>
											<div className="padd-right col-main-inner" data-tooltip="padding Right">
												<TextControl
													type="number"
													min="1"
													value={BodyPaddingRight}
													onChange={(value) => setAttributes({ BodyPaddingRight: value })}
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
		save: (props) => {
			const { attributes, className } = props;
			const {
				title,
				open,
				alignment,
				headerTextFontSize,
				headerTextColor,
				titleBackgroundColor,
				PaddingTop,
				PaddingRight,
				PaddingBottom,
				PaddingLeft,
				BodyPaddingTop,
				BodyPaddingRight,
				BodyPaddingBottom,
				BodyPaddingLeft,
				bodyBgColor,
				borderWidth,
				borderType,
				borderColor,
				borderRadius,
				fontFamily
			} = attributes;
			const bodyDisplay = open ? 'block' : 'none';
			return (
				<div
					className={`accordionWrapper ${open ? 'tabOpen' : 'tabClose'}`}
					style={{
						border: `${borderWidth}px ${borderType} ${borderColor}`,
						borderRadius: borderRadius + 'px'
					}}
				>
					<div
						className="accordionHeader"
						style={{
							backgroundColor: titleBackgroundColor,
							paddingTop: `${PaddingTop}px`,
							paddingRight: `${PaddingRight}px`,
							paddingBottom: `${PaddingBottom}px`,
							paddingLeft: `${PaddingLeft}px`,
							color: headerTextColor,
							margin: 0,
							position: 'relative'
						}}
					>
						<RichText.Content
							tagName="h3"
							value={title}
							style={{
								fontSize: `${headerTextFontSize}px`,
								textAlign: alignment,
								color: headerTextColor,
								margin: 0,
								fontFamily: fontFamily
							}}
						/>
						<span className="dashicons fa fa-caret-down" />
					</div>
					<div
						className="accordionBody"
						style={{
							backgroundColor: bodyBgColor,
							display: bodyDisplay,
							paddingTop: `${BodyPaddingTop}px`,
							paddingRight: `${BodyPaddingRight}px`,
							paddingBottom: `${BodyPaddingBottom}px`,
							paddingLeft: `${BodyPaddingLeft}px`,
							borderTop: `${borderWidth}px ${borderType} ${borderColor}`,
						}}
					>
						<InnerBlocks.Content />
					</div>
				</div>
			);
		},
	});
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);
