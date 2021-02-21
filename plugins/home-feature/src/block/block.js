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
const { Component } = wp.element;
const { MediaUpload, PlainText, RichText, InspectorControls, BlockControls } = wp.blockEditor;
const { Button, PanelBody, PanelRow, ToggleControl } = wp.components;


class FeatureBlockEdit extends Component {
	getInspectorControls = () => {
		const { attributes, setAttributes } = this.props;
		return (
			<InspectorControls>
				<PanelBody
					title="Feature Options"
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
				</PanelBody>
			</InspectorControls>
		);
	}

	render() {
		const { attributes, setAttributes } = this.props;
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
		return ([
			this.getInspectorControls(),
			
			<div className="weekly__feature">
				<div className={(attributes.hasVideo ? 'weekly__image _video' : 'weekly__image')}>
					<MediaUpload
						onSelect={ media => {setAttributes({imageAlt: media.alt, imageUrl: media.url }); } }
						type="image"
						value={ attributes.imageID }
						render={ ({ open }) => getImageButton(open) }
						className="relatedlink__img"
					/>
				</div>
				<h2 className="weekly__headline">
	            	<PlainText
	            		onChange={ content => setAttributes({ title: content }) }
	            		value={ attributes.title }
	            		placeholder="Enter title"
	            		className="heading"
	            	/>
            	</h2>
            	<div className="weekly__desc introtext">
					<RichText
						onChange={ content => setAttributes({ body: content })}
						value={ attributes.body }
						multiline="p"
						placeholder="Enter description here"
					/>
				</div>
            </div>
		]);
	}
}


registerBlockType( 'cgb/home-feature-block', {
	// Block name. Block names must be string that contains a namespace prefix. Example: my-plugin/my-custom-block.
	title: __( 'Home Feature Block' ), // Block title.
	icon: 'cover-image', // Block icon from Dashicons → https://developer.wordpress.org/resource/dashicons/.
	category: 'common', // Block category — Group blocks together based on common traits E.g. common, formatting, layout widgets, embed.
	keywords: [
		__( 'Feature' ),
		__( 'Link' ),
	],

	attributes: {
		linkUrl: {
			attribute: 'href',
			selector: '.weekly__link'
		},
		hasVideo: {
			type: 'boolean',
			default: false
		},
		body: {
			type: 'array',
			source: 'children',
			selector: '.weekly__desc'
		},
		title: {
			source: 'text',
			selector: '.weekly__title'
		},
		imageUrl: {
			attribute: 'src',
			selector: '.weekly__img'
		},
		imageAlt: {
			attribute: 'alt',
			selector: '.weekly__img'
		}

	},

	edit: FeatureBlockEdit,

	save: ( props ) => {
		const { attributes } = props;
		const linkImage = (src, alt) => {
			if(!src) return null;

			if(alt) {
				return (
					<div className={(attributes.hasVideo ? 'weekly__image _video' : 'weekly__image')} style={"background-image: url('"+ src +"');"}>
						<a className="weekly__link" href={ attributes.linkUrl }>
                			<img className="relatedlink__img" src={ src } alt={ alt } />
                		</a>
              		</div>
				);
			}
			return (
				<div className={(attributes.hasVideo ? 'weekly__image _video' : 'weekly__image')} style={"background-image: url('"+ src +"');"}>
					<a className="weekly__link" href={ attributes.linkUrl }>
                		<img className="relatedlink__img" src={ src } aria-hidden="true" />
                	</a>
              	</div>
			);
		};
		return (
			<div className="weekly__feature">
				{ linkImage(attributes.imageUrl, attributes.imageAlt) }
				<h2 className="weekly__headline">
					<a className="weekly__link" href={ attributes.linkUrl }>
						{ attributes.title }
					</a>
				</h2>
				<div className="weekly__desc introtext">
					{ attributes.body }
				</div>
           	</div>
		);
	},
} );
