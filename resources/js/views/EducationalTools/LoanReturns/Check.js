import React, { Component } from 'react';
import Loader from '~/components/Loader';
import { find, rules, checkReturn } from '~/containers/ToolLoans';
import {get as gettools} from '~/containers/EducationalTools';
import {get as getprojects } from '~/containers/Projects';
import {validate, formValid} from '~/containers/Validator';

class Check extends Component {
    constructor(props) {
        super(props);
        this.state = {
            id: props.match.params.id,
            loan: null,
            tools: null,
            projects: null,
            touched: {},
            requestValidation: {},
            rules
        }

        this.handleChange = this.handleChange.bind(this);
        this.handleFocus  = this.handleFocus.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }

    getLoan() {
        find(this.state.id).then(data => {
            this.setState({ loan: data });
        })
    }

    getTools(){
        gettools().then(data => {
            this.setState({tools: data});
        })
    }

    handleChange(e) {
        const { name, value } = e.target;

        this.setValidation(rules, value);

        if (name == 'educational_institution_id' && Number(value) > 0) {
            this.getEducationalEnvironments(value);
        }
    };

    setValidation(rules, value) {
        let { requestValidation } = this.state;
        let { touched } = this.state;
        const rulesResearcher = validate(rules, value, requestValidation, touched);

        this.setState({ rules: rulesResearcher });
    }

    handleSubmit(e){
        e.preventDefault();
        if(formValid(rules)){
            checkReturn(e.target, this.state.id).then(data => {
                if(data.status===200){
                    this.props.history.push('/app/educational-tools/list');
                }
            })
        }else{
            confirm('Por favor complete el formulario');
        }
    }

    handleFocus(e) {
        const { name } = e.target;

        this.setState({ touched: { [name]: true } });
    }

    getProjects(){
        getprojects().then(data => {
            this.setState({projects: data});
        })
    }

    componentDidMount() {
        this.getLoan();
        this.getTools();
        this.getProjects();
        rules.authorization_letter.isInvalid = false;
        rules.educational_tool_id.isInvalid = false;
        rules.start_date.isInvalid = false;
        rules.end_date.isInvalid = false;
        rules.project_id.isInvalid = false;
        rules.justification.isInvalid = false;
    }

    render() {
        const {rules, requestValidation} = this.state;
        if (!this.state.loan || !this.state.projects || !this.state.tools) {
            return (
                <Loader />
            )
        }
        return (
            <div className="containe">
                <p>Revision de devolucion</p>
                <div className="row">
                    <div className="col-8 mx-auto">
                        <form  onSubmit={this.handleSubmit}>
                            <div className="form-group">
                                <div className="form-row">
                                    <div className="col">
                                        <label htmlFor="">Fecha inicio</label>
                                        <input 
                                            type="date" 
                                            name="start_date" 
                                            id="start_date" 
                                            className="form-control" 
                                            defaultValue={this.state.loan.loan.start_date}
                                            readOnly
                                        />
                                    </div>
                                    <div className="col">
                                        <label htmlFor="">Fecha fin</label>
                                        <input 
                                            type="date" 
                                            name="end_date" 
                                            id="end_date" 
                                            className="form-control" 
                                            defaultValue={this.state.loan.loan.end_date}
                                            readOnly
                                        />
                                    </div>
                                </div>
                            </div>
                            <div className="form-group">
                                <label htmlFor="">Fecha devolucion</label>
                                <input 
                                    type="datetime" 
                                    name="returned_at" 
                                    id="returned_at" 
                                    className="form-control" 
                                    defaultValue={this.state.loan.loan.returned_at}
                                    readOnly
                                />
                            </div>
                            <div className="form-group">
                                <label htmlFor="">¿Devolucion aceptada?</label>
                                <br/>
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
                                        onFocus={this.handleFocus}
                                        onChange={this.handleChange}
                                    />
                                    <label className="form-check-label" htmlFor="inlineRadio2">No</label>
                                </div>
                            </div>
                            <div className="form-group">
                                <label htmlFor="">Comentario</label>
                                <textarea 
                                    name="annotation" 
                                    id="annotation"
                                    className={rules.annotation.isInvalid && rules.annotation.message != '' || requestValidation.annotation ? 'form-control is-invalid':'form-control'}
                                    onFocus={this.handleFocus}
                                    onChange={this.handleChange}
                                >
                                </textarea>
                                <div className="invalid-feedback">
                                    {rules.annotation.message ? rules.annotation.message : requestValidation.annotation ? requestValidation.annotation : ''}
                                </div>
                            </div>
                            <div className="form-group">
                                <label htmlFor="">Equipo</label>
                                <select 
                                    name="educational_tool_id" 
                                    id="educational_tool_id" 
                                    className="form-control"
                                    defaultValue={this.state.loan.educational_tool_id}
                                    readOnly
                                >
                                    <option value="">Seleccione uno</option>
                                    {this.state.tools.length>0?(
                                        this.state.tools.map(tool => (
                                            <option key={tool.id} value={tool.id}>{tool.name}</option>
                                        ))
                                    ):(
                                        <option value="">No tools</option>
                                    )}
                                </select>
                            </div>
                            <div className="form-group">
                                <label htmlFor="">Proyecto</label>
                                <select 
                                    name="project_id" 
                                    id="project_id" 
                                    className="form-control"
                                    defaultValue={this.state.loan.loan.project_id}
                                    readOnly
                                >
                                    <option value="">Seleccione uno</option>
                                    {this.state.projects.length>0?(
                                        this.state.projects.map(project => (
                                            <option key={project.id} value={project.id}>{project.title}</option>
                                        ))
                                    ):(
                                        <option value="">No projects</option>
                                    )}
                                </select>
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

export default Check;