import React from 'react';
import{Route,Switch,BrowserRouter as Router} from 'react-router-dom';
import Landing from './pages/Landing';
import Signup from './pages/Signup';
import Login from  './pages/Login';

export default function Routes(){
    return (
        <Router>


                <Route path='/login'>
                    <Login/>
                </Route>

                <Route path="/signup">
                    <Signup/>
                </Route>

                <Route exact path='/'>
                    <Landing/>
                </Route>
        </Router>
    )

}
