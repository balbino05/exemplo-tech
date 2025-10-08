<template>
   <div v-if="loading">Carregando...</div>
   <ul v-else>
     <li v-for="p in products" :key="p.id">{{ p.name }} — R$ {{ p.price }}</li>
   </ul>
 </template>
 <script setup>
 import { useQuery, gql } from '@vue/apollo-composable'
 const PRODUCTS = gql`query { products { id name price } }`
 const { result, loading } = useQuery(PRODUCTS)
 const products = computed(()=> result.value ?? [])
 </script>
