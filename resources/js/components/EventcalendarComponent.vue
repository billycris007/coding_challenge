<template>
    <vue-cal
        :small="true"
        :events="events"
        :time="false"
        :showWeekNumbers="false"
        :selectedDate="new Date()"
        :hideViewSelector="true"
        events-count-on-year-view
        events-on-month-view="short"

        style="height: 250px"
    />
</template>
<script>
import VueCal from 'vue-cal';
import 'vue-cal/dist/vuecal.css';

export default {
    components: { 'vue-cal': VueCal },
    
    data() {
        return {
            events : []
        }
    },
    created() {
        let uri = 'http://coding-challenge.com/api/posts';
        this.axios.get(uri).then(response => {
        let res = response.data[0];
        let schedule = res.schedule.split(',');
        var temp_events = [];
        for (var i = 0; i < schedule.length; i++) {
            let event = {
                    start: schedule[i],
                    end: schedule[i],
                    title: res.event
                };
            temp_events.push(event);  
        }
        this.events = temp_events;
        });
    }
}
</script>