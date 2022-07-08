<template>
  <div class="flex flex-col h-screen bg-gray-50">
    <header class="bg-gray-200 p-6">
      <div class="container mx-auto">
        <div class="flex justify-between items-center">
          <div>COVID-19 Admin Dashboard</div>
          <div>الذهاب للرئيسية</div>
        </div>
      </div>
    </header>
    <main class="flex-1 mx-auto w-full">
      <div class="flex justify-between container mx-auto pt-8">
        <aside class="lg:w-1/6 w-auto h-full bg-red-200">sidebar</aside>
        <div class="bg-green-200 w-full mr-8">main</div>
      </div>
    </main>
    <footer class="border-t p-4 bg-gray-200 text-center">2022 &copy;</footer>
  </div>
</template>

<script>
export default {
  middleware: "auth",
};
</script>
