module.exports = {
    entry: './block.js',
    output: {
        path: __dirname,
        filename: 'block.build.js',
    },
    externals: {
        'react': 'React',
        'react-dom': 'ReactDOM',
      },
    module: {
        loaders: [
            {
                test: /.js$/,
                loader: 'babel-loader',
                exclude: /node_modules/,
            },
        ],
    },
};