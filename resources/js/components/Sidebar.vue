<template>
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <router-link to="/dashboard" class="sidebar-brand d-flex align-items-center justify-content-center">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-ship"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Tiket Ferry</div>
        </router-link>

        <!-- Divider -->
        <hr class="sidebar-divider my-0" />

        <!-- Nav Item - Dashboard -->
        <router-link :to="'/dashboard'" class="nav-item">
            <div class="nav-link">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </div>
        </router-link>

        <!-- Divider -->
        <hr class="sidebar-divider" />

        <!-- Nav Item - Charts -->
        <router-link :to="'/admin'" class="nav-item">
            <div class="nav-link">
                <i class="fas fa-fw fa-user"></i>
                <span>Admin</span>
            </div>
        </router-link>
        
        <!-- Divider -->
        <hr class="sidebar-divider" />

        <!-- Heading -->
        <div class="sidebar-heading">Layanan</div>

        <!-- Nav Item - Pages Collapse Menu -->
        <router-link :to="'/schedule'" class="nav-item">
            <div class="nav-link">
                <i class="fas fa-fw fa-calendar"></i>
                <span>Jadwal</span>
            </div>
        </router-link>

        <!-- Nav Item - Pages Collapse Menu -->
        <router-link :to="'/booking'" class="nav-item">
            <div class="nav-link">
                <i class="fas fa-fw fa-book"></i>
                <span>Booking</span>
            </div>
        </router-link>

        <!-- Nav Item - Pages Collapse Menu -->
        <router-link :to="'/customer'" class="nav-item">
            <div class="nav-link">
                <i class="fas fa-fw fa-users"></i>
                <span>Customer</span>
            </div>
        </router-link>

        <!-- Divider -->
        <hr class="sidebar-divider" />

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Klik logout untuk keluar dari sistem.
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">
                            Cancel
                        </button>
                        <button  @click.prevent="handleLogout" class="btn btn-primary">Logout</button>
                    </div>
                </div>
            </div>
        </div>
    </ul>
    <!-- End of Sidebar -->

</template>

<script>
export default {
    methods: {
        handleLogout(){
            const header = {
                headers: {
                    'Authorization': `Basic ${localStorage.getItem('token')}`
                },
            }
            axios.post('http://127.0.0.1:8000/api/logout', header)
            .then(response => {
                this.$router.push('/login')
            }).catch(error => {
                console.log(error)
            })
        }
    },
}
</script>