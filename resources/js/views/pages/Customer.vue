<template>
    <!-- Page Wrapper -->
    <div id="wrapper">
        <Sidebar/>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <Navbar/>
                <Customer/>
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

import Customer from '../../components/pages/Customer'

export default {
    components:{
        Sidebar,
        Footer,
        Navbar,
        Customer,
    }
}
</script>

<style>

</style>