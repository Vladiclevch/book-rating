<script setup>
  import { useField, useForm} from 'vee-validate';
  import * as yup from 'yup';

  const schema = yup.object({
    name: yup.string().required('Name is required'),
    email: yup.string().email('Incorrect email').required('Email is required'),
    password: yup.string().min(6, 'Password must be at least 6 characters long').required('Password is required'),
    confirmPassword: yup.string().oneOf([yup.ref('password')], 'Passwords must match').required('Confirm password is required'),
  });

  const { handleSubmit } = useForm({ validationSchema: schema });
  const name = useField('name');
  const email = useField('email');
  const password = useField('password');
  const confirmPassword = useField('confirmPassword');

  const onSubmit = handleSubmit(values => {
    console.log(values);
  });
</script>

<template>
  <form @submit="onSubmit">
    <div>
      <label class="">User name</label>
      <input v-model="name.value" type="text" class="">
      <p v-if="name.errorMessage" class=""></p>
    </div>

    <div>
      <label class="">Email</label>
      <input v-model="email.value" type="email" class="">
      <p v-if="email.errorMessage" class=""></p>
    </div>

    <div>
      <label class="">Password</label>
      <input v-model="password.value" type="password" class="">
      <p v-if="password.errorMessage" class=""></p>
    </div>

    <div>
      <label class="">Confirm password</label>
      <input v-model="confirmPassword.value" type="password" class="">
      <p v-if="confirmPassword.errorMessage" class=""></p>
    </div>

    <button type="submit">
      Sign up
    </button>
  </form>
</template>
