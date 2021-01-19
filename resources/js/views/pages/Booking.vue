<template>
    <!-- Page Wrapper -->
    <div id="wrapper">
        <Sidebar/>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <Navbar/>
                <Booking/>
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

import Booking from '../../components/pages/Booking'

export default {
    components:{
        Sidebar,
        Footer,
        Navbar,
        Booking,
    }
}
</script>

<style>

</style>