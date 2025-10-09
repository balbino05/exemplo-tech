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

    <div class="q-mt-lg flex justify-center">
      <q-pagination
        v-model="page"
        :max="pagination.lastPage"
        color="primary"
        boundary-numbers
        @update:model-value="loadPage"
      />
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
import { computed, ref, watch } from 'vue'
import { Dialog, Notify } from 'quasar'
import { CREATE_PRODUCT, UPDATE_PRODUCT, DELETE_PRODUCT, GET_PRODUCTS } from 'src/graphql/mutations'
import ProductCard from 'components/ProductCard.vue'
import ProductFormDialog from 'components/ProductFormDialog.vue'

// 🔹 Controle de paginação
const page = ref(1)
const limit = ref(8)

const { result, loading, refetch } = useQuery(GET_PRODUCTS, { limit: limit.value, page: page.value })

const products = computed(() => result.value?.products?.data ?? [])
const pagination = computed(() => result.value?.products?.paginatorInfo ?? { total: 0, currentPage: 1, lastPage: 1 })

watch(page, async (val) => {
  await refetch({ limit: limit.value, page: val })
})

function loadPage(val) {
  page.value = val
}

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
      await updateMut({
        id: parseInt(payload.id),
        name: payload.name,
        description: payload.description,
        price: parseFloat(payload.price),
        stock: parseInt(payload.stock)
      })
      Notify.create({ type: 'positive', message: 'Produto atualizado!' })
    } else {
      await createMut(payload)
      Notify.create({ type: 'positive', message: 'Produto criado!' })
    }
    await refetch({ limit: limit.value, page: page.value })
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
      await deleteMut({ id: parseInt(prod.id) })
      Notify.create({ type: 'positive', message: 'Produto excluído!' })
      await refetch({ limit: limit.value, page: page.value })
    } catch (e) {
      console.error(e)
      Notify.create({ type: 'negative', message: 'Erro ao excluir produto' })
    }
  })
}
</script>
