import React, { Component } from 'react';
import { find } from '~/containers/Researcher';
import { Link } from 'react-router-dom';

class Detail extends Component {

  constructor(props) {
    super(props);

    this.state = {
      researcher: {},
      id: props.match.params.id,
    }
  }

  componentDidMount() {
    this.getResearcher();
  }

  getResearcher() {
    find(this.state.id, 'show').then(data => {
      this.setState({researcher: data});
      this.setState({interests: JSON.parse(data.user.interests)});
    })
  }

  render() {
    const { researcher } = this.state;
    if (researcher.user?.id == null) {
      return <div>Loading</div>
    }
    return (
      <div className="container">
        <div className="card p-4 detail">
          <div className="card-header">
              <h4>{researcher.user.name}</h4>
              <Link to={`/app/researchers/edit/${researcher.user.id}`}>
                Editar
              </Link>
          </div>

          <ul className="list-unstyled">
            <li className="media">
              <img className="mr-3" src="" alt="circle" />
              <div className="media-body">
                  <h5 className="mt-0 mb-1">Correo electrónico</h5>
                  {researcher.user.email}
              </div>
            </li>
            <li className="media my-4">
              <img className="mr-3" src="" alt="circle" />
              <div className="media-body">
                  <h5 className="mt-0 mb-1">Número de documento</h5>
                  {researcher.user.document_type} {researcher.user.document_number}             
              </div>
            </li>
            <li className="media my-4">
              <img className="mr-3" src="" alt="circle" />
              <div className="media-body">
                  <h5 className="mt-0 mb-1">Número de contacto</h5>
                  {researcher.user.cellphone_number}              
              </div>
            </li>
            <li className="media">
              <img className="mr-3" src="" alt="circle" />
              <div className="media-body">
                  <h5 className="mt-0 mb-1">Semilleros de investigación</h5>
                  <ul>
                  {researcher.user?.research_teams?.length > 0 ? (
                    researcher.user?.research_teams.map((researchTeam) => {
                      <li key={researchTeam.id}>researchTeam.name</li>
                    })
                  ) : (
                    <li>No research teams</li>
                  )}
                  </ul>
              </div>
            </li>
          </ul>
        </div>
      </div>
    )
  }
}

export default Detail;