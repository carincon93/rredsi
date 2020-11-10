import React, { Component } from 'react';
import { BrowserRouter as Router, Switch, Route, Link, Redirect } from 'react-router-dom';

//Core components
import Sidebar from '~/components/Sidebar/Sidebar';
import PaginaError from '~/views/PaginaError';
import routes from '~/routes';
import PrivateRoute from '../../components/PrivateRoute';

class Admin extends Component {
  constructor(props) {
    super(props);
  }
  getRoutes() {
    return routes.map((route, i) => {
      if (route.layout === "/app") {
        if (route.name != 'Login') {
          return (
            <PrivateRoute
              path={route.layout + route.path}
              component={route.component}
              key={i}
            />

          );
        } else {
          return (
            <Route
              exact
              path={route.layout + route.path}
              component={route.component}
              key={i}
            />
          )
        }
      } else {
        return <Route component={PaginaError} />;
      }
    });
  }

  render() {
    return (
      <>
        <div className="wrapper">
          <Sidebar
            {...this.props}
            routes={routes}
          />
          <div
            className="main-panel"
            ref="mainPanel"
          >
            <div className="content">
              <Switch>
                {this.getRoutes()}
                <Route component={PaginaError} />
              </Switch>
            </div>
          </div>
        </div>
      </>
    );
  }
}

export default Admin;