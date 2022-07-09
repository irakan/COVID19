import CountriesApi from "@/api/countries.js";

export default function ({ $axios }, inject) {
  const api = {
    countries: CountriesApi($axios),
  };
  inject("api", api);
}
