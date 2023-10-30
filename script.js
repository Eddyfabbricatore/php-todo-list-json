const { createApp } = Vue;

createApp({
  data(){
    return{
      apiUrl: 'server.php',
      title: 'ToDo List',
      list: [],
      newTask: '',
      errorMessage: ''
    }
  },

  methods:{
    getList(){
      axios.get(this.apiUrl)
      .then(result => {
        this.list = result.data;
      })
    },

    addTask(){
      this.errorMessage = '';

      const data = new FormData();

      data.append('toDoItem', this.newTask);

      axios.post(this.apiUrl, data)
      .then(result => {
        this.list = result.data;

        this.newTask = '';
      })
    },

    removeTask(index){
      if(this.list[index]['done']){
        this.errorMessage = '';

        const data = new FormData();

        data.append('indexToDelete', index);

        axios.post(this.apiUrl, data)
        .then(result => {
          this.list = result.data;
        })
      }else{
        this.errorMessage = 'Task ancora da concludere';
      }
    },

    taskDone(index){
      this.errorMessage = '';

      this.list[index]['done'] = !this.list[index]['done'];
    }
  },

  mounted(){
    this.getList();
  }
}).mount('#app');