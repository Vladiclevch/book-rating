<script setup>
  import { useForm } from 'vee-validate';
  import * as yup from 'yup';

  const { values, errors, defineField, handleSubmit } = useForm({
    validationSchema: yup.object({
      email: yup.string().required('Email is required'),
      password: yup.string().required('Password is required'),
    }),
  });

  const [email, emailAttrs] = defineField('email');
  const [password, passwordAttrs] = defineField('password');

  const onSubmit = handleSubmit(values => {
    console.log(values);
  });
</script>

<template>
  <form @submit="onSubmit" novalidate class="">

    <div class="">
      <label class="">Email</label>
      <input v-model="email" v-bind="emailAttrs" type="email" class="">
      <p v-if="errors.email" class="">{{ errors.email }}</p>
    </div>

    <div class="">
      <label class="">Password</label>
      <input v-model="password" v-bind="passwordAttrs" type="password" class="">
      <p v-if="errors.password" class="">{{ errors.password }}</p>
    </div>

    <button type="submit" class="">
      Log in
    </button>

  </form>
</template>

