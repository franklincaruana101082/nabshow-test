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

/**
 * Register: aa Gutenberg Block.
 *
 * Registers a new block provided a unique name and an object defining its
 * behavior. Once registered, the block is made editor as an option to any
 * editor interface where blocks are implemented.
 *
 * @link https://wordpress.org/gutenberg/handbook/block-api/
 * @param  {string}   name     Block name.
 * @param  {Object}   settings Block settings.
 * @return {?WPBlock}          The block, if it has been successfully
 *                             registered; otherwise `undefined`.
 */
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
		body: {
			type: 'array',
			source: 'children',
		},
		name: {
			source: 'text',
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
					<PlainText
	            		onChange={ content => setAttributes({ name: content }) }
	            		value={ attributes.name }
	            		placeholder="Enter name"
	            	/>
	            	<div className="author__info">
		            	<RichText
							onChange={ content => setAttributes({ body: content })}
							value={ attributes.body }
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
                <img src={ src } alt={('Photo of ' + attributes.name)} />
			);
		};
		return (
			<div className="author">
				<div className="author__photo">
					{ linkImage(attributes.imageUrl, attributes.imageAlt) }
				</div>
				<div className="author__name">
					{ attributes.name }
					<div className="author__info">{ attributes.body }</div>
				</div>
					
			</div>
		);
	},
} );
