<script setup>
  import { useForm } from 'vee-validate';
  import { useAuthStore } from '../../stores/authStore';
  import { useRouter } from 'vue-router';
  import * as yup from 'yup';

  const authStore = useAuthStore();
  const router = useRouter();

  const { values, errors, defineField, handleSubmit } = useForm({
    validationSchema: yup.object({
      email: yup.string().required('Email is required'),
      password: yup.string().required('Password is required'),
    }),
  });

  const [email, emailAttrs] = defineField('email');
  const [password, passwordAttrs] = defineField('password');

  const onSubmit = handleSubmit(async (values) => {
    await authStore.login(values);

    if(authStore.isAuthenticated) {
      router.push('/home');
    }
  });
</script>

<template>
  <form @submit="onSubmit" novalidate class="bg-gray-800 rounded-lg shadow-lg w-85 px-8 pt-6 pb-8 mb-24">

    <div class="mb-4">
      <label for="email" class="block text-white font-bold mb-2">Email</label>
      <input
      id="email"
      v-model="email"
      v-bind="emailAttrs"
      type="email"
      class="bg-gray-700 text-white font-bold rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 p-3 w-full">
      <p v-if="errors.email" class="text-red-600 font-bold mt-2">{{ errors.email }}</p>
    </div>

    <div class="mb-4">
      <label for="password" class="block text-white font-bold mb-2">Password</label>
      <input
      id="password"
      v-model="password"
      v-bind="passwordAttrs" 
      type="password"
      class="bg-gray-700 text-white font-bold rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 p-3 w-full">
      <p v-if="errors.password" class="text-red-600 font-bold mt-2">{{ errors.password }}</p>
    </div>

    <a @click="router.push('/register')" class="text-sm text-blue-400 hover:text-blue-600 mb-3 block cursor-pointer">Don't have an account?</a>
    <a href="#" class="text-sm text-blue-400 hover:text-blue-600 mb-3 block">Forgot password?</a>

    <button type="submit" class="bg-blue-400 hover:bg-blue-500 text-white font-bold py-2 rounded cursor-pointer w-full">
      Log in
    </button>

    <div v-if="authStore.error" class="mt-4 text-red-600 font-bold">
      <p>{{ authStore.error }}</p>
    </div>

  </form>
</template>
