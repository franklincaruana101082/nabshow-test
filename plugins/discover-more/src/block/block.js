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
						<div className={'discover__panel js-panel-broadcast '+ this.state.broadcast}>
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
									<div className="slides">
										<h4 className="slides__title">
											<PlainText
												onChange={ content => setAttributes({ broadcastCompanyTitle: content })}
												value={ attributes.broadcastCompanyTitle }
												placeholder="Company Features Title"
											/>
										</h4>
										<ul className="slides__list">
											<li className="slides__slide company1">
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
												<h5 className="slides__category">
													<PlainText
														onChange={ content => setAttributes({ broadcastCompany1Category: content })}
														value={ attributes.broadcastCompany1Category }
														placeholder="Category/Title"
													/>
												</h5>
												<div className="introtext">
													<PlainText
														onChange={ content => setAttributes({ broadcastCompany1Copy: content })}
														value={ attributes.broadcastCompany1Copy }
														placeholder="Teaser Copy"
													/>
												</div>
											</li>
											<li className="slides__slide company2">
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
												<h5 className="slides__category">
													<PlainText
														onChange={ content => setAttributes({ broadcastCompany2Category: content })}
														value={ attributes.broadcastCompany2Category }
														placeholder="Category/Title"
													/>
												</h5>
												<div className="introtext">
													<PlainText
														onChange={ content => setAttributes({ broadcastCompany2Copy: content })}
														value={ attributes.broadcastCompany2Copy }
														placeholder="Teaser Copy"
													/>
												</div>
											</li>
											<li className="slides__slide company3">
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
												<h5 className="slides__category">
													<PlainText
														onChange={ content => setAttributes({ broadcastCompany3Category: content })}
														value={ attributes.broadcastCompany3Category }
														placeholder="Category/Title"
													/>
												</h5>
												<div className="introtext">
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
								<div className="discover__adItem">
									<PlainText
										onChange={ content => setAttributes({ broadcastAd: content })}
										value={ attributes.broadcastAd }
										placeholder="Enter Shortcode"
									/>
								</div>
							</div>

							<div className="discover__products">
								<div className="homeproducts">
									<h4 className="homeproducts__title">Products</h4>
									<div className="homeproducts__listcontainer">
										<ul className="homeproducts__list">
											<li className="homeproducts__item product1">
												<a className="homeproducts__product">
													<URLInputButton
														url={ attributes.broadcastProduct1Link }
														onChange={ (url, post ) => setAttributes( { broadcastProduct1Link: url } ) }
													/>
													<MediaUpload
														onSelect={ media => {setAttributes({broadcastProduct1ImageAlt: media.alt, broadcastProduct1ImageUrl: media.url }); } }
														type="image"
														value={ attributes.broadcastProduct1ImageID }
														render={ ({ open }) => getImageButton(open, attributes.broadcastProduct1ImageUrl) }
														className="homeproducts__image"
													/>
													<h5 className="homeproducts__company">
														<PlainText
															onChange={ content => setAttributes({ broadcastProduct1Company: content })}
															value={ attributes.broadcastProduct1Company }
															placeholder="Company Name"
														/>
													</h5>
													<h3 className="homeproducts__name">
														<PlainText
															onChange={ content => setAttributes({ broadcastProduct1Title: content })}
															value={ attributes.broadcastProduct1Title }
															placeholder="Product Name"
														/>
													</h3>
												</a>
											</li>
											<li className="homeproducts__item product2">
												<a className="homeproducts__product">
													<URLInputButton
														url={ attributes.broadcastProduct2Link }
														onChange={ (url, post ) => setAttributes( { broadcastProduct2Link: url } ) }
													/>
													<MediaUpload
														onSelect={ media => {setAttributes({broadcastProduct2ImageAlt: media.alt, broadcastProduct2ImageUrl: media.url }); } }
														type="image"
														value={ attributes.broadcastProduct2ImageID }
														render={ ({ open }) => getImageButton(open, attributes.broadcastProduct2ImageUrl) }
														className="homeproducts__image"
													/>
													<h5 className="homeproducts__company">
														<PlainText
															onChange={ content => setAttributes({ broadcastProduct2Company: content })}
															value={ attributes.broadcastProduct2Company }
															placeholder="Company Name"
														/>
													</h5>
													<h3 className="homeproducts__name">
														<PlainText
															onChange={ content => setAttributes({ broadcastProduct2Title: content })}
															value={ attributes.broadcastProduct2Title }
															placeholder="Product Name"
														/>
													</h3>
												</a>
											</li>
											<li className="homeproducts__item product3">
												<a className="homeproducts__product">
													<URLInputButton
														url={ attributes.broadcastProduct3Link }
														onChange={ (url, post ) => setAttributes( { broadcastProduct3Link: url } ) }
													/>
													<MediaUpload
														onSelect={ media => {setAttributes({broadcastProduct3ImageAlt: media.alt, broadcastProduct3ImageUrl: media.url }); } }
														type="image"
														value={ attributes.broadcastProduct3ImageID }
														render={ ({ open }) => getImageButton(open, attributes.broadcastProduct3ImageUrl) }
														className="homeproducts__image"
													/>
													<h5 className="homeproducts__company">
														<PlainText
															onChange={ content => setAttributes({ broadcastProduct3Company: content })}
															value={ attributes.broadcastProduct3Company }
															placeholder="Company Name"
														/>
													</h5>
													<h3 className="homeproducts__name">
														<PlainText
															onChange={ content => setAttributes({ broadcastProduct3Title: content })}
															value={ attributes.broadcastProduct3Title }
															placeholder="Product Name"
														/>
													</h3>
												</a>
											</li>
										</ul>
									</div>
									<div className="ad homeproducts__ad">
										Advertisement
										<div className="homeproducts__adItem">
											<PlainText
												onChange={ content => setAttributes({ broadcastProductAd: content })}
												value={ attributes.broadcastProductAd }
												placeholder="Enter Shortcode"
											/>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div className={'discover__panel js-panel-streaming '+ this.state.streaming}>
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
									<div className="slides">
										<h4 className="slides__title">
											<PlainText
												onChange={ content => setAttributes({ streamingCompanyTitle: content })}
												value={ attributes.streamingCompanyTitle }
												placeholder="Company Features Title"
											/>
										</h4>
										<ul className="slides__list">
											<li className="slides__slide company1">
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
												<h5 className="slides__category">
													<PlainText
														onChange={ content => setAttributes({ streamingCompany1Category: content })}
														value={ attributes.streamingCompany1Category }
														placeholder="Category/Title"
													/>
												</h5>
												<div className="introtext">
													<PlainText
														onChange={ content => setAttributes({ streamingCompany1Copy: content })}
														value={ attributes.streamingCompany1Copy }
														placeholder="Teaser Copy"
													/>
												</div>
											</li>
											<li className="slides__slide company2">
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
												<h5 className="slides__category">
													<PlainText
														onChange={ content => setAttributes({ streamingCompany2Category: content })}
														value={ attributes.streamingCompany2Category }
														placeholder="Category/Title"
													/>
												</h5>
												<div className="introtext">
													<PlainText
														onChange={ content => setAttributes({ streamingCompany2Copy: content })}
														value={ attributes.streamingCompany2Copy }
														placeholder="Teaser Copy"
													/>
												</div>
											</li>
											<li className="slides__slide company3">
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
												<h5 className="slides__category">
													<PlainText
														onChange={ content => setAttributes({ streamingCompany3Category: content })}
														value={ attributes.streamingCompany3Category }
														placeholder="Category/Title"
													/>
												</h5>
												<div className="introtext">
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
								<div className="discover__adItem">
									<PlainText
										onChange={ content => setAttributes({ streamingAd: content })}
										value={ attributes.streamingAd }
										placeholder="Enter Shortcode"
									/>
								</div>
							</div>

							<div className="discover__products">
								<div className="homeproducts">
									<h4 className="homeproducts__title">Products</h4>
									<div className="homeproducts__listcontainer">
										<ul className="homeproducts__list">
											<li className="homeproducts__item product1">
												<a className="homeproducts__product">
													<URLInputButton
														url={ attributes.streamingProduct1Link }
														onChange={ (url, post ) => setAttributes( { streamingProduct1Link: url } ) }
													/>
													<MediaUpload
														onSelect={ media => {setAttributes({streamingProduct1ImageAlt: media.alt, streamingProduct1ImageUrl: media.url }); } }
														type="image"
														value={ attributes.streamingProduct1ImageID }
														render={ ({ open }) => getImageButton(open, attributes.streamingProduct1ImageUrl) }
														className="homeproducts__image"
													/>
													<h5 className="homeproducts__company">
														<PlainText
															onChange={ content => setAttributes({ streamingProduct1Company: content })}
															value={ attributes.streamingProduct1Company }
															placeholder="Company Name"
														/>
													</h5>
													<h3 className="homeproducts__name">
														<PlainText
															onChange={ content => setAttributes({ streamingProduct1Title: content })}
															value={ attributes.streamingProduct1Title }
															placeholder="Product Name"
														/>
													</h3>
												</a>
											</li>
											<li className="homeproducts__item product2">
												<a className="homeproducts__product">
													<URLInputButton
														url={ attributes.streamingProduct2Link }
														onChange={ (url, post ) => setAttributes( { streamingProduct2Link: url } ) }
													/>
													<MediaUpload
														onSelect={ media => {setAttributes({streamingProduct2ImageAlt: media.alt, streamingProduct2ImageUrl: media.url }); } }
														type="image"
														value={ attributes.streamingProduct2ImageID }
														render={ ({ open }) => getImageButton(open, attributes.streamingProduct2ImageUrl) }
														className="homeproducts__image"
													/>
													<h5 className="homeproducts__company">
														<PlainText
															onChange={ content => setAttributes({ streamingProduct2Company: content })}
															value={ attributes.streamingProduct2Company }
															placeholder="Company Name"
														/>
													</h5>
													<h3 className="homeproducts__name">
														<PlainText
															onChange={ content => setAttributes({ streamingProduct2Title: content })}
															value={ attributes.streamingProduct2Title }
															placeholder="Product Name"
														/>
													</h3>
												</a>
											</li>
											<li className="homeproducts__item product3">
												<a className="homeproducts__product">
													<URLInputButton
														url={ attributes.streamingProduct3Link }
														onChange={ (url, post ) => setAttributes( { streamingProduct3Link: url } ) }
													/>
													<MediaUpload
														onSelect={ media => {setAttributes({streamingProduct3ImageAlt: media.alt, streamingProduct3ImageUrl: media.url }); } }
														type="image"
														value={ attributes.streamingProduct3ImageID }
														render={ ({ open }) => getImageButton(open, attributes.streamingProduct3ImageUrl) }
														className="homeproducts__image"
													/>
													<h5 className="homeproducts__company">
														<PlainText
															onChange={ content => setAttributes({ streamingProduct3Company: content })}
															value={ attributes.streamingProduct3Company }
															placeholder="Company Name"
														/>
													</h5>
													<h3 className="homeproducts__name">
														<PlainText
															onChange={ content => setAttributes({ streamingProduct3Title: content })}
															value={ attributes.streamingProduct3Title }
															placeholder="Product Name"
														/>
													</h3>
												</a>
											</li>
										</ul>
									</div>
									<div className="ad homeproducts__ad">
										Advertisement
										<div className="homeproducts__adItem">
											<PlainText
												onChange={ content => setAttributes({ streamingProductAd: content })}
												value={ attributes.streamingProductAd }
												placeholder="Enter Shortcode"
											/>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div className={'discover__panel js-panel-content '+ this.state.content}>
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
									<div className="slides">
										<h4 className="slides__title">
											<PlainText
												onChange={ content => setAttributes({ contentCompanyTitle: content })}
												value={ attributes.contentCompanyTitle }
												placeholder="Company Features Title"
											/>
										</h4>
										<ul className="slides__list">
											<li className="slides__slide company1">
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
												<h5 className="slides__category">
													<PlainText
														onChange={ content => setAttributes({ contentCompany1Category: content })}
														value={ attributes.contentCompany1Category }
														placeholder="Category/Title"
													/>
												</h5>
												<div className="introtext">
													<PlainText
														onChange={ content => setAttributes({ contentCompany1Copy: content })}
														value={ attributes.contentCompany1Copy }
														placeholder="Teaser Copy"
													/>
												</div>
											</li>
											<li className="slides__slide company2">
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
												<h5 className="slides__category">
													<PlainText
														onChange={ content => setAttributes({ contentCompany2Category: content })}
														value={ attributes.contentCompany2Category }
														placeholder="Category/Title"
													/>
												</h5>
												<div className="introtext">
													<PlainText
														onChange={ content => setAttributes({ contentCompany2Copy: content })}
														value={ attributes.contentCompany2Copy }
														placeholder="Teaser Copy"
													/>
												</div>
											</li>
											<li className="slides__slide company3">
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
												<h5 className="slides__category">
													<PlainText
														onChange={ content => setAttributes({ contentCompany3Category: content })}
														value={ attributes.contentCompany3Category }
														placeholder="Category/Title"
													/>
												</h5>
												<div className="introtext">
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
								<div className="discover__adItem">
									<div className="discover__adItem">
										<PlainText
											onChange={ content => setAttributes({ contentAd: content })}
											value={ attributes.contentAd }
											placeholder="Enter Shortcode"
										/>
									</div>
								</div>
							</div>

							<div className="discover__products">
								<div className="homeproducts">
									<h4 className="homeproducts__title">Products</h4>
									<div className="homeproducts__listcontainer">
										<ul className="homeproducts__list">
											<li className="homeproducts__item product1">
												<a className="homeproducts__product">
													<URLInputButton
														url={ attributes.contentProduct1Link }
														onChange={ (url, post ) => setAttributes( { contentProduct1Link: url } ) }
													/>
													<MediaUpload
														onSelect={ media => {setAttributes({contentProduct1ImageAlt: media.alt, contentProduct1ImageUrl: media.url }); } }
														type="image"
														value={ attributes.contentProduct1ImageID }
														render={ ({ open }) => getImageButton(open, attributes.contentProduct1ImageUrl) }
														className="homeproducts__image"
													/>
													<h5 className="homeproducts__company">
														<PlainText
															onChange={ content => setAttributes({ contentProduct1Company: content })}
															value={ attributes.contentProduct1Company }
															placeholder="Company Name"
														/>
													</h5>
													<h3 className="homeproducts__name">
														<PlainText
															onChange={ content => setAttributes({ contentProduct1Title: content })}
															value={ attributes.contentProduct1Title }
															placeholder="Product Name"
														/>
													</h3>
												</a>
											</li>
											<li className="homeproducts__item product2">
												<a className="homeproducts__product">
													<URLInputButton
														url={ attributes.contentProduct2Link }
														onChange={ (url, post ) => setAttributes( { contentProduct2Link: url } ) }
													/>
													<MediaUpload
														onSelect={ media => {setAttributes({contentProduct2ImageAlt: media.alt, contentProduct2ImageUrl: media.url }); } }
														type="image"
														value={ attributes.contentProduct2ImageID }
														render={ ({ open }) => getImageButton(open, attributes.contentProduct2ImageUrl) }
														className="homeproducts__image"
													/>
													<h5 className="homeproducts__company">
														<PlainText
															onChange={ content => setAttributes({ contentProduct2Company: content })}
															value={ attributes.contentProduct2Company }
															placeholder="Company Name"
														/>
													</h5>
													<h3 className="homeproducts__name">
														<PlainText
															onChange={ content => setAttributes({ contentProduct2Title: content })}
															value={ attributes.contentProduct2Title }
															placeholder="Product Name"
														/>
													</h3>
												</a>
											</li>
											<li className="homeproducts__item product3">
												<a className="homeproducts__product">
													<URLInputButton
														url={ attributes.contentProduct3Link }
														onChange={ (url, post ) => setAttributes( { contentProduct3Link: url } ) }
													/>
													<MediaUpload
														onSelect={ media => {setAttributes({contentProduct3ImageAlt: media.alt, contentProduct3ImageUrl: media.url }); } }
														type="image"
														value={ attributes.contentProduct3ImageID }
														render={ ({ open }) => getImageButton(open, attributes.contentProduct3ImageUrl) }
														className="homeproducts__image"
													/>
													<h5 className="homeproducts__company">
														<PlainText
															onChange={ content => setAttributes({ contentProduct3Company: content })}
															value={ attributes.contentProduct3Company }
															placeholder="Company Name"
														/>
													</h5>
													<h3 className="homeproducts__name">
														<PlainText
															onChange={ content => setAttributes({ contentProduct3Title: content })}
															value={ attributes.contentProduct3Title }
															placeholder="Product Name"
														/>
													</h3>
												</a>
											</li>
										</ul>
									</div>
									<div className="ad homeproducts__ad">
										Advertisement
										<div className="homeproducts__adItem">
											<PlainText
												onChange={ content => setAttributes({ contentProductAd: content })}
												value={ attributes.contentProductAd }
												placeholder="Enter Shortcode"
											/>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div className={'discover__panel js-panel-live '+ this.state.live}>
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
									<div className="slides">
										<h4 className="slides__title">
											<PlainText
												onChange={ content => setAttributes({ liveCompanyTitle: content })}
												value={ attributes.liveCompanyTitle }
												placeholder="Company Features Title"
											/>
										</h4>
										<ul className="slides__list">
											<li className="slides__slide company1">
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
												<h5 className="slides__category">
													<PlainText
														onChange={ content => setAttributes({ liveCompany1Category: content })}
														value={ attributes.liveCompany1Category }
														placeholder="Category/Title"
													/>
												</h5>
												<div className="introtext">
													<PlainText
														onChange={ content => setAttributes({ liveCompany1Copy: content })}
														value={ attributes.liveCompany1Copy }
														placeholder="Teaser Copy"
													/>
												</div>
											</li>
											<li className="slides__slide company2">
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
												<h5 className="slides__category">
													<PlainText
														onChange={ content => setAttributes({ liveCompany2Category: content })}
														value={ attributes.liveCompany2Category }
														placeholder="Category/Title"
													/>
												</h5>
												<div className="introtext">
													<PlainText
														onChange={ content => setAttributes({ liveCompany2Copy: content })}
														value={ attributes.liveCompany2Copy }
														placeholder="Teaser Copy"
													/>
												</div>
											</li>
											<li className="slides__slide company3">
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
												<h5 className="slides__category">
													<PlainText
														onChange={ content => setAttributes({ liveCompany3Category: content })}
														value={ attributes.liveCompany3Category }
														placeholder="Category/Title"
													/>
												</h5>
												<div className="introtext">
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
								<div className="discover__adItem">
									<PlainText
										onChange={ content => setAttributes({ liveAd: content })}
										value={ attributes.liveAd }
										placeholder="Enter Shortcode"
									/>
								</div>
							</div>

							<div className="discover__products">
								<div className="homeproducts">
									<h4 className="homeproducts__title">Products</h4>
									<div className="homeproducts__listcontainer">
										<ul className="homeproducts__list">
											<li className="homeproducts__item product1">
												<a className="homeproducts__product">
													<URLInputButton
														url={ attributes.liveProduct1Link }
														onChange={ (url, post ) => setAttributes( { liveProduct1Link: url } ) }
													/>
													<MediaUpload
														onSelect={ media => {setAttributes({liveProduct1ImageAlt: media.alt, liveProduct1ImageUrl: media.url }); } }
														type="image"
														value={ attributes.liveProduct1ImageID }
														render={ ({ open }) => getImageButton(open, attributes.liveProduct1ImageUrl) }
														className="homeproducts__image"
													/>
													<h5 className="homeproducts__company">
														<PlainText
															onChange={ content => setAttributes({ liveProduct1Company: content })}
															value={ attributes.liveProduct1Company }
															placeholder="Company Name"
														/>
													</h5>
													<h3 className="homeproducts__name">
														<PlainText
															onChange={ content => setAttributes({ liveProduct1Title: content })}
															value={ attributes.liveProduct1Title }
															placeholder="Product Name"
														/>
													</h3>
												</a>
											</li>
											<li className="homeproducts__item product2">
												<a className="homeproducts__product">
													<URLInputButton
														url={ attributes.liveProduct2Link }
														onChange={ (url, post ) => setAttributes( { liveProduct2Link: url } ) }
													/>
													<MediaUpload
														onSelect={ media => {setAttributes({liveProduct2ImageAlt: media.alt, liveProduct2ImageUrl: media.url }); } }
														type="image"
														value={ attributes.liveProduct2ImageID }
														render={ ({ open }) => getImageButton(open, attributes.liveProduct2ImageUrl) }
														className="homeproducts__image"
													/>
													<h5 className="homeproducts__company">
														<PlainText
															onChange={ content => setAttributes({ liveProduct2Company: content })}
															value={ attributes.liveProduct2Company }
															placeholder="Company Name"
														/>
													</h5>
													<h3 className="homeproducts__name">
														<PlainText
															onChange={ content => setAttributes({ liveProduct2Title: content })}
															value={ attributes.liveProduct2Title }
															placeholder="Product Name"
														/>
													</h3>
												</a>
											</li>
											<li className="homeproducts__item product3">
												<a className="homeproducts__product">
													<URLInputButton
														url={ attributes.liveProduct3Link }
														onChange={ (url, post ) => setAttributes( { liveProduct3Link: url } ) }
													/>
													<MediaUpload
														onSelect={ media => {setAttributes({liveProduct3ImageAlt: media.alt, liveProduct3ImageUrl: media.url }); } }
														type="image"
														value={ attributes.liveProduct3ImageID }
														render={ ({ open }) => getImageButton(open, attributes.liveProduct3ImageUrl) }
														className="homeproducts__image"
													/>
													<h5 className="homeproducts__company">
														<PlainText
															onChange={ content => setAttributes({ liveProduct3Company: content })}
															value={ attributes.liveProduct3Company }
															placeholder="Company Name"
														/>
													</h5>
													<h3 className="homeproducts__name">
														<PlainText
															onChange={ content => setAttributes({ liveProduct3Title: content })}
															value={ attributes.liveProduct3Title }
															placeholder="Product Name"
														/>
													</h3>
												</a>
											</li>
										</ul>
									</div>
									<div className="ad homeproducts__ad">
										Advertisement
										<div className="homeproducts__adItem">
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
									<div className="slides">
										<h4 className="slides__title">
											{ attributes.broadcastCompanyTitle }
										</h4>
										<ul className="slides__list">
											<li className="slides__slide company1">
												<a href={ attributes.broadcastCompany1Link }>
													{ linkImage(attributes.broadcastCompany1ImageUrl, attributes.broadcastCompany1ImageAlt, 'slides__image') }
												
													<h5 className="slides__category">
														{ attributes.broadcastCompany1Category }
													</h5>
													<div className="introtext">
														{ attributes.broadcastCompany1Copy }
													</div>
												</a>
											</li>
											<li className="slides__slide company2">
												<a href={ attributes.broadcastCompany2Link }>
													{ linkImage(attributes.broadcastCompany2ImageUrl, attributes.broadcastCompany2ImageAlt, 'slides__image') }
												
													<h5 className="slides__category">
														{ attributes.broadcastCompany2Category }
													</h5>
													<div className="introtext">
														{ attributes.broadcastCompany2Copy }
													</div>
												</a>
											</li>
											<li className="slides__slide company3">
												<a href={ attributes.broadcastCompany3Link }>
													{ linkImage(attributes.broadcastCompany3ImageUrl, attributes.broadcastCompany3ImageAlt, 'slides__image') }
												
													<h5 className="slides__category">
														{ attributes.broadcastCompany3Category }
													</h5>
													<div className="introtext">
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
								<div className="discover__adItem">
									{ attributes.broadcastAd }
								</div>
							</div>

							<div className="discover__products">
								<div className="homeproducts">
									<h4 className="homeproducts__title">Products</h4>
									<div className="homeproducts__listcontainer">
										<ul className="homeproducts__list">
											<li className="homeproducts__item product1">
												<a className="homeproducts__product" href="{ attributes.broadcastProduct1Link }">
													{ linkImage(attributes.broadcastProduct1ImageUrl, attributes.broadcastProduct1ImageAlt, 'homeproducts__image') }
													<h5 className="homeproducts__company">
														{ attributes.broadcastProduct1Company }
													</h5>
													<h3 className="homeproducts__name">
														{ attributes.broadcastProduct1Title }
													</h3>
												</a>
											</li>
											<li className="homeproducts__item product2">
												<a className="homeproducts__product" href="{ attributes.broadcastProduct2Link }">
													{ linkImage(attributes.broadcastProduct2ImageUrl, attributes.broadcastProduct2ImageAlt, 'homeproducts__image') }
													<h5 className="homeproducts__company">
														{ attributes.broadcastProduct2Company }
													</h5>
													<h3 className="homeproducts__name">
														{ attributes.broadcastProduct2Title }
													</h3>
												</a>
											</li>
											<li className="homeproducts__item product3">
												<a className="homeproducts__product" href="{ attributes.broadcastProduct3Link }">
													{ linkImage(attributes.broadcastProduct3ImageUrl, attributes.broadcastProduct3ImageAlt, 'homeproducts__image') }
													<h5 className="homeproducts__company">
														{ attributes.broadcastProduct3Company }
													</h5>
													<h3 className="homeproducts__name">
														{ attributes.broadcastProduct3Title }
													</h3>
												</a>
											</li>
										</ul>
									</div>
									<div className="ad homeproducts__ad">
										Advertisement
										<div className="homeproducts__adItem">
											{ attributes.broadcastProductAd }
										</div>
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
									<div className="slides">
										<h4 className="slides__title">
											{ attributes.streamingCompanyTitle }
										</h4>
										<ul className="slides__list">
											<li className="slides__slide company1">
												<a href={ attributes.streamingCompany1Link }>
													{ linkImage(attributes.streamingCompany1ImageUrl, attributes.streamingCompany1ImageAlt, 'slides__image') }
												
													<h5 className="slides__category">
														{ attributes.streamingCompany1Category }
													</h5>
													<div className="introtext">
														{ attributes.streamingCompany1Copy }
													</div>
												</a>
											</li>
											<li className="slides__slide company2">
												<a href={ attributes.streamingCompany2Link }>
													{ linkImage(attributes.streamingCompany2ImageUrl, attributes.streamingCompany2ImageAlt, 'slides__image') }
												
													<h5 className="slides__category">
														{ attributes.streamingCompany2Category }
													</h5>
													<div className="introtext">
														{ attributes.streamingCompany2Copy }
													</div>
												</a>
											</li>
											<li className="slides__slide company3">
												<a href={ attributes.streamingCompany3Link }>
													{ linkImage(attributes.streamingCompany3ImageUrl, attributes.streamingCompany3ImageAlt, 'slides__image') }
												
													<h5 className="slides__category">
														{ attributes.streamingCompany3Category }
													</h5>
													<div className="introtext">
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
								<div className="discover__adItem">
									<div className="discover__adItem">
								</div>
									{ attributes.streamingAd }
								</div>
							</div>

							<div className="discover__products">
								<div className="homeproducts">
									<h4 className="homeproducts__title">Products</h4>
									<div className="homeproducts__listcontainer">
										<ul className="homeproducts__list">
											<li className="homeproducts__item product1">
												<a className="homeproducts__product" href="{ attributes.streamingProduct1Link }">
													{ linkImage(attributes.streamingProduct1ImageUrl, attributes.streamingProduct1ImageAlt, 'homeproducts__image') }
													<h5 className="homeproducts__company">
														{ attributes.streamingProduct1Company }
													</h5>
													<h3 className="homeproducts__name">
														{ attributes.streamingProduct1Title }
													</h3>
												</a>
											</li>
											<li className="homeproducts__item product2">
												<a className="homeproducts__product" href="{ attributes.streamingProduct2Link }">
													{ linkImage(attributes.streamingProduct2ImageUrl, attributes.streamingProduct2ImageAlt, 'homeproducts__image') }
													<h5 className="homeproducts__company">
														{ attributes.streamingProduct2Company }
													</h5>
													<h3 className="homeproducts__name">
														{ attributes.streamingProduct2Title }
													</h3>
												</a>
											</li>
											<li className="homeproducts__item product3">
												<a className="homeproducts__product" href="{ attributes.streamingProduct3Link }">
													{ linkImage(attributes.streamingProduct3ImageUrl, attributes.streamingProduct3ImageAlt, 'homeproducts__image') }
													<h5 className="homeproducts__company">
														{ attributes.streamingProduct3Company }
													</h5>
													<h3 className="homeproducts__name">
														{ attributes.streamingProduct3Title }
													</h3>
												</a>
											</li>
										</ul>
									</div>
									<div className="ad homeproducts__ad">
										Advertisement
										<div className="homeproducts__adItem">
											{ attributes.streamingProductAd }
										</div>
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
									<div className="slides">
										<h4 className="slides__title">
											{ attributes.contentCompanyTitle }
										</h4>
										<ul className="slides__list">
											<li className="slides__slide company1">
												<a href={ attributes.contentCompany1Link }>
													{ linkImage(attributes.contentCompany1ImageUrl, attributes.contentCompany1ImageAlt, 'slides__image') }
												
													<h5 className="slides__category">
														{ attributes.contentCompany1Category }
													</h5>
													<div className="introtext">
														{ attributes.contentCompany1Copy }
													</div>
												</a>
											</li>
											<li className="slides__slide company2">
												<a href={ attributes.contentCompany2Link }>
													{ linkImage(attributes.contentCompany2ImageUrl, attributes.contentCompany2ImageAlt, 'slides__image') }
												
													<h5 className="slides__category">
														{ attributes.contentCompany2Category }
													</h5>
													<div className="introtext">
														{ attributes.contentCompany2Copy }
													</div>
												</a>
											</li>
											<li className="slides__slide company3">
												<a href={ attributes.contentCompany3Link }>
													{ linkImage(attributes.contentCompany3ImageUrl, attributes.contentCompany3ImageAlt, 'slides__image') }
												
													<h5 className="slides__category">
														{ attributes.contentCompany3Category }
													</h5>
													<div className="introtext">
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
								<div className="discover__adItem">
									<div className="discover__adItem">
								</div>
									{ attributes.contentAd }
								</div>
							</div>

							<div className="discover__products">
								<div className="homeproducts">
									<h4 className="homeproducts__title">Products</h4>
									<div className="homeproducts__listcontainer">
										<ul className="homeproducts__list">
											<li className="homeproducts__item product1">
												<a className="homeproducts__product" href="{ attributes.contentProduct1Link }">
													{ linkImage(attributes.contentProduct1ImageUrl, attributes.contentProduct1ImageAlt, 'homeproducts__image') }
													<h5 className="homeproducts__company">
														{ attributes.contentProduct1Company }
													</h5>
													<h3 className="homeproducts__name">
														{ attributes.contentProduct1Title }
													</h3>
												</a>
											</li>
											<li className="homeproducts__item product2">
												<a className="homeproducts__product" href="{ attributes.contentProduct2Link }">
													{ linkImage(attributes.contentProduct2ImageUrl, attributes.contentProduct2ImageAlt, 'homeproducts__image') }
													<h5 className="homeproducts__company">
														{ attributes.contentProduct2Company }
													</h5>
													<h3 className="homeproducts__name">
														{ attributes.contentProduct2Title }
													</h3>
												</a>
											</li>
											<li className="homeproducts__item product3">
												<a className="homeproducts__product" href="{ attributes.contentProduct3Link }">
													{ linkImage(attributes.contentProduct3ImageUrl, attributes.contentProduct3ImageAlt, 'homeproducts__image') }
													<h5 className="homeproducts__company">
														{ attributes.contentProduct3Company }
													</h5>
													<h3 className="homeproducts__name">
														{ attributes.contentProduct3Title }
													</h3>
												</a>
											</li>
										</ul>
									</div>
									<div className="ad homeproducts__ad">
										Advertisement
										<div className="homeproducts__adItem">
											{ attributes.contentProductAd }
										</div>
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
									<div className="slides">
										<h4 className="slides__title">
											{ attributes.liveCompanyTitle }
										</h4>
										<ul className="slides__list">
											<li className="slides__slide company1">
												<a href={ attributes.liveCompany1Link }>
													{ linkImage(attributes.liveCompany1ImageUrl, attributes.liveCompany1ImageAlt, 'slides__image') }
												
													<h5 className="slides__category">
														{ attributes.liveCompany1Category }
													</h5>
													<div className="introtext">
														{ attributes.liveCompany1Copy }
													</div>
												</a>
											</li>
											<li className="slides__slide company2">
												<a href={ attributes.liveCompany2Link }>
													{ linkImage(attributes.liveCompany2ImageUrl, attributes.liveCompany2ImageAlt, 'slides__image') }
												
													<h5 className="slides__category">
														{ attributes.liveCompany2Category }
													</h5>
													<div className="introtext">
														{ attributes.liveCompany2Copy }
													</div>
												</a>
											</li>
											<li className="slides__slide company3">
												<a href={ attributes.liveCompany3Link }>
													{ linkImage(attributes.liveCompany3ImageUrl, attributes.liveCompany3ImageAlt, 'slides__image') }
												
													<h5 className="slides__category">
														{ attributes.liveCompany3Category }
													</h5>
													<div className="introtext">
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
								<div className="discover__adItem">
									{ attributes.liveAd }
								</div>
							</div>

							<div className="discover__products">
								<div className="homeproducts">
									<h4 className="homeproducts__title">Products</h4>
									<div className="homeproducts__listcontainer">
										<ul className="homeproducts__list">
											<li className="homeproducts__item product1">
												<a className="homeproducts__product" href="{ attributes.liveProduct1Link }">
													{ linkImage(attributes.liveProduct1ImageUrl, attributes.liveProduct1ImageAlt, 'homeproducts__image') }
													<h5 className="homeproducts__company">
														{ attributes.liveProduct1Company }
													</h5>
													<h3 className="homeproducts__name">
														{ attributes.liveProduct1Title }
													</h3>
												</a>
											</li>
											<li className="homeproducts__item product2">
												<a className="homeproducts__product" href="{ attributes.liveProduct2Link }">
													{ linkImage(attributes.liveProduct2ImageUrl, attributes.liveProduct2ImageAlt, 'homeproducts__image') }
													<h5 className="homeproducts__company">
														{ attributes.liveProduct2Company }
													</h5>
													<h3 className="homeproducts__name">
														{ attributes.liveProduct2Title }
													</h3>
												</a>
											</li>
											<li className="homeproducts__item product3">
												<a className="homeproducts__product" href="{ attributes.liveProduct3Link }">
													{ linkImage(attributes.liveProduct3ImageUrl, attributes.liveProduct3ImageAlt, 'homeproducts__image') }
													<h5 className="homeproducts__company">
														{ attributes.liveProduct3Company }
													</h5>
													<h3 className="homeproducts__name">
														{ attributes.liveProduct3Title }
													</h3>
												</a>
											</li>
										</ul>
									</div>
									<div className="ad homeproducts__ad">
										Advertisement
										<div className="homeproducts__adItem">
											{ attributes.liveProductAd }
										</div>
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
			source: 'text',
			selector: '.discover__introtext'
		},
		
		broadcastfeatureLink: {
			type: 'string',
			attribute: 'href',
			selector: '.js-panel-broadcast .textimage__link'
		},
		broadcastfeatureImageUrl: {
			attribute: 'src',
			selector: '.js-panel-broadcast .textimage__image'
		},
		broadcastfeatureImageAlt: {
			attribute: 'alt',
			selector: '.js-panel-broadcast .textimage__image'
		},
		broadcastfeatureTitle: {
			source: 'text',
			selector: '.js-panel-broadcast .discover__featuretitle'
		},
		broadcastCompanyTitle: {
			source: 'text',
			selector: '.js-panel-broadcast .slides__title'
		},
		broadcastCompany1Link: {
			type: 'string',
			attribute: 'href',
			selector: '.js-panel-broadcast .company1.slides__slide a'
		},
		broadcastCompany1ImageUrl: {
			attribute: 'src',
			selector: '.js-panel-broadcast .company1 .slides__image'
		},
		broadcastCompany1ImageAlt: {
			attribute: 'alt',
			selector: '.js-panel-broadcast .company1 .slides__image'
		},
		broadcastCompany1Category: {
			source: 'text',
			selector: '.js-panel-broadcast .company1 .slides__category'
		},
		broadcastCompany1Copy: {
			source: 'text',
			selector: '.js-panel-broadcast .company1 .introtext'
		},
		broadcastCompany2Link: {
			type: 'string',
			attribute: 'href',
			selector: '.js-panel-broadcast .company2.slides__slide a'
		},
		broadcastCompany2ImageUrl: {
			attribute: 'src',
			selector: '.js-panel-broadcast .company2 .slides__image'
		},
		broadcastCompany2ImageAlt: {
			attribute: 'alt',
			selector: '.js-panel-broadcast .company2 .slides__image'
		},
		broadcastCompany2Category: {
			source: 'text',
			selector: '.js-panel-broadcast .company2 .slides__category'
		},
		broadcastCompany2Copy: {
			source: 'text',
			selector: '.js-panel-broadcast .company2 .introtext'
		},
		broadcastCompany3Link: {
			type: 'string',
			attribute: 'href',
			selector: '.js-panel-broadcast .company3.slides__slide a'
		},
		broadcastCompany3ImageUrl: {
			attribute: 'src',
			selector: '.js-panel-broadcast .company3 .slides__image'
		},
		broadcastCompany3ImageAlt: {
			attribute: 'alt',
			selector: '.js-panel-broadcast .company3 .slides__image'
		},
		broadcastCompany3Category: {
			source: 'text',
			selector: '.js-panel-broadcast .company3 .slides__category'
		},
		broadcastCompany3Copy: {
			source: 'text',
			selector: '.js-panel-broadcast .company3 .introtext'
		},
		broadcastAd: {
			source: 'text',
			selector: '.js-panel-broadcast .discover__adItem'
		},
		broadcastProduct1Link: {
			type: 'string',
			attribute: 'href',
			selector: '.js-panel-broadcast .product1 .homeproducts__product'
		},
		broadcastProduct1ImageUrl: {
			attribute: 'src',
			selector: '.js-panel-broadcast .product1 .homeproducts__image'
		},
		broadcastProduct1ImageAlt: {
			attribute: 'alt',
			selector: '.js-panel-broadcast .product1 .homeproducts__image'
		},
		broadcastProduct1Company: {
			source: 'text',
			selector: '.js-panel-broadcast .product1 .homeproducts__company'
		},
		broadcastProduct1Title: {
			source: 'text',
			selector: '.js-panel-broadcast .product1 .homeproducts__name'
		},
		broadcastProduct2Link: {
			type: 'string',
			attribute: 'href',
			selector: '.js-panel-broadcast .product2 .homeproducts__product'
		},
		broadcastProduct2ImageUrl: {
			attribute: 'src',
			selector: '.js-panel-broadcast .product2 .homeproducts__image'
		},
		broadcastProduct2ImageAlt: {
			attribute: 'alt',
			selector: '.js-panel-broadcast .product2 .homeproducts__image'
		},
		broadcastProduct2Company: {
			source: 'text',
			selector: '.js-panel-broadcast .product2 .homeproducts__company'
		},
		broadcastProduct2Title: {
			source: 'text',
			selector: '.js-panel-broadcast .product2 .homeproducts__name'
		},
		broadcastProduct3Link: {
			type: 'string',
			attribute: 'href',
			selector: '.js-panel-broadcast .product3 .homeproducts__product'
		},
		broadcastProduct3ImageUrl: {
			attribute: 'src',
			selector: '.js-panel-broadcast .product3 .homeproducts__image'
		},
		broadcastProduct3ImageAlt: {
			attribute: 'alt',
			selector: '.js-panel-broadcast .product3 .homeproducts__image'
		},
		broadcastProduct3Company: {
			attribute: 'alt',
			selector: '.js-panel-broadcast .product3 .homeproducts__company'
		},
		broadcastProduct3Title: {
			source: 'text',
			selector: '.js-panel-broadcast .product3 .homeproducts__name'
		},
		broadcastProductAd: {
			source: 'text',
			selector: '.js-panel-broadcast .homeproducts__adItem'
		},

		
		
		streamingfeatureLink: {
			type: 'string',
			attribute: 'href',
			selector: '.js-panel-streaming .textimage__link'
		},
		streamingfeatureImageUrl: {
			attribute: 'src',
			selector: '.js-panel-streaming .textimage__image'
		},
		streamingfeatureImageAlt: {
			attribute: 'alt',
			selector: '.js-panel-streaming .textimage__image'
		},
		streamingfeatureTitle: {
			source: 'text',
			selector: '.js-panel-streaming .discover__featuretitle'
		},
		streamingCompanyTitle: {
			source: 'text',
			selector: '.js-panel-streaming .slides__title'
		},
		streamingCompany1Link: {
			type: 'string',
			attribute: 'href',
			selector: '.js-panel-streaming .company1.slides__slide a'
		},
		streamingCompany1ImageUrl: {
			attribute: 'src',
			selector: '.js-panel-streaming .company1 .slides__image'
		},
		streamingCompany1ImageAlt: {
			attribute: 'alt',
			selector: '.js-panel-streaming .company1 .slides__image'
		},
		streamingCompany1Category: {
			source: 'text',
			selector: '.js-panel-streaming .company1 .slides__category'
		},
		streamingCompany1Copy: {
			source: 'text',
			selector: '.js-panel-streaming .company1 .introtext'
		},
		streamingCompany2Link: {
			type: 'string',
			attribute: 'href',
			selector: '.js-panel-streaming .company2.slides__slide a'
		},
		streamingCompany2ImageUrl: {
			attribute: 'src',
			selector: '.js-panel-streaming .company2 .slides__image'
		},
		streamingCompany2ImageAlt: {
			attribute: 'alt',
			selector: '.js-panel-streaming .company2 .slides__image'
		},
		streamingCompany2Category: {
			source: 'text',
			selector: '.js-panel-streaming .company2 .slides__category'
		},
		streamingCompany2Copy: {
			source: 'text',
			selector: '.js-panel-streaming .company2 .introtext'
		},
		streamingCompany3Link: {
			type: 'string',
			attribute: 'href',
			selector: '.js-panel-streaming .company3.slides__slide a'
		},
		streamingCompany3ImageUrl: {
			attribute: 'src',
			selector: '.js-panel-streaming .company3 .slides__image'
		},
		streamingCompany3ImageAlt: {
			attribute: 'alt',
			selector: '.js-panel-streaming .company3 .slides__image'
		},
		streamingCompany3Category: {
			source: 'text',
			selector: '.js-panel-streaming .company3 .slides__category'
		},
		streamingCompany3Copy: {
			source: 'text',
			selector: '.js-panel-streaming .company3 .introtext'
		},
		streamingAd: {
			source: 'text',
			selector: '.js-panel-streaming .discover__adItem'
		},
		streamingProduct1Link: {
			type: 'string',
			attribute: 'href',
			selector: '.js-panel-streaming .product1 .homeproducts__product'
		},
		streamingProduct1ImageUrl: {
			attribute: 'src',
			selector: '.js-panel-streaming .product1 .homeproducts__image'
		},
		streamingProduct1ImageAlt: {
			attribute: 'alt',
			selector: '.js-panel-streaming .product1 .homeproducts__image'
		},
		streamingProduct1Company: {
			source: 'text',
			selector: '.js-panel-streaming .product1 .homeproducts__company'
		},
		streamingProduct1Title: {
			source: 'text',
			selector: '.js-panel-streaming .product1 .homeproducts__name'
		},
		streamingProduct2Link: {
			type: 'string',
			attribute: 'href',
			selector: '.js-panel-streaming .product2 .homeproducts__product'
		},
		streamingProduct2ImageUrl: {
			attribute: 'src',
			selector: '.js-panel-streaming .product2 .homeproducts__image'
		},
		streamingProduct2ImageAlt: {
			attribute: 'alt',
			selector: '.js-panel-streaming .product2 .homeproducts__image'
		},
		streamingProduct2Company: {
			source: 'text',
			selector: '.js-panel-streaming .product2 .homeproducts__company'
		},
		streamingProduct2Title: {
			source: 'text',
			selector: '.js-panel-streaming .product2 .homeproducts__name'
		},
		streamingProduct3Link: {
			type: 'string',
			attribute: 'href',
			selector: '.js-panel-streaming .product3 .homeproducts__product'
		},
		streamingProduct3ImageUrl: {
			attribute: 'src',
			selector: '.js-panel-streaming .product3 .homeproducts__image'
		},
		streamingProduct3ImageAlt: {
			attribute: 'alt',
			selector: '.js-panel-streaming .product3 .homeproducts__image'
		},
		streamingProduct3Company: {
			attribute: 'alt',
			selector: '.js-panel-streaming .product3 .homeproducts__company'
		},
		streamingProduct3Title: {
			source: 'text',
			selector: '.js-panel-streaming .product3 .homeproducts__name'
		},
		streamingProductAd: {
			source: 'text',
			selector: '.js-panel-streaming .homeproducts__adItem'
		},

		
		
		contentfeatureLink: {
			type: 'string',
			attribute: 'href',
			selector: '.js-panel-content .textimage__link'
		},
		contentfeatureImageUrl: {
			attribute: 'src',
			selector: '.js-panel-content .textimage__image'
		},
		contentfeatureImageAlt: {
			attribute: 'alt',
			selector: '.js-panel-content .textimage__image'
		},
		contentfeatureTitle: {
			source: 'text',
			selector: '.js-panel-content .discover__featuretitle'
		},
		contentCompanyTitle: {
			source: 'text',
			selector: '.js-panel-content .slides__title'
		},
		contentCompany1Link: {
			type: 'string',
			attribute: 'href',
			selector: '.js-panel-content .company1.slides__slide a'
		},
		contentCompany1ImageUrl: {
			attribute: 'src',
			selector: '.js-panel-content .company1 .slides__image'
		},
		contentCompany1ImageAlt: {
			attribute: 'alt',
			selector: '.js-panel-content .company1 .slides__image'
		},
		contentCompany1Category: {
			source: 'text',
			selector: '.js-panel-content .company1 .slides__category'
		},
		contentCompany1Copy: {
			source: 'text',
			selector: '.js-panel-content .company1 .introtext'
		},
		contentCompany2Link: {
			type: 'string',
			attribute: 'href',
			selector: '.js-panel-content .company2.slides__slide a'
		},
		contentCompany2ImageUrl: {
			attribute: 'src',
			selector: '.js-panel-content .company2 .slides__image'
		},
		contentCompany2ImageAlt: {
			attribute: 'alt',
			selector: '.js-panel-content .company2 .slides__image'
		},
		contentCompany2Category: {
			source: 'text',
			selector: '.js-panel-content .company2 .slides__category'
		},
		contentCompany2Copy: {
			source: 'text',
			selector: '.js-panel-content .company2 .introtext'
		},
		contentCompany3Link: {
			type: 'string',
			attribute: 'href',
			selector: '.js-panel-content .company3.slides__slide a'
		},
		contentCompany3ImageUrl: {
			attribute: 'src',
			selector: '.js-panel-content .company3 .slides__image'
		},
		contentCompany3ImageAlt: {
			attribute: 'alt',
			selector: '.js-panel-content .company3 .slides__image'
		},
		contentCompany3Category: {
			source: 'text',
			selector: '.js-panel-content .company3 .slides__category'
		},
		contentCompany3Copy: {
			source: 'text',
			selector: '.js-panel-content .company3 .introtext'
		},
		contentAd: {
			source: 'text',
			selector: '.js-panel-content .discover__adItem'
		},
		contentProduct1Link: {
			type: 'string',
			attribute: 'href',
			selector: '.js-panel-content .product1 .homeproducts__product'
		},
		contentProduct1ImageUrl: {
			attribute: 'src',
			selector: '.js-panel-content .product1 .homeproducts__image'
		},
		contentProduct1ImageAlt: {
			attribute: 'alt',
			selector: '.js-panel-content .product1 .homeproducts__image'
		},
		contentProduct1Company: {
			source: 'text',
			selector: '.js-panel-content .product1 .homeproducts__company'
		},
		contentProduct1Title: {
			source: 'text',
			selector: '.js-panel-content .product1 .homeproducts__name'
		},
		contentProduct2Link: {
			type: 'string',
			attribute: 'href',
			selector: '.js-panel-content .product2 .homeproducts__product'
		},
		contentProduct2ImageUrl: {
			attribute: 'src',
			selector: '.js-panel-content .product2 .homeproducts__image'
		},
		contentProduct2ImageAlt: {
			attribute: 'alt',
			selector: '.js-panel-content .product2 .homeproducts__image'
		},
		contentProduct2Company: {
			source: 'text',
			selector: '.js-panel-content .product2 .homeproducts__company'
		},
		contentProduct2Title: {
			source: 'text',
			selector: '.js-panel-content .product2 .homeproducts__name'
		},
		contentProduct3Link: {
			type: 'string',
			attribute: 'href',
			selector: '.js-panel-content .product3 .homeproducts__product'
		},
		contentProduct3ImageUrl: {
			attribute: 'src',
			selector: '.js-panel-content .product3 .homeproducts__image'
		},
		contentProduct3ImageAlt: {
			attribute: 'alt',
			selector: '.js-panel-content .product3 .homeproducts__image'
		},
		contentProduct3Company: {
			source: 'text',
			selector: '.js-panel-content .product3 .homeproducts__company'
		},
		contentProduct3Title: {
			source: 'text',
			selector: '.js-panel-content .product3 .homeproducts__name'
		},
		contentProductAd: {
			source: 'text',
			selector: '.js-panel-content .homeproducts__adItem'
		},
		

		livefeatureLink: {
			type: 'string',
			attribute: 'href',
			selector: '.js-panel-live .textimage__link'
		},
		livefeatureImageUrl: {
			attribute: 'src',
			selector: '.js-panel-live .textimage__image'
		},
		livefeatureImageAlt: {
			attribute: 'alt',
			selector: '.js-panel-live .textimage__image'
		},
		livefeatureTitle: {
			source: 'text',
			selector: '.js-panel-live .discover__featuretitle'
		},
		liveCompanyTitle: {
			source: 'text',
			selector: '.js-panel-live .slides__title'
		},
		liveCompany1Link: {
			type: 'string',
			attribute: 'href',
			selector: '.js-panel-live .company1.slides__slide a'
		},
		liveCompany1ImageUrl: {
			attribute: 'src',
			selector: '.js-panel-live .company1 .slides__image'
		},
		liveCompany1ImageAlt: {
			attribute: 'alt',
			selector: '.js-panel-live .company1 .slides__image'
		},
		liveCompany1Category: {
			source: 'text',
			selector: '.js-panel-live .company1 .slides__category'
		},
		liveCompany1Copy: {
			source: 'text',
			selector: '.js-panel-live .company1 .introtext'
		},
		liveCompany2Link: {
			type: 'string',
			attribute: 'href',
			selector: '.js-panel-live .company2.slides__slide a'
		},
		liveCompany2ImageUrl: {
			attribute: 'src',
			selector: '.js-panel-live .company2 .slides__image'
		},
		liveCompany2ImageAlt: {
			attribute: 'alt',
			selector: '.js-panel-live .company2 .slides__image'
		},
		liveCompany2Category: {
			source: 'text',
			selector: '.js-panel-live .company2 .slides__category'
		},
		liveCompany2Copy: {
			source: 'text',
			selector: '.js-panel-live .company2 .introtext'
		},
		liveCompany3Link: {
			type: 'string',
			attribute: 'href',
			selector: '.js-panel-live .company3.slides__slide a'
		},
		liveCompany3ImageUrl: {
			attribute: 'src',
			selector: '.js-panel-live .company3 .slides__image'
		},
		liveCompany3ImageAlt: {
			attribute: 'alt',
			selector: '.js-panel-live .company3 .slides__image'
		},
		liveCompany3Category: {
			source: 'text',
			selector: '.js-panel-live .company3 .slides__category'
		},
		liveCompany3Copy: {
			source: 'text',
			selector: '.js-panel-live .company3 .introtext'
		},
		liveAd: {
			source: 'text',
			selector: '.js-panel-live .discover__adItem'
		},
		liveProduct1Link: {
			type: 'string',
			attribute: 'href',
			selector: '.js-panel-live .product1 .homeproducts__product'
		},
		liveProduct1ImageUrl: {
			attribute: 'src',
			selector: '.js-panel-live .product1 .homeproducts__image'
		},
		liveProduct1ImageAlt: {
			attribute: 'alt',
			selector: '.js-panel-live .product1 .homeproducts__image'
		},
		liveProduct1Company: {
			source: 'text',
			selector: '.js-panel-live .product1 .homeproducts__company'
		},
		liveProduct1Title: {
			source: 'text',
			selector: '.js-panel-live .product1 .homeproducts__name'
		},
		liveProduct2Link: {
			type: 'string',
			attribute: 'href',
			selector: '.js-panel-live .product2 .homeproducts__product'
		},
		liveProduct2ImageUrl: {
			attribute: 'src',
			selector: '.js-panel-live .product2 .homeproducts__image'
		},
		liveProduct2ImageAlt: {
			attribute: 'alt',
			selector: '.js-panel-live .product2 .homeproducts__image'
		},
		liveProduct2Company: {
			source: 'text',
			selector: '.js-panel-live .product2 .homeproducts__company'
		},
		liveProduct2Title: {
			source: 'text',
			selector: '.js-panel-live .product2 .homeproducts__name'
		},
		liveProduct3Link: {
			type: 'string',
			attribute: 'href',
			selector: '.js-panel-live .product3 .homeproducts__product'
		},
		liveProduct3ImageUrl: {
			attribute: 'src',
			selector: '.js-panel-live .product3 .homeproducts__image'
		},
		liveProduct3ImageAlt: {
			attribute: 'alt',
			selector: '.js-panel-live .product3 .homeproducts__image'
		},
		liveProduct3Company: {
			source: 'text',
			selector: '.js-panel-live .product3 .homeproducts__company'
		},
		liveProduct3Title: {
			source: 'text',
			selector: '.js-panel-live .product3 .homeproducts__name'
		},
		liveProductAd: {
			source: 'text',
			selector: '.js-panel-live .homeproducts__adItem'
		},
		
	},

	edit: DiscoverEdit,


	save: DiscoverSave,
} );
