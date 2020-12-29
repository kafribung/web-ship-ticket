<template>
    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; Nomads Dev {{ year }}</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->
</template>

<script>
export default {
    data() {
        return {
            year: ''
        }
    },
    mounted() {
        this.year = new Date().getFullYear()
    },
}
</script>

<style>

</style>