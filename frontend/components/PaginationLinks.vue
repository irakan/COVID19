<template>
  <div class="inline-flex items-center">
    <a
      class="flex px-4 py-3 mb-1 mr-1 text-sm border rounded hover:bg-gray-300 shadow"
      href="#"
      :class="{
        ' cursor-not-allowed bg-gray-300': isFirstPage,
      }"
      @click.prevent="sendPageChange(previousPage)"
    >
      <span class="mx-px">&laquo;</span>
      <span class="mx-px">السابق</span>
    </a>
    <a
      v-for="(link, index) in meta.links"
      :key="index"
      class="inline-flex px-4 py-3 mb-1 mr-1 text-sm border rounded hover:bg-gray-300 shadow"
      href="#"
      :class="{
        'bg-gray-300': link.active,
        'cursor-not-allowed': link.label === '...',
        hidden: isNaN(link.label) && link.label !== '...',
      }"
      @click.prevent="sendPageChange(link.label)"
      v-html="link.label"
    >
    </a>
    <a
      class="flex px-4 py-3 mb-1 mr-1 text-sm border rounded hover:bg-gray-300 shadow"
      href="#"
      :class="{
        ' cursor-not-allowed bg-gray-300': isLastPage,
      }"
      @click.prevent="sendPageChange(nextPage)"
    >
      <span class="mx-px">التالي</span>
      <span class="mx-px">&raquo;</span>
    </a>
  </div>
</template>

<script>
export default {
  props: {
    meta: {
      type: Object,
      default: () => {},
    },
    filters: {
      type: Object,
      default: () => {},
    },
  },
  emits: ["page-change"],
  computed: {
    previousPage() {
      return this.meta.current_page - 1;
    },
    nextPage() {
      return this.meta.current_page + 1;
    },
    isLastPage() {
      return this.meta.current_page === this.meta.last_page;
    },
    isFirstPage() {
      return this.previousPage === 0;
    },
  },
  methods: {
    sendPageChange(page) {
      if (page === 0 || page > this.meta.last_page) return;
      this.$emit("page-change", page);
    },
  },
};
</script>
