import React from "react";

function Sidebar(props) {
    const { isSidebarExpanded, trades, onClick } = props;

    return (
        <div
            id="sidebarMenu"
            className={
                "col-md-3 col-lg-2 d-md-block bg-pinky sidebar collapse" +
                (isSidebarExpanded ? " show" : "")
            }
        >
            <div className="position-sticky">
                <h4 className="sidebar-heading d-flex justify-content-between align-items-center px-3">
                    <span>Trades</span>
                </h4>
                <ul className="nav flex-column mb-2 mt-3 sticky-top">
                    {trades.map((trade, i) => (
                        <li className="nav-item" key={trade.id}>
                            <a
                                className="nav-link"
                                href="#"
                                onClick={(e) => {
                                    e.preventDefault();
                                    onClick(i);
                                }}
                            >
                                {trade.buyer.name} - {trade.amount}$ (
                                {trade.status})
                            </a>
                        </li>
                    ))}
                </ul>
            </div>
        </div>
    );
}

export default Sidebar;
