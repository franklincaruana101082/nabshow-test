/**
 * BLOCK: event-link
 *
 * Registering a basic block with Gutenberg.
 * Simple block, renders and saves the same content without any interactivity.
 */

//  Import CSS.
import './editor.scss';
import './style.scss';

const { __ } = wp.i18n; // Import __() from wp.i18n
const { registerBlockType } = wp.blocks; // Import registerBlockType() from wp.blocks
const { MediaUpload, PlainText, InspectorControls, BlockControls, URLInputButton } = wp.blockEditor;
const { Button, PanelBody, PanelRow, ToggleControl, SelectControl } = wp.components;


registerBlockType( 'cgb/block-event-link', {
	// Block name. Block names must be string that contains a namespace prefix. Example: my-plugin/my-custom-block.
	title: __( 'Event Link Block' ), // Block title.
	icon: 'calendar', // Block icon from Dashicons → https://developer.wordpress.org/resource/dashicons/.
	category: 'common', // Block category — Group blocks together based on common traits E.g. common, formatting, layout widgets, embed.
	keywords: [
		__( 'Event' ),
		__( 'Link' ),
	],
	attributes: {
		month: {
			source: 'text',
			selector: '.event__month'
		},
		day: {
			source: 'text',
			selector: '.event__day'	
		},
		title: {
			source: 'text',
			selector: '.event__title'	
		},
		time: {
			source: 'text',
			selector: '.event__time'	
		},
		host: {
			source: 'text',
			selector: '.event__host-name'	
		},
		linkUrl: {
			attribute: 'href'
		},
		linkType: {
			type: 'string',
			default: ''
		},
		imageEventUrl: {
			attribute: 'src',
			selector: '.event__image'
		},
		imageEventAlt: {
			attribute: 'alt',
			selector: '.event__image'
		},
		imageHostUrl: {
			attribute: 'src',
			selector: '.event__host-photo'
		},
		imageHostAlt: {
			attribute: 'alt',
			selector: '.event__host-photo'
		}
	},

	
	edit: ( props ) => {
		const { attributes, setAttributes } = props;
		const getImageEventButton = (openEvent) => {
			if(attributes.imageEventUrl) {
				return (
					<img
						src={ attributes.imageEventUrl }
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
							title="Optional"
						>
							Event image
						</Button>
					</div>
				);
			}
		};
		const getImageHostButton = (openEvent) => {
			if(attributes.imageHostUrl) {
				return (
					<img
						src={ attributes.imageHostUrl }
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
							Host image
						</Button>
					</div>
				);
			}
		};
		let eventClass = 'event ' + attributes.linkType;
		return (
			<div>
				<InspectorControls>
					<PanelBody
						title="Link Options"
						initialOpen={true}
					>
						<PanelRow>
							<SelectControl
								label="Link Layout"
								value={ attributes.linkType }
								options={[
									{ label: "Normal", value: '' },
									{ label: "Wide", value: '_wide' },
									{ label: "Full", value: '_big' }
								]}
								onChange={(newval) => setAttributes({ linkType: newval })}
							/>
						</PanelRow>
					</PanelBody>
				</InspectorControls>

				<BlockControls>
					<URLInputButton
						url={ attributes.linkUrl }
						onChange={ (url, post ) => setAttributes( { linkUrl: url } ) }
					/>
				</BlockControls>

				<div className={eventClass}>
					<div className="event__date">
						<div className="event__month">
							<PlainText
								onChange={ content => setAttributes({ month: content })}
								value={ attributes.month }
								placeholder="Month"
							/>
						</div>
						<div className="event__day text-gradient _blue">
							<PlainText
								onChange={ content => setAttributes({ day: content })}
								value={ attributes.day }
								placeholder="01"
							/>
						</div>
					</div>
					<div className="event__photo">
						<div className="event__link link _plus">Learn More</div>
						<MediaUpload
							onSelect={ media => {setAttributes({imageEventAlt: media.alt, imageEventUrl: media.url }); } }
							type="image"
							value={ attributes.imageEventID }
							render={ ({ open }) => getImageEventButton(open) }
							className="event__image"
						/>
					</div>
					<div className="event__info">
						<h4 className="event__title">
							<PlainText
								onChange={ content => setAttributes({ title: content })}
								value={ attributes.title }
								placeholder="Event Title"
							/>
						</h4>
						<div className="event__time">
							<PlainText
								onChange={ content => setAttributes({ time: content })}
								value={ attributes.time }
								placeholder="Time e.g.: 1 - 2 p.m. PT"
							/>
						</div>
						<div className="event__host">
							<MediaUpload
								onSelect={ media => {setAttributes({imageHostAlt: media.alt, imageHostUrl: media.url }); } }
								type="image"
								value={ attributes.imageHostID }
								render={ ({ open }) => getImageHostButton(open) }
								className="event__host-photo"
							/>
							<div className="event__host-name">
								<PlainText
									onChange={ content => setAttributes({ host: content })}
									value={ attributes.host }
									placeholder="Hosted by ..."
								/>
							</div>
						</div>
						<div className="event__link link _plus">Learn More</div>
					</div>
				</div>
			</div>
		);
	},

	save: ( props ) => {
		const { attributes } = props;
		const linkEventImage = (src, alt) => {
			if(!src) return null;

			if(alt) {
				return (
                	<img className="event__image" src={ src } alt={ alt } />
				);
			}
			return (
                <img className="event__image" src={ src } aria-hidden="true" />
			);
		};
		const linkHostImage = (src, alt) => {
			if(!src) return null;

			if(alt) {
				return (
                	<img className="event__host-photo" src={ src } alt={ alt } />
				);
			}
			return (
                <img className="event__host-photo" src={ src } aria-hidden="true" />
			);
		};
		let eventClass = 'event ' + attributes.linkType;
		return (
			<a href={ attributes.linkUrl } className={ eventClass }>
				<div className="event__date">
					<div className="event__month">{ attributes.month }</div>
					<div className="event__day text-gradient _blue">{ attributes.day }</div>
				</div>
				<div className="event__photo">
					<div className="event__link link _plus">Learn More</div>
					{ linkEventImage(attributes.imageEventUrl, attributes.imageEventAlt) }
				</div>
				<div className="event__info">
					<h4 className="event__title">{ attributes.title }</h4>
					<div className="event__time">{ attributes.time }</div>
					<div className="event__host">
						{ linkHostImage(attributes.imageHostUrl, attributes.imageHostAlt) }
						<div className="event__host-name">{ attributes.host }</div>
					</div>
					<div className="event__link link _plus">Learn More</div>
				</div>
			</a>
		);
	},
} );
