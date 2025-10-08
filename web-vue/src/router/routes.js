import MainLayout from 'layouts/MainLayout.vue'
import ProductsPage from 'pages/ProductsPage.vue'

const routes = [
  {
    path: '/',
    component: MainLayout,
    children: [
      { path: '', redirect: '/products' },
      { path: '/products', component: ProductsPage },
    ],
  },
]

export default routes
