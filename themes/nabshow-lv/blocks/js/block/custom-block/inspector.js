const { __ } = wp.i18n;
const { Fragment, Component } = wp.element;
const { MediaUpload, InspectorControls, } = wp.editor;
const { TextControl, PanelBody, PanelRow, RangeControl, SelectControl, ToggleControl, Button, ColorPalette, } = wp.components;

/**
 * Create an Inspector Controls wrapper Component
 */
export default class Inspector extends Component {
	render() {

		const onSelectLayout = (event) => {
			const selectedLayout = event.target.value;
			const selectedClass = event.target.className;
			'components-button button has-tooltip active' === selectedClass && this.props.setAttributes({ layout: '' });
			'components-button button has-tooltip active' !== selectedClass &&
				this.props.setAttributes({ layout: selectedLayout ? selectedLayout : '' });
		};

		return (
			<InspectorControls>
				<div className="custom-inspactor-setting">
					<div className="full-width mt30">
						<ToggleControl
							label={__('Toggle Inserter')}
							checked={!! this.props.attributes.ToggleInserter}
							onChange={() => this.props.setAttributes({ ToggleInserter: ! this.props.attributes.ToggleInserter })}
						/>
					</div>
					<PanelBody title={__('Wrapper')} initialOpen={false}>
						<TextControl
							label="Wrapper Tag ID Attribute"
							type="string"
							placeHolder="id"
							value={this.props.attributes.elementID}
							onChange={(value) => this.props.setAttributes({ elementID: value })}
						/>
						<ToggleControl
							label={__('Show Block Title')}
							checked={!! this.props.attributes.showTitle}
							onChange={() => {
								this.props.setAttributes({ showTitle: ! this.props.attributes.showTitle });
							}}
						/>
					</PanelBody>
					<PanelBody title={__('Page layout')} initialOpen={false}>
						<Button
							className={'full' === this.props.attributes.layout ? 'button has-tooltip active' : 'button has-tooltip'}
							onClick={onSelectLayout}
							data-tooltip="This layout is for full width (width:100%)."
							value="full"
						>
							{__('Full Width')}
						</Button>
						<Button
							className={'fixed' === this.props.attributes.layout ? 'button has-tooltip active' : 'button has-tooltip'}
							onClick={onSelectLayout}
							data-tooltip="This layout is for fixed width (width:1200px)."
							value="fixed"
						>
							{__('Fixed')}
						</Button>
					</PanelBody>
					<PanelBody title={__('Background')} initialOpen={false} className="bg-setting">
						<PanelBody title={__('Background Image')} initialOpen={false} className="bg-setting bg-img-setting">
							<MediaUpload
								onSelect={backgroundImage => this.props.setAttributes({
									backgroundImage: backgroundImage.sizes.full.url ? backgroundImage.sizes.full.url : '',
									backgroundColor: ''
								})}
								type="image"
								value={this.props.attributes.backgroundImage}
								render={({ open }) => (
									<Button
										className={this.props.attributes.backgroundImage ? 'image-button' : 'button button-large'}
										onClick={open}>
										{! this.props.attributes.backgroundImage ? __('Upload Image') :
											<div style={{
												backgroundImage: `url(${this.props.attributes.backgroundImage})`,
												backgroundSize: 'cover',
												backgroundPosition: 'center',
												height: '150px',
												width: '225px'
											}}>
											</div>}
									</Button>
								)}
							/>
							{this.props.attributes.backgroundImage ? <Button
								className="button"
								onClick={() => this.props.setAttributes({ backgroundImage: '', overlayColor: '' })}>
								{__('Remove Background Image')}
							</Button> : null
							}
							{this.props.attributes.backgroundImage && (
								<Fragment>
									<ToggleControl
										label={__('Background Size ON - Set background size "Cover"')}
										checked={this.props.attributes.backgroundSize}
										onChange={() => this.props.setAttributes({ backgroundSize: ! this.props.attributes.backgroundSize })}
									/>
									<ToggleControl
										label={__('Background Attachment ON - Set background attachment "Fixed" ')}
										checked={this.props.attributes.backgroundAttachment}
										onChange={() => this.props.setAttributes({ backgroundAttachment: ! this.props.attributes.backgroundAttachment })}
									/>
									<SelectControl
										label={__('Select Position')}
										value={this.props.attributes.backgroundPosition}
										options={[
											{ label: __('Bottom'), value: 'bottom' },
											{ label: __('Center'), value: 'center' },
											{ label: __('Inherit'), value: 'inherit' },
											{ label: __('Initial'), value: 'initial' },
											{ label: __('Left'), value: 'left' },
											{ label: __('Right'), value: 'right' },
											{ label: __('Top'), value: 'top' },
											{ label: __('Unset'), value: 'unset' },
										]}
										onChange={(value) => this.props.setAttributes({ backgroundPosition: value })}
									/>
									<div className="inspector-field inspector-field-color components-base-control">
										<label className="inspector-mb-0">Overlay</label>
										<div className="inspector-ml-auto">
											<ColorPalette
												value={this.props.attributes.overlayColor}
												onChange={(value) => this.props.setAttributes({ overlayColor: value })}
											/>
										</div>
									</div>
									<div className="inspector-field inspector-border-radius components-base-control">
										<label>Background Opacity</label>
										<RangeControl
											value={this.props.attributes.opacity}
											min={0}
											max={100}
											step={10}
											onChange={(ratio) => this.props.setAttributes({ opacity: ratio })}
										/>
									</div>
								</Fragment>
							)}
						</PanelBody>
						{(
							<PanelBody title={__('Background Color')} initialOpen={false} className="bg-setting">
								<PanelRow>
									<div className="inspector-field inspector-field-color ">
										<label className="inspector-mb-0">Background Color</label>
										<div className="inspector-ml-auto">
											<ColorPalette
												value={this.props.attributes.backgroundColor}
												onChange={(value) => this.props.setAttributes({ backgroundColor: value ? value : '', opacity: 0 })}
											/>
										</div>
									</div>
								</PanelRow>
							</PanelBody>
						)}
						<PanelBody title={__('Gradient Background')} initialOpen={false} className="bg-setting gredient-setting">
							<SelectControl
								label={__('Select Gradient Type')}
								value={this.props.attributes.gradientType}
								options={[
									{ label: __('Select Type'), value: '' },
									{ label: __('bottom'), value: 'to bottom' },
									{ label: __('Top'), value: 'to top' },
									{ label: __('Right'), value: 'to right' },
									{ label: __('Left'), value: 'to left' },
									{ label: __('Top Left'), value: 'to top left' },
									{ label: __('Bottom Left'), value: 'to bottom left' },
									{ label: __('Top Right'), value: 'to top right' },
									{ label: __('Bottom Right'), value: 'to bottom right' },
								]}
								onChange={(value) => this.props.setAttributes({ gradientType: value })}
							/>
							{this.props.attributes.gradientType && (
								<Fragment>
									<h3>{__('Gradient Fill 1')}</h3>
									<div className="inspector-field inspector-field-color components-base-control gradientcolor">
										<label className="inspector-mb-0">Color</label>
										<div className="inspector-ml-auto">
											<ColorPalette
												value={this.props.attributes.color1}
												onChange={(value) => this.props.setAttributes({ color1: value ? value : '#fff' })}
											/>
										</div>
									</div>
									<div className="inspector-field inspector-border-radius components-base-control">
										<label>Range</label>
										<RangeControl
											value={this.props.attributes.gradientRange1}
											min={0}
											max={100}
											step={10}
											onChange={(value) => this.props.setAttributes({ gradientRange1: value })}
										/>
									</div>
									<h3>{__('Gradient Fill 2')}</h3>
									<div className="inspector-field inspector-field-color components-base-control gradientcolor">
										<label className="inspector-mb-0">Color</label>
										<div className="inspector-ml-auto">
											<ColorPalette
												value={this.props.attributes.color2}
												onChange={(value) => this.props.setAttributes({ color2: value ? value : '#fff' })}
											/>
										</div>
									</div>
									<div className="inspector-field inspector-border-radius components-base-control">
										<label>Range</label>
										<RangeControl
											value={this.props.attributes.gradientRange2}
											min={0}
											max={100}
											step={10}
											onChange={(value) => this.props.setAttributes({ gradientRange2: value })}
										/>
									</div>
									<h3>{__('Gradient Fill 3')}</h3>
									<div className="inspector-field inspector-field-color components-base-control gradientcolor">
										<label className="inspector-mb-0">Color</label>
										<div className="inspector-ml-auto">
											<ColorPalette
												value={this.props.attributes.color3}
												onChange={(value) => this.props.setAttributes({ color3: value ? value : '#fff' })}
											/>
										</div>
									</div>
									<div className="inspector-field inspector-border-radius components-base-control">
										<label>Range</label>
										<RangeControl
											value={this.props.attributes.gradientRange3}
											min={0}
											max={100}
											step={10}
											onChange={(value) => this.props.setAttributes({ gradientRange3: value })}
										/>
									</div>
								</Fragment>
							)}
						</PanelBody>
					</PanelBody>
					<PanelBody title={__('Border')} initialOpen={false} className="border-setting">
						<PanelBody title={__('All Border')} initialOpen={false} className="border-setting">
							<PanelRow>
								<div className="inspector-field inspector-border-style" >
									<label>Border Style</label>
									<div className="inspector-field-button-list inspector-field-button-list-fluid">
										<button className={'solid' === this.props.attributes.borderStyle ? 'active inspector-button' : ' inspector-button'} onClick={() => this.props.setAttributes({ borderStyle: 'solid' })}><span className="inspector-field-border-type inspector-field-border-type-solid"></span></button>
										<button className={'dotted' === this.props.attributes.borderStyle ? 'active inspector-button' : ' inspector-button'} onClick={() => this.props.setAttributes({ borderStyle: 'dotted' })}><span className="inspector-field-border-type inspector-field-border-type-dotted"></span></button>
										<button className={'dashed' === this.props.attributes.borderStyle ? 'active inspector-button' : ' inspector-button'} onClick={() => this.props.setAttributes({ borderStyle: 'dashed' })}><span className="inspector-field-border-type inspector-field-border-type-dashed"></span></button>
										<button className={'none' === this.props.attributes.borderStyle ? 'active inspector-button' : ' inspector-button'} onClick={() => this.props.setAttributes({ borderStyle: 'none' })}><span className="inspector-field-border-type inspector-field-border-type-none"><i className="fa fa-ban"></i></span></button>
									</div>
								</div>
							</PanelRow>
							{this.props.attributes.borderStyle && (
								<Fragment>
									<PanelRow>
										<div className="inspector-field inspector-field-color ">
											<label className="inspector-mb-0">Color</label>
											<div className="inspector-ml-auto">
												<ColorPalette
													value={this.props.attributes.borderColor}
													onChange={borderColor => this.props.setAttributes({ borderColor: borderColor })}
												/>
											</div>
										</div>
									</PanelRow>
									<PanelRow>
										<div className="inspector-field inspector-border-width" >
											<label>Border Width</label>
											<RangeControl
												value={this.props.attributes.borderWidth ? this.props.attributes.borderWidth : 0}
												min={0}
												max={10}
												onChange={(value) => this.props.setAttributes({ borderWidth: value })}
											/>
										</div>
									</PanelRow>
									<PanelRow>
										<div className="inspector-field inspector-border-width" >
											<label>Border Radius</label>
											<RangeControl
												value={this.props.attributes.borderRadius ? this.props.attributes.borderRadius : 0}
												min={0}
												max={100}
												onChange={(value) => this.props.setAttributes({ borderRadius: value })}
											/>
										</div>
									</PanelRow>
								</Fragment>
							)}
						</PanelBody>
						{! this.props.attributes.borderStyle && (
							<PanelBody title={__('Top Border')} initialOpen={false} className="border-setting">
								<PanelRow>
									<div className="inspector-field inspector-border-style" >
										<label>Border Style</label>
										<div className="inspector-field-button-list inspector-field-button-list-fluid">
											<button className={'solid' === this.props.attributes.topBorderStyle ? 'active inspector-button' : ' inspector-button'} onClick={() => this.props.setAttributes({ topBorderStyle: 'solid' })}><span className="inspector-field-border-type inspector-field-border-type-solid"></span></button>
											<button className={'dotted' === this.props.attributes.topBorderStyle ? 'active inspector-button' : ' inspector-button'} onClick={() => this.props.setAttributes({ topBorderStyle: 'dotted' })}><span className="inspector-field-border-type inspector-field-border-type-dotted"></span></button>
											<button className={'dashed' === this.props.attributes.topBorderStyle ? 'active inspector-button' : ' inspector-button'} onClick={() => this.props.setAttributes({ topBorderStyle: 'dashed' })}><span className="inspector-field-border-type inspector-field-border-type-dashed"></span></button>
											<button className={'none' === this.props.attributes.topBorderStyle ? 'active inspector-button' : ' inspector-button'} onClick={() => this.props.setAttributes({ borderStyle: 'none' })}><span className="inspector-field-border-type inspector-field-border-type-none"><i className="fa fa-ban"></i></span></button>
										</div>
									</div>
								</PanelRow>
								{this.props.attributes.topBorderStyle && (
									<Fragment>
										<PanelRow>
											<div className="inspector-field inspector-field-color ">
												<label className="inspector-mb-0">Color</label>
												<div className="inspector-ml-auto">
													<ColorPalette
														value={this.props.attributes.topBorderColor}
														onChange={topBorderColor => this.props.setAttributes({ topBorderColor: topBorderColor })}
													/>
												</div>
											</div>
										</PanelRow>
										<PanelRow>
											<div className="inspector-field inspector-border-width" >
												<label>Border Width</label>
												<RangeControl
													value={this.props.attributes.topBorderWidth ? this.props.attributes.topBorderWidth : 0}
													min={0}
													max={10}
													onChange={(value) => this.props.setAttributes({ topBorderWidth: value })}
												/>
											</div>
										</PanelRow>
										<PanelRow>
											<div className="inspector-field inspector-border-width" >
												<label>Border Radius</label>
												<RangeControl
													value={this.props.attributes.topBorderRadius ? this.props.attributes.topBorderRadius : 0}
													min={0}
													max={100}
													onChange={(value) => this.props.setAttributes({ topBorderRadius: value })}
												/>
											</div>
										</PanelRow>
									</Fragment>
								)}
							</PanelBody>
						)}
						{! this.props.attributes.borderStyle && (
							<PanelBody title={__('Right Border')} initialOpen={false} className="border-setting">
								<PanelRow>
									<div className="inspector-field inspector-border-style" >
										<label>Border Style</label>
										<div className="inspector-field-button-list inspector-field-button-list-fluid">
											<button className={'solid' === this.props.attributes.rightBorderStyle ? 'active inspector-button' : ' inspector-button'} onClick={() => this.props.setAttributes({ rightBorderStyle: 'solid' })}><span className="inspector-field-border-type inspector-field-border-type-solid"></span></button>
											<button className={'dotted' === this.props.attributes.rightBorderStyle ? 'active inspector-button' : ' inspector-button'} onClick={() => this.props.setAttributes({ rightBorderStyle: 'dotted' })}><span className="inspector-field-border-type inspector-field-border-type-dotted"></span></button>
											<button className={'dashed' === this.props.attributes.rightBorderStyle ? 'active inspector-button' : ' inspector-button'} onClick={() => this.props.setAttributes({ rightBorderStyle: 'dashed' })}><span className="inspector-field-border-type inspector-field-border-type-dashed"></span></button>
											<button className={'none' === this.props.attributes.rightBorderStyle ? 'active inspector-button' : ' inspector-button'} onClick={() => this.props.setAttributes({ borderStyle: 'none' })}><span className="inspector-field-border-type inspector-field-border-type-none"><i className="fa fa-ban"></i></span></button>
										</div>
									</div>
								</PanelRow>
								{this.props.attributes.rightBorderStyle && (
									<Fragment>
										<PanelRow>
											<div className="inspector-field inspector-field-color ">
												<label className="inspector-mb-0">Color</label>
												<div className="inspector-ml-auto">
													<ColorPalette
														value={this.props.attributes.rightBorderColor}
														onChange={rightBorderColor => this.props.setAttributes({ rightBorderColor: rightBorderColor })}
													/>
												</div>
											</div>
										</PanelRow>
										<PanelRow>
											<div className="inspector-field inspector-border-width" >
												<label>Border Width</label>
												<RangeControl
													value={this.props.attributes.rightBorderWidth ? this.props.attributes.rightBorderWidth : 0}
													min={0}
													max={10}
													onChange={(value) => this.props.setAttributes({ rightBorderWidth: value })}
												/>
											</div>
										</PanelRow>
										<PanelRow>
											<div className="inspector-field inspector-border-width" >
												<label>Border Radius</label>
												<RangeControl
													value={this.props.attributes.rightBorderRadius ? this.props.attributes.rightBorderRadius : 0}
													min={0}
													max={100}
													onChange={(value) => this.props.setAttributes({ rightBorderRadius: value })}
												/>
											</div>
										</PanelRow>
									</Fragment>
								)}
							</PanelBody>
						)}
						{! this.props.attributes.borderStyle && (
							<PanelBody title={__('Bottom Border')} initialOpen={false} className="border-setting">
								<PanelRow>
									<div className="inspector-field inspector-border-style" >
										<label>Border Style</label>
										<div className="inspector-field-button-list inspector-field-button-list-fluid">
											<button className={'solid' === this.props.attributes.bottomBorderStyle ? 'active inspector-button' : ' inspector-button'} onClick={() => this.props.setAttributes({ bottomBorderStyle: 'solid' })}><span className="inspector-field-border-type inspector-field-border-type-solid"></span></button>
											<button className={'dotted' === this.props.attributes.bottomBorderStyle ? 'active inspector-button' : ' inspector-button'} onClick={() => this.props.setAttributes({ bottomBorderStyle: 'dotted' })}><span className="inspector-field-border-type inspector-field-border-type-dotted"></span></button>
											<button className={'dashed' === this.props.attributes.bottomBorderStyle ? 'active inspector-button' : ' inspector-button'} onClick={() => this.props.setAttributes({ bottomBorderStyle: 'dashed' })}><span className="inspector-field-border-type inspector-field-border-type-dashed"></span></button>
											<button className={'none' === this.props.attributes.bottomBorderStyle ? 'active inspector-button' : ' inspector-button'} onClick={() => this.props.setAttributes({ borderStyle: 'none' })}><span className="inspector-field-border-type inspector-field-border-type-none"><i className="fa fa-ban"></i></span></button>
										</div>
									</div>
								</PanelRow>
								{this.props.attributes.bottomBorderStyle && (
									<Fragment>
										<PanelRow>
											<div className="inspector-field inspector-field-color ">
												<label className="inspector-mb-0">Color</label>
												<div className="inspector-ml-auto">
													<ColorPalette
														value={this.props.attributes.bottomBorderColor}
														onChange={bottomBorderColor => this.props.setAttributes({ bottomBorderColor: bottomBorderColor })}
													/>
												</div>
											</div>
										</PanelRow>
										<PanelRow>
											<div className="inspector-field inspector-border-width" >
												<label>Border Width</label>
												<RangeControl
													value={this.props.attributes.bottomBorderWidth ? this.props.attributes.bottomBorderWidth : 0}
													min={0}
													max={10}
													onChange={(value) => this.props.setAttributes({ bottomBorderWidth: value })}
												/>
											</div>
										</PanelRow>
										<PanelRow>
											<div className="inspector-field inspector-border-width" >
												<label>Border Radius</label>
												<RangeControl
													value={this.props.attributes.bottomBorderRadius ? this.props.attributes.bottomBorderRadius : 0}
													min={0}
													max={100}
													onChange={(value) => this.props.setAttributes({ bottomBorderRadius: value })}
												/>
											</div>
										</PanelRow>
									</Fragment>
								)}
							</PanelBody>
						)}
						{! this.props.attributes.borderStyle && (
							<PanelBody title={__('Left Border')} initialOpen={false} className="border-setting">
								<PanelRow>
									<div className="inspector-field inspector-border-style" >
										<label>Border Style</label>
										<div className="inspector-field-button-list inspector-field-button-list-fluid">
											<button className={'solid' === this.props.attributes.leftBorderStyle ? 'active inspector-button' : ' inspector-button'} onClick={() => this.props.setAttributes({ leftBorderStyle: 'solid' })}><span className="inspector-field-border-type inspector-field-border-type-solid"></span></button>
											<button className={'dotted' === this.props.attributes.leftBorderStyle ? 'active inspector-button' : ' inspector-button'} onClick={() => this.props.setAttributes({ leftBorderStyle: 'dotted' })}><span className="inspector-field-border-type inspector-field-border-type-dotted"></span></button>
											<button className={'dashed' === this.props.attributes.leftBorderStyle ? 'active inspector-button' : ' inspector-button'} onClick={() => this.props.setAttributes({ leftBorderStyle: 'dashed' })}><span className="inspector-field-border-type inspector-field-border-type-dashed"></span></button>
											<button className={'none' === this.props.attributes.leftBorderStyle ? 'active inspector-button' : ' inspector-button'} onClick={() => this.props.setAttributes({ borderStyle: 'none' })}><span className="inspector-field-border-type inspector-field-border-type-none"><i className="fa fa-ban"></i></span></button>
										</div>
									</div>
								</PanelRow>
								{this.props.attributes.leftBorderStyle && (
									<Fragment>
										<PanelRow>
											<div className="inspector-field inspector-field-color ">
												<label className="inspector-mb-0">Color</label>
												<div className="inspector-ml-auto">
													<ColorPalette
														value={this.props.attributes.leftBorderColor}
														onChange={leftBorderColor => this.props.setAttributes({ leftBorderColor: leftBorderColor })}
													/>
												</div>
											</div>
										</PanelRow>
										<PanelRow>
											<div className="inspector-field inspector-border-width" >
												<label>Border Width</label>
												<RangeControl
													value={this.props.attributes.leftBorderWidth ? this.props.attributes.leftBorderWidth : 0}
													min={1}
													max={10}
													onChange={(value) => this.props.setAttributes({ leftBorderWidth: value })}
												/>
											</div>
										</PanelRow>
										<PanelRow>
											<div className="inspector-field inspector-border-width" >
												<label>Border Radius</label>
												<RangeControl
													value={this.props.attributes.leftBorderRadius ? this.props.attributes.leftBorderRadius : 0}
													min={0}
													max={100}
													onChange={(value) => this.props.setAttributes({ leftBorderRadius: value })}
												/>
											</div>
										</PanelRow>
									</Fragment>
								)}
							</PanelBody>
						)}
					</PanelBody>
					<PanelBody title={__('Dimensions')} initialOpen={false}>
						<PanelRow>
							<div className="inspector-field alignment-settings">
								<div className="alignment-wrapper">
									<TextControl
										label="Width"
										type="number"
										placeHolder="Width (%)"
										value={this.props.attributes.width}
										min="1"
										max="100"
										step="1"
										onChange={(value) => this.props.setAttributes({ width: value })}
									/>
								</div>
								<div className="alignment-wrapper">
									<TextControl
										label="Height"
										type="number"
										min="1"
										placeHolder="Height (px)"
										value={this.props.attributes.height}
										onChange={(value) => this.props.setAttributes({ height: value })}
									/>
								</div>
							</div>
						</PanelRow>
						<PanelRow>
							<div className="inspector-field inspector-field-alignment">
								<label className="inspector-mb-0">Alignment</label>
								<div className="inspector-field-button-list inspector-field-button-list-fluid">
									<button className={'left' === this.props.attributes.textAlign ? 'active inspector-button' : ' inspector-button'} onClick={() => this.props.setAttributes({ textAlign: 'left' })}><i className="fa fa-align-left"></i></button>
									<button className={'center' === this.props.attributes.textAlign ? 'active inspector-button' : ' inspector-button'} onClick={() => this.props.setAttributes({ textAlign: 'center' })}><i className="fa fa-align-center"></i></button>
									<button className={'right' === this.props.attributes.textAlign ? 'active inspector-button' : ' inspector-button'} onClick={() => this.props.setAttributes({ textAlign: 'right' })}><i className="fa fa-align-right"></i></button>
								</div>
							</div>
						</PanelRow>
						<PanelRow>
							<div className="inspector-field-alignment inspector-field inspector-responsive inspector-bottom-20">
								<label>Vertical  Alignment</label>
								<div className="inspector-field-button-list inspector-field-button-list-fluid">
									<button className={'flex-start' === this.props.attributes.vAlign ? 'active inspector-button' : ' inspector-button'} onClick={() => this.props.setAttributes({ vAlign: 'flex-start' })} >
										<svg width="16" height="16" viewBox="0 0 16 16">
											<g transform="translate(1)" fill="none">
												<rect className="inspector-svg-fill" x="4" y="4" width="6" height="12" rx="1"></rect>
												<path className="inspector-svg-stroke" d="M0 1h14" stroke-width="2" stroke-linecap="square"></path>
											</g>
										</svg>
									</button>
									<button className={'center' === this.props.attributes.vAlign ? 'active inspector-button' : ' inspector-button'} onClick={() => this.props.setAttributes({ vAlign: 'center' })} >
										<svg width="16" height="18" viewBox="0 0 16 18">
											<g transform="translate(-115 -4) translate(115 4)" fill="none">
												<path d="M8 .708v15.851" className="inspector-svg-stroke" stroke-linecap="square"></path>
												<rect className="inspector-svg-fill" y="5" width="16" height="7" rx="1"></rect>
											</g>
										</svg>
									</button>
									<button className={'flex-end' === this.props.attributes.vAlign ? 'active inspector-button' : ' inspector-button'} onClick={() => this.props.setAttributes({ vAlign: 'flex-end' })} >
										<svg width="16" height="16" viewBox="0 0 16 16">
											<g transform="translate(1)" fill="none">
												<rect className="inspector-svg-fill" x="4" width="6" height="12" rx="1"></rect>
												<path d="M0 15h14" className="inspector-svg-stroke" stroke-width="2" stroke-linecap="square"></path>
											</g>
										</svg>
									</button>
								</div>
							</div>
						</PanelRow>
						<PanelRow>
							<div className="inspector-field-alignment inspector-field inspector-responsive">
								<label>Horizontal Alignment</label>
								<div className="inspector-field-button-list inspector-field-button-list-fluid">
									<button className={'flex-start' === this.props.attributes.hAlign ? 'active inspector-button' : ' inspector-button'} onClick={() => this.props.setAttributes({ hAlign: 'flex-start' })} >
										<svg width="21" height="18" viewBox="0 0 21 18">
											<g transform="translate(-29 -4) translate(29 4)" fill="none">
												<path d="M1 .708v15.851" className="inspector-svg-stroke" stroke-linecap="square"></path>
												<rect className="inspector-svg-fill" x="5" y="5" width="16" height="7" rx="1"></rect>
											</g>
										</svg>
									</button>
									<button className={'center' === this.props.attributes.hAlign ? 'active inspector-button' : ' inspector-button'} onClick={() => this.props.setAttributes({ hAlign: 'center' })} >
										<svg width="16" height="18" viewBox="0 0 16 18">
											<g transform="translate(-115 -4) translate(115 4)" fill="none">
												<path d="M8 .708v15.851" className="inspector-svg-stroke" stroke-linecap="square"></path>
												<rect className="inspector-svg-fill" y="5" width="16" height="7" rx="1"></rect>
											</g>
										</svg>
									</button>
									<button className={'flex-end' === this.props.attributes.hAlign ? 'active inspector-button' : ' inspector-button'} onClick={() => this.props.setAttributes({ hAlign: 'flex-end' })} >
										<svg width="21" height="18" viewBox="0 0 21 18">
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
												value={this.props.attributes.paddingTop}
												onChange={(value) => this.props.setAttributes({ paddingTop: value })}
											/>
											<label>Top</label>
										</div>
										<div className="padd-buttom col-main-inner" data-tooltip="padding Bottom">
											<TextControl
												type="number"
												min="1"
												value={this.props.attributes.paddingBottom}
												onChange={(value) => this.props.setAttributes({ paddingBottom: value })}
											/>
											<label>Bottom</label>
										</div>
										<div className="padd-left col-main-inner" data-tooltip="padding Left">
											<TextControl
												type="number"
												min="1"
												value={this.props.attributes.paddingLeft}
												onChange={(value) => this.props.setAttributes({ paddingLeft: value })}
											/>
											<label>Left</label>
										</div>
										<div className="padd-right col-main-inner" data-tooltip="padding Right">
											<TextControl
												type="number"
												min="1"
												value={this.props.attributes.paddingRight}
												onChange={(value) => this.props.setAttributes({ paddingRight: value })}
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
												value={this.props.attributes.marginTop}
												onChange={(value) => this.props.setAttributes({ marginTop: value })}
											/>
											<label>Top</label>
										</div>
										<div className="padd-buttom col-main-inner" data-tooltip="margin Bottom">
											<TextControl
												type="number"
												min="1"
												value={this.props.attributes.marginBottom}
												onChange={(value) => this.props.setAttributes({ marginBottom: value })}
											/>
											<label>Bottom</label>
										</div>
										<div className="padd-left col-main-inner" data-tooltip="margin Left">
											<TextControl
												type="number"
												min="1"
												value={this.props.attributes.marginLeft}
												onChange={(value) => this.props.setAttributes({ marginLeft: value })}
											/>
											<label>Left</label>
										</div>
										<div className="padd-right col-main-inner" data-tooltip="margin Right">
											<TextControl
												type="number"
												min="1"
												value={this.props.attributes.marginRight}
												onChange={(value) => this.props.setAttributes({ marginRight: value })}
											/>
											<label>Right</label>
										</div>
									</div>
								</div>
							</div>
						</PanelRow>
					</PanelBody>
					<PanelBody title={__('Help')} initialOpen={false}>
						<a href="https://nabshow-com.go-vip.net/2020/wp-content/uploads/sites/3/2019/11/nabshow-custom-block.mp4" target="_blank">How to use block?</a>
					</PanelBody>
				</div>
			</InspectorControls>
		);
	}
}
