<script setup>
defineProps({
  on: Boolean,
});
</script>
<style scoped>
.fade-transition {
  transition: opacity 1s ease-in;
}

.fade-transition-enter,
.fade-transition-leave-to {
  opacity: 0;
}
</style>
<template>
    <!-- tailwind -->
    <!-- <div>
        <transition leave-active-class="transition ease-in duration-1000" leave-from-class="opacity-100" leave-to-class="opacity-0">
            <div v-show="on" class="text-sm text-gray-600">
                <slot />
            </div>
        </transition>
    </div> -->
    <!-- bt5 -->
  <div class="fade-transition">
    <div v-show="on" class="alert alert-success" role="alert">
      <slot></slot>
    </div>
  </div>
</template>
