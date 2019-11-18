(function (wpI18n, wpBlocks, wpEditor, wpComponents) {
	const { __ } = wpI18n;
	const { registerBlockType } = wpBlocks;
	const { InspectorControls, InnerBlocks, MediaUpload, BlockControls } = wpEditor;
	const { TextControl, PanelBody, PanelRow, Toolbar, IconButton, Button, ToggleControl, RangeControl, ColorPalette } = wpComponents;

	const imageWithTextBlockIcon = (
		<svg width="150px" height="150px" viewBox="418.4 418.4 150 150" enable-background="new 418.4 418.4 150 150">
			<g>
				<path fill="#0F6CB6" d="M544.93,449.158h-38.933c-2.975,0-5.383,2.409-5.383,5.383s2.408,5.383,5.383,5.383h38.933
					c2.975,0,5.384-2.409,5.384-5.383S547.904,449.158,544.93,449.158z"/>
				<path fill="#0F6CB6" d="M505.997,498.44h26.014c2.975,0,5.383-2.409,5.383-5.383c0-2.975-2.408-5.383-5.383-5.383h-26.014
					c-2.975,0-5.383,2.409-5.383,5.383C500.614,496.031,503.022,498.44,505.997,498.44z"/>
				<path fill="#0F6CB6" d="M554.418,468.416h-48.421c-2.975,0-5.383,2.409-5.383,5.383s2.408,5.383,5.383,5.383h48.421
					c2.974,0,5.383-2.409,5.383-5.383S557.392,468.416,554.418,468.416z"/>
				<path fill="#0F6CB6" d="M554.418,506.945h-48.421c-2.975,0-5.383,2.409-5.383,5.384c0,2.974,2.408,5.383,5.383,5.383h48.421
					c2.974,0,5.383-2.409,5.383-5.383C559.801,509.354,557.392,506.945,554.418,506.945z"/>
				<path fill="#0F6CB6" d="M554.418,526.203h-48.421c-2.975,0-5.383,2.409-5.383,5.384c0,2.974,2.408,5.383,5.383,5.383h48.421
					c2.974,0,5.383-2.409,5.383-5.383C559.801,528.612,557.392,526.203,554.418,526.203z"/>
				<path fill="#0F6CB6" d="M482.769,448.566h-47.694c-4.455,0-8.075,3.62-8.075,8.075v73.52c0,4.455,3.62,8.074,8.075,8.074h47.694
					c4.455,0,8.075-3.619,8.075-8.074v-73.52C490.843,452.173,487.237,448.566,482.769,448.566z"/>
			</g>
		</svg>
	);

	registerBlockType('nab/image-with-text', {
		title: __('Image & Text'),
		icon: { src: imageWithTextBlockIcon },
		description: __('Nab Image & Text is a gutenberg block where you can add media along with text.'),
		category: 'nabshow',
		keywords: [__('Media'), __('Text')],
		attributes: {
			LeftWidth: {
				type: 'number',
				default: 50
			},
			imageAlt: {
				attribute: 'alt'
			},
			imageUrl: {
				attribute: 'src'
			},
			ColumnAlignment: {
				type: 'string',
				default: 'center'
			},
			Imagelignment: {
				type: 'string',
				default: 'center'
			},
			paddingTop: {
				type: 'string',
				default: '20'
			},
			paddingRight: {
				type: 'string',
				default: '20'
			},
			paddingBottom: {
				type: 'string',
				default: '20'
			},
			paddingLeft: {
				type: 'string',
				default: '20'
			},
			FullImage: {
				type: 'boolean',
				default: true
			},
			postImage: {
				type: 'boolean',
				default: false
			},
			imgID: {
				type: 'number',
			},
			BoxAlign: {
				type: 'string'
			},
			BackgroundColor: { type: 'string' },
			InsertUrl: {
				type: 'string',
				default: ''
			}
		},

		edit({ attributes, setAttributes }) {
			const {
				LeftWidth,
				imageAlt,
				imageUrl,
				ColumnAlignment,
				paddingTop,
				paddingRight,
				paddingBottom,
				paddingLeft,
				Imagelignment,
				FullImage,
				postImage,
				BoxAlign,
				BackgroundColor,
				InsertUrl,
				imgID
			} = attributes;

			const getImageButton = (openEvent) => {
				if (imageUrl) {
					return <img src={imageUrl} alr={imageAlt} style={ImageStyle} className="image" />;
				} else {
					return (
						<div className="button-container">
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

			const MainStyle = {};
			ColumnAlignment && (MainStyle.alignItems = `${ColumnAlignment}`);
			BackgroundColor && (MainStyle.background = BackgroundColor);

			const LeftColumnStyle = {};
			LeftWidth && (LeftColumnStyle.width = `${LeftWidth}%`);
			Imagelignment && (LeftColumnStyle.textAlign = `${Imagelignment}`);
			BoxAlign && (LeftColumnStyle.order = `${BoxAlign}`);

			let RightWidth = [100 - LeftWidth];

			const RightColumnStyle = {};
			LeftWidth && (RightColumnStyle.width = `${RightWidth}%`);
			paddingTop && (RightColumnStyle.paddingTop = `${paddingTop}px`);
			paddingBottom && (RightColumnStyle.paddingBottom = `${paddingBottom}px`);
			paddingLeft && (RightColumnStyle.paddingLeft = `${paddingLeft}px`);
			paddingRight && (RightColumnStyle.paddingRight = `${paddingRight}px`);

			const ImageStyle = {};
			FullImage && (ImageStyle.width = '100%');
			FullImage && (ImageStyle.height = '100%');

			return (
				<div className="media-with-text-main" style={MainStyle}>
					<div className="media-with-text-main-column left-side" style={LeftColumnStyle}>
						<BlockControls>
							<Toolbar>
								<MediaUpload
									value={imgID}
									onSelect={(media) => setAttributes({ imageAlt: media.alt, imageUrl: media.url, imgID: media.id })}
									render={({ open }) => (
										<IconButton
											className="components-toolbar__control"
											label={__('Change image')}
											icon="edit"
											onClick={open}
										/>
									)}
								/>
							</Toolbar>
						</BlockControls>
						<MediaUpload
							onSelect={(media) => {
								setAttributes({ imageAlt: media.alt, imageUrl: media.url, imgID: media.id });
							}}
							type="image"
							value={imgID}
							render={({ open }) => getImageButton(open)}
						/>
					</div>
					<div className="media-with-text-main-column right-side" style={RightColumnStyle}>
						<InnerBlocks />
					</div>
					<InspectorControls>
						<PanelBody title="General Setting" initialOpen={false}>
							<PanelRow>
								<div className="col-main-2 media-with-text-align">
									<div className="col-main-inner">
										<span
											className="dashicons dashicons-align-left"
											onClick={() => setAttributes({ BoxAlign: '1' })}
										/>
									</div>
									<div className="col-main-inner">
										<span
											className="dashicons dashicons-align-right"
											onClick={() => setAttributes({ BoxAlign: '2' })}
										/>
									</div>
								</div>
							</PanelRow>
							<PanelRow>
								<div className="inspector-field-alignment inspector-field inspector-responsive inspector-bottom-20">
									<label>Column  Alignment</label>
									<div className="inspector-field-button-list inspector-field-button-list-fluid">
										<button className={'flex-start' === ColumnAlignment ? 'active inspector-button' : ' inspector-button'} onClick={() => setAttributes({ ColumnAlignment: 'flex-start' })} >
											<svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
												<g transform="translate(1)" fill="none">
													<rect className="inspector-svg-fill" x="4" y="4" width="6" height="12" rx="1"></rect>
													<path className="inspector-svg-stroke" d="M0 1h14" stroke-width="2" stroke-linecap="square"></path>
												</g>
											</svg>
										</button>
										<button className={'center' === ColumnAlignment ? 'active inspector-button' : ' inspector-button'} onClick={() => setAttributes({ ColumnAlignment: 'center' })} >
											<svg width="16" height="18" viewBox="0 0 16 18" xmlns="http://www.w3.org/2000/svg">
												<g transform="translate(-115 -4) translate(115 4)" fill="none">
													<path d="M8 .708v15.851" className="inspector-svg-stroke" stroke-linecap="square"></path>
													<rect className="inspector-svg-fill" y="5" width="16" height="7" rx="1"></rect>
												</g>
											</svg>
										</button>
										<button className={'flex-end' === ColumnAlignment ? 'active inspector-button' : ' inspector-button'} onClick={() => setAttributes({ ColumnAlignment: 'flex-end' })} >
											<svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
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
								<div className="inspector-field inspector-field-color ">
									<label className="inspector-mb-0">Background Color</label>
									<div className="inspector-ml-auto">
										<ColorPalette
											value={BackgroundColor}
											onChange={BackgroundColor => setAttributes({ BackgroundColor: BackgroundColor })}
										/>
									</div>
								</div>
							</PanelRow>
						</PanelBody>
						<PanelBody title="Image Setting" initialOpen={false}>
							<label>Media Box Width</label>
							<PanelRow>
								<RangeControl
									value={LeftWidth}
									min="1"
									max="100"
									step="1"
									onChange={(value) => setAttributes({ LeftWidth: value })}
								/>
							</PanelRow>
							<PanelRow>
								<ToggleControl
									label={__('Change Image Size')}
									checked={FullImage}
									onChange={() => setAttributes({ FullImage: ! FullImage })}
								/>
							</PanelRow>
							{0 !== wp.data.select('core/editor').getEditedPostAttribute('featured_media') &&
								<PanelRow>
									<ToggleControl
										label={__('Post Featured Image')}
										checked={postImage}
										onChange={(postImg) => {
											setAttributes({ postImage: postImg });
											if (postImg) {
												let postImgURL,
													postImgAlt = wp.data.select('core').getMedia(wp.data.select('core/editor').getEditedPostAttribute('featured_media')).alt_text,
													postImgId = wp.data.select('core').getMedia(wp.data.select('core/editor').getEditedPostAttribute('featured_media')).id;

												if (wp.data.select('core').getMedia(wp.data.select('core/editor').getEditedPostAttribute('featured_media')).media_details.sizes.medium) {
													postImgURL = wp.data.select('core').getMedia(wp.data.select('core/editor').getEditedPostAttribute('featured_media')).media_details.sizes.medium.source_url;
												} else if (wp.data.select('core').getMedia(wp.data.select('core/editor').getEditedPostAttribute('featured_media')).source_url) {
													postImgURL = wp.data.select('core').getMedia(wp.data.select('core/editor').getEditedPostAttribute('featured_media')).source_url;
												}
												setAttributes({ imageAlt: postImgAlt, imageUrl: postImgURL, imgID: postImgId });
											}
										}}
									/>
								</PanelRow>
							}
						</PanelBody>
						<PanelBody title="Content Box Spacing" initialOpen={false}>
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
				LeftWidth,
				imageAlt,
				imageUrl,
				ColumnAlignment,
				paddingTop,
				paddingRight,
				paddingBottom,
				paddingLeft,
				Imagelignment,
				FullImage,
				BoxAlign,
				BackgroundColor
			} = attributes;

			const MainStyle = {};
			ColumnAlignment && (MainStyle.alignItems = `${ColumnAlignment}`);
			BackgroundColor && (MainStyle.background = BackgroundColor);

			const LeftColumnStyle = {};
			LeftWidth && (LeftColumnStyle.width = `${LeftWidth}%`);
			Imagelignment && (LeftColumnStyle.textAlign = `${Imagelignment}`);
			BoxAlign && (LeftColumnStyle.order = `${BoxAlign}`);

			let RightWidth = [100 - LeftWidth];

			const RightColumnStyle = {};
			LeftWidth && (RightColumnStyle.width = `${RightWidth}%`);
			paddingTop && (RightColumnStyle.paddingTop = `${paddingTop}px`);
			paddingBottom && (RightColumnStyle.paddingBottom = `${paddingBottom}px`);
			paddingLeft && (RightColumnStyle.paddingLeft = `${paddingLeft}px`);
			paddingRight && (RightColumnStyle.paddingRight = `${paddingRight}px`);

			const ImageStyle = {};
			FullImage && (ImageStyle.width = '100%');
			FullImage && (ImageStyle.height = '100%');

			return (
				<div className="media-with-text-main" style={MainStyle}>
					<div className="media-with-text-main-column left-side" style={LeftColumnStyle}>
						<img src={imageUrl} alt={imageAlt} style={ImageStyle} />
					</div>
					<div className="media-with-text-main-column right-side" style={RightColumnStyle}>
						<InnerBlocks.Content />
					</div>
				</div>
			);
		}
	});
})(wp.i18n, wp.blocks, wp.editor, wp.components);
