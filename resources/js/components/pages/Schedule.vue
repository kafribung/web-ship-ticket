<template>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Jadwal Ferry</h1>
        </div>

        <!-- Content Row -->
        <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-12 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <button class="btn btn-primary btn-circle btn-sm float-right" data-toggle="modal" data-target="#modalStore"><i class="fa fa-plus"></i></button>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Kapal</th>
                                    <th scope="col">Keberangkatan</th>
                                    <th scope="col">Tujuan</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(schedule, index) in schedules" :key="index">
                                    <th scope="row">{{ index+1 }}</th>
                                    <td>{{ schedule.ship }}</td>
                                    <td>{{ schedule.departure }}</td>
                                    <td>{{ schedule.destination }}</td>
                                    <td>{{ schedule.date }}</td>
                                    <td>
                                        <button  @click="editschedule(schedule.id)" class="btn btn-warning btn-circle btn-sm" data-toggle="modal" data-target="#modalUpdate"><i class="fa fa-edit"></i></button>
                                        <button  ref="delete" @click="deleteschedule(schedule.id)" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Modal Store -->
        <div class="modal fade" id="modalStore" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Jadwal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="storeSchedule">
                            <div class="form-group">
                                <input type="text" v-model="formDataStore.ship"  class="form-control" placeholder="Kapal">
                                <small v-if="errors.ship" class="text-danger font-italic d-block">{{ errors.ship[0] }}</small>
                            </div>
                            <div class="form-control">
                                <select v-model="formDataStore.departure">
                                    <option selected disabled>Keberangkatan</option>
                                    <option>Pamatata</option>
                                    <option>Bira</option>
                                </select>
                                <small v-if="errors.departure" class="text-danger font-italic d-block">{{ errors.departure[0] }}</small>
                            </div>
                            <div class="form-control">
                                <select v-model="formDataStore.destination">
                                    <option selected disabled>Tujuan</option>
                                    <option>Pamatata</option>
                                    <option>Bira</option>
                                </select>
                                <small v-if="errors.destination" class="text-danger font-italic d-block">{{ errors.destination[0] }}</small>
                            </div>
                            <div class="form-group">
                                <input type="datetime-local" v-model="formDataStore.date" class="form-control">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>

        <!-- Modal Upadte -->
        <!-- <div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit admin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="updateAdmin">
                            <div class="form-group">
                                <input type="text" v-model="formDataUpdate.name"  class="form-control" placeholder="name">
                                <small v-if="errors.name" class="text-danger font-italic d-block">{{ errors.name[0] }}</small>
                            </div>
                            <div class="form-group">
                                <input type="email" v-model="formDataUpdate.email"  class="form-control" placeholder="email">
                                <small v-if="errors.email" class="text-danger font-italic d-block">{{ errors.email[0] }}</small>
                            </div>
                            <div class="form-group">
                                <input type="password"  v-model="formDataUpdate.password"  class="form-control" placeholder="password">
                                <small v-if="errors.password" class="text-danger font-italic d-block">{{ errors.password[0] }}</small>
                            </div>
                            <div class="form-group">
                                <input type="password" v-model="formDataUpdate.password_confirmation"  class="form-control" placeholder="passwor_confirmation">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-warning">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
    <!-- /.container-fluid -->
    
</template>

<script>
import swal from 'sweetalert'

export default {
    data() {
        return {
            schedules : {},
            formDataStore: {},
            formDataUpdate: {},
            email: null,
            errors: {},

            auth: {},
        }
    },
    created() {
        this.getSchedule()
    },
    methods: {
        // Read
        async getSchedule(){
            const response = await axios.get('/api/schedule')
            this.schedules = response.data.data
        },

        // Create
        async storeSchedule(){
            try {
                const response = await axios.post('api/schedule', this.formDataStore)
                this.$toasted.success('Jadwal berhasil ditambahkan', {
                    duration : 3000,
                })
                location.reload()
            } catch (error) {
                this.errors = error.response.data.errors    
            }
        },

        //Edit 
        async editAdmin(email){
            this.email = email
            const response = await axios.get(`api/admin/${email}`)
            this.formDataUpdate = response.data.data 
        },

        //Update 
        async updateAdmin(){
            try {
                const response = await axios.patch(`api/admin/${this.email}`, this.formDataUpdate)
                this.$toasted.success('Data admin berhasil diedit', {
                    duration : 3000,
                })
                location.reload()
            } catch (error) {
                if (error.response.data.errors) {
                    this.errors = error.response.data.errors    
                } else {
                    this.$toasted.error('Dia milik orang,!', {
                        duration : 3000,
                    })
                }
            }
        },

        //Destroy 
        async deleteAdmin(email){
            try {
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    axios.delete(`api/admin/${email}`)
                    .then(response => {
                        swal("Poof! Your imaginary file has been deleted!", {
                        icon: "success",
                        });
                        this.$toasted.success('Data admin berhasil diedit', {
                            duration : 3000,
                        })
                        location.reload()
                    })
                    
                } else {
                    swal("Your imaginary file is safe!");
                }
                });
                
            } catch (error) {}
        }
    },
}
</script>

<style>

</style>