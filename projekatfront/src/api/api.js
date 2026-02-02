//u ovom fajlu cuvamo sve API pozive koje koristimo u komunikaciji sa backend-om

import axios from "axios";


//izmedju klijenta i servera koristimo samo jednu axios instancu koja se krece izmedju frontenda i backenda
const api = axios.create({
  baseURL: "http://localhost:8000/api",
});
api.interceptors.request.use((config) => {
  const token = localStorage.getItem("token");

  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }

  return config;
});

export default api;