export default ($axios) => ({
  async index(params) {
    return await $axios.$get("/api/countries", {
      params: params,
    });
  },

  async store(params) {
    return await $axios.$post("/api/countries", params);
  },

  async update(params) {
    return await $axios.$patch("/api/countries/" + params.id, params);
  },

  async summary() {
    return await $axios.$get("/api/countries/summary");
  },

  async fill() {
    return await $axios.$post("/api/fill_data");
  },
});
