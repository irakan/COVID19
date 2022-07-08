<template>
  <div class="flex justify-between container mx-auto pt-8">
    <aside class="lg:w-1/6 w-auto h-full">sidebar</aside>
    <div class="bg-green-200 w-full mr-8">main</div>
  </div>
</template>

<script>
export default {
  middleware: "auth",
};
</script>
