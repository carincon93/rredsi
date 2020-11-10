/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter as Router, Switch, Route } from 'react-router-dom';
require('./bootstrap');

/**
 * Next, we will create a fresh React component instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import AdminLayout from './layouts/Admin/Admin';

ReactDOM.render(
  <Router>
    <Switch>
      <Route path="/app" render={props => <AdminLayout {...props}></AdminLayout>}></Route>
    </Switch>
  </Router>,
  document.getElementById('app')
);

