/**
 * BLOCK: events-feature
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

registerBlockType( 'cgb/block-events-feature', {
	// Block name. Block names must be string that contains a namespace prefix. Example: my-plugin/my-custom-block.
	title: __( 'Events Feature Block' ), // Block title.
	icon: 'calendar-alt', // Block icon from Dashicons → https://developer.wordpress.org/resource/dashicons/.
	category: 'common', // Block category — Group blocks together based on common traits E.g. common, formatting, layout widgets, embed.
	keywords: [
		__( 'Events' ),
		__( 'Feature' ),
	],

	attributes: {
		
		featureBody: {
			type: 'string',
			source: 'html',
			selector: '.homeevents__introtext'
		},
		featureTitle: {
			source: 'text',
			selector: '.homeevents__title'
		}

	},

	edit: ( props ) => {
		const { attributes, setAttributes } = props;
		return (
			<div className="nabcard">
				<div className="nabcard__content">
					<section className="homeevents">
						<div className="homeevents__intro">
							<h2 className="homeevents__title">
								<PlainText
									onChange={ (content) => setAttributes({ featureTitle: content }) }
									value={ attributes.featureTitle }
									placeholder="Enter title"
									className="heading"
								/>
							</h2>
							<div className="homeevents__introtext introtext">
								<RichText
									onChange={ (content) => setAttributes({ featureBody: content })}
									value={ attributes.featureBody }
									multiline="p"
									placeholder="Enter description here"
								/>
							</div>
						</div>
						<div class="homeevents__events">
							<InnerBlocks />
						</div>
					</section>
				</div>
			</div>
		);
	},

	save: ( props ) => {
		const { attributes } = props;
		return (
			<div className="nabcard">
				<div className="nabcard__content">
					<section className="homeevents">
						<div className="homeevents__intro">
							<h2 className="homeevents__title">{ attributes.featureTitle }</h2>
							<div className="homeevents__introtext introtext">
								<RichText.Content
									value={ attributes.featureBody }
								/>
							</div>
						</div>
						<div class="homeevents__events">
							<InnerBlocks.Content />
						</div>
					</section>
				</div>
			</div>	
		);
	},
} );
