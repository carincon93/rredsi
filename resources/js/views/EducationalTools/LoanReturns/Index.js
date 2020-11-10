import React, { Component } from 'react';
import Loader from '~/components/Loader.js';
import { get } from '~/containers/ToolLoans';
import { Link } from 'react-router-dom';

class Index extends Component {
    constructor(props) {
        super(props);
        this.state = {
            loans: null
        }
    }

    getLoans(){
        get().then(data => {
            let loans = [];
            data.map(d => {
                if(d.loan.is_returned && d.loan.returned_at && !d.loan.accepted_at){
                    loans.push(d);
                }
            });
            this.setState({loans});
        })
    }

    componentDidMount(){
        this.getLoans();
    }

    render() {
        if(!this.state.loans){
            return (
                <Loader />
            )
        }
        return (
            <div className="container">
                <div className="flex-row">
                    <div className="flex-large">
                        <div className="card">
                            <div className="card-header">
                                <h2>Educational Tools Loan Returns</h2>
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
                                    {this.state.loans.length>0?(
                                        this.state.loans.map(loan => (
                                            <tr key={loan.id}>
                                                <td>{loan.educational_tool.name}</td>
                                                <td>{loan.educational_tool.educational_environment.educational_institution.name}</td>
                                                <td>{loan.educational_tool.educational_environment.name}</td>
                                                <td className="actions">
                                                    <div className="actions-wrapper">
                                                        <Link to={`/app/educational-tools/return-check/${loan.id}`}>
                                                            Revisar devolucion
                                                        </Link>
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