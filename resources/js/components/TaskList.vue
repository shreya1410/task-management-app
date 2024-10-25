<template>
  <div class="container mt-5">
    
    <div class="d-flex justify-content-between align-items-center">
      <h1 class="text-center mb-4">Task List</h1>
      <button type="button" class="btn btn-primary" @click="openModal">
        {{ 'Add Task' }}
    </button>
    </div>

    <div class="row">
      <div class="col-md-8 offset-md-2">
        <ul class="list-group">
          <li class="list-group-item" v-for="task in tasks" :key="task.id">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h5 class="mb-1">{{ task.name }}</h5>
                <p class="mb-1">{{ task.description }}</p>
              </div>
              <div class="d-flex align-items-center">
                <select v-model="task.status" @change="updateTaskStatus(task)" class="form-select me-2">
                  <option value="Pending">Pending</option>
                  <option value="In Progress">In Progress</option>
                  <option value="Completed">Completed</option>
                </select>
                <button class="btn btn-primary btn-sm me-2" @click="editTask(task)">Edit</button>
                <button class="btn btn-danger btn-sm" @click="deleteTask(task.id)">Delete</button>
              </div>
            </div>
          </li>
        </ul>
      </div>

      <div v-if="showModal">
        <task-form :task="task" ref="taskForm" @close="closeModal" @task-added="fetchTasks" @task-updated="fetchTasks"></task-form>
      </div>
      
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import TaskForm from './TaskForm.vue'; 

export default {
  name: 'task-list',
  components: {
    TaskForm,
  },
  data() {
    return {
      tasks: [],
      showModal:false,
    taskIdToDelete: null, 
      task: {
        id: null,
        name: '',
        description: '',
        status: 'Pending',
      },
    };
  },
  methods: {
  
    fetchTasks() {
      axios.get('/api/tasks').then(response => {
        this.tasks = response.data;
      });
    },
    updateTaskStatus(task) {
      axios.put(`/api/tasks/${task.id}`, task)
        .then(response => {
          alert('Task status updated successfully.');
          this.clearFormValues();
        }).catch(error => {
          console.log(error);
        });
    },
    showAddTaskModal() {
      this.resetTask(); 
      const modal = new bootstrap.Modal(this.$refs.taskFormModal);
      modal.show();
    },
    resetTask() {
      this.task = {
        id: null,
        name: '',
        description: '',
        status: 'Pending',
      };
    },
    openModal(){
      this.showModal = true;
    },
    closeModal(){
      this.showModal = false;
      this.clearFormValues();
    },
    clearFormValues(){
      this.task.id = null;
      this.task.name = '';
      this.task.description = '';
      this.task.status = 'Pending';
    },
    editTask(task){
      axios.get(`/api/tasks/${task.id}`)
        .then(response => {
          this.task = { ...task }; 
          this.showModal = true;
        }).catch(error => {
          console.log(error);
        });
    },
    deleteTask(id) {
      axios.delete(`/api/tasks/${id}`).then(response => {
        this.fetchTasks(); 
      });
    },
  
   
  },
  mounted() {
    this.fetchTasks();
    axios.get('/api/user')
        .then(response => response.json())
        .then(data => {
            
        })
        .catch(error => console.error('Error fetching data:', error));
  },
};
</script>

<style scoped>
ul {
  list-style-type: none;
  padding: 0;
}
li {
  margin: 10px 0;
}
</style>
