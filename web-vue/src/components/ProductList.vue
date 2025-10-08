<template>
  <div class="p-4">
    <h1 class="text-2xl font-bold mb-4">Lista de Produtos</h1>

    <div v-if="loading">Carregando produtos...</div>

    <ul v-else-if="products.length">
      <li v-for="p in products" :key="p.id">
        <strong>{{ p.name }}</strong> — R$ {{ p.price.toFixed(2) }}
        ({{ p.stock }} em estoque)
      </li>
    </ul>

    <div v-else>Nenhum produto encontrado.</div>
  </div>
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
