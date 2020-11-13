import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import { get, destroy } from '~/containers/ResearchTeams';

class Index extends Component {

    constructor(props) {
        super(props);

        this.state = {
            researchTeams: {}
        }
    }

    componentDidMount() {
        this.getData();
    }

    getData() {
        get().then(data => {
            this.setState({ researchTeams: data });
        })
    }

    handleDelete(e) {
        let id = $(e.target).data('id');
        $('.modal').modal('toggle');
        document.getElementById('btnDelete').onclick = async function(){
            await destroy(id).then(data => {
                console.log(data);
            });
        }
    }
    render() {
        const { researchTeams } = this.state;
        return (
            <div className="container">
                <div className="flex-row">
                    <div className="flex-large">
                        <div className="card">
                            <div className="card-header">
                                <h2>Research teams</h2>
                                <Link to="/app/research-teams/create" className="btn btn-primary">Crear</Link>
                            </div>
                            <table className="table">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Areas de conocimiento</th>
                                        <th>Tematicas de investigacion</th>
                                        <th>Institución educativa</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {researchTeams.length > 0 ? (
                                        researchTeams.map((researchTeam) => (
                                            <tr key={researchTeam.id}>
                                                <td>{researchTeam.name}</td>
                                                <td>{researchTeam.knowledge_areas.map(area => " " + area.name)}</td>
                                                <td>{JSON.parse(researchTeam.thematic_research).map(thematic => thematic)}</td>
                                                <td>{researchTeam.research_group.educational_institution?.name}</td>
                                                <td className="actions">
                                                    <div className="actions-wrapper">
                                                        <Link to={`/app/research-teams/edit/${researchTeam.id}`}>
                                                            Editar
                                                    </Link>
                                                        <Link to={`/app/research-teams/detail/${researchTeam.id}`}>
                                                            Detalle
                                                    </Link>
                                                        <button
                                                            className="btn"
                                                            type="button"
                                                            data-id={researchTeam.id}
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
                                                <td colSpan="6">No research teams</td>
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
        );
    }
}


export default Index;