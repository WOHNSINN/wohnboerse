import React, { Component } from 'react';

class Flat extends Component {
  render() {
    return (
      <div>{this.props.flat.title} {this.props.flat.cityName}</div>
    );
  }
}

export default Flat;
