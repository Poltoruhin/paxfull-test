import React from 'react';

function PrivateChatMessage(props) {
    return (<li className="left clearfix">
        <div className="chat-body1 clearfix">
            <p>{props.text}</p>
            <div className="chat_time pull-right">09:40PM</div>
        </div>
    </li>);
}

export default PrivateChatMessage;
