<template>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Booking ({{ customers.length }} Orang )</h1>
            <small v-if="errors.name" class="text-danger font-italic d-block">{{ errors.name[0] }}</small>
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
                                    <th scope="col">Tgl</th>
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
                                    <td>{{ customer.created_at }}</td>
                                    <td>{{ customer.name }}</td>
                                    <td>{{ customer.identity }}</td>
                                    <td>{{ customer.age }}</td>
                                    <td>{{ customer.city }}</td>
                                    <td>{{ customer.gender }}</td>
                                    <td>{{ customer.service }}</td>
                                    <td v-if="customer.vehicle != null">{{ customer.vehicle.type }}</td>
                                    <td v-else>-</td>
                                    <td>
                                        <ul type="disk">
                                            <li><small>{{ customer.schedule.ship }}</small></li>
                                            <li><small>{{ customer.schedule.departure }} - {{ customer.schedule.destination }} </small> </li>
                                            <li><small>{{ customer.schedule.date }} - {{ customer.schedule.time }}</small> </li>
                                        </ul>
                                    </td>
                                    <td>{{ customer.budget }}</td>
                                    <td>{{ customer.status == 0 ? 'Belum Lunas' : 'Lunas' }}</td>
                                    <td>
                                        <button   v-if="customer.status == 0" @click="statusCustomer(customer.id)" class="btn btn-info btn-circle btn-sm m-1 p-0"><i class="fa fa-credit-card"></i></button>
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
                                <input type="text" v-model="formDataStore.name"  class="form-control" placeholder="Nama Lengkap">
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
                                <select v-model="formDataStore.gender" class="form-control selected">
                                    <option disabled :value="null">Jenis Kelamin</option>
                                    <option>Pria</option>
                                    <option>Wanita</option>
                                </select>
                                <small v-if="errors.gender" class="text-danger font-italic d-block">{{ errors.gender[0] }}</small>
                            </div>
                            <div class="form-group">
                                <select v-model="formDataStore.schedule" class="form-control selected">
                                    <option disabled :value="null">Jadwal</option>
                                    <option v-for="(schedule, index) in schedules" :key="index" :value="schedule.id">
                                        <ul>
                                            <li>{{ schedule.ship }} &diams;</li>
                                            <li>{{ schedule.departure }}-</li>
                                            <li>{{ schedule.destination }} &diams;</li>
                                            <li>{{ schedule.date }}-</li>
                                            <li>{{ schedule.time }}</li>
                                        </ul>    
                                    </option>
                                </select>
                                <small v-if="errors.schedule" class="text-danger font-italic d-block">{{ errors.schedule[0] }}</small>
                            </div>
                            <div class="form-group">
                                <select v-model="formDataStore.service" class="form-control selected">
                                    <option disabled :value="null">Layanan</option>
                                    <option v-for="(service, index) in services" :key="index" :value="service.id">{{ service.type }}</option>
                                </select>
                                <small v-if="errors.service" class="text-danger font-italic d-block">{{ formDataStore.service[0] }}</small>
                            </div>
                            <div class="form-group" v-if="formDataStore.service == '2'">
                                <select v-model="formDataStore.vehicle" class="form-control selected">
                                    <option disabled :value="null">Golongan Kendaraan</option>
                                    <option v-for="(vehicle, index) in vehicles" :key="index" :value="vehicle.id">{{ vehicle.type }}</option>
                                </select>
                                <small v-if="errors.vehicle" class="text-danger font-italic d-block">{{ formDataStore.vehicle[0] }}</small>
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
    </div>
    <!-- /.container-fluid -->
    
</template>

<script>
import swal from 'sweetalert'

export default {
    data() {
        return {
            customers : {},
            schedules: {},
            services : {},
            vehicles : {},
            formDataStore: {
                gender: null,
                schedule: null,
                service: null,
            },
            formDataUpdate: {},
            id: null,
            errors: {},
        }
    },
    mounted() {
        this.deleteBooking();
    },
    created() {
        this.getCustomer(),
        this.getSchedule(),
        this.getService(),
        this.getVehicle()
    },
    methods: {
        // Schedule
        async getSchedule(){
            const response = await axios.get('/api/schedule')
            this.schedules  = response.data.data
        },
        // Service
        async getService(){
            const response = await axios.get('/api/service')
            this.services  = response.data.data
        },
        async getVehicle(){
            const response = await axios.get('/api/vehicle')
            this.vehicles  = response.data.data
        },
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
                    title: "Apakah kamu yakin?",
                    text: "Setelah dihapus, Anda tidak akan dapat memulihkan file ini!",
                    icon: "peringatan",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    axios.delete(`api/customer/${id}`)
                    .then(response => {
                        swal("File anda berhasil dihapus!", {
                        icon: "success",
                        });
                        this.$toasted.success('Booking berhasil dhapus', {
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

        // Status
        async statusCustomer(id){
            // const response =  axios.patch('/api/status/' + id);
            try {
                swal({
                    title: "Apakah kamu yakin?",
                    text: "Ubah status pembayaran!",
                    buttons: true,
                    dangerMode: false,
                })
                .then((willDelete) => {
                if (willDelete) {
                    axios.patch('/api/status/' + id)
                    .then(response => {
                        swal("Status berhasil diubah", {
                        icon: "success",
                        });
                        location.reload()
                    })
                    
                } else {
                    swal("Status gagal diubah!");
                }
                });
                
            } catch (error) {}
        },

        // Delete Booking
        deleteBooking(){
                setInterval(function(){
                axios.get('/delete-booking')
                .then(() => {
                console.log('5 detik')
                })
            }, 5000)
        }
    },
}
</script>

<style>
    .form-control{
        width: 100%;
    }
    .selected{
        padding: 0;
    }
</style>