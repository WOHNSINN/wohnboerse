import React, { Component } from 'react';
import FuzzySearchDropDown from './FuzzySearchDropDown';

class FuzzySearchDropDownFilter extends Component {

  unique(list) {
    return list.filter((entity, index, self) => self.indexOf(entity) === index);
  }

  getOptions() {
    var propertyName = this.props.column.property;
    return this.unique(
      this.props.data.result.map(function (row) {
        return row[propertyName];
      })
    );
  }

  render() {
    return(
      <FuzzySearchDropDown options={this.getOptions()} onChange={this.props.onChange}/>
    );
  }
}

export default FuzzySearchDropDownFilter;
