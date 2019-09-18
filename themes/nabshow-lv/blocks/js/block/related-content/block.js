(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    const { __ } = wpI18n;
    const { Component, Fragment } = wpElement;
    const { registerBlockType } = wpBlocks;
    const { InspectorControls } = wpEditor;
    const { PanelBody, RangeControl, RadioControl, ServerSideRender, Button, Placeholder, CheckboxControl, SelectControl } = wpComponents;

    class NABRelatedContent extends Component {
        constructor() {
            super(...arguments);
            this.state = {
                pageParentList: [ { label: __('Select Parent Page'), value: ''} ],
            };
        }

        componentWillMount() {
            let pageList = [ { label: __('Select Parent Page'), value: ''} ];

            // Fetch all parent pages
            wp.apiFetch({ path: '/nab_api/request/page-parents' }).then((parents) => {
                if ( 0 < parents.length ) {
                    parents.map((parent) => {
                        pageList.push({ label: __(parent.title), value: parent.id });
                    });
                    this.setState({ pageParentList: pageList });
                }
            });

        }

        render() {
            const { attributes: { parentPageId, selection, itemToFetch, depthLevel, featuredPage }, setAttributes } = this.props;

            let commonControls = <Fragment>
                                    <SelectControl
                                        label={__('Choose option to get related content')}
                                        value={parentPageId}
                                        options={this.state.pageParentList}
                                        onChange={ (value) => { setAttributes({ parentPageId: value }); }}
                                    />
                                    <div className="inspector-field inspector-field-radiocontrol ">
                                        <RadioControl
                                            selected={depthLevel}
                                            options={[
                                                { label: 'Grand Children', value: 'grandchildren' },
                                                { label: 'Direct Descendants', value: 'descendants' },
                                            ]}
                                            onChange={(option) => setAttributes({ depthLevel: option }) }
                                        />
                                    </div>
                            </Fragment>;

            if (! selection) {
                return (
                    <Placeholder
                        label={__('Related Content')}
                    >
                        {commonControls}
                        <Button className="button button-large button-primary" onClick={() => setAttributes({ selection: true })}>
                            {__('Apply')}
                        </Button>
                    </Placeholder>
                );
            }
            return (
                <Fragment>
                    <InspectorControls>
                        <PanelBody title={__('Content Settings')}>
                            <div className="inspector-field inspector-field-Numberofitems ">
                                <label className="inspector-mb-0">Number of items</label>
                                <RangeControl
                                    value={itemToFetch}
                                    min={1}
                                    max={20}
                                    onChange={(item) => setAttributes({ itemToFetch: parseInt(item) })}
                                />
                            </div>
                            {commonControls}
                            <CheckboxControl
                                label="Featured Page"
                                checked={ featuredPage }
                                onChange={ () => { setAttributes({ featuredPage: ! featuredPage }); } }
                            />
                        </PanelBody>
                    </InspectorControls>
                    <ServerSideRender
                        block="nab/related-content"
                        attributes={{ parentPageId: parentPageId, itemToFetch: itemToFetch, depthLevel: depthLevel, featuredPage: featuredPage }}
                    />
                </Fragment>

            );
        }
    }

    const allAttr = {
        itemToFetch: {
            type: 'number',
            default: 10
        },
        parentPageId: {
            type: 'string',
        },
        selection: {
            type: 'boolean',
            default: false
        },
        depthLevel: {
            type: 'string',
            default: 'grandchildren'

        },
        featuredPage: {
            type: 'boolean',
            default: false
        }
    };

    registerBlockType('nab/related-content', {
        title: __('Related Content'),
        icon: 'lock',
        category: 'nabshow',
        keywords: [__('related'), __('content')],
        attributes: allAttr,
        edit: NABRelatedContent,
        save() {
            return null;
        },
    });

})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);