import React, { Component } from 'react';
import { store, rules } from '~/containers/ResearchGroup';
import { formValid, validate } from '~/containers/Validator';
import { get } from '~/containers/NodeAdmin';


class Create extends Component {
    constructor(props) {
        super(props);

        this.state = {
            touched: {},
            requestValidation: {},
            nodeAdmins: {},
            rules,
        }

        this.handleSubmit = this.handleSubmit.bind(this);
        this.handleChange = this.handleChange.bind(this);
        this.handleFocus = this.handleFocus.bind(this);
    }

    componentDidMount() {
        this.getNodeAdmins();
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

    getNodeAdmins() {
        get().then(data => {
            this.setState({ nodeAdmins: data })
        })
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
                                defaultValue=""
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
                            <label htmlFor="email">email</label>
                            <small id="emailhelp" className="form-text text-muted">
                                Campo requerido
                            </small>
                            <input
                                type="email"
                                name="email"
                                className={rules.email.isInvalid && rules.email.message !== '' || requestValidation.email ? 'form-control is-invalid' : 'form-control'}
                                id="email"
                                defaultValue=""
                                aria-describedby="emailHelp"
                                maxLength={rules.email.max}
                                required
                                onFocus={this.handleFocus}
                                onChange={this.handleChange}
                            />
                            <span className="invalid-feedback">
                                {rules.email.message ? rules.email.message : requestValidation.email ? requestValidation.email : ''}
                            </span>
                        </div>
                        <div className="form-group">
                            <label htmlFor="leader">leader</label>
                            <small id="leaderHelp" className="form-text text-muted">
                                Campo requerido
                            </small>
                            <input
                                type="text"
                                name="leader"
                                className={rules.leader.isInvalid && rules.leader.message !== '' || requestValidation.leader ? 'form-control is-invalid' : 'form-control'}
                                id="leader"
                                defaultValue=""
                                aria-describedby="leaderHelp"
                                maxLength={rules.leader.max}
                                required
                                onFocus={this.handleFocus}
                                onChange={this.handleChange}
                            />
                            <span className="invalid-feedback">
                                {rules.leader.message ? rules.leader.message : requestValidation.leader ? requestValidation.leader : ''}
                            </span>
                        </div>
                        <div className="form-group">
                            <label htmlFor="gruplac">gruplac</label>
                            <small id="gruplacHelp" className="form-text text-muted">
                                Campo requerido
                            </small>
                            <input
                                type="url"
                                name="gruplac"
                                className={rules.gruplac.isInvalid && rules.gruplac.message !== '' || requestValidation.gruplac ? 'form-control is-invalid' : 'form-control'}
                                id="gruplac"
                                defaultValue=""
                                aria-describedby="gruplacHelp"
                                maxLength={rules.gruplac.max}
                                required
                                onFocus={this.handleFocus}
                                onChange={this.handleChange}
                            />
                            <span className="invalid-feedback">
                                {rules.gruplac.message ? rules.gruplac.message : requestValidation.gruplac ? requestValidation.gruplac : ''}
                            </span>
                        </div>
                        <div className="form-group">
                            <label htmlFor="minciencias_code">minciencias_code</label>
                            <small id="minciencias_codeHelp" className="form-text text-muted">
                                Campo requerido
                            </small>
                            <input
                                type="text"
                                name="minciencias_code"
                                className={rules.minciencias_code.isInvalid && rules.minciencias_code.message !== '' || requestValidation.minciencias_code ? 'form-control is-invalid' : 'form-control'}
                                id="minciencias_code"
                                defaultValue=""
                                aria-describedby="minciencias_codeHelp"
                                maxLength={rules.minciencias_code.max}
                                required
                                onFocus={this.handleFocus}
                                onChange={this.handleChange}
                            />
                            <span className="invalid-feedback">
                                {rules.minciencias_code.message ? rules.minciencias_code.message : requestValidation.minciencias_code ? requestValidation.minciencias_code : ''}
                            </span>
                        </div>
                        <div className="form-group">
                            <label htmlFor="minciencias_category">Nodo</label>
                            <small id="node_idHelp" className="form-text text-muted">Campo requerido</small>
                            <select
                                id="minciencias_category"
                                name="minciencias_category"
                                className={rules.minciencias_category.isInvalid && rules.minciencias_category.message !== '' || requestValidation.minciencias_category ? 'form-control is-invalid' : 'form-control'}
                                defaultValue=""
                                aria-describedby="node_idHelp"
                                required
                                onFocus={this.handleFocus}
                                onChange={this.handleChange}
                            >
                                <option value=''>Seleccione una categoria</option>

                                <option value="A" key="A">A</option>
                                <option value="B" key="B">B</option>

                            </select>
                            <span className="invalid-feedback">
                                {rules.minciencias_category.message ? rules.minciencias_category.message : requestValidation.minciencias_category ? requestValidation.minciencias_category : ''}

                            </span>
                        </div>
                        <div className="form-group">
                            <label htmlFor="website">website</label>
                            <small id="websiteHelp" className="form-text text-muted">
                                Campo requerido
                            </small>
                            <input
                                type="url"
                                name="website"
                                className={rules.website.isInvalid && rules.website.message !== '' || requestValidation.website ? 'form-control is-invalid' : 'form-control'}
                                id="website"
                                defaultValue=""
                                aria-describedby="websiteHelp"
                                maxLength={rules.website.max}
                                required
                                onFocus={this.handleFocus}
                                onChange={this.handleChange}
                            />
                            <span className="invalid-feedback">
                                {rules.website.message ? rules.website.message : requestValidation.website ? requestValidation.website : ''}
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
