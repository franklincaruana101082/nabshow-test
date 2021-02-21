/**
 * BLOCK: discover-more
 *
 * Registering a basic block with Gutenberg.
 * Simple block, renders and saves the same content without any interactivity.
 */

//  Import CSS.
import './editor.scss';
import './style.scss';

const { __ } = wp.i18n; // Import __() from wp.i18n
const { registerBlockType } = wp.blocks; // Import registerBlockType() from wp.blocks
const { MediaUpload, PlainText, InnerBlocks, useBlockProps, URLInputButton } = wp.blockEditor;
const { Button } = wp.components;
const { Component } = wp.element;


class DiscoverEdit extends Component {
	constructor(props) {
		super(props);

		this.state = {
			sectionName: 'Broadcast',
			showList: '',
			broadcast: '_selected',
			streaming: '',
			content: '',
			live: '',
			closeListTimeout: null
		}
	}

	showList = () => { this.setState({showList: '_open'}) }

	showListOut = () => {
		this.closeListTimeout = setTimeout(() => {
			this.setState({showList: ''})
		}, 500);
	}
	showListOver = () => {
		clearTimeout(this.closeListTimeout);
	}
	showBroadcast = () => {
		this.setState({ 
			sectionName: 'Broadcast',
			showList: '',
			broadcast: '_selected',
			streaming: '',
			content: '',
			live: ''
		})
	}
	showStreaming = () => {
		this.setState({ 
			sectionName: 'Streaming',
			showList: '',
			broadcast: '',
			streaming: '_selected',
			content: '',
			live: ''
		})
	}
	showContent = () => {
		this.setState({ 
			sectionName: 'Content Creation',
			showList: '',
			broadcast: '',
			streaming: '',
			content: '_selected',
			live: ''
		})
	}
	showLive = () => {
		this.setState({ 
			sectionName: 'Live Event Production',
			showList: '',
			broadcast: '',
			streaming: '',
			content: '',
			live: '_selected'
		})
	}
	render() {
		const { attributes, setAttributes } = this.props;
		const getImageButton = (openEvent, url) => {
			if(url) {
				return (
					<img
						src={ url }
						onClick={ openEvent }
						className="textimage__img"
					/>
				);
			}
			else {
				return (
					<div className="button-container">
						<Button
							onClick={ openEvent }
							className="button button-small"
						>
							Feature image
						</Button>
					</div>
				);
			}
		};
		return(
			<section className="discover">
				<h2 onMouseOut={ () => this.showListOut() }
					onMouseOver={ () => this.showListOver() }
					className={'discover__title showlist ' + this.state.showList}
					>Discover More&nbsp;
					<div className="discover__feedtype showlist__feedtype"
						onClick={ () => this.showList() } 
						> {this.state.sectionName}</div>
					<ul className="radiolist discover__feedchooser showlist__feedchooser">
						<li><h5>Discover More:</h5></li>
						<li><div 
							onClick={() => this.showBroadcast()} 
							className={'option '+ this.state.broadcast}>Broadcast</div>
						</li>
						<li><div 
							onClick={() => this.showStreaming()}
							className={'option '+ this.state.streaming}>Streaming</div>
						</li>
						<li><div 
							onClick={() => this.showContent() }
							className={'option '+ this.state.content}>Content Creation</div>
						</li>
						<li><div 
							onClick={() => this.showLive() }
							className={'option '+ this.state.live}>Live Event Production</div>
						</li>
					</ul>
				</h2>
				<div className="discover__introtext introtext">
					<PlainText
						onChange={ content => setAttributes({ introCopy: content }) }
						value={ attributes.introCopy }
						placeholder="Intro copy"
					/>
				</div>

				<div className="nabcard">
					<div className="nabcard__content">
						<div className={'discover__panel '+ this.state.broadcast}>
							<div className="discover__content">
								<div className="discover__feature">
									<div className="textimage">
										<div className="textimage__link">
											<URLInputButton
												url={ attributes.broadcastfeatureLink }
												onChange={ (url, post ) => setAttributes( { broadcastfeatureLink: url } ) }
												className="textimage__linkBtn"
											/>
											<div className="textimage__image">
												<MediaUpload
													onSelect={ media => {setAttributes({broadcastfeatureImageAlt: media.alt, broadcastfeatureImageUrl: media.url }); } }
													type="image"
													value={ attributes.broadcastfeatureImageID }
													render={ ({ open }) => getImageButton(open, attributes.broadcastfeatureImageUrl) }
													className="textimage__img"
												/>
											</div>
											<div className="textimage__text">
												<h2 className="discover__featuretitle">
													<PlainText
														onChange={ content => setAttributes({ broadcastfeatureTitle: content })}
														value={ attributes.broadcastfeatureTitle }
														placeholder="Feature Title"
													/>
												</h2>
											</div>
										</div>
									</div>
								</div>

								<div className="discover__company">
									<div class="slides">
										<h4 class="slides__title">
											<PlainText
												onChange={ content => setAttributes({ broadcastCompanyTitle: content })}
												value={ attributes.broadcastCompanyTitle }
												placeholder="Company Features Title"
											/>
										</h4>
										<ul class="slides__list">
											<li class="slides__slide">
												<URLInputButton
													url={ attributes.broadcastCompany1Link }
													onChange={ (url, post ) => setAttributes( { broadcastCompany1Link: url } ) }
												/>
												<MediaUpload
													onSelect={ media => {setAttributes({broadcastCompany1ImageAlt: media.alt, broadcastCompany1ImageUrl: media.url }); } }
													type="image"
													value={ attributes.broadcastCompany1ImageID }
													render={ ({ open }) => getImageButton(open, attributes.broadcastCompany1ImageUrl) }
													className="slides__image"
												/>
												<h5 class="slides__category">
													<PlainText
														onChange={ content => setAttributes({ broadcastCompany1Category: content })}
														value={ attributes.broadcastCompany1Category }
														placeholder="Category/Title"
													/>
												</h5>
												<div class="introtext">
													<PlainText
														onChange={ content => setAttributes({ broadcastCompany1Copy: content })}
														value={ attributes.broadcastCompany1Copy }
														placeholder="Teaser Copy"
													/>
												</div>
											</li>
											<li class="slides__slide">
												<URLInputButton
													url={ attributes.broadcastCompany2Link }
													onChange={ (url, post ) => setAttributes( { broadcastCompany2Link: url } ) }
												/>
												<MediaUpload
													onSelect={ media => {setAttributes({broadcastCompany2ImageAlt: media.alt, broadcastCompany2ImageUrl: media.url }); } }
													type="image"
													value={ attributes.broadcastCompany2ImageID }
													render={ ({ open }) => getImageButton(open, attributes.broadcastCompany2ImageUrl) }
													className="slides__image"
												/>
												<h5 class="slides__category">
													<PlainText
														onChange={ content => setAttributes({ broadcastCompany2Category: content })}
														value={ attributes.broadcastCompany2Category }
														placeholder="Category/Title"
													/>
												</h5>
												<div class="introtext">
													<PlainText
														onChange={ content => setAttributes({ broadcastCompany2Copy: content })}
														value={ attributes.broadcastCompany2Copy }
														placeholder="Teaser Copy"
													/>
												</div>
											</li>
											<li class="slides__slide">
												<URLInputButton
													url={ attributes.broadcastCompany3Link }
													onChange={ (url, post ) => setAttributes( { broadcastCompany3Link: url } ) }
												/>
												<MediaUpload
													onSelect={ media => {setAttributes({broadcastCompany3ImageAlt: media.alt, broadcastCompany3ImageUrl: media.url }); } }
													type="image"
													value={ attributes.broadcastCompany3ImageID }
													render={ ({ open }) => getImageButton(open, attributes.broadcastCompany3ImageUrl) }
													className="slides__image"
												/>
												<h5 class="slides__category">
													<PlainText
														onChange={ content => setAttributes({ broadcastCompany3Category: content })}
														value={ attributes.broadcastCompany3Category }
														placeholder="Category/Title"
													/>
												</h5>
												<div class="introtext">
													<PlainText
														onChange={ content => setAttributes({ broadcastCompany3Copy: content })}
														value={ attributes.broadcastCompany3Copy }
														placeholder="Teaser Copy"
													/>
												</div>
											</li>
										</ul>
									</div>
								</div>
							</div>

							<div className="discover__ad ad">
								Advertisement
								<PlainText
									onChange={ content => setAttributes({ broadcastAd: content })}
									value={ attributes.broadcastAd }
									placeholder="Enter Shortcode"
								/>
							</div>

							<div className="discover__products">
								<div class="homeproducts">
									<h4 class="homeproducts__title">Products</h4>
									<div class="homeproducts__listcontainer">
										<ul class="homeproducts__list">
											<li class="homeproducts__item">
												<div class="homeproducts__product">
													<URLInputButton
														url={ attributes.broadcastProduct1Link }
														onChange={ (url, post ) => setAttributes( { broadcastProduct1Link: url } ) }
														className="homeproducts__linkBtn"
													/>
													<MediaUpload
														onSelect={ media => {setAttributes({broadcastProduct1ImageAlt: media.alt, broadcastProduct1ImageUrl: media.url }); } }
														type="image"
														value={ attributes.broadcastProduct1ImageID }
														render={ ({ open }) => getImageButton(open, attributes.broadcastProduct1ImageUrl) }
														className="homeproducts__image"
													/>
													<h5 class="homeproducts__company">
														<PlainText
															onChange={ content => setAttributes({ broadcastProduct1Company: content })}
															value={ attributes.broadcastProduct1Company }
															placeholder="Company Name"
														/>
													</h5>
													<h3 class="homeproducts__name">
														<PlainText
															onChange={ content => setAttributes({ broadcastProduct1Title: content })}
															value={ attributes.broadcastProduct1Title }
															placeholder="Product Name"
														/>
													</h3>
												</div>
											</li>
											<li class="homeproducts__item">
												<div class="homeproducts__product">
													<URLInputButton
														url={ attributes.broadcastProduct2Link }
														onChange={ (url, post ) => setAttributes( { broadcastProduct2Link: url } ) }
														className="homeproducts__linkBtn"
													/>
													<MediaUpload
														onSelect={ media => {setAttributes({broadcastProduct2ImageAlt: media.alt, broadcastProduct2ImageUrl: media.url }); } }
														type="image"
														value={ attributes.broadcastProduct2ImageID }
														render={ ({ open }) => getImageButton(open, attributes.broadcastProduct2ImageUrl) }
														className="homeproducts__image"
													/>
													<h5 class="homeproducts__company">
														<PlainText
															onChange={ content => setAttributes({ broadcastProduct2Company: content })}
															value={ attributes.broadcastProduct2Company }
															placeholder="Company Name"
														/>
													</h5>
													<h3 class="homeproducts__name">
														<PlainText
															onChange={ content => setAttributes({ broadcastProduct2Title: content })}
															value={ attributes.broadcastProduct2Title }
															placeholder="Product Name"
														/>
													</h3>
												</div>
											</li>
											<li class="homeproducts__item">
												<div class="homeproducts__product">
													<URLInputButton
														url={ attributes.broadcastProduct3Link }
														onChange={ (url, post ) => setAttributes( { broadcastProduct3Link: url } ) }
														className="homeproducts__linkBtn"
													/>
													<MediaUpload
														onSelect={ media => {setAttributes({broadcastProduct3ImageAlt: media.alt, broadcastProduct3ImageUrl: media.url }); } }
														type="image"
														value={ attributes.broadcastProduct3ImageID }
														render={ ({ open }) => getImageButton(open, attributes.broadcastProduct3ImageUrl) }
														className="homeproducts__image"
													/>
													<h5 class="homeproducts__company">
														<PlainText
															onChange={ content => setAttributes({ broadcastProduct3Company: content })}
															value={ attributes.broadcastProduct3Company }
															placeholder="Company Name"
														/>
													</h5>
													<h3 class="homeproducts__name">
														<PlainText
															onChange={ content => setAttributes({ broadcastProduct3Title: content })}
															value={ attributes.broadcastProduct3Title }
															placeholder="Product Name"
														/>
													</h3>
												</div>
											</li>
										</ul>
									</div>
									<div class="ad homeproducts__ad">
										Advertisement
										<PlainText
											onChange={ content => setAttributes({ broadcastProductAd: content })}
											value={ attributes.broadcastProductAd }
											placeholder="Enter Shortcode"
										/>
									</div>
								</div>
							</div>
						</div>

						<div className={'discover__panel '+ this.state.streaming}>
							<div className="discover__content">
								<div className="discover__feature">
									<div className="textimage">
										<div className="textimage__link">
											<URLInputButton
												url={ attributes.streamingfeatureLink }
												onChange={ (url, post ) => setAttributes( { streamingfeatureLink: url } ) }
												className="textimage__linkBtn"
											/>
											<div className="textimage__image">
												<MediaUpload
													onSelect={ media => {setAttributes({streamingfeatureImageAlt: media.alt, streamingfeatureImageUrl: media.url }); } }
													type="image"
													value={ attributes.streamingfeatureImageID }
													render={ ({ open }) => getImageButton(open, attributes.streamingfeatureImageUrl) }
													className="textimage__img"
												/>
											</div>
											<div className="textimage__text">
												<h2 className="discover__featuretitle">
													<PlainText
														onChange={ content => setAttributes({ streamingfeatureTitle: content })}
														value={ attributes.streamingfeatureTitle }
														placeholder="Feature Title"
													/>
												</h2>
											</div>
										</div>
									</div>
								</div>

								<div className="discover__company">
									<div class="slides">
										<h4 class="slides__title">
											<PlainText
												onChange={ content => setAttributes({ streamingCompanyTitle: content })}
												value={ attributes.streamingCompanyTitle }
												placeholder="Company Features Title"
											/>
										</h4>
										<ul class="slides__list">
											<li class="slides__slide">
												<URLInputButton
													url={ attributes.streamingCompany1Link }
													onChange={ (url, post ) => setAttributes( { streamingCompany1Link: url } ) }
												/>
												<MediaUpload
													onSelect={ media => {setAttributes({streamingCompany1ImageAlt: media.alt, streamingCompany1ImageUrl: media.url }); } }
													type="image"
													value={ attributes.streamingCompany1ImageID }
													render={ ({ open }) => getImageButton(open, attributes.streamingCompany1ImageUrl) }
													className="slides__image"
												/>
												<h5 class="slides__category">
													<PlainText
														onChange={ content => setAttributes({ streamingCompany1Category: content })}
														value={ attributes.streamingCompany1Category }
														placeholder="Category/Title"
													/>
												</h5>
												<div class="introtext">
													<PlainText
														onChange={ content => setAttributes({ streamingCompany1Copy: content })}
														value={ attributes.streamingCompany1Copy }
														placeholder="Teaser Copy"
													/>
												</div>
											</li>
											<li class="slides__slide">
												<URLInputButton
													url={ attributes.streamingCompany2Link }
													onChange={ (url, post ) => setAttributes( { streamingCompany2Link: url } ) }
												/>
												<MediaUpload
													onSelect={ media => {setAttributes({streamingCompany2ImageAlt: media.alt, streamingCompany2ImageUrl: media.url }); } }
													type="image"
													value={ attributes.streamingCompany2ImageID }
													render={ ({ open }) => getImageButton(open, attributes.streamingCompany2ImageUrl) }
													className="slides__image"
												/>
												<h5 class="slides__category">
													<PlainText
														onChange={ content => setAttributes({ streamingCompany2Category: content })}
														value={ attributes.streamingCompany2Category }
														placeholder="Category/Title"
													/>
												</h5>
												<div class="introtext">
													<PlainText
														onChange={ content => setAttributes({ streamingCompany2Copy: content })}
														value={ attributes.streamingCompany2Copy }
														placeholder="Teaser Copy"
													/>
												</div>
											</li>
											<li class="slides__slide">
												<URLInputButton
													url={ attributes.streamingCompany3Link }
													onChange={ (url, post ) => setAttributes( { streamingCompany3Link: url } ) }
												/>
												<MediaUpload
													onSelect={ media => {setAttributes({streamingCompany3ImageAlt: media.alt, streamingCompany3ImageUrl: media.url }); } }
													type="image"
													value={ attributes.streamingCompany3ImageID }
													render={ ({ open }) => getImageButton(open, attributes.streamingCompany3ImageUrl) }
													className="slides__image"
												/>
												<h5 class="slides__category">
													<PlainText
														onChange={ content => setAttributes({ streamingCompany3Category: content })}
														value={ attributes.streamingCompany3Category }
														placeholder="Category/Title"
													/>
												</h5>
												<div class="introtext">
													<PlainText
														onChange={ content => setAttributes({ streamingCompany3Copy: content })}
														value={ attributes.streamingCompany3Copy }
														placeholder="Teaser Copy"
													/>
												</div>
											</li>
										</ul>
									</div>
								</div>
							</div>

							<div className="discover__ad ad">
								Advertisement
								<PlainText
									onChange={ content => setAttributes({ streamingAd: content })}
									value={ attributes.streamingAd }
									placeholder="Enter Shortcode"
								/>
							</div>

							<div className="discover__products">
								<div class="homeproducts">
									<h4 class="homeproducts__title">Products</h4>
									<div class="homeproducts__listcontainer">
										<ul class="homeproducts__list">
											<li class="homeproducts__item">
												<div class="homeproducts__product">
													<URLInputButton
														url={ attributes.streamingProduct1Link }
														onChange={ (url, post ) => setAttributes( { streamingProduct1Link: url } ) }
														className="homeproducts__linkBtn"
													/>
													<MediaUpload
														onSelect={ media => {setAttributes({streamingProduct1ImageAlt: media.alt, streamingProduct1ImageUrl: media.url }); } }
														type="image"
														value={ attributes.streamingProduct1ImageID }
														render={ ({ open }) => getImageButton(open, attributes.streamingProduct1ImageUrl) }
														className="homeproducts__image"
													/>
													<h5 class="homeproducts__company">
														<PlainText
															onChange={ content => setAttributes({ streamingProduct1Company: content })}
															value={ attributes.streamingProduct1Company }
															placeholder="Company Name"
														/>
													</h5>
													<h3 class="homeproducts__name">
														<PlainText
															onChange={ content => setAttributes({ streamingProduct1Title: content })}
															value={ attributes.streamingProduct1Title }
															placeholder="Product Name"
														/>
													</h3>
												</div>
											</li>
											<li class="homeproducts__item">
												<div class="homeproducts__product">
													<URLInputButton
														url={ attributes.streamingProduct2Link }
														onChange={ (url, post ) => setAttributes( { streamingProduct2Link: url } ) }
														className="homeproducts__linkBtn"
													/>
													<MediaUpload
														onSelect={ media => {setAttributes({streamingProduct2ImageAlt: media.alt, streamingProduct2ImageUrl: media.url }); } }
														type="image"
														value={ attributes.streamingProduct2ImageID }
														render={ ({ open }) => getImageButton(open, attributes.streamingProduct2ImageUrl) }
														className="homeproducts__image"
													/>
													<h5 class="homeproducts__company">
														<PlainText
															onChange={ content => setAttributes({ streamingProduct2Company: content })}
															value={ attributes.streamingProduct2Company }
															placeholder="Company Name"
														/>
													</h5>
													<h3 class="homeproducts__name">
														<PlainText
															onChange={ content => setAttributes({ streamingProduct2Title: content })}
															value={ attributes.streamingProduct2Title }
															placeholder="Product Name"
														/>
													</h3>
												</div>
											</li>
											<li class="homeproducts__item">
												<div class="homeproducts__product">
													<URLInputButton
														url={ attributes.streamingProduct3Link }
														onChange={ (url, post ) => setAttributes( { streamingProduct3Link: url } ) }
														className="homeproducts__linkBtn"
													/>
													<MediaUpload
														onSelect={ media => {setAttributes({streamingProduct3ImageAlt: media.alt, streamingProduct3ImageUrl: media.url }); } }
														type="image"
														value={ attributes.streamingProduct3ImageID }
														render={ ({ open }) => getImageButton(open, attributes.streamingProduct3ImageUrl) }
														className="homeproducts__image"
													/>
													<h5 class="homeproducts__company">
														<PlainText
															onChange={ content => setAttributes({ streamingProduct3Company: content })}
															value={ attributes.streamingProduct3Company }
															placeholder="Company Name"
														/>
													</h5>
													<h3 class="homeproducts__name">
														<PlainText
															onChange={ content => setAttributes({ streamingProduct3Title: content })}
															value={ attributes.streamingProduct3Title }
															placeholder="Product Name"
														/>
													</h3>
												</div>
											</li>
										</ul>
									</div>
									<div class="ad homeproducts__ad">
										Advertisement
										<PlainText
											onChange={ content => setAttributes({ streamingProductAd: content })}
											value={ attributes.streamingProductAd }
											placeholder="Enter Shortcode"
										/>
									</div>
								</div>
							</div>
						</div>

						<div className={'discover__panel '+ this.state.content}>
							<div className="discover__content">
								<div className="discover__feature">
									<div className="textimage">
										<div className="textimage__link">
											<URLInputButton
												url={ attributes.contentfeatureLink }
												onChange={ (url, post ) => setAttributes( { contentfeatureLink: url } ) }
												className="textimage__linkBtn"
											/>
											<div className="textimage__image">
												<MediaUpload
													onSelect={ media => {setAttributes({contentfeatureImageAlt: media.alt, contentfeatureImageUrl: media.url }); } }
													type="image"
													value={ attributes.contentfeatureImageID }
													render={ ({ open }) => getImageButton(open, attributes.contentfeatureImageUrl) }
													className="textimage__img"
												/>
											</div>
											<div className="textimage__text">
												<h2 className="discover__featuretitle">
													<PlainText
														onChange={ content => setAttributes({ contentfeatureTitle: content })}
														value={ attributes.contentfeatureTitle }
														placeholder="Feature Title"
													/>
												</h2>
											</div>
										</div>
									</div>
								</div>

								<div className="discover__company">
									<div class="slides">
										<h4 class="slides__title">
											<PlainText
												onChange={ content => setAttributes({ contentCompanyTitle: content })}
												value={ attributes.contentCompanyTitle }
												placeholder="Company Features Title"
											/>
										</h4>
										<ul class="slides__list">
											<li class="slides__slide">
												<URLInputButton
													url={ attributes.contentCompany1Link }
													onChange={ (url, post ) => setAttributes( { contentCompany1Link: url } ) }
												/>
												<MediaUpload
													onSelect={ media => {setAttributes({contentCompany1ImageAlt: media.alt, contentCompany1ImageUrl: media.url }); } }
													type="image"
													value={ attributes.contentCompany1ImageID }
													render={ ({ open }) => getImageButton(open, attributes.contentCompany1ImageUrl) }
													className="slides__image"
												/>
												<h5 class="slides__category">
													<PlainText
														onChange={ content => setAttributes({ contentCompany1Category: content })}
														value={ attributes.contentCompany1Category }
														placeholder="Category/Title"
													/>
												</h5>
												<div class="introtext">
													<PlainText
														onChange={ content => setAttributes({ contentCompany1Copy: content })}
														value={ attributes.contentCompany1Copy }
														placeholder="Teaser Copy"
													/>
												</div>
											</li>
											<li class="slides__slide">
												<URLInputButton
													url={ attributes.contentCompany2Link }
													onChange={ (url, post ) => setAttributes( { contentCompany2Link: url } ) }
												/>
												<MediaUpload
													onSelect={ media => {setAttributes({contentCompany2ImageAlt: media.alt, contentCompany2ImageUrl: media.url }); } }
													type="image"
													value={ attributes.contentCompany2ImageID }
													render={ ({ open }) => getImageButton(open, attributes.contentCompany2ImageUrl) }
													className="slides__image"
												/>
												<h5 class="slides__category">
													<PlainText
														onChange={ content => setAttributes({ contentCompany2Category: content })}
														value={ attributes.contentCompany2Category }
														placeholder="Category/Title"
													/>
												</h5>
												<div class="introtext">
													<PlainText
														onChange={ content => setAttributes({ contentCompany2Copy: content })}
														value={ attributes.contentCompany2Copy }
														placeholder="Teaser Copy"
													/>
												</div>
											</li>
											<li class="slides__slide">
												<URLInputButton
													url={ attributes.contentCompany3Link }
													onChange={ (url, post ) => setAttributes( { contentCompany3Link: url } ) }
												/>
												<MediaUpload
													onSelect={ media => {setAttributes({contentCompany3ImageAlt: media.alt, contentCompany3ImageUrl: media.url }); } }
													type="image"
													value={ attributes.contentCompany3ImageID }
													render={ ({ open }) => getImageButton(open, attributes.contentCompany3ImageUrl) }
													className="slides__image"
												/>
												<h5 class="slides__category">
													<PlainText
														onChange={ content => setAttributes({ contentCompany3Category: content })}
														value={ attributes.contentCompany3Category }
														placeholder="Category/Title"
													/>
												</h5>
												<div class="introtext">
													<PlainText
														onChange={ content => setAttributes({ contentCompany3Copy: content })}
														value={ attributes.contentCompany3Copy }
														placeholder="Teaser Copy"
													/>
												</div>
											</li>
										</ul>
									</div>
								</div>
							</div>

							<div className="discover__ad ad">
								Advertisement
								<PlainText
									onChange={ content => setAttributes({ contentAd: content })}
									value={ attributes.contentAd }
									placeholder="Enter Shortcode"
								/>
							</div>

							<div className="discover__products">
								<div class="homeproducts">
									<h4 class="homeproducts__title">Products</h4>
									<div class="homeproducts__listcontainer">
										<ul class="homeproducts__list">
											<li class="homeproducts__item">
												<div class="homeproducts__product">
													<URLInputButton
														url={ attributes.contentProduct1Link }
														onChange={ (url, post ) => setAttributes( { contentProduct1Link: url } ) }
														className="homeproducts__linkBtn"
													/>
													<MediaUpload
														onSelect={ media => {setAttributes({contentProduct1ImageAlt: media.alt, contentProduct1ImageUrl: media.url }); } }
														type="image"
														value={ attributes.contentProduct1ImageID }
														render={ ({ open }) => getImageButton(open, attributes.contentProduct1ImageUrl) }
														className="homeproducts__image"
													/>
													<h5 class="homeproducts__company">
														<PlainText
															onChange={ content => setAttributes({ contentProduct1Company: content })}
															value={ attributes.contentProduct1Company }
															placeholder="Company Name"
														/>
													</h5>
													<h3 class="homeproducts__name">
														<PlainText
															onChange={ content => setAttributes({ contentProduct1Title: content })}
															value={ attributes.contentProduct1Title }
															placeholder="Product Name"
														/>
													</h3>
												</div>
											</li>
											<li class="homeproducts__item">
												<div class="homeproducts__product">
													<URLInputButton
														url={ attributes.contentProduct2Link }
														onChange={ (url, post ) => setAttributes( { contentProduct2Link: url } ) }
														className="homeproducts__linkBtn"
													/>
													<MediaUpload
														onSelect={ media => {setAttributes({contentProduct2ImageAlt: media.alt, contentProduct2ImageUrl: media.url }); } }
														type="image"
														value={ attributes.contentProduct2ImageID }
														render={ ({ open }) => getImageButton(open, attributes.contentProduct2ImageUrl) }
														className="homeproducts__image"
													/>
													<h5 class="homeproducts__company">
														<PlainText
															onChange={ content => setAttributes({ contentProduct2Company: content })}
															value={ attributes.contentProduct2Company }
															placeholder="Company Name"
														/>
													</h5>
													<h3 class="homeproducts__name">
														<PlainText
															onChange={ content => setAttributes({ contentProduct2Title: content })}
															value={ attributes.contentProduct2Title }
															placeholder="Product Name"
														/>
													</h3>
												</div>
											</li>
											<li class="homeproducts__item">
												<div class="homeproducts__product">
													<URLInputButton
														url={ attributes.contentProduct3Link }
														onChange={ (url, post ) => setAttributes( { contentProduct3Link: url } ) }
														className="homeproducts__linkBtn"
													/>
													<MediaUpload
														onSelect={ media => {setAttributes({contentProduct3ImageAlt: media.alt, contentProduct3ImageUrl: media.url }); } }
														type="image"
														value={ attributes.contentProduct3ImageID }
														render={ ({ open }) => getImageButton(open, attributes.contentProduct3ImageUrl) }
														className="homeproducts__image"
													/>
													<h5 class="homeproducts__company">
														<PlainText
															onChange={ content => setAttributes({ contentProduct3Company: content })}
															value={ attributes.contentProduct3Company }
															placeholder="Company Name"
														/>
													</h5>
													<h3 class="homeproducts__name">
														<PlainText
															onChange={ content => setAttributes({ contentProduct3Title: content })}
															value={ attributes.contentProduct3Title }
															placeholder="Product Name"
														/>
													</h3>
												</div>
											</li>
										</ul>
									</div>
									<div class="ad homeproducts__ad">
										Advertisement
										<PlainText
											onChange={ content => setAttributes({ contentProductAd: content })}
											value={ attributes.contentProductAd }
											placeholder="Enter Shortcode"
										/>
									</div>
								</div>
							</div>
						</div>

						<div className={'discover__panel '+ this.state.live}>
							<div className="discover__content">
								<div className="discover__feature">
									<div className="textimage">
										<div className="textimage__link">
											<URLInputButton
												url={ attributes.livefeatureLink }
												onChange={ (url, post ) => setAttributes( { livefeatureLink: url } ) }
												className="textimage__linkBtn"
											/>
											<div className="textimage__image">
												<MediaUpload
													onSelect={ media => {setAttributes({livefeatureImageAlt: media.alt, livefeatureImageUrl: media.url }); } }
													type="image"
													value={ attributes.livefeatureImageID }
													render={ ({ open }) => getImageButton(open, attributes.livefeatureImageUrl) }
													className="textimage__img"
												/>
											</div>
											<div className="textimage__text">
												<h2 className="discover__featuretitle">
													<PlainText
														onChange={ content => setAttributes({ livefeatureTitle: content })}
														value={ attributes.livefeatureTitle }
														placeholder="Feature Title"
													/>
												</h2>
											</div>
										</div>
									</div>
								</div>

								<div className="discover__company">
									<div class="slides">
										<h4 class="slides__title">
											<PlainText
												onChange={ content => setAttributes({ liveCompanyTitle: content })}
												value={ attributes.liveCompanyTitle }
												placeholder="Company Features Title"
											/>
										</h4>
										<ul class="slides__list">
											<li class="slides__slide">
												<URLInputButton
													url={ attributes.liveCompany1Link }
													onChange={ (url, post ) => setAttributes( { liveCompany1Link: url } ) }
												/>
												<MediaUpload
													onSelect={ media => {setAttributes({liveCompany1ImageAlt: media.alt, liveCompany1ImageUrl: media.url }); } }
													type="image"
													value={ attributes.liveCompany1ImageID }
													render={ ({ open }) => getImageButton(open, attributes.liveCompany1ImageUrl) }
													className="slides__image"
												/>
												<h5 class="slides__category">
													<PlainText
														onChange={ content => setAttributes({ liveCompany1Category: content })}
														value={ attributes.liveCompany1Category }
														placeholder="Category/Title"
													/>
												</h5>
												<div class="introtext">
													<PlainText
														onChange={ content => setAttributes({ liveCompany1Copy: content })}
														value={ attributes.liveCompany1Copy }
														placeholder="Teaser Copy"
													/>
												</div>
											</li>
											<li class="slides__slide">
												<URLInputButton
													url={ attributes.liveCompany2Link }
													onChange={ (url, post ) => setAttributes( { liveCompany2Link: url } ) }
												/>
												<MediaUpload
													onSelect={ media => {setAttributes({liveCompany2ImageAlt: media.alt, liveCompany2ImageUrl: media.url }); } }
													type="image"
													value={ attributes.liveCompany2ImageID }
													render={ ({ open }) => getImageButton(open, attributes.liveCompany2ImageUrl) }
													className="slides__image"
												/>
												<h5 class="slides__category">
													<PlainText
														onChange={ content => setAttributes({ liveCompany2Category: content })}
														value={ attributes.liveCompany2Category }
														placeholder="Category/Title"
													/>
												</h5>
												<div class="introtext">
													<PlainText
														onChange={ content => setAttributes({ liveCompany2Copy: content })}
														value={ attributes.liveCompany2Copy }
														placeholder="Teaser Copy"
													/>
												</div>
											</li>
											<li class="slides__slide">
												<URLInputButton
													url={ attributes.liveCompany3Link }
													onChange={ (url, post ) => setAttributes( { liveCompany3Link: url } ) }
												/>
												<MediaUpload
													onSelect={ media => {setAttributes({liveCompany3ImageAlt: media.alt, liveCompany3ImageUrl: media.url }); } }
													type="image"
													value={ attributes.liveCompany3ImageID }
													render={ ({ open }) => getImageButton(open, attributes.liveCompany3ImageUrl) }
													className="slides__image"
												/>
												<h5 class="slides__category">
													<PlainText
														onChange={ content => setAttributes({ liveCompany3Category: content })}
														value={ attributes.liveCompany3Category }
														placeholder="Category/Title"
													/>
												</h5>
												<div class="introtext">
													<PlainText
														onChange={ content => setAttributes({ liveCompany3Copy: content })}
														value={ attributes.liveCompany3Copy }
														placeholder="Teaser Copy"
													/>
												</div>
											</li>
										</ul>
									</div>
								</div>
							</div>

							<div className="discover__ad ad">
								Advertisement
								<PlainText
									onChange={ content => setAttributes({ liveAd: content })}
									value={ attributes.liveAd }
									placeholder="Enter Shortcode"
								/>
							</div>

							<div className="discover__products">
								<div class="homeproducts">
									<h4 class="homeproducts__title">Products</h4>
									<div class="homeproducts__listcontainer">
										<ul class="homeproducts__list">
											<li class="homeproducts__item">
												<div class="homeproducts__product">
													<URLInputButton
														url={ attributes.liveProduct1Link }
														onChange={ (url, post ) => setAttributes( { liveProduct1Link: url } ) }
														className="homeproducts__linkBtn"
													/>
													<MediaUpload
														onSelect={ media => {setAttributes({liveProduct1ImageAlt: media.alt, liveProduct1ImageUrl: media.url }); } }
														type="image"
														value={ attributes.liveProduct1ImageID }
														render={ ({ open }) => getImageButton(open, attributes.liveProduct1ImageUrl) }
														className="homeproducts__image"
													/>
													<h5 class="homeproducts__company">
														<PlainText
															onChange={ content => setAttributes({ liveProduct1Company: content })}
															value={ attributes.liveProduct1Company }
															placeholder="Company Name"
														/>
													</h5>
													<h3 class="homeproducts__name">
														<PlainText
															onChange={ content => setAttributes({ liveProduct1Title: content })}
															value={ attributes.liveProduct1Title }
															placeholder="Product Name"
														/>
													</h3>
												</div>
											</li>
											<li class="homeproducts__item">
												<div class="homeproducts__product">
													<URLInputButton
														url={ attributes.liveProduct2Link }
														onChange={ (url, post ) => setAttributes( { liveProduct2Link: url } ) }
														className="homeproducts__linkBtn"
													/>
													<MediaUpload
														onSelect={ media => {setAttributes({liveProduct2ImageAlt: media.alt, liveProduct2ImageUrl: media.url }); } }
														type="image"
														value={ attributes.liveProduct2ImageID }
														render={ ({ open }) => getImageButton(open, attributes.liveProduct2ImageUrl) }
														className="homeproducts__image"
													/>
													<h5 class="homeproducts__company">
														<PlainText
															onChange={ content => setAttributes({ liveProduct2Company: content })}
															value={ attributes.liveProduct2Company }
															placeholder="Company Name"
														/>
													</h5>
													<h3 class="homeproducts__name">
														<PlainText
															onChange={ content => setAttributes({ liveProduct2Title: content })}
															value={ attributes.liveProduct2Title }
															placeholder="Product Name"
														/>
													</h3>
												</div>
											</li>
											<li class="homeproducts__item">
												<div class="homeproducts__product">
													<URLInputButton
														url={ attributes.liveProduct3Link }
														onChange={ (url, post ) => setAttributes( { liveProduct3Link: url } ) }
														className="homeproducts__linkBtn"
													/>
													<MediaUpload
														onSelect={ media => {setAttributes({liveProduct3ImageAlt: media.alt, liveProduct3ImageUrl: media.url }); } }
														type="image"
														value={ attributes.liveProduct3ImageID }
														render={ ({ open }) => getImageButton(open, attributes.liveProduct3ImageUrl) }
														className="homeproducts__image"
													/>
													<h5 class="homeproducts__company">
														<PlainText
															onChange={ content => setAttributes({ liveProduct3Company: content })}
															value={ attributes.liveProduct3Company }
															placeholder="Company Name"
														/>
													</h5>
													<h3 class="homeproducts__name">
														<PlainText
															onChange={ content => setAttributes({ liveProduct3Title: content })}
															value={ attributes.liveProduct3Title }
															placeholder="Product Name"
														/>
													</h3>
												</div>
											</li>
										</ul>
									</div>
									<div class="ad homeproducts__ad">
										Advertisement
										<PlainText
											onChange={ content => setAttributes({ liveProductAd: content })}
											value={ attributes.liveProductAd }
											placeholder="Enter Shortcode"
										/>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		)
	}
}

class DiscoverSave extends Component {

	render() {
		const { attributes } = this.props;
		const linkImage = (src, alt, className) => {
			if(!src) return null;

			if(alt) {
				return (
                	<img className={className} src={ src } alt={ alt } />
				);
			}
			return (
                <img className={className} src={ src } aria-hidden="true" />
			);
		};
		return (
			<section className="discover">
				<h2 className='discover__title showlist '>Discover More&nbsp;
					<div className="discover__feedtype showlist__feedtype js-toggle-feedchooser">Broadcast</div>
					<ul className="radiolist discover__feedchooser showlist__feedchooser">
						<li><h5>Discover More:</h5></li>
						<li><div className='option _selected' data-panel="broadcast">Broadcast</div></li>
						<li><div className='option' data-panel="streaming">Streaming</div></li>
						<li><div className='option' data-panel="content">Content Creation</div></li>
						<li><div className='option' data-panel="live">Live Event Production</div></li>
					</ul>
				</h2>
				<div className="discover__introtext introtext">
					<p>{ attributes.introCopy }</p>
				</div>

				<div className="nabcard">
					<div className="nabcard__content">
						<div className='discover__panel js-panel-broadcast _selected'>
							<div className="discover__content">
								<div className="discover__feature">
									<div className="textimage">
										<a className="textimage__link" href={ attributes.broadcastfeatureLink }>
											<div className="textimage__image">
												{ linkImage(attributes.broadcastfeatureImageUrl, attributes.broadcastfeatureImageAlt, 'textimage__img') }
											</div>
											<div className="textimage__text">
												<h2 className="discover__featuretitle">
													{ attributes.broadcastfeatureTitle }
												</h2>
											</div>
										</a>
									</div>
								</div>

								<div className="discover__company">
									<div class="slides">
										<h4 class="slides__title">
											{ attributes.broadcastCompanyTitle }
										</h4>
										<ul class="slides__list">
											<li class="slides__slide">
												<a href={ attributes.broadcastCompany1Link }>
													{ linkImage(attributes.broadcastCompany1ImageUrl, attributes.broadcastCompany1ImageAlt, 'slides__image') }
												
													<h5 class="slides__category">
														{ attributes.broadcastCompany1Category }
													</h5>
													<div class="introtext">
														{ attributes.broadcastCompany1Copy }
													</div>
												</a>
											</li>
											<li class="slides__slide">
												<a href={ attributes.broadcastCompany2Link }>
													{ linkImage(attributes.broadcastCompany2ImageUrl, attributes.broadcastCompany2ImageAlt, 'slides__image') }
												
													<h5 class="slides__category">
														{ attributes.broadcastCompany2Category }
													</h5>
													<div class="introtext">
														{ attributes.broadcastCompany2Copy }
													</div>
												</a>
											</li>
											<li class="slides__slide">
												<a href={ attributes.broadcastCompany3Link }>
													{ linkImage(attributes.broadcastCompany3ImageUrl, attributes.broadcastCompany3ImageAlt, 'slides__image') }
												
													<h5 class="slides__category">
														{ attributes.broadcastCompany3Category }
													</h5>
													<div class="introtext">
														{ attributes.broadcastCompany3Copy }
													</div>
												</a>
											</li>
										</ul>
									</div>
								</div>
							</div>

							<div className="discover__ad ad">
								Advertisement
								{ attributes.broadcastAd }
							</div>

							<div className="discover__products">
								<div class="homeproducts">
									<h4 class="homeproducts__title">Products</h4>
									<div class="homeproducts__listcontainer">
										<ul class="homeproducts__list">
											<li class="homeproducts__item">
												<a class="homeproducts__product" href="{ attributes.broadcastProduct1Link }">
													{ linkImage(attributes.broadcastProduct1ImageUrl, attributes.broadcastProduct1ImageAlt, 'homeproducts__image') }
													<h5 class="homeproducts__company">
														{ attributes.broadcastProduct1Company }
													</h5>
													<h3 class="homeproducts__name">
														{ attributes.broadcastProduct1Title }
													</h3>
												</a>
											</li>
											<li class="homeproducts__item">
												<a class="homeproducts__product" href="{ attributes.broadcastProduct2Link }">
													{ linkImage(attributes.broadcastProduct2ImageUrl, attributes.broadcastProduct2ImageAlt, 'homeproducts__image') }
													<h5 class="homeproducts__company">
														{ attributes.broadcastProduct2Company }
													</h5>
													<h3 class="homeproducts__name">
														{ attributes.broadcastProduct2Title }
													</h3>
												</a>
											</li>
											<li class="homeproducts__item">
												<a class="homeproducts__product" href="{ attributes.broadcastProduct3Link }">
													{ linkImage(attributes.broadcastProduct3ImageUrl, attributes.broadcastProduct3ImageAlt, 'homeproducts__image') }
													<h5 class="homeproducts__company">
														{ attributes.broadcastProduct3Company }
													</h5>
													<h3 class="homeproducts__name">
														{ attributes.broadcastProduct3Title }
													</h3>
												</a>
											</li>
										</ul>
									</div>
									<div class="ad homeproducts__ad">
										Advertisement
										{ attributes.broadcastProductAd }
									</div>
								</div>
							</div>
						</div>

						<div className='discover__panel js-panel-streaming'>
							<div className="discover__content">
								<div className="discover__feature">
									<div className="textimage">
										<a className="textimage__link" href={ attributes.streamingfeatureLink }>
											<div className="textimage__image">
												{ linkImage(attributes.streamingfeatureImageUrl, attributes.streamingfeatureImageAlt, 'textimage__img') }
											</div>
											<div className="textimage__text">
												<h2 className="discover__featuretitle">
													{ attributes.streamingfeatureTitle }
												</h2>
											</div>
										</a>
									</div>
								</div>

								<div className="discover__company">
									<div class="slides">
										<h4 class="slides__title">
											{ attributes.streamingCompanyTitle }
										</h4>
										<ul class="slides__list">
											<li class="slides__slide">
												<a href={ attributes.streamingCompany1Link }>
													{ linkImage(attributes.streamingCompany1ImageUrl, attributes.streamingCompany1ImageAlt, 'slides__image') }
												
													<h5 class="slides__category">
														{ attributes.streamingCompany1Category }
													</h5>
													<div class="introtext">
														{ attributes.streamingCompany1Copy }
													</div>
												</a>
											</li>
											<li class="slides__slide">
												<a href={ attributes.streamingCompany2Link }>
													{ linkImage(attributes.streamingCompany2ImageUrl, attributes.streamingCompany2ImageAlt, 'slides__image') }
												
													<h5 class="slides__category">
														{ attributes.streamingCompany2Category }
													</h5>
													<div class="introtext">
														{ attributes.streamingCompany2Copy }
													</div>
												</a>
											</li>
											<li class="slides__slide">
												<a href={ attributes.streamingCompany3Link }>
													{ linkImage(attributes.streamingCompany3ImageUrl, attributes.streamingCompany3ImageAlt, 'slides__image') }
												
													<h5 class="slides__category">
														{ attributes.streamingCompany3Category }
													</h5>
													<div class="introtext">
														{ attributes.streamingCompany3Copy }
													</div>
												</a>
											</li>
										</ul>
									</div>
								</div>
							</div>

							<div className="discover__ad ad">
								Advertisement
								{ attributes.streamingAd }
							</div>

							<div className="discover__products">
								<div class="homeproducts">
									<h4 class="homeproducts__title">Products</h4>
									<div class="homeproducts__listcontainer">
										<ul class="homeproducts__list">
											<li class="homeproducts__item">
												<a class="homeproducts__product" href="{ attributes.streamingProduct1Link }">
													{ linkImage(attributes.streamingProduct1ImageUrl, attributes.streamingProduct1ImageAlt, 'homeproducts__image') }
													<h5 class="homeproducts__company">
														{ attributes.streamingProduct1Company }
													</h5>
													<h3 class="homeproducts__name">
														{ attributes.streamingProduct1Title }
													</h3>
												</a>
											</li>
											<li class="homeproducts__item">
												<a class="homeproducts__product" href="{ attributes.streamingProduct2Link }">
													{ linkImage(attributes.streamingProduct2ImageUrl, attributes.streamingProduct2ImageAlt, 'homeproducts__image') }
													<h5 class="homeproducts__company">
														{ attributes.streamingProduct2Company }
													</h5>
													<h3 class="homeproducts__name">
														{ attributes.streamingProduct2Title }
													</h3>
												</a>
											</li>
											<li class="homeproducts__item">
												<a class="homeproducts__product" href="{ attributes.streamingProduct3Link }">
													{ linkImage(attributes.streamingProduct3ImageUrl, attributes.streamingProduct3ImageAlt, 'homeproducts__image') }
													<h5 class="homeproducts__company">
														{ attributes.streamingProduct3Company }
													</h5>
													<h3 class="homeproducts__name">
														{ attributes.streamingProduct3Title }
													</h3>
												</a>
											</li>
										</ul>
									</div>
									<div class="ad homeproducts__ad">
										Advertisement
										{ attributes.streamingProductAd }
									</div>
								</div>
							</div>
						</div>

						<div className='discover__panel js-panel-content'>
							<div className="discover__content">
								<div className="discover__feature">
									<div className="textimage">
										<a className="textimage__link" href={ attributes.contentfeatureLink }>
											<div className="textimage__image">
												{ linkImage(attributes.contentfeatureImageUrl, attributes.contentfeatureImageAlt, 'textimage__img') }
											</div>
											<div className="textimage__text">
												<h2 className="discover__featuretitle">
													{ attributes.contentfeatureTitle }
												</h2>
											</div>
										</a>
									</div>
								</div>

								<div className="discover__company">
									<div class="slides">
										<h4 class="slides__title">
											{ attributes.contentCompanyTitle }
										</h4>
										<ul class="slides__list">
											<li class="slides__slide">
												<a href={ attributes.contentCompany1Link }>
													{ linkImage(attributes.contentCompany1ImageUrl, attributes.contentCompany1ImageAlt, 'slides__image') }
												
													<h5 class="slides__category">
														{ attributes.contentCompany1Category }
													</h5>
													<div class="introtext">
														{ attributes.contentCompany1Copy }
													</div>
												</a>
											</li>
											<li class="slides__slide">
												<a href={ attributes.contentCompany2Link }>
													{ linkImage(attributes.contentCompany2ImageUrl, attributes.contentCompany2ImageAlt, 'slides__image') }
												
													<h5 class="slides__category">
														{ attributes.contentCompany2Category }
													</h5>
													<div class="introtext">
														{ attributes.contentCompany2Copy }
													</div>
												</a>
											</li>
											<li class="slides__slide">
												<a href={ attributes.contentCompany3Link }>
													{ linkImage(attributes.contentCompany3ImageUrl, attributes.contentCompany3ImageAlt, 'slides__image') }
												
													<h5 class="slides__category">
														{ attributes.contentCompany3Category }
													</h5>
													<div class="introtext">
														{ attributes.contentCompany3Copy }
													</div>
												</a>
											</li>
										</ul>
									</div>
								</div>
							</div>

							<div className="discover__ad ad">
								Advertisement
								{ attributes.contentAd }
							</div>

							<div className="discover__products">
								<div class="homeproducts">
									<h4 class="homeproducts__title">Products</h4>
									<div class="homeproducts__listcontainer">
										<ul class="homeproducts__list">
											<li class="homeproducts__item">
												<a class="homeproducts__product" href="{ attributes.contentProduct1Link }">
													{ linkImage(attributes.contentProduct1ImageUrl, attributes.contentProduct1ImageAlt, 'homeproducts__image') }
													<h5 class="homeproducts__company">
														{ attributes.contentProduct1Company }
													</h5>
													<h3 class="homeproducts__name">
														{ attributes.contentProduct1Title }
													</h3>
												</a>
											</li>
											<li class="homeproducts__item">
												<a class="homeproducts__product" href="{ attributes.contentProduct2Link }">
													{ linkImage(attributes.contentProduct2ImageUrl, attributes.contentProduct2ImageAlt, 'homeproducts__image') }
													<h5 class="homeproducts__company">
														{ attributes.contentProduct2Company }
													</h5>
													<h3 class="homeproducts__name">
														{ attributes.contentProduct2Title }
													</h3>
												</a>
											</li>
											<li class="homeproducts__item">
												<a class="homeproducts__product" href="{ attributes.contentProduct3Link }">
													{ linkImage(attributes.contentProduct3ImageUrl, attributes.contentProduct3ImageAlt, 'homeproducts__image') }
													<h5 class="homeproducts__company">
														{ attributes.contentProduct3Company }
													</h5>
													<h3 class="homeproducts__name">
														{ attributes.contentProduct3Title }
													</h3>
												</a>
											</li>
										</ul>
									</div>
									<div class="ad homeproducts__ad">
										Advertisement
										{ attributes.contentProductAd }
									</div>
								</div>
							</div>
						</div>

						<div className='discover__panel js-panel-live'>
							<div className="discover__content">
								<div className="discover__feature">
									<div className="textimage">
										<a className="textimage__link" href={ attributes.livefeatureLink }>
											<div className="textimage__image">
												{ linkImage(attributes.livefeatureImageUrl, attributes.livefeatureImageAlt, 'textimage__img') }
											</div>
											<div className="textimage__text">
												<h2 className="discover__featuretitle">
													{ attributes.livefeatureTitle }
												</h2>
											</div>
										</a>
									</div>
								</div>

								<div className="discover__company">
									<div class="slides">
										<h4 class="slides__title">
											{ attributes.liveCompanyTitle }
										</h4>
										<ul class="slides__list">
											<li class="slides__slide">
												<a href={ attributes.liveCompany1Link }>
													{ linkImage(attributes.liveCompany1ImageUrl, attributes.liveCompany1ImageAlt, 'slides__image') }
												
													<h5 class="slides__category">
														{ attributes.liveCompany1Category }
													</h5>
													<div class="introtext">
														{ attributes.liveCompany1Copy }
													</div>
												</a>
											</li>
											<li class="slides__slide">
												<a href={ attributes.liveCompany2Link }>
													{ linkImage(attributes.liveCompany2ImageUrl, attributes.liveCompany2ImageAlt, 'slides__image') }
												
													<h5 class="slides__category">
														{ attributes.liveCompany2Category }
													</h5>
													<div class="introtext">
														{ attributes.liveCompany2Copy }
													</div>
												</a>
											</li>
											<li class="slides__slide">
												<a href={ attributes.liveCompany3Link }>
													{ linkImage(attributes.liveCompany3ImageUrl, attributes.liveCompany3ImageAlt, 'slides__image') }
												
													<h5 class="slides__category">
														{ attributes.liveCompany3Category }
													</h5>
													<div class="introtext">
														{ attributes.liveCompany3Copy }
													</div>
												</a>
											</li>
										</ul>
									</div>
								</div>
							</div>

							<div className="discover__ad ad">
								Advertisement
								{ attributes.liveAd }
							</div>

							<div className="discover__products">
								<div class="homeproducts">
									<h4 class="homeproducts__title">Products</h4>
									<div class="homeproducts__listcontainer">
										<ul class="homeproducts__list">
											<li class="homeproducts__item">
												<a class="homeproducts__product" href="{ attributes.liveProduct1Link }">
													{ linkImage(attributes.liveProduct1ImageUrl, attributes.liveProduct1ImageAlt, 'homeproducts__image') }
													<h5 class="homeproducts__company">
														{ attributes.liveProduct1Company }
													</h5>
													<h3 class="homeproducts__name">
														{ attributes.liveProduct1Title }
													</h3>
												</a>
											</li>
											<li class="homeproducts__item">
												<a class="homeproducts__product" href="{ attributes.liveProduct2Link }">
													{ linkImage(attributes.liveProduct2ImageUrl, attributes.liveProduct2ImageAlt, 'homeproducts__image') }
													<h5 class="homeproducts__company">
														{ attributes.liveProduct2Company }
													</h5>
													<h3 class="homeproducts__name">
														{ attributes.liveProduct2Title }
													</h3>
												</a>
											</li>
											<li class="homeproducts__item">
												<a class="homeproducts__product" href="{ attributes.liveProduct3Link }">
													{ linkImage(attributes.liveProduct3ImageUrl, attributes.liveProduct3ImageAlt, 'homeproducts__image') }
													<h5 class="homeproducts__company">
														{ attributes.liveProduct3Company }
													</h5>
													<h3 class="homeproducts__name">
														{ attributes.liveProduct3Title }
													</h3>
												</a>
											</li>
										</ul>
									</div>
									<div class="ad homeproducts__ad">
										Advertisement
										{ attributes.liveProductAd }
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</section>
		);
	}
}

registerBlockType( 'cgb/block-discover-more', {
	// Block name. Block names must be string that contains a namespace prefix. Example: my-plugin/my-custom-block.
	title: __( 'Discover More Block' ), // Block title.
	icon: 'edit-page', // Block icon from Dashicons → https://developer.wordpress.org/resource/dashicons/.
	category: 'common', // Block category — Group blocks together based on common traits E.g. common, formatting, layout widgets, embed.
	keywords: [
		__( 'Discover' ),
		__( 'More' ),
	],
	attributes: {
		introCopy: {
			source: 'text'
		},
		
		broadcastfeatureLink: {
			attribute: 'href'
		},
		broadcastfeatureImageUrl: {
			attribute: 'src'
		},
		broadcastfeatureImageAlt: {
			attribute: 'alt'
		},
		broadcastfeatureTitle: {
			source: 'text'
		},
		broadcastCompanyTitle: {
			source: 'text'
		},
		broadcastCompany1Link: {
			attribute: 'href'
		},
		broadcastCompany1ImageUrl: {
			attribute: 'src'
		},
		broadcastCompany1ImageAlt: {
			attribute: 'alt'
		},
		broadcastCompany1Category: {
			source: 'text'
		},
		broadcastCompany1Copy: {
			source: 'text'
		},
		broadcastCompany2Link: {
			attribute: 'href'
		},
		broadcastCompany2ImageUrl: {
			attribute: 'src'
		},
		broadcastCompany2ImageAlt: {
			attribute: 'alt'
		},
		broadcastCompany2Category: {
			source: 'text'
		},
		broadcastCompany2Copy: {
			source: 'text'
		},
		broadcastCompany3Link: {
			attribute: 'href'
		},
		broadcastCompany3ImageUrl: {
			attribute: 'src'
		},
		broadcastCompany3ImageAlt: {
			attribute: 'alt'
		},
		broadcastCompany3Category: {
			source: 'text'
		},
		broadcastCompany3Copy: {
			source: 'text'
		},
		broadcastAd: {
			source: 'text'
		},
		broadcastProduct1Link: {
			attribute: 'href'
		},
		broadcastProduct1ImageUrl: {
			attribute: 'src'
		},
		broadcastProduct1ImageAlt: {
			attribute: 'alt'
		},
		broadcastProduct1Company: {
			source: 'text'
		},
		broadcastProduct1Title: {
			source: 'text'
		},
		broadcastProduct2Link: {
			attribute: 'href'
		},
		broadcastProduct2ImageUrl: {
			attribute: 'src'
		},
		broadcastProduct2ImageAlt: {
			attribute: 'alt'
		},
		broadcastProduct2Company: {
			source: 'text'
		},
		broadcastProduct2Title: {
			source: 'text'
		},
		broadcastProduct3Link: {
			attribute: 'href'
		},
		broadcastProduct3ImageUrl: {
			attribute: 'src'
		},
		broadcastProduct3Iompany: {
			attribute: 'alt'
		},
		broadcastProduct3Titlegory: {
			source: 'text'
		},
		broadcastProduct3Copy: {
			source: 'text'
		},
		broadcastProductAd: {
			source: 'text'
		},
		
		
		streamingfeatureLink: {
			attribute: 'href'
		},
		streamingfeatureImageUrl: {
			attribute: 'src'
		},
		streamingfeatureImageAlt: {
			attribute: 'alt'
		},
		streamingfeatureTitle: {
			source: 'text'
		},
		streamingCompanyTitle: {
			source: 'text'
		},
		streamingCompany1Link: {
			attribute: 'href'
		},
		streamingCompany1ImageUrl: {
			attribute: 'src'
		},
		streamingCompany1ImageAlt: {
			attribute: 'alt'
		},
		streamingCompany1Category: {
			source: 'text'
		},
		streamingCompany1Copy: {
			source: 'text'
		},
		streamingCompany2Link: {
			attribute: 'href'
		},
		streamingCompany2ImageUrl: {
			attribute: 'src'
		},
		streamingCompany2ImageAlt: {
			attribute: 'alt'
		},
		streamingCompany2Category: {
			source: 'text'
		},
		streamingCompany2Copy: {
			source: 'text'
		},
		streamingCompany3Link: {
			attribute: 'href'
		},
		streamingCompany3ImageUrl: {
			attribute: 'src'
		},
		streamingCompany3ImageAlt: {
			attribute: 'alt'
		},
		streamingCompany3Category: {
			source: 'text'
		},
		streamingCompany3Copy: {
			source: 'text'
		},
		streamingAd: {
			source: 'text'
		},
		streamingProduct1Link: {
			attribute: 'href'
		},
		streamingProduct1ImageUrl: {
			attribute: 'src'
		},
		streamingProduct1ImageAlt: {
			attribute: 'alt'
		},
		streamingProduct1Company: {
			source: 'text'
		},
		streamingProduct1Title: {
			source: 'text'
		},
		streamingProduct2Link: {
			attribute: 'href'
		},
		streamingProduct2ImageUrl: {
			attribute: 'src'
		},
		streamingProduct2ImageAlt: {
			attribute: 'alt'
		},
		streamingProduct2Company: {
			source: 'text'
		},
		streamingProduct2Title: {
			source: 'text'
		},
		streamingProduct3Link: {
			attribute: 'href'
		},
		streamingProduct3ImageUrl: {
			attribute: 'src'
		},
		streamingProduct3Iompany: {
			attribute: 'alt'
		},
		streamingProduct3Titlegory: {
			source: 'text'
		},
		streamingProduct3Copy: {
			source: 'text'
		},
		streamingProductAd: {
			source: 'text'
		},
		
		
		contentfeatureLink: {
			attribute: 'href'
		},
		contentfeatureImageUrl: {
			attribute: 'src'
		},
		contentfeatureImageAlt: {
			attribute: 'alt'
		},
		contentfeatureTitle: {
			source: 'text'
		},
		contentCompanyTitle: {
			source: 'text'
		},
		contentCompany1ImageUrl: {
			attribute: 'src'
		},
		contentCompany1ImageAlt: {
			attribute: 'alt'
		},
		contentCompany1Category: {
			source: 'text'
		},
		contentCompany1Copy: {
			source: 'text'
		},
		contentCompany2ImageUrl: {
			attribute: 'src'
		},
		contentCompany2ImageAlt: {
			attribute: 'alt'
		},
		contentCompany2Category: {
			source: 'text'
		},
		contentCompany2Copy: {
			source: 'text'
		},
		contentCompany3ImageUrl: {
			attribute: 'src'
		},
		contentCompany3ImageAlt: {
			attribute: 'alt'
		},
		contentCompany3Category: {
			source: 'text'
		},
		contentCompany3Copy: {
			source: 'text'
		},
		contentAd: {
			source: 'text'
		},
		contentProduct1ImageUrl: {
			attribute: 'src'
		},
		contentProduct1ImageAlt: {
			attribute: 'alt'
		},
		contentProduct1Company: {
			source: 'text'
		},
		contentProduct1Title: {
			source: 'text'
		},
		contentProduct2ImageUrl: {
			attribute: 'src'
		},
		contentProduct2ImageAlt: {
			attribute: 'alt'
		},
		contentProduct2Company: {
			source: 'text'
		},
		contentProduct2Title: {
			source: 'text'
		},
		contentProduct3ImageUrl: {
			attribute: 'src'
		},
		contentProduct3ImageAlt: {
			attribute: 'alt'
		},
		contentProduct3Company: {
			source: 'text'
		},
		contentProduct3Title: {
			source: 'text'
		},
		contentProductAd: {
			source: 'text'
		},
		

		livefeatureLink: {
			attribute: 'href'
		},
		livefeatureImageUrl: {
			attribute: 'src'
		},
		livefeatureImageAlt: {
			attribute: 'alt'
		},
		livefeatureTitle: {
			source: 'text'
		},
		liveCompanyTitle: {
			source: 'text'
		},
		liveCompany1ImageUrl: {
			attribute: 'src'
		},
		liveCompany1ImageAlt: {
			attribute: 'alt'
		},
		liveCompany1Category: {
			source: 'text'
		},
		liveCompany1Copy: {
			source: 'text'
		},
		liveCompany2ImageUrl: {
			attribute: 'src'
		},
		liveCompany2ImageAlt: {
			attribute: 'alt'
		},
		liveCompany2Category: {
			source: 'text'
		},
		liveCompany2Copy: {
			source: 'text'
		},
		liveCompany3ImageUrl: {
			attribute: 'src'
		},
		liveCompany3ImageAlt: {
			attribute: 'alt'
		},
		liveCompany3Category: {
			source: 'text'
		},
		liveCompany3Copy: {
			source: 'text'
		},
		liveAd: {
			source: 'text'
		},
		liveProduct1ImageUrl: {
			attribute: 'src'
		},
		liveProduct1ImageAlt: {
			attribute: 'alt'
		},
		liveProduct1Company: {
			source: 'text'
		},
		liveProduct1Title: {
			source: 'text'
		},
		liveProduct2ImageUrl: {
			attribute: 'src'
		},
		liveProduct2ImageAlt: {
			attribute: 'alt'
		},
		liveProduct2Company: {
			source: 'text'
		},
		liveProduct2Title: {
			source: 'text'
		},
		liveProduct3ImageUrl: {
			attribute: 'src'
		},
		liveProduct3ImageAlt: {
			attribute: 'alt'
		},
		liveProduct3Company: {
			source: 'text'
		},
		liveProduct3Title: {
			source: 'text'
		},
		liveProductAd: {
			source: 'text'
		},
		
	},

	edit: DiscoverEdit,


	save: DiscoverSave,
} );
