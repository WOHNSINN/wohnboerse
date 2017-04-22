import React, { Component } from 'react';
import Profile from '../Profile/Profile';

const CURRENCY = '€';

class Flat extends Component {
  render() {
    return (
      <div className="row">
        <div className="col-xs-3">
          {this.props.flat.image &&
            <img src={this.props.flat.image.urls.S.url} alt={this.props.flat.title} />
          }
        </div>
        <div className="col-xs-9">
          <h2>{this.props.flat.title} | {this.props.flat.rent}{CURRENCY}</h2>
          <div>{this.props.flat.cityName}</div>
          <div>{this.props.flat.from}</div>
          <Profile profile={this.props.flat.profile}/>
        </div>
      </div>
    );
  }
}

export default Flat;
