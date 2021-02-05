import React from 'react';
import Logo from "./Logo";

function Header(props) {
    const {isSidebarExpanded} = props;

    return <header className="navbar navbar-light sticky-top bg-white flex-md-nowrap p-0 shadow-sm">
        <a className="navbar-brand header-brand col-md-3 col-lg-2 me-0 px-3 p-3" href="https://paxful.com">
            <Logo />
        </a>
        <button className={"navbar-toggler position-absolute d-md-none" + (isSidebarExpanded ? '' : ' collapsed')}
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#sidebarMenu"
                aria-controls="sidebarMenu"
                aria-expanded={isSidebarExpanded ? 'true' : 'false'}
                aria-label="Toggle navigation"
                onClick={props.onClick}
        >
            <span className="navbar-toggler-icon" />
        </button>
    </header>;
}

export default Header;
