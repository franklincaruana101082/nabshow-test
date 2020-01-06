(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
  const { __ } = wpI18n;
  const { registerBlockType } = wpBlocks;
  const { Component } = wpElement;
  const { MediaUpload, InspectorControls } = wpEditor;
  const { Button, TextControl, PanelBody } = wpComponents;

  const videoBlockIcon = (
    <svg width="150px" height="150px" viewBox="222.64 222.641 150 150" enable-background="new 222.64 222.641 150 150">
      <g>
        <path fill="#0F6CB6" d="M283.734,293.523c0.38,0.208,0.802,0.312,1.22,0.312c0.475,0,0.946-0.134,1.363-0.396l27.907-17.759
          c0.73-0.467,1.175-1.274,1.175-2.142c0-0.867-0.444-1.674-1.175-2.141l-27.907-17.759c-0.787-0.495-1.769-0.528-2.585-0.084
          c-0.809,0.446-1.314,1.299-1.314,2.225v35.519C282.417,292.224,282.922,293.076,283.734,293.523z M287.492,260.399l20.646,13.139
          l-20.646,13.14V260.399z"/>
        <path fill="#0F6CB6" d="M229.14,227.872v139.537h137V227.872H229.14z M361.065,232.946v83.722H234.214v-83.722H361.065z
          M234.214,362.335v-40.593h126.852v40.593H234.214L234.214,362.335z"/>
        <path fill="#0F6CB6" d="M348.381,339.502h-60.889v-5.074c0-1.403-1.134-2.537-2.537-2.537s-2.537,1.134-2.537,2.537v5.074H272.27
          c-1.403,0-2.537,1.134-2.537,2.536c0,1.403,1.134,2.537,2.537,2.537h10.148v5.074c0,1.403,1.134,2.537,2.537,2.537
          c1.403,0,2.537-1.134,2.537-2.537v-5.074h60.89c1.402,0,2.536-1.134,2.536-2.537C350.917,340.636,349.783,339.502,348.381,339.502z
          "/>
        <path fill="#0F6CB6" d="M246.899,331.891c-1.403,0-2.537,1.134-2.537,2.537v15.222c0,1.403,1.134,2.537,2.537,2.537
          s2.537-1.134,2.537-2.537v-15.222C249.436,333.024,248.302,331.891,246.899,331.891z"/>
        <path fill="#0F6CB6" d="M257.047,331.891c-1.403,0-2.537,1.134-2.537,2.537v15.222c0,1.403,1.134,2.537,2.537,2.537
          s2.537-1.134,2.537-2.537v-15.222C259.584,333.024,258.45,331.891,257.047,331.891z"/>
      </g>
    </svg>
  );

  class VideoComponent extends Component {

    render() {
      const { attributes, setAttributes, className } = this.props;
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
    title: __('Videos'),
    description: __('Nabshow videos'),
    icon: { src: videoBlockIcon },
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
              <span className="close">&times;</span>
              <div className="videos-content">
                <div className="videos-body">
                  <iframe src="" className="videos-popup-iframe" frameBorder="0" allowFullScreen />
                </div>
              </div>
            </div>
            <div className="videos-backdrop"></div>
          </div>
        </div>
      );
    }
  });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);
