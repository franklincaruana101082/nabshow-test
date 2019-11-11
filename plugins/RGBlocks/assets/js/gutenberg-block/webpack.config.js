/*var webpack = require("webpack");
var CompressionPlugin = require("compression-webpack-plugin");*/

module.exports = {
  entry: "./block.js",
  output: {
    path: __dirname,
    filename: "block.build.js"
  },
  module: {
    loaders: [
      {
        test: /.js$/,
        loader: "babel-loader",
        exclude: /node_modules/
      }
    ]
  },
  /*plugins: [
    new webpack.DefinePlugin({
      //<--key to reduce React's size
      "process.env": {
        NODE_ENV: JSON.stringify("production")
      }
    }),
    new webpack.optimize.UglifyJsPlugin(),
    new webpack.optimize.AggressiveMergingPlugin()
  ]*/
};
