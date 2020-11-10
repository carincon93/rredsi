import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import { get, destroy } from '~/containers/EducationalTools';
import { get as getloans, returnLoan } from '~/containers/ToolLoans';
import Loader from '~/components/Loader.js'

class Index extends Component {
    constructor(props) {
        super(props);
        this.state = {
            educationalTools: null,
            loans: null,
        }
        this.handleDelete = this.handleDelete.bind(this);
        this.handleReturn = this.handleReturn.bind(this);
    }

    getLoans() {
        getloans().then(data => {
            let loans = [];
            data.map(d => {
                if(d.loan.is_accepted && !d.loan.is_returned){
                    loans.push(d);
                }
            });
            this.setState({loans});
        })
    }

    getTools() {
        get().then(data => {
            this.setState({ educationalTools: data });
        });
    }

    handleDelete(e) {
        let id = $(e.target).data('id');
        let res = confirm('Estas suguro?');
        if (res) {
            destroy(id).then(data => {
                this.getTools();
            })
        }
    }

    handleReturn(e){
        let id = $(e.target).data('id');
        returnLoan(id).then(data => {
            if(data.success){
                this.props.history.push('/app/educational-tools/loan-returns');
            }
        })
    }

    componentDidMount() {
        this.getTools();
        this.getLoans();
    }

    render() {
        if (!this.state.educationalTools || !this.state.loans) {
            return <Loader />
        }
        return (
            <div className="container">

                <div className="flex-row">
                    <div className="flex-large">
                        <div className="card">
                            <div className="card-header">
                                <h2>Educational Tools</h2>
                                <div className="btn-group" role="group" aria-label="Basic example">
                                    <Link to="/app/educational-tools/create" className="btn btn-primary">Crear</Link>
                                    <Link to="/app/educational-tools/loan-request" className="btn btn-secondary">Solicitudes de prestamos</Link>
                                    <Link to="/app/educational-tools/loan-returns" className="btn btn-secondary">Devoluciones de equipos</Link>
                                </div>
                            </div>
                            <table className="table">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Institucion educativa</th>
                                        <th>Ambiente</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {this.state.educationalTools.length > 0 ? (
                                        this.state.educationalTools.map(educationalTool => (
                                            <tr key={educationalTool.id}>
                                                <td>{educationalTool.name}</td>
                                                <td>{educationalTool.educational_environment.educational_institution.name}</td>
                                                <td>{educationalTool.educational_environment.name}</td>
                                                <td className="actions">
                                                    <div className="actions-wrapper">
                                                        {this.state.loans.find(loan => loan.educational_tool_id === educationalTool.id && !loan.loan.is_returned)?(
                                                            <Link to='#' data-id={this.state.loans.find(loan => loan.educational_tool_id === educationalTool.id && !loan.loan.is_returned).id} onClick={this.handleReturn}>
                                                                Devolver prestamo
                                                            </Link>
                                                        ):(
                                                            <Link to={`/app/educational-tools/request/${educationalTool.id}`}>
                                                                Solicitar prestamo
                                                            </Link>
                                                        )}
                                                        <Link to={`/app/educational-tools/edit/${educationalTool.id}`}>
                                                            Editar
                                                        </Link>
                                                        <Link to={`/app/educational-tools/detail/${educationalTool.id}`}>
                                                            Detalle
                                                        </Link>
                                                        <button
                                                            className="btn"
                                                            type="button"
                                                            data-id={educationalTool.id}
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
                                                <td colSpan="4" className="text-center">
                                                    No hay datos disponibles
                                            </td>
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
        );
    }
}
export default Index;