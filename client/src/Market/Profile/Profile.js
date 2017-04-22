import React, { Component } from 'react';

class Profile extends Component {

  render() {
    return (
      <span>
        {this.props.profile.name}
      </span>
    );
  }
}

export default Profile;
