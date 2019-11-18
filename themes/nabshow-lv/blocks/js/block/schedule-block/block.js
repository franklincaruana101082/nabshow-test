import times from 'lodash/times';
import memoize from 'memize';

(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
    const { __ } = wpI18n;
    const { registerBlockType } = wpBlocks;
    const { Fragment, Component } = wpElement;
    const { RichText, InspectorControls, InnerBlocks } = wpEditor;
    const { PanelBody, PanelRow, IconButton, ToggleControl, Button } = wpComponents;

    const scheduleBlockIcon = (
        <svg width="150px" height="150px" viewBox="181 181 150 150" enable-background="new 181 181 150 150">
            <path fill="#0F6CB6" d="M186.837,288.539c1.152,0,2.087-0.932,2.087-2.086v-60.797h123.331v22.945c0,1.153,0.936,2.087,2.088,2.087
                c1.154,0,2.087-0.934,2.087-2.087v-41.253c0-6.998-5.693-12.692-12.689-12.692h-5.474v-2.585c0-2.796-2.275-5.07-5.072-5.07h-3.878
                c-2.795,0-5.069,2.274-5.069,5.07v2.586h-13.844v-2.586c0-2.796-2.274-5.07-5.07-5.07h-3.878c-2.796,0-5.07,2.274-5.07,5.07v2.586
                h-13.846v-2.586c0-2.796-2.274-5.07-5.07-5.07h-3.877c-2.796,0-5.07,2.274-5.07,5.07v2.586h-13.844v-2.586
                c0-2.796-2.274-5.07-5.07-5.07h-3.877c-2.796,0-5.07,2.274-5.07,5.07v2.586h-3.218c-6.999,0-12.692,5.693-12.692,12.691v79.105
                C184.75,287.607,185.685,288.539,186.837,288.539z M288.423,192.07c0-0.493,0.402-0.896,0.896-0.896h3.878
                c0.493,0,0.896,0.402,0.896,0.896v10.142c0,0.494-0.401,0.896-0.896,0.896h-3.878c-0.494,0-0.896-0.401-0.896-0.896V192.07z
                M260.561,192.07c0-0.493,0.401-0.896,0.896-0.896h3.878c0.493,0,0.896,0.402,0.896,0.896v10.142c0,0.494-0.402,0.896-0.896,0.896
                h-3.878c-0.494,0-0.896-0.401-0.896-0.896V192.07z M232.697,192.07c0-0.493,0.402-0.896,0.896-0.896h3.877
                c0.494,0,0.896,0.402,0.896,0.896v10.142c0,0.494-0.403,0.896-0.896,0.896h-3.877c-0.494,0-0.896-0.401-0.896-0.896V192.07z
                M204.835,192.07c0-0.493,0.402-0.896,0.896-0.896h3.878c0.493,0,0.895,0.402,0.895,0.896v10.142c0,0.494-0.401,0.896-0.895,0.896
                h-3.878c-0.494,0-0.896-0.401-0.896-0.896V192.07z M197.442,198.831h3.218v3.381c0,2.796,2.274,5.071,5.07,5.071h3.878
                c2.795,0,5.07-2.275,5.07-5.071v-3.381h13.845v3.381c0,2.796,2.274,5.071,5.07,5.071h3.878c2.796,0,5.071-2.275,5.071-5.071v-3.381
                h13.844v3.381c0,2.796,2.273,5.071,5.07,5.071h3.879c2.794,0,5.069-2.275,5.069-5.071v-3.381h13.845v3.381
                c0,2.796,2.273,5.071,5.07,5.071h3.877c2.796,0,5.071-2.275,5.071-5.071v-3.381h5.474c4.695,0,8.516,3.82,8.516,8.517v14.134
                H188.925v-14.134C188.925,202.651,192.745,198.831,197.442,198.831z"/>
            <path fill="#0F6CB6" d="M208.382,307.953h-18.202c-0.692,0-1.256-0.564-1.256-1.256v-10.732c0-1.152-0.935-2.088-2.087-2.088
                s-2.087,0.936-2.087,2.088v10.732c0,2.994,2.437,5.43,5.431,5.43h18.202c1.152,0,2.087-0.934,2.087-2.086
                C210.47,308.887,209.535,307.953,208.382,307.953z"/>
            <path fill="#0F6CB6" d="M208.313,231.743h-7.256c-1.152,0-2.087,0.936-2.087,2.087c0,1.154,0.935,2.087,2.087,2.087h7.256
                c1.152,0,2.087-0.933,2.087-2.087C210.4,232.678,209.465,231.743,208.313,231.743z"/>
            <path fill="#0F6CB6" d="M223.355,235.917h7.256c1.153,0,2.087-0.933,2.087-2.087c0-1.152-0.935-2.087-2.087-2.087h-7.256
                c-1.153,0-2.087,0.936-2.087,2.087C221.268,234.984,222.203,235.917,223.355,235.917z"/>
            <path fill="#0F6CB6" d="M245.653,235.917h7.255c1.152,0,2.087-0.933,2.087-2.087c0-1.152-0.935-2.087-2.087-2.087h-7.255
                c-1.153,0-2.087,0.936-2.087,2.087C243.565,234.984,244.5,235.917,245.653,235.917z"/>
            <path fill="#0F6CB6" d="M267.95,235.917h7.256c1.153,0,2.088-0.933,2.088-2.087c0-1.152-0.935-2.087-2.088-2.087h-7.256
                c-1.152,0-2.088,0.936-2.088,2.087C265.862,234.984,266.798,235.917,267.95,235.917z"/>
            <path fill="#0F6CB6" d="M297.504,231.743h-7.255c-1.154,0-2.088,0.936-2.088,2.087c0,1.154,0.934,2.087,2.088,2.087h7.255
                c1.152,0,2.088-0.933,2.088-2.087C299.592,232.678,298.656,231.743,297.504,231.743z"/>
            <path fill="#0F6CB6" d="M208.313,242.24h-7.256c-1.152,0-2.087,0.934-2.087,2.087c0,1.154,0.935,2.087,2.087,2.087h7.256
                c1.152,0,2.087-0.934,2.087-2.087C210.4,243.174,209.465,242.24,208.313,242.24z"/>
            <path fill="#0F6CB6" d="M223.355,246.415h7.256c1.153,0,2.087-0.934,2.087-2.087c0-1.153-0.935-2.087-2.087-2.087h-7.256
                c-1.153,0-2.087,0.934-2.087,2.087C221.268,245.481,222.203,246.415,223.355,246.415z"/>
            <path fill="#0F6CB6" d="M245.653,246.415h7.255c1.152,0,2.087-0.934,2.087-2.087c0-1.153-0.935-2.087-2.087-2.087h-7.255
                c-1.153,0-2.087,0.934-2.087,2.087C243.565,245.481,244.5,246.415,245.653,246.415z"/>
            <path fill="#0F6CB6" d="M267.95,246.415h7.256c1.153,0,2.088-0.934,2.088-2.087c0-1.153-0.935-2.087-2.088-2.087h-7.256
                c-1.152,0-2.088,0.934-2.088,2.087C265.862,245.481,266.798,246.415,267.95,246.415z"/>
            <path fill="#0F6CB6" d="M297.504,242.24h-7.255c-1.154,0-2.088,0.934-2.088,2.087c0,1.154,0.934,2.087,2.088,2.087h7.255
                c1.152,0,2.088-0.934,2.088-2.087C299.592,243.174,298.656,242.24,297.504,242.24z"/>
            <path fill="#0F6CB6" d="M223.406,287.395l10.733,10.732c1.552,1.553,3.616,2.408,5.812,2.408s4.261-0.855,5.813-2.408l29.392-29.393
                c3.205-3.205,3.205-8.42,0-11.625c-3.205-3.205-8.42-3.205-11.625,0l-23.58,23.58l-4.92-4.92c-3.204-3.205-8.419-3.205-11.625,0
                C220.201,278.975,220.201,284.189,223.406,287.395z M226.358,278.721c0.788-0.787,1.824-1.184,2.86-1.184s2.072,0.396,2.86,1.184
                l6.396,6.395c0.815,0.816,2.137,0.816,2.952,0l25.056-25.053c1.578-1.578,4.144-1.578,5.721-0.002c1.577,1.578,1.577,4.145,0,5.723
                l-29.391,29.391c-0.764,0.766-1.78,1.186-2.86,1.186c-1.081,0-2.096-0.42-2.86-1.186l-10.732-10.732
                C224.78,282.863,224.78,280.299,226.358,278.721z"/>
            <path fill="#0F6CB6" d="M316.431,274.771v-16.657c0-1.153-0.933-2.087-2.087-2.087c-1.152,0-2.088,0.934-2.088,2.087v13.993
                c-3.806-1.973-8.125-3.09-12.7-3.09c-15.271,0-27.693,12.424-27.693,27.693c0,4.002,0.854,7.805,2.386,11.242h-56.354
                c-1.153,0-2.087,0.934-2.087,2.088c0,1.15,0.935,2.086,2.087,2.086h58.667c4.976,7.402,13.427,12.279,22.995,12.279
                c15.271,0,27.694-12.424,27.694-27.695C327.25,287.789,323.006,279.838,316.431,274.771z M299.556,320.232
                c-12.969,0-23.519-10.551-23.519-23.52s10.551-23.52,23.519-23.52c12.969,0,23.52,10.551,23.52,23.52
                S312.524,320.232,299.556,320.232z"/>
            <path fill="#0F6CB6" d="M299.556,276.209c-11.306,0-20.503,9.199-20.503,20.504s9.197,20.502,20.503,20.502
                c11.307,0,20.502-9.197,20.502-20.502S310.861,276.209,299.556,276.209z M301.425,312.93c0.138-0.279,0.219-0.592,0.219-0.924
                v-2.543c0-1.154-0.936-2.088-2.088-2.088c-1.151,0-2.087,0.934-2.087,2.088v2.543c0,0.332,0.079,0.645,0.219,0.924
                c-7.513-0.859-13.489-6.836-14.35-14.348c0.278,0.139,0.594,0.219,0.926,0.219h2.542c1.153,0,2.087-0.936,2.087-2.088
                c0-1.154-0.934-2.088-2.087-2.088h-2.542c-0.332,0-0.647,0.082-0.926,0.219c0.86-7.512,6.837-13.49,14.35-14.348
                c-0.14,0.279-0.219,0.592-0.219,0.924v2.543c0,1.152,0.936,2.088,2.087,2.088c1.152,0,2.088-0.936,2.088-2.088v-2.543
                c0-0.332-0.081-0.645-0.219-0.924c7.513,0.857,13.488,6.836,14.349,14.348c-0.279-0.137-0.593-0.219-0.925-0.219h-2.543
                c-1.153,0-2.087,0.934-2.087,2.088c0,1.152,0.934,2.088,2.087,2.088h2.543c0.332,0,0.646-0.08,0.925-0.219
                C314.912,306.094,308.938,312.07,301.425,312.93z"/>
            <path fill="#0F6CB6" d="M304.157,294.625h-2.514v-2.141c0-1.152-0.935-2.086-2.088-2.086c-1.152,0-2.087,0.934-2.087,2.086v4.229
                c0,1.152,0.935,2.088,2.087,2.088h4.602c1.153,0,2.087-0.936,2.087-2.088C306.244,295.559,305.309,294.625,304.157,294.625z"/>
        </svg>
    );

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
        icon: { src: scheduleBlockIcon },
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
            },
            showFilter: {
                type: 'boolean',
                default: true
            }
        },
        edit: (props, attributes) => {
            const { attributes: { noOfschedule, title, showTitle, showFilter }, className, setAttributes, clientId } = props;

            $(document).on('click', `#block-${clientId} .schedule-row .remove-button`, function (e) {
                if ('' !== $(this).parents(`#block-${clientId}`)) {
                    setAttributes({ noOfschedule: noOfschedule - 1 });
                    removehildawardsBlock(noOfschedule);
                }
            });

            return (
                <Fragment>
                    { showFilter &&
                    <div class="schedule-glance-filter">
                        <div class="date"><label>Date</label>
                            <div class="schedule-select"><select id="date">
                                <option>Select a Date</option>
                            </select></div>
                        </div>
                        <div class="pass-type"><label>Is Open To</label>
                            <div class="schedule-select"><select id="pass-type">
                                <option>Select a Pass Time</option>
                            </select></div>
                        </div>
                        <div class="location"><label>Location</label>
                            <div class="schedule-select"><select id="location">
                                <option>Select a Location</option>
                            </select></div>
                        </div>
                        <div class="type"><label>Type</label>
                            <div class="schedule-select"><select id="type">
                                <option>Select a Type</option>
                            </select></div>
                        </div>
                        <div class="search-box"><label>Name</label>
                            <div class="schedule-select"><input id="box-main-search" class="schedule-search" name="schedule-search" type="text" placeholder="Filter by name..." /></div>
                        </div>
                    </div>
                        }
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
                                <PanelRow>
                                    <ToggleControl
                                        label={__('Show Filter')}
                                        checked={showFilter}
                                        onChange={() => setAttributes({ showFilter: ! showFilter })}
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
                </Fragment>
            );
        },
        save: (props) => {
            const { attributes: { title, showTitle, showFilter }, className } = props;
            return (
                <Fragment>
                    { showFilter &&
                    <div class="schedule-glance-filter">
                        <div class="date"><label>Date</label>
                            <div class="schedule-select"><select id="date">
                                <option>Select a Date</option>
                            </select></div>
                        </div>
                        <div class="pass-type"><label>Is Open To</label>
                            <div class="schedule-select"><select id="pass-type">
                                <option>Select a Pass Time</option>
                            </select></div>
                        </div>
                        <div class="location"><label>Location</label>
                            <div class="schedule-select"><select id="location">
                                <option>Select a Location</option>
                            </select></div>
                        </div>
                        <div class="type"><label>Type</label>
                            <div class="schedule-select"><select id="type">
                                <option>Select a Type</option>
                            </select></div>
                        </div>
                        <div class="search-box"><label>Name</label>
                            <div class="schedule-select"><input id="box-main-search" class="schedule-search" name="schedule-search" type="text" placeholder="Filter by name..." /></div>
                        </div>
                    </div>
                        }
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
                </Fragment>
            );
        }
    });

    /* schedule Block */
    registerBlockType('nab/schedule-item', {
        title: __('Schedule Items'),
        description: __('Schedule Items'),
        icon: { src: scheduleBlockIcon },
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

