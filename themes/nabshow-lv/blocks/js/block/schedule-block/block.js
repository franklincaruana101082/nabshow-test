import times from 'lodash/times';
import memoize from 'memize';

var allowedBlocks = [
    'nab/nab-heading',
];

(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
    const { __ } = wp.i18n;
    const { registerBlockType } = wp.blocks;
    const { Fragment, Component } = wp.element;
    const { RichText, AlignmentToolbar, BlockControls, InspectorControls, PanelColorSettings, InnerBlocks } = wp.editor;
    const { TextControl, PanelBody, PanelRow, RangeControl, SelectControl, IconButton, ToggleControl, Button } = wp.components;

    const ALLOWBLOCKS = ['nab/schedule-item'];

    const getChildscheduleBlock = memoize(schedule => {
        return times(schedule, n => ['nab/schedule-item', { id: n + 1 }]);
    });

    const removehildawardsBlock = memoize((schedule) => {
        return times(schedule, (n) => ['nab/schedule-item', { id: n - 1 }]);
    });

    /* Parent schedule Block */
    registerBlockType('nab/schedule', {
        title: __('Schedule'),
        description: __('Schedule'),
        icon: 'welcome-learn-more',
        category: 'nabshow',
        keywords: [__('schedule'), __('gutenberg'), __('nab')],
        attributes: {
            blockId: {
                type: 'string'
            },
            noOfschedule: {
                type: 'number',
                default: 1
            },
            title: {
                type: 'string',
                default: 'Title'
            },
            showTitle: {
                type: 'boolean',
                default: true
            }
        },
        edit: (props, attributes) => {
            const { attributes: { noOfschedule, title, showTitle }, className, setAttributes, clientId } = props;

            $(document).on('click', `#block-${clientId} .schedule-row .remove-button`, function (e) {
                if ('' !== $(this).parents(`#block-${clientId}`)) {
                    setAttributes({ noOfschedule: noOfschedule - 1 });
                    removehildawardsBlock(noOfschedule);
                }
              });

            return (
                <div className={`schedule-main ${className ? className : ''}`}>
                    <InspectorControls>
                        <PanelBody title="General Settings">
                            <PanelRow>
                                <ToggleControl
                                    label={__('Show Title')}
                                    checked={showTitle}
                                    onChange={() => setAttributes({ showTitle: ! showTitle })}
                                />
                            </PanelRow>
                        </PanelBody>
                    </InspectorControls>
                    {
                        showTitle ? (
                            <RichText
                                tagName="h2"
                                onChange={(value) => setAttributes({ title: value })}
                                placeholder={__('Title')}
                                value={title}
                            />) : ''
                    }
                    <div className="schedule-data">
                        <InnerBlocks
                            template={getChildscheduleBlock(noOfschedule)}
                            templateLock="all"
                            allowedBlocks={ALLOWBLOCKS}
                        />
                        <div className="add-remove-btn">
                            <Button className="add" onClick={() => setAttributes({ noOfschedule: noOfschedule + 1 })}>
                                <span className="dashicons dashicons-plus" />
                            </Button>
                        </div>
                    </div>
                </div>
            );
        },
        save: (props) => {
            const { attributes: { title, showTitle }, className } = props;
            return (
                <div className={`schedule-main  ${className ? className : ''}`}>
                    {
                        showTitle ? (
                            <RichText.Content
                                tagName="h2"
                                value={title}
                            />) : ''
                    }
                    <div className="schedule-data">
                        <InnerBlocks.Content />
                    </div>
                </div>
            );
        }
    });

    /* schedule Block */
    registerBlockType('nab/schedule-item', {
        title: __('Schedule Items'),
        description: __('Schedule Items'),
        icon: 'welcome-learn-more',
        category: 'nabshow',
        parent: ['nab/schedule'],
        attributes: {
            date: {
                type: 'string'
            },
            name: {
                type: 'string'
            },
            location: {
                type: 'string'
            },
            details: {
                type: 'string'
            }
        },
        edit: (props) => {
            const { attributes, setAttributes, className, clientId } = props;
            const { date, name, location, details } = attributes;
            return (
                <div className='schedule-row'>
                    <div className="date">
                        <RichText
                            tagName="p"
                            onChange={(value) => setAttributes({ date: value })}
                            value={date}
                            placeholder={__('8 a.m. - 6 p.m.')}
                        />
                    </div>
                    <div className="name">
                        <RichText
                            tagName="strong"
                            onChange={(value) => setAttributes({ name: value })}
                            value={name}
                            placeholder={__('Registration Open')}
                        />
                    </div>
                    <div className="location">
                        <RichText
                            tagName="p"
                            onChange={(value) => setAttributes({ location: value })}
                            value={location}
                            placeholder={__('Location')}
                        />
                    </div>
                    <div className="details">
                        <RichText
                            tagName="p"
                            onChange={(value) => setAttributes({ details: value })}
                            value={details}
                            placeholder={__('All-Badge Access')}
                        />
                    </div>
                    <span class="remove-button">
                        <IconButton
                            className="components-toolbar__control"
                            label={__('Remove image')}
                            icon="no"
                            onClick={() => {
                                wp.data.dispatch('core/editor').removeBlocks(clientId);
                            }}
                        />
                    </span>
                </div>
            );
        },
        save: (props) => {
            const { attributes, className } = props;
            const { date, name, location, details } = attributes;
            return (
                <div className='schedule-row'>
                    <div className="date">
                        <RichText.Content
                            tagName="p"
                            value={date === undefined ? '-' : date}
                        />
                    </div>
                    <div className="name">
                        <RichText.Content
                            tagName="strong"
                            value={name === undefined ? '-' : name}
                        />
                    </div>
                    <div className="location">
                        <RichText.Content
                            tagName="p"
                            value={location === undefined ? '-' : location}
                        />
                    </div>
                    <div className="details">
                        <RichText.Content
                            tagName="p"
                            value={details === undefined ? '-' : details}
                        />
                    </div>
                </div>
            );
        }
    });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);

