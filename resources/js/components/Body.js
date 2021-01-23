import React from 'react';
import { Button, Form, Grid, Header,
    Icon, Image, Menu, Message,  Segment, Sidebar } from 'semantic-ui-react';
import {Link} from 'react-router-dom';
import {Change,Submit} from '../components/Helpers';


export default class Body extends React.Component{
    render(){
        return(
            <div className="body">
                  <Sidebar.Pushable as={Segment}>
                    <Sidebar
                    as={Menu}
                    icon='labeled'
                    inverted
                    vertical
                    visible
                    width='thin'
                    >
                    <Menu.Item as='a'>
                        <Icon name='home' />
                        Home
                    </Menu.Item>
                    <Menu.Item as='a'>
                        <Icon name='gamepad' />
                        Games
                    </Menu.Item>
                    <Menu.Item as='a'>
                        <Icon name='camera' />
                        Channels
                    </Menu.Item>
                    <Menu.Item as='a'>
                        <Icon name='x' />
                        Logout
                    </Menu.Item>
                    </Sidebar>

                    <Sidebar.Pusher>
                    <Segment basic>
                        <div className="main">
                            {this.props.content}
                        </div>
                    </Segment>
                    </Sidebar.Pusher>

                </Sidebar.Pushable>
            </div>
        )
    }
}
