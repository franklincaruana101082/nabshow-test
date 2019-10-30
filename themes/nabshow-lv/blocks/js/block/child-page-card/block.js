(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    const { __ } = wpI18n;
    const { Component, Fragment } = wpElement;
    const { registerBlockType } = wpBlocks;
    const { InspectorControls } = wpEditor;
    const { PanelBody, ServerSideRender, Button, Placeholder, SelectControl } = wpComponents;

    class NABChildPageCard extends Component {
        constructor() {
            super(...arguments);
            this.state = {
                pageParentList: [{label: __('Select Parent Page'), value: ''}],
            };
        }

        componentWillMount() {
            let pageList = this.state.pageParentList;

            // Fetch all parent pages
            wp.apiFetch({ path: '/nab_api/request/page-parents' }).then((parents) => {
                if (0 < parents.length) {
                    parents.map((parent) => {
                        pageList.push({ label: __(parent.title), value: parent.id });
                    });
                    this.setState({ pageParentList: pageList });
                }
            });

        }

        render() {
            const { attributes: { parentPageId,  selection}, setAttributes } = this.props;

            let commonControls = <SelectControl
                        label={__('Choose option to get child page card')}
                        value={parentPageId}
                        options={this.state.pageParentList}
                        onChange={(value) => setAttributes({ parentPageId: value }) }
                    />;

            if (! selection) {
                return (
                    <Placeholder
                        label={__('Child Page Card Slider')}
                    >
                        {commonControls}
                        <Button className="button button-large button-primary" onClick={() => setAttributes({ selection: true }) } >
                            {__('Apply')}
                        </Button>
                    </Placeholder>
                );
            }
            return (
                <Fragment>
                    <InspectorControls>
                        <PanelBody title={__('Data Settings')}>
                            {commonControls}
                        </PanelBody>
                    </InspectorControls>
                    <ServerSideRender
                        block="nab/child-page-card-block"
                        attributes={{ parentPageId: parentPageId }}
                    />
                </Fragment>

            );
        }
    }

    const allAttr = {
        parentPageId: {
            type: 'number'
        },
        selection: {
            type: 'boolean',
            default: false
        }
    };

    registerBlockType('nab/child-page-card-block', {
        title: __('Child Page Card Slider'),
        icon: 'lock',
        category: 'nabshow',
        keywords: [__('child'), __('page'), __('card')],
        attributes: allAttr,
        edit: NABChildPageCard,
        save() {
            return null;
        },
    });

})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);