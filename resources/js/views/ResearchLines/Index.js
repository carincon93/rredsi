import React, { Component } from 'react';
import { get } from '~/containers/ResearchLines';
import { Link } from 'react-router-dom';

class Index extends Component {

    constructor(props) {
        super(props);

        this.state = {
            researchLines: {},
        }
    }

    componentDidMount() {
        this.getData();
    }

    getData(){
        get().then(data => {
            this.setState({researchLines: data});
        });
    }

    render() {
        const { researchLines } = this.state;
    
        return (
            <div className="container">
                <div className="flex-row">
                    <div className="flex-large">
                        <div className="card">
                            <div className="card-header">
                                <h2>Lineas de Investigación</h2>
                                <Link
                                    to={`/app/research-lines/create`}
                                >Crear Linea de Investigación</Link>
                            </div>
                            <table className="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Linea de Investigación</th>
                                        <th scope="col">Grupo de Investigación</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {researchLines.length > 0 ? (
                                        researchLines.map(researchLine => (
                                            <tr key={researchLine.id}>
                                                <td>{researchLine.name}</td>
                                                <td>{researchLine.research_group?.name}</td>
                                                <td className="actions">
                                                    <div className="actions-wrapper">
                                                        <Link
                                                            to={`/app/research-lines/edit/${researchLine.id}`}
                                                        >
                                                            Editar
                                                        </Link>
                                                        <Link
                                                            to={`/app/research-lines/detail/${researchLine.id}`}
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
