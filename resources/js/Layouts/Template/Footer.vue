<template>
    <footer class="bg-white iq-footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <!-- <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
                        <li class="list-inline-item"><a href="#">Terms of Use</a></li>
                    </ul> -->
                </div>
                <div class="col-lg-6 text-right">
                    Copyright (c) {{ year }}<a href="www.accesspoint.ma">  Access Point</a> Tous droits réservés
                </div>
            </div>
        </div>
    </footer>
</template>

<script setup>

defineProps({
    year:Number
})
</script>

<style>

</style>
