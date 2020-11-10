import React, { Component } from 'react';
import { find } from '~/containers/Node';
import { Link } from 'react-router-dom';

class Detail extends Component {

  constructor(props) {
    super(props);
  
    this.state = {
      id: props.match.params.id,
      node: {}
    }
  }

  componentDidMount() {
    this.getNode();
  }

  getNode() {
    find(this.state.id, 'show').then(data => {
      this.setState({node: data});
    })
  }

  render() {
    const { node } = this.state;
    if (node.id == null) {
      return <div>Loading</div>
    }
    return (
      <div className="container">
        <div className="card p-4 detail">
          <div className="card-header">
              <h4>{node.state}</h4>
              <Link to={`/app/nodes/edit/${node.id}`}>
                Editar
              </Link>
          </div>
      <hr/>
          <ul className="list-unstyled">
            <li className="media">
              <img className="mr-3" src="" alt="circle" />
              <div className="media-body">
                  <h5 className="mt-0 mb-1">Administrador del nodo</h5>
                  {node.administrator?.user.name}
              </div>
            </li>
            <li className="media my-4">
              <img className="mr-3" src="" alt="circle" />
              <div className="media-body">
                  <h5 className="mt-0 mb-1">Número de teléfono del administrador del nodo</h5>
                  {node.administrator?.user.cellphone_number}                        
              </div>
            </li>
            <li className="media my-4">
              <img className="mr-3" src="" alt="circle" />
              <div className="media-body">
                  <h5 className="mt-0 mb-1">Correo electrónico del administrador del nodo</h5>
                  {node.administrator?.user.email}              
              </div>
            </li>
          </ul>
        </div>
      </div>
    )
  }
}

export default Detail;