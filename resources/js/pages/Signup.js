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
                <Grid className='' textAlign='center' style={{ height: '100vh' }} verticalAlign='top'>
                  <Grid.Column style={{ maxWidth: 450 }}>
                    <Header as='h2' color='teal' textAlign='center'>
                     Create an account by Signing Up
                    </Header>
                    <Form size='large'>
                      <Segment stacked>
                        <Form.Input fluid icon='user outline' iconPosition='left'
                        name='fname'
                        value={fname}
                        onChange = {this.Change}
                        type='text' placeholder='First Name' />
                        <Form.Input fluid  iconPosition='left' type='text'
                        onChange = {this.Change}
                        name='lname'
                         placeholder='Last Name' value={lname} />
                        <Form.Input fluid icon='user' iconPosition='left'
                        onChange = {this.Change}
                        name='username'
                         type='text' placeholder='Username' value={username} />
                        <Form.Input fluid icon='mail' iconPosition='left'
                        onChange = {this.Change}
                        name='email'
                         type='email' placeholder='E-mail address' value={email} />
                        <Form.Input
                          fluid
                          icon='lock'
                          iconPosition='left'
                          placeholder='Password'
                          type='password'
                          value={password}
                          onChange = {this.Change}
                          name='password'
                        />

                        <Button color='teal' fluid size='large'
                        onClick= {() => this.Submit([fname,lname,email,username,password])}  >
                         Sign Up
                        </Button>
                      </Segment>
                    </Form>
                    <Message>
                      Already have an account? <Link to='/login'>Log In</Link>
                    </Message>
                  </Grid.Column>
                </Grid>


            </div>
        )

    }

}
