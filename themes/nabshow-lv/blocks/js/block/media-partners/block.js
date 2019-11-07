import times from 'lodash/times';
import memoize from 'memize';

(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
  const { __ } = wpI18n;
  const { registerBlockType } = wpBlocks;
  const { Fragment } = wpElement;
  const { RichText, InspectorControls, InnerBlocks, MediaUpload } = wpEditor;
  const { TextControl, PanelBody, PanelRow, Button, CheckboxControl, IconButton, ToggleControl } = wpComponents;

  const ALLOWBLOCKS = ['nab/media-partner-item'];

  const getChildscheduleBlock = memoize(schedule => {
    return times(schedule, n => ['nab/media-partner-item', { id: n + 1 }]);
  });

  const removehildawardsBlock = memoize((schedule) => {
    return times(schedule, (n) => ['nab/media-partner-item', { id: n - 1 }]);
  });

  /* Parent schedule Block */
  registerBlockType('nab/media-partners', {
    title: __('Media Partner'),
    description: __('Media Partner'),
    icon: 'money',
    category: 'nabshow',
    keywords: [__('Media Partner'), __('gutenberg'), __('nab')],
    attributes: {
      blockId: {
        type: 'string'
      },
      noOfschedule: {
        type: 'number',
        default: 1
      }
    },
    edit: (props, attributes) => {
      const {
        attributes: { noOfschedule }, className, setAttributes, clientId } = props;

      $(document).on('click', `#block-${clientId} .team-box-inner .remove-button`, function (e) {
        if ('' !== $(this).parents(`#block-${clientId}`)) {
          setAttributes({ noOfschedule: noOfschedule - 1 });
          removehildawardsBlock(noOfschedule);
        }
      });

      return (
        <div className={`team-main media-partners ${className ? className : ''}`}>
          <InnerBlocks
            template={getChildscheduleBlock(noOfschedule)}
            templateLock="all"
            allowedBlocks={ALLOWBLOCKS}
          />
          <div className="add-remove-btn">
            <Button
              className="add"
              onClick={() => setAttributes({ noOfschedule: noOfschedule + 1 })}
            >
              <span className="dashicons dashicons-plus" />
            </Button>
          </div>
        </div>
      );
    },
    save: props => {
      const { className } = props;
      return (
        <div className={`team-main media-partners ${className ? className : ''}`}>
          <InnerBlocks.Content />
        </div>
      );
    }
  });

  /* schedule Block */
  registerBlockType('nab/media-partner-item', {
    title: __('Media Partner Items'),
    description: __('Media Partner Items'),
    icon: 'businessman',
    category: 'nabshow',
    parent: ['nab/media-partners'],
    attributes: {
      name: {
        type: 'string'
      },
      description: {
        type: 'string'
      },
      imageAlt: {
        attribute: 'alt'
      },
      imageUrl: {
        attribute: 'src'
      },
      InsertUrl: {
        type: 'string',
        default: ''
      },
      department: {
        type: 'string'
      },
      topics: {
        type: 'string'
      },
      topicsList: {
        type: 'array',
        default: [
          'Advanced Advertising',
          'AR / VR / XR',
          'Artificial Intelligence',
          'Broadcast Technologies',
          'Business Strategies',
          'Cloud Tech',
          'Content Creators and Creative Masters',
          'Content Protection',
          'Data and Analytics',
          'Esports',
          'The Future of Delivery',
          'Game Development',
          'The In Vehicle Experience',
          'Live TV',
          'Podcasting',
          'Policy and Advocacy',
          'Post Production',
          'Production Technologies',
          'Social Media',
          'Streaming and OTT',
        ]
      },
      taxonomies: {
        type: 'array',
        default: []
      },
      formats: {
        type: 'string'
      },
      formatsList: {
        type: 'array',
        default: [
          'Format One',
          'Format Two',
        ]
      },
      formatTaxonomy: {
        type: 'array',
        default: []
      },
      locations: {
        type: 'string'
      },
      locationsList: {
        type: 'array',
        default: [
          'Location One',
          'Location Two',
          'Location Three',
          'Location Four',
        ]
      },
      locationsTaxonomy: {
        type: 'array',
        default: []
      },
      featured: {
        type: 'boolean'
      },
    },
    edit: props => {
      const { attributes, setAttributes, clientId } = props;
      const { name, description, imageAlt, imageUrl, department, topics, topicsList, taxonomies, formats, formatsList, formatTaxonomy, locations, locationsList, locationsTaxonomy, featured } = attributes;

      const getImageButton = openEvent => {
        if (attributes.imageUrl) {
          return (
            <img src={attributes.imageUrl} alr={imageAlt} className="main-img" />
          );
        } else {
          return (
            <div className="button-container">
              <Button onClick={openEvent} className="button button-large">
                <span className="dashicons dashicons-upload"></span> Upload Image
              </Button>
            </div>
          );
        }
      };

      return (
        <div
          className={`team-box ${featured ? 'featured' : ''}`}
          data-topics={taxonomies ? taxonomies : ''}
          data-formats={formatTaxonomy ? formatTaxonomy : ''}
          data-locations={locationsTaxonomy ? locationsTaxonomy : ''}
        >
          <InspectorControls>
            <PanelBody
              title={__('General Setting')}
              initialOpen={true}
              className="range-setting"
            >
              <PanelRow>
                <div className="meet-new-item">
                  <label>Featured</label>
                  <CheckboxControl
                    className="in-checkbox"
                    label="Featured"
                    checked={featured}
                    onChange={isChecked => {
                      if (isChecked) {
                        setAttributes({ featured: true });
                      } else {
                        setAttributes({ featured: false });
                      }

                      // let newObject;
                      // if (isChecked) {
                      //   newObject = Object.assign({}, member, {
                      //     international: true
                      //   });
                      // }
                      // else {
                      //   newObject = Object.assign({}, member, {
                      //     international: false
                      //   });
                      // }
                      // setAttributes({
                      //   committee: [
                      //     ...committee.filter(
                      //       item => item.index != member.index
                      //     ),
                      //     newObject
                      //   ]
                      // });
                    }}
                  />
                </div>
              </PanelRow>
              <PanelRow>
                <div className="meet-new-item">
                  <TextControl
                    type="string"
                    label="Add New Topics"
                    name={topics}
                    placeHolder="Add New"
                    onChange={value => setAttributes({ topics: value })}
                  />
                  <Button
                    onClick={value => {
                      if (undefined !== topics && '' !== topics) {
                        let newCat = [...topicsList];
                        newCat.push(topics);
                        setAttributes({ topicsList: newCat });
                      }
                    }}
                  >
                    <span className="dashicons dashicons-plus"></span>
                  </Button>
                </div>
              </PanelRow>
              <label>Select Topics</label>
              <PanelRow>
                <div className="category-list">
                  {topicsList.map((item, index) => (
                    <Fragment key={index}>
                      <CheckboxControl
                        checked={-1 < taxonomies.indexOf(item)}
                        label={item}
                        name="item[]"
                        value={item}
                        onChange={isChecked => {
                          let index,
                            tempTaxonomies = [...taxonomies];

                          if (isChecked) {
                            tempTaxonomies.push(item);
                          } else {
                            index = tempTaxonomies.indexOf(item);
                            tempTaxonomies.splice(index, 1);
                          }
                          setAttributes({ taxonomies: tempTaxonomies });
                        }}
                      />
                    </Fragment>
                  ))}
                </div>
              </PanelRow>
              <hr />
              <PanelRow>
                <div className="meet-new-item">
                  <TextControl
                    type="string"
                    label="Add New Formats"
                    name={formats}
                    placeHolder="Add New"
                    onChange={value => setAttributes({ formats: value })}
                  />
                  <Button
                    onClick={value => {
                      if (undefined !== formats && '' !== formats) {
                        let newCat = [...formatsList];
                        newCat.push(formats);
                        setAttributes({ formatsList: newCat });
                      }
                    }}
                  >
                    <span className="dashicons dashicons-plus"></span>
                  </Button>
                </div>
              </PanelRow>
              <label>Select Formats</label>
              <PanelRow>
                <div className="category-list">
                  {formatsList.map((item, index) => (
                    <Fragment key={index}>
                      <CheckboxControl
                        checked={-1 < formatTaxonomy.indexOf(item)}
                        label={item}
                        name="item[]"
                        value={item}
                        onChange={isChecked => {
                          let index,
                            tempTaxonomies = [...formatTaxonomy];

                          if (isChecked) {
                            tempTaxonomies.push(item);
                          } else {
                            index = tempTaxonomies.indexOf(item);
                            tempTaxonomies.splice(index, 1);
                          }
                          setAttributes({ formatTaxonomy: tempTaxonomies });
                        }}
                      />
                    </Fragment>
                  ))}
                </div>
              </PanelRow>
              <hr />
              <PanelRow>
                <div className="meet-new-item">
                  <TextControl
                    type="string"
                    label="Add New Locations"
                    name={locations}
                    placeHolder="Add New"
                    onChange={value => setAttributes({ locations: value })}
                  />
                  <Button
                    onClick={value => {
                      if (undefined !== locations && '' !== locations) {
                        let newCat = [...locationsList];
                        newCat.push(locations);
                        setAttributes({ locationsList: newCat });
                      }
                    }}
                  >
                    <span className="dashicons dashicons-plus"></span>
                  </Button>
                </div>
              </PanelRow>
              <label>Select Locations</label>
              <PanelRow>
                <div className="category-list">
                  {locationsList.map((item, index) => (
                    <Fragment key={index}>
                      <CheckboxControl
                        checked={-1 < locationsTaxonomy.indexOf(item)}
                        label={item}
                        name="item[]"
                        value={item}
                        onChange={isChecked => {
                          let index,
                            tempTaxonomies = [...locationsTaxonomy];

                          if (isChecked) {
                            tempTaxonomies.push(item);
                          } else {
                            index = tempTaxonomies.indexOf(item);
                            tempTaxonomies.splice(index, 1);
                          }
                          setAttributes({ locationsTaxonomy: tempTaxonomies });
                        }}
                      />
                    </Fragment>
                  ))}
                </div>
              </PanelRow>
            </PanelBody>
          </InspectorControls>
          <div className="team-box-inner">
            <span class="remove-button">
              <IconButton
                className="components-toolbar__control"
                label={__('Remove image')}
                icon="no"
                onClick={() => {
                  wp.data.dispatch('core/editor').removeBlocks(clientId);
                }}
              />
            </span>
            <div className="feature-img">
              <div className="remove-img">
                <span
                  onClick={value =>
                    setAttributes({ imageUrl: '', imageAlt: '' })
                  }
                  className="dashicons dashicons-trash"
                />
              </div>
              <MediaUpload
                onSelect={media => {
                  setAttributes({ imageAlt: media.alt, imageUrl: media.url });
                }}
                type="image"
                value={attributes.imageID}
                render={({ open }) => getImageButton(open)}
              />
            </div>
            <div className="team-details">
              <RichText
                tagName="h3"
                onChange={value => setAttributes({ name: value })}
                value={name}
                className="name"
                placeholder={__('Name')}
              />
              <RichText
                tagName="p"
                onChange={value => setAttributes({ description: value })}
                value={description}
                className="description"
                placeholder={__('description')}
              />
            </div>
          </div>
        </div>
      );
    },
    save: props => {
      const { name, description, imageAlt, imageUrl, taxonomies, formatTaxonomy, locationsTaxonomy, featured } = props.attributes;
      const topicsData = taxonomies.toString();
      const formatsData = formatTaxonomy.toString();
      const locationsData = locationsTaxonomy.toString();

      if (undefined !== name || undefined !== description) {
        return (
          <div
            className={`team-box ${featured ? 'featured' : ''}`}
            data-topics={topicsData ? topicsData : ''}
            data-formats={formatsData ? formatsData : ''}
            data-locations={locationsData ? locationsData : ''}
          >
            <div className="team-box-inner">
              <div className='feature-img'>
                {imageUrl ? (
                  <Fragment>
                    <img src={imageUrl} alt={imageAlt} className="main-img" />
                  </Fragment>
                ) : (
                    <div className="no-image">No Image</div>
                  )}
              </div>
              <div className="team-details">
                {name && (<RichText.Content tagName="h3" value={name} className="name" />)}
                {description && (<RichText.Content tagName="p" value={description} className="description" />)}
              </div>
            </div>
          </div>
        );
      }
    }
  });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);
