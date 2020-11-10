import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import { get } from '~/containers/EnvironmentLoans'
import moment from 'moment';
moment.locale('es');

class Index extends Component {
    constructor(props) {
        super(props);
        this.state = {
            educationalEnvironmentRequestLoans: null
        }
    }
    componentDidMount() {
        this.getLoans();
    }
    getLoans() {
        get().then(data => {
            console.log(data);
            this.setState({ educationalEnvironmentRequestLoans: data });
        })
    }

    render() {
        if (!this.state.educationalEnvironmentRequestLoans) {
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
                                <h2>Educational Environments Request Loans</h2>
                            </div>
                            <table className="table">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Institucion educativa</th>
                                        <th>Tipo de ambiente</th>
                                        <th>Fecha inicio</th>
                                        <th>Fecha fin</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {this.state.educationalEnvironmentRequestLoans.length > 0 ? (
                                        this.state.educationalEnvironmentRequestLoans.map(loan => (
                                            <tr key={loan.id}>
                                                <td>{loan.educational_environment.name}</td>
                                                <td>{loan.educational_environment.educational_institution.name}</td>
                                                <td>{loan.educational_environment.type}</td>
                                                <td>{moment(loan.loan.start_date).format('LL')}</td>
                                                <td>{moment(loan.loan.end_date).format('LL')}</td>
                                                <td className="actions">
                                                    <div className="actions-wrapper">
                                                        {loan.loan.is_accepted?(
                                                            loan.loan.is_returned?(
                                                                <p>Devuelto</p>
                                                            ):(
                                                                <p>Solicitud aceptada</p>
                                                            )
                                                        ):(
                                                            <Link to={`/app/educational-environments/check/${loan.id}`}>
                                                                Revisar solicitud
                                                            </Link>
                                                        )}
                                                    </div>
                                                </td>
                                            </tr>
                                        ))
                                    ) : (
                                            <tr>
                                                <td colSpan="4">No environment loan requests</td>
                                            </tr>
                                        )}
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