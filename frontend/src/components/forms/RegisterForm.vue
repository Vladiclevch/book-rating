<script setup>
  import { useForm } from 'vee-validate';
  import { useAuthStore } from '../../stores/authStore';
  import { useRouter } from 'vue-router';
  import * as yup from 'yup';

  const authStore = useAuthStore();
  const router = useRouter();

  const { values, errors, defineField, handleSubmit } = useForm({
    validationSchema: yup.object({
      name: yup.string().required('Name is required'),
      email: yup.string().email('Incorrect email address').required('Email is required'),
      password: yup.string().min(6, 'Password must be at least 6 characters long').required('Password is required'),
      password_confirmation: yup.string().oneOf([yup.ref('password')], 'Passwords must match').required('Confirm password is required'),
    }),
  });

  const [name, nameAttrs] = defineField('name');
  const [email, emailAttrs] = defineField('email');
  const [password, passwordAttrs] = defineField('password');
  const [password_confirmation, passwordConfirmationAttrs] = defineField('password_confirmation');

  const onSubmit = handleSubmit(async (values) => {
    await authStore.register(values);

    if(!authStore.error) {
      router.push('/login');
    }
  });
</script>

<template>
  <form @submit="onSubmit" novalidate class="bg-neutral-800 rounded-lg shadow-lg w-85 px-8 pt-6 pb-8 mb-14">

    <div class="mb-4">
      <label for="name" class="block text-white font-bold mb-2">User name</label>
      <input
      id="name"
      v-model="name"
      v-bind="nameAttrs"
      type="text"
      class="bg-neutral-700 text-white font-bold rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 p-3 w-full">
      <p v-if="errors.name" class="text-red-600 font-bold mt-2">{{ errors.name }}</p>
    </div>

    <div class="mb-4">
      <label for="email" class="block text-white font-bold mb-2">Email</label>
      <input
      id="email"
      v-model="email"
      v-bind="emailAttrs"
      type="email"
      class="bg-neutral-700 text-white font-bold rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 p-3 w-full">
      <p v-if="errors.email" class="text-red-600 font-bold mt-2">{{ errors.email }}</p>
    </div>

    <div class="mb-4">
      <label for="password" class="block text-white font-bold mb-2">Password</label>
      <input
      id="password"
      v-model="password"
      v-bind="passwordAttrs"
      type="password"
      class="bg-neutral-700 text-white font-bold rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 p-3 w-full">
      <p v-if="errors.password" class="text-red-600 font-bold mt-2">{{ errors.password }}</p>
    </div>

    <div class="mb-4">
      <label for="password_confirmation" class="block text-white font-bold mb-2">Confirm password</label>
      <input
      id="password_confirmation"
      v-model="password_confirmation"
      v-bind="passwordConfirmationAttrs"
      type="password"
      class="bg-neutral-700 text-white font-bold rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 p-3 w-full">
      <p v-if="errors.password_confirmation" class="text-red-600 font-bold mt-2">{{ errors.password_confirmation }}</p>
    </div>

    <a @click="router.push('/login')" class="text-sm text-blue-400 hover:text-blue-600 mb-3 block cursor-pointer">Already have an account?</a>

    <button type="submit" class="bg-blue-400 hover:bg-blue-500 text-white font-bold py-2 rounded cursor-pointer w-full">
      Sign up
    </button>

    <div v-if="authStore.error" class="mt-4 text-red-600 font-bold">
      <p>{{ authStore.error }}</p>
    </div>
    
  </form>
</template>
