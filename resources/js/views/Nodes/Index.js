import React, { Component } from 'react';
import { get } from '~/containers/Node';
import { Link } from 'react-router-dom';

class Index extends Component {

    constructor(props) {
        super(props);

        this.state = {
            nodes: {},
        }
    }

    componentDidMount() {
        this.getData();
    }

    getData(){
        get().then(data => {
            this.setState({nodes: data});
        });
    }

    render() {
        const { nodes } = this.state;
    
        return (
            <div className="container">
                <div className="flex-row">
                    <div className="flex-large">
                        <div className="card">
                            <div className="card-header">
                                <h2>Nodes</h2>
                                <Link
                                    to={`/app/nodes/create`}
                                >Crear Nodo</Link>
                            </div>
                            <table className="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Nodo</th>
                                        <th scope="col">Administrador</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {nodes.length > 0 ? (
                                        nodes.map(node => (
                                            <tr key={node.id}>
                                                <td>{node.state}</td>
                                                <td>{node.administrator?.user?.name}</td>
                                                <td className="actions">
                                                    <div className="actions-wrapper">
                                                        <Link
                                                            to={`/app/nodes/edit/${node.id}`}
                                                        >
                                                            Editar
                                                        </Link>
                                                        <Link
                                                            to={`/app/nodes/detail/${node.id}`}
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
                                            <td colSpan="4">No Nodes</td>
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
