import React from "react";

function TradeInfo(props) {
    const {trade} = props;
    return <>
        <h2>Trade info</h2>
        <div className="trade-info">
            <ul className="list-group list-group-flush">
                <li className="list-group-item">Amount: {trade.amount}$</li>
                <li className="list-group-item">Payment Method: {trade.payment_method}</li>
                <li className="list-group-item">Trade Status: {trade.status}</li>
                <li className="list-group-item">Buyer name: {trade.buyer.name}</li>
            </ul>
        </div>
    </>
}

export default TradeInfo;
