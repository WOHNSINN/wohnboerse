import React, { Component } from 'react';
import Flat from '../Flat/Flat';
import Filter from '../Filter/Filter';

class List extends Component {
  filteredFlats() {
    if (this.state && this.state.filters) {
      return this.props.list.result.filter((flat) => {
        var filtered = true;

        for (var index in this.state.filters) {
          if (this.state.filters.hasOwnProperty(index)) {
            filtered = this.state.filters[index](flat[index]);
            if (filtered === false) {
              break;
            }
          }
        }

        return filtered;
      });
    } else {
      return this.props.list.result;
    }
  }

  filterChange(filters) {
    this.setState({
      filters: filters,
    });
  }

  render() {
    return (
      <span>
        <Filter onChange={this.filterChange.bind(this)} data={this.props.list}/>
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
