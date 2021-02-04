import React from 'react';
import MainColumn from "./MainColumn";
import Row from "./Row";
import TradeInfo from "./TradeInfo";
import PrivateChat from "./PrivateChat";

function Main(props) {
    const {trade} = props;
    return (<main className="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-4">
        <Row>
            <MainColumn>
                <TradeInfo trade={trade} />
            </MainColumn>
            <MainColumn>
                <PrivateChat interlocutor={trade.buyer}/>
            </MainColumn>
        </Row>
    </main>);
}

export default Main;
