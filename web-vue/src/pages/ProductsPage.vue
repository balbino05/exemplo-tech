<template>
  <q-page class="q-pa-md bg-grey-1">
    <div class="text-h5 text-primary q-mb-md flex items-center justify-between">
      <span>📦 Lista de Produtos</span>
      <q-btn color="primary" icon="add" label="Novo Produto" @click="openCreate" />
    </div>

    <q-inner-loading :showing="loading">
      <q-spinner size="50px" color="primary" />
    </q-inner-loading>

    <div v-if="!loading && products.length === 0" class="text-center q-pa-xl text-grey">
      Nenhum produto encontrado.
    </div>

    <div v-else class="row q-col-gutter-md">
      <div v-for="p in products" :key="p.id" class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
        <ProductCard :product="p" @edit="openEdit" @delete="confirmDelete" />
      </div>
    </div>

    <ProductFormDialog
      v-model="dialogOpen"
      :product="selected"
      @saved="handleSave"
    />
  </q-page>
</template>

<script setup>
import { useQuery, useMutation } from '@vue/apollo-composable'
import gql from 'graphql-tag'
import { computed, ref } from 'vue'
import { Dialog, Notify } from 'quasar'

import ProductCard from 'components/ProductCard.vue'
import ProductFormDialog from 'components/ProductFormDialog.vue'

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

const CREATE_PRODUCT = gql`
  mutation ($name:String!, $description:String, $price:Float!, $stock:Int!) {
    createProduct(name:$name, description:$description, price:$price, stock:$stock) {
      id name description price stock
    }
  }
`

const UPDATE_PRODUCT = gql`
  mutation ($id:ID!, $name:String, $description:String, $price:Float, $stock:Int) {
    updateProduct(id:$id, name:$name, description:$description, price:$price, stock:$stock) {
      id name description price stock
    }
  }
`

const DELETE_PRODUCT = gql`
  mutation ($id:ID!) {
    deleteProduct(id:$id)
  }
`

const { result, loading, refetch } = useQuery(GET_PRODUCTS)
const products = computed(() => result.value?.products ?? [])

const dialogOpen = ref(false)
const selected = ref(null)

function openCreate() {
  selected.value = null
  dialogOpen.value = true
}
function openEdit(prod) {
  selected.value = prod
  dialogOpen.value = true
}

const { mutate: createMut } = useMutation(CREATE_PRODUCT)
const { mutate: updateMut } = useMutation(UPDATE_PRODUCT)
const { mutate: deleteMut } = useMutation(DELETE_PRODUCT)

async function handleSave(payload) {
  try {
    if (payload.id) {
      await updateMut({ id: payload.id, ...payload })
      Notify.create({ type: 'positive', message: 'Produto atualizado!' })
    } else {
      await createMut(payload)
      Notify.create({ type: 'positive', message: 'Produto criado!' })
    }
    await refetch()
  } catch (e) {
    console.error(e)
    Notify.create({ type: 'negative', message: 'Erro ao salvar produto' })
  }
}

function confirmDelete(prod) {
  Dialog.create({
    title: 'Confirmar exclusão',
    message: `Excluir "${prod.name}"?`,
    cancel: true,
    persistent: true,
  }).onOk(async () => {
    try {
      await deleteMut({ id: prod.id })
      Notify.create({ type: 'positive', message: 'Produto excluído!' })
      await refetch()
    } catch (e) {
      console.error(e)
      Notify.create({ type: 'negative', message: 'Erro ao excluir produto' })
    }
  })
}
</script>
