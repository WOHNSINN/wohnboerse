import React, { Component } from 'react';
import Profile from '../Profile/Profile';

const CURRENCY = '€';

class Flat extends Component {
  constructor(props) {
    super(props);

    this.state = {
      showDetail: false,
    };
  }

  toggleDetail() {
    this.setState({
      showDetail: !this.state.showDetail,
    });
  }

  render() {
    return (
      <div className="row" onClick={this.toggleDetail.bind(this)}>
        <div className="col-xs-3">
          {this.props.flat.image && this.props.flat.image.urls.S.url &&
            <img src={this.props.flat.image.urls.S.url} alt={this.props.flat.title}/>
          }
        </div>
        <div className="col-xs-9">
          <h2>{this.props.flat.title} | {this.props.flat.rent}{CURRENCY}</h2>
          <div>{this.props.flat.cityName}</div>
          <div>{this.props.flat.from}</div>
          <Profile profile={this.props.flat.profile}/>
          {this.state.showDetail &&
            <div>
              <div>{this.props.flat.description}</div>
              <div>{this.props.flat.wantedAmountFemale}</div>
              <div>{this.props.flat.membersManCount}</div>
              <div>{this.props.flat.membersWomanCount}</div>
            </div>
          }
        </div>
      </div>
    );
  }
}

export default Flat;
