import React, { Component } from 'react';
import { find, update, rules, departamentos } from '~/containers/Node';
import { formValid, validate } from '~/containers/Validator';
import { get } from '~/containers/NodeAdmin';


class Edit extends Component {
    constructor(props) {
        super(props);

        this.state = {
            rules,
            touched: {},
            requestValidation: {},
            nodeAdmins: {},
            id: this.props.match.params.id,
            node: {}
        }
        this.state.departamentos = departamentos;

        this.handleSubmit = this.handleSubmit.bind(this);
        this.handleChange = this.handleChange.bind(this);
        this.handleFocus = this.handleFocus.bind(this);
    }

    componentDidMount() {
        this.getNode();
        this.resetValidator();
        this.getNodeAdmins();

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
        const rulesNode = validate(rules, value, requestValidation, touched);
        this.setState({ rules: rulesNode });
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

    getNode() {
        find(this.state.id, 'edit').then(data => {
            this.setState({ node: data });
        })
    }
    getNodeAdmins() {
        get().then(data => {
            this.setState({ nodeAdmins: data })
        })
    }

    render() {
        const { rules, requestValidation, node } = this.state;
        if (node.id == null) {
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
                            <label htmlFor="state">state</label>
                            <small id="stateHelp" className="form-text text-muted">Campo requerido</small>
                            <select id="state"
                                name="state"
                                className={rules.state.isInvalid && rules.state.message !== '' || requestValidation.state ? 'form-control is-invalid' : 'form-control'}
                                required
                                defaultValue={node.state}
                                onFocus={this.handleFocus}
                                onChange={this.handleChange}
                            >
                                <option value='none'>Seleccione un departamento</option>
                                {this.state.departamentos.state.name.length > 0 ? (
                                    this.state.departamentos.state.name.map((departamento) => (
                                        // <option value={departamento.state.name} key={departamento.state.name}>{departamento.state.name}</option>
                                        <option value=""></option>
                                    ))
                                ) : (
                                        <option value="">No departamentos</option>
                                    )}
                            </select>
                            <span className="invalid-feedback">
                                {rules.state.message ? rules.state.message : requestValidation.state ? requestValidation.state : ''}
                            </span>
                        </div>
                        <div className="form-group">
                            <label htmlFor="administrator_id">administrator_id</label>
                            <small id="administrador_idHelp" className="form-text text-muted">Campo requerido</small>
                            <select id="administrator_id"
                                name="administrator_id"
                                className={rules.administrator_id.isInvalid && rules.administrator_id.message !== '' || requestValidation.administrator_id ? 'form-control is-invalid' : 'form-control'}
                                required
                                onFocus={this.handleFocus}
                                onChange={this.handleChange}
                                defaultValue={node.administrator_id}

                            >

                                <option value=''>Seleccione una institución educativa</option>
                                {this.state.nodeAdmins.length > 0 ? (
                                    this.state.nodeAdmins.map((nodeAdmin) => (
                                        <option
                                            value={nodeAdmin.user.id}
                                            key={nodeAdmin.user.id}>{nodeAdmin.user.name}
                                        </option>
                                    ))
                                ) : (
                                        <option value="">No educational institutions</option>
                                    )}
                            </select>
                            <span className="invalid-feedback">
                                {rules.administrator_id.message ? rules.administrator_id.message : requestValidation.administrator_id ? requestValidation.administrator_id : ''}
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
