import React, { Component } from 'react';
import { find, rules, check, get as getloans } from '~/containers/ToolLoans';
import Loader from '~/components/Loader';
import moment from 'moment';
import { validate, formValid } from '~/containers/Validator.js'

class Check extends Component {
    constructor(props) {
        super(props);
        this.state = {
            id: props.match.params.id,
            loan: null,
            canAccepted: true,
            requestValidation: {},
            rules,
            touched: {},
        }
        this.handleFocus = this.handleFocus.bind(this);
        this.handleChange = this.handleChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }

    handleSubmit(e) {
        e.preventDefault();
        if (formValid(rules)) {
            check(this.state.id, e.target).then(data => {
                if (data.status === 200) {
                    this.props.history.push('/app/educational-tools/list');
                }
                if (data.status === 422)
                    this.setState({ requestValidation: data.errors });
            });
        } else {
            confirm('Porfavor completa el formulario');
        }
    }

    handleChange(e) {
        const { name, value } = e.target;

        this.setValidation(rules, value);
    }
    handleFocus(e) {
        const { name } = e.target;

        this.setState({ touched: { [name]: true } });
    }
    setValidation(rules, value) {
        let { requestValidation } = this.state;
        let { touched } = this.state;
        const newRules = validate(rules, value, requestValidation, touched);

        this.setState({ rules: newRules });
    }

    async getLoan() {
        let data = await find(this.state.id)
        this.setState({loan: data });
        data = await getloans();
        data.map(d => {
            if (this.state.id != d.id) {
                if(d.educatioanl_tool_id == this.state.loan.educational_tool_id){
                    if(d.loan.is_accepted){
                        this.setState({canAccepted: false});
                        return;
                    }
                }
            }
        });
    }

    componentDidMount() {
        this.getLoan();
        rules.authorization_letter.isInvalid = false;
        rules.start_date.isInvalid = false;
        rules.end_date.isInvalid = false;
        rules.project_id.isInvalid = false;
        rules.justification.isInvalid = false;
        rules.is_accepted.isInvalid = true;
        rules.annotation.isInvalid = true;
        rules.educational_tool_id.isInvalid = false;
    }

    render() {
        const { rules, requestValidation } = this.state;
        if (!this.state.loan ) {
            return <Loader />
        }
        return (
            <div className="container">
                <div className="row">
                    <div className="col">
                        <h3>Solicitud de prestamo del equipo {this.state.loan.educational_tool.name}</h3>
                    </div>
                </div>
                <div className="row mt-4">
                    <div className="col">
                        <h5>Fechas</h5>
                        <h6>{moment(this.state.loan.loan.start_date).format('LL')} al {moment(this.state.loan.loan.end_date).format('LL')}</h6>
                    </div>
                </div>
                <div className="row mt-4">
                    <div className="col">
                        <h5>Proyecto</h5>
                        <h6>{this.state.loan.loan.project.title}</h6>
                    </div>
                </div>
                <div className="row mt-4">
                    <div className="col">
                        <h5>Resposables</h5>
                        <h6>{this.state.loan.loan.project.authors.map(author => author.name)}</h6>
                    </div>
                </div>
                <div className="row mt-4">
                    <div className="col">
                        <h5>Estudiante lider</h5>
                        <h6>{this.state.loan.loan.project.research_teams.map(team => team.pivot.is_principal && team.student_leader_id ? team.student_leader.name : 'No tiene estudiante lider')}</h6>
                    </div>
                </div>
                <div className="row mt-4">
                    <div className="col">
                        <h5>Numero celular de estudiante lider</h5>
                        <h6>{this.state.loan.loan.project.research_teams.map(team => team.pivot.is_principal && team.student_leader_id ? team.student_leader.cellphone_number : 'No tiene estudiante lider')}</h6>
                    </div>
                </div>
                <div className="row mt-4">
                    <div className="col">
                        <h5>Correo electronico de estudiante lider</h5>
                        <h6>{this.state.loan.loan.project.research_teams.map(team => team.pivot.is_principal && team.student_leader_id ? team.student_leader.email : 'No tiene estudiante lider')}</h6>
                    </div>
                </div>
                <div className="row mt-4">
                    <div className="col">
                        <h5>Justificacion</h5>
                        <h6>{this.state.loan.loan.justification}</h6>
                    </div>
                </div>
                <div className="row mt-4">
                    <div className="col">
                        <h5>Carta de autorizacion</h5>
                        <a download href={"/storage/" + this.state.loan.loan.authorization_letter}>{this.state.loan.loan.authorization_letter.split('/')[1]}</a>
                    </div>
                </div>
                <form onSubmit={this.handleSubmit}>
                    <div className="row mt-4">
                        <div className="col">
                            <h5>¿Acepta la solicitud?</h5>
                            {this.state.canAccepted ? (
                                <>
                                    <div className="form-check form-check-inline">
                                        <input
                                            className="form-check-input"
                                            type="radio"
                                            name="is_accepted"
                                            id="inlineRadio1" value="1"
                                            onChange={this.handleChange}
                                            onFocus={this.handleFocus}
                                        />
                                        <label className="form-check-label" htmlFor="inlineRadio1">Si</label>
                                    </div>
                                    <div className="form-check form-check-inline">
                                        <input
                                            className="form-check-input"
                                            type="radio"
                                            name="is_accepted"
                                            id="inlineRadio2"
                                            value="0"
                                            onChange={this.handleChange}
                                            onFocus={this.handleFocus}
                                        />
                                        <label className="form-check-label" htmlFor="inlineRadio2">No</label>
                                    </div>
                                </>
                            ) : (
                                    <p>Hay una solicitud aceptada y no ha sido devuelta</p>
                                )}
                        </div>
                    </div>
                    <div className="row mt-4">
                        <div className="col">
                            <h5>Comentario</h5>
                            <textarea
                                name="annotation"
                                id="annotation"
                                className={rules.annotation.isInvalid && rules.annotation.message != '' || requestValidation.annotation ? 'form-control is-invalid' : 'form-control'}
                                onChange={this.handleChange}
                                onFocus={this.handleFocus}
                            >
                            </textarea>
                            <div className="invalid-feedback">
                                {rules.annotation.message ? rules.annotation.message : requestValidation.annotation ? requestValidation.annotation : ''}
                            </div>
                        </div>
                    </div>
                    <div className="row mt-4">
                        <div className="col">
                            <button className="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        )
    }
}
export default Check;