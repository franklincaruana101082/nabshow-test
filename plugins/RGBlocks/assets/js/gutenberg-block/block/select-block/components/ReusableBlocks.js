import React, { Component } from 'react';
import { fetchReusableBlock } from '../../select-block/functions';
import { LoadMoreSmall } from '../../icons';

class ReusableBlocksList extends Component {
  constructor(props) {
    super(props);
    this.state = {
      onImport: false
    };
  }

  render() {
    const { blocks } = this.props;
    const { onImport } = this.state;
    const { BlockEdit } = wp.editor;
    return (
      <React.Fragment>
        {blocks.map((block, i) => {
          return (
            <li className={onImport ? 'import-ongoing' : ''} key={i}>
              <div className="block-grid-inner">
                <div className="Feature-Block">
                  <div className="feature-link">
                    <div
                      className="normal-block"
                      onClick={() => {
                        fetchReusableBlock(block, this.props.data, 'normal');
                        this.setState({ onImport: true });
                      }}
                    >
                      <strong>
                        <em>Use as a</em>Normal Block
                      </strong>
                    </div>
                    <div
                      className="reusable-block"
                      onClick={() => {
                        fetchReusableBlock(block, this.props.data, 'reusable');
                        this.setState({ onImport: true });
                      }}
                    >
                      <strong>
                        <em>Use as a</em>Reusable Block
                      </strong>
                    </div>
                  </div>
                  {block.custom_fields.preview_image ? (
                    <img
                      className="block-image"
                      alt="rgblock-logo"
                      src={
                        block.custom_fields.preview_image ?
                          block.custom_fields.preview_image :
                          undefined
                      }
                    />
                  ) : (
                    <span
                      data-title={block.title.raw}
                      className="No-image-found"
                    />
                  )}
                </div>
                <div className="title-info">{block.title.raw}</div>
              </div>
            </li>
          );
        })}
      </React.Fragment>
    );
  }
}

export default ReusableBlocksList;
