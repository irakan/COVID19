<template>
  <div class="flex flex-col items-center justify-center h-full my-auto">
    <div class="max-w-lg w-full space-y-8 bg-white p-8 shadow rounded-lg">
      <ValidationErrors :errors="errors" />
      <form @submit.prevent="submit">
        <div class="mb-4">
          <label class="block text-gray-600 text-sm font-bold mb-1">
            البريد الإلكتروني
          </label>
          <input
            v-model="form.email"
            type="email"
            name="email"
            class="bg-gray-50 border-2 border-gray-300 w-full rounded-lg focus:border-green-500 focus:bg-transparent py-2 px-3 outline-none appearance-none text-gray-600"
            required
          />
        </div>
        <div class="mb-4">
          <label class="block text-gray-600 text-sm font-bold mb-1">
            كلمة المرور
          </label>
          <input
            v-model="form.password"
            type="password"
            name="password"
            class="bg-gray-50 border-2 border-gray-300 w-full rounded-lg focus:border-green-500 focus:bg-transparent py-2 px-3 outline-none appearance-none text-gray-600"
            required
          />
        </div>
        <div>
          <button
            type="submit"
            class="inline-flex justify-center items-center bg-green-600 hover:bg-green-700 hover:border-green-700 rounded text-white border-green-600 font-semibold shadow focus:outline-none py-3 px-5 w-full"
          >
            <span v-if="!processing">الدخول</span>
            <svg
              v-else
              class="animate-spin -ml-1 mr-3 h-6 w-5 text-white"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
            >
              <circle
                class="opacity-25"
                cx="12"
                cy="12"
                r="10"
                stroke="currentColor"
                stroke-width="4"
              />
              <path
                class="opacity-75"
                fill="currentColor"
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
              />
            </svg>
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import ValidationErrors from "@/components/ValidationErrors";

export default {
  name: "LoginPage",
  components: {
    ValidationErrors,
  },
  middleware: "guest",
  data() {
    return {
      form: {
        email: "",
        password: "",
      },
      processing: false,
      errors: [],
    };
  },
  methods: {
    async submit() {
      this.errors = [];
      this.processing = true;
      try {
        await this.$auth.loginWith("laravelSanctum", { data: this.form });
      } catch (errors) {
        Object.keys(errors.response.data.errors).forEach((key) => {
          Object.values(errors.response.data.errors[key]).forEach((error) => {
            this.errors.push(error);
          });
        });
      } finally {
        this.processing = false;
      }
    },
  },
};
</script>
