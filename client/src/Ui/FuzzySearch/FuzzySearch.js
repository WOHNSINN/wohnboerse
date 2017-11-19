import React, { Component } from 'react';
import InputItem from '../Formelements/InputItem';

class FuzzySearch extends Component {

  constructor(props) {
    super(props);
    this.state = {
      value: '',
    };
  }

  setSearchInput(value) {
    this.setState({
      value,
    });
    this.props.onChange(this.isValueFiltered.bind(this, value));
  }

  isValueFiltered(needle, haystack) {
    if (haystack === undefined || haystack === null) {
        return false;
    }
    var result = true;
    var pos = 0;
    for (var i = 0; i < needle.length; i++) {
      pos = this.checkChar(needle[i], haystack, pos);
      if (pos === -1) {
        result = false;
        break;
      }

      pos++; // Should be searched _after_ the found character
    }
    return result;
  }

  checkChar(needleChar, haystack, pos) {
    var lowerPos = haystack.indexOf(needleChar, pos);
    var higherPos = haystack.indexOf(needleChar.toUpperCase(), pos);

    var filteredValues = [lowerPos, higherPos].filter(this.isPositiveValue);

    if (filteredValues.length === 0) {
      return -1;
    } else {
      return Math.min.apply(Math, filteredValues);
    }
  }

  isPositiveValue(value) {
    return value >= 0;
  }

  focus() {
    this.inputItem.focus();
  }

  setInputItem(inputItem) {
    this.inputItem = inputItem;
  }

  render() {
    return (
      <form>
        <div>
          <label htmlFor="">Wo suchst Du?</label>
          <InputItem
            onFocus={this.props.onFocus}
            onBlur={this.props.onBlur}
            value={this.state.value}
            onChange={this.setSearchInput.bind(this)}
            placeholder="Ort auswählen"
            ref={this.setInputItem.bind(this)}
          />
        </div>
      </form>
    );
  }
}

export default FuzzySearch;
