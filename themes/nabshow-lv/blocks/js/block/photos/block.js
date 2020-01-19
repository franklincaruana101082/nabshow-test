(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
  const { __ } = wpI18n;
  const { registerBlockType } = wpBlocks;
  const { Component } = wpElement;
  const { MediaUpload, InspectorControls } = wpEditor;
  const { Button, PanelBody, TextControl} = wpComponents;

  const photosBlockIcon = (
    <svg width="150px" height="150px" viewBox="222.64 222.641 150 150" enable-background="new 222.64 222.641 150 150">
      <g>
        <g>
          <g>
            <path fill="#0F6CB6" d="M362.786,238.301H251.138c-2.563,0-4.661,2.072-4.661,4.661v4.661h-4.661
              c-2.563,0-4.661,2.071-4.661,4.661v4.661h-4.661c-2.563,0-4.661,2.072-4.661,4.661v90.713c0,2.563,2.071,4.661,4.661,4.661
              h111.647c2.562,0,4.66-2.071,4.66-4.661v-4.661h4.662c2.562,0,4.66-2.071,4.66-4.661v-4.661h4.662c2.562,0,4.66-2.071,4.66-4.66
              v-90.714C367.446,240.373,365.375,238.301,362.786,238.301z M344.169,313.531l-12.185-13.955c-0.927-1.063-2.563-1.063-3.516,0
              l-14.719,16.845l-40.124-35.653c-0.873-0.791-2.208-0.791-3.081,0l-37.997,33.773v-50.645c0-1.282,1.036-2.317,2.317-2.317
              h106.986c1.281,0,2.317,1.036,2.317,2.317V313.531L344.169,313.531z M351.174,342.971h-2.317v-81.419
              c0-2.562-2.071-4.661-4.66-4.661H241.844v-2.316c0-1.282,1.036-2.317,2.316-2.317h106.986c1.281,0,2.317,1.036,2.317,2.317
              l0.027,86.08C353.491,341.935,352.455,342.971,351.174,342.971z M360.469,333.648h-2.317v-81.392c0-2.562-2.071-4.661-4.66-4.661
              H251.138v-2.316c0-1.281,1.036-2.317,2.317-2.317h106.986c1.281,0,2.316,1.036,2.316,2.317v86.052h0.028
              C362.786,332.612,361.75,333.648,360.469,333.648z"/>
            <path fill="#0F6CB6" d="M311.622,275.507c-5.124,0-9.294,4.17-9.294,9.295s4.17,9.295,9.294,9.295
              c5.125,0,9.295-4.171,9.295-9.295S316.747,275.507,311.622,275.507z"/>
          </g>
        </g>
      </g>
    </svg>
  );

  class PhotoComponent extends Component {

    render() {
      const { attributes, setAttributes, className } = this.props;
      const { dataArry } = attributes;

      if (0 === dataArry.length) {
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
                  caption: ''
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
                  <div className="photo-caption">
                    <TextControl
                      type="string"
                      className="caption"
                      value={photo.caption}
                      placeholder="Caption"
                      onChange={ cap => {
                        let tempDataArray = [...dataArry];
                        tempDataArray[index].caption = cap;
                        setAttributes({ dataArry: tempDataArray});
                      }}
                    />
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
    description: __('NabShow Photos'),
    icon: { src: photosBlockIcon },
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
      const { attributes } = props;
      const { dataArry } = attributes;

      return (
        <div className="nab-photos">
          {dataArry.map((photo, index) => (
            <div className="photo-item" key={index}>
              <div className="photo-inner">
                <div className="hover-items">
                  <a className="popup-btn"><i className="fa fa-image"></i></a>
                  <a className="download" href={photo.media} download><i className="fa fa-download"></i></a>
                </div>
                <img src={photo.media} alt={photo.alt} className="media" width={photo.width} />
              </div>
              <div className="photo-caption">
                <p className='caption'>{photo.caption}</p>
              </div>
            </div>
          ))}
          <div className="photos-popup">
            <div className="photos-dialog">
              <span className="close">&times;</span>
              <div className="photos-content">
                <div className="photos-body">
                  <img className="photos-popup-img" src="" />
                </div>
                <span className="popup-photo-cation"></span>
              </div>
            </div>
            <div className="photos-backdrop"></div>
          </div>
        </div>
      );
    }
  });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);
