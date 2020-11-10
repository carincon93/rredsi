import React, { Component } from 'react';
import { get, destroy } from '~/containers/Researcher';
import { Link } from 'react-router-dom';

class Index extends Component {
  constructor(props) {
    super(props);

    this.state = {
      researchers: {},
    }
  }

  componentDidMount() {
    this.getData();
  }

  handleDelete(e) {
    e.preventDefault();
    destroy(e.target);
  }

  getData() {
    get().then(data => {
      this.setState({researchers: data});
    })
  }

  render() {
    const { researchers } = this.state;
    return (
      <div className="container">
        <div className="flex-row">
          <div className="flex-large">
            <div className="card">
              <div className="card-header">
                <h2>Researchers</h2>
                <Link to='/app/researchers/create' className="btn btn-primary">Crear</Link>
              </div>          
              <table className="table">
                <thead>
                  <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Correo electrónico</th>
                    <th scope="col">Institución educativa / Grupo de investigación</th>
                    <th scope="col">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  {researchers.length > 0 ? (
                    researchers.map((researcher) => (
                      <tr key={researcher.id}>
                        <td>{researcher.user.name}</td>
                        <td>{researcher.user.email}</td>
                        <td></td>
                        <td className="actions">
                          <div className="actions-wrapper">
                            <Link to={`/app/researchers/edit/${researcher.id}`}>
                              Editar
                            </Link>
                            <Link
                                to={`/app/researchers/detail/${researcher.id}`}
                            >
                                Detail
                            </Link>
                            <button
                              className="btn"
                              type="button"
                            >
                              Eliminar
                            </button>
                          </div>
                        </td>
                      </tr>
                    ))
                    ): (
                    <tr>
                      <td colSpan="4">No researchers</td>
                    </tr>
                  )}
                </tbody>
              </table>            
            </div>
          </div>
        </div>
      </div>
    )
  }
}

export default Index;
