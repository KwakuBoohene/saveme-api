import React, { Component } from 'react'
import {Route,Redirect} from 'react-router-dom';
import auth from '../auth/auth';

export const ProtectedRoute = ({component:Component, ...rest}) =>{
    return (
        <Route {...rest}
        render={
            (props) => {
                if(auth.isAuthenticated()){
                    return <Component {...props} />;
                }else{
                    return <Redirect to='/'/>
                }

            }
        } />
    )
}
