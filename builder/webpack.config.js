const pathTheme            = './resources/themes/rmd-theme';
const path                 = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const ImageMinimizerPlugin = require('image-minimizer-webpack-plugin');
const IgnoreEmitPlugin     = require('ignore-emit-webpack-plugin');
const TerserPlugin         = require('terser-webpack-plugin');
const CssMinimizerPlugin   = require('css-minimizer-webpack-plugin');

module.exports = {
  mode: 'development',
  entry: {
    bundle: `${pathTheme}/src/scripts/app.js`,
    app: `${pathTheme}/src/styles/app.scss`,
  },
  output: {
    path: path.resolve(pathTheme, 'dist'),
    filename: 'scripts/[name].min.js',
    clean: true,
  },
  optimization: {
    minimize: true,
    minimizer: [
      new TerserPlugin({
        extractComments: false,
      }),
      new CssMinimizerPlugin(),
    ],
  },
  module: {
    rules: [
      {
        test: /\.m?js$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env'],
          },
        },
      },
      {
        test: /\.s[ac]ss$/,
        include: path.resolve(`${pathTheme}`, 'src/styles/'),
        use: [
          {
            loader: MiniCssExtractPlugin.loader,
          },
          {
            loader: 'css-loader',
            options: {
              sourceMap: true,
            },
          },
          {
            loader: 'postcss-loader',
          },
          'sass-loader',
        ],
      },
      {
        test: /\.(jpe?g|png|gif|svg)$/i,
        type: 'asset',
        use: [
          {
            loader: 'file-loader',
            options: {
              name: '[name].[ext]',
              outputPath: 'images/',
            },
          },
        ],
      },
      {
        test: /\.(woff(2)?|ttf|eot)$/i,
        generator: {
          filename: 'fonts/[name].[ext]',
        },
        // use: [
        //   {
        //     loader: 'file-loader',
        //     options: {
        //       name: '[name].[ext]',
        //       outputPath: 'fonts/'
        //     }
        //   }
        // ]
      },
    ],
  },
  plugins: [
    new ImageMinimizerPlugin({
      filename: 'images/[name].webp',
      minimizerOptions: {
        plugins: ['gifsicle'],
      },
    }),
    new MiniCssExtractPlugin({
      filename: 'styles/[name].min.css',
      chunkFilename: '[name].css',
    }),
    new IgnoreEmitPlugin([
      'app.min.js',
      'bundle.min.css',
    ]),
  ],
};
