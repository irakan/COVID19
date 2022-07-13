export default ($axios) => ({
  async index(params) {
    return await $axios.$get("/api/countries", {
      params: params,
    });
  },

  async show(id) {
    return await $axios.$get("/api/countries/" + id);
  },

  async store(params) {
    return await $axios.$post("/api/countries", params);
  },

  async update(id, params) {
    return await $axios.$patch("/api/countries/" + id, params);
  },

  async summary() {
    return await $axios.$get("/api/countries/summary");
  },

  async fill() {
    return await $axios.$post("/api/fill_data");
  },
});
