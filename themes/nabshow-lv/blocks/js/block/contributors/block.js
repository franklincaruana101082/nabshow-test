(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    const { __ } = wpI18n;
    const { Component, Fragment } = wpElement;
    const { registerBlockType } = wpBlocks;
    const { InspectorControls } = wpEditor;
    const { PanelBody, RangeControl, SelectControl, ServerSideRender, Placeholder } = wpComponents;

    const contributorsBlock = (
        <svg width="150px" height="150px" viewBox="0 0 150 150" enable-background="new 0 0 150 150">
            <path fill="#146DB6" d="M41.882,109.118c3.912,0,7.097-3.185,7.097-7.097s-3.185-7.097-7.097-7.097s-7.097,3.185-7.097,7.097
                c0,0.575,0.088,1.128,0.217,1.665l-8.042,5.576c-1.684-1.545-3.907-2.51-6.368-2.51c-5.219,0-9.462,4.243-9.462,9.462
                s4.244,9.462,9.462,9.462c2.46,0,4.684-0.965,6.368-2.51l8.042,5.576c-0.129,0.536-0.217,1.09-0.217,1.665
                c0,3.912,3.185,7.097,7.097,7.097s7.097-3.185,7.097-7.097s-3.185-7.097-7.097-7.097c-1.616,0-3.09,0.563-4.284,1.477l-8.072-5.596
                c0.318-0.941,0.528-1.933,0.528-2.978s-0.21-2.036-0.528-2.978l8.072-5.596C38.792,108.556,40.266,109.118,41.882,109.118z
                M41.882,99.656c1.305,0,2.366,1.063,2.366,2.365s-1.061,2.365-2.366,2.365s-2.366-1.063-2.366-2.365S40.577,99.656,41.882,99.656z
                M20.592,120.946c-2.609,0-4.731-2.122-4.731-4.731s2.122-4.731,4.731-4.731s4.731,2.122,4.731,4.731S23.201,120.946,20.592,120.946
                z M41.882,128.043c1.305,0,2.366,1.063,2.366,2.365s-1.061,2.366-2.366,2.366s-2.366-1.063-2.366-2.366
                S40.577,128.043,41.882,128.043z"/>
            <path fill="#146DB6" d="M96.29,76c5.219,0,9.463-4.244,9.463-9.462h-4.731c0,2.609-2.122,4.731-4.731,4.731
                s-4.731-2.122-4.731-4.731h-4.73C86.828,71.756,91.071,76,96.29,76z"/>
            <path fill="#146DB6" d="M148.333,112.253c0-7.14-4.551-13.453-11.322-15.71l-24.161-8.056v-6.625
                c4.047-3.348,7.045-7.903,8.489-13.101c5.86-0.698,10.435-5.642,10.435-11.686V33.654c0-7.776-5.301-14.568-12.746-16.521
                l-0.25-0.376c-5.878-8.822-15.725-14.09-26.329-14.09C75,2.667,60.807,16.86,60.807,34.309v22.766
                c0,6.044,4.575,10.988,10.435,11.686c1.445,5.198,4.442,9.753,8.49,13.101v6.625l-19.545,6.516
                c-6.079-7.27-15.205-11.906-25.401-11.906c-18.263,0-33.118,14.855-33.118,33.118s14.855,33.118,33.118,33.118
                c8.999,0,17.16-3.619,23.132-9.462h90.416V112.253z M121.342,96.306l-9.141,18.281L99.796,102.18l11.191-9.327L121.342,96.306z
                M98.656,47.613v4.731h-4.731v-4.731H75v-2.485c4.272-0.395,8.322-1.846,11.828-4.245v4.365h2.365
                c5.141,0,10.045-1.528,14.193-4.368v4.368h3.3c3.993,0,7.785-1.311,10.894-3.617v5.982H98.656z M75,52.344h14.193v2.366
                c0,1.303-1.061,2.365-2.365,2.365h-9.463c-1.305,0-2.365-1.063-2.365-2.365V52.344z M103.387,52.344h14.193v2.366
                c0,1.303-1.06,2.365-2.365,2.365h-9.462c-1.306,0-2.366-1.063-2.366-2.365V52.344z M122.212,63.768c0.05-0.65,0.1-1.3,0.1-1.961
                V50.414c2.747,0.98,4.731,3.582,4.731,6.661C127.043,60.19,125.011,62.816,122.212,63.768z M92.448,7.398
                c9.021,0,17.392,4.48,22.393,11.984l1.318,1.971l0.958,0.191c5.75,1.152,9.926,6.246,9.926,12.11v14.018
                c-1.382-1.045-2.974-1.829-4.731-2.186V33.419h-4.731v1.583c-2.269,3.07-5.688,5.041-9.462,5.438V30.086l-4.444,4.433
                c-3.303,3.305-7.539,5.342-12.115,5.864V30.086l-4.444,4.433c-3.302,3.305-7.541,5.327-12.114,5.85v-6.95h-4.731v12.067
                c-1.758,0.359-3.35,1.14-4.731,2.186V34.309C65.538,19.472,77.611,7.398,92.448,7.398z M65.538,57.075
                c0-3.079,1.984-5.682,4.731-6.661v11.393c0,0.662,0.049,1.311,0.099,1.961C67.569,62.816,65.538,60.19,65.538,57.075z M75,61.807
                v-0.436c0.743,0.265,1.533,0.436,2.365,0.436h9.463c3.079,0,5.682-1.984,6.661-4.731h5.604c0.979,2.747,3.581,4.731,6.661,4.731
                h9.462c0.833,0,1.623-0.17,2.365-0.436v0.436c0,11.737-9.55,21.29-21.29,21.29C84.553,83.097,75,73.544,75,61.807z M96.29,87.828
                c4.26,0,8.275-1.05,11.828-2.872v4.131L96.29,98.944l-11.828-9.857v-4.131C88.016,86.778,92.03,87.828,96.29,87.828z M81.596,92.854
                l11.191,9.327L80.382,114.59l-9.14-18.281L81.596,92.854z M66.705,97.818l12.376,24.755l14.844-14.841v27.407H61.926
                c3.756-5.37,5.978-11.89,5.978-18.925c0-6.295-1.795-12.162-4.857-17.18L66.705,97.818z M34.785,144.602
                c-15.654,0-28.387-12.733-28.387-28.387s12.734-28.387,28.387-28.387s28.387,12.733,28.387,28.387S50.439,144.602,34.785,144.602z
                M143.602,135.14h-14.193v-18.925h-4.731v18.925H98.656v-27.407l14.841,14.841l12.377-24.756l9.638,3.212
                c4.84,1.614,8.09,6.123,8.09,11.224V135.14z"/>
        </svg>
    );

    class NABContributors extends Component {
        constructor() {
            super(...arguments);
            this.state = {
                postTypeList: [{ label: 'Select Post Type', value: '' }],
            };
        }

        componentWillMount() {
            let postTypeKey,
                postOptions = [{ label: 'Select Post Type', value: '' }],
                excludePostTypes = ['attachment', 'wp_block'];

            // Fetch all post types
            wp.apiFetch({ path: '/wp/v2/types' }).then((postTypes) => {
                postTypeKey = Object.keys(postTypes).filter(postType => ! excludePostTypes.includes(postType));
                postTypeKey.forEach(function (key) {
                    postOptions.push({ label: __(postTypes[key].name), value: __(postTypes[key].slug) });
                });
                this.setState({ postTypeList: postOptions });
            });

        }

        render() {
            const { attributes: { postType, itemToFetch }, setAttributes } = this.props;
            if (! postType) {
                return (
                    <Placeholder
                        instructions={__('Choose post type to list Contributors/Authors')}
                    >
                        <div className="inspector-field inspector-field-radiocontrol ">
                            <SelectControl
                                value={postType}
                                options={this.state.postTypeList}
                                onChange={(value) => { setAttributes({ postType: value }); }}
                            />
                        </div>
                    </Placeholder>
                );
            }
            return (
                <Fragment>
                    <InspectorControls>
                        <PanelBody title={__('Data Settings')} className="range-setting">
                            <div className="inspector-field inspector-field-Numberofitems">
                                <label className="inspector-mb-0">Number of items</label>
                                <RangeControl
                                    value={itemToFetch}
                                    min={1}
                                    max={20}
                                    onChange={(item) => { setAttributes({ itemToFetch: parseInt(item) }); }}
                                />
                            </div>
                            <SelectControl
                                label={__('Select Post Type')}
                                value={postType}
                                options={this.state.postTypeList}
                                onChange={(value) => { setAttributes({ postType: value }); }}
                            />
                        </PanelBody>
                    </InspectorControls>
                    <ServerSideRender
                        block="nab/contributors-authors"
                        attributes={{ postType: postType, itemToFetch: itemToFetch }}
                    />
                </Fragment>

            );
        }
    }

    const allAttr = {
        postType: {
            type: 'string',
        },
        itemToFetch: {
            type: 'number',
            default: 10
        },
    };


    registerBlockType('nab/contributors-authors', {
        title: __('Contributors / Authors'),
        icon: { src: contributorsBlock},
        category: 'nabshow',
        keywords: [__('contributors'), __('authors')],
        attributes: allAttr,
        edit: NABContributors,
        save() {
            return null;
        },
    });

})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);