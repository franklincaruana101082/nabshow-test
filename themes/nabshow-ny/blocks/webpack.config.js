module.exports = [
  {
    name: 'nabshow-ny-block',
    entry: './block.js',
    output: {
      filename: 'block.build.js'
    },
    module: {
      loaders: [
        {
          test: /.js$/,
          loader: 'babel-loader',
          exclude: /node_modules/
        }
      ]
    }
  }
];