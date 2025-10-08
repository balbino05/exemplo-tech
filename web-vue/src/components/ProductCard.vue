<template>
   <q-card class="product-card q-pa-md q-mb-md" bordered flat>
     <q-card-section>
       <div class="text-h6 text-primary ellipsis">{{ product.name }}</div>
       <div class="text-subtitle2 text-grey q-mt-xs ellipsis-2-lines">
         {{ product.description || 'Sem descrição disponível.' }}
       </div>
     </q-card-section>

     <q-separator spaced inset />

     <q-card-section class="q-pt-none">
       <div class="row items-center justify-between">
         <div class="text-bold text-positive">
           💰 R$ {{ formatPrice(product.price) }}
         </div>
         <q-badge
           :color="product.stock > 10 ? 'green' : 'red'"
           :label="`Estoque: ${product.stock}`"
           align="middle"
         />
       </div>
     </q-card-section>
   </q-card>
 </template>

 <script setup>
 defineProps({
   product: {
     type: Object,
     required: true,
   },
 })

 const formatPrice = (value) =>
   Number(value || 0).toLocaleString('pt-BR', { minimumFractionDigits: 2 })
 </script>

 <style scoped>
 .product-card {
   transition: transform 0.2s ease, box-shadow 0.2s ease;
   cursor: pointer;
 }
 .product-card:hover {
   transform: translateY(-4px);
   box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
 }
 .ellipsis {
   overflow: hidden;
   white-space: nowrap;
   text-overflow: ellipsis;
 }
 .ellipsis-2-lines {
   overflow: hidden;
   display: -webkit-box;
   -webkit-line-clamp: 2;
   -webkit-box-orient: vertical;
 }
 </style>
