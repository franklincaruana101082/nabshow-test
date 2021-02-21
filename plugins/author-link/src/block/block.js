/**
 * BLOCK: author-link
 *
 * Registering a basic block with Gutenberg.
 * Simple block, renders and saves the same content without any interactivity.
 */

//  Import CSS.
import './editor.scss';
import './style.scss';

const { __ } = wp.i18n; // Import __() from wp.i18n
const { registerBlockType } = wp.blocks; // Import registerBlockType() from wp.blocks
const { MediaUpload, PlainText, RichText, InspectorControls, BlockControls } = wp.blockEditor;
const { Button, PanelBody, PanelRow, ToggleControl, Toolbar, IconButton } = wp.components;


registerBlockType( 'cgb/block-author-link', {
	// Block name. Block names must be string that contains a namespace prefix. Example: my-plugin/my-custom-block.
	title: __( 'Author Link Block' ), // Block title.
	icon: 'admin-users', // Block icon from Dashicons → https://developer.wordpress.org/resource/dashicons/.
	category: 'common', // Block category — Group blocks together based on common traits E.g. common, formatting, layout widgets, embed.
	keywords: [
		__( 'Author' ),
		__( 'Presenter' ),
	],

	attributes: {
		authorBody: {
			type: 'string',
			source: 'html',
			selector: '.author__info'
		},
		authorName: {
			source: 'text',
			selector: '.author__name2'
		},
		imageUrl: {
			attribute: 'src',
		},
		imageAlt: {
			attribute: 'alt',
		}
	},

	
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
			<div className="author">
				<div className="author__photo">
					<MediaUpload
						onSelect={ media => {setAttributes({imageAlt: media.alt, imageUrl: media.url }); } }
						type="image"
						value={ attributes.imageID }
						render={ ({ open }) => getImageButton(open) }
						className="relatedlink__img"
					/>
				</div>
				<div className="author__name">
					<div className="author__name2">
						<PlainText
		            		onChange={ (namecontent) => setAttributes({ authorName: namecontent }) }
		            		value={ attributes.authorName }
		            		placeholder="Enter name"
		            	/>
	            	</div>
	            	<div className="author__info">
		            	<RichText
							onChange={ (infocontent) => setAttributes({ authorBody: infocontent })}
							value={ attributes.authorBody }
							multiline="p"
							placeholder="Add link to @bio or company they represent"
						/>
					</div>
	            </div>
			</div>
		);
	},

	save: ( props ) => {
		const { attributes } = props;
		const linkImage = (src, alt) => {
			if(!src) {
				return (
					<img src="https://www.gravatar.com/avatar/8aeaac1d99ace56a09f452202fb058c3?s=150&r=g&d=mystery" alt="No photo available"/>
				);
			}
			if(alt) {
				return (
                	<img src={ src } alt={ alt } />
				);
			}
			return (
                <img src={ src } aria-hidden="true" />
			);
		};
		return (
			<div className="author">
				<div className="author__photo">
					{ linkImage(attributes.imageUrl, attributes.imageAlt) }
				</div>
				<div className="author__name">
					<div className="author__name2">
						{ attributes.authorName }
					</div>
					<div className="author__info">
						<RichText.Content
							value={ attributes.authorBody }
						/>
					</div>
				</div>
					
			</div>
		);
	},
} );
