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
                        <button class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i></button>
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
                                        <button class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
                                        <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
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
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah admin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="setAdmin">
                            <div class="form-group">
                                <input type="text" v-model="formData.name" id="username" class="form-control" placeholder="name">
                                <small class="text-danger font-italic">Error</small>
                            </div>
                            <div class="form-group">
                                <input type="email" v-model="formData.email" id="email" class="form-control" placeholder="email">
                            </div>
                            <div class="form-group">
                                <input type="password"  v-model="formData.password" id="password" class="form-control" placeholder="password">
                            </div>
                            <div class="form-group">
                                <input type="password" v-model="formData.password_confirmation" id="passwor_confirmation" class="form-control" placeholder="passwor_confirmation">
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
export default {
    data() {
        return {
            admins : {},
            formData: {},
        }
    },
    created() {
        this.getAdmin()
    },
    methods: {
        async getAdmin(){
            const response = await axios.get('/api/admin')
            this.admins = response.data.data
        },

        async setAdmin(){
            const response = await axios.post('api/admin', this.formData)
            this.$toasted.success('Data admin berhasil ditambahkan', {
                duration : 3000,
            })
            location.reload()
        }

    },
}
</script>

<style>

</style>