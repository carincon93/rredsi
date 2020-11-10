import React, { Component } from 'react';
import { get } from '~/containers/ResearchGroup';
import { Link } from 'react-router-dom';

class Index extends Component {

    constructor(props) {
        super(props);

        this.state = {
            researchGroups: {},
        }
    }

    componentDidMount() {
        this.getData();
    }

    getData(){
        get().then(data => {
            this.setState({researchGroups: data});
        });
    }

    render() {
        const { researchGroups } = this.state;
    
        return (
            <div className="container">
                <div className="flex-row">
                    <div className="flex-large">
                        <div className="card">
                            <div className="card-header">
                                <h2>Grupos de Investigación</h2>
                                <Link
                                    to={`/app/research-groups/create`}
                                >Crear Grupo de investigación</Link>
                            </div>
                            <table className="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Ubicación</th>
                                        <th scope="col">Institución Educativa</th>
                                        <th scope="col">GrupLac</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {researchGroups.length > 0 ? (
                                        researchGroups.map(researchGroup => (
                                            <tr key={researchGroup.id}>
                                                <td>{researchGroup?.name}</td>
                                                <td>{researchGroup.educational_institution?.address}</td>
                                                <td>{researchGroup.educational_institution?.name}</td>
                                                <td>{researchGroup.gruplac} </td>
                                                <td className="actions">
                                                    <div className="actions-wrapper">
                                                        <Link
                                                            to={`/app/research-groups/edit/${researchGroup.id}`}
                                                        >
                                                            Editar
                                                        </Link> 
                                                        <Link
                                                            to={`/app/research-groups/detail/${researchGroup.id}`}
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
                                            <td colSpan="4">No Research Lines</td>
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
