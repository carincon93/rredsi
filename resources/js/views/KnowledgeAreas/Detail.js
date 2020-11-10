import React, { Component } from 'react';
import { find } from '~/containers/KnowledgeAreas';
import { Link } from 'react-router-dom';

class Detail extends Component {

  constructor(props) {
    super(props);

    this.state = {
      id: props.match.params.id,
      KnowledgeArea: {},
    }
  }

  componentDidMount() {
    this.getKnowledgeArea();
  }

  getKnowledgeArea(){
    find(this.state.id, 'show').then(data => {
      this.setState({KnowledgeArea: data});
    })
  }

  render() {
    const { KnowledgeArea } = this.state;
    return (
      <div className="container">
        <div className="card p-4 detail">
          <div className="card-header">
              <h4>{KnowledgeArea.name}</h4>
              <Link to={`/app/knowledge-areas/edit/${KnowledgeArea.id}`}>
                Editar
              </Link>
          </div>
      <hr/>
        </div>
      </div>
    )
  }
}

export default Detail;