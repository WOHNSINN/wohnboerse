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
    console.log(this.props)
    const url = "https://www.wg-suche.de/#/angebot/" + this.props.flat.apiId
    const from = new Date(this.props.flat.searchFrom);
    const fromStr = from.getDate() + "." + from.getMonth() + "." + from.getFullYear();

    const showDate = this.props.flat.searchFrom !== null;
    const showToDate = this.props.flat.searchTo !== null;

    const to = new Date(this.props.flat.searchTo);
    const toStr = to.getDate() + "." + to.getMonth() + "." + to.getFullYear();

    return (
      <div className="row wg-boerse-flat" onClick={this.toggleDetail.bind(this)}>
        <div className="col-xs-4">
          {this.props.flat.image && this.props.flat.image.urls.S.url &&
            <img src={this.props.flat.image.urls.S.url} alt={this.props.flat.title}/>
          }
          {!this.props.flat.image || !this.props.flat.image.urls.S.url &&
            <img src="/images/placeholder.png" alt="no picture" className="center-block"/>
          }
        </div>
        <div className="col-xs-6">
          <h3>{this.props.flat.title} </h3>
          <h4>in {this.props.flat.cityName}</h4>
          <hr />

          <div className="wg-boerse-item">Zimmergröße: {this.props.flat.size}qm</div>
          <hr />
          {showDate &&
              <div className="wg-boerse-item">Ab {fromStr} {showToDate && <span> | Bis {toStr} </span> } </div>
          }
          <hr />
          {this.state.showDetail &&
            <div>
              <div className="wg-boerse-description">
              {this.props.flat.description.split('\n').map((item, key) => {
                  return <span key={key}>{item}<br/></span>
              })}
              </div>
              <a href={url}>
                  <button type="button" className="btn btn-primary">
                     WG-Zimmer anfragen
                  </button>
              </a>
            </div>
          }
        </div>
        <div className="col-xs-2 wg-boerse-right-col">
          <h3 className="wg-boerse-fee">{this.props.flat.rent}{CURRENCY}</h3>
          <span className='wg-boerse-profileName'>{this.props.flat.profileName}</span>
          <br />
          <br />
        </div>
      </div>
    );
  }
}

export default Flat;
