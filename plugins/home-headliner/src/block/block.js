/**
 * BLOCK: home-headliner
 *
 * Registering a basic block with Gutenberg.
 * Simple block, renders and saves the same content without any interactivity.
 */

//  Import CSS.
import './editor.scss';
import './style.scss';

const { __ } = wp.i18n; // Import __() from wp.i18n
const { registerBlockType } = wp.blocks; // Import registerBlockType() from wp.blocks
const { PlainText, RichText, InnerBlocks } = wp.blockEditor;



registerBlockType( 'cgb/block-home-headliner', {
	// Block name. Block names must be string that contains a namespace prefix. Example: my-plugin/my-custom-block.
	title: __( 'Home Headliner Block' ), // Block title.
	icon: 'star-filled', // Block icon from Dashicons → https://developer.wordpress.org/resource/dashicons/.
	category: 'common', // Block category — Group blocks together based on common traits E.g. common, formatting, layout widgets, embed.
	keywords: [
		__( 'Home' ),
		__( 'Headliner' )
	],

	attributes: {
		
		headlinerBody: {
			type: 'string',
			source: 'html',
			selector: '.feature__copy'
		},
		headlinerTitle: {
			source: 'text',
			selector: '.feature__title'
		}

	},

	edit: ( props ) => {
		const { attributes, setAttributes } = props;
		return (
			<div className="feature">
				<div className="feature__main">
					<h2 className="feature__title">
						<PlainText
							onChange={ content => setAttributes({ headlinerTitle: content }) }
							value={ attributes.headlinerTitle }
							placeholder="Enter title"
							className="heading"
						/>
					</h2>
					<div className="feature__copy">
						<RichText
							onChange={ content => setAttributes({ headlinerBody: content })}
							value={ attributes.headlinerBody }
							multiline="p"
							placeholder="Enter description here"
						/>
					</div>
				</div>
				<div className="feature__event">
					<InnerBlocks />
				</div>
			</div>
		);
	},


	save: ( props ) => {
		const { attributes } = props;
		return (
			<div className="feature">
				<div className="feature__main">
					<h2 className="feature__title">{ attributes.headlinerTitle }</h2>
					<div className="feature__copy">
						<RichText.Content
							value={ attributes.headlinerBody }
						/>
					</div>
				</div>
				<div className="feature__event">
					<InnerBlocks.Content />
				</div>
			</div>
		);
	},
} );
