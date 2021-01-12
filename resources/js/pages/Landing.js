import React from 'react';

import { Button } from 'semantic-ui-react';
import { Link } from 'react-router-dom';



export default function Landing() {
    return (
        <div>
            <div className="head">
                <header className="">
                    <div className="header-icon">
                        <h2 className="">SAVEme APP</h2>
                    </div>

                    <div className="nav">
                        <Button as={Link} to='/login' color="green">
                            Login
                        </Button>

                        <Button as={Link} to='/signup'  color="olive">
                            Sign Up
                        </Button>
                    </div>
                </header>
            </div>

        </div>
    )
}
