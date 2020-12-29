<template>
    <!-- Page Wrapper -->
    <div id="wrapper">
        <Sidebar/>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <Navbar v-bind:user="user"/>
                <Dashboard v-bind:user="user" :countAdmin="countAdmin"/>
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
    data() {
        return {
            user: '',
            countAdmin: ''
        }
    },
    created() {
        this.handleDashboard()
    },
    methods: {
        async handleDashboard(){
            try {
                const response = await axios.get('/api/dashboard');
                this.user = response.data.data.user
                this.countAdmin = response.data.data.countAdmin
                console.log(response.data.data)
            } catch (error) {
                console.log(error)         
            }
        }
    },
    components:{
        Sidebar,
        Footer,
        Navbar,
        Dashboard,
    }
}
</script>

<style>

</style>