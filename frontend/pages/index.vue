<template>
  <div>
    <div class="bg-gray-300">
      <WorldMap
        v-if="mapDataOptions"
        :map-data-options="mapDataOptions"
        :custom-tooltip-function="customTooltip"
      ></WorldMap>
      <div v-else class="svgMap-map-empty-div"></div>
    </div>
    <div class="p-8 max-w-lg mx-auto mt-12">
      <button
        type="button"
        class="inline-flex justify-center items-center bg-green-600 hover:bg-green-700 hover:border-green-700 rounded text-white border-green-600 font-semibold shadow focus:outline-none py-3 px-5 w-full"
      >
        عرض قائمة الدول
      </button>
    </div>
  </div>
</template>

<script>
import countriesAR from "@/data/countriesAR";

export default {
  data() {
    return {
      countriesSummary: {},
      mapDataOptions: null,
    };
  },
  methods: {
    setWorldMapData() {
      this.mapDataOptions = {
        data: {
          totalConfirmed: {
            name: "الحالات المؤكدة (Total Confirmed):",
          },
          totalRecovered: {
            name: "الحالات المؤكدة (Total Confirmed):",
          },
          totalDeaths: {
            name: "الحالات المؤكدة (Total Confirmed):",
          },
        },
        applyData: "totalConfirmed",
        values: this.countriesSummary,
      };
    },
    customTooltip(tooltipDiv, countryID, countryValues) {
      let countryName = countriesAR[countryID];

      // Start countainer
      var innerHTML =
        "<div class='flex flex-col justify-center items-center w-96 shadow bg-white py-2 px-3 rounded-lg border-white text-gray-600'>";

      // Country name
      innerHTML +=
        "<div class='flex justify-center text-lg border-b w-full py-2'>" +
        countryName +
        "</div>";

      // Country values
      if (countryValues) {
        innerHTML +=
          "<div class='flex justify-between items-center w-full py-2 text-sm'><div>مجموع الحالات المؤكدة (Total Confirmed)</div><div>" +
          (countryValues.totalConfirmed.toLocaleString("en") ?? "غير معروف") +
          "</div></div>";
        innerHTML +=
          "<div class='flex justify-between items-center w-full py-2 text-sm'><div>مجموع حالات التعافي (Total Recovered)</div><div>" +
          (countryValues.totalRecovered.toLocaleString("en") ?? "غير معروف") +
          "</div></div>";
        innerHTML +=
          "<div class='flex justify-between items-center w-full py-2 text-sm'><div>مجموع الوفيات (Total Deaths)</div><div>" +
          (countryValues.totalDeaths.toLocaleString("en") ?? "غير معروف") +
          "</div></div>";
      } else {
        innerHTML +=
          "<div class='w-full py-2 text-center'><div>لا توجد بيانات.</div></div>";
      }

      // End countainer
      innerHTML += "</div>";

      tooltipDiv.innerHTML = innerHTML;
    },
  },
  async mounted() {
    let self = this;
    const response = await this.$api.countries.summary();

    response.data.map((country) => {
      self.countriesSummary[country.code] = {
        code: country.code,
        name: country.name,
        totalConfirmed: country.totalConfirmed,
        totalRecovered: country.totalRecovered,
        totalDeaths: country.totalDeaths,
      };
    });
    this.setWorldMapData();
  },
};
</script>

<style>
.svgMap-map-empty-div {
  padding-top: 30%;
}

@media (max-width: 575.98px) {
  .svgMap-map-empty-div {
    padding-top: 100%;
  }
}
</style>
