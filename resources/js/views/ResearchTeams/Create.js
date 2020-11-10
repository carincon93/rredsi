import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import { store, rules } from '~/containers/ResearchTeams';
import { get as getKnowledgeAreas } from '~/containers/KnowledgeAreas';
import { get as getResearchTeamAdmin } from '~/containers/ResearchTeamAdmin';
import { getAcademicProgramsByEducationalInstitution, getResearchGroupByEducationalInstitution, getResearchLinesByResearchGroup } from '~/containers/EducationalInstitution';
import { getEducationalInstitutionsByNode } from '~/containers/Node';
import { formValid, validate } from '~/containers/Validator';

class Create extends Component {
    constructor(props) {
        super(props);

        this.state = {
            formData: {},
            touched: {},
            requestValidation: {},
            rules,

            knowledgeAreas: {},
            academicPrograms: {},
            researchTeamAdmin: {},
            researchGroups: {},
            researchLines: {},
            educationalInstitutions: {}
        }

        this.handleSubmit = this.handleSubmit.bind(this);
        this.handleChange = this.handleChange.bind(this);
        this.handleFocus  = this.handleFocus.bind(this);
    }

    componentDidMount() {
        this.getData();
    }

    handleSubmit(e) {
        e.preventDefault();
       
        if (formValid(rules)) {
          store(e.target).then(data => {
            if (data.status === 422)
                this.setState({requestValidation: data.errors});
            });
        }
    }

    handleChange(e) {
        const { name, value } = e.target;
        this.setState({formData: {[name]: value}});
        this.setValidation(rules, value);

        if (name == 'educational_institution_id' && Number(value) > 0) {
            this.getAcademicProgramsAndResearchGroups(value);
        } else if (name == 'research_group_id' && Number(value) > 0) {
            this.getResearchLines(value);
        }
    };
    
    handleFocus(e) {
        const { name } = e.target;
    
        this.setState({touched: {[name]: true}});
    }

    setValidation(rules, value) {
        let {requestValidation}    = this.state; 
        let {touched}              = this.state;
        const rulesResearchTeam    = validate(rules, value,requestValidation, touched);
    
        this.setState({rules: rulesResearchTeam });
    }
    
    getData() {
        getKnowledgeAreas().then(data => {
            this.setState({knowledgeAreas: data});
        });
        getEducationalInstitutionsByNode(1).then(data => {
            this.setState({educationalInstitutions: data});
        });
        getResearchTeamAdmin().then(data => {
            this.setState({researchTeamAdmin: data});
        })
    }
    
    getAcademicProgramsAndResearchGroups(educationalInstitutionID) {
        getAcademicProgramsByEducationalInstitution(educationalInstitutionID).then(data => {
            this.setState({academicPrograms: data});
        });
        getResearchGroupByEducationalInstitution(educationalInstitutionID).then(data => {
            this.setState({researchGroups: data});
        });
    }

    getResearchLines(researchGroupID) {
        getResearchLinesByResearchGroup(researchGroupID).then(data => {
            this.setState({researchLines: data});
        })
    }

    render() {
        const { rules, requestValidation, knowledgeAreas, academicPrograms, researchTeamAdmin, researchGroups, researchLines, educationalInstitutions } = this.state;
        return (
            <div className="container">
                <div className="form-wrapper">
                    <form
                        className="form" onSubmit={this.handleSubmit}
                        id="form"
                    >
                        <div className="form-group">
                            <label htmlFor="name">Nombre del semillero</label>
                            <small id="nameHelp" className="form-text text-muted">Campo requerido</small>
                            <input 
                                type="text" 
                                name="name" 
                                id="name" 
                                className={rules.name.isInvalid && rules.name.message !== '' || requestValidation.name ? 'form-control is-invalid': 'form-control'}
                                aria-describedby="nameHelp"
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
                            <label htmlFor="mentor_name">Nombre del tutor</label>
                            <small id="mentor_nameHelp" className="form-text text-muted">Campo requerido</small>
                            <input 
                                type="text" 
                                name="mentor_name" 
                                id="mentor_name" 
                                className={rules.mentor_name.isInvalid && rules.mentor_name.message !== '' || requestValidation.mentor_name ? 'form-control is-invalid': 'form-control'}
                                aria-describedby="mentor_nameHelp"
                                maxLength={rules.mentor_name.max}
                                required
                                onFocus={this.handleFocus}
                                onChange={this.handleChange}
                            />
                            <span className="invalid-feedback">
                                {rules.mentor_name.message ? rules.mentor_name.message : requestValidation.mentor_name ? requestValidation.mentor_name : ''}
                            </span>
                        </div>
                        <div className="form-group">
                            <label htmlFor="mentor_email">Correo electrónico del tutor</label>
                            <small id="mentor_emailHelp" className="form-text text-muted">Campo requerido</small>
                            <input 
                                type="email" 
                                name="mentor_email" 
                                id="mentor_email" 
                                className={rules.mentor_email.isInvalid && rules.mentor_email.message !== '' || requestValidation.mentor_email ? 'form-control is-invalid': 'form-control'}
                                aria-describedby="mentor_emailHelp"
                                maxLength={rules.mentor_email.max}
                                required
                                onFocus={this.handleFocus}
                                onChange={this.handleChange}
                            />
                            <span className="invalid-feedback">
                                {rules.mentor_email.message ? rules.mentor_email.message : requestValidation.mentor_email ? requestValidation.email : ''}
                            </span>
                        </div>
                        <div className="form-group">
                            <label htmlFor="mentor_cellphone">Número de celular del tutor</label>
                            <small id="mentor_cellphoneHelp" className="form-text text-muted">Campo requerido</small>
                            <input 
                                type="number" 
                                name="mentor_cellphone" 
                                id="mentor_cellphone" 
                                className={rules.mentor_cellphone.isInvalid && rules.mentor_cellphone.message !== '' || requestValidation.mentor_cellphone ? 'form-control is-invalid': 'form-control'}
                                aria-describedby="mentor_cellphoneHelp"
                                min="0"
                                max={rules.mentor_cellphone.max}
                                required
                                onFocus={this.handleFocus}
                                onChange={this.handleChange}
                            />
                            <span className="invalid-feedback">
                                {rules.mentor_cellphone.message ? rules.mentor_cellphone.message : requestValidation.mentor_cellphone ? requestValidation.mentor_cellphone : ''}
                            </span>
                        </div>
                        <div className="form-group">
                            <label htmlFor="overall_objective">Objetivo general</label>
                            <small id="overall_objectiveHelp" className="form-text text-muted">Campo requerido</small>
                            <textarea 
                                name="overall_objective" 
                                id="overall_objective" 
                                aria-describedby="overall_objectiveHelp"
                                className={rules.overall_objective.isInvalid && rules.overall_objective.message !== '' || requestValidation.overall_objective ? 'form-control is-invalid': 'form-control'}
                                required
                                onFocus={this.handleFocus}
                                onChange={this.handleChange}
                            ></textarea>
                            <span className="invalid-feedback">
                                {rules.overall_objective.message ? rules.overall_objective.message : requestValidation.overall_objective ? requestValidation.overall_objective : ''}
                            </span>
                        </div>
                        <div className="form-group">
                            <label htmlFor="mission">Misión</label>
                            <small id="missionHelp" className="form-text text-muted">Campo requerido</small>
                            <textarea 
                                name="mission" 
                                id="mission" 
                                aria-describedby="missionHelp"
                                className={rules.mission.isInvalid && rules.mission.message !== '' || requestValidation.mission ? 'form-control is-invalid': 'form-control'}
                                required
                                onFocus={this.handleFocus}
                                onChange={this.handleChange}
                            ></textarea>
                            <span className="invalid-feedback">
                                {rules.mission.message ? rules.mission.message : requestValidation.mission ? requestValidation.mission : ''}
                            </span>
                        </div>
                        <div className="form-group">
                            <label htmlFor="vision">Visión</label>
                            <small id="visionHelp" className="form-text text-muted">Campo requerido</small>
                            <textarea 
                                name="vision" 
                                id="vision" 
                                aria-describedby="visionHelp"
                                className={rules.vision.isInvalid && rules.vision.message !== '' || requestValidation.vision ? 'form-control is-invalid': 'form-control'}
                                required
                                onFocus={this.handleFocus}
                                onChange={this.handleChange}
                            ></textarea>
                            <span className="invalid-feedback">
                                {rules.vision.message ? rules.vision.message : requestValidation.vision ? requestValidation.vision : ''}
                            </span>
                        </div>
                        <div className="form-group">
                            <label htmlFor="regional_projection">Proyección regional y comunitaria</label>
                            <small id="regional_projectionHelp" className="form-text text-muted">Campo requerido</small>
                            <textarea 
                                name="regional_projection" 
                                id="regional_projection" 
                                aria-describedby="regional_projectionHelp"
                                className={rules.regional_projection.isInvalid && rules.regional_projection.message !== '' || requestValidation.regional_projection ? 'form-control is-invalid': 'form-control'}
                                required
                                onFocus={this.handleFocus}
                                onChange={this.handleChange}
                            ></textarea>
                            <span className="invalid-feedback">
                                {rules.regional_projection.message ? rules.regional_projection.message : requestValidation.regional_projection ? requestValidation.regional_projection : ''}
                            </span>
                        </div>
                        <div className="form-group">
                            <label htmlFor="knowledge_production_strategy">Estrategia de producción de conocimiento</label>
                            <small id="knowledge_production_strategyHelp" className="form-text text-muted">Campo requerido</small>
                            <textarea 
                                name="knowledge_production_strategy"
                                id="knowledge_production_strategy" 
                                aria-describedby="knowledge_production_strategyHelp"
                                className={rules.knowledge_production_strategy.isInvalid && rules.knowledge_production_strategy.message !== '' || requestValidation.knowledge_production_strategy ? 'form-control is-invalid': 'form-control'}
                                required
                                onFocus={this.handleFocus}
                                onChange={this.handleChange}
                            ></textarea>
                            <span className="invalid-feedback">
                                {rules.knowledge_production_strategy.message ? rules.knowledge_production_strategy.message : requestValidation.knowledge_production_strategy ? requestValidation.knowledge_production_strategy : ''}
                            </span>
                        </div>
                        <div className="form-group">
                            <label htmlFor="creation_date">Fecha de creación</label>
                            <small id="creation_dateHelp" className="form-text text-muted">Campo requerido</small>
                            <input 
                                type="date" 
                                id="creation_date" 
                                name="creation_date" 
                                className={rules.creation_date.isInvalid && rules.creation_date.message !== '' || requestValidation.creation_date ? 'form-control is-invalid': 'form-control'}
                                aria-describedby="creation_dateHelp"
                                required
                                onFocus={this.handleFocus}
                                onChange={this.handleChange}
                            />
                            <span className="invalid-feedback">
                                {rules.creation_date.message ? rules.creation_date.message : requestValidation.creation_date ? requestValidation.creation_date : ''}
                            </span>
                        </div>
                        <div className="form-group">
                            <label htmlFor="">Áreas de conocimiento</label>
                            <small id="knowledge_area_idHelp" className="form-text text-muted">Campo requerido</small>
                            {knowledgeAreas.length > 0 ? (
                                knowledgeAreas.map((knowledgeArea) => (
                                    <div className="form-check ml-2" key={knowledgeArea.id}>
                                        <input 
                                            type="checkbox" 
                                            id={knowledgeArea.name} 
                                            name="knowledge_area_id[]" 
                                            aria-describedby="knowledge_area_idHelp"
                                            value={knowledgeArea.id} 
                                            className="form-check-input"
                                            onFocus={this.handleFocus}
                                            onChange={this.handleChange}
                                        />
                                        <label className="form-check-label" htmlFor={knowledgeArea.name}>
                                            {knowledgeArea.name}
                                        </label>
                                    </div>
                                ))
                            ):(
                                <div>No knowledge areas</div>
                            )}
                            <span className={rules.knowledge_area_id.isInvalid && rules.knowledge_area_id.message !== '' || requestValidation.knowledge_area_id ? 'invalid-feedback d-block': 'invalid-feedback'} >
                                {rules.knowledge_area_id.message ? rules.knowledge_area_id.message : requestValidation.knowledge_area_id ? requestValidation.knowledge_area_id : '' }
                            </span>
                        </div>
                        <div className="form-group">
                            <label htmlFor="educational_institution_id">Institución educativa</label>
                            <small id="educational_institution_idHelp" className="form-text text-muted">Campo requerido</small>
                            <select 
                                name="educational_institution_id" 
                                id="educational_institution_id" 
                                className={rules.educational_institution_id.isInvalid && rules.educational_institution_id.message !== '' || requestValidation.educational_institution_id ? 'form-control is-invalid': 'form-control'}
                                aria-describedby="educational_institution_idHelp"
                                required
                                onFocus={this.handleFocus}
                                onChange={this.handleChange}
                            >
                                <option value=''>Seleccione una Institución educativa</option>
                                {educationalInstitutions.length > 0 ? (
                                    educationalInstitutions.map((educationalInstitution) => (
                                        <option value={educationalInstitution.id} key={educationalInstitution.id}>{educationalInstitution.name}</option>
                                    ))
                                ) : (
                                        <option value=''>No educational institutions</option>
                                    )
                                }
                            </select>
                            <span className="invalid-feedback">
                                {rules.educational_institution_id.message ? rules.educational_institution_id.message : requestValidation.educational_institution_id ? requestValidation.educational_institution_id : ''}
                            </span>
                        </div>
                        <div className="form-group">
                            <label htmlFor="">Programas de formación</label>
                            <small id="academic_program_idHelp" className="form-text text-muted">Campo requerido</small>
                            {academicPrograms.length > 0 ? (
                                academicPrograms.map(academicProgram => (
                                    <div className="form-check ml-2" key={academicProgram.id}>
                                        <input 
                                            type="checkbox" 
                                            name="academic_program_id[]" 
                                            id={academicProgram.name} 
                                            className="form-check-input" 
                                            aria-describedby="academic_program_idHelp"
                                            value={academicProgram.id} 
                                            onFocus={this.handleFocus}
                                            onChange={this.handleChange}
                                        />
                                        <label className="form-check-label" htmlFor={academicProgram.name}>
                                            {academicProgram.name}
                                        </label>
                                    </div>
                                ))
                            ) : (
                                    <div>No hay programas de formación en esta instución</div>
                                )
                            }
                            <span className={rules.academic_program_id.isInvalid && rules.academic_program_id.message !== '' || requestValidation.academic_program_id ? 'invalid-feedback d-block': 'invalid-feedback'} >
                                {rules.academic_program_id.message ? rules.academic_program_id.message : requestValidation.academic_program_id ? requestValidation.academic_program_id : '' }
                            </span>
                        </div>
                        <div className="form-group">
                            <label htmlFor="">Grupo de investigación</label>
                            <small id="research_group_idHelp" className="form-text text-muted">Campo requerido</small>
                            <select 
                                name="research_group_id" 
                                id="research_group_id" 
                                className={rules.research_group_id.isInvalid && rules.research_group_id.message !== '' || requestValidation.research_group_id ? 'form-control is-invalid': 'form-control'}
                                aria-describedby="research_group_idHelp"
                                required
                                onFocus={this.handleFocus}
                                onChange={this.handleChange}
                            >
                                <option value=''>Seleccione un grupo de investigación</option>
                                {researchGroups.length > 0 ? (
                                    researchGroups.map((researchGroup) => (
                                        <option value={researchGroup.id} key={researchGroup.id}>{researchGroup.name}</option>
                                    ))
                                ) : (
                                        <option value=''>No research groups by this institution</option>
                                    )
                                }
                            </select>
                            <span className="invalid-feedback">
                                {rules.research_group_id.message ? rules.research_group_id.message : requestValidation.research_group_id ? requestValidation.research_group_id : ''}
                            </span>
                        </div>
                        <div className="form-group">
                            <label htmlFor="">Líneas de investigación</label>
                            <small id="research_line_idHelp" className="form-text text-muted">Campo requerido</small>
                            { researchLines.length > 0 ? (
                                researchLines.map((researchLine) => (
                                    <div className="form-check ml-2" key={researchLine.id}>
                                        <input 
                                            type="checkbox" 
                                            name="research_line_id[]" 
                                            id={researchLine.name}                    
                                            className="form-check-input" 
                                            aria-describedby="research_line_idHelp"
                                            value={researchLine.id} 
                                            onFocus={this.handleFocus}
                                            onChange={this.handleChange}
                                        />
                                        <label className="form-check-label" htmlFor={researchLine.name}>
                                            {researchLine.name}
                                        </label>
                                    </div>
                                ))
                                ) : (
                                    <div>No research lines</div>
                                )
                            }
                            <span className={rules.research_line_id.isInvalid && rules.research_line_id.message !== '' || requestValidation.research_line_id ? 'invalid-feedback d-block': 'invalid-feedback'} >
                                {rules.research_line_id.message ? rules.research_line_id.message : requestValidation.research_line_id ? requestValidation.research_line_id : '' }
                            </span>
                        </div>
                        <div className="form-group">
                            <label htmlFor="administrator_id">Administrador del semillero</label>
                            <small id="administrator_idHelp" className="form-text text-muted">Campo requerido</small>
                            <select 
                                name="administrator_id" 
                                id="administrator_id" 
                                className={rules.administrator_id.isInvalid && rules.administrator_id.message !== '' || requestValidation.administrator_id ? 'form-control is-invalid': 'form-control'}
                                aria-describedby="administrator_idHelp"
                                onFocus={this.handleFocus}
                                onChange={this.handleChange}
                                required
                            >
                                <option value=''>Seleccione un administrador de semillero</option>
                                {researchTeamAdmin.length > 0 ? (
                                    researchTeamAdmin.map((ResearchTeamAdmin) => (
                                        <option value={ResearchTeamAdmin.id} key={ResearchTeamAdmin.id}>{ResearchTeamAdmin.user.name}</option>
                                    ))
                                ) : (
                                        <option value=''>No research groups by this institution</option>
                                    )
                                }
                            </select>
                            <span className="invalid-feedback">
                                {rules.administrator_id.message ? rules.administrator_id.message : requestValidation.administrator_id ? requestValidation.administrator_id : ''}
                            </span>
                        </div>
                        <div className="form-group">
                            <label htmlFor="thematic_research">Temáticas de investigación (Separados por coma)</label>
                            <small id="thematic_researchHelp" className="form-text text-muted">Campo requerido</small>
                            <textarea 
                                name="thematic_research" 
                                id="misthematic_researchsion" 
                                className={rules.thematic_research.isInvalid && rules.thematic_research.message !== '' || requestValidation.thematic_research ? 'form-control is-invalid': 'form-control'}
                                aria-describedby="thematic_researchHelp"
                                required
                                onFocus={this.handleFocus}
                                onChange={this.handleChange}
                            ></textarea>
                            <span className="invalid-feedback">
                                {rules.thematic_research.message ? rules.thematic_research.message : requestValidation.thematic_research ? requestValidation.thematic_research : ''}
                            </span>
                        </div>
                        <div className="form-group">
                            <button className="btn btn-block btn-primary" type="submit" form="form">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        )
    }
}

export default Create;