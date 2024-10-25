<template>
  <div>
    
    <div  class="custom-modal-overlay">
      <div class="custom-modal">
        <div class="modal-header">
          <h5>{{ task.id ? 'Edit Task' : 'Add Task' }}</h5>
          <button type="button" class="close" @click="this.$emit('close')">x</button>
        </div>
        <div class="modal-body">
          <!-- Task Form Inside Modal -->
          <form @submit.prevent="submitForm">
            <div class="mb-3">
              <label for="taskName" class="form-label">Task Name:</label>
              <input
                type="text"
                id="taskName"
                v-model="localTask.name"
                class="form-control"
                required
              />
            </div>
            <div class="mb-3">
              <label for="taskDescription" class="form-label">Description:</label>
              <textarea
                id="taskDescription"
                v-model="localTask.description"
                class="form-control"
                rows="3"
              ></textarea>
            </div>
            <div class="mb-3">
              <label for="taskStatus" class="form-label">Status:</label>
              <select
                id="taskStatus"
                v-model="localTask.status"
                class="form-select"
              >
                <option value="Pending">Pending</option>
                <option value="In Progress">In Progress</option>
                <option value="Completed">Completed</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary">
              {{ task.id ? 'Update' : 'Add' }} Task
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'task-form',
  props: ['task','showModal'],
  data() {
    return {
      localTask: {
        id: null,
        name: '',
        description: '',
        status: 'Pending',
      },
    };
  },
  watch: {
    task: {
      immediate: true,
      handler(newTask) {
        this.localTask = { ...newTask };
      },
    },
  },
  methods: {
    async submitForm() {
      if (this.localTask.id) {
        const token = localStorage.getItem('authToken');
        await axios.put(`/api/tasks/${this.localTask.id}`, this.localTask, {
            headers: {
              'Authorization': `Bearer ${token}`
            }
          })
          .then(response => {
            this.$emit('task-updated');
          }).catch(error => {
            console.log(error);
            alert('Error updating task.');
          });
      } else {
        await axios.post('/api/tasks', this.localTask)
          .then(response => {
            this.$emit('task-added');
          }).catch(error => {
            console.log(error);
            alert('Error adding task.');
          });
      }
      this.$emit('close');
    }
  },
};
</script>

<style scoped>
.custom-modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
}

.custom-modal {
  background: white;
  padding: 20px;
  border-radius: 8px;
  width: 100%;
  max-width: 500px;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.modal-body {
  margin-top: 15px;
}

.close {
  background: none;
  border: none;
  font-size: 1.5rem;
  cursor: pointer;
}

.form-control,
.form-select {
  width: 100%;
  padding: 10px;
  margin-top: 5px;
  margin-bottom: 15px;
}

.btn {
  width: 100%;
}
</style>
