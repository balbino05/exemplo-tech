<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated class="bg-primary text-white">
      <q-toolbar>
        <q-toolbar-title>📘 Exemplo Tech</q-toolbar-title>
        <q-btn flat dense label="Sair" @click="logout" />
      </q-toolbar>
    </q-header>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script setup>
import { useRouter } from 'vue-router'
import { Notify } from 'quasar'

const router = useRouter()

function logout() {
  localStorage.removeItem('token')
  localStorage.removeItem('user')
  Notify.create({ type: 'info', message: 'Sessão encerrada.' })
  router.push('/login')
}
</script>
