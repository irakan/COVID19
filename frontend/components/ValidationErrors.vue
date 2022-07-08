<template>
  <div v-if="errors.length > 0">
    <div class="font-medium text-red-600">عذراً ، حدثت مشكلة!</div>

    <ul class="mt-3 list-disc list-inside text-sm text-red-600">
      <li v-for="(error, key) in errors" :key="key">{{ error }}</li>
    </ul>
  </div>
</template>

<script>
export default {
  props: {
    errors: {
      type: Array,
      default: [],
    },
  },
};
</script>
