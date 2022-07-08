<template>
  <div :id="id"></div>
</template>

<script>
import svgMap from "svgmap";
import "svgmap/dist/svgMap.min.css";
import countriesAR from "@/data/countriesAR";

export default {
  data() {
    return {
      id: "svgMap",
      map: null,
    };
  },
  methods: {
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
          "<div class='flex justify-between items-center w-full py-2 text-sm'><div>مجموع حالات كورونا المؤكدة (Total Confirmed)</div><div>" +
          (countryValues.totalConfirmed ?? "غير معروف") +
          "</div></div>";
        innerHTML +=
          "<div class='flex justify-between items-center w-full py-2 text-sm'><div>مجموع حالات التعافي (Total Recovered)</div><div>" +
          (countryValues.totalRecovered ?? "غير معروف") +
          "</div></div>";
        innerHTML +=
          "<div class='flex justify-between items-center w-full py-2 text-sm'><div>مجموع الوفيات (Total Deaths)</div><div>" +
          (countryValues.totalDeaths ?? "غير معروف") +
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
  mounted() {
    let self = this;
    this.map = new svgMap({
      targetElementID: this.id,
      data: {
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
        values: {
          AF: { totalConfirmed: 587, totalRecovered: 300 },
          AL: { totalConfirmed: 44, totalRecovered: 2, totalDeaths: 30 },
          DZ: { totalConfirmed: 100, totalRecovered: 4, totalDeaths: 60 },
        },
      },
      onGetTooltip: function (tooltipDiv, countryID, countryValues) {
        return self.customTooltip(tooltipDiv, countryID, countryValues);
      },
    });
  },
};
</script>

<style>
.svgMap-map-wrapper {
  background: transparent;
}
.svgMap-tooltip {
  box-shadow: none;
  border-radius: none;
  background: transparent;
  border-bottom: none;
}

@media (min-width: 768px) {
  .svgMap-map-wrapper {
    padding-top: 30%;
  }
}

@media (max-width: 575.98px) {
  .svgMap-map-wrapper {
    padding-top: 100%;
  }
}
</style>
