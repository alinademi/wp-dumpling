const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
console.log('%c👉', "font-size: large;", path.resolve(__dirname, 'assets/dist'));

module.exports = {
  entry: {
    'js/index': './assets/src/js/index.js',
    'css/styles': './assets/src/scss/styles.scss',
  },
  output: {
    path: path.resolve(__dirname, 'assets/dist'),
    filename: '[name].min.js',
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
        },
      },
      {
        test: /\.scss$/,
        use: [
          MiniCssExtractPlugin.loader,
          'css-loader',
          'sass-loader',
        ],
      },
    ],
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: '[name].min.css',
    }),
  ],
};
