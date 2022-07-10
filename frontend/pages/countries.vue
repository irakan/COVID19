<template>
  <div class="container flex flex-col lg:flex-row mx-auto py-16 h-full">
    <aside class="bg-gray-200 mx-4 lg:mx-0 px-4 py-6">
      <CountriesFilter />
    </aside>

    <div class="overflow-x-auto mx-4 lg:mx-12 mt-6 lg:mt-0">
      <div class="align-middle inline-block min-w-full h-full">
        <div
          v-if="countries"
          class="shadow overflow-hidden border border-gray-200 rounded-lg bg-white h-full"
        >
          <table class="min-w-full lg:w-full table-fixed">
            <thead class="bg-gray-100">
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
          <div class="flex justify-center px-8 py-4 text-gray-500">
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
      this.countries = await this.$api.countries.index({ page: page });
    },
  },
};
</script>
