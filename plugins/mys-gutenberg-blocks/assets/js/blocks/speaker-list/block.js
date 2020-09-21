(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    const { __ } = wpI18n;
    const { Component, Fragment } = wpElement;
    const { registerBlockType } = wpBlocks;
    const { InspectorControls } = wpEditor;
    const { PanelBody, SelectControl, ToggleControl, TextControl, ServerSideRender, CheckboxControl, RangeControl, TextareaControl } = wpComponents;    

    const speakerSliderBlockIcon = (
        <svg width="150px" height="150px" viewBox="0 0 150 150" enable-background="new 0 0 150 150">
            <rect fill="none" width="150" height="150"/>
            <g>
                <path fill="#92c83e" d="M136.125,44.55c3.45,12.15,2.85,24.15-0.15,33.601c-3.149,9.6-9.449,16.35-17.25,18.6
                    c-1.199,0.45-1.949,0.45-3,0.45c-0.449,0.149-0.899,0.149-1.35,0.149c-0.45,0.15-1.05,0.15-1.65,0.15h-51l16.65,41.25
                    c0.15,1.05-0.45,1.95-1.05,2.55c-0.601,0.75-1.8,1.2-2.55,1.2h-22.65c-0.75,0-1.95-0.45-2.55-1.2c-0.6-0.6-1.2-1.5-1.05-2.55
                    l-7.5-41.25h-9.15l-0.15-0.15c-3.75,0.45-8.1-1.35-11.55-4.649c-3.45-3.3-6.6-8.101-7.95-14.101c-1.8-6-1.5-11.7-0.15-16.5
                    c1.35-4.65,4.35-8.1,7.95-9.75l0.15-0.15l67.5-40.5c0.75-0.45,1.351-0.75,1.8-1.2c0.45-0.3,1.051-0.6,1.801-0.9
                    c1.199-0.6,2.1-0.9,3.75-1.35c7.8-2.25,16.8,0.75,24.149,7.35C126.525,22.2,132.975,32.4,136.125,44.55z M116.775,89.4h-0.15
                    c3-0.75,5.55-2.551,7.8-5.25c4.351-5.25,6.45-13.2,6.45-22.8c0-4.8-0.75-9.75-2.1-14.85c-2.551-10.2-7.65-18.75-13.351-24.3
                    c-5.7-5.55-12.6-8.25-18.45-6.6c-6.149,1.65-10.5,7.2-12.75,15c-2.399,7.8-2.1,17.7,0.45,27.9c2.851,10.2,7.5,18.75,13.5,24.3
                    C104.025,88.35,110.325,91.05,116.775,89.4L116.775,89.4z M97.725,36.3c1.65-0.3,3.15-0.15,4.65,0.3c2.85,1.2,5.7,3.6,7.65,7.5
                    c1.949,3.9,3.149,9,3.149,13.35c0,2.25-0.3,4.2-0.899,6c-1.351,3.6-3.301,6.3-6.45,7.05c-2.55,0.75-6-0.45-8.55-3
                    c-2.551-2.55-4.801-6.45-5.851-11.25c-1.35-4.65-0.899-9.3,0.15-12.9S95.175,37.05,97.725,36.3z"/>
            </g>
        </svg>
    );

    class NabSpeakerList extends Component {
        constructor() {
            super(...arguments);
            this.state = {
                channelsObj: {},
                filterChannelsObj: {},
            };
        }

        componentWillMount() {            
            // Fetch all channels
            wp.apiFetch({ path: '/nab_api/request/get-session-channels' }).then((channel) => {
                this.setState({ channelsObj: channel, filterChannelsObj: channel });
            });

        }

        filterChannels(value) {
            let filterChannels = this.state.channelsObj.filter(ch => -1 < ch.title.toLowerCase().indexOf(value.toLowerCase()));
            this.setState({ filterChannelsObj: filterChannels });
        }

        isEmpty(obj) {
            let key;
            for (key in obj) {
                if (obj.hasOwnProperty(key)) {
                    return false;
                }
            }
            return true;
        }
        render() {
            const { attributes, setAttributes } = this.props;
            const { itemToFetch, includeSpeakers, channels, featuredSpeaker, blockTitle, orderBy } = attributes;
            return (
                <Fragment>
                    <InspectorControls>
                        <PanelBody title={__('Data Settings ')} initialOpen={true} className="range-setting">
                            <ToggleControl
                                label={__('Featured Speaker')}
                                checked={featuredSpeaker}
                                onChange={() => setAttributes({ featuredSpeaker: ! featuredSpeaker }) }
                            />
                            <div className="inspector-field inspector-field-Numberofitems ">
                                <label className="inspector-mb-0">Number of items</label>
                                <RangeControl
                                    value={itemToFetch}
                                    min={1}
                                    max={100}
                                    onChange={(item) => setAttributes({ itemToFetch: parseInt(item) }) }
                                />
                            </div>
                            <SelectControl
                                label={__('Order by')}
                                value={orderBy}
                                options={[
                                    { label: __('Alphabetical'), value: 'name' },                                    
                                    { label: __('Random'), value: 'rand' },
                                ]}
                                onChange={ (value) => setAttributes({ orderBy: value }) }
                            />
                            { ( 0 < this.state.channelsObj.length ) &&

                            <Fragment>
                                { 
                                <div>
                                    <label>{__(`Select Channels`)}</label>

                                    {7 < this.state.channelsObj.length &&
                                    <TextControl
                                        type="string"
                                        name='channel-filter-input'
                                        placeHolder="Search Channel"
                                        onChange={ value => this.filterChannels(value)}
                                    />
                                    }

                                    <div className="fix-height-select">

                                        {this.state.filterChannelsObj.map((ch, index) => (

                                            <Fragment key={index}>
                                                <CheckboxControl checked={-1 < channels.indexOf(ch.post_id)} label={ch.title} name="channels[]" value={ch.post_id} onChange={(isChecked) => {                                                
                                                    let i,
                                                    tempChannels = [...channels];                                                    

                                                    if ( isChecked ) {
                                                        tempChannels.push(ch.post_id);
                                                    } else {
                                                        i = tempChannels.indexOf(ch.post_id);
                                                        tempChannels.splice(i, 1);                                                    
                                                    }                                                    
                                                    this.props.setAttributes({ channels: tempChannels });                                                    
                                                    }
                                                }
                                                />
                                            </Fragment>
                                        ))
                                        }
                                    </div>
                                </div>                                    
                                }
                            </Fragment>
                            }
                            <label>Include Speaker by Ids:</label>
                            <TextareaControl
                              help="Each speaker id should be comma separated"
                              value={ includeSpeakers }
                              onChange={ (ids) => {  setAttributes({ includeSpeakers: ids }); }}
                            />
                            <label>Block Title</label>
                            <TextControl
                                type="string"
                                value={blockTitle}                                
                                onChange={ value => setAttributes({ blockTitle: value })}
                            />
                        </PanelBody>
                    </InspectorControls>
                    <ServerSideRender
                        block="mys/speakers-list"
                        attributes={{ itemToFetch: itemToFetch, channels: channels, includeSpeakers: includeSpeakers, featuredSpeaker: featuredSpeaker, blockTitle: blockTitle, orderBy: orderBy }}
                    />
                </Fragment >
            );
        }
    }
    const blockAttrs = {
        itemToFetch: {
            type: 'number',
            default: 10
        },    
        channels: {
            type: 'array',
            default: []
        },
        includeSpeakers: {
            type: 'string',
            default: ''
        },
        blockTitle: {
            type: 'string',
            default: 'Featured Speakers'
        },
        orderBy: {
            type: 'string',
            default: 'name'
        },
        featuredSpeaker: {
            type: 'boolean',
            default: false
        }
    };
    registerBlockType('mys/speakers-list', {
        title: __('Speaker List'),
        icon: { src: speakerSliderBlockIcon },
        category: 'mysgb',
        keywords: [__('speaker'), __('list'), __('details')],
        attributes: blockAttrs,
        edit: NabSpeakerList,
        save() {
            return null;
        },
    });

})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);
