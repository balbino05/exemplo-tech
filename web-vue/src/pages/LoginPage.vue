<template>
   <q-page class="flex flex-center bg-grey-2">
     <q-card class="q-pa-lg shadow-3" style="width: 350px;">
       <div class="text-h6 text-center text-primary q-mb-md">Acessar Conta</div>

       <q-form @submit.prevent="handleLogin" class="q-gutter-md">
         <q-input
           v-model="email"
           label="Email"
           type="email"
           outlined
           dense
           required
         />
         <q-input
           v-model="password"
           label="Senha"
           type="password"
           outlined
           dense
           required
         />

         <q-btn
           type="submit"
           color="primary"
           label="Entrar"
           class="full-width"
           :loading="loading"
         />
       </q-form>
     </q-card>
   </q-page>
 </template>

 <script setup>
 import { ref } from 'vue'
 import { useMutation } from '@vue/apollo-composable'
 import { Notify } from 'quasar'
 import { useRouter } from 'vue-router'
 import {LOGIN_MUTATION} from 'src/graphql/mutations'

 const router = useRouter()
 const email = ref('')
 const password = ref('')
 const loading = ref(false)



 const { mutate: loginMutate } = useMutation(LOGIN_MUTATION)

 async function handleLogin() {
   loading.value = true
   try {
     const { data } = await loginMutate({ email: email.value, password: password.value })
     if (data?.login?.access_token) {
       localStorage.setItem('token', data.login.access_token)
       localStorage.setItem('user', JSON.stringify(data.login.user))
       Notify.create({ type: 'positive', message: `Bem-vindo ${data.login.user.name}!` })
       router.push('/products')
     }
   } catch (error) {
     console.error(error)
     Notify.create({ type: 'negative', message: 'Credenciais inválidas.' })
   } finally {
     loading.value = false
   }
 }
 </script>

 <style scoped>
 .q-page {
   min-height: 100vh;
 }
 </style>
