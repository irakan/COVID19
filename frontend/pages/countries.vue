<template>
  <div class="container mx-auto lg:flex lg:h-full lg:p-12 px-8 py-4">
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

    <div class="w-full h-full bg-white rounded-lg shadow lg:mx-4 mt-8 lg:mt-0">
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
                <th scope="col" class="relative px-6 py-3 w-40">
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
                  class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                >
                  <a href="#" class="text-gray-400 hover:text-gray-600"
                    >تعديل</a
                  >
                </td>
              </tr>
            </tbody>
          </table>
          <div class="flex justify-center px-8 py-8 text-gray-500">
            <PaginationLinks
              :meta="countries.meta"
              @page-change="loadPageCountries($event)"
            />
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
    };
  },
  async mounted() {
    this.countries = await this.$api.countries.index();
  },
  methods: {
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
