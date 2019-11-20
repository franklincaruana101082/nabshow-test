(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
  const { __ } = wpI18n;
  const { registerBlockType } = wpBlocks;
  const { Fragment, Component } = wpElement;
  const { RichText, MediaUpload, InspectorControls } = wpEditor;
  const { PanelBody, PanelRow, ToggleControl, Button, TextControl, CheckboxControl } = wpComponents;

  const exhibitorCommitteeBlockIcon = (
    <svg width="150px" height="150px" viewBox="0 0 150 150" enable-background="new 0 0 150 150">
      <g id="XMLID_1423_">
        <g id="XMLID_2880_">
          <g id="XMLID_924_">
            <path id="XMLID_1259_" fill="#146DB6" d="M131.791,118.023c1.472-2.111,2.338-4.676,2.338-7.44v-2.558
              c0-7.193-5.852-13.046-13.045-13.046s-13.047,5.853-13.047,13.046v2.558c0,2.765,0.866,5.329,2.339,7.44
              c-5.098,0.152-9.587,2.759-12.325,6.678c-2.739-3.919-7.229-6.525-12.326-6.678c1.473-2.111,2.339-4.676,2.339-7.44v-2.558
              c0-7.193-5.853-13.046-13.046-13.046s-13.046,5.853-13.046,13.046v2.558c0,2.765,0.867,5.329,2.339,7.44
              c-5.108,0.152-9.606,2.769-12.343,6.702c-2.737-3.934-7.235-6.55-12.344-6.702c1.472-2.111,2.338-4.676,2.338-7.44v-2.558
              c0-7.193-5.853-13.046-13.046-13.046s-13.045,5.853-13.045,13.046v2.558c0,2.765,0.866,5.329,2.338,7.44
              c-8.387,0.251-15.134,7.146-15.134,15.594V144.1c0,1.55,1.257,2.809,2.809,2.809h138.233c1.552,0,2.81-1.259,2.81-2.809v-10.482
              C146.926,125.169,140.178,118.274,131.791,118.023z M113.655,108.025c0-4.097,3.333-7.429,7.429-7.429s7.428,3.331,7.428,7.429
              v2.558c0,4.097-3.332,7.429-7.428,7.429s-7.429-3.332-7.429-7.429V108.025z M67.59,108.025c0-4.097,3.332-7.429,7.428-7.429
              s7.428,3.331,7.428,7.429v2.558c0,4.097-3.332,7.429-7.428,7.429s-7.428-3.332-7.428-7.429V108.025L67.59,108.025z
              M21.488,108.025c0-4.097,3.332-7.429,7.428-7.429c4.096,0,7.428,3.331,7.428,7.429v2.558c0,4.097-3.332,7.429-7.428,7.429
              c-4.095,0-7.428-3.332-7.428-7.429V108.025z M49.14,141.29H8.692v-7.674c0-5.507,4.479-9.987,9.987-9.987h20.474
              c5.507,0,9.987,4.48,9.987,9.987L49.14,141.29L49.14,141.29z M54.793,133.617c0-5.507,4.48-9.988,9.987-9.988h20.474
              c5.507,0,9.987,4.48,9.987,9.988v7.673H54.794L54.793,133.617L54.793,133.617z M141.308,141.29h-40.448v-7.674
              c0-5.507,4.48-9.987,9.987-9.987h20.474c5.507,0,9.987,4.48,9.987,9.987V141.29L141.308,141.29z"/>
            <path id="XMLID_1309_" fill="#146DB6" d="M55.601,78.59c-0.738,0-1.463,0.301-1.986,0.823c-0.522,0.521-0.823,1.244-0.823,1.985
              c0,0.739,0.3,1.463,0.823,1.986c0.523,0.521,1.248,0.822,1.986,0.822c0.739,0,1.464-0.3,1.986-0.822
              c0.522-0.526,0.823-1.247,0.823-1.986c0-0.738-0.301-1.464-0.823-1.985C57.064,78.891,56.339,78.59,55.601,78.59z"/>
            <path id="XMLID_1315_" fill="#146DB6" d="M21.051,84.206h23.314c1.551,0,2.809-1.258,2.809-2.809s-1.258-2.81-2.809-2.81H23.86
              V58.699c0-5.222,4.248-9.47,9.469-9.47h4.645v13.132c0,1.126,0.672,2.143,1.708,2.584c1.036,0.441,2.235,0.221,3.047-0.558
              l10.063-9.668v8.457c0,1.551,1.258,2.809,2.809,2.809c1.551,0,2.809-1.259,2.809-2.809v-8.457l10.062,9.668
              c0.534,0.512,1.235,0.783,1.947,0.783c0.371,0,0.745-0.074,1.101-0.225c1.036-0.441,1.708-1.458,1.708-2.584V49.229h4.645
              c5.222,0,9.47,4.248,9.47,9.47v19.889H66.836c-1.551,0-2.809,1.259-2.809,2.81s1.258,2.809,2.809,2.809H90.15
              c1.551,0,2.809-1.258,2.809-2.809V58.699c0-8.318-6.769-15.087-15.087-15.087h-9.221c3.07-3.231,4.96-7.594,4.96-12.392v-6.457
              v-2.988v-0.672c0-9.931-8.08-18.011-18.011-18.011S37.59,11.172,37.59,21.103v0.672v2.987v6.457c0,4.798,1.89,9.161,4.96,12.392
              H33.33c-8.319,0-15.087,6.769-15.087,15.087v22.699C18.243,82.949,19.5,84.206,21.051,84.206z M43.592,49.229h6.803l-6.803,6.538
              V49.229L43.592,49.229z M67.609,55.767l-6.804-6.537h6.804V55.767L67.609,55.767z M43.208,21.103
              c0-6.833,5.559-12.393,12.393-12.393c6.398,0,11.68,4.875,12.326,11.105l-5.871-3.449c-1.183-0.695-2.695-0.434-3.576,0.617
              c-2.647,3.158-6.528,4.97-10.648,4.97h-4.624v-0.179V21.103L43.208,21.103z M43.208,31.219v-3.648h4.624
              c4.979,0,9.708-1.882,13.3-5.232l6.863,4.032v4.849c0,6.833-5.56,12.392-12.393,12.392S43.208,38.052,43.208,31.219z"/>
            <path id="XMLID_1330_" fill="#146DB6" d="M93.751,48.792c0.457,0.29,0.98,0.438,1.506,0.438c0.406,0,0.813-0.087,1.194-0.266
              l9.521-4.471h34.891c3.324,0,6.027-2.704,6.027-6.028V9.12c0-3.324-2.703-6.027-6.027-6.027H98.475
              c-3.322,0-6.027,2.703-6.027,6.027V46.42C92.447,47.382,92.939,48.276,93.751,48.792z M98.065,9.12
              c0-0.226,0.185-0.41,0.409-0.41h42.388c0.227,0,0.409,0.184,0.409,0.41v29.345c0,0.226-0.183,0.41-0.409,0.41h-35.518
              c-0.413,0-0.82,0.09-1.194,0.266l-6.085,2.857V9.12z"/>
            <path id="XMLID_1331_" fill="#146DB6" d="M106.283,20.669h26.771c1.551,0,2.81-1.258,2.81-2.81c0-1.551-1.259-2.809-2.81-2.809
              h-26.771c-1.552,0-2.809,1.258-2.809,2.809C103.475,19.411,104.731,20.669,106.283,20.669z"/>
            <path id="XMLID_1332_" fill="#146DB6" d="M106.283,31.905h18.469c1.551,0,2.809-1.258,2.809-2.809s-1.258-2.809-2.809-2.809
              h-18.469c-1.552,0-2.809,1.258-2.809,2.809S104.731,31.905,106.283,31.905z"/>
          </g>
        </g>
      </g>
    </svg>
  );

  class ItemComponent extends Component {

    componentDiDMount() {
      const { committee } = this.props.attributes;
      if (0 === committee.length) {
        this.initList();
      }
    }

    initList() {
      const { committee } = this.props.attributes;
      const { setAttributes } = this.props;

      setAttributes({
        committee: [
          ...committee,
          {
            index: committee.length,
            name: '',
            company: '',
            areas: '',
            boothSize: '',
            address: '',
            phone: '',
            emailAdd: '',
            media: '',
            mediaAlt: '',
            international: false
          }
        ]
      });
    }

    render() {
      const { attributes, setAttributes } = this.props;
      const { committee, showFilter } = attributes;

      const getImageButton = (openEvent, index) => {
        if (committee[index].media) {
          return (
            <img src={committee[index].media} alt={committee[index].alt} className="img" />
          );
        } else {
          return (
            <Button onClick={openEvent} className="button button-large"><span className="dashicons dashicons-upload"></span> Upload Logo</Button>
          );
        }
      };

      const committeeMembers = committee.sort((a, b) => a.index - b.index).map((member, index) => {
        return (
          <div className={`box-item ${member.international ? 'International' : ''} `}>
            <div className='box-inner'>
              <div className="info-box">
                <span
                  className="remove"
                  onClick={() => {
                    const removeMember = committee.filter(item => item.index !== member.index).map(item => {
                      if (item.index > member.index) {
                        item.index -= 1;
                      }
                      return item;
                    });
                    setAttributes({
                      committee: removeMember
                    });
                  }}
                >
                  <span className="dashicons dashicons-no-alt"></span>
                </span>
                <RichText
                  tagName="h2"
                  placeholder={__('Member Name')}
                  value={member.name}
                  onChange={name => {
                    const newObject = Object.assign({}, member, {
                      name: name
                    });
                    setAttributes({
                      committee: [
                        ...committee.filter(
                          item => item.index != member.index
                        ),
                        newObject
                      ]
                    });
                  }}
                />
                <RichText
                  tagName="h4"
                  placeholder={__('Company')}
                  value={member.company}
                  onChange={company => {
                    const newObject = Object.assign({}, member, {
                      company: company
                    });
                    setAttributes({
                      committee: [
                        ...committee.filter(
                          item => item.index != member.index
                        ),
                        newObject
                      ]
                    });
                  }}
                />
                <RichText
                  tagName="p"
                  placeholder={__('Areas')}
                  value={member.areas}
                  onChange={areas => {
                    const newObject = Object.assign({}, member, {
                      areas: areas
                    });
                    setAttributes({
                      committee: [
                        ...committee.filter(
                          item => item.index != member.index
                        ),
                        newObject
                      ]
                    });
                  }}
                />
                <RichText
                  tagName="p"
                  placeholder={__('Booth Size')}
                  value={member.boothSize}
                  onChange={boothSize => {
                    const newObject = Object.assign({}, member, {
                      boothSize: boothSize
                    });
                    setAttributes({
                      committee: [
                        ...committee.filter(
                          item => item.index != member.index
                        ),
                        newObject
                      ]
                    });
                  }}
                />
                <RichText
                  tagName="p"
                  placeholder={__('Address')}
                  value={member.address}
                  onChange={address => {
                    const newObject = Object.assign({}, member, {
                      address: address
                    });
                    setAttributes({
                      committee: [
                        ...committee.filter(
                          item => item.index != member.index
                        ),
                        newObject
                      ]
                    });
                  }}
                />
                <RichText
                  tagName="p"
                  placeholder={__('Phone')}
                  value={member.phone}
                  onChange={phone => {
                    const newObject = Object.assign({}, member, {
                      phone: phone
                    });
                    setAttributes({
                      committee: [
                        ...committee.filter(
                          item => item.index != member.index
                        ),
                        newObject
                      ]
                    });
                  }}
                />
                <TextControl
                  type="text"
                  className="email"
                  value={member.email}
                  placeholder="Email Address"
                  onChange={email => {
                    const newObject = Object.assign({}, member, {
                      email: email
                    });
                    setAttributes({
                      committee: [
                        ...committee.filter(

                          item => item.index != member.index
                        ),
                        newObject
                      ]
                    });
                  }}
                />
                <CheckboxControl
                  className="in-checkbox"
                  label="International"
                  checked={member.international}
                  onChange={isChecked => {
                    let newObject;
                    if (isChecked) {
                      newObject = Object.assign({}, member, {
                        international: true
                      });
                    }
                    else {
                      newObject = Object.assign({}, member, {
                        international: false
                      });
                    }
                    setAttributes({
                      committee: [
                        ...committee.filter(
                          item => item.index != member.index
                        ),
                        newObject
                      ]
                    });
                  }}
                />
              </div>
              <div className="media-box">
                <div className="media-img">
                  <MediaUpload
                    onSelect={media => {
                      const newObject = Object.assign({}, member, {
                        media: media.url,
                        mediaAlt: media.alt
                      });
                      setAttributes({
                        committee: [
                          ...committee.filter(
                            item => item.index != member.index
                          ),
                          newObject
                        ]
                      });
                    }}
                    type="image"
                    value={attributes.imageID}
                    render={({ open }) => <span onClick={open} className="dashicons dashicons-edit"></span>}
                  />
                  <MediaUpload
                    onSelect={media => {
                      const newObject = Object.assign({}, member, {
                        media: media.url,
                        mediaAlt: media.alt
                      });
                      setAttributes({
                        committee: [
                          ...committee.filter(
                            item => item.index != member.index
                          ),
                          newObject
                        ]
                      });
                    }}
                    type="image"
                    value={attributes.imageID}
                    render={({ open }) => getImageButton(open, index)}
                  />
                </div>

              </div>
            </div>
          </div>
        );
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
            <PanelBody title={__('Help')} initialOpen={false}>
              <a href="https://nabshow-com.go-vip.net/2020/wp-content/uploads/sites/3/2019/11/exhibitor-advisory-committee.mp4" target="_blank">How to use block?</a>
            </PanelBody>
          </InspectorControls>
          {showFilter &&
            <div className="box-main-filter main-filter new-this-year-filter committee-filter">
              <div className="ov-filter">
                <div className="category"><label>Location</label>
                  <div className="box-main-select"><select id="box-main-category" className="select-opt">
                    <option>Select a Category</option>
                  </select></div>
                </div>
                <div className="category"><label>Booth Size</label>
                  <div className="box-main-select"><select id="box-main-category-booth" className="select-opt">
                    <option>Select a Category</option>
                  </select></div>
                </div>
                <div className="badgeslist"><a>International</a></div>
              </div>
              <div className="search-box"><label>Keyword</label>
                <div className="search-item icon-right"><input id="box-main-search" className="search" name="box-main-search" type="text" placeholder="Filter by keyword..." /></div>
              </div>
            </div>
          }
          <div className="exhibitor-committee">
            <div className="box-main two-grid">
              {committeeMembers}
              <div className="box-item additem">
                <button
                  className="components-button add"
                  onClick={content => {
                    setAttributes({
                      committee: [
                        ...committee,
                        {
                          index: committee.length,
                          name: '',
                          company: '',
                          areas: '',
                          boothSize: '',
                          address: '',
                          phone: '',
                          emailAdd: '',
                          media: '',
                          mediaAlt: '',
                          international: false
                        }
                      ]
                    });
                  }
                  }
                >
                  <span className="dashicons dashicons-plus"></span> Add New Item
                </button>
              </div>
            </div>
          </div>
        </Fragment>
      );
    }
  }

  registerBlockType('nab/exhibitor-advisory-committee', {
    title: __('Exhibitor Advisory Committee'),
    description: __('Exhibitor Advisory Committee'),
    icon: { src: exhibitorCommitteeBlockIcon},
    category: 'nabshow',
    keywords: [__('Exhibitor Advisory Committee'), __('gutenberg'), __('nab')],
    attributes: {
      committee: {
        type: 'array',
        default: [],
      },
      showFilter: {
        type: 'boolean',
        default: false
      }
    },
    edit: ItemComponent,

    save: props => {
      const { attributes } = props;
      const { committee, showFilter } = attributes;

      return (
        <Fragment>
          {showFilter &&
            <div className="box-main-filter main-filter new-this-year-filter committee-filter">
              <div className="ov-filter">
                <div className="category"><label>Location</label>
                  <div className="box-main-select"><select id="box-main-category" className="select-opt">
                    <option>Select a Category</option>
                  </select></div>
                </div>
                <div className="category"><label>Booth Size</label>
                  <div className="box-main-select"><select id="box-main-category-booth" className="select-opt">
                    <option>Select a Category</option>
                  </select></div>
                </div>
                <div className="badgeslist"><a>International</a></div>
              </div>
              <div className="search-box"><label>Keyword</label>
                <div className="search-item icon-right"><input id="box-main-search" className="search" name="box-main-search" type="text" placeholder="Filter by keyword..." /></div>
              </div>
            </div>
          }
          <div className="exhibitor-committee">
            <div className="box-main two-grid">
              {committee.map((member, index) => (
                <Fragment>
                  {
                    member.name && (
                      <div className={`box-item ${member.international ? 'International' : ''} `}>
                        <div className='box-inner'>
                          <div className="info-box">
                            {member.name && (
                              <RichText.Content
                                tagName="h2"
                                value={member.name}
                                className="title"
                              />
                            )}
                            {member.company && (
                              <RichText.Content
                                tagName="h4"
                                value={member.company}
                                className="company"
                              />
                            )}
                            {member.areas && (
                              <RichText.Content
                                tagName="p"
                                value={member.areas}
                                className="areas"
                              />
                            )}
                            {member.boothSize && (
                              <RichText.Content
                                tagName="p"
                                value={member.boothSize}
                                className="boothSize"
                              />
                            )}
                            {member.address && (
                              <RichText.Content
                                tagName="p"
                                value={member.address}
                                className="address"
                              />
                            )}
                            {member.phone && (
                              <RichText.Content
                                tagName="p"
                                value={member.phone}
                                className="phone"
                              />
                            )}
                            {member.email && (
                              <a className="email" href={`mailto:${member.email}`}>{member.email}</a>
                            )}
                          </div>
                          <div className="media-box">
                            <div className="media-img">
                              {member.media ? (
                                <img src={member.media} alt={member.alt} className="img" />
                              ) : (
                                  <div className="no-image">No Logo</div>
                                )}
                            </div>
                          </div>
                        </div>
                      </div>
                    )
                  }
                </Fragment>
              ))}
            </div>
          </div>
        </Fragment>
      );
    }
  });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);
