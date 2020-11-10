import React, { Component } from 'react';
import { find, check, get as getLoans, rules } from '~/containers/EnvironmentLoans.js'
import { get } from '~/containers/EducationalEnvironments';
import { get as getProjects } from '~/containers/Projects';
import moment from 'moment';
moment.locale('es');
import {validate, formValid} from '~/containers/Validator';

class Check extends Component {
    constructor(props) {
        super(props);
        this.state = {
            id: props.match.params.id,
            loan: null,
            principal_research_team: null,
            educationalEnvironments: null,
            projects: null,
            canAcepted: true,
            touched: {},
            requestValidation: {},
            rules,
        }
        this.handleSubmit = this.handleSubmit.bind(this);
        this.handleChange = this.handleChange.bind(this);
        this.handleFocus = this.handleFocus.bind(this);
    }
    getLoan() {
        getLoans().then(data => {
            data.map(d => {
                if (this.state.id != d.id) {
                    if (d.loan.is_accepted && !d.loan.is_returned) {
                        this.setState({ canAcepted: false });
                        return;
                    }
                }
            })
        })
        find(this.state.id).then(data => {
            data.loan.project.research_teams.map(research_team => {
                if (research_team.pivot.is_principal) {
                    this.setState({ principal_research_team: research_team });
                    return;
                }
            });
            this.setState({ loan: data });
        })
    }
    getEducationalEnvironments() {
        get().then(data => {
            this.setState({ educationalEnvironments: data });
        })
    }
    getProjects() {
        getProjects().then(data => {
            this.setState({ projects: data });
        })
    }
    handleSubmit(e) {
        e.preventDefault();
        if(formValid(rules)){
            check(e.target, this.state.id).then(data => {
                if(data.success){
                    this.props.history.push('/app/educational-environments/list');
                }
                if (data.annotation) {
                    confirm(data.annotation);
                }
                if (data.is_accepted) {
                    confirm(data.is_accepted);
                }
            })
        }else{
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

    componentDidMount() {
        this.getLoan();
        this.getEducationalEnvironments();
        this.getProjects();
        rules.authorization_letter.isInvalid = false;
        rules.educational_environment_id.isInvalid = false;
        rules.end_date.isInvalid = false;
        rules.start_date.isInvalid = false;
        rules.justification.isInvalid = false;
        rules.project_id.isInvalid = false;
    }
    render() {
        const {rules, requestValidation} = this.state;
        if (!this.state.loan || !this.state.educationalEnvironments || !this.state.projects || !this.state.principal_research_team) {
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
                <h3>Solicitud de prestamo del ambiente {this.state.loan.educational_environment.name}</h3>
                <hr />
                <div className="row">
                    <div className="col">
                        <label htmlFor="">Fechas</label>
                        <p className="text-muted">{moment(this.state.loan.loan.start_date).format('LL')} al {moment(this.state.loan.loan.end_date).format('LL')}</p>
                        <label htmlFor="">Proyecto</label>
                        <p className="text-muted">{this.state.loan.loan.project.title}</p>
                        <label htmlFor="">Responsables</label>
                        <p className="text-muted">{this.state.loan.loan.project.authors.map(author => author.name)}</p>
                        <label htmlFor="">Estudiante lider del semillero</label>
                        <p className="text-muted">{this.state.principal_research_team.student_leader === null ? 'No tiene estudiante lider' : this.state.principal_research_team.student_leader.user.name}</p>
                        <label htmlFor="">Numero celular del estudiante lider del semillero</label>
                        <p className="text-muted">{this.state.principal_research_team.student_leader === null ? 'No tiene estudiante lider' : this.state.principal_research_team.student_leader.user.cellphone_number}</p>
                        <label htmlFor="">Correo electronico del estudiante lider del semillero</label>
                        <p className="text-muted">{this.state.principal_research_team.student_leader === null ? 'No tiene estudiante lider' : this.state.principal_research_team.student_leader.user.email}</p>
                        <label htmlFor="">Justificacion</label>
                        <p className="text-muted">{this.state.loan.loan.justification}</p>
                        <label htmlFor="">Carta de autorizarion</label>
                        <br />
                        <a download href={"/storage/" + this.state.loan.loan.authorization_letter}>{this.state.loan.loan.authorization_letter.split('/')[1]}</a>
                    </div>
                </div>
                <div className="row mt-3">
                    <div className="col">
                        <form onSubmit={this.handleSubmit}>
                            <div className="form-group">
                                <label htmlFor="">¿Acepta la solicitud?</label>
                                <br />
                                {this.state.canAcepted ? (
                                    <div>
                                        <div className="form-check form-check-inline">
                                            <input 
                                                className="form-check-input" 
                                                type="radio" 
                                                name="is_accepted" 
                                                id="inlineRadio1" 
                                                value="1" 
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
                                    </div>
                                ) : (
                                        <p>Hay una solicitud aceptada y no se ha devuelto</p>
                                    )}
                            </div>
                            <div className="form-group">
                                <label htmlFor="">Comentario</label>
                                <textarea 
                                    name="annotation" 
                                    id="annotation" 
                                    cols="10" 
                                    className={rules.annotation.isInvalid && rules.annotation.message != '' || requestValidation.annotation ? 'form-control is-invalid': 'form-control'}
                                    onFocus={this.handleFocus}
                                    onChange={this.handleChange}
                                ></textarea>
                                <div className="invalid-feedback">
                                    {rules.annotation.message ? rules.annotation.message : requestValidation.annotation ? requestValidation.annotation : ''}
                                </div>
                            </div>
                            <div className="form-group">
                                <button type="submit" className="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        )
    }
}

export default Check;