<template>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>

        <!-- Content Row -->
        <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Admin
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ auth.count }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Earnings (Annual)
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    $215,000
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">
            <!-- Content Column -->
            <div class="col-lg-12 mb-4">
                <!-- Color System -->
                <div class="row">
                    <div class="col-lg-12 mb-4">
                        <div class="card bg-success text-white shadow">
                            <div class="card-body text-center">
                                <h3>Hi {{ auth.name }} Selamat datang di aplikasi tiket Ferry</h3>
                                <h5>Berikan yang terbaik demi kenyamanan penumpang</h5>  
                            </div>
                        </div>
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
            auth: {},
        }
    },
    created() {
        this.handleDashboard()
    },
    methods: {
        async handleDashboard(){
            const response = await axios.get('/api/dashboard');
            this.auth = response.data.data
        }
    },
}
</script>

<style>

</style>