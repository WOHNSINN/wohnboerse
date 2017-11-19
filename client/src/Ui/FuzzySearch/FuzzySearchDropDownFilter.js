import React, { Component } from 'react';
import FuzzySearchDropDown from './FuzzySearchDropDown';

class FuzzySearchDropDownFilter extends Component {

  unique(list) {
    var list_unique = list.filter((entity, index, self) => self.indexOf(entity) === index);
    return list_unique.filter((value) => value != null);
  }

  getOptions() {
    var propertyName = this.props.column.property;
    return this.unique(
      this.props.data.result.map(function (row) {
          if (propertyName in row) {
             return row[propertyName];
          } else {
              return null;
          }
      })
    );
  }

  render() {
    var options = this.getOptions();
    return(
      <FuzzySearchDropDown options={options} onChange={this.props.onChange}/>
    );
  }
}

export default FuzzySearchDropDownFilter;
