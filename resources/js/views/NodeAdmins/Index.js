import React, { Component } from 'react';
import { get } from '~/containers/NodeAdmin';
import { Link } from 'react-router-dom';

class Index extends Component {
    
    constructor(props) {
        super(props);

        this.state = {
            nodeAdmins: {},
        }
    }

    componentDidMount(){
        this.getData();
    }

    getData() {
        get().then(data => {
            this.setState({nodeAdmins: data});
        });
    }

    render() {
        const { nodeAdmins } = this.state;
        return (
            <div className="container">
                <div className="flex-row">
                    <div className="flex-large">
                        <div className="card">
                            <div className="card-header">
                                <h2>Node Admins</h2>
                                <Link
                                    to={`/app/node-admins/create`}
                                >Crear administrador de nodo</Link>
                            </div>
                            <table className="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Documento</th>
                                        <th scope="col">Correo electrónico</th>
                                        <th scope="col">Nodo</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {nodeAdmins.length > 0 ? (
                                        nodeAdmins.map(nodeAdmin => (
                                            <tr key={nodeAdmin.user.id}>
                                                <td>{nodeAdmin.user.name}</td>
                                                <td>{nodeAdmin.user.document_type}{nodeAdmin.user.document_number}</td>
                                                <td>{nodeAdmin.user.email}</td>
                                                <td>{nodeAdmin.node?.state}</td>
            
                                                <td className="actions">
                                                    <div className="actions-wrapper">
                                                        <Link
                                                            to={`/app/node-admins/edit/${nodeAdmin.user.id}`}
                                                        >
                                                            Editar
                                                        </Link>
                                                        <Link
                                                            to={`/app/node-admins/detail/${nodeAdmin.user.id}`}
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
                                            <td colSpan="4">No Nodes Admin</td>
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
