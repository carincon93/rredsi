import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import { get as getEnvironmentsLoans } from '~/containers/EnvironmentLoans';

class Index extends Component {
    constructor(props) {
        super(props);

        this.state = {
            educationalEnvironmentsWithLoans: null
        }
    }

    componentDidMount() {
        this.getData();
    }

    getData() {
        getEnvironmentsLoans().then(data => {
            let loans = [];
            data.map(d => {
                if (d.loan.is_accepted && d.loan.is_returned) {
                    loans.push(d);
                }
            });
            this.setState({ educationalEnvironmentsWithLoans: loans });
        })
    }

    render() {
        if (!this.state.educationalEnvironmentsWithLoans) {
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
                <div className="flex-row">
                    <div className="flex-large">
                        <div className="card">
                            <div className="card-header">
                                <h2>Educational Environments Loan Returns</h2>
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
                                    {this.state.educationalEnvironmentsWithLoans.length > 0 ? (
                                        this.state.educationalEnvironmentsWithLoans.map(loan => (
                                            <tr key={loan.id}>
                                                <td>{loan.educational_environment.name}</td>
                                                <td>{loan.educational_environment.educational_institution.name}</td>
                                                <td>{loan.educational_environment.type}</td>
                                                <td className="actions">
                                                    <div className="actions-wrapper">
                                                        {loan.loan.returned_at && loan.loan.is_returned ?(
                                                            <p>Devuelto</p>
                                                        ):(
                                                            <Link to={`/app/educational-environments/return-check/${loan.id}`}>
                                                                Revisar devolucion
                                                            </Link>
                                                        )}
                                                    </div>
                                                </td>
                                            </tr>
                                        ))
                                    ) : (
                                            <tr>
                                                <td colSpan="6">No educational environments loan returns</td>
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