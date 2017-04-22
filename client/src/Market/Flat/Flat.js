import React, { Component } from 'react';

class Flat extends Component {
  render() {
    return (
      <span>
        {this.props.flat.image &&
          <img src={this.props.flat.image.urls.S.url} alt={this.props.flat.title} />
        }
        <h2>{this.props.flat.title}</h2>
        <span>{this.props.flat.cityName}</span>
      </span>
    );
  }
}

export default Flat;
