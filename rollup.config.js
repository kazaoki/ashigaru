import { terser } from 'rollup-plugin-terser'
import typescript from '@rollup/plugin-typescript'
import scss from 'rollup-plugin-scss'

export default
[
	// for site
	{
		input: 'src/assets/ts/site.ts',
		output: [
			{
				file: 'public/assets/js/site.js',
				format: 'iife'
			},
			{
				sourcemap: true,
				file: 'public/assets/js/site.min.js',
				format: 'iife',
				plugins: [terser()]
			}
		],
		plugins: [
			typescript(),
			// typescript({lib: ["es5", "es6", "dom"], target: "es5"}),
			scss({
				output: 'public/assets/css/site.css',
				sourceMap: true,
			})
		]
	},

	// for manage
	{
		input: 'src/assets/ts/manage.ts',
		output: [
			{
				file: 'public/assets/js/manage.js',
				format: 'iife'
			},
			{
				sourcemap: true,
				file: 'public/assets/js/manage.min.js',
				format: 'iife',
				plugins: [terser()]
			}
		],
		plugins: [
			typescript(),
			// typescript({lib: ["es5", "es6", "dom"], target: "es5"}),
			scss({
				output: 'public/assets/css/manage.css',
				sourceMap: true,
			})
		]
	}
]
