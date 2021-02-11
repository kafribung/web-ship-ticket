<template>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Customer ({{ customers.length }} Orang )</h1>
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
                        <input v-model="search" class="form-control mr-sm-2" type="search" placeholder="Cari" aria-label="Cari">
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
                                <template v-if="filterCustomer != ''">
                                    <tr class="text-small" v-for="(customer, index) in filterCustomer.data" :key="index">
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
                                        <button  v-if="customer.status == 1" @click="statusCustomer(customer.id)" class="btn btn-info btn-circle btn-sm m-1 p-0"><i class="fa fa-credit-card"></i></button>
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
                        <div class="float-right">
                            <pagination :data="customers" @pagination-change-page="getCustomer"></pagination>
                        </div>
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
            search: null,
            errors: {},
        }
    },
    created() {
        this.getCustomer()
    },
    computed: {
        filterCustomer() {
            if (this.search) {
                return this.customers.filter((customer) => {
                    return customer.name
                        .toLowerCase()
                        .includes(this.search.toLowerCase());
                });
            } else return this.customers;
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
        // Read
        async getCustomer(page = 1){
            const response = await axios.get('/api/customer?page=' + page, this.getHeaders)
            this.customers = response.data
        },

        // Status
        async statusCustomer(id){
            try {
                swal({
                    title: "Apakah kamu yakin?",
                    text: "Ubah status pembayaran menjadi Belum Lunas!",
                    buttons: true,
                    dangerMode: false,
                })
                .then((willDelete) => {
                if (willDelete) {
                    axios.patch('/api/status/' + id, {
                        status: 0
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
    },
}
</script>