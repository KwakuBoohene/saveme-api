import React from 'react';
import { Button, Form, Grid, Header, Image, Message, Segment } from 'semantic-ui-react';
import {Link,Redirect} from 'react-router-dom';
import {Change,Submit} from '../components/Helpers';
import auth from '../auth/auth';

export default class Login extends React.Component{
    constructor(props) {
        super(props);
        this.state = {
            email: '',
            password: '',
            valued:'',
            logged: false,
        };
        this.Change = Change.bind(this)
        this.Submit = Submit.bind(this)
    }

    enter(value){
        this.setState({
            valued: value
        })
    }

    login(){
        let {email,password} = this.state;
        auth.login(()=>{
            this.setState({
                logged: true
            })
        })
    }
    render(){
        let {email,password,logged} = this.state;
        return(
        <div className="login">
            {
                logged ? <Redirect to='/home'/> : null
            }
        </div>
     )
    }
}

