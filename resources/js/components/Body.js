import React from 'react';
import { Sidebar, Menu, Icon,  Segment } from 'semantic-ui-react';
import {Link,Redirect} from 'react-router-dom';
import {Change,Submit} from '../components/Helpers';
import auth from '../auth/auth';


export default class Body extends React.Component{
    constructor(props) {
    super(props);
     this.state = {
         redirect: false
     }
    }

    logout(){
        auth.logout(()=>{
            this.setState(
                {redirect: true}
            )
        })

    }
    render(){
        let redirect = this.state.redirect;
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
                    <Menu.Item as='a' onClick={()=>this.logout()}>
                        <Icon name='x' color='red' />
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
                {redirect ? <Redirect to='/'/> : null}
            </div>


        )
    }
}
