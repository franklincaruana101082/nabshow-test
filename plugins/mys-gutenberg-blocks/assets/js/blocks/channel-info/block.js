(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    const {__} = wpI18n;
    const { Fragment } = wpElement;
    const { registerBlockType } = wpBlocks;    
    const { ServerSideRender} = wpComponents;

    const channelBlockIcon = (
        <svg xmlns="http://www.w3.org/2000/svg" id="Capa_1" enable-background="new 0 0 512 512" height="50" viewBox="0 0 512 512" width="50"><g id="XMLID_1372_"><path id="XMLID_1863_" d="m482 138h-452c-11.046 0-20 8.954-20 20v324c0 11.046 8.954 20 20 20h452c11.046 0 20-8.954 20-20v-324c0-11.046-8.954-20-20-20z" fill="#a0c8ff"/><path id="XMLID_1862_" d="m66 194h296v252h-296z" fill="#f8f8f8"/><path id="XMLID_2045_" d="m66 194h74v252h-74z" fill="#d5ea7a"/><path id="XMLID_2044_" d="m140 194h74v252h-74z" fill="#bfe5f6"/><path id="XMLID_2043_" d="m214 194h74v252h-74z" fill="#f0c980"/><path id="XMLID_2042_" d="m288 194h74v252h-74z" fill="#ff7a7a"/><circle id="XMLID_1861_" cx="432" cy="416" fill="#f0c980" r="30"/><path id="XMLID_1860_" d="m305 138c0-27.062-21.938-49-49-49s-49 21.938-49 49z" fill="#b7bcce"/><g id="XMLID_637_"><path id="XMLID_640_" d="m482 128h-167.865c-1.488-8.674-4.872-16.705-9.715-23.653l87.276-87.276c3.905-3.905 3.905-10.237 0-14.143-3.905-3.904-10.237-3.904-14.143 0l-87.17 87.171c-9.689-6.974-21.56-11.099-34.383-11.099-12.63 0-24.336 4.002-33.944 10.787l-44.922-44.922c-3.905-3.904-10.237-3.904-14.143 0-3.905 3.905-3.905 10.237 0 14.143l44.9 44.9c-5.009 7.048-8.508 15.233-10.028 24.092h-167.863c-16.542 0-30 13.458-30 30v324c0 16.542 13.458 30 30 30h452c16.542 0 30-13.458 30-30v-324c0-16.542-13.458-30-30-30zm-226-29c18.049 0 33.267 12.326 37.695 29h-75.39c4.428-16.675 19.646-29 37.695-29zm236 383c0 5.514-4.486 10-10 10h-452c-5.514 0-10-4.486-10-10v-324c0-5.514 4.486-10 10-10h452c5.514 0 10 4.486 10 10z"/><path id="XMLID_741_" d="m362 184h-296c-5.523 0-10 4.478-10 10v252c0 5.522 4.477 10 10 10h296c5.523 0 10-4.478 10-10v-252c0-5.523-4.477-10-10-10zm-84 20v232h-54v-232zm-202 0h54v71c0 5.522 4.477 10 10 10s10-4.478 10-10v-71h54v232h-54v-71c0-5.522-4.477-10-10-10s-10 4.478-10 10v71h-54zm276 232h-54v-232h54z"/><path id="XMLID_746_" d="m432 376c-22.056 0-40 17.944-40 40s17.944 40 40 40 40-17.944 40-40-17.944-40-40-40zm0 60c-11.028 0-20-8.972-20-20s8.972-20 20-20 20 8.972 20 20-8.972 20-20 20z"/><path id="XMLID_747_" d="m462 328h-60c-5.523 0-10 4.478-10 10s4.477 10 10 10h60c5.523 0 10-4.478 10-10s-4.477-10-10-10z"/><path id="XMLID_748_" d="m462 280h-60c-5.523 0-10 4.478-10 10s4.477 10 10 10h60c5.523 0 10-4.478 10-10s-4.477-10-10-10z"/><path id="XMLID_749_" d="m462 232h-60c-5.523 0-10 4.478-10 10s4.477 10 10 10h60c5.523 0 10-4.478 10-10s-4.477-10-10-10z"/><path id="XMLID_750_" d="m462 184h-60c-5.523 0-10 4.478-10 10s4.477 10 10 10h60c5.523 0 10-4.478 10-10s-4.477-10-10-10z"/><path id="XMLID_753_" d="m140 330c2.63 0 5.21-1.07 7.07-2.931 1.86-1.859 2.93-4.439 2.93-7.069s-1.07-5.21-2.93-7.07-4.44-2.93-7.07-2.93-5.21 1.069-7.07 2.93c-1.86 1.86-2.93 4.44-2.93 7.07s1.07 5.21 2.93 7.069c1.86 1.86 4.44 2.931 7.07 2.931z"/></g></g></svg>
    );

    const allAttr = {
        pageId: {
            type: 'number'
        }        
    };

    registerBlockType('mys/channel-info', {
        title: __('Channel Info'),
        icon: { src: channelBlockIcon },
        category: 'mysgb',
        keywords: [__('channel'), __('info'), __('details')],
        attributes: allAttr,
        edit({ attributes, setAttributes }) {
            const { pageId } = attributes;
            if ( ! pageId ) {
                setAttributes( { pageId: wp.data.select('core/editor').getCurrentPostId() });
            }
            return (
                <Fragment>                    
                    <ServerSideRender
                        block="mys/channel-info"
                        attributes={ { pageId: pageId } }
                    />
                </Fragment>
            );
        },
        save() {
            return null;
        },
    });

})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);