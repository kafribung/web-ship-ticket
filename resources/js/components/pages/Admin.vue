<template>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Admin</h1>
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
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(admin, index) in admins" :key="index">
                                    <th scope="row">{{ index+1 }}</th>
                                    <td>{{ admin.name }}</td>
                                    <td>{{ admin.email }}</td>
                                    <td>{{ admin.role }}</td>
                                    <td>
                                        <button v-if="auth.email == admin.email" @click="editAdmin(admin.email)" class="btn btn-warning btn-circle btn-sm m-0 p-0" data-toggle="modal" data-target="#modalUpdate"><i class="fa fa-edit"></i></button>
                                        <button  v-if="auth.email == admin.email" ref="delete" @click="deleteAdmin(admin.email)" class="btn btn-danger btn-circle btn-sm m-0 p-0"><i class="fa fa-trash"></i></button>
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
                        <h5 class="modal-title" id="exampleModalLabel">Tambah admin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="storeAdmin">
                            <div class="form-group">
                                <input type="text" v-model="formDataStore.name" id="username" class="form-control" placeholder="name">
                                <small v-if="errors.name" class="text-danger font-italic d-block">{{ errors.name[0] }}</small>
                            </div>
                            <div class="form-group">
                                <input type="email" v-model="formDataStore.email" id="email" class="form-control" placeholder="email">
                                <small v-if="errors.email" class="text-danger font-italic d-block">{{ errors.email[0] }}</small>
                            </div>
                            <div class="form-group">
                                <input type="password"  v-model="formDataStore.password" id="password" class="form-control" placeholder="password">
                                <small v-if="errors.password" class="text-danger font-italic d-block">{{ errors.password[0] }}</small>
                            </div>
                            <div class="form-group">
                                <input type="password" v-model="formDataStore.password_confirmation" id="passwor_confirmation" class="form-control" placeholder="passwor_confirmation">
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
        </div>
    </div>
    <!-- /.container-fluid -->
    
</template>

<script>
import swal from 'sweetalert'

export default {
    data() {
        return {
            admins : {},
            formDataStore: {},
            formDataUpdate: {},
            email: null,
            errors: {},

            auth: {},
        }
    },
    created() {
        this.getAdmin()
        this.getAuth()
    },
    methods: {
        // Get Auth
        async getAuth(){
            const response = await axios.get('api/dashboard')
            this.auth = response.data.data
        },
        // Read
        async getAdmin(){
            const response = await axios.get('/api/admin')
            this.admins = response.data.data
        },

        // Create
        async storeAdmin(){
            try {
                const response = await axios.post('api/admin', this.formDataStore)
                this.$toasted.success('Data admin berhasil ditambahkan', {
                    duration : 3000,
                })
                location.reload()
            } catch (error) {
                if (error.response.data.errors) {
                    this.errors = error.response.data.errors    
                } else {
                    this.$toasted.error('Data maximal 4', {
                        duration : 3000,
                    })
                }
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
                    title: "Apakah kamu yakin?",
                    text: "Setelah dihapus, Anda tidak akan dapat memulihkan file ini!",
                    icon: "peringatan",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    axios.delete(`api/admin/${email}`)
                    .then(response => {
                        swal("File anda berhasil dihapus!", {
                        icon: "success",
                        });
                        this.$toasted.success('Admin berhasil dihapus', {
                            duration : 3000,
                        })
                        location.reload()
                    })
                    
                } else {
                    swal("File Anda aman!");
                }
                });
                
            } catch (error) {}
        }
    },
}
</script>

<style>

</style>