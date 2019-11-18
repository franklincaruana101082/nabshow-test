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

  const meetTeamBlockIcon = (
    <svg width="150px" height="150px" viewBox="0 0 150 150" enable-background="new 0 0 150 150">
      <g>
        <g>
          <path fill="#0F6CB6" d="M132.34,69.51c-5.104-2.552-14.674-2.582-15.078-2.582c-1.215,0-2.197,0.984-2.197,2.197
            c0,1.214,0.982,2.197,2.197,2.197c2.469,0,9.639,0.381,13.113,2.118c0.314,0.158,0.65,0.232,0.98,0.232
            c0.807,0,1.582-0.445,1.967-1.215C133.865,71.373,133.426,70.053,132.34,69.51z"/>
        </g>
      </g>
      <g>
        <g>
          <path fill="#0F6CB6" d="M143.295,100.793l-9.075-2.592c-0.392-0.113-0.665-0.475-0.665-0.883v-3.029
            c0.738-0.512,1.442-1.084,2.101-1.723c3.19-3.096,4.947-7.249,4.947-11.693v-4.18l0.878-1.755
            c0.963-1.926,1.472-4.083,1.472-6.236V57.379c0-1.213-0.983-2.197-2.197-2.197H119.61c-7.688,0-13.944,6.255-13.944,13.944v0.131
            c0,1.791,0.424,3.583,1.225,5.185l1.125,2.25v3.589c0,5.688,2.803,10.791,7.049,13.861v3.176c0,0.488,0,0.691-1.814,1.211
            l-4.428,1.264l-12.809-4.656c0.045-0.605-0.158-1.22-0.6-1.684l-4.093-4.299v-7.219c0.433-0.357,0.859-0.724,1.272-1.111
            c5.164-4.84,8.125-11.672,8.125-18.747v-5.765c1.559-3.393,2.35-6.983,2.35-10.681V22.139c0-1.214-0.984-2.197-2.197-2.197H67.979
            c-11.575,0-20.992,9.417-20.992,20.992v4.699c0,3.697,0.791,7.288,2.35,10.681v4.96c0,8.213,3.652,15.613,9.397,20.492v7.389
            l-4.093,4.3c-0.441,0.464-0.645,1.077-0.599,1.683l-13.519,4.916c-0.979,0.355-1.89,0.838-2.716,1.422l-2.123-1.061
            c6.319-2.751,8.321-6.619,8.417-6.812c0.309-0.618,0.309-1.347,0-1.966c-1.584-3.168-1.776-8.975-1.93-13.641
            c-0.051-1.553-0.1-3.021-0.193-4.327c-0.749-10.54-8.761-18.487-18.637-18.487S5.453,63.129,4.704,73.669
            c-0.093,1.307-0.142,2.774-0.193,4.327c-0.154,4.666-0.346,10.473-1.93,13.641c-0.31,0.619-0.31,1.347,0,1.965
            c0.096,0.193,2.094,4.053,8.426,6.807l-5.897,2.949c-3.152,1.577-5.11,4.746-5.11,8.27v16.232c0,1.215,0.984,2.197,2.197,2.197
            s2.197-0.982,2.197-2.197v-16.232c0-1.85,1.027-3.512,2.681-4.339l7.343-3.671l2.554,2.427c1.786,1.697,4.077,2.546,6.369,2.546
            c2.292,0,4.583-0.85,6.369-2.546l2.554-2.427l2.394,1.197c-1.127,1.804-1.767,3.919-1.767,6.135v16.912
            c0,1.213,0.984,2.197,2.197,2.197s2.197-0.984,2.197-2.197v-16.912c0-3.017,1.904-5.736,4.74-6.768L56.279,99l5.934,8.9
            c0.758,1.138,1.974,1.867,3.334,2.002c0.152,0.016,0.303,0.022,0.454,0.022c1.2,0,2.35-0.473,3.21-1.332l3.62-3.62v22.889
            c0,1.213,0.984,2.197,2.197,2.197c1.214,0,2.197-0.984,2.197-2.197v-22.889l3.62,3.62c0.859,0.86,2.009,1.333,3.21,1.333
            c0.15,0,0.302-0.008,0.453-0.023c1.361-0.135,2.576-0.864,3.335-2.002l5.935-8.9l14.252,5.184c2.836,1.03,4.74,3.75,4.74,6.766
            v16.912c0,1.213,0.984,2.197,2.197,2.197s2.197-0.984,2.197-2.197v-16.912c0-3.055-1.214-5.92-3.25-8.039l0.543-0.154
            c0.547-0.157,1.295-0.371,2.045-0.738l5.609,5.609v20.234c0,1.213,0.984,2.197,2.197,2.197c1.214,0,2.197-0.984,2.197-2.197
            v-20.234l5.571-5.57c0.296,0.15,0.607,0.277,0.935,0.371l9.076,2.592c2.07,0.592,3.518,2.51,3.518,4.664v18.178
            c0,1.213,0.984,2.197,2.197,2.197s2.197-0.984,2.197-2.197v-18.178C150,105.578,147.242,101.922,143.295,100.793z M14.096,96.912
            c-4.11-1.479-6.172-3.45-7.052-4.527c0.6-1.568,0.989-3.365,1.252-5.262c1.212,2.906,3.241,5.387,5.799,7.156V96.912z
            M26.684,102.859c-1.874,1.78-4.81,1.779-6.684,0l-2.043-1.942c0.345-0.646,0.535-1.378,0.535-2.146V96.43
            c1.533,0.479,3.162,0.736,4.851,0.736c1.687,0,3.315-0.259,4.851-0.735l0,2.341c0,0.768,0.189,1.5,0.534,2.146L26.684,102.859z
            M23.343,92.771c-6.562,0-11.899-5.338-11.899-11.898c0-1.213-0.984-2.197-2.197-2.197c-0.123,0-0.243,0.013-0.361,0.032
            c0.006-0.188,0.013-0.378,0.019-0.565c0.049-1.511,0.096-2.938,0.183-4.162c0.281-3.948,1.858-7.586,4.442-10.245
            c2.607-2.683,6.092-4.16,9.812-4.16c3.72,0,7.205,1.477,9.812,4.16c2.584,2.658,4.162,6.296,4.442,10.245
            c0.086,1.224,0.134,2.65,0.184,4.161c0.004,0.13,0.009,0.262,0.013,0.392c-2.391-3.683-6.083-6.397-10.853-7.93
            c-4.407-1.416-8.198-1.329-8.358-1.324c-0.575,0.016-1.121,0.257-1.521,0.671l-3.964,4.112c-0.842,0.874-0.817,2.264,0.056,3.107
            c0.874,0.843,2.265,0.817,3.107-0.057l3.299-3.421c2.841,0.139,11.981,1.202,15.536,9.029
            C34.201,88.488,29.243,92.771,23.343,92.771z M32.586,96.92l0-2.621c2.556-1.76,4.588-4.235,5.801-7.162
            c0.263,1.892,0.652,3.684,1.251,5.249C38.764,93.452,36.692,95.441,32.586,96.92z M53.731,61.273v-5.452
            c0-0.331-0.075-0.657-0.219-0.955c-1.414-2.928-2.131-6.035-2.131-9.234v-4.699c0-9.152,7.446-16.598,16.598-16.598h30.694v21.296
            c0,3.199-0.717,6.306-2.131,9.234c-0.145,0.298-0.219,0.625-0.219,0.956v6.256c0,5.95-2.393,11.47-6.735,15.541
            c-0.542,0.508-1.105,0.984-1.687,1.428c-0.014,0.01-0.025,0.02-0.039,0.027c-4.068,3.09-9.053,4.592-14.257,4.254
            C62.461,82.607,53.731,72.919,53.731,61.273z M66.103,105.485c-0.015,0.015-0.051,0.052-0.123,0.044
            c-0.071-0.008-0.1-0.049-0.111-0.067l-6.833-10.251l2.199-2.311l10.367,7.086L66.103,105.485z M75.028,97.006l-11.899-8.133
            v-4.102c3.079,1.664,6.526,2.705,10.193,2.941c0.579,0.038,1.155,0.057,1.729,0.057c4.202,0,8.245-1.004,11.876-2.91v4.014
            L75.028,97.006z M84.187,105.463c-0.012,0.018-0.04,0.06-0.111,0.066c-0.071,0.01-0.106-0.029-0.122-0.043l-5.498-5.498
            l10.366-7.087l2.199,2.311L84.187,105.463z M124.309,103.608l-4.986-4.985c0.088-0.396,0.137-0.828,0.137-1.306v-0.927
            c1.383,0.453,2.842,0.723,4.351,0.768c0.169,0.006,0.337,0.008,0.506,0.008c1.667,0,3.296-0.252,4.845-0.732v0.885
            c0,0.438,0.055,0.867,0.158,1.281L124.309,103.608z M132.596,89.413c-2.33,2.26-5.406,3.453-8.654,3.353
            c-6.358-0.189-11.531-5.791-11.531-12.484v-4.107c0-0.341-0.08-0.677-0.232-0.982l-1.357-2.714c-0.496-0.995-0.76-2.108-0.76-3.22
            v-0.131c0-5.266,4.284-9.55,9.55-9.55h18.947v9.126c0,1.475-0.349,2.952-1.009,4.271l-1.108,2.218
            c-0.153,0.306-0.232,0.642-0.232,0.982v4.699C136.208,84.119,134.925,87.152,132.596,89.413z"/>
        </g>
      </g>
      <g>
        <g>
          <path fill="#0F6CB6" d="M138.405,111.566c-1.214,0-2.197,0.984-2.197,2.197v14.096c0,1.215,0.983,2.197,2.197,2.197
            s2.197-0.982,2.197-2.197v-14.096C140.603,112.551,139.619,111.566,138.405,111.566z"/>
        </g>
      </g>
      <g>
        <g>
          <path fill="#0F6CB6" d="M11.595,114.471c-1.213,0-2.197,0.984-2.197,2.197v11.191c0,1.215,0.984,2.197,2.197,2.197
            s2.197-0.982,2.197-2.197v-11.191C13.792,115.455,12.808,114.471,11.595,114.471z"/>
        </g>
      </g>
      <g>
        <g>
          <path fill="#0F6CB6" d="M93.027,46.428c-8.311-8.311-25.698-6.722-32.789-5.653c-2.233,0.336-3.854,2.227-3.854,4.494v5.062
            c0,1.213,0.984,2.197,2.197,2.197s2.197-0.984,2.197-2.197v-5.062c0-0.075,0.049-0.139,0.115-0.148
            c2.832-0.427,8.452-1.085,14.275-0.697c6.853,0.456,11.815,2.176,14.751,5.112c0.857,0.858,2.249,0.858,3.107,0
            C93.885,48.677,93.885,47.286,93.027,46.428z"/>
        </g>
      </g>
      <g>
        <g>
          <path fill="#0F6CB6" d="M49.185,116.266c-1.213,0-2.197,0.984-2.197,2.197v9.397c0,1.214,0.984,2.197,2.197,2.197
            c1.214,0,2.197-0.983,2.197-2.197v-9.397C51.382,117.25,50.398,116.266,49.185,116.266z"/>
        </g>
      </g>
      <g>
        <g>
          <path fill="#0F6CB6" d="M100.871,116.266c-1.214,0-2.197,0.984-2.197,2.197v9.397c0,1.214,0.983,2.197,2.197,2.197
            c1.213,0,2.197-0.983,2.197-2.197v-9.397C103.068,117.25,102.084,116.266,100.871,116.266z"/>
        </g>
      </g>
    </svg>
  );

  /* Parent schedule Block */
  registerBlockType('nab/meet-the-team', {
    title: __('Meet The Team'),
    description: __('Meet The Team'),
    icon: { src: meetTeamBlockIcon },
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
    icon: { src: meetTeamBlockIcon },
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
            <img src={attributes.imageUrl} alt={imageAlt} className="main-img" />
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
              <img src={swapImage} alt={swapAlt} className="hover-img" />
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
            <PanelBody title={__('Help')} initialOpen={false}>
              <a href="https://nabshow-com.go-vip.net/2020/wp-content/uploads/sites/3/2019/11/meet-the-team.mp4" target="_blank">How to use block?</a>
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
                        <img src={swapImage} alt={swapAlt} className="hover-img" />
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
