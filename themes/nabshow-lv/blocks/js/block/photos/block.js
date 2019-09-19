(function(wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
  const { __ } = wp.i18n;
  const { registerBlockType } = wp.blocks;
  const { Fragment, Component } = wp.element;
  const { RichText, MediaUpload } = wp.editor;
  const { Button } = wp.components;

  class PhotoComponent extends Component {

    render() {
        const { attributes, setAttributes, clientId, className } = this.props;
        const {dataArry} = attributes;

        return (
          <div className="nab-photos">
             {
               dataArry.map((photo, index) => {
                return (
                  <div className="photo-item" key={index}>
                    <div className="photo-inner">
                      <span
                        className="remove"
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
                        >
                          <span className="dashicons dashicons-no-alt"></span>
                      </span>
                      <img src={photo.media} alt={photo.alt} className="media" />
                    </div>
                  </div>
                );
               })
             }
             <div className="additem">
                <MediaUpload
                  multiple
                  onSelect={item => {
                    const photoInsert = item.map((item, index) => ({
                        index: index,
                        media: item.url,
                        alt: item.alt,
                        id: item.id,
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
                    <a className="photos-popup" href="#"><i className="fa fa-image"></i></a>
                    <a className="download" href={photo.media} download><i className="fa fa-download"></i></a>
                  </div>
                  <img src={photo.media} alt={photo.alt} className="media" />
                </div>
              </div>
            ))}
            <div className="modal" role="dialog">
              <div className="modal-dialog" role="document">
                <div className="modal-content">
                  <div className="modal-body">
                    <img src="" />
                  </div>
                </div>
              </div>
            </div>
        </div>
      );
    }
  });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);
