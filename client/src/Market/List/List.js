import React, { Component } from 'react';
import Flat from '../Flat/Flat';

class List extends Component {
  // constructor(props) {
  //   super(props);

    
  // }
  
  render() {
    return (
      <span>

        {this.props.list.result.map((flat) =>
          <Flat flat={flat} key={flat.id} />
        )}
      </span>
    );
  }
}

export default List;
