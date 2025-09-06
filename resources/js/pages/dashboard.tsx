import React from 'react';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem, type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

interface DashboardStats {
    total_kabupatens?: number;
    total_kecamatans?: number;
    total_desas?: number;
    total_penduduk?: number;
    total_users?: number;
    total_umkm?: number;
    total_laki_laki?: number;
    total_perempuan?: number;
}

interface Charts {
    gender_distribution: {
        laki_laki: number;
        perempuan: number;
    };
    age_distribution: {
        [key: string]: number;
    };
    education_distribution: {
        [key: string]: number;
    };
}

interface Props {
    stats: DashboardStats;
    charts: Charts;
    [key: string]: unknown;
}

export default function Dashboard({ stats, charts }: Props) {
    const { auth } = usePage<SharedData>().props;
    const user = auth.user;

    const getStatCards = () => {
        if (!user) return [];

        if (user.role === 'super_admin') {
            return [
                { title: 'Total Kabupaten', value: stats.total_kabupatens || 0, icon: '🏛️', color: 'from-red-500 to-red-600' },
                { title: 'Total Kecamatan', value: stats.total_kecamatans || 0, icon: '🏢', color: 'from-blue-500 to-blue-600' },
                { title: 'Total Desa', value: stats.total_desas || 0, icon: '🏘️', color: 'from-green-500 to-green-600' },
                { title: 'Total Penduduk', value: stats.total_penduduk || 0, icon: '👥', color: 'from-purple-500 to-purple-600' },
                { title: 'Total Users', value: stats.total_users || 0, icon: '👤', color: 'from-yellow-500 to-yellow-600' },
            ];
        } else if (user.role === 'admin_kabupaten') {
            return [
                { title: 'Total Kecamatan', value: stats.total_kecamatans || 0, icon: '🏢', color: 'from-blue-500 to-blue-600' },
                { title: 'Total Desa', value: stats.total_desas || 0, icon: '🏘️', color: 'from-green-500 to-green-600' },
                { title: 'Total Penduduk', value: stats.total_penduduk || 0, icon: '👥', color: 'from-purple-500 to-purple-600' },
                { title: 'Total Users', value: stats.total_users || 0, icon: '👤', color: 'from-yellow-500 to-yellow-600' },
            ];
        } else if (user.role === 'admin_kecamatan') {
            return [
                { title: 'Total Desa', value: stats.total_desas || 0, icon: '🏘️', color: 'from-green-500 to-green-600' },
                { title: 'Total Penduduk', value: stats.total_penduduk || 0, icon: '👥', color: 'from-purple-500 to-purple-600' },
                { title: 'Total Users', value: stats.total_users || 0, icon: '👤', color: 'from-yellow-500 to-yellow-600' },
            ];
        } else {
            return [
                { title: 'Total Penduduk', value: stats.total_penduduk || 0, icon: '👥', color: 'from-purple-500 to-purple-600' },
                { title: 'Total UMKM', value: stats.total_umkm || 0, icon: '🏪', color: 'from-orange-500 to-orange-600' },
                { title: 'Laki-laki', value: stats.total_laki_laki || 0, icon: '👨', color: 'from-blue-500 to-blue-600' },
                { title: 'Perempuan', value: stats.total_perempuan || 0, icon: '👩', color: 'from-pink-500 to-pink-600' },
            ];
        }
    };

    const statCards = getStatCards();

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard - Sistem Potensi Desa" />
            <div className="flex h-full flex-1 flex-col gap-6 rounded-xl p-6 overflow-x-auto">
                {/* Header */}
                <div className="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h1 className="text-3xl font-bold text-gray-900 dark:text-gray-100">
                            📊 Dashboard Potensi Desa
                        </h1>
                        <p className="text-gray-600 dark:text-gray-400 mt-1">
                            Selamat datang, <span className="font-medium">{user?.name}</span> ({user && 'role' in user && typeof user.role === 'string' ? user.role.replace('_', ' ').toUpperCase() : 'USER'})
                        </p>
                    </div>
                    <div className="text-sm text-gray-500 dark:text-gray-400">
                        {user && 'kabupaten' in user && typeof user.kabupaten === 'string' && user.kabupaten}
                        {user && 'kecamatan' in user && typeof user.kecamatan === 'string' && user.kecamatan && ` › ${user.kecamatan}`}
                        {user && 'desa' in user && typeof user.desa === 'string' && user.desa && ` › ${user.desa}`}
                    </div>
                </div>

                {/* Statistics Cards */}
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    {statCards.map((card, index) => (
                        <div
                            key={index}
                            className="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
                        >
                            <div className="flex items-center justify-between">
                                <div>
                                    <p className="text-sm font-medium text-gray-600 dark:text-gray-400">{card.title}</p>
                                    <p className="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-2">
                                        {card.value.toLocaleString()}
                                    </p>
                                </div>
                                <div className={`w-12 h-12 rounded-lg bg-gradient-to-r ${card.color} flex items-center justify-center text-white text-xl shadow-lg`}>
                                    {card.icon}
                                </div>
                            </div>
                        </div>
                    ))}
                </div>

                {/* Quick Actions */}
                <div className="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
                    <h2 className="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">🚀 Aksi Cepat</h2>
                    <div className="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                        {user && 'role' in user && user.role === 'super_admin' && (
                            <>
                                <button className="flex flex-col items-center p-4 rounded-lg bg-gradient-to-r from-red-50 to-red-100 dark:from-red-900/20 dark:to-red-800/20 hover:from-red-100 hover:to-red-200 transition-all duration-300 group">
                                    <span className="text-2xl mb-2 group-hover:scale-110 transition-transform">👤</span>
                                    <span className="text-sm font-medium text-red-700 dark:text-red-300">Kelola User</span>
                                </button>
                                <button className="flex flex-col items-center p-4 rounded-lg bg-gradient-to-r from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 hover:from-blue-100 hover:to-blue-200 transition-all duration-300 group">
                                    <span className="text-2xl mb-2 group-hover:scale-110 transition-transform">🏛️</span>
                                    <span className="text-sm font-medium text-blue-700 dark:text-blue-300">Master Data</span>
                                </button>
                            </>
                        )}
                        <Link
                            href={route('demografi.index')}
                            className="flex flex-col items-center p-4 rounded-lg bg-gradient-to-r from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20 hover:from-green-100 hover:to-green-200 transition-all duration-300 group"
                        >
                            <span className="text-2xl mb-2 group-hover:scale-110 transition-transform">👥</span>
                            <span className="text-sm font-medium text-green-700 dark:text-green-300">Demografi</span>
                        </Link>
                        <button className="flex flex-col items-center p-4 rounded-lg bg-gradient-to-r from-purple-50 to-purple-100 dark:from-purple-900/20 dark:to-purple-800/20 hover:from-purple-100 hover:to-purple-200 transition-all duration-300 group">
                            <span className="text-2xl mb-2 group-hover:scale-110 transition-transform">🏪</span>
                            <span className="text-sm font-medium text-purple-700 dark:text-purple-300">UMKM</span>
                        </button>
                        <button className="flex flex-col items-center p-4 rounded-lg bg-gradient-to-r from-orange-50 to-orange-100 dark:from-orange-900/20 dark:to-orange-800/20 hover:from-orange-100 hover:to-orange-200 transition-all duration-300 group">
                            <span className="text-2xl mb-2 group-hover:scale-110 transition-transform">🌾</span>
                            <span className="text-sm font-medium text-orange-700 dark:text-orange-300">Pertanian</span>
                        </button>
                        <button className="flex flex-col items-center p-4 rounded-lg bg-gradient-to-r from-teal-50 to-teal-100 dark:from-teal-900/20 dark:to-teal-800/20 hover:from-teal-100 hover:to-teal-200 transition-all duration-300 group">
                            <span className="text-2xl mb-2 group-hover:scale-110 transition-transform">📊</span>
                            <span className="text-sm font-medium text-teal-700 dark:text-teal-300">Laporan</span>
                        </button>
                    </div>
                </div>

                {/* Charts Section */}
                <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    {/* Gender Distribution */}
                    <div className="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
                        <h3 className="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">👫 Distribusi Jenis Kelamin</h3>
                        <div className="space-y-4">
                            <div className="flex items-center justify-between">
                                <div className="flex items-center space-x-2">
                                    <div className="w-4 h-4 bg-blue-500 rounded"></div>
                                    <span className="text-sm text-gray-600 dark:text-gray-400">Laki-laki</span>
                                </div>
                                <span className="font-semibold text-gray-900 dark:text-gray-100">
                                    {charts?.gender_distribution?.laki_laki || 0}
                                </span>
                            </div>
                            <div className="flex items-center justify-between">
                                <div className="flex items-center space-x-2">
                                    <div className="w-4 h-4 bg-pink-500 rounded"></div>
                                    <span className="text-sm text-gray-600 dark:text-gray-400">Perempuan</span>
                                </div>
                                <span className="font-semibold text-gray-900 dark:text-gray-100">
                                    {charts?.gender_distribution?.perempuan || 0}
                                </span>
                            </div>
                        </div>
                    </div>

                    {/* Age Distribution */}
                    <div className="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
                        <h3 className="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">📊 Distribusi Umur</h3>
                        <div className="space-y-3">
                            {charts?.age_distribution && Object.entries(charts.age_distribution).map(([key, value]) => (
                                <div key={key} className="flex items-center justify-between">
                                    <span className="text-sm text-gray-600 dark:text-gray-400">{key} tahun</span>
                                    <span className="font-semibold text-gray-900 dark:text-gray-100">{value}</span>
                                </div>
                            ))}
                        </div>
                    </div>

                    {/* Education Distribution */}
                    <div className="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
                        <h3 className="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">🎓 Distribusi Pendidikan</h3>
                        <div className="space-y-3">
                            {charts?.education_distribution && Object.entries(charts.education_distribution).map(([key, value]) => (
                                <div key={key} className="flex items-center justify-between">
                                    <span className="text-sm text-gray-600 dark:text-gray-400">{key.toUpperCase()}</span>
                                    <span className="font-semibold text-gray-900 dark:text-gray-100">{value}</span>
                                </div>
                            ))}
                        </div>
                    </div>
                </div>

                {/* Recent Activities */}
                <div className="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
                    <h3 className="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">📋 Aktivitas Terbaru</h3>
                    <div className="space-y-3">
                        <div className="flex items-center space-x-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <div className="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-white text-sm">✓</div>
                            <div>
                                <p className="text-sm font-medium text-gray-900 dark:text-gray-100">Data demografi berhasil diperbarui</p>
                                <p className="text-xs text-gray-500 dark:text-gray-400">2 jam yang lalu</p>
                            </div>
                        </div>
                        <div className="flex items-center space-x-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <div className="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white text-sm">📊</div>
                            <div>
                                <p className="text-sm font-medium text-gray-900 dark:text-gray-100">Laporan bulanan telah dibuat</p>
                                <p className="text-xs text-gray-500 dark:text-gray-400">1 hari yang lalu</p>
                            </div>
                        </div>
                        <div className="flex items-center space-x-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <div className="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center text-white text-sm">🏪</div>
                            <div>
                                <p className="text-sm font-medium text-gray-900 dark:text-gray-100">Data UMKM baru ditambahkan</p>
                                <p className="text-xs text-gray-500 dark:text-gray-400">3 hari yang lalu</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}