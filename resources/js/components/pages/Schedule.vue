<template>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Jadwal Ferry</h1>
        </div>

        <div v-if="schedules == ''">
            <p class="alert alert-info">Data Jadwal Beluam Ada</p>
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
                                    <th scope="col">Jam</th>
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
                                    <td>{{ schedule.time }}</td>
                                    <td>
                                        <button  @click="editSchedule(schedule.id)" class="btn btn-warning btn-circle btn-sm m-0 p-0" data-toggle="modal" data-target="#modalUpdate"><i class="fa fa-edit"></i></button>
                                        <button  ref="delete" @click="deleteSchedule(schedule.id)" class="btn btn-danger btn-circle btn-sm m-0 p-0"><i class="fa fa-trash"></i></button>
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
                            <div class="form-group">
                                <select v-model="formDataStore.departure" class="form-control selected">
                                    <option :value="null" disabled>Keberangkatan</option>
                                    <option>Pamatata</option>
                                    <option>Bira</option>
                                </select>
                                <small v-if="errors.departure" class="text-danger font-italic d-block">{{ errors.departure[0] }}</small>
                            </div>
                            <div class="form-group">
                                <select v-model="formDataStore.destination" class="form-control selected">
                                    <option :value="null" disabled>Tujuan</option>
                                    <option v-if="formDataStore.departure == 'Bira'">Pamatata</option>
                                    <option v-if="formDataStore.departure == 'Pamatata'">Bira</option>
                                </select>
                                <small v-if="errors.destination" class="text-danger font-italic d-block">{{ errors.destination[0] }}</small>
                            </div>
                            <div class="form-group">
                                <input type="date" v-model="formDataStore.date" class="form-control">
                                <small v-if="errors.date" class="text-danger font-italic d-block">{{ formDataStore.date[0] }}</small>
                            </div>
                            <div class="form-group">
                                <input type="time" v-model="formDataStore.time" class="form-control">
                                <small v-if="errors.time" class="text-danger font-italic d-block">{{ formDataStore.time[0] }}</small>
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
        <div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Jadwal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="updateSchedule">
                            <div class="form-group">
                                <input type="text" v-model="formDataUpdate.ship"  class="form-control" placeholder="Kapal">
                                <small v-if="errors.ship" class="text-danger font-italic d-block">{{ errors.ship[0] }}</small>
                            </div>
                            <div class="form-group">
                                <select v-model="formDataUpdate.departure" class="form-control selected">
                                    <option selected disabled>Keberangkatan</option>
                                    <option>Pamatata</option>
                                    <option>Bira</option>
                                </select>
                                <small v-if="errors.departure" class="text-danger font-italic d-block">{{ errors.departure[0] }}</small>
                            </div>
                            <div class="form-group">
                                <select v-model="formDataUpdate.destination" class="form-control selected">
                                    <option selected disabled>Tujuan</option>
                                    <option v-if="formDataUpdate.departure == 'Bira'">Pamatata</option>
                                    <option v-if="formDataUpdate.departure == 'Pamatata'">Bira</option>
                                </select>
                                <small v-if="errors.destination" class="text-danger font-italic d-block">{{ errors.destination[0] }}</small>
                            </div>
                            <div class="form-group">
                                <input type="date" v-model="formDataUpdate.date" class="form-control">
                                <small v-if="errors.date" class="text-danger font-italic d-block">{{ errors.date[0] }}</small>
                            </div>
                            <div class="form-group">
                                <input type="time" v-model="formDataUpdate.time" class="form-control">
                                <small v-if="errors.time" class="text-danger font-italic d-block">{{ errors.time[0] }}</small>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-warning">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
    
</template>

<script>
import swal from 'sweetalert'

export default {
    data() {
        return {
            schedules : {},
            formDataStore: {
                departure: null,
                destination: null,
            },
            formDataUpdate: {},
            id: null,
            errors: {},
        }
    },
    created() {
        this.getSchedule()
    },
    computed: {
        getHeaders(){
            const token = localStorage.getItem('token')
            return {
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            }
        },
    },
    methods: {
        // Read
        async getSchedule(){
            const response = await axios.get('/api/schedule', this.getHeaders)
            this.schedules = response.data.data
        },

        // Create
        async storeSchedule(){
            try {
                const response = await axios.post('api/schedule', this.formDataStore, this.getHeaders)
                this.$toasted.success('Jadwal berhasil ditambahkan', {
                    duration : 3000,
                })
                location.reload()
            } catch (error) {
                this.errors = error.response.data.errors    
            }
        },

        //Edit 
        async editSchedule(id){
            this.id = id
            const response = await axios.get(`api/schedule/${id}`, this.getHeaders)
            this.formDataUpdate = response.data.data 
        },

        //Update 
        async updateSchedule(){
            try {
                const response = await axios.patch(`api/schedule/${this.id}`, this.formDataUpdate, this.getHeaders)
                this.$toasted.success('Jadwal berhasil diedit', {
                    duration : 3000,
                })
                location.reload()
            } catch (error) {
                this.errors = error.response.data.errors
            }    
        },

        //Destroy 
        async deleteSchedule(id){
            try {
                swal({
                    title: "Apakah kamu yakin?",
                    text: "Setelah dihapus, Anda tidak akan dapat memulihkan file ini!",
                    icon: "peringatan",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    axios.delete(`api/schedule/${id}`, this.getHeaders)
                    .then(response => {
                        swal("File anda berhasil dihapus!", {
                        icon: "success",
                        });
                        this.$toasted.success('Admin berhasil dhapus', {
                            duration : 3000,
                        })
                        location.reload()
                    })
                    
                } else {
                    swal("File anda aman!");
                }
                });
                
            } catch (error) {}
        },
    },
}
</script>