import React, { Component } from 'react';
import { find } from '~/containers/AcademicPrograms';
import { Link } from 'react-router-dom';

class Detail extends Component {

    constructor(props) {
        super(props);

        this.state = {
            id: props.match.params.id,
            academicProgram: {},
        }
    }

    componentDidMount() {
        this.getAcademicProgram();
    }

    getAcademicProgram() {
        find(this.state.id, 'show').then(data => {
            this.setState({ academicProgram: data });
            console.log(data)
        })
    }

    render() {

        const { academicProgram } = this.state;
        return (
            <div className="container">
                <div className="card p-4 detail">
                    <div className="card-header">
                        <h4>{academicProgram.name}</h4>
                        <Link to={`/app/academic-programs/edit/${academicProgram.id}`}>
                            Editar
                        </Link>
                    </div>
                    <hr />
                    <ul className="list-unstyled">
                        <li className="media">
                            <img className="mr-3" src="" alt="circle" />
                            <div className="media-body">
                                <h5 className="mt-0 mb-1">Código</h5>
                                {academicProgram.code}
                            </div>
                        </li>
                        <li className="media my-4">
                            <img className="mr-3" src="" alt="circle" />
                            <div className="media-body">
                                <h5 className="mt-0 mb-1">Nivel de Formacion</h5>
                                {academicProgram.academic_level}
                            </div>
                        </li>
                        <li className="media my-4">
                            <img className="mr-3" src="" alt="circle" />
                            <div className="media-body">
                                <h5 className="mt-0 mb-1">Modalidad</h5>
                                {academicProgram.modality}
                            </div>
                        </li>
                        <li className="media my-4">
                            <img className="mr-3" src="" alt="circle" />
                            <div className="media-body">
                                <h5 className="mt-0 mb-1">Jornada</h5>
                                {academicProgram.daytime}
                            </div>
                        </li>
                        <li className="media my-4">
                            <img className="mr-3" src="" alt="circle" />
                            <div className="media-body">
                                <h5 className="mt-0 mb-1">Institución Educativa</h5>
                                {academicProgram.educational_institution_id}
                            </div>
                        </li>
                        <li className="media my-4">
                            <img className="mr-3" src="" alt="circle" />
                            <div className="media-body">
                                <h5 className="mt-0 mb-1">Fechas</h5>
                                {academicProgram.start_date} al {academicProgram.end_date} 
                            </div>
                        </li>
                        <li className="media my-4">
                            <img className="mr-3" src="" alt="circle" />
                            <div className="media-body">
                                <h5 className="mt-0 mb-1">Facultad</h5>
                                facu
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        )
    }
}

export default Detail;