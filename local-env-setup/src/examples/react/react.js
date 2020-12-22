(function() {
    class MyHTML extends React.Component {

        constructor(data) {
            super(data);
            this.clickCount = 0;
            this.addOne = this.addOne.bind(this);
            this.removeOne = this.removeOne.bind(this);
        }

        addOne() {
            this.setState(() => this.clickCount++)
        }

        removeOne() {
            this.setState(() => this.clickCount--)
        }

        render() {
            return (    
                <div>
                    <h1>{this.props.text}</h1>

                    <h2>You have clicked { this.clickCount } times</h2>

                    <button onClick={this.addOne}>Add one</button>
                    <button onClick={this.removeOne}>Remove one</button>
                </div>
            );
        }
    }

    ReactDOM.render(<MyHTML text="Call to myHTML 1"/>, document.getElementById("react-wrapper"));
    ReactDOM.render(<MyHTML text="Wooop"/>, document.getElementById("react-wrapper-one"));
})();