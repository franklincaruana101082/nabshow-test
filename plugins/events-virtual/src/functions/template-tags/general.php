<?php
/**
 * Tribe Events Virtual Template Tags.
 *
 * Display functions (template-tags) for use in WordPress templates.
 */

/**
 * Get Virtual Event Label Singular
 *
 * Returns the singular version of the Event Label
 *
 * @since 1.0.0
 *
 * @return string
 */
function tribe_get_virtual_event_label_singular() {
	$label = sprintf(
		/* Translators: singular event term. */
		__(
			'Virtual %1$s',
			'events-virtual'
		),
		tribe_get_event_label_singular()
	);

	/**
	 * Allows customization of the singular version of the Virtual Event Label
	 *
	 * @param string $label The singular version of the Virtual Event label,
	 *                      defaults to "Virtual Event" (or "Virtual" + the filtered term for "event").
	 *
	 * @see tribe_get_event_label_plural
	 */
	return apply_filters( 'tribe_virtual_event_label_singular', $label );
}

/**
 * Get Virtual Event Label Singular lowercase
 *
 * Returns the lowercase singular version of the Event Label
 *
 * @since 1.0.0
 *
 * @return string
 */
function tribe_get_virtual_event_label_singular_lowercase() {
	$label = sprintf(
		/* Translators: singular event term. */
		__(
			'virtual %1$s',
			'events-virtual'
		),
		tribe_get_event_label_singular_lowercase()
	);

	/**
	 * Allows customization of the singular lowercase version of the Virtual Event Label
	 *
	 * @param string $label The singular lowercase version of the Virtual Event label,
	 *                      defaults to "virtual events" (or "virtual" + the filtered term for "event").
	 *
	 * @see tribe_get_event_label_singular_lowercase
	 */
	return apply_filters( 'tribe_virtual_event_label_singular_lowercase', $label );
}

/**
 * Get Virtual Event Label Plural
 *
 * Returns the plural version of the Event Label
 *
 * @since 1.0.0
 *
 * @return string
 */
function tribe_get_virtual_event_label_plural() {
	$label = sprintf(
		/* Translators: plural event term. */
		__(
			'Virtual %1$s',
			'events-virtual'
		),
		tribe_get_event_label_plural()
	);

	/**
	 * Allows customization of the plural version of the Virtual Event Label
	 *
	 * @param string $label The plural version of the Virtual Event label,
	 *                      defaults to "Virtual Events" (or "virtual" + the filtered term for "events").
	 *
	 * @see tribe_get_event_label_plural
	 */
	return apply_filters( 'tribe_virtual_event_label_plural', $label );
}

/**
 * Get Virtual Event Label Plural lowercase
 *
 * Returns the lowercase plural version of the Event Label
 *
 * @since 1.0.0
 *
 * @return string
 */
function tribe_get_virtual_event_label_plural_lowercase() {
	$label = sprintf(
		/* Translators: plural event term. */
		__(
			'virtual %1$s',
			'events-virtual'
		),
		tribe_get_event_label_plural_lowercase()
	);

	/**
	 * Allows customization of the plural lowercase version of the Virtual Event Label
	 *
	 * @param string $label The plural lowercase version of the Virtual Event label,
	 *                      defaults to "virtual events" (lowercase) or the filtered term for events.
	 *
	 * @see tribe_get_event_label_plural_lowercase
	 */
	return apply_filters( 'tribe_virtual_event_label_plural_lowercase', $label );
}
