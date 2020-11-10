import React, { Component } from 'react';
import { find, update, rules } from '~/containers/KnowledgeAreas';
import { formValid, validate } from '~/containers/Validator';

class Edit extends Component {
    constructor(props) {
        super(props);

        this.state = {
            rules,
            touched: {},
            requestValidation: {},

            id: this.props.match.params.id,
            knowledgeArea: {},

        }

        this.handleSubmit = this.handleSubmit.bind(this);
        this.handleChange = this.handleChange.bind(this);
        this.handleFocus = this.handleFocus.bind(this);

    }

    componentDidMount() {
        this.getKnowledgeArea();
        this.resetValidator();
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
        const rulesKnowledgeArea = validate(rules, value, requestValidation, touched);
        this.setState({ rules: rulesKnowledgeArea });
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

    getKnowledgeArea() {
        find(this.state.id, 'edit').then(data => {
            this.setState({ knowledgeArea: data });
        })
    }


    render() {
        const { rules, requestValidation, knowledgeArea } = this.state;
        if (knowledgeArea.id == null) {
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
                                defaultValue=""
                                aria-describedby="nameHelp"
                                defaultValue={knowledgeArea.name}
                                maxLength={rules.name.max}
                                required
                                onFocus={this.handleFocus}
                                onChange={this.handleChange}
                            />
                            <span className="invalid-feedback">
                                {rules.name.message ? rules.name.message : requestValidation.name ? requestValidation.name : ''}
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
