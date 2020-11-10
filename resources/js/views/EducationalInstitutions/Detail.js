import React, { Component } from 'react';
import { find } from '~/containers/EducationalInstitution';
import { Link } from 'react-router-dom';

class Detail extends Component {

  constructor(props) {
    super(props);

    this.state = {
      id: props.match.params.id,
      educationalInstitution: {},
    }
  }

  componentDidMount() {
    this.getEducationalInstitution();
  }

  getEducationalInstitution(){
    find(this.state.id, 'show').then(data => {
      this.setState({educationalInstitution: data});
    })
  }

  render() {
    const { educationalInstitution } = this.state;
    return (
      <div className="container">
        <div className="card p-4 detail">
          <div className="card-header">
              <h4>{educationalInstitution.name}</h4>
              <Link to={`/app/educational-institutions/edit/${educationalInstitution.id}`}>
                Editar
              </Link>
          </div>
      <hr/>
          <ul className="list-unstyled">
            <li className="media">
              <img className="mr-3" src="" alt="circle" />
              <div className="media-body">
                  <h5 className="mt-0 mb-1">Nit</h5>
                  {educationalInstitution.nit}
              </div>
            </li>
            <li className="media my-4">
              <img className="mr-3" src="" alt="circle" />
              <div className="media-body">
                  <h5 className="mt-0 mb-1">Dirección</h5>
                  {educationalInstitution.address}                        
              </div>
            </li>
            <li className="media my-4">
              <img className="mr-3" src="" alt="circle" />
              <div className="media-body">
                  <h5 className="mt-0 mb-1">Ciudad</h5>
                  {educationalInstitution.city}              
              </div>
            </li>
            <li className="media my-4">
              <img className="mr-3" src="" alt="circle" />
              <div className="media-body">
                  <h5 className="mt-0 mb-1">Telefono</h5>
                  {educationalInstitution.phone_number}              
              </div>
            </li>
            <li className="media my-4">
              <img className="mr-3" src="" alt="circle" />
              <div className="media-body">
                  <h5 className="mt-0 mb-1">Sitio web</h5>
                  {educationalInstitution.website}              
              </div>
            </li>
            <li className="media my-4">
              <img className="mr-3" src="" alt="circle" />
              <div className="media-body">
                  <h5 className="mt-0 mb-1">Administrador de la institución educativa</h5>
                  {educationalInstitution.administrator?.user?.name}              
              </div>
            </li>
          </ul>
        </div>
      </div>
    )
  }
}

export default Detail;