/**
 * BLOCK: related-pages
 *
 * Registering a basic block with Gutenberg.
 * Simple block, renders and saves the same content without any interactivity.
 */

//  Import CSS.
import './editor.scss';
import './style.scss';

const { __ } = wp.i18n; // Import __() from wp.i18n
const { registerBlockType } = wp.blocks; // Import registerBlockType() from wp.blocks
const { MediaUpload, PlainText, InnerBlocks, URLInputButton } = wp.blockEditor;
const { Button } = wp.components;


registerBlockType( 'cgb/block-related-pages', {
	// Block name. Block names must be string that contains a namespace prefix. Example: my-plugin/my-custom-block.
	title: __( 'Related Articles Block' ), // Block title.
	icon: 'admin-page', // Block icon from Dashicons → https://developer.wordpress.org/resource/dashicons/.
	category: 'common', // Block category — Group blocks together based on common traits E.g. common, formatting, layout widgets, embed.
	keywords: [
		__( 'Related' ),
	],

	attributes: {
		relatedTitle: {
			source: 'text',
			selector: '.related__title',
			value: 'Related Content'
		},
		relatedLinkUrl: {
			attribute: 'href',
			selector: '.related__linktag'
		},
		relatedLinkTitle: {
			source: 'text',
			selector: '.related__linkTitle'	
		},
		imageUrl: {
			attribute: 'src',
			selector: '.textimage__image'
		},
		imageAlt: {
			attribute: 'alt',
			selector: '.textimage__image'
		}
	},

	
	edit: ( props ) => {
		const { attributes, setAttributes } = props;
		const ALLOWED_BLOCKS = [ 'cgb/block-related-link-block' ];
		const getImageButton = (openEvent) => {
			if(attributes.imageUrl) {
				return (
					<img
						src={ attributes.imageUrl }
						onClick={ openEvent }
						className="image"
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
							Pick an image
						</Button>
					</div>
				);
			}
		};
		return (
			<div className="nabcard">
				<div className="nabcard__content">
					<div className="related">
						<h2 className="related__title">
							<PlainText
								onChange={ (content) => setAttributes({ relatedTitle: content }) }
								value={ attributes.relatedTitle }
								placeholder="Enter title"
							/>
						</h2>
						<div className="related__feature">
							<div className="textimage _topborder">
								<a className="related__linktag">
									<URLInputButton
										url={ attributes.relatedLinkUrl }
										onChange={ (url, post ) => setAttributes( { relatedLinkUrl: url } ) }
									/>
									<div className="textimage__image">
										<MediaUpload
											onSelect={ media => {setAttributes({imageAlt: media.alt, imageUrl: media.url }); } }
											type="image"
											value={ attributes.imageID }
											render={ ({ open }) => getImageButton(open) }
											className="textimage__img"
										/>
									</div>
									<div className="textimage__text">
										<h4 className="related__linkTitle">
											<PlainText
												onChange={ (content) => setAttributes({ relatedLinkTitle: content }) }
												value={ attributes.relatedLinkTitle }
												placeholder="Enter title"
											/>
										</h4>
									</div>
								</a>
							</div>
						</div>

					<div className="related__list">
						<InnerBlocks
							 allowedBlocks={ ALLOWED_BLOCKS }
						 />
					</div>
				</div>

				</div>
			</div>
		);
	},

	save: ( props ) => {
		const { attributes } = props;
		const linkImage = (src, alt) => {
			if(!src) return null;

			if(alt) {
				return (
                	<img className="textimage__img" src={ src } alt={ alt } />
				);
			}
			return (
                <img className="textimage__img" src={ src } aria-hidden="true" />
			);
		};
		return (
			<div className="nabcard">
				<div className="nabcard__content">
					<div className="related">
						<h2 className="related__title">
							{ attributes.relatedTitle }
						</h2>
						<div className="related__feature">
							<div className="textimage _topborder">
								<a className="related__linktag" href={ attributes.relatedLinkUrl }>
									<div className="textimage__image">
										{ linkImage(attributes.imageUrl, attributes.imageAlt) }
									</div>
									<div className="textimage__text">
										<h4 className="related__linkTitle">
											{ attributes.relatedLinkTitle }
										</h4>
									</div>
								</a>
							</div>
						</div>

					<div className="related__list">
						<InnerBlocks.Content />
					</div>
				</div>

				</div>
			</div>
		);
	},
} );
