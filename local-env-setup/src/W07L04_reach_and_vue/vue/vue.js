Vue.component('my-btn', {
    props: {
        text: {
            type: String,
            default: ''
        },
    },
    methods: {
        changeText: function () {
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
        addCount: function () {
            this.clickCount++;
        }
    }
})