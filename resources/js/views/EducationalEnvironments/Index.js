import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import { get as getEnvironmentsLoans, returnLoan } from '~/containers/EnvironmentLoans';
import { get, destroy } from '~/containers/EducationalEnvironments';

class Index extends Component {
    constructor(props) {
        super(props);

        this.state = {
            educationalEnvironments: null,
            educationalEnvironmentsWithLoans:null
        }
        this.handleDelete = this.handleDelete.bind(this);
        this.handleReturn = this.handleReturn.bind(this);
    }

    componentDidMount() {
        this.getData();
    }

    getData() {
        getEnvironmentsLoans().then(data => {
            let loans = [];
            data.map(d => {
                if(d.loan.is_accepted && !d.loan.is_returned){
                    loans.push(d);
                }
            });
            this.setState({educationalEnvironmentsWithLoans:loans});
        })
        get().then(data => {
            this.setState({ educationalEnvironments: data })
        });
    }

    handleDelete(e) {
        let id = $(e.target).data('id');
        destroy(id).then(data => {
            if (data.status === 200) {
                this.getData();
            }
        })
    }

    handleReturn(e) {
        let id = $(e.target).data('id');
        returnLoan(id).then(data => {
            if(data.success){
                this.props.history.push('/app/educational-environments/loan-returns');
            }
        })
    }

    render() {
        if (!this.state.educationalEnvironments || !this.state.educationalEnvironmentsWithLoans) {
            return (
                <div className="container">
                    <div className="row">
                        <div className="col-6 mx-auto text-center">
                            <p>Cargando...</p>
                            <div className="spinner-border text-primary" role="status">
                                <span className="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            )
        }
        return (
            <div className="container">
            {console.log(this.state.educationalEnvironmentsWithLoans)}
                <div className="flex-row">
                    <div className="flex-large">
                        <div className="card">
                            <div className="card-header">
                                <h2>Educational Environments</h2>
                                <div className="btn-group" role="group" aria-label="Basic example">
                                    <Link to="/app/educational-environments/create" className="btn btn-primary">Crear</Link>
                                    <Link to="/app/educational-environments/loan-request" className="btn btn-secondary">Solicitudes de prestamos</Link>
                                    <Link to="/app/educational-environments/loan-returns" className="btn btn-secondary">Devoluciones de ambientes</Link>
                                </div>
                            </div>
                            <table className="table">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Institucion educativa</th>
                                        <th>Tipo de ambiente</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {this.state.educationalEnvironments.length > 0 ? (
                                        this.state.educationalEnvironments.map((educationalEnvironment) => (
                                            <tr key={educationalEnvironment.id}>
                                                <td>{educationalEnvironment.name}</td>
                                                <td>{educationalEnvironment.educational_institution.name}</td>
                                                <td>{educationalEnvironment.type}</td>
                                                <td className="actions">
                                                    <div className="actions-wrapper">
                                                        {this.state.educationalEnvironmentsWithLoans.find(o => o.educational_environment_id === educationalEnvironment.id && !o.loan.returned_at)?(
                                                            <Link to="#" data-id={this.state.educationalEnvironmentsWithLoans.find(o => o.educational_environment_id === educationalEnvironment.id).id} onClick={this.handleReturn}>Devolver</Link>
                                                        ):(
                                                            <Link to={`/app/educational-environments/request/${educationalEnvironment.id}`}>
                                                                Solicitar prestamo
                                                            </Link>
                                                        )}
                                                        <Link to={`/app/educational-environments/edit/${educationalEnvironment.id}`}>
                                                            Editar
                                                        </Link>
                                                        <Link to={`/app/educational-environments/detail/${educationalEnvironment.id}`}>
                                                            Detalle
                                                        </Link>
                                                        <button
                                                            className="btn"
                                                            type="button"
                                                            data-id={educationalEnvironment.id}
                                                            onClick={this.handleDelete}
                                                        >
                                                            Eliminar
                                                    </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        ))
                                    ) : (
                                            <tr>
                                                <td colSpan="6">No educational environments</td>
                                            </tr>
                                        )
                                    }
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div className="modal" tabIndex="-1" role="dialog">
                    <div className="modal-dialog">
                        <div className="modal-content">
                            <div className="modal-header">
                                <h5 className="modal-title">Estas seguro?</h5>
                                <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div className="modal-body">
                                <p>No podras revertir esto.</p>
                            </div>
                            <div className="modal-footer">
                                <button type="button" className="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="button" className="btn btn-danger" id="btnDelete">Si, eliminar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        )
    }
}

export default Index;