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
		
		body: {
			type: 'array',
			source: 'children',
		},
		title: {
			source: 'text',
		}

	},

	edit: ( props ) => {
		const { attributes, setAttributes } = props;
		return (
			<div class="feature">
				<div class="feature__main">
					<h2 class="feature__title">
						<PlainText
							onChange={ content => setAttributes({ title: content }) }
							value={ attributes.title }
							placeholder="Enter title"
							className="heading"
						/>
					</h2>
					<div className="feature__copy">
						<RichText
							onChange={ content => setAttributes({ body: content })}
							value={ attributes.body }
							multiline="p"
							placeholder="Enter description here"
						/>
					</div>
				</div>
				<div class="feature__event">
					<InnerBlocks />
				</div>
			</div>
		);
	},


	save: ( props ) => {
		const { attributes } = props;
		return (
			<div class="feature">
				<div class="feature__main">
					<h2 class="feature__title">{ attributes.title }</h2>
					<div className="feature__copy">
						{ attributes.body }
					</div>
				</div>
				<div class="feature__event">
					<InnerBlocks.Content />
				</div>
			</div>
		);
	},
} );
