<template>
   <q-page class="q-pa-md bg-grey-1">
     <div class="text-h5 text-primary q-mb-md flex items-center justify-between">
       <span>📦 Lista de Produtos</span>
       <q-btn color="primary" icon="add" label="Novo Produto" @click="createProduct" />
     </div>

     <q-inner-loading :showing="loading">
       <q-spinner size="50px" color="primary" />
     </q-inner-loading>

     <div v-if="!loading && products.length === 0" class="text-center q-pa-xl text-grey">
       Nenhum produto encontrado.
     </div>

     <div v-else class="row q-col-gutter-md">
       <div v-for="p in products" :key="p.id" class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
         <ProductCard :product="p" />
       </div>
     </div>
   </q-page>
 </template>

 <script setup>
 import { useQuery } from '@vue/apollo-composable'
 import gql from 'graphql-tag'
 import { computed } from 'vue'
 import ProductCard from 'components/ProductCard.vue'

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

 if (error.value) console.error('Erro ao carregar produtos:', error.value)

 const createProduct = () => {
   console.log('Função para criar produto — implementar depois.')
 }
 </script>
