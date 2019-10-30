(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
  const { __ } = wpI18n;
  const { registerBlockType } = wpBlocks;
  const { Fragment, Component } = wpElement;
  const { RichText, MediaUpload } = wpEditor;
  const { Button, TextControl, CheckboxControl } = wpComponents;

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
      const { attributes, setAttributes, clientId, className } = this.props;
      const { committee } = attributes;

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
      );
    }
  }

  registerBlockType('nab/exhibitor-advisory-committee', {
    title: __('Exhibitor Advisory Committee'),
    description: __('Exhibitor Advisory Committee'),
    icon: 'groups',
    category: 'nabshow',
    keywords: [__('Exhibitor Advisory Committee'), __('gutenberg'), __('nab')],
    attributes: {
      committee: {
        type: 'array',
        default: [],
      }
    },
    edit: ItemComponent,

    save: props => {
      const {
        attributes,
        className
      } = props;
      const { committee } = attributes;

      return (
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
      );
    }
  });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);
