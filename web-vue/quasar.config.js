import { defineConfig } from '#q-app/wrappers'
import path from 'path'

export default defineConfig(() => ({
  boot: ['apollo'],
  css: ['app.scss'],
  extras: ['roboto-font', 'material-icons'],

  build: {
    target: {
      browser: ['es2022', 'firefox115', 'chrome115', 'safari14'],
      node: 'node20',
    },
    alias: {
      components: path.resolve('./src/components'),
      pages: path.resolve('./src/pages'),
      layouts: path.resolve('./src/layouts'),
      boot: path.resolve('./src/boot'),
    },
    vueRouterMode: 'hash',
  },

  devServer: {
    open: true,
    port: 9000,
  },

  framework: {
    config: {},
    plugins: [],
  },
}))
