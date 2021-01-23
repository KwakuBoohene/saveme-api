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
        <Grid className='' textAlign='center' style={{ height: '100vh' }} verticalAlign='top'>
          <Grid.Column style={{ maxWidth: 450 }}>
            <Header as='h2' color='teal' textAlign='center'>
             Log-in to your account
            </Header>
            <Form size='large'   >
              <Segment stacked>
                <Form.Input fluid icon='user' iconPosition='left'
                placeholder='E-mail address' name='email' type='email'
                 value={email} onChange = {this.Change}  />
                <Form.Input
                  fluid icon='lock' iconPosition='left' placeholder='Password'
                  name='password'  type='password' value = {password} onChange= {this.Change}

                />

                <Button type='button' color='teal' fluid size='large' onClick = {()=> this.login()}   >
                  Login
                </Button>
              </Segment>
            </Form>
            <Message>
              New to us? <Link to='/signup'>Sign Up</Link>
            </Message>
          </Grid.Column>
        </Grid>

            {
                logged ? <Redirect to='/home'/> : null
            }
    </div>
     )
    }
}

