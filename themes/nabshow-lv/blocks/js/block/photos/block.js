(function(wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
  const { __ } = wp.i18n;
  const { registerBlockType } = wp.blocks;
  const { Fragment, Component } = wp.element;
  const { RichText, MediaUpload, InspectorControls } = wp.editor;
  const { Button, PanelBody } = wp.components;

  class PhotoComponent extends Component {

    render() {
        const { attributes, setAttributes, clientId, className } = this.props;
        const {dataArry} = attributes;

        if (0 === dataArry.length){
          return (
            <div className="photos-add first-time">
              <MediaUpload
                multiple
                onSelect={item => {
                  const photoInsert = item.map((item, index) => ({
                      index: index,
                      media: item.url,
                      alt: item.alt,
                      id: item.id,
                      width: item.sizes.full.width,
                  }));
                  setAttributes({
                      dataArry: [
                          ...dataArry,
                          ...photoInsert,
                      ]
                  });
                }}
                type="image"
                render={({ open }) => <Button onClick={open} className="button button-large"><span className="dashicons dashicons-upload"></span> Click Here to Upload</Button>}
              />
            </div>
          );
        }

        return (
          <div className={`nab-photos ${className}`}>
             {
               dataArry.map((photo, index) => {
                return (
                  <div className="photo-item" key={index}>
                    <div className="photo-inner">
                          <span
                           onClick={() => {
                            const qewQusote = dataArry
                              .filter(item => item.index != photo.index)
                              .map(t => {
                                  if (t.index > photo.index) {
                                      t.index -= 1;
                                  }

                                  return t;
                              });
                              setAttributes({
                                  dataArry: qewQusote
                              });
                            }}
                          className="dashicons dashicons-no-alt remove"></span>
                      <img src={photo.media} alt={photo.alt} className="media" width={photo.width} />
                    </div>
                  </div>
                );
               })
             }
            <InspectorControls>
              <div className="photos-add">
                <MediaUpload
                  multiple
                  onSelect={item => {
                    const photoInsert = item.map((item, index) => ({
                        index: index,
                        media: item.url,
                        alt: item.alt,
                        id: item.id,
                        width: item.sizes.full.width,
                    }));
                    setAttributes({
                        dataArry: [
                            ...dataArry,
                            ...photoInsert,
                        ]
                    });
                  }}
                  type="image"
                  render={({ open }) => <Button onClick={open} className="button button-large"><span className="dashicons dashicons-upload"></span> Upload Image</Button>}
                />
              </div>
            </InspectorControls>
          </div>
        );
    }
}

  registerBlockType('nab/nab-photos', {
    title: __('Photos'),
    description: __('Nab Photos'),
    icon: 'format-image',
    category: 'nabshow',
    keywords: [__('Photos'), __('gutenberg'), __('nab')],
    attributes: {
      dataArry: {
        type: 'array',
        default: [],
      }
    },
    edit: PhotoComponent,

    save: props => {
      const {
        attributes,
        className
      } = props;
      const {dataArry} = attributes;

      return (
        <div className="nab-photos">
            {dataArry.map((photo, index) => (
              <div className="photo-item" key={index}>
                <div className="photo-inner">
                  <div className="hover-items">
                    <a className="popup-btn"><i className="fa fa-image"></i></a>
                    <a className="download" href={photo.media} download><i className="fa fa-download"></i></a>
                  </div>
                  <img src={photo.media} alt={photo.alt} className="media" width={photo.width}/>
                </div>
              </div>
            ))}
            <div className="photos-popup">
              <div className="photos-dialog">
                <span class="close">&times;</span>
                <div className="photos-content">
                  <div className="photos-body">
                    <img className="photos-popup-img" src="" />
                  </div>
                </div>
              </div>
              <div class="photos-backdrop"></div>
            </div>
        </div>
      );
    }
  });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);
