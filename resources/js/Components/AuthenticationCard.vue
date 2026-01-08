<template>
    <!-- Sign in Start -->

    <div class="sign-in-page mh-100">
        <div class="container sign-in-page-bg mt-5 p-0">
            <div class="row no-gutters">
                <div class="col-lg-6 col-auto text-center">
                        <div>
                            <slot name="logo" />
                        </div>
                        <div>
                            <div class="item">
                                <img
                                    src="/images/login/3.png"
                                    class="img-fluid mb-4"
                                    alt="logo"
                                />

                            </div>
                        </div>

                </div>
                <div class="col-lg-6 position-relative">
                    <slot></slot>
                </div>
            </div>
        </div>
    </div>

    <!-- Sign in END -->

    <!-- <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            <slot name="logo" />
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <slot />
        </div>
    </div> -->
</template>
<script setup></script>
