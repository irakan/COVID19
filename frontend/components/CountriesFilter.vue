<template>
  <div class="overflow-y-auto mb-4 h-full">
    <div class="lg:h-0 h-64">
      <div class="p-4">
        <div class="mb-4">
          <input
            v-model="filterFields.name"
            class="bg-gray-50 border-2 border-gray-300 w-full rounded-lg focus:border-green-500 focus:bg-transparent py-2 px-3 outline-none appearance-none text-gray-600"
            type="text"
            placeholder="اسم الدولة..."
          />
        </div>
        <div class="mb-4">
          <label class="block text-gray-500 text-sm font-bold mb-1" for="order"
            ><span>نوع الترتيب</span></label
          >
          <div class="inline-block relative w-full text-sm">
            <select
              v-model="filterFields.order"
              class="block pr-8 bg-gray-50 border-2 border-gray-300 w-full rounded-lg focus:border-green-500 focus:bg-transparent py-2 px-3 outline-none appearance-none text-gray-600 focus:outline-none focus:border-green-500;"
            >
              <option />
              <option value="total_confirmed_desc">
                مجموع الحالات المؤكدة: تنازلي
              </option>
              <option value="total_confirmed_asc">
                مجموع الحالات المؤكدة: تصاعدي
              </option>
            </select>
            <div
              class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700"
            >
              <span role="img" aria-label="down" class="anticon anticon-down"
                ><svg
                  class=""
                  data-icon="down"
                  width="1em"
                  height="1em"
                  fill="currentColor"
                  aria-hidden="true"
                  viewBox="64 64 896 896"
                  focusable="false"
                >
                  <path
                    d="M884 256h-75c-5.1 0-9.9 2.5-12.9 6.6L512 654.2 227.9 262.6c-3-4.1-7.8-6.6-12.9-6.6h-75c-6.5 0-10.3 7.4-6.5 12.7l352.6 486.1c12.8 17.6 39 17.6 51.7 0l352.6-486.1c3.9-5.3.1-12.7-6.4-12.7z"
                  /></svg
              ></span>
            </div>
          </div>
        </div>
        <button
          type="button"
          class="inline-flex justify-center items-center bg-green-600 hover:bg-green-700 hover:border-green-700 rounded text-white border-green-600 font-semibold shadow focus:outline-none py-3 px-5 w-full"
          @click="$emit('apply', filterFields)"
        >
          تصفية</button
        ><button
          type="button"
          class="inline-flex justify-center items-center py-3 px-5 border border-transparent text-base leading-6 font-medium rounded-md focus:outline-none active:bg-green-700 transition ease-in-out duration-150 text-white bg-gray-400 hover:bg-gray-500 w-full mt-2"
          @click="reset"
        >
          إعادة تعيين
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    filters: {
      type: [Object, Array],
      default: () => {},
    },
  },
  emits: ["apply", "reset"],
  data() {
    return {
      filterFields: this.filters,
    };
  },
  methods: {
    reset() {
      this.filterFields = {};
      this.$emit("reset");
    },
  },
};
</script>
