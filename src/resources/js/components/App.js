import React from 'react';
import Row from './Row';
import Header from "./Header";
import Sidebar from "./Sidebar";
import Main from "./Main";

class App extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            selectedTradeIndex: null,
            trades: [],
            isSidebarExpanded: false,
            error: null,
            isLoaded: false,
        };
        this.handleBurgerClick = this.handleBurgerClick.bind(this);
        this.handleTradeClick = this.handleTradeClick.bind(this);
    }

    handleTradeClick(selectedTradeIndex) {
        this.setState((prevState) => ({...prevState, selectedTradeIndex, isSidebarExpanded: false}))
    }

    handleBurgerClick() {
        this.setState((prevState) => ({...prevState, isSidebarExpanded: !prevState.isSidebarExpanded}))
    }

    componentDidMount() {
        fetch("http://localhost:80/api/trades")
            .then(res => res.json())
            .then(
                (result) => {
                    this.setState((prevState) => ({
                        ...prevState,
                        isLoaded: true,
                        trades: result.data,
                        selectedTradeIndex: result.data.length ? 0 : null
                    }))
                },
                (error) => {
                    this.setState((prevState) => ({
                        ...prevState,
                        isLoaded: true,
                        error
                    }))
                }
            )
    }

    render() {
        const {trades, selectedTradeIndex, isSidebarExpanded} = this.state;
        return (
            <>
                <Header isSidebarExpanded={isSidebarExpanded} onClick={this.handleBurgerClick}/>
                <div className="container-fluid">
                    <Row>
                        <Sidebar
                            isSidebarExpanded={isSidebarExpanded}
                            trades={trades}
                            onClick={this.handleTradeClick}
                        />
                        {(trades.length && trades[selectedTradeIndex])
                            ? <Main trade={trades[selectedTradeIndex]}/>
                            : <div>Not found data</div>
                        }
                    </Row>
                </div>
            </>
        );
    }
}

export default App;
