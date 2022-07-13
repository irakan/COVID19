<template>
  <div
    class="container mx-auto flex flex-col lg:h-full lg:p-5 px-8 py-4 relative"
  >
    <div
      v-if="$auth.loggedIn"
      class="flex justify-end items-center lg:mx-4 mb-3"
    >
      <NuxtLink
        to="/countries/create"
        class="inline-flex justify-center items-center bg-green-600 hover:bg-green-700 hover:border-green-700 rounded text-white border-green-600 font-semibold shadow focus:outline-none py-3 px-5 mx-2"
        >إضافة دولة</NuxtLink
      >
      <a
        href="#"
        class="flex justify-center items-center bg-green-600 hover:bg-green-700 hover:border-green-700 rounded text-white border-green-600 font-semibold shadow focus:outline-none py-3 px-5"
        @click.prevent="fillData"
      >
        <span v-if="!fillingData">تعبئة البيانات</span>
        <svg
          v-else
          class="animate-spin h-6 w-5 text-white"
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
          /></svg
      ></a>
    </div>
    <div class="lg:flex h-full">
      <aside class="flex flex-col lg:w-3/12 bg-white rounded-lg shadow">
        <div
          class="text-center bg-gray-200 rounded-t-lg px-6 py-3 text-gray-500 text-sm font-semibold"
        >
          تصفية قائمة الدول
        </div>

        <CountriesFilter
          v-if="countries"
          :filters="countries.filters"
          @apply="filterCountries($event)"
          @reset="filterCountries(null)"
        />
      </aside>

      <div
        class="w-full h-full bg-white rounded-lg shadow lg:mx-4 mt-8 lg:mt-0"
      >
        <div class="overflow-x-auto rounded-lg">
          <div
            v-if="countries"
            class="align-middle inline-block min-w-full overflow-hidden"
          >
            <table class="min-w-full lg:w-full table-fixed">
              <thead class="bg-gray-200">
                <tr>
                  <th
                    scope="col"
                    class="px-6 py-3 text-right text-gray-500 text-sm"
                  >
                    الدولة
                  </th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-right text-gray-500 text-sm"
                  >
                    الحالات المؤكدة
                  </th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-right text-gray-500 text-sm"
                  >
                    حالات التعافي
                  </th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-right text-gray-500 text-sm"
                  >
                    الوفيات
                  </th>
                  <th
                    v-if="$auth.loggedIn"
                    scope="col"
                    class="relative px-6 py-3 w-40"
                  >
                    <span class="sr-only">تعديل</span>
                  </th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200">
                <tr
                  v-for="(country, index) in countries.data"
                  :key="index"
                  class="hover:bg-gray-100"
                >
                  <td
                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"
                    v-text="country.name"
                  />
                  <td
                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                    v-text="country.totalConfirmed.toLocaleString('en')"
                  />
                  <td
                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                    v-text="country.totalRecovered.toLocaleString('en')"
                  />
                  <td
                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                    v-text="country.totalDeaths.toLocaleString('en')"
                  />
                  <td
                    v-if="$auth.loggedIn"
                    class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                  >
                    <NuxtLink
                      :to="'/countries/' + country.id + '/edit'"
                      class="inline-flex items-center px-2 py-1 rounded-full text-sm font-medium leading-5 text-white bg-gray-400 hover:bg-gray-500 focus:outline-none focus:shadow-outline"
                      >تعديل</NuxtLink
                    >
                  </td>
                </tr>
              </tbody>
            </table>
            <div class="flex justify-center px-8 py-4 text-gray-500">
              <PaginationLinks
                v-if="countries.data.length > 0"
                :meta="countries.meta"
                @page-change="loadPageCountries($event)"
              />
              <div v-else class="text-center text-gray-500">
                لا توجد بيانات.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "CountriesIndexPage",
  data() {
    return {
      countries: null,
      fillingData: false,
    };
  },
  async mounted() {
    this.countries = await this.$api.countries.index();
  },
  methods: {
    async fillData() {
      this.fillingData = true;
      try {
        const response = await this.$api.countries.fill();
        if (response.status === "success") {
          this.$toast.success(response.message);
        } else {
          this.$toast.show(response.message);
        }
      } catch (e) {
        this.$toast.error(e.message);
      } finally {
        this.fillingData = false;
      }
    },
    async loadPageCountries(page) {
      this.countries = await this.$api.countries.index({
        ...this.countries?.filters,
        page: page,
      });
    },
    async filterCountries(filters) {
      this.countries = await this.$api.countries.index({
        ...filters,
        page: 1,
      });
    },
  },
};
</script>
