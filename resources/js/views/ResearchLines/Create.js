import React, { Component } from 'react';
import { store, rules } from '~/containers/ResearchLines';
import { formValid, validate } from '~/containers/Validator';
import { get } from '~/containers/KnowledgeAreas';
import { getEducationalInstitution } from '~/containers/EducationalInstitution';
import { getResearchGroup } from '~/containers/ResearchGroup';
// import { get } from 'jquery';



class Create extends Component {
    constructor(props) {
        super(props);

        this.state = {
            touched: {},
            requestValidation: {},
            rules,
            knowledgeAreas: {},
            educationalInstitutions: {},
            researchGroups: {},
        }

        this.handleSubmit = this.handleSubmit.bind(this);
        this.handleChange = this.handleChange.bind(this);
        this.handleFocus = this.handleFocus.bind(this);
    }

    componentDidMount() {
        this.getKnowledgeAreas();
        this.getEducationalInstitutions()
        this.getResearchGroups()
    }


    handleSubmit(e) {
        e.preventDefault();

        if (formValid(rules)) {
            store(e.target).then(data => {
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
        const nodes = validate(rules, value, requestValidation, touched);

        this.setState({ rules: nodes });
    }
    getKnowledgeAreas() {
        get().then(data => {
            this.setState({ knowledgeAreas: data })
        });
    }
    getEducationalInstitutions() {
        getEducationalInstitution().then(data => {
            this.setState({ educationalInstitutions: data })
        });
    }
    getResearchGroups() {
        getResearchGroup().then(data => {
            this.setState({ researchGroups: data })
        });
    }




    render() {
        const { rules, requestValidation, } = this.state;
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
                            <label htmlFor="objectives">objectives</label>
                            <small id="objectivesHelp" className="form-text text-muted">Campo requerido</small>
                            <textarea
                                name="objectives"
                                className={rules.objectives.isInvalid && rules.objectives.message !== '' || requestValidation.objectives ? 'form-control is-invalid' : 'form-control'}
                                id="objectives"
                                rows="3"
                                onFocus={this.handleFocus}
                                onChange={this.handleChange}
                            >
                            </textarea>
                            <span className="invalid-feedback">
                                {rules.objectives.message ? rules.objectives.message : requestValidation.objectives ? requestValidation.objectives : ''}
                            </span>
                        </div>
                        <div className="form-group">
                            <label htmlFor="mission">mission</label>
                            <small id="missionHelp" className="form-text text-muted">Campo requerido</small>
                            <textarea
                                name="mission"
                                className={rules.mission.isInvalid && rules.mission.message !== '' || requestValidation.mission ? 'form-control is-invalid' : 'form-control'}
                                id="mission"
                                rows="3"
                                onFocus={this.handleFocus}
                                onChange={this.handleChange}
                            >
                            </textarea>
                            <span className="invalid-feedback">
                                {rules.mission.message ? rules.mission.message : requestValidation.mission ? requestValidation.mission : ''}
                            </span>
                        </div>
                        <div className="form-group">
                            <label htmlFor="vision">vision</label>
                            <small id="missionHelp" className="form-text text-muted">Campo requerido</small>
                            <textarea
                                name="vision"
                                className={rules.vision.isInvalid && rules.vision.message !== '' || requestValidation.vision ? 'form-control is-invalid' : 'form-control'}
                                id="vision"
                                rows="3"
                                onFocus={this.handleFocus}
                                onChange={this.handleChange}
                            >
                            </textarea>
                            <span className="invalid-feedback">
                                {rules.vision.message ? rules.vision.message : requestValidation.vision ? requestValidation.vision : ''}
                            </span>
                        </div>
                        <div className="form-group">
                            <label htmlFor="achievements">Logros</label>
                            <small id="achievementsHelp" className="form-text text-muted">Campo requerido</small>
                            <textarea
                                name="achievements"
                                className={rules.achievements.isInvalid && rules.achievements.message !== '' || requestValidation.achievements ? 'form-control is-invalid' : 'form-control'}
                                id="achievements"
                                rows="3"
                                onFocus={this.handleFocus}
                                onChange={this.handleChange}
                            >
                            </textarea>
                            <span className="invalid-feedback">
                                {rules.achievements.message ? rules.achievements.message : requestValidation.achievements ? requestValidation.achievements : ''}
                            </span>
                        </div>
                        <div className="form-group">
                            <label htmlFor="knowledgeArea">knowledgeArea</label>
                            <small id="administrador_idHelp" className="form-text text-muted">Campo requerido</small>
                            <select id="knowledge_area"
                                name="knowledge_area"
                                className={rules.knowledgeArea.isInvalid && rules.knowledgeArea.message !== '' || requestValidation.knowledgeArea ? 'form-control is-invalid' : 'form-control'}
                                required
                                onFocus ={this.handleFocus}
                                onChange={this.handleChange}
                            >

                                <option value=''>Selecciones un area de conocimiento</option>
                                {this.state.knowledgeAreas.length > 0 ? (
                                    this.state.knowledgeAreas.map((knowledgeArea) => (
                                        <option
                                            value={knowledgeArea.id}
                                            key={knowledgeArea.id}>{knowledgeArea.name}
                                        </option>
                                    ))
                                ) : (
                                        <option value="">No knowledgearea</option>
                                    )}
                            </select>
                            <span className="invalid-feedback">
                                {rules.knowledgeArea.message ? rules.knowledgeArea.message : requestValidation.knowledgeArea ? requestValidation.knowledgeArea : ''}
                            </span>
                        </div>
    
                        <div className="form-group">
                            <label htmlFor="educationalInstitution">educationalInstitution</label>
                            <small id="administrador_idHelp" className="form-text text-muted">Campo requerido</small>
                            <select id="knowledge_area"
                                name="knowledge_area"
                                className={rules.educationalInstitution.isInvalid && rules.educationalInstitution.message !== '' || requestValidation.educationalInstitution ? 'form-control is-invalid' : 'form-control'}
                                required
                                onFocus ={this.handleFocus}
                                onChange={this.handleChange}
                            >

                                <option value=''>Selecciones un area de conocimiento</option>
                                {this.state.educationalInstitutions.length > 0 ? (
                                    this.state.educationalInstitutions.map((educationalInstitution) => (
                                        <option
                                            value={educationalInstitution.id}
                                            key={educationalInstitution.id}>{educationalInstitution.name}
                                        </option>
                                    ))
                                ) : (
                                        <option value="">No educational Institution</option>
                                    )}
                            </select>
                            <span className="invalid-feedback">
                                {rules.educationalInstitution.message ? rules.educationalInstitution.message : requestValidation.educationalInstitution ? requestValidation.educationalInstitution : ''}
                            </span>
                        </div>



                        <div className="form-group">
                            <label htmlFor="researchGroup">researchGroup</label>
                            <small id="researchGroupHelp" className="form-text text-muted">Campo requerido</small>
                            <select id="researchGroup"
                                name="researchGroup"
                                className={rules.researchGroup.isInvalid && rules.researchGroup.message !== '' || requestValidation.researchGroup ? 'form-control is-invalid' : 'form-control'}
                                required
                                onFocus ={this.handleFocus}
                                onChange={this.handleChange}
                            >

                                <option value=''>Selecciones un area de conocimiento</option>
                                {this.state.researchGroups.length > 0 ? (
                                    this.state.researchGroups.map((researchGroup) => (
                                        <option
                                            value={researchGroup.id}
                                            key={researchGroup.id}>{researchGroup.name}
                                        </option>
                                    ))
                                ) : (
                                        <option value="">No educational Institution</option>
                                    )}
                            </select>
                            <span className="invalid-feedback">
                                {rules.researchGroup.message ? rules.researchGroup.message : requestValidation.researchGroup ? requestValidation.researchGroup : ''}
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

export default Create;
