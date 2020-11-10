import React, { Component } from 'react';
import { find, get } from '~/containers/EducationalTools';
import { store, rules } from '~/containers/ToolLoans';
import { get as getProjects } from '~/containers/Projects';
import Loader from '~/components/Loader';
import { validate, formValid } from '~/containers/Validator'

class Create extends Component {
    constructor(props) {
        super(props);
        this.state = {
            id: props.match.params.id,
            tool: null,
            tools: null,
            projects: null,
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
            store(e.target).then(data => {
                if(data.status === 200){
                    this.props.history.push('/app/educational-tools/loan-request');
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
        const newRules = validate(rules, value, requestValidation, touched);

        this.setState({ rules: newRules });
    }

    getTool() {
        rules.educational_tool_id.isInvalid = false;
        find(this.state.id).then(data => {
            this.setState({ tool: data });
        })
    }

    getProjects() {
        getProjects().then(data => {
            this.setState({ projects: data });
        })
    }

    getTools() {
        get().then(data => {
            this.setState({ tools: data });
        })
    }

    componentDidMount() {
        this.getTool();
        this.getTools();
        this.getProjects();
        rules.annotation.isInvalid = false;
        rules.is_accepted.isInvalid = false;
    }

    render() {
        const { rules, requestValidation } = this.state;
        if (!this.state.tool || !this.state.tools || !this.state.projects) {
            return <Loader />
        }
        return (
            <div className="container">
                <p>Crear solicitud</p>
                <div className="row">
                    <div className="col-8 mx-auto">
                        <form onSubmit={this.handleSubmit}>
                            <div className="form-group">
                                <div className="form-row">
                                    <div className="col">
                                        <label htmlFor="">Fecha inicio</label>
                                        <input
                                            type="date"
                                            name="start_date"
                                            id="start_date"
                                            className={rules.start_date.isInvalid && rules.start_date.message != '' || requestValidation.start_date ? 'form-control is-invalid' : 'form-control'}
                                            onFocus={this.handleFocus}
                                            onChange={this.handleChange}
                                        />
                                        <div className="invalid-feedback">
                                            {rules.start_date.message ? rules.start_date.message : requestValidation.start_date ? requestValidation.start_date : ''}
                                        </div>
                                    </div>
                                    <div className="col">
                                        <label htmlFor="">Fecha fin</label>
                                        <input
                                            type="date"
                                            name="end_date"
                                            id="end_date"
                                            className={rules.end_date.isInvalid && rules.end_date.message != '' || requestValidation.end_date ? 'form-control is-invalid' : 'form-control'}
                                            onFocus={this.handleFocus}
                                            onChange={this.handleChange}
                                        />
                                        <div className="invalid-feedback">
                                            {rules.end_date.message ? rules.end_date.message : requestValidation.end_date ? requestValidation.end_date : ''}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div className="form-group">
                                <label htmlFor="">Proyecto</label>
                                <select
                                    name="project_id"
                                    id="project_id"
                                    className={rules.project_id.isInvalid && rules.project_id.message != '' || requestValidation.project_id ? 'form-control is-invalid' : 'form-control'}
                                    onFocus={this.handleFocus}
                                    onChange={this.handleChange}
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
                                <div className="invalid-feedback">
                                    {rules.project_id.message ? rules.project_id.message : requestValidation.project_id ? requestValidation.project_id : ''}
                                </div>
                            </div>
                            <div className="form-group">
                                <label htmlFor="">Justificacion</label>
                                <textarea
                                    name="justification"
                                    id="justification"
                                    className={rules.justification.isInvalid && rules.justification.message != '' || requestValidation.justification ? 'form-control is-invalid' : 'form-control'}
                                    onFocus={this.handleFocus}
                                    onChange={this.handleChange}
                                ></textarea>
                                <div className="invalid-feedback">
                                    {rules.justification.message ? rules.justification.message : requestValidation.justification ? requestValidation.justification : ''}
                                </div>
                            </div>
                            <div className="form-group">
                                <label htmlFor="">Carta de autorizacion</label>
                                <input
                                    type="file"
                                    name="authorization_letter"
                                    id="authorization_letter"
                                    className={rules.authorization_letter.isInvalid && rules.authorization_letter.message != '' || requestValidation.authorization_letter ? 'form-control is-invalid' : 'form-control'}
                                    onFocus={this.handleFocus}
                                    onChange={this.handleChange}
                                />
                                <div className="invalid-feedback">
                                    {rules.authorization_letter.message ? rules.authorization_letter.message : requestValidation.authorization_letter ? requestValidation.authorization_letter : ''}
                                </div>
                            </div>
                            <div className="form-group">
                                <label htmlFor="">Equipo / Herramienta</label>
                                <select
                                    name="educational_tool_id"
                                    id="educational_tool_id"
                                    className={rules.educational_tool_id.isInvalid && rules.educational_tool_id.message != '' || requestValidation.educational_tool_id ? 'form-control is-invalid':'form-control'}
                                    onChange={this.handleChange}
                                    onFocus={this.handleFocus}
                                    defaultValue={this.state.tool.id}
                                    readOnly
                                >
                                    <option value="">Seleccione uno</option>
                                    {this.state.tools.length > 0 ? (
                                        this.state.tools.map(tool => (
                                            <option key={tool.id} value={tool.id}>{tool.name}</option>
                                        ))
                                    ) : (
                                            <option value="">No tools</option>
                                        )}
                                </select>
                                <div className="invalid-feedback">
                                    {rules.educational_tool_id.message ? rules.educational_tool_id.message : requestValidation.educational_tool_id ? requestValidation.educational_tool_id : ''}
                                </div>
                            </div>
                            <div className="form-group">
                                <button className="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        )
    }
}

export default Create;