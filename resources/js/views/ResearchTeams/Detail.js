import React, { Component } from 'react';
import { find } from '~/containers/ResearchTeams';
import { Link } from 'react-router-dom';

class Detail extends Component {

  constructor(props) {
    super(props);
  
    this.state = {
      id: props.match.params.id,
      researchTeam: {},
      thematicResearch: ""
    }
  }

  componentDidMount() {
    this.getResearchTeam();
  }

  getResearchTeam() {
    find(this.state.id, 'show').then(data => {
      this.setState({researchTeam: data});
      this.setState({thematicResearch: JSON.parse(data.thematic_research)});
    })
  }

  render() {
    const { researchTeam, thematicResearch } = this.state;
    if (researchTeam.id == null) {
      return <div>Loading</div>
    }
    return (
      <div className="container">
        <div className="card p-4 detail">
          <div className="card-header">
            <h4>{researchTeam.name}</h4>
            <Link to={`/app/research-teams/edit/${researchTeam.id}`}>
              Editar
              </Link>
          </div>

          <ul className="list-unstyled">
            <li className="media my-4">
              <img className="mr-3" src="images/shapes/circle.png" alt="circle" />
              <div className="media-body">
                <h5 className="mt-0 mb-1">Nombre del mentor</h5>
                {researchTeam.mentor_name}
              </div>
            </li>
            <li className="media my-4">
              <img className="mr-3" src="images/shapes/circle.png" alt="circle" />
              <div className="media-body">
                <h5 className="mt-0 mb-1">Correo electrónico del mentor</h5>
                {researchTeam.mentor_email}
              </div>
            </li>
            <li className="media my-4">
              <img className="mr-3" src="images/shapes/circle.png" alt="circle" />
              <div className="media-body">
                <h5 className="mt-0 mb-1">Número celular del mentor</h5>
                {researchTeam.mentor_cellphone}
              </div>
            </li>
            <li className="media my-4">
              <img className="mr-3" src="images/shapes/circle.png" alt="circle" />
              <div className="media-body">
                <h5 className="mt-0 mb-1">Objetivo general</h5>
                {researchTeam.overall_objective}
              </div>
            </li>
            <li className="media my-4">
              <img className="mr-3" src="images/shapes/circle.png" alt="circle" />
              <div className="media-body">
                <h5 className="mt-0 mb-1">Misión</h5>
                {researchTeam.mission}
              </div>
            </li>
            <li className="media my-4">
              <img className="mr-3" src="images/shapes/circle.png" alt="circle" />
              <div className="media-body">
                <h5 className="mt-0 mb-1">Visión</h5>
                {researchTeam.vision}
              </div>
            </li>
            <li className="media my-4">
              <img className="mr-3" src="images/shapes/circle.png" alt="circle" />
              <div className="media-body">
                <h5 className="mt-0 mb-1">Proyección regional</h5>
                {researchTeam.regional_projection}
              </div>
            </li>
            <li className="media my-4">
              <img className="mr-3" src="images/shapes/circle.png" alt="circle" />
              <div className="media-body">
                <h5 className="mt-0 mb-1">Estrategia de producción de conocimiento</h5>
                {researchTeam.knowledge_production_strategy}
              </div>
            </li>
            <li className="media my-4">
              <img className="mr-3" src="images/shapes/circle.png" alt="circle" />
              <div className="media-body">
                <h5 className="mt-0 mb-1">Temáticas de investigación</h5>
                {thematicResearch}
              </div>
            </li>
            <li className="media my-4">
              <img className="mr-3" src="images/shapes/circle.png" alt="circle" />
              <div className="media-body">
                <h5 className="mt-0 mb-1">Áreas de conocimiento</h5>
                <ul>
                  {researchTeam.knowledge_areas?.map(knowledge_area => (
                    <li key={knowledge_area.id}>{knowledge_area.name}</li>
                  ))}
                </ul>
              </div>
            </li>
            <li className="media my-4">
              <img className="mr-3" src="images/shapes/circle.png" alt="circle" />
              <div className="media-body">
                <h5 className="mt-0 mb-1">Líneas de investigación</h5>
                <ul>
                  {researchTeam.research_lines?.map(researchLine => (
                    <li key={researchLine.id}>{researchLine.name}</li>
                  ))}
                </ul>
              </div>
            </li>
            <li className="media my-4">
              <img className="mr-3" src="images/shapes/circle.png" alt="circle" />
              <div className="media-body">
                <h5 className="mt-0 mb-1">Administrador</h5>
                {researchTeam.administrator?.user.name}
              </div>
            </li>
            <li className="media my-4">
              <img className="mr-3" src="images/shapes/circle.png" alt="circle" />
              <div className="media-body">
                <h5 className="mt-0 mb-1">Estudiante lider</h5>
                {researchTeam.student_leader === null? 'Aun no tiene':'Si tiene'}
              </div>
            </li>
            <li className="media my-4">
              <img className="mr-3" src="images/shapes/circle.png" alt="circle" />
              <div className="media-body">
                <h5 className="mt-0 mb-1">Grupo de investigacion</h5>
                {researchTeam.research_group.name}
              </div>
            </li>
          </ul>
        </div>
      </div>
    )
  }
}

export default Detail;