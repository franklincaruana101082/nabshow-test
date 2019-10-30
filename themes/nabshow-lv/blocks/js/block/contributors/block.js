(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    const { __ } = wpI18n;
    const { Component, Fragment } = wpElement;
    const { registerBlockType } = wpBlocks;
    const { InspectorControls } = wpEditor;
    const { PanelBody, RangeControl, SelectControl, ServerSideRender, Placeholder } = wpComponents;

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
        icon: 'lock',
        category: 'nabshow',
        keywords: [__('contributors'), __('authors')],
        attributes: allAttr,
        edit: NABContributors,
        save() {
            return null;
        },
    });

})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);