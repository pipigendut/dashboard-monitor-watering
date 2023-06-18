module.exports = {
    // Delete the prefetch plugin
    chainWebpack: config => {
      config.plugins.delete('prefetch')
    },
    configureWebpack: {
      plugins: [
        new webpack.ProvidePlugin({
          process: "process/browser",
          Buffer: ["buffer", "Buffer"],
        }),
      ],
    },
}
