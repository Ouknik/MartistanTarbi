<template>
  <div v-if="show" :style="{ zIndex: baseZIndex + level }">
    <div class="modal-backdrop" @click="backdropClick"> </div>
    <div class="modal" :class="{ 'show': show }" tabindex="-1">
      <div class="modal-dialog" :class="maxWidthClass">
        <div class="modal-content">
          <div class="modal-header color-template">
            <h5 class="modal-title">
              <slot name="title" />
            </h5>
            <button v-if="closeable" type="button" class="close" @click="close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <slot name="header" />
          <div class="modal-body">
            <slot />
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary " v-if="closeable"   @click="close">
              Quitter
            </button>

            <slot name="footer"></slot>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>
  
<script setup>
import { computed, onMounted, onUnmounted, watch } from 'vue';
const baseZIndex = 1050;
const props = defineProps({
  show: {
    type: Boolean,
    default: false,
  },
  maxWidth: {
    type: String,
    default: 'modal-xl', // Set to 'modal-xl' or any other Bootstrap 4 size as needed
  },
  closeable: {
    type: Boolean,
    default: true,
  },
  level: {
    type: Number,
    default: 10,
  },
});

const backdropClick = (event) => {
  event.stopPropagation();
  if (props.closeable) {
    emit('close');
  }
};
const emit = defineEmits(['close']);

watch(() => props.show, () => {
  if (props.show) {
    document.body.style.overflow = 'hidden';
  } else {
    document.body.style.overflow = null;
  }
});

const close = () => {
  if (props.closeable) {
    emit('close');
  }
};

const closeOnEscape = (e) => {
  if (e.key === 'Escape' && props.show) {
    e.stopPropagation();
    close();
  }
};

onMounted(() => document.addEventListener('keydown', closeOnEscape));

onUnmounted(() => {
  document.removeEventListener('keydown', closeOnEscape);
  document.body.style.overflow = null;
});

const maxWidthClass = computed(() => {
  return {
    'modal-sm': 'modal-sm',
    'modal-md': 'modal-md',
    'modal-lg': 'modal-lg',
    'modal-xl': 'modal-xl',
  }[props.maxWidth];
});
</script>