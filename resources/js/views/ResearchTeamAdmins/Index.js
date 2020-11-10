import React, {Component} from 'react';
import { get, destroy } from '../../containers/ResearchTeamAdmin';
import { Link } from 'react-router-dom';

class Index extends Component {
    constructor(props) {
        super(props);

        this.state = {
            researchTeamAdmins: {},
        }
    }

    componentDidMount() {
        this.getData();
    }

    handleDelete(e){
        let id = $(e.target).data('id');
        destroy(id).then((data)=>{
            console.log(data);
        })
    }

    getData() {
        get().then(data => {
            this.setState({ researchTeamAdmins: data });
        })
    }
    render() {
        const {researchTeamAdmins} = this.state;
            return (
            <div className="container">
                <div className="flex-row">
                    <div className="flex-large">
                        <div className="card">
                            <div className="card-header">
                                <h2>Research team admins</h2>
                                <Link to="/app/research-team-admins/create" className="btn btn-primary">Crear</Link>
                            </div>
                            <table className="table">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Correo electrónico</th>
                                        <th>Celular</th>
                                        <th>Institución educativa</th>
                                        <th>Semillero</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {researchTeamAdmins.length > 0 ? (
                                        researchTeamAdmins.map((researchTeamAdmin) => (
                                            <tr key={researchTeamAdmin.id}>
                                                <td>{researchTeamAdmin.user.name}</td>
                                                <td>{researchTeamAdmin.user.email}</td>
                                                <td>{researchTeamAdmin.user.cellphone_number}</td>
                                                <td>{researchTeamAdmin.educational_institution.name}</td>
                                                <td>{researchTeamAdmin.is_research_team_admin.name}</td>
                                                <td className="actions">
                                                    <div className="actions-wrapper">
                                                        <Link to={`/app/research-team-admins/edit/${researchTeamAdmin.id}`}>
                                                            Editar
                                                    </Link>
                                                        <Link to={`/app/research-team-admins/detail/${researchTeamAdmin.id}`}>
                                                            Detalle
                                                    </Link>
                                                    
                                                    <button
                                                        className="btn"
                                                        type="button"
                                                        data-id={researchTeamAdmin.id}
                                                        onClick={this.handleDelete}
                                                        disabled={researchTeamAdmin.is_research_team_admin?true:false}
                                                    >
                                                        Eliminar
                                                    </button>
                                                        
                                                    </div>
                                                </td>
                                            </tr>
                                        ))
                                    ) : (
                                            <tr>
                                                <td colSpan="6">No research team admins</td>
                                            </tr>
                                        )
                                    }
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        );   
    }
}

export default Index;