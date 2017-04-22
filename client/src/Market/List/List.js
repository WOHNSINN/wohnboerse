import React, { Component } from 'react';
import Flat from '../Flat/Flat';
import Filter from '../Filter/Filter';

class List extends Component {
  filteredFlats() {
    return this.props.list.result;
  }

  filterChange(filters) {
    this.setState({
      filters: filters,
    });
  }

  render() {
    return (
      <span>
        <Filter onChange={this.filterChange} data={this.props.list.result}/>
        {this.filteredFlats().map((flat) =>
          <span key={flat.id}>
            <Flat flat={flat}/>
            <hr />
          </span>
        )}
      </span>
    );
  }
}

export default List;
