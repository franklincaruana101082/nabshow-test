/**
 * BLOCK: related-link-block
 *
 * Registering a basic block with Gutenberg.
 * Simple block, renders and saves the same content without any interactivity.
 */

//  Import CSS.
import './editor.scss';
import './style.scss';

const { __ } = wp.i18n; // Import __() from wp.i18n
const { registerBlockType } = wp.blocks; // Import registerBlockType() from wp.blocks
const { MediaUpload, PlainText, InspectorControls } = wp.blockEditor;
const { Button, PanelBody, PanelRow, ToggleControl } = wp.components;


registerBlockType( 'cgb/block-related-link-block', {
	// Block name. Block names must be string that contains a namespace prefix. Example: my-plugin/my-custom-block.
	title: __( 'related-link-block' ), // Block title.
	icon: 'admin-links', // Block icon from Dashicons → https://developer.wordpress.org/resource/dashicons/.
	category: 'common', // Block category — Group blocks together based on common traits E.g. common, formatting, layout widgets, embed.
	keywords: [
		__( 'related link' ),
		__( 'Link' ),
	],
	supports: {
		link: true
	},

	attributes: {
		linkUrl: {
			attribute: 'href',
			selector: '.relatedlink'
		},
		isSponsored: {
			type: 'boolean',
			default: false
		},
		hasVideo: {
			type: 'boolean',
			default: false
		},
		category: {
			source: 'text',
			selector: '.relatedlink__category'
		},
		title: {
			source: 'text',
			selector: '.relatedlink__title'
		},
		imageUrl: {
			attribute: 'src',
			selector: '.relatedlink__img'
		},
		imageAlt: {
			attribute: 'alt',
			selector: '.relatedlink__img'
		}

	},

	/**
	 * The edit function describes the structure of your block in the context of the editor.
	 * This represents what the editor will render when the block is used.
	 *
	 * The "edit" property must be a valid function.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/block-api/block-edit-save/
	 *
	 * @param {Object} props Props.
	 * @returns {Mixed} JSX Component.
	 */
	edit: ( props ) => {
		const { attributes, setAttributes } = props;
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
							className="button button-large"
						>
							Pick an image (optional)
						</Button>
					</div>
				);
			}
		};
		return (
			<div>
			<InspectorControls>
				<PanelBody
					title="Link Options"
					initialOpen={true}
				>
					<PanelRow>
						<PlainText
							onChange={ content => setAttributes({ linkUrl: content })}
							value={ attributes.linkUrl }
							placeholder="Enter URL"
						/>
					</PanelRow>
					<PanelRow>
						<ToggleControl
							label="Links to video"
							checked={ attributes.hasVideo }
							onChange={ content => setAttributes({ hasVideo: content })}
						/>
					</PanelRow>
					<PanelRow>
						<ToggleControl
							label="Sponsored Content"
							checked={ attributes.isSponsored }
							onChange={ content => setAttributes({ isSponsored: content })}
						/>
					</PanelRow>
				</PanelBody>
			</InspectorControls>

			<div className={(attributes.isSponsored ? 'relatedlink _sponsored' : 'relatedlink')}>
				<div className={(attributes.hasVideo ? 'relatedlink__image _video' : 'relatedlink__image')}>
					<MediaUpload
						onSelect={ media => {setAttributes({imageAlt: media.alt, imageUrl: media.url }); } }
						type="image"
						value={ attributes.imageID }
						render={ ({ open }) => getImageButton(open) }
						className="relatedlink__img"
					/>
				</div>
				<h5 className="relatedlink__category">
					<PlainText
						onChange={ content => setAttributes({ category: content })}
						value={ attributes.category }
						placeholder="Category name"
					/>
				</h5>
				<h4 className="relatedlink__title">
	            	<PlainText
	            		onChange={ content => setAttributes({ title: content }) }
	            		value={ attributes.title }
	            		placeholder="Very short description or title"
	            		className="heading"
	            	/>
            	</h4>
            </div>
            </div>
		);
	},

	/**
	 * The save function defines the way in which the different attributes should be combined
	 * into the final markup, which is then serialized by Gutenberg into post_content.
	 *
	 * The "save" property must be specified and must be a valid function.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/block-api/block-edit-save/
	 *
	 * @param {Object} props Props.
	 * @returns {Mixed} JSX Frontend HTML.
	 */
	save: ( props ) => {
		const { attributes } = props;
		const linkImage = (src, alt) => {
			if(!src) return null;

			if(alt) {
				return (
					<div className={(attributes.hasVideo ? 'relatedlink__image _video' : 'relatedlink__image')} style={"background-image: url('"+ src +"');"}>
                		<img className="relatedlink__img" src={ src } alt={ alt } />
              		</div>
				);
			}
			return (
				<div className={(attributes.hasVideo ? 'relatedlink__image _video' : 'relatedlink__image')} style={"background-image: url('"+ src +"');"}>
                	<img className="relatedlink__img" src={ src } aria-hidden="true" />
              	</div>
			);
		};
		return (
			<a href={ attributes.linkUrl } className={(attributes.isSponsored ? 'relatedlink _sponsored' : 'relatedlink')}>
              { linkImage(attributes.imageUrl, attributes.imageAlt) }
              <h5 className="relatedlink__category">{ attributes.category }</h5>
              <h4 className="relatedlink__title">{ attributes.title }</h4>
            </a>
		);
	},
} );
