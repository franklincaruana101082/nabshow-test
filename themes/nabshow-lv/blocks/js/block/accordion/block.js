import times from 'lodash/times';
import memoize from 'memize';

(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
	const { __ } = wpI18n;
	const { Fragment } = wpElement;
	const { registerBlockType } = wpBlocks;
	const { RichText, InspectorControls, InnerBlocks } = wpEditor;
	const { TextControl, PanelBody, PanelRow, RangeControl, SelectControl, ToggleControl, ColorPalette, IconButton } = wpComponents;

	jQuery(document).on('click', '.accordionParentWrapper .accordionWrapper .accordionHeader .dashicons', function (e) {
		e.stopImmediatePropagation();
    jQuery(this).parent().parent().siblings().find('.accordionBody').slideUp();
		jQuery(this).parent().next().slideToggle();
		if (jQuery(this).parent().parent('.accordionWrapper').hasClass('tabClose')) {
			jQuery(this).parent().parent('.accordionWrapper').removeClass('tabClose').addClass('tabOpen');
			jQuery(this).parent().parent('.accordionWrapper').siblings().removeClass('tabOpen').addClass('tabClose');
		} else {
			jQuery(this).parent().parent('.accordionWrapper').removeClass('tabOpen').addClass('tabClose');
		}
	});

	const ALLOWBLOCKS = ['nab/accordion-item'];

	const removehildawardsBlock = memoize((accordion) => {
		return times(accordion, (n) => ['nab/accordion-item', { id: n - 1 }]);
	});

	const accordionBlockIcon = (
		<svg width="150px" height="150px" viewBox="0 0 150 150" enable-background="new 0 0 150 150">
			<path fill="#146DB6" d="M1,38.563v73.625h147.25V38.563H1z M139.047,102.984H10.203V66.172h128.844V102.984z" />
			<path fill="#146DB6" d="M1,1.75h147.25v27.609H1V1.75z" />
			<path fill="#146DB6" d="M1,121.391h147.25V149H1V121.391z" />
		</svg>
	);

	/* Parent Accordion Block */
	registerBlockType('nab/accordion', {
		title: __('Accordion'),
		description: __('Accordion is a gutenberg block used to show & hide content.'),
		icon: { src: accordionBlockIcon },
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
			},
			showFilter: {
				type: 'boolean',
				default: false
			}
		},
		edit: (props) => {
			const { attributes: { noOfAccordion, showTitle, title, showFilter }, className, setAttributes, clientId } = props;

			setAttributes({ blockId: clientId });

			jQuery(document).on('click', `#block-${clientId} .remove-button`, function (e) {
				if ('' !== jQuery(this).parents(`#block-${clientId}`)) {
					setAttributes({ noOfAccordion: noOfAccordion - 1 });
					removehildawardsBlock(noOfAccordion);
				}
			});

			return (
				<Fragment>
					<InspectorControls>
						<PanelBody title="General Settings">
							<PanelRow>
								<ToggleControl
									label={__('Show Title')}
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
						<div className="fab-filter main-filter">
							<div className="search-box">
								<label>Keyword</label>
								<div className="search-item">
									<input id="box-main-search" className="search" name="faq-search" type="text" placeholder="Filter by keyword..." />
								</div>
							</div>
							<div className="keyword">
								<label>Category</label>
								<div>
									<select id="faq-category-drp" className="faq-category-drp">
										<option value="">Select One</option>
									</select>
								</div>
							</div>
						</div>
					}
					<div id={clientId} className={'accordionParentWrapper' + ' ' + className} data-category={title} >
						{
							showTitle ? (
								<RichText
									tagName="h2"
									onChange={(value) => setAttributes({ title: value })}
									placeholder={__('Category')}
									value={title}
									className="title"
								/>) : ''
						}
						<InnerBlocks
							allowedBlocks={ALLOWBLOCKS}
						/>
					</div>
				</Fragment>
			);
		},
		save: (props) => {
			const { attributes: { title, showTitle, showFilter }, clientId } = props;
			return (
				<Fragment>
					{showFilter &&
						<div className="fab-filter main-filter">
							<div className="search-box">
								<label>Keyword</label>
								<div className="search-item">
									<input id="box-main-search" className="search" name="faq-search" type="text" placeholder="Filter by keyword..." />
								</div>
							</div>
							<div className="keyword">
								<label>Category</label>
								<div>
									<select id="faq-category-drp" className="faq-category-drp">
										<option value="">Select One</option>
									</select>
								</div>
							</div>
						</div>
					}
					<div id={clientId} className={'accordionParentWrapper'} data-category={title}>
						{
							showTitle && title ? (
								<RichText.Content
									tagName="h2"
									value={title}
									className="title"
								/>) : ''
						}
						<InnerBlocks.Content />
					</div >
				</Fragment>
			);
		}
	});

	/* Accordion Block */
	registerBlockType('nab/accordion-item', {
		title: __('Accordion Items'),
		description: __('This is nab accordion block with multiple setting.'),
		icon: { src: accordionBlockIcon },
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
				default: 16
			},
			headerTextColor: {
				type: 'string',
				default: '#fff'
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
				default: '#fff'
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
			const { attributes, setAttributes, className, clientId } = props;
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
						<span className="remove-button">
							<IconButton
								className="components-toolbar__control"
								label={__('Remove image')}
								icon="no"
								onClick={() => {
									wp.data.dispatch('core/editor').removeBlocks(clientId);
								}}
							/>
						</span>
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
						<PanelBody title="Typography">
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
								<div className="inspector-field inspector-field-fontfamily ">
									<label className="inspector-mb-0">Font Family</label>
									<SelectControl
										value={fontFamily}
										options={[
											{ label: __('Molot'), value: 'Molot' },
											{ label: __('Roboto Regular'), value: 'Roboto Regular' },
											{ label: __('Roboto Black'), value: 'Roboto Black' },
											{ label: __('Roboto Bold'), value: 'Roboto Bold' },
											{ label: __('Roboto BoldItalic'), value: 'Roboto BoldItalic' },
											{ label: __('Roboto Italic'), value: 'Roboto Italic' },
											{ label: __('Roboto Light'), value: 'Roboto Light' },
											{ label: __('Roboto Medium'), value: 'Roboto Medium' },
											{ label: __('Roboto Thin'), value: 'Roboto Thin' },
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

										]}
										onChange={(value) => setAttributes({ fontFamily: value })}
									/>
								</div>
							</PanelRow>
							<PanelRow>
								<div className="inspector-field-alignment inspector-field inspector-responsive">
									<label>Alignment</label>
									<div className="inspector-field-button-list inspector-field-button-list-fluid">
										<button className={'left' === alignment ? 'active inspector-button' : ' inspector-button'} onClick={() => setAttributes({ alignment: 'left' })} >
											<svg width="21" height="18" viewBox="0 0 21 18" xmlns="http://www.w3.org/2000/svg">
												<g transform="translate(-29 -4) translate(29 4)" fill="none">
													<path d="M1 .708v15.851" className="inspector-svg-stroke" stroke-linecap="square"></path>
													<rect className="inspector-svg-fill" x="5" y="5" width="16" height="7" rx="1"></rect>
												</g>
											</svg>
										</button>
										<button className={'center' === alignment ? 'active inspector-button' : ' inspector-button'} onClick={() => setAttributes({ alignment: 'center' })} >
											<svg width="16" height="18" viewBox="0 0 16 18" xmlns="http://www.w3.org/2000/svg">
												<g transform="translate(-115 -4) translate(115 4)" fill="none">
													<path d="M8 .708v15.851" className="inspector-svg-stroke" stroke-linecap="square"></path>
													<rect className="inspector-svg-fill" y="5" width="16" height="7" rx="1"></rect>
												</g>
											</svg>
										</button>
										<button className={'Right' === alignment ? 'active inspector-button' : ' inspector-button'} onClick={() => setAttributes({ alignment: 'Right' })} >
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
								<div className="inspector-field inspector-field-color ">
									<label className="inspector-mb-0">Text Color</label>
									<div className="inspector-ml-auto">
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
								<div className="inspector-field inspector-field-color ">
									<label className="inspector-mb-0">Background Color</label>
									<div className="inspector-ml-auto">
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
								<div className="inspector-field inspector-field-color ">
									<label className="inspector-mb-0">Body Background</label>
									<div className="inspector-ml-auto">
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
									<div className="inspector-field-button-list inspector-field-button-list-fluid">
										<button className={'solid' === borderType ? 'active inspector-button' : ' inspector-button'} onClick={() => setAttributes({ borderType: 'solid' })}><span className="inspector-field-border-type inspector-field-border-type-solid"></span></button>
										<button className={'dotted' === borderType ? 'active inspector-button' : ' inspector-button'} onClick={() => setAttributes({ borderType: 'dotted' })}><span className="inspector-field-border-type inspector-field-border-type-dotted"></span></button>
										<button className={'dashed' === borderType ? 'active inspector-button' : ' inspector-button'} onClick={() => setAttributes({ borderType: 'dashed' })}><span className="inspector-field-border-type inspector-field-border-type-dashed"></span></button>
										<button className={'double' === borderType ? 'active inspector-button' : ' inspector-button'} onClick={() => setAttributes({ borderType: 'double' })}><span className="inspector-field-border-type inspector-field-border-type-double"></span></button>
										<button className={'none' === borderType ? 'active inspector-button' : ' inspector-button'} onClick={() => setAttributes({ borderType: 'none' })}><i className="fa fa-ban"></i></button>
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
								<div className="inspector-field inspector-field-color ">
									<label className="inspector-mb-0">Border Color</label>
									<div className="inspector-ml-auto"><ColorPalette
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
								<div className="inspector-field inspector-field-padding">
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
								<div className="inspector-field inspector-field-padding">
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
			const { attributes } = props;
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
				<Fragment>
					{
						title && (
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
						)
					}
				</Fragment>
			);
		},
	});
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);
