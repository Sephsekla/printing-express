const path = require('path');

const UglifyJsPlugin = require("uglifyjs-webpack-plugin");
const OptimizeCSSAssetsPlugin = require("optimize-css-assets-webpack-plugin");

const autoprefixer = require('autoprefixer');

const ExtractTextPlugin = require("extract-text-webpack-plugin");
const extractSass = new ExtractTextPlugin({
  filename: "main.min.css",
});

const extractAdmin = new ExtractTextPlugin({
  filename: "blocks/editor-blocks.css",
});

const extractSettings = {
  use: [{
      loader: "css-loader",
      options: {
        url: false,
        sourceMap: true

      }
    },

    {
      loader: 'postcss-loader',
      options: {
        plugins: () => [autoprefixer],
        sourceMap: true
      }
    },

    {
      loader: "sass-loader",
      options: {
        sourceMap: true
      }

    },

  ],
  // use style-loader in development
  fallback: "style-loader"
}

module.exports = {


  resolve: {
    alias: {
      assets: path.resolve(__dirname, 'dist/assets'),
      submodules: path.resolve(__dirname, 'submodules'),
    },
  },

  entry: {

    'main': './src/index.js',
    'blocks/blocks': './src/blocks.js',

  },
  plugins: [
    extractSass,
    extractAdmin
  ],
  output: {
    filename: '[name].js',
    path: path.resolve(__dirname, 'dist')
  },



  //When run in WordPress we want to use external jquery
  externals: {
    jquery: 'jQuery',
    lodash: 'lodash'
  },
  module: {
    rules: [{
        test: /\.js$/,
        exclude: /(node_modules|bower_components)/,
        use: [{
          loader: 'babel-loader',
          options: {
            presets: ['babel-preset-env'],
            plugins: ["lodash"],
          }
        }, {
          loader: "ifdef-loader",
          options: {
            DEBUG: false,
          }
        }]
      },
      {
        test: /\.(png|jpg|gif)$/,
        use: [{
          loader: 'file-loader',
          options: {}
        }]
      },

      {
        test: /\.scss$/,
        exclude: /blocks\.scss$/,
        use: extractSass.extract(extractSettings)
      },

      {
        test: /blocks\.scss$/,
        use: extractAdmin.extract(extractSettings)
      },



      {
        test: /\.css$/,
        loader: 'style-loader',
      },
      {
        test: /\.css$/,
        loader: 'css-loader',
        options: {
          minimize: true
        }
      }

    ]
  }

};