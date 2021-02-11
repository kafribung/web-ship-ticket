<template>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Booking ({{ bookings.length }} Orang )</h1>
            <small v-if="errors.name" class="text-danger font-italic d-block">{{ errors.name[0] }}</small>
        </div>

        <div v-if="bookings == ''">
            <p class="alert alert-info">Booking Masih Kosong</p>
        </div>

        <!-- Content Row -->
        <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-12 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <input v-model="search" class="form-control mr-sm-2" type="search" placeholder="Cari" aria-label="Cari">
                        <button class="btn btn-primary btn-circle btn-sm float-right" data-toggle="modal" data-target="#modalStore"><i class="fa fa-plus"></i></button>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">Tgl Booking</th>
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
                                <template v-if="filterBookings != ''">
                                    <tr class="text-small" v-for="(booking, index) in filterBookings" :key="index">
                                    <td>{{ booking.created_at }}</td>
                                    <td>{{ booking.name }}</td>
                                    <td>{{ booking.identity }}</td>
                                    <td>{{ booking.age }}</td>
                                    <td>{{ booking.city }}</td>
                                    <td>{{ booking.gender }}</td>
                                    <td>{{ booking.service }}</td>
                                    <td v-if="booking.vehicle != null">{{ booking.vehicle.type }}</td>
                                    <td v-else>-</td>
                                    <td>
                                        <ul type="disk">
                                            <li><small>{{ booking.schedule.ship }}</small></li>
                                            <li><small>{{ booking.schedule.departure }} - {{ booking.schedule.destination }} </small> </li>
                                            <li><small>{{ booking.schedule.date }} - {{ booking.schedule.time }}</small> </li>
                                        </ul>
                                    </td>
                                    <td>{{ booking.budget }}</td>
                                    <td>{{ booking.status == 0 ? 'Belum Lunas' : 'Lunas' }}</td>
                                    <td>
                                        <button   v-if="booking.status == 0" @click="statusBooking(booking.id)" class="btn btn-info btn-circle btn-sm m-1 p-0"><i class="fa fa-credit-card"></i></button>
                                        <button  @click="editBooking(booking.id)" class="btn btn-warning btn-circle btn-sm m-0 p-0" data-toggle="modal" data-target="#modalUpdate"><i class="fa fa-edit"></i></button>
                                        <button  ref="delete" @click="deleteBooking(booking.id)" class="btn btn-danger btn-circle btn-sm m-1 py-0"><i class="fa fa-trash"></i></button>
                                    </td>
                                    
                                </tr>
                                </template>
                                <template v-else>
                                    <tr>
                                        <td colspan="12"><p>Data tidak ditemukan</p></td>
                                    </tr>
                                </template>
                                
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
                        <form @submit.prevent="storeBooking">
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

        <!-- Modal Update -->
        <div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Booking</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="updateBooking">
                            <div class="form-group">
                                <input type="text" v-model="formDataUpdate.name"  class="form-control" placeholder="Nama Lengkap">
                                <small v-if="errors.name" class="text-danger font-italic d-block">{{ errors.name[0] }}</small>
                            </div>
                            <div class="form-group">
                                <input type="number" maxlength="17" v-model="formDataUpdate.identity"  class="form-control" placeholder="Identitas">
                                <small v-if="errors.identity" class="text-danger font-italic d-block">{{ errors.identity[0] }}</small>
                            </div>
                            <div class="form-group">
                                <input type="number" max="120" maxlength="3" v-model="formDataUpdate.age"  class="form-control" placeholder="Umur">
                                <small v-if="errors.age" class="text-danger font-italic d-block">{{ errors.age[0] }}</small>
                            </div>
                            <div class="form-group">
                                <input type="text" maxlength="20" v-model="formDataUpdate.city"  class="form-control" placeholder="Kota">
                                <small v-if="errors.city" class="text-danger font-italic d-block">{{ errors.city[0] }}</small>
                            </div>
                            <div class="form-group">
                                <select v-model="formDataUpdate.gender" class="form-control selected">
                                    <option disabled :value="null">Jenis Kelamin</option>
                                    <option>Pria</option>
                                    <option>Wanita</option>
                                </select>
                                <small v-if="errors.gender" class="text-danger font-italic d-block">{{ errors.gender[0] }}</small>
                            </div>
                            <div class="form-group">
                                <select v-model="formDataUpdate.schedule" class="form-control selected">
                                    <option disabled>Jadwal</option>
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
                                <select v-model="formDataUpdate.service" class="form-control selected">
                                    <option disabled :value="null">Layanan</option>
                                    <option v-for="(service, index) in services" :key="index" :value="service.id">{{ service.type }}</option>
                                </select>
                                <small v-if="errors.service" class="text-danger font-italic d-block">{{ formDataUpdate.service[0] }}</small>
                            </div>
                            <div class="form-group" v-if="formDataUpdate.service == '2'">
                                <select v-model="formDataUpdate.vehicle" class="form-control selected">
                                    <option disabled :value="null">Golongan Kendaraan</option>
                                    <option v-for="(vehicle, index) in vehicles" :key="index" :value="vehicle.id">{{ vehicle.type }}</option>
                                </select>
                                <small v-if="errors.vehicle" class="text-danger font-italic d-block">{{ formDataUpdate.vehicle[0] }}</small>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-warning">Edit</button>
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
            bookings : {},
            schedules: {},
            services : {},
            vehicles : {},
            formDataStore: {
                gender: null,
                schedule: null,
                service: null,
            },
            formDataUpdate: {},
            search: null,
            id: null,
            errors: {},
        }
    },
    mounted() {
        this.deleteBookingOtomatis();
    },
    created() {
        this.getBooking(),
        this.getSchedule(),
        this.getService(),
        this.getVehicle()
    },
    computed: {
        filterBookings() {
            if (this.search) {
                return this.bookings.filter((booking) => {
                    return booking.name
                        .toLowerCase()
                        .split(' ')
                        .includes(this.search.toLowerCase());
                });
            } else return this.bookings;
        },

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
        // Schedule
        async getSchedule(){
            const response = await axios.get('/api/schedule', this.getHeaders)
            this.schedules  = response.data.data
        },
        // Service
        async getService(){
            const response = await axios.get('/api/service', this.getHeaders)
            this.services  = response.data.data
        },
        async getVehicle(){
            const response = await axios.get('/api/vehicle', this.getHeaders)
            this.vehicles  = response.data.data
        },
        // Read
        async getBooking(){
            const response = await axios.get('/api/booking', this.getHeaders)
            this.bookings = response.data.data
        },

        // Create
        async storeBooking(){
            try {
                const response = await axios.post('/api/booking', this.formDataStore, this.getHeaders)
                this.$toasted.success('Booking berhasil ditambahkan', {
                    duration : 3000,
                })
                location.reload()
            } catch (error) {
                this.errors = error.response.data.errors
            }
        },

        // Edit Booking
        async editBooking(id){
            try {
                this.id = id
                const responese = await axios.get(`/api/booking/${id}`, this.getHeaders)
                this.formDataUpdate = responese.data.data
                console.log(this.formDataUpdate.schedule)
            } catch (error) {
                console.log(error)
            }
        },

        // Update Booking
        async updateBooking(){
            try {
                const response = await axios.patch(`/api/booking/${this.id}`, this.formDataUpdate, this.getHeaders)
                this.$toasted.success('Booking berhasil diedit', {
                    duration : 3000,
                })
                location.reload()
            } catch (error) {
                console.log(error)
            }
        },

        //Destroy 
        async deleteBooking(id){
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
                    axios.delete(`api/booking/${id}`, this.getHeaders)
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
        async statusBooking(id){
            try {
                swal({
                    title: "Apakah kamu yakin?",
                    text: "Ubah status pembayaran menjadi Lunas!",
                    buttons: true,
                    dangerMode: false,
                })
                .then((willDelete) => {
                if (willDelete) {
                    axios.patch('/api/status/' + id, {
                        status: 1
                    }, this.getHeaders)
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
        deleteBookingOtomatis(){
                setInterval(function(){
                axios.get('/delete-booking', this.getHeaders)
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