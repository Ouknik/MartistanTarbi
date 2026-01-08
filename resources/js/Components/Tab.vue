<template>
    <div v-show="isActive" class="tab-pane fade" :class="{ 'active show': isActive }">
        <slot></slot>
    </div>
</template>

<script>
export default {
  props: {
    name: {
      type: String,
      required: true,
    },
    title: {
      type: String,
      required: true,
    },
  },
  computed: {
    isActive() {
      return this.$parent.activeTab === this.name;
    },
  },
};
</script>
