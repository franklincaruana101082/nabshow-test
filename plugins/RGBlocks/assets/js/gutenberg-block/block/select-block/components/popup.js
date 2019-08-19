import React from 'react';
import ReactDOM from 'react-dom';
import Modal from 'react-awesome-modal';
import ListingData from './ListingData';
import { SelectBlock } from '../../icons';

class Popup extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      visible: false
    };
  }

  openModal() {
    this.setState({
      visible: true
    });
    document.body.classList.add('select-modal-open');
  }

  closeModal() {
    this.setState({
      visible: false
    });
    document.body.classList.remove('select-modal-open');
  }

  render() {

    return (
      <section>
        <div className="select-inner">
          {SelectBlock}
          <h2>Select Reusable Block</h2>
          <a onClick={() => this.openModal()}>Select</a>
        </div>
        <div className="popup-section">
          <div className="modalpopup">
            <Modal
              visible={this.state.visible}
              width="1300"
              height="750"
              effect="fadeInUp"
              onClickAway={() => this.closeModal()}
            >
              <i
                className="fas fa-times close_icon"
                onClick={() => this.closeModal()}
              />
              {this.state.visible ? <ListingData data={this.props.data} /> : '' }
            </Modal>
          </div>
        </div>
      </section>
    );
  }
}

export default Popup;
