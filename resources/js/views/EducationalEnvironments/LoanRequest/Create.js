import React, { Component } from 'react';
import { find, get as getEducationalEnvironments } from '~/containers/EducationalEnvironments';
import { get } from '~/containers/Projects';
import { store, rules } from '~/containers/EnvironmentLoans';
import { formValid, validate } from '~/containers/Validator';
import Loader from '~/components/Loader';

class Create extends Component {
    constructor(props) {
        super(props);
        this.state = {
            id: props.match.params.id,
            educationalEnvironment: null,
            educationalEnvironments: null,
            projects: null,
            touched: {},
            requestValidation: {},
            rules,
        }
        this.handleChange = this.handleChange.bind(this);
        this.handleFocus = this.handleFocus.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }

    getEducationalEnvironment() {
        find(this.state.id).then(data => {
            this.setState({ educationalEnvironment: data });
        })
    }
    getProjects() {
        get().then(data => {
            this.setState({ projects: data });
        })
    }

    getEducationalEnvironments() {
        getEducationalEnvironments().then(data => {
            this.setState({ educationalEnvironments: data });
        })
    }

    componentDidMount() {
        this.getEducationalEnvironment();
        this.getProjects();
        this.getEducationalEnvironments();
        rules.is_accepted.isInvalid = false;
        rules.annotation.isInvalid = false;
        rules.educational_environment_id.isInvalid = false;
    }

    handleSubmit(e) {
        e.preventDefault();
        
        if (formValid(rules)) {
            store(e.target).then(data => {
                if(data.status===200){
                    this.props.history.push('/app/educational-environments/loan-request');
                }
                if (data.status === 422)
                    this.setState({ requestValidation: data.errors });
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

    render() {
        const { rules, requestValidation } = this.state;
        if (!this.state.educationalEnvironment || !this.state.projects || !this.state.educationalEnvironments) {
            return (
                <Loader />
            )
        }
        return (
            <div className="container">
                <p>Crear solicitud</p>
                <div className="row">
                    <div className="col-6 mx-auto">
                        <form onSubmit={this.handleSubmit}>
                            <div className="form-row">
                                <div className="col">
                                    <div className="form-group">
                                        <label htmlFor="">Fecha inicio</label>
                                        <input
                                            type="date"
                                            name="start_date"
                                            id="start_date"
                                            className={rules.start_date.isInvalid && rules.start_date.message !== '' || requestValidation.start_date ? 'form-control is-invalid' : 'form-control'}
                                            onChange={this.handleChange}
                                            onFocus={this.handleFocus}
                                        />
                                        <span className="invalid-feedback">
                                            {rules.start_date.message ? rules.start_date.message : requestValidation.start_date ? requestValidation.start_date : ''}
                                        </span>
                                    </div>
                                </div>
                                <div className="col">
                                    <div className="form-group">
                                        <label htmlFor="">Fecha fin</label>
                                        <input 
                                            type="date" 
                                            name="end_date" 
                                            id="end_date" 
                                            className={rules.end_date.isInvalid && rules.end_date.message !== '' || requestValidation.end_date ? 'form-control is-invalid' : 'form-control'}
                                            onChange={this.handleChange}
                                            onFocus={this.handleFocus}
                                        />
                                        <span className="invalid-feedback">
                                            {rules.end_date.message ? rules.end_date.message : requestValidation.end_date ? requestValidation.end_date : ''}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div className="form-row">
                                <div className="col">
                                    <div className="form-group">
                                        <label htmlFor="">Proyecto</label>
                                        <select 
                                            name="project_id" 
                                            id="project_id" 
                                            className={rules.project_id.isInvalid && rules.project_id.message !== '' || requestValidation.project_id ? 'form-control is-invalid' : 'form-control'}
                                            onChange={this.handleChange}
                                            onFocus={this.handleFocus}
                                        >
                                            <option value="">Seleccione uno</option>
                                            {this.state.projects.length > 0 ? (
                                                this.state.projects.map(project => (
                                                    <option key={project.id} value={project.id}>{project.title}</option>
                                                ))
                                            ) : (
                                                    <option value="">No projects</option>
                                                )}
                                        </select>
                                        <span className="invalid-feedback">
                                            {rules.project_id.message ? rules.project_id.message : requestValidation.project_id ? requestValidation.project_id : ''}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div className="form-row">
                                <div className="col">
                                    <div className="form-group">
                                        <label htmlFor="">Justificacion</label>
                                        <textarea 
                                            name="justification" 
                                            id="justification" 
                                            className={rules.justification.isInvalid && rules.justification.message !== '' || requestValidation.justification ? 'form-control is-invalid' : 'form-control'}
                                            onChange={this.handleChange}
                                            onFocus={this.handleFocus}
                                        ></textarea>
                                        <span className="invalid-feedback">
                                            {rules.justification.message ? rules.justification.message : requestValidation.justification ? requestValidation.justification : ''}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div className="form-row">
                                <div className="col">
                                    <div className="form-group">
                                        <label htmlFor="">Carta de autorizacion</label>
                                        <input 
                                            type="file" 
                                            name="authorization_letter" 
                                            id="authorization_letter" 
                                            className={rules.authorization_letter.isInvalid && rules.authorization_letter.message !== '' || requestValidation.authorization_letter ? 'form-control is-invalid' : 'form-control'}
                                            onChange={this.handleChange}
                                            onFocus={this.handleFocus}
                                        />
                                        <span className="invalid-feedback">
                                            {rules.authorization_letter.message ? rules.authorization_letter.message : requestValidation.authorization_letter ? requestValidation.authorization_letter : ''}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div className="form-row">
                                <div className="col">
                                    <div className="form-group">
                                        <label htmlFor="">Ambiente</label>
                                        <select 
                                            name="educational_environment_id" 
                                            id="educational_environment_id" 
                                            className="form-control" 
                                            defaultValue={this.state.educationalEnvironment.id}
                                            readOnly
                                        >
                                            <option value="">Seleccione uno</option>
                                            {this.state.educationalEnvironments.length > 0 ? (
                                                this.state.educationalEnvironments.map(educationalEnvironment => (
                                                    <option key={educationalEnvironment.id} value={educationalEnvironment.id}>{educationalEnvironment.name}</option>
                                                ))
                                            ) : (
                                                    <option value="">No educational environment</option>
                                                )}
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div className="form-row">
                                <div className="col">
                                    <button type="submit" className="btn btn-block btn-primary">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        )
    }
}

export default Create;