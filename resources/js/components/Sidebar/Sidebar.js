import React, { Component } from 'react';
import { NavLink } from 'react-router-dom';

class Sidebar extends Component {
  constructor(props) {
    super(props);
    this.activeRoute.bind(this);
  }

  activeRoute(routeName) {
    return this.props.location.pathname.indexOf(routeName) > -1 ? 'active' : '';
  }

  render() {
    const { routes } = this.props;

    return (
      <React.Fragment>
        <div className="sidebar">
          <div className="sidebar-wrapper" ref="sidebar">
            <ul className="nav">
              {routes.map((route, i) => {
                if (route.redirect) return null;
                let routeSplit = route.path.split('/');
                if(routeSplit[2]=='list'){
                  return (
                    <li className={this.activeRoute(route.path) + (route.pro ? ' active-pro': '')} key={i}>
                      <NavLink 
                        to={route.layout + route.path}
                        className="nav-link"
                        activeClassName="active"
                      >
                        <i className={route.icon}></i>
                        <p>{route.name}</p>
                      </NavLink>
                    </li>
                  )
                }
              })}
            </ul>
          </div>
        </div>
      </React.Fragment>
    )
  }
}

Sidebar.defaultProps = {
  routes: [{}]
};

export default Sidebar;