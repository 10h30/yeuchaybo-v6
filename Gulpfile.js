/**
 * Gulp task config file.
 *
 * @package SEOThemes\GenesisStarter
 */

'use strict';

var gulp    = require( 'gulp' ),
	toolkit = require( 'gulp-wp-toolkit' ),
	pkg     = require( './package.json' );

toolkit.extendConfig(
	{
		theme: {
			name: pkg.theme.name,
			themeuri: pkg.theme.uri,
			description: pkg.description,
			author: pkg.author,
			authoruri: pkg.theme.authoruri,
			version: pkg.version,
			license: pkg.license,
			licenseuri: pkg.theme.licenseuri,
			tags: pkg.theme.tags,
			textdomain: pkg.theme.textdomain,
			domainpath: pkg.theme.domainpath,
			template: pkg.theme.template,
			notes: pkg.theme.notes
		},
		src: {
			php: ['**/*.php', '!vendor/**'],
			images: 'assets/images/**/*',
			scss: 'assets/styles/*.scss',
			css: ['**/*.css', '!node_modules/**', '!develop/vendor/**'],
			js: ['assets/scripts/*.js', '!node_modules/**'],
			json: ['**/*.json', '!node_modules/**'],
			i18n: 'lib/languages/'
		},
		css: {
			basefontsize: 10, // Used by postcss-pxtorem.
            remmediaquery: false,
			scss: {
				'style': {
					src: 'assets/styles/style.scss',
					dest: './',
					outputStyle: 'expanded'
				},
				'woocommerce': {
					src: 'assets/styles/woocommerce.scss',
					dest: './',
					outputStyle: 'expanded'
				}
			}
		},
		js: {
			'theme': [ 
				'assets/scripts/theme.js',
			],
		},
		dest: {
            i18npo: './lib/languages/',
            i18nmo: './lib/languages/',
			images: './assets/images/',
			js: './assets/scripts/min/'
		},
		server: {
            proxy: 'https://yeuchaybo.test',
            port: '8000',
            https: {
            	'key': '/Users/thuanbui/.valet/Certificates/yeuchaybo.test.key',
            	'cert': '/Users/thuanbui/.valet/Certificates/yeuchaybo.test.crt'
            }
		}
	}
);

toolkit.extendTasks( gulp );
