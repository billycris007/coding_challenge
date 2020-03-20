<template>
    <date-picker :value="date" :config="options" @input="handleDate"></date-picker>
</template>

<script>
  // Import this component
  import datePicker from 'vue-bootstrap-datetimepicker';
  
  // Import date picker css
  import 'pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.css';
   
  export default {  
    props: ['value'],
    data () {
      return {
        date: "",
        options: {
          format: 'YYYY-MM-DD',
          useCurrent: false
        },
        content: this.value 
      }
    },
    components: {
      datePicker
    },
    methods: {
        handleDate() {
            this. $emit('input', this.content)
        }
    }
  }
</script>