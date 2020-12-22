Vue.component('my-btn', {
    props: {
        text: {
            type: String,
            default: 'Unspecified'
        }
    },
    methods: {
        clickBtn: function() {
            console.log("You have clicked btn with text: " + this.text)
        }
    },
    template: `
        <span>
            <button v-on:click="clickBtn">{{ text }}</button>
        </span>
    `
});

new Vue({
    el: '#vue-wrapper',
    data: {
        text: "This is text from vue instance",
        clickCount: 0
    },
    methods: {
        addOne: function() {
            this.clickCount++;
        },
        removeOne: function() {
            this.clickCount--;
            // this.clickCount -= 1;
            // this.clickCount = this.clickCount -1;
        }
    }, 
})