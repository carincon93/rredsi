import React, { Component } from 'react';
import { get } from '~/containers/KnowledgeAreas';
import { Link } from 'react-router-dom';

class Index extends Component {

    constructor(props) {
        super(props);

        this.state = {
            knowledgeAreas: {}
        }
    }

    componentDidMount() {
        this.getData();
    }

    getData() {
        get().then(data => {
            this.setState({knowledgeAreas: data});
        });
    }

    render() {
        const { knowledgeAreas } = this.state;
        return (
            <div className="container">
                <div className="flex-row">
                    <div className="flex-large">
                        <div className="card">
                            <div className="card-header">
                                <h2>Areas de Conocimiento</h2>
                                <Link
                                    to={`/app/knowledge-areas/create`}
                                >Crar Área de Conocimiento</Link>
                            </div>
                            <table className="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Código</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    {knowledgeAreas.length > 0 ? (
                                        knowledgeAreas.map(knowledgeArea => (
                                            <tr key={knowledgeArea.id}>
                                                <td>{knowledgeArea.name}</td>
                                                <td>{knowledgeArea.id}</td>

                                                <td className="actions">
                                                    <div className="actions-wrapper">
                                                        <Link
                                                            to={`/app/knowledge-areas/edit/${knowledgeArea.id}`}
                                                        >
                                                            Editar
                                                        </Link>
                                                        <Link
                                                            to={`/app/knowledge-areas/detail/${knowledgeArea.id}`}
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
                                            <td colSpan="4">No knowledge Area</td>
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
