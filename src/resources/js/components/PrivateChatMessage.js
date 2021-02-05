import React from 'react';

const PrivateChatMessage = ({ text }) => {
    return (<li className="left clearfix">
        <div className="chat-body1 clearfix">
            <p>{text}</p>
            <div className="chat_time pull-right">09:40PM</div>
        </div>
    </li>);
}

export default PrivateChatMessage;
