import AuthLayout from 'layouts/AuthLayout.vue'
import LoginPage from 'pages/LoginPage.vue'
import MainLayout from 'layouts/MainLayout.vue'
import ProductsPage from 'pages/ProductsPage.vue'

const routes = [
  {
    path: '/login',
    component: AuthLayout,
    children: [{ path: '', component: LoginPage }]
  },
  {
    path: '/',
    component: MainLayout,
    meta: { requiresAuth: true },
    children: [
      { path: '', redirect: '/products' },
      { path: '/products', component: ProductsPage },
    ],
  },
]

export default routes
