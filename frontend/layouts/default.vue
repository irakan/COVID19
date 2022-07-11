<template>
  <div class="flex flex-col h-screen bg-gray-100">
    <header class="bg-white p-6">
      <div class="container mx-auto flex justify-between items-center">
        <NuxtLink to="/">COVID-19</NuxtLink>
        <NuxtLink
          v-if="!$auth.loggedIn"
          to="/login"
          class="inline-flex justify-center items-center bg-green-600 hover:bg-green-700 hover:border-green-700 rounded text-white border-green-600 font-semibold shadow focus:outline-none py-3 px-5"
          >تسجيل الدخول</NuxtLink
        ><a
          v-else
          href="#"
          class="inline-flex justify-center items-center bg-gray-600 hover:bg-gray-700 hover:border-gray-700 rounded text-white border-green-600 font-semibold shadow focus:outline-none py-3 px-5"
          @click.prevent="$auth.logout()"
          >تسجيل الخروج</a
        >
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
html,
body {
  height: 100%;
  width: 100%;
  font-family: "Noto Sans Arabic", sans-serif;
}
</style>
