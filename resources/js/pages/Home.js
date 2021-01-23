import React from 'react';
import Body from '../components/Body';


export default class Home extends React.Component{
    render(){
        const content =
            <div className="content">
                <p className="">
                    AMa AMA AMA AMA
                    <br/>
                     at numquam alias commodi neque perspiciatis magni quasi similique?
                    <br/>
                    Facilis, eligendi? Corrupti quia magnam veritatis ab consectetur!
                </p>
            </div>
        return(
            <div className="">
                <Body content={content}/>
            </div>
        )
    }
}
