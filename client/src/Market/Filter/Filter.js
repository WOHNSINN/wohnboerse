import React, { Component } from 'react';
import FuzzySearchDropDownFilter from '../../Ui/FuzzySearch/FuzzySearchDropDownFilter';

class Filter extends Component {
  constructor(props) {
    super(props);

    this.filters = {};
  }

  changeFilter(key, filterFunction) {
    this.filters[key] = filterFunction;

    this.props.onChange(this.filters);
  }

  render() {
    return (
      <span>
        <FuzzySearchDropDownFilter
          data={this.props.data}
          column={{ property: 'cityName' }}
          onChange={this.changeFilter.bind(this, 'cityName')} />
      </span>
    );
  }
}

export default Filter;
