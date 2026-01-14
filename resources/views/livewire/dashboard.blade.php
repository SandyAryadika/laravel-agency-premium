<div class="space-y-6">

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        <div class="p-6 bg-slate-900/50 border border-white/5 rounded-3xl relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                <svg class="w-16 h-16 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                    </path>
                </svg>
            </div>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Total Revenue</p>
            <h3 class="text-2xl font-bold text-white tracking-tight">Rp
                {{ number_format($totalRevenue / 1000000, 1, ',', '.') }}M</h3>
            <div class="mt-2 text-xs text-slate-400">Gross Income</div>
        </div>

        <div class="p-6 bg-slate-900/50 border border-white/5 rounded-3xl relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                <svg class="w-16 h-16 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                </svg>
            </div>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Expenses</p>
            <h3 class="text-2xl font-bold text-rose-400 tracking-tight">Rp
                {{ number_format($totalExpenses / 1000000, 1, ',', '.') }}M</h3>
            <div class="mt-2 text-xs text-slate-400">Total Spending</div>
        </div>

        <div
            class="p-6 bg-gradient-to-br from-emerald-900/40 to-slate-900/50 border border-emerald-500/20 rounded-3xl relative overflow-hidden group shadow-lg shadow-emerald-900/10">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                <svg class="w-16 h-16 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <p class="text-xs font-bold text-emerald-500/80 uppercase tracking-widest mb-2">Net Profit</p>
            <h3 class="text-2xl font-bold text-emerald-400 tracking-tight">Rp
                {{ number_format($netProfit / 1000000, 1, ',', '.') }}M</h3>

            <div
                class="mt-3 inline-flex items-center gap-1 px-2 py-1 rounded-lg bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-bold">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                </svg>
                {{ number_format($profitMargin, 1) }}% Margin
            </div>
        </div>

        <div class="p-6 bg-slate-900/50 border border-white/5 rounded-3xl relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                <svg class="w-16 h-16 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                    </path>
                </svg>
            </div>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">In Progress</p>
            <h3 class="text-2xl font-bold text-white tracking-tight">{{ $activeProjects }}</h3>
            <div class="mt-2 text-xs text-slate-400">Ongoing Projects</div>
        </div>
    </div>


    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

        <div class="lg:col-span-3 space-y-6">

            <div class="p-6 bg-slate-900/50 border border-white/5 rounded-3xl">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-bold text-white">Financial Performance</h3>
                    <div class="flex gap-4 text-xs font-medium">
                        <div class="flex items-center gap-1">
                            <div class="w-2 h-2 rounded-full bg-blue-500"></div> Revenue
                        </div>
                        <div class="flex items-center gap-1">
                            <div class="w-2 h-2 rounded-full bg-rose-500"></div> Expenses
                        </div>
                    </div>
                </div>
                <div id="financeChart" class="w-full h-80"></div>
            </div>

            <div class="p-6 bg-slate-900/50 border border-white/5 rounded-3xl">
                <h3 class="text-lg font-bold text-white mb-6">Project Status</h3>
                <div id="projectChart" class="w-full h-80 flex items-center justify-center"></div>
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="bg-slate-900/50 border border-white/5 rounded-3xl p-6 h-full flex flex-col">
                <h3 class="text-lg font-bold text-white mb-6 flex items-center gap-2 shrink-0">
                    <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Recent Activity
                </h3>

                <div
                    class="space-y-6 relative before:absolute before:inset-0 before:ml-2.5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-slate-800 before:to-transparent flex-1">
                    @forelse($recentActivities as $activity)
                        <div class="relative flex items-start group">
                            <div
                                class="absolute left-0 top-1 mt-0.5 ml-0.5 h-4 w-4 rounded-full border border-slate-900 
                                {{ $activity->type == 'success' ? 'bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.4)]' : 'bg-blue-500 shadow-[0_0_8px_rgba(59,130,246,0.4)]' }}">
                            </div>
                            <div class="ml-8 w-full">
                                <p class="text-sm text-slate-300 font-medium group-hover:text-white transition-colors">
                                    {{ $activity->description }}</p>
                                <span
                                    class="text-xs text-slate-500 mt-1 block">{{ $activity->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-10">
                            <p class="text-slate-500 text-sm">No recent activity.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:navigated', () => {

            // 1. FINANCE CHART (Dual Line: Revenue vs Expense)
            const financeOptions = {
                series: [{
                        name: 'Revenue',
                        data: @json($chartRevenues)
                    },
                    {
                        name: 'Expenses',
                        data: @json($chartExpenses)
                    }
                ],
                chart: {
                    type: 'area',
                    height: 320,
                    toolbar: {
                        show: false
                    },
                    background: 'transparent'
                },
                stroke: {
                    curve: 'smooth',
                    width: 2
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.4,
                        opacityTo: 0.05,
                        stops: [0, 90, 100]
                    }
                },
                colors: ['#3b82f6', '#f43f5e'], // Blue (Rev), Rose (Exp)
                xaxis: {
                    categories: @json($chartMonths),
                    labels: {
                        style: {
                            colors: '#94a3b8'
                        }
                    },
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: '#94a3b8'
                        },
                        formatter: (value) => {
                            return "Rp " + new Intl.NumberFormat('id-ID', {
                                notation: "compact"
                            }).format(value)
                        }
                    }
                },
                grid: {
                    borderColor: 'rgba(255, 255, 255, 0.05)'
                },
                dataLabels: {
                    enabled: false
                },
                theme: {
                    mode: 'dark'
                },
                tooltip: {
                    theme: 'dark'
                }
            };

            const chart1 = new ApexCharts(document.querySelector("#financeChart"), financeOptions);
            chart1.render();

            // 2. PROJECT STATUS CHART
            const projectOptions = {
                series: @json($projectCounts),
                labels: @json($projectLabels),
                chart: {
                    type: 'donut',
                    height: 320,
                    background: 'transparent'
                },
                colors: ['#64748b', '#3b82f6',
                '#10b981'], // Slate (Pending), Blue (Progress), Emerald (Completed)
                stroke: {
                    show: false
                },
                legend: {
                    position: 'bottom',
                    labels: {
                        colors: '#94a3b8'
                    }
                },
                dataLabels: {
                    enabled: false
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '75%',
                            labels: {
                                show: true,
                                total: {
                                    show: true,
                                    label: 'Projects',
                                    color: '#94a3b8',
                                    formatter: function(w) {
                                        return w.globals.seriesTotals.reduce((a, b) => a + b, 0)
                                    }
                                }
                            }
                        }
                    }
                },
                theme: {
                    mode: 'dark'
                }
            };

            const chart2 = new ApexCharts(document.querySelector("#projectChart"), projectOptions);
            chart2.render();
        });
    </script>
</div>
