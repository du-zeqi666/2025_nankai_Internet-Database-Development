const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');
const TerserPlugin = require('terser-webpack-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const CopyPlugin = require('copy-webpack-plugin');

module.exports = (env, argv) => {
    const isProduction = argv.mode === 'production';

    return {
        entry: {
            app: './frontend/war-memorial-frontend/scripts/core/app.js',
            styles: './frontend/war-memorial-frontend/styles/main.scss',
            // Separate entries for heavy components
            timeline: './frontend/war-memorial-frontend/scripts/components/Timeline/TimelineMain.js',
            gallery: './frontend/war-memorial-frontend/scripts/components/Gallery/ImageGallery.js',
            map: './frontend/war-memorial-frontend/scripts/components/Map/ChinaMap.js',
        },
        output: {
            filename: 'js/[name].[contenthash].js',
            path: path.resolve(__dirname, 'frontend/web/dist'),
            publicPath: '/dist/',
            library: '[name]',
            libraryTarget: 'umd',
        },
        resolve: {
            alias: {
                '@': path.resolve(__dirname, 'frontend/war-memorial-frontend/scripts'),
                '@styles': path.resolve(__dirname, 'frontend/war-memorial-frontend/styles'),
                '@assets': path.resolve(__dirname, 'frontend/war-memorial-frontend/assets'),
            },
            extensions: ['.js', '.scss', '.json'],
        },
        module: {
            rules: [
                {
                    test: /\.js$/,
                    exclude: /node_modules/,
                    use: {
                        loader: 'babel-loader',
                        options: {
                            presets: [
                                ['@babel/preset-env', {
                                    targets: '> 0.25%, not dead',
                                    useBuiltIns: 'usage',
                                    corejs: 3,
                                }],
                            ],
                            plugins: [
                                '@babel/plugin-transform-runtime',
                                '@babel/plugin-syntax-dynamic-import',
                            ],
                        },
                    },
                },
                {
                    test: /\.(sa|sc|c)ss$/,
                    use: [
                        isProduction ? MiniCssExtractPlugin.loader : 'style-loader',
                        {
                            loader: 'css-loader',
                            options: {
                                sourceMap: !isProduction,
                                importLoaders: 2,
                            },
                        },
                        {
                            loader: 'postcss-loader',
                            options: {
                                postcssOptions: {
                                    plugins: [
                                        ['autoprefixer', { grid: true }],
                                    ],
                                },
                                sourceMap: !isProduction,
                            },
                        },
                        {
                            loader: 'sass-loader',
                            options: {
                                sourceMap: !isProduction,
                                sassOptions: {
                                    outputStyle: isProduction ? 'compressed' : 'expanded',
                                },
                            },
                        },
                    ],
                },
                {
                    test: /\.(png|svg|jpg|jpeg|gif|webp)$/i,
                    type: 'asset/resource',
                    generator: {
                        filename: 'images/[name].[hash][ext]',
                    },
                },
                {
                    test: /\.(woff|woff2|eot|ttf|otf)$/i,
                    type: 'asset/resource',
                    generator: {
                        filename: 'fonts/[name].[hash][ext]',
                    },
                },
                {
                    test: /\.(glsl|vs|fs|vert|frag)$/,
                    exclude: /node_modules/,
                    use: [
                        'raw-loader',
                        'glslify-loader'
                    ]
                }
            ],
        },
        plugins: [
            new CleanWebpackPlugin(),
            new MiniCssExtractPlugin({
                filename: 'css/[name].[contenthash].css',
                chunkFilename: 'css/[id].[contenthash].css',
            }),
            new CopyPlugin({
                patterns: [
                    { 
                        from: 'frontend/war-memorial-frontend/assets', 
                        to: 'assets',
                        noErrorOnMissing: true 
                    },
                ],
            }),
        ],
        optimization: {
            minimize: isProduction,
            minimizer: [
                new TerserPlugin({
                    terserOptions: {
                        compress: {
                            drop_console: isProduction,
                        },
                    },
                    extractComments: false,
                }),
                new CssMinimizerPlugin(),
            ],
            splitChunks: {
                chunks: 'all',
                cacheGroups: {
                    vendor: {
                        test: /[\\/]node_modules[\\/]/,
                        name: 'vendors',
                        chunks: 'all',
                    },
                    styles: {
                        name: 'styles',
                        test: /\.css$/,
                        chunks: 'all',
                        enforce: true,
                    },
                },
            },
            runtimeChunk: 'single',
        },
        devtool: isProduction ? false : 'source-map',
        performance: {
            hints: isProduction ? 'warning' : false,
            maxEntrypointSize: 512000,
            maxAssetSize: 512000,
        },
        stats: {
            children: true,
            errorDetails: true,
        },
        devServer: {
            static: {
                directory: path.join(__dirname, 'frontend/web'),
            },
            compress: true,
            port: 9000,
            hot: true,
            headers: {
                "Access-Control-Allow-Origin": "*",
            },
        },
    };
};
