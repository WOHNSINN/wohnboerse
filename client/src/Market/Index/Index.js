import React, { Component } from 'react';
import List from '../List/List';
import config from '../../../../config/config.json';

class Index extends Component {
  constructor(props) {
    super(props);
    this.state = {
      loading: true,
    };

    fetch(config.api_entry, {
      method: 'GET',
    }).then(this.listResponse.bind(this)).catch(this.listError.bind(this));
  }

  listResponse(response) {
    response.json().then((result) => {
      this.setState({
        list: result,
        loading: false,
      });
    }).catch(this.listError.bind(this));
  }

  listError() {
    this.setState({
      error: true,
      loading: false,
    });
  }

  render() {
    return (
      <div>
        {this.state.loading === true &&
          <span></span>
        }
        {this.state.loading === false && this.state.error &&
          <span>Something bad happened</span>
        }
        {this.state.loading === false && this.state.list &&
          <List list={this.state.list} />
        }
      </div>
    );
  }
}

export default Index;
