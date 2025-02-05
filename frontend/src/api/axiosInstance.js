import axios from 'axios'

const instance = axios.create({
  baseURL: 'https://some-domain.com/api/',
  withCredentials: true,
  headers: {'Content-Type': 'application/json',}
}); 

instance.interceptors.request.use((config) => {
  const token = localStorage.getItem('token');

  if(token) {
    config.headers.Authorization = `Bearer ${token}`
  }

  return config;
});

export default instance;
