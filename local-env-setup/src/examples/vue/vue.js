Vue.component('vue-button', {
    props: {
        text: {
            type: String,
            default: ''
        }
    },
    methods: {
        addTextToComponent: function() {
            this.addedText = "You have clicked the button " + this.text;
        }
    },
    data() {
        return {
            addedText: ""
        }
    },
    template: `
    <span>
        <button v-on:click="addTextToComponent">{{ text }}</button>
        {{ addedText }}
    </span>
    `
})

new Vue({
    el: '#container',
    data: {
        heading: 'I\'m a Vue heading',
        clickCount: 0
    },
    methods: {
        addCount: function() {
            this.clickCount ++;
        },
        reduceCount: function() {
            this.clickCount --;
        }
    }
})