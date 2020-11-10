import React, { Component } from 'react';
import { get } from '~/containers/EducationalInstitutionAdmin';
import { Link } from 'react-router-dom';

class Index extends Component {

    constructor(props) {
        super(props);

        this.state = {
            educationalInstitutionAdmins: {}
        }
    }
    
    componentDidMount() {
        this.getData();
    }

    getData(){
        get().then(data => {
            this.setState({educationalInstitutionAdmins: data});
        });
    }

    render() {
        const { educationalInstitutionAdmins } = this.state;
        return (
            <div className="container">
                <div className="flex-row">
                    <div className="flex-large">
                        <div className="card">
                            <div className="card-header">
                                <h2>Educational Institution Admin</h2>
                                <Link
                                    to={`/app/educational-institution-admins/create`}
                                >Crear administrador de institución educativa</Link>
                            </div>
                            <table className="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Correo electrónico</th>
                                        <th scope="col">Celular</th>
                                        <th scope="col">Institución Educativa</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {educationalInstitutionAdmins.length > 0 ? (
                                        educationalInstitutionAdmins.map((educationalInstitutionAdmin) => (
                                            <tr key={educationalInstitutionAdmin.user.id}>
                                                <td>{educationalInstitutionAdmin.user.name}</td>
                                                <td>{educationalInstitutionAdmin.user.email}</td>
                                                <td>{educationalInstitutionAdmin.user.cellphone_number}</td>
                                                <td>{educationalInstitutionAdmin.educational_institution?.name}</td>
                                                <td className="actions">
                                                    <div className="actions-wrapper">
                                                        <Link
                                                            to={`/app/educational-institution-admins/edit/${educationalInstitutionAdmin.id}`}
                                                        >
                                                            Editar
                                                        </Link>
                                                        <Link
                                                            to={`/app/educational-institution-admins/detail/${educationalInstitutionAdmin.id}`}
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
                                            <td colSpan="4">No Educational Institution Admins</td>
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
