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

  onChange(filters) {
    this.setState({
        filters: filters,
        show: this.state.show,
    });
    this.props.onChange(filters);
  }

  filteredOptions() {
    if (this.state && this.state.filters) {
        return this.props.options.filter(this.state.filters)
    } else {
        return this.props.options;
    }
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
      show: show,
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
    var onChange = this.onChange.bind(this)
    return (
      <div className="fuzzy-search dropdown">
        <div className="dropdown-arrow" onClick={toggle}>
          <span className="dropdownicon"></span>
        </div>
        <FuzzySearch onChange={onChange} onFocus={show} onBlur={hide} options={this.props.options} ref={this.setFuzzySearch.bind(this)} />
        {this.state.show === true &&
          <div className="options">
            {this.filteredOptions().map((option, index) =>
              <div onClick={this.selectOption.bind(this, option)} className="option" key={index}>{option}</div>
            )}
          </div>
        }
      </div>
    );
  }
}

export default FuzzySearchDropDown;
