<template>
    <AppLayout>
        <template #content>
            <div class="container mt-5">
                <h1 class="text-center mb-4">Add Student Details</h1>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <form @submit.prevent="addStudent" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" v-model="student.name" name="name" placeholder="Enter name">
                            </div>
                            <div class="form-group">
                                <label for="age">Age</label>
                                <input type="number" class="form-control" v-model="student.age" name="age" placeholder="Enter age">
                            </div>
                            <div class="form-group">
                                <label for="image">Upload Image</label>
                                <input type="file" class="form-control-file" @change="onFileChange" name="image">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="container mt-5">
                <h1 class="text-center mb-4">Student List</h1>
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr v-for="(studentDetails,key) in studentList" :key="key">
                                    
                                    <td>{{ studentDetails.name }}</td>
                                    <td>{{ studentDetails.age }}</td>
                                    <td>{{studentDetails.image}}</td>

                                    <td :style="{ backgroundColor: studentDetails.status === 1 ? '#c8e6c9' : '#ffcdd2' }">
                                        <i class="fa" :class="{'fa-check text-success': studentDetails.status === 1, 'fa-times text-danger': studentDetails.status !== 1}" aria-hidden="true"></i>
                                        {{ studentDetails.status === 1 ? 'Active' : 'Inactive' }}
                                    </td>

                                    <td>
                                        <form @submit.prevent="deleteStudent(studentDetails.id)" method="get" class="d-inline">
                                            
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                        <a  class="btn btn-primary btn-sm" @click.prevent="changeStatus(studentDetails.id)"><i class="fa-solid fa-circle-check" style="color: #63E6BE;"></i></a>
                                        <a href="#" class="btn btn-primary btn-sm edit-student" @click.prevent="editStudentDetails(studentDetails.id)">Edit</a>
            
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </template>
        <template #models>
            <div class="modal fade" id="studentEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="staticBackdropLabel">Student Update</h1>
                      <button type="button" @click.prevent="closeModel" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="studentEditContent">
                        <form @submit.prevent="updateStudent" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" v-model="editStudent.name" name="name" placeholder="Enter name">
                            </div>
                            <div class="form-group">
                                <label for="age">Age</label>
                                <input type="number" class="form-control" v-model="editStudent.age" name="age" placeholder="Enter age">
                            </div>
                            <div class="form-group">
                                <label for="image">Upload Image</label>
                                <input type="file" class="form-control-file" @change="onFileChange" name="image">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
        </template>
    </AppLayout>
</template>


<script>
import AppLayout from '@/Layouts/app.vue';

export default {
    components:{
        AppLayout
    },

    data() {
        return {
            student:{
                name:'',
                age:'',
                image:null,
            },
            editStudent:{
                name:'',
                age:'',
                image:'',
            },
            studentList:[],
        }
    },
    beforeMount() {
        this.getStudents();
    },
    methods:{
        async getStudents(){
            const students = (await axios.get(route('student.list'))).data;
            console.log('Updated students:', students);
            this.studentList = students;
        },
        async addStudent(){
            try {
                await axios.post(route('student.add'), this.student);
                this.getStudents();
                this.student.name = '';
                this.student.age = '';
                this.student.image = '';
            } catch (error) {
                console.log('Error adding student:', error);
            }
        },
        onFileChange(event) {
            const file = event.target.files[0];
            if (file) {
                console.log("File selected:", file.name);
                this.student.image = file.name;
                this.editStudent.image = file.name; 
            }
        },
        async deleteStudent(id){
            await axios.get(route('student.delete',id));
            this.getStudents();
        },

        async changeStatus(id){
            await axios.get(route('student.active',id));
            this.getStudents();
        },

        async editStudentDetails(id){
            const student = (await axios.get(route('student.get',id))).data;
            console.log(student);
            this.editStudent = { ...student }; 
            const modal = document.getElementById('studentEdit');
            if(modal){
                modal.classList.add('show');
                modal.style.display = 'block';
            }
        },

        async updateStudent(){
            await axios.post(route('student.update',this.editStudent.id),this.editStudent);
            const modal = document.getElementById('studentEdit');
            if(modal){
                modal.classList.remove('show');
                modal.style.display = 'none';
            }
            this.getStudents();
        },

        async closeModel(){
            const modal = document.getElementById('studentEdit');
            if(modal){
                modal.classList.remove('show');
                modal.style.display = 'none';
            }
        }

    }
}

</script>

<style lang="scss" scoped>

</style>
