<template>
  <div class="flex flex-col items-center justify-center h-full my-auto">
    <div class="max-w-lg w-full space-y-8 bg-white p-8 shadow rounded-lg">
      <form @submit.prevent="submit">
        <div class="mb-4">
          <label class="block text-gray-600 text-sm font-bold mb-1">
            البريد الإلكتروني
          </label>
          <input
            v-model="email"
            type="email"
            name="email"
            class="block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 appearance-none"
            required
          />
        </div>
        <div class="mb-4">
          <label class="block text-gray-600 text-sm font-bold mb-1">
            كلمة المرور
          </label>
          <input
            v-model="password"
            type="password"
            name="password"
            class="block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 appearance-none"
            required
          />
        </div>
        <div>
          <button
            type="submit"
            class="bg-green-600 hover:bg-green-700 hover:border-green-700 rounded text-white border-green-600 font-semibold shadow focus:outline-none py-2 px-3 w-full"
          >
            الدخول
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    submit() {
      alert(1);
    },
  },
};
</script>
