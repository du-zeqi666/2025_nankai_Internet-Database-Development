const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
  entry: './scripts/core/app.js',
  output: {
    filename: 'js/app.bundle.js',
    path: path.resolve(__dirname, '../../web/assets/build'),
    clean: true,
    publicPath: '/assets/build/'
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env']
          }
        }
      },
      {
        test: /\.scss$/,
        use: [
          MiniCssExtractPlugin.loader,
          'css-loader',
          'sass-loader'
        ]
      }
    ]
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: 'css/app.bundle.css'
    })
  ],
  resolve: {
    extensions: ['.js', '.scss']
  }
};
