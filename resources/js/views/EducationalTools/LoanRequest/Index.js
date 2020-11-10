import React, {Component} from 'react';
import Loader from '~/components/Loader.js';
import {get} from '~/containers/ToolLoans';
import { Link } from 'react-router-dom';


class Index extends Component{
    constructor(props){
        super(props);
        this.state = {
            loanRequests: null
        }
    }

    getLoans(){
        get().then(data => {
            this.setState({loanRequests: data});
        })
    }

    componentDidMount(){
        this.getLoans();
    }

    render(){
        if(!this.state.loanRequests){
            return <Loader />
        }
        return (
            <div className="container">
                <div className="flex-row">
                    <div className="flex-large">
                        <div className="card">
                            <div className="card-header">
                                <h2>Educational Tools Loan Requests</h2>
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
                                    {this.state.loanRequests.length>0?(
                                        this.state.loanRequests.map(loanRequest => (
                                            <tr key={loanRequest.id}>
                                                <td>{loanRequest.educational_tool.name}</td>
                                                <td>{loanRequest.educational_tool.educational_environment.educational_institution.name}</td>
                                                <td>{loanRequest.educational_tool.educational_environment.name}</td>
                                                <td className="actions">
                                                    <div className="actions-wrapper">
                                                        {loanRequest.loan.is_accepted?(
                                                            <p>Solicitud aceptada</p>
                                                        ):(
                                                            <Link to={`/app/educational-tools/check/${loanRequest.id}`}>
                                                                Revisar solicitud
                                                            </Link>
                                                        )}
                                                    </div>
                                                </td>
                                            </tr>
                                        ))
                                    ):(
                                        <tr>
                                            <td colSpan="4" className="text-center">No hay datos disponibles</td>
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