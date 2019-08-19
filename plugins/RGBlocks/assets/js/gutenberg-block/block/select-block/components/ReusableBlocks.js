import React, { Component } from 'react';
import { fetchReusableBlock } from '../../select-block/functions';
import { LoadMoreSmall } from '../../icons';

class ReusableBlocksList extends Component {
  constructor(props) {
    super(props);
    this.state = {
      NoOfPost: 12,
      onImport: false
    };
  }

  render() {
    const { blocks, loadMore } = this.props;
    const { NoOfPost, onImport } = this.state;
    const { BlockEdit } = wp.editor;

    return (
      <React.Fragment>
        {blocks.map((block, i) => {
          return (
            <li className={onImport ? 'import-ongoing' : ''} key={i}>
              <div className="block-grid-inner">
                <div className="Feature-Block">
                  <div className="feature-link">
                    <div className="show-and-insert">
                      <a
                          onClick={() => {
                            fetchReusableBlock(block, this.props.data);

                            this.setState({ onImport: true });
                          }}
                      >
                        <i className="fas fa-plus" />
                      </a>
                    </div>
                  </div>
                  {block.custom_fields.preview_image ? (
                      <img
                          className="block-image"
                          src={block.custom_fields.preview_image ? block.custom_fields.preview_image : undefined}
                      />
                  ) : (
                      <span
                          data-title={block.blocktitle}
                          className="No-image-found"
                      />
                  )}
                  {block.custom_fields.block_icon ? (
                      <span className="blockIcon">
                        <img
                            src={block.custom_fields.block_icon ? block.custom_fields.block_icon : undefined }
                        />
                      </span>
                  ) : (
                      <span className="No-icon-found">
                        No Block Icon found
                      </span>
                  )}
                </div>
                <div className="title-info">
                  <a
                      onClick={() => {
                        fetchReusableBlock(block, this.props.data);
                      }}
                      className="title"
                  >
                    {block.title.raw}
                  </a>
                </div>
              </div>
            </li>
          );
        })}
      </React.Fragment>
    );
  }
}

export default ReusableBlocksList;
