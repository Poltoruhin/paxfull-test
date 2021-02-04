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
    }

    handleTradeClick(selectedTradeIndex) {
        this.setState({
            selectedTradeIndex,
            isSidebarExpanded: false,
        })
    }

    handleBurgerClick() {
        this.setState({isSidebarExpanded: !this.state.isSidebarExpanded})
    }

    componentDidMount() {
        fetch("http://localhost:80/api/trades")
            .then(res => res.json())
            .then(
                (result) => {
                    this.setState({
                        isLoaded: true,
                        trades: result.data,
                        selectedTradeIndex: result.data.length ? 0 : null
                    });
                },
                (error) => {
                    this.setState({
                        isLoaded: true,
                        error
                    });
                }
            )
    }

    render() {
        const {trades, selectedTradeIndex, isSidebarExpanded} = this.state;
        return (
            <>
                <Header isSidebarExpanded={isSidebarExpanded} onClick={() => this.handleBurgerClick()}/>
                <div className="container-fluid">
                    <Row>
                        <Sidebar
                            isSidebarExpanded={isSidebarExpanded}
                            trades={trades}
                            onClick={i => this.handleTradeClick(i)}
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
