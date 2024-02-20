// Generated using webpack-cli https://github.com/webpack/webpack-cli

const path = require('path');

const isProduction = process.env.NODE_ENV == 'development';

const stylesHandler = 'style-loader';

const config = {
    entry: { 
        admin: [ './src/admin/js/index.js', './src/admin/scss/style.scss' ], 
        front: [ './src/front/js/index.js', './src/front/scss/style.scss' ]
    },
    output: {
        path: path.resolve(__dirname, 'public/assets'),
        filename: '[name].min.js'
    },
    devServer: {
        open: true,
        host: 'localhost',
    },
    module: {
        rules: [
            {
                test: /\.s[ac]ss$/i,
                use: [stylesHandler, 'css-loader', 'sass-loader'],
            },
            {
                test: /\.(eot|svg|ttf|woff|woff2|png|jpg|gif)$/i,
                type: 'asset',
            },
        ],
    },
};

module.exports = () => {
    if ( isProduction ) {
        config.mode = 'production';
    } else {
        config.mode = 'development';
    }
    return config;
};
