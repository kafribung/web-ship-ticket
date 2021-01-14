<template>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Booking</h1>
        </div>

        <div v-if="customers == ''">
            <p class="alert alert-info">Booking Masih Kosong</p>
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
                                    <th scope="col">Nama</th>
                                    <th scope="col">Identitas</th>
                                    <th scope="col">Umur</th>
                                    <th scope="col">Kota</th>
                                    <th scope="col">JK</th>
                                    <th scope="col">Layanan</th>
                                    <th scope="col">Kendaraan</th>
                                    <th scope="col">Jadwal</th>
                                    <th scope="col">Biaya</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="text-small" v-for="(customer, index) in customers" :key="index">
                                    <th scope="row">{{ index+1 }}</th>
                                    <td>{{ customer.name }}</td>
                                    <td>{{ customer.identity }}</td>
                                    <td>{{ customer.age }}</td>
                                    <td>{{ customer.city }}</td>
                                    <td>{{ customer.gender }}</td>
                                    <td>{{ customer.service }}</td>
                                    <td>{{ customer.vehicle.type }}</td>
                                    <td>
                                        <ul>
                                            <li><small>{{ customer.schedule.ship }}</small></li>
                                            <li><small>{{ customer.schedule.departure }} - {{ customer.schedule.destination }}</small> </li>
                                            <li><small>{{ customer.schedule.date }} - {{ customer.schedule.time }}</small> </li>
                                        </ul>
                                    </td>
                                    <td>{{ customer.budget }}</td>
                                    <td>{{ customer.status == 0 ? 'Belum Lunas' : 'Lunas' }}</td>
                                    <td>
                                        <button   class="btn btn-info btn-circle btn-sm m-1 p-0"><i class="fa fa-credit-card"></i></button>
                                        <button  @click="editCustomer(customer.id)" class="btn btn-warning btn-circle btn-sm m-1 p-0" data-toggle="modal" data-target="#modalUpdate"><i class="fa fa-edit"></i></button>
                                        <button  ref="delete" @click="deleteCustomer(customer.id)" class="btn btn-danger btn-circle btn-sm m-1 py-0"><i class="fa fa-trash"></i></button>
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
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Booking</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="storeCustomer">
                            <div class="form-group">
                                <input type="text" maxlength="30" v-model="formDataStore.name"  class="form-control" placeholder="Nama Lengkap">
                                <small v-if="errors.name" class="text-danger font-italic d-block">{{ errors.name[0] }}</small>
                            </div>
                            <div class="form-group">
                                <input type="number" maxlength="17" v-model="formDataStore.identity"  class="form-control" placeholder="Identitas">
                                <small v-if="errors.identity" class="text-danger font-italic d-block">{{ errors.identity[0] }}</small>
                            </div>
                            <div class="form-group">
                                <input type="number" max="120" maxlength="3" v-model="formDataStore.age"  class="form-control" placeholder="Umur">
                                <small v-if="errors.age" class="text-danger font-italic d-block">{{ errors.age[0] }}</small>
                            </div>
                            <div class="form-group">
                                <input type="text" maxlength="20" v-model="formDataStore.city"  class="form-control" placeholder="Kota">
                                <small v-if="errors.city" class="text-danger font-italic d-block">{{ errors.city[0] }}</small>
                            </div>
                            <div class="form-group">
                                <v-select v-model="formDataStore.gender" :options="['Pria', 'Wanita']"></v-select>
                                <small v-if="errors.departure" class="text-danger font-italic d-block">{{ errors.departure[0] }}</small>
                            </div>
                            <div class="form-group">
                                <v-select  :options="services" ></v-select>
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
                        <form @submit.prevent="updateCustomer">
                            <div class="form-group">
                                <input type="text" v-model="formDataUpdate.ship"  class="form-control" placeholder="Kapal">
                                <small v-if="errors.ship" class="text-danger font-italic d-block">{{ errors.ship[0] }}</small>
                            </div>
                            <div class="form-control">
                                <select v-model="formDataUpdate.departure">
                                    <option selected disabled>Keberangkatan</option>
                                    <option>Pamatata</option>
                                    <option>Bira</option>
                                </select>
                                <small v-if="errors.departure" class="text-danger font-italic d-block">{{ errors.departure[0] }}</small>
                            </div>
                            <div class="form-control">
                                <select v-model="formDataUpdate.destination">
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
import 'vue-select/dist/vue-select.css';

export default {
    data() {
        return {
            customers : {},
            services : [],
            formDataStore: {},
            formDataUpdate: {},
            id: null,
            errors: {},
        }
    },
    mounted() {
    },
    created() {
        this.getCustomer(),
        this.getService()
    },
    methods: {
        // Service
        async getService(){
            const response = await axios.get('/api/service')
            // this.services = Object.values(response.data.data) 
            for (let value of Object.values(response.data.data)) {
                this.services.push(value.type) 
            } 
        },
        async getVehicle(){
            
        }
        // Read
        async getCustomer(){
            const response = await axios.get('/api/customer')
            this.customers = response.data.data
        },

        // Create
        async storeCustomer(){
            try {
                const response = await axios.post('api/customer', this.formDataStore)
                this.$toasted.success('Booking berhasil ditambahkan', {
                    duration : 3000,
                })
                location.reload()
            } catch (error) {
                this.errors = error.response.data.errors    
            }
        },

        //Edit 
        async editCustomer(id){
            this.id = id
            const response = await axios.get(`api/customer/${id}`)
            this.formDataUpdate = response.data.data 
        },

        //Update 
        async updateCustomer(){
            try {
                const response = await axios.patch(`api/customer/${this.id}`, this.formDataUpdate)
                this.$toasted.success('Booking berhasil diedit', {
                    duration : 3000,
                })
                location.reload()
            } catch (error) {
                this.errors = error.response.data.errors
            }    
        },

        //Destroy 
        async deleteCustomer(id){
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
                    axios.delete(`api/customer/${id}`)
                    .then(response => {
                        swal("Poof! Your imaginary file has been deleted!", {
                        icon: "success",
                        });
                        this.$toasted.success('Booking berhasil dhapus', {
                            duration : 3000,
                        })
                        location.reload()
                    })
                    
                } else {
                    swal("Your imaginary file is safe!");
                }
                });
                
            } catch (error) {}
        },

    },
}
</script>

<style>

</style>