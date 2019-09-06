## How to choose
* Which is better for my next web app development project?
* Which framework or library offers the best performance?
* Which is the most suitable for me?
* What is virtual DOM?

### Vue - Based on AngularJS/Angular
* Installation
  * direct link - ```<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>```
  * node package manager - npm install vue
* vue specific commands start with "v-"
  * v-bind:title
  * v-on:click
  * v-model
* examples - [link](https://vuejs.org/v2/examples/svg.html) 

* Fiddle - [link](https://jsfiddle.net/chrisvfritz/50wL7mdz/)

```HTML
<div id="body-wrapper">
  <h1>{{ heading }} {{ clickCount || ''}}</h1>

  <button v-on:click="addCount">Add one</button>

  <my-btn text="This is my btn"></my-btn>
</div>
```
```JavaScript
Vue.component('my-btn', {
  props: {
    text: {
      type: String,
      default: ''
    },
  },
  methods: {
    changeText: function() {
			this.extraText = "The btn was clicked"
    }
  },
  data() {
   return {
       extraText: ""
   };
  },
  template: `
		<span>
      <button v-on:click="changeText">{{ text }}</button>
    	{{ extraText }}
    </span>
  `
})

new Vue({
  el: '#body-wrapper',
  data: {
    heading: 'This is how Vue binds data to html',
    clickCount: 0
  },
  methods: {
    addCount: function() {
    	this.clickCount ++;
    }
  }
})
```

### React - Facebook created

* Fiddle - [link](https://jsfiddle.net/reactjs/69z2wepo/)

```JavaScript
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
```
### CMS
* WordPress - most popular and widely used
* Joomla
* PrestaShop - A good setup for shop creation
* etc.
  
### Other
* Ember
* Backbone
* etc.