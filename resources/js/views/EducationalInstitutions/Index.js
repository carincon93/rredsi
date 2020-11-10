import React, { Component } from 'react';
import { get } from '~/containers/EducationalInstitution';
import { Link } from 'react-router-dom';

class Index extends Component {

    constructor(props) {
        super(props);

        this.state = {
            educationalInstitutions: {}
        }
    }

    componentDidMount() {
        this.getData();
    }

    getData() {
        get().then(data => {
            this.setState({educationalInstitutions: data});
        });
    }

    render() {
        const { educationalInstitutions } = this.state;
        return (
            <div className="container">
                <div className="flex-row">
                    <div className="flex-large">
                        <div className="card">
                            <div className="card-header">
                                <h2>Educational Institutions</h2>
                                <Link
                                    to={`/app/educational-institutions/create`}
                                >Institución educativa</Link>
                            </div>
                            <table className="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Institución Educativa</th>
                                        <th scope="col">Municipio / Departamento</th>
                                        <th scope="col">Administrador</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {educationalInstitutions.length > 0 ? (
                                        educationalInstitutions.map(educationalInstitution => (
                                            <tr key={educationalInstitution.id}>
                                                <td>{educationalInstitution.name}</td>
                                                <td>{educationalInstitution.city}</td>
                                                <td>{educationalInstitution.administrator?.user?.name}</td>
                                                <td className="actions">
                                                    <div className="actions-wrapper">
                                                        <Link
                                                            to={`/app/educational-institutions/edit/${educationalInstitution.id}`}
                                                        >
                                                            Editar
                                                        </Link>
                                                        <Link
                                                            to={`/app/educational-institutions/detail/${educationalInstitution.id}`}
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
                                            <td colSpan="4">No Educational Institutions</td>
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
