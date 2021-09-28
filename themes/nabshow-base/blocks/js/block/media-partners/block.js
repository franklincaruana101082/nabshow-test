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

  const mediaPartnerBlockIcon = (
    <svg width="150px" height="150px" viewBox="181 181 150 150" enable-background="new 181 181 150 150">
      <path fill="#0F6CB6" d="M291.403,259.32c-14.157,0-26.096,9.664-29.573,22.741l-13.983-9.089c2.139-4.176,3.348-8.904,3.348-13.908
        c0-4.501-0.978-8.778-2.731-12.63l17.217-9.343c5.453,8.445,14.945,14.046,25.724,14.046c16.871,0,30.597-13.725,30.597-30.597
        c0-16.871-13.726-30.597-30.597-30.597s-30.598,13.725-30.598,30.597c0,3.321,0.535,6.521,1.518,9.518l-17.968,9.75
        c-5.614-6.914-14.179-11.34-23.758-11.34c-16.872,0-30.597,13.725-30.597,30.597c0,16.871,13.726,30.596,30.597,30.596
        c9.075,0,17.238-3.973,22.847-10.269l17.372,11.292c0.409,16.519,13.973,29.831,30.588,29.831c16.871,0,30.597-13.727,30.597-30.598
        S308.274,259.32,291.403,259.32z M276.739,228.831c0-5.333,2.861-10.009,7.13-12.575c-0.98-1.45-1.553-3.198-1.553-5.076
        c0-5.01,4.076-9.087,9.087-9.087c5.01,0,9.087,4.077,9.087,9.087c0,1.878-0.573,3.625-1.554,5.076
        c4.269,2.566,7.131,7.242,7.131,12.575v2.707c0,2.149-1.742,3.892-3.892,3.892H280.63c-2.148,0-3.891-1.743-3.891-3.892V228.831z
        M205.688,270.347v-2.769c0-5.493,2.989-10.299,7.423-12.885c-0.919-1.405-1.456-3.082-1.456-4.883c0-4.931,4.011-8.943,8.943-8.943
        c4.931,0,8.943,4.012,8.943,8.943c0,1.802-0.538,3.479-1.458,4.883c4.436,2.586,7.423,7.392,7.423,12.885v2.769
        c0,2.149-1.742,3.892-3.891,3.892h-22.036C207.43,274.238,205.688,272.496,205.688,270.347z M276.739,300.915v-2.707
        c0-5.283,2.809-9.921,7.01-12.503c-0.905-1.413-1.433-3.09-1.433-4.889c0-5.01,4.076-9.087,9.087-9.087
        c5.01,0,9.087,4.077,9.087,9.087c0,1.799-0.528,3.476-1.434,4.889c4.201,2.582,7.011,7.22,7.011,12.503v2.707
        c0,2.149-1.742,3.892-3.892,3.892H280.63C278.481,304.807,276.739,303.064,276.739,300.915z"/>
    </svg>
  );

  /* Parent schedule Block */
  registerBlockType('nab/media-partners', {
    title: __('Media Partner'),
    description: __('Media Partner'),
    icon: { src: mediaPartnerBlockIcon },
    category: 'nabshow',
    keywords: [__('Media Partner'), __('gutenberg'), __('nab')],
    attributes: {
      blockId: {
        type: 'string'
      },
      noOfschedule: {
        type: 'number',
        default: 1
      },
      showFilter: {
        type: 'boolean',
        default: false
      }
    },
    edit: (props) => {
      const { attributes: { noOfschedule, showFilter }, className, setAttributes, clientId } = props;

      jQuery(document).on('click', `#block-${clientId} .team-box-inner .remove-button`, function (e) {
        if ('' !== jQuery(this).parents(`#block-${clientId}`)) {
          setAttributes({ noOfschedule: noOfschedule - 1 });
          removehildawardsBlock(noOfschedule);
        }
      });

      return (
        <Fragment>
          <InspectorControls>
            <PanelBody title="General Settings">
              <PanelRow>
                <ToggleControl
                  label={__('Show Filter')}
                  checked={showFilter}
                  onChange={() => setAttributes({ showFilter: ! showFilter })}
                />
              </PanelRow>
            </PanelBody>
          </InspectorControls>
          {showFilter &&
            <div className="box-main-filter main-filter media-partner-filter">
              <div className="featuredbtn"><input className="featured-btn" type="button" value="Featured" /></div>
              <div className="category"><label>Topic</label>
                <div className="box-main-select"><select id="topic-type" className="select-opt">
                  <option>Select a Topic</option>
                </select></div>
              </div>
              <div className="category"><label>Format</label>
                <div className="box-main-select"><select id="format-type" className="select-opt">
                  <option>Select a Format</option>
                </select></div>
              </div>
              <div className="category"><label>Location</label>
                <div className="box-main-select"><select id="location-type" className="select-opt">
                  <option>Select a Location</option>
                </select></div>
              </div>
            </div>
          }
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
        </Fragment>
      );
    },
    save: props => {
      const { className, attributes: { showFilter } } = props;
      return (
        <Fragment>
          {showFilter &&
            <div className="box-main-filter main-filter media-partner-filter">
              <div className="featuredbtn"><input className="featured-btn" type="button" value="Featured" /></div>
              <div className="category"><label>Topic</label>
                <div className="box-main-select"><select id="topic-type" className="select-opt">
                  <option>Select a Topic</option>
                </select></div>
              </div>
              <div className="category"><label>Format</label>
                <div className="box-main-select"><select id="format-type" className="select-opt">
                  <option>Select a Format</option>
                </select></div>
              </div>
              <div className="category"><label>Location</label>
                <div className="box-main-select"><select id="location-type" className="select-opt">
                  <option>Select a Location</option>
                </select></div>
              </div>
            </div>
          }
          <div className={`team-main media-partners ${className ? className : ''}`}>
            <InnerBlocks.Content />
          </div>
        </Fragment>
      );
    }
  });

  /* schedule Block */
  registerBlockType('nab/media-partner-item', {
    title: __('Media Partner Items'),
    description: __('Media Partner Items'),
    icon: { src: mediaPartnerBlockIcon },
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
      const { name, description, imageAlt, topics, topicsList, taxonomies, formats, formatsList, formatTaxonomy, locations, locationsList, locationsTaxonomy, featured } = attributes;

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
            <span className="remove-button">
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
