import React from 'react';
import{Route,Switch,BrowserRouter as Router} from 'react-router-dom';
import Landing from './pages/Landing';
import Signup from './pages/Signup';
import Login from  './pages/Login';
import Home from './pages/Home';
import {ProtectedRoute} from './components/ProtectedRoute';

export default function Routes(){
    return (
        <Router>
            <Switch>
                <Route path='/login' component={Login}/>
                <Route path="/signup" compnent={Signup}/>
                <Route exact path='/' component = {Landing}/>
                <ProtectedRoute path='/home' component={Home} />
                <Route path="*" component={()=>" 404 PAGE NOT FOUND"} />
            </Switch>
        </Router>
    )

}
