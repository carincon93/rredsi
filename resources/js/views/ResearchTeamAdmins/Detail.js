import React, { Component } from 'react';
import { find } from '~/containers/ResearchTeamAdmin';
import { Link } from 'react-router-dom';

class Detail extends Component {

  constructor(props) {
    super(props);

    this.state = {
      id: props.match.params.id,
      researchTeamAdmin: {},
      interests: {}
    }
    
  }

  componentDidMount() {
    this.getResearchTeamAdmin();
  }

  getResearchTeamAdmin() {
    find(this.state.id, 'show').then(data => {
      this.setState({researchTeamAdmin: data});
      this.setState({interests: JSON.parse(data.user.interests)});
    })
  }

  render() {
    const { researchTeamAdmin } = this.state;
    if (researchTeamAdmin.user?.id == null) {
      return <div>Loading</div>
    }
    return (
      <div className="container">
        <div className="card p-4 detail">
          <div className="card-header">
              <h4>{researchTeamAdmin.user.name}</h4>
              <Link to={`/app/research-team-admins/edit/${researchTeamAdmin.user.id}`}>
                Editar
              </Link>
          </div>

          <ul className="list-unstyled">
            <li className="media">
              <img className="mr-3" src="images/shapes/circle.png" alt="circle" />
              <div className="media-body">
                  <h5 className="mt-0 mb-1">Correo electrónico</h5>
                  {researchTeamAdmin.user.email}
              </div>
            </li>
            <li className="media my-4">
              <img className="mr-3" src="images/shapes/circle.png" alt="circle" />
              <div className="media-body">
                  <h5 className="mt-0 mb-1">Número de celular</h5>
                  {researchTeamAdmin.user.cellphone_number}              
              </div>
            </li>
            <li className="media">
              <img className="mr-3" src="images/shapes/circle.png" alt="circle" />
              <div className="media-body">
                  <h5 className="mt-0 mb-1">Documento de identidad</h5>
                  {researchTeamAdmin.user.document_type} {researchTeamAdmin.user.document_number}
              </div>
            </li>
            <li className="media">
              <img className="mr-3" src="images/shapes/circle.png" alt="circle" />
              <div className="media-body">
                  <h5 className="mt-0 mb-1">Semillero de investigación responsable</h5>
                  {researchTeamAdmin.is_research_team_admin?.name}
              </div>
            </li>
          </ul>
        </div>
      </div>
    )
  }
}

export default Detail;