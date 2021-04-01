import React from 'react';
import { Button, Form, Grid, Header, Image, Message, Segment } from 'semantic-ui-react';
import {Link} from 'react-router-dom';
import {Change,Submit} from '../components/Helpers';

export default class Signup extends React.Component{
    constructor(props) {
        super(props);
        this.state = {
            fname:'',
            lname:'',
            username:'',
            email: '',
            password: '',
            valued:'',
        };
        this.Change = Change.bind(this)
        this.Submit = Submit.bind(this)
    }

    render(){
        let {fname,lname,username,email,password} = this.state;
        return (
            <div className="login">
            </div>
        )

    }

}
