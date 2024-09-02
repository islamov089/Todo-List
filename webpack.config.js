const path = require('path');

module.exports = {
  entry: './resources/js/app.js',  
  output: {
    filename: 'bundle.js',
    path: path.resolve(__dirname, 'public/js'),  
  },
  module: {
    rules: [
      {
        test: /\.scss$/,  
        use: [
          'style-loader',
          'css-loader',
          'sass-loader',
        ],
      },
      {
        test: /\.js$/,  
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
        },
      },
      {
        test: /\.vue$/,  
        loader: 'vue-loader',
      },
    ],
  },
  resolve: {
    alias: {
      'vue$': 'vue/dist/vue.runtime.esm.js',
    },
    extensions: ['*', '.js', '.vue', '.json'],
  },
  plugins: [
    new VueLoaderPlugin(),
  ],
  mode: 'development',  
};
