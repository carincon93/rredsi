import React, { Component } from 'react';
import { find, update, rules } from '~/containers/AcademicPrograms';
import { formValid, validate } from '~/containers/Validator';
import { get } from '~/containers/KnowledgeAreas';
import { getNode } from '~/containers/Node';
import { getEducationalInstitution } from '~/containers/EducationalInstitution';

class Edit extends Component {
    constructor(props) {
        super(props);

        this.state = {
            rules,
            touched: {},
            requestValidation: {},
            knowledgeAreas: {},
            nodes: {},
            educationalInstitutions: {},
            id: this.props.match.params.id,
            academicProgram: {},

        }

        this.handleSubmit = this.handleSubmit.bind(this);
        this.handleChange = this.handleChange.bind(this);
        this.handleFocus = this.handleFocus.bind(this);

    }

    componentDidMount() {
        this.getAcademicProgram();
        this.resetValidator();
        this.getKnowledgeAreas();
        this.getNodes();
        this.getEducationalInstitutions();
    }

    handleSubmit(e) {
        e.preventDefault();

        if (formValid(rules)) {
            update(e.target, this.state.id).then(data => {
                if (data.status === 422)
                    this.setState({ requestValidation: data.errors });
            });
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
        const rulesAcademicProgram = validate(rules, value, requestValidation, touched);
        this.setState({ rules: rulesAcademicProgram });
    }

    resetValidator() {
        let rulesName = Object.keys(rules);

        rulesName.map((ruleName) => {
            if (rules[ruleName]['required']) {
                rules[ruleName]['isEmpty'] = false;
                rules[ruleName]['isInvalid'] = false;

                this.setState({ rules });
            }
        })
    }

    getAcademicProgram() {
        find(this.state.id, 'edit').then(data => {
            this.setState({ academicProgram: data });
        })
    }
    getKnowledgeAreas() {
        get().then(data => {
            this.setState({ knowledgeAreas: data });
        })
    }
    getNodes() {
        getNode().then(data => {
            this.setState({ nodes: data });
        })
    }
    getEducationalInstitutions() {
        getEducationalInstitution().then(data => {
            this.setState({ educationalInstitutions: data });
        })
    }



    render() {
        const { rules, requestValidation, academicProgram } = this.state;
        if (academicProgram.id == null) {
            return <div>Loading</div>
        }
        return (
            <div className="container">
                <div className="form-wrapper">
                    <form
                        className="form" onSubmit={this.handleSubmit}
                        id="form"
                    >
                        <div className="form-group">
                            <label htmlFor="name">name</label>
                            <small id="nameHelp" className="form-text text-muted">
                                Campo requerido
                            </small>
                            <input
                                type="text"
                                name="name"
                                className={rules.name.isInvalid && rules.name.message !== '' || requestValidation.name ? 'form-control is-invalid' : 'form-control'}
                                id="name"
                                defaultValue={academicProgram.name}
                                aria-describedby="nameHelp"
                                maxLength={rules.name.max}
                                required
                                onFocus={this.handleFocus}
                                onChange={this.handleChange}
                            />
                            <span className="invalid-feedback">
                                {rules.name.message ? rules.name.message : requestValidation.name ? requestValidation.name : ''}
                            </span>
                        </div>
                        <div className="form-group">
                            <label htmlFor="code">code</label>
                            <small id="nameHelp" className="form-text text-muted">
                                Campo requerido
                            </small>
                            <input
                                type="number"
                                name="code"
                                className={rules.code.isInvalid && rules.code.message !== '' || requestValidation.code ? 'form-control is-invalid' : 'form-control'}
                                id="code"
                                defaultValue={academicProgram.code}
                                aria-describedby="nameHelp"
                                maxLength={rules.code.max}
                                required
                                onFocus={this.handleFocus}
                                onChange={this.handleChange}
                            />
                            <span className="invalid-feedback">
                                {rules.code.message ? rules.code.message : requestValidation.code ? requestValidation.code : ''}
                            </span>
                        </div>
                        <div className="form-group">
                            <label htmlFor="academic_level">Nivel Acádemico</label>
                            <small id="academic_levelHelp" className="form-text text-muted">Campo requerido</small>
                            <select id="academic_level"
                                name="academic_level"
                                className={rules.academic_level.isInvalid && rules.academic_level.message !== '' || requestValidation.academic_level ? 'form-control is-invalid' : 'form-control'}
                                required
                                defaultValue={academicProgram.academic_level}
                                onFocus={this.handleFocus}
                                onChange={this.handleChange}
                            >
                                <option value=''>Seleccione el estado</option>
                                <option value="Técnico Profesional">Técnico Profesional</option>
                                <option value="Técnologo">Técnologo</option>
                                <option value="Profesional">Profesional</option>
                                <option value="Especialización Técnica Profesional">Especialización Técnica Profesional</option>
                                <option value="Especialización Técnologica">Especialización Técnologica</option>
                                <option value="Maestría">Maestría</option>
                                <option value="Doctorado">Doctorado</option>
                            </select>
                            <span className="invalid-feedback">
                                {rules.academic_level.message ? rules.academic_level.message : requestValidation.academic_level ? requestValidation.academic_level : ''}
                            </span>
                        </div>
                        <div className="form-group">
                            <div className="form-row">
                                <div className="col">
                                    <label htmlFor="start_date">Fecha de Inicio</label>
                                    <small id="start_datelHelp" className="form-text text-muted">Campo requerido</small>
                                    <input
                                        type="date"
                                        name="start_date"
                                        className={rules.start_date.isInvalid && rules.start_date.message !== '' || requestValidation.start_date ? 'form-control is-invalid' : 'form-control'}
                                        id="start_date"
                                        defaultValue={academicProgram.start_date}
                                        aria-describedby="nameHelp"
                                        maxLength={rules.start_date.max}
                                        required
                                        onFocus={this.handleFocus}
                                        onChange={this.handleChange}
                                    />
                                    <span className="invalid-feedback">
                                        {rules.start_date.message ? rules.start_date.message : requestValidation.start_date ? requestValidation.start_date : ''}
                                    </span>
                                </div>
                                <div className="col">
                                    <label htmlFor="end_date">Fecha Final</label>
                                    <small id="start_datelHelp" className="form-text text-muted">Campo requerido</small>
                                    <input
                                        type="date"
                                        name="end_date"
                                        className={rules.end_date.isInvalid && rules.end_date.message !== '' || requestValidation.end_date ? 'form-control is-invalid' : 'form-control'}
                                        id="end_date"
                                        defaultValue={academicProgram.end_date}
                                        aria-describedby="nameHelp"
                                        maxLength={rules.end_date.max}
                                        required
                                        onFocus={this.handleFocus}
                                        onChange={this.handleChange}
                                    />
                                    <span className="invalid-feedback">
                                        {rules.end_date.message ? rules.end_date.message : requestValidation.end_date ? requestValidation.end_date : ''}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div className="form-group">
                            <label htmlFor="modality">Modalidad</label>
                            <small id="modalityHelp" className="form-text text-muted">Campo requerido</small>
                            <select id="modality"
                                name="modality"
                                className={rules.modality.isInvalid && rules.modality.message !== '' || requestValidation.modality ? 'form-control is-invalid' : 'form-control'}
                                required
                                onFocus={this.handleFocus}
                                onChange={this.handleChange}
                                defaultValue={academicProgram.modality}
                            >
                                <option value=''>Seleccione el estado</option>
                                <option value="Presencial">Presencial</option>
                                <option value="A distancia">A distancia</option>
                            </select>
                            <span className="invalid-feedback">
                                {rules.modality.message ? rules.modality.message : requestValidation.modality ? requestValidation.modality : ''}
                            </span>
                        </div>
                        <div className="form-group">
                            <label htmlFor="daytime">Jornada</label>
                            <small id="daytimeHelp" className="form-text text-muted">Campo requerido</small>
                            <select id="daytime"
                                name="daytime"
                                className={rules.daytime.isInvalid && rules.daytime.message !== '' || requestValidation.daytime ? 'form-control is-invalid' : 'form-control'}
                                required
                                onFocus={this.handleFocus}
                                onChange={this.handleChange}
                                defaultValue={academicProgram.daytime}
                            >
                                <option value=''>Seleccione el estado</option>
                                <option value="Diurna">Diurna</option>
                                <option value="Mixta">Mixta</option>
                                <option value="Nocturna">Nocturna</option>
                            </select>
                            <span className="invalid-feedback">
                                {rules.daytime.message ? rules.daytime.message : requestValidation.daytime ? requestValidation.daytime : ''}
                            </span>
                        </div>
                        <div className="form-group">
                            <label htmlFor="knowledge_area_id">Area De Conocimiento</label>
                            <small id="node_idHelp" className="form-text text-muted">Campo requerido</small>
                            <select
                                id="knowledge_area_id"
                                name="knowledge_area_id"
                                className={rules.knowledge_area_id.isInvalid && rules.knowledge_area_id.message !== '' || requestValidation.knowledge_area_id ? 'form-control is-invalid' : 'form-control'}
                                defaultValue={academicProgram.knowledge_area_id}
                                aria-describedby="node_idHelp"
                                required
                                onFocus={this.handleFocus}
                                onChange={this.handleChange}
                            >
                                <option value=''>Seleccione un area de conocimiento</option>
                                {this.state.knowledgeAreas.length > 0 ? (
                                    this.state.knowledgeAreas.map((knowledgearea) => (
                                        <option
                                            value={knowledgearea.name.id}
                                            key={knowledgearea.name.id}>{knowledgearea.name}
                                        </option>
                                    ))
                                ) : (
                                        <option value="">No knowledge areas</option>
                                    )}
                            </select>
                            <span className="invalid-feedback">
                                {rules.knowledge_area_id.message ? rules.knowledge_area_id.message : requestValidation.knowledge_area_id ? requestValidation.knowledge_area_id : ''}

                            </span>
                        </div>

                        <div className="form-group">
                            <label htmlFor="node_id">Nodo</label>
                            <small id="node_idHelp" className="form-text text-muted">Campo requerido</small>
                            <select
                                id="node_id"
                                name="node_id"
                                className={rules.node_id.isInvalid && rules.node_id.message !== '' || requestValidation.node_id ? 'form-control is-invalid' : 'form-control'}
                                aria-describedby="node_idHelp"
                                required
                                onFocus={this.handleFocus}
                                onChange={this.handleChange}
                            >
                                <option value=''>Seleccione un Nodo</option>
                                {this.state.nodes.length > 0 ? (
                                    this.state.nodes.map((node) => (
                                        <option
                                            value={node.id}
                                            key={node.id}>{node.state}
                                        </option>
                                    ))
                                ) : (
                                        <option value="">No Nodes</option>
                                    )}
                            </select>
                            <span className="invalid-feedback">
                                {rules.node_id.message ? rules.node_id.message : requestValidation.node_id ? requestValidation.node_id : ''}
                            </span>
                        </div>
                        <div className="form-group">
                            <label htmlFor="educational_institution_id">Institución educativa</label>
                            <small id="node_idHelp" className="form-text text-muted">Campo requerido</small>
                            <select
                                id="educational_institution_id"
                                name="educational_institution_id"
                                className={rules.educational_institution_id.isInvalid && rules.educational_institution_id.message !== '' || requestValidation.educational_institution_id ? 'form-control is-invalid' : 'form-control'}
                                defaultValue={academicProgram.educational_institution_id}
                                aria-describedby="node_idHelp"
                                required
                                onFocus={this.handleFocus}
                                onChange={this.handleChange}
                            >
                                <option value=''>Seleccione una institución educativa</option>
                                {this.state.educationalInstitutions.length > 0 ? (
                                    this.state.educationalInstitutions.map((educationalInstitution) => (
                                        <option
                                            value={educationalInstitution.id}
                                            key={educationalInstitution.id}>{educationalInstitution.name}
                                        </option>
                                    ))
                                ) : (
                                        <option value="">No educational institutions</option>
                                    )}
                            </select>
                            <span className="invalid-feedback">
                                {rules.educational_institution_id.message ? rules.educational_institution_id.message : requestValidation.educational_institution_id ? requestValidation.educational_institution_id : ''}
                            </span>
                        </div>
                        <button
                            className="btn btn-primary"
                            type="submit"
                            form="form"
                        >
                            Guardar
                        </button>
                    </form>
                </div>
            </div>
        )
    }
}

export default Edit;
