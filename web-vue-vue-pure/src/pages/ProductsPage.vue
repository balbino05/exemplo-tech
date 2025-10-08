<template>
   <q-page padding>
     <div class="text-h5 q-mb-md">🛍️ Lista de Produtos</div>

     <q-card
       v-for="p in products"
       :key="p.id"
       class="q-mb-md shadow-2"
       bordered
     >
       <q-card-section>
         <div class="text-h6">{{ p.name }}</div>
         <div class="text-subtitle2 text-grey">{{ p.description }}</div>
         <div class="q-mt-sm">
           <strong>R$ {{ p.price.toFixed(2) }}</strong> — {{ p.stock }} em estoque
         </div>
       </q-card-section>
     </q-card>

     <div v-if="loading" class="text-center q-mt-md">
       <q-spinner color="primary" size="2em" />
       <div>Carregando produtos...</div>
     </div>
   </q-page>
 </template>

 <script setup>
 import { useQuery } from '@vue/apollo-composable'
 import gql from 'graphql-tag'
 import { computed } from 'vue'

 const GET_PRODUCTS = gql`
   query {
     products {
       id
       name
       description
       price
       stock
     }
   }
 `

 const { result, loading, error } = useQuery(GET_PRODUCTS)
 const products = computed(() => result.value?.products ?? [])

 if (error.value) {
   console.error('Erro GraphQL:', error.value)
 }
 </script>
