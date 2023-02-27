<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <title>Vue Play</title>
    <script src="https://unpkg.com/vue@3"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <!--
    <style>
        html, body {
            height: 100%;
        }
		
		td {
			border border-slate-300 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400
		}

        body {
            display: grid;
            place-items: center;
        }

        .text-green {
            color: green;
        }

        .text-blue {
            color: blue;
        }
    </style>
    -->
</head>

<body class="h-full grid place-items-center">

    <div id="app">
        
		<section v-show="assets.length">
			<h2 class="font-bold mb-2">Assets</h2>			
			<table class="border-separate border-spacing-2 w-full border border-slate-400 dark:border-slate-500 bg-white dark:bg-slate-800 text-sm shadow-sm">
				<thead class="bg-slate-50 dark:bg-slate-700">
					<tr>
						<th align="right" class="w-1/2 border border-slate-300 dark:border-slate-600 font-semibold p-4 text-slate-900 dark:text-slate-200 text-left">Name</th>
						
						<th align="center" class="w-1/2 border border-slate-300 dark:border-slate-600 font-semibold p-4 text-slate-900 dark:text-slate-200 text-left">Value</th>
						
						<th align="center" class="w-1/2 border border-slate-300 dark:border-slate-600 font-semibold p-4 text-slate-900 dark:text-slate-200 text-left">Currency</th>
						
						<th class="w-1/2 border border-slate-300 dark:border-slate-600 font-semibold p-4 text-slate-900 dark:text-slate-200 text-left">Type</th>
					</tr>
				</thead>
				<tbody>
					<template v-for="asset in assets" :key="asset.id">
						<tr>
							<td align ="right" class="border border-slate-300 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">{{ asset.name }}</td>
							<td align ="center" class="border border-slate-300 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">{{ asset.value }}</td>
							<td align ="center" class="border border-slate-300 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400"><strong>{{ asset.currency }}</strong></td>
							<td class="border border-slate-300 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">{{ asset.type }}</td>
						</tr>
					</template>
					<tr>
						<td align="right" class="border border-slate-300 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400"><strong>TOTAL</strong></td>
						<td align="center" class="border border-slate-300 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">{{ assetsTotal }}</td>
						<td align="center" class="border border-slate-300 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">{{ activeCurrency }}</td>
					</tr>
				</tbody>
			</table>
		</section>

    </div>

    <script>
        //  One source of truth
        let app = {
            data() {
                return {
                    greeting : 'Hi There!',
                    active: false,
					assets: [
					{ id: 1, name: "BT-FFA", value: 2750, currency: "RON", type: "Cont Curent" },
					{ id: 2, name: "Alpha-Euro", value: 15200, currency: "EUR", type: "Depozit" },
					//{ id: 3, name: "Apt. 14", value: 42000, currency: "EUR", type: "Imobil" },
					{ id: 4, name: "Floating Money", value: 800, currency: "EUR", type: "Cash" },
					{ id: 5, name: "Wallet", value: 80, currency: "RON", type: "Cash" },
					{ id: 6, name: "Raiffeisen", value: 101.31, currency: "RON", type: "Cont Curent" }
					],
					activeCurrency: 'RON'
                };
            },

            computed: {
				assetsTotal() {
					let total = 0;
															
					for (let idx = 0; idx < this.assets.length; ++idx) {
						let converted = this.assets[idx].value;
						if (this.activeCurrency !== this.assets[idx].currency) {
							//	currencies are different, need to convert
							
							//	get exchange rate; look it up
							let x_rate = 4.89;	//	EUR to RON
							
							if (this.assets[idx].currency === 'RON') {
								converted /= x_rate;
							} else {
								converted *= x_rate;
							}
						}
						
						total += converted;
					}
					
					return total.toFixed (0);
				}				
            },

            methods: {
                toggle () {
                    this.active = !this.active;
                }
            },

            mounted () {
                setTimeout( () => {
                    this.greeting = 'Hellow World!';
                }, 3000);
            }

        };

        //  Create The App
        Vue.createApp (app).mount ('#app');
    </script>

</body>

</html>