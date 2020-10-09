(function() {
    class CompHtml extends React.Component {
  
      constructor(props) {
        super(props);
        this.count = 0;
        this.onClick = this.onClick.bind(this);
      }
  
      onClick() {
        this.setState(() => this.count += 1);
      }
  
      render() {
        return (
        <div>
          <h1>{ this.props.heading } { this.count }</h1>
  
          <button onClick={this.onClick}>Add one</button>
        </div>
        );
      }
    }
  
    const html = <CompHtml heading="This is how ReactJs binds data to html" />;
  
    ReactDOM.render(html, document.getElementById('container'));
  })();