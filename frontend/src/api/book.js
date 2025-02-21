import instance from "./axiosInstance";

export const createBook = async (formData) => {
  try {
    const response = await instance.post('/books', formData, {
      headers: { 'Content-Type': 'multipart/form-data' },
    });
    return response.data;
  } catch (error) {
    throw error.response ? error.response.data : error.message;
  }
};

export const getBooks = async () => {
  try {
    const response = await instance.get(`/books`);
    return response.data;
  } catch (error) {
    throw error.response ? error.response.data : error.message;
  }
};
