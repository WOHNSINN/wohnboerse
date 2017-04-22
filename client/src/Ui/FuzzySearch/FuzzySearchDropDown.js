import React, { Component } from 'react';
import FuzzySearch from './FuzzySearch';
import './FuzzySearchDropDown.css';

const BLUR_TIMEOUT = 100;

class FuzzySearchDropDown extends Component {
  constructor(props) {
    super(props);

    this.state = {
      show: false,
    };
  }

  selectOption(option) {
    this.fuzzySearch.setSearchInput(option);
    this.setShow(false);
  }

  setFuzzySearch(fuzzySearch) {
    this.fuzzySearch = fuzzySearch;
  }

  setShow(show) {
    this.setState({
      show,
    });

    if (show === true) {
      this.fuzzySearch.focus();
    }
  }

  render() {
    var toggle = this.setShow.bind(this, !this.state.show);
    var show   = this.setShow.bind(this, true);
    // OnBlur needs a timeout, because its gets triggered before the click on the option itself.
    var hide   = () => setTimeout(this.setShow.bind(this, false), BLUR_TIMEOUT);

    return (
      <div className="fuzzy-search dropdown">
        <div className="dropdown-arrow" onClick={toggle}>
          <span className="dropdownicon"></span>
        </div>
        <FuzzySearch onChange={this.props.onChange} onFocus={show} onBlur={hide} ref={this.setFuzzySearch.bind(this)} />
        {this.state.show === true &&
          <div className="options">
            {this.props.options.map((option, index) =>
              <div onClick={this.selectOption.bind(this, option)} className="option" key={index}>{option}</div>
            )}
          </div>
        }
      </div>
    );
  }
}

export default FuzzySearchDropDown;
