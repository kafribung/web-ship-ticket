<template>
    <!-- Page Wrapper -->
    <div id="wrapper">
        <Sidebar/>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <Navbar/>
                <Dashboard/>
            </div>
            <!-- End of Main Content -->
            <Footer/>
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
</template>

<script>
import Sidebar from '../../components/Sidebar'
import Footer from '../../components/Footer'
import Navbar from '../../components/Navbar'

import Dashboard from '../../components/pages/Dashboard'

export default {
    components:{
        Sidebar,
        Footer,
        Navbar,
        Dashboard,
    }
}
</script>