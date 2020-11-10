import React, { Component } from 'react';
import { get } from '~/containers/AcademicPrograms';
import { Link } from 'react-router-dom';

class Index extends Component {

    constructor(props) {
        super(props);

        this.state = {
            academicPrograms: {}
        }
    }

    componentDidMount() {
        this.getData();
    }

    getData() {
        get().then(data => {
            this.setState({academicPrograms: data});
        });
    }

    render() {
        const { academicPrograms } = this.state;
        return (
            <div className="container">
                <div className="flex-row">
                    <div className="flex-large">
                        <div className="card">
                            <div className="card-header">
                                <h2>Programas de Formación</h2>
                                <Link
                                    to={`/app/academic-programs/create`}
                                >Crar Programa de Formación</Link>
                            </div>
                            <table className="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Código</th>
                                        <th scope="col">Institución Educativa</th>
                                        <th scope="col">Nivel Acádemico</th>
                                        <th scope="col">Acciones</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    {academicPrograms.length > 0 ? (
                                        academicPrograms.map(academicProgram => (
                                            <tr key={academicProgram.id}>
                                                <td>{academicProgram.name}</td>
                                                <td>{academicProgram.code}</td>
                                                <td>{academicProgram.educational_institution.name}</td>
                                                <td>{academicProgram.academic_level}</td>
                                            

                                                <td className="actions">
                                                    <div className="actions-wrapper">
                                                        <Link
                                                            to={`/app/academic-programs/edit/${academicProgram.id}`}
                                                        >
                                                            Editar
                                                        </Link>
                                                        <Link
                                                            to={`/app/academic-programs/detail/${academicProgram.id}`}
                                                        >
                                                            Detail
                                                        </Link>
                                                        <button
                                                            className="btn"
                                                            type="button"
                                                        >
                                                            Eliminar
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        ))
                                    ) : (
                                        <tr>
                                            <td colSpan="4">No Academic Programs</td>
                                        </tr>
                                    )}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        )
    }
}

export default Index;
