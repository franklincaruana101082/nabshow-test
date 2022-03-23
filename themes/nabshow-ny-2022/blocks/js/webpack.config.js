module.exports = [
  {
    name: 'block1',
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
  },

  {
    name: 'nabshow-block',
    entry: './nabshow-block.js',
    output: {
      filename: 'nabshow-block.build.js'
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