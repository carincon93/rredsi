import React, { Component } from 'react';
import { find, checkReturn, rules } from '~/containers/EnvironmentLoans.js'
import { get } from '~/containers/EducationalEnvironments';
import { get as getProjects } from '~/containers/Projects';
import { formValid, validate } from '~/containers/Validator.js';


class Check extends Component {
    constructor(props) {
        super(props);
        this.state = {
            touched: {},
            id: props.match.params.id,
            loan: null,
            educationalEnvironments: null,
            projects: null,
            requestValidation: {},
            rules,
        }
        this.handleSubmit = this.handleSubmit.bind(this);
        this.handleFocus = this.handleFocus.bind(this);
        this.handleChange = this.handleChange.bind(this);
        this.setValidation = this.setValidation.bind(this);
    }
    getLoan() {
        find(this.state.id).then(data => {
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
        if (formValid(rules)) {
            checkReturn(e.target, this.state.id).then(data => {
                if(data.success){
                    this.props.history.push('/app/educational-environments/list')
                }
            });
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
        const rulesResearcher = validate(rules, value, requestValidation, touched);

        this.setState({ rules: rulesResearcher });
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
        const { rules, requestValidation } = this.state;
        if (!this.state.loan || !this.state.educationalEnvironments || !this.state.projects) {
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
                <p>Revisar devolucion de ambiente</p>
                <div className="row">
                    <div className="col-8 mx-auto">
                        <form onSubmit={this.handleSubmit}>
                            <div className="form-row">
                                <div className="col">
                                    <div className="form-group">
                                        <label htmlFor="">Fecha inicio</label>
                                        <input type="date" name="start_date" id="start_date" className="form-control" defaultValue={this.state.loan.loan.start_date} readOnly />
                                    </div>
                                </div>
                                <div className="col">
                                    <div className="form-group">
                                        <label htmlFor="">Fecha fin</label>
                                        <input type="date" name="end_date" id="end_date" className="form-control" defaultValue={this.state.loan.loan.end_date} readOnly />
                                    </div>
                                </div>
                            </div>
                            <div className="form-row">
                                <div className="col">
                                    <div className="form-group">
                                        <label htmlFor="">Fecha de devolucion</label>
                                        <input type="datetime" name="returned_at" id="returned_at" className="form-control" defaultValue={this.state.loan.loan.returned_at} readOnly />
                                    </div>
                                </div>
                            </div>
                            <div className="form-row mb-2">
                                <div className="col">
                                    <label htmlFor="">¿Devolucion aceptada?</label>
                                    <br />
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
                                    <span className={rules.is_accepted.isInvalid && rules.is_accepted.message !== '' || requestValidation.is_accepted ? 'invalid-feedback d-block' : 'invalid-feedback'} >
                                        {rules.is_accepted.message ? rules.is_accepted.message : requestValidation.is_accepted ? requestValidation.is_accepted : ''}
                                    </span>
                                </div>
                            </div>
                            <div className="form-row">
                                <div className="col">
                                    <div className="form-group">
                                        <label htmlFor="">Comentario</label>
                                        <textarea
                                            name="annotation"
                                            id="annotation"
                                            className={rules.annotation.isInvalid && rules.annotation.message !== '' || requestValidation.annotation ? 'form-control is-invalid' : 'form-control'}
                                            onFocus={this.handleFocus}
                                            onChange={this.handleChange}
                                            required
                                        ></textarea>
                                        <span className="invalid-feedback">
                                            {rules.annotation.message ? rules.annotation.message : requestValidation.annotation ? requestValidation.annotation : ''}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div className="form-row">
                                <div className="col">
                                    <div className="form-group">
                                        <label htmlFor="">Ambiente</label>
                                        <select name="ambient_id" id="ambient_id" className="form-control" readOnly>
                                            {this.state.educationalEnvironments.length > 0 ? (
                                                this.state.educationalEnvironments.map(educationalEnvironment => (
                                                    <option key={educationalEnvironment.id} value={educationalEnvironment.id} defaultChecked={educationalEnvironment.id === this.state.loan.educational_environment_id ? 'checked' : ''} >{educationalEnvironment.name}</option>
                                                ))
                                            ) : (
                                                    <option value="">No ambients</option>
                                                )}
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div className="form-row">
                                <div className="col">
                                    <div className="form-group">
                                        <label htmlFor="">Proyecto</label>
                                        <select name="project_id" id="project_id" className="form-control" readOnly defaultValue={this.state.loan.loan.project_id}>
                                            {this.state.projects.length > 0 ? (
                                                this.state.projects.map(project => (
                                                    <option key={project.id} value={project.id}>{project.title}</option>
                                                ))
                                            ) : (
                                                    <option value="">No projects</option>
                                                )}
                                        </select>
                                    </div>
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