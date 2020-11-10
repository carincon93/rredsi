import React, { Component } from 'react';
import { find } from '~/containers/EducationalInstitutionAdmin';
import { Link } from 'react-router-dom';

class Detail extends Component {

  constructor(props) {
    super(props);

    this.state = {
      id: props.match.params.id,
      educationalInstitutionAdmin: {},
    }
  }

  componentDidMount() {
    this.getEducationalInstitutionAdmin();
  }

  getEducationalInstitutionAdmin() {
    find(this.state.id, 'show').then(data => {
      this.setState({educationalInstitutionAdmin:data});
    })
  }

  render() {
    const { educationalInstitutionAdmin } = this.state;
    return (
      <div className="container">
        <div className="card p-4 detail">
          <div className="card-header">
              <h4>{educationalInstitutionAdmin.user?.name}</h4>
              <Link to={`/app/educational-institution-admins/edit/${educationalInstitutionAdmin.id}`}>
                Editar
              </Link>
          </div>
          <hr/>
          <ul className="list-unstyled">
            <li className="media">
              <img className="mr-3" src="" alt="circle" />
              <div className="media-body">
                  <h5 className="mt-0 mb-1">Correo electrónico</h5>
                  {educationalInstitutionAdmin.user?.email}
              </div>
            </li>
            <li className="media my-4">
              <img className="mr-3" src="" alt="circle" />
              <div className="media-body">
                  <h5 className="mt-0 mb-1">Celular</h5>
                  {educationalInstitutionAdmin.user?.cellphone_number}                        
              </div>
            </li>
            <li className="media my-4">
              <img className="mr-3" src="" alt="circle" />
              <div className="media-body">
                  <h5 className="mt-0 mb-1">Documento</h5>
                  {educationalInstitutionAdmin.user?.document_type} {educationalInstitutionAdmin.user?.document_number}              
              </div>
            </li>
            <li className="media my-4">
              <img className="mr-3" src="" alt="circle" />
              <div className="media-body">
                  <h5 className="mt-0 mb-1">Institución educativa responsable</h5>
                  {educationalInstitutionAdmin.educational_institution?.name}              
              </div>
            </li>
          </ul>
        </div>
      </div>
    )
  }
}

export default Detail;