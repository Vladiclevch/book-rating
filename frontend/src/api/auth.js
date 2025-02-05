import instance from "./axiosInstance";

export const loginUser = async (userData) => {
  return await instance.post('/auth/login', userData);
};

export const registerUser = async (userData) => {
  return await instance.post('/auth/register', userData);
};

export const fetchCurrentUser = async () => {
  return await instance.post('/auth/fetchCurrentUser');
};

export const logoutUser = async () => {
  return await instance.post('/auth/logout');
};
