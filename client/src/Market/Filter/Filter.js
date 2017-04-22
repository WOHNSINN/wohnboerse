import React, { Component } from 'react';
import Dropdown from '../../Ui/Dropdown/Dropdown';

class Filter extends Component {
  changeFilter(key, filterFunction) {
    // this.setState({
    //   [key]: filterFunction,
    // });

    this.props.onChange(key, filterFunction);
  }

  render() {
    return (
      <span>
        <Dropdown onChange={this.changeFilter.bind(this, 'cityName')} />
      </span>
    );
  }
}

export default Filter;
