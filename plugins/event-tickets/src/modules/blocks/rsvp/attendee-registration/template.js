/**
 * External dependencies
 */
import React from 'react';
import PropTypes from 'prop-types';

/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';

/**
 * Internal dependencies
 */
import { AttendeesRegistration as ARElement } from '@moderntribe/tickets/elements';
import './style.pcss';

const linkTextAdd = __( '+ Add', 'event-tickets' );
const linkTextEdit = __( 'Edit', 'event-tickets' );

const RSVPAttendeeRegistration = ( {
	attendeeRegistrationURL,
	hasAttendeeInfoFields,
	isCreated,
	isDisabled,
	isModalOpen,
	onClick,
	onClose,
	onIframeLoad,
} ) => {
	const linkText = hasAttendeeInfoFields ? linkTextEdit : linkTextAdd;

	return (
		<ARElement
			helperText={ __( 'Save your Registration to enable attendee information fields', 'event-tickets' ) }
			iframeURL={ attendeeRegistrationURL }
			isDisabled={ isDisabled }
			isModalOpen={ isModalOpen }
			label={ __( 'Attendee Information', 'event-tickets' ) }
			linkText={ linkText }
			modalTitle={ __( 'Attendee Information', 'event-tickets' ) }
			onClick={ onClick }
			onClose={ onClose }
			onIframeLoad={ onIframeLoad }
			showHelperText={ ! isCreated }
		/>
	);
};

RSVPAttendeeRegistration.propTypes = {
	attendeeRegistrationURL: PropTypes.string.isRequired,
	hasAttendeeInfoFields: PropTypes.bool.isRequired,
	isCreated: PropTypes.bool.isRequired,
	isDisabled: PropTypes.bool.isRequired,
	isModalOpen: PropTypes.bool.isRequired,
	onClick: PropTypes.func.isRequired,
	onClose: PropTypes.func.isRequired,
	onIframeLoad: PropTypes.func.isRequired,
};

export default RSVPAttendeeRegistration;
