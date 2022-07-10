<template>
  <div class="flex flex-col h-screen bg-gray-50">
    <header class="bg-white p-6">
      <div class="container mx-auto">
        <NuxtLink to="/">COVID-19</NuxtLink>
      </div>
    </header>
    <main class="flex-1 mx-auto w-full">
      <Nuxt />
    </main>
    <footer class="border-t p-4 bg-gray-200 text-center">2022 &copy;</footer>
  </div>
</template>

<script>
export default {
  name: "DefaultLayout",
};
</script>

<style>
html {
  font-family: "Noto Sans Arabic", sans-serif;
}
</style>
