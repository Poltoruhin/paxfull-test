import React from "react";
import PrivateChatMessage from "./PrivateChatMessage";

function PrivateChat(props) {
    const { interlocutor } = props;
    return (
        <>
            <div className="chat_container">
                <h2>{`Chat with ${interlocutor.name} Reputation: ${interlocutor.reputation}`}</h2>
                <div className="col-sm-9 message_section">
                    <div className="row">
                        <div className="chat_area">
                            <ul className="list-unstyled">
                                <PrivateChatMessage text="The first message" />
                                <PrivateChatMessage
                                    text="Contrary to popular belief, Lorem Ipsum is not simply random text. It has
                                        roots in a piece of classical Latin literature from 45 BC, making it
                                        over 2000 years old."
                                />
                                <PrivateChatMessage
                                    text="Contrary to popular belief, Lorem Ipsum is not simply random text. It has
                                        roots in a piece of classical Latin literature from 45 BC, making it
                                        over 2000 years old."
                                />
                                <PrivateChatMessage text="The last message" />
                            </ul>
                        </div>
                        <div className="message_write">
                            <textarea
                                className="form-control"
                                placeholder="type a message"
                            />
                            <div className="clearfix" />
                            <div className="chat_bottom">
                                <a href="#" className="pull-left upload_btn">
                                    <i
                                        className="fa fa-cloud-upload"
                                        aria-hidden="true"
                                    />
                                    Add Files
                                </a>
                                <a
                                    href="#"
                                    className="pull-right btn btn-success"
                                >
                                    Send
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}

export default PrivateChat;
