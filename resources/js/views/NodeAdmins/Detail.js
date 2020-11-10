import React, { Component } from 'react';
import { find } from '~/containers/NodeAdmin';
import { Link } from 'react-router-dom';

class Detail extends Component {

  constructor(props) {
    super(props);

    this.state = {
      nodeAdmin: {},
      id: props.match.params.id,
      interests: ""
    }
  }

  componentDidMount() {
    this.getNodeAdmin();
  }

  getNodeAdmin() {
    find(this.state.id, 'show').then(data => {
      this.setState({nodeAdmin: data});
      this.setState({interests: JSON.parse(data.user.interests)});
    })
  }

  render() {
    const { nodeAdmin } = this.state;
    if (nodeAdmin.user?.id == null) {
      return <div>Loading</div>
    }
    return (
      <div className="container">
        <div className="card p-4 detail">
          <div className="card-header">
              <h4>{nodeAdmin.user.name}</h4>
              <Link to={`/app/node-admins/edit/${nodeAdmin.user.id}`}>
                Editar
              </Link>
          </div>

          <ul className="list-unstyled">
            <li className="media">
              <img className="mr-3" src="" alt="circle" />
              <div className="media-body">
                  <h5 className="mt-0 mb-1">Correo electrónico</h5>
                  {nodeAdmin.user.email}
              </div>
            </li>
            <li className="media my-4">
              <img className="mr-3" src="" alt="circle" />
              <div className="media-body">
                  <h5 className="mt-0 mb-1">Número de documento</h5>
                  {nodeAdmin.user.document_type} {nodeAdmin.user.document_number}             
              </div>
            </li>
            <li className="media my-4">
              <img className="mr-3" src="" alt="circle" />
              <div className="media-body">
                  <h5 className="mt-0 mb-1">Número de contacto</h5>
                  {nodeAdmin.user.cellphone_number}              
              </div>
            </li>
            <li className="media">
              <img className="mr-3" src="" alt="circle" />
              <div className="media-body">
                  <h5 className="mt-0 mb-1">Nodo responsable</h5>
                  {nodeAdmin.node?.state}
              </div>
            </li>
          </ul>
        </div>
      </div>
    )
  }
}

export default Detail;