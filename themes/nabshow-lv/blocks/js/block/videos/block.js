(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
  const { __ } = wpI18n;
  const { registerBlockType } = wpBlocks;
  const { Component } = wpElement;
  const { MediaUpload, InspectorControls } = wpEditor;
  const { Button, TextControl } = wpComponents;

  class VideoComponent extends Component {

    render() {
      const { attributes, setAttributes, clientId, className } = this.props;
      const { dataArry, videoID } = attributes;

      if (0 === dataArry.length) {
        return (
          <div className="videos-add first-time">
            <MediaUpload
              multiple
              onSelect={item => {
                const photoInsert = item.map((item, index) => ({
                  index: index,
                  media: item.url,
                  alt: item.alt,
                  id: item.id,
                  width: item.sizes.full.width,
                  vidURL: '',
                }));
                setAttributes({
                  dataArry: [
                    ...dataArry,
                    ...photoInsert,
                  ]
                });
              }}
              type="image"
              render={({ open }) => <Button onClick={open} className="button button-large"><span className="dashicons dashicons-upload"></span> Click Here to Upload First</Button>}
            />
          </div>
        );
      }

      return (
        <div className={`nab-videos ${className}`}>
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
                    <img src={photo.media} alt={photo.alt} className="media" width={photo.width} data-video-src={photo.vidURL} />
                    <div className="video-box">
                      <TextControl
                        placeholder={__('Video URL')}
                        value={videoID}
                        onChange={(value) => {
                          let tempProdcut = [...dataArry];
                          tempProdcut[index].vidURL = value;
                          setAttributes({ dataArry: tempProdcut });
                        }}
                      />
                    </div>
                  </div>
                </div>
              );
            })
          }
          <InspectorControls>
            <div className="videos-add">
              <MediaUpload
                multiple
                onSelect={item => {
                  const photoInsert = item.map((item, index) => ({
                    index: index,
                    media: item.url,
                    alt: item.alt,
                    id: item.id,
                    width: item.sizes.full.width,
                    vidURL: '',
                  }));
                  setAttributes({
                    dataArry: [
                      ...dataArry,
                      ...photoInsert,
                    ]
                  });
                }
                }

                type="image"
                render={({ open }) => <Button onClick={open} className="button button-large"><span className="dashicons dashicons-upload"></span> Upload Image</Button>}
              />
            </div>
          </InspectorControls>
        </div>
      );
    }
  }

  registerBlockType('nab/nab-videos', {
    title: __('NAB Videos'),
    description: __('Nab videos'),
    icon: 'format-image',
    category: 'nabshow',
    keywords: [__('videos'), __('gutenberg'), __('nab')],
    attributes: {
      dataArry: {
        type: 'array',
        default: [],
      },
      videoURL: {
        type: 'string',
      },
      videoID: {
        type: 'string',
      },
    },
    edit: VideoComponent,

    save: props => {
      const { attributes } = props;
      const { dataArry } = attributes;

      return (
        <div className="nab-videos">
          {dataArry.map((photo, index) => (
            <div className="photo-item" key={index}>

              <div className="photo-inner">
                <div className="hover-items">
                  <a className="video-popup-btn"><i className="fa fa-image"></i></a>
                </div>
                <img src={photo.media} alt={photo.alt} className="media" width={photo.width} data-video-src={photo.vidURL} />
              </div>
            </div>
          ))}
          <div className="videos-popup">
            <div className="videos-dialog">
              <span class="close">&times;</span>
              <div className="videos-content">
                <div className="videos-body">
                  {/* <img src="" class="videos-popup-iframe" /> */}
                  <iframe src="" class="videos-popup-iframe" frameBorder="0" allowFullScreen />
                </div>
              </div>
            </div>
            <div class="videos-backdrop"></div>
          </div>
        </div>
      );
    }
  });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);
