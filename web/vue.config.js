const { defineConfig } = require('@vue/cli-service')
module.exports = defineConfig({
  transpileDependencies: true,
  publicPath: './',

  pwa: {
    name: 'web'
  },

  outputDir: '../public/admin/dist'
})
