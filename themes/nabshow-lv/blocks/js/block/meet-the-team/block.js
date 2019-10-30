import times from 'lodash/times';
import memoize from 'memize';

(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
  const { __ } = wpI18n;
  const { registerBlockType } = wpBlocks;
  const { Fragment } = wpElement;
  const { RichText, InspectorControls, InnerBlocks, MediaUpload } = wpEditor;
  const { TextControl, PanelBody, PanelRow, Button, CheckboxControl, IconButton, ToggleControl } = wpComponents;

  const ALLOWBLOCKS = ['nab/meet-the-team-item'];

  const getChildscheduleBlock = memoize(schedule => {
    return times(schedule, n => ['nab/meet-the-team-item', { id: n + 1 }]);
  });

  const removehildawardsBlock = memoize((schedule) => {
    return times(schedule, (n) => ['nab/meet-the-team-item', { id: n - 1 }]);
  });

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
        attributes: { noOfschedule }, className, setAttributes, clientId } = props;

      $(document).on('click', `#block-${clientId} .team-box-inner .remove-button`, function (e) {
        if ('' !== $(this).parents(`#block-${clientId}`)) {
          setAttributes({ noOfschedule: noOfschedule - 1 });
          removehildawardsBlock(noOfschedule);
        }
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
          </div>
        </div>
      );
    },
    save: props => {
      const { className } = props;
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
      swapImage: {
        attribute: 'src'
      },
      swapAlt: {
        attribute: 'alt'
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
      },
      showPopup: {
        type: 'boolean',
        default: true
      },
      modelClass: {
        type: 'string'
      }
    },
    edit: props => {
      const { attributes, setAttributes, clientId } = props;
      const { name, title, email, phone, imageAlt, imageUrl, department, category, categoryList, taxonomies, swapImage, swapAlt, showPopup, modelClass } = attributes;

      const getImageButton = openEvent => {
        if (attributes.imageUrl) {
          return (
            <img src={attributes.imageUrl} alr={imageAlt} className="main-img" />
          );
        } else {
          return (
            <div className="button-container">
              <Button onClick={openEvent} className="button button-large">
                <span className="dashicons dashicons-upload"></span> Upload Headshot
              </Button>
            </div>
          );
        }
      };

      const getHoverImage = openEvent => {
        if (swapImage) {
          return (
            <div>
              <div className="remove-img">
                <span
                  onClick={value =>
                    setAttributes({ swapImage: '', swapAlt: '' })
                  }
                  className="dashicons dashicons-trash"
                />
              </div>
              <img src={swapImage} alr={swapAlt} className="hover-img" />
            </div>
          );
        } else {
          return (
            <div className="button-container">
              <Button onClick={openEvent} className="button button-large">
                <span className="dashicons dashicons-upload"></span> Upload Hover Image
              </Button>
            </div>
          );
        }
      };

      function modelopen() {
        var ele = document.getElementById('wpwrap');
        ele.classList.add('nab_body_model_open');
        setAttributes({ modelClass: 'nab_model_open' });
      }
      function modelclose() {
        var ele = document.getElementById('wpwrap');
        ele.classList.remove('nab_body_model_open');
        setAttributes({ modelClass: '' });
      }

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
                <ToggleControl
                  label={__('Show Popup')}
                  checked={showPopup}
                  onChange={() => setAttributes({ showPopup: ! showPopup })}
                />
              </PanelRow>
              <PanelRow>
                <TextControl
                  type="string"
                  label="Department"
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
                      if (undefined !== category && '' !== category) {
                        let newCat = [...categoryList];
                        newCat.push(category);
                        setAttributes({ categoryList: newCat });
                      }
                    }}
                  >
                    <span className="dashicons dashicons-plus"></span>
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
              <PanelRow>
                <div className="hover-upload">
                  <label className="mt20">Hover Image</label>
                  <MediaUpload
                    onSelect={media => {
                      setAttributes({ swapAlt: media.alt, swapImage: media.url });
                    }}
                    type="image"
                    value={attributes.imageID}
                    render={({ open }) => getHoverImage(open)}
                  />
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
              {showPopup ?
                <div className="nab_model_head">
                  <input type="button" onClick={modelopen} className={'nab_popup_btn btn-primary bio-btn'} value='Bio' />
                  <div className={`nab_model_main ${modelClass}`}>
                    <div className="nab_model_inner">
                      <div className="nab_close_btn" onClick={modelclose}><svg width="30" height="30" viewBox="0 0 30 30" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="20" y1="10" x2="10" y2="20"></line><line x1="10" y1="10" x2="20" y2="20"></line></svg></div>
                      <div className="nab_model_wrap">
                        <div className="nab_pop_up_content_wrap">
                          <InnerBlocks templateLock={false} />
                        </div>
                      </div>
                    </div>
                    <div className="nab_bg_overlay" onClick={modelclose} />
                  </div>
                </div> : ''
              }
            </div>
          </div>
        </div>
      );
    },
    save: props => {
      const { name, title, email, phone, imageAlt, imageUrl, department, taxonomies, swapImage, swapAlt, showPopup } = props.attributes;
      const catData = taxonomies.toString();

      if (undefined !== name || undefined !== title || undefined !== email || undefined !== phone) {
        return (
          <div
            className="team-box"
            data-department={department ? department : ''}
            data-category={catData ? catData : ''}
          >
            <div className="team-box-inner">
              <div className={`feature-img ${swapImage ? 'with-hover-img' : ''}`}>
                {imageUrl ? (
                  <Fragment>
                    <img src={imageUrl} alt={imageAlt} className="main-img" />
                    {
                      swapImage ? (
                        <img src={swapImage} alr={swapAlt} className="hover-img" />
                      ) : ''
                    }
                  </Fragment>
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
                {showPopup ?
                  <div className="nab_model_head">
                    <input type="button" className={'nab_popup_btn btn-primary bio-btn'} value='Bio' />
                    <div className="nab_model_main">
                      <div className="nab_model_inner">
                        <div className="nab_close_btn"><svg width="30" height="30" viewBox="0 0 30 30" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="20" y1="10" x2="10" y2="20"></line><line x1="10" y1="10" x2="20" y2="20"></line></svg></div>
                        <div className="nab_model_wrap">
                          <div className="nab_pop_up_content_wrap">
                            <InnerBlocks.Content />
                          </div>
                        </div>
                      </div>
                      <div className="nab_bg_overlay" />
                    </div>
                  </div> : ''
                }
              </div>
            </div>
          </div>
        );
      }
    }
  });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);
