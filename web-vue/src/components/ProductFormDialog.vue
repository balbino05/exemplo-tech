<template>
   <q-dialog v-model="model">
     <q-card style="min-width: 400px; max-width: 90vw">
       <q-card-section class="text-h6">
         {{ isEdit ? 'Editar Produto' : 'Novo Produto' }}
       </q-card-section>

       <q-separator />

       <q-card-section class="q-gutter-md">
         <q-input v-model="form.name" label="Nome" filled dense />
         <q-input v-model="form.description" label="Descrição" filled dense type="textarea" />
         <q-input v-model.number="form.price" label="Preço (R$)" filled dense type="number" />
         <q-input v-model.number="form.stock" label="Estoque" filled dense type="number" />
       </q-card-section>

       <q-separator />

       <q-card-actions align="right">
         <q-btn flat label="Cancelar" color="grey" v-close-popup />
         <q-btn :label="isEdit ? 'Salvar' : 'Criar'" color="primary" @click="onSubmit" />
       </q-card-actions>
     </q-card>
   </q-dialog>
 </template>

 <script setup>
 import { ref, computed, watch } from 'vue'

 const props = defineProps({
   modelValue: Boolean,
   product: Object,
 })
 const emit = defineEmits(['update:modelValue', 'saved'])

 const model = ref(props.modelValue)
 watch(() => props.modelValue, v => (model.value = v))
 watch(model, v => emit('update:modelValue', v))

 const form = ref({ id: null, name: '', description: '', price: 0, stock: 0 })

 watch(() => props.product, (p) => {
   form.value = p
     ? { ...p }
     : { id: null, name: '', description: '', price: 0, stock: 0 }
 }, { immediate: true })

 const isEdit = computed(() => !!form.value.id)

 function onSubmit() {
   emit('saved', { ...form.value })
   model.value = false
 }
 </script>
