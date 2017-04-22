import React, { Component } from 'react';

class Profile extends Component {
  onChange(evt) {
    this.props.onChange(evt.currentTarget.value);
  }

  focus() {
    this.input.focus();
  }

  setInput(input) {
    this.input = input;
  }

  render() {
    return (
      <input type="text" {...this.props} onChange={this.onChange.bind(this)} ref={this.setInput.bind(this)} />
    );
  }
}

export default Profile;
