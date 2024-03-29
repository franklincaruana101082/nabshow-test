import times from 'lodash/times';
import memoize from 'memize';

(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
  const { __ } = wpI18n;
  const { registerBlockType } = wpBlocks;
  const { Fragment } = wpElement;
  const { RichText, MediaUpload, InspectorControls, InnerBlocks } = wpEditor;
  const { Button, PanelBody, PanelRow, TextControl, CheckboxControl, IconButton, ToggleControl } = wpComponents;

  const ALLOWBLOCKS = ['nab/new-this-year-item'];

  const removehildawardsBlock = memoize((schedule) => {
    return times(schedule, (n) => ['nab/new-this-year-item', { id: n - 1 }]);
  });

  const newThisYearBlockIcon = (
    <svg width="150px" height="150px" viewBox="222.64 222.641 150 150" enable-background="new 222.64 222.641 150 150">
      <g>
        <g>
          <path fill="#0F6CB6" d="M362.627,291.161l-6.743-6.752l3.168-8.99c1.675-4.73-0.816-9.954-5.563-11.646l-5.337-1.892v-5.649
            c0-5.033-4.096-9.121-9.12-9.121h-9.546l-4.122-8.609c-2.092-4.399-7.75-6.422-12.167-4.304l-5.111,2.438l-3.992-3.983
            c-3.428-3.445-9.433-3.462-12.895-0.008l-6.751,6.743l-8.982-3.167c-4.617-1.666-10.014,0.928-11.655,5.554l-1.892,5.336h-5.649
            c-5.033,0-9.129,4.096-9.129,9.121v9.546l-8.617,4.122c-4.521,2.169-6.448,7.628-4.287,12.167l2.448,5.094l-4.001,4.001
            c-1.736,1.727-2.682,4.018-2.682,6.465c0,2.438,0.955,4.721,2.673,6.43l6.751,6.761l-3.185,9.008
            c-0.816,2.291-0.677,4.756,0.364,6.96c1.05,2.204,2.898,3.87,5.198,4.669l5.337,1.892v5.649c0,5.024,4.096,9.111,9.129,9.111
            h9.546l4.113,8.626c2.1,4.383,7.758,6.396,12.158,4.296l5.103-2.438l4,3.992c1.719,1.727,4.018,2.689,6.457,2.689
            s4.738-0.954,6.431-2.681l6.76-6.743l9.008,3.176c4.644,1.641,10.006-0.945,11.638-5.571l1.892-5.346h5.649
            c5.024,0,9.12-4.087,9.12-9.112v-9.546l8.617-4.122c4.521-2.16,6.457-7.628,4.287-12.175l-2.43-5.094l4.001-4.01
            C366.185,300.516,366.185,294.736,362.627,291.161z M351.97,316.796l-13.581,6.491v15.048h-11.915l-3.975,11.255l-14.197-5.007
            l-10.657,10.63l-8.435-8.426l-10.717,5.207l-6.518-13.651h-15.056v-11.906l-11.238-3.966l5.024-14.197l-10.648-10.657l8.435-8.426
            l-5.146-10.761l13.582-6.491v-15.056h11.923l3.966-11.229l14.206,5.007l10.622-10.648l8.435,8.427l10.727-5.198l6.517,13.642
            h15.057v11.924l11.229,3.966l-4.999,14.198l10.648,10.648l-8.436,8.435L351.97,316.796z"/>
          <path fill="#0F6CB6" d="M272.661,291.854c0,4.183,0.122,7.967,0.538,11.654h-0.13c-1.241-3.141-2.898-6.638-4.564-9.58
            l-5.806-10.249h-7.385v27.97h5.806v-8.427c0-4.564-0.078-8.504-0.243-12.201l0.122-0.035c1.362,3.28,3.193,6.89,4.86,9.884
            l5.971,10.778h6.647V283.68h-5.806L272.661,291.854L272.661,291.854z"/>
          <polygon fill="#0F6CB6" points="290.304,299.821 300.596,299.821 300.596,294.675 290.304,294.675 290.304,288.861 301.221,288.861 301.221,283.68 283.96,283.68 283.96,311.641 301.802,311.641 301.802,306.46 290.304,306.46 		"/>
          <path fill="#0F6CB6" d="M331.272,295.126c-0.581,3.315-1.206,6.595-1.622,9.71h-0.07c-0.425-3.106-0.876-6.092-1.51-9.381
            l-2.239-11.785h-6.717l-2.352,11.455c-0.712,3.445-1.371,6.803-1.831,9.833h-0.087c-0.46-2.829-1.041-6.422-1.657-9.746
            l-2.118-11.542h-6.76l6.647,27.969h6.925l2.665-12.036c0.659-2.82,1.119-5.468,1.613-8.626h0.096
            c0.33,3.194,0.781,5.806,1.319,8.626l2.36,12.036h6.848l7.22-27.969h-6.431L331.272,295.126z"/>
        </g>
      </g>
    </svg>
  );

  /* Parent Block */
  registerBlockType('nab/new-this-year', {
    title: __('New This Year'),
    description: __('New This Year'),
    icon: { src: newThisYearBlockIcon },
    category: 'nabshow',
    keywords: [__('New This Year'), __('gutenberg'), __('nab')],
    attributes: {
      products: {
        type: 'array',
        default: [],
      },
      showFilter: {
        type: 'boolean',
        default: false
      }
    },
    edit: (props) => {
      const { attributes: { noOfschedule, showFilter }, className, setAttributes, clientId } = props;

      jQuery(document).on('click', `#block-${clientId} .new-this-year-inner .remove-button`, function (e) {
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
            <div className="box-main-filter main-filter new-this-year-filter">
              <div className="category"><label>Category</label>
                <div className="box-main-select"><select id="box-main-category-newyr" className="select-opt">
                  <option>Select a Category</option>
                </select></div>
              </div>
              <div className="search-box"><label>Keyword</label>
                <div className="search-item icon-right"><input id="box-main-search" className="search" name="box-main-search" type="text" placeholder="Filter by keyword..." /></div>
              </div>
            </div>
          }
          <div className={`new-this-year new-this-year-block ${className ? className : ''}`}>
            <div className="newyr-box box-main">
              <InnerBlocks
                allowedBlocks={ALLOWBLOCKS}
              />
            </div>
          </div>
        </Fragment>
      );
    },

    save: props => {
      const { attributes, className } = props;
      const { showFilter } = attributes;

      return (
        <Fragment>
          {showFilter &&
            <div className="box-main-filter main-filter new-this-year-filter">
              <div className="category"><label>Category</label>
                <div className="box-main-select"><select id="box-main-category-newyr" className="select-opt">
                  <option>Select a Category</option>
                </select></div>
              </div>
              <div className="search-box"><label>Keyword</label>
                <div className="search-item icon-right"><input id="box-main-search" className="search" name="box-main-search" type="text" placeholder="Filter by keyword..." /></div>
              </div>
            </div>
          }
          <div className={`new-this-year new-this-year-block ${className ? className : ''}`}>
            <div className="newyr-box box-main">
              <InnerBlocks.Content />
            </div>
          </div>
        </Fragment>
      );
    }
  });


  /* schedule Block */
  registerBlockType('nab/new-this-year-item', {
    parent: ['nab/new-this-year'],
    title: __('New This Year'),
    description: __('New This Year'),
    icon: { src: newThisYearBlockIcon },
    category: 'nabshow',
    keywords: [__('New This Year'), __('gutenberg'), __('nab')],
    attributes: {
      title: {
        type: 'string'
      },
      description: {
        type: 'string'
      },
      imageUrl: {
        attribute: 'alt'
      },
      imageAlt: {
        attribute: 'src'
      },
      ButtonText: {
        type: 'string',
        default: 'Read More'
      },
      category: {
        type: 'string'
      },
      categoryList: {
        type: 'array',
        default: [
          'Show Floor',
          'Education',
          'Experiences',
          'For Attendees',
          'For Partners',
        ]
      },
      taxonomies: {
        type: 'array',
        default: []
      }

    },
    edit: (props) => {
      const { attributes, setAttributes, clientId } = props;
      const { title, description, imageUrl, imageAlt, taxonomies, category, categoryList, ButtonText } = attributes;

      const getImageButton = openEvent => {
        if (imageUrl) {
          return (
            <img src={imageUrl} alt={imageAlt} className="main-img" />
          );
        } else {
          return (
            <div className="button-container">
              <Button onClick={openEvent} className="button button-large">
                <span className="dashicons dashicons-upload"></span> Image
              </Button>
            </div>
          );
        }
      };

      return (
        <Fragment>
          <InspectorControls>
            <PanelBody
              title={__('General Setting')}
              initialOpen={true}
              className="range-setting"
            >
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
            </PanelBody>
          </InspectorControls>
          <div className="new-this-year-inner box-item" data-category={taxonomies ? taxonomies : ''}>
            <div className="box-inner">
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
              <div className="newyr-details">
                <RichText
                  tagName="h3"
                  onChange={value => setAttributes({ title: value })}
                  value={title}
                  className="title"
                  placeholder={__('Title')}
                />
                <RichText
                  tagName="p"
                  onChange={value => setAttributes({ description: value })}
                  value={description}
                  className="description"
                  placeholder={__('Description')}
                />
                <RichText
                  tagName="span"
                  onChange={ButtonText => setAttributes({ ButtonText: ButtonText })}
                  value={ButtonText}
                  rel='noopener noreferrer'
                  className="readMore"
                />
              </div>
            </div>
          </div>
        </Fragment>
      );
    },
    save: (props) => {
      const { title, description, imageUrl, imageAlt, taxonomies, ButtonText  } = props.attributes;
      const catData = taxonomies.toString();

      return (
        <div className="new-this-year-inner box-item" data-category={catData ? catData : ''}>
          <div className="box-inner">
            <div className={'feature-img'}>
              {imageUrl && <img src={imageUrl} alt={imageAlt} className="main-img" /> }
            </div>
            <div className="newyr-details">
              {title && <RichText.Content tagName="h3" value={title} className="title" /> }
              {description && <RichText.Content tagName="p" value={description} className="description" /> }
              {ButtonText && <RichText.Content tagName="span" value={ButtonText} className="readMore" /> }
            </div>
          </div>
        </div>

      );

    }
  });


})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);
