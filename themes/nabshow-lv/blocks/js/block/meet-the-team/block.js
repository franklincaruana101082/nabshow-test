import times from 'lodash/times';
import memoize from 'memize';

(function(wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
  const { __ } = wp.i18n;
  const { registerBlockType } = wp.blocks;
  const { Fragment, Component } = wp.element;
  const {
    RichText,
    AlignmentToolbar,
    BlockControls,
    InspectorControls,
    PanelColorSettings,
    InnerBlocks,
    MediaUpload
  } = wp.editor;
  const {
    TextControl,
    PanelBody,
    PanelRow,
    RangeControl,
    SelectControl,
    ToggleControl,
    Button,
    CheckboxControl
  } = wp.components;

  /* Parent schedule Block */
  registerBlockType('nab/meet-the-team', {
    title: __('Meet The Team'),
    description: __('Meet The Team'),
    icon: 'businessman',
    category: 'nabshow',
    keywords: [__('schedule'), __('gutenberg'), __('nab')],
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
        attributes: { noOfschedule },
        className,
        setAttributes,
        clientId
      } = props;

      const ALLOWBLOCKS = ['nab/meet-the-team-item'];

      const getChildscheduleBlock = memoize(schedule => {
        return times(schedule, n => ['nab/meet-the-team-item', { id: n + 1 }]);
      });

      return (
        <div className={`team-main ${className ? className : ''}`}>
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
            <Button
              className="remove"
              onClick={() =>
                setAttributes({
                  noOfschedule: 1 === noOfschedule ? 1 : noOfschedule - 1
                })
              }
            >
              <span className="dashicons dashicons-minus" />
            </Button>
          </div>
        </div>
      );
    },
    save: props => {
      const {
        attributes: { title, showTitle },
        className
      } = props;
      return (
        <div className={`team-main ${className ? className : ''}`}>
          <InnerBlocks.Content />
        </div>
      );
    }
  });

  /* schedule Block */
  registerBlockType('nab/meet-the-team-item', {
    title: __('Meet The Team Items'),
    description: __('Meet The Team Items'),
    icon: 'businessman',
    category: 'nabshow',
    parent: ['nab/schedule'],
    attributes: {
      name: {
        type: 'string'
      },
      title: {
        type: 'string'
      },
      email: {
        type: 'string'
      },
      phone: {
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
      category: {
        type: 'string'
      },
      autoplay: {
        type: 'boolean',
        default: false
      },
      categoryList: {
        type: 'array',
        default: [
          'Avid Readers',
          'Animal Lovers',
          'Coffee Addicts',
          'Podcast Streamers',
          'Film Geeks',
          'Sports Junkles',
          'Foodies',
          'World Travelers',
          'Gamers'
        ]
      },
      taxonomies: {
        type: 'array',
        default: []
      }
    },
    edit: props => {
      const { attributes, setAttributes } = props;
      const {
        name,
        title,
        email,
        phone,
        imageAlt,
        imageUrl,
        department,
        category,
        categoryList,
        taxonomies
      } = attributes;

      const getImageButton = openEvent => {
        if (attributes.imageUrl) {
          return (
            <img src={attributes.imageUrl} alr={imageAlt} className="image" />
          );
        } else {
          return (
            <div className="button-container">
              <Button onClick={openEvent} className="button button-large">
                <span class="dashicons dashicons-upload"></span> Upload Headshot
              </Button>
            </div>
          );
        }
      };

      return (
        <div
          className="team-box"
          data-department={department ? department : ''}
          data-category={taxonomies ? taxonomies : ''}
        >
          <InspectorControls>
            <PanelBody
              title={__('General Setting')}
              initialOpen={true}
              className="range-setting"
            >
              <PanelRow>
                <TextControl
                  type="string"
                  label="Add Department"
                  name={department}
                  value={department}
                  placeHolder="Department"
                  onChange={value => setAttributes({ department: value })}
                />
              </PanelRow>
              <PanelRow>
                <div className="meet-new-item">
                  <TextControl
                    type="string"
                    label="Add New Category"
                    name={category}
                    placeHolder="Add New"
                    onChange={value => setAttributes({ category: value })}
                  />
                  <Button
                    onClick={value => {
                      let newCat = [...categoryList];
                      newCat.push(category);
                      setAttributes({ categoryList: newCat });
                    }}
                  >
                    <span class="dashicons dashicons-plus"></span>
                  </Button>
                </div>
              </PanelRow>
              <label>Select Category</label>
              <PanelRow>
                <div className="category-list">
                  {categoryList.map((item, index) => (
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
            </PanelBody>
          </InspectorControls>
          <div className="team-box-inner">
            <div className="feature-img">
              <div className="remove-img">
                <span
                  onClick={value =>
                    setAttributes({ imageUrl: '', imageAlt: '', InsertUrl: '' })
                  }
                  className="dashicons dashicons-edit"
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
                tagName="strong"
                onChange={value => setAttributes({ title: value })}
                value={title}
                className="title"
                placeholder={__('Title')}
              />
              <TextControl
                type="text"
                className="email"
                value={email}
                placeholder="Email"
                onChange={value => setAttributes({ email: value })}
              />
              <RichText
                tagName="p"
                onChange={value => setAttributes({ phone: value })}
                value={phone}
                className="phone"
                placeholder={__('Phone')}
              />
            </div>
          </div>
        </div>
      );
    },
    save: props => {
      const {
        name,
        title,
        email,
        phone,
        imageAlt,
        imageUrl,
        department,
        taxonomies
      } = props.attributes;
      const catData = taxonomies.toString();
      return (
        <div
          className="team-box"
          data-department={department ? department : ''}
          data-category={catData ? catData : ''}
        >
          <div className="team-box-inner">
            <div className="feature-img">
              {imageUrl ? (
                <img src={imageUrl} alt={imageAlt} />
              ) : (
                <div className="no-image">No Headshot</div>
              )}
            </div>
            <div className="team-details">
              {name ? (
                <RichText.Content tagName="h3" value={name} className="name" />
              ) : (
                ''
              )}
              {title ? (
                <RichText.Content
                  tagName="strong"
                  value={title}
                  className="title"
                />
              ) : (
                ''
              )}
              {email ? (
                <a className="email" href={`mailto:${email}`}>
                  Email
                </a>
              ) : (
                ''
              )}
              {phone ? (
                <RichText.Content tagName="p" value={phone} className="phone" />
              ) : (
                ''
              )}
            </div>
          </div>
        </div>
      );
    }
  });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);
