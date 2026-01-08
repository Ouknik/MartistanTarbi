<template>
    <div>
      <ul class="iq-edit-profile p-0 nav">
        <li v-for="tab in tabs" :key="tab.name" class="col-md-4">
          <a
            class="nav-link p-0 linkcss"
            :class="{ active: tab.isActive }"
            @click="selectTab(tab.name)"
          >
            {{ tab.title }}
          </a>
        </li>
      </ul>
      <div>
        <slot></slot>
      </div>
    </div>
  </template>

<script>
export default {
    props: {
        modelValue: {
            type: String,
            required: true,
        },
    },
    data() {
        return {
            tabs: [],
        };
    },
    computed: {
        activeTab: {
            get() {
                return this.modelValue;
            },
            set(value) {
                this.$emit("update:modelValue", value);
            },
        },
    },
    methods: {
        selectTab(name) {
            this.activeTab = name;
        },
    },
    mounted() {
        this.tabs = this.$children;
    },
};
</script>
