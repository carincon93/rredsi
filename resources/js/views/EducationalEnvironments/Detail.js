import React, { Component } from 'react';
import { find } from '~/containers/EducationalEnvironments';
import {Link} from 'react-router-dom';

class Detail extends Component {
    constructor(props) {
        super(props);
        this.state = {
            id: props.match.params.id,
            educationalEnvironment: null
        }
    }
    componentDidMount() {
        this.getEducationalEnvironment();
    }
    getEducationalEnvironment() {
        find(this.state.id, 'show').then(data => {
            this.setState({ educationalEnvironment: data });
        });
    }
    render() {
        if(this.state.educationalEnvironment === null){
            return (
                <p>Cargando...</p>
            )
        }
        return (
            <div className="container">
                <div className="card p-4 detail">
                    <div className="card-header">
                        <h4>{this.state.educationalEnvironment.name}</h4>
                        <Link to={`/app/educational-institution-admins/edit/${this.state.educationalEnvironment.id}`}>
                            Editar
                    </Link>
                    </div>
                    <hr />
                    <ul className="list-unstyled">
                        <li className="media">
                            <img className="mr-3" src="" alt="circle" />
                            <div className="media-body">
                                <h5 className="mt-0 mb-1">Tipo</h5>
                                {this.state.educationalEnvironment.type}
                            </div>
                        </li>
                        <li className="media my-4">
                            <img className="mr-3" src="" alt="circle" />
                            <div className="media-body">
                                <h5 className="mt-0 mb-1">Descripcion</h5>
                                {this.state.educationalEnvironment.description}
                            </div>
                        </li>
                        <li className="media my-4">
                            <img className="mr-3" src="" alt="circle" />
                            <div className="media-body">
                                <h5 className="mt-0 mb-1">Capacidad aproximada</h5>
                                {this.state.educationalEnvironment.capacity_aprox}
                            </div>
                        </li>
                        <li className="media my-4">
                            <img className="mr-3" src="" alt="circle" />
                            <div className="media-body">
                                <h5 className="mt-0 mb-1">Esta habilitado?</h5>
                                {this.state.educationalEnvironment.is_enabled?'Si':'No'}
                            </div>
                        </li>
                        <li className="media my-4">
                            <img className="mr-3" src="" alt="circle" />
                            <div className="media-body">
                                <h5 className="mt-0 mb-1">Esta disponible?</h5>
                                {this.state.educationalEnvironment.is_available?'Si':'No'}
                            </div>
                        </li>
                        <li className="media my-4">
                            <img className="mr-3" src="" alt="circle" />
                            <div className="media-body">
                                <h5 className="mt-0 mb-1">Institución educativa</h5>
                                {this.state.educationalEnvironment.educational_institution.name}
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        )
    }
}
export default Detail;