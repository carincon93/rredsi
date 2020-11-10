import React, { Component } from 'react';
import { find } from '~/containers/ResearchLines';
import { Link } from 'react-router-dom';

class Detail extends Component {

    constructor(props) {
        super(props);

        this.state = {
            id: props.match.params.id,
            researchLine: {},
        }
    }

    componentDidMount() {
        this.getResearchLine();
    }

    getResearchLine() {
        find(this.state.id, 'show').then(data => {
            this.setState({ researchLine: data });
        })
    }

    render() {
        const { researchLine } = this.state;
        return (
            <div className="container">
                <div className="card p-4 detail">
                    <div className="card-header">
                        <h4>{researchLine.name}</h4>
                        <Link to={`/app/research-groups/edit/${researchLine.id}`}>
                            Editar
              </Link>
                    </div>
                    <hr />
                    <ul className="list-unstyled">
                        <li className="media">
                            <img className="mr-3" src="" alt="circle" />
                            <div className="media-body">
                                <h5 className="mt-0 mb-1">Objetivos</h5>
                                {researchLine.objectives}
                            </div>
                        </li>
                        <li className="media my-4">
                            <img className="mr-3" src="" alt="circle" />
                            <div className="media-body">
                                <h5 className="mt-0 mb-1">Misión</h5>
                                {researchLine.mission}
                            </div>
                        </li>
                        <li className="media my-4">
                            <img className="mr-3" src="" alt="circle" />
                            <div className="media-body">
                                <h5 className="mt-0 mb-1">Visión</h5>
                                {researchLine.vision}
                            </div>
                        </li>
                        <li className="media my-4">
                            <img className="mr-3" src="" alt="circle" />
                            <div className="media-body">
                                <h5 className="mt-0 mb-1">Logros</h5>
                                {researchLine.achievements}
                            </div>
                        </li>
                        <li className="media my-4">
                            <img className="mr-3" src="" alt="circle" />
                            <div className="media-body">
                                <h5 className="mt-0 mb-1">Áreas de Conocimiento </h5>
                                {researchLine.minciencias_category}
                            </div>
                        </li>
                        <li className="media my-4">     
                            <img className="mr-3" src="" alt="circle" />
                            <div className="media-body">
                                <h5 className="mt-0 mb-1">Grupo de investigacion</h5>
                                {researchLine.website}
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        )
    }
}

export default Detail;