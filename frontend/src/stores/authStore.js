import { defineStore } from 'pinia';
import { ref, computed } from 'vue';
import { loginUser, fetchCurrentUser, logoutUser, registerUser } from '../api/auth';

export const useAuthStore = defineStore('authStore', () => {
  const user = ref(null);
  const token = ref(localStorage.getItem('token') || null);
  const isLoading = ref(false);
  const error = ref(null);

  const isAuthenticated = computed(() => !!token.value);

  const authenticate = async (apiMethod, userData, errorMessage) => {
    isLoading.value = true;
    error.value = null;

    try {
      const response = await apiMethod(userData);
      token.value = response.data.token;
      user.value = response.data.user;
      localStorage.setItem('token', token.value);

    } catch (err) {
      error.value = err.response?.data?.message || errorMessage;

    } finally {
      isLoading.value = false;
    }

  };

  const login = (userData) => authenticate(loginUser, userData, 'Login failed');
  const register = (userData) => authenticate(registerUser, userData, 'Register failed');

  const fetchUser = async () => {
    if(!token.value) return;

    try {
      const response = await fetchCurrentUser(token.value);
      user.value = response.data;

    } catch {
      logout();
    }

  };

  const logout = async () => {

    try {
      await logoutUser();

    } catch (error) {
      console.error('Logout failed:', error);
    }

    user.value = null;
    token.value = null;
    localStorage.removeItem('token');
  };

  return {
    user,
    token,
    isAuthenticated,
    isLoading,
    error,
    register,
    login,
    fetchUser,
    logout,
  }
});
