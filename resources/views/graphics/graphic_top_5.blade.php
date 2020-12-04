<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Top 5 de clientes con mayor cantidad de rentas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div id="container_graphic"></div>
            </div>
        </div>
    </div>

    <script>
        Highcharts.chart('container_graphic', {
            chart: {
                type: 'area'
            },
            title: {
                text: ': Top 5 clientes con mayor cantidad de rentas'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories:{!! $data->pluck("name") !!},
                tickmarkPlacement: 'on',
                title: {
                    enabled: false
                }
            },
            yAxis: {
                title: {
                    text: 'Rentas'
                },
            },
            tooltip: {
                split: true,
                valueSuffix: ' Peliculas'
            },
            plotOptions: {
                area: {
                    stacking: 'normal',
                    lineColor: '#666666',
                    lineWidth: 1,
                    marker: {
                        lineWidth: 1,
                        lineColor: '#666666'
                    }
                }
            },
            series: [{
                name:"Rentas",
                data:{!! $data->pluck("quantity") !!}
            }]
        });
    </script>
</x-app-layout>
