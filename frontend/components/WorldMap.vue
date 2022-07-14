<template>
  <div :id="id" />
</template>

<script>
import svgMap from "svgmap";
import "svgmap/dist/svgMap.min.css";

export default {
  props: {
    mapDataOptions: {
      type: Object,
      default: () => ({}),
    },
    customTooltipFunction: {
      type: Function,
      default: () => ({}),
    },
  },
  data() {
    return {
      id: "svgMap",
      map: null,
    };
  },
  mounted() {
    this.initMap();
  },
  methods: {
    initMap() {
      let self = this;
      this.map = new svgMap({
        targetElementID: this.id,
        data: { ...this.mapDataOptions },
        onGetTooltip: function (tooltipDiv, countryID, countryValues) {
          return self.customTooltipFunction(
            tooltipDiv,
            countryID,
            countryValues
          );
        },
      });
    },
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
