import React, { Component, Fragment } from 'react';
import ReactDOM from 'react-dom';
import apiFetch from '@wordpress/api-fetch';
import './FilterSearch.css';

const dataList = [
  {
    'id': 1,
    'category': 'music',
    'name': 'Leanne Graham',
  },
  {
    'id': 2,
    'category': 'music',
    'name': 'Ervin Howell',
  },
  {
    'id': 3,
    'category': 'art',
    'name': 'Clementine Bauch',
  },
  {
    'id': 4,
    'category': 'food',
    'name': 'Patricia Lebsack',
  },
  {
    'id': 5,
    'category': 'music',
    'name': 'Chelsey Dietrich',
  },
  {
    'id': 6,
    'category': 'food',
    'name': 'Mrs. Dennis Schulist',
  },
  {
    'id': 7,
    'category': 'art',
    'name': 'Kurtis Weissnat',
  },
  {
    'id': 8,
    'category': 'music',
    'name': 'Nicholas Runolfsdottir V',
  },
  {
    'id': 9,
    'category': 'music',
    'name': 'Glenna Reichert',
  },
  {
    'id': 10,
    'category': 'food',
    'name': 'Clementina DuBuque',
  }
];

class FilterSearch extends Component {
  constructor(props) {
    super(props);
    this.state = {
      data: dataList,
      value: '',
      totalDataFetched: dataList
    };
    this.changeCategory = this.changeCategory.bind(this);
    this.searchByCheckBox = this.searchByCheckBox.bind(this);
    this.searchByRadioCheck = this.searchByRadioCheck.bind(this);
  }
  componentWillMount() {

    // this.fetchData();
  }
  fetchData() {
    apiFetch({
      path: 'https://jsonplaceholder.typicode.com/users'
    }).then(json => this.setState({ data: json, totalDataFetched: json }));
  }

  changeCategory(e) {
    let selectedEventType, i, querySelect, selectBox;
    selectBox = document.querySelectorAll('.data-box');
    selectedEventType = e.target.value;
    querySelect = document.querySelectorAll(`.data-box[data-eventtype = ${selectedEventType}]`);

    for (i = 0; i < selectBox.length; i++) {
      selectBox[i].classList.remove('show');
    }

    if ('all' == selectedEventType) {
      document.querySelector('.fetched-data').classList.remove('data-filtered');
      for (i = 0; i < selectBox.length; i++) {
        selectBox[i].classList.remove('show');
      }
    } else {
      document.querySelector('.fetched-data').classList.add('data-filtered');
      for (i = 0; i < querySelect.length; i++) {
        querySelect[i].classList.add('show');
      }
    }

  }

  searchByCheckBox(e) {
    let i, checkboxes, textVal, checkedArray, finalList;

    checkboxes = document.getElementsByName('selectChecked');
    checkedArray = [];
    for (i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i].checked) {
        textVal = checkboxes[i].value;
        checkedArray.push(textVal);

      }
    }

    finalList = dataList.filter(item => checkedArray.includes(item.category));

    if (finalList.length) {
      this.setState({
        data: finalList
      });
    }
    else {
      this.setState({
        data: dataList
      });
    }


  }

  searchByRadioCheck(e) {
    let i, radioBtns, checkedRadio, radioListOutput;

    radioBtns = document.getElementsByName('radioSelect');
    for (i = 0; i < radioBtns.length; i++) {
      if (radioBtns[i].checked) {
        checkedRadio = radioBtns[i].value;
      }
    }
    radioListOutput = dataList.filter(item => checkedRadio.includes(item.category));

    if (radioListOutput.length) {
      this.setState({
        data: radioListOutput
      });
    }
    else if ('all' === checkedRadio) {
      this.setState({
        data: dataList
      });
    }
    else {
      this.setState({
        data: dataList
      });
    }


  }

  searchByChar(e) {

    // const allData = this.state.totalDataFetched;
    var charData = this.state.totalDataFetched.filter(function (hero) {
      document
        .querySelectorAll('ul.char-list li a.active')
        .forEach(function (item) {
          item.classList.remove('active');
        });
      e.target.classList.add('active');
      document.getElementsByClassName('clearAllData')[0].style.display =
        'block';
      return hero.name.charAt(0) == e.target.innerHTML;
    });

    1 <= charData.length ?
      ((document.getElementsByClassName('noDataFound')[0].style.display =
        'none'),
        this.setState({ data: charData })) :
      ((document.getElementsByClassName('noDataFound')[0].style.display =
        'block'),
        this.setState({ data: [] }));
  }

  clearCharacterSearch(e) {
    const allData = this.state.totalDataFetched;
    document
      .querySelectorAll('ul.char-list li a.active')
      .forEach(function (item) {
        item.classList.remove('active');
      });
    document.getElementsByClassName('noDataFound')[0].style.display = 'none';
    this.setState({ data: allData });
    document.getElementsByClassName('clearAllData')[0].style.display = 'none';
    document.querySelector('.fetched-data').classList.remove('data-filtered');
  }


  render() {
    const { data } = this.state;
    return (
      <div className="boxes">
        <h1 id="details" className="det"></h1>
        <div className="container">
          <div className="row">
            <div className="col-lg-3">
              <div className="select-list">
                <select className="event-type-select" onChange={this.changeCategory}>
                  <option value="all" >All Event Types</option>
                  <option value="music">Music</option>
                  <option value="food">Food</option>
                  <option value="art">Art</option>
                </select>
              </div>
            </div>
            <div className="col-lg-9">
              <ul className="char-list">
                <li>
                  <a href="javascript:void(0)" id="1" onClick={this.searchByChar.bind(this)}>
                    A
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)" id="2" onClick={this.searchByChar.bind(this)}>
                    B
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)" id="3" onClick={this.searchByChar.bind(this)}>
                    C
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)" id="4" onClick={this.searchByChar.bind(this)}>
                    D
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)" id="5" onClick={this.searchByChar.bind(this)}>
                    E
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)" id="6" onClick={this.searchByChar.bind(this)}>
                    F
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)" id="7" onClick={this.searchByChar.bind(this)}>
                    G
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)" id="8" onClick={this.searchByChar.bind(this)}>
                    H
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)" id="9" onClick={this.searchByChar.bind(this)}>
                    I
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)" id="10" onClick={this.searchByChar.bind(this)}>
                    J
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)" id="11" onClick={this.searchByChar.bind(this)}>
                    K
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)" id="12" onClick={this.searchByChar.bind(this)}>
                    L
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)" id="13" onClick={this.searchByChar.bind(this)}>
                    M
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)" id="14" onClick={this.searchByChar.bind(this)}>
                    N
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)" id="15" onClick={this.searchByChar.bind(this)}>
                    O
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)" id="16" onClick={this.searchByChar.bind(this)}>
                    P
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)" id="17" onClick={this.searchByChar.bind(this)}>
                    Q
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)" id="18" onClick={this.searchByChar.bind(this)}>
                    R
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)" id="19" onClick={this.searchByChar.bind(this)}>
                    S
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)" id="20" onClick={this.searchByChar.bind(this)}>
                    T
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)" id="21" onClick={this.searchByChar.bind(this)}>
                    U
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)" id="22" onClick={this.searchByChar.bind(this)}>
                    V
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)" id="23" onClick={this.searchByChar.bind(this)}>
                    W
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)" id="24" onClick={this.searchByChar.bind(this)}>
                    X
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)" id="25" onClick={this.searchByChar.bind(this)}>
                    Y
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)" id="26" onClick={this.searchByChar.bind(this)}>
                    Z
                  </a>
                </li>
                <li>
                  <a
                    href="javascript:void(0)"
                    id="27"
                    onClick={this.clearCharacterSearch.bind(this)}
                    className="clearAllData"
                    style={{ display: 'none' }}
                  >
                    Clear All
                  </a>
                </li>
              </ul>
            </div>
            <div className="col-lg-6">
              <ul className="char-list">
                <li>
                  <a href="javascript:void(0)" id="chk1" >
                    <input type="checkbox" onClick={this.searchByCheckBox} name="selectChecked" value="music" className="checkedSearch" />
                    Music
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)" id="chk2" >
                    <input type="checkbox" onClick={this.searchByCheckBox} name="selectChecked" value="food" className="checkedSearch" />
                    Food
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)" id="chk3" >
                    <input type="checkbox" onClick={this.searchByCheckBox} name="selectChecked" value="art" className="checkedSearch" />
                    Art
                  </a>
                </li>
              </ul>
            </div>
            <div className="col-lg-6">
              <ul className="char-list">
                <li>
                  <a href="javascript:void(0)" id="radio1" >
                    <input type="radio" onClick={this.searchByRadioCheck} name="radioSelect" value="all" className="radioSearch" />
                    All
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)" id="radio2" >
                    <input type="radio" onClick={this.searchByRadioCheck} name="radioSelect" value="music" className="radioSearch" />
                    Music
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)" id="radio3" >
                    <input type="radio" onClick={this.searchByRadioCheck} name="radioSelect" value="food" className="radioSearch" />
                    Food
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)" id="radio4" >
                    <input type="radio" onClick={this.searchByRadioCheck} name="radioSelect" value="art" className="radioSearch" />
                    Art
                  </a>
                </li>
              </ul>
            </div>
            <div className="col-lg-12">
              <div className="row">
                <p className="noDataFound" style={{ display: 'none' }}>
                  No Data Found!
                </p>
              </div>
              <ul className="fetched-data row">
                {data.map((res, i) => (
                  <li
                    key={i}
                    className="data-box col-lg-2 col-md-3 col-sm-12"
                    data-eventtype={res.category}
                  >
                    <img
                      src="https://dummyimage.com/600x400/000/fff"
                      alt="image"
                    />
                    <h4>{res.name} <br /> {res.category} </h4>
                  </li>
                ))}
              </ul>
            </div>
          </div>
        </div>
      </div >
    );
  }
}

document.addEventListener('DOMContentLoaded', function () {

  // ReactDOM.render(React.createElement('h1', null, 'okay its working now 005.'), document.getElementById('juhi'));
  ReactDOM.render(<FilterSearch />, document.getElementById('demoid'));
});
