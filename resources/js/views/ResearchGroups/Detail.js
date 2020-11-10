import React, { Component } from 'react';
import { find } from '~/containers/ResearchGroup';
import { Link } from 'react-router-dom';

class Detail extends Component {

    constructor(props) {
        super(props);

        this.state = {
            id: props.match.params.id,
            researchGroup: {},
        }
    }

    componentDidMount() {
        this.getResearchGroup();
    }

    getResearchGroup() {
        find(this.state.id, 'show').then(data => {
            this.setState({ researchGroup: data });
        })
    }

    render() {
        const { researchGroup } = this.state;
        return (
            <div className="container">
                <div className="card p-4 detail">
                    <div className="card-header">
                        <h4>{researchGroup.name}</h4>
                        <Link to={`/app/research-groups/edit/${researchGroup.id}`}>
                            Editar
              </Link>
                    </div>
                    <hr />
                    <ul className="list-unstyled">
                        <li className="media">
                            <img className="mr-3" src="" alt="circle" />
                            <div className="media-body">
                                <h5 className="mt-0 mb-1">Correo Electronico</h5>
                                {researchGroup.email}
                            </div>
                        </li>
                        <li className="media my-4">
                            <img className="mr-3" src="" alt="circle" />
                            <div className="media-body">
                                <h5 className="mt-0 mb-1">Lider</h5>
                                {researchGroup.leader}
                            </div>
                        </li>
                        <li className="media my-4">
                            <img className="mr-3" src="" alt="circle" />
                            <div className="media-body">
                                <h5 className="mt-0 mb-1">Enlace del GrupLac</h5>
                                {researchGroup.gruplac}
                            </div>
                        </li>
                        <li className="media my-4">
                            <img className="mr-3" src="" alt="circle" />
                            <div className="media-body">
                                <h5 className="mt-0 mb-1">Código de minciencias</h5>
                                {researchGroup.minciencias_code}
                            </div>
                        </li>
                        <li className="media my-4">
                            <img className="mr-3" src="" alt="circle" />
                            <div className="media-body">
                                <h5 className="mt-0 mb-1">Categoría </h5>
                                {researchGroup.minciencias_category}
                            </div>
                        </li>
                        <li className="media my-4">
                            <img className="mr-3" src="" alt="circle" />
                            <div className="media-body">
                                <h5 className="mt-0 mb-1">Sitio Web</h5>
                                {researchGroup.website}
                            </div>
                        </li>
                        <li className="media my-4">
                            <img className="mr-3" src="" alt="circle" />
                            <div className="media-body">
                                <h5 className="mt-0 mb-1">Institución Educativa</h5>
                                {/* {researchGroup?.educational_institution?.name} */}
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        )
    }
}

export default Detail;