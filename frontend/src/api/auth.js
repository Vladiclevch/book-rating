import instance from "./axiosInstance";

export const loginUser = async (userData) => {
  return await instance.post('/login', userData);
};

export const registerUser = async (userData) => {
  return await instance.post('/register', userData);
};

export const fetchCurrentUser = async () => {
  return await instance.post('/fetchCurrentUser');
};

export const logoutUser = async () => {
  return await instance.post('/logout');
};
