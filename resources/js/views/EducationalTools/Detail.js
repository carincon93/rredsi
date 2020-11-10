import React, { Component } from 'react';
import {find} from '~/containers/EducationalTools';
import Loader from '~/components/Loader.js';
import { Link } from 'react-router-dom';

class Detail extends Component{
    constructor(props){
        super(props);
        this.state = {
            id: props.match.params.id,
            educationalTool: null
        }
    }
    getEducationTool(){
        find(this.state.id).then(data => {
            this.setState({educationalTool: data});
        })
    }
    componentDidMount(){
        this.getEducationTool();
    }
    render(){
        if(!this.state.educationalTool){
            return <Loader />
        }
        return (
            <div className="container">
                <div className="row">
                    <div className="col">
                        <h3>{this.state.educationalTool.name}</h3>
                    </div>
                    <div className="col-2 text-right">
                        <Link to={`/app/educational-tools/edit/${this.state.educationalTool.id}`}>Editar</Link>
                    </div>
                </div>
                <hr/>
                <div className="row mb-3">
                    <div className="col">
                        <h5>Cantidad</h5>
                        <h6>{this.state.educationalTool.qty}</h6>
                    </div>
                </div>
                <div className="row mb-3">
                    <div className="col">
                        <h5>Institucion educativa</h5>
                        <h6>{this.state.educationalTool.educational_environment.educational_institution.name}</h6>
                    </div>
                </div>
                <div className="row mb-3">
                    <div className="col">
                        <h5>Descripcion</h5>
                        <h6>{this.state.educationalTool.description}</h6>
                    </div>
                </div>
                <div className="row mb-3">
                    <div className="col">
                        <h5>¿Esta habilitado?</h5>
                        <h6>{this.state.educationalTool.is_enabled?'Si':'No'}</h6>
                    </div>
                </div>
                <div className="row mb-3">
                    <div className="col">
                        <h5>¿Esta disponible?</h5>
                        <h6>{this.state.educationalTool.is_available?'Si':'No'}</h6>
                    </div>
                </div>
                <div className="row mb-3">
                    <div className="col">
                        <h5>Ambiente</h5>
                        <h6>{this.state.educationalTool.educational_environment.name}</h6>
                    </div>
                </div>
            </div>
        )
    }
}

export default Detail;