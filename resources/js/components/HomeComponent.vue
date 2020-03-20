// HomeComponent.vue
<template>
<div class="row">
    <div class="card card-default">
        <div class="card-header">Calendar</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <form @submit.prevent="addPost">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Event</label>
                                    <input type="text" class="form-control" v-model="post.event">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>From</label>
                                    <date-picker v-model="post.from" :config="options"></date-picker>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>To</label>
                                    <date-picker v-model="post.to" :config="options"></date-picker>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="checkbox-inline">
                                    <input type="checkbox" v-model="post.mon">Mon
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" v-model="post.tue">Tue
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" v-model="post.wed">Wed
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" v-model="post.thu">Thu
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" v-model="post.fri">Fri
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" v-model="post.sat">Sat
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" v-model="post.sun">Sun
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-8">
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
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    import datePicker from 'vue-bootstrap-datetimepicker';
    import VueCal from 'vue-cal';

    export default {
        data(){
            return {
                events: [],
                post:{},
                options: {
                    format: 'YYYY-MM-DD',
                    useCurrent: false
                },
            }
        },
        components: { 
            'date-picker' : datePicker,
            'vue-cal': VueCal 
        },
        methods: {
            addPost(){
                // submit schedule and store to database
                let uri = 'http://coding-challenge.com/api/post/create';
                    this.axios.post(uri, this.post).then((response) => {
                        let res = response.data;
                        if(res.schedule){
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
                        }else{
                            alert('Week selected does not fall to date range.');
                        }
                    });
            }
        }
    }
</script>