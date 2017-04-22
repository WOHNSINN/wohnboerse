import React, { Component } from 'react';
import Flat from '../Flat/Flat';

class List extends Component {
  filteredFlats() {
    return this.props.list.result;
  }

  render() {
    return (
      <span>

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
