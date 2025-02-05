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
      confirmPassword: yup.string().oneOf([yup.ref('password')], 'Passwords must match').required('Confirm password is required'),
    }),
  });

  const [name, nameAttrs] = defineField('name');
  const [email, emailAttrs] = defineField('email');
  const [password, passwordAttrs] = defineField('password');
  const [confirmPassword, confirmPasswordAttrs] = defineField('confirmPassword');

  const onSubmit = handleSubmit(async (values) => {
    await authStore.register(values);

    if(!authStore.error) {
      router.push('/login');
    }
  });
</script>

<template>
  <form @submit="onSubmit" novalidate>

    <div>
      <label class="">User name</label>
      <input v-model="name" v-bind="nameAttrs" type="text" class="">
      <p v-if="errors.name" class="">{{ errors.name }}</p>
    </div>

    <div>
      <label class="">Email</label>
      <input v-model="email" v-bind="emailAttrs" type="email" class="">
      <p v-if="errors.email" class="">{{ errors.email }}</p>
    </div>

    <div>
      <label class="">Password</label>
      <input v-model="password" v-bind="passwordAttrs" type="password" class="">
      <p v-if="errors.password" class="">{{ errors.password }}</p>
    </div>

    <div>
      <label class="">Confirm password</label>
      <input v-model="confirmPassword" v-bind="confirmPasswordAttrs" type="password" class="">
      <p v-if="errors.confirmPassword" class="">{{ errors.confirmPassword }}</p>
    </div>

    <button type="submit" class="">
      Sign up
    </button>

    <p v-if="authStore.error" class="">{{ authStore.error }}</p>
    
  </form>
</template>
