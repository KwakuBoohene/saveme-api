import React from 'react';
import { Button, Form, Grid, Header, Image, Message, Segment } from 'semantic-ui-react';
import {Link} from 'react-router-dom';

export default function Signup() {
    return (
        <div className="login">
            <Grid className='' textAlign='center' style={{ height: '100vh' }} verticalAlign='top'>
              <Grid.Column style={{ maxWidth: 450 }}>
                <Header as='h2' color='teal' textAlign='center'>
                 Create an account by Signing Up
                </Header>
                <Form size='large'>
                  <Segment stacked>
                    <Form.Input fluid icon='user outline' iconPosition='left' type='text' placeholder='First Name' />
                    <Form.Input fluid  iconPosition='left' type='text' placeholder='Last Name' />
                    <Form.Input fluid icon='user' iconPosition='left' type='email' placeholder='Username' />
                    <Form.Input fluid icon='mail' iconPosition='left' type='email' placeholder='E-mail address' />
                    <Form.Input
                      fluid
                      icon='lock'
                      iconPosition='left'
                      placeholder='Password'
                      type='password'
                    />

                    <Button color='teal' fluid size='large'>
                      Login
                    </Button>
                  </Segment>
                </Form>
                <Message>
                  New to us? <Link to='/signup'>Sign Up</Link>
                </Message>
              </Grid.Column>
            </Grid>


        </div>
    )
}
